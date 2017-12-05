<?php
namespace Org\Util;
use Think\Controller;
class Field extends Controller{
   
   public $PRE;//表前缀
   
   public $TABLE;//表名称
   
   public $TRUE_TABLE;//真实表名
   
   public $CHARSET;//表编码
   
   public $CHARSET_;//表字段整理
   
   public $FIELD;//表字段名称
   
   public $DEFAULT;//字段默认值
   
   public $REMARKS;//字段描述

   public $UNIQUE;//字段唯一性
   
   public $NULL;//字段是否允许为空
   
   public $FORM_TYPE;//字段创建表单类型
   
   public $SETTING;//字段的参数
   
   public $OLD_FIELD;//字段修改前的字段名称，在编辑字段需要
      
   function __construct()  //析构函数
   {  
        parent::__construct();
        $this->PRE=C("DB_PREFIX");
		$this->CHARSET=C("DB_CHARSET");
		$this->CHARSET_=C("DB_CHARSET")=="utf8"?"utf8_general_ci":C("DB_CHARSET")."_chinese_ci";
   } 
   
   function create()
   {
		$a=I('post.');
		$this->SETTING=$setting=$a['setting'];
		$len_min=is_numeric($setting['len_min'])?intval($setting['len_min']):0;
		$len_max=is_numeric($setting['len_max'])?intval($setting['len_max']):0;
		$this->TRUE_TABLE=$this->PRE.$a['table'];
		$this->TABLE=$a['table'];
		$this->FIELD=$a['field'];
		$this->REMARKS=$a['remarks'];
		$this->DEFAULT=0;
		$this->UNIQUE=($setting['only'] || $setting['search'])?",ADD INDEX (`$this->FIELD`)":"";
		$this->NULL=$len_min>0?"NOT NULL":"NULL";
		$this->FORM_TYPE=$a['form_type']?$a['form_type']:"text";
   		$form_type="create_".$this->FORM_TYPE;
		$this->$form_type();
		return true;
   }  
   function edit()
   {
		$a=I('post.');
		$this->SETTING=$setting=$a['setting'];
		$len_min=is_numeric($setting['len_min'])?intval($setting['len_min']):0;
		$len_max=is_numeric($setting['len_max'])?intval($setting['len_max']):0;
		$this->TRUE_TABLE=$this->PRE.$a['table'];
		$this->TABLE=$a['table'];
		$this->FIELD=$a['field'];
		$this->OLD_FIELD=$a['old_field'];
		$this->REMARKS=$a['remarks'];
		$this->DEFAULT=0;
		$this->UNIQUE=($setting['only'] || $setting['search'])?true:false;
		$this->NULL=$len_min>0?"NOT NULL":"NULL";
		$this->FORM_TYPE=$a['form_type']?$a['form_type']:"text";
   		$form_type="edit_".$this->FORM_TYPE;
		$this->$form_type();
		return true;
   }
   
   /**
* 创建数据表
* $table 创建的数据表名
* $field 创建字段数组
* $insert 要插入的数据array('table'=>array())
*/        
   function create_table($table,$field=array())
   {
         $Table= M();
		 if(is_array($table))
		 {
		     foreach($table as $k=>$v)
			 {
			       $sql="create table `".$this->PRE.$k."` ( ".implode(",",$v)." ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=".$this->CHARSET;
				   $Table->execute($sql); 
			       $table_info[]=$this->is_table_exist($table);	
			 }
					     
		 }
		 else
		 {
			 $sql="create table `".$this->PRE.$table."` ( ".implode(",",$field)." ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=".$this->CHARSET;
			 $Table->execute($sql); 
			 $table_info=$this->is_table_exist($table);		 
		 }
		 return $table_info;
   }
 /**
* 插入数据
* $table 数据表名
* $insert_data 要插入的数据array('field'=>array())
*/        
   function insert_data($table,$insert_data)
   {
	     if($this->is_table_exist($table))
		 {
			   $Table= M($table);
			   $Insert=$Table->addAll($insert_data);			 
		 }

		 return $Insert;
   } 
 /**
* 删除数据
* $table 数据表名
* $del_data 要删除的数据)
*/        
   function del_data($table,$del_data=array())
   {
         if(is_array($table))
		 {
		      foreach($table as $k=>$v)
			  {
				  if($this->is_table_exist($k))
				  {
						$Table= M($k);
						$del=$Table->where($v)->delete();
				  }
			  }
		 }
		 else
		 {
			  if($this->is_table_exist($table))
			  {
			       $Table= M($table);
			       $del=$Table->where($del_data)->delete();	
			  }
		 }

		 return $del;
   } 
   
 /**
* 删除数据表
* $table 数据表名
*/        
   function del_table($table)
   {
         $Table= M();
		 if(is_array($table))
		 {
		      foreach($table as $k=>$v)
			  {
			      if($this->is_table_exist($v)) $Table->execute("DROP TABLE IF EXISTS ".$this->PRE.$v); 
				  M('table_field')->where(array('table'=>$v))->delete();
			  }
		 }
		 else
		 {
		      if($this->is_table_exist($table)) $Table->execute("DROP TABLE IF EXISTS ".$this->PRE.$table); 
			  M('table_field')->where(array('table'=>$table))->delete();
		 }
		 return true;
   } 
/**
* 创建字段表单，依靠ID创建单个字段表单
* $field_id  字段ID
* $id        记录ID
*/     
   function create_form_field_by_id($field_id,$id,$formid)
   {
       if(!$field_id) return "";
	   $Field =D('table_field');
	   $data['id']=$field_id;
	   $data['status']=1;
	   $Fields=$Field->where($data)->find();
  	  
	   if($Fields)
	   { 
/*============================验证字段的权限===========================================*/
                $point=array('money','amount','point');
				if(in_array($Fields['field'],$point))
				{
					 if(C($Fields['field']."_status"))
					 {
						 $Fields['title']=C($Fields['field']."_name");
					 }
					 else
					 {
						 return "";
					 }
				}
		        $login=$GLOBALS['LOGIN_USER'];

				if($login['admin']=="admin" && !$login['is_del'])
				{
					   $lve=$id?$Fields['is_admin_edit']:$Fields['is_admin_submit'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && (in_array(-1,$lve) || !in_array($login['role_id'],$lve)) )
					   {
                            //$filed_str=$filed_str."管理员没此权限";
							return "";
					   }
				}
				elseif($login['admin']=="user")
				{
					   $lve=$id?$Fields['is_user_edit']:$Fields['is_user_submit'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && (in_array(-1,$lve) || !in_array($login['group_id'],$lve)) )
					   {
                            //$filed_str=$filed_str."次会员组无次权限";
							return "";
					   }				
				}
				elseif(!$login)
				{
					   $lve=$id?$Fields['is_user_edit']:$Fields['is_user_submit'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && in_array(-1,$lve))
					   {
							return "";
					   }						
				}
/*============================验证字段的权限===========================================*/
			   if(IS_POST)
			   {
						$this->field_save($Fields);
			   }
			   else
			   {
			   
					if($id)
					{
						unset($data);
						$M=D($Fields['table']);
						$data['id']=$id;
						$record= $M->where($data)->find();			
					}
					
					if($Fields['setting']['data1'] && $Fields['setting']['var_'] && !$id)
					{
							$var_tem=preg_replace_callback('/\[\$([A-Za-z0-9_\[\]]+)]/i', 
							function ($m) use ($var_array) {
								extract($var_array);
								eval("\$var=\$".$m[1].";");
								return $var;
							},$v['setting']['var_']); 
					}
				   if($Fields['setting']['data2'] && $Fields['setting']['sql'] && $Fields['setting']['sql_var'] && !$id)
					{	
							//sql语句替换数据表				
							$sql_tem_table=preg_replace('/\[\*([A-Za-z0-9_]+)]/i',C('DB_PREFIX')."$1",$Fields['setting']['sql']);
							//sql语句替换变量GET POST 等数据
							$sql_tem=preg_replace_callback('/\[\$([A-Za-z0-9_\[\]\']+)]/i', 
							function ($m) use ($var_array) {
								extract($var_array);
								eval("\$var=\$".$m[1].";");
								return $var;
							},$sql_tem_table);
							/////////////////////////////////////// 
							$modle=M() ; 
							$sql_query=$modle->query($sql_tem);
							if($sql_query)
							{
								   //替换SQL值中的变量
									$sql_var=preg_replace_callback('/\[\$([A-Za-z0-9_\[\]\']+)]/i', 
									function ($m) use ($var_array) {
										extract($var_array);
										eval("\$var=\$".$m[1].";");
										return $var;
									},$Fields['setting']['sql_var']); 
									///////////////////////////////////
								  foreach($sql_query as $ak=>$av)
								  {
											//替换字段的值
											$sql_var_var=preg_replace_callback('/\[\#([A-Za-z0-9_\[\]\']+)]/i', 
											function ($m) use ($av) {
												return $av[$m[1]];
											},$sql_var);
											///////////////////////////////////
											if(trim($Fields['form_type'])=="box")
											{
												 $sql_var_string=$sql_var_string?$sql_var_string."\r\n".$sql_var_var:$sql_var_var; 
											}
											else
											{
												 $sql_var_string=$sql_var_string.$sql_var_var; 
											}
											
								  }	
							}//$sql_query
					}
					//替换对应的模板信息
					if(trim($Fields['form_type'])=="box")
					{
						$Fields['setting']['box_list']=$sql_var_string?$sql_var_string:$Fields['setting']['box_list']; 
					}
					else
					{
						$Fields['setting']['default_']=$sql_var_string?$sql_var_string:($var_tem?$var_tem:$Fields['setting']['default_']);
					}
					//////////////////////////////////////////////////////////////					
					
					if($var_tem) $Fields['setting']['default_']=$var_tem;
					
					if(!$Fields['setting']['data0']&& $Fields['form_type']!="image" && $Fields['form_type']!="images" && $Fields['form_type']!="datetime")
					{
						 $default=$Fields['setting']['default_'];
						 return "<input name='".$Fields['field']."' id='".$Fields['field']."' type='hidden' value='".$default."' />";
					}
					$formid=$formid?$formid:"form1";
					$scrpit="<script>\$.formValidator.initConfig({
						formID: \"$formid\",
						errorFocus: false,
						submitOnce: false,
						ajaxObjects:'',
/*						onError:function(msg,obj,errorlist){ 
						   $.map(errorlist,function(msg1){
						   alert(obj.value)
						   }); 
						 },*/
						onSuccess: function() {},
					}); ";
					$script=$script.$this->formValidator($v)."</script>";
					if(isMobile()) $Fields['tem_c']=($Fields['tem_mobile_c']?$Fields['tem_mobile_c']:$Fields['tem_c']);
					$patterns=array('/\[title]/i','/\[field]/i','/\[remarks]/i');
					$replacements=array($Fields['title'],$Fields['field'],$Fields['remarks']);
					$tem_c=preg_replace($patterns,$replacements,$Fields['tem_c']);
					$Fields['tem_c']= stripslashes($tem_c);
					if(!is_array($Fields['setting']))$Fields['setting']=string2array($Fields['setting']);
					$form_type="show_".$Fields['form_type'];
					return $this->$form_type($Fields,$record).$script;
			  }
	   }   
   } 
   
/**
* 创建字段表单，依靠表名称
* $table     字段所属表
* $id        记录ID
* $var_array     已有变量的值
* $group     显示分组
* $tpl_name     显示模板标识
*/    
   function create_form_field_by_table($table,$id,$formid,$var_array,$group="",$tpl_name="")
   {
       if(!$table) return "";
       if(is_numeric($table))
		{
		    $M=D('model');
			$data['id']=$table;
			$table = $M->where($data)->getField('table');
		}
       $Fields=FF("field/field_".$table);
	  
        if($id)
		{
		    unset($data);
		    $M=D($table);
			$data['id']=$id;
			$record= $M->where($data)->find();		
		}
	    $filed_str="";
		$formid=$formid?$formid:"form1";
		$script_form="<script type='text/javascript' src='".C('TMPL_PARSE_STRING.__STATIC__')."js/formvalidator.js'></script><script type='text/javascript' src='".C('TMPL_PARSE_STRING.__STATIC__')."js/formvalidatorregex.js'></script><script>\r\n \$.formValidator.initConfig({
			formID: \"$formid\",
			errorFocus: false,
			submitOnce: true,
			onError:function(msg,obj,errorlist){ 
/*			   $.map(errorlist,function(msg1){
			   alert(obj.value)
			   }); */
			 },
			onSuccess: function() {},
		}); \r\n</script>";
		
		foreach($Fields as $k=>$v)
		{		
/*============================验证字段的权限===========================================*/
                $point=array('money','amount','point');
				if(in_array($v['field'],$point))
				{
					 if(C($v['field']."_status"))
					 {
						 $v['title']=C($v['field']."_name");
					 }
					 else
					 {
						 continue;
					 }
				}
                if($group && $v['group']!=$group) continue;
		        $login=$GLOBALS['LOGIN_USER'];

				if($login['admin']=="admin" && !$login['is_del'])
				{
					   $lve=$id?$v['is_admin_edit']:$v['is_admin_submit'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && (in_array(-1,$lve) || !in_array($login['role_id'],$lve)) )
					   {
                            //$filed_str=$filed_str."管理员没此权限";
							continue;
					   }
				}
				elseif($login['admin']=="user")
				{
					   $lve=$id?$v['is_user_edit']:$v['is_user_submit'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && (in_array(-1,$lve) || !in_array($login['group_id'],$lve)) )
					   {
                            //$filed_str=$filed_str."次会员组无次权限";
							continue;
					   }				
				}
				elseif(!$login)
				{
					   $lve=$id?$v['is_user_edit']:$v['is_user_submit'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && in_array(-1,$lve))
					   {
                            //$filed_str=$filed_str."次会员组无次权限";
							continue;
					   }						
				}
				
/*============================验证字段的权限===========================================*/
				if(IS_POST)
				{
				    $this->field_save($v);
				}
				else
				{
					
				        $sql_var_string="";
				        if($v['setting']['data1'] && $v['setting']['var_'] && !$id)
						{
								$var_tem=preg_replace_callback('/\[\$([A-Za-z0-9_\[\]\']+)]/i', 
								function ($m) use ($var_array) {
								    extract($var_array);
									eval("\$var=\$".$m[1].";");
									return $var;
								},$v['setting']['var_']); 
						}
						
					   if($v['setting']['data2'] && $v['setting']['sql'] && $v['setting']['sql_var'] && !$id)
						{	
						        //sql语句替换数据表				
								$sql_tem_table=preg_replace('/\[\*([A-Za-z0-9_]+)]/i',C('DB_PREFIX')."$1",$v['setting']['sql']);
								//sql语句替换变量GET POST 等数据
								$sql_tem=preg_replace_callback('/\[\$([A-Za-z0-9_\[\]\']+)]/i', 
								function ($m) use ($var_array) {
								    extract($var_array);
									eval("\$var=\$".$m[1].";");
									return $var;
								},$sql_tem_table);
								/////////////////////////////////////// 
								$modle=M() ; 
								$sql_query=$modle->query($sql_tem);
								if($sql_query)
								{
								       //替换SQL值中的变量
										$sql_var=preg_replace_callback('/\[\$([A-Za-z0-9_\[\]\']+)]/i', 
										function ($m) use ($var_array) {
											extract($var_array);
											eval("\$var=\$".$m[1].";");
											return $var;
										},$v['setting']['sql_var']); 
										///////////////////////////////////
									  foreach($sql_query as $ak=>$av)
									  {
												//替换字段的值
												$sql_var_var=preg_replace_callback('/\[\#([A-Za-z0-9_\[\]\']+)]/i', 
												function ($m) use ($av) {
													return $av[$m[1]];
												},$sql_var);
												///////////////////////////////////
												if(trim($v['form_type'])=="box")
												{
												     $sql_var_string=$sql_var_string?$sql_var_string."\r\n".$sql_var_var:$sql_var_var; 
												}
												else
												{
												     $sql_var_string=$sql_var_string.$sql_var_var; 
												}
												
									  }	
								}//$sql_query
						}
                        //替换对应的模板信息
						if(trim($v['form_type'])=="box")
						{
							$v['setting']['box_list']=$sql_var_string?$sql_var_string:$v['setting']['box_list']; 
						}
						else
						{
							$v['setting']['default_']=$sql_var_string?$sql_var_string:($var_tem?$var_tem:$v['setting']['default_']);
						}
						
						//////////////////////////////////////////////////////////////
						if(!$v['setting']['data0'] && $v['form_type']!="image" && $v['form_type']!="images" && $v['form_type']!="datetime" && $v['form_type']!="linkage")
						{
							 $default=$v['setting']['default_'];
							 $filed_str=$filed_str. "<input name='".$v['field']."' id='".$v['field']."' type='hidden' value='".$default."' />";
						}
						else
						{
							
							if(!function_exists('get_tem')) load("field/function"); 
							if(isMobile())
							{
								$tpl_tem=get_tem($tpl_name,'field_mobile_'.$v['field']);
								$tpl_tem=$tpl_tem?$tpl_tem:get_tem($tpl_name,'globals_mobile_'.$v['form_type']);
								$tpl_tem=$tpl_tem?$tpl_tem:$v['tem_mobile_c'];
								$v['tem_c']=$tpl_tem;								
							}
							else
							{
								$tpl_tem=get_tem($tpl_name,'field_'.$v['field']);
								
								$tpl_tem=$tpl_tem?$tpl_tem:get_tem($tpl_name,'globals_'.$v['form_type']);
								$tpl_tem=$tpl_tem?$tpl_tem:$v['tem_c'];
								$v['tem_c']=$tpl_tem;
							}								

							$patterns=array('/\[title]/i','/\[field]/i','/\[remarks]/i');
							$replacements=array($v['title'],$v['field'],$v['remarks']);
							$tem_c=preg_replace($patterns,$replacements,$v['tem_c']);
							$v['tem_c']= stripslashes($tem_c);
							if(!is_array($v['setting']))$v['setting']=string2array($v['setting']);
							$form_type="show_".$v['form_type'];
							

							$filed_str=$filed_str. $this->$form_type($v,$record);				      
						}	
						 $v[id_name]="id";
						 $v[id_value]=$id;
						 $script=$script.$this->formValidator($v);			
				}
		
		}
       $script=$script_form."<script>".$script."</script>";
       return $filed_str.$script;
 
   }  
/**
* 显示单个字段的值，依靠ID创建单个字段表单
* $field_id  字段ID
* $id        记录ID
* $tem_id    显示模板ID
*/     
   function var_form_field_by_id($field_id,$id,$tem_id)
   {
       if(!$field_id || !$id) return "";
	   $Field =D('table_field');
	   $data['id']=$field_id;
	   $data['status']=1;
	   $Fields=$Field->where($data)->find();
	  
	   if($Fields)
	   { 
				unset($data);
				$M=D($Fields['table']);
				$data['id']=$id;
				$record= $M->where($data)->find();	
				if(!is_array($Fields['setting']))$Fields['setting']=string2array($Fields['setting']);
/*============================验证字段的权限===========================================*/
		        $login=$GLOBALS['LOGIN_USER'];

				if($login['admin']=="admin" && !$login['is_del'])
				{
					   $lve=$Fields['is_admin_show'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && !$login['role_id'])
					   {
					       // return "需要登陆管理权限";
						   $cur_filed['lve']=0;
					   }
					   elseif($lve && (in_array(-1,$lve) || !in_array($login['role_id'],$lve)) )
					   {
                           // return "管理员没此权限";
						   $cur_filed['lve']=0;
					   }
					   else
					   {
						    $cur_filed['type']=$Fields['form_type'];
						    $cur_filed['title']=$Fields['title'];
							$cur_filed['value']=$this->field_show($Fields,$record,$tem_id);
					   }
				}
				elseif($login['admin']=="user")
				{
					   $lve=$Fields['is_user_show'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && !$login['group_id'])
					   {
					       // return "需要登陆";
					   }
					   elseif($lve && (in_array(-1,$lve) || !in_array($login['group_id'],$lve)) )
					   {
                           // return "用户没此权限";
					   }
					   else
					   {						   
						    $cur_filed['type']=$Fields['form_type'];
						    $cur_filed['title']=$Fields['title'];
							$cur_filed['value']=$this->field_show($Fields,$record,$tem_id);
					   }
				}
				elseif(!$login)
				{
					   $lve=$Fields['is_user_show'];
					   $lve=$lve?explode(',',$lve):"";	
					   if($lve && in_array(-1,$lve))
					   {
                           // return "用户没此权限";
						   $cur_filed['lve']=0;
					   }	
					   else
					   {
						    $cur_filed['type']=$Fields['form_type'];
						    $cur_filed['title']=$Fields['title'];
							$cur_filed['value']=$this->field_show($Fields,$record,$tem_id);
					   }			  
				}
/*============================验证字段的权限===========================================*/						
	   }   
   } 
   
/**
* 显示字段值，依靠表
* $table     字段所属表
* $id        记录ID
* $tem_id    显示模板ID
*/    
   function var_form_field_by_table($table,$id,$group="",$tem_id=0)
   {
       if(!$table || !$id) return "";
       if(is_numeric($table))
		{
		    $M=D('model');
			$data['id']=$table;
			$table = $M->where($data)->getField('table');
		}
       $Fields=FF("field/field_".$table);
	   if(!$Fields) return "";
	   
		unset($data);
		$M=D($table);
		$data['id']=$id;
		$record= $M->where($data)->find();			
	    $filed_array=array();// 要返回的数组值
		
		
		foreach($Fields as $k=>$v)
		{
			   $cur_filed=array();// 单个字段值
			   if($group && $v['group']!=$group) continue;
		       if(!is_array($v['setting']))$v['setting']=string2array($v['setting']);
/*============================验证字段的权限===========================================*/
		        $login=$GLOBALS['LOGIN_USER'];

				if($login['admin']=="admin" && !$login['is_del'])
				{
					   $lve=$v['is_admin_show'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && !$login['role_id'])
					   {
						   $cur_filed['lve']=0;
					       // $filed_str=$filed_str."需要管理权限";
					   }
					   elseif($lve && (in_array(-1,$lve) || !in_array($login['role_id'],$lve)) )
					   {
						   $cur_filed['lve']=0;
                           // $filed_str=$filed_str."管理员没此权限";
					   }
					   else
					   {
						    $cur_filed['type']=$v['form_type'];
						    $cur_filed['title']=$v['title'];
							$cur_filed['value']=$this->field_show($v,$record,$tem_id);
					   }
				}
				elseif($login['admin']=="user")
				{
					   $lve=$v['is_user_show'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && !$login['group_id'])
					   {
						   $cur_filed['lve']=0;
					       // $filed_str=$filed_str."请先登录";
					   }
					   elseif($lve && (in_array(-1,$lve) || !in_array($login['group_id'],$lve)) )
					   {
						   $cur_filed['lve']=0;
                           // $filed_str=$filed_str."此会员组无次权限";
					   }
					   else
					   {
						    $cur_filed['type']=$v['form_type'];
					        $cur_filed['title']=$v['title'];
							$cur_filed['value']=$this->field_show($v,$record,$tem_id);
					   }
				}
				elseif(!$login)
				{
					   $lve=$v['is_user_show'];
					   $lve=$lve?explode(',',$lve):"";
					   if($lve && in_array(-1,$lve))
					   {
						   $cur_filed['lve']=-1;
                           // return "用户没此权限";
					   }	
					   else
					   {
						   $cur_filed['type']=$v['form_type'];
						   $cur_filed['title']=$v['title'];
						   $cur_filed['value']=$this->field_show($v,$record,$tem_id);
					   }			  
				}
/*============================验证字段的权限===========================================*/		
			
				$filed_array[]=	$cur_filed;	
		
		}

       return $filed_array;
 
   }     
    /**
     * 创建text表单自动
     */   
   function create_text()
   {
   
         $setting=$this->SETTING;
         if($setting['type_num'])//是否为数字
		 {
		      $decimal=is_numeric($setting['decimal'])?intval($setting['decimal']):0;
			  $num_min=is_numeric($setting['num_min'])?intval($setting['num_min']):0;
			  $num_max=is_numeric($setting['num_max'])?intval($setting['num_max']):0;
		      if($decimal>0)
			  {
			       $type_num="FLOAT(15,$decimal)";
			  }
			  else
			  {
			       if($num_min!=0 && $num_max==0)
				   {
				        $type_num="int";
				   }
				   else if($num_min=0 && $num_max==0)
				   {
				        $type_num="bigint"; 
				   }				  
			       else if(($num_min>-128 && $num_max<=127) ||  ($num_min>0 && $num_max<=255))
				   {
				        $type_num="tinyint";
				   }
				   else if(($num_min>-32768 && $num_max<=32767) || ($num_min>0 && $num_max<=65535))
				   {
				        $type_num="smallint";
				   }
				   else if(($num_min>-8388608 && $num_max<=8388607) || ($num_min>0 && $num_max<=16777215))
				   {
				        $type_num="mediumint";
				   }
				   else if(($num_min>-2147483648 && $num_max<=2147483647) || ($num_min>0 && $num_max<=4294967295))
				   {
				        $type_num="int";
				   }
				   else
				   {
				        $type_num="bigint"; 
				   }
			  }
			  $signed=$num_min<=0?"":" UNSIGNED ";
			  $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` $type_num  $signed  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' $this->UNIQUE";
		 }
		 else//字符串
		 {
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' $this->UNIQUE";
		 
		 }
         $Field= M();
		 if($this->describe($this->FIELD,$this->TABLE))
		 {
		     return 0;             	 
		 }
		 else
		 {
			 return $Field->execute($sql);
		 }
		 
   }
   
   /**
     * 编辑text表单自动
     */   
   function edit_text()
   {
         $setting=$this->SETTING;
         if($setting['type_num'])//是否为数字
		 {
		      $decimal=is_numeric($setting['decimal'])?intval($setting['decimal']):0;
			  $num_min=is_numeric($setting['num_min'])?intval($setting['num_min']):0;
			  $num_max=is_numeric($setting['num_max'])?intval($setting['num_max']):0;
		      if($decimal>0)
			  {
			       $type_num="FLOAT(15,$decimal)";
			  }
			  else
			  {
			       if($num_min!=0 && $num_max==0)
				   {
				        $type_num="int";
				   }
				   else if($num_min=0 && $num_max==0)
				   {
				        $type_num="bigint"; 
				   }				  
			       else if(($num_min>-128 && $num_max<=127) ||  ($num_min>0 && $num_max<=255))
				   {
				        $type_num="tinyint";
				   }
				   else if(($num_min>-32768 && $num_max<=32767) || ($num_min>0 && $num_max<=65535))
				   {
				        $type_num="smallint";
				   }
				   else if(($num_min>-8388608 && $num_max<=8388607) || ($num_min>0 && $num_max<=16777215))
				   {
				        $type_num="mediumint";
				   }
				   else if(($num_min>-2147483648 && $num_max<=2147483647) || ($num_min>0 && $num_max<=4294967295))
				   {
				        $type_num="int";
				   }
				   else
				   {
				        $type_num="bigint"; 
				   }
			  }
			  $signed=$num_min<=0?"":" UNSIGNED ";
			  $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` $type_num  $signed  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 }
		 else//字符串
		 {
		      $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 
		 }

		 if($this->UNIQUE)
		 {
		     $this->add_index($this->OLD_FIELD,$this->TABLE);
		 }
		 else
		 {
		     $this->del_index($this->OLD_FIELD,$this->TABLE);
		 }
		 
		
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   }  
   
   
   
   
      /**
     * 创建textarea表单自动
     */   
   function create_textarea()
   {
   
		$sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL COMMENT '$this->REMARKS'";

         $Field= M();
		 if($this->describe($this->FIELD,$this->TABLE))
		 {
		     return 0;             	 
		 }
		 else
		 {
			 return $Field->execute($sql);
		 }
		 
   }
   
   /**
     * 编辑textarea表单自动
     */   
   function edit_textarea()
   {

		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL  COMMENT '$this->REMARKS'";

         $Field= M();
		 return $Field->execute($sql);          	 
		 
   } 


      /**
     * 创建editor表单自动
     */   
   function create_editor()
   {
   
		$sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL COMMENT '$this->REMARKS'";

         $Field= M();
		 if($this->describe($this->FIELD,$this->TABLE))
		 {
		     return 0;             	 
		 }
		 else
		 {
			 return $Field->execute($sql);
		 }
		 
   }
   
   /**
     * 编辑editor表单自动
     */   
   function edit_editor()
   {

		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL COMMENT '$this->REMARKS'";

         $Field= M();
		 return $Field->execute($sql);          	 
		 
   }  
     /**
     * 创建box表单自动
     */   
   function create_box()
   {
   
         $setting=$this->SETTING;
         if($setting['type_num'])//是否为数字
		 {
		      $decimal=is_numeric($setting['decimal'])?intval($setting['decimal']):0;
			  $num_min=is_numeric($setting['num_min'])?intval($setting['num_min']):0;
			  $num_max=is_numeric($setting['num_max'])?intval($setting['num_max']):0;
			  $type_num=$decimal?"FLOAT(15,$decimal)":"int";
			  $signed=$num_min<=0?"":" UNSIGNED ";
			  $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` $type_num  $signed  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' $this->UNIQUE";
		 }
		 else//字符串
		 {
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' ";
		 
		 }
         $Field= M();
		 if($this->describe($this->FIELD,$this->TABLE))
		 {
		     return 0;             	 
		 }
		 else
		 {
			 return $Field->execute($sql);
		 }
		 
   }
   
   /**
     * 编辑box表单自动
     */   
   function edit_box()
   {
         $setting=$this->SETTING;
         if($setting['type_num'])//是否为数字
		 {
		      $decimal=is_numeric($setting['decimal'])?intval($setting['decimal']):0;
			  $num_min=is_numeric($setting['num_min'])?intval($setting['num_min']):0;
			  $num_max=is_numeric($setting['num_max'])?intval($setting['num_max']):0;
              $type_num=$decimal?"FLOAT(15,$decimal)":"int";
			  $signed=$num_min<=0?"":" UNSIGNED ";
			  $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` $type_num  $signed  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 }
		 else//字符串
		 {
		      $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD`  VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 
		 }

		 if($this->UNIQUE)
		 {
		     $this->add_index($this->OLD_FIELD,$this->TABLE);
		 }
		 else
		 {
		     $this->del_index($this->OLD_FIELD,$this->TABLE);
		 }
		 
		
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   } 
   
   
     /**
     * 创建image表单自动
     */   
   function create_image()
   {
   
   
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' ";
		 
		
         $Field= M();
		 return $Field->execute($sql);
		 
   }
   
   /**
     * 编辑image表单自动
     */   
   function edit_image()
   {
  
		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD`  VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   } 
   
    /**
     * 创建images表单自动
     */   
   function create_images()
   {
   
   
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL COMMENT '$this->REMARKS' ";
		 
		
         $Field= M();
		 return $Field->execute($sql);
		 
   }
   
   /**
     * 编辑images表单自动
     */   
   function edit_images()
   {
  
		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL  COMMENT '$this->REMARKS'";
		
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   }
   
    /**
     * 创建datetime表单自动
     */   
   function create_datetime()
   {
   
         $setting=$this->SETTING;
		 $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` int(11)  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 if($setting[datetime_type]==2)
		 {
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `".$this->FIELD."_start` int(11)  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS', ADD `".$this->FIELD."_end` int(11)  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 }
		 
		
         $Field= M();
		 return $Field->execute($sql);
		 
   }
   
   /**
     * 编辑datetime表单自动
     */   
   function edit_datetime()
   {
         $setting=$this->SETTING;
		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` int(11) $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		if($setting[datetime_type]==2)
		{
		     $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `".$this->OLD_FIELD."_start` `".$this->FIELD."_start` int(11) $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS', CHANGE `".$this->OLD_FIELD."_end` `".$this->FIELD."_end` int(11) $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		}
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   }
   
   
     /**
     * 创建linkage表单自动
     */   
   function create_linkage()
   {
   
   
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' ";
		 
		
         $Field= M();
		 return $Field->execute($sql);
		 
   }
   
   /**
     * 编辑linkage表单自动
     */   
   function edit_linkage()
   {
  
		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD`  VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   }
   
    /**
     * 创建downfiles表单自动
     */   
   function create_downfiles()
   {
   
   
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL COMMENT '$this->REMARKS' ";
		 
		
         $Field= M();
		 return $Field->execute($sql);
		 
   }
   
   /**
     * 编辑downfiles表单自动
     */   
   function edit_downfiles()
   {
  
		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` text CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL  COMMENT '$this->REMARKS'";
		
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   } 
   
   
    /**
     * 创建map表单自动
     */   
   function create_map()
   {
         $Field= M();
		 $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `".$this->FIELD."_map_x` FLOAT(15,8)  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS', ADD `".$this->FIELD."_map_y` FLOAT(15,8)  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 return $Field->execute($sql);
		 
   }
   
   /**
     * 编辑map表单自动
     */   
   function edit_map()
   {
         $Field= M();
		 $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `".$this->OLD_FIELD."_map_x` `".$this->FIELD."_map_x` FLOAT(15,8) $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS', CHANGE `".$this->OLD_FIELD."_map_y` `".$this->FIELD."_map_y` FLOAT(15,8) $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 return $Field->execute($sql);          	 
		 
   }
   
   
    /**
     * 创建omnipotent表单自动
     */   
   function create_omnipotent()
   {
   
         $setting=$this->SETTING;
         if($setting['type_num'])//是否为数字
		 {
		      $decimal=is_numeric($setting['decimal'])?intval($setting['decimal']):0;
			  $num_min=is_numeric($setting['num_min'])?intval($setting['num_min']):0;
			  $num_max=is_numeric($setting['num_max'])?intval($setting['num_max']):0;
		      if($decimal>0)
			  {
			       $type_num="FLOAT(15,$decimal)";
			  }
			  else
			  {
			       if($num_min!=0 && $num_max==0)
				   {
				        $type_num="int";
				   }	
				   else if($num_min=0 && $num_max==0)
				   {
				        $type_num="bigint"; 
				   }			  
			       else if(($num_min>-128 && $num_max<=127) ||  ($num_min>0 && $num_max<=255))
				   {
				        $type_num="tinyint";
				   }
				   else if(($num_min>-32768 && $num_max<=32767) || ($num_min>0 && $num_max<=65535))
				   {
				        $type_num="smallint";
				   }
				   else if(($num_min>-8388608 && $num_max<=8388607) || ($num_min>0 && $num_max<=16777215))
				   {
				        $type_num="mediumint";
				   }
				   else if(($num_min>-2147483648 && $num_max<=2147483647) || ($num_min>0 && $num_max<=4294967295))
				   {
				        $type_num="int";
				   }
				   else
				   {
				        $type_num="bigint"; 
				   }
			  }
			  $signed=$num_min<=0?"":" UNSIGNED ";
			  $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` $type_num  $signed  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' $this->UNIQUE";
		 }
		 else//字符串
		 {
		      $sql="ALTER TABLE `$this->TRUE_TABLE` ADD `$this->FIELD` VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS' $this->UNIQUE";
		 
		 }
         $Field= M();
		 if($this->describe($this->FIELD,$this->TABLE))
		 {
		     return 0;             	 
		 }
		 else
		 {
			 return $Field->execute($sql);
		 }
		 
   }
   
   /**
     * 编辑omnipotent表单自动
     */   
   function edit_omnipotent()
   {
         $setting=$this->SETTING;
         if($setting['type_num'])//是否为数字
		 {
		      $decimal=is_numeric($setting['decimal'])?intval($setting['decimal']):0;
			  $num_min=is_numeric($setting['num_min'])?intval($setting['num_min']):0;
			  $num_max=is_numeric($setting['num_max'])?intval($setting['num_max']):0;
		      if($decimal>0)
			  {
			       $type_num="FLOAT(15,$decimal)";
			  }
			  else
			  {
			       if($num_min!=0 && $num_max==0)
				   {
				        $type_num="int";
				   }	
				   else if($num_min=0 && $num_max==0)
				   {
				        $type_num="bigint"; 
				   }		  
			       else if(($num_min>-128 && $num_max<=127) ||  ($num_min>0 && $num_max<=255))
				   {
				        $type_num="tinyint";
				   }
				   else if(($num_min>-32768 && $num_max<=32767) || ($num_min>0 && $num_max<=65535))
				   {
				        $type_num="smallint";
				   }
				   else if(($num_min>-8388608 && $num_max<=8388607) || ($num_min>0 && $num_max<=16777215))
				   {
				        $type_num="mediumint";
				   }
				   else if(($num_min>-2147483648 && $num_max<=2147483647) || ($num_min>0 && $num_max<=4294967295))
				   {
				        $type_num="int";
				   }
				   else
				   {
				        $type_num="bigint"; 
				   }
			  }
			  $signed=$num_min<=0?"":" UNSIGNED ";
			  $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` $type_num  $signed  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 }
		 else//字符串
		 {
		      $sql="ALTER TABLE `$this->TRUE_TABLE` CHANGE `$this->OLD_FIELD` `$this->FIELD` VARCHAR(255) CHARACTER SET $this->CHARSET COLLATE $this->CHARSET_  $this->NULL DEFAULT '$this->DEFAULT' COMMENT '$this->REMARKS'";
		 
		 }

		 if($this->UNIQUE)
		 {
		     $this->add_index($this->OLD_FIELD,$this->TABLE);
		 }
		 else
		 {
		     $this->del_index($this->OLD_FIELD,$this->TABLE);
		 }
		 
		
         $Field= M();
		 return $Field->execute($sql);          	 
		 
   }  
   
    
   	 /**
	 * save字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function field_save($Fields)
   {
        $len_min=$Fields[setting][len_min]?$Fields[setting][len_min]:0;
		$len_max=$Fields[setting][len_max]?$Fields[setting][len_max]:0;
		$num_min=$Fields[setting][num_min]?$Fields[setting][num_min]:0;
		$num_max=$Fields[setting][num_max]?$Fields[setting][num_max]:0;
		$feild=trim($Fields[field]);
		$type_num=$Fields[setting][type_num]?$Fields[setting][type_num]:0;
		$title=trim($Fields[title]);
		$form_type=$Fields[form_type]?$Fields[form_type]:"";
		// echo $feild."[$form_type]".strlen($_POST[$feild])."<BR>";
		switch ($form_type)
		{
		case "text":
			  $this->return_err($title,$feild,$len_min,$len_max,$num_min,$num_max,$type_num);
			  break;  
		case "textarea":
              $this->return_err($title,$feild,$len_min,$len_max);
			  if(!$Fields[setting][html])
			  {
			      $_POST[$feild]=strip_tags($_POST[$feild]);
			  }
			  break;  
		case "editor":
              $this->return_err($title,$feild,$len_min,$len_max);
			  break; 
		case "box":
		      if(is_array($_POST[$feild]))
			  {
			      $_POST[$feild]=implode(",",$_POST[$feild]);
			  }
              $this->return_err($title,$feild,$len_min,$len_max,$num_min,$num_max,$type_num);
			  break;
		case "image":
              $this->return_err($title,$feild,$len_min,$len_max);
			  break; 
		case "images":
			  $images_num=trim($_POST[$feild])?count(explode(',',trim($_POST[$feild]))):0; 
			  if($len_min && $images_num<$len_min)
			  {
			      $this->error(L('IMAGES_LEN_MIN',array('title'=>$title,'len_min'=>$len_min)),"",$this->r_time);
			  }
			  
			  if($len_max && $images_num>$len_max)
			  {
			      $this->error(L('IMAGES_LEN_MAX',array('title'=>$title,'len_max'=>$len_max)),"",$this->r_time);
			  }
			  break;
		case "datetime":		
		      if($Fields[setting][datetime_type]==1)
			  {
			        if($len_min && !trim($_POST[$feild]))
					{
					     $this->error($title.L('O_EMPTY'),"",$this->r_time);
					}
					$_POST[$feild]=strtotime($_POST[$feild]);
					
			  }
			  else if($Fields[setting][datetime_type]==2)
			  {
			        if($len_min && (!trim($_POST[$feild."_start"]) || !trim($_POST[$feild."_end"])) )
					{
					     $this->error($title.L('O_EMPTY'),"",$this->r_time);
					}		
					
					$_POST[$feild."_start"]=strtotime($_POST[$feild."_start"]);	  
					$_POST[$feild."_end"]=strtotime($_POST[$feild."_end"]);	 
			  }
			  break; 
		case "linkage":		
			  $_POST[$feild]=$_POST[$feild]?linkage_id($_POST[$feild]):0;
			  break;       
		default:
		}
   } 
   
     	 /**
	 * 展示字段值
	 * @access String $Fields   字段信息
	 * @access String $record  字段记录
	 * @access String $tem_id   模板ID
	 * @return String  
	 */
   function field_show($Fields,$record,$tem_id="")
   {
        $show_tem=$Fields['show_tem']?string2array(stripslashes($Fields['show_tem'])):"";
		$show_tem_c="";
		$show_tem_c_t=$tem_id?$show_tem[$tem_id]:"";//临时存放模板内容
        if($show_tem_c_t)
		{
			$patterns=array('/\[title]/i','/\[field]/i','/\[remarks]/i');
			$replacements=array($Fields['title'],$Fields['field'],$Fields['remarks']);
			$show_tem_c=preg_replace($patterns,$replacements,$show_tem_c_t);
		}
		$form_type=$Fields[form_type]?$Fields[form_type]:"";
		$value=$record[$Fields['field']];
		switch ($form_type)
		{
		case "text":
				$Fields[setting][default_]=$value;
				if($show_tem_c)
				{
					$field_tem=preg_replace_callback('/\[(\w+)]/i', 
					function ($m) use ($Fields) {
						return $Fields[setting][$m[1]];
					},$show_tem_c);
					
					
					
					return htmlspecialchars_decode(stripslashes($field_tem)); 
				}
				else
				{
				    return htmlspecialchars_decode($value);
				}
			  break;  
		case "textarea":
				$Fields[setting][default_]=$value;
				if($show_tem_c)
				{
					$field_tem=preg_replace_callback('/\[(\w+)]/i', 
					function ($m) use ($Fields) {
						return $Fields[setting][$m[1]];
					},$show_tem_c);
					
					return htmlspecialchars_decode(stripslashes($field_tem));  
				}
				else
				{
				    return htmlspecialchars_decode($value);
				}
			  break; 
		case "editor":
				$Fields[setting][default_]=$value;
				if($show_tem_c)
				{
					$field_tem=preg_replace_callback('/\[(\w+)]/i', 
					function ($m) use ($Fields) {
						return $Fields[setting][$m[1]];
					},$show_tem_c);
					
					return htmlspecialchars_decode(stripslashes($field_tem)); 
				}
				else
				{
				    return htmlspecialchars_decode($value);
				}
				
			  break; 
		case "box":
				$Fields[setting][default_]=$value;
				if($show_tem_c)
				{
						$form_con=preg_replace_callback('/(\[loop])(.*)(\[\/loop])/si',
						function ($m) use ($Fields) {
								if(!$Fields['setting']['box_list']) return "";
								$box_array=array();
								$box_array=explode("\r\n", $Fields['setting']['box_list']);
								$box_str="";
								foreach($box_array as $k=>$v)
								{
									 $box_op=explode("=",$v);
									 if(count($box_op)<=0)
									 {
										 $op['text']=$op['value']=$box_op[0];
									 }
									 else
									 {
										  $op['text']=$box_op[0];
										  $op['value']=$box_op[1];  
									 }
									  $array=explode(",",$Fields['setting']['default_']);
									  if(in_array($op['value'],$array))
									  {
										  $box_list=$box_list.preg_replace_callback('/\[(\w+)]/i', 
										  function ($k) use ($op) {
											  return $op[$k[1]];
										  },$m[2]);
									  }									  
								}
								return $box_list;
						},$show_tem_c);
						$field_tem=preg_replace_callback('/\[(\w+)]/i', 
						function ($m) use ($Fields) {
							return $Fields[setting][$m[1]];
						},$form_con);
								
						return stripslashes($field_tem); 
				}
				else
				{
						  $array=explode(",",$Fields['setting']['default_']);
						  $box_array=array();
						  $box_array=explode("\r\n", $Fields['setting']['box_list']);
						  foreach($box_array as $v)
						  {
						       		 $box_op=explode("=",$v);
									 if(count($box_op)<=0)
									 {
										 $op['text']=$op['value']=$box_op[0];
									 }
									 else
									 {
										  $op['text']=$box_op[0];
										  $op['value']=$box_op[1];  
									 }
									 if(in_array($op['value'],$array))
									 {
                                          $field_tem=$field_tem.($field_tem ? " , ".$op['text']:$op['text']);
									 }		 
						  }
						  return $field_tem; 
				}
			  break;
		case "image":
				$Fields[setting][default_]=$value;
				if($show_tem_c)
				{
					$field_tem=preg_replace_callback('/\[(\w+)]/i', 
					function ($m) use ($Fields) {
						return $Fields[setting][$m[1]];
					},$show_tem_c);
					
					return stripslashes($field_tem);
				}
				else
				{
				    return $value;
				}
			  break; 
		case "images":
				$Fields[setting][default_]=$value;
				if($show_tem_c)
				{
						$form_con=preg_replace_callback('/(\[loop])(.*)(\[\/loop])/si',
						function ($m) use ($Fields) {
						      if($Fields['setting']['default_'])
							  {
								  $array=explode(",",$Fields['setting']['default_']);
								  foreach($array as $v)
								  {
									  $images=$images.($v?preg_replace('/\[default_]/i',$v,$m[2]):"");
								  }									  
									return $images;
							  }
							  else
							  {
							       return "";
							  }
						},$show_tem_c);
						$field_tem=preg_replace_callback('/\[(\w+)]/i', 
						function ($m) use ($Fields) {
							return $Fields[setting][$m[1]];
						},$form_con);
								
						return stripslashes($field_tem); 
				}
				else
				{
						      if($Fields['setting']['default_'])
							  {
								  $array=explode(",",$Fields['setting']['default_']);
								  foreach($array as $v)
								  {
									  $images=$images.($v?","+$v:"");
								  }									  
									return $images;
							  }
							  else
							  {
							       return "";
							  }
				}
			  break;
		case "datetime":	
			  $datetime_time=$Fields[setting][datetime_time];	
			  $Fields[setting][default_]=$value?(($datetime_time==1)?date("Y-m-d H:m:s",$value):date("Y-m-d",$value)):"";	
			  $Fields[setting][default_start]=$record[default_start]?(($datetime_time==1)?date("Y-m-d H:m:s",$record[default_start]):date("Y-m-d",$record[default_start])):"";
			  $Fields[setting][default_end]=$record[default_end]?(($datetime_time==1)?date("Y-m-d H:m:s",$record[default_end]):date("Y-m-d",$record[default_end])):"";
              
				if($show_tem_c)
				{
					$field_tem=preg_replace_callback('/\[(\w+)]/i', 
					function ($m) use ($Fields) {
						return $Fields[setting][$m[1]];
					},$show_tem_c);
					
					return stripslashes($field_tem);
				}
				else
				{
					  if($Fields[setting][datetime_type]==1)
					  {
							return $Fields[setting][default_];
					  }
					  else if($Fields[setting][datetime_type]==2)
					  {
                            return $Fields[setting][default_start]." 到 ".$Fields[setting][default_end];
					  }
				}
			  break;       
		default:
		}
   }   
   
   	 /**
	 * 字段验证
	 */
   function return_err($title,$feild,$len_min=0,$len_max=0,$num_min=0,$num_max=0,$type_num=0)
   {
			  if($len_min && $len_max && (strlen($_POST[$feild])<$len_min || strlen($_POST[$feild])>$len_max))
			  {
				  
				  $this->error(L('STRING_LEN',array('title'=>$title,'len_min'=>$len_min,'len_max'=>$len_max)),"",$this->r_time);
			  }
			  else if($len_min==1 && strlen($_POST[$feild])<1)
			  {
				  $this->error($title.L('O_EMPTY'),"",$this->r_time);
			  } 
			  else if($len_min && strlen($_POST[$feild])<$len_min)
			  {
				  $this->error(L('SAVE_LEN_MIN',array('title'=>$title,'len_min'=>$len_min)),"",$this->r_time);
			  } 
			  else if($len_max &&  strlen($_POST[$feild])>$len_max)
			  {
				  $this->error(L('SAVE_LEN_MAX',array('title'=>$title,'len_max'=>$len_max)),"",$this->r_time);
			  }  
			  if($type_num)
			  {
				  if($num_min && $num_max && (strlen($_POST[$feild])<$num_min || strlen($_POST[$feild])>$num_max))
				  {
					  
					  $this->error(L('NUM_LEN',array('title'=>$title,'num_min'=>$num_min,'num_max'=>$num_max)),"",$this->r_time);
				  }
				  else if($num_min && strlen($_POST[$feild])<$num_min)
				  {
					  $this->error(L('SAVE_LEN_MAX',array('title'=>$title,'num_min'=>$num_min)),"",$this->r_time);
				  } 
				  else if($num_max &&  strlen($_POST[$feild])>$num_max)
				  {
					  $this->error(L('SAVE_LEN_MAX',array('title'=>$title,'num_max'=>$num_max)),"",$this->r_time);
				  }  
			  }       
   }   
   	 /**
	 * 显示text字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function show_text($Fields,$record)
   {
			$Fields[setting][default_]=$record?$record[$Fields[field]]:$Fields[setting][default_];
			/*$Fields[setting][form]="<input name='".$Fields[field]."' id='".$Fields[field]."' type='text' css='".$Fields[setting][css]."' value='".$Fields[setting][default_]."' ".$Fields[setting][property]."  />";*/
			$field_tem=preg_replace_callback('/\[(\w+)]/i', 
			function ($m) use ($Fields) {
				return $Fields[setting][$m[1]];
			},$Fields['tem_c']);
			return stripslashes($field_tem); 
   }
   
      
   	 /**
	 * 显示textarea字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function show_textarea($Fields,$record)
   {
        $Fields[setting][default_]=$record?$record[$Fields[field]]:$Fields[setting][default_];
		/*$Fields[setting][form]="<textarea  name='".$Fields[field]."' id='".$Fields[field]."' type='text' css='".$Fields[setting][css]."' ".$Fields[setting][property]." >".$Fields[setting][default_]."</textarea>";*/
		$field_tem=preg_replace_callback('/\[(\w+)]/i', 
		function ($m) use ($Fields) {
            return $Fields[setting][$m[1]];
        },$Fields['tem_c']);
		
		$field_tem1=preg_replace('/<\/\*textarea>/i',"</textarea>",$field_tem);
				
		return stripslashes($field_tem1); 
   }   
   
   
   
   	 /**
	 * 显示box字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function show_box($Fields,$record)
   {
        $Fields[setting][default_]=$record?$record[$Fields[field]]:$Fields[setting][default_];
        $form_con=preg_replace_callback('/(\[loop])(.*)(\[\/loop])/si',
		function ($m) use ($Fields) {
				if(!$Fields['setting']['box_list']) return "";
				$box_array=array();
				$box_array=explode("\r\n", $Fields['setting']['box_list']);
				$box_str="";
				foreach($box_array as $k=>$v)
				{
				     $checked="";
					 $box_op=explode("=",$v);
					 if(count($box_op)<=0)
					 {
						 $op['text']=$op['value']=$box_op[0];
					 }
					 else
					 {
						  $op['text']=$box_op[0];
						  $op['value']=$box_op[1];  
					 }
					  if(!$Fields['setting']['format']) $op['text']=$op['value'];
					  $array=explode(",",$Fields['setting']['default_']);
                      if(in_array($op['value'],$array))
					  {
					     $checked=preg_replace(array("/<option/",'/<input/'),array("<option selected ","<input checked "),$m[2]);
					  }
					  else
					  {
					     $checked=$m[2];
					  }
					
					 $box_list=$box_list.preg_replace_callback('/\[(\w+)]/i', 
					  function ($k) use ($op) {
						  return $op[$k[1]];
					  },$checked);
					  
				}
				return $box_list;
        },$Fields['tem_c']);
        $Fields['tem_c']=$form_con;
		$field_tem=preg_replace_callback('/\[(\w+)]/i', 
		function ($m) use ($Fields) {
            return $Fields[setting][$m[1]];
        },$Fields['tem_c']);
				
		return stripslashes($field_tem); 
   }     
    /**
	 * 显示editor字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function show_editor($Fields,$record)
   {
        $Fields[setting][default_]=$record?$record[$Fields[field]]:$Fields[setting][default_];
		$allow_type=$Fields[setting]['allow_type']?$Fields[setting]['allow_type']:"jpeg|jpg|png|gif";
		$water=$Fields[setting]['water']?$Fields[setting]['water']:0;
		$w=$Fields[setting][width]?"width:".$Fields[setting][width].",":"";
		$Fields[setting][editor_simplify]="<script type='text/javascript' src='".__ROOT__."/Public/ckeditor/ckeditor.js'></script><script type=\"text/javascript\">CKEDITOR.replace( '".$Fields[field]."' ,  
{  
height:".$Fields[setting][height].",".$w." 
filebrowserBrowseUrl : '".__ROOT__."/index.php/File/Upload/index/editor/1.php',  
filebrowserImageBrowseUrl : '".__ROOT__."/index.php/File/Upload/index/editor/1.php',  
filebrowserFlashBrowseUrl : '".__ROOT__."/index.php/File/Upload/index/editor/1.php',  
filebrowserUploadUrl : '".__ROOT__."/index.php/File/Upload/upload/water/".$water."/type/rar|zip|doc|xls|txt|jpg|png|gif|jpeg.php',  
filebrowserImageUploadUrl : '".__ROOT__."/index.php/File/Upload/upload/water/".$water.".php',  
filebrowserFlashUploadUrl : '".__ROOT__."/index.php/File/Upload/upload/water/".$water."/type/swf.php' ,
toolbar :
[
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
] 
});</script>";

		$Fields[setting][editor_standard]="<script type='text/javascript' src='".__ROOT__."/Public/ckeditor/ckeditor.js'></script><script type=\"text/javascript\">CKEDITOR.replace( '".$Fields[field]."' ,  
{ 
height:".$Fields[setting][height].",".$w." 
filebrowserBrowseUrl : '".__ROOT__."/index.php/File/Upload/index/editor/1.php',  
filebrowserImageBrowseUrl : '".__ROOT__."/index.php/File/Upload/index/editor/1.php',  
filebrowserFlashBrowseUrl : '".__ROOT__."/index.php/File/Upload/index/editor/1.php',  
filebrowserUploadUrl : '".__ROOT__."/index.php/File/Upload/upload/water/".$water."/type/rar|zip|doc|xls|txt|jpg|png|gif|jpeg.php',  
filebrowserImageUploadUrl : '".__ROOT__."/index.php/File/Upload/upload/water/".$water.".php',  
filebrowserFlashUploadUrl : '".__ROOT__."/index.php/File/Upload/upload/water/".$water."/type/swf.php' ,
toolbar :
[
		{ name: 'document', items: [ 'Source'] },
		{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule'] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
] 
});</script>";
		$field_tem=preg_replace_callback('/\[(\w+)]/i', 
		function ($m) use ($Fields) {
            return $Fields[setting][$m[1]];
        },$Fields['tem_c']);
		$field_tem1="<textarea name='$Fields[field]'  id='$Fields[field]' >".$Fields[setting][default_]."</textarea>".$field_tem;				
		return $field_tem1; 
   }  
   
   	 /**
	 * 显示image字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function show_image($Fields,$record)
   {
		$Fields[setting][default_]=$record?$record[$Fields[field]]:$Fields[setting][default_];
		
		$Fields[setting][oneve]="onclick=\"selectFile({name:'".$Fields[field]."',water:'".$Fields[setting]['water']."',type:'".$Fields[setting]['allow_type']."',method:'0',size:'".$Fields[setting][size]."',root_path:'".C('root_path')."'})\"";
		$field_tem=preg_replace_callback('/\[(\w+)]/i', 
		function ($m) use ($Fields) {
            return $Fields[setting][$m[1]];
        },$Fields['tem_c']);
				
		return "<script type='text/javascript' src='".C('TMPL_PARSE_STRING.__STATIC__')."js/upload.js'></script>".stripslashes($field_tem); 
   }
   
    /**
	 * 显示images字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function show_images($Fields,$record)
   {
		$Fields[setting][default_]=$record?$record[$Fields[field]]:$Fields[setting][default_];
		$Fields[setting][oneve]="onclick=\"selectFiles({name:'".$Fields[field]."',water:'".$Fields[setting]['water']."',type:'".$Fields[setting]['allow_type']."',method:'0',len_max:'".$Fields[setting][len_max]."',size:'".$Fields[setting][size]."',root_path:'".C('root_path')."'})\"";
		$field_tem=preg_replace_callback('/\[(\w+)]/i', 
		function ($m) use ($Fields) {
            return $Fields[setting][$m[1]];
        },$Fields['tem_c']);	
		return "<script type='text/javascript'  src='".C('TMPL_PARSE_STRING.__STATIC__')."js/upload.js'></script><textarea name='".$Fields[field]."' id='".$Fields[field]."' style='display:none' >".$Fields[setting][default_]."</textarea>".stripslashes($field_tem)."<script>show_images('$Fields[field]')</script>"; 
   }  
   
      	 /**
	 * 显示datetime字段
	 * @access String $Fields   字段信息
	 * @return String  
	 */
   function show_datetime($Fields,$record)
   { 
		$prev_days=trim($Fields[setting][prev_days])?"'prev-days':[".$Fields[setting][prev_days]."]":"'prev-days':null";
		$next_days=trim($Fields[setting][next_days])?"'next-days':[".$Fields[setting][next_days]."]":"'next-days':null";
		
		$prev_week=trim($Fields[setting][prev_week])?"'".$Fields[setting][prev_week]."',":"";
		$prev_month=trim($Fields[setting][prev_month])?"'".$Fields[setting][prev_month]."',":"";
		$prev_year=trim($Fields[setting][prev_year])?"'".$Fields[setting][prev_year]."'":"";
		$next_week=trim($Fields[setting][next_week])?"'".$Fields[setting][next_week]."',":"";
		$next_month=trim($Fields[setting][next_month])?"'".$Fields[setting][next_month]."',":"";
		$next_year=trim($Fields[setting][next_year])?"'".$Fields[setting][next_year]."'":"";
		
		$prev=($prev_week || $prev_month || $prev_year)?"'prev':[".$prev_week.$prev_month.$prev_year."]":"'prev':null";
		$next=($next_week || $next_month || $next_year)?"'next':[".$next_week.$next_month.$next_year."]":"'next':null";
		
		if($Fields[setting][datetime_time]==1)
		{
		    $format="format: 'YYYY-MM-DD HH:mm',time: {enabled: true},";
			$format_php='Y-m-d H:i:s';
		}
		else
		{
		    $format="format: 'YYYY-MM-DD',";
			$format_php='Y-m-d';
		}
		$config=($Fields[setting][prev_days]|| $Fields[setting][next_days] || $Fields[setting][prev_week] || $Fields[setting][prev_month] || $Fields[setting][prev_year] || $Fields[setting][next_week] || $Fields[setting][next_month] || $Fields[setting][next_year])?"shortcuts : {".$prev_days.",".$prev.",".$next_days.",".$next."},":"showShortcuts: false,";
		$config=$config.($Fields[setting][close_type]?"autoClose: true,":"autoClose: false,");
		$config=$config."$format language: 'cn',";	
		
		if($Fields[setting][datetime_type]==2)
		{
		    $config=$config."separator : ' 到 ',
						getValue: function()
						{
							if ($('#".$Fields[field]."_start').val() && $('#".$Fields[field]."_end').val() )
								return $('#".$Fields[field]."_start').val() + ' to ' + $('#".$Fields[field]."_end').val();
							else
								return '';
						},
						setValue: function(s,s1,s2)
						{
							$('#".$Fields[field]."_start').val(s1);
							$('#".$Fields[field]."_end').val(s2);
						}";
			$record[$Fields[field]."_start"]=$record[$Fields[field]."_start"]?$record[$Fields[field]."_start"]:time();
			$record[$Fields[field]."_end"]=$record[$Fields[field]."_end"]?$record[$Fields[field]."_end"]:time();
			$Fields[setting][default_start]=date($format_php,$record[$Fields[field]."_start"]);
		    $Fields[setting][default_end]=date($format_php,$record[$Fields[field]."_end"]);
		}
		else
		{
		     $config=$config."singleDate : true";
			 $Fields[setting][default_]=$Fields[setting][default_]?$Fields[setting][default_]:time();
			 $Fields[setting][default_]=$record?date($format_php,($record[$Fields[field]]?$record[$Fields[field]]:time())):$Fields[setting][default_];
		
		}
		$field_tem=preg_replace_callback('/\[(\w+)]/i', 
		function ($m) use ($Fields) {
            return $Fields[setting][$m[1]];
        },$Fields['tem_c']);
$js="<link href='".C('TMPL_PARSE_STRING.__STATIC__')."css/daterangepicker.css' rel='stylesheet' type='text/css'><script type='text/javascript' src='".C('TMPL_PARSE_STRING.__STATIC__')."js/datetime_moment.min.js'></script><script type='text/javascript' src='".C('TMPL_PARSE_STRING.__STATIC__')."js/datetime.js'></script>";
		$script="<script>\$(function(){\$('#".$Fields[field]."').dateRangePicker({".$config."});});</script>";
		return $js.stripslashes($field_tem).$script; 
   } 
   
      
/**
 * 显示linkage字段
 * @access String $Fields   字段信息
 * @return String  
 */
   function show_linkage($Fields,$record)
   {
	    $key=$Fields['setting']['key']?$Fields['setting']['key']:"name";
		$val=$Fields['setting']['value']?$Fields['setting']['value']:"id";
		$parent=$Fields['setting']['parent']?$Fields['setting']['parent']:"parent_id";
		$first=$Fields['setting']['first'];
		
		if($first)
		{
			  $first=explode("|",$first);
			  $default=array('text'=>$first[0],'value'=>$first[1]);			
		}

		$linkage_id=$Fields['setting']['linkage_id'];
		$linkage_id_array=explode("|",$linkage_id);
		$table=$linkage_id_array[1]?$linkage_id_array[1]:"linkage";
		$id=$linkage_id_array[0]?$linkage_id_array[0]:0;
		$field=array($key,$val);
		
		$data=get_linkage_datas($table,$id,$field,$where,$parent);

		$value=parents($record[$Fields['field']],$table,$field,array('text','value'),$parent,$id);

		$Fields[setting][linkage]=linkage($data,$Fields['field'],$selects,$form,$value,$default,$class=$Fields['setting']['css']);

		$field_tem=preg_replace_callback('/\[(\w+)]/i', 
		function ($m) use ($Fields) {
            return $Fields[setting][$m[1]];
        },$Fields['tem_c']);	
		
		return $field_tem; 
   }   
	 /**
	 * 删除表中字段
	 * @access String $table   删除字段所在的表中
	 * @access String $field   删除的字段名称
	 * @access int $modelid   模型id
	 * @return bool  
	 */
   function del($field,$table,$modelid=0)
   {
         if($modelid)   
		 {  
   				$model =M('model');
				$where['id']=$modelid;
				$model_info=$model->where($where)->find();
		 }
		 
		 $true_table=$table?$table:$model_info['table'];
		 $table=$table?$this->PRE.$table:$this->PRE.$model_info['table'];
         
         $Field= M();
		 if($this->describe($field,$true_table))
		 {
		     $sql="ALTER TABLE `$table` DROP `$field`" ;
			 $Field->execute($sql);
		     return true;	 
		 }
		 else
		 {
		 
		     if($this->describe($field."_map_x",$true_table))
			 {
			      $sql="ALTER TABLE `$table` DROP `".$field."_map_x`" ;
				  $Field->execute($sql);
			 }
			 
			 if($this->describe($field."_map_y",$true_table))
			 {
			      $sql="ALTER TABLE `$table` DROP `".$field."_map_y`" ;
				  $Field->execute($sql);
			 }
			 
			 if($this->describe($field."_start",$true_table))
			 {
			      $sql="ALTER TABLE `$table` DROP `".$field."_start`" ;
				  $Field->execute($sql);
			 }
			 
			 if($this->describe($field."_end",$true_table))
			 {
			      $sql="ALTER TABLE `$table` DROP `".$field."_end`" ;
				  $Field->execute($sql);
			 }
		     return true;
		 }
		 
        
   }   
   
	 /**
	 * 验证表中是否存在该字段
	 * @access String $table   字段所在的表中
	 * @access String $field   字段名称
	 * @access int $modelid   模型id
	 * @return bool  
	 */
   function describe($field,$table,$modelid=0)
   {
         if($modelid)   
		 {  
   				$model =M('model');
				$where['id']=$modelid;
				$model_info=$model->where($where)->find();
		 }
		 $table=$table?$this->PRE.$table:$this->PRE.$model_info['table'];
         
         $Field= M();
		 $sql="describe `$table` `$field` " ;
		 return $Field->query($sql);      
   }    

	 /**
	 * 验证表中是否存在该字段索引
	 * @access String $table   字段所在的表中
	 * @access String $field   字段名称
	 * @access int $modelid   模型id
	 * @return bool  
	 */
   function index($field,$table,$modelid=0)
   {
         if($modelid)   
		 {  
   				$model =M('model');
				$where['id']=$modelid;
				$model_info=$model->where($where)->find();
		 }
		 $table=$table?$this->PRE.$table:$this->PRE.$model_info['table'];
         
         $Field= M();
		 $sql="SHOW INDEX FROM `$table` WHERE Column_name = '$field'" ;
		 return $Field->query($sql);      
   }    
     
	 /**
	 * 给表中字段添加普通索引
	 * @access String $table   字段所在的表中
	 * @access String $field   字段名称
	 * @access int $modelid   模型id
	 * @return bool  
	 */
   function add_index($field,$table,$modelid=0)
   {
         if($modelid)   
		 {  
   				$model =M('model');
				$where['id']=$modelid;
				$model_info=$model->where($where)->find();
		 }
		 $table=$table?$this->PRE.$table:$this->PRE.$model_info['table'];
         
         $Field= M();
		 
		 $sql="SHOW INDEX FROM `$table` WHERE Column_name = '$field'" ;
		 $index=$Field->query($sql);
		 if($index)
		 {
		     return true;
		 }
		 else
		 {
		     $sql="ALTER TABLE `$table` ADD INDEX ( `$field` )" ;	
			 return $Field->execute($sql);
		 }
		      
   } 
   
	 /**
	 * 给表中字段添加普通索引
	 * @access String $table   字段所在的表中
	 * @access String $field   字段名称
	 * @access int $modelid   模型id
	 * @return bool  
	 */
   function del_index($field,$table,$modelid=0)
   {
         if($modelid)   
		 {  
   				$model =M('model');
				$where['id']=$modelid;
				$model_info=$model->where($where)->find();
		 }
		 $table=$table?$this->PRE.$table:$this->PRE.$model_info['table'];
         
         $Field= M();
		 $sql="SHOW INDEX FROM `$table` WHERE Column_name = '$field'" ;
		 $index=$Field->query($sql);
		 if($index)
		 {
		      foreach($index as $v)
			  {
					 $sql="ALTER TABLE `$table` DROP INDEX `".$v['key_name']."` " ;
					 $Field->execute($sql); 			  
			  }
		 }
      return  true;
   }
   
   
   function formValidator($Fields)
   {
/*        $formid=$formid?$formid:"form1";
		$scrpit="$.formValidator.initConfig({
            formID: \"$formid\",
            errorFocus: true,
            submitOnce: false,
			ajaxObjects:'',
			submitonce:true,
			onError:function(msg,obj,errorlist){ 
			   $.map(errorlist,function(msg1){
			   alert(obj.value)
			   }); 
			 },
			onSuccess: function() {},
        }); ";*/
		$title=$Fields[title];
		$field=$Fields[field];
		$remarks=$Fields[remarks];
		$form_type=$Fields[form_type];
		
		$len_min=intval($Fields[setting][len_min]);
		$len_max=intval($Fields[setting][len_max]);
		$type_num=intval($Fields[setting][type_num]);
		$num_min=intval($Fields[setting][num_min]);
		$num_max=intval($Fields[setting][num_max]);
		
		if(in_array($form_type,array('box','image','images','datetime')))
		{
		     return "";
		}
		if($type_num)
		{
			$str=$num_min?"min: ".$num_min.",\r\n onErrorMin: \"".L('SAVE_NUM_MIN',array('title'=>$title,'num_min'=>$num_min))."\",\r\n ":"";
			$str.=$num_max?"max: ".$num_max.",\r\n onErrorMax: \"".L('SAVE_NUM_MAX',array('title'=>$title,'num_max'=>$num_max))."\",\r\n ":"";
			$str.=($str)?"type:'number'":"";	
		}
		else
		{
		    $str.=$len_min?"min: ".$len_min.",\r\n onErrorMin: \"".L('SAVE_LEN_MIN',array('title'=>$title,'len_min'=>$len_min))."\",\r\n ":"";
			$str.=$len_max?"max: ".$len_max.",\r\n onErrorMax: \"".L('SAVE_LEN_MAX',array('title'=>$title,'len_max'=>$len_max))."\",\r\n ":"";
		}
		$remarks = str_replace(PHP_EOL,"",$remarks);
		$scrpit=$scrpit."\r\n \$('#$field').formValidator({ 
            onShow: ".($remarks?"\"$remarks\"":"false").",
            onFocus: ".($remarks?"\"$remarks\"":"false").",
            onCorrec: \"".L('O_S')."\"
        })";
		if($str)
		{
			$scrpit=$scrpit.".inputValidator({\r\n".$str."\r\n})";		
		}
		if($Fields[setting][reg_exp])
		{
		
		    if($len_min)
			{
		         $scrpit=$scrpit.".regexValidator({\r\n regExp: \"".$Fields[setting][reg_exp]."\",onError: \"".$Fields[setting][reg_exp_pro]."\"\r\n})";
			}
			else
			{
			    $scrpit=$scrpit.".regexValidator({\r\n regExp: \"(".$Fields[setting][reg_exp].")|(^$)\",onError: \"".$Fields[setting][reg_exp_pro]."\"\r\n})";
			}	
		}
		
		if($Fields[setting][only])
		{
		    $scrpit=$scrpit.".functionValidator({
			 fun:function(val,elem){
				    return_stat=false;
				     ajax_url='".U('Field/Ajax/field_exist_')."';
					 $.ajax(
					 {
							 url:ajax_url,
							 async:false,
							 data:'table=".$Fields[table]."&id_name=".$Fields[id_name]."&id_value=".$Fields[id_value]."&clientid=".$Fields[field]."&".$Fields[field]."='+val, 
							 success:function(json){
								if(json.content==1)
								{
									 return_stat=false
								}else if(json.content==0)
								{
									 return_stat=true;
								}
						    }
					 });
					 return return_stat;
			},
            onError: \"".$title.L('O_EXIST')."\",
        })";	
			if(intval($Fields[id_value]))
			{
			    $scrpit=$scrpit.".defaultPassed()";
			}
		}
		return $scrpit;
   } 
   
 	 /**
	 * 验证数据库中是否存在该表
	 * @access String $table   表名称
	 * @return bool  
	 */  
	public function is_table_exist($table)
	{
         $Table= M();
		 $sql="SHOW TABLES LIKE '".$this->PRE.$table."'" ;
		 $table_info=$Table->query($sql);
         return $table_info;
	}


}
?>
<?php
/*
-----------------------------------
   
   后台菜单
   $parentid 父菜单ID
   $name input的ID和name属性值
   $type 菜单样式 0：下拉菜单 1：单选 2：复选
   $var  确定是否被选中INPUT的值，此值是数组
   $char 体现菜单层级的字符 数组或字符串 如果是数组  第一个元素为开始字符，第二个为中间字符 第三个为结束字符
   $id 要屏蔽的菜单ID  0 不屏蔽
   $menu_level 菜单的层级 
   $type_ 菜单类型 admin 为管理菜单  user为会员中心菜单
   $max_level 最大显示多少层菜单 默认为0不限
   $op 每个菜单的样式 如：<option value='{id}' id='{k}'>{title}</option>  想要调用那个字段值就使用:{title}菜单名称  {parentid}父菜单ID {k}同级菜单的key值 {level} 菜单的层数  第一层为1,必须全为小写 如果需要层级字符在需要出现的地方加上{char}
   $property 表单样式 默认为没有 如果想拥有请留空
-----------------------------------   
*/	
   function menu_check($parentid=0,$type=0,$var=array(),$id=0,$type_='admin',$char=array('├','─',''),$menu_level=0,$max_level=0,$op="",$name="", $property='data-switch-no-init' ){  
	

			  
			  //------------------------------------菜单列表----------------------------------------
					  $parentid=is_numeric($parentid)?$parentid:0;
					  $type=is_numeric($type)?$type:0;
					  $menu_level=is_numeric($menu_level)?$menu_level:0;
					  $max_level=is_numeric($max_level)?$max_level:0;
					  $$property=$property?$property:'data-switch-no-init';
					  $char=$char?$char:array('├','-','');
					  $menu_level=$menu_level+1;		  
					  $str="";
					  if($max_level && $max_level<$menu_level) return "";
					  if(!is_array($var))
					  {
					      $var=explode(',',$var);
					  }
                      if($id) $where['id']=array('NEQ',$id);
					  $where['parent_id']=$parentid;
					  $where['type']=$type_;
			          $menu =D('Menu');
					  $info=$menu->where($where)->select(); 
					  if(!$info)
					  {
					      return "";
					  }
					  $charstr=numstr($menu_level-1,$char); //显示层级的字符串
			  			//echo $menu->getLastSql() ; 
			      //------------------------菜单列表--------------------------------------
                       foreach ($info as $k => $v) 
					   {

					        $menu="";
							
					        if($op)//  自定义字符串 数据收集
							{
							        $array=array('{id}'=>$v['id'],'{title}'=>$v['title'],'{parentid}'=>$v['parentid'],'{k}'=>$k,'{level}'=>$menu_level,'{char}'=>$charstr);
							        $menu=strtr($op,$array);
									
									if(in_array($v['id'],$var))//检查当前ID 是否在给定的值中，如果在则该INPUT被选中  INPUT有下拉菜单，复选框，单选框
									{
										$menu=str_replace(array('<option','<input'),array('<option selected ','<input checked '),$menu);
									}
									
										 $str=$str.$menu;
		                    }
							else //非定义字符串，默认自动生成
							{   
										switch ($type)
										{
										case 0: // 下拉
										  $check=in_array($v['id'],$var)?"selected":"";
										  $str=$str."<option value='".$v['id']."' $check $menu_level>".$charstr.$v['title']."</option>";	 									  
										  break;  
										case 1://单选$name
										  $check=in_array($v['id'],$var)?"checked":"";
										  $str=$str.$charstr."<input name='$name' type='radio' id='$name' value='".$v['id']."' $check $property>".$v['title'];
										  
										  break;
										case 2://复选
										  $check=in_array($v['id'],$var)?"checked":"";
										  $str=$str."<input name='$name' type='checkbox' id='$name' value='".$v['id']."' $check $property>".$v['title'];
										  break;
										default:
										}
							
							
							}//数据收集完成

							$str=$str.menu_check($v['id'],$type,$var,$id,$type_,$char,$menu_level,$max_level,$op,$name,$property);
							
							
					   }
			

              return $str;
    }	
//-------------后台菜单完------------------------
	
	
/*
-----------------------------------
   
   获取菜单下边的子菜单个数
   $parentid 父菜单ID
   $type 获取模式 0获取菜单下的所有子菜单个数，包括子菜单下的子菜单 1只获取当前菜单下子菜单个数 默认为1
   $max_level 最大统计多少层菜单 默认为0不限
   $menu_level 菜单的层级
-----------------------------------   
*/	

function get_submenu_count($parentid=0,$type=1,$max_level=0,$menu_level=0)
{

    $parentid=$parentid?$parentid:0;
	$menu_level=$menu_level?$menu_level:0;
	$menu_level=$menu_level+1;
    $type=$type?$type:0;
	if($max_level && $max_level<$menu_level) return array(0,$menu_level-1);// 返回一个数组，第一次参数为子菜单个数，第二个为层数
	$menu =D('Menu');
	$where['parent_id']=is_numeric($parentid)?$parentid:0;
	
	if(!$type)//如果为0 统计所以子菜单的个数
	{
	     $submenu=$menu->where($where)->select();//获取总记录数
		 
		 $submenu_count=$submenu?count($submenu):0;//统计当前栏目的子菜单个数
		 if($submenu_count)
		 {
		            $submenu_array=array();//存放返回的子菜单数组，有2个元素，，第一次参数为子菜单个数，第二个为层数
					foreach ($submenu as $k=>$v) 
					{
					  
						$submenu_array=get_submenu_count($v['id'],$type,$max_level,$menu_level);//存放返回的子菜单数组，有2个元素，，第一次参数为子菜单个数，第二个为层数
						
						//$submenu_array[0] 获取返回的子菜单个数
						$submenu_level[$k]=is_numeric($submenu_array[1])?$submenu_array[1]:0;// 获取返回的子菜单的层级
						
						$submenu_count=$submenu_count+$submenu_array[0];//累计子菜单的个数
					}
					
					rsort($submenu_level);//按层级大小排序数组，子菜单层数最多的排到最前边
					$menu_level=$submenu_level[0];//获取子菜单层数最多的层数，菜单有多少层，主要按照菜单最多的算
					
				    $submenu_return[0]=$submenu_count;//子菜单个数
				    $submenu_return[1]=$menu_level;//子菜单的层数
					
					
		 }
		 else
		 {
		          $submenu_return[0]=0;//子菜单个数为0
				  $submenu_return[1]=$menu_level-1;//子菜单的层数
		 
		 }
		 
		//echo  $menu->getLastSql(); 
		 
	}
	else
	{
	     $submenu_count=$menu->where($where)->count();//获取总记录数
		 //echo $submenu_count;
		 $submenu_return[0]=$submenu_count;//子菜单个数为0
	     $submenu_return[1]=$menu_level-1;//子菜单个的层数
	}
	return $submenu_return;
	
}

//-------------后台菜单完------------------------ 

/*
-----------------------------------
   
   删除后台菜单-包括删除子菜单
   $id 要删除的菜单ID
-----------------------------------   
*/	

function menu_submenu_del($id=0)
{

    $id=$id?$id:0;
	$del_num=0;//删除菜单的条数
	if($id)
	{
		$menu =D('Menu');
		$where['parent_id']=$id;
		$info=$menu->where($where)->select();
		if($info)// 检查如果为真，说明有子菜单，继续执行函数，检查子菜单
		{
		   			foreach ($info as $k=>$v) 
					{
					     $del_num=$del_num+menu_submenu_del($v['id']);
						 unset($where);
						 $where['id']=$id;
						 $del_num=$del_num+$menu->where($where)->delete(); //累计删除菜单个数
					}
		}
		else//如果没有子菜单，将直接删除本菜单
		{
		     unset($where);
			 $where['id']=$id;
		     $del_num=$del_num+$menu->where($where)->delete(); 
		}
		
	
	}
   
        return $del_num;
	
}

//-------------后台菜单完------------------------   

/*
-----------------------------------
   
   获取单条菜单的的信息，或是菜单某个字段的值
   $field 返回的字段  如果是单个字段直接返回字段值  
   $where  返回菜单条件
-----------------------------------   
*/	

function get_menu_one($field="*",$where="1")
{

		$menu =D('Menu');
		$info=$menu->field($field)->where($where)->find();
		if($info)// 检查如果为真，说明有子菜单，继续执行函数，检查子菜单
		{
               if($field!="*" && !strstr($field,","))//如果是单个字段，直接返回这个字段的值
			   {
                    return $info[$field];
			   }
			   else
			   {
			       return $info;  
			   }
		}

		
         return ""; 
	
}

/*
-----------------------------------  
   获取角色列表
-----------------------------------   
*/	
function role_list_(){  	
			  $role =M('role');
			  $where['status']=1;
			  $info=$role->where($where)->order('sort_num asc,id desc')->select(); 
              return  $info; 
    }
/*
-----------------------------------  
   获取权限列表
   $type 权限分区
-----------------------------------   
*/	
function auth_list($type){  	
			  $auth_rule_class =M('auth_rule_class');
			  $where['type']=$type;
			  $info=$auth_rule_class->where($where)->order('sort_num asc,id desc')->field('id,title')->select(); 
              if($info)
			  {
				  $auth_rule =M('auth_rule');
				  foreach($info as $k=>$v)
				  {
					   $sub=$auth_rule->where('class_id='.$v['id'])->order('sort asc,id desc')->field('id,title')->select(); 
					   if($sub) $info[$k]['sub']=$sub;
				  }
				  return $info;
			  }
			  return false;
    }
/*
-----------------------------------  
   设置会员组缓存
-----------------------------------   
*/	
 function user_group_set_config(){
	
           $group =M('group');
		   $data['status']=1;
		   $groups=$group->where($data)->order('sort_num asc,id desc')->select();
		   $groups_array=array();
		   if($groups)	
		   {
		       foreach($groups as $k=>$v)
			   {
			        $groups_array[$v['id']]=$v;
					$groups_array[$v['id']]['setting']=string2array($v['setting'],0);
			   }
		       
		   }
		   FF("user_group/user_group", $groups_array);
    }	
/**----------------------------------- 
 * 删除数据表
 * $table 数据表名
-----------------------------------  */        
   function del_table($table)
   {
	     $filed=new \Org\Util\Field();
         $filed->del_table($table);
   } 
/**----------------------------------- 
 * 插入数据
 * $table 数据表名
 * $insert_data 要插入的数据$insert_data[] = array('name'=>'CMS','email'=>'CMS@gamil.com');
-----------------------------------  */        
   function insert_data($table,$insert_data)
   {
	   	 $filed=new \Org\Util\Field();
         return $filed->insert_data($table,$insert_data);
   } 
/**----------------------------------- 
* 删除数据
* $del_data 要删除的数据 条件，删除多个数据表里数据 格式为$del_data=array('TABLE_NAME'=>array('id'=>10
----------------------------------- */        
   function del_data($del_data=array())
   {
	      $filed=new \Org\Util\Field();
		  foreach($del_data as $k=>$v)
		  {
			  if($filed->is_table_exist($k))
			  {
				   $Table= M($k);
				   $del=$Table->where($v)->delete();
			  }
		  }
   }	
?>

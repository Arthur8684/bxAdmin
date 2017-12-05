<?php
/*
  *@输出链接带文章  *@
  *@m，为变量或数字 格式Admin/Menu/menu_list  ||  array('Admin/Menu/menu_list','a=1&b=2')  *@
  *@title，链接标题  *@
  *@class，链接样式  *@
  *@other，链接里的其他文本  *@
  *@other_str，如果非链接比如是按钮，如果该变量不为空，返回该变量的字符，并会替换对应的数据  *@
  *@替换字符串的{title}=$name   {url}=U($m) {class}=$class {other}=$other  *@
  *@ return string
*/
   function RR($m,$title,$class,$other="",$other_str="")
   {   
         if (is_array($m))
		 {
		      if (count($m)>1)
			  {
			       $url=  U($m[0],$m[1]);
				   $model=explode('/',$m[0]);
				   $model_param=is_array($m[1])?http_build_query($m[1]):$m[1];
			  }
		      else
			  {
			      $url=  U($m[0]);
				  $model=explode('/',$m[0]);
			  }
		 }
		 else
		 {	
			  if(substr($m,0,1)==":")
			  {
				  $url=substr($m,1);
			  }
			  else
			  {
				  $url=U($m);
				  $model=explode('/',$m[0]);			  
			  }
		 }    
		 
		 if($model)
		 {
			 if(!url_auth($model[0],$model[1],$model[2],$model_param)) return "";			 
		 }

          if(!trim($other_str)=="")  //如果不是超链接，将会输出其他的字符串
		  {
		        $other_str=str_replace("{url}",$url,$other_str);
				$other_str=str_replace("{class}",$class,$other_str);
				$other_str=str_replace("{other}",$other,$other_str);
				$other_str=str_replace("{title}",$title,$other_str);
		  
		  }
		  else
		  {
		        $other_str="<a href='".$url."'  class='".$class."'  ".$other." >".$title."</a>";
		  }
	
       return $other_str;
   }
/*=======================================================================================================
  *@验证连接规则，验证连接是否生效*@
  *@$m，模块名  *@
  *@$c，控制器  *@
  *@$a，方法名  *@
  *@$a，其他参数，多个参数用&连接  *@
  *@ return string
========================================================================================================*/  
   function url_auth($m,$c,$a,$p)
   {
	     $Auth=new \Org\Util\Auth();
		 $data=array();
		 $name=array();
		 
		 if($m)
		 {
			$data['auth_m']=$m; 
			$name['auth_m']=$m;
		 }
		 
		 if($c)
		 {
			$data['auth_m']=$c; 
			$name['auth_m']=$c;
		 }
		 
		 if($a)
		 {
			$data['auth_m']=$a; 
			$name['auth_m']=$a;
		 }
		 if($GLOBALS['LOGIN_USER']['role_id']!=1)
		 {
			$rule=M('auth_rule')->where($data)->find();
			if($rule)
			{
				$Auth_=$Auth->check(implode('/',$name),$GLOBALS['LOGIN_USER']['id'],$p);
				if(!$Auth_) return false;
			}
		 }
		 return true;
   } 
/*
  *@输出指定个字符  *@
  *@$num，输出字符的个数  *@
  *@$char，要输出的字符  *@
  *@ return string
*/  
   function numstr($num,$char)
   {
        $str="";
		$array=array();
		if(is_array($char))
		{
			$array[0]=$char[0]?$char[0]:"";
			$array[1]=$char[1]?$char[1]:"";
			$array[2]=$char[2]?$char[2]:"";
		}
		else
		{

			$array[0]="";
			$array[1]=$char;
			$array[2]="";
		
		}
		
        for($i=1;$i<=$num;$i++)
		{
			$str=$str.$array[1];
		   
		}
		
		return $array[0].$str.$array[2];
   }  
/*   
  *@分页-页码  *@
  *@$record_count，记录总条数  *@
  *@$pagesize，每页显示的条数  *@
  *@$show_type，显示分页的样式 1为数字链接 显示的比较大 2为数字链接 显示中等大小 3为数字链接 显示的比较小    *@
  *@$other，为自定义分页 {first} 代表第一页的链接 {prev} 代表上一页的链接 {next} 代下一页的链接 {end} 代表最后一页的链接 {num} 代表其他的数字的链接——  *@
*/  
   function page_show($record_count,$pagesize,$show_type,$other)
   {
		  $Page_list = new \Think\Page($record_count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数
		  
			switch ($show_type)
			{
			case 1:
			         $Page_list ->setConfig('theme',"<nav><ul class='pagination pagination-lg'>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></nav>");
			  break;  
			case 2:

			        $Page_list ->setConfig('theme',"<nav><ul class='pagination'>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></nav>");
			  break;
			case 3:

			        $Page_list ->setConfig('theme',"<nav><ul class='pagination pagination-sm'>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></nav>");
			  break;
			  
			case 4:
					 $Page_list ->setConfig('first',L('PAGE_FIRST'));
					 $Page_list ->setConfig('last',L('PAGE_END'));
			         $Page_list ->setConfig('theme',"<nav><ul class='pagination pagination-lg'>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></nav>");
			  break;  
			case 5:
					$Page_list ->setConfig('first',L('PAGE_FIRST'));
					$Page_list ->setConfig('last',L('PAGE_END'));
			        $Page_list ->setConfig('theme',"<nav><ul class='pagination'>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></nav>");
			  break;
			case 6:
					$Page_list ->setConfig('first',L('PAGE_FIRST'));
					$Page_list ->setConfig('last',L('PAGE_END'));
			        $Page_list ->setConfig('theme',"<nav><ul class='pagination pagination-sm'>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></nav>");
			  break;
			  
			case 7:
			        $Page_list ->setConfig('prev',L('PAGE_PREVIOUS'));
					$Page_list ->setConfig('next',L('PAGE_NEXT'));
			        $Page_list ->setConfig('theme',"<nav><ul class='pager'><li class='previous'>%UP_PAGE% %DOWN_PAGE%</ul></nav>");
			  break;
			case 8:
			        $Page_list ->setConfig('prev',L('PAGE_PREVIOUS'));
					$Page_list ->setConfig('next',L('PAGE_NEXT'));
					$Page_list ->setConfig('css_prev',"");
					$Page_list ->setConfig('css_next',"");
			        $Page_list ->setConfig('theme',"<nav><ul class='pager'><li class='previous'>%UP_PAGE% %DOWN_PAGE%</ul></nav>");
			  break;
			  
			 case 9:
			        $Page_list ->setConfig('prev',L('PAGE_PREVIOUS'));
					$Page_list ->setConfig('next',L('PAGE_NEXT'));
					$Page_list ->setConfig('first',L('PAGE_FIRST'));
					$Page_list ->setConfig('last',L('PAGE_END'));
					$Page_list ->setConfig('css_prev',"");
					$Page_list ->setConfig('css_next',"");
					$Page_list ->setConfig('css_first',"");
					$Page_list ->setConfig('css_end',"");
			        $Page_list ->setConfig('theme',"<nav><ul class='pager'><li class='previous'>%FIRST% %UP_PAGE% %DOWN_PAGE% %END%</ul></nav>");
			  break;
			default:
			}
			$page_show      = $Page_list->show();
			return $page_show;

   }
 /*   
  *@者数组写入到文件中  *@
  *@此函数和F的区别就在于F是将要写入的字符串和数组进行序列化，而FF没有进行序列化 只保存数组 *@
  *@$name，文件名称也可以带路径  *@
  *@$value，要写入的值，如果他为"" 则为读取数据    *@
  *@$path，为前置路径，最后函数的文件为：$path . $name . '.php'，$path默认值 F为DATA_PATH FF为COMMON_PATH."Cache/"——  *@
  *@ return string || array
*/ 
 function FF($name, $value='', $path="") {
    static $_cache  =   array();
	$path=$path?$path:COMMON_PATH."Cache/";
    $filename       =   $path . $name . '.php';
    if ('' !== $value) {
        if (is_null($value)) {
            // 删除缓存
            if(false !== strpos($name,'*')){
                return false; // TODO 
            }else{
                unset($_cache[$name]);
                return Think\Storage::unlink($filename,'F');
            }
        } else {
		
		    if(is_array($value))
			{
			     $str="<?php \r\n"; 
			     $value=var_export($value, TRUE);
				 $str=$str."return ".$value.";\r\n ?>";
			}
            Think\Storage::put($filename,$str,'F');
            // 缓存数据
            return null;
        }
    }
    // 获取缓存数据
    if (Think\Storage::has($filename,'F')){
        $value      = include($filename);
    } else {
        $value          =   false;
    }
    return $value;
}     
 
 /*   
  *@将数组格式的字符串转变成数组  *@
  *@$data，要转变的字符串  *@
  * @return   array   返回数组格式，如果，data为空，则返回空数组 
 */  
 
function string2array($data) {   
    if($data == '') return array();
	$data=stripslashes($data); 
    @eval("\$array = $data;");   
    return $array;   
}  
/**
* 将数组转换为字符串
*
* @param  array  $data    数组
* @param  bool  $isformdata  如果为0，则不使用new_stripslashes处理，可选参数，默认为1
* @return  string  返回字符串，如果，data为空，则返回空
*/ 
function array2string($data, $isformdata = 0) { 
  if($data == '') return ''; 
  if($isformdata) $data = new_stripslashes($data); 
  return addslashes(var_export($data, TRUE)); 
}  

/**
* 返回经 htmlspecialchars 处理过的字符串或数组
* @param $string 需要处理的字符串或数组
* @return mixed
*/ 
function new_html_special_chars($string) { 
  if(!is_array($string)) return htmlspecialchars($string); 
  foreach($string as $key => $val) $string[$key] = new_html_special_chars($val); 
  return $string; 
}

/**
* 返回经addslashes 处理过的字符串或数组
* @param $string 需要处理的字符串或数组
* @return mixed
*/ 
function new_addslashes($string) { 
  if(!is_array($string)) return addslashes($string); 
  foreach($string as $key => $val) $string[$key] = new_addslashes($val); 
  return $string; 
}    

/**
* 返回经stripslashes处理过的字符串或数组
* @param $string 需要处理的字符串或数组
* @return mixed
*/ 
function new_stripslashes($string) { 
  if(!is_array($string)) return stripslashes($string); 
  foreach($string as $key => $val) $string[$key] = new_stripslashes($val); 
  return $string; 
}
/**
* 转换字节数为其他单位
*
*
* @param        string        $filesize        字节大小
* @return        string        返回大小
*/ 
function sizecount($filesize) { 
        if ($filesize >= 1073741824) { 
                $filesize = round($filesize / 1073741824 * 100) / 100 .' GB'; 
        } elseif ($filesize >= 1048576) { 
                $filesize = round($filesize / 1048576 * 100) / 100 .' MB'; 
        } elseif($filesize >= 1024) { 
                $filesize = round($filesize / 1024 * 100) / 100 . ' KB'; 
        } else { 
                $filesize = $filesize.' Bytes'; 
        } 
        return $filesize; 
} 
/*
-----------------------------------  
   获取会员组列表
-----------------------------------   
*/	
function group_list_(){  	
			  $group =D('group');
			  $where['status']=1;
			  $info=$group->where($where)->order('sort_num asc,id desc')->select(); 
              return  $info; 
    }	
	
/*---------------
返回数字，根据传入的字符串返回数组，或者范围内的随机数，字符串转换
$data  要转换的字符串
return int
----------------*/
function return_num($data){
	
	 if(!$data) return 0;
     if(is_numeric($data)) return $data;
	 $data_array=explode(',',$data); 
	 return ($data_array[0] && $data_array[1])?rand($data_array[0],$data_array[1]):0;
}			
/*
-----------------------------------  
按要求出来数组，删除包含在array1变量中的列表
* @param        string        $array        要处理的数组
* @param        string        $array1        要删除数组中的列表
* @return        string        返回大小
-----------------------------------   
*/	
function data_($array,$array1=array('clientid','_','rand')){  	
           if($array)
		   {
		        if(!is_array($array1)) $array1=explode(",",$array1);
				
				foreach($array1 as $v)
				{
				     unset($array[$v]);
				}
		   }
         return $array;
    }
/*
-----------------------------------  
字符串替换
* @param        string        $str      要替换的字符串
* @param        string        $s        状态
* @return        string        返回大小
-----------------------------------   
*/	
function url_replace($str,$s=1){  	
         if($s)
		 {
			 return preg_replace($pat=array('/\//','/\&/'), $rep=array('*','￥'), $str);
		 }
		 else
		 {
			 return preg_replace($pat=array('/\*/','/\￥/'), $rep=array('/','&'), $str);
		 }
    }	
/*
-----------------------------------  
遍历替换数组中的字符串
* @param        string        $array        要处理的数组
* @param        string        $array1        要替换数组中的列表
* @param        string        $key          是否要替换key值
* @return        string        返回新数组
-----------------------------------   
*/	
function array_foreach_replace($array,$array1=array(),$key=0){  	

            if(!is_array($array))
			{
			    return strtr($array,$array1);
			}
			else
			{
			    foreach($array as $k =>$v)
				{
				      unset($array[$k]);
				      if($key) $k=strtr($k,$array1);
				      $array[$k]=array_foreach_replace($v,$array1);
				} 
			}
         return $array;
    }		
/*
-----------------------------------  
字段显示 按表显示，多字段
* @param        string int       $table        如果为数字为模型ID 如果为字符串为数据表
* @param        int              $id    记录ID
* @param        string              $formid    提交的表单ID
* @param        array             $var_array     已有变量的值
* @param        array             $group     分组显示
* @return       string        
-----------------------------------   
*/	
function fields($table,$var_array=array(),$id=0,$formid="",$group="",$tpl_name=""){  	
		if(!$table) return "";
		$F=new \Org\Util\Field();
		if($id)
		{ 
		}else
		{
			 $_POST['addtime']=time();
			 $_POST['autho_id']=$GLOBALS['LOGIN_USER']['id'];
			 $_POST['autho_admin']=$GLOBALS['LOGIN_USER']['admin'];
		}
		return $F->create_form_field_by_table($table,$id,$formid,$var_array,$group,$tpl_name);
    }
/*
-----------------------------------  
字段显示 显示单个字段
* @param        string int       $field_id    字段ID
* @param        int              $id    记录ID
* @param         string              $formid    提交的表单ID
* @param        array             $var_array     已有变量的值
* @return        string        
-----------------------------------   
*/	
function field($field_id,$var_array=array(),$id=0,$formid=""){  	
		if(!$field_id) return "";
		$F=new \Org\Util\Field();
		return $F->show_form_field_by_id($field_id,$id,$formid,$var_array);
    }	
/*
-----------------------------------  
字段显示 按表显示，多字段的值
* @param        string int       $table        如果为数字为模型ID 如果为字符串为数据表
* @param        int              $id    记录ID
* @param         string              $tem_id    显示模板ID
* @param        array             $group     分组显示
* @return        string        
-----------------------------------   
*/	
function fields_var($table,$id=0,$group="",$tem_id=""){  	
		if(!$table) return "";
		$F=new \Org\Util\Field();
		return $F->var_form_field_by_table($table,$id,$group,$tem_id);
    }	
/*
-----------------------------------  
字段显示 显示单个字段值
* @param        string int       $field_id    字段ID
* @param        int              $id    记录ID
* @param         string              $tem_id    显示模板ID
* @return        string        
-----------------------------------   
*/	
function field_var($field_id,$id=0,$tem_id=""){  	
		if(!$field_id) return "";
		$F=new \Org\Util\Field();
		return $F->var_form_field_by_id($field_id,$id,$tem_id);
    }
/*
-----------------------------------  
根据模型ID 获取用户某个字段值
* @param        int       $where  获取用户的条件数据可以是数组用户ID array('id'=>10,'user'=>'ceshi')
* @param        int       $field    字段名称 默认为数据表，当为空则获取整条数据
* @return       string  array      
-----------------------------------   
*/	
function user($where,$field="user",$default=''){
		if(!$where) return $default;
		if($field=='headpath') $default=$default?$default:C('root_path')."upload/system/userhead.png";
		$m=M("user");
	    if(!is_array($where)) $where=array('id'=>$where);
		$info=$m->where($where)->find();
		if($info)
		{
		   return $field?($info[$field]?$info[$field]:$default):data_($info,array('pass','pass_pre'));
		} 
    }	
/*
-----------------------------------  
根据模型ID 获取某个字段值
* @param        int       $model_id   模型ID
* @param        int       $field    字段名称 默认为数据表，当为空则获取整条数据
* @return       string  array      
-----------------------------------   
*/	
function model_f($model_id,$field="table"){  	
		if(!$model_id) return "";
		$m=M("model");
		$field_str=$field?$field:" * ";
		$where['id']=$model_id;
		$info=$m->field($field_str)->where($where)->find();
		if($info)
		{
		   return $field?$info[$field]:$info;
		} 
    }
/*
-----------------------------------  
   获取内容系统对应属性的记录
   $model_id 模型id
   $show_property 显示属性值，多个值用逗号隔开 0表示最新记录
   $num 显示记录条数 默认显示10条
   $op 生产条件的标志  or或and
-----------------------------------   
*/	
function model_p($model_id,$show_property,$op,$num){
	  load('Sys_model/function');
	  return get_record_by_property($model_id,$show_property,$op,$num);
} 
/*
-----------------------------------  
根据模型ID 获取模型配置文件
* @param        int       $model_id   模型ID
* @return       string  array      
-----------------------------------   
*/	
function model_config($model_id){  	
		if(!$model_id) return "";
		$c=FF("model/model_".$model_id."_config");
		if(!$c)
		{
			$config=model_f($model_id,"setting");
			if($config)
			{
				$c=string2array($config) ;
				FF("model/model_".$model_id."_config",$c);
			}
		}
		return $c;
    }
/*
-----------------------------------  
添加菜单
* @param        int      $data    要添加的数据
* @return        string  array      
-----------------------------------   
*/	
function add_menu($data=array()){  	
		$m=M("menu");
		$data['parent_id']=$data['parent_id']?$data['parent_id']:0;
		$insert_id=$m->add($data);
        return $insert_id;
    }
/*
-----------------------------------  
添加权限
* @param        int      $data    要添加的数据
* @return        string  array      
-----------------------------------   
*/	
function add_auth($data=array()){  	
		$m=M("auth_rule");
		$where=array('name'=>$data['name']);
		$auth=$m->where($where)->find();
		if($auth) exit("[".$data['name']."]".L('AUTH_EXIST'));
		$data['class_id']=$data['class_id']?$data['class_id']:0;
		$insert_id=$m->add($data);
        return $insert_id;
    }	
/*
-----------------------------------  
添加权限
* @param        int      $data    要添加的数据
* @return        string  array      
-----------------------------------   
*/	
function add_auth_class($data=array()){  	
		$m=M("auth_rule_class");
		$data['parent_id']=$data['parent_id']?$data['parent_id']:0;
		$insert_id=$m->add($data);
        return $insert_id;
    }
/*
-----------------------------------  
获取内容模型分类
* @param        int      $model_id    模型id
* @param        int      $parent_id    模型父id
* @return        string  array      
-----------------------------------   
*/	
function get_model_class($model_id,$parent_id=0,$id=0){  	
		$m=M("sys_model_class");
		if($id) $where['id']=array('NEQ',$id);
		$where['parent_id']=$parent_id;
		$where['status']=1;
		$where['model_id']=$model_id;
		$class=$m->where($where)->select();
		if($class)
		{
		     foreach($class as $k=>$v)
			 {
			     
				 $data[$k]['n']=$v['name'];
				 $data[$k]['v']=$v['id'];
				 $data[$k]['s']=get_model_class($model_id,$v['id'],$id);
			 }
		}
        return $data;
    }
/*
-----------------------------------  
获取联动菜单所需要的data数据集合，php数据
* @param        int      $table    数据所在的数据包 默认为linkage
* @param        int      $id    数据id
* @param        int      $where    获取数据条件
* @param        int      $parent   标志上一级的关系字段 默认 parent_id
* @param        string    $edit_id   编辑的时候自身ID不显示
* @return        string  array      
-----------------------------------   
*/	
function get_linkage_datas($table,$id,$keys=array('name','id'),$where=array(),$parent='parent_id'){  
        $table=	$table?$table:"linkage";
		$key=$keys[0]?$keys[0]:'name';
		$value=$keys[1]?$keys[1]:'id';
		
		$m=M($table);
		$where[$parent]=$id;
		$info=$m->where($where)->select();
		if($info)
		{
		     foreach($info as $k=>$v)
			 {
				 $data[$k]['n']=$v[$key];
				 $data[$k]['v']=$v[$value];
				 $data[$k]['s']=get_linkage_datas($table,$v['id'],$keys,$where,$parent);
			 }
		}
        return $data;
    }	
/*
-----------------------------------  
数组生成联动菜单格式
* @param        array      $data    数据
* @param        string      $form_name    容器ID
* @param        array     $selects    表单名称 
* @param        int      $form    是否已经存在表单 0没有 1存在
* @param        array      $value    表单默认被选中的值 数组array(array('text'=>"文本1",'value'=>"值1"),array('text'=>"文本2",'value'=>"值2"))  
* @param        array int     $default  提示文档 数组array('text'=>"请选择",'value'=>"0")  如果为1 不输出
* @param        string    $class   表单文本框的class
* @return        string       
-----------------------------------   
*/	
function linkage($data,$form_name,$selects="",$form=0,$value=array(),$default=array(),$class=""){ 
      $c=$data?array_depth($data):1;
	  if(!$selects)
	  {
	      for($i=0;$i<$c;$i++)
		  {
		      $input.="<select class='".$form_name."_".$i." ".$class."' name='".$form_name."[]' id='".$form_name."_".$i."'>";
			  if($value[$i])
			  {
			      $input.="<option value='".$value[$i]['value']."' selected>".$value[$i]['text']."</option>";
			  }
			  $input.="</select>&nbsp;";
			  $selects[]=$form_name."_".$i;
		  }
	  }
	  elseif($selects && !$form)
	  {
	      foreach($selects as $k=>$v)
		  {
		     $input.="<select class='".$v." ".$class."' name='".$v."[]' id='".$v."'>";
			  if($value[$k])
			  {
			      $input.="<option value='".$value[$k]['value']."' selected>".$value[$k]['text']."</option>";
			  }
			 
			 $input.="</select>&nbsp;";
		  }
	  }

	  if($default && is_array($default))
	  {
	      $option="firstTitle:'".$default['text']."', firstValue:'".$default['value']."',\r\n"; 
	  }
	  elseif($default && 1==$default)
	  {
	      $option="required: true,\r\n";
	  } 
	  else
	  {
	      $option="";
	  }
	  if($selects) array_walk_recursive($selects, function(&$val){ $val = "'".$val."'"; });
	  $selects=$selects?"selects:[".implode(",",$selects)."],\r\n":"";
      $script=$input."\r\n<SCRIPT src='".C("TMPL_PARSE_STRING.__STATIC__")."js/jquery.cxselect.min.js' type='text/javascript'></SCRIPT>\r\n<SCRIPT> var linkage_data_".$form_name."=".(get_linkage_data($data)?get_linkage_data($data):"[]").";\r\n";
	  $script.="\$('#".$form_name."').cxSelect({".
				$selects.$option.
                "jsonValue: 'v',\r\n
				emptyStyle: 'none',\r\n
                data: linkage_data_".$form_name."});";
	  $script.=	"</SCRIPT>\r\n";
	  
	  return $script;
	         
    }
	
/*
-----------------------------------  
展现信息分类联动
* @param        int      $id    classid
* @param        int      $modelid    模型id
* @return        string  array      
-----------------------------------   
*/	
function show_linkage($id,$modelid,$c=1,$b=" > "){  	
		$data=parents($id);
		if(!$data || !$id) return "";
		foreach($data as $v)
		{
		    if($c==1)
			{
			    $str.=$str?$b."<a href='".U('Sys_model/Class/class_list',array("parentid"=>$v['id'],'modelid'=>$modelid))."'>".$v['name']."</a>":"<a href='".U('Sys_model/Class/class_list',array("parentid"=>$v['id'],'modelid'=>$modelid))."'>".$v['name']."</a>";
			}
			elseif($c==2)
			{
			    $str.=$str?$b.RR(array('Sys_model/Class/class_list',array("parentid"=>$v['id'],'modelid'=>$modelid)),$v['name'],'btn btn-danger btn-xs'):RR(array('Sys_model/Class/class_list',array("parentid"=>$v[id],'modelid'=>$modelid)),$v['name'],'btn btn-danger btn-xs');
			}
			else
			{
			    $str.=$str?$b.$v['name']:$v['name'];
			}    
		}
        return $str;
    }
	
/*
-----------------------------------  
联动显示
* @param        int      $id    classid
* @param        int      $url    联动连接
* @return        string  array      
-----------------------------------   
*/	
function show_linkages($datas,$url,$key='name',$c=1,$b=" > ",$data=array()){  	

        $id=$datas['id'];
		$table=$datas['table'];
		$field=$datas['field'];
		$keys=$datas['key'];
		$data=$datas['data'];
		$parent=$datas['parent'];
		$topid=$datas['topid'];
		
		$data=parents($id,$table,$field,$keys,$data,$parent,$topid);

		if(!$data || !$id) return "";
		foreach($data as $v)
		{
		    if($c==1)
			{
			    $str.=$str?$b."<a href='".U($url,array("parentid"=>$v['id'],'id'=>$v['id']))."'>".$v[$key]."</a>":"<a href='".U($url,array("parentid"=>$v['id'],'id'=>$v['id']))."'>".$v[$key]."</a>";
			}
			elseif($c==2)
			{
			    $str.=$str?$b.RR(array($url,array("parentid"=>$v['id'],'id'=>$v['id'])),$v[$key],'btn btn-danger btn-xs'):RR(array($url,array("parentid"=>$v['id'],'id'=>$v['id'])),$v[$key],'btn btn-danger btn-xs');
			}
			else
			{
			    $str.=$str?$b.$v[$key]:$v[$key];
			}    
		}
        return $str;
    }
/*
-----------------------------------  
生成联动菜单数据，js字符串
* @param        int      $data    数据
* @param        int      $form_name    表单名称
* @return        string       
-----------------------------------   
*/	
function get_linkage_data($data){  	
      if($data)
	  {
	       $linkage_data="[";
	       foreach($data as $k=>$v)
		   {
		       $linkage_data.="{'n':'".$v['n']."','v':'".$v['v']."'";
			   if($v['s']) $linkage_data.=",'s':".get_linkage_data($v['s']);
			   $linkage_data.="},";
		   }
	       $linkage_data.="]";
	  }
	  return $linkage_data;
    }
	
/*
-----------------------------------  
真的联动菜单返回的id进行处理，来返回时间ID
* @param        int      $data    数据
* @param        int      $form_name    表单名称
* @return        string       
-----------------------------------   
*/	
function linkage_id($data){  	
      if(is_array($data))
	  {
	       if(count($data)==1) return $data[0];
           $data=array_reverse($data);
		   foreach($data as $v)
		   {
		       if($v) return $v;
		   }
	  }
	  else
	  {
	      return $data;
	  }	  
	  return $data;
    }
/**
 * 联动菜单专用 返回数组维数（层级）
 * @param array $arr
 * @return int
 */
function array_depth($array) {
        $max_depth =0;
        foreach ($array as $value) {
            if ($value['n']) {
                $depth = array_depth($value['s']) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }        
        return $max_depth;
 }
 /**
 * 无限返回上级
 * @param int $id  开始ID
 * @param int $table  在那个表中检索
 * @param int $field  获取的字段
 * @param int $key  数组的key值
 * @return array()
 */
function parents_($id,$table="sys_model_class",$field=array('name','id'),$key=array(),$data=array(),$parent='parent_id',$topid=0) {
	   
	   $table=$table?$table:"sys_model_class";
	   $field=$field?$field:array('name','id');
	   $parent=$parent?$parent:'parent_id';
	   $topid=$topid?$topid:0;
	   
	   if($id)
	   {
			$m=M($table);
			$where['id']=$id;
			$info=$m->where($where)->find();
			if($info)
			{
			    $array=array();
			    if($key)
				{			    
				    foreach($field as $k=>$v)
					{
					    $array[$key[$k]]=$info[$v];
					}
				}else
				{
				    foreach($field as $k=>$v)
					{
					    $array[$v]=$info[$v];
					}
				}
				$data[]=$array;
				if($info[$parent] && $topid!=$info[$parent])
				{
				    return parents_($info[$parent],$table,$field,$key,$data,$parent,$topid);
				}
				else
				{
				     return $data;
				}
			}
	   }
 }
 
  /**
 * 无限返回上级 反排列
 * @param int $id  开始ID
 * @param int $table  在那个表中检索
 * @param int $field  获取的字段
 * @param int $key  数组的key值
 * @return array()
 */
function parents($id,$table="sys_model_class",$field=array('name','id'),$key=array(),$parent='parent_id',$topid=0) {
       return array_reverse(parents_($id,$table,$field,$key,$data,$parent,$topid)) ;
 }
/*
-----------------------------------  
资金流水记录
* @param         string    $coin  交易币的种类  money资金  amount点数 point积分 promote_point升级积分点数
* @param         string   $type    币的流动方向1表示进账，2表示出账
* @param         string   $operation_type    操作类型，如转账，消费等
* @param         string   $business_type    交易类型,比如现金，支付宝
* @param         string   $userid    所属用户ID
* @param         string   $operation_user   操作用户名
* @param         string   $msg   信息提示
* @param         string   $is_operation   是否操作用户资金
* @return        int  记录ID        
-----------------------------------   
*/	
function account($userid=0,$coin=array('money'=>0,'amount'=>0,'point'=>0,'promote_point'=>0),$operation_type=1,$business_type=1,$operation_user='',$msg='',$is_operation=1)
    {  	
		if(!$coin || !$userid) return 0;
		$data['id']=$userid;
	    $insertId=0;
		$u_account=true;
		
		$user=M('user');
		$where['id']=$userid;
		$user_info=$user->where($where)->find();
		
		$array=array('operation_type'=>$operation_type,'business_type'=>$business_type,'userid'=>$userid,'user'=>$user_info['user'],'operation_user'=>$operation_user,'msg'=>$msg,'addtime'=>time());
		$account_array=array_merge($array, $coin);
		if($is_operation)
		{
			foreach($coin as $k => $v)
			{
				if($v<0)//判断是否为删除积分
				{
						$coin_count=abs($v);
						$data[$k]=$user_info[$k]-$coin_count;
						if($data[$k]<0) return $k; //如果会员积分余额不足
				}
				else
				{
					 $data[$k]=$user_info[$k]+$v;
				}
			}
			$u_account=$user->save($data);
			if(!$u_account) return 0;
		}
		unset($data['id']);
		$account_array['balance']=serialize($data);
		if($u_account)
		{
		     $accounts_record=M('accounts_record');
			 $insertId=$accounts_record->add($account_array);
		}		
		return $insertId;
}		
/*
-----------------------------------  
替换[title] 等格式的字符串
* @return        bool        
-----------------------------------   
*/
function replace_regex($string,$data,$p="")
{
    if (!$string) return "";
	$rel_text=preg_replace_callback("/\[".$p."([A-Za-z0-9_\[\]\']+)]/i", 
	function ($m) use ($data) {
		return $data[$m[1]];
	},$string); 
	return $rel_text;
}
/*
-----------------------------------  
验证码code
* @param      array  string   $c  如果是获取验证码，需要输入验证码配置信息，默认可以输入空，验证输入验证，请输入用户验证码
识
-----------------------------------   
*/
function code($c="",$sign_code='',$id='')
{
	if($sign_code && C('code_open'))
	{
		if($c)
		{
			$verify = new \Think\Verify();
			return $verify->check($c, $id);
		}else
		{
			 echo "<img id='code_img_'".$id." src='".U("System/Verify/index",array('id'=>$id))."' onClick=this.src=this.src+'?rnd=' + Math.random() />";
		}
	}
	else
	{
	    return true;	
	}
}
/*
-----------------------------------  
审核设置
* @param   int  string   $table  模型ID或者数据表识
-----------------------------------   
*/
function verify($model_id,$id=0)
{
	  if(!$model_id) return "";
	  if($id)
	  {
			$M=M('model');
			$data['id']=$model_id;
			$table = $M->where($data)->getField('table');
			$verify=M($table)->where(array('id'=>$id))->getField('verify');
			$verify=$verify?0:99;
	  }else
	  {
			$config=model_config($model_id);
			$verify=I('verify')?I('verify'):($config['verify']?$config['verify']:0);		  
	  }


	  
	  if($verify)
	  {
		   return 99;
	  }
	  else
	  {
		   return 0;
	  }
}
/*
-----------------------------------  
累计设置
* @param   int  $userid  用户ID
* @param   array $type  累计类型
-----------------------------------   
*/
function set_grand($userid,$type=array('order'=>1,'consumption'=>30))
{
	 if(!$userid) return false;
	 $user=M('user')->where(array('id'=>$userid))->find();
	 if(!$user)  return false;
	 $data=array();
	 foreach($type as $k=>$v)
	 {
		 $time=$user['time_'.$k];
		 $data['day_'.$k]=is_numeric($user['day_'.$k])?$user['day_'.$k]:0;
		 $data['month_'.$k]=is_numeric($user['month_'.$k])?$user['month_'.$k]:0;
		 $data['year_'.$k]=is_numeric($user['year_'.$k])?$user['year_'.$k]:0;
		 $data['total_'.$k]=is_numeric($user['total_'.$k])?$user['total_'.$k]:0;
		 
		 $data['day_'.$k]=(date('Y-m-d')==date('Y-m-d',$time))?$data['day_'.$k]+$v:$v;
		 $data['month_'.$k]=(date('Y-m')==date('Y-m',$time))?$data['month_'.$k]+$v:$v;
		 $data['year_'.$k]=(date('Y')==date('Y',$time))?$data['year_'.$k]+$v:$v;
		 $data['total_'.$k]=$data['total_'.$k]+$v;
		 $data['time_'.$k]=time();		 
	 }
	 $data['id']=$userid;
	 if(M('user')->save($data)!==false)
	 {
		   return true;
	 }else
	 {
		   return false;
	 }		 
} 
/*
-----------------------------------  
累计获取
* @param   int  $userid  用户ID
* @param   string array $type  累计类型
-----------------------------------   
*/
function get_grand($userid,$type=array('order','consumption'))
{
	 if(!$userid) return false;
	 if(!is_array($type)) $type=array($type);
	 $user=M('user')->where(array('id'=>$userid))->find();
	 if(!$user)  return false;
	 $data=array();
	 foreach($type as $v)
	 {
		 $time=$user['time_'.$v];
		 $data['day_'.$v]=(date('Y-m-d')==date('Y-m-d',$time))?$user['day_'.$v]:0;
		 $data['month_'.$v]=(date('Y-m')==date('Y-m',$time))?$user['month_'.$v]:0;
		 $data['year_'.$v]=(date('Y')==date('Y',$time))?$user['year_'.$v]:0;
		 $data['total_'.$v]=$user['total_'.$v]?$user['total_'.$v]:0;	 
	 }
	  $data['promote_point']=$user['promote_point']?$user['promote_point']:0;
	  $data['money']=$user['money']?$user['money']:0;
	  $data['amount']=$user['amount']?$user['amount']:0;
	  $data['point']=$user['point']?$user['point']:0;
	  $data['qrcode_open']=$user['qrcode_open']?$user['qrcode_open']:0;
	  $data['is_real_name']=$user['is_real_name']?$user['is_real_name']:0;
	  $data['is_bank_auth']=$user['is_bank_auth']?$user['is_bank_auth']:0;
     return $data;	 
}
/*
-----------------------------------  
**获取用户N层内的推荐人数
**@param     int   $userid  用户ID  
**@param     int   $n   获取推荐的层数
**@param     int   $group_id   会员组ID
**@param     int   $c_n 当前层数      
-----------------------------------   
*/	
function get_recommend_num($userid,$n=0,$group_id=0,$c_n=1){   
       if($n>0 && $n<$c_n) return 0;
       $user=M('user')->where(array('recommend'=>$userid))->select();
	   if($user)
	   {
		    $num=0;
		    foreach($user as $k=>$v)
			{
				  if($group_id)
				  {
					  $num=($group_id==$v['group_id'])?($num+get_recommend_num($v['id'],$n,$group_id,$c_n+1)+1):($num+get_recommend_num($v['id'],$n,$group_id,$c_n+1));
				  }
				  else
				  {
					  $num=$num+get_recommend_num($v['id'],$n,$group_id,$c_n+1)+1;		 
				  }
			}
			return $num;
	   }
	   else
	   {
		     return 0;
	   }
}

/*
-----------------------------------  
**获取用户第N层内的推荐人数
**@param     int   $userid  用户ID  
**@param     int   $n   获取推荐的层数
**@param     int   $group_id   会员组ID
**@param     int   $c_n 当前层数      
-----------------------------------   
*/	
function get_recommend_n($userid,$n=3,$group_id=0,$c_n=1){   
       if($n<$c_n) return 0;
       $user=M('user')->where(array('recommend'=>$userid))->select();
	   if($user)
	   {
		    $num=0;
		    foreach($user as $k=>$v)
			{
				  if($c_n==$n)
				  {
					  if($group_id)
					  {
						  if($group_id==$v['group_id']) $num=$num+get_recommend_n($v['id'],$n,$group_id,$c_n+1)+1;//是否为会员组的用户
					  }
					  else
					  {
						  $num=$num+get_recommend_n($v['id'],$n,$group_id,$c_n+1)+1;
					  }   
				  }
				  else
				  {
					  $num=$num+get_recommend_n($v['id'],$n,$group_id,$c_n+1);
				  }
				  
			}
			return $num;
	   }
	   else
	   {
		     return 0;
	   }
}

/*
-----------------------------------  
**获取被并生成条件
**@param     int   $userid  用户ID  
**@param     int   $group_id   当前会员组
**return     int   能够升级的会员组ID      
-----------------------------------   
*/	
function get_condition($userid,$condition,$group_id=0){   
        if(!$userid) return false;
		if(!$condition) return true;
        if(!$group_id) $group_id=M('user')->where(array('id'=>$userid))->getField('group_id');
		$group=M('group')->where(array('id'=>$group_id))->find();

		$grand=get_grand($userid,array('order','consumption','recommend'));
		$grand['userid']=$userid;
		$grand['group_id']=$group_id;
		$condition_text=preg_replace_callback('/\[([A-Za-z0-9_\*\?\|]+)]/i', 
					function ($m) use ($grand) {
						$sign=substr($m[1],0,1);
						$param=substr($m[1],1);
						if(is_numeric($param))
						{
							$n=$param;
							$group_id=0;
						}else
						{
							$param_array=explode("|",$param);
							$n=$param_array[0];
							$group_id=$param_array[1];									
						}
						switch ($sign)
						{
						case '*':
						  return get_recommend_num($grand['userid'],$n,$group_id);
						  break;  
						case '?':
						  return get_recommend_n($grand['userid'],$n,$group_id);
						  break;
						default:
						  return $grand[$m[1]];
						}
					},$condition);
			//file_put_contents($T.".txt", $condition_text);
			eval("\$condition_val=$condition_text;");
			//file_put_contents($T."k.txt", $condition_val);
            return $condition_val;

}
/*
-----------------------------------  
**获取能够升级的会员组
**@param     int   $userid  用户ID  
**@param     int   $group_id   当前会员组
**return     int   能够升级的会员组ID      
-----------------------------------   
*/	
function get_group_promote($userid,$group_id=0){   
        if(!$userid) return $group_id;
        if(!$group_id) $group_id=M('user')->where(array('id'=>$userid))->getField('group_id');
		$group=M('group')->where(array('id'=>$group_id))->find();
		
		if($group['is_promote'])
		{
			$group_grand=M('group')->field('id,condition,is_login')->where(array('condition'=>array('NEQ','')))->order('level desc')->select();
			if(!$group_grand) return $group_id;
			foreach($group_grand as $k=>$v)
			{
					$condition=$v['condition'];
					$condition_val=get_condition($userid,$condition,$group_id);						
					if($v['id'] && $condition_val && $v['is_login'])
					{
						if($group_id!=$v['id']) M('user')->where('id='.$userid)->save(array('group_id'=>$v['id']));
					    return 	$v['id'];
					}	
			}
            return $group_id;
		}
		else
		{
			 return $group_id;
		}
}

/*
-----------------------------------  
**修改提示信息模板页面   
-----------------------------------   
*/	
function edit_msg_tem(){   
   if(isMobile())
   {
	   C('TMPL_ACTION_ERROR',THINK_PATH.'Tpl/dispatch_mobile_jump.tpl');
	   C('TMPL_ACTION_SUCCESS',THINK_PATH.'Tpl/dispatch_mobile_jump.tpl');
   }
}

/*
-----------------------------------  
**返回某个时间段的秒数
**@param     string   type  时间段类型，有年月日等 
**@param     int   $group_id   当前会员组
**return     int   能够升级的会员组ID   
-----------------------------------   
*/	
function get_second($type='day',$param=1){   
	 switch ($type)
	 {
		case 'year':
		   $second=$param*3600*24*30*12;
		   break;  
		case 'month':
           $second=$param*3600*24*30;
		   break;
		case 'day':
		   $second=$param*3600*24;
		   break;
		case 'hour':
		   $second=$param*3600;
		   break;
		case 'minute':
		   $second=$param*60;
		   break;
		case 'second':
		   $second=$param;
		   break;
		case 'week':
		   $second=$param*3600*24*7;
		   break;
		default:
		  $second=$param*60;
	 }
	 return $second;
}
/*
-----------------------------------  
手机验证码验证
* @param        mobile_num 手机号码    
* @param        post_code 验证码
* @return       bool  1表示验证成功，2验证失败，3手机号为空，4验证码过期     
-----------------------------------   
*/	
function check_mobile_code($mobile_num,$post_code)
{ 
	  if(!$mobile_num) return 3;
	  $code=S('mobile_'.$mobile_num);
	  if(!$code) return 4;
	  
	  if($code==$post_code)
	  {
		  S('mobile_'.$mobile_num,NULL);
		  return 1;
	  }
	  else
	  {
		  return 2;
	  }
}
/*
-----------------------------------  
生成二维码图片
* @param        data 二维码生成数据    
* @param        qrcode 为false表示不生成文件，生成二维码路径
* @param        logo 生成二维码的loge路径
* @param        errorCorrectionLevel 容错能力 L(QR_ECLEVEL_L，7%)、M(QR_ECLEVEL_M，15%)、Q(QR_ECLEVEL_Q，25%)、H(QR_ECLEVEL_H，30%)；
* @param        matrixPointSize 生成图片大小
* @param        margin 二维码的空白区域大小
* @param        back_color 背景颜色
* @param        fore_color 绘制二维码的颜色
* @return       bool  1表示验证成功，2验证失败，3手机号为空，4验证码过期     
-----------------------------------   
*/	
function qrcode($data,$qrcode=false,$logo=false,$errorCorrectionLevel='L',$matrixPointSize = 4,$margin=1,$back_color=0xFFFFFF,$fore_color = 0x000000)
{ 
     $data=urlencode(url_replace($data));
	 $qrcode=urlencode(url_replace($qrcode));
	 $logo=urlencode(url_replace($logo));
	 return U('System/Qrcode/qrcode',array('url'=>$data,'qrcode'=>$qrcode,'logo'=>$logo,'errorCorrectionLevel'=>$errorCorrectionLevel,'matrixPointSize'=>$matrixPointSize,'margin'=>$margin,'back_color'=>$back_color,'fore_color'=>$fore_color));
}
/*
-----------------------------------  
获取form表单
* @param        modelid 表单模型ID    
-----------------------------------   
*/	
function form($modelid)
{ 
      $user=get_user();	
      
	  $form=model_config($modelid);
	  if(!$form) return L('FORM_NOT');
	  if(!$form['open']) return L('FORM_NOT_OPEN');
	  $time=time();
	  if($form['group'] && !$user['group_id']) return L('FORM_NOT_USER');
	  if($form['group'] && (!$user['group_id'] || !in_array($user['group_id'],$form['group']) )) return L('FORM_NOT_LVE');
	  if($form['start_time'] && $form['end_time'] && ($time > $form['end_time'] || $time < $form['start_time'])) return L('FORM_NOT_TIME');
	  $field=fields($modelid);
	  $field=$field."<input name='modelid' type='hidden' value='".$modelid."'>";
	  return $field;
}
/*
-----------------------------------  
获取登录用户
* @param        modelid 表单模型ID    
-----------------------------------   
*/	
function  get_user(){	  
		  if(session('user.id'))
		  {		
				$session_id=session('user.id');
				$user = M("user");
				$where['id']=$session_id;
				$user_info=$user->where($where)->find();
				if($user_info)
				{
					 $user_info['admin']='user';
					 $userinfo=data_($user_info,array('pass','pass_pre'));
				}
		  }
		  else if(session('admin.id'))
		  {		
			  $session_id=session('admin.id');  
			  $admin = M("admin");
			  $where['id']=$session_id;
			  $admin_info=$admin->where($where)->find();
			  if($admin_info)
			  {
				   $admin_info['admin']='admin';
				   $userinfo=data_($admin_info,array('pass','pass_pre'));;
			  }	  
		  }  
		  return $userinfo;
}
/*
-----------------------------------  
手机验证码JS
* @param        input_id 触发事件的ID    
* @param        form_id 表单ID
* @return       string  字符串
调用该函数，请将手机号表单命名mobile_num 验证码表单为mobile_code
-----------------------------------   
*/	
function mobile_code_js($input_id,$form_id="",$autotip=true)
{ 
    $mobile_id='mobile_num';
    $code_id='mobile_code';
	
    $js="<script type='text/javascript' src='".C('TMPL_PARSE_STRING.__STATIC__')."js/formvalidator.js'></script><script type='text/javascript' src='".C('TMPL_PARSE_STRING.__STATIC__')."js/formvalidatorregex.js'></script>\r\n    <script>\$('#".$input_id."').on('click', function(){
		         mobile=\$('#".$mobile_id."').val();
				 if(!mobile) 
				 {
					 jq_alert('".L('MOBILE_ERR_1')."');
					 return false;
				 }
				 
                 para=\"{'mobile_num':'\"+mobile+\"'}\";
				 para=eval('(' + para + ')');
				 url='".U('System/Mobile/mobile_code')."';
				$.getJSON(url,para,function(json,status,xhr){	
                     if(json.err==0)
					 {
						 settime($('#".$input_id."'))
					 }
					 else
					 {
						 jq_alert(json.content);
					 }
			   }); 
       })
		var countdown=120; 
		function settime(obj) { 
			if (countdown == 0) { 
				obj.removeProp('disabled');    
				obj.val('获取验证码'); 
				countdown = 120; 
				return;
			} else { 
				obj.prop('disabled', true); 
				obj.val('重新发送(' + countdown + ')'); 
				countdown--; 
			} 
		   setTimeout(function() { 
			settime(obj) }
			,1000) 
		}";
		
	   if($form_id)
	   {
		   $js.="\r\n \$.formValidator.initConfig({
						formID: \"$form_id\",
						errorFocus: false,
						autotip: ".$autotip.",
						ajaxObjects:'#".$mobile_id.",#".$code_id."',});";
		   $js.="\r\n \$('#".$mobile_id."').formValidator({ 
            onShow: false,
            onFocus: false,
            onCorrec: \"".L('O_S')."\"
           }).regexValidator({regExp:regexEnum.mobile,onError: \"".L('MOBILE_ERR_0')."\"})";
		
		$js.="\r\n \$('#".$code_id."').formValidator({ 
            onShow: false,
            onFocus: false,
            onCorrec: \"".L('O_S')."\"
           }).inputValidator({min:1, onErrorMin: \"".L('CODE').L('O_EMPTY')."\",}).ajaxValidator({
	  		dataType : \"json\",
            url: \"".U('System/Mobile/check_mobile_code')."\",
            success: function (data) {
                if (data.err== 0) {
                    return true;
                } 
				else
				{
					jq_alert(data.content);
					$('#".$code_id."').val();
				    return false;
                }
            },
            onError: \"".$title.L('O_EXIST')."\",
           })";
	   }

		
	   $js=$js."</script>\r\n";
	   
	   return $js;
}

/*
-----------------------------------  
广告显示
* @return        bool        
-----------------------------------   
*/	
function ad($id){
	 if(!is_install('Advert')) return '';
	 if(!$id) return '';   
     $advert=M('advert_type');  
	 $info=$advert->where(array('id'=>$id,'status'=>1))->find();
	 if($info)
	 {
		  $adstr="<div width='100%' height='100%' id='ad".$id."'></div>\r\n";
		  $adstr.="<script> \r\n
                  $(document).ready(\r\n
                     function(){\r\n			
                          load_str=\"<div class='row'><div class='col-md-2 laod1'></div><div class='col-md-10 padding_8'>".L('LOAD_MSG')."</div></div>\"; \r\n
						  $(\"#ad".$id."\").html(load_str);\r\n	
						  $(\"#ad".$id."\").load('".U('Advert/index/ad')."', {id: ".$id."}, function(d,s){});\r\n
				  });\r\n</script>";
	 }
	 return $adstr;
}

/*
-----------------------------------  
导出文件
* @param        title exc标题 格式 array('id'=>'下单ID','older_user'=>'下单人'); 
* @param        data 添加的数据   格式 array(0=>array('id'=>1,'older_user'=>'王五'),1=>array('id'=>2,'older_user'=>'赵六'))
* @param        filename 保存文件名称
* @param        ext 导出文件类型 xls：2005版本 xlsx：2007版本 pdf csv 
-----------------------------------   
*/	
function export($title,$data,$ext='csv',$filename=''){
	  load('System/function');
	  $function='export_'.$ext;
	  $function($title,$data,$filename);
}  

/*
-----------------------------------  
js显示评论列表和添加评论的方法
* @param        model_id 模型ID    
* @param        goods_id 文字或者产品ID
* @return       $type 1时为列表与添加评论一起显示 2仅显示添加  3仅显示列表
调用该函数，请将手机号表单命名mobile_num 验证码表单为mobile_code    
-----------------------------------   
*/
	function comment($model_id,$goods_id,$type=1,$form_id='form1',$content_id='content',$star='star')
	{
		$c=FF("Comment/comment_config_".$model_id."");
		if(!$c) $c=FF("Comment/comment_config");
		if($c['open']==1){
			if(!$model_id) exit($html='');
			if(!$goods_id) exit($html='');
			if($type!=2){
				$html="<div id=\"comment_list\" ></div>";
			}
			$html.="<div id=\"add_comment\"></div>";
			$html.="<script type=\"text/javascript\">";
			if($type!=2){
				$html.="function page_show(page){";
				$html.="$.get(\"".U('Comment/Ajaxcomment/comment_list_html')."\", { model_id: '".$model_id."', goods_id:'".$goods_id."',page:page} , function(data){";
				$html.="$('#comment_list').html(data);";
				$html.="});";
				$html.="}";
			}
			if($type!=3){
				$html.="function form_submit(){";
				$html.="content=$('#".$content_id."').val();";
				$html.="star=$('#".$star."').val();";
				$html.="$.get(\"".U('Comment/Ajaxcomment/add_comment_func')."\", { model_id: '".$model_id."',goods_id:'".$goods_id."', content:content,star:star} , function(data){";
				$html.="alert(data);";
				$html.="$('#".$content_id."').val('');";
				$html.="$('#".$star."').val(5);";
				$html.="});";
				$html.="$.get(\"".U('Comment/Ajaxcomment/add_comment_html')."\", { model_id: '".$model_id."', goods_id:'".$goods_id."'} , function(data){";
				$html.="$('#add_comment').html(data);";
				$html.="});";				
				$html.="}";
			}
			if($type!=2){
				$html.="$.get(\"".U('Comment/Ajaxcomment/comment_list_html')."\", { model_id: '".$model_id."', goods_id:'".$goods_id."'} , function(data){";
				$html.="$('#comment_list').html(data);";
				$html.="});";
			}
			if($type!=3){
				$html.="$.get(\"".U('Comment/Ajaxcomment/add_comment_html')."\", { model_id: '".$model_id."', goods_id:'".$goods_id."'} , function(data){";
				$html.="$('#add_comment').html(data);";
				$html.="});";
			}
			$html.="</script>";
			echo $html;
		}
	}
/*
-----------------------------------  
判断模块是否安装
* @param    sign 模块标识
-----------------------------------   
*/	
function is_install($sign){
	   $path=APP_PATH.$sign."/Install/install.install";
	   if(file_exists($path))
	   {
		   return true;
	   }
	   else
	   {
		   return false;
	   }
} 
/*
------------------------------------------------------
参数：
$str    需要截断的字符串
$length     允许字符串显示的最大长度
$append   如果超出最大个数要显示的字符串
程序功能：截取全角和半角（汉字和英文）混合的字符串以避免乱码
------------------------------------------------------
*/
function sub_str($str, $length = 0, $append ="...")
{
	  $str = trim($str);
	  $strlength = strlen($str);
   
	  if ($length == 0 || $length >= $strlength)  return $str;  //截取长度等于0或大于等于本字符串的长度，返回字符串本身
	  elseif ($length < 0)  //如果截取长度为负数
	  {
		  $length = $strlength + $length;//那么截取长度就等于字符串长度减去截取长度
		  if ($length < 0)
		  {
			  $length = $strlength;//如果截取长度的绝对值大于字符串本身长度，则截取长度取字符串本身的长度
		  }
	  }
   
	  if (function_exists('mb_substr'))
	  {
		  $newstr = mb_substr($str, 0, $length, C('TMPL_PARSE_STRING.__CHARSET__'));
	  }
	  elseif (function_exists('iconv_substr'))
	  {
		  $newstr = iconv_substr($str, 0, $length, C('TMPL_PARSE_STRING.__CHARSET__'));
	  }
	  else
	  {
		  $newstr = substr($str, 0, $length);
	  }
   
	  if ($append && $str != $newstr)
	  {
		  $newstr .= $append;
	  }
   
	  return $newstr;
}
/*
-----------------------------------  
字段显示 判断是否为手机访问
* @return        bool        
-----------------------------------   
*/	
function isMobile(){    
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';    
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';       
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');  
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');                  
    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||  CheckSubstrs($mobile_token_list,$useragent);    
                
    if ($found_mobile){    
        return true;    
    }else{    
        return false;    
    }    
} 

function CheckSubstrs($substrs,$text){    
        foreach($substrs as $substr)    
            if(false!==strpos($text,$substr)){    
                return true;    
            }    
       return false;    
    }
/*
-----------------------------------  
选择小图标
* @param        input_id 回执的容器id
* @param        button_name 按钮显示内容
-----------------------------------   
*/  
function selecticon($input_id,$button=array('name'=>'select','style'=>'form-control','show_icon_size'=>'12px'))
{    
	load("System/function"); 
	echo select_icon($input_id,$button);     
}  
		
?>

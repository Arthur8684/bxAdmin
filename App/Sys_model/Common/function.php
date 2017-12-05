<?php
/*-----------------------------------  
根据ID 获取内容模型分类字段值
* @param        int       $where  获取条件数据可以是数组 房间分类ID array('id'=>10)
* @param        int       $field    字段名称 默认为数据表，当为空则获取整条数据
* @return       string  array      
----------------------------------- */	
function sys_class($where,$field="name",$default='',$len=10){
		if(!$where) return $default;
		$m=M("sys_model_class");
	    if(!is_array($where)) $where=array('id'=>$where);
		$info=$m->where($where)->find();
		if($info)
		{
		   return $field?($info[$field]?substr($info[$field],0,$len):$default):$info;
		} 
    }	 
/*
----------------------------------- 
   创建系统模型实例
   $model_type 模型类型
   $sign 模型标志
   $insert_id 模型ID
-----------------------------------   
*/	

function creat_model_object($model_type,$sign,$insert_id)
{
     $path=APP_PATH.$model_type."/install/sys_model/"; //APP路径
	 $sys_model_create=FF('sys_model_create','',$path);
	 $sys_model_insert=FF('sys_model_insert','',$path);
	 $field=new \Org\Util\Field();
	 if(!is_dir($path))
	 {
	      return 0;
	 }
	 if($sys_model_create)
	 {
		 $sys_model_create=array_foreach_replace($sys_model_create,array('_SIGN_'=>$sign),1);
		 $table_list=$field->create_table($sys_model_create);
	 }
	 
	 if($sys_model_insert)
	 {
	      $sys_model_insert=array_foreach_replace($sys_model_insert,array('_SIGN_'=>$sign),1);
		  foreach($sys_model_insert as $k=>$v)
		  {
			  $field->insert_data($k,$v);
		  }
	 }
	 require_once($path.'run.php'); 
	 return $table_list;
	 
	
}

/*
----------------------------------- 
   删除系统模型实例
   $model_type 模型类型
   $sign 模型标志
   $model_id 模型ID
-----------------------------------   
*/	

function del_model_object($model_type,$sign,$model_id)
{
     $path=APP_PATH.$model_type."/install/sys_model/"; //APP路径
	 if(!is_dir($path))
	 {
	      return 0;
	 }
     require_once($path.'uninstall_run.php'); 
	 return true;
	 
	
} 

/*
-----------------------------------  
   获取菜单下边的子菜单个数
   $parentid 父菜单ID
   $type 获取模式 0获取菜单下的所有子菜单个数，包括子菜单下的子菜单 1只获取当前菜单下子菜单个数 默认为1
   $max_level 最大统计多少层菜单 默认为0不限
   $class_level 菜单的层级
-----------------------------------   
*/	
function get_subclass_count($parentid=0,$type=1,$max_level=0,$class_level=0)
{

    $parentid=$parentid?$parentid:0;
	$class_level=$class_level?$class_level:0;
	$class_level=$class_level+1;
    $type=$type?$type:0;
	if($max_level && $max_level<$class_level) return array(0,$class_level-1);// 返回一个数组，第一次参数为子菜单个数，第二个为层数
	$sys_model_class =D('sys_model_class');
	$where['parent_id']=is_numeric($parentid)?$parentid:0;
	
	if(!$type)//如果为0 统计所以子菜单的个数
	{
	     $submenu=$sys_model_class->where($where)->select();//获取总记录数
		 
		 $submenu_count=$submenu?count($submenu):0;//统计当前栏目的子菜单个数
		 if($submenu_count)
		 {
		            $submenu_array=array();//存放返回的子菜单数组，有2个元素，，第一次参数为子菜单个数，第二个为层数
					foreach ($submenu as $k=>$v) 
					{
					  
						$submenu_array=get_submenu_count($v['id'],$type,$max_level,$class_level);//存放返回的子菜单数组，有2个元素，，第一次参数为子菜单个数，第二个为层数
						
						//$submenu_array[0] 获取返回的子菜单个数
						$submenu_level[$k]=is_numeric($submenu_array[1])?$submenu_array[1]:0;// 获取返回的子菜单的层级
						
						$submenu_count=$submenu_count+$submenu_array[0];//累计子菜单的个数
					}
					
					rsort($submenu_level);//按层级大小排序数组，子菜单层数最多的排到最前边
					$class_level=$submenu_level[0];//获取子菜单层数最多的层数，菜单有多少层，主要按照菜单最多的算
					
				    $submenu_return[0]=$submenu_count;//子菜单个数
				    $submenu_return[1]=$class_level;//子菜单的层数
					
					
		 }
		 else
		 {
		          $submenu_return[0]=0;//子菜单个数为0
				  $submenu_return[1]=$class_level-1;//子菜单的层数
		 
		 }
		 
		//echo  $sys_model_class->getLastSql(); 
		 
	}
	else
	{
	     $submenu_count=$sys_model_class->where($where)->count();//获取总记录数
		 //echo $submenu_count;
		 $submenu_return[0]=$submenu_count;//子菜单个数为0
	     $submenu_return[1]=$class_level-1;//子菜单个的层数
	}
	return $submenu_return;
}
/*
-----------------------------------  
   删除模型分类，包括子分类
   $class_id 要删除的id 可以是数组
   $type 是否要删除该分类下的内容  0为不删除 1为删除
-----------------------------------   
*/
	function del_class($class_id,$model_id,$type=1)
	{
	    $table=model_f($model_id);
		$m=M($table);
		$sys_model_class=M("sys_model_class");
		unset($where);
	    if(is_array($class_id)) 
		{ 
		      foreach($class_id as $k=>$v)
			  {
				   if($type) $m->where("class_id=".$v)->delete();
				   $ids=$sys_model_class->where('parent_id='.$v)->getField('id',true);
				   if($ids) del_class($ids,$model_id,$type);
				   $sys_model_class->delete($v);
			  }
		}
        return true;
	}
/*
-----------------------------------  
   获取内容系统属性列表
   $model_id 模型id
-----------------------------------   
*/
	function get_model_property($model_id)
	{
		$table=model_f($model_id);
		$Fields=FF("field/field_".$table);
		$field_id=M('table_field')->where(array('field'=>'show_property','table'=>$table))->getField('id');
		$property_str=$Fields[$field_id]['setting']['box_list'];
		$box_array=explode("\r\n", $property_str);
	    if($box_array)
		{
			 foreach($box_array as $v)
			 {
				 if($v)
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
					 $property[]=$op;
				 }
			 }
		}
        return $property;
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
	function get_record_by_property($model_id,$show_property='0',$op='and',$num=10)
	{
		$table=model_f($model_id);
		if(!$table) return false;
		$m=M($table);
		$where_int='verify=99';
        if($show_property)
		{
			 $show_property=explode(",",$show_property);
			 $where="";
			 foreach($show_property as $v)
			 {
				 if($v) $where=$where?$where." ".$op." find_in_set($v,show_property) ":"find_in_set($v,show_property)";
			 }
			 
		}
		$where=$where?$where_int." and  (".$where.")":$where_int;
		if($num==1)
		{
			$info=$m->where($where)->order('id desc')->find();
		}
		else
		{
			$info=$m->where($where)->order('id desc')->limit($num)->select();
		}
		
		return $info;
	}		
?>

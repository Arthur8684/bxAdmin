<?php
$this->install_before=function($sign)
{
	//管理员中心
	add_menu(array('title'=>"联动菜单",'url_m'=>'Linkage','url_c'=>'Admin','url_a'=>'linkage_list','type'=>'admin','parent_id'=>7,'status'=>1,'sort'=>3));
			 
    $class_id=add_auth_class(array('title'=>"联动菜单",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Linkage'));
    add_auth(array('title'=>"联动:添加",'name'=>'Linkage/Admin/Linkage_list','auth_m'=>'Linkage','auth_c'=>'Admin','auth_a'=>'Linkage_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"联动:编辑",'name'=>'Linkage/Admin/Linkage_edit','auth_m'=>'Linkage','auth_c'=>'Admin','auth_a'=>'Linkage_edit','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"联动:添加",'name'=>'Linkage/Admin/Linkage_add','auth_m'=>'Linkage','auth_c'=>'Admin','auth_a'=>'Linkage_add','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"联动:删除",'name'=>'Linkage/Admin/Linkage_del','auth_m'=>'Linkage','auth_c'=>'Admin','auth_a'=>'Linkage_del','class_id'=>$class_id,'status'=>1,'sort'=>3));
};

$this->install_db_exist=function($install,$table_exist)
{
	 foreach($table_exist as $v)
	 {
		  echo "存在数据表：$v <BR>";
	 }
	 exit();
};
?>
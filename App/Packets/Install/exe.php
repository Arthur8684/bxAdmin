<?php
$this->install_sql_after=function($install,$db_table)
{
	//管理员中心
	add_menu(array('title'=>"红包管理",'url_m'=>'Packets','url_c'=>'Admin','url_a'=>'packets_list','type'=>'admin','parent_id'=>7,'status'=>1,'sort'=>4));

    $class_id=add_auth_class(array('title'=>"红包系统",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Packets'));
    add_auth(array('title'=>"红包预览",'name'=>'Packets/Admin/packets_list','auth_m'=>'Packets','auth_c'=>'Admin','auth_a'=>'packets_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"红包添加",'name'=>'Packets/Admin/packets_add','auth_m'=>'Packets','auth_c'=>'Admin','auth_a'=>'packets_add','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"红包编辑",'name'=>'Packets/Admin/packets_edit','auth_m'=>'Packets','auth_c'=>'Admin','auth_a'=>'packets_edit','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"红包删除",'name'=>'Packets/Admin/packets_del','auth_m'=>'Packets','auth_c'=>'Admin','auth_a'=>'packets_del','class_id'=>$class_id,'status'=>1,'sort'=>3));
	
	//会员中心
	add_menu(array('title'=>"活动红包",'url_m'=>'Packets','url_c'=>'user','url_a'=>'packets_list','type'=>'user','parent_id'=>0,'status'=>1,'sort'=>4));
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
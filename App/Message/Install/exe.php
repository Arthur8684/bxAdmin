<?php
$this->install_sql_after=function($install,$db_table)
{
	//管理员中心
	$menu_id=add_menu(array('title'=>"站内短信",'url_m'=>'Message','url_c'=>'Admin','type'=>'admin','parent_id'=>6,'status'=>1,'sort'=>4));
	add_menu(array('title'=>"短信管理",'url_m'=>'Message','url_c'=>'Admin','url_a'=>'message_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
	add_menu(array('title'=>"短信设置",'url_m'=>'Message','url_c'=>'Setting','url_a'=>'setting','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));
			 
    $class_id=add_auth_class(array('title'=>"站内短信：管理员",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Message'));
    add_auth(array('title'=>"短信预览",'name'=>'Message/Admin/message_list','auth_m'=>'Message','auth_c'=>'Admin','auth_a'=>'message_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"短信发送",'name'=>'Message/Admin/message_send','auth_m'=>'Message','auth_c'=>'Admin','auth_a'=>'message_send','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"短信删除",'name'=>'Message/Admin/message_del','auth_m'=>'Message','auth_c'=>'Admin','auth_a'=>'message_del','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"短信查看",'name'=>'Message/Admin/message_view','auth_m'=>'Message','auth_c'=>'Admin','auth_a'=>'message_view','class_id'=>$class_id,'status'=>1,'sort'=>3));
	
	//会员中心
	add_menu(array('title'=>"站内短信",'url_m'=>'Message','url_c'=>'user','url_a'=>'message_list','type'=>'user','parent_id'=>0,'status'=>1,'sort'=>4));
			 
    $class_id=add_auth_class(array('title'=>"站内短信：会员",'type'=>'user','parent_id'=>0,'sort_num'=>0,'sign'=>'Message'));
    add_auth(array('title'=>"短信预览",'name'=>'Message/User/message_list','auth_m'=>'Message','auth_c'=>'User','auth_a'=>'message_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"短信发送",'name'=>'Message/User/message_send','auth_m'=>'Message','auth_c'=>'User','auth_a'=>'message_send','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"短信删除",'name'=>'Message/User/message_del','auth_m'=>'Message','auth_c'=>'User','auth_a'=>'message_del','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"短信查看",'name'=>'Message/User/message_view','auth_m'=>'Message','auth_c'=>'User','auth_a'=>'message_view','class_id'=>$class_id,'status'=>1,'sort'=>3));
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
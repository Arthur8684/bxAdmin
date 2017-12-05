<?php
$this->install_sql_after=function($sign)
{
	add_menu(array('title'=>"广告",'url_m'=>'Advert','url_c'=>'Admin','url_a'=>'advert_type_list','type'=>'admin','parent_id'=>7,'status'=>1,'sort'=>0));
	
    $class_id=add_auth_class(array('title'=>"广告",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Advert'));

    add_auth(array('title'=>"广告位：预览",'name'=>'Advert/Admin/advert_type_list','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_type_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"广告位：添加",'name'=>'Advert/Admin/advert_type_add','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_type_add','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"广告位：编辑",'name'=>'Advert/Admin/advert_type_edit','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_type_edit','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"广告位：删除",'name'=>'Advert/Admin/advert_type_del','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_type_del','class_id'=>$class_id,'status'=>1,'sort'=>3));
	
	add_auth(array('title'=>"广告：添加",'name'=>'Advert/Admin/advert_list','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_list','class_id'=>$class_id,'status'=>1,'sort'=>4));
	add_auth(array('title'=>"广告：添加",'name'=>'Advert/Admin/advert_add','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_add','class_id'=>$class_id,'status'=>1,'sort'=>5));
	add_auth(array('title'=>"广告：编辑",'name'=>'Advert/Admin/advert_edit','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_edit','class_id'=>$class_id,'status'=>1,'sort'=>6));
	add_auth(array('title'=>"广告：删除",'name'=>'Advert/Admin/advert_del','auth_m'=>'Advert','auth_c'=>'Admin','auth_a'=>'advert_del','class_id'=>$class_id,'status'=>1,'sort'=>7));

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
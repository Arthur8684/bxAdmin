<?php
$this->install_success=function($install,$db_table)
{
	//管理员中心
	$menu_id=add_menu(array('title'=>"采集器",'url_m'=>'Collector','url_c'=>'Admin','type'=>'admin','parent_id'=>6,'status'=>1,'sort'=>4));
	add_menu(array('title'=>"采集项目",'url_m'=>'Collector','url_c'=>'Project','url_a'=>'project_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
	add_menu(array('title'=>"配置项目",'url_m'=>'Collector','url_c'=>'Setting','url_a'=>'project_setting','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));
			 
    $class_id=add_auth_class(array('title'=>"采集器",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Collector'));
    add_auth(array('title'=>"采集项目",'name'=>'Collector/Project/project_list','auth_m'=>'Collector','auth_c'=>'Project','auth_a'=>'project_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"配置项目",'name'=>'Collector/Setting/project_setting','auth_m'=>'Collector','auth_c'=>'Setting','auth_a'=>'project_setting','class_id'=>$class_id,'status'=>1,'sort'=>1));
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
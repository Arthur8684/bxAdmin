<?php
$this->install_success=function($install,$db_table)
{
	//管理员中心
	$menu_id=add_menu(array('title'=>"游戏",'url_m'=>'Games','url_c'=>'Admin','type'=>'admin','parent_id'=>0,'status'=>1,'sort'=>9));
	$menu_id=add_menu(array('title'=>"游戏管理",'url_m'=>'Games','url_c'=>'Admin','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
	
	add_menu(array('title'=>"游戏设置",'url_m'=>'Games','url_c'=>'Setting','url_a'=>'setting','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
	add_menu(array('title'=>"游戏列表",'url_m'=>'Games','url_c'=>'Admin','url_a'=>'games_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));
	add_menu(array('title'=>"游戏分类",'url_m'=>'Games','url_c'=>'Class','url_a'=>'class_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>2));
			 
    $class_id=add_auth_class(array('title'=>"游戏：管理员",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Games'));
	add_auth(array('title'=>"游戏设置",'name'=>'Games/Setting/setting','auth_m'=>'Games','auth_c'=>'Setting','auth_a'=>'setting','class_id'=>$class_id,'status'=>1,'sort'=>0));
    add_auth(array('title'=>"游戏列表",'name'=>'Games/Admin/games_list','auth_m'=>'Games','auth_c'=>'Admin','auth_a'=>'games_list','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"游戏分类",'name'=>'Games/Class/class_list','auth_m'=>'Games','auth_c'=>'Class','auth_a'=>'class_list','class_id'=>$class_id,'status'=>1,'sort'=>2));
	
	//会员中心
			 
    //$class_id=add_auth_class(array('title'=>"游戏：会员",'type'=>'user','parent_id'=>0,'sort_num'=>0,'sign'=>'Message'));
    //add_auth(array('title'=>"短信预览",'name'=>'Message/User/message_list','auth_m'=>'Message','auth_c'=>'User','auth_a'=>'message_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
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
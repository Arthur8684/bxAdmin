<?php
$this->install_sql_after=function($sign)
{
	//管理员中心
  	$menu_big_id=add_menu(array('title'=>"直播",'url_m'=>'Chat','type'=>'admin','parent_id'=>0,'status'=>1,'sort'=>8));
	$menu_id=add_menu(array('title'=>"直播设置",'url_m'=>'Chat','url_c'=>'Admin','type'=>'admin','parent_id'=>$menu_big_id,'status'=>1,'sort'=>8));
	         add_menu(array('title'=>"基本设置",'url_m'=>'Chat','url_c'=>'Setting','url_a'=>'website_settings','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
			 add_menu(array('title'=>"账户配置",'url_m'=>'Chat','url_c'=>'Setting','url_a'=>'Setting','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));
			 
	$menu_id=add_menu(array('title'=>"直播管理",'url_m'=>'Chat','url_c'=>'Admin','type'=>'admin','parent_id'=>$menu_big_id,'status'=>1,'sort'=>8));
	         add_menu(array('title'=>"表情管理",'url_m'=>'Chat','url_c'=>'Admin','url_a'=>'face_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
			 add_menu(array('title'=>"礼物管理",'url_m'=>'Chat','url_c'=>'Admin','url_a'=>'gift_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));
			 add_menu(array('title'=>"房间分类",'url_m'=>'Chat','url_c'=>'Admin','url_a'=>'menu_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>2));
			 add_menu(array('title'=>"房间管理",'url_m'=>'Chat','url_c'=>'Admin','url_a'=>'chat_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>3));
	
			 
    $class_id=add_auth_class(array('title'=>"直播:管理员",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Chat'));
	

    add_auth(array('title'=>"直播设置",'name'=>'Chat/Setting/website_settings','auth_m'=>'Chat','auth_c'=>'Setting','auth_a'=>'website_settings','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"账户配置",'name'=>'Chat/Setting/Setting','auth_m'=>'Chat','auth_c'=>'Setting','auth_a'=>'Setting','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"表情:预览",'name'=>'Chat/Admin/face_list','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'face_list','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"表情:添加",'name'=>'Chat/Admin/face_add','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'face_add','class_id'=>$class_id,'status'=>1,'sort'=>3));
	add_auth(array('title'=>"表情:编辑",'name'=>'Chat/Admin/face_edit','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'face_edit','class_id'=>$class_id,'status'=>1,'sort'=>4));
	add_auth(array('title'=>"表情:删除",'name'=>'Chat/Admin/face_del','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'face_del','class_id'=>$class_id,'status'=>1,'sort'=>5));
	
	add_auth(array('title'=>"分类:预览",'name'=>'Chat/Admin/menu_list','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'menu_list','class_id'=>$class_id,'status'=>1,'sort'=>6));
	add_auth(array('title'=>"分类:添加",'name'=>'Chat/Admin/menu_add','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'menu_add','class_id'=>$class_id,'status'=>1,'sort'=>7));
	add_auth(array('title'=>"分类:编辑",'name'=>'Chat/Admin/menu_edit','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'menu_edit','class_id'=>$class_id,'status'=>1,'sort'=>8));
	add_auth(array('title'=>"分类:删除",'name'=>'Chat/Admin/menu_del','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'menu_del','class_id'=>$class_id,'status'=>1,'sort'=>9));
	
	add_auth(array('title'=>"礼物:预览",'name'=>'Chat/Admin/gift_list','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'gift_list','class_id'=>$class_id,'status'=>1,'sort'=>10));
	add_auth(array('title'=>"礼物:添加",'name'=>'Chat/Admin/gift_add','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'gift_add','class_id'=>$class_id,'status'=>1,'sort'=>11));
	add_auth(array('title'=>"礼物:编辑",'name'=>'Chat/Admin/gift_edit','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'gift_edit','class_id'=>$class_id,'status'=>1,'sort'=>12));
	add_auth(array('title'=>"礼物:删除",'name'=>'Chat/Admin/gift_del','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'gift_del','class_id'=>$class_id,'status'=>1,'sort'=>13));	

	add_auth(array('title'=>"房间:预览",'name'=>'Chat/Admin/chat_list','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'gift_list','class_id'=>$class_id,'status'=>1,'sort'=>10));
	add_auth(array('title'=>"房间:编辑",'name'=>'Chat/Admin/chat_edit','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'gift_edit','class_id'=>$class_id,'status'=>1,'sort'=>12));
	add_auth(array('title'=>"放假:删除",'name'=>'Chat/Admin/chat_del','auth_m'=>'Chat','auth_c'=>'Admin','auth_a'=>'gift_del','class_id'=>$class_id,'status'=>1,'sort'=>13));
	
	//会员中心
	

	add_menu(array('title'=>"直播管理",'url_m'=>'Chat','url_c'=>'User','url_a'=>'direct_live','type'=>'user','parent_id'=>0,'status'=>1,'sort'=>9));
	
	$class_id=add_auth_class(array('title'=>"直播:会员组",'type'=>'user','parent_id'=>0,'sort_num'=>0,'sign'=>'Chat'));
	
	add_auth(array('title'=>"直播管理",'name'=>'Chat/user/direct_live','auth_m'=>'Chat','auth_c'=>'user','auth_a'=>'direct_live','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"房间:申请",'name'=>'Chat/user/application','auth_m'=>'Chat','auth_c'=>'user','auth_a'=>'application','class_id'=>$class_id,'status'=>1,'sort'=>1));
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
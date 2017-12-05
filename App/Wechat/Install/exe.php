<?php
$this->install_sql_after=function($sign)
{
	//管理员中心
  	$menu_big_id=add_menu(array('title'=>"微信",'url_m'=>'Wechat','type'=>'admin','parent_id'=>0,'status'=>1,'sort'=>9));
	$menu_id=add_menu(array('title'=>"微信设置",'url_m'=>'Wechat','type'=>'admin','parent_id'=>$menu_big_id,'status'=>1,'sort'=>8));
	         add_menu(array('title'=>"基本设置",'url_m'=>'Wechat','url_c'=>'Setting','url_a'=>'base_setting','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
			 add_menu(array('title'=>"菜单设置",'url_m'=>'Wechat','url_c'=>'Setting','url_a'=>'menu_setting','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));
			 add_menu(array('title'=>"会员设置",'url_m'=>'Wechat','url_c'=>'Setting','url_a'=>'user_setting','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>2));

             $data=array('table'=>'wechat_key','name'=>'关键字','type'=>'Article','status'=>0,'model_class'=>'content','sign'=>'wechat');
			 $model_id=M('model')->add($data);
	$menu_id=add_menu(array('title'=>"关键字",'url_m'=>'Wechat','type'=>'admin','parent_id'=>$menu_big_id,'status'=>1,'sort'=>8));
	         add_menu(array('title'=>"关键字分类",'url_m'=>'Sys_model','url_c'=>'Class','url_a'=>'class_list','url_p'=>'modelid='.$model_id,'type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
			 add_menu(array('title'=>"关键字管理",'url_m'=>'Article','url_c'=>'Article','url_a'=>'article_list','url_p'=>'modelid='.$model_id,'type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));

    $class_id=add_auth_class(array('title'=>"微信:管理员",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Wechat'));
	

    add_auth(array('title'=>"微信:基本设置",'name'=>'Wechat/Setting/base_setting','auth_m'=>'Wechat','auth_c'=>'Setting','auth_a'=>'base_setting','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"微信:菜单设置",'name'=>'Wechat/Setting/menu_setting','auth_m'=>'Wechat','auth_c'=>'Setting','auth_a'=>'menu_setting','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"微信:会员设置",'name'=>'Wechat/Setting/user_setting','auth_m'=>'Wechat','auth_c'=>'Setting','auth_a'=>'user_setting','class_id'=>$class_id,'status'=>1,'sort'=>2));

	add_auth(array('title'=>"关键字-分类:预览",'name'=>'Sys_model/Class/class_list?modelid='.$model_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_list','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>3));
	add_auth(array('title'=>"关键字-分类:添加",'name'=>'Sys_model/Class/class_add?modelid='.$model_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_add','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>4));
	add_auth(array('title'=>"关键字-分类:编辑",'name'=>'Sys_model/Class/class_edit?modelid='.$model_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_edit','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>5));
    add_auth(array('title'=>"关键字-分类:删除",'name'=>'Sys_model/Class/class_del?modelid='.$model_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_del','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>6));
	
	add_auth(array('title'=>"关键字:预览",'name'=>'Article/Article/article_list?modelid='.$model_id,'auth_m'=>'Article','auth_c'=>'Article','auth_a'=>'article_list','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>7));
	add_auth(array('title'=>"关键字:添加",'name'=>'Article/Article/article_add?modelid='.$model_id,'auth_m'=>'Article','auth_c'=>'Article','auth_a'=>'article_add','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>8));
	add_auth(array('title'=>"关键字:编辑",'name'=>'Article/Article/article_edit?modelid='.$model_id,'auth_m'=>'Article','auth_c'=>'Article','auth_a'=>'article_edit','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>9));
    add_auth(array('title'=>"关键字:删除",'name'=>'Article/Article/article_del?modelid='.$model_id,'auth_m'=>'Article','auth_c'=>'Article','auth_a'=>'article_del','auth_p'=>'modelid='.$model_id,'class_id'=>$class_id,'status'=>1,'sort'=>10));
	
	$data=array('table'=>'wechat_key','name'=>'微信关键字','type'=>'Article','model_class'=>'content','sign'=>'wechat_key');
	M('model')->add($data);
};

$this->install_db_exist=function($install,$table_exist)
{
	 foreach($table_exist as $v)
	 {
		  echo "存在数据表：$v <BR>";
	 }
	 exit();
};

$this->uninstall_before=function($install)
{
	  $model_id=M('model')->where(array('table'=>'wechat_key'))->getField('id');;
	  $del_data=array(
	       'auth_rule'=>array('auth_p'=>'modelid='.$model_id),
		   'sys_model_class'=>array('modelid'=>$model_id),
		   'menu'=>array('url_p'=>'modelid='.$model_id),
		   'model'=>array('id'=>$model_id),
		   );
	  del_data($del_data);
};
?>
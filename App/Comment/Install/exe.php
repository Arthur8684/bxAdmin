<?php
$this->install_sql_after=function($sign)
{
	//管理员中心
	add_menu(array('title'=>"评论设置",'url_m'=>'Comment','url_c'=>'Admin','url_a'=>'setting','type'=>'admin','parent_id'=>40,'status'=>1,'sort'=>2));
	add_menu(array('title'=>"评论预览",'url_m'=>'Comment','url_c'=>'Admin','url_a'=>'comment_list','type'=>'admin','parent_id'=>40,'status'=>1,'sort'=>3));
			 
    $class_id=add_auth_class(array('title'=>"内容评论",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Comment'));
	

    add_auth(array('title'=>"评论设置",'name'=>'Comment/Admin/setting','auth_m'=>'Comment','auth_c'=>'Admin','auth_a'=>'setting','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"评论:预览",'name'=>'Comment/Admin/comment_list','auth_m'=>'Comment','auth_c'=>'Admin','auth_a'=>'comment_list','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"评论:审核",'name'=>'Comment/Admin/comment_audit','auth_m'=>'Comment','auth_c'=>'Admin','auth_a'=>'comment_audit','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"评论:删除",'name'=>'Comment/Admin/comment_del','auth_m'=>'Comment','auth_c'=>'Admin','auth_a'=>'comment_del','class_id'=>$class_id,'status'=>1,'sort'=>3));
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
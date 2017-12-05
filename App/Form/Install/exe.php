<?php
$this->install_before=function($sign)
{
	//管理员中心
	add_menu(array('title'=>"表单管理",'url_m'=>'Form','url_c'=>'Admin','url_a'=>'form_list','type'=>'admin','parent_id'=>7,'status'=>1,'sort'=>2));
			 
    $class_id=add_auth_class(array('title'=>"表单:管理员",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Form'));
	
    add_auth(array('title'=>"表单:设置",'name'=>'Form/Setting/Setting','auth_m'=>'Form','auth_c'=>'Setting','auth_a'=>'Setting','class_id'=>$class_id,'status'=>1,'sort'=>0));
    add_auth(array('title'=>"表单:预览",'name'=>'Form/Admin/form_list','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"表单:添加",'name'=>'Form/Admin/form_add','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_add','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"表单:编辑",'name'=>'Form/Admin/form_edit','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_edit','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"表单:删除",'name'=>'Form/Admin/form_del','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_del','class_id'=>$class_id,'status'=>1,'sort'=>3));

	add_auth(array('title'=>"表单-内容:预览",'name'=>'Form/Admin/form_content_list','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_content_list','class_id'=>$class_id,'status'=>1,'sort'=>4));
	add_auth(array('title'=>"表单-内容:添加",'name'=>'Form/Admin/form_content_add','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_content_add','class_id'=>$class_id,'status'=>1,'sort'=>5));
	add_auth(array('title'=>"表单-内容:编辑",'name'=>'Form/Admin/form_content_edit','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_content_edit','class_id'=>$class_id,'status'=>1,'sort'=>6));
	add_auth(array('title'=>"表单-内容:预览",'name'=>'Form/Admin/form_content_del','auth_m'=>'Form','auth_c'=>'Admin','auth_a'=>'form_content_del','class_id'=>$class_id,'status'=>1,'sort'=>7));

	//会员中心
	add_menu(array('title'=>"信息提交",'url_m'=>'Form','url_c'=>'User','url_a'=>'form_list','type'=>'user','parent_id'=>0,'status'=>1,'sort'=>10));
			 
    $class_id=add_auth_class(array('title'=>"表单:会员",'type'=>'user','parent_id'=>0,'sort_num'=>0,'sign'=>'Form'));
	
    add_auth(array('title'=>"信息提交",'name'=>'Form/User/form_list','auth_m'=>'Form','auth_c'=>'User','auth_a'=>'form_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
};

$this->uninstall_before=function($install,$table_exist)
{
	$table=M('model')->where(array('model_class'=>'form'))->getField('table',true);
	if($table)  del_table($table);
    
};
?>
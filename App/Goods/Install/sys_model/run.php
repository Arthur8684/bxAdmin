<?php 
    $menu_id=add_menu(array('title'=>$_POST['name'].L('SYSTEM'),'url_m'=>'Goods','parent_id'=>3,'model_id'=>$insert_id,'type'=>'admin','status'=>1,'sort'=>2));
	add_menu(array('title'=>"字段管理",'url_m'=>'Field','url_c'=>'Field','url_a'=>'field_list','url_p'=>'modelid='.$insert_id,'type'=>'admin','parent_id'=>$menu_id,'model_id'=>$insert_id,'status'=>1,'sort'=>0));
	add_menu(array('title'=>$_POST['name']."分类",'url_m'=>'Sys_model','url_c'=>'Class','url_a'=>'class_list','url_p'=>'modelid='.$insert_id,'type'=>'admin','parent_id'=>$menu_id,'model_id'=>$insert_id,'status'=>1,'sort'=>1));
	add_menu(array('title'=>"内容管理",'url_m'=>'Goods','url_c'=>'Goods','url_a'=>'goods_list','url_p'=>'modelid='.$insert_id,'type'=>'admin','parent_id'=>$menu_id,'model_id'=>$insert_id,'status'=>1,'sort'=>2));
	add_menu(array('title'=>"库存管理",'url_m'=>'Goods','url_c'=>'Goods','url_a'=>'all_inventory_list','url_p'=>'modelid='.$insert_id,'type'=>'admin','parent_id'=>$menu_id,'model_id'=>$insert_id,'status'=>1,'sort'=>3));
	load('Field/function');
	field_set_config($insert_id);

	$class_id=add_auth_class(array('title'=>$_POST['name']."系统",'type'=>'admin','parent_id'=>0,'model_id'=>$insert_id,'sort_num'=>0));
	add_auth(array('title'=>"内容管理",'name'=>'Goods/Goods/goods_list?modelid='.$insert_id,'auth_m'=>'Goods','auth_c'=>'Goods','auth_a'=>'goods_list','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>0));
	add_auth(array('title'=>"添加信息",'name'=>'Goods/Goods/goods_add?modelid='.$insert_id,'auth_m'=>'Goods','auth_c'=>'Goods','auth_a'=>'goods_add','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"删除信息",'name'=>'Goods/Goods/goods_del?modelid='.$insert_id,'auth_m'=>'Goods','auth_c'=>'Goods','auth_a'=>'goods_del','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"编辑信息",'name'=>'Goods/Goods/goods_edit?modelid='.$insert_id,'auth_m'=>'Goods','auth_c'=>'Goods','auth_a'=>'goods_edit','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>3));
	add_auth(array('title'=>"信息审核",'name'=>'Sys_model/Index/verify?modelid='.$insert_id,'auth_m'=>'Sys_model','auth_c'=>'Index','auth_a'=>'verify','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>3));

	add_auth(array('title'=>"管理分类",'name'=>'Sys_model/Class/class_list?modelid='.$insert_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_list','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>4));
	add_auth(array('title'=>"添加分类",'name'=>'Sys_model/Class/class_add?modelid='.$insert_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_add','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>5));
	add_auth(array('title'=>"删除分类",'name'=>'Sys_model/Class/class_del?modelid='.$insert_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_del','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>6));
	add_auth(array('title'=>"编辑分类",'name'=>'Sys_model/Class/class_edit?modelid='.$insert_id,'auth_m'=>'Sys_model','auth_c'=>'Class','auth_a'=>'class_edit','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>7));
	
	add_auth(array('title'=>"字段管理",'name'=>'Field/Field/field_list?modelid='.$insert_id,'auth_m'=>'Field','auth_c'=>'Field','auth_a'=>'field_list','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>8));
	add_auth(array('title'=>"添加字段",'name'=>'Field/Field/field_add?modelid='.$insert_id,'auth_m'=>'Field','auth_c'=>'Field','auth_a'=>'field_add','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>9));
	add_auth(array('title'=>"删除字段",'name'=>'Field/Field/field_del?modelid='.$insert_id,'auth_m'=>'Field','auth_c'=>'Field','auth_a'=>'field_del','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>10));
	add_auth(array('title'=>"编辑字段",'name'=>'Field/Field/field_edit?modelid='.$insert_id,'auth_m'=>'Field','auth_c'=>'Field','auth_a'=>'field_edit','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>11));
	add_auth(array('title'=>"库存管理",'name'=>'Goods/Goods/all_inventory_list?modelid='.$insert_id,'auth_m'=>'Goods','auth_c'=>'Goods','auth_a'=>'all_inventory_list','auth_p'=>'modelid='.$insert_id,'class_id'=>$class_id,'status'=>1,'sort'=>12));
?>
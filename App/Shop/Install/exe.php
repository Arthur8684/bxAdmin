<?php
$this->install_before=function($sign)
{
	//管理员中心
	$menu_id=add_menu(array('title'=>"商家管理",'url_m'=>'Shop','url_c'=>'Admin','type'=>'admin','parent_id'=>4,'status'=>1,'sort'=>2));
	         add_menu(array('title'=>"店铺分类",'url_m'=>'Shop','url_c'=>'Admin','url_a'=>'shop_category_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
			 add_menu(array('title'=>"店铺管理",'url_m'=>'Shop','url_c'=>'Admin','url_a'=>'shop_list','type'=>'admin','parent_id'=>$menu_id,'status'=>1,'sort'=>1));

    $class_id=add_auth_class(array('title'=>"商家:管理员",'type'=>'admin','parent_id'=>0,'sort_num'=>0,'sign'=>'Shop'));
	
    add_auth(array('title'=>"店铺:预览",'name'=>'Shop/Admin/shop_list','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'shop_list','class_id'=>$class_id,'status'=>1,'sort'=>0));
    add_auth(array('title'=>"店铺:添加",'name'=>'Shop/Admin/shop_add','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'shop_add','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"店铺:编辑",'name'=>'Shop/Admin/shop_edit','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'shop_edit','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"店铺:删除",'name'=>'Shop/Admin/shop_del','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'form_del','class_id'=>$class_id,'status'=>1,'sort'=>3));

	add_auth(array('title'=>"店铺分类:预览",'name'=>'Shop/Admin/shop_category_list','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'shop_category_list','class_id'=>$class_id,'status'=>1,'sort'=>4));
	add_auth(array('title'=>"店铺分类:添加",'name'=>'Shop/Admin/shop_category_add','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'shop_category_add','class_id'=>$class_id,'status'=>1,'sort'=>5));
	add_auth(array('title'=>"店铺分类:编辑",'name'=>'Shop/Admin/shop_category_edit','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'shop_category_edit','class_id'=>$class_id,'status'=>1,'sort'=>6));
	add_auth(array('title'=>"店铺分类:删除",'name'=>'Shop/Admin/shop_category_del','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'shop_category_del','class_id'=>$class_id,'status'=>1,'sort'=>7));

	add_auth(array('title'=>"分配商品",'name'=>'Shop/Admin/allot_goods','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'allot_goods','class_id'=>$class_id,'status'=>1,'sort'=>8));
	add_auth(array('title'=>"管理商品",'name'=>'Shop/Admin/manage_goods','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'manage_goods','class_id'=>$class_id,'status'=>1,'sort'=>9));
	add_auth(array('title'=>"删除商品",'name'=>'Shop/Admin/goods_del','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'goods_del','class_id'=>$class_id,'status'=>1,'sort'=>10));
	add_auth(array('title'=>"库存明细",'name'=>'Shop/Admin/inventory_list','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'inventory_list','class_id'=>$class_id,'status'=>1,'sort'=>11));
	
	add_auth(array('title'=>"管理库存",'name'=>'Shop/Admin/goods_allot_add','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'goods_allot_add','class_id'=>$class_id,'status'=>1,'sort'=>12));
	add_auth(array('title'=>"设置价格",'name'=>'Shop/Admin/goods_set_price','auth_m'=>'Shop','auth_c'=>'Admin','auth_a'=>'goods_set_price','class_id'=>$class_id,'status'=>1,'sort'=>13));

	//会员中心
	$menu_id=add_menu(array('title'=>"出售产品",'url_m'=>'Shop','type'=>'sell','parent_id'=>0,'status'=>1,'sort'=>0));
	         add_menu(array('title'=>"出售产品",'url_m'=>'Shop','url_c'=>'Consume"','url_a'=>'index','type'=>'sell','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
	
 	$menu_id=add_menu(array('title'=>"店铺管理",'url_m'=>'Shop','type'=>'sell','parent_id'=>0,'status'=>1,'sort'=>1));
	         add_menu(array('title'=>"修改店铺",'url_m'=>'Shop','url_c'=>'Sell"','url_a'=>'alter_shop_info','type'=>'sell','parent_id'=>$menu_id,'status'=>1,'sort'=>1));
			 add_menu(array('title'=>"店铺模板",'url_m'=>'Shop','url_c'=>'Sell"','url_a'=>'select_color','type'=>'sell','parent_id'=>$menu_id,'status'=>1,'sort'=>0));

    $menu_id=add_menu(array('title'=>"订单管理",'url_m'=>'Shop','type'=>'sell','parent_id'=>0,'status'=>1,'sort'=>2));
	         add_menu(array('title'=>"我的订单",'url_m'=>'Shop','url_c'=>'Sell"','url_a'=>'order_list','type'=>'sell','parent_id'=>$menu_id,'status'=>1,'sort'=>0));
			 
    $class_id=add_auth_class(array('title'=>"商家:会员",'type'=>'user','parent_id'=>0,'sort_num'=>0,'sign'=>'Shop'));
	
    add_auth(array('title'=>"管理店铺",'name'=>'Shop/Sell/index','auth_m'=>'Shop','auth_c'=>'Sell','auth_a'=>'index','class_id'=>$class_id,'status'=>1,'sort'=>0));
	
	add_auth(array('title'=>"出售产品",'name'=>'Shop/Consume/index','auth_m'=>'Shop','auth_c'=>'Consume','auth_a'=>'index','class_id'=>$class_id,'status'=>1,'sort'=>1));
	add_auth(array('title'=>"修改店铺",'name'=>'Shop/Sell/alter_shop_info','auth_m'=>'Shop','auth_c'=>'Sell','auth_a'=>'alter_shop_info','class_id'=>$class_id,'status'=>1,'sort'=>2));
	add_auth(array('title'=>"店铺模板",'name'=>'Shop/Sell/select_color','auth_m'=>'Shop','auth_c'=>'Sell','auth_a'=>'select_color','class_id'=>$class_id,'status'=>1,'sort'=>3));
	add_auth(array('title'=>"我的订单",'name'=>'Shop/Sell/order_list','auth_m'=>'Shop','auth_c'=>'Sell','auth_a'=>'order_list','class_id'=>$class_id,'status'=>1,'sort'=>4));
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
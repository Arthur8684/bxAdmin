<?php

namespace Admin\Model;
use Think\Model;
class MenuModel extends Model{
//自动完成验证参数
		 protected $_validate = array(
				array('title','require','{%ADMIN_Menu_Name_Empty}'),//默认情况下用正则进行验证
				//array('url','url','{%ADMIN_Url_form}',0), // 验证链接格式是否正确
		   );
		   protected $tableName = 'menu'; 

		   
}
?>
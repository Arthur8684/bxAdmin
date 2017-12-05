<?php
namespace Fenxiao\Controller;
use Org\Util\Admin;
class SettingController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function setting(){

		if(IS_POST)
		{
		    $post=I('post.');
			FF('Conf/config',$post,MODULE_PATH);
			C($post);
		}
		$this->display();
    }
}
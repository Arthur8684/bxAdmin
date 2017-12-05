<?php
namespace User\Controller;
use Org\Util\Admin;
class SettingController extends Admin {
   function __construct()  //析构函数
   {  
        parent::__construct();
        
   }  
    public function setting(){
		if(IS_POST)
		{
		    $post=data_(I('post.'),'__hash__');
			FF("user_group/user_config",$post);
		}
        $c=FF("user_group/user_config");
		$this->assign('c',$c);
		$this->display();
    }
}
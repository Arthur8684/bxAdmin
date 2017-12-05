<?php
namespace Message\Controller;
use Org\Util\Admin;
class SettingController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
	public function setting(){
		if(IS_POST){
			$post=data_(I('post.'),'__hash__');
			FF('Conf/set_config',$post,MODULE_PATH);
		}
		$c=FF('Conf/set_config','',MODULE_PATH);
		$this->assign('c',$c);
		$this->assign('group',group_list_());
		$this->display();
	}
}
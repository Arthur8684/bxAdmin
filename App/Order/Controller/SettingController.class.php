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
			$post['fengxiao_ceng_num']=I('post.fengxiao_ceng_num',3,'intval');
			$post['fengxiao_price']=I('post.fengxiao_price',30,'intval');
			FF('Conf/config',$post,MODULE_PATH);
			C($post);
		}
		echo return_parent_id(9,5);
		$this->display();
    }
}
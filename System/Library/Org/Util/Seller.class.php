<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace Org\Util;
use Org\Util\User;
/**
 * Seller控制器基类 抽象类 商家
 */
abstract class Seller  extends User{
  
    public $shopinfo   = array();
	
	public $site_id   = 0;
	
	public $r_time = 0 ; //提示信息跳转的时长
	
    public function __construct() {
	  
        parent::__construct();
		$this->r_time = C('JUMP_TIME');
		IS_AJAX?$this->IS_SELLER_AJAX():$this->IS_SELLER();
		$GLOBALS['SHOP_INFO'] = $this->shopinfo;
    }
	
	function IS_SELLER()
	{
	     $session_id=$GLOBALS['LOGIN_USER']['id'];
		 if($session_id)
		 {
			  $shop_info=M('shop')->where(array('user_id'=>$session_id))->find();			 
			  if($shop_info)
			  {
				   $this->shopinfo=$shop_info;
			  }
			  else
			  {
				  $this->error(L('NO_AUTH'),"",$this->r_time);	
			  }
		 }
		 else
		 {
		       $this->redirect('User/login/index','',0);
		 }
	}


	function IS_SELLER_AJAX()
	{
	     $session_id=$GLOBALS['LOGIN_USER']['id'];
		 if($session_id)
		 {
		      $shop_info=M('shop')->where(array('user_id'=>$session_id))->find();	
			  if($shop_info)
			  {
				   $this->shopinfo=$shop_info;
			  }
			  else
			  {
					 $return['err']  = 1;
					 $return['content'] = L('NO_AUTH');	 
					 $this->ajaxReturn($return);
					 exit();
			  }
		 }
		 else
		 {
					 $return['err']  = 1;
					 $return['content'] = L('NO_AUTH');	 
					 $this->ajaxReturn($return);
					 exit();
		 }
	}
   
}

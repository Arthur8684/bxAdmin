<?php
namespace Shop\Controller;
use Org\Util\Seller;
class ConsumeController extends Seller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   商家出售产品
-----------------------------------   
*/	

    public function  index(){
		$shop=$this->userinfo;
		if(IS_POST){
		$user_type=I('user_type');
		$user_info=I('recharge_user_info');
		$num=I('pay_num',0,'intval');
		$shop_user_id=$shop['id'];
		$shop_pass	=I('shop_pay_pass');
		if(!$user_type || !$user_info || !$num || !$shop_user_id || !$shop_pass) $this->error(L('ERR_recharge'),"",$this->r_time);
		$action=user_recharge($user_type,$user_info,$num,$shop_user_id,$shop_pass);
		if($action['action']=='err'){
			$this->error(L('ERR_recharge_'.$action['name']),"",$this->r_time);
			}else{
			$this->success(L('success'),'',$this->r_time);	
				}
					}else{
		 M('cart')->where(array('shop_id'=>$GLOBALS['SHOP_INFO']['id']))->delete(); 	
	     $this->display();	 
			}
    }
	/*
-----------------------------------  
   通过会员卡获取会员信息
-----------------------------------   
*/	
    public function  get_user(){  	
	          $this->display();	   
    }
}
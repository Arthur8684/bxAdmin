<?php
namespace Accounts\Controller;
use Think\Controller;
class AlipayController extends Controller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
   
    public function notify_url(){
		    Vendor('Alipay.AlipayNotify');
			$type=I('type')?I('type'):1;
			$alipay_config=alipay_config($type);
			
			//计算得出通知验证结果
			$alipayNotify = new \AlipayNotify($alipay_config);
			$verify_result = $alipayNotify->verifyNotify();
			
			if($verify_result) {//验证成功

				if($_POST['trade_status'] == 'TRADE_FINISHED') {
			            alipay_notify_trade_finished($_POST); //交易完成
				}
				else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                        alipay_notify_trade_success($_POST); //支付完成
				}
			
				//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
					
				echo "success";		//请不要修改或删除
				/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			}
			else {
				//验证失败
				//notify_trade_fail($_POST);//验证失败
				echo "fail";
               
			}
    }
	
	    public function return_url(){
				  Vendor('Alipay.AlipayNotify');
			      $type=I('type')?I('type'):1;
			      $alipay_config=alipay_config($type);
				  $alipayNotify = new \AlipayNotify($alipay_config);
				  $verify_result = $alipayNotify->verifyReturn();
				  if($verify_result) {//验证成功
					  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				  
					  if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
						    alipay_return_trade($_GET); //支付完成或者支付成功
					  }
					  else {
						    alipay_return_trade_o($_GET);//非支付完成或者交易完成执行
						    //echo "trade_status=".$_GET['trade_status'];
					  }
                        
					 // alipay_return_success($_POST);//验证成功
					  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				  }
				  else {
					  file_put_contents('3.txt', '111');
					  //alipay_return_fail($_POST);//验证失败
				  }
    }

}
<?php
namespace Accounts\Controller;
use Think\Controller;
import("Accounts.Util.WxPayDataBase");
class PayController extends Controller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
   
    public function wx_pay_html5(){
		//①、获取用户openid
		$tools = new \Accounts\Util\JsApiPay();
		$openId = $tools->GetOpenid();
		$param=session('wx_pay_html5');
		//②、统一下单			
		$input = new \Accounts\Util\WxPayUnifiedOrder();
		$input->SetBody($param['body']); 
		$input->SetAttach($param['attach']);
		$input->SetOut_trade_no($param['out_trade_no']);
		$input->SetTotal_fee($param['price']);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag($param['goods_tag']);
		$input->SetNotify_url(C('site_url').U('Accounts/Pay/notify'));
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = \Accounts\Util\WxPayApi::unifiedOrder($input);
		$info=$this->printf_info($order);
		$jsApiParameters = $tools->GetJsApiParameters($order);
		
		//获取收货地址
		$editAddress = $tools->GetEditAddressParameters();
		$this->assign('info',$info);
		$this->assign('jsApiParameters',$jsApiParameters );
		$this->assign('editAddress',$editAddress);
		$this->assign('total_fee',number_format(($param['price']*0.01),2));
		$this->assign('out_trade_no',$param['out_trade_no']);
		$this->assign('page_title',L('Accounts_wx_Pay'));
        $this->display('pay');
    }
/*
-----------------------------------  
* 微信扫描支付 扫描方式二的回掉* 微信扫描支付 扫描方式二的回* 微信扫描支付 扫描方式二的回* 微信扫描支付 扫描方式二的回* 微信扫描支付 扫描方式二的回* 微信扫描支付 扫描方式二的回* 微信扫描支付 扫描方式二的回
-----------------------------------   
*/	
	function native_notify()
	{ 
		$notify = new \Accounts\Util\NativeNotifyCallBack();
		$notify->Handle(true);	
	}	
/*
-----------------------------------  
* 扫描支付付款成功后的链接
-----------------------------------   
*/		
    function notify()
	{      
		  $notify = new \Accounts\Util\PayNotifyCallBack();
		  $notify->Handle(false);
	}	
	
 //订单状态更新
	function pay_order_status($out_trade_no,$pay_type=0,$coin_type='money'){
		load("Order/function");	
		$order_id=explode("|",$out_trade_no);
		foreach($order_id as $val){
			if($val){
			$order=M('order');
			$orders=$order->where("id=".$val."")->find();
			$order_info=M('order_info');
			$order_info_list=$order_info->where("order_sn='".$orders['order_sn']."'")->find();
			$model_id=$order_info_list['model_id'];
			$model_config=model_config($model_id);	
			order_status(intval($val),1,'order_status',$model_config['goods_type']);	
			order_status(intval($val),1,'pay_status',$model_config['goods_type'],$pay_type,1,$coin_type);
			}			
		}
		return true;
		}			
 /*余额付款*/
 	function pay_list(){
		$model_id=I('model_id');
		$order_id=I('order_id');
		if(!$model_id){$pay_type='money';	
		$order_id_one=explode("|",$order_id);
		$order_id_one=$order_id_one[0];
		$orders=M('order')->where("id=".$order_id_one."")->find();
		$order_info=M('order_info');
		$order_info_list=$order_info->where("order_sn='".$orders['order_sn']."'")->find();
		$model_id=$order_info_list['model_id'];
		}
		$model_config=model_config($model_id);
		$pay_type=$model_config['point_type'];
		if(!$pay_type) $pay_type='money';
		$this->assign('order_id',$order_id);
		$this->assign('pay_type',$pay_type);
		$this->assign('page_title',L('Accounts_Pay_center'));
		$this->display();
		}	
 		
		
 
 /*余额付款*/
	function balance_pay(){
		$order_in=I('order_in');
		$this->assign('order_in',$order_in);
		$order123=M('order');
		$order_in=explode("|",$order_in);
		if(!$pay_type){
			$orders=M('order')->where("id=".$order_in[0]."")->find();
			if($orders['pay_status']==1) $this->error(L('该订单已经支付成功，无需再支付'),U('mobile/order/order_list','pay_status=1'),3);	
			$order_info_list=M('order_info')->where("order_sn='".$orders['order_sn']."'")->find();
			$model_id=$order_info_list['model_id'];	
		}
		if($model_id){
			$model_config=model_config($model_id);
			$pay_type=$model_config['point_type'];
		}else{
			$pay_type=I('pay_type');
			}
		$price=0;
	    foreach($order_in as $val){
			if($val){
				$where1['id']=$val;
				$where1['pay_status']=0;
				$order_info=$order123->where($where1)->find(); 
				$user_id=$order_info['user_id'];
				$price=$price+$order_info['order_amount'];
			}
		}
		$user=M('user');
		$user_info=$user->where('id='.$user_id.'')->find();
		if(IS_POST){
		if($user_info[$pay_type]<$price){
			$this->error(L('Accounts_balance_Pay_err'),U('User/index/index','pay_status=0'),3);	
		}else{
			$order_in=I('order_in');
					
			if($this->pay_order_status($order_in,5,$pay_type)){
			   $this->success(L('Accounts_balance_Pay_suc'),U('User/index/index','ship_status=0&pay_status=1'),3);	
				}
			}
			}else{
		
		if($user_info[$pay_type]>=$price){
			$this->assign('is_balance','yes');	
			}
		$this->assign('user_info',$user_info);
		$this->assign('pay_type',$pay_type);
		$this->assign('page_title',L('Accounts_balance_Pay'));
		$this->assign('price',$price);
		$this->display();
		}
		}
	
}
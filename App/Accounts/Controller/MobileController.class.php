<?php
namespace Accounts\Controller;
use Org\Util\User;
class MobileController extends User {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function pay(){

		//①、获取用户openid
		$tools = new \Accounts\Util\JsApiPay();
		$openId = $tools->GetOpenid();
		$order_id=I('get.order_id');
		$config=FF('Conf/config','',COMMON_PATH);
		//②、统一下单
		/*
		获取订单信息
		*/
		$order123=M('order');
		$sn_array=explode("|",$order_id);
		if($sn_array[0]=='recharge'){	
		$infos['body']='ID:'.$order_id.'充值信息';
		$infos['attach']='123';
		$infos['out_trade_no']=$sn_array[1].'|'.time();
		$infos['total_fee']=$sn_array[2]*100;
		$infos['goods_tag']=''.$order_id.'';
		$infos['notify_url']=''.$config['site_url'].'/index.php/Accounts/pay/pay2.php';					
			}else if($sn_array[0]=='qrcode'){	
		$infos['body']='ID:'.$sn_array[1].'购买二维码图片';
		$infos['attach']='123';
		$infos['out_trade_no']=$sn_array[1].'|'.time();
		$infos['total_fee']=$sn_array[2]*100;
		$infos['goods_tag']=''.$order_id.'';
		$infos['notify_url']=''.$config['site_url'].'/index.php/Accounts/pay/pay3.php';					
			}else{			
	    $price=0;
	    foreach($sn_array as $val){
		$where1['id']=$val;
		$order_info=$order123->where($where1)->find(); 
		$price=$price+$order_info['order_amount'];
		  }
		$infos['body']='ID:'.$order_id.'订单信息';
		$infos['attach']='123321';
		$infos['out_trade_no']=$order_id.'|'.time();
		$infos['total_fee']=$price*100;
		$infos['goods_tag']=''.$order_id.'';
		
		$infos['notify_url']=''.$config['site_url'].'/index.php/Accounts/pay/pay1.php';
		$this->assign('out_trade_no',$infos['out_trade_no']);
		$this->assign('order_id',$order_id);
		$this->assign('is_balance','yes' );
		}	
		/*
		获取订单信息结束
		*/				
		$input = new \Accounts\Util\WxPayUnifiedOrder();
		$input->SetBody($infos['body']); 
		$input->SetAttach($infos['attach']);
		$input->SetOut_trade_no($infos['out_trade_no']);
		$input->SetTotal_fee($infos['total_fee']);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag($infos['goods_tag']);
		//$input->SetNotify_url($notify_url);
		$input->SetNotify_url($infos['notify_url']);
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = \Accounts\Util\WxPayApi::unifiedOrder($input);
		$info=$this->printf_info($order);
		$jsApiParameters = $tools->GetJsApiParameters($order);
		
		//获取共享收货地址js函数参数
		$editAddress = $tools->GetEditAddressParameters();
		$this->assign('info',$info );
		$this->assign('jsApiParameters',$jsApiParameters );
		$this->assign('editAddress',$editAddress);
		$this->assign('total_fee',number_format(($infos['total_fee']*0.01),2));
		$this->assign('out_trade_no',$infos['body']);
		$this->assign('page_title',L('Accounts_wx_Pay'));
        $this->display('pay');
    }
	
	
	function pay1()
	{      
			$xml = file_get_contents("php://input");
			$array=\Accounts\Util\WxPayDataBase::FromXml($xml);
			if($array['result_code']=='SUCCESS' && $array['return_code']=='SUCCESS' ){
				$this->pay_order_status($array['out_trade_no'],4);
				}
			file_put_contents('./1/'.date('Y-m-d-H-i-s').'.php', array2string($array));
			$xml="<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
			echo $xml; 
			
	}
	function pay2()
	{      
			$xml = file_get_contents("php://input");
			$array=\Accounts\Util\WxPayDataBase::FromXml($xml);
			if($array['result_code']=='SUCCESS' && $array['return_code']=='SUCCESS' ){
				$noo=explode("|",$array['out_trade_no']);
				account($array['total_fee']*0.01,$noo[0],'money',0,4,'SYSTEM','用户充值');
				//$this->pay_order_status($array['out_trade_no']);
				}
			file_put_contents('./1/'.date('Y-m-d-H-i-s').'.php', array2string($array));
			$xml="<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
			echo $xml; 
			
	}
	function pay3()
	{      
			$xml = file_get_contents("php://input");
			$array=\Accounts\Util\WxPayDataBase::FromXml($xml);
			if($array['result_code']=='SUCCESS' && $array['return_code']=='SUCCESS' ){
				$noo=explode("|",$array['out_trade_no']);
				account(-$array['total_fee']*0.01,$noo[0],'money',5,4,'SYSTEM','用户购买二维码图片',0);
				set_grand($noo[0],$type=array('consumption'=>$array['total_fee']*0.01));
				$user=M('user');
				$data['qrcode_open']=1;
				$user->where('id='.$noo[0].'')->save($data);
				//$this->pay_order_status($array['out_trade_no']);
				}
			file_put_contents('./1/'.date('Y-m-d-H-i-s').'.php', array2string($array));
			$xml="<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
			echo $xml; 
			
	}

	function printf_info($data)
	{
	    $str="";
		foreach($data as $key=>$value){
			$str.="<font color='#00ff55;'>$key</font> : $value <br/>";
		}
		return $str;
	}
	
 //订单状态更新
	function pay_order_status($out_trade_no,$pay_type=0,$coin_type){
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
			order_status(intval($val),1,'order_status',$model_config['goods_type'],$pay_type,1,$coin_type);	
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
		
	function balance_pay_qrcode(){
		$order_in=I('order_in');
		$pay_type=I('pay_type');
		$this->assign('order_in',$order_in);
		$order123=M('order');
		$order_in=explode("|",$order_in);
		$price=$order_in[2];
		$user_id=$order_in[1];
		$user=M('user');
		$user_info=$user->where('id='.$user_id.'')->find();
		if(IS_POST){
		if($user_info[$pay_type]<$price){
			$this->error(L('Accounts_balance_Pay_err'),U('mobile/User/order_list','pay_status=0'),3);	
		}else{
			account(-$order_in[2],$order_in[1],$pay_type,5,5,'SYSTEM','用户购买二维码图片');
			$data['qrcode_open']=1;
			$user->where('id='.$order_in[1].'')->save($data);
			$this->success(L('Accounts_balance_Pay_suc'),U('Wechat/User/user_setting'),3);	
			}
		 }
		if($user_info['money']>=$price){
			$this->assign('is_balance','yes');	
			}
		$this->assign('user_info',$user_info);
		$this->assign('page_title',L('Accounts_balance_Pay'));
		$this->assign('price',$price);
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
		//if(!$pay_type) $this->error(L('Accounts_balance_Pay_err'),'',3);
//			//二级密码验证
//			$pass=I('pass');
//			$user=$this->userinfo;
//			$where['id']=$user['id'];
//			$where['pay_pass']=md5($pass);
//			if(!M('user')->where($where)->find()){		
//				$this->error('验证失败',"",3);	
//			}
		    //二级密码验证结束
		if($user_info[$pay_type]<$price){
			$this->error(L('Accounts_balance_Pay_err'),U('mobile/order/order_list','pay_status=0'),3);	
		}else{
			$order_in=I('order_in');
					
			if($this->pay_order_status($order_in,5,$pay_type)){
			   $this->success(L('Accounts_balance_Pay_suc'),U('mobile/order/order_list','ship_status=0&pay_status=1'),3);	
				}
			}
			}else{
		
		if($user_info[$pay_type]>=$price){
			$this->assign('is_balance','yes');	
			}
		$k = M('user')->where('id='.$user_id)->select();
		$this->assign('user',$k);
		$this->assign('user_info',$user_info);
		$this->assign('pay_type',$pay_type);
		$this->assign('page_title',L('Accounts_balance_Pay'));
		$this->assign('price',$price);
		$this->display();
			}
		
		}		
}
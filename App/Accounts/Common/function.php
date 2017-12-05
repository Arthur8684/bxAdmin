<?php
/*
-----------------------------------  
* 微信扫描支付 扫描方式一 参数 array('body'=>'body','attach'=>'attach','out_trade_no'=>'123456','goods_tag'=>'goods_tag','price'=>1) out_trade_no为32为字符
* 1、组装包含支付信息的url，生成二维码
* 2、用户扫描二维码，进行支付
* 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中配置
* 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付
* 5、支付完成之后，微信服务器
* 6、在支付成功通知中需要查单
-----------------------------------   
*/	
function wx_pay_html5($data)
{ 
	  session('wx_pay_html5',$data);
	  header("Location: ".U('Accounts/Pay/wx_pay_html5')); 
}
/*
-----------------------------------  
* 微信扫描支付 扫描方式一 参数 $product_id 用户的产品ID 回掉页面原样返回
* 1、组装包含支付信息的url，生成二维码
* 2、用户扫描二维码，进行支付
* 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中配置
* 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付
* 5、支付完成之后，微信服务器会通知支付成功
* 6、在支付成功通知中需要查单确认是否真正支付成功
-----------------------------------   
*/	
function wx_pay_1($product_id,$qrcode=false,$logo=false,$errorCorrectionLevel='L',$matrixPointSize = 4,$margin=1,$back_color=0xFFFFFF,$fore_color = 0x000000)
{ 
	  $notify = new \Accounts\Util\NativePay();
	  $url= $notify->GetPrePayUrl($product_id);
	  return qrcode($url,$qrcode,$logo,$errorCorrectionLevel,$matrixPointSize,$margin,$back_color,$fore_color);
}

/*
-----------------------------------  
* 微信扫描支付 扫描方式二 参数$data array('body'=>'body','attach'=>'attach','out_trade_no'=>'123456','goods_tag'=>'goods_tag','price'=>1,'product_id'=>123456) out_trade_no为32为字符
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否支付成功
-----------------------------------   
*/	
function wx_pay_2($data,$qrcode=false,$logo=false,$errorCorrectionLevel='L',$matrixPointSize = 4,$margin=1,$back_color=0xFFFFFF,$fore_color = 0x000000)
{ 
	  $notify = new \Accounts\Util\NativePay();
	  $input = new \Accounts\Util\WxPayUnifiedOrder();
	  $input->SetBody($data['body']);
	  $input->SetAttach($data['attach']);
	  $input->SetOut_trade_no($data['out_trade_no']);
	  $input->SetTotal_fee($data['price']);
	  $input->SetTime_start(date("YmdHis"));
	  $input->SetTime_expire(date("YmdHis", time() + 600));
	  $input->SetGoods_tag($data['goods_tag']);
	  $input->SetNotify_url(C('site_url').U('Accounts/Pay/notify'));
	  $input->SetTrade_type("NATIVE");
	  $input->SetProduct_id($data['product_id']);
	  $result = $notify->GetPayUrl($input);
	  $url = $result["code_url"];
	  
	  return qrcode($url,$qrcode,$logo,$errorCorrectionLevel,$matrixPointSize,$margin,$back_color,$fore_color);
}

/*
-----------------------------------  
* 获取统一下单数据 参数$data array('body'=>'body','attach'=>'attach','out_trade_no'=>'123456','goods_tag'=>'goods_tag','price'=>1,'product_id'=>123456) out_trade_no为32为字符
-----------------------------------   
*/	
function get_wx_data($product_id)
{ 
	   /*--------------------------------
		$product_id 格式为 (r或p或c) 用户ID g 产品id m model_id p 价格   	r为充值 p为产品 c为卡 q为二维码	  例如 p161g10m49
	   ----------------------------------*/  
	   $type=substr($product_id,0,1);
	   if(!$type) return ""; 
	   $product_id=substr($product_id,1);   
	   $find_id=explode("g",$product_id);
	   //用户id
	   $user_id=$find_id[0];
	   //商品信息
	   $product_id=$find_id[1];
	   $find_array=explode("m",$product_id);
	   if($type=='p'){
		   $goods_id=$find_array[0];
		   $model_id=$find_array[1];
		   return  make_product_order($goods_id,$model_id,$user_id);
	   }else{	   
		   return  make_type($type,$user_id,$product_id);
		   }
}

/*产品支付方法*/
function make_product_order($goods_id,$model_id,$user_id)
{	
		$goods=M(model_f($model_id))->where(array('id'=>$goods_id))->find();
		if(!$goods) return '';
		$msg=L('User_Index_order_pay');
		$attach='product';
		load("order/function");
		$cart_id=add_cart($goods_id,$user_id,1,$model_id,1);
		$cart_separate=cart_separate(array($cart_id),$user_id);
		$order_id=settle_cart($cart_separate,$user_id,0,1,1);
		$order_id_array=explode("|",$order_id);
		$order_id=$order_id_array[0];
		$price=M('order')->where(array('id'=>$order_id))->getField('order_amount');
		$price=$price * 100;
		$msg.=$order_id;
		$out_trade_no=$order_id.'t'.time();
		return array('body'=>$msg,'attach'=>$attach,'out_trade_no'=>$out_trade_no,'goods_tag'=>$goods['title'],'price'=>$price,'product_id'=>'p'.$goods_id.'m'.$model_id);
	}
/*充值，购卡，购买二维码方法
$type     类型string  操作类型 r为充值 c为卡 q为二维码
$user_id  类型int     当前用户id
$price    类型string   该操作所需价格 $type为p为不填此项 $type为u时需要解析
*/
function make_type($type,$user_id,$price)
{		
		if($type=='r') $attach='recharge';	   
	    if($type=='c') $attach='card'; 
	    if($type=='q') $attach='qrcode';
		$out_trade_no=$user_id.'t'.time();
		if($type=='u'){
			$attach='update';
			$price_u=explode("u",$price);
			$price=$price_u[0];
			$out_trade_no.='u'.$price_u[1];
		}
		$msg=L('User_Index_order_'.$attach.'');
		return array('body'=>'ID:'.$user_id.$msg,'attach'=>$attach,'out_trade_no'=>$out_trade_no,'goods_tag'=>$msg,'price'=>$price,'product_id'=>$type.$user_id.'g'.$price);
	}
/*
支付完成后更新那些字段
$type    类型int   更新字段的key
$user_id 类型int   更新用户id
*/
function update_product_id($type,$user_id,$update_array)
{	
	$update_array=array(
		array('table'=>'User','field'=>'status','data'=>1),//0
		/*此处自行增加所需的数据
		格式
		array('table'=>表名,'field'=>字段名,'data'=>更新为何值)
		*/
	);
	$update_info=$update_array[$type];
	if(!$update_info) return '';
	if(!$user_id) return '';
	$data[$update_info['field']]=$update_info['data'];
	M($update_info['table'])->where('id='.$user_id.'')->save($data);
	}
/*
生成$product_id
$type     类型string  操作类型 r为充值 p为产品 c为卡 q为二维码 u为更新某表某字段
$user_id  类型int     当前用户id
$goods_id 类型int     当前产品id
$model_id 类型int     当前模型id 
$price    类型float   该操作所需价格 $type为p为不填此项
$other    类型string  操作时候所需其他参数 如$type='u' 此项内容 
*/
function make_product_id($type='p',$user_id,$price=0,$goods_id,$model_id,$other=0)
{
		$string='';
		$o_type=array('p','r','q','c','u');
		if(in_array($type,$o_type)){
			$string.=$type;
			}else{
			return '';		
		}
		if($user_id){
			$string.=$user_id.'g';
			}else{
			return '';		
		}
		if($type=='p'){
			if(!$goods_id) return '';
			if(!$model_id) return '';
			$string.=$goods_id.'m'.$model_id;
			}else{
			$string.=$price;
			if($type=='u'){
			$string.='u'.$other;	
			}
		}
		return $string;		
}
/*
-----------------------------------  
* 获取统一下单数据 参数$result array{"appid":"wxc0d7ec4863c12ab9","attach":"test","bank_type":"CFT","cash_fee":"1","fee_type":"CNY","is_subscribe":"Y","mch_id":"1246044802","nonce_str":"O0gB5kCVA6IRAAxk","openid":"o4KFnuLOwsQR9tDusUk0ZBhe5b4Q","out_trade_no":"124604480220160815153246","result_code":"SUCCESS","return_code":"SUCCESS","return_msg":"OK","sign":"E632390401C3FEF00162CED0A1B606E2","time_end":"20160815153550","total_fee":"1","trade_state":"SUCCESS","trade_type":"NATIVE","transaction_id":"4004582001201608151403809024"}
-----------------------------------   
*/	
function set_wx_data($result)
{ 
	   if($result['result_code']=='SUCCESS'){
		   $coin_type='money';
	   	   load("order/function");
		   $out_trade_no=$result['out_trade_no'];
		   $find_array=explode("t",$out_trade_no);
		   if($result['attach']=='product'){
			   $order_id=$find_array[0];
			   order_status($order_id,1,'order_status',$model_config['goods_type']);	
			   order_status($order_id,1,'pay_status',$model_config['goods_type'],4,0);
			   }else{
			   $user_id=$find_array[0];
			   $price=$result['total_fee']*0.01;
			   $msg=L('User_Index_order_'.$result['attach'].'');
			   if($result['attach']=='qrcode'){
				   $data['qrcode_open']=1;
				   M('user')->where('id='.$user_id.'')->save($data);
				   account($user_id,array($coin_type=>$price),0,4,L('system'),$msg,0); 
			   }
			   if($result['attach']=='recharge' || $result['attach']=='card'){
			   	   account($user_id,array($coin_type=>$price),0,4,L('system'),$msg);    
			   }
			   if($result['attach']=='update'){
				   $type=explode("u",$find_array[1]);
				   $type=$type[1];
				   update_product_id($type,$user_id);
				   account($user_id,array($coin_type=>$price),0,4,L('system'),$msg);
			   }
			    
		   }	   
	   }
}


/*
-----------------------------------  
php发送post请求
* @param        data 支付传递参数
* @param        type 支付类型 1：手机支付 2：PC支付
-----------------------------------   
*/	
function alipay($data, $type=1){
      Vendor('Alipay.AlipaySubmit');
      $alipay_config=alipay_config($type);
	  if(!$alipay_config) return 1;
	  //构造要请求的参数数组，无需改动
	  $parameter = array(
			  "service"       => $alipay_config['service'],
			  "partner"       => $alipay_config['partner'],
			  "seller_id"  => $alipay_config['seller_id'],
			  "payment_type"	=> $alipay_config['payment_type'],
			  "notify_url"	=> $alipay_config['notify_url'],
			  "return_url"	=> $alipay_config['return_url'],
			  "_input_charset"	=> trim(strtolower($alipay_config['input_charset'])),
			  "out_trade_no"	=> $data['out_trade_no'],
			  "subject"	=> $data['subject'],
			  "total_fee"	=> $data['total_fee'],
			  "show_url"	=> $data['show_url'],
			  "app_pay"	=> "Y",//启用此参数能唤起钱包APP支付宝
			  "body"	=> $data['body'],	
	  );	  
	  $alipaySubmit = new AlipaySubmit($alipay_config);
      $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认支付");
      echo $html_text;
 }
 
 function alipay_config($type=1)
 {
	  $ali=FF('Conf/ali_config','',APP_PATH."/Accounts/");
	  if(!$ali['alipay_open']) return 0; //未配置或者未开启
	  $alipay_config=array(
			  'partner'=>$ali['alipay_partner'],
			  'seller_id'=>$ali['alipay_partner'],
			  'key'=>$ali['alipay_key'],
			  'sign_type'=>strtoupper('MD5'),
			  'input_charset'=>strtolower('utf-8'),
			  'transport'=>$ali['alipay_transport'],
			  'payment_type'=>1
	  );
	  $alipay_config['notify_url'] = C('site_url').U('Accounts/Alipay/notify_url',array('type'=>$type));
	  $alipay_config['return_url'] = C('site_url').U('Accounts/Alipay/return_url',array('type'=>$type));
	  $alipay_config['cacert']    =APP_PATH."/Accounts/Conf".'\\cacert.pem';
	  $alipay_config['service'] = ($type==1)?"alipay.wap.create.direct.pay.by.user":'create_direct_pay_by_user';
	  return $alipay_config; 
 }
 
/*
-----------------------------------  
交易完成后的操作 支付宝 通知信息
* @param        data 完成时返回的参数
-----------------------------------   
*/	
function alipay_notify_trade_finished($data){
    
 }
/*
-----------------------------------  
支付成功后的操作 支付宝 通知信息
* @param        data 完成时返回的参数
-----------------------------------   
*/	
function alipay_notify_trade_success($data){
    
 }
/*
-----------------------------------  
支付成功后或交易完成的操作 支付宝 返回链接的操作
* @param        data 完成时返回的参数
-----------------------------------   
*/	
function alipay_return_trade($data){
   dump($data).'xxxxxxxx';
}
/*
-----------------------------------  
非支付成功后或交易完成的操作 支付宝 返回链接的操作
* @param        data 完成时返回的参数
-----------------------------------   
*/	
function alipay_return_trade_o($data){
    
}
?>

<?php
namespace Mobile\Controller;
use Org\Util\User;
class orderController extends User {
   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   当前会员订单列表  
-----------------------------------   
*/
  public function order_list(){ 
      load('Order/function');
  	  $user=$this->userinfo;
	  $where['user_id']=$user["id"];
  	  $order_status=I('order_status','','intval');
	  $pay_status=I('pay_status','','intval');
	  $ship_status=I('ship_status','','intval');
	  if($order_status){
		$where['order_status']=$order_status;
		  }
	  if(isset($pay_status)){
		  if(gettype($pay_status)=='integer'){
		$where['pay_status']=$pay_status;
		  }
		  }
	  if(isset($ship_status)){
		  if(gettype($pay_status)=='integer'){
		$where['ship_status']=$ship_status;
		  }
		  }	  
	  $order=M('order');	  
	  $pagesize=10;
	  $page=I('page',1,'intval');
	  $record_count=$order->where($where)->count();//获取总记录数
	  $page=$record_count<$pagesize?1:$page; 
	  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
	  $info=order_list($where,$shopid=0,$page,$pagesize);
	  	  $notify_url=C('site_url').'/'.U('Mobile/Order/notify_url');
	  $this->assign('notify_url',$notify_url);
	  $this->assign('info',$info);
	  $this->assign('page_show',$page_show);
	  $page_title=L('User_Index_Order_list');
	  $this->assign('page_title',$page_title);
	  $this->display();
	  } 
/*
-----------------------------------  
   当前会员订单订单详情
-----------------------------------   
*/	  
  public function order_info(){   
  load('Order/function');
	  $id=I('id','','intval');
	  $order=M('order');
	  $order_info=$order->where('id='.$id.'')->find();
	  $order_info['order_info']=order_info($order_info['order_sn']);
	  $order_info["shop"]=shop_info($order_info["shop_id"]);
	  $order_info['consignee']=consignee_info_html($order_info['consignee_id']);
	  $this->assign('order_info',$order_info);
	  $page_title=L('User_Index_Order_info');
	  $this->assign('page_title',$page_title);
	  $this->display();
	  } 
	  
/*
-----------------------------------  
   确认收货
-----------------------------------   
*/	
  public function finish_order(){ 
  load('Order/function');  
	 $id=I('id','','intval');
	 $st=order_status($id,2,'ship_status',0,1);
	 if($st['status']=='SUCCES'){
		 $this->success(L('success'),U('Mobile/Order/order_list'),0);  
		 }else{
		 $this->error($st['L'],"",$this->r_time);	 
			 }
	  }  
  public function del_cart(){
	  load('Order/function');
	  $id=I('id','','intval');
	  if(delete_cart($id)){
		  echo L('success');
		  }else{
		  echo L('error');  
			  }
	  
	  }
/*
-----------------------------------  
   当前会员购物车信息
-----------------------------------   
*/
  public function my_cart(){ 
  	 load('Order/function');
     $user=$this->userinfo;
	 $cart=M('cart');
     if(IS_POST)
     {
	  $post=I('post');
	  if(!$post){
		$this->error(L(''),'Mobile/Order/my_cart',$this->r_time);
		  }
	  foreach($post as $val){
		  $where['id']=$val['cart_id'];
		  $data['goods_num']=$val['num'];
		  $cart->where($where)->save($data);
		  if(!$model_id) $model_id=$cart->where($where)->getField('model_id');
		  $cart_id[]=$val['cart_id'];
		  }	
	  $model_cofig=model_config($model_id);
	  $cart_info=cart_separate($cart_id,$user['id']);
	  if($cart_info['goods_type']==0){
		$sn=settle_cart($cart_info,$user['id'],$consignee_id,$discount=1,1,$model_cofig['point_type']);
		$this->success(L('waiting_for'),U('Mobile/Order/order_confirm',array('order_id'=>''.$sn.'')),0); 
		  }else{
	    $sn=settle_cart($cart_info,$user['id'],$consignee_id,$discount=1,1,$model_cofig['point_type']);
	    $this->redirect('Accounts/mobile/pay_list/','order_id='.$sn.'&model_id='.$model_id.''); 		  
			  }
/*	  $sn=settle_cart($cart_info,$user['id'],$consignee_id,$discount=1);
	  $this->redirect('Accounts/Pay/pay_list/','order_id='.$sn.'');*/
	  }else{ 
	  $info=cart_info($user["id"]);
	  $this->assign('info',$info);
	  $page_title=L('my_cart');
	  $this->assign('page_title',$page_title);
	  $this->display();
	  }
	  }  
	  
/*订单确认页面*/
  public function order_confirm()
  { 
  	load('Order/function');
	$order_id=I('order_id','','trim');
	if(!$order_id) $this->error(L('order_id_no'),"",$this->r_time);	 	 //参数为空报错跳转
	$order_array=explode('|',$order_id);
	if(!$order_array) $this->error(L('order_id_no'),"",$this->r_time);	  //参数为空报错跳转
	$user=$this->userinfo;
	$this->assign('user',$user);       //用户信息替换
	$order=M('order');
	foreach($order_array as $val)
	{
		$order_info=$order->where(array('id'=>''.$val.'','user_id'=>$user['id']))->find();
		$order_info['order_info']=M('order_info')->where(array('order_sn'=>$order_info['order_sn']))->select();
		foreach($order_info['order_info'] as $k=>$v)
		{
			$order_info['order_info'][$k]['goods_info']=goods_info($v['goods_id'],$v['model_id']);
		}
		$new_order[]=$order_info;
	}
	$consignee=M('consignee');
	$consignee_info=$consignee->where(array('user_id'=>$user['id'],'default'=>1))->find();
	$this->assign('consignee_info',$consignee_info);
	$this->assign('info',$new_order);
	$this->display();
  } 
/*
-----------------------------------  
   当前会员添加购物车
-----------------------------------   
*/	
/*
-----------------------------------  
   当前会员添加购物车
-----------------------------------   
*/	
/*
-----------------------------------  
   当前会员添加购物车
-----------------------------------   
*/	  
  public function add_cart_user(){ 
      load('Order/function');
      $user=$this->userinfo;
	  $user_id=$user["id"]; 
	  $goods_id=I('goods_id',0,'intval');
	  $model_id=I('model_id',0,'intval');	 
	  $goods_num=I('goods_num',1,'intval');	  
  	  add_cart($goods_id,$user_id,$goods_num,$model_id);
	  $this->redirect('Mobile/order/my_cart');
	 
	  } 	  
/*
-----------------------------------  
   会员实物下单填写地址信息
----------------------------------- 
*/	
  public function add_consignee_info(){ 
      load('Order/function');
      $user=$this->userinfo;
	  $user_id=$user["id"]; 
	  $model_id=I('model_id');
	  $model_cofig=model_config($model_id);
	  $this->assign('model_id',$model_id);
	  if(IS_POST)
      { 
	  $data['user_id']=$user_id;
	  $data['consignee']=I('post.name');
	  $data['address']=I('post.address');;
	  $data['mobile']=I('post.mobile');
	  $data['area_id']=linkage_id(I('post.area_id'));
	  $consignee=M('consignee');
	  $id=$consignee->add($data);
	  if(session('cart_info')){
	  $cart_info=session('cart_info');
	  $sn=settle_cart($cart_info,$user_id,$id,$discount=1,1,$model_cofig['point_type']);
	  session('cart_info',null);
	  $this->redirect('Accounts/mobile/pay_list/','order_id='.$sn.'&model_id='.$model_id.''); 	
	  }else{
	  $this->success(L('success'),U('Mobile/Order/add_consignee_info'),0);  
		  }
	  }else{
	  $area_list=linkage_agent_area_array(agent_area_array());
	  $area_id=linkage($area_list,"area_id","",0,array(),array('text'=>L('area_first'),'value'=>"0"),'form-control');	  
	  $this->assign('page_title',L('Order_add_consignee'));
	  $this->assign('area_id',$area_id);
	  $this->display();
	  }
	  } 
 /*用户取消订单*/
  public function order_cannal(){ 
      $user=$this->userinfo;
	  $user_id=$user["id"]; 
	  $id=I('order_id',0,'intval');
	  $order=M('order');
	  $order_info=$order->where('id='.$id.' and user_id='.$user_id.'')->find();
	
	  if($order_info){
		 if(del_order($id)){ 
		  $this->success(L('success'),U('Mobile/Order/order_list'),0);   
			 } 
		  }else{	  
		  $this->error('无法删除该订单，找不到与之匹配的订单',"",$this->r_time);	 	  
			  }
	
  } 
 /*用户取消订单*/  
  public function pay_cannal(){
      $user=$this->userinfo;
	  $user_id=$user["id"]; 
	  $id=I('order_id',0,'intval');
	  $order=M('order');
	  $order_info=$order->where('id='.$id.' and user_id='.$user_id.'')->find();	  
	    if($order_info['order_status']<3){
 		if($order_info){
			$pay_cannal_order=pay_cannal_order($id);
		 if($pay_cannal_order['status']=='S'){ 
		     $this->success(L('success'),U('Mobile/Order/order_list'),0);   
			 }else{
		     $this->error($pay_cannal_order['L'],"",$this->r_time);	 	 
				 } 
		  }else{	  
		  $this->error('无法退款该订单，找不到与之匹配的订单',"",$this->r_time);	 	  
			  }	
		}else{
		  $this->error('该单无法操作！',"",$this->r_time);	 
		  } 
	  }	
	  
/*
-----------------------------------  
  核销兑换码
-----------------------------------   
*/  
 public function verification_key(){
	 if(IS_POST){
		$key=I('post.key','','trim'); 
		$user=$this->userinfo;
	    $user_id=$user["id"]; 
		$shop=M("shop");
	    $shop_info=$shop->where("user_id=".$user_id."")->find();
		$s=verification_key($key,$shop_info['id']);
		if(is_array($s)){
			 $url=U('Mobile/Order/verification_key_show','goods_id='.$s['goods_id'].'&model_id='.$s['model_id'].'');
			 header('Location:'.$url.'');
			}else{	
			 $this->error($s);	
			}
		 }else{
	   $this->assign('page_title','核销兑换码');
	   $this->display();	 
		}
	 }	
		
 public function verification_key_show(){
	  $goods_id=I('get.goods_id'); 
	  $model_id=I('get.model_id'); 
	  if($goods_id && $model_id){
		 $meg=goods_info($goods_id,$model_id);
		 $this->assign('meg',$meg); 
		  }
		$this->display();
	 }  
 public function sell_more(){
	 $config=FF('Conf/config','',COMMON_PATH);
	 $URL=$config["site_url"].'/'.$config["root_path"].U('Shop/Sell/index');
	 $this->assign('page_title','敬请期待');
	 $this->assign('URL',$URL);
	 $this->display();
	 }
}
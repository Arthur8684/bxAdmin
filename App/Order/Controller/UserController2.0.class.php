<?php
namespace Order\Controller;
use Org\Util\User;
class userController extends User {
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
	  	  $notify_url=C('site_url').'/'.U('Order/User/notify_url');
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
	 $id=I('id','','intval');
	 $st=order_status($id,2,'ship_status',0);
	 if($st['status']=='SUCCES'){
		 $this->success(L('success'),U('Order/User/order_list'),0);  
		 }else{
		 $this->error($st['L'],"",$this->r_time);	 
			 }
	  }  
  public function del_cart(){
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
     $user=$this->userinfo;
	 $cart=M('cart');
     if(IS_POST)
     {
	  $post=I('post');
	  if(!$post){
		$this->error(L(''),'Order/User/my_cart',$this->r_time);
		  }
	  foreach($post as $val){
		  $where['id']=$val['cart_id'];
		  $data['goods_num']=$val['num'];
		  $cart->where($where)->save($data);
		  $cart_id[]=$val['cart_id'];
		  }	
	  $cart_info=cart_separate($cart_id,$user['id']);
	  if($cart_info['goods_type']==0){
		session('cart_info',$cart_info['goods_info']);
		$this->redirect('Order/User/add_consignee_info');  
		  }else{
	    $sn=settle_cart($cart_info['goods_info'],$user['id'],$consignee_id,$discount=1);
	    $this->redirect('Accounts/Pay/pay_list/','order_id='.$sn.''); 			  
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
/*
-----------------------------------  
   当前会员添加购物车
-----------------------------------   
*/	  
  public function add_cart_user(){ 
      $user=$this->userinfo;
	  $user_id=$user["id"]; 
	  $goods_id=I('goods_id',0,'intval');
	  $model_id=I('model_id',0,'intval');	 
	  $goods_num=I('goods_num',1,'intval');	  
  	  add_cart($goods_id,$user_id,$goods_num,$model_id);
	  $this->redirect('Order/User/my_cart');
	  } 	  
/*
-----------------------------------  
   会员实物下单填写地址信息
----------------------------------- 
*/	
  public function add_consignee_info(){ 
      $user=$this->userinfo;
	  $user_id=$user["id"]; 
	  if(IS_POST)
      { 
	  $data['user_id']=$user_id;
	  $data['consignee']=I('post.name');
	  $data['address']='';
	  $data['mobile']=I('post.mobile');
	  $data['area_id']=linkage_id(I('post.area_id'));
	  $consignee=M('consignee');
	  $id=$consignee->add($data);
	  if(session('cart_info')){
	  $cart_info=session('cart_info');
	  $sn=settle_cart($cart_info,$user_id,$id,$discount=1);
	  session('cart_info',null);
	  $this->redirect('Accounts/Pay/pay_list','order_id='.$sn.'');
	  }else{
	  $this->success(L('success'),U('Order/User/add_consignee_info'),0);  
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
		  $this->success(L('success'),U('Order/User/order_list'),0);   
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
 		if($order_info){
			$pay_cannal_order=pay_cannal_order($id);
		 if($pay_cannal_order['status']=='S'){ 
		     $this->success(L('success'),U('Order/User/order_list'),0);   
			 }else{
		     $this->error($pay_cannal_order['L'],"",$this->r_time);	 	 
				 } 
		  }else{	  
		  $this->error('无法退款该订单，找不到与之匹配的订单',"",$this->r_time);	 	  
			  }	 
	  }		  
}
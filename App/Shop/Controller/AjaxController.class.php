<?php
namespace Shop\Controller;
use Org\Util\Seller;
class AjaxController extends Seller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   通过会员卡获取会员信息
-----------------------------------   
*/	
    public function  get_user(){  	
	     $card=I('card');
		 $return=array('err'=>1,'content'=>L('User_Not_Card'));
		 if(!$card) 
		 {
			 $this->ajaxReturn($return);
			 exit();
		 }
		 $lang=array('id'=>L('User_Id'),'user'=>L('User_Name'),'recommend'=>L('User_Recommend'),'money'=>C('money_name'),'amount'=>C('amount_name'),'point'=>C('point_name'),'group_id'=>L('User_Group'),'email'=>L('User_Email'),'nickname'=>L('User_Nickname'),'card'=>L('User_Card'),'addtime'=>L('User_Addtime'),'login_time'=>L('User_Logintime'));
		 $field='id,user,recommend';
		 $field=C('money_status')?$field.",money":$field;
		 $field=C('amount_status')?$field.",amount":$field;
		 $field=C('point_status')?$field.",point":$field;
		 $field=$field.',group_id,email,nickname,card,addtime,login_time';
	     $user=M('user')->field($field)->where(array('card'=>$card,'status'=>1))->find();	
		 $group=M('group')->field('name')->where(array('id'=>$user['group_id'],'status'=>1,'is_login'=>1))->find(); 
		 if(!$user || !$group)
		 {
			 $return=array('err'=>1,'content'=>L('User_Not_User'));
			 $this->ajaxReturn($return);
			 exit();
		 }
		 $user['group_id']=$user['group_id']?$group['name']:'';
		 $user['addtime']=$user['addtime']?date('Y-m-d H:i:s',$user['addtime']):'';
		 $user['login_time']=$user['login_time']?date('Y-m-d H:i:s',$user['login_time']):'';
		 $str="";
		 foreach($user as $k=>$v)
		 {
			  //$str=$str."<div class='col-md-2 height_30'><span class='b1'>".$lang[$k]."</span>：<span class='red'>".$v."</span></div>";
			  $str=$str."<div class='col-md-2 height_30'><span class=''>".$lang[$k]."</span>：<span class='font_color_4'>".$v."</span></div>";
		 }
		 $str="<div class='col-md-12 bg-success padding_10' >".$str."</div><input name='userid' id='userid' type='hidden' value='".$user['id']."' />";
		 //返回最后生成的ajax数据
         $return=array('err'=>0,'content'=>$str);  
		 $this->ajaxReturn($return);
		 exit();
    }
	
/*
-----------------------------------  
   通过扫码获取获取产品信息
-----------------------------------   
*/	
    public function  get_goods(){  	
	     $bar_code=I('bar_code');
		 $userid=I('userid');
		 $group_id=user($userid,'group_id',0);
		 $price_limit=M('group')->where(array('id'=>$group_id))->getField('price_limit');
		 $price_limit=$price_limit?$price_limit:0;
		 
		 $return=array('err'=>1,'content'=>L('Goods_Not_Card'));
		 if(!$bar_code) 
		 {
			 $this->ajaxReturn($return);
			 exit();
		 }
		 
		 $table=M('table_field')->where(array('field'=>'bar_code'))->getField('table',true);
		 
		 $data['type']='Goods';
		 $data['status']='1';
		 $data['table']=array('in',implode(',',$table));
		 $model=M('model')->field('id,table')->where($data)->select();
		 if($model)
		 {
			  foreach($model as $k=>$v)
			  {
				   if(!$v['table']) continue;
				   $info=M($v['table'])->where(array('bar_code'=>$bar_code,'verify'=>99))->find();
				   //==================================查找条形码对应的产品================================================
				   if($info)
				   {
					    $shop_goods=M('goods_property')->where(array('shop_id'=>$GLOBALS['SHOP_INFO']['id'],'model_id'=>$v['id'],'goods_id'=>$info['id']))->find();
						if($shop_goods)
						{
							  $cart=M('cart');
							  $goods_cart=$cart->where(array('shop_id'=>$GLOBALS['SHOP_INFO']['id'],'model_id'=>$v['id'],'goods_id'=>$info['id'],'user_id'=>$userid,'is_shop_card'=>1))->find();
							  if($goods_cart)
							  {
								  $cart->where('id='.$goods_cart['id'])->setInc('goods_num'); // 根据条件更新购物车数量
								  if($shop_goods['inventory']<=$goods_cart['goods_num'])
								  {
									  $return=array('err'=>0,'content'=>L('Goods_Not_Inventory'));	
									  $this->ajaxReturn($return);
			                          exit();
								  }
								  $str=$goods_cart['goods_num']+1;
							  }else
							  {
								    if($shop_goods['inventory']<1)
									{
										$return=array('err'=>1,'content'=>L('Goods_Not_Inventory'));	
										$this->ajaxReturn($return);
										exit();
									}
									$insert_data['user_id']=$userid;
									$insert_data['goods_id']=$info['id'];
									$insert_data['other']=$info['title']."|".$info['price'];
									$insert_data['goods_num']=1;
									$insert_data['model_id']=$v['id'];
									$insert_data['shop_id']=$GLOBALS['SHOP_INFO']['id'];
									$insert_data['air']=0;	
									$insert_data['is_shop_card']=1;	
									$insert=$cart->add($insert_data); // 写入数据到数据库 
									
									$info['price']=$shop_goods['price']>0?$shop_goods['price']:$info['price'];
									if($price_limit && $price_limit< $info['price'])
									{
										$return=array('err'=>1,'content'=>L('Goods_Price_Limit_P'));	
										$this->ajaxReturn($return);
										exit();										
									}
									$str="<tr class='price' id='".$insert."'>";
									$str.="<td align='center' valign='middle'>".$info['id']."</td>";
									$str.="<td align='left' valign='middle' id='title_".$insert."'>".$info['title']."</td>";
									$str.="<td align='center' valign='middle' id='price_".$insert."'>".$info['price']."</td>";
									$str.="<td align='center' valign='middle'>".$info['bar_code']."</td>";
									$str.="<td align='center' valign='middle'><input name='goods' id='goods_".$insert."' class='form-control input-sm goods_".$bar_code."' type='text' value='1'  onChange=\"edit_num(".$insert.")\" /></td>";
									$str.="<td align='center' valign='middle'><button type='button' class='btn btn-success btn-sm'  onClick='del(".$insert.")'>".L('DEL')."</button></td>";
									$str.="</tr>";							  
							  }

							  $return=array('err'=>0,'content'=>$str);						
						}
						else
						{
							 $return=array('err'=>1,'content'=>L('Goods_Not_Lev'));
						  
						}
						$this->ajaxReturn($return);
					    exit();	
				   }
				  //==================================查找条形码对应的产品================================================
			  }
			  
		 }
		 else
		 {
			 $return=array('err'=>1,'content'=>L('Goods_Not_Goods'));
			 $this->ajaxReturn($return);
			 exit();			 
		 }
		 	 $return=array('err'=>1,'content'=>L('Goods_Not_Goods'));
			 $this->ajaxReturn($return);
			 exit();	
    }	
	
/*
-----------------------------------  
   删除商品杀杀杀
-----------------------------------   
*/	
    public function  del_goods(){  	
	     $id=I('id',0,'intval');
		 if(!$id) 
		 {
			 $return=array('err'=>1,'content'=>L('ERR_PARAM_ID'));
			 $this->ajaxReturn($return);
			 exit();
		 }
		 M('cart')->delete($id);;	
		 $return=array('err'=>0,'content'=>'');
		 $this->ajaxReturn($return);	 
    }
/*
-----------------------------------  
   通过条形码设置产品个数
-----------------------------------   
*/	
    public function  set_goods(){  	
	     $id=I('id',0,'intval');
		 $goods_num=I('goods_num',0,'intval');
		 if(!$id) 
		 {
			 $return=array('err'=>1,'content'=>L('ERR_PARAM_ID'));
			 $this->ajaxReturn($return);
			 exit();
		 }
		 if(!$goods_num) 
		 {
			 $return=array('err'=>1,'content'=>L('Goods_Not_Num'));
			 $this->ajaxReturn($return);
			 exit();
		 }
		 $cart=M('cart');
		 $cart_info=$cart->where('id='.$id)->find();
		 $shop_goods=M('goods_property')->where(array('shop_id'=>$GLOBALS['SHOP_INFO']['id'],'model_id'=>$cart_info['model_id'],'goods_id'=>$cart_info['goods_id']))->find();
		 if($shop_goods['inventory']<$goods_num)
		 {
			 $return=array('err'=>1,'content'=>L('Goods_Not_Inventory'));
			 $this->ajaxReturn($return);
			 exit();			  
		 }
		 $cart->where('id='.$id)->setField('goods_num',$goods_num);;
		 $return=array('err'=>0,'content'=>L('Goods_Not_Set'));
		 $this->ajaxReturn($return);	 
    }
/*
-----------------------------------  
   结算
-----------------------------------   
*/	
    public function  pay(){  	
	     $pass=I('pass','','trim');
		 if($pass) $pass=md5($pass);
		 $userid=I('userid',0,'intval');
		 $pay_type=I('pay_type',0,'intval');
		 if(!$pay_type) 
		 {
			 $return=array('err'=>1,'content'=>L('Goods_Pay_Type_Not'));
			 $this->ajaxReturn($return);
			 exit();
		 }		 
		 if(!$userid) 
		 {
			 $return=array('err'=>1,'content'=>L('ERR_PARAM_ID'));
			 $this->ajaxReturn($return);
			 exit();
		 }
		 
		 if($pay_type==1)
		 {
			 $shop_user=M('user')->field('id,pay_pass,money')->where(array('id'=>$GLOBALS['LOGIN_USER']['id']))->find();
			 $user_pass=$shop_user['pay_pass'];
			 $user_point=$shop_user['money'];
			 $lang_pass=L('Goods_Pay_Type_ErrPass_1');
			 $pay_userid= $shop_user['id'];
		 }
		 else if($pay_type==2)
		 {
			 $user=M('user')->field('id,user,pay_pass,group_id,money')->where(array('id'=>$userid,'status'=>1))->find();
			 $user_pass=$user['pay_pass'];
			 $user_point=$user['money']; 	
			 $lang_pass=L('Goods_Pay_Type_ErrPass_2'); 	
			 $pay_userid= $user['id'];	 
		 }
		 
		 $user_pass=$user_pass?$user_pass:0;
		 $user_point=$user_point?$user_point:0;
		 
		 if(!$user) $user=M('user')->field('id,user,pay_pass,group_id,money')->where(array('id'=>$userid,'status'=>1))->find();
		 $group=M('group')->field('id')->where(array('id'=>$user['group_id'],'status'=>1,'is_login'=>1))->find(); 
		 if(!$user || !$group)
		 {
			 $return=array('err'=>1,'content'=>L('User_Not_User'));
			 $this->ajaxReturn($return);
			 exit();			 
		 }
		 if($user_pass==$pass && $user_pass)
		 {
			  $total=$this->get_total_price($userid);
			  if($user_point<$total)
			  {
				  $return=array('err'=>1,'content'=>L('Goods_Pay_Err_0'));
				  $this->ajaxReturn($return);
				  exit();				  
			  }

			  $where=array('user_id'=>$userid,'shop_id'=>$GLOBALS['SHOP_INFO']['id'],'is_shop_card'=>1);
			  $cart_id=M('cart')->where($where)->getField('id',true);
			  if(!$cart_id)
			  {
				  $return=array('err'=>1,'content'=>L('Goods_Not'));
				  $this->ajaxReturn($return);
				  exit();					   
			  }
			  load('Order/function');
			  $cart_info=cart_separate($cart_id,$userid);
			  $pay=settle_cart($cart_info,$userid,0);
			  $order_id=trim($pay,'|');
			  if($order_id)
			  {
				   $time=time();
				   $order_minus_inventory=order_minus_inventory($order_id);
				   if($order_minus_inventory['code']<=0)
				   {
						 $record=account($pay_userid,array('money'=>-$total),$operation_type=1,$business_type=0,$operation_user=$GLOBALS['LOGIN_USER']['user'],$msg=L('Goods_Pay_Msg',array('shop_name'=>$GLOBALS['SHOP_INFO']['name'],'user'=>$user['user'],'shop_id'=>$GLOBALS['SHOP_INFO']['id'],'order_id'=>$order_id,'lang_pay'=>L('Goods_Pay_Type_'.$pay_type))));
						 if($record)
						 {				   
							 $data=array('order_status'=>1,'pay_status'=>1,'ship_status'=>2,'pay_time'=>$time,'finish_time'=>$time,'ship_time'=>$time);
							 M('order')->where('id='.$order_id)->save($data); // 更新订单状态
							 $this->set_rebate_recommend($userid);
							 M('cart')->delete(implode(',',$order_id)); 
							 
							 $return=array('err'=>0,'content'=>L('Goods_Balance_Success'));
						 }else
						 {
							 $return=array('err'=>1,'content'=>L('Goods_Balance_Danger'));
						 } 					    
				   }
				   else
				   {
					    $goods_name=M(model_f($order_minus_inventory['model_id']))->where('id='.$order_minus_inventory['goods_id'])->getField('title');
					    $return=array('err'=>1,'content'=>$goods_name.L('Goods_Not_Inventory'));
				   }


				      
			  }
			  else
			  {
				  $return=array('err'=>1,'content'=>L('Goods_Balance_Danger'));
			  }
		 }
		 else
		 {
			  $return=array('err'=>1,'content'=>$lang_pass);
		 }
		 
		 $this->ajaxReturn($return);	 
    }
	
/*
-----------------------------------  
   获取订单总价格
   ** $userid int 下单用户的ID
   ** return  int 订单总价格
-----------------------------------   
*/	
    public function  get_total_price($userid){  	
		 $userid=$userid?$userid:0;
		 if(!$userid)  return -1 ;// 用户id为空
		 $total_price=0;
		 $cart=M('cart')->where(array('user_id'=>$userid,'shop_id'=>$GLOBALS['SHOP_INFO']['id'],'is_shop_card'=>1))->select();
		 if(!$cart) 
		 {
		     return 0;	 
		 }
		 else
		 {
			 foreach($cart as $k=>$v)
			 {
				  $price=$this->get_price($v['goods_id'],$v['model_id']);
				  $total_price=$total_price+$price*$v['goods_num'];
			 }
		 }
         return $total_price;
    }
	
/*
-----------------------------------  
   获取订单价格
   ** $userid int 下单用户的ID
   ** return  int 订单总价格
-----------------------------------   
*/	
    public function  get_price($goods_id,$model_id){  	
		 $price=M('goods_property')->where(array('shop_id'=>$GLOBALS['SHOP_INFO']['id'],'goods_id'=>$goods_id,'model_id'=>$model_id,'is_shop_card'=>1))->getField('price');
		 if($price<=0)
		 {
			 $table=model_f($model_id);
			 $price=M($table)->where(array('id'=>$goods_id))->getField('price');
		 }
          return $price;
    }
	
	/*
-----------------------------------  
   返利提成
   ** $userid int 下单用户的ID
-----------------------------------   
*/	
    public function  set_rebate_recommend($userid){  	
	     load('Fenxiao/function');
		 $cart=M('cart')->where(array('shop_id'=>$GLOBALS['SHOP_INFO']['id'],'user_id'=>$userid,'is_shop_card'=>1))->select();
		 if(!$cart) return false;
		 foreach($cart as $k=>$v)
		 {
			 $config=FF('Conf/config','',APP_PATH."Fenxiao/");
			 $goods_info=M(model_f($v['model_id']))->where(array('id'=>$v['goods_id']))->find();
			 $goods_info['separate_num']=is_numeric($goods_info['separate_num'])?$goods_info['separate_num']:0;
			 $goods_info['price']=$this->get_price($v['goods_id'],$v['model_id']);
			 $price=$goods_info['price'];
			 $goods_info['price']=$goods_info['price']*$v['goods_num'];
			 if($config['open'])
			 {
				 if($goods_info['separate_num']>0)
				 {
					 rebate_recommend($userid,$goods_info['separate_num'],L('CONSUMPTION_SCALE',array('goods_num'=>$v['goods_num'],'goods_name'=>$goods_info['title'],'separate_num'=>$goods_info['separate_num'])),$goods_info['separate_scale']);
				 }
				 else
				 {
					 rebate_recommend($userid,$goods_info['price'],L('CONSUMPTION_SCALE',array('goods_num'=>$v['goods_num'],'goods_name'=>$goods_info['title'],'separate_num'=>$price)),$goods_info['separate_scale']);
				 }
			 }
			 
			 if($goods_info['money']==-1) $goods_info['money']=$goods_info['price'];
			 if($goods_info['amount']==-1) $goods_info['amount']=$goods_info['price'];
			 if($goods_info['point']==-1) $goods_info['point']=$goods_info['price'];
			 if($goods_info['promote_point']==-1) $goods_info['promote_point']=$goods_info['price'];
			 
			 if($goods_info['money']) $data['money']=$goods_info['money']*$v['goods_num'];
			 if($goods_info['amount']) $data['amount']=$goods_info['amount']*$v['goods_num'];
			 if($goods_info['point']) $data['point']=$goods_info['point']*$v['goods_num'];
			 if($goods_info['promote_point']) $data['promote_point']=$goods_info['promote_point']*$v['goods_num'];
			 if($data) account($userid,$data,$operation_type=8,$business_type=6,$operation_user='SYSTEM',$msg=L('CONSUMPTION_GIVE',array('goods_num'=>$v['goods_num'],'goods_name'=>$goods_info['title'])));
		 }
    }	
}
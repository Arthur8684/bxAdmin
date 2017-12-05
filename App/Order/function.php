<?php
/*
模型id转换模型名称
*/
 function model_name($modelid)
 {
	return model_f($modelid);
 }
/*订单列表*/
 function order_list($where,$shopid=0,$page,$pagesize)
 {
	$order=M('order');
	if($shopid > 0) $where['user_id']=$shopid;
	
	$order_list=$order->where($where)->order('id desc')->page($page,$pagesize)->select();
	foreach($order_list as $val){
		$val["order_info"]=order_info($val["order_sn"]);
		$val["order_info_num"]=count($val["order_info"]);
		$val["consignee"]=consignee_info_html($val["consignee_id"]);
		$val["order_status_html"]=order_status_html($val['id']);
		$val["shop"]=shop_info($val["shop_id"]);
		$order_list_new[]=$val;
	 }
	 
	 return  $order_list_new;	
 }
/*
订单详情列表
*/
 function order_info($order_sn)
 {
	$order_info=M('order_info'); 
	$where['order_sn']=$order_sn;
	$order_info_s=$order_info->where($where)->select();
	
	foreach($order_info_s as $val){
		$goods=goods_info($val['goods_id'],$val['model_id']);
		$val['goods_name']=$goods['title'];
		$val['goods_price']=$goods['price'];
		$val['goods']=$goods;
		$val['little_price']=$val['order_num']*$val['goods_price'];
		$val['conversion_key']=conversion_key_info($val['id']);
		$order_info_ss[]=$val;
	}
	return  $order_info_ss;	
 }

/*
获取订单兑换码
*/	
 function conversion_key_info($order_info_id) 
 {	
	$order_conversion_key=M('order_conversion_key');
	$where['info_id']=$order_info_id;	
	return  $order_conversion_key->where($where)->select();	 
 }	 	 
/*
删除订单
*/	 
 function del_order($id)
 {  $order=M('order');
	$order_info=M('order_info'); 
	$order_conversion_key=M('order_conversion_key');
	$where['id']=$id;
	$orderarray=$order->where($where)->find();	
	$order_sn=$orderarray['order_sn'];
	if($order->where($where)->delete())
	{
		$wheres['order_info']=$order_info;
		$order_infos=$order_info->where($where)->select();	
		if($order_infos)
		{
		    foreach($order_infos as $val)
		    {
			     $order_conversion_key->where('info_id='.$val['id'].'')->delete();
			}
		}
		    $order_info->where($wheres)->delete();
   }
	 return true;
 }
	 
/*
订单申请退款
*/
 function pay_cannal_order($id)
 {
	 $order=M('order');
	 $where['id']=$id;
	 $st=array('status'=>'E','L'=>'参数错误');
	 $order_info=$order->where($where)->find();
	 if($order_info)
	 {
		   if($order_info['ship_status']==2 || $order_info['ship_status']==4 || $order_info['ship_status']==3)
		   {
				$st=array('status'=>'E','L'=>'该订单已完成或已退款，不能执行'); 
				return $st;
			}else{ 
				if(order_status($id,3,'order_status'))
				{	
					$st=array('status'=>'S','L'=>'申请成功，等待审核');	
					return $st;
			    }
		   }
	 }
	 return $st;
 }
/*
退款到账户
*/
 function pay_cannal_pay($id,$coin_type='money')
 {
     $order=M('order');
	 $where['id']=$id;
	 $st=array('status'=>'E','L'=>'参数错误');
	 $order_info=$order->where($where)->find();	
	 if($order_info){
		$order_amount=$order_info['order_amount']; 
		if(account($order_amount,$order_info['user_id'],$coin_type,1,5,'SYSTEM','订单'.$order_info['order_sn'].'退款')){
			load('Wechat/function');
			$openid=return_wechat($order_info['user_id']);
			$openid=array(array('openid'=>$openid));
			recommend_msg($openid,'订单'.$order_info['order_sn'].'退款已完成，退款已进您的余额');
			order_status($id,4,'order_status');
			$st=array('status'=>'S','L'=>'操作成功');
			}
		}
	  return $st;
	}
/*
购物车信息
*/	 
 function cart_info($userid)
 {
		$cartlist=M('cart');  
		$where['user_id']=$userid;
		$cart_list=$cartlist->where($where)->select();
		foreach($cart_list as $val)
		{		 
			$val['goods']=goods_info($val['goods_id'],$val['model_id']);
			$cart_lists[]=$val;
		}
		return	$cart_lists; 
 }
/*购物车各项单独显示*/	 

 function cart_only_info($id)
 {
	$cart=M('cart');  
	$where['id']=$id;
	$cartlist=$cart->where($where)->find();
	$cartlist['goods']=goods_info($cartlist['goods_id'],$cartlist['model_id']);
	return	$cartlist; 
 }
/*
商品信息
*/
 function goods_info($id,$modelid)
 {  
	$table=model_name($modelid);
	if($table){
		$goods=M(''.$table.'');
		$where['id']=$id;
		return $goods->where($where)->find();	
	} 
}
/*
用户信息
*/
 function user_info($id)
 {
	$user=M('user');
	$where['id']=$id;
	return $user->where($where)->find();	
 }
/*
订单号得id
*/	 
 function order_id($order_sn)
 {
	 $order=M('order');
	 $where['order_sn']=$order_sn;
	 $order_id=$order->where($where)->find();	
	 return $order_id['id'];
	 }

	 	 
/*
订单状态更新
$order_sn订单编号
$status订单状态
$air 1为虚拟产品
$pay_type 支付方式
$is_pay 是否扣除余额
*/
 function order_status($id,$status,$name,$air=1,$pay_type=0,$is_pay=1,$coin_type='money')
 {
	if(!$id) return array('status'=>'EER','L'=>'id不能为空');
	$st=array('status'=>'EER');
	$order=M('order');
	$where['id']=$id;
	$orders=$order->where($where)->find();
	$order2=order_info($orders['order_sn']);
	$proportion=shop_proportion($orders['shop_id']);//分销金额
	$order_name=$order2[0]['goods_name'];
	
	if(count($order2)>1)
	{
		$order_name=$order2['goods_name'].'等'.count($order2).'件商品';
	}else{
		$order_name=$order2['goods_name'];	
	}
	
	load('Wechat/function');
	$user=user_info($orders['user_id']);
	$recommend_ids=return_recommend_ids($user['recommend']);
	$openid=return_wechat($orders['user_id']);
	$openid=array(array('openid'=>$openid));
	$cofig=FF('wechat/wechat_user');
	$user=array('order_name'=>$order_name,'order_sn'=>$orders['order_sn'],'order_time'=>''.date("Y-m-d H:i:s",$orders['addtime']).'','order_price'=>$orders['order_amount']);
	$order_info=M('order_info');
	$data[$name]=$status;
	//付款以后虚拟产品兑换码
	$st=array('status'=>'SUCCES');		
	if($name=='pay_status' && $status==1){
		if($air==1){
			foreach($order2 as $val){
				conversion_key($val['id']);
			}
		}
		$user_id=$orders['user_id'];
		$order_amount=$orders['order_amount'];
		$order_sn=$orders['order_sn'];
		$data['pay_time']=time();
		//写入资金			
		if(account(-$order_amount,$user_id,$coin_type,1,$pay_type,'SYSTEM','订单'.$order_sn.'付款',$is_pay)){
		   recommend_msg($openid,$cofig['pay_tem'],$user);
		   $st=array('status'=>'SUCCES');
		   }else{
		   $st=array('status'=>'EER','L'=>''.L('user_pay_no').'');
		}

	}
	//配送完成订单更新	
	if($name=='ship_status' && $status==2){
		$data['finish_time']=time();
		//虚拟订单销兑换码
		if($air==1){
			$conversion_key=M('order_conversion_key');	
			foreach($order2 as $val){
				$order_info_id[]=$val['id'];
				$sum1=$sum1+$val['order_num'];
			}
			if($order_info_id){
				$map['usering']=0;
				$map['info_id']=array('in',$order_info_id);
				$sum=$conversion_key->where($map)->count();
				$datas['usering']=1;
				$datas['valid_time']=time();
				$map1['info_id']=$map['info_id'];
				$conversion_key->where($map1)->save($datas);
			}
		}
		$user_id=$orders['shop_id'];
		$shop=M('shop');
		$shop_info=$shop->where('id='.$user_id.'')->find();
		$shop_id=$shop_info['user_id'];
		$order_amount=$orders['order_amount'];
		set_grand($orders['user_id'],$type=array('consumption'=>$order_amount));
		
		if($air==1){
			if(!$order2['order_num'])
			{
				$order2['order_num']=1;
				$sum=1;
				$$sum1=0;
			}
			$order_amount=($order_amount/$order2['order_num'])*$sum;
		}
		$order_sn=$orders['order_sn'];
		$order_amount=$order_amount*(1-$proportion);
		$order_proportion=$order_amount*$proportion;
		
		if(account($order_amount,$shop_id,$coin_type,1,$pay_type,'SYSTEM','订单'.$order_sn.'消费',$is_pay)){
			//地区分销
			 load("User/function");
			 agent_divided_into($shop_info['area_id'],$order_proportion);
			 //三级分销
			 load("Fenxiao/function");
			 rebate_recommend($orders["user_id"],$order_proportion,'来自订单'.$order_sn.'消费');
			 //三级分销微信回复
				$fenxiao=FF('Conf/config','',APP_PATH.'Fenxiao/');	//读取分销配置
				$scale=explode(",",$fenxiao["scale"]);
				foreach($recommend_ids as $key=>$val){
					$val['scale']=$scale[$val['lev']];
					$val['scale_num']=$order_proportion*$scale[$val['lev']]*0.01;
					$recommend_ids_1[]=$val;
					}
			recommend_msg($recommend_ids_1,$cofig['pay_recommend_tem'],$user);
			$st=array('status'=>'SUCCES');
			}else{
			$st=array('status'=>'EER','L'=>''.L('user_pay_no').'');
		}
	 }
	 //配送完成订单更新	
	if($name=='ship_status' && $status==1) $data['ship_time']=time();
	
	 //退款时清空兑换码
	 if($name=='order_status' && $status>1 && $air==1)
	 {
		   $order_conversion_key=M('order_conversion_key');
		   foreach($order2 as $val)
		   {
				foreach($val['conversion_key'] as $v)
				{
					M('order_conversion_key')->where(array('id'=>$v['id']))->delete();
			    }
			}
	  }
	 if($st['status']=='SUCCES') $order->where($where)->save($data);
	 return $st;
 }	
 
/*地区代理数组*/	
 function agent_area_array()
 {
	$agent=M('ship_address');
	$agent_info=$agent->select();
	$area_id=array();
	foreach($agent_info as $val){
		$area_id[]=agent_area_linkage_s($val['area_id']);	
 	}
	return $area_id;
 } 
 
/*整理出代理联动数组*/
 function linkage_agent_area_array($area_id,$array)
 {  
		foreach($area_id as $key=>$val){
			    $f=false;
				for($i=0;$i<count($array);$i++){
					if($val['v']==$array[$i]['v'])
					{
						$array[$i]['s']=linkage_agent_area_array($val['s'],$array[$i]['s']);	
						$f=true;
					}
				}
				if(!$f) $array[]=$val;	
	    }
	return $array;
 }	 
/*递归显示地区代理数组*/
 function agent_area_linkage_($area_id,$data=array())
 {
	$linkage=M('linkage');
	$agent_c=$linkage->where('id='.$area_id.'')->find();
	if($agent_c){
		$array['n']=$agent_c['name'];
		$array['v']=$agent_c['id'];
		$data[]=$array;
		}
     if($agent_c['parent_id']){
		return agent_area_linkage_($agent_c['parent_id'],$data);
			}else{					
		return $data;
		}
 }
 
 function agent_area_linkage_s($area_id,$data=array())
 {
	 $data=array_reverse(agent_area_linkage_($area_id));
	 return agent_area_linkage($data);
 }
	 
 function agent_area_linkage($data,$i=0,$num)
 {
   if($i==0) $num=count($data);
   if($i<$num){
	   $s['n']=$data[$i]['n'];
	   $s['v']=$data[$i]['v'];
	   if(agent_area_linkage($data,$i+1,$num)) $s['s'][]=agent_area_linkage($data,$i+1,$num);
   }
	return $s;   
  }
	  

/*订单状态显示*/
 function order_status_html($id)
 {
	$order=M('order');
	$where['id']=$id;
	$orderinfo=$order->where($where)->find();
	    if($orderinfo){
			$html.=L('order_status_'.$orderinfo["order_status"].'').' ';
			$html.=L('pay_status_'.$orderinfo["pay_status"].'').' ';
			$html.=L('ship_status_'.$orderinfo["ship_status"].'').' ';
		}
		return $html;
	 }	 
/*
添加购物车*/
 function add_cart($goods_id,$user_id,$goods_num,$model_id)
 {	
 	$goods=goods_info($goods_id,$model_id);
	$cart=M('cart');
	$where['goods_id']=$goods_id;
	$where['user_id']=$user_id;
	$where['model_id']=$model_id;
	$cart_one=$cart->where($where)->find();
	if(!$cart_one){
		$data['goods_id']=$goods_id;
		$data['user_id']=$user_id;
		$data['goods_num']=$goods_num;	
		$data['model_id']=$model_id;
		$shop=M('shop');
		$shop_info=$shop->where('user_id='.$goods['autho_id'].'')->find();
		$data['shop_id']=$shop_info['id'];
		return $cart->add($data);	
	}else{
		$where=array('id'=>$cart_one['id']);
		$cart->where($where)->setInc('goods_num',$goods_num);	
	}		
 }		 
/*
删除购物车
*/
 function delete_cart($id)
 {
	$cart=M('cart');	
	$where['id']=$id;
	return $cart->where($where)->delete();
 }
/*
清空购物车
*/	 
 function clear_cart($user_id)
 {
	$cart=M('cart');	
	$where['user_id']=$user_id;
	return $cart->where($where)->delete();
 }
/*
订单号生成
*/
function order_cn($userid,$times,$area_id=0)
{  
	$start=md5($userid);
	$start=substr($start,-5);
	$start.=$times;
	$start.='_'.$area_id;
	return $start;
}		 
/*
根据店铺id来分割购物车
*/	 
function cart_separate($cart_id=array(),$user_id)
{
	$cart=M('cart');	
	$where['user_id']=$user_id;
	$where['id']=array('in',$cart_id);	
	$cartlist=$cart->where($where)->select();	
	foreach($cartlist as $val){
		$model_id=$val['model_id'];
		$model_config=model_config($model_id);
		$cartlist_new['goods_info'][$val['shop_id']]['info'][]=cart_only_info($val['id']);
		if($model_config['goods_type']==1) $cartlist_new['goods_type']=$model_config['goods_type'];
	 }
	 return $cartlist_new;
 }
/*
结算购物车
$cart_separate 分割完成的购物车数组;
$userid 用户id
$consignee_id 收货信息ID
$discount 折扣
*/
 function settle_cart($cart_separate,$userid,$consignee_id,$discount=1)
 {
	$order=M('order');
	$order_info=M('order_info');
	foreach($cart_separate as $key=>$v){
		$nowtime=time();	
		//生成收货信息
		$consignee_info=consignee_info($id);
		//生成订单号
		$u=rand();
		$order_cn=order_cn($u,$nowtime,$consignee_id);
		$order_cn=only_onec($order_cn);
		$data['order_sn']=$order_cn;
		$data['user_id']=$userid;		
		//添加到订单信息中
			foreach($v['info'] as $val){
				$data['goods_id']=$val['goods_id'];
				$goodname[]=goods_info($val['goods_id'],$val['model_id']);
				$data['order_pro']=$val['order_pro'];
				$data['order_num']=$val['goods_num'];
				$data['amount']=$val['goods']['price']*$val['goods_num'];
				$data['model_id']=$val['model_id'];		
				$data['shop_id']=$val['shop_id'];
				$order_info->add($data);
				$order_price=$order_price+$val['goods']['price']*$val['goods_num'];
				
				$where['id']=$val['id'];//删除购物车该数据
				$cart=M('cart');
				$cart->where($where)->delete();
				$shop_id=$val['shop_id'];
			}
		
			 //添加订单
			 $orderdata['order_sn']=$order_cn;
			 $orderdata['consignee_id']=$consignee_id;
			 $orderdata['shop_id']=$shop_id;
			 $orderdata['user_id']=$userid;
			 $orderdata['addtime']=$nowtime;
			 $orderdata['order_amount']=$order_price*$discount;
			 $orderdata['goods_amount']=$order_price;
			 $orderdata['discount']=$discount;	
			 $id=$order->add($orderdata);
			 set_grand($orderdata['user_id'],$type=array('order'=>1));
			 $order_price=0;
			 $order_cns=$order_cn;
			 $order_cn_html.=$id."|";
			 //下单微信回复
			 foreach($goodname as $val){
				 $goodnames.=$val['title']."|";
				 }
				load('Wechat/function');
	  			$cofig=FF('wechat/wechat_user');
				$openid=return_wechat($userid);	
				$openid=array(array('openid'=>$openid));
				$user=array('order_name'=>$goodnames,'order_sn'=>$orderdata['order_sn'],'order_time'=>''.date("Y-m-d H:i:s",$orderdata['addtime']).'','order_price'=>$orderdata['order_amount']);
				recommend_msg($openid,$cofig['order_tem'],$user);
				
		}
	 return $order_cn_html;
	 }

/*
验证订单号唯一性
*/
 function only_onec($order_cn)
 {
	 $order=M('order');
	 $where['order_sn']=$order_cn;
	 $order_list=$order->where($where)->find();
	 if($order_list){
		return  $order_list['order_sn']."_x";
		 }else{
		return  $order_cn;	 
			 }
 }	 
/*
订单状态数
*/

 function order_count($user_id,$status)
 {
	$order=M('order');
	$where['user_id']=$user_id;
	$where['status']=$status;
	$orderlist=$order->where($where)->select();
	return count($orderlist);
 }
	
/*
查询收货人信息数组
*/	
 function consignee_info($id)
 {
	$consignee=M('consignee');
	$where['id']=$id;
	$consignee_info=$consignee->where($where)->find();
	$consignee_info['area_id']=area($consignee_info['area_id']);
	return $consignee_info;
 }
	
/*
查询收货人信息
*/	
 function consignee_info_html($id)
 {
	$consignee=M('consignee');
	$where['id']=$id;
	$consignee_info=$consignee->where($where)->find();
	if($consignee_info){
	$html.=$consignee_info['consignee'].',';
	$html.=area($consignee_info['area_id']).',';
	$html.=$consignee_info['address'].',';
	$html.=$consignee_info['mobile'].',';
	return $html;
	}
 }
/*
当前用户收货信息
*/
 function consignee_list($userid)
 {
	$consignee=M('consignee');
	$where['user_id']=$userid;
	$consignee_list=$consignee->where($where)->select();
	return $consignee_list;
 }
/*
添加用户收货信息
$consignee_array 要添加的数组 元素为consignee,address,mobile,area_id;
$userid 用户id
$consignee_num 用户添加收获地址上限，默认6个
*/
 function add_consignee($consignee_array,$userid,$consignee_num=20)
 {
	$consignee=M('consignee');
	$where['user_id']=$userid;
	$consignee_list=$consignee->where($where)->select();
//	if(count($consignee_list)>=$consignee_num){
//		return $consignee_num;
//		}else{
		$consignee_array['userid']=$userid;
		return $consignee->add($consignee_array);
//		}
 }
/*修改收货地址
$consignee_array 要添加的数组 元素为consignee,address,mobile,area_id;
$userid 用户id 默认为0的状态为管理员
$consignee_num 用户添加收获地址上限，默认6个

*/	 
 function alter_consignee($consignee_array,$userid=0,$id)
 {
	$consignee=M('consignee');
	$where['id']=$id;
	if($userid!=0){
	$where['user_id']=$userid;
	}
	$consignee_info=$consignee->where($where)->find();
	if(!$consignee_info){
		return 1;
		}else{
		return $consignee->where($where)->add($consignee_array);
		}
 }
/*删除收货地址
$userid 用户id 默认为0的状态为管理员
*/
  function consignee($userid=0,$id)
  {
	$consignee=M('consignee');
	$where['id']=$id;
	if($userid!=0){
	$where['user_id']=$userid;
	}
	return $consignee->where($where)->delete(); 
	}
/*
快递信息（暂无）
*/



/*
显示地区
*/
  function area($id)
  {
	$area=M('linkage');
	$where['id']=$id;
	$area_info=$area->where($where)->find();
	if($area_info){
	$html=area($area_info['parent_id']).' ';
	}
	return $html.$area_info['name'];
 }

/*
虚拟商品生成兑换码
$order_info_id 订单信息id
$valid 生成的兑换码的有效时常，默认90天
$digit 兑换码位数 默认12位
*/
 function conversion_key($order_info_id,$valid=90,$digit=12)
 {
	$order_info=M('order_info');
	$order_conversion_key=M('order_conversion_key');
	$where['id']=$order_info_id;
	$order_infos=$order_info->where($where)->find();	
	$nums=$order_infos['order_num'];
	$order_conversion_info=$order_conversion_key->where('info_id='.$order_info_id.'')->find();
	if(!$order_conversion_info){
	for($i=0;$i<$nums;$i++){
		$data['info_id']=$order_info_id;
		$data['conversion_key']=only_conversion_key($digit);
		$data['valid_time']=time()+90*24*3600;
		$order_conversion_key->add($data);
	 }
	 }
	return true;
 }
/*生成兑换码*/
 function only_conversion_key($digit)
 {	
 	for($i=0;$i<$digit;$i++){
 	$conversion_key.=rand(0,9);
	}
	$order_conversion_key=M('order_conversion_key');
	$where['conversion_key']=$conversion_key;
	if($order_conversion_key->where($where)->find()){	
		$conversion_key=only_conversion_key($digit);
		}
	return $conversion_key;
 }

/*商铺信息显示*/
 function shop_info($shop_id)
 {	
 	$shop=M('shop');
	$where['id']=$shop_id;
	return $shop->where($where)->find();
 }
/*核销兑换码*/
 function verification_key($conversion_key,$user_id=0,$coin_type='money')
 {		
 	 $order_conversion_key=M('order_conversion_key');
	 $order_info=M('order_info');
	 $order=M('order');
	 $where['conversion_key']=$conversion_key;
	 $where['usering']=0;
	 $order_conversion_key_info=$order_conversion_key->where($where)->find();
	 if($order_conversion_key_info) {
	 if($order_conversion_key_info["valid_time"]>time()){
	 $data["usering"]=1;
	 $data["valid_time"]=time();
	 $order_info_id=$order_conversion_key_info["info_id"];
	 if($user_id>0){
	 $where_order_info["shop_id"]=$user_id;
		}
	 $where_order_info["id"]=$order_info_id;	
	 $order_info_info=$order_info->where($where_order_info)->find();
	 $shop_id=$order_info_info['shop_id'];
	 $shop_info=shop_info($shop_id);
	 
	 
	 //店铺分成比例
	 $proportion=shop_proportion($shop_id);
	 $where_s['order_sn']=$order_info_info['order_sn'];
	 $order_s=$order->where($where_s)->find(); 
	 
	 $z=$order_s["order_amount"];
	 if($order_info_info){
	 $order_sn=$order_info_info["order_sn"];
	 $order_info_list=order_info($order_sn);
	 foreach($order_info_list as $val){
		foreach($val["conversion_key"] as $v){
		$order_conversion_key_id[]=$v["id"];
        if($v["usering"]==0){
		$order_conversion_key_id_no[]=$v["id"];
		}
		} 
		}
	 $map['id']  = array('in',$order_conversion_key_id);
	 if($order_conversion_key_id_no){
	 $map2['id']  = array('in',$order_conversion_key_id_no);
	 }
	 $proportion=shop_proportion($shop_id);
	 $order_count=$order_conversion_key->where($map)->count();
	 if(!$order_count){
		$order_count=1; 
		 }
	
	 $zz=$z/$order_count;
	 //分成运算
	 $proportion_zz=$zz*$proportion;
	 //结算运算
	 $zz_all=$zz-$proportion_zz;
	 account($zz_all,$shop_info["user_id"],$coin_type,1,0,'SYSTEM','来自订单'.$order_sn.'销码消费');	 
	 //区域分销
	 load("User/function");
	 agent_divided_into($shop_info['area_id'],$proportion_zz);
	 //三级分销
	 load("Fenxiao/function");
	 rebate_recommend($order_s["user_id"],$proportion_
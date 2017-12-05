<?php
namespace Order\Controller;
use Org\Util\Admin;
class AdminController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
  订单列表
-----------------------------------   
*/
  public function order_list(){ 
  		$order=M('order');
  		$user_id=I('user_id','','intval');
		$order_status=I('order_status',-1,'intval');
		$pay_status=I('pay_status',-1,'intval');
		$ship_status=I('ship_status',-1,'intval');
		$order_sn=I('order_sn','','trim');
		if($order_status>-1){
		$where['order_status']=$order_status;			
			}
		if($pay_status>-1){
		$where['pay_status']=$pay_status;			
			}
		if($ship_status>-1){
		$where['ship_status']=$ship_status;			
			}						
		if($user_id){
		$where['user_id']=$user_id;
			}
		if($order_sn){
		$where['order_sn']=$order_sn;
			}
		$pagesize=10;
		$page=I('page',1,'intval');
		$record_count=$order->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info= order_list($where,$shopid=0,$page,$pagesize);
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
        $this->display();
	  }
/*
-----------------------------------
  修改订单
-----------------------------------
*/
	public function order_update(){
		$order=M('order');
		if(IS_POST){
		$id=I('post.id',0,'intval');
		
		    $order=M('order');
			$orders=$order->where("id=".$id."")->find();
			$order_info=M('order_info');
			$order_info_list=$order_info->where("order_sn='".$orders['order_sn']."'")->find();
			$model_id=$order_info_list['model_id'];
			$model_config=model_config($model_id);
		
		$is_pay=I('post.is_pay',0,'intval');
		$where['id']=$id;
		$status=I('post.status');
		$data[$status]=I('post.status_num');
		$data['order_amount']=I('price');
		$data['remark']=I('remark');	
		if($order->where($where)->save($data)){
			 $st=order_status($id,$data[$status],$status,$model_config['goods_type'],5,$is_pay);
			 if($st['status']=='SUCCES'){
			 echo '<script>parent.location.reload();</script>';
			 }else{
			 $this->error($st['L'],"",3);	 
				 }
			}else{
			 $this->error('',"",3);	
				}
			}else{
		$id=I('get.order_id')?I('get.order_id'):"id";
		$order_status=I('get.order_status');
		$pay_status=I('get.pay_status');
		$ship_status=I('get.ship_status');
		if($order_status){
			$status='order_status';
			$status_num=$order_status;
			}else if($pay_status){
			$status='pay_status';
			$status_num=$pay_status;
			}else if($ship_status){
			$status='ship_status';
			$status_num=$ship_status;
			}
		$where['id']=$id;
		$result=$order->where($where)->find();
		$this->assign('result',$result);
		$this->assign('status',$status);
		$this->assign('status_num',$status_num);
		$this->display();
		}
	}
/*
-----------------------------------  
  订单详情
-----------------------------------   
*/

  public function order_view(){
	   $id=I('id','','intval');
	   $order=M('order');
	   $where['id']=$id;
	   $info=$order->where($where)->find();
	   $info['order_status_html']=order_status_html($id);
	   $info['order_info']=order_info($info['order_sn']);
	   $info['order_consignee']=consignee_info($info['consignee_id']);
	   $this->assign('info',$info);	
	   $this->assign('id',$id);	
	   $this->display();
	  }
/*
-----------------------------------  
  订单状态更新
-----------------------------------   
*/	
  public function update_order(){
	  $id=I('id','','intval');	 
	  $order_status=I('order_status','','trim');
	  $pay_status=I('pay_status','','trim');
	  $ship_status=I('ship_status','','trim');	  
	  if($order_status){
		  $name='order_status';
		  $status=I('order_status','','intval');
		  }elseif($pay_status){
			$name='pay_status';  
			$status=I('pay_status','','intval');
			  }elseif($ship_status){
				$name='ship_status'; 
				$status=I('ship_status','','intval');   
				  }
			$order=M('order');
			$orders=$order->where("id=".$id."")->find();
			$order_info=M('order_info');
			$order_info_list=$order_info->where("order_sn='".$orders['order_sn']."'")->find();
			$model_id=$order_info_list['model_id'];
			$model_config=model_config($model_id);
	  if(order_status($id,$status,$name,$model_config['goods_type'])){		  
		 $this->success(L('Suc_1'),'',0);
		  }else{
		 $this->error(L('User_Index_withdraw_noshow'),"",3);	  
		  }	  
	  }   
/*
-----------------------------------  
  订单删除
-----------------------------------   
*/	
  public function order_del(){
		$id=I('id','','intval');
		if(del_order($id)){			
			    $this->success(L('User_Index_withdraw_Suc_1'),U('Order/Admin/order_list'),0);
				}else{
				$this->error(L('User_Index_withdraw_Err_3'),"",3);				
				}
	  }	
/*退款*/
  public function channel_pay()
  {
	  $id=I('id',0,'intval');
	  $order=M('order');
	  $order_info=$order->where('id='.$id.'')->find();	
	  if($order_info){
			$pay=pay_cannal_pay($id);
			if($pay['status']=='S'){
				$this->success(L('success'),'',0);
				}else{
				$this->error($pay['L'],"",3);	
					}	
	  }
	  
}	    
/*
-----------------------------------  
  购物车测试
-----------------------------------   
*/	
  public function ceshi()
  {
	  
	load('Wechat/function');
	$recommend_ids=return_recommend_ids(11);
	$fenxiao=FF('Conf/config','',APP_PATH.'Fenxiao/');	//读取分销配置
	$scale=explode(",",$fenxiao["scale"]);
	
	foreach($recommend_ids as $val){
		$val['scale']=$scale['lev'];
		$val['scale_num']=$order_proportion*$scale['lev']*0.01;
		}
	dump($recommend_ids);
	  }
/*
-----------------------------------  
  核销兑换码
-----------------------------------   
*/  
 public function verification_key_admin(){
	 if(IS_POST){
		$key=I('post.key','','trim'); 
		$s=verification_key($key,0);
		if(is_array($s)){
			 $this->success(L('key_Suc'),'',0);
			}else{	
			 $this->error($s);	
				}
		 }else{
	   $this->display();	 
			 }
	 }
	 
//添加地址
  public function add_shipaddress_list(){ 
	  if(IS_POST){
	  $id=I('id',0,'intval');
	  $area_id=I('area_id',0,'intval');
	  $ship_address=M('ship_address');
	  $where['area_id']=linkage_id($area_id);	
	  $info=$ship_address->where($where)->find;
	  if(!$info){ 
			  if($ship_address->add($where)){ 
			  $this->success(L('success'),U('Order/Admin/shipaddress_list'),0);
			  }else{
			  $this->error('添加失败',"",$this->r_time);  
				  }
		  }else{
			  $this->error('该地址存在于数据库中',"",$this->r_time);
			  }
		  }else{
		$area_info=link_list_info_1(0,'linkage');
	    $area_id=linkage($area_info,"area_id","",0,"",array('text'=>'请选择','value'=>"0"),'form-control');
	    $this->assign('area_id',$area_id);
	    $this->display();			  			  
		}
	  }
//删除地址
  public function del_shipaddress(){ 
 	 $id=I('id',0,'intval');
     $where['id']=$id;
	 $ship_address=M('ship_address');
	  if($ship_address->where($where)->delete()){ 
			  $this->success(L('success'),U('Order/Admin/shipaddress_list'),0);
			  }else{
			  $this->error('删除失败',"",$this->r_time);  
		}
  }
//地址列表	  
	public function shipaddress_list()
	{
		$pagesize=25;
		$page=I('page',1,'intval');
		$user =M('ship_address');
		$record_count=$user->count();
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$user->order('id desc')->page($page,$pagesize)->select();
			foreach ($info as $k=>$v)
			{
				$info[$k]['areaName']=M('linkage')->where('id='.$v['area_id'])->getField('name');
			}
			$this->assign('arr',$info);
			$page_show=page_show($record_count,$pagesize,3,$other);
			$this->assign('page_show',$page_show);
		}
		$this->display();
	}	   
}
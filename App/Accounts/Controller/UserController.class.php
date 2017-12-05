<?php
namespace Accounts\Controller;
use Org\Util\User;
class UserController extends User {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   注册会员开通   
-----------------------------------   
*/

	/*流水明细*/
    public function index_list(){
		$pagesize=10;	
	    $config=FF('Conf/config','',MODULE_PATH);
		$business_type=$config['Accounts_operation_type'];
		$operation_type=$config['Accounts_business_type'];
		$accounts_record=M("accounts_record"); 
		$page=I('page',1,'intval');
  	    $user=$this->userinfo;
	    $where['userid']=$user["id"];
		$record_count=$accounts_record->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$infos=$accounts_record->where($where)->order('id desc')->page($page,$pagesize)->select();
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		foreach($infos as $val){	
		$val['operation_type']=$operation_type[$val['operation_type']];
		$val['business_type']=$business_type[$val['business_type']];
		$info[]=$val;	
			}
		$page_title=L('Accounts_Menu_list1');
	    $this->assign('page_title',$page_title);
		$this->assign('info',$info);
		$this->assign('accounts_record',$accounts_record);
		$this->assign('page_show',$page_show);
        $this->display();
		}
		
	/*用户充值*/
    public function  user_recharge(){
		$user=$this->userinfo;
	    $user_id=$user["id"];
		
		if(IS_POST)
		{
			 $num = I('post.cash_num');
			 $data['body']=$user_id.'用户充值';
			 $data['attach']='recharge';
			 $data['out_trade_no']=$user_id."t".time();
			 $data['price']=$num*100;
			 $data['goods_tag']='goods_tag';
			 wx_pay_html5($data);	 
		 }else{	  
		$page_title=L('Accounts_user_recharge');
	    $this->assign('page_title',$page_title);
		  }
        $this->display();
		}
		/*预约充值活动*/
	public function  user_re(){
	   $c=FF('Conf/recharge_conf','',COMMON_PATH.'Cache/');
	   $now = time();
	   $user_id=$GLOBALS['LOGIN_USER']['id'];

	   if(strtotime($c['activitiOne']['end_data']) < $now && $now < strtotime($c['activitiTwo']['start_data']))
	   {
		   $end = strtotime($c['activitiOne']['end_data']);
		   $get = strtotime($c['activitiTwo']['start_data']);
		   $dk=M('freeze_record')->where("user_id ='$user_id' and activity_state = 3 and add_time < '$get'and add_time >'$end'")->find();
		   $keyong = $dk['integral'];
		   if($_POST){
				   
			       if($_POST['num']>$dk['integral'])
				   {
					   $this->error("余额不足！","",$this->user_re);
				   }else{
					   $data['integral'] = $dk['integral'] - $_POST['num'];
					   $king = M('freeze_record')->where("user_id ='$user_id' and activity_state = 3 and add_time < '$get'and add_time >'$end'")->save($data);
					        $User = M("freeze_record");
							$data['user_id']= $user_id;
							$data['num'] = $_POST['num'];
							$data['multiple'] = $c['activitiTwo']["multiple"];
							$data['activity_state'] = 2;
							$data['add_time'] = strtotime($c['activitiTwo']["start_data"]);
							$data['frozen_data'] = strtotime("+".$c['activitiTwo']["frozen_data"]." day",strtotime($c['activitiTwo']["start_data"]));
							$data['state'] = 1;
							$data['integral']=0;
							$data['imazamox']=0;
							$data['operation_data'] = $c['activitiTwo']['operation_data'];
							$User->add($data);
							$this->success('预约成功', $this->user_re);
				   }
		   }
		   $an="<button type='submit' class='btn btn-primary btn-sm' id='btn'>充值</button>";

	   }else{
		   
	   $dui=M('freeze_record')->where("'$now' > frozen_data and user_id ='$user_id' and state = 1 and activity_state < 3" )->select();
	   $where['id'] = array('eq',$_SESSION['BB_']['user']['id']);
	   $du=M('user')->where($where)->find();
	   $keyong = $du['point'];
	   if(!empty($dui))
	   {
		   foreach($dui as $k)
		   {
			   	       if($_POST)
					   {
					   if($_POST['num']>$du['point']){
						   $this->error("余额不足！","",$this->user_re);
					   }else{
						   
					   $data['point'] = $du['point'] - $_POST['num'];
					   $king = M('user')->where("id =".$user_id)->save($data);
					        $User = M("freeze_record");
							$data['user_id']= $user_id;
							$data['num'] = $_POST['num'];
							$data['multiple'] = $c['activitiTwo']["multiple"];
							$data['activity_state'] = 2;
							$data['add_time'] = time();
							$data['frozen_data'] = strtotime("+".$c['activitiTwo']["frozen_data"]." day",time());
							$data['state'] = 1;
							$data['integral']=0;
							$data['imazamox']=0;
							$data['operation_data'] = $c['activitiTwo']['operation_data'];
							$User->add($data);
							$this->success('预约成功', $this->user_re);
				    
			   }
					   }
		   }
		    $an="<button type='submit' class='btn btn-primary btn-sm' id='btn'>充值</button>";
	   }else{
		   $an = "<button type='button' class='btn btn-lg btn-primary' disabled='disabled' id='btn'>不在预约活动期</button>";
	   }
	   }


	   //$an = "<button type='button' class='btn btn-lg btn-primary' disabled='disabled'>不在预约活动期</button>";
       $this->assign('ke',$keyong);
	   $this->assign('anniu',$an);
        $this->display();
	}	
	public function  user_r(){
	   $c=FF('Conf/recharge_conf','',COMMON_PATH.'Cache/');
	   $now = time();
	   if($_POST[data])
	   {
		    if(strtotime($c['activitiOne']['end_data']) < $now && $now < strtotime($c['activitiTwo']['start_data']))
			   {
				   $where['user_id'] = $_SESSION['BB_']['user']['id'];
				   $where['activity_state']=array('eq',3);
				   $dui=M('freeze_record')->where($where)->field('SUM(num)as king')->group('user_id')->select();
				   if($_POST[data] > $dui[0]['king']){
					   echo 3;
				   }else{
					   echo 2;
				   }
			   }else{
				   echo 1;
			   }
	   }
	}
			
}
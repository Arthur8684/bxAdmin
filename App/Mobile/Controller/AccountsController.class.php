<?php
namespace Mobile\Controller;
use Org\Util\User;
class AccountsController extends User {

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
		if(IS_POST){
		 $num=I('post.cash_num');
		 $user=$this->userinfo;
	     $user_id=$user["id"];
		 if($num){
			$this->redirect('Accounts/Pay/pay/','order_id=recharge|'.$user_id.'|'.$num.'');
			 }		 
		  }else{	  
		$page_title=L('Accounts_user_recharge');
	    $this->assign('page_title',$page_title);
        $this->display();
		}
		}		
			
}
<?php
namespace Accounts\Controller;
use Org\Util\Admin;
class IndexController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   注册会员开通   
-----------------------------------   
*/
    public function save_withdraw(){


    }
/*提现列表*/	
    public function withdraw_list(){
		$withdraw=M("withdraw"); 
		$pagesize=10;
		$page=I('page',1,'intval');
		$status=I("get.status",0,'intval');
		$where['status']=$status;
		$record_count=$withdraw->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$infos=$withdraw->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		$accounts[money] = $withdraw->where($where)->sum('amount');
		$accounts[money_all] = $withdraw->sum('amount');
		foreach($infos as $val){
			$val['user']=$this->username($val['userid']);
			$val['withdraw_way']=$this->withdraw_way($val['way']);
			$info[]=$val;
			}
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$this->assign('info',$info);
		$this->assign('status',$status);
		$this->assign('accounts',$accounts);
		$this->assign('page_show',$page_show);
        $this->display();
    }	
/*提现操作方法*/
	public function withdraw_operate(){
		$withdraw=M("withdraw"); 
		$User=M("user"); 
		if(IS_POST){
		$id=I('post.id',0,'intval');
		$where['id']=$id;	
		$v=$withdraw->where($where)->find();
		$status=I('post.status');
		$userid=I('post.userid');
		$amount=I('post.amount');
		$msg=I('post.msg');
		$where['id']=$id;
		$data['status']=$status;
		$data['msg']=$msg;
		if($status<4){
		if($withdraw->where($where)->save($data)){
			if($status==2){	
			    $admin=$this->admininfo;
			    $operation_user=$admin['user'];	
				account($v["id"],array('money'=>-$amount),3,$v["way"],$operation_user,$msg,0);
				}
			if($status==3){//拒绝操作
				$User->where('id='.$userid.'')->setInc('money',$amount); 	//拒绝返回账户
				}
			
		$this->success(L('User_Index_Accounts_Suc_1'),U('Accounts/Index/withdraw_list'),0);				
			}
			}else{
			if($withdraw->where($where)->delete()){	//删除操作
			$User->where('id='.$userid.'')->setInc('money',$amount); 	//删除返回账户
			$this->success(L('User_Index_Accounts_Suc_1'),U('Accounts/Index/withdraw_list'),0);		
				}				
			}	
		}else{	
		$id=I('get.id',0,'intval');	
		if($id){
		$where['id']=$id;	
		$v=$withdraw->where($where)->find();	
		$v["username"]=$this->username($v["userid"]);
		$v["way"]=$this->withdraw_way($v["way"]);
		$this->assign('v',$v);	
		$this->display();
		}else{
		$this->error(L($id),U('Accounts/Index/withdraw_list'),0);	
		}
		}
		}	
		
	/*流水明细*/
/*流水明细*/
    public function Accounts_list(){
		$sl= C('operation_type');
		$d = explode("|",$sl);
		$m['money']=C('money');
		$m['amount']=C('amount');
		$m['promote_point']=C('promote_point');
		$m['point']=C('point');
		$m['point1']=C('point1');
		$m['point2']=C('point2');
		$m['point3']=C('point3');
		$m['point4']=C('point4');
		$m['point5']=C('point5');
		$m['point6']=C('point6');
		$this->assign('m',$m);
		$business_type = C('business_type');
		$business = explode("|",$business_type);
		$pagesize=15;	
	    $config=FF('Conf/config','',MODULE_PATH);
		$business_type=explode("|",$config['business_type']);
		$operation_type=explode("|",$config['operation_type']);
		$accounts_record=M("accounts_record"); 
		$page=I('page',1,'intval');
		if(I('username')){
			$username=I('username');
			$whereuser['user']=$username;
			if((!mb_check_encoding($whereuser['user'], 'utf-8'))) $whereuser['user']=iconv("GB2312","UTF-8",$whereuser['user']);
			$whereuser['id']=$username;
			$whereuser['cart']=$username;
			$whereuser['_logic'] = 'or';	
			$user_info=M('user')->where($whereuser)->find();
			if($user_info) $where['userid']  = $user_info['id'];
		}
		if(I('msg')){
			$msg=I('msg');
			if((!mb_check_encoding($msg, 'utf-8'))) $msg=iconv("GB2312","UTF-8",$msg);
			$where['msg']=array('like','%'.$msg.'%');
			$this->assign('msg',$msg);
		}		
		if((!mb_check_encoding($username, 'utf-8'))) $username=iconv("GB2312","UTF-8",$username);
		$this->assign('username',$username);
		$times_start=I('times_start');
		$this->assign('times_start',$times_start);
		$times_end=I('times_end');
		$this->assign('times_end',$times_end);
		$business_type_post=I('business_type',-1,'intval');
		$this->assign('business_type_post',$business_type_post);
		$operation_type_post=I('operation_type',-1,'intval');
		$this->assign('operation_type_post',$operation_type_post);
		$coin_type=I('coin_type');
		$this->assign('coin_type',$coin_type);
		$alter=I('alter',-1,'intval');
		$this->assign('alter',$alter);
		if($business_type_post>-1){
			$where['business_type']=$business_type_post;
			}
		if($operation_type_post>-1){
			$where['operation_type']=$operation_type_post;
			}		
		if($coin_type>-1 && $alter>-1){
			if($alter==0) $array=array('GT',0);
			if($alter==1) $array=array('LT',0);
			$where[$coin_type]=$array;
			}
		if($coin_type && $alter<0){
			$array=array('NEQ',0);
			$where[$coin_type]=$array;
			}	
		if(!$coin_type && $alter>-1){
			if($alter==0) $array=array('GT',0);
			if($alter==1) $array=array('LT',0);
			$where[money]=$array;
			$where[amount]=$array;
			$where[point]=$array;
			}		
		if($times_start && $times_end){
		$where['addtime']  = array('between',''.strtotime($times_start).','.strtotime($times_end).'');
		}
		$record_count=$accounts_record->where($where)->count();
		$accounts[money] = $accounts_record->where($where)->sum('money');
		$accounts[amount] = $accounts_record->where($where)->sum('amount');
		$accounts[point] = $accounts_record->where($where)->sum('point');
		$this->assign('accounts',$accounts);
		$page=$record_count<$pagesize?1:$page; 
		$infos=$accounts_record->where($where)->order('id desc')->page($page,$pagesize)->select();
		$page_show=page_show($record_count,$pagesize,3,$other);
		
		foreach($infos as $val){
		$val['operation_type']=$operation_type[$val['operation_type']];
		$val['business_type']=$business_type[$val['business_type']];
		$val['balance']=unserialize($val['balance']);
		$info[]=$val;	
			}
		
		$this->assign('business_type',$business_type);
		$this->assign('operation_type',$operation_type);
		$this->assign('business',$business);	
        $this->assign('cl',$d);
		$this->assign('info',$info);
		$this->assign('accounts_record',$accounts_record);
		$this->assign('page_show',$page_show);
        $this->display();
		}
	/*增减资金*/
	 public function accounts_alter(){	
	 	 $user=I('username','','trim');	 
		 if(IS_POST){
			 
				 if($this->userid($user)){				 
					 $userid=$this->userid($user);	
					 $coin_type=I('coin_type','money','trim');			 
					 $coin_count=I('coin_count',0,'intval');
					 $business_type=I('business_type',0,'intval');			 
					 $operation_type=I('operation_type',0,'intval');
					 $msg=I('msg');	
					 $admin=$this->admininfo;
					 $operation_user=$admin['user'];
					 $account=account($userid,array($coin_type=>$coin_count),$operation_type,$business_type,$operation_user,$msg);
						 if($account>0 && is_numeric($account)){
							$this->success(L('User_Index_Accounts_Suc_1'),U('Accounts/Index/Accounts_list'),0);
							}else{
							$this->error(C($account."_name").L('Accounts_balance_Pay_err'),'',0);
						 }	 
					 }else{
						$this->error(L('User_Index_Accounts_nouser'),'',0);	  
				 }
			 }else{
			 $config=FF('Conf/config','',MODULE_PATH);
			 $business_type=explode("|",$config['business_type']);
		     $operation_type=explode("|",$config['operation_type']);
			 $this->assign('business_type',$business_type);
			 $this->assign('username',$username);
			 $this->assign('operation_type',$operation_type);
			 $this->assign('coin_type',C('point_type'));
			 $this->display();					 
		 }
	}	
	/*清理资金流水数据*/
	
	 public function accounts_del(){		 
		 if(IS_POST){
			 $accounts_record=M("accounts_record"); 
			 $ago=I('ago',90,'intval');	
			 $ago=$ago*24*3600;
			 $nowtime=time()-$ago;
				 if($accounts_record->where('addtime < '.$nowtime.'')->delete()){
					 $this->success(L('User_Index_Accounts_Suc_1'),U('Accounts/Index/Accounts_list'),0);
					 }else{
					 $this->success(L('User_Index_Accounts_Suc_1'),U('Accounts/Index/Accounts_list'),0);
				 }
			 }else{
			 $this->display();
			 }
		 }
	
	
	
	//方法
	//获取会员名	
	public function username($userid){
		$user=M('user');
		$where["id"]=$userid;		
		$users=$user->where($where)->find();
		return $users['user'];
		}
	public function userid($username){
		$user=M('user');
		$where["user"]=$username;		
		$users=$user->where($where)->find();
		return $users['id'];
		}
		//提现方式	
	public function withdraw_way($wayid){
		$withdraw_way=M("withdraw_way");
		$where["id"]=$wayid;
		$info=$withdraw_way->where($where)->find();
		return $info['name'];
		}
}
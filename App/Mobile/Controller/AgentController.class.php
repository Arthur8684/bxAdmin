<?php
namespace Mobile\Controller;
use Org\Util\User;
class AgentController extends User {
	public $group_id = 8;//代理组ID
	public $cardtype = 'point';//代理组ID
    public function index(){
		$user=$this->userinfo;	
		if($user['group_id']!=$group_id) $this->error(L('没有代理权限'),"",$this->r_time);
		$usertable = M('user');
		$recommd_num=$usertable->where(array('recommend'=>$user['id']))->count();
		$this->assign('recommd_num',$recommd_num);
		$this->assign('page_title','代理平台');
        $this->display();	
    }
	public function add_room_card()
	{
		if($user['group_id']!=$this->group_id) $this->error(L('没有代理权限'),'',$this->r_time);
		$user=$this->userinfo;	
		if(IS_POST)
		{
			$user=$this->userinfo;	
			$userid = I('userid'); 
			$cash_num = I('cash_num');
			$usertable = M('user');
			if($usertable->where(array('id'=>$userid))->count()==0) $this->error(L('用户不存在'),"",$this->r_time);
			if($cash_num<=0) $this->error(L('请输入正确的房卡数量'),"",$this->r_time);
			if($user[''.$this->cardtype.'']<$cash_num)   $this->error(L('您的房卡不够给此用户充值'),"",$this->r_time);
			if(account($user['id'],array($this->cardtype=>-$cash_num),0,5,'代理充值'.$user['id'],'代理【'.$user['id'].'】为用户【'.$userid.'】充值'))
			{
				if(account($userid,array($this->cardtype=>$cash_num),0,5,'代理充值'.$user['id'],'代理【'.$user['id'].'】为用户【'.$userid.'】充值'))
				{
					$this->success(L('充值成功'),U('Mobile/Agent/add_room_card'),0);
				}else
				{
					$this->error(L('充值失败，稍后再试'),"",$this->r_time);
				}
			}
			else
			{
				$this->error(L('扣房卡失败，充值失败'),"",$this->r_time);
			}
		}else{
		$this->assign('card_num',$user[''.$this->cardtype.'']);
		$this->assign('page_title','房卡充值');
		$this->display();	
		}
	}
	public function recommend_list()
	{ 
		$user=$this->userinfo;	
		//if($user['group_id']!=$this->group_id) $this->error(L('没有代理权限'),"",$this->r_time);
		$usertable = M('user');
		$recommd_num=$usertable->where(array('recommend'=>$user['id']))->count();
		
		$pagesize=10;	
		$page=I('page',1,'intval');
	    $where['recommend']=$user["id"];
		$record_count=$usertable->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$usertable->where($where)->order('id desc')->page($page,$pagesize)->select();
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
		$this->assign('page_title','我推荐的玩家');
		$this->display();	
	}
}
<?php
namespace Chat\Controller;
use Org\Util\User;
class UserController extends User {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }  
/*=================================================
**主持人申请页面
==================================================
===
*/
	public function application(){
		$parentid=I('parentid',0,'intval');
		$chat_room=M('chat_room');
		$user=$this->userinfo;
		$id=$user['id'];
		$where['user_id']=$id;
		$result=$chat_room->where($where)->find();
		if(IS_POST){
			$user_id=I('id');
			$title=I('title');
			$describe=I('description');
			$open_peoples=I('open_peoples');
			$anchor_cover=I('anchor_cover');
			$get_type=I('get_type');
			$class_id=I('class_id');
			if(!$user_id) $this->error(L('Illegal_operation'),"",$this->r_time);
			if(!$title) $this->error(L('Please_fill_in_the_live_title'),"",$this->r_time);
			if(!$describe) $this->error(L('Please_fill_in_the_broadcast'),"",$this->r_time);
			$data['user_id']=$user_id;
			$data['title']=$title;
			$data['describe']=$describe;
			$data['class_id']=$class_id;
			$data['get_type']=$get_type;
			$data['open_peoples']=$open_peoples;
			$data['anchor_cover']=$anchor_cover;
			if(!$result){
				$data['add_time']=time();
				if($chat_room->add($data)){
					$this->success(L('Successful_application'),U('Chat/User/direct_live'),3);
				}else{
					$this->error(L('Illegal_operation'),"",$this->r_time);
				}
			}else{
				$data['status']=$result['status'];
				if($chat_room->where($where)->save($data)!==false){
					$this->success(L('Successful_modification'),U('Chat/User/direct_live'),3);
				}else{
					$this->error(L('Modify_failed'),"",$this->r_time);
				}
			}
		}else{
			$info=$result?$result:'';
			$this->assign('menu_list',chat_menu_check(0,$info['class_id']));
			$this->assign('info',$info);
			$this->assign('user',$user);
			$this->display();
		}
	}
	public function direct_live(){
		$chat_room=M('chat_room');
		$user=$this->userinfo;
		$id=$user['id'];
		$where['user_id']=$id;
		$room=$chat_room->where($where)->find();
		//dump(unserialize($result['url']));
		$this->assign('room',$room);
		$this->assign('user',$user);
		$this->display();
	}
/*=================================================
**连麦主持列表
==================================================*/
	public function people_live(){
		$info=$this->userinfo;
		$chat_peoples=M('chat_peoples');
		$user=M('user');
		$where['user_id']=$info['id'];
		$room=room($where,'');
		if(!$room['open_peoples']) $this->error(L('Perform_this_operation'),"",$this->r_time);
		if(!$room || $room['status']!='1') $this->error(L('You_can_not_perform_this_operation'),"",$this->r_time);
		$result=$chat_peoples->select();
		foreach($result as $k=>$v){
			$user_name=$user->where(array('id'=>$v['user_id']))->getField('user');
			$result[$k]['user']=$user_name;
		}
		$this->assign('result',$result);
		$this->display();
	}
/*=================================================
**连麦主持列表
==================================================*/
	public function peoples_add(){
		$info=$this->userinfo;
		$chat_peoples=M('chat_peoples');
		if(IS_POST){
			$data=I('post.');
			if(!$data['user_id']) $this->error(L('User_ID_cannot_be_empty'),"",$this->r_time);
			if($data['info_id']==$data['user_id'])	$this->error(L('You_choose_to_be_yourself'),"",$this->r_time);
			$config=FF('Conf/direct_config','',MODULE_PATH);
			$where['user_id']=$data['info_id'];
			$rooms=room($where,'');
			$peoples=$chat_peoples->where(array('room_id'=>$rooms['id']))->select();
			foreach($peoples as $k=>$v){
				if($v['user_id']==$data['user_id']) $this->error(L('You_have_already_added_this_user'),"",$this->r_time);
			}
			$count=$chat_peoples->where(array('room_id'=>$rooms['id']))->count();
			if($count>=$config['peoples_num']) $this->error(L('You_have_exceeded_the_number_of_additions'),"",$this->r_time);//允许连麦人数
			if ($chat_peoples->create($data)){
				Vendor('Live_radio.Vcloud');
				$Vcloud=new \Vcloud($config['appkey'],$config['appsecret']);
				$date=create_channel($Vcloud);
				$chat_peoples->cid=$date['cid'];
				$chat_peoples->url=$date['url'];
				$chat_peoples->room_id=$rooms['id'];
				$chat_peoples->add_time=time();
				if($chat_peoples->add())
				{
					$this->success(L('ADD').L('success'),U("Chat/user/people_live"),$this->r_time);
				}
				else
				{
					$this->error(L('ADD').L('ERR'),"",$this->r_time);
				}
			}
		}else{
			$this->assign('info',$info);
			$this->display();
		}
	}
	public function people_del(){
		$id=I('id');
		$del_num=0;//删除会员的条数
		$chat_peoples=M('chat_peoples');
		//------------------------------------验证数据正确性----------------------------------------
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		$where['id']=$id;
		$cid=$chat_peoples->where($where)->getField('cid');
		if($cid){
			del_channel_0($cid);
		}
		$del_num=$chat_peoples->where($where)->delete();
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Chat/User/people_live"),$this->r_time);
	}
}
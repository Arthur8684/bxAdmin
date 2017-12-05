<?php
namespace Admin\Controller;
use Org\Util\Admin;

class ChatController extends Admin {

	function __construct()  //析构函数
	{
		parent::__construct();
	}
	public function chat_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$chat_room=M('chat_room');
		$user=M('user');
		//------------------------------------管理员列表----------------------------------------
		$record_count=$chat_room->count();//获取总记录数
		$page=$record_count<$pagesize	?1:$page;
		if($record_count>0)
		{
			$info=$chat_room->order('id desc')->page($page,$pagesize)->select();
			foreach($info as $key=>$val){
				$where['id']=$val['user_id'];
				$user_name=$user->where($where)->getField('user');
				$info[$key]['user']=$user_name;
			}
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
		//------------------------------------管理员列表----------------------------------------
		$this->assign('info',$info);
		$this->display();
	}
	public function chat_edit(){
		$id=I('id',0,'intval');
		$chat_room=M('chat_room');
		$user=M('user');
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		$where['id']=$id;
		$result=$chat_room->where($where)->find();
		$where1['id']=$result['user_id'];
		$username=$user->where($where1)->getField('user');
		if(IS_POST){
			if(!I('id'))
			{
				$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			}
			$title=I('title');
			$direct_head=I('head_img');
			$describe=I('description');
			if(!$title) $this->error(L('Please_fill_in_the_live_title'),"",$this->r_time);
			if(!$direct_head) $this->error(L('Please_upload_the_anchor_head'),"",$this->r_time);
			if(!$describe) $this->error(L('Please_fill_in_the_broadcast'),"",$this->r_time);
			$data['user_id']=$id;
			$data['title']=$title;
			$data['direct_head']=$direct_head;
			$data['describe']=$describe;
			$data['status']=$result['status'];
			if($chat_room->where($where)->save($data)!==false){
				$this->success(L('Successful_modification'),U('Admin/chat/chat_list'),3);
			}else{
				$this->error(L('Modify_failed'),"",$this->r_time);
			}
		}else{
			$this->assign('username',$username);
			$this->assign('result',$result);
			$this->display();
		}
	}
	public function chat_del(){
		$id=I('id',0,'intval');
		$chat_room=M('chat_room');
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		$where['id']=$id;
		$result=$chat_room->where($where)->delete();
		$this->success(L('DEL_RECORD',array('num'=>$result)),U("Admin/Chat/chat_list"),$this->r_time);
	}
}
?>
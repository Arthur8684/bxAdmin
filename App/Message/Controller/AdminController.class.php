<?php
namespace Message\Controller;
use Org\Util\Admin;
class AdminController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
   
	
	public function message_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$type=I('type');
		$type=$type?$type:"all";
		$user_id=0;
		$message =M('message');
		if($type=='send')
		{
			$where['send_userid']=$user_id;
			$where['send_status']=array('NEQ',2);
		}else if($type=='receive')
		{
			$where['receive_userid']=$user_id;
			$where['receive_status']=array('NEQ',2);
		}
		else
		{
		}

		//------------------------------------短信列表----------------------------------------
		$record_count=$message->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize	?1:$page;
		if($record_count)
		{
			$info=$message->where($where)->order('id desc')->page($page,$pagesize)->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}

		//------------------------------------短信列表----------------------------------------
		$this->assign('info',$info);
		$this->assign('type',$type);
		$this->display();
	}
	/*
    -----------------------------------
       信息添加
    -----------------------------------
    */
	public function message_send(){
		$type=I('type');
		$type=$type?$type:"receive";
		if(IS_POST)
		{
			$receive_type=I('receive_type');
			$title=I('title');
			$content=I('content');
			$receive=I('receive');
			if(!$title) $this->error(L('Message_Err_0'),"",$this->r_time);
			if(!$content) $this->error(L('Message_Err_1'),"",$this->r_time);
			if($receive_type=='admin')
			{
				$receive=0;
			}
			else
			{
				if(!$receive) $this->error(L('Message_Err_2'),"",$this->r_time);
				if(is_numeric($receive))
				{
					if($receive==$GLOBALS['LOGIN_USER']['id']) $this->error(L('Message_Err_4'),"",$this->r_time);
					$where['id']=$receive;
				}
				else
				{
					if($receive==$GLOBALS['LOGIN_USER']['user']) $this->error(L('Message_Err_4'),"",$this->r_time);
					$where['user']=$receive;
				}
				$user=M('user')->where($where)->find();
				if(!$user) $this->error(L('Message_Err_3'),"",$this->r_time);
			}
			//------------------------------------短信提交----------------------------------------
			$send=send($title,$content,$receive);
			if ($send){
				$this->success(L('Message_Success'),U("Message/Admin/message_list",array('type'=>$type)),$this->r_time);
			}
			else
			{
				$this->error(L('Message_Fall'),"",$this->r_time);
			}
			//------------------------编辑提交的管理员完--------------------------------------
		}
		else
		{
			$this->assign('type',$type);
			$this->display();
		}
	}
	/*
    -----------------------------------
       信息显示 
    -----------------------------------
    */
	public function message_view()
	{
		$id=I('id',0,'intval');
		$user_id=0;
		if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		$info=M('message')->where(array('id'=>$id))->find();
		M('message')->where(array('id'=>$id))->setField('receive_status',1);
		$this->assign('info',$info);
		$this->assign('user_id',$user_id);
		$this->display();
	}

	/*
    -----------------------------------
       删除信息
    -----------------------------------
    */
	public function message_del()
	{
		$type=I('type');
		$type=$type?$type:"receive";

		$id=I('id');
		if(!is_array($id)) $id=array($id);
		$user_id=0;
		$m=M('message');
		foreach($id as $k => $v)
		{
			$message=$m->where('id='.$v)->find();
			if($message['send_userid']==$user_id)
			{
				$m->where('id='.$v)->setField('send_status',2);
			}
			else if($message['receive_userid']==$user_id)
			{
				$m->where('id='.$v)->setField('receive_status',2);
			}
			else
			{

			}
		}
		$m->where('id in ('.implode(",",$id).') and (send_userid='.$user_id.' or receive_userid='.$user_id.') and send_status=2 and receive_status=2')->delete();
		$this->success(L('DEL').L('success'),U("Message/Admin/message_list",array('type'=>$type)),$this->r_time);
	}
}
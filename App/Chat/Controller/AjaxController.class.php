<?php
namespace Chat\Controller;
use Org\Util\Admin;
class AjaxController extends Admin {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }
	
	public function gift_ajax()
	{
		C('TOKEN_ON',false); //关闭表单令牌
		$auth_rule =D('chat_gift');
		$get=I('get.');
		foreach($get as $k => $v)
		{
			$data[$k]=$v;
		}
		if($data['show_type']==1)
		{
			$data['show_type']=1;
		}else 
		{
			$data['show_type']=2;
		}
		//------------------------------------验证数据正确性----------------------------------------
		if(!$data['id'])
		{
			$return['err']  = 0;
			$return['content'] = L('ERR_PARAM_ID');
			$this->ajaxReturn($return);
		}
		//------------------------------------验证数据正确性完----------------------------------------
		//------------------------------------编辑提交的权限----------------------------------------
		if ($auth_rule->create($data)){
			if($auth_rule->save()!==false)
			{
				 
				$return['err']  = 1;
				$return['content'] = L('EDIT').L('SUCCESS');
				$this->ajaxReturn($return);
			}
			else
			{
				$return['err']  = 0;
				$return['content'] = L('EDIT').L('ERR');
				$this->ajaxReturn($return);
			}
		}
		else
		{
			$return['err']  = 0;
			$return['content'] = $auth_rule->getError();
			$this->ajaxReturn($return);
		}
	
	}
    public function create_app(){
		 $ls_userid=I('ls_userid');
		 $ls_uuid=I('ls_uuid');
		 $ls_secret=I('ls_secret');

		 Vendor('Live_radio.Mlecloud');
	     $Vcloud=new \Mlecloud($ls_userid,$ls_secret,$ls_uuid);
	     $parm=array('appName'=>time(),'category'=>25,'platform'=>'android,ios','needPushAuth'=>1,'needPullAuth'=>1,'pushUrlValidTime'=>1800,'pullUrlValidTime'=>1800,'status'=>1);
         $return=$Vcloud->live('lecloud.mobileLive.app.create',$parm);
		 
		 if($return['liveKey'])
		 {
			 $data['ls_sign']=$return['liveKey'];
			 $data['ls_push']=$return['pushDomain'];
			 $data['ls_pull']=$return['pullDomain'];
			 $data['ls_app_name']=$return['appName'];
			 $data['err']  = 0;
			$this->ajaxReturn($data);
		 }
		
    }
	
	public function open_ajax(){
		C('TOKEN_ON',false); //关闭表单令牌
		
		$chat_room=M('chat_room');
		$get=I('get.');
		foreach($get as $k => $v)
		{
			$data[$k]=$v;
		}
		if(!$data['id'])
		{
			$return['err']  = 0;
			$return['content'] = L('ERR_PARAM_ID');
			$this->ajaxReturn($return);
		}
		$where['id']=$data['id'];
		if($data){
			if($data['status']==1) get_channel($data['id']);
			if($chat_room->where($where)->save($data)){
				set_status($data['id'],$data['status']);
				$return['err']  = 1;
				$return['content'] = L('EDIT').L('SUCCESS');
				$this->ajaxReturn($return);
			}else{
				$return['err']  = 0;
				$return['content'] = L('EDIT').L('ERR');
				$this->ajaxReturn($return);
			}
		}else{
			$return['err']  = 0;
			$return['content'] = L('EDIT').L('ERR');
			$this->ajaxReturn($return);
		}
	}
	public function open_peoples(){
		C('TOKEN_ON',false); //关闭表单令牌
		$chat_room=M('chat_room');
		$get=I('get.');
		foreach($get as $k => $v)
		{
			$data[$k]=$v;
		}
		if(!$data['id'])
		{
			$return['err']  = 0;
			$return['content'] = L('ERR_PARAM_ID');
			$this->ajaxReturn($return);
		}
		if ($chat_room->create($data)){
			if($chat_room->save()!==false)
			{

				$return['err']  = 1;
				$return['content'] = L('EDIT').L('SUCCESS');
				$this->ajaxReturn($return);
			}
			else
			{
				$return['err']  = 0;
				$return['content'] = L('EDIT').L('ERR');
				$this->ajaxReturn($return);
			}
		}
		else
		{
			$return['err']  = 0;
			$return['content'] = $chat_room->getError();
			$this->ajaxReturn($return);
		}
	}
	public function menu_ajax(){
		C('TOKEN_ON',false); //关闭表单令牌
		$menu =M('chat_gift');
		$get=I('get.');
		foreach($get as $k => $v)
		{
			$data[$k]=$v;
		}
		if(!$data['id'])
		{
			$return['err']  = 1;
			$return['content'] = L('ERR_PARAM_ID');
			$this->ajaxReturn($return);
		}
		if ($menu->create($data)){
			if($menu->save()!==false)
			{

				$return['err']  = 0;
				$return['content'] = L('EDIT').L('SUCCESS');
				$this->ajaxReturn($return);
			}
			else
			{
				$return['err']  = 1;
				$return['content'] = L('EDIT').L('ERR');
				$this->ajaxReturn($return);
			}
		}
		else
		{
			$return['err']  = 1;
			$return['content'] = $menu->getError();
			$this->ajaxReturn($return);
		}
	}
	public function chat_menu_ajax(){
		C('TOKEN_ON',false); //关闭表单令牌
		$menu =M('chat_class');
		$get=I('get.');
		foreach($get as $k => $v)
		{
			$data[$k]=$v;
		}
		if(!$data['id'])
		{
			$return['err']  = 1;
			$return['content'] = L('ERR_PARAM_ID');
			$this->ajaxReturn($return);
		}
		if ($menu->create($data)){
			if($menu->save()!==false)
			{

				$return['err']  = 0;
				$return['content'] = L('EDIT').L('SUCCESS');
				$this->ajaxReturn($return);
			}
			else
			{
				$return['err']  = 1;
				$return['content'] = L('EDIT').L('ERR');
				$this->ajaxReturn($return);
			}
		}
		else
		{
			$return['err']  = 1;
			$return['content'] = $menu->getError();
			$this->ajaxReturn($return);
		}
	}
	public function chat_menu_sort(){
		C('TOKEN_ON',false); //关闭表单令牌
		$menu =M('chat_class');
		$get=I('get.');
		foreach($get as $k => $v)
		{
			$data[$k]=$v;
		}
		if(!$data['id'])
		{
			$return['err']  = 1;
			$return['content'] = L('ERR_PARAM_ID');
			$this->ajaxReturn($return);
		}
		if ($menu->create($data)){
			if($menu->save()!==false)
			{

				$return['err']  = 0;
				$return['content'] = L('EDIT').L('SUCCESS');
				$this->ajaxReturn($return);
			}
			else
			{
				$return['err']  = 1;
				$return['content'] = L('EDIT').L('ERR');
				$this->ajaxReturn($return);
			}
		}
		else
		{
			$return['err']  = 1;
			$return['content'] = $menu->getError();
			$this->ajaxReturn($return);
		}
	}
}
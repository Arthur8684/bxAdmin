<?php
namespace Chat\Controller;
use Org\Util\User;
class UserAjaxController extends User {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }
	 function update_room_time()
	 {
		C('TOKEN_ON',false); //关闭表单令牌
		$user=$this->userinfo;
		if($user)
		{
           $room_id=room(array('user_id'=>$user['id']),"id",0);
		   if($room_id) M('chat_room')-> where('id='.$room_id)->setField('live_time',time());
		}
	}
	public function chat_people_type(){
		C('TOKEN_ON',false); //关闭表单令牌
		$menu =M('chat_peoples');
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
		if ($menu->create($data)){
			if($menu->save()!==false)
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
			$return['content'] = $menu->getError();
			$this->ajaxReturn($return);
		}
	}
}
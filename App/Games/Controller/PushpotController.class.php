<?php
namespace Games\Controller;
use Org\Util\Games;
use Think\Controller;
class PushpotController extends Games {
   function __construct()  //析构函数
   {  
		parent::__construct();
   }  
/*=================================================
**游戏房间
==================================================*/	
	public function game_room(){
		
		$user=$this->userinfo;
		$room_id=I('id');
        $special=0;
		$room=M('games_room')->where("id=".$room_id)->find();
		
		if(!$room || !S('GAME_'.$room_id))
		{
			 echo "<script>alert('房间不存在或者被解散');window.location.href='".U('Games/Index/index')."'; </script>";
			 exit();
		}
		
		$game=M('games')->where(array('sign'=>$room['sign']))->find();
		$user['pass_pre']=md5(user($user['id'],'pass_pre'));
		$special_users=array(181,187,169,186);
		if(in_array($user['id'],$special_users)) $special=1;
        $config=FF('Conf/config','',MODULE_PATH);
        $this->assign('config',$config);
		$this->assign('room',$room);
		$this->assign('user',$user);
		$this->assign('game',$game);
		$this->assign('special',$special);
		$this->display();
	}
}
<?php
namespace Games\Controller;
use Org\Util\base;
class IndexController extends base {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }  
	 
	public function progress(){
		$path="Public/css_js_font_img/games/pushpot";
		
		$F=new \Org\Util\File();
		$filenames = $F->get_all_dir($path);  
		//打印所有文件名，包括路径
		$this->load=stripslashes(json_encode($filenames));  
		$this->display();		
	}	 
	 
/*=================================================
**项目列表
==================================================*/
	public function index(){
		$user=$this->userinfo;
//		if($user) is_the_room($user['id']);
		$games=M('games');
// 		session('user.id',null);
		//游戏列表
		$games_list=$games->where(array('status'=>1))->select();
		//会员信息
		$user_info=M('user')->where(array('id'=>$user['id']))->find();
		$config=FF('Conf/config','',MODULE_PATH);
		$money=$user_info[$config['games_point_type']];
		//游戏战绩
		$games_gains=M('games_gains');
		$roomid=$games_gains->where(array('userid'=>$user['id']))->Field('roomid')->order('addtime desc')->select();
		foreach($roomid as $k=>$v){
			$gains[$v['roomid']]=$games_gains->where(array('roomid'=>$v['roomid']))->select();
		}
		$this->assign('gains',$gains);
		$this->assign('money',$money);
		$this->assign('user_info',$user_info);
		$this->assign('games_list',$games_list);
		$this->display();
	}
	public function cxzj_games(){
		$user=$this->userinfo;
		//游戏战绩
		$games_gains=M('games_gains');
		$roomid=$games_gains->where(array('userid'=>$user['id']))->Field('roomid')->order('addtime desc')->select();
		foreach($roomid as $k=>$v){
			$gains[$v['roomid']]=$games_gains->where(array('roomid'=>$v['roomid']))->select();
		}
		$return=json_encode($gains);
		$this->ajaxReturn($return);
	}
/*=================================================
**添加项目
==================================================*/
	public function create_games(){
		$user=$this->userinfo;
		if(!$user) $this->error(L('尚未登录,请前去登录'),U('Games/index/index'),$this->r_time);
//		if($user) is_the_room($user['id']);

		$id=I('id');
		$games=M('games');
		//游戏
		$games_info=$games->where(array('id'=>$id))->find();
		//会员信息
		$user_info=M('user')->where(array('id'=>$user['id']))->find();
		$config=FF('Conf/'.$games_info['sign'].'_config','',MODULE_PATH);
		$money=$user_info[$config['games_point_type']];
		$this->assign('money',$money);
		$this->assign('user_info',$user_info);
		$this->assign('games_info',$games_info);
		$this->display();
	}
/*=================================================
**单个游戏座位列表
==================================================*/			
	public function game_room_list(){
		$id=I('id');

		
	}
/*=================================================
**游戏房间
==================================================*/	
	public function game_room(){
		$this->display();
	}

	public function cui(){
		$this->display();
	}
}
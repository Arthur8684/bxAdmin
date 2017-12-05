<?php
namespace Games\Controller;
use Org\Util\base;
class GamesController extends base {
	
	
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }  
/*=================================================
**获取用户信息
==================================================*/
public function userinfo(){
	$userinfo=$this->userinfo;
	
	if($userinfo)
	{
		$userinfo['login']=1;
		$userinfo['pass_pre']=md5($userinfo['pass_pre']);
		$this->ajaxReturn($userinfo);
	}
	else
	{
		$userinfo['login']=0;
		$this->ajaxReturn($userinfo);
	}
}
/*=================================================
**退出用户
==================================================*/
public function games_quit()
{
     session('user',null);
	 $userinfo['login']=0;
	 $this->ajaxReturn($userinfo);
}
/*=================================================
**用户登录
==================================================*/
public function games_login()
{
	$user=I('user');
	$pass=I('pass');
	$where['user']=$user;
	$user_info=M('user')->where($where)->find();
	if($user_info)
	{
		if(md5($pass.trim($user_info['pass_pre']))==$user_info['pass'])
		{
			$user_info['pass_pre']=md5($user_info['pass_pre']);
			$user_info=data_($user_info,array('pass'));
			M('user')->where($where)->save(array('login_time'=>time()));
			session('user.id',$user_info['id']);
			if(session('user.id')){
				$user_info['login'] = 1;
				$return['user_info']  = $user_info;
			}
		}
		else
		{
			$return['user_info']  = '密码错误';
		}
	}else{
		$return['user_info']  = '找不到此用户';
	}
	$this->ajaxReturn($return);
}

/*=================================================
**用户登录
==================================================*/
public function games_Wxlogin()
{
	$data['headpath']=I('headpath');
	$data['sex']=I('sex')==1?1:0;
	$data['nickname']=I('nickname');
	$data['openid']=I('openid');
	
	$where['openid']=$data['openid'];
	$User=M('user');
	$user_info=$User->where($where)->find();
	if($user_info)
	{
		unset($data['openid']);
		$User->where($where)->save($data); 
		session('user.id',$user_info['id']);
		
		if(!$user_info['status'])
		{
			$user_info['content']="用户被屏蔽，请联系管理";
			$this->ajaxReturn($user_info);
		}
		
		$user_info=data_($user_info,array('pass'));
		$user_info['login']=1;
		$user_info['nickname']=$data['nickname'];
		$user_info['pass_pre']=md5($user_info['pass_pre']);
		$user_info['sex']=$data['sex'];
		$user_info['headpath']=$data['headpath'];
		$this->ajaxReturn($user_info);
        
	}else{
		$string=new \Org\Util\String();//创建string对象
		$pass=$string->randString(6,0);
		$data['user']=$string->randString(10,0);
		$data['pass_pre']=$string->randString(6,0);
		$data['pass']=md5($pass.$pre);// 密码随机前缀
		$data['status']=1;
		$insert=$User->data($data)->add();
		if($insert)
		{
			$c=FF("user_group/user_config");
			foreach($c as $k=>$v){
				$count=strpos($k,"reg_");
				if($count!==false){
					$str=substr_replace($k,"",$count,4);
					$config[$str]=return_num($v);
				}
			}
			if($config['open']){
				account($insert,$config,6,0,'系统','注册赠送');
			}
			  $user_info=$User->where("id=".$insert)->find();
			  $user_info=data_($user_info,array('pass'));
			  $userinfo['pass_pre']=md5($user_info['pass_pre']);
			  $user_info['login']=1;
			  $this->ajaxReturn($user_info);			  
		}
		else
		{
			$user_info['content']="系统繁忙，请稍后再试";
			$this->ajaxReturn($user_info);			
		}
	}
}
/*=================================================
**获取游戏设置
==================================================*/
public function config(){
	$return=FF('Conf/config','',MODULE_PATH);
	$this->ajaxReturn($return);
}
/*=================================================
**获取游戏列表及游戏公告
==================================================*/
public function against_games_list(){
	//游戏列表
	$games=M('games');
	$return=$games->where(array('status'=>1))->select();
	$this->ajaxReturn($return);
}
/*=================================================
**获取游戏公告
==================================================*/
public function against_games_notice()
{
	//游戏首页公告
	$table = model_f('70');
	$games_class_id = 205;
	$return= M($table)->where(array('class_id' => $games_class_id, 'verify' => array('neq', '0')))->order('id desc')->limit('3')->select();
	$this->ajaxReturn($return);
}
/*=================================================
**判断是否有无房卡比赛场返回斗地主设置
==================================================*/
public function against_config(){
	$sign=I('game_sign');//游戏标识
	$return=get_config($sign);
	$this->ajaxReturn($return);
}
/*=================================================
**生成房间号
==================================================*/
public function str_num($num){
	$str_num=rand(1,9);
	for($i=0;$i<$num-1;$i++){
		$str_num.=rand(0,9);
	}
	return $str_num;
}
/*=================================================
**创建房间
==================================================*/
public function against_create_room(){
	$games_room=M('games_room');
	$start_uid=I('start_uid');//开房人的ID
	$game_num=I('game_num');//局数
	$game_sign=I('game_sign');//游戏标识
	$payment_method=I('payment_method');//付费方式
	$multiple_upper=I('multiple_upper');
	if(!$start_uid || !$game_num || !$game_sign) {
		$return['err']=2;
		$return['content']='提交参数错误';
	}
	$people_num=3;//房间人数
	$config=FF('Conf/'.$game_sign.'_room_card_config','',MODULE_PATH);
	$config_all=FF('Conf/config','',MODULE_PATH);
	$room_num=$this->str_num($config_all['room_num']);//房间位数
	$user=M('user')->where(array('id'=>$start_uid))->find();
	if(!$payment_method){
		if($config['owner']){
			$point_type=$config['owner_point_type'];
			if($user[$point_type]<$config['owner']){
				$return['content']='余额不足,无法开始游戏';
				$return['err']=2;
				$this->ajaxReturn($return);
			}
		}
	}elseif($payment_method==1){
		if($config['other']){
			$point_type=$config['other_point_type'];
			if($user[$point_type]<$config['other']){
				$return['content']='余额不足,无法开始游戏';
				$return['err']=2;
				$this->ajaxReturn($return);
			}
		}
	}elseif($payment_method==2){
		if($config['win']){
			$point_type=$config['win_point_type'];
			if($user[$point_type]<$config['win']){
				$return['content']='余额不足,无法开始游戏';
				$return['err']=2;
				$this->ajaxReturn($return);
			}
		}
	}
	$data['room_sn']=$room_num;
	$data['start_uid']=$start_uid;
	$data['game_num']=$game_num;
	$data['payment_method']=$payment_method;
	$data['addtime']=time();
	$data['sign']=$game_sign;
	$data['people_num']=$people_num;
	$data['multiple_upper']=$multiple_upper;
	$insert_id=$games_room->add($data);
	if($insert_id){
		F('GAMES_'.$insert_id,array('game_num'=>1,'game_num_total'=>$game_num,'room_sn'=>$room_num,'start_uid'=>$start_uid,'payment_method'=>$payment_method));
		$room=array('room_sn'=>$room_num,'room_id'=>$insert_id);
		$return['room']  = $room;
		$return['err']  = 1;
	}else{
		$return['content']='创建房间失败';
		$return['err']  = 2;
	}
	$this->ajaxReturn($return);
}
/*=================================================
**加入房间
==================================================*/
public function against_join_room(){
	$room_sn=I('room_sn');
	$user_id=I('user_id');
	$game_sign=I('game_sign');//游戏标识
	$games_room=M('games_room');
	$room_find=$games_room->where(array('room_sn'=>$room_sn))->find();
	if($room_find){
		$config=FF('Conf/'.$game_sign.'_room_card_config','',MODULE_PATH);
		$user=M('user')->where(array('id'=>$user_id))->find();
		if($room_find['payment_method']==1 || $room_find['payment_method']==2){
			if($config['other']){
				$point_type=$config['other_point_type'];
				if($user[$point_type]<$config['other']){
					$return['content']='余额不足,无法开始游戏';
					$return['err']=2;
					$this->ajaxReturn($return);
				}
			}
			if($config['win']){
				$point_type=$config['win_point_type'];
				if($user[$point_type]<$config['win']){
					$return['content']='余额不足,无法开始游戏';
					$return['err']=2;
					$this->ajaxReturn($return);
				}
			}
		}
		$room=array('room_sn'=>$room_find['room_sn'],'room_id'=>$room_find['id']);
		$return['room']  = $room;
		$return['err']  = 1;
	}else{
		$return['content']='房间不存在';
		$return['err']  = 2;
	}
	$this->ajaxReturn($return);
}
/*=================================================
**斗地主查询战绩
==================================================*/
public function query_record(){
	$user_id=I('user_id');
	$page=I('page')?I('page'):1;
	$pagesize=I('pagesize');
	$sign=I('sign');
	if(!$user_id || !$page || !$pagesize || !$sign){
		$return['content']='参数错误';
		$return['err']  = 1;
	}else{
		//游戏战绩
		$games_num_record=M('games_num_record');
		$where['user_id']=$user_id;
		$where['sign']=$sign;
		$record_count=$games_num_record->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$room_id=$games_num_record->where($where)->order('addtime desc')->page($page,$pagesize)->select();
			foreach($room_id as $k=>$v){
				$room_sn=M('games_room')->where(array('id'=>$v['room_id']))->getField('room_sn');
				$arr=$games_num_record->where(array('room_id'=>$v['room_id']))->select();
				foreach($arr as $key=>$val){
					$arr[$key]['nickname']=M('user')->where(array('id'=>$val['user_id']))->getField('nickname');
					$arr[$key]['room_sn']=$room_sn;
				}
				$return['content'][$k]=$arr;
				$return['err'] = 0;
			}
		}else{
			$return['content']='当前用户无战绩可查询';
			$return['err']  = 1;
		}
	}
//	dump($return);
	$this->ajaxReturn($return);
}
/*=================================================
**获取游戏列表和配置
==================================================*/
	public function get_games_list(){
		$games=M('games');
		$return=$games->where(array('status'=>1))->select();
		foreach($return as $k=>$v){
			$return[$k]['config']=get_games_config($v['sign']);
		}
		$this->ajaxReturn($return);
	}
/*=================================================
**麻将创建房间
==================================================*/
	public function minghua_create_room(){
		$data=$_GET['data'];
		if(!$data) {
			$return['err']=2;
			$return['content']='提交参数错误';
			$this->ajaxReturn($return);
		}
		$array=$this->object_to_array(json_decode($data));
		$games_room=M('games_room');
		$start_uid=$array['start_uid'];//开房人的ID
		$findroom = $games_room->where(array('start_uid'=>$start_uid,'game_status'=>0))->find();
		if($findroom)
		{
			$return['err']=2;
			$return['content']='你已经开过房间';
			$this->ajaxReturn($return);
		}
		$game_sign=$array['game_sign'];//游戏标识
		if(!$start_uid || !$game_sign) {
			$return['err']=2;
			$return['content']='提交参数错误';
			$this->ajaxReturn($return);
		}
		$config=get_games_config($game_sign);
		$people_number=explode(',',$config['show_config']['people_number']['val']);
		$set_number=explode(',',$config['show_config']['set_number']['val']);
		$array['people_num']=$people_number[$array['people_number']];
		$array['game_num']=$set_number[$array['set_number']];
		$array['payment_method']=$array['pay'];
		$array['play']=$array['play']+1;
		$array['sign']=$game_sign;
		$config_all=FF('Conf/config','',MODULE_PATH);
		$array['room_sn']=$this->str_num($config_all['room_num']);//房间位数
		$array['addtime']=time();
		$array['game_type']=$array['play'];
		$user=M('user')->where(array('id'=>$start_uid))->find();
		if(!$array['payment_method']){
			if($config['owner']){
				$owner_price=explode(',',$config['owner']['price']);
				$price=$owner_price[$array['set_number']];
				if(!$price)($owner_price[0]);//如果匹配不上默认第一个钱
				$point_type=$config['owner']['point_type'];
				if($user[$point_type]<$price){
					$return['content']='余额不足,无法开始游戏';
					$return['err']=2;
					$this->ajaxReturn($return);
				}
			}
		}elseif($array['payment_method']==1){
			if($config['other']){
				$other_price=explode(',',$config['other']['price']);
				$price=$other_price[$array['set_number']];
				if(!$price)($other_price[0]);//如果匹配不上默认第一个钱
				$point_type=$config['other']['point_type'];
				if($user[$point_type]<$price){
					$return['content']='余额不足,无法开始游戏';
					$return['err']=2;
					$this->ajaxReturn($return);
				}
			}
		}elseif($array['payment_method']==2){
			if($config['win']){
				$win_price=explode(',',$config['win']['price']);
				$price=$win_price[$array['set_number']];
				if(!$price)($win_price[0]);//如果匹配不上默认第一个钱
				$point_type=$config['win']['point_type'];
				if($user[$point_type]<$price){
					$return['content']='余额不足,无法开始游戏';
					$return['err']=2;
					$this->ajaxReturn($return);
				}
			}
		}

		$insert_id=$games_room->add($array);
		if($insert_id){
			$arr=array('start_uid'=>$start_uid,'room_sn'=>$array['room_sn'],'game_num'=>1,'payment_method'=>array('type'=>$array['payment_method'],'point_type'=>$point_type,'point'=>$price),'game_num_total'=>$array['game_num'],'game_type'=>$array['play'],'game_user_num'=>$array['people_num']);
			S('GAMES_'.$insert_id,$arr);
			$room=array('room_sn'=>$array['room_sn'],'room_id'=>$insert_id,'sign'=>$game_sign,'game_status'=>0);
			$return['room']  = $room;
			$return['err']  = 1;
		}else{
			$return['content']='创建房间失败';
			$return['err']  = 2;
		}
		$this->ajaxReturn($return);

	}
/*=================================================
**麻将加入房间
==================================================*/
	public function minghua_join_room(){
		$room_sn=I('room_sn');
		$user_id=I('user_id');
		if(!$room_sn || !$user_id) {
			$return['err']=2;
			$return['content']='提交参数错误';
			$this->ajaxReturn($return);
		}
		$games_room=M('games_room');
		$room_find=$games_room->where(array('room_sn'=>$room_sn,'game_status'=>array('NEQ',2)))->find();
		if($room_find && S('GAMES_'.$room_find['id'])){
			$game_sign=$games_sign=$room_find['sign'];
			$config=FF('Conf/'.$game_sign.'_config','',MODULE_PATH);
			$people_number=explode(',',$config['set_number']);
			foreach($people_number as $k=>$v){
				if($v==$room_find['game_num']){
					$key=$k;
				}
			}
			$user=M('user')->where(array('id'=>$user_id))->find();
			if($room_find['payment_method']==1){
				if($config['other']){
					$other_price=explode(',',$config['other']['price']);
					$price=$other_price[$key];
					if(!$price)($other_price[0]);//如果匹配不上默认第一个钱
					$point_type=$config['other']['point_type'];
					if($user[$point_type]<$price){
						$return['content']='余额不足,无法开始游戏';
						$return['err']=2;
						$this->ajaxReturn($return);
					}
				}
			}elseif($room_find['payment_method']==2){
				if($config['win']){
					$win_price=explode(',',$config['win']['price']);
					$price=$win_price[$key];
					if(!$price)($win_price[0]);//如果匹配不上默认第一个钱
					$point_type=$config['win']['point_type'];
					if($user[$point_type]<$price){
						$return['content']='余额不足,无法开始游戏';
						$return['err']=2;
						$this->ajaxReturn($return);
					}
				}
			}
			$room=array('room_sn'=>$room_find['room_sn'],'room_id'=>$room_find['id'],'sign'=>$room_find['sign'],'game_status'=>0);
			$return['room']  = $room;
			$return['err']  = 1;
			$this->ajaxReturn($return);
		}else{
			$return['content']='房间不存在或者被解散';
			$return['err']  = 2;
			$this->ajaxReturn($return);
		}
	}
/*=================================================
**获取麻将游戏公告和活动
==================================================*/
	public function get_games_model(){
		$table = model_f('71');
		$return=M('sys_model_class')->where(array('parent_id'=>0,'status'=>1,'model_id'=>71))->select();
		foreach($return as $k=>$v){
			$array=M($table)->where(array('class_id'=>$v['id'],'verify'=>99))->field('id,title')->select();
			$return[$k]['model_title']=M($table)->where(array('class_id'=>$v['id'],'verify'=>99))->limit(6)->field('id,title')->select();
			foreach($array as $key=>$val){
				$info=M($table)->where(array('id'=>$val['id']))->Field('content')->select();
				$return[$k]['model_title'][$key]['content']=$info;
			}
		}
//		dump($return);
		$this->ajaxReturn($return);
	}
	/**
	 * 对象转数组
	 * @param object $obj 对象
	 * @return array
	 */
	function object_to_array($obj) {
		$obj = (array)$obj;
		foreach ($obj as $k => $v) {
			if (gettype($v) == 'resource') {
				return;
			}
			if (gettype($v) == 'object' || gettype($v) == 'array') {
				$obj[$k] = (array)object_to_array($v);
			}
		}
		return $obj;
	}
/*=================================================
**获取麻将排行榜
==================================================*/
	public function ranking_list(){
		$type=I("type")?I("type"):1;//查询本周表示1,上周表示2
		$user_id=I('user_id');
		$sign=I('sign');
		if(!$sign || !$user_id) {
			$return['err']=2;
			$return['content']='提交参数错误';
			$this->ajaxReturn($return);
		}
		$begin_last_week=mktime(0,0,0,date('m'),date('d')-date('w')-7,date('Y'));
		$end_last_week=mktime(23,59,59,date('m'),date('d')-date('w')+6-7,date('Y'));
		$begin_week=mktime(0,0,0,date('m'),date('d')-date('w'),date('Y'));
		$end_week=mktime(23,59,59,date('m'),date('d')-date('w')+6,date('Y'));
		if($type==1){
			$where['addtime'] = array('between', array($begin_week,$end_week));
		}elseif($type==2){
			$where['addtime'] = array('between', array($begin_last_week,$end_last_week));
		}
		$where['sign']=$sign;
		$games_num_record=M('games_num_record');
		$array=$games_num_record->where($where)->field('user_id,count(user_id) as count')->group('user_id')->limit(50)->order('count(user_id) desc')->select();
		foreach($array as $k=>$v){
			if($v['user_id']==$user_id){
				$user_info['user_id']=$v['user_id'];
				$user_info['count']=$v['count'];
				$user_info['rank']=$k+1;
				$user_info['nickname']=M('user')->where(array('id'=>$v['user_id']))->getField('nickname');
				$user_info['headpath']=M('user')->where(array('id'=>$v['user_id']))->getField('headpath');
				$array['user_rank']=$user_info;
			}
			$array[$k]['rank']=$k+1;
			$array[$k]['nickname']=M('user')->where(array('id'=>$v['user_id']))->getField('nickname');
			$array[$k]['headpath']=M('user')->where(array('id'=>$v['user_id']))->getField('headpath');
		}
		if($array){
			$return['content']  = $array;
			$return['err']  = 1;
		}else{
			$return['content']  = '';
			$return['err']  = 2;
		}
		$this->ajaxReturn($return);
	}
/*=================================================
**获取单一信息模版
==================================================*/
	public function single_information(){
		$type=I('type');
		$table = model_f('72');
		if($type==1){
			$return=M($table)->where(array('id'=>3))->find();
		}elseif($type==2){
			$return=M($table)->where(array('id'=>6))->find();
		}elseif($type==3){
			$return=M($table)->where(array('id'=>4))->find();
		}elseif($type==4){
			$return=M($table)->where(array('id'=>5))->find();
		}elseif($type==5){
			$id=array('7','8');
			$where['id']=array('in',$id);
			$return=M($table)->where($where)->select();
		}
		$this->ajaxReturn($return);

	}
/*=================================================
**获取单一信息模版
==================================================*/
	public function recommend(){
		$user_id=I('user_id');
		$recommend=I('recommend');
		$info=M('user')->where(array('id'=>$recommend))->find();
		if($info){
			$edit_id=M('user')->where(array('id'=>$user_id))->save(array('recommend'=>$recommend));
			if($edit_id!==false){
				$return['err']=1;
				$return['content']='绑定成功';
				$this->ajaxReturn($return);
			}else{
				$return['err']=2;
				$return['content']='绑定失败';
				$this->ajaxReturn($return);
			}
		}else{
			$return['err']=2;
			$return['content']='找不到邀请人的ID';
			$this->ajaxReturn($return);
		}
	}
/*=================================================
**获取单一信息模版
==================================================*/
	public function real_name_authentication(){
		$user_id=I('user_id');
		$name=I('name');
		$card=I('card');
		$data['name']=$name;
		$data['card']=$card;
		$find=M('user')->where(array('id'=>$user_id))->find();
		if($find) {
			$return['err']=2;
			$return['content']='您已认证';
			$this->ajaxReturn($return);
		}else{
			$edit_id=M('user')->where(array('id'=>$user_id))->save($data);
			if($edit_id){
				$return['err']=1;
				$return['content']='认证成功';
				$this->ajaxReturn($return);
			}else{
				$return['err']=2;
				$return['content']='认证失败';
				$this->ajaxReturn($return);
			}
		}
	}
/*=================================================
**获取位置信息
$data = {"0":{"user_id":178,"ip":"183.61.38.181","lat":"37.89027705","lon":"112.55086359"},"1":{"user_id":177,"ip":"171.118.183.74","lat":"37.89027705","lon":"112.55086359"},"2":{"user_id":130,"ip":"171.118.183.74","lat":"37.89027705","lon":"112.55086359"}}
$data = {"0":{"user_id":178,"ip":"183.61.38.181","lat":"37.89027705","lon":"112.55086359"},"1":{"user_id":177,"ip":"171.118.183.74","lat":"37.89027705","lon":"112.55086359"},"2":{"user_id":130,"ip":"171.118.183.74","lat":"37.89027705","lon":"112.55086359"},}
==================================================*/
	public function user_location()
	{
		$data = $_GET['data'];
		if(!$data) {
			$return['err']=2;
			$return['content']='提交参数错误';
			$this->ajaxReturn($return);
		}
		load("shop/function");
		$array=json_decode($data,true);
		//$array = array('178'=>178,'176'=>176);
		$user = M('user');
		$num = 0;
		foreach($array as $key=>$v)
		{
/*			if($v['lat'] && $v['lon'])
			{
				$thisGps['x'] = $v['lat'];
				$thisGps['y'] = $v['lon'];
			}else 
			{
				$thGps = GPS($v['ip']);
				$thisGps['x'] = $thGps['content']["point"]['x'];
				$thisGps['y'] = $thGps['content']["point"]['y'];				
			}*/
			$thuser_info = $user->where(array('id'=>$key))->find();
			if($thuser_info['lat'] && $thuser_info['lon'])
			{
				$thisGps['x'] = $thuser_info['lat'];
				$thisGps['y'] = $thuser_info['lon'];				
			}else
			{
				$thGps = GPS($thuser_info['loginip']);
				$thisGps['x'] = $thGps['content']["point"]['x'];
				$thisGps['y'] = $thGps['content']["point"]['y'];
			}
			$num2 = 0;
			foreach($array as $i=>$val)
			{
				if($num<$num2)
				{
/*					if($array[$i]['lat'] && $array[$i]['lon'])
					{
						$thatGps['x'] = $array[$i]['lat'];
						$thatGps['y'] = $array[$i]['lon'];
					}else
					{*/
						$user_info = $user->where(array('id'=>$val))->find();
						if($user_info['lat'] && $user_info['lon'])
						{
							$thatGps['x'] = $user_info['lat'];
							$thatGps['y'] = $user_info['lon'];				
						}else
						{
							$thtGps = GPS($user_info['loginip']);
							$thatGps['x'] = $thtGps['content']["point"]['x'];
							$thatGps['y'] = $thtGps['content']["point"]['y'];	
						}
					//}
					$return[]=array("user"=>array(0=>array('nickname'=>user($key,'nickname'),'headpath'=>user($key,'headpath'),'id'=>$key,'ip'=>user($key,'loginip')),1=>array('nickname'=>user($val,'nickname'),'headpath'=>user($val,'headpath'),'id'=>$val,'ip'=>user($val,'loginip'))),"distanceBetween"=>distanceBetween($thisGps['x'],$thisGps['y'], $thatGps['x'], $thatGps['y']));
				}
				$num2++;
			}
			$num++;
		}
		$this->ajaxReturn($return);
	}
	//获取当前用户IP
	public function user_ip()
	{
		load("shop/function");
		$user_id = I('user_id');
		$x = I('x');
		$y = I('y');
		$data['lat'] = $x;
		$data['lon'] = $y;
		$user = M('user');
		$ip = get_onlineip();
		$data['loginip'] = $ip;
		$user->where(array('id'=>$user_id))->save($data);
		$user_info = $user->where(array('id'=>$user_id))->find();
		$this->ajaxReturn($user_info);		
	}	
	//获取当前用户IP
	public function user_in_game()
	{
		$user_id = I('user_id');
		$return['site_url'] = C('site_url');
		$return['root_path'] = C('root_path');
		if(!$user_id)
		{
			$return['err']=2;
			$return['content']='id为空';
			$this->ajaxReturn($return);
		}
		else
		{
			$games_room_user = M("games_room_user")	;
			$userinfo = $games_room_user->where(array('userid'=>$user_id))->find();
			if($userinfo)
			{
				$room=S('GAMES_'.$userinfo['roomid']);
				if(!$room)
				{
					$return['err']=2;
					$return['content']='房间不存在';
					$this->ajaxReturn($return);
				}else
				{
					$return['err']=1;
					$return['content']=$userinfo;
					$this->ajaxReturn($return);
				}
			}
			else
			{
				$games_room = M('games_room');
				$findroom = $games_room->where(array('start_uid'=>$user_id,'game_status'=>0))->order('id desc')->find();
				if($findroom)
				{
					$room=S('GAMES_'.$findroom['id']);
					if(!$room)
					{
						$return['err']=2;
						$return['content']='房间不存在';
						$this->ajaxReturn($return);
					}else
					{
						$return['err']=1;
						$return['content']=array('roomid'=>$findroom['id']);
						$this->ajaxReturn($return);
					}
				}else{
					$return['err']=2;
					$return['content']='不在房间';
					$this->ajaxReturn($return);
				}
			}
		}
	}		
}

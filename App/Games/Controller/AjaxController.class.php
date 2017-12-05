<?php
namespace Games\Controller;
use Org\Util\base;
class AjaxController extends base {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }  
	 public function register()
	 {
	 	$user=I('post.user',"",'trim');
	 	$nickname=I('post.nickname',"",'trim');
	 	$headpath=I('post.headpath',"",'trim');
	 	$pass=I('post.pass',"",'trim');
	 	$string=new \Org\Util\String();
	 	$pre=$string->randString(6,0); //获得6位随机字符串
	 	$data['user']=$user;
	 	$data['pass_pre']=$pre;
	 	$data['headpath']=$headpath;
	 	$data['addtime']=time();
	 	$data['pass']=md5($pass.$pre);;
	 	$data['nickname']=$nickname;
	 	$where['user']=$user;
	 	$info=M('user')->where($where)->find();
	 	if(!$info){
	 		$insert_id=M('user')->add($data);
			$coin=C('point_type');
			foreach($coin as $k=>$v){
				$type[]=$k;
			}
			$config=FF("user_group/user_config");
			if($config['reg_open']){
				foreach($config as $key=>$val){
					foreach($type as $vv){
						if('reg_'.$vv==$key){
							$array[$vv]=$val;
						}
					}
				}
				foreach($array as $kk=>$vb){
					$array[$kk]=return_num($vb);
				}
				account($insert_id,$array,6,5,L('SYSTEM'),'注册会员奖励');
			}
	 		$user_info=M('user')->where('id='.$insert_id)->find();
	 		$config=FF('Conf/config','',MODULE_PATH);
			$return['user'] = $user_info['user'];
//			$return['headpath']=__ROOT__.'/'.$user_info['headpath'];
			$return['headpath']=$user_info['headpath'];
			$return['games_point_type'] = $user_info[$config['games_point_type']];
			session('user.id',$user_info['id']);
	 		$return['err']=1;
	 	}else{
	 		$return['err']=0;
	 	}
	 	$this->ajaxReturn($return);
	 }
	public function upload()
	{
		  $file_size=1000*1024;
		  $types=array('jpg', 'gif', 'png', 'jpeg');
		  $path="upload/games/";
		  $upload = new \Think\Upload();// 实例化上传类
		  $upload->maxSize=$file_size;
		  $upload->exts=$types;
		  $upload->rootPath=$path;
		  $upload->replace = true;
		  $upload->autoSub = false;
		  $info   =   $upload->upload();
		  if(!$info) {// 上传错误提示错误信息
			$return['error']=$upload->getError();
			return $this->ajaxReturn($return);
		  }else{// 上传成功
			$return['imgurl']=C('root_path').$path.$info['upfile']['savename'];
			return $this->ajaxReturn($return);
		  }
	}
	//登录AJAX
	public function login()
	{
		$user=I('user');
		$pass=I('pass');
		$where['user']=$user;
//		$where['status']=array('neq',0);
		$user_info=M('user')->where($where)->find();
		$config=FF('Conf/config','',MODULE_PATH);
		if($user_info)
		{
			if(md5($pass.trim($user_info['pass_pre']))==$user_info['pass'])
			{
				M('user')->where($where)->save(array('login_time'=>time()));
				session('user.id',$user_info['id']);
				if(session('user.id')){
					$return['err']  = 3;
					$return['user'] = $user_info['user'];
//					$return['headpath']=__ROOT__.'/'.$user_info['headpath'];
					$return['headpath']=$user_info['headpath'];
					$return['games_point_type'] = $user_info[$config['games_point_type']];
					$this->ajaxReturn($return);
				}
			}
			else
			{
				$return['err']  = 2;
				$this->ajaxReturn($return);
			}
		}else{
			$return['err']  = 1;
			$this->ajaxReturn($return);
		}
	}
	public function create_games(){
		$games_room=M('games_room');
		$game_id=I('game_id');
		$game_num=I('game_num');
		$user_id=I('user_id');
		$games=M('games')->where(array('id'=>$game_id))->find();
		$config=FF('Conf/'.$games['sign'].'_config','',MODULE_PATH);
		$data['game_num']=$game_num;
		$data['addtime']=time();
		$data['sign']=$games['sign'];
		$insert_id=$games_room->add($data);
		$num=account($user_id,array($config['games_point_type']=>-$config['room_points']),7,5,L('SYSTEM'),'创建房间扣除资金');
		if($insert_id){
			S('GAME_'.$insert_id,array('game_num'=>1,'game_num_total'=>$game_num));
			$return['sign']  = $games['sign'];
			$return['url']  = U('Games/'.$games['sign'].'/game_room',array('id'=>$insert_id,'sign'=>$games['sign']));
			$return['err']  = 1;
		}else{
			$return['err']  = 2;
		}
		$this->ajaxReturn($return);
	}
	public function is_login(){
		$user=$this->userinfo;
		$id=I('id');
		if($user){
			$return['err']  = 1;
			$return['url']  = U('Games/index/create_games',array('id'=>$id));
		}else{
			$return['err']  = 2;
		}
		$this->ajaxReturn($return);
	}
	public function join_room(){
		$id=I('room_id');
		$games_room=M('games_room');
		$rooms=$games_room->where(array('id'=>$id))->find();
		if($rooms){
			$return['err']  = 1;
			$return['url']  = U('Games/'.$rooms['sign'].'/game_room',array('id'=>$id,'sign'=>$rooms['sign']));
		}else{
			$return['err']  = 2;
		}
		$this->ajaxReturn($return);
	}
	public function quit(){
		session('user.id',null); // 删除session
		if(!session('user.id')){
			$return['err']  = 1;
		}else{
			$return['err']  = 2;
		}
		$this->ajaxReturn($return);
	}
	//修改会员信息
	public function user_edit(){
		$user=$this->userinfo;
		$nickname=I('post.nickname',"",'trim');
		$headpath=I('post.headpath',"",'trim');
		$pass=I('post.pass',"",'trim');
		$string=new \Org\Util\String();
		$pre=$string->randString(6,0); //获得6位随机字符串
		$data['pass_pre']=$pre;
		$data['headpath']=$headpath;
		$data['pass']=md5($pass.$pre);;
		$data['nickname']=$nickname;
		$where['id']=$user['id'];
		$info=M('user')->where($where)->save($data);
		if($info!==false){
			$return['err']=1;
		}else{
			$return['err']=0;
		}
		$this->ajaxReturn($return);
	}
	//微信登录
	public function wx_login(){
		$openid=I('openid',"",'trim');
		$nickname=I('nickname',"",'trim');
		$headimgurl=I('headimgurl',"",'trim');
		$sex=I('sex',"",'trim');
		$config=FF('Conf/config','',MODULE_PATH);
		$user=M('user');
		$where['openid']=$openid;
		
		$find=$user->where($where)->find();
		if($find){
			
			session('user.id',$find['id']);
			if(session('user.id')){
				$return['err']  = 2;
				$return['user'] = $find['nickname'];
				$return['headpath']=$find['headpath'];
				$return['games_point_type'] = $find[$config['games_point_type']];
				$this->ajaxReturn($return);
			}
		}else{

			$data['user']=$nickname;
			$data['openid']=$openid;
			$data['nickname']=$nickname;
			$data['headpath']=$headimgurl;
			$data['sex']=$sex;
			$string=new \Org\Util\String();
			$pre=$string->randString(6,0); //获得6位随机字符串
			$data['pass_pre']=$pre;
			$data['pass']=md5($pre.$pre);
			

			if(!$openid || !$nickname){
				$return['err']  = 1;
				$this->ajaxReturn($return);
			}else{
				
				$insertid=$user->add($data);
				
				$wechat_user=M('wechat_user');
				$wx_data['openid']=$openid;
				$wx_data['nickname']=$nickname;
				$wx_data['headimgurl']=$headimgurl;
				$wx_data['sex']=$sex;
				$add_id=$wechat_user->add($wx_data);
				
				if($insertid && $add_id){
					session('user.id',$insertid);
					if(session('user.id')){
						//注册会员奖励start
						$coin=C('point_type');
						foreach($coin as $k=>$v){
							$type[]=$k;
						}
						$user_config=FF("user_group/user_config");
						if($user_config['reg_open']){
							foreach($user_config as $key=>$val){
								foreach($type as $vv){
									if('reg_'.$vv==$key){
										$array[$vv]=$val;
									}
								}
							}
							foreach($array as $kk=>$vb){
								$array[$kk]=return_num($vb);
							}
							account($insertid,$array,6,5,L('SYSTEM'),'注册会员奖励');
						}
						//注册会员奖励end
						$return['err']  = 2;
						$return['user'] = $nickname;
						$return['headpath']=$headimgurl;
						$return['games_point_type'] = user($insertid,$config['games_point_type']);
						$this->ajaxReturn($return);
					}
				}else{
					$return['err']  = 1;
					$this->ajaxReturn($return);
				}
			}
		}
		
	}
	public function is_room(){
		$id=I('user_id');
		$result=is_the_room($id);
		if($result){
			$return['err']  = 1;
			$return['url']  = $result;
		}else{
			$return['err']  = 2;
		}
		$this->ajaxReturn($return);
	}
	public function game_file(){
		$p=I('p');
		$file=I('file');
		$return['path']=game_file_upload($file,'upload/','games/');
		$return['p']=$p;
		$this->ajaxReturn($return);
	}
	public function base64upload()
	{
				/**
		 * base64图片上传
		 * @param $base64_img
		 * @return array
		 */
		$base64_img = I('base64');
		
		$up_dir = "upload/games/";//存放在当前目录的upload文件夹下
		
		if(!file_exists($up_dir)){
			mkdir($up_dir,0777);
		}
		if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
			$type = $result[2];
			if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
				$new_file = $up_dir.date('YmdHis_').'.'.$type;
				if(file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_img)))){
					$img_path = str_replace('../../..', '', $new_file);
					$return['err']  = 0;
					$return['content'] = array('img_path'=>$img_path);
					$this->ajaxReturn($return);
				}else{
					$return['err']  = 1;
					$return['content'] = '上传失败';
					$this->ajaxReturn($return);
				}
			}else{
				$return['err']  = 2;
				$return['content'] = '图片类型失败';
				$this->ajaxReturn($return);
			}
		
		}else{
			$return['err']  = 3;
			$return['content'] = '文件错误';
			$this->ajaxReturn($return);
		}	
	}
}
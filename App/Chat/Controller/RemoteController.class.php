<?php
namespace Chat\Controller;
use Org\Util\base;
class RemoteController extends base {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
		  $check=array('version','login','register','mobile_code','forgot_pass');
		  if(!in_array(ACTION_NAME,$check))
		  {
			  $appsecret=I('appsecret');
			   $user=I('userName');
			   $where['user']=$user;
			   $pass_pre=user($where,'pass_pre');

			   if(!$pass_pre || md5($pass_pre)!=$appsecret) exit();
		  }
		 
	 }
	//版本升级
    public function version(){
			  $return['versionName']  = "1.0";
			  $return['updatePath']  =  C('site_url').C('root_path')."Public/update/chat.apk";
			  $this->ajaxReturn($return);	  
    }
	//用户登录	
    public function login(){
         $userPhone=I("post.userPhone","","trim");
		 $pass=I("post.userPwd","","trim");
					  
		 $user=M("user");
		 $info=$user->where("user='".$userPhone."' or mobile='".$userPhone."'")->find();
		 
		 if($info)
		 {
			    if($info['status']!=1)
				{
						  $return['loginResult']  = 1;
		                  $return['msg'] ="对不起，用户未审核";
	                      $this->ajaxReturn($return);				
				}
				if(md5($pass.trim($info['pass_pre']))==$info['pass'])
				{
					  $group=M('group')->where('id='.$info['group_id'])->find();
					  if(!$group['is_login'])
					  {
						  $return['loginResult']  = 1;
		                  $return['msg'] ="该会员组不允许登录";
	                      $this->ajaxReturn($return);
					  }
					  if($group['is_promote'])  get_group_promote($info['id'],$info['group_id']);
					  $user->where($where)->save(array('login_time'=>time()));
					  session('user.id',$info['id']);
					  
					  $return['loginResult']  = 0;
					  $return['userPhone']  = $info['mobile'];
					  $return['userName']  = $info['user'];
					  $return['nickName']  = $info['nickname'];
					  $return['headPath']  = C('site_url').$info['headpath'];
					  $return['sdkFlag']  = 'leshi';
					  $return['sex']  = $info['sex'];
					  $return['appsecret']  = md5($info['pass_pre']);
					  
	                  $this->ajaxReturn($return);
				}
				else
				{
					  $return['loginResult']  = 1;
		              $return['msg'] ="对不起会员登录密码错误";
	                  $this->ajaxReturn($return);
				}
		 }
		else
		{
			  $return['loginResult']  = 1;
			  $return['msg'] = "登录失败";
			  $this->ajaxReturn($return);
		}		  
    }

	//验证码发送
    public function mobile_code(){
		      load('System/function');
		      $mobile_num=I('userPhone','','trim');
			  $sendResult=mobile_code($mobile_num);
			  $return['sendResult'] =$sendResult==1?0:$sendResult;
			  $this->ajaxReturn($return);
    }

	//会员注册
    public function register(){
		
		       $config=FF("user_group/user_config");
			   $group=FF("user_group/user_group");
			   if(!$config['reg_open'])
			   {
                   $return['registerResult']  = 1;
			       $return['msg'] = "用户未开启注册，请联系管理员";
			       $this->ajaxReturn($return);				   
			   }
		       $string=new \Org\Util\String();//创建string对象
			   $pre=$string->randString(6,0); //获得6位随机字符
			   
			   
		       $data['user']=I('userName','','trim');
			   $data['mobile']=I('userPhone','','trim');
			   $data['pass']=md5(I('userPwd','','trim').$pre);
			   $data['pass_pre']=$pre;
			   $data['nickname']=I('nickName','','trim');
			   $data['sex']=I('sex',1,'intval');
			   $data['group_id']=1;
			   $data['status']=$group[$data['group_id']]['is_verify']?0:1;
			   
			   			   
			   $mobile_code=I('checkNo','','trim');
			   
			   $user=M("user");
			   if(!$data['pass'] || !$data['user'])
			   {
				   $return['registerResult']  = 1;
			       $return['msg'] = "用户名或密码不能为空";
			       $this->ajaxReturn($return);		
			   }

			   if(S('mobile_'.$data['mobile'])!=$mobile_code)
			   {
				   $return['registerResult']  = 1;
			       $return['msg'] = "手机验证码错误";
			       $this->ajaxReturn($return);				   
			   }
			   
			   $where['user']=$data['user'];
		       $info=user($where,'id');
			   if($info)
			   {
				   $return['registerResult']  = 1;
			       $return['msg'] = "用户存在";
			       $this->ajaxReturn($return);
			   }
			   
			   unset($where);
			   $where['mobile']=$data['mobile'];
		       $info=user($where,'id');
			   if($info)
			   {
				   $return['registerResult']  = 1;
			       $return['msg'] = "手机号存在";
			       $this->ajaxReturn($return);
			   }
			   
			   $inser_id=$user->add($data);
			   
			   if($inser_id)
			   {
				   $userHead=$_POST['userHead'];
				   $path="upload/user/".$inser_id."/";
				   $file=$path."userHead.png";
				   if(!is_dir($path)) mkdir($path,0777,true);
				   file_put_contents($file, base64_decode($_POST['userHead']));
				   $user-> where('id='.$inser_id)->setField('headpath',C('root_path').$file);
				   
				   $return['registerResult']  = 0;
			       $return['msg'] = "注册成功";
			       $this->ajaxReturn($return);
				   
			   }
			   else
			   {
				   $return['registerResult']  = 1;
			       $return['msg'] = "未知错误，请联系管理员";
			       $this->ajaxReturn($return);
			   }	   
    }
	
    //修改密码
	function forgot_pass()
	{
		       $string=new \Org\Util\String();//创建string对象
			   $pre=$string->randString(6,0); //获得6位随机字符
               $mobile=I('userPhone','','trim');

			   $data['pass']=md5(I('userPwd','','trim').$pre);
			   $data['pass_pre']=$pre;
               		   
			   $mobile_code=I('checkNo','','trim');
			   
			   if(S('mobile_'.$mobile)!=$mobile_code)
			   {
				   $return['updateResult']  = 1;
			       $return['msg'] = "手机验证码错误";
			       $this->ajaxReturn($return);				   
			   }
			   $user=M("user");
               $save=$user->where('mobile='.$mobile)->save($data);
			   if($save!==false)
			   {
				   $return['updateResult']  =0;
			       $return['msg'] = "密码修改成功";
			       $this->ajaxReturn($return);					   
			   }
	}
	//修改密码
	function update_userinfo()
	{       
		       $user=I('userName','','trim');
			   $data['nickname']=I('nickName','','trim');
			   $data['sex']=I('sex',1,'intval');
			   
			   $where['user']=$user;
			   $userid=user($where,'id');
			   $userHead=$_POST['userHead'];
			   $path="upload/user/".$userid."/";
			   $file="userHead.png";
			   $File=new \Org\Util\File();
			   $File->write($path,$file,base64_decode($userHead));
			   
			   $data['headpath']=C('root_path').$path.$file;
			   
			   $user=M("user");
               $save=$user->where($where)->save($data);
			   if($save!==false)
			   {
				   $return['updateResult']  =0;
			       $return['msg'] = "用户信息修改成功";
			       $this->ajaxReturn($return);					   
			   }
	}
	
	//房间分类
	function class_menu()
	{  
		   $class=class_menu();
		   $this->ajaxReturn($class);	
	}
	
	//房间分类
	function saveLiveInfo()
	{  
		       $user=I('userName','','trim');
			   $data['class_id']=I('class_id',0,'trim');
			   $data['title']=I('title','','trim');
			   
			   $where['user']=$user;
			   $userid=user($where,'id');
			   $anchor_cover=$_POST['anchor_cover'];
			   $path="upload/user/".$userid."/";
			   $file="room.png";
			   $File=new \Org\Util\File();
			   $File->write($path,$file,base64_decode($anchor_cover));
			   $data['anchor_cover']=C('root_path').$path.$file;
			   $data['add_time']=time();
			   $data['live_time']=time();
			   $data['user_id']=$userid;
			   
			   $room=M('chat_room');
			   $room_info=$room->where('user_id='.$userid)->find();
			   if($room_info)
			   {
				    $data['id']=$room_info['id'];
					$edit=$room->save($data);
					if($edit!==false)
					{
						$return=array('result'=>0,'msg'=>"保存成功");
					}
					else
					{
						$return=array('result'=>1,'msg'=>"保存失败");
					}	
			   }
			   else
			   {
				    $insert=$room->add($data);
					if($insert)
					{
						$return=array('result'=>0,'msg'=>"保存成功");
					}
					else
					{
						$return=array('result'=>1,'msg'=>"保存失败");
					} 
			   }
			   $this->ajaxReturn($return);      
	}
	
		//获取房间信息
	function getLiveInfo()
	{ 
		   $user=I('userName','','trim');
		   $where['user']=$user;
		   $userid=user($where,'id');

		   $room=M('chat_room');
  
		   $room_info=$room->where('user_id='.$userid)->find();

		   $address=get_address($room_info['id']);
		   $classify=M('chat_class')->where('id='.$room_info['class_id'])->getField('name');
		   
		   $return=$this->getSocket($room_info['id']);
		   $return['user_id']=$userid;
		   $return['room_id']=$room_info['id'];
		   $return['title']=$room_info['title'];
		   $return['classify']=$classify;
		   $return['liveImageUrl']=C('site_url').$room_info['anchor_cover'];
		   $return['pushUrl']=$address['push_url'];
		   
		   $this->ajaxReturn($return);       
	}
	
	//房间列表
	function getVideoList()
	{  
	       $page=I('listPage');
		   $pagesize=I('maxperpage')?I('maxperpage'):10;
		   $class_ids=get_submenu_id(I('listType'));
		   $this->ajaxReturn(get_room_list($page,$pagesize,$class_ids));   
	}
	//获取Socket
	function getSocket($room_id)
	{  
	    $room_id=$room_id?$room_id:I('room_id');
		$room=room($room_id,'');  
		$config=FF('Conf/direct_config','',MODULE_PATH);
		$cid_array=$room['cid']?unserialize($room['cid']):array();
		$cid=$cid_array[$type];
		if(!$config['open'])
		{
			$return=array('result'=>1,'msg'=>L('Chat_Err_2'));
			$this->ajaxReturn($return);
		}
		if($room['status']!=1 || !$cid)
		{
			$return=array('result'=>1,'msg'=>L('Chat_Err_3'));
		}
		
		$config=FF('Conf/website_config','',MODULE_PATH); 
		
		$return['server']=preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\/',$config['server'])?$config['server']:gethostbyname($config['server']);
		$return['port']=$config['port'];
	}
	
	//获取礼物列表
	function getGive()
	{  
	     $give=M('chat_gift')->where('status=1')->order('sort asc')->select();
		 foreach($give as $k=>$v)
		 {
			  $give[$k]['ico']=C('site_url').$v['ico'];
		 }
		 $this->ajaxReturn($give);   
	}	
}
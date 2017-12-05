<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace Org\Util;
use Think\Controller;
/**
 * admin 控制器基类 抽象类
 */
abstract class User  extends Controller{

    /**
     * 管理员信息
     * @var admin
     * @access protected
     */      
    public $userinfo   = array();
	
	public $site_id   = 0;
	
	public $r_time = 0 ; //提示信息跳转的时长
	
    public function __construct() {
	  
        parent::__construct();
		$this->r_time = C('JUMP_TIME');
		edit_msg_tem();	
		//$this->wx_session();
		IS_AJAX?$this->IS_USER_AJAX():$this->IS_USER();
		$GLOBALS['LOGIN_USER'] = $this->userinfo;
		
    }
	
	function IS_USER()
	{
	     $session_id=trim(session('user.id'));
		 if($session_id)
		 {
		      $user = M("user");
			  $where['id']=$session_id;
			  $user_info=$user->where($where)->find();
			  $user_info['headpath']=$user_info['headpath']?$user_info['headpath']:C('root_path')."upload/system/userhead.png";
			  $user_info['nickname']=$user_info['nickname']?$user_info['nickname']:$user_info['user'];
			  if($user_info)
			  {
			       $user_info['admin']='user';
			       $this->userinfo=data_($user_info,array('pass'));
			  }
			  else
			  {
				  if(isMobile()){
					$this->redirect('Mobile/Login/index','',0);  
					  }else{
			       $this->redirect('User/login/index','',0);
				  }
			  }
		 }
		 else
		 {
		      if(isMobile()){
					$this->redirect('Mobile/Login/index','',0);  
					  }else{
			       $this->redirect('User/login/index','',0);
				  }
		 }
	}


	function IS_USER_AJAX()
	{
	     $session_id=trim(session('user.id'));
		 if($session_id)
		 {
		      $user = M("user");
			  $where['id']=$session_id;
			  $user_info=$user->where($where)->find();
			  if($user_info)
			  {
			       $user_info['admin']='user';
				   $this->userinfo=data_($user_info,array('pass'));
			  }
			  else
			  {
					 $return['err']  = 1;
					 $return['content'] = L('LOGIN_NO');	 
					 $this->ajaxReturn($return);
					 exit();
			  }
		 }
		 else
		 {
					 $return['err']  = 1;
					 $return['content'] = L('LOGIN_NO');	 
					 $this->ajaxReturn($return);
					 exit();
		 }
	}
	
	
    function get_openid()
	{
		 if(I('openid')) return I('openid');
		 $config=FF('Conf/config','',APP_PATH."Wechat/");
		 $appid =$config['appid']; //AppID(应用ID)
	     $appsecret = $config['appsecret']; //微信后台填写的appsecret
		 $code=I('code')?I('code'):"";
		 if(!$code)
		 {
			 $redirect_uri='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
			 $oauth_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $redirect_uri . '&response_type=code&scope=snsapi_base&state=wechat#wechat_redirect';
			 
			  header('Expires: 0');
			  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			  header('Cache-Control: no-store, no-cahe, must-revalidate');
			  header('Cache-Control: post-chedk=0, pre-check=0', false);
			  header('Pragma: no-cache');
			  header("HTTP/1.1 301 Moved Permanently");
			  header("Location: $oauth_url");
			  exit;	
		 }
		 else
		 {
			  $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
			  $ret_json = $this->curl_get_contents($url);
			  $ret = json_decode($ret_json);
			  $openid = $ret->openid;
			  $openid = !empty($ret->openid) ? $ret->openid : '';
			  return $openid;	  
		 }
	}	
	
    function wx_session()
	{
		  $user_agent = $_SERVER['HTTP_USER_AGENT'];
		  if (strpos($user_agent, 'MicroMessenger') === false) {
		  } else {
			   if(!trim(session('user.id')))
			   {
				     $openid=$this->get_openid();
					 if($openid)
					 {
						   $user=M('user')->where(array('openid'=>$openid))->find();
						   session('user.id',$user['id']);
					 }
			   }
			   
		  }			
	}
	
	function curl_get_contents($url) 
	{
			if(isset($_SERVER['HTTP_USER_AGENT'])) {
				$agent = $_SERVER['HTTP_USER_AGENT'];
			} else {
				$agent = '';
			}
			
			if(isset($_SERVER['HTTP_REFERER'])) {
				$referer = $_SERVER['HTTP_REFERER'];
			} else {
				$referer = '';
			}
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_TIMEOUT, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			curl_setopt($ch, CURLOPT_REFERER,$referer);
			curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			$r = curl_exec($ch);
			curl_close($ch);
			return $r;
	}	
   
}

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
abstract class Admin  extends Controller{

    /**
     * 管理员信息
     * @var admin
     * @access protected
     */      
    public $admininfo   = array();
	
	public $site_id   = 0;
	
	public $r_time = 0 ; //提示信息跳转的时长
	
    public function __construct() {
	  
        parent::__construct();
		$this->r_time = C('JUMP_TIME');
		IS_AJAX?$this->IS_ADMIN_AJAX():$this->IS_ADMIN();
		$GLOBALS['LOGIN_USER'] = $this->admininfo;
		if($GLOBALS['LOGIN_USER']['role_id']!=1) $this->auth_();
    }
	
	function IS_ADMIN()
	{
	     $session_id=trim(session('admin.id'));
		 if($session_id)
		 {
		      $admin = M("admin");
			  $where['id']=$session_id;
			  $admin_info=$admin->where($where)->find();
			  if($admin_info)
			  {
			       $admin_info['admin']='admin';
			       $this->admininfo=data_($admin_info,array('pass','pass_pre'));;
			  }
			  else
			  {
			       $this->redirect('Admin/login/index','',0);
			  }
		 }
		 else
		 {
		       $this->redirect('Admin/login/index','',0);
		 }
	}


	function IS_ADMIN_AJAX()
	{
	     $session_id=trim(session('admin.id'));
		 if($session_id)
		 {
		      $admin = M("admin");
			  $where['id']=$session_id;
			  $admin_info=$admin->where($where)->find();
			  if($admin_info)
			  {
			       $admin_info['admin']='admin';
			       $this->admininfo=data_($admin_info,array('pass','pass_pre'));
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
	
	
	function auth_()
	{
		$rule=M('auth_rule')->where(array('auth_m'=>MODULE_NAME,'auth_c'=>CONTROLLER_NAME,'auth_a'=>ACTION_NAME))->find();
		$Auth=new \Org\Util\Auth();
		$Auth_=$Auth->check(MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME,session('admin.id'));
		if(!$Auth_ && $rule)
		{
			 $this->error(L('NO_AUTH'),"",100);
		}		
	}
   
}

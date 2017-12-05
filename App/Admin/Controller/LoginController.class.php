<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function index(){
	
	    if(IS_POST)
		{

		//=================表单数据提交处理===========================		    		
		     $user=I("post.user","","trim");
			 $pass=I("post.pass","","trim");
			 
			 if($user=="" || $pass=="")
			 {
			      $this->error(L('ADMIN_Login_Err_1'),"",$this->r_time);
			 }
			 
			 if(!code(I('post.code_admin_login'),C('code_admin_login')))
			 {
			      $this->error(L('VERIFY_ERR'),"",$this->r_time);
			 }
			 			 
		     $admin=M("admin");
			 $where['user']=$user;
			 $where['status']=1;//1为开启管理员
			 $info=$admin->where($where)->find();
			 if($info)
			 {
			      if(md5($pass.trim($info['pass_pre']))==$info['pass'])
				  {
				        $role=M('role')->where("id=".$info['role_id'])->getField('id,status,is_login');
					    if(!$role[$info['role_id']]['status']) $this->error(L('ADMIN_Login_Err_6'),"",10);
						if(!$role[$info['role_id']]['is_login']) $this->error(L('ADMIN_Login_Err_7'),"",10);
						session('admin.id',$info['id']);
				  		$this->redirect('Admin/Index/index','',0, '页面跳转中...');
				  }
				  else
				  {
				        $this->error(L('ADMIN_Login_Err_3'),"",$this->r_time);
				  }
			 }
			 else
			 {
			       $this->error(L('ADMIN_Login_Err_2'),"",$this->r_time);
			 }
		//=================表单数据提交处理完=========================
		
		}
		else
		{
			$this->assign('info',$info);
			$this->display();		    
		}
    }
	
	public function quit(){
         session('admin.id',null); // 删除session
		 $this->redirect('Admin/Index/index','',0, '页面跳转中...');
		 
    }
	
	
}
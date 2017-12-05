<?php
namespace User\Controller;
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
		     $user_name=I("post.user","","trim");
			 $pass=I("post.pass","","trim");
			 
			 if($user_name=="" || $pass=="")
			 {
			      $this->error(L('User_Login_Err_1'),"",$this->r_time);
			 }
		     $user=M("user");
			 $where['user']=$user_name;
			 $where['status']=1;//1为开启会员
			 $info=$user->where($where)->find();
			 if($info)
			 {
			      if(md5($pass.trim($info['pass_pre']))==$info['pass'])
				  {
					    $group=M('group')->where('id='.$info['group_id'])->find();
						if(!$group['is_login'])	$this->error(L('User_Login_Err_6'),"",$this->r_time);
						if($group['is_promote'])  get_group_promote($info['id'],$info['group_id']);
						$user->where($where)->save(array('login_time'=>time()));
						session('user.id',$info['id']);
						$source=I('post.source'); //来源地址
						$source=$source?$source:U('User/Index/index');
						header('location:'.$source);
				  }
				  else
				  {
				        $this->error(L('User_Login_Err_3'),"",$this->r_time);
				  }
			 }
			 else
			 {
			       $this->error(L('User_Login_Err_2'),"",$this->r_time);
			 }
		//=================表单数据提交处理完=========================
		
		}
		else
		{
			$source=$_SERVER['HTTP_REFERER']; //来源地址
			$this->assign('info',$info);
			$this->assign('source',$source);
			$this->display();		    
		}
    }
/*
-----------------------------------  
   会员注册	   
-----------------------------------   
*/	
    public function register(){  
	          $config=FF("user_group/user_config");
			  if(!$config['reg_open']) $this->error(L('Reg_Err_0'),"",$this->r_time);
	          if(IS_POST)
			  {		
					   $user=I('post.user',"",'trim');
					   $pass=I('post.pass',"",'trim');
					   $confirm_pass=I('post.confirm_pass',"",'trim');
					   $email=I('post.email',"",'trim');
					   $recommend=I('post.recommend',"",'trim');
					   //开启手机号码验证
					   if(C('sms_appkey') && C('sms_appsecret'))
					   {
						   //手机号唯一性验证
						   $mobile_only=M('user')->where(array('mobile'=>$mobile_num))->find();
						   if($mobile_only) $this->error(L('P_no_mobile_only'),"",$this->r_time);
						   //手机验证码验证
						   $mobile_num=I('post.mobile_num');
						   $mobile_code=I('post.mobile_code');
						   $mobile=check_mobile_code($mobile_num,$mobile_code);
						   if($mobile==2) $this->error(L('P_no_pass'),"",$this->r_time);
					   }
					   fields('user');
					   //===========================检查用户账号密码不能为空======================================
					   if($user=="" || $pass=="")
					   {
						  $this->error(L('ADMIN_U_Login_Err_1'),"",$this->r_time);
					   }
					   //===========================检查用户密码和确认密码是否一致======================================
					   if($pass!=$confirm_pass)
					   {
						   $this->error(L('ADMIN_U_Login_Err_4'),"",$this->r_time);
					   }
					   //===========================检查管理邮箱格式======================================
					    $pattern = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/i";
					   if($email!="" && !preg_match($pattern,$email))
					   {
						   $this->error(L('ADMIN_U_Login_Err_5'),"",$this->r_time);
					   }  
			  //------------------------------------保存提交的用户----------------------------------------
			          $user =M('user');		
					  $string=new \Org\Util\String();//创建string对象
					  $pre=$string->randString(6,0); //获得6位随机字符串

						if ($user->create()){
						        $group=FF("user_group/user_group");
								
							    $user->group_id=1;
								$user->status=$group[$user->group_id]['is_verify']?0:1;
								$user->addtime=time();
								$user->pass_pre=$pre;// 密码随机前缀
								$user->pass=md5($pass.$pre);// 密码随机前缀
								$user->recommend=I('recommend',0,'intval');//推荐人ID
								$user->mobile=$mobile_num;//手机号
								$user->position=0;//会员所在ID,注册的时候不分配位置ID
								$insertId=$user->add();
							   if($insertId)
						       {
								   
									foreach(C('point_type') as $k=>$v)
									{
										 if($config['reg_'.$k]) $coin[$k]=return_num($config['reg_'.$k]);
									}
									account($insertId,$coin,9,6,L('SYSTEM'));
								    rebate_recommend($recommend,'',L('Reg_Scale'));
						            session('user.id',$insertId);
									set_grand(I('recommend',0,'intval'),array('recommend'=>1));
				  		            $this->redirect('User/Index/index','',0, '页面跳转中...');								   
							   }
							   else
							   {							   
							        $this->error(L('REGISTER_').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($user->getError(),"",$this->r_time);
						}			  
			      //------------------------保存提交的用户完--------------------------------------
			  }
			  else
			  {	
			  		 if(C('sms_appkey') && C('sms_appsecret'))  $this->assign('mobile_way',1);	  	 
			         $this->display();			  
			  }        
    }
/*
-----------------------------------  
   会员退出	   
-----------------------------------   
*/	
	
	public function quit(){
         session('user.id',null); // 删除session
		 session('twice_pass_confirm',null); // 删除session
		 $this->redirect('User/Index/index','',0, '页面跳转中...');
		 
    }

/*
----------------------------------- 
	手机找回密码详细页面
-----------------------------------   
*/	
	public function find_pass()
	{
		$config=FF("user_group/user_config");
		$this->assign('config',$config);
	    if(IS_POST){
			$mobile_num=I('mobile_num');
			$mobile_code=I('mobile_code');
			$user=M('user')->where(array("mobile"=>$mobile_num))->find();
			if(!$user)  $this->error(L('User_Login_Err_2'),"",$this->r_time);
			$this->assign('user',$user);
			$mobile=check_mobile_code($mobile_num,$mobile_code);
			if($mobile==1){
				$step=2;
				}else if($mobile==2){
				$this->error(L('P_no_pass'),"",$this->r_time);	
					}
			}else{
				$step=1;
				}
			$this->assign('step',$step);
			$this->display();
		}	
/*
----------------------------------- 
	修改密码
-----------------------------------   
*/	
	public function alter_password(){
		if(IS_POST){
		    $userid=I('user_id');
			$pass=I("post.pass",'','trim');
			$confirm_pass=I("post.confirm_pass",'','trim');		
			if($pass!=$confirm_pass){
			 	$this->error(L('User_Login_Err_4'),"",3);
				}
			$string=new \Org\Util\String();//创建string对象
			$pre=$string->randString(6,0); //获得6位随机字符串
			$user =M('user');			
			$where['id']=$userid;
			$data["pass"]=md5($pass.$pre);	
			$data["pass_pre"]=$pre;			
			if($user->where($where)->save($data)){
			   session('user.id',$userid);			
			   $this->success(L('User_Index_alter').L('User_Index_suc'),U('User/index/index'),0);			
				}
			}
			}	
/*
----------------------------------- 
	验证会员信息
	$type 字段名
	$field 值
-----------------------------------   
*/
	public function ajax_username()
	{
		$type=I('type');
		$field=I('field');
		$user_info=M('user')->where(array($type=>$field))->find();
		if($user_info){
			echo 0;
			}else{
			echo 1;	
				}
		}	
	
}
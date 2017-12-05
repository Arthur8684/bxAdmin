<?php
namespace Admin\Controller;
use Org\Util\Admin;

class AdminController extends Admin {

	function __construct()  //析构函数
	{
		parent::__construct();
	}

	public function index(){
		$this->display();
	}
	/*
    -----------------------------------
       后台管理员添加
    -----------------------------------
    */
	public function admin_add(){
		if(IS_POST)
		{
			$user=I('post.user',"",'trim');
			$pass=I('post.pass',"",'trim');
			$confirm_pass=I('post.confirm_pass',"",'trim');
			$email=I('post.email',"",'trim');

			//===========================检查管理员账号密码不能为空======================================
			if($user=="" || $pass=="")
			{
				$this->error(L('ADMIN_Login_Err_1'),"",$this->r_time);
			}
			//===========================检查管理员密码和确认密码是否一致======================================
			if($pass!=$confirm_pass)
			{
				$this->error(L('ADMIN_Login_Err_4'),"",$this->r_time);
			}
			//===========================检查管理邮箱格式======================================
			$pattern = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/i";
			if($email!="" && !preg_match($pattern,$email))
			{
				$this->error(L('ADMIN_Login_Err_5'),"",$this->r_time);
			}
			//------------------------------------保存提交的管理员----------------------------------------
			$admin =M('admin');
			$string=new \Org\Util\String();//创建string对象
			$pre=$string->randString(6,0); //获得6位随机字符串

			if ($admin->create()){
				$admin->status=I('status',0,'intval');
				$admin->role_id=I('role_id',0,'intval');
				$admin->addtime=time();
				$admin->pass_pre=$pre;// 密码随机前缀
				$admin->pass=md5($pass.$pre);// 密码随机前缀
				if($admin->add())
				{
					$this->success(L('ADD').L('success'),"",$this->r_time);
				}
				else
				{
					$this->error(L('ADD').L('ERR'),"",$this->r_time);
				}
			}
			else
			{
				$this->error($admin->getError(),"",$this->r_time);
			}
			//------------------------保存提交的管理员完--------------------------------------
		}
		else
		{
			$role_list=role_list_();
			$this->assign('role_list',$role_list);
			$this->display();
		}
	}
	/*
    -----------------------------------
       后台管理员列表
    -----------------------------------
    */
	public function admin_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$admin =M('admin');
		//------------------------------------管理员列表----------------------------------------
		$record_count=$admin->count();//获取总记录数
		$page=$record_count<$pagesize	?1:$page;
		if($record_count>0)
		{
			$info=$admin->order('id desc')->page($page,$pagesize)->select();

			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
		//------------------------------------管理员列表----------------------------------------
		$this->assign('info',$info);
		$this->display();
	}
	/*
    -----------------------------------
       后台管理员编辑
    -----------------------------------
    */
	public function admin_edit(){
		$id=I('id',0,'intval');
		$admin =M('admin');
		//------------------------------------验证数据正确性----------------------------------------
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		//------------------------------------验证数据正确性完----------------------------------------
		if(IS_POST)
		{
			$pass=I('post.pass',"",'trim');
			$confirm_pass=I('post.confirm_pass',"",'trim');
			$email=I('post.email',"",'trim');

			if($pass!="" && $pass!=$confirm_pass)
			{
				$this->error(L('ADMIN_Login_Err_4'),"",$this->r_time);
			}

			if($pass=="")
			{
				unset($_POST['pass']);
			}
			else
			{
				$string=new \Org\Util\String();//创建string对象
				$pre=$string->randString(6,0); //获得6位随机字符串
				$_POST['pass_pre']=$pre;
				$_POST['pass']=md5($pass.$pre);

			}
			//===========================检查管理邮箱格式======================================
			$pattern = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/i";
			if($email!="" && !preg_match($pattern,$email))
			{
				$this->error(L('ADMIN_Login_Err_5'),"",$this->r_time);
			}

			//------------------------------------编辑提交的管理员----------------------------------------
			if ($admin->create()){
				$admin->status=I('status',0,'intval');
				if($admin->save()!==false)
				{
					$this->success(L('EDIT').L('success'),U("Admin/Admin/admin_list"),$this->r_time);
				}
				else
				{
					$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				}
			}
			else
			{
				$this->error($admin->getError(),"",$this->r_time);
			}
			//------------------------编辑提交的管理员完--------------------------------------
		}
		else
		{
			$where['id']=$id;
			$info=$admin->where($where)->find();

			if($info)
			{
				$role_list=role_list_();
				$this->assign('role_list',$role_list);
				$this->assign('info',$info);
			}
			else
			{
				$this->error(L('ADMIN_Edit_Null'),"",$this->r_time);
			}

			$this->display();
		}
	}

	/*
    -----------------------------------
       后台管理员删除
    -----------------------------------
    */
	public function  admin_del(){
		$id=I('id');
		$del_num=0;//删除管理员的条数
		$admin =M('admin');
		//------------------------------------验证数据正确性----------------------------------------
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		$where['id']=$id;
		$del_num=$admin->where($where)->delete();
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Admin/Admin/admin_list"),$this->r_time);
	}

	/*
    -----------------------------------
       后台管理员角列表
    -----------------------------------
    */
	public function admin_role_list(){
		$role =M('role');
		$pagesize=25;
		$page=I('page',1,'intval');
		if(IS_POST)
		{

		}
		else
		{
			$record_count=$role->where($where)->count();//获取总记录数
			$page=$record_count<$pagesize?1:$page;

			if($record_count>0)
			{
				$info=$role->where($where)->order('sort_num asc,id desc')->page($page,$pagesize)->select();
				$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
				$this->assign('page_show',$page_show);// 赋值分页输出
			}
			$this->assign('info',$info);
			$this->display();
		}
	}


	/*
    -----------------------------------
       后台管理角色添加
    -----------------------------------
    */
	public function admin_role_add(){
		$role =M('role');
		if(IS_POST)
		{

			$name=I('post.name',"",'trim');

			//===========================检查会员组名称======================================
			if(!$name)
			{
				$this->error(L('ADMIN_Role_Err_Name_Info'),"",$this->r_time);
			}

			//------------------------------------保存提交的会员组----------------------------------------
			if ($role->create()){
				$role->status=I('status',0,'intval');
				$role->is_login=I('is_login',0,'intval');
				$role->sort_num=I('sort_num',0,'intval');
				$role->auth=$_POST['auth']?implode(",",$_POST['auth']):"";
				if($role->add())
				{
					$this->success(L('ADD').L('success'),U('Admin/Admin/admin_role_list'),$this->r_time);
				}
				else
				{
					$this->error(L('ADD').L('ERR'),"",$this->r_time);
				}
			}
			else
			{
				$this->error($role->getError(),"",$this->r_time);
			}
			//------------------------保存提交的用户完--------------------------------------
		}
		else
		{
			$auth=auth_list('admin');
			$this->assign('auth',$auth);
			$this->display();
		}
	}
	/*
    -----------------------------------
       管理角色编辑
    -----------------------------------
    */
	public function admin_role_edit(){
		$id=I('id',0,'intval');
		$role =M('role');
		//------------------------------------验证数据正确性----------------------------------------
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		//------------------------------------验证数据正确性完----------------------------------------
		if(IS_POST)
		{
			$name=I('post.name',"",'trim');
			//===========================检查会员组名称======================================
			if(!$name)
			{
				$this->error(L('ADMIN_Role_Err_Name_Info'),"",$this->r_time);
			}
			//------------------------------------编辑提交的会员组----------------------------------------
			if ($role->create()){
				$role->status=I('status',0,'intval');
				$role->is_login=I('is_login',0,'intval');
				$role->sort_num=I('sort_num',0,'intval');
				$role->auth=$_POST['auth']?implode(",",$_POST['auth']):"";
				if($role->save()!==false)
				{

					$this->success(L('EDIT').L('success'),U("Admin/Admin/Admin_Role_list"),$this->r_time);
				}
				else
				{

					$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				}
			}
			else
			{
				$this->error($role->getError(),"",$this->r_time);
			}
			//------------------------编辑提交的会员完--------------------------------------
		}
		else
		{
			$where['id']=$id;
			$info=$role->where($where)->find();
			if($info)
			{
				$this->assign('info',$info);
				$this->assign('id',$id);
				$auth=auth_list('admin');
				$this->assign('auth',$auth);
			}
			else
			{
				$this->error(L('ADMIN_Edit_Null'),"",$this->r_time);
			}
			$this->display();
		}
	}
	/*
    -----------------------------------
       角色删除
    -----------------------------------
    */
	public function  admin_role_del(){
		$id=I('id');
		$del_num=0;//删除会员的条数
		$role =M('role');
		//------------------------------------验证数据正确性----------------------------------------
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		$where['id']=$id;
		$del_num=$role->where($where)->delete();
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Admin/Admin/admin_role_list"),$this->r_time);
	}

}
?>
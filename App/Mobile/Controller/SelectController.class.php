<?php
namespace User\Controller;
use Think\Controller;
class SelectController extends Controller{
	
    public function index(){
        $this->display();	
    }
	//会员列表
    public function user_list(){
		
		$field_name=I('get.field_name')?I('get.field_name'):"user";	
	    $pagesize=8;	
		$page=I('page',1,'intval');
		$username=I('user',"",'trim');
	    $user =M('User');
		if($username) $where['user']=array("like", "%".$username."%");;
		$record_count=$user->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$user->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('field_name',$field_name);
		$this->assign('info',$info);
        $this->display();	
    }	
	
}
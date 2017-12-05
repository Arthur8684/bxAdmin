<?php
namespace Field\Controller;
use Org\Util\Admin;
class FieldController extends Admin {
    public function user_list(){
	    $pagesize=25;	
		$page=I('page',1,'intval');
	    $user =M('User');
		$record_count=$user->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$user->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		
		$this->assign('info',$info);
        $this->display();
    }
}
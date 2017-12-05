<?php
namespace Article\Controller;
use Think\Controller;
class IndexController extends Controller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   文章显示 
-----------------------------------   
*/
    public function index_show(){
	    $pagesize=25;	
		$id=I('id',1,'intval');
		if(!$id)
		{					 
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
		}
		$article=M('article');
	    $where['id']=$id;
		$info=$article->where($where)->find();	
		$this->assign('info',$info);
        $this->display();
    }
/*
-----------------------------------  
   文章列表 
-----------------------------------   
*/
    public function index_list(){
	    $pagesize=10;	
		$page=I('page',1,'intval');
	    $article =M('article');
		$record_count=$article->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$article->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('info',$info);
        $this->display();
    }
	
	
}
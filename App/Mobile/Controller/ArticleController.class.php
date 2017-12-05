<?php
namespace Mobile\Controller;
use Think\Controller;
class articleController extends Controller {

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
		$id=I('id',1,'intval');
		$model_id=I('model_id');
		if(!$id || !$model_id)
		{					 
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
		}
		$table=model_f('model_id');
		if(!$$table) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		$article=M($table);
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
		$model_id=I('model_id');
		if(!$model_id)
		{					 
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
		}
		$table=model_f('model_id');
		if(!$$table) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
	    $article =M(model_f('model_id'));
		$record_count=$article->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$article->order('id desc')->page($page,$pagesize)->select(); 
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$this->assign('page_show',$page_show);// 赋值分页输出
		$this->assign('info',$info);
		$this->assign('model_id',$model_id);
        $this->display();
    }
	
	
}
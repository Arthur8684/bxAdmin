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
		$id=I('id',1,'intval');
		if(!$id)
		{					 
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
		}
		$model=M('model');
		$model_id=I('model_id');
		$model_info=$model->where('id='.$model_id.'')->find();
		if($model_info){
	    $article =M($model_info['table']);
	    $where['id']=$id;
		$info=$article->where($where)->find();	
		$this->assign('info',$info);
		$this->assign('page_title',$model_info['name']);
		}
        $this->display();
    }
/*-----------------------------------  
   文章列表 
  -----------------------------------   */
    public function index_list(){
	    $pagesize=10;	
		$page=I('page',1,'intval');
		$model=M('model');
		$model_id=I('model_id');
		$model_info=$model->where('id='.$model_id.'')->find();
		if($model_info){
	    $article =M($model_info['table']);

		$record_count=$article->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$article->order('id desc')->page($page,$pagesize)->select(); 
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$this->assign('page_show',$page_show);// 赋值分页输出
		}
		$this->assign('page_title',$model_info['name']);
		$this->assign('info',$info);
		$this->assign('model_id',$model_id);
        $this->display();
    }
	
/*
-----------------------------------  
   审核列表 
-----------------------------------   
*/
    public function auth_list(){
		$user=session('user');
		if(!$user)  $this->redirect('Mobile/User/index');
		$user_list=M('user')->where(array('recommend'=>$user['id']))->getField('id',true);
	    $pagesize=10;	
		$page=I('page',1,'intval');
		$model=M('model');
		$model_id=I('model_id');
		$model_info=$model->where(array('id'=>$model_id))->find();
		if($model_info){
	    $article =M($model_info['table']);
		$record_count=$article->where(array('autho_id'=>array('in',$user_list),'verify'=>0))->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$article->order('id desc')->where(array('autho_id'=>array('in',$user_list),'verify'=>0))->page($page,$pagesize)->select(); 
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$this->assign('page_show',$page_show);// 赋值分页输出
		}
		$this->assign('page_title',$model_info['name']);
		$this->assign('info',$info);
		$this->assign('model_id',$model_id);
        $this->display();
    }

    public function auth_show(){
		$id=I('id',1,'intval');
		if(!$id)
		{					 
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
		}
		$model=M('model');
		$model_id=I('model_id');
		$model_info=$model->where('id='.$model_id.'')->find();
		if($model_info){
	    $article=M($model_info['table']);
	    $where['id']=$id;
		$info=$article->where($where)->find();	
		$this->assign('info',$info);
		$this->assign('model_id',$model_id);
		$this->assign('page_title',$model_info['name']);
		}
        $this->display();
    }	
}
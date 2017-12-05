<?php
namespace Form\Controller;
use Org\Util\User;
class UserController extends User{

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------   
   表单列表   
-----------------------------------   
*/	
    public function form_list(){   
			          $pagesize=15;
					  $page=I('page',1,'intval');
			          $model =M('model');
					  $where['model_class']='form';
				 //------------------------------------表单列表----------------------------------------	  
					  $page=$record_count<$pagesize	?1:$page; 
					  $info=$model->where($where)->order('id desc')->page($page,$pagesize)->select();
					  $time=time();
					  foreach($info as $k=>$v)
					  {
						   $c=model_config($v['id']);
						   $c['start_time']=$c['start_time']?$c['start_time']:0;
						   $c['end_time']=$c['end_time']?$c['end_time']:0;
						   if( !$c['open'] || ($c['start_time'] && $c['start_time'] > $time) || ($c['end_time'] && $c['end_time'] < $time) || ($c['group'] && !in_array($GLOBALS['LOGIN_USER']['group_id'],explode(',',$c['group'])) ))
						   {
							   unset($info[$k]);
							   continue;
						   }
						   else
						   {
							   if($c['start_time'] && $c['end_time'])
							   {
								   $info[$k]['start_time']=date('Y-m-d H:i',$c['start_time']);
								   $info[$k]['end_time']=date('Y-m-d H:i',$c['end_time']);
							   }
						   }

					  }
					  $record_count=count($info);//获取总记录数

					  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
					  $this->assign('page_show',$page_show);// 赋值分页输出
                 //------------------------------------表单列表----------------------------------------	  
				     $this->assign('info',$info);
			         $this->display();
    }
/*
-----------------------------------   
   表单内容添加 
-----------------------------------   
*/	
    public function form_content_add(){   
	       $modelid=I('modelid',0,'intval');		  
		   $this->assign('modelid',$modelid);
		   $this->display();			   
    }
/*
-----------------------------------   
   表单内容显示 
-----------------------------------   
*/	
  public function form_content_list()
  { 	
        $modelid=I('modelid',0,'intval');
		$table=model_f($modelid);	
		$pagesize=15;
		$page=I('page',1,'intval');
		
		$m=M($table);
		$where['autho_id']=$GLOBALS['LOGIN_USER']['id'];
		$record_count=$m->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		if($record_count>0)
		{
			$info=$m->where($where)->order('id desc')->page($page,$pagesize)->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
   //------------------------------------表单列表----------------------------------------	  
	   $this->assign('info',$info);
	   $this->assign('modelid',$modelid);
	   $this->display();    
  } 
  
  /*
-----------------------------------   
   表单内容显示 
-----------------------------------   
*/	
  public function form_content_view()
  { 	
        $modelid=I('modelid',0,'intval');
		$table=model_f($modelid);	
		$id=I('id',0,'intval');
		if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		$m=M($table);
	    $this->assign('info',$info);
	    $this->assign('modelid',$modelid);
		$this->assign('id',$id);
	    $this->display();    
  } 
}
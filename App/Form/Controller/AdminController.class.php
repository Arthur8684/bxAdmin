<?php
namespace Form\Controller;
use Org\Util\Admin;
class AdminController extends Admin {

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
		  $record_count=$model->where($where)->count();//获取总记录数
		  $page=$record_count<$pagesize	?1:$page; 
		  if($record_count>0)
		  {
			  $info=$model->where($where)->order('id desc')->page($page,$pagesize)->select();
			  $time=time();
			  foreach($info as $k=>$v)
			  {
				   $c=model_config($v['id']);
				   $c['start_time']=$c['start_time']?$c['start_time']:0;
				   $c['end_time']=$c['end_time']?$c['end_time']:0;
/*							   if( !$c['open'] || ($c['start_time'] && $c['start_time'] > $time) || ($c['end_time'] && $c['end_time'] < $time))
				   {
					   unset($info[$k]);
					   continue;
				   }
				   else
				   {
					   $info[$k]['status']=$c['open'];
					   $info[$k]['start_time']=$c['start_time'];
					   $info[$k]['end_time']=$c['end_time'];
				   }*/
				   $info[$k]['status']=$c['open'];
				   if($c['start_time'] && $c['end_time'])
				   {
					   $info[$k]['start_time']=date('Y-m-d H:i',$c['start_time']);
					   $info[$k]['end_time']=date('Y-m-d H:i',$c['end_time']);
				   }

			  }
			  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			  $this->assign('page_show',$page_show);// 赋值分页输出
		  }
	 //------------------------------------表单列表----------------------------------------	  
		 $this->assign('info',$info);
		 $this->display();
    }
/*
-----------------------------------   
   表单添加 
-----------------------------------   
*/	
    public function form_add(){   
			  $model =M('model');			  
	          if(IS_POST)
			  {
					   $table=I('post.table',"",'trim');
					   $name=I('post.name',"",'trim');
					   
					   if(!$name)  $this->error(L('Form_Err_0'),"",$this->r_time);
					   if(!$table) $this->error(L('Form_Err_1'),"",$this->r_time);
			  //------------------------------------表单提交----------------------------------------   
						if ($model->create()){
							   $model->model_class='form';

							   if($model->add())
							   {
								   	$field=new \Org\Util\Field();
					                $data[$table]=array("`id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT","`autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人ID'","`autho_admin` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户类型'","`verify`  tinyint(11) unsigned DEFAULT '0' COMMENT '审核'","`addtime` int(11) DEFAULT '0' COMMENT '添加日期'");
					                $create_table=$field->create_table($data);
									if($create_table)
									{
										$this->success(L('ADD').L('success'),U("Form/Admin/form_list"),$this->r_time);
									}
									else
									{
										$this->error(L('ADD').L('ERR'),"",$this->r_time);
									}
							        
							   }
							   else
							   {
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($model->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		  
			         $group=group_list_();
			         $this->assign('group',$group);
			         $this->display();			  
			  }    
    }
/*
-----------------------------------   
   表单添加 
-----------------------------------   
*/	
    public function form_edit(){   
			  $model =M('model');	
			  $id=I('id',0,'intval');		  
	          if(IS_POST)
			  {
					   $name=I('post.name',"",'trim');
					   if(!$name)  $this->error(L('Form_Err_0'),"",$this->r_time);
					   
			  //------------------------------------表单提交----------------------------------------   
						if ($model->create()){
							   if($model->save()!==false)
							   {
							        $this->success(L('EDIT').L('success'),U("Form/Admin/form_list"),$this->r_time);
							   }
							   else
							   {
							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($model->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		 
			         $where['id']=$id;
					 $info=$model->where($where)->find();
			         $group=group_list_();
			         $this->assign('group',$group);
					 $this->assign('info',$info);
			         $this->display();			  
			  }    
    }
/*
-----------------------------------   
   表单删除
-----------------------------------   
*/	
  public function form_del()
  { 	
		$model =M('model');	
		$id=I('id');	
		if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		if(!is_array($id)) $id=array($id);
		
		$where['id']=array('in',implode(",",$id));
		$table=$model->where($where)->getField('table',true);
		$field=new \Org\Util\Field();
		$field->del_table($table);
        $del_num=0;//删除记录的条数		  
	    //------------------------------------验证数据正确性----------------------------------------			  
	    $del_num=$model->delete(implode(",",$id)); 
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Form/Admin/form_list"),$this->r_time);	      
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
   表单内容添加 
-----------------------------------   
*/	
    public function form_content_add(){   
			  $modelid=I('modelid',0,'intval');		  
	          if(IS_POST)
			  {		
					  $table=model_f($modelid);	
					  $m=M($table);
					  
			  //------------------------------------表单提交----------------------------------------   
						if ($m->create()){
							   fields($modelid);
							   if($m->add())
							   {
									$this->success(L('ADD').L('success'),U("Form/Admin/form_content_list",array('modelid'=>$modelid)),$this->r_time);
							   }
							   else
							   {
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($m->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		  
			         $this->assign('modelid',$modelid);
			         $this->display();			  
			  }    
    }
/*
-----------------------------------   
   表单内容编辑
-----------------------------------   
*/	
    public function form_content_edit(){   
			  $modelid=I('modelid',0,'intval');			
			  $id=I('id',0,'intval');
			  
			  $table=model_f($modelid);	
			  $m=M($table);		  
	          if(IS_POST)
			  {
				   
		           //------------------------------------表单提交----------------------------------------   
				   if ($m->create()){
					       fields($modelid,'',$id);
						   if($m->save()!==false)
						   {
								$this->success(L('EDIT').L('success'),U("Form/Admin/form_content_list",array('modelid'=>$modelid)),$this->r_time);
						   }
						   else
						   {
								$this->error(L('EDIT').L('ERR'),"",$this->r_time);
						   }
					}
					else
					{
						   $this->error($m->getError(),"",$this->r_time);
					}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		 
			         $where['id']=$id;
					 $info=$m->where($where)->find();
			         $this->assign('modelid',$modelid);
					 $this->assign('info',$info);
			         $this->display();			  
			  }    
    }
	/*
-----------------------------------   
   表单内容删除
-----------------------------------   
*/	
  public function form_content_del()
  { 	
        $modelid=I('modelid',0,'intval');
		$id=I('id');
		$table=model_f($modelid);	
		$m=M($table);
		
		if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		if(!is_array($id)) $id=array($id);
		
        $del_num=0;//删除记录的条数		  
	    //------------------------------------验证数据正确性----------------------------------------			  
	    $del_num=$m->delete(implode(",",$id)); 
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Form/Admin/form_content_list",array('modelid'=>$modelid)),$this->r_time);	      
  }
}
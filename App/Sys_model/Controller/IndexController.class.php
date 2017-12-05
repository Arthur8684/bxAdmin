<?php
namespace Sys_model\Controller;
use Org\Util\Admin;
class IndexController extends Admin {
    public function model_list(){
		$pagesize=25;
	    $page=I('page',1,'intval');
        $model=M('model');
		$where['model_class']="content";
		/*=====================计算记录条数====================================*/
		$record_count=$model->count();//获取总记录数
		$page=$record_count<$pagesize	?1:$page; 
		if($record_count>0)
		{
			$info=$model->where($where)->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
			$type=$this->get_model_name();
			$this->assign('info',$info);
		    $this->assign('type',$type);		
		}
        $this->display();
    }
	
    public function model_add(){ 
	    if(IS_POST)
		{
		      $name=I('post.name');
			  $sign=I('post.sign');
			  $type=I('post.type');
			  $table=$sign;
			  if(!$name) $this->error(L('MODEL_Name').L('O_EMPTY'),"",$this->r_time);
			  if(!$sign) $this->error(L('MODEL_Sign').L('O_EMPTY'),"",$this->r_time);
			  $model_class=$this->get_model_class($type);
			  $model=M('model');
              if($model->create())
			  {
			       $model->model_class=$model_class?$model_class:"content";
				   $model->status=I('status',0,'intval');
				   $model->table=$table;
				   if($insert_id=$model->add())
				   {
				        if(creat_model_object($type,$sign,$insert_id))
						{
						     $this->success(L('ADD').L('success'),U("Sys_model/Index/model_list"),$this->r_time);
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
		}
		else
		{
			   $type=$this->get_model_name();
			   $this->assign('type',$type);		
			   $this->display();		
		}

    }	
	
    public function model_edit(){ 

		       $id=I("get.id");
			   if(IS_POST)
			   {
			          $name=I('post.name');
					  if(!$name) $this->error(L('MODEL_Name').L('O_EMPTY'),"",$this->r_time);
					  $model=M('model');
					  if($model->create())
					  {
						   $model->status=I('status',0,'intval');
						   if($model->save()!==false)
						   {
								$this->success(L('EDIT').L('success'),"",$this->r_time);
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
					
			   }
			   else
			   { 
					   $where['id']=$id;
					   $model=M('model');
					   $info=$model->where($where)->find();
					   $type=$this->get_model_name();
					   $this->assign('type',$type);	
					   $this->assign('info',$info);
					   $this->display();
			   }		

    }

    public function model_del(){ 
		       $id=I("get.id");
			   $where['id']=$id;
			   $model=M('model');
			   $info=$model->where($where)->find();
			   if($info)
			   {
			       $sign=$info['sign'];
				   $model_type=$info['type'];
				   $del=del_model_object($model_type,$sign,$id);
				   if($del)
				   { $model->delete($id); }
				   else
				   {$this->error(L('DEL').L('ERR'),"",$this->r_time);}
				   $this->success(L('DEL').L('success'),"",$this->r_time);	
			   }
			   else
			   { 
			        $this->error(L('DEL').L('ERR'),"",$this->r_time);
			   }		
                	
    }
			
    public function get_model_name(){
		$sys_model=M('sys_model');
		$type=$sys_model->where(array('model_class'=>'content'))->getField('type,name');
		return $type;
    }	
	
	public function get_model_class($type){
		$sys_model=M('sys_model');
		$where['type']=$type;
		$model_class=$sys_model->where($where)->getField('model_class');
		return $model_class;
    }	

}
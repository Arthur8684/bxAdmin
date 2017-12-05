<?php
namespace Sys_model\Controller;
use Org\Util\Admin;
class ClassController extends Admin {
    public function class_list(){
		$pagesize=25;
		$modelid=I('modelid',0,'intval');
		$parentid=I('parentid',0,'intval');
		if(!$modelid) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
	    $page=I('page',1,'intval');
        $sys_model_class=M('sys_model_class');
		$where['model_id']=$modelid;
		$where['parent_id']=$parentid;
		/*=====================计算记录条数====================================*/
		$record_count=$sys_model_class->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize	?1:$page; 
		if($record_count>0)
		{
			$info=$sys_model_class->where($where)->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
			$this->assign('info',$info);				
		}
		if($parentid)
		{
		    $parent_class=$sys_model_class->where('id='.$parentid)->find();
			$this->assign('parent_class',$parent_class);
		}
		$this->assign('parentid',$parentid);
		$this->assign('modelid',$modelid);
		$this->assign('parent_class_nav',parents($parentid));
        $this->display();
    }
	
    public function class_add(){ 
	    $modelid=I('modelid',0,'intval');
	    $parentid=I('parentid',0,'intval');
	    if(!$modelid) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
	    if(IS_POST)
		{     
              $parentid=linkage_id($parentid);
		      $name=I('name','','trim');
			  if(!$name) $this->error(L('MODEL_Class_Name').L('O_EMPTY'),"",$this->r_time);
			  $sys_model_class=M('sys_model_class');
              if($sys_model_class->create())
			  {
				   $sys_model_class->status=I('status',0,'intval');
				   $sys_model_class->sort=I('sort',0,'intval');
				   $sys_model_class->parent_id=$parentid;
				   $sys_model_class->model_id=$modelid;
				   if($sys_model_class->add())
				   {
						$this->success(L('ADD').L('success'),U("Sys_model/Class/class_list",array('modelid'=>$modelid,'parentid'=>$parentid)),$this->r_time);
				   }
				   else
				   {
						$this->error(L('ADD').L('ERR'),"",$this->r_time);
				   }				   
			  }
			  else
			  {
				   $this->error($sys_model_class->getError(),"",$this->r_time);
			  }
		}
		else
		{
		       $value=$parentid?parents($parentid,"sys_model_class",array('name','id'),array('text','value')):"";
		       $this->assign('parentid',$parentid);// 赋值分页输出
			   $this->assign('modelid',$modelid);// 赋值分页输出
               $this->assign('linkage',linkage(get_model_class($modelid),"parentid",'',0,$value,array('text'=>L('MODEL_Class_Top'),'value'=>0),"line_4_padding_1"));// 赋值分页输出
			   $this->display();		
		}

    }	
	
    public function class_edit(){ 
	    $modelid=I('modelid',0,'intval');
	    $parentid=I('parentid',0,'intval');
		$id=I('id',0,'intval');
	    if(!$modelid || !$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		$sys_model_class=M('sys_model_class');
	    if(IS_POST)
		{     
              $parentid=linkage_id($parentid);
		      $name=I('name','','trim');
			  if(!$name) $this->error(L('MODEL_Class_Name').L('O_EMPTY'),"",$this->r_time);
			  
              if($sys_model_class->create())
			  {
				   $sys_model_class->status=I('status',0,'intval');
				   $sys_model_class->sort=I('sort',0,'intval');
				   $sys_model_class->parent_id=$parentid;
				   $sys_model_class->model_id=$modelid;
				   if($sys_model_class->save() !== FALSE)
				   {
						$this->success(L('EDIT').L('success'),U("Sys_model/Class/class_list",array('modelid'=>$modelid,'parentid'=>$parentid)),$this->r_time);
				   }
				   else
				   {
						$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				   }				   
			  }
			  else
			  {
				   $this->error($sys_model_class->getError(),"",$this->r_time);
			  }
		}
		else
		{
		       $where['id']=$id;
		       $info=$sys_model_class->where($where)->find();
			   if(!$info)
			   {
			         $this->error(L('EMPTY_RECORD'),U("Sys_model/Class/class_list",array('modelid'=>$modelid,'parentid'=>$parentid)),$this->r_time);
			   }
		       $value=$info['parent_id']?parents($info['parent_id'],"sys_model_class",array('name','id'),array('text','value')):"";
		       $this->assign('parentid',$parentid);
			   $this->assign('modelid',$modelid);
			   $this->assign('info',$info);
               $this->assign('linkage',linkage(get_model_class($modelid,0,$info['id']),"parentid",'',0,$value,array('text'=>L('MODEL_Class_Top'),'value'=>0),"line_4_padding_1"));// 赋值分页输出
			   $this->display();		
		} 
   }

    public function class_del(){ 
		$id=I('id',0,'intval');
		$modelid=I('modelid',0,'intval');
	    $parentid=I('parentid',0,'intval');
	    if(!$modelid || !$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		if(!is_array($id)) $id=array($id);
		$del=del_class($id,$modelid);
		if($del)
		{
		    $this->success(L('DEL').L('success'),U("Sys_model/Class/class_list",array('modelid'=>$modelid,'parentid'=>$parentid)),$this->r_time);	
		}else
		{
		    $this->error(L('DEL').L('ERR'),"",$this->r_time);
		}
    }	

}
<?php
namespace User\Controller;
use Org\Util\Admin;
class AgentadminController extends Admin {	
	public function agent_list()
	{
		$pagesize=25;
		$page=I('page',1,'intval');
		$user =M('agent');
		$record_count=$user->count();
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$user->order('id desc')->page($page,$pagesize)->select();
			foreach ($info as $k=>$v)
			{
				$info[$k]['areaName']=M('linkage')->where('id='.$v['area_id'])->getField('name');
			}
			$this->assign('arr',$info);
			$page_show=page_show($record_count,$pagesize,3,$other);
			$this->assign('page_show',$page_show);
		}
		$this->display();
	}
	
	public function agent_add()
	{
		if(IS_POST)
		{
			$user_id = I('user_id',0,'intval');
			if(!$user_id) $this->error(L('ADMIN_Agent_id_cannot'),"",$this->r_time);
			$area_id = linkage_id(I('area_id'));
			if(!$area_id) $this->error(L('ADMIN_Agent_area_cannot'),"",$this->r_time);
			$_POST['agentName'] = M('user')->where('id='.$user_id)->getField('user');
			$_POST['area_id']=$area_id;
			$agent = M('agent');
			
			$where['area_id'] = $area_id;
			$record_count = $agent ->where($where)->count();
			if($record_count) $this->error(L('ADMIN_Area_already_exists'),"",$this->r_time);
		    
			if($agent->create())
			{
				if($agent->add())
				{
					$this->success(L('ADD').L('success'),U('User/Agentadmin/agent_list',array('type'=>$this->type)),$this->r_time);
				}else
				{
					$this->error(L('ADD').L('ERR'),"",$this->r_time);
				}			
			}
		}
		else
		{
			$data = agent_link_list_info(0,'linkage');
			
			$area_id = linkage($data,'area_id',$selects="",$form=0,$value=array(),$default=array(),$class="row padding_8");
			
			$this->assign('area_id',$area_id);
			
			$this->display();
		}
	}

	public function agent_edit()
	{
		 $id=I('id',0,'intval');
		 $agent = M('agent');
		 //------------------------------------验证数据正确性----------------------------------------
		 if(!$id)
		 {
		 	$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		 }
		 //------------------------------------验证数据正确性完----------------------------------------		
		if(IS_POST)
		{
			$user_id = I('user_id',0,'intval');
			if(!$user_id) $this->error(L('ADMIN_Agent_id_cannot'),"",$this->r_time);
			$area_id = linkage_id(I('area_id'));
			if(!$area_id) $this->error(L('ADMIN_Agent_area_cannot'),"",$this->r_time);
			$_POST['agentName'] = M('user')->where('id='.$user_id)->getField('user');
			$_POST['area_id']=$area_id;
				
			$where['area_id'] = $area_id;
			$where['id'] = array('neq',$id);
			$record_count = $agent ->where($where)->count();
			if($record_count) $this->error(L('ADMIN_Area_already_exists'),"",$this->r_time);
	
			if($agent->create())
			{
				if($agent->save()!==false)
				{
					$this->success(L('EDIT').L('success'),U('User/Agentadmin/agent_list'),$this->r_time);
				}else
				{
					$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				}
			}
		}
		else
		{
			 $where['id']=$id;
		     $info=$agent->where($where)->find();
			 if($info)
			 {
			 	  $data = agent_link_list_info(0,'linkage');
			      $default_area_id = parents($info['area_id'],$table="linkage",$field=array('name','id'),$key=array('text','value'));	
			      $area_id =linkage($data,'area_id',$selects="",$form=0,$default_area_id,$default=array(),$class="row padding_8");
			      $this->assign('info',$info);	
			      $this->assign('area_id',$area_id);
			 }	           
	         $this->display();	
		}
	}	
	
	public function agent_delete()
	{
		$id=is_array(I('id'))?I('id'):array(I('id'));
		$agent = M('agent');	
		$del_num = $agent -> delete(implode(',',$id));
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("User/Agentadmin/agent_list"),$this->r_time);
	}
	public function setting_list(){
		if(IS_POST)
		{
			$post=I('post.');
			FF('user_agent/config',$post);
			C($post);
		}
		$c=FF('user_agent/config',"");
		$this->assign('c',$c);
		$this->display();
	}
}
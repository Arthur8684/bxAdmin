<?php
namespace Games\Controller;
use Org\Util\Admin;
class ClassController extends Admin {
    public function class_list(){
		$pagesize=25;
		$parentid=I('parentid',0,'intval');
	    $page=I('page',1,'intval');
        $games_class=M('games_class');
		$where['parent_id']=$parentid;
		/*=====================计算记录条数====================================*/
		$record_count=$games_class->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize	?1:$page; 
		if($record_count>0)
		{
			$info=$games_class->where($where)->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
			$this->assign('info',$info);				
		}
		if($parentid)
		{
		    $parent_class=$games_class->where('id='.$parentid)->find();
			$this->assign('parent_class',$parent_class);
		}
		$this->assign('parentid',$parentid);
		$this->assign('parent_class_nav',parents($parentid,'games_class'));
        $this->display();
    }
	
    public function class_add(){ 
	    $parentid=I('parentid',0,'intval');
	    if(IS_POST)
		{     
              $parentid=linkage_id($parentid);
		      $name=I('name','','trim');
			  if(!$name) $this->error(L('Games_Name').L('O_EMPTY'),"",$this->r_time);
			  $games_class=M('games_class');
              if($games_class->create())
			  {
				   $games_class->sort=I('sort',0,'intval');
				   $games_class->parent_id=$parentid;
				   if($games_class->add())
				   {
						$this->success(L('ADD').L('success'),U("Games/Class/class_list",array('parentid'=>$parentid)),$this->r_time);
				   }
				   else
				   {
						$this->error(L('ADD').L('ERR'),"",$this->r_time);
				   }				   
			  }
			  else
			  {
				   $this->error($games_class->getError(),"",$this->r_time);
			  }
		}
		else
		{
		       $value=$parentid?parents($parentid,"games_class",array('name','id'),array('text','value')):"";
		       $this->assign('parentid',$parentid);// 赋值分页输出
               $this->assign('linkage',linkage(get_linkage_datas('games_class',0),"parentid",'',0,$value,array('text'=>L('Games_Class_Top'),'value'=>0),"line_4_padding_1"));// 赋值分页输出
			   $this->display();		
		}

    }	
	
    public function class_edit(){ 
	    $parentid=I('parentid',0,'intval');
		$id=I('id',0,'intval');
		$games_class=M('games_class');
	    if(IS_POST)
		{     
              $parentid=linkage_id($parentid);
		      $name=I('name','','trim');
			  if(!$name) $this->error(L('Games_Name').L('O_EMPTY'),"",$this->r_time);
			  
              if($games_class->create())
			  {
				   $games_class->sort=I('sort',0,'intval');
				   $games_class->parent_id=$parentid;
				   if($games_class->save() !== FALSE)
				   {
						$this->success(L('EDIT').L('success'),U("Games/Class/class_list",array('parentid'=>$parentid)),$this->r_time);
				   }
				   else
				   {
						$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				   }				   
			  }
			  else
			  {
				   $this->error($games_class->getError(),"",$this->r_time);
			  }
		}
		else
		{
		       $where['id']=$id;
		       $info=$games_class->where($where)->find();
			   if(!$info)
			   {
			         $this->error(L('EMPTY_RECORD'),U("Games/Class/class_list",array('parentid'=>$parentid)),$this->r_time);
			   }
		       $value=$info['parent_id']?parents($info['parent_id'],"games_class",array('name','id'),array('text','value')):"";
			   $data_where['id']=array('NEQ',$info['id']);
			   $data=get_linkage_datas('games_class',0,'',$data_where,'parent_id');
		       $this->assign('parentid',$parentid);
			   $this->assign('info',$info);
               $this->assign('linkage',linkage($data,"parentid",'',0,$value,array('text'=>L('Games_Class_Top'),'value'=>0),"line_4_padding_1"));// 赋值分页输出
			   $this->display();		
		} 
   }

    public function class_del(){ 
		$id=I('id',0,'intval');
	    $parentid=I('parentid',0,'intval');
	    if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		if(!is_array($id)) $id=array($id);
		$del=del_class($id,1);
		if($del)
		{
		    $this->success(L('DEL').L('success'),U("Games/Class/class_list",array('parentid'=>$parentid)),$this->r_time);	
		}else
		{
		    $this->error(L('DEL').L('ERR'),"",$this->r_time);
		}
    }	

}
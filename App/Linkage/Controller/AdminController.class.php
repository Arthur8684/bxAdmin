<?php
namespace Linkage\Controller;
use Org\Util\Admin;
class AdminController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
  添加联动
-----------------------------------   
*/
  //public function add_link(){ 
  public function linkage_add(){   
  	if(IS_POST){
  		$area['name']=I('name','','trim');
		$area['orders']=I('orders',0,'trim');
		$areaid=I('area_id');
		$area['parent_id']=linkage_id($areaid);
		$area['is_show']=I('is_show',1,'trim');
	    if(add_links($area)){		   
			$this->success('','',0);
		}else{
			$this->error('',"",3);	  
		}	  
	}else{	
		$parent_ids=I('get.parent_id','','trim'); 
		$parray=''; 
		if($parent_ids){
			$this->assign('parent_ids',$parent_ids);
			$parray=parents($parent_ids,$table="linkage",$field=array('name','id'),$key=array('text','value'));
		}
		$this->assign('act','add');	 
		$link_area_list=link_area_list(0);
		$area_id=linkage($link_area_list,"area_id","",0,$parray,array('text'=>L('area_first'),'value'=>"0"),'form-control');		 
		$this->assign('area_id',$area_id);
		$this->display('add_link');  
	}
 } 
 /*
-----------------------------------  
  修改联动
-----------------------------------   
*/
  public function linkage_edit(){   
  	if(IS_POST){
  		$area['name']=I('name','','trim');
		$area['orders']=I('orders',0,'trim');
		$areaid=I('area_id');
		$area['parent_id']=linkage_id($areaid);
		$area['is_show']=I('is_show',1,'trim');
		$id=I('post.id','','trim');
	    if(alter_link($area,$id)){		   
			$this->success('','',0);
		}else{
			$this->error('',"",3);	  
		}	  
	}else{	
	  	$id=I('get.id','','trim');
		if($id){
			$linkage=M('linkage');
			$where['id']=$id;
			$areas=$linkage->where($where)->find();
			$this->assign('areas',$areas);
			$this->assign('id',$id);
			$parray=parents($areas['parent_id'],$table="linkage",$field=array('name','id'),$key=array('text','value')); 
		}else{
			$this->error('',"",3);
		}
		$this->assign('act','alter');
		$link_area_list=link_area_list(0);
		$area_id=linkage($link_area_list,"area_id","",0,$parray,array('text'=>L('area_first'),'value'=>"0"),'form-control');		 
		$this->assign('area_id',$area_id);
		$this->display('add_link');
	}
 } 

  public function linkage_list(){
	 	$parent_id=I('parent_id','0','trim');
		$where['parent_id']=$parent_id;
	  	$linkage=M('linkage');
		$pagesize=10;
		$page=I('page',1,'intval');
		$record_count=$linkage->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$linkage->where($where)->order('orders')->page($page,$pagesize)->select();
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
        $this->display();
	  }
  public function linkage_del(){   
  	 $id=I('id','','trim');
  		if(del_links($id)){		   
		  $this->success('',U('Linkage/Admin/linkage_list'),0);
		  }else{
		  $this->error('',"",3);	  
			   };
  }
}
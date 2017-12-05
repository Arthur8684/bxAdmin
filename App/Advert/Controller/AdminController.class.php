<?php
namespace Advert\Controller;
use Org\Util\Admin;
class AdminController extends Admin {
   function __construct()  //析构函数
   {  
        parent::__construct();
		$this->advert_type=array('image'=>'图片','slide'=>'幻灯片','html'=>'HTML');
   } 
/*
-----------------------------------  
   广告位列表  
-----------------------------------   
*/
    public function advert_type_list(){
		$advert_type =M('advert_type');
		$record_count=$advert_type->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$advert_type->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$advert_type=$this->advert_type;
		$this->assign('advert_type',$advert_type);
		$this->assign('info',$info);
        $this->display();
    }	
	
	    public function advert_type_add(){

			if(IS_POST)
			{	
				   $title=I('post.title',"",'trim');
				   if(!$title) $this->error(L('ADMIN_Advert_Err_0'),"",$this->r_time);
						
				   $advert_m =M('advert_type');
				   if($advert_m->create())	
				   {
							$advert_m->status=I('post.status',0,'intval');
							$advert_m->overdue_show=I('post.overdue_show','','trim');
							$advert_m->setting=$advert_m->setting?array2string(I('setting')):"";
				        	if($advert_m->add())
							   {
							        $this->success(L('ADD').L('success'),U('Advert/Admin/advert_type_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),U('Advert/Admin/advert_type_list'),$this->r_time);
							   }
				   }
				   else
				   {
				               $this->error(L('ADD').L('ERR'),U('Advert/Admin/advert_type_list'),$this->r_time);
				   }   
			}
			else
			{			
					$advert_type=$this->advert_type;
					$this->assign('advert_type',$advert_type);
					$this->display();	
			}

    }
	
	    public function advert_type_edit(){
			$id=I('id',0,'intval');
            if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			$advert_m =M('advert_type');
			
			if(IS_POST)
			{
				   $title=I('post.title',"",'trim');
				   if(!$title) $this->error(L('ADMIN_Advert_Err_0'),"",$this->r_time);
				   
				   if($advert_m->create())	
				   {
							$advert_m->status=I('post.status',0,'intval');
							$advert_m->overdue_show=I('post.overdue_show','','trim');
							$advert_m->setting=$advert_m->setting?array2string(I('setting')):"";
							
				        	if($advert_m->save()!==false)
							   {
							        $this->success(L('EDIT').L('success'),U('Advert/Admin/advert_type_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
				   }
				   else
				   {
				               $this->error(L('EDIT').L('ERR'),"",$this->r_time);
				   }   
			}
			else
			{			
					$advert_type=$this->advert_type;					
					$where['id']=$id;
					$info=$advert_m->where($where)->find();
					if(!$info) $this->error(L('ADMIN_Advert_Err_1'),"",$this->r_time);

					$this->assign('info',$info);
					$this->assign('advert_m',$advert_m);
					$this->display();	
			}

    }
/*
-----------------------------------  
   广告位删除  
-----------------------------------   
*/	
    public function  advert_type_del(){  	
	          $id=I('id');
			  $del_num=0;//删除字段的条数
			  if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			  if(!is_array($id)) $id =array($id);
			  $advert_m =M('advert_type');
			  $advert =M('advert');
			  $advert_m_where['id']=array('in',$id);
			  $advert_where['parent_id']=array('in',$id);
			  $advert->where($advert_where)->delete();
              $del_num=$advert_m->where($advert_m_where)->delete();

			  $this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Advert/Admin/advert_type_list'),$this->r_time);     
    }	
/*
-----------------------------------  
   广告列表  
-----------------------------------   
*/
    public function advert_list(){
		$parent_id=I('parent_id',0,'intval');
		$page=I('page',1,'intval');
		$advert =M('advert');
		
		$where['parent_id']=$parent_id;
		$record_count=$advert->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $advert_info=$advert->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		
		$advert_type=$this->advert_type;
		$this->assign('record_count',$record_count);
		$this->assign('advert_type',$advert_type);
		$this->assign('advert_info',$advert_info);
		$this->assign('info',advert($parent_id)); //广告位信息
        $this->display();
    }	
/*
-----------------------------------  
   广告添加 
-----------------------------------   
*/
     public function advert_add(){
		    $parent_id=I('parent_id',0,'intval');
			if(!$parent_id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			if(IS_POST)
			{	
				   $title=I('post.title',"",'trim');
				   $start_time=I('post.start_time');
				   $end_time=I('post.end_time');
				   if(!$title) $this->error(L('ADMIN_Advert_Err_2'),"",$this->r_time);
						
				   $advert =M('advert');
				   if($advert->create())	
				   {
					     $advert->start_time=$start_time?strtotime($start_time):0;
						 $advert->end_time=$end_time?strtotime($end_time):0;
						 $advert->add_time=time();
						 $advert->remarks=I('post.remarks','','trim');
						 if($advert->add())
						   {
								$this->success(L('ADD').L('success'),U('Advert/Admin/advert_list',array('parent_id'=>$parent_id)),$this->r_time);
						   }
						   else
						   {							   
								$this->error(L('ADD').L('ERR'),U('Advert/Admin/advert_list',array('parent_id'=>$parent_id)),$this->r_time);
						   }
				   }
				   else
				   {
				               $this->error(L('ADD').L('ERR'),U('Advert/Admin/advert_list',array('parent_id'=>$parent_id)),$this->r_time);
				   }   
			}
			else
			{			
					$advert_type=$this->advert_type;
					$advert_info=advert($parent_id);
					$tem="advert_".$advert_info['advert_type']."_add";
					$this->assign('advert_type',$advert_type);
					$this->assign('info',$advert_info);
					$this->display($tem);	
			}
    }
/*
-----------------------------------  
   广告编辑
-----------------------------------   
*/	
	    public function advert_edit(){
			$id=I('id',0,'intval');
			$parent_id=I('parent_id',0,'intval');
            if(!($id && $parent_id)) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			$advert =M('advert');
			
			if(IS_POST)
			{
				   $start_time=I('post.start_time');
				   $end_time=I('post.end_time');
				   $title=I('post.title',"",'trim');
				   if(!$title) $this->error(L('ADMIN_Advert_Err_2'),"",$this->r_time);
				   
				   if($advert->create())	
				   {
					     $advert->start_time=$start_time?strtotime($start_time):0;
						 $advert->end_time=$end_time?strtotime($end_time):0;
						 $advert->add_time=time();
						 $advert->remarks=I('post.remarks','','trim');
				        	if($advert->save()!==false)
							 {
							        $this->success(L('EDIT').L('success'),U('Advert/Admin/advert_list',array('parent_id'=>$parent_id)),$this->r_time);
							 }
							 else
							 {							   
							        $this->error(L('EDIT').L('ERR'),U('Advert/Admin/advert_list',array('parent_id'=>$parent_id)),$this->r_time);
							 }
				   }
				   else
				   {
				               $this->error(L('EDIT').L('ERR'),U('Advert/Admin/advert_list',array('parent_id'=>$parent_id)),$this->r_time);
				   }   
			}
			else
			{			
					$advert_type=$this->advert_type;					
					$where['id']=$id;
					$advert_info=$advert->where($where)->find();
					if(!$advert_info) $this->error(L('ADMIN_Advert_Err_4'),"",$this->r_time);
					$advert_type_info=advert($parent_id);
                    $tem="advert_".$advert_type_info['advert_type']."_edit";
					
					$this->assign('advert_info',$advert_info);
					$this->assign('advert_type',$advert_type);
					$this->assign('info',$advert_type_info); //广告位信息
					$this->display($tem);	
			}

    }
/*
-----------------------------------  
   广告删除  
-----------------------------------   
*/	
    public function  advert_del(){  	
			  $id=I('id',0,'intval');
			  $parent_id=I('parent_id',0,'intval');
			  $del_num=0;//删除字段的条数
			  if(!($id && $parent_id)) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			  if(!is_array($id)) $id =array($id);
			  $advert =M('advert');
			  $advert_where['id']=array('in',$id);
			  $del_num=$advert->where($advert_where)->delete();

			  $this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Advert/Admin/advert_list',array('parent_id'=>$parent_id)),$this->r_time);     
    }	
	
		
	public function advert_type_image(){
        $this->display();
    }	

	public function advert_type_edit_image(){
	    $id=I('id');
	    $advert_m =M('advert_type');
	    $data['id']=$id;
	    $info=$advert_m->where($data)->find();
		$this->assign('setting',string2array($info['setting']));
		$this->assign('info',$info);
        $this->display();
    }
	
			
	public function advert_type_slide(){
        $this->display();
    }	

	public function advert_type_edit_slide(){
	    $id=I('id');
	    $advert_m =M('advert_type');
	    $data['id']=$id;
	    $info=$advert_m->where($data)->find();
		$this->assign('setting',string2array($info['setting']));
		$this->assign('info',$info);
        $this->display();
    }
	
    public function advert_type_html(){
        $this->display();
    }	

	public function advert_type_edit_html(){
	    $id=I('id');
	    $advert_m =M('advert_type');
	    $data['id']=$id;
	    $info=$advert_m->where($data)->find();
		$this->assign('setting',string2array($info['setting']));
		$this->assign('info',$info);
        $this->display();
    }
}
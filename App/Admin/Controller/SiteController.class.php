<?php
namespace Admin\Controller;
use Org\Util\Admin;
class SiteController extends Admin {


   function __construct()  //析构函数
   {  
        parent::__construct();
        
   }  
/*
-----------------------------------  
  网站列表  
-----------------------------------   
*/
    public function site_list(){
		
			          $pagesize=25;
					  $page=I('page',1,'intval');
			          $site =D('Site');
				 //------------------------------------菜单列表----------------------------------------	  
					  $record_count=$site->where($where)->count();//获取总记录数
					  $page=$record_count<$pagesize	?1:$page; 
					  if($record_count>0)
					  {
					      $info=$site->where($where)->order('id desc')->page($page,$pagesize)->select(); 
						  
						  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
						  $this->assign('page_show',$page_show);// 赋值分页输出
					  }
		
	                 $this->assign('info',$info);
			         $this->display();
    }
/*
-----------------------------------  
  网站编辑  
-----------------------------------   
*/
    public function site_edit(){
	
					  $id=I('id',1,'intval');
					  $site =D('Site'); 
       	     //------------------------------------验证数据正确性----------------------------------------			  
					  if(!$id)
					  {					 
						    $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
					  }	
       	     //------------------------------------验证数据正确性完----------------------------------------				  
					  if(IS_POST)
					  {
			 //------------------------------------编辑提交----------------------------------------   
								if ($site->create()){
									   $site->status=I('status',0,'intval');
									   
									   //-------------验证数据是否具有唯一性---------------------
									   $only['domain']=$site->domain;
									   $only['id']=array('NEQ',$id);
									   $info=$site->where($only)->find();
									   if($info)
									   {
									        $this->error(L('ADMIN_Site_Domain_Only'),"",$this->r_time);
									   
									   }
									   //-------------验证数据是否具有唯一性完成---------------------									   
									   if($site->save()!==false)
									   {
											
											$this->success(L('EDIT').L('success'),U("Admin/Site/site_list"),$this->r_time);
									   }
									   else
									   {
			
											$this->error(L('EDIT').L('ERR'),"",$this->r_time);
									   }
								}
								else
								{
									   $this->error($menu->getError(),"",$this->r_time);
								}			  
			//------------------------编辑提交完-------------------------------------					        
					  }
					  else
					  {
								 $where['id']=$id;
								 $info=$site->where($where)->find(); 
								 $this->assign('info',$info);
								 $this->display();					  
					  }

    }	
/*
-----------------------------------  
  网站添加  
-----------------------------------   
*/
    public function site_add(){
		
					  		  
					  if(IS_POST)
					  {
					            $site =D('Site'); 
			 //------------------------------------编辑提交----------------------------------------   
								if ($site->create()){
									   $site->status=I('status',0,'intval');
									   
									   //-------------验证数据是否具有唯一性---------------------
									   $only['domain']=$site->domain;
									   $info=$site->where($only)->find();
									   if($info)
									   {
									        $this->error(L('ADMIN_Site_Domain_Only'),"",$this->r_time);
									   
									   }
									   //-------------验证数据是否具有唯一性完成---------------------
									   if($site->add()!==false)
									   {
											
											$this->success(L('ADD').L('success'),U("Admin/Site/site_list"),$this->r_time);
									   }
									   else
									   {
											$this->error(L('ADD').L('ERR'),"",$this->r_time);
									   }
								}
								else
								{
									   $this->error($menu->getError(),"",$this->r_time);
								}			  
			//------------------------编辑提交完-------------------------------------					        
					  }
					  else
					  {
								 $this->display();					  
					  }

    }	
	
/*
-----------------------------------  
  网站删除  
-----------------------------------   
*/	
    public function  site_del(){  	
	          $id=I('id');
			  $site =M('site');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }			
                 $where['id']=$id;
				 $del_num=$site->where($where)->delete(); 
				 $this->success(L('ADMIN_Site_Del'),U("Admin/Site/site_list"),$this->r_time);	      
    }		
}
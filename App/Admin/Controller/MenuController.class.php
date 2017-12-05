<?php
namespace Admin\Controller;
use Org\Util\Admin;

class MenuController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
		$this->type=I('type')?I('type'):"admin";
   }  

    public function index(){
        $this->display();
    }	
/*
-----------------------------------  
   后台菜单添加	   
-----------------------------------   
*/	
    public function menu_add(){  
	           $parentid=I('parentid',0,'intval');
	          if(IS_POST)
			  {			  
			  //------------------------------------保存提交的菜单----------------------------------------
			          $menu =D('Menu');		
					  	   
						if ($menu->create()){
						$menu->url_p=trim($_POST['url_p']);
							   if($menu->add())
							   {
							        $this->success(L('ADD').L('success'),U('Admin/Menu/menu_list',array('type'=>$this->type)),$this->r_time);
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
			      //------------------------保存提交的菜单完--------------------------------------
			  }
			  else
			  {		 
			         $this->assign('menu_list',menu_check(0,0,$parentid,0,$this->type));
					 $this->assign('type',$this->type);	  	  
			         $this->display();			  
			  }        
    }	
/*
-----------------------------------   
   后台菜单列表   
-----------------------------------   
*/	
    public function menu_list(){ 
			          $pagesize=25;
					  $page=I('page',1,'intval');
					  $parentid=I('parentid',0,'intval');
					  $where['parent_id']=$parentid;
					  $where['type']=$this->type;
			          $menu =D('Menu');
				 //------------------------------------菜单列表----------------------------------------	  
					  $record_count=$menu->where($where)->count();//获取总记录数
					  $page=$record_count<$pagesize	?1:$page; 
					  if($record_count>0)
					  {
					      $info=$menu->where($where)->order('sort asc,id desc')->page($page,$pagesize)->select(); 
						  
						  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
						  $this->assign('page_show',$page_show);// 赋值分页输出
					  }
			      //------------------------获取父菜单信息--------------------------------------
				  if($parentid)
				  {
				     unset($where);
				     $where['id']=$parentid;
				     $parent_menu=$menu->where($where)->find();
					 $this->assign('parent_menu',$parent_menu);
				  }
				   //------------------------获取父菜单信息完--------------------------------------
				     $this->assign('type',$this->type);	 
				     $this->assign('parentid',$parentid);
	                 $this->assign('info',$info);
					 $this->assign('parent_menu_nav',parents($parentid,'menu',array('title','id')));
			         $this->display();
    }	
/*
-----------------------------------   
   后台菜单编辑	   
-----------------------------------   
*/	
    public function menu_edit(){ 

	          $id=I('id',0,'intval');
			  $menu =D('Menu');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
			  //------------------------------------编辑提交的菜单----------------------------------------   
						if ($menu->create()){
						     $menu->status=I('status',0,'intval');
							 $menu->url_p=trim($_POST['url_p']);
							   if($menu->save()!==false)
							   {
							        
							        $this->success(L('EDIT').L('success'),U('Admin/Menu/menu_list',array('type'=>$this->type)),$this->r_time);
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
			      //------------------------编辑提交的菜单完--------------------------------------
			  }
			  else
			  {		  
					 $where['id']=$id;
				     $info=$menu->where($where)->find();
					 
					 if($info)
					 {
					      $this->assign('info',$info);
					      $this->assign('menu_list',menu_check(0,0,$info['parent_id'],$id,$this->type));	
					 }
					 else
					 {					      
					      $this->error(L('ADMIN_Edit_Null'),"",$this->r_time);	
					 }
			         $this->assign('type',$this->type);	  
			         $this->display();			  
			  }       
    }

/*
-----------------------------------  
   后台菜放删除  
-----------------------------------   
*/	
    public function  menu_del(){  	
	          $id=I('id');
			  $del_num=0;//删除菜单的条数
			  $menu =D('Menu');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }			
			    if(is_array($id))// 多ID 批量删除
				{
						foreach ($id as $k=>$v) 
						{
                              $del_num=$del_num+menu_submenu_del($v);
						}
						$this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Admin/Menu/menu_list',array('type'=>$this->type)),$this->r_time);								 
				}
                else// 只删除一个菜单
				{
				       $del_num=menu_submenu_del($id); 
					   $this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Admin/Menu/menu_list',array('type'=>$this->type)),$this->r_time);	   
				}     
    }		
/*
-----------------------------------   
   后台菜单批量处理	  
-----------------------------------   
*/	
    public function menu_all(){  	
			  	  
	          if(IS_POST)
			  {
			  //------------------------------------编辑提交的菜单----------------------------------------   
								$this->menu_del();
			  //------------------------编辑提交的菜单完--------------------------------------
			  }
			  else
			  {		 
					 $this->menu_list();			  
			  }
    }
	
	
	
	
	
}

?>
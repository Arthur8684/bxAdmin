<?php
namespace Admin\Controller;
use Org\Util\Admin;

class AuthController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  

    public function index(){
        $this->display();
    }	
/*
-----------------------------------  
  权限规则添加	   
-----------------------------------   
*/	
    public function auth_add(){  
	          if(IS_POST)
			  {		
					   $title=I('post.title',"",'trim');
					   $m=I('post.auth_m',"",'trim');
					   $c=I('post.auth_c',"",'trim');
					   $a=I('post.auth_a',"",'trim');
					   if(!$m || !$c || !$a)
					   {
						  $this->error(L('ADMIN_Auth_Err_1'),"",$this->r_time);
					   }
                       
					   if(!$title)
					   {
						   $this->error(L('ADMIN_Auth_Err_2'),"",$this->r_time);
					   }
					   $_POST['name']=$_POST['auth_p']?$m."/".$c."/".$a."?".$_POST['auth_p']:$m."/".$c."/".$a;
			  //------------------------------------保存提交的管理员----------------------------------------
			          $auth_rule =M('auth_rule');		
						if ($auth_rule->create()){
					         	$auth_rule->status=I('status',0,'intval');
								$auth_rule->condition_open=I('condition_open',0,'intval');
								$auth_rule->class_id=I('class_id',0,'intval');
							   if($auth_rule->add())
							   {
							        $this->success(L('ADD').L('success'),U('Admin/Auth/auth_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($auth_rule->getError(),"",$this->r_time);
						}			  
			      //------------------------保存提交完--------------------------------------
			  }
			  else
			  {	
			         $auth_class=$this->get_auth_class();
					 $this->assign('auth_class',$auth_class);		 
			         $this->display();			  
			  }        
    }
	/*
    -----------------------------------
      规则列表
    -----------------------------------
    */
    public function auth_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$auth_rule =M('auth_rule');
		$where=array();
		if(I('auth_m')) $where['auth_m']=array('like',I('auth_m'));
		if(I('auth_c')) $where['auth_c']=array('like',I('auth_c'));
		if(I('auth_a')) $where['auth_a']=array('like',I('auth_a'));
		if(I('status')!="") $where['status']=I('status');
		$record_count=$auth_rule->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$auth_rule->where($where)->page($page,$pagesize)->order('sort asc ,id desc')->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
			$this->assign('info',$info);
			$auth_class=M('auth_rule_class')->getField('id,title');
		    $this->assign('auth_class',$auth_class);
		}	
		$this->display();
    }	
/*
-----------------------------------   
   规则编辑	   
-----------------------------------   
*/	
    public function auth_edit(){  
	          $id=I('id',0,'intval');
			  $auth_rule =M('auth_rule');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
					   $title=I('post.title',"",'trim');
					   $m=I('post.auth_m',"",'trim');
					   $c=I('post.auth_c',"",'trim');
					   $a=I('post.auth_a',"",'trim');				   
					   if(!$m || !$c || !$a)
					   {
						  $this->error(L('ADMIN_Auth_Err_1'),"",$this->r_time);
					   }
					   if(!$title)
					   {
						   $this->error(L('ADMIN_Auth_Err_2'),"",$this->r_time);
					   }
                       $_POST['name']=$_POST['auth_p']?$m."/".$c."/".$a."?".$_POST['auth_p']:$m."/".$c."/".$a;
					  if ($auth_rule->create()){
							  $auth_rule->status=I('status',0,'intval');
							  $auth_rule->condition_open=I('condition_open',0,'intval');
							  $auth_rule->class_id=I('class_id',0,'intval');	
							   if($auth_rule->save()!==false)
							   {
							        $this->success(L('EDIT').L('success'),U("Admin/Auth/auth_list"),$this->r_time);
							   }
							   else
							   {
							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($auth_rule->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		  
					 $where['id']=$id;
				     $info=$auth_rule->where($where)->find();
					 if($info)
					 {
					      $auth_class=$this->get_auth_class();
						  $this->assign('auth_class',$auth_class);					      
					      $this->assign('info',$info);	
					 } 
			         $this->display();			  
			  }       
    }

/*
-----------------------------------  
   规则删除  
-----------------------------------   
*/	
    public function  auth_del(){  	
	          $id=I('id');
			  $del_num=0;
			  $auth_rule =M('auth_rule');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }			
                 if(!is_array($id))	$id=array($id)	;
                 $where['id']=array('in',$id);
				 $del_num=$auth_rule->where($where)->delete(); 
				 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Admin/Auth/auth_list"),$this->r_time);	      
    }			
	
/*
-----------------------------------   
   规则分类列表 
-----------------------------------   
*/	
    public function auth_class_list(){  	
			  $auth_rule_class =M('auth_rule_class');
			  $pagesize=25;	
			  $page=I('page',1,'intval');			  	  
	          if(IS_POST)
			  {

			  }
			  else
			  {		
			        $record_count=$auth_rule_class->where($where)->count();//获取总记录数
					$page=$record_count<$pagesize?1:$page;  
					
					if($record_count>0)
					{
					  $info=$auth_rule_class->where($where)->order('sort_num asc,id desc')->page($page,$pagesize)->select(); 
					  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
					  $this->assign('page_show',$page_show);// 赋值分页输出
					}
					$this->assign('info',$info);
					$this->display();		  
			  }
    }		
		
		
/*
-----------------------------------   
   规则分类添加
-----------------------------------   
*/	
    public function auth_class_add(){  	
			  $auth_rule_class =M('auth_rule_class');			  	  
	          if(IS_POST)
			  {
					 $title=I('post.title',"",'trim');
					 //===========================检查会员组名称======================================
					 if(!$title)
					 {
						$this->error(L('ADMIN_Auth_Err_0'),"",$this->r_time);
					 }
					  
			  //------------------------------------保存提交的会员组----------------------------------------
						if ($auth_rule_class->create()){
								$auth_rule_class->sort_num=I('sort_num',0,'intval');
							   if($auth_rule_class->add())
							   {
							        $this->success(L('ADD').L('success'),U('Admin/Auth/auth_class_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($auth_rule_class->getError(),"",$this->r_time);
						}			  
			      //------------------------保存提交的用户完--------------------------------------
			  }
			  else
			  {
				    $class=M('auth_rule_class')->where("parent_id=0")->order('sort_num asc,id desc')->select();
					$this->assign('class',$class);
					$this->display();		  
			  }
    }			
/*
-----------------------------------   
   规则分类编辑	   
-----------------------------------   
*/	
    public function auth_class_edit(){  
	          $id=I('id',0,'intval');
			  $auth_rule_class =M('auth_rule_class');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
					   $title=I('post.title',"",'trim');
					   //===========================检查会员组名称======================================
					   if(!$title)
					   {
						  $this->error(L('ADMIN_Auth_Err_0'),"",$this->r_time);
					   }
			  //------------------------------------编辑提交的会员组----------------------------------------   
						if ($auth_rule_class->create()){
								$auth_rule_class->sort_num=I('sort_num',0,'intval');
							   if($auth_rule_class->save()!==false)
							   {
							        
							        $this->success(L('EDIT').L('success'),U("Admin/Auth/auth_class_list"),$this->r_time);
							   }
							   else
							   {

							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($auth_rule_class->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的会员完--------------------------------------
			  }
			  else
			  {		 	   
					 $where['id']=$id;
				     $info=$auth_rule_class->where($where)->find();
					 if($info)
					 {
				          $class=M('auth_rule_class')->where("parent_id=0")->order('sort_num asc,id desc')->select();
					      $this->assign('class',$class);						 
					      $this->assign('info',$info);	
						  $this->assign('id',$id);
					 }
			         $this->display();			  
			  }       
    }
/*
-----------------------------------  
   规则分类删除  
-----------------------------------   
*/	
    public function  auth_class_del(){  	
	          $id=I('id');
			  $del_num=0;//删除会员的条数
			  $auth_rule_class =M('auth_rule_class');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }			
                 $where['id']=$id;
				 $del_num=$auth_rule_class->where($where)->delete(); 
				 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Admin/Auth/auth_class_list"),$this->r_time);	      
    }						
		
    public function  get_auth_class(){  	
			     $auth_rule_class =M('auth_rule_class');			  		
                 $where['parent_id']=0;
				 $info=$auth_rule_class->where($where)->select();
				 return   $info;
    }				
}
?>
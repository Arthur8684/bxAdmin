<?php
namespace Admin\Controller;
use Org\Util\Admin;
class UserController extends Admin {


   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function user_list(){
	    $pagesize=15;	
		$page=I('page',1,'intval');
		$username=I('user',"",'trim');
	    $user =M('User');
		if($username){
		    $where['user']=$username;
			$where['id']=$username;
			$where['cart']=$username;
			$where['_logic'] = 'or';
			}
		$record_count=$user->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
        $user_total=$user->count();
		if($record_count>0)
		{
		  $info=$user->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('info',$info);
		$this->assign('user_total',$user_total);
		$this->assign('record_count',$record_count);
        $this->display();
    }

/*
-----------------------------------  
   后台会员添加	   
-----------------------------------   
*/	
    public function user_add(){  
	          if(IS_POST)
			  {		
					   $user=I('post.user',"",'trim');
					   $pass=I('post.pass',"",'trim');
					   $confirm_pass=I('post.confirm_pass',"",'trim');
					   $email=I('post.email',"",'trim');
					   fields('user');
					   //===========================检查用户账号密码不能为空======================================
					   if($user=="" || $pass=="")
					   {
						  $this->error(L('ADMIN_U_Login_Err_1'),"",$this->r_time);
					   }
					   //===========================检查用户密码和确认密码是否一致======================================
					   if($pass!=$confirm_pass)
					   {
						   $this->error(L('ADMIN_U_Login_Err_4'),"",$this->r_time);
					   }
					   //===========================检查管理邮箱格式======================================
					    $pattern = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/i";
					   if($email!="" && !preg_match($pattern,$email))
					   {
						   $this->error(L('ADMIN_U_Login_Err_5'),"",$this->r_time);
					   }  
			  //------------------------------------保存提交的用户----------------------------------------
			          $user =M('user');		
					  $string=new \Org\Util\String();//创建string对象
					  $pre=$string->randString(6,0); //获得6位随机字符串

						if ($user->create()){
					        	$user->status=I('status',0,'intval');
							    $user->group_id=I('group_id',0,'intval');
								$user->addtime=time();
								$user->pass_pre=$pre;// 密码随机前缀
								$user->pass=md5($pass.$pre);// 密码随机前缀
							   if($user->add())
							   {
							        $this->success(L('ADD').L('success'),U('Admin/User/user_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($user->getError(),"",$this->r_time);
						}			  
			      //------------------------保存提交的用户完--------------------------------------
			  }
			  else
			  {	
					 $group_list=group_list_();
				     $this->assign('group_list',$group_list);			  	 
			         $this->display();			  
			  }        
    }
	
/*
-----------------------------------   
   后台会员编辑	   
-----------------------------------   
*/	
    public function user_edit(){  
	          $id=I('id',0,'intval');
			  $user =M('user');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
					   $pass=I('post.pass',"",'trim');
					   $confirm_pass=I('post.confirm_pass',"",'trim');
					   $email=I('post.email',"",'trim');
					   fields('user','',$id);
					   if($pass!="" && $pass!=$confirm_pass)
					   {
						   $this->error(L('ADMIN_U_Login_Err_4'),"",$this->r_time);
					   }
					   
					   if($pass=="")
					   {
					        unset($_POST['pass']);
					   }
					   else
					   {
							  $string=new \Org\Util\String();//创建string对象
							  $pre=$string->randString(6,0); //获得6位随机字符串
							  $_POST['pass_pre']=$pre;
							  $_POST['pass']=md5($pass.$pre);
							  					   
					   }
					   //===========================检查管理邮箱格式======================================
					    $pattern = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/i";
					   if($email!="" && !preg_match($pattern,$email))
					   {
						   $this->error(L('ADMIN_U_Login_Err_5'),"",$this->r_time);
					   }  					   			  
			            
			  //------------------------------------编辑提交的会员----------------------------------------   
						if ($user->create()){
						       $user->status=I('status',0,'intval');
							   $user->group_id=I('group_id',0,'intval');
							   if($user->save()!==false)
							   {
							        
							        $this->success(L('EDIT').L('success'),U("Admin/User/User_list"),$this->r_time);
							   }
							   else
							   {

							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($user->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的会员完--------------------------------------
			  }
			  else
			  {		  
					 $where['id']=$id;
				     $info=$user->where($where)->find();
					 
					 if($info)
					 {
					      $group_list=group_list_();
						  $this->assign('group_list',$group_list);
					      $this->assign('info',$info);	
					 }
					 else
					 {					      
					      $this->error(L('ADMIN_Edit_Null'),"",$this->r_time);	
					 }
			           
			         $this->display();			  
			  }       
    }

/*
-----------------------------------  
   后台会员删除  
-----------------------------------   
*/	
    public function  user_del(){  	
	          $id=I('id');
			  $del_num=0;//删除会员的条数
			  $user =M('user');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }			
                 $where['id']=$id;
				 $del_num=$user->where($where)->delete(); 
				 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Admin/User/user_list"),$this->r_time);	      
    }
	
	
	
/*
-----------------------------------   
   后台用户批量处理	  
-----------------------------------   
*/	
    public function user_all(){  	
	          $id=I('id');
			  $del_num=0;//删除会员的条数
			  $user =M('user');				  	  
	          if(IS_POST)
			  {
			  
					 if(!$id)
					 {					 
						   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
					 }
					$str_id=implode(",",$id);   
					$del_num=$user->delete($str_id);
					$this->success(L('DEL_RECORD',array('num'=>$del_num)),"",$this->r_time);
			  }
			  else
			  {		 
					 $this->user_list();			  
			  }
    }	
	
	
/*
-----------------------------------   
   后台用户组  
-----------------------------------   
*/	
    public function user_group_list(){ 

			  $group =M('group');
			  $pagesize=25;	
			  $page=I('page',1,'intval');			  	  
	          if(IS_POST)
			  {

			  }
			  else
			  {		
			        $record_count=$group->where($where)->count();//获取总记录数
					$page=$record_count<$pagesize?1:$page;  
					
					if($record_count>0)
					{
					  $info=$group->where($where)->order('sort_num asc,id desc')->page($page,$pagesize)->select(); 
					  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
					  $this->assign('page_show',$page_show);// 赋值分页输出
					}
					$this->assign('info',$info);
					$this->display();		  
			  }
    }		
		
		
/*
-----------------------------------   
   后台用户组添加
-----------------------------------   
*/	
    public function user_group_add(){
		//echo get_recommend_n(10,4,2);  	
			  $group =M('group');				  	  
	          if(IS_POST)
			  {
			  
					   $name=I('post.name',"",'trim');
					   
					   //===========================检查会员组名称======================================
					   if(!$name)
					   {
						  $this->error(L('ADMIN_U_Group_Err_Name_Info'),"",$this->r_time);
					   }
					  
			  //------------------------------------保存提交的会员组----------------------------------------
						if ($group->create()){
					        	$group->status=I('status',0,'intval');
								$group->is_reg=I('is_reg',0,'intval');
								$group->is_login=I('is_login',0,'intval');
								$group->is_promote=I('is_promote',0,'intval');
								$group->is_verify=I('is_verify',0,'intval');
								$group->price=I('price',0,'floatval');
								$group->sort_num=I('sort_num',0,'intval');
								$group->condition=I('condition','','trim');
							   if($group->add())
							   {
							        user_group_set_config();
							        $this->success(L('ADD').L('success'),U('Admin/User/user_group_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($group->getError(),"",$this->r_time);
						}			  
			      //------------------------保存提交的用户完--------------------------------------
			  }
			  else
			  {
					$config=FF('Conf/config','',COMMON_PATH);
					$point_type=$config['point_type'];
					$auth=auth_list('user');
				    $user_group_button=$this->user_group_button();
					$this->assign('user_group_button',$user_group_button);
					$this->assign('auth',$auth);	
                    $this->assign('point_type',$point_type);	
					$this->display();		  
			  }
    }			
/*
-----------------------------------   
   后台会员组编辑	   
-----------------------------------   
*/	
    public function user_group_edit(){  
	          $id=I('id',0,'intval');
			  $group =M('group');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
					   $name=I('post.name',"",'trim');
					   //===========================检查会员组名称======================================
					   if(!$name)
					   {
						  $this->error(L('ADMIN_U_Group_Err_Name_Info'),"",$this->r_time);
					   }
			  //------------------------------------编辑提交的会员组----------------------------------------   
						if ($group->create()){
					        	$group->status=I('status',0,'intval');
								$group->is_reg=I('is_reg',0,'intval');
								$group->is_login=I('is_login',0,'intval');
								$group->is_promote=I('is_promote',0,'intval');
								$group->is_verify=I('is_verify',0,'intval');
								$group->price=I('price',0,'floatval');
								$group->sort_num=I('sort_num',0,'intval');
								$group->condition=I('condition','','trim');
							   if($group->save()!==false)
							   {
							        user_group_set_config();
							        $this->success(L('EDIT').L('success'),U("Admin/User/User_group_list"),$this->r_time);
							   }
							   else
							   {

							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($group->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的会员完--------------------------------------
			  }
			  else
			  {		 
			     //--------------------------获取积分种类列表-------------------------------------
					$config=FF('Conf/config','',COMMON_PATH);
					$point_type=$config['point_type'];
					$this->assign('point_type',$point_type);	
			     //--------------------------获取积分种类列表完------------------------------------		   
					 $where['id']=$id;
				     $info=$group->where($where)->find();
					 
					 if($info)
					 {
					      $this->assign('info',$info);	
						  $this->assign('id',$id);
						  $auth=auth_list('user');
					      $this->assign('auth',$auth);	
						  $user_group_button=$this->user_group_button();
					      $this->assign('user_group_button',$user_group_button);					  
					 }
					 else
					 {					      
					      $this->error(L('ADMIN_Edit_Null'),"",$this->r_time);	
					 }
			           
			         $this->display();			  
			  }       
    }
/*
-----------------------------------  
   后台会员组删除  
-----------------------------------   
*/	
    public function  user_group_del(){  	
	          $id=I('id');
			  $del_num=0;//删除会员的条数
			  $group =M('group');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }			
                 $where['id']=$id;
				 $del_num=$group->where($where)->delete(); 
				 user_group_set_config();
				 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Admin/User/user_group_list"),$this->r_time);	      
    }	

/*
-----------------------------------  
   会员升级条件按钮  
-----------------------------------   
*/	
    public function  user_group_button(){  	
	       $data=array();
		   $data[0]['money']=array('text'=>C('money_name'),'value'=>'[money]','describe'=>L('money_describe'));
		   $data[0]['amount']=array('text'=>C('amount_name'),'value'=>'[amount]','describe'=>L('amount_describe'));
		   $data[0]['point']=array('text'=>C('point_name'),'value'=>'[point]','describe'=>L('point_describe'));
		   $data[0]['qrcode_open']=array('text'=>L('QRCODE_OPEN'),'value'=>'[qrcode_open]','describe'=>L('qrcode_open_describe'));
		   $data[0]['promote_point']=array('text'=>L('PROMOTE_POINT'),'value'=>'[promote_point]','describe'=>L('promote_point_describe'));
		   $data[0]['group_id']=array('text'=>L('Group'),'value'=>'[group_id]','describe'=>L('group_describe'));
		   $data[0]['is_real_name']=array('text'=>L('real_name'),'value'=>'[is_real_name]','describe'=>L('real_name_describe'));
		   $data[0]['is_bank_auth']=array('text'=>L('bank_auth'),'value'=>'[is_bank_auth]','describe'=>L('bank_auth_describe'));
		   
		   $data[1]['year_consumption']=array('text'=>L('YEAR_CONSUMPTION'),'value'=>'[year_consumption]','describe'=>L('year_consumption_describe'));
		   $data[1]['month_consumption']=array('text'=>L('MONTH_CONSUMPTION'),'value'=>'[month_consumption]','describe'=>L('month_consumption_describe'));
		   $data[1]['day_consumption']=array('text'=>L('DAY_CONSUMPTION'),'value'=>'[day_consumption]','describe'=>L('day_consumption_describe'));
		   $data[1]['total_consumption']=array('text'=>L('TOTAL_CONSUMPTION'),'value'=>'[total_consumption]','describe'=>L('total_consumption_describe'));
		   
		   $data[2]['year_order']=array('text'=>L('YEAR_ORDER'),'value'=>'[year_order]','describe'=>L('year_order_describe'));
		   $data[2]['month_order']=array('text'=>L('MONTH_ORDER'),'value'=>'[month_order]','describe'=>L('month_order_describe'));
		   $data[2]['day_order']=array('text'=>L('DAY_ORDER'),'value'=>'[day_order]','describe'=>L('day_order_describe'));
		   $data[2]['total_order']=array('text'=>L('TOTAL_ORDER'),'value'=>'[total_order]','describe'=>L('total_order_describe'));	
		   	
		   $data[3]['year_recommend']=array('text'=>L('YEAR_RECOMMEND'),'value'=>'[year_recommend]','describe'=>L('year_recommend_describe'));
		   $data[3]['month_recommend']=array('text'=>L('MONTH_RECOMMEND'),'value'=>'[month_recommend]','describe'=>L('month_recommend_describe'));
		   $data[3]['day_recommend']=array('text'=>L('DAY_RECOMMEND'),'value'=>'[day_recommend]','describe'=>L('day_recommend_describe'));
		   $data[3]['total_recommend']=array('text'=>L('TOTAL_RECOMMEND'),'value'=>'[total_recommend]','describe'=>L('total_recommend_describe'));
		   $data[3]['recommend_n']=array('text'=>L('RECOMMEND_N'),'value'=>'[*3]','describe'=>L('recommend_n_describe'));
		   $data[3]['recommend_n_num']=array('text'=>L('RECOMMEND_N_NUM'),'value'=>'[?3]','describe'=>L('recommend_n_num_describe'));
		   $data[3]['recommend_total']=array('text'=>L('RECOMMEND_TOTAL'),'value'=>'[*0]','describe'=>L('recommend_total_describe'));
		   
		   $data[4]['||']=array('text'=>L('OR_'),'value'=>'||','describe'=>L('or_describe'));
		   $data[4]['&&']=array('text'=>L('AND_'),'value'=>'&&','describe'=>L('and_describe'));
		   $data[4]['!']=array('text'=>L('NO_'),'value'=>'!','describe'=>L('no_describe'));	
		   	   
		   $data[4]['+']=array('text'=>'+','value'=>'+','describe'=>L('+_describe'));
		   $data[4]['-']=array('text'=>'-','value'=>'-','describe'=>L('-_describe'));
		   $data[4]['*']=array('text'=>'*','value'=>'*','describe'=>L('*_describe'));
		   $data[4]['/']=array('text'=>'/','value'=>'/','describe'=>L('/_describe'));
		   $data[4]['=']=array('text'=>'=','value'=>'=','describe'=>L('=_describe'));
		   $data[4]['==']=array('text'=>'==','value'=>'==','describe'=>L('==_describe'));
		   $data[4]['!=']=array('text'=>'!=','value'=>'!=','describe'=>L('!=_describe'));
		   $data[4]['<']=array('text'=>'<','value'=>'<','describe'=>L('<_describe'));
		   $data[4]['>']=array('text'=>'>','value'=>'>','describe'=>L('>_describe'));
		   $data[4]['(']=array('text'=>'(','value'=>'(','describe'=>L('(_describe'));
		   $data[4][')']=array('text'=>')','value'=>')','describe'=>L(')_describe'));
		   

		   
		   $group=M('group')->field('id,name')->select();
		   foreach($group as $k=>$v)
		   {
			   $data[6][$v['id']]=array('text'=>L('RECOMMEND_PUSH')."[".$v['name']."]",'value'=>'[*1|'.$v['id'].']','describe'=>L('recommend_push_describe',array('group_name'=>$v['name'])));
			   $data[7][$v['id']]=array('text'=>L('RECOMMEND_PUSH_N')."[".$v['name']."]",'value'=>'[*3|'.$v['id'].']','describe'=>L('recommend_push_n_describe',array('group_name'=>$v['name'])));
			   $data[8][$v['id']]=array('text'=>L('RECOMMEND_PUSH_N_NUM')."[".$v['name']."]",'value'=>'[?3|'.$v['id'].']','describe'=>L('recommend_push_n_num_describe',array('group_name'=>$v['name'])));
			   $data[9][$v['id']]=array('text'=>L('RECOMMEND_PUSH_N_TOTAL')."[".$v['name']."]",'value'=>'[*0|'.$v['id'].']','describe'=>L('recommend_push_n_total_describe',array('group_name'=>$v['name'])));
			   
		   }
		   return $data;
		   
		      
    }	
			
}
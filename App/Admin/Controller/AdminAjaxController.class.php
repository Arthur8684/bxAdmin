<?php
namespace Admin\Controller;
use Org\Util\Admin;

class AdminAjaxController extends Admin {

/*
-----------------------------------   
   后台菜单开关通过AJAX修改	   
-----------------------------------   
*/	
    public function menu_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $menu =D('Menu');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的菜单----------------------------------------   
						if ($menu->create($data)){
							   if($menu->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $menu->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的菜单完--------------------------------------    
    }

    public function admin_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $admin =M('admin');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的数据----------------------------------------   
						if ($admin->create($data)){
							   if($admin->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $admin->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    }
	
	
    public function user_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $user =M('user');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的数据----------------------------------------   
						if ($user->create($data)){
							   if($user->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $user->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    }	
	
	     public function ShopAjax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $shop =M('shop');
			  $get=I('get.');		  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的数据----------------------------------------   
						if ($shop->create($data)){
							   if($shop->save()!==false)
							   {							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $user->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    } 
    public function user_group_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $group =M('group');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的数据----------------------------------------   
						if ($group->create($data)){
							   if($group->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $user->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    }	
    public function admin_role_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $role =M('role');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的数据----------------------------------------   
						if ($role->create($data)){
							   if($role->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $user->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    }	
	    public function site_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $site =M('site');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的数据----------------------------------------   
					  if ($site->create($data)){
							   if($site->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $site->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    }	
	
/*
   **检查网站数据表里的唯一性
   ** content返回为1表示已经存在，0表示不存在
*/	
	
	    public function site_check_only(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $site =M('site');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
			  //------------------------------------编辑提交的数据----------------------------------------   
					  if ($site->create($data)){
					           if($data['id'])
							   {
							       $data['id']=array('NEQ',$data['id']);
							   }
					           $info=$site->where($data)->find();
							   if($info)
							   {
							        
										 $return['err']  = 1;
										 $return['content'] ="1";	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 0;
										 $return['content'] ="0";	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] ="2";	 
										 $this->ajaxReturn($return);														       
						}			  
			  //------------------------编辑提交的数据完--------------------------------------    
    }	
/*
-----------------------------------   
   权限分类修改	   
-----------------------------------   
*/	
    public function auth_class(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $auth_rule_class =D('auth_rule_class');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的菜单----------------------------------------   
						if ($auth_rule_class->create($data)){
							   if($auth_rule_class->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $auth_rule_class->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的菜单完--------------------------------------    
    }	
/*
-----------------------------------   
   权限修改	   
-----------------------------------   
*/	
    public function auth(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $auth_rule =D('auth_rule');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的权限----------------------------------------   
						if ($auth_rule->create($data)){
							   if($auth_rule->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $auth_rule->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的权限完--------------------------------------    
    }		
	
}

?>
<?php
namespace Message\Controller;
use Think\Controller;

class AjaxController extends Controller {

     public function is_user_exist(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $user=I('receive');
			  if(is_numeric($user))
			  {
				  $data['id']=$user;
			  }
			  else
			  {
				  if($user) $data['user']=$user;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data)
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('Message_Err_2');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------
			   $user_info=M('user')->where($data)->find();
			   if($user_info)
			   {
						 $return['err']  = 0;
						 $return['content'] = $user_info['nickname']?$user_info['nickname']." : ( ".$user_info['user']." )":$user_info['user'];	 
						 $this->ajaxReturn($return);				   
			   }
			   else
			   {
						 $return['err']  = 1;
						 $return['content'] = L('Message_Err_3');	 
						 $this->ajaxReturn($return);			   
			   }   
    }
	
}

?>
<?php
namespace System\Controller;
use Think\Controller;
class MobileController extends Controller{

//生成手机验证码
    public function mobile_code(){
        
		$message_inter=C('message_inter')?C('message_inter'):0;
        $mobile_num=I('mobile_num');
		if(!$mobile_num)
		{
			 $return['err']  = 1;
             $return['content'] = L('MOBILE_ERR_1');	 
			 $this->ajaxReturn($return);
			 exit();
		}
		$code=S('mobile_'.$mobile_num);
		if($code)
		{
			 $return['err']  = 1;
             $return['content'] = L('ADMIN_System_Mobile_Err_2');	 
			 $this->ajaxReturn($return);
			 exit();			
		}
        switch ($message_inter)
		{
			case 1:
			  $mobile=mobile_code($mobile_num);
			  if(1==$mobile)
			  {
				   $return['err']  = 0;
				   $return['content'] = L('ADMIN_System_Mobile_Err_0');	 
				   $this->ajaxReturn($return);				  
			  }
			  else
			  {
				   $return['err']  = 1;
				   $return['content'] = L('ADMIN_System_Mobile_Err_1');	 
				   $this->ajaxReturn($return);					  
			  }
			  break;  
			default:
				   $return['err']  = 1;
				   $return['content'] = L('ADMIN_System_Mobile_Err_7');	 
				   $this->ajaxReturn($return);		
		}
  
		
    }	
//验证手机验证码
	function check_mobile_code()
	{ 
	      $mobile_num=I('mobile_num');
		  $post_code=I('mobile_code');
		  //===========================无手机号======================================
		  if(!$mobile_num)
		  {
			 $return['err']  = 1;
             $return['content'] = L('MOBILE_ERR_1');	 
			 $this->ajaxReturn($return);
			 exit();			  
		  }
		  //===========================无手机号完======================================
		  
		  //===========================手机验证码的字符串======================================
		  $code=S('mobile_'.$mobile_num);
		  if(!$code)
		  {
			 $return['err']  = 1;
             $return['content'] = L('ADMIN_System_Mobile_Err_3');	 
			 $this->ajaxReturn($return);
			 exit();				  
		  }
		   //===========================手机验证码的字符串完======================================
		  if($code==$post_code)
		  {
			 $return['err']  = 0;
             $return['content'] = L('ADMIN_System_Mobile_Err_4');	 
			 $this->ajaxReturn($return);
			 exit();
		  }
		  else
		  {
			 $return['err']  = 1;
             $return['content'] = L('ADMIN_System_Mobile_Err_5');	 
			 $this->ajaxReturn($return);
			 exit();
		  }
	}	
}
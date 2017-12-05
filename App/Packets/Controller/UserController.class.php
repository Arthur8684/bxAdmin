<?php
namespace Packets\Controller;
use Org\Util\User;
class UserController extends User {
   function packets_list()
   {
	   $userid=session('user.id');
	   $packets=get_packets($userid);
	   $this->assign('packets',$packets);
       $this->display();	   
   }	

   function packets_receive()
   {
	   $id=I('id');
	   $userid=session('user.id');
	   $return_data=set_packets($id,$userid);
	   
	   if($return_data==0)
	   {
		   $this->success(L('ADMIN_Packets_Get').L('success'),'',$this->r_time);
	   }else
	   {
		   $this->error(L('ADMIN_Packets_Err_'.$return_data),"",$this->r_time);
	   }
        	   
   }
}
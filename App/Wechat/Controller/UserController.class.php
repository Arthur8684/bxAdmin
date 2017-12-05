<?php
namespace Wechat\Controller;
use Org\Util\User;
use Wechat\Util\WechatAuth;
class UserController extends User{
    public function user_setting(){
		if(IS_POST)
		{	
			$id=I('id');
		    $post=I('post.');
			FF('wechat/wechat_user_'.$id.'',$post);
		}
		$C=FF("wechat/wechat_user"); 
		$user=$this->userinfo;	
		if($user['qrcode_open']==1 || $C['img_price']==0){
			  if($C['user_img_setting']){
					$B=FF("wechat/wechat_user_".$user['id']); 
					if($B) $C=$B;
					$this->assign('C',$C);
					$this->assign('userid',$user['id']);
					$this->assign('page_title',L('Base_Setting'));	
					$this->display();
			  }else
			  {
			        $this->error(L('Menu_NO_play_1'),U('User/Index/index'),$this->r_time);
			  }
		}else
		{
		    $this->error(L('Wechat_Img_Buy_info'),U('Wechat/User/qrcode_buy'),$this->r_time);	
		}
    }
    public function qrcode_buy(){
		$C=FF("wechat/wechat_user"); 
		$user=$this->userinfo;
		 if($user['qrcode_open']==1 || $C['img_price']==0){
		 $this->error(L('Wechat_user_payed'),U('User/Index/index'),$this->r_time);
			  }else{
			$this->assign('user',$user);
			$this->assign('C',$C);
			$this->assign('page_title',L('Wechat_Img_Buy'));	
			$this->display(); 
			}
		}	
	
}

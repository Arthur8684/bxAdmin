<?php
namespace Wechat\Controller;
use Org\Util\Admin;
use Wechat\Util\WechatAuth;
class SettingController extends Admin{
    public function base_setting(){
		if(IS_POST)
		{
		    $post=I('post.');
			FF('Conf/config',$post,MODULE_PATH);
			C($post);
		}
		$this->display();
    }
	
	
	public function user_setting(){
		if(IS_POST)
		{
			if($_FILES)
			{
		         $file_size=1000*1024;
		         $types=array("jpg");
				 $path="upload/water/";
				  $upload = new \Think\Upload();// 实例化上传类
				  $upload->maxSize=$file_size;
				  $upload->exts=$types;
				  $upload->rootPath=$path;
				  $upload->replace = true;
				  $upload->saveName ="wechat_seo_img";
				  $upload->autoSub = false;	
				  $info   =   $upload->upload(); 
				  $this->del_img(); 
			}
		    $post=I('post.');
			FF('wechat/wechat_user',$post);
			$this->redirect('Wechat/Setting/user_setting', 0);
		}
		$C=FF("wechat/wechat_user"); 
		$this->assign('C',$C);
		$this->display();
    }
	
	public function menu_setting(){
	       C('TOKEN_ON',false); //关闭表单令牌
           if(IS_POST)
		   {
		         if($_POST['button'])
				 {
				      FF("wechat/wechat_menu", $_POST['button']); 
				      $B=$_POST['button'];
					  //**********************foreach开始**********************************
				      foreach($B as $k => $v)
					  {
					        if($v['name'])
							{
						      	$S=$v['sub_button'];
								    ////////////////////////////IF开始///////////////////////////////////////
									if($S)
									{
										foreach($S as $key => $value) 
										{
											if($value['name'])
											{  
												  $sub_array['name']=$value['name'];
												  $sub_array['type']=$value['type'];
												  $value['type']=="click"?$sub_array['key']=$value['key']:$sub_array['url']=$value['key'];
												  $sub_button[]=$sub_array;
											}
										}                           
									}
									
									////////////////////////////IF开始///////////////////////////////////////
									if($sub_button)	 
									{
									    $menu['name']=	$v['name'];	
										$menu['sub_button']=$sub_button;
																			
									}
									else
									{
									    $menu['name']=	$v['name'];	
										$menu['type']=	$v['type'];	
										$v['type']=="click"?$menu['key']=$v['key']:$menu['url']=$v['key'];
									}
									$button[]=$menu;
									unset($sub_button);
									unset($menu);
									
							}
							
					  }
					  //**********************foreach结束**********************************
					    $appid =C('appid'); //AppID(应用ID)
                        $token = C('token');//微信后台填写的TOKEN
			            $appsecret = C('appsecret');//微信后台填写的TOKEN
						$token = session("token");
						if(!$token){
							$auth  = new WechatAuth($appid, $appsecret);
							$token = $auth->getAccessToken();
							session(array('expire' => $token['expires_in']));
							session("token", $token['access_token']);
							$token = session("token");
						}
						$auth = new WechatAuth($appid, $appsecret, $token);				 }
				        $menuCreate=$auth-> menuCreate($button);
						if($menuCreate['errcode'])
						{
						     $this->error(L('Menu_Create_P'),U('Wechat/Setting/menu_setting'),$this->r_time);
							 exit();
						}

		   }
		$button=FF("wechat/wechat_menu"); 
		$this->assign('button',$button);	
		$this->display();
    }
	
	 public function del_img(){
		 $base_path="upload/user/";
		 if($folder_array=scandir($base_path))
		 {
			 foreach($folder_array as $file) {
				   if($file!="." && $file!=".." && is_dir($base_path.$file."/"))
					{
						 unlink($base_path.$file."/face/wechat_face.jpg");
						 unlink($base_path.$file."/face/wechat_seo.jpg");
					}
			 }
			 
		 }
		 
    
	}
}

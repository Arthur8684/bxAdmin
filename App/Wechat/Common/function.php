<?php
/*
-----------------------------------
*返回用户上级N层的ID，ID集
 $position_userid  起始用户的position
 $n       返回的层数N
 $data_array  要返回的数组
 return array 返回N层会员的ID
-----------------------------------   
*/	
 function return_recommend_ids($recommend,$n=0,$data_array=array())
 {
      if(!$recommend) return $data_array;
	  $n++;
	  $c_n=$config['scale']?count(explode(",",$config['scale'])):4;//获得分销级数
	  $c_n=$c_n<=1?3:($c_n-1);
	  if($n>$c_n) return $data_array;
      $user =M('User');
	  $data['id']=$recommend;
	  $info=$user->where($data)->find();
	  if($info['id'])
	  {
	       $wechat_user=M('wechat_user');
		   $where['openid']=$info['openid'];
	       $nickname=$wechat_user->where($where)->getField('nickname');
	       $data_array[$n]=array('user'=>$info['user'],'openid'=>$info['openid'],'id'=>$info['id'],'nickname'=>$nickname,'lev'=>$n);
	       return return_recommend_ids($info['recommend'],$n,$data_array);
	  }
	  else
	  {
	       return $data_array;
	  }
	   
 }
 /*
-----------------------------------
*返回用户微信字段值
 $userid 用户的ID
-----------------------------------   
*/	
 function return_wechat($userid,$feild="openid",$return_data="")
 {
      if(!$userid) return $return_data;
      $user =M('User');
	  $data['id']=$userid;
	  $info=$user->field('openid')->where($data)->find();
	  if($info)
	  {
           $wechat_user=M('wechat_user');
		   $where['openid']=$info['openid'];
		   $w_data=$wechat_user->where($where)->find(); 
		   if($feild)
		   {
		        return $w_data[$feild]?$w_data[$feild]:$return_data;
		   }
		   else
		   {
		        return $w_data;
		   }
	  }
	  else
	  {
	       return $return_data;
	  }

 }
/*
-----------------------------------
*微信给用户回复信息
$list_openid 多个OPENID 数组
$tem  模板
$user 关注用户信息
-----------------------------------   
*/	
 function recommend_msg($list_openid,$tem,$user=array(),$auth="")
 {
      if(!$list_openid) return false;
	      $auth=$auth?$auth:create_auth();
		  $config=FF("wechat/wechat_user");
		  if(!$tem) return false;
		  if(!is_array($list_openid)) $list_openid=array(array($list_openid));
	      foreach($list_openid as $k => $v)
		  {
		      if($v['openid'])
			  {
					if($user) $array=array_merge($v, $user);
					$rel_text=preg_replace_callback('/\[([A-Za-z0-9_]+)]/i', 
					function ($m) use ($array) {
						return $array[$m[1]];
					},$tem); 			  
			       $auth->messageCustomSend($v['openid'], $rel_text);
			  }
		  }
 }
/*
-----------------------------------
创建WechatAuth对象
-----------------------------------   
*/	
 function create_auth()
 {
      $config=FF('Conf/config','',APP_PATH."Wechat/");
	  if(!$config) return "";
	  $appid =$config['appid']; //AppID(应用ID)
	  $appsecret = $config['appsecret']; //微信后台填写的appsecret
        $token = session("token");
        if($token){
            $auth = new \Wechat\Util\WechatAuth($appid, $appsecret, $token);
        } else {
            $auth  = new \Wechat\Util\WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);
        }
	  return $auth ;
	   
 }
 /*
-----------------------------------
创建推广图片
$qrcode 二维码图片链接
$face 微信头像
$img  图片底图
$new_img 要生成的图片  
-----------------------------------   
*/	
 function create_qrcode_seo($qrcode,$face,$img,$new_img,$nickname,$auth)
 {
     if(!is_object($auth)) $auth=create_auth();
		      $config=FF("wechat/wechat_user"); 
			  $image = new \Think\Image(); 
			  if($face && is_file($face))
			  {
					  $filename_face_w=$config['img_width_1']?$config['img_width_1']:100;
					  $filename_face_h=$config['img_height_1']?$config['img_height_1']:100;
					  $filename_face_x=$config['img_left_1']?$config['img_left_1']:30;
					  $filename_face_y=$config['img_top_1']?$config['img_top_1']:30;
					  
					  $image->open($face);
					  $image->thumb($filename_face_w,$filename_face_h,\Think\Image::IMAGE_THUMB_FIXED)->save($new_img);
					  $image->open($img)->water($new_img,array($filename_face_x,$filename_face_y),100)->save($new_img);		
			  }
              $img=is_file($new_img)?$new_img:$img;
              if($qrcode && is_file($qrcode))
			  {
					  $filename_qrcode_w=$config['img_width_0']?$config['img_width_0']:150;
					  $filename_qrcode_h=$config['img_height_0']?$config['img_height_0']:150;
					  $filename_qrcode_x=$config['img_left_0']?$config['img_left_0']:200;
					  $filename_qrcode_y=$config['img_top_0']?$config['img_top_0']:200;
					  $image->open($qrcode);		   
					  $image->thumb($filename_qrcode_w,$filename_qrcode_h,\Think\Image::IMAGE_THUMB_FIXED)->save($qrcode);
					  $image->open($img)->water($qrcode,array($filename_qrcode_x,$filename_qrcode_y),100)->save($new_img);			  
			  }
              $img=is_file($new_img)?$new_img:$img;
			  $text=$config['img_font'];
			  if($text)
			  {
			     $text=str_replace("{nickname}",$nickname,$text);
				 $x=$config['img_font_left']?$config['img_font_left']:0;
				 $y=$config['img_font_top']?$config['img_font_top']:0;
				 $size=$config['img_font_size']?$config['img_font_size']:20;
				 $color=$config['img_font_color']?$config['img_font_color']:"#FF0000";
			     $image->open($img)->text($text,"./Public/css_js_font_img/fonts/guanjia.ttf",$size,$color,array($x,$y))->save($new_img); 
			  }  	 
	     return is_file($new_img)?$new_img:$img;
 }

?>

<?php
namespace Wechat\Controller;
use Think\Controller;
use Wechat\Util\Wechat;
class IndexController extends Controller{

    public function index(){
	        $appid = C('appid'); //AppID(应用ID)
			$token = C('token'); //AppID(应用ID)
            $crypt = C('encoding'); //消息加密KEY（EncodingAESKey）
			$appsecret = C('appsecret'); //消息加密KEY（EncodingAESKey）
            $wechat = new Wechat($token, $appid, $crypt);
			$data = $wechat->request();   	
			
            if($data && is_array($data))
			{
			    $auth=create_auth();
                $this->demo($wechat,$data,$auth);
            }

    }

    /**
     * DEMO
     * @param  Object $wechat Wechat对象
     * @param  array  $data   接受到微信推送的消息
     */
    private function demo($wechat,$data,$auth){
        switch ($data['MsgType']) {
            case Wechat::MSG_TYPE_EVENT:
                switch ($data['Event']) {
                    case Wechat::MSG_EVENT_SUBSCRIBE:
					case Wechat::MSG_EVENT_SCAN:
						$config=FF("wechat/wechat_user"); 
						$array=explode("_",$data['EventKey']);
						$recommend=$array[1]?$array[1]:0;
						$user=$this->create_user($data['FromUserName'],$recommend,$auth);
                        $rel_tem=$user['concern']?$config['concern_tem1']:$config['concern_tem'];        
					
						recommend_msg(return_recommend_ids($recommend),$config['recommend_tem'],array('nickname_'=>$user['nickname']),$auth);
						$wechat->replyText(replace_regex($rel_tem,$user)); //替换提示模板中的变量
                        break;
                    case Wechat::MSG_EVENT_UNSUBSCRIBE://取消关注，记录日志
                        
                        break;
                    case Wechat::MSG_EVENT_VIEW://跳转事件
                       $this->login_user($data['FromUserName'],$wechat,$auth);
					   
                        break;
                    case Wechat::MSG_EVENT_CLICK://点击事件
                        $this->click($data,$wechat,$auth);
                        break;
                    case Wechat::MSG_EVENT_LOCATION://上传地理位置信息
                       // $this->click($data,$wechat,$auth);
                        break;
                    default:
					    //$this->login_user($data['FromUserName'],$wechat,$auth);
						$wechat->replyText($data['Event']); 
                        break;
                }
                break;

            case Wechat::MSG_TYPE_TEXT:
                switch ($data['Content']) {
                    case '文本':
                        //$wechat->replyText('欢迎访问麦当苗儿公众容！');
						$wechat->replyText(session('user.id')."KKK"); //替换提示模板中的变量
                        break;
                    default:
                        $this->text_show($data,$wechat,$auth);
                        break;
                }
                break;
            
            default:
                break;
        }
    }

    /**
     * 资源文件上传方法
     * @param  string $type 上传的资源类型
     * @return string       媒体资源ID
     */
    private function upload($type){
		$auth=create_auth();
/*        $appid     = 'wx58aebef2023e68cd';
        $appsecret = 'bf818ec2fb49c20a478bbefe9dc88c60';

        $token = session("token");

        if($token){
            $auth = new WechatAuth($appid, $appsecret, $token);
        } else {
            $auth  = new WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);
        }*/

        switch ($type) {
            case 'image':
                $filename = './Public/image.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'voice':
                $filename = './Public/voice.mp3';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'video':
                $filename    = './Public/video.mp4';
                $discription = array('title' => '视频标题', 'introduction' => '视频描述');
                $media       = $auth->materialAddMaterial($filename, $type, $discription);
                break;

            case 'thumb':
                $filename = './Public/music.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;
            
            default:
                return '';
        }

        if($media["errcode"] == 42001){ //access_token expired
            session("token", null);
            $this->upload($type);
        }

        return $media['media_id'];
    }	
/*==================================================	
    创建会员，返回会员特定信息
	$openid 微信OPENID
	$recommend  推荐人ID	
====================================================*/
	function create_user($openid,$recommend=0,$auth)
	{
	     $recommend=$recommend?$recommend:0;
	     $m=M('user');
		 $wechat_user=M('wechat_user');
		 $where['openid']=$openid;
		 $userinfo=$m->where($where)->find();
		 if($userinfo)
		 {
		     $return_data['concern']=1;
             $w_data=$wechat_user->field('nickname')->where($where)->find();
		 } else
		 {
		     $config=FF("wechat/wechat_user"); 
			 $config['pass_num']=$config['pass_num']?$config['pass_num']:4;
			 $config['user_pre']=$config['user_pre']?$config['user_pre']:'user';
		     $string=new \Org\Util\String();//创建string对象
			 $user=$string->randString(6,0); //获得6位随机字符
			 $pass=$string->randString($config['pass_num'],0); 
			 $pre=$string->randString(6,0);
		     $data=array(
			       'user'=>$user,
				   'pass'=>md5($pass.$pre),
				   'pass_pre'=>$pre,
				   'money'=>0,
				   'amount'=>0,
				   'point'=>0,
				   'status'=>1,
				   'addtime'=>time(),
				   'group_id'=>1,
				   'recommend'=>$recommend,
				   'openid'=>$openid,
			 );
			$group=FF("user_group/user_group");
			$data['status']=$group[$data['group_id']]['is_verify']?0:1;
			$insertId=$m->data($data)->add();
			$w_data=$auth->userInfo($openid);
			if($w_data)
			{
				$wechat_user->data($w_data)->add();			
			}
			if($insertId)
			{
			    unset($data);
				$data['id']=$insertId;
				$data['user']=$config['user_pre'].$insertId;
				$data['nickname']=$w_data['nickname'];
				$m->data($data)->save();
			}
			$userinfo=$m->where($where)->find();
			$return_data['concern']=0;
		 }
		 
		 $return_data['user']=$userinfo['user'];
		 $return_data['pass']=$pass;
		 $return_data['nickname']=$w_data['nickname'];
		 $return_data['nickname_']=return_wechat($recommend,'nickname',L('Wechat_W'));
		 set_grand($recommend,array('recommend'=>1));
		 return $return_data;
	}
/*==================================================	
    检查用户登录，如果没登陆，自动登录
	$openid 微信OPENID
====================================================*/	
	function login_user($openid,$wechat="",$auth="")
	{
		      $user = M("user");
			  $where['openid']=$openid;
			  $id=$user->where($where)->getField('id');
			  if(!$id) $wechat->replyText(L('Wechat_Login_p'));
			  return $id;
	}
	
/*==================================================	
    点击事件
	$data 微信传送过来的数据
	$click_data  model_modelid_field
====================================================*/	
	function click($data,$wechat,$auth)
	{
	        $click_data=$data['EventKey'];
			$type_array=explode('_',$click_data);
			$type=$type_array[0];
			switch ($type) {  
				case 'qrcode':  //二维码数据
				      $this->create_qrcode($data,$wechat,$auth);
					  break;
				case 'model':  //显示模型数据
				      $this->model_show($type_array,$wechat,$auth);
					  break;     
				default: 
				      $this->text_show(array('Content'=>$type),$wechat,$auth); 
					  break;  
			}  
	}
	
/*==================================================	
    创建二维码
	$data 微信传送过来的数据
====================================================*/	
	function create_qrcode($data,$wechat,$auth)
	{
	      $openid=$data['FromUserName'];
		  $user=M('user')->where(array('openid'=>$openid))->find();
		  if(!$user['id']) $wechat->replyText(L('Wechat_Login_p'));
		  $userid=$user['id'];
		  $w_config=FF('wechat/wechat_user');//微信配置
		  if(!$user['qrcode_open'] && $w_config['img_price']>0)
		  {
			   $wechat->replyText("<a href='".C('site_url').C('root_path').U("Wechat/User/qrcode_buy",array('openid'=>$openid))."'>".$w_config['img_price_msg']."</a>");
		  }
		  $path="upload/user/$userid/face/";
		  $filename_qrcode=$path."wechat_qrcode.jpg";
		  $filename_qrcode_1=$path."wechat_qrcode_1.jpg";
		  $filename_seo=$path."wechat_seo.jpg";
		  $filename_face=$path."wechat_face.jpg";
		  
		  if(!is_file($filename_seo))
		  {
		      if(!is_dir($path)) mkdir($path,0777,true);	
			  $qrcode=$auth->qrcodeCreate($userid);
		      $qrcode['ticket']?$qrcode_url=$auth->showqrcode($qrcode['ticket']):$wechat->replyText(L('Wechat_Create_Qrcode_P'));
			  $wechat_user=$auth->userInfo($openid);
			  $wechat_user['nickname']?$nickname=$wechat_user['nickname']:$nickname='无名';
			  $headimgurl=$wechat_user['headimgurl'];
			  if($headimgurl && !is_file($filename_face))
			  {
			      $this->DownLoadQr(substr($headimgurl,0,strlen($headimgurl)-1)."132",$filename_face);
			  }
			  if(!is_file($filename_qrcode))
			  {
			      $this->DownLoadQr($qrcode_url,$filename_qrcode);
			  }
			  $filename_face=is_file($filename_face)?$filename_face:"upload/water/default_face.jpg";
			  
			  create_qrcode_seo($filename_qrcode,$filename_face,"upload/water/wechat_seo_img.jpg",$filename_seo,$nickname,$auth);
		  }
		   $upload_img=$auth->mediaUpload($filename_seo,'image');
		   $wechat->replyImage($upload_img['media_id']);

	}
/*==================================================	
    模型数据回复
	$type_array 微信获取的数据
====================================================*/	
protected function model_show($type_array,$wechat,$auth)
{
     $model_id=$type_array[1];
	 $type=$type_array[2];
     $model=M('model')->where('id='.$model_id)->find();
	 $table=$model['table'];
	 $sye_model=$model['type'];
	 if($table)
	 {
	      $m=M($table);
		  switch ($type) {  
				case 'new':  //最新数据
				      $order="id desc";
					  break;     
				default: 
				    $order="$type desc"; 
					break;  
		  }		  
		  $info=$m->where("thumb<>''")->order($order)->limit(10)->select();
		  if($info)
		  {
		       $path=C('site_url').C('root_path');
			   $show_url=$path.U($sye_model."/Index/show",array('modelid'=>$model_id,'id'=>$v['id']));
		       foreach($info as $v)
			   {
			        $thumb=(substr(trim($v['thumb']),0,4)=="http")?trim($v['thumb']):$path.trim($v['thumb']);
			        $news[]=array($v['title'],substr(strip_tags($v['content']),0,100),$show_url,$thumb); 
			   }
			   //$wechat->replyNews($news);
			   call_user_func_array(array($wechat,'replyNews'),$news);  		  }
		  else
		  {
		       $wechat->replyText(L('Wechat_Model_Err_0'));
		  }
	 }else
	 {
	     $wechat->replyText(L('Wechat_Model_Err_0'));
	 }
}
/*==================================================	
    被动回复
	$type_array 微信获取的数据
====================================================*/	
protected function text_show($data,$wechat,$auth)
{
     $content=$data['Content'];
	 $m=M('wechat_key');
	 $where="FIND_IN_SET('".$content."', keyword)";
     $info=$m->where($where)->find();
	 if(!$info)
	 {
	     $where="INSTR('".$content."', keyword)";
	     $info=$m->where($where)->find();
	 }
	 if($info)
	 {
	     if($info['type']==1)
		 {
		     $wechat->replyText($info['content']);
		 }elseif($info['type']==2)
		 {
			 $model_id=M('model')->where(array('table'=>'wechat_key'))->getField('id');
		     $path=C('site_url').C('root_path');
			 $show_url=$path.U("Article/Index/show",array('modelid'=>$model_id,'id'=>$info['id']));
			 $thumb=(substr(trim($v['thumb']),0,4)=="http")?trim($info['thumb']):$path.trim($info['thumb']);
		     $wechat->replyNewsOnce($info['title'],substr(strip_tags($v['content']),0,100),$show_url,$thumb);
		 }
	 }
	 else
	 {
	     $wechat->replyText(L('Wechat_Model_Err_1'));
	 }
}
/*==================================================	
    下载微信二维码
====================================================*/		
protected function DownLoadQr($url,$new_filename){
    if($url == ""){
      return false;
    }
    ob_start();
    readfile($url);
    $img=ob_get_contents();
    ob_end_clean();
    $size=strlen($img);
    $fp2=fopen($new_filename,"a");
    if(fwrite($fp2,$img) === false){
      exit();
    }
    fclose($fp2);
  }


}

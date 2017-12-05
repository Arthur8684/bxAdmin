<?php
namespace Chat\Controller;
//use Org\Util\Admin;
use Think\Controller;
class ServerController extends Controller{
	
	 function __construct()  
	 {  
		  parent::__construct();
	 } 
    public function server(){
		    error_reporting(E_ALL);
            set_time_limit(0);
            ignore_user_abort(true); 
			session_write_close();
			
			ob_end_clean();#清除之前的缓冲内容，这是必需的，如果之前的缓存不为空的话，里面可能有http头或者其它内容，导致后面的内容不能及时的输出
			header("Connection: close".PHP_EOL);//告诉浏览器，连接关闭了，这样浏览器就不用等待服务器的响应
			header("HTTP/1.1 200 OK".PHP_EOL); //可以发送200状态码，以这些请求是成功的，要不然可能浏览器会重试，特别代理的
			ob_implicit_flush();
			$str=PHP_EOL."启动成功";
			echo iconv('UTF-8',"gb2312//IGNORE",$str); 

		   $config=FF('Conf/website_config','',MODULE_PATH); 
		   if(!$config['server'] || !$config['port']) return false;
		   Vendor('Socket.Socket');
           $socket=new \Socket($config['server'],$config['port'],$config['total_user'],$config['room_user']);
		   
		   $socket->setOpen=function($open)
			{
				 if(file_exists(MODULE_PATH."Conf/open.open"))
				 {
					  return true;
				 }
				 else
				 {
					  return false;
				 }
			};	
				   
		   $socket->onConnect=function($key,$ip,$socket)
			{
	
			};
			
			$socket->onSet=function($connect,$msg,$user_list,$socket)
			{
				 $data['user_list']=$user_list;
				 $data['action']='connection';
				 $socket->send($data,'user_room_all');
			};
			
		   $socket->onMessage=function($connect,$data,$socket)
			{	
				switch ($data['type'])
				{
				      case 'give_presents':					  
//=============================================================礼物发送==============================================================================================				  
							  $pass_pre=$data['appsecret'];
							  $to_userid=$data['userid'];
							  $gift_id=$data['gift_id'];
							  $num=$data['num'];
							  $form_userid=$connect['uid'];
							  $room_id=$connect['room_id'];
							  if(is_numeric($form_userid))
							  {
								  $user_pass_pre=md5(user($form_userid,'pass_pre'));
								  if($user_pass_pre!=$pass_pre)
								  {
									  $data['err']=1;
									  $data['message']=L('Chat_Gift_Err_3');
									  $socket->send($data,'user_prompt');//提示信息
									  return 0;
								  }
								  else
								  {
									  $gift=give_presents($form_userid,$to_userid,$gift_id,$num,$room_id);
									  if(is_array($gift))
									  {
										      $room=room($room_id);
											  $data['message']=array('show_type'=>$gift['show_type'],'title'=>$gift['title'],'ico'=>$gift['ico'],'num'=>$num,'room'=>$room['title']);
											  $data['action']='give_presents';
											  switch ($gift['show_type'])
											  {
												  case 1:
													$socket->send($data,'user_room_all');
													break;  
												  case 2:
													$socket->send($data,'user_all');
													break;
												  default:
													$socket->send($data,'user_room_all');
											  }
									  }
									  else
									  {
										   $data['err']=1;
										   $data['message']=L('Chat_Gift_Err_'.$gift);
										   $socket->send($data,'user_prompt');//提示信息
										   return 0;	
									  }
								  }
							  }
							  else
							  {
									  $data['err']=1;
									  $data['message']=L('LOGIN_NO');
									  $socket->send($data,'user_prompt');//提示信息
									  return 0;					  
							  }
								
							  break;  
//=============================================================礼物发送完==============================================================================================	
					case '1':
					  break;
					default:
					  $type=$data['type']; 
					  $data['action'] = $type;
					  $socket->send($data,$data['type'],0,$data['user_key'],$data['room_id']);
				}
			};	
			$socket->onClose=function($connect,$k,$user_list,$socket)
			{
				$data['user_list']=$user_list;
				$data['action']='close';
			    $socket->send($response,'user_room_no');
			};			
			$socket->start_server();
    }
}
?>
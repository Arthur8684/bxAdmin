<?php
namespace Games\Controller;
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
			if(!IS_CLI) exit('CLI');

           $str=PHP_EOL."启动成功2";
		   echo iconv('UTF-8',"gb2312//IGNORE",$str); 
		   
		   $config=FF('Conf/config','',MODULE_PATH); 
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
				   
		   $socket->onPing=function($key,$data,$socket)
			{
				 $game_sign=$data['game_sign'];
				 if(!$game_sign) return false;
				 $path="/App/Games/Games/".$game_sign."/Controller/".$game_sign.".php";
				 require_once($path); 
				 
				 if(class_exists($game_sign) )
				 {
					 $class = "\\".$game_sign;
					 $games=new $class();
					 if( method_exists($games,'onPing')) $games->onPing($connect,$data,$user_list,$socket);
				 } 

			};
			
			$socket->onSetBefore=function($key,$room_user_count,$data,$socket)
			{
			     $return=true;
				 $game_sign=$data['game_sign'];
				 if(!$game_sign) return false;
				 $path="/App/Games/Games/".$game_sign."/Controller/".$game_sign.".php";
				 require_once($path); 
				 
				 if(class_exists($game_sign) )
				 {
					 $class = "\\".$game_sign;
					 $games=new $class();
					 if( method_exists($games,'onSetBefore')) $return=$games->onSetBefore($key,$room_user_count,$data,$socket);
				 } 
				 return $return; 
			};	
					
			$socket->onSet=function($connect,$data,$user_list,$socket)
			{
				 $game_sign=$data['game_sign'];
				 if(!$game_sign) return false;
				 $path="/App/Games/Games/".$game_sign."/Controller/".$game_sign.".php";
				 require_once($path); 
				 
				 if(class_exists($game_sign) )
				 {
					 $class = "\\".$game_sign;
					 $games=new $class();
					 if( method_exists($games,'onSet')) $games->onSet($connect,$data,$user_list,$socket);
				 } 
			};
			
		   $socket->onMessage=function($connect,$data,$socket)
			{	
				 $game_sign=$data['game_sign'];
				 if(!$game_sign) return false;
				 $path="/App/Games/Games/".$game_sign."/Controller/".$game_sign.".php";
				 require_once($path); 
				 
				 if(class_exists($game_sign) )
				 {
					 $class = "\\".$game_sign;
					 $games=new $class();
					 if( method_exists($games,'onMessage')) $games->onMessage($connect,$data,$socket);
				 } 
			};	
			
			$socket->onClose=function($connect,$k,$user_list,$socket)
			{
				return false;
				 $room_id=$connect['room_id'];
				 $room=M('games_room')->where('id='.$room_id)->find();
				 $game_sign=$room['sign'];
				 if(!$game_sign) return false;
				 $path="/App/Games/Games/".$game_sign."/Controller/".$game_sign.".php";
				 require_once($path); 
				 
				 if(class_exists($game_sign) )
				 {
					 $class = "\\".$game_sign;
					 $games=new $class();
					 if( method_exists($games,'onClose')) $games->onClose($connect,$k,$user_list,$socket);
				 } 
			};			
			$socket->start_server();
    }
}
?>
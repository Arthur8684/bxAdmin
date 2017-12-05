<?php
namespace Games\Controller;
//use Org\Util\Admin;
use Think\Controller;
use Workerman\Worker;
class MserverController extends Controller{
	
	 function __construct()  
	 {  
		  parent::__construct();
	 } 
    public function server(){
		   require_once APP_PATH.'Workerman/Autoloader.php';
           $http_worker = new Worker("websocket://0.0.0.0:2345");

		  // 启动4个进程对外提供服务
		  $http_worker->count = 4;
		  
		  // 接收到浏览器发送的数据时回复hello world给浏览器
		  $http_worker->onMessage = function($connection, $data)
		  {
			  // 向浏览器发送hello world
			  $connection->send('hello world');
			  echo $connection->id;
			  $connection->id = 50;
			  echo $connection->id;
		  };
		  
		  Worker::runAll();
    }
}
?>
<?php
namespace Games\Controller;
use Think\Controller;
class GameController extends Controller {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }  
/*=================================================
**游戏列表
==================================================*/
	public function index(){

        $this->randDate=rand();
		$this->display();
		
	}
	public function cui(){
		if(IS_POST){
			$file=I('file');
			echo game_file_upload($file,'upload/','games/');
		}else{
			$this->display();
		}
	}
}
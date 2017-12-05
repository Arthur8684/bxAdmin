<?php
namespace Games\Controller;
use Org\Util\base;
class Index1Controller extends base {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }  
/*=================================================
**项目列表
==================================================*/
	public function index(){
		$path="Public/css_js_font_img/games/pushpot";
		
		$F=new \Org\Util\File();
		$filenames = $F->get_all_dir($path);  
		//打印所有文件名，包括路径
		$this->k=stripslashes(json_encode($filenames));  
		
		$this->display();
	}
	
	public function index2(){
		$path="Public/css_js_font_img/games/pushpot";
		
		$F=new \Org\Util\File();
		$filenames = $F->get_all_dir($path);  
		//打印所有文件名，包括路径
		$this->k=stripslashes(json_encode($filenames));  
		
		$this->display();
	}	

}
 
     
  
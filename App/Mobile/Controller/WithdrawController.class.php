<?php
namespace User\Controller;
use Think\Controller;
class WithdrawController extends Controller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function index(){

			$this->display();		    
		
    }
	
	public function quit(){
         session('user.id',null); // 删除session
		 $this->redirect('User/Index/index','',0, '页面跳转中...');
		 
    }
	
	
}
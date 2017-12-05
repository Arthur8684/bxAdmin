<?php
namespace Applet\Controller;
use Think\Controller;
class LoginController extends Controller{
    function __construct(){
        parent::__construct();
    }

//    登陆页面
    public function sign_in(){
        $this->display();
    }
//    注册页面
    public function register(){
        $this->display();
    }
}
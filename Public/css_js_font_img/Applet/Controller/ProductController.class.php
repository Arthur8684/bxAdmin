<?php
namespace Applet\Controller;
use Think\Controller;
class ProductController extends Controller{
    function __construct(){
        parent::__construct();
    }

//    功能介绍
    public function Functions(){
        $this->display();
    }

//    官方定制
    public function Customized(){
        $this->display();
    }

    //  立即订制页面
    public function order(){
        $this->display();
    }
}

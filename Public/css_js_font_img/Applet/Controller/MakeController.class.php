<?php
namespace Applet\Controller;
use Think\Controller;
class MakeController extends Controller {
  function __construct(){//析构函数
    parent::__construct();
  }
//    制作页面
  public function index(){
    $this->display();
  }

}
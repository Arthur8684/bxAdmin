<?php
namespace Applet\Controller;
use Think\Controller;
class TrainController extends Controller{
  function __construct(){
    parent::__construct();
  }

  // 小程序培训
  public function Small_program(){
    $this->display();
  }

  // 开发论坛
  public function Development_Forum(){
    $this->display();
  }

  // 入门教程
  public function Introduction_course(){
    $this->display();
  }

  // 视频教程
  public function Video_course(){
    $this->display();
  }

//  支付宝小程序
    public function Ali_SmallProgram(){
      $this->display();
    }
}
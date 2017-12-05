<?php
namespace Applet\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        // $this->redirect('Index/index','',0, '页面跳转中...');
      $this->display();
    }
}
<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->redirect('Goods/index/index','',0, '页面跳转中...');
    }
}
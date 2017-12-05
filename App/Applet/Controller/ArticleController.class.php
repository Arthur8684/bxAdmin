<?php
namespace Applet\Controller;
use Think\Controller;
class ArticleController extends Controller{
    function __construct(){
        parent::__construct();
    }

//    文章列表
    public function index(){
        $this->display();
    }

//    文章详情
    public function example(){
        $this->display();
    }
}
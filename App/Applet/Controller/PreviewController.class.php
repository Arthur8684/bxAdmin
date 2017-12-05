<?php
namespace Applet\Controller;
use Think\Controller;
class PreviewController extends Controller{
    function __construct(){
        parent::__construct();
    }
    //  ??????
    public function index(){
        $this->display();
    }
}

<?php
namespace Applet\Controller;
use Think\Controller;
class EditController extends Controller{
    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->display();
    }
}
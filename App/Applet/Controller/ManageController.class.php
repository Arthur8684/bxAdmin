<?php
namespace Applet\Controller;
use Think\Controller;
class ManageController extends Controller{
    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->display();
    }
}
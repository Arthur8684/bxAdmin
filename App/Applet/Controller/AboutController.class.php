<?php
namespace Applet\Controller;
use Think\Controller;
class AboutController extends Controller{
  function __construct(){
    parent::__construct();
  }

  public function index(){
    $this->display();
  }

//  了解
    public function article(){
      $this->display();
    }
}

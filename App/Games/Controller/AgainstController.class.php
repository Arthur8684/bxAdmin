<?php
namespace Games\Controller;
use Org\Util\Games;
use Think\Controller;
class AgainstController extends Controller {
   function __construct()  //析构函数
   {  
		parent::__construct();
   }  
/*=================================================
**游戏房间
==================================================*/	
	public function game_room(){

		$this->display();
	}
}
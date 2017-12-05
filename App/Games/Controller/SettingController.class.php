<?php
namespace Games\Controller;
use Org\Util\base;
class SettingController extends base {
    public function setting(){
        if(IS_POST)
        {
            $post=I('post.');
            if(!$post['room_num'] || !is_numeric($post['room_num'])) $post['room_num']=5;
            unset($post['__hash__']);
            FF('Conf/config',$post,MODULE_PATH);
        }
        $config=FF('Conf/config','',MODULE_PATH);
		$this->assign('point_type',C('point_type'));
        $this->assign('config',$config);
        $this->display();
    }

	
	 public function open_server(){
	    $File=new \Org\Util\File();
	    $File->write(MODULE_PATH,"Conf/open.open",'OK');
		
        $this->success(L('OPEN').L('success'),"",$this->r_time); 
    }
	
	public function close_server(){
	   $File=new \Org\Util\File();
	   $File->delete(MODULE_PATH."Conf/open.open");
       $this->success(L('CLOSE').L('success'),"",$this->r_time); 
    }
}
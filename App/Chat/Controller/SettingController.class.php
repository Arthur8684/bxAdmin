<?php
namespace Chat\Controller;
use Org\Util\base;
class SettingController extends base {
    public function setting(){
        if(IS_POST)
        {
            $post=I('post.');
            unset($post['__hash__']);
            FF('Conf/direct_config',$post,MODULE_PATH);
        }
        $direct=FF('Conf/direct_config','',MODULE_PATH);
        $this->assign('direct',$direct);
        $this->display();
    }
    public function website_settings(){
        if(IS_POST)
        {
            $post=I('post.');
            unset($post['__hash__']);
            FF('Conf/website_config',$post,MODULE_PATH);
        }
        $config=FF('Conf/website_config','',MODULE_PATH);
        $model_info=M('model')->where(array('type'=>'Article','model_class'=>'content'))->select();
		$this->assign('point_type',C('point_type'));
		$this->assign('model_info',$model_info);
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
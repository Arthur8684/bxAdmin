<?php
namespace Form\Controller;
use Org\Util\Admin;
class SettingController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function setting(){
        $id=I('id');
		if(IS_POST)
		{
			$post=data_(I('post.'),'__hash__');
			if($post['group']) $post['group']=implode(",",$post['group']);
			if($post['start_time']) $post['start_time']=strtotime($post['start_time']);
			if($post['end_time']) $post['end_time']=strtotime($post['end_time']);
			FF("model/model_".$id."_config",$post);
			M('model')->where(array('id'=>$id))->save(array('setting'=>array2string($post)));
		}
        $c=model_config($id);
		if($c['start_time']) $c['start_time']=date('Y-m-d H:i',$c['start_time']);
		if($c['end_time']) $c['end_time']=date('Y-m-d H:i',$c['end_time']);
	    $group=group_list_();
	    $this->assign('group',$group);
		
		$this->assign('id',$id);
		$this->assign('c',$c);
		$this->display();
    }
}
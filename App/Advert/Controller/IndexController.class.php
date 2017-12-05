<?php
namespace Advert\Controller;
use Org\Util\base;
class IndexController extends base {
/*
-----------------------------------  
生成广告
* @return        bool        
-----------------------------------   
*/		
    public function ad(){
	     $id=I('id'); 
		 $info=advert($id);
		 $info['setting']=$info['setting']?string2array($info['setting']):array();
		 //设置广告位的配置信息
		 if(is_numeric($info['setting']['width'])) $info['setting']['width']=$info['setting']['width']?$info['setting']['width']:0;
		 $info['setting']['height']=$info['setting']['height']?$info['setting']['height']:0;
		 $set['width']=$info['setting']['width'];
		 $set['height']=$info['setting']['height'];
		 $set['interval']=$info['setting']['interval']?$info['setting']['interval']:117;
		 $set['style']=$info['setting']['style'];
		 //设置广告位的配置信息完
		 $format=$set['style'];
		 $type=$info['advert_type'];
		 if($type)  $advert_info=$type($info);
		 
		 $this->assign('set',$set);
		 $this->assign('info',$info);
		 $this->assign('advert_info',$advert_info);
		 $this->display('Index/'.$type."/".$type."_".$format);
    }
}
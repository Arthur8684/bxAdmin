<?php
namespace Admin\Controller;
use Org\Util\Admin;
class SettingController extends Admin {


   function __construct()  //析构函数
   {  
        parent::__construct();
        
   }  
    public function setting(){
		
		if(IS_POST)
		{
		    $post=I('post.');
			$post['point_type']=array('money'=>L('MONEY_NAME'),'amount'=>L('AMOUNT_NAME'),'promote_point'=>L('PROMOTE_POINT'),'point'=>L('POINT_NAME'),'point1'=>L('POINT_NAME')."1",'point2'=>L('POINT_NAME')."2",'point3'=>L('POINT_NAME')."3",'point4'=>L('POINT_NAME')."4",'point5'=>L('POINT_NAME')."5",'point6'=>L('POINT_NAME')."6");
			$post['LOAD_EXT_CONFIG']="db";
			$post['TMPL_PARSE_STRING']['__STATIC__']=$post['root_path']."Public/css_js_font_img/";
			$post['TMPL_PARSE_STRING']['__CHARSET__']=C('DEFAULT_CHARSET');
			$post['url_model']=I('post.url_model',1,'intval');
			$post['jump_time']=I('post.jump_time',5,'intval');
			$post['site_logo']=I('post.site_logo');
			$post['site_logo']=$post['site_logo']?$post['site_logo']:$post['root_path'].'upload/system/system_logo.png';
			if(trim($post['root_path'])=="") $post['root_path']="/";
			if($_FILES)
			{
		         $file_size=1000*1024;
		         $types=array("png");
				 $path="upload/water/";
				  $upload = new \Think\Upload();// 实例化上传类
				  $upload->maxSize=$file_size;
				  $upload->exts=$types;
				  $upload->rootPath=$path;
				  $upload->replace = true;
				  $upload->saveName ="water_img";
				  $upload->autoSub = false;	
				  $info   =   $upload->upload(); 				  
			}
			unset($post['__hash__']);
			$post=data_($post,array('__hash__','tem'));
			FF('Conf/config',$post,COMMON_PATH);
		}
		
		$config=FF('Conf/config','',COMMON_PATH);
		$this->assign('c',$config);
        $this->display();
    }
}
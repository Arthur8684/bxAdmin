<?php
namespace File\Controller;
use Think\Controller;
class UploadController extends Controller {
    public function __construct() {
        parent::__construct();
		$this->get_user();
		if(!$this->userinfo) exit(L('File_Login'));
		$user=$this->userinfo;
		$this->web_path=C("root_path");
		$this->ext=C("TMPL_PARSE_STRING.__STATIC__")."img/ext/100/";
		$this->base_path="upload/".$user['admin']."/".$user['id'];

    }
    public function index(){
		$editor=I('editor')?I('editor'):0;
		session("editor",$editor);
		$mobile=isMobile();
		$tem=$mobile?'mobile_index':'index';
		$this->display($tem);
    }
    public function file_left(){
        $left=dir_show($this->userinfo);
	   	$this->assign('left',$left);
		$this->assign('ext',C("TMPL_PARSE_STRING.__STATIC__")."img/ext/");	  
       	$this->display();
    }
	public function file_list(){
	    C('TOKEN_ON',false);
		$page=I('page',1,'intval');
		$pagesize=25;
		$parent_path=data_array(unserialize($_GET['parent_path']));
		$parent_path=$parent_path?implode("/",$parent_path):"";
		$editor=session("editor")?session("editor"):0;
	    $user=$this->userinfo;
		$ext=$this->ext;
		$base_path=$this->base_path;
        $root_path=$parent_path?$base_path."/".$parent_path."/":$base_path."/";
		if(!is_dir($base_path)) mkdir($base_path,'0777',true);		
		if(!is_dir($root_path)) 
		{
		    show_js_msg(L('File_Folder_Empte'));
		}else
		{
		        
				$folder_array=scandir($root_path,1);
				$folder_array=array_merge(array_diff($folder_array,array('.','..')));;
				$record_count=count($folder_array);//获取总记录数
		        $page=$record_count<$pagesize?1:$page; 
				$min=($page-1)*$pagesize;
				$max=$page*$pagesize-1;
				foreach($folder_array as $k=>$file) {
						if($k<$min) continue;
						if($k>$max) break;
						$filename=explode('.', $file);
						if($filename[1]) 
						{
							  $file_type=$filename[1];
							  $file_size=filesize($root_path.$file);
							  if(in_array(strtolower($file_type), array('bmp','jpg','gif','png','jpeg')))
							  {
									$file_ico=$this->web_path.$root_path.$file;
							  }
							  else
							  {
									$file_ico=$ext.$file_type.".png";
							  }
							  $file_url=C("root_path").$root_path.$file;
							  
						}else
						{
							 $path_array=$parent_path?explode('/',$parent_path):"";
							 $path_array[]=$file;
							 $file_type="dir";
							 $file_ico=$ext.$file_type.".png";
						}
						$folder_list[]=array('file_url'=>$file_url,'file_path'=>$path_array,'file_type'=>$file_type,'file_name'=>iconv('gbk','utf-8',$file),'file_size'=>$file_size,'file_ico'=>$file_ico);	
				}	
				
			  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			  $this->assign('page_show',$page_show);// 赋值分页输出	
		}

        closedir($root_path);
		$path_array=$parent_path?explode('/',$parent_path):"";
		$this->assign('folder_list',$folder_list);	 
		$this->assign('path',$path_array); 
		$this->assign('editor',$editor);	 
       	$this->display();
    }
/*
-----------------------------------
   创建文件夹ajax
-----------------------------------   
*/		
	public function file_create_folder(){
	    C('TOKEN_ON',false); //关闭表单令牌 
	    $folder=I('folder');
		$parent_path=data_array(unserialize($_GET['parent_path']));
		$parent_path=$parent_path?implode("/",$parent_path):"";
		$base_path=$this->base_path;
        $root_path=$base_path."/".$parent_path."/".$folder."/";
		if(is_dir($root_path)) $this->ajaxReturn(array('code'=>1));
	    $create=mkdir($root_path,0777,true);
		$create?$this->ajaxReturn(array('code'=>0)):$this->ajaxReturn(array('code'=>2));
    }
/*
-----------------------------------
   删除文件夹ajax
-----------------------------------   
*/		
	public function file_del_folder(){
	    C('TOKEN_ON',false); //关闭表单令牌 
	    $folder=I('folder');
		$base_path=$this->base_path;
		$parent_path=data_array(unserialize($_GET['parent_path']));
		$parent_path=$parent_path?implode("/",$parent_path):"";
		$type=filetype($base_path."/".$parent_path."/".$folder);
        $root_path=($type!='file')?$base_path."/".$parent_path."/".$folder."/":$base_path."/".$parent_path."/".$folder;
		if(!is_dir($root_path) && !is_file($root_path)) $this->ajaxReturn(array('code'=>1));
	    ($type!='file')?$del=deleteDir($root_path):$del=unlink($root_path);
		$del?$this->ajaxReturn(array('code'=>0)):$this->ajaxReturn(array('code'=>2));
    }
/*
-----------------------------------
  文件上传
-----------------------------------   
*/		
	public function upload(){
		C('TOKEN_ON',false);
		$file_size=I('size')?I('size'):1000;
		$file_size=$file_size*1024;
		$types=I('type')?explode('|',I('type')):array('jpg','gif','png','jpeg');
		$water=I('water')?I('water'):$_REQUEST['water'];
		$file_name=I('file_name')?I('file_name'):"";

		$base_path=$this->base_path;
		$parent_path=data_array(unserialize($_GET['parent_path']));
		$parent_path=$parent_path?implode("/",$parent_path)."/":"";
		$filename=$file_name?$file_name:time().'_'.mt_rand();
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize=$file_size;
		$upload->exts=$types;
		$upload->rootPath=$base_path."/".$parent_path;
		//$upload->savePath=$base_path."/".$parent_path;
		$upload->saveName =$filename;
		$upload->autoSub = false;
		$upload->savePath  =''; // 设置附件上传（子）目录
		
		$info   =   $upload->upload();
		$callback = $_REQUEST["CKEditorFuncNum"];  
		if(!$info) {// 上传错误提示错误信息
		    if($callback) //编辑器
			{   
			      echo "<font color=\"red\"size=\"2\">*文件格式不正确（必须为".I('type')."文件）</font>";  
				  exit();
			}
			else
			{
				  header('HTTP/1.1 500  0');
				  echo $upload->getError();	
				  exit();			
			}
	 
		}else
		{
		      if($water && C('upload_water_open'))
			  {
			       $water_opacity=C('upload_water_opacity')?C('upload_water_opacity'):100;
				   $water_type=C('upload_water_type');
				   $water_text=C('water_text');
				   $water_size=C('water_text_size');
				   $water_color=C('water_text_color');
				   $water_position=C('upload_water_position')?C('upload_water_position'):1;
			       $image = new \Think\Image(); 
				   foreach($info as $file){
                     $filename= $base_path."/".$parent_path.$file['savename'];
					 if(in_array($file['ext'], array('bmp','jpg','gif','png','jpeg')))
					 {
							if($water_type)
							{
							   $image->open($filename)->water('upload/water/water_img.png',$water_position,$water_opacity)->save($filename); 
							}
							else
							{
							   $image->open($filename)->text($water_text,'./Public/css_js_font_img/fonts/guanjia.ttf',$water_size,$water_color,$water_position)->save($filename); 
							}						 
					 }
                   }
			  }	
			  
			  if($callback) //编辑器
			  { 
			       foreach($info as $file){
                         $filename= $this->web_path.$base_path."/".$parent_path.$file['savename'];
                   }  
                    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback,'".$filename."','');</script>";
			  }			  
			  
		}

    }
	function get_user()
	{
		 if(session('user.id'))
		 {
		      $user = M("user");
			  $where['id']=session('user.id');
			  $user_info=$user->where($where)->find();
			  if($user_info)
			  {
			       $user_info['admin']='user';
			       $this->userinfo=data_($user_info,array('pass','pass_pre'));
			  }
		 }else if(session('admin.id'))
		 {
		      $user = M("admin");
			  $where['id']=session('admin.id');
			  $user_info=$user->where($where)->find();
			  if($user_info)
			  {
			       $user_info['admin']='admin';
			       $this->userinfo=data_($user_info,array('pass','pass_pre'));
			  }		 
		 }
	}
	
}
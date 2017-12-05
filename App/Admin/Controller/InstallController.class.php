<?php
namespace Admin\Controller;
use Org\Util\Admin;
class InstallController extends Admin {

   function __construct()  //析构函数
   {  
   
        $install_already=false;//已经安装过
		$install_before=false; //安装前
		$install_sql_before=false; //安装执行sql前
		$install_db_exist=false; //安装数据包重复
		$install_sql_after=false; //安装执行sql
		$install_success=false; //安装成功
		$install_fail=false; //安装失败
		
		$uninstall_before=false; //卸载前
		$uninstall_del_db=false; //卸载每删除一个表前执行
		$uninstall_success=false; //卸载成功
		//$uninstall_fail; //卸载失败
        parent::__construct();
   } 
   
    public function index(){

       	 $this->display();
    }
	
	
    public function install_list(){
	    $pagesize=20;//每页显示的记录条数
        $path=APP_PATH; //APP路径
		$page=I('page',1,'intval');
		$i=1;
		$info=array();
		//------------------------------------验证路径有效性----------------------------------------
		if (is_dir($path) == false) {
              $this->display();
			  exit();
		}
		//------------------------------------获取APP下的模块----------------------------------------
         $install_info= scandir($path);//返回该目录文件夹下每一个文件名文件夹名的字符串，前两个返回的字符串是"."和".." ，就算是空文件夹也返回这两个字符串
		 $sys_model=array('.','..','admin','accounts','install','system','mobile','sys_model','user','field','file','index');
		 $record_count=count($install_info)-count($sys_model);//获取总记录数
	     $page=$record_count<$pagesize	?1:$page; 
		 $start=($page-1)*$pagesize+1;//开始页码数
         $end=$page*$pagesize;//结束的页码数
		 		
		 foreach ( $install_info as $v ) { 
			  $fileName = strtolower($v) ;
			  $is_install=0;//是否安装
			  $type=filetype($path.$fileName);//是文件夹还是文件，dir文件夹 file文件
			  
			  if($type=="dir" && !in_array($fileName,$sys_model) && $start<=$i && $end>=$i)
			  {
			      $info[$fileName]['sign']=$fileName;//模块标识
				  if(file_exists($path.$fileName."/Install/Install.Install"))  $is_install=1;
				  
				  if($config=FF('config','',$path.$fileName."/Install/"))
				  {
				       $info[$fileName]['name']=$config['name'];//模块名称
					   $info[$fileName]['version']=$config['version'];//模块版本号
					   $info[$fileName]['author']=$config['author'];//模块作者
					   
				  }
				  else
				  {
				       $info[$fileName]['name']=L('UNDEFINED');//模块名称
					   $info[$fileName]['version']="V 1.0.0";//模块版本号
					   $info[$fileName]['author']=L('UNDEFINED');//模块作者
				  }  
				  $info[$fileName]['is_install']=$is_install;//是否已经安装
			  }
			  if($type=="dir" && !in_array($fileName,$sys_model)) $i++;
          }
         closedir($path);
		 //------------------------------------获取APP下的模块完----------------------------------------
		 $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		 $this->assign('page_show',$page_show);// 赋值分页输出
		 $this->assign('info',$info);	  
       	 $this->display();
    }	
	
	
	public function install_alert(){
         $install=I("install","","trim");//要安装的模块
		 $path=APP_PATH; //APP路径
		 
		 if($install!="" && $config=FF('config','',$path.$install."/Install/")) $this->assign('config',$config);
		 
       	 $this->display();
    }
	
	public function install(){
         
         $install=I("install","","trim");//要安装的模块
		 $install_path=APP_PATH.$install."/Install/"; //安装配置路径
		 $insert_data=FF('field','',$install_path);
		 $ERR_MSG="";
		 $SUCCESS_MSG="";
		 if(file_exists($install_path."exe.php")) require $install_path."exe.php";  
		  	 
		 if(!$install)
		 {
		       $ERR_MSG=L("ADMIN_Install_Err_3");
		       $this->assign('ERR_MSG',$ERR_MSG);
       	       $this->display();
			   return false;
		 }		 
		 if(file_exists($install_path."Install.Install"))
		 {
			   if($this->install_already) call_user_func_array($this->install_already,array($install));
		       $ERR_MSG=L("ADMIN_Install_Err_2");
		       $this->assign('ERR_MSG',$ERR_MSG);
       	       $this->display();
			   return false;
		 }	
		 
			 
		 
		 if($config=FF('config','',$install_path))
		 {
			  if($this->install_before) call_user_func_array($this->install_before,array($install));
              $file=new \Org\Util\File();
		     //安装程序开始
			  //--------------------开始执行sql文件------------------------------ 
			  $sql_file=new \Org\Util\Install();
			  $array=$sql_file->read_array($install_path."sql.sql",1);	  
			  if($array)
			  { 
			      
	              $db_table=$array['db_table'];//在执行的sql文件中所创建的数据表
				  $db_file=FF('db',"",$install_path);//获取原来的数据表
				  
				  if($this->install_sql_before) call_user_func_array($this->install_sql_before,array($install,$db_table));
				  
				  if(is_array($db_file))
				  { 
						$db_table=array_merge($db_file,$db_table);//将文件原来的数组和现在新获取的表名合并
						$db_table=array_unique($db_table);//删除重复的值
				  }
				  $table_exist=$sql_file->is_table_exist($db_table);
				  if($table_exist && $this->install_db_exist)  call_user_func_array($this->install_db_exist,array($install,$table_exist));  
				  FF('db',$db_table,$install_path);//将获创建的数据表保存起来，以为卸载的时候删除这些数据表
			      $sql_file->query($array);	
				  
				  $insert_data=FF('field','',$install_path);
				  if($insert_data['table_field']) insert_data('table_field',$insert_data['table_field']);
				  
				  if($this->install_sql_after) call_user_func_array($this->install_sql_after,array($install,$db_table));
			  }		  
			  //--------------------结束执行sql文件------------------------------
			   $static_path=$install_path."static/";
			   $new_path="./Public/css_js_font_img/";

			   if(is_dir($static_path)) $file->copy_($new_path.$install."/",$static_path);
			  
			   file_put_contents($install_path."install.install",'OK');	    
			  
			   if(file_exists($install_path."Install.Install"))
			   {
				   if($this->install_success) call_user_func_array($this->install_success,array($install));
				   $SUCCESS_MSG=L("ADMIN_Install_Success_0");
				   $this->assign('SUCCESS_MSG',$SUCCESS_MSG);
				   $this->display();
				   return false;
			   }
			 //安装程序结束
		 } 
		 else
		 {
			   if($this->install_fail) call_user_func_array($this->install_fail,array($install));
		       $ERR_MSG=L("ADMIN_Install_Err_1");
			   $this->assign('ERR_MSG',$ERR_MSG);
			   $this->display();
			   return false;		 
		 }
    }
	
	
	public function uninstall(){
            
         $uninstall=I("uninstall","","trim");//要卸载的模块
		 $install_path=APP_PATH.$uninstall."/Install/"; //配置路径
		 $ERR_MSG="";
		 $SUCCESS_MSG="";
		 if(!$uninstall)
		 {
		       $ERR_MSG=L("ADMIN_Install_Err_3");
		       $this->assign('ERR_MSG',$ERR_MSG);
       	       $this->display();
			   return false; 
		 }		 
		 if(file_exists($install_path."exe.php")) require $install_path."exe.php";  
		 
	     if($this->uninstall_before) call_user_func_array($this->uninstall_before,array($uninstall));
		 $db_file=FF('db',"",$install_path);//获取原来的数据表
		 if(is_array($db_file))
		 {
			   foreach($db_file as $v)
			   {
				    if($this->uninstall_del_db) $return=call_user_func_array($this->uninstall_del_db,array($uninstall,$v));
					if($return!="_FALSE_")
					{
						del_table($v);
					}
			   }
		 } 
		 
		$del_data=array(
				'menu'=>array('url_m'=>$uninstall), //菜单
				'auth_rule'=>array('auth_m'=>$uninstall), //规则
				'auth_rule_class'=>array('sign'=>$uninstall), //规则分类
		 );
		 if($uninstall!='Article') del_data($del_data);
		 
		 $static_path="./Public/css_js_font_img/";
		 $file=new \Org\Util\File();
		 $file->deletedir($static_path.$uninstall."/");
		 if(file_exists($install_path."Install.Install"))
		 {
		       unlink($install_path."Install.Install");
		 }
		 if($this->uninstall_success) call_user_func_array($this->uninstall_success,array($uninstall));
		 $SUCCESS_MSG=L("ADMIN_Install_Success_1");
		 $this->assign('SUCCESS_MSG',$SUCCESS_MSG);
		 $this->display();
		 return false;
		 //卸载程序结束
    }
}
?>
<?php
namespace Install\Controller;
use Think\Controller;
class IndexController extends Controller {
	
   function __construct()  //析构函数
   {  
        parent::__construct(); 
		$file_Install=COMMON_PATH."Install.Install";
		
		if(is_file($file_Install))
		{
		   Header("Location: ./index.php");
		   exit();
		}
		
   } 
/*-----------------------------------  
  安装第一步
**----------------------------------- */
    public function step_0()
	{
        $this->display();
    }
/*-----------------------------------  
  安装第二步
**-----------------------------------*/
    public function step_1()
	{
         $this->display();
    }
/*-----------------------------------  
  安装第三步
**-----------------------------------*/
    public function step_2()
	{
		 $is_write=false;
		 $filename=COMMON_PATH."Conf/config.php";
		 if(is_file($filename)) 
		 {
			 if(unlink($filename)) $is_write=true;
		 }
		 else
		 {
			 FF('Conf/config','array()',COMMON_PATH); 
			 if(is_file($filename)) $is_write=true;
		 }
		 
		 
		 $data[0]['name']=L('PHP_VERSION');
		 $data[0]['power']=version_compare(PHP_VERSION,'5.3.0','<')?0:1;
		 $data[0]['title']="PHP 5.3.0";
		 
		 $data[1]['name']=L('PHP_CONFIG_DIR');
		 $data[1]['power']=$is_write?1:0;
		 $data[1]['title']=L('PHP_IS_WRITE');
		 
		 $this->assign('data',$data);
         $this->display();
    }
	
/*-----------------------------------  
  安装第四步
**-----------------------------------*/
    public function step_3()
	{
			 $this->display();			 
    }
/*-----------------------------------  
  安装第五步
**-----------------------------------*/
    public function step_4()
	{
		  C('TOKEN_ON',false); //关闭表单令牌
		  $data['web_name']=I('web_name');
          $data['user']=I('user');
		  $data['pass']=I('pass');
		  $data['confirm_pass']=I('confirm_pass');
		  $data['db_name']=I('db_name');
		  $data['db_user']=I('db_user')?I('db_user'):"root";
		  $data['db_pass']=I('db_pass')=='null'?'':I('db_pass');
		  $data['server']=I('db_server')?I('db_server'):'localhost';
		  $data['port']=I('db_port')?I('db_port'):'3306';
		  $data['db_pre']=I('db_pre')?I('db_pre'):'cow_';
		  	
		  
		  if(!$data['db_name']) $this->error(L('NO_DB_NAME'),"",10);
		  if(!$data['db_user'] || !$data['db_pass']) $this->error(L('NO_DB_USER_PASS'),"",10);
		  if(!$data['user'] || !$data['pass']) $this->error(L('NO_USER_PASS'),"",10);
		  if($data['pass']!=$data['confirm_pass']) $this->error(L('NGT_USER_PASS'),"",10);
		  
		  $con=mysql_con($data['db_user'],$data['db_pass'],$data['server'].":".$data['port']); 
		  if(!$con)  $this->error(L('DB_NOT_CON'),"",10);
		  S("post_install",$data);
		  mysql_close($con);
		  $this->display();	    
    }
/*-----------------------------------  
  安装第六步
**-----------------------------------*/
    public function step_5()
	{
		     file_put_contents(COMMON_PATH."Install.Install",'OK');
			 $this->display();			 
    }
/*-----------------------------------  
  安装内嵌页面1
**-----------------------------------*/
    public function step_4_1()
	{
			 ini_set('max_execution_time', '200');
             ob_end_clean();
              echo str_pad('',1024);
			  echo "<script>parent_=window.top.opener?window.top.opener:window.parent.parent;</script>";
		      $data=S("post_install");
			  S("post_install",null);	
              
			  echo_flush(L('INSTALL_MESSAGE'));
			  $path=APP_PATH."install/install/"; //APP路径
			  $sql_file=new \Org\Util\Install();
			  $sqls=$sql_file->read_array($path."sql.sql",0,array('--','#','/*'),$data['db_pre']);	
			  echo_flush(L('INSTALL_MESSAGE_'));
			  $total=count($sqls)+6;	
			  
			  if(!set_config($data)) echo_flush(L('INSTALL_ERR_0'),1);
			  echo_flush(L('INSTALL_MESSAGE_0'),0,floor(1/$total*100));
			  
			  $con=mysql_con($data['db_user'],$data['db_pass'],$data['server'].":".$data['port']); 
			  if(!$con) echo_flush(L('DB_NOT_CON'),1);
			  echo_flush(L('INSTALL_MESSAGE_1'),0,floor(2/$total*100));
			  mysql_query("SET NAMES 'UTF8'");
			  if(!set_db($data)) echo_flush(L('INSTALL_ERR_2'),1);
			  echo_flush(L('INSTALL_MESSAGE_2'),0,floor(3/$total*100));
			  $db_select=db_select($data['db_name'],$con);
			  if($db_select) mysql_query("DROP DATABASE ".$data['db_name'],$con);

			  if (!mysql_query("CREATE DATABASE ".$data['db_name']." default character set utf8",$con)) echo_flush(L('DB_NOT_CREATE_DB'),1);
			  mysql_select_db($data['db_name'], $con);
			  echo_flush(L('INSTALL_MESSAGE_3'),0,floor(4/$total*100));
	
			  unset($sqls['db_table']);//删除记录表名的元素
			  foreach($sqls as $k=>$sql)
			  {
				 if(is_string($sql) && $sql!="")
				 {
					 mysql_query($sql);
					 echo_flush(L('INSTALL_MESSAGE_4'),0,floor(($k+5)/$total*100));
				 }
			  }
			 if(!insert_admin($data,$con)) echo_flush(L('INSTALL_ERR_3'),1);
			 echo_flush(L('INSTALL_MESSAGE_5'),0,floor(($k+6)/$total*100));
			 mysql_close($con);	
			 echo_flush(L('INSTALL_MESSAGE_6'),0,100);	 		 
    }	
	
}
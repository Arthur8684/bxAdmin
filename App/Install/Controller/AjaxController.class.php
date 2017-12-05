<?php
namespace Install\Controller;
use Think\Controller;

class AjaxController extends Controller {

/*-----------------------------------   
   检查数据库是否链接成功   
**-----------------------------------  */	
    public function is_con(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $data['db_user']=I('db_user')?I('db_user'):"root";
			  $data['db_pass']=I('db_pass')=='null'?'':I('db_pass');
			  $data['server']=I('db_server')?I('db_server'):'localhost';
			  $data['port']=I('db_port')?I('db_port'):'3306';
			  $con=mysql_con($data['db_user'],$data['db_pass'],$data['server'].":".$data['port']);
			  if($con)
			  {
				   $return['content'] = 1;	 
				   $this->ajaxReturn($return);				  
			  }
			  else
			  {
				   $return['content'] = 0;	 
				   $this->ajaxReturn($return);	
			  }
    }
/*-----------------------------------   
   检查数据库是否存在   
**-----------------------------------  */	
    public function is_db(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $data['db_name']=I('db_name');
			  $data['db_user']=I('db_user')?I('db_user'):"root";
			  $data['db_pass']=I('db_pass')=='null'?'':I('db_pass');
			  $data['server']=I('db_server')?I('db_server'):'localhost';
			  $data['port']=I('db_port')?I('db_port'):'3306';
			  $con=mysql_con($data['db_user'],$data['db_pass'],$data['server'].":".$data['port']);
			  $db=db_select($data['db_name'],$con);
			  if($db)
			  {
				   $return['content'] = 1;	 
				   $this->ajaxReturn($return);				  
			  }
			  else
			  {
				   $return['content'] = 0;	 
				   $this->ajaxReturn($return);	
			  }
    }
}

?>
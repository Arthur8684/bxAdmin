<?php
namespace Org\Util;
class Install {

   function __construct()  //析构函数
   {  
       $this->files= new File();  
   } 
   
   function read($filename)
   {
        return $this->files->read($filename);
   }
	 /**
	 * 读取文件内容，将读取的内容放入数组中，每个数组元素为文件的一行，内容包括换行,所读取的数据会过滤以replace_str里开头的一行
	 * @access String $filename  文件名称
	 * @access Array String replace_str 要过滤的以此字符开头的一行
	 * @access Array String $pre表前缀
	 * @access Array String $is_get_table 是否获取要创建的数据表，默认为0不获取，1位获取，获取后返回的数组中$array_new['db_table']存放着数据表
	 * @return Array
	 */
   function read_array($filename,$is_get_table=0,$replace_str=array('--','#','/*'),$prefix='')
   {
	    $prefix=$prefix?$prefix:__PREFIX__;
        $array=array();
		$array_new=array();//存放新的数据
		$new_string="";//存放新的数据字符串
		$db_table=array();//存放所创建的数据表
	    $array=$this->files->read_array($filename);//将文件的每一行放到一个数组元素中
		if(!$array) return false;
		if(!is_array($replace_str)) $replace_str=(array)$replace_str;
		
		if($array)
		{
		      foreach($array as $v)
			  {
                  $sign=1;//说明当前的$v字符串在过滤的范围内 0表示在这个范围
				  
			       foreach($replace_str as $b)
				   {
				       if(strpos(trim($v),$b)===0)
					   {
					      $sign=0;//说明当前的$v字符串在过滤的范围内  0表示在这个范围
						  break;
					   }				   
				   }
				   
				   if($sign && trim($v))
				   {		
				       
					   //获取和替换对应的数据库表前缀 	 
						$patterns[]="/(INSERT INTO )`([A-Za-z0-9]*_)?([\S]+)`/i";
						$patterns[]="/(CREATE TABLE IF NOT EXISTS )`([A-Za-z0-9]*_)?([\S]+)`/i";
						$patterns[]="/(CREATE TABLE )`([A-Za-z0-9]*_)?([\S]+)`/i";
						$matches="";
						foreach($patterns as $k=>$pattern)
						{
						     if(preg_match($pattern,$v,$matches))
							 {								 
							    if($k==1 || $k==2)
								{
								    $db_table[$matches[3]]=$matches[3];// 获取到创建的数据表
								}						 
								$v=preg_replace($pattern,"\\1 `$prefix\\3`",$v);
								break;
							 }
						}
	                 //获取和替换对应的数据库表前缀 
				        $new_string=$new_string.trim($v);
				   }
			  }
	
		}
		$array_new=explode(";",$new_string);
        if($is_get_table) $array_new['db_table']=$db_table;
		return $array_new;
   }   
   
   
   	 /**
	 * 执行sql语句
	 * @access String $filename  文件名称
	 * @access Array String $sql 要执行的sql语句
	 * @return bool
	 */
   function query($sqls)
   {
		if($sqls)
		{
		     $m = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
             if(is_array($sqls))
			 {     
			       unset($sqls['db_table']);//删除记录表名的元素
			       foreach($sqls as $sql)
				   {
				       if(is_string($sql) && $sql!="")
					   {
					       $m->execute($sql);
					   }
				   }
			 
			 }
			 else
			 {
			     $m->execute($sqls);			 
			 }
	
		}
		return true;
   }  
   
 /**
 * 检查数据包是否存在
 * @access String $table  数据表，可以为数组
 * @access Array String $sql 要执行的sql语句
 * @return bool
 */
   function is_table_exist($table,$prefix='')
   {
	    $m = new \Think\Model(); // 实例化一个model对象 没有对应任何数据
		$prefix=$prefix?$prefix:__PREFIX__;
	    if(!is_array($table))
		{
		     $sql="SHOW TABLES LIKE '".$prefix.$table."'" ;
		     $table_info=$m->query($sql);
		}
		else
		{
			 foreach($table as $k=>$v)
			 {
				 $sql="SHOW TABLES LIKE '".$prefix.$v."'" ;
		         $table_return=$m->query($sql);
				 if($table_return) $table_info[]=$v;
			 }
		}

		return $table_info;
   } 
}
?>
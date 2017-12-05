<?php
namespace Org\Util;
class File  {

   function __construct()  //析构函数
   {  
       
   } 
/**
* 文件读取
* @access public
* @param string $filename 文件名称
* @return string
*/   
   function read($filename)
   {
        if($this->has($filename))
		{
		     $content=file_get_contents($filename);
			 return $content;		
		}
		else
		{
		     return false;
		}
   }
/**
* 文件写入
* @access public
* @param string $filename 文件名称
* @param string $path 文件路径
* @param string $data 要写入数据
* @return void
*/   
   function write($path,$filename,$data)
   {
        $this->create_dir($path);
		file_put_contents($path.$filename,$data);
   }  

 /**
 * 读取文件内容，将读取的内容放入数组中，每个数组元素为文件的一行，内容包括换行
 * @access String $filename
 * @return Array
 */
   function read_array($filename)
   {
   
   
        if($this->has($filename))
		{
             return  file($filename);		
		}
		else
		{
		     return false;
		}
        
   }
     
/**
 * 检查文件是否存在
 * @access public
 * @param string $filename 文件名称
 * @return bool
 */ 
   function has($filename)
   {
        return file_exists ($filename)  ; 
   }
   
   /**
 * 检查文件夹是否存在
 * @access public
 * @param string $path 文件名称
 * @return bool
 */ 
   function dir_has($path)
   {
        return is_dir ($path)  ; 
   }
   
 /**
 * 拷贝文件或目录
 * @access public
 * @param string $new 拷贝目录或者文件
 * @param string $old 目标目录或者文件
 * @param string $type 0为删除拷贝目录 1为不删除拷贝目录
 * @return bool
 */ 
   function copy_($new,$old,$type=1)
   {
	    if(!file_exists($old) && is_dir($old)) return false;
		 $pathinfo_new = pathinfo($new);
		 $path=$pathinfo_new['extension']?$pathinfo_new['dirname']:$new;
		 if(!is_dir($path))  mkdir($path, 0777, true);
	   
	     if(is_file($old))
		 {
			  if(!$pathinfo_new['extension'])
			  {
				  $pathinfo = pathinfo($old);
				  copy($old,$new. '/' . $pathinfo['basename']);
			  }
			  else
			  {
				  copy($old,$new);
			  }
		 }
		 else
		 {
			 if(!$pathinfo_new['extension'])
			 {
				  $dir= scandir($old);
				  foreach ($dir as $filename ) 
				  { 
				      if(!in_array($filename,array('.','..')) )
					  {
						   if(is_dir($old."/".$filename))
						   {
							   $this->copy_($new."/".$filename,$old."/".$filename,$type);
							   continue;
						   }
						   else
						   {
							    copy($old."/".$filename,$new."/".$filename);
						   }
					  }
				  }
				 
			 }
		 }
		 
		 closedir($old);   
   } 

 /**
 * 删除文件
 * @access public
 * @param string $dir 删除目录
 * @return bool
 */    
   function delete($file)
	{
		if($this->has($file))
		{
			return unlink($file);
		}
	}
/**
* 创建文件夹
* @access public
* @param string $path 文件夹路径
*/    
   function create_dir($path)
   {
	    if(!$this->dir_has($path))
		{
		     mkdir($path,0777,true); 
		}
   }  
 /**
 * 删除文件夹
 * @access public
 * @param string $dir 删除目录
 * @return bool
 */    
   function deletedir($dir)
	{
		 //先删除目录下的文件：
		  $dh=opendir($dir);
		  while ($file=readdir($dh)) {
			if($file!="." && $file!="..") {
			  $fullpath=$dir."/".$file;
			  if(!is_dir($fullpath)) {
				  unlink($fullpath);
			  } else {
				  $this->deletedir($fullpath);
			  }
			}
		  }
		 
		  closedir($dh);
		  //删除当前文件夹：
		  if(rmdir($dir)) {
			return true;
		  } else {
			return false;
		  }
	} 
 /**
 * 获取目录下的所有文件路劲 包括子目录的文件
 * @access public
 * @param string $dir 顶级目录
 * @return array
 */    
   function get_all_dir($dir)
    {
        $result = array();
        $handle = opendir($dir);
        if ( $handle )
        {
            while ( ( $file = readdir ( $handle ) ) !== false )
            {
                if ( $file != '.' && $file != '..')
                {
                    $cur_path = $dir."/".$file;
                    if ( is_dir ( $cur_path ) )
                    {
						$files=$this->get_all_dir( $cur_path );
						if($files) $result=$result?array_merge($result, $files):$files;
                    }
                    else
                    {
                        $result[] = C('root_path').$cur_path;
                    }
                }
            }
            closedir($handle);
        }
        return $result;
    }  
}
?>
<?php
/*
-----------------------------------
过滤空值数组
-----------------------------------   
*/	
function data_array($data)
{
	 if($data)
	 {
		 foreach($data as $k=>$v)
		 {
			  if(!$v) unset($data[$k]);
		 }
		 return $data;
	 }
	 else
	 {
		 return "";
	 }
	 
}
/*
-----------------------------------
提示信息
-----------------------------------   
*/		
function show_js_msg($msg)
{
	 exit("<script>alert('".$msg."')</script>");
}

/*
-----------------------------------
   树状显示文件夹
   $parent_path 父路径
   $char 体现文件夹层级的字符 数组或字符串 如果是数组  第一个元素为开始字符，第二个为中间字符 第三个为结束字符
-----------------------------------   
*/	
   function dir_show($user,$parent_path="",$c=1,$char=array('<span class=\'font_color_6\'>├','--','<span>')){  
			  //------------------------------------文件夹列表----------------------------------------
		  $base_path="upload/".$user['admin']."/".$user['id'];
		  $root_path=$parent_path?$base_path."/".$parent_path."/":$base_path."/";
		  $img_path=C("TMPL_PARSE_STRING.__STATIC__")."img/ext/";
		  $char=$char?$char:array('├','-','');		  
		  $folder_array=scandir($root_path);
		  $charstr=numstr($c,$char); //显示层级的字符串
		  foreach($folder_array as $k=>$v)
		  {
		       if($v!="." && $v!="..")
			   {
				   $filename=explode('.', $v);
				   if($filename[1])
				   {
				       // $str.="<div class='file_left_li'>".$charstr."<img name='' src='".$img_path."file.png'/>".$v."</div>";
				   }
				   else
				   {
				       $sub_str=dir_show($user,$parent_path."/".$v,$c+1,$char);
					   $path_array=$parent_path?explode('/',$parent_path."/".$v):array($v);
					   if($sub_str)
					   {
							$str.="<div class='file_left_li' onClick=\"show_div('parent_".$c."_".$k."')\">".$charstr."<img name='' src='".$img_path."dir.png' id='img_parent_".$c."_".$k."'/><a href='".U('File/Upload/file_list',array('parent_path'=>serialize($path_array),'folder'=>$v))."' target='connect_iframe'>".$v."</a></div><div style='display:none' id='parent_".$c."_".$k."'>".$sub_str."</div>";
					   }
					   else
					   {
							$str.="<div class='file_left_li'>".$charstr."<img name='' src='".$img_path."dir_.png' /><a href='".U('File/Upload/file_list',array('parent_path'=>serialize($path_array),'folder'=>$v))."' target='connect_iframe'>".$v."</a></div>";
					   }
				   }

			   }
		  }

              return $str;
    }	


/*
-----------------------------------
   删除文件夹
   $dir 路径
-----------------------------------   
*/	
function deleteDir($dir)
{
	 //先删除目录下的文件：
	  $dh=opendir($dir);
	  while ($file=readdir($dh)) {
		if($file!="." && $file!="..") {
		  $fullpath=$dir."/".$file;
		  if(!is_dir($fullpath)) {
			  unlink($fullpath);
		  } else {
			  deleteDir($fullpath);
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
?>

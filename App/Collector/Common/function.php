<?php
/*
-----------------------------------  
   获取列表配置数据
   $id  配置id
   $field  获取字段配置
-----------------------------------   
*/
 function get_list_config($id){
		  $File=new \Org\Util\File();
		  $file=$File->read(COMMON_PATH."Cache/collector/".$id."_list_config.config");
		  $file=$file?addslashes($file):"";
		  
		  $return=array();
		  if($file)
		  {
			  $fields=array('url','content','unit','condition');
			  if($fields)
			  {
					foreach($fields as $k=>$v)
					{
						  $return_array=array();
						  preg_match("/<!--start_".$v."-->([\s\S]*?)<!--end_".$v."-->/i",$file,$field);
						  $array=explode("<!--*****-->",$field[1]);
						  $return_array['start']=stripslashes(trim($array[0]));
						  $return_array['end']=stripslashes(trim($array[1]));
						  $return_array['replace']=stripslashes($array[2]);
						  if($array[3]) $return_array['filter']=explode("|",$array[3]);	
						  $return[$v]=$return_array;
					}
			  }
		  }
		  return $return;
    }
/*
-----------------------------------  
   获取配置数据
   $id  配置id
   $field  获取字段配置
-----------------------------------   
*/
 function get_config($id,$field){
		  $File=new \Org\Util\File();
		  $file=$File->read(COMMON_PATH."Cache/collector/".$id."_config.config");
		  $file=$file?addslashes($file):"";
		  if($file)
		  {
			  preg_match("/<!--start_".$field."-->([\s\S]*?)<!--end_".$field."-->/i",$file,$tem);	  		  
		  }
		  if($tem)
		  {
			  $array=explode("<!--*****-->",trim($tem[1]));
			  $return['start']=stripslashes(trim($array[0]));
			  $return['end']=stripslashes(trim($array[1]));
			  $return['replace']=stripslashes($array[2]);
			  if($array[3]) $return['filter']=explode("|",$array[3]);
		  }
		  return $return;
    }	
	
/*
-----------------------------------  
   获取配置文件的全部变量
   $id  配置id
-----------------------------------   
*/
 function get_configs($id){
		  $File=new \Org\Util\File();
		  $file=$File->read(COMMON_PATH."Cache/collector/".$id."_config.config");
		  $file=$file?addslashes($file):"";
		  
		  $return=array();
		  if($file)
		  {
			  preg_match("/<!--start_select_fields_system-->([\s\S]*?)<!--end_select_fields_system-->/i",$file,$fields);	
			  if($fields)
			  {
				    $fields=explode("|",trim($fields[1]));

					foreach($fields as $k=>$v)
					{
						  $return_array=array();
						  preg_match("/<!--start_".$v."-->([\s\S]*?)<!--end_".$v."-->/i",$file,$field);
						  $array=explode("<!--*****-->",$field[1]);
						  $return_array['start']=stripslashes(trim($array[0]));
						  $return_array['end']=stripslashes(trim($array[1]));
						  $return_array['replace']=stripslashes($array[2]);
						  if($array[3]) $return_array['filter']=explode("|",$array[3]);	
						  $return[$v]=$return_array;
					}
			  }
		  }
		  return $return;
    }
	
	
/*
-----------------------------------  
   登陆采集
   $cookie_file  cookie文件名
   $login_url  登陆连接
   $parm  登陆参数如用户名密码
   $charset  登陆编码
-----------------------------------   
*/
 function collector_login($cookie_file,$login_url,$parm,$charset='UTF-8'){
	    $path=COMMON_PATH."Cache/collector/cookie/";
		
	    $File=new \Org\Util\File();
		$File->create_dir($path);
		header("content-Type: text/html; charset=$charset");
		$cookie_file = $path."cookie_".$cookie_file;
		$post_fields=$parm;
		
		//提交登录表单请求
		$ch=curl_init($login_url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);
		curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file); //存储提交后得到的cookie数据
		curl_exec($ch);
		curl_close($ch);
    }
/*
-----------------------------------  
   登陆采集
   $url  采集连接
   $is_login  是否需要登陆，如果需要登陆请输入cookie文件名
   $charset  采集编码
-----------------------------------   
*/
 function collector_data($url,$is_login=0,$charset='UTF-8'){
	    header("content-Type: text/html; charset=$charset");
		$ch=curl_init($url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		if($is_login)
		{
			$cookie_file = COMMON_PATH."Cache/collector/cookie/cookie_".$is_login;
			curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file); //使用提交后得到的cookie数据做参数
		}
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1); // 获取转向后的内容    
		$contents=curl_exec($ch);
		curl_close($ch);
        if(!$contents) $contents=file_get_contents($url);
		return $contents;
    }
	
/*
-----------------------------------  
   获取采集翻页列表
   $info  采集配置记录对象
   $table  配置采集模型表
-----------------------------------   
*/
 function get_collector_page_urls($info){
	 
	        if(!$info) return false;
            $min=$info['num_min']?$info['num_min']:0;
			$max=$info['num_max']?$info['num_max']:0;
			$url=$info['url'];

			$page_list=array();
			for($min ;$min<=$max;$min++)
			{
				 $page_list[$min]=str_ireplace('{*}',$min,$url);
			}
			return $page_list;
    }
	
/*
-----------------------------------  
   获取某一页 采集列表_采集内容目录
   $info  采集配置记录对象
   $page  采集页面页数
   $charset 采集页面的编码
-----------------------------------   
*/
 function get_collector_list($info,$page_url=""){
	 
	        if(!$info) return false;
			$page=$page?$page:$info['num_min'];
			$url=$page_url;
            $min=$info['num_min']?$info['num_min']:0;
			$max=$info['num_max']?$info['num_max']:0;
			$login_url=$info['login_url'];
            $parm=array($info['user'],$info['pass'],$info['parm']);
			$parm=implode('&',$parm);
            $charset=$info['charset']?$info['charset']:'UTF-8';
			if($info['is_login'])
			{
				collector_login($info['id'],$login_url,$parm,$charset);
				$is_login=$info['id'];
			}
			$data=collector_data($url,$is_login,$charset);
			$config=get_list_config($info['id']);
			if($config['content']) //获取所有列表
			{
				$start=$config['content']['start'];
				$end=$config['content']['end'];
				$replace=$config['content']['replace'];
				$filter=$config['content']['filter'];
				$data=preg_match_str($start,$end,$data,$replace,$filter);
			}

			if($config['unit']) //获取多个单元列表
			{
				$start=$config['unit']['start'];
				$end=$config['unit']['end'];
				$replace=$config['unit']['replace'];
				$filter=$config['unit']['filter'];
				$data=preg_match_strs($start,$end,$data,$replace,$filter);
			}
			if($data)
			{
				  $condition_start=$config['condition']['start'];
				  $condition_end=$config['condition']['end'];
				  $condition_replace=$config['condition']['replace'];
				  $condition_filter=$config['condition']['filter'];
				  $condition_return=condition($condition_replace);
					  
				  $start=$config['url']['start'];
				  $end=$config['url']['end'];
				  $replace=$config['url']['replace'];
				  $filter=$config['url']['filter'];		
				  							  
				  $return=array();
				  foreach($data as $k=>$v)
				  {
					  
					  if($v)
					  {
						  if($config['condition']) //获取多个单元列表
						  {
							  $condition=preg_match_str($condition_start,$condition_end,$v,'',$condition_filter);
							  $condition_return=condition($condition_replace);
							  if($condition_return )
							  {
								   $is_collector=false;
								   foreach($condition_return as $val)
								   {
									   if(stripos($condition,$val)!==false)
									   {
										   $is_collector=true;
										   continue;
									   } 
								   }
								   if(!$is_collector) continue;
							  }
						  }	  
						  
						  $url=preg_match_str($start,$end,$v,$replace,$filter);	 // 获取A标签的连接		
						  $list['url']=$url;
						  $list['condition']=$condition;
					  }
					  $return[]=$list;	
				  }
				  	
			}			
			return 	$return;
    }

/*
-----------------------------------  
   获取单个内容页面内容
   $info  采集配置记录对象
   $urls  采集页面记录集合
-----------------------------------   
*/
 function get_collector_contents($urls,$info,$show=1){
	        if(!$info) return false;
            
			$record_interval=$info['record_interval']?$info['record_interval']:0;
			
			$login_url=$info['login_url'];
            $parm=array($info['user'],$info['pass'],$info['parm']);
			$parm=implode('&',$parm);
            $charset=$info['charset']?$info['charset']:'UTF-8';
			if($info['is_login'])
			{
				collector_login($info['id'],$login_url,$parm,$charset);
				$is_login=$info['id'];
			}
			$configs=get_configs($info['id']);
			
			$table=model_f($info['model_id'],'table');
			$m=M($table);
			$collector_url=M('collector_url');
			$insert=array();
			
			
			foreach($urls as $url)
			{
				$fields=array();
				$is_url=$collector_url->where(array('table'=>$table,'url'=>$url))->find();
				if($is_url) continue;
				$data=collector_data($url,$is_login,$charset);
				if($data)
				{ 
					 foreach($configs as $k=>$v)
					 {
							if($v)
							{
								  $start=$v['start'];
								  $end=$v['end'];
								  $replace=$v['replace'];
								  $filter=$v['filter'];
								  $data_field=preg_match_str($start,$end,$data,$replace,$filter);
								  $fields[$k]= strtolower($charset)=='utf-8'?trim($data_field):iconv($charset,"utf-8//IGNORE",trim($data_field));;								
							}
					 }
					$inserid=$m->data($fields)->add();
					if($show && $record_interval)  
					{
						echo "<br>成功采集，下条采集预计在".$record_interval."秒后，采集链接：".$url;
					}
					$collector_url->add(array('url'=>$url,'table'=>$table,'insertid'=>$inserid));
					//$insert[]= $fields;
				}
				if($record_interval>0) sleep($record_interval);//暂停3秒
			}

			return 	$insert;
    }	
	
/*
-----------------------------------  
   获取单个内容页面内容
   $info  采集配置记录对象
   $urls  采集页面记录集合
-----------------------------------   
*/
 function get_collector_content($url,$info,$configs=""){

	        if(!$info) return false;

            $charset=$info['charset']?$info['charset']:'UTF-8';
			
			if($info['is_login']) $is_login=$info['id'];
			
			$configs=$configs?$configs:get_configs($info['id']);
			
			$table=model_f($info['model_id'],'table');
			$m=M($table);
			$collector_url=M('collector_url');

			$fields=array();
			$is_url=$collector_url->where(array('collector_id'=>$info['id'],'url'=>$url))->find();
			if($is_url) return false;
			$data=collector_data($url,$is_login,$charset);
			if($data)
			{ 
				 foreach($configs as $k=>$v)
				 {
						if($v)
						{
							  $start=$v['start'];
							  $end=$v['end'];
							  $replace=$v['replace'];
							  $filter=$v['filter'];
							  $data_field=preg_match_str($start,$end,$data,$replace,$filter);
							  $fields[$k]= strtolower($charset)=='utf-8'?trim($data_field):iconv($charset,"utf-8//IGNORE",trim($data_field));;								
						}
				 }
				$inserid=$m->data($fields)->add();
				$collector_url->add(array('url'=>$url,'collector_id'=>$info['id']));
			}

			return 	$inserid;
    }	
/*
-----------------------------------  
   正则匹配，并替换，匹配单次
   $start  匹配开始字符串
   $end  匹配结束字符串
   $data 要匹配的数据
   $replace 匹配后要替换的字符串，格式为  a=b 表示把a替换成b，多个用|隔开
   $filter 要过滤的标签
-----------------------------------   
*/
 function preg_match_str($start,$end,$data,$replace="",$filter=""){
		  
		  if($start && $end) preg_match("/".preg_quote($start,'/')."([\s\S]*?)".preg_quote($end,'/')."/i",$data,$text);
		  
		  $replace=str_array($replace);
		  $data=$text[1];
          $data=filter($data,$filter);
		  foreach($replace as $k=>$v)
		  {
			 if(trim($data) && trim($v[0])!='[null]')
			 {
				 $data=str_ireplace($v[0],$v[1],$data);
			 }
			 else if(!trim($data_array[0]) && trim($v[0])=='[null]')
			 {
				  if(trim($v[1])=="[time]")
				  {
					  $data=time();
				  }
				  else
				  {
					  $data=trim($v[1]);
				  }      
			 }
			  
		  }
		  return  $data;
    }
	
	/*
-----------------------------------  
   正则匹配，并替换， 匹配多次
   $start  匹配开始字符串
   $end  匹配结束字符串
   $data 要匹配的数据
   $replace 匹配后要替换的字符串，格式为  a=b 表示把a替换成b，多个用|隔开
   $filter 要过滤的标签
-----------------------------------   
*/
 function preg_match_strs($start,$end,$data,$replace="",$filter=""){
		  if($start && $end) preg_match_all("/".preg_quote($start,'/')."([\s\S]*?)".preg_quote($end,'/')."/i",$data,$text);
		  
		  $replace=str_array($replace);
		  $data_array=$text[1];

		  foreach($replace as $k=>$v)
		  {
				 $data_array=str_ireplace($v[0],$v[1],$data_array);
		  }
		  
		  if($filter)
		  {
			   foreach($data_array as $key=>$val)
			   {
				   $data_array[$key]=filter($val,$filter);
			   }					 
		  }
		  return  $data_array;
    }
/*-----------------------------------  
    字符串转换数组
-----------------------------------   */
 function str_array($str){
          $array=explode('|',$str); 
		  $return=array();
		  foreach($array as $v) 
		  {
			  if($v)
			  {
				  $arr=explode('=',$v); 
				  $return[]=array($arr[0],$arr[1]);
			  }
		  }
		  return $return;
    }	
/*-----------------------------------  
    过滤标签
-----------------------------------   */
 function filter($data,$filter){
          if($filter)
		  {
			  $data=htmlspecialchars_decode($data);
			   if(in_array('html',$filter)) $data=preg_replace("/<([\s\S]*?)>/is","",$data); 
			   if(in_array('script',$filter)) $data=preg_replace("/<script([\s\S]*?)</script>/is","",$data);
			   if(in_array('iframe',$filter)) $data=preg_replace("/<iframe([\s\S]*?)</iframe>/is","",$data);  
			   if(in_array('style',$filter)) $data=preg_replace("/<style([\s\S]*?)</style>/is","",$data);  
		  }
          return $data;
    }	
/*-----------------------------------  
    过滤标签
-----------------------------------   */
 function condition($str){
          if($str)
		  {
			   $str_array=explode('|',$str); 
			   foreach($str_array as $k=>$v)
			   {
				   $str_v=trim($v);
				   if($str_v && substr($str_v,0,1)=="{")
				   {
					   $replace=substr($str_v,1,strlen($str_v)-2);
					   $str_array[$k]=date($replace);
				   }
				   
			   }
		  }
          return $str_array;
    }		
?>

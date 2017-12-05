<?PHP
/*
-----------------------------------  
   设置字段缓存
   $table  要设置缓存的数据表 如果为数字为模型ID
-----------------------------------   
*/	
 function field_set_config($table){
	
	       if(is_numeric($table))
		   {
				$model =M('model');
				$where['id']=$table;
				$model_info=$model->where($where)->find();
				$table=$model_info['table'];  
		   }
           $field =M('table_field');
		   $data['table']=$table;
		   $data['status']=1;
		   $fields=$field->where($data)->order('sort asc,id desc')->select();
		   $fields_array=array();
		   if($fields)	
		   {
		       foreach($fields as $k=>$v)
			   {
			        $fields_array[$v['id']]=$v;
					$fields_array[$v['id']]['setting']=string2array($v['setting'],0);
					$fields_array[$v['id']]['tem_c']=addslashes($v['tem_c']);
					$fields_array[$v['id']]['tem_mobile_c']=addslashes($v['tem_mobile_c']);
					$fields_array[$v['id']]['show_tem']=addslashes($v['show_tem']);
			   }
		       
		   }
		   FF("field/field_".$table, $fields_array);
    }	
/*
-----------------------------------  
   创建模型系统字段
   $table  要设置缓存的数据表 如果为数字为模型ID
-----------------------------------   
*/
 function field_set_model_field($table){
	
	       if(is_numeric($table))
		   {
				$model =M('model');
				$where['id']=$table;
				$model_info=$model->where($where)->find();
				$table=$model_info['table'];  
		   }
           $field =M('table_field');
		   $data['table']=$table;
		   $fields=$field->where($data)->order('sort asc,id desc')->select();
		   $fields_array=array();
		   if($fields)	
		   {
		       foreach($fields as $k=>$v)
			   {
			        unset($v['id']);
					$v['table']='_SIGN_';
					$v['is_del']='1';
			        $fields_array['table_field'][]=$v;
/*					$fields_array[$table]['setting']=string2array($v['setting'],0);
					$fields_array[$table]['tem_c']=addslashes($v['tem_c']);
					$fields_array[$table]['tem_mobile_c']=addslashes($v['tem_mobile_c']);
					$fields_array[$table]['show_tem']=addslashes($v['show_tem']);*/
			   }
		       
		   }
		   FF("field/model/field_".$table, $fields_array);
    }	
	
/*
-----------------------------------  
   获取模板数据
   $name  模板方案标识
-----------------------------------   
*/
 function get_tem($name,$type){
		  $File=new \Org\Util\File();
		  $file=$File->read(COMMON_PATH."form_tem/".$name.".tpl");
		  $file=$file?addslashes($file):"";
		  if($file)
		  {
			  preg_match("/<!--".$type."-->([\s\S]*?)<!--".$type."_end-->/i",$file,$tem);	  		  
		  }
		  return trim($tem[1]);
    }	
	
/*
-----------------------------------  
   获取模板数据
   $name  模板方案标识
-----------------------------------   
*/
 function get_tems($name,$form_type,$table){
		  $File=new \Org\Util\File();
		  $file=$File->read(COMMON_PATH."form_tem/".$name.".tpl");
		  $file=$file?addslashes($file):"";
		  
		  $return=array();
		  if($file)
		  {
			  foreach($form_type as $k=>$v)
			  {
				   $tem=array();
				   $tem_m=array();
				   preg_match("/<!--globals_".$k."-->([\s\S]*?)<!--globals_".$k."_end-->/i",$file,$tem);
				   preg_match("/<!--globals_mobile_".$k."-->([\s\S]*?)<!--globals_mobile_".$k."_end-->/i",$file,$tem_m);
				   if(trim($tem[1])) $return['globals_'.$k]=stripslashes(trim($tem[1])); 
				   if(trim($tem_m[1])) $return['globals_mobile_'.$k]=stripslashes(trim($tem_m[1])); 
			  } 	  		  
		  }
		  $fields=FF("field/field_".$table);	
		  if($fields)
		  {
			  foreach($fields as $k=>$v)
			  {
				   if($v['status']==1)
				   {
				         $tem=array();
				         $tem_m=array();
						 preg_match("/<!--field_".$v['field']."-->([\s\S]*?)<!--field_".$v['field']."_end-->/i",$file,$tem);
						 preg_match("/<!--field_mobile_".$v['field']."-->([\s\S]*?)<!--field_mobile_".$v['field']."_end-->/i",$file,$tem_m);
						 if(trim($tem[1])) $return['field_'.$v['field']]=stripslashes(trim($tem[1])); 		
						 if(trim($tem_m[1])) $return['field_mobile_'.$v['field']]=stripslashes(trim($tem_m[1])); 				   
				   }
			  } 	  			  
		  }
		  return $return;
    }
?>
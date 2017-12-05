<?php 
/*
递归显示产品分类 返回数组
$model_id 模型id;
$parent_id 父id;
*/
  function class_array($model_id,$parent_id=0,$num=8)
  {
	  if(!$model_id) return false;
	  $nav=M('sys_model_class')->where(array('model_id'=>$model_id,'status'=>1,'parent_id'=>$parent_id))->limit($num)->select();
	  if($nav){
		 foreach($nav as $val){
			 $val['next_cate']=class_array($model_id,$val['id']);
			 $nav_news[]=$val;
			 } 
		  }
		 return $nav_news;
	  } 
/*
所传分类下的所有产品 返回多维数组
$model_id 模型id;
$parent_id 父id;
$class_num 首级分类显示几个
$product_num 每级显示产品的数量
*/  
  function class_product($model_id,$parent_id=0,$class_num=6,$product_num=10,$ad=array())
  {
	  if(!$model_id) return false;
	  $nav=M('sys_model_class')->where(array('model_id'=>$model_id,'status'=>1,'parent_id'=>$parent_id))->limit('0,'.$class_num.'')->select();
	  if(!$nav) return '';
	  $table=model_f($model_id);
	  foreach($nav as $key=>$val){
		  $arr=class_child($model_id,$val['id']);
		  if($arr) $where['class_id']=array('in',$arr);
			  $val['next_cate']=class_array($model_id,$val['id'],9);
			  $val['recommend']=1;
			  $val['goods_list']=M($table)->where($where)->limit('0,'.$product_num.'')->select();  
			  $val['ad']=$ad[$key];
			  $nav_news[]=$val;
		  }
		 return $nav_news;	  
	  }
/*
递归显示分类下所有子类 返回array
$model_id 模型id; 
$class_id 分类id;
*/  
  function class_child($model_id,$class_id=0)
  {
	  if(!$model_id) return false;
	  $nav=M('sys_model_class')->where(array('model_id'=>$model_id,'status'=>1,'parent_id'=>$class_id))->getField('id',true);
	  if($nav){
		 foreach($nav as $val){
			 $nav2=class_child($model_id,$val);
				 if($nav2){
					 $nav=array_merge($nav2,$nav);
				 }
			 } 
		  }else{
	   $nav=array($class_id);  
			  }
	   return $nav;
	  }

	  
  function class_id_array($class_id,$i=0)
  {
	  $parent_id=M('sys_model_class')->where(array('id'=>$class_id))->getField('parent_id');
	  if($parent_id>0){
		  	 $array=array($parent_id);
			 if($i==0) $array=array_merge($array,array($class_id));
	  		 $array2=class_id_array($parent_id,$i+1);
			 if($array2){
				  $array=array_merge($array2,$array);
			 }
	  }
	  return $array;
  }
//显示父子类链接  
 function show_cate_url($class_id_array, $class)
 {
	if(!$class_id_array)  return '';
	foreach($class_id_array as $val)
	{
		$title=M('sys_model_class')->where(array('id'=>$val))->getField('name');
		$html.=" <a href=\"".U('goods/index/goods_cate',array('id'=>$val))."\" class=".$class.">".$title."</a> <code>&gt;</code>";
	}
	echo $html; 
 }
// 
 function middle($max,$min,$num,$float)
 {
	 if($num>0){
	 	$middle=round(ceil(($max+$min)/2),$float);
		$array=array($middle);
		$middle_next_min=middle($middle,$min,$num-1);
		//$middle_next_max=middle($max,$middle,$num-1);
		if($middle_next_min)
		{
			$array=array_merge($array,$middle_next_min);
		}	
/*		if($middle_next_max)
		{
			$array=array_merge($array,$middle_next_max);
		}*/
	 }
	 return $array;
 }

 function show_price_section($max,$min,$section_num)
 {
	 if($max==$min) return '';
	 $array=array(round($min, $float));
	 $middle=middle($max,$min,$section_num,$float);
	 $array=array_merge($array,$middle);
	 $array=array_merge($array,array(round($max, $float)));
	 sort($array);
	 foreach($array as $key=>$val)
	 {
	 	if($array[$key+1]){
			$new_array['min']=$val;
			$new_array['max']=$array[$key+1];
			$new[]=$new_array;
		}
	 }
	 return $new;
 }
 
 function show_foot_list($model_id,$class_num,$list_num,$table_width='1212',$in_array='')
 {
	    if(!$model_id) return '';
		$where['model_id']=$model_id;
		$where['status']=1;
		$in_array=explode(',',$in_array);
		if($in_array) $where['id']=array('not in',$in_array);
		$show_cate=M('sys_model_class')->where($where)->limit(''.$class_num.'')->select();
		foreach($show_cate as $val)
		{
			$val['list']=M(model_f($model_id))->where(array('class_id'=>$val['id']))->select();
			$new[]=$val;
		}
		$html="<table width=".$table_width." border=0 height=120 cellspacing=0 cellpadding=0 align=\"center\">";
		$html.="<tr>";
		foreach($new as $v)
		{
			$html.="<td width=".$table_width/$class_num." align=\"left\" valign=\"top\" >";	
			$html.="<h1 style=\"font-size:18px;line-height:40px; font-weight:bold\">".$v['name']."</h1>";
			foreach($v['list'] as $vs)
			{
				$html.="<p><a href=\"".U('Article/index/index_show',array('id'=>$vs['id'],'model_id'=>$model_id))."\">".$vs['title']."</a></p>";
			}
			$html.="</td>";
		}
		$html.
		$html.="<tr>";
  		$html.="</table>";
		echo $html;
 }
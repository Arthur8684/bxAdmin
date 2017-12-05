<?php
/*
评论添加的方法
$user_id       类型：int 发布会员id
$model_id      类型：int 发布文章或产品的模型id
$goods_id      类型：int 发布文章或产品的id
$star          类型：int 发布文章或产品的星级
$content       类型：var 发布的内容
$other         类型：var 杂项
*/
	function add_comment($user_id,$model_id,$goods_id,$star,$content,$other)
	{
		if(!$user_id) return 1 ;//用户id为空返回1
		if(!$model_id) return 2 ;//model_id为空返回2
		if(!$goods_id) return 3 ;//产品或者文章id为空返回3
		if(!$content) return 4 ;//评论内容为空返回4
		$c=FF("Comment/comment_config_".$model_id."");
		if(!$c) $c=FF("Comment/comment_config");
		if($c['open']==0) return 5 ;//该模型的评论是关闭的 返回5
		if($c['is_pay']==1){
			$config=FF('Conf/db','',COMMON_PATH);
			$is_pay=M('order')->where(array('user_id'=>$user_id,'ship_status'=>2))->join('LEFT JOIN '.$config['DB_PREFIX'].'order_info ON '.$config['DB_PREFIX'].'order.order_sn = '.$config['DB_PREFIX'].'order_info.order_sn' )->find();
			$order_sn=M('order')->where(array('user_id'=>$user_id,'ship_status'=>2))->getField('order_sn',true);
			$is_pay=M('order_info')->where(array('order_sn'=>array('in',$order_sn),'model_id'=>$model_id,'goods_id'=>$goods_id))->find();
			if(!$is_pay){
				return 6 ;	//未支付不能评论返回6
			}
		}
		if($c['user_group']){
			$group=M('user')->where(array('id'=>$user_id))->getField('group_id');
			if (!in_array($group,$c['user_group'])) return(7);	//不在可发布用户组返回7;
		}
		$info=M('comment')->where(array('model_id'=>$model_id,'goods_id'=>$goods_id,'user_id'=>$user_id))->find();
		if($info)  return(8);	//仅能发表一次返回8;
		if($c['filter_word']){//敏感词替换
			$filter_word=explode("|",$c['filter_word']);
			$filter_word= array_combine($filter_word,array_fill(0,count($filter_word),'*'));
			$content= strtr($content,$filter_word);
		}
		$is_audit=1;
		if($c['is_audit']==1) $is_audit=0;
		if(M('comment')->add(array('user_id'=>$user_id,'model_id'=>$model_id,'goods_id'=>$goods_id,'star'=>$star,'content'=>$content,'is_audit'=>$is_audit,'addtime'=>time()))){
			if($c['comment_point_type'] && $c['point_num']){
				$goods_info=M(model_f($model_id))->where(array('id'=>$goods_id))->getField('title');
				if($c['is_audit']==0) account($user_id,array($c['comment_point_type']=>$c['point_num']),6,6,L('SYSTEM'),L('account_comment_sccess',array('goods_info'=>$goods_info)));
			}
			return 99 ;
		}	
	}
	
/*
js显示评论列表和添加评论的方法
*/
/*	function comment($model_id,$goods_id,$form_id='form1',$content_id='content')
	{
		$c=FF("Comment/comment_config_".$model_id."");
		if(!$c) $c=FF("Comment/comment_config");
		if($c['open']==1){
			if(!$model_id) exit($html='');
			if(!$goods_id) exit($html='');
			$html="<div id=\"comment_list\"></div>";
			$html.="<div id=\"add_comment\"></div>";
			$html.="<script type=\"text/javascript\">";
			$html.="function check_form(){";
			$html.="if($(\"#".$content_id."\").val()==''){";
			$html.="alert('内容不能为空！');";
			$html.="return false";
			$html.="}";
			$html.="return true";
			$html.="}";
			$html.="$.get(\"".U('Comment/Ajaxcomment/comment_list_html')."\", { model_id: '".$model_id."', goods_id:'".$goods_id."'} , function(data){";
			$html.="$('#comment_list').html(data);";
			$html.="});";
			$html.="$.get(\"".U('Comment/Ajaxcomment/add_comment_html')."\", { model_id: '".$model_id."', goods_id:'".$goods_id."'} , function(data){";
			$html.="$('#add_comment').html(data);";
			$html.="});";
			$html.="</script>";
			echo $html;
		}
	}
	*/
	
/*ajax翻页*/

  function ajax_page_show($record_count,$pagesize,$model_id,$goods_id,$div_id,$page_now=1)
   {
		  	
			$page=ceil($record_count/$pagesize);
			if($page==1) return '';
			if($page_now<=1){
				$page_show.="<< ";
				$page_show.="< ";				
			}else{
				$page_show.="<a href='javascript:page_show(1)'><<</a> ";
				$page_show.="<a href='javascript:page_show(".($page_now-1).")'><</a> ";
   			}
			$page_show.=$page_now;
			if($page_now<$page){
				$page_show.=" <a href='javascript:page_show(".($page_now+1).")'>></a> ";
				$page_show.="<a href='javascript:page_show(".$page.")'>>></a> ";
			}else{
				$page_show.=" > ";
				$page_show.=">> ";				
				}
			return $page_show;

   }
?>

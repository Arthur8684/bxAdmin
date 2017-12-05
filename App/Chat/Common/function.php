<?php
/*-----------------------------------  
赠送礼物
* @param        int       $form_userid  送礼物用户ID
* @param        int       $to_userid    接受礼物用户ID
* @param        int       $gift_id    礼物ID
* @param        int       $num    送礼物数量
* @return       string  array      
----------------------------------- */	
function give_presents($form_userid,$to_userid,$gift_id,$num,$room_id){
		 $config=FF('Conf/website_config','',MODULE_PATH);
		 $gift=M('chat_gift')->where('id='.$gift_id)->find();
		 if(!$gift) return 0;

		 $user=user($form_userid,'');
		 $point_type=$config['point_type']?$config['point_type']:'point';//礼物积分类型
		 $user[$point_type]=$user[$point_type]?$user[$point_type]:0;//会员积分
		 
		 $data['num']=$num?$num:1;//送礼物数量
		 $data['gift_id']=$gift_id;//送礼物ID
		 
		 $gift_price=$gift['price']?$gift['price']:0;//所送礼物价格
		 $gift_total_price=$gift['price'] * $data['num'];
		 if($gift_total_price>$user[$point_type]) return 1; //余额不足
		 $data['addtime']=time();
		 $data['room_id']=$room_id;//房间ID
		 $data['to_user_id']=$to_userid;//接受礼物用户ID
		 $data['from_user_id']=$user['id'];
		 
		 account($userid=$user['id'],$coin=array($point_type=>-$gift_total_price),$operation_type=9,$business_type=5,$operation_user=L('SYSTEM'),$msg=L('Chat_Room'));
		 account($userid=$to_userid,$coin=array($point_type=>$gift_total_price),$operation_type=9,$business_type=5,$operation_user=L('SYSTEM'),$msg=L('Chat_Room'));
		 
		 $chat_gift_record=M('chat_gift_record');

		 if($chat_gift_record->data($data)->add())
		 {
			   return $gift;				 
		 }
		 else
		 {
			   return 2;					 
		 }
	 
    }
/*-----------------------------------  
根据ID 获取房间某字段值
* @param        int       $where  获取的条件数据可以是数组 房间ID array('id'=>10)
* @param        int       $field    字段名称 默认为数据表，当为空则获取整条数据
* @return       string  array      
----------------------------------- */	
function room($where,$field="user_id",$default=''){
		if(!$where) return $default;
		$m=M("chat_room");
	    if(!is_array($where)) $where=array('id'=>$where);
		$info=$m->where($where)->find();
		if($info)
		{
		   return $field?($info[$field]?$info[$field]:$default):$info;
		} 
    }
/*-----------------------------------  
根据ID 获取房间分类字段值
* @param        int       $where  获取的条件数据可以是数组 房间分类ID array('id'=>10)
* @param        int       $field    字段名称 默认为数据表，当为空则获取整条数据
* @return       string  array      
----------------------------------- */	
function room_class($where,$field="name",$default=''){
		if(!$where) return $default;
		$m=M("chat_class");
	    if(!is_array($where)) $where=array('id'=>$where);
		$info=$m->where($where)->find();
		if($info)
		{
		   return $field?($info[$field]?$info[$field]:$default):$info;
		} 
    }
/*-----------------------------------  
根据ID 获取内容模型分类字段值
* @param        int       $where  获取条件数据可以是数组 房间分类ID array('id'=>10)
* @param        int       $field    字段名称 默认为数据表，当为空则获取整条数据
* @return       string  array      
----------------------------------- */	
function get_sys_class($where,$field,$default,$len){
		 load('Sys_model/function');
		 return sys_class($where,$field,$default,$len);
    }
/*-----------------------------------  
获取分类下的房间，包括子分类
* @param        int       $parent_id  分类ID 0表示顶级分类
* @param        int       $lve    获取几层的分类,0表示所有层
* @param        int       $class_num    每层获取的分类个数 0表示全部
* @param        int       $room_num    总共房间数，0表示全部房间
* @return       string  array      
----------------------------------- */	
function get_class_room($parent_id,$room_num=0,$lve=0,$class_num=0){
           $class_array=get_sub_class($parent_id,$lve,$class_num);
		   $where['class_id']= array('in',$class_array);
		   if($room_num)
		   {
			   $return_room=M('chat_room')->where($where)->limit($room_num)->select();
		   }
		   else
		   {
			   $return_room=M('chat_room')->where($where)->select();
		   }
          return $return_room;
    }
/*-----------------------------------  
获取分类下的子分类，包括子分类
* @param        int       $parent_id  分类ID 0表示顶级分类
* @param        int       $lve    获取几层的分类,0表示所有层
* @param        int       $class_num    每层获取的分类个数 0表示全部
* @param        int       $total_num    总共多少个分类 0表示全部
* @return       string  array      
----------------------------------- */	
function get_sub_class($parent_id,$lve=0,$class_num=0,$total_num=0,$current_lve=1,$return=array()){
	      if($parent_id && $current_lve==1) $return[]=$parent_id;
          $parent_id=$parent_id?$parent_id:0;
		  if($lve && $lve<$current_lve) return $return;;

		  $m=M('chat_class');
		  if($class_num>0 || $total_num>0)
		  {
			  $class_num_existing=count($return);
			  if($total_num && $total_num <=$class_num_existing) return $return;
			  $class_num_need=$total_num?$total_num-$class_num_existing:$class_num; //当前需要查找的记录条数
			  $class_info=$m->where('parent_id='.$parent_id)->order('sort asc,id desc')->limit($class_num_need)->select();
		  }
		  else
		  {
			  $class_info=$m->where('parent_id='.$parent_id)->order('sort asc,id desc')->select();
		  }
		  foreach($class_info as $v)
		  {
			  $return[]=$v['id'];
			  $sun_class=get_sub_class($v['id'],$lve,$class_num,$total_num,$current_lve+1,$return);
			  $return=$return + $sun_class;
			  
		  }
		  return $return;
    }
/*-----------------------------------  
获取房间N层分类 格式为 array('name'=>name,'id'=>id,'sunb'=>array('name'=>name,'id'=>id))
* @param        int       $num  获取个数据
* @return       string  array      
----------------------------------- */
	function class_menu($parent_id=0)
	{
		    $class_menu=array();
		    $parent_id=$parent_id?$parent_id:0;
			$where['parent_id']=$parent_id;
			$where['status']=1;
            $class_info=M('chat_class')->where($where)->order('sort asc')->select();
			if($class_info)
			{
				 foreach($class_info as $v)
				 {
					 $menu=array();
					 $menu['name']=$v['name'];
					 $menu['id']=$v['id'];
					 $sub=class_menu($v['id']);
					 if($sub) $menu['sub'] =$sub;
					 $class_menu[]=$menu;
				 }
			}
			
			return $class_menu;
	}
/*-----------------------------------  
获取正在直播的房间
* @param        int       $num  获取个数据
* @return       string  array      
----------------------------------- */	
function get_live_room($num){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	
	$type=$config['choose_direct']?$config['choose_direct']:0;
    $function='get_live_room_'.$type;
	$return=$function($num);
	return $return;
}

/*=======================================================
**获取列表
** $page 分页页码
** $pagesize 每页显示房间数
* =====================================================*/
function get_room_list($page,$pagesize,$class_id){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	
	$type=$config['choose_direct']?$config['choose_direct']:0;
    $function='get_room_list_'.$type;
	$return=$function($page,$pagesize,$class_id);
	return $return;
}
/*=======================================================
**获取CID
** $room 房间id
* =====================================================*/
function get_channel($room_id){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	
	$type=$config['choose_direct']?$config['choose_direct']:0;
    $function='get_channel_'.$type;
	$room=room($room_id,'');
	$cid=$function($room);
	return $cid;
}
/*=======================================================
**获取直播URL
** $room 房间id
* =====================================================*/
function get_address($room_id){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	$type=$config['choose_direct']?$config['choose_direct']:0;
    $function='get_address_'.$type;
	$room=room($room_id,'');
	$cid_array=$room['cid']?unserialize($room['cid']):array();
	$cid=$cid_array[$type];	
	$url=$function($cid);
	return $url;
}

/*=======================================================
**获取WEB直播
** $room 房间id
* =====================================================*/
function write_live($cid,$live_type){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	
	$type=$config['choose_direct']?$config['choose_direct']:0;
    $function='write_live_'.$type;
	$return=$function($cid,$live_type);
	return $return;
}

/*=======================================================G
**检查房间是否在直播
** $room 房间id
* =====================================================*/
function status_open($room_id){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	$type=$config['choose_direct']?$config['choose_direct']:0;
	$room=M('chat_room')-> where('id='.$room_id)->find();
	
	$cid_array=$room['cid']?unserialize($room['cid']):array();
	$cid=$cid_array[$type];	
    switch ($type)
	  {
		  case 0:
			
			break;  
		  case 1:
				$return=L_is_live($room_id);
			break;
		  default:
		  $return=0;
	  }
	return $return;
}

/*=======================================================G
**设置直播状态
** $room 房间id
* =====================================================*/
function set_status($room_id,$status){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	$type=$config['choose_direct']?$config['choose_direct']:0;
	$room=M('chat_room')-> where('id='.$room_id)->find();
	
	$cid_array=$room['cid']?unserialize($room['cid']):array();
	$cid=$cid_array[$type];
    switch ($type)
	  {
		  case 0:
			
			break;  
		  case 1:
		      $status=($status==1)?1:0;
			  $parm=array('streamName'=>$room_id,'type'=>$status);
			  L_edit_stream($parm);
			break;
		  default:
		  $return=0;
	  }
	return $return;
}
/*-----------------------------------  
获取直播房间列表
** $page 分页页码
** $pagesize 每页显示房间数
----------------------------------- */	
function get_room_list_1($page,$pagesize,$class_id){   		
	    $room_id=array();
		$offset=($page-1) * $pagesize;
		$parm=array('offset'=>$offset,'size'=>$pagesize);
		$list=L_list_stream($parm);
		if($list['total']>0)
		{
			  foreach($list['rows'] as $v) 
			  {
				   if($v['streamState']==1 && $v['bizState']==0)
				   {
					   $stream=explode('-',$v['streamId']); 
					   $room_id[]=$stream[2];
					   if(count($room_id)>=$num) break;
				   }
			  }			 
		}
		if($room_id)
		{
			$m = M('chat_room');
			$wheres['status']=1;
			$wheres['id']=array('in',$room_id);
			if($class_id) $wheres['class_id']=array('in',$class_id);
			$room =$m->where($wheres)->order('id desc')->select();			
		}
		
		if($room)
		{
			foreach($room as $k=>$v) 
			{
				  $address=get_address($v['id']);
				  $rooms[$k]['room_id']=$v['id'];
				  $rooms[$k]['videoTitle']=$v['title'];
				  $rooms[$k]['videoUser']=user($v['user_id'],'nickname');
				  $rooms[$k]['videoBg']=C('site_url').$v['anchor_cover'];
				  $rooms[$k]['userHead']=C('site_url').user($v['user_id'],'headpath');
				  $rooms[$k]['playerUrl']=$address['push_url'];
			}	
		}
		return $rooms;
    }
/*-----------------------------------  
获取正在直播的房间
* @param        int       $num  获取个数据
* @return       string  array      
----------------------------------- */	
function get_live_room_1($num){   		
	    $room_id=array();
		$list=L_list_stream();
		if($list['total']>0)
		{
			  foreach($list['rows'] as $v) 
			  {
				   if($v['streamState']==1 && $v['bizState']==0)
				   {
					   $stream=explode('-',$v['streamId']); 
					   $room_id[]=$stream[2];
					   if(count($room_id)>=$num) break;
				   }
			  }			 
		}
		if($room_id)
		{
			$m = M('chat_room');
			$wheres['status']=1;
			$wheres['id']=array('in',$room_id);
			$room =$m->where($wheres)->order('id desc')->select();			
		}
		
		if($room)
		{
			foreach($room as $k=>$v) 
			{
				  $room[$k]['url']=get_address_1($v['id']);
			}	
		}
		return $room;
    }
/*=======================================================
**获取乐视cid
** $room 房间信息
* =====================================================*/
function get_channel_1($room){
	
	$config=FF('Conf/direct_config','',MODULE_PATH);
	
	$type=$config['choose_direct']?$config['choose_direct']:0;
	$cid_array=$room['cid']?unserialize($room['cid']):array();

	$cid_array[$type]=$room['id'];
	M('chat_room')-> where('id='.$room['id'])->setField('cid',serialize($cid_array));

}

/*=======================================================
**乐视获取频道连接
* =====================================================*/
function get_address_1($room_id)
{
    $config=FF('Conf/direct_config','',MODULE_PATH);

    $time=time();
	$date=date('YmdHis',$time);
	$push_sign=md5($room_id.$time.$config['ls_sign']);
	$pull_sign=md5($room_id.$time.$config['ls_sign'].'lecloud');
	$url['push_url']="rtmp://".$config['ls_push']."/live/".$room_id."?tm=".$date."&sign=".$push_sign;
	$url['pull_url']="rtmp://".$config['ls_pull']."/live/".$room_id."?tm=".$date."&sign=".$pull_sign;;
	return $url;
}

/*=======================================================
**乐视直播流列表
* =====================================================*/
function L_list_stream($parm=array())
{
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Mlecloud');
	$parm['pushDomain']=$config['ls_push'];
	$Vcloud=new \Mlecloud($config['ls_userid'],$config['ls_secret'],$config['ls_uuid']);
	$return=$Vcloud->live('lecloud.mobileLive.stream.list',$parm);
	return $return;
}
/*=======================================================
**乐视直播流状态
* =====================================================*/
function L_status_stream($stream_name)
{
	$parm['streamName']=$stream_name;
	$list=L_list_stream($parm);
	if($list['total']>0)
	{
        $stream=$list['rows'][0];
	}	
	return $stream;
}
/*=======================================================
**乐视是否正在直播
* =====================================================*/
function L_is_live($stream_name)
{
	$return=L_status_stream($stream_name);
	if(!$return)
	{
		return false;
	} 
	else
	{
		return $return['streamState'];
	}
}
/*=======================================================
**乐视修改直播流状态$parm=array('streamName'=>$stream_name,'type'=>0);
* =====================================================*/
function L_edit_stream($parm)
{
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Mlecloud');
	$parm['pushDomain']=$config['ls_push'];
	$Vcloud=new \Mlecloud($config['ls_userid'],$config['ls_secret'],$config['ls_uuid']);
	$return=$Vcloud->live('lecloud.mobileLive.stream.control',$parm);
}
/*=======================================================
**乐视修改应用状态$parm=array('appName'=>$appName,'status'=>0);
* =====================================================*/
function L_edit_status($parm)
{
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Mlecloud');
	$parm['pushDomain']=$config['ls_push'];
	$Vcloud=new \Mlecloud($config['ls_userid'],$config['ls_secret'],$config['ls_uuid']);
	$return=$Vcloud->live('lecloud.mobileLive.app.modify',$parm);
}
/*=======================================================
**乐视直播查询
* =====================================================*/
function L_list($parm)
{
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Mlecloud');
	$Vcloud=new \Mlecloud($config['ls_userid'],$config['ls_secret'],$config['ls_uuid']);
	$return=$Vcloud->live('lecloud.mobileLive.app.list',$parm);
	return $return;
}

/*=======================================================
**乐视获取单个直播
* =====================================================*/
function L_one($parm)
{
	$return = L_list($parm);
	if($return['total']>0) $rows=$return['rows'][0];
	return $rows;
}
/*=======================================================
**获取乐视直播parm
* =====================================================*/
function write_live_1($cid,$live_type=0)
{
	 if($live_type==1)
	 {
		 $token=L_get_token($cid);
	     $return_data="<embed width='100%' height='600' flashvars='id=".$cid."&token=".$token."' wmode='transparent' allowfullscreeninteractive='true' allowscriptaccess='always' bgcolor='#131313' quality='high' style='' type='application/x-shockwave-flash' id='MainPlayer' src='http://sdk.letvcloud.com/publish.swf?t=".time()."' name='MainPlayer'>";
	 }
	 else
	 {  
	     $url=get_address($cid);
	     if(L_is_live($cid)==1)//
		 {
			  $return_data="<div id='my-video' style='width:100%;height:550px;'><script type='text/javascript' charset='utf-8' src='".C('root_path')."Public/ckplayer/ckplayer.js'></script> \n\r 
		      <script type='text/javascript'>
              var flashvars={
				  f:'".$url['pull_url']."',
				  c:0,
				  p:1,
			  };
			  var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
			  
			  CKobject.embedSWF('".C('root_path')."Public/ckplayer/ckplayer.swf','my-video','ckplayer_my-video','100%','100%',flashvars,params);	
              </script></div>";
		 }
		 else
		 {
			  $return_data="<div id='my-video' style='width:100%;height:550px;'><img src='".C('TMPL_PARSE_STRING.__STATIC__')."img/chat/no_chat_video_bg.jpg' width='100%' height='100%'></div>";
		 }
		
	 }
	 
	 return $return_data;
}
/*=======================================================
**网易获取频道链接
** $room 房间信息
* =====================================================*/
function get_channel_0($room){
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Vcloud');
	$Vcloud=new \Vcloud($config['appkey'],$config['appsecret']);
	
	$type=$config['choose_direct']?$config['choose_direct']:0;
	$cid_array=$room['cid']?unserialize($room['cid']):array();
	$room_cid=$cid_array[$type];
	
	if($room_cid){
		$data=array('cid'=>$room_cid);
		$channel_stats=$Vcloud->channel_stats($data);
		if($channel_stats['code']==200)
		{
			$cid=get_address($room_cid);
		}
		else
		{
			$cid=W_create_channel($room['id']);
			$cid_array[$type]=$cid;
			M('chat_room')-> where('id='.$room['id'])->setField('cid',serialize($cid_array));
		}
	}
	else
	{
           $cid=W_create_channel($room['id']);
		   $cid_array[$type]=$cid;
		   M('chat_room')-> where('id='.$room['id'])->setField('cid',serialize($cid_array));
	}
	return $data;
}
/*=======================================================
**网易创建频道
** $id 名称id
* =====================================================*/
function W_create_channel($id)
{
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Vcloud');
	$Vcloud=new \Vcloud($config['appkey'],$config['appsecret']);
	
	$data=array('name'=>$id.time(),'type'=>0);
	$channel=$Vcloud->create_channel($data);
	if($channel['code']==200)
	{
		$cid=$channel['ret']['cid'];
	}
	else
	{
		$cid=false;
	}
	return $cid;
}
/*=======================================================
**网易创建频道
*  $cid 频道ID
* =====================================================*/
function get_address_0($cid)
{
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Vcloud');
	$Vcloud=new \Vcloud($config['appkey'],$config['appsecret']);
	
	$data=array('cid'=>$cid);
	$channel=$Vcloud->get_address($data);
	if($channel['code']==200)
	{
		$url_array=array('pushUrl'=>$channel['ret']['pushUrl'],
			'httpPullUrl'=>$channel['ret']['httpPullUrl'],
			'hlsPullUrl'=>$channel['ret']['hlsPullUrl'],
			'rtmpPullUrl'=>$channel['ret']['rtmpPullUrl'],
		);
		$data_return=$url_array;
	}
	else
	{
		$data_return=false;
	}
	return $data_return;
}
/*=======================================================
**网易删除频道
** $Vcloud 频道对象
*  $cid 频道ID
* =====================================================*/
function del_channel_0($cid)
{
	$config=FF('Conf/direct_config','',MODULE_PATH);
	Vendor('Live_radio.Vcloud');
	$Vcloud=new \Vcloud($config['appkey'],$config['appsecret']);
	$data=array('cid'=>$cid);
	$channel=$Vcloud->delete_channel($data);
	if($channel['code']==200)
	{
		return true;
	}
	else
	{
		return false;
	}
}
/*=========================
*表情列表生成
*$face_file 表情文件夹
*$div_id 显示发送文本框id
$face_array=array(
	'button_type'=>'img', 表情按钮类型 图片 img  按钮 button
	'button_w'=>30, 按钮长度
	'button_h'=>30, 按钮高度
	'div_width'=>200, 显示层的宽度
	'div_height'=>200, 显示层的高度
	'button_style'=>'margin-top:20px;' , 按钮或图片附加样式
	'button_url=>'', 按钮图片链接或则按钮显示文字
	'img_size'=>30,
	'root_path'=>'', cms安装文件夹
	'face_w=>50, 图片显示在页面上的宽度	
	'other_style'=>'', 显示表情列表的其他样式
)
====================================================================================================================================================================================================*/

function show_face($face_file,$div_id='message',$face_array=array('button_type'=>'img','button_w'=>30,'button_h'=>30,'button_style'=>'margin-top:10px;','div_width'=>200,'div_height'=>200,'button_url'=>'','img_size'=>30,'root_path'=>'','face_w'=>50,'other_style'=>''))
{
	$face_file_root='upload/face/';
	$face_file=$face_file_root.$face_file."/";
	$button_type=isset($face_array['button_type']) ? $face_array['button_type'] : 'img';
	$button_style=isset($face_array['button_style']) ? $face_array['button_style'] : '';
	$button_w=isset($face_array['button_w']) ? $face_array['button_w'] : 30;
	$button_h=isset($face_array['button_h']) ? $face_array['button_h'] : 30;
	$div_width=isset($face_array['div_width']) ? $face_array['div_width'] : 200;
	$div_height=isset($face_array['div_height']) ? $face_array['div_height'] : 200;
	$img_size=isset($face_array['img_size']) ? $face_array['img_size'] : 1;
	$root_path=isset($face_array['root_path']) ? $face_array['root_path'] : '';
	$button_url=isset($face_array['button_url']) ? $face_array['button_url'] : '';
	$face_w=isset($face_array['face_w']) ? $face_array['face_w'] : 50;
	$other_style=isset($face_array['other_style']) ? $face_array['other_style'] : '';
	if(!$face_file) return '';
	if($button_type=="img"){
		$img_url_d= $root_path.'/Public/css_js_font_img/img/show_face.jpg';
		if($button_url){
			$img_url_d=$button_url;
		}
		$html="<img src=".$img_url_d." class=\"show_face_img\" width='".$button_w."px' height='".$button_h."px' style='cursor:pointer;".$button_style."'>";
	}
	if($button_type=="button"){
		$html="<input  type='button' value=".$button_url." class=\"show_face_img\" width='".$button_w."px' height='".$button_h."px'  style=".$button_style.">";	
	}
	$html.="<style>#show_face_list{position: absolute; width:".$div_width."px;height:".$div_height."px; border:1px solid #ccc; background:#fff;display:none;overflow:auto;".$other_style."} #show_face_list li{  margin:2px; float:left; width:".$img_size."px; height:".$img_size."px; list-style:none} #show_face_list li img{width:".$img_size."px; height:".$img_size."px;cursor:pointer}</style>";
	$html.="<div id='show_face_list'>";
	$handle = opendir($face_file); 
    while (false !== ($file = readdir($handle))) { //遍历该php文件所在目录
    	list($filesname,$kzm)=explode(".",$file);//获取扩展名
        if($kzm=="gif" or $kzm=="jpg" or $kzm=="JPG" or $kzm=="png" or $kzm=="PNG") 
		{ //文件过滤
        	if (!is_dir("./".$file)) 
			{ //文件夹过滤
            $array[]=$file;//把符合条件的文件名存入数组
            $i++;//记录图片总张数
            }
         }
    }
	for ($j=0;$j<$i;$j++){//循环条件控制显示图片张数
		$html.="<li><img height='".$img_size."' width='".$img_size."' src=\"".$root_path."/".$face_file."$array[$j]\"><input class=\"val\" value=\"[".$array[$j]."]\" type=\"hidden\"></li>";//输出图片数组
	}
	$html.="<div style=\"clear:both\"></div>";
	$html.="</div>";
	$html.="<script>
				var X = $('.show_face_img').offset().top; 
				var Y = $('.show_face_img').offset().left; 
				$('#show_face_list').css({\"top\":\"\"+(X-".$div_height.")+\"px\",\"left\":\"\"+Y+\"px\"});
				$(\".show_face_img\").click(function(){
					$(\"#show_face_list\").toggle(100);	
				});
				$(\"#show_face_list\").mouseleave(function(){
					$(this).hide(100);
	 		    });
				$(\"#show_face_list\").find('li').click(function(){	
					val=$('#".$div_id."').val();
					face=$(this).find('.val').val();
					$('#".$div_id."').val(val+face);
					$(\"#show_face_list\").hide(100);	
				});
			    function replace_face(string)
				{
					var m='';
					var mm='';
  				    m=string.substring(string.indexOf(\"[\") + 1,string.indexOf(\"]\"));
					if(m==''){
						return 	string;
					}else{
						m1='['+m+']';
						m2=string.replace(m1,\"<img src='".$root_path."/".$face_file."\"+m+\"'>\");
						return 	 replace_face(m2);
					}
				}			
			</script>";
	echo $html;
}

function get_chatmenu_count($parentid=0,$type=1,$max_level=0,$menu_level=0)
{
	$parentid=$parentid?$parentid:0;
	$menu_level=$menu_level?$menu_level:0;
	$menu_level=$menu_level+1;
	$type=$type?$type:0;
	if($max_level && $max_level<$menu_level) return array(0,$menu_level-1);// 返回一个数组，第一次参数为子菜单个数，第二个为层数
	$menu =M('chat_class');
	$where['parent_id']=is_numeric($parentid)?$parentid:0;
	if(!$type)//如果为0 统计所以子菜单的个数
	{
		$submenu=$menu->where($where)->select();//获取总记录数
		$submenu_count=$submenu?count($submenu):0;//统计当前栏目的子菜单个数
		if($submenu_count)
		{
			$submenu_array=array();
			foreach ($submenu as $k=>$v)
			{
				$submenu_array=get_chatmenu_count($v['id'],$type,$max_level,$menu_level);//存放返回的子菜单数组，有2个元素，，第一次参数为子菜单个数，第二个为层数
				$submenu_level[$k]=is_numeric($submenu_array[1])?$submenu_array[1]:0;// 获取返回的子菜单的层级
				$submenu_count=$submenu_count+$submenu_array[0];//累计子菜单的个数
			}
			rsort($submenu_level);//按层级大小排序数组，子菜单层数最多的排到最前边
			$menu_level=$submenu_level[0];//获取子菜单层数最多的层数，菜单有多少层，主要按照菜单最多的算
			$submenu_return[0]=$submenu_count;//子菜单个数
			$submenu_return[1]=$menu_level;//子菜单的层数
		}
		else
		{
			$submenu_return[0]=0;//子菜单个数为0
			$submenu_return[1]=$menu_level-1;//子菜单的层数
		}
	}
	else
	{
		$submenu_count=$menu->where($where)->count();//获取总记录数
		$submenu_return[0]=$submenu_count;//子菜单个数为0
		$submenu_return[1]=$menu_level-1;//子菜单个的层数
	}
	return $submenu_return;
}
function chat_menu_check($parentid=0,$id=0,$char=array('├','─',''),$menu_level=1){
	//------------------------------------菜单列表----------------------------------------
	$parentid=is_numeric($parentid)?$parentid:0;
	$char=$char?$char:array('├','-','');
	$str="";
	$where['parent_id']=$parentid;
	$menu =M('chat_class');
	$info=$menu->where($where)->select();
	if(!$info) return "";
	$charstr=numstr($menu_level-1,$char); //显示层级的字符串
	//echo $menu->getLastSql() ;
	//------------------------菜单列表--------------------------------------
	foreach ($info as $k => $v)
	{
		$check=$id==$v['id']?"selected":"";
		$str=$str."<option value='".$v['id']."' $check >".$charstr.$v['name']."</option>";
		$str=$str.chat_menu_check($v['id'],$id,$char,$menu_level+1);
	}
	return $str;
}
function chat_menu_submenu_del($id=0)
{
	$id=$id?$id:0;
	$del_num=0;//删除菜单的条数
	if($id)
	{
		$menu =M('Chat_class');
		$where['parent_id']=$id;
		$info=$menu->where($where)->select();
		if($info)// 检查如果为真，说明有子菜单，继续执行函数，检查子菜单
		{
			foreach ($info as $k=>$v)
			{
				$del_num=$del_num+chat_menu_submenu_del($v['id']);
				unset($where);
				$where['id']=$id;
				$del_num=$del_num+$menu->where($where)->delete(); //累计删除菜单个数
			}
		}
		else//如果没有子菜单，将直接删除本菜单
		{
			unset($where);
			$where['id']=$id;
			$del_num=$del_num+$menu->where($where)->delete();
		}
	}
	return $del_num;
}

function get_submenu_id($id)
{
	 $ids="";
	 $id_str="";
	 $class=M('chat_class')->where('parent_id='.$id)->select();
	 foreach($class as $k=>$v)
	 {
		 $ids=get_submenu_id($v['id']);
		 if($ids) 
		 {
			 $id_str=$id_str.",".$v['id'].",".$ids;
		 }
		 else
		 {
			 $id_str=$id_str.",".$v['id'];
		 }
	 }
	 
	 return trim($id_str,',');
}
?>

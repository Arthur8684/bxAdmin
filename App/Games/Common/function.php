<?php 
/*
-----------------------------------  
   获取分类下级分类个数
   $parentid 父分类ID
   $type 获取模式 0获取分类下的所有子分类个数，包括子分类下的子分类 1只获取当前分类下子分类个数 默认为1
   $max_level 最大统计多少层分类 默认为0不限
   $class_level 分类的层级
-----------------------------------   
*/	
function get_subclass_count($parentid=0,$type=1,$max_level=0,$class_level=0)
{

    $parentid=$parentid?$parentid:0;
	$class_level=$class_level?$class_level:0;
	$class_level=$class_level+1;
    $type=$type?$type:0;
	if($max_level && $max_level<$class_level) return array(0,$class_level-1);// 返回一个数组，第一次参数为子分类个数，第二个为层数
	$games_class =D('games_class');
	$where['parent_id']=is_numeric($parentid)?$parentid:0;
	
	if(!$type)//如果为0 统计所以子分类的个数
	{
	     $submenu=$games_class->where($where)->select();//获取总记录数
		 
		 $submenu_count=$submenu?count($submenu):0;//统计当前栏目的子分类个数
		 if($submenu_count)
		 {
		            $submenu_array=array();//存放返回的子分类数组，有2个元素，，第一次参数为子分类个数，第二个为层数
					foreach ($submenu as $k=>$v) 
					{
					  
						$submenu_array=get_submenu_count($v['id'],$type,$max_level,$class_level);//存放返回的子分类数组，有2个元素，，第一次参数为子分类个数，第二个为层数
						
						//$submenu_array[0] 获取返回的子分类个数
						$submenu_level[$k]=is_numeric($submenu_array[1])?$submenu_array[1]:0;// 获取返回的子分类的层级
						
						$submenu_count=$submenu_count+$submenu_array[0];//累计子分类的个数
					}
					
					rsort($submenu_level);//按层级大小排序数组，子分类层数最多的排到最前边
					$class_level=$submenu_level[0];//获取子分类层数最多的层数，分类有多少层，主要按照分类最多的算
					
				    $submenu_return[0]=$submenu_count;//子分类个数
				    $submenu_return[1]=$class_level;//子分类的层数
					
					
		 }
		 else
		 {
		          $submenu_return[0]=0;//子分类个数为0
				  $submenu_return[1]=$class_level-1;//子分类的层数
		 
		 }
		 
		//echo  $games_class->getLastSql(); 
		 
	}
	else
	{
	     $submenu_count=$games_class->where($where)->count();//获取总记录数
		 //echo $submenu_count;
		 $submenu_return[0]=$submenu_count;//子分类个数为0
	     $submenu_return[1]=$class_level-1;//子分类个的层数
	}
	return $submenu_return;
}
/*
-----------------------------------  
   删除分类，包括子分类
   $class_id 要删除的id 可以是数组
   $type 是否要删除该分类下的内容  0为不删除 1为删除
-----------------------------------   
*/
	function del_class($class_id,$type=1)
	{
		$m=M('games');
		$games_class=M("games_class");
		unset($where);
	    if(is_array($class_id)) 
		{ 
		      foreach($class_id as $k=>$v)
			  {
				   if($type) $m->where("class_id=".$v)->delete();
				   $ids=$games_class->where('parent_id='.$v)->getField('id',true);
				   if($ids) del_class($ids,$type);
				   $games_class->delete($v);
			  }
		}
        return true;
	}
//判断用户是否在房间内
function is_the_room($user_id){
	$where['userid']=$user_id;
	$info=M('games_room_user')->where($where)->find();
	if($info){
		$game_room=M('games_room')->where(array('id'=>$info['roomid']))->find();
		return U('Games/'.$game_room['sign'].'/game_room',array('id'=>$info['roomid'],'sign'=>$game_room['sign']));
	}else{
		return false;
	}
}
//$file 上传的文件
//$rootPath 设置附件上传根目录
//$savePath 设置附件上传（子）目录 可选
//$allowExts 设置附件上传类型
//$maxSize  设置附件上传大小 默认3M
function game_file_upload($file,$rootPath,$savePath='',$allowExts='',$maxSize='3145728'){
	$upload = new \Think\Upload();// 实例化上传类
	$upload->maxSize = $maxSize ;// 设置附件上传大小
	$upload->exts    = $allowExts;// 设置附件上传类型
	$upload->rootPath  = $rootPath; // 设置附件上传根目录
	$upload->savePath  = $savePath; // 设置附件上传（子）目录
	$info = $upload->upload($file);
	if(!$info) {// 上传错误提示错误信息
		return $upload->getError();
	}else{// 上传成功 获取上传文件信息
		foreach($info as $file){
			return C('root_path').$rootPath.$file['savepath'].$file['savename'];
		}
	}
}
//判断游戏模型设置是否存在
function is_game_set($file,$file_path){
	$object = new Org\Util\File();
	if($object->has($file)){
		return $file_path;
	}else{
		return 'games_set';
	}
}

function get_games_config($sign){
	if($sign=='Against'){
		$room_card=FF('Conf/'.$sign.'_room_card_config','',MODULE_PATH);
		$match=FF('Conf/'.$sign.'_match_config','',MODULE_PATH);
		if($room_card['set_number'] && $match['competition_system_game']){
			$return['room_card']=$room_card;
			$return['room_card']['owner_point_type_name']=C($room_card['owner_point_type'].'.name');
			$return['room_card']['other_point_type_name']=C($room_card['other_point_type'].'.name');
			$return['room_card']['win_point_type_name']=C($room_card['win_point_type'].'.name');
			$return['room_card']['owner_point_type_unit']=C($room_card['owner_point_type'].'.unit');
			$return['room_card']['other_point_type_unit']=C($room_card['other_point_type'].'.unit');
			$return['room_card']['win_point_type_unit']=C($room_card['win_point_type'].'.unit');
			$return['match']=$match;
		}else if(!$room_card['set_number'] && $match['competition_system_game']){
			$return['room_card']='';
			$return['match']=$match;
		}elseif($room_card['set_number'] && !$match['competition_system_game']){
			$return['room_card']=$room_card;
			$return['room_card']['owner_point_type_name']=C($room_card['owner_point_type'].'.name');
			$return['room_card']['other_point_type_name']=C($room_card['other_point_type'].'.name');
			$return['room_card']['win_point_type_name']=C($room_card['win_point_type'].'.name');
			$return['room_card']['owner_point_type_unit']=C($room_card['owner_point_type'].'.unit');
			$return['room_card']['other_point_type_unit']=C($room_card['other_point_type'].'.unit');
			$return['room_card']['win_point_type_unit']=C($room_card['win_point_type'].'.unit');
			$return['match']='';
		}elseif(!$room_card['set_number'] && !$match['competition_system_game']){
			$return['room_card']='';
			$return['match']='';
		}
	}elseif($sign=='Minghua'){
		$return=FF('Conf/'.$sign.'_config','',MODULE_PATH);
	}
	$return['show_config']['people_number']=array('val'=>$return['people_number'],'name'=>L('people_number'),'unit'=>'人');
	$return['show_config']['set_number']=array('val'=>$return['set_number'],'name'=>L('set_number'),'unit'=>'局');
	if($return['play']==1){
		$lang=L('明花');
	}else{
		$lang=L('暗花');
	}
	$return['show_config']['pay']=array('name'=>L('room_card'));
	if($return['owner']['status']){
		$return['show_config']['pay']['owner']=array('name'=>L('owner'),'val'=>$return['owner']);
		$owner_type=C($return['show_config']['pay']['owner']['val']['point_type']);
		$return['show_config']['pay']['owner']['val']['unit']=$owner_type['unit'];
	}
	if($return['other']['status']) {
		$return['show_config']['pay']['other']=array('name'=>L('other'),'val'=>$return['other']);
		$other_type=C($return['show_config']['pay']['other']['val']['point_type']);
		$return['show_config']['pay']['other']['val']['unit']=$other_type['unit'];
	}
	if($return['win']['status']){
		$return['show_config']['pay']['win']=array('name'=>L('win'),'val'=>$return['win']);
		$win_type=C($return['show_config']['pay']['win']['val']['point_type']);
		$return['show_config']['pay']['win']['val']['unit']=$win_type['unit'];
	}
	$return['show_config']['play']=array('name'=>L('play'),'val'=>$return['play']);
	return $return;
}
?>

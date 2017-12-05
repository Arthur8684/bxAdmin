<?php 
/*========================================================================================
** 会员中心左边菜单
*/
function user_index_menu($parent_id=0)
{
	    $menu_str="";//菜单字符串
	
	    $parent_id=$parent_id?$parent_id:0;
		$menu=M('menu');
		$where['status']=1;
		$where['type']='user';
		$where['parent_id']=$parent_id;
		$menu_list=$menu->where($where)->order('sort')->select();
		if($menu_list)
		{
			 foreach($menu_list as $v)
			 {
				 $return_str=user_index_menu($v['id']);// 函数返回数据
				 if(!$return_str)//下边没有子菜单
				 {
						 if($v['url'])
						 {
							 $url=":".$v['url'];
						 }
						 else if($v['url_a'])
						 {
							 $url_file=$v['url_m'].'/'.$v['url_c'].'/'.$v['url_a'];
							 $url=array($url_file,$b_v['url_p']);								 
						 }
						 
						 if($where['parent_id']==0)
						 {
							 $title="<i class='".$v['ico']."'></i> <span class='title'>".$v['title']."</span>" ;
						 }
						 else if($v['url_a'])
						 {
							  $title="<i class='".$v['ico']."'></i> ".$v['title'] ;
						 }
						 $other=" target='iframepage' ";											   	
						  
						 $src=RR($url,$title,'',$other);
						 if($src) $menu_str=$menu_str."<li>".$src."</li>";						  
				 }
				 else
				 {
					   $menu_str=$menu_str."<li><a href='javascript:;'>
									  <i class='".$v['ico']."'></i> 
									  <span class='title'>".$v['title']."</span>
									  <span class='arrow'></span>
                                      </a>
								      <ul class='sub-menu'>".$return_str."</ul>
								  </li>";
				 }
  
			 }
		}
		return $menu_str;
}

function AreaQuery($id)
{
	$area = M('linkage');
	$where['id'] = $id;
	$result = $area -> where($where) ->find();
	$area = $result['name'];
	return $area;
	 
}

function agent_link_list_info($parentid,$tables){
	$table=M($tables);
	$where['parent_id']=$parentid;
	$where['is_show']=1;
	$link_list=$table->where($where)->select();
	if($link_list){
		foreach($link_list as $val){
			$vals["n"]=$val["name"];
			$vals["v"]=$val["id"];
			$vals["s"]=agent_link_list_info($val["id"],$tables);
			$shop_category_list[]=$vals;
		}
	}
	return $shop_category_list;
}
function proxy($id,$data=array()){
	$linkage=M('linkage');
	$where['id']=$id;
	$res=$linkage->where($where)->find();
	if($res){
		$data[]=$res['id'];
		if($res['parent_id'])
		{
			$r=proxy($res['parent_id'],$data);
		}
		else
		{
			return $data;
		}
		return $r;
	}

}
function agent_divided_into($lid,$price=0){
	$config=FF('user_agent/config','');
	$scale=explode(',',$config['scale']);
	$res=array_reverse(proxy($lid));
	foreach($scale as $k=>$v){
			 $where['area_id']=$res[$k+1];
             $use_id=M('agent')->where($where)->getField('user_id');
		     if($use_id){
				 $operation=account($price*$v/100,$use_id,'money',1,5,'SYSTEM','地区代理分成',1,0);
			 }
	}
	return $operation;
}
/*---------------
通过身份证号提取当前人的生日 存成XX-XX格式
$ID_num传入的18位身份证号
----------------*/
function birthday($ID_num){
	if(strlen($ID_num)!=18)  return '';
	$ID_num=substr($ID_num,10);
	$ID_num=substr($ID_num,-8,4);
	$month=substr($ID_num,-4,2);
	if(intval($month)>12)   return '';
	if(intval($day)>31)  return '';
	$day=substr($ID_num,2);
	return $month.'_'.$day;
	}
/*---------------
推荐人审核被推荐人信息佣金发放
$model_id  模型id
$commoned_id 推荐人id
$id 需要审核的id
----------------*/
function commoned_auth($model_id,$commoned_id,$id){
	//if(!$model_id || !$commoned_id || !$user_id) return false;
	$commoned=M('user')->where('id='.$commoned_id.'')->find();
	if(!$commoned) return false;
	$model_config=model_config($model_id);
	if(model_config($model_id)){
		$table=model_f($model_id);
		if(!$table) return false;
		$news=M($table)->where('id='.$id.'')->find();
		if($news['verify']==99){
			return false;
			}else{
			if($model_config['open']==0){
				return false;
				}else{
				if($model_config['verify']==0){
					  $data['verify']=99;
					  if(M($table)->where(array('id'=>$id))->save($data)){
						  $coin_verify=array('money'=>$model_config['verify_money'],'amount'=>$model_config['verify_amount'],'point'=>$model_config['verify_point'],'promote_point'=>$model_config['verify_promote_point']);
						  account($commoned_id,$coin_verify,9,6,L('SYSTEM'),model_f($model_id,'name').L('VERIFY_'));
						  $coin=array('money'=>$model_config['release_money'],'amount'=>$model_config['release_amount'],'point'=>$model_config['release_point'],'promote_point'=>$model_config['release_promote_point']);
						  account($news['autho_id'],$coin,9,6,$commoned['user'],model_f($model_id,'name'));
						  return true;
					  }
					  }	
					}
				}
		
		}
	}

/*
-----------------------------------  
   分销返利，按设置的比例分销
   $scale 传入的价格 可以为数组或者数组格式为 array('money'=>10) 也可以为数字
   *userid 用户ID
   *c_n 最大多少层
-----------------------------------*/
function rebate_recommend($userid,$config="",$msg="",$n=0)
{
	 if(!$config) $config=get_user_scale();
	 if(!$config) return false;
	 $user=M('user');
	 $data['id']=$userid;
	 $info=$user->where($data)->find();	
	 if(!$info)return false;
	 $data=array();
	 foreach($config as $k=>$v)
	 {
		 if(!$v) continue;
		 $c=explode(',',$v);  
		 if($c[$n]) $data[$k]=$c[$n];  
	 }
	 if($data)
	 {
		 account($userid,$data,4,6,L('SYSTEM'),$msg,1);
	     if($info['recommend']) rebate_recommend($info['recommend'],$config,$msg,$n+1);
	 }
	 else
	 {
		 return true;
	 }
}
/*
-----------------------------------  
   获取配置位置中的分成字符串
   $scale 传入的价格 可以为数组或者数组格式为 array('money'=>10) 也可以为数字
   *userid 用户ID
   *c_n 最大多少层
-----------------------------------*/
function get_user_scale()
{
	 $c=FF("user_group/user_config");
	 $data=array();
	 $point=C('point_type');
	 foreach($point as $k=>$v)
	 {
		 if($c['scale_'.$k]) $data[$k]=$c['scale_'.$k];
     } 
	 return $data;
} 
/*
-----------------------------------  
	获取兑换信息，返回数组     
-----------------------------------*/
function convert_coin()
{
	$point_convert=C('point_convert');
	foreach($point_convert as $k=>$v){
         $convert_array=$explode("__convert__",$k);
		 $data[$k][0]=$convert_array[0];
		 $data[$k][1]=$convert_array[1];
		 $data[$k][2]=$v;
	}
		return $data;
}
?>
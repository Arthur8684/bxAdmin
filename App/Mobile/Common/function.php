<?php 
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
function get_user_scale()
{
	 $c=FF("user_group/user_config");
	 $data=array();
	 $point=array('money','amount','point','promote_point');
	 foreach($point as $k=>$v)
	 {
		 if($c['scale_'.$v]) $data[$v]=$c['scale_'.$v];
     } 
	 return $data;
} 
?>
<?php

//登录用户信息
 function user_info1(){ 
	 $userid=session('user.id');
	 $user=M('user');
	 $where['id']=$userid;
	 return $user->where($where)->find(); 
	 }
//中心菜单显示
  function nav_list($parentid=0){
	  $menu=M('menu');
	  $where['type']='sell';
	  $where['parent_id']=$parentid;
	  $menu_list=$menu->where($where)->order('sort')->select();
	  foreach($menu_list as $val){
		  $val['next_nav']=nav_list($val['id']);	 
		  $menu_list_new[]=$val;
		  }
		 return $menu_list_new;
	  }
//获取团购modelid
  function model_table($type){
	  $model=M('model');
	  $where["type"]=$type;
	  return $model->where($where)->select();
	  }

//添加方法
 function add_shop_fun($array,$user_id,$shop_num=1){
	  $shop=M('shop');
	  $data=$array;	  
	  $user=M('user');
	  $wheres['id']=$user_id;
	  $where['user_id']=$user_id;
	  if($user->where($wheres)->find()){
	  $shop_count=$shop->where($where)->count();
	  if($shop_count<$shop_num){
	  return $shop->add($data);	
	  }else{
	  return false;
	  }  
	  }else{
	  return false;  
		  }
	 }
//店铺信息
 function shop_info_show($shop_id)
 {
	  $shop=M('shop');
	  $where['id']=$shop_id;
	  $shop_info=$shop->where($where)->find();
	  $shop_category=M('shop_category');
	  $where['id']=$shop_info['category_id'];
	  $shop_info['category_info']=$shop_category->where($where)->find();
	  return $shop_info;
	 }

//修改店铺
 function alter_shop($array){
	  $shop=M('shop');
	  $data=$array;
	  $where['id']=$array['id'];
	  $data['category_id']=linkage_id($array['category_id']);
	  $data['area_id']=linkage_id($array['area_id']);
	  return $shop->where($where)->save($data);	 
	 }
//闭铺
 function close_shop($id){
	  $shop=M('shop');
	  $data['is_open']=1;
	  $where['id']=id;
	  return $shop->where($where)->save($data);		 
	 }
//单ID店铺数量统计
 function count_shop($user_id=0){
	  $shop=M('shop');
	  if($user_id>0){
	  $where['user_id']=$user_id;
	  }
	  return $shop->where($where)->count();		 
	 }
//删除店铺
 function shop_del($id){
	 $shop=M('shop');
	 $where["id"]=$id;
	 return $shop->where($where)->delete();
	 }
//添加分类方法
 function add_links($addarray){
	 $shop_category=M('shop_category'); 
	 $where=$addarray;	 
	 $onlyone=$shop_category->where($where)->find();
	 if(!$onlyone){
	 return $shop_category->add($addarray);	 
		 }else{			 
	 return false;		 
			}	 
	 }
//修改分类方法
 function alter_link($addarray,$id){
	 $shop_category=M('shop_category'); 
	 $where['id']=$id;	 
	 $onlyone=$shop_category->where($where)->find();

	 if($onlyone){
	 return $shop_category->where($where)->save($addarray); 
		 }else{			 
	 return false;		 
			}	 
	 }
//删除分类方法	 
 function del_links($id){
	$shop_category=M('shop_category');
	$where['id']=$id; 
	$shop_category->where($where)->delete();
	$wheres['parent_id']=$id; 
	$shop_categorys=$shop_category->where($wheres)->select();	
	if($shop_categorys){
		foreach($shop_categorys as $val){
		del_links($val["id"]);
		}
	}
	return true;
	}

//分类数据列表
 function link_area_list($parentid){
	$shop_category=M('shop_category');
	$where['parent_id']=$parentid;
	$where['is_show']=1;
	$shop_categorys=$shop_category->where($where)->select();
	if($shop_categorys){	
	foreach($shop_categorys as $val){
		$vals["n"]=$val["name"];
		$vals["v"]=$val["id"];
		$vals["s"]=link_area_list($val["id"]);
		$shop_category_list[]=$vals;
		}
		}
	return $shop_category_list;	
	}
	
	
//地区列表

 function link_list_info($parentid,$tables){
	$table=M($tables);
	$where['parent_id']=$parentid;
	$where['is_show']=1;
	$link_list=$table->where($where)->select();
	if($link_list){	
	foreach($link_list as $val){
		$vals["n"]=$val["name"];
		$vals["v"]=$val["id"];
		$vals["s"]=link_list_info($val["id"],$tables);
		$shop_category_list[]=$vals;
		}
		}
	return $shop_category_list;	
	}
	
				
	//提现状态
	function withdraw_status($userid){
		if($userid){
		$withdraw=M("withdraw");
		$where["userid"]=$userid;	
		for($i=0;$i<4;$i++){
			$where["status"]=$i;
			$info=$withdraw->where($where)->select();
			$status[$i]['nums']=count($info);	
			$status[$i]['status']=L('User_Index_status_'.$i.'');						
			}
			
		 return $status;
	 	}
		}	
		
	//提现方式	
	function withdraw_way(){
		$withdraw_way=M("withdraw_way");
		$where["ishow"]=0;
		$info=$withdraw_way->where($where)->select();
		return $info;
		}
    //提现总数	
	function withdraw_count(){
		$withdraw=M("withdraw");
		$user=$this->userinfo;
		//dump($this->userinfo);	
		$userid=$user['id'];
		$where["userid"]=$userid;
		$info=$withdraw->where($where)->select();
		return count($info);
		}	

//管理后台店铺列表

/*
显示已选中分类名称
 */ 
 
function show_cate_name($cate_id,$table)
{
	$table=M($table);
	$cat_array=$table->where('id='.$cate_id.'')->find();
	return $cat_array;	
	} 
 
/**
 * 数组分页函数  核心函数  array_slice
 * 用此函数之前要先将数据库里面的所有数据按一定的顺序查询出来存入数组中
 * $count   每页多少条数据
 * $page   当前第几页
 * $array   查询出来的所有数组
 * order 0 - 不变     1- 反序
 */ 

function page_array($count,$page,$array,$order){
   	global $countpage; #定全局变量
	if($array){
    $page=(empty($page))?'1':$page; #判断当前页面是否为空 如果为空就表示为第一页面 
       $start=($page-1)*$count; #计算每次分页的开始位置
    if($order==1){
      $array=array_reverse($array);
    }   
    $totals=count($array);  
    $countpage=ceil($totals/$count); #计算总页面数
   	$pagedata=array();
	$pagedata=array_slice($array,$start,$count);
   	return $pagedata;  #返回查询数据
	}
}
/**
 * 分页及显示函数
 * $countpage 全局变量，照写
 * $url 当前url
 */
function show_array($countpage,$url){
	$str="";
	if($countpage>1){
     $page=empty($_GET['page'])?1:$_GET['page'];
	 if($page > 1){
	   	$uppage=$page-1;

	 }else{
	 	$uppage=1;
	 }

	 if($page < $countpage){
	   	$nextpage=$page+1;

	 }else{
	    	$nextpage=$countpage;
	 }
	   
    $str='<div style="border:1px; width:50%; height:30px; color:#9999CC">';
	$str.="<span><a href='$url&page=1'> &nbsp;&nbsp;<<&nbsp;&nbsp; </a></span>";
	$str.="<span><a href='$url&page={$uppage}'>&nbsp;&nbsp;<&nbsp;&nbsp;</a></span>";
	$str.="<span>&nbsp;&nbsp;{$page}&nbsp;&nbsp;</span>";
	$str.="<span><a href='$url&page={$nextpage}'>&nbsp;&nbsp;>&nbsp;&nbsp;</a></span>";
	$str.="<span><a href='$url&page={$countpage}'>&nbsp;&nbsp;>>&nbsp;&nbsp; </a></span>";
	$str.='</div>';
	}
	return $str;
}
//存储当前访问用户位置
function insert_Location($x,$y)
{
	$array['x']=$x;
	$array['y']=$y;
	session('Location',$array);
	return;
	}
//分类显示所需要的数组
function category_array($category_id=0,$table)
{
	$table=M($table);
	$cat_array=$table->where('parent_id='.$category_id.'')->select();
	return $cat_array;
	}
//递归需要所有分类下的id
function category_id($category_id=0,$table)
{
	$tables=M($table);
	$html.=$category_id.",";
	$cat_array=$tables->where('parent_id='.$category_id.'')->select();
	if($cat_array){
	foreach($cat_array as $val){
	$html.=category_id($val['id'],$table);
		}
		}
	return $html;
	}


//按条件显示的公司数组
function shop_indexshow_lisht($where='')
{
	$shop=M('shop');
	if($where['category_id']>0){
		$map['category_id']=array('in',''.category_id($where['category_id'],"shop_category").'');
		}
	if($where['area_id']>0){
		$map['area_id']=array('in',''.category_id($where['area_id'],"linkage").'');
		}		
	if($where['orders']>0){
		$orders='asc';
		}
	$shop_list=$shop->where($map)->select();
	//换算距当前用户距离
	$loaction=session('Location');
	for($i=0;$i<count($shop_list);$i++){	
	    $shop_list[$i]['distanceBetween']=distanceBetween($loaction['x'], $loaction['y'], $shop_list[$i]['x'], $shop_list[$i]['y'])*0.001;		
		}	
	$shop_list=array_sort($shop_list,'distanceBetween',$orders);
	return $shop_list;
	}
/**
	 * 标准GPS坐标转换成百度地图坐标
	 * @param  [String] $gpsPointString [格式：经度,纬度]
	 * @return [String]                 [转换后的，经度,纬度]
	 */	
function convertBmapGPS($x,$y){
		
        // $param = array();
        // $param['x'] = '116.397428';
        // $param['y'] = '39.90923';
     $url = 'http://api.map.baidu.com/geoconv/v1/?coords='.$x.','.$y.'&from=1&to=5&ak=FobcQnOlVGViquHzR5mr6iQr';
     $data = @file_get_contents($url);
	 $arr = json_decode($data,true);
	 $arr=$arr["result"][0];
     return $arr;
	}	

function distanceBetween($fP1Lat, $fP1Lon, $fP2Lat, $fP2Lon){
    $fEARTH_RADIUS = 6378137;
    //角度换算成弧度
    $fRadLon1 = deg2rad($fP1Lon);
    $fRadLon2 = deg2rad($fP2Lon);
    $fRadLat1 = deg2rad($fP1Lat);
    $fRadLat2 = deg2rad($fP2Lat);
    //计算经纬度的差值
    $fD1 = abs($fRadLat1 - $fRadLat2);
    $fD2 = abs($fRadLon1 - $fRadLon2);
    //距离计算
    $fP = pow(sin($fD1/2), 2) +
          cos($fRadLat1) * cos($fRadLat2) * pow(sin($fD2/2), 2);
    return intval($fEARTH_RADIUS * 2 * asin(sqrt($fP)) + 0.5)*2;
}


//获取当前登陆用户IP
function get_onlineip() { 
	$onlineip = ''; 
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) { 
	$onlineip = getenv('HTTP_CLIENT_IP'); 
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) { 
	$onlineip = getenv('HTTP_X_FORWARDED_FOR'); 
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) { 
	$onlineip = getenv('REMOTE_ADDR'); 
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) { 
	$onlineip = $_SERVER['REMOTE_ADDR']; 
	} 
	return $onlineip; 
} 


function GPS($IP){
	$data = @file_get_contents("http://api.map.baidu.com/location/ip?ak=rOc9nYAQPUayqDRQno9Osj2mn0uWIEKM&ip=".$IP."&coor=bd09ll");
	$arr = json_decode($data,true);
	return $arr;
 }

function get_Location($x,$y){
	$data = file_get_contents("http://api.map.baidu.com/geocoder/v2/?ak=rOc9nYAQPUayqDRQno9Osj2mn0uWIEKM&callback=renderReverse&location=".$x.",".$y."&output=json&pois=1");
	$data = substr($data,29);
	$data = substr($data,0,-1);
	$arr = json_decode($data,true);
	return $arr["result"];
	}
//是对一个给定的二维数组按照指定的键值进行排序
function array_sort($arr,$keys,$type='asc'){ 
	if($arr){
		$keysvalue = $new_array = array();
			foreach ($arr as $k=>$v){
			$keysvalue[$k] = $v[$keys];
			}
			if($type == 'asc'){
			asort($keysvalue);
			}else{
			arsort($keysvalue);
			}
			reset($keysvalue);
			foreach ($keysvalue as $k=>$v){
			$new_array[$k] = $arr[$k];
			}
		return $new_array;
	} 
	
} 

//用户充值
function user_recharge($user_type,$user_info,$num,$shop_user_id,$shop_pass,$coin_type='money'){
	if($user_type==1) $field='card';
	if($user_type==2) $field='id';
	if($user_type==3) $field='user';
	$user_info_s=M('user')->where(array($field=>$user_info))->find();
	if(!$user_info_s) return array('action'=>'err','name'=>0);
	if($num<=0) return array('action'=>'err','name'=>1);
	$shop_user=M('user')->where(array('id'=>$shop_user_id,'pay_pass'=>md5($shop_pass)))->find();
	if(!$shop_user) return array('action'=>'err','name'=>2);
	if($shop_user[$coin_type]<$num)  return array('action'=>'err','name'=>3);
	$s1=account($user_info_s['id'],array($coin_type=>$num),0,5,'SYSTEM','由店铺用户 '.$shop_user['user'].'【'.$shop_user['id'].'】为 '.$user_info_s['user'].'【'.$user_info_s['id'].'】充值');
	$s2=account($shop_user['id'],array($coin_type=>-$num),0,5,'SYSTEM','由店铺用户 '.$shop_user['user'].'【'.$shop_user['id'].'】为 '.$user_info_s['user'].'【'.$user_info_s['id'].'】充值');
	if($s1 && $s2) return  array('action'=>'succes');
	}
?>

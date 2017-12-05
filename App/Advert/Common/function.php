<?PHP
/*
-----------------------------------  
   设置字段缓存
   $table  要设置缓存的数据表 如果为数字为模型ID
-----------------------------------   
*/	
 function get_advert_count($advert_id){
         if(!$advert_id) return 0;
		 $where['parent_id']=$advert_id;
		 $count=M('advert')->where($where)->count();
		 return $count;
    }
/*
-----------------------------------  
根据条件 获取广告某个字段值
* @param        int       $where  获取用户的条件数据可以是数组用户ID array('id'=>10)
* @param        int       $field    字段名称 默认为数据表，当为空则获取整条数据
* @return       string  array      
-----------------------------------   
*/	
function advert($where,$field="",$default=''){
		if(!$where) return $default;
		$m=M("advert_type");
	    if(!is_array($where)) $where=array('id'=>$where);
		$info=$m->where($where)->find();
		if($info)
		{
		   return $field?($info[$field]?$info[$field]:$default):$info;
		} 
    }
/*
-----------------------------------  
获取广告的信息
* @param        array       $info  广告位信息
* @return       array      
-----------------------------------   
*/	
function image($info){
		if(!$info) return false;
		$time=time();
		$m=M("advert");
		if($info['overdue_show_type']==2)
		{
			$where['start_time']=array('elt',$time);
			$where['end_time']=array('egt',$time);			
		}

		$where['parent_id']=$info['id'];
		$show_type=$info['setting']['show_type'];
		if($show_type==1)
		{
			$info_advert=$m->where($where)->find();
		}
		else if($show_type==2)
		{
			$info_array=$m->where($where)->select();
			$rand=rand(0,count($info_array)-1);
			$info_advert=$info_array[$rand];
		}
        return  $info_advert;
    }	
/*
-----------------------------------  
获取广告的信息
* @param        array       $info  广告位信息
* @return       array      
-----------------------------------   
*/	
function html($info){
		if(!$info) return false;
		$time=time();
		$m=M("advert");
		if($info['overdue_show_type']==2)
		{
			$where['start_time']=array('elt',$time);
			$where['end_time']=array('egt',$time);			
		}
		
		$where['parent_id']=$info['id'];
		$show_type=$info['setting']['show_type'];
		if($show_type==1)
		{
			$info_advert=$m->where($where)->find();
		}
		else if($show_type==2)
		{
			$info_array=$m->where($where)->select();
			$rand=rand(0,count($info_array)-1);
			$info_advert=$info_array[$rand];
		}
        return  $info_advert;
    }
	
/*
-----------------------------------  
获取广告的信息
* @param        array       $info  广告位信息
* @return       array      
-----------------------------------   
*/	
function slide($info){
		if(!$info) return false;
		$time=time();
		$count=$info['setting']['count'];
		$count=is_numeric($count)?$count:4;
		$m=M("advert");
		if($info['overdue_show_type']==2)
		{
			$where['start_time']=array('elt',$time);
			$where['end_time']=array('egt',$time);			
		}
		$where['parent_id']=$info['id'];
		
		$info_advert=$m->where($where)->limit($count)->select();
        return  $info_advert;
    }	
?>
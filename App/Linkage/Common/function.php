<?php
//添加方法
 function add_links($addarray){
	 $linkage=M('linkage'); 
	 $addarray['name']= explode("\n",$addarray['name']);
	 $i=0;
	 foreach($addarray['name'] as $val){
		 $where=$addarray;
		 $where['name']=trim($val);
		 $onlyone=$linkage->where($where)->find();
		 if(!$onlyone){
	 	  $linkage->add($where);
		  }
		  $i++;
		 }
	 return $i;	 
	 }
//修改方法
 function alter_link($addarray,$id){
	 $linkage=M('linkage'); 
	 $where['id']=$id;	 
	 $onlyone=$linkage->where($where)->find();

	 if($onlyone){
	 return $linkage->where($where)->save($addarray); 
		 }else{			 
	 return false;		 
			}	 
	 }
//删除方法	 
 function del_links($id){
	$linkage=M('linkage');
	$where['id']=$id; 
	$linkage->where($where)->delete();
	$wheres['parent_id']=$id; 
	$linkages=$linkage->where($wheres)->select();	
	if($linkages){
		foreach($linkages as $val){
		del_links($val["id"]);
		}
	}
	return true;
	}

//数据列表

function link_area_list($parentid){
	$linkage=M('linkage');
	$where['parent_id']=$parentid;
	$where['is_show']=1;
	$linkages=$linkage->where($where)->select();
	if($linkages){	
	foreach($linkages as $val){
		$vals["n"]=$val["name"];
		$vals["v"]=$val["id"];
		$vals["s"]=link_area_list($val["id"]);
		$link_area_list[]=$vals;
		}
		}
	return $link_area_list;	
	}



//通过id算上层Id
 function parent_id($id){
	$linkage=M('linkage');
	$where['id']=$id; 
	$onlyone=$linkage->where($where)->find();
	return $onlyone['parent_id'];	 
	 }

//通过id算所有上层 存成数组

 function counts($selected_id){
	$linkage=M('linkage');
	$where['parent_id']=$id; 
	 
	 }
	
?>

<?php
namespace Sys_model\Controller;
use Org\Util\Admin;
class PropertyController extends Admin {
	
    function __construct()  //析构函数
    {  
        parent::__construct();
    }
	
    public function set_property(){
		
		$type=I('type');//设置或者删除
		$property=I('property');
		$id=I('id',0,'intval');
		$classid=I('classid',0,'intval');
		$modelid=I('modelid',0,'intval');
		$table=model_f($modelid);
		$m =M($table);
		if(!is_array($id))	$id=array($id);
		$where['id']=array('in',$id);
		$info=$m->field('id,show_property')->where($where)->select();
		foreach($info as $v)
		{
			$property_array=$v['show_property']?explode(',',$v['show_property']):array(); 
			$property_index=array_search($property,$property_array);
			if($type=='set')
			{
				if($property_index===NULL || $property_index===false) $property_array[]=$property;
			}
			else //if($type=='del')
			{
				if($property_index!==NULL && $property_index!==false) unset($property_array[$property_index]);
			}
			$property_str=implode(',',$property_array);
			$m->where(array('id'=>$v['id']))->setField('show_property',$property_str);
		}
		$this->success(L('OPERATE').L('success'),U('Article/Article/article_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);	
    }

}
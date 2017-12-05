<?php
namespace Goods\Controller;
use Org\Util\Admin;
class GoodsController extends Admin{

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   商品内容列表
-----------------------------------   
*/
    public function goods_list(){
		load('Sys_model/function');
	    $classid=I('classid',0,'intval');
		$modelid=I('modelid',0,'intval');
		$search=I('search','','trim');
		if($search){
			if((!mb_check_encoding($search, 'utf-8'))) $search=iconv("GB2312","UTF-8",$search);
			$wheregoods['title']=array('like','%'.$search.'%');
			$wheregoods['bar_code']=$search;
			$wheregoods['_logic'] = 'or';
			$where['_complex'] = $wheregoods;
		}
		$model=model_f($modelid,"");
		$table=$model['table'];
	    $pagesize=15;	
		$page=I('page',1,'intval');
	    $Goods =M($table);
		if($classid) $where['class_id']=$classid;
		$record_count=$Goods->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 		
		if($record_count>0)
		{
		  $info=$Goods->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('info',$info);
		$this->assign('model',$model);
		$this->assign('model_config',model_config($modelid));
		$this->assign('classid',$classid);
		$this->assign('modelid',$modelid);
		$this->assign('model_property',get_model_property($modelid));
        $this->display();
    }
/*
-----------------------------------  
   总店添加库存
-----------------------------------   
*/
function goods_add_inventory(){
		$modelid=I('modelid',0,'intval');
	    $goods_id=I('id',0,'intval');
		$model=model_f($modelid);
        $Goods =M($model);
		$info=$Goods->where(array('model_id'=>$modelid,'id'=>$goods_id))->find();
		if(IS_POST){
			$inventory=I('inventory',0,'intval');
			if(!$inventory) $this->error(L('input_inventory_error'),'',$this->r_time);
			if($inventory>0){
				$action=$Goods->where(array('id'=>$goods_id))->setInc('inventory',$inventory); // 库存加
				}
			if($inventory<0){
				$inventory_dec=abs($inventory);
				if($info['inventory']<$inventory_dec)  $this->error(L('input_inventory_error_1'),'',$this->r_time); //库存不足
				$action=$Goods->where(array('id'=>$goods_id))->setDec('inventory',$inventory_dec); // 库存减
				}
			if($action){
				$admin=$this->admininfo;
				$data['goods_id']=$goods_id;
				$data['model_id']=$modelid;
				$data['inventory']=$info['inventory']+$inventory;
				$data['quantity']=$inventory;
				$data['addtime']=time();
				$data['msg']='【'.$admin['user'].'】'.L('input_inventory');
				$data['operator']=$admin['user'];
				if(M('inventory_info')->add($data)){
					$this->success(L('input_inventory').L('success'),'',$this->r_time);					
					}
				}
			}else{
			$this->assign('modelid',$modelid);
			$this->assign('info',$info);
			$this->display();				
		}
	}
/*
-----------------------------------  
   总库存进出库列表明细
----------------------------------- 
*/
	public function all_inventory_list(){
		$modelid=I('modelid',0,'intval');
		if(!$modelid)  $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		$where['model_id']=$modelid;
		$goods_id=I('goods_id',0,'intval');
		$this->assign('goods_id',$goods_id);	
		if($goods_id) $where['goods_id']=$goods_id;
		$from=I('from',0,'intval');
		if($from>0)  $where['quantity']=array('gt',0);
		if($from<0)  $where['quantity']=array('lt',0);
		$this->assign('from',$from);
		$only_all=I('only_all',0,'intval');
		if($only_all==1)  $where['shop_id']=array('exp','is NULL');
		$this->assign('only_all',$only_all);
		$shop_id=I('shop_id',0,'intval');
		if($shop_id)  $where['shop_id']=$shop_id;
		$times_start=I('times_start');
		$this->assign('times_start',$times_start);
		$times_end=I('times_end');
		$this->assign('times_end',$times_end);
		if($times_start && $times_end)  $where['addtime']  = array('between',''.strtotime($times_start).','.strtotime($times_end).'');
		$pagesize=15;	
		$page=I('page',1,'intval');
		$where_all=$where;
		$where_all['quantity']=array('lt',0);
		$all_inventory=M('inventory_info')->where($where_all)->sum('quantity');
		$where_all['quantity']=array('gt',0);
		$all_inventory_c=M('inventory_info')->where($where_all)->sum('quantity');	
		$all_inventory_c=abs($all_inventory_c);
		$this->assign('all_inventory',$all_inventory);
		$this->assign('all_inventory_c',$all_inventory_c);	
		$record_count=M('inventory_info')->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		$info=M('inventory_info')->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		for($i=0;$i<count($info);$i++){
			$info[$i]['goods_name']=M(model_f($modelid))->where(array('id'=>$info[$i]['goods_id']))->getField('title');
			$info[$i]['shop_name']=M('shop')->where(array('id'=>$info[$i]['shop_id']))->getField('name');
		}
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
	    $this->assign('page_show',$page_show);// 赋值分页输出
		$this->assign('modelid',$modelid);
		$this->assign('info',$info);		
		$this->display();
		}
/*
-----------------------------------  
   商品库存管理
-----------------------------------   
*/
    public function goods_inventory_list(){
	    $classid=I('classid',0,'intval');
		$modelid=I('modelid',0,'intval');
		$model=model_f($modelid,"");
		$table=$model['table'];
	    $pagesize=15;	
		$page=I('page',1,'intval');
	    $Goods =M($table);
		if($classid) $where['class_id']=$classid;
		$record_count=$Goods->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$Goods->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('info',$info);
		$this->assign('model',$model);
		$this->assign('model_config',model_config($modelid));
		$this->assign('classid',$classid);
		$this->assign('modelid',$modelid);
        $this->display();
    }	
/*
-----------------------------------  
   商品添加	   
-----------------------------------   
*/	
    public function goods_add(){  
			$classid=I('classid',0,'intval');
			$modelid=I('modelid',0,'intval');
			$model=model_f($modelid,"");
			$table=$model['table'];
			$Goods =M($table);
	          if(IS_POST)
			  {		
			     $classid=linkage_id($classid);
			     fields($table);
				 if(!$classid) $this->error(L('SELECT').L('CLASS'),"",$this->r_time);
			  //------------------------------------保存商品----------------------------------------	
						if ($Goods->create()){
					           $Goods->content=$_POST['content'];
							   $Goods->class_id=$classid;
							   if($Goods->add())
							   {
							        $this->success(L('ADD').L('success'),U('Goods/Goods/goods_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($Goods->getError(),"",$this->r_time);
						}			  
			      //------------------------保存完--------------------------------------
			  }
			  else
			  {		$value=$classid?parents($classid,"sys_model_class",array('name','id'),array('text','value')):"";
					$this->assign('model',$model);
					$this->assign('classid',$classid);
					$this->assign('modelid',$modelid); 
					$this->assign('linkage',linkage(get_model_class($modelid),"classid",'',0,$value,array('text'=>L('SELECT'),'value'=>0),"line_4_padding_1"));//
			        $this->display();			  
			  }        
    }
/*
-----------------------------------   
   商品编辑	   
-----------------------------------   
*/	
    public function goods_edit(){  
	          $id=I('id',0,'intval');
			  $classid=I('classid',0,'intval');
			  $modelid=I('modelid',0,'intval');
			  $model=model_f($modelid,"");
			  $table=$model['table'];
			  $Goods =M($table);		  
       	     //------------------------------------验证数据正确性----------------------------------------			  
			  if(!$id){	 $this->error(L('ERR_PARAM_ID'),"",$this->r_time);	}
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
			  
			           $classid=linkage_id($classid);
				       if(!$classid) $this->error(L('SELECT').L('CLASS'),"",$this->r_time);
			           fields($table,array(),$id);
			  //------------------------------------编辑提交的管理员----------------------------------------   
						if ($Goods->create()){
						       $Goods->content=$_POST['content'];
							   $Goods->class_id=$classid;
							   if($Goods->save()!==false)
							   {
							        
							        $this->success(L('EDIT').L('success'),U('Goods/Goods/goods_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);
							   }
							   else
							   {

							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($Goods->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		  
					 $where['id']=$id;
				     $info=$Goods->where($where)->find();
					 
					 if(!$info)
					 {					      
					     $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
					 }
					 $value=$info['class_id']?parents($info['class_id'],"sys_model_class",array('name','id'),array('text','value')):"";
					 $this->assign('linkage',linkage(get_model_class($modelid),"classid",'',0,$value,array('text'=>L('SELECT'),'value'=>0),"line_4_padding_1"));//
			         $this->assign('id',$id); 
					 $this->assign('model',$model);
					 $this->assign('classid',$info['class_id']);
					 $this->assign('modelid',$modelid); 
			         $this->display();			  
			  }       
    }	
	
/*
-----------------------------------  
   商品删除  
-----------------------------------   
*/	
    public function  goods_del(){  	
	          $id=I('id',0,'intval');
			  $classid=I('classid',0,'intval');
			  $modelid=I('modelid',0,'intval');
			  $model=model_f($modelid,"");
			  $table=$model['table'];
			  $Goods =M($table);	
			  $del_num=0;//删除会员的条数		  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }	
				 if(!is_array($id))	$id=array($id)	;
				 $del_num=$Goods->delete(implode(",",$id)); 
				 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Goods/Goods/goods_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);	      
    }
	
	    public function goods_recommend(){  
	          $id=I('id',0,'intval');
			  $classid=I('classid',0,'intval');
			  $modelid=I('modelid',0,'intval');
			  $model=model_f($modelid,"");
			  $table=$model['table'];
			  $Goods =M($table);
			  if(!$id)
			  {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
			  }	
			  $info=$Goods->where(array('id'=>$id))->find();

			  if($info['recommend']==1){
				  $info_all=$Goods->where(array('id'=>$id))->save(array('recommend'=>1));
				  }else{
				  $info_all=$Goods->where(array('id'=>$id))->save(array('recommend'=>0));  
			  }
			  $this->success(L('success'),U('Goods/Goods/goods_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);	
    }	
}
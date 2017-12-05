<?php
namespace Shop\Controller;
use Org\Util\Admin;
class AdminController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
  /*添加分类*/	
  public function shop_category_add(){   
  	if(IS_POST){
  		$area['name']=I('name','','trim');
		$area['orders']=I('orders',0,'trim');
		$areaid=I('area_id');
		$area['parent_id']=linkage_id($areaid);
		$area['is_show']=I('is_show',1,'trim');
	    $action=add_links($area);	
	    if($action){		   
		  $this->success('','',0);
		  }else{
		  $this->error('',"",3);	  
	     };	  
	 	 }else{	
	  	 $parent_ids=I('get.parent_id','','trim'); 
		 $parray=''; 
		 if($parent_ids){
			 $this->assign('parent_ids',$parent_ids);
			 $parray=parents($parent_ids,$table="shop_category",$field=array('name','id'),$key=array('text','value'));
		 }
		 $link_area_list=link_area_list(0);		 
		 $area_id=linkage($link_area_list,"area_id","",0,$parray,array('text'=>L('area_first'),'value'=>"0"),'form-control');	
	 
		 $this->assign('area_id',$area_id);
		 $this->display();  
		 }     
	  } 
  public function shop_category_edit(){  
	  	if(IS_POST){
			$area['name']=I('name','','trim');
			$area['orders']=I('orders',0,'trim');
			$areaid=I('area_id');
			$area['parent_id']=linkage_id($areaid);
			$area['is_show']=I('is_show',1,'trim');
			$id=I('post.id','','trim');
			$action=alter_link($area,$id);
			if($action)
			{		   
				$this->success('','',0);
			}else{
				$this->error('',"",3);	  
			}	  
		}else{	
			 $parent_ids=I('get.parent_id','','trim'); 
			 $parray=''; 
			 if($parent_ids)
			 {
				 $this->assign('parent_ids',$parent_ids);
				 $parray=parents($parent_ids,$table="shop_category",$field=array('name','id'),$key=array('text','value'));
			 }
			 $id=I('get.id','','trim');
			 if($id)
			 {
				 $linkage=M('shop_category');
				 $where['id']=$id;
				 $areas=$linkage->where($where)->find();
				 $this->assign('areas',$areas);
				 $this->assign('id',$id);
				 $parray=parents($areas['parent_id'],$table="shop_category",$field=array('name','id'),$key=array('text','value')); 
			 }
			 $link_area_list=link_area_list(0);		 
			 $area_id=linkage($link_area_list,"area_id","",0,$parray,array('text'=>L('area_first'),'value'=>"0"),'form-control');		 
			 $this->assign('area_id',$area_id);
		 }     
	  	 $this->display('shop_category_add'); 
	  } 	  
  /*分类列表*/	  
  public function shop_category_list(){
	 	$parent_id=I('parent_id','0','trim');
		$where['parent_id']=$parent_id;
	  	$linkage=M('shop_category');
		$pagesize=10;
		$page=I('page',1,'intval');
		$record_count=$linkage->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$linkage->where($where)->order('orders')->page($page,$pagesize)->select();
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
        $this->display();
	  }
  /*分类删除*/	  
  public function shop_category_del(){   
  	 	$id=I('id','','trim');
  		if(del_links($id)){		   
		  $this->success('','',0);
		  }else{
		  $this->error('',"",3);	  
		};
  }
  /*店铺列表*/
  public function shop_list()
  { 	
  		$shop=M('shop');
		$pagesize=10;
		$user_id=I('get.user_id',0,'intval');
		if($user_id>0){
		$where['user_id']=$user_id;
		}
		$page=I('page',1,'intval');
		$record_count=$shop->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$shop->where($where)->order('id desc')->page($page,$pagesize)->select();
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
		$this->assign('info',$info);
 		$this->display();
  } 
  /*店铺修改*/
  public function shop_edit(){
	  $shop=M('shop');
	  $id=I('id',0,'trim');
	  $where['id']=$id;
	  if(IS_POST){
		$data=I('post');
		$data['category_id']=linkage_id(I('category_id')); 
		if(alter_shop($data)){		   
		  $this->success('','',0);
		  }else{
		  $this->error('',"",3);
		};
		  }else{
	  $linkage=M('shop_category'); 
	  $shop_info=$shop->where($where)->find();
	  $type_list=link_area_list(0);	
	  $parray=parents($shop_info['category_id'],$table="shop_category",$field=array('name','id'),$key=array('text','value'));
	  $type_id=linkage($type_list,"category_id","",0,$parray,array('text'=>L('area_first'),'value'=>"0"),'form-control');
	  $this->assign('type_id',$type_id);
	  $this->assign('shop_info',$shop_info);
	  $this->display();
		  }
	  }  
   /*店铺添加*/
  public function shop_add(){
	  $shop=M('shop');
	  if(IS_POST){
		$data=I('post'); 
		$data['category_id']=linkage_id(I('category_id')); 
		$user=M('user')->where(array('user'=>$data['user_id']))->find();
		$data['user_id']=$user['id'];
		if($shop->where(array('user_id'=>$data['user_id']))->find()) $this->error('该会员已有店铺了',"",3);
		$data['addtimes']=time();
		if($shop->add($data)){	
		  $this->success('','',0);
		  }else{
		  $this->error('',"",3);
		};
		  }else{
	  $type_list=link_area_list(0);	
	  $parray=''; 
	  $type_id=linkage($type_list,"category_id",$parray,0,'',array('text'=>L('area_first'),'value'=>"0"),'form-control');
	  $this->assign('type_id',$type_id);
	  $this->display();
		  }
	  }  
  /*店铺删除*/	  
  public function shop_del(){   
  	 	$id=I('id',0,'trim');
  		if(shop_del($id)){		   
		  $this->success('','',0);
		  }else{
		  $this->error('',"",3);	  
		};
  } 
/*
-----------------------------------  
产品分配    
-----------------------------------   
*/	
function allot_goods(){  
		  $model_id=I('modelid');	
		  $shop_id=I('shopid');	
		  $search=I('search','','trim');
		  $this->assign('search',$search);
		  $m=M('model');
		  $model_where=array('model_class'=>'content','status'=>1,'type'=>'Goods');
		  $model_info=$m->where($model_where)->select();//模型列表
		  $shop=M('shop')->where(array('id'=>$shop_id))->find();//当前店铺信息

		  if(IS_POST || I('get.id'))
		  {
			  $ids=I('id');
			  if(!$ids) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			  if(!is_array($ids)) $ids=array($ids);
			  foreach($ids as $k =>$v)
			  {
				  $goods_exist=M('goods_property')->where(array('goods_id'=>$v,'model_id'=>$model_id,'shop_id'=>$shop_id))->find();
				  if(!$goods_exist) $goods_property_list[]=array('goods_id'=>$v,'model_id'=>$model_id,'shop_id'=>$shop_id);
			  }
			  if(!M('goods_property')->addAll($goods_property_list))
			  {
				   $this->error(L('Allot_Goods').L('ERR'),U('Shop/Admin/allot_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);
			  }else
			  {
				   $this->success(L('Allot_Goods').L('success'),U('Shop/Admin/allot_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);
			  }
		  }else
		  {
				  if($model_id) $model_where['id']=$model_id;
				  $model=$m->where($model_where)->find();//显示内容模型
				  $ids=M('goods_property')->where(array('shop_id'=>$shop_id,'model_id'=>$model['id']))->getField('goods_id',true); //获取已分配商品的ID
				  $table= model_f($model['id']);
				  $model_config=model_config($model['id']);
				  $model_config['point_type']=$model_config['point_type']?$model_config['point_type']:'money';
				  if($table)
				  {
					  if($search){
						    if((!mb_check_encoding($search, 'utf-8'))) $search=iconv("GB2312","UTF-8",$search);
							$wheregoods['title']=array('like','%'.$search.'%');
							$wheregoods['bar_code']=$search;
							$wheregoods['_logic'] = 'or';
							$where['_complex'] = $wheregoods;
					  }			  
					  $pagesize=20;
					  $page=I('page',1,'intval');
					  $where['verify']=99;
					  if($ids) $where['id']=array('not in', implode(',',$ids));
					  $m=M($table);
					  $record_count=$m->where($where)->count();//获取总记录数
					  $page=$record_count<$pagesize?1:$page; 
					  $info=$m->where($where)->order()->page($page,$pagesize)->select();
					  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
					  $this->assign('info',$info);
					  $this->assign('page_show',$page_show);
				  }
				  $this->assign('model_info',$model_info);
				  $this->assign('model',$model);
				  $this->assign('shop',$shop);
				  $this->assign('c',$model_config);
				  
				  $this->display();			  
		  }

    }
	
/*
-----------------------------------  
产品管理    
-----------------------------------   
*/	
function manage_goods(){  
		  $model_id=I('modelid');	
		  $shop_id=I('shopid');	
		  $search=I('search','','trim');
		  $m=M('model');
		  $model_where=array('model_class'=>'content','status'=>1,'type'=>'Goods');
		  $model_info=$m->where($model_where)->select();//模型列表
		  $shop=M('shop')->where(array('id'=>$shop_id))->find();//当前店铺信息
		  if(IS_POST || I('get.id'))
		  {
			  $ids=I('id');
			  if(!$ids) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			  if(!is_array($ids)) $ids=array($ids);
			  foreach($ids as $k =>$v)
			  {
				  $goods_exist=M('goods_property')->where(array('goods_id'=>$v,'model_id'=>$model_id))->find();
				  if(!$goods_exist) $goods_property_list[]=array('goods_id'=>$v,'model_id'=>$model_id,'shop_id'=>$shop_id);
			  }

			  if(!M('goods_property')->addAll($goods_property_list))
			  {
				   $this->error(L('Allot_Goods').L('ERR'),U('Shop/Admin/allot_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);
			  }else
			  {
				   $this->success(L('Allot_Goods').L('success'),U('Shop/Admin/allot_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);
			  }
		  }else
		  {
				  if($model_id) $model_where['id']=$model_id;
				  $model=$m->where($model_where)->find();//显示内容模型
				  $table= model_f($model['id']);
				  $model_config=model_config($model['id']);
				  $model_config['point_type']=$model_config['point_type']?$model_config['point_type']:'money';
				  				  
				  if($table)
				  {
					  $pagesize=20;
					  $page=I('page',1,'intval');
					  $where['shop_id']=$shop_id;
					  $where['model_id']=$model['id'];
					  $m=M('goods_property');
					  if($search){
						  		if((!mb_check_encoding($search, 'utf-8'))) $search=iconv("GB2312","UTF-8",$search);
								$wheregoods['title']=array('like','%'.$search.'%');
								$wheregoods['bar_code']=$search;
								$wheregoods['_logic'] = 'or';
								//$where['_complex'] = $wheregoods;
								$goods_ids=M($table)->where($wheregoods)->getField('id',true);
								if($goods_ids)
								{
									$where['goods_id']=array('in',$goods_ids);
								}else{
									$where['goods_id']=0;
								}								
					  }	 
					  $info=$m->where($where)->order('id desc')->page($page,$pagesize)->select();
					  $record_count=$m->where($where)->count();//获取总记录数
					  $page=$record_count<$pagesize?1:$page;					 
					  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
					  $search=I('search','','trim');
					  foreach($info as $k=>$v)
					  {
						  $goods=M($table)->where(array('id'=>$v['goods_id']))->find();
						  $info[$k]['bar_code']=$goods?$goods['bar_code']:0;
						  $info[$k]['goods_title']=$goods?$goods['title']:"<span class=red>".L('Goods_Del')."<span>";
						  $info[$k]['goods_price']=$goods?$goods['price']:"<span class=red>".L('Goods_Del')."<span>";
						  $info[$k]['goods_class']=$goods?$goods['class_id']:0;
					  }
					  $this->assign('info',$info);
					  $this->assign('page_show',$page_show);
				  }
				  $this->assign('model_info',$model_info);
				  $this->assign('model',$model);
				  $this->assign('shop',$shop);
				  $this->assign('c',$model_config); 
				  
				  $this->display();			  
		  }

    }
	
/*
-----------------------------------  
产品删除
-----------------------------------   
*/	
function goods_del(){  
		  $model_id=I('modelid');	
		  $shop_id=I('shopid');	
		  $ids=I('id');
		  if(!$ids) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		  if(!is_array($ids)) $ids=array($ids);
          $del=M('goods_property')->delete(implode(',',$ids));
          $this->success(L('DEL').L('success'),U('Shop/Admin/manage_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);
    }	
	
/*
-----------------------------------  
商品入库
-----------------------------------   
*/	
function goods_allot_add(){  
		  $model_id=I('get.modelid');	
		  $shop_id=I('get.shopid');	
		  $id=I('id');
		  $inventory=I('inventory',0);
		  if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		  if($inventory)
		  {
			  $model=model_f($model_id);
			  $m=M('goods_property');
			  $goods_id=$m->where('id='.$id)->getField('goods_id');
			  $Goods=M($model);
		      $info=$Goods->where(array('id'=>$goods_id))->find();
		  	  if($info['inventory']<$inventory)  $this->error(L('input_inventory_error_1'),'',$this->r_time); //库存不足
			  $m->where('id='.$id)->setInc('inventory',$inventory);
			  $user=$GLOBALS['LOGIN_USER']['user'];
			  $data=array('shop_id'=>$shop_id,'goods_id'=>$goods_id,'addtime'=>time(),'inventory'=>$inventory,'operation_user'=>$user,'operation_admin'=>'admin');
			  //zhao后加
			  if(M('goods_inventory')->data($data)->add()){
				  	  $data='';
					  $action=$Goods->where(array('id'=>$goods_id))->setDec('inventory',$inventory); // 库存减
					  if($action){
							$admin=$this->admininfo;
							$data['goods_id']=$goods_id;
							$data['model_id']=$model_id;
							$data['inventory']=$info['inventory']-$inventory;
							$data['shop_id']=$shop_id;
							$data['quantity']=-$inventory;
							$data['addtime']=time();
							$shop=shop_info_show($shop_id);
							$data['msg']=L('SHOP_NAME').'【'.$shop['name'].'('.$shop_id.')】'.L('input_inventory');
							$data['operator']=$admin['user'];
							if(M('inventory_info')->add($data)){
								 $quantity=M('goods_property')->where(array('goods_id'=>$goods_id,'model_id'=>$model_id,'shop_id'=>$shop_id))->getField('inventory');
								 M('inventory_shop')->data(array('shop_id'=>$shop_id,'model_id'=>$model_id,'goods_id'=>$goods_id,'quantity'=>$quantity,'inventory'=>$inventory,'addtime'=>time(),'msg'=>L('SHOP_NAME').'【'.$shop['name'].'('.$shop_id.')】'.L('input_inventory')))->add();
								$this->success(L('ADD').L('success'),U('Shop/Admin/manage_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);				
							}
					  }
			  }
		  }
          
    }	
	
/*
-----------------------------------  
设置商品价格
-----------------------------------   
*/	
function goods_set_price(){  
		  $model_id=I('get.modelid');	
		  $shop_id=I('get.shopid');	
		  $id=I('id');
		  $price=I('price',0);
		  if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		  $data=array('price'=>$price);
		  $m=M('goods_property');
		  $save=$m->where('id='.$id)->setField($data);
		  if($save)
		  {
			  $this->success(L('SET').L('success'),U('Shop/Admin/manage_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);
		  }else
		  {
			  $this->success(L('SET').L('ERR'),U('Shop/Admin/manage_goods',array('shopid'=>$shop_id,'modelid'=>$model_id)),$this->r_time);
		  }
          
    }
	/*
-----------------------------------  
产品进出库明细    
-----------------------------------   
*/	
function inventory_list(){
		  $model_id=I('model_id',0,'intval');	
		  $goods_id=I('goods_id',0,'intval');	
		  $shop_id=I('shop_id',0,'intval');	
		  if(!$shop_id)  $this->error(L('ERR'),'',$this->r_time);
		  $this->assign('shopid',$shop_id);
		  $pagesize=20;
		  $where=array('model_id'=>$model_id,'goods_id'=>$goods_id,'shop_id'=>$shop_id);
		  $record_count= M('inventory_shop')->where($where)->count();//获取总记录数
		  $page=$record_count<$pagesize?1:$page;					 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $info=M('inventory_shop')->where($where)->order('id desc')->page($page,$pagesize)->select();
		  $this->assign('info',$info);
		  $this->assign('page_show',$page_show); 
		  $this->display();	 
	}	
}
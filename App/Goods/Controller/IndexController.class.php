<?php
namespace Goods\Controller;
use Think\Controller;
class IndexController extends Controller {
   private $model_id=50;
   function __construct()  //析构函数
   {  
        parent::__construct();
   }  

/*
-----------------------------------  
   商城首页 
-----------------------------------   
*/
    public function  index(){
	 $table=model_f($this->model_id);
	 $user=session('user');
	 $this->assign('user',$user);
	 //展示分类
	 $goods_cate=class_array($this->model_id);
	 $this->assign('goods_cate',$goods_cate);
	 $nav=M('menu')->where(array('type'=>'index_show','status'=>1))->select();
	 $this->assign('nav',$nav);
	 $goods_cate_next=class_product($this->model_id,0,6,10,$ad=array(19,14,15,16,17,18));
	 $this->assign('goods_cate_next',$goods_cate_next);
	 //首页轮播
	 $carousel=FF('Conf/carousel_pic','',APP_PATH.'Home/');
	 $this->assign('carousel',$carousel); 
	 //公告展示
	 $model_id_notice=43;
	 $this->assign('model_id_notice',$model_id_notice);
	 $class_id_notice=190;
	 $table=model_f($model_id_notice);
	 $notice=M($table)->where(array('class_id'=>$class_id_notice))->order('id desc')->limit('6')->select();
	 $this->assign('notice',$notice);
	 //楼层颜色array
	 $floor_color=array('#009900','#CCCC00','#3366FF','#FF9900','#009900','#CCCC00','#FF9900','#009900','#CCCC00');
	 $this->assign('floor_color',$floor_color);
     $this->display();
    }
/*
-----------------------------------  
   分类页
-----------------------------------   
*/	
    public function goods_cate(){
	 $user=session('user');
	 $this->assign('user',$user);
	 $table=model_f($this->model_id);
	 $goods_cate=class_array($this->model_id,0,8);
	 $this->assign('goods_cate',$goods_cate);
	 $cate_id=I('id');
	 if(!$cate_id) $this->error(L('ERR'),"",$this->r_time);
	 $cate=M('sys_model_class')->where(array('id'=>$cate_id))->find();
	 $cate_parent_id=$cate['parent_id'];
	 $new_goods_up_id=class_child($this->model_id,$cate_parent_id);
	 $new_goods_up=M($table)->where(array('class_id'=>array('in',$new_goods_up_id),'recommend'=>0))->order('id desc')->limit('10')->select();
	 $this->assign('new_goods_up',$new_goods_up);
	 $this->assign('cate',$cate);
	 $cate_child=M('sys_model_class')->where(array('parent_id'=>$cate_id))->select();
	 $cate_child_next=M('sys_model_class')->where(array('parent_id'=>$cate_id))->select();
	 $this->assign('cate_child_next',$cate_child_next);
	 $this->assign('cate_child',$cate_child);
	 $nav=M('menu')->where(array('type'=>'index_show','status'=>1))->select();
	 $this->assign('nav',$nav);
	 $Goods=M($table);
	 $pagesize=20;	
	 $page=I('page',1,'intval');
	 $class_id=class_child($this->model_id,$cate_id);
	 	 //最大价格
	 $max_price=M($table)->where(array('class_id'=>array('in',$cate_id)))->order('price desc')->find();
	 $max_price=$max_price['price'];
	 //最小价格
	 $min_price=M($table)->where(array('class_id'=>array('in',$cate_id)))->order('price asc')->find();
	 $min_price=$min_price['price'];
	 $show_price_section=show_price_section($max_price,$min_price,5);
	 $this->assign('show_price_section',$show_price_section);
	 $where['class_id']=array('in',$class_id);
	 $max=I('max');
	 $min=I('min');
	 if($max){
		if(!$min)	$min=0; 
		if(!$max)	$max=0;  
		if($max<$min){
			$max=$min+1;
		}
		$where['price']=array(array('egt',$min),array('elt',$max));
	 }
	 $orders='id desc';
	 if(I('selects_1')){
		if(I('selects_1')=="price_up")  $orders='price desc';
		if(I('selects_1')=="price_down")  $orders='price asc';
		if(I('selects_1')=="showtime")  $orders='addtime desc';
		
	 }
	 $this->assign('selects_1',I('selects_1'));
	 $this->assign('max',$max);
	 $this->assign('min',$min);
	 $record_count=$Goods->where($where)->count();//获取总记录数
	 $this->assign('record_count',$record_count);
	 $page=$record_count<$pagesize?1:$page;
	 if($record_count>0)
		{
		  $info=$Goods->where($where)->order($orders)->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}
	 $this->assign('info',$info);
	 $this->assign('model_id',$this->model_id);
     $this->display();
    }
/*
-----------------------------------  
   分类显示
-----------------------------------   
*/	
    public function goods_cate_all(){
	 $user=session('user');
	 $this->assign('user',$user);
	 $goods_cate=class_array($this->model_id,0,20);
	 $this->assign('goods_cate',$goods_cate);
	 $nav=M('menu')->where(array('type'=>'index_show','status'=>1))->select();
	 $this->assign('nav',$nav);
	 $this->assign('info',$goods_cate);
     $this->display();
    }

/*
-----------------------------------  
   展示页
-----------------------------------   
*/		
	
   public function goods(){
	 $user=session('user');
	 $this->assign('user',$user);
	 $qq=C('site_qq');
	 $qq_list=explode('|',$qq);
	 $this->assign('qq_list',$qq_list); 
	 $goods_cate=class_array($this->model_id);
	 $this->assign('goods_cate',$goods_cate);
	 $id=I('id');
	 if(!$id) $this->error(L('ERR'),"",$this->r_time);
	 $table=model_f($this->model_id);
	 $Goods=M($table);
	 $info=$Goods->where(array('id'=>$id))->find();
	 $info['pictures']=explode(',',$info['pictures']);
	 $this->assign('info',$info);
	 $cate=M('sys_model_class')->where(array('id'=>$info['class_id']))->find();
	 $cate_parent_id=$cate['parent_id'];
	 $new_goods_up_id=class_child($this->model_id,$cate_parent_id);
	 $new_goods_up=M($table)->where(array('class_id'=>array('in',$new_goods_up_id),'recommend'=>0))->order('id desc')->limit('10')->select();
	 $this->assign('new_goods_up',$new_goods_up);
	 $cate=M('sys_model_class')->where(array('id'=>$cate_id))->find();  
	 $this->assign('cate',$cate);
	 $nav=M('menu')->where(array('type'=>'index_show','status'=>1))->select();
	 $this->assign('nav',$nav); 
	 $cate_child=M('sys_model_class')->where(array('parent_id'=>$cate_id))->select();
	 $this->assign('cate_child',$cate_child); 
	 $this->assign('model_id',$this->model_id);
     $this->display();
    }
//搜索
	public function search(){
		$user=session('user');
	    $this->assign('user',$user);
		$cate_parent_id=0;
		$table=model_f($this->model_id);
	    $new_goods_up_id=class_child($this->model_id,$cate_parent_id);
	    $new_goods_up=M($table)->where(array('class_id'=>array('in',$new_goods_up_id),'recommend'=>0))->order('id desc')->limit('6')->select();
	    $this->assign('new_goods_up',$new_goods_up);
		$cate_child=M('sys_model_class')->where(array('parent_id'=>0))->select();
	    $this->assign('cate_child',$cate_child);
		$goods_cate=class_array($this->model_id);
	    $this->assign('goods_cate',$goods_cate);
		$this->assign('page_title',C('site_title')); 
		$keyword=I('keyword');
		load("Shop/function");
		if((!mb_check_encoding($keyword, 'utf-8'))) $keyword=iconv("GB2312","UTF-8",$keyword);
		$where['title']=array('like','%'.$keyword.'%');
		$where['verify']=99;
		$table=model_f($this->model_id);
		$Goods=M($table);	
		$pagesize=20;	
		$page=I('page',1,'intval');
		$record_count=$Goods->where($where)->count();//获取总记录数
		$this->assign('record_count',$record_count);
		$page=$record_count<$pagesize?1:$page;
		$info=$Goods->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$this->assign('show_array',$page_show);// 赋值分页输出
		$this->assign('info',$info);
		$this->assign('show','show');
		$this->assign('model_id',$this->model_id);				
		$this->display('goods_cate');
    }	
/*







-----------------------------------  
   购物车
-----------------------------------   
*/	
   public function flow(){	
   		$cart=M('cart');
		$user=session('user');
		$this->assign('user',$user);
		session('url',U('Goods/index/flow'));
		if(!$user)  $this->redirect('User/index/index');  
		load("Order/function");
	 $cart=M('cart');
     if(IS_POST)
     {
	  $post=I('post');
	  if(!$post){
		$this->error(L('Shop_no_post'),'Goods/index/flow',$this->r_time);
		  }
	  foreach($post as $val){
		  $where['id']=$val['cart_id'];
		  $data['goods_num']=$val['num'];
		  $cart->where($where)->save($data);
		  if(!$model_id) $model_id=$cart->where($where)->getField('model_id');
		  $cart_id[]=$val['cart_id'];
		  }	
	  $model_cofig=model_config($model_id);
	  $cart_info=cart_separate($cart_id,$user['id']);
	  if($cart_info['goods_type']==0){
		session('cart_info',$cart_info);
		$this->redirect('Goods/index/add_consignee_info','model_id='.$model_id.'');  
		  }else{
	    $sn=settle_cart($cart_info,$user['id'],$consignee_id,$discount=1,1,$model_cofig['point_type']);
	    $this->redirect('Accounts/Pay/pay_list/','order_id='.$sn.'&model_id='.$model_id.''); 			  
			  }
/*	  $sn=settle_cart($cart_info,$user['id'],$consignee_id,$discount=1);
	  $this->redirect('Accounts/Pay/pay_list/','order_id='.$sn.'');*/
	  }else{ 
	  $info=cart_info($user["id"]);
	  $this->assign('info',$info);
	  $page_title=L('my_cart');
	  $this->assign('page_title',$page_title);
	  $this->display();
	  }
	  } 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	  
/*
-----------------------------------  
   会员实物下单填写地址信息
----------------------------------- 
*/	
  public function add_consignee_info(){ 
      $user=session('user');
	  $this->assign('user',$user);
	  if(!$user)  $this->redirect('User/index/index');
	  $user_id=$user["id"]; 
	  $model_id=I('model_id');
	  $model_cofig=model_config($model_id);
	  $this->assign('model_id',$model_id);
	  load("Order/function");
	  if(IS_POST)
      { 
	  $data['user_id']=$user_id;
	  $data['consignee']=I('post.name');
	  $data['address']='';
	  $data['mobile']=I('post.mobile');
	  $data['area_id']=linkage_id(I('post.area_id'));
	  $consignee=M('consignee');
	  $id=$consignee->add($data);
	  if(session('cart_info')){
	  $cart_info=session('cart_info');
	  $sn=settle_cart($cart_info,$user_id,$id,$discount=1,1,$model_cofig['point_type']);
	  session('cart_info',null);
	  $this->redirect('Accounts/Pay/pay_list/','order_id='.$sn.'&model_id='.$model_id.''); 	
	  }else{
	  $this->success(L('success'),U('Order/User/add_consignee_info'),0);  
		  }
	  }else{
	  $area_list=link_list_info_1(0,'linkage');
	  $area_id=linkage($area_list,"area_id","",0,array(),array('text'=>L('area_first'),'value'=>"0"),'form-control');	 
	  $this->assign('page_title',L('Order_add_consignee'));
	  $this->assign('area_id',$area_id);
	  $this->display();
	  }
	  } 
	  
/*
-----------------------------------  
   当前会员添加购物车
-----------------------------------   
*/	  
  public function add_cart_user(){ 
      load("Order/function");
      $user=session('user');
	  if(!$user)  $this->redirect('User/index/index');
	  $user_id=$user["id"]; 
	  $goods_id=I('goods_id',0,'intval');
	  $model_id=I('model_id',0,'intval');	 
	  $goods_num=I('goods_num',1,'intval');	  
  	  add_cart($goods_id,$user_id,$goods_num,$model_id);
	  $this->redirect('Goods/index/flow');
	  } 
/*
-----------------------------------  
   清空购物车
-----------------------------------   
*/	  
  public function cart_clear(){ 
  	  $user=session('user');
	  if(!$user)  $this->redirect('User/index/index');
	 
      $id=I('id');
	  if($id=='all'){
		  if(M('cart')->where(array('user_id'=>$user['id']))->delete()){
			$this->success(L('success'),'',0);   
			  }
		  }else{
		  if(M('cart')->where(array('id'=>$id))->delete()){
			$this->success(L('success'),'',0);  
			  } 
		 }
  	  } 
/*
-----------------------------------  
注册
-----------------------------------
*/ 
 public function register(){ 
  	  $this->display();
  	  } 
 public function ceshi(){ 
		 dump(comment(50,688,1));
  	  } 
}
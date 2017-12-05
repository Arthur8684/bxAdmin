<?php
namespace Shop\Controller;
use Think\Controller;
class IndexController extends Controller{

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   用户商铺首页  
-----------------------------------   
*/
  public function shop_index()
  { 	
		$shop_id=I('get.shop_id',0,'intval');
	  	if(!$shop_id){
			$this->error(L('Err'),U('index/index/index'),3);
			}
		 $shop_info=shop_info_show($shop_id);
		 if($shop_info['is_open']==1){
			 $this->error(L('thishop_closeed'),U('home/index/index'),3);
			 }
		 $model=M('model');
		 $where['type']='Group_buy';
		 $group_buy=$model->where($where)->select();
		 $where='';
		 $where['autho_id']=$shop_info["user_id"];
		 foreach($group_buy as $v){
			 $table=$v['table']; 
			 $table=M($table);
			 $group_buy_lists=$table->where($where)->select();
			 foreach($group_buy_lists as $val){
				 $val['model_id']=$v['id'];
				 $group_buy_list[]=$val;
				 }
		 }
		//一页显示数量
		$pagesize=20;
		//数组数量
		$page=I('get.page',1,'intval');
		$arraynums=count($group_buy_list);
		$countpage=ceil($arraynums/$pagesize);
		$info=page_array($pagesize,$page,$group_buy_list,1);
		//显示页码
		//$showpage=show_array($countpage,$page);
		//$this->assign('showpage',$showpage); 	
		$config=FF('Conf/config','',MODULE_PATH);
		$shop_color=$config['shop_color'];
		$shop_info['shop_color']=$shop_color[$shop_info['style']];	
		$this->assign('model_id',$group_buy['id']); 	
		$this->assign('info',$info); 	
		$this->assign('shop_info',$shop_info); 	
		$this->assign('page_title',$shop_info['name']); 	 	
	    $this->display(); 		 
	  } 
/*
-----------------------------------  
   店铺商品分类
-----------------------------------   
*/	
   public function category_all()
   { 
		$this->display();    	
   } 
/*
-----------------------------------  
   店铺商品展示
-----------------------------------   
*/	
   public function goods()
   { 
		$goods_id=I('get.goods_id',1,'intval');	
		$modle_id=I('get.modle_id',1,'intval');	
		if(!$goods_id || !$modle_id){
			$this->error(L('Err'),U('index/index/index'),3);
			} 
		$model=model_f($modle_id);
		$table=$model['table'];
		$goods=M($table);
		$where['id']=$goods_id;
		$goods_info=$goods->where($where)->find();
		$this->assign('goods_info',$goods_info); 
		$this->display();    	
   } 
/*
-----------------------------------  
   店铺商品列表展示
-----------------------------------   
*/	
   public function goods_list()
   { 	
   		 $shop_id=I('get.shop_id',1,'intval');
		 $shop_info=shop_info_show($shop_id);
		 $config=FF('Conf/config','',MODULE_PATH);
		 $shop_color=$config['shop_color'];
		 $shop_info['shop_color']=$shop_color[$shop_info['style']];	
		 $model=M('model');
		 $where['type']='Group_buy';
		 $group_buy=$model->where($where)->select();
		 $where='';
		 $where['autho_id']=$shop_info["user_id"];
		 foreach($group_buy as $v){
			 $table=$v['table']; 
			 $table=M($table);
			 $group_buy_lists=$table->where($where)->select();
			 foreach($group_buy_lists as $val){
				 $val['model_id']=$v['id'];
				 $group_buy_list[]=$val;
				 }
		 }
		//一页显示数量
		$pagesize=10;
		//数组数量
		$page=I('get.page',1,'intval');
		$arraynums=count($group_buy_list);
		$countpage=ceil($arraynums/$pagesize);
		$info=page_array($pagesize,$page,$group_buy_list,1);
		//显示页码
		$showpage=show_array($countpage,U('shop/index/goods_list','shop_id='.$shop_id.''));
		$this->assign('model_id',$group_buy['id']); 	
		$this->assign('shop_info',$shop_info); 		
		$this->assign('showpage',$showpage); 
		$this->assign('page_title',$shop_info['name']); 
		$this->assign('info',$info);
		$this->display();    	
   } 
/*
-----------------------------------  
   店铺信息展示
-----------------------------------   
*/	
   public function show_info()
   { 
    	 $shop_id=I('get.shop_id',1,'intval');
		 $shop_info=shop_info_show($shop_id);
		 $config=FF('Conf/config','',MODULE_PATH);
		 $shop_color=$config['shop_color'];
		 $shop_info['shop_color']=$shop_color[$shop_info['style']];	
		 $this->assign('shop_info',$shop_info);
		 $this->assign('page_title',$shop_info['name']);  
		 $this->display(); 
   } 
/*
-----------------------------------  
   店铺首页显示
-----------------------------------   
*/   
    public function index()
	{    
	 	 $this->assign('page_title',L('商铺中心'));  		 
		 $this->display(); 
		}		
/*
-----------------------------------  
   首页ajax显示分类
-----------------------------------
*/
    public function cate_list()
	{   
		$cate_id=I('get.cate_id',0,'intval'); 
		$cate=category_array($cate_id,'shop_category');
			if($cate_id){
			$html="<li onclick='show_shop(".$cate_id.",1,1)'>".L('all')."</li>";	
			}	
		foreach($cate as $val){		
			if(!$cate_id){
			$click='show_w60('.$val['id'].',1)';
			}else{
			$click='show_shop('.$val['id'].',1,1)';		
				}	
			$html.='<li onclick='.$click.'>'.$val['name'].'</li>';			
			}
			echo $html;
		}
/*
-----------------------------------  
   首页ajax显示地区分类
-----------------------------------
*/
    public function area_list()
	{   
	$area_id=I('get.area_id',0,'intval'); 
	$area_id_z=I('get.area_id_z',0,'intval'); 
	if($area_id){
		$areas=$area_id;
		}elseif($area_id_z){
		$areas=$area_id_z;
		}
		
		$html="<li onclick='show_shop(".$areas.",2,1)'>".L('all')."</li>";	
		
		$area=category_array($areas,'linkage');

		foreach($area as $val){		
			if($area_id_z){
			$click='show_w60('.$val['id'].',2)';
			}elseif($area_id){
			$click='show_shop('.$val['id'].',2,1)';		
				}	
			$html.='<li onclick='.$click.'>'.$val['name'].'</li>';			
			}
			echo $html;
		}
/*
-----------------------------------  
   首页显示商铺列表
-----------------------------------
*/	
    public function shop_list()
	{	
	    //dump(session('Location'));
	    $pagesize=10;
		$page=I('get.page',1,'intval'); 
		$area_id=I('get.area_id',0,'intval'); 
		$cate_id=I('get.cate_id',0,'intval');
		$where['category_id']=$cate_id;
		$where['area_id']=$area_id;
		$shop_list=shop_indexshow_lisht($where);
		$shop_list=page_array($pagesize,$page,$shop_list,$order);
		$this->assign('shop_list',$shop_list);
		$this->display(); 
		
		}
/*
-----------------------------------  
   获取当前用户坐标
-----------------------------------
*/	
    public function get_gps()
	{
		$x=I('get.x');
		$y=I('get.y');
		$baidu=convertBmapGPS($x,$y);
		insert_Location($baidu[x],$baidu[y]);
		}
/*
-----------------------------------  
   显示当前用户的具体地址
-----------------------------------
*/
    public function get_address()
	{
		$loaction=session('Location');
		$loactions=get_Location($loaction['y'],$loaction['x']);
		if($loactions["formatted_address"]){
		echo $loactions["formatted_address"];	
		}else{
		echo L('null');	
			}
		}
		
/*
-----------------------------------  
   显示当前用户的所在市
-----------------------------------
*/
    public function get_city_id()
	{
		$loaction=session('Location');
		$loactions=get_Location($loaction['y'],$loaction['x']);
		if($loactions["addressComponent"]["city"]){
		$area=M('linkage');
		$where['name']=$loactions["addressComponent"]["city"];
		$area_name=$area->where($where)->find();
		if($area_name){
		return $area_name['id'];
		}else{
		return 1;	
			}
		}else{
		return 1;	
			}
		}

/*
-----------------------------------  
   网站首页显示商铺列表
-----------------------------------
*/	
    public function index_shop_list()
	{	
	    //dump(session('Location'));
	    $pagesize=20;
		$area_id=$this->get_city_id(); 
		$where['area_id']=$area_id;
		$shop_list=shop_indexshow_lisht($where);
		foreach($shop_list as $v){		
			$shop_id[]=$v['user_id'];			
			}
		$modle=M('model');	
		$where['type']='Group_buy';
		$modle_name=$modle->where($where)->select();
		
		$where='';

			foreach($modle_name as $vq){
			if($shop_id){
			$where["autho_id"]=array('in',$shop_id);
			}
			$table=M(''.$vq['table'].'');
			$group_buy_list=$table->where($where)->limit($pagesize)->order('rand()')->select();
			if($group_buy_list){
			foreach($group_buy_list as $v){
				$v['model_id']=$vq['id'];
				$info[]=$v;
				}	
			}

		}
		$this->assign('info',$info);
		$this->assign('model_id',$modle_name['id']);
		$this->display(); 
		
		}

/*
-----------------------------------  
   显示当前用户的所在市
-----------------------------------
*/
    public function get_city_id_show()
	{
		echo $this->get_city_id();
		}
/*
-----------------------------------  
   ajax显示选中名称
-----------------------------------
*/
    public function get_cate_name()
	{
		$cate_id=I('get.cate_id');	
		$table=I('get.table');		
		$name=show_cate_name($cate_id,$table);				
		echo $name['name'];
		}
/*
-----------------------------------  
   显示当前位置商家  $max 半径距离 KM
-----------------------------------
*/	
    public function show_map()
	{	
		$max=5;
		$where['area_id']=$this->get_city_id();	
		$shop_list=shop_indexshow_lisht($where);
		foreach($shop_list as $val){			
			if($val['distanceBetween']<$max){			
				$info.="[".$val['x'].",".$val['y'].",".$val['id'].",'".$val['name']."','".$val['address']."'],";
				}
			}
		$loaction=session('Location');
		$x=isset($loaction['x'])?$loaction['x']:116.404;
		$y=isset($loaction['y'])?$loaction['y']:39.915;
		$this->assign('page_title',L('all_aroud_me'));
		$this->assign('x',$x);	
		$this->assign('y',$y);	
		$this->assign('info',$info);
		$this->display(); 	
		}		
}
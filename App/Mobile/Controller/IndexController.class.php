<?php
namespace Mobile\Controller;
use Org\Util\base;
class IndexController extends base {
	public  $model_id=50;
    public function index(){
		$menu=M('menu');
		$where['type']='mobile_index';  
		$menu_list=$menu->where($where)->order('sort')->select();  
		$carousel=FF('Conf/carousel_pic','',APP_PATH.'Home/');
		$this->assign('carousel',$carousel);  
		$this->assign('menu_list',$menu_list);
		$this->assign('page_title',C('site_title')); 
		$this->display();
    }
	public function mobile(){
	$this->display();
	}
	public function cate_all(){
		$menu=M('sys_model_class');
		$model_id=$this->model_id;
		$where['parent_id']=I('get.cate_id',0,'intval');
		$where['model_id']=$model_id;
		$where['status']=1;
		$menu_list=$menu->where($where)->order('sort')->select();  
		if($where['parent_id']>0){	
			foreach($menu_list as  $val){
				$html.='<p onclick="location.href=\''.U('Mobile/index/goods_list','category_id='.$val['id'].'').'\'">'.$val['name'].'<p>';				
				}	
			echo $html;
			}else{
		$this->assign('menu_list',$menu_list);
		$this->assign('page_title',C('site_title')); 
		$this->display();
			}		
    }
	
	public function goods_list(){
		$this->assign('page_title',C('site_title')); 
		load("Shop/function");
		if(I('cate_id')){	
		$category_id=I('cate_id',0,'intval');		
			}else{
		$category_id=I('category_id',0,'intval');	
				}
		$categoryarray=M('sys_model_class')->where('parent_id='.$category_id.'')->getField('id',true);
	    $categoryarray[]=$category_id;
		$where['class_id']=array('in',$categoryarray);
		$where['verify']=99;
		$table=model_f($this->model_id);
		$Goods=M($table);	
		$pagesize=10;	
		$page=I('page',1,'intval');
		$record_count=$Goods->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		$info=$Goods->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$this->assign('show_array',$page_show);// 赋值分页输出
		$this->assign('info',$info);
		$this->assign('model_id',$this->model_id);				
		$this->display();
    }
	
 public function  goods_info(){
		$id=I('id',0,'intval');
		$model_id=$this->model_id;
		$model=M('model');
		$model_table=$model->where('id='.$model_id.'')->find();
		$table=$model_table['table'];
		$goods=M(''.$table.'');
		$info=$goods->where('id='.$id.'')->find();
		$info['pictures']=explode(',',$info['pictures']);
		$user=M('user');
		$user_info=$user->where('id='.$info['autho_id'].'')->find();
		if($user_info){
		$shop=M('shop');
		$shop_info=$shop->where('user_id='.$user_info['id'].'')->find();
		}
		$this->assign('shop_info',$shop_info);
		$this->assign('model_id',$model_id);
		$this->assign('info',$info);
        $this->display();
    }
/*
-----------------------------------  
   网站首页显示商铺列表
-----------------------------------
*/	
    public function index_shop_list()
	{	
	    load("Shop/function");
	    $pagesize=20;
		$table=model_f($this->model_id);
		$Goods=M($table);
		$info=$Goods->order('id desc')->limit(0,$pagesize)->select(); 	
		$this->assign('info',$info);
		$this->assign('model_id',$this->model_id);
		$this->display(); 
		}
	
	
//当前位置的地区id
	
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
		
//设置首页轮播图	
    public function carousel_pic()
	{	

		if(IS_POST){
			$data=I('post.post');	
			$i=0;
			foreach($data as $val){
				if($val['name'] && $val['carousel_url'] && $val['carousel_img_url']){
					$data2[$i]=$val;
					$i++;
					}
				}
			FF('Conf/carousel_pic',$data2,MODULE_PATH);		
			$this->success(L('carousel_Suc'),U('Home/index/carousel_pic'),0);	
			}else{
			$info=FF('Conf/carousel_pic','',MODULE_PATH);
			$key1=count($info);
			$this->assign('key1',$key1);	
			$this->assign('info',$info);	
			$this->display();			
			}
		}	
}
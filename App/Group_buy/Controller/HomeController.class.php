<?php
namespace Group_buy\Controller;
use Think\Controller;
class HomeController extends Controller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  

/*
-----------------------------------  
   文章列表 
-----------------------------------   
*/
    public function  goods_info(){
		$id=I('id',0,'intval');
		$model_id=I('model_id',0,'intval');
		$model=M('model');
		$model_table=$model->where('id='.$model_id.'')->find();
		$table=$model_table['table'];
		$goods=M(''.$table.'');
		$info=$goods->where('id='.$id.'')->find();
		$info['pictures']=explode(',',$info['pictures']);
		$user=M('user');
		$user_info=$user->where('id='.$info['autho_id'].'')->find();
		$shop=M('shop');
		$shop_info=$shop->where('user_id='.$user_info['id'].'')->find();
		$this->assign('shop_info',$shop_info);
		$this->assign('model_id',$model_id);
		$this->assign('info',$info);
        $this->display();
    }
	
	
}
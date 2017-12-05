<?php
namespace Comment\Controller;
use Think\Controller;
class AjaxcommentController extends Controller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }
   
/*
----------------------------------
  	添加评论模板
----------------------------------
*/  
	public function  add_comment_html()
	{
		$model_id=I('model_id');
		$goods_id=I('goods_id');
		$this->assign('model_id',$model_id);
		$this->assign('goods_id',$goods_id);
		$c=FF("Comment/comment_config_".$model_id."");
		if(!$c) $c=FF("Comment/comment_config");
		$user=session('user');
		if(!$user) exit(L('add_comment_err_1'));
		if($c['is_pay']==1){
			$config=FF('Conf/db','',COMMON_PATH);
			$is_pay=M('order')->where(array('user_id'=>$user['id'],'ship_status'=>2))->join('LEFT JOIN '.$config['DB_PREFIX'].'order_info ON '.$config['DB_PREFIX'].'order.order_sn = '.$config['DB_PREFIX'].'order_info.order_sn' )->find();
			$order_sn=M('order')->where(array('user_id'=>$user['id'],'ship_status'=>2))->getField('order_sn',true);
			$is_pay='';
			if($order_sn) $is_pay=M('order_info')->where(array('order_sn'=>array('in',$order_sn),'model_id'=>$model_id,'goods_id'=>$goods_id))->find();
			if(!$is_pay){
				exit(L('add_comment_err_6')); ;	//未支付不能评论返回6
			}
		}
		$info=M('comment')->where(array('model_id'=>$model_id,'goods_id'=>$goods_id,'user_id'=>$user['id']))->find();
		if($info)  exit(L('add_comment_err_8'));	//仅能发表一次返回8;
		$tpl_name=$c['tpl_name'];
		$mobile_tpl_name=$c['mobile_tpl_name'];
		if(isMobile()){
			if($mobile_tpl_name){
				$this->display($mobile_tpl_name.'_mobile');
			}else{
				$this->display('default_mobile');
			}
		}else{
			if($tpl_name){
				$this->display($tpl_name);
			}else{
				$this->display('default');
			}				
		}
	}
/*
----------------------------------
  	显示评论模板
----------------------------------
*/ 
	public function comment_list_html()
	{
		$model_id=I('model_id');
		$goods_id=I('goods_id');
		if(!$model_id) exit(L('comment_err'));
		if(!$goods_id) exit(L('comment_err'));
		$c=FF("Comment/comment_config_".$model_id."");
		if(!$c) $c=FF("Comment/comment_config");
		$where['model_id']=$model_id;
		$where['goods_id']=$goods_id;
		if($c['end_time']) $where['addtime']=array('gt',time()-$c['end_time']*24*3600);	
		$where['is_audit']=1; 			
		$pagesize=3;	
		$page=I('page',1,'intval');
		$record_count=M('comment')->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
		  $info=M('comment')->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=ajax_page_show($record_count,$pagesize,$model_id,$goods_id,'comment_list',$page);
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}
		$this->assign('info',$info);
		$tpl_name=$c['tpl_name'];
		$mobile_tpl_name=$c['mobile_tpl_name'];
		if(isMobile()){
			if($mobile_tpl_name){
				$this->display($mobile_tpl_name.'_list_mobile');
			}else{
				$this->display('default_list_mobile');
			}
		}else{
			if($tpl_name){
				$this->display($tpl_name.'_list');
			}else{
				$this->display('default_list');
			}				
		}		
	} 
/*
----------------------------------
  	添加评论的方法
----------------------------------
*/
	public function add_comment_func()
	{
		$model_id=I('model_id',0,'intval');
		$goods_id=I('goods_id',0,'intval');
		$star=I('star',0,'intval');
		$content=I('content');
		$user=session('user');
		if(!$user) exit(L('err'));
		$user_id=$user['id'];
		$action=add_comment($user_id,$model_id,$goods_id,$star,$content);
		if($action!=99){
			exit(L('add_comment_err_'.$action.''));
		}else{
			exit(L('SUCCESS'));
		}
	}
}
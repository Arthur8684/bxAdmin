<?php
namespace Comment\Controller;
use Org\Util\Admin;
class AdminController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }
   
/*
----------------------------------
  评论设置
----------------------------------
*/     
   public function setting()
   {
	   $group_list=group_list_();
	   $this->assign('user_group',$group_list);
	   $model_id=I("model_id",0,'intval');
	   $this->assign('coin_type',C('point_type'));
	   if($model_id){
	   //有model_id时为当前模型的评论设置
	   	  	$c=FF("Comment/comment_config_".$model_id.""); 
			$this->assign('model_id',$model_id);
			if(IS_POST){
				$post=I('post.');
			    FF('Comment/comment_config_'.$model_id.'',$post);
				$c=FF("Comment/comment_config_".$model_id.""); 
			}		   
	        }else{
	   //无model_id时为全局设置
	   		$c=FF("Comment/comment_config");
			if(IS_POST){
				$post=I('post.');
			    FF('Comment/comment_config',$post);
				$c=FF("Comment/comment_config");
			}
		}
	   $this->assign('c',$c);
	   $this->display();
   }
/*
----------------------------------
  评论列表
----------------------------------
*/
	public function comment_list()
	{
		$is_audit=I('is_audit',-1,'intval');
		$this->assign('is_audit',$is_audit);
		if($is_audit==1) $where['is_audit']=0;
		$model_id=I('model_id',-1,'intval');
		$goods_id=I('goods_id',-1,'intval');
		$this->assign('model_id',$model_id);
		$this->assign('goods_id',$goods_id);
		if($model_id>-1 && $goods_id>-1){
			$where['model_id']=$model_id;
			$where['goods_id']=$goods_id; 	
		}
		$pagesize=15;	
		$page=I('page',1,'intval');
		$record_count=M('comment')->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
		  $info_old=M('comment')->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  foreach($info_old as $val){
			   $val['goods_title']=M(model_f($val['model_id']))->where(array('id'=>$val['goods_id']))->getField('title');
			   $info[]=$val;
		  }
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('info',$info);
		$this->display();	
	}
/*
----------------------------------
  审核评论
----------------------------------
*/
	public function comment_audit()
	{
		$id=I('id');
		if(!$id)  $this->error(L('ERR'),"",$this->r_time);
		$comment=M('comment');
		$get_one=$comment->where(array('id'=>$id,'is_audit'=>0))->find();
		if($get_one){
			$c=FF("Comment/comment_config_".$get_one['model_id']."");
			if(!$c) $c=FF("Comment/comment_config");
			if($comment->where(array('id'=>$id))->save(array('is_audit'=>1))){
				if($c['comment_point_type'] && $c['point_num']){
					$goods_info=M(model_f($get_one['model_id']))->where(array('id'=>$get_one['goods_id']))->getField('title');
					account($get_one['user_id'],array($c['comment_point_type']=>$c['point_num']),6,6,L('SYSTEM'),L('account_comment_sccess',array('goods_info'=>$goods_info)));	
				}
				$this->success(L('audit_sccess'),'',$this->r_time);
			}
		}	
	}
/*
----------------------------------
  评论删除
----------------------------------
*/   
	public function comment_del()
	{
		$id=I('id');
		if(!$id)  $this->error(L('ERR'),"",$this->r_time);
		$comment=M('comment');
		$get_one=$comment->where(array('id'=>$id))->find();
		if($get_one){
			$c=FF("Comment/comment_config_".$get_one['model_id']."");
			if(!$c) $c=FF("Comment/comment_config");
			if($comment->where(array('id'=>$id))->delete()){
				if($c['comment_point_type'] && $c['del_point_num']){
					$goods_info=M(model_f($get_one['model_id']))->where(array('id'=>$get_one['goods_id']))->getField('title');
					account($get_one['user_id'],array($c['comment_point_type']=>-$c['del_point_num']),7,6,L('SYSTEM'),L('account_comment_del',array('goods_info'=>$goods_info)));
				}
				$this->success(L('del_sccess'),'',$this->r_time);	
			}
		}else{
			$this->error(L('ERR'),"",$this->r_time);
		}	
	}
}
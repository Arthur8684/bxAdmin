<?php
namespace Article\Controller;
use Org\Util\Admin;
class ArticleController extends Admin{

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   文章内容列表
-----------------------------------   
*/
    public function article_list(){
		load('Sys_model/function');
	    $classid=I('classid',0,'intval');
		$modelid=I('modelid',0,'intval');
		$model=model_f($modelid,"");
		$table=$model['table'];
	    $pagesize=10;	
		$page=I('page',1,'intval');
	    $article =M($table);
		if($classid) $where['class_id']=$classid;
		$record_count=$article->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$article->where($where)->order('id desc')->page($page,$pagesize)->select(); 
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
   文章添加	   
-----------------------------------   
*/	
    public function article_add(){  
			$classid=I('classid',0,'intval');
			$modelid=I('modelid',0,'intval');
			$model=model_f($modelid,"");
			$table=$model['table'];
			$article =M($table);
	          if(IS_POST)
			  {		
			     $classid=linkage_id($classid);
			     fields($table);
				 if(!$classid) $this->error(L('SELECT').L('CLASS'),"",$this->r_time);
			  //------------------------------------保存文章----------------------------------------	
						if ($article->create()){
					           $article->content=$_POST['content'];
							   $article->class_id=$classid;
							   if($article->add())
							   {
							        $this->success(L('ADD').L('success'),U('Article/Article/article_list',array('modelid'=>$modelid)),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($article->getError(),"",$this->r_time);
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
   文章编辑	   
-----------------------------------   
*/	
    public function article_edit(){  
	          $id=I('id',0,'intval');
			  $classid=I('classid',0,'intval');
			  $modelid=I('modelid',0,'intval');
			  $model=model_f($modelid,"");
			  $table=$model['table'];
			  $article =M($table);		  
       	     //------------------------------------验证数据正确性----------------------------------------			  
			  if(!$id){	 $this->error(L('ERR_PARAM_ID'),"",$this->r_time);	}
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
			  
			           $classid=linkage_id($classid);
				       if(!$classid) $this->error(L('SELECT').L('CLASS'),"",$this->r_time);
			           fields($table,array(),$id);
			  //------------------------------------编辑提交的管理员----------------------------------------   
						if ($article->create()){
						       $article->content=$_POST['content'];
							   $article->class_id=$classid;
							   if($article->save()!==false)
							   {
							        
							        $this->success(L('EDIT').L('success'),U('Article/Article/article_list',array('modelid'=>$modelid)),$this->r_time);
							   }
							   else
							   {

							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($article->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		  
					 $where['id']=$id;
				     $info=$article->where($where)->find();
					 
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
   文章删除  
-----------------------------------   
*/	
    public function  article_del(){  	
	          $id=I('id',0,'intval');
			  $classid=I('classid',0,'intval');
			  $modelid=I('modelid',0,'intval');
			  $model=model_f($modelid,"");
			  $table=$model['table'];
			  $article =M($table);	
			  $del_num=0;//删除会员的条数		  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }	
				 if(!is_array($id))	$id=array($id)	;
				 $del_num=$article->delete(implode(",",$id)); 
				 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Article/Article/article_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);	      
    }
	
}
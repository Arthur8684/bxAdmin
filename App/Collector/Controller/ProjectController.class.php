<?php
namespace Collector\Controller;
use Org\Util\Admin;
class ProjectController extends Admin {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
		  $this->Filter=array('script','iframe','style','html');
		  $this->path=COMMON_PATH."Cache/collector/";
	 }  
/*=================================================
**项目列表
==================================================*/
	public function project_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$project=M('collector_project');
		//------------------------------------管理员列表----------------------------------------
		$record_count=$project->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$project->order('id desc')->page($page,$pagesize)->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
		//------------------------------------管理员列表----------------------------------------
		$this->assign('info',$info);
		$this->display();
	}
/*=================================================
**添加项目
==================================================*/	
	public function project_add(){
		if(IS_POST)
		{
			$title=I('title');
			$url=I('url');
			$model_id=I('model_id');
			if(!$title) $this->error(L('Project_Err_1'),"",$this->r_time);
			if(!$url) $this->error(L('Project_Err_2'),"",$this->r_time);
			if(!$model_id) $this->error(L('Project_Err_3'),"",$this->r_time);
			
			$_POST['num_min']=$_POST['num_min']?$_POST['num_min']:0;
			$_POST['num_max']=$_POST['num_max']?$_POST['num_max']:0;
			$_POST['page_interval']=$_POST['page_interval']?$_POST['page_interval']:0;
			$_POST['record_interval']=$_POST['record_interval']?$_POST['record_interval']:0;
			
				  $project = M('collector_project');
				  if($project->create())
				  {
					   if($insert=$project->add())  
					   {
						   $this->success(L('Project_Msg_1'),U('Collector/Project/project_set_list',array('id'=>$insert)),3);
					   }
					   else
					   {
						   $this->error(L('ADD').L('ERR'),'',$this->r_time);
					   }
				  }
				  else
				  {
					  $this->error(L('ADD').L('ERR'),'',$this->r_time);
				  }
		}
		else
		{
			$model=M('model')->select();
			$this->assign('model',$model);
			$this->display();
		}
	}
/*=================================================
**编辑项目
==================================================*/			
	public function project_edit(){
		$id=I('id');
		if(IS_POST)
		{
			$title=I('title');
			$url=I('url');
			$model_id=I('model_id');
			if(!$title) $this->error(L('Project_Err_1'),"",$this->r_time);
			if(!$url) $this->error(L('Project_Err_2'),"",$this->r_time);
			if(!$model_id) $this->error(L('Project_Err_3'),"",$this->r_time);
			
			$_POST['num_min']=$_POST['num_min']?$_POST['num_min']:0;
			$_POST['num_max']=$_POST['num_max']?$_POST['num_max']:0;
			$_POST['page_interval']=$_POST['page_interval']?$_POST['page_interval']:0;
			$_POST['record_interval']=$_POST['record_interval']?$_POST['record_interval']:0;
			
				  $project = M('collector_project');
				  if($project->create())
				  {
					   if($project->save()!==false)  
					   {
						   $this->success(L('Project_Msg_1'),U('Collector/Project/project_set_list',array('id'=>$id)),3);
					   }
					   else
					   {
						   $this->error(L('EDIT').L('ERR'),'',$this->r_time);
					   }
				  }
				  else
				  {
					  $this->error(L('EDIT').L('ERR'),'',$this->r_time);
				  }
		}
		else
		{
			$info=M('collector_project')->where('id='.$id)->find();
			if(!$info) $this->error(L('Project_Err_4'),U('Collector/Project/project_list'),$this->r_time);
			$model=M('model')->select();
			$this->assign('model',$model);
			$this->assign('info',$info);
			$this->display();
		}
		
	}
/*=================================================
**采集列表页设置
==================================================*/	
	public function project_set_list(){
		$id=I('id');
		if(IS_POST)
		{
			$select=array('url'=>'url','content'=>'content','unit'=>'unit','condition'=>'condition');
			$start=$_POST['start'];
			$end=$_POST['end'];
			$replace=$_POST['replace'];
			$filter=$_POST['filter'];
			$file_str="";
            foreach($select as $k=>$v)
			{
				 $file_str=$file_str.PHP_EOL."<!--start_".$k."-->".PHP_EOL;
				 $file_str=$file_str.addslashes($start[$k])."<!--*****-->";
				 $file_str=$file_str.addslashes($end[$k])."<!--*****-->";
				 $file_str=$file_str.addslashes($replace[$k])."<!--*****-->";
				 $file_str=$file_str.implode('|',$filter[$k])."<!--*****-->";
				 $file_str=$file_str.PHP_EOL."<!--end_".$k."-->";
				 $File=new \Org\Util\File();
				 $File->write($this->path,$id."_list_config.config",stripslashes($file_str));
				 $this->success(L('Project_Msg_1'),U('Collector/Project/project_set_content',array('id'=>$id)),$this->r_time);
				
		    }
		}
		else
		{
			
			$info=$info=M('collector_project')->where('id='.$id)->find();
			if(!$info) $this->error(L('Project_Err_4'),U('Collector/Project/project_list'),$this->r_time);
			$config=get_list_config($id);
			$this->assign('config',$config);	
			$this->assign('info',$info);
			$this->display();
		}
	}
/*=================================================
**采集内容页设置
==================================================*/	
	public function project_set_content(){
		$id=I('id');
		if(IS_POST)
		{
			
			$select=$_POST['select'];
			$start=$_POST['start'];
			$end=$_POST['end'];
			$replace=$_POST['replace'];
			$filter=$_POST['filter'];
			$file_str="<!--start_select_fields_system-->".PHP_EOL.implode('|',$select).PHP_EOL."<!--end_select_fields_system-->";
            foreach($select as $k=>$v)
			{
				 
				 $file_str=$file_str.PHP_EOL."<!--start_".$k."-->".PHP_EOL;
				 $file_str=$file_str.addslashes($start[$k])."<!--*****-->";
				 $file_str=$file_str.addslashes($end[$k])."<!--*****-->";
				 $file_str=$file_str.addslashes($replace[$k])."<!--*****-->";
				 $file_str=$file_str.implode('|',$filter[$k])."<!--*****-->";
				 $file_str=$file_str.PHP_EOL."<!--end_".$k."-->";
				 $File=new \Org\Util\File();
				 $File->write($this->path,$id."_config.config",stripslashes($file_str));
				 $this->success(L('SET').L('success'),U('Collector/Project/project_set_content',array('id'=>$id)),$this->r_time);
				
		    }
		}
		else
		{
			
			$info=$info=M('collector_project')->where('id='.$id)->find();
			if(!$info) $this->error(L('Project_Err_4'),U('Collector/Project/project_list'),$this->r_time);
		    $model=model_f($info['model_id'],'');
			$table=$model['table'];
			if(!$table)  $this->error(L('Project_Err_5'),U('Collector/Project/project_list'),$this->r_time);
			$config=get_configs($id);
			
			

			$fields=M('table_field')->field('id,title,field')->where(array('table'=>$table))->select();
			switch ($model['model_class'])
			{
			case "content":
			  $fields[]=array('field'=>'class_id','title'=>L('CLASS'));

			  break;  
			case 'form':
			  $fields[]=array('field'=>'addtime','title'=>L('ADD').L('time'));
			  $fields[]=array('field'=>'autho_id','title'=>L('AUTHOR'));
			  $fields[]=array('field'=>'autho_admin','title'=>L('Project_Collector_Autho_Admin'));
			  break;
			default:

			}
			
			$this->assign('config',$config);	
            $this->assign('fields',$fields);
			$this->assign('info',$info);
			$this->display();
		}
	}
/*=================================================
**项目删除
==================================================*/		
    public function  project_del(){  	
	          $id=I('id');
			  $del_num=0;//删除字段的条数

			  $form =D('collector_project');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
			 if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);		
			 
			 if(!is_array($id))	$id=array($id);	
			 $File=new \Org\Util\File();
			 foreach($id as $v)
			 {
				  M('collector_url')->where('collector_id='.$v)->delete(); 
				  $File->delete($this->path.$v."_config.config");
				  $File->delete($this->path.$v."_list_config.config");
				  
			 }			
			 $where['id']=array('in',$id);
			 $del_num=$form->where($where)->delete(); 
			 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Collector/Project/project_list"),$this->r_time);    
    }
	
/*=================================================
**采集列表
==================================================*/	
	public function collector_list_browse(){
		$id=I('id');
		if(IS_POST)
		{
			
			$select=$_POST['select'];
			$start=$_POST['start'];
			$end=$_POST['end'];
			$replace=$_POST['replace'];
			$filter=$_POST['filter'];
			$file_str="<!--start_select_fields_system-->".PHP_EOL.implode('|',$select).PHP_EOL."<!--end_select_fields_system-->";
            foreach($select as $k=>$v)
			{
				 
				 $file_str=$file_str.PHP_EOL."<!--start_".$k."-->".PHP_EOL;
				 $file_str=$file_str.addslashes($start[$k])."<!--*****-->";
				 $file_str=$file_str.addslashes($end[$k])."<!--*****-->";
				 $file_str=$file_str.addslashes($replace[$k])."<!--*****-->";
				 $file_str=$file_str.implode('|',$filter[$k])."<!--*****-->";
				 $file_str=$file_str.PHP_EOL."<!--end_".$k."-->";
				 $File=new \Org\Util\File();
				 $File->write($this->path,$id."_config.config",stripslashes($file_str));
				 $this->success(L('SET').L('success'),U('Collector/Project/project_set_content',array('id'=>$id)),$this->r_time);
				
		    }
		}
		else
		{
			
			$info=M('collector_project')->where('id='.$id)->find();
			if(!$info) $this->error(L('Project_Err_4'),U('Collector/Project/project_list'),$this->r_time);

            $page=I('page',$info['num_min'],'intval');
            $page_list=get_collector_page_urls($info);
	        $list=get_collector_list($info,$page_list[$page]);
			
			$page_show="<nav><ul class='pagination pagination-sm'>";
            foreach($page_list as $k=>$v)
			{
				if($k==$page)
				{
					$page_show=$page_show."<li class='active'><a href='#'>$k</a></li>";
				}
				else
				{
					$page_show=$page_show."<li class='num'><a href='".U('Collector/Project/collector_list_browse',array('id'=>$id,'page'=>$k))."'>$k</a></li>";
				}    
			}
			$page_show=$page_show."</ul></nav>";

			$this->assign('page_show',$page_show);// 赋值分页输出
			$this->assign('list',$list);
			$this->assign('info',$info);
			$this->display();
		}
	}
	
/*=================================================
**采集内容
==================================================*/	
	public function project_operate(){

            $is_page=false;
			
		    $urls=I('urls');
			
		    $id=I('id');

			$info=M('collector_project')->where('id='.$id)->find();
			if(!$info) $this->error(L('Project_Err_4'),U('Collector/Project/project_list'),$this->r_time);
			
			$File=new \Org\Util\File();
			
			if(!$urls)
			{	  
		         $file=$File->read($this->path."urls/".$id."_urls_config.config");
				 if($file)
				 {
					  $file_array=explode('<!--*****-->',$file); 
					  $page_list_url=explode(PHP_EOL,$file_array[0]);
					  $list_urls_array=explode(PHP_EOL,$file_array[1]);
					  
					  if(!$list_urls_array)
					  {
						  $list_urls_array=get_collector_list($info,reset($page_list_url));
						  array_shift($page_list_url);
						  $is_page=true;
					  }
				 }
				 else
				 {
					   $page_list_url=get_collector_page_urls($info);
					   $list_urls_array=get_collector_list($info,reset($page_list_url));

					   array_shift($page_list_url);			 
				 } 
				 
				 foreach($list_urls_array as $val )
				 {
					if(is_array($val))
					{
						if($val['url']) $list_urls[]=$val['url'];
					}
					else
					{
						if($val) $list_urls[]=$val;
					}
					
				 }
				 $urls=$list_urls;
			}
			 
			 $url=reset($urls);
			 array_shift($urls);
			 
			 if($page_list_url) $page_list_url_str=implode(PHP_EOL,$page_list_url);
			 
			 if($urls) $urls_str=implode(PHP_EOL,$urls);
		
			 
			 if($page_list_url || $urls)  
			 {
				 $file_str=$page_list_url_str."<!--*****-->".$urls_str;
				 $File->write($this->path."urls/",$id."_urls_config.config",$file_str);
			 }
			 else
			 {
				 $is_page=false;
				 $File->delete($this->path."urls/".$id."_urls_config.config");
			 }
			 
			 get_collector_content($url,$info);
			 
			 if(!$urls) 
			 {
				 $this->success(L('Project_Msg_4'),U('Collector/Project/project_list'),$this->r_time);
				 exit();
			 }
             
			 if(!$is_page)
			 {
				 $interval=$info['record_interval']?$info['record_interval']:0;
			 }
			 else
			 {
				 $record_interval=$info['record_interval']?$info['record_interval']:0;
				 $page_interval=$info['page_interval']?$info['page_interval']:0;
				 $interval=$interval+$interval_page;
			 }
			 
			 
			 redirect(U('Collector/Project/project_operate',array('id'=>$id)),$interval,L('Project_Msg_3',array('url'=>$url,'interval'=>$interval)));
	}
}
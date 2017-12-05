<?php
namespace Field\Controller;
use Org\Util\Admin;
class FieldController extends Admin {
   public $Field_c;
   function __construct()  //析构函数
   {  
        parent::__construct();
		
		$this->F=new \Org\Util\Field();
		//$form_type=array('text'=>'单行文本','textarea'=>'多行文本','editor'=>'编辑器','box'=>'选项','image'=>'图片','images'=>'多图片','datetime'=>'日期和时间','linkage'=>'联动菜单','downfiles'=>'多文件上传','map'=>'地图字段','omnipotent'=>'万能字段');
		
		$this->form_type=array('text'=>'单行文本','textarea'=>'多行文本','editor'=>'编辑器','box'=>'选项','image'=>'图片','images'=>'多图片','datetime'=>'日期和时间','linkage'=>'联动菜单');
   } 

   public function field_update_cache(){
        $modelid=I('modelid',0);
		if(!$modelid)
		{
		     $this->error(L('ADMIN_Field_Modelid_Err0'),"",$this->r_time);
		}
        field_set_config($modelid);
		$this->success(L('UPDATE').L('success'),U('Field/Field/field_list',array('modelid'=>$modelid)),$this->r_time);
   } 
    public function field_list(){
		field_set_model_field(57);
	    $pagesize=15;	
		$modelid=I('modelid',0,'intval');
		$page=I('page',1,'intval');
		if(!$modelid)
		{
		     $this->error(L('ADMIN_Field_Modelid_Err0'),"",$this->r_time);
		}
	    $model =M('model');
		$where['id']=$modelid;
		$model_info = $model->where($where)->find();//获取模型数据
		if(!$model_info)
		{
		     $this->error(L('ADMIN_Field_Modelid_Err1'),"",$this->r_time);
		}
		unset($where);
		field_set_model_field($model_info['table']);
		$where['table']=$model_info['table'];
		$field =M('table_field');
		$record_count=$field->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$field->where($where)->order('sort asc,id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	

		$this->assign('model_info',$model_info);
		$this->assign('info',$info);
		$this->assign('modelid',$modelid);
        $this->display();
    }
	
	
	    public function field_add(){
			$modelid=I('modelid',0,'intval');
			//对模型进行判断
			if(!$modelid)
			{
				 $this->error(L('ADMIN_Field_Modelid_Err1'),"",$this->r_time);
			}else
			{
				$model =M('model');
				$where['id']=$modelid;
				$model_info=$model->where($where)->find();
				if(!$model_info['table'])
				{
					 $this->error(L('ADMIN_Field_Modelid_Err2'),"",$this->r_time);
				}
			}

			if(IS_POST)
			{	
			       $table=I('post.table',"",'trim')?I('post.table',"",'trim'):$model_info['table'];
				   $field_name=I('post.field',"",'trim');
				   $title=I('post.title',"",'trim');
				   
				   if($_POST['show_tem'] && $_POST['edm_id'])
				   {
				         foreach($_POST['edm_id'] as $k=>$v)
						 {
						     if(trim($_POST['show_tem'][$k])!="" && trim($v)!="")
							 {
						         $show_tem[$v]=$_POST['show_tem'][$k];
							 }
						 }
				   }
				   
				   $_POST['show_tem']=$_POST['show_tem']?array2string($show_tem):"";
                   unset($_POST['edm_id']);
				   if(!$field_name)
				   {
				       $this->error(L('ADMIN_Field_Name').L('O_EMPTY'),"",$this->r_time);
				   }
				   
				   if(!$title)
				   {
				       $this->error(L('ADMIN_Field_Title').L('O_EMPTY'),"",$this->r_time);
				   }
				   
				   if(!$table)
				   {
				       $this->error(L('ADMIN_Field_Modelid_Err2'),"",$this->r_time);
				   }
						
				   $field =M('table_field');
				   $data['field']=$field_name;
		           $data['table']=$table;
                   $is_field_exist=$field->where($data)->find();
				   if($is_field_exist || $this->F->describe($field_name,$table))
				   {
					   $this->error(L('ADMIN_Field_Name').L('O_EXIST'),"",$this->r_time);
				   }
				   
				   
				   if($field->create())	
				   {
				            $field->is_user_show=$field->is_user_show?implode(",",I('post.is_user_show')):"";
							$field->is_user_edit=$field->is_user_edit?implode(",",I('post.is_user_edit')):"";
							$field->is_user_submit=$field->is_user_submit?implode(",",I('post.is_user_submit')):"";
							$field->is_admin_show=$field->is_admin_show?implode(",",I('post.is_admin_show')):"";
							$field->is_admin_edit=$field->is_admin_edit?implode(",",I('post.is_admin_edit')):"";
							$field->is_admin_submit=$field->is_admin_submit?implode(",",I('post.is_admin_submit')):"";
							$field->status=I('post.status',0,'intval');
							$field->tem_c=I('post.tem_c','','trim');
							$field->tem_mobile_c=I('post.tem_mobile_c','','trim');
							$field->table=$table;
							$field->setting=$field->setting?array2string(I('setting')):"";
							$field->show_tem=I('post.show_tem','','trim');
				        	if($field->add() && $this->F->create())
							   {
							        field_set_config($table);
							        $this->success(L('ADD').L('success'),U('Field/Field/field_list',array('modelid'=>$modelid)),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),U('Field/Field/field_add',array('modelid'=>$modelid)),$this->r_time);
							   }
				   }
				   else
				   {
				               $this->error(L('ADD').L('ERR'),U('Field/Field/field_add',array('modelid'=>$modelid)),$this->r_time);
				   }   
			}
			else
			{			

					load('Admin/function');	
					$this->assign('modelid',$modelid);
					$this->assign('table',$model_info['table']);
					$this->assign('group_list',$this->group_list_());
					$this->assign('role_list',$this->role_list_());
					$this->display();	
			}

    }
	
	    public function field_edit(){
			$modelid=I('modelid',0,'intval');
			$id=I('id',0,'intval');//字段id
			//对模型进行判断
			if(!$modelid)
			{
				 $this->error(L('ADMIN_Field_Modelid_Err1'),"",$this->r_time);
			}else
			{
				$model =M('model');
				$where['id']=$modelid;
				$model_info=$model->where($where)->find();
				if(!$model_info['table'])
				{
					 $this->error(L('ADMIN_Field_Modelid_Err2'),"",$this->r_time);
				}
			}

            if(!$id)
			{
			     $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			}
			if(IS_POST)
			{
			       $table=I('post.table',"",'trim')?I('post.table',"",'trim'):$model_info['table'];
				   $field_name=I('post.field',"",'trim');
				   $title=I('post.title',"",'trim');
				   
				   if($_POST['show_tem'] && $_POST['edm_id'])
				   {
				         foreach($_POST['edm_id'] as $k=>$v)
						 {
						     if(trim($_POST['show_tem'][$k])!="" && trim($v)!="")
							 {
						         $show_tem[$v]=$_POST['show_tem'][$k];
							 }
						 }
				   }
				   
				   $_POST['show_tem']=$_POST['show_tem']?array2string($show_tem):"";
                   unset($_POST['edm_id']);	
				   			   
				   if(!$field_name)
				   {
				       $this->error(L('ADMIN_Field_Name').L('O_EMPTY'),"",$this->r_time);
				   }
				   
				   if(!$title)
				   {
				       $this->error(L('ADMIN_Field_Title').L('O_EMPTY'),"",$this->r_time);
				   }
				   
				   if(!$table)
				   {
				       $this->error(L('ADMIN_Field_Modelid_Err2'),"",$this->r_time);
				   }
					
				   $field =M('table_field');
				   $data['id']=array('NEQ',$id);
				   $data['field']=$field_name;
		           $data['table']=$table;
                   $is_field_exist=$field->where($data)->find();
				   if($is_field_exist)
				   {
					   $this->error(L('ADMIN_Field_Name').L('O_EXIST'),"",$this->r_time);
				   }
				   if($field->create())	
				   {
				            $field->is_user_show=$field->is_user_show?implode(",",I('post.is_user_show')):"";
							$field->is_user_edit=$field->is_user_edit?implode(",",I('post.is_user_edit')):"";
							$field->is_user_submit=$field->is_user_submit?implode(",",I('post.is_user_submit')):"";
							$field->is_admin_show=$field->is_admin_show?implode(",",I('post.is_admin_show')):"";
							$field->is_admin_edit=$field->is_admin_edit?implode(",",I('post.is_admin_edit')):"";
							$field->is_admin_submit=$field->is_admin_submit?implode(",",I('post.is_admin_submit')):"";
							$field->status=I('post.status',0,'intval');
							$field->tem_c=I('post.tem_c','','trim');
							$field->tem_mobile_c=I('post.tem_mobile_c','','trim');
							$field->setting=$field->setting?array2string(I('setting')):"";
							$field->show_tem=I('post.show_tem','','trim');
							unset($field->table);
							unset($field->form_type);
							
				        	if($field->save()!==false && $this->F->edit())
							   {
							        field_set_config($table);
							        $this->success(L('EDIT').L('success'),U('Field/Field/field_list',array('modelid'=>$modelid)),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
				   }
				   else
				   {
				               $this->error(L('EDIT').L('ERR'),"",$this->r_time);
				   }   
			}
			else
			{			

					$field_table =M('table_field');
					$where['id']=$id;
					$where['table']=$model_info['table'];
					$field=$field_table->where($where)->find();
					if(!$field)
					{
						 $this->error(L('ADMIN_Field_Field_Err0'),"",$this->r_time);
					}
					load('Admin/function');	
					$this->assign('field',$field);
					$this->assign('modelid',$modelid);
					$this->assign('table',$model_info['table']);
					$this->assign('group_list',$this->group_list_());
					$this->assign('role_list',$this->role_list_());
					$this->display();	
			}

    }
/*
-----------------------------------  
   字段删除  
-----------------------------------   
*/	
    public function  field_del(){  	
	          $id=I('id');
			  $del_num=0;//删除字段的条数
			  $modelid=I('modelid',0,'intval');
			  $field=I('get.field');
			if($this->F->del($field,"",$modelid))
			{
			  $field =D('table_field');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }			
				 $where['id']=$id;
				 $del_num=$field->where($where)->delete(); 
				 field_set_config($modelid);
			     $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Field/Field/field_list",array('modelid'=>$modelid)),$this->r_time); 
			}
			else
			{
			     $this->success(L('DEL').L('ERR'),U("Field/Field/field_list",array('modelid'=>$modelid)),$this->r_time); 
			}    
    }	
/*
-----------------------------------  
   获取字段模板
-----------------------------------   
*/	
	public function field_template(){
	    $form_type=I('form_type');
		$id=I('id');
		
		$path=dirname(T())."/".$form_type;
		if (is_dir($path) == false || !$form_type) {
			  $this->display();
			  exit();
		}
		$file= scandir($path."/pc");
		$file=data_($file,array(0,1));	
		$file_mobile= scandir($path."/mobile");
		$file_mobile=data_($file_mobile,array(0,1));			
		
		if($id)	
		{
			$field =M('table_field');
			$data['id']=$id;
			$fields=$field->where($data)->find();
			$show_tem=$fields['show_tem']?string2array($fields['show_tem']):"";
			$this->assign('fields',$fields);
			$this->assign('id',$id);
	        $this->assign('show_tem',$show_tem);					
		}
	   $this->assign('file_mobile',$file_mobile);
	   $this->assign('file',$file);
	   $this->assign('form_type',$form_type);
       $this->display();
    }

/*
-----------------------------------  
   获取字段模板内容
-----------------------------------   
*/	
	public function field_template_c(){
	    $template_type=I('template_type');
		$mobile=I('mobile');
		$form_type=I('form_type');
		if($mobile)
		{
		   $path=dirname(T())."/".$form_type."/mobile/".$template_type;
		}
		else
		{
		   $path=dirname(T())."/".$form_type."/pc/".$template_type;
		}
        $this->display($path);
    }
	
	public function field_text(){
        $this->display();
    }	
		
	public function field_edit_text(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }

	public function field_textarea(){
        $this->display();
    }	

	public function field_edit_textarea(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	

	public function field_box(){
        $this->display();
    }	

	public function field_edit_box(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }	
	
	public function field_editor(){
        $this->display();
    }	

	public function field_edit_editor(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
		
	public function field_image(){
        $this->display();
    }	

	public function field_edit_image(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	
			
	public function field_images(){
        $this->display();
    }	

	public function field_edit_images(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	
	public function field_datetime(){
        $this->display();
    }	

	public function field_edit_datetime(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	
	public function field_linkage(){
        $this->display();
    }	

	public function field_edit_linkage(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	
	public function field_downfiles(){
        $this->display();
    }	

	public function field_edit_downfiles(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	
	public function field_map(){
        $this->display();
    }	

	public function field_edit_map(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	
	public function field_omnipotent(){
        $this->display();
    }	

	public function field_edit_omnipotent(){
	    $id=I('id');
	    $field =M('table_field');
	    $data['id']=$id;
	    $setting=$field->where($data)->getField('setting');
		$this->assign('setting',string2array($setting));
        $this->display();
    }
	public function group_list_(){
	     $group_list_=group_list_();
		 array_unshift($group_list_,array('id'=>-1,'name'=>L('ADMIN_Ban_User')));
		 return $group_list_;
    }
	public function role_list_(){
	     $role_list_=role_list_();
		 array_unshift($role_list_,array('id'=>-1,'name'=>L('ADMIN_Ban_Admin')));
		 return $role_list_;
    }	
}
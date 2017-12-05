<?php
namespace Field\Controller;
use Org\Util\Admin;
class FormController extends Admin {
   function __construct()  //析构函数
   {  
        parent::__construct();
		
		$this->form_type=array('text'=>'单行文本','textarea'=>'多行文本','editor'=>'编辑器','box'=>'选项','image'=>'图片','images'=>'多图片','datetime'=>'日期和时间');
		$this->path=COMMON_PATH."form_tem/";
   } 
    public function form_tem_list(){
	    $pagesize=15;	
		$modelid=I('modelid',0,'intval');
		$page=I('page',1,'intval');
		if(!$modelid) $this->error(L('ADMIN_Field_Modelid_Err0'),"",$this->r_time);
		$table = model_f($modelid,'table');//获取模型数据
		if(!$table) $this->error(L('ADMIN_Field_Modelid_Err1'),"",$this->r_time);
        
		$where['table']=$table;
		$form=M('form_tem');
		$record_count=$form->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$form->where($where)->order('id desc')->select();
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		  $this->assign('info',$info);
		}
		$this->assign('modelid',$modelid);	
        $this->display();
    }
	
	
	    public function form_tem_add(){
			$modelid=I('modelid',0,'intval');
			//对模型进行判断
			if(!$modelid)
			{
				 $this->error(L('ADMIN_Field_Modelid_Err1'),"",$this->r_time);
			}else
			{
				$table = model_f($modelid,'table');//获取模型数据
				if(!$table) $this->error(L('ADMIN_Field_Modelid_Err2'),"",$this->r_time);
			}

            
			if(IS_POST)
			{	
			        $post=$_POST;
                    $type=$post['type'];
					$fields=$post['field'];
					$name=I('name');
					if(!I('name')) $this->error(L('ADMIN_Form_Name_Err_1'),"",$this->r_time);
					
					$g="";//全局
					$f="";//字段
					foreach($type as $k=>$v)
					{
						if($v)
						{
							$v=addslashes($v);
							$g=$g.PHP_EOL."<!--globals_".$k."-->".PHP_EOL.$v.PHP_EOL."<!--globals_".$k."_end-->".PHP_EOL;
						}
					}
					
					foreach($fields as $k=>$v)
					{
						if($v)
						{
							$v=addslashes($v);
							$f=$f.PHP_EOL." <!--field_".$k."-->".PHP_EOL.$v.PHP_EOL." <!--field_".$k."_end-->".PHP_EOL;
						}						
					}
					$File=new \Org\Util\File();
					$File->write($this->path,$name.".tpl",stripslashes($g.$f));
					$data=array('name'=>$name,'table'=>$table,'describe'=>I('describe'));
					$insertid=M('form_tem')->data($data)->add();
					if($insertid)
					{
						$this->success(L('ADD').L('success'),U('Field/Form/form_tem_edit',array('id'=>$insertid,'modelid'=>$modelid)),$this->r_time);
					}
					else
					{
						$this->error(L('ADD').L('ERR'),'',$this->r_time);
					}
					
					
			}
			else
			{	
			        $fields=FF("field/field_".$table);	
					$form_type=$this->form_type;
					$this->assign('modelid',$modelid);
					$this->assign('table',$table);
					$this->assign('form_type',$form_type);
					$this->assign('fields',$fields);
					$this->display();	
			}

    }
	
	    public function form_tem_edit(){
			$modelid=I('modelid',0,'intval');
			$id=I('id',0,'intval');//字段id
			//对模型进行判断
			if(!$modelid)
			{
				 $this->error(L('ADMIN_Field_Modelid_Err1'),"",$this->r_time);
			}else
			{
				$table = model_f($modelid,'table');//获取模型数据
				if(!$table) $this->error(L('ADMIN_Field_Modelid_Err2'),"",$this->r_time);
			}

            if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			$form =M('form_tem');
			$where['id']=$id;
			$tpl=$form->where($where)->find();
			if(!$tpl) $this->error(L('ADMIN_Form_Err_0'),"",$this->r_time);
			
			if(IS_POST)
			{
			        $post=$_POST;
                    $type=$post['type'];
					$fields=$post['field'];
					$name=$tpl['name'];
					
					
					$g="";//全局
					$f="";//字段
					foreach($type as $k=>$v)
					{
						if($v)
						{
							$v=addslashes($v);
							$g=$g.PHP_EOL."<!--globals_".$k."-->".PHP_EOL.$v.PHP_EOL."<!--globals_".$k."_end-->".PHP_EOL;
						}
					}
					
					foreach($fields as $k=>$v)
					{
						if($v)
						{
							$v=addslashes($v);
							$f=$f.PHP_EOL." <!--field_".$k."-->".PHP_EOL.$v.PHP_EOL."<!--field_".$k."_end-->".PHP_EOL;
						}						
					}
					$File=new \Org\Util\File();
					$File->write($this->path,$name.".tpl",stripslashes($g.$f));
					$data=array('id'=>$id,'table'=>$table,'describe'=>I('describe')); 
					if($form->save($data)!==false)
					{
						$this->success(L('EDIT').L('success'),U('Field/Form/form_tem_edit',array('id'=>$id,'modelid'=>$modelid)),$this->r_time);
					}
					else
					{
						$this->error(L('EDIT').L('ERR'),'',$this->r_time);
					}            
			}
			else
			{	
			        $form_type=$this->form_type;
					$tem=get_tems($tpl['name'],$form_type,$table);
					
					$fields=FF("field/field_".$table);	
					$this->assign('fields',$fields);
					
					$this->assign('tpl',$tpl);
					$this->assign('tem',$tem);
					$this->assign('modelid',$modelid);
					$this->display();	
			}
    }
/*
-----------------------------------  
   方案删除  
-----------------------------------   
*/	
    public function  form_tem_del(){  	
	          $id=I('id');
			  $del_num=0;//删除字段的条数
			  $modelid=I('modelid',0,'intval');

			  $form =D('form_tem');			  
       	     //------------------------------------验证数据正确性----------------------------------------			  
			 if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);		
			 
			 if(!is_array($id))	$id=array($id);	
			 $File=new \Org\Util\File();
			 foreach($id as $v)
			 {
				  $where['id']=$v;
				  $name=$form->where($where)->getField('name');
				  $File->delete($this->path.$name.".tpl");
			 }			
			 $where['id']=array('in',$id);
			 $del_num=$form->where($where)->delete(); 
			 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Field/Form/form_tem_list",array('modelid'=>$modelid)),$this->r_time);    
    }
}
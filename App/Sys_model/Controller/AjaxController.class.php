<?php
namespace Sys_model\Controller;
use Org\Util\Admin;

class AjaxController extends Admin {

/*
-----------------------------------   
   通过AJAX修改	   
-----------------------------------   
*/	
    public function model_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $model =D('model');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的----------------------------------------   
						if ($model->create($data)){
							   if($model->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $menu->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的菜单完--------------------------------------    
    }

     public function is_table_exist(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $model =D('model');
			  $get=I('get.');			  
              $data=data_($get);
			 // dump($data);
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['sign'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('MODEL_Sign').L('O_EMPTY');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------
             $is_table_exist=false;
			 if($data['id'])
			 {
			     $data['id']=array('NEQ',$data['id']);
			 }
			 else
			 {
				 $table=new \Org\Util\Field();
				 $is_table_exist=$table->is_table_exist($data['sign']);		 
			 }
			 $is_table_exist=$is_table_exist?$is_table_exist:$model->where($data)->find();
			   if($is_table_exist)
			   {
						 $return['err']  = 0;
						 $return['content'] = 1;	 
						 $this->ajaxReturn($return);				   
			   }
			   else
			   {
						 $return['err']  = 0;
						 $return['content'] = 0;	 
						 $this->ajaxReturn($return);			   
			   }   
    }
	
    public function class_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $sys_model_class =D('sys_model_class');
			  $get=I('get.');			  
			  foreach($get as $k => $v)
			  {
			      	 $data[$k]=$v;
			  }
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['id'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ERR_PARAM_ID');	 
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			  //------------------------------------编辑提交的----------------------------------------   
						if ($sys_model_class->create($data))
						{
							   if($sys_model_class->save()!==false)
							   {
							        
										 $return['err']  = 0;
										 $return['content'] = L('EDIT').L('SUCCESS');	 
										 $this->ajaxReturn($return);
							   }
							   else
							   {
										 $return['err']  = 1;
										 $return['content'] = L('EDIT').L('ERR');	 
										 $this->ajaxReturn($return);
							   }
						}
						else
						{
										 $return['err']  = 1;
										 $return['content'] = $menu->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的菜单完--------------------------------------    
    }
	
}

?>
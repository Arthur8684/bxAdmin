<?php
namespace Form\Controller;
use Org\Util\Admin;

class AjaxController extends Admin {

     public function is_table_exist(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $model =D('model');
			  $get=I('get.');			  
              $data=data_($get);
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['table'])
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
				 $is_table_exist=$table->is_table_exist($data['table']);		 
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
	
}

?>
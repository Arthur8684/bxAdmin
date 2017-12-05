<?php
namespace Field\Controller;
use Think\Controller;

class AjaxController extends Controller {

/*
-----------------------------------   
   字段是否存在
-----------------------------------   
*/	
    public function field_exist_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $field =M('table_field');
			  $get=I('get.');			  
              $data=data_($get);
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['field'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ADMIN_Field_Ajax_Empty_Info_P');	
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			 
			   if($data['id']) $data['id']=array('NEQ',$data['id']);
               $is_field_exist=$field->where($data)->find(); 
			   if($is_field_exist)
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


    public function field_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $field =M('table_field');
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
			  //------------------------------------编辑提交的数据----------------------------------------   
						if ($field->create($data)){
							   if($field->save()!==false)
							   {
							             $table=$field->where('id='.$data['id'])->getField('table');
										 if($table) field_set_config($table);
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
										 $return['content'] = $field->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    }




    public function field_exist_(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $get=I('get.');
			  $data=array();	
			  $data[$get['clientid']]=$get[$get['clientid']];
			  $data[table]=$get['table'];		  
			  if($data[table])
			  {
			      $field =M($data[table]);
			  }
			  else
			  {
			      $return['err']  = 1;
                  $return['content'] = L('ADMIN_Field_Ajax_Empty_Info_P');	 
				  $this->ajaxReturn($return);	
			  }
			  if($get['id_name'] && intval($get['id_value']))
			  { 
			       $data[$get['id_name']]=array('NEQ',$get['id_value']);
			  }
              $is_field_exist=$field->where($data)->count(); 
			  //------------------------------------编辑提交的数据----------------------------------------   
			 if($is_field_exist>0)
			 {
				 $return['err']  = 0;
				 $return['content'] = 1;	 
				 $this->ajaxReturn($return);	
			 }		
			 else
			{	 $return['err']  = 0;
				 $return['content'] = 0;	 
				 $this->ajaxReturn($return);					
				 
			}	   

    }	
	/*
-----------------------------------   
   表单模板标识是否存在
-----------------------------------   
*/	
    public function form_sign_exist_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $form =M('form_tem');
			  $get=I('get.');			  
              $data=data_($get);
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$data['name'])
				 {			
				         $return['err']  = 1;
                         $return['content'] = L('ADMIN_Form_Name_Err_1');	
					     $this->ajaxReturn($return);				 
				 }
			 //------------------------------------验证数据正确性完----------------------------------------	
			 
			   if($data['id']) $data['id']=array('NEQ',$data['id']);
               $is_field_exist=$form->where($data)->find(); 
			   if($is_field_exist)
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
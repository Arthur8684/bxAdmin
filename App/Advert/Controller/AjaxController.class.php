<?php
namespace Advert\Controller;
use Think\Controller;

class AjaxController extends Controller {
	
    public function advert_ajax(){  
	          C('TOKEN_ON',false); //关闭表单令牌
			  $advert =M('advert_type');
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
						if ($advert->create($data)){
							   if($advert->save()!==false)
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
										 $return['content'] = $field->getError();	 
										 $this->ajaxReturn($return);														       
						}			  
			      //------------------------编辑提交的数据完--------------------------------------    
    }

}

?>
<?php
namespace Form\Controller;
use Org\Util\base;
class SubmitController extends base {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  

/*
-----------------------------------  
   FORM表单
-----------------------------------   
*/
    public function  submit(){
			  $modelid=I('modelid',0,'intval');	
			  $user=get_user();	  
	          if(IS_POST)
			  {		
					  $table=model_f($modelid);	
					  $m=M($table);
			  //------------------------------------表单提交----------------------------------------   
						if ($m->create()){
							   fields($modelid);
							   $m->autho_id=$user['id']?$user['id']:0;
							   $m->autho_admin=$user['admin']?$user['admin']:0;
							   $m->addtime=time();
							   if($m->add())
							   {
									$this->success(L('ADD').L('success'),'',$this->r_time);
							   }
							   else
							   {
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($m->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		  
			         $this->assign('modelid',$modelid);
			         $this->display();			  
			  }   
    }
		
}
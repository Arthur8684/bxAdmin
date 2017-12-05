<?php
namespace Sys_model\Controller;
use Org\Util\Admin;
class VerifyController extends Admin {

    public function verify(){ 
	
		$id=I('id',0,'intval');
		$modelid=I('modelid',0,'intval');
	    if(!$modelid || !$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		$url=$_SERVER['HTTP_REFERER'];
		
		$data['id']=$modelid;
		$table =M('model')->where($data)->getField('table');
		$verify=verify($modelid,$id);
		$update=M($table)->where(array('id'=>$id))->setField('verify',$verify);

		if($update)
		{
		    $this->success(L('YES_VERIFY').L('success'),$url,$this->r_time);	
		}else
		{
		    $this->error(L('YES_VERIFY').L('ERR'),$url,$this->r_time);
		}
    }	

}
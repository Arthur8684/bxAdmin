<?php
namespace System\Controller;
use Think\Controller;
class VerifyController extends Controller{
    public function index(){
        if(!C('code_open')) return true;
		$id=I('id');
		if(C('useen_0')) $conf['codeSet']=$conf['codeSet']."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		if(C('useen_1')) $conf['codeSet']=$conf['codeSet']."abcdefghijklmnopqrstuvwxyz";
		if(C('useen_2')) $conf['codeSet']=$conf['codeSet']."0123456789";
		$conf['expire']=C('expire');
		$conf['fontSize']=C('fontSize');
		$conf['imageW']=C('imageW');
		$conf['imageH']=C('imageH');
		$conf['length']=C('length');
		$conf['useImgBg']=C('useImgBg')?true:false;
		$conf['useCurve']=C('useCurve')?true:false;
		$conf['useNoise']=C('useNoise')?true:false;
		$conf['useZh']=C('useZh')?true:false;
		$Verify = new \Think\Verify($conf);
        $Verify->entry($id);
    }	
	
}
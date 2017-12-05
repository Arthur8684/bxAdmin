<?php
namespace System\Controller;
use Think\Controller;
class QrcodeController extends Controller{
    public function qrcode(){
		   $url=url_replace(urldecode($_GET['url']),0);
		   $qrcode=url_replace(urldecode($_GET['qrcode']),0);
		   $logo=url_replace(urldecode($_GET['logo']),0);
		   $errorCorrectionLevel=I('errorCorrectionLevel')?I('errorCorrectionLevel'):'L';
		   $matrixPointSize=I('matrixPointSize')?I('matrixPointSize'):4;
		   $margin=I('margin')?I('margin'):1;
		   $back_color=I('back_color')?I('back_color'):0xFFFFFF;
		   $fore_color=I('fore_color')?I('fore_color'):0x000000;
           qrcode_($url,$qrcode,$logo,$errorCorrectionLevel,$matrixPointSize,$margin,$back_color,$fore_color);
    }	
	
}
<?php
/*
-----------------------------------  
手机验证码
* @param        mobile_num 手机号码    
* @return       bool  1表示验证成功 
-----------------------------------   
*/	
function mobile_code($mobile_num)
{ 
	  $message_inter=C('message_inter')?C('message_inter'):0;
	  $sms_code_len=C('sms_code_len')?C('sms_code_len'):4;
	  $sms_appkey=C('sms_appkey')?C('sms_appkey'):0;
	  $sms_appsecret=C('sms_appsecret')?C('sms_appsecret'):0;
	  $sms_template_code=C('sms_template_code')?C('sms_template_code'):"";
	  $sms_sign_name=C('sms_sign_name')?C('sms_sign_name'):"";
	  if(!($message_inter || $sms_appkey || $sms_appsecret)) return 0; //没配置
	  $string=new \Org\Util\String;
	  $code=$string->randString($sms_code_len,1);
	  $TopClient = new \Org\Util\Alidayu\TopClient;
	  $TopClient->appkey =$sms_appkey;
	  $TopClient->secretKey =$sms_appsecret;
	  $req = new \Org\Util\Alidayu\AlibabaAliqinFcSmsNumSendRequest;
	  //$req->setExtend("123456");
	  $req->setSmsType("normal");
	  $req->setSmsFreeSignName($sms_sign_name);
	  $req->setSmsParam('{"code":"'.$code.'"}');
	  $req->setRecNum($mobile_num);
	  $req->setSmsTemplateCode($sms_template_code);
	  $resp = $TopClient->execute($req);
	 // echo $resp->result->err_code.$resp->result->success;
	  if($resp->result->err_code==0 && $resp->result->success==true) 
	  {
		  S('mobile_'.$mobile_num,$code,120);
		  return 1;
	  }
	  else
	  {
		  return 0;
	  }
	  
}

/*
-----------------------------------  
生成二维码图片
* @param        data 二维码生成数据    
* @param        qrcode 为false表示不生成文件，生成二维码路径
* @param        logo 生成二维码的loge路径
* @param        errorCorrectionLevel 容错能力 L(QR_ECLEVEL_L，7%)、M(QR_ECLEVEL_M，15%)、Q(QR_ECLEVEL_Q，25%)、H(QR_ECLEVEL_H，30%)；
* @param        matrixPointSize 生成图片大小
* @param        margin 二维码的空白区域大小
* @param        back_color 背景颜色
* @param        fore_color 绘制二维码的颜色     
-----------------------------------   
*/	
function qrcode_($data,$qrcode=false,$logo=false,$errorCorrectionLevel='L',$matrixPointSize = 4,$margin=1,$back_color=0xFFFFFF,$fore_color = 0x000000)
{ 
	  Vendor('QRcode.QRcode'); 
	  //生成二维码图片  
	  $qrcode=$qrcode?$qrcode:($logo?"upload/temp/qrcode.png":false);
	  QRcode::png($data, $qrcode, $errorCorrectionLevel, $matrixPointSize, $margin,false,$back_color,$fore_color);   
	  if ($logo) {  
		$QR = imagecreatefromstring(file_get_contents($qrcode));  
		$logo = imagecreatefromstring(file_get_contents($logo));  
		$QR_width = imagesx($QR);//二维码图片宽度  
		$QR_height = imagesy($QR);//二维码图片高度  
		$logo_width = imagesx($logo);//logo图片宽度  
		$logo_height = imagesy($logo);//logo图片高度  
		$logo_qr_width = $QR_width / 5;  
		$scale = $logo_width/$logo_qr_width;  
		$logo_qr_height = $logo_height/$scale;  
		$from_width = ($QR_width - $logo_qr_width) / 2;  
		//重新组合图片并调整大小  
		imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
	  }  
	  Header("Content-type: image/png");
      ImagePng($QR);
}

/*
-----------------------------------  
导出exc xls 2005
* @param        title exc标题 格式 array('id'=>'下单ID','older_user'=>'下单人'); 
* @param        data 添加的数据   格式 array(0=>array('id'=>1,'older_user'=>'王五'),1=>array('id'=>2,'older_user'=>'赵六'))
* @param        filename 保存文件名称
-----------------------------------   
*/	
function export_xls($title,$data,$filename='')
{ 
	  Vendor('PHPExcel.PHPExcel'); 
	  $filename=$filename?$filename:date('Y_m_d_H_i_s');
	  $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
	  $objPHPExcel = new PHPExcel();  
	  //设置行高度  
      $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
      $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
	  // Set properties  
	  $objPHPExcel->getProperties()->setCreator("ctos")  
		  ->setLastModifiedBy("ctos")  
		  ->setTitle("Office 2007 XLSX Test Document")  
		  ->setSubject("Office 2007 XLSX Test Document")  
		  ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
		  ->setKeywords("office 2007 openxml php")  
		  ->setCategory("Test result file");  
	
	 //设置标题
	 $title_obj=$objPHPExcel->setActiveSheetIndex(0);
	 $i=0;
	 foreach($title as $a=>$b)
	 {
		  $title_obj=$title_obj->setCellValue($cellName[$i]."1",$b) ;
		  $i++;
	 }	  
	 $data_obj=$objPHPExcel->getActiveSheet(0);
	 foreach($data as $k=>$v)
	 {
		     $i=0;
		  	 foreach($title as $key=>$val)
			 {
				  $data_obj=$data_obj->setCellValue($cellName[$i].($k+2), $v[$key]);  
				  $i++;
			 }
	 }
	 $objPHPExcel->setActiveSheetIndex(0); 
	  // excel头参数  
	  header('Content-Type: application/vnd.ms-excel');  
	  header('Content-Disposition: attachment;filename="'.$filename.'_2005.xls"');  //日期为文件名后缀  
	  header('Cache-Control: max-age=0');  
  
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式  
	  $objWriter->save('php://output');  
}
/*
-----------------------------------  
导出exc xlsx 2007版本
* @param        title exc标题 格式 array('id'=>'下单ID','older_user'=>'下单人'); 
* @param        data 添加的数据   格式 array(0=>array('id'=>1,'older_user'=>'王五'),1=>array('id'=>2,'older_user'=>'赵六'))
* @param        filename 保存文件名称
-----------------------------------   
*/	
function export_xlsx($title,$data,$filename='')
{ 
	  Vendor('PHPExcel.PHPExcel'); 
	  $filename=$filename?$filename:date('Y_m_d_H_i_s');
	  $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
	  $objPHPExcel = new PHPExcel();  
	  //设置行高度  
      $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
      $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
	  // Set properties  
	  $objPHPExcel->getProperties()->setCreator("ctos")  
		  ->setLastModifiedBy("ctos")  
		  ->setTitle("Office 2007 XLSX Test Document")  
		  ->setSubject("Office 2007 XLSX Test Document")  
		  ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
		  ->setKeywords("office 2007 openxml php")  
		  ->setCategory("Test result file");  
	
	 //设置标题
	 $title_obj=$objPHPExcel->setActiveSheetIndex(0);
	 $i=0;
	 foreach($title as $a=>$b)
	 {
		  $title_obj=$title_obj->setCellValue($cellName[$i]."1",$b) ;
		  $i++;
	 }	  
	 $data_obj=$objPHPExcel->getActiveSheet(0);
	 foreach($data as $k=>$v)
	 {
		     $i=0;
		  	 foreach($title as $key=>$val)
			 {
				  $data_obj=$data_obj->setCellValue($cellName[$i].($k+2), $v[$key]);  
				  $i++;
			 }
	 }
	 $objPHPExcel->setActiveSheetIndex(0); 
	  // excel头参数 Redirect output to a client's web browser (Excel2007)
	  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	  header('Content-Disposition: attachment;filename="'.$filename.'_2007.xlsx"');
	  header('Cache-Control: max-age=0');
	  // If you're serving to IE 9, then the following may be needed
	  header('Cache-Control: max-age=1');
	  
	  // If you're serving to IE over SSL, then the following may be needed
	  header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	  header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	  header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	  header ('Pragma: public'); // HTTP/1.0
	  
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save('php://output'); 
}

/*
-----------------------------------  
导出pdf
* @param        title exc标题 格式 array('id'=>'下单ID','older_user'=>'下单人'); 
* @param        data 添加的数据   格式 array(0=>array('id'=>1,'older_user'=>'王五'),1=>array('id'=>2,'older_user'=>'赵六'))
* @param        filename 保存文件名称
-----------------------------------   
*/	
function export_pdf($title,$data,$filename='')
{ 
	  Vendor('PHPExcel.PHPExcel'); 
	  
	  $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
	  //$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
	  //$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
	  $rendererLibrary = 'TCPDF';
	  //$rendererLibrary = 'MPDF57';
	  //$rendererLibrary = 'DOMPDF6';
	  $rendererLibraryPath = PHPEXCEL_ROOT . 'PHPExcel/PDF/'.$rendererLibrary;
	  $filename=$filename?$filename:date('Y_m_d_H_i_s');
	  $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
	  $objPHPExcel = new PHPExcel();  
	  //设置行高度  
      $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);  
      $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
	  // Set properties  
	  $objPHPExcel->getProperties()->setCreator("ctos")  
		  ->setLastModifiedBy("ctos")  
		  ->setTitle("Office 2007 XLSX Test Document")  
		  ->setSubject("Office 2007 XLSX Test Document")  
		  ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
		  ->setKeywords("office 2007 openxml php")  
		  ->setCategory("Test result file");  
	
	 //设置标题
	 $title_obj=$objPHPExcel->setActiveSheetIndex(0);
	 $i=0;
	 foreach($title as $a=>$b)
	 {
		  $title_obj=$title_obj->setCellValue($cellName[$i]."1",$b) ;
		  $i++;
	 }	  
	 $data_obj=$objPHPExcel->getActiveSheet(0);
	 foreach($data as $k=>$v)
	 {
		     $i=0;
		  	 foreach($title as $key=>$val)
			 {
				  $data_obj=$data_obj->setCellValue($cellName[$i].($k+2), $v[$key]);  
				  $i++;
			 }
	 }
	 $objPHPExcel->setActiveSheetIndex(0); 
	 $objPHPExcel->getActiveSheet()->setShowGridLines(false); //是否加边框 true 加边框 false 不加
	  if (!PHPExcel_Settings::setPdfRenderer(
			  $rendererName,
			  $rendererLibraryPath
		  )) {
		  die(
			  'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
			  '<br />' .
			  'at the top of this script as appropriate for your directory structure'
		  );
	  }
	  	  
	  // Redirect output to a client's web browser (PDF)
	  header('Content-type:text/html;charset=utf-8');  
	  header('Content-Type: application/pdf');
	  header('Content-Disposition: attachment;filename="'.$filename.'.pdf"');
	  header('Cache-Control: max-age=0');
	  
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
	  $objWriter->save('php://output');
}

/*
-----------------------------------  
导出csv
* @param        title exc标题 格式 array('id'=>'下单ID','older_user'=>'下单人'); 
* @param        data 添加的数据   格式 array(0=>array('id'=>1,'older_user'=>'王五'),1=>array('id'=>2,'older_user'=>'赵六'))
* @param        filename 保存文件名称
-----------------------------------   
*/	
function export_csv($title,$data,$filename='')
{ 
	  Vendor('PHPExcel.PHPExcel'); 
      $filename=$filename?$filename:date('Y_m_d_H_i_s');
	
	 //设置标题
	 $data_obj=$title?implode(',',$title)."\r\n":"";	 
     foreach($data as $k=>$v)
	 {
		 $data_obj=$data_obj.implode(',',$v)."\r\n";
	 }
	  // Redirect output to a client's web browser (PDF)
	  header("Content-type:text/csv;");
	  header('Content-Disposition: attachment;filename="'.$filename.'.csv"');
	  header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
      header('Expires:0');
      header('Pragma:public');
	  
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setDelimiter(',' )  //设置分隔符  
                                                                  ->setEnclosure('"' )    //设置包围符  
                                                                  ->setLineEnding("\r\n" )//设置行分隔符  
                                                                  ->setSheetIndex(0)
																  ->save('php://output');    //设置活动表  
                                                              
}

/*
-----------------------------------  
php发送post请求
* @param        url url链接
* @param        param 参数为数组
-----------------------------------   
*/	
function post($url, $param=array()){
	      foreach($param as $k=>$v)
		  {
			  $form_str=$form_str."<textarea name='".$k."'>".$v."</textarea>";
		  }
		  echo "<form style='display:none;' id='form1' name='form1' method='post' action='".$url."'>".$form_str."</form><script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";

 }
 
/*
-----------------------------------  
选择小图标
* @param        input_id 回执的容器id
* @param        button_name 按钮显示内容
-----------------------------------   
*/
	 
function select_icon($input_id,$button)
{
	if(!$input_id) return '';
	$html="<input type=\"button\" class=\"".$button['style']."\"  onclick=\"show_icon({id:'".$input_id."',root_path:'".C('root_path')."'})\"  value='".$button['name']."'/>";
	$html.="&nbsp;&nbsp;<span id=\"show_icon\" style=\"font-size:".$button['show_icon_size']."\"></span>";
	$css_js=C('TMPL_PARSE_STRING');
	$html.="<script src=\"".$css_js['__STATIC__']."/js/select_icon.js\"></script><LINK href=\"".$css_js['__STATIC__']."/css/public/font-awesome.min.css\" rel=\"stylesheet\"> ";
	$html.="<script>
				if($('#".$input_id."').val()!='')
				{
					$('#show_icon').html(\"<i class='\"+$('#".$input_id."').val()+\"'></i>\");
				}	
			</script>";
	return $html;
}

?>

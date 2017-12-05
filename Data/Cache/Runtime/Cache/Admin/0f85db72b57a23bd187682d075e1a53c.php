<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<META content="IE=9.0000" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet"> 
<LINK href="/cowcms/Public/css_js_font_img/css/admin.css" rel="stylesheet"> 
<LINK href="/cowcms/Public/css_js_font_img/css/switch.min.css" rel="stylesheet"> 
<SCRIPT src="/cowcms/Public/css_js_font_img/js/jquery.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/bootstrap.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/switch.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/diy.js" type="text/javascript"></SCRIPT>
<script type='text/javascript'  src='/cowcms/Public/css_js_font_img/js/upload.js'></script>	
<title><?php echo L('ADMIN_Manage_TITLE');?>-<?php echo L('ADMIN_Menu_OPERATE');?></title>
</head>
<body>
<div class="container-fluid" >
  <div class="padding_5"></div>
<form action="" method="post" id="form1" enctype='multipart/form-data'>
<!--内容开始--> 	
	   <ul class="nav nav-tabs">
		  <li role="presentation" class="active url_title" onClick="url(0)" id="url_title0"><a href="#0"><?php echo L('ADMIN_Setting');?></a></li>
		  <li role="presentation" class="url_title" onClick="url(2)" id="url_title2"><a href="#2"><?php echo L('ADMIN_Money_Setting');?></a></li>
		  <li role="presentation" class="url_title" onClick="url(3)" id="url_title3"><a href="#3"><?php echo L('ADMIN_Setting_Upload');?></a></li>
          <li role="presentation" class="url_title" onClick="url(4)" id="url_title4"><a href="#4"><?php echo L('CODE'); echo L('SET');?></a></li>
		  <li role="presentation" class="url_title" onClick="url(5)" id="url_title5"><a href="#5"><?php echo L('ADMIN_Mobile_Code'); echo L('SET');?></a></li>
		  <li role="presentation" class="url_title" onClick="url(1)" id="url_title1"><a href="#1"><?php echo L('ADMIN_Setting_Other');?></a></li>
       </ul>
		

		<div class="line_3 bg_white padding_10"> <!--变换白色区域-->
		   <!--<div class="bottom_line_10 padding_5"></div>-->
					   <div class="row">
					            <!--基本设置-->
								<DIV class="col-md-12 url" id="url0" style="display:">
								     <div class="row padding_7">  
											<div class="col-md-1 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Site_Name');?>
											</div>
											<div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title='' data-content="">
												  <input name="site_name" type="text" class="form-control" id="site_name" value="<?php echo ($c[site_name]); ?>" placeholder=""   >
											</div>
							         </div> 

								     <div class="row padding_7">  
											<div class="col-md-1 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Site_Title');?>
											</div>
											<div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content="">
												 <input name="site_title" type="text" class="form-control" id="site_title" value="<?php echo ($c[site_title]); ?>" placeholder=""   >
											</div>
							        </div> 
                                    								  
								     <div class="row padding_7">  
											<div class="col-md-1 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Site_Logo');?>
											</div>
											<div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content="">
												 <input name="site_logo" type="text" class="form-control" id="site_logo" value="<?php echo ($c[site_logo]); ?>" placeholder=""   >
											</div>
                                            <div class="col-md-1">
												<button type="button" class="btn btn-success" onclick="selectFile({name:'site_logo',water:'0',type:'',method:'0',size:'1000'})"><?php echo L('UPLOAD');?></button>
											</div>
							        </div> 
								     <div class="row padding_7">  
											<div class="col-md-1 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Site_Url');?>
											</div>
											<div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content='<?php echo L('ADMIN_Site_Url_Info');?>'>
												 <input name="site_url" type="text" class="form-control" id="site_url"  value="<?php echo ($c[site_url]); ?>" placeholder=""   >
											</div>
											<div class="col-md-7 padding_7  font_color_4"><?php echo L('ADMIN_Site_Url_Info');?></div>
							        </div>									  
									  
                                   <div class="row padding_7">  
                                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                                            <?php echo L('ADMIN_Site_Rootpath');?>
                                        </div>
                                        <div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content='<?php echo L('ADMIN_Site_Rootpath_Info');?>'>
                                             <input name="root_path" type="text" class="form-control" id="root_path"  value="<?php echo ($c[root_path]); ?>" placeholder=""   >
                                        </div>
                                        <div class="col-md-7 padding_7 font_color_4"><?php echo L('ADMIN_Site_Rootpath_Info');?></div>
                                   </div>
                                   
                                   <div class="row padding_7">  
                                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                                            <?php echo L('ADMIN_Site_Keyword');?>
                                        </div>
                                        <div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content='<?php echo L('ADMIN_Site_Rootpath_Info');?>'>
                                             <input name="keyword" type="text" class="form-control" id="keyword"  value="<?php echo ($c[keyword]); ?>" placeholder=""   >
                                        </div>
                                        <div class="col-md-7 padding_7 font_color_4"><?php echo L('ADMIN_Site_Keyword_P');?></div>
                                   </div>                                   
                                   	
                                   <div class="row padding_7">  
                                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                                            <?php echo L('ADMIN_Site_Describe');?>
                                        </div>
                                        <div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content='<?php echo L('ADMIN_Site_Rootpath_Info');?>'>
                                             <textarea name="describe" class="form-control"><?php echo ($c['describe']); ?></textarea>
                                             
                                        </div>
                                        <div class="col-md-7 padding_7 font_color_4"><?php echo L('ADMIN_Site_Describe_P');?></div>
                                   </div>									  
									  		 				
						   </DIV>
							  
					            <!--货币设置-->
								<DIV class="col-md-12 url" id="url2" style="display:none">
                                    <?php if(is_array($c[point_type])): foreach($c[point_type] as $k=>$v): ?><div class="row padding_7">  
                                                <div class="col-md-1 right padding_7 b1 sizefont_14">
                                                    <?php echo ($v); ?>
                                                </div>
                                                <div class="col-md-2">
                                                      <input name="<?php echo ($k); ?>[name]" type="text" class="form-control" value="<?php echo ($c[$k]['name']); ?>" placeholder=""   >
                                                </div>
                                                
                                                <div class="col-md-2">
                                                        <div class="input-group">
                                                          <div class="input-group-addon"><?php echo L('UNIT');?></div>
                                                              <input name="<?php echo ($k); ?>[unit]" type="text" class="form-control" value="<?php echo ($c[$k]['unit']); ?>" placeholder=""   >
                                                        </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-2">
                                                        <div class="input-group">  
                                                                <select class="form-control" name="<?php echo ($k); ?>[decimal]">
                                                                  <option <?php if($c[$k]['decimal'] == 0): ?>selected<?php endif; ?> >0</option>
                                                                  <option <?php if($c[$k]['decimal'] == 1): ?>selected<?php endif; ?> >1</option>
                                                                  <option <?php if($c[$k]['decimal'] == 2): ?>selected<?php endif; ?> >2</option>		
                                                                </select>	
                                                                <div class="input-group-addon"><?php echo L('BIT'); echo L('DECIMAL');?></div>									
                                                        </div>
                                                </div>
                                                
                                                <div class="col-md-1">
                                                        <div class="input-group">
                                                               <input name="<?php echo ($k); ?>[status]"   type="checkbox" value="1" <?php if($c[$k]['status'] == 1): ?>checked<?php endif; ?> data-size="small"  data-on-color="success" data-on-text="<?php echo L('OPEN');?>" data-off-color="warning" data-off-text="<?php echo L('CLOSE');?>" data-handle-width="25" data-label-width="1">
                                                        </div>
                                                </div>
                                                
                                                <div class="col-md-3">   
					                                 <img src="<?php echo ($c[$k]['ico']); ?>" class="img-thumbnail_fixed hand" alt="" width="40" height="40"  id="<?php echo ($k); ?>_ico_" onclick="selectFile({name:'<?=$k?>_ico',water:'0',type:'gif|jpg|jpeg|png|bmp',method:'0',size:'300',root_path:'<?=C('root_path')?>'})" />
                                                     <input name="<?php echo ($k); ?>[ico]" id="<?php echo ($k); ?>_ico" value="<?php echo ($c[$k]['ico']); ?>" type="hidden" />
                                                </div>                                                
                                                
                                                                                            
                                         </div><?php endforeach; endif; ?>

									 <div class="bottom_line_10 padding_5"></div> 
									 <div class="padding_5"></div>  									  
								        <div class="row padding_7 bottom_line_10 ">  
									        <div class="col-md-1  right padding_7 b1 sizefont_14"><?php echo L('CONVERT');?></div>
											<div class="col-md-8">
                                                    <div class="col-md-3">                                                               
                                                         <select class="form-control" name="tem[1]" id="add_convert_1">
                                                            <?php if(is_array($c[point_type])): foreach($c[point_type] as $k=>$v): if(C($k.'.status')): ?><option value="<?php echo ($k); ?>" >1<?php echo ($c[$k]['unit']); ?>(<?php echo ($c[$k]['name']); ?>)</option><?php endif; endforeach; endif; ?>	
                                                          </select>
                                                     </div>
                                                     <?php
 $select_option=""; foreach($c[point_type] as $k=>$v) { if(C($k.'.status')) $select_option=$select_option."<option value='".$k."' >".$c[$k]['unit']."(".$c[$k]['name'].")</option>"; } ?>
                                                     <div class="col-md-2"><input name="tem[2]" type="text" class="form-control" id="convert_point" value="10"  ></div>			                                                     <div class="col-md-3">                                                               
                                                        <select class="form-control" name="tem[3]" id="add_convert_2"><?php echo ($select_option); ?></select>
                                                    </div>
                                                    <div class="col-md-2"><input name="tem[4]" type="text" class="form-control" id="poundage_point" value=""   placeholder="<?php echo L('POUNDAGE');?>"></div>		
                                                    <div class="col-md-2">                                                               
                                                        <select class="form-control" name="tem[3]" id="add_convert_3"><option value="%" >%</option><?php echo ($select_option); ?></select>
                                                    </div>	
											</div>
                                            <div class="col-md-3"><button type="button" class="btn btn-success btn-sm" onClick="add_convert()"><?php echo L('ADD'); echo L('CONVERT');?></button></div>
								       </div>
                                       
                                        <div class='row padding_7'>
                                              <div class='col-md-1'></div>
                                              <div class='col-md-3 sizefont_14 green'><B><SPAN class='glyphicon glyphicon-book'  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='top' title=''  data-content='<?php echo L('ADMIN_Money_P_0');?>'></SPAN> <?php echo L('CONVERT');?>---<?php echo L('POINT'); echo L('CONVERT'); echo L('RATE');?></B></div>
                                              <div class='col-md-2 sizefont_14 green'  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='top' title=''  data-content='<?php echo L('ADMIN_Money_P_1');?>'><B><SPAN class='glyphicon glyphicon-book'></SPAN> <?php echo L('POUNDAGE');?></B></div>
                                              <div class='col-md-2 sizefont_14 green'  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='top' title=''  data-content='<?php echo L('ADMIN_Money_P_2');?>'><B><SPAN class='glyphicon glyphicon-book'></SPAN> <?php echo L('POUNDAGE'); echo L('MODEL_BUSINESS_POINT_TYPE');?></B></div>
                                              <div class='col-md-2 sizefont_14 green'  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='top' title=''  data-content='<?php echo L('ADMIN_Money_P_3');?>'><B><SPAN class='glyphicon glyphicon-book'></SPAN> <?php echo L('ADMIN_Money_Select');?></B></div>
                                        </div>
                                    <?php if(is_array($c[point_convert])): foreach($c[point_convert] as $k=>$v): if($k){ $convert_array=explode("__",$k); $p0=$convert_array[0]; $p1=$convert_array[2]; } $poundage_point=$c[$k]['point']; $poundage_type=$c[$k]['type']; $poundage_option=$c[$k]['option']; ?>
                                       <div class='row padding_7' id='<?php echo ($k); ?>'>
                                            <div class='col-md-1'></div>
                                            <div class='col-md-3'>
                                                 <div class='input-group'>
                                                         <span class='input-group-addon'>1<?php echo ($c[$p0]['unit']); ?>(<?php echo ($c[$p0]['name']); ?>)</span>
                                                         <input type='text' class='form-control' name='point_convert[<?php echo ($k); ?>]' value='<?php echo ($v); ?>'>
                                                         <span class='input-group-addon'><?php echo ($c[$p1]['unit']); ?>(<?php echo ($c[$p1]['name']); ?>)</span>
                                                  </div>
                                            </div>
                                            <div class='col-md-2'>
                                                  <div class='input-group'>
                                                          <span class='input-group-addon'><?php echo L('POUNDAGE');?></span>
                                                          <input type='text' class='form-control' name="<?php echo ($k); ?>[point]" value="<?php echo ($poundage_point); ?>">
                                                  </div>
                                            </div>
                                            <div class="col-md-2">                                                               
                                                        <select class="form-control" name="<?php echo ($k); ?>[type]">
                                                        <option value="%" <?php if($poundage_type=='%'): ?>selected<?php endif; ?> >%</option>
                                                        <?php if(is_array($c[point_type])): foreach($c[point_type] as $key=>$val): if(C($key.'.status')): ?><option value="<?php echo ($key); ?>" <?php if($poundage_type==$key): ?>selected<?php endif; ?> ><?php echo ($c[$key]['unit']); ?>(<?php echo ($c[$key]['name']); ?>)</option><?php endif; endforeach; endif; ?>
                                                        </select>
                                            </div>	
                                            <div class='col-md-2'>
                                                      <input type='text' class='form-control' name="<?php echo ($k); ?>[option]" value="<?php echo ($poundage_option); ?>">
                                            </div>
                                            <div class='col-md-1'>
                                                      <button type='button' class='btn btn-success btn-sm' onClick="del_convert('<?php echo ($k); ?>')"><?php echo L('DEL'); echo L('CONVERT');?></button>
                                            </div>
                                       </div><?php endforeach; endif; ?>		
                                    									  		 				
						   </DIV>
						   <!--上传设置-->	
								<DIV class="col-md-12 url" id="url3" style="display:none">
								     <div class="row padding_7">  
											<div class="col-md-2 right b1 sizefont_14">
												<?php echo L('ADMIN_Setting_Upload_Water_Open');?>
											</div>
											<div class="col-md-4">
												<label class="radio-inline"><input name="upload_water_open" type="radio" value="1" <?php if($c['upload_water_open'] == 1): ?>checked<?php endif; ?>  data-switch-no-init>
												<?php echo L('OPEN');?></label><label class="radio-inline"><input name="upload_water_open" type="radio" value="0" <?php if($c['upload_water_open'] == 0): ?>checked<?php endif; ?>  data-switch-no-init><?php echo L('CLOSE');?></label>
											</div>

							         </div>
								     <div class="row padding_7"  >  
									     	<div class="col-md-2 right  b1 sizefont_14">
												<?php echo L('ADMIN_Setting_Upload_Water_Type');?>
											</div>
											<div class="col-md-4">
												<label class="radio-inline"><input name="upload_water_type" type="radio" value="1" <?php if($c['upload_water_type'] == 1): ?>checked<?php endif; ?>  data-switch-no-init>
												<?php echo L('ADMIN_Setting_Upload_Water_Type_1');?></label><label class="radio-inline"><input name="upload_water_type" type="radio" value="0" <?php if($c['upload_water_type'] == 0): ?>checked<?php endif; ?>  data-switch-no-init><?php echo L('ADMIN_Setting_Upload_Water_Type_0');?></label>
											</div>
							         </div> 
								     <div class="row padding_7"  >  
									     	<div class="col-md-2 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Setting_Upload_Water_Position');?>
											</div>
											<div class="col-md-2">
												<div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="1" <?php if($c['upload_water_position'] == 1): ?>checked<?php endif; ?>  data-switch-no-init></label></div><div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="2" <?php if($c['upload_water_position'] == 2): ?>checked<?php endif; ?>  data-switch-no-init></label></div><div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="3" <?php if($c['upload_water_position'] == 3): ?>checked<?php endif; ?>  data-switch-no-init></label></div> <div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="4" <?php if($c['upload_water_position'] == 4): ?>checked<?php endif; ?>  data-switch-no-init></label></div><div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="5" <?php if($c['upload_water_position'] == 5): ?>checked<?php endif; ?>  data-switch-no-init></label></div> <div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="6" <?php if($c['upload_water_position'] == 6): ?>checked<?php endif; ?>  data-switch-no-init></label></div><div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="7" <?php if($c['upload_water_position'] == 7): ?>checked<?php endif; ?>  data-switch-no-init></label></div>    <div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="8" <?php if($c['upload_water_position'] == 8): ?>checked<?php endif; ?>  data-switch-no-init></label></div>   <div class="col-md-4"><label class="checkbox-inline"><input name="upload_water_position" type="radio" value="9" <?php if($c['upload_water_position'] == 9): ?>checked<?php endif; ?>  data-switch-no-init></label></div> 
											</div>
							         </div> 
								     <div class="row padding_7"  >  
									     	<div class="col-md-2 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Setting_Upload_Water_Img');?>
											</div>
											<div class="col-md-2">
												<input name="upload_water_img" type="file"> 
											</div>
                                            <div class="col-md-1 hand"><img src=<?php echo C("root_path");?>upload/water/water_img.png?rand=<?php echo rand(1,10);?>></div>
                                            <div class="col-md-6 padding_7  font_color_4"><?php echo L('ADMIN_Setting_Upload_Water_Img_P');?></div>	
							         </div> 
                                     
								     <div class="row padding_7"  >  
									     	<div class="col-md-2 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Setting_Upload_Water_Opacity');?>
											</div>
											<div class="col-md-4">
												<input name="upload_water_opacity" type="text" class="form-control" value="<?php echo ($c['upload_water_opacity']); ?>" >
											</div>
											<div class="col-md-6 padding_7  font_color_4"><?php echo L('ADMIN_Setting_Upload_Water_Opacity_P');?></div>
							         </div> 
									 <div class="row padding_7"  >  
									     	<div class="col-md-2 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Setting_Upload_Water_Text_style');?>
											</div>
											<div class="col-md-1">
												<input name="water_text_size" type="text" class="form-control" value="<?php echo ($c['water_text_size']); ?>" >
											</div>
											<div class="col-md-1">
												  <input name="water_text_color" type="text" class="form-control" value="<?php echo ($c['water_text_color']); ?>">
											</div>
											<div class="col-md-6 padding_7  font_color_4"><?php echo L('ADMIN_Setting_Upload_Water_Text_style_P');?></div>
							         </div>										 								 
									 <div class="row padding_7"  >  
									     	<div class="col-md-2 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Setting_Upload_Water_Text');?>
											</div>
											<div class="col-md-4">
											     <textarea name="water_text" class="form-control"><?php echo ($c['water_text']); ?></textarea>
											</div>
							         </div>											 
								</div>
								<!--上传设置完-->						   
						   <!--验证码设置-->	
								<DIV class="col-md-12 url" id="url4" style="display:none">
								     <div class="row padding_7">  
											<div class="col-md-2 right b1 sizefont_14">
												<?php echo L('CODE');?>
											</div>
											<div class="col-md-4">
												<label class="radio-inline"><input name="code_open" type="radio" value="1" <?php if($c['code_open'] == 1): ?>checked<?php endif; ?>  data-switch-no-init>
												<?php echo L('OPEN');?></label><label class="radio-inline"><input name="code_open" type="radio" value="0" <?php if($c['code_open'] == 0): ?>checked<?php endif; ?>  data-switch-no-init><?php echo L('CLOSE');?></label>
											</div>

							         </div>
                                     
								     <div class="row padding_7"  >  
									     	<div class="col-md-2 right b1 sizefont_14">
												<?php echo L('ADMIN_Code_Text');?>
											</div>
											<div class="col-md-10 form-inline">
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="useen_0" value="1" <?php if($c['useen_0']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Useen_0');?>
                                                      </label>
                                                    </div>  
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="useen_1" value="1" <?php if($c['useen_1']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Useen_1');?>
                                                      </label>
                                                    </div>	
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="useen_2" value="1" <?php if($c['useen_2']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Useen_2');?>
                                                      </label>
                                                    </div>                                                    		
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="useZh" value="1" <?php if($c['useZh']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Usezh');?>
                                                      </label>
                                                    </div>	                                                    										 
											</div>
							         </div>                                      
                                     
					                  <div class="row padding_7"  >  
									     	<div class="col-md-2 right b1 sizefont_14">
												<?php echo L('ADMIN_Code_Stype');?>
											</div>
											<div class="col-md-10 form-inline">
                                                   <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="useImgBg" value="1" <?php if($c['useImgBg']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Bg');?>
                                                      </label>
                                                    </div>  
                                                     <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="useCurve" value="1" <?php if($c['useCurve']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Usecurve');?>
                                                      </label>
                                                     </div>		
                                                     <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="useNoise" value="1" <?php if($c['useNoise']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Usenoise');?>
                                                      </label>
                                                    </div>	                                                   										 
				                            </div>
							         </div> 
								     <div class="row padding_7"  >  
									     	<div class="col-md-2 right padding_7 b1 sizefont_14">
												     &nbsp;&nbsp;
									   </div>
                                            <div class="col-md-1">
                                                <input class="form-control"  name="fontSize" type="text"  value="<?php echo ($c['fontSize']); ?>" placeholder="<?php echo L('ADMIN_Code_Fontsize');?>">
                                            </div>
                                            <div class="col-md-1">
                                                <input class="form-control"  name="length" type="text"  value="<?php echo ($c['length']); ?>"  placeholder="<?php echo L('ADMIN_Code_Length');?>">
                                            </div>
                                            <div class="col-md-1">
                                              <input class="form-control"  name="imageW" type="text"  value="<?php echo ($c['imageW']); ?>"  placeholder="<?php echo L('ADMIN_Code_W');?>">
                                            </div>
                                            <div class="col-md-1">
                                              <input class="form-control"  name="imageH" type="text"  value="<?php echo ($c['imageH']); ?>"  placeholder="<?php echo L('ADMIN_Code_H');?>">
                                            </div>
                                            <div class="col-md-6 padding_7  font_color_4"><?php echo L('ADMIN_Code_Stype_P');?></div>	
						          </div> 
                                     
								     <div class="row padding_7"  >  
									     	<div class="col-md-2 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Code_Expire');?>
											</div>
											<div class="col-md-4">
												<input name="expire" type="text" class="form-control" value="<?php echo ($c['expire']); ?>" >
											</div>
											<div class="col-md-6 padding_7  font_color_4"><?php echo L('ADMIN_Code_Unit');?></div>
							         </div> 
					                  <div class="row padding_7"  >  
									     	<div class="col-md-2 right b1 sizefont_14">
												<?php echo L('ADMIN_Code_Open_Model');?>
											</div>
											<div class="col-md-10 form-inline">
                                                   <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="code_admin_login" value="1" <?php if($c['code_admin_login']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Open_Model_Admin_Login');?>
                                                      </label>
                                                    </div>  
                                                     <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="code_user_login" value="1" <?php if($c['code_user_login']): ?>checked<?php endif; ?> data-switch-no-init> <?php echo L('ADMIN_Code_Open_Model_User_Login');?>
                                                      </label>
                                                     </div>		                                                   										 
				                            </div>
							         </div> 								
				  </div>
								<!--验证码设置-->
								<!--其他设置-->
							   <DIV class="col-md-12 url" id="url1" style="display:none">

								       <div class="row padding_7">  
									        <div class="col-md-1 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Site_Url_Model');?>
											</div>
											<div class="col-md-4  padding_7"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content=''>
													<label class="radio-inline">
		                                                  &nbsp;<input type="radio"  name="url_model" id="url_model0" value="0" <?php if($c[url_model] == 0): ?>checked<?php endif; ?> data-switch-no-init><?php echo L('ADMIN_Site_Url_Model_0');?>
		                                            </label>
													
													<label class="radio-inline">
		                                                   <input type="radio"  name="url_model" id="url_model1" value="1" <?php if($c[url_model] == 1): ?>checked<?php endif; ?> data-switch-no-init><?php echo L('ADMIN_Site_Url_Model_1');?>
		                                            </label>

													<label class="radio-inline">
		                                                   <input type="radio" name="url_model" id="url_model2" value="2" <?php if($c[url_model] == 2): ?>checked<?php endif; ?> data-switch-no-init><?php echo L('ADMIN_Site_Url_Model_2');?>
		                                            </label>
													
													<label class="radio-inline">
		                                                   <input type="radio" name="url_model" id="url_model3" value="3" <?php if($c[url_model] == 3): ?>checked<?php endif; ?> data-switch-no-init><?php echo L('ADMIN_Site_Url_Model_3');?>
		                                            </label>
											</div>
											<div class="col-md-7 padding_7  font_color_4"><?php echo L('ADMIN_Site_Url_Model_Info');?></div>
								      </div>
									  

								      <div class="row padding_7">  
									        <div class="col-md-1 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Site_Url_Suffix');?>
											</div>
											<div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content='<?php echo L('ADMIN_Site_Url_Suffix_Info');?>'>
                                                    <input name="url_html_suffix" type="text" class="form-control" id="url_html_suffix" value="<?php echo ($c[url_html_suffix]); ?>" placeholder=""   >
											</div>
											<div class="col-md-7 padding_7  font_color_4"><?php echo L('ADMIN_Site_Url_Suffix_Info');?></div>
								      </div>
									  

								      <div class="row padding_7">  
									        <div class="col-md-1 right padding_7 b1 sizefont_14">
												<?php echo L('ADMIN_Site_Jump_Time');?>
											</div>
											<div class="col-md-4"  aria-hidden='true' data-toggle='popover' data-container="body"  data-trigger="hover"  data-placement='right' title=''  data-content='<?php echo L('ADMIN_Site_Jump_Time_Info');?>'>
                                                    <input name="jump_time" type="text" class="form-control" id="jump_time" value="<?php echo ($c[jump_time]); ?>"  placeholder=""   >
											</div>
											<div class="col-md-7 padding_7  font_color_4"><?php echo L('ADMIN_Site_Jump_Time_Info');?></div>
								      </div>								  
						 </DIV>
							  <!--其他设置-->
							  <!--短信验证码设置-->
							  <!--其他设置-->
								<DIV class="col-md-12 url" id="url5" style="display:none">
									<div class="row padding_7">
										<div class="col-md-2 right padding_7 b1 sizefont_14">
											<?php echo L('ADMIN_Mobile_Fnterface');?>
										</div>
										<div class="col-md-9 padding_7">
											<label class="radio-inline">
												&nbsp;<input type="radio"  name="message_inter" value="1" <?php if($c[message_inter] == 1): ?>checked<?php endif; ?> data-switch-no-init><?php echo L('ADMIN_Mobile_Fnterface_1');?>
											</label>
										</div>
									</div>
									<div class="row padding_7">
										<div class="col-md-2 right padding_7 b1 sizefont_14">
											AppKey
										</div>
										<div class="col-md-4">
											<input name="sms_appkey" type="text" class="form-control" value="<?php echo ($c[sms_appkey]); ?>" placeholder="">
										</div>
									</div>
									<div class="row padding_7">
										<div class="col-md-2 right padding_7 b1 sizefont_14">
											AppSecret
										</div>
										<div class="col-md-4">
											<input name="sms_appsecret" type="text" class="form-control" value="<?php echo ($c[sms_appsecret]); ?>" placeholder="">
										</div>
									</div>
									<div class="row padding_7">
										<div class="col-md-2 right padding_7 b1 sizefont_14">
											<?php echo L('ADMIN_Mobile_Tem_Id');?>
										</div>
										<div class="col-md-4">
											<input name="sms_template_code" type="text" class="form-control" value="<?php echo ($c[sms_template_code]); ?>" placeholder="">
										</div>
                                        <div class="col-md-6 padding_7  font_color_4"><?php echo L('ADMIN_Mobile_Tem_Id_P');?></div>
									</div>
                                    <div class="row padding_7">
										<div class="col-md-2 right padding_7 b1 sizefont_14">
											<?php echo L('ADMIN_Mobile_Code_Len');?>
										</div>
										<div class="col-md-4">
											<input name="sms_code_len"   id="sms_code_len"  type="text" class="form-control" value="<?php echo ($c[sms_code_len]); ?>" placeholder="">
										</div>
									</div>
									<div class="row padding_7">
										<div class="col-md-2 right padding_7 b1 sizefont_14">
											<?php echo L('ADMIN_Mobile_Sign');?>
										</div>
										<div class="col-md-4">
											<input name="sms_sign_name" id="sms_sign_name" type="text" class="form-control" value="<?php echo ($c[sms_sign_name]); ?>" placeholder="">
										</div>
									</div>
								</DIV>
                              <!--其他设置-->
					</div>
				</div><!--变换白色区域-->
<!--内容结束--> 

                    <div class="padding_10"></div>
                    <div align="row">
					    <div class="col-md-12 center">
						      <button type="submit" class="btn btn-success"><?php echo L('ADMIN_Config_Name');?></button>
						</div>
					</div>		
</form>	
</div>
<script>

function url(id)
{
	  $(".url_title").removeClass("active");
	  $("#url_title"+id).addClass("active");
	  $(".url").hide("slow");
	  $("#url"+id).show("slow");
	  
} 
url_param=document.location.hash ;
url_param=url_param.substring(1);
if(url_param) url(url_param)

$(document).ready(
    function()
	{ 
	   p={template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content red4"></div></div>'};
       $('[data-toggle="popover"]').popover(p)
	}
	
);

function add_convert()
{
	    add_convert_1_val=$("#add_convert_1 option:selected").val();
		add_convert_1_text=$("#add_convert_1 option:selected").text();
	    add_convert_2_val=$("#add_convert_2 option:selected").val();
		add_convert_2_text=$("#add_convert_2 option:selected").text();
		add_convert_name=add_convert_1_val+"__convert__"+add_convert_2_val;
        convert_point=$('#convert_point').val();
		
	    add_poundage_val=$("#poundage_point").val();
		add_poundage_type=$("#add_convert_3 option:selected").val();		
		add_poundage_name=add_convert_1_val+"__poundage__"+add_convert_2_val;
		if($("#"+add_convert_name).length>0)
		{
			jq_alert('<?php echo L('ADMIN_Money_Setting_Err_1');?>');
			return false;			
		}
		if(add_convert_1_val==add_convert_2_val)
		{
			jq_alert('<?php echo L('ADMIN_Money_Setting_Err_0');?>');
			return false;
		}
		
    	convert_html="<div class='row padding_7' id='"+add_convert_name+"'><div class='col-md-1'></div><div class='col-md-3'><div class='input-group'><span class='input-group-addon'>"+add_convert_1_text+"</span><input type='text' class='form-control' name='point_convert["+add_convert_name+"]' value='"+convert_point+"'><span class='input-group-addon'>"+add_convert_2_text+"</span></div></div><div class='col-md-2'><div class='input-group'><span class='input-group-addon'><?php echo L('POUNDAGE');?></span><input type='text' class='form-control' name='"+add_convert_name+"[point]' value='"+add_poundage_val+"'></div></div><div class='col-md-2'><select class='form-control' name='"+add_convert_name+"[type]' id="+add_poundage_name+"><option value='%'>%</option><?php echo ($select_option); ?></select></div><div class='col-md-2'><input type='text' class='form-control' name='"+add_convert_name+"[option]' value='10,20,30,50,100,200,300,-1'></div><div class='col-md-1'><button type='button' class='btn btn-success btn-sm' onClick=\"del_convert('"+add_convert_name+"')\"><?php echo L('DEL'); echo L('CONVERT');?></button></div></div>"
		$("#url2").append(convert_html);
		$("#"+add_poundage_name).val(add_poundage_type);
									        	
}

function del_convert(id)
{
	  $("#"+id).remove(); 	
}
</script>
</body>
</html>
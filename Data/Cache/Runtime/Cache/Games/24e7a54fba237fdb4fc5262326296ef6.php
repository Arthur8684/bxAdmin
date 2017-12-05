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
<SCRIPT src="/cowcms/Public/css_js_font_img/js/upload.js" type="text/javascript"></SCRIPT>
<title><?php echo L('ADMIN_Manage_TITLE');?></title>
</head>
<body>
<div class="container-fluid">
        <div class="row">			 
					<div class="input-group col-md-12">
						<div class="bg_black_14 bottom_line_10 padding_5 sizefont_14">
						<?php echo RR('Games/Admin/games_list',L('Games_Manage'),'btn btn-danger btn-xs');?>    
                        </div>
					 </div> 
        </div>
	<form action="" method="post">	
		<div class="row padding_8">		
				 <div class="col-md-12">
						<div class="col-md-1 right padding_7 b1 sizefont_14"><?php echo L('Games_Class');?>：&nbsp;</div>
						<div class="col-md-10" id='classid'>
						<?php echo ($class); ?>
						</div>
				</div>
      </div>
		 
		 <div class="row padding_8">		
				 <div class="col-md-4">
					 <div class="input-group col-md-12">
								<span class="input-group-addon"><?php echo L('Games_Name');?></span>
                                <input name="name" type="text" class="form-control" id="name" value="<?php echo ($info['name']); ?>" >
					 </div> 
				</div>
                <div class="col-md-1">
                                <input name="status"   type="checkbox" id="switch-animate" value="1" <?php if($info[status] == 1): ?>checked<?php endif; ?> data-size="small"  data-on-color="success" data-on-text="<?php echo L('OPEN');?>" data-off-color="warning" data-off-text="<?php echo L('CLOSE');?>" data-handle-width="25" data-label-width="1">
				</div>
         </div>
         
         <div class="row padding_8">		
				 <div class="col-md-4">
					 <div class="input-group col-md-12">
								<span class="input-group-addon"><?php echo L('Games_Sign');?></span>
                                <input name="sign" type="text" class="form-control" id="sign" value="<?php echo ($info['sign']); ?>" >
					 </div> 
				</div>
         </div>

         <div class="row padding_8">
            <div class="col-md-4 padding_7">
                        <div class="col-md-2 left padding_5 sizefont_12"><?php echo L('Games_Img');?></div> 
                        <div class="col-md-10">
                             <input name="img" id="img" value="<?php echo ($info['img']); ?>" type="hidden" />
                            <img src="<?php echo ($info['img']); ?>" class="img-thumbnail_fixed hand" alt="" width="150" height="200"  id="img_" onclick="selectFile({name:'img',water:'0',type:'gif|jpg|jpeg|png|bmp',method:'0',size:'',root_path:'<?php echo C('root_path');?>'})" /> </div>	
            </div> 
         </div>	
         	 
		<div  class="padding_10"></div> 
		 <div  class="row">
		 		 <div  class="col-md-12 center">
		                <button type="submit" class="btn btn-success"><?php echo L('EDIT');?></button>
		         </div>
		 </div>
         <input name="id" type="hidden" value="<?php echo ($info['id']); ?>">
</form>
</div>
</body>
</html>
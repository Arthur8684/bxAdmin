<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<META content="IE=9.0000" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet"> 
<LINK href="/cowcms/Public/css_js_font_img/css/admin.css" rel="stylesheet"> 
<SCRIPT src="/cowcms/Public/css_js_font_img/js/jquery.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/bootstrap.min.js" type="text/javascript"></SCRIPT>
<title><?php echo L('ADMIN_Manage_TITLE');?></title>
</head>
<body scroll="no" style="overflow: hidden;background-color:#000000" >

<div class="login_bg">
<!--存放表单内容的框-->
     <div class="login_from">
				<div class="container-fluid">
				     <form class="form-horizontal" method="post" action=""><br>
<br>
						<div class="row">
							<div class="input-group col-md-12">
							 <span class="input-group-addon" id="basic-addon1"><?php echo L('ADMIN_User');?></span>
							  <input name="user" type="text" class="form-control" id="inputEmail3" placeholder="<?php echo L('ADMIN_User');?>">
							</div>
							<br>
							<div class="input-group col-md-12">
							<span class="input-group-addon" id="basic-addon1"><?php echo L('ADMIN_Pass');?></span>
							  <input name="pass" type="password" class="form-control" id="inputEmail3" placeholder="<?php echo L('ADMIN_Pass');?>">
					   </div>
							<br>
                         <?php if(C('code_admin_login') && C('code_open')): ?><div class="input-group col-md-12">
							<span class="input-group-addon" id="basic-addon1"><?php echo L('CODE');?></span>
							  <input name="code_admin_login" type="text" class="form-control" placeholder="<?php echo L('CODE');?>"  >
                               <div class="input-group-addon" id="code" aria-hidden='true' data-toggle='popover' data-container="body"   data-placement='top' title='' data-content="<?php echo code('',C('code_admin_login'));?>" data-html='true'>-</div>
							</div>
							<br><?php endif; ?>
						    <div class="col-md-10 col-md-offset-2"><button type="submit" class="btn btn-default active  btn-sm"><?php echo L('LOGIN');?></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-default active  btn-sm"><?php echo L('RESET');?></button>
						</div>
					  </form>
				</div>
	 </div>
<!--存放表单内容的框完-->
</div>
<script>
$('#code').popover('show')
</script>
</body>
</html>
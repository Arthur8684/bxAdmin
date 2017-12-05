<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<title><?php echo L('User_login');?>-<?php if(C('site_title')): echo C('site_title'); else: echo C('site_name'); endif; ?></title>
<META content="IE=9.0000" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet"> 
<LINK href="/cowcms/Public/css_js_font_img/css/user/houtai.css" rel="stylesheet"> 
</head>

<body class=" bg">
<div class="position">
<h1 align="center"><?php echo L('User_login');?></h1>
<form class="form-horizontal" method="post" action="">
	<div><input name="user"  type="text" class="form-control" placeholder="<?php echo L('p_input_user');?>" style="color:#FFF"></div>
    <div><input  type="password" name="pass" class="form-control" placeholder="<?php echo L('p_input_pass');?>"  style="color:#FFF"></div>
	<div class="rememberme">
       <div align="left"><input type="submit" value="<?php echo L('login_sumber');?>" class="btn-block1">&nbsp;&nbsp;<a href="<?php echo U('user/login/register');?>" style="color:#FFF"><?php echo L('register');?></a>&nbsp;&nbsp;<a href="<?php echo U('user/login/find_pass');?>" style="color:#FFF">忘记密码?</a></div>
    </div>
    <input name="source" type="hidden" value="<?php echo ($source); ?>">
</form>
</div>
<p align="center"><a href="<?php echo U('index/index/index');?>">返回网站首页</a></p>
</body>
</html>
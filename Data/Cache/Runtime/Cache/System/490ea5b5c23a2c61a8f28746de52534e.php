<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<META content="IE=9.0000" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet"> 
<LINK href="/cowcms/Public/css_js_font_img/css/admin.css" rel="stylesheet"> 
<SCRIPT src="/cowcms/Public/css_js_font_img/js/jquery.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/bootstrap.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/diy.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/upload.js" type="text/javascript"></SCRIPT>
<title><?php echo L('ADMIN_Manage_TITLE');?>-<?php echo L('ADMIN_Menu_OPERATE');?></title>
</head>
<body>
<div class="container-fluid">
		 <div class="row padding_8">		
			  <div class="col-md-6">
					<div class="panel panel-default">
					  <div class="panel-heading"><strong><?php echo L('ADMIN_System_System_Title');?></strong></div>
					  <div class="panel-body">
							  <P><?php echo L('ADMIN_System_Php_Run_Type');?>：<?php echo php_sapi_name();?></P>
							  <P><?php echo L('ADMIN_System_Php_Version');?>：<?php echo ($sysinfo['PHP_VERSION']); ?></P>
							  <P><?php echo L('ADMIN_System_Zend_Version');?>：<?php echo Zend_Version();?></P>
							  <P><?php echo L('ADMIN_System_Sever_Max_Upload');?>：<?php echo ($sysinfo['MAX_UPLOAD']); ?></P>
							  <P><?php echo L('ADMIN_System_Sever_Max_Run_time');?>：<?php echo ($sysinfo['MAX_EX_TIME']); ?></P>
							  <P><?php echo L('ADMIN_System_Sever_Time');?>：<?php echo ($sysinfo['TIME']); ?></P>
							  <P><?php echo L('ADMIN_System_Sever_Language');?>：<?php echo ($sysinfo['SERVER_LANGUAGE']); ?></P>
							  <P><?php echo L('ADMIN_System_Operate_System');?>：<?php echo ($sysinfo['OS']); ?></P>
					  </div>
					</div>
			  </div>
			  <div class="col-md-6">
					<div class="panel panel-default">
					  <div class="panel-heading"><strong><?php echo L('ADMIN_System_Mysql_Title');?></strong></div>
					  <div class="panel-body">
					          <P><?php echo L('ADMIN_System_Mysql_Version');?>：<?php echo ($sysinfo['MYSQL_VERSION']); ?></P>
							  <P><?php echo L('ADMIN_System_Mysql_Size');?>：<?php echo ($sysinfo['MYSQL_SIZE']); ?></P>
							  <P><?php echo L('ADMIN_System_Mysql_Prefix');?>：<?php echo C('DB_PREFIX');?></P>
							  <P><?php echo L('ADMIN_System_Mysql_Charset');?>：<?php echo C('DB_CHARSET');?></P>
							  <P><?php echo L('ADMIN_System_Mysql_Port');?>：<?PHP echo C('DB_PORT')? C('DB_PORT'):'3306'; ?></P>
							  <P><?php echo L('ADMIN_System_Mysql_Log');?>：<?PHP echo C('DB_DEBUG')? L('ADMIN_System_Mysql_Log_0'): L('ADMIN_System_Mysql_Log_1'); ?></P>
							  <P><?php echo L('ADMIN_System_Mysql_Deploy_Type');?>：<?PHP echo C('DB_DEPLOY_TYPE')? L('ADMIN_System_Mysql_Deploy_Type_1'): L('ADMIN_System_Mysql_Deploy_Type_0'); ?></P>
							  <P><?php echo L('ADMIN_System_Mysql_Fields_Cache');?>：<?PHP echo C('DB_FIELDS_CACHE')? L('ADMIN_System_Mysql_Fields_Cache_1'): L('ADMIN_System_Mysql_Fields_Cache_0'); ?></P>
							  
					  </div>
					</div>
			  </div>
         </div>

</div>
<script>
$(document).ready(
    function()
	{ 
	   p={template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content red4"></div></div>'};
       $('[data-toggle="popover"]').popover(p);
	   
	   change_();

	}	
);
</script>
</body>
</html>
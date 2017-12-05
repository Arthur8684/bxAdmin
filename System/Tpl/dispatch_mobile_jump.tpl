<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<META content="IE=9.0000" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=__CHARSET__" />
<LINK href="__ROOT__/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet"> 
<LINK href="__ROOT__/Public/css_js_font_img/css/admin.css" rel="stylesheet"> 
<LINK href="__ROOT__/Public/css_js_font_img/css/buttons.css" rel="stylesheet"> 

<title><?PHP if($status) {echo L('SUCCESS');} else {echo L('ERR');} ?></title>
</head>
<body> 
<table width="95%" height="600" border="0" cellpadding="0" cellspacing="0" id="body_s">
  <tr>
    <td align="center" valign="middle">
	
	
<div class="row" >
    <div class="col-md-6 col-md-offset-3">
<?PHP
if($status)
{
?>
<div class="panel panel-success">

		 <div class="panel-heading"><?php echo L('SUCCESS'); ?></div>
		  <div class="panel-body">
			    <?php echo($message); ?>
		  </div>
		  <div class="panel-footer">页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></div>
</div>

<?PHP
}else{
?>
<div class="panel panel-danger">

		 <div class="panel-heading"><?php echo L('ERR'); ?></div>
		  <div class="panel-body">
			    <?php echo($error); ?>
		  </div>
		  <div class="panel-footer">页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></div>

</div>
<?PHP
}
?>
</div></div>	
	
	
	
	
	</td>
  </tr>
</table>



</body>

<SCRIPT src="__ROOT__/Public/css_js_font_img/js/jquery.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="__ROOT__/Public/css_js_font_img/js/bootstrap.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="__ROOT__/Public/css_js_font_img/js/jscroll.js" type="text/javascript"></SCRIPT>
<script type="text/javascript">
height=$("#connect_iframe",window.parent.document).height();
$("#body_s").height(height);

(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0 ) {
		location.href = href;
		clearInterval(interval);
		
	};
}, 1000);
})();
</script>
</html>

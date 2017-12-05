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
<title><?php echo L('ADMIN_Manage_TITLE');?>-<?php echo L('ADMIN_Menu_OPERATE');?></title>
</head> 
<body>

<div class="container-fluid">
<div class="row bg_black_14 bottom_line_10" >			 
			<div class="input-group col-md-12">
					<div class=" padding_5 sizefont_14">                      
                        <?php echo RR('Admin/Site/site_add',L('ADMIN_Site_Add'),'btn btn-success btn-sm');?>			
				   </div>
			</div> 
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover">
<thead>
  <tr>
    <td width="4%" align="center" valign="middle"><?php echo L('ID');?></td>
    <td width="16%" align="left" valign="middle"><?php echo L('ADMIN_Site_Name');?></td>
    <td width="23%" align="center" valign="middle"><?php echo L('ADMIN_Site_Domain');?></td>
    <td width="11%" align="center" valign="middle"><?php echo L('OPEN');?></td>
    <td width="28%" align="center" valign="middle"><?php echo L('ADMIN_Menu_Operate');?></td>
  </tr>
</thead>  
<?php if(is_array($info)): foreach($info as $k=>$v): ?><tr>
    <td align="center" valign="middle"   id="text" ><?php echo ($v[id]); ?></td>
    <td align="left" valign="middle"  id="name_<?php echo ($v[id]); ?>" ><span aria-hidden='true' data-toggle='tooltip' data-placement='top' title='<?php echo L('CLICK_MSG');?>' onClick="ajax_text({'id_name':'name_<?php echo $v[id] ?>','value':'<?php echo $v[name] ?>','field':'name','url':'<?php echo U('Admin/AdminAjax/site_ajax').'?id='.$v[id] ?>','width':30})"><?php echo ($v[name]); ?></span></td>
    <td align="center" valign="middle"><?php echo ($v[domain]); ?></td>
    <td align="center" valign="middle"><input name="status"   type="checkbox" id="status" value="<?php echo ($v[id]); ?>" <?php if($v[status] == 1): ?>checked<?php endif; ?>  data-size="mini"  data-on-color="success" data-on-text="<?php echo L('OPEN');?>" data-off-color="warning" data-off-text="<?php echo L('CLOSE');?>" data-handle-width="25" data-label-width="1"></td>
    <td align="center" valign="middle">
	<?php echo RR(array('Admin/Site/site_edit',"id=".$v[id]),"<span class='glyphicon glyphicon-pencil sizefont_16 ' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('EDIT')."'></span>");?>  
	<?php echo RR(array("Admin/Site/site_del","id=".$v[id]),"<span class='glyphicon glyphicon-trash  sizefont_16' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('DEL')."'></span>","","onClick=\"return  jq_confirm(this,'".L('ADMIN_Site_Del_Info',array('site_name'=>$v[name]))."')\"");?> 
</td>
  </tr><?php endforeach; endif; ?>
</table>

<?php echo ($page_show); ?>
<script>
$('input[id="menu_id"][type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
   checkbox_id=$('input[id="id[]"][type="checkbox"]')
     if(state)
	 {
			checkbox_id.prop("checked", true);
	 }
	 else
	 {
			 checkbox_id.prop("checked", false);
	 }
});

$('input[id="status"][type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
        site_status=state?1:0;
	    URL="<?php echo U('Admin/AdminAjax/site_ajax');?>";
		para="{'id':'"+$(this).prop("value")+"','status':"+site_status+"}";
		para=eval('(' + para + ')');
     	$.getJSON(URL,para,function(json){
               if(json.err)
			   {
		            jq_alert(json.content);
			   }
			   
		});
});
$(document).ready(
    function()
	{ 
        $("[data-toggle='tooltip']").tooltip();
	}
	
);
</script>
</div>
</body>
</html>
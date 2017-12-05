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
<form name="class_" id="class_" method="post" action="<?php echo U('Admin/Menu/menu_all');?>">
			<div class="row bg_black_14 bottom_line_10" >			 
						<div class="input-group col-md-12">
								<div class=" padding_5 sizefont_14">     
		<?php echo RR(array('Admin/Menu/menu_add',array('type'=>$type)),L('ADMIN_Menu_Add'),'btn btn-success btn-sm');?>
		<?php echo RR(array('Admin/Menu/menu_list',array('type'=>$type)),L('ADMIN_Menu_Select_Top'),'btn btn-success btn-xs');?> 
		<?php if($parent_menu_nav): if(is_array($parent_menu_nav)): foreach($parent_menu_nav as $k=>$v): if($v[id]==$parentid): ?>&nbsp;<?php echo RR("#",$v['title'],'btn btn-danger btn-xs',"disabled='disabled'");?> 
				<?php else: ?>
				     <?php echo RR(array('Admin/Menu/menu_list',array('parentid'=>$v['id'],'type'=>$type)),$v['title'],'btn btn-danger btn-xs'); endif; endforeach; endif; endif; ?> 
		   		
						  </div>
              </div> 
            </div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover">
<thead>
  <tr>
    <td width="4%" height="32" align="center" valign="middle"><input name="menu_id"   type="checkbox" id="menu_id" value="1" data-size="mini"  data-on-color="success" data-on-text="<?php echo L('ALL_1');?>" data-off-color="warning" data-off-text="<?php echo L('NO');?>" data-handle-width="10" data-label-width="1"></td>
    <td width="4%" align="center" valign="middle"><?php echo L('ADMIN_Menu_Sort');?></td>
    <td width="4%" align="center" valign="middle"><?php echo L('ADMIN_Menu_Id');?></td>
    <td width="16%" align="left" valign="middle"><?php echo L('ADMIN_Menu_Name');?></td>
    <td width="23%" align="center" valign="middle"><?php echo L('ADMIN_Menu_Class');?></td>
    <td width="11%" align="center" valign="middle"><?php echo L('OPEN');?></td>
    <td width="10%" align="center" valign="middle"><?php echo L('ADMIN_Menu_Submenu_Num');?></td>
    <td width="28%" align="center" valign="middle"><?php echo L('ADMIN_Menu_Operate');?></td>
  </tr>
</thead>  
<?php if(is_array($info)): foreach($info as $k=>$v): ?><tr>
    <td align="center" valign="middle" height="20" ><input  name="id[]" type="checkbox" id="id[]" value="<?php echo ($v[id]); ?>"   data-switch-no-init></td>
    <td align="center" valign="middle"><label>
      <input class="center" name="sort_<?php echo ($v[id]); ?>" type="text"  id="sort_<?php echo ($v[id]); ?>" value="<?php echo ($v[sort]); ?>" size="5" onBlur="ajax_({'id_name':'sort_<?php echo $v[id] ?>','url':'<?php echo U('Admin/AdminAjax/menu_ajax').'?id='.$v[id] ?>','field':'sort'})" >
    </label></td>
    <td align="center" valign="middle"   id="text" ><?php echo ($v[id]); ?></td>
    <td align="left" valign="middle"  id="title_<?php echo ($v[id]); ?>" ><span aria-hidden='true' data-toggle='tooltip' data-placement='top' title='<?php echo L('CLICK_MSG');?>' onClick="ajax_text({'id_name':'title_<?php echo $v[id] ?>','value':'<?php echo $v[title] ?>','field':'title','url':'<?php echo U('Admin/AdminAjax/menu_ajax').'?id='.$v[id] ?>','width':30})"><?php echo ($v[title]); ?></span></td>
    <td align="center" valign="middle"><?php if($parentid): echo ($parent_menu['title']); else: echo L('ADMIN_Menu_Select_Top'); endif; ?></td>
    <td align="center" valign="middle"><input name="status"   type="checkbox" id="status" value="<?php echo ($v[id]); ?>" <?php if($v[status] == 1): ?>checked<?php endif; ?>  data-size="mini"  data-on-color="success" data-on-text="<?php echo L('OPEN');?>" data-off-color="warning" data-off-text="<?php echo L('CLOSE');?>" data-handle-width="25" data-label-width="1"></td>
    <td align="center" valign="middle"><?php $sub=get_submenu_count($v[id],0); echo ($sub[0]); ?></td>
    <td align="center" valign="middle">
	<?php echo RR(array('Admin/Menu/menu_edit',array('id'=>$v[id],'type'=>$type)),"<span class='glyphicon glyphicon-pencil sizefont_16 ' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('EDIT')."'></span>");?>  
	<?php echo RR(array("Admin/Menu/menu_del",array('id'=>$v[id],'type'=>$type)),"<span class='glyphicon glyphicon-trash  sizefont_16' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('DEL')."'></span>","","onClick=\"return  jq_confirm(this,'".L('ADMIN_Del_Menu',array('menu_name'=>$v[title]))."')\"");?> 
	
	<?php if($sub[0]): echo RR(array('Admin/Menu/menu_list',array('parentid'=>$v[id],'type'=>$type)),"<span class='glyphicon glyphicon-th-list sizefont_16' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('ADMIN_Menu_Small_Manage')."'></span>");?>  
	<?php else: ?>
	<span class='glyphicon glyphicon-th-list sizefont_16 font_color_5' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='<?php echo L('ADMIN_Menu_Small_Manage');?>'></span><?php endif; ?>
	<?php echo RR(array("Admin/Menu/menu_add",array('parentid'=>$v[id],'type'=>$type)),"<span class='glyphicon glyphicon-plus sizefont_16' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('ADMIN_Menu_Small_Add')."'></span>");?></td>
  </tr><?php endforeach; endif; ?>
</table>
<button  type="button" class="btn btn-default btn-sm" name="all_del" value="ALL_DEL" onClick="return return_()"><?php echo L('ALL_DEL');?></button>   
<?php echo ($page_show); ?>
<input name="type" type="hidden" value="<?php echo ($type); ?>">
</form>
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
function return_()
{
     checkbox_id=$('input[id="id[]"][type="checkbox"]:checked')
	 
	 if(checkbox_id.length<=0)
	 {
	     jq_alert('<?php echo L("ERR_ALL_SET");?>','<?php echo L("ERR_TLTLE");?>','<?php echo L("OK");?>')
		 return false ;
	 }
	objects=document.getElementById('class_');
    jq_confirm(objects,'<?php echo L("DEL_ALL_INFO");?>','<?php echo L("TLTLE_CONFIRM");?>','<?php echo L("OK");?>','<?php echo L("CANCEL");?>')
	return false;
}
$('input[id="status"][type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
        menu_status=state?1:0;
	    URL="<?php echo U('Admin/AdminAjax/menu_ajax');?>";
		para="{'id':'"+$(this).prop("value")+"','status':"+menu_status+"}";
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
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head> 
<META content="IE=9.0000" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/cowcms/Public/css_js_font_img/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<LINK href="/cowcms/Public/css_js_font_img/admin/css/admin.css" rel="stylesheet"> 
<script src="/cowcms/Public/css_js_font_img/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/cowcms/Public/css_js_font_img/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/cowcms/Public/css_js_font_img/global/scripts/diy.js" type="text/javascript"></script>
<title><?php echo L('ADMIN_Manage_TITLE');?>-<?php echo L('Games');?></title>
</head> 
<body>

<div class="container-fluid">
<form name="games_" id="games_" method="post" action="<?php echo U('Games/Admin/games_del');?>" onSubmit="return return_()">
			<div class="row bg_black_14 bottom_line_10" >			 
						<div class="input-group col-md-12">
								<div class=" padding_5 sizefont_14">
		                            <?php echo RR('Games/Admin/games_add',L('ADD').L('Games'),'btn btn-success btn-sm');?>                           			
						        </div>
                       </div> 
            </div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover">
<thead>
  <tr>
    <td width="1%" height="32" align="center" valign="middle"><input name="games_id"   type="checkbox" id="games_id" value="1" data-size="mini"  data-on-color="success" data-on-text="<?php echo L('ALL_1');?>" data-off-color="warning" data-off-text="<?php echo L('NO');?>" data-handle-width="10" data-label-width="1"></td>
    <td width="2%" height="32" align="center" valign="middle">ID</td>
    <td width="25%" align="left" valign="middle"><?php echo L('Games_Name');?></td>
    <td width="5%" align="center" valign="middle"><?php echo L('OPEN');?></td>
    <td width="20%" align="left" valign="middle"><?php echo L('Games_Class');?></td>
    <td  align="center" valign="middle"><?php echo L('OPERATE');?></td>
  </tr>
</thead>  
<?php if(is_array($info)): foreach($info as $k=>$v): ?><tr>
    <td align="center" valign="middle" height="20" ><input  name="id[]" type="checkbox" id="id[]" value="<?php echo ($v[id]); ?>"   data-switch-no-init></td>
    <td height="20" align="center" valign="middle" ><?php echo ($v[id]); ?></td>
    <td align="left" valign="middle"  class="green"><?php echo ($v[name]); ?></td>
    <td align="center" valign="middle"><?php if($v['status']): ?><span class="green"><?php echo L('OPEN');?></span><?php else: ?><span class="red"><?php echo L('CLOSE');?></span><?php endif; ?></td>
    <td align="left" valign="middle" class="red"><?php echo show_linkages(array('id'=>$v['class_id'],'table'=>'games_class'),'Games/Admin/games_list');?></td>
    <td align="center" valign="middle">
	<?php echo RR(array('Games/Admin/games_edit',"id=".$v[id]),"<span class='glyphicon glyphicon-pencil sizefont_16 ' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('EDIT')."'></span>");?>
	<?php echo RR(array("Games/Admin/games_del","id=".$v[id]),"<span class='glyphicon glyphicon-trash  sizefont_16' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('DEL')."'></span>","","onClick=\"return  jq_confirm(this,'".L('Games_Game_Del_P',array('games_name'=>$v[name]))."')\"");?>

    <?php echo RR(array("Games/Admin/".$v['set_path']."","id=".$v[id]),"<span class='glyphicon glyphicon-cog  sizefont_16' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='".L('SET')."'></span>");?>
</td>
  </tr><?php endforeach; endif; ?>
</table>
<button  type="button" class="btn btn-default btn-sm" name="all_del" value="ALL_DEL" onClick="return return_()"><?php echo L('ALL_DEL');?></button>
<?php echo ($page_show); ?>
</form>
<script>
$('#games_id').on('click', function() {
     check=$(this).is(':checked');
     checkbox_id=$('input[id="id[]"][type="checkbox"]')
     if(check)
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
	objects=document.getElementById('games_');
    jq_confirm(objects,'<?php echo L("DEL_ALL_INFO");?>','<?php echo L("TLTLE_CONFIRM");?>','<?php echo L("OK");?>','<?php echo L("CANCEL");?>')
	return false;
}
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
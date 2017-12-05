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
    <div class="padding_5"></div>
    <form action="" method="post" name="form1" id="form1">
        <!--内容开始-->
        <ul class="nav nav-tabs">
            <li role="presentation" class="active url_title" onClick="url(0)" id="url_title0"><a href="#"><?php echo L('direct_setting');?></a></li>
            <li role="presentation" class="url_title" onClick="url(1)" style="display: none" id="url_title1"><a href="#"><?php echo L('wy_direct');?></a></li>
            <li role="presentation" class="url_title" onClick="url(2)" style="display: none" id="url_title2"><a href="#"><?php echo L('ls_direct');?></a></li>
            <li role="presentation"><a href="<?php echo U('Chat/Setting/open_server');?>"><?php echo L('Chat_Open_Server');?></a></li>
            <li role="presentation"><a href="<?php echo U('Chat/Setting/close_server');?>"><?php echo L('Chat_Close_Server');?></a></li>
        </ul>
        <div class="line_3 bg_white padding_10">
            <div class="row">
                <DIV class="col-md-12 url" id="url0">
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('OPEN');?>
                        </div>
                        <div class="col-md-4">
                            <label class="checkbox-inline"><input name="open" type="radio" value="1" <?php if($direct[open] == 1): ?>checked<?php endif; ?>  data-switch-no-init>
                                <?php echo L('OPEN');?></label><label class="checkbox-inline"><input name="open" type="radio" value="0" <?php if($direct[open] == 0): ?>checked<?php endif; ?>  data-switch-no-init>&nbsp;<?php echo L('CLOSE');?></label>
                        </div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('choose_direct');?>
                        </div>
                        <div class="col-md-4">
                            <label class="checkbox-inline">
                                <input name="choose_direct" id="url_1" type="radio" value="0" onClick="url1(1)"
                                <?php if($direct[choose_direct] == 0): ?>checked<?php endif; ?>
                                data-switch-no-init>&nbsp;<?php echo L('wy_direct');?>
                            </label>
                            <label class="checkbox-inline">
                                <input name="choose_direct" id="url_2" type="radio" value="1" onClick="url1(2)"
                                <?php if($direct[choose_direct] == 1): ?>checked<?php endif; ?>
                                data-switch-no-init>&nbsp;<?php echo L('ls_direct');?>
                            </label>
                        </div>
                    </div>
                </div>
                <!--网易-->
                <DIV class="col-md-12 url" id="url1" style="display: none">
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            APPKEY
                        </div>
                        <div class="col-md-4">
                            <input name="appkey" type="text" class="form-control" value="<?php echo ($direct[appkey]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('APPKEY');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            APPSECRET
                        </div>
                        <div class="col-md-4">
                            <input name="appsecret" type="text" class="form-control" value="<?php echo ($direct[appsecret]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('APPSECRET');?></div>
                    </div>
                </div>
                <!--网易-->
                <!--乐视-->
                <DIV class="col-md-12 url" id="url2" style="display: none">
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('User_id');?>
                        </div>
                        <div class="col-md-4">
                            <input name="ls_userid"  id="ls_userid" type="text" class="form-control" value="<?php echo ($direct[ls_userid]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('User_id');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('UUID');?>
                        </div>
                        <div class="col-md-4">
                            <input name="ls_uuid"  id="ls_uuid" type="text" class="form-control" value="<?php echo ($direct[ls_uuid]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('UUID');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Private_key');?>
                        </div>
                        <div class="col-md-4">
                            <input name="ls_secret" id="ls_secret" type="text" class="form-control" value="<?php echo ($direct[ls_secret]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Private_key');?></div>
                    </div>
                    
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Ls_Sign');?>
                        </div>
                        <div class="col-md-3">
                            <input name="ls_sign"  id="ls_sign" type="text" class="form-control" value="<?php echo ($direct[ls_sign]); ?>" placeholder="">
                        </div>
                        <div class="col-md-1">
                             <button type="button" class="btn btn-success" onClick="create_app()"><?php echo L('Ls_Create_App');?></button>
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Ls_Sign_P');?></div>
                    </div>
                    
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Ls_App_Name');?>
                        </div>
                        <div class="col-md-4">
                            <input name="ls_app_name" id="ls_app_name" type="text" class="form-control" value="<?php echo ($direct[ls_app_name]); ?>" placeholder="">
                        </div>
                    </div>    
                             
                     <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Ls_Push');?>
                        </div>
                        <div class="col-md-4">
                            <input name="ls_push" id="ls_push" type="text" class="form-control" value="<?php echo ($direct[ls_push]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Ls_Push_P');?></div>
                    </div>
                    
                     <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Ls_Pull');?>
                        </div>
                        <div class="col-md-4">
                            <input name="ls_pull" id="ls_pull" type="text" class="form-control" value="<?php echo ($direct[ls_pull]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Ls_Pull_P');?></div>
                    </div>                               
                </DIV>
                <!--乐视-->
            </DIV>
        </div><!--变白区域-->
        <!--内容结束-->
        <div class="padding_10"></div>
        <div align="row">
            <div class="col-md-12 center">
                <button type="submit" class="btn btn-success"><?php echo L('SET');?></button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(
            function()
            {
                if($('input:radio[name="choose_direct"]:checked').val()==0){
                    $("#url_title1").css("display",'block');
                }else if($('input:radio[name="choose_direct"]:checked').val()==1){
                    $("#url_title2").css("display",'block');
                }
                p={template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content red4"></div></div>'};
                $('[data-toggle="popover"]').popover(p)
            }

    );
    function url1(id)
    {
        $(".url_title").removeClass("active");
        $("#url_title"+id).addClass("active");
        if(id==2){
            $("#url_title2").css("display",'block');
            $("#url_title1").css("display",'none');
        }else if(id==1){
            $("#url_title1").css("display",'block');
            $("#url_title2").css("display",'none');
        }

        $(".url").hide("slow");
        $("#url"+id).show("slow");
    }
    function url(id)
    {
        $(".url_title").removeClass("active");
        $("#url_title"+id).addClass("active");
        $(".url").hide("slow");
        $("#url"+id).show("slow");
    }
	
	function create_app()
	{
		 ls_userid=$('#ls_userid').val();
		 ls_uuid=$('#ls_uuid').val();
		 ls_secret=$('#ls_secret').val();

		 URL="<?php echo U('Chat/Ajax/create_app');?>";
         para="{'ls_userid':'"+ls_userid+"','ls_uuid':'"+ls_uuid+"','ls_secret':'"+ls_secret+"'}";
		 para=eval('(' + para + ')');
		 $.getJSON(URL,para,function(json){
			if(json.err==0)
			{
				 $('#ls_sign').val(json.ls_sign)
				 $('#ls_push').val(json.ls_push)
				 $('#ls_pull').val(json.ls_pull)
				 $('#ls_app_name').val(json.ls_app_name)
			}
		 });
	}

</script>
</body>
</html>
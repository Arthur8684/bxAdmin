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
        <ul class="nav nav-tabs">
            <li role="presentation" class="active url_title" onClick="url(0)" id="url_title0"><a href="#"><?php echo L('网站设置');?></a></li>
        </ul>
        <div class="line_3 bg_white padding_10">
            <div class="row">
                <DIV class="col-md-12 url" id="url0">
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Web_title');?>
                        </div>
                        <div class="col-md-4">
                            <input name="title" type="text" class="form-control" value="<?php echo ($config[title]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Web_title');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Web_describe');?>
                        </div>
                        <div class="col-md-4">
                            <input name="describe" type="text" class="form-control" value="<?php echo ($config[describe]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Web_describe');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Web_Keyword');?>
                        </div>
                        <div class="col-md-4">
                            <input name="keyword" type="text" class="form-control" value="<?php echo ($config[keyword]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Web_Keyword_P');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Chat_Web_Model_Name');?>
                        </div>
                        <div class="col-md-4">
                            <select name="model_new" class="form-control">
                              <?php if(is_array($model_info)): foreach($model_info as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"  <?php if($config[model_new] == $v['id']): ?>selected<?php endif; ?> ><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Chat_Web_Model_Name_P');?></div>
                    </div>
                    
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Chat_Web_Server');?>
                        </div>
                        <div class="col-md-4">
                             <input name="server"  type="text" class="form-control" value="<?php echo ($config[server]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Chat_Web_Server_P');?></div>
                    </div>
                                        
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Chat_Web_Port');?>
                        </div>
                        <div class="col-md-4">
                             <input name="port"  type="text" class="form-control" value="<?php echo ($config[port]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Chat_Web_Port_P');?></div>
                    </div>
                    
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Chat_Web_Total_User');?>
                        </div>
                        <div class="col-md-4">
                             <input name="total_user"  type="text" class="form-control" value="<?php echo ($config[total_user]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Chat_Web_Total_User_P');?></div>
                    </div>
                    
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Chat_Web_Room_User');?>
                        </div>
                        <div class="col-md-4">
                             <input name="room_user"  type="text" class="form-control" value="<?php echo ($config[room_user]); ?>" placeholder="">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"><?php echo L('Chat_Web_Room_User_P');?></div>
                    </div>
                    
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('point_type');?>
                        </div>
                        <div class="col-md-11">
                            <?php if(is_array($point_type)): foreach($point_type as $k=>$v): if(C($k.'.status')): ?><label class="checkbox-inline">
                                    <input name="point_type" type="radio" value="<?php echo ($k); ?>" <?php if($config[point_type] == $k): ?>checked<?php endif; ?>  data-switch-no-init>&nbsp;<?php echo C($k.'.name');?>
                                </label><?php endif; endforeach; endif; ?>
                        </div>
                    </div>
                    
                </div>
            </DIV>
        </div>
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
                p={template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content red4"></div></div>'};
                $('[data-toggle="popover"]').popover(p)
            }

    );
    function url(id)
    {
        $(".url_title").removeClass("active");
        $("#url_title"+id).addClass("active");
        $(".url").hide("slow");
        $("#url"+id).show("slow");

    }
</script>
</body>
</html>
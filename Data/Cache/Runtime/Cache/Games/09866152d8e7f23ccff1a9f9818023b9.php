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
            <li role="presentation" class="active url_title" onClick="url(0)" id="url_title0"><a href="#"><?php echo L('基本设置');?></a></li>
        </ul>
        <div class="line_3 bg_white padding_10">
            <div class="row">
                <!--房卡设置start-->
                <DIV class="col-md-12 url" id="url0">
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('set_number'); echo L('setting');?>
                        </div>
                        <div class="col-md-4">
                            <input name="set_number"  type="text" class="form-control" value="<?php echo ($config[set_number]); ?>" placeholder="">
                        </div>
                        <div class="col-md-6 padding_7  font_color_4"><?php echo L('局数设定,以英文‘,’隔开,如果不填则游戏关闭');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('people_number'); echo L('setting');?>
                        </div>
                        <div class="col-md-4">
                            <input name="people_number"  type="text" class="form-control" value="<?php echo ($config[people_number]); ?>" placeholder="">
                        </div>
                        <div class="col-md-6 padding_7  font_color_4"><?php echo L('人数设定,以英文‘,’隔开,如果不填则游戏关闭');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('房间位数');?>
                        </div>
                        <div class="col-md-4">
                            <input name="room_num"  type="text" class="form-control" value="<?php echo ($config[room_num]); ?>" placeholder="">
                        </div>
                        <div class="col-md-6 padding_7  font_color_4"><?php echo L('生成的房间位数,如果不填默认5位');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Room'); echo L('Play');?>
                        </div>
                        <div class="col-md-4">
                            <input name="play" type="text" class="form-control" value="<?php echo ($config[play]); ?>">
                        </div>
                        <div class="col-md-7 padding_7  font_color_4"> <?php echo L('房间玩法,明花、暗花,第一个是默认选项,玩法之间以英文‘,’隔开');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-1 right padding_7 b1 sizefont_14">
                            <?php echo L('Room_card'); echo L('setting');?>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo L('owner');?></span>
                                <input name="owner[price]" type="text" class="form-control" value="<?php echo ($config[owner][price]); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select name="owner[point_type]" class="form-control">
                                <?php if(is_array($point_type)): foreach($point_type as $k=>$v): if(C($k.'.status')): ?><option value="<?php echo ($k); ?>" <?php if($config[owner][point_type] == $k): ?>selected<?php endif; ?>><?php echo C($k.'.name');?></option><?php endif; endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group">
                                <input name="owner[status]"   type="checkbox" value="1" <?php if($config['owner']['status'] == 1): ?>checked<?php endif; ?> data-size="small"  data-on-color="success" data-on-text="<?php echo L('OPEN');?>" data-off-color="warning" data-off-text="<?php echo L('CLOSE');?>" data-handle-width="25" data-label-width="1">
                            </div>
                        </div>
                        <div class="col-md-6 padding_7  font_color_4"><?php echo L('选择房主支付需要扣除的费用,留空或填0则默认不扣费');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-2 col-md-offset-1">
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo L('other');?></span>
                                <input name="other[price]" type="text" class="form-control" value="<?php echo ($config[other][price]); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select name="other[point_type]" class="form-control">
                                <?php if(is_array($point_type)): foreach($point_type as $k=>$v): if(C($k.'.status')): ?><option value="<?php echo ($k); ?>" <?php if($config[other][point_type] == $k): ?>selected<?php endif; ?>><?php echo C($k.'.name');?></option><?php endif; endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group">
                                <input name="other[status]"   type="checkbox" value="1" <?php if($config[other]['status'] == 1): ?>checked<?php endif; ?> data-size="small"  data-on-color="success" data-on-text="<?php echo L('OPEN');?>" data-off-color="warning" data-off-text="<?php echo L('CLOSE');?>" data-handle-width="25" data-label-width="1">
                            </div>
                        </div>
                        <div class="col-md-6 padding_7  font_color_4"><?php echo L('游戏结束每一个玩家需要扣除的点数,留空或填0则默认不扣费');?></div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-2 col-md-offset-1">
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo L('win');?></span>
                                <input name="win[price]" type="text" class="form-control" value="<?php echo ($config[win][price]); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select name="win[point_type]" class="form-control">
                                <?php if(is_array($point_type)): foreach($point_type as $k=>$v): if(C($k.'.status')): ?><option value="<?php echo ($k); ?>" <?php if($config[win][point_type] == $k): ?>selected<?php endif; ?>><?php echo C($k.'.name');?></option><?php endif; endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group">
                                <input name="win[status]"  type="checkbox" value="1" <?php if($config[win]['status'] == 1): ?>checked<?php endif; ?> data-size="small"  data-on-color="success" data-on-text="<?php echo L('OPEN');?>" data-off-color="warning" data-off-text="<?php echo L('CLOSE');?>" data-handle-width="25" data-label-width="1">
                            </div>
                        </div>
                        <div class="col-md-6 padding_7  font_color_4"><?php echo L('游戏结束赢家需要扣除的点数,留空或填0则默认不扣费');?></div>
                    </div>
                </div>
                <!--房卡end-->
            </DIV>
        </div>
        <div class="padding_10"></div>
        <div align="row">
            <div class="col-md-12 center">
                <input type="hidden" value="<?php echo ($id); ?>" name="id"/>
                <input type="hidden" value="<?php echo ($sign); ?>" name="sign"/>
                <button type="submit" class="btn btn-success"><?php echo L('SET');?></button>
            </div>
        </div>
    </form>
</div>
<script>
    var gradeI=0;
    function insertTr(){
        var html='';
        html+='<div class="row padding_7" id="parents_"'+gradeI+'><div class="col-md-2 col-md-offset-1"><div class="input-group"><span class="input-group-addon"><?php echo L("局数");?></span>';
        html+='<input name="match[competition_system_game][]"  type="text" class="form-control" value="" placeholder="">';
        html+='<span class="input-group-addon"><?php echo L("/局");?></span></div></div>';
        html+='<div class="col-md-2"><div class="input-group"><span class="input-group-addon"><?php echo L("淘汰");?></span>';
        html+='<input name="match[competition_system_num][]"  type="text" class="form-control" value="" placeholder="">';
        html+='<span class="input-group-addon"><?php echo L("/人");?></span></div></div>';
        html+='<div class="col-md-2"><button type="button" name="del" onclick="aaa(gradeI)" class="btn btn-success"><?php echo L("删除");?></button></div></div>';
        $("#url1").append(html);
//        $('button[name=del]').click(function(){
//            $(this).parents('#parents').remove();
//        })
        gradeI++;
    }


    function aaa(e){
        $(this).parents('#parents'+e).remove();
    }
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
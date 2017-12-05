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
    <title>数据库</title>
</head>
<body>
<div class="container-fluid">
    <div class="padding_5"></div>
    <form action="/cowcms/index.php/Db/Databases/export" method="post" name="form1" id="form1">
        <!--内容开始-->
        <ul class="nav nav-tabs">
            <li role="presentation" class="active url_title" onClick="url(0)" id="url_title0"><a href="#">数据库导出</a></li>
        </ul>
        <div class="line_3 bg_white padding_10"> <!--变换白色区域-->
            <div class="row">
                <!--数据库导出-->
                <DIV class="col-md-12 url" id="url0" style="display:;">
                    <div class="row padding_7">
                        <!--<div class="col-md-2 right padding_7 b1 sizefont_14">-->
                            <!--<?php echo L('db_name');?>-->
                        <!--</div>-->
                        <div class="col-md-4">
                            <input type="hidden" class="form-control"  value="<?php echo ($db_name); ?>"  name="db_name" readonly>
                        </div>
                    </div>
                    <!--<div class="row padding_7">-->
                        <!--<div class="col-md-2 right padding_7 b1 sizefont_14">-->
                        <!--<?php echo L('bakup_name');?>-->
                        <!--</div>-->
                        <!--<div class="col-md-4">-->
                            <!--<input type="text" class="form-control"  value="<?php echo ($db_name); ?>"  name="bakup_name">-->
                        <!--</div>-->
                    <!--</div>-->
                    <div class="row padding_7">
                        <div class="col-md-2 right padding_7 b1 sizefont_14">
                        <?php echo L('sizelimit');?>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group">
                                <input type="text" class="form-control" value="1024" style="width:60px;" name="size">
                                <div class="input-group-addon">K</div>
                            </div>
                        </div>
                    </div>
                    <div class="row padding_7">
                        <div class="col-md-2 right padding_7 b1 sizefont_14">
                            <?php echo L('remark');?>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="" name="remark" required title="请填写备注信息">
                        </div>
                    </div>

                    <div class="padding_10"></div>
                    <div align="row" style="margin-left:100px;">
                        <?php if(is_array($tabList)): foreach($tabList as $key=>$v): ?><div style="width:200px;float:left;">
                                <label class="checkbox-inline"><input type="checkbox" data-switch-no-init name="tabList[]" value="<?php echo ($v); ?>">
                                <?php echo ($v); ?>
                            </div></label><?php endforeach; endif; ?>
                    </div>

                    <div align="row">
                        <div class="col-md-12 center">
                            <input type="submit"  name="dosubmit" value="<?php echo L('backup_starting');?>" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </DIV>
        </div><!--变换白色区域-->
        <!--内容结束-->
    </form>
</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <META content="IE=9.0000" http-equiv="X-UA-Compatible">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
    <form action="" method="post" name="form1" id="form1">
        <!--内容开始-->
        <ul class="nav nav-tabs">
            <li role="presentation" class="active url_title" onClick="url(0)" id="url_title0"><a href="#">库还原</a></li>
            <li role="presentation" class="url_title" onClick="url(1)" id="url_title1"><a href="#">表还原</a></li>
        </ul>
        <div class="line_3 bg_white padding_10"> <!--变换白色区域-->
            <!--<div class="bottom_line_10 padding_5"></div>-->
            <div class="row">
                <div class="padding_10"></div>
                <!--数据库导出-->
                <DIV class="col-md-12 url" id="url0" style="display:;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover">
                        <thead>
                        <tr>
                            <td width="20%" align="center" valign="middle"><span><?php echo L('backup_file_time');?></span></td>
                            <td width="15%" align="left" valign="middle"><span><?php echo L('sizelimit');?></span></td>
                            <td width="15%" align="center" valign="middle"><span><?php echo L('bundling_file');?>个数</span></td>
                            <td width="30%" align="left" valign="middle"><span><?php echo L('remark');?></span></td>
                            <td width="20%" align="center" valign="middle"><?php echo L('database_op');?></td>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(is_array($databases)): foreach($databases as $key=>$data): ?><tr>
                            <td align="center" valign="middle" id="text"><?php echo ($data['dir']); ?></td>
                            <td align="left" valign="middle" id="text"><?php echo ($data['remark']['content'][0]); ?></td>
                            <td align="center" valign="middle" id="text"><?php echo count($data['file_list']);?></td>
                            <td align="left" valign="middle" id="text"><?php echo ($data['remark']['content'][1]); ?></td>
                            <td align="center" valign="middle">
                                <!--<a href="/cowcms/index.php/Db/Databases/import/filename/<?php echo ($d['filename']); ?>/dir/<?php echo substr($time,-8);?>/type/database" onclick="javascript:return backup()"><?php echo L('backup_import');?></a> /-->
                                <a href="javascript:if(confirm('<?php echo L('backup_import'); echo L('backup_time');?>？'))location='<?php echo U('Db/Databases/jump',array('dir'=>$data['dir'],'type'=>'database'));?>'"><?php echo L('backup_import');?></a>
                                <a href="/cowcms/index.php/Db/Databases/delete/dir/<?php echo ($data['dir']); ?>/type/database" onclick="javascript:return del()" title="<?php echo L('backup_del1');?>"><span class="glyphicon glyphicon-trash  sizefont_16" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo L('del');?>"></span></a>
                                <a href="/cowcms/index.php/Db/Databases/info/dir/<?php echo ($data['dir']); ?>/type/database" title="<?php echo L('info');?>"><span class="glyphicon glyphicon-search sizefont_16" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo L('info');?>" aria-describedby="tooltip429229"></span></a>
                            </td>
                        </tr><?php endforeach; endif; ?>

                        </tbody>
                    </table>

                </div>

                <DIV class="col-md-12 url" id="url1" style="display:none;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover">
                        <thead>
                        <tr>
                            <td width="20%" align="center" valign="middle"><span><?php echo L('backup_file_time');?></span></td>
                            <td width="10%" align="left" valign="middle"><span><?php echo L('sizelimit');?></span></td>
                            <td width="15%" align="center" valign="middle"><span>文件个数</span></td>
                            <td width="35%" align="left" valign="middle"><span><?php echo L('remark');?></span></td>
                            <td width="20%" align="center" valign="middle"><?php echo L('database_op');?></td>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(is_array($tables)): foreach($tables as $key=>$table): ?><tr>
                                <td align="center" valign="middle" id="text"><?php echo ($table['dir']); ?></td>
                                <td align="left" valign="middle" id="text"><?php echo ($table['remark']['content'][0]); ?></td>
                                <td align="center" valign="middle" id="text"><?php echo count($table['file_list']);?></td>
                                <td align="left" valign="middle" id="text"><?php echo ($table['remark']['content'][1]); ?></td>
                                <td align="center" valign="middle">
                                    <a href="/cowcms/index.php/Db/Databases/delete/dir/<?php echo ($table['dir']); ?>/type/table" onclick="javascript:return del()" title="<?php echo L('backup_del1');?>"><span class="glyphicon glyphicon-trash  sizefont_16" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo L('del');?>"></span></a>
                                    <a href="/cowcms/index.php/Db/Databases/info/dir/<?php echo ($table['dir']); ?>/type/table" title="<?php echo L('info');?>"><span class="glyphicon glyphicon-search sizefont_16" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo L('info');?>" aria-describedby="tooltip429229"></span></a>
                                </td>
                            </tr><?php endforeach; endif; ?>

                        </tbody>
                    </table>

                </div>
            </DIV>
        </div><!--变换白色区域-->
        <!--内容结束-->
    </form>
</div>

<script>
    $(document).ready(
        function () {
            p = {template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content red4"></div></div>'};
            $('[data-toggle="popover"]').popover(p)
        }
    );

    function backup(){
        var msg = "<?php echo L('backup_import'); echo L('backup_time');?>？";
        if (confirm(msg)==true){
            return true;
        }else{
            return false;
        }
    }
    function del(){
        var msg = "<?php echo L('backup_del1');?>";
        if (confirm(msg)==true){
            return true;
        }else{
            return false;
        }
    }

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
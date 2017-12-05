<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>邦讯直播平台</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <LINK href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet">
    <SCRIPT src="/cowcms/Public/css_js_font_img/js/jquery.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/js/bootstrap.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/js/switch.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/js/diy.js" type="text/javascript"></SCRIPT>
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/css/chat/index-e.css" type="text/css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/css/chat/mix.css.css" type="text/css">
</head>
<style>
    /*公共开始*/
    body{ margin:0px; font-size:14px; line-height:25px; font-family:"微软雅黑"}
    .clear{ clear:both; height:0px;}
    a{ color:#000}
    .w80{ width:80%}
    .w20{ width:20%}
    .w10{ width:10%}
    .w90{ width:90%}
    .w60{ width:60%}
    .w50{ width:50%}
    .w40{ width:40%}
    .w50{ width:50%}
    .w30{ width:30%}
    .w70{ width:70%}
    .main{
        background:  none;
        position: absolute;
        left: 0px;
        top: 0px;
        filter: alpha(opacity=100);
        opacity: 1 !important;
        z-index:2147483647;
        display:none;
    }
    #canvas{
        display: block;
        opacity:1;
        z-index:150;
    }
    .divBG
    {
        background:  none;
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        filter: alpha(opacity=60);
        opacity: 0.6 !important;
    }
    /*公共结束*公共结束*/
    /*顶部开始*/
    .top{ width:100%; height:80px;background-color: white}
    .top ul,li{  padding:0px; list-style:none}
    .top ul{ width:1002px; margin:0px auto}
    .top ul li{ float:left;}
    .top ul li img{ width:150px; height:80px;}
    .input_text{ height:30px; width:400px; line-height:25px; border-radius: 3px; border:1px solid #CCC; margin-top:20px;}
    .input_button{ height:30px; width:50px; line-height:25px; border-radius: 3px; border: none; margin-left:-50px; margin-top:20px; background:none}
    .top button{ margin-top:20px; height:30px; width:50px; line-height:25px; margin-left:20px;border-radius: 3px; border:none;}
    .w-head{padding: 0px;}
    .w-head-drag{border: 1px solid red}
    /*顶部结束*/
</style>
<body>
<link href="/cowcms/Public/css_js_font_img/css/base.css" rel="stylesheet">
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
<!--顶部开始-->
<div class="top">
	<ul>
    	<!--这里显示网站logo-->
    	<li class="w20"><img src="<?php echo C('site_logo');?>"></li>
        <!--显示网站logo结束-->
        <!--这里显示网站搜索-->
        <li class="w60"><form method="get" action="<?php echo U('Chat/Index/room_list/');?>"><input type="text" name="key_word" value="<?php echo ($key_word); ?>"  class="input_text" placeholder="<?php echo L('Room_name_channel_ID');?>"/><input  type="submit" value="<?php echo L('search');?>" class="input_button"></form></li>
        <!--显示网站搜索结束-->
        <!--这里显示登录注册选项-->
        <li class="w20 top_padding_20">
            <?php if($user['id'] && is_numeric($user['id'])): ?><A href="<?php echo U('User/Index/index');?>" target="_parent" class="btn btn-success  btn-sm "><?php echo L('USER_CENTER');?></A>
            <?php else: ?>
                <A href="<?php echo U('User/login/index');?>" target="_parent" class="btn btn-success  btn-sm "><?php echo L('LOGIN_');?></A> <A href="<?php echo U('User/login/register');?>" target="_parent" class="btn btn-default  btn-sm"><?php echo L('register');?></A><?php endif; ?>
        </li>
        <!--显示登录注册选项结束-->
    </ul>
    <div class="clear"></div>
</div>
<!--顶部结束-->
<div class="w-head w-head-withnav">
    <div class="w-head-nav  isFix">
        <div class="w-head-nav-main">
            <div class="w-head-nav-main-l">
                <ul id="wHeadNav">
                    <li class="cur">
                        <a href="<?php echo U('chat/Index/index');?>" class="t" style="font-weight: normal;"><span><?php echo L('home_page');?></span></a>
                    </li>
                    <script>
                        function showurl(id)
                        {
                            $('#url_'+id).show();
                        }
                        function hideurl(id)
                        {
                            $('#url_'+id).hide();
                        }
                    </script>
                    <?php if(is_array($navs)): foreach($navs as $key=>$val): ?><li class="cur-withsub" onmouseover="showurl(<?php echo ($val[id]); ?>)" onmouseout="hideurl(<?php echo ($val[id]); ?>)">
                               <a  href="<?php echo U('chat/Index/room_list/',array('class_id'=>$val[id]));?>" class="t" ><span><?php echo ($val['name']); ?></span>
                                    <?php if($class_id == $val['id']): ?><i class="line-b" style="visibility: visible;"></i><?php endif; ?>
                                </a>
                            <div style="width: 150%;margin-left:-20px;display: none;" id="url_<?php echo ($val['id']); ?>">
                                <ul style="text-align:center;">
                                    <?php if(is_array($val['child'])): foreach($val['child'] as $key=>$v): ?><li style="clear:both;width: 100%;text-align: center;background-color: #FFFFFF">
                                            <a href="<?php echo U('chat/Index/room_list/',array('class_id'=>$v[id]));?>" style=" cursor: pointer;height: 40px;padding: 0 5px;line-height: 30px;font-size: 14px;color: #373737;"><?php echo ($v['name']); ?></a>
                                        </li><?php endforeach; endif; ?>
                                </ul>
                            </div>
                        </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="wrapper" data-stat-eventid="10008897" data-stat-bak1="game">
    <!-- 1006 -->
    <!-- + body here-->
    <div class="container">
        <!-- others -->
        <div class="column" data-stat-bak2="1005" data-stat-bak3="260">
            <div class="column-hd">
                <h3 class="column-title">
                    <span><i class="icon-"></i><?php echo ($chat_class_name); ?></span>
                </h3>
                <a href="" target="_blank" class="more">更多</a>
            </div>
            <div class="column-bd">
                <ul class="video-list">
                    <?php if(is_array($chat_room_all)): foreach($chat_room_all as $key=>$v): ?><li class="video-item">
                            <a class="video-box" href="<?php echo U('chat/index/room_show/',array('room_id'=>''.$v[id].''));?>" title="<?php echo ($v['title']); ?>" target="_blank">
                                <div class="video-pic">
                                    <div class="video-pic-inner"><div class="pic-default"><img style="width: 100%;" src="<?php echo ($v['anchor_cover']); ?>" alt=""></div>
                                        <div class="pic-real"><img class="lazy" src="<?php echo ($v['anchor_cover']); ?>"/></div></div>
                                    <div class="mask"></div>
                                    <i class="icon-play"></i>
                                </div>
                            </a>
                            <div class="video-info">
                                <p class="video-title"><a target="_blank" href="<?php echo U('chat/index/room_show/',array('room_id'=>$v[id]));?>" ><?php echo ($v['title']); ?></a></p>
                                <div class="audience-count">
                                    <i class="icon-people"></i></div>
                            </div>
                        </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div style="width:300px;margin:0 auto;">
<?php echo ($page_show); ?>
</div>
</body>
</html>
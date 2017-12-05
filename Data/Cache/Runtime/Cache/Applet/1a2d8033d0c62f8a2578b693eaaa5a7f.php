<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>我的应用</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="/cowcms/Public/css_js_font_img/applet/image/public/favicon.ico" type="image/x-icon">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta charset="UTF-8" name="description" content="">
<meta name="keywords" content="">
<meta name="applicable-device" content="pc">

<meta name="baidu_union_verify" content="efbbbd2815b1fdd12b60e3ceac4df149">
<meta property="qc:admins" content="3254342737620130171674576375">
<meta property="wb:webmaster" content="92f74f56cf998861">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="mobile-agent" content="format=xhtml; url=http://m.jisuapp.cn/index.php?r=pc/index/AppHome">
<meta name="mobile-agent" content="format=html5; url=http://m.jisuapp.cn/index.php?r=pc/index/AppHome">
<meta name="mobile-agent" content="format=wml; url=http://m.jisuapp.cn/index.php?r=pc/index/AppHome">
<link rel="alternate" media="only screen and (max-width: 640px)" href="http://m.jisuapp.cn/index.php?r=pc/index/AppHome">
<link rel="canonical" href="http://www.jisuapp.cn/index.php?r=pc/index/AppHome">
<link rel="shortcut icon" href="/cowcms/Public/css_js_font_img/applet/image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/common.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/pc_icomoon.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/myapp.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/app_login_reg.css">
    <script src="/cowcms/Public/css_js_font_img/applet/js/jquery-2.js"></script>
    <!--tg.jisuapp.cn域SEM防恶意点击监控代码-->
    <style type="text/css" id="zoom-set" rel="stylesheet">body {
        zoom: 98.71428571428571%;
    }</style>
</head>
<body class="webapp" is_login="2" is_designer="-1">
<div id="flag" style="display:none;">管理</div>
<!--引入顶部导航-->
    <!-- 顶部导航 -->
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/nav.css">
    <script src="/cowcms/Public/css_js_font_img/applet/js/jquery-1.8.3.min.js"></script>
    <div class="nav-wrap" is_login="0" id="automatic_login">
        <div class="nav-logo">
            <a href="<?php echo C('site_url'); echo C('root_path');?>"><img src="/cowcms/Public/css_js_font_img/applet/image/public/conversation.png"><?php echo C('site_name');?></a>
        </div>
        <!-- 遍历 -->
        <ul class="top-menu" style="position: relative;">
            <li class="menu-one">
                <a href="<?php echo U('Applet/index/index');?>" class="flag">首页</a>
            </li>
            <li class="menu-one">
                <a href="<?php echo U('Applet/Make/index');?>" class="flag">制作</a>
            </li>
            <li class="menu-one">
                <a href="<?php echo U('Applet/Manage/index');?>" class="flag">管理</a>
            </li>
            <li class="menu-one">
                <a href="<?php echo U('Applet/Case/index');?>" class="flag">案例</a>
            </li>
            <li class="menu-one">
                <a href="<?php echo U('Applet/Join/index');?>" class="flag">代理加盟</a>
            </li>
            <li class="menu-one">
                <a href="javascript:;" class="flag">教程论坛</a>
                <ul style="width: 100%">
                    <li class="menu-two"><a href="<?php echo U('Applet/Train/Small_program');?>" target="_blank">小程序培训</a></li>
                    <li class="menu-two"><a href="<?php echo U('Applet/Train/Development_Forum');?>" target="_blank">开发论坛</a></li>
                    <li class="menu-two"><a href="<?php echo U('Applet/Train/Introduction_course');?>" target="_blank">入门教程</a></li>
                    <li class="menu-two"><a href="<?php echo U('Applet/Train/Video_course');?>" target="_blank">视频教程</a></li>
                </ul>
            </li>
            <li class="menu-one">
                <a href="javascript:;" class="flag">产品中心</a>
                <ul style="width: 100%">
                    <li class="menu-two"><a href="/cowcms/index.php/Applet/Product/Functions" target="_blank">功能介绍</a></li>
                    <li class="menu-two"><a href="/cowcms/index.php/Applet/Product/Customized" target="_blank">官方订制</a></li>
                </ul>
            </li>
            <li class="menu-one">
                <a href="/cowcms/index.php/Applet/About/index" class="flag">关于我们</a>
            </li>

            <div class="nav_line" style="position: absolute; height: 2px; background: rgb(48, 145, 242) none repeat scroll 0% 0%; top: 54px; z-index: 0; width: 94px; left: 0px;"></div>
        </ul>
        <div class="nav-login" style="display:;">
            <p class="login-span-wrap">
                <a href="/cowcms/index.php/Applet/Login/sign_in"><span class="nav-lglogin"><?php echo L('LOGIN_');?></span></a>
                <a href="/cowcms/index.php/Applet/Login/register"><span class="nav-reg"><?php echo L('REGISTER_');?></span></a>
            </p>
        </div>
        <div class="nav-login" style="display:none;">
            <div class="menu-one nav-center">
                <a href=""><img class="nav-img" src="/cowcms/Public/css_js_font_img/applet/image/public/portrait.jpg">
                    18734836545
                </a>
                <ul is_designer="-1">
                    <li class="menu-two"><a href="1" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">个人中心</a>
                    </li>
                    <li class="menu-two"><a href="">代理管理</a></li>
                    <li class="menu-two"><a href="">安全中心</a></li>
                    <li class="menu-two"><a href="">退出</a></li>
                </ul>
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/app_login_reg.css">
    <div class="lr-mask" id="login_wrap" user_token="">
        <div class="lr" id="login-panel">
            <div class="lr-left">
                <div class="reg-wrap">
                   <img src="/cowcms/Public/css_js_font_img/applet/image/toreg.png">
                   <div class="to-reg">注册</div>
                </div>
                <div class="login-wrap">
                   <img src="/cowcms/Public/css_js_font_img/applet/image/tologin.png">
                   <div class="to-login">登录</div>
                </div>
            </div>
            <div class="lr-right">
                <div class="login-info-wrap" style="padding-top: 34px;">
                    <div class="title">登录<span>(个人/企业账号)</span></div>
                    <input style="margin-top: 60px;" id="login-username" placeholder="邮箱/手机号" class="long-input" type="text">
                    <input style="margin-top: 20px;" id="login-password" placeholder="请输入6-20位密码" class="long-input" type="password">
                    <div class="Rempw"><input id="remberPw" type="checkbox"><label for="remberPw">记住密码</label><span class="forgetPw">忘记密码</span></div>
                    <div id="login-btn" class="login-btn">登录</div>
                    <p style="padding: 10px 0;">还没有账号？<span class="reg-now">免费注册</span></p>
                    <div style="margin-top: 10px;">
                        <span class="cross-Line"></span>
                        <span style="margin: 0 10px;font-size: 16px;">第三方账号登录</span>
                        <span class="cross-Line"></span>
                    </div>
                    <div class="img-qq">
                        <a class="login-wx" href="javascript:;"><img title="微信" src="/cowcms/Public/css_js_font_img/applet/image/wx.png"></a>
                        <a class="login_qq" href="http://www.zhichiwangluo.com/index.php?r=Login/qLogin"><img title="QQ" src="/cowcms/Public/css_js_font_img/applet/image/qq.png"></a>
                        <a class="login_qq" href="http://www.jisuapp.cn/index.php?r=login/WBLogin"><img title="微博" src="/cowcms/Public/css_js_font_img/applet/image/wb.png"></a>
                    </div>
                </div>
                <div class="wx-login">
                    <div class="title">微信登录</div>
                    <img class="code-img" src="">
                    <p style="text-align: center;">
                        <span class="cross-Line"></span>
                        微信扫码登录
                        <span class="cross-Line"></span>
                    </p>
                    <p class="account-login" style="margin-top: 30px;text-align: center;color: #3091f2;cursor: pointer;">返回账号登陆</p>
                </div>
                <div class="reg-info-wrap">
                    <div class="reg-type"><span class="active">个人注册</span><span>企业注册</span></div>
                    <div class="person-reg">
                        <img class="code-img" src="" alt="">
                        <p style="text-align: center;">
                            <span style="width:55px;" class="cross-Line"></span>
                            <span style="margin: 0 5px;">微信扫码注册</span>
                            <span style="width:55px;" class="cross-Line"></span>
                        </p>
                        <div class="perfit-info">
                            <input style="margin-top: 60px;" id="perfit-phone" placeholder="手机号" class="long-input" type="text">
                            <input placeholder="密码" id="perfit-pw1" class="long-input" type="password">
                            <input placeholder="确认密码" id="perfit-pw2" class="long-input" type="password">
                            <input placeholder="验证码" id="perfit-pic-code" style="width:70px;vertical-align: top;margin-top: 12px;" type="text"><div class="getPicCode" style="display: inline-block;margin-top: 7px;"><img class="pic-code" src="/cowcms/Public/css_js_font_img/applet/html/index.htm"><span>看不清，换一张</span></div>
                            <input placeholder="短信验证码" id="perfit-code" style="width: 177px" type="text"><span class="getPerfitCode">获取验证码</span>
                            <input placeholder="邀请码，可不填" id="perfit-invite" class="long-input" type="text">
                            <div class="login-btn" id="perfit-info">完善</div>
                        </div>
                    </div>
                    <div class="company-reg">
                        <input id="reg-fullname" placeholder="企业名称" class="long-input" type="text"><!-- <label class="necessary">*</label> -->
                        <input id="reg-phone" placeholder="手机号" class="long-input" type="text"><img style="width: 20px;vertical-align: middle;margin-left: 10px;" id="reg-phone-exist"><!-- <label class="necessary">*</label> -->
                        <input class="reg-password long-input" placeholder="密码" type="password"><!-- <label class="necessary">*</label> -->
                        <input class="reg-conpassword long-input" placeholder="确认密码" type="password"><!-- <label class="necessary">*</label> -->
                        <input placeholder="验证码" id="pic-code" style="width:70px;vertical-align: top;margin-top: 12px;" type="text"><div class="getPicCode" style="display: inline-block;margin-top: 7px;"><img class="pic-code" src="/cowcms/Public/css_js_font_img/applet/html/index.htm"><span>看不清，换一张</span></div>
                        <input id="phone-code" placeholder="短信验证码" class="short-input" style="margin-top: 15px;width: 146px;" type="text"><span class="getPhoneCode">获取验证码</span>
                        <select id="reg-company-type">
                              <option value="政府机构" selected="selected">政府机构</option>
                              <option value="微信">微信</option>
                              <option value="传媒广告">传媒广告</option>
                              <option value="电商">电商</option>
                              <option value="餐饮">餐饮</option>
                              <option value="家具">家具</option>
                              <option value="IT">IT</option>
                              <option value="教育">教育</option>
                              <option value="房地产">房地产</option>
                              <option value="服装">服装</option>
                              <option value="婚庆">婚庆</option>
                              <option value="娱乐">娱乐</option>
                              <option value="旅游">旅游</option>
                              <option value="汽车">汽车</option>
                              <option value="美容">美容</option>
                              <option value="摄影">摄影</option>
                              <option value="公益">公益</option>
                              <option value="金融">金融</option>
                        </select>
                        <div>
                            <select id="province-select"><option disabled="disabled" selected="selected">选择省</option></select>
                            <select id="city-select"><option disabled="disabled" selected="selected">选择市</option></select>
                            <select id="area-select"><option disabled="disabled" selected="selected">选择区</option></select>
                        </div>
                        <div style="margin-top: 15px;">
                            <input id="inviteCode" class="short-input" placeholder="邀请码，可不填">
                            <span class="reg-btn">注册</span>
                        </div>
                    </div>
                </div>
                <div class="findBackPw">
                    <div class="title">
                        <span class="findtype" type="phone">手机找回</span>
                        <span class="changetype">通过邮箱找回</span>
                    </div>
                    <div class="findByPhone">
                        <div>
                            <input style="margin-top: 60px;width: 265px;" id="by-phone" class="account long-input" placeholder="注册手机号" type="text">
                            <img style="width: 20px;vertical-align: middle;margin-left: 10px;" id="find-phone-exist">
                        </div>
                        <input id="phone-code-input" class="short-input" placeholder="短信验证码" type="text"><span class="get-Phone-Code">获取验证码</span>
                        <input id="PnewPw1" class="long-input" placeholder="新密码" type="password">
                        <input id="PnewPw2" class="long-input" placeholder="确认密码" type="password">
                        <input placeholder="验证码" id="findby-pic-code" style="width:70px;vertical-align: top;margin-top: 12px;" type="text"><div class="getPicCode" style="display: inline-block;margin-top: 7px;"><img class="pic-code" src="/cowcms/Public/css_js_font_img/applet/html/index.htm"><span>看不清，换一张</span></div>
                        <div style="margin-top: 25px;" id="findByPhoneReset" class="login-btn">确认</div>
                        <p class="login-now" style="margin-top: 30px;text-align: center;color: #3091f2;cursor: pointer;">我想起来了，去登录 &gt;</p>
                    </div>
                    <div class="findByEmail" style="display: none;">
                        <input style="margin-top: 60px;" id="by-email" class="account long-input" placeholder="绑定邮箱" type="text">
                        <input id="email-code-input" class="short-input" placeholder="邮箱验证码" type="text"><span class="getCode">获取验证码</span>
                        <input id="EnewPw1" class="long-input" placeholder="新密码" type="password">
                        <input id="EnewPw2" class="long-input" placeholder="确认密码" type="password">
                        <div style="margin-top: 25px;" id="findByEmailReset" class="login-btn">确认</div>
                        <p class="login-now" style="margin-top: 30px;text-align: center;color: #3091f2;cursor: pointer;">我想起来了，去登录 &gt;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--标记-->
    <script>
        flag=$('#flag').html();
//        alert(flag);
        list=$('.flag');
//        alert(list);
        left='';
        list.each(function(){
            if(flag==$(this).html()){
                switch($(this).html()){
                    case '首页':
                        $('.nav_line').css('left','0px');
                        break;
                    case '制作':
                        $('.nav_line').css('left','80px');
                        break;
                    case '管理':
                        $('.nav_line').css('left','165px');
                        break;
                    case '案例':
                        $('.nav_line').css('left','250px');
                        break;
                    case '代理加盟':
                        $('.nav_line').css('left','330px');
                        break;
                    case '教程论坛':
                        $('.nav_line').css('left','435px');
                        break;
                    case '产品中心':
                        $('.nav_line').css('left','520px');
                        break;
                    case '关于我们':
                        $('.nav_line').css('left','610px');
                        break;
                }
            }
        })
    </script>

<div class="container">
    <div class="top_manage_info">
        <div class="top_info">
            <div class="user_info">
                <div class="user_info_img">
                    <div class="cover_img">
                        <img class="portrait" src="/cowcms/Public/css_js_font_img/applet/image/manage/portrait.jpg">
                    </div>
                    <div class="data_info">
                        <p class="app_info data_item"><b id="app-amount">3</b>小程序</p>
                        <p class="app_view data_item"><b id="app-view-amount">0</b>浏览量</p>
                    </div>
                </div>
                <div class="user_info_text">
                    <p class="p_nickname">
                        <span class="nickname">18734836545</span>
                        <a href="">
                            <lable class="user_lable">
                                体验版
                            </lable>
                        </a>
                    </p>
                    <div class="p_balance">
                        <p><span class="icon-money"><svg class=""><use xlink="http://www.w3.org/1999/xlink"
                                                                       xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-weibi"></use></svg></span><span
                                class="money-title">微币</span>：<span id="balance">0</span></p>
                    </div>
                    <p class="p_methods">
                    </p>
                    <a class="person_center"
                       href="http://www.jisuapp.cn/index.php?r=pc/IndexNew/showUserInfo&amp;is_app=1">个人中心</a>
                </div>
            </div>
            <a class="latest_announcement" href="http://www.jisuapp.cn/index.php?r=pc/IndexNew/MessageNoticeShow"
               target="_blank">
                <p class="announcement_header">最新公告</p>
                <div class="announcement_content_wrap">
                    <ul class="announcement_content" style="animation-duration: 87s;">
                        <li><span class="item-title">#奶牛网络首届小程序制作创意大赛#</span>  <span class="item-content">万元奖品悬赏，寻找小程序高手<br>随手做个小程序，轻松拿下万元奖<br>【征稿时间】2017年8月4日-11月10日</span>
                        </li>
                        <li><span class="item-title">#营销工具 拼团#</span>  <span class="item-content">多人在线拼团，打造营销闭环</span>
                        </li>
                        <li><span class="item-title">#管理后台 行为事件#</span>  <span class="item-content">即使应用开发平台，加入开发者行列，发挥出您的才华</span>
                        </li>
                        <li><span class="item-title">#高级组件 分享功能#</span>  <span class="item-content">商品详情页新增转发按钮，满足用户在线分享商品的需求。</span>
                        </li>
                        <li><span class="item-title">#管理后台 商品库存优化#</span>  <span
                                class="item-content">商品订单退款或关闭，库存可以恢复</span></li>
                        <li><span class="item-title">#营销工具 秒杀功能#</span>  <span class="item-content">营销利器秒杀功能共用原始商品库存，后台可以跟进需求关闭秒杀商品状态</span>
                        </li>
                        <li><span class="item-title">#营销工具 集集乐#</span>  <span class="item-content">集集乐和优惠券结合使用，消费的每一笔金额累积达到指定次数后可获得优惠券奖励</span>
                        </li>
                        <li><span class="item-title">#官网 小程序商城改版2.0#</span>  <span class="item-content">小程序商城整体改版2.0上线了，点击首页案例集查看更多</span>
                        </li>
                        <li><span class="item-title">#高级组件 外卖#</span>  <span
                                class="item-content">外卖店铺信息，多级分类、外卖订单播报等功能</span></li>
                        <li><span class="item-title">#营销工具 优惠券2.0#</span>  <span class="item-content">新增：4种优惠券类型代金券、兑换券、储值券、通用券；编辑页组件调用优惠券领取列表功能，修改优惠券无须重新上传代码；商家后台赠送优惠券给用户的功能；新增优惠券分享功能；管理后台查看用户领用优惠券数据功能；线下核销功能等。</span>
                        </li>
                        <li><span class="item-title">#高级组件 社区组件优化#</span>  <span class="item-content">上线小程序，用户使用社区发帖时可以编辑、删除帖功能</span>
                        </li>
                        <li><span class="item-title">#高级组件 外卖优化#</span>  <span
                                class="item-content">外卖组件提高点击响应速度，提升用户体验</span></li>
                        <li><span class="item-title">#新功能 支付宝小程序#</span>  <span class="item-content">即
速应用-全国首家接入支付宝小程序的开发工具，拥有强大的小程序管理系统。多种核心功能：电商、预约、外卖、资讯、到店、多商家等；多种营销工具：秒杀、
拼团、优惠券、余额&amp;储值等；还有城市定位、一键上传小程序、个人中心等多种功能。详情见教程，提前布局支付宝新生态，抢占第一波红利。</span></li>
                        <li><span class="item-title">#小程序 即速应用商家版2.0#</span>  <span class="item-content">新增用户管理、商品管理、订单优化、多商家版本、优惠券核销、WiFi小票机打印等功能，实现移动智能化管理您的店铺。</span>
                        </li>
                        <li><span class="item-title">#官网 官网改版2.0#</span>  <span class="item-content">奶牛网络导航、首页、小程序应用管理页面、关于我们（设计大赛、服务支持、媒体报导、代理查询）进行2.0改版，问题和疑问直接点击官网客服进行反馈。</span>
                        </li>
                        <li><span class="item-title">#其他组件 动态容器#</span>  <span class="item-content">新增功能：1、应用数据管理的字段新增外键关联“电商”“预约”“到店”的商品和多条数据；2、动态容器新增跳转页面功能。满足您文章推广商品等场景需求。</span>
                        </li>
                        <li><span class="item-title">#官网 微官网#</span>  <span class="item-content">即速应用-小程序微官网为适应移动客户端浏览体验与交互性能要求的新一代网站上线了，欢迎点击链接体验。</span>
                        </li>
                        <li><span class="item-title">#奶牛网络精品小程序体验官活动#</span>  <span class="item-content">多个福利免费赠送，助力打造精品小程序</span>
                        </li>
                        <li><span class="item-title">#营销工具 大转盘#</span>  <span class="item-content">大转盘是通过轮盘抽奖的方式，让用户参与有门槛的获取奖励的活动，不仅可以增加与用户之间的趣味性，且提高了优惠券等发放的门槛，提高用户和小程序之间的黏度，点击教程链接学习和使用。</span>
                        </li>
                    </ul>
                </div>
            </a>
        </div>
    </div>
    <div class="my-app-wrap">
        <ul class="app-container no-more" id="app-container">
            <li class="add" is-vip="0" >
                <img src="/cowcms/Public/css_js_font_img/applet/image/manage/add_new.svg" alt="">
                <p>创建新小程序</p>
            </li>
            <li class="info" data-vend_status="0" data-vend_price="null" data-id="t52CdG7CBI"
                data-logo="http://cdn.jisuapp.cn/zhichi_frontend/static/invitation/images/logo.png" data-desc="">
                <div class="info-top">
                    <div class="tool-show" style="display: none;">
                        <div class="menu_bar"><span class="qrcode"><svg class=""><use
                                xlink="http://www.w3.org/1999/xlink"
                                xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-qrcode"></use></svg><span
                                class="share_code">扫码分享</span></span><span class="share"><svg class=""><use
                                xlink="http://www.w3.org/1999/xlink"
                                xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-share"></use></svg><span
                                class="share_link" style="display: none;">查看链接</span></span><span class="transfer"><svg
                                class=""><use xlink="http://www.w3.org/1999/xlink"
                                              xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-transform"></use></svg><span
                                class="transfer_app">转让应用</span></span><span class="copy"><svg class=""><use
                                xlink="http://www.w3.org/1999/xlink"
                                xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-copy"></use></svg><span
                                class="copy_app">复制小程序</span></span>
                            <span
                                    class="delete"><svg class=""><use xlink="http://www.w3.org/1999/xlink"
                                                                      xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-delete"></use></svg><span
                                    class="delete_app">删除应用</span></span></div>
                        <div class="qrcode_div"><img
                                src="/cowcms/Public/css_js_font_img/applet/image/manage/190965a576a18d2f68aa5ab90ddd70941.png"></div>
                        <div class="share_div" style="display: none;"><input id="sharelink0" class="sharelink"
                                                                             value="http://u2237173.jisuwebapp.com/app?_app_id=t52CdG7CBI"
                                                                             type="text">
                            <div class="copy_link" data-clipboard-action="copy" data-clipboard-target="#sharelink0">复制
                            </div>
                            <div class="truecopy"></div>
                        </div>
                    </div>
                    <img class="info-pic" src="/cowcms/Public/css_js_font_img/applet/image/manage/share_feng_002.jpg"></div>
                <div class="info-bottom"><span class="put-in-front active"><svg class=""><use
                        xlink="http://www.w3.org/1999/xlink"
                        xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-star"></use></svg></span><a
                        href="http://www.jisuapp.cn/index.php?r=pc/AppMgr/manager&amp;_app_id=t52CdG7CBI"
                        target="_blank"><p class="app_name">我的小程序</p>
                    <p class="app_intro"></p></a>
                    <p class="info-title">
                        <label class="detail">
                            <span class="add_time">
                                <svg class="">
                                    <use xlink="http://www.w3.org/1999/xlink" xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-time"></use>
                                </svg>
                            </span>
                            2017-10-27
                        </label>
                        <label class="viewCou">
                            <span class="prev_count">
                                <svg class="">
                                    <use xlink="http://www.w3.org/1999/xlink" xlink:href="/zhichi_frontend/static/pc/index/symbol-svg/symbol-btn.svg#icon-view"></use>
                                </svg>
                            </span>
                            0
                        </label>
                    </p>
                </div>
                <div class="btn_bar">
                    <span>
                        <a class="edit_btn" target="_blank" href="<?php echo U('Applet/Edit/index');?>">编辑</a>
                    </span>
                    <span>
                        <a class="massage_btn" target="_blank" href="">管理</a>
                    </span>
                    <span>
                        <a class="prev_btn" target="_blank" href="<?php echo U('Applet/Preview/index');?>">预览</a>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>

<!--引入底部-->
    <!-- 底部 -->
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/news_footer.css">
    <div class="news-footer-wrap">
        <div class="news-footer">
            <div class="company-logo">
                <img src="/cowcms/Public/css_js_font_img/applet/image/public/company_logo.jpg" alt="奶牛公司logo">
            </div>
            <div class="company-info">
                <!-- 友情链接 -->
                <div class="footer-nav-list">
                    <a href="" target="blank">微信小程序</a>
                    <span class="nav-item-border"></span>
                    <a href="" target="blank">公司简介</a>
                </div>
                <div class="address">
                    公司地址：<?php echo L('COMPANY_ADDRESS');?>
                </div>
                <div class="statement">
                    <?php echo L('COMPANY_NAME');?>©2015 奶牛网络 <a href="/" target="blank">粤ICP备16110707号</a>
                </div>
            </div>
            <div class="company-ewma">
                <img src="/cowcms/Public/css_js_font_img/applet/image/public/4928c88bbcf1e600cb9eca846d686a68.png" alt="奶牛公司二维码">
                <span>扫微信关注我们吧</span>
            </div>
        </div>
    </div>
<!-- 悬浮窗 -->
<div class="nav_top">
      <span class="nav_help">
          <a href="" target="_blank">
              <span class="use">
                  <img src="/cowcms/Public/css_js_font_img/applet/image/make/nav1.png" alt="" style="margin:-5px 0 0 -4px;">
              </span>
              <span class="help-tip">新手教程</span>
          </a>
      </span>
    <span class="nav_video">
          <a href="" target="_blank">
              <span class="use">
                  <img src="/cowcms/Public/css_js_font_img/applet/image/make/nav2.png" alt="" style="margin:-5px 0 0 -4px;">
              </span>
              <span class="video-tip">视频教程</span>
          </a>
      </span>
    <span class="scrollTop">
          <span class="use">
              <img src="/cowcms/Public/css_js_font_img/applet/image/make/nav3.png" alt="">
          </span>
      </span>
</div>

<!-- 申请出售模板 的模态框-->
<div id="apply-template-dialog" class="zhichi-dialog">
    <div class="zhichi-content"
         style="width: 600px; height: 390px; min-height: 150px; margin-left: -300px; margin-top: -195px;">
        <header class="zhichi-title"><span class="zhichi-title-content">申请出售模板</span><span class="zhichi-close">×</span>
        </header>
        <!-- 模版上架设置 -->
        <div id="template-set-wrap">
            <div>
                <img src="/cowcms/Public/css_js_font_img/applet/image/manage/share_feng.jpg" class="inv-cover" id="template-cover">
                <p style="color:#8e91a2;">模版封面</p>
            </div>
            <div class="template-form">
                <p>价格：<input id="template-price" placeholder="价格在500～2000之内" type="text">
                    电话：<input id="template-tel" placeholder="输入您的联系电话/手机" type="text"></p>
                <p>分类：
                    <select id="template-cates">
                        <option value="1" selected="selected">常用</option>
                        <option value="41">多商家</option>
                        <option value="25">电商</option>
                        <option value="55">外卖</option>
                        <option value="17">美食</option>
                        <option value="19">婚庆</option>
                        <option value="23">房产</option>
                        <option value="24">鲜花</option>
                        <option value="34">酒店</option>
                        <option value="36">KTV</option>
                        <option value="44">社会</option>
                        <option value="45">超市</option>
                        <option value="51">公司</option>
                        <option value="18">珠宝</option>
                        <option value="20">旅游</option>
                        <option value="21">运动</option>
                        <option value="22">美容</option>
                        <option value="26">家居</option>
                        <option value="27">农产品</option>
                        <option value="28">医药</option>
                        <option value="29">母婴</option>
                        <option value="30">教育</option>
                        <option value="31">摄影</option>
                        <option value="33">社区</option>
                        <option value="37">汽车</option>
                        <option value="39">资讯</option>
                        <option value="40">金融</option>
                        <option value="43">家政</option>
                        <option value="46">票务</option>
                        <option value="47">洗浴</option>
                        <option value="49">工具</option>
                        <option value="54">保险</option>
                        <option value="12">单页</option>
                    </select>
                </p>
                <p>简介：<input id="template-desc" placeholder="不超过50个字符" type="text"></p>
            </div>
            <ol class="template-tip">
                <li>
                    <p style="margin: 0px;">样例须交互完整，体验顺畅；您提交的模板，我们将在5个工作日内审核完毕，请您耐心等待；通过之后，收入我们采取4：6的分成比例（所有者占60%）。</p>
                </li>
                <li>内容正面，不造谣，不传谣，不侵权，不攻击，不欺诈，不色情，不植入广告。</li>
                <li>产品类注意版权，产品图一经版权举报会被撤销样例。</li>
                <li>模板上架审核通过后将不能进行修改，也不能下架。</li>
            </ol>
        </div>
        <span class="zhichi-submit-btn">提交审核</span></div>
</div>
<!-- 是否是设计师的认证模态框-->
<div id="sale-app-tip" class="zhichi-dialog">
    <div class="sale-tip-container">
        <div class="header">
            <span>提示信息</span>
            <span class="zhichi-close">×</span>
        </div>
        <div class="content">
            <p>您还未成为设计师，不能出售模板!</p>
            <p><a>取消</a><a href="http://www.jisuapp.cn/index.php?r=pc/Designer/ShowApply&amp;is_app=1" target="_blank">认证</a>
            </p>
        </div>
    </div>
</div>
<!-- 转让 -->
<meta charset="utf-8">
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .transfer-div {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999999;
        overflow: hidden;
        border-radius: 5px;
    }

    .transfer-panel {
        position: relative;
        top: 50%;
        left: 50%;
        width: 330px;
        height: 240px;
        margin-left: -165px;
        margin-top: -120px;
        background-color: #fff;
        text-align: center;
        overflow: hidden;
        border-radius: 5px;
    }

    .transfer-title {
        color: #4d4d4d;
        font-size: 24px;
        padding: 16px 0 13px;
    }

    .transfer-tip {
        color: #727272;
        font-size: 14px;
        margin: 0;
    }

    .transfer-email {
        margin: 23px 0;
    }

    .transfer-email input {
        height: 35px;
        width: 280px;
        text-indent: 5px;
        border-radius: 2px;
        line-height: 35px;
        border: 1px solid #afafaf;
    }

    .transfer-panel button {
        height: 33px;
        width: 100px;
        margin: 0 10px;
        background-color: #fff;
        border-radius: 2px;
    }

    .transfer-cancel-btn {
        border: 1px solid #afafaf;
        color: #4d4d4d;
    }

    .transfer-panel .transfer-sure-btn {
        background-color: #3091f2;
        border: 1px solid #3091f2;
        color: #fff;
    }

    .webapp .transfer-panel .transfer-sure-btn {
        background-color: #f1c130;
        border: 1px solid #f1c130;
        color: #fff;
    }
</style>
<div class="transfer-div" id="transfer-div">
    <div class="transfer-panel">
        <div class="transfer-title">转让</div>
        <p class="transfer-tip">请复制后转让</p>
        <p class="transfer-tip">以免带来不必要的麻烦</p>
        <div class="transfer-email">
            <input id="transferUser" placeholder="请输入接收方邮箱或手机" type="text">
        </div>
        <div>
            <button class="transfer-cancel-btn">取消</button>
            <button class="transfer-sure-btn">转让</button>
        </div>
    </div>
</div>
<script>
    function transferToUser(id, type, callback) {
        // type 0是微页， 1是app
        if (type == 1) {
            $('#transfer-div .transfer-title').text('webapp转让');
        } else {
            $('#transfer-div .transfer-title').text('微页转让');
        }
        ;
        $('#transferUser').focus();
        var url = ['/index.php?r=pc/InvitationNew/TransferInvUser', '/index.php?r=pc/AppData/TransferAppUser'];
        $('#transfer-div').show();
        $('#transfer-div .transfer-sure-btn').on('click', function () {
            var username = $('#transferUser').val().trim(),
                regE = /^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            regP = /^1\d{10}/;
            if (!username) {
                alertTip('请输入接收方邮箱或手机');
                $('#transferUser').focus();
                return;
            }
            ;
            if (!regE.test(username) && !regP.test(username)) {
                alertTip("请输入正确的邮箱或手机！");
                return;
            }
            $.ajax({
                url: url[type],
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    username: username,
                },
                success: function (data) {
                    if (data.status != 0) {
                        alertTip(data.data);
                        return;
                    }
                    ;
                    alertTip('转让成功');
                    $('#transfer-div').hide();
                    callback();
                },
                error: function (data) {
                    alertTip(data.data);
                    return;
                },
            })
        });
        $('#transfer-div .transfer-cancel-btn').click(function () {
            $('#transfer-div').hide();
        });
    }

</script>
<!-- 转让 -->
<style type="text/css">
    .shield-panel, .appeal-panel {
        display: none;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: fixed;
        background-color: rgba(0, 0, 0, .6);
        z-index: 99999;
    }

    .main {
        position: relative;
        top: 50%;
        width: 700px;
        height: 400px;
        margin: -200px auto 0;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;

    }

    .title {
        padding: 10px 20px;
        background-color: #f0f0f0;
        color: #272727;
        font-size: 18px;
    }

    .close {
        float: right;
        font-size: 30px;
        text-align: center;
        line-height: 25px;
        cursor: pointer;
    }

    .main img {
        width: 80px;
        vertical-align: middle;
    }

    .context {
        padding-left: 50px;
    }

    .context > p {
        padding: 10px 0;
    }

    .context > p > span:nth-child(1) {
        display: inline-block;
        width: 80px;
        line-height: 22px;
        text-align: right;
    }

    .context > p > span:nth-child(2) {
        margin-left: 30px;
    }

    .preview, .edit {
        color: #797979;
        text-decoration: underline;
        margin-right: 15px;
    }

    .check, #to-appeal {
        float: right;
        display: inline-block;
        width: 90px;
        height: 30px;
        margin-left: 30px;
        cursor: pointer;
        border: 1px solid #78809f;
        text-align: center;
        line-height: 30px;
    }

    .shield-btn {
        padding: 0 60px;
    }

    .appeal-form {
        text-align: center;
        font-size: 18px;
    }

    .appeal-form input {
        width: 240px;
        height: 30px;
        margin-top: 30px;
    }

    .appeal-form textarea {
        width: 240px;
        resize: none;
        height: 80px;
        vertical-align: top;
    }

    .appeal-btn {
        text-align: center;
        margin-top: 30px;
    }

    .appeal-btn span {
        display: inline-block;
        text-align: center;
        width: 120px;
        height: 35px;
        line-height: 35px;
        border-radius: 2px;
        cursor: pointer;

    }

    .appeal-btn .submit-appeal {
        background: #FDB400;
        color: #fff;
    }
</style>
<!-- 屏蔽 -->
<div class="shield-panel" id="shield-panel">
    <div class="main">
        <p class="title">提示信息<span class="close">×</span></p>
        <div style="text-align: center;font-size: 20px;padding: 20px 0;"><img
                src="/cowcms/Public/css_js_font_img/applet/image/manage/shield.png">您的小程序涉及敏感词汇，违反微信规定，已被屏蔽
        </div>
        <div class="context" style="padding-left: 50px;">
            <p><span>违规小程序</span><span class="shield-id"></span></p>
            <p><span>具体原因</span><span class="shield-reason"></span></p>
            <p style="color: red;"><span>申诉要求</span><span>请去除违规内容后再申诉！申诉将在三个工作日内处理。</span></p>
            <p><span>联系QQ</span><span>3422158815</span></p>
        </div>
        <div class="shield-btn"><a class="preview" target="_blank" href="">预览</a><a class="edit" target="_blank"
                                                                                    href="">编辑</a><a class="check"
                                                                                                     target="_blank"
                                                                                                     href="http://bbs.zhichiwangluo.com/forum.php?mod=viewthread&amp;tid=11178">查看</a><span
                id="to-appeal">申诉</span></div>
    </div>
</div>
<!-- 申诉 -->
<div class="appeal-panel" id="appeal-panel">
    <div class="main">
        <p class="title">小程序申诉<span class="close">×</span></p>
        <div class="appeal-form">
            <div><label><span style="color: red;">*</span>您的称呼：</label><input id="appeal-name" name="" type="text">
            </div>
            <div><label><span style="color: red;">*</span>联系方式：</label><input id="appeal-phone" name="" type="text">
            </div>
            <div style="margin-top: 30px;"><label><span style="color: red;">*</span>申诉原因：</label><textarea
                    id="appeal-reason"></textarea></div>
        </div>
        <div class="appeal-btn"><span class="cancel-appeal">取消</span><span class="submit-appeal">提交</span></div>
    </div>
</div>
<script type="text/javascript">
    $('#shield-panel').on('click', '#to-appeal', function () {
        $('#shield-panel').hide().siblings('#appeal-panel').show();
    }).on('click', '.close', function () {
        $('#shield-panel').hide();
    });

    $('#appeal-panel').on('click', '.close, .cancel-appeal', function () {
        $('#appeal-panel').hide();
    }).on('click', '.submit-appeal', function () {
        var name = $('#appeal-name').val(),
            phone = $('#appeal-phone').val(),
            reason = $('#appeal-reason').val(),
            regp = /^1\d{10}$/,
            regT = /^0\d{2,3}-?\d{7,8}$/;
        if (!name) {
            alertTip('请输入您的称呼');
            $('#appeal-name').focus();
            return;
        }
        if (!phone) {
            alertTip('请输入固话或手机号');
            $('#appeal-phone').focus();
            return;
        }
        if (!regp.test(phone) && !regT.test(phone)) {
            alertTip('请输入合法的固话或手机号');
            $('#appeal-phone').focus();
            return;
        }
        if (!reason) {
            alertTip('请输入申诉原因');
            $('#appeal-reason').focus();
            return;
        }
        appealApp({app_id: $('#shield-panel .shield-id').text(), appeal: reason, phone: phone, username: name});
    })

    function appealApp(param) {
        $.ajax({
            url: 'index.php?r=pc/AppData/ProcessAppAppeal',
            type: 'post',
            dataType: 'json',
            data: param,
            success: function (data) {
                if (data.status != 0) {
                    alertTip(data.data);
                    return;
                }
                ;
                alertTip('提交成功，请等待审核结果');
                $('#appeal-panel').hide();
                window.location.reload();
            },
            error: function (data) {

            }
        });
    }
</script>
<!-- 右小角联系图标 -->
    <!-- 咨询按钮 -->
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/new_upper_right_corner.css">
    <div class="consult_contact">
        <div class="consult_wrap"><a href="/cowcms/index.php/Index/Conversation/index" target="_blank">
            <div class="tip">Hello,欢迎来咨询~</div>
            <img src="/cowcms/Public/css_js_font_img/applet/image/public/ball.png" class="ball" alt="">
            <img src="/cowcms/Public/css_js_font_img/applet/image/public/bg_0.png" class="staff_img" alt="">
            <img src="/cowcms/Public/css_js_font_img/applet/image/public/bg_1.png" class="bg-1" alt="">
            <img src="/cowcms/Public/css_js_font_img/applet/image/public/bg_2.png" class="bg-2" alt="">
            <img src="/cowcms/Public/css_js_font_img/applet/image/public/bg_3.png" class="bg-3" alt=""></a>
        </div>
    </div>

<script src="/cowcms/Public/css_js_font_img/applet/js/jquery_002.js"></script>
<script src="/cowcms/Public/css_js_font_img/applet/js/clipboard.js"></script>
<script src="/cowcms/Public/css_js_font_img/applet/js/common.js"></script>
<script src="/cowcms/Public/css_js_font_img/applet/js/myapp.js"></script>


</body>
</html>
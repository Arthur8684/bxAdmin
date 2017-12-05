<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>关于我们</title>
    <!-- 引入html头信息 -->
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

    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/about_us.css" type="text/css">
</head>
<body>
<div id="flag" style="display:none;">关于我们</div>
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

<div class="banner-section">
    <div class="banner-text">
        <p><?php echo L('about_title2');?></p>
        <p><?php echo L('about_title3');?></p>
        <p><a href="javascript:;" class="paly-btn">查看视频<img src="/cowcms/Public/css_js_font_img/applet/image/about/play_btn.png"></a></p>
    </div>
</div>
<div class="gallery-section">
    <ul class="gallery-list">
        <li><a href="/match/" target="_blank">
            <img src="/cowcms/Public/css_js_font_img/applet/image/about/icon1.png">
            <div class="text">
                <p>设计大赛</p>
                <p>各种大奖，等你来拿</p>
            </div>
        </a></li>
        <li><a href="" target="_blank">
            <img src="/cowcms/Public/css_js_font_img/applet/image/about/icon2.png">
            <div class="text">
                <p>服务支持</p>
                <p>我们永远是您的后盾</p>
            </div>
        </a></li>
        <li><a target="_blank" href="/news/">
            <img src="/cowcms/Public/css_js_font_img/applet/image/about/icon3.png">
            <div class="text">
                <p>媒体报导</p>
                <p>您的关注是我们的动力</p>
            </div>
        </a></li>
        <li><a target="_blank" href="">
            <img src="/cowcms/Public/css_js_font_img/applet/image/about/icon4.png">
            <div class="text">
                <p>代理查询</p>
                <p>欢迎加入咫尺代理大家庭</p>
            </div>
        </a></li>
    </ul>
</div>
<div class="intro-section">
    <div class="intro">
        <p class="intro-title"><?php echo L('about_title1');?></p>
        <p class="intro-description"><?php echo L('about_content1');?>
        </p>
        <ul class="intro-gallery">
            <li>
                <p>2012</p>
                <p>奶牛网络成立</p>
            </li>
            <li>
                <p>100<span>w+</span></p>
                <p>网站用户量</p>
            </li>
            <li>
                <p>1<span>w+</span></p>
                <p>帮助上线小程序</p>
            </li>
            <li>
                <p>200<span>+</span></p>
                <p>全国现有代理商</p>
            </li>
        </ul>
        <a href='<?php echo U("Index/About/article");?>' class="more-intro" target="_blank">查看更多</a>
    </div>
</div>
<div class="progress-section">
    <div class="progress-content">
        <div class="progress-detail">
            <ul class="progress-index">
                <li name="num" onmouseover="func(0)"  class="active">2017<i></i></li>
                <li name="num" onmouseover="func(1)"  class="">2016<i></i></li>
                <li name="num" onmouseover="func(2)"  class="">2015<i></i></li>
                <li name="num" onmouseover="func(3)"  class="">2012<i></i></li>
            </ul>
            <ul class="progress-list">
                <li class="progress" style="display:;">
                    <p>第四阶段：一日千里</p>
                    <p>奶牛网络已经成立五年了，期间已经为百万用户进行过服务，区域代理突破200家，奶牛平台已经帮助企业用户上线1万多个小程序。</p>
                </li>
                <li class="progress" style="display:none;">
                    <p>第三阶段：</p>
                    <p>企业用户破50万，WebApp上线，单天在线PV首次突破1000万区域代理突破20家，与华为达成OEM合作，与中兴集团达成为期10年的战略合作。</p>
                </li>
                <li class="progress" style="display:none;">
                    <p>第二阶段：</p>
                    <p>奶牛微页上线，期间与腾讯微社区中兴、工商银行、微盟、微店达成深度定制合作,并登陆央视《经济半小时》。</p>
                </li>
                <li class="progress" style="display:none;">
                    <p>第一阶段：</p>
                    <p>奶牛网络科技公司诞生。</p>
                </li>
            </ul>
        </div>
        <div class="progress-text">
            <p>我们飞速的成长史</p>
            <p>短短几年，我们已经为数百万用户提供服务。</p>
            <!--<a href="javascript:;" class="more-progress">查看完整历程</a>-->
        </div>
    </div>
</div>
<script>
    list=document.getElementsByName('num');
    progress=document.getElementsByClassName('progress');
    // 鼠标移入事件
    function func(b){
        for(var i=0;i<list.length;i++){
            if(i==b){
                list[i].className='active';
                progress[i].style.display='block';
            }else{
                list[i].className='';
                progress[i].style.display='none';
            }
        }
    }
</script>
<div class="team-section">
    <div class="team-content">
        <p class="team-title">奶牛精英团队</p>
        <p class="team-description">这里有一群对互联网爱到狂热的人，在追求完美的路上我们将披荆斩棘，永不退缩。</p>
        <ul class="team-intro">
            <li>
                <p>经验</p>
                <p>Experience</p>
                <p>丰富的产品案例实践</p>
                <p>玩转场景营销</p>
            </li>
            <li>
                <p>专业</p>
                <p>Professional</p>
                <p>专注于移动互联网开发</p>
                <p>数据导向用户</p>
            </li>
            <li>
                <p>信任</p>
                <p>Trust</p>
                <p>团队成员紧密配合</p>
                <p>合力推进工作</p>
            </li>
            <li>
                <p>执行力</p>
                <p>Execution</p>
                <p>绝不拖延立即行动</p>
                <p>保质完成任务</p>
            </li>
            <li>
                <p>创新</p>
                <p>Innovation</p>
                <p>潜心研究应用生态</p>
                <p>精准把握产品</p>
            </li>
        </ul>
    </div>
</div>
<div class="service-section">
    <div class="service-content">
        <div class="service-title">联系我们<p>周一至周六&ensp;9:00-18:00</p></div>
        <div class="service-list">
            <ul class="left-side">
                <li>
                    <p>全国咨询电话（代理/服务/套餐）</p>
                    <p><?php echo L('COMPANY_PHONE');?></p>
                </li>
                <li>
                    <p>邮箱</p>
                    <p><?php echo L('COMPANY_EMAIL');?></p>
                </li>
            </ul>
            <div class="right-side">
                <p>公司地址</p>
                <p><?php echo L('COMPANY_ADDRESS');?></p>
                <p><a href="/cowcms/index.php/Index/Conversation/index" target="_blank">在线咨询</a></p>
            </div>
        </div>
    </div>
    <div class="company-address"><p>广东省深圳市芒果网大厦1505</p></div>
</div>

<div class="banner-video" style="display:none">
    <div class="banner-video-cell">
        <a href="javascript:;" class="banner-video-btn-close" title="关闭"></a>
        <video class="banner-video-player" controls="true"
               src="/cowcms/Public/css_js_font_img/applet/video/ac3b4f2caaad3135bd36f2db95549705.mp4"></video>
    </div>
</div>

<!-- 引入咨询按钮 -->
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

<!-- 引入底部 -->
<!--底部-->
<link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/footer.css">
<div class="footer-section">
    <div class="footer-content">
        <div class="footer-top">
            <div class="products-center">
                <p class="title">产品中心</p>
                <ul>
                    <li><a href="" target="_blank">微信小程序</a></li>
                    <li><a href="" target="_blank">支付宝小程序</a></li>
                    <li><a href="" target="_blank">微页</a></li>
                </ul>
            </div>
            <div class="sincere-cooperation">
                <p class="title">诚意合作</p>
                <ul>
                    <li><a href="" target="_blank">代理加盟</a></li>
                    <li><a target="_blank" href="">商务合作</a></li>
                </ul>
            </div>
            <div class="hot-activity">
                <p class="title">热门活动</p>
                <ul>
                    <li><a href="" target="_blank">课程培训</a></li>
                    <li><a href="" target="_blank">赛事活动</a></li>
                </ul>
            </div>
            <div class="follow-us">
                <p class="title">关注我们</p>
                <ul>
                    <li><a href="" target="_blank">关于我们</a></li>
                    <li><a href="" target="_blank">媒体报导</a></li>
                    <li><a href="" target="_blank">帮助中心</a></li>
                </ul>
            </div>
            <div class="contact-us">
                <p class="title">联系我们</p>
                <ul>
                    <li><a>咨询电话：<?php echo L('COMPANY_PHONE');?></a></li>
                    <li><a>周一至周五&ensp;9:00-18:00</a></li>
                    <li><a href="" target="_blank">在线客服</a></li>
                    <li><a>关注官方</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="friend-links">
                <span>友情链接：</span>
                <span><a href="" target="_blank">web前端开发</a></span>
            </div>
            <div class="company-statement">
                <span><?php echo L('COMPANY_NAME');?>©2015 奶牛网络 <a href="" target="_blank">粤ICP备16110707号-1</a></span>
                <img src="/cowcms/Public/css_js_font_img/applet/image/about/ebsgovicon.png" class="ebsgovicon" alt="工商网监电子标识">
            </div>
        </div>
    </div>
</div>

<script>
    $('.paly-btn').click(function(){
//        $('')
    });
</script>
</body>
</html>
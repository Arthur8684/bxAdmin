<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>代理加盟</title>
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

    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/common.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/nat_agency.css">
    <!-- tg.jisuapp.cn下添加360统计代码 -->
    <style type="text/css" rel="stylesheet">
        body {
            zoom: 98.71428571428571%;
        }
    </style>
</head>

<body class="webapp">
<div id="flag" style="display:none;">代理加盟</div>
<!-- 引入顶部导航 -->
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

<div class="maincontain">
    <div class="top_banner">
        <div class="top_banner_container">
            <div class="agency_recruit">代理合作加盟</div>
            <div class="agency_wait_you">2017，微信小程序元年，千亿市场等你来</div>
            <div class="immediate_join">
                <a class="one_agent" href="#immediate_join_us">点击报名</a>
            </div>
        </div>
    </div>
    <!--区域代理显示区 -->
    <div class="area_agency_show">
        <!-- 市场分析-->
        <div class="market_analysis">
            <div class="market_analysis_word">
                <div class="market_analysis_container">
                    <p>市场分析</p>
                    <p>2017年1月9日微信小程序正式上线，引发各界关注，<span>千亿市场</span>马上到来。</p>
                    <p>腾讯公布了2016年全年业绩，年总收入突破<span>千亿元</span>！</p>
                    <p>微信日均活跃账号<span>7.68亿</span>，娱乐、购物、公众号所占微信收入比例高达<span>90%</span>。</p>
                    <p>微信几乎影响了中国所有网民，而我们的<span>即速应用</span>是国内<span>第一家小程序开发平台。</span></p>
                </div>
            </div>
            <div class="market_analysis-img">
                <div class="market_analysis-img1">
                </div>
                <div class="market_analysis-img2">
                </div>
                <div class="market_analysis-img3">
                </div>
                <div class="market_analysis-img4">
                    <div class="market_analysis_animateWrap">
                        <div id="animate_1" class="common">
                            <div class="outer_wrap">
                                <div class="inner_wrap">
                                </div>
                            </div>
                            <p>2014</p>
                        </div>
                        <div class="line_1">
                        </div>
                        <div id="animate_2" class="common">
                            <div class="outer_wrap_1">
                                <div class="inner_wrap_1">
                                </div>
                            </div>
                            <p>2015</p>
                        </div>
                        <div id="line_2" class="line_2">
                        </div>
                        <div id="animate_3" class="common">
                            <div class="outer_wrap_2">
                                <div class="inner_wrap_2">
                                </div>
                            </div>
                            <p>2016</p>
                        </div>
                        <div id="line_3" class="line_3">
                        </div>
                        <div id="animate_4" class="common">
                            <div class="outer_wrap_3">
                                <div class="inner_wrap_3">
                                </div>
                            </div>
                            <p>2017</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--微信小程序优势-->
        <div class="weixin_smallP_introduce">
            <p>微信小程序优势</p>
            <img style="width: 54%;padding: 30px; display: block; margin: 0 auto;"
                 src="/cowcms/Public/css_js_font_img/applet/image/join/miniapp.png">
        </div>
        <!-- 制作WebApp 抓住新机遇-->
        <div class="make_webApp">
            <div class="make_webApp_introduce">
                <p>抓住微信小程序新机遇</p>
                <p>任何人如果要抓住微信小程序这一机遇，就必须先要拥有自己的小程序。</p>
                <p>如果因此错失未来微信小程序推出的这一良机，是非常可惜的。</p>
                <p>越来越多的商家和企业，选择了使用“即速应用”这样的高效专业的小程序制作工具。</p>
                <p>奶牛正面向全国招募代理，邀您一起快速打开全国市场。</p>
            </div>
        </div>
        <!-- 即速应用优势-->
        <div class="product_advantage">
            <div class="product_advantage_container">
                <div class="product_advantage_title_wrap">
                    <p>即速应用优势</p>
                </div>
                <div>
                    <!--轮播图-->
                    <div class="product_advantage_left">
                        <div class="product_mobile">
                            <div id="slides" style="overflow: hidden;">

                                <div class="slidesjs-container"
                                     style="overflow: hidden; position: relative; width: 218px; height: 387px;">
                                    <div class="slidesjs-control"
                                         style="position: relative; left: 0px; width: 218px; height: 387px;">
                                        <img src="/cowcms/Public/css_js_font_img/applet/image/join/1.png" name="imglist" alt="" data-index="slide5"
                                             class="slidesjs-slide"
                                             style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: block;"
                                             slidesjs-index="0">
                                        <img src="/cowcms/Public/css_js_font_img/applet/image/join/2.png" name="imglist" alt="" data-index="slide1"
                                             class="slidesjs-slide"
                                             style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;"
                                             slidesjs-index="1">
                                        <img src="/cowcms/Public/css_js_font_img/applet/image/join/3.png" name="imglist" alt="" data-index="slide2"
                                             class="slidesjs-slide"
                                             style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;"
                                             slidesjs-index="2">
                                    </div>
                                </div>

                                <!-- 线下 -->
                                <ul class="slidesjs-pagination">
                                    <li class="slidesjs-pagination-item" name="dlist"><a href="javascript:;"
                                                                            class="active">1</a></li>
                                    <li class="slidesjs-pagination-item" name="dlist"><a href="javascript:;"
                                                                            class="">2</a></li>
                                    <li class="slidesjs-pagination-item" name="dlist"><a href="javascript:;"
                                                                            class="">3</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product_swiper"></div>
                    </div>
                    <script>
                        m=0;
                        // 获取img元素集合
                        imglist=document.getElementsByName('imglist');
                        // 获取按钮集合
                        dlist=document.getElementsByName('dlist');

                        // 定时器函数
                        function running(){
                            m++;
                            if(m==3){
                                m=0;
                            }
                            show(m);
                        }
                        // 定时器
                        mytime=setInterval(running,2000);

                        // 显示图片和按钮
                        function show(m){
                            for(var i=0;i<imglist.length;i++){
                                if(i==m){
                                    imglist[i].style.display="block";
                                    dlist[i].className='active';
                                }else{
                                    imglist[i].style.display="none";
                                    dlist[i].className="";
                                }
                            }
                        }

                    </script>
                    <div class="product_advantage_right">
                        <div class="product_advantage_content_wrap">
                            <div class="product_advantage_content_top">
                                <div>
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product1.png">
                                    <p style="color: #59607B;">一键生成微信小程序</p>
                                </div>
                                <div>
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product2.png">
                                    <p style="color: #59607B;">海量行业案例</p>
                                </div>
                                <div>
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product3.png">
                                    <p style="color: #59607B;">2300万PV&nbsp;&nbsp;300万UV</p>
                                </div>
                            </div>
                            <div class="product_advantage_content_up">
                                <div class="product_advantage_common">
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product_advantage-1.png" alt=""><span>全国首家微信小程序开发平台</span>
                                </div>
                                <div class="product_advantage_common">
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product_advantage-2.png" alt=""><span>独有的小程序,无需代码专属定制</span>
                                </div>
                            </div>
                            <div class="product_advantage_content_down">
                                <div class="product_advantage_common">
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product_advantage-4.png" alt=""><span>全国领先Html5技术开发平台</span>
                                </div>
                                <div class="product_advantage_common">
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product_advantage-5.png" alt=""><span>无需下载的小程序兼容性好</span>
                                </div>
                            </div>
                            <div class="product_advantage_content_bottom">
                                <div class="product_advantage_common">
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product_advantage-3.png" alt=""><span>1500万用户基数，市场广阔</span>
                                </div>
                                <div class="product_advantage_common">
                                    <img src="/cowcms/Public/css_js_font_img/applet/image/join/product_advantage-6.png" alt=""><span>联合各大公司举办大赛，用户参与度高</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 强大的用户基数-->
        <div class="strong_user_base">
            <div class="strong_user_base_content">
                <div class="user_title">
                    <p>强大的用户基数</p>
                    <p>奶牛目前已与诸多企业达成合作，<span>微软、中兴、工商银行、华夏银行</span>等已是我们的年度战略合作伙伴。</p>
                </div>
                <div class="cus_coin_container">
                    <div id="c_1"></div>
                    <div id="c_2"></div>
                    <div id="c_3"></div>
                    <div id="c_4"></div>
                    <div id="c_19"></div>
                    <div id="c_11"></div>
                    <div id="c_12"></div>
                    <div id="c_13"></div>
                    <div id="c_14"></div>
                    <div id="c_15"></div>
                    <div id="c_6"></div>
                    <div id="c_7"></div>
                    <div id="c_8"></div>
                    <div id="c_9"></div>
                    <div id="c_10"></div>
                    <div id="c_16"></div>
                    <div id="c_17"></div>
                    <div id="c_18"></div>
                    <div id="c_5"></div>
                    <div id="c_20"></div>
                </div>
            </div>
        </div>
        <!-- 代理优势-->
        <div class="agency_advantage">
            <div class="agency_advantage_container">
                <div class="agency_advantage_title">
                    <p>代理扶持</p>
                </div>
                <div class="agency_advantage_recruit">
                    <p>目前代理已覆盖：北京、上海、深圳、广州；天津、重庆、杭州、南京、宁波、青岛、苏州、武汉、</p>
                </div>
                <div class="agency_advantage_isyou">
                    <p>成都、大连、无锡、佛山、东莞、泉州、厦门...</p>
                </div>
                <div class="agency_advantage_type">
                    <div class="agency_advantage_type_up">
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-1.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>物料支持</p>
                                <p>宣传页、手册、视频、易拉宝</p>
                            </div>
                        </div>
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-3.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>培训支持</p>
                                <p>视频、现场、总部、微信</p>
                            </div>
                        </div>
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-6.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>市场支持</p>
                                <p>会销、电话、客户、广告</p>
                            </div>
                        </div>
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-7.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>团队建设</p>
                                <p>销售、客服、行政、运营</p>
                            </div>
                        </div>
                    </div>
                    <div class="agency_advantage_type_down">
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-8.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>现场扶持</p>
                                <p>培训、答疑、陪访、考核</p>
                            </div>
                        </div>
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-5.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>代理商交流会</p>
                                <p>交流会、座谈会、年终总结大会</p>
                            </div>
                        </div>
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-2.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>技术支持</p>
                                <p>技术专服、定制、代维护</p>
                            </div>
                        </div>
                        <div class="agency_advantage_type_common">
                            <div class="agency_advantage_img_wrap">
                                <img src="/cowcms/Public/css_js_font_img/applet/image/join/agency_advantage-9.png" alt="">
                            </div>
                            <div class="agency_advantage_word_wrap">
                                <p>客服支持</p>
                                <p>产品、技术、操作</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 全方面协助-->
        <div class="full_assistance">
            <div class="full_assistance_wrap">
                <p>我们需要这样的你</p>
                <div class="full_assistance_content">
                    <div class="full_assistance_header">
                        <div class="full_assistance_common">
                            <div class="full_assistance_common_title">
                                <div class="list-container">
                                    <span class="list-show">
                                  1
                                    </span>
                                </div>
                                <span>注册资金10万以上</span>
                            </div>
                            <!-- <p></p> -->
                        </div>
                        <div class="full_assistance_common full_assistance_common_right">
                            <div class="full_assistance_common_title">
                                <div class="list-container">
                                    <span class="list-show">
                                  2
                                    </span>
                                </div>
                                <span>团队核心成员5人以上</span>
                            </div>
                            <!-- <p></p> -->
                        </div>
                    </div>
                    <div class="full_assistance_middle">
                        <div class="full_assistance_common">
                            <div class="full_assistance_common_title">
                                <div class="list-container">
                                    <span class="list-show">
                                  3
                                    </span>
                                </div>
                                <span>优先考虑有设计能力或者</span>
                                <span>拥有设计师团队的代理商</span>
                            </div>
                            <!-- <p></p> -->
                        </div>
                        <div class="full_assistance_common full_assistance_common_right">
                            <div class="full_assistance_common_title">
                                <div class="list-container">
                                    <span class="list-show">
                                  4
                                    </span>
                                </div>
                                <span>有互联网行业经验者优先，具</span>
                                <span>备管理经验者优先</span>
                            </div>
                            <!-- <p></p> -->
                        </div>
                    </div>

                </div>
            </div>
            <div class="full_assistance_bg">
            </div>
        </div>

        <!-- 加盟-->
        <div class="join_us" name="immediate_join_us">
            <div class="join_us_form">
                <a name="immediate_join_us"></a>
                <p>加盟</p>
                <div class="join_us_info">
                    <label><span class="necessary">*</span>代理类型：
                        <input name="agent" value="1" class="agent-radio" checked="checked" id="agent-one" type="radio"><label for="agent-one" style="display: inline-block;">一级代理商</label>
                        <input name="agent" value="0" class="agent-radio" id="agent-two" type="radio"><label for="agent-two" style="display: inline-block;">二级经销商</label>
                    </label>
                    <label><span class="necessary">*</span>您的姓名：
                        <input name="" style="margin-left:84px;" id="name" type="text">
                    </label>
                    <label><span class="necessary">*</span>您的电话：
                        <input name="" style="margin-left: 84px;" id="phone" type="text">
                    </label>
                    <label><span class="necessary" style="visibility: hidden;width: 25px;">*</span>您的QQ：
                        <input name="" style="margin-left: 86px;" id="qq" type="text">
                    </label>
                    <label><span class="necessary">*</span>所在区域：
                        <!-- 城市级联 -->
                        <select name="area" id="province_Select" style="margin-left: 85px;">
                            <option value="" selected="selected">选择省</option>
                        </select>
                        <select name="area" id="city_Select" style="margin-left: 22px;">
                            <option value="" selected="selected">选择市</option>
                        </select>
                    </label>
                    <label><span class="necessary">*</span>主营业务：
                        <input name="" style="margin-left: 86px;" id="company_main_product" type="text">
                    </label>
                    <label><span class="necessary">*</span>客户群体：
                        <input name="" style="margin-left: 86px;" id="main_client" type="text">
                    </label>
                    <label><span class="necessary" style="float: left;">*</span><span style="float: left;">对当地的市场分析和营销计划：</span>
                        <textarea name="localmarket_analysis_plan" placeholder="对当地市场的分析和营销计划(不少于20字)"
                                  id="localmarket_analysis_plan"></textarea>
                    </label>
                    <p class="btn-container">
                        <button type="button" id="join_btn">立即加入</button>
                    </p>
                </div>
            </div>
        </div>
        <!--联系方式-->
        <div class="contact_way">
            <div class="contact_way_container">
                <div>
                    <p>联系方式</p>
                    <p>来电垂询：18926566765</p>
                    <p>全国代理群号：199293608</p>
                    <p>商务合作-QQ：2590336174</p>
                    <p>我们期待与您合作!</p>
                </div>
            </div>
        </div>
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

</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN"><head>
    <title>制作</title>
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

    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/swiper.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/webuploader.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/spectrum.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/common.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/tpl.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/jquery.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/bootstrap-paginator.css">

    <!-- tg.jisuapp.cn下添加360统计代码 -->
    <style type="text/css" rel="stylesheet">body{zoom: 98.71428571428571%;}</style>
    <link rel="stylesheet" href="../../../../../Public/index/css/swiper.css">
</head>
<body class="webapp" is_login="0" a="">
    <div id="flag" style="display:none;">制作</div>
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

    <!-- 引入轮播图 -->
        <!-- 轮播开始 -->
    <script src="/cowcms/Public/css_js_font_img/applet/js/jquery-1.8.3.min.js"></script>
    <div id="slides" style="height: 347.9px; overflow: hidden;">
        <div class="slidesjs-container" style="overflow: hidden; position: relative; width:100%; height: 361.053px;">
            <div class="slidesjs-control" style="position: relative; left: 0px; width:100%; height: 361.053px;">
                <a data-index="slide0" href="" target="_blank" class="slidesjs-slide" name="imglist" style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;" slidesjs-index="0">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/carousel/carousel01.jpg" alt="">
                </a>
                <a data-index="slide1" href="" target="_blank" rel="nofollow" class="slidesjs-slide" name="imglist" style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;" slidesjs-index="1">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/carousel/carousel02.jpg" alt="" rel="nofollow">
                </a>
                <a data-index="slide2" href="" target="_blank" rel="nofollow" class="slidesjs-slide" name="imglist" style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: block;" slidesjs-index="2">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/carousel/carousel03.jpg" alt="" rel="nofollow">
                </a>
                <a data-index="slide3" href="" target="_blank" rel="nofollow" class="slidesjs-slide" name="imglist" style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;" slidesjs-index="3">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/carousel/carousel04.jpg" alt="" rel="nofollow">
                </a>
                <a data-index="slide4" href="" target="_blank" rel="nofollow" class="slidesjs-slide" name="imglist" style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;" slidesjs-index="4">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/carousel/carousel05.jpg" alt="" rel="nofollow">
                </a>
                <a data-index="slide5" href="" target="_blank" rel="nofollow" class="slidesjs-slide" name="imglist" style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;" slidesjs-index="5">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/carousel/carousel06.jpg" alt="" rel="nofollow">
                </a>
                <a data-index="slide6" href="" target="_blank" rel="nofollow" class="slidesjs-slide" name="imglist" style="position: absolute; top: 0px; left: 0px; width: 100%; z-index: 0; backface-visibility: hidden; display: none;" slidesjs-index="6">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/carousel/carousel07.jpg" alt="" rel="nofollow">
                </a>
            </div>
        </div>

        <div class="slidesjs-previous slidesjs-navigation swiper-button-prev"  id="imgleft"></div>
        <div class="slidesjs-next slidesjs-navigation swiper-button-next"  id="imgright"></div>
        <a class="slidesjs-play slidesjs-navigation slidesjs-playing" href="#" title="Play">Play</a>
        <a class="slidesjs-stop slidesjs-navigation" href="#" title="Stop">Stop</a>
        <ul class="slidesjs-pagination">
            <li class="slidesjs-pagination-item"><a href="javascript:;" data-slidesjs-item="0" class="active" name="dlist" onmouseover="func(0)" onmouseout="demo(0)">1</a></li>
            <li class="slidesjs-pagination-item"><a href="javascript:;" data-slidesjs-item="1" class="" name="dlist" onmouseover="func(1)" onmouseout="demo(1)">2</a></li>
            <li class="slidesjs-pagination-item"><a href="javascript:;" data-slidesjs-item="2" class="" name="dlist" onmouseover="func(2)" onmouseout="demo(2)">3</a></li>
            <li class="slidesjs-pagination-item"><a href="javascript:;" data-slidesjs-item="3" class="" name="dlist" onmouseover="func(3)" onmouseout="demo(3)">4</a></li>
            <li class="slidesjs-pagination-item"><a href="javascript:;" data-slidesjs-item="4" class="" name="dlist" onmouseover="func(4)" onmouseout="demo(4)">5</a></li>
            <li class="slidesjs-pagination-item"><a href="javascript:;" data-slidesjs-item="5" class="" name="dlist" onmouseover="func(5)" onmouseout="demo(5)">6</a></li>
            <li class="slidesjs-pagination-item"><a href="javascript:;" data-slidesjs-item="6" class="" name="dlist" onmouseover="func(6)" onmouseout="demo(6)">7</a></li>
        </ul>
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
            if(m==7){
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

        // 左侧按钮
        $('#imgleft').click(function(){
            clearInterval(mytime);
            m=m-2;
            if(m<-1){
                m=5;
            }
            running();
            // 继续调用定时器
            mytime=setInterval(running,4000);

        })
        // 右侧按钮
        $('#imgright').click(function(){
            clearInterval(mytime);
            m=m;
            running();
            mytime=setInterval(running,4000);
        })

        // 鼠标移出事件
        function demo(b){
            m=b;
            running();
            mytime=setInterval(running,2000);
        }

        // 鼠标移入事件
        function func(b){
            clearInterval(mytime);
            // 遍历
            for(var i=0;i<imglist.length;i++){
                if(i==b){
                    imglist[i].style.display='block';
                    dlist[i].className='active';
                    // dlist[i].
                }else{
                    imglist[i].style.display='none';
                     dlist[i].className="";
                }
            }
        }
    </script>
    <!-- 轮播结束 -->

    <!-- 选项卡 -->
    <div class="tpl-navs-wrap">
        <div class="tpl-first-navs" id="first-navs">
            <span data-cate="1" class="active">常用</span>
            <span data-cate="12" class="js-uninitial">单页</span>
        </div>
    </div>

    <!-- 内容部分 -->
    <div class="tpl-content active">
        <div class="tpl-sec-navs">
            <span data-cate="0" class="active">全部</span>
            <span data-cate="41" class="">多商家</span>
        </div>
        <ul class="tpl-container">
            <a href="/cowcms/index.php/Applet/Edit/index">
                <li class="empty-tpl" data-id="-1">
                    <div class="note-icon"></div>
                    <p class="name">空白模板</p>
                </li>
            </a>
            <li data-id="fVVY0Fw2ZP" data-desc="" class="js-tpl" data-tp="0.00">
                0.00
                <img alt="" class="cover lazy" onerror="errorWeiyeCover(this)" src="/cowcms/Public/css_js_font_img/applet/image/make/t_1503559223599e7e3790b77.png" style="display: inline;">
                <p class="name">母婴小程序（拼团）</p>
                <div class="code-mask">
                    <img src="/cowcms/Public/css_js_font_img/applet/image/make/fushiLite.jpg" alt="" class="code">
                    <span class="select-btn choose-btn">使用</span>
                    <span class="select-btn js-preview-btn" onclick="window.location.href='<?php echo U('Applet/Preview/index');?>'">预览</span>
                </div>
            </li>
        </ul>
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

    <!-- 添加书签 -->
    <div class="add-label-btn">
        <span id="add-label-span"><b>+</b>添加到书签 更方便</span>
        <div class="add-label-"></div>
    </div>
    <!--使用-->
    <div class="advanced-label-btn">
        <span id="advanced-label-span"><img src="/cowcms/Public/css_js_font_img/applet/image/make/high.png" alt="">小程序企业高级版申请试用</span>
        <div class="advanced-label-"></div>
    </div>

    <!--添加标签-->
  <div class="add-label" id="add-label" style="display:none;">
      <div class="swapLabel">
          <img class="labelPoint" src="/cowcms/Public/css_js_font_img/applet/image/make/addCollect.png">
          <div class="labelButton">
              <a href="">
                  <img style="height:50px;box-shadow: 1px 1px 130px #000,-1px -1px 130px #000;border-radius: 7px;" src="/cowcms/Public/css_js_font_img/applet/image/make/CollectButton.png" alt="即速应用制作">
              </a>
          </div>
          <p>拖动此按钮到书签栏</p>
      </div>
      <div class="labelClose"><img src="/cowcms/Public/css_js_font_img/applet/image/make/close.png" alt="关闭"></div>
  </div>

  <div class="left_info">
      <span class="left_text">*请选择模板 * 每周更新*</span>
  </div>

<!--悬浮窗-->
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

    <!-- 高级版试用弹窗 -->
    <link rel="stylesheet" type="text/css" href="/cowcms/Public/css_js_font_img/applet/css/enterprise.css">
    <div class="advancedContainer" id="advanced-container" style="display:none;">
        <div class="main">
          <div class="premium-left">
            <img src="/cowcms/Public/css_js_font_img/applet/image/make/premium.jpg" alt="" style="width: 370px">
          </div><div class="premium-right">
            <div class="submenu ">
              <p style="font-size: 24px">小程序高级版&nbsp;<span style="color: #ff3f1d;">￥3999/年</span>
              <span style="font-size: 16px;margin-left: 5px;">（有效期7天）</span></p>
            </div>
            <div class="msg">
              <div style="border-bottom: 1px solid #666666">
              <lable>姓名：</lable>
               <input id="name" type="text">
              </div>
              <div style="border-bottom: 1px solid #666666">
              <lable>电话：</lable>
               <input id="telephone" type="text">
              </div>
              <div style="border-bottom: 1px solid #666666">
              <lable>公司名称：</lable>
              <input id="company" type="text">
              </div>
              <div style="border-bottom: 1px solid #666666">
              <lable>职称：</lable>
              <input id="technicalTitle" type="text">
              </div>
            </div>
            <div class="advanced-button">
              <button style="width: 314px;height: 37px;background-color: #37b7eb;font-size: 16px;margin-top: 30px;color: white;margin-top: 42px;border: none;">立即试用</button>

            </div>
          </div>
        </div>
    </div>

    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/jquery.css">
    <style rel="stylesheet">
        .webapp-box {
          position: fixed;
          -webkit-transform: translateX(-10000px);
          -moz-transform: translateX(-10000px);
          transform: translateX(-10000px);
          z-index: 1001;
          left: 50%;
          top: 10%;
          width: 603px;
          min-height: 460px;
          margin-left: -300px;
          padding-bottom: 15px;
          border: 1px solid #DDD;
          border-radius: 10px;
          box-shadow: 5px 5px 20px rgba(0,0,0,.4),-5px -5px 20px rgba(0,0,0,.4);
          background: #FFF;
        }
        .webapp-box.animate-show {
          -webkit-animation: 'show' .5s linear;
          -moz-animation: 'show' .5s linear;
          animation: 'show' .5s linear;
        }
        .webapp-box.animate-hide {
          -webkit-animation: 'hide' .3s linear;
          -moz-animation: 'hide' .3s linear;
          animation: 'hide' .3s linear;
        }
        .webapp-box-bg {
          position: fixed;
          -webkit-transform: translateX(-10000px);
          -moz-transform: translateX(-10000px);
          transform: translateX(-10000px);
          width: 100%;
          height: 100%;
          z-index: 1000;
          left: 0;
          top: 0;
          background: rgba(0,0,0,.5);
        }
        .animate-show {
          -webkit-transition: opacity .5s linear;
          -moz-transition: opacity .5s linear;
          transition: opacity .5s linear;
          opacity: 1;
        }
        .animate-hide {
          -webkit-transition: opacity .5s linear;
          -moz-transition: opacity .5s linear;
          transition: opacity .5s linear;
          opacity: 0;
        }
        .webapp-box-bg.animate-show, .webapp-box.animate-show {
          -webkit-transform: translateX(0px);
          -moz-transform: translateX(0px);
          transform: translateX(0px);
        }

        .webapp-box input[type=file]:focus, .webapp-box input[type=checkbox]:focus, .webapp-box input[type=radio]:focus {
          outline: none;
        }

        .webapp-box-header {
          width: 100%;
          height: 45px;
          background: #FFF;
          border-bottom: 1px solid #e5e5e5;
          border-radius: 10px 10px 0 0;
        }
        .webapp-box-header-ul {
          margin: 12px 0 0 10px;
          padding: 0;
          font-size: 0;
          text-align: center;
        }
        .webapp-box-header-ul li {
          display: inline-block;
          padding: 5px 16px;
          cursor: pointer;
          font-size: 14px;
          border-top: 1px solid #ddd;
          border-bottom: 1px solid #ddd;
        }
        .webapp-box-header-ul li:first-child {
          border-top-left-radius: 5px;
          border-bottom-left-radius: 5px;
          border-left: 1px solid #ddd;
        }
        .webapp-box-header-ul li:last-child {
          border-top-right-radius: 5px;
          border-bottom-right-radius: 5px;
          border-right: 1px solid #ddd;
        }
        .webapp-box-header-ul li.active {
          background: #00a3e9;
          color: #FFF;
        }
        .webapp-box-close {
          position: absolute;
          top: 15px;
          right: 20px;
          cursor: pointer;
          font-size: 2.1rem;
          font-weight: bold;
          line-height: 1;
          color: #000;
          text-shadow: 0 1px 0 #fff;
          opacity: .2;
        }
        .webapp-box-content {
          width: 100%;
          background: #FFF;
          border-radius: 15px;
        }
        .box-hide {
          display: none;
        }
        .webapp-box-content .box-resource-content {
          display: none;
        }
        .webapp-box-content .webapp-content-tab {
          padding-left: 10px;
          margin: 0;
          max-height: 140px;
          overflow-y: auto;
        }
        .webapp-box-content .webapp-content-tab li {
          display: inline-block;
          padding: 5px 14px;
          margin: 5px 0;
          cursor: pointer;
        }
        .webapp-box-content .webapp-content-tab li.active {
          border-radius: 6px;
          background: #00a3e9;
          color: #FFF;
        }
        .webapp-box-content .content-top-operation {
          background: #f7f7f7;
          padding: 8px;
        }
        .webapp-box-content .content-top-operation ul {
          margin: 0;
          padding: 0;
        }
        .content-top-operation .box-operation-menu li {
          margin-right: 5px;
        }
        #webapp-img-box .resource-list-wrap {
          display: none;
          height: 290px;
          padding-left: 15px;
          padding-top: 8px;
          overflow-x: hidden;
          overflow-y: auto;
        }
        #webapp-img-box .resource-list li {
          display: inline-block;
          margin: 0 15px 15px 0;
          position: relative;
          border: 1px solid transparent;
        }
        #webapp-img-box .resource-list li:hover,
        #webapp-img-box .resource-list li.selected {
          border-color: #ccc;
        }
        #webapp-img-box .resource-list li:hover {
          background-color: #ddd;
        }
        #webapp-img-box .resource-list li.selected:after {
          position: absolute;
          right: -12px;
          top: -10px;
          display: block;
          width: 24px;
          height: 24px;
          content: '√';
          color: #fff;
          font-family: "微软雅黑";
          line-height: 22px;
          text-align: center;
          border: 2px solid #fff;
          background: #6abb03;
          border-radius: 50%;
        }
        #webapp-img-box .resource-list .img-operate {
          display: none;
          position: absolute;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 1;
        }
        #webapp-my-img .resource-list li:hover .img-operate,
        body[data-admin="1"] #webapp-system-img li:hover .img-operate,
        body[admin="1"] #webapp-system-img li:hover .img-operate {
          display: block;
        }
        #webapp-img-box .resource-list .img-operate a {
          display: table-cell;
          width: 1%;
          padding: 2px;
          text-align: center;
          color: #fff;
          font-size: 12px;
          text-decoration: none;
          background-color: rgba(0,0,0,.5);
        }
        #webapp-img-box .resource-list .img-operate a:hover {
          background-color: rgba(0,0,0,.8);
        }
        #webapp-img-box .resource-list .progress-mask {
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: rgba(0,0,0,.8);
          z-index: 2;
          padding-top: 30px;
          color: #fff;
          text-align: center;
          font-size: 16px;
        }
        #webapp-img-box .resource-list .upload-fail-tip {
          display: none;
        }
        .webuploader-container {
          position: relative;
        }
        .webapp-box-footer {
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          height: 50px;
          line-height: 40px;
          padding-right: 30px;
          border-radius: 0 0 10px 10px;
          background: #FFF;
          border-top: 1px solid #e5e5e5;
          z-index: 2;
          font-size: 12px;
        }
        #img-crop-box .webapp-box-footer {
          text-align: right;
        }
        .webapp-box .webuploader-pick {
          font-size: inherit !important;
          background-color: transparent;
          overflow: initial;
        }
        .webapp-box .resource-select-num {
          color: #0034FF;
        }
        .webapp-box .form-control {
          display: inline-block;
          width: 120px;
        }
        .webapp-box .progress-bar {
          position: absolute;
          left: 365px;
          top: 20px;
        }
        .webapp-box .thumbnail {
          display: inline-block;
          width: 80px;
          height: 80px;
          margin: 0;
          text-align: center;
          font-size: 0;
          border: none;
        }
        .webapp-box .thumbnail:before, .webapp-box .thumbnail:after {
          content: "";
          display: inline-block;
          width: 0;
          height: 100%;
          vertical-align: middle;
        }
        .webapp-box .thumbnail img {
          display: inline-block;
          max-width: 100%;
          max-height: 100%;
          vertical-align: middle;
        }
        #img-crop-box {
          width: 700px;
          height: 500px;
          margin-left: -350px;
        }
        .img-crop-scope {
          width: 508px;
          height: 320px;
          margin-top: 20px;
          text-align: center;
          font-size: 0;
          border: 1px solid #bbb;
          background-color: #ccc;
          overflow: hidden;
        }
        .img-crop-top-input {
          padding: 7px 10px;
          background-color: #eee;
        }
        .jcrop-holder > input[type="radio"] {
          left: -2000px !important;
        }
        .webapp-sub-cate {
          display: none;
          padding: 8px 15px;
        }
        .webapp-sub-cate > span {
          cursor: pointer;
          margin-right: 8px;
          padding-right: 8px;
          border-right: 1px solid;
          color: #6c6c6c;
        }
        .webapp-sub-cate > span.active {
          color: #00a3e9;
        }
        .img-box-ui-radio {
          display: inline-block;
          width: 22px;
          height: 22px;
          position: relative;
          overflow: visible;
          border: 0;
          background: 0 0;
          -webkit-appearance: none;
          outline: 0;
          vertical-align: middle;
        }
        .img-box-ui-radio:before {
          content: '';
          display: block;
          width: 16px;
          height: 16px;
          border: 2px solid #dfe0e1;
          border-radius: 16px;
          background-clip: padding-box;
          position: absolute;
          left: 0;
          top: 0;
        }
        .img-box-ui-radio:checked:before {
          border: 2px solid #18b4ed;
        }
        .img-box-ui-radio:after {
          content: '';
          display: block;
          width: 8px;
          height: 8px;
          background: #dfe0e1;
          border-radius: 8px;
          position: absolute;
          left: 6px;
          top: 6px;
        }
        .img-box-ui-radio:checked:after {
          background: #18b4ed;
        }
        .img-crop-body-left {
          float: left;
          padding: 10px;
          margin: 0 20px;
          border: 1px solid #eee;
        }
        .img-crop-body-left label {
          display: block;
          padding: 0 8px;
          margin: 16px 0;
          text-align: right;
        }
        .img-crop-body-left .img-box-ui-radio {
          margin-left: 10px;
        }
        .webapp-box .btn {
          display: inline-block;
          padding: 6px 12px;
          width: auto;
          font-size: 14px;
          line-height: 18px;
          border: 1px solid #ccc;
          border-radius: 3px;
          color: #666;
          background-color: #fff;
          cursor: pointer;
          vertical-align: middle;
        }
        .webapp-box .btn.green {
          color: #fff;
          background-color: #03d8a2;
          border-color: #05C897;
        }
        .webapp-box .btn.orange {
          color: #fff;
          background-color: #ff9f22;
          border-color: #ee9016;
        }
        .webapp-box .btn.blue {
          color: #fff;
          background-color: #1dc6f1;
          border-color: #15bbe5;
        }
        .webapp-box input[type="text"] {
          border: 1px solid #ccc;
          border-radius: 4px;
          font-size: 14px;
          line-height: 14px;
          padding: 6px;
          box-shadow: inset 0 1px 3px rgba(0,0,0,.2);
          outline: 0;
          -webkit-user-select: text;
        }
        .webapp-box select {
          border: 1px solid #ccc;
          border-radius: 4px;
          line-height: 14px;
          padding: 6px 4px 6px 6px;
          box-shadow: inset 0 2px 8px rgba(0,0,0,.2);
          outline: 0;
          width: 160px;
          margin: 0;
        }
        input[type="file"]{
          opacity: 0;
        }
    </style>
    <div class="webapp-box-bg" id="webapp-img-box-bg"></div>
    <div class="webapp-box" id="webapp-img-box">
        <div class="webapp-box-header">
            <div>
                <div>
                    <ul class="webapp-box-header-ul">
                        <li>我的图片</li>
                        <li class="system-img-library">图片库</li>
                    </ul>
                </div>
            </div>
            <span class="webapp-box-close">×</span>
        </div>
        <div class="webapp-box-content">
            <div class="box-resource-content" id="webapp-my-img">
                <div>
                    <ul class="webapp-content-tab">
                        <li data-page="1" data-id="0" id="default-img-group">全部</li>
                    </ul>
                    <div class="resource-list-wrap">
                        <ul class="resource-list"></ul>
                    </div>
                </div>
            </div>
            <div class="box-resource-content" id="webapp-system-img">
                <ul class="webapp-content-tab">
                  <li data-page="1" data-id="0">全部</li>
                </ul>
                <div class="resource-list-wrap">
                    <ul class="resource-list"></ul>
                </div>
            </div>
            <div class="content-top-operation">
                <div class="box-operation-menu">
                    <ul>
                        <li class="btn btn-success green webuploader-container" id="select-local-img"><div class="webuploader-pick">上传至当前组</div><div id="rt_rt_1bt3hcrs7bjhefn1nq11mgc5ie1" style="position: absolute; top: 6px; left: 12px; width: 84px; height: 18px; overflow: hidden; bottom: auto; right: auto;"><input name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/gif,image/jpg,image/jpeg,image/bmp,image/png" type="file"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"></label></div></li>
                        <li class="btn btn-default" data-href="#img-box-group-create">新建分组</li>
                        <li class="btn btn-default cannot-operate-default edit-img-group" data-href="#img-box-group-edit">编辑分组</li>
                        <li class="btn btn-default img-batch" data-href="#box-img-batch">批量处理</li>
                    </ul>
                </div>
                <div class="box-hide" id="img-box-group-edit">修改组名 <input class="group-name-input form-control input" type="text">
                    <a href="javascript:;" class="btn btn-success green group-edit-confirm">确定</a>
                    <a href="javascript:;" class="btn btn-default group-edit-cancel">取消</a>
                    <a href="javascript:;" class="btn btn-danger orange delete-img-group">删除当前组</a>
                </div>
                <div class="box-hide" id="img-box-group-create">新建分组 <input class="group-name-input form-control input" type="text">
                    <a href="javascript:;" class="btn btn-success green group-edit-confirm">确定</a>
                    <a href="javascript:;" class="btn btn-default group-edit-cancel">取消</a>
                    <span>组名不超过6个字</span>
                </div>
                <div class="box-hide" id="box-img-batch">已选<span class="resource-select-num">0</span>张
                    移至 <select class="resource-group-select form-control"></select>
                    <a href="javascript:;" class="btn btn-success green group-edit-confirm">确定</a>
                    <a href="javascript:;" class="btn btn-danger orange delete-select-img">删除选中图片</a>
                    <a href="javascript:;" class="btn btn-default group-edit-cancel">取消</a>
                </div>
            </div>
        </div>
    </div>
    <div class="webapp-box-bg" id="img-crop-box-bg"></div>
    <div class="webapp-box" id="img-crop-box">
        <div class="webapp-box-header">
            <div class="webapp-box-header-ul">
              <span style="font-size:16px;">图片裁剪</span>
            </div>
            <span class="webapp-box-close">×</span>
        </div>
        <div class="webapp-box-content">
            <div class="form-inline img-crop-top-input">
                <span>宽度: </span><input class="form-control input-sm input img-crop-width-input" value="NaN" type="text">
                <span>高度: </span><input class="form-control input-sm input img-crop-height-input" value="NaN" type="text">
            </div>
            <div class="img-crop-body">
                <div class="img-crop-body-left">
                    <label>原图比例<input class="img-box-ui-radio" data-ratio="1" name="img-box-ratio" type="radio"></label>
                    <label>1:1<input class="img-box-ui-radio" data-ratio="1" name="img-box-ratio" type="radio"></label>
                    <label>4:3<input class="img-box-ui-radio" data-ratio="4/3" name="img-box-ratio" type="radio"></label>
                    <label>3:4<input class="img-box-ui-radio" data-ratio="3/4" name="img-box-ratio" type="radio"></label>
                    <label>16:9<input class="img-box-ui-radio" data-ratio="16/9" name="img-box-ratio" type="radio"></label>
                    <label>自由拖动<input class="img-box-ui-radio" data-ratio="0" name="img-box-ratio" type="radio"></label>
                </div>
                <div class="img-crop-body-right">
                  <div class="img-crop-scope">
                      <img id="img-crop-target" style="display: none; visibility: hidden; width: 0px; height: 0px;">
                      <div style="width: 0px; height: 0px; position: relative; background-color: black;" class="jcrop-holder">
                          <div style="position: absolute; z-index: 600;">
                              <div style="width: 100%; height: 100%; z-index: 310; position: absolute; overflow: hidden;">
                              <img style="border: medium none; visibility: visible; margin: 0px; padding: 0px; position: absolute; top: 0px; left: 0px; width: 0px; height: 0px;">
                                  <div style="position: absolute; opacity: 0.4;" class="jcrop-hline"></div>
                                  <div style="position: absolute; opacity: 0.4;" class="jcrop-hline bottom"></div>
                                  <div style="position: absolute; opacity: 0.4;" class="jcrop-vline right"></div>
                                  <div style="position: absolute; opacity: 0.4;" class="jcrop-vline"></div>
                                  <div class="jcrop-tracker" style="cursor: move; position: absolute; z-index: 360;"></div>
                              </div>
                              <div style="width: 100%; height: 100%; z-index: 320; display: block;">
                                  <div style="cursor: n-resize; position: absolute; z-index: 370;" class="ord-n jcrop-dragbar"></div>
                                  <div style="cursor: s-resize; position: absolute; z-index: 371;" class="ord-s jcrop-dragbar"></div>
                                  <div style="cursor: e-resize; position: absolute; z-index: 372;" class="ord-e jcrop-dragbar"></div>
                                  <div style="cursor: w-resize; position: absolute; z-index: 373;" class="ord-w jcrop-dragbar"></div>
                                  <div style="cursor: n-resize; position: absolute; z-index: 374; opacity: 0.5;" class="ord-n jcrop-handle"></div>
                                  <div style="cursor: s-resize; position: absolute; z-index: 375; opacity: 0.5;" class="ord-s jcrop-handle"></div>
                                  <div style="cursor: e-resize; position: absolute; z-index: 376; opacity: 0.5;" class="ord-e jcrop-handle"></div>
                                  <div style="cursor: w-resize; position: absolute; z-index: 377; opacity: 0.5;" class="ord-w jcrop-handle"></div>
                                  <div style="cursor: nw-resize; position: absolute; z-index: 378; opacity: 0.5;" class="ord-nw jcrop-handle"></div>
                                  <div style="cursor: ne-resize; position: absolute; z-index: 379; opacity: 0.5;" class="ord-ne jcrop-handle"></div>
                                  <div style="cursor: se-resize; position: absolute; z-index: 380; opacity: 0.5;" class="ord-se jcrop-handle"></div>
                                  <div style="cursor: sw-resize; position: absolute; z-index: 381; opacity: 0.5;" class="ord-sw jcrop-handle"></div>
                              </div>
                          </div>
                          <div class="jcrop-tracker" style="width: 4px; height: 4px; position: absolute; top: -2px; left: -2px; z-index: 290; cursor: crosshair;"></div>
                          <input style="position: fixed; left: -120px; width: 12px;" class="jcrop-keymgr" type="radio">
                          <img style="display: block; visibility: visible; width: 0px; height: 0px; border: medium none; margin: 0px; padding: 0px; position: absolute; top: 0px; left: 0px; opacity: 0.6;">
                      </div>
                </div>
              </div>
            </div>
        </div>
        <div class="webapp-box-footer">
          <button class="btn btn-info blue img-crop-cancel">不裁剪</button>
          <button class="btn btn-success green img-crop-confirm">裁剪</button>
          <button class="btn btn-default img-crop-return" style="margin-left:50px;">取消</button>
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

    <script>
//        添加标签提示页面
        $('.add-label-btn').click(function(){
            $('#add-label').css('display','block');
        })
//        关闭提示页
        $('.labelClose').click(function(){
            $('#add-label').css('display','none');
        })

//        试用页面
        $('.advanced-label-btn').click(function(){
            $('#advanced-container').css('display','block');
        })
    </script>
</body>
</html>
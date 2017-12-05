<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>首页</title>
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

    <!-- 引入CSS文本 -->
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/common.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/index.css">
    <style type="text/css" rel="stylesheet">
        body{zoom: 98.71428571428571%;}
        .notice, .newFun {
          position: fixed;
          right: 120px;
          bottom: 0;
          width: 300px;
          z-index: 9999;
          font-family: '微软雅黑','Microsoft Yahei';
        }
        .notice {
          -webkit-box-shadow: 0px 1px 6px rgba(160, 160, 160, 0.65);
                  box-shadow: 0px 1px 6px rgba(160, 160, 160, 0.65);
                  background-color: #fff;
        }
        .notice ul{
          background-size: 100px auto;
          background-repeat: no-repeat;
          padding: 10px 40px 0;
          background-position: right center;
        }
        .notice p {
          border-radius: 2px 2px 0 0;
          height: 30px;
          color: #fff;
          text-align: center;
          line-height: 30px;
        }
        .noticeClose {
          display: inline-block;
          width: 30px;
          height: 30px;
          cursor: pointer;
          position: absolute;
          top: 0;
          right: 0;
          font-size: 24px;
          border-radius: 0 2px 0 0;
        }
        .noticeClose:hover{
          background-color: #137be3;
        }
        .newFun .noticeClose:hover{
          background-color: rgba(18, 74, 130, 0.39);
        }
        .newFun div{
          padding: 10px 40px 0;
          background-position: right center;
          border-radius: 4px 4px 0 0;
        }
        .newFun > p {
          position: absolute;
          top: 0;
          left: 0;
          color: #fff;
          width: 100%;
          padding: 3px 0;
        }
        .newFun div p {
          text-align: center;
          color: #fff;
          padding-bottom: 10px;
        }
        .newFun li {
          font-size: 12px;
          list-style: disc;
          list-style-position: inside;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
          line-height: 20px;
          margin-top: 10px
        }
        .notice  div > span:last-child,
        .newFun div > a:last-child{
          border-radius: 2px;
          border: 1px solid #3091f2;
          display: block;
          margin: 20px auto 0;
          width: 90px;
          text-align: center;
          height: 30px;
          line-height: 30px;
          color: #3091f2;
          font-size: 12px;
        }
        .notice  div > span:last-child:hover,
        .newFun div > a:last-child:hover{
          color: #fff;
          background-color: #3091f2;
        }
    </style>
</head>
<body is_login="0" user_token="" class="webapp">

    <div id="flag" style="display:none;">首页</div>
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

    <!-- 微信小程序功能特性 -->
    <div>
        <p class="g-title">奶牛应用为不同行业提供小程序核心功能</p>
        <p style="text-align: center;font-size: 18px;color: #303445;font-weight: 500;margin-top: -23px;">各种场景核心功能，一键生成小程序，提前布局微信新生态，抢占第一波红利</p>

        <div class="core-function">
            <span>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/O2O.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/O2O-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">O2O电商</p>
                        <p class="core-function-title-two">线上运营、线下消费，手机直接管理订单</p>
                    </div>
                </a>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/usenet.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/usenet-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">新闻资讯</p>
                        <p class="core-function-title-two">同步热点资讯，在线话题互动</p>
                    </div>
                </a>
            </span>
            <span>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/reservation-service.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/reservation-service-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">预约服务</p>
                        <p class="core-function-title-two">合理分配门店资源，弹性管理预约时间</p>
                    </div>
                </a>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/many-stores-platform.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/many-stores-platform-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">多店平台</p>
                        <p class="core-function-title-two" style="left: 93px;">多门店统一管理运营</p>
                    </div>
                </a>
            </span>
            <span>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/shop-system.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/shop-system-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">到店系统</p>
                        <p class="core-function-title-two" style="left: 26px;">线上提前预约，线下扫描点餐，提高执行效率</p>
                    </div>
                </a>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/wisdom-stores.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/wisdom-stores-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">智慧门店</p>
                        <p class="core-function-title-two" style="left: 40px;">WiFi、当面付、会员卡等打造智慧门店</p>
                    </div>
                </a>
            </span>
            <span>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/take-out-service.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/take-out-service-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">美食外卖</p>
                        <p class="core-function-title-two" style="left: 54px;">轻松管理外卖订单，提升餐厅营收</p>
                    </div>
                </a>
                <a href="" target="_blank">
                    <div class="core-function-hover">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/marketing-tool.png" alt="">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/index/marketing-tool-hover.png" alt="" class="core-function-img-hover">
                        <p class="core-function-title-one">营销工具</p>
                        <p class="core-function-title-two" style="left: 33px;">秒杀、拼团、集集乐等多种玩法，助力营销</p>
                    </div>
                </a>
            </span>
        </div>
    </div>
    <!-- 功能特性结束 -->

    <div style="padding-bottom: 65px;">
        <p class="g-title">小程序核心场景</p>
        <!-- 微信小程序应用场景 -->
        <div class="app-scene">
            <span>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/find-app.svg" alt="" style="width: 28px;height: 34px">
                <p>分享到群</p>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/accessory-app.svg" alt="" style="width: 38px;height: 34px">
                <p>附近小程序</p>
            </span>
            <span>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/scan-code.svg" alt="" style="width: 32px;height: 39px">
                <p>线下扫码</p>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/share-wx.svg" alt="" style="width: 29px;height: 34px">
                <p>支付完成页</p>
            </span>
            <span>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/top-search.svg" alt="" style="width: 32px;height: 37px">
                <p>微信搜索</p>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/mini-apps.svg" alt="" style="width: 33px;height: 34px">
                <p>小程序列表</p>
            </span>
            <span>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/code-drainage.svg" alt="" style="width: 27px;height: 42px">
                <p>聊天顶部</p>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/WCOA.svg" alt="" style="width: 41px;height: 42px">
                <p>公众号主页</p>
            </span>
            <span>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/recommend-friend.svg" alt="" style="width: 44px;height: 44px">
                <p>推荐给好友</p>
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/article.svg" alt="" style="width: 38px;height: 34px">
                <p>公众号文章</p>
            </span>
        </div>
        <!-- 应用场景结束 -->
    </div>
    <div class="join">
        <p>诚邀合作伙伴加盟</p>
        <a href="<?php echo U('Applet/Join/index');?>">立即了解详情</a>
    </div>
    <div style="background-color: #fff;padding-bottom: 70px;">
        <p class="g-title">开发流程</p>
        <!-- 微信小程序开发流程 -->
        <div class="step-content">
            <div class="make-step">
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/3-1.png" alt="申请微信小程序" rel="nofollow">
                <p class="step-title">申请小程序</p>
                <p>微信公众平台申请小程序</p>
            </div>
            <div class="step-next"><img src="/cowcms/Public/css_js_font_img/applet/image/index/3-0.png" alt="微信支付小程序" rel="nofollow"></div>
            <div class="make-step">
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/3-2.png" alt="微信支付小程序" rel="nofollow">
                <p class="step-title">微信支付</p>
                <p>申请小程序微信支付</p>
            </div>
            <div class="step-next"><img src="/cowcms/Public/css_js_font_img/applet/image/index/3-0.png" alt="点击制作小程序" rel="nofollow"></div>
            <div class="make-step">
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/3-3.png" alt="点击制作小程序" rel="nofollow">
                <p class="step-title">点击制作</p>
                <p>可视化自由拖拽</p>
            </div>
        </div>
        <div class="step-content">
            <div class="make-step">
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/3-4.png" alt="一键打包小程序" rel="nofollow">
                <p class="step-title">一键打包</p>
                <p>生成发布到管理页面，打包并下载</p>
            </div>
            <div class="step-next"><img src="/cowcms/Public/css_js_font_img/applet/image/index/3-0.png" alt="微信开发者工具" rel="nofollow"></div>
            <div class="make-step">
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/3-5.png" alt="微信开发者工具" rel="nofollow">
                <p class="step-title">微信开发者工具</p>
                <p>代码添加至开发者工具，预览检查</p>
            </div>
            <div class="step-next"><img src="/cowcms/Public/css_js_font_img/applet/image/index/3-0.png" alt="微信审核" rel="nofollow"></div>
            <div class="make-step">
                <img src="/cowcms/Public/css_js_font_img/applet/image/index/3-6.png" alt="微信审核" rel="nofollow">
                <p class="step-title">微信审核</p>
                <p>上传成功之后，微信公众平台审核</p>
            </div>
        </div>
        <!-- 开发流程结束 -->
    </div>
    <div class="video_content">
        <p class="video-title">视频教程</p>
        <div class="tutorial_video">
            <div style="height: 15vmin;position: relative;width: 15vmin;margin: 0 auto;" id="video_play">
               <span class="video_circle"></span>
               <img src="/cowcms/Public/css_js_font_img/applet/image/index/play.png" alt="" rel="nofollow">
            </div>
            <p>5分钟快速制作小程序演示</p>
        </div>
        <div style="height: 110px;text-align: center;">
            <a href="">查看更多</a>
        </div>
    </div>
    <div style="padding-bottom: 70px;">
        <!-- 微信小程序精彩案例 -->
        <p class="g-title">微信小程序精彩案例[集]</p>
        <p style="text-align: center;">请用微信扫一扫查看</p>
        <div class="miniAppCase">
            <ul>
                <li>
                    <div style="display: flex;justify-content: center;align-items: center;height: 200px;"><img src="/cowcms/Public/css_js_font_img/applet/image/index/jisuapp.jpg" alt="微信程序秀小程序" rel="nofollow"></div>
                    <p>程序秀</p>
                    <div class="qrcode"><img src="/cowcms/Public/css_js_font_img/applet/image/index/fushiLite.jpg" alt="微信程序秀小程序二维码" rel="nofollow"></div>
                </li>
                <!--遍历-->
                <li>
                    <img src="/cowcms/Public/css_js_font_img/applet/image/index/fushiLite.png" alt="微信服饰Lite小程序" rel="nofollow">
                    <p>服饰Lite</p>
                    <div class="qrcode"><img src="/cowcms/Public/css_js_font_img/applet/image/index/fushiLite.jpg" alt="微信服饰Lite小程序二维码" rel="nofollow"></div>
                </li>

                <li>
                    <img src="/cowcms/Public/css_js_font_img/applet/image/index/chengxuxiu.jpg" alt="微信即速应用商家版小程序" rel="nofollow">
                    <p>即速应用商家版</p>
                    <div class="qrcode"><img src="/cowcms/Public/css_js_font_img/applet/image/index/fushiLite.jpg" alt="微信即速应用商家版小程序二维码" rel="nofollow"></div>
                </li>
            </ul>
            <a style="text-align: center;color: #393939;font-size: 16px;margin-top: 20px;" target="_blank" href="">更多案例&gt;&gt;</a>
        </div>
        <!-- 小程序精彩案例结束 -->
    </div>
    <div style="background-color: #fff;padding-bottom: 120px;">
        <p class="hot-article-title">行业热文</p>
        <p class="hot-article-small-title">深度见解，行业前沿</p>
        <a href="/cowcms/index.php/applet/Article/index" target="_blank" class="hot-article-more">查看更多</a>
        <ul class="hot-article-list">
            <!--遍历文章-->
            <li class="hot-article-list-item">
                <a href="/cowcms/index.php/applet/Article/example" target="blank">
                    <div class="item-img">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/article/file_59e9d15aeb01c.png" alt="标题" rel="nofollow">
                        <div class="item-title">标题</div>
                    </div>
                    <div class="item-intro">简介</div>
                </a>
            </li>

        </ul>
        <div class="making-online">
            <h2 class="making-online-title">免费在线制作</h2>
            <div class="making-online-options">
                <a href="/cowcms/index.php/applet/Join/index" target="_blank" class="option">招募代理</a>
                <a href="/cowcms/index.php/applet/Make/index" target="_blank" class="option">立即制作</a>
            </div>
        </div>
    </div>

    <!-- 引入底部 -->
        <!-- 底部 -->
    <div class="page" id="foot_page" style="background-color:#454545">
        <div class="foot">
            <div class="service_advice">
                <p class="foot_title">关于我们</p>
                <p class="foot_detail"><a href="" target="_blank">公司简介</a></p>
                <p class="foot_detail"><a href="" target="_blank">帮助中心</a></p>
                <p class="foot_detail"><a href="" target="_blank">媒体报导</a></p>
                <p class="foot_detail"><a href="">服务咨询</a></p>
            </div>
            <div class="connect_us">
                <p class="foot_title">联系我们</p>
                <p class="foot_detail" style="font-size:16px;">业务咨询：<?php echo L('COMPANY_PHONE');?></p>
                <p class="foot_detail" style="font-size:16px;">客服反馈：<?php echo L('COMPANY_EMAIL');?></p>
                <p class="foot_detail" style="font-size:16px;">周一至周五 9：00-18：00</p>
                <p class="foot_detail" style="font-size:15px;">公司地址：<?php echo L('COMPANY_ADDRESS');?></p>
            </div>
            <div class="wechat_qrcode">
                <p class="foot_title"><span>官方微信</span><span>官方微博</span></p>
                <img src="/cowcms/Public/css_js_font_img/applet/image/public/weixinfw.jpg" alt="" rel="nofollow">
                <img src="/cowcms/Public/css_js_font_img/applet/image/public/zhichi_microblog.png" alt="" rel="nofollow">
            </div>
            <!-- 友情链接,遍历 -->
            <div class="fre_link">
                <p class="foot_title">友情链接</p>
                <span><a href="" target="_blank">web前端开发</a></span>
            </div>
        </div>
        <div>
            <div id="foot_bottom">
                <span><?php echo L('COMPANY_NAME');?>©2015 奶牛网络 <a href=""_blank">粤ICP备16110707号</a></span>
                <span class="ebsgovicon">
                    <a href="" target="_blank">
                        <img src="/cowcms/Public/css_js_font_img/applet/image/public/newGovIcon.gif" title="深圳市市场监督管理局企业主体身份公示" alt="深圳市市场监督管理局企业主体身份公示" style="border-width:0px;border:hidden; border:none;" width="70" height="28" border="0">
                    </a>
                </span>
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

    <!--视屏播放窗口-->
    <div id="video" class="video" style="display: none;">
        <div style="position: relative;width: 700px;height: 525px;top: 50%;margin: -260px auto;">
            <span class="close">&times;</span>
            <video preload="preload" controls="controls" poster="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp_home/img/video.jpg">
                <source type="video/mp4" src="/cowcms/Public/css_js_font_img/applet/video/webapp.mp4"></source>
            </video>
        </div>video
    </div>

<script>
//    视频播放
    $('#video_play').click(function(){
        $('#video').css('display','block');
    });
    $('.close').click(function(){
        $('#video').css('display','none');
    });
</script>

    <!--公告-->
    <div class="notice" style="display: none;background-image: url(//test.zhichiwangluo.com/static/pc/index/img/newfunbg.png); background-size: 100% auto;background-repeat: no-repeat;border-radius: 2px 2px 0 0;background-color: #fff;background-position: 0 -25px;overflow: hidden;">
        <p>
            <span style="float: left;">
                <img style="margin-left: 7px; width: 14px; margin-top: 7px;margin-right: 5px;vertical-align: top;" src="/cowcms/Public/css_js_font_img/applet/image/index/noticelogo.png" alt="">咫尺网络</span>
            <span class="noticeClose" style="float: right;height: 25px;    width: 25px;    text-align: center;">×</span>
        </p>
        <img style="position: absolute;bottom: 80px;right: -10px;" src="/cowcms/Public/css_js_font_img/applet/image/index/noticebg.png" alt="">
        <a class="for-more" target="_blank" style="display: block;padding-bottom: 30px;">
            <div>
                <p style="margin-top: 10px;font-size: 24px; font-weight: 600;text-shadow: 1px 1px 4px rgba(3, 74, 146, 0.8);">公告</p>
                <p style="font-size: 12px;">您的关注是我们的动力</p>
                <div>
                    <ul style=" margin-top: 35px; bottom: 0;">
                        <li>
                            <p style="color: #59607b;line-height: unset;height: auto;padding-top: 10px;">我是标题</p>
                            <p style="color: #59607b;text-align: left; height: auto;line-height: unset; padding-top: 20px;">功能介绍，功能介绍</p>
                        </li>
                    </ul>
                </div>
                <span>查看详情</span>
            </div>
        </a>
    </div>

    <!--新功能上线-->
    <div class="newFun" style="display: none;background-image: url(//test.zhichiwangluo.com/static/pc/index/img/newfunbg.png); background-size: 100% auto;background-repeat: no-repeat;border-radius: 2px 2px 0 0;background-color: #fff;padding-bottom: 30px;">
        <p>
            <span style="float: left;">
                <img style="margin-left: 7px; width: 14px; margin-top: 2px;margin-right: 5px;vertical-align: top;" src="/cowcms/Public/css_js_font_img/applet/image/index/noticelogo.png" alt=""></span>
            <span class="noticeClose" style="float: right;height: 25px;    width: 25px;    text-align: center;">×</span></p>
        <div>
            <p style="margin-top: 27px;font-size: 20px;text-shadow: 1px 1px 4px rgba(3, 74, 146, 0.8);">新功能上线</p>
            <p style="font-size: 13px;" class="count"></p>
            <p style="font-size: 13px;">帮助您打造更贴心的小程序</p>
            <ul style=" margin-top: 55px; bottom: 0; width: 100%;">
            </ul>
            <a href="" target="_blank">查看更多</a>
        </div>
    </div>

</body>
</html>
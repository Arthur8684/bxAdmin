<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>案例</title>
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

    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/webapp_case.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/common.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/bootstrap-paginator.css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/nav.css">
    <link href="/cowcms/Public/css_js_font_img/applet/css/WdatePicker.css" rel="stylesheet" type="text/css">
    <!-- tg.jisuapp.cn下添加360统计代码 -->
    <style type="text/css" rel="stylesheet">body{zoom: 98.71428571428571%;}</style>
</head>
<body isadmin="0" class="webapp">
<div id="flag" style="display:none;">案例</div>
<div class="all_wrap">
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

    <div class="intt_wrap">
      <!-- 选项卡 -->
      <div class="case_nav">
        <nav class="inv-type">
          <div id="navul" style="display: inline-block;">
            <span class="tab tab-active" data-id="0">全部</span>
            <span class="tab " data-id="1">小程序</span>
          </div>
        </nav>
      </div>
      <header class="inv-head"></header>
      <div class="intt_liwrap" id="list_wrap">
        <ul id="list">
            <!-- 遍历 -->
            <li class="intt_list" int-id="fVVY0Fw2ZP">
               <img class="intt_feng" src="/cowcms/Public/css_js_font_img/applet/image/case/t_1503559223599e7e3790b77.png" onerror="erroritt(this)">
                <div class="intt_setwrap">
                    <p title="母婴小程序（拼团）">母婴小程序（拼团）</p>
                    <p class="itt_au">
                      <span class="inv-author" title="‘‘’’">‘‘’’</span>
                      <span class="inv-count">12万</span>
                    </p>
                </div>
                <div class="intt_mask">
                   <img src="/cowcms/Public/css_js_font_img/applet/image/case/fushiLite.jpg">
                   <button class="itt_preview">预览</button>
                </div>
            </li>
        </ul>
        <!-- 分页 -->
        <div id="showpage" current_page="1" total_page="37350" class="tpl-pagination">
            <a href="" onclick="changeUrl(1)" class="active">1</a>
            <a href="" onclick="changeUrl(2)" class="">2</a>
            <a href="" class="next" onclick="changeUrl(2)">下一页</a>
        </div>
      </div>

        <!--置顶-->
      <span class="scrollTop use" id="Top">
        <img src="/cowcms/Public/css_js_font_img/applet/image/case/nav4.png" alt="" style="margin:10px 0 0 0;" id="Top_img">
      </span>
      <script type="text/javascript">
        $('#Top').mouseover(function(){
          $('#Top_img').attr('src','/cowcms/Public/css_js_font_img/applet/image/case/nav5.png');
        });
        $('#Top').mouseleave(function(){
          $('#Top_img').attr('src','/cowcms/Public/css_js_font_img/applet/image/case/nav4.png');
        })
      </script>
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

      </div>

<!--留言框，默认隐藏-->
  <div class="msg_wrap" style="display:;">
    <div class="msg">
      <textarea name="" id="msg_text" cols="30" rows="10" placeholder="你想留下些什么呢？"></textarea>
      <button id="msg_confrim">确定</button>
      <button id="msg_cancel">取消</button>
    </div>
  </div>

</body>
</html>
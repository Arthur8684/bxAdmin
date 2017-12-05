<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <title>小程序培训</title>
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

  <link rel="stylesheet" type="text/css" href="/cowcms/Public/css_js_font_img/applet/css/new_common.css">
  <link rel="stylesheet" type="text/css" href="/cowcms/Public/css_js_font_img/applet/css/trainingcourse.css">
  <style type="text/css" rel="stylesheet">body{zoom: 98.71428571428571%;}</style>
</head>
<body>
<div id="flag" style="display:none;">教程论坛</div>
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

  <div class="banner" style="height: 393.458px;">
    <img src="/cowcms/Public/css_js_font_img/applet/image/train/banner.jpg" style="height: 393.458px;">
    <div class="join-in" id="join-in">
      <span></span>
      <a href="#dump"><img src="/cowcms/Public/css_js_font_img/applet/image/train/apply.png" alt="" style="margin-top:-47px;"></a>
    </div>
  </div>
  <div class="wechat-intro">
    <p style="padding: 104px 599px;font-size: 26px;">课程介绍</p>
    <p style="padding: 65px 136px;line-height: 33px;">
      小程序是微信2017年1月9日正式上线的一个新时代产品，它是一种无需下载安装即<br>可使用的应用，实现了应用「触手可及」的梦想，用户扫一扫或搜一下即可打开应<br>用，也体现了「用完即走」的理念，应用将无处不在，随时可用，但又无需安装卸<br>载。
    </p>
    <p style="padding: 103px 798px;line-height: 33px; width: 423px;">
      这套课程，是为不懂编程代码但又希望能亲自开发微信小程序的学<br>员们量身打造的，课程主要围绕「即速应用」各个功能组件结合精<br>彩案例进行讲解，由设计到推广所有小程序知识要点分8大章节全<br>面梳理，专业讲师细致讲解，丰富案例深入剖析，让学员无需编程<br>基础也可以轻松制作一款精美的小程序！
    </p>
  </div>

  <div class="course-intro">
    <p style="padding: 104px 599px;font-size: 26px;width:300px;">你能学到什么</p>
    <p style="padding: 24px 360px;">使用即速应用制作<br>自己的微信小程序</p>
    <p style="margin: -62px 679px;width: 179px;">清晰设计思路<br>逻辑性制作自己的展示/店铺</p>
    <p style="margin-left: 981px;margin-top: 47px;width: 205px;">让学员无编程基础轻松也可以<br>轻松制作一款精美的小程序！</p>
    <p style="margin-left: 540px;margin-top: 97px;width: 150px;">熟悉整套上传流程<br>轻松对接微信公众平台</p>
    <p style="margin-left: 853px;margin-top: -36px;width: 150px;">理解各个功能组件及<br>后台系统的实际应用</p>
  </div>

  <div class="hundredB">
    <p style="padding: 104px 599px;font-size: 26px;width:300px;">课程参数</p>
    <ul style="margin-left: -658px;line-height: 45px;margin-top: -7px;text-align: center;">
       <li style="font-size:16px">项目</li><li>课程名称</li><li>讲师</li><li>包含内容</li><li>学习时长</li><li>学习方式</li><li>适用人群</li><li>课程咨询</li>
    </ul>
    <ul style="margin-left: 358px;line-height: 45px;margin-top: -362px;text-align: center;">
       <li style="font-size:16px">详情信息</li>
       <li>微信小程序从基础到实战</li>
       <li>六弦居</li>
       <li>高清视频教程+丰富素材+PPT课件</li>
       <li>约6小时6分钟</li>
       <li>观看教学视频+学员群交流互动</li>
       <li>一切对微信小程序感兴趣的人群</li>
       <li>QQ：3403272607</li>
    </ul>
  </div>
  <div class="course_catalogue" style="text-align: center;">
    <p style="padding: 104px 510px;font-size: 26px;width:300px;">课程目录</p>
    <div style="width: 323px;margin-left: 113px;line-height: 37px;text-align: left;">
        <p style="font-size:16px;">第一课 小程序现状</p>
        <p style="color: #9fa5bb;">本节主要说明微信小程序发展现状分析、即速应用功<br>能组件概述</p>
        <p style="font-size:16px;">第二课 即速应用后台详解</p>
        <p style="color: #9fa5bb;">应用数据设置管理、多商家管理应用、小程序管理</p>
        <p style="font-size:16px;">第三课 前端与后台完美对接</p>
        <p style="color: #9fa5bb;">动态列表与详情页、商品组件与营销工具的配合使用</p>
        <p style="font-size:16px;">第四章 资讯小程序的大发展</p>
        <p style="color: #9fa5bb;">功能组件的灵活使用 自由面板与导航的快速体验</p>
    </div>
    <div style="width: 346px;margin-left: 777px;line-height: 42px;text-align: left;margin-top: 121px;">
        <p style="font-size:16px;">第五章 电商小程序的组合战略（一）</p>
        <p style="color: #9fa5bb;">电商、预约、到店的战略组合 降低运营成本</p>
        <p style="font-size:16px;">第六章 电商小程序的组合战略</p>
        <p style="color: #9fa5bb;">客服、储值、营销工具完美提升用户忠诚度</p>
        <p style="font-size:16px;">第七章 多商家小程序</p>
        <p style="color: #9fa5bb;">前端与后台区分总店和子店 实战子店入驻 提高运营效率</p>
        <p style="font-size:16px;">第八章 快速生成微信小程序</p>
        <p style="color: #9fa5bb;">开发者工具详细讲解 模板示范快速搭建精品小程序</p>
    </div>
  </div>
  <div class="tutor-intro">
    <p style="padding: 104px 608px;font-size: 26px;width:300px;">讲师介绍</p>
    <div style="margin-left: -790px;margin-top: 190px;text-align: center;line-height: 32px;">
        <p style="font-size: 18px;">老马</p>
        <p>大连嘉屹新媒体有限公司CEO</p>
    </div>
    <div class="tutor-intro-box" style="margin-left: 549px;width: 673px;color: #59607b;line-height: 30px;margin-top: -214px;">
      <p> &nbsp;H5行业资深设计师，有六年新媒体运营经验，对微信行业形态具有独特的见解；微信小程序资深讲师，幽默风趣的讲课风格深受学员喜爱。<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服务特色：小程序浪潮汹涌来袭，未来也是互联网生态的趋势所向，该课程向大家详细讲述如何借助「<br>即速应用」功能组件快速搭建微信小程序，是较为完整的一套小程序制作视频，让广大学员通过学习，一键<br>制作属于自己的精美小程序作品</p>
    </div>
  </div>
  <div class="course_proved" style="text-align: center;width: 270px;height: 175px;">
    <p style="font-size: 26px;color: #000;padding-top: 70px;">课程试看</p>
    <div class="courseImg look-video" style="cursor: pointer;">
    </div>
  </div>
  <div class="video" style="margin: 0 auto;margin-top: 83px; width: 1300px;height: 508px;z-index: 999; background: #fff;color: #000;">
    <div style="position: relative;width: 100%;height: 100%;">
      <video src="/cowcms/Public/css_js_font_img/applet/video/cyk1.mp4" controls="controls" style="width: 100%;height: 100%;">
              您的浏览器不支持 video 标签。
      </video>
      <div style="position: absolute;right: 0;top: 0;font-size: 20px;padding:5px;cursor: pointer;"></div>
    </div>
  </div>
  <div class="join-info">
    <div style="text-align: center;">
      <img src="/cowcms/Public/css_js_font_img/applet/image/train/course_proved.png" alt="" style="margin-top: 90px;">
      <p style="font-size: 26px;padding-top: 67px;margin-top: -130px;">    <a  id="dump">课程报名</a></p>
    </div>
    <div style="color: #9fa5bb;font-size: 14px;text-align: center;line-height: 33px;margin-left: 160px;margin-top: 393px;width: 323px;">
      <span class="red-text" style="font-size: 25px;line-height: 19px;display: inline-block;height: 10px;margin-right: 5px;vertical-align: middle;">*</span>报名且支付成功后，会自动跳转到QQ群，申请<br>入群后需要审核，审核时间是工作日10:00-18:<br>00，其他时间报名的都会在审核时间内统一处理，<br>请学员耐心等待。课程咨询及帮助：<br>
      QQ 3403272607
    </div>
    <div style="width: 400px;margin-top: -426px; margin-left: 789px;font-size:18px">
      <p>
        <span>课程限时抢购价</span>
        <span style="font-size:22px;color:#fa4b16;margin: 0 15px;display: inline-block;">￥39</span>
        <s style="color:#9fa5bb">￥399</s>
      </p>
      <img src="/cowcms/Public/css_js_font_img/applet/image/train/baoming1.png" style="margin-left: -85px;">
    </div>
    <div style="text-align: center;margin-left: 66ox;width: 410px;margin-left: 707px;">
        <div><label class="red-text" for="name">*</label><input placeholder="姓名" id="name" name="" type="text"></div>
        <div><label class="red-text" for="phone">*</label><input placeholder="手机号" id="phone" name="" type="text"></div>
        <div><label class="red-text" for="QQ">*</label><input placeholder="QQ" id="QQ" name="" type="text"></div>
      <div class="submit-btn" id="submit-btn">立即报名</div>
        <p><label style="vertical-align: -webkit-baseline-middle;" class="red-text" for="name">*</label><span style="color: #9fa5bb;">报名且成功后，请进QQ群获取培训视频</span></p>
    </div>
  </div>
  <div class="course_footer">
    <div style="width: 312px;height: 125px;margin-left: 559px;line-height: 60px;padding-top: 78px;">
      <p>
        <span style="display: inline-block;margin: 0 30px;vertical-align: middle;font-size: 18px;">
            线下培训集锦
        </span>
        <span>
          <a href="" target="_blank"><img style="vertical-align: middle;" class="course_footer_hover" src="/cowcms/Public/css_js_font_img/applet/image/train/examine.png" alt=""></a>
        </span>
      </p>
      <p>
        <span style="display: inline-block;margin: 0 30px;vertical-align: middle;font-size: 18px;">
          制作小程序
        </span>
        <span>
          <a href="" target="_blank"><img class="course_footer_hover" src="/cowcms/Public/css_js_font_img/applet/image/train/make.png" alt="" style="margin-left: 18px;vertical-align: middle;"></a>
        </span>
      </p>
    </div>
    <div style="width: 410px;height: 160px;margin-left: 1025px;text-align: center;line-height: 35px;margin-top: -126px;">
      <p>联系方式</p>
      <p>服务热线： 0755-66606955</p>
      <p>讲师

        认证、培训机构、课程市场合作 ： QQ 3403272607</p>
    </div>
  </div>



<!--订单支付，默认隐藏-->
  <div class="cover-panel" id="payment-cover-win" style="display:none;">
    <div class="payment-panel">
      <p class="payment-title">订单支付<span class="payment-close">×</span></p>
      <div class="payment-inner" style="padding: 0 50px;">
        <div class="payment-v"><span>课程报名：</span><ul id="person-vip-version"><li>咫尺学堂报名</li></ul></div>
        <div class="payment-m"><span>付款金额：</span><span id="payment-money"></span>元</div>
        <div class="payment-t"><span>支付方式：</span><label><input data-ty="0" checked="checked" name="pay-type" type="radio"><span class="out-circle"><span></span></span>第三方支付平台</label></div>
        <div class="payment-t select-payment">
          <div class="payment-c">选择支付平台</div>
          <div class="third-payment" style="text-align:center;padding: 0 50px;">
            <div class="payment-alipay">
              <img src="/cowcms/Public/css_js_font_img/applet/image/train/alipay.png">
              <a target="_blank" id="alipay-btn" href="/cowcms/index.php/Index/Pay/Ali">点击去支付</a>
            </div>
            <div id="wechar-pay" class="payment-wx" style="display:;">
              <img src="/cowcms/Public/css_js_font_img/applet/image/train/wecharpay.png">
              <div id="wechar-btn" class="">点击去支付</div>
            </div>
            <div id="wechar-pay-qrcode" class="payment-wx" style="display:none;">
              <img id="wechar-pay-qrcode-img" class="payment-qcode" src="/cowcms/Public/css_js_font_img/applet/ali/index.gif" alt="">
              <div class="payment-wx-logo"><img src="/cowcms/Public/css_js_font_img/applet/image/train/wechat.jpg" alt="">微信扫码支付</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!--订单支付-->
  <div class="cover-panel" id="perfit-info-win" style="display:none;">
    <div class="perfit-panel">
      <p class="payment-title">订单支付<span class="payment-close">×</span></p>
      <div style="text-align: center;font-size: 16px;padding: 20px 0 10px;"><img style="width: 32px;vertical-align: middle;margin-right: 5px;" src="/cowcms/Public/css_js_font_img/applet/image/train/haspaid.png">恭喜报名成功，请加QQ群：<a style="color: #3091f2;text-decoration: underline;" target="_blank" href="https://jq.qq.com/?_wv=1027&amp;k=45kKtbG">290523089</a></div>
      <div class="perfit-info-wrap">
        <div>完善个人信息获取“VIP”</div>
        <div><label class="red-text">*</label><input id="perfit-phone" placeholder="手机号" name="" type="text"></div>
        <div><label class="red-text">*</label><input id="perfit-pw1" placeholder="密码" name="" type="password"></div>
        <div><label class="red-text">*</label><input id="perfit-pw2" placeholder="确认密码" name="" type="password"></div>
        <div class="course_reg-btn"><span class="reg-cancel">取消</span><span class="reg-submit">确认</span></div>
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

  <script type="text/javascript">
    $(function(){
      $('.look-video').on('click',function(event){
        $('.video').show();
        event.stopPropagation();
      })
      $('.close-video').on('click',function(){
        $('.video').hide();
        $('.video video')[0].pause();
      })
    })
  </script>

<script>
//  支付
  $('#submit-btn').click(function(){
      $('#payment-cover-win').css('display','block');
  });
  $('.payment-close').click(function(){
     $('#payment-cover-win') .css('display','none');
  });
//  微信支付
  $('#wechar-btn').click(function(){
      $('#wechar-pay').css('display','none');
      $('#wechar-pay-qrcode').css('display','');
  });
</script>
</body>
</html>
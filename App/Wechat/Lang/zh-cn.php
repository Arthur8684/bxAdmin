<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * ThinkPHP 简体中文语言包
 */
return array(
    /* 核心语言变量 */  
   'Wechat_AppID'     => 'AppID',
   'Wechat_AppSecret'     => 'AppSecret',
   'Wechat_Token'     => 'Token',
   'Wechat_EncodingAESKey'     => 'EncodingAESKey',
   'Base_Setting'     => '基本设置',
   'Menu_Setting'     => '菜单设置',
   'Seo_Img_Setting'     => '推广图片',
   'Menu_Name'     => '菜单',
   'Menu_Name_1'     => '菜单一',
   'Menu_Name_2'     => '菜单二',
   'Menu_Name_3'     => '菜单三',
   'Sub_Menu_Name'     => '子菜单',
   'Menu_type_click'     => '点击',
   'Menu_type_view'     => '链接',
   'Menu_Create_P'     => '微信创建菜单失败，请重新创建',
   'Wechat_EncodingAESKey_P'     => '消息加解密方式，微信选择了[安全模式（推荐）],需要填写改项，在微信中心查看该字符串',
   
   'Wechat_User_Pre'     => '用户名前缀',
   'Wechat_User_Pre_P'     => '关注公众号，自动注册时候，用户名的前缀',
   'Wechat_Pass_Num'     => '密码位数',
   'Wechat_Pass_Num_P'     => '关注公众号，自动注册时候，字段生成的密码位数',
   
   'Wechat_Remind_Open'     => '开启提醒',
   'Wechat_Remind_P'     => '关注的时候是否开启提醒',
   'Wechat_Concern_Tem'     => '关注模板',
   'Wechat_Concern_Tem_P'     => '为空表示不提醒，当关注公众号时，给关注者提醒的模板[user]：用户名，[pass]：密码，[nickname]：微信昵称，[nickname_]：上级微信昵称',
   'Wechat_Concern_Tem_1'     => '已关注模板',
   'Wechat_Concern_Tem_1_P'     => '为空表示不提醒，当关注公众号时，如果已经关注，或者关注过该公众号，给关注者提醒的模板[user]：用户名，[nickname]：微信昵称',
   'Wechat_Recommend_Tem'     => '上级模板',
   'Wechat_Recommend_Tem_P'     => '为空表示不提醒，当关注公众号时，给他上级提醒的模板[user]：用户名，[nickname]：微信昵称，[nickname_]:下N级用户昵称，[lev]:你第N层用户扫描二维码关注公众号',
   'Wechat_Order_Tem'     => '下单模板',
   'Wechat_Order_Tem_P'     => '为空表示不提醒，当购买产品下单后提示，[order_sn]:订单号，[order_name]:产品名称，[order_time]:下单日期，[order_price]:订单价格，[nickname]：微信昵称',
   'Wechat_Pay_Tem'     => '付款模板',
   'Wechat_Pay_Tem_P'     => '为空表示不提醒，当购买产品下单后提示，[order_sn]:订单号，[order_name]:产品名称，[pay_time]:付款日期，[pay_price]:订单价格，[nickname]：微信昵称',
   'Wechat_Pay_Recommend_Tem'     => '付款上级模板',
   'Wechat_Pay_Recommend_Tem_P'     => '为空表示不提醒，当付款后给上级提示，[order_sn]:订单号，[order_name]:产品名称，[pay_time]:付款日期，[pay_price]:订单价格，[nickname]：微信昵称，[nickname_]:消费者微信昵称，[lev]:会员层数，[scale]:分成比例，[scale_num]:分成数额 ',   
   
   'Wechat_W'     => '官方',
   'Wechat_Login_p'     => '你的账号有异，请与管理员联系',
   'Wechat_Create_Qrcode_P'     => '获取二维码失败，请重新获取',
   
   'Wechat_User_Img_Setting'     => '会员设置',
   'Wechat_User_Img_Setting_P'     => '每个会员可以单独设置推广图片，关闭只能是总后台设置，前台会员不能设置，统一用总后台的设置',
   
   'Wechat_Seo_Img_Price'     => '二维码价格',
   'Wechat_Seo_Img_Price_P'     => '获取二维码的价格，如果允许会员免费获取，请输入0',
   'Wechat_Seo_Img_Price_Msg'     => '购买提示',
   'Wechat_Seo_Img_Price_Msg_P'     => '未购买二维码时候提示信息',
   'Wechat_Seo_Img_Size_0'     => '二维码大小',
   'Wechat_Seo_Img_Position_0'     => '二维码位置',
   'Wechat_Seo_Img_Size_1'     => '微信头像大小',
   'Wechat_Seo_Img_Position_1'     => '微信头像位置',
   'Wechat_Seo_Img'     => '底图图片',
   'Wechat_Seo_Img_P'     => '只允许上传JPG格式的图片',
   'Wechat_Seo_Img_font'     => '图片文字',
   'Wechat_Seo_Img_font_style'     => '文字样式',
   
   'Wechat_Seo_Img_Size_P'     => '宽 X 高（像素）',
   'Wechat_Seo_Img_Position_P'     => '在底图上的位置 距离左边 X 距离上边',
   'Wechat_Seo_Img_font_P'     => '图片上的文字内容，为空不打印',
   'Wechat_Seo_Img_font_style_P'     => '文字样式：文字大小，文字颜色，位置：距离左边 X 距离上边',
   
   'Wechat_Model_Err_0'     => '对不起，该模型暂时没内容',
   'Wechat_Model_Err_1'     => '对不起，不明白您的意思，请您描述的在详细一点。',
   
   'Wechat_Seo_Img_Buy'     => '对不起，你没有获取二维码的权限，请到会员中心购买',
   'Wechat_Img_Buy'     => '购买',
   
   //购买二维码
   'Menu_NO_play'     => '本站未开启会员自动设置，您已购买过二维码，请到公众号底部菜单获取二维码推广图片。',
   'Wechat_Img_Buy_info'     => '您现在还未开启该功能，需要购买，现在跳转到付款链接...',
   'Wechat_user_payed'    => '您的账户已经获得了该功能，无需购买',
   'Wechat_qrcode_price' => '购买二维码价格',
   'Wechat_Accounts_wx_Pay' => '微信付款',
   'Wechat_Accounts_balance_Pay' => '余额付款',
   'Menu_NO_play_1'  => '未开启用户自助设置,您已购买过二维码，请到公众号底部菜单获取二维码推广图片。。',
   
   
);

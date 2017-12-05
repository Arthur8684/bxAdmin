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
   'Accounts_Menu_list1'     => '资金流水明细',
   'Accounts_Menu_list2'     => '会员提现申请列表',
   'Accounts_withdraw_open'     => '开启提现',   
   'Accounts_withdraw_open_P'     => '开启提现以后，会员将在前台进行提现行为',   
   'Accounts_withdraw_freeze'     => '满多少可提现',   
   'Accounts_withdraw_freeze_P'     => '账户满多少金额才可以提现一次',      
   'Accounts_withdraw_tax_rate'     => '提现手续费',   
   'Accounts_withdraw_tax_rate_P'     => '提现是微信等第三方扣除我方的手续费，提现时需要买家扣取',        
   
   
 //提现列表  语言
   'Accounts_Withdraw_status_0'     => '未处理',
   'Accounts_Withdraw_status_1'     => '处理中',
   'Accounts_Withdraw_status_2'     => '已打款',
   'Accounts_Withdraw_status_3'     => '处理失败', 
   'Accounts_Withdraw_list_data'    => '申请提交时间',   
   'Accounts_select_user'			=> '选择会员',
   'Accounts_Withdraw_list_way'     => '提现方式',
   'Accounts_Withdraw_list_amount'     => '提现金额',
   'Accounts_Withdraw_list_account_ID'     => '提现方式账号', 
   'Accounts_Withdraw_list_status'    => '当前状态', 

   'Accounts_Withdraw_list_alert'     => '无理由拒绝', 
   'Accounts_Withdraw_list_delete'    => '删除此提现',    
   
   //流水明细
    'Accounts_list_coin_date'     => '交易时间',  
   'Accounts_list_coin_type'     => '币类',
   'Accounts_list_coin_count'     => '数目',
   'Accounts_list_operation_type'     => '操作类型',
   'Accounts_list_business_type'     => '交易类型',
   'Accounts_list_type'     => '流动方向',    
   'Accounts_list_coin_msg'     => '备注',
   'Accounts_list_coin_user'     => '用户名',
   'Accounts_list_business_operation_user'     => '操作用户',
   'Accounts_list_coin_card'   => '会员卡号',
   'Accounts_list_coin_id'   => 'E号',
   
   'Accounts_list_type_1'     => '进账',
   'Accounts_list_type_2'     => '出账',
   
   
   
   //资金增减
   
   'Accounts_alter'     => '资金增减',    
   'Accounts_alter_username'     => '需要操作的用户名',  
   'Accounts_alter_select'     => '请选择',  
   'Accounts_alter_type'     => '选择操作类型',
   'Accounts_alter_add'     => '增加',
   'Accounts_alter_jian'    => '减少',
    'Accounts_alter_bz'    => '备注',  
   
   'Accounts_alter_coin_1'     => '币种1',
   'Accounts_alter_coin_2'     => '币种2',
   'Accounts_alter_coin_3'     => '币种3',
   'Accounts_alter_info_1'     => '点击输入框在弹出页面找到会员后，点击”选择“完成',
   'Accounts_alter_info_2'     => '选择一种币种，进行操作',
   'Accounts_alter_info_3'     => '选择一种交易类型进行操作',
   'Accounts_alter_info_4'     => '选择一种操作类型进行操作',
   'Accounts_alter_info_5'     => '请填写整数，<font color="#FF0000">正数为添加，负数为减少</font>，请正确操作',
   'Accounts_alter_info_6'     => '填写备注，例如‘补偿转账等’',
   
   
   'Accounts_list_coin_count'     => '数目',
   'submit'     => '确认操作',
   'back'     => '返回',
   'User_Index_Accounts_Suc_1'     => '操作成功',
   'User_Index_Accounts_nouser'     => '不存在的用户',
   
   'Accounts_Pay_Err_0'     => '支付不成功',
   'Accounts_Base_Setting'     => '基本配置',
   'Accounts_Pay_Wx'     => '微信支付',
   'Accounts_Operation_Type'     => '操作类型',
   'Accounts_Business_Type'     => '交易类型',
   'Accounts_Operation_Type_P'     => '比如消费，充值等，多种方式用|隔开，此处请不要随意改变，会引起系统错乱',
   'Accounts_Business_Type_P'     => '比如支付宝，财付通，多种方式用|隔开',
   
   'Accounts_Wx_Appid'     => 'APPID',
   'Accounts_Wx_Mchid'     => 'MCHID',
   'Accounts_Wx_Key'     => 'KEY',
   'Accounts_Wx_Appsecret'     => 'APPSECRET',
   'Accounts_Wx_Appid_P'     => '绑定支付的APPID（必须配置，开户邮件中可查看）',
   'Accounts_Wx_Mchid_P'     => '商户号（必须配置，开户邮件中可查看）',
   'Accounts_Wx_Key_P'     => '商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）',
   'Accounts_Wx_Appsecret_P'     => '公众帐号APPSECRET（登录公众平台，进入开发者中心可设置）',
   
   //USER中心充值
  'User_Index_balance'     => '充值金额',
  'User_Index_submit_balance'=>'马上充值',
  'User_Index_white'=>'请填写',
  'User_Index_balance'=>'用户充值',
  'User_Index_order_pay'=>'订单支付 ID为：',
  'User_Index_qrcode'=>'购买推广二维码',
  //支付中心
   'Accounts_Pay_center'     => '支付中心',
   'Accounts_Pay_balance'     => '付款金额',
   'Accounts_Pay_info'     => '付款信息',
   'Accounts_wx_Pay'     => '微信支付',
   
   'Accounts_balance_Pay'     => '余额支付',
   'Accounts_user_balance'     => '用户余额',
   'Accounts_balance_Pay_err'     => '余额不够支付该金额,返回',
   'Accounts_balance_Pay_suc'     => '交易成功!',
   
   'Accounts_Ali_Pay'     => '支付宝支付',
   'Accounts_Partner'     => '合作身份者ID',
   'Accounts_Partner_P'     => '合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串',
   'Accounts_Key'     => 'KEY值',
   'Accounts_Key_P'     => 'MD5密钥，安全检验码，由数字和字母组成的32位字符串',
   'Accounts_Transport'     => '访问模式',
   'Accounts_Transport_P'     => '访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http',
   
   'pay_no_info'     => '交易成功!本单为货到付款订单，客服会与您联系后发货',
   'User_login'     => '会员登录', 
   'User_register'     => '会员注册',    
   'User_center'    => '会员中心', 
   'Shop_seach'   => '搜索',   
   'shop_cate_show'=> '推荐产品', 
   'Shop_allgate' =>'全部分类', 
   'Shop_seach_keyword'=>'请输入搜索的关键词', 
   'shop_news_up'=>'新品发布', 
   'shop_good_goods'=>'推荐',
   'home'=>'首页',
   'all_money'=>'总计',
   'system'=>'系统',
   'User_Index_order_recharge'=>'用户充值',
   'User_Index_order_card'=>'购买储值卡',
   'User_Index_order_qrcode'=>'购买二维码',
   'User_Index_order_update'=>'开通功能',   
   'User_Wx_Config_P'=>'<span class="green b1 sizefont_14">微信支付配置提示：</span><BR>微信登陆链接：<a href="https://mp.weixin.qq.com/" target="_blank">https://mp.weixin.qq.com/</a><BR>微信商户登陆链接：<a href="https://pay.weixin.qq.com/" target="_blank">https://pay.weixin.qq.com/</a><br><span class="green b1 sizefont_14">配置步骤：</span><BR>1.登陆微信公众号<BR>2.基本配置中获取APPID和APPSECRET填写<BR>3.登陆微信商户，设置商户支付密钥，并将商户号(MCHID)和设置的商户支付密钥(KEY)填写<BR>4.在公众平台 公众号设置->功能设置 设置业务域名和JS接口安全域名为网站域名<br>5.在公众平台 微信支付->开发配置->公众号支付 添加(1) '.C('site_url').C('root_path').'index.php/Accounts/Pay/  (2) '.C('site_url').C('root_path').'index.php/Accounts/Pay/wx_pay_html5/param/<br>5.在公众平台 微信支付->开发配置->扫码支付 添加 '.C('site_url').C('root_path').'index.php/Accounts/Pay/native_notify.php',
);

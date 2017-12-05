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
   'ADMIN_Manage_TITLE'     => '网站管理系统',
   
   'ADMIN_Site_Add'     => '添加网站',
   'ADMIN_Site_Domain'     => '网站域名',
   'ADMIN_Site_Manage'     => '网站管理',
   'ADMIN_Setting'     => '基本设置',
   'ADMIN_Power_Setting'     => '权限设置',
   'ADMIN_Money_Setting'     => '货币设置',
   'ADMIN_Config_Name'     => '配置',
   'ADMIN_Setting_Upload'     => '上传设置',
   'ADMIN_SITE_LOGO'     => '网站LOGO',
   'ADMIN_Setting_Upload_Water_Open'     => '上传水印',
   'ADMIN_Setting_Upload_Water_Type'     => '水印类型',
   'ADMIN_Setting_Upload_Water_Type_0'     => '文本水印',
   'ADMIN_Setting_Upload_Water_Type_1'     => '图片水印',
   'ADMIN_Setting_Upload_Water_Position'     => '水印位置',
   'ADMIN_Setting_Upload_Water_Img'     => '水印图片',
   'ADMIN_Setting_Upload_Water_Opacity'     => '水印透明度',
   'ADMIN_Setting_Upload_Water_Opacity_P'     => '透明度只对图片水印有效',
   'ADMIN_Setting_Upload_Water_Text'     => '文本水印文字内容',
   'ADMIN_Setting_Upload_Water_Text_style'     => '文本水印样式',
   'ADMIN_Setting_Upload_Water_Text_style_P'     => '水印文字大小*水印文字颜色，该样式只对文字水印有效',
   'ADMIN_Setting_Upload_Water_Img_P'     => '只允许上传PNG格式的图片',
   'File_Brows_Water'     => '浏览水印', 
   'ADMIN_Setting_Other'     => '其他设置',
   
   'ADMIN_Money_Setting_Err_0'     => '对不起！同一种币不能进行兑换',
   'ADMIN_Money_Setting_Err_1'     => '对不起，已经存在该兑换规则',  
   
   'ADMIN_Money_Select'     => '兑换预选数额',  
   
   'ADMIN_Money_P_0'     => '积分兑换比率，可以为小数', 
   'ADMIN_Money_P_1'     => '积分兑换要扣除的手续费，可以为百分百', 
   'ADMIN_Money_P_2'     => '扣除手续费的币种，如果是白费比，请选择%', 
   'ADMIN_Money_P_3'     => '在兑换中预选的选项卡,多个用逗号隔开(,),-1表示可以直接输入，如果没有-1，表示只能兑换预选中的数额', 
    
   'ADMIN_Code_Text'     => '验证码文本',
   'ADMIN_Code_Usezh'     => '中文',
   'ADMIN_Code_Useen_0'     => '英文大写',
   'ADMIN_Code_Useen_1'     => '英文小写',
   'ADMIN_Code_Useen_2'     => '数字',
   
   'ADMIN_Code_Stype'     => '验证码样式',
   'ADMIN_Code_Bg'     => '背景',
   'ADMIN_Code_Usecurve'     => '混淆曲线',
   'ADMIN_Code_Usenoise'     => '添加杂点',
   'ADMIN_Code_Fontsize'     => '字体大小',
   'ADMIN_Code_Length'     => '验证码位数',
   'ADMIN_Code_W'     => '宽度',
   'ADMIN_Code_H'     => '高度',
   'ADMIN_Code_Stype_P'     => '验证码字体大小 * 验证码位数 * 验证码图片宽度 * 验证码图片高度 宽高度设置为0，表示自动计算',
   
   'ADMIN_Code_Expire'     => '有效期',
   'ADMIN_Code_Unit'     => '秒',
   
   'ADMIN_Code_Open_Model'     => '开启验证码',
   
   'ADMIN_Mobile_Code'     => '手机验证码',
   'ADMIN_Mobile_Code_Len'     => '位数',
   'ADMIN_Mobile_Fnterface'     => '短信接口',
   'ADMIN_Mobile_Fnterface_1'     => '阿里大于',
   'ADMIN_Mobile_Tem_Id'     => '模板ID',
   'ADMIN_Mobile_Tem_Id_P'     => '模板参数 code：验证码，，例如:模板可以写成（验证码${code}）',
   'ADMIN_Mobile_Sign'     => '短信签名',
   
   'ADMIN_Code_Open_Model_Admin_Login'     => '管理员登陆',
   'ADMIN_Code_Open_Model_User_Login'     => '会员登陆',
   
   
   'ADMIN_Site_Name'     => '网站名称',
   'ADMIN_Site_Title'     => '网站标题',
   'ADMIN_Site_Keyword'     => '关键字',
   'ADMIN_Site_Keyword_P'     => '多个关键字请用“,”逗号隔开',
   'ADMIN_Site_Describe'     => '网站描述',
   'ADMIN_Site_Describe_P'     => '请用一段文字来描述网站的基本内容与作用',
   'ADMIN_Site_Url'     => '网站网址',
   'ADMIN_Site_Rootpath'     => '网站目录',
   
   'ADMIN_Site_Url_Model'     => '链接模式',
   'ADMIN_Site_Url_Model_0'     => '普通模式',
   'ADMIN_Site_Url_Model_1'     => 'PATHINFO模式',
   'ADMIN_Site_Url_Model_2'     => 'REWRITE模式',
   'ADMIN_Site_Url_Model_3'     => '兼容模式',
   'ADMIN_Site_Url_Suffix'     => '伪静态后缀',
   'ADMIN_Site_Jump_Time'     => '跳转时长',
   
   'ADMIN_Sign'     => '标识',
   
   'ADMIN_Index'     => '管理首页',
   
   'ADMIN_Menu'     => '菜单',
   'ADMIN_Menu_Add'     => '添加菜单',
   'ADMIN_Menu_Small_Add'     => '添加子菜单',
   'ADMIN_Menu_Class'     => '上级菜单',
   'ADMIN_Menu_Sort'     => '序号',
   'ADMIN_Menu_Name'     => '菜单名称',
   'ADMIN_Menu_Id'     => 'ID',
   'ADMIN_Menu_Manage'     => '管理菜单',
   'ADMIN_Menu_Small_Manage'     => '管理子菜单',
   'ADMIN_Menu_Select_Top'     => '顶级菜单',
   'ADMIN_Menu_Submenu_Num'     => '子菜单数',
   'ADMIN_Url_Name'     => '链接地址',
   'ADMIN_Url_Ico'     => '小图标',
   'ADMIN_Url_Ico_select'     => '点击选择',
   
   'ADMIN_Menu_Name_Empty'=>'菜单名称不能为空',
 
   'ADMIN_Menu_Operate'     => '菜单操作',
   'ADMIN_Power'     => '鉴权',
   
   'ADMIN_Url'     => '链接',
   
   'ADMIN_Web_Url'     => '内链',
   'ADMIN_Other_Url'     => '外链',
 
   'ADMIN_F'     => '文件名称',  
   'ADMIN_M'     => '模块名称',
   'ADMIN_C'     => '控制器名',
   'ADMIN_A'     => '操作名称',
   'ADMIN_P'     => '其他参数',

    'ADMIN_Model'=>'模型',
    'ADMIN_Controller'=>'控制器',
    'ADMIN_Method'=>'方法',

   'ADMIN_Url_Info'=>'内链:网站内部链接，通过模块名-控制器-操作名来组合成一个链接,如admin.php/Admin/Menu/menu_list/p/1/a/2.html或admin.php?m=Admin&c=Menu&a=menu_list&p=1&a=2,模块名称为:Admin(如果为admin可以不写留空),控制器名：Menu,操作名称：menu_list,其他参数：p=1&a=2。<BR>外链：完整的链接，如admin.php/Admin/Menu/menu_list.html或admin.php?m=Admin&c=Menu&a=menu_list，如果系统使用了第一种或第二种链接形式，内链接可以根据系统的链接形式变化，外链不可以变化，<br>两者区别在于内链接可以根据不同的链接形式变化，外链是死的不会变化的，上边的2个链接打开一个页面，只是链接形式不同而已',

   'ADMIN_Url_form'     => '链接不能为空或格式不正确',
   
   
   'ADMIN_Save_Title_err'     => '菜单名称不能为空',
   
   
   
   'ADMIN_Edit_Null'     => '您要编辑的信息被删除或者被屏蔽',
   
   'ADMIN_Menu_Name_Placeholder'     => '请输入菜单名称',
   'ADMIN_Url_Name_Placeholder'     => '请输入链接地址',
   
   'ADMIN_Del_Menu'     => '删除『{$menu_name}』菜单会删除它所有的子菜单，删除后不可恢复，是否要确定删除？',
   
   'ADMIN_Install'=>'插件',
   'ADMIN_Install_Name'=>'插件名称',
   'ADMIN_Install_Web'=>'官方网站',
   'ADMIN_Install_Describe'=>'插件描述',
   
   'ADMIN_Install_Operate'=>'插件操作',
   
   'ADMIN_Install_1'=>'安装',
   'ADMIN_Unnstall_1'=>'卸载',
   'ADMIN_Install_Err_1'=>'对不起！该插件没有配置文件，不能安装',
   'ADMIN_Install_Err_2'=>'对不起！该插件已经安装',
   'ADMIN_Install_Err_3'=>'对不起！插件标识未知，请联系管理员',
   'ADMIN_Install_Err_4'=>'确定要卸载该插件吗',
   'ADMIN_Install_Err_5'=>'卸载插件失败',
   'ADMIN_Install_Success_0'=>'安装插件成功',
   'ADMIN_Install_Success_1'=>'卸载插件成功',
   
   
    'ADMIN_User_Total'=>'会员总数',
	'ADMIN_User_Total_Current'=>'查询会员数',
   	'ADMIN_Admin'=>'管理员',
	'ADMIN_Admin_Add'=>'添加管理员',
	
	'ADMIN_Admin_Role'=>'管理员角色',
	'ADMIN_Admin_Operate'=>'管理员操作',
	'ADMIN_Admin_List'=>'管理列表',
	'ADMIN_Admin_addtime'=>'添加日期',
	 
	'ADMIN_Quit'=>'安全退出',   
   	'ADMIN_User'=>'管理账号',
	'ADMIN_Pass'=>'管理密码',
	'ADMIN_Email'=>'管理邮箱',
	'ADMIN_Confirm_Pass'=>'确认密码',
	
	'ADMIN_Login_Err_1'=>'对不起，管理账号或管理密码不能为空',
	'ADMIN_Login_Err_2'=>'对不起，该用户不存在或被关闭，请联系超级管理',
	'ADMIN_Login_Err_3'=>'对不起，管理密码错误',
	'ADMIN_Login_Err_4'=>'对不起，管理密码与确认密码不一致',
	'ADMIN_Login_Err_5'=>'对不起，管理员邮箱格式不正确',
	'ADMIN_Login_Err_6'=>'对不起，该角色组已经关闭，请联系超级管理员',
	'ADMIN_Login_Err_7'=>'对不起，该角色组不允许登陆，请联系超级管理员',
	'ADMIN_Del_Admin'     => '删除『{$admin_user}』管理员，删除后不可恢复，是否要确定删除？',
	
	'ADMIN_Site_Url_Info'     => '格式：http://www.abc.com',
	'ADMIN_Site_Rootpath_Info'     => '必须以“/”结尾，如：/cms/',
	'ADMIN_Site_Url_Model_Info'     => '普通模式:http://www.x.com/a.php?a=1 PATHINFO模式:http://www.x.com/a.php/a/1',
	'ADMIN_Site_Url_Suffix_Info'     => '链接的后缀，如：php,html,htm 等',
	'ADMIN_Site_Jump_Time_Info'     => '提示信息的跳转时长，以秒为单位',
	'ADMIN_Site_Del'     => '删除网站成功',
	'ADMIN_Site_Del_Info'     => '删除『{$site_name}』网站，删除后不可恢复，是否要确定删除？',
	'ADMIN_Site_Domain_Info'     => '格式：abc.com',
	
	'ADMIN_Site_Domain_Only'     => '该域名已经存，请修改后在提交',
	
	
	'ADMIN_U_Login_Err_1'=>'对不起，用户账号或管理密码不能为空',
	'ADMIN_U_Login_Err_2'=>'对不起，该用户不存在或被关闭，请联系超级管理',
	'ADMIN_U_Login_Err_3'=>'对不起，用户密码错误',
	'ADMIN_U_Login_Err_4'=>'对不起，用户密码与确认密码不一致',
	'ADMIN_U_Login_Err_5'=>'对不起，用户邮箱格式不正确',
	'ADMIN_Del_User'     => '删除『{$user_user}』用户，删除后不可恢复，是否要确定删除？',
	
	'ADMIN_U_Group_List'=>'会员组列表',
	'ADMIN_U_Group_Add'=>'添加会员组',
	'ADMIN_U_Group_Price_Limit'=>'单价限制',
	'ADMIN_U_Group_Price_Limit_P'=>'该会员购买的产品，单价不能超过该数值',
	
	'ADMIN_U_Group_Price_Limit_P'=>'该会员购买的产品，单价不能超过该数值',
	
	'ADMIN_U_Group_Condition'=>'升级条件',
	'ADMIN_U_Group_Condition_P'=>'本会员组【升级条件】不为空，表示该会员达到输入的条件，就会自动升级为本会员组，如果【升级条件】为空，表示不能自动升级为本会员组，当购买价格大于0，可以通过购买会员组来升级，如：升级条件为  [promote_point]  *  3  >=  300 表示会员的升级点数乘以3大于等于300的时候，该会员会升级成为本会员组， [promote_point]  *  3  >=  300   ||  [total_recommend]  > 5 表示会员的升级点数乘以3大于等于300《或者》总推荐人数大于5的时候，该会员会升级成为本会员组，[promote_point]  *  3  >=  300 && [total_recommend]  > 5  表示会员的升级点数乘以3大于等于300《并且》总推荐人数大于5的时候，该会员会升级成为本会员组，<strong>注意：会员组自动升级，必须是会员所在会员组设置了允许升级，如果会员达到了多个会员组的要求，优先升级为【级别】高的会员组</strong>',
	'ADMIN_U_Group_Coin_Type_Info'=>'请选择购买会员组所使用的积分。注意-购买价格为0表示会员组不收费。',
	
	'ADMIN_U_Group_name_Info'=>'会员组名称，如:VIP会员。',
	'ADMIN_U_Group_Sort_Info'=>'会员组排序序号，序号越小越靠前。',
	'ADMIN_U_Group_Add_Info'     => '允许注册：关闭后会员组不可注册，允许登陆：关闭后会员组不能登陆，允许升级：关闭不能线升级其它会员组，除非通过购买会员组升级',
	'ADMIN_U_Group_Err_Name_Info'     => '会员组名称不能为空',
    'ADMIN_Del_Group'     => '删除『{$group_name}』会员组，删除后不可恢复，是否确定删除？',
	
	'ADMIN_Role_List'=>'角色列表',
	'ADMIN_Role_Add'=>'添加角色',
	'ADMIN_Role_Name'=>'管理角色',
	'ADMIN_Role_name_Info'=>'角色名称，如:网站编辑。',
	'ADMIN_Role_Add_Info'     => '允许登陆：关闭后该角色管理不能登陆',
	'ADMIN_Role_Err_Name_Info'     => '角色名称不能为空',
	'ADMIN_Role_Sort_Info'=>'角色排序序号，序号越小越靠前。',
	'ADMIN_Del_Role'     => '删除『{$role_name}』角色，删除后不可恢复，是否要确定删除？',
	
	'ADMIN_Auth_Name'     => '规则名称',
	'ADMIN_Auth_Title'     => '规则标题',
	'ADMIN_Auth_Class'     => '规则分类',
	'ADMIN_Auth_Class_Parent'     => '上级分类',
	'ADMIN_Auth_Class_Top'     => '顶级分类',
	'ADMIN_Auth_Manage'     => '规则管理',
	'ADMIN_Auth_Class_Manage'     => '分类管理',
	'ADMIN_Auth_Class_Title'     => '分类名称',
	'ADMIN_Auth_Class_Type'     => '权限区分',
	'ADMIN_Auth_Class_Add'     => '添加分类',
	'ADMIN_Auth_M'     => '模型',
	'ADMIN_Auth_C'     => '控制器',
	'ADMIN_Auth_A'     => '方法',
	'ADMIN_Auth_P'     => '参数',
	'ADMIN_Auth_Add'     => '添加规则',
	'ADMIN_Auth_Condition'     => '验证条件',
	'ADMIN_Auth_Condition_P'     => '开启：可以定义条件。 如{money}>5 表示用户的资金大于50时这条规则才会通过',
	'ADMIN_Auth_P_P'     => '如果有参数请以key=value&k=v',
	'ADMIN_Auth_Class_Type_P'     => '权限显示区分，管理员角色处显示的权限：admin，会员组处显示的权限为user',
	'ADMIN_Auth_Err_0'     => '分类名称不能为空',
	'ADMIN_Auth_Err_1'     => '模型，控制器，方法不能为空',
	'ADMIN_Auth_Err_2'     => '规则标题不能为空',
	'ADMIN_Auth_Del'     => '删除『{$name}』规则，删除后不可恢复，是否要确定删除？',
	'ADMIN_Auth_Class_Del'     => '删除『{$name}』规则分类，删除后不可恢复，是否要确定删除？',
	
	'money_describe'     => '当前登录会员积分A余额',
	'amount_describe'     => '当前登录会员积分B余额',
	'point_describe'     => '当前登录会员积分C余额',
	'qrcode_open_describe'     => '是否购买二维码，购买为1，没购买为0',
	'promote_point_describe'     => '会员升级等级积分，该积分可以通过购买产品或者参与活动',
	'year_consumption_describe'     => '会员当年消费的累计金额',
	'month_consumption_describe'     => '会员当月消费的累计金额',
	'day_consumption_describe'     => '会员当天消费的累计金额',
	'total_consumption_describe'     => '会员总共消费的累计金额',
	'year_order_describe'     => '会员当年下单累计单数',
	'month_order_describe'     => '会员当月下单累计单数',
	'day_order_describe'     => '会员当天下单累计单数',
	'total_order_describe'     => '会员总共下单累计单数',
	'year_recommend_describe'     => '会员当年直推人数',
	'month_recommend_describe'     => '会员当月直推人数',
	'day_recommend_describe'     => '会员当天直推人数',
	'total_recommend_describe'     => '会员总共直推人数',
	'recommend_n_describe'     => '【多层人数】会员三层内推荐的人数，3代表三层内，如果想要某个层数内的推荐人数，请输入[n],n代表层数，是一个数字，不能为小数，0表示所有层',
	'recommend_n_num_describe'     => '【单层人数】会员第三层推荐的人数，3代表第三层，如果想要某个层数的推荐人数，请输入[$n],n代表层数，是一个数字，不能为小数',
	'recommend_push_describe'     => '直推会员中,【{$group_name}】会员的人数',
	'recommend_push_n_describe'     => '【多层人数】三层内推荐会员中,【{$group_name}】会员的人数 格式如下 [*3|2] 3代表层数，如果是5层内的会员，可以输入5，2代表用户组ID',
	'recommend_push_n_num_describe'     => '【单层人数】第三层推荐会员中,【{$group_name}】会员的人数 格式如下 [?3|2] 3代表层数，如果第5层的会员，可以输入5，2代表用户组ID',
	'recommend_push_n_total_describe'     => '【多层人数】总推荐会员中,【{$group_name}】会员的人数',
	'recommend_total_describe'     => '会员推荐的所有总人数',
	
	'group'     => '会员组ID',
	'group_describe'     => '会员当前的会员组ID（为升级之前的会员ID）',
	'real_name'     => '实名认证',
	'real_name_describe'     => '当前用户是否实名认证，认证为1，未认证为0',
    'bank_auth'     => '绑卡认证',
	'bank_auth_describe'     => '当前用户是否绑定银行卡认证，认证为1，未认证为0',
	
	'+_describe'     => '加',
	'-_describe'     => '减',
	'*_describe'     => '乘',
	'/_describe'     => '除',
	'=_describe'     => '赋值等于',
	'==_describe'     => '判断等于',
	'!=_describe'     => '判断不等于',
	'>_describe'     => '大于',
	'<_describe'     => '小于',
	'(_describe'     => '左括号',
	')_describe'     => '右括号',
	
	'or_describe'     => '或者，只需要满足多个条件中的一个就可以升级本会员组',
	'and_describe'     => '并且，满足其他条件的同时还有满足当前条件才可以升级本会员组',
	'no_describe'     => '非，相反的条件，才可以升级成为本会员组',


    'User_name'=>'用户名',
    'User_ID'=>'用户ID',
    'To_examine'=>'审核',
    'No_examine'=>'未审',
    'Direct_head'=>'主播头像可以更改，请点击头像或者按钮',
    'Upload_direct_head'=>'上传主播头像',
    'Description'=>'简介',
    'Please_fill_in_the_live_title'=>'请填写直播标题',
    'Please_upload_the_anchor_head'=>'请上传主播头像',
    'Please_fill_in_the_broadcast'=>'请填写直播简介',
    'Successful_application'=>'申请成功',
    'Successful_modification'=>'修改成功',
    'Modify_failed'=>'修改失败',
);
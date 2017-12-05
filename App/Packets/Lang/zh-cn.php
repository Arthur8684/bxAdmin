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
	'ADMIN_Packets_Get'=>'领取红包',
	'ADMIN_Packets_Add'=>'添加红包',
	'ADMIN_Packets_Name'=>'红包名称',
	'ADMIN_Packets_type'=>'红包类型',
	'ADMIN_Packets_Times'=>'领取次数',
	'ADMIN_Packets_Users'=>'领取会员',
	'ADMIN_Packets_Times_P'=>'同一个会员领取红包的次数,0表示不限次数',
	'ADMIN_Packets_Users_P'=>'指定领取的会员，如果指定,只允许指定的会员领取',
	'ADMIN_Packets_Name_p'=>'请输入红包名称，可以为汉字',
	
	'ADMIN_Packets_List'=>'红包管理',
	'ADMIN_Packets_Group_id'=>'会员组',
	'ADMIN_Packets_Date'=>'领取时间',
	
	'ADMIN_Packets_Date_Range'=>'允许领取时间',
	'ADMIN_Packets_Date_Range_P'=>'允许在该段时间领取红包,如果是节日红包，两个时间为空，表示只允许在节日当天领取红包,如果是生日红包，请留空',
	'ADMIN_Packets_Intervals'=>'领取红包间隔',
	'ADMIN_Packets_Intervals_P'=>'领取该红包后，领取下一个红包的时间间隔',
	'ADMIN_Packets_Qrcode_Open_P'=>'如果选择，领取该红包的会员，会有获取二维码的权限',
	'ADMIN_Packets_Present'=>'领取限制',

	
	'ADMIN_Packets_Power_Setting'=>'权限设置',
	'ADMIN_Packets_Base_Setting'=>'基本设置',
	'ADMIN_Packets_Template_Setting'=>'模板设置',
	
	'ADMIN_Packets_Msg_P'=>'会员组：允许领取红包的会员组，不选表示所以会员在满足条件后都可以领取，如果设置了【领取会员】,指定了会员后，此处设置无效。领取条件：满足了领取的会员组后，如果【领取条件】不为空，需要在满足了领取条件才可以领取红包',
	
	'ADMIN_Packets_Condition'=>'领取条件',
	'ADMIN_Packets_Holiday'=>'节日日期',
	'ADMIN_Packets_Period'=>'红包周期',
	'ADMIN_Packets_Parent'=>'上一步红包',
	'ADMIN_Packets_Parent_First'=>'第一步红包',
	'ADMIN_Packets_Parent_First_P'=>'分步红包中，领取该红包需要必须先领取他的上一步红包，才可以领取该红包',
	'ADMIN_Packets_Period_P'=>'多少时间为一个周期，超过这个时间，会员又可以从第一步开始领取，比如打卡之类的红包功能',
	'ADMIN_Packets_Holiday_P'=>'节日的日期，如果为空，表示生日红包，生日红包需在生日当天领取',
	'ADMIN_Packets_Remarks'=>'红包备注',
	'ADMIN_Packets_Remarks_P'=>'请输入内容',
	'ADMIN_Packets_Del'=>'你确定要删除【{$name}】红包吗？，删除后不可以恢复。',
	
	'ADMIN_Packets_Err_0'=>'红包被删除或者被屏蔽',
	'ADMIN_Packets_Err_1'=>'红包不存在或者被删除',
	'ADMIN_Packets_Err_2'=>'你所在会员组没有领取该红包的权限',
	'ADMIN_Packets_Err_3'=>'未到领取红包的日期，或者已经超过领取红包的日期',
	'ADMIN_Packets_Err_4'=>'对不起，你不具备领取红包的条件',
	'ADMIN_Packets_Err_5'=>'对不起，该红包属于专属红包，你不在领取红包会员中',
	'ADMIN_Packets_Err_6'=>'你领取红包的次数已完，不能再领取红包',
	'ADMIN_Packets_Err_7'=>'对不起,你还不到领取红包的时间',
	'ADMIN_Packets_Err_8'=>'对不起,你还没有设置生日，请到会员中心设置你的生日',
	'ADMIN_Packets_Err_9'=>'对不起，节日礼包必须当天领取',
	'ADMIN_Packets_Err_10'=>'对不起,节日未到，不能领取节日红包',
	'ADMIN_Packets_Err_11'=>'对不起,红包你已经领取过了',
	'ADMIN_Packets_Err_12'=>'对不起,你的本周期内的红包已经领完',
	'ADMIN_Packets_Err_13'=>'对不起,还未到领取红包的时间',
	'ADMIN_Packets_Err_14'=>'对不起,请按照顺序领取红包',
	
	
	'ADMIN_Packets_Par'=>'赠送礼物',	
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
	'group_describe'     => '当前登录会员组ID',
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
);

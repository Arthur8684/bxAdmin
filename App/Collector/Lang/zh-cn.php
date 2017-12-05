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
return array(
    'Collector'     => '采集器',
	'Project'     => '采集项目',
	'Collector_Operate'     => '采集',
	'Collector_Operate_All'     => '批量采集',
	'Project_Name'     => '项目名称',
	'Project_Name_P'     => '请输入项目名称',

	'Project_Charset'     => '采集编码',
	'Project_Charset_Select'     => '自动识别',
	'Project_Charset_P'     => '请选择你要采集页面的编码',
	
	'Project_Url'     => '采集地址',
	'Project_Url_P'     => '请输入要采集的地址，{*}表示自动递增的数字，比如页码递增的数字',
	
    'Project_Num_Min'     => '起始数字',
	'Project_Num_Min_P'     => '{*}表示的最小数字',
	
    'Project_Num_Max'     => '结束数字',
	'Project_Num_Max_P'     => '{*}表示的最大数字',	
	
    'Project_Page_Interval'     => '页码间隔',
	'Project_Page_Interval_P'     => '采集时，每个页面和页面之间要停留的时间间隔',	
				
    'Project_Record_Interval'     => '记录间隔',
	'Project_Record_Interval_P'     => '采集时，每条记录和记录之间要停留的时间间隔',
					
    'Project_Login_Parm'     => '其他参数',
	'Project_Login_Parm_P'     => '登陆需要的其他参数，多个参数用&隔开，格式如user=1&pass=2',
						
    'Project_Login_User'     => '登陆用户名',
	'Project_Login_User_P'     => '请输入[用户名字段名称]=用户名，格式如user=xiaohe',	
						
    'Project_Login_Pass'     => '登陆密码',
	'Project_Login_Pass_P'     => '请输入[密码字段名称]=密码，格式如pass=123456',	
						
    'Project_Login_Url'     => '登陆地址',
	'Project_Login_Url_P'     => '提交用户密码的地址，不是输入账号密码的地址',		
	
	'Project_Model'     => '采集模型',
	
	'Project_Key_Collection'  => '一键采集',
	'Project_Time_unit'     => '秒',		
	'Project_Next'     => '下一步',	
	'Project_Prev'     => '上一步',
	'Project_Finish'     => '完成',	
	
	'Project_Collector_Autho_Admin'     => '作者身份，admin：管理员，user：用户',
	
	'Project_Collector_List_A'     => '采集列表连接',

    'Project_List_Condition'     => '单元中的采集条件',
	'Project_List_Condition_P'     => '实时每天采集，如采集当天的或者推荐的信息可使用该功能,[年份：Y-17，y-2017]，[月份：m-03,n-3,F-January,M-Jan]，[日：d-03，j-3]，[小时：H-02，G-2],i分，s秒，比如要采集当月当天的:{m-d}，格式要根据采集页面的格式书写，采集过来的字符串和你书写的字符串匹配，匹配上表示符合采集条件，多个条件用|隔开',
	
	'Project_List_Content'     => '列表页-所有列表',
	'Project_List_Unit'     => '列表页-列表单元',	
	'Project_List_Url'     => '单元中的[A]标签连接',
	'Project_Field_Set_Content'     => '内容页设置',	
	'Project_Field_Set_List'     => '列表页设置',	
	'Project_Field_Start'     => '起始字符串',
	'Project_Field_End'     => '结束字符串',
	'Project_Field_Title'     => '请选择你要采集的字段',
	'Project_Field_Filter'     => '采集过滤标签',
	'Project_Field_Replace'     => '采集字符替换',
	'Project_Field_Replace_P'     => '多个替换用|个开,格式：被替换=替换，如：把s替换成z,a替换成b,s=z|a=b,如果没采集到使用固定字符串,或者不采集直接使用固定字符,请输入[null]=字符,如果使用当前时间[time]',
	'Project_Login'     => '采集登陆',
	'Project_Login_P'     => '采集的页面是否需要登陆，需要请选择登陆',
	'Project_Login_1'     => '需要登陆',
	'Project_Login_0'     => '不需要登陆',
	
	'Project_Msg_1'     => '数据保存成功，正在进入下一步的操作，请不要耐心等待.........',
	'Project_Msg_2'     => '确定要删除信息吗，删除后不可恢复',
	'Project_Msg_3'     => '采集成功，采集连接：{$url}，下条记录预计在{$interval}秒后采集......',
	'Project_Msg_4'     => '采集数据完成',
	
    'Project_Err_1'     => '对不起，项目名称不能为空',
    'Project_Err_2'     => '对不起，采集地址不能为空',
	'Project_Err_3'     => '对不起，请选择采集模型',
	'Project_Err_4'     => '对不起，没有找到该项目，可能别屏蔽或者删除',
	'Project_Err_5'     => '没有找到对应的模型，请在项目中选择正确的采集模型',
	
	

);

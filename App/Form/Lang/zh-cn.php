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
   'Form_Add'     => '表单添加',
   'Form_Name'     => '表单名称',
   'Form_Open_Time'     => '表单开启时间段',
   'Form_List'     => '表单列表',
   'Form_Table'     => '表单表名',
   'Form_Start_Time'     => '开始时间',
   'Form_End_Time'     => '结束时间',
   'Form_Time_P'     => '允许会员提交的时间区间，如果为空表示没有时间限制',
   'Form_Submit_User'     => '允许提交会员组（全不选择，表示所有会员都可以提交，包括游客在内容）',
   'Form_Err_0'     => '表单名称不能为空',
   'Form_Err_1'     => '表单表名不能为空',
   'Form_Del'     => '你确定要删除【{$form_name}】表单吗，删除后不可恢复', 
   'Form_Content_Del'     => '你确定要删除吗，删除后不可恢复', 
   'Form_Field'     => '表单字段',    
   'Form_Forever'     => '永久开放',
   'Form_Submit'     => '提交信息',
   'Form_Object'     => '项目',
   'Form_Autho'     => '提交者',
   
   'Form_Show_Url'   => '<span class=green b1>调用有2种方式:</span><BR>1.直接调用链接：'.C('site_url').C('root_path').'index.php/form/Submit/submit/modelid/{$modelid}.php<br>2.在你自己的页面中，需要显示表单项目的地方调用{:form({$modelid})}，然后设置form表单action属性值为 '.C('site_url').C('root_path').'index.php/form/Submit/submit.php',

);

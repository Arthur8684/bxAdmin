<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',false);
// 定义应用目录
define('APP_PATH',dirname(__FILE__).'/App/');
//定义公共模块路径
define('COMMON_PATH',dirname(__FILE__).'/Data/');
//定义模板文件路径
//define('TMPL_PATH','Template1/');
//定义系统缓存路径
//define('BIND_MODULE','File');
define('RUNTIME_PATH',dirname(__FILE__).'/Data/Cache/Runtime/');
define('APP_MODE','cli');


// 引入system入口文件
require dirname( __FILE__).'/System/System.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单

?>
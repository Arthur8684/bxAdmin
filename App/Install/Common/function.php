<?php
/*-----------------------------------
**链接MYSQL
**db_user 数据库用户名
**db_pass 数据库密码
**-----------------------------------*/	
function mysql_con($db_user,$db_pass,$server='localhost:3306')
{
    $con = mysql_connect($server,$db_user,$db_pass);
	return $con;
}

/*-----------------------------------
**检测数据库存在
**db_name 数据库用户名
**con mysql链接标识
**-----------------------------------*/	
function db_select($db_name,$con)
{
    $db_select = mysql_select_db($db_name, $con);
	return $db_select;
}

/*-----------------------------------
**生成网站配置文件
**data 配置参数
**-----------------------------------*/	
function set_config($data)
{
	$config=array (
		'site_name' => $data['web_name'],
		'site_title' => $data['web_name'],
		'site_logo' => __ROOT__.'/upload/system/system_logo.png',
		'site_url' =>'http://'.$_SERVER['HTTP_HOST'],
		'root_path' => __ROOT__.'/',
		'money' => 
		array (
		  'name' => '人民币',
		  'unit' => '元',
		  'decimal' => '2',
		  'status' => '1',
		),
		'amount' => 
		array (
		  'name' => '点数',
		  'unit' => '点',
		  'decimal' => '2',
		  'status' => '1',
		),
		'promote_point' => 
		array (
		  'name' => '经验',
		  'unit' => '点',
		  'decimal' => '0',
		  'status' => '1',
		),
		'point' => 
		array (
		  'name' => '积分',
		  'unit' => '分',
		  'decimal' => '0',
		  'status' => '1',
		),
		'point1' => 
		array (
		  'name' => '积分',
		  'unit' => '分',
		  'decimal' => '0',
		),
		'point2' => 
		array (
		  'name' => '积分',
		  'unit' => '分',
		  'decimal' => '0',
		),
		'point3' => 
		array (
		  'name' => '积分',
		  'unit' => '分',
		  'decimal' => '0',
		),
		'point_convert' => 
		array (
		  'promote_point__convert__money' => '10',
		  'promote_point__convert__point1' => '10',
		  'money__convert__point3' => '20',
		),
		'upload_water_open' => '1',
		'upload_water_type' => '0',
		'upload_water_position' => '5',
		'upload_water_opacity' => '100',
		'water_text_size' => '20',
		'water_text_color' => '#F00',
		'water_text' => 'COWCMS',
		'code_open' => '0',
		'useen_0' => '1',
		'useen_1' => '1',
		'useen_2' => '1',
		'useImgBg' => '1',
		'useCurve' => '1',
		'useNoise' => '1',
		'fontSize' => '14',
		'length' => '4',
		'imageW' => '0',
		'imageH' => '0',
		'expire' => '300',
		'code_admin_login' => '1',
		'url_model' => 1,
		'url_html_suffix' => 'php',
		'jump_time' => 10,
		'message_inter' => '0',
		'sms_appkey' => '',
		'sms_appsecret' => '',
		'sms_template_code' => '',
		'sms_code_len' => '',
		'sms_sign_name' => '',
		'point_type' => 
		array (
		  'money' => '资金名称',
		  'amount' => '点数名称',
		  'promote_point' => '升级点数',
		  'point' => '积分名称',
		  'point1' => '积分名称1',
		  'point2' => '积分名称2',
		  'point3' => '积分名称3',
		  'point4' => '积分名称4',
		  'point5' => '积分名称5',
		  'point6' => '积分名称6',
		),
		'LOAD_EXT_CONFIG' => 'db',
		'TMPL_PARSE_STRING' => 
		array (
		  '__STATIC__' => __ROOT__.'/Public/css_js_font_img/',
		  '__CHARSET__' => 'utf-8',
		),
	  );
	 FF('Conf/config',$config,COMMON_PATH); 
	 return  FF('Conf/config','',COMMON_PATH);
}

/*-----------------------------------
**生成数据库配置文件
**data 配置参数
**-----------------------------------*/	
function set_db($data)
{
	$config=array (
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => $data['server'], // 服务器地址
		'DB_NAME'   => $data['db_name'], // 数据库名
		'DB_USER'   => $data['db_user'], // 用户名
		'DB_PWD'    => $data['db_pass'], // 密码
		'DB_PORT'   => $data['port'], // 端口
		'DB_PREFIX' => $data['db_pre'], // 数据库表前缀 
	  );
	 FF('Conf/db',$config,COMMON_PATH); 
	 return  FF('Conf/db','',COMMON_PATH);
}

/*-----------------------------------
**生成数据库配置文件
**data 配置参数
**-----------------------------------*/	
function echo_flush($message,$p=0,$progress=0)
{
	 
	 echo $message."<br>";
	 if($progress) echo "<script>parent_.progress_install(".$progress.",'".$message."');</script>";
	 if($p) exit();
	 flush();//刷新输出缓冲   
}

/*-----------------------------------
**插入管理员
**data 配置参数
**$con 链接数据库
**-----------------------------------*/	
function insert_admin($data,$con)
{
	  $db_select=db_select($data['db_name'],$con);
	  if(!$db_select) return false;

      $string=new \Org\Util\String();//创建string对象
	  $pre=$string->randString(6,0); //获得6位随机字符串
	  $pass=md5($data['pass'].$pre);
	  $result = mysql_query("SELECT * FROM ".$data['db_pre']."admin where user='".$data['user']."'",$con);
	  if(mysql_num_rows($result) > 0)
	  {
		  $insertid=mysql_query("update ".$data['db_pre']."admin set `pass`='".$pass."',`pass_pre`='".$pre."',`status`=1,`role_id`=1,`addtime`=".time().",`is_del`=1 where user='".$data['user']."'");
	  }else
	  {
		  $insertid=mysql_query("INSERT INTO ".$data['db_pre']."admin (user,pass,pass_pre,role_id,status,addtime,is_del)VALUES ('".$data['user']."','".$pass."','".$pre."',1,1,".time().",1)");
	  }
	  return $insertid ;
}
?>

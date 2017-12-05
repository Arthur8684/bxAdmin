<?php
namespace System\Controller;
use Org\Util\Admin;
class IndexController extends Admin {
    public function system_index(){
        $sysinfo = array(
            'PHP_VERSION' => PHP_VERSION, //获取PHP服务器版本
            'TIME' => date("Y-m-d H:i:s", time()), //获取服务器时间
            'OS' => php_uname(), //获取系统类型及版本号
            'SERVER_LANGUAGE' => $_SERVER['HTTP_ACCEPT_LANGUAGE'], //获取服务器语言
            'port' => $_SERVER['SERVER_PORT'], //获取服务器Web端口
            'MAX_UPLOAD' => ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled", //最大上传
            'MAX_EX_TIME' => ini_get("max_execution_time")."秒", //脚本最大执行时间
            'MYSQL_VERSION' => $this->_mysql_version(),
            'MYSQL_SIZE' => $this->_mysql_db_size(),
        );
		$this->assign('sysinfo',$sysinfo);
        $this->display();
    }
   private function _mysql_version()
    {
        $Model =M();
        $version = $Model->query("select version() as ver");
        return $version[0]['ver'];
    }
   private function _mysql_db_size()
    {        
        $Model =M();
        $sql = "SHOW TABLE STATUS FROM ".C('DB_NAME');
        $tblPrefix = C('DB_PREFIX');
        if($tblPrefix != null) {
            $sql .= " LIKE '{$tblPrefix}%'";
        }
        $row = $Model->query($sql);
        $size = 0;
        foreach($row as $value) {
            $size += $value["data_length"] + $value["index_length"];
			
        }
        return round(($size/1048576),2).'M';
    }
   private function show_icon()
    {
		$show_icon_array=FF('Conf/icon','',APP_PATH.'System/');
		$this->assign('show_icon_array',$show_icon_array);
        $this->display();		
    }
}
<?php
namespace Db\Controller;
use Think\Controller;

class DatabaseController extends Controller {
    public $r_time=10;
    function __construct()  //析构函数
    {
        parent::__construct();
    }

    /*
     * 数据库备份
     */
    public function export(){
        //配置信息
        $database = FF('Conf/db','','./Data/');
        $dosubmit = I('dosubmit') ? I('dosubmit') : '';
        //导出
        if($dosubmit) {
            $dbname = I('db_name');
            $to_file_name = L('backup_path').date("YmdHis").'_'.I('backup_name').'.sql';//备份文件名
            //链接数据库
            $link = mysqli_connect($database['DB_HOST'],$database['DB_USER'],$database['DB_PWD']);
            mysqli_select_db($link,$dbname);
            //选择编码
            mysqli_set_charset($link,$database['DB_CHARSET']);
            //数据库中有哪些表
            if (!$link) {
                echo 'Could not connect to mysql';
                exit;
            }

            $sql = "SHOW TABLES FROM $dbname";
            $result = mysqli_query($link,$sql);

            if (!$result) {
                echo "DB Error, could not list tables\n";
                echo 'MySQL Error: ' . mysqli_error();
                exit;
            }

            //将这些表记录到一个数组
            $tabList = array();
            while($row = mysqli_fetch_row($result)){
                $tabList[] = $row[0];
            }
            dump($tabList);exit;

            //将每个表的表结构导出到文件
            foreach($tabList as $val){
                $sql = "show create table ".$val;
                $res = mysqli_query($link,$sql);
                $row = mysqli_fetch_array($res);
                $info = "SET FOREIGN_KEY_CHECKS=0;\r\n\n";
                $info .= "-- ----------------------------\r\n";
                $info .= "-- Table structure for `".$val."`\r\n";
                $info .= "-- ----------------------------\r\n";
                $info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
                $sqlStr = $info.$row[1].";\r\n\r\n";
                //追加到文件
                file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
                //释放资源
                mysqli_free_result($res);
            }
            //将每个表的数据导出到文件
            foreach($tabList as $val){
                $sql = "select * from ".$val;
                $res = mysqli_query($link,$sql);
                //如果表中没有数据，则继续下一张表
                if(mysqli_num_rows($res)<1) continue;
                //
                $info = "SET FOREIGN_KEY_CHECKS=0;\r\n";
                $info .= "-- ----------------------------\r\n";
                $info .= "-- Records for `".$val."`\r\n";
                $info .= "-- ----------------------------\r\n";
                file_put_contents($to_file_name,$info,FILE_APPEND);
                //读取数据
                while($row = mysqli_fetch_row($res)){
                    $sqlStr = "INSERT INTO `".$val."` VALUES (";
                    foreach($row as $zd){
                        $sqlStr .= "'".$zd."', ";
                    }
                    //去掉最后一个逗号和空格
                    $sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
                    $sqlStr .= ");\r\n";
                    file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
                }
                //释放资源
                mysqli_free_result($res);
                file_put_contents($to_file_name,"\r\n",FILE_APPEND);
            }

            $this->success(L('bakup_succ'),U('Db/Database/import'),$this->r_time);
        }else{
            $db_name=$database['DB_NAME'];
            $this->assign('db_name',$db_name);
            $this->display();
        }
    }

    /*
     * 数据库恢复
     */
    public function import(){
        if(I('get.filename')){//还原数据
            $path=L('backup_path');
            $filename=I('get.filename');
            $this->import_database($path,$filename);
        }else{
            //遍历数据
            $pdos = $others = array();
            $pdoname = $_GET['pdoname'] ? $_GET['pdoname'] : key($pdos);
            $sqlfiles = glob(L('backup_path').$pdoname.'*.sql');
            if(is_array($sqlfiles)) {
                asort($sqlfiles);
                $other = $others = array();
                foreach($sqlfiles as $id=>$sqlfile) {
                    $other['filename'] = basename($sqlfile);
                    $other['filesize'] = sizecount(filesize($sqlfile));
                    $other['maketime'] = date('Y-m-d H:i:s',filemtime($sqlfile));
                    $others[] = $other;
                }
            }
            $this->assign('others',$others);
            $this->display();
        }
    }

    /**
     * 数据库恢复
     * @param $path  sql文件存储路径
     * @param unknown_type $filename  文件名称
     */
    private function import_database($path,$filename) {
        if($filename && fileext($filename)=='sql') {//获取文件名后缀
            $filepath = $path.$filename;
            if(!file_exists($filepath)) $this->error(L('database_sorry')." $filepath ".L('database_not_exist'),$this->r_time);
            $sql = file_get_contents($filepath);
            $result=$this->sql_execute($sql);
            if($result){
                $this->success("$filename ".L('data_recover_succ'),'',$this->r_time);
            }
        }
    }

    /**
     * 执行SQL
     * @param unknown_type $sql
     */
    private function sql_execute($sql) {
        //配置信息
        $database = FF('Conf/db','','./Data/');
        //链接数据库
        $link = mysqli_connect($database['DB_HOST'],$database['DB_USER'],$database['DB_PWD']);
        mysqli_select_db($link,$database['DB_NAME']);
        //选择编码
        mysqli_set_charset($link,$database['DB_CHARSET']);
        $sqls = $this->sql_split($sql,$database['DB_PREFIX']);
        if(is_array($sqls)) {
            foreach($sqls as $sql) {
                if(trim($sql) != '') {
                    $a=mysqli_query($link,$sql);
//                  echo '';
                }
            }
        } else {
            mysqli_query($link,$sqls);
        }
        return true;
    }

    private function sql_split($sql,$cfg_db_prefix) {
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach($queries as $query) {
                $str1 = substr($query, 0, 1);
                if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
            }
            $num++;
        }
        return($ret);
    }

    /*
     * 删除备份文件
     */
    public function delete(){
        $filename=I('get.filename');
        $path=L('backup_path');
        if($filename){
            if(fileext($filename)=='sql'){
                @unlink($path.$filename);
                $this->success(L('backup_del').L('SUCCESS'),U('Db/Database/import'),$this->r_time);
            }
        }else{
            $this->error(L('select_delfile'),U('Db/Database/import'),$this->r_time);
        }
    }

}
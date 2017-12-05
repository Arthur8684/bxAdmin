<?php
namespace Db\Controller;
use Think\Controller;

class DatabasesController extends Controller {
    public $db; // 数据库连接
    public $config;
    public $sqldir; // 数据库备份文件夹
    public $record;
    // 换行符
    private $ds = "\n";
    // 存储SQL的变量
    public $sqlContent = "";
    // 每条sql语句的结尾符
    public $sqlEnd = ";";
    public $r_time = 10;
    public $tables = array();
    public $databases = array();

    /**
     * 初始化
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $thisatabase
     * @param string $charset
     */
    function __construct(){
        parent::__construct();
        $this->config = FF('Conf/db','','./Data/');
        $this->config['DB_CHARSET']='utf8';
        // 连接数据库
        $this->db = mysqli_connect ( $this->config['DB_HOST'], $this->config['DB_USER'], $this->config['DB_PWD'] ) or die ( "数据库连接失败." );
        // 选择使用哪个数据库
        mysqli_select_db ( $this->db, $this->config['DB_NAME']) or die ( "无法打开数据库" );
        // 数据库编码方式
        mysqli_set_charset ( $this->db, $this->config['DB_CHARSET']);
    }

/*-----------------------------------------------数据备份start----------------------------------------------*/
    public function export(){
        $dosubmit = I('dosubmit') ? I('dosubmit') : '';
        if($dosubmit){
            $tablename = I('tabList');
            $size=I('size') ? I('size') : 1024;//分卷文件大小
            $sql = '';
//            $bakup_name=I('bakup_name') ? I('bakup_name') : I('db_name');
            $db_name = I('db_name');
            //备份表
            if (! empty ( $tablename )) {
                $dir=C('backup_path').'table/'.date('YmdHis').'/';
                for($i=0;$i<count($tablename);$i++){
                    echo '正在备份表' . $tablename[$i] . '<br />';
                    // 插入dump信息
                    $sql = $this->_retrieve();
                    // 插入表结构信息
                    $sql .= $this->_insert_table_structure ( $tablename[$i] );
                    // 插入数据
                    $data = mysqli_query ( $this->db,"select * from " . $tablename[$i] );
                    // 文件名前面部分
                    $filename = $tablename[$i];
                    // 字段数量
                    $num_fields = mysqli_num_fields ( $data );
                    // 第几分卷
                    $p = 1;
                    // 循环每条记录
                    while ( $record = mysqli_fetch_array ( $data ) ) {
                        // 单条记录
                        $sql .= $this->_insert_record ( $tablename[$i], $num_fields, $record );
                        // 如果大于分卷大小，则写入文件
                        if (strlen ( $sql ) >= $size * 1024) {
                            $file = $filename . "_v" . $p . ".sql";
                            if ($this->_write_file ( $sql, $file, $dir )) {
                                echo "表-" . $tablename[$i] . "-卷-" . $p . "-数据备份完成,生成备份文件 <span style='color:#f00;'>$dir$filename</span><br />";
                            } else {
                                echo "备份表-" . $tablename[$i] . "-失败<br />";
                            }
                            // 下一个分卷
                            $p ++;
                            // 重置$sql变量为空，重新计算该变量大小
                            $sql = "";
                        }
                    }
                    // sql大小不够分卷大小
                    if ($sql != "") {
                        $filename .= "_v" . $p . ".sql";
                        if ($this->_write_file ( $sql, $filename, $dir )) {
                            echo "表-" . $tablename[$i] . "-卷-" . $p . "-数据备份完成,生成备份文件 <span style='color:#f00;'>$dir$filename</span><br />";
                        } else {
                            echo "备份卷-" . $p . "-失败<br />";
                        }
                    }
                }
            } else {
//                备份库
                $dir=C('backup_path').'database/'.date('YmdHis').'/';
                // 备份全部表
                if ($tables = mysqli_query ( $this->db, "show table status from " . $this->config['DB_NAME'] )){
                    echo "读取数据库结构成功！<br />";
                } else {
                    exit ( "读取数据库结构成功！<br />" );
                }
                // 插入dump信息
                $sql .= $this->_retrieve();
                // 文件名前面部分
                $filename = $db_name;
                // 查出所有表
                $tables = mysqli_query ( $this->db, 'SHOW TABLES' );
                // 第几分卷
                $p = 1;
                // 循环所有表
                while ( $table = mysqli_fetch_array ( $tables ) ) {
                    // 获取表名
                    $tablename = $table [0];
                    // 获取表结构
                    $sql .= $this->_insert_table_structure ( $tablename );
                    $data = mysqli_query ( $this->db, "select * from " . $tablename );
                    $num_fields = mysqli_num_fields ( $data );
                    // 循环每条记录
                    while ( $record = mysqli_fetch_array ( $data ) ) {
                        // 单条记录
                        $sql .= $this->_insert_record ( $tablename, $num_fields, $record );
                        // 如果大于分卷大小，则写入文件
                        if (strlen ( $sql ) >= $size * 1024) {
                            $file = $filename . "_v" . $p . ".sql";
                            // 写入文件
                            if ($this->_write_file ( $sql, $file, $dir )) {
                                echo "-卷-" . $p . "-数据备份完成,生成备份文件<span style='color:#f00;'>$dir$file</span><br />";
                            } else {
                                echo "备份卷-" . $p . "-失败<br />";
                            }
                            // 下一个分卷
                            $p ++;
                            // 重置$sql变量为空，重新计算该变量大小
                            $sql = "";
                        }
                    }
                }
                // sql大小不够分卷大小
                if ($sql != "") {
                    $filename .= "_v" . $p . ".sql";
                    if ($this->_write_file ( $sql, $filename, $dir )) {
                        echo "-卷-" . $p . "-数据备份完成,生成备份文件 <span style='color:#f00;'>$dir$filename<br />";
                    } else {
                        echo "备份卷-" . $p . "-失败<br />";
                    }
                }
            }
            //将备注信息写入remark.txt文件
            $remark = I('remark');
            $content = $size.'###'.$remark;
//            dump($content);
            $file = 'remark.txt';
            $this->_write_file($content,$file,$dir);
        }else{
            $tabList = $this->tables();
            $this->assign('tabList',$tabList);
            $this->assign('db_name',$this->config['DB_NAME']);
            $this->display();
        }

    }

//    查询所有数据表
    public function tables(){
        if (!$this->db) {
            echo 'Could not connect to mysql';
            exit;
        }

        $db_name=$this->config['DB_NAME'];
        $sql = "SHOW TABLES FROM $db_name";
        $result = mysqli_query($this->db,$sql);

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
        return $tabList;
    }

    /**
     * 插入数据库备份基础信息
     *
     * @return string
     */
    private function _retrieve() {
        $value = '';
        $value .= '--' . $this->ds;
        $value .= '-- MySQL database dump' . $this->ds;
        $value .= '-- Created by DBManage class, Power By yanue. ' . $this->ds;
        $value .= '-- http://yanue.net ' . $this->ds;
        $value .= '--' . $this->ds;
        $value .= '-- 主机: ' . $this->config['DB_HOST'] . $this->ds;
        $value .= '-- 生成日期: '.date('Y年m月d日H:i:s').$this->ds;
        $value .= '-- MySQL版本: ' . mysqli_get_server_info ($this->db) . $this->ds;
        $value .= '-- PHP 版本: ' . phpversion () . $this->ds;
        $value .= $this->ds;
        $value .= '--' . $this->ds;
        $value .= '-- 数据库: `' . $this->config['DB_NAME'] . '`' . $this->ds;
        $value .= '--' . $this->ds . $this->ds;
        $value .= '-- -------------------------------------------------------';
        $value .= $this->ds . $this->ds;
        return $value;
    }

    /**
     * 插入表结构
     *
     * @param unknown_type $table
     * @return string
     */
    private function _insert_table_structure($table) {
        $sql = '';
        $sql .= "--" . $this->ds;
        $sql .= "-- 表的结构" . $table . $this->ds;
        $sql .= "--" . $this->ds . $this->ds;
        // 如果存在则删除表
        $sql .= "DROP TABLE IF EXISTS `" . $table . '`' . $this->sqlEnd . $this->ds;
        // 获取详细表信息
        $res = mysqli_query ($this->db, 'SHOW CREATE TABLE `' . $table . '`' );
        $row = mysqli_fetch_array ( $res );
        $sql .= $row [1];
        $sql .= $this->sqlEnd . $this->ds;
        // 加上
        $sql .= $this->ds;
        $sql .= "--" . $this->ds;
        $sql .= "-- 转存表中的数据 " . $table . $this->ds;
        $sql .= "--" . $this->ds;
        $sql .= $this->ds;
        return $sql;
    }

    /**
     * 插入单条记录
     *
     * @param string $table
     * @param int $num_fields
     * @param array $record
     * @return string
     */
    private function _insert_record($table, $num_fields, $record) {
        // sql字段逗号分割
        $comma = "";
        $insert= '';
        $insert .= "INSERT INTO `" . $table . "` VALUES(";
        // 循环每个子段下面的内容
        for($i = 0; $i < $num_fields; $i ++) {
            $insert .= ($comma . "'" . mysqli_escape_string ( $this->db, $record [$i] ) . "'");
            $comma = ",";
        }
        $insert .= ");" . $this->ds;
        return $insert;
    }

    /**
     * 写入文件
     *
     * @param string $sql
     * @param string $filename
     * @param string $dir
     * @return boolean
     */
    private function _write_file($sql, $filename, $dir) {
        // 不存在文件夹则创建
        if (! file_exists ( $dir )) {
            mkdir ( $dir,'0777',true );
        }
        $re = true;
        if (! @$fp = fopen ( $dir . $filename, "w+" )) {
            $re = false;
            echo "打开文件失败！";
        }
        if (! @fwrite ( $fp, $sql )) {
            $re = false;
            echo "写入文件失败，请确认文件是否可写";
        }
        if (! @fclose ( $fp )) {
            $re = false;
            echo "关闭文件失败！";
        }
        return $re;
    }
/*-----------------------------------------------数据备份stop----------------------------------------------*/



/*-----------------------------------------------数据还原start----------------------------------------------*/
    public function import(){

        $dir=I('dir');
        $type=I('type');
        if($dir){
            if($type=='database'){
                //查询指定目录中的文件
                $dir=C('backup_path').$type.'/'.$dir;
                $files=scandir($dir);
                //只留下sql文件
                $file_list=array();
                foreach ($files as $v){
                    if(preg_match('/\w+\.sql/',$v)){
                        $file_list[]=$v;
                    }
                }
                //包含分卷
                if(count($file_list)>1){
                    foreach($file_list as $file){
//                    echo "正在导入sql：<span style='color:#f00;'>" . $dir.'/'.$file. '</span><br />';
                        if($this->_import($dir.'/'.$file)){
                            echo '<p>导入'.$file.'文件成功</p>';
                        }else{
                            echo '<p style="color:#f00;">导入'.$file.'文件失败</p>';
                        }
                    }
                }
                //不包含分卷
                if(count($file_list)==1){
//                echo "正在导入sql：<span style='color:#f00;'>" . $dir.'/'.$file_list[0] . '</span><br />';
                    // 没有分卷
                    if ($this->_import ( $dir.'/'.$file_list[0] )) {
                        echo "<p>数据库导入成功！</p>";
                    } else {
                        exit ( '<p style="color:#f00;">数据库导入失败！</p>' );
                    }
                }
            }

            if($type=='table'){
                $filename=I('filename');
                $dir=C('backup_path').I('type').'/'.I('dir');
                $sqlfile=$dir.'/'.$filename;
                // 检测文件是否存在
                if (! file_exists ( $sqlfile )) {
                    exit ( "文件不存在！请检查" );
                }
                // 获取数据库存储位置
                $sqlpath = pathinfo ( $sqlfile );
                $this->sqldir = $sqlpath ['dirname'];
                // 检测是否包含分卷，将类似20120516211738_all_v1.sql从_v分开,有则说明有分卷
                $volume = explode ( "_v", $sqlfile );
                $volume_path = $volume [0];
                if (empty ( $volume [1] ))
                {
                    // 没有分卷
                    if ($this->_import ( $sqlfile )) {
                        echo "数据库导入成功！";
                    }
                    else
                    {
                        exit ( '数据库导入失败！' );
                    }
                } else {
                    //$volume_id = array();
                    // 存在分卷，则获取当前是第几分卷，循环执行余下分卷
                    $volume_id = explode ( ".sq", $volume [1] );
                    // 当前分卷为$volume_id
                    $volume_id = intval ( $volume_id [0] );
                    if($volume_id>1) $volume_id=1;//从分卷一开始执行
                    while ( $volume_id ) {
                        $tmpfile = $volume_path . "_v" . $volume_id . ".sql";
                        // 存在其他分卷，继续执行
                        if (file_exists ( $tmpfile )) {
                            // 执行导入方法
                            echo "正在导入分卷$volume_id：<span style='color:#f00;'>" . $tmpfile . '</span><br />';
                            if ($this->_import ( $tmpfile )) {
                            } else {
                                exit ( "导入分卷$volume_id：<span style='color:#f00;'>" . $tmpfile . '</span>失败！可能是数据库结构已损坏！请尝试从分卷1开始导入' );
                            }
                        } else {
                            echo "此备份全部导入成功！<br />";
                            return;
                        }
                        $volume_id++;
                    }
                }
            }
        }else{
            $dir = C('backup_path').'database';
            $databases=array();
            $dir_list = $this->listDir($dir,'database');
            for($i=0;$i<count($dir_list);$i++){
                $dir1=$dir.'/'.$dir_list[$i];
                $sqls=array();
                $databases[$i]['dir']=$dir_list[$i];
                $this->listFiles($dir1,'database');
                for($j=0;$j<count($this->databases[$dir1]);$j++){
                    if(preg_match('/\w+\.sql/',$this->databases[$dir1][$j]['filename'])){
                        $sqls[]=$this->databases[$dir1][$j];
                    }
                    if(preg_match('/\w+\.txt/',$this->databases[$dir1][$j]['filename'])){
                        $remark=$this->databases[$dir1][$j];
                        $content = explode('###',file_get_contents($dir1.'/'.$remark['filename']));
                        $remark['content']=$content;
                    }
                }
                $databases[$i]['file_list']=$sqls;
                $databases[$i]['remark']=$remark;
            }
            $this->assign('databases',$databases);
//            unset($this->databases[$dir]);

            $dir = C('backup_path').'table';
            $tables=array();
            $dir_list = $this->listDir($dir,'table');
            for($i=0;$i<count($dir_list);$i++){
                $dir1=$dir.'/'.$dir_list[$i];
                $sqls=array();
                $tables[$i]['dir']=$dir_list[$i];
                $this->listFiles($dir1,'table');
                for($j=0;$j<count($this->tables[$dir1]);$j++){
                    if(preg_match('/\w+\.sql/',$this->tables[$dir1][$j]['filename'])){
                        $sqls[]=$this->tables[$dir1][$j];
                    }
                    if(preg_match('/\w+\.txt/',$this->tables[$dir1][$j]['filename'])){
                        $remark=$this->tables[$dir1][$j];
                        $content = explode('###',file_get_contents($dir1.'/'.$remark['filename']));
                        $remark['content']=$content;
                    }
                }
                $tables[$i]['file_list']=$sqls;
                $tables[$i]['remark']=$remark;
            }
            $this->assign('tables',$tables);
            $this->display();
        }
    }

//    详情
    public function info(){
        $dir=C('backup_path').I('type').'/'.I('dir');
        $this->listFiles($dir,I('type'));
        if(I('type')=='database'){
            $file_list=$this->databases[$dir];
        }
        if(I('type')=='table'){
            $file_list=$this->tables[$dir];
//            dump($file_list);
        }
        foreach($file_list as $k=>$v){
            if(preg_match('/\w+\.txt/',$file_list[$k]['filename'])){
                unset($file_list[$k]);
            }
        }
        $this->assign('infos',$file_list);
        $this->assign('type',I('type'));
        $this->assign('dir',I('dir'));
        $this->display();
    }

//    查询目录
    public function listDir($dir,$flag){
        //打开目录
        $handle=opendir($dir);
        $dir_list=array();//目录列表
        //阅读目录
        while(false != ($dir_name=readdir($handle))){
            //列出所有目录并去掉‘.’和‘..’
            if($dir_name!='.' && $dir_name!='..'){
                $dir_list[]=$dir_name;
            }
        }
        return $dir_list;
    }

//    查询文件
    public function listFiles($dir,$flag){
        //打开目录
        $handle=opendir($dir);
        //阅读目录
        while(false!=($file=readdir($handle))) {
            //列出所有文件并去掉'.'和'..'
            if($file!='.'&&$file!='..') {
                //所得到的文件名是否是一个目录
                if(is_dir("$dir/$file")) {
                    //列出目录下的文件
                    $this->listFiles("$dir/$file",$flag);
                } else {
                    //如果是文件则打开该文件
                    $fp=fopen("$dir/$file","r");
                    //阅读文件内容
                    $data=fread($fp,filesize("$dir/$file"));
                    if($data){
                        //将读到的内容赋值给一个数组
                        $files[]="$dir/$file";
                    }
                }
            }
        }
        if(is_array($files)) {
            asort($files);
            $other = $others = array();
            foreach($files as $id=>$file) {
                $other['filename'] = basename($file);
                $other['filesize'] = sizecount(filesize($file));
                $other['maketime'] = date('Y-m-d H:i:s',filemtime($file));
                $others[] = $other;
            }
        }
        if($flag == 'database')
            $this->databases[$dir]=$others;

        if($flag == 'table')
            $this->tables[$dir]=$others;
    }

    /**
     * 将sql导入到数据库（普通导入）
     *
     * @param string $sqlfile
     * @return boolean
     */
    private function _import($sqlfile) {
        // sql文件包含的sql语句数组
        $sqls = array ();
        $f = fopen ( $sqlfile, "rb" );
        // 创建表缓冲变量
        $create = '';
        while ( ! feof ( $f ) ) {
            // 读取每一行sql
            $line = fgets ( $f );
            // 如果包含'-- '等注释，或为空白行，则跳过
            if (trim ( $line ) == '' || preg_match ( '/--.*?/', $line, $match )) {
                continue;
            }
            // 如果结尾包含';'(即为一个完整的sql语句，这里是插入语句)，并且不包含'ENGINE='(即创建表的最后一句)，
            if (! preg_match ( '/;/', $line, $match ) || preg_match ( '/ENGINE=/', $line, $match )) {
                // 将本次sql语句与创建表sql连接存起来
                $create .= $line;
                // 如果包含了创建表的最后一句
                if (preg_match ( '/ENGINE=/', $create, $match )) {
                    // 则将其合并到sql数组
                    $sqls [] = $create;
                    // 清空当前，准备下一个表的创建
                    $create = '';
                }
                // 跳过本次
                continue;
            }
            $sqls [] = $line;
        }
        fclose ( $f );
        // 循环sql语句数组，分别执行
        foreach ( $sqls as $sql ) {
            str_replace ( "\n", "", $sql );
            if (!mysqli_query ( $this->db,trim ( $sql ) )) {
                echo mysqli_error ();
                return false;
            }
        }
        return true;
    }
    /*-----------------------------------------------数据还原stop----------------------------------------------*/

    public function delete(){
        $type=I('type');
        $filename=I('filename');
        $dir=C('backup_path').$type.'/'.I('dir');
        //删除文件夹
        if(!$filename){
            //先删除目录下的文件：
            $dh=opendir($dir);
            while ($file=readdir($dh)) {
                if ($file != "." && $file != "..") {
                    $fullpath = $dir . "/" . $file;
                    if (!is_dir($fullpath)) {
                        unlink($fullpath);
                    } else {
                        deldir($fullpath);
                    }
                }
            }
            closedir($dh);
            //删除当前文件夹：
            if(rmdir($dir)) {
                $this->success(L('backup_del').L('SUCCESS'),'',$this->r_time);
            } else {
                $this->error(L('backup_del').L('ERR'),'',$this->r_time);
            }
        }else{
            if(fileext($filename)=='sql'){
                $sqlfile=$dir.'/'.$filename;
                // 检测文件是否存在
                if (! file_exists ( $sqlfile )) {
                    exit ( "文件不存在！请检查" );
                }
                // 获取数据库存储位置
                $sqlpath = pathinfo ( $sqlfile );
                $this->sqldir = $sqlpath ['dirname'];
                // 检测是否包含分卷，将类似20120516211738_all_v1.sql从_v分开,有则说明有分卷
                $volume = explode ( "_v", $sqlfile );
                $volume_path = $volume [0];
                if (empty ( $volume [1] ))
                {
                    // 没有分卷
                    @unlink($dir.'/'.$filename);
                    $this->success(L('backup_del').L('SUCCESS'),'',$this->r_time);
                } else {
                    //$volume_id = array();
                    // 存在分卷，则获取当前是第几分卷，循环执行余下分卷
                    $volume_id = explode ( ".sq", $volume [1] );
                    // 当前分卷为$volume_id
                    $volume_id = intval ( $volume_id [0] );
                    if($volume_id>1) $volume_id=1;//从分卷一开始执行
                    while ( $volume_id ) {
                        $tmpfile = $volume_path . "_v" . $volume_id . ".sql";
                        // 存在其他分卷，继续执行
                        if (file_exists ( $tmpfile )) {
                            @unlink($tmpfile);
                        } else {
                            echo "此备份全部删除成功！<br />";
                            return;
                        }
                        $volume_id++;
                    }
                }
            }
        }
    }

    // 锁定数据库，以免备份或导入时出错
    private function lock($tablename, $op = "WRITE") {
        if (mysqli_query ( $this->db,"LOCK TABLES " . $tablename . " " . $op )){
            return true;
        }else{
            return false;
        }
    }
    // 解锁
    private function unlock() {
        if (mysqli_query ( $this->db,"UNLOCK TABLES" ))
            return true;
        else
            return false;
    }

    public function jump(){
//        dump(I());
        $this->display();
        if(I('filename')){
            $this->redirect('Databases/import', array('dir'=>I('dir'),'type'=>I('type'),'filename'=>I('filename')),1,'正在恢复中。。。');
        }else{
            $this->redirect('Databases/import', array('dir'=>I('dir'),'type'=>I('type')),1,'正在恢复中。。。');
        }

    }
}
<?php
    /**
     * 取得文件扩展
     *
     * @param $filename 文件名
     * @return 扩展名
     */
    function fileext($filename) {
        return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
    }
?>

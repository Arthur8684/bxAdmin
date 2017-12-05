<?php
return array(
'_SIGN_'=>array(
		  "`id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
		  "`title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题'",
		  "`class_id` int(10) unsigned DEFAULT '0' COMMENT '分类'",
		  "`show_property` varchar(255) DEFAULT '0' COMMENT '显示属性'",
		  "`description` text NOT NULL COMMENT '内容简短说明'",
		  "`content` text COMMENT '请输入内容'",
		  "`addtime` int(11) DEFAULT '0' COMMENT '添加日期'",
		  "`thumb` varchar(255) DEFAULT '0' COMMENT '缩略图'",
		  "`autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID'",
		  "`autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份'",
		  "`price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格'",
		  "`verify`  tinyint(11) unsigned DEFAULT '0' COMMENT '审核'",
         ),
);
?>
<?php
return array(
'_SIGN_'=>array(
			  "`id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT",
			  "`title` varchar(255) NOT NULL DEFAULT '0' COMMENT '名称'",
			  "`class_id` int(10) unsigned DEFAULT '0' COMMENT '分类'",
			  "`show_property` varchar(255) DEFAULT '0' COMMENT '显示属性'",
			  "`price` float(15,2) unsigned DEFAULT '0.00' COMMENT '团购价格'",
			  "`market_price` float(15,2) unsigned DEFAULT '0.00' COMMENT '市场价格'",
			  "`separate_num` float(15,2) unsigned DEFAULT '0.00' COMMENT '分成金额'",
			  "`promote_point` int(10) unsigned DEFAULT '0' COMMENT '升级积分'",
			  "`separate_scale` varchar(255) DEFAULT '' COMMENT '分成比例'",
			  "`pictures` text COMMENT '团购图集'",
			  "`content` text NOT NULL COMMENT '团购内容'",
			  "`times_start` int(11) DEFAULT '0' COMMENT '团购日期'",
			  "`times_end` int(11) DEFAULT '0' COMMENT '团购日期'",
			  "`addtime` int(11) DEFAULT '0' COMMENT '添加日期'",
			  "`thumb` varchar(255) DEFAULT '0' COMMENT '缩略图'",
			  "`autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人ID'",
			  "`autho_admin` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户类型'",
			  "`verify`  tinyint(11) unsigned DEFAULT '0' COMMENT '审核'",
         ),
);
?>
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cow_advert
-- ----------------------------
DROP TABLE IF EXISTS `cow_advert`;
CREATE TABLE `cow_advert` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '广告位id',
  `img_url` varchar(255) DEFAULT NULL COMMENT '广告图片链接',
  `title` varchar(255) DEFAULT NULL COMMENT '文本内容',
  `a_url` varchar(255) DEFAULT NULL COMMENT '超链接',
  `start_time` int(11) unsigned DEFAULT '0' COMMENT '广告开始时间',
  `end_time` int(11) unsigned DEFAULT '0' COMMENT '结束时间',
  `add_time` int(11) unsigned DEFAULT '0' COMMENT '添加日期',
  `remarks` text COMMENT '广告备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for cow_advert_type
-- ----------------------------
DROP TABLE IF EXISTS `cow_advert_type`;
CREATE TABLE `cow_advert_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT '广告位名称',
  `overdue_show` text COMMENT '过期显示内容',
  `overdue_show_type` tinyint(1) unsigned DEFAULT NULL COMMENT '广告过期是否显示信息，1显示0不显示，显示overdue_show自动内容',
  `setting` text COMMENT '广告位设置',
  `status` tinyint(2) unsigned DEFAULT NULL COMMENT '开启关闭',
  `default_img` varchar(255) DEFAULT NULL COMMENT '默认图片',
  `advert_type` varchar(20) DEFAULT NULL COMMENT '广告类型',
  `remarks` text COMMENT '广告备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;


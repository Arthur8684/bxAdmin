SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cow_collector_project
-- ----------------------------
DROP TABLE IF EXISTS `cow_collector_project`;
CREATE TABLE `cow_collector_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '项目名称',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '项目状态1开启0关闭',
  `user` varchar(255) DEFAULT NULL COMMENT '采集用户名',
  `pass` varchar(255) DEFAULT NULL COMMENT '密码',
  `num_min` int(11) unsigned DEFAULT '0' COMMENT '起始数值',
  `num_max` int(11) unsigned DEFAULT '0' COMMENT '结束数值',
  `page_interval` int(11) unsigned DEFAULT '0' COMMENT '页面间隔',
  `record_interval` int(11) unsigned DEFAULT '0' COMMENT '记录间隔',
  `is_login` tinyint(255) unsigned DEFAULT '0' COMMENT '是否需要登陆',
  `model_id` int(11) unsigned DEFAULT '0' COMMENT '模型ID',
  `url` text COMMENT '采集连接',
  `login_url` text COMMENT '登陆地址',
  `parm` varchar(255) DEFAULT NULL COMMENT '登陆其他参数',
  `charset` varchar(255) DEFAULT NULL COMMENT '采集编码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cow_collector_url
-- ----------------------------
DROP TABLE IF EXISTS `cow_collector_url`;
CREATE TABLE `cow_collector_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL COMMENT '采集链接',
  `collector_id` int(11) DEFAULT NULL COMMENT '数据包名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=334 DEFAULT CHARSET=utf8;

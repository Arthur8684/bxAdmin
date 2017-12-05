SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cow_wechat
-- ----------------------------
DROP TABLE IF EXISTS `cow_wechat_key`;
CREATE TABLE `cow_wechat_key` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text NOT NULL COMMENT '内容简短说明',
  `content` text COMMENT ' ',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT ' ',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT ' ',
  `keyword` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入关键字，多个关键字用逗号隔开',
  `verify` tinyint(11) unsigned NOT NULL DEFAULT '0' COMMENT '  ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cow_wechat
-- ----------------------------

-- ----------------------------
-- Table structure for cow_wechat_user
-- ----------------------------
DROP TABLE IF EXISTS `cow_wechat_user`;
CREATE TABLE `cow_wechat_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `sex` tinyint(1) unsigned DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL,
  `subscribe_time` int(11) unsigned DEFAULT NULL,
  `groupid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
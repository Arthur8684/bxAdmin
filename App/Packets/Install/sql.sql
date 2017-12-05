SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for cow_packets
-- ----------------------------
DROP TABLE IF EXISTS `cow_packets`;
CREATE TABLE `cow_packets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '红包id',
  `name` varchar(50) DEFAULT NULL COMMENT '红包名称',
  `form_type` varchar(50) DEFAULT NULL COMMENT '红包类型',
  `intervals` int(11) unsigned DEFAULT '0' COMMENT '红包领取的时间间隔，0表示任何适合可以领取',
  `intervals_type` varchar(20) DEFAULT NULL COMMENT '间隔类型 day：日 year：年 等',
  `times` int(11) unsigned DEFAULT NULL COMMENT '红包最多被同一个人领取多少次，0表示不限次数',
  `condition` text COMMENT '领取红包的条件',
  `money` float(11,2) unsigned DEFAULT '0.00' COMMENT '红包赠送人民币',
  `amount` float(11,2) unsigned DEFAULT '0.00' COMMENT '红包赠送的点数',
  `point` float(11,2) unsigned DEFAULT '0.00' COMMENT '红包赠送积分',
  `promote_point` int(11) unsigned DEFAULT '0' COMMENT '红包赠送升级点数',
  `qrcode_open` tinyint(1) unsigned DEFAULT '0' COMMENT '红包赠送获取二维码权限',
  `group_id` int(11) unsigned DEFAULT '0' COMMENT '红包赠送会员等级',
  `groups` varchar(255) DEFAULT NULL COMMENT '红包允许领取的会员等级',
  `holiday` varchar(50) DEFAULT '0' COMMENT '领取节日礼包的日期',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '红包是否开启1为开启 0为关闭',
  `remarks` varchar(255) DEFAULT NULL COMMENT '红包描述',
  `users` varchar(255) DEFAULT NULL COMMENT '领取会员，只允许此处填写的会员ID领取',
  `start_time` varchar(20) DEFAULT NULL COMMENT '红包开始领取日期',
  `end_time` varchar(20) DEFAULT NULL COMMENT '红包结束领取时间',
  `period_type` varchar(20) DEFAULT NULL COMMENT '红包周期',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '分步红包下一步红包id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

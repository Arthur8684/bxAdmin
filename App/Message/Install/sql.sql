SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for cow_message
-- ----------------------------
DROP TABLE IF EXISTS `cow_message`;
CREATE TABLE `cow_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `send_userid` int(11) unsigned DEFAULT '0' COMMENT '发送信息用户ID',
  `receive_userid` int(11) unsigned DEFAULT '0' COMMENT '接受用户ID',
  `send_status` tinyint(1) unsigned DEFAULT '0' COMMENT '发送信息的状态0表示用户接受方未读，1已读，2删除',
  `receive_status` tinyint(1) unsigned DEFAULT '0' COMMENT '接受信息的状态0未读，1已读，2删除',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加日期',
  `title` varchar(100) DEFAULT NULL COMMENT '短信标题',
  `content` text COMMENT '短信内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

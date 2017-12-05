SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cow_chat_class
-- ----------------------------
DROP TABLE IF EXISTS `cow_chat_class`;
CREATE TABLE `cow_chat_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(100) DEFAULT NULL COMMENT '分类名称',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '上级目录id',
  `sort` int(10) unsigned DEFAULT NULL COMMENT '分类的排序',
  `status` tinyint(11) unsigned DEFAULT NULL COMMENT '是否开启，1开启 0关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cow_chat_concern
-- ----------------------------
DROP TABLE IF EXISTS `cow_chat_concern`;
CREATE TABLE `cow_chat_concern` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '关注id',
  `from_userid` int(11) unsigned DEFAULT '0' COMMENT '关注人的用户ID',
  `to_userid` int(11) unsigned DEFAULT '0' COMMENT '被关注用户ID',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '关注时间',
  `property` tinyint(1) unsigned DEFAULT '0' COMMENT '关注属性，0普通，1置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cow_chat_face
-- ----------------------------
DROP TABLE IF EXISTS `cow_chat_face`;
CREATE TABLE `cow_chat_face` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'biaoqing类别id',
  `title` varchar(255) DEFAULT NULL COMMENT '表情类别名称',
  `path` varchar(255) DEFAULT NULL COMMENT '标签路径',
  `allow_group` varchar(255) DEFAULT NULL COMMENT '允许会员组,多个会员组用,隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cow_chat_gift
-- ----------------------------
DROP TABLE IF EXISTS `cow_chat_gift`;
CREATE TABLE `cow_chat_gift` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '礼物id',
  `title` varchar(100) DEFAULT NULL COMMENT '礼物名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '礼物状态 0关闭 1开启',
  `describe` text COMMENT '礼物描述',
  `price` int(11) unsigned DEFAULT '0' COMMENT '礼物点数',
  `ico` varchar(255) DEFAULT NULL COMMENT '图标地址',
  `show_type` tinyint(1) unsigned DEFAULT '1' COMMENT '显示样式 1在当前房间显示 2在所以房间显示',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '礼物排序',
  `show_interval` int(11) unsigned DEFAULT '0' COMMENT '礼包展示时长',
  `special` tinyint(2) unsigned DEFAULT '0' COMMENT '展示特性类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cow_chat_gift_record
-- ----------------------------
DROP TABLE IF EXISTS `cow_chat_gift_record`;
CREATE TABLE `cow_chat_gift_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录d',
  `gift_id` int(11) DEFAULT NULL COMMENT '礼物id',
  `from_user_id` int(11) unsigned DEFAULT '0' COMMENT '送礼用户id',
  `to_user_id` int(11) DEFAULT NULL COMMENT '接受礼物用户id',
  `num` int(11) unsigned DEFAULT '0' COMMENT '礼物数量',
  `pass_pre` varchar(50) DEFAULT NULL COMMENT '礼物密匙',
  `room_id` int(11) unsigned DEFAULT '0' COMMENT '房间ID',
  `addtime` int(11) unsigned DEFAULT NULL COMMENT '添加日期',
  `is_show` tinyint(1) unsigned DEFAULT '0' COMMENT '是否在聊天室显示效果，0未显示，1显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1133 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cow_chat_peoples
-- ----------------------------
DROP TABLE IF EXISTS `cow_chat_peoples`;
CREATE TABLE `cow_chat_peoples` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` varchar(100) DEFAULT NULL COMMENT '第三方源id',
  `url` text COMMENT '第三方源链接',
  `room_id` int(11) unsigned DEFAULT '0' COMMENT '直播视频id',
  `user_id` int(11) unsigned DEFAULT '0' COMMENT '用户ID',
  `peoples_type` tinyint(1) unsigned DEFAULT '0' COMMENT '1为永久 0为临时',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cow_chat_room
-- ----------------------------
DROP TABLE IF EXISTS `cow_chat_room`;
CREATE TABLE `cow_chat_room` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '直播房间id',
  `title` varchar(100) DEFAULT NULL COMMENT '房间名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '房间状态 0审核中，1通过审核，2关闭',
  `describe` text COMMENT '提示信息',
  `cid` text COMMENT '直播室对应通道ID',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `direct_head` varchar(255) DEFAULT '0' COMMENT '主播头像',
  `url` text COMMENT '视频流链接',
  `class_id` int(11) unsigned DEFAULT '0' COMMENT '房间分类',
  `open_peoples` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启多人视频',
  `get_type` tinyint(1) unsigned DEFAULT '0' COMMENT '获麦方式0为自由获取1为申请获麦',
  `anchor_cover` varchar(255) DEFAULT NULL COMMENT '主播封面',
  `live_time` int(11) unsigned DEFAULT '0' COMMENT '直播时间',
  `add_time` int(11) unsigned DEFAULT '0' COMMENT '开通房间时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

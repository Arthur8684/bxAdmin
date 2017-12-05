--
-- 表的结构cow_collector_project
--

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

--
-- 转存表中的数据 cow_collector_project
--

INSERT INTO `cow_collector_project` VALUES('7','采集新闻','1','user=ceshi','pass=123456','0','1','0','2','0','43','http://www.chinanews.com/huaren.shtml','http://demo.cowcms.com/index.php/User/login/index.php','','GB2312');
INSERT INTO `cow_collector_project` VALUES('8','百姓生活网','1','','','1','5','50','3','0','43','http://taiyuan.baixing.com/gongren/?page={*}','','','UTF-8');
--
-- 表的结构cow_collector_url
--

DROP TABLE IF EXISTS `cow_collector_url`;
CREATE TABLE `cow_collector_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL COMMENT '采集链接',
  `collector_id` int(11) DEFAULT NULL COMMENT '数据包名',
  `table` varchar(255) DEFAULT NULL COMMENT '数据包',
  `inserid` int(11) unsigned DEFAULT '0' COMMENT '采集记录id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=334 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_collector_url
--

INSERT INTO `cow_collector_url` VALUES('326','http://www.chinanews.com/hr/2017/03-06/8166771.shtml','7','','0');
INSERT INTO `cow_collector_url` VALUES('327','http://www.chinanews.com/hr/2017/03-06/8166736.shtml','7','','0');
INSERT INTO `cow_collector_url` VALUES('328','http://www.chinanews.com/hr/2017/03-06/8166697.shtml','7','','0');
INSERT INTO `cow_collector_url` VALUES('329','http://www.chinanews.com/hr/2017/03-06/8166634.shtml','7','','0');
INSERT INTO `cow_collector_url` VALUES('330','http://www.chinanews.com/hr/2017/03-06/8166610.shtml','7','','0');
INSERT INTO `cow_collector_url` VALUES('331','http://www.chinanews.com/hr/2017/03-06/8166600.shtml','7','','0');
INSERT INTO `cow_collector_url` VALUES('332','http://www.chinanews.com/hr/2017/03-06/8166469.shtml','7','','0');
INSERT INTO `cow_collector_url` VALUES('333','http://www.chinanews.com/hr/2017/03-06/8166314.shtml','7','','0');
--
-- 表的结构cow_consignee
--

DROP TABLE IF EXISTS `cow_consignee`;
CREATE TABLE `cow_consignee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `consignee` varchar(255) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `default` int(11) DEFAULT '0' COMMENT '是否默认地址 1为默认地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_consignee
--

--
-- 表的结构cow_expense_record
--

DROP TABLE IF EXISTS `cow_expense_record`;
CREATE TABLE `cow_expense_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `expense_money` float DEFAULT NULL,
  `expense_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_expense_record
--

--
-- 表的结构cow_form_tem
--

DROP TABLE IF EXISTS `cow_form_tem`;
CREATE TABLE `cow_form_tem` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '配置方案名称',
  `describe` varchar(255) DEFAULT NULL COMMENT '方案描述',
  `table` varchar(255) DEFAULT NULL COMMENT '表单所属数据包',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_form_tem
--

INSERT INTO `cow_form_tem` VALUES('12','myuser','会员中心资料修改表单','user');
--
-- 表的结构cow_games
--

DROP TABLE IF EXISTS `cow_games`;
CREATE TABLE `cow_games` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '游戏名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '游戏状态0关闭1开启',
  `sign` varchar(50) DEFAULT NULL COMMENT '标识',
  `class_id` int(11) unsigned DEFAULT NULL COMMENT '游戏分类id',
  `img` varchar(255) DEFAULT NULL COMMENT '游戏图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_games
--

INSERT INTO `cow_games` VALUES('1','推锅','0','Pushpot','6','/upload/admin/1/1497595617_1790153269.png');
INSERT INTO `cow_games` VALUES('5','斗地主','0','Against','1','/upload/admin/1/1497425310_1047927252.png');
INSERT INTO `cow_games` VALUES('6','明花麻将','1','Minghua','6','/upload/admin/1/1497425310_1047927252.png');
--
-- 表的结构cow_games_class
--

DROP TABLE IF EXISTS `cow_games_class`;
CREATE TABLE `cow_games_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '上级分类',
  `sort` int(11) unsigned DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_games_class
--

INSERT INTO `cow_games_class` VALUES('1','棋牌','0','0');
INSERT INTO `cow_games_class` VALUES('6','麻将','0','0');
--
-- 表的结构cow_games_notice
--

DROP TABLE IF EXISTS `cow_games_notice`;
CREATE TABLE `cow_games_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `show_property` varchar(255) DEFAULT '0' COMMENT '显示属性',
  `description` text COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_games_notice
--

INSERT INTO `cow_games_notice` VALUES('3','游戏首页公告','205','0','','<p>本游戏仅供娱乐,禁止赌博,一经发现不正当行为立即封号。</p>\r\n','1497345688','','1','admin','0.00','99');
--
-- 表的结构cow_games_num_record
--

DROP TABLE IF EXISTS `cow_games_num_record`;
CREATE TABLE `cow_games_num_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(11) unsigned DEFAULT '0' COMMENT '房间id',
  `user_id` int(11) unsigned DEFAULT '0' COMMENT '玩家ID',
  `success_num` int(11) unsigned DEFAULT '0' COMMENT '胜利局数',
  `point` int(11) DEFAULT '1' COMMENT '积分',
  `fail_num` int(11) unsigned DEFAULT '0' COMMENT '失败局数',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加时间',
  `accumulator_num` int(11) unsigned DEFAULT '0' COMMENT '最高连胜局数',
  `sign` varchar(255) DEFAULT NULL COMMENT '标识',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `headpath` varchar(255) DEFAULT NULL COMMENT '头像',
  `position` tinyint(3) unsigned DEFAULT '0' COMMENT '用户位置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=520 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_games_num_record
--

--
-- 表的结构cow_games_room
--

DROP TABLE IF EXISTS `cow_games_room`;
CREATE TABLE `cow_games_room` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `game_num` int(11) unsigned DEFAULT NULL COMMENT '局数',
  `addtime` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `people_num` int(11) DEFAULT '4' COMMENT '人数',
  `sign` varchar(50) DEFAULT NULL COMMENT '标识',
  `start_uid` int(11) unsigned DEFAULT '0' COMMENT '开房人的ID',
  `room_sn` varchar(255) DEFAULT '0' COMMENT '房间号',
  `payment_method` int(11) unsigned DEFAULT '0' COMMENT '0房主付费,1房间所有人扣费,2赢家付费',
  `multiple_upper` int(11) DEFAULT '0' COMMENT '炸弹最多上限',
  `game_type` tinyint(3) unsigned DEFAULT NULL COMMENT '游戏类型',
  `game_status` tinyint(3) unsigned DEFAULT '0' COMMENT '房间状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1774 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_games_room
--

INSERT INTO `cow_games_room` VALUES('1773','4','1507538537','4','Minghua','228','645059','0','0','1','0');
--
-- 表的结构cow_games_room_user
--

DROP TABLE IF EXISTS `cow_games_room_user`;
CREATE TABLE `cow_games_room_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned DEFAULT '0' COMMENT '用户id',
  `roomid` int(11) unsigned DEFAULT '0' COMMENT '房间id',
  `nickname` varchar(255) DEFAULT NULL COMMENT '用户名昵称',
  `headpath` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `point` int(11) unsigned DEFAULT NULL COMMENT '用户积分',
  `position` smallint(255) unsigned DEFAULT '0' COMMENT '用户位置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1321 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_games_room_user
--

INSERT INTO `cow_games_room_user` VALUES('1320','228','1773','醉','http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83er4iahmt7G3pY5AMXqVDNESEMJ2d5KRXdo5Xs9DibE7Mkv8NquuibCbmDBco2ZzaMRMCFQoXtib6dveUA/0','0','1');
--
-- 表的结构cow_good_buy
--

DROP TABLE IF EXISTS `cow_good_buy`;
CREATE TABLE `cow_good_buy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `show_property` varchar(255) DEFAULT '0' COMMENT '显示属性',
  `description` text NOT NULL COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_good_buy
--

INSERT INTO `cow_good_buy` VALUES('3','11111111111','202','1,2','','','1482288561','','1','admin','0.00','0');

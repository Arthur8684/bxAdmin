INSERT INTO `cow_accounts_record` VALUES('2711','111.00','112.00','114.00','113','115','0','0','0','0','0','6','0','注册赠送','vQcHVloumG','240','系统','1506752492','a:6:{s:4:\"open\";i:1;s:5:\"money\";d:111;s:6:\"amount\";d:112;s:13:\"promote_point\";i:113;s:5:\"point\";d:114;s:6:\"point1\";d:115;}');
INSERT INTO `cow_accounts_record` VALUES('2712','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：477651消费,房主支付','vQcHVloumG','240','SYSTEM','1506762512','a:1:{s:5:\"money\";d:110;}');
INSERT INTO `cow_accounts_record` VALUES('2713','111.00','112.00','114.00','113','115','0','0','0','0','0','6','0','注册赠送','LRbJkDXIQO','241','系统','1506771475','a:6:{s:4:\"open\";i:1;s:5:\"money\";d:111;s:6:\"amount\";d:112;s:13:\"promote_point\";i:113;s:5:\"point\";d:114;s:6:\"point1\";d:115;}');
INSERT INTO `cow_accounts_record` VALUES('2714','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：244637消费,房主支付','PpkADlwLsR','223','SYSTEM','1506773169','a:1:{s:5:\"money\";d:110;}');
INSERT INTO `cow_accounts_record` VALUES('2715','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：868940消费,房主支付','wTdXPifglQ','221','SYSTEM','1506818492','a:1:{s:5:\"money\";d:110;}');
INSERT INTO `cow_accounts_record` VALUES('2716','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：137889消费,房主支付','qbkrhPxVds','215','SYSTEM','1506858451','a:1:{s:5:\"money\";d:101;}');
INSERT INTO `cow_accounts_record` VALUES('2717','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：137889消费,房主支付','qbkrhPxVds','215','SYSTEM','1506858451','a:1:{s:5:\"money\";d:100;}');
INSERT INTO `cow_accounts_record` VALUES('2718','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：137889消费,房主支付','qbkrhPxVds','215','SYSTEM','1506858451','a:1:{s:5:\"money\";d:99;}');
INSERT INTO `cow_accounts_record` VALUES('2719','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：137889消费,房主支付','qbkrhPxVds','215','SYSTEM','1506858451','a:1:{s:5:\"money\";d:98;}');
INSERT INTO `cow_accounts_record` VALUES('2720','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：619190消费,房主支付','xZmgIUiRuM','220','SYSTEM','1506859281','a:1:{s:5:\"money\";d:110;}');
INSERT INTO `cow_accounts_record` VALUES('2721','111.00','112.00','114.00','113','115','0','0','0','0','0','6','0','注册赠送','yJwXVTHrRZ','242','系统','1506859761','a:6:{s:4:\"open\";i:1;s:5:\"money\";d:111;s:6:\"amount\";d:112;s:13:\"promote_point\";i:113;s:5:\"point\";d:114;s:6:\"point1\";d:115;}');
INSERT INTO `cow_accounts_record` VALUES('2722','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：246673消费,房主支付','xZmgIUiRuM','220','SYSTEM','1506861612','a:1:{s:5:\"money\";d:109;}');
INSERT INTO `cow_accounts_record` VALUES('2723','-1.00','0.00','0.00','0','0','0','0','0','0','0','1','5','房间号：567175消费,房主支付','wTdXPifglQ','221','SYSTEM','1506863964','a:1:{s:5:\"money\";d:109;}');
INSERT INTO `cow_accounts_record` VALUES('2724','111.00','112.00','114.00','113','115','0','0','0','0','0','6','0','注册赠送','eBtRAITGkX','243','系统','1506864181','a:6:{s:4:\"open\";i:1;s:5:\"money\";d:111;s:6:\"amount\";d:112;s:13:\"promote_point\";i:113;s:5:\"point\";d:114;s:6:\"point1\";d:115;}');
INSERT INTO `cow_accounts_record` VALUES('2725','111.00','112.00','114.00','113','115','0','0','0','0','0','6','0','注册赠送','IEekOmWzGq','244','系统','1506872205','a:6:{s:4:\"open\";i:1;s:5:\"money\";d:111;s:6:\"amount\";d:112;s:13:\"promote_point\";i:113;s:5:\"point\";d:114;s:6:\"point1\";d:115;}');
--
-- 表的结构cow_admin
--

DROP TABLE IF EXISTS `cow_admin`;
CREATE TABLE `cow_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL COMMENT '管理员账号',
  `pass` varchar(100) NOT NULL COMMENT '管理员密码',
  `pass_pre` varchar(50) DEFAULT NULL COMMENT '密码前缀',
  `email` varchar(100) DEFAULT '' COMMENT 'email',
  `role_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员所属的角色ID',
  `role` int(11) unsigned DEFAULT '0' COMMENT '管理员角色类型，1为超级管理',
  `power_id` int(11) unsigned DEFAULT '0' COMMENT '权限ID',
  `status` tinyint(2) unsigned NOT NULL COMMENT '管理员是否开启 1开启 0关闭',
  `addtime` int(11) NOT NULL COMMENT '添加日期',
  `is_del` tinyint(2) unsigned DEFAULT '0' COMMENT '是否不可删除，1表示不可删除',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  PRIMARY KEY (`id`),
  KEY `user_2` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_admin
--

INSERT INTO `cow_admin` VALUES('1','admin','95ec0a51ddedb62e98c9f412455eca00','AnvOCB','','1','0','0','1','1476348327','1','0');
--
-- 表的结构cow_advert
--

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_advert
--

INSERT INTO `cow_advert` VALUES('11','20','/upload/admin/1/1479353424_177122.jpg','111','http://','1488351420','1490338620','1489128891','');
--
-- 表的结构cow_advert_type
--

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_advert_type
--

INSERT INTO `cow_advert_type` VALUES('20','11111','<img src=\"[default_img]\" width=\"100%\"/>','1','array (\n  \\\'width\\\' => \\\'100\\\',\n  \\\'height\\\' => \\\'0\\\',\n  \\\'show_type\\\' => \\\'1\\\',\n)','1','0','image','111');
--
-- 表的结构cow_agent
--

DROP TABLE IF EXISTS `cow_agent`;
CREATE TABLE `cow_agent` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `agentName` varchar(255) NOT NULL,
  `area_id` int(100) unsigned NOT NULL DEFAULT '0' COMMENT '区域id',
  `user_id` int(100) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_agent
--

--
-- 表的结构cow_auth_rule
--

DROP TABLE IF EXISTS `cow_auth_rule`;
CREATE TABLE `cow_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `condition_open` tinyint(1) DEFAULT '1' COMMENT '为1表示解析condition字段信息',
  `status` tinyint(1) DEFAULT '1',
  `condition` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL COMMENT '属于哪个种类的验证规则',
  `auth_m` varchar(50) DEFAULT NULL COMMENT '模型名称',
  `auth_c` varchar(50) DEFAULT NULL COMMENT '控制器名称',
  `auth_a` varchar(50) DEFAULT NULL COMMENT '方法名称',
  `auth_p` varchar(255) DEFAULT NULL COMMENT '链接参数',
  `is_del` tinyint(1) unsigned DEFAULT '0' COMMENT '是否允许删除，1 不允许删除',
  `class_id` int(11) DEFAULT '0' COMMENT '类分ID',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=1115 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_auth_rule
--

INSERT INTO `cow_auth_rule` VALUES('26','Sys_model/Class/class_list?modelid=21','关键字分类','0','1','','','Sys_model','Class','class_list','modelid=21','0','13','0');
INSERT INTO `cow_auth_rule` VALUES('28','Admin/Site/Site_list','网站设置','0','1','','','Admin','Site','Site_list','','0','4','4');
INSERT INTO `cow_auth_rule` VALUES('30','Admin/Setting/Setting','基本设置','0','1','','','Admin','Setting','Setting','','0','4','89');
INSERT INTO `cow_auth_rule` VALUES('32','Admin/Menu/Menu_list?type=user','会员中心','0','1','','','Admin','Menu','Menu_list','type=user','0','4','0');
INSERT INTO `cow_auth_rule` VALUES('33','Admin/Menu/Menu_list?type=sell','卖家中心','0','1','','','Admin','Menu','Menu_list','type=sell','0','4','8');
INSERT INTO `cow_auth_rule` VALUES('34','Admin/Menu/Menu_list?type=index_show','首页菜单','0','1','','','Admin','Menu','Menu_list','type=index_show','0','4','12');
INSERT INTO `cow_auth_rule` VALUES('35','admin/menu/menu_list?type=admin','后台菜单','1','1','','','admin','menu','menu_list','type=admin','0','4','50');
INSERT INTO `cow_auth_rule` VALUES('36','Admin/Auth/auth_class_list','权限分类','0','1','','','Admin','Auth','auth_class_list','','0','4','30');
INSERT INTO `cow_auth_rule` VALUES('37','Admin/Auth/auth_list','权限规则','1','1','','','Admin','Auth','auth_list','','0','4','34');
INSERT INTO `cow_auth_rule` VALUES('38','Admin/Admin/Admin_Role_list','角色管理','0','1','','','Admin','Admin','Admin_Role_list','','0','6','23');
INSERT INTO `cow_auth_rule` VALUES('39','Admin/Admin/admin_list','管理列表','0','1','','','Admin','Admin','admin_list','','0','6','20');
INSERT INTO `cow_auth_rule` VALUES('40','Admin/install/install_list','模块列表','0','1','','','Admin','install','install_list','','0','5','0');
INSERT INTO `cow_auth_rule` VALUES('41','sys_model/Index/model_list','模型列表','0','1','','','sys_model','Index','model_list','','0','6','0');

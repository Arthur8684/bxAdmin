INSERT INTO `cow_table_field` VALUES('755','autho_id','发布人ID','3','single_information','发布人ID','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','text','7','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('756','autho_admin','用户类型','3','single_information','用户类型','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','text','8','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('757','addtime','添加日期','3','single_information','添加日期','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n)','datetime','9','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','datetime_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','datetime_1.html');
INSERT INTO `cow_table_field` VALUES('758','loginip','用户登录IP','','user','用户登录IP','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','0','','','','','','','0','0','0','','[title]\r\n	\r\n		  \r\n	\r\n	[remarks]','text_1.html','[title]\r\n	\r\n		  \r\n	\r\n	[remarks]','text_1.html');
INSERT INTO `cow_table_field` VALUES('759','lat','位置x','','user','位置x','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','0','','','','','','','0','0','0','','[title]\r\n	\r\n		  \r\n	\r\n	[remarks]','text_1.html','[title]\r\n	\r\n		  \r\n	\r\n	[remarks]','text_1.html');
INSERT INTO `cow_table_field` VALUES('760','lon','位置Y','','user','位置Y','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','0','','','','','','','0','0','0','','[title]\r\n	\r\n		  \r\n	\r\n	[remarks]','text_1.html','[title]\r\n	\r\n		  \r\n	\r\n	[remarks]','text_1.html');
--
-- 表的结构cow_user
--

DROP TABLE IF EXISTS `cow_user`;
CREATE TABLE `cow_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL COMMENT '管理员账号',
  `pass` varchar(100) NOT NULL COMMENT '管理员密码',
  `pass_pre` varchar(50) DEFAULT NULL COMMENT '密码前缀',
  `status` tinyint(2) DEFAULT '0' COMMENT '管理员是否开启 1开启 0关闭',
  `addtime` int(11) DEFAULT NULL COMMENT '添加日期',
  `group_id` int(11) unsigned DEFAULT '0' COMMENT '会员组id',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `email` varchar(255) DEFAULT '0' COMMENT '请输入邮箱',
  `recommend` bigint(20) DEFAULT '0' COMMENT '请输入推荐人ID',
  `openid` varchar(255) DEFAULT '0' COMMENT '微信OPENID',
  `nickname` varchar(255) DEFAULT '0' COMMENT '昵称',
  `pay_pass` varchar(100) DEFAULT '0' COMMENT '支付密码',
  `headpath` varchar(255) DEFAULT '0' COMMENT '0',
  `sex` int(11) DEFAULT '0' COMMENT '性别',
  `qrcode_open` bigint(20) DEFAULT '0' COMMENT '是否开通二维码自动，0表示开通，1表示未开通',
  `promote_point` bigint(20) unsigned DEFAULT '0' COMMENT '升级点数',
  `year_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '年消费',
  `month_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '月消费',
  `day_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '日消费',
  `total_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '累计消费',
  `year_order` bigint(20) unsigned DEFAULT '0' COMMENT '年订单',
  `month_order` bigint(20) unsigned DEFAULT '0' COMMENT '月订单',
  `day_order` bigint(20) unsigned DEFAULT '0' COMMENT '日订单',
  `total_order` bigint(20) unsigned DEFAULT '0' COMMENT '总订单',
  `time_consumption` bigint(20) unsigned DEFAULT '0' COMMENT '更新消费时间',
  `time_order` bigint(20) unsigned DEFAULT '0' COMMENT '订单更新时间',
  `day_recommend` bigint(20) DEFAULT '0' COMMENT '日推荐人数',
  `month_recommend` bigint(20) DEFAULT '0' COMMENT '月推荐人数',
  `year_recommend` bigint(20) DEFAULT '0' COMMENT '年推荐人数',
  `total_recommend` bigint(20) DEFAULT '0' COMMENT '0',
  `time_recommend` int(10) unsigned DEFAULT '0' COMMENT '推荐更新时间',
  `login_time` int(11) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `real_name_authentication` varchar(255) DEFAULT '0' COMMENT '实名认证信息 格式 姓名,身份证号,身份证图片',
  `mobile` varchar(255) DEFAULT '0' COMMENT '绑定手机号码 11位数字',
  `bank_authentication` varchar(255) DEFAULT '0' COMMENT '绑定银行卡信息 格式 卡号,地区id,银行名称,开户行',
  `is_real_name` tinyint(2) unsigned DEFAULT '0' COMMENT '0未通过，1通过',
  `is_bank_auth` tinyint(2) unsigned DEFAULT '0' COMMENT '0未通过，1已通过',
  `card` varchar(255) DEFAULT '0' COMMENT '会员卡',
  `money` float(15,2) unsigned DEFAULT '0.00' COMMENT '人民币',
  `amount` float(15,2) unsigned DEFAULT '0.00' COMMENT '点数',
  `point` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分',
  `point1` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分1',
  `point2` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分2',
  `point3` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分3',
  `point4` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分4',
  `point5` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分5',
  `point6` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分6',
  `birthday` int(11) DEFAULT '0' COMMENT '会员生日',
  `shengshi` varchar(255) DEFAULT '0' COMMENT '0',
  `loginip` varchar(255) DEFAULT '0' COMMENT '用户登录IP',
  `name` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT '0' COMMENT '位置x',
  `lon` varchar(255) DEFAULT '0' COMMENT '位置Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `user` (`user`),
  KEY `card` (`card`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_user
--

INSERT INTO `cow_user` VALUES('73','发过火','1a3555b936a16a5c9a02d2d230dd0ee8','ushpFe','0','1490690786','8','0','0111@qq.COM','0','0','大飞哥','0','','1','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1490976000','0','0','','0','0');

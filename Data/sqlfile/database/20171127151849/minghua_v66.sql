INSERT INTO `cow_shop` VALUES('22','70','龙城超市','生鲜水果，零食特产','/upload/user/46/1467455355_1126335379.png','style2','0','23','1467455414','','0','0','平阳路','15135144441','5','','','0');
INSERT INTO `cow_shop` VALUES('38','206','我的店123','我的店321','','style1','0','22','1477465104','','112.553216','37.851719','','','0','','','0');
INSERT INTO `cow_shop` VALUES('27','137','大乐送山西太原娄烦店','1','','style1','0','0','','','112.553216','37.851719','','','10','','','0');
INSERT INTO `cow_shop` VALUES('28','165','河南通许免费体验中心','0元车险+超市','/upload/user/133/1470392263_1296981243.jpg','style6','0','','','0','112.553216','37.851719','','','10','','','0');
INSERT INTO `cow_shop` VALUES('30','259','大乐送山西涧河店','加盟商','/upload/admin/1/1472032455_1150283326.jpg','style7','0','','','0','112.553216','37.851719','','','10','','','0');
INSERT INTO `cow_shop` VALUES('36','313','大乐送河南周口店','河南周口店','/upload/user/277/1472451835_1659463789.jpg','style1','0','0','1472532561','','112.553216','37.851719','','','10','','','0');
--
-- 表的结构cow_shop_category
--

DROP TABLE IF EXISTS `cow_shop_category`;
CREATE TABLE `cow_shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `parent_id` int(11) DEFAULT '0' COMMENT '上级id',
  `is_show` int(11) DEFAULT '0' COMMENT '否是显示 0显示 1不显示',
  `orders` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_shop_category
--

INSERT INTO `cow_shop_category` VALUES('22','家居用品','0','1','0');
INSERT INTO `cow_shop_category` VALUES('21','花卉植物','0','1','0');
INSERT INTO `cow_shop_category` VALUES('23','同城超市','0','1','0');
INSERT INTO `cow_shop_category` VALUES('24','超市','23','1','0');
INSERT INTO `cow_shop_category` VALUES('25','超市','24','1','0');
INSERT INTO `cow_shop_category` VALUES('18','生鲜水果','0','1','0');
--
-- 表的结构cow_single_information
--

DROP TABLE IF EXISTS `cow_single_information`;
CREATE TABLE `cow_single_information` (
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_single_information
--

INSERT INTO `cow_single_information` VALUES('3','购买房卡','213','0','','<p><img alt=\"\" src=\"http://demo.cowcms.com/upload/admin/1/1503709800_1238087797.png\" style=\"height:300px; width:780px\" /></p>\r\n','1502421225','0','1','admin','0.00','0');
INSERT INTO `cow_single_information` VALUES('4','玩法信息','214','0','','<p><img alt=\"\" src=\"http://demo.cowcms.com//upload/admin/1/1503372872_32664138.png\" style=\"height:2200px; width:780px\" /></p>\r\n','1502421248','0','1','admin','0.00','0');
INSERT INTO `cow_single_information` VALUES('5','消息信息','215','0','','<p><img alt=\"\" src=\"http://demo.cowcms.com/upload/admin/1/1503542627_232842941.png\" style=\"height:300px; width:780px\" /></p>\r\n','1502421261','0','1','admin','0.00','0');
INSERT INTO `cow_single_information` VALUES('6','游戏首页公告','216','0','','<p>游戏首页公告游戏首页公告游戏首页公告游戏首页公告游戏首页公告游戏首页公告游戏首页公告游戏首页公告游戏首页公告</p>\r\n','1502421302','0','1','admin','0.00','0');
INSERT INTO `cow_single_information` VALUES('7','首页轮播1','216','0','','<p>首页轮播1</p>\r\n','1503913678','/upload/admin/1/1503913642_1594364660.png','1','admin','0.00','0');
INSERT INTO `cow_single_information` VALUES('8','首页轮播2','216','0','','<p>首页轮播2</p>\r\n','1503913718','/upload/admin/1/1497425310_1047927252.png','1','admin','0.00','0');
--
-- 表的结构cow_site
--

DROP TABLE IF EXISTS `cow_site`;
CREATE TABLE `cow_site` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '网站名称',
  `domain` varchar(255) NOT NULL COMMENT '网站域名',
  `setting` text COMMENT '网站设置',
  `status` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_site
--

--
-- 表的结构cow_sys_model
--

DROP TABLE IF EXISTS `cow_sys_model`;
CREATE TABLE `cow_sys_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '系统模型名称',
  `type` varchar(50) DEFAULT NULL COMMENT '系统模型类型 article:文章  groupbuy:团购',
  `setting` text COMMENT '系统模型的设置',
  `model_class` varchar(50) DEFAULT NULL COMMENT '系统模型类别  content:内容模型，form:表单模型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_sys_model
--

INSERT INTO `cow_sys_model` VALUES('12','文章','Article','','content');
INSERT INTO `cow_sys_model` VALUES('17','商城','Goods','','content');
INSERT INTO `cow_sys_model` VALUES('18','团购','Group_buy','','content');
--
-- 表的结构cow_sys_model_class
--

DROP TABLE IF EXISTS `cow_sys_model_class`;
CREATE TABLE `cow_sys_model_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '模型分类',
  `sort` int(10) unsigned DEFAULT NULL COMMENT '分类的排序',
  `parent_id` int(11) unsigned DEFAULT NULL COMMENT '父分类的id',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '所属模型的模型ID',
  `status` tinyint(11) unsigned DEFAULT NULL COMMENT '是否开启，1开启 0关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_sys_model_class
--

INSERT INTO `cow_sys_model_class` VALUES('191','新闻','0','0','57','1');
INSERT INTO `cow_sys_model_class` VALUES('201','文具','0','0','66','1');
INSERT INTO `cow_sys_model_class` VALUES('198','娱乐','0','0','57','1');
INSERT INTO `cow_sys_model_class` VALUES('202','1111','0','0','69','1');
INSERT INTO `cow_sys_model_class` VALUES('172','站内公告','0','0','43','1');
INSERT INTO `cow_sys_model_class` VALUES('203','11111','0','202','69','1');
INSERT INTO `cow_sys_model_class` VALUES('204','2222222','0','203','69','1');
INSERT INTO `cow_sys_model_class` VALUES('205','游戏公告','0','0','70','1');
INSERT INTO `cow_sys_model_class` VALUES('206','笔','0','0','66','1');
INSERT INTO `cow_sys_model_class` VALUES('207','书','0','0','66','1');
INSERT INTO `cow_sys_model_class` VALUES('208','语文','0','201','66','1');
INSERT INTO `cow_sys_model_class` VALUES('209','圆柱笔','0','206','66','1');
INSERT INTO `cow_sys_model_class` VALUES('210','铅笔','0','206','66','1');
INSERT INTO `cow_sys_model_class` VALUES('211','精彩活动','0','0','71','1');
INSERT INTO `cow_sys_model_class` VALUES('212','游戏公告','0','0','71','1');
INSERT INTO `cow_sys_model_class` VALUES('213','购买房卡','0','0','72','1');
INSERT INTO `cow_sys_model_class` VALUES('214','玩法信息','0','0','72','1');
INSERT INTO `cow_sys_model_class` VALUES('215','消息信息','0','0','72','1');
INSERT INTO `cow_sys_model_class` VALUES('216','游戏公告','0','0','72','1');
--
-- 表的结构cow_system_accounts
--

DROP TABLE IF EXISTS `cow_system_accounts`;
CREATE TABLE `cow_system_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `amount` float(11,2) DEFAULT NULL COMMENT '金额',
  `order_sn` varchar(255) DEFAULT NULL COMMENT '订单号',
  `percentage` int(11) DEFAULT NULL COMMENT '抽取比例',
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  `pay_type` int(11) DEFAULT '0' COMMENT '支付类型',
  `coin_type` varchar(255) DEFAULT NULL COMMENT '币种',
  `c_type` int(11) DEFAULT '0' COMMENT '操作类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_system_accounts
--

INSERT INTO `cow_system_accounts` VALUES('45','1467896628','0.01','41%7C1467797633|用户充值1467896628','100','0','4','money','1');
INSERT INTO `cow_system_accounts` VALUES('46','1467912051','0.01','41%7C1467797633|用户充值1467912051','100','0','4','money','1');
--
-- 表的结构cow_table_field
--

DROP TABLE IF EXISTS `cow_table_field`;
CREATE TABLE `cow_table_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '数据表字段id',
  `field` varchar(50) DEFAULT '' COMMENT '数据表字段名称',
  `title` varchar(50) DEFAULT NULL COMMENT '数据表字段别名',
  `group` varchar(50) DEFAULT NULL COMMENT '字段所在的分组',
  `table` varchar(50) DEFAULT NULL COMMENT '字段所在的表的名称',
  `remarks` text COMMENT '字段备注信息',
  `setting` text COMMENT '字段设置配置的参数',
  `form_type` varchar(50) DEFAULT NULL COMMENT '字段表单类型',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序数值',
  `is_user_submit` text COMMENT '前台提交',
  `is_user_show` text COMMENT '前台显示',
  `is_user_edit` text COMMENT '是否允许会员进行编辑',
  `is_admin_submit` text COMMENT '后台角色提交',
  `is_admin_show` text COMMENT '后台是否显示',
  `is_admin_edit` text COMMENT '后台角色是否编辑',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '否开启 1开启 0关闭',
  `is_del` tinyint(2) unsigned DEFAULT '0' COMMENT '是否不可删除，1表示不可删除',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `show_tem` text COMMENT '前台显示模板内容',
  `tem_c` text COMMENT '表单模板内容',
  `template_type` varchar(100) DEFAULT NULL COMMENT '模板文件名称',
  `tem_mobile_c` text NOT NULL COMMENT '手机模板内容',
  `template_mobile_type` varchar(100) NOT NULL COMMENT '手机模板文件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=761 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_table_field
--

INSERT INTO `cow_table_field` VALUES('1','email','邮箱','0','user','请输入邮箱','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'^\\\\\\\\\\\\\\\\w+((-\\\\\\\\\\\\\\\\w+)|(\\\\\\\\\\\\\\\\.\\\\\\\\\\\\\\\\w+))*\\\\\\\\\\\\\\\\@[A-Za-z0-9]+((\\\\\\\\\\\\\\\\.|-)[A-Za-z0-9]+)*\\\\\\\\\\\\\\\\.[A-Za-z0-9]+$\\\',\n  \\\'reg_exp_pro\\\' => \\\'格式不正确\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','2','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','','');

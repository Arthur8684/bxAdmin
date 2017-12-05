INSERT INTO `cow_goods_property` VALUES('6','3','38','0.00','0','66','0');
INSERT INTO `cow_goods_property` VALUES('7','4','38','0.00','0','66','0');
--
-- 表的结构cow_group
--

DROP TABLE IF EXISTS `cow_group`;
CREATE TABLE `cow_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员组id',
  `name` varchar(50) DEFAULT NULL COMMENT '组名称',
  `setting` text COMMENT '会员组配置字符串',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '是否开启改会员组1开启0关闭',
  `is_reg` tinyint(2) unsigned DEFAULT '0' COMMENT '是否允许会员注册1允许0不允许',
  `is_verify` tinyint(2) unsigned DEFAULT '0' COMMENT '是否需要审核',
  `is_login` tinyint(2) unsigned DEFAULT '0' COMMENT '是否允许会员登陆1允许0不允许',
  `is_promote` smallint(2) unsigned DEFAULT '0' COMMENT '改会员组是否可升级',
  `coin_type` varchar(20) DEFAULT '0' COMMENT '购买会员组的币种',
  `price` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '升级会员组的价格',
  `sort_num` smallint(5) DEFAULT '0' COMMENT '会员组排序，数字越小越在前边',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `auth` text COMMENT '会员组权限设置',
  `level` tinyint(3) unsigned DEFAULT '0' COMMENT '会员组级别',
  `condition` text COMMENT '会员组升级条件',
  `price_limit` int(11) unsigned DEFAULT '0' COMMENT '限制会员组购买单价产品',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_group
--

INSERT INTO `cow_group` VALUES('1','普通会员','','1','1','0','1','1','point','0.00','1','0','','0','[is_real_name]  < 1','0');
INSERT INTO `cow_group` VALUES('2','合格会员','','1','1','1','1','1','money','0.00','0','0','','1','[is_real_name]  == 1','0');
INSERT INTO `cow_group` VALUES('3','入门会员','','1','1','1','1','1','money','0.00','0','0','','2','[is_real_name]  == 1 &&  [*1|2]  > 5','0');
INSERT INTO `cow_group` VALUES('4','一星会员','','1','1','1','1','1','money','0.00','0','0','','3','[is_real_name]  == 1 &&  [*1|3]  >= 5','0');
INSERT INTO `cow_group` VALUES('5','二星会员','','1','1','1','1','1','money','0.00','0','0','','4','[is_real_name] ==1 &&  [*1|4]  >=  5','3000');
INSERT INTO `cow_group` VALUES('6','三星会员','','1','1','1','1','1','money','0.00','0','0','','5','[is_real_name] ==1  &&  [*1|5]  >= 5','6000');
INSERT INTO `cow_group` VALUES('7','四星会员','','1','1','1','1','1','money','0.00','0','0','','6','[is_real_name]  == 1 &&  [*1|6]  >= 5','20000');
INSERT INTO `cow_group` VALUES('8','五星会员','','1','1','1','1','1','promote_point','0.00','0','0','','7','[is_real_name] ==1 &&  [*1|7]  >=  5','50000');
--
-- 表的结构cow_inventory_info
--

DROP TABLE IF EXISTS `cow_inventory_info`;
CREATE TABLE `cow_inventory_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) DEFAULT NULL COMMENT '模型id',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `quantity` int(11) DEFAULT NULL COMMENT '当前库存',
  `inventory` int(11) DEFAULT NULL COMMENT '入库量',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `msg` varchar(1000) DEFAULT NULL COMMENT '备注',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员',
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_inventory_info
--

--
-- 表的结构cow_inventory_shop
--

DROP TABLE IF EXISTS `cow_inventory_shop`;
CREATE TABLE `cow_inventory_shop` (
  `id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT '0' COMMENT '店铺id',
  `model_id` int(11) DEFAULT '0' COMMENT '模型id',
  `goods_id` int(11) DEFAULT '0' COMMENT '产品id',
  `quantity` int(11) DEFAULT '0' COMMENT '当前库存',
  `inventory` tinyint(4) DEFAULT '0' COMMENT '进出库量 正数入库 负数出库',
  `addtime` int(11) DEFAULT '0' COMMENT '添加时间',
  `msg` varchar(255) DEFAULT NULL COMMENT '备注',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_inventory_shop
--

INSERT INTO `cow_inventory_shop` VALUES('','17','55','3','15','5','1476781905','店铺名称【生鲜水果(17)】INPUT_INVENTORY','');
INSERT INTO `cow_inventory_shop` VALUES('','17','67','3','249','-1','1480317168','店铺名称【生鲜水果(17)】录入库存','');
INSERT INTO `cow_inventory_shop` VALUES('','17','67','3','259','10','1480317296','店铺名称【生鲜水果(17)】录入库存','');
--
-- 表的结构cow_linkage
--

DROP TABLE IF EXISTS `cow_linkage`;
CREATE TABLE `cow_linkage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '' COMMENT '名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '父id',
  `is_show` int(11) DEFAULT '1' COMMENT '否是显示',
  `orders` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=317 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_linkage
--

INSERT INTO `cow_linkage` VALUES('1','中国','0','1','0');
INSERT INTO `cow_linkage` VALUES('20','重庆市','1','1','0');
INSERT INTO `cow_linkage` VALUES('17','北京市','1','1','1');
INSERT INTO `cow_linkage` VALUES('18','天津市','1','1','0');
INSERT INTO `cow_linkage` VALUES('19','上海市','1','1','0');
INSERT INTO `cow_linkage` VALUES('21','河北省','1','1','0');
INSERT INTO `cow_linkage` VALUES('22','山西省','1','1','0');
INSERT INTO `cow_linkage` VALUES('24','辽宁省','1','1','0');
INSERT INTO `cow_linkage` VALUES('25','吉林省','1','1','0');
INSERT INTO `cow_linkage` VALUES('26','黑龙江省','1','1','0');
INSERT INTO `cow_linkage` VALUES('27','江苏省','1','1','0');
INSERT INTO `cow_linkage` VALUES('28','浙江省','1','1','0');
INSERT INTO `cow_linkage` VALUES('29','安徽省','1','1','0');
INSERT INTO `cow_linkage` VALUES('30','福建省','1','1','0');
INSERT INTO `cow_linkage` VALUES('31','江西省','1','1','0');
INSERT INTO `cow_linkage` VALUES('32','山东省','1','1','0');
INSERT INTO `cow_linkage` VALUES('33','河南省','1','1','0');
INSERT INTO `cow_linkage` VALUES('34','湖北省','1','1','0');
INSERT INTO `cow_linkage` VALUES('35','湖南省','1','1','0');
INSERT INTO `cow_linkage` VALUES('36','广东省','1','1','0');
INSERT INTO `cow_linkage` VALUES('37','海南省','1','1','0');
INSERT INTO `cow_linkage` VALUES('38','四川省','1','1','0');
INSERT INTO `cow_linkage` VALUES('39','贵州省','1','1','0');
INSERT INTO `cow_linkage` VALUES('40','云南省','1','1','0');
INSERT INTO `cow_linkage` VALUES('41','陕西省','1','1','0');
INSERT INTO `cow_linkage` VALUES('42','甘肃省','1','1','0');
INSERT INTO `cow_linkage` VALUES('43','青海省','1','1','0');
INSERT INTO `cow_linkage` VALUES('44','台湾省','1','1','0');
INSERT INTO `cow_linkage` VALUES('45','广西壮族自治区','1','1','0');
INSERT INTO `cow_linkage` VALUES('46','内蒙古自治区','1','1','0');
INSERT INTO `cow_linkage` VALUES('47','西藏自治区','1','1','0');
INSERT INTO `cow_linkage` VALUES('48','宁夏回族自治区','1','1','0');
INSERT INTO `cow_linkage` VALUES('49','新疆维吾尔自治区','1','1','0');
INSERT INTO `cow_linkage` VALUES('50','香港特别行政区','1','1','0');
INSERT INTO `cow_linkage` VALUES('52','太原市','22','1','0');
INSERT INTO `cow_linkage` VALUES('53','大同市','22','1','0');
INSERT INTO `cow_linkage` VALUES('54','朔州市','22','1','0');
INSERT INTO `cow_linkage` VALUES('55','阳泉市','22','1','0');
INSERT INTO `cow_linkage` VALUES('56','长治市','22','1','0');
INSERT INTO `cow_linkage` VALUES('57','忻州市','22','1','0');
INSERT INTO `cow_linkage` VALUES('58','吕梁市','22','1','0');
INSERT INTO `cow_linkage` VALUES('59','晋中市','22','1','0');
INSERT INTO `cow_linkage` VALUES('60','临汾市','22','1','0');
INSERT INTO `cow_linkage` VALUES('61','运城市','22','1','0');
INSERT INTO `cow_linkage` VALUES('62','晋城市','22','1','0');
INSERT INTO `cow_linkage` VALUES('63','万柏林区','52','1','0');
INSERT INTO `cow_linkage` VALUES('64','杏花岭区','52','1','0');
INSERT INTO `cow_linkage` VALUES('65','小店区','52','1','0');
INSERT INTO `cow_linkage` VALUES('66','尖草坪区','52','1','0');
INSERT INTO `cow_linkage` VALUES('67','晋源区','52','1','0');
INSERT INTO `cow_linkage` VALUES('68','清徐县','52','1','0');
INSERT INTO `cow_linkage` VALUES('69','阳曲县','52','1','0');
INSERT INTO `cow_linkage` VALUES('70','古交市','52','1','0');
INSERT INTO `cow_linkage` VALUES('71','娄烦县','52','1','0');
INSERT INTO `cow_linkage` VALUES('72','盐湖区','61','1','0');
INSERT INTO `cow_linkage` VALUES('73','绛县','61','1','0');
INSERT INTO `cow_linkage` VALUES('74','夏县','61','1','0');
INSERT INTO `cow_linkage` VALUES('75','新绛县','61','1','0');
INSERT INTO `cow_linkage` VALUES('76','稷山县','61','1','0');
INSERT INTO `cow_linkage` VALUES('77','芮城县','61','1','0');
INSERT INTO `cow_linkage` VALUES('78','临猗县','61','1','0');
INSERT INTO `cow_linkage` VALUES('79','万荣县','61','1','0');
INSERT INTO `cow_linkage` VALUES('80','闻喜县','61','1','0');
INSERT INTO `cow_linkage` VALUES('81','垣曲县','61','1','0');
INSERT INTO `cow_linkage` VALUES('82','平陆县','61','1','0');
INSERT INTO `cow_linkage` VALUES('83','永济市','61','1','0');
INSERT INTO `cow_linkage` VALUES('84','河津市','61','1','0');
INSERT INTO `cow_linkage` VALUES('85','尧都区　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('86','侯马市　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('87','霍州市　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('88','曲沃县　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('89','翼城县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('90','襄汾县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('91','洪洞县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('92','古　县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('93','安泽县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('94','浮山县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('95','吉　县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('96','乡宁县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('97','蒲　县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('98','大宁县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('99','永和县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('100','隰　县　　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('101','汾西县　　','60','1','0');
INSERT INTO `cow_linkage` VALUES('102','榆次区','59','1','0');
INSERT INTO `cow_linkage` VALUES('103','介休市','59','1','0');
INSERT INTO `cow_linkage` VALUES('104','榆社县','59','1','0');
INSERT INTO `cow_linkage` VALUES('105','左权县','59','1','0');
INSERT INTO `cow_linkage` VALUES('106','和顺县','59','1','0');
INSERT INTO `cow_linkage` VALUES('107','昔阳县','59','1','0');
INSERT INTO `cow_linkage` VALUES('108','寿阳县','59','1','0');
INSERT INTO `cow_linkage` VALUES('109','太谷县','59','1','0');
INSERT INTO `cow_linkage` VALUES('110','祁 县','59','1','0');
INSERT INTO `cow_linkage` VALUES('111','平遥县','59','1','0');
INSERT INTO `cow_linkage` VALUES('112','灵石县','59','1','0');
INSERT INTO `cow_linkage` VALUES('113','离石区','58','1','0');
INSERT INTO `cow_linkage` VALUES('114','孝义市','58','1','0');
INSERT INTO `cow_linkage` VALUES('115','汾阳市','58','1','0');
INSERT INTO `cow_linkage` VALUES('116','文水县','58','1','0');
INSERT INTO `cow_linkage` VALUES('117','中阳县','58','1','0');
INSERT INTO `cow_linkage` VALUES('118','兴　县','58','1','0');
INSERT INTO `cow_linkage` VALUES('119','临　县','58','1','0');
INSERT INTO `cow_linkage` VALUES('120','方山县','58','1','0');
INSERT INTO `cow_linkage` VALUES('121','柳林县','58','1','0');
INSERT INTO `cow_linkage` VALUES('122','岚　县','58','1','0');
INSERT INTO `cow_linkage` VALUES('123','交口县','58','1','0');
INSERT INTO `cow_linkage` VALUES('124','交城县','58','1','0');
INSERT INTO `cow_linkage` VALUES('125','石楼县','58','1','0');
INSERT INTO `cow_linkage` VALUES('126','忻府区','57','1','0');
INSERT INTO `cow_linkage` VALUES('127','原平市','57','1','0');
INSERT INTO `cow_linkage` VALUES('128','定襄县','57','1','0');
INSERT INTO `cow_linkage` VALUES('129','五台县','57','1','0');
INSERT INTO `cow_linkage` VALUES('130','代 县','57','1','0');
INSERT INTO `cow_linkage` VALUES('131','繁峙县','57','1','0');
INSERT INTO `cow_linkage` VALUES('132','宁武县','57','1','0');
INSERT INTO `cow_linkage` VALUES('133','静乐县','57','1','0');
INSERT INTO `cow_linkage` VALUES('134','神池县','57','1','0');
INSERT INTO `cow_linkage` VALUES('135','五寨县','57','1','0');
INSERT INTO `cow_linkage` VALUES('136','岢岚县','57','1','0');
INSERT INTO `cow_linkage` VALUES('137','河曲县','57','1','0');
INSERT INTO `cow_linkage` VALUES('138','保德县','57','1','0');
INSERT INTO `cow_linkage` VALUES('139','偏关县','57','1','0');
INSERT INTO `cow_linkage` VALUES('140','城区','56','1','0');
INSERT INTO `cow_linkage` VALUES('141','郊区','56','1','0');
INSERT INTO `cow_linkage` VALUES('142','潞城市','56','1','0');
INSERT INTO `cow_linkage` VALUES('143','长治县','56','1','0');
INSERT INTO `cow_linkage` VALUES('144','襄垣县','56','1','0');
INSERT INTO `cow_linkage` VALUES('145','屯留县','56','1','0');
INSERT INTO `cow_linkage` VALUES('146','平顺县','56','1','0');
INSERT INTO `cow_linkage` VALUES('147','黎城县','56','1','0');
INSERT INTO `cow_linkage` VALUES('148','壶关县','56','1','0');
INSERT INTO `cow_linkage` VALUES('149','长子县','56','1','0');
INSERT INTO `cow_linkage` VALUES('150','武乡县','56','1','0');
INSERT INTO `cow_linkage` VALUES('151','沁县','56','1','0');
INSERT INTO `cow_linkage` VALUES('152','沁源县','56','1','0');
INSERT INTO `cow_linkage` VALUES('153','城　区','55','1','0');
INSERT INTO `cow_linkage` VALUES('154','矿　区','55','1','0');
INSERT INTO `cow_linkage` VALUES('155','郊　区','55','1','0');
INSERT INTO `cow_linkage` VALUES('156','平定县','55','1','0');
INSERT INTO `cow_linkage` VALUES('157','盂　县','55','1','0');
INSERT INTO `cow_linkage` VALUES('158','朔城区','54','1','0');
INSERT INTO `cow_linkage` VALUES('159','平鲁区','54','1','0');
INSERT INTO `cow_linkage` VALUES('160','山阴县','54','1','0');
INSERT INTO `cow_linkage` VALUES('161','应县','54','1','0');
INSERT INTO `cow_linkage` VALUES('162','右玉县','54','1','0');
INSERT INTO `cow_linkage` VALUES('163','怀仁县','54','1','0');
INSERT INTO `cow_linkage` VALUES('164','大同县','53','1','0');
INSERT INTO `cow_linkage` VALUES('165','阳高县','53','1','0');
INSERT INTO `cow_linkage` VALUES('166','左云县','53','1','0');
INSERT INTO `cow_linkage` VALUES('167','浑源县','53','1','0');
INSERT INTO `cow_linkage` VALUES('168','天镇县','53','1','0');
INSERT INTO `cow_linkage` VALUES('169','灵丘县','53','1','0');
INSERT INTO `cow_linkage` VALUES('170','广灵县','53','1','0');
INSERT INTO `cow_linkage` VALUES('171','新荣区','53','1','0');
INSERT INTO `cow_linkage` VALUES('172','矿区','53','1','0');
INSERT INTO `cow_linkage` VALUES('173','南郊区','53','1','0');
INSERT INTO `cow_linkage` VALUES('174','城区','53','1','0');
INSERT INTO `cow_linkage` VALUES('175','渝中区','20','1','0');
INSERT INTO `cow_linkage` VALUES('176','大渡口区','20','1','0');
INSERT INTO `cow_linkage` VALUES('177','江北区','20','1','0');
INSERT INTO `cow_linkage` VALUES('178','沙坪坝区','20','1','0');
INSERT INTO `cow_linkage` VALUES('179','九龙坡区','20','1','0');
INSERT INTO `cow_linkage` VALUES('180','南岸区','20','1','0');
INSERT INTO `cow_linkage` VALUES('181','北碚区','20','1','0');
INSERT INTO `cow_linkage` VALUES('182','万盛区','20','1','0');
INSERT INTO `cow_linkage` VALUES('183','双桥区','20','1','0');
INSERT INTO `cow_linkage` VALUES('184','渝北区','20','1','0');
INSERT INTO `cow_linkage` VALUES('185','巴南区','20','1','0');
INSERT INTO `cow_linkage` VALUES('186','万州区','20','1','0');
INSERT INTO `cow_linkage` VALUES('187','涪陵区','20','1','0');
INSERT INTO `cow_linkage` VALUES('188','黔江区','20','1','0');
INSERT INTO `cow_linkage` VALUES('189','长寿区','20','1','0');
INSERT INTO `cow_linkage` VALUES('190','江津区','20','1','0');
INSERT INTO `cow_linkage` VALUES('191','合川区','20','1','0');
INSERT INTO `cow_linkage` VALUES('192','永川区','20','1','0');
INSERT INTO `cow_linkage` VALUES('193','南川区','20','1','0');
INSERT INTO `cow_linkage` VALUES('194','綦江县','20','1','0');
INSERT INTO `cow_linkage` VALUES('195','潼南县','20','1','0');
INSERT INTO `cow_linkage` VALUES('196','铜梁县','20','1','0');
INSERT INTO `cow_linkage` VALUES('197','大足县','20','1','0');
INSERT INTO `cow_linkage` VALUES('198','荣昌县','20','1','0');
INSERT INTO `cow_linkage` VALUES('199','璧山县','20','1','0');
INSERT INTO `cow_linkage` VALUES('200','垫江县','20','1','0');
INSERT INTO `cow_linkage` VALUES('201','武隆县','20','1','0');
INSERT INTO `cow_linkage` VALUES('202','丰都县','20','1','0');
INSERT INTO `cow_linkage` VALUES('203','城口县','20','1','0');
INSERT INTO `cow_linkage` VALUES('204','梁平县','20','1','0');
INSERT INTO `cow_linkage` VALUES('205','开县','20','1','0');
INSERT INTO `cow_linkage` VALUES('206','巫溪县','20','1','0');
INSERT INTO `cow_linkage` VALUES('207','巫山县','20','1','0');
INSERT INTO `cow_linkage` VALUES('208','奉节县','20','1','0');
INSERT INTO `cow_linkage` VALUES('209','云阳县','20','1','0');
INSERT INTO `cow_linkage` VALUES('210','忠县','20','1','0');
INSERT INTO `cow_linkage` VALUES('211','石柱土家族自治县','20','1','0');
INSERT INTO `cow_linkage` VALUES('212','彭水苗族土家族自治县','20','1','0');
INSERT INTO `cow_linkage` VALUES('213','酉阳土家族苗族自治县','20','1','0');
INSERT INTO `cow_linkage` VALUES('214','秀山土家族苗族自治县','20','1','0');
INSERT INTO `cow_linkage` VALUES('215','和平区','18','1','0');
INSERT INTO `cow_linkage` VALUES('216','河西区','18','1','0');
INSERT INTO `cow_linkage` VALUES('217','河东区','18','1','0');
INSERT INTO `cow_linkage` VALUES('218','红桥区','18','1','0');
INSERT INTO `cow_linkage` VALUES('219','南开区','18','1','0');
INSERT INTO `cow_linkage` VALUES('220','河北区','18','1','0');
INSERT INTO `cow_linkage` VALUES('221','西青区','18','1','0');
INSERT INTO `cow_linkage` VALUES('222','津南区','18','1','0');
INSERT INTO `cow_linkage` VALUES('223','北辰区','18','1','0');
INSERT INTO `cow_linkage` VALUES('224','东丽区','18','1','0');
INSERT INTO `cow_linkage` VALUES('225','汉沽县','18','1','0');
INSERT INTO `cow_linkage` VALUES('226','宝坻县','18','1','0');
INSERT INTO `cow_linkage` VALUES('227','静海县','18','1','0');
INSERT INTO `cow_linkage` VALUES('228','宁河县','18','1','0');
INSERT INTO `cow_linkage` VALUES('229','武清县','18','1','0');
INSERT INTO `cow_linkage` VALUES('230','黄浦区','19','1','0');
INSERT INTO `cow_linkage` VALUES('231','卢湾区','19','1','0');
INSERT INTO `cow_linkage` VALUES('232','徐汇区','19','1','0');
INSERT INTO `cow_linkage` VALUES('233','长宁区','19','1','0');
INSERT INTO `cow_linkage` VALUES('234','静安区','19','1','0');
INSERT INTO `cow_linkage` VALUES('235','普陀区','19','1','0');
INSERT INTO `cow_linkage` VALUES('236','闸北区','19','1','0');
INSERT INTO `cow_linkage` VALUES('237','虹口区','19','1','0');
INSERT INTO `cow_linkage` VALUES('238','杨浦区','19','1','0');
INSERT INTO `cow_linkage` VALUES('239','宝山区','19','1','0');
INSERT INTO `cow_linkage` VALUES('240','闵行区','19','1','0');
INSERT INTO `cow_linkage` VALUES('241','嘉定区','19','1','0');
INSERT INTO `cow_linkage` VALUES('242','浦东新区','19','1','0');
INSERT INTO `cow_linkage` VALUES('243','松江区','19','1','0');
INSERT INTO `cow_linkage` VALUES('244','金山区','19','1','0');
INSERT INTO `cow_linkage` VALUES('245','青浦区','19','1','0');
INSERT INTO `cow_linkage` VALUES('246','南汇区','19','1','0');
INSERT INTO `cow_linkage` VALUES('247','奉贤区','19','1','0');
INSERT INTO `cow_linkage` VALUES('248','崇明县','19','1','0');
INSERT INTO `cow_linkage` VALUES('249','东城区','17','1','0');
INSERT INTO `cow_linkage` VALUES('250','西城区','17','1','0');
INSERT INTO `cow_linkage` VALUES('251','崇文区','17','1','0');
INSERT INTO `cow_linkage` VALUES('252','宣武区','17','1','0');
INSERT INTO `cow_linkage` VALUES('253','朝阳区','17','1','0');
INSERT INTO `cow_linkage` VALUES('254','海淀区','17','1','0');
INSERT INTO `cow_linkage` VALUES('255','丰台区','17','1','0');
INSERT INTO `cow_linkage` VALUES('256','石景山区','17','1','0');
INSERT INTO `cow_linkage` VALUES('257','通州区','17','1','0');
INSERT INTO `cow_linkage` VALUES('258','平谷区','17','1','0');
INSERT INTO `cow_linkage` VALUES('259','顺义区','17','1','0');
INSERT INTO `cow_linkage` VALUES('260','怀柔区','17','1','0');
INSERT INTO `cow_linkage` VALUES('261','昌平区','17','1','0');
INSERT INTO `cow_linkage` VALUES('262','门头沟区','17','1','0');
INSERT INTO `cow_linkage` VALUES('263','房山区','17','1','0');
INSERT INTO `cow_linkage` VALUES('264','大兴区','17','1','0');
INSERT INTO `cow_linkage` VALUES('265','密云县','17','1','0');
INSERT INTO `cow_linkage` VALUES('266','延庆县','17','1','0');
INSERT INTO `cow_linkage` VALUES('299','湾仔区','50','1','0');
INSERT INTO `cow_linkage` VALUES('298','屯门区','50','1','0');
INSERT INTO `cow_linkage` VALUES('297','深水埗区','50','1','0');
INSERT INTO `cow_linkage` VALUES('296','沙田区','50','1','0');
INSERT INTO `cow_linkage` VALUES('295','荃湾区','50','1','0');
INSERT INTO `cow_linkage` VALUES('294','南区','50','1','0');
INSERT INTO `cow_linkage` VALUES('293','离岛区','50','1','0');
INSERT INTO `cow_linkage` VALUES('292','葵青区','50','1','0');
INSERT INTO `cow_linkage` VALUES('291','九龙城区','50','1','0');
INSERT INTO `cow_linkage` VALUES('290','黄大仙区','50','1','0');
INSERT INTO `cow_linkage` VALUES('289','观塘区','50','1','0');
INSERT INTO `cow_linkage` VALUES('288','东区','50','1','0');
INSERT INTO `cow_linkage` VALUES('287','大埔区','50','1','0');
INSERT INTO `cow_linkage` VALUES('286','北区','50','1','0');
INSERT INTO `cow_linkage` VALUES('285','澳门特别行政区','1','1','0');
INSERT INTO `cow_linkage` VALUES('300','西贡区','50','1','0');
INSERT INTO `cow_linkage` VALUES('301','油尖旺区','50','1','0');
INSERT INTO `cow_linkage` VALUES('302','元朗区','50','1','0');
INSERT INTO `cow_linkage` VALUES('303','中西区','50','1','0');
INSERT INTO `cow_linkage` VALUES('304','澳门半岛区','285','1','0');
INSERT INTO `cow_linkage` VALUES('305','花地玛堂区','285','1','0');
INSERT INTO `cow_linkage` VALUES('306','圣安多尼堂区','285','1','0');
INSERT INTO `cow_linkage` VALUES('307','大堂区','285','1','0');
INSERT INTO `cow_linkage` VALUES('308','望德堂区','285','1','0');
INSERT INTO `cow_linkage` VALUES('309','风顺堂区','285','1','0');
INSERT INTO `cow_linkage` VALUES('310','澳门离岛区','285','1','0');
INSERT INTO `cow_linkage` VALUES('311','代理1','63','1','0');
INSERT INTO `cow_linkage` VALUES('312','代理2','63','1','0');
INSERT INTO `cow_linkage` VALUES('313','长风东街','65','1','0');
INSERT INTO `cow_linkage` VALUES('314','万科紫台','313','1','0');
INSERT INTO `cow_linkage` VALUES('315','龙城大街南，滨河东路东，坞城路西，康宁街北','65','1','0');
INSERT INTO `cow_linkage` VALUES('316','','315','1','0');
--
-- 表的结构cow_mahjong_flower
--

DROP TABLE IF EXISTS `cow_mahjong_flower`;
CREATE TABLE `cow_mahjong_flower` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_mahjong_flower
--

INSERT INTO `cow_mahjong_flower` VALUES('3','最新活动','211','0','','<p><img alt=\"\" src=\"http://demo.cowcms.com/upload/admin/1/1503651500_815256650.png\" style=\"height:350px; width:780px\" /></p>\r\n','1501750949','0','1','admin','0.00','99');
INSERT INTO `cow_mahjong_flower` VALUES('4','明花介绍','211','0','','<p><img alt=\"\" src=\"http://demo.cowcms.com//upload/admin/1/1503372872_32664138.png\" style=\"height:2200px; width:780px\" /></p>\r\n','1501750995','0','1','admin','0.00','99');
INSERT INTO `cow_mahjong_flower` VALUES('5','游戏声明','212','0','','<p><img alt=\"\" src=\"http://demo.cowcms.com/upload/admin/1/1503971289_1692638101.png\" style=\"height:1242px; width:780px\" /></p>\r\n','1501751003','0','1','admin','0.00','99');
INSERT INTO `cow_mahjong_flower` VALUES('6','房卡支付','212','0','','<p><img alt=\"\" src=\"http://demo.cowcms.com/upload/admin/1/1503643987_1748956656.png\" style=\"height:720px; width:780px\" /><br />\r\n<br />\r\n&nbsp;</p>\r\n','1501751035','0','1','admin','0.00','99');
--
-- 表的结构cow_menu
--

DROP TABLE IF EXISTS `cow_menu`;
CREATE TABLE `cow_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序数值',
  `url` varchar(255) DEFAULT NULL COMMENT '菜单链接',
  `url_m` varchar(50) DEFAULT NULL COMMENT '站内链接模块名',
  `url_c` varchar(50) DEFAULT NULL COMMENT '站内链接控制器',
  `url_a` varchar(50) DEFAULT NULL COMMENT '站内链接操作名',
  `url_p` varchar(255) DEFAULT NULL COMMENT '链接的其他参数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '菜单开关',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '模型ID',
  `type` varchar(50) DEFAULT NULL COMMENT '菜单类型 admin为后台菜单，user为会员中心菜单',
  `ico` varchar(255) DEFAULT NULL COMMENT '菜单图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=862 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_menu
--

INSERT INTO `cow_menu` VALUES('1','设置','0','0','','','','','','1','0','','admin','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('2','插件','0','1','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('3','内容','0','2','','Content','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('4','会员','0','3','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('5','资金','0','5','','Accounts','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('6','相关','0','6','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('7','功能','6','0','','Admin','Plug','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('8','菜单设置','1','1','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('9','后台菜单','8','10','','admin','menu','menu_list','type=admin','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('10','管理员','1','2','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('11','管理列表','10','3','','Admin','Admin','admin_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('12','基本设置','1','0','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('13','基本设置','12','0','','Admin','Setting','Setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('15','会员管理','4','0','','Admin','Menu','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('16','会员列表','15','0','','Admin','User','user_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('17','网站设置','12','0','','Admin','Site','Site_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('18','会员组','15','0','','Admin','User','User_group_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('19','角色管理','10','2','','Admin','Admin','Admin_Role_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('22','会员字段','15','0','','Field','Field','field_list','modelid=2','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('23','分销','0','4','','Fenxiao','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('24','参数设置','23','0','','Fenxiao','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('25','基本设置','24','0','','Fenxiao','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('30','资金流水','5','0','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('31','流水列表','30','0','','Accounts','index','Accounts_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('32','提现列表','5','0','','Accounts','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('33','查看列表','32','0','','Accounts','index','withdraw_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('34','增减资金','30','0','','Accounts','index','accounts_alter','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('35','清理数据','30','0','','Accounts','index','accounts_del','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('40','内容模型','3','0','','sys_model','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('41','模型列表','40','0','','sys_model','Index','model_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('65','订单','0','7','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('66','订单管理','65','0','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('67','订单列表','66','0','','Order','Admin','order_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('93','会员中心','8','0','','Admin','Menu','Menu_list','type=user','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('97','个人账户','0','0','','User','index','user_info','','1','0','','user','icon-folder-close');
INSERT INTO `cow_menu` VALUES('99','个人审核','0','2','','User','index','auth','','1','0','','user','icon-ok');
INSERT INTO `cow_menu` VALUES('102','手机绑定','0','7','','User','index','bundling_info','type=mobile','1','0','','user','icon-random');
INSERT INTO `cow_menu` VALUES('103','修改密码','0','6','','User','index','alter_password','','1','0','','user','icon-magic');
INSERT INTO `cow_menu` VALUES('104','银行卡绑定','0','8','','User','index','bundling_info','type=bank','1','0','','user','icon-money');
INSERT INTO `cow_menu` VALUES('105','推荐会员','0','5','','User','index','team_list','','1','0','','user','icon-user');
INSERT INTO `cow_menu` VALUES('146','核销兑换码','66','3','','Order','Admin','verification_key_admin','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('147','卖家中心','8','3','','Admin','Menu','Menu_list','type=sell','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('151','订单管理','0','3','','','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('163','资金设置','5','0','','Accounts','Setting','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('164','基本配置','163','0','','Accounts','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('165','支付配置','163','1','','Accounts','Setting','pay_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('166','首页菜单','8','4','','Admin','Menu','Menu_list','type=index_show','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('168','个人中心','0','1','','User','index','index','','1','0','','index_show','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('187','首页轮播图','183','6','','Home','index','carousel_pic','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('188','权限分类','10','0','','Admin','Auth','auth_class_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('189','权限规则','10','1','','Admin','Auth','auth_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('215','会员代理','15','0','','User','Agentadmin','agent_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('217','代理设置','15','0','','User','Agentadmin','setting_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('218','实名认证','0','9','','User','index','bundling_info','type=real','1','0','','user','icon-ok-circle');
INSERT INTO `cow_menu` VALUES('220','现金管理','0','11','','User','index','money','model_id=43','1','0','','user','icon-yen');
INSERT INTO `cow_menu` VALUES('222','首页轮播图','12','4','','Home','index','carousel_pic','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('227','虚拟产品','210','0','','Admin','Menu','Menu_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('261','收货地址','66','9','','Order','Admin','shipaddress_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('278','站内公告系统','3','2','','Article','','','','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('279','字段管理','278','0','','Field','Field','field_list','modelid=43','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('280','站内公告分类','278','1','','Sys_model','Class','class_list','modelid=43','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('281','内容管理','278','2','','Article','Article','article_list','modelid=43','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('282','清理订单','66','4','','Order','Admin','clear_order','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('320','手机会员菜单','8','6','','Admin','Menu','Menu_list','type=mobile','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('321','商城首页','0','0','','Mobile','index','index','','0','0','','mobile','glyphicon glyphicon-home');
INSERT INTO `cow_menu` VALUES('322','我的订单','0','1','','mobile','order','order_list','','1','0','','mobile','glyphicon glyphicon-list-alt');
INSERT INTO `cow_menu` VALUES('323','我的资料','0','2','','Mobile','User','alter_infomation','','1','0','','mobile','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('324','提现申请','0','3','','Mobile','User','withdraw_list','','1','0','','mobile','glyphicon glyphicon-gift');
INSERT INTO `cow_menu` VALUES('325','分销中心','0','4','','Mobile','User','team_list','','0','0','','mobile','glyphicon glyphicon-sort-by-attributes-alt');
INSERT INTO `cow_menu` VALUES('326','购物车','0','7','','mobile','order','my_cart','','0','0','','mobile','glyphicon glyphicon-shopping-cart');
INSERT INTO `cow_menu` VALUES('328','站内公告','0','6','','mobile','Article','index_list','model_id=43','0','0','','mobile','glyphicon glyphicon-calendar');
INSERT INTO `cow_menu` VALUES('329','资金管理','0','5','','Mobile','Accounts','index_list','','1','0','','mobile','glyphicon glyphicon-yen');
INSERT INTO `cow_menu` VALUES('330','手机首页菜单','8','9','','Admin','Menu','Menu_list','type=mobile_index','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('331','全部分类','0','0','','Mobile','index','cate_all','','1','0','','mobile_index','glyphicon glyphicon-th');
INSERT INTO `cow_menu` VALUES('332','个人中心','0','1','','Mobile','user','index','','1','0','','mobile_index','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('334','联系我们','0','3','','Article','index','index_show','model_id=54&id=3','1','0','','mobile_index','glyphicon glyphicon-phone');
INSERT INTO `cow_menu` VALUES('342','查看兑换信息','66','8','','Order','Admin','order_conversion_key','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('343','会员设置','15','0','','User','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('344','辛勤劳动','0','0','','Mobile','User','work','','1','0','','mobile','glyphicon glyphicon-list-alt');
INSERT INTO `cow_menu` VALUES('345','详细信息','0','10','','Mobile','User','user_info','','1','0','','mobile','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('346','绑定手机','0','11','','Mobile','User','bundling_info','type=mobile','1','0','','mobile','glyphicon glyphicon-hand-up');
INSERT INTO `cow_menu` VALUES('347','实名认证','0','12','','Mobile','User','bundling_info','type=real','1','0','','mobile','glyphicon glyphicon-ok');
INSERT INTO `cow_menu` VALUES('348','绑定银行卡','0','13','','Mobile','User','bundling_info','type=bank','1','0','','mobile','glyphicon glyphicon-check');
INSERT INTO `cow_menu` VALUES('353','商城公告','0','0','http://www.zgdalesong.com/index.php/Article/Index/index_show/model_id/54/id/4.php','','','','','0','0','','index_show','');
INSERT INTO `cow_menu` VALUES('354','审核列表','0','14','','Mobile','User','auth','','1','0','','mobile','glyphicon glyphicon-random');
INSERT INTO `cow_menu` VALUES('355','我的支付','0','0','','Accounts','pay','ceshi','','1','0','','mobile_index','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('361','修改密码','0','15','','Mobile','User','alter_password','','1','0','','mobile','glyphicon glyphicon-lock');
INSERT INTO `cow_menu` VALUES('362','评论','0','11','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('388','直播新闻系统系统','3','2','','Article','','','','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('389','字段管理','388','0','','Field','Field','field_list','modelid=57','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('390','直播新闻系统分类','388','1','','Sys_model','Class','class_list','modelid=57','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('391','内容管理','388','2','','Article','Article','article_list','modelid=57','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('395','插件管理','2','0','','Admin','Install','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('396','插件安装','395','0','','Admin','Install','install_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('625','联动菜单','7','3','','Linkage','Admin','linkage_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('646','商家管理','4','2','','Shop','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('647','店铺分类','646','0','','Shop','Admin','shop_category_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('648','店铺管理','646','1','','Shop','Admin','shop_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('649','出售产品','0','0','','Shop','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('650','出售产品','649','0','','Shop','Consume\"','index','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('651','店铺管理','0','1','','Shop','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('652','修改店铺','651','1','','Shop','Sell\"','alter_shop_info','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('653','店铺模板','651','0','','Shop','Sell\"','select_color','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('654','订单管理','0','2','','Shop','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('655','我的订单','654','0','','Shop','Sell\"','order_list','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('697','直播','0','8','','Chat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('698','直播设置','697','8','','Chat','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('699','基本设置','698','0','','Chat','Setting','website_settings','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('700','账户配置','698','1','','Chat','Setting','Setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('701','直播管理','697','8','','Chat','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('702','表情管理','701','0','','Chat','Admin','face_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('703','礼物管理','701','1','','Chat','Admin','gift_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('704','房间分类','701','2','','Chat','Admin','menu_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('705','房间管理','701','3','','Chat','Admin','chat_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('706','直播管理','0','9','','Chat','User','direct_live','','1','0','','user','icon-facetime-video');
INSERT INTO `cow_menu` VALUES('728','商城系统','3','2','','Goods','','','','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('729','字段管理','728','0','','Field','Field','field_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('730','商城分类','728','1','','Sys_model','Class','class_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('731','内容管理','728','2','','Goods','Goods','goods_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('732','库存管理','728','3','','Goods','Goods','all_inventory_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('741','团购系统','3','2','','Article','','','','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('742','字段管理','741','0','','Field','Field','field_list','modelid=69','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('743','团购分类','741','1','','Sys_model','Class','class_list','modelid=69','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('744','内容管理','741','2','','Article','Article','article_list','modelid=69','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('745','直播','0','0','','Chat','Index','Index','','1','0','','index_show','');
INSERT INTO `cow_menu` VALUES('746','红包管理','7','4','','Packets','Admin','packets_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('747','活动红包','0','4','','Packets','user','packets_list','','1','0','','user','icon-briefcase');
INSERT INTO `cow_menu` VALUES('756','采集器','6','4','','Collector','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('757','采集项目','756','0','','Collector','Project','project_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('758','配置项目','756','1','','Collector','Setting','project_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('759','广告','7','0','','Advert','Admin','advert_type_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('802','微信','0','9','','Wechat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('803','微信设置','802','8','','Wechat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('804','基本设置','803','0','','Wechat','Setting','base_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('805','菜单设置','803','1','','Wechat','Setting','menu_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('806','会员设置','803','2','','Wechat','Setting','user_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('807','关键字','802','8','','Wechat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('808','关键字分类','807','0','','Sys_model','Class','class_list','modelid=70','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('809','关键字管理','807','1','','Article','Article','article_list','modelid=70','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('810','站内短信','6','4','','Message','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('811','短信管理','810','0','','Message','Admin','message_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('812','短信设置','810','1','','Message','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('838','游戏','0','9','','Games','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('839','游戏管理','838','0','','Games','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('840','游戏设置','839','0','','Games','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('841','游戏列表','839','1','','Games','Admin','games_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('842','游戏分类','839','2','','Games','Class','class_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('843','游戏公告系统','3','2','','Article','','','','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('844','字段管理','843','0','','Field','Field','field_list','modelid=70','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('845','游戏公告分类','843','1','','Sys_model','Class','class_list','modelid=70','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('846','内容管理','843','2','','Article','Article','article_list','modelid=70','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('847','明花麻将系统','3','2','','Article','','','','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('848','字段管理','847','0','','Field','Field','field_list','modelid=71','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('849','明花麻将分类','847','1','','Sys_model','Class','class_list','modelid=71','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('850','内容管理','847','2','','Article','Article','article_list','modelid=71','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('851','单一信息系统','3','2','','Article','','','','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('852','字段管理','851','0','','Field','Field','field_list','modelid=72','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('853','单一信息分类','851','1','','Sys_model','Class','class_list','modelid=72','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('854','内容管理','851','2','','Article','Article','article_list','modelid=72','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('855','物流管理','65','1','','','','','','1','0','','admin','icon-barcode');
INSERT INTO `cow_menu` VALUES('856','快递公司','855','0','','Express','Admin','express_company','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('857','物流接口','855','0','','Express','Ammin','api_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('858','数据库','0','8','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('859','备份还原','858','0','','Db','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('860','备份数据库','859','0','','Db','Databases','export','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('861','还原数据库','859','1','','Db','Databases','import','','1','0','','admin','');
--
-- 表的结构cow_message
--

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

--
-- 转存表中的数据 cow_message
--

--
-- 表的结构cow_model
--

DROP TABLE IF EXISTS `cow_model`;
CREATE TABLE `cow_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型id',
  `table` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT '模型的名称',
  `setting` text COMMENT '模型的设置信息',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `type` varchar(50) DEFAULT NULL COMMENT '模型类型 ',
  `model_class` varchar(50) DEFAULT NULL COMMENT '系统模型类bie content:内容模型，form:表单模型',
  `sign` varchar(50) DEFAULT NULL COMMENT '模型唯一标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_model
--

INSERT INTO `cow_model` VALUES('2','user','会员','','0','','user','');
INSERT INTO `cow_model` VALUES('43','notice','站内公告','','0','Article','content','notice');
INSERT INTO `cow_model` VALUES('57','chat_article','直播新闻系统','','0','Article','content','chat_article');
INSERT INTO `cow_model` VALUES('60','ceshi','ceshi','array (\n  \\\'open\\\' => \\\'1\\\',\n  \\\'start_time\\\' => 1479362820,\n  \\\'end_time\\\' => 1482905220,\n  \\\'id\\\' => \\\'60\\\',\n)','0','','form','');
INSERT INTO `cow_model` VALUES('66','goods','商城','','0','Goods','content','goods');
INSERT INTO `cow_model` VALUES('69','good_buy','团购','','0','Article','content','good_buy');
INSERT INTO `cow_model` VALUES('70','games_notice','游戏公告','','0','Article','content','games_notice');
INSERT INTO `cow_model` VALUES('71','mahjong_flower','明花麻将','','0','Article','content','mahjong_flower');
INSERT INTO `cow_model` VALUES('72','single_information','单一信息','','0','Article','content','single_information');
--
-- 表的结构cow_notice
--

DROP TABLE IF EXISTS `cow_notice`;
CREATE TABLE `cow_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_notice
--

--
-- 表的结构cow_order
--

DROP TABLE IF EXISTS `cow_order`;
CREATE TABLE `cow_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `addtime` int(11) DEFAULT '0' COMMENT '添加时间',
  `order_amount` float DEFAULT NULL COMMENT '订单金额',
  `goods_amount` float DEFAULT NULL COMMENT '商品总价',
  `discount` float DEFAULT NULL COMMENT '折扣',
  `order_status` int(11) DEFAULT '0' COMMENT '订单状态',
  `pay_status` int(11) DEFAULT '0' COMMENT '支付状态',
  `ship_status` int(11) DEFAULT '0' COMMENT '配送状态',
  `pay_time` int(11) DEFAULT '0' COMMENT '支付时间',
  `finish_time` int(11) DEFAULT '0' COMMENT '完成时间',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员',
  `consignee_id` int(11) DEFAULT '0' COMMENT '收货地址id',
  `remark` varchar(1000) DEFAULT NULL COMMENT '备注',
  `ship_time` int(11) DEFAULT '0' COMMENT '发货时间',
  `shop_id` int(11) DEFAULT '0' COMMENT '店铺id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `pay_type` varchar(30) DEFAULT NULL,
  `is_expense` int(11) DEFAULT '0' COMMENT '是否报销',
  `order_come` int(11) DEFAULT '0' COMMENT '订单来源',
  `coin_type` varchar(30) DEFAULT 'money' COMMENT '币种',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_order
--

INSERT INTO `cow_order` VALUES('1','f46111487228507_','1487228507','10','10','1','0','0','0','0','0','','','','0','0','1','','0','1','');
INSERT INTO `cow_order` VALUES('2','8b3d91487228985_','1487228985','2','2','1','0','0','0','0','0','','','','0','0','1','','0','1','');
INSERT INTO `cow_order` VALUES('3','0d3701487229057_','1487229057','2','2','1','0','0','0','0','0','','','','0','0','1','','0','1','');
--
-- 表的结构cow_order_conversion_key
--

DROP TABLE IF EXISTS `cow_order_conversion_key`;
CREATE TABLE `cow_order_conversion_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_id` int(11) DEFAULT '0' COMMENT '订单详情ID',
  `conversion_key` varchar(255) DEFAULT NULL COMMENT '兑换码',
  `valid_time` int(11) DEFAULT '0' COMMENT '到期时间',
  `usering` int(11) DEFAULT '0' COMMENT '是否使用',
  `oprater_shop_shop` int(11) DEFAULT '0' COMMENT '销码店铺 0为本店铺销码 其他为别的店铺销码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_order_conversion_key
--

--
-- 表的结构cow_order_info
--

DROP TABLE IF EXISTS `cow_order_info`;
CREATE TABLE `cow_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `amount` float DEFAULT NULL COMMENT '商品金额',
  `order_num` int(11) DEFAULT '1' COMMENT '商品数量',
  `order_pro` varchar(255) DEFAULT '' COMMENT '商品属性',
  `model_id` int(11) DEFAULT NULL COMMENT '模型ID',
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  `other` varchar(255) DEFAULT NULL COMMENT '杂项',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_order_info
--

INSERT INTO `cow_order_info` VALUES('1','f46111487228507_','3','10','10','','66','0','');
INSERT INTO `cow_order_info` VALUES('2','8b3d91487228985_','3','2','2','','66','0','');
INSERT INTO `cow_order_info` VALUES('3','0d3701487229057_','3','2','2','','66','0','');
--
-- 表的结构cow_packets
--

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

--
-- 转存表中的数据 cow_packets
--

--
-- 表的结构cow_role
--

DROP TABLE IF EXISTS `cow_role`;
CREATE TABLE `cow_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `name` varchar(50) DEFAULT NULL COMMENT '角色名称',
  `setting` text COMMENT '角色几把设置参数',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '角色状态',
  `is_login` tinyint(2) unsigned DEFAULT '0' COMMENT '是否允许登陆1允许0不允许',
  `sort_num` smallint(5) DEFAULT '0' COMMENT '会员组排序，数字越小越在前边',
  `auth` text COMMENT '角色权限设置',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `is_del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_role
--

INSERT INTO `cow_role` VALUES('1','超级管理','','1','1','0','','0','1');
INSERT INTO `cow_role` VALUES('9','网站管理员','','1','1','0','','0','0');
INSERT INTO `cow_role` VALUES('10','网站编辑','','1','1','0','24,32,28,36,100,35,31,56,146,69','0','0');
INSERT INTO `cow_role` VALUES('11','市级代理','','1','1','0','275,276,277,279,278','0','0');
INSERT INTO `cow_role` VALUES('12','财务','','1','1','0','392,67,66,65,64,63,62','0','0');
INSERT INTO `cow_role` VALUES('13','上传图片','','1','1','0','366,367,368,370,369','0','0');
--
-- 表的结构cow_ship_address
--

DROP TABLE IF EXISTS `cow_ship_address`;
CREATE TABLE `cow_ship_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_ship_address
--

--
-- 表的结构cow_shop
--

DROP TABLE IF EXISTS `cow_shop`;
CREATE TABLE `cow_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) DEFAULT NULL COMMENT '属所用户',
  `name` varchar(255) DEFAULT NULL COMMENT '铺店名称',
  `description` varchar(255) DEFAULT NULL COMMENT '铺店介绍',
  `logo` varchar(255) DEFAULT NULL COMMENT '招店',
  `style` varchar(255) DEFAULT NULL COMMENT '铺店风格',
  `is_open` int(11) DEFAULT '1' COMMENT '是否开启',
  `category_id` int(11) DEFAULT NULL COMMENT '分类id',
  `addtimes` int(11) DEFAULT NULL COMMENT '店铺创建时间',
  `area_id` int(11) DEFAULT '0' COMMENT '地区',
  `x` varchar(255) DEFAULT '112.553216' COMMENT '坐标x',
  `y` varchar(255) DEFAULT '37.851719' COMMENT '标坐Y',
  `address` varchar(1000) DEFAULT NULL COMMENT '详细地址',
  `mobile` varchar(15) DEFAULT NULL COMMENT '联系电话',
  `proportion` int(11) DEFAULT NULL COMMENT '每件商品的分成比例',
  `attention` varchar(255) DEFAULT NULL COMMENT '联系人',
  `close_reason` varchar(1000) DEFAULT NULL COMMENT '闭店原因',
  `is_air` int(1) DEFAULT '0' COMMENT '是否虚拟实体商 0实体 1虚拟',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_shop
--

INSERT INTO `cow_shop` VALUES('17','1','生鲜水果1','时令鲜果，低价直达  ','/upload/admin/1/1466046868_1634678226.jpg','style6','0','22','1466154185','','112.555703','37.778487','平阳路','','3','','今天休息','0');
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
INSERT INTO `cow_table_field` VALUES('2','recommend','推荐人ID','0','user','请输入推荐人ID','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'data1\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$_GET[recommend]]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','9','','','-1','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"form-group\">\r\n<label class=\"col-sm-2 control-label\" for=\"formGroupInputSmall\"><span class=\"glyphicon glyphicon-pencil\"></span> [title]</label>\r\n   <div class=\"col-sm-10\">\r\n   <input name=\"[field]\" type=\"text\" class=\"form-control\"  id=\"[field]\" value=\"[default_]\"  [property] placeholder=\"请输入确认密码\">\r\n   <div id=\"[title]Tip\" class=\"alert\"></div>\r\n   </div>\r\n</div>','text_3.html');
INSERT INTO `cow_table_field` VALUES('103','openid','微信OPENID','0','user','微信OPENID','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','99','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','','text_1.html');
INSERT INTO `cow_table_field` VALUES('104','nickname','昵称','0','user','昵称','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','5','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','','text_1.html');
INSERT INTO `cow_table_field` VALUES('350','qrcode_open','开通二维码','','user','是否开通二维码自动，0表示开通，1表示未开通','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'5\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','8','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('387','verify','审核','1','notice','  ','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'box_list\\\' => \\\'未审核=0\r\n已审核=1\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'format\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','box','0','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>','checkbox_1.html','<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>','checkbox_1.html');
INSERT INTO `cow_table_field` VALUES('388','title','文章标题','0','notice','请输入文字标题','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','text','0','','','','10,9','10,9','10,9','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','','text_1.html');
INSERT INTO `cow_table_field` VALUES('389','description','简介','0','notice','内容简短说明','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\r\n  \\\'width\\\' => \\\'100%\\\',\r\n  \\\'height\\\' => \\\'46\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'html\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)','textarea','1','','','','','','','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-8\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-10 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','textarea_1.html','','textarea_1.html');
INSERT INTO `cow_table_field` VALUES('390','content','内容','0','notice','请输入内容','array (\n  \\\'width\\\' => \\\'0\\\',\n  \\\'height\\\' => \\\'200\\\',\n  \\\'editor_link\\\' => \\\'0\\\',\n  \\\'editor_link_num\\\' => \\\'0\\\',\n  \\\'editor_link_type\\\' => \\\'1\\\',\n  \\\'editor_save\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n)','editor','2','','','','','','','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','editor_standard.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n	[editor_simplify]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','editor_simplify .html');
INSERT INTO `cow_table_field` VALUES('391','price','浏览价格','0','notice','浏览价格','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','text','3','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','','text_1.html');
INSERT INTO `cow_table_field` VALUES('392','thumb','缩略图','0','notice','缩略图','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\r\n  \\\'width\\\' => \\\'100\\\',\r\n  \\\'height\\\' => \\\'100\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'checks\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n)','image','4','','','','','','','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>','image_2.html','','image_1.html');
INSERT INTO `cow_table_field` VALUES('393','autho_id','发布人ID','0','notice','发布人ID','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','text','5','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','','text_1.html');
INSERT INTO `cow_table_field` VALUES('394','autho_admin','用户类型','0','notice','用户类型','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'0\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','text','6','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','','text_1.html');
INSERT INTO `cow_table_field` VALUES('395','addtime','添加日期','0','notice','添加日期','array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)','datetime','7','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','datetime_1.html','','datetime_1.html');
INSERT INTO `cow_table_field` VALUES('396','promote_point','升级点数','','user','升级点数','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','7','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('397','year_consumption','年消费','3','user','年消费','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','88','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('398','month_consumption','月消费','3','user','月消费','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','89','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('399','day_consumption','日消费','3','user','日消费','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','90','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('400','total_consumption','累计消费','3','user','累计消费','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','91','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('401','year_order','年订单','3','user','年订单','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','90','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('402','month_order','月订单','3','user','月订单','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','91','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('403','day_order','日订单','3','user','日订单','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','92','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('404','total_order','总订单','3','user','总订单','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','93','','','','','','','0','0','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');

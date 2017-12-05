SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cow_inventory_info
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

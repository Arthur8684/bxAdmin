SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for cow_comment
-- ----------------------------
DROP TABLE IF EXISTS `cow_comment`;
CREATE TABLE `cow_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `model_id` int(11) DEFAULT NULL COMMENT '模型id',
  `goods_id` int(11) DEFAULT NULL COMMENT '文章或产品id',
  `content` varchar(500) DEFAULT NULL COMMENT '评论内容',
  `star` int(11) DEFAULT NULL COMMENT '星级',
  `img_array` varchar(8000) DEFAULT NULL COMMENT '图集',
  `is_audit` int(11) DEFAULT '0' COMMENT '是否审核',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

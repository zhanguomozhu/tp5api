/*
MySQL Database Backup Tools
Server:127.0.0.1:
Database:tp5api
Data:2017-11-06 16:23:28
*/
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for mk_common_file
-- ----------------------------
DROP TABLE IF EXISTS `mk_common_file`;
CREATE TABLE `mk_common_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `guid` char(40) DEFAULT NULL,
  `uuid` char(40) DEFAULT NULL,
  `name` varchar(100) DEFAULT '' COMMENT '原始文件名',
  `savename` varchar(100) DEFAULT '' COMMENT '保存名称',
  `savepath` varchar(255) DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文件表';
-- ----------------------------
-- Records of mk_common_file
-- ----------------------------

-- ----------------------------
-- Table structure for mk_common_images
-- ----------------------------
DROP TABLE IF EXISTS `mk_common_images`;
CREATE TABLE `mk_common_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `uuid` char(40) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `path` varchar(255) DEFAULT '' COMMENT '路径',
  `url` varchar(255) DEFAULT '' COMMENT '图片链接',
  `md5` char(32) DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `channels` tinyint(4) DEFAULT NULL,
  `dpi` int(11) DEFAULT NULL,
  `exif` text,
  `size` int(11) DEFAULT NULL,
  `star` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of mk_common_images
-- ----------------------------

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `loginip` char(20) NOT NULL DEFAULT '' COMMENT '上一次登录ip',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定',
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否是超级管理员【0：超级管理员，1：普通管理员】',
  `session_id` varchar(255) NOT NULL COMMENT 'session_id',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` (`id`,`username`,`password`,`phone`,`logintime`,`loginip`,`lock`,`admin`,`session_id`,`create_time`,`update_time`) VALUES ('41','admin','21232f297a57a5a743894a0e4a801fc3','15617578175','1509951262','127.0.0.1','0','0','2f7khtmukm5su5v4a3ed3pvng1','1509074875','1509951262');
INSERT INTO `tp_admin` (`id`,`username`,`password`,`phone`,`logintime`,`loginip`,`lock`,`admin`,`session_id`,`create_time`,`update_time`) VALUES ('42','admin3','32cacb2f994f6b42183a1300d9a3e8d6','13033333333','0','','0','1','','1509167593','1509168962');
INSERT INTO `tp_admin` (`id`,`username`,`password`,`phone`,`logintime`,`loginip`,`lock`,`admin`,`session_id`,`create_time`,`update_time`) VALUES ('40','admin2','c84258e9c39059a89ab77d846ddab909','15033333333','0','','0','1','','1509074512','1509168251');

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
INSERT INTO `tp_auth_group` (`id`,`title`,`status`,`rules`,`create_time`,`update_time`) VALUES ('12','超级管理员','1','63,64,65,66,67,58,59,60,61,62,48,49,52,51,50,53,54,57,55,56','1509167505','1509169844');
INSERT INTO `tp_auth_group` (`id`,`title`,`status`,`rules`,`create_time`,`update_time`) VALUES ('13','普通管理员','1','53,54,56,55,57','1509167523','1509167523');

-- ----------------------------
-- Table structure for tp_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group_access`;
CREATE TABLE `tp_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_group_access
-- ----------------------------
INSERT INTO `tp_auth_group_access` (`uid`,`group_id`,`create_time`,`update_time`) VALUES ('42','12','0','1509168227');
INSERT INTO `tp_auth_group_access` (`uid`,`group_id`,`create_time`,`update_time`) VALUES ('41','12','1509168238','1509168238');
INSERT INTO `tp_auth_group_access` (`uid`,`group_id`,`create_time`,`update_time`) VALUES ('40','13','1509168251','1509168251');
INSERT INTO `tp_auth_group_access` (`uid`,`group_id`,`create_time`,`update_time`) VALUES ('42','13','1509168962','1509168962');

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(5) NOT NULL DEFAULT '50',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('52','menu/del','删除菜单','1','1','','49','2','50','1509167370','1509167370');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('48','menu','菜单管理','1','1','','0','0','1','1509167266','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('49','menu/lst','菜单列表','1','1','','48','1','50','1509167306','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('51','menu/edit','编辑菜单','1','1','','49','2','50','1509167351','1509167351');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('50','menu/add','添加菜单','1','1','','49','2','50','1509167333','1509167333');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('53','admin','用户管理','1','1','','0','0','2','1509167401','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('54','admin/lst','用户列表','1','1','','53','1','50','1509167423','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('55','admin/add','添加用户','1','1','','54','2','50','1509167442','1509167442');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('56','admin/edit','编辑用户','1','1','','54','2','50','1509167460','1509167460');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('57','admin/del','删除用户','1','1','','54','2','50','1509167479','1509167479');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('58','auth_group','角色管理','1','1','','0','0','3','1509169592','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('59','auth_group/lst','角色列表','1','1','','58','1','50','1509169620','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('60','auth_group/add','添加角色','1','1','','59','2','50','1509169657','1509169657');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('61','auth_group/edit','编辑角色','1','1','','59','2','50','1509169679','1509169679');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('62','auth_group/del','删除角色','1','1','','59','2','50','1509169701','1509169701');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('63','auth_rule','权限管理','1','1','','0','0','4','1509169736','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('64','auth_rule/lst','权限列表','1','1','','63','1','50','1509169764','1509327105');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('65','auth_rule/add','添加权限','1','1','','64','2','50','1509169782','1509169782');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('66','auth_rule/edit','编辑权限','1','1','','64','2','50','1509169805','1509169805');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`sort`,`create_time`,`update_time`) VALUES ('67','auth_rule/del','删除权限','1','1','','64','2','50','1509169829','1509169829');

-- ----------------------------
-- Table structure for tp_menu
-- ----------------------------
DROP TABLE IF EXISTS `tp_menu`;
CREATE TABLE `tp_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `pid` int(11) NOT NULL COMMENT '父级id',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '级别',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '显示隐藏',
  `icon` varchar(255) NOT NULL DEFAULT 'fa-th-large' COMMENT '图标',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_menu
-- ----------------------------
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('25','权限列表','auth_rule/lst','24','1','50','1','fa-list-ol','1509154487','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('24','权限管理','auth_rule','0','0','5','1','fa-sitemap','1509154464','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('19','首页','index','0','0','1','1','fa-th-large','1509154316','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('20','用户管理','admin','0','0','3','1','fa-user','1509154344','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('21','用户列表','admin/lst','20','1','50','1','fa-list-ol','1509154372','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('22','角色管理','auth_group','0','0','4','1','fa-smile-o','1509154405','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('23','角色列表','auth_group/lst','22','1','50','1','fa-list-ol','1509154427','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('26','菜单管理','menu','0','0','2','1','fa-th-list','1509154585','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('27','菜单列表','menu/lst','26','1','50','1','fa-list-ol','1509154616','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('28','功能展示','funs','0','0','6','1','fa-tasks','1509327731','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('29','邮件','funs/email','28','1','1','1','fa-envelope','1509328488','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('30','云之讯短信','funs/sms','28','1','2','1','fa-envelope-o','1509328586','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('31','二维码','funs/qrcode','28','1','4','1','fa-qrcode','1509336331','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('32','汉字转拼音','funs/pinyin','28','1','6','1','fa-random','1509336408','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('33','地图','funs/map','28','1','7','1','fa-map-marker','1509336459','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('35','阿里大鱼短信','funs/sms1','28','1','3','1','fa-envelope-o','1509338406','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('36','详细二维码','funs/qrcode1','28','1','5','1','fa-qrcode','1509353445','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('37','小功能','sfun','0','0','50','1','fa-gears','1509418254','1509519960');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('38','excel','funs/excel','28','1','50','1','fa-list-ol','1509499104','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('39','上传图片','sfun/uploadfile','37','1','2','1',' fa-upload','1509499193','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('65','功能列表','sfun/index','37','1','1','1','fa-list-ol','1509519643','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('67','数据库备份','Sqlbak/index','28','1','8','1','fa-list-ol','1509954034','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('48','生成pdf','funs/pdf','28','1','50','1','fa-level-down','1509499848','1509954079');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('49','支付宝支付','index/alipay/index','28','1','50','1',' fa-credit-card','1509499916','1509781092');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('50','微信支付','index/wxpay/index','28','1','50','1','fa-comments','1509499941','1509781057');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('51','AppStore支付','funs/store','28','1','50','1',' fa-cloud','1509499976','1509519894');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('59','删除指定的标签和内容','sfun/rmtag','28','1','50','1','fa-list-ol','1509500405','1509500405');

-- ----------------------------
-- Table structure for tp_order
-- ----------------------------
DROP TABLE IF EXISTS `tp_order`;
CREATE TABLE `tp_order` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `body` varchar(50) DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `out_trade_no` varchar(50) DEFAULT NULL,
  `product_id` varchar(30) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_order
-- ----------------------------
INSERT INTO `tp_order` (`id`,`body`,`total_fee`,`transaction_id`,`out_trade_no`,`product_id`,`status`) VALUES ('00000000086','支付测试','1','','20351265531509764764','1509764764','0');
INSERT INTO `tp_order` (`id`,`body`,`total_fee`,`transaction_id`,`out_trade_no`,`product_id`,`status`) VALUES ('00000000087','支付测试','1','','21129272631509772415','1509772415','0');
INSERT INTO `tp_order` (`id`,`body`,`total_fee`,`transaction_id`,`out_trade_no`,`product_id`,`status`) VALUES ('00000000088','支付测试','1','','14371266331509772610','1509772610','0');
INSERT INTO `tp_order` (`id`,`body`,`total_fee`,`transaction_id`,`out_trade_no`,`product_id`,`status`) VALUES ('00000000089','支付测试','1','','21457212951509773457','1509773457','0');
INSERT INTO `tp_order` (`id`,`body`,`total_fee`,`transaction_id`,`out_trade_no`,`product_id`,`status`) VALUES ('00000000090','支付测试','1','','10883928111509773938','1509773938','0');

-- ----------------------------
-- Table structure for tp_sns
-- ----------------------------
DROP TABLE IF EXISTS `tp_sns`;
CREATE TABLE `tp_sns` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL COMMENT '第三方登录类别',
  `name` varchar(255) NOT NULL COMMENT '用户名',
  `nick` varchar(255) NOT NULL COMMENT '昵称',
  `head` varchar(255) NOT NULL COMMENT '头像',
  `openid` varchar(255) NOT NULL COMMENT 'openid',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_sns
-- ----------------------------

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `sid` bigint(20) NOT NULL COMMENT '第三方id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_user
-- ----------------------------


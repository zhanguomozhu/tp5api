/*
MySQL Database Backup Tools
Server:127.0.0.1:
Database:tp5api
Data:2017-11-10 09:45:37
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
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` (`id`,`username`,`password`,`phone`,`logintime`,`loginip`,`lock`,`admin`,`session_id`,`num`,`create_time`,`update_time`) VALUES ('41','admin','21232f297a57a5a743894a0e4a801fc3','15617578175','1510276259','127.0.0.1','0','0','rju31o11299ck3v9b5ksi7fl27','16','1509074875','1510276259');
INSERT INTO `tp_admin` (`id`,`username`,`password`,`phone`,`logintime`,`loginip`,`lock`,`admin`,`session_id`,`num`,`create_time`,`update_time`) VALUES ('42','admin3','32cacb2f994f6b42183a1300d9a3e8d6','13033333332','1510276208','127.0.0.1','0','1','rju31o11299ck3v9b5ksi7fl27','1','1509167593','1510276208');
INSERT INTO `tp_admin` (`id`,`username`,`password`,`phone`,`logintime`,`loginip`,`lock`,`admin`,`session_id`,`num`,`create_time`,`update_time`) VALUES ('40','admin2','c84258e9c39059a89ab77d846ddab909','15033333333','1510217983','127.0.0.1','0','1','u2k318jb6385qgg3js4e3ic263','6','1509074512','1510217983');

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
INSERT INTO `tp_auth_group` (`id`,`title`,`status`,`rules`,`create_time`,`update_time`) VALUES ('12','超级管理员','1','95,96,101,102,103,104,97,105,106,107,108,98,109,110,111,112,99,113,114,115,116,117,100,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136','1509167505','1510278148');
INSERT INTO `tp_auth_group` (`id`,`title`,`status`,`rules`,`create_time`,`update_time`) VALUES ('13','普通管理员','1','95,96,101,97,105,99,113,114,115,116,100','1509167523','1510218583');

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
INSERT INTO `tp_auth_group_access` (`uid`,`group_id`,`create_time`,`update_time`) VALUES ('41','12','1509168238','1509168238');
INSERT INTO `tp_auth_group_access` (`uid`,`group_id`,`create_time`,`update_time`) VALUES ('40','13','1509168251','1509168251');
INSERT INTO `tp_auth_group_access` (`uid`,`group_id`,`create_time`,`update_time`) VALUES ('42','13','1509168962','1510219260');

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
  `icon` varchar(255) NOT NULL DEFAULT 'fa-list-ol' COMMENT '菜单显示图标',
  `sort` int(5) NOT NULL DEFAULT '50',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('95','#','后台管理','1','0','','0','0','fa-list-ol','50','1510217371','1510277435');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('96','admin/lst','用户管理','1','1','','95','1','fa-list-ol','50','1510217514','1510219747');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('97','auth_group/lst','角色管理','1','1','','95','1','fa-list-ol','50','1510217563','1510277674');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('98','auth_rule/lst','权限管理','1','1','','95','1','fa-list-ol','50','1510217607','1510217912');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('99','conf/lst','系统管理','1','1','','95','1','fa-list-ol','50','1510217650','1510217922');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('100','#','功能管理','1','1','','95','1','fa-list-ol','50','1510217700','1510277734');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('101','admin/admin/lst','用户列表','1','1','','96','2','fa-list-ol','50','1510218087','1510277704');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('102','admin/admin/add','添加用户','1','0','','96','2','fa-list-ol','50','1510218128','1510277658');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('103','admin/admin/edit','编辑用户','1','0','','96','2','fa-list-ol','50','1510218179','1510277666');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('104','admi/admin/del','删除用户','1','0','','96','2','fa-list-ol','50','1510218200','1510277656');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('105','admin/auth_group/lst','角色列表','1','1','','97','2','fa-list-ol','50','1510218230','1510277705');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('106','	admin/auth_group/add','添加角色','1','0','','97','2','fa-list-ol','50','1510218251','1510277669');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('107','admin/auth_group/edit','编辑角色','1','0','','97','2','fa-list-ol','50','1510218274','1510277668');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('108','admin/auth_group/del','删除角色','1','0','','97','2','fa-list-ol','50','1510218301','1510277665');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('109','admin/auth_rule/lst','权限列表','1','1','','98','2','fa-list-ol','50','1510218322','1510277702');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('110','admin/auth_rule/add','添加权限','1','0','','98','2','fa-list-ol','50','1510218342','1510277676');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('111','admin/auth_rule/edit','编辑权限','1','0','','98','2','fa-list-ol','50','1510218358','1510277672');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('112','admin/auth_rule/del','删除权限','1','0','','98','2','fa-list-ol','50','1510218388','1510277649');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('113','admin/conf/lst','配置列表','1','1','','99','2','fa-list-ol','50','1510218420','1510277689');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('114','admin/conf/conf','设置配置','1','1','','99','2','fa-list-ol','50','1510218449','1510218449');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('115','admin/conf/add','添加配置','1','0','','99','2','fa-list-ol','50','1510218476','1510277696');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('116','admin/conf/edit','编辑配置','1','0','','99','2','fa-list-ol','50','1510218497','1510277694');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('117','admin/conf/del','删除配置','1','0','','99','2','fa-list-ol','50','1510218513','1510277692');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('118','index/alipay/index','支付宝支付','1','1','','100','2','fa-list-ol','50','1510276493','1510276493');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('119','index/wxpay/index','微信支付','1','1','','100','2','fa-list-ol','50','1510276687','1510276687');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('120','index/appstore/index','AppStore支付','1','1','','100','2','fa-list-ol','50','1510277778','1510277778');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('121','funs/rong','容联云短信','1','1','','100','2','fa-list-ol','50','1510277803','1510277803');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('122','funs/sms','云之讯短信','1','1','','100','2','fa-list-ol','50','1510277827','1510277827');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('123','funs/sms1','阿里大鱼短信','1','1','','100','2','fa-list-ol','50','1510277844','1510277844');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('124','funs/email','邮件','1','1','','100','2','fa-list-ol','50','1510277865','1510277865');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('125','funs/qrcode','二维码','1','1','','100','2','fa-list-ol','50','1510277892','1510277892');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('126','funs/qrcode1','详细二维码','1','1','','100','2','fa-list-ol','50','1510277907','1510277907');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('127','funs/map','地图','1','1','','100','2','fa-list-ol','50','1510277924','1510277924');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('128','funs/pinyin','汉字转拼音','1','1','','100','2','fa-list-ol','50','1510277938','1510277938');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('129','funs/excel','excel','1','1','','100','2','fa-list-ol','50','1510277967','1510277967');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('130','funs/pdf','生成pdf','1','1','','100','2','fa-list-ol','50','1510277984','1510277984');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('131','Sqlbak/index','数据库备份','1','1','','100','2','fa-list-ol','50','1510278003','1510278003');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('132','sfun/uploadfile','上传图片','1','1','','100','2','fa-list-ol','50','1510278020','1510278020');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('133','funs/chou','概率抽奖','1','1','','100','2','fa-list-ol','50','1510278048','1510278048');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('134','funs/short','短连接生成','1','1','','100','2','fa-list-ol','50','1510278062','1510278062');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('135','funs/editor','模板标签','1','1','','100','2','fa-list-ol','50','1510278077','1510278077');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('136','sfun/index','功能列表','1','1','','100','2','fa-list-ol','50','1510278120','1510278120');

-- ----------------------------
-- Table structure for tp_conf
-- ----------------------------
DROP TABLE IF EXISTS `tp_conf`;
CREATE TABLE `tp_conf` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cnname` varchar(50) NOT NULL COMMENT '中文名称',
  `enname` varchar(50) NOT NULL COMMENT '英文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '配置类型[1:单行文本框2:文本域3:单选按钮4:复选框5:下拉菜单]',
  `value` varchar(255) NOT NULL COMMENT '配置值',
  `values` varchar(255) DEFAULT NULL COMMENT '配置可选值[1.单行文本2.多行文本3.单选按钮4.复选框5.下拉菜单]',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_conf
-- ----------------------------
INSERT INTO `tp_conf` (`id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('10','站点名称','sitename','1','thinkphp5功能集成','thinkphp5功能集成','1','1510122582','1510123095');
INSERT INTO `tp_conf` (`id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('11','站点描述','desc','2','thinkphp5功能集成','关于thinkphp5的功能集合','2','1510122724','1510123095');
INSERT INTO `tp_conf` (`id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('13','是否启用验证码','code','3','是','是,否','50','1510124164','1510124503');
INSERT INTO `tp_conf` (`id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('14','自动清空缓存','cache','5','3小时','1小时,2小时,3小时','50','1510124354','1510124354');
INSERT INTO `tp_conf` (`id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('15','是否允许评论','comment','4','是','是','50','1510124391','1510124536');
INSERT INTO `tp_conf` (`id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('16','status','status','3','开启','开启,关闭','50','1510124425','1510124448');

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
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_menu
-- ----------------------------
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('25','权限列表','auth_rule/lst','24','1','50','1','fa-list-ol','1509154487','1510025895');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('24','权限管理','#','0','0','5','1','fa-sitemap','1509154464','1510119940');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('19','首页','admin/index/index','0','0','1','1','fa-th-large','1509154316','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('20','用户管理','#','0','0','3','1','fa-user','1509154344','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('21','用户列表','admin/lst','20','1','50','1','fa-list-ol','1509154372','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('22','角色管理','#','0','0','4','1','fa-smile-o','1509154405','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('23','角色列表','auth_group/lst','22','1','50','1','fa-list-ol','1509154427','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('26','菜单管理','#','0','0','2','1','fa-th-list','1509154585','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('27','菜单列表','menu/lst','26','1','50','1','fa-list-ol','1509154616','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('28','功能展示','#','0','0','6','1','fa-tasks','1509327731','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('29','邮件','funs/email','28','1','1','1','fa-envelope','1509328488','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('30','云之讯短信','funs/sms','28','1','2','1','fa-envelope-o','1509328586','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('31','二维码','funs/qrcode','28','1','5','1','fa-qrcode','1509336331','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('32','汉字转拼音','funs/pinyin','28','1','7','1','fa-random','1509336408','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('33','地图','funs/map','28','1','8','1','fa-map-marker','1509336459','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('35','阿里大鱼短信','funs/sms1','28','1','3','1','fa-envelope-o','1509338406','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('36','详细二维码','funs/qrcode1','28','1','6','1','fa-qrcode','1509353445','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('37','小功能','#','0','0','5','1','fa-gears','1509418254','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('38','excel','funs/excel','28','1','10','1','fa-list-ol','1509499104','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('39','上传图片','sfun/uploadfile','37','1','2','1',' fa-upload','1509499193','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('65','功能列表','sfun/index','37','1','1','1','fa-list-ol','1509519643','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('67','数据库备份','Sqlbak/index','28','1','9','1','fa-list-ol','1509954034','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('68','文件系统','#','0','0','50','1','fa-list-ol','1510019243','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('48','生成pdf','funs/pdf','28','1','11','1','fa-level-down','1509499848','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('49','支付宝支付','index/alipay/index','28','1','12','1',' fa-credit-card','1509499916','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('50','微信支付','index/wxpay/index','28','1','13','1','fa-comments','1509499941','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('51','AppStore支付','index/appstore/index','28','1','14','1',' fa-cloud','1509499976','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('69','容联云短信','funs/rong','28','1','4','1','fa-envelope-o','1510022256','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('70','概率抽奖','funs/chou','28','1','50','1','fa-list-ol','1510035054','1510216413');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('71','短连接生成','funs/short','28','1','50','1','fa-chain','1510107294','1510120794');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('72','系统配置','#','0','0','50','1',' fa-gear','1510120703','1510120882');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('73','配置列表','conf/lst','72','1','50','1','fa-list-ol','1510121145','1510121145');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('74','配置项','conf/conf','72','1','50','1','fa-cog','1510123663','1510123689');
INSERT INTO `tp_menu` (`id`,`title`,`path`,`pid`,`level`,`sort`,`status`,`icon`,`create_time`,`update_time`) VALUES ('75','模板标签','funs/editor','28','1','50','1','fa-list-ol','1510130912','1510130912');

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
-- Table structure for tp_url
-- ----------------------------
DROP TABLE IF EXISTS `tp_url`;
CREATE TABLE `tp_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `original` text CHARACTER SET utf8 NOT NULL,
  `short` varchar(16) NOT NULL COMMENT '最大16个字符串',
  `ip` varchar(128) NOT NULL,
  `click` int(11) NOT NULL,
  `visitor` longtext NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
-- ----------------------------
-- Records of tp_url
-- ----------------------------
INSERT INTO `tp_url` (`id`,`uid`,`original`,`short`,`ip`,`click`,`visitor`,`create_time`,`update_time`) VALUES ('50','41','https://zhidao.baidu.com/question/243549397747984004.html','AvOLL','127.0.0.1','1','[{"short":"AvOLL","ip":"127.0.0.1","time":1510119282}]','1510119281','1510119281');
INSERT INTO `tp_url` (`id`,`uid`,`original`,`short`,`ip`,`click`,`visitor`,`create_time`,`update_time`) VALUES ('51','41','http://blog.csdn.net/flygoa/article/details/49998373','8c3pQ','127.0.0.1','1','[{"short":"8c3pQ","ip":"127.0.0.1","time":1510119974}]','1510119970','1510119970');
INSERT INTO `tp_url` (`id`,`uid`,`original`,`short`,`ip`,`click`,`visitor`,`create_time`,`update_time`) VALUES ('52','41','http://blog.csdn.net/flygoa/article/details/49998373','UbuOD','127.0.0.1','1','[{"short":"UbuOD","ip":"127.0.0.1","time":1510120668}]','1510120667','1510120667');
INSERT INTO `tp_url` (`id`,`uid`,`original`,`short`,`ip`,`click`,`visitor`,`create_time`,`update_time`) VALUES ('53','41','https://segmentfault.com/q/1010000004319802','1BlBd','127.0.0.1','0','','1510192422','1510192422');
INSERT INTO `tp_url` (`id`,`uid`,`original`,`short`,`ip`,`click`,`visitor`,`create_time`,`update_time`) VALUES ('54','41','http://www.thinkphp.cn/code/250.html','D3uk0','127.0.0.1','1','[{"short":"D3uk0","ip":"127.0.0.1","time":1510278325}]','1510278324','1510278324');

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


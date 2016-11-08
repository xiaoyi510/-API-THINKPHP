/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50540
Source Host           : 127.0.0.1:3306
Source Database       : myapi

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-11-08 15:34:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api
-- ----------------------------
DROP TABLE IF EXISTS `api`;
CREATE TABLE `api` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` varchar(10) DEFAULT '' COMMENT '接口编号',
  `cid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '接口名称',
  `params` text COMMENT '请求参数',
  `returns` text COMMENT '返回参数结果',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '请求类型  1 POST 2 GET',
  `return_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '返回数据类型 1 JSON 2 XML',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '请求地址',
  `desc` text COMMENT '接口描述',
  `demo` text COMMENT '请求示例',
  `return_demo` text COMMENT '返回示例',
  `create_time` int(11) unsigned DEFAULT '0' COMMENT '创建时间',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `is_login` tinyint(1) unsigned DEFAULT '0' COMMENT '是否只有登录才能看 0 否 1 开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api
-- ----------------------------
INSERT INTO `api` VALUES ('7', '15036510', '1', '测试', '[]', '[]', '2', '1', 'http://wx.k1jia.com', '哦i接按时购I爱上偶家收购就', 'url:http://wx.k1jia.com\r\ndata:\r\n{\r\n	timestamp:123456\r\n}\r\n\r\n\r\nasogija s', '{\r\n  error_code:0,\r\n  msg:\'aaa\'\r\n}\r\n\r\nasgjaisgo ', '1478583569', '1', '1');
INSERT INTO `api` VALUES ('6', '001', '1', '用户登录', '[{\"paramName\":\"timestamp\",\"paramType\":\"String\",\"paramMust\":\"1\",\"paramDefault\":\"\",\"paramText\":\"\\u65f6\\u95f4\\u6233\"}]', '[{\"returnName\":\"asf\",\"returnType\":\"String\",\"returnText\":\"asg\"}]', '1', '1', 'http://wx.k1jia.com', '用户登录', 'function a(){\r\n  echo 1;\r\n}', '返回示例', '1478581586', '1', '0');

-- ----------------------------
-- Table structure for cate
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `desc` text COMMENT '描述',
  `create_time` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES ('1', '测试', '飞里', '0');
INSERT INTO `cate` VALUES ('2', '用户', '用户登录、注册等', '1478519437');

-- ----------------------------
-- Table structure for system
-- ----------------------------
DROP TABLE IF EXISTS `system`;
CREATE TABLE `system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `web_title` varchar(255) DEFAULT NULL,
  `ver` varchar(255) DEFAULT '' COMMENT '版本',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system
-- ----------------------------
INSERT INTO `system` VALUES ('1', 'TrueCode API接口管理', '1.0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT '' COMMENT '用户名',
  `name` varchar(255) DEFAULT '' COMMENT '用户姓名',
  `password` char(32) DEFAULT '' COMMENT '密码',
  `login_time` int(11) unsigned DEFAULT '0' COMMENT '最后登录的IP',
  `login_ip` int(11) unsigned DEFAULT '0' COMMENT '最后登录的ip',
  `is_super` tinyint(1) unsigned DEFAULT '0' COMMENT '是否是管理员 0 普通人 1 普通管理员 2 超级管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '系统管理员', '21232f297a57a5a743894a0e4a801fc3', '0', '0', '2');
INSERT INTO `user` VALUES ('5', '124124', '24124', '0f28b5d49b3020afeecd95b4009adf4c', '0', '0', '0');

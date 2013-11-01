/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : register

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-03-31 11:48:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `info`
-- ----------------------------
DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(250) DEFAULT NULL,
  `l_name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of info
-- ----------------------------
INSERT INTO `info` VALUES ('1', 'modi', 'bixa', 'admin', 'admin');
INSERT INTO `info` VALUES ('2', 'abc', 'def', 'abc@gmail.com', '123244545');
INSERT INTO `info` VALUES ('3', 'ABC', 'DEF', 'a@gmail.com', '63483i');

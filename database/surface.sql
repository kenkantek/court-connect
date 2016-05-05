/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50628
Source Host           : 127.0.0.1:3306
Source Database       : courtconnect

Target Server Type    : MYSQL
Target Server Version : 50628
File Encoding         : 65001

Date: 2016-04-20 17:44:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for surface
-- ----------------------------
DROP TABLE IF EXISTS `surface`;
CREATE TABLE `surface` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of surface
-- ----------------------------
INSERT INTO `surface` VALUES ('1', 'hard', 'Hard');
INSERT INTO `surface` VALUES ('2', 'hartru', 'Har-Tru');
INSERT INTO `surface` VALUES ('3', 'redclay', 'Red Clay');
INSERT INTO `surface` VALUES ('4', 'grass', 'Grass');
INSERT INTO `surface` VALUES ('5', 'carpet', 'Carpet');

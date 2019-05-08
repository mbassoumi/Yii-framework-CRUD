/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost:3306
 Source Schema         : yiicrud

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 08/05/2019 04:01:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(191) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `marks` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contacts
-- ----------------------------
BEGIN;
INSERT INTO `contacts` VALUES (1, 'majd1', 'bassoumi1', 'mbbassoumi@gmail.com1', NULL, 1, 34.5);
INSERT INTO `contacts` VALUES (2, 'majd2', 'bassoumi2', 'mbbassoumi@gmail.com2', NULL, 0, 6.5);
INSERT INTO `contacts` VALUES (3, 'majd3', 'bassoumi3', 'mbbassoumi@gmail.com3', NULL, 1, 354.5);
INSERT INTO `contacts` VALUES (4, 'majd44444', 'bassoumi4', 'mbbassoumi@gmail.com4', NULL, 1, 3434.5);
INSERT INTO `contacts` VALUES (5, 'majd5', 'bassoumi5', 'mbbassoumi@gmail.com5', NULL, 0, 34.4);
INSERT INTO `contacts` VALUES (6, 'majd6', 'bassoumi6', 'mbbassoumi@gmail.com6', NULL, 1, 34.56);
INSERT INTO `contacts` VALUES (7, 'majd7', 'bassoumi7', 'mbbassoumi@gmail.com7', NULL, 0, 34.9);
INSERT INTO `contacts` VALUES (8, 'majd8', 'bassoumi8', 'mbbassoumi@gmail.com8', NULL, 0, 24.5);
INSERT INTO `contacts` VALUES (9, 'majd9', 'bassoumi9', 'mbbassoumi@gmail.com9', NULL, 1, 53.5);
INSERT INTO `contacts` VALUES (10, 'majd10', 'bassoumi10', 'mbbassoumi@gmail.com10', NULL, 1, 66.7);
COMMIT;

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `name` char(52) NOT NULL,
  `population` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of country
-- ----------------------------
BEGIN;
INSERT INTO `country` VALUES (1, 'AU', 'Australia', 24016400);
INSERT INTO `country` VALUES (2, 'BR', 'Brazil', 205722000);
INSERT INTO `country` VALUES (3, 'CA', 'Canada', 35985751);
INSERT INTO `country` VALUES (4, 'CN', 'China', 1375210000);
INSERT INTO `country` VALUES (5, 'DE', 'Germany', 81459000);
INSERT INTO `country` VALUES (6, 'FR', 'France', 64513242);
INSERT INTO `country` VALUES (7, 'GB', 'United Kingdom', 65097000);
INSERT INTO `country` VALUES (8, 'IN', 'India', 1285400000);
INSERT INTO `country` VALUES (9, 'RU', 'Russia', 146519759);
INSERT INTO `country` VALUES (10, 'US', 'United States', 322976000);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

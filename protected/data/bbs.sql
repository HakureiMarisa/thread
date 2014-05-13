/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : bbs

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-05-13 08:24:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for at
-- ----------------------------
DROP TABLE IF EXISTS `at`;
CREATE TABLE `at` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for thread
-- ----------------------------
DROP TABLE IF EXISTS `thread`;
CREATE TABLE `thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` int(10) unsigned NOT NULL,
  `create_by` int(10) unsigned NOT NULL,
  `create_on` datetime NOT NULL,
  `reply_to` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `create_by` (`create_by`),
  KEY `reply_to` (`reply_to`),
  CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`),
  CONSTRAINT `thread_ibfk_3` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`),
  CONSTRAINT `thread_ibfk_4` FOREIGN KEY (`reply_to`) REFERENCES `thread` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for thread_content
-- ----------------------------
DROP TABLE IF EXISTS `thread_content`;
CREATE TABLE `thread_content` (
  `thread_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`thread_id`),
  CONSTRAINT `thread_content_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for topic
-- ----------------------------
DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_on` datetime NOT NULL,
  `create_by` int(10) unsigned NOT NULL,
  `visits` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `create_by` (`create_by`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `is_locked` enum('Y') COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `reset_key` varchar(23) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

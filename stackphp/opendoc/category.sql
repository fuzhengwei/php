/*
MySQL Data Transfer
Source Host: localhost
Source Database: itstack
Target Host: localhost
Target Database: itstack
Date: 2014-5-18 06:23:47
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for category
-- ----------------------------
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `category` VALUES ('2', '123');

/*
Navicat MySQL Data Transfer

Source Server         : 104.223.61.115
Source Server Version : 50555
Source Host           : 104.223.61.115:3306
Source Database       : blog_yi

Target Server Type    : MYSQL
Target Server Version : 50555
File Encoding         : 65001

Date: 2018-05-29 17:23:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for db_article
-- ----------------------------
DROP TABLE IF EXISTS `db_article`;
CREATE TABLE `db_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(25) NOT NULL COMMENT '博文标题',
  `cate_id` int(11) NOT NULL COMMENT '分类id',
  `description` varchar(50) DEFAULT '“”' COMMENT '对文章的概括',
  `tag` varchar(10) DEFAULT NULL,
  `sort` int(6) NOT NULL COMMENT '推荐排序',
  `path_url` varchar(100) NOT NULL COMMENT '图片url',
  `content` text COMMENT '博文主体',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for db_category
-- ----------------------------
DROP TABLE IF EXISTS `db_category`;
CREATE TABLE `db_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT '分类名',
  `f_id` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `sort` int(6) NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for db_node
-- ----------------------------
DROP TABLE IF EXISTS `db_node`;
CREATE TABLE `db_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(15) NOT NULL COMMENT '节点名称',
  `f_id` int(11) NOT NULL COMMENT '父节点id',
  `icon` varchar(25) DEFAULT NULL COMMENT '父节点对应的icon',
  `sort` int(5) NOT NULL DEFAULT '50' COMMENT '节点的顺序',
  `router` varchar(50) DEFAULT NULL COMMENT '对应路由',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '默认1为后台节点 2为前台节点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for db_user
-- ----------------------------
DROP TABLE IF EXISTS `db_user`;
CREATE TABLE `db_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) NOT NULL COMMENT '用户名',
  `password` char(64) NOT NULL COMMENT '用户密码',
  `salt` int(6) NOT NULL COMMENT '加密用的盐',
  `created_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for db_user_info
-- ----------------------------
DROP TABLE IF EXISTS `db_user_info`;
CREATE TABLE `db_user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `user_path` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `user_nikename` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `user_work` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户自称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for db_user_login
-- ----------------------------
DROP TABLE IF EXISTS `db_user_login`;
CREATE TABLE `db_user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `login_time` int(11) NOT NULL COMMENT '登陆时间',
  `login_adderss` varchar(25) NOT NULL COMMENT '登录的地点',
  `login_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1是电脑登录2是手机登录',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- 数据库：`HealthAssistantSYS`
CREATE DATABASE IF NOT EXISTS `HealthAssistantSYS`;
USE `HealthAssistantSYS`;

-- 用户表
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id`         BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_phone_num`  BIGINT(11) UNSIGNED NOT NULL,
  `user_name`       VARCHAR(45)         NOT NULL,
  `user_id_card`    BIGINT(18) UNSIGNED NOT NULL,
  `user_sex`        CHAR(5)             NOT NULL,
  `user_age`        INT(5) UNSIGNED     NOT NULL,
  `user_address`    VARCHAR(80)         NOT NULL,
  `user_family_num` VARCHAR(20),
  `user_level`      INT(5)              NOT NULL,
  `user_password`   CHAR(32)            NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_key` (`user_id_card`,`user_phone_num`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- 添加1条用户信息用于测试
REPLACE INTO `user_info` (user_phone_num, user_name, user_id_card, user_age, user_address, user_level, user_password, user_sex)
VALUES (12345678901, '基仔', 123456789012345678, 2, '美国啦啦啦啦', 0, '4297f44b13955235245b2497399d7a93', '男');

-- 病历表
DROP TABLE IF EXISTS `case_info`;
CREATE TABLE IF NOT EXISTS `case_info` (
  `case_id`      BIGINT(18) UNSIGNED  NOT NULL AUTO_INCREMENT,
  `case_user_id` BIGINT(18) UNSIGNED  NOT NULL,
  `case_hos_id`  BIGINT(18) UNSIGNED  NOT NULL,
  `case_date`    TIMESTAMP            NOT NULL,
  `case_desc`    TEXT                 NOT NULL,
  `case_type_id` TINYINT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`case_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- 添加2条病例信息用于测试
REPLACE INTO `case_info` (case_user_id, case_hos_id, case_desc, case_type_id, case_date)
VALUES (1, 1, '第一条第一条第一条第一条第一条第一条第一条第一条第一条第一条第一条第一条第一条', 1, NOW()),
  (1, 1, '我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔我是基仔', 2, NOW());

-- 医院表
DROP TABLE IF EXISTS `hospital_info`;
CREATE TABLE IF NOT EXISTS `hospital_info` (
  `hos_id`       BIGINT(18) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hos_name`     VARCHAR(25)         NOT NULL,
  `hos_part`     VARCHAR(25)         NOT NULL,
  `hos_username` VARCHAR(25)         NOT NULL,
  `hos_password` CHAR(32)            NOT NULL,
  PRIMARY KEY (`hos_id`),
  UNIQUE KEY `hos_key` (`hos_username`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- 添加医院信息用于测试
REPLACE INTO `hospital_info` (`hos_name`, `hos_part`, `hos_username`, `hos_password`) VALUES
  ('省中院', '化验科', 'szyhyk', '4297f44b13955235245b2497399d7a93');

-- 预约表
DROP TABLE IF EXISTS `reservation_info`;
CREATE TABLE IF NOT EXISTS `reservation_info` (
  `res_id`           BIGINT(18) UNSIGNED  NOT NULL AUTO_INCREMENT,
  `res_user_id_card` BIGINT(18) UNSIGNED  NOT NULL,
  `res_hos_id`       BIGINT(18) UNSIGNED  NOT NULL,
  `res_start`        TIMESTAMP            NOT NULL,
  `res_end`          TIMESTAMP            NOT NULL,
  `res_type`         TINYINT(10) UNSIGNED NOT NULL,
  `res_status`       TINYINT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`res_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- 添加2条预约信息用于WEB端口测试
REPLACE INTO `reservation_info` (res_user_id_card, res_hos_id, res_start, res_end, res_type, res_status)
VALUES (123456789012345678, 1, NOW(), '2018-11-14 09:37:23', 1, 5),
  (123456789012345678, 1, NOW(), '2018-11-14 09:37:23', 2, 5);

-- 种类表
DROP TABLE IF EXISTS `type_info`;
CREATE TABLE IF NOT EXISTS `type_info` (
  `type_id`   TINYINT(10) UNSIGNED NOT NULL,
  `type_name` VARCHAR(50)          NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_key` (`type_name`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- 添加2条种类信息用于测试
REPLACE INTO `type_info` (type_id, type_name) VALUES (1, '耳鼻喉科'), (2, '肝功能检查');

-- 状态表
DROP TABLE IF EXISTS `status_info`;
CREATE TABLE IF NOT EXISTS `status_info` (
  `status_id`   TINYINT(10) UNSIGNED NOT NULL,
  `status_name` VARCHAR(50)          NOT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `status_key`(`status_name`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- 添加6条种类信息用于测试
REPLACE INTO `status_info` (status_id, status_name)
VALUES (0, '已预约'), (1, '等待中'), (2, '检查中'), (3, '化验中'), (4, '诊断中'), (5, '已结束');
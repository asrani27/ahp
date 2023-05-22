/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50734 (5.7.34)
 Source Host           : localhost:3306
 Source Schema         : ahp

 Target Server Type    : MySQL
 Target Server Version : 50734 (5.7.34)
 File Encoding         : 65001

 Date: 22/05/2023 21:34:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ahp
-- ----------------------------
DROP TABLE IF EXISTS `ahp`;
CREATE TABLE `ahp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) DEFAULT NULL,
  `matrik_kriteria` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `matrik_guru` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ahp
-- ----------------------------
BEGIN;
INSERT INTO `ahp` (`id`, `tahun`, `matrik_kriteria`, `created_at`, `updated_at`, `matrik_guru`) VALUES (1, '2022', '{\"_token\":\"rNFXsFPrg2lVVKstlwkuPGrkKNhObFmDMGgsWIvg\",\"tahun\":\"2022\",\"kategorisatu\":[\"1\",\"2\",\"1\"],\"nilai\":[\"5\",\"5\",\"7\"],\"kategoridua\":[\"2\",\"4\",\"4\"]}', '2023-05-13 07:18:13', '2023-05-22 20:11:24', '{\"_token\":\"p2mYIoAKsRh70PFY18fGjoWw7BFqHGzdO2Qzknmt\",\"tahun\":\"2022\",\"kriteria_id\":[\"1\",\"1\",\"1\",\"2\",\"2\",\"2\",\"4\",\"4\",\"4\"],\"gurusatu\":[\"4\",\"4\",\"2\",\"2\",\"1\",\"2\",\"4\",\"1\",\"1\"],\"nilai\":[\"3\",\"5\",\"3\",\"5\",\"3\",\"3\",\"5\",\"5\",\"7\"],\"gurudua\":[\"2\",\"1\",\"1\",\"4\",\"4\",\"1\",\"2\",\"4\",\"2\"]}');
COMMIT;

-- ----------------------------
-- Table structure for ahp_guru
-- ----------------------------
DROP TABLE IF EXISTS `ahp_guru`;
CREATE TABLE `ahp_guru` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guru_vertikal` varchar(255) DEFAULT NULL,
  `guru_horizontal` varchar(255) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `ahp_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ahp_guru
-- ----------------------------
BEGIN;
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (160, '4', '2', 3, 1, 1);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (161, '4', '1', 5, 1, 1);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (162, '2', '1', 3, 1, 1);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (163, '2', '4', 5, 1, 2);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (164, '1', '4', 3, 1, 2);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (165, '2', '1', 3, 1, 2);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (166, '4', '2', 5, 1, 4);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (167, '1', '4', 5, 1, 4);
INSERT INTO `ahp_guru` (`id`, `guru_vertikal`, `guru_horizontal`, `nilai`, `ahp_id`, `kategori_id`) VALUES (168, '1', '2', 7, 1, 4);
COMMIT;

-- ----------------------------
-- Table structure for ahp_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `ahp_kriteria`;
CREATE TABLE `ahp_kriteria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kriteria_vertikal` varchar(255) DEFAULT NULL,
  `kriteria_horizontal` varchar(255) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `ahp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ahp_kriteria
-- ----------------------------
BEGIN;
INSERT INTO `ahp_kriteria` (`id`, `kriteria_vertikal`, `kriteria_horizontal`, `nilai`, `ahp_id`) VALUES (22, '1', '2', 5, 1);
INSERT INTO `ahp_kriteria` (`id`, `kriteria_vertikal`, `kriteria_horizontal`, `nilai`, `ahp_id`) VALUES (23, '2', '4', 5, 1);
INSERT INTO `ahp_kriteria` (`id`, `kriteria_vertikal`, `kriteria_horizontal`, `nilai`, `ahp_id`) VALUES (24, '1', '4', 7, 1);
COMMIT;

-- ----------------------------
-- Table structure for guru
-- ----------------------------
DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guru
-- ----------------------------
BEGIN;
INSERT INTO `guru` (`id`, `nama`) VALUES (1, 'Guru C');
INSERT INTO `guru` (`id`, `nama`) VALUES (2, 'Guru B');
INSERT INTO `guru` (`id`, `nama`) VALUES (4, 'Guru A');
COMMIT;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kategori
-- ----------------------------
BEGIN;
INSERT INTO `kategori` (`id`, `nama`) VALUES (1, 'Kehadiran');
INSERT INTO `kategori` (`id`, `nama`) VALUES (2, 'Kreatifitas');
INSERT INTO `kategori` (`id`, `nama`) VALUES (4, 'Sosial');
COMMIT;

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `role_users_user_id_role_id_unique` (`user_id`,`role_id`) USING BTREE,
  KEY `role_users_role_id_foreign` (`role_id`) USING BTREE,
  CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of role_users
-- ----------------------------
BEGIN;
INSERT INTO `role_users` (`user_id`, `role_id`) VALUES (1, 1);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (1, 'superadmin', '2020-12-23 23:17:35', '2020-12-23 23:17:35');
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (2, 'pemohon', '2022-10-19 14:20:54', '2022-10-19 14:20:54');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `password_superadmin` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `api_token` varchar(255) DEFAULT NULL,
  `last_session` varchar(255) DEFAULT NULL,
  `change_password` int(1) unsigned DEFAULT '0' COMMENT '0: belum, 1: sudah',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_username_unique` (`username`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `password_superadmin`, `remember_token`, `created_at`, `updated_at`, `api_token`, `last_session`, `change_password`) VALUES (1, 'admin', NULL, 'admin', '2023-04-29 07:57:56', '$2y$10$E9xG1OtIFvBRbHqlwHCC3u48vO5eBf2OQ9wFNpi.qKOAzVqNDUdW2', NULL, NULL, '2023-04-29 07:57:56', '2023-04-29 07:57:56', '$2y$10$tjMANlV25IUwvKuPxEODW.3qE3zPSKjwhmgTcZUgsPDZRGcpgGAN.', NULL, 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

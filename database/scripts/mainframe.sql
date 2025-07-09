/*
 Navicat Premium Data Transfer

 Source Server         : __LOCALHOST_MariaDB
 Source Server Type    : MariaDB
 Source Server Version : 100509
 Source Host           : localhost:33062
 Source Schema         : mainframe

 Target Server Type    : MariaDB
 Target Server Version : 100509
 File Encoding         : 65001

 Date: 02/10/2023 16:59:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for audits
-- ----------------------------
DROP TABLE IF EXISTS `audits`;
CREATE TABLE `audits`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `audits_auditable_type_auditable_id_index`(`auditable_type`, `auditable_id`) USING BTREE,
  INDEX `audits_user_id_user_type_index`(`user_id`, `user_type`) USING BTREE,
  INDEX `audits_uuid_index`(`uuid`) USING BTREE,
  INDEX `audits_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `audits_project_id_index`(`project_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of audits
-- ----------------------------
INSERT INTO `audits` VALUES (1, NULL, NULL, NULL, NULL, 'App\\User', 1, 'updated', 'App\\User', 1, '{\"remember_token\":\"TKcHbNMFdcmEnuOUOkfezzVZIryXJwPhgBja7qI9U9WHKspemuoGIHDbSETM\"}', '{\"remember_token\":\"oOgs70O82nZS4jqHVXHamFjGxkwe7Of2sFMnAP0CdlcQU4Semre5vMMCnpUd\"}', 'http://localhost:8081/mainframe/public/logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', NULL, '2023-10-02 10:41:53', '2023-10-02 10:41:53');
INSERT INTO `audits` VALUES (2, NULL, NULL, NULL, NULL, 'App\\User', 1, 'created', 'App\\Spread', 1, '[]', '{\"name\":\"users\",\"key\":\"group_ids\",\"module_id\":4,\"element_id\":1,\"element_uuid\":\"3ef9b174-6c7c-41fd-b68e-18d003fb9481\",\"relates_to\":\"App\\\\Group\",\"related_id\":\"1\",\"spreadable_id\":1,\"spreadable_type\":\"App\\\\User\",\"uuid\":\"1d971099-44a8-4219-9851-ab5a52986fc0\",\"created_by\":1,\"updated_by\":1,\"id\":1}', 'http://localhost:8081/mainframe/public/logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', NULL, '2023-10-02 10:41:53', '2023-10-02 10:41:53');

-- ----------------------------
-- Table structure for changes
-- ----------------------------
DROP TABLE IF EXISTS `changes`;
CREATE TABLE `changes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `changeable_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `changeable_type` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `element_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `element_uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `field` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `old` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `new` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `changeable_composite_index`(`changeable_id`, `changeable_type`) USING BTREE,
  INDEX `changes_changeable_id_index`(`changeable_id`) USING BTREE,
  INDEX `changes_changeable_type_index`(`changeable_type`) USING BTREE,
  INDEX `element_composite_index`(`module_id`, `element_id`) USING BTREE,
  INDEX `changes_module_id_index`(`module_id`) USING BTREE,
  INDEX `changes_element_id_index`(`element_id`) USING BTREE,
  INDEX `changes_element_uuid_index`(`element_uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of changes
-- ----------------------------

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `commentable_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `commentable_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `element_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `element_uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for contents
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `parts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'JSON structure for additional dynamic parts',
  `help_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Hint for how/where this is used',
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'tags/spreadable',
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `contents_uuid_index`(`uuid`) USING BTREE,
  INDEX `contents_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `contents_project_id_index`(`project_id`) USING BTREE,
  INDEX `contents_name_index`(`name`) USING BTREE,
  INDEX `contents_slug_index`(`slug`(768)) USING BTREE,
  INDEX `contents_key_index`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contents
-- ----------------------------
INSERT INTO `contents` VALUES (1, 'f30585ef-ca18-4a59-b057-5b0b48a14b92', NULL, NULL, 'test', NULL, NULL, 'test', 'Some test', 'Lets see how it works', '[{\"key\":\"lorem\",\"value\":\"ipsum\"},{\"key\":\"dolor\",\"value\":\"sit\"},{\"key\":\"Some other test\",\"value\":\"Some other value\"}]', NULL, 'tag,me,with,anything', 1, 1, 1, '2021-10-02 04:25:40', '2022-08-21 13:54:47', NULL, NULL);

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `country_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `iso2` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `country_short_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `country_long_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `iso3` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `numcode` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `un_member` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `calling_code` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cctld` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `currency` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `currency_symbol` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `currency_override` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `currency_override_symbol` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 255 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES (1, NULL, NULL, NULL, 'Benin', NULL, NULL, '9999', '24', 'BJ', 'Benin', 'Republic of Benin', 'BEN', '204', 'yes', '229', '.bj', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (2, NULL, NULL, NULL, 'Russia', NULL, NULL, '9999', '182', 'RU', 'Russia', 'Russian Federation', 'RUS', '643', 'yes', '7', '.ru', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (3, NULL, NULL, NULL, 'Norway', NULL, NULL, '9999', '165', 'NO', 'Norway', 'Kingdom of Norway', 'NOR', '578', 'yes', '47', '.no', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (4, NULL, NULL, NULL, 'Burkina Faso', NULL, NULL, '9999', '36', 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', '854', 'yes', '226', '.bf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (5, NULL, NULL, NULL, 'Japan', NULL, NULL, '9999', '111', 'JP', 'Japan', 'Japan', 'JPN', '392', 'yes', '81', '.jp', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (6, NULL, NULL, NULL, 'Slovakia', NULL, NULL, '9999', '201', 'SK', 'Slovakia', 'Slovak Republic', 'SVK', '703', 'yes', '421', '.sk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (7, NULL, NULL, NULL, 'Luxembourg', NULL, NULL, '9999', '128', 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', '442', 'yes', '352', '.lu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (8, NULL, NULL, NULL, 'Malta', NULL, NULL, '9999', '136', 'MT', 'Malta', 'Republic of Malta', 'MLT', '470', 'yes', '356', '.mt', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (9, NULL, NULL, NULL, 'Kazakhstan', NULL, NULL, '9999', '114', 'KZ', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', '398', 'yes', '7', '.kz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (10, NULL, NULL, NULL, 'Iraq', NULL, NULL, '9999', '105', 'IQ', 'Iraq', 'Republic of Iraq', 'IRQ', '368', 'yes', '964', '.iq', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (11, NULL, NULL, NULL, 'Ukraine', NULL, NULL, '9999', '233', 'UA', 'Ukraine', 'Ukraine', 'UKR', '804', 'yes', '380', '.ua', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (12, NULL, NULL, NULL, 'Hungary', NULL, NULL, '9999', '100', 'HU', 'Hungary', 'Hungary', 'HUN', '348', 'yes', '36', '.hu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (13, NULL, NULL, NULL, 'Australia', NULL, NULL, '9999', '14', 'AU', 'Australia', 'Commonwealth of Australia', 'AUS', '36', 'yes', '61', '.au', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (14, NULL, NULL, NULL, 'San Marino', NULL, NULL, '9999', '192', 'SM', 'San Marino', 'Republic of San Marino', 'SMR', '674', 'yes', '378', '.sm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (15, NULL, NULL, NULL, 'Lesotho', NULL, NULL, '9999', '123', 'LS', 'Lesotho', 'Kingdom of Lesotho', 'LSO', '426', 'yes', '266', '.ls', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (16, NULL, NULL, NULL, 'Haiti', NULL, NULL, '9999', '96', 'HT', 'Haiti', 'Republic of Haiti', 'HTI', '332', 'yes', '509', '.ht', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (17, NULL, NULL, NULL, 'Latvia', NULL, NULL, '9999', '121', 'LV', 'Latvia', 'Republic of Latvia', 'LVA', '428', 'yes', '371', '.lv', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (18, NULL, NULL, NULL, 'Vatican City', NULL, NULL, '9999', '241', 'VA', 'Vatican City', 'State of the Vatican City', 'VAT', '336', 'no', '39', '.va', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (19, NULL, NULL, NULL, 'Cambodia', NULL, NULL, '9999', '38', 'KH', 'Cambodia', 'Kingdom of Cambodia', 'KHM', '116', 'yes', '855', '.kh', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (20, NULL, NULL, NULL, 'Yemen', NULL, NULL, '9999', '248', 'YE', 'Yemen', 'Republic of Yemen', 'YEM', '887', 'yes', '967', '.ye', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (21, NULL, NULL, NULL, 'South Korea', NULL, NULL, '9999', '207', 'KR', 'South Korea', 'Republic of Korea', 'KOR', '410', 'yes', '82', '.kr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (22, NULL, NULL, NULL, 'New Zealand', NULL, NULL, '9999', '157', 'NZ', 'New Zealand', 'New Zealand', 'NZL', '554', 'yes', '64', '.nz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (23, NULL, NULL, NULL, 'Afghanistan', NULL, NULL, '9999', '1', 'AF', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', '4', 'yes', '93', '.af', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (24, NULL, NULL, NULL, 'Jamaica', NULL, NULL, '9999', '110', 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (25, NULL, NULL, NULL, 'Heard Island and McDonald Islands', NULL, NULL, '9999', '97', 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', '334', 'no', 'NONE', '.hm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (26, NULL, NULL, NULL, 'Belize', NULL, NULL, '9999', '23', 'BZ', 'Belize', 'Belize', 'BLZ', '84', 'yes', '501', '.bz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (27, NULL, NULL, NULL, 'Netherlands', NULL, NULL, '9999', '155', 'NL', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', '528', 'yes', '31', '.nl', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (28, NULL, NULL, NULL, 'Virgin Islands, British', NULL, NULL, '9999', '244', 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', '92', 'no', '1+284', '.vg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (29, NULL, NULL, NULL, 'Pitcairn', NULL, NULL, '9999', '175', 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (30, NULL, NULL, NULL, 'Timor-Leste (East Timor)', NULL, NULL, '9999', '222', 'TL', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'TLS', '626', 'yes', '670', '.tl', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (31, NULL, NULL, NULL, 'Samoa', NULL, NULL, '9999', '191', 'WS', 'Samoa', 'Independent State of Samoa', 'WSM', '882', 'yes', '685', '.ws', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (32, NULL, NULL, NULL, 'Israel', NULL, NULL, '9999', '108', 'IL', 'Israel', 'State of Israel', 'ISR', '376', 'yes', '972', '.il', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (33, NULL, NULL, NULL, 'Anguilla', NULL, NULL, '9999', '8', 'AI', 'Anguilla', 'Anguilla', 'AIA', '660', 'no', '1+264', '.ai', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (34, NULL, NULL, NULL, 'Swaziland', NULL, NULL, '9999', '214', 'SZ', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', '748', 'yes', '268', '.sz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (35, NULL, NULL, NULL, 'French Polynesia', NULL, NULL, '9999', '78', 'PF', 'French Polynesia', 'French Polynesia', 'PYF', '258', 'no', '689', '.pf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (36, NULL, NULL, NULL, 'Burundi', NULL, NULL, '9999', '37', 'BI', 'Burundi', 'Republic of Burundi', 'BDI', '108', 'yes', '257', '.bi', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (37, NULL, NULL, NULL, 'Northern Mariana Islands', NULL, NULL, '9999', '164', 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', '580', 'no', '1+670', '.mp', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (38, NULL, NULL, NULL, 'Lebanon', NULL, NULL, '9999', '122', 'LB', 'Lebanon', 'Republic of Lebanon', 'LBN', '422', 'yes', '961', '.lb', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (39, NULL, NULL, NULL, 'Thailand', NULL, NULL, '9999', '221', 'TH', 'Thailand', 'Kingdom of Thailand', 'THA', '764', 'yes', '66', '.th', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (40, NULL, NULL, NULL, 'Sao Tome and Principe', NULL, NULL, '9999', '193', 'ST', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'STP', '678', 'yes', '239', '.st', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (41, NULL, NULL, NULL, 'Seychelles', NULL, NULL, '9999', '197', 'SC', 'Seychelles', 'Republic of Seychelles', 'SYC', '690', 'yes', '248', '.sc', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (42, NULL, NULL, NULL, 'Papua New Guinea', NULL, NULL, '9999', '171', 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', '598', 'yes', '675', '.pg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (43, NULL, NULL, NULL, 'Somalia', NULL, NULL, '9999', '204', 'SO', 'Somalia', 'Somali Republic', 'SOM', '706', 'yes', '252', '.so', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (44, NULL, NULL, NULL, 'Namibia', NULL, NULL, '9999', '152', 'NA', 'Namibia', 'Republic of Namibia', 'NAM', '516', 'yes', '264', '.na', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (45, NULL, NULL, NULL, 'Mali', NULL, NULL, '9999', '135', 'ML', 'Mali', 'Republic of Mali', 'MLI', '466', 'yes', '223', '.ml', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (46, NULL, NULL, NULL, 'Mozambique', NULL, NULL, '9999', '150', 'MZ', 'Mozambique', 'Republic of Mozambique', 'MOZ', '508', 'yes', '258', '.mz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (47, NULL, NULL, NULL, 'Cyprus', NULL, NULL, '9999', '58', 'CY', 'Cyprus', 'Republic of Cyprus', 'CYP', '196', 'yes', '357', '.cy', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (48, NULL, NULL, NULL, 'Micronesia', NULL, NULL, '9999', '143', 'FM', 'Micronesia', 'Federated States of Micronesia', 'FSM', '583', 'yes', '691', '.fm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (49, NULL, NULL, NULL, 'France', NULL, NULL, '9999', '76', 'FR', 'France', 'French Republic', 'FRA', '250', 'yes', '33', '.fr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (50, NULL, NULL, NULL, 'Sri Lanka', NULL, NULL, '9999', '210', 'LK', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', '144', 'yes', '94', '.lk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (51, NULL, NULL, NULL, 'Libya', NULL, NULL, '9999', '125', 'LY', 'Libya', 'Libya', 'LBY', '434', 'yes', '218', '.ly', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (52, NULL, NULL, NULL, 'Kenya', NULL, NULL, '9999', '115', 'KE', 'Kenya', 'Republic of Kenya', 'KEN', '404', 'yes', '254', '.ke', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (53, NULL, NULL, NULL, 'Rwanda', NULL, NULL, '9999', '183', 'RW', 'Rwanda', 'Republic of Rwanda', 'RWA', '646', 'yes', '250', '.rw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (54, NULL, NULL, NULL, 'Venezuela', NULL, NULL, '9999', '242', 'VE', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', '862', 'yes', '58', '.ve', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (55, NULL, NULL, NULL, 'Italy', NULL, NULL, '9999', '109', 'IT', 'Italy', 'Italian Republic', 'ITA', '380', 'yes', '39', '.jm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (56, NULL, NULL, NULL, 'Suriname', NULL, NULL, '9999', '212', 'SR', 'Suriname', 'Republic of Suriname', 'SUR', '740', 'yes', '597', '.sr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (57, NULL, NULL, NULL, 'Mauritania', NULL, NULL, '9999', '139', 'MR', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', '478', 'yes', '222', '.mr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (58, NULL, NULL, NULL, 'Aland Islands', NULL, NULL, '9999', '2', 'AX', 'Aland Islands', '&Aring;land Islands', 'ALA', '248', 'no', '358', '.ax', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (59, NULL, NULL, NULL, 'Guadaloupe', NULL, NULL, '9999', '89', 'GP', 'Guadaloupe', 'Guadeloupe', 'GLP', '312', 'no', '590', '.gp', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (60, NULL, NULL, NULL, 'Tanzania', NULL, NULL, '9999', '220', 'TZ', 'Tanzania', 'United Republic of Tanzania', 'TZA', '834', 'yes', '255', '.tz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (61, NULL, NULL, NULL, 'Guam', NULL, NULL, '9999', '90', 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (62, NULL, NULL, NULL, 'Sudan', NULL, NULL, '9999', '211', 'SD', 'Sudan', 'Republic of the Sudan', 'SDN', '729', 'yes', '249', '.sd', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (63, NULL, NULL, NULL, 'Chile', NULL, NULL, '9999', '45', 'CL', 'Chile', 'Republic of Chile', 'CHL', '152', 'yes', '56', '.cl', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (64, NULL, NULL, NULL, 'Germany', NULL, NULL, '9999', '83', 'DE', 'Germany', 'Federal Republic of Germany', 'DEU', '276', 'yes', '49', '.de', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (65, NULL, NULL, NULL, 'Norfolk Island', NULL, NULL, '9999', '162', 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', '574', 'no', '672', '.nf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (66, NULL, NULL, NULL, 'Oman', NULL, NULL, '9999', '166', 'OM', 'Oman', 'Sultanate of Oman', 'OMN', '512', 'yes', '968', '.om', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (67, NULL, NULL, NULL, 'Tunisia', NULL, NULL, '9999', '227', 'TN', 'Tunisia', 'Republic of Tunisia', 'TUN', '788', 'yes', '216', '.tn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (68, NULL, NULL, NULL, 'Turkey', NULL, NULL, '9999', '228', 'TR', 'Turkey', 'Republic of Turkey', 'TUR', '792', 'yes', '90', '.tr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (69, NULL, NULL, NULL, 'China', NULL, NULL, '9999', '46', 'CN', 'China', 'People\'s Republic of China', 'CHN', '156', 'yes', '86', '.cn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (70, NULL, NULL, NULL, 'Tonga', NULL, NULL, '9999', '225', 'TO', 'Tonga', 'Kingdom of Tonga', 'TON', '776', 'yes', '676', '.to', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (71, NULL, NULL, NULL, 'Puerto Rico', NULL, NULL, '9999', '178', 'PR', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', '630', 'no', '1+939', '.pr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (72, NULL, NULL, NULL, 'Uruguay', NULL, NULL, '9999', '238', 'UY', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', '858', 'yes', '598', '.uy', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (73, NULL, NULL, NULL, 'Indonesia', NULL, NULL, '9999', '103', 'ID', 'Indonesia', 'Republic of Indonesia', 'IDN', '360', 'yes', '62', '.id', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (74, NULL, NULL, NULL, 'Niger', NULL, NULL, '9999', '159', 'NE', 'Niger', 'Republic of Niger', 'NER', '562', 'yes', '227', '.ne', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (75, NULL, NULL, NULL, 'Faroe Islands', NULL, NULL, '9999', '73', 'FO', 'Faroe Islands', 'The Faroe Islands', 'FRO', '234', 'no', '298', '.fo', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (76, NULL, NULL, NULL, 'Greece', NULL, NULL, '9999', '86', 'GR', 'Greece', 'Hellenic Republic', 'GRC', '300', 'yes', '30', '.gr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (77, NULL, NULL, NULL, 'Morocco', NULL, NULL, '9999', '149', 'MA', 'Morocco', 'Kingdom of Morocco', 'MAR', '504', 'yes', '212', '.ma', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (78, NULL, NULL, NULL, 'Malaysia', NULL, NULL, '9999', '133', 'MY', 'Malaysia', 'Malaysia', 'MYS', '458', 'yes', '60', '.my', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (79, NULL, NULL, NULL, 'Montenegro', NULL, NULL, '9999', '147', 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (80, NULL, NULL, NULL, 'Sierra Leone', NULL, NULL, '9999', '198', 'SL', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', '694', 'yes', '232', '.sl', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (81, NULL, NULL, NULL, 'Fiji', NULL, NULL, '9999', '74', 'FJ', 'Fiji', 'Republic of Fiji', 'FJI', '242', 'yes', '679', '.fj', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (82, NULL, NULL, NULL, 'Antarctica', NULL, NULL, '9999', '9', 'AQ', 'Antarctica', 'Antarctica', 'ATA', '10', 'no', '672', '.aq', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (83, NULL, NULL, NULL, 'Croatia', NULL, NULL, '9999', '55', 'HR', 'Croatia', 'Republic of Croatia', 'HRV', '191', 'yes', '385', '.hr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (84, NULL, NULL, NULL, 'Andorra', NULL, NULL, '9999', '6', 'AD', 'Andorra', 'Principality of Andorra', 'AND', '20', 'yes', '376', '.ad', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (85, NULL, NULL, NULL, 'Turks and Caicos Islands', NULL, NULL, '9999', '230', 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', '796', 'no', '1+649', '.tc', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (86, NULL, NULL, NULL, 'Western Sahara', NULL, NULL, '9999', '247', 'EH', 'Western Sahara', 'Western Sahara', 'ESH', '732', 'no', '212', '.eh', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (87, NULL, NULL, NULL, 'Ghana', NULL, NULL, '9999', '84', 'GH', 'Ghana', 'Republic of Ghana', 'GHA', '288', 'yes', '233', '.gh', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (88, NULL, NULL, NULL, 'Vanuatu', NULL, NULL, '9999', '240', 'VU', 'Vanuatu', 'Republic of Vanuatu', 'VUT', '548', 'yes', '678', '.vu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (89, NULL, NULL, NULL, 'South Africa', NULL, NULL, '9999', '205', 'ZA', 'South Africa', 'Republic of South Africa', 'ZAF', '710', 'yes', '27', '.za', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (90, NULL, NULL, NULL, 'Guyana', NULL, NULL, '9999', '95', 'GY', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', '328', 'yes', '592', '.gy', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (91, NULL, NULL, NULL, 'Zambia', NULL, NULL, '9999', '249', 'ZM', 'Zambia', 'Republic of Zambia', 'ZMB', '894', 'yes', '260', '.zm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (92, NULL, NULL, NULL, 'Saint Lucia', NULL, NULL, '9999', '187', 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', '662', 'yes', '1+758', '.lc', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (93, NULL, NULL, NULL, 'Eritrea', NULL, NULL, '9999', '69', 'ER', 'Eritrea', 'State of Eritrea', 'ERI', '232', 'yes', '291', '.er', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (94, NULL, NULL, NULL, 'Gabon', NULL, NULL, '9999', '80', 'GA', 'Gabon', 'Gabonese Republic', 'GAB', '266', 'yes', '241', '.ga', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (95, NULL, NULL, NULL, 'Wallis and Futuna', NULL, NULL, '9999', '246', 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', '876', 'no', '681', '.wf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (96, NULL, NULL, NULL, 'South Georgia and the South Sandwich Islands', NULL, NULL, '9999', '206', 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', '239', 'no', '500', '.gs', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (97, NULL, NULL, NULL, 'Paraguay', NULL, NULL, '9999', '172', 'PY', 'Paraguay', 'Republic of Paraguay', 'PRY', '600', 'yes', '595', '.py', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (98, NULL, NULL, NULL, 'Martinique', NULL, NULL, '9999', '138', 'MQ', 'Martinique', 'Martinique', 'MTQ', '474', 'no', '596', '.mq', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (99, NULL, NULL, NULL, 'United Arab Emirates', NULL, NULL, '9999', '234', 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', '784', 'yes', '971', '.ae', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (100, NULL, NULL, NULL, 'Dominican Republic', NULL, NULL, '9999', '64', 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', '214', 'yes', '1+809, 8', '.do', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (101, NULL, NULL, NULL, 'Dominica', NULL, NULL, '9999', '63', 'DM', 'Dominica', 'Commonwealth of Dominica', 'DMA', '212', 'yes', '1+767', '.dm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (102, NULL, NULL, NULL, 'Nepal', NULL, NULL, '9999', '154', 'NP', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', '524', 'yes', '977', '.np', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (103, NULL, NULL, NULL, 'Belarus', NULL, NULL, '9999', '21', 'BY', 'Belarus', 'Republic of Belarus', 'BLR', '112', 'yes', '375', '.by', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (104, NULL, NULL, NULL, 'Equatorial Guinea', NULL, NULL, '9999', '68', 'GQ', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', '226', 'yes', '240', '.gq', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (105, NULL, NULL, NULL, 'North Korea', NULL, NULL, '9999', '163', 'KP', 'North Korea', 'Democratic People\'s Republic of Korea', 'PRK', '408', 'yes', '850', '.kp', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (106, NULL, NULL, NULL, 'Georgia', NULL, NULL, '9999', '82', 'GE', 'Georgia', 'Georgia', 'GEO', '268', 'yes', '995', '.ge', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (107, NULL, NULL, NULL, 'Iceland', NULL, NULL, '9999', '101', 'IS', 'Iceland', 'Republic of Iceland', 'ISL', '352', 'yes', '354', '.is', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (108, NULL, NULL, NULL, 'Costa Rica', NULL, NULL, '9999', '53', 'CR', 'Costa Rica', 'Republic of Costa Rica', 'CRI', '188', 'yes', '506', '.cr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (109, NULL, NULL, NULL, 'Lithuania', NULL, NULL, '9999', '127', 'LT', 'Lithuania', 'Republic of Lithuania', 'LTU', '440', 'yes', '370', '.lt', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (110, NULL, NULL, NULL, 'Tajikistan', NULL, NULL, '9999', '219', 'TJ', 'Tajikistan', 'Republic of Tajikistan', 'TJK', '762', 'yes', '992', '.tj', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (111, NULL, NULL, NULL, 'Macao', NULL, NULL, '9999', '129', 'MO', 'Macao', 'The Macao Special Administrative Region', 'MAC', '446', 'no', '853', '.mo', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (112, NULL, NULL, NULL, 'Djibouti', NULL, NULL, '9999', '62', 'DJ', 'Djibouti', 'Republic of Djibouti', 'DJI', '262', 'yes', '253', '.dj', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (113, NULL, NULL, NULL, 'Austria', NULL, NULL, '9999', '15', 'AT', 'Austria', 'Republic of Austria', 'AUT', '40', 'yes', '43', '.at', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (114, NULL, NULL, NULL, 'Mexico', NULL, NULL, '9999', '142', 'MX', 'Mexico', 'United Mexican States', 'MEX', '484', 'yes', '52', '.mx', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (115, NULL, NULL, NULL, 'Tokelau', NULL, NULL, '9999', '224', 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (116, NULL, NULL, NULL, 'Poland', NULL, NULL, '9999', '176', 'PL', 'Poland', 'Republic of Poland', 'POL', '616', 'yes', '48', '.pl', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (117, NULL, NULL, NULL, 'Gibraltar', NULL, NULL, '9999', '85', 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (118, NULL, NULL, NULL, 'Romania', NULL, NULL, '9999', '181', 'RO', 'Romania', 'Romania', 'ROU', '642', 'yes', '40', '.ro', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (119, NULL, NULL, NULL, 'Uganda', NULL, NULL, '9999', '232', 'UG', 'Uganda', 'Republic of Uganda', 'UGA', '800', 'yes', '256', '.ug', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (120, NULL, NULL, NULL, 'Syria', NULL, NULL, '9999', '217', 'SY', 'Syria', 'Syrian Arab Republic', 'SYR', '760', 'yes', '963', '.sy', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (121, NULL, NULL, NULL, 'India', NULL, NULL, '9999', '102', 'IN', 'India', 'Republic of India', 'IND', '356', 'yes', '91', '.in', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (122, NULL, NULL, NULL, 'Cayman Islands', NULL, NULL, '9999', '42', 'KY', 'Cayman Islands', 'The Cayman Islands', 'CYM', '136', 'no', '1+345', '.ky', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (123, NULL, NULL, NULL, 'Kyrgyzstan', NULL, NULL, '9999', '119', 'KG', 'Kyrgyzstan', 'Kyrgyz Republic', 'KGZ', '417', 'yes', '996', '.kg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (124, NULL, NULL, NULL, 'Greenland', NULL, NULL, '9999', '87', 'GL', 'Greenland', 'Greenland', 'GRL', '304', 'no', '299', '.gl', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (125, NULL, NULL, NULL, 'Guinea-Bissau', NULL, NULL, '9999', '94', 'GW', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', '624', 'yes', '245', '.gw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (126, NULL, NULL, NULL, 'Azerbaijan', NULL, NULL, '9999', '16', 'AZ', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', '31', 'yes', '994', '.az', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (127, NULL, NULL, NULL, 'Portugal', NULL, NULL, '9999', '177', 'PT', 'Portugal', 'Portuguese Republic', 'PRT', '620', 'yes', '351', '.pt', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (128, NULL, NULL, NULL, 'Cameroon', NULL, NULL, '9999', '39', 'CM', 'Cameroon', 'Republic of Cameroon', 'CMR', '120', 'yes', '237', '.cm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (129, NULL, NULL, NULL, 'Saint Barthelemy', NULL, NULL, '9999', '184', 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', 'BLM', '652', 'no', '590', '.bl', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (130, NULL, NULL, NULL, 'Denmark', NULL, NULL, '9999', '61', 'DK', 'Denmark', 'Kingdom of Denmark', 'DNK', '208', 'yes', '45', '.dk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (131, NULL, NULL, NULL, 'Niue', NULL, NULL, '9999', '161', 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (132, NULL, NULL, NULL, 'Bhutan', NULL, NULL, '9999', '26', 'BT', 'Bhutan', 'Kingdom of Bhutan', 'BTN', '64', 'yes', '975', '.bt', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (133, NULL, NULL, NULL, 'Aruba', NULL, NULL, '9999', '13', 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (134, NULL, NULL, NULL, 'Turkmenistan', NULL, NULL, '9999', '229', 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', '795', 'yes', '993', '.tm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (135, NULL, NULL, NULL, 'Liechtenstein', NULL, NULL, '9999', '126', 'LI', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', '438', 'yes', '423', '.li', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (136, NULL, NULL, NULL, 'Tuvalu', NULL, NULL, '9999', '231', 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (137, NULL, NULL, NULL, 'Democratic Republic of the Congo', NULL, NULL, '9999', '60', 'CD', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', 'COD', '180', 'yes', '243', '.cd', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (138, NULL, NULL, NULL, 'Chad', NULL, NULL, '9999', '44', 'TD', 'Chad', 'Republic of Chad', 'TCD', '148', 'yes', '235', '.td', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (139, NULL, NULL, NULL, 'Bahamas', NULL, NULL, '9999', '17', 'BS', 'Bahamas', 'Commonwealth of The Bahamas', 'BHS', '44', 'yes', '1+242', '.bs', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (140, NULL, NULL, NULL, 'Falkland Islands (Malvinas)', NULL, NULL, '9999', '72', 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', 'FLK', '238', 'no', '500', '.fk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (141, NULL, NULL, NULL, 'Kiribati', NULL, NULL, '9999', '116', 'KI', 'Kiribati', 'Republic of Kiribati', 'KIR', '296', 'yes', '686', '.ki', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (142, NULL, NULL, NULL, 'Antigua and Barbuda', NULL, NULL, '9999', '10', 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', '28', 'yes', '1+268', '.ag', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (143, NULL, NULL, NULL, 'Ireland', NULL, NULL, '9999', '106', 'IE', 'Ireland', 'Ireland', 'IRL', '372', 'yes', '353', '.ie', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (144, NULL, NULL, NULL, 'Armenia', NULL, NULL, '9999', '12', 'AM', 'Armenia', 'Republic of Armenia', 'ARM', '51', 'yes', '374', '.am', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (145, NULL, NULL, NULL, 'Uzbekistan', NULL, NULL, '9999', '239', 'UZ', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', '860', 'yes', '998', '.uz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (146, NULL, NULL, NULL, 'Palestine', NULL, NULL, '9999', '169', 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', 'PSE', '275', 'some', '970', '.ps', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (147, NULL, NULL, NULL, 'Spain', NULL, NULL, '9999', '209', 'ES', 'Spain', 'Kingdom of Spain', 'ESP', '724', 'yes', '34', '.es', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (148, NULL, NULL, NULL, 'Curacao', NULL, NULL, '9999', '57', 'CW', 'Curacao', 'Cura&ccedil;ao', 'CUW', '531', 'no', '599', '.cw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (149, NULL, NULL, NULL, 'Bolivia', NULL, NULL, '9999', '27', 'BO', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', '68', 'yes', '591', '.bo', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (150, NULL, NULL, NULL, 'Estonia', NULL, NULL, '9999', '70', 'EE', 'Estonia', 'Republic of Estonia', 'EST', '233', 'yes', '372', '.ee', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (151, NULL, NULL, NULL, 'Hong Kong', NULL, NULL, '9999', '99', 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (152, NULL, NULL, NULL, 'Algeria', NULL, NULL, '9999', '4', 'DZ', 'Algeria', 'People\'s Democratic Republic of Algeria', 'DZA', '12', 'yes', '213', '.dz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (153, NULL, NULL, NULL, 'Brunei', NULL, NULL, '9999', '34', 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '96', 'yes', '673', '.bn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (154, NULL, NULL, NULL, 'Barbados', NULL, NULL, '9999', '20', 'BB', 'Barbados', 'Barbados', 'BRB', '52', 'yes', '1+246', '.bb', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (155, NULL, NULL, NULL, 'Laos', NULL, NULL, '9999', '120', 'LA', 'Laos', 'Lao People\'s Democratic Republic', 'LAO', '418', 'yes', '856', '.la', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (156, NULL, NULL, NULL, 'Bahrain', NULL, NULL, '9999', '18', 'BH', 'Bahrain', 'Kingdom of Bahrain', 'BHR', '48', 'yes', '973', '.bh', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (157, NULL, NULL, NULL, 'Macedonia', NULL, NULL, '9999', '130', 'MK', 'Macedonia', 'The Former Yugoslav Republic of Macedonia', 'MKD', '807', 'yes', '389', '.mk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (158, NULL, NULL, NULL, 'Bermuda', NULL, NULL, '9999', '25', 'BM', 'Bermuda', 'Bermuda Islands', 'BMU', '60', 'no', '1+441', '.bm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (159, NULL, NULL, NULL, 'Gambia', NULL, NULL, '9999', '81', 'GM', 'Gambia', 'Republic of The Gambia', 'GMB', '270', 'yes', '220', '.gm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (160, NULL, NULL, NULL, 'Senegal', NULL, NULL, '9999', '195', 'SN', 'Senegal', 'Republic of Senegal', 'SEN', '686', 'yes', '221', '.sn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (161, NULL, NULL, NULL, 'Guinea', NULL, NULL, '9999', '93', 'GN', 'Guinea', 'Republic of Guinea', 'GIN', '324', 'yes', '224', '.gn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (162, NULL, NULL, NULL, 'Grenada', NULL, NULL, '9999', '88', 'GD', 'Grenada', 'Grenada', 'GRD', '308', 'yes', '1+473', '.gd', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (163, NULL, NULL, NULL, 'Madagascar', NULL, NULL, '9999', '131', 'MG', 'Madagascar', 'Republic of Madagascar', 'MDG', '450', 'yes', '261', '.mg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (164, NULL, NULL, NULL, 'Iran', NULL, NULL, '9999', '104', 'IR', 'Iran', 'Islamic Republic of Iran', 'IRN', '364', 'yes', '98', '.ir', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (165, NULL, NULL, NULL, 'American Samoa', NULL, NULL, '9999', '5', 'AS', 'American Samoa', 'American Samoa', 'ASM', '16', 'no', '1+684', '.as', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (166, NULL, NULL, NULL, 'Mauritius', NULL, NULL, '9999', '140', 'MU', 'Mauritius', 'Republic of Mauritius', 'MUS', '480', 'yes', '230', '.mu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (167, NULL, NULL, NULL, 'Panama', NULL, NULL, '9999', '170', 'PA', 'Panama', 'Republic of Panama', 'PAN', '591', 'yes', '507', '.pa', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (168, NULL, NULL, NULL, 'Argentina', NULL, NULL, '9999', '11', 'AR', 'Argentina', 'Argentine Republic', 'ARG', '32', 'yes', '54', '.ar', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (169, NULL, NULL, NULL, 'Jordan', NULL, NULL, '9999', '113', 'JO', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', '400', 'yes', '962', '.jo', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (170, NULL, NULL, NULL, 'Nauru', NULL, NULL, '9999', '153', 'NR', 'Nauru', 'Republic of Nauru', 'NRU', '520', 'yes', '674', '.nr', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (171, NULL, NULL, NULL, 'Slovenia', NULL, NULL, '9999', '202', 'SI', 'Slovenia', 'Republic of Slovenia', 'SVN', '705', 'yes', '386', '.si', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (172, NULL, NULL, NULL, 'Reunion', NULL, NULL, '9999', '180', 'RE', 'Reunion', 'R&eacute;union', 'REU', '638', 'no', '262', '.re', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (173, NULL, NULL, NULL, 'Mayotte', NULL, NULL, '9999', '141', 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (174, NULL, NULL, NULL, 'Marshall Islands', NULL, NULL, '9999', '137', 'MH', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', '584', 'yes', '692', '.mh', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (175, NULL, NULL, NULL, 'Bonaire, Sint Eustatius and Saba', NULL, NULL, '9999', '28', 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'no', '599', '.bq', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (176, NULL, NULL, NULL, 'Kuwait', NULL, NULL, '9999', '118', 'KW', 'Kuwait', 'State of Kuwait', 'KWT', '414', 'yes', '965', '.kw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (177, NULL, NULL, NULL, 'Vietnam', NULL, NULL, '9999', '243', 'VN', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', '704', 'yes', '84', '.vn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (178, NULL, NULL, NULL, 'Ethiopia', NULL, NULL, '9999', '71', 'ET', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', '231', 'yes', '251', '.et', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (179, NULL, NULL, NULL, 'Bulgaria', NULL, NULL, '9999', '35', 'BG', 'Bulgaria', 'Republic of Bulgaria', 'BGR', '100', 'yes', '359', '.bg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (180, NULL, NULL, NULL, 'Taiwan', NULL, NULL, '9999', '218', 'TW', 'Taiwan', 'Republic of China (Taiwan)', 'TWN', '158', 'former', '886', '.tw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (181, NULL, NULL, NULL, 'Guernsey', NULL, NULL, '9999', '92', 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (182, NULL, NULL, NULL, 'Comoros', NULL, NULL, '9999', '50', 'KM', 'Comoros', 'Union of the Comoros', 'COM', '174', 'yes', '269', '.km', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (183, NULL, NULL, NULL, 'Jersey', NULL, NULL, '9999', '112', 'JE', 'Jersey', 'The Bailiwick of Jersey', 'JEY', '832', 'no', '44', '.je', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (184, NULL, NULL, NULL, 'Botswana', NULL, NULL, '9999', '30', 'BW', 'Botswana', 'Republic of Botswana', 'BWA', '72', 'yes', '267', '.bw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (185, NULL, NULL, NULL, 'Ecuador', NULL, NULL, '9999', '65', 'EC', 'Ecuador', 'Republic of Ecuador', 'ECU', '218', 'yes', '593', '.ec', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (186, NULL, NULL, NULL, 'Saudi Arabia', NULL, NULL, '9999', '194', 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', '682', 'yes', '966', '.sa', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (187, NULL, NULL, NULL, 'UK (United Kingdom)', NULL, NULL, '2', '235', 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', 'GBR', '826', 'yes', '44', '.uk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'GBP', '£', 'GBP', '£');
INSERT INTO `countries` VALUES (188, NULL, NULL, NULL, 'Finland', NULL, NULL, '9999', '75', 'FI', 'Finland', 'Republic of Finland', 'FIN', '246', 'yes', '358', '.fi', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (189, NULL, NULL, NULL, 'Mongolia', NULL, NULL, '9999', '146', 'MN', 'Mongolia', 'Mongolia', 'MNG', '496', 'yes', '976', '.mn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (190, NULL, NULL, NULL, 'Colombia', NULL, NULL, '9999', '49', 'CO', 'Colombia', 'Republic of Colombia', 'COL', '170', 'yes', '57', '.co', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (191, NULL, NULL, NULL, 'Saint Martin', NULL, NULL, '9999', '188', 'MF', 'Saint Martin', 'Saint Martin', 'MAF', '663', 'no', '590', '.mf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (192, NULL, NULL, NULL, 'Switzerland', NULL, NULL, '9999', '216', 'CH', 'Switzerland', 'Swiss Confederation', 'CHE', '756', 'yes', '41', '.ch', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (193, NULL, NULL, NULL, 'Svalbard and Jan Mayen', NULL, NULL, '9999', '213', 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', '744', 'no', '47', '.sj', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (194, NULL, NULL, NULL, 'Nicaragua', NULL, NULL, '9999', '158', 'NI', 'Nicaragua', 'Republic of Nicaragua', 'NIC', '558', 'yes', '505', '.ni', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (195, NULL, NULL, NULL, 'Christmas Island', NULL, NULL, '9999', '47', 'CX', 'Christmas Island', 'Christmas Island', 'CXR', '162', 'no', '61', '.cx', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (196, NULL, NULL, NULL, 'Moldava', NULL, NULL, '9999', '144', 'MD', 'Moldava', 'Republic of Moldova', 'MDA', '498', 'yes', '373', '.md', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (197, NULL, NULL, NULL, 'Bouvet Island', NULL, NULL, '9999', '31', 'BV', 'Bouvet Island', 'Bouvet Island', 'BVT', '74', 'no', 'NONE', '.bv', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (198, NULL, NULL, NULL, 'United States Minor Outlying Islands', NULL, NULL, '9999', '237', 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', '581', 'no', 'NONE', 'NONE', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (199, NULL, NULL, NULL, 'Saint Kitts and Nevis', NULL, NULL, '9999', '186', 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', 'KNA', '659', 'yes', '1+869', '.kn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (200, NULL, NULL, NULL, 'US (United States)', NULL, NULL, '1', '236', 'US', 'United States', 'United States of America', 'USA', '840', 'yes', '1', '.us', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (201, NULL, NULL, NULL, 'Singapore', NULL, NULL, '9999', '199', 'SG', 'Singapore', 'Republic of Singapore', 'SGP', '702', 'yes', '65', '.sg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (202, NULL, NULL, NULL, 'Belgium', NULL, NULL, '9999', '22', 'BE', 'Belgium', 'Kingdom of Belgium', 'BEL', '56', 'yes', '32', '.be', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (203, NULL, NULL, NULL, 'Solomon Islands', NULL, NULL, '9999', '203', 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', '90', 'yes', '677', '.sb', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (204, NULL, NULL, NULL, 'Saint Helena', NULL, NULL, '9999', '185', 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', '654', 'no', '290', '.sh', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (205, NULL, NULL, NULL, 'Serbia', NULL, NULL, '9999', '196', 'RS', 'Serbia', 'Republic of Serbia', 'SRB', '688', 'yes', '381', '.rs', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (206, NULL, NULL, NULL, 'New Caledonia', NULL, NULL, '9999', '156', 'NC', 'New Caledonia', 'New Caledonia', 'NCL', '540', 'no', '687', '.nc', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (207, NULL, NULL, NULL, 'Congo', NULL, NULL, '9999', '51', 'CG', 'Congo', 'Republic of the Congo', 'COG', '178', 'yes', '242', '.cg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (208, NULL, NULL, NULL, 'Sint Maarten', NULL, NULL, '9999', '200', 'SX', 'Sint Maarten', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (209, NULL, NULL, NULL, 'Malawi', NULL, NULL, '9999', '132', 'MW', 'Malawi', 'Republic of Malawi', 'MWI', '454', 'yes', '265', '.mw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (210, NULL, NULL, NULL, 'Honduras', NULL, NULL, '9999', '98', 'HN', 'Honduras', 'Republic of Honduras', 'HND', '340', 'yes', '504', '.hn', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (211, NULL, NULL, NULL, 'Albania', NULL, NULL, '9999', '3', 'AL', 'Albania', 'Republic of Albania', 'ALB', '8', 'yes', '355', '.al', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (212, NULL, NULL, NULL, 'Monaco', NULL, NULL, '9999', '145', 'MC', 'Monaco', 'Principality of Monaco', 'MCO', '492', 'yes', '377', '.mc', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (213, NULL, NULL, NULL, 'Angola', NULL, NULL, '9999', '7', 'AO', 'Angola', 'Republic of Angola', 'AGO', '24', 'yes', '244', '.ao', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (214, NULL, NULL, NULL, 'Canada', NULL, NULL, '9999', '40', 'CA', 'Canada', 'Canada', 'CAN', '124', 'yes', '1', '.ca', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (215, NULL, NULL, NULL, 'Qatar', NULL, NULL, '9999', '179', 'QA', 'Qatar', 'State of Qatar', 'QAT', '634', 'yes', '974', '.qa', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (216, NULL, NULL, NULL, 'Togo', NULL, NULL, '9999', '223', 'TG', 'Togo', 'Togolese Republic', 'TGO', '768', 'yes', '228', '.tg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (217, NULL, NULL, NULL, 'Myanmar (Burma)', NULL, NULL, '9999', '151', 'MM', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', 'MMR', '104', 'yes', '95', '.mm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (218, NULL, NULL, NULL, 'Czech Republic', NULL, NULL, '9999', '59', 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', '203', 'yes', '420', '.cz', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (219, NULL, NULL, NULL, 'Montserrat', NULL, NULL, '9999', '148', 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (220, NULL, NULL, NULL, 'Pakistan', NULL, NULL, '9999', '167', 'PK', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', '586', 'yes', '92', '.pk', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (221, NULL, NULL, NULL, 'Cocos (Keeling) Islands', NULL, NULL, '9999', '48', 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', '166', 'no', '61', '.cc', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (222, NULL, NULL, NULL, 'Egypt', NULL, NULL, '9999', '66', 'EG', 'Egypt', 'Arab Republic of Egypt', 'EGY', '818', 'yes', '20', '.eg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (223, NULL, NULL, NULL, 'Virgin Islands, US', NULL, NULL, '9999', '245', 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States', 'VIR', '850', 'no', '1+340', '.vi', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (224, NULL, NULL, NULL, 'Saint Pierre and Miquelon', NULL, NULL, '9999', '189', 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', '666', 'no', '508', '.pm', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (225, NULL, NULL, NULL, 'Nigeria', NULL, NULL, '9999', '160', 'NG', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', '566', 'yes', '234', '.ng', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (226, NULL, NULL, NULL, 'Peru', NULL, NULL, '9999', '173', 'PE', 'Peru', 'Republic of Peru', 'PER', '604', 'yes', '51', '.pe', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (227, NULL, NULL, NULL, 'British Indian Ocean Territory', NULL, NULL, '9999', '33', 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', '86', 'no', '246', '.io', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (228, NULL, NULL, NULL, 'Cape Verde', NULL, NULL, '9999', '41', 'CV', 'Cape Verde', 'Republic of Cape Verde', 'CPV', '132', 'yes', '238', '.cv', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (229, NULL, NULL, NULL, 'Bosnia and Herzegovina', NULL, NULL, '9999', '29', 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', '70', 'yes', '387', '.ba', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (230, NULL, NULL, NULL, 'Cuba', NULL, NULL, '9999', '56', 'CU', 'Cuba', 'Republic of Cuba', 'CUB', '192', 'yes', '53', '.cu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (231, NULL, NULL, NULL, 'Central African Republic', NULL, NULL, '9999', '43', 'CF', 'Central African Republic', 'Central African Republic', 'CAF', '140', 'yes', '236', '.cf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (232, NULL, NULL, NULL, 'Guatemala', NULL, NULL, '9999', '91', 'GT', 'Guatemala', 'Republic of Guatemala', 'GTM', '320', 'yes', '502', '.gt', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (233, NULL, NULL, NULL, 'Cook Islands', NULL, NULL, '9999', '52', 'CK', 'Cook Islands', 'Cook Islands', 'COK', '184', 'some', '682', '.ck', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (234, NULL, NULL, NULL, 'Sweden', NULL, NULL, '9999', '215', 'SE', 'Sweden', 'Kingdom of Sweden', 'SWE', '752', 'yes', '46', '.se', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (235, NULL, NULL, NULL, 'French Guiana', NULL, NULL, '9999', '77', 'GF', 'French Guiana', 'French Guiana', 'GUF', '254', 'no', '594', '.gf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (236, NULL, NULL, NULL, 'Palau', NULL, NULL, '9999', '168', 'PW', 'Palau', 'Republic of Palau', 'PLW', '585', 'yes', '680', '.pw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (237, NULL, NULL, NULL, 'Phillipines', NULL, NULL, '9999', '174', 'PH', 'Phillipines', 'Republic of the Philippines', 'PHL', '608', 'yes', '63', '.ph', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (238, NULL, NULL, NULL, 'Trinidad and Tobago', NULL, NULL, '9999', '226', 'TT', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', '780', 'yes', '1+868', '.tt', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (239, NULL, NULL, NULL, 'Maldives', NULL, NULL, '9999', '134', 'MV', 'Maldives', 'Republic of Maldives', 'MDV', '462', 'yes', '960', '.mv', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (240, NULL, NULL, NULL, 'Isle of Man', NULL, NULL, '9999', '107', 'IM', 'Isle of Man', 'Isle of Man', 'IMN', '833', 'no', '44', '.im', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (241, NULL, NULL, NULL, 'Brazil', NULL, NULL, '9999', '32', 'BR', 'Brazil', 'Federative Republic of Brazil', 'BRA', '76', 'yes', '55', '.br', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (242, NULL, NULL, NULL, 'Bangladesh', NULL, NULL, '9999', '19', 'BD', 'Bangladesh', 'People\'s Republic of Bangladesh', 'BGD', '50', 'yes', '880', '.bd', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (243, NULL, NULL, NULL, 'French Southern Territories', NULL, NULL, '9999', '79', 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', NULL, '.tf', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (244, 'c2c978b0-06e2-4db9-901b-e86ae1cc850b', NULL, NULL, 'Liberia', NULL, NULL, '9999', '124', 'LR', 'Liberia', 'Republic of Liberia', 'LBR', '430', 'yes', '231', '.lr', 1, 1, 1, '2020-01-08 15:17:08', '2020-01-08 15:17:08', NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (245, NULL, NULL, NULL, 'Saint Vincent and the Grenadines', NULL, NULL, '9999', '190', 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', '670', 'yes', '1+784', '.vc', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (246, NULL, NULL, NULL, 'Zimbabwe', NULL, NULL, '9999', '250', 'ZW', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', '716', 'yes', '263', '.zw', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (247, NULL, NULL, NULL, 'El Salvador', NULL, NULL, '9999', '67', 'SV', 'El Salvador', 'Republic of El Salvador', 'SLV', '222', 'yes', '503', '.sv', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (248, NULL, NULL, NULL, 'South Sudan', NULL, NULL, '9999', '208', 'SS', 'South Sudan', 'Republic of South Sudan', 'SSD', '728', 'yes', '211', '.ss', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (249, NULL, NULL, NULL, 'Kosovo', NULL, NULL, '9999', '117', 'XK', 'Kosovo', 'Republic of Kosovo', '---', '0', 'some', '381', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (250, NULL, NULL, NULL, 'Cote d\'ivoire (Ivory Coast)', NULL, NULL, '9999', '54', 'CI', 'Cote d\'ivoire (Ivory Coast)', 'Republic of C&ocirc;te D\'Ivoire (Ivory Coast)', 'CIV', '384', 'yes', '225', '.ci', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (251, '2f6287bd-1bee-442e-9207-7ca4490f9552', NULL, NULL, 'Europe', NULL, NULL, '9999', NULL, NULL, 'Europe', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2019-01-22 11:26:33', '2019-01-22 11:26:33', NULL, NULL, 'EUR', '€', 'EUR', '€');
INSERT INTO `countries` VALUES (252, 'ff2697d0-c886-45b7-9437-01b998ab50cc', NULL, NULL, 'Rest of the World', NULL, NULL, '9999', NULL, NULL, 'Rest of the World', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2019-01-22 11:27:06', '2019-01-22 11:27:06', NULL, NULL, 'USD', '$', 'USD', '$');
INSERT INTO `countries` VALUES (253, 'c5220793-86dd-4f5f-9217-ce554dfd66f7', NULL, NULL, 'georgia test', NULL, NULL, '9999', NULL, NULL, 'georgia test', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, '2019-01-25 12:44:08', '2019-02-18 09:13:57', '2019-02-18 09:13:57', NULL, 'Pounds', '£', NULL, NULL);
INSERT INTO `countries` VALUES (254, 'cfbbadca-94e6-49fd-8182-a02a89df8efb', NULL, NULL, 'Test', NULL, NULL, '9999', NULL, NULL, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, '2019-02-28 12:34:46', '2019-02-28 12:34:55', '2019-02-28 12:34:55', NULL, 'GBP', '£', 'GBP', '£');

-- ----------------------------
-- Table structure for emails
-- ----------------------------
DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_sl` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `to` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bcc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `html` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `attempts` int(10) UNSIGNED NULL DEFAULT NULL,
  `last_attempted_at` datetime NULL DEFAULT NULL,
  `successfully_delivered_at` datetime NULL DEFAULT NULL,
  `to_user_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `module_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `element_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `emailable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `emailable_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `attachments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `emails_uuid_index`(`uuid`) USING BTREE,
  INDEX `emails_project_id_index`(`project_id`) USING BTREE,
  INDEX `emails_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `emails_tenant_sl_index`(`tenant_sl`) USING BTREE,
  INDEX `emails_name_index`(`name`) USING BTREE,
  INDEX `emails_name_ext_index`(`name_ext`) USING BTREE,
  INDEX `emails_slug_index`(`slug`) USING BTREE,
  INDEX `emails_status_name_index`(`status_name`) USING BTREE,
  INDEX `emails_to_user_id_index`(`to_user_id`) USING BTREE,
  INDEX `emails_module_id_index`(`module_id`) USING BTREE,
  INDEX `emails_element_id_index`(`element_id`) USING BTREE,
  INDEX `emails_emailable_type_index`(`emailable_type`) USING BTREE,
  INDEX `emails_emailable_id_index`(`emailable_id`) USING BTREE,
  INDEX `emails_created_by_index`(`created_by`) USING BTREE,
  INDEX `emails_updated_by_index`(`updated_by`) USING BTREE,
  INDEX `emails_deleted_by_index`(`deleted_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 187 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of emails
-- ----------------------------
INSERT INTO `emails` VALUES (18, '4dbc408e-944b-4bbf-af14-d871c07fa30d', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:34:57', 'MF 9 Test Email at 2023-02-02 11:34:57', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', NULL, NULL, NULL, NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:34:57', '2023-02-02 11:34:57', NULL, NULL);
INSERT INTO `emails` VALUES (19, 'd6f69ae6-a1e0-4454-881c-db19c1b3e873', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:35:39', 'MF 9 Test Email at 2023-02-02 11:35:39', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 11:35:39', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:35:39', '2023-02-02 11:35:39', NULL, NULL);
INSERT INTO `emails` VALUES (20, 'f7f78dc1-42d6-498a-891e-3d9f31475cf0', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:37:37', 'MF 9 Test Email at 2023-02-02 11:37:37', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 11:37:37', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:37:37', '2023-02-02 11:37:37', NULL, NULL);
INSERT INTO `emails` VALUES (21, '363a1aff-c0da-4433-84fc-add33492802b', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:47:30', 'MF 9 Test Email at 2023-02-02 11:47:30', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 11:47:30', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:47:30', '2023-02-02 11:47:30', NULL, NULL);
INSERT INTO `emails` VALUES (22, '88e47de3-1c20-4dc3-8af1-88983cb58244', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:50:11', 'MF 9 Test Email at 2023-02-02 11:50:11', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', NULL, NULL, NULL, NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:50:11', '2023-02-02 11:50:11', NULL, NULL);
INSERT INTO `emails` VALUES (23, '6b293441-c9df-4645-962c-6a3f0a172a55', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:50:39', 'MF 9 Test Email at 2023-02-02 11:50:39', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', NULL, NULL, NULL, NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:50:39', '2023-02-02 11:50:39', NULL, NULL);
INSERT INTO `emails` VALUES (24, 'dcd2a2f6-004d-4126-9c85-cff9cac17ed3', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:51:43', 'MF 9 Test Email at 2023-02-02 11:51:43', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 11:51:43', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:51:43', '2023-02-02 11:51:43', NULL, NULL);
INSERT INTO `emails` VALUES (25, '0ca2fbb7-b898-4c43-a426-9641f6707f08', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:51:47', 'MF 9 Test Email at 2023-02-02 11:51:47', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 11:51:47', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:51:47', '2023-02-02 11:51:47', NULL, NULL);
INSERT INTO `emails` VALUES (26, '218cb116-a716-4c00-888e-4d457559885b', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 11:56:39', 'MF 9 Test Email at 2023-02-02 11:56:39', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 11:56:40', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 11:56:39', '2023-02-02 11:56:40', NULL, NULL);
INSERT INTO `emails` VALUES (27, 'd3857bd7-9f17-4f46-ac4d-2564efaa7102', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 14:36:04', 'MF 9 Test Email at 2023-02-02 14:36:04', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:36:04', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:36:04', '2023-02-02 14:36:04', NULL, NULL);
INSERT INTO `emails` VALUES (28, '6e3fd14d-7f5a-45c6-8fb2-ea88801343a7', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 14:39:03', 'MF 9 Test Email at 2023-02-02 14:39:03', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:39:03', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:39:03', '2023-02-02 14:39:03', NULL, NULL);
INSERT INTO `emails` VALUES (29, 'eb4c67df-7d90-4d6e-8dfe-0c7cf0b4f079', NULL, NULL, NULL, 'MF 9 Test Email at 2023-02-02 14:40:26', 'MF 9 Test Email at 2023-02-02 14:40:26', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'MF 9 Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:40:31', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:40:26', '2023-02-02 14:40:31', NULL, NULL);
INSERT INTO `emails` VALUES (30, '4a9cac05-1d07-4db1-abaf-ce6dec7f2822', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:41:49', 'Test Email at 2023-02-02 14:41:49', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:41:52', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:41:49', '2023-02-02 14:41:52', NULL, NULL);
INSERT INTO `emails` VALUES (31, '5cca06f9-4652-4ff7-8d3f-3cf88c005a61', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:42:06', 'Test Email at 2023-02-02 14:42:06', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:42:07', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:42:06', '2023-02-02 14:42:07', NULL, NULL);
INSERT INTO `emails` VALUES (32, 'c4b4cfcc-bf03-44db-b40d-26cc4087a741', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:42:25', 'Test Email at 2023-02-02 14:42:25', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:42:31', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:42:25', '2023-02-02 14:42:31', NULL, NULL);
INSERT INTO `emails` VALUES (33, '90e53d24-707c-41f8-8e42-1851099b79bd', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:46:16', 'Test Email at 2023-02-02 14:46:16', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nillum-qui-voluptatibus-aut-repellat\r\n', 'Sent', 1, '2023-02-02 14:46:16', NULL, NULL, 7, 1341, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:46:16', '2023-02-02 14:46:16', NULL, NULL);
INSERT INTO `emails` VALUES (34, '8964a07b-7558-468b-92cb-2a1e13d086d3', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:46:17', 'Test Email at 2023-02-02 14:46:17', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nsaepe-unde-unde-est-corrupti-et-possimus-qui\r\n', 'Sent', 1, '2023-02-02 14:46:17', NULL, NULL, 7, 1342, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:46:17', '2023-02-02 14:46:17', NULL, NULL);
INSERT INTO `emails` VALUES (35, '72139269-e86c-4196-9a99-fb9e62a6bc44', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:46:18', 'Test Email at 2023-02-02 14:46:18', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nsaepe-unde-unde-est-corrupti-et-possimus-qui\r\n', 'Sent', 1, '2023-02-02 14:46:18', NULL, NULL, 7, 1342, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:46:18', '2023-02-02 14:46:18', NULL, NULL);
INSERT INTO `emails` VALUES (36, 'b488515b-4fe2-4056-9054-47530dd2ecfe', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:46:34', 'Test Email at 2023-02-02 14:46:34', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:46:34', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:46:34', '2023-02-02 14:46:34', NULL, NULL);
INSERT INTO `emails` VALUES (37, '492f123e-3f32-4666-9f32-b51f708d2884', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:46:38', 'Test Email at 2023-02-02 14:46:38', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-02-02 14:46:38', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:46:38', '2023-02-02 14:46:38', NULL, NULL);
INSERT INTO `emails` VALUES (38, '8d0cd11e-10d2-486d-bf00-107b91344c3b', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:46:46', 'Test Email at 2023-02-02 14:46:46', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nsapiente-amet-dolores-quis-eum-vel-expedita\r\n', 'Sent', 1, '2023-02-02 14:46:46', NULL, NULL, 7, 1343, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:46:46', '2023-02-02 14:46:46', NULL, NULL);
INSERT INTO `emails` VALUES (39, '0a463c2a-9d33-42e5-bfd2-e20e4d19fbcb', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:46:47', 'Test Email at 2023-02-02 14:46:47', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nanimi-fuga-fuga-similique-provident\r\n', 'Sent', 1, '2023-02-02 14:46:47', NULL, NULL, 7, 1344, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:46:47', '2023-02-02 14:46:47', NULL, NULL);
INSERT INTO `emails` VALUES (40, 'f2f3b49b-03e0-4af0-9edf-017b70df89d1', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:10', 'Test Email at 2023-02-02 14:48:10', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\naspernatur-numquam-suscipit-cupiditate-qui-consequatur-dolorem\r\n', 'Sent', 1, '2023-02-02 14:48:10', NULL, NULL, 7, 1345, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:10', '2023-02-02 14:48:10', NULL, NULL);
INSERT INTO `emails` VALUES (41, 'fd89e4f5-9e1c-4fb4-a19f-eb7ababaf3b0', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:11', 'Test Email at 2023-02-02 14:48:11', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\naspernatur-numquam-suscipit-cupiditate-qui-consequatur-dolorem\r\n', 'Sent', 1, '2023-02-02 14:48:11', NULL, NULL, 7, 1345, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:11', '2023-02-02 14:48:11', NULL, NULL);
INSERT INTO `emails` VALUES (42, '4df98b0b-fa2a-4140-b19a-040b155a0466', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:11', 'Test Email at 2023-02-02 14:48:11', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nlaudantium-tempore-minima-non\r\n', 'Sent', 1, '2023-02-02 14:48:11', NULL, NULL, 7, 1346, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:11', '2023-02-02 14:48:11', NULL, NULL);
INSERT INTO `emails` VALUES (43, 'f02318e7-f695-41aa-8a1f-7cdd7df67794', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:12', 'Test Email at 2023-02-02 14:48:12', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nlaudantium-tempore-minima-non\r\n', 'Sent', 1, '2023-02-02 14:48:12', NULL, NULL, 7, 1346, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:12', '2023-02-02 14:48:12', NULL, NULL);
INSERT INTO `emails` VALUES (44, 'a73a3593-03fb-4ddb-8a23-19c2e4c024e6', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:27', 'Test Email at 2023-02-02 14:48:27', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nipsum-et-veritatis-delectus-et\r\n', 'Sent', 1, '2023-02-02 14:48:31', NULL, NULL, 7, 1347, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:27', '2023-02-02 14:48:31', NULL, NULL);
INSERT INTO `emails` VALUES (45, '04e95356-e594-407b-bf12-a7bbec27ed2e', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:32', 'Test Email at 2023-02-02 14:48:32', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nipsum-et-veritatis-delectus-et\r\n', 'Sent', 1, '2023-02-02 14:48:36', NULL, NULL, 7, 1347, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:32', '2023-02-02 14:48:36', NULL, NULL);
INSERT INTO `emails` VALUES (46, '99958d4e-9bed-4f3d-be7c-451c6af98f14', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:37', 'Test Email at 2023-02-02 14:48:37', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nquasi-accusamus-et-est-ipsam\r\n', 'Sent', 1, '2023-02-02 14:48:41', NULL, NULL, 7, 1348, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:37', '2023-02-02 14:48:41', NULL, NULL);
INSERT INTO `emails` VALUES (47, 'e32969c3-e44e-4220-9452-64aca1ee57c7', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:48:42', 'Test Email at 2023-02-02 14:48:42', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nquasi-accusamus-et-est-ipsam\r\n', 'Sent', 1, '2023-02-02 14:48:46', NULL, NULL, 7, 1348, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:48:42', '2023-02-02 14:48:46', NULL, NULL);
INSERT INTO `emails` VALUES (48, 'ff31d02a-92cf-4547-ab9d-f46c24ef8ace', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:49:00', 'Test Email at 2023-02-02 14:49:00', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nquod-et-voluptas-illum-facere-quia-dolorem-dolor-enim\r\n', 'Sent', 1, '2023-02-02 14:49:04', NULL, NULL, 7, 1349, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:49:00', '2023-02-02 14:49:04', NULL, NULL);
INSERT INTO `emails` VALUES (49, '5199b6e7-068c-462d-857d-b021a0feb284', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:49:05', 'Test Email at 2023-02-02 14:49:05', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nquod-et-voluptas-illum-facere-quia-dolorem-dolor-enim\r\n', 'Sent', 1, '2023-02-02 14:49:09', NULL, NULL, 7, 1349, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:49:05', '2023-02-02 14:49:09', NULL, NULL);
INSERT INTO `emails` VALUES (50, '60bcfb7f-64a1-42b9-80bb-9c70762ef561', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:49:10', 'Test Email at 2023-02-02 14:49:10', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\ncumque-omnis-itaque-fuga-molestiae-ullam-pariatur-aut-ut\r\n', 'Sent', 1, '2023-02-02 14:49:14', NULL, NULL, 7, 1350, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:49:10', '2023-02-02 14:49:14', NULL, NULL);
INSERT INTO `emails` VALUES (51, '6d19f152-7f63-4b8e-956d-d7a83f240250', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:49:15', 'Test Email at 2023-02-02 14:49:15', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\ncumque-omnis-itaque-fuga-molestiae-ullam-pariatur-aut-ut\r\n', 'Sent', 1, '2023-02-02 14:49:19', NULL, NULL, 7, 1350, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:49:15', '2023-02-02 14:49:19', NULL, NULL);
INSERT INTO `emails` VALUES (52, '2fde9e42-70b0-4278-ae55-990e00a76012', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:50:29', 'Test Email at 2023-02-02 14:50:29', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nrerum-blanditiis-ab-quia-quaerat-sit-dolores\r\n', 'Sent', 1, '2023-02-02 14:50:33', NULL, NULL, 7, 1351, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:50:29', '2023-02-02 14:50:33', NULL, NULL);
INSERT INTO `emails` VALUES (53, 'ad651800-1c9e-4ef5-8a84-2c284c30d987', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:50:34', 'Test Email at 2023-02-02 14:50:34', NULL, '[\"raihan.act@gmail.com\",\"test@gmail.com\"]', '[\"some@more.com\"]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nrerum-blanditiis-ab-quia-quaerat-sit-dolores', 'Sent', 8, '2023-02-02 15:25:20', NULL, NULL, 7, 1351, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:50:34', '2023-02-02 15:25:20', NULL, NULL);
INSERT INTO `emails` VALUES (54, 'fcbbff48-d723-46b1-9d86-0fb9c1c83450', NULL, NULL, NULL, 'Test Email at 2023-02-02 14:50:39', 'Test Email at 2023-02-02 14:50:39', NULL, '[\"raihan.act@gmail.com\"]', '[]', '[]', 'Test', 'This is a test email <br/>\r\n\r\nquis-in-dolor-vel-quibusdam', 'Sent', 1, '2023-02-02 14:50:43', NULL, NULL, 7, 1352, NULL, NULL, NULL, 1, 1, 1, '2023-02-02 14:50:39', '2023-02-02 15:27:09', NULL, NULL);
INSERT INTO `emails` VALUES (56, '34fcb94b-786e-4748-a41e-ccd4a2de6f35', NULL, NULL, NULL, 'Test Setting Save | 2023-02-05 14:36:44', 'Test Setting Save | 2023-02-05 14:36:44', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-05 14:36:44', 'This is a test email <br/>\r\n\r\nducimus-molestiae-blanditiis-et-dolores\r\n', 'Sent', 1, '2023-02-05 14:36:48', NULL, NULL, 7, 1359, NULL, NULL, NULL, 1, 1, 1, '2023-02-05 14:36:44', '2023-02-05 14:36:48', NULL, NULL);
INSERT INTO `emails` VALUES (57, 'b8df8dcd-7e31-49e0-ae38-5da58a045ee6', NULL, NULL, NULL, 'Test Setting Save | 2023-02-05 14:36:49', 'Test Setting Save | 2023-02-05 14:36:49', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-05 14:36:49', 'This is a test email <br/>\r\n\r\nducimus-molestiae-blanditiis-et-dolores\r\n', 'Sent', 1, '2023-02-05 14:36:53', NULL, NULL, 7, 1359, NULL, NULL, NULL, 1, 1, 1, '2023-02-05 14:36:49', '2023-02-05 14:36:53', NULL, NULL);
INSERT INTO `emails` VALUES (58, '57d9194a-c7cd-464d-9a8d-45b76e1e4f42', NULL, NULL, NULL, 'Test Setting Save | 2023-02-05 14:36:54', 'Test Setting Save | 2023-02-05 14:36:54', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-05 14:36:54', 'This is a test email <br/>\r\n\r\net-harum-omnis-iure-nihil-molestiae\r\n', 'Sent', 1, '2023-02-05 14:36:58', NULL, NULL, 7, 1360, NULL, NULL, NULL, 1, 1, 1, '2023-02-05 14:36:54', '2023-02-05 14:36:58', NULL, NULL);
INSERT INTO `emails` VALUES (59, '2bc362f1-b257-499a-971b-b1a1ed4b7d9b', NULL, NULL, NULL, 'Test Setting Save | 2023-02-05 14:36:59', 'Test Setting Save | 2023-02-05 14:36:59', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-05 14:36:59', 'This is a test email <br/>\r\n\r\net-harum-omnis-iure-nihil-molestiae\r\n', 'Sent', 1, '2023-02-05 14:37:03', NULL, NULL, 7, 1360, NULL, NULL, NULL, 1, 1, 1, '2023-02-05 14:36:59', '2023-02-05 14:37:03', NULL, NULL);
INSERT INTO `emails` VALUES (60, '47e9a98a-f47d-4cab-a55e-6f1e714fc369', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 15:03:55', 'Test Setting Save | 2023-02-20 15:03:55', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 15:03:55', 'This is a test email <br/>\r\n\r\nminus-vitae-nulla-expedita-laudantium-et\r\n', 'Sent', 1, '2023-02-20 15:03:55', NULL, NULL, 7, 1361, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 15:03:55', '2023-02-20 15:03:55', NULL, NULL);
INSERT INTO `emails` VALUES (61, 'fc59b697-a8d7-44fb-a9eb-2e122774bdbc', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 15:03:56', 'Test Setting Save | 2023-02-20 15:03:56', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 15:03:56', 'This is a test email <br/>\r\n\r\nminus-vitae-nulla-expedita-laudantium-et\r\n', 'Sent', 1, '2023-02-20 15:03:56', NULL, NULL, 7, 1361, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 15:03:56', '2023-02-20 15:03:56', NULL, NULL);
INSERT INTO `emails` VALUES (62, 'a0d3e2a4-0527-4a8e-a1e7-908ef67c24e9', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 15:03:56', 'Test Setting Save | 2023-02-20 15:03:56', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 15:03:56', 'This is a test email <br/>\r\n\r\nquisquam-aspernatur-perferendis-temporibus-magni-ducimus-omnis\r\n', 'Sent', 1, '2023-02-20 15:03:56', NULL, NULL, 7, 1362, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 15:03:56', '2023-02-20 15:03:56', NULL, NULL);
INSERT INTO `emails` VALUES (63, 'b1bfc2ac-2d20-4884-aaf4-002ab49f38de', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 15:03:57', 'Test Setting Save | 2023-02-20 15:03:57', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 15:03:57', 'This is a test email <br/>\r\n\r\nquisquam-aspernatur-perferendis-temporibus-magni-ducimus-omnis\r\n', 'Sent', 1, '2023-02-20 15:03:57', NULL, NULL, 7, 1362, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 15:03:57', '2023-02-20 15:03:57', NULL, NULL);
INSERT INTO `emails` VALUES (64, '0039e428-1e7c-49ed-90ae-d02a1cf6e6e0', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 18:39:26', 'Test Setting Save | 2023-02-20 18:39:26', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 18:39:26', 'This is a test email <br/>\r\n\r\niste-numquam-aut-incidunt-sit-ratione\r\n', 'Sent', 1, '2023-02-20 18:39:26', NULL, NULL, 7, 1363, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 18:39:26', '2023-02-20 18:39:26', NULL, NULL);
INSERT INTO `emails` VALUES (65, '8768fddc-3b21-47f9-a637-77dffbc620b8', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 18:39:26', 'Test Setting Save | 2023-02-20 18:39:26', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 18:39:26', 'This is a test email <br/>\r\n\r\niste-numquam-aut-incidunt-sit-ratione\r\n', 'Sent', 1, '2023-02-20 18:39:26', NULL, NULL, 7, 1363, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 18:39:26', '2023-02-20 18:39:26', NULL, NULL);
INSERT INTO `emails` VALUES (66, 'f84fdeb2-c743-4fe1-b877-d707526ec27d', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 18:39:27', 'Test Setting Save | 2023-02-20 18:39:27', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 18:39:27', 'This is a test email <br/>\r\n\r\nvoluptatem-sit-aliquid-sunt-ut-et-eos\r\n', 'Sent', 1, '2023-02-20 18:39:27', NULL, NULL, 7, 1364, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 18:39:27', '2023-02-20 18:39:27', NULL, NULL);
INSERT INTO `emails` VALUES (67, '4cf67a78-8d10-4027-83da-c896a3f8f199', NULL, NULL, NULL, 'Test Setting Save | 2023-02-20 18:39:28', 'Test Setting Save | 2023-02-20 18:39:28', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-20 18:39:28', 'This is a test email <br/>\r\n\r\nvoluptatem-sit-aliquid-sunt-ut-et-eos\r\n', 'Sent', 1, '2023-02-20 18:39:28', NULL, NULL, 7, 1364, NULL, NULL, NULL, 1, 1, 1, '2023-02-20 18:39:28', '2023-02-20 18:39:28', NULL, NULL);
INSERT INTO `emails` VALUES (68, '99d723d4-e7bb-44da-b845-938cc56304f7', NULL, NULL, NULL, 'Test Setting Save | 2023-02-21 17:06:41', 'Test Setting Save | 2023-02-21 17:06:41', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-21 17:06:41', 'This is a test email <br/>\r\n\r\nconsequatur-doloremque-placeat-et-delectus-soluta-vel\r\n', 'Sent', 1, '2023-02-21 17:06:41', NULL, NULL, 7, 1365, NULL, NULL, NULL, 1, 1, 1, '2023-02-21 17:06:41', '2023-02-21 17:06:41', NULL, NULL);
INSERT INTO `emails` VALUES (69, '8118a653-b407-4d06-bd52-86694850ba8e', NULL, NULL, NULL, 'Test Setting Save | 2023-02-21 17:06:42', 'Test Setting Save | 2023-02-21 17:06:42', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-21 17:06:42', 'This is a test email <br/>\r\n\r\nconsequatur-doloremque-placeat-et-delectus-soluta-vel\r\n', 'Sent', 1, '2023-02-21 17:06:42', NULL, NULL, 7, 1365, NULL, NULL, NULL, 1, 1, 1, '2023-02-21 17:06:42', '2023-02-21 17:06:42', NULL, NULL);
INSERT INTO `emails` VALUES (70, '3c293d53-65ed-4213-bf27-65765ee368ab', NULL, NULL, NULL, 'Test Setting Save | 2023-02-21 17:06:42', 'Test Setting Save | 2023-02-21 17:06:42', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-21 17:06:42', 'This is a test email <br/>\r\n\r\nfacilis-aut-ipsum-qui-maxime-quasi\r\n', 'Sent', 1, '2023-02-21 17:06:42', NULL, NULL, 7, 1366, NULL, NULL, NULL, 1, 1, 1, '2023-02-21 17:06:42', '2023-02-21 17:06:42', NULL, NULL);
INSERT INTO `emails` VALUES (71, '27d017b2-806c-4a0f-9f4b-e64002a2731f', NULL, NULL, NULL, 'Test Setting Save | 2023-02-21 17:06:43', 'Test Setting Save | 2023-02-21 17:06:43', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-21 17:06:43', 'This is a test email <br/>\r\n\r\nfacilis-aut-ipsum-qui-maxime-quasi\r\n', 'Sent', 1, '2023-02-21 17:06:43', NULL, NULL, 7, 1366, NULL, NULL, NULL, 1, 1, 1, '2023-02-21 17:06:43', '2023-02-21 17:06:43', NULL, NULL);
INSERT INTO `emails` VALUES (72, '68008e0d-5812-436e-b1db-6c9fddefa056', NULL, NULL, NULL, 'Test Setting Save | 2023-02-22 21:40:58', 'Test Setting Save | 2023-02-22 21:40:58', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-22 21:40:58', 'This is a test email <br/>\r\n\r\ntest\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1367, NULL, NULL, NULL, 1, 1, 1, '2023-02-22 21:40:58', '2023-02-22 21:40:58', NULL, NULL);
INSERT INTO `emails` VALUES (73, '6bfbbbdb-dfb1-4cc0-bf21-5d89505bae71', NULL, NULL, NULL, 'Test Setting Save | 2023-02-24 18:30:21', 'Test Setting Save | 2023-02-24 18:30:21', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-24 18:30:21', 'This is a test email <br/>\r\n\r\nnihil-quo-illo-facere-repudiandae\r\n', 'Sent', 1, '2023-02-24 18:30:21', NULL, NULL, 7, 1368, NULL, NULL, NULL, 1, 1, 1, '2023-02-24 18:30:21', '2023-02-24 18:30:21', NULL, NULL);
INSERT INTO `emails` VALUES (74, 'cd572d57-ea47-4667-8afc-f1759713925a', NULL, NULL, NULL, 'Test Setting Save | 2023-02-24 18:30:22', 'Test Setting Save | 2023-02-24 18:30:22', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-24 18:30:22', 'This is a test email <br/>\r\n\r\nnihil-quo-illo-facere-repudiandae\r\n', 'Sent', 1, '2023-02-24 18:30:22', NULL, NULL, 7, 1368, NULL, NULL, NULL, 1, 1, 1, '2023-02-24 18:30:22', '2023-02-24 18:30:22', NULL, NULL);
INSERT INTO `emails` VALUES (75, '8b36aacb-e12d-40f7-a091-1b69a10a058a', NULL, NULL, NULL, 'Test Setting Save | 2023-02-24 18:30:23', 'Test Setting Save | 2023-02-24 18:30:23', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-24 18:30:23', 'This is a test email <br/>\r\n\r\net-dicta-nostrum-sed-animi\r\n', 'Sent', 1, '2023-02-24 18:30:23', NULL, NULL, 7, 1369, NULL, NULL, NULL, 1, 1, 1, '2023-02-24 18:30:23', '2023-02-24 18:30:23', NULL, NULL);
INSERT INTO `emails` VALUES (76, '8150a3a0-a95c-479c-900d-3a3c0dddfd38', NULL, NULL, NULL, 'Test Setting Save | 2023-02-24 18:30:26', 'Test Setting Save | 2023-02-24 18:30:26', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-24 18:30:26', 'This is a test email <br/>\r\n\r\net-dicta-nostrum-sed-animi\r\n', 'Sent', 1, '2023-02-24 18:30:26', NULL, NULL, 7, 1369, NULL, NULL, NULL, 1, 1, 1, '2023-02-24 18:30:26', '2023-02-24 18:30:26', NULL, NULL);
INSERT INTO `emails` VALUES (77, 'be67d666-76de-433f-8743-b90404e30109', NULL, NULL, NULL, 'Test Setting Save | 2023-02-28 10:19:22', 'Test Setting Save | 2023-02-28 10:19:22', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-28 10:19:22', 'This is a test email <br/>\r\n\r\nqui-est-omnis-deserunt-voluptatibus-ipsa-saepe-assumenda\r\n', 'Sent', 1, '2023-02-28 10:19:22', NULL, NULL, 7, 1370, NULL, NULL, NULL, 1, 1, 1, '2023-02-28 10:19:22', '2023-02-28 10:19:22', NULL, NULL);
INSERT INTO `emails` VALUES (78, '486fdbb9-8195-4083-b6c9-7dedbfb88940', NULL, NULL, NULL, 'Test Setting Save | 2023-02-28 10:19:23', 'Test Setting Save | 2023-02-28 10:19:23', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-28 10:19:23', 'This is a test email <br/>\r\n\r\nqui-est-omnis-deserunt-voluptatibus-ipsa-saepe-assumenda\r\n', 'Sent', 1, '2023-02-28 10:19:23', NULL, NULL, 7, 1370, NULL, NULL, NULL, 1, 1, 1, '2023-02-28 10:19:23', '2023-02-28 10:19:23', NULL, NULL);
INSERT INTO `emails` VALUES (79, '635d10ba-1579-4bda-8027-603067b1c1c7', NULL, NULL, NULL, 'Test Setting Save | 2023-02-28 10:19:24', 'Test Setting Save | 2023-02-28 10:19:24', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-28 10:19:24', 'This is a test email <br/>\r\n\r\nest-laboriosam-rerum-aut-mollitia\r\n', 'Sent', 1, '2023-02-28 10:19:24', NULL, NULL, 7, 1371, NULL, NULL, NULL, 1, 1, 1, '2023-02-28 10:19:24', '2023-02-28 10:19:24', NULL, NULL);
INSERT INTO `emails` VALUES (80, '5396f87d-efd0-4b6e-b3aa-e333720f12a5', NULL, NULL, NULL, 'Test Setting Save | 2023-02-28 10:19:27', 'Test Setting Save | 2023-02-28 10:19:27', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-02-28 10:19:27', 'This is a test email <br/>\r\n\r\nest-laboriosam-rerum-aut-mollitia\r\n', 'Sent', 1, '2023-02-28 10:19:27', NULL, NULL, 7, 1371, NULL, NULL, NULL, 1, 1, 1, '2023-02-28 10:19:27', '2023-02-28 10:19:27', NULL, NULL);
INSERT INTO `emails` VALUES (81, 'd9901811-0a24-469a-8f0d-975af8c4a7da', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 02:49:21', 'Test Setting Save | 2023-03-07 02:49:21', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 02:49:21', 'This is a test email <br/>\r\n\r\nmaxime-voluptatem-eos-provident-quis-est-vitae-iste\r\n', 'Sent', 1, '2023-03-07 02:49:21', NULL, NULL, 7, 1372, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 02:49:21', '2023-03-07 02:49:21', NULL, NULL);
INSERT INTO `emails` VALUES (82, 'e48d894a-46e1-4334-bcde-a1a5600b8697', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 02:49:22', 'Test Setting Save | 2023-03-07 02:49:22', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 02:49:22', 'This is a test email <br/>\r\n\r\nmaxime-voluptatem-eos-provident-quis-est-vitae-iste\r\n', 'Sent', 1, '2023-03-07 02:49:22', NULL, NULL, 7, 1372, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 02:49:22', '2023-03-07 02:49:22', NULL, NULL);
INSERT INTO `emails` VALUES (83, '444b192a-c408-4392-9af5-80b3c3623ee7', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 02:49:23', 'Test Setting Save | 2023-03-07 02:49:23', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 02:49:23', 'This is a test email <br/>\r\n\r\nquo-animi-nam-ipsam-similique\r\n', 'Sent', 1, '2023-03-07 02:49:23', NULL, NULL, 7, 1373, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 02:49:23', '2023-03-07 02:49:23', NULL, NULL);
INSERT INTO `emails` VALUES (84, 'b2df2240-f4ba-4751-9212-01236f3c2d77', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 02:49:25', 'Test Setting Save | 2023-03-07 02:49:25', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 02:49:25', 'This is a test email <br/>\r\n\r\nquo-animi-nam-ipsam-similique\r\n', 'Sent', 1, '2023-03-07 02:49:25', NULL, NULL, 7, 1373, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 02:49:25', '2023-03-07 02:49:25', NULL, NULL);
INSERT INTO `emails` VALUES (85, '8043382d-5d06-4d53-95e6-e77ebcacb5ad', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 04:27:38', 'Test Setting Save | 2023-03-07 04:27:38', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 04:27:38', 'This is a test email <br/>\r\n\r\naut-totam-esse-doloribus-aliquam-sit-cum\r\n', 'Sent', 1, '2023-03-07 04:27:38', NULL, NULL, 7, 1374, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 04:27:38', '2023-03-07 04:27:38', NULL, NULL);
INSERT INTO `emails` VALUES (86, '47961bb0-66ce-4333-9315-745ca177093a', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 04:27:39', 'Test Setting Save | 2023-03-07 04:27:39', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 04:27:39', 'This is a test email <br/>\r\n\r\naut-totam-esse-doloribus-aliquam-sit-cum\r\n', 'Sent', 1, '2023-03-07 04:27:39', NULL, NULL, 7, 1374, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 04:27:39', '2023-03-07 04:27:39', NULL, NULL);
INSERT INTO `emails` VALUES (87, '74f56021-40b7-4225-bf85-c4bb76d3f4e7', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 04:27:40', 'Test Setting Save | 2023-03-07 04:27:40', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 04:27:40', 'This is a test email <br/>\r\n\r\nquas-itaque-qui-dolorem-amet-occaecati-odit-perferendis-minus\r\n', 'Sent', 1, '2023-03-07 04:27:40', NULL, NULL, 7, 1375, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 04:27:40', '2023-03-07 04:27:40', NULL, NULL);
INSERT INTO `emails` VALUES (88, '8e165c3a-1146-459d-b3fe-e4a70260df92', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 04:27:40', 'Test Setting Save | 2023-03-07 04:27:40', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 04:27:40', 'This is a test email <br/>\r\n\r\nquas-itaque-qui-dolorem-amet-occaecati-odit-perferendis-minus\r\n', 'Sent', 1, '2023-03-07 04:27:40', NULL, NULL, 7, 1375, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 04:27:40', '2023-03-07 04:27:40', NULL, NULL);
INSERT INTO `emails` VALUES (89, '5a738326-0210-4bdd-a4fb-7144e2fa57ae', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 15:44:11', 'Test Setting Save | 2023-03-07 15:44:11', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 15:44:11', 'This is a test email <br/>\r\n\r\ndolore-voluptates-voluptatibus-qui-sequi\r\n', 'Sent', 1, '2023-03-07 15:44:16', NULL, NULL, 7, 1376, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 15:44:11', '2023-03-07 15:44:16', NULL, NULL);
INSERT INTO `emails` VALUES (90, 'd97bca76-6946-4407-af20-72f2d78ca23c', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 15:44:16', 'Test Setting Save | 2023-03-07 15:44:16', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 15:44:16', 'This is a test email <br/>\r\n\r\ndolore-voluptates-voluptatibus-qui-sequi\r\n', 'Sent', 1, '2023-03-07 15:44:21', NULL, NULL, 7, 1376, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 15:44:16', '2023-03-07 15:44:21', NULL, NULL);
INSERT INTO `emails` VALUES (91, 'c507e5d9-8c93-45b1-b5f1-ac1327e004a0', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 15:44:22', 'Test Setting Save | 2023-03-07 15:44:22', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 15:44:22', 'This is a test email <br/>\r\n\r\nqui-ut-dolor-voluptatem-dolorem\r\n', 'Sent', 1, '2023-03-07 15:44:26', NULL, NULL, 7, 1377, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 15:44:22', '2023-03-07 15:44:26', NULL, NULL);
INSERT INTO `emails` VALUES (92, '35f4a00b-a141-4767-905c-693655742ec6', NULL, NULL, NULL, 'Test Setting Save | 2023-03-07 15:44:27', 'Test Setting Save | 2023-03-07 15:44:27', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-07 15:44:27', 'This is a test email <br/>\r\n\r\nqui-ut-dolor-voluptatem-dolorem\r\n', 'Sent', 1, '2023-03-07 15:44:31', NULL, NULL, 7, 1377, NULL, NULL, NULL, 1, 1, 1, '2023-03-07 15:44:27', '2023-03-07 15:44:31', NULL, NULL);
INSERT INTO `emails` VALUES (93, 'd5a150aa-a7ac-46fb-a772-6990c00c1a0f', NULL, NULL, NULL, 'Test Setting Save | 2023-03-12 17:10:39', 'Test Setting Save | 2023-03-12 17:10:39', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-12 17:10:39', 'This is a test email <br/>\r\n\r\naccusamus-enim-quia-necessitatibus\r\n', 'Sent', 1, '2023-03-12 17:10:43', NULL, NULL, 7, 1378, NULL, NULL, NULL, 1, 1, 1, '2023-03-12 17:10:39', '2023-03-12 17:10:43', NULL, NULL);
INSERT INTO `emails` VALUES (94, '64c8a1ba-6264-47ef-8da5-e1a6e3b90c30', NULL, NULL, NULL, 'Test Setting Save | 2023-03-12 17:10:44', 'Test Setting Save | 2023-03-12 17:10:44', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-12 17:10:44', 'This is a test email <br/>\r\n\r\naccusamus-enim-quia-necessitatibus\r\n', 'Sent', 1, '2023-03-12 17:10:49', NULL, NULL, 7, 1378, NULL, NULL, NULL, 1, 1, 1, '2023-03-12 17:10:44', '2023-03-12 17:10:49', NULL, NULL);
INSERT INTO `emails` VALUES (95, '2cc7b940-2a9e-4330-b7c0-3bcc1c2365ea', NULL, NULL, NULL, 'Test Setting Save | 2023-03-12 17:10:50', 'Test Setting Save | 2023-03-12 17:10:50', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-12 17:10:50', 'This is a test email <br/>\r\n\r\nducimus-labore-assumenda-laborum-voluptatem-dolorem\r\n', 'Sent', 1, '2023-03-12 17:10:54', NULL, NULL, 7, 1379, NULL, NULL, NULL, 1, 1, 1, '2023-03-12 17:10:50', '2023-03-12 17:10:54', NULL, NULL);
INSERT INTO `emails` VALUES (96, '0a221616-775b-41ac-817f-48039ac00352', NULL, NULL, NULL, 'Test Setting Save | 2023-03-12 17:10:55', 'Test Setting Save | 2023-03-12 17:10:55', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-03-12 17:10:55', 'This is a test email <br/>\r\n\r\nducimus-labore-assumenda-laborum-voluptatem-dolorem\r\n', 'Sent', 1, '2023-03-12 17:10:59', NULL, NULL, 7, 1379, NULL, NULL, NULL, 1, 1, 1, '2023-03-12 17:10:55', '2023-03-12 17:10:59', NULL, NULL);
INSERT INTO `emails` VALUES (97, 'e45e7618-9ab2-4b8b-8344-537af12756f1', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 05:55:40', 'Test Setting Save | 2023-05-02 05:55:40', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 05:55:40', 'This is a test email <br/>\r\n\r\nipsa-optio-consequuntur-explicabo-voluptatem\r\n', 'Sent', 1, '2023-05-02 05:55:45', NULL, NULL, 7, 1380, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 05:55:40', '2023-05-02 05:55:45', NULL, NULL);
INSERT INTO `emails` VALUES (98, '0bb78c1c-1ca4-4698-bfc0-9c3540e7a267', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 05:55:46', 'Test Setting Save | 2023-05-02 05:55:46', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 05:55:46', 'This is a test email <br/>\r\n\r\nipsa-optio-consequuntur-explicabo-voluptatem\r\n', 'Sent', 1, '2023-05-02 05:55:51', NULL, NULL, 7, 1380, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 05:55:46', '2023-05-02 05:55:51', NULL, NULL);
INSERT INTO `emails` VALUES (99, '95573076-1a81-43e0-9df9-34cabd6c8dd8', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 05:55:52', 'Test Setting Save | 2023-05-02 05:55:52', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 05:55:52', 'This is a test email <br/>\r\n\r\naut-ea-dolores-soluta-voluptatum-soluta-est-cumque-harum\r\n', 'Sent', 1, '2023-05-02 05:55:57', NULL, NULL, 7, 1381, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 05:55:52', '2023-05-02 05:55:57', NULL, NULL);
INSERT INTO `emails` VALUES (100, '2186f75a-9551-4993-b954-595160f7431a', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 05:55:58', 'Test Setting Save | 2023-05-02 05:55:58', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 05:55:58', 'This is a test email <br/>\r\n\r\naut-ea-dolores-soluta-voluptatum-soluta-est-cumque-harum\r\n', 'Sent', 1, '2023-05-02 05:56:03', NULL, NULL, 7, 1381, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 05:55:58', '2023-05-02 05:56:03', NULL, NULL);
INSERT INTO `emails` VALUES (101, '1860e321-7425-45b2-b4ab-9502295e7245', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:01:48', 'Test Setting Save | 2023-05-02 06:01:48', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:01:48', 'This is a test email <br/>\r\n\r\nporro-sunt-odit-adipisci-rerum-nemo\r\n', 'Sent', 1, '2023-05-02 06:01:53', NULL, NULL, 7, 1382, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:01:48', '2023-05-02 06:01:53', NULL, NULL);
INSERT INTO `emails` VALUES (102, '109a8399-b081-4d56-8dff-78093a27d56e', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:01:54', 'Test Setting Save | 2023-05-02 06:01:54', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:01:54', 'This is a test email <br/>\r\n\r\nporro-sunt-odit-adipisci-rerum-nemo\r\n', 'Sent', 1, '2023-05-02 06:01:59', NULL, NULL, 7, 1382, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:01:54', '2023-05-02 06:01:59', NULL, NULL);
INSERT INTO `emails` VALUES (103, 'c4c9f524-be50-44ed-b71f-71b1c7290eae', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:02:00', 'Test Setting Save | 2023-05-02 06:02:00', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:02:00', 'This is a test email <br/>\r\n\r\ndelectus-qui-est-quia-enim-assumenda-et-placeat-et\r\n', 'Sent', 1, '2023-05-02 06:02:05', NULL, NULL, 7, 1383, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:02:00', '2023-05-02 06:02:05', NULL, NULL);
INSERT INTO `emails` VALUES (104, 'ad7da179-2fe7-4d76-85c8-cdb21e1d56ef', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:02:06', 'Test Setting Save | 2023-05-02 06:02:06', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:02:06', 'This is a test email <br/>\r\n\r\ndelectus-qui-est-quia-enim-assumenda-et-placeat-et\r\n', 'Sent', 1, '2023-05-02 06:02:11', NULL, NULL, 7, 1383, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:02:06', '2023-05-02 06:02:11', NULL, NULL);
INSERT INTO `emails` VALUES (105, '5550099a-1206-461d-87d2-e04f92f29b3a', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:02:42', 'Test Setting Save | 2023-05-02 06:02:42', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:02:42', 'This is a test email <br/>\r\n\r\nmobile-portrait-help-steps\r\n', 'Sent', 1, '2023-05-02 06:02:47', NULL, NULL, 7, 4, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:02:42', '2023-05-02 06:02:47', NULL, NULL);
INSERT INTO `emails` VALUES (106, 'b600730e-a691-465d-97cc-10de64b02839', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:03:21', 'Test Setting Save | 2023-05-02 06:03:21', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:03:21', 'This is a test email <br/>\r\n\r\naut-dolores-voluptas-corporis-est-sint\r\n', 'Sent', 1, '2023-05-02 06:03:26', NULL, NULL, 7, 1384, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:03:21', '2023-05-02 06:03:26', NULL, NULL);
INSERT INTO `emails` VALUES (107, 'ace278ed-589d-4955-abfc-0769f517c8b3', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:03:27', 'Test Setting Save | 2023-05-02 06:03:27', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:03:27', 'This is a test email <br/>\r\n\r\naut-dolores-voluptas-corporis-est-sint\r\n', 'Sent', 1, '2023-05-02 06:03:32', NULL, NULL, 7, 1384, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:03:27', '2023-05-02 06:03:32', NULL, NULL);
INSERT INTO `emails` VALUES (108, 'aabe7add-83a7-424a-aa3c-94749163747b', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:03:33', 'Test Setting Save | 2023-05-02 06:03:33', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:03:33', 'This is a test email <br/>\r\n\r\nquia-a-modi-facilis-aut-dolores-deserunt-voluptas-tempora\r\n', 'Sent', 1, '2023-05-02 06:03:38', NULL, NULL, 7, 1385, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:03:33', '2023-05-02 06:03:38', NULL, NULL);
INSERT INTO `emails` VALUES (109, 'a6549d2b-4d9c-4ed3-9fe0-0142d6afa303', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:03:39', 'Test Setting Save | 2023-05-02 06:03:39', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:03:39', 'This is a test email <br/>\r\n\r\nquia-a-modi-facilis-aut-dolores-deserunt-voluptas-tempora\r\n', 'Sent', 1, '2023-05-02 06:03:44', NULL, NULL, 7, 1385, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:03:39', '2023-05-02 06:03:44', NULL, NULL);
INSERT INTO `emails` VALUES (110, 'cedd2793-0c31-4979-b649-96e03f086880', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:03:55', 'Test Setting Save | 2023-05-02 06:03:55', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:03:55', 'This is a test email <br/>\r\n\r\nest-quod-est-doloribus-laboriosam-inventore-aut\r\n', 'Sent', 1, '2023-05-02 06:04:01', NULL, NULL, 7, 1386, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:03:55', '2023-05-02 06:04:01', NULL, NULL);
INSERT INTO `emails` VALUES (111, '27a9df94-e126-4e9b-846f-2552c0ba5244', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:04:01', 'Test Setting Save | 2023-05-02 06:04:01', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:04:01', 'This is a test email <br/>\r\n\r\nest-quod-est-doloribus-laboriosam-inventore-aut\r\n', 'Sent', 1, '2023-05-02 06:04:06', NULL, NULL, 7, 1386, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:04:01', '2023-05-02 06:04:06', NULL, NULL);
INSERT INTO `emails` VALUES (112, 'bbcab2ef-9759-4a35-b8ae-0f3bad73a6d0', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:04:07', 'Test Setting Save | 2023-05-02 06:04:07', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:04:07', 'This is a test email <br/>\r\n\r\ntempora-sed-eaque-sit-sunt-eveniet\r\n', 'Sent', 1, '2023-05-02 06:04:12', NULL, NULL, 7, 1387, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:04:07', '2023-05-02 06:04:12', NULL, NULL);
INSERT INTO `emails` VALUES (113, 'b19f8103-402d-4cd3-a92c-9c8bea2d734f', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:04:14', 'Test Setting Save | 2023-05-02 06:04:14', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:04:14', 'This is a test email <br/>\r\n\r\ntempora-sed-eaque-sit-sunt-eveniet\r\n', 'Sent', 1, '2023-05-02 06:04:18', NULL, NULL, 7, 1387, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:04:14', '2023-05-02 06:04:18', NULL, NULL);
INSERT INTO `emails` VALUES (114, 'ac7e2c23-a6b1-4388-b6b0-43dce1a4e00d', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:06:49', 'Test Setting Save | 2023-05-02 06:06:49', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:06:49', 'This is a test email <br/>\r\n\r\nquia-ratione-illum-nulla-omnis\r\n', 'Sent', 1, '2023-05-02 06:06:54', NULL, NULL, 7, 1388, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:06:49', '2023-05-02 06:06:54', NULL, NULL);
INSERT INTO `emails` VALUES (115, '99f23aab-37a8-4066-ab5d-3e6ac6a076b1', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:06:55', 'Test Setting Save | 2023-05-02 06:06:55', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:06:55', 'This is a test email <br/>\r\n\r\nquia-ratione-illum-nulla-omnis\r\n', 'Sent', 1, '2023-05-02 06:07:00', NULL, NULL, 7, 1388, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:06:55', '2023-05-02 06:07:00', NULL, NULL);
INSERT INTO `emails` VALUES (116, '73e2b5c8-68eb-4883-9034-3fef53b67a4e', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:07:01', 'Test Setting Save | 2023-05-02 06:07:01', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:07:01', 'This is a test email <br/>\r\n\r\nfuga-impedit-dolores-ipsum-ut\r\n', 'Sent', 1, '2023-05-02 06:07:06', NULL, NULL, 7, 1389, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:07:01', '2023-05-02 06:07:06', NULL, NULL);
INSERT INTO `emails` VALUES (117, 'b2967f8b-a5b1-41e2-92e4-3b054c4216ea', NULL, NULL, NULL, 'Test Setting Save | 2023-05-02 06:07:07', 'Test Setting Save | 2023-05-02 06:07:07', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-05-02 06:07:07', 'This is a test email <br/>\r\n\r\nfuga-impedit-dolores-ipsum-ut\r\n', 'Sent', 1, '2023-05-02 06:07:12', NULL, NULL, 7, 1389, NULL, NULL, NULL, 1, 1, 1, '2023-05-02 06:07:07', '2023-05-02 06:07:12', NULL, NULL);
INSERT INTO `emails` VALUES (118, 'f888fb1b-53e2-4065-9ea8-f51a988d27a8', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:55:51', 'Test Setting Save | 2023-08-02 05:55:51', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:55:51', 'This is a test email <br/>\r\n\r\naperiam-nesciunt-saepe-consectetur-et-voluptatem-minus\r\n', 'Sent', 1, '2023-08-02 05:55:56', NULL, NULL, 7, 1390, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:55:51', '2023-08-02 05:55:56', NULL, NULL);
INSERT INTO `emails` VALUES (119, '95cf6fbc-5369-4af2-b47a-e8831b62e50f', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:55:57', 'Test Setting Save | 2023-08-02 05:55:57', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:55:57', 'This is a test email <br/>\r\n\r\naperiam-nesciunt-saepe-consectetur-et-voluptatem-minus\r\n', 'Sent', 1, '2023-08-02 05:56:02', NULL, NULL, 7, 1390, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:55:57', '2023-08-02 05:56:02', NULL, NULL);
INSERT INTO `emails` VALUES (120, '2dd77a4d-2bc4-43be-9397-74c1b82072a0', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:56:03', 'Test Setting Save | 2023-08-02 05:56:03', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:56:03', 'This is a test email <br/>\r\n\r\nexercitationem-corporis-aut-voluptates-quasi-et-neque-dolores\r\n', 'Sent', 1, '2023-08-02 05:56:08', NULL, NULL, 7, 1391, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:56:03', '2023-08-02 05:56:08', NULL, NULL);
INSERT INTO `emails` VALUES (121, '846ae59d-2dbb-4ccd-a88e-908871d70cd6', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:56:10', 'Test Setting Save | 2023-08-02 05:56:10', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:56:10', 'This is a test email <br/>\r\n\r\nexercitationem-corporis-aut-voluptates-quasi-et-neque-dolores\r\n', 'Sent', 1, '2023-08-02 05:56:15', NULL, NULL, 7, 1391, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:56:10', '2023-08-02 05:56:15', NULL, NULL);
INSERT INTO `emails` VALUES (122, '5071ccf3-c1b2-4679-826d-0b70a2dc365a', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:57:59', 'Test Setting Save | 2023-08-02 05:57:59', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:57:59', 'This is a test email <br/>\r\n\r\nmaxime-maiores-quos-quos-magni\r\n', 'Sent', 1, '2023-08-02 05:58:05', NULL, NULL, 7, 1392, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:57:59', '2023-08-02 05:58:05', NULL, NULL);
INSERT INTO `emails` VALUES (123, '04c6ec2e-86fc-4dad-b945-7a2131e14fc6', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:58:06', 'Test Setting Save | 2023-08-02 05:58:06', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:58:06', 'This is a test email <br/>\r\n\r\nmaxime-maiores-quos-quos-magni\r\n', 'Sent', 1, '2023-08-02 05:58:10', NULL, NULL, 7, 1392, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:58:06', '2023-08-02 05:58:10', NULL, NULL);
INSERT INTO `emails` VALUES (124, 'd43e545a-eddf-4c94-9dc4-60ce33efe9b2', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:58:12', 'Test Setting Save | 2023-08-02 05:58:12', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:58:12', 'This is a test email <br/>\r\n\r\nvoluptates-totam-rem-voluptatem-omnis-voluptas-eligendi-delectus\r\n', 'Sent', 1, '2023-08-02 05:58:16', NULL, NULL, 7, 1393, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:58:12', '2023-08-02 05:58:16', NULL, NULL);
INSERT INTO `emails` VALUES (125, 'e90ead8c-b605-4b89-956f-08f6595ae99e', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:58:18', 'Test Setting Save | 2023-08-02 05:58:18', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:58:18', 'This is a test email <br/>\r\n\r\nvoluptates-totam-rem-voluptatem-omnis-voluptas-eligendi-delectus\r\n', 'Sent', 1, '2023-08-02 05:58:23', NULL, NULL, 7, 1393, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:58:18', '2023-08-02 05:58:23', NULL, NULL);
INSERT INTO `emails` VALUES (126, 'f0be2aca-e8fc-4d95-82f9-d697427e6dbb', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:58:34', 'Test Setting Save | 2023-08-02 05:58:34', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:58:34', 'This is a test email <br/>\r\n\r\nquo-amet-minima-alias-reprehenderit-inventore-laboriosam-ea\r\n', 'Sent', 1, '2023-08-02 05:58:39', NULL, NULL, 7, 1394, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:58:34', '2023-08-02 05:58:39', NULL, NULL);
INSERT INTO `emails` VALUES (127, 'afb0424a-683f-478a-9ee7-ef6d80fb7e5f', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:58:40', 'Test Setting Save | 2023-08-02 05:58:40', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:58:40', 'This is a test email <br/>\r\n\r\nquo-amet-minima-alias-reprehenderit-inventore-laboriosam-ea\r\n', 'Sent', 1, '2023-08-02 05:58:45', NULL, NULL, 7, 1394, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:58:40', '2023-08-02 05:58:45', NULL, NULL);
INSERT INTO `emails` VALUES (128, '3fc57e28-e5c2-4880-9a8f-d6e80f873df1', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:58:47', 'Test Setting Save | 2023-08-02 05:58:47', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:58:47', 'This is a test email <br/>\r\n\r\nveritatis-rem-qui-voluptates-et-est-excepturi-non-alias\r\n', 'Sent', 1, '2023-08-02 05:58:52', NULL, NULL, 7, 1395, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:58:47', '2023-08-02 05:58:52', NULL, NULL);
INSERT INTO `emails` VALUES (129, 'a41908c2-4f36-461e-8fea-0d69eafded0c', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:58:53', 'Test Setting Save | 2023-08-02 05:58:53', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:58:53', 'This is a test email <br/>\r\n\r\nveritatis-rem-qui-voluptates-et-est-excepturi-non-alias\r\n', 'Sent', 1, '2023-08-02 05:58:58', NULL, NULL, 7, 1395, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:58:53', '2023-08-02 05:58:58', NULL, NULL);
INSERT INTO `emails` VALUES (130, '36022046-a2b1-433f-b0e8-c699fdda5dbf', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:59:23', 'Test Setting Save | 2023-08-02 05:59:23', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:59:23', 'This is a test email <br/>\r\n\r\ntotam-voluptate-tempore-ut-occaecati\r\n', 'Sent', 1, '2023-08-02 05:59:28', NULL, NULL, 7, 1396, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:59:23', '2023-08-02 05:59:28', NULL, NULL);
INSERT INTO `emails` VALUES (131, '28f032e3-7654-4596-bce0-e5c740202eaa', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:59:29', 'Test Setting Save | 2023-08-02 05:59:29', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:59:29', 'This is a test email <br/>\r\n\r\ntotam-voluptate-tempore-ut-occaecati\r\n', 'Sent', 1, '2023-08-02 05:59:33', NULL, NULL, 7, 1396, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:59:29', '2023-08-02 05:59:33', NULL, NULL);
INSERT INTO `emails` VALUES (132, 'd7d0c57f-1167-44a2-bd30-38a5677cd9a7', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:59:34', 'Test Setting Save | 2023-08-02 05:59:34', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:59:34', 'This is a test email <br/>\r\n\r\nin-consequatur-alias-in-minus-aut-expedita-explicabo-praesentium\r\n', 'Sent', 1, '2023-08-02 05:59:39', NULL, NULL, 7, 1397, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:59:34', '2023-08-02 05:59:39', NULL, NULL);
INSERT INTO `emails` VALUES (133, '68675a4a-c870-487e-84a0-a7fd2ef9525d', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:59:40', 'Test Setting Save | 2023-08-02 05:59:40', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:59:40', 'This is a test email <br/>\r\n\r\nin-consequatur-alias-in-minus-aut-expedita-explicabo-praesentium\r\n', 'Sent', 1, '2023-08-02 05:59:45', NULL, NULL, 7, 1397, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 05:59:40', '2023-08-02 05:59:45', NULL, NULL);
INSERT INTO `emails` VALUES (134, 'e228cd1c-3fa5-4ed6-9bc2-afcc86a2f731', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 05:59:59', 'Test Setting Save | 2023-08-02 05:59:59', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 05:59:59', 'This is a test email <br/>\r\n\r\neaque-et-similique-sed-quam\r\n', 'Sent', 1, '2023-08-02 06:00:04', NULL, NULL, 7, 1398, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:00:00', '2023-08-02 06:00:04', NULL, NULL);
INSERT INTO `emails` VALUES (135, '059f1beb-acd8-4a72-91e1-468e5866558d', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:00:05', 'Test Setting Save | 2023-08-02 06:00:05', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:00:05', 'This is a test email <br/>\r\n\r\neaque-et-similique-sed-quam\r\n', 'Sent', 1, '2023-08-02 06:00:10', NULL, NULL, 7, 1398, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:00:05', '2023-08-02 06:00:10', NULL, NULL);
INSERT INTO `emails` VALUES (136, '4b21fce0-6fa4-4425-b5cb-6c4f2a5c14ae', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:00:11', 'Test Setting Save | 2023-08-02 06:00:11', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:00:11', 'This is a test email <br/>\r\n\r\namet-asperiores-libero-est-sint\r\n', 'Sent', 1, '2023-08-02 06:00:15', NULL, NULL, 7, 1399, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:00:11', '2023-08-02 06:00:15', NULL, NULL);
INSERT INTO `emails` VALUES (137, 'ea51f4ed-7aca-463a-9eb2-e1d5eecdf2ab', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:00:17', 'Test Setting Save | 2023-08-02 06:00:17', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:00:17', 'This is a test email <br/>\r\n\r\namet-asperiores-libero-est-sint\r\n', 'Sent', 1, '2023-08-02 06:00:21', NULL, NULL, 7, 1399, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:00:17', '2023-08-02 06:00:21', NULL, NULL);
INSERT INTO `emails` VALUES (138, 'b7ff59a0-aae1-474c-a6fd-876514bcc05f', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:01:42', 'Test Setting Save | 2023-08-02 06:01:42', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:01:42', 'This is a test email <br/>\r\n\r\nculpa-voluptates-et-quaerat-dolorem-explicabo-voluptas-et\r\n', 'Sent', 1, '2023-08-02 06:01:47', NULL, NULL, 7, 1400, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:01:42', '2023-08-02 06:01:47', NULL, NULL);
INSERT INTO `emails` VALUES (139, '86b3f3bf-ccdb-4b4d-bbee-eea9cc4ae80b', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:01:48', 'Test Setting Save | 2023-08-02 06:01:48', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:01:48', 'This is a test email <br/>\r\n\r\nculpa-voluptates-et-quaerat-dolorem-explicabo-voluptas-et\r\n', 'Sent', 1, '2023-08-02 06:01:53', NULL, NULL, 7, 1400, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:01:48', '2023-08-02 06:01:53', NULL, NULL);
INSERT INTO `emails` VALUES (140, '10f5dee2-a8be-444e-b744-9684f324eb42', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:01:53', 'Test Setting Save | 2023-08-02 06:01:53', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:01:53', 'This is a test email <br/>\r\n\r\nconsequatur-officiis-consequatur-natus-tempore\r\n', 'Sent', 1, '2023-08-02 06:01:59', NULL, NULL, 7, 1401, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:01:53', '2023-08-02 06:01:59', NULL, NULL);
INSERT INTO `emails` VALUES (141, '933436c5-e82b-4562-a416-995fe2911895', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:02:00', 'Test Setting Save | 2023-08-02 06:02:00', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:02:00', 'This is a test email <br/>\r\n\r\nconsequatur-officiis-consequatur-natus-tempore\r\n', 'Sent', 1, '2023-08-02 06:02:05', NULL, NULL, 7, 1401, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:02:00', '2023-08-02 06:02:05', NULL, NULL);
INSERT INTO `emails` VALUES (142, 'b4c0eeb8-e6bc-4586-a124-e874d9282561', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:47:57', 'Test Setting Save | 2023-08-02 06:47:57', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:47:57', 'This is a test email <br/>\r\n\r\net-nemo-rerum-accusamus-distinctio\r\n', 'Sent', 1, '2023-08-02 06:48:01', NULL, NULL, 7, 1402, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:47:57', '2023-08-02 06:48:01', NULL, NULL);
INSERT INTO `emails` VALUES (143, '6416ff42-405e-4311-932b-e7a405b1609e', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:48:02', 'Test Setting Save | 2023-08-02 06:48:02', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:48:02', 'This is a test email <br/>\r\n\r\net-nemo-rerum-accusamus-distinctio\r\n', 'Sent', 1, '2023-08-02 06:48:07', NULL, NULL, 7, 1402, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:48:02', '2023-08-02 06:48:07', NULL, NULL);
INSERT INTO `emails` VALUES (144, '88d314e6-8708-44b2-86f9-238f170dcf4c', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:48:08', 'Test Setting Save | 2023-08-02 06:48:08', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:48:08', 'This is a test email <br/>\r\n\r\nnihil-deserunt-esse-totam-at\r\n', 'Sent', 1, '2023-08-02 06:48:12', NULL, NULL, 7, 1403, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:48:08', '2023-08-02 06:48:12', NULL, NULL);
INSERT INTO `emails` VALUES (145, '869ac814-5377-4905-b33a-22c16534ee26', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:48:14', 'Test Setting Save | 2023-08-02 06:48:14', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:48:14', 'This is a test email <br/>\r\n\r\nnihil-deserunt-esse-totam-at\r\n', 'Sent', 1, '2023-08-02 06:48:19', NULL, NULL, 7, 1403, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:48:14', '2023-08-02 06:48:19', NULL, NULL);
INSERT INTO `emails` VALUES (146, 'fcc6db39-6a39-4c67-a31f-6f61653d2960', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:49:21', 'Test Setting Save | 2023-08-02 06:49:21', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:49:21', 'This is a test email <br/>\r\n\r\nducimus-optio-odio-eum-eaque-tempore-nisi\r\n', 'Sent', 1, '2023-08-02 06:49:26', NULL, NULL, 7, 1404, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:49:21', '2023-08-02 06:49:26', NULL, NULL);
INSERT INTO `emails` VALUES (147, '507ea818-c49c-49d0-b5b4-98734357e54b', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:49:26', 'Test Setting Save | 2023-08-02 06:49:26', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:49:26', 'This is a test email <br/>\r\n\r\nducimus-optio-odio-eum-eaque-tempore-nisi\r\n', 'Sent', 1, '2023-08-02 06:49:31', NULL, NULL, 7, 1404, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:49:26', '2023-08-02 06:49:31', NULL, NULL);
INSERT INTO `emails` VALUES (148, '7738d88b-d10b-4651-a670-234688ffe3e8', NULL, NULL, NULL, 'Test Setting Save | 2023-08-02 06:49:32', 'Test Setting Save | 2023-08-02 06:49:32', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-02 06:49:32', 'This is a test email <br/>\r\n\r\nexcepturi-eum-dicta-velit-accusantium-aliquid-pariatur-dolorum-aliquam\r\n', 'Sent', 1, '2023-08-02 06:49:37', NULL, NULL, 7, 1405, NULL, NULL, NULL, 1, 1, 1, '2023-08-02 06:49:32', '2023-08-02 06:49:37', NULL, NULL);
INSERT INTO `emails` VALUES (149, '3d54fd0d-c85a-4bce-ad7c-62525e4d3c75', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 15:04:38', 'Test Setting Save | 2023-08-09 15:04:38', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 15:04:38', 'This is a test email <br/>\r\n\r\net-labore-maiores-recusandae-aliquam-quasi\r\n', 'Sent', 1, '2023-08-09 15:04:43', NULL, NULL, 7, 1406, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 15:04:38', '2023-08-09 15:04:43', NULL, NULL);
INSERT INTO `emails` VALUES (150, '9efbb25c-923c-4062-8150-8cc6b40fe97f', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 15:04:44', 'Test Setting Save | 2023-08-09 15:04:44', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 15:04:44', 'This is a test email <br/>\r\n\r\net-labore-maiores-recusandae-aliquam-quasi\r\n', 'Sent', 1, '2023-08-09 15:04:49', NULL, NULL, 7, 1406, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 15:04:44', '2023-08-09 15:04:49', NULL, NULL);
INSERT INTO `emails` VALUES (151, '1705af08-8eb4-4e4c-8732-7a64ac7573a1', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 15:04:50', 'Test Setting Save | 2023-08-09 15:04:50', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 15:04:50', 'This is a test email <br/>\r\n\r\naccusamus-harum-ad-fugit-soluta\r\n', 'Sent', 1, '2023-08-09 15:04:55', NULL, NULL, 7, 1407, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 15:04:50', '2023-08-09 15:04:55', NULL, NULL);
INSERT INTO `emails` VALUES (152, 'a4cab08c-19b4-4ded-8218-f4c27ba7fe0b', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 15:04:56', 'Test Setting Save | 2023-08-09 15:04:56', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 15:04:56', 'This is a test email <br/>\r\n\r\naccusamus-harum-ad-fugit-soluta\r\n', 'Sent', 1, '2023-08-09 15:05:01', NULL, NULL, 7, 1407, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 15:04:56', '2023-08-09 15:05:01', NULL, NULL);
INSERT INTO `emails` VALUES (153, 'f4958224-0cba-4b5d-8641-182b99602694', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:03:20', 'Test Setting Save | 2023-08-09 16:03:20', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:03:20', 'This is a test email <br/>\r\n\r\ndolor-provident-repellat-consequuntur-aspernatur-nostrum-esse-deleniti\r\n', 'Sent', 1, '2023-08-09 16:03:27', NULL, NULL, 7, 1408, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:03:20', '2023-08-09 16:03:27', NULL, NULL);
INSERT INTO `emails` VALUES (154, '1e7a53f4-01d4-48ce-ab3a-38662269a083', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:03:29', 'Test Setting Save | 2023-08-09 16:03:29', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:03:29', 'This is a test email <br/>\r\n\r\ndolor-provident-repellat-consequuntur-aspernatur-nostrum-esse-deleniti\r\n', 'Sent', 1, '2023-08-09 16:03:35', NULL, NULL, 7, 1408, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:03:29', '2023-08-09 16:03:35', NULL, NULL);
INSERT INTO `emails` VALUES (155, '3c0fafe8-1684-4595-8664-3d1bc75b7aa0', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:03:36', 'Test Setting Save | 2023-08-09 16:03:36', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:03:36', 'This is a test email <br/>\r\n\r\ntempora-quia-illo-reprehenderit-doloremque-provident-perferendis-architecto\r\n', 'Sent', 1, '2023-08-09 16:03:43', NULL, NULL, 7, 1409, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:03:36', '2023-08-09 16:03:43', NULL, NULL);
INSERT INTO `emails` VALUES (156, 'bd688d45-bc1c-438e-ad95-c27741e3e518', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:03:51', 'Test Setting Save | 2023-08-09 16:03:51', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:03:51', 'This is a test email <br/>\r\n\r\ntempora-quia-illo-reprehenderit-doloremque-provident-perferendis-architecto\r\n', 'Sent', 1, '2023-08-09 16:03:59', NULL, NULL, 7, 1409, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:03:51', '2023-08-09 16:03:59', NULL, NULL);
INSERT INTO `emails` VALUES (157, '3d3bfc01-e545-44ae-a538-66baed3d97a7', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:04:33', 'Test Setting Save | 2023-08-09 16:04:33', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:04:33', 'This is a test email <br/>\r\n\r\naut-veritatis-at-repellendus-rerum-aut-cumque\r\n', 'Sent', 1, '2023-08-09 16:04:40', NULL, NULL, 7, 1410, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:04:33', '2023-08-09 16:04:40', NULL, NULL);
INSERT INTO `emails` VALUES (158, 'b75169c6-504f-4191-ab10-ac2c92e8644f', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:04:42', 'Test Setting Save | 2023-08-09 16:04:42', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:04:42', 'This is a test email <br/>\r\n\r\naut-veritatis-at-repellendus-rerum-aut-cumque\r\n', 'Sent', 1, '2023-08-09 16:04:48', NULL, NULL, 7, 1410, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:04:42', '2023-08-09 16:04:48', NULL, NULL);
INSERT INTO `emails` VALUES (159, '62327abd-caa5-4b02-aa54-eb7d082b80b2', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:04:49', 'Test Setting Save | 2023-08-09 16:04:49', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:04:49', 'This is a test email <br/>\r\n\r\nvelit-porro-maxime-adipisci-commodi-molestiae-sed-aut\r\n', 'Sent', 1, '2023-08-09 16:04:56', NULL, NULL, 7, 1411, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:04:49', '2023-08-09 16:04:56', NULL, NULL);
INSERT INTO `emails` VALUES (160, '5b3fb61e-5261-43d8-826f-20e9950c9c00', NULL, NULL, NULL, 'Test Setting Save | 2023-08-09 16:04:57', 'Test Setting Save | 2023-08-09 16:04:57', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-09 16:04:57', 'This is a test email <br/>\r\n\r\nvelit-porro-maxime-adipisci-commodi-molestiae-sed-aut\r\n', 'Sent', 1, '2023-08-09 16:05:03', NULL, NULL, 7, 1411, NULL, NULL, NULL, 1, 1, 1, '2023-08-09 16:04:57', '2023-08-09 16:05:03', NULL, NULL);
INSERT INTO `emails` VALUES (161, '3472c00a-60a5-4a66-9def-8643e05119d1', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:03:41', 'Test Setting Save | 2023-08-15 10:03:41', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:03:41', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:03:41', '2023-08-15 10:03:41', NULL, NULL);
INSERT INTO `emails` VALUES (162, '890a0e86-b139-48cd-ad54-d5b95f64fc35', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:04:42', 'Test Setting Save | 2023-08-15 10:04:42', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:04:42', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:04:42', '2023-08-15 10:04:42', NULL, NULL);
INSERT INTO `emails` VALUES (163, 'e9dd17e4-81cf-48f4-ada5-1f466c584085', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:11:13', 'Test Setting Save | 2023-08-15 10:11:13', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:11:13', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:11:13', '2023-08-15 10:11:13', NULL, NULL);
INSERT INTO `emails` VALUES (164, '4f9d5dac-083c-4842-8653-a55c303fe80d', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:11:29', 'Test Setting Save | 2023-08-15 10:11:29', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:11:29', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:11:29', '2023-08-15 10:11:29', NULL, NULL);
INSERT INTO `emails` VALUES (165, '84b2b2bc-fe7e-4a5f-b256-6753daf3998c', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:12:15', 'Test Setting Save | 2023-08-15 10:12:15', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:12:15', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:12:15', '2023-08-15 10:12:15', NULL, NULL);
INSERT INTO `emails` VALUES (166, 'd216a5bc-0076-4531-a221-c6b59884a27d', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:13:06', 'Test Setting Save | 2023-08-15 10:13:06', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:13:06', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:13:06', '2023-08-15 10:13:06', NULL, NULL);
INSERT INTO `emails` VALUES (167, 'f535dc1c-a906-45be-b8c0-7328e8f21b38', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:13:35', 'Test Setting Save | 2023-08-15 10:13:35', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:13:35', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:13:35', '2023-08-15 10:13:35', NULL, NULL);
INSERT INTO `emails` VALUES (168, '5b467eab-6172-4795-b50d-749471887fc5', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:14:05', 'Test Setting Save | 2023-08-15 10:14:05', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:14:05', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:14:05', '2023-08-15 10:14:05', NULL, NULL);
INSERT INTO `emails` VALUES (169, '20601c74-1d57-418c-b1b2-500bc2a5c5f3', NULL, NULL, NULL, 'Test Setting Save | 2023-08-15 10:14:46', 'Test Setting Save | 2023-08-15 10:14:46', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-15 10:14:46', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-15 10:14:46', '2023-08-15 10:14:46', NULL, NULL);
INSERT INTO `emails` VALUES (170, '285a3521-e8be-4658-9408-fb5d4d075786', NULL, NULL, NULL, 'Test Setting Save | 2023-08-21 17:06:43', 'Test Setting Save | 2023-08-21 17:06:43', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-21 17:06:43', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-21 17:06:43', '2023-08-21 17:06:43', NULL, NULL);
INSERT INTO `emails` VALUES (171, '78a5cc3e-cbd3-4d3e-8ffe-ee8c217e92d2', NULL, NULL, NULL, 'Test Setting Save | 2023-08-31 06:37:31', 'Test Setting Save | 2023-08-31 06:37:31', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-08-31 06:37:31', 'This is a test email <br/>\r\n\r\napp-name\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 1, 1, 1, '2023-08-31 06:37:31', '2023-08-31 06:37:31', NULL, NULL);
INSERT INTO `emails` VALUES (172, '31ac1993-e52d-4c83-9d3f-0931762841bf', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:05:23', 'Test Setting Save | 2023-09-12 06:05:23', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:05:23', 'This is a test email <br/>\r\n\r\ntenetur-quae-dolorem-et-esse-est\r\n', 'Sent', 1, '2023-09-12 06:05:28', NULL, NULL, 7, 1412, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:05:23', '2023-09-12 06:05:28', NULL, NULL);
INSERT INTO `emails` VALUES (173, 'f4d7bb48-d24e-482c-a3ec-14f7720883d5', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:05:29', 'Test Setting Save | 2023-09-12 06:05:29', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:05:29', 'This is a test email <br/>\r\n\r\ntenetur-quae-dolorem-et-esse-est\r\n', 'Sent', 1, '2023-09-12 06:05:34', NULL, NULL, 7, 1412, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:05:29', '2023-09-12 06:05:34', NULL, NULL);
INSERT INTO `emails` VALUES (174, '78d07104-db0b-4b37-aedc-a2452aee17ae', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:05:35', 'Test Setting Save | 2023-09-12 06:05:35', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:05:35', 'This is a test email <br/>\r\n\r\nperferendis-qui-earum-distinctio-repudiandae-libero-ea\r\n', 'Sent', 1, '2023-09-12 06:05:40', NULL, NULL, 7, 1413, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:05:35', '2023-09-12 06:05:40', NULL, NULL);
INSERT INTO `emails` VALUES (175, '8b1e3fa1-ea27-4e26-aff8-9d2a8c2bd8f3', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:05:41', 'Test Setting Save | 2023-09-12 06:05:41', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:05:41', 'This is a test email <br/>\r\n\r\nperferendis-qui-earum-distinctio-repudiandae-libero-ea\r\n', 'Sent', 1, '2023-09-12 06:05:47', NULL, NULL, 7, 1413, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:05:41', '2023-09-12 06:05:47', NULL, NULL);
INSERT INTO `emails` VALUES (176, 'c04ecf77-bd69-4a67-a31d-49d5baacdb5c', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:06:06', 'Test Setting Save | 2023-09-12 06:06:06', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:06:06', 'This is a test email <br/>\r\n\r\npraesentium-distinctio-adipisci-et-cupiditate-voluptas-numquam-voluptas\r\n', 'Sent', 1, '2023-09-12 06:06:11', NULL, NULL, 7, 1414, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:06:07', '2023-09-12 06:06:11', NULL, NULL);
INSERT INTO `emails` VALUES (177, 'c9dedeff-ac9f-40d3-800c-86b26e98923d', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:06:12', 'Test Setting Save | 2023-09-12 06:06:12', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:06:12', 'This is a test email <br/>\r\n\r\npraesentium-distinctio-adipisci-et-cupiditate-voluptas-numquam-voluptas\r\n', 'Sent', 1, '2023-09-12 06:06:18', NULL, NULL, 7, 1414, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:06:12', '2023-09-12 06:06:18', NULL, NULL);
INSERT INTO `emails` VALUES (178, '0b4f51b1-e06f-464a-b0fc-0a0a1df84c04', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:06:19', 'Test Setting Save | 2023-09-12 06:06:19', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:06:19', 'This is a test email <br/>\r\n\r\nincidunt-ad-ut-dolorem-voluptas\r\n', 'Sent', 1, '2023-09-12 06:06:23', NULL, NULL, 7, 1415, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:06:19', '2023-09-12 06:06:23', NULL, NULL);
INSERT INTO `emails` VALUES (179, 'd049f06f-7a76-430a-ad74-f3b52eca9066', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:06:24', 'Test Setting Save | 2023-09-12 06:06:24', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:06:24', 'This is a test email <br/>\r\n\r\nincidunt-ad-ut-dolorem-voluptas\r\n', 'Sent', 1, '2023-09-12 06:06:29', NULL, NULL, 7, 1415, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:06:24', '2023-09-12 06:06:29', NULL, NULL);
INSERT INTO `emails` VALUES (180, '3928f50a-ace6-4d54-9dda-564730184e19', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:06:43', 'Test Setting Save | 2023-09-12 06:06:43', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:06:43', 'This is a test email <br/>\r\n\r\nlabore-sit-quaerat-expedita\r\n', 'Sent', 1, '2023-09-12 06:06:48', NULL, NULL, 7, 1416, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:06:43', '2023-09-12 06:06:48', NULL, NULL);
INSERT INTO `emails` VALUES (181, '7245fff4-390e-4c3e-9c7c-c31465ccd54f', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:06:48', 'Test Setting Save | 2023-09-12 06:06:48', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:06:48', 'This is a test email <br/>\r\n\r\nlabore-sit-quaerat-expedita\r\n', 'Sent', 1, '2023-09-12 06:06:53', NULL, NULL, 7, 1416, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:06:48', '2023-09-12 06:06:53', NULL, NULL);
INSERT INTO `emails` VALUES (182, '0bd05c2c-864e-49ff-806f-d58e2b3273ea', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:06:54', 'Test Setting Save | 2023-09-12 06:06:54', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:06:54', 'This is a test email <br/>\r\n\r\nquae-saepe-enim-neque-consequuntur\r\n', 'Queued', NULL, NULL, NULL, NULL, 7, 1417, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:06:54', '2023-09-12 06:06:54', NULL, NULL);
INSERT INTO `emails` VALUES (183, '9ef3feb0-d2c8-47d0-b374-2ddbdc2f1067', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:07:02', 'Test Setting Save | 2023-09-12 06:07:02', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:07:02', 'This is a test email <br/>\r\n\r\ndoloremque-repudiandae-a-rerum-incidunt-ut\r\n', 'Sent', 1, '2023-09-12 06:07:07', NULL, NULL, 7, 1418, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:07:02', '2023-09-12 06:07:07', NULL, NULL);
INSERT INTO `emails` VALUES (184, '70c63ca0-c7d9-4861-8d82-ad18b9756d28', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:07:08', 'Test Setting Save | 2023-09-12 06:07:08', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:07:08', 'This is a test email <br/>\r\n\r\ndoloremque-repudiandae-a-rerum-incidunt-ut\r\n', 'Sent', 1, '2023-09-12 06:07:12', NULL, NULL, 7, 1418, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:07:08', '2023-09-12 06:07:12', NULL, NULL);
INSERT INTO `emails` VALUES (185, 'a990c935-732e-42e9-b4ec-4f13e7765d5e', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:07:13', 'Test Setting Save | 2023-09-12 06:07:13', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:07:13', 'This is a test email <br/>\r\n\r\nexplicabo-aut-enim-sit-qui\r\n', 'Sent', 1, '2023-09-12 06:07:18', NULL, NULL, 7, 1419, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:07:13', '2023-09-12 06:07:18', NULL, NULL);
INSERT INTO `emails` VALUES (186, 'f58f45ad-69d3-4fef-b3ef-c9bc138e1ff2', NULL, NULL, NULL, 'Test Setting Save | 2023-09-12 06:07:19', 'Test Setting Save | 2023-09-12 06:07:19', NULL, '[\"myemail@gmail.com\"]', '[]', '[]', 'Test Setting Save | 2023-09-12 06:07:19', 'This is a test email <br/>\r\n\r\nexplicabo-aut-enim-sit-qui\r\n', 'Sent', 1, '2023-09-12 06:07:24', NULL, NULL, 7, 1419, NULL, NULL, NULL, 1, 1, 1, '2023-09-12 06:07:19', '2023-09-12 06:07:24', NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(11) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `groups_uuid_index`(`uuid`) USING BTREE,
  INDEX `groups_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `groups_project_id_index`(`project_id`) USING BTREE,
  INDEX `groups_name_index`(`name`) USING BTREE,
  INDEX `groups_slug_index`(`slug`(1024)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES (1, 'd48c591a-e6b2-4f7b-9458-0693362e55a6', NULL, NULL, 'superuser', NULL, NULL, 'Superuser', '{\"superuser\":1}', 1, 1, 1, '2018-12-10 06:50:18', '2019-11-13 15:51:18', NULL, NULL);
INSERT INTO `groups` VALUES (2, '9c085751-ea3a-44e4-a858-e008894dc1f3', NULL, NULL, 'api', NULL, NULL, 'API', '{\"apis\":1,\"superuser\":1,\"make-api-call\":1}', 1, 1, 1, '2018-12-10 16:10:53', '2020-02-25 11:48:05', NULL, NULL);
INSERT INTO `groups` VALUES (3, '2e5c36e4-7ec2-4c77-8167-1e99237c1336', NULL, NULL, 'tenant-admin', NULL, NULL, 'Tenant Admin', '{\"app-settings\":1,\"changes\":1,\"changes-view-any\":1,\"changes-view\":1,\"changes-create\":1,\"changes-update\":1,\"changes-delete\":1,\"changes-view-change-log\":1,\"changes-view-report\":1,\"comments\":1,\"comments-view-any\":1,\"comments-view\":1,\"comments-create\":1,\"comments-update\":1,\"comments-delete\":1,\"comments-view-change-log\":1,\"comments-view-report\":1,\"contents\":1,\"contents-view-any\":1,\"contents-view\":1,\"contents-create\":1,\"contents-update\":1,\"contents-delete\":1,\"contents-view-change-log\":1,\"contents-view-report\":1,\"countries\":1,\"countries-view-any\":1,\"countries-view\":1,\"countries-create\":1,\"countries-update\":1,\"countries-delete\":1,\"countries-view-change-log\":1,\"countries-view-report\":1,\"groups\":1,\"groups-view-any\":1,\"groups-view\":1,\"groups-create\":1,\"groups-update\":1,\"groups-delete\":1,\"groups-view-change-log\":1,\"groups-view-report\":1,\"in-app-notifications\":1,\"in-app-notifications-view-any\":1,\"in-app-notifications-view\":1,\"in-app-notifications-create\":1,\"in-app-notifications-update\":1,\"in-app-notifications-delete\":1,\"in-app-notifications-view-change-log\":1,\"in-app-notifications-view-report\":1,\"module-groups\":1,\"module-groups-view-any\":1,\"module-groups-view\":1,\"module-groups-create\":1,\"module-groups-update\":1,\"module-groups-delete\":1,\"module-groups-view-change-log\":1,\"module-groups-view-report\":1,\"modules\":1,\"modules-view-any\":1,\"modules-view\":1,\"modules-create\":1,\"modules-update\":1,\"modules-delete\":1,\"modules-view-change-log\":1,\"modules-view-report\":1,\"notifications\":1,\"notifications-view-any\":1,\"notifications-view\":1,\"notifications-create\":1,\"notifications-update\":1,\"notifications-delete\":1,\"notifications-view-change-log\":1,\"notifications-view-report\":1,\"packages\":1,\"packages-view-any\":1,\"packages-view\":1,\"packages-create\":1,\"packages-update\":1,\"packages-delete\":1,\"packages-view-change-log\":1,\"packages-view-report\":1,\"projects\":1,\"projects-view-any\":1,\"projects-view\":1,\"projects-create\":1,\"projects-update\":1,\"projects-delete\":1,\"projects-view-change-log\":1,\"projects-view-report\":1,\"push-notifications\":1,\"push-notifications-view-any\":1,\"push-notifications-view\":1,\"push-notifications-create\":1,\"push-notifications-update\":1,\"push-notifications-delete\":1,\"push-notifications-view-change-log\":1,\"push-notifications-view-report\":1,\"reports\":1,\"reports-view-any\":1,\"reports-view\":1,\"reports-create\":1,\"reports-update\":1,\"reports-delete\":1,\"reports-view-change-log\":1,\"reports-view-report\":1,\"settings\":1,\"settings-view-any\":1,\"settings-view\":1,\"settings-create\":1,\"settings-update\":1,\"settings-delete\":1,\"settings-view-change-log\":1,\"settings-view-report\":1,\"spreads\":1,\"spreads-view-any\":1,\"spreads-view\":1,\"spreads-create\":1,\"spreads-update\":1,\"spreads-delete\":1,\"spreads-view-change-log\":1,\"spreads-view-report\":1,\"subscriptions\":1,\"subscriptions-view-any\":1,\"subscriptions-view\":1,\"subscriptions-create\":1,\"subscriptions-update\":1,\"subscriptions-delete\":1,\"subscriptions-view-change-log\":1,\"subscriptions-view-report\":1,\"tenants\":1,\"tenants-view-any\":1,\"tenants-view\":1,\"tenants-create\":1,\"tenants-update\":1,\"tenants-delete\":1,\"tenants-view-change-log\":1,\"tenants-view-report\":1,\"uploads\":1,\"uploads-view-any\":1,\"uploads-view\":1,\"uploads-create\":1,\"uploads-update\":1,\"uploads-delete\":1,\"uploads-view-change-log\":1,\"uploads-view-report\":1,\"users\":1,\"users-view-any\":1,\"users-view\":1,\"users-create\":1,\"users-update\":1,\"users-delete\":1,\"users-view-change-log\":1,\"users-view-report\":1}', 1, 5, 5, '1970-01-01 00:00:05', '2019-12-19 14:21:45', NULL, NULL);
INSERT INTO `groups` VALUES (4, 'bacee691-a0f7-4ba2-93b6-462b4af9cfb0', NULL, NULL, 'project-admin', NULL, NULL, 'Project Admin', '{\"app-settings\":1,\"changes\":1,\"changes-view-any\":1,\"changes-view\":1,\"changes-create\":1,\"changes-update\":1,\"changes-delete\":1,\"changes-view-change-log\":1,\"changes-view-report\":1,\"comments\":1,\"comments-view-any\":1,\"comments-view\":1,\"comments-create\":1,\"comments-update\":1,\"comments-delete\":1,\"comments-view-change-log\":1,\"comments-view-report\":1,\"contents\":1,\"contents-view-any\":1,\"contents-view\":1,\"contents-create\":1,\"contents-update\":1,\"contents-delete\":1,\"contents-view-change-log\":1,\"contents-view-report\":1,\"countries\":1,\"countries-view-any\":1,\"countries-view\":1,\"countries-create\":1,\"countries-update\":1,\"countries-delete\":1,\"countries-view-change-log\":1,\"countries-view-report\":1,\"groups\":1,\"groups-view-any\":1,\"groups-view\":1,\"groups-create\":1,\"groups-update\":1,\"groups-delete\":1,\"groups-view-change-log\":1,\"groups-view-report\":1,\"in-app-notifications\":1,\"in-app-notifications-view-any\":1,\"in-app-notifications-view\":1,\"in-app-notifications-create\":1,\"in-app-notifications-update\":1,\"in-app-notifications-delete\":1,\"in-app-notifications-view-change-log\":1,\"in-app-notifications-view-report\":1,\"module-groups\":1,\"module-groups-view-any\":1,\"module-groups-view\":1,\"module-groups-create\":1,\"module-groups-update\":1,\"module-groups-delete\":1,\"module-groups-view-change-log\":1,\"module-groups-view-report\":1,\"modules\":1,\"modules-view-any\":1,\"modules-view\":1,\"modules-create\":1,\"modules-update\":1,\"modules-delete\":1,\"modules-view-change-log\":1,\"modules-view-report\":1,\"notifications\":1,\"notifications-view-any\":1,\"notifications-view\":1,\"notifications-create\":1,\"notifications-update\":1,\"notifications-delete\":1,\"notifications-view-change-log\":1,\"notifications-view-report\":1,\"packages\":1,\"packages-view-any\":1,\"packages-view\":1,\"packages-create\":1,\"packages-update\":1,\"packages-delete\":1,\"packages-view-change-log\":1,\"packages-view-report\":1,\"projects\":1,\"projects-view-any\":1,\"projects-view\":1,\"projects-create\":1,\"projects-update\":1,\"projects-delete\":1,\"projects-view-change-log\":1,\"projects-view-report\":1,\"push-notifications\":1,\"push-notifications-view-any\":1,\"push-notifications-view\":1,\"push-notifications-create\":1,\"push-notifications-update\":1,\"push-notifications-delete\":1,\"push-notifications-view-change-log\":1,\"push-notifications-view-report\":1,\"reports\":1,\"reports-view-any\":1,\"reports-view\":1,\"reports-create\":1,\"reports-update\":1,\"reports-delete\":1,\"reports-view-change-log\":1,\"reports-view-report\":1,\"settings\":1,\"settings-view-any\":1,\"settings-view\":1,\"settings-create\":1,\"settings-update\":1,\"settings-delete\":1,\"settings-view-change-log\":1,\"settings-view-report\":1,\"spreads\":1,\"spreads-view-any\":1,\"spreads-view\":1,\"spreads-create\":1,\"spreads-update\":1,\"spreads-delete\":1,\"spreads-view-change-log\":1,\"spreads-view-report\":1,\"subscriptions\":1,\"subscriptions-view-any\":1,\"subscriptions-view\":1,\"subscriptions-create\":1,\"subscriptions-update\":1,\"subscriptions-delete\":1,\"subscriptions-view-change-log\":1,\"subscriptions-view-report\":1,\"tenants\":1,\"tenants-view-any\":1,\"tenants-view\":1,\"tenants-create\":1,\"tenants-update\":1,\"tenants-delete\":1,\"tenants-view-change-log\":1,\"tenants-view-report\":1,\"uploads\":1,\"uploads-view-any\":1,\"uploads-view\":1,\"uploads-create\":1,\"uploads-update\":1,\"uploads-delete\":1,\"uploads-view-change-log\":1,\"uploads-view-report\":1,\"users\":1,\"users-view-any\":1,\"users-view\":1,\"users-create\":1,\"users-update\":1,\"users-delete\":1,\"users-view-change-log\":1,\"users-view-report\":1}', 1, 5, 5, '2019-12-28 14:16:31', '2019-12-28 14:16:38', NULL, NULL);
INSERT INTO `groups` VALUES (5, '03682753-1654-46f1-ad9d-7a7f78794a3d', NULL, NULL, 'user', NULL, NULL, 'User', '{\"app-settings\":1,\"changes\":1,\"changes-view-any\":1,\"changes-view\":1,\"changes-create\":1,\"changes-update\":1,\"changes-delete\":1,\"changes-view-change-log\":1,\"comments\":1,\"comments-view-any\":1,\"comments-view\":1,\"comments-create\":1,\"comments-update\":1,\"comments-delete\":1,\"comments-view-change-log\":1,\"comments-view-report\":1,\"in-app-notifications\":1,\"in-app-notifications-view-any\":1,\"uploads\":1,\"uploads-view-any\":1,\"uploads-view\":1,\"uploads-create\":1,\"uploads-update\":1,\"uploads-delete\":1,\"uploads-view-change-log\":1,\"uploads-view-report\":1,\"users\":1,\"users-view-any\":1,\"users-view\":1,\"users-create\":1,\"users-update\":1,\"users-delete\":1,\"users-view-change-log\":1,\"users-view-report\":1}', 1, 1, 1, '2020-01-18 11:42:51', '2022-04-09 11:06:57', NULL, NULL);

-- ----------------------------
-- Table structure for in_app_notifications
-- ----------------------------
DROP TABLE IF EXISTS `in_app_notifications`;
CREATE TABLE `in_app_notifications`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Class of the notifiable',
  `notifiable_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `module_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `element_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `element_uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Recipient user id',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'Generic',
  `event` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Name of the event i.e. \"appointment.created\"',
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Subtitle the notification',
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Main body of the notification',
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'JSON array of image URLs',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Additional JSON payload',
  `order` int(10) UNSIGNED NULL DEFAULT 9999 COMMENT 'Can be useful for sequencing if needed',
  `is_visible` tinyint(4) NULL DEFAULT 1 COMMENT 'Flag to indicate whether this entry should be visible in the user notification list',
  `announcement_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Announcement id from which it is generated',
  `accepts_response` tinyint(4) NULL DEFAULT 0 COMMENT 'Flag to indicate whether user can respond to this notification',
  `response_options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'JSON to show response options',
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Capture user response to an announcement',
  `responded_at` datetime NULL DEFAULT NULL COMMENT 'Capture user response datetime',
  `read_at` datetime NULL DEFAULT NULL COMMENT 'Set the time stamp when a user \"marks as read\"',
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `in_app_notifications_uuid_index`(`uuid`) USING BTREE,
  INDEX `in_app_notifications_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `in_app_notifications_project_id_index`(`project_id`) USING BTREE,
  INDEX `in_app_notifications_user_id_index`(`user_id`) USING BTREE,
  INDEX `in_app_notifications_type_index`(`type`) USING BTREE,
  INDEX `in_app_notifications_event_index`(`event`) USING BTREE,
  INDEX `in_app_notifications_announcement_id_index`(`announcement_id`) USING BTREE,
  INDEX `in_app_notifications_read_at_index`(`read_at`) USING BTREE,
  INDEX `in_app_notifications_is_visible_index`(`is_visible`) USING BTREE,
  INDEX `notifiable_composite_index`(`notifiable_id`, `notifiable_type`) USING BTREE,
  INDEX `in_app_notifications_notifiable_id_index`(`notifiable_id`) USING BTREE,
  INDEX `in_app_notifications_notifiable_type_index`(`notifiable_type`) USING BTREE,
  INDEX `element_composite_index`(`module_id`, `element_id`) USING BTREE,
  INDEX `in_app_notifications_module_id_index`(`module_id`) USING BTREE,
  INDEX `in_app_notifications_element_id_index`(`element_id`) USING BTREE,
  INDEX `in_app_notifications_element_uuid_index`(`element_uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of in_app_notifications
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_08_08_100000_create_telescope_entries_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_09_29_125631_create_permission_tables', 2);
INSERT INTO `migrations` VALUES (6, '2019_11_20_140017_create_lorem_ipsums_table', 3);
INSERT INTO `migrations` VALUES (7, '2019_11_20_140847_create_dolor_sits_table', 4);
INSERT INTO `migrations` VALUES (8, '2019_12_19_135326_create_subscriptions_table', 5);
INSERT INTO `migrations` VALUES (9, '2019_12_19_140356_create_packages_table', 6);
INSERT INTO `migrations` VALUES (10, '2019_12_19_143935_create_notifications_table', 6);
INSERT INTO `migrations` VALUES (11, '2019_12_19_152132_create_product_themes_table', 7);
INSERT INTO `migrations` VALUES (12, '2019_12_28_134422_create_mf_projects_table', 8);
INSERT INTO `migrations` VALUES (13, '2020_01_06_134600_create_jobs_table', 9);
INSERT INTO `migrations` VALUES (14, '2020_01_07_123232_create_audits_table', 10);
INSERT INTO `migrations` VALUES (15, '2020_01_07_132100_delete_changes_table', 11);
INSERT INTO `migrations` VALUES (16, '2020_01_17_120103_create_artm_products_table', 12);
INSERT INTO `migrations` VALUES (17, '2020_01_17_120806_create_artm_products_table', 13);
INSERT INTO `migrations` VALUES (18, '2020_01_17_123930_create_artm_products_table', 14);
INSERT INTO `migrations` VALUES (19, '2020_02_25_083556_create_comments_table', 15);
INSERT INTO `migrations` VALUES (20, '2020_05_27_131750_update_reseller_permissions_for_dealreg', 16);
INSERT INTO `migrations` VALUES (21, '2020_06_02_043206_create_changes_table', 17);
INSERT INTO `migrations` VALUES (22, '2020_12_08_172319_change_db_table_engine', 18);
INSERT INTO `migrations` VALUES (23, '2020_12_08_211659_add_primary_keys', 18);
INSERT INTO `migrations` VALUES (24, '2021_02_09_042201_update_table_row_format', 19);
INSERT INTO `migrations` VALUES (25, '2021_02_20_075327_create_settings_table', 20);
INSERT INTO `migrations` VALUES (26, '2021_03_27_105634_create_in_app_notifications_table', 21);
INSERT INTO `migrations` VALUES (27, '2021_03_28_022622_create_push_notifications_table', 22);
INSERT INTO `migrations` VALUES (28, '2021_03_28_120834_remove_test_modules', 23);
INSERT INTO `migrations` VALUES (30, '2021_03_29_103920_increase_audits_field_size', 24);
INSERT INTO `migrations` VALUES (31, '2021_04_17_042516_create_spreads_table', 25);
INSERT INTO `migrations` VALUES (32, '2021_04_18_044034_create_contents_table', 26);
INSERT INTO `migrations` VALUES (33, '2021_04_24_050941_add_missing_mf_generic_fields_in_tables', 27);
INSERT INTO `migrations` VALUES (34, '2021_05_02_152112_add_uuid_in_in_app_notifications', 28);
INSERT INTO `migrations` VALUES (35, '2021_06_26_150434_create_job_batches_table', 28);
INSERT INTO `migrations` VALUES (36, '2021_06_26_043140_add_tenant_editable_in_settings_after_value', 29);
INSERT INTO `migrations` VALUES (37, '2021_07_03_094901_add_tenant_editable_in_reports', 30);
INSERT INTO `migrations` VALUES (38, '2022_03_18_135314_create_changes_table', 31);
INSERT INTO `migrations` VALUES (39, '2022_03_18_135322_create_comments_table', 31);
INSERT INTO `migrations` VALUES (40, '2022_03_18_135330_create_contents_table', 31);
INSERT INTO `migrations` VALUES (41, '2022_03_18_135337_create_countries_table', 31);
INSERT INTO `migrations` VALUES (42, '2022_03_18_135348_create_groups_table', 31);
INSERT INTO `migrations` VALUES (43, '2022_03_18_135355_create_in_app_notifications_table', 31);
INSERT INTO `migrations` VALUES (44, '2022_03_18_135403_create_module_groups_table', 31);
INSERT INTO `migrations` VALUES (45, '2022_03_18_135413_create_modules_table', 31);
INSERT INTO `migrations` VALUES (46, '2022_03_18_135423_create_notifications_table', 31);
INSERT INTO `migrations` VALUES (47, '2022_03_18_135430_create_packages_table', 31);
INSERT INTO `migrations` VALUES (48, '2022_03_18_135438_create_projects_table', 31);
INSERT INTO `migrations` VALUES (49, '2022_03_18_135445_create_push_notifications_table', 31);
INSERT INTO `migrations` VALUES (50, '2022_03_18_135453_create_reports_table', 31);
INSERT INTO `migrations` VALUES (51, '2022_03_18_135502_create_spreads_table', 31);
INSERT INTO `migrations` VALUES (52, '2022_03_18_135510_create_subscriptions_table', 31);
INSERT INTO `migrations` VALUES (53, '2022_03_18_135519_create_tenants_table', 31);
INSERT INTO `migrations` VALUES (57, '2022_03_30_095439_add_missing_indexes', 32);
INSERT INTO `migrations` VALUES (58, '2022_04_07_044654_add_name_ext_in_module_tables', 33);
INSERT INTO `migrations` VALUES (59, '2022_04_09_193710_add_slug_in_module_tables', 34);
INSERT INTO `migrations` VALUES (60, '2022_04_18_195552_add_index_for_key_and_ta_in_spreads', 35);
INSERT INTO `migrations` VALUES (61, '2022_04_24_104823_add_missing_indexes_in_users_table', 36);
INSERT INTO `migrations` VALUES (62, '2023_01_31_070906_create_emails_table', 37);
INSERT INTO `migrations` VALUES (63, '2023_03_08_172421_create_test_birds_table', 38);
INSERT INTO `migrations` VALUES (64, '2023_03_08_173634_create_test_birds_table', 39);

-- ----------------------------
-- Table structure for module_groups
-- ----------------------------
DROP TABLE IF EXISTS `module_groups`;
CREATE TABLE `module_groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `route_path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `route_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `level` int(11) NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `default_route` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `color_css` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon_css` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_visible` smallint(255) UNSIGNED NULL DEFAULT NULL,
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of module_groups
-- ----------------------------
INSERT INTO `module_groups` VALUES (1, '770e22e8-e572-44a3-9a9a-be7fb1964ae5', 'app-settings', NULL, NULL, 'Settings', 'Manage configuration', 'app-settings', 'app-settings', 0, 0, 0, 'app-settings.index', 'aqua', '<ion-icon name=\"settings-outline\"></ion-icon>', 1, 1, 1, 1, '2018-12-10 06:47:46', '2019-10-28 14:07:42', NULL, NULL);
INSERT INTO `module_groups` VALUES (2, 'a0dc562b-d6ce-45d1-9279-2a8ca2982dc8', 'accounts', NULL, NULL, 'Accounts', 'Manage accounts', 'accounts', 'accounts', 0, 0, 0, 'accounts.index', 'aqua', 'fa fa-calculator', 0, 1, 1, 1, '2018-12-14 06:18:07', '2019-10-28 12:41:42', NULL, NULL);

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `module_table` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `route_path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '/relative/path/to/index',
  `route_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'some.name',
  `class_directory` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'app/Mainframe/Modules/SomeModules',
  `namespace` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `model` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'app/Mainframe/Modules/SomeModules/NameOfModule',
  `policy` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `processor` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `controller` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `view_directory` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `module_group_id` int(11) NULL DEFAULT NULL,
  `level` int(11) NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `default_route` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `color_css` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon_css` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_visible` smallint(255) UNSIGNED NULL DEFAULT NULL,
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `modules_name_index`(`name`) USING BTREE,
  INDEX `modules_uuid_index`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES (1, 'ca56b8a2-368a-4f84-8336-e9850c406e2d', 'modules', NULL, NULL, NULL, NULL, 'Modules', 'Manage Modules', 'modules', 'modules', 'modules', 'app/Project/Modules/Modules', '\\App\\Project\\Modules\\Modules', '\\App\\Project\\Modules\\Modules\\Module', '\\App\\Project\\Modules\\Modules\\ModulePolicy', '\\App\\Project\\Modules\\Modules\\ModuleProcessor', '\\App\\Project\\Modules\\Modules\\ModuleController', 'project.modules.modules', 0, 1, 0, 0, 'modules.index', 'navy', 'fa fa-cube', 1, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (2, '0b89564c-7198-4b1b-9869-a02a0e584262', 'module-groups', NULL, NULL, NULL, NULL, 'Module groups', 'Manage Module groups', 'module_groups', 'module-groups', 'module-groups', 'app/Project/Modules/ModuleGroups', '\\App\\Project\\Modules\\ModuleGroups', '\\App\\Project\\Modules\\ModuleGroups\\ModuleGroup', '\\App\\Project\\Modules\\ModuleGroups\\ModuleGroupPolicy', '\\App\\Project\\Modules\\ModuleGroups\\ModuleGroupProcessor', '\\App\\Project\\Modules\\ModuleGroups\\ModuleGroupController', 'project.modules.module-groups', 0, 1, 0, 0, 'moduleg-roups.index', 'navy', 'fa fa-cubes', 1, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (3, 'eee7b4a8-abab-4b79-a751-b681624eb586', 'tenants', NULL, NULL, NULL, NULL, 'Tenants', 'Manage Tenants', 'tenants', 'tenants', 'tenants', 'app/Project/Modules/Tenants', '\\App\\Project\\Modules\\Tenants', '\\App\\Project\\Modules\\Tenants\\Tenant', '\\App\\Project\\Modules\\Tenants\\TenantPolicy', '\\App\\Project\\Modules\\Tenants\\TenantProcessor', '\\App\\Project\\Modules\\Tenants\\TenantController', 'project.modules.tenants', 0, 1, 0, 0, 'tenants.index', 'navy', 'fa fa-shield', 1, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (4, '8f27f918-3a05-4b04-9bd3-d953e9492293', 'users', NULL, NULL, NULL, NULL, 'User', 'Manage users', 'users', 'users', 'users', 'app/Project/Modules/Users', '\\App\\Project\\Modules\\Users', '\\App\\Project\\Modules\\Users\\User', '\\App\\Project\\Modules\\Users\\UserPolicy', '\\App\\Project\\Modules\\Users\\UserProcessor', '\\App\\Project\\Modules\\Users\\UserController', 'project.modules.users', 0, 0, 0, 4, 'users.index', 'navy', '<ion-icon name=\'people-outline\'></ion-icon>', 1, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (5, '14612def-5850-49fb-bf99-48d99c73b589', 'groups', NULL, NULL, NULL, NULL, 'Groups', 'Manage Groups', 'groups', 'groups', 'groups', 'app/Project/Modules/Groups', '\\App\\Project\\Modules\\Groups', '\\App\\Project\\Modules\\Groups\\Group', '\\App\\Project\\Modules\\Groups\\GroupPolicy', '\\App\\Project\\Modules\\Groups\\GroupProcessor', '\\App\\Project\\Modules\\Groups\\GroupController', 'project.modules.groups', 0, 1, 0, 0, 'groups.index', 'navy', 'fa fa-users', 1, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (6, '50ed1cc8-3ecf-4caf-9724-819cd90dd3d2', 'uploads', NULL, NULL, NULL, NULL, 'Upload', 'Manage uploads', 'uploads', 'uploads', 'uploads', 'app/Project/Modules/Uploads', '\\App\\Project\\Modules\\Uploads', '\\App\\Project\\Modules\\Uploads\\Upload', '\\App\\Project\\Modules\\Uploads\\UploadPolicy', '\\App\\Project\\Modules\\Uploads\\UploadProcessor', '\\App\\Project\\Modules\\Uploads\\UploadController', 'project.modules.uploads', 0, 1, 0, 0, 'uploads.index', 'navy', 'fa fa-upload', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (7, '6d1fff93-328b-4501-b643-e21cc6cbf9d2', 'settings', NULL, NULL, NULL, NULL, 'Setting', 'Manage setting', 'settings', 'settings', 'settings', 'app/Project/Modules/Settings', '\\App\\Project\\Modules\\Settings', '\\App\\Project\\Modules\\Settings\\Setting', '\\App\\Project\\Modules\\Settings\\SettingPolicy', '\\App\\Project\\Modules\\Settings\\SettingProcessor', '\\App\\Project\\Modules\\Settings\\SettingController', 'project.modules.settings', 0, 1, 0, 0, 'settings.index', 'navy', '<ion-icon name=\"settings-outline\"></ion-icon>', 1, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (8, '3207985e-3886-4a1c-8121-c8e4147cfa72', 'reports', NULL, NULL, NULL, NULL, 'Reports', 'Manage Reports', 'reports', 'reports', 'reports', 'app/Project/Modules/Reports', '\\App\\Project\\Modules\\Reports', '\\App\\Project\\Modules\\Reports\\Report', '\\App\\Project\\Modules\\Reports\\ReportPolicy', '\\App\\Project\\Modules\\Reports\\ReportProcessor', '\\App\\Project\\Modules\\Reports\\ReportController', 'project.modules.reports', 0, 1, 0, 999, 'reports.index', 'navy', 'fa fa-file-text-o', 1, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (9, '2da95896-4a15-4ad6-9919-767dabeef9fe', 'subscriptions', NULL, NULL, NULL, NULL, 'Subscriptions', 'Manage Subscriptions', 'subscriptions', 'subscriptions', 'subscriptions', 'app/Project/Modules/Subscriptions', '\\App\\Project\\Modules\\Subscriptions', '\\App\\Project\\Modules\\Subscriptions\\Subscription', '\\App\\Project\\Modules\\Subscriptions\\SubscriptionPolicy', '\\App\\Project\\Modules\\Subscriptions\\SubscriptionProcessor', '\\App\\Project\\Modules\\Subscriptions\\SubscriptionController', 'project.modules.subscriptions', 0, 1, 0, 0, 'subscriptions.index', 'navy', 'fa fa-shopping-cart', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (10, '11a3b809-b3e0-4c8f-b59a-b99192e99588', 'packages', NULL, NULL, NULL, NULL, 'Packages', 'Manage Packages', 'packages', 'packages', 'packages', 'app/Project/Modules/Packages', '\\App\\Project\\Modules\\Packages', '\\App\\Project\\Modules\\Packages\\Package', '\\App\\Project\\Modules\\Packages\\PackagePolicy', '\\App\\Project\\Modules\\Packages\\PackageProcessor', '\\App\\Project\\Modules\\Packages\\PackageController', 'project.modules.packages', 0, 1, 0, 0, 'packages.index', 'navy', 'fa fa-credit-card', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (11, 'c4582951-e9ee-4d1d-a9de-9230c037699a', 'countries', NULL, NULL, NULL, NULL, 'Countries', 'Manage Countries', 'countries', 'countries', 'countries', 'app/Project/Modules/Countries', '\\App\\Project\\Modules\\Countries', '\\App\\Project\\Modules\\Countries\\Country', '\\App\\Project\\Modules\\Countries\\CountryPolicy', '\\App\\Project\\Modules\\Countries\\CountryProcessor', '\\App\\Project\\Modules\\Countries\\CountryController', 'project.modules.countries', 0, 1, 0, 0, 'countries.index', 'navy', 'fa fa-map-o', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (12, 'cb21c345-ba75-452c-b326-5c20f6cd17b8', 'notifications', NULL, NULL, NULL, NULL, 'Notifications', 'Manage Notifications', 'notifications', 'notifications', 'notifications', 'app/Project/Modules/Notifications', '\\App\\Project\\Modules\\Notifications', '\\App\\Project\\Modules\\Notifications\\Notification', '\\App\\Project\\Modules\\Notifications\\NotificationPolicy', '\\App\\Project\\Modules\\Notifications\\NotificationProcessor', '\\App\\Project\\Modules\\Notifications\\NotificationController', 'project.modules.notifications', 0, 1, 0, 0, 'notifications.index', 'navy', 'fa fa-comment-o', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (13, '47df59d0-bacb-4d1e-bfda-01c051c63681', 'projects', NULL, NULL, NULL, NULL, 'Projects', 'Manage Projects', 'projects', 'projects', 'projects', 'app/Project/Modules/Projects', '\\App\\Project\\Modules\\Projects', '\\App\\Project\\Modules\\Projects\\Project', '\\App\\Project\\Modules\\Projects\\ProjectPolicy', '\\App\\Project\\Modules\\Projects\\ProjectProcessor', '\\App\\Project\\Modules\\Projects\\ProjectController', 'project.modules.projects', 0, 1, 0, 0, 'projects.index', 'navy', 'fa fa-bars', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (14, '74ed8001-1178-46f4-b1e6-b6e73fd7ae04', 'comments', NULL, NULL, NULL, NULL, 'Comments', 'Manage Comments', 'comments', 'comments', 'comments', 'app/Project/Modules/Comments', '\\App\\Project\\Modules\\Comments', '\\App\\Project\\Modules\\Comments\\Comment', '\\App\\Project\\Modules\\Comments\\CommentPolicy', '\\App\\Project\\Modules\\Comments\\CommentProcessor', '\\App\\Project\\Modules\\Comments\\CommentController', 'project.modules.comments', 0, 1, 0, 0, 'comments.index', 'navy', 'fa fa-comments-o', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (15, '0a79b419-8960-4957-badc-ee905f7bf020', 'changes', NULL, NULL, NULL, NULL, 'Changes', 'Manage Changes', 'changes', 'changes', 'changes', 'app/Project/Modules/Changes', '\\App\\Project\\Modules\\Changes', '\\App\\Project\\Modules\\Changes\\Change', '\\App\\Project\\Modules\\Changes\\ChangePolicy', '\\App\\Project\\Modules\\Changes\\ChangeProcessor', '\\App\\Project\\Modules\\Changes\\ChangeController', 'project.modules.changes', 0, 1, 0, 0, 'changes.index', 'navy', 'fa fa-edit', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (16, 'cbdc76e1-6600-46a8-bd4e-c7237b5153f1', 'in-app-notifications', NULL, NULL, NULL, NULL, 'In app notifications', 'Manage In app notifications', 'in_app_notifications', 'in-app-notifications', 'in-app-notifications', 'app/Project/Modules/InAppNotifications', '\\App\\Project\\Modules\\InAppNotifications', '\\App\\Project\\Modules\\InAppNotifications\\InAppNotification', '\\App\\Project\\Modules\\InAppNotifications\\InAppNotificationPolicy', '\\App\\Project\\Modules\\InAppNotifications\\InAppNotificationProcessor', '\\App\\Project\\Modules\\InAppNotifications\\InAppNotificationController', 'project.modules.in-app-notifications', 0, 1, 0, 0, 'in-app-notifications.index', 'navy', 'fa fa-exclamation', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (17, 'ad2ccfe4-2e24-4a65-8587-5ac11ea99312', 'push-notifications', NULL, NULL, NULL, NULL, 'Push notifications', 'Manage Push notifications', 'push_notifications', 'push-notifications', 'push-notifications', 'app/Project/Modules/PushNotifications', '\\App\\Project\\Modules\\PushNotifications', '\\App\\Project\\Modules\\PushNotifications\\PushNotification', '\\App\\Project\\Modules\\PushNotifications\\PushNotificationPolicy', '\\App\\Project\\Modules\\PushNotifications\\PushNotificationProcessor', '\\App\\Project\\Modules\\PushNotifications\\PushNotificationController', 'project.modules.push-notifications', 0, 1, 0, 0, 'push-notifications.index', 'navy', 'fa fa-mobile', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (18, '7c824184-6b7e-4a22-b496-baab908e863f', 'spreads', NULL, NULL, NULL, NULL, 'Spreads', 'Manage Spreads', 'spreads', 'spreads', 'spreads', 'app/Project/Modules/Spreads', '\\App\\Project\\Modules\\Spreads', '\\App\\Project\\Modules\\Spreads\\Spread', '\\App\\Project\\Modules\\Spreads\\SpreadPolicy', '\\App\\Project\\Modules\\Spreads\\SpreadProcessor', '\\App\\Project\\Modules\\Spreads\\SpreadController', 'project.modules.spreads', 0, 1, 0, 0, 'spreads.index', 'navy', 'fa fa-caret-square-o-right', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (19, 'a0f3fff3-716c-428f-90f1-87db9c4da9ff', 'contents', NULL, NULL, NULL, NULL, 'Contents', 'Manage Contents', 'contents', 'contents', 'contents', 'app/Project/Modules/Contents', '\\App\\Project\\Modules\\Contents', '\\App\\Project\\Modules\\Contents\\Content', '\\App\\Project\\Modules\\Contents\\ContentPolicy', '\\App\\Project\\Modules\\Contents\\ContentProcessor', '\\App\\Project\\Modules\\Contents\\ContentController', 'project.modules.contents', 0, 1, 0, 0, 'contents.index', 'navy', 'fa fa-file-text-o', 0, 1, NULL, NULL, NULL, '2023-03-07 15:28:32', NULL, NULL);
INSERT INTO `modules` VALUES (20, '31adf9d2-8475-4de8-992f-a8ac96fae038', 'emails', NULL, NULL, NULL, NULL, 'Emails', 'Manage Emails', 'emails', 'emails', 'emails', 'app/Project/Modules/Emails', '\\App\\Project\\Modules\\Emails', '\\App\\Project\\Modules\\Emails\\Email', '\\App\\Project\\Modules\\Emails\\EmailPolicy', '\\App\\Project\\Modules\\Emails\\EmailProcessor', '\\App\\Project\\Modules\\Emails\\EmailController', 'project.modules.emails', NULL, 1, 0, 99, 'emails', 'navy', 'fa fa-cube', 1, 1, 1, NULL, '2023-02-02 09:30:31', '2023-03-07 15:28:32', NULL, NULL);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `element_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `element_uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `notifications_notifiable_type_notifiable_id_index`(`notifiable_type`, `notifiable_id`) USING BTREE,
  INDEX `notifications_notifiable_id_index`(`notifiable_id`) USING BTREE,
  INDEX `notifications_notifiable_type_index`(`notifiable_type`) USING BTREE,
  INDEX `element_composite_index`(`module_id`, `element_id`) USING BTREE,
  INDEX `notifications_module_id_index`(`module_id`) USING BTREE,
  INDEX `notifications_element_id_index`(`element_id`) USING BTREE,
  INDEX `notifications_element_uuid_index`(`element_uuid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for packages
-- ----------------------------
DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `monthly_price` decimal(10, 2) UNSIGNED NULL DEFAULT NULL,
  `yearly_price` decimal(10, 2) NULL DEFAULT NULL,
  `modules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `limits` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of packages
-- ----------------------------
INSERT INTO `packages` VALUES (1, '3472a4e8-220e-4f72-853a-5624ca6cd103', 'Test Package', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2021-03-27 15:17:48', '2021-03-27 15:17:48', NULL, NULL);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `configuration` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'JSON configuration for a project',
  `route_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `class_directory` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `namespace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `view_directory` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (1, 'b632635d-877b-461e-8f3f-97256567eea7', 'default-project', 'DefaultProject', NULL, NULL, NULL, NULL, '', 'app/Projects/DefaultProject', '\\App\\Projects\\DefaultProject', 'projects.default-project', 1, 1, 1, '2019-12-28 14:13:40', '2019-12-28 14:13:40', NULL, NULL);

-- ----------------------------
-- Table structure for push_notifications
-- ----------------------------
DROP TABLE IF EXISTS `push_notifications`;
CREATE TABLE `push_notifications`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Recipient user id',
  `device_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Firebase Device Identifier to target a user',
  `in_app_notification_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Related in-app notification',
  `order` int(10) UNSIGNED NULL DEFAULT 9999 COMMENT 'Can be used for ordering/sequencing sending',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'Generic' COMMENT 'Generic|Popup Type indicates the purpose or objective. It is often mapped with a paired in-app notification\'',
  `event` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Name of the event i.e. \"appointment.created\"',
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Main body of the notification',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Additional JSON payload',
  `api_response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Full JSON response from the sender service',
  `multicast_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Set from FCM response of send attempt. The existence of multicast_id indicates that attempt was successfully made. Fill from api_response',
  `success_count` int(11) NULL DEFAULT 0 COMMENT 'Fill from api_response',
  `failure_count` int(11) NULL DEFAULT 0 COMMENT 'Fill from api_response',
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `push_notifications_uuid_index`(`uuid`) USING BTREE,
  INDEX `push_notifications_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `push_notifications_project_id_index`(`project_id`) USING BTREE,
  INDEX `push_notifications_user_id_index`(`user_id`) USING BTREE,
  INDEX `push_notifications_device_token_index`(`device_token`(768)) USING BTREE,
  INDEX `push_notifications_type_index`(`type`) USING BTREE,
  INDEX `push_notifications_event_index`(`event`) USING BTREE,
  INDEX `push_notifications_in_app_notification_id_index`(`in_app_notification_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of push_notifications
-- ----------------------------

-- ----------------------------
-- Table structure for reports
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(11) NULL DEFAULT NULL,
  `name` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parameters` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `version` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `module_id` int(11) UNSIGNED NULL DEFAULT NULL,
  `is_module_default` smallint(6) NULL DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `is_tenant_editable` tinyint(4) NULL DEFAULT 0 COMMENT 'Some settings are not allowed to be edited by tenant',
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `reports_uuid_index`(`uuid`) USING BTREE,
  INDEX `reports_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `reports_project_id_index`(`project_id`) USING BTREE,
  INDEX `reports_name_index`(`name`) USING BTREE,
  INDEX `reports_code_index`(`code`) USING BTREE,
  INDEX `reports_module_id_index`(`module_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reports
-- ----------------------------
INSERT INTO `reports` VALUES (1, 'bb87fa55-0e80-4fb7-ad5c-4d5b3bd55f2d', NULL, NULL, 'User Report', NULL, NULL, NULL, 'User Report', 'Generic user base report', '%2Fusers%2Freport%3Falias_columns_csv%3DId%252CName%252CCreated%2520At%252CUpdated%2520At%26columns_csv%3Did%252Cname%252Ccreated_at%252Cupdated_at%26created_at_from%3D2021-06-01%26created_at_till%3D%26formatted_created_at_from%3D01-06-2021%26formatted_created_at_till%3D%26group_by%3D%26order_by%3D%26report_name%3D%26rows_per_page%3D%26submit%3DRun', NULL, '1.0', NULL, NULL, 'user,generic,report', 0, 1, 1, 1, '2021-06-27 03:37:50', '2021-06-27 04:34:26', NULL, NULL);
INSERT INTO `reports` VALUES (2, '293adf61-4aa2-41d3-9359-3f6970a0b1ab', NULL, NULL, 'Test Json Param', NULL, NULL, NULL, 'Test Json Param', NULL, '{\"test\": \"value\"}', NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, '2021-10-05 11:19:51', '2021-10-05 11:25:36', NULL, NULL);
INSERT INTO `reports` VALUES (3, '410c8801-6452-4a1b-9375-c865f5599788', NULL, NULL, 'Test users report', NULL, NULL, NULL, NULL, NULL, '%2Fusers%2Freport', NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, '2022-05-16 12:41:02', '2022-05-16 12:44:49', NULL, NULL);
INSERT INTO `reports` VALUES (4, 'f04066d8-cf3d-4763-ae44-998581093ce0', NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, '2022-05-16 12:43:12', '2022-05-16 12:43:12', NULL, NULL);

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `tenant_editable` tinyint(4) NULL DEFAULT 0 COMMENT 'Some settings are not allowed to be edited by tenant',
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `settings_uuid_index`(`uuid`) USING BTREE,
  INDEX `settings_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `settings_project_id_index`(`project_id`) USING BTREE,
  INDEX `settings_name_index`(`name`) USING BTREE,
  INDEX `settings_slug_index`(`slug`(1024)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1424 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, '6e9d6b57-966d-4b1e-aa77-fc937d9118b6', NULL, NULL, 'app-name', NULL, NULL, 'App Name', 'string', 'Mainframe Rapid Development Framework', 'Mainframe', 0, 1, 1, 1, '2018-12-24 20:25:41', '2021-04-17 03:30:36', NULL, NULL);

-- ----------------------------
-- Table structure for spreads
-- ----------------------------
DROP TABLE IF EXISTS `spreads`;
CREATE TABLE `spreads`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `spreadable_type` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `spreadable_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `element_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `element_uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Field name ',
  `tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tag name ',
  `relates_to` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'The second model',
  `related_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `spreadable_composite_index`(`spreadable_id`, `spreadable_type`) USING BTREE,
  INDEX `relates_to_composite_index`(`relates_to`, `related_id`) USING BTREE,
  INDEX `spreads_spreadable_id_index`(`spreadable_id`) USING BTREE,
  INDEX `spreads_spreadable_type_index`(`spreadable_type`) USING BTREE,
  INDEX `element_composite_index`(`module_id`, `element_id`) USING BTREE,
  INDEX `spreads_module_id_index`(`module_id`) USING BTREE,
  INDEX `spreads_element_id_index`(`element_id`) USING BTREE,
  INDEX `spreads_element_uuid_index`(`element_uuid`) USING BTREE,
  INDEX `spreadable_type_tag`(`tag`, `spreadable_type`) USING BTREE,
  INDEX `module_id_tag`(`tag`, `module_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of spreads
-- ----------------------------
INSERT INTO `spreads` VALUES (1, '1d971099-44a8-4219-9851-ab5a52986fc0', NULL, NULL, 'users', NULL, NULL, 'App\\User', 1, 4, 1, '3ef9b174-6c7c-41fd-b68e-18d003fb9481', 'group_ids', NULL, 'App\\Group', 1, 1, 1, 1, '2023-10-02 10:41:53', '2023-10-02 10:41:53', NULL, NULL);

-- ----------------------------
-- Table structure for subscriptions
-- ----------------------------
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `package_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `valid_from` timestamp NULL DEFAULT NULL,
  `valid_till` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subscriptions
-- ----------------------------

-- ----------------------------
-- Table structure for telescope_entries
-- ----------------------------
DROP TABLE IF EXISTS `telescope_entries`;
CREATE TABLE `telescope_entries`  (
  `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`sequence`) USING BTREE,
  UNIQUE INDEX `telescope_entries_uuid_unique`(`uuid`) USING BTREE,
  INDEX `telescope_entries_batch_id_index`(`batch_id`) USING BTREE,
  INDEX `telescope_entries_type_should_display_on_index_index`(`type`, `should_display_on_index`) USING BTREE,
  INDEX `telescope_entries_family_hash_index`(`family_hash`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 179393 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of telescope_entries
-- ----------------------------

-- ----------------------------
-- Table structure for telescope_entries_tags
-- ----------------------------
DROP TABLE IF EXISTS `telescope_entries_tags`;
CREATE TABLE `telescope_entries_tags`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `entry_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `telescope_entries_tags_entry_uuid_tag_index`(`entry_uuid`, `tag`) USING BTREE,
  INDEX `telescope_entries_tags_tag_index`(`tag`) USING BTREE,
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 63947 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of telescope_entries_tags
-- ----------------------------

-- ----------------------------
-- Table structure for telescope_monitoring
-- ----------------------------
DROP TABLE IF EXISTS `telescope_monitoring`;
CREATE TABLE `telescope_monitoring`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of telescope_monitoring
-- ----------------------------

-- ----------------------------
-- Table structure for tenants
-- ----------------------------
DROP TABLE IF EXISTS `tenants`;
CREATE TABLE `tenants`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_id` int(11) UNSIGNED NULL DEFAULT NULL COMMENT 'Tenant admin who signed up',
  `route_group` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `class_directory` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `namespace` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `view_directory` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tenants
-- ----------------------------
INSERT INTO `tenants` VALUES (1, 'ceba2dba-bfad-4045-a36f-ce0572f77679', 1, 'ArtemisPod-default', NULL, NULL, 'artp', NULL, 'artp', 'app/Projects/ArtemisPod', '\\App\\ArtemisPod', 'mainframe.projects.artemis-pod', 1, 5, 5, '2019-12-19 13:31:02', '2019-12-19 13:31:02', NULL, NULL);

-- ----------------------------
-- Table structure for uploads
-- ----------------------------
DROP TABLE IF EXISTS `uploads`;
CREATE TABLE `uploads`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(11) NULL DEFAULT NULL,
  `name` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `order` smallint(6) UNSIGNED NULL DEFAULT 0,
  `ext` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `bytes` bigint(20) NULL DEFAULT NULL,
  `description` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `uploadable_type` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `uploadable_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `module_id` int(11) NULL DEFAULT NULL,
  `element_id` bigint(20) NULL DEFAULT NULL,
  `element_uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uploadable_composite_index`(`uploadable_id`, `uploadable_type`) USING BTREE,
  INDEX `uploads_uploadable_id_index`(`uploadable_id`) USING BTREE,
  INDEX `uploads_uploadable_type_index`(`uploadable_type`) USING BTREE,
  INDEX `element_composite_index`(`module_id`, `element_id`) USING BTREE,
  INDEX `uploads_module_id_index`(`module_id`) USING BTREE,
  INDEX `uploads_element_id_index`(`element_id`) USING BTREE,
  INDEX `uploads_element_uuid_index`(`element_uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of uploads
-- ----------------------------

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_group_user_id_index`(`user_id`) USING BTREE,
  INDEX `user_group_group_id_index`(`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3544 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES (1, 2, 2, NULL, NULL);
INSERT INTO `user_group` VALUES (2, 1, 1, NULL, NULL);
INSERT INTO `user_group` VALUES (2479, 999, 3, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `api_token` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'X-Auth-Token',
  `api_token_generated_at` datetime NULL DEFAULT NULL,
  `is_tenant_editable` smallint(6) NOT NULL DEFAULT 1,
  `permissions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_active` smallint(6) NULL DEFAULT 1,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `name_initial` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `first_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `last_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `full_name` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `date_of_birth` date NULL DEFAULT NULL,
  `gender` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `device_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `address1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `address2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `city` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `county` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `country_id` int(11) NULL DEFAULT NULL,
  `country_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `zip_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `first_login_at` datetime NULL DEFAULT NULL,
  `last_login_at` datetime NULL DEFAULT NULL,
  `auth_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Bearer token',
  `email_verified_at` datetime NULL DEFAULT NULL,
  `email_verification_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `currency` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `social_account_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `social_account_type` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `dob` date NULL DEFAULT NULL,
  `group_ids` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `is_test` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_uuid_index`(`uuid`) USING BTREE,
  INDEX `users_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `users_project_id_index`(`project_id`) USING BTREE,
  INDEX `users_name_index`(`name`) USING BTREE,
  INDEX `users_email_index`(`email`) USING BTREE,
  INDEX `users_password_index`(`password`) USING BTREE,
  INDEX `users_remember_token_index`(`remember_token`) USING BTREE,
  INDEX `users_api_token_index`(`api_token`) USING BTREE,
  INDEX `users_device_token_index`(`device_token`) USING BTREE,
  INDEX `users_phone_index`(`phone`) USING BTREE,
  INDEX `users_mobile_index`(`mobile`) USING BTREE,
  INDEX `users_auth_token_index`(`auth_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7757 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '3ef9b174-6c7c-41fd-b68e-18d003fb9481', NULL, NULL, ' Prime Superuser', NULL, NULL, 'su@mainframe', '$2y$10$MPClZ27.7vXjZR9U.RtAOunXE7aNR3CTe.m9JYJTpVlLTmDWBZhBq', 'oOgs70O82nZS4jqHVXHamFjGxkwe7Of2sFMnAP0CdlcQU4Semre5vMMCnpUd', 'GGs2iK5sujPyEfSrUIB0JR3dXPRy4goTw4ylkpeGATfzFO1JQwWZwUTzWU1DauhT', '2021-02-19 20:38:22', 1, NULL, 1, 1, 1, '2018-09-10 15:30:06', '2023-10-01 03:27:47', NULL, NULL, NULL, 'Prime', 'Superuser', 'Prime Superuser', '2021-06-30', NULL, NULL, NULL, NULL, NULL, NULL, 187, 'UK (United Kingdom)', NULL, NULL, NULL, '2020-02-08 10:55:44', '2023-10-01 03:27:47', 'UMZ9oxfJ7gL0OtbBUIe/odaOr1jEFDq1', '2019-01-22 19:27:07', NULL, 'GBP', NULL, NULL, NULL, '[\"1\"]', 0);
INSERT INTO `users` VALUES (2, '856a81bf-ab1b-4289-9d65-9751009d00ad', NULL, NULL, ' LB API', NULL, NULL, 'api@mainframe', '$2y$10$t5wa5wPH8XAgoRYyptOJ0uSf/klm0S/71XUdK3Gz.2llsQHh1nXAm', 'cbumaoNR3y2g9tOlFrieitXXsaDI8TrDUykzhqDhhQNh58BqE8zmj61Irvrk', '7c0f2f2802ffab09ec139275d595caaa91c6b2d2dc1340e40bdde1afb83b3ec0', NULL, 0, NULL, 1, 1, 1, '2018-12-24 05:48:25', '2023-09-19 17:37:39', NULL, NULL, NULL, 'LB', 'API', 'LB API', NULL, NULL, 'eFGlVn8yFn8:APA91bHgq2zk-9JrBNNtVMn4iFMB6eicQOUVyFZGRft8jv-GwGJej9sFppTG5w9E_3IeOyR_3NN1i3cWFHaiVl_k1Zlt2jDMVoh7D90CsJG1qxVnuruH-Eidi1CgO9QVlpmFByK2azr3', '62142 Haley Lake', NULL, NULL, NULL, 187, 'UK (United Kingdom)', NULL, NULL, NULL, '2019-01-31 08:31:54', '2019-04-09 15:17:25', 'Q29anuSIvoR9N8OmB2ueGGRI8tlHPZau', '2019-01-22 19:27:07', NULL, 'GBP', NULL, NULL, NULL, '[\"2\"]', 0);
INSERT INTO `users` VALUES (999, '0b11bb84-a6f9-4612-b823-6eb0feda3342', NULL, NULL, ' No, test, now Test', NULL, NULL, 'raihan.act@gmail.com', '$2y$10$zZmnBn0xe0wXNCmKpWFnV.dQq/yJasjT4Bk1gZ9yQdWrp/e.2GgFK', NULL, NULL, NULL, 1, NULL, 1, 1, 1, '2020-01-06 16:55:14', '2021-04-24 04:54:48', NULL, NULL, NULL, 'No, test, now', 'Test', 'Dote Test', NULL, NULL, NULL, '018 Alva Mountain', NULL, NULL, NULL, 187, NULL, NULL, NULL, NULL, '2020-06-30 15:49:31', '2020-06-30 15:50:15', 'LoremIpsumSIvoR9N8OmB2ueLoremIpsu', '2019-01-22 19:27:07', NULL, NULL, NULL, NULL, NULL, '[\"3\"]', 0);

SET FOREIGN_KEY_CHECKS = 1;

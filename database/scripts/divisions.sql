/*
 Navicat Premium Data Transfer

 Source Server         : Forge-Optimus
 Source Server Type    : MariaDB
 Source Server Version : 100603
 Source Host           : 159.65.27.1:3306
 Source Schema         : dgme_prod_student_portal_20220513

 Target Server Type    : MariaDB
 Target Server Version : 100603
 File Encoding         : 65001

 Date: 04/10/2023 14:03:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for divisions
-- ----------------------------
DROP TABLE IF EXISTS `divisions`;
CREATE TABLE `divisions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `combined_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `longitude` double NULL DEFAULT NULL,
  `latitude` double NULL DEFAULT NULL,
  `is_active` tinyint(4) NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `divisions_uuid_index`(`uuid`) USING BTREE,
  INDEX `divisions_project_id_index`(`project_id`) USING BTREE,
  INDEX `divisions_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `divisions_name_index`(`name`) USING BTREE,
  INDEX `divisions_code_index`(`code`) USING BTREE,
  INDEX `divisions_combined_code_index`(`combined_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of divisions
-- ----------------------------
INSERT INTO `divisions` VALUES (1, '998e5f1d-6e66-4637-b451-9123480714b8', NULL, NULL, 'Dhaka', NULL, 'dhaka', 'ঢাকা', '30', '30', 90.4125181, 23.810332, 1, 18561, 18561, '2015-12-10 15:43:15', '2015-12-10 15:43:15', NULL, NULL);
INSERT INTO `divisions` VALUES (2, '13bdd98c-47ed-4a9a-89f4-cea33600b658', NULL, NULL, 'Chattogram', NULL, 'chattogram', 'চট্টগ্রাম', '20', '20', 91.815536, 22.3419, 1, 18561, 18148, '2015-12-10 15:34:09', '2020-06-16 20:13:28', NULL, NULL);
INSERT INTO `divisions` VALUES (3, '30d24a05-65f7-474c-a3b3-7645d9e1dd5f', NULL, NULL, 'Rajshahi', NULL, 'rajshahi', 'রাজশাহী', '50', '50', 88.94139, 24.71058, 1, 18561, 18561, '2015-12-10 15:34:37', '2015-12-10 15:34:37', NULL, NULL);
INSERT INTO `divisions` VALUES (4, '86cf6784-78b9-4a20-9625-15d14318a1a5', NULL, NULL, 'Rangpur', NULL, 'rangpur', 'রংপুর', '55', '55', 88.94139, 25.84834, 1, 18435, 4, '2014-12-14 10:53:05', '2016-12-28 15:23:20', NULL, NULL);
INSERT INTO `divisions` VALUES (5, 'd22de31e-e870-4d3d-aed8-21049f8f0122', NULL, NULL, 'Khulna', NULL, 'khulna', 'খুলনা', '40', '40', 89.24672, 22.80878, 1, 7, 4, '2014-11-19 17:45:39', '2016-12-28 15:20:34', NULL, NULL);
INSERT INTO `divisions` VALUES (6, 'd94beab6-ed11-4985-98f8-4c1aa39c3bec', NULL, NULL, 'Barishal', NULL, 'barishal', 'বরিশাল', '10', '10', 90.37013, 22.70497, 1, 18526, 18148, '2015-02-08 16:13:25', '2020-06-16 20:12:22', NULL, NULL);
INSERT INTO `divisions` VALUES (7, '3f21377b-2ce0-421f-b535-451cc62581cb', NULL, NULL, 'Sylhet', NULL, 'sylhet', 'সিলেট', '60', '60', 91.869034, 24.894802, 1, 18526, 4, '2015-02-08 16:11:53', '2017-01-06 11:14:34', NULL, NULL);
INSERT INTO `divisions` VALUES (8, 'e8e724fc-3f68-46a0-8aa1-56912d255698', NULL, NULL, 'Mymensingh', NULL, 'mymensingh', 'ময়মনসিংহ', '45', '45', 90.25, 24.1, 1, 8, 147592, '2016-10-14 17:23:32', '2022-05-14 14:53:56', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

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

 Date: 04/10/2023 14:03:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `tenant_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `combined_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `division_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `division_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `division_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
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
  INDEX `districts_uuid_index`(`uuid`) USING BTREE,
  INDEX `districts_project_id_index`(`project_id`) USING BTREE,
  INDEX `districts_tenant_id_index`(`tenant_id`) USING BTREE,
  INDEX `districts_name_index`(`name`) USING BTREE,
  INDEX `districts_code_index`(`code`) USING BTREE,
  INDEX `districts_combined_code_index`(`combined_code`) USING BTREE,
  INDEX `districts_division_id_index`(`division_id`) USING BTREE,
  INDEX `districts_division_code_index`(`division_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of districts
-- ----------------------------
INSERT INTO `districts` VALUES (1, '0226d8e8-b437-4c75-8ac3-64a323ea296e', NULL, NULL, 'Dhaka', NULL, 'dhaka', 'ঢাকা', '26', '3026', 1, '30', 'Dhaka', 90.33719, 23.8052, 1, 18561, 18561, '2015-11-24 14:41:55', '2016-10-02 14:29:03', NULL, NULL);
INSERT INTO `districts` VALUES (2, '517b5ccb-49d4-4aed-8d45-f44bcd585ba8', NULL, NULL, 'Faridpur', NULL, 'faridpur', 'ফরিদপুর', '29', '3029', 1, '30', 'Dhaka', 89.63089, 23.54239, 1, 18561, 18561, '2015-11-24 14:42:45', '2016-10-02 14:30:10', NULL, NULL);
INSERT INTO `districts` VALUES (3, '7bb32ffd-f2a7-45ea-af27-19e72e9f829e', NULL, NULL, 'Gazipur', NULL, 'gazipur', 'গাজীপুর', '33', '3033', 1, '30', 'Dhaka', 90.4125, 24.09582, 1, 18561, 18561, '2015-11-24 14:43:52', '2016-10-02 14:30:54', NULL, NULL);
INSERT INTO `districts` VALUES (4, '5abb9809-acc9-4c0d-80e5-f02c202bb461', NULL, NULL, 'Gopalganj', NULL, 'gopalganj', 'গোপালগঞ্জ', '35', '3035', 1, '30', 'Dhaka', 89.88793, 23.04881, 1, 18561, 18561, '2015-11-24 14:44:06', '2016-10-02 14:32:11', NULL, NULL);
INSERT INTO `districts` VALUES (5, '86b6950b-2019-42ca-a924-a7edc3d1e7e6', NULL, NULL, 'Jamalpur', NULL, 'jamalpur', 'জামালপুর', '39', '4539', 8, '45', 'Mymensingh', 89.78532, 25.08309, 1, 18561, 8, '2015-11-24 14:44:22', '2019-09-10 23:46:53', NULL, NULL);
INSERT INTO `districts` VALUES (6, '2ed4aa48-3a8e-4d24-9f00-258b47dda1c4', NULL, NULL, 'Kishoreganj', NULL, 'kishoreganj', 'কিশোরগঞ্জ', '48', '3048', 1, '30', 'Dhaka', 90.9821, 24.426, 1, 18561, 18148, '2015-11-24 14:45:41', '2020-06-16 21:00:33', NULL, NULL);
INSERT INTO `districts` VALUES (7, '01f20825-fcbe-4fc7-a8cc-acdb92badd05', NULL, NULL, 'Madaripur', NULL, 'madaripur', 'মাদারীপুর', '54', '3054', 1, '30', 'Dhaka', 90.18696, 23.23933, 1, 18561, 18561, '2015-11-24 14:45:58', '2016-10-02 14:43:58', NULL, NULL);
INSERT INTO `districts` VALUES (8, '143a14be-cb35-403b-b42e-e6f87327ec4d', NULL, NULL, 'Manikganj', NULL, 'manikganj', 'মানিকগঞ্জ', '56', '3056', 1, '30', 'Dhaka', 90.00032, 23.86165, 1, 18561, 18561, '2015-11-24 14:46:13', '2016-10-02 14:44:42', NULL, NULL);
INSERT INTO `districts` VALUES (9, 'b52688ed-7740-446e-bd84-22998d95b4b3', NULL, NULL, 'Munshiganj', NULL, 'munshiganj', 'মুন্সিগঞ্জ', '59', '3059', 1, '30', 'Dhaka', 90.41266, 23.49809, 1, 18561, 18561, '2015-11-24 14:46:37', '2016-10-02 14:45:47', NULL, NULL);
INSERT INTO `districts` VALUES (10, 'ecb93a4a-761b-4610-9521-afa90403835e', NULL, NULL, 'Mymensingh', NULL, 'mymensingh', 'ময়মনসিংহ', '61', '4561', 8, '45', 'Mymensingh', 90.40729, 24.75386, 1, 18561, 8, '2015-11-24 14:47:01', '2019-09-10 23:46:53', NULL, NULL);
INSERT INTO `districts` VALUES (11, '94145f79-1df8-4b86-8de5-c0f4b8dabbab', NULL, NULL, 'Narayanganj', NULL, 'narayanganj', 'নারায়ণগঞ্জ', '67', '3067', 1, '30', 'Dhaka', 90.56361, 23.71466, 1, 18561, 18561, '2015-11-24 14:49:04', '2016-10-02 14:47:32', NULL, NULL);
INSERT INTO `districts` VALUES (12, 'e9764588-0f07-4f07-b1cc-b04c649a7626', NULL, NULL, 'Narsingdi', NULL, 'narsingdi', 'নরসিংদী', '68', '3068', 1, '30', 'Dhaka', 90.78601, 24.13438, 1, 18561, 18561, '2015-11-24 14:49:22', '2016-10-02 14:49:08', NULL, NULL);
INSERT INTO `districts` VALUES (13, 'd467e20d-4092-4d11-9ce9-854fa8551798', NULL, NULL, 'Netrakona', NULL, 'netrakona', 'নেত্রকোনা', '72', '4572', 8, '45', 'Mymensingh', 90.86564, 24.81033, 1, 18561, 8, '2015-11-24 14:49:37', '2019-09-10 23:46:53', NULL, NULL);
INSERT INTO `districts` VALUES (14, '53cde8d4-b398-4e20-a0a3-db20411d8e30', NULL, NULL, 'Rajbari', NULL, 'rajbari', 'রাজবাড়ী', '82', '3082', 1, '30', 'Dhaka', 89.58748, 23.71513, 1, 18561, 18561, '2015-11-24 14:50:00', '2016-10-02 14:53:08', NULL, NULL);
INSERT INTO `districts` VALUES (15, 'e2032c43-ed92-42e4-98dc-6c35f0e3a7f2', NULL, NULL, 'Shariatpur', NULL, 'shariatpur', 'শরীয়তপুর', '86', '3086', 1, '30', 'Dhaka', 90.43477, 23.24232, 1, 18561, 18561, '2015-11-24 14:50:19', '2016-10-02 14:52:37', NULL, NULL);
INSERT INTO `districts` VALUES (16, '7b56cce0-36f1-4dbb-9772-854c1fd3523f', NULL, NULL, 'Sherpur', NULL, 'sherpur', 'শেরপুর', '89', '4589', 8, '45', 'Mymensingh', 90.14949, 25.07462, 1, 18561, 8, '2015-11-24 14:50:40', '2019-09-10 23:46:53', NULL, NULL);
INSERT INTO `districts` VALUES (17, 'da6657ba-2a84-4de8-887f-82430ba6e151', NULL, NULL, 'Tangail', NULL, 'tangail', 'টাঙ্গাইল', '93', '3093', 1, '30', 'Dhaka', 89.99483, 24.39174, 1, 18561, 18561, '2015-11-24 14:50:53', '2016-10-02 14:51:34', NULL, NULL);
INSERT INTO `districts` VALUES (18, '5df45e5d-4b09-4234-a34f-d2b1a750f07f', NULL, NULL, 'Bandarban', NULL, 'bandarban', 'বান্দরবান', '03', '2003', 2, '20', 'Chattogram', 92.3686, 21.8311, 1, 18561, 18561, '2015-11-24 14:51:09', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (19, '1e0d99ea-97e6-4831-9133-eb91757221c0', NULL, NULL, 'Brahmanbaria', NULL, 'brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '12', '2012', 2, '20', 'Chattogram', 91.1115, 23.96082, 1, 18561, 18561, '2015-11-24 14:51:27', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (20, 'e46a012d-6969-42bc-bcfb-888f64ade8a9', NULL, NULL, 'Chandpur', NULL, 'chandpur', 'চাঁদপুর', '13', '2013', 2, '20', 'Chattogram', 90.85178, 23.25131, 1, 18561, 18561, '2015-11-24 14:51:45', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (21, 'edb21ab5-001e-4f0a-8750-622ea6dc5bca', NULL, NULL, 'Chattogram', NULL, 'chattogram', 'চট্টগ্রাম', '15', '2015', 2, '20', 'Chattogram', 91.75388, 22.51501, 1, 18561, 128443, '2015-11-24 14:53:03', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (22, '191caf9e-193c-4281-818f-fda80b4d6571', NULL, NULL, 'Cumilla', NULL, 'cumilla', 'কুমিল্লা', '19', '2019', 2, '20', 'Chattogram', 91.1809, 23.45757, 1, 18561, 128443, '2015-11-24 14:53:24', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (23, 'd796186d-3144-47bf-92d7-3cb6dc35a185', NULL, NULL, 'Cox\'s Bazar', NULL, 'coxs-bazar', 'কক্সবাজার', '22', '2022', 2, '20', 'Chattogram', 92.02821, 21.56406, 1, 18561, 18561, '2015-11-24 14:53:39', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (24, '281fdf02-8571-4765-b614-d60a58fce85d', NULL, NULL, 'Feni', NULL, 'feni', 'ফেনী', '30', '2030', 2, '20', 'Chattogram', 91.40666, 22.94088, 1, 18561, 18561, '2015-11-24 14:53:54', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (25, 'fe070edd-3a34-473e-bab4-c8764a6239d0', NULL, NULL, 'Khagrachari', NULL, 'khagrachari', 'খাগড়াছড়ি', '46', '2046', 2, '20', 'Chattogram', 91.949, 23.13218, 1, 18561, 18148, '2015-11-24 14:54:08', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (26, 'a9143cf2-566a-4f36-aefb-dd94996953f3', NULL, NULL, 'Lakshmipur', NULL, 'lakshmipur', 'লক্ষ্মীপুর', '51', '2051', 2, '20', 'Chattogram', 90.82819, 22.94467, 1, 18561, 18561, '2015-11-24 14:54:31', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (27, 'ddaa8f34-8cd2-47b0-bc95-fe739b28a3b9', NULL, NULL, 'Noakhali', NULL, 'noakhali', 'নোয়াখালী', '75', '2075', 2, '20', 'Chattogram', 91.09732, 22.87238, 1, 18561, 18561, '2015-11-24 14:54:47', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (28, '793c15de-3222-4703-b845-192291f57a5f', NULL, NULL, 'Rangamati', NULL, 'rangamati', 'রাঙ্গামাটি', '84', '2084', 2, '20', 'Chattogram', 92.29851, 22.73242, 1, 18561, 18561, '2015-11-24 14:55:07', '2020-06-16 20:13:34', NULL, NULL);
INSERT INTO `districts` VALUES (29, 'fbeddebd-51fb-4b47-8a30-492cfad8ca2a', NULL, NULL, 'Bogura', NULL, 'bogura', 'বগুড়া', '10', '5010', 3, '50', 'Rajshahi', 89.36972, 24.85104, 1, 18561, 128443, '2015-11-24 14:55:37', '2018-09-13 15:21:33', NULL, NULL);
INSERT INTO `districts` VALUES (30, '2de16d10-e14a-4f93-ae96-6c132b9427f5', NULL, NULL, 'Chapai Nawabganj', NULL, 'chapai-nawabganj', 'চাঁপাই নবাবগঞ্জ', '70', '5070', 3, '50', 'Rajshahi', 88.29121, 24.74131, 1, 18561, 18561, '2015-11-24 14:55:42', '2016-10-02 14:56:03', NULL, NULL);
INSERT INTO `districts` VALUES (31, 'af7cf881-e359-4c48-b8b3-d7088f71b182', NULL, NULL, 'Dinajpur', NULL, 'dinajpur', 'দিনাজপুর', '27', '5527', 4, '55', 'Rangpur', 88.63318, 25.62791, 1, 18561, 18561, '2015-11-25 10:08:36', '2016-10-02 15:02:50', NULL, NULL);
INSERT INTO `districts` VALUES (32, '6e4b3121-4f8c-45b7-aff8-253c76b4b8f2', NULL, NULL, 'Gaibandha', NULL, 'gaibandha', 'গাইবান্ধা', '32', '5532', 4, '55', 'Rangpur', 89.54297, 25.32969, 1, 18561, 18561, '2015-11-25 10:08:50', '2016-10-02 15:07:50', NULL, NULL);
INSERT INTO `districts` VALUES (33, '711055af-587d-404e-809d-4da636e4ea1a', NULL, NULL, 'Joypurhat', NULL, 'joypurhat', 'জয়পুরহাট', '38', '5038', 3, '50', 'Rajshahi', 89.09449, 25.09473, 1, 18561, 18561, '2015-11-25 10:09:21', '2016-10-02 15:07:23', NULL, NULL);
INSERT INTO `districts` VALUES (34, '2d6c7ad2-7828-4e66-aee5-50575a95f997', NULL, NULL, 'Kurigram', NULL, 'kurigram', 'কুড়িগ্রাম', '49', '5549', 4, '55', 'Rangpur', 89.62947, 25.80724, 1, 18561, 18561, '2015-11-25 10:10:13', '2016-10-02 15:06:48', NULL, NULL);
INSERT INTO `districts` VALUES (35, 'b0c2c211-f36c-434a-a16c-10b3b30cddd8', NULL, NULL, 'Lalmonirhat', NULL, 'lalmonirhat', 'লালমনিরহাট', '52', '5552', 4, '55', 'Rangpur', 89.28473, 25.99234, 1, 18561, 18561, '2015-11-25 10:10:31', '2016-10-02 15:06:18', NULL, NULL);
INSERT INTO `districts` VALUES (36, '42a4d7ff-ff53-4427-816b-50e6f029323c', NULL, NULL, 'Naogaon', NULL, 'naogaon', 'নওগাঁ', '64', '5064', 3, '50', 'Rajshahi', 88.7531, 24.91316, 1, 18561, 18561, '2015-11-25 10:11:08', '2016-10-02 15:05:47', NULL, NULL);
INSERT INTO `districts` VALUES (37, 'f98a94ad-b0ca-4d51-81a1-aeac31e1d85c', NULL, NULL, 'Natore', NULL, 'natore', 'নাটোর', '69', '5069', 3, '50', 'Rajshahi', 89.00762, 24.41024, 1, 18561, 18561, '2015-11-25 10:11:31', '2016-10-02 15:05:17', NULL, NULL);
INSERT INTO `districts` VALUES (38, '0a21cd8b-dfc8-4898-aea7-0f2e824c71f9', NULL, NULL, 'Nilphamari', NULL, 'nilphamari', 'নীলফামারী', '73', '5573', 4, '55', 'Rangpur', 88.94141, 25.84828, 1, 18561, 18561, '2015-11-25 10:14:18', '2016-10-02 15:04:51', NULL, NULL);
INSERT INTO `districts` VALUES (39, '95335eb9-95fe-4175-bbc7-c2120389bf4f', NULL, NULL, 'Pabna', NULL, 'pabna', 'পাবনা', '76', '5076', 3, '50', 'Rajshahi', 89.44807, 24.15851, 1, 18561, 18561, '2015-11-25 10:14:39', '2016-10-02 15:04:08', NULL, NULL);
INSERT INTO `districts` VALUES (40, 'a9bee13f-9f91-474f-b03d-0f234a27aca9', NULL, NULL, 'Panchagarh', NULL, 'panchagarh', 'পঞ্চগড়', '77', '5577', 4, '55', 'Rangpur', 88.59518, 26.27087, 1, 18561, 18561, '2015-11-25 10:15:02', '2016-10-02 15:03:30', NULL, NULL);
INSERT INTO `districts` VALUES (41, '9e84b099-741d-4ab3-87d7-ad72d9f35cab', NULL, NULL, 'Rajshahi', NULL, 'rajshahi', 'রাজশাহী', '81', '5081', 3, '50', 'Rajshahi', 88.6048, 24.37331, 1, 18561, 18561, '2015-11-25 10:23:40', '2016-10-02 15:09:12', NULL, NULL);
INSERT INTO `districts` VALUES (42, '20ec5855-f4b0-404e-8568-7adebcfe6695', NULL, NULL, 'Rangpur', NULL, 'rangpur', 'রংপুর', '85', '5585', 4, '55', 'Rangpur', 89.25083, 25.74679, 1, 18561, 18561, '2015-11-25 10:23:58', '2016-10-02 15:14:02', NULL, NULL);
INSERT INTO `districts` VALUES (43, '877b6e8f-7bbf-4d7d-be35-9c41e69aa095', NULL, NULL, 'Sirajganj', NULL, 'sirajganj', 'সিরাজগঞ্জ', '88', '5088', 3, '50', 'Rajshahi', 89.56996, 24.31411, 1, 18561, 18561, '2015-11-25 10:24:47', '2016-10-02 15:13:31', NULL, NULL);
INSERT INTO `districts` VALUES (44, '4483765c-657f-4880-bb83-74177e86b86a', NULL, NULL, 'Thakurgaon', NULL, 'thakurgaon', 'ঠাকুরগাঁও', '94', '5594', 4, '55', 'Rangpur', 88.42826, 26.04184, 1, 18561, 18561, '2015-11-25 10:25:07', '2016-10-02 15:13:01', NULL, NULL);
INSERT INTO `districts` VALUES (45, 'cd0f29ee-f7dc-43e6-9739-148a7416a192', NULL, NULL, 'Bagerhat', NULL, 'bagerhat', 'বাগেরহাট', '01', '4001', 5, '40', 'Khulna', 89.78955, 22.66024, 1, 18561, 18561, '2015-11-25 10:25:27', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (46, 'b216a913-b384-4c75-b758-f0eb3305ffd6', NULL, NULL, 'Chuadanga', NULL, 'chuadanga', 'চুয়াডাঙ্গা', '18', '4018', 5, '40', 'Khulna', 88.8263, 23.61605, 1, 18561, 18561, '2015-11-25 10:25:57', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (47, '750e6bb1-2de8-4fc0-badb-1ff30ececfc3', NULL, NULL, 'Jashore', NULL, 'jashore', 'যশোর', '41', '4041', 5, '40', 'Khulna', 89.21817, 23.1634, 1, 18561, 18148, '2015-11-25 10:27:33', '2020-06-16 17:53:49', NULL, NULL);
INSERT INTO `districts` VALUES (48, 'c2be5e9b-c013-4f04-8b24-e0aee9938ecc', NULL, NULL, 'Jhenaidah', NULL, 'jhenaidah', 'ঝিনাইদহ', '44', '4044', 5, '40', 'Khulna', 89.1726, 23.54499, 1, 18561, 18918, '2015-11-25 10:28:00', '2020-11-24 11:01:17', NULL, NULL);
INSERT INTO `districts` VALUES (49, '41e06988-b03d-40e3-9035-03a9a0c29f7f', NULL, NULL, 'Khulna', NULL, 'khulna', 'খুলনা', '47', '4047', 5, '40', 'Khulna', 89.39666, 22.67377, 1, 18561, 18561, '2015-11-25 10:28:22', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (50, '82b18027-6654-4106-895b-3049b2b41816', NULL, NULL, 'Kushtia', NULL, 'kushtia', 'কুষ্টিয়া', '50', '4050', 5, '40', 'Khulna', 89.10994, 23.8907, 1, 18561, 18561, '2015-11-25 10:29:44', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (51, '274158f4-42a5-4981-9259-a07a2349943c', NULL, NULL, 'Magura', NULL, 'magura', 'মাগুরা', '55', '4055', 5, '40', 'Khulna', 0, 0, 1, 18561, 18561, '2015-11-25 10:31:17', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (52, '8d74b6e2-65a6-4131-9438-69f77ad4306c', NULL, NULL, 'Meherpur', NULL, 'meherpur', 'মেহেরপুর', '57', '4057', 5, '40', 'Khulna', 88.67236, 23.11629, 1, 18561, 18561, '2015-11-25 10:31:36', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (53, 'e7c1b2f7-9d24-4eff-b36d-26ef7e85f33d', NULL, NULL, 'Narail', NULL, 'narail', 'নড়াইল', '65', '4065', 5, '40', 'Khulna', 89.58404, 23.11629, 1, 18561, 18561, '2015-11-25 10:32:17', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (54, '43c733cb-21ec-40ea-97cf-483e0a029e08', NULL, NULL, 'Satkhira', NULL, 'satkhira', 'সাতক্ষীরা', '87', '4087', 5, '40', 'Khulna', 89.11145, 22.31548, 1, 18561, 18561, '2015-11-25 10:32:46', '2016-12-28 15:20:36', NULL, NULL);
INSERT INTO `districts` VALUES (55, '0e22ba12-0c02-4e40-a1cb-46765005ecd7', NULL, NULL, 'Barguna', NULL, 'barguna', 'বরগুনা', '04', '1004', 6, '10', 'Barishal', 90.11207, 22.09529, 1, 18561, 18561, '2015-11-25 10:32:59', '2020-06-16 20:12:22', NULL, NULL);
INSERT INTO `districts` VALUES (56, 'e52e9fce-9a19-4c98-bb67-01d3da7b803b', NULL, NULL, 'Barishal', NULL, 'barishal', 'বরিশাল', '06', '1006', 6, '10', 'Barishal', 90.7101, 22.17853, 1, 18561, 128443, '2015-11-25 10:33:12', '2020-06-16 20:12:22', NULL, NULL);
INSERT INTO `districts` VALUES (57, '5dacec5a-4af9-4cb0-95a6-fa8188f7306d', NULL, NULL, 'Bhola', NULL, 'bhola', 'ভোলা', '09', '1009', 6, '10', 'Barishal', 90.7101, 22.17853, 1, 18561, 18561, '2015-11-25 10:33:32', '2020-06-16 20:12:22', NULL, NULL);
INSERT INTO `districts` VALUES (58, '56e228d7-76f2-48a1-9172-967b537011fd', NULL, NULL, 'Jhalokathi', NULL, 'jhalokathi', 'ঝালকাঠি', '42', '1042', 6, '10', 'Barishal', 90.18696, 22.57208, 1, 18561, 18148, '2015-11-25 10:34:00', '2020-06-16 20:12:22', NULL, NULL);
INSERT INTO `districts` VALUES (59, 'fd597c8b-fd62-4ab3-8624-1778ded6e79c', NULL, NULL, 'Patuakhali', NULL, 'patuakhali', 'পটুয়াখালী', '78', '1078', 6, '10', 'Barishal', 90.45475, 22.22486, 1, 18561, 18561, '2015-11-25 10:34:14', '2020-06-16 20:12:22', NULL, NULL);
INSERT INTO `districts` VALUES (60, '791ba391-751a-47ec-abeb-fdd11acf7aa6', NULL, NULL, 'Pirojpur', NULL, 'pirojpur', 'পিরোজপুর', '79', '1079', 6, '10', 'Barishal', 89.97593, 22.57907, 1, 18561, 18561, '2015-11-25 10:34:31', '2020-06-16 20:12:22', NULL, NULL);
INSERT INTO `districts` VALUES (61, 'd978dc72-e732-4228-8af7-d56452ed9edc', NULL, NULL, 'Habiganj', NULL, 'habiganj', 'হবিগঞ্জ', '36', '6036', 7, '60', 'Sylhet', 91.45066, 24.47712, 1, 18561, 18561, '2015-11-25 10:35:09', '2016-10-02 14:16:58', NULL, NULL);
INSERT INTO `districts` VALUES (62, '9fa0c372-e537-43b2-84d9-042c59accfc1', NULL, NULL, 'Maulvibazar', NULL, 'maulvibazar', 'মৌলভীবাজার', '58', '6058', 7, '60', 'Sylhet', 91.71496, 24.46706, 1, 18561, 18561, '2015-11-25 10:35:22', '2016-10-02 14:15:38', NULL, NULL);
INSERT INTO `districts` VALUES (63, '2e7ef457-6191-48c8-abb0-f1be79579148', NULL, NULL, 'Sunamganj', NULL, 'sunamganj', 'সুনামগঞ্জ', '90', '6090', 7, '60', 'Sylhet', 91.39916, 25.07145, 1, 18561, 18561, '2015-11-25 10:35:36', '2016-10-02 14:13:14', NULL, NULL);
INSERT INTO `districts` VALUES (64, '404d7943-1a99-4dda-9d06-a5a7c288af84', NULL, NULL, 'Sylhet', NULL, 'sylhet', 'সিলেট', '91', '6091', 7, '60', 'Sylhet', 91.87005, 24.89934, 1, 18561, 4, '2015-11-25 10:35:49', '2016-10-02 13:19:57', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

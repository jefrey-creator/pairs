-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2024 at 09:08 PM
-- Server version: 8.0.39-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borrowing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acct`
--

CREATE TABLE `tbl_acct` (
  `acct_id` bigint NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = staff or student, 2 = admin',
  `acct_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = blocked, 0 = unblocked',
  `reset_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'token for reset password',
  `login_token` longtext COLLATE utf8mb4_unicode_ci COMMENT 'token for login',
  `reg_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_acct`
--

INSERT INTO `tbl_acct` (`acct_id`, `username`, `password`, `user_type`, `acct_status`, `reset_token`, `login_token`, `reg_token`) VALUES
(1, 'admin', '$2y$10$2Io.ql6oWqu4Aui78pUylevi2CXsTNkoGcJPMqoGD6EDbYH7jqCbq', 2, 0, NULL, '', NULL),
(2, 'staff', '$2y$10$2Io.ql6oWqu4Aui78pUylevi2CXsTNkoGcJPMqoGD6EDbYH7jqCbq', 1, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow`
--

CREATE TABLE `tbl_borrow` (
  `borrow_id` bigint UNSIGNED NOT NULL,
  `borrower_id` int UNSIGNED NOT NULL,
  `date_borrowed` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_returned` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'array of items',
  `borrowed_qty` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of number of items borrowed',
  `remarks` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of id from remarks table',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = pending, 2 = approved, 3 = acquired, 4 = returned, 5 = declined | array so it will be per item approval',
  `transaction_type` tinyint(1) DEFAULT NULL COMMENT '1 = borrowing, 2 = reservation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int NOT NULL,
  `cat_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
(1, 'CAT 1'),
(2, 'CAT 2'),
(3, 'CAT 3'),
(4, 'CAT 4'),
(5, 'CAT 5'),
(6, 'CAT 6'),
(9, 'CAT 7'),
(10, 'CAT 8'),
(11, 'CAT 9'),
(12, 'CAT 10'),
(13, 'CAT 11'),
(14, 'CAT 12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_condition`
--

CREATE TABLE `tbl_condition` (
  `condition_id` int NOT NULL,
  `condition` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'item conditions like: good, for repair, for condemn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_condition`
--

INSERT INTO `tbl_condition` (`condition_id`, `condition`) VALUES
(1, 'GOOD'),
(2, 'FOR REPAIR'),
(3, 'FOR CONDEMN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` tinyint NOT NULL,
  `department` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_head` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forms`
--

CREATE TABLE `tbl_forms` (
  `form_id` tinyint NOT NULL,
  `form_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int NOT NULL,
  `item_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `item_brand` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_category` int DEFAULT NULL COMMENT 'id from category tbl',
  `item_type` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 = consumable\r\n0 = non-consumable',
  `condition_id` int DEFAULT NULL COMMENT 'id from condition tbl - status',
  `acquired_by` int DEFAULT NULL,
  `date_acquired` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_name`, `item_desc`, `item_brand`, `item_model`, `item_price`, `item_category`, `item_type`, `condition_id`, `acquired_by`, `date_acquired`, `item_uuid`) VALUES
(2, 'IP3I 15IAH8 83ER0023PH (V) I5 16GB 15.7\"', '<p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"-webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"><br></strong></p><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><img style=\"width: 120.5px; height: 95.5909px; float: left;\" src=\"https://www.smappliance.com/cdn/shop/files/IP3I15IAH883ER0023PH_600x.jpg?v=1698034020\" class=\"note-float-left\"></p><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align); -webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">General Specifications</strong><br></p><ul style=\"-webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 0.7em; margin-left: 18px; padding: 0px; list-style: none; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; color: rgb(58, 42, 47); font-size: 15px; letter-spacing: -0.5px;\"><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">CPU: Intel® Core™ i5-12450H, 8C (4P + 4E) / 12T, P-core 2.0 / 4.4GHz, E-core 1.5 / 3.3GHz, 12MB<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Memory: 16GB Soldered LPDDR5-4800<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">SSD Storage: 512GB SSD M.2 2242 PCIe® 4.0x4 NVMe®<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Screen Size: 15.6\" FHD (1920x1080) IPS 300nits Anti-glare<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Wifi: Wi-Fi® 6, 11ax 2x2<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">OS: Windows® 11 Home Single Language, English<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">BT/USB: BT5.1 + 1x USB-C® 3.2 Gen 1 (support data transfer, Power Delivery and DisplayPort™ 1.2) &amp; 2x USB 3.2 Gen 1</li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Webcam: FHD 1080p with Privacy Shutter<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Battery: Integrated 47Wh<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Color: Arctic Grey<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li></ul><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"-webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Weight</strong></p><ul style=\"-webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 0.7em; margin-left: 18px; padding: 0px; list-style: none; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; color: rgb(58, 42, 47); font-size: 15px; letter-spacing: -0.5px;\"><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Net Weight (kg):&nbsp;Starting at 1.62 kg (3.57 lbs)</li><li style=\"-webkit-font-smoothing: antialiased; position: relative; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Gross Weight (packed):&nbsp;2.41 kg<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li></ul><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"-webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Dimensions</strong></p><ul style=\"-webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 0px; margin-left: 18px; padding: 0px; list-style: none; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; color: rgb(58, 42, 47); font-size: 15px; letter-spacing: -0.5px;\"><li style=\"-webkit-font-smoothing: antialiased; position: relative; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Gross Dimensions (WxHxD):&nbsp;359.3 x 235 x 17.9 mm (14.15 x 9.25 x 0.70 inches)</li></ul>', 'Lenovo', '83ER0023PH', 'PHP 37,500.00', 1, '2', 2, 5, '2024-10-13', 'NjcwYjM3ZjM5NDZjOTE3Mjg3ODg0Njc='),
(3, 'IP3I 15IAH8 83ER0023PH (V) I5 16GB 15.6\"', '<p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><img src=\"https://www.smappliance.com/cdn/shop/files/IP3I15IAH883ER0023PH_600x.jpg?v=1698034020\" class=\"note-float-left\" style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); width: 131.664px; height: 104.453px; float: left;\"></p><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align); -webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Warranty</strong><br></p><ul style=\"-webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 0.7em; margin-left: 18px; padding: 0px; list-style: none; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; color: rgb(58, 42, 47); font-size: 15px; letter-spacing: -0.5px;\"><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Parts:&nbsp;3Y Premium Care–IPENTRY (ESS) (5WS1B01000)</li><li style=\"-webkit-font-smoothing: antialiased; position: relative; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Labor:&nbsp;3Y Premium Care–IPENTRY (ESS) (5WS1B01000)</li></ul><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"-webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">General Specifications</strong></p><ul style=\"-webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 0.7em; margin-left: 18px; padding: 0px; list-style: none; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; color: rgb(58, 42, 47); font-size: 15px; letter-spacing: -0.5px;\"><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">CPU: Intel® Core™ i5-12450H, 8C (4P + 4E) / 12T, P-core 2.0 / 4.4GHz, E-core 1.5 / 3.3GHz, 12MB<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Memory: 16GB Soldered LPDDR5-4800<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">SSD Storage: 512GB SSD M.2 2242 PCIe® 4.0x4 NVMe®<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Screen Size: 15.6\" FHD (1920x1080) IPS 300nits Anti-glare<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Wifi: Wi-Fi® 6, 11ax 2x2<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">OS: Windows® 11 Home Single Language, English<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">BT/USB: BT5.1 + 1x USB-C® 3.2 Gen 1 (support data transfer, Power Delivery and DisplayPort™ 1.2) &amp; 2x USB 3.2 Gen 1</li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Webcam: FHD 1080p with Privacy Shutter<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Battery: Integrated 47Wh<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li><li style=\"-webkit-font-smoothing: antialiased; position: relative; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Color: Arctic Grey<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li></ul><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"-webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Weight</strong></p><ul style=\"-webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 0.7em; margin-left: 18px; padding: 0px; list-style: none; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; color: rgb(58, 42, 47); font-size: 15px; letter-spacing: -0.5px;\"><li style=\"-webkit-font-smoothing: antialiased; position: relative; margin-bottom: 5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Net Weight (kg):&nbsp;Starting at 1.62 kg (3.57 lbs)</li><li style=\"-webkit-font-smoothing: antialiased; position: relative; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Gross Weight (packed):&nbsp;2.41 kg<br style=\"-webkit-font-smoothing: antialiased; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\"></li></ul><p style=\"-webkit-font-smoothing: antialiased; font-size: 15px; letter-spacing: -0.5px; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; margin-bottom: 0.7em; color: rgb(58, 42, 47);\"><strong style=\"-webkit-font-smoothing: antialiased; font-weight: bold; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Dimensions</strong></p><ul style=\"-webkit-font-smoothing: antialiased; margin-right: 0px; margin-bottom: 0px; margin-left: 18px; padding: 0px; list-style: none; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif; color: rgb(58, 42, 47); font-size: 15px; letter-spacing: -0.5px;\"><li style=\"-webkit-font-smoothing: antialiased; position: relative; font-family: &quot;Super Sans&quot;, &quot;ITC Avant Garde Gothic&quot;, sans-serif !important;\">Gross Dimensions (WxHxD):&nbsp;359.3 x 235 x 17.9 mm (14.15 x 9.25 x 0.70 inches)</li></ul>', 'Lenovo', '83ER0023PH', 'PHP 37,500.00', 1, '2', 1, 5, '2024-10-13', 'NjcwYjM4MDAxZTc5NjE3Mjg3ODg0ODA='),
(4, 'Nitro 14 AMD', '<p><img style=\"width: 156.338px; height: 115.453px; float: left;\" src=\"https://images.acer.com/is/image/acer/nitro-14-an14-41-non-fingerprint-3-zone-backlit-on-wp-black-01-1?$Series-Component-XL$\" class=\"note-float-left\"></p><ul class=\"card-product__list\" style=\"margin-bottom: 0px; font-size: 0.875rem; color: rgb(34, 34, 34); font-family: &quot;Noto Sans&quot;, Arial, sans-serif;\"><li style=\"margin-bottom: 0.5rem;\">Windows 11 Home</li><li style=\"margin-bottom: 0.5rem;\">AMD Ryzen™ 7 8845HS processor Octa-core 3.80 GHz</li><li style=\"margin-bottom: 0.5rem;\">NVIDIA® GeForce RTX™ 4060 with 8 GB dedicated memory</li><li style=\"margin-bottom: 0.5rem;\">14.5\" WUXGA (1920 x 1200) 16:10 IPS 120 Hz</li><li style=\"text-align: left; margin-bottom: 0.5rem;\">16 GB, LPDDR5X</li><li style=\"text-align: left; margin-bottom: 0.5rem;\">512 GB SSD</li></ul>', 'Acer', 'AN14-41-R74Z | NH.QQLAA.001', 'PHP 50,000.00', 1, '2', 1, 5, '2024-10-13', 'NjcwYjM4ZGYxMDRkOTE3Mjg3ODg3MDM='),
(5, 'Nitro 14 AMD', '<p><img style=\"width: 206.5px; height: 152.497px; float: left;\" src=\"https://images.acer.com/is/image/acer/nitro-14-an14-41-non-fingerprint-3-zone-backlit-on-wp-black-01-1?$Series-Component-XL$\" class=\"note-float-left\"></p><ul class=\"card-product__list\" style=\"margin-bottom: 0px; font-size: 0.875rem; color: rgb(34, 34, 34); font-family: &quot;Noto Sans&quot;, Arial, sans-serif;\"><li style=\"margin-bottom: 0.5rem;\">Windows 11 Home</li><li style=\"margin-bottom: 0.5rem;\">AMD Ryzen™ 7 8845HS processor Octa-core 3.80 GHz</li><li style=\"margin-bottom: 0.5rem;\">NVIDIA® GeForce RTX™ 4060 with 8 GB dedicated memory</li><li style=\"margin-bottom: 0.5rem;\">14.5\" WUXGA (1920 x 1200) 16:10 IPS 120 Hz</li><li style=\"margin-bottom: 0.5rem;\">16 GB, LPDDR5X</li><li style=\"margin-bottom: 0.5rem;\">512 GB SSD</li></ul>', 'Acer', 'AN14-41-R74Z | NH.QQLAA.001', 'PHP 50,000.00', 1, '2', 1, 5, '2024-10-13', 'NjcwYjM4ZTllZWY3MDE3Mjg3ODg3MTM=');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_handler`
--

CREATE TABLE `tbl_item_handler` (
  `handler_id` int NOT NULL,
  `handler_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_item_handler`
--

INSERT INTO `tbl_item_handler` (`handler_id`, `handler_name`) VALUES
(1, 'LEBRON JAMES'),
(2, 'JAMES BOND'),
(5, 'ELON MUSK'),
(6, 'BILL GATES'),
(7, 'MARK ZUCKERBURG'),
(8, 'KONG TV'),
(9, 'JUNNY BOY');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `member_id` bigint UNSIGNED NOT NULL,
  `act_id` bigint UNSIGNED NOT NULL,
  `id_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_type` tinyint UNSIGNED NOT NULL COMMENT '1 = student, 2 = employee',
  `f_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL COMMENT '1 = male, 0 = female',
  `department` int DEFAULT NULL COMMENT 'id from department tbl',
  `contact` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yr_level` tinyint DEFAULT NULL COMMENT 'if student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_remarks`
--

CREATE TABLE `tbl_remarks` (
  `remarks_id` tinyint DEFAULT NULL,
  `remarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'returned items remarks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `room_id` int NOT NULL,
  `room_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `room_num` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`room_id`, `room_name`, `room_num`) VALUES
(7, 'RM 3', '3'),
(8, 'RM 4', '4'),
(10, 'RM 6', '6'),
(12, 'RM 1', '1'),
(17, 'RM 8', '8'),
(18, 'RM 2', '2'),
(19, 'RM 7', '7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_storage`
--

CREATE TABLE `tbl_storage` (
  `storage_id` int NOT NULL,
  `room_id` int DEFAULT NULL,
  `item_uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_storage`
--

INSERT INTO `tbl_storage` (`storage_id`, `room_id`, `item_uuid`, `item_qty`) VALUES
(1, 12, 'NjcwYjM3ZjM5NDZjOTE3Mjg3ODg0Njc=', 2),
(2, 12, 'NjcwYjM4MDAxZTc5NjE3Mjg3ODg0ODA=', 2),
(3, 12, 'NjcwYjM4ZGYxMDRkOTE3Mjg3ODg3MDM=', 3),
(4, 12, 'NjcwYjM4ZTllZWY3MDE3Mjg3ODg3MTM=', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acct`
--
ALTER TABLE `tbl_acct`
  ADD PRIMARY KEY (`acct_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_condition`
--
ALTER TABLE `tbl_condition`
  ADD PRIMARY KEY (`condition_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_forms`
--
ALTER TABLE `tbl_forms`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_item_handler`
--
ALTER TABLE `tbl_item_handler`
  ADD PRIMARY KEY (`handler_id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  ADD PRIMARY KEY (`storage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acct`
--
ALTER TABLE `tbl_acct`
  MODIFY `acct_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_condition`
--
ALTER TABLE `tbl_condition`
  MODIFY `condition_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` tinyint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_item_handler`
--
ALTER TABLE `tbl_item_handler`
  MODIFY `handler_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  MODIFY `storage_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

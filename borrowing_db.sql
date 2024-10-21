-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2024 at 06:58 AM
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
  `login_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'token for login',
  `reg_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `acct_uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_acct`
--

INSERT INTO `tbl_acct` (`acct_id`, `username`, `password`, `user_type`, `acct_status`, `reset_token`, `login_token`, `reg_token`, `acct_uuid`) VALUES
(3, 'admin', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', 2, 0, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3BhaXJzLyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3QvcGFpcnMvIiwiZXhwIjo2MjI2MjY0Njg0ODAwLCJkYXRhIjp7InVzZXJuYW1lIjoiYWRtaW4iLCJ1c2VyX3R5cGUiOjIsImFjY3Rfc3RhdHVzIjowLCJhY2N0X2lkIjozLCJhY2N0X3V1aWQiOiI4YzMxOTgwYWI4NjQxYTRkNWQwZTVmOWIzNDdhMWRkNCJ9fQ.JbuFSc5WVb7rg5AIitoHOngMlvVJ8BNIWAnlp47DFJQ', NULL, '8c31980ab8641a4d5d0e5f9b347a1dd4'),
(7, 'agbubulud', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', 1, 0, NULL, '', NULL, '9abeb733ebcc6530f02c80e06bea0eee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow`
--

CREATE TABLE `tbl_borrow` (
  `borrow_id` bigint UNSIGNED NOT NULL,
  `borrower_id` int UNSIGNED NOT NULL,
  `date_borrowed` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_returned` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of items',
  `borrowed_qty` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of number of items borrowed',
  `remarks` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of id from remarks table',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = pending\r\n2 = approved\r\n3 = acquired \r\n4 = returned\r\n5 = declined ',
  `order_num` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_borrow`
--

INSERT INTO `tbl_borrow` (`borrow_id`, `borrower_id`, `date_borrowed`, `date_returned`, `item_id`, `borrowed_qty`, `remarks`, `status`, `order_num`, `purpose`) VALUES
(37, 7, '2024-10-21 21:37:47', '2024-11-03', 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc=', '3', NULL, 1, '1729517867', '3'),
(38, 7, '2024-10-21 21:37:47', '2024-11-02', 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', '2', NULL, 1, '1729517867', '2'),
(39, 7, '2024-10-21 21:37:47', '2024-11-01', 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', '1', NULL, 1, '1729517867', '1'),
(40, 7, '2024-10-21 21:38:59', '2024-11-03', 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc=', '3', NULL, 1, '1729517939', 'testing 3'),
(41, 7, '2024-10-21 21:38:59', '2024-11-02', 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', '2', NULL, 1, '1729517939', 'testing 2'),
(42, 7, '2024-10-21 21:38:59', '2024-11-01', 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', '1', NULL, 1, '1729517939', 'testing 1');

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
  `department_head` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TBA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department`, `department_head`) VALUES
(3, 'CICS', 'Clyden alibania'),
(4, 'CBEA', 'Jay Omotoy'),
(5, 'CTED', 'Romar Banadero'),
(6, 'REGISTRAR', 'Reymark Jay Sosa'),
(7, 'UNIVERSITY MIS', 'Pao Roy');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_config`
--

CREATE TABLE `tbl_email_config` (
  `config_id` int NOT NULL,
  `tag` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_email_config`
--

INSERT INTO `tbl_email_config` (`config_id`, `tag`, `message`, `subject`) VALUES
(4, 'borrow_item', '<h2 align=\"center\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</h2><br>\n<p>Dear System administrator,</p><br>\n\n<p>I hope this message finds you well. I am [name], from [office] writing to formally request the borrowing of the following item(s)/equipment:</p>\n\n<table style=\"\\&quot;border-collapse:\" collapse\\\"=\"\"><thead><tr><th>Item</th><th>Quantity</th><th>Purpose</th><th><p>Expected Date of Return</p></th></tr></thead><tbody><tr></tr></tbody></table>\n\n<p><br></p><p></p><p></p><p><br></p><p></p>I assure you that I will handle the item(s) with care and return them in good condition. If needed, I am happy to complete any necessary forms or follow any specific procedures you may have for borrowing items.<br><div>Thank you for considering my request. I look forward to your prompt response.</div><br><div>Best regards,</div><br><div>[name]</div><br><div>[contact]</div><div><br></div><div>To process the request, please click <a href=\"http://localhost/pairs\" target=\"_blank\">here</a> to login.<br></div><p></p><br>', 'Request to Borrow Item/Equipment');

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
  `item_type` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 = consumable\r\n0 = non-consumable',
  `condition_id` int DEFAULT NULL COMMENT 'id from condition tbl - status',
  `acquired_by` int DEFAULT NULL,
  `date_acquired` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_name`, `item_desc`, `item_brand`, `item_model`, `item_price`, `item_category`, `item_type`, `condition_id`, `acquired_by`, `date_acquired`, `item_uuid`) VALUES
(18, 'LENOVO IdeaPad Slim 3 15IAH8 (83ER0023PH) Intel® Core™ i5 Laptop (Arctic Grey)', '<p><br></p><p><img src=\"https://pcx.com.ph/cdn/shop/files/LT-LENOVO-IP3-15IAH8-SLIM3-_83ER0023PH_-I5-OFFICE-1.jpg?v=1699240336&amp;width=600\" style=\"width: 104px; height: 104px; float: left;\" class=\"note-float-left\"></p><p>LENOVO<br>\n  IP3-15IAH8 SLIM3 (83ER0023PH) ARCTIC GREY INTEL CORE I5-12450H/16GB LPDDR5<br>\n  4800MHZ/512GB M.2 NVME PCIE SSD/INTEL UHD GRAPHICS/15.6\" FHD/WINDOWS 11<br>\n  HOME SL 64BIT/MS OFFICE HOME &amp; STUDENT 2021/WEBCAM/BACKLIT<br>\n  KB/WIFI/BT/AUDIO PORT/CARD READER/USB 3.0/<br></p>', 'LENOVO', '83ER0023PH', 'PHP 38,995.00', 1, '2', 1, 6, '2024-10-16', 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM='),
(19, 'ACER Nitro V ANV15-51-519K GeForce RTX™ 2050 Intel® Core™ i5 Laptop (Obsidian Black)', '<p><img src=\"https://pcx.com.ph/cdn/shop/files/LT-ACER-NITRO-V-ANV15-51-519K-I5-RTX2050-OFFICE-1.jpg?v=1697002842&amp;width=600\" style=\"width: 115px; height: 115px; float: left;\" class=\"note-float-left\">ACER<br>\n  NITRO V ANV15-51-519K OBSIDIAN BLACK INTEL CORE I5-13420H/8GB DDR5/512GB M.2<br>\n  NVME PCIE SSD/NVIDIA GEFORCE RTX2050 4GB GDDR6/15.6\" FHD IPS<br>\n  144HZ/WINDOWS 11 HOME SL 64BIT/MS OFFICE HOME &amp; STUDENT<br>\n  2021/WEBCAM/BACKLIT KB/WIFI/BT/LAN/AUDIO PORT/USB 3.2/US<br></p>', 'ACER', 'ANV15-51-519K', 'PHP 39,999.00', 12, '2', 1, 5, '2024-10-16', 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM='),
(20, 'LENOVO IdeaPad Gaming 3 (82S9008YPH) GeForce RTX™ 3050 Ti Intel® Core™ i5 Laptop (Onyx Grey)', '<p><img src=\"https://pcx.com.ph/cdn/shop/products/1.LT-LENOVO-IDEAPAD-GAMING-3-82S9008YPH-I5-3050TI-1-1.webp?v=1688459205&amp;width=600\" style=\"width: 114px; height: 114px; float: left;\" class=\"note-float-left\"></p><p>LENOVO IDEAPAD GAMING 3-15IAH7 (82S9008YPH) ONYX GREY INTEL CORE \nI5-12500H/8GB DDR4/512GB M.2 NVME SSD/NVIDIA GEFORCE RTX3050TI 4GB \nGDDR6/15.6\" FHD 165HZ/WINDOWS 11 HOME SL 64BIT/WEBCAM/RGB BACKLIT \nKB/WIFI/BT/LAN/AUDIO PORT/USB 3.0/USB TYPE-C/HDMI/LENOVO<br></p>', 'LENOVO', '82S9008YPH', 'PHP 45,995.00', 1, '2', 1, 2, '2024-10-16', 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc='),
(21, 'ACER Aspire Lite 15 AL15-51M-773W Intel® Core™ i7 Laptop (Titanium Gray)', '<p><img src=\"https://pcx.com.ph/cdn/shop/files/LT-ACER-ASPIRE-LITE-15-AL15-51M-773W-I7-OFFICE-1.jpg?v=1704337290&amp;width=600\" style=\"width: 134px; height: 134px; float: left;\" class=\"note-float-left\"></p><p>ACER<br>\n  ASPIRE LITE 15 AL15-51M-773W TITANIUM GRAY INTEL CORE I7-1165G7/8GB DDR4<br>\n  3200MHZ/512GB M.2 NVME PCIE SSD/INTEL IRIS XE GRAPHICS/15.6\" FHD/WINDOWS<br>\n  11 HOME SL 64BIT/MS OFFICE HOME &amp; STUDENT 2021/WEBCAM/WIFI/BT/LAN/SIM<br>\n  SLOT/MSD SLOT/AUDIO PORT/USB PORT/<br></p>', 'ACER', 'AL15-51M-773W', 'PHP 38,999.00', 11, '2', 2, 9, '2024-10-16', 'NjcwZmMzYmM1MTExZjE3MjkwODYzOTY=');

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
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `act_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`member_id`, `email_address`, `act_id`, `id_number`, `member_type`, `f_name`, `m_name`, `l_name`, `sex`, `department`, `contact`, `yr_level`) VALUES
(1, 'saplajeff16@gmail.com', '8c31980ab8641a4d5d0e5f9b347a1dd4', 'cos-123', 2, 'Jefrey', '', 'Quiniano', 1, 7, '092222', NULL),
(5, 'jefrey.mis@csu.edu.ph', '9abeb733ebcc6530f02c80e06bea0eee', '443', 1, 'Agbubulud', '', 'Nak', 1, 5, '0922222', 1);

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
  `item_uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_storage`
--

INSERT INTO `tbl_storage` (`storage_id`, `room_id`, `item_uuid`, `item_qty`) VALUES
(5, 12, 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 12),
(6, 12, 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 3),
(7, 7, 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc=', 1),
(8, 10, 'NjcwZmMzYmM1MTExZjE3MjkwODYzOTY=', 1);

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
-- Indexes for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  ADD PRIMARY KEY (`config_id`);

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
  MODIFY `acct_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  MODIFY `borrow_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `department_id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  MODIFY `config_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_item_handler`
--
ALTER TABLE `tbl_item_handler`
  MODIFY `handler_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  MODIFY `storage_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

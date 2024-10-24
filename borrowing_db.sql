-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2024 at 09:59 PM
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
(3, 'admin', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', 2, 0, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3BhaXJzLyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3QvcGFpcnMvIiwiZXhwIjo2MjI3MTY1Mzc5NjAwLCJkYXRhIjp7InVzZXJuYW1lIjoiYWRtaW4iLCJ1c2VyX3R5cGUiOjIsImFjY3Rfc3RhdHVzIjowLCJhY2N0X2lkIjozLCJhY2N0X3V1aWQiOiI4YzMxOTgwYWI4NjQxYTRkNWQwZTVmOWIzNDdhMWRkNCJ9fQ.EjmkxLhQeRFLQ_0bxNd83kGmvqMm8fzSP_8T2bOb5K8', NULL, '8c31980ab8641a4d5d0e5f9b347a1dd4'),
(7, 'agbubulud', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', 1, 0, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3BhaXJzLyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3QvcGFpcnMvIiwiZXhwIjo2MjI3MTg2NTA4MDAwLCJkYXRhIjp7InVzZXJuYW1lIjoiYWdidWJ1bHVkIiwidXNlcl90eXBlIjoxLCJhY2N0X3N0YXR1cyI6MCwiYWNjdF9pZCI6NywiYWNjdF91dWlkIjoiOWFiZWI3MzNlYmNjNjUzMGYwMmM4MGUwNmJlYTBlZWUifX0.9m8gxy11aEvbbyk6FwkbvqDpIqC0uAAo8g7w4mkVi6A', NULL, '9abeb733ebcc6530f02c80e06bea0eee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow`
--

CREATE TABLE `tbl_borrow` (
  `borrow_id` bigint UNSIGNED NOT NULL,
  `borrower_id` int UNSIGNED NOT NULL,
  `date_borrowed` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_returned` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_date_returned` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `item_id` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of items',
  `borrowed_qty` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of number of items borrowed',
  `approved_qty` int DEFAULT NULL,
  `returned_qty` int DEFAULT NULL,
  `remarks` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of id from remarks table',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = pending\r\n2 = approved\r\n3 = acquired \r\n4 = returned\r\n5 = declined ',
  `order_num` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_borrow`
--

INSERT INTO `tbl_borrow` (`borrow_id`, `borrower_id`, `date_borrowed`, `date_returned`, `actual_date_returned`, `item_id`, `borrowed_qty`, `approved_qty`, `returned_qty`, `remarks`, `status`, `order_num`, `purpose`) VALUES
(6, 7, '2024-10-24 21:29:05', '2024-11-01', '2024-10-24', 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', '2', 2, 2, 's  g d f sdfs sdf sdf', 4, '1729776545', 'eeee'),
(7, 7, '2024-10-24 21:29:05', '2024-10-25', '2024-10-24', 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', '10', 5, 5, 'dsfdfdf fds fdsf', 4, '1729776545', 'ddddd'),
(8, 7, '2024-10-24 21:29:05', '2024-11-01', '2024-10-24', 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc=', '2', 1, 1, 'all goods', 4, '1729776545', 'fffff');

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
(4, 'borrow_item', '<h2 align=\"center\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</h2><br>\n<p>Dear System administrator,</p><br>\n\n<p>I hope this message finds you well. I am [name], from [office] writing to formally request the borrowing of the following item(s)/equipment:</p>\n\n<table style=\"\\&quot;border-collapse:\" collapse\\\"=\"\"><thead><tr><th>Item</th><th>Quantity</th><th>Purpose</th><th><p>Expected Date of Return</p></th></tr></thead><tbody><tr></tr></tbody></table>\n\n<p><br></p><p></p>I assure you that I will handle the item(s) with care and return them in good condition. If needed, I am happy to complete any necessary forms or follow any specific procedures you may have for borrowing items.<br><div>Thank you for considering my request. I look forward to your prompt response.</div><br><div><br></div><div><br></div><div>Best regards,</div><br><div>[name]</div><br><div>[contact]</div><div><br></div><div><br></div><div>To process the request, please click <a href=\"http://localhost/pairs\" target=\"_blank\">here</a> to login.<br></div><p></p><br>', 'Request to Borrow Item/Equipment'),
(5, 'acct_created', '<h2 style=\"text-align: center; \" class=\"\"><span style=\"text-align: var(--bs-body-text-align);\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</span><span style=\"text-align: var(--bs-body-text-align);\">S</span></h2><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\">Dear [name<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">],</span></p><p style=\"text-align: left;\" class=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\"><br></span></p><p style=\"text-align: left;\" class=\"\">We are excited to inform you that your account has been successfully created!&nbsp;</p><p style=\"text-align: left;\" class=\"\">You can now enjoy all the features and benefits our platform has to offer.</p><p style=\"text-align: left;\" class=\"\"> Here are some details to get you started:</p><p style=\"\" class=\"\"><b>Username: </b>[username]</p><p style=\"\" class=\"\"><b>Password: </b>[password]</p><p>To log in, please visit our website at&nbsp;<a href=\"http://localhost/pairs\" target=\"_blank\">http://localhost/pairs</a> and enter your credentials.</p><p class=\"\"></p><p></p><p></p><p>Thank you for joining us! We look forward to serving you.</p><p><b>Reminders:</b> <font color=\"#ce0000\">For you account security, change your password immediately after login.&nbsp;<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Do not share this message to anyone.</span></font></p><p style=\"text-align: left;\" class=\"\"><br></p>', 'Account Created'),
(6, 'req_approved', '<h2 align=\"center\" style=\"\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</h2><p style=\"color: rgb(0, 0, 0);\"><br></p><p style=\"\">Dear [name],</p><p style=\"\"><br></p><p style=\"\"><br></p><p style=\"\">We are pleased to inform you that your request for the item&nbsp;<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">with reference number<font color=\"#6ba54a\">&nbsp;</font></span><span style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align); font-weight: bolder;\">[order_num]&nbsp;</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">has been approved.</span></p>\n\n<table style=\"\\&quot;border-collapse:\" collapse\\\"=\"\"><thead><tr><th>Item</th><th>Requested Quantity</th><th>Approved Quantity</th><th>Purpose</th><th><p>Expected Date of Return</p></th></tr></thead><tbody><tr></tr></tbody></table><p style=\"\"><b style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\"><br></b></p><p style=\"\">You may now pickup the item(s) at the [office]. If you have any questions or need further assistance, feel free to reach out.</p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Thank you for your request.</span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\"><b>Note: Please show this email to the management as evidence.</b></span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Best Regards,</span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">- PAIRS Management</span></p>', 'Your Item Request Has Been Approved!'),
(7, 'req_denied', '<h2 class=\"\" style=\"text-align: center; \"><span style=\"text-align: var(--bs-body-text-align);\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</span><span style=\"text-align: var(--bs-body-text-align);\">S</span></h2><h2 class=\"\" style=\"text-align: left;\"><span style=\"text-align: var(--bs-body-text-align);\"><br></span></h2><p style=\"text-align: left;\" class=\"\"><span style=\"text-align: var(--bs-body-text-align);\">Dear [name],</span></p><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\">Thank you for your recent item request. Request number <b>[order_num]</b>.&nbsp;</p><p style=\"text-align: left;\" class=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">After careful consideration, we regret to inform you that your request has been declined.</span></p><p style=\"text-align: left;\" class=\"\">This decision was made due to [reason].</p><p style=\"text-align: left;\" class=\"\"><br></p><p>We appreciate your understanding and encourage you to reach out if you have any questions or if there\'s anything else we can assist you with.</p><p>Thank you for your interest.</p><p><br></p><p><br></p><p style=\"text-align: left;\" class=\"\">Best regards,</p><p style=\"text-align: left;\" class=\"\">- PAIRS Management</p>', 'Update on Your Item Request'),
(8, 'item_delivered', '<p></p><h2 class=\"\" style=\"text-align: center; \"><span style=\"text-align: var(--bs-body-text-align);\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</span><span style=\"text-align: var(--bs-body-text-align);\">S</span></h2><p style=\"text-align: left;\" class=\"\"><span style=\"text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"text-align: left;\" class=\"\">Dear [name],</p><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\">Your item request with a reference number&nbsp;<span style=\"font-weight: 700; font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\">[order_num]&nbsp;</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">&nbsp;has been successfully delivered.</span></p><table style=\"\\&quot;border-collapse:\" collapse\\\"=\"\"><thead><tr><th>Item</th><th>Borrowed Qty</th><th>Approved Qty</th><th><p>Expected Date of Return</p></th></tr></thead><tbody><tr></tr></tbody></table>\n\n\n<p></p><p><br></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Thank you!</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Best regards,</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">- PAIRS Management</span></p>', 'Item Delivered'),
(9, 'item_returned', '<p></p><h2 class=\"\" style=\"text-align: center; \"><span style=\"text-align: var(--bs-body-text-align);\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</span><span style=\"text-align: var(--bs-body-text-align);\">S</span></h2><p style=\"text-align: left;\" class=\"\"><span style=\"text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"text-align: left;\" class=\"\"><span style=\"text-align: var(--bs-body-text-align);\">Dear [name],</span></p><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\">We are writing to confirm that the item<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">&nbsp;you borrowed&nbsp;</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">with reference number&nbsp;</span><span style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align); font-weight: 700;\">[order_num]</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">&nbsp;</span><span style=\"text-align: var(--bs-body-text-align); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">has been successfully returned.</span></p>\n\n\n<table style=\"\\&quot;border-collapse:\" collapse\\\"=\"\"><thead><tr><th>Item</th><th>Borrowed</th><th>Returned</th><th><p>Expected Date of Return</p></th><td><span style=\"font-weight: 700;\">Date of Return</span></td><td><span style=\"font-weight: 700;\">Remarks</span></td></tr></thead><tbody><tr></tr></tbody></table>\n\n<p></p><p><br></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Thank you!</span></p><p><br></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Best regards,</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">- PAIRS Management</span></p>', 'Item Returned');

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
(5, 12, 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 7),
(6, 12, 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 13),
(7, 7, 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc=', 2),
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
  MODIFY `borrow_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `config_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

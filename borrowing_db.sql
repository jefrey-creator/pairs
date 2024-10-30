-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2024 at 10:38 PM
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
(3, 'admin', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', 2, 0, NULL, '', NULL, '8c31980ab8641a4d5d0e5f9b347a1dd4'),
(7, 'agbubulud', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', 1, 0, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3BhaXJzLyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3QvcGFpcnMvIiwiZXhwIjo2MjI3NDg1MjI4ODAwLCJkYXRhIjp7InVzZXJuYW1lIjoiYWdidWJ1bHVkIiwidXNlcl90eXBlIjoxLCJhY2N0X3N0YXR1cyI6MCwiYWNjdF9pZCI6NywiYWNjdF91dWlkIjoiOWFiZWI3MzNlYmNjNjUzMGYwMmM4MGUwNmJlYTBlZWUifX0.rsTlO30L4YXk1CE5pl03843FwvSUaPlAunLLZjtQ6Fc', NULL, '9abeb733ebcc6530f02c80e06bea0eee'),
(8, 'loki', '$2y$10$x4EPt3Hko9bD8QyYkvmII.H76NcpDXaXVbuP3Kb7ndMGs8uXzzBce', 1, 0, NULL, '', NULL, 'ffdaa5a933893a9c31575751f8e56153');

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
  `borrowed_qty` int NOT NULL DEFAULT '0' COMMENT 'array of number of items borrowed',
  `approved_qty` int NOT NULL DEFAULT '0',
  `returned_qty` int NOT NULL DEFAULT '0',
  `remarks` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of id from remarks table',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = pending\r\n2 = approved\r\n3 = acquired \r\n4 = returned\r\n5 = declined ',
  `order_num` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reason_to_declined` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_borrow`
--

INSERT INTO `tbl_borrow` (`borrow_id`, `borrower_id`, `date_borrowed`, `date_returned`, `actual_date_returned`, `item_id`, `borrowed_qty`, `approved_qty`, `returned_qty`, `remarks`, `status`, `order_num`, `purpose`, `reason_to_declined`) VALUES
(6, 7, '2024-10-24 21:29:05', '2024-11-01', '2024-10-24', 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 2, 2, 2, 's  g d f sdfs sdf sdf', 4, '1729776545', 'eeee', NULL),
(7, 7, '2024-10-24 21:29:05', '2024-10-25', '2024-10-24', 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 10, 5, 5, 'dsfdfdf fds fdsf', 4, '1729776545', 'ddddd', NULL),
(8, 7, '2024-10-24 21:29:05', '2024-11-01', '2024-10-24', 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc=', 2, 1, 1, 'all goods', 4, '1729776545', 'fffff', NULL),
(9, 7, '2024-10-25 08:21:15', '2024-10-25', '2024-10-25', 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 3, 3, 3, 'all goods', 4, '1729815675', 'test', NULL),
(10, 7, '2024-10-25 09:24:17', '2024-10-25', NULL, 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 1, 2, 0, NULL, 3, '1729819457', 'test', NULL),
(11, 7, '2024-10-25 09:24:33', '2024-10-31', NULL, 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 2, 0, 0, NULL, 5, '1729819473', 'test', NULL),
(12, 7, '2024-10-25 10:34:21', '2024-10-26', NULL, 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 1, 1, 0, NULL, 2, '1729823661', 'test', NULL),
(13, 7, '2024-10-25 10:34:21', '2024-10-26', NULL, 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 2, 1, 0, NULL, 2, '1729823661', 'test test', NULL),
(14, 7, '2024-10-25 19:50:39', '2024-10-25', '2024-10-25', 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 10, 10, 10, 'werererererere', 4, '1729857039', 'test', NULL),
(15, 7, '2024-10-25 19:50:39', '2024-10-26', NULL, 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 1, 0, 0, NULL, 5, '1729857039', 'test 2', NULL),
(16, 8, '2024-10-26 19:08:46', '2024-11-07', '2024-10-26', 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 1, 1, 1, 'all goods', 4, '1729940926', 'testing 1', NULL),
(17, 8, '2024-10-26 19:08:46', '2024-11-09', NULL, 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 1, 0, 0, NULL, 5, '1729940926', 'testing 2', NULL),
(18, 8, '2024-10-26 20:55:23', '2024-10-26', NULL, 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 2, 0, 0, NULL, 5, '1729947323', 'eeeeeee', 'testing lang po'),
(19, 8, '2024-10-26 20:55:23', '2024-11-01', NULL, 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 3, 0, 0, NULL, 5, '1729947323', 'rrrrrrr', 'testing lang po');

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
(7, 'UNIVERSITY MIS', 'Pao Roy'),
(13, 'ADMIN BUILDING', 'Froilan Pacris Jr.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_config`
--

CREATE TABLE `tbl_email_config` (
  `config_id` int NOT NULL,
  `tag` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_email_config`
--

INSERT INTO `tbl_email_config` (`config_id`, `tag`, `message`, `subject`) VALUES
(4, 'borrow_item', '<h2 align=\"center\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</h2><br>\n<p>Dear System administrator,</p><br>\n\n<p>I hope this message finds you well. I am [name], from [office] writing to formally request the borrowing of the following item(s)/equipment:</p>\n\n<table style=\"\\&quot;border-collapse:\" collapse\\\"=\"\"><thead><tr><th>Item</th><th>Quantity</th><th>Purpose</th><th><p>Expected Date of Return</p></th></tr></thead><tbody><tr></tr></tbody></table>\n\n<p><br></p><p></p>I assure you that I will handle the item(s) with care and return them in good condition. If needed, I am happy to complete any necessary forms or follow any specific procedures you may have for borrowing items.<br><div>Thank you for considering my request. I look forward to your prompt response.</div><br><div><br></div><div><br></div><div>Best regards,</div><br><div>[name]</div><br><div>[contact]</div><div><br></div><div><br></div><div>To process the request, please click <a href=\"http://localhost/pairs\" target=\"_blank\">here</a> to login.<br></div><p></p><br>', 'Request to Borrow Item/Equipment'),
(5, 'acct_created', '<h2 style=\"text-align: center; \" class=\"\"><span style=\"text-align: var(--bs-body-text-align);\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</span><span style=\"text-align: var(--bs-body-text-align);\">S</span></h2><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\"><br></p><p style=\"text-align: left;\" class=\"\">Dear [name<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\">],</span></p><p style=\"text-align: left;\" class=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight);\"><br></span></p><p style=\"text-align: left;\" class=\"\">We are excited to inform you that your account has been successfully created!&nbsp;</p><p style=\"text-align: left;\" class=\"\">You can now enjoy all the features and benefits our platform has to offer.</p><p style=\"text-align: left;\" class=\"\"> Here are some details to get you started:</p><p style=\"\" class=\"\"><b>Username: </b>[username]</p><p style=\"\" class=\"\"><b>Password: </b>[password]</p><p>To log in, please visit our website at&nbsp;<a href=\"http://localhost/pairs\" target=\"_blank\">http://localhost/pairs</a> and enter your credentials.</p><p class=\"\"></p><p></p><p></p><p>Thank you for joining us! We look forward to serving you.</p><p><b>Reminders:</b> <font color=\"#ce0000\">For you account security, change your password immediately after login.&nbsp;<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Do not share this message to anyone.</span></font></p><p style=\"text-align: left;\" class=\"\"><br></p>', 'Account Created'),
(6, 'req_approved', '<h2 align=\"center\" style=\"\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</h2><p style=\"color: rgb(0, 0, 0);\"><br></p><p style=\"\">Dear [name],</p><p style=\"\"><br></p><p style=\"\"><br></p><p style=\"\">We are pleased to inform you that your request for the item&nbsp;<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">with reference number<font color=\"#6ba54a\">&nbsp;</font></span><span style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align); font-weight: bolder;\">[order_num]&nbsp;</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">has been approved.</span></p>\n\n<table style=\"\\&quot;border-collapse:\" collapse\\\"=\"\"><thead><tr><th>Item</th><th>Requested Quantity</th><th>Approved Quantity</th><th>Purpose</th><th><p>Expected Date of Return</p></th></tr></thead><tbody><tr></tr></tbody></table><p style=\"\"><b style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\"><br></b></p><p style=\"\">You may now pickup the item(s) at the [office] office. If you have any questions or need further assistance, feel free to reach out.</p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Thank you for your request.</span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\"><b>Note: Please show this email to the management as evidence.</b></span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Best Regards,</span></p><p style=\"\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">- PAIRS Management</span></p>', 'Your Item Request Has Been Approved!'),
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
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(19, 'ACER Nitro V ANV15-51-519K GeForce RTX™ 2050 Intel® Core™ i5 Laptop (Obsidian Black)', '<p><img src=\"https://pcx.com.ph/cdn/shop/files/LT-ACER-NITRO-V-ANV15-51-519K-I5-RTX2050-OFFICE-1.jpg?v=1697002842&amp;width=600\" style=\"width: 115px; height: 115px; float: left;\" class=\"note-float-left\">NITRO V ANV15-51-519K OBSIDIAN BLACK INTEL CORE I5-13420H/8GB DDR5/512GB M.2<br>\n  NVME PCIE SSD/NVIDIA GEFORCE RTX2050 4GB GDDR6/15.6\" FHD IPS<br>\n  144HZ/WINDOWS 11 HOME SL 64BIT/MS OFFICE HOME &amp; STUDENT<br>\n  2021/WEBCAM/BACKLIT KB/WIFI/BT/LAN/AUDIO PORT/USB 3.2/US<br></p>', 'ACER', 'ANV15-51-519K', 'PHP 39,999.00', 12, '2', 1, 5, '2024-10-16', 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM='),
(20, 'LENOVO IdeaPad Gaming 3 (82S9008YPH) GeForce RTX™ 3050 Ti Intel® Core™ i5 Laptop (Onyx Grey)', '<p><img src=\"https://pcx.com.ph/cdn/shop/products/1.LT-LENOVO-IDEAPAD-GAMING-3-82S9008YPH-I5-3050TI-1-1.webp?v=1688459205&amp;width=600\" style=\"width: 114px; height: 114px; float: left;\" class=\"note-float-left\"></p><p>LENOVO IDEAPAD GAMING 3-15IAH7 (82S9008YPH) ONYX GREY INTEL CORE \nI5-12500H/8GB DDR4/512GB M.2 NVME SSD/NVIDIA GEFORCE RTX3050TI 4GB \nGDDR6/15.6\" FHD 165HZ/WINDOWS 11 HOME SL 64BIT/WEBCAM/RGB BACKLIT \nKB/WIFI/BT/LAN/AUDIO PORT/USB 3.0/USB TYPE-C/HDMI/LENOVO<br></p>', 'LENOVO', '82S9008YPH', 'PHP 45,995.00', 1, '2', 1, 2, '2024-10-16', 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc='),
(21, 'ACER Aspire Lite 15 AL15-51M-773W Intel® Core™ i7 Laptop (Titanium Gray)', '<p><img src=\"https://pcx.com.ph/cdn/shop/files/LT-ACER-ASPIRE-LITE-15-AL15-51M-773W-I7-OFFICE-1.jpg?v=1704337290&amp;width=600\" style=\"width: 134px; height: 134px; float: left;\" class=\"note-float-left\"></p><p>ACER<br>\n  ASPIRE LITE 15 AL15-51M-773W TITANIUM GRAY INTEL CORE I7-1165G7/8GB DDR4<br>\n  3200MHZ/512GB M.2 NVME PCIE SSD/INTEL IRIS XE GRAPHICS/15.6\" FHD/WINDOWS<br>\n  11 HOME SL 64BIT/MS OFFICE HOME &amp; STUDENT 2021/WEBCAM/WIFI/BT/LAN/SIM<br>\n  SLOT/MSD SLOT/AUDIO PORT/USB PORT/<br></p>', 'ACER', 'AL15-51M-773W', 'PHP 38,999.00', 11, '2', 2, 9, '2024-10-16', 'NjcwZmMzYmM1MTExZjE3MjkwODYzOTY='),
(22, 'Acer Brand New laptop 15.6 inch AMD Ryzen7 Windows 11pro RAM16GB SSD512GB Game Notebook Fingerprint Unlock', '<p><img style=\"width: 142px; height: 142px; float: left;\" src=\"https://down-ph.img.susercontent.com/file/cn-11134207-7ras8-m15c81s0tiaz6b.webp\" class=\"note-float-left\"><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Product Information: R7-6800U </span><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">RAM：16GB/12GB/8GB</span></p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">SSD：128GB/256GB/512GB</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">Processor cores: 4</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">Processor threads: 4</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">Screen size: 15.6 inches</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">Screen resolution: 1920 x 1080 pixels, IPS</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">Wireless type: Bluetooth+WIFI</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">WIFI frequency: 2.4\\5 Ghz</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">USB interface: USB 2.0 *2、USB 3.0、HDMI</p><p class=\"QN2lPu\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space-collapse: preserve;\">Operating System: Windows 11 Pro</p>', 'Acer', 'R7-6800U', 'PHP 18,249.00', 1, '2', 1, 8, '2024-10-26', 'NjcxYjhiMDA4M2I5ZjE3Mjk4NTgzMDQ=');

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
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id` int NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `user_id`, `action`, `time_stamp`, `ip_address`, `details`) VALUES
(1, 'borrowing_user', 'Log in', '2024-10-25 11:00:12', '::1', 'Incorrect username or password.'),
(2, 'admin', 'Log in', '2024-10-25 11:00:33', '::1', 'Successfully logged in.'),
(3, 'admin', 'Add Item Condition', '2024-10-25 11:04:37', '::1', 'Condition successfully saved.:OK PO'),
(4, 'admin', 'Update Item Condition', '2024-10-25 11:06:23', '::1', 'Condiition successfully updated.:OK POssss:7'),
(5, 'admin', 'Update Item Condition', '2024-10-25 11:07:39', '::1', 'Condiition successfully updated. - new data:basta id:7'),
(6, 'admin', 'Add department', '2024-10-25 11:14:38', '::1', ''),
(7, 'admin', 'Add department', '2024-10-25 11:17:42', '::1', 'Department successfully added. Head:head Dept:head'),
(8, 'admin', 'Update department', '2024-10-25 11:18:01', '::1', 'Department successfully updated. Head:Dd Dept:DdID: 11'),
(9, 'admin', 'Delete department', '2024-10-25 11:24:21', '::1', 'Data: [ID: 11 Dept: DD Head:Dd]'),
(10, 'admin', 'Delete department', '2024-10-25 11:24:40', '::1', 'Data: [ID: 10 Dept: DEPT Head:Head]'),
(11, 'admin', 'Delete department', '2024-10-25 11:24:54', '::1', 'Data: [ID: 12 Dept: HEAD Head:Head]'),
(12, 'admin', 'Add Item Condition', '2024-10-25 11:29:07', '::1', 'Condition successfully saved.Data: [ERRERE]'),
(13, 'admin', 'Update Item Condition', '2024-10-25 11:29:22', '::1', 'Condiition successfully updated.[new data:ERRERErrrrrr id:8][old data: ERRERE]'),
(14, 'admin', 'Add email config', '2024-10-25 11:35:37', '::1', 'Data:[ Subject:1]'),
(15, 'admin', 'Update email config', '2024-10-25 11:36:16', '::1', 'Data:[ Subject:2]'),
(16, 'admin', 'Update email config', '2024-10-25 11:37:15', '::1', 'Data: [ID: 10]'),
(17, 'admin', 'Add email config', '2024-10-25 11:40:22', '::1', 'Data:[ Subject: 1]'),
(18, 'admin', 'Delete email config', '2024-10-25 11:43:16', '::1', '[ID:11]'),
(19, 'admin', 'Add email config', '2024-10-25 11:44:00', '::1', 'Data:[ Subject: 2]'),
(20, 'admin', 'Delete email config', '2024-10-25 11:44:15', '::1', 'Configuration successfully deleted. [ID:12]'),
(21, 'admin', 'Approved Item Request', '2024-10-25 11:48:08', '::1', 'Select an item first.[Reference Number:1729823661]'),
(22, 'admin', 'Approved Item Request', '2024-10-25 11:49:23', '::1', 'Selected item was approved successfully.[Reference Number:1729823661][Success:1]'),
(23, 'agbubulud', 'Log in', '2024-10-25 11:50:08', '127.0.0.1', 'Successfully logged in.'),
(24, 'admin', 'Approved Item Request', '2024-10-25 11:51:13', '::1', 'Selected item was approved successfully.[Reference Number:1729857039][Success:1]'),
(25, 'admin', 'Decline Item Request', '2024-10-25 11:55:28', '::1', 'Requested item has been declined.[Reference Number:1729857039][Success: 1][Reason: secret! May logs kasi eh]'),
(26, 'admin', 'Item delivered.', '2024-10-25 11:58:06', '::1', 'Selected item was successfully delivered to the client.[Reference Number:1729857039][Success:1]'),
(27, 'admin', 'Item returned.', '2024-10-25 12:02:09', '::1', 'Selected item was successfully returned.[Reference Number:1729857039][Success:1]'),
(28, 'admin', 'Approved Item Request', '2024-10-25 12:11:44', '::1', 'Item successfully added.[Item: Acer Brand New laptop 15.6 inch][Success:1]'),
(29, 'admin', 'Update Item', '2024-10-25 12:21:03', '::1', 'Item successfully updated.[Old: ][New: oooooo][Success:1]'),
(30, 'admin', 'Update Item', '2024-10-25 12:29:36', '::1', '[Old: ][New: oooooo][Success:]'),
(31, 'admin', 'Update Item', '2024-10-25 12:29:50', '::1', '[Old: ][New: oooooo][Success:]'),
(32, 'admin', 'Update Item', '2024-10-25 12:30:01', '::1', '[Old: ][New: oooooo][Success:]'),
(33, 'admin', 'Update Item', '2024-10-25 12:30:32', '::1', '[Old: ][New: oooooo][Success:]'),
(34, 'admin', 'Update Item', '2024-10-25 12:30:38', '::1', '[Old: ][New: oooooo][Success:]'),
(35, 'admin', 'Update Item', '2024-10-25 12:33:01', '::1', '[Old: oooooo][New: oooooo][Success:]'),
(36, 'admin', 'Update Item', '2024-10-25 12:33:06', '::1', '[Old: oooooo][New: oooooo][Success:]'),
(37, 'admin', 'Update Item', '2024-10-25 12:33:18', '::1', '[Old: oooooo][New: oooooo][Success:]'),
(38, 'admin', 'Update Item', '2024-10-25 12:33:35', '::1', '[Old: oooooo][New: oooooo][Success:]'),
(39, 'admin', 'Update Item', '2024-10-25 12:37:40', '::1', 'Item successfully updated.[Old: oooooo][New: Acer Brand New laptop 15.6 inch AMD Ryzen7 Windows 11pro RAM16GB SSD512GB Game Notebook Fingerprint Unlock][Success:1]'),
(40, 'admin', 'Update Item', '2024-10-25 12:39:43', '::1', 'Item successfully updated.[ID: NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=] [Old: ACER Nitro V ANV15-51-519K GeForce RTX™ 2050 Intel® Core™ i5 Laptop (Obsidian Black)][New: ACER Nitro V ANV15-51-519K GeForce RTX™ 2050 Intel® Core™ i5 Laptop (Obsidian Black)][Success:1]'),
(41, 'admin', 'Add Item', '2024-10-25 12:40:51', '::1', 'Item successfully added.[Item: 1][Success:1]'),
(42, 'admin', 'Approved Item Request', '2024-10-25 12:43:01', '::1', 'Item successfully deleted.[Item ID:23][Success:1]'),
(43, 'admin', 'Add storage room', '2024-10-25 12:50:16', '::1', 'Room added successfully.[ID: ][Old: ][New: Rm 7][Success: 1]'),
(44, 'admin', 'Add storage room', '2024-10-25 12:51:16', '::1', 'Room added successfully.[Data: rm 9][Success: 1]'),
(45, 'admin', 'Update storage room', '2024-10-25 12:51:46', '::1', 'Room updated successfully.[ID: 20][Old: RM 7][New: RM 7.1][Success: 1]'),
(46, 'admin', 'Delete storage room', '2024-10-25 12:53:27', '::1', 'Room successfully deleted.[ID:20]'),
(47, 'admin', 'Delete storage room', '2024-10-25 12:54:58', '::1', 'Room successfully deleted.[ID:21][Data: RM 9]'),
(48, 'admin', 'Add category', '2024-10-25 13:01:15', '::1', 'Category added successfully.[Data: cat 13][Success: 1]'),
(49, 'admin', 'Update category', '2024-10-25 13:01:33', '::1', 'Category updated successfully.[ID: 15][Old: CAT 13][New: CAT 14][Success: 1]'),
(50, 'admin', 'Delete category', '2024-10-25 13:03:42', '::1', 'Category deleted successfully.[ID: 15] [Data: CAT 14] [Success: 1]'),
(51, 'admin', 'Add handler', '2024-10-25 13:08:50', '::1', 'Handler successfully added.[Data: keme root][Success: 1]'),
(52, 'admin', 'Update handler', '2024-10-25 13:09:12', '::1', 'Handler successfully added.[ID: 11][Old: KEME ROOT][New: KEME no ROOT][Success: 1]'),
(53, 'admin', 'Update handler', '2024-10-25 13:10:54', '::1', 'Handler successfully removed.[ID: 11][Data: KEME NO ROOT] [Success: 1]'),
(54, 'admin', 'Add department', '2024-10-25 13:13:05', '::1', 'Department name is required. Head:Froilan Pacris Jr. Dept:'),
(55, 'admin', 'Add department', '2024-10-25 13:14:06', '::1', 'Department successfully added. Head:Froilan Pacris Jr. Dept:Admin Building'),
(56, 'admin', 'Log in', '2024-10-25 14:09:10', '::1', 'Successfully logged in.'),
(57, 'admin', 'Add user account', '2024-10-25 14:16:44', '::1', 'Account successfully added.[Data: loki@gmail.com][Success: 1]'),
(58, 'admin', 'Update user account', '2024-10-25 14:17:15', '::1', 'Account successfully updated.[ID: ffdaa5a933893a9c31575751f8e56153][Success: 1]'),
(59, 'admin', 'Password Reset', '2024-10-25 14:20:00', '::1', 'Account password successfully reset.[ID: 8][Success: 1]'),
(60, 'admin', 'User account blocked', '2024-10-25 14:22:24', '::1', 'Account successfully unblock.[ID: 8][Success: 1]'),
(61, 'admin', 'User account unblocked', '2024-10-25 14:22:36', '::1', 'Account has been blocked.[ID: 8][Success: 1]'),
(62, 'admin', 'User account unblocked', '2024-10-25 14:23:09', '::1', 'Account successfully unblock.[ID: 8][Success: 1]'),
(63, 'admin', 'User account unblocked', '2024-10-25 14:23:42', '::1', 'Account has been blocked.[ID: 8][Success: 1]'),
(64, 'admin', 'User account unblocked', '2024-10-25 14:24:26', '::1', 'Account successfully unblock.[ID: 8][Success: 1]'),
(65, 'admin', 'User account blocked', '2024-10-25 14:24:43', '::1', 'Account has been blocked.[ID: 8][Success: 1]'),
(66, 'admin', 'User account unblocked', '2024-10-25 14:24:59', '::1', 'Account successfully unblock.[ID: 8][Success: 1]'),
(67, 'loki', 'Log in', '2024-10-25 15:20:37', '::1', 'Incorrect username or password.'),
(68, 'admin', 'Log in', '2024-10-26 11:04:08', '::1', 'Successfully logged in.'),
(69, 'admin', 'Password Reset', '2024-10-26 11:05:07', '::1', 'Account password successfully reset.[ID: 8][Success: 1]'),
(70, 'loki', 'Log in', '2024-10-26 11:05:16', '::1', 'Successfully logged in.'),
(71, 'loki', 'Request Item', '2024-10-26 11:08:49', '::1', 'The item(s) you want to borrow have been successfully requested. Please hold on while the custodian processes your request. You will receive an email notification once it is approved. [Reference Number:1729940926] [Success: 1]'),
(72, 'admin', 'Log in', '2024-10-26 11:17:03', '127.0.0.1', 'Successfully logged in.'),
(73, 'admin', 'Approved Item Request', '2024-10-26 11:27:55', '127.0.0.1', 'Selected item was approved successfully.[Reference Number:1729940926][Success:1]'),
(74, 'admin', 'Item delivered.', '2024-10-26 12:35:39', '127.0.0.1', 'Selected item was successfully delivered to the client.[Reference Number:1729940926][Success:1]'),
(75, 'admin', 'Item returned.', '2024-10-26 12:39:05', '127.0.0.1', 'Selected item was successfully returned.[Reference Number:1729940926][Success:1]'),
(76, 'admin', 'Decline Item Request', '2024-10-26 12:51:39', '127.0.0.1', 'Requested item has been declined.[Reference Number:1729940926][Success: 1][Reason: for example lang]'),
(77, 'loki', 'Request Item', '2024-10-26 12:55:27', '::1', 'The item(s) you want to borrow have been successfully requested. Please hold on while the custodian processes your request. You will receive an email notification once it is approved. [Reference Number:1729947323] [Success: 1]'),
(78, 'admin', 'Decline Item Request', '2024-10-26 13:04:27', '127.0.0.1', 'Requested item has been declined.[Reference Number:1729947323][Success: 1][Reason: testing lang po]'),
(79, 'loki', 'Change Password', '2024-10-26 14:34:37', '::1', 'Current password is incorrect.[ID: ffdaa5a933893a9c31575751f8e56153][Success: ]'),
(80, 'loki', 'Change Password', '2024-10-26 14:34:47', '::1', 'Password successfully updated.[ID: ffdaa5a933893a9c31575751f8e56153][Success: 1]'),
(81, 'loki', 'Change Password', '2024-10-26 14:35:25', '::1', 'Password successfully updated.[ID: ffdaa5a933893a9c31575751f8e56153][Success: 1]'),
(82, 'loki', 'Log in', '2024-10-26 14:35:48', '::1', 'Incorrect username or password.'),
(83, 'loki', 'Log in', '2024-10-26 14:35:51', '::1', 'Successfully logged in.'),
(84, 'admin', 'Log in', '2024-10-26 14:36:54', '::1', 'Successfully logged in.');

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
(5, 'jefrey.mis@csu.edu.ph', '9abeb733ebcc6530f02c80e06bea0eee', '443', 1, 'Agbubulud', '', 'Nak', 1, 5, '0922222', 1),
(6, 'loki@gmail.com', 'ffdaa5a933893a9c31575751f8e56153', '1234', 2, 'Loki', '', 'Oki', 1, 3, '0927888888', NULL);

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
(5, 12, 'NjcwZmMyNWI4ZTkxYzE3MjkwODYwNDM=', 4),
(6, 12, 'NjcwZmMyYmZiZjUwYzE3MjkwODYxNDM=', 12),
(7, 7, 'NjcwZmMzNTk4NmU2NDE3MjkwODYyOTc=', 2),
(8, 10, 'NjcwZmMzYmM1MTExZjE3MjkwODYzOTY=', 1),
(9, 18, 'NjcxYjhiMDA4M2I5ZjE3Mjk4NTgzMDQ=', 21);

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
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `acct_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  MODIFY `borrow_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_condition`
--
ALTER TABLE `tbl_condition`
  MODIFY `condition_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  MODIFY `config_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_item_handler`
--
ALTER TABLE `tbl_item_handler`
  MODIFY `handler_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  MODIFY `storage_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

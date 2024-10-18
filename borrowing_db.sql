-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 02:32 PM
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
(3, 'jefrey', '$2y$10$6h3oEwv/OLP4VHKOs5FBT..xEusIi1HhJ0GNIiQQO2WrxRzq7kv8C', 2, 0, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2JvcnJvd2luZy8iLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0L2JvcnJvd2luZy8iLCJleHAiOjYyMjUyMjY2MjQ4MDAsImRhdGEiOnsidXNlcm5hbWUiOiJqZWZyZXkiLCJ1c2VyX3R5cGUiOjIsImFjY3Rfc3RhdHVzIjowLCJsb2dpbl90b2tlbiI6IiIsImFjY3RfaWQiOjN9fQ.bw2R0tTe3UUafdIvZ4U6fEqo4tt7llI8XauQh0-Jbfk', NULL, '462e4d9dc4fa7aba0273bb45c94e1026'),
(5, 'agbubulud', '$2y$10$1j2HsgG1rcZ7IpJJQIf/neIV7/.vwLJWhcEaZj4rKHvVErjF3aknq', 1, 0, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2JvcnJvd2luZy8iLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0L2JvcnJvd2luZy8iLCJleHAiOjYyMjUyMjYwNTYwMDAsImRhdGEiOnsidXNlcm5hbWUiOiJhZ2J1YnVsdWQiLCJ1c2VyX3R5cGUiOjEsImFjY3Rfc3RhdHVzIjowLCJsb2dpbl90b2tlbiI6IiIsImFjY3RfaWQiOjV9fQ.Zl8ylIkDfxGkw7qwW0H8d9_HjVv8QvCUeTZXDEyld-U', NULL, '75c63214b2b005fc6aa100f113171fff'),
(6, 'pabulud', '$2y$10$ucz7Ulh56Ng2SHaj7txHa.y0b2V0QI30qGNWE3SJlEtupu9QAV2jq', 1, 0, NULL, '', NULL, '0800a72a8192884ee48b6315595e2053');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow`
--

CREATE TABLE `tbl_borrow` (
  `borrow_id` bigint UNSIGNED NOT NULL,
  `borrower_id` int UNSIGNED NOT NULL,
  `date_borrowed` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_returned` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'array of items',
  `borrowed_qty` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of number of items borrowed',
  `remarks` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'array of id from remarks table',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = pending, 2 = approved, 3 = acquired, 4 = returned, 5 = declined | array so it will be per item approval',
  `purpose` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_borrow`
--

INSERT INTO `tbl_borrow` (`borrow_id`, `borrower_id`, `date_borrowed`, `date_returned`, `item_id`, `borrowed_qty`, `remarks`, `status`, `purpose`) VALUES
(1, 6, '2024-10-18 13:20:21', '2024-10-31', 'NjcxMWIxOTg0YTNhOTE3MjkyMTI4MjQ=', '1', NULL, 1, 'ee');

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
(7, 'PLANNING OFFICE', ''),
(11, 'MIS', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_config`
--

CREATE TABLE `tbl_email_config` (
  `config_id` int NOT NULL,
  `tag` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_email_config`
--

INSERT INTO `tbl_email_config` (`config_id`, `tag`, `message`, `subject`) VALUES
(1, 'acct_created', '<h1 style=\"text-align: center; \" class=\"\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</h1><p style=\"text-align: center; \"></p><p style=\"text-align: justify;\">Hello,&nbsp; [name]</p><p style=\"text-align: justify;\"><font color=\"#6ba54a\">You have been successfully registered to our system. Below is your login credential.</font></p><p style=\"text-align: justify;\">Username: [username]</p><p style=\"text-align: justify;\">Password: [password]</p><p style=\"text-align: justify;\">The system can be accessible via this link:&nbsp;<a href=\"http://localhost/pairs\" target=\"_blank\">http://localhost/pairs</a><a href=\"http://localhost/pairs\" target=\"_blank\"></a></p><p style=\"text-align: justify;\"><br></p><p style=\"text-align: justify;\"><font color=\"#ff0000\">Note: This is a system generated e-mail, please do not reply.</font></p>', 'Account Created'),
(5, 'borrow_item', '<h1 class=\"\" style=\"color: rgb(0, 0, 0); text-align: center;\">WELCOME TO PAPERLESS ASSESSMENT INVENTORY MANAGEMENT SYSTEM</h1><p style=\"text-align: center;\"></p><p>Dear System administrator,</p><p>I hope this message finds you well. I am writing to formally request the borrowing of the following item(s)/equipment:</p><table class=\"table table-bordered\"><tbody><tr><td>Item/Equipment Name</td><td>Quantity</td><td>Purpose of Use</td><td>Expected Date of Return</td></tr><tr><td>[item]</td><td>[qty]</td><td>[purpose]</td><td>[date_return]</td></tr></tbody></table><p>I assure you that I will handle the item(s) with care and return them in good condition. If needed, I am happy to complete any necessary forms or follow any specific procedures you may have for borrowing items.</p><p>Thank you for considering my request. I look forward to your prompt response.</p><p>Best regards,</p><p>[borrower_name]</p><p>[contact]</p>', 'Request to Borrow Item/Equipment');

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
(18, 'ACER TC-1775 DT.BLQSP.001', '<p><img src=\"https://www.complink.com.ph/cdn/shop/files/000001_30705_1800x1800.png?v=1727677953\" style=\"width: 154px; height: 154px; float: left;\" class=\"note-float-left\"><strong>Specifications</strong></p><p>\n</p><ul>\n<li>Processor/CPU: I3-14100</li>\n<li>RAM: 8GB DDR5<br>\n</li>\n<li>Storage: 1TB + 256 SSD</li>\n<li>Graphics: INT<br>\n</li>\n<li>Operating System: Windows 11</li></ul>', 'ACER', 'TC-1775', 'PHP 41,999.00', 1, '2', 1, 5, '2024-10-18', 'NjcxMWIxOTg0YTNhOTE3MjkyMTI4MjQ='),
(19, 'Acer PH16-72-73KK PREDATOR HELIOS 16 +H&S', '<p><img src=\"https://www.complink.com.ph/cdn/shop/files/000001_30472_1800x1800.png?v=1727764251\" style=\"width: 179px; float: left; height: 179px;\" class=\"note-float-left\"><strong style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\">Specifications</strong><br></p>\n<ul>\n<li>Processor: i7 14700HX<br>\n</li>\n<li>Memory: 16GB<br>\n</li>\n<li>Hard Drive: 512GB SSD<br>\n</li>\n<li>Graphics Card: 8GB RTX4070<br>\n</li>\n<li>Display: 16\" WQXGA 240Hz<br>\n</li>\n<li>Operating System: Windows 11</li></ul>', 'Acer', 'PH16-72-73KK', 'PHP 119,999.00', 1, '2', 1, 6, '2024-10-18', 'NjcxMWIyMDIxYjlhMzE3MjkyMTI5MzA=');

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
(9, 'JUNNY BOY'),
(11, 'HELLO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `member_id` bigint UNSIGNED NOT NULL,
  `email_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'jefrey.mis@csu.edu.ph', '462e4d9dc4fa7aba0273bb45c94e1026', '123', 2, 'Jefrey', '', 'Quiniano', 1, 3, '0922222', NULL),
(3, 'agbubulud@gmail.com', '75c63214b2b005fc6aa100f113171fff', '4545', 1, 'Agbubu', '', 'Lud', 1, 3, '0925555', 2),
(4, 'saplajeff16@gmail.com', '0800a72a8192884ee48b6315595e2053', '344', 1, 'Buludek', '', 'Man', 1, 4, '092222', 3);

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
(5, 12, 'NjcxMWIxOTg0YTNhOTE3MjkyMTI4MjQ=', 20),
(6, 12, 'NjcxMWIyMDIxYjlhMzE3MjkyMTI5MzA=', 5);

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
  MODIFY `acct_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  MODIFY `borrow_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `department_id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  MODIFY `config_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_item_handler`
--
ALTER TABLE `tbl_item_handler`
  MODIFY `handler_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  MODIFY `storage_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 10:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iskuxire`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserAuthority` (IN `_userId` VARCHAR(11) CHARSET utf8)   BEGIN
SELECT systemcategory.id category_id, systemcategory.categoryName, systemcategory.categoryRole,
links.id, links.linkName 
FROM user_authority left JOIN links 
on user_authority.action = links.id LEFT JOIN systemcategory
on links.categoryId = systemcategory.id
WHERE user_authority.userId = _userId ORDER BY systemcategory.categoryRole, links.id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getuserMenu` (IN `_userId` VARCHAR(11) CHARSET utf8)   BEGIN
SELECT systemcategory.id category_id, systemcategory.categoryName, systemcategory.categoryIcon, systemcategory.categoryRole,
links.id, links.linkName, links.link  
FROM user_authority left JOIN links 
on user_authority.action = links.id LEFT JOIN systemcategory
on links.categoryId = systemcategory.id
WHERE user_authority.userId = _userId GROUP BY links.id ORDER BY systemcategory.categoryRole, links.id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loginUserSp` (IN `_username` VARCHAR(255) CHARSET utf8, IN `_password` VARCHAR(255) CHARSET utf8)   BEGIN
    IF EXISTS (SELECT * FROM users WHERE users.email = _username AND users.password = _password) THEN
        IF EXISTS (SELECT * FROM users WHERE users.email = _username AND users.status = 'Active') THEN
        SELECT * FROM users WHERE users.email = _username;
        ELSE
            SELECT 'locked' as message;
        END IF;
    ELSE
        SELECT 'Deny' as message;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Available',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `status`, `date`) VALUES
(1, 'plastic', 'Available', '2024-04-12'),
(2, 'Caag', 'Available', '2024-04-14'),
(3, 'Jiingad', 'Available', '2024-04-14'),
(4, 'Jiingad 2', 'Available', '2024-04-14'),
(5, 'Jiingad 3', 'Not Available', '2024-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `linkName` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `linkName`, `link`, `categoryId`, `date`) VALUES
(1, 'Dashboard', 'dashboard.php', 1, '2024-04-14 11:48:52'),
(2, 'Category', 'category.php', 3, '2024-04-14 11:49:45'),
(3, 'Location', 'location.php', 2, '2024-04-14 11:50:02'),
(4, 'Sign out', 'login.php', 3, '2024-04-14 11:50:44'),
(5, 'Recycle Facilities', 'recyclingFicilities.php', 2, '2024-04-14 11:51:45'),
(6, 'Report Post', 'reportPosts.php', 3, '2024-04-14 11:54:17'),
(7, 'Shedule', 'schedule.php', 2, '2024-04-14 11:54:33'),
(8, 'system Category', 'systemCategories.php', 3, '2024-04-14 11:54:49'),
(9, 'System Links', 'systemLinks.php', 3, '2024-04-14 11:55:05'),
(10, 'Transactions', 'transaction.php', 2, '2024-04-14 11:55:24'),
(11, 'Users Accounts', 'users.php', 3, '2024-04-14 11:56:13'),
(12, 'Waste', 'waste.php', 2, '2024-04-14 11:56:31'),
(13, 'System Authorities', 'systemAuthorities.php', 3, '2024-04-14 12:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `district`, `village`, `zone`) VALUES
(1, 'Yaaqshiid', 'Taleex', 'Al-Baraka Hospital'),
(2, 'Hoden', 'Bandir', 'Jamhuriya University'),
(3, 'Howlwadaag', 'Bakaaro', 'Daawada');

-- --------------------------------------------------------

--
-- Table structure for table `recycling_ficilities`
--

CREATE TABLE `recycling_ficilities` (
  `ficility_id` varchar(15) NOT NULL,
  `ficility_name` varchar(255) DEFAULT NULL,
  `logo` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recycling_ficilities`
--

INSERT INTO `recycling_ficilities` (`ficility_id`, `ficility_name`, `logo`, `description`, `location_id`, `email`, `phone_no`, `date`) VALUES
('RF_001', 'Banadir', 'RF_001.png', 'waa shirkad recyling ku sameesa wax yaabha past-iga ah sida caagaha IWM', 1, 'banadir@gmail.com', 615555551, '2024-04-13 15:43:29'),
('RF_002', 'Khalfa', 'RF_002.png', 'Waa organization goal-kooda yahay in dhamaan wixii recyling ubaahan inay xaliyaan', 2, 'khalifa@gmail.com', 618390115, '2024-04-14 03:43:06'),
('RF_003', 'Hormuud', 'RF_003.png', 'waa company ku caan ah inuu recycle ku sameeyo wax yaabah wadada laso dhigay', 3, 'hormuud@gmail.com', 61555555, '2024-04-15 17:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` varchar(11) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `user_id`, `report_date`, `description`, `image`) VALUES
('Rep001', 'USR001', '2024-04-14 09:28:22', 'Halkaan waa Hodan hodan waxaa wada dhexdeeda yaalo qashin aad u tiro badan . please haka qaadaan dadka ku shaqo leh', 'Rep001.png'),
('Rep002', 'USR001', '2024-04-13 17:10:43', 'Halkaan waa Hodan hodan waxaa wada dhexdeeda yaalo qashin aad u tiro badan . please haka qaadaan dadka ku shaqo leh', 'Rep002.png'),
('Rep003', 'USR002', '2024-04-14 07:36:42', 'Halkaan waa isguuska saybiyaano waxaa aad ubooban qashin. please cidda ku shaqo leh haqaadaan', 'Rep003.png'),
('Rep004', 'USR002', '2024-04-14 07:39:33', 'Halkaan waa isguuska Fagax waxaa aad ubooban qashin shalay ilaa iyo maanta cid qaaday ma jirto. please cidda ku shaqo leh haqaadaan', 'Rep004.png'),
('Rep005', 'USR002', '2024-04-14 10:25:50', 'Shalay iyo maanta magaalada waxaa aad ugu batay qashin-ka lasoo dhigaayo waddada dhexdee. waxaan bulshada ka waciyi gelineynaa inay arintaas masuuuliyada gaar aha iska saaraan.', 'Rep005.png'),
('Rep006', 'USR003', '2024-04-16 07:30:02', 'Waxaan bogaadineynaa ololaha nadaafadeed ee ka bilaabmay golbolada dalka, waxaan lee nahay halkaas kasii wada, waxaan sido kale umahdelineynaa dhalinyarada is xilqaantay oo dadaal adag ku bixisay. \r\nMahadsanidin.', 'Rep006.png'),
('Rep007', 'USR004', '2024-04-17 20:28:08', 'Halkaan waa meel ay ka buuxaan caagad lasoo isticmaalay, waxaan farayaa qolada ku shaqo leh, inay halkaan ka qaadaan oo ay ku wareejiyaan shirkada Plastic Recycling-ka sameeya.', 'Rep007.png');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `ficility_id` varchar(15) DEFAULT NULL,
  `days_of_week` varchar(250) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `ficility_id`, `days_of_week`, `start_date`, `end_date`) VALUES
(1, 'RF_001', 'Sabti, Axad, Isniin', '2024-04-13', '2025-04-13'),
(2, 'RF_002', 'Sabti, Isniin, Arbaco', '2024-04-15', '2025-04-15'),
(3, 'RF_003', 'Talaado, Arbaco', '2024-04-14', '2025-12-14');

-- --------------------------------------------------------

--
-- Stand-in structure for view `systemauthview`
-- (See below for the actual view)
--
CREATE TABLE `systemauthview` (
`category_id` int(11)
,`categoryName` varchar(250)
,`categoryRole` varchar(250)
,`id` int(11)
,`linkName` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `systemcategory`
--

CREATE TABLE `systemcategory` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(250) NOT NULL,
  `categoryIcon` varchar(250) NOT NULL,
  `categoryRole` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemcategory`
--

INSERT INTO `systemcategory` (`id`, `categoryName`, `categoryIcon`, `categoryRole`, `date`) VALUES
(1, 'Dashboard', 'fa fa-home', 'Dashboard', '2024-04-15 17:58:08'),
(2, 'Subscriber', 'fa-solid fa-box', 'Subscriber', '2024-04-14 11:42:41'),
(3, 'Super Admin', 'fa fa-lock', 'Super Admin', '2024-04-15 17:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `ficility_id` varchar(15) DEFAULT NULL,
  `waste_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int(11) DEFAULT NULL,
  `transaction_method` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `ficility_id`, `waste_id`, `transaction_date`, `quantity`, `transaction_method`) VALUES
(1, 'USR001', 'RF_001', 1, '2024-04-14 05:23:53', 5, 'Evcplus'),
(2, 'USR001', 'RF_002', 4, '2024-04-14 04:50:15', 4, 'e-Dahab'),
(4, 'USR001', 'RF_003', 4, '2024-04-14 04:54:06', 2, 'Evcplus'),
(5, 'USR002', 'RF_003', 4, '2024-04-15 17:50:41', 4, 'e-Dahab');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `phone`, `role`, `image`, `status`) VALUES
('USR001', 'Faiso', 'ugaasa@gmail.com', 'admin', 618390120, 'User', 'USR001.png', 'Active'),
('USR002', 'Eng-Khalif', 'khalifa115@gmail.com', 'admin', 618390115, 'Admin', 'USR002.png', 'Active'),
('USR003', 'moha-nor', 'moha@gmail.com', 'admin', 2147483647, 'Admin', 'USR003.png', 'Active'),
('USR004', 'Eng-Osman', 'osman@gov.so', 'osman123', 615045014, 'Admin', 'USR004.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_authority`
--

CREATE TABLE `user_authority` (
  `id` int(11) NOT NULL,
  `userId` varchar(15) NOT NULL,
  `action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_authority`
--

INSERT INTO `user_authority` (`id`, `userId`, `action`) VALUES
(84, 'USR001', 1),
(85, 'USR001', 6),
(94, 'USR002', 1),
(95, 'USR002', 3),
(96, 'USR002', 5),
(97, 'USR002', 7),
(98, 'USR002', 10),
(99, 'USR002', 12),
(100, 'USR002', 2),
(101, 'USR002', 4),
(102, 'USR002', 6),
(103, 'USR002', 8),
(104, 'USR002', 9),
(105, 'USR002', 11),
(106, 'USR002', 13),
(107, 'USR003', 1),
(108, 'USR003', 3),
(109, 'USR003', 5),
(110, 'USR003', 7),
(111, 'USR003', 10),
(112, 'USR003', 12),
(113, 'USR003', 2),
(114, 'USR003', 4),
(115, 'USR003', 6),
(116, 'USR003', 8),
(117, 'USR003', 9),
(118, 'USR003', 11),
(119, 'USR003', 13),
(120, 'USR004', 1),
(121, 'USR004', 3),
(122, 'USR004', 5),
(123, 'USR004', 7),
(124, 'USR004', 10),
(125, 'USR004', 12),
(126, 'USR004', 2),
(127, 'USR004', 4),
(128, 'USR004', 6),
(129, 'USR004', 8),
(130, 'USR004', 9),
(131, 'USR004', 11),
(132, 'USR004', 13);

-- --------------------------------------------------------

--
-- Table structure for table `waste`
--

CREATE TABLE `waste` (
  `waste_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waste`
--

INSERT INTO `waste` (`waste_id`, `description`, `category_id`, `address`, `weight`, `user_id`, `date`) VALUES
(1, 'Waa qashin yaaley wadda dhexdeeda, kaaso oo dadka ay kamari waayeen dariiqa', 1, 'Hodon', 10, 'USR001', '2024-04-13 14:22:15'),
(4, ' waa wasaq aan kasoo qaadney afaafka hore ee madaxtooya', 4, 'Mugadishu-Somalia', 67, 'USR001', '2024-04-13 22:13:32');

-- --------------------------------------------------------

--
-- Structure for view `systemauthview`
--
DROP TABLE IF EXISTS `systemauthview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `systemauthview`  AS SELECT `systemcategory`.`id` AS `category_id`, `systemcategory`.`categoryName` AS `categoryName`, `systemcategory`.`categoryRole` AS `categoryRole`, `links`.`id` AS `id`, `links`.`linkName` AS `linkName` FROM (`systemcategory` left join `links` on(`systemcategory`.`id` = `links`.`categoryId`)) ORDER BY `systemcategory`.`categoryRole` ASC, `links`.`id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_links_category_id` (`categoryId`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `recycling_ficilities`
--
ALTER TABLE `recycling_ficilities`
  ADD PRIMARY KEY (`ficility_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `ficility_id` (`ficility_id`);

--
-- Indexes for table `systemcategory`
--
ALTER TABLE `systemcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ficility_id` (`ficility_id`),
  ADD KEY `waste_id` (`waste_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_authority`
--
ALTER TABLE `user_authority`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_action_link` (`action`);

--
-- Indexes for table `waste`
--
ALTER TABLE `waste`
  ADD PRIMARY KEY (`waste_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `systemcategory`
--
ALTER TABLE `systemcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_authority`
--
ALTER TABLE `user_authority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `waste`
--
ALTER TABLE `waste`
  MODIFY `waste_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `system_links_category_id` FOREIGN KEY (`categoryId`) REFERENCES `systemcategory` (`id`);

--
-- Constraints for table `recycling_ficilities`
--
ALTER TABLE `recycling_ficilities`
  ADD CONSTRAINT `recycling_ficilities_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`ficility_id`) REFERENCES `recycling_ficilities` (`ficility_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`ficility_id`) REFERENCES `recycling_ficilities` (`ficility_id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`waste_id`) REFERENCES `waste` (`waste_id`);

--
-- Constraints for table `user_authority`
--
ALTER TABLE `user_authority`
  ADD CONSTRAINT `system_action_link` FOREIGN KEY (`action`) REFERENCES `links` (`id`);

--
-- Constraints for table `waste`
--
ALTER TABLE `waste`
  ADD CONSTRAINT `waste_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `waste_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

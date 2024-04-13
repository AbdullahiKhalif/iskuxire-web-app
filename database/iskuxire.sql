-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 09:54 PM
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
(1, 'plastic', 'Ready', '2024-04-12'),
(2, 'Caag', 'Not Ready', '2024-04-14');

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
(1, 'Yaaqshiid', 'Taleex', 'Al-Baraka Hospital');

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
('RF_002', 'Khalfa', 'RF_002.png', 'Waa organization goal-kooda yahay in dhamaan wixii recyling ubaahan inay xaliyaan', 1, 'khalifa@gmail.com', 618390115, '2024-04-13 15:53:19');

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
('Rep001', 'USR001', '2024-04-13 17:08:41', 'Halkaan waa Kaxda hodan waxaa wada dhexdeeda yaalo qashin aad u tiro badan . please haka qaadaan dadka ku shaqo leh', 'Rep001.png'),
('Rep002', 'USR001', '2024-04-13 17:10:43', 'Halkaan waa Hodan hodan waxaa wada dhexdeeda yaalo qashin aad u tiro badan . please haka qaadaan dadka ku shaqo leh', 'Rep002.png');

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
(2, 'RF_002', 'Sabti, Isniin, Arbaco', '2024-04-15', '2025-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `ficility_id` varchar(15) DEFAULT NULL,
  `waste_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `transaction_method` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `ficility_id`, `waste_id`, `transaction_date`, `quantity`, `transaction_method`) VALUES
(1, 'USR001', 'RF_001', 1, NULL, 5, 'Evcplus'),
(3, 'USR002', 'RF_002', 1, NULL, 3, 'E-Dahab');

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
('USR001', 'khalifa', 'khalif115@gmail.com', 'admin', 618390120, 'Admin', 'USR001.png', 'Active'),
('USR002', 'Eng-Khalif', 'khalifa115@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 618390115, 'User', 'USR002.png', 'Active');

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
(1, 'Waa qashin yaaley wadda dhexdeeda, kaaso oo dadka ay kamari waayeen dariiqa', 1, 'Hodon', 10, 'USR001', '2024-04-13 14:22:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `waste`
--
ALTER TABLE `waste`
  MODIFY `waste_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `waste`
--
ALTER TABLE `waste`
  ADD CONSTRAINT `waste_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `waste_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

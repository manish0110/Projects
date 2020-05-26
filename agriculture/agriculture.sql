-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 02:55 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agriculture`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getcrop_fert` ()  SELECT * FROM crop_fert$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'Kshama', 'kshamatantri@gmail.com', 'c33e09253e528ce3753feb82965be9f2'),
(2, 'manu', 'manishr0110@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `crop_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`crop_id`, `name`) VALUES
(1, 'wheat'),
(2, 'corn'),
(3, 'Barley'),
(4, 'raggi'),
(6, 'Rice');

-- --------------------------------------------------------

--
-- Table structure for table `crop_fert`
--

CREATE TABLE `crop_fert` (
  `id` int(11) NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `fert_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop_fert`
--

INSERT INTO `crop_fert` (`id`, `crop_id`, `fert_id`) VALUES
(4, 4, 8);

--
-- Triggers `crop_fert`
--
DELIMITER $$
CREATE TRIGGER `insertlogs` AFTER INSERT ON `crop_fert` FOR EACH ROW INSERT INTO logs VALUES(null,new.crop_id,"inserted",now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `crop_pest`
--

CREATE TABLE `crop_pest` (
  `id` int(11) NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `pest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop_pest`
--

INSERT INTO `crop_pest` (`id`, `crop_id`, `pest_id`) VALUES
(4, 1, 1),
(8, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `crop_plough`
--

CREATE TABLE `crop_plough` (
  `id` int(11) NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `plough_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop_plough`
--

INSERT INTO `crop_plough` (`id`, `crop_id`, `plough_id`) VALUES
(2, 6, 4),
(3, 2, 1),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `fertilizer`
--

CREATE TABLE `fertilizer` (
  `fert_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fertilizer`
--

INSERT INTO `fertilizer` (`fert_id`, `name`) VALUES
(5, 'Urea'),
(6, 'Ammonium nitrogen fertilizer'),
(7, 'Nitrate nitrogen fertlizer'),
(8, 'Phosphorous fertlizer');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `crop_id` int(11) NOT NULL,
  `fert_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `cdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`crop_id`, `fert_id`, `action`, `cdate`) VALUES
(1, 6, 'inserted', '2019-12-04 11:21:08'),
(2, 2, 'inserted', '2019-12-04 11:21:59'),
(4, 4, 'inserted', '2019-12-04 12:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `pesticide`
--

CREATE TABLE `pesticide` (
  `pest_id` int(11) NOT NULL,
  `pest_name` varchar(32) DEFAULT NULL,
  `disease_name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesticide`
--

INSERT INTO `pesticide` (`pest_id`, `pest_name`, `disease_name`) VALUES
(1, 'Insecticide', 'Miscarriage'),
(2, 'Herbicides', 'Cancer, kidney problems'),
(3, 'Fungicides', 'Vascular');

-- --------------------------------------------------------

--
-- Table structure for table `plough`
--

CREATE TABLE `plough` (
  `plough_id` int(11) NOT NULL,
  `plough_name` varchar(32) DEFAULT NULL,
  `tool_name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plough`
--

INSERT INTO `plough` (`plough_id`, `plough_name`, `tool_name`) VALUES
(1, 'Contour ploughing', 'Trained machine operator'),
(2, 'No-till-farming', 'Broad forks  and rollers'),
(3, 'Traditional ploughing', 'oxen,horses'),
(4, 'Modern ploughing ', 'Tractors');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'abcd', 'a@a.com', 'e2fc714c4727ee9395f324cd2e7f331f'),
(2, 'manu', 'manishr0110@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'prashanth', 'manishr0110@gmail.com', '1d25b2c32c85bcbb39593036c05ae4af'),
(4, 'prashanth', 'manishr0110@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b'),
(5, 'shilpa', 'abc@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b'),
(6, 'shilpa', 'abc@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b'),
(7, 'ranimd', 'gangothrivijay@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'manishr0110', 'manishr0110@gmail.com', 'e2fc714c4727ee9395f324cd2e7f331f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop`
--
ALTER TABLE `crop`
  ADD PRIMARY KEY (`crop_id`);

--
-- Indexes for table `crop_fert`
--
ALTER TABLE `crop_fert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_id` (`crop_id`),
  ADD KEY `fert_id` (`fert_id`);

--
-- Indexes for table `crop_pest`
--
ALTER TABLE `crop_pest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_id` (`crop_id`),
  ADD KEY `pest_id` (`pest_id`);

--
-- Indexes for table `crop_plough`
--
ALTER TABLE `crop_plough`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_id` (`crop_id`),
  ADD KEY `plough_id` (`plough_id`);

--
-- Indexes for table `fertilizer`
--
ALTER TABLE `fertilizer`
  ADD PRIMARY KEY (`fert_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`crop_id`);

--
-- Indexes for table `pesticide`
--
ALTER TABLE `pesticide`
  ADD PRIMARY KEY (`pest_id`);

--
-- Indexes for table `plough`
--
ALTER TABLE `plough`
  ADD PRIMARY KEY (`plough_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crop`
--
ALTER TABLE `crop`
  MODIFY `crop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crop_fert`
--
ALTER TABLE `crop_fert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `crop_pest`
--
ALTER TABLE `crop_pest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `crop_plough`
--
ALTER TABLE `crop_plough`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fertilizer`
--
ALTER TABLE `fertilizer`
  MODIFY `fert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `crop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesticide`
--
ALTER TABLE `pesticide`
  MODIFY `pest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plough`
--
ALTER TABLE `plough`
  MODIFY `plough_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crop_fert`
--
ALTER TABLE `crop_fert`
  ADD CONSTRAINT `crop_fert_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`crop_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crop_fert_ibfk_2` FOREIGN KEY (`fert_id`) REFERENCES `fertilizer` (`fert_id`) ON DELETE CASCADE;

--
-- Constraints for table `crop_pest`
--
ALTER TABLE `crop_pest`
  ADD CONSTRAINT `crop_pest_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`crop_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crop_pest_ibfk_2` FOREIGN KEY (`pest_id`) REFERENCES `pesticide` (`pest_id`) ON DELETE CASCADE;

--
-- Constraints for table `crop_plough`
--
ALTER TABLE `crop_plough`
  ADD CONSTRAINT `crop_plough_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`crop_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crop_plough_ibfk_2` FOREIGN KEY (`plough_id`) REFERENCES `plough` (`plough_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

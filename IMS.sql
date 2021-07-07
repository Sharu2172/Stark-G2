-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2021 at 08:28 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
  time_zone = "+00:00";
  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;
--
  -- Database: `IMS`
  --
  -- --------------------------------------------------------
  --
  -- Table structure for table `stocks`
  --
  CREATE TABLE `stocks` (
    `pid` int(11) NOT NULL,
    `brand` varchar(100) NOT NULL,
    `pname` varchar(100) NOT NULL,
    `pimage` varchar(70) DEFAULT NULL,
    `Description` varchar(225) DEFAULT NULL,
    `no` int(11) NOT NULL DEFAULT 0,
    `cost` float NOT NULL DEFAULT 0
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Dumping data for table `stocks`
  --
INSERT INTO
  `stocks` (
    `pid`,
    `brand`,
    `pname`,
    `pimage`,
    `Description`,
    `no`,
    `cost`
  )
VALUES
  (
    1,
    'Xiaomi',
    'Moto 3S',
    '1623932486.jpg',
    'Mobile device made from best quality products.You can see all the product list.Here there is no data.',
    35,
    6200
  ),
  (
    2,
    'Dell',
    'Dell Latitude E6410',
    '1623932567.jpg',
    'Light Weight Laptop with best Quality Parts.',
    12,
    16999
  ),
  (
    3,
    'Xiaomi',
    'Redmi 3S',
    '1623934202.jpg',
    'gdf',
    25,
    5099
  );
-- --------------------------------------------------------
  --
  -- Table structure for table `transaction`
  --
  CREATE TABLE `transaction` (
    `id` int(11) NOT NULL,
    `uid` varchar(70) NOT NULL,
    `uname` varchar(40) NOT NULL,
    `pid` int(11) NOT NULL,
    `pname` varchar(30) NOT NULL,
    `quantity` int(11) NOT NULL,
    `total` int(11) NOT NULL,
    `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
  --
  -- Table structure for table `user`
  --
  CREATE TABLE `user` (
    `uid` varchar(70) NOT NULL,
    `uname` varchar(40) NOT NULL,
    `dob` date NOT NULL,
    `gender` varchar(30) NOT NULL,
    `ph_no` varchar(15) NOT NULL,
    `email` varchar(70) NOT NULL,
    `address` varchar(150) NOT NULL,
    `image` varchar(70) DEFAULT NULL,
    `login_time` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Indexes for dumped tables
  --
  --
  -- Indexes for table `stocks`
  --
ALTER TABLE
  `stocks`
ADD
  PRIMARY KEY (`pid`),
ADD
  UNIQUE KEY `pimage` (`pimage`);
--
  -- Indexes for table `transaction`
  --
ALTER TABLE
  `transaction`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `uname` (`uname`);
--
  -- Indexes for table `user`
  --
ALTER TABLE
  `user`
ADD
  PRIMARY KEY (`uid`),
ADD
  UNIQUE KEY `uname` (`uname`),
ADD
  UNIQUE KEY `email` (`email`);
--
  -- AUTO_INCREMENT for dumped tables
  --
  --
  -- AUTO_INCREMENT for table `stocks`
  --
ALTER TABLE
  `stocks`
MODIFY
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
  -- Constraints for dumped tables
  --
  --
  -- Constraints for table `transaction`
  --
ALTER TABLE
  `transaction`
ADD
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`uname`) REFERENCES `user` (`uname`) ON UPDATE CASCADE;
COMMIT;
  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
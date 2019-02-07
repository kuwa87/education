-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2019 at 07:10 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginID` int(11) NOT NULL,
  `emailAdress` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginID`, `emailAdress`, `password`, `status`) VALUES
(1, 'SNOOPY', 'SNOOPY', '1'),
(2, 'Kitty', 'Kitty', '1'),
(3, 'snowman', 'snowman', '1'),
(4, 'snowman', 'snowman', '1'),
(5, 'BIRD', 'BIRD', '1'),
(6, 'DOG', 'DOG', '1'),
(7, 'LUCY', 'LUCY', '1'),
(8, 'LUCY', 'LUCY', '1'),
(9, 'SNOOPY', 'SNOOPY', '1'),
(10, 'snowmansss', 'snowmansss', '1'),
(11, 'Woodstockss', 'Woodstockss', '1'),
(12, 'SNOOPYbbbvv', 'SNOOPYbbbvv', '1'),
(13, 'k.kuwamori8877@gmail', 'SNOOPY', '1'),
(14, 'k.kuwamori8877@gmail', 'SNOOPY', '1'),
(15, 'k.kuwamori8877@gmail', 'SNOOPY', '1'),
(16, 'Woodstock', 'SNOOPY', '1'),
(17, 'Kitty123', 'Woodstock321', '1'),
(18, 'Kitty123d', 'Woodstock321d', '1'),
(19, 'SNOOPYcc', 'SNOOPYcc', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `studentName` varchar(50) NOT NULL,
  `studentAdress` varchar(50) NOT NULL,
  `studentBirthdate` date NOT NULL,
  `studentBiography` varchar(200) NOT NULL,
  `loginID` int(11) NOT NULL,
  `studentPicture` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `studentName`, `studentAdress`, `studentBirthdate`, `studentBiography`, `loginID`, `studentPicture`) VALUES
(1, 'SNOOPY', 'SNOOPY', '2019-01-07', 'SNOOPY', 1, 'SNOOPY'),
(2, 'Woodstock', 'Woodstock', '0000-00-00', '', 0, 'Woodstock'),
(3, 'Woodstock', 'Woodstock', '0000-00-00', '', 0, 'Woodstock'),
(4, 'LINUS', 'LINUS', '0000-00-00', '', 0, 'LINUS'),
(5, 'Kitty', 'Kitty', '0000-00-00', '', 0, 'Kitty'),
(6, 'snowman', 'snowman', '0000-00-00', '', 0, 'snowman'),
(7, 'snowman', 'snowman', '0000-00-00', '', 0, 'snowman'),
(8, 'BIRD', 'BIRD', '0000-00-00', '', 0, 'BIRD'),
(9, 'DOG', 'DOG', '0000-00-00', '', 0, 'DOG'),
(10, 'LUCY', 'LINUS', '2019-02-02', '', 0, 'LUCY'),
(11, 'LUCY', 'LINUS', '2019-02-02', '', 0, 'LUCY'),
(12, 'SNOOPY', 'SNOOPY', '0000-00-00', '', 0, 'SNOOPY'),
(13, 'SNOOPYbbb', 'SNOOPYbbb', '0000-00-00', '', 0, 'user_images/person01'),
(14, 'SNOOPYbbb', 'SNOOPYbbb', '0000-00-00', '', 0, 'user_images/person01'),
(15, 'snowmanc', 'snowmanc', '0000-00-00', '', 0, 'user_images/person01'),
(16, 'snowmanc', 'snowmanc', '0000-00-00', '', 0, 'user_images/person01'),
(17, 'CARRY', 'CARRY', '0000-00-00', '', 0, 'user_images/person01'),
(18, 'snowmanx', 'snowmanx', '0000-00-00', '', 0, 'user_images/person01'),
(19, 'SNOOPYcg', '3-1-15', '0000-00-00', '', 0, 'user_images/img01.jp'),
(20, 'Woodstock123', '123', '0000-00-00', '', 17, 'user_images/img01.jp'),
(21, 'Woodstock123ddd', '123d', '0000-00-00', '', 18, 'user_images/img01.jp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `loginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

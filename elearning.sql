-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2019 at 09:42 AM
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
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(11) NOT NULL,
  `courseName` varchar(50) NOT NULL,
  `courseDetails` varchar(50) NOT NULL,
  `coursePrice` int(50) NOT NULL,
  `coursePicture` varchar(100) NOT NULL,
  `loginID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseName`, `courseDetails`, `coursePrice`, `coursePicture`, `loginID`) VALUES
(1, 'Design', 'web and DTP', 20003, 'course_images/30a9bd3b6c01c4939c8ee6ba0690ed02_t.jpg', 1),
(2, 'Front End', 'development', 200, 'course_images/15d0dcde2feb2af4fea63f3ee6660a2f_t.jpg', 1),
(3, 'English', 'English', 100, 'course_images/73838e389518985b6dd7c9386fef0483_t.jpg', 2),
(8, 'Back End', 'PHP: Hypertext Preprocessor (or simply PHP)', 10, 'course_images/08dee51911218dcd9c043e7946358c40_t.jpg', 1),
(9, 'gdfdfgfd', 'gdfdfgfd', 1003, 'course_images/14908c39f57184c92b9d2c25df1fb915_t.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `studentID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `rating`, `message`, `studentID`, `courseID`, `dateAdded`) VALUES
(1, 5, 'This course was amazing! I will buy it again.', 3, 8, '2019-02-19 07:05:41'),
(2, 5, 'I think it is the best', 3, 3, '2019-02-19 07:55:40'),
(3, 3, 'hehe', 39, 8, '2019-02-19 08:55:37'),
(4, 3, 'It is OK, but not so good.', 40, 2, '2019-02-22 07:53:41'),
(5, 2, 'I learned only a little.', 40, 1, '2019-02-22 07:54:35'),
(6, 4, 'This is good.', 40, 3, '2019-02-22 08:42:50');

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
(1, 'Admin', 'Admin', 'a'),
(2, 'SNOOPY', 'SNOOPY', 'a'),
(3, 'Woodstock', 'Woodstock', 'u'),
(57, 'Kitty', 'Kitty', 'u'),
(58, 'snowman', 'snowman', 'u'),
(59, 'Lucy', 'Lucy', 'u');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `materialID` int(11) NOT NULL,
  `materialName` varchar(50) NOT NULL,
  `materialDetails` varchar(300) NOT NULL,
  `materialImage` varchar(100) NOT NULL,
  `materialContent` varchar(100) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`materialID`, `materialName`, `materialDetails`, `materialImage`, `materialContent`, `courseID`) VALUES
(1, 'Layout', 'Layout', '../material_Images/22ca4b5ef07992fe8bf3b30a744d38f6.jpg', '../material_contents/069def7379e1bfbde435391e43c9cc08.jpg', 1),
(2, 'OOP Basic5', 'OOP Basic55', '../material_Images/08ba628d2c22f722b776dc2513729da7.jpg', '../material_contents/8e558b22a243932bbc0aa0a0e348e586.jpg', 2),
(3, 'Speaking', 'Speaking', '../material_images/works01.png', '../material_contents/works01.png', 3),
(4, 'Design Basic8', 'Design Basic8', '../material_images/shop.jpg', '../material_contents/shop.jpg', 1),
(5, 'Design Basic84', 'Design Basic84', '../material_images/pc.jpg', '../material_contents/pc.jpg', 1),
(6, 'listening', 'listening', '../material_images/9dafb5f6de62d18b4fb4350c45c25dc2_t.jpg', '../material_contents/abdeb0be75638263e37e55617c32847f_t.jpg', 3),
(7, 'reading', 'reading', '../material_images/8a64918db81f6fe32ed7f1055d083d36_t.jpg', '../material_contents/9dafb5f6de62d18b4fb4350c45c25dc2_t.jpg', 3),
(8, 'Database', 'Database', '../material_images/a8cda23425e592504484de452bbad5b4_t.jpg', '../material_contents/1d9b09050b9886f20284767c54b15424_t.jpg', 2),
(9, 'Design Basic67', 'Design Basic867', '../material_images/kanban.jpg', '../material_contents/dn.jpg', 1),
(11, 'new material', 'new material', '../material_images/blend.jpg', '../material_contents/cc6e3954dc52c82560061eeb6f149d48.jpg', 1),
(12, 'Test for new inserting', 'Test for new inserting', '../material_images/419ac109041913e17907b537ea27bfc1.jpg', '../material_contents/8f2db17de41ed88574c02ba43f8eff4c.jpg', 2),
(13, 'Design Basic82', 'Design Basic82', '../material_Images/3a9822cda5ea097849711034f62c188f_t.jpg', '../material_contents/08dee51911218dcd9c043e7946358c40_t.jpg', 1),
(14, 'new', 'new thing', '../material_images/fad06b2fef6c1f016df498f7868f6fcd_t.jpg', '../material_contents/CYBI 2 - 01 Its No Wonder.pdf', 1);

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
  `studentPicture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `studentName`, `studentAdress`, `studentBirthdate`, `studentBiography`, `loginID`, `studentPicture`) VALUES
(1, 'Admin', 'Admin', '0000-00-00', 'born in Japan', 1, 'user_images/09d3b826b52fde5f53c970fad04e8af8_t.jpg'),
(2, 'SNOOPY', 'SNOOPY', '0000-00-00', '', 2, 'user_images/pc.jpg'),
(3, 'Woodstock', 'Woodstock', '2000-01-01', 'born in Japan and moved to Cebu', 3, 'user_images/pc.jpg'),
(39, 'Kitty', 'Kitty', '0000-00-00', '', 57, 'user_images/22ca4b5ef07992fe8bf3b30a744d38f6.jpg'),
(40, 'snowman', 'snowman', '0000-00-00', '', 58, 'user_images/069def7379e1bfbde435391e43c9cc08.jpg'),
(41, 'Lucy', 'Lucy', '0000-00-00', '', 59, 'user_images/14908c39f57184c92b9d2c25df1fb915_t.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usercourse`
--

CREATE TABLE `usercourse` (
  `ucID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usercourse`
--

INSERT INTO `usercourse` (`ucID`, `studentID`, `courseID`, `status`) VALUES
(65, 3, 2, 'studying'),
(67, 3, 3, 'finished'),
(70, 3, 1, 'studying'),
(72, 40, 2, 'finished'),
(78, 39, 2, 'studying'),
(79, 39, 8, 'studying'),
(82, 40, 3, 'studying'),
(83, 40, 1, 'studying');

-- --------------------------------------------------------

--
-- Table structure for table `usermaterial`
--

CREATE TABLE `usermaterial` (
  `umID` int(11) NOT NULL,
  `ucID` int(11) NOT NULL,
  `materialID` int(11) NOT NULL,
  `mt_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermaterial`
--

INSERT INTO `usermaterial` (`umID`, `ucID`, `materialID`, `mt_status`) VALUES
(70, 65, 2, 'finished'),
(71, 65, 8, 'finished'),
(76, 67, 3, 'finished'),
(77, 67, 6, 'finished'),
(78, 67, 7, 'finished'),
(84, 70, 1, 'finished'),
(85, 70, 4, 'finished'),
(86, 70, 5, 'finished'),
(87, 70, 9, 'finished'),
(88, 70, 11, 'studying'),
(91, 72, 2, 'finished'),
(92, 72, 8, 'finished'),
(109, 65, 12, 'studying'),
(110, 78, 2, 'studying'),
(111, 78, 8, 'studying'),
(112, 78, 12, 'studying'),
(120, 82, 3, 'studying'),
(121, 82, 6, 'studying'),
(122, 82, 7, 'studying'),
(123, 83, 1, 'finished'),
(124, 83, 4, 'studying'),
(125, 83, 5, 'studying'),
(126, 83, 9, 'studying'),
(127, 83, 11, 'studying'),
(128, 83, 13, 'studying'),
(129, 83, 14, 'studying'),
(130, 72, 12, 'finished');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`materialID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `usercourse`
--
ALTER TABLE `usercourse`
  ADD PRIMARY KEY (`ucID`);

--
-- Indexes for table `usermaterial`
--
ALTER TABLE `usermaterial`
  ADD PRIMARY KEY (`umID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `loginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `usercourse`
--
ALTER TABLE `usercourse`
  MODIFY `ucID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `usermaterial`
--
ALTER TABLE `usermaterial`
  MODIFY `umID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

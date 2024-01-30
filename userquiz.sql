-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 05:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `aid` int(11) NOT NULL,
  `answer` text NOT NULL,
  `ans_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`aid`, `answer`, `ans_id`) VALUES
(1, 'var', 1),
(2, '_var', 1),
(3, 'VAR', 1),
(4, '1var', 1),
(5, 'Hypertext markup language.', 2),
(6, 'Text hyper language', 2),
(7, 'Markup Hypertext language', 2),
(8, 'Markup Hypertext language', 2),
(10, 'Stylesheet cascade', 3),
(11, 'Stylesheet language', 3),
(12, 'Cascading stylesheet', 3),
(13, 'Styles', 3),
(14, '//', 4),
(15, '/*', 4),
(16, '\'\'\'', 4),
(17, '#', 4),
(18, 'open()', 5),
(19, ' read()', 5),
(20, 'write()', 5),
(21, 'close()', 5),
(22, '(1, 2, 3)', 6),
(23, '(1, 4, 3)', 6),
(24, '(4, 2, 3)', 6),
(25, 'Error', 6),
(30, 'int', 8),
(31, ' list', 8),
(32, ' string', 8),
(33, 'array', 8),
(34, '{\'a\': 1, \'c\': 3}', 9),
(35, '{\'a\': 1, \'b\': 2, \'c\': 3}', 9),
(36, '{\'b\': 2}', 9),
(37, 'Error', 9),
(43, 'define', 10),
(44, 'function', 10),
(45, 'def', 10),
(46, 'func', 10),
(432, 'Node JS', 128),
(433, 'Ruby', 128),
(434, 'Pearl', 128),
(435, 'Python', 128),
(440, ' Server-side scripting', 130),
(441, 'Styling web pages', 130),
(442, 'Adding interactivity to web pages', 130),
(443, 'Database management', 130),
(444, 'Number', 131),
(445, 'String', 131),
(446, 'Boolean', 131),
(447, 'Character', 131),
(448, ' int', 132),
(449, 'string', 132),
(450, 'float', 132),
(451, 'list', 132),
(452, ' Using the + operator', 133),
(453, 'Using the . operator', 133),
(454, 'Using the & operator', 133),
(455, 'Using the | operator', 133),
(456, 'To retrieve the first HTML element with a specified class.', 134),
(457, 'To retrieve the first HTML element with a specified ID.', 134),
(458, ' To retrieve all HTML elements with a specified tag name.', 134),
(459, 'To retrieve all HTML elements with a specified attribute.', 134);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(50) NOT NULL,
  `question` text NOT NULL,
  `ans_id` int(50) NOT NULL,
  `correct` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `question`, `ans_id`, `correct`) VALUES
(1, 'What is the output of the following code snippet?\r\nmy_tuple = (1, 2, 3)\r\nmy_tuple[1] = 4\r\nprint(my_tuple)\r\n6', 23, 0),
(8, 'Which of the following is not a built-in Python data type?', 33, 0),
(9, 'What will be the output of the following code snippet?\r\nmy_dict = {\'a\': 1, \'b\': 2, \'c\': 3}\r\ndel my_dict[\'b\']\r\nprint(my_dict)', 34, 0),
(10, 'Which keyword is used to define a function in Python?', 45, 0),
(128, 'which language is more suitable in data extraction?', 50, 4),
(130, 'What is JavaScript primarily used for?', 438, 3),
(131, 'Which of the following is NOT a valid data type in JavaScript?', 447, 4),
(132, 'Which data type is used to store a sequence of characters in Python?', 449, 2),
(133, 'How do you concatenate two strings in PHP?', 453, 2),
(134, 'What is the purpose of the querySelector method in JavaScript?', 457, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `totalque` int(11) NOT NULL,
  `totalans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

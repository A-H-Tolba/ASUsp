-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2018 at 06:09 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asusp`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `user_table_url` varchar(255) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `pic`, `user_table_url`) VALUES
(0, 'admin', 'admin', 'admin@m.com', 'admin', 'default.png', '-'),
(18, 'new', 'user', 'newuser@yahoo.com', 'newpassword', 'default.png', '<a href=\"http://localhost/ASUsp/Welcome/user_table?tb=newuser18\" target=\"_blank\">user\'s data</a>'),
(19, 'Ahmed', 'Hani', 'Ahmed_hani@yahoo.com', '123456789', '73510824.jpg', '<a href=\"http://localhost/ASUsp/Welcome/user_table?tb=ahmedhani19\" target=\"_blank\">user\'s data</a>'),
(26, 'John', 'Doe', 'john.doe@yahoo.com', 'jd123', 'default.png', '<a href=\"http://localhost/ASUsp/Welcome/user_table?tb=johndoe26\" target=\"_blank\">user\'s data</a>'),
(27, 'Jane', 'Doe', 'jane.doe@yahoo.com', 'jd456', 'default.png', '<a href=\"http://localhost/ASUsp/Welcome/user_table?tb=janedoe27\" target=\"_blank\">user\'s data</a>'),
(29, 'John', 'Morrison', 'j_hennigan@wwe.com', 'starshippain', 'default.png', '<a href=\"http://localhost/ASUsp/Welcome/user_table?tb=JohnMorrison29\" target=\"_blank\">user\'s data</a>'),
(30, 'user', 'name', 'user.name@yahoo.com', 'userpassword', 'default.png', '<a href=\"http://localhost/ASUsp/Welcome/user_table?tb=username30\" target=\"_blank\">user\'s data</a>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

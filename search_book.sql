-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2018 at 06:16 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `search_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publishedDate` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `ISBN` varchar(255) DEFAULT NULL,
  `previewLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`id`, `title`, `authors`, `publisher`, `publishedDate`, `description`, `categories`, `ISBN`, `previewLink`) VALUES
(6, 'Violence and the Brain ', 'Vernon H. Mark ; ', '', '1970', '', '', '', 'http://books.google.com/books?id=x5I4YT_njaUC&dq=inauthor:mark&hl=&cd=1&source=gbs_api'),
(7, 'The White Book Of-- Big Data', 'Ian Mitchell; Andy Fuller; Mark Locke; Mark Wilson; Fujitsu Services Limited; ', '', '2012', '', '', '0956821626', 'http://books.google.com/books?id=r1HlmgEACAAJ&dq=inauthor:mark&hl=&cd=3&source=gbs_api'),
(8, 'Purgatory', '', 'Indiana University Press', '2000', '', '', '0253336511', 'http://books.google.com/books?id=DvxKeQ0Zw7MC&printsec=frontcover&dq=inauthor:mark&hl=&cd=4&source=gbs_api'),
(9, 'Headquarters man-size', 'Mark Pimlott; Kenneth Hayes; Man-Size Collective; ', '', '1997', '', 'Art; ', 'UVA:X006029151', 'http://books.google.com/books?id=iQpNAAAAYAAJ&dq=inauthor:mark&hl=&cd=5&source=gbs_api'),
(10, 'Punch', 'Mark Lemon; Henry Mayhew; Tom Taylor; Shirley Brooks; Sir Francis Cowley Burnand; Sir Owen Seaman; ', '', '1905', '', 'Periodicals; ', 'UCSC:32106019661625', 'http://books.google.com/books?id=iwcIAQAAIAAJ&printsec=frontcover&dq=inauthor:mark&hl=&cd=7&source=gbs_api');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

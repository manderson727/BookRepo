-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2017 at 12:29 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test626`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` char(13) NOT NULL,
  `Author` char(50) DEFAULT NULL,
  `Title` char(100) DEFAULT NULL,
  `Year` char(4) DEFAULT NULL,
  `Publisher` char(100) DEFAULT NULL,
  `Price` float(4,2) DEFAULT NULL,
  `Image` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `Author`, `Title`, `Year`, `Publisher`, `Price`, `Image`) VALUES
(' 0735624003', 'Russo', 'Programming LINQ', '2008', 'Microsoft Press', 34.00, 'linq.jpg'),
('0126914117', 'Tittel', 'Computer Telephony', '1996', 'Morgan Kaufmann Pub', 68.00, 'computertelephony.jpg'),
('0262521776', 'Benedikt', 'Cyberspace: First Steps', '1992', 'The MIT Press', 13.00, 'cyberspace.jpg'),
('0534204961', 'Decker', 'The Object Concept', '1995', 'Course Technology', 9.00, 'objectconcept.jpg'),
('0735621764', 'Esposito', 'Programming Microsoft ASP.NET 2.0', '2005', 'Microsoft Press', 56.00, 'aspnet20.jpg'),
('1101946598', 'Tegmark', 'Life 3.0: Being Human in the Age of Artificial Int', '2017', 'Knopf', 31.00, 'life3.jpg'),
('12312', 'Author', 'Title', '1981', 'Publisher', 99.99, 'artemis.jpg'),
('1281828', 'Author4', 'TItle4', '1983', 'Publisher4', 77.88, 'artemis.jpg'),
('1293192', 'Author2', 'Title2', '1982', 'Publisher2', 99.99, 'artemis.jpg'),
('143025050X', 'Lee', 'Pro Objective-C', '2013', 'Apress 2013', 47.00, 'objectivec.jpg'),
('1593271441', 'Erickson', 'Hacking: The Art of Exploitation 2nd Edition', '2008', 'No Starch Press', 10.00, 'hackingart.jpg'),
('198739834', 'Bostrom', 'Superintelligence: Paths/Dangers/Strategies', '2016', 'Oxford University Press', 25.00, 'superintelligence.jpg'),
('2727272', 'Author3', 'Title3', '1981', 'Publisher3', 99.99, 'artemis.jpg'),
('307887448', 'Cline', 'Ready Player One: A Novel', '2012', 'Broadway Books', 50.00, 'readyplayerone.jpg'),
('375815309', 'Pullman', 'The Book of Dust', '2017', 'Knopf', 27.00, 'bookofdust.jpg'),
('553448129', 'Weir', 'Artemis: A Novel', '2017', 'Crown', 14.00, 'artemis.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(10) UNSIGNED NOT NULL,
  `Name` char(50) NOT NULL,
  `Address` char(100) NOT NULL,
  `City` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Address`, `City`) VALUES
(1, 'Drew Anderson', '123 Main St.', 'Philadelphia'),
(2, 'Victor Arano', '234 Main St.', 'Philadelphia'),
(3, 'Zac Curtis', '345 Main St.', 'Philadelphia'),
(4, 'Seranthony Dominguez', '456 Main St.', 'Philadelphia'),
(5, 'Zach Eflin', '567 Main St.', 'Philadelphia'),
(6, 'Jerad Eickhoff', '678 Main St.', 'Philadelphia'),
(7, 'Luis Garcia', '789 Main St.', 'Philadelphia'),
(8, 'Franklyn Kilome', '890 Main St.', 'Philadelphia'),
(9, 'Mark Leiter', '900 Main St.', 'Philadelphia'),
(10, 'Ben Lively', '012 Main St.', 'Philadelphia'),
(11, 'Hoby Milner', '001 Main St.', 'Philadelphia'),
(12, 'Adam Morgan', '010 Main St.', 'Philadelphia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

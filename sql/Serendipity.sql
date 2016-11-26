-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2016 at 04:00 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serendipity`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CatID` int(11) NOT NULL,
  `CatDesc` varchar(150) NOT NULL,
  `colour` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CatID`, `CatDesc`, `colour`) VALUES
(1, 'Active', 'magenta'),
(2, 'Food and Drink', 'gold'),
(3, 'Transport', 'yellow'),
(4, 'Lodging', 'deepskyblue'),
(6, 'Leisure', 'springgreen');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `OID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `OfferName` varchar(250) NOT NULL,
  `OfferDesc` varchar(400) NOT NULL,
  `StartDuration` datetime NOT NULL,
  `EndDuration` datetime NOT NULL,
  `CatID` int(11) NOT NULL,
  `OfferAddress` varchar(1024) NOT NULL,
  `OfferLat` float(10,7) NOT NULL,
  `OfferLong` float(10,7) NOT NULL,
  `Status` enum('open','closed') NOT NULL DEFAULT 'open',
  `OfferLimit` int(11) NOT NULL,
  `ImageURL` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`OID`, `UID`, `OfferName`, `OfferDesc`, `StartDuration`, `EndDuration`, `CatID`, `OfferAddress`, `OfferLat`, `OfferLong`, `Status`, `OfferLimit`, `ImageURL`) VALUES
(1, 3, 'Dinner at Ribs and Rumps.', 'Help! Friend bailed and have free ticket for dinner and need someone to come along with me.', '2016-11-28 18:30:00', '2016-11-28 20:30:00', 2, '', -27.4527626, 153.0359802, 'open', 1, 'https://media-cdn.tripadvisor.com/media/photo-s/03/d8/25/10/ribs-and-rumps.jpg'),
(2, 1, 'Need Cycling companions', 'Usually cycle Sunday mornings through New Farm, starting at Teneriffe Park. Want to join me?', '2016-11-30 09:00:00', '2016-12-12 10:00:00', 1, '', -27.4572811, 153.0444336, 'open', 3, 'http://www.weekendnotes.com/images/teneriffe-park.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `RID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `OID` int(11) NOT NULL,
  `Rate` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RID` int(11) NOT NULL,
  `OID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `Status` enum('accepted','rejected','waiting') NOT NULL DEFAULT 'waiting',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `UserName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UID`, `email`, `password`, `UserName`) VALUES
(1, 'dheesigns@gmail.com', 'password', 'haidee'),
(2, 'ruqaiya.girach@yahoo.com.au', 'password', 'ruqaiya'),
(3, 'jordanfischer97@gmail.com', 'password', 'jordan'),
(4, 'geoffrey.lai1@gmail.com', 'password', 'geoffrey');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CatID`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`OID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `OID` (`OID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `OID` (`OID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `OID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `Offer_ibfk_1` FOREIGN KEY (`CatID`) REFERENCES `category` (`CatID`),
  ADD CONSTRAINT `Offer_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `user` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `Rating_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `user` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Rating_ibfk_2` FOREIGN KEY (`OID`) REFERENCES `offer` (`OID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `Request_ibfk_1` FOREIGN KEY (`OID`) REFERENCES `offer` (`OID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Request_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `user` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2024 at 03:09 AM
-- Server version: 10.11.8-MariaDB
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `idz` int(11) NOT NULL,
  `un` varchar(20) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `emails` varchar(255) NOT NULL COMMENT 'emails to send orders',
  `az` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`idz`, `un`, `pw`, `emails`, `az`) VALUES
(1, 'admin', '$2y$10$vA4VIb46re9mlbETA9Qv4.FvtVZMT.R4Sd8OL6fP/.VN5DX4v7oGW', 'cellers.wine@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `scid` int(50) NOT NULL DEFAULT 0,
  `ssid` int(11) NOT NULL DEFAULT 0,
  `cn` varchar(100) NOT NULL COMMENT 'cat name',
  `cd` varchar(550) NOT NULL COMMENT 'cat desc',
  `od` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'display order on menu',
  `iz` varchar(50) NOT NULL COMMENT 'image',
  `mn` tinyint(4) NOT NULL COMMENT 'display on menu 0-no,1-yes',
  `mt` varchar(100) NOT NULL COMMENT 'meta title',
  `md` varchar(255) NOT NULL COMMENT 'meta desc',
  `uz` varchar(120) NOT NULL COMMENT 'pagename',
  `az` tinyint(4) NOT NULL COMMENT '0-not,1-active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `scid`, `ssid`, `cn`, `cd`, `od`, `iz`, `mn`, `mt`, `md`, `uz`, `az`) VALUES
(35, 1, -1, 'Children', '', 0, '', 0, '', '', 'children', 1),
(32, 0, 0, 'Belts', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium?', 0, '20240608050248497868516.jpg', 0, '', '', 'belts', 1),
(33, 1, -1, 'Ladies', '', 0, '', 0, '', '', 'ladies', 1),
(34, 1, -1, 'Gents', '', 0, '', 0, '', '', 'gents', 1),
(30, 0, 0, 'Wallets', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium? ', 0, '202406080445081952735977.jpg', 0, '', '', 'wallets', 1),
(31, 0, 0, 'Cups & Hats', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium? ', 0, '202406080456392059662737.jpg', 0, '', '', 'ladies-gents-children-cups-hats', 1),
(29, 0, 0, 'Socks', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium? ', 0, '202406080440401336306217.jpg', 0, '', '', 'socks', 1),
(28, 0, 0, 'Bags', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium?', 0, '20240608043003104760945.jpg', 0, '', '', 'bags', 1),
(1, 0, 0, 'Shoes', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium?', 50, '20240608042526900772681.png', 0, '', '', 'shoes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `idz` int(11) NOT NULL,
  `na` varchar(100) NOT NULL COMMENT 'name',
  `cd` varchar(100) DEFAULT NULL COMMENT 'code name',
  `ca` int(11) NOT NULL COMMENT 'cat id',
  `uz` varchar(120) DEFAULT NULL COMMENT 'page name',
  `iz` varchar(50) DEFAULT NULL COMMENT 'image',
  `ab` varchar(550) DEFAULT NULL COMMENT 'description',
  `pr` decimal(6,2) DEFAULT NULL COMMENT 'price',
  `vo` varchar(10) DEFAULT NULL COMMENT 'volume',
  `pe` varchar(10) DEFAULT NULL COMMENT 'percentage',
  `co` varchar(120) DEFAULT NULL COMMENT 'country/Speciality',
  `br` varchar(120) DEFAULT NULL COMMENT 'brand',
  `dt` date NOT NULL COMMENT 'datetime',
  `mt` varchar(100) DEFAULT NULL COMMENT 'meta title',
  `md` varchar(255) DEFAULT NULL COMMENT 'meta desc',
  `az` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-no,1-active,2-out of stock'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `iid` int(11) NOT NULL,
  `ina` varchar(100) NOT NULL COMMENT 'item name',
  `ipr` decimal(6,2) NOT NULL COMMENT 'item price',
  `iqt` smallint(6) NOT NULL COMMENT 'quantity'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `oid`, `iid`, `ina`, `ipr`, `iqt`) VALUES
(50, 43, 45, 'Ciroc', 31.99, 1),
(51, 44, 55, 'Billecart-Salmon Blanc de Blanc', 69.99, 1),
(52, 45, 51, 'Chartreuse', 39.99, 1),
(53, 46, 50, 'St-Germain', 27.99, 1),
(54, 47, 1, 'Mendel Malbec', 23.99, 1),
(55, 48, 63, 'Faustino V', 10.99, 19),
(56, 49, 50, 'St-Germain', 27.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'customer',
  `bfn` varchar(100) NOT NULL,
  `bln` varchar(100) NOT NULL,
  `bad1` varchar(100) NOT NULL,
  `bad2` varchar(100) DEFAULT NULL,
  `bad3` varchar(100) DEFAULT NULL,
  `bpz` varchar(15) NOT NULL,
  `bzp` varchar(10) NOT NULL,
  `bct` varchar(120) NOT NULL,
  `bst` tinyint(4) NOT NULL,
  `bem` varchar(120) NOT NULL,
  `sfn` varchar(100) NOT NULL,
  `sln` varchar(100) NOT NULL,
  `sad1` varchar(100) NOT NULL,
  `sad2` varchar(100) DEFAULT NULL,
  `sad3` varchar(100) DEFAULT NULL,
  `spz` varchar(15) NOT NULL,
  `szp` varchar(10) NOT NULL,
  `sct` varchar(120) NOT NULL,
  `sst` tinyint(4) NOT NULL,
  `sem` varchar(120) NOT NULL,
  `dt` date NOT NULL,
  `tz` time NOT NULL,
  `tpr` decimal(6,2) NOT NULL COMMENT 'total price',
  `pay` tinyint(4) NOT NULL DEFAULT 0,
  `code` varchar(100) DEFAULT NULL COMMENT 'order code'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `uid`, `bfn`, `bln`, `bad1`, `bad2`, `bad3`, `bpz`, `bzp`, `bct`, `bst`, `bem`, `sfn`, `sln`, `sad1`, `sad2`, `sad3`, `spz`, `szp`, `sct`, `sst`, `sem`, `dt`, `tz`, `tpr`, `pay`, `code`) VALUES
(43, 1, 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', '2020-01-21', '21:10:54', 31.99, 1, '073e78a6-8f98-477d-bea3-fadf8f76dfef'),
(44, 1, 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', '2020-01-21', '21:11:36', 69.99, 1, 'efed06c6-b80c-41d9-a795-b50f0884dee0'),
(45, 1, 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', '2020-01-21', '21:23:29', 39.99, 2, 'cf5598d5-f3c3-4927-bab9-47bce82d6c55'),
(46, 4, 'Sukee', 'Cellers', '179 Western Road ', '', '', '07575512556', 'CM12 9JD', 'Billericay', 16, 'celele4rs@gmail.com', 'Sukee', 'Cellers', '179 Western Road ', '', '', '07575512556', 'CM12 9JD', 'Billericay', 16, 'celele4rs@gmail.com', '2020-02-19', '17:14:48', 27.99, 1, '22de1e82-97e6-46ee-8aed-0ad3ec4af81c'),
(47, 4, 'Sukee', 'Cellers', '179 Western Road ', '', '', '07575512556', 'CM12 9JD', 'Billericay', 16, 'celele4rs@gmail.com', 'Sukee', 'Cellers', '179 Western Road ', '', '', '07575512556', 'CM12 9JD', 'Billericay', 16, 'celele4rs@gmail.com', '2020-02-27', '15:18:22', 23.99, 1, 'd2e15950-3a59-4431-a860-7a0f2b45acf3'),
(48, 4, 'Sukee', 'Cellers', '179 Western Road ', '', '', '07575512556', 'CM12 9JD', 'Billericay', 16, 'celele4rs@gmail.com', 'Sukee', 'Cellers', '179 Western Road ', '', '', '07575512556', 'CM12 9JD', 'Billericay', 16, 'celele4rs@gmail.com', '2020-02-27', '15:27:53', 208.81, 1, 'f51c4221-d5ef-4aa4-a3df-35ca5af8a0d6'),
(49, 1, 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', 'Michel', 'Jayasooriya', '207/b', 'Siyane rd', 'Gampaha', ' 94713530250', '2541', 'Dest', 107, 'scandianz@gmail.com', '2020-03-01', '11:16:06', 27.99, 1, '3e869936-9ed0-4be3-8248-1b020a32367b');

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `idz` int(11) NOT NULL,
  `kz` varchar(18) NOT NULL,
  `ez` varchar(120) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `sid` int(11) NOT NULL,
  `hd` varchar(160) NOT NULL COMMENT 'heading',
  `p1` varchar(500) NOT NULL COMMENT 'para1',
  `p2` varchar(500) NOT NULL COMMENT 'para2',
  `btxt` varchar(50) NOT NULL COMMENT 'button text',
  `burl` varchar(255) NOT NULL COMMENT 'button url',
  `od` tinyint(4) NOT NULL COMMENT 'order',
  `iz` varchar(50) NOT NULL COMMENT 'image'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`sid`, `hd`, `p1`, `p2`, `btxt`, `burl`, `od`, `iz`) VALUES
(1, 'Style For You', 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'Nose :industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Midleton very rare 2018', 'item/Midleton2018', 1, '2023072606252897405924.jpg'),
(2, 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'All Champagne', 'category/champagne', 2, '202307260742131835549294.jpg'),
(3, 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Spirits', 'category/Spirits', 3, '202307260743141983438682.jpg'),
(4, 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Spirits', 'category/Spirits', 4, '202307260743141983438682.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slides-new`
--

CREATE TABLE `slides-new` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `slides-new`
--

INSERT INTO `slides-new` (`id`, `image`) VALUES
(1, '20240605192601_2500.jpg'),
(2, '20240605192611_7418.jpg'),
(3, '20240605192620_1603.jpg'),
(4, '20240605192627_7434.jpg'),
(5, '20240605192633_9041.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fn` varchar(100) NOT NULL COMMENT 'first name',
  `ln` varchar(100) NOT NULL COMMENT 'last name',
  `ez` varchar(120) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `pz` varchar(15) DEFAULT NULL COMMENT 'phone no',
  `ad1` varchar(100) DEFAULT NULL COMMENT 'address',
  `ad2` varchar(100) NOT NULL,
  `ad3` varchar(100) NOT NULL,
  `ct` varchar(120) DEFAULT NULL COMMENT 'city',
  `st` tinyint(4) DEFAULT NULL COMMENT 'state',
  `zp` varchar(10) DEFAULT NULL COMMENT 'zip code',
  `cn` varchar(100) DEFAULT NULL COMMENT 'name on card',
  `pt` tinyint(4) DEFAULT NULL COMMENT 'payment type 1-card,2-paypal',
  `no` varchar(100) DEFAULT NULL COMMENT 'credit card no',
  `cv` varchar(10) DEFAULT NULL COMMENT 'cvv',
  `yy` year(4) DEFAULT NULL COMMENT 'exp year',
  `mm` tinyint(4) DEFAULT NULL COMMENT 'exp month',
  `dt` date NOT NULL COMMENT 'reg date',
  `az` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-N/A,1-active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fn`, `ln`, `ez`, `pw`, `pz`, `ad1`, `ad2`, `ad3`, `ct`, `st`, `zp`, `cn`, `pt`, `no`, `cv`, `yy`, `mm`, `dt`, `az`) VALUES
(1, 'Michel', 'Jayasooriya', 'scandianz@gmail.com', '$2y$10$Jl9VAU/AhOdqbgPbKmX2.OewZUsMmIeI55IfZN7M7XPtlypxzVSMS', ' 94713530250', '207/b', 'Siyane rd', 'Gampaha', 'Dest', 107, '2541', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-13', 1),
(3, 'Thiwanka', 'De Silva', 'ghostsagentx@gmail.com', '$2y$10$1J4HYs22o.XZSpqGGRNu9eWiEZpdnftLojUgY5NlFfxAw/5i.Rfd6', '07438156942', '179 Western Road', '', '', 'Billericay', 16, 'CM12 9JD', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-27', 0),
(4, 'Sukee', 'Cellers', 'celele4rs@gmail.com', '$2y$10$3e6EzzVzQ9dpc7KKvOGlIudxklOziu9U.Tl4C6wjEMAyu5ikriGga', '07575512556', '179 Western Road ', '', '', 'Billericay', 16, 'CM12 9JD', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idz`),
  ADD UNIQUE KEY `ez` (`un`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `uz` (`uz`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`idz`),
  ADD UNIQUE KEY `uz` (`uz`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`idz`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `slides-new`
--
ALTER TABLE `slides-new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `idz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `idz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `idz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slides-new`
--
ALTER TABLE `slides-new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

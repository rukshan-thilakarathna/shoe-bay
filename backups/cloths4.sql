-- phpMyAdmin SQL Dump
-- version 5.2.1-1.fc38
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2023 at 09:31 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloths3`
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
  `cn` varchar(100) NOT NULL COMMENT 'cat name',
  `cd` varchar(550) NOT NULL COMMENT 'cat desc',
  `od` tinyint(4) NOT NULL COMMENT 'display order on menu',
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

INSERT INTO `categories` (`cid`, `cn`, `cd`, `od`, `iz`, `mn`, `mt`, `md`, `uz`, `az`) VALUES
(1, 'Men\'s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '202307260930141128900364.png', 1, 'Men\'s Cloths', 'Men\'s Cloths', 'men-cloths', 1),
(2, 'Ladie,s', 'Beers start out as an ale or a lager, and their specific styles and flavors continue to evolve from there. Under the broad ale category, there are numerous types of beer, including pale ales, India pale ales (IPA), porters, stouts, and wheat and Belgian styles. Lagers encompass a range of styles, including the pale Pilsners and German Helles and the darker American lagers.', 2, '202307260809162128487589.png', 1, '', '', 'ladies-cloths', 1),
(3, 'Kid\'s', 'If you are someone who truly enjoys a spirit and love to talk about it to your friends & family, we got you covered. Whether you love gin, vodka, rum, Cognac or Tequila, we have all time favourites, new discoveries and everything in between.', 3, '20230726080209977644395.png', 1, '', '', 'kids-cloths', 1),
(4, 'Sports', 'We have the bubbles all you need for a competitive price from easy drinking prosecco, elegant English sparkling wine to wide variety of most renowned names in the market.', 4, '20230726080252588729329.png', 1, '', '', 'sports-cloths', 1),
(5, 'Jackets', 'We have them in flavours unimaginable. Liqueurs are the perfect excuse to treat yourself and others with a special bottle. ', 5, '202307260803261628882252.png', 1, '', '', 'jackets', 1),
(6, 'Shoes', 'Fancy trying something new but not too sure if you will like the change, miniatures are a great way to see if that transition works for you. This is a great way to find out, before buying a full size bottle.', 6, '202307260803531913325088.png', 1, '', '', 'shoes', 1),
(7, 'Accessories', 'Craft Beer is individually brewed batches of beer - all made with the finest of ingredients, care, skill and knowledge of the process. Experimenting with different styles allows craft brewers to be versatile in style. Our shop has an always changing selection of craft beers for you to try.', 7, '20230726080448832067930.png', 1, '', '', 'accessories', 1),
(8, 'Jewlry', 'Dinner, lunch, meeting someone special or family, taking a classy bottle of wine always has been the tradition. Here at Cellers we have a wide selection, including the best from the Old and New World, sparkling wines for a celebration and dessert wines fit for a special occasion. ', 8, '20230726080521667542819.png', 1, '', '', 'jewlry', 1),
(9, 'Rose Wine', 'When a winemaker desires to impart more tannin and color to red wine, some of the pink juice from the must can be removed at an early stage in what is known as the Saignee (from French bleeding) method. The red wine remaining in the vats is intensified as a result of the bleeding, because the volume of juice in the must is reduced, and the must involved in the maceration becomes more concentrated. The pink juice that is removed can be fermented separately to produce rose', 1, '', 0, '', '', 'rose-wine', 0),
(10, 'Ales', 'Buy beer online from a beer shop that knows the beauty of a great brew. Choose from hundreds of delicious beers from around the world, with beer to suit all tastes and requirements. Can you really buy beer online? And can beer be delivered? You bet! Whether youâ€™re stocking up for the week or buying for a big gathering, come in to our shop and go through the selection or simply go through the list below to satisty your thirst.', 1, '', 0, '', '', 'ales', 0),
(11, 'Cider', 'When life gives you lemons, make lemonade. When life gives you apples, youâ€™re in business. The fermentation of 1 of your 5 a day leads to a beverage that has been at the forefront of the UK brewing scene for millennia. The UK consumes more cider per capita than any other country in the world and for good reason. Cider is an incredibly versatile product and when paired with perry and other such fruits, becomes one of the most sought after alcoholic drinks in the world. ', 1, '', 0, '', '', 'cider', 0),
(12, 'Port', 'Port is a sweet, red, fortified wine from Portugal. Port wine is most commonly enjoyed as a dessert wine because its richness. There are several styles of Port, including red, white, rosÃ©, and an aged style called Tawny Port.', 1, '', 0, '', '', 'port', 0),
(17, 'Beer (Multipacks)', '', 2, '', 1, '', '', 'beer-mulipacks', 0);

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
(3, 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Spirits', 'category/Spirits', 3, '202307260743141983438682.jpg');

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
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

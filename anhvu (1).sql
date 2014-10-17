-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2014 at 04:37 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anhvu`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `name`) VALUES
(1, 'size'),
(2, 'color');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE IF NOT EXISTS `attribute_value` (
  `attribute_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`attribute_value_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`attribute_value_id`, `attribute_id`, `value`) VALUES
(1, 1, 'small'),
(2, 1, 'medium'),
(3, 1, 'large'),
(4, 2, 'black'),
(5, 2, 'white');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `department_id`, `name`, `description`) VALUES
(1, 1, 'Máy tính bàn', 'chuyên hiển thị máy bàn'),
(2, 1, 'laptop', NULL),
(4, 1, 'phụ kiện', 'Phụ kiện linh tinh có thể chung với Department ĐiệnThoại'),
(5, 2, 'Điện thoại đi động', NULL),
(6, 2, 'Phụ kiện', NULL),
(7, 3, 'bikinis', NULL),
(8, 3, 'one pieces', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE IF NOT EXISTS `category_product` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(7, 7),
(7, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `description`) VALUES
(1, 'Máy tính', 'Bao gồm các category: laptop, máy tính bàn, phụ kiện ...'),
(2, 'Điện thoại', 'Bao gồm các category: điện thoại di động, phụ kiện ...'),
(3, 'Swimwear', 'Bao gồm các category: Balo, Quần áo, giày ...');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `price` double NOT NULL,
  `discounted_price` double NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image_2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `display` smallint(6) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `price`, `discounted_price`, `image`, `image_2`, `thumbnail`, `display`) VALUES
(1, 'Asus X452', 'Asus X452-intel core i3 4010U/2/500/14”\r\nCPUIntel, Core i3, 3217U, 1.80 GHz\r\nRAMDDR3L(On board+1Khe), 4 GB\r\nĐĩa cứngHDD, 500 GB\r\nMàn hình rộng14 inch, HD (1366 x 768 pixels)\r\nCảm ứngKhông\r\nĐồ họaAMD Radeon ™ HD 8530M, 1 GB\r\nĐĩa quangDVD Super Multi Double Layer\r\nHĐH theo máyLinux\r\nPIN/BatteryLi-Ion 4 cell\r\nTrọng lượng (Kg)2.1', 8620000, 8500000, 'img01.jpg', NULL, NULL, 0),
(2, 'Asus X551', 'Asus X551-Intel Core i3 3217U/2/500/15.6”\r\nCPUIntel, Core i3, 3217U, 1.80 GHz\r\nRAMDDR3L(On board+1Khe), 2 GB\r\nĐĩa cứngHDD, 500 GB\r\nMàn hình rộng15.6 inch, HD (1366 x 768 pixels)\r\nCảm ứngKhông\r\nĐồ họaIntel® HD Graphics 4000, Share 736MB\r\nĐĩa quangDVD Super Multi Double Layer\r\nHĐH theo máyLinux\r\nPIN/BatteryLi-Ion 4 cell\r\nTrọng lượng (Kg)2.15', 8350000, 8000000, 'img03.jpg', NULL, NULL, 0),
(3, 'ASUS K450CA-WX210', 'CPU: Intel Core i3 3217(1.80Ghz, 1600Mhz )\r\nRAM: 2GB DDR3 1600 Mhz\r\nỔ Cứng: 500GB \r\nMàn hình: 14.0 inch HD LED\r\nGPU: Intel HD Graphics 4000 \r\nBảo hành: 24 tháng', 9390000, 9000000, 'img02.jpg', NULL, NULL, 0),
(4, 'ASUS X550LA-XX009D', 'CPU: Intel Core i3 4010(1.70Ghz, 3MB cache )\r\nRAM: 4GB DDR3 1600 Mhz\r\nỔ Cứng: 500GB \r\nMàn hình: 14.0 inch HD LED\r\nGPU: Intel HD Graphics 4400 \r\nBảo hành: 24 tháng', 10590000, 10000000, NULL, NULL, NULL, 0),
(5, 'ASUS X450CA-WX214', 'CPU: Intel Core i3 3217U 1.8GHz 3Mb\r\nRAM: 2Gb DDR3 1600MHz\r\nĐĩa cứng: HDD 500GB\r\nCard đồ họa: Integrated Intel® HD Graphics 4000\r\nMàn hình: 14 inch HD (1366 x 768 pixels) LED\r\nTích hợp đĩa quang: Super-Multi DVD\r\nCổng giao tiếp: USB 2.0 USB 3.0 HDMI\r\nPIN: 4 Cells 2600 mAh 37 Whrs\r\nTrọng lượng: 2.1 kg\r\nHệ điều hành: Free Dos', 8950000, 8650000, 'S2GErcAUHa_1.jpg', NULL, NULL, 0),
(6, ' ASUS X451CA-VX024D', 'cái này mình sẽ mua\r\nCPU: Intel Core i3 3217U 1.8GHz 3Mb\r\nRAM: 2Gb DDR3L 1600MHz\r\nĐĩa cứng: HDD 500GB\r\nCard đồ họa: Integrated Intel® HD Graphics 4000\r\nMàn hình: 14 inch HD (1366 x 768 pixels) LED\r\nTích hợp đĩa quang: Super-Multi DVD\r\nCổng giao tiếp: USB 2.0 USB 3.0 HDMI\r\nPIN: 4 Cells 2600 mAh 37 Whrs\r\nTrọng lượng: 2.1 kg\r\nHệ điều hành: Free Dos\r\n', 8450000, 8250000, 'toKxoL8aw7_2.jpg', NULL, NULL, 0),
(7, 'Treachery Bikini', 'This season, we partnered with local designer Minimale Animale on a swim collection that will definitely knock you off your surfboards. Channel your inner ''90s supermodel in this peach bikini with ribbed fabric, strappy detailing, and a barely there silhouette. The top has triangular cups, and the bottom has cutouts at waist. Fully lined. Rock it for your next pool party or beach day. By Nasty Gal x Minimale Animale.', 1250000, 1000000, '48364.jpg', NULL, NULL, 3),
(8, 'Southside Bikini', 'This season, we partnered with local designer Minimale Animale on a swim collection that will definitely knock you off your surfboards. Get your game face on (in the sexiest way possible) with this color block bikini in sky blue, peach, black, and white. It has mesh inserts, contrast black stitching, and thin straps. Partially lined. Wear the bikini together or mix and match it with your favorite collab pieces. By Nasty Gal x Minimale Animale.', 1400000, 1200000, '48365.jpg', NULL, NULL, 3),
(9, 'Versa Swimsuit', 'Indulge yourself in pretty much the hottest one piece ever! The Vice Versa Swimsuit has strap detail, arm cuffs, and a contrasting black and white color combo. If you''re into making waves while riding them, this is your suit. Adjustable S-hook closure. By Nasty Gal.', 2117500, 2000000, '43680.jpg', NULL, NULL, 3),
(10, 'Mandalynn Heat Wave Swimsuit', 'It''s gettin'' hot in herrr in this super sexy dual-toned swimsuit featuring midriff cutout. Mega stretch fabric. Fully lined. By Mandalynn.', 2800900, 2600000, '38509.jpg', NULL, NULL, 3),
(11, 'Nasty Gal Strung Up Swimsuit', 'Just because you''re wearing a one piece, doesn''t mean you don''t want to turn heads! Our Strung Up Swimsuit has front and back lattice detail that will have jaws dropping, but it won''t fly off when you hit the waves! We''re big fans. Fully lined. By Nasty Gal.', 1900000, 1850000, '43679.jpg', NULL, NULL, 3),
(12, 'Nasty Gal Caged Chaos Swimsuit', 'If every other swimsuit in the world is too boring for you-- you''ve met your match. With a super fierce lattice and strap design, interlocking back hardware, and cutouts at sides -- this is the bikini that will have people talking about you long after the pool party. Cap sleeves, partially lined. By Nasty Gal.', 2117584, 2000000, '42163.jpg', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `product_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`attribute_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`product_id`, `attribute_value_id`) VALUES
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(8, 1),
(8, 3),
(8, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

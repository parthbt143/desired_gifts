-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 02:34 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desired_gift`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `address_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `cust_id`, `address`, `area_id`) VALUES
(1, 5, '31, Pincic Park Society, Nr Vatva Rly Crossing ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area_pincode`
--

CREATE TABLE `tbl_area_pincode` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_area_pincode`
--

INSERT INTO `tbl_area_pincode` (`area_id`, `area_name`, `pincode`, `is_active`) VALUES
(1, 'Vatva', '382440', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_group`
--

CREATE TABLE `tbl_attribute_group` (
  `atr_grp_id` int(11) NOT NULL,
  `atr_grp_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attribute_group`
--

INSERT INTO `tbl_attribute_group` (`atr_grp_id`, `atr_grp_name`) VALUES
(1, 'Occasions '),
(2, 'Festival '),
(3, 'Relation'),
(4, 'Interest');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_value`
--

CREATE TABLE `tbl_attribute_value` (
  `atr_val_id` int(11) NOT NULL,
  `atr_grp_id` int(11) NOT NULL,
  `atr_val_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attribute_value`
--

INSERT INTO `tbl_attribute_value` (`atr_val_id`, `atr_grp_id`, `atr_val_name`) VALUES
(1, 1, 'Birthday'),
(2, 1, 'marriage anniversary'),
(3, 1, 'engagement anniversary'),
(4, 1, 'Baby Shower'),
(5, 1, 'Retirement Party'),
(6, 1, 'House Warming'),
(7, 1, 'Office Opening'),
(8, 2, 'Rakshabandhan'),
(9, 2, 'Diwali'),
(10, 2, 'Christmas '),
(11, 2, 'Thanks Giving'),
(12, 3, 'Father'),
(13, 3, 'Mother'),
(14, 3, 'Brother'),
(15, 3, 'Sister'),
(16, 3, 'Grand Father'),
(17, 3, 'Grand Mother'),
(18, 3, 'Boss'),
(19, 3, 'Teacher'),
(20, 3, 'Friend'),
(21, 3, 'Girl Friend'),
(22, 3, 'Boy Friend'),
(23, 3, 'Cousin'),
(24, 3, 'Uncle'),
(25, 3, 'Aunt'),
(26, 3, 'Neighbour'),
(27, 3, 'Colleague'),
(28, 4, 'Reading'),
(29, 4, 'Movies'),
(30, 4, 'Web Series'),
(31, 4, 'Cartoon'),
(32, 4, 'Dancing'),
(33, 4, 'Singing'),
(34, 1, 'Velentine Day'),
(35, 3, 'Wife'),
(36, 3, 'Husband');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `img` varchar(500) NOT NULL DEFAULT 'no-image.png',
  `is_delete` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `img`, `is_delete`) VALUES
(1, 'Customized', 'customized-10-06-35-10-04-2020.png', 0),
(2, 'Desk Decor', 'desk-decor-10-07-43-10-04-2020.jpg', 0),
(3, 'Home Decor', 'home-decor-10-08-36-10-04-2020.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cust_images`
--

CREATE TABLE `tbl_cust_images` (
  `cust_image_id` int(11) NOT NULL,
  `order_details_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pis_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cust_images`
--

INSERT INTO `tbl_cust_images` (`cust_image_id`, `order_details_id`, `pro_id`, `pis_id`, `image`) VALUES
(1, 1, 3, 2, 'order-1-06-01-11-11-04-20203991.jpg'),
(2, 1, 3, 52, 'order-1-06-01-11-11-04-20204607.jpg'),
(3, 2, 4, 3, 'order-2-06-01-11-11-04-20207875.jpg'),
(4, 3, 3, 2, 'order-3-06-03-47-11-04-20207168.jpg'),
(5, 3, 3, 52, 'order-3-06-03-47-11-04-20205644.jpg'),
(6, 4, 4, 3, 'order-4-06-03-47-11-04-20204237.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amt` int(5) NOT NULL,
  `receiver_name` varchar(50) NOT NULL,
  `receiver_number` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `area_pincode` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `cust_id`, `date`, `amt`, `receiver_name`, `receiver_number`, `address`, `area_pincode`, `status`) VALUES
(1, 5, '2020-04-11', 750, 'Parth', '5456456454', '54654', 'Vatva - 382440', 'Placed'),
(2, 5, '2020-04-11', 750, 'Name', '8784211513', '1321321', 'Vatva - 382440', 'Placed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `order_id`, `pro_id`, `supp_id`, `price`) VALUES
(1, 1, 3, 2, 250),
(2, 1, 4, 2, 500),
(3, 2, 3, 2, 250),
(4, 2, 4, 2, 500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `pro_details` text NOT NULL,
  `need_images` int(11) NOT NULL,
  `img` varchar(50) NOT NULL DEFAULT 'no-image.png',
  `supp_id` int(11) NOT NULL,
  `price` varchar(5) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_name`, `cat_id`, `sc_id`, `pro_details`, `need_images`, `img`, `supp_id`, `price`, `is_delete`) VALUES
(2, 'Book Holder', 2, 10, 'Book Holder For 5 Books', 0, '', 2, '500', 0),
(3, 'Square Keychain', 1, 6, 'Square Keychain For Multiple Use', 1, '', 2, '250', 0),
(4, 'personalized LED key chain', 1, 6, 'Personalized Key chain with Red And Blue Color LED Lighth', 1, '', 2, '500', 0),
(5, 'Drive Safe Message  Key chain', 1, 6, 'Key Chain With Message \"Drive Safe\" with image of 3 X 2 Inches', 1, '', 2, '285', 0),
(6, 'Double Side Image Key chain', 1, 6, 'Keychain with 2 images \r\n', 1, '', 2, '437', 0),
(7, 'Circle Shape Keychain', 1, 6, 'Circle Shape Keychain For 2x2 Images', 1, '', 2, '300', 0),
(8, 'Personalized Rotating Mini Lamp', 1, 13, 'Mini Lamp For Bedroom .\r\n5 Images of 5 x 5 inches', 1, '', 2, '1500', 0),
(9, 'Moon Light Lamp', 1, 13, 'Personalized Couple Moon light Lamp .\r\n1 Image of 4 x 4 Inches', 1, '', 2, '1230', 0),
(10, 'LED Lamp', 1, 13, '2 Images  of 6 x 5 Inches', 1, '', 2, '760', 0),
(11, 'Explosion Box 2 Layer', 1, 8, 'Blue Color Explosion Box For Loved One.\r\n2 Layer With total 8 Images', 1, '', 2, '999', 0),
(12, '4 Layer Square Explosion Box', 1, 8, 'Square Explosion Box With 4 Layers \r\nIn Red Color  For Loved One', 1, '', 2, '625', 0),
(13, 'Mini Explosion Box', 1, 8, 'Mini Explosion Box  of 12 Images of 3 x 3', 1, '', 2, '600', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image`
--

CREATE TABLE `tbl_product_image` (
  `pro_img_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_image`
--

INSERT INTO `tbl_product_image` (`pro_img_id`, `pro_id`, `img`) VALUES
(6, 2, 'book-holder-11-50-46-10-04-20202191.jpg'),
(7, 2, 'book-holder-11-50-46-10-04-20209871.jpg'),
(8, 3, 'square-keychain-11-52-16-10-04-20201365.jpg'),
(9, 3, 'square-keychain-11-52-16-10-04-20205611.jpg'),
(10, 3, 'square-keychain-11-52-16-10-04-20204541.jpg'),
(11, 4, 'personalized-led-key-chain-12-14-13-10-04-20202615.jpg'),
(12, 4, 'personalized-led-key-chain-12-14-13-10-04-20207196.jpg'),
(13, 4, 'personalized-led-key-chain-12-14-13-10-04-20207883.jpg'),
(14, 4, 'personalized-led-key-chain-12-14-14-10-04-20206448.jpg'),
(15, 5, 'drive-safe-message-key-chain-12-17-00-10-04-20208446.jpg'),
(16, 5, 'drive-safe-message-key-chain-12-17-01-10-04-20209468.jpg'),
(17, 6, 'double-side-image-key-chain-12-17-55-10-04-20209791.jpg'),
(18, 6, 'double-side-image-key-chain-12-17-55-10-04-20205630.jpg'),
(19, 6, 'double-side-image-key-chain-12-17-55-10-04-20208479.jpg'),
(20, 7, 'circle-shape-keychain-12-19-27-10-04-20206937.jpg'),
(21, 8, 'personalized-rotating-mini-lamp-12-20-59-10-04-20202980.jpg'),
(22, 8, 'personalized-rotating-mini-lamp-12-20-59-10-04-20209922.jpg'),
(23, 8, 'personalized-rotating-mini-lamp-12-20-59-10-04-20209637.jpg'),
(24, 8, 'personalized-rotating-mini-lamp-12-20-59-10-04-20203896.jpg'),
(25, 8, 'personalized-rotating-mini-lamp-12-20-59-10-04-20209749.jpg'),
(26, 9, 'moon-light-lamp-12-22-28-10-04-20202837.jpg'),
(27, 9, 'moon-light-lamp-12-22-28-10-04-20207051.jpg'),
(28, 9, 'moon-light-lamp-12-22-28-10-04-20208119.jpg'),
(29, 9, 'moon-light-lamp-12-22-29-10-04-20205449.jpg'),
(30, 9, 'moon-light-lamp-12-22-29-10-04-20208174.jpg'),
(31, 10, 'led-lamp-12-23-39-10-04-20202162.jpg'),
(32, 10, 'led-lamp-12-23-39-10-04-20207350.jpg'),
(33, 10, 'led-lamp-12-23-39-10-04-20209617.jpg'),
(34, 11, 'explosion-box-2-layer-12-58-54-10-04-20206180.jpg'),
(35, 11, 'explosion-box-2-layer-12-58-54-10-04-20203465.jpg'),
(36, 11, 'explosion-box-2-layer-12-58-55-10-04-20209183.jpg'),
(37, 12, '4-layer-square-explosion-box-01-12-06-10-04-20208598.jpg'),
(38, 12, '4-layer-square-explosion-box-01-12-07-10-04-20201750.jpg'),
(39, 12, '4-layer-square-explosion-box-01-12-07-10-04-20209170.jpg'),
(40, 13, 'mini-explosion-box-01-19-09-10-04-20205653.jpg'),
(41, 13, 'mini-explosion-box-01-19-09-10-04-20206206.jpg'),
(42, 13, 'mini-explosion-box-01-19-09-10-04-20201755.jpg'),
(43, 13, 'mini-explosion-box-01-19-09-10-04-20202959.jpg'),
(44, 13, 'mini-explosion-box-01-19-09-10-04-20209089.jpg'),
(45, 13, 'mini-explosion-box-01-19-09-10-04-20205805.jpg'),
(46, 13, 'mini-explosion-box-01-19-09-10-04-20207378.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image_size`
--

CREATE TABLE `tbl_product_image_size` (
  `pis_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `idx` int(5) NOT NULL,
  `height` int(5) NOT NULL,
  `width` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_image_size`
--

INSERT INTO `tbl_product_image_size` (`pis_id`, `pro_id`, `idx`, `height`, `width`) VALUES
(2, 3, 1, 2, 2),
(3, 4, 1, 2, 2),
(4, 5, 1, 2, 3),
(5, 6, 1, 2, 3),
(6, 6, 2, 2, 3),
(7, 7, 1, 2, 2),
(8, 8, 1, 5, 5),
(9, 8, 2, 5, 5),
(10, 8, 3, 5, 5),
(11, 8, 4, 5, 5),
(12, 8, 5, 5, 5),
(13, 9, 1, 4, 4),
(14, 10, 1, 6, 5),
(15, 10, 2, 6, 5),
(16, 11, 1, 4, 5),
(17, 11, 2, 4, 5),
(18, 11, 3, 4, 5),
(19, 11, 4, 4, 5),
(20, 11, 5, 3, 5),
(21, 11, 6, 3, 5),
(22, 11, 7, 3, 5),
(23, 11, 8, 3, 5),
(24, 12, 1, 5, 5),
(25, 12, 2, 5, 5),
(26, 12, 3, 5, 5),
(27, 12, 4, 5, 5),
(28, 12, 5, 4, 4),
(29, 12, 6, 4, 4),
(30, 12, 7, 4, 4),
(31, 12, 8, 4, 4),
(32, 12, 9, 3, 3),
(33, 12, 10, 3, 3),
(34, 12, 11, 3, 3),
(35, 12, 12, 3, 3),
(36, 12, 13, 2, 2),
(37, 12, 14, 2, 2),
(38, 12, 15, 2, 2),
(39, 12, 16, 2, 2),
(40, 13, 1, 3, 3),
(41, 13, 2, 3, 3),
(42, 13, 3, 3, 3),
(43, 13, 4, 3, 3),
(44, 13, 5, 3, 3),
(45, 13, 6, 3, 3),
(46, 13, 7, 3, 3),
(47, 13, 8, 3, 3),
(48, 13, 9, 3, 3),
(49, 13, 10, 3, 3),
(50, 13, 11, 3, 3),
(51, 13, 12, 3, 3),
(52, 3, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reminder`
--

CREATE TABLE `tbl_reminder` (
  `reminder_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Vendor'),
(3, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_category`
--

CREATE TABLE `tbl_sub_category` (
  `sc_id` int(11) NOT NULL,
  `sc_name` varchar(50) NOT NULL,
  `cat_id` varchar(11) NOT NULL,
  `img` varchar(500) NOT NULL DEFAULT 'no-image.png',
  `is_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_category`
--

INSERT INTO `tbl_sub_category` (`sc_id`, `sc_name`, `cat_id`, `img`, `is_delete`) VALUES
(1, 'name', '1', 'no-image.png', 1),
(2, 'namee', '1', 'namee-07-20-16-06-02-2020.png', 1),
(3, 'Scrap Book', '1', 'scrap-book-10-12-16-10-04-2020.jpg', 0),
(4, 'cusion', '1', 'cusion-10-12-41-10-04-2020.jpg', 0),
(5, 'mug', '1', 'mug-10-13-03-10-04-2020.jpg', 0),
(6, 'keychains', '1', 'keychains-10-13-35-10-04-2020.jpg', 0),
(7, 'cards', '1', 'cards-10-14-00-10-04-2020.jpg', 0),
(8, 'Explosion Box', '1', 'explosion-box-10-15-04-10-04-2020.jpg', 0),
(9, 'toys & games', '3', 'toys-&-games-10-15-43-10-04-2020.jpg', 0),
(10, 'book holder', '2', 'book-holder-10-16-11-10-04-2020.jpg', 0),
(11, 'pen holder', '2', 'pen-holder-10-16-28-10-04-2020.jpg', 0),
(12, 'Photo Frame', '3', 'photo-frame-10-17-25-10-04-2020.jpg', 0),
(13, 'Lamp', '1', 'lamp-10-17-54-10-04-2020.jpg', 0),
(14, 'bottle', '1', 'bottle-10-18-22-10-04-2020.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suggestion`
--

CREATE TABLE `tbl_suggestion` (
  `suggestion_id` int(11) NOT NULL,
  `atr_val_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_suggestion`
--

INSERT INTO `tbl_suggestion` (`suggestion_id`, `atr_val_id`, `pro_id`) VALUES
(1, 35, 11),
(2, 36, 11),
(3, 34, 11),
(4, 21, 11),
(5, 22, 11),
(6, 1, 11),
(7, 2, 11),
(8, 3, 11),
(9, 2, 12),
(10, 3, 12),
(11, 1, 13),
(12, 2, 13),
(13, 3, 13),
(14, 21, 13),
(15, 22, 13),
(16, 34, 13),
(17, 35, 13),
(18, 36, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_image` varchar(200) NOT NULL DEFAULT 'no-image.png',
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_mobile` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_image`, `user_email`, `user_password`, `role_id`, `user_mobile`, `is_delete`) VALUES
(1, 'Parth B Thakkar', 'avatar.png', 'parthbt143@gmail.com', '123', 1, '8735055104', 0),
(2, 'Karan ', 'avatar.png', 'karan@gmail.com', '123', 2, '', 0),
(5, 'parth', 'no-image.png', 'parth@gmail.com', '123', 3, '8735055104', 0),
(6, 'karan', 'no-image.png', 'karan1@gmail.com', '123', 2, '5465465', 0),
(7, 'Jerry', 'no-image.png', 'jerry@gmail.com', '12345678', 3, '7048870355', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `tbl_area_pincode`
--
ALTER TABLE `tbl_area_pincode`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_attribute_group`
--
ALTER TABLE `tbl_attribute_group`
  ADD PRIMARY KEY (`atr_grp_id`);

--
-- Indexes for table `tbl_attribute_value`
--
ALTER TABLE `tbl_attribute_value`
  ADD PRIMARY KEY (`atr_val_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_cust_images`
--
ALTER TABLE `tbl_cust_images`
  ADD PRIMARY KEY (`cust_image_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  ADD PRIMARY KEY (`pro_img_id`) USING BTREE;

--
-- Indexes for table `tbl_product_image_size`
--
ALTER TABLE `tbl_product_image_size`
  ADD PRIMARY KEY (`pis_id`);

--
-- Indexes for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `tbl_suggestion`
--
ALTER TABLE `tbl_suggestion`
  ADD PRIMARY KEY (`suggestion_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_area_pincode`
--
ALTER TABLE `tbl_area_pincode`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_attribute_group`
--
ALTER TABLE `tbl_attribute_group`
  MODIFY `atr_grp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_attribute_value`
--
ALTER TABLE `tbl_attribute_value`
  MODIFY `atr_val_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_cust_images`
--
ALTER TABLE `tbl_cust_images`
  MODIFY `cust_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  MODIFY `pro_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `tbl_product_image_size`
--
ALTER TABLE `tbl_product_image_size`
  MODIFY `pis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_suggestion`
--
ALTER TABLE `tbl_suggestion`
  MODIFY `suggestion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

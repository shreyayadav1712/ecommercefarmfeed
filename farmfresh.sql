-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2021 at 01:00 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmfresh`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` double NOT NULL,
  `c_id` double NOT NULL,
  `item_id` int(3) NOT NULL,
  `weight` int(6) NOT NULL,
  `price` float NOT NULL,
  `o_id` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `c_id`, `item_id`, `weight`, `price`, `o_id`) VALUES
(2, 3, 2, 250, 0, 1),
(3, 3, 3, 500, 0, 2),
(4, 3, 2, 1000, 0, 3),
(5, 3, 4, 1000, 0, 4),
(6, 3, 3, 1000, 0, 5),
(7, 3, 2, 1000, 0, 6),
(8, 3, 3, 1000, 0, 6),
(9, 3, 4, 1000, 0, 6),
(10, 3, 3, 1000, 0, 7),
(16, 3, 2, 3000, 240, 13),
(18, 7, 2, 500, 40, 10),
(19, 7, 3, 2000, 80, 10),
(22, 7, 3, 2000, 80, 11),
(23, 7, 2, 1500, 120, 12),
(24, 7, 12, 2, 40, 0),
(25, 3, 9, 1000, 80, 13),
(26, 3, 1, 3, 45, 14),
(27, 3, 4, 1500, 120, 14),
(29, 3, 12, 2, 40, 14),
(30, 3, 1, 2, 30, 15),
(31, 3, 12, 2, 40, 16),
(32, 3, 1, 2, 30, 16),
(33, 3, 2, 1500, 120, 16),
(34, 3, 6, 1500, 72, 16),
(35, 3, 2, 1000, 80, 17),
(37, 3, 4, 5000, 400, 17),
(38, 3, 12, 1, 20, 17),
(39, 3, 1, 1, 15, 0),
(40, 2, 1, 2, 30, 18),
(41, 2, 6, 3000, 144, 19),
(42, 2, 1, 5, 75, 20),
(43, 2, 9, 1000, 80, 21),
(44, 2, 4, 250, 20, 21),
(53, 13, 84, 2000, 96, 23),
(54, 13, 2, 250, 10, 24);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Vegetable'),
(2, 'Fruits'),
(3, 'Milk');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `c_address` text NOT NULL,
  `c_pin` int(11) NOT NULL,
  `c_phone` double NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_password` varchar(150) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `flag`, `f_name`, `l_name`, `c_address`, `c_pin`, `c_phone`, `c_email`, `c_password`, `latitude`, `longitude`) VALUES
(2, 0, 'Ritesh ', 'Sandbhor', '403,(B) WING, KASTURI LAWNS, CHIKANGHAR HIGHWAY, NEAR SANDEEP HOTEL, BEHIND PULSE HOSPITAL,KALYAN (WEST).', 421301, 9167703475, 'ritesh.sandbhor@somaiya.edu', '$2y$10$91PLzqK77NhHjkqWZ2ztiu96/b0HFwguWefejUzfZOyI0bFCONfj.', 19.2598509, 19.2598509),
(3, 0, 'Ritesh', 'Sandbhor', 'Kasturi Lawns Chikanghar Highway Near Sandeep Hotel Behind Pulse Hospital Kalyan West', 421301, 8888741000, 'ritesh@outlook.com', '$2y$10$Ecj1ny/POTrgC5EbCE8I6OInc1Y2rF0tvYvTnbs56qSO6Ld6WTozm', 0, 0),
(6, 0, 'Ritesh', 'Sandbhor', 'Kasturi lawns', 421301, 9029878, 'deshpande.y@somaiya.edu', '$2y$10$ZQDsUtsne9RxPf0TAydahuFP8E/wO5qrbyAwUt2S1rkBu2Wf1l7Fy', 19.2510093, 73.14233779999999),
(7, 0, 'Harsh', 'Bhor', 'Thane', 400610, 9221376428, 'hbhor@somaiya.edu', '$2y$10$9b5OEADtVaF1vO2FNqhybuhHY7FYJ3cCs5LziR.EeCWPPh03tlPS.', 19.259511399999997, 73.1454596),
(13, 1, 'prajwal', 'shelke', 'B/08, bldg no.3,\r\nVenketeshwar nagar,cabin road', 401105, 8433551037, 'prajwalshelke03@gmail.com', '$2y$10$fEzbMltEuAtSS4KhpAtCnesH3NOFgCX4l9p.kMj8e5maY3UoHYhFO', 19.2217088, 72.8530944);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `d_id` int(11) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `phone` double NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `e_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`d_id`, `f_name`, `l_name`, `phone`, `email`, `address`, `e_password`) VALUES
(4, 'Ritesh', 'Sandbhor', 9167703475, 'ritsand81@gmail.com', 'Kasturi Lawns', '$2y$10$91PLzqK77NhHjkqWZ2ztiu96/b0HFwguWefejUzfZOyI0bFCONfj.');

-- --------------------------------------------------------

--
-- Table structure for table `finalorder`
--

CREATE TABLE `finalorder` (
  `o_id` double NOT NULL,
  `c_id` double NOT NULL,
  `deliveryboy` int(5) NOT NULL,
  `delivery` int(2) NOT NULL COMMENT 'if yes 1 or 0',
  `timeorder` int(11) NOT NULL,
  `timedispatch` int(11) NOT NULL,
  `timedelivery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finalorder`
--

INSERT INTO `finalorder` (`o_id`, `c_id`, `deliveryboy`, `delivery`, `timeorder`, `timedispatch`, `timedelivery`) VALUES
(1, 3, 1, 1, 1591216047, 0, 0),
(2, 3, 1, 1, 1591217408, 0, 1591284979),
(3, 3, 0, 1, 1591273165, 0, 1591284979),
(4, 3, 1, 1, 1591273813, 0, 0),
(5, 3, 4, 1, 1591274050, 0, 1591284979),
(6, 3, 4, 1, 1591274146, 1591385504, 1591284979),
(7, 3, 0, 1, 1591274405, 0, 1591284979),
(10, 7, 4, 1, 1591292213, 0, 1591451283),
(11, 7, 4, 1, 1591292527, 0, 1591451159),
(12, 7, 4, 1, 1591292616, 1591385519, 1591451174),
(13, 3, 4, 1, 1591382416, 0, 1607939523),
(14, 3, 4, 1, 1591384895, 1591385467, 0),
(15, 3, 4, 1, 1591389681, 1591419068, 1591419100),
(16, 3, 4, 1, 1591419649, 1591419667, 1591419867),
(17, 3, 4, 1, 1591466268, 1591466350, 1591466392),
(18, 2, 0, 0, 1607492832, 0, 0),
(19, 2, 0, 0, 1607514699, 0, 0),
(20, 2, 4, 1, 1607931861, 1607939303, 1607948198),
(21, 2, 4, 1, 1607948849, 1607948914, 1607949057),
(23, 13, 4, 1, 1629702994, 1629720304, 1629720482),
(24, 13, 0, 0, 1629788791, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `i_eng` varchar(100) NOT NULL,
  `i_mar` varchar(100) NOT NULL,
  `i_hin` varchar(100) NOT NULL,
  `category_type` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1-grams,2-gadi',
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `i_eng`, `i_mar`, `i_hin`, `category_type`, `type`, `quantity`, `price`, `img`) VALUES
(1, 'Amarnath Leaves', 'चवळी', 'अमृत पान', 1, 1, 26, 15, 'AmarnathLeaves.jpg'),
(2, 'Baby Corn', 'बेबी कॉर्न', 'मीठी-मकई', 2, 1, 4750, 10, 'BabyCorn.png'),
(3, 'Beetroot', 'चुकंदर', 'चुकंदर', 1, 1, 0, 10, 'Beetroot.jpg'),
(4, 'Bitter Gourd', 'कार्ल', 'करेला', 2, 1, 1000, 10, 'BitterGourd.jpeg'),
(5, 'Bottle Gourd', 'दुधी भोपळा', 'लौकी', 1, 1, 0, 0, 'BottleGourd.jpg'),
(6, 'Cabbage', 'कोबी', 'पत्ता गोभी', 2, 1, 15500, 12, 'Cabbage.jpg'),
(7, 'Capsicum', 'शिमला मिर्ची', 'शिमला मिर्च', 0, 1, 0, 0, 'Capsicum.jpg'),
(9, 'Cauliflower', 'फुल कोबी', 'गोभी', 0, 1, 0, 20, 'Cauliflower.jpg'),
(10, 'Chilli', 'मिरची', 'मिर्च', 0, 1, 0, 0, 'Chilli.jpeg'),
(11, 'Cluster Beans', 'गवार', 'गवार', 0, 1, 0, 0, 'ClusterBeans.png'),
(12, 'Coconut', 'नारळ', 'नारियल', 1, 2, 2, 20, 'Coconut.jpg'),
(13, 'Coriander', 'कोथिंबीर', 'धनिया', 0, 2, 0, 0, 'CorianderLeaves.jpeg'),
(14, 'Corn', 'मका', 'मक्का', 0, 1, 0, 0, 'Corn.jpg'),
(15, 'Curry Leaves', 'कडीपत्ता', 'करी पत्ते', 0, 1, 0, 0, 'CurryLeaves.jpg'),
(16, 'Dill Leaves', 'बडीशेप पाने', 'डिल पत्तियां', 0, 1, 0, 0, 'DillLeaves.jpg'),
(17, 'Drumsticks', 'शेवग्यच्य शेंगा', 'सहजन की फल्ली', 0, 1, 0, 0, 'Drumsticks.jpg'),
(18, 'Eggplant', 'वांगं', 'बैंगन', 0, 1, 0, 0, 'Eggplant.jpg'),
(19, 'Flat Green Beans', 'हिरव्या शेंगा', 'हरी सेम', 0, 1, 0, 0, 'FlatGreenBeans.jpg'),
(20, 'French Beans', 'फरसबी', 'फरास बीन', 0, 1, 0, 0, 'FrenchBeans.jpg'),
(21, 'Garlic', 'लसूण', 'लहसुन', 0, 1, 0, 0, 'Garlic.png'),
(22, 'Ginger', 'आले', 'अदरक', 0, 2, 0, 0, 'Ginger.jpg'),
(23, 'Ivy Gourd', 'आयव्ही लौकी', 'आयवहि लौकी', 0, 1, 0, 0, 'IvyGourd.jpeg'),
(24, 'Jackfruit', 'फणस', 'कटहल', 0, 1, 0, 0, 'Jackfruit.jpg'),
(25, 'Lady Finger', 'भेंडी', 'भिन्डी', 0, 1, 0, 0, 'LadyFinger.jpeg'),
(26, 'Lemon', 'लिंबू', 'नींबू', 0, 1, 0, 0, 'Lemon.jpeg'),
(27, 'Malabar Spinach', 'मलबार पालक', 'मलबार पालक', 0, 2, 40, 10, 'MalabarSpinach.jpg'),
(28, 'Fenugreek', 'मेथी', 'मेंथी', 0, 2, 0, 0, 'Methi.jpg'),
(29, 'Mint Leaves', 'पुदीना पाने', 'पुदीने की पत्तियां', 0, 2, 0, 0, 'MintLeaves.jpg'),
(30, 'Mushroom', 'मशरूम', 'मशरूम', 0, 1, 0, 0, 'Mushroom.jpg'),
(31, 'Mustard Leaves', 'मोहरीची पाने', 'सरसों की पत्तियां', 0, 1, 0, 0, 'MustardLeaves.jpg'),
(32, 'Onion', 'कांदा ', 'प्याज', 0, 1, 0, 0, 'Onion.jpg'),
(33, 'Peas', 'वाटाणे', 'मटर', 0, 1, 0, 0, 'Peas.jpg'),
(34, 'Potato', 'बटाटा', 'आलू', 0, 1, 0, 0, 'Potato.jpg'),
(35, 'Pumpkin', 'भोपळा', 'कद्दू', 0, 1, 0, 0, 'Pumpkin.jpg'),
(36, 'Radish Pods', 'मुळा पोड्स', 'मूली की फली', 0, 1, 0, 0, 'RadishPods.jpg'),
(37, 'Radish', 'मुळा', 'मूली', 0, 1, 0, 0, 'Radish.jpg'),
(38, 'Raw Banana', 'कच्चा केळी', 'कच्चा केला', 0, 1, 0, 0, 'RawBanana.jpg'),
(39, 'Red Chilli', 'लाल मिरची', 'लाल मिर्च', 0, 1, 0, 0, 'RedChiili.jpeg'),
(40, 'Snake Gourd', 'साप लौकी', 'साप लौकी', 0, 1, 0, 0, 'SnakeGourd.jpg'),
(41, 'Spinach', 'पालक', 'पालक', 0, 2, 0, 0, 'Spinach.jpg'),
(42, 'Spine Gourd', 'स्पाइन लौकी', 'लौकी', 0, 1, 0, 0, 'SpineGourd.jpeg'),
(43, 'Sweet Potato', 'रताळे', 'शकरकंद', 0, 1, 0, 0, 'SweetPotato.gif'),
(44, 'Taro Root', 'तारो जड़', 'तारो जड़', 0, 1, 0, 0, 'TaroRoot.jpg'),
(45, 'Tomato', 'टोमॅटो', 'टमाटर', 0, 1, 0, 0, 'Tomato.jpg'),
(46, 'Turnip', 'सलगम', 'शलजम', 0, 1, 0, 0, 'Turnip.png'),
(47, 'White Pumpkin', 'पांढरा भोपळा', 'सफेद कद्दू', 0, 1, 0, 0, 'WhitePumpin.jpg'),
(84, 'Amul Milk', 'अमूल दूध', 'अमूल दूध', 3, 3, 7000, 12, '1629700977amul milk.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(3) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `f_name`, `l_name`, `email`, `password`) VALUES
(1, 'Yash', 'Deshpande', 'farmfresh@gmail.com', '$2y$10$91PLzqK77NhHjkqWZ2ztiu96/b0HFwguWefejUzfZOyI0bFCONfj.');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Kilogram'),
(2, 'Piece'),
(3, 'litre');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` int(2) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_phone` (`c_phone`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `finalorder`
--
ALTER TABLE `finalorder`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finalorder`
--
ALTER TABLE `finalorder`
  MODIFY `o_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-06-17 17:40:58
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `dessert`
--

-- --------------------------------------------------------

--
-- 資料表結構 `about_content`
--

CREATE TABLE `about_content` (
  `about_id` int(11) NOT NULL,
  `about_title` text NOT NULL,
  `about_article` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `about_content`
--

INSERT INTO `about_content` (`about_id`, `about_title`, `about_article`) VALUES
(1, '我們的故事', '成立於2008年，致力於跳脫框架創造驚奇又精緻的甜點。\r\n您的一口品嘗，是甜點師傅的一輩子，而我們的驕傲，來自於您品嚐後淺淺的一抹微笑。   \r\n^^ ');

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `aId` int(100) NOT NULL,
  `aName` varchar(20) NOT NULL,
  `aAccount` varchar(20) NOT NULL,
  `aPassword` varchar(20) NOT NULL,
  `rName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`aId`, `aName`, `aAccount`, `aPassword`, `rName`) VALUES
(0, 'kkkoo', 'kkkkk', 'zxc', '一般管理員'),
(1, 'ad2', 'ad2', 'ssss', '進階管理員'),
(2, 'fffff', 'asdad', '44455555', '進階管理員'),
(5, 'advancerr', 'advance', 'advance', '進階管理員'),
(6, 'change22', 'change22', 'change22', '一般管理員'),
(7, 'Add Admin', 'Add Admin\n', 'Add Admin\r\n', '一般管理員');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `mId` int(11) NOT NULL,
  `tNo` int(5) DEFAULT NULL,
  `cartTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`mId`, `tNo`, `cartTime`) VALUES
(0, 0, '2021-06-16 09:18:08'),
(0, 0, '2021-06-16 09:18:35'),
(0, 0, '2021-06-16 09:19:37'),
(0, 2, '2021-06-17 09:48:17'),
(0, 3, '2021-06-17 13:27:04'),
(0, 4, '2021-06-17 13:28:09'),
(0, 5, '2021-06-17 13:29:07'),
(0, 7, '2021-06-17 13:30:11'),
(0, 8, '2021-06-17 14:08:49'),
(0, 9, '2021-06-17 14:18:50'),
(0, NULL, '2021-06-17 14:32:56'),
(1, 0, '2021-06-10 14:40:52'),
(1, 2, '2021-06-13 10:58:47'),
(1, 3, '2021-06-13 16:54:25'),
(1, NULL, '2021-06-13 16:56:53'),
(60, NULL, '2021-06-13 17:51:02'),
(61, 4, '2021-06-13 17:51:43'),
(61, 5, '2021-06-13 17:56:11'),
(61, 6, '2021-06-13 17:56:34'),
(61, NULL, '2021-06-13 17:57:01');

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `cId` int(11) NOT NULL,
  `cName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `category`
--

INSERT INTO `category` (`cId`, `cName`) VALUES
(1, '咖啡'),
(2, '蛋糕');

-- --------------------------------------------------------

--
-- 資料表結構 `contact_content`
--

CREATE TABLE `contact_content` (
  `id` int(11) NOT NULL,
  `store` text NOT NULL,
  `tel` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `location` text NOT NULL,
  `openingHour` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `contact_content`
--

INSERT INTO `contact_content` (`id`, `store`, `tel`, `fax`, `location`, `openingHour`) VALUES
(1, '荻瑟特股份有限公司台灣分公司', '07 - 0000000', '07 - 0000000', '804高雄市鼓山區蓮海路70號', '周一〜周日 11:00~22:00');

-- --------------------------------------------------------

--
-- 資料表結構 `index_content`
--

CREATE TABLE `index_content` (
  `ID` int(100) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `slogan` text NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `index_content`
--

INSERT INTO `index_content` (`ID`, `title`, `content`, `slogan`, `image`) VALUES
(1, '我們的完美品牌!!讚喔', '◉ 極致工法呈現的線條\r\n◉ 完美映簾品嚐的藝術\r\n◉ 用最純粹的食材\r\n◉ 成就最滿足的味\r\n◉ 找到人生的甜                     ', '這個季節，享受從我們這裡傳承~~', 'IMG_20180728_150609.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `level`
--

CREATE TABLE `level` (
  `level` int(20) NOT NULL,
  `lName` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `level`
--

INSERT INTO `level` (`level`, `lName`, `discount`) VALUES
(0, '一般會員', 0),
(1, 'VIP', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `line`
--

CREATE TABLE `line` (
  `lineId` varchar(50) NOT NULL,
  `mId` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'logout',
  `pNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `line`
--

INSERT INTO `line` (`lineId`, `mId`, `status`, `pNo`) VALUES
('U02cc8282305809efa14eb01bef32e7ce', 53, 'shopping', 5),
('U44c2a9c90ae32191fe9e2aa53452884e', 0, 'login', 5),
('U76af0afa51727363c55fa59834b215d9', 26, 'shopping', 3),
('U8ee186e6b41e659b55df8471579726d0', 49, 'login', 6),
('U967376bba4594661edfad5af09017efe', 31, 'login', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `line_order`
--

CREATE TABLE `line_order` (
  `mId` int(11) NOT NULL,
  `pNo` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `line_order`
--

INSERT INTO `line_order` (`mId`, `pNo`, `amount`) VALUES
(26, 3, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `mId` int(11) NOT NULL,
  `name` char(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` char(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(25) NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `level` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`mId`, `name`, `email`, `phone`, `address`, `account`, `password`, `level`) VALUES
(0, '蕭x丞', 'handsome0788@hotmail.com.tw', '0989898989', '台南', '1213548466', '123', 0),
(25, 'EDIT2525', 'qqq@gmail.com', 'qqq5653647', 'qqqqewregghhb', 'qqqweqew', 'qqq', 0),
(26, 'ttt', 'ttt@gmail.com', 'ttt', 'ttt', 'ttt', 'ttt', 0),
(27, 'qwert2727', 'qwert@gmail.com', 'qwert', 'qwert', 'qwert', 'qwert', 0),
(31, 'why', 'why@gmail.com', 'why', 'why', 'why', 'why', 0),
(33, 'rrr33', 'rrr@gmail.com', 'rrr', 'rrr', 'rrr', 'rrr', 0),
(43, 'manage', 'manage@gmail.com', '0900999888', 'manage', '978795645', 'manage', 0),
(45, 'text-center', 'text@gmail.com', '0966555444', 'text-center text-success', 'text-center0text-success', 'text-center', 0),
(47, 'success', 'success@gmail.com', '0999000999', 'success', '636354654', '4t5tg5ehg', 0),
(49, 'John Terry', 'john@gmail.com', '0911221331', '台北市大安區', '9876543298765', 'iamjohn', 0),
(51, 'bootstrap5', 'bs5@gmail.com', '0988999888', 'bootstrap5', '234567809876', 'bootstrap5', 0),
(52, 'Amy', 'amy@gmail.com', '07-3312435', '高雄市左營區博愛路', '95484200088', 'AmyisMe', 0),
(53, '王曉明', 'ming@gmail.com', '0987654321', '王曉明', '760425609f', 'aaa', 0),
(54, 'adding', 'adding@gmail.com', '0911000111', 'adding', 'w64564576', 'add', 0),
(55, '0613', '0613@gmail.com', '0987678909', '0613', '53654u6tjf213', '0613', 0),
(58, 'Add Member', 'frrr@gmail.com', '453653637', 'Add Member', '6547658723', '43654', 0),
(59, '荻瑟特', 'dessert@gmail.com', '53647658', '荻瑟特', '25647598', 'dessert', 270),
(60, '測試購物車', 'cart@gmail.com', '0987325455', '測試購物車', '345467890-24', 'cart', 0),
(61, '重新測試購物車', 'cart@gmail.com', '0987325455', '測試購物車', '345467890-24', 'cde', 450),
(62, '0229Test', '0229@gmail.com', '0967435788', '0229Test', '7835t2t5q25', '0229Test', 0),
(63, '98989', '9898@gmail.com', '0909979897', '9898', '6578900879', '9898', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `news_content`
--

CREATE TABLE `news_content` (
  `id` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `news` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `news_content`
--

INSERT INTO `news_content` (`id`, `category`, `news`) VALUES
(1, '新品上市', '未上市就滿單 – 不加一絲砂糖的蜂蜜蛋糕 好吃喔~'),
(2, '新品上市', '新品 – 焙茶海綿輕蛋糕'),
(8, '活動訊息', '2021年端午節 – 我們有可以宅配的藝術蛋糕了'),
(11, '新品上市', '新品-巧克力蛋糕');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `mId` int(11) NOT NULL,
  `pNo` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `cartTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`mId`, `pNo`, `amount`, `cartTime`) VALUES
(0, 1, 1, '2021-06-17 13:29:07'),
(0, 1, 2, '2021-06-17 14:18:50'),
(0, 1, 1, '2021-06-17 14:32:56'),
(0, 2, 4, '2021-06-17 09:48:17'),
(0, 2, 2, '2021-06-17 13:27:04'),
(0, 2, 1, '2021-06-17 13:28:09'),
(0, 2, 1, '2021-06-17 13:29:07'),
(0, 2, 6, '2021-06-17 13:30:11'),
(0, 2, 8, '2021-06-17 14:08:49'),
(0, 3, 1, '2021-06-17 13:28:09'),
(0, 3, 3, '2021-06-17 13:29:07'),
(0, 4, 1, '2021-06-17 13:27:04'),
(0, 4, 2, '2021-06-17 13:28:09'),
(0, 4, 1, '2021-06-17 13:29:07'),
(0, 5, 1, '2021-06-17 13:28:09'),
(0, 6, 2, '2021-06-17 09:48:17'),
(0, 6, 2, '2021-06-17 14:18:50'),
(0, 7, 4, '2021-06-17 09:48:17');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `pNo` int(11) NOT NULL,
  `pName` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `pIntro` varchar(200) DEFAULT NULL,
  `delivery` int(11) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `cId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`pNo`, `pName`, `price`, `pIntro`, `delivery`, `picture`, `cId`) VALUES
(1, '槴香綠茶', 90, '使用與純喫茶相同茶葉', 1, 'Green Tea.jpg', 1),
(2, '西子灣紅茶', 70, '西子灣特級紅茶', 1, 'Black Tea.jpg', 1),
(3, '猴香冰拿鐵', 90, '使用柴山新品種咖啡豆', 1, 'Ice Latte.jpg', 1),
(4, '京都宇治抹茶', 130, '外國來的比較貴', 1, 'Matcha.jpg', 1),
(5, '普通麥茶', 50, '愛之味好喝麥茶', 1, 'Wheat Tea.jpg', 1),
(6, '蜂蜜蛋糕', 80, '好吃的蜂蜜蛋糕', 1, 'Honey Castella.jpg', 2),
(7, '抹茶蜂蜜蛋糕', 90, '有抹茶香味的好吃蜂蜜蛋糕', 1, 'Matcha Castella.jpg', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `tNo` int(5) NOT NULL,
  `pNo` int(5) NOT NULL,
  `amount` int(5) NOT NULL,
  `salesPrice` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `record`
--

INSERT INTO `record` (`tNo`, `pNo`, `amount`, `salesPrice`) VALUES
(1, 2, 10, 70),
(1, 5, 4, 50),
(2, 6, 5, 80),
(2, 7, 10, 90),
(3, 4, 1, 130),
(5, 1, 1, 90),
(5, 2, 1, 70),
(5, 3, 3, 90),
(5, 4, 1, 130),
(6, 3, 10, 90),
(6, 5, 10, 50),
(7, 2, 6, 70),
(8, 2, 8, 70),
(9, 1, 2, 90),
(9, 6, 2, 80),
(10, 1, 10, 90),
(10, 2, 10, 70),
(11, 4, 100, 130),
(12, 5, 5, 50),
(12, 6, 1, 80),
(13, 2, 4, 70),
(13, 3, 4, 90),
(14, 1, 10, 90),
(14, 3, 3, 90),
(15, 1, 10, 90),
(15, 5, 5, 50),
(15, 6, 5, 80),
(16, 1, 15, 90),
(16, 2, 20, 70),
(16, 3, 10, 90),
(16, 4, 1, 130),
(17, 1, 16, 90),
(18, 1, 15, 90),
(18, 2, 1, 70),
(18, 3, 1, 90),
(18, 4, 1, 130),
(19, 4, 4, 130),
(19, 6, 5, 80),
(20, 3, 1, 90),
(21, 2, 28, 70),
(21, 3, 3, 90),
(21, 4, 2, 130),
(21, 6, 2, 80);

-- --------------------------------------------------------

--
-- 資料表結構 `transaction`
--

CREATE TABLE `transaction` (
  `tNo` int(10) NOT NULL,
  `transMid` int(11) NOT NULL,
  `method` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transTime` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '交易時間',
  `bankAccount` int(30) NOT NULL,
  `total` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `transaction`
--

INSERT INTO `transaction` (`tNo`, `transMid`, `method`, `transTime`, `bankAccount`, `total`) VALUES
(1, 0, '現金(來店取貨)', '2021-06-17 12:09:08', 1213548466, 1100),
(2, 0, '現金(來店取貨)', '2021-06-17 13:27:04', 1213548466, 800),
(3, 0, '匯款(宅配)', '2021-06-17 13:28:09', 1213548466, 270),
(4, 0, '現金(來店取貨)', '2021-06-17 13:29:07', 1213548466, 470),
(5, 0, '現金(來店取貨)', '2021-06-17 13:30:11', 1213548466, 560),
(6, 0, '現金(來店取貨)', '2021-06-17 13:58:39', 1213548466, 1400),
(7, 0, '匯款(宅配)', '2021-06-17 14:08:49', 1213548466, 420),
(8, 0, '匯款(宅配)', '2021-06-17 14:18:50', 1213548466, 560),
(9, 0, '現金(來店取貨)', '2021-06-17 14:32:56', 1213548466, 340),
(10, 49, '現金(來店取貨)', '2021-06-17 14:59:04', 2147483647, 1600),
(11, 49, '現金(來店取貨)', '2021-06-17 14:59:50', 2147483647, 13000),
(12, 49, '現金(來店取貨)', '2021-06-17 15:00:17', 2147483647, 330),
(13, 49, '現金(來店取貨)', '2021-06-17 15:00:49', 2147483647, 640),
(14, 49, '現金(來店取貨)', '2021-06-17 15:01:52', 2147483647, 1170),
(15, 49, '現金(來店取貨)', '2021-06-17 15:02:29', 2147483647, 1550),
(16, 49, '現金(來店取貨)', '2021-06-17 15:03:05', 2147483647, 3780),
(17, 49, '現金(來店取貨)', '2021-06-17 15:03:35', 2147483647, 1440),
(18, 49, '現金(來店取貨)', '2021-06-17 15:04:07', 2147483647, 1640),
(19, 49, '現金(來店取貨)', '2021-06-17 15:04:25', 2147483647, 920),
(20, 49, '現金(來店取貨)', '2021-06-17 15:04:43', 2147483647, 90),
(21, 49, '現金(來店取貨)', '2021-06-17 15:05:08', 2147483647, 2650);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `about_content`
--
ALTER TABLE `about_content`
  ADD PRIMARY KEY (`about_id`);

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aId`) USING BTREE;

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`mId`,`cartTime`) USING BTREE;

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cId`);

--
-- 資料表索引 `contact_content`
--
ALTER TABLE `contact_content`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `index_content`
--
ALTER TABLE `index_content`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level`) USING BTREE;

--
-- 資料表索引 `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`lineId`),
  ADD UNIQUE KEY `mId` (`mId`),
  ADD KEY `pNo` (`pNo`);

--
-- 資料表索引 `line_order`
--
ALTER TABLE `line_order`
  ADD PRIMARY KEY (`mId`,`pNo`) USING BTREE;

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mId`),
  ADD KEY `level` (`level`);

--
-- 資料表索引 `news_content`
--
ALTER TABLE `news_content`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`mId`,`pNo`,`cartTime`),
  ADD KEY `mId` (`mId`,`cartTime`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pNo`);

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`tNo`,`pNo`),
  ADD KEY `tNo` (`tNo`);

--
-- 資料表索引 `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tNo`),
  ADD KEY `transMid` (`transMid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `category` (`cId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-12-06 23:22:40
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `project1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coach`
--

CREATE TABLE `coach` (
  `coach_id` int(4) UNSIGNED NOT NULL,
  `coach_name` varchar(30) NOT NULL,
  `coach_gender` varchar(4) NOT NULL,
  `birth` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `experience` varchar(30) NOT NULL,
  `license` varchar(20) NOT NULL,
  `coach_info` varchar(255) NOT NULL,
  `coach_skill` varchar(30) NOT NULL,
  `coach_img` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `valid` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `coach`
--

INSERT INTO `coach` (`coach_id`, `coach_name`, `coach_gender`, `birth`, `email`, `phone`, `city`, `experience`, `license`, `coach_info`, `coach_skill`, `coach_img`, `created_at`, `valid`) VALUES
(1, '錢佳芊', '女', '1988-12-05', 'garcia4724@yahoo.com', '0921625647', '高雄市', '5年', '0', '非常喜愛各種戶外運動：自由潛水、水肺潛水、開放式海域長泳、鐵人三項等⋯ 也時常參與各種賽事，自由潛水是一項身心靈協調的運動，當你學會了如何在水裡放鬆，定能感受到海裡世界的美好與神奇。看見另一個世界的奇妙生物，聽見自己的聲音，感受水深不同的溫度，快來跟我一起優美又自由的潛水吧～', '1,2', '7.png', '2023-12-01', 1),
(2, '蔡宗祺', '男', '1979-05-02', 'dylan9207@gmail.com', '0924891870', '臺北市', '3', '3', '請多多指教', '水肺潛水', '25.png', '2023-11-21', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `coach_skill`
--

CREATE TABLE `coach_skill` (
  `id` int(6) NOT NULL,
  `coach_id` int(4) NOT NULL,
  `skill_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `coach_skill`
--

INSERT INTO `coach_skill` (`id`, `coach_id`, `skill_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `skill`
--

INSERT INTO `skill` (`id`, `name`) VALUES
(1, 'PADI'),
(2, 'NAUI'),
(3, 'SSI'),
(4, 'CMAS');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`coach_id`);

--
-- 資料表索引 `coach_skill`
--
ALTER TABLE `coach_skill`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coach`
--
ALTER TABLE `coach`
  MODIFY `coach_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coach_skill`
--
ALTER TABLE `coach_skill`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

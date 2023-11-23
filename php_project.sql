-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 05:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('visible','invisible') NOT NULL DEFAULT 'invisible',
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `view` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `summary`, `body`, `image`, `status`, `cat_id`, `user_id`, `view`, `created_at`, `updated_at`) VALUES
(7, 'Bitcoin, Ethereum Technical Analysis: ETH Climbs Above $1,200 Ahead of US Consumer Confidence Report', 'Ethereum rose back above $1,200 on Tuesday, ahead of the upcoming consumer confidence report from the United States. The price comes following a breakout above a key resistance level of $1,180. Bitcoin also climbed higher in today’s session, ending a five-day losing streak.', 'This surge saw bitcoin climb from its aforementioned price floor $16,175, which has been in play since earlier in the month of November.Looking at the chart, although prices have surged, it will be a test to see if this momentum can be maintained, due to the relative strength index (RSI) colliding with a ceiling.\r\nAs of writing, the index is hovering marginally above a ceiling of 41.00, with a current reading of 41.12.The Conference Board consumer confidence survey is expected to come in at a reading of 100, which is marginally below October’s reading of 102.5.As can be seen from the chart, the move, which ended two straight days of losses, pushed ethereum to its highest point since Saturday.\r\nOverall, this move comes as the RSI raced above its point of resistance at 43.70, and it is currently tracking at 46.10 as of writing.\r\nA ceiling of $1,230 now awaits ethereum bulls, and should they overcome this hurdle, a move towards $1,300 will be on the cards.', 'public/image-article/2022.11.29-17.11.00.jpeg', 'invisible', 3, 27, 1, '2022-11-29 19:41:00', '2023-11-19 19:48:15'),
(8, 'President of Bank of Brazil Shows \'Open Finance\' Digital Real Concept Featuring Stablecoin Integration and Payments Functionality ', '\r\nPresident of Bank of Brazil Shows \'Open Finance\' Digital Real Concept Featuring Stablecoin Integration and Payments Functionality\r\ndigital real\r\n\r\nRoberto Campos Neto, president of the Bank of Brazil, explained the role that the Brazilian central bank digital currency (CBDC), the digital real, might play in the future of personal finance. At an event, Neto explained the concept of “open finance,” showing a “super app” that featured PIX (a payments network) functionality, and also integration with other stablecoins already available.', 'This idea includes the integration of the digital real, which is still under development, with traditional and decentralized financial structures and institutions. A “super app,” that will allow customers to hold stablecoins and the CBDC, was also shown in the event, showcasing the connection the system will have with the already available PIX payments network.\r\nIn this way, the app will allow the users to have a complete picture of their savings, traditional or crypto-based, in just one place.\r\nWhile the digital real concept has been in development for quite some time, there is no estimated date for its completion, as the central bank and other organizations continue to test the different implementations and functions this new coin would have. However, Campos Neto stated that the currency will be a bridge to decentralized finance, as the country pushes towards monetary digitization.', 'public/image-article/2022.11.29-17.14.52.jpeg', 'invisible', 3, 27, 0, '2022-11-29 19:44:52', NULL),
(9, 'JPMorgan Expects Major Changes Coming to Crypto Industry and Regulation Post FTX Collapse', 'JPMorgan has outlined key changes it expects in the crypto industry and its regulation following the collapse of crypto exchange FTX. The global investment bank envisages several new regulatory initiatives, including those focusing on custody, customer asset protection, and transparency.', 'Global investment bank JPMorgan published a report Thursday outlining major changes it expects to happen in the crypto industry following the collapse of cryptocurrency exchange FTX.\r\nGlobal strategist Nikolaos Panigirtzoglou explained that “Not only has the collapse of FTX and its sister company Alameda Research created a cascade of crypto entity collapse and suspension of withdrawals,” but it is also “likely to increase investor and regulatory pressure on crypto entities to disclose more information about their balance sheets.”\r\nPanigirtzoglou proceeded to list the main changes JPMorgan expects after the FTX meltdown. Firstly, he wrote:\r\n“A key debate among U.S. regulators centers around the classification of cryptocurrencies as either securities or commodities,” Panigirtzoglou continued.\r\nNoting that many retail crypto investors have already moved to self-custody their cryptocurrencies using hardware wallets, the strategist described: “The main beneficiaries post FTX collapse are institutional crypto custodians … Over time these trusted custodians will likely dominate over relatively smaller crypto-native custodians or crypto exchanges.”', 'public/image-article/2022.11.29-17.53.50.jpeg', 'invisible', 3, 27, 1, '2022-11-29 20:23:50', '2023-11-19 19:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'news', '2022-11-18 13:10:12', '2022-11-28 22:41:07'),
(3, 'business', '2022-11-28 22:41:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` enum('unseen','seen','approved') NOT NULL DEFAULT 'unseen',
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favouritearticles`
--

CREATE TABLE `favouritearticles` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favouritecomments`
--

CREATE TABLE `favouritecomments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `parent_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 'home', NULL, '/', '2022-11-29 12:52:28', NULL),
(3, 'contact', NULL, 'contact', '2023-11-19 16:19:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `status` enum('unseen','seen') NOT NULL DEFAULT 'unseen',
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `status`, `email`, `created_at`, `updated_at`) VALUES
(1, 'lknvka ;gaernj gn;gk ma\'kfz i;jesgrjk;sz n', 'seen', 'aliahmadi@gmail.com', '2023-11-19 19:05:08', '2023-11-19 19:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `permission` enum('admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active_token` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `forget_token` varchar(255) DEFAULT NULL,
  `expire_forget_token` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `permission`, `email`, `avatar`, `password`, `active_token`, `is_active`, `forget_token`, `expire_forget_token`, `created_at`, `updated_at`) VALUES
(27, 'mohammad', 'admin', 'mohammadinik98@gmail.com', '', '$2y$10$YtNyTacKsy6YKKlXhVXmMubtfhI/AdV377K3UXCZBOgAYpJy1Vs7a', '81a096ecb828817b014e2448dc3cbd5430e5cfa74f6d5c52ec5eba7af0fe960b', 1, 'd2045c7025765d2b565392025d4b365acc9f82f742cc9c8c35cdb42bcca00ef5', '2022-11-29 17:48:02', '2022-11-18 14:16:49', '2022-11-29 17:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `websetting`
--

CREATE TABLE `websetting` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `websetting`
--

INSERT INTO `websetting` (`id`, `title`, `description`, `icon`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'news', 'wellcome to my website', 'public/websetting/icon.jpg', 'public/websetting/logo.jpg', '2022-11-29 11:44:45', '2022-11-29 14:17:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favouritearticles`
--
ALTER TABLE `favouritearticles`
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favouritecomments`
--
ALTER TABLE `favouritecomments`
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `websetting`
--
ALTER TABLE `websetting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `websetting`
--
ALTER TABLE `websetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favouritearticles`
--
ALTER TABLE `favouritearticles`
  ADD CONSTRAINT `favouritearticles_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favouritearticles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favouritecomments`
--
ALTER TABLE `favouritecomments`
  ADD CONSTRAINT `favouritecomments_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favouritecomments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

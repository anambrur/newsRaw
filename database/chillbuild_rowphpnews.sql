-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2025 at 05:05 AM
-- Server version: 10.6.22-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chillbuild_rowphpnews`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `baneradtop` varchar(255) DEFAULT NULL,
  `baneradbottom` varchar(255) DEFAULT NULL,
  `lbone` varchar(2000) DEFAULT NULL,
  `lbtwo` varchar(2000) DEFAULT NULL,
  `homeadone` varchar(255) DEFAULT NULL,
  `homeadtwo` varchar(255) DEFAULT NULL,
  `homeadthree` varchar(255) DEFAULT NULL,
  `homeadfour` varchar(255) DEFAULT NULL,
  `homeadfive` varchar(255) DEFAULT NULL,
  `homeadsix` varchar(255) DEFAULT NULL,
  `posttop` varchar(2000) DEFAULT NULL,
  `postbottom` varchar(2000) DEFAULT NULL,
  `sidetop` varchar(2000) DEFAULT NULL,
  `sidebottom` varchar(2000) DEFAULT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `baneradtop`, `baneradbottom`, `lbone`, `lbtwo`, `homeadone`, `homeadtwo`, `homeadthree`, `homeadfour`, `homeadfive`, `homeadsix`, `posttop`, `postbottom`, `sidetop`, `sidebottom`, `views`) VALUES
(1, '898931b998a4f840d7e880af47a0bf50.jpg', '3f1a7c5e73b1dd97b968badafaebd7b2.jpg', 'e9bde10cbe868475b6ac9a2af0d4f01d.jpg', 'e9bde10cbe868475b6ac9a2af0d4f01d.jpg', '32593f221f11839264af2b4ed67a6c0a.jpg', '069107e413f7969ff565a6e98a48ad10.gif', 'e9bde10cbe868475b6ac9a2af0d4f01d.jpg', '3626850d481efd38a8ae8164011f41b2.jpg', 'e9bde10cbe868475b6ac9a2af0d4f01d.jpg', 'e9bde10cbe868475b6ac9a2af0d4f01d.jpg', 'Untitled-1 copy.jpg65a60e9ab0e37.jpg', 'e2d010ac7127b0d6396e0094bdbf9892.gif', 'c9bbec55a1ce8acfc029e8b4d5b26726.jpg', '9ef43550f4d810a6dd77912501a57618.jpg', 2992293);

-- --------------------------------------------------------

--
-- Table structure for table `reporter`
--

CREATE TABLE `reporter` (
  `reporterID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reporter`
--

INSERT INTO `reporter` (`reporterID`, `name`, `deleted`, `photo`) VALUES
(1, 'আজকের সিলেট ডেস্ক  ', 'false', 'cc35d4b8e796c869289176c383aa3da3.png'),
(2, 'নিজস্ব প্রতিবেদক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(3, 'রজত কান্তি চক্রবর্তী', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(4, 'আন্তর্জাতিক ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(5, 'ধর্ম ও জীবন ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(6, 'বিনোদন ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(7, 'সম্পাদকীয়', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(8, 'অর্থনীতি ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(9, 'ক্রীড়া ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(10, 'প্রবাস জীবন ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(11, 'লাইফস্টাইল ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(12, 'ডেস্ক রিপোর্ট', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(13, 'সংবাদ বিজ্ঞপ্তি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(14, 'তথ্যপ্রযুক্তি ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(15, 'সাহিত্য ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(16, 'স্বাস্থ্য ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(17, 'সাইফুর তালুকদার', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(18, 'সাদিকুর রহমান চৌধুরী', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(19, 'আজিজুল আম্বিয়া', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(20, 'খলিলুর রহমান', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(21, 'মিজান মোহাম্মদ', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(22, 'আমিনুল হক খোকন', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(23, 'শাহিদ হাতিমী', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(24, 'সৈয়দ রাসেল আহমদ', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(25, 'মো: ফারুক মিয়া', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(26, 'জনি কান্ত শর্মা', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(27, 'শিপন চন্দ জয়', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(28, 'হবিগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(29, 'মৌলভীবাজার প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(30, 'সুনামগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(31, 'বালাগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(32, 'বিয়ানীবাজার প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(33, 'বিশ্বনাথ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(34, 'কোম্পানীগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(35, 'ফেঞ্চুগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(36, 'গোলাপগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(37, 'গোয়াইনঘাট প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(38, 'জৈন্তাপুর প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(39, 'জকিগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(40, 'কানাইঘাট প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(41, 'ওসমানীনগর প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(42, 'বিশ্বম্ভপুর (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(43, 'ছাতক (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(44, 'দিরাই (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(45, 'ধর্মপাশা (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(46, 'দোয়ারাবাজার (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(47, 'জগন্নাথপুর (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(48, 'জামালগঞ্জ (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(49, 'তাহিরপুর (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(50, 'শাল্লা (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(51, 'শান্তিগঞ্জ (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(52, 'মধ্যনগর (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(53, 'আজমিরীগঞ্জ (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(54, 'বাহুবল (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(55, 'বানিয়াচং (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(56, 'চুনারুঘাট (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(57, 'লাখাই (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(58, 'মাধবপুর (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(59, 'নবীগঞ্জ (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(60, 'শায়েস্তাগঞ্জ (হবিগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(61, 'বড়লেখা (মৌলভীবাজার) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(62, 'কুলাউড়া (মৌলভীবাজার) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(63, 'কমলগঞ্জ (মৌলভীবাজার) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(64, 'রাজনগর (মৌলভীবাজার) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(65, 'শ্রীমঙ্গল (মৌলভীবাজার) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(66, 'জুড়ী (মৌলভীবাজার) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(67, 'সৈয়দ হেলাল আহমদ বাদশা, গোয়াইনঘাট থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(69, 'চাকুরীর খবর ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(70, 'শিক্ষাঙ্গণ ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(71, 'শাবি প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(72, 'সিকৃবি প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(73, 'বিচিত্র ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(74, '----------------', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(75, 'দিনা রহমান', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(76, 'অমৃত জ্যোতি, মধ্যনগর (সুনামগঞ্জ) থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(77, 'সজিব শর্মা, জগন্নাথপুর (সুনামগঞ্জ) থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(78, 'মোঃ মিজানুর রহমান, চুনারুঘাট (হবিগঞ্জ) থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(80, 'শাহ্ মাশুক নাঈম, দোয়ারাবাজার (সুনামগঞ্জ) থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(82, 'ক্রীড়া প্রতিবেদক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(84, 'মোহাম্মদ শাহ আলম, হবিগঞ্জ থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(85, 'আহমেদ পাবেল', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(86, 'শেখ ইমন আহমেদ, মাধবপুর (হবিগঞ্জ) থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(87, 'আবুল কাশেম অফিক, বালাগঞ্জ থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(88, 'মো: আশরাফুল, নবীগঞ্জ (হবিগঞ্জ) থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(89, ' ক্রীড়া প্রতিবেদক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(90, 'লন্ডন অফিস, যুক্তরাজ্য', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(91, ' আজিজুল আম্বিয়া, লন্ডন (যুক্তরাজ্য) অফিস', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(92, 'দক্ষিণ সুরমা প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(93, 'মলয় চক্রবর্তী, ওসমানীনগর থেকে ', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(94, 'হাফিজ মাছুম আহমদ দুধরচকী', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(95, 'দক্ষিণ সুরমা প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(96, 'চাকুরী ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(97, 'অতিথি প্রতিবেদক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(98, 'দিনা রহমান', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(99, 'সংবাদদাতা', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(100, 'অনলাইন ডেস্ক', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(101, 'ইমাম উদ্দিন, জৈন্তাপুর থেকে', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(102, 'সৈয়দ আখলাক উদ্দিন মনসুর (হবিগঞ্জ) শায়েস্তাগঞ্জ প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(103, 'এম.এম হোসেন রুবেল', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(104, 'মহি উদ্দিন আরিফ ধর্মপাশা (সুনামগঞ্জ) প্রতিনিধি', 'false', 'd41d8cd98f00b204e9800998ecf8427e'),
(105, 'বিশেষ প্রতিবেদক', 'false', 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) DEFAULT NULL,
  `homemetadescription` varchar(255) DEFAULT NULL,
  `homemetakeyword` varchar(255) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `urlwww` varchar(255) DEFAULT NULL,
  `footertext` varchar(255) DEFAULT NULL,
  `footcopyright` varchar(255) DEFAULT NULL,
  `detailspagekeyword` varchar(255) DEFAULT NULL,
  `hedderlogo` varchar(2000) DEFAULT NULL,
  `footerlogo` varchar(255) DEFAULT NULL,
  `favicon` varchar(2000) DEFAULT NULL,
  `views` int(11) NOT NULL,
  `live` varchar(255) DEFAULT NULL,
  `on_live` int(11) DEFAULT NULL,
  `back_color` varchar(255) DEFAULT NULL,
  `font_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `homemetadescription`, `homemetakeyword`, `url`, `urlwww`, `footertext`, `footcopyright`, `detailspagekeyword`, `hedderlogo`, `footerlogo`, `favicon`, `views`, `live`, `on_live`, `back_color`, `font_color`) VALUES
(1, 'আজকের সিলেট || সিলেটের তথ্য বিশ্বজুড়ে', 'আজকের সিলেট থেকে প্রকাশিত একটি জনপ্রিয় অনলাইন পত্রিকা, সিলেটে সরকারি অনুমোদন প্রাপ্ত প্রথম অনলাইন পত্রিকা, সিলেটের তথ্য বিশ্বজুড়ে পৌঁছে দেওয়া  আমাদের একমাত্র লক্ষ্য', 'আজকেরসিলেট, অনলাইন, সংবাদপত্র, বাংলা, খবর, জাতীয়, রাজনীতি,সমগ্রদেশ, জীবনধারা, ছবি, ভিডিও, সিলেট, মৌলভীবাজার, সুনামগঞ্জ, হবিগঞ্জ, প্রবাস, চাকরি-বাকরি, লাইফ স্টাইল, তথ্য প্রযুক্তি', 'https://chillbuild.com/', 'www.chillbuild.com', 'It is a long established fact that a reader will be distract by the readable.', '2024', 'আজকেরসিলেট, অনলাইন, সংবাদপত্র, বাংলা, খবর, জাতীয়, রাজনীতি,সমগ্রদেশ, জীবনধারা, ছবি, ভিডিও, সিলেট, মৌলভীবাজার, সুনামগঞ্জ, হবিগঞ্জ, প্রবাস, চাকরি-বাকরি, লাইফ স্টাইল, তথ্য প্রযুক্তি', 'edff13f86c6d6f457fc3c71f42a47c4a.png', '84396195663985511bf86ed9d3971e05.png', '40df04caa5af69c051a81f33ff2e565a.png', 1143762, 'উপজেলা পরিষদ নির্বাচন ২০২৪', 0, 'e0ce9a', '000');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `f` varchar(2000) DEFAULT NULL,
  `t` varchar(2000) DEFAULT NULL,
  `g` varchar(2000) DEFAULT NULL,
  `p` varchar(2000) DEFAULT NULL,
  `l` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `f`, `t`, `g`, `p`, `l`) VALUES
(1, 'https://www.facebook.com/newspaper83198/', 'https://', 'https://www.youtube.com/channel/UChGb-cRJ3KhBsgX1Ucrf0jA', 'https://', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  `AdminEmailId` varchar(255) NOT NULL,
  `Is_Active` int(11) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT current_timestamp(),
  `role` enum('admin','editor') NOT NULL DEFAULT 'editor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `Is_Active`, `CreationDate`, `UpdationDate`, `role`) VALUES
(1, 'Developer', '$2y$12$esH2.A8k2zeLY0n2akbosO2fatGSX8NvKe8Rt3JjWYXrY5xVpmRA6', 'faisalyounus1990@gmail.com', 1, '2021-06-24 04:59:43', '2021-06-24 10:59:44', 'admin'),
(2, 'Newsdesk', '$2y$12$p5Tg/q6dEO4qPY1Q0Yt63OXi6piqQ140Y5s/EHLRmPvSTuR2dgu/K', 'report.ajkersylhet@gmail.com', 1, '2024-01-02 01:40:53', '2024-01-02 06:10:59', 'editor'),
(3, 'admin', '$2y$12$My7eWgrkd281dZxnlyM6LeY0RRQBWczrhRsRyWWtnYyOpv10K3o1e', 'sayfur71@gmail.com', 1, '2024-03-08 05:09:46', '2024-01-02 07:16:00', 'admin'),
(4, 'khalilrahman', '$2y$12$lrVoOSpDplHJ3dU/nBz1R.GKYPXQmyR1HQk3eXFZpL3JzEAv1aX6S', 'khalilrahman48@gmail.com', 1, '2024-01-02 01:51:52', '2024-01-02 07:51:52', 'editor'),
(6, 'Mizanm31', '$2y$12$lLd/U///Z/xE75by0CSM4uwMzURlWJz1aobPW69V8f7rvV.Ztm1pi', 'mizanm31@gmail.com', 1, '2024-01-02 09:05:58', '2024-01-02 15:05:58', 'editor'),
(7, 'Editor', '$2y$12$1oc/v54VqsPWTpKZqxErseDfwx1oNzNbwXcL.ovNEcHAI53WQtqdu', 'rajotcsylbd@gmail.com', 1, '2024-01-10 08:00:07', '2024-01-10 14:00:07', 'editor'),
(8, 'mahamin94', '$2y$12$0Xle5G3XAjDDz.i4pRwzT.um/aKP/a1jrhxA1O6Jsax66XUmlrO0W', 'aminnews94@gmail.com', 1, '2024-01-29 02:57:54', '2024-01-29 08:57:55', 'editor'),
(10, 'ahmed.pabel', '$2y$12$krzxn40AxIT8do/OC6Q/1edQplTnokCr/lIZbKmGV9dR8DHxZGaUK', 'pabelahmed2008@gmail.com', 1, '2024-04-25 05:58:15', '2024-04-25 11:58:15', 'editor'),
(11, 'Shahid Hatimi', '$2y$12$IdOUiIFBmpKLan5wqag3eOOr6o2x4z8OonQbMzik/Rg.vJJwKNzZC', 'hatimiinternational2024@gmail.com', 1, '2024-10-25 05:38:41', '2024-10-25 11:38:41', 'editor'),
(12, 'syrasel', '$2y$12$jm0/yzKRr0NO3JJV7.v1AudYKATPDMLkwayvExCTK/FHjqruGrimG', 'syedraselpress@gmail.com', 1, '2025-02-06 06:53:22', '2025-02-06 12:47:53', 'editor'),
(13, 'shipon@admin', '$2y$12$3dWMA30mTWhT9WYnkLD2kehnu2hO2liaAPKsE4seuDBh2UI2lQ0ee', 'reporter.shiponchandajoy1997@gmail.com', 1, '2025-02-17 05:03:21', '2025-02-17 11:03:21', 'editor'),
(14, 'admin', '$2y$12$P6ZIiBfSuf9/n4XL7HKsHuB.T2z0j0WYe1tr9J2UoCbPPOV66R2zC', 'admin@chillbuild.com', 1, '2025-05-06 03:20:31', '2025-05-06 09:20:31', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblads`
--

CREATE TABLE `tblads` (
  `id` int(11) NOT NULL,
  `AdCode` varchar(2000) DEFAULT NULL,
  `photoad` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblads`
--

INSERT INTO `tblads` (`id`, `AdCode`, `photoad`) VALUES
(1, 'Sidebar Google Ad Codew\r\n', '8d232857b51b288096aebb2fc1d68007.jpg'),
(2, 'Post Top Bottom Google Ad Code', '8d232857b51b288096aebb2fc1d68007.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 'সিলেটজুড়ে', '/', '2019-05-17 15:34:29', '2024-01-02 04:59:53', 1),
(2, 'মহানগর', '/', '2019-04-30 00:00:14', '2024-01-02 05:00:00', 1),
(3, 'জাতীয়', '/', '2019-04-30 00:00:14', '2024-01-02 05:00:11', 1),
(4, 'রাজনীতি', '/', '2019-04-30 00:00:14', '2024-01-02 05:00:20', 1),
(5, 'আন্তর্জাতিক', '/', '2019-05-17 15:42:00', '2024-01-02 05:00:31', 1),
(6, 'এক্সক্লুসিভ ', '/', '2019-05-17 15:43:35', '2024-01-02 05:04:17', 1),
(7, 'সম্পাদকীয়', '/', '2019-05-17 15:42:13', '2024-01-02 05:04:27', 1),
(8, 'অর্থনীতি', '/', '2019-05-17 15:43:07', '2024-01-02 05:04:38', 1),
(9, 'বিনোদন', '/', '2019-05-22 14:12:20', '2024-01-02 05:04:45', 1),
(10, 'ক্রীড়াঙ্গণ', '/', '2019-05-23 11:53:55', '2024-01-02 05:04:51', 1),
(11, 'প্রবাস', '/', '2019-05-23 11:53:55', '2024-01-02 05:04:58', 1),
(12, 'লাইফ-স্টাইল', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:05', 1),
(13, 'গণমাধ্যম', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:12', 1),
(14, 'চাকুরীর খবর', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:18', 1),
(15, 'তথ্য ও প্রযুক্তি', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:24', 1),
(16, 'ধর্ম ও জীবন', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:24', 1),
(17, 'বিচিত্র সংবাদ', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:24', 1),
(18, 'শিক্ষাঙ্গন', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:24', 1),
(19, 'সাহিত্য', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:24', 1),
(20, 'স্বাস্থ্য', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:24', 1),
(21, 'মুক্তমত', '/', '2019-05-23 11:53:55', '2024-01-02 05:05:24', 1),
(22, 'চায়ের কাপে ভোটের ঝড়', '/', '2019-05-23 11:53:55', '2024-01-03 06:52:23', 1),
(23, 'প্রেস বক্স', '/', '2019-05-23 11:53:55', '2024-01-03 06:52:23', 1),
(24, 'খোশ আমদেদ মাহে রমজান', '/', '2019-05-23 11:53:55', '2024-01-03 06:52:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` char(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfamily`
--

CREATE TABLE `tblfamily` (
  `id` int(11) NOT NULL,
  `MemberName` varchar(200) DEFAULT NULL,
  `MemberPhoto` varchar(200) DEFAULT NULL,
  `MyPosition` varchar(200) DEFAULT NULL,
  `MemberDetails` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblfamily`
--

INSERT INTO `tblfamily` (`id`, `MemberName`, `MemberPhoto`, `MyPosition`, `MemberDetails`) VALUES
(4, 'faisal younus', 'e55bbbc082d700d81ab921864a9a95aa.jpg', 'developer', '<p>fasdfasdfsdf</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tblhomeslider`
--

CREATE TABLE `tblhomeslider` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us Page', '<p><b>সম্পাদকীয়, বার্তা ও বাণিজ্যিক কার্যালয়</b><br>কমন মার্কেট (৫ম তলা), বন্দরবাজার, সিলেট-৩১০০<br>নিউজরুম ফোন : +8809647 700685, +8801816 700685<br>ই-মেইল : report.ajkersylhet@gmail.com<br>মানবসম্পদ বিভাগ : hr.ajkersylhet@gmail.com<br><br><br><b>লন্ডন (যুক্তরাজ্য) অফিস</b><br>আজিজুল আম্বিয়া<br>ব্যবস্থাপনা সম্পাদক ও লন্ডন অফিস ইনচার্জ<br>Suti-215, City Gate House (2nd Flour),<br>246-250 Romford Rood, Stratford, E7 9HZ, London.<br>Phone : +447861751608<br>Email : azizul.ambya@yahoo.com<br><br><br><b>আবর আমিরাত অফিস</b><br>মো. আমিনুল হক<br>মধ্যপ্রাচ্য অফিস ইনচার্জ<br>HASSAN SAEED BUILDING 1,<br>HASSAN BIN HAITHAM STREET,<br>NEW INDUSTRIAL AREA 2,<br>AJMAN, UNITED ARAB EMIRATES<br>Phone : +971-50-8140519<br><br><b><br>ইউরোপ অফিস</b><br>মো. খছরু মিয়া (খছরুজ্জামান পারভেজ)<br>ইউরোপ অফিস ইনচার্জ<br>Rau Acror Isidoro, 3-2DRT<br>1900-014, Lisboa, Portugal<br>Phone : 920304974<br></p>', '2018-06-30 16:01:03', '2025-05-06 13:51:14'),
(2, 'conditions', 'Terms and Conditions Page', 'fadsf', '2018-06-30 16:01:36', '2025-05-06 13:51:34'),
(3, 'privacypolicy', 'Privacy Policy Page', 'adsdas', '2018-06-30 16:01:36', '2025-05-06 13:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `repoter` int(11) DEFAULT NULL,
  `PostDetails` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `On_Slider` int(11) DEFAULT NULL,
  `On_Sportlingt` int(11) DEFAULT NULL,
  `On_Article` int(1) DEFAULT NULL,
  `On_Gfeed` int(1) DEFAULT NULL,
  `On_Save` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `photocap` text DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `source` text NOT NULL,
  `Is_Active` tinyint(1) DEFAULT 1,
  `PostingDate` datetime DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `seoshort` text DEFAULT NULL,
  `imageseo` text DEFAULT NULL,
  `seomkey` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `subtitle`, `repoter`, `PostDetails`, `CategoryId`, `SubCategoryId`, `On_Slider`, `On_Sportlingt`, `On_Article`, `On_Gfeed`, `On_Save`, `PostUrl`, `PostImage`, `photocap`, `views`, `source`, `Is_Active`, `PostingDate`, `UpdationDate`, `seoshort`, `imageseo`, `seomkey`) VALUES
(1, 'বানিয়াচঙ্গে গরুর খড় খাওয়াকে কেন্দ্র করে টেটাযুদ্ধ, শতাধিক আহত', '', 2, '<p>হবিগঞ্জের বানিয়াচংয়ে গরুতে ধানের খড় খাওয়াকে কেন্দ্র করে টেটা যুদ্ধে প্রায় ৩ ঘন্টাব্যাপী সংঘর্ষের ঘটনা ঘটেছে। এতে উভয়পক্ষের শতাধিক লোক আহত হয়েছেন। টেটাবিদ্ধ অবস্থায় ১৫ জনকে ঢাকা ও সিলেট মেডিকেল কলেজ হাসপাতালে পাঠানো হয়েছে। </p><p>পরিস্থিতি নিয়ন্ত্রণে পুলিশ ২ রাউন্ড টিয়ারশেল নিক্ষেপ করে।\r\n\r\nসোমবার সকাল সাড়ে ১০টা থেকে দুপুর দেড়টা পর্যন্ত উপজেলার উত্তর সাঙ্গর গ্রামে এ সংঘর্ষের ঘটনা ঘটে।\r\n\r\nএনিয়ে সকালে দু\'পক্ষের নারীদের মধ্যে কথা কাটাকাটি হয়। একপর্যায়ে উভয় পক্ষের লোকজন দেশীয় অস্ত্র নিয়ে সংঘর্ষে জড়িয়ে পড়ে। প্রায় ৩ ঘন্টা ব্যাপী সংঘর্ষে উভয়পক্ষের নারী-পুরুষসহ শতাধিক লোক আহত হয়েছে।</p><p> আহতদের হবিগঞ্জ সদর হাসপাতালে আনা হলে কর্তব্যরত চিকিৎসক টেটাবিদ্ধ অন্তত ১৫ জনকে গুরুতর অবস্থায় ঢাকা ও সিলেট প্রেরণ করেন।\r\n\r\nবানিয়াচং থানার ওসি গোলাম মোস্তফা জানান, এলাকায় আধিপত্য বিস্তারকে কেন্দ্র করে উত্তর সাঙ্গর গ্রামের আলাউদ্দিন মেম্বার ও নূরুল হুদার মধ্যে দীর্ঘদিন ধরে বিরোধ চলে আসছিল। সকালে আলাউদ্দিন মেম্বারের পক্ষের আইয়ুব আলীর একটি গরু নূরুল হুদা\'র পক্ষের হামিদা বেগমের ধানের খড় খায়। খবর পেয়ে পুলিশ ঘটনাস্থলে পৌঁছে পরিস্থিতি নিয়ন্ত্রণে আনে। এসময় ২ রাউন্ড টিয়ারশেল নিক্ষেপ করা হয়।\r\n\r\nওসি বলেন, বর্তমানে পরিস্থিতি শান্ত রয়েছে। এলাকায় অতিরিক্ত পুলিশ মোতায়েন করা হয়েছে।</p>', 1, NULL, 1, 0, 0, 0, 0, 'বানিয়াচঙ্গে-গরুর-খড়-খাওয়াকে-কেন্দ্র-করে-টেটাযুদ্ধ,-শতাধিক-আহত', 'news_image_8b18fb87dd0a46752ac28d5b0e7690551746445390.jpg', 'বানিয়াচঙ্গে টেটাযুদ্ধ', 48, 'ডেস্ক রিপোর্ট', 1, '2025-05-05 05:43:10', '2025-05-23 02:52:27', 'হবিগঞ্জের বানিয়াচংয়ে গরুতে ধানের খড় খাওয়াকে কেন্দ্র করে টেটা যুদ্ধে প্রায় ৩ ঘন্টাব্যাপী সংঘর্ষের ঘটনা ঘটেছে', 'বানিয়াচঙ্গে টেটাযুদ্ধ', 'বানিয়াচঙ্গে, টেটাযুদ্ধ'),
(2, 'হাওরে কোটি টাকার গর্ত ভরাট প্রকল্প কবে শেষ হবে?', '', 16, '<p>সুনামগঞ্জের বিভিন্ন হাওরে ফসলরক্ষা বাঁধের পাশে ‘কোর’ বা গর্ত ভরাট (ডিচ ফিলিং) প্রকল্পের মেয়াদ শেষ হতে চললেও অনেক হাওরে শুরু হয়নি কাজ। জলমহাল ইজারাদার ও জমির মালিকদের বাধাসহ ঠিকাদারী প্রতিষ্ঠানের নানা অজুহাতে অনিশ্চিয়তার মুখে ২৪ কোটি টাকার গুরুত্বপূর্ণ এই প্রকল্পটি। ফসলরক্ষা বাঁধ টেকসই, জীববৈচিত্র্য ও গোচারণ ভূমি রক্ষায় দ্রুত সময়ে কাজ বাস্তবায়নের দাবি হাওর পাড়ের কৃষকদের।\r\n</p><p>\r\nজানা যায়, পাহাড় থেকে আসা প্রবল পানির স্রোতে বাঁধ ভেঙে হাওরে প্রবেশ করে বাঁধের কিনারে সৃষ্টি করে বড় বড় গর্ত। আর এই গর্তের কারণে প্রতিবছর ফসলরক্ষা বাঁধের সুরক্ষা নিয়ে দুঃশ্চিতায় থাকতে হয় কৃষকদের। তাই, বাঁধের পাশের গভীর গর্তের কারণে যাতে ফসলরক্ষা বাঁধ বর্ষায় বা আগাম বন্যার ঝুঁকিতে না পড়ে সেই উদ্দেশ্যে জরুরি বন্যা প্রতিরক্ষা বাঁধ পুনঃনির্মাণ সহায়তা প্রকল্পের আওতায় জেলার দশ উপজেলায় চারটি ঠিকাদারী প্রতিষ্ঠানের মাধ্যমে প্রায় ২৪ কোটি টাকা ব্যয়ে মাটি ভরাটের কাজ করছে পানি উন্নয়ন বোর্ড।\r\n\r\nতার মধ্যে রাজধানী ঢাকার ঠিকাদারী প্রতিষ্ঠান এসএস বিল্ডার্স সাড়ে ৫ কোটি টাকা, টাঙ্গাইলের ঠিকাদারী প্রতিষ্ঠান গুডম্যান এন্টারপ্রাইজ ৬ কোটি ৯২ লাখ টাকা, রাজধানী ঢাকার শাহ ড্রেজার ঠিকাদারী প্রতিষ্ঠান ৩ কোটি টাকা ও নেত্রকোণার অসীম সিংহ নামের ঠিকাদারী প্রতিষ্ঠান ৭ কোটি ৪৮ লাখ টাকার কাজ করছে।</p><p> ২০২৪ সালের জানুয়ারিতে নেওয়া এই প্রকল্পের মেয়াদ চলতি মে মাসে শেষ হওয়ার কথা থাকলেও এখনো অনেক হাওরে কাজই শুরু করতে পারেনি সংশ্লিষ্ট ঠিকাদারি প্রতিষ্ঠান।\r\n\r\nহাওরে জলমহাল ইজারাদারদের নিষেধাজ্ঞা, জমির মালিকদের বাধা ও বরাদ্দ জটিলতার কারণসহ ঠিকাদারী প্রতিষ্ঠানের বেখেয়ালিপানায় অনিশ্চয়তায় পড়েছে গুরুত্বপূর্ণ এই প্রকল্পটি।\r\n\r\nনদী থেকে ড্রেজিংয়ের মাধ্যমে বিটবালু দিয়ে গর্ত (ডিচ ফিলিং) ভরাটের কথা থাকলেও বেশিরভাগ হাওরে জলমহাল ইজারাদারদের বাধার মুখে পড়তে হচ্ছে প্রকল্প সংশ্লিষ্ট ঠিকাদারদের। কোথাও কোথাও কাজ শুরু করা হলেও ইজারাদার ও ফসলি জমির মালিকদের বাধার মুখে কাজ ফেলে রেখে আসতে হয়েছে সংশ্লিষ্টদের।\r\n\r\nএদিকে, প্রকল্পের এমন অবস্থায় নির্ধারিত সময়ে কাজ শেষ হওয়া নিয়ে দেখা দিয়েছে অনিশ্চয়তা। ঝুঁকিপূর্ণ গর্ত ভরাট না হলে বাঁধের স্থায়িত্ব নিয়ে শঙ্কার কথা জানিয়েছেন কৃষকরা।\r\n\r\nসরেজমিনে তাহিরপুর উপজেলার বড়দল গ্রামে আলমখালি স্থায়ী বাঁধে গিয়ে দেখা যায় বাঁধের কিনারে কিছু কিছু স্থানে বিট বালি ফেলা রয়েছে। তবে গর্ত ভরাট কাজ অসম্পূর্ণ থাকতে দেখা গেছে। </p><p>এই এলাকায় আরও দুইটি স্থানে গর্ত ভরাটের কথা থাকলেও এখনো কাজ শুরু করেনি সংশ্লিষ্ট ঠিকাদারী প্রতিষ্ঠান।\r\n\r\nকৃষকরা জানিয়েছেন, ড্রেজার মেশিন দিয়ে আলমখালীতে কিছুদিন মাটি ফেলার পর সবকিছু নিয়ে চলে গেছে ঠিকাদারের লোকেরা। কি কারণে কাজ না করে তারা চলে গেছে এ বিষয়ে কেউ জানেনা।\r\n\r\nবড়দল গ্রামের সাদিকুর রহমান বলেন, কিছু দিন আগে দেখেছি বালি ফেলে গর্ত ভরাট করা হচ্ছে কিন্তু আবার সবকিছু বন্ধ করে তারা চলে গেছে। গর্ত ভরাট বাঁধের জন্য অনেক গুরুত্বপূর্ণ। বাঁধের পাশের গর্তের কারণে বাঁধ ঝুঁকিতে থাকে। নদীতে পানির চাপ বাড়লে বাঁধ ভেঙে যাওয়ার আশঙ্কা থাকে।\r\n\r\nতরিকুল নামে আরেক বাসিন্দা বলেন, সরকার টাকা দিছে গর্ত ভরাট করতে কিন্তু গর্ত ভরাট হয়নি। শুনেছি জলমহাল ইজারাদার নাকি মাটি ভরাটে বাধা দিয়েছে। তারা কি কারণে বাধা দিয়েছে তা আমাদের জানা নেই।</p><p> তবে মাটির গর্ত ভরাটে কৃষকদের পক্ষ থেকে কোনো বাধা দেয়া হয়নি বলে জানান তিনি।\r\n\r\nতবে আলমখালি মাটি ভরাট কাজের ঠিকাদারী প্রতিষ্ঠান গুডম্যান এন্টারপ্রাইজের প্রতিনিধি ভজন তালুকদার জানান, নির্ধারিত সময়ে কাজ শেষ করতে চেষ্টা রয়েছে তাদের কিন্তু জলমহাল মালিকদের বাধার মুখে অনেক স্থানে কাজ করতে পারছেন না তারা। কোথাও কোথাও কৃষকরাও বাধা দিচ্ছেন। কৃষকরা বলছে বিট বালিতে তাদের জমি নষ্ট হবে। এই অবস্থায় কাজ বাস্তবায়ন করতে নানা প্রতিবন্ধকতার শিকার হচ্ছেন বলে জানান ভজন তালুকদার।\r\n\r\nহাওরের বাঁধের গর্ত ভরাট (ডিচ ফিলিং) প্রকল্প শেষ না হওয়ায় ও সরকারি টাকা গচ্ছা যাওয়ার শঙ্কার কথা জানিয়ে হাওর বাঁচাও আন্দোলন জেলা কমিটি সাধারণ সম্পাদক ওবায়দুল হক মিলন বলেন, মাটি ভরাট প্রকল্পের অগ্রগতি অন্তোষজনক। হাওরের যেসকল গর্ত ভরাটে জন্য প্রাক্কলন করা হয়েছে তার কিছু কিছু গর্ত জলমহাল মালিকদের ইজারায় থাকায় তারা বাধা দিচ্ছে। </p><p>কোনো কোনো ক্ষেত্রে ঠিকাদারদের গাফিলতি পরিলক্ষিত হচ্ছে। জেলা প্রশাসন ও পানি উন্নয়ন বোর্ডের সুষ্ঠু সমন্বয় না হলে এই প্রকল্পের কাজ শেষ হবে না। মাঝ পথে সরকারের এতোগুলো টাকা গচ্ছা যাবে।\r\n\r\nসুনামগঞ্জ পানি উন্নয়ন বোর্ডের নির্বাহী প্রকৌশলী মামুন হাওলদার বলেন, বাঁধকে টেকসই করতে বাঁধের নিকটবর্তী গর্ত ভরাটের প্রকল্প চলমান রয়েছে। এসব গর্তের কিছু কিছু জলমহালের আওতায় লীজ নেয়া। ইজারাদাররা গর্ত ভরাট করতে বাধা দিচ্ছেন। কয়েকটি উপজেলা নির্বাহী কর্মকর্তার মাধ্যমে গর্ত ভরাট না করতে আমাদেরকে চিঠি দেয়া হয়েছে। আমরা এ বিষয়গুলো নিয়ে সংশ্লিষ্টদের সহযোগিতা চেয়েছি। নির্ধারিত সময়ের মধ্যে কাজ শেষ করতে সংশ্লিষ্ট ঠিকাদারদের নির্দেশনা দেয়া হয়েছে বলে জানান এই কর্মকর্তা। কর্তৃপক্ষের তৎপরতায় হাওরের ঝুঁকিপূর্ণ গর্ত ভরাট প্রকল্পের কাজ নির্ধারিত সময়ে শেষ হবে এমনটাই প্রত্যাশা কৃষকদের।</p>', 1, NULL, 1, 0, 0, 0, 0, 'হাওরে-কোটি-টাকার-গর্ত-ভরাট-প্রকল্প-কবে-শেষ-হবে?', 'news_image_3616c1cb14f61aa4706a3e56161712f11746506881.jpg', 'হাওর গর্ত ', 43, 'ডেস্ক রিপোর্ট', 1, '2025-05-06 10:48:01', '2025-05-23 02:52:26', 'সুনামগঞ্জের বিভিন্ন হাওরে ফসলরক্ষা বাঁধের পাশে ‘কোর’ বা গর্ত ভরাট (ডিচ ফিলিং) প্রকল্পের মেয়াদ শেষ হতে চললেও অনেক হাওরে শুরু হয়নি কাজ। জলমহাল ইজারাদার', 'হাওর গর্ত ', 'হাওরে, গর্ত ভরাট, প্রকল্প'),
(3, 'মৌলভীবাজারে ৩টি চোরাই সিএনজিসহ গ্রেপ্তার ৪', '', 12, '<p>মৌলভীবাজারের বড়লেখা থানা পুলিশের অভিযানে তিনটি রেজিস্ট্রেশনবিহীন চোরাই সিএনজিচালিত অটোরিকশাসহ চোর চক্রের ৪ সদস্যকে গ্রেপ্তার করেছে পুলিশ। আটকরা হলেন- মৌলভীবাজার জেলার বড়লেখা উপজেলার চন্দ্রগ্রাম গ্রামের রাজন আহমেদ মাসুম (২৪), সিলেট জেলার ওসমানীনগর উপজেলার শষারকান্দি গ্রামের সাইফুল ইসলাম (১৯), পূর্ব মোবারকপুর গ্রামের মোস্তাকিম আহমেদ নাহিদ (২০) ও সাইটধা গ্রামের সিরাজুল ইসলাম (১৯)।\r\n</p><p>\r\nমঙ্গলবার ভোরে বড়লেখা উপজেলার দাসের বাজার এলাকা থেকে তাদেরকে আটক করা হয়।\r\n\r\nবড়লেখা থানার ওসি মো. আবুল কাশেম সরকার জানান, থানার দাসেরবাজার সিএনজি স্ট্যান্ডে তিনজন সন্দেহভাজনসহ একটি চোরাই সিএনজি স্থানীয় জনতা আটক করে রেখেছে, এমন সংবাদ পেয়ে পুলিশ ঘটনাস্থলে পৌঁছে মোস্তাকিম, সাইফুল ও সিরাজুল ইসলাম নামে ৩ জনকে আটক করে এবং একটি নম্বরবিহীন সিএনজি উদ্ধার করে।</p><p>\r\n\r\nতিনি বলেন, প্রাথমিক জিজ্ঞাসাবাদে তারা সিলেটের দক্ষিণ সুরমা এলাকা থেকে সিএনজি চুরি করে বড়লেখার রাজন আহমদ মাসুমের কাছে বিক্রির জন্য এনেছে বলে স্বীকার করে।\r\n\r\nওসি জানান, তাদের দেওয়া তথ্য অনুযায়ী রাজন আহমদ মাসুমকে চান্দগ্রামে তার বাড়ি থেকে আটক করা হয় এবং তার হেফাজতে থাকা আরও ২টি চোরাই সিএনজি উদ্ধার করা হয়।\r\n\r\nওসি আরও জানান, এই চক্রটি দীর্ঘদিন ধরে সিলেট, মৌলভীবাজারসহ বিভিন্ন এলাকায় চোরাই যানবাহন ক্রয়-বিক্রয়ের সঙ্গে জড়িত। তাদের বিরুদ্ধে চুরি ও চোরাই মালামাল ক্রয়-বিক্রয়ের অপরাধে মামলা দায়ের করা হয়েছে।</p>', 1, NULL, 0, 1, 0, 0, 0, 'মৌলভীবাজারে-৩টি-চোরাই-সিএনজিসহ-গ্রেপ্তার-৪', 'news_image_216f85d35397b1c008ec3406c312f9b31746522007.jpg', 'চোরাই সিএনজি', 43, 'ডেস্ক রিপোর্ট', 1, '2025-05-06 03:00:07', '2025-05-23 04:52:14', 'মৌলভীবাজারের বড়লেখা থানা পুলিশের অভিযানে তিনটি রেজিস্ট্রেশনবিহীন চোরাই সিএনজিচালিত অটোরিকশাসহ চোর চক্রের ৪ সদস্যকে গ্রেপ্তার করেছে পুলিশ। আটকরা হলেন', 'চোরাই সিএনজি', 'চোরাই, সিএনজি');

-- --------------------------------------------------------

--
-- Table structure for table `tblseo`
--

CREATE TABLE `tblseo` (
  `id` int(11) NOT NULL,
  `data` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblseo`
--

INSERT INTO `tblseo` (`id`, `data`) VALUES
(1, NULL),
(2, '\r\n       '),
(3, 'erwtw');

-- --------------------------------------------------------

--
-- Table structure for table `tblstory`
--

CREATE TABLE `tblstory` (
  `id` int(11) NOT NULL,
  `StoryTitle` varchar(200) DEFAULT NULL,
  `StoryImage` varchar(200) DEFAULT NULL,
  `PhotoStory` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblstory`
--

INSERT INTO `tblstory` (`id`, `StoryTitle`, `StoryImage`, `PhotoStory`) VALUES
(4, 'test story', '8b18fb87dd0a46752ac28d5b0e769055.jpg', '<p>fadsfd</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 5, 'Bollywood ', 'Bollywood masala', '2018-06-22 13:45:38', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblvideo`
--

CREATE TABLE `tblvideo` (
  `id` int(11) NOT NULL,
  `ImageTitle` varchar(200) DEFAULT NULL,
  `VideoLink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tblvideo`
--

INSERT INTO `tblvideo` (`id`, `ImageTitle`, `VideoLink`) VALUES
(9, 'বিপিএলের জন্য প্রস্তুত হচ্ছে সিলেট আন্তর্জাতিক ক্রিকেট স্টেডিয়াম', 'https://www.youtube.com/embed/G_qkN8f6NEM?si=gt1U0mS_ZpeABqXo'),
(10, ' রমজানের দুই মাস আগেই দাম বেড়েছে ছোলা-মটর-ডালের ', 'https://www.youtube.com/embed/KCQEJZLD0pI?si=okV_1QVYmMmCsr1v'),
(11, 'সিলেট জিন্দাবাজারে মোবাইল চুর আটক', 'https://www.youtube.com/embed/tl01nlR_RNM?si=akyf1bjwrEcPHcuK'),
(12, ' সিলেট নগরীর বর্ধিত ওয়ার্ডসমূহের উন্নয়ন নিয়ে যা বললেন মেয়র আনোয়ারুজ্জামান চৌধুরী ', 'https://www.youtube.com/embed/UFVjyKAFoU8?si=xbbP3-fUW8YrdqZX'),
(13, 'দক্ষতা বাড়ানোর মাধ্যমে ভালো মানের সেবা দেয়া সম্ভব : সিসিক মেয়র! ', 'https://www.youtube.com/embed/axO4yypR-YM?si=IcK9SgLu-f_BudSL'),
(14, 'ওসমানী নগরে বিজ্ঞান ও প্রযুক্তি মেলা!', 'https://www.youtube.com/embed/l3eQdViRblQ?si=DwwYKgU1zA4i4-sA'),
(15, 'সড়ক দুর্ঘটনায় আহত পুলিশ কর্মকর্তাদের শয্যাপাশে প্রবাসীকল্যাণ প্রতিমন্ত্রী', 'https://youtu.be/1mg8rssGMBs?si=zKLLmKhrqiidoEFE'),
(16, 'তেমুখি শাহজালাল ব্রিজ যেন মরণফাঁদ', 'https://www.youtube.com/watch?v=54s9E3fBlAk'),
(19, 'প্রতিমন্ত্রী শফিক চৌধুরীর সংবর্ধনা অনুষ্ঠানে চেয়ার ভাংচুর!', 'https://youtu.be/qOQomGIpL74?si=ffMglx_91FV1YMRc'),
(20, 'বাংলাদেশ বনাম শ্রীলঙ্কা টি টুয়েন্টি ম্যাচে \'ভূয়া ভূয়া\' স্লোগান!', 'https://youtu.be/E491LpY0l7o?si=1lXhVMxdyGarOF9p'),
(21, 'সড়ক দুর্ঘটনায় জনপ্রিয় সংগীতশিল্পী পাগল হাসান নিহত', 'https://youtu.be/sCnya5zDZbM'),
(23, 'পেটের তাগিদে বৈঠা হাতে পঞ্চাশউর্ধ বিধবা নারীমাঝি রিনাবেগম!', 'https://youtu.be/jhcgmJmYmxk?si=YFdARTsHSCnrN4JN'),
(24, 'সুরমা নদীতে পরিচ্ছন্নতা অভিযানে সিসিক মেয়র আনোয়ারুজ্জামান চৌধুরী', 'https://youtu.be/e1QTq1317Io');

-- --------------------------------------------------------

--
-- Table structure for table `tblwetget`
--

CREATE TABLE `tblwetget` (
  `id` int(11) NOT NULL,
  `WetGet` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblwetget`
--

INSERT INTO `tblwetget` (`id`, `WetGet`) VALUES
(1, 'xxyz'),
(2, '			');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporter`
--
ALTER TABLE `reporter`
  ADD PRIMARY KEY (`reporterID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblads`
--
ALTER TABLE `tblads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfamily`
--
ALTER TABLE `tblfamily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblhomeslider`
--
ALTER TABLE `tblhomeslider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category_id` (`CategoryId`),
  ADD KEY `idx_created_at` (`UpdationDate`),
  ADD KEY `idx_visibility` (`Is_Active`);

--
-- Indexes for table `tblseo`
--
ALTER TABLE `tblseo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstory`
--
ALTER TABLE `tblstory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`);

--
-- Indexes for table `tblvideo`
--
ALTER TABLE `tblvideo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblwetget`
--
ALTER TABLE `tblwetget`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reporter`
--
ALTER TABLE `reporter`
  MODIFY `reporterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblads`
--
ALTER TABLE `tblads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblfamily`
--
ALTER TABLE `tblfamily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblhomeslider`
--
ALTER TABLE `tblhomeslider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblseo`
--
ALTER TABLE `tblseo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblstory`
--
ALTER TABLE `tblstory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblvideo`
--
ALTER TABLE `tblvideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblwetget`
--
ALTER TABLE `tblwetget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

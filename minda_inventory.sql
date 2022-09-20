-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2022 at 07:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minda_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposals`
--

CREATE TABLE `disposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cy_date` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isok` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disposal__details`
--

CREATE TABLE `disposal__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `d_id` bigint(20) UNSIGNED NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_date` date NOT NULL,
  `activity_date_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspection_and__acceptances`
--

CREATE TABLE `inspection_and__acceptances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cluster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `po_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsibility_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `papcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iar_date` date DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `inspector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_inspected` date DEFAULT NULL,
  `receiver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_receive` date DEFAULT NULL,
  `iscomplete` int(11) NOT NULL DEFAULT 0,
  `is_updated` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inspection_and__acceptances`
--

INSERT INTO `inspection_and__acceptances` (`id`, `entity_name`, `cluster`, `supplier`, `po_number`, `department`, `responsibility_code`, `papcode`, `iar_no`, `iar_date`, `invoice_no`, `invoice_date`, `inspector`, `date_inspected`, `receiver`, `date_receive`, `iscomplete`, `is_updated`, `type`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'MINDANAO DEVELOPMENT AUTHORITY', '101', 'V.S. Tay Supplies', '345235345', 'KMD Regular', 'KMD Regular', 'KMD ISSP PuRD 200000100002', '2022-0002', '2022-01-10', '34535345', '2022-01-10', 'dsfsfd', '2022-01-10', NULL, '2022-01-10', 1, 0, 'iar', NULL, '2022-01-09 23:18:26', '2022-01-09 23:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pap_codes`
--

CREATE TABLE `pap_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respocenter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `papcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pap_codes`
--

INSERT INTO `pap_codes` (`id`, `division`, `respocenter`, `papcode`, `created_at`, `updated_at`) VALUES
(1, 'AMO CM', 'AMO CM Regular', 'AMO 310200100000 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(2, 'AMO NEM', 'AMO NEM Regular', 'AMO 310200100000 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(3, 'AMO NM', 'AMO NM Regular', 'AMO 310200100000 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(4, 'AMO WM', 'AMO WM Regular', 'AMO 310200100000 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(5, 'OACPM', 'OACPM', 'AMO 310200100000 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(6, 'IPD Regular', 'IPD Regular', 'IPD MCT Halal MIAD 310300100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(7, 'IPD MCT', 'IPD MCT', 'IPD MCT Halal MIAD 310300100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(8, 'IPD Halal', 'IPD Halal', 'IPD MCT Halal MIAD 310300100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(9, 'IPD MIAD', 'IPD MIAD', 'IPD MCT Halal MIAD 310300100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(10, 'Investment Promo', 'Investment Promo', 'IPD MCT Halal MIAD 310300100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(11, 'IRD Regular', 'IRD Regular', 'IRD 310300100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(12, 'BIMP-EAGA', 'BIMP-EAGA', 'IRD 310300100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(13, 'OED ISO', 'OED ISO', 'ISO PMU 200000100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(14, 'OED PMU', 'OED PMU', 'ISO PMU 200000100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(15, 'STO OFAS', 'STO OFAS', 'ISO PMU 200000100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(16, 'KMD Regular', 'KMD Regular', 'KMD ISSP PuRD 200000100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(17, 'KMD ISSP', 'KMD ISSP', 'KMD ISSP PuRD 200000100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(18, 'STO PPPDO', 'STO PPPDO', 'KMD ISSP PuRD 200000100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(19, 'AMO CM CONTINUING', 'AMO CM CONTINUING', 'AMO 310200100000 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(20, 'IRD CONTINUING', 'IRD CONTINUING', 'IRD 310300100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(21, 'KMD CONTINUING', 'KMD CONTINUING', 'KMD ISSP PuRD 200000100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(22, 'OC CONTINUING', 'OC CONTINUING', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(23, 'PDD CONTINUING', 'PDD CONTINUING', 'PDD PPP 310100100002', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(24, 'PRD CONTINUING', 'PRD CONTINUING', 'PRD MDC PFD 310100100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(25, 'PuRD Regular', 'PuRD Regular', 'KMD ISSP PuRD 200000100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(26, 'STO IPPAO', 'STO IPPAO', 'KMD ISSP PuRD 200000100002 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(27, 'OC Legal', 'OC Legal', 'LEGAL 200000100003 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(28, 'STO OC', 'STO OC', 'LEGAL 200000100003 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(29, 'OC Regular', 'OC Regular', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(30, 'GAS OC', 'GAS OC', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(31, 'OED Regular', 'OED Regular', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(32, 'GAS OED', 'GAS OED', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(33, 'AD Regular', 'AD Regular', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(34, 'FD Regular', 'FD Regular', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(35, 'GAS OFAS', 'GAS OFAS', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(36, 'AD Continuing', 'AD Continuing', 'OC OED AD FD 1000000100001', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(37, 'IPD Continuing', 'IPD Continuing', 'IPD MCT Halal MIAD 310300100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(38, 'ISO Continuing', 'ISO Continuing', 'ISO PMU 200000100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(39, 'PRD Regular', 'PRD Regular', 'PRD MDC PFD 310100100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(40, 'PFD Regular', 'PFD Regular', 'PRD MDC PFD 310100100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(41, 'PRD MDC', 'PRD MDC', 'PRD MDC PFD 310100100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(42, 'Planning&Policy', 'Planning&Policy', 'PRD MDC PFD 310100100001 ', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(43, 'PDD Regular', 'PDD Regular', 'PDD PPP 310100100002', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(44, 'PDD PPP', 'PDD PPP', 'PDD PPP 310100100002', '2020-07-07 00:03:42', '2020-07-07 00:03:42'),
(45, 'Project Dev', 'Project Dev', 'PDD PPP 310100100002', '2020-07-07 00:03:42', '2020-07-07 00:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `par_counts`
--

CREATE TABLE `par_counts` (
  `id` bigint(20) NOT NULL,
  `year` int(11) NOT NULL,
  `project_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_counts`
--

CREATE TABLE `project_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `project_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_and__maintenances`
--

CREATE TABLE `repair_and__maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `are_sticker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pre_findings` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pre_recommendation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pre_inspector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pre_date_inspector` date NOT NULL,
  `job_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_date_job` date NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_date_invoice` date NOT NULL,
  `amount` double NOT NULL,
  `payable` double NOT NULL,
  `post_findings` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_inspector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repair_update` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ris_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `respo_center` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `papcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requested_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requested_by_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_request` date DEFAULT NULL,
  `approve_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_by_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_approve` date DEFAULT NULL,
  `issued_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issued_by_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_issued` date DEFAULT NULL,
  `recieve_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recieve_by_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_receive` date DEFAULT NULL,
  `complete` int(11) NOT NULL DEFAULT 0,
  `purpose` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `ris_num`, `division`, `office`, `respo_center`, `papcode`, `requested_by`, `requested_by_pos`, `date_request`, `approve_by`, `approve_by_pos`, `date_approve`, `issued_by`, `issued_by_pos`, `date_issued`, `recieve_by`, `recieve_by_pos`, `date_receive`, `complete`, `purpose`, `created_at`, `updated_at`) VALUES
(1, NULL, 'KMD Regular', 'Davao City', 'KMD Regular', 'KMD ISSP PuRD 200000100002', 'joules', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'sadasdasdasdasds', '2022-01-09 23:21:05', '2022-01-09 23:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `sign_settings`
--

CREATE TABLE `sign_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `RPCIInvCommitteeChair` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPCIInvCommitteeMember` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPCIOICChair` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPCICOARep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPCIFinDivRep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IARInpector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IARInpectorPos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IARSupplyOfficer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IARSupplyOfficerPos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assume_date` date DEFAULT NULL,
  `RSMIAccClerk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sign_settings`
--

INSERT INTO `sign_settings` (`id`, `RPCIInvCommitteeChair`, `RPCIInvCommitteeMember`, `RPCIOICChair`, `RPCICOARep`, `RPCIFinDivRep`, `IARInpector`, `IARInpectorPos`, `IARSupplyOfficer`, `IARSupplyOfficerPos`, `assume_date`, `RSMIAccClerk`, `created_at`, `updated_at`) VALUES
(2, 'wecrwerew', 'wcrercew', 'wercwerewr', 'cwre32434324', 'ewrcwercwe', 'wercwerewr', 'wecrwer', 'wwerecerewr', 'wercwerwer', '2021-06-15', 'wercwwer', '2021-06-14 22:04:17', '2021-06-14 22:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `stock_libs`
--

CREATE TABLE `stock_libs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reorderpoint` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `summaries`
--

CREATE TABLE `summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `series_id` int(11) DEFAULT NULL,
  `ris_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cluster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `papcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `respo_center` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `stock_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `isavail` int(11) NOT NULL DEFAULT 0,
  `available` int(11) NOT NULL DEFAULT 0,
  `partial` int(11) NOT NULL DEFAULT 0,
  `partialy_serve` int(11) NOT NULL DEFAULT 0,
  `partial_quantity` bigint(20) NOT NULL DEFAULT 0,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supply_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complete` int(11) NOT NULL DEFAULT 0,
  `serve` int(11) NOT NULL DEFAULT 0,
  `consume_days` int(11) NOT NULL DEFAULT 0,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `report_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `re_order` int(11) NOT NULL DEFAULT 0,
  `requested_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requested_by_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prop_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_receive` date DEFAULT NULL,
  `cy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2020',
  `par_ics_series` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `summaries`
--

INSERT INTO `summaries` (`id`, `reference_id`, `series_id`, `ris_num`, `entity_name`, `cluster`, `supplier`, `papcode`, `division`, `respo_center`, `invoice_no`, `invoice_date`, `stock_number`, `description`, `item`, `unit`, `cost`, `quantity`, `isavail`, `available`, `partial`, `partialy_serve`, `partial_quantity`, `category`, `type`, `supply_type`, `complete`, `serve`, `consume_days`, `remarks`, `image`, `report_date`, `re_order`, `requested_by`, `requested_by_pos`, `prop_num`, `date_receive`, `cy`, `par_ics_series`, `physical_count`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'MINDANAO DEVELOPMENT AUTHORITY', '101', 'V.S. Tay Supplies', 'KMD ISSP PuRD 200000100002', 'KMD Regular', 'KMD Regular', '34535345', '2022-01-10', NULL, 'as scdsfd safsdfdf dsaf', 'as scdsfd safsdfdf dsaf', 'pcs', '1000.00', 15, 0, 10, 0, 0, 0, 'StockCard', 'iar', NULL, 0, 0, 0, NULL, 'noimage.jpg', '1-2022', 0, NULL, NULL, NULL, NULL, '2020', NULL, 0, '2022-01-09 23:19:33', '2022-01-09 23:19:33'),
(2, 1, NULL, NULL, 'MINDANAO DEVELOPMENT AUTHORITY', '101', 'V.S. Tay Supplies', 'KMD ISSP PuRD 200000100002', 'KMD Regular', 'KMD Regular', '34535345', '2022-01-10', NULL, 'asdfsafasdfs', 'asdfsafasdfs', 'box', '100.00', 50, 0, 10, 0, 0, 0, 'StockCard', 'iar', NULL, 0, 0, 0, NULL, 'noimage.jpg', '1-2022', 0, NULL, NULL, NULL, NULL, '2020', NULL, 0, '2022-01-09 23:20:00', '2022-01-09 23:20:00'),
(3, 2, 1, NULL, 'MINDANAO DEVELOPMENT AUTHORITY', '101', NULL, 'KMD ISSP PuRD 200000100002', 'KMD Regular', 'KMD Regular', NULL, NULL, NULL, 'as scdsfd safsdfdf dsaf', 'as scdsfd safsdfdf dsaf', 'pcs', '1000.00', 5, 0, 10, 0, 0, 0, 'StockCard', 'ris', NULL, 0, 0, 0, NULL, 'noimage.jpg', NULL, 0, 'joules', NULL, NULL, NULL, '2020', NULL, 0, '2022-01-09 23:21:35', '2022-01-09 23:21:35'),
(4, 2, 1, NULL, 'MINDANAO DEVELOPMENT AUTHORITY', '101', NULL, 'KMD ISSP PuRD 200000100002', 'KMD Regular', 'KMD Regular', NULL, NULL, NULL, 'as scdsfd safsdfdf dsaf', 'as scdsfd safsdfdf dsaf', 'pcs', '1000.00', 5, 0, 10, 0, 0, 0, 'StockCard', 'ris', NULL, 0, 0, 0, NULL, 'noimage.jpg', NULL, 0, 'joules', NULL, NULL, NULL, '2020', NULL, 0, '2022-01-09 23:22:18', '2022-01-09 23:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `f_name`, `email`, `email_verified_at`, `password`, `position`, `division`, `remember_token`, `created_at`, `updated_at`) VALUES
(680, 'joules', 'RICO, JOLITO D', 'joules.rico@gmail.com', '2020-11-20 21:07:37', '$2y$10$uMraG6DRP3ONBcBLrybiqe/RYyuqi82w5vJvRCVS0q3fgBegarb.S', 'Software Developer', 'KMD Regular', NULL, '2020-11-20 21:07:37', '2020-11-20 21:07:37'),
(681, 'joules', 'RICO, JOLITO D', 'jolito.rico@minda.gov.ph', NULL, '$2y$10$uMraG6DRP3ONBcBLrybiqe/RYyuqi82w5vJvRCVS0q3fgBegarb.S', 'SOFTWARE DEVELOPER', NULL, NULL, NULL, NULL),
(682, 'rtejano', 'TEJANO, RAYMOND R', 'raymond.tejano@minda.gov.ph,rtejano@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'ITO II', NULL, NULL, NULL, NULL),
(683, 'msullano', 'SULLANO, MARLO D', 'marlo.sullano@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(684, 'rgador', 'RAMOS, ROXENNE G', 'roxenne.gador@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'DMO I', NULL, NULL, NULL, NULL),
(685, 'cescano', 'ESCANO, CHARLITA A', 'charlie.escano@minda.gov.ph, charandalesescano@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Director IV', NULL, NULL, NULL, NULL),
(686, 'eancheta', 'ANCHETA, EDWIN V', 'edwin.ancheta@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Finance Assistant', NULL, NULL, NULL, NULL),
(687, 'rtan', 'TAN, REYZALDY B', 'reyzaldy.tan@minda.gov.ph, mikong_rt@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Director IV', NULL, NULL, NULL, NULL),
(688, 'lbruce', 'BRUCE, LADY LYN A', 'lady.albarico@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(689, 'hdecastro', 'DE CASTRO, HELEN ', 'helen.decastro@minda.gov.ph,decastro_h@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(690, 'rcastillo', 'CASTILLO, ROMMEL S', 'rommel.castillo@minda.gov.ph,rscastle.ph@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Chief Administrative Officer', NULL, NULL, NULL, NULL),
(691, 'hpurugganan', 'PURUGGANAN, HERLYN G', 'neng.gallo@minda.gov.ph,nenggallo74@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Supervising Administrative Officer', NULL, NULL, NULL, NULL),
(692, 'greynaldo', 'REYNALDO, GERARDO RAMON CESAR ', 'gerardo.reynaldo@minda.gov.ph,jojo_rsg@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(693, 'ssantiago', 'SANTIAGO, SHARON D', 'sharon.santiago@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Officer V', NULL, NULL, NULL, NULL),
(694, 'odagala', 'DAGALA, OLIE B', 'olie.dagala@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Director III', NULL, NULL, NULL, NULL),
(695, 'jcristobal', 'CRISTOBAL, JASPER ', 'jasper.cristobal@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'ISA', NULL, NULL, NULL, NULL),
(696, 'kmateo', 'MATEO, KATHY MAR S', 'kathymar.mateo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer IV', NULL, NULL, NULL, NULL),
(697, 'rmontenegro', 'MONTENEGRO, ROMEO M', 'romeo.montenegro@minda.gov.ph,yomontenegro@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Deputy Executive Director', NULL, NULL, NULL, NULL),
(698, 'ecajilig', 'CAJILIG, EDWIN ', 'edwin.cajilig@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative AIDE III', NULL, NULL, NULL, NULL),
(699, 'nyago', 'YAGO, NINA R', 'nina.yago@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(700, 'mcaagoy', 'CAAGOY, MARICEL L', 'mariz.caagoy@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Officer I', NULL, NULL, NULL, NULL),
(701, 'iquizo', 'QUIZO, IRIS MAE F', 'iris.ferraris@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Information officer II', NULL, NULL, NULL, NULL),
(702, 'gcapulong', 'CAPULONG, GINA RUTH C', 'ginaruth.capulong@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(703, 'fprieto', 'PRIETO, FLAVIA C', 'flavia.prieto@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative AIDE IV', NULL, NULL, NULL, NULL),
(704, 'msarigumba', 'SARIGUMBA, MARIVIC ', 'marivic.sarigumba@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Officer IV', NULL, NULL, NULL, NULL),
(705, 'jduarte', 'DUARTE JR., JOSELITO R', 'joselito.duarte@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative AIDE IV', NULL, NULL, NULL, NULL),
(706, 'gmalnegro', 'MALNEGRO, GENEROSO T', 'generoso.malnegro@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative AIDE IV', NULL, NULL, NULL, NULL),
(707, 'aleparto', 'LEPARTO, ARGIE S', 'argie.leparto@minda.gov.ph, argie_lee2@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer IV', NULL, NULL, NULL, NULL),
(708, 'dbacongallo', 'BACONGALLO, DIANA S', 'diana.bacongallo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(709, 'mjualo', 'JUALO, MARILYN P', 'marilyn.jualo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Executive Assistant III', NULL, NULL, NULL, NULL),
(710, 'mpasawilan', 'PASAWILAN, MAKMOD S', 'makmod.pasawilan@minda.gov.ph,mspasawilan@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer IV', NULL, NULL, NULL, NULL),
(711, 'alabor', 'LABOR, ANA MARIE A', 'ana.ayano@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(712, 'egilayo', 'GILAYO, EAMARIE ', 'eamarie.gilayo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(713, 'mcasinto', 'CASINTO, MADANIA M', 'madania.malang@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(714, 'mapurado', 'APURADO, MARJORIE M', 'marjorie.apurado@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(715, 'jbarrera', 'BARRERA, JOAN S', 'joan.barrera@minda.gov.ph,pdd.minda@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(716, 'yvalderia', 'VALDERIA, YVETTE G', 'yvette.valderia@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer IV', NULL, NULL, NULL, NULL),
(717, 'rcornita', 'CORNITA, RUDISA B', 'odie.cornita@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(718, 'rpinsoy', 'PINSOY, ROLANDO B', 'rolando.pinsoy@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(719, 'etomas', 'TOMAS JR., ERNESTO M', 'ernie.tomas@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'ITO III', NULL, NULL, NULL, NULL),
(720, 'abinancilan', 'BINANCILAN, ANELYN G', 'anelyn.binancilan@minda.gov.ph,anelyn2012@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer IV', NULL, NULL, NULL, NULL),
(721, 'jgan', 'GAN, JOHN MAYNARD V', 'johnmaynard.gan@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(722, 'jmiral', 'MIRAL, JONATHAN ', 'jon.miral@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(723, 'ssales', 'SALES, SYLVESTER ', 'sylvester.sales@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer IV', NULL, NULL, NULL, NULL),
(724, 'mginete', 'CUNANAN, MA. CAMILA LUZ G', 'melot.ginete@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(725, 'adatukan', 'DATUKAN, AMHED JEOFFREY ', 'amhed.datukan@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(726, 'acuello', 'CUELLO, AURORA J', 'aurora.cuello@minda.gov.ph, ajcuello@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Supervising Administrative Officer', NULL, NULL, NULL, NULL),
(727, 'sponsica', 'PONSICA, SAMUEL J', 'samuel.ponsica@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Graphic Artist', NULL, NULL, NULL, NULL),
(728, 'fflores', 'FLORES, FRITZ E', 'fritz.flores@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Information Officer III', NULL, NULL, NULL, NULL),
(729, 'jlura', 'LURA, JEMBER ALLEN P', 'jember.lura@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative AIDE III', NULL, NULL, NULL, NULL),
(730, 'kmaquiling', 'MAQUILING, KARL SAM M', 'karl.maquiling@minda.gov.ph, karlmaqs@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(731, 'salmasa', 'ALMASA, SHEILA B', 'sheilamae.almasa@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(732, 'rbaguio', 'BAGUIO, ROSEMARIE ANN O', 'rosemarie.baguio@minda.gov.ph, esorbaguio09231994@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(733, 'ccerezo', 'CEREZO, CARLOS ', 'carlos.cerezo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(734, 'kgeldore', 'GELDORE, KATHERINE ZENITH L', 'katherine.geldore@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(735, 'agotera', 'GOTERA, ANNABELLE R', 'bellerosales.gotera@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(736, 'ahernaez', 'HERNAEZ, ANITA D', 'nitz.hernaez@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(737, 'llorenzana', 'LORENZANA, LIDDY JANE ', 'liddy.lorenzana@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(738, 'jmusa', 'MUSA, JIMMY K', 'jimmy.musa@minda.gov.ph, jimmymusa08@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(739, 'areyes', 'REYES, APRIL ROSE E', 'april.reyes@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(740, 'jsolera', 'SOLERA, JODEELYN C', 'joedeelyn.solera@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative AIDE III', NULL, NULL, NULL, NULL),
(741, 'ctrino', 'TRINO, CECILIA D', 'cecil.trino@minda.gov.ph,cecilc@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Chief Administrative Officer', NULL, NULL, NULL, NULL),
(742, 'mungab', 'UNGAB, MICHELLE MARIE B', 'michelle.ungab@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(743, 'wvillanueva', 'VILLANUEVA, WILLIE C', 'willie.villanueva@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Driver', NULL, NULL, NULL, NULL),
(744, 'mcamagong', 'CAMAGONG, MA. CRISTINA S', 'kit.camagong@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Officer III', NULL, NULL, NULL, NULL),
(745, 'raguaviva', 'AGUAVIVA, RACHAEL ', 'rachael.aguaviva@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(746, 'resperat', 'ESPERAT, RAYMOND PETER D', 'raymond.esperat@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(747, 'mbarrios', 'BARRIOS, MERCY B', 'mercy.barrios@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer II', NULL, NULL, NULL, NULL),
(748, 'rabril', 'ABRIL, RUEL P', 'ruel.abril@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'DMO I', NULL, NULL, NULL, NULL),
(749, 'jtolentino', 'TOLENTINO, JEAN PAUL ', 'jeanpaul.tolentino@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(750, 'rvisitacion', 'VISITACION, ROGELIO ', 'rogelio.visitacion@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(751, 'mverzosa', 'VERZOSA, MARY ANN ', 'maryann.verzosa@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Officer II/HRMO I', NULL, NULL, NULL, NULL),
(752, 'spines', 'PINES, SHARLYN JOY T', 'sharlyn.pines@minda.gov.ph,sharlynjoypines@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Finance Assistant', NULL, NULL, NULL, NULL),
(753, 'avillabrille', 'VILLABRILLE, AMY C', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(754, 'msinogbuhan', 'SINOGBUHAN, MICHAEL A', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(755, 'cgaracho', 'GARACHO, CARLOS ', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(756, 'clungay', 'LUNGAY, CESAR P', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(757, 'ltagab', 'TAGAB, LUZEDELIO ', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(758, 'easna', 'ASNA, ELESIO N', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(759, 'aunggui', 'UNGGUI, ARMAN A', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(760, 'halonto', 'ALONTO, HONEY JADE V', 'honeyjade.alonto@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Officer V', NULL, NULL, NULL, NULL),
(761, 'iarnoco', 'ARNOCO, IVY MAE G', 'ivymae.arnoco@minda.gov.ph, ivymaearnoco@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer I', NULL, NULL, NULL, NULL),
(762, 'nlagahit', 'LAGAHIT, NEMESIO JR. D', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(763, 'jibanez', 'IBANEZ, JESSA A', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(764, 'vacosta', 'ACOSTA, VIGILIO JR M', 'virgilio.acosta@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(765, 'jbustamante', 'BUSTAMANTE, JOHN MICHAEL T', 'johnmichael.bustamante@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Aide', NULL, NULL, NULL, NULL),
(766, 'abondoc', 'BONDOC, ALLAN DOMINIC C', 'adcbondoc@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(767, 'ntorrecampo', 'TORRECAMPO, NEIL S', 'neil.torrecampo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Aide', NULL, NULL, NULL, NULL),
(768, 'dtancio', 'TANCIO, DAHLIA MONICA D', 'dahliamonica.tancio@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Accountant III', NULL, NULL, NULL, NULL),
(769, 'rbuhat', 'BUHAT JR., RENATO ', 'renato.buhat@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(770, 'adaanoy', 'DAANOY, ARCHIE D', 'archie.daanoy@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Driver', NULL, NULL, NULL, NULL),
(771, 'ipiong', 'PIONG, IRENEO JR S', 'ireneo.piong@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(772, 'jruiz', 'RUIZ, JERRY A', 'jerry.ruiz@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Driver', NULL, NULL, NULL, NULL),
(773, 'rmondido', 'MONDIDO, RICHIE MARK T', 'richie.mondido@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Information Systems Researcher II', NULL, NULL, NULL, NULL),
(774, 'amerto', 'MERTO, ALVIN JAY B', 'alvinjay.merto@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Software Programmer', NULL, NULL, NULL, NULL),
(775, 'cnieve', 'NIEVE, CAMERON B', 'cameron.nieve@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Software Programmer', NULL, NULL, NULL, NULL),
(776, 'kquibod', 'QUIBOD, KRISTINE MAE M', 'kristinemae.quibod@minda.gov.ph,tinquibod.addulaw@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Attorney IV', NULL, NULL, NULL, NULL),
(777, 'mdemarunsing', 'DEMARUNSING, MASRON C', 'masron.demarunsing@minda.gov.ph, masron.demarunsingll@gmail>com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(778, 'icodal', 'CODAL, IRISH J', 'irish.codal@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(779, 'wmabale', 'MABALE, WILSON D', 'wilson.mabale@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'DMO II', NULL, NULL, NULL, NULL),
(780, 'lenjambre', 'ENJAMBRE, LORDILIE S', 'lordilie.enjambre@minda.gov.ph,lords.enjambre@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer III', NULL, NULL, NULL, NULL),
(781, 'elawansa', 'LAWANSA, EMELIAN L', 'emelian.lawansa@minda.gov.ph, emeledlaw@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(782, 'aumngan', 'UMNGAN, ABDUL-JALIL S', 'jal.umngan@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(783, 'kdamaso', 'DAMASO, KATHREEN MAE E', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'COA', NULL, NULL, NULL, NULL),
(784, 'smarbas', 'MARBAS, SUNDEE F', 'sundee.marbas@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Planning Officer III', NULL, NULL, NULL, NULL),
(785, 'asultan', 'SULTAN, AMINAH O', 'aminah.sultan@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'DMO I', NULL, NULL, NULL, NULL),
(786, 'jlopoz', 'LOPOZ, CESO I, USEC. JANET M', 'janet.lopoz@minda.gov.ph,janetmlopoz@yahoo.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Executive Director', NULL, NULL, NULL, NULL),
(787, 'icasan', 'CASAN, INDERAH M', 'inderah.casan@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(788, 'atamayo', 'TAMAYO, ADRIAN M', 'adrian.tamayo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Development Management Officer V', NULL, NULL, NULL, NULL),
(789, 'mtapanan', 'TAPANAN, MERLY C', 'merlytapanan@ymail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(790, 'mabdulhamid', 'ABDULHAMID, MAJID S', 'carlos.cerezo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Driver', NULL, NULL, NULL, NULL),
(791, 'jesteva', 'ESTEVA, JEZA MIE B', 'jezamie.esteva@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(792, 'rluna', 'LUNA, ROTESSA JOYCE A', 'rotessa.luna@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(793, 'rducay', 'DUCAY, RICHARD C', ' richard.ducay@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(794, 'ltabla', 'TABLA, LOYGIE H', 'loygie.tabla@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(795, 'rdatukon', 'DATUKON, RANIZZA D', ' ranizza.datukon@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Attorney III', NULL, NULL, NULL, NULL),
(796, 'jdoldolia', 'DOLDOLIA, JAMES E', 'james.doldolia@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(797, 'emalli', 'MALLI, EDWIN M', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security &n Peace and Order Officer', NULL, NULL, NULL, NULL),
(798, 'ggumatas', 'GUMATAS, GERALD V', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(799, 'jestampador', 'ESTAMPADOR, JOHNYLYN C', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(800, 'ppolancos', 'POLANCOS, PERICLES G', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(801, 'nantipatia', 'ANTIPATIA, NARENO C', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(802, 'gdeasis', 'DE ASIS, GINA T', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Aide', NULL, NULL, NULL, NULL),
(803, 'jcalotes', 'CALOTES, JEAN T', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(804, 'mtudlas', 'TUDLAS, MAYETTE S', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Executive Assistant IV', NULL, NULL, NULL, NULL),
(805, 'cbillones', 'BILLONES, CLAIRE ROSE ANN D', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(806, 'restampador', 'ESTAMPADOR, RODERICK C', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(807, 'gbangcaya', 'BANGCAYA, GENEVIEVE A', 'meriam.eumenda@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(808, 'rpenaloza', 'PENALOZA, REX M', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(809, 'kbahinting', 'BAHINTING, KATLEEN FRACHESCA L', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(810, 'edapudong', 'DAPUDONG, EDRIN P', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(811, 'fsolin', 'SOLIN, FRANCISCO C', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Aide V', NULL, NULL, NULL, NULL),
(812, 'rparillo', 'PARILLO, ROSELYN P', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Executive Assistant V', NULL, NULL, NULL, NULL),
(813, 'jgarcia', 'GARCIA, JOHN CARLO S', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(814, 'rpenas', 'PENAS JR., ROMEO S', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(815, 'bhadjiril', 'HADJIRIL, BINANG A', 'binang.hadjiril@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security &n Peace and Order Officer', NULL, NULL, NULL, NULL),
(816, 'jellaga', 'BACARO, JOY A', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(817, 'ampon', 'AMPON, AVELINO L', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(818, 'ealerta', 'ALERTA, ELLENE B', 'ellene.alerta@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(819, 'gmayormita', 'MAYORMITA JR, GEORGE A', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(820, 'cvitasolo', 'VITASOLO, CHRISTOPHER A', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(821, 'ksarino', 'SARINO, KIMBERLY JOY D', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(822, 'tolasiman', 'OLASIMAN, TERRY R', 'terry.olasiman@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(823, 'lfuentes', 'FUENTES, LEA V', 'lea.fuentes@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(824, 'jtupas', 'TUPAS, JOYCE O', 'kathleen.bahinting@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(825, 'pvillorente', 'VILLORENTE, PETER PAUL C', 'peterpaul.villorente@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(826, 'gmaghopoy', 'MAGHOPOY, GLYDSI FEDERICO C', 'glysdi.maghopoy@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Finance Assistant', NULL, NULL, NULL, NULL),
(827, 'rmanongdo', 'MANONGDO, RALPH R', 'ralph.manongdo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Staff', NULL, NULL, NULL, NULL),
(828, 'eresimilla', 'RESIMILLA, EDGAR B', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(829, 'premegio', 'REMEGIO, PAUL A', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(830, 'fanecito', 'SOLIS, FERNANDO ANECITO T', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Executive Assistant II', NULL, NULL, NULL, NULL),
(831, 'wfernandez', 'FERNANDEZ, WYNCELL L', 'wyncell.fernandez@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(832, 'rcabilogan', 'CABILOGAN, ROMMEL C', 'rommel.cabilogan@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative AIDE IV', NULL, NULL, NULL, NULL),
(833, 'hferrer', 'FERRER, HANNAH MARIE G', 'hannah.ferrer@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(834, 'aameen', 'AMEEN, ABDULHAKIM D', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'COA Team Leader', NULL, NULL, NULL, NULL),
(835, 'rbotenes', 'BOTENES, REGINE S', 'regine.botenes@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(836, 'meuminda', 'EUMINDA, MERIAM P', 'meriam.eumenda@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(837, 'cnavales', 'NAVALES, CHESTOM MARK A', 'cheston.navales@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Social Media Content Editor', NULL, NULL, NULL, NULL),
(838, 'sfajardo', 'FAJARDO, STEPHEN JUNE A', 'stephen.fajardo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Media Expert', NULL, NULL, NULL, NULL),
(839, 'alabrador', 'LABRADOR, ANGELOU S', 'angelou.labrador@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(840, 'ssaldivar', 'SALDIVAR, SAMUEL D', 'samuel.saldivar@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Social Media Content Editor', NULL, NULL, NULL, NULL),
(841, 'ptrozo', 'TROZO, PREXX MARNIE KATE M', 'prexx.trozo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Technical Assistant', NULL, NULL, NULL, NULL),
(842, 'aguilardo', 'AMPONG, AGUILARDO A', 'wilson.mabale@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(843, 'scaberte', 'CABERTE, SOLIVER D', 'ireneo.piong@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(844, 'lassin', 'ASSIN, LYKA JOY A', 'carlos.cerezo@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL),
(845, 'jgeroche', 'GEROCHE, JEIMAR T', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Security', NULL, NULL, NULL, NULL),
(846, 'jrico', 'RICO, JOLITO D', 'jolito.rico@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Software Programmer', NULL, NULL, NULL, NULL),
(847, 'ragor', 'AGOR, RALPH LAURENCE A', 'ralphlaurence.agor@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Software Programmer', NULL, NULL, NULL, NULL),
(848, 'bjavier', 'JAVIER, BENEDICTO A', 'benedicto.javier@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Admin Specialist', NULL, NULL, NULL, NULL),
(849, 'lquintero', 'QUINTERO, LALAINE F', 'lalaine.quintero@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative Assistant', NULL, NULL, NULL, NULL),
(850, 'rasdillo', 'ASDILLO, RANDY P', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Driver', NULL, NULL, NULL, NULL),
(851, 'jrecimilla', 'RECIMILLA, JOEY E', 'joey.recimilla@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Director III', NULL, NULL, NULL, NULL),
(852, 'olegaspi', 'LEGASPI, OLIVER V', 'oliver.legaspi@minda.gov.ph', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative/Technical Staff', NULL, NULL, NULL, NULL),
(853, 'cakbar', 'AKBAR, CHERRYLYN S', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'ASEC', NULL, NULL, NULL, NULL),
(854, 'svalerio', 'VALERIO, SOCRATES M', 'socvalerz@gmail.com', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Administrative/Technical Staff', NULL, NULL, NULL, NULL),
(855, 'ftadena', 'TADENA, FELIPE C', ' ', NULL, '$2y$10$Uq1OLAxMeTPknXLUwK0ZH.D9ZwoxotGcW65UPEjLuMZIDPMi3lrqO', 'Utility', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `waste__materials`
--

CREATE TABLE `waste__materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wm_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cluster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wm_date` date NOT NULL,
  `custodian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_head` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_destroyed` int(11) NOT NULL DEFAULT 0,
  `private_sale` int(11) NOT NULL DEFAULT 0,
  `public_auction` int(11) NOT NULL DEFAULT 0,
  `transferred` int(11) NOT NULL DEFAULT 0,
  `agency_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspection_officer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `witness` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isok` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `waste__materials`
--

INSERT INTO `waste__materials` (`id`, `wm_num`, `entity_name`, `cluster`, `storage`, `wm_date`, `custodian`, `agency_head`, `is_destroyed`, `private_sale`, `public_auction`, `transferred`, `agency_name`, `inspection_officer`, `witness`, `isok`, `created_at`, `updated_at`) VALUES
(1, '435224', 'MINDANAO DEVELOPMENT AUTHORITY', '101', 'sefafsdsfd', '2021-06-16', 'serewrewr', 'ewrrwerew', 1, 1, 0, 0, NULL, 'sdffsdfdsf', 'fdhdgsdgfdgdfg', 1, '2021-06-15 17:49:02', '2021-06-15 17:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `waste__material__details`
--

CREATE TABLE `waste__material__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wm_id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `waste__material__details`
--

INSERT INTO `waste__material__details` (`id`, `wm_id`, `item`, `quantity`, `unit`, `description`, `receipt_num`, `receipt_date`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, '23424324', '4', 'sfsfdf', 'fwfsdgfdgd sdfgdgdfgdfg d', '44535r', '2021-06-16', 5000, '2021-06-15 17:49:26', '2021-06-15 17:49:26'),
(2, 1, '54353453453', '6', '64353', 'dg xfgdf ghdsfgf dfggffgfg d f fdg fdsg dg fg dfg dsfgdfg dsfg dfsg c', '56345435', '2021-06-16', 6000, '2021-06-15 17:49:49', '2021-06-15 17:49:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposals`
--
ALTER TABLE `disposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disposals_id_index` (`id`);

--
-- Indexes for table `disposal__details`
--
ALTER TABLE `disposal__details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disposal__details_id_index` (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection_and__acceptances`
--
ALTER TABLE `inspection_and__acceptances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inspection_and__acceptances_id_index` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pap_codes`
--
ALTER TABLE `pap_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `par_counts`
--
ALTER TABLE `par_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `project_counts`
--
ALTER TABLE `project_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_and__maintenances`
--
ALTER TABLE `repair_and__maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_and__maintenances_id_index` (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign_settings`
--
ALTER TABLE `sign_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sign_settings_id_index` (`id`);

--
-- Indexes for table `stock_libs`
--
ALTER TABLE `stock_libs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summaries`
--
ALTER TABLE `summaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `summaries_id_index` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waste__materials`
--
ALTER TABLE `waste__materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waste__materials_id_index` (`id`);

--
-- Indexes for table `waste__material__details`
--
ALTER TABLE `waste__material__details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waste__material__details_id_index` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposals`
--
ALTER TABLE `disposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disposal__details`
--
ALTER TABLE `disposal__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspection_and__acceptances`
--
ALTER TABLE `inspection_and__acceptances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pap_codes`
--
ALTER TABLE `pap_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `par_counts`
--
ALTER TABLE `par_counts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_counts`
--
ALTER TABLE `project_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repair_and__maintenances`
--
ALTER TABLE `repair_and__maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sign_settings`
--
ALTER TABLE `sign_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_libs`
--
ALTER TABLE `stock_libs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `summaries`
--
ALTER TABLE `summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=856;

--
-- AUTO_INCREMENT for table `waste__materials`
--
ALTER TABLE `waste__materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `waste__material__details`
--
ALTER TABLE `waste__material__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 01:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_restros`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_tables` int(11) DEFAULT 0 COMMENT 'table for this area',
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `vendor_id`, `number_of_tables`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Roof Top', 2, 6, 1, 1, 1, '2025-05-27 06:47:59', '2025-05-27 12:35:02', NULL),
(2, 'Garden Corner', 1, 4, 1, 1, NULL, '2025-05-27 12:35:21', '2025-05-27 12:35:21', NULL),
(3, 'Photogenic Corner', 2, 4, 1, 1, NULL, '2025-05-27 12:35:21', '2025-05-27 12:35:21', NULL),
(4, 'Family Dining', 2, 4, 1, 1, NULL, '2025-05-27 12:35:21', '2025-05-27 12:35:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area_branch`
--

CREATE TABLE `area_branch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_branch`
--

INSERT INTO `area_branch` (`id`, `area_id`, `branch_id`, `is_active`) VALUES
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 1),
(5, 1, 3, 1),
(6, 1, 4, 1),
(7, 3, 4, 1),
(8, 4, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assign_tickets`
--

CREATE TABLE `assign_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assign_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive',
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `map_link` text DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `business_days` varchar(255) DEFAULT NULL COMMENT 'Ex. Sat-Thu',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `is_active`, `vendor_id`, `name`, `branch_code`, `mobile_no`, `email`, `address`, `latitude`, `longitude`, `map_link`, `open_time`, `close_time`, `business_days`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Branch One', 'tb', '0101012647', 'branch1@gmail.com', 'Branch Address 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2025-05-27 05:21:51', NULL),
(2, 1, 1, 'Branch Two', 'tb02', '0101012648', 'branch2@gmail.com', 'Branch Address 2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2025-05-27 05:21:18', '2025-05-27 05:21:18', NULL),
(3, 1, 2, 'ZamZam Tower Branch', 'ZamZam01', '0101012649', 'branch1@gmail.com', 'Branch Address 1', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, '2025-05-27 05:21:18', '2025-06-15 23:40:33', NULL),
(4, 1, 2, 'Gulshan Square', 'vtb02', '0101012650', 'branch2@gmail.com', 'Branch Address 2', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, '2025-05-27 05:21:18', '2025-06-15 23:40:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_menus`
--

CREATE TABLE `branch_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch_menus`
--

INSERT INTO `branch_menus` (`id`, `branch_id`, `menu_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 2, 1, 1, NULL, NULL),
(3, 1, 2, 1, NULL, NULL),
(4, 2, 2, 1, NULL, NULL),
(5, 1, 3, 1, NULL, NULL),
(6, 2, 3, 1, NULL, NULL),
(7, 3, 4, 1, NULL, NULL),
(8, 4, 4, 1, NULL, NULL),
(9, 3, 5, 1, NULL, NULL),
(10, 4, 5, 1, NULL, NULL),
(11, 3, 6, 1, NULL, NULL),
(12, 4, 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `product_addons` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'NB: Creator of the record',
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'NB: Updater of the record',
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'NB: Deleter of the record',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_feedback`
--

CREATE TABLE `client_feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_messages`
--

CREATE TABLE `contact_us_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `is_seen` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Default,2=Not Default',
  `name` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `alignment` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 for left, 1 for right',
  `rate` double NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `is_default`, `name`, `symbol`, `alignment`, `rate`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'usd', 2, 'US Dollar', '$', 0, 1, 1, 1, 1, NULL, '2022-11-27 12:21:37', '2022-11-27 12:21:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `variables` longtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `slug`, `code`, `type`, `variables`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Welcome Email', 'Welcome Email', 'welcome-email', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey\n                            [name],\n                            thanks for\n                            signing up!</p>\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'welcome-email', '[name], [email], [phone]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Registration Verification', 'Registration Verification', 'registration-verification', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey\n                            [name],\n                            thanks for\n                            signing up!</p>\n                          <h4 style=\"margin-bottom:2px; color:#7E8299\">Email Verification\n                          </h4>\n                          <p style=\"margin-bottom:2px; color:#7E8299\">paragraphs. Please click the button below to verify your email address\n                          </p>\n                         \n                        </div>\n                        <!--end:Text-->\n\n                        <!--begin:Action-->\n                        <a href=\"[active_url]\" target=\"_blank\"\n                          style=\"background-color:#29a762; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;\">\n                          Activate Account\n                        </a>\n                        <!--begin:Action-->\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'registration-verification', '[name], [email], [phone]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'Add New Customer Welcome Email', 'Add New Customer Welcome Email', 'add-new-customer-welcome-email', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n          <div\n            style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n              style=\"border-collapse:collapse\">\n              <tbody>\n                <tr>\n                  <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                    <!--begin:Email content-->\n                    <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                      <!--begin:Logo-->\n                      <div style=\"margin-bottom: 10px\">\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                        </a>\n                      </div>\n                      <!--end:Logo-->\n\n                      <!--begin:Media-->\n                      <div style=\"margin-bottom: 15px\">\n                        <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                          style=\"width: 120px; margin:40px auto;\">\n                      </div>\n                      <!--end:Media-->\n\n                      <!--begin:Text-->\n                      <div\n                        style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                        <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name],\n                        We have created account for you . your login credentails here :\n                          Email : [email]\n                          Phone : [phone]\n                          password : [password]\n                          <strong> and your package info</strong>:\n                          Package name : [package]\n                          Price : [price]\n                          Payment Method : [method]\n                          Start Date : [startDate]\n                          End Date : [endDate]\n                          </p>\n                       \n                      </div>\n                      <!--end:Text-->\n                      <!--begin:Action-->\n                      <a href=\"[login_url]\" target=\"_blank\"\n                        style=\"background-color:#29a762; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;\">\n                        Login\n                      </a>\n                      <!--begin:Action-->\n                    </div>\n                    <!--end:Email content-->\n                  </td>\n                </tr> \n\n                <tr>\n                  <td align=\"center\" valign=\"center\"\n                    style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                    <p\n                      style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                      It’s all about customers!</p>\n                    <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                    <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                        rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                    </p>\n                    <p>We serve Mon-Fri, 9AM-18AM</p>\n                  </td>\n                </tr>  \n                <tr>\n                  <td align=\"center\" valign=\"center\"\n                    style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                    <p> © Copyright ThemeTags.\n                      <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                        style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                      from newsletter.\n                    </p>\n                  </td>\n                </tr>\n              </tbody>\n            </table>\n          </div>\n        </div>', 'add-new-customer-welcome-email', '[name], [email], [phone], [password], [package], [startDate], [endDate], [price], [method]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Purchase Package', 'Purchase Package', 'purchase-package', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi\n                            [name],\n                            thanks for\n                            purchase [package].</p>\n                            <p>Your [Package] price [price] and start from [startDate]</p>\n                            <p>Your [Package] Will be expire [endDate]</p>                                 \n                        </div>\n                        \n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'purchase-package', '[name], [email], [phone], [package],[startDate], [endDate],[price]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Admin Assign Package', 'Admin Assign Package', 'admin-assign-package', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi\n                            [name],\n                           Admin Assigned this <strong>[package]</strong> for you.\n                            purchase <strong>[package]</strong>.</p>\n                            <p>Your  <strong>[package]</strong> price  <strong>[price]</strong> and start from [startDate]</p>\n                            <p>Your [Package] Will be expire <strong>[endDate]</strong></p>\n                \n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'admin-assign-package', '[name], [email], [phone], [package],[startDate], [endDate],[price]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Offline Payment Request', 'Offline Payment Request', 'offline-payment-request', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi, <br>\n                           [name] request a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> .</p>\n                            <p>And  <strong>[package]</strong> price  <strong>[price]</strong></p>                         \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request', '[name], [email], [phone], [package],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'Offline Payment Request Approve', 'Offline Payment Request Approve', 'offline-payment-request-approve', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name], <br>\n                           Your request a offline payment has been approved [package]</strong> using this payment method <strong>[method]</strong> .</p>\n                                                  \n                            <p>Your  <strong>[package]</strong> price  <strong>[price]</strong> and start from [startDate]</p>\n                            <p>Your [Package] Will be expire <strong>[endDate]</strong></p>\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request-approve', '[name], [email], [phone], [package],[startDate], [endDate],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Offline Payment Request Reject', 'Offline Payment Request Reject', 'offline-payment-request-rejected', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name], <br>\n                           Your requested a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> has been <strong>Rejected</strong> .</p>\n                                        \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request-rejected', '[name], [email], [phone], [package],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'Offline Payment Request Add Note', 'Offline Payment Request Add Note', 'offline-payment-request-add-note', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name], <br>\n                           Your request a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> .</p>\n                            <p>But Admin Want more information from you</p>\n                            <p>[note]</p>                         \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request-add-note', '[name], [email], [phone], [package],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `email_templates` (`id`, `name`, `subject`, `slug`, `code`, `type`, `variables`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Assign Ticket', 'Assign Ticket', 'ticket-assign', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey, <br>\n                            New Ticket from <strong>[name]</strong> and [ticketId] .</p>\n                          \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'ticket-assign', '[name], [email], [phone], [title], [ticketId]', 1, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'Ticket Reply', 'Ticket Reply', 'ticket-reply', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writerap.themetags.net/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey, <br>\n                            Ticket reply from  <strong>[name]</strong> and [ticketId] .</p>\n                          \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writerap.themetags.net/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writerap.themetags.net/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'ticket-reply', '[name], [email], [phone], [title],[titleId]', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` longtext NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `question`, `answer`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Where can I learn more about copywriting or entrepreneurship?', 'Restros - is an innovative SaaS platform that harnesses the power of OpenAI Artificial Intelligence technology to provide your users with a range of exceptional features. Restros, users can effortlessly generate unique and plagiarism-free content and images, taking advantage of multiple languages for enhanced versatility. It\'s all in one SaaS platform to generate AI content, image and code.', 1, 1, 1, NULL, '2024-07-08 06:07:45', '2024-07-08 06:07:45', NULL),
(2, 'Can I get a demo of the product?', 'Of course! We are currently running 1 live demo a week. You can sign up and register for our next one here.', 1, 1, 1, NULL, '2024-07-08 06:08:04', '2024-07-08 06:08:04', NULL),
(3, 'What languages does it support?', 'With the Pro plan, you can create content in the following 250+ languages:', 1, 1, 1, NULL, '2024-07-08 06:08:21', '2024-07-08 06:08:21', NULL),
(4, 'How much does it cost?', 'Our copywriting tools have a free plan! That\'s right, you can create content with our free tools. However, if you want more content, you\'ll have to subscribe to our Pro plan!', 1, 1, 1, NULL, '2024-07-08 06:08:38', '2024-07-08 06:08:38', NULL),
(5, 'What can I create with Restros?', 'We have copywriting tools for everything you need to start and run your business! You can write blog posts, product descriptions, and even Instagram captions with Restros. We\'re always updating our tools, so let us know what else you\'d like to see!', 1, 1, 1, NULL, '2024-07-08 06:08:56', '2024-07-08 06:08:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grass_period_payments`
--

CREATE TABLE `grass_period_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `transaction_status` varchar(255) DEFAULT NULL,
  `status_code` varchar(255) DEFAULT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `response` longtext DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `total_sales_amount` double NOT NULL DEFAULT 0,
  `total_sales_count` bigint(20) NOT NULL DEFAULT 0,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `total_sales_amount`, `total_sales_count`, `vendor_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Biriyani', 0, 2, 1, 1, 1, NULL, '2025-05-27 06:43:10', '2025-05-27 06:43:10', NULL),
(2, 'Burger', 0, 1, 1, 1, 1, NULL, '2025-05-28 05:29:51', '2025-05-28 05:29:51', NULL),
(3, 'Sandwich', 0, 0, 1, 1, 1, NULL, '2025-05-28 05:29:58', '2025-05-28 05:29:58', NULL),
(4, 'Biriyani', 0, 2, 2, 1, 2, NULL, '2025-05-27 06:43:10', '2025-05-27 06:43:10', NULL),
(5, 'Burger', 870, 7, 2, 1, 2, 2, '2025-05-28 05:29:51', '2025-06-25 11:41:37', NULL),
(6, 'Sandwich', 80, 1, 2, 1, 2, 2, '2025-05-28 05:29:58', '2025-06-17 06:55:39', NULL),
(7, 'Curry', 180, 1, 2, 1, 2, 2, '2025-06-15 09:33:57', '2025-06-25 09:05:48', NULL),
(8, 'Desert', 0, 0, 2, 1, 2, NULL, '2025-06-15 09:34:07', '2025-06-15 09:34:07', NULL),
(9, 'Momos', 250, 1, 2, 1, 2, 2, '2025-06-15 09:34:25', '2025-06-25 09:24:08', NULL),
(10, 'Pizza', 0, 0, 2, 1, 2, NULL, '2025-06-15 09:34:38', '2025-06-15 09:34:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kitchens`
--

CREATE TABLE `kitchens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kitchens`
--

INSERT INTO `kitchens` (`id`, `name`, `branch_id`, `vendor_id`, `is_active`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kitchen One Branch One', 1, 1, 1, 1, NULL, NULL, '2025-05-27 06:10:42', '2025-05-27 06:10:42', NULL),
(2, 'Kitchen One Branch Two', 2, 1, 1, 1, NULL, NULL, '2025-05-27 06:11:06', '2025-05-27 06:11:06', NULL),
(3, 'Kitchen Two Branch One', 1, 1, 1, 1, NULL, NULL, '2025-05-27 06:11:26', '2025-05-27 06:11:26', NULL),
(4, 'Kitchen Two Branch Two', 2, 1, 1, 1, NULL, NULL, '2025-05-27 06:11:41', '2025-05-27 06:11:41', NULL),
(5, 'Kitchen One', 3, 2, 1, 2, 2, NULL, '2025-05-27 06:11:41', '2025-06-15 03:22:54', NULL),
(6, 'Kitchen Two', 3, 2, 1, 2, 2, NULL, '2025-05-27 06:11:41', '2025-06-15 03:23:01', NULL),
(7, 'Kitchen Three', 4, 2, 1, 2, 2, NULL, '2025-05-27 06:11:41', '2025-06-15 03:23:08', NULL),
(8, 'Kitchen Four', 4, 2, 1, 2, 2, NULL, '2025-05-27 06:11:41', '2025-06-15 03:23:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `is_rtl` tinyint(4) NOT NULL DEFAULT 0,
  `is_active_for_templates` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `flag`, `code`, `is_rtl`, `is_active_for_templates`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 'en', 'en', 0, 1, 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `localizations`
--

CREATE TABLE `localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_key` varchar(255) NOT NULL,
  `t_key` longtext NOT NULL,
  `t_value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localizations`
--

INSERT INTO `localizations` (`id`, `lang_key`, `t_key`, `t_value`, `created_at`, `updated_at`) VALUES
(1, 'en', 'subscribe_now', 'Subscribe Now', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(2, 'en', 'branches', 'Branches', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(3, 'en', 'kitchen_panel', 'Kitchen Panel', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(4, 'en', 'reservations', 'Reservations', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(5, 'en', 'team', 'Team', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(6, 'en', 'support_ticket', 'Support Ticket', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(7, 'en', 'select_payment_method', 'Select Payment Method', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(8, 'en', 'your_current_active_package_will_be_expired_and_this_will_be_active', 'Your current active package will be expired and This Will be active.', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(9, 'en', 'proceed', 'Proceed', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(10, 'en', 'payment_method', 'Payment Method', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(11, 'en', 'select_offline_payment_method', 'Select Offline Payment Method', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(12, 'en', 'description', 'Description', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(13, 'en', 'payment_details', 'Payment Details', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(14, 'en', 'type_your_payment_details', 'Type your Payment Details', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(15, 'en', 'file', 'File', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(16, 'en', 'drop_your_files_here_or', 'Drop your files here or', '2025-06-15 03:07:22', '2025-06-15 03:07:22'),
(17, 'en', 'browse', 'Browse', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(18, 'en', 'allowed_file_types_jpgpngjpeg', 'Allowed file types: jpg,png,jpeg', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(19, 'en', 'note', 'Note', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(20, 'en', 'type_your_note', 'Type your Note', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(21, 'en', 'cancel', 'Cancel', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(22, 'en', 'create_new_subscription_plan', 'Create New Subscription Plan', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(23, 'en', 'package_type', 'Package Type', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(24, 'en', 'create_new_plan', 'Create New Plan', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(25, 'en', 'or', 'Or', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(26, 'en', 'copy_from_existing', 'Copy From Existing', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(27, 'en', 'monthly_plans', 'Monthly Plans', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(28, 'en', 'yearly_plans', 'Yearly Plans', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(29, 'en', 'copy', 'Copy', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(30, 'en', 'add_plan', 'Add Plan', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(31, 'en', 'update_plan', 'Update Plan', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(32, 'en', 'you_current_package_subscribed_package_type_will_be_expired_if_you_want_to_subscribe_to_package_type_do_you_want_to_continue', 'You current package ${subscribed_package_type} will be expired if you want to subscribe to ${package_type}. Do you want to continue?', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(33, 'en', 'you_are_changing_your_subscription_package_type_to_package_type_your_balance_will_be_reset_with_new_package_balance_want_to_continue', 'You are changing your subscription package type to ${package_type}, your balance will be reset with new package balance. Want to continue?', '2025-06-15 03:07:23', '2025-06-15 03:07:23'),
(34, 'en', 'select_branch', 'Select Branch', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(35, 'en', 'dashboard', 'Dashboard', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(36, 'en', 'subscriptions', 'Subscriptions', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(37, 'en', 'subscription_plan', 'Subscription Plan', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(38, 'en', 'subscription_history', 'Subscription History', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(39, 'en', 'pos', 'POS', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(40, 'en', 'menu', 'Menu', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(41, 'en', 'menus', 'Menus', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(42, 'en', 'item_category', 'Item Category', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(43, 'en', 'menu_items', 'Menu Items', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(44, 'en', 'table', 'Table', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(45, 'en', 'areas', 'Areas', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(46, 'en', 'tables', 'Tables', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(47, 'en', 'qr_codes', 'QR Codes', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(48, 'en', 'orders', 'Orders', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(49, 'en', 'kitche_orders', 'Kitche Orders', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(50, 'en', 'kitchen', 'Kitchen', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(51, 'en', 'offerings', 'OFFERINGS', '2025-06-15 03:07:24', '2025-06-15 03:07:24'),
(52, 'en', 'customers', 'Customers', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(53, 'en', 'vendor_staff', 'Vendor Staff', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(54, 'en', 'staff', 'Staff', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(55, 'en', 'manage_roles', 'Manage Roles', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(56, 'en', 'support', 'Support', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(57, 'en', 'tickets', 'Tickets', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(58, 'en', 'reports', 'Reports', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(59, 'en', 'item_reports', 'Item Reports', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(60, 'en', 'item_category_reports', 'Item Category Reports', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(61, 'en', 'sales_reports', 'Sales Reports', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(62, 'en', 'reservations_reports', 'Reservations Reports', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(63, 'en', 'manage_settings', 'MANAGE SETTINGS', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(64, 'en', 'settings', 'Settings', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(65, 'en', 'manage_contents', 'Manage Contents', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(66, 'en', 'media_manager', 'Media Manager', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(67, 'en', 'media_files', 'Media Files', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(68, 'en', 'recently_uploaded_files', 'Recently uploaded files', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(69, 'en', 'add_files_here', 'Add files here', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(70, 'en', 'previously_uploaded_files', 'Previously uploaded files', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(71, 'en', 'search_by_name', 'Search by name', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(72, 'en', 'search', 'Search', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(73, 'en', 'load_more', 'Load More', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(74, 'en', 'select', 'Select', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(75, 'en', 'visit_store', 'Visit Store', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(76, 'en', 'my_account', 'My Account', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(77, 'en', 'logout', 'Logout', '2025-06-15 03:07:25', '2025-06-15 03:07:25'),
(78, 'en', 'version', 'Version', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(79, 'en', 'updating', 'Updating', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(80, 'en', 'loading', 'Loading', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(81, 'en', 'do_you_want_to_change_the_status', 'Do you want to change the status?', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(82, 'en', 'failed_to_change_the_status', 'Failed to change the status', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(83, 'en', 'are_you_sure_you_want_to_proceed', 'Are you sure you want to proceed?', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(84, 'en', 'this_action_will_permanently_delete_the_selected_record', 'This action will permanently delete the selected record.', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(85, 'en', 'yes_delete', 'Yes, Delete', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(86, 'en', 'the_article_has_not_been_generated_yet', 'The article has not been generated yet', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(87, 'en', 'failed_to_copy_text_', 'Failed to copy text: ', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(88, 'en', 'chat_has_been_copied_successfully', 'Chat has been copied successfully', '2025-06-15 03:07:26', '2025-06-15 03:07:26'),
(89, 'en', 'sorry_we_cant_find_the_page_youre_looking_for_it_might_have_been_moved_or_deleted', 'Sorry, we can\'t find the page you\'re looking for. It might have been moved or deleted.', '2025-06-15 03:07:28', '2025-06-15 03:07:28'),
(90, 'en', 'return_to_home', 'Return to Home', '2025-06-15 03:07:28', '2025-06-15 03:07:28'),
(91, 'en', 'branch_list', 'Branch List', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(92, 'en', 'manage_branch', 'Manage Branch', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(93, 'en', 'add_branch', 'Add Branch', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(94, 'en', 'status', 'Status', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(95, 'en', 'sl', 'S/L', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(96, 'en', 'name', 'Name', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(97, 'en', 'address', 'Address', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(98, 'en', 'phone_number', 'Phone Number', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(99, 'en', 'email', 'Email', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(100, 'en', 'created_at', 'Created At', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(101, 'en', 'action', 'Action', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(102, 'en', 'add_new_branch', 'Add New Branch', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(103, 'en', 'branch_name', 'Branch Name', '2025-06-15 03:08:37', '2025-06-15 03:08:37'),
(104, 'en', 'branch_code', 'Branch Code', '2025-06-15 03:08:38', '2025-06-15 03:08:38'),
(105, 'en', 'exyour_content_here', 'Ex.Your content here', '2025-06-15 03:08:38', '2025-06-15 03:08:38'),
(106, 'en', 'mobile_no', 'Mobile No', '2025-06-15 03:08:38', '2025-06-15 03:08:38'),
(107, 'en', 'save', 'Save', '2025-06-15 03:08:38', '2025-06-15 03:08:38'),
(108, 'en', 'reset', 'Reset', '2025-06-15 03:08:38', '2025-06-15 03:08:38'),
(109, 'en', 'update_branch', 'Update Branch', '2025-06-15 03:08:38', '2025-06-15 03:08:38'),
(110, 'en', 'edit', 'Edit', '2025-06-15 03:08:42', '2025-06-15 03:08:42'),
(111, 'en', 'delete', 'Delete', '2025-06-15 03:08:42', '2025-06-15 03:08:42'),
(112, 'en', 'edit_branch', 'Edit Branch', '2025-06-15 03:08:48', '2025-06-15 03:08:48'),
(113, 'en', 'branch_updated_successfully', 'Branch Updated Successfully', '2025-06-15 03:09:03', '2025-06-15 03:09:03'),
(114, 'en', 'customer_list', 'Customer List', '2025-06-15 03:09:30', '2025-06-15 03:09:30'),
(115, 'en', 'export_customers', 'Export Customers', '2025-06-15 03:09:30', '2025-06-15 03:09:30'),
(116, 'en', 'add_customer', 'Add Customer', '2025-06-15 03:09:30', '2025-06-15 03:09:30'),
(117, 'en', 'plan_type', 'Plan Type', '2025-06-15 03:09:30', '2025-06-15 03:09:30'),
(118, 'en', 'profile', 'Profile', '2025-06-15 03:09:30', '2025-06-15 03:09:30'),
(119, 'en', 'phone', 'Phone', '2025-06-15 03:09:30', '2025-06-15 03:09:30'),
(120, 'en', 'acitve_package', 'Acitve Package', '2025-06-15 03:09:30', '2025-06-15 03:09:30'),
(121, 'en', 'add_new_customer', 'Add New Customer', '2025-06-15 03:09:41', '2025-06-15 03:09:41'),
(122, 'en', 'mobile_number', 'Mobile Number', '2025-06-15 03:09:41', '2025-06-15 03:09:41'),
(123, 'en', 'avatar', 'Avatar', '2025-06-15 03:09:41', '2025-06-15 03:09:41'),
(124, 'en', 'choose_avatar', 'Choose Avatar', '2025-06-15 03:09:41', '2025-06-15 03:09:41'),
(125, 'en', 'password', 'Password', '2025-06-15 03:09:41', '2025-06-15 03:09:41'),
(126, 'en', 'do_you_want_assign_plan_', 'Do you want assign plan ?', '2025-06-15 03:09:42', '2025-06-15 03:09:42'),
(127, 'en', 'select_subscription_plan', 'Select Subscription Plan', '2025-06-15 03:09:42', '2025-06-15 03:09:42'),
(128, 'en', 'paid', 'Paid', '2025-06-15 03:09:42', '2025-06-15 03:09:42'),
(129, 'en', 'free', 'Free', '2025-06-15 03:09:42', '2025-06-15 03:09:42'),
(130, 'en', 'payment_amount', 'Payment Amount', '2025-06-15 03:09:42', '2025-06-15 03:09:42'),
(131, 'en', 'payment_detail', 'Payment Detail', '2025-06-15 03:09:42', '2025-06-15 03:09:42'),
(132, 'en', 'update_customer', 'Update Customer', '2025-06-15 03:09:42', '2025-06-15 03:09:42'),
(133, 'en', 'login', 'Login', '2025-06-15 03:10:48', '2025-06-15 03:10:48'),
(134, 'en', 'welcome_back', 'Welcome Back', '2025-06-15 03:10:48', '2025-06-15 03:10:48'),
(135, 'en', 'sign_in_to_your_account_to_continue', 'Sign in to your account to continue', '2025-06-15 03:10:48', '2025-06-15 03:10:48'),
(136, 'en', 'forgot_password', 'Forgot Password?', '2025-06-15 03:10:50', '2025-06-15 03:10:50'),
(137, 'en', 'remember_me', 'Remember Me', '2025-06-15 03:10:50', '2025-06-15 03:10:50'),
(138, 'en', 'dont_have_an_account', 'Don’t have an account?', '2025-06-15 03:10:50', '2025-06-15 03:10:50'),
(139, 'en', 'sign_up_for_free', 'Sign up for free!', '2025-06-15 03:10:50', '2025-06-15 03:10:50'),
(140, 'en', 'google_recaptcha_validation_error_seems_like_you_are_not_a_human', 'Google recaptcha validation error, seems like you are not a human.', '2025-06-15 03:10:56', '2025-06-15 03:10:56'),
(141, 'en', 'no_data_found', 'No data found', '2025-06-15 03:13:01', '2025-06-15 03:13:01'),
(142, 'en', 'there_are_errors_in_the_form', 'There are errors in the form.', '2025-06-15 03:14:37', '2025-06-15 03:14:37'),
(143, 'en', 'admin_list', 'Admin List', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(144, 'en', 'manage_staff', 'Manage Staff', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(145, 'en', 'staff_users', 'Staff Users', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(146, 'en', 'add_staff', 'Add Staff', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(147, 'en', 'user_type', 'User Type', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(148, 'en', 'role', 'Role', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(149, 'en', 'mobile', 'Mobile', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(150, 'en', 'branch', 'Branch', '2025-06-15 03:16:02', '2025-06-15 03:16:02'),
(151, 'en', 'add_new_staff', 'Add New Staff', '2025-06-15 03:16:06', '2025-06-15 03:16:06'),
(152, 'en', 'first_name', 'First Name', '2025-06-15 03:16:06', '2025-06-15 03:16:06'),
(153, 'en', 'last_name', 'Last Name', '2025-06-15 03:16:06', '2025-06-15 03:16:06'),
(154, 'en', 'confirmed_password', 'Confirmed Password', '2025-06-15 03:16:06', '2025-06-15 03:16:06'),
(155, 'en', 'update_user', 'Update User', '2025-06-15 03:16:06', '2025-06-15 03:16:06'),
(156, 'en', 'roles', 'Roles', '2025-06-15 03:16:20', '2025-06-15 03:16:20'),
(157, 'en', 'add_new_role', 'Add New Role', '2025-06-15 03:16:20', '2025-06-15 03:16:20'),
(158, 'en', 'title', 'Title', '2025-06-15 03:16:20', '2025-06-15 03:16:20'),
(159, 'en', 'active_status', 'Active Status', '2025-06-15 03:16:20', '2025-06-15 03:16:20'),
(160, 'en', 'permissions', 'Permissions', '2025-06-15 03:16:20', '2025-06-15 03:16:20'),
(161, 'en', 'validation_error_for_the_role_store_request', 'Validation Error for the Role store request', '2025-06-15 03:18:21', '2025-06-15 03:18:21'),
(162, 'en', 'successfully_stored_role', 'Successfully stored Role', '2025-06-15 03:18:21', '2025-06-15 03:18:21'),
(163, 'en', 'successfully_updated_role', 'Successfully Updated Role', '2025-06-15 03:18:54', '2025-06-15 03:18:54'),
(164, 'en', 'user_created_successfully', 'User Created Successfully', '2025-06-15 03:19:47', '2025-06-15 03:19:47'),
(165, 'en', 'branch_is_updated_successfully', 'Branch is updated successfully', '2025-06-15 03:19:56', '2025-06-15 03:19:56'),
(166, 'en', 'create_ticket', 'Create Ticket', '2025-06-15 03:21:52', '2025-06-15 03:21:52'),
(167, 'en', 'add_ticket', 'Add Ticket', '2025-06-15 03:21:54', '2025-06-15 03:21:54'),
(168, 'en', 'category', 'Category', '2025-06-15 03:21:54', '2025-06-15 03:21:54'),
(169, 'en', 'priority', 'Priority', '2025-06-15 03:21:54', '2025-06-15 03:21:54'),
(170, 'en', 'write_something_here_', 'write something here ....', '2025-06-15 03:21:54', '2025-06-15 03:21:54'),
(171, 'en', 'update_ticket', 'Update Ticket', '2025-06-15 03:21:54', '2025-06-15 03:21:54'),
(172, 'en', 'update', 'update', '2025-06-15 03:21:54', '2025-06-15 03:21:54'),
(173, 'en', 'all_tickets', 'All Tickets', '2025-06-15 03:21:56', '2025-06-15 03:21:56'),
(174, 'en', 'of', 'of', '2025-06-15 03:21:56', '2025-06-15 03:21:56'),
(175, 'en', 'results', 'results', '2025-06-15 03:21:56', '2025-06-15 03:21:56'),
(176, 'en', 'reservations_list', 'Reservations List', '2025-06-15 03:22:10', '2025-06-15 03:22:10'),
(177, 'en', 'manage_reservations', 'Manage Reservations', '2025-06-15 03:22:10', '2025-06-15 03:22:10'),
(178, 'en', 'add_reservation', 'Add Reservation', '2025-06-15 03:22:10', '2025-06-15 03:22:10'),
(179, 'en', 'start_date', 'Start Date', '2025-06-15 03:22:10', '2025-06-15 03:22:10'),
(180, 'en', 'end_date', 'End Date', '2025-06-15 03:22:10', '2025-06-15 03:22:10'),
(181, 'en', 'search_by_customer_name_email_or_table_code', 'Search by customer name, email or table code', '2025-06-15 03:22:10', '2025-06-15 03:22:10'),
(182, 'en', 'select_status', 'Select Status', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(183, 'en', 'area', 'Area', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(184, 'en', 'tcode', 'T.Code', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(185, 'en', 'cname', 'C.Name', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(186, 'en', 'cemail', 'C.Email', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(187, 'en', 'period', 'Period', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(188, 'en', 'rstart_time', 'R.Start Time', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(189, 'en', 'rend_time', 'R.End Time', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(190, 'en', 'guest', 'Guest', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(191, 'en', 'total', 'Total', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(192, 'en', 'advance', 'Advance', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(193, 'en', 'due', 'Due', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(194, 'en', 'reserved_at', 'Reserved At', '2025-06-15 03:22:11', '2025-06-15 03:22:11'),
(195, 'en', 'create_reservation', 'Create Reservation', '2025-06-15 03:22:16', '2025-06-15 03:22:16'),
(196, 'en', 'create_reservations', 'Create Reservations', '2025-06-15 03:22:16', '2025-06-15 03:22:16'),
(197, 'en', 'customer_first_name', 'Customer First Name', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(198, 'en', 'customer_last_name', 'Customer Last Name', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(199, 'en', 'customer_email', 'Customer Email', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(200, 'en', 'customer_phone', 'Customer Phone', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(201, 'en', 'number_of_guests', 'Number of Guests', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(202, 'en', 'start_date_time', 'Start Date Time', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(203, 'en', 'end_date_time', 'End Date Time', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(204, 'en', 'total_reservation_amount', 'Total Reservation Amount', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(205, 'en', 'advance_reservation_payment', 'Advance Reservation Payment', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(206, 'en', 'is_paid', 'Is Paid', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(207, 'en', 'select_a_status', 'Select a status', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(208, 'en', 'save__new', 'Save & New', '2025-06-15 03:22:20', '2025-06-15 03:22:20'),
(209, 'en', 'kitchen_list', 'Kitchen List', '2025-06-15 03:22:37', '2025-06-15 03:22:37'),
(210, 'en', 'manage_kitchen', 'Manage Kitchen', '2025-06-15 03:22:37', '2025-06-15 03:22:37'),
(211, 'en', 'add_kitchen', 'Add Kitchen', '2025-06-15 03:22:37', '2025-06-15 03:22:37'),
(212, 'en', 'add_new_kitchen', 'Add New Kitchen', '2025-06-15 03:22:39', '2025-06-15 03:22:39'),
(213, 'en', 'kitchen_name', 'Kitchen Name', '2025-06-15 03:22:39', '2025-06-15 03:22:39'),
(214, 'en', 'update_kitchen', 'Update Kitchen', '2025-06-15 03:22:39', '2025-06-15 03:22:39'),
(215, 'en', 'edit_kitchen', 'Edit Kitchen', '2025-06-15 03:22:46', '2025-06-15 03:22:46'),
(216, 'en', 'kitchen_updated_successfully', 'Kitchen Updated Successfully', '2025-06-15 03:22:54', '2025-06-15 03:22:54'),
(217, 'en', 'area_list', 'Area List', '2025-06-15 03:23:32', '2025-06-15 03:23:32'),
(218, 'en', 'manage_areas', 'Manage Areas', '2025-06-15 03:23:32', '2025-06-15 03:23:32'),
(219, 'en', 'add_area', 'Add Area', '2025-06-15 03:23:32', '2025-06-15 03:23:32'),
(220, 'en', 'number_of_tables', 'Number of Tables', '2025-06-15 03:23:33', '2025-06-15 03:23:33'),
(221, 'en', 'add_new_admin', 'Add New Admin', '2025-06-15 03:23:35', '2025-06-15 03:23:35'),
(222, 'en', 'select_branches', 'Select Branches', '2025-06-15 03:23:35', '2025-06-15 03:23:35'),
(223, 'en', 'add_new_area', 'Add New Area', '2025-06-15 03:23:35', '2025-06-15 03:23:35'),
(224, 'en', 'update_area', 'Update area', '2025-06-15 03:23:35', '2025-06-15 03:23:35'),
(225, 'en', 'edit_area', 'Edit Area', '2025-06-15 03:23:41', '2025-06-15 03:23:41'),
(226, 'en', 'area_updated_successfully', 'Area Updated Successfully', '2025-06-15 03:23:48', '2025-06-15 03:23:48'),
(227, 'en', 'table_list', 'Table List', '2025-06-15 03:23:57', '2025-06-15 03:23:57'),
(228, 'en', 'manage_tables', 'Manage Tables', '2025-06-15 03:23:57', '2025-06-15 03:23:57'),
(229, 'en', 'add_table', 'Add Table', '2025-06-15 03:23:57', '2025-06-15 03:23:57'),
(230, 'en', 'table_code', 'Table Code', '2025-06-15 03:23:57', '2025-06-15 03:23:57'),
(231, 'en', 'number_of_seats', 'Number of Seats', '2025-06-15 03:23:57', '2025-06-15 03:23:57'),
(232, 'en', 'area_name', 'Area Name', '2025-06-15 03:23:57', '2025-06-15 03:23:57'),
(233, 'en', 'choose_area', 'Choose Area', '2025-06-15 03:23:58', '2025-06-15 03:23:58'),
(234, 'en', 'select_area', 'Select Area', '2025-06-15 03:23:58', '2025-06-15 03:23:58'),
(235, 'en', 'eg_a01', 'e.g: A01', '2025-06-15 03:23:59', '2025-06-15 03:23:59'),
(236, 'en', 'seating_capacity', 'Seating Capacity', '2025-06-15 03:23:59', '2025-06-15 03:23:59'),
(237, 'en', 'enter_the_number_of_seats_eg_5', 'Enter the number of seats (e.g: 5)', '2025-06-15 03:23:59', '2025-06-15 03:23:59'),
(238, 'en', 'add_new_table', 'Add New Table', '2025-06-15 03:23:59', '2025-06-15 03:23:59'),
(239, 'en', 'update_table', 'Update Table', '2025-06-15 03:23:59', '2025-06-15 03:23:59'),
(240, 'en', 'qr_code_list', 'QR Code List', '2025-06-15 03:24:07', '2025-06-15 03:24:07'),
(241, 'en', 'manage_qr_code', 'Manage QR Code', '2025-06-15 03:24:07', '2025-06-15 03:24:07'),
(242, 'en', 'point_of_sale', 'Point of Sale', '2025-06-15 03:24:15', '2025-06-15 03:24:15'),
(243, 'en', 'receive_bill', 'Receive Bill', '2025-06-15 03:24:15', '2025-06-15 03:24:15'),
(244, 'en', 'show_all', 'Show All', '2025-06-15 03:24:15', '2025-06-15 03:24:15'),
(245, 'en', 'new_order', 'New Order', '2025-06-15 03:24:16', '2025-06-15 03:24:16'),
(246, 'en', 'select_a_waiter', 'Select a waiter', '2025-06-15 03:24:16', '2025-06-15 03:24:16'),
(247, 'en', 'select_table', 'Select Table', '2025-06-15 03:24:16', '2025-06-15 03:24:16'),
(248, 'en', 'select_a_customer', 'Select a customer', '2025-06-15 03:24:16', '2025-06-15 03:24:16'),
(249, 'en', 'customer', 'Customer', '2025-06-15 03:24:16', '2025-06-15 03:24:16'),
(250, 'en', 'card_details', 'Card Details', '2025-06-15 03:24:18', '2025-06-15 03:24:18'),
(251, 'en', 'account_name', 'Account Name', '2025-06-15 03:24:18', '2025-06-15 03:24:18'),
(252, 'en', 'card_number', 'Card Number', '2025-06-15 03:24:18', '2025-06-15 03:24:18'),
(253, 'en', 'expiration', 'Expiration', '2025-06-15 03:24:18', '2025-06-15 03:24:18'),
(254, 'en', 'cvvcvc', 'CVV/CVC', '2025-06-15 03:24:18', '2025-06-15 03:24:18'),
(255, 'en', 'save_information', 'Save Information', '2025-06-15 03:24:18', '2025-06-15 03:24:18'),
(256, 'en', 'subtotal', 'Subtotal', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(257, 'en', 'tax', 'Tax', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(258, 'en', 'shipping_charge', 'Shipping Charge', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(259, 'en', 'additional_discount', 'Additional Discount', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(260, 'en', 'fixed', 'Fixed', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(261, 'en', 'percent', 'Percent', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(262, 'en', 'order_total_', 'Order Total ', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(263, 'en', 'cash', 'Cash', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(264, 'en', 'card', 'Card', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(265, 'en', 'cod', 'COD', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(266, 'en', 'complete_order', 'Complete Order', '2025-06-15 03:24:19', '2025-06-15 03:24:19'),
(267, 'en', 'quick_customer_register', 'Quick Customer Register', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(268, 'en', 'customer_name', 'Customer Name', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(269, 'en', 'close', 'Close', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(270, 'en', 'order_code', 'Order Code', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(271, 'en', 'enter_order_code', 'Enter order code', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(272, 'en', 'amount', 'Amount', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(273, 'en', 'enter_amount', 'Enter amount', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(274, 'en', 'submit', 'Submit', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(275, 'en', 'available_table_list', 'Available Table List', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(276, 'en', 'processing', 'Processing...', '2025-06-15 03:24:20', '2025-06-15 03:24:20'),
(277, 'en', 'add', 'Add', '2025-06-15 03:24:21', '2025-06-15 03:24:21'),
(278, 'en', 'please_login_to_add_to_cart', 'Please login to add to cart', '2025-06-15 03:24:21', '2025-06-15 03:24:21'),
(279, 'en', 'cart_has_been_updated', 'Cart has been updated', '2025-06-15 03:24:21', '2025-06-15 03:24:21'),
(280, 'en', 'customer_is_saved', 'Customer is saved', '2025-06-15 03:24:21', '2025-06-15 03:24:21'),
(281, 'en', 'available_table', 'Available table', '2025-06-15 03:24:24', '2025-06-15 03:24:24'),
(282, 'en', 'seats_of_capacity', 'Seats of Capacity', '2025-06-15 03:24:24', '2025-06-15 03:24:24'),
(283, 'en', 'carts_loaded_successfully', 'Carts Loaded Successfully', '2025-06-15 03:24:25', '2025-06-15 03:24:25'),
(284, 'en', 'menu_list', 'Menu List', '2025-06-15 03:24:43', '2025-06-15 03:24:43'),
(285, 'en', 'manage_menus', 'Manage Menus', '2025-06-15 03:24:43', '2025-06-15 03:24:43'),
(286, 'en', 'add_menu', 'Add Menu', '2025-06-15 03:24:43', '2025-06-15 03:24:43'),
(287, 'en', 'add_new_menu', 'Add New Menu', '2025-06-15 03:24:45', '2025-06-15 03:24:45'),
(288, 'en', 'update_menu', 'Update Menu', '2025-06-15 03:24:45', '2025-06-15 03:24:45'),
(289, 'en', 'item_category_list', 'Item Category List', '2025-06-15 03:24:54', '2025-06-15 03:24:54'),
(290, 'en', 'manage_item_category', 'Manage Item Category', '2025-06-15 03:24:54', '2025-06-15 03:24:54'),
(291, 'en', 'add_item_category', 'Add Item Category', '2025-06-15 03:24:54', '2025-06-15 03:24:54'),
(292, 'en', 'vendor', 'Vendor', '2025-06-15 03:24:55', '2025-06-15 03:24:55'),
(293, 'en', 'add_new_item_category', 'Add New item Category', '2025-06-15 03:24:56', '2025-06-15 03:24:56'),
(294, 'en', 'update_item_category', 'Update Item Category', '2025-06-15 03:24:56', '2025-06-15 03:24:56'),
(295, 'en', 'change_password', 'Change Password', '2025-06-15 03:25:06', '2025-06-15 03:25:06'),
(296, 'en', 'current_plan_balance', 'Current Plan Balance', '2025-06-15 03:25:06', '2025-06-15 03:25:06'),
(297, 'en', 'old_password', 'Old Password', '2025-06-15 03:25:09', '2025-06-15 03:25:09'),
(298, 'en', 'info_change_successfully', 'Info Change Successfully', '2025-06-15 03:25:33', '2025-06-15 03:25:33'),
(299, 'en', 'last_7_days', 'Last 7 days', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(300, 'en', 'total_earning', 'Total Earning', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(301, 'en', 'last_30_days', 'Last 30 days', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(302, 'en', 'last_3_months', 'Last 3 months', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(303, 'en', 'top_5_category_sales', 'Top 5 Category Sales', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(304, 'en', 'last_30_days_orders', 'Last 30 Days Orders', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(305, 'en', 'sales_this_months', 'Sales This Months', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(306, 'en', 'total_orders', 'Total Orders', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(307, 'en', 'pending_orders', 'Pending Orders', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(308, 'en', 'hold_orders', 'Hold Orders', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(309, 'en', 'total_completed', 'Total Completed', '2025-06-15 03:25:49', '2025-06-15 03:25:49'),
(310, 'en', 'recent_reservations', 'Recent Reservations', '2025-06-15 03:25:50', '2025-06-15 03:25:50'),
(311, 'en', 'see_your_recent_reservations_here', 'See your recent reservations here', '2025-06-15 03:25:50', '2025-06-15 03:25:50'),
(312, 'en', 'earning', 'Earning', '2025-06-15 03:25:50', '2025-06-15 03:25:50'),
(313, 'en', 'register', 'Register', '2025-06-15 03:27:14', '2025-06-15 03:27:14'),
(314, 'en', 'last__name', 'Last  Name', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(315, 'en', 'i_agree_with_writebot', 'I agree with WriteBot', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(316, 'en', 'terms_of_service', 'Terms of Service', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(317, 'en', 'privacy_policy', 'Privacy Policy', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(318, 'en', '_and_default', ', and default', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(319, 'en', 'sign_up', 'Sign Up', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(320, 'en', 'already_have_an_account', 'Already have an account?', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(321, 'en', 'sign_in', 'Sign In', '2025-06-15 03:27:15', '2025-06-15 03:27:15'),
(322, 'en', 'vendor_management', 'Vendor Management', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(323, 'en', 'all_vendors', 'All Vendors', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(324, 'en', 'recurring_product_plan', 'Recurring Product Plan', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(325, 'en', 'admin_staff', 'Admin Staff', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(326, 'en', 'queries', 'Queries', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(327, 'en', 'all_credentials_setup', 'All Credentials Setup', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(328, 'en', 'email_template', 'Email Template', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(329, 'en', 'multi_currency', 'Multi Currency', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(330, 'en', 'payment_gateway', 'Payment Gateway', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(331, 'en', 'offline_payment', 'Offline Payment', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(332, 'en', 'cron_list', 'Cron List', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(333, 'en', 'utilities', 'Utilities', '2025-06-15 03:30:08', '2025-06-15 03:30:08'),
(334, 'en', 'vendor_list', 'Vendor List', '2025-06-15 03:30:44', '2025-06-15 03:30:44'),
(335, 'en', 'vendors', 'Vendors', '2025-06-15 03:30:44', '2025-06-15 03:30:44'),
(336, 'en', 'export_vendors', 'Export Vendors', '2025-06-15 03:30:44', '2025-06-15 03:30:44'),
(337, 'en', 'add_vendor', 'Add Vendor', '2025-06-15 03:30:44', '2025-06-15 03:30:44'),
(338, 'en', 'active_package', 'Active Package', '2025-06-15 03:30:44', '2025-06-15 03:30:44'),
(339, 'en', 'add_new_vendor', 'Add New Vendor', '2025-06-15 03:30:48', '2025-06-15 03:30:48'),
(340, 'en', 'account_status', 'Account Status', '2025-06-15 03:30:49', '2025-06-15 03:30:49'),
(341, 'en', 'select_account_status', 'Select Account Status', '2025-06-15 03:30:49', '2025-06-15 03:30:49'),
(342, 'en', 'item_category_created_successfully', 'Item Category Created Successfully', '2025-06-15 03:33:57', '2025-06-15 03:33:57'),
(343, 'en', 'reservation_created_successfully', 'Reservation Created Successfully', '2025-06-15 03:36:53', '2025-06-15 03:36:53'),
(344, 'en', 'edit_reservation', 'Edit Reservation', '2025-06-15 03:37:01', '2025-06-15 03:37:01'),
(345, 'en', 'edit_reservations', 'Edit Reservations', '2025-06-15 03:37:01', '2025-06-15 03:37:01'),
(346, 'en', 'reservation_updated_successfully', 'Reservation Updated Successfully', '2025-06-15 03:41:29', '2025-06-15 03:41:29'),
(347, 'en', 'support_category', 'Support Category', '2025-06-15 03:43:18', '2025-06-15 03:43:18'),
(348, 'en', 'add_support_category', 'Add Support Category', '2025-06-15 03:43:18', '2025-06-15 03:43:18'),
(349, 'en', 'update_category', 'Update Category', '2025-06-15 03:43:19', '2025-06-15 03:43:19'),
(350, 'en', 'successfully_stored_category', 'Successfully stored category', '2025-06-15 03:43:43', '2025-06-15 03:43:43'),
(351, 'en', 'edit_category', 'Edit Category', '2025-06-15 03:43:43', '2025-06-15 03:43:43'),
(352, 'en', 'delete_category', 'Delete Category', '2025-06-15 03:43:43', '2025-06-15 03:43:43'),
(353, 'en', 'add_new_priority', 'Add New Priority', '2025-06-15 03:44:05', '2025-06-15 03:44:05'),
(354, 'en', 'add_priority', 'Add Priority', '2025-06-15 03:44:06', '2025-06-15 03:44:06'),
(355, 'en', 'update_priority', 'Update Priority', '2025-06-15 03:44:06', '2025-06-15 03:44:06'),
(356, 'en', 'successfully_stored_priority', 'Successfully stored priority', '2025-06-15 03:44:12', '2025-06-15 03:44:12'),
(357, 'en', 'edit_priority', 'Edit Priority', '2025-06-15 03:44:13', '2025-06-15 03:44:13'),
(358, 'en', 'delete_priority', 'Delete Priority', '2025-06-15 03:44:13', '2025-06-15 03:44:13'),
(359, 'en', 'all_category', 'All Category', '2025-06-15 03:44:31', '2025-06-15 03:44:31'),
(360, 'en', 'failed_to_store_ticket', 'Failed to store ticket', '2025-06-15 03:45:14', '2025-06-15 03:45:14'),
(361, 'en', 'items_report', 'Items Report', '2025-06-15 03:52:28', '2025-06-15 03:52:28'),
(362, 'en', 'start_date__end_date', 'Start date - End date', '2025-06-15 03:52:28', '2025-06-15 03:52:28'),
(363, 'en', 'item_name', 'Item Name', '2025-06-15 03:52:28', '2025-06-15 03:52:28'),
(364, 'en', 'item_category_name', 'Item Category Name', '2025-06-15 03:52:28', '2025-06-15 03:52:28'),
(365, 'en', 'quantity_sold', 'Quantity Sold', '2025-06-15 03:52:28', '2025-06-15 03:52:28'),
(366, 'en', 'selling_price', 'Selling Price', '2025-06-15 03:52:28', '2025-06-15 03:52:28'),
(367, 'en', 'total_income', 'Total Income', '2025-06-15 03:52:28', '2025-06-15 03:52:28'),
(368, 'en', 'item_category_report', 'Item Category Report', '2025-06-15 03:53:45', '2025-06-15 03:53:45'),
(369, 'en', 'sales_report', 'Sales Report', '2025-06-15 03:54:08', '2025-06-15 03:54:08'),
(370, 'en', 'date', 'Date', '2025-06-15 03:54:08', '2025-06-15 03:54:08'),
(371, 'en', 'total_order', 'Total Order', '2025-06-15 03:54:08', '2025-06-15 03:54:08'),
(372, 'en', 'discount', 'Discount', '2025-06-15 03:54:08', '2025-06-15 03:54:08'),
(373, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_it_if_enabled_the_customer_can_chat_with_ai_video_expert_if_this_feature_is_included_in_their_package', 'If this feature is disabled, no one will not have access to it. If enabled, the customer can chat with AI Video expert if this feature is included in their package', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(374, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_it_if_enabled_the_customer_can_generate_image_if_this_feature_is_included_in_their_package', 'If this feature is disabled, no one will not have access to it. If enabled, the customer can generate image if this feature is included in their package', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(375, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_it_if_enabled_the_customer_can_chat_with_ai_image_expert_if_this_feature_is_included_in_their_package', 'If this feature is disabled, no one will not have access to it. If enabled, the customer can chat with AI Image expert if this feature is included in their package', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(376, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_itif_enabled_the_customer_can_check_detect_content_with_ai_if_this_feature_is_included_in_their_package', 'If this feature is disabled, no one will not have access to it.If enabled, the customer can check Detect content with AI if this feature is included in their package', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(377, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_itif_enabled_the_customer_can_check_plagiarism_with_ai_if_this_feature_is_included_in_their_package', 'If this feature is disabled, no one will not have access to it.If enabled, the customer can check Plagiarism with AI if this feature is included in their package', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(378, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_itif_enabled_the_customer_can_convert_speech_to_text_if_this_feature_is_included_in_their_package', 'If this feature is disabled, no one will not have access to it.If enabled, the customer can convert Speech to Text if this feature is included in their package', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(379, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_itif_enabled_the_customer_can_convert_text_to_speech_if_this_feature_is_included_in_their_package', 'If this feature is disabled, no one will not have access to it.If enabled, the customer can convert text to speech if this feature is included in their package', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(380, 'en', 'if_this_feature_is_disabled_no_one_will_not_have_access_to_it', 'If this feature is disabled, no one will not have access to it', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(381, 'en', 'if_this_feature_is_disabled_can_not_generate_image_when_blog_article_generate', 'If this feature is disabled, can not generate image when blog article generate', '2025-06-15 03:55:34', '2025-06-15 03:55:34'),
(382, 'en', 'features_settings', 'Features Settings', '2025-06-15 03:55:35', '2025-06-15 03:55:35'),
(383, 'en', 'navbar', 'Navbar', '2025-06-15 03:55:35', '2025-06-15 03:55:35'),
(384, 'en', 'invoice_settings', 'Invoice Settings', '2025-06-15 03:55:35', '2025-06-15 03:55:35'),
(385, 'en', 'invoice_logo', 'Invoice Logo', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(386, 'en', 'choose_logo', 'Choose logo', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(387, 'en', 'code_prefix', 'Code Prefix', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(388, 'en', 'font_size_as_px', 'Font Size as px', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(389, 'en', 'invoice_width_in_mm_size', 'Invoice Width in mm Size', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(390, 'en', 'code_prefix_start', 'Code Prefix Start', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(391, 'en', 'thanks_message', 'Thanks Message', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(392, 'en', 'save_configuration', 'Save Configuration', '2025-06-15 03:55:37', '2025-06-15 03:55:37'),
(393, 'en', 'delete_all', 'Delete All', '2025-06-15 03:56:08', '2025-06-15 03:56:08'),
(394, 'en', 'issue', 'Issue', '2025-06-15 03:56:08', '2025-06-15 03:56:08'),
(395, 'en', 'general_information', 'General Information', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(396, 'en', 'general_settings', 'General Settings', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(397, 'en', 'subscription_setting', 'Subscription Setting', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(398, 'en', 'affiliate_configurations', 'Affiliate Configurations', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(399, 'en', 'seo_meta_configuration', 'SEO Meta Configuration', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(400, 'en', 'cookie_consent', 'Cookie Consent', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(401, 'en', 'custom_scripts__css', 'Custom Scripts & CSS', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(402, 'en', 'copywrite_text', 'CopyWrite Text', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(403, 'en', 'social_links', 'Social Links', '2025-06-15 03:56:29', '2025-06-15 03:56:29'),
(404, 'en', 'system_info_setup', 'System Info Setup', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(405, 'en', 'system_title', 'System Title', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(406, 'en', 'browser_tab_title_separator', 'Browser Tab Title Separator', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(407, 'en', 'contact_email', 'Contact Email', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(408, 'en', 'contact_phone', 'Contact Phone', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(409, 'en', 'contact_address', 'Contact Address', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(410, 'en', 'dashboard_logo_for_light_version', 'Dashboard logo for light version', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(411, 'en', 'dashboard_logo_for_dark_version', 'Dashboard logo for dark version', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(412, 'en', 'dashboard_collapseable_icon', 'Dashboard Collapseable Icon', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(413, 'en', 'choose_icon', 'Choose Icon', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(414, 'en', 'favicon', 'Favicon', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(415, 'en', 'preloader', 'Preloader', '2025-06-15 03:56:32', '2025-06-15 03:56:32'),
(416, 'en', 'system_setting_configuration', 'System Setting Configuration', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(417, 'en', 'enable_preloader', 'Enable Preloader', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(418, 'en', 'enable', 'Enable', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(419, 'en', 'disable', 'Disable', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(420, 'en', 'date_format', 'Date Format', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(421, 'en', 'default_currency', 'Default Currency', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(422, 'en', 'usd', 'USD', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(423, 'en', 'set_default_language', 'Set Default Language', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(424, 'en', 'english', 'English', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(425, 'en', 'active_storage', 'Active Storage', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(426, 'en', 'storage', 'Storage', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(427, 'en', 'enable_maintenance_mode', 'Enable Maintenance Mode', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(428, 'en', 'frontend_status', 'Frontend Status', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(429, 'en', 'if_disable_only_login_registration_page_will_be_show', 'if disable only login, registration page will be show.', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(430, 'en', 'customer_registration', 'Customer Registration', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(431, 'en', 'email_required', 'Email Required', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(432, 'en', 'email__phone_both_required', 'Email & Phone Both Required', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(433, 'en', 'registration_verification', 'Registration Verification', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(434, 'en', 'email_verification', 'Email Verification', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(435, 'en', 'otp_verification', 'OTP Verification', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(436, 'en', 'send_welcome_email_after_registration', 'Send Welcome Email After Registration', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(437, 'en', 'balance_carry_forward', 'Balance Carry Forward:', '2025-06-15 03:56:36', '2025-06-15 03:56:36'),
(438, 'en', 'remaining_balance_from_active_packageonly_for_active_will_be_added_to_next_package_balancebrthis_service_is_applicable_for_same_package__lifetime_to_lifetime_yearly_to_yearly_monthly_to_monthly_and_prepaid_to_prepaid_package', 'Remaining balance from active package(only for active) will be added to next package balance.<br>This service is applicable for same package - Lifetime to Lifetime, Yearly to Yearly, Monthly to Monthly and Prepaid to Prepaid package.', '2025-06-15 03:56:37', '2025-06-15 03:56:37'),
(439, 'en', 'auto_activated_new_package_expire_old_package', 'Auto Activated New package Expire Old Package', '2025-06-15 03:56:37', '2025-06-15 03:56:37'),
(440, 'en', 'if_enable_running_package_expire_when_purchase_to_new_package', 'if enable, running package expire when purchase to new package', '2025-06-15 03:56:37', '2025-06-15 03:56:37'),
(441, 'en', 'allow_user_to_cancel_auto_subscription', 'Allow user to cancel Auto Subscription', '2025-06-15 03:56:37', '2025-06-15 03:56:37'),
(442, 'en', 'if_enable_user_can_cancel_auto_recurring_payment_if_purchase_from_paypal', 'if enable, user can cancel auto recurring payment if purchase from paypal', '2025-06-15 03:56:37', '2025-06-15 03:56:37'),
(443, 'en', 'allow_user_to_active_auto_subscription', 'Allow user to Active Auto Subscription', '2025-06-15 03:56:37', '2025-06-15 03:56:37'),
(444, 'en', 'if_enable_user_can_active_auto_recurring_payment_if_purchase_from_paypal', 'if enable, user can Active auto recurring payment if purchase from paypal.', '2025-06-15 03:56:37', '2025-06-15 03:56:37'),
(445, 'en', 'affiliate_configurations_setting', 'Affiliate Configurations Setting', '2025-06-15 03:56:38', '2025-06-15 03:56:38'),
(446, 'en', 'affiliate_commission_', 'Affiliate Commission %', '2025-06-15 03:56:38', '2025-06-15 03:56:38'),
(447, 'en', 'minimum_withdrawal_amount', 'Minimum Withdrawal Amount', '2025-06-15 03:56:38', '2025-06-15 03:56:38'),
(448, 'en', 'withdraw_amount_calculate_with', 'withdraw amount calculate with', '2025-06-15 03:56:38', '2025-06-15 03:56:38'),
(449, 'en', 'allow_commission_continuously', 'Allow Commission Continuously', '2025-06-15 03:56:39', '2025-06-15 03:56:39'),
(450, 'en', 'if_enabled_user_will_get_commission_for_each_subscriptions_of_referred_user_otherwise_only_for_the_first_subscription', 'If enabled, user will get commission for each subscriptions of referred user. Otherwise only for the first subscription.', '2025-06-15 03:56:39', '2025-06-15 03:56:39'),
(451, 'en', 'payout_payment_methods', 'Payout Payment Methods', '2025-06-15 03:56:39', '2025-06-15 03:56:39'),
(452, 'en', 'enable_affiliate_system', 'Enable Affiliate System', '2025-06-15 03:56:39', '2025-06-15 03:56:39'),
(453, 'en', 'meta_title', 'Meta Title', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(454, 'en', 'type_meta_title', 'Type meta title', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(455, 'en', 'set_a_meta_tag_title_recommended_to_be_simple_and_unique', 'Set a meta tag title. Recommended to be simple and unique.', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(456, 'en', 'meta_description', 'Meta Description', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(457, 'en', 'type_your_meta_description', 'Type your meta description', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(458, 'en', 'meta_keywords', 'Meta Keywords', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(459, 'en', 'meta_image', 'Meta Image', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(460, 'en', 'only_jpg_png_webp_will_be_accepted', 'Only *jpg, png, webp will be accepted', '2025-06-15 03:56:40', '2025-06-15 03:56:40'),
(461, 'en', 'cookie_consent_text', 'Cookie Consent Text', '2025-06-15 03:56:41', '2025-06-15 03:56:41'),
(462, 'en', 'enable_cookie_consent', 'Enable Cookie Consent?', '2025-06-15 03:56:41', '2025-06-15 03:56:41'),
(463, 'en', 'custom_scripts', 'Custom Scripts', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(464, 'en', 'header_custom_script__before', 'Header custom script - before', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(465, 'en', 'copy_or_write_your_custom_script_here', 'Copy or write your custom script here', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(466, 'en', 'footer_custom_script__before', 'Footer custom script - before', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(467, 'en', 'custom_css__before', 'Custom css - before', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(468, 'en', 'copy_or_write_your_custom_css_here', 'Copy or write your custom css here', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(469, 'en', 'enable_custom_script', 'Enable Custom script?', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(470, 'en', 'enable_custom_css', 'Enable Custom CSS?', '2025-06-15 03:56:43', '2025-06-15 03:56:43'),
(471, 'en', 'facebook_link', 'Facebook Link', '2025-06-15 03:56:45', '2025-06-15 03:56:45'),
(472, 'en', 'twitter_link', 'Twitter Link', '2025-06-15 03:56:45', '2025-06-15 03:56:45'),
(473, 'en', 'instagram_link', 'Instagram Link', '2025-06-15 03:56:45', '2025-06-15 03:56:45'),
(474, 'en', 'linkedin', 'Linked-IN', '2025-06-15 03:56:45', '2025-06-15 03:56:45'),
(475, 'en', 'successfully_stored_ticket', 'Successfully stored ticket', '2025-06-15 04:14:49', '2025-06-15 04:14:49'),
(476, 'en', 'ticket', 'Ticket', '2025-06-15 04:14:54', '2025-06-15 04:14:54'),
(477, 'en', 'post_a_reply', 'Post a Reply', '2025-06-15 04:14:54', '2025-06-15 04:14:54'),
(478, 'en', 'reply_ticket', 'Reply Ticket', '2025-06-15 04:14:54', '2025-06-15 04:14:54'),
(479, 'en', 'ticket_overview', 'Ticket Overview', '2025-06-15 04:14:54', '2025-06-15 04:14:54'),
(480, 'en', 'ttile', 'Ttile', '2025-06-15 04:14:54', '2025-06-15 04:14:54'),
(481, 'en', 'created_by', 'Created By', '2025-06-15 04:14:54', '2025-06-15 04:14:54'),
(482, 'en', 'assigned_staff', 'Assigned Staff', '2025-06-15 04:14:54', '2025-06-15 04:14:54'),
(483, 'en', 'orders_', 'Orders ', '2025-06-15 04:39:27', '2025-06-15 04:39:27'),
(484, 'en', 'manage_orders', 'Manage Orders', '2025-06-15 04:39:27', '2025-06-15 04:39:27'),
(485, 'en', 'orders_list', 'Orders List', '2025-06-15 04:39:27', '2025-06-15 04:39:27'),
(486, 'en', 'fname', 'F.Name', '2025-06-15 04:42:49', '2025-06-15 04:42:49'),
(487, 'en', 'lname', 'L.Name', '2025-06-15 04:42:49', '2025-06-15 04:42:49'),
(488, 'en', 'successfully_retrieved_customer', 'Successfully retrieved customer', '2025-06-15 04:58:42', '2025-06-15 04:58:42');
INSERT INTO `localizations` (`id`, `lang_key`, `t_key`, `t_value`, `created_at`, `updated_at`) VALUES
(489, 'en', 'successfully_retrieved_merchant', 'Successfully retrieved merchant', '2025-06-15 05:02:44', '2025-06-15 05:02:44'),
(490, 'en', 'successfully_subscription_plan_retrieved', 'Successfully Subscription Plan retrieved', '2025-06-15 05:03:13', '2025-06-15 05:03:13'),
(491, 'en', 'update_vendor', 'Update Vendor', '2025-06-15 06:04:30', '2025-06-15 06:04:30'),
(492, 'en', 'successfully_merchant_updated', 'Successfully merchant Updated', '2025-06-15 06:09:12', '2025-06-15 06:09:12'),
(493, 'en', 'no_action_available', 'No action available', '2025-06-15 06:22:35', '2025-06-15 06:22:35'),
(494, 'en', 'manage_kitchen_orders', 'Manage Kitchen Orders', '2025-06-15 07:23:23', '2025-06-15 07:23:23'),
(495, 'en', 'kitchen_orders_list', 'Kitchen Orders List', '2025-06-15 07:23:23', '2025-06-15 07:23:23'),
(496, 'en', 'no_orders_found', 'No Orders Found', '2025-06-15 07:23:26', '2025-06-15 07:23:26'),
(497, 'en', 'edit_user', 'Edit User', '2025-06-15 07:25:10', '2025-06-15 07:25:10'),
(498, 'en', 'password_reset', 'Password Reset', '2025-06-15 22:18:17', '2025-06-15 22:18:17'),
(499, 'en', 'enter_your_email', 'Enter your email', '2025-06-15 22:18:17', '2025-06-15 22:18:17'),
(500, 'en', 'reset_with_phone', 'Reset with phone?', '2025-06-15 22:18:17', '2025-06-15 22:18:17'),
(501, 'en', 'reset_with_email', 'Reset with email?', '2025-06-15 22:18:17', '2025-06-15 22:18:17'),
(502, 'en', 'reset_password', 'Reset Password', '2025-06-15 22:18:17', '2025-06-15 22:18:17'),
(503, 'en', 'password_change_successfully', 'Password Change Successfully', '2025-06-15 22:23:24', '2025-06-15 22:23:24'),
(504, 'en', 'no_result_found_for', 'No Result found for', '2025-06-15 23:01:20', '2025-06-15 23:01:20'),
(505, 'en', 'no_result_found_for', 'No Result found for', '2025-06-15 23:01:20', '2025-06-15 23:01:20'),
(506, 'en', 'manage_menu_item', 'Manage Menu Item', '2025-06-15 23:01:31', '2025-06-15 23:01:31'),
(507, 'en', 'menu_item_list', 'Menu Item List', '2025-06-15 23:01:31', '2025-06-15 23:01:31'),
(508, 'en', 'add_menu_item', 'Add Menu Item', '2025-06-15 23:01:31', '2025-06-15 23:01:31'),
(509, 'en', 'price', 'Price', '2025-06-15 23:01:31', '2025-06-15 23:01:31'),
(510, 'en', 'addons', 'Addons', '2025-06-15 23:01:31', '2025-06-15 23:01:31'),
(511, 'en', 'item_image', 'Item Image', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(512, 'en', 'choose_item_image', 'Choose Item Image', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(513, 'en', 'select_menu', 'Select Menu', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(514, 'en', 'select_item_category', 'Select Item Category', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(515, 'en', 'preparation_time', 'Preparation Time', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(516, 'en', 'minutes', 'minutes', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(517, 'en', 'variations', 'Variations', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(518, 'en', 'add_more', 'Add more', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(519, 'en', 'add_addon', 'Add Addon', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(520, 'en', 'add_new_menu_item', 'Add New Menu Item', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(521, 'en', 'update_menuitem', 'Update MenuItem', '2025-06-15 23:01:33', '2025-06-15 23:01:33'),
(522, 'en', 'edit_menu_items', 'Edit Menu Items', '2025-06-15 23:01:41', '2025-06-15 23:01:41'),
(523, 'en', 'menu_item_updated_successfully', 'Menu Item updated successfully', '2025-06-15 23:01:46', '2025-06-15 23:01:46'),
(524, 'en', 'menu_item_update_validation_errors', 'Menu item update validation errors', '2025-06-15 23:01:59', '2025-06-15 23:01:59'),
(525, 'en', 'select_your_variation', 'Select Your Variation', '2025-06-15 23:02:54', '2025-06-15 23:02:54'),
(526, 'en', 'variation', 'Variation', '2025-06-15 23:02:54', '2025-06-15 23:02:54'),
(527, 'en', 'add_ons', 'Add Ons', '2025-06-15 23:02:54', '2025-06-15 23:02:54'),
(528, 'en', 'optional', 'Optional', '2025-06-15 23:02:54', '2025-06-15 23:02:54'),
(529, 'en', 'add_item', 'Add Item', '2025-06-15 23:02:55', '2025-06-15 23:02:55'),
(530, 'en', 'monthly', 'Monthly', '2025-06-15 23:17:30', '2025-06-15 23:17:30'),
(531, 'en', 'yearly', 'Yearly', '2025-06-15 23:17:30', '2025-06-15 23:17:30'),
(532, 'en', 'choose_your_subscription_plan_from_the_options_below_select_the_plan_that_best_suits_your_needs_to_get_started_with_our_services', 'Choose your subscription plan from the options below. Select the plan that best suits your needs to get started with our services.', '2025-06-15 23:17:30', '2025-06-15 23:17:30'),
(533, 'en', 'subscription_plan_histories', 'Subscription Plan Histories', '2025-06-15 23:17:37', '2025-06-15 23:17:37'),
(534, 'en', 'package', 'Package', '2025-06-15 23:17:37', '2025-06-15 23:17:37'),
(535, 'en', 'invalid_login_credentials', 'Invalid login credentials.', '2025-06-15 23:18:54', '2025-06-15 23:18:54'),
(536, 'en', 'create_and_add_subscription_plans_for_customers_to_select_these_plans_will_be_visible_to_customers_during_the_subscription_process', 'Create and add subscription plans for customers to select. These plans will be visible to customers during the subscription process', '2025-06-15 23:19:12', '2025-06-15 23:19:12'),
(537, 'en', 'is_active', 'Is Active?', '2025-06-15 23:19:12', '2025-06-15 23:19:12'),
(538, 'en', 'if_active_this_will_be_applied_to_new_users_registration', 'If active, this will be applied to new user\'s registration.', '2025-06-15 23:19:13', '2025-06-15 23:19:13'),
(539, 'en', 'edit_this_plan', 'Edit this plan', '2025-06-15 23:19:13', '2025-06-15 23:19:13'),
(540, 'en', 'delete_this_plan', 'Delete this plan', '2025-06-15 23:19:13', '2025-06-15 23:19:13'),
(541, 'en', 'successfully_stored_subscription_plan', 'Successfully stored Subscription Plan', '2025-06-15 23:19:25', '2025-06-15 23:19:25'),
(542, 'en', 'set_0_to_make_it_free', 'Set $0 to make it free', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(543, 'en', 'percentage', 'Percentage', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(544, 'en', 'is', 'Is', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(545, 'en', 'unlimited', 'Unlimited', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(546, 'en', 'if_this_is_enabled_user_will_be_able_to_use_unlimited_balance', 'If this is enabled, user will be able to use unlimited balance.', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(547, 'en', 'show', 'Show', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(548, 'en', 'in_plan', 'in Plan', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(549, 'en', 'if_this_is_checked_it_will_be_shown_in_the_subscription_plan_list', 'If this is Checked, it will be shown in the subscription plan list', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(550, 'en', 'active', 'Active', '2025-06-15 23:19:34', '2025-06-15 23:19:34'),
(551, 'en', 'if_this_is_enabled_user_will_be_able_to_use_the_feature', 'If this is enabled, user will be able to use the feature.', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(552, 'en', 'if_this_is_enabled_vendors_can_use_kitchen_panel', 'If this is enabled, vendors can use kitchen panel.', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(553, 'en', 'if_this_is_enabled_vendors_can_use_reservations', 'If this is enabled, vendors can use reservations.', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(554, 'en', 'free_support', 'Free Support', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(555, 'en', 'if_this_is_enabled_you_have_to_provide_free_support_to_the_users', 'If this is enabled, you have to provide free support to the users.', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(556, 'en', 'if_this_is_enabled_vendors_can_create_teams', 'If this is enabled, vendors can create teams.', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(557, 'en', 'type_additional_features', 'Type additional features', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(558, 'en', 'comma_separated_feature_afeature_b', 'Comma separated: Feature A,Feature B', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(559, 'en', 'is_featured_plan', 'Is featured plan?', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(560, 'en', 'if_this_is_enabled_a_recommend_badge_will_be_shown_in_the_subscription_plan', 'If this is enabled, a recommend badge will be shown in the subscription plan.', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(561, 'en', 'successfully_retrieved_subscription_plan', 'Successfully retrieved Subscription Plan', '2025-06-15 23:19:35', '2025-06-15 23:19:35'),
(562, 'en', 'successfully_subscription_plan_updated', 'Successfully Subscription Plan Updated', '2025-06-15 23:19:50', '2025-06-15 23:19:50'),
(563, 'en', 'expiration_duration', 'Expiration duration', '2025-06-15 23:20:36', '2025-06-15 23:20:36'),
(564, 'en', 'expire_in_number_in_days_for_starter_package', 'Expire in number in days for Starter Package', '2025-06-15 23:20:37', '2025-06-15 23:20:37'),
(565, 'en', 'payment_methods', 'Payment Methods', '2025-06-15 23:24:09', '2025-06-15 23:24:09'),
(566, 'en', 'paypal_configuration', 'Paypal Configuration', '2025-06-15 23:24:11', '2025-06-15 23:24:11'),
(567, 'en', 'paypal_client_id', 'Paypal Client ID', '2025-06-15 23:24:11', '2025-06-15 23:24:11'),
(568, 'en', 'paypal_client_secret', 'Paypal Client Secret', '2025-06-15 23:24:11', '2025-06-15 23:24:11'),
(569, 'en', 'enable_paypal', 'Enable Paypal', '2025-06-15 23:24:11', '2025-06-15 23:24:11'),
(570, 'en', 'gateway', 'Gateway', '2025-06-15 23:24:11', '2025-06-15 23:24:11'),
(571, 'en', 'sandbox', 'Sandbox', '2025-06-15 23:24:11', '2025-06-15 23:24:11'),
(572, 'en', 'live', 'Live', '2025-06-15 23:24:11', '2025-06-15 23:24:11'),
(573, 'en', 'offline_payment_method', 'Offline Payment method', '2025-06-15 23:24:12', '2025-06-15 23:24:12'),
(574, 'en', 'offline_payment_method', 'Offline Payment method', '2025-06-15 23:24:12', '2025-06-15 23:24:12'),
(575, 'en', 'offline_payment_method', 'Offline Payment method', '2025-06-15 23:24:12', '2025-06-15 23:24:12'),
(576, 'en', 'add_offlinepayment_method', 'Add OfflinePayment Method', '2025-06-15 23:24:12', '2025-06-15 23:24:12'),
(577, 'en', 'add_offlinepayment_method', 'Add OfflinePayment Method', '2025-06-15 23:24:12', '2025-06-15 23:24:12'),
(578, 'en', 'add_offlinepayment_method', 'Add OfflinePayment Method', '2025-06-15 23:24:12', '2025-06-15 23:24:12'),
(579, 'en', 'stripe_configuration', 'Stripe Configuration', '2025-06-15 23:24:13', '2025-06-15 23:24:13'),
(580, 'en', 'publishable_key', 'Publishable Key', '2025-06-15 23:24:13', '2025-06-15 23:24:13'),
(581, 'en', 'stripe_secret', 'Stripe Secret', '2025-06-15 23:24:13', '2025-06-15 23:24:13'),
(582, 'en', 'enable_stripe', 'Enable Stripe', '2025-06-15 23:24:13', '2025-06-15 23:24:13'),
(583, 'en', 'paytm_configuration', 'PayTm Configuration', '2025-06-15 23:24:14', '2025-06-15 23:24:14'),
(584, 'en', 'paytm_environment', 'PayTm Environment', '2025-06-15 23:24:15', '2025-06-15 23:24:15'),
(585, 'en', 'paytm_merchant_id', 'PayTm Merchant ID', '2025-06-15 23:24:15', '2025-06-15 23:24:15'),
(586, 'en', 'paytm_merchant_key', 'PayTm Merchant Key', '2025-06-15 23:24:15', '2025-06-15 23:24:15'),
(587, 'en', 'paytm_merchant_website', 'PayTm Merchant Website', '2025-06-15 23:24:15', '2025-06-15 23:24:15'),
(588, 'en', 'paytm_channel', 'PayTm Channel', '2025-06-15 23:24:15', '2025-06-15 23:24:15'),
(589, 'en', 'paytm_industry_type', 'PayTm Industry Type', '2025-06-15 23:24:15', '2025-06-15 23:24:15'),
(590, 'en', 'enable_paytm', 'Enable PayTm', '2025-06-15 23:24:15', '2025-06-15 23:24:15'),
(591, 'en', 'add_offline_payment_method', 'Add Offline Payment Method', '2025-06-15 23:24:17', '2025-06-15 23:24:17'),
(592, 'en', 'update_offline_payment_method', 'Update Offline Payment Method', '2025-06-15 23:24:17', '2025-06-15 23:24:17'),
(593, 'en', 'razorpay_configuration', 'Razorpay Configuration', '2025-06-15 23:24:17', '2025-06-15 23:24:17'),
(594, 'en', 'razorpay_key', 'Razorpay Key', '2025-06-15 23:24:17', '2025-06-15 23:24:17'),
(595, 'en', 'razorpay_secret', 'Razorpay Secret', '2025-06-15 23:24:17', '2025-06-15 23:24:17'),
(596, 'en', 'enable_razorpay', 'Enable Razorpay', '2025-06-15 23:24:17', '2025-06-15 23:24:17'),
(597, 'en', 'iyzico_configuration', 'Iyzico Configuration', '2025-06-15 23:24:19', '2025-06-15 23:24:19'),
(598, 'en', 'iyzico_api_key', 'IyZico API Key', '2025-06-15 23:24:19', '2025-06-15 23:24:19'),
(599, 'en', 'iyzico_secret_key', 'IyZico Secret Key', '2025-06-15 23:24:19', '2025-06-15 23:24:19'),
(600, 'en', 'enable_iyzico', 'Enable IyZico', '2025-06-15 23:24:19', '2025-06-15 23:24:19'),
(601, 'en', 'enable_test_sandbox_mode', 'Enable Test Sandbox Mode', '2025-06-15 23:24:19', '2025-06-15 23:24:19'),
(602, 'en', 'paystack_configuration', 'Paystack Configuration', '2025-06-15 23:24:21', '2025-06-15 23:24:21'),
(603, 'en', 'paystack_public_key', 'Paystack Public Key', '2025-06-15 23:24:21', '2025-06-15 23:24:21'),
(604, 'en', 'secret_key', 'Secret Key', '2025-06-15 23:24:21', '2025-06-15 23:24:21'),
(605, 'en', 'merchant_email', 'Merchant Email', '2025-06-15 23:24:21', '2025-06-15 23:24:21'),
(606, 'en', 'paystack_callback', 'Paystack Callback', '2025-06-15 23:24:21', '2025-06-15 23:24:21'),
(607, 'en', 'paystack_currency_code', 'Paystack Currency Code', '2025-06-15 23:24:21', '2025-06-15 23:24:21'),
(608, 'en', 'enable_paystack', 'Enable Paystack', '2025-06-15 23:24:21', '2025-06-15 23:24:21'),
(609, 'en', 'flutterwave_configuration', 'Flutterwave Configuration', '2025-06-15 23:24:23', '2025-06-15 23:24:23'),
(610, 'en', 'flutterwave_public_key', 'Flutterwave Public Key', '2025-06-15 23:24:23', '2025-06-15 23:24:23'),
(611, 'en', 'flutterwave_secret_key', 'Flutterwave Secret Key', '2025-06-15 23:24:23', '2025-06-15 23:24:23'),
(612, 'en', 'flutterwave_secret_hash', 'Flutterwave Secret Hash', '2025-06-15 23:24:23', '2025-06-15 23:24:23'),
(613, 'en', 'enable_flutterwave', 'Enable Flutterwave', '2025-06-15 23:24:23', '2025-06-15 23:24:23'),
(614, 'en', 'add_duitku_configuration', 'Add Duitku Configuration', '2025-06-15 23:24:26', '2025-06-15 23:24:26'),
(615, 'en', 'duitku_api_key', 'Duitku Api Key', '2025-06-15 23:24:26', '2025-06-15 23:24:26'),
(616, 'en', 'duitku_merchant_code', 'Duitku Merchant Code', '2025-06-15 23:24:26', '2025-06-15 23:24:26'),
(617, 'en', 'duitku_callback_url', 'Duitku Callback Url', '2025-06-15 23:24:26', '2025-06-15 23:24:26'),
(618, 'en', 'duitku_return_url', 'Duitku Return Url', '2025-06-15 23:24:26', '2025-06-15 23:24:26'),
(619, 'en', 'duitku_env', 'Duitku Env', '2025-06-15 23:24:26', '2025-06-15 23:24:26'),
(620, 'en', 'enable_duitku', 'Enable Duitku', '2025-06-15 23:24:26', '2025-06-15 23:24:26'),
(621, 'en', 'yookassa_configuration', 'Yookassa Configuration', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(622, 'en', 'yookassa_shop_id', 'Yookassa Shop ID', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(623, 'en', 'yookassa_secret_key', 'Yookassa Secret Key', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(624, 'en', 'yookassa_currency_code', 'YOOKASSA Currency Code', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(625, 'en', 'enable_yookassa', 'Enable Yookassa', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(626, 'en', 'reciept_', 'Reciept ?', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(627, 'en', 'vat_rates_yookassa', 'VAT rates Yookassa', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(628, 'en', 'vat_not_included', 'VAT not included', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(629, 'en', '0_vat_rate', '0% VAT rate', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(630, 'en', '10_vat_rate', '10% VAT rate', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(631, 'en', '20_receipts_vat_rate', '20% receipt’s VAT rate', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(632, 'en', '10110_receipts_estimate_vat_rate', '10/110 receipt’s estimate VAT rate', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(633, 'en', '20120_receipts_estimate_vat_rate', '20/120 receipt’s estimate VAT rate', '2025-06-15 23:24:28', '2025-06-15 23:24:28'),
(634, 'en', 'molile_configuration', 'Molile Configuration', '2025-06-15 23:24:30', '2025-06-15 23:24:30'),
(635, 'en', 'molile_api_key', 'Molile API Key', '2025-06-15 23:24:30', '2025-06-15 23:24:30'),
(636, 'en', 'enable_molile', 'Enable Molile', '2025-06-15 23:24:30', '2025-06-15 23:24:30'),
(637, 'en', 'mercadopago_configuration', 'Mercadopago Configuration', '2025-06-15 23:24:31', '2025-06-15 23:24:31'),
(638, 'en', 'mercadopago_secret_key', 'Mercadopago Secret Key', '2025-06-15 23:24:31', '2025-06-15 23:24:31'),
(639, 'en', 'enable_mercadopago', 'Enable Mercadopago', '2025-06-15 23:24:31', '2025-06-15 23:24:31'),
(640, 'en', 'midtrans_configuration', 'Midtrans Configuration', '2025-06-15 23:24:32', '2025-06-15 23:24:32'),
(641, 'en', 'midtrans_server_key', 'Midtrans Server Key', '2025-06-15 23:24:32', '2025-06-15 23:24:32'),
(642, 'en', 'midtrans_client_key', 'Midtrans Client Key', '2025-06-15 23:24:33', '2025-06-15 23:24:33'),
(643, 'en', 'finish_url', 'Finish URL', '2025-06-15 23:24:33', '2025-06-15 23:24:33'),
(644, 'en', 'payment_notification_url', 'Payment Notification URL', '2025-06-15 23:24:33', '2025-06-15 23:24:33'),
(645, 'en', 'payment_failed_url', 'Payment Failed URL', '2025-06-15 23:24:33', '2025-06-15 23:24:33'),
(646, 'en', 'enable_midtrans', 'Enable Midtrans', '2025-06-15 23:24:33', '2025-06-15 23:24:33'),
(647, 'en', 'offline_configuration', 'Offline Configuration', '2025-06-15 23:24:34', '2025-06-15 23:24:34'),
(648, 'en', 'enable_offline', 'Enable Offline', '2025-06-15 23:24:34', '2025-06-15 23:24:34'),
(649, 'en', 'image', 'Image', '2025-06-15 23:24:34', '2025-06-15 23:24:34'),
(650, 'en', 'choose_image', 'Choose Image', '2025-06-15 23:24:34', '2025-06-15 23:24:34'),
(651, 'en', 'successfully_stored_offline_payment_method', 'Successfully stored Offline Payment Method', '2025-06-15 23:25:16', '2025-06-15 23:25:16'),
(652, 'en', 'operation_successfully_please_wait_for_approval', 'Operation successfully. Please Wait For Approval', '2025-06-15 23:25:50', '2025-06-15 23:25:50'),
(653, 'en', 'subscription_plan_details', 'Subscription Plan Details', '2025-06-15 23:26:13', '2025-06-15 23:26:13'),
(654, 'en', 'plan_details', 'Plan Details', '2025-06-15 23:26:13', '2025-06-15 23:26:13'),
(655, 'en', 'do_you_want_to_approve_or__resubmit', 'Do you want to approve or  resubmit?', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(656, 'en', 'active_now', 'Active Now', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(657, 'en', 'resubmit_request', 'Resubmit Request', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(658, 'en', 'payment_status', 'Payment status', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(659, 'en', 'subscription_status', 'Subscription status', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(660, 'en', 'paid_amount', 'Paid Amount', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(661, 'en', 'payment_note', 'Payment Note', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(662, 'en', 'feedback', 'Feedback', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(663, 'en', 'active_now_confirmation', 'Active Now Confirmation', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(664, 'en', 'expire_previous_package_and_start_new_package_from_now_enjoy_', 'Expire Previous Package and Start New package From Now, Enjoy !!', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(665, 'en', 'are_you_sure_to_active_this', 'Are you sure to Active this?', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(666, 'en', 'procced', 'Procced', '2025-06-15 23:26:14', '2025-06-15 23:26:14'),
(667, 'en', 'successfully_payment_status_has_been_approved', 'Successfully! Payment status has been approved.', '2025-06-15 23:26:22', '2025-06-15 23:26:22'),
(668, 'en', 'renew_now', 'Renew Now', '2025-06-15 23:27:36', '2025-06-15 23:27:36'),
(669, 'en', 'edit_table', 'Edit Table', '2025-06-15 23:31:31', '2025-06-15 23:31:31'),
(670, 'en', 'successfully_customer_updated', 'Successfully customer Updated', '2025-06-15 23:41:31', '2025-06-15 23:41:31'),
(671, 'en', 'mediamanager', 'MediaManager', '2025-06-15 23:42:33', '2025-06-15 23:42:33'),
(672, 'en', 'google_recaptcha_validation_error_seems_like_you_are_not_a_human', 'Google recaptcha validation error, seems like you are not a human.', '2025-06-16 00:28:11', '2025-06-16 00:28:11'),
(673, 'en', 'menu_items_store_validation_failed', 'Menu Items Store Validation failed', '2025-06-16 00:38:52', '2025-06-16 00:38:52'),
(674, 'en', 'menu_items_created_successfully', 'Menu Items Created Successfully', '2025-06-16 00:39:00', '2025-06-16 00:39:00'),
(675, 'en', 'item_added_to_cart', 'Item Added to Cart', '2025-06-16 01:26:20', '2025-06-16 01:26:20'),
(676, 'en', 'variant', 'Variant', '2025-06-16 01:26:20', '2025-06-16 01:26:20'),
(677, 'en', 'payment_method_is_required', 'Payment method is required', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(678, 'en', 'payment_method_must_be_in_codcashcard', 'Payment method must be in (cod,cash,card)', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(679, 'en', 'total_shipping_cost_must_be_greater_than_or_equal_1', 'Total shipping cost must be greater than or equal -1', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(680, 'en', 'please_select_a_table', 'Please, select a table', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(681, 'en', 'sorry_this_table_is_not_available', 'Sorry! This table is not available', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(682, 'en', 'sorry_this_customer_is_not_available', 'Sorry! This customer is not available', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(683, 'en', 'account_name_is_required_if_payment_method_is_card', 'Account name is required if payment method is card', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(684, 'en', 'card_number_is_required_if_payment_method_is_card', 'Card number is required if payment method is card', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(685, 'en', 'expiration_is_required_if_payment_method_is_card', 'Expiration is required if payment method is card', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(686, 'en', 'cvv_is_required_if_payment_method_is_card', 'CVV is required if payment method is card', '2025-06-16 02:53:52', '2025-06-16 02:53:52'),
(687, 'en', 'successfully_placed_order', 'Successfully placed order', '2025-06-16 02:54:40', '2025-06-16 02:54:40'),
(688, 'en', 'print', 'Print', '2025-06-16 02:54:46', '2025-06-16 02:54:46'),
(689, 'en', 'total_amount', 'Total Amount', '2025-06-16 02:54:46', '2025-06-16 02:54:46'),
(690, 'en', 'invoice', 'Invoice', '2025-06-16 02:55:40', '2025-06-16 02:55:40'),
(691, 'en', 'items', 'Items', '2025-06-16 02:55:40', '2025-06-16 02:55:40'),
(692, 'en', 'flat_', 'Flat ', '2025-06-16 02:55:40', '2025-06-16 02:55:40'),
(693, 'en', 'successfully_updated_order_status', 'Successfully updated order status', '2025-06-16 04:23:28', '2025-06-16 04:23:28'),
(694, 'en', 'successfully_updated_order_product_status', 'Successfully updated order product status', '2025-06-16 04:23:30', '2025-06-16 04:23:30'),
(695, 'en', 'successfully_updated', 'Successfully Updated', '2025-06-17 00:00:07', '2025-06-17 00:00:07'),
(696, 'en', 'login__register', 'Login & Register', '2025-06-17 00:00:24', '2025-06-17 00:00:24'),
(697, 'en', 'login_register_image', 'Login Register Image', '2025-06-17 00:00:43', '2025-06-17 00:00:43'),
(698, 'en', 'choose', 'Choose', '2025-06-17 00:00:43', '2025-06-17 00:00:43'),
(699, 'en', 'item_removed_from_cart', 'Item removed from cart', '2025-06-17 00:54:53', '2025-06-17 00:54:53'),
(701, 'en', 'error_placing_order', 'Error placing order', '2025-06-25 03:06:02', '2025-06-25 03:06:02'),
(703, 'en', 'oops_something_went_wrong_on_our_end_please_try_refreshing_the_page_or_come_back_later', 'Oops! Something went wrong on our end. Please try refreshing the page, or come back later.', '2025-06-25 03:55:00', '2025-06-25 03:55:00'),
(704, 'en', 'token', 'Token:', '2025-06-25 05:36:04', '2025-06-25 05:36:04'),
(705, 'en', 'invoice_no', 'Invoice No:', '2025-06-25 05:36:04', '2025-06-25 05:36:04'),
(706, 'en', 'table_no', 'Table No:', '2025-06-25 05:36:04', '2025-06-25 05:36:04'),
(707, 'en', 'order', 'Order', '2025-06-25 05:36:04', '2025-06-25 05:36:04'),
(708, 'en', 'view_order_details', 'View Order Details', '2025-06-25 05:36:04', '2025-06-25 05:36:04'),
(709, 'en', 'order_summery', 'Order Summery', '2025-06-25 05:36:04', '2025-06-25 05:36:04'),
(710, 'en', 'sub_total', 'Sub Total', '2025-06-25 05:36:04', '2025-06-25 05:36:04'),
(711, 'en', 'cart_updated_successfully', 'Cart Updated Successfully', '2025-06-25 05:41:30', '2025-06-25 05:41:30'),
(712, 'en', 'successfully_added_bill', 'Successfully added bill', '2025-06-25 06:30:34', '2025-06-25 06:30:34'),
(713, 'en', 'not_paid', 'Not Paid', '2025-06-25 06:56:08', '2025-06-25 06:56:08'),
(714, 'en', 'payment_status_updated_successfully', 'Payment Status Updated Successfully', '2025-06-25 07:03:08', '2025-06-25 07:03:08'),
(715, 'en', 'order_not_found', 'Order not found', '2025-06-25 07:04:02', '2025-06-25 07:04:02'),
(716, 'en', 'select_waiter', 'Select waiter', '2025-06-26 05:47:28', '2025-06-26 05:47:28'),
(717, 'en', 'select_customer', 'Select customer', '2025-06-26 05:47:28', '2025-06-26 05:47:28'),
(718, 'en', 'order_number', 'Order number', '2025-06-26 05:47:28', '2025-06-26 05:47:28'),
(719, 'en', 'enter_order_invoice_number', 'Enter order invoice number', '2025-06-26 05:47:28', '2025-06-26 05:47:28'),
(720, 'en', 'successfully_deleted_carts', 'Successfully Deleted Carts', '2025-06-26 05:47:32', '2025-06-26 05:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `media_managers`
--

CREATE TABLE `media_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_file` longtext DEFAULT NULL,
  `media_size` int(11) DEFAULT NULL,
  `media_type` varchar(255) DEFAULT NULL COMMENT 'video / image / pdf / ...',
  `media_name` text DEFAULT NULL,
  `media_extension` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_managers`
--

INSERT INTO `media_managers` (`id`, `media_file`, `media_size`, `media_type`, `media_name`, `media_extension`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/media/2.jpg', NULL, 'image', '2.jpg', 'jpg', 2, 1, 2, NULL, '2025-06-15 03:14:13', '2025-06-15 03:14:13', NULL),
(2, 'uploads/media/3.jpg', NULL, 'image', '3.jpg', 'jpg', 2, 1, 2, NULL, '2025-06-15 03:21:00', '2025-06-15 03:21:00', NULL),
(3, 'uploads/media/Frame-1261158463-5.jpg', NULL, 'image', 'Frame-1261158463-5.jpg', 'jpg', 2, 1, 2, NULL, '2025-06-15 23:54:00', '2025-06-15 23:54:00', NULL),
(4, 'uploads/media/Container-5.png', NULL, 'image', 'Container-5.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:30:34', '2025-06-16 00:30:34', NULL),
(5, 'uploads/media/Container-18.png', NULL, 'image', 'Container-18.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:32:50', '2025-06-16 00:32:50', NULL),
(6, 'uploads/media/Container-11.png', NULL, 'image', 'Container-11.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:34:22', '2025-06-16 00:34:22', NULL),
(7, 'uploads/media/Container.png', NULL, 'image', 'Container.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:38:11', '2025-06-16 00:38:11', NULL),
(8, 'uploads/media/Container-9.png', NULL, 'image', 'Container-9.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:46:12', '2025-06-16 00:46:12', NULL),
(9, 'uploads/media/Container-3.png', NULL, 'image', 'Container-3.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:46:32', '2025-06-16 00:46:32', NULL),
(10, 'uploads/media/Container-2.png', NULL, 'image', 'Container-2.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:46:47', '2025-06-16 00:46:47', NULL),
(11, 'uploads/media/Container-5.png', NULL, 'image', 'Container-5.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:47:01', '2025-06-16 00:47:01', NULL),
(12, 'uploads/media/Container-6.png', NULL, 'image', 'Container-6.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:47:11', '2025-06-16 00:47:11', NULL),
(13, 'uploads/media/Container-7.png', NULL, 'image', 'Container-7.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:47:23', '2025-06-16 00:47:23', NULL),
(14, 'uploads/media/Container-12.png', NULL, 'image', 'Container-12.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:47:37', '2025-06-16 00:47:37', NULL),
(15, 'uploads/media/Container-16.png', NULL, 'image', 'Container-16.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:47:46', '2025-06-16 00:47:46', NULL),
(16, 'uploads/media/Container-18.png', NULL, 'image', 'Container-18.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:47:58', '2025-06-16 00:47:58', NULL),
(17, 'uploads/media/Container-22.png', NULL, 'image', 'Container-22.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:48:12', '2025-06-16 00:48:12', NULL),
(18, 'uploads/media/Container-23.png', NULL, 'image', 'Container-23.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:48:24', '2025-06-16 00:48:24', NULL),
(19, 'uploads/media/Sandwich Image.png', NULL, 'image', 'Sandwich Image.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:54:49', '2025-06-16 00:54:49', NULL),
(20, 'uploads/media/Frame.png', NULL, 'image', 'Frame.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:55:08', '2025-06-16 00:55:08', NULL),
(21, 'uploads/media/Container-26.png', NULL, 'image', 'Container-26.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:55:50', '2025-06-16 00:55:50', NULL),
(22, 'uploads/media/Container-19.png', NULL, 'image', 'Container-19.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:56:47', '2025-06-16 00:56:47', NULL),
(23, 'uploads/media/Container-20.png', NULL, 'image', 'Container-20.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:57:32', '2025-06-16 00:57:32', NULL),
(24, 'uploads/media/Container-17.png', NULL, 'image', 'Container-17.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:57:47', '2025-06-16 00:57:47', NULL),
(25, 'uploads/media/Container-21.png', NULL, 'image', 'Container-21.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:58:11', '2025-06-16 00:58:11', NULL),
(26, 'uploads/media/Container-11.png', NULL, 'image', 'Container-11.png', 'png', 2, 1, 2, NULL, '2025-06-16 00:58:29', '2025-06-16 00:58:29', NULL),
(27, 'uploads/media/Container-3.png', NULL, 'image', 'Container-3.png', 'png', 2, 1, 2, NULL, '2025-06-16 01:24:48', '2025-06-16 01:24:48', NULL),
(28, 'uploads/media/Container-25.png', NULL, 'image', 'Container-25.png', 'png', 2, 1, 2, NULL, '2025-06-16 22:36:56', '2025-06-16 22:36:56', NULL),
(29, 'uploads/media/Container-24.png', NULL, 'image', 'Container-24.png', 'png', 2, 1, 2, NULL, '2025-06-16 22:46:09', '2025-06-16 22:46:09', NULL),
(30, 'uploads/media/Container-15.png', NULL, 'image', 'Container-15.png', 'png', 2, 1, 2, NULL, '2025-06-16 22:47:16', '2025-06-16 22:47:16', NULL),
(31, 'uploads/media/Container-4.png', NULL, 'image', 'Container-4.png', 'png', 2, 1, 2, NULL, '2025-06-16 22:49:06', '2025-06-16 22:49:06', NULL),
(32, 'uploads/media/Container-8.png', NULL, 'image', 'Container-8.png', 'png', 2, 1, 2, NULL, '2025-06-16 22:52:52', '2025-06-16 22:52:52', NULL),
(33, 'uploads/media/Restros.png', NULL, 'image', 'Restros.png', 'png', 1, 1, 1, NULL, '2025-06-16 23:59:40', '2025-06-16 23:59:40', NULL),
(34, 'uploads/media/Image-1.jpg', NULL, 'image', 'Image-1.jpg', 'jpg', 1, 1, 1, NULL, '2025-06-16 23:59:40', '2025-06-16 23:59:40', NULL),
(35, 'uploads/media/Fabicon.png', NULL, 'image', 'Fabicon.png', 'png', 1, 1, 1, NULL, '2025-06-16 23:59:40', '2025-06-16 23:59:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `is_active`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`, `vendor_id`) VALUES
(1, 'Breakfast', 1, 1, NULL, NULL, '2025-05-28 05:45:16', '2025-05-28 05:45:16', NULL, 1),
(2, 'Lunch', 1, 1, NULL, NULL, '2025-05-28 05:46:06', '2025-05-28 05:46:06', NULL, 1),
(3, 'Dinner', 1, 1, NULL, NULL, '2025-05-28 05:46:45', '2025-05-28 05:46:45', NULL, 1),
(4, 'Breakfast', 1, 2, NULL, NULL, '2025-05-28 05:45:16', '2025-05-28 05:45:16', NULL, 2),
(5, 'Lunch', 1, 2, NULL, NULL, '2025-05-28 05:46:06', '2025-05-28 05:46:06', NULL, 2),
(6, 'Dinner', 1, 2, NULL, NULL, '2025-05-28 05:46:45', '2025-05-28 05:46:45', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_05_03_000001_create_customer_columns', 1),
(5, '2019_05_03_000002_create_subscriptions_table', 1),
(6, '2019_05_03_000003_create_subscription_items_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_01_22_101200_create_branches_table', 1),
(10, '2024_02_24_051619_create_statuses_table', 1),
(11, '2024_03_26_090518_create_payment_gateways_table', 1),
(12, '2024_03_26_090639_create_payment_gateway_details_table', 1),
(13, '2024_03_27_043240_create_roles_table', 1),
(14, '2024_03_27_043530_create_user_roles_table', 1),
(15, '2024_03_27_043636_create_permissions_table', 1),
(16, '2024_03_27_043639_create_role_permissions_table', 1),
(17, '2024_03_27_043649_create_system_settings_table', 1),
(18, '2024_03_27_043722_create_subscription_plans_table', 1),
(19, '2024_03_27_043723_create_subscription_users_table', 1),
(20, '2024_03_27_043724_create_subscription_user_usages_table', 1),
(21, '2024_03_27_053918_create_jobs_table', 1),
(22, '2024_03_27_053932_create_notifications_table', 1),
(23, '2024_04_23_042116_create_media_managers_table', 1),
(24, '2024_05_12_133338_create_webhook_histories_table', 1),
(25, '2024_05_18_053225_create_storage_managers_table', 1),
(26, '2024_05_18_061744_create_languages_table', 1),
(27, '2024_05_18_114230_create_localizations_table', 1),
(28, '2024_05_18_124549_create_currencies_table', 1),
(29, '2024_05_19_090723_create_pages_table', 1),
(30, '2024_05_20_121614_create_f_a_q_s_table', 1),
(31, '2024_05_21_050911_create_support_categories_table', 1),
(32, '2024_05_21_050954_create_support_priorities_table', 1),
(33, '2024_05_21_051013_create_tickets_table', 1),
(34, '2024_05_21_051020_create_ticket_files_table', 1),
(35, '2024_05_21_051036_create_reply_tickets_table', 1),
(36, '2024_05_21_051047_create_assign_tickets_table', 1),
(37, '2024_06_06_084340_remove_user_id_from_role_permissions', 1),
(38, '2024_06_08_100215_add_column_is_allowed_in_demo_at_table_permissions', 1),
(39, '2024_06_09_070110_create_system_setting_localizations_table', 1),
(40, '2024_06_09_111131_create_client_feedback_table', 1),
(41, '2024_06_25_032445_create_email_templates_table', 1),
(42, '2024_06_30_113832_create_payment_gateway_products_table', 1),
(43, '2024_06_30_113959_create_payment_gateway_product_histories_table', 1),
(44, '2024_07_01_043955_create_grass_period_payments_table', 1),
(45, '2024_07_03_054313_create_offline_payment_methods_table', 1),
(46, '2024_08_07_080943_create_theme_tag_modules_table', 1),
(47, '2024_08_13_133722_create_subscribed_users_table', 1),
(48, '2024_08_14_094503_create_contact_us_messages_table', 1),
(49, '2024_08_23_085847_create_subscription_recurring_payments_table', 1),
(50, '2025_01_05_132145_drop_idx_role_unique_from_table_roles', 1),
(51, '2025_05_12_093340_create_areas_table', 1),
(52, '2025_05_12_115930_create_tables_table', 1),
(53, '2025_05_13_054816_create_menus_table', 1),
(54, '2025_05_13_063714_create_item_categories_table', 1),
(55, '2025_05_13_063740_create_products_table', 1),
(56, '2025_05_13_063742_create_product_attributes_table', 1),
(57, '2025_05_20_060200_create_qr_codes_table', 1),
(58, '2025_05_21_050716_add_qr_code_column_to_menu_table', 1),
(59, '2025_05_22_114908_create_pivot_table_for_area_branch', 1),
(60, '2025_05_24_051049_create_kitchens_table', 1),
(61, '2025_05_24_051438_create_reservations_table', 1),
(62, '2025_05_24_051453_create_reservation_tables_table', 1),
(63, '2025_05_24_054041_create_orders_table', 1),
(64, '2025_05_24_054517_create_order_products_table', 1),
(65, '2025_05_24_055808_create_transactions_table', 1),
(66, '2025_05_24_060350_create_order_payments_table', 1),
(67, '2025_05_24_060639_create_carts_table', 1),
(68, '2025_05_24_061402_create_branch_menus_table', 1),
(69, '2025_05_25_051425_add_vendor_id_and_unique_constrained_for_menus', 1),
(70, '2025_05_25_061827_add_vendor_id_at_table_item_categories', 1),
(71, '2025_05_25_074353_add_vendor_id_at_areas', 1),
(72, '2025_05_26_060901_add_is_default_column_at_table_currencies', 1),
(73, '2025_05_27_103659_add_product_addons_at_table_carts', 1),
(74, '2025_05_27_130357_add_product_json_product_addon_json_at_tabe_order_products', 1),
(75, '2025_05_27_130553_add_columns_at_tabe_order_products', 1),
(76, '2025_05_28_122721_add_area_id_to_reservations_table', 1),
(77, '2025_05_29_053632_add_payment_method_is_paid_column_to_orders_table', 1),
(78, '2025_05_29_063526_add_status_columns_to_order_products_table', 1),
(79, '2025_05_29_092744_add_slaes_amount_and_count_to_item_categories_table', 1),
(80, '2025_05_29_092827_add_slaes_amount_and_count_to_products_table', 1),
(81, '2025_05_31_060635_add_addons_price_at_table_order_products', 1),
(82, '2025_06_01_073225_add_employee_id_at_table_orders', 1),
(83, '2025_06_02_101633_create_vendor_customers_table', 1),
(84, '2025_06_03_092109_add_context_for_status', 1),
(85, '2025_06_03_094705_add_columns_to_orders_table', 1),
(86, '2025_06_03_094721_add_columns_to_transactions_table', 1),
(87, '2025_06_25_092052_alter_table_orders_make_table_id_nullable', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offline_payment_methods`
--

CREATE TABLE `offline_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offline_payment_methods`
--

INSERT INTO `offline_payment_methods` (`id`, `name`, `description`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'The City Bank', 'Account No: 1234567\r\nAccount Name: Themetags Corporation', 1, 1, 1, NULL, '2025-06-16 05:25:16', '2025-06-16 05:25:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `is_online_order` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Online, 2=Offline/Branch',
  `is_take_way_order` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=takeway, 2=not takeway',
  `online_platform` varchar(255) DEFAULT NULL COMMENT 'Ex. FoodPanda, FoodX',
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `total_qty` int(11) NOT NULL DEFAULT 0,
  `total` double NOT NULL DEFAULT 0,
  `discount_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Flat, 2=Percent',
  `payment_method` enum('cod','cash','card') DEFAULT NULL COMMENT 'cod=cash on delivery, cash=cash, card=card payment',
  `is_paid` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=paid, 0=not paid',
  `discount_value` double NOT NULL DEFAULT 0,
  `discounted_amount` double NOT NULL DEFAULT 0,
  `payable_after_discount` double NOT NULL DEFAULT 0,
  `paid_amount` double NOT NULL DEFAULT 0,
  `customer_note` text DEFAULT NULL,
  `kitchen_note` text DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_no`, `is_online_order`, `is_take_way_order`, `online_platform`, `vendor_id`, `branch_id`, `employee_id`, `table_id`, `status_id`, `total_qty`, `total`, `discount_type`, `payment_method`, `is_paid`, `discount_value`, `discounted_amount`, `payable_after_discount`, `paid_amount`, `customer_note`, `kitchen_note`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`, `customer_id`) VALUES
(1, 'restors__673872', 2, 2, NULL, 2, 4, 2, 3, 1, 2, 570, 1, 'cash', 0, 0, 0, 570, 0, NULL, NULL, 2, NULL, NULL, '2025-06-16 02:54:40', '2025-06-16 04:23:28', NULL, 2),
(2, 'restors__813865', 2, 2, NULL, 2, 4, 2, 1, 2, 1, 650, 1, 'cash', 0, 0, 0, 650, 0, NULL, NULL, 2, NULL, NULL, '2025-06-17 00:14:56', '2025-06-17 00:14:56', NULL, 2),
(3, 'restors__866868', 2, 2, NULL, 2, 4, 2, 1, 2, 2, 200, 1, 'cash', 0, 0, 0, 200, 0, NULL, NULL, 2, NULL, NULL, '2025-06-17 00:55:38', '2025-06-17 00:55:38', NULL, 2),
(4, 'restors__253368', 2, 2, NULL, 2, 4, 2, 3, 2, 2, 330, 1, 'cash', 1, 0, 0, 330, 330, NULL, NULL, 2, 2, NULL, '2025-06-25 03:05:48', '2025-06-25 07:11:41', NULL, 2),
(8, 'restors__031288', 2, 2, NULL, 2, 4, 2, 3, 2, 1, 150, 1, 'cash', 1, 0, 0, 150, 150, NULL, NULL, 2, 2, NULL, '2025-06-25 03:06:27', '2025-06-25 07:11:04', NULL, 2),
(9, 'restors__831879', 2, 2, NULL, 2, 4, 2, 3, 2, 1, 150, 1, 'cash', 1, 0, 0, 150, 150, NULL, NULL, 2, 2, NULL, '2025-06-25 03:06:50', '2025-06-25 07:09:47', NULL, 2),
(14, 'restors__711087', 2, 2, NULL, 2, 4, 2, NULL, 2, 1, 250, 1, 'cash', 1, 0, 0, 250, 250, NULL, NULL, 2, 2, NULL, '2025-06-25 03:24:08', '2025-06-25 06:30:34', NULL, 2),
(15, 'restors__743831', 2, 2, NULL, 2, 4, 9, NULL, 1, 2, 300, 1, 'cash', 1, 0, 0, 300, 0, NULL, NULL, 2, NULL, NULL, '2025-06-25 05:41:37', '2025-06-25 06:40:51', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`id`, `vendor_id`, `branch_id`, `order_id`, `transaction_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 14, 1, 0, '2025-06-25 06:30:34', '2025-06-25 06:30:34'),
(2, 2, 4, 9, 2, 0, '2025-06-25 07:09:47', '2025-06-25 07:09:47'),
(3, 2, 4, 8, 3, 0, '2025-06-25 07:11:04', '2025-06-25 07:11:04'),
(4, 2, 4, 4, 4, 0, '2025-06-25 07:11:41', '2025-06-25 07:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_owner_id` bigint(20) UNSIGNED NOT NULL,
  `product_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `product_addons` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `product_attribute_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `product_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `sub_total` double NOT NULL DEFAULT 0,
  `addons_price` double NOT NULL DEFAULT 0,
  `discount_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Flat, 2=Percentage',
  `discount_value` double NOT NULL DEFAULT 0,
  `discount_amount` double NOT NULL DEFAULT 0,
  `shipping_cost` double NOT NULL DEFAULT 0,
  `total_price` double NOT NULL DEFAULT 0,
  `status_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2 COMMENT '2=pending',
  `is_refund` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Refund, 2=Not Refunded',
  `is_cancel` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Canceled , 2=Not Canceled from order',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `product_owner_id`, `product_json`, `product_addons`, `product_attribute_json`, `product_attribute_id`, `qty`, `price`, `sub_total`, `addons_price`, `discount_type`, `discount_value`, `discount_amount`, `shipping_cost`, `total_price`, `status_id`, `is_refund`, `is_cancel`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 2, '{\"id\":12,\"vendor_id\":2,\"is_active\":1,\"name\":\"Cake\",\"menu_id\":6,\"item_category_id\":8,\"media_manager_id\":27,\"preparation_time\":40,\"description\":null,\"product_addons\":[{\"title\":\"sauces\",\"price\":\"20\"}],\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":2,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T07:26:11.000000Z\",\"updated_at\":\"2025-06-16T07:27:21.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":20,\"is_active\":1,\"product_id\":12,\"title\":\"cake\",\"price\":450,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":450,\"created_at\":\"2025-06-16T07:26:11.000000Z\",\"updated_at\":\"2025-06-16T07:26:11.000000Z\",\"formatted_price\":\"$450.00\",\"calculated_amount\":\"$450.00\"}', 20, 1, 450, 450, 0, 0, 0, 0, 0, 450, 1, 2, 2, '2025-06-16 02:54:40', '2025-06-16 04:23:30'),
(2, 1, 14, 2, '{\"id\":14,\"vendor_id\":2,\"is_active\":1,\"name\":\"tes\",\"menu_id\":4,\"item_category_id\":5,\"media_manager_id\":20,\"preparation_time\":20,\"description\":null,\"product_addons\":null,\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":null,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T07:37:09.000000Z\",\"updated_at\":\"2025-06-16T07:37:09.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":22,\"is_active\":1,\"product_id\":14,\"title\":\"Buger\",\"price\":120,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":120,\"created_at\":\"2025-06-16T07:37:09.000000Z\",\"updated_at\":\"2025-06-16T07:37:09.000000Z\",\"formatted_price\":\"$120.00\",\"calculated_amount\":\"$120.00\"}', 22, 1, 120, 120, 0, 0, 0, 0, 0, 120, 1, 2, 2, '2025-06-16 02:54:40', '2025-06-16 04:23:32'),
(3, 2, 4, 2, '{\"id\":4,\"vendor_id\":2,\"is_active\":1,\"name\":\"Mutton Biriyani\",\"menu_id\":5,\"item_category_id\":4,\"media_manager_id\":4,\"preparation_time\":20,\"description\":null,\"product_addons\":[{\"title\":\"Borhani\",\"price\":\"70\"},{\"title\":\"Drinks\",\"price\":\"40\"}],\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":2,\"deleted_by_id\":null,\"created_at\":\"2025-05-28T07:11:24.000000Z\",\"updated_at\":\"2025-06-16T06:34:30.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":11,\"is_active\":1,\"product_id\":4,\"title\":\"Extra - 1:3\",\"price\":650,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":650,\"created_at\":\"2025-05-28T07:11:24.000000Z\",\"updated_at\":\"2025-05-28T07:11:24.000000Z\",\"formatted_price\":\"$650.00\",\"calculated_amount\":\"$650.00\"}', 11, 1, 650, 650, 0, 0, 0, 0, 0, 650, 7, 2, 2, '2025-06-17 00:14:56', '2025-06-26 05:48:51'),
(4, 3, 14, 2, '{\"id\":14,\"vendor_id\":2,\"is_active\":1,\"name\":\"Beef Burger\",\"menu_id\":4,\"item_category_id\":5,\"media_manager_id\":28,\"preparation_time\":20,\"description\":null,\"product_addons\":null,\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":2,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T07:37:09.000000Z\",\"updated_at\":\"2025-06-17T04:37:17.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":22,\"is_active\":1,\"product_id\":14,\"title\":\"Buger\",\"price\":120,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":120,\"created_at\":\"2025-06-16T07:37:09.000000Z\",\"updated_at\":\"2025-06-16T07:37:09.000000Z\",\"formatted_price\":\"$120.00\",\"calculated_amount\":\"$120.00\"}', 22, 1, 120, 120, 0, 0, 0, 0, 0, 120, 7, 2, 2, '2025-06-17 00:55:38', '2025-06-26 05:48:55'),
(5, 3, 11, 2, '{\"id\":11,\"vendor_id\":2,\"is_active\":1,\"name\":\"Sandwich\",\"menu_id\":6,\"item_category_id\":6,\"media_manager_id\":19,\"preparation_time\":20,\"description\":null,\"product_addons\":[{\"title\":\"Soft Drinks\",\"price\":\"50\"}],\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":null,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T07:10:29.000000Z\",\"updated_at\":\"2025-06-16T07:10:29.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":19,\"is_active\":1,\"product_id\":11,\"title\":\"Sandwich\",\"price\":80,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":80,\"created_at\":\"2025-06-16T07:10:29.000000Z\",\"updated_at\":\"2025-06-16T07:10:38.000000Z\",\"formatted_price\":\"$80.00\",\"calculated_amount\":\"$80.00\"}', 19, 1, 80, 80, 0, 0, 0, 0, 0, 80, 7, 2, 2, '2025-06-17 00:55:38', '2025-06-26 05:48:53'),
(6, 4, 19, 2, '{\"id\":19,\"vendor_id\":2,\"is_active\":1,\"name\":\"Chicken Curry\",\"menu_id\":5,\"item_category_id\":7,\"media_manager_id\":31,\"preparation_time\":30,\"description\":null,\"product_addons\":null,\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":null,\"deleted_by_id\":null,\"created_at\":\"2025-06-17T04:50:09.000000Z\",\"updated_at\":\"2025-06-17T04:50:09.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":27,\"is_active\":1,\"product_id\":19,\"title\":\"Regular - 1:1\",\"price\":180,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":180,\"created_at\":\"2025-06-17T04:50:09.000000Z\",\"updated_at\":\"2025-06-17T04:50:09.000000Z\",\"formatted_price\":\"$180.00\",\"calculated_amount\":\"$180.00\"}', 27, 1, 180, 180, 0, 0, 0, 0, 0, 180, 6, 2, 2, '2025-06-25 03:05:48', '2025-06-26 05:49:00'),
(7, 4, 5, 2, '{\"id\":5,\"vendor_id\":2,\"is_active\":1,\"name\":\"Chicken Burger\",\"menu_id\":4,\"item_category_id\":5,\"media_manager_id\":7,\"preparation_time\":20,\"description\":null,\"product_addons\":[{\"title\":\"Soft Drinks\",\"price\":\"50\"}],\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":2,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-16T06:39:35.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":13,\"is_active\":1,\"product_id\":5,\"title\":\"Burger\",\"price\":150,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":150,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-16T06:39:00.000000Z\",\"formatted_price\":\"$150.00\",\"calculated_amount\":\"$150.00\"}', 13, 1, 150, 150, 0, 0, 0, 0, 0, 150, 7, 2, 2, '2025-06-25 03:05:48', '2025-06-26 05:48:58'),
(8, 8, 5, 2, '{\"id\":5,\"vendor_id\":2,\"is_active\":1,\"name\":\"Chicken Burger\",\"menu_id\":4,\"item_category_id\":5,\"media_manager_id\":7,\"preparation_time\":20,\"description\":null,\"product_addons\":[{\"title\":\"Soft Drinks\",\"price\":\"50\"}],\"total_sales_amount\":150,\"total_sales_count\":1,\"created_by_id\":2,\"updated_by_id\":2,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-25T09:05:48.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":13,\"is_active\":1,\"product_id\":5,\"title\":\"Burger\",\"price\":150,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":150,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-16T06:39:00.000000Z\",\"formatted_price\":\"$150.00\",\"calculated_amount\":\"$150.00\"}', 13, 1, 150, 150, 0, 0, 0, 0, 0, 150, 6, 2, 2, '2025-06-25 03:06:27', '2025-06-26 05:49:08'),
(9, 9, 5, 2, '{\"id\":5,\"vendor_id\":2,\"is_active\":1,\"name\":\"Chicken Burger\",\"menu_id\":4,\"item_category_id\":5,\"media_manager_id\":7,\"preparation_time\":20,\"description\":null,\"product_addons\":[{\"title\":\"Soft Drinks\",\"price\":\"50\"}],\"total_sales_amount\":300,\"total_sales_count\":2,\"created_by_id\":2,\"updated_by_id\":2,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-25T09:06:27.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":13,\"is_active\":1,\"product_id\":5,\"title\":\"Burger\",\"price\":150,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":150,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-16T06:39:00.000000Z\",\"formatted_price\":\"$150.00\",\"calculated_amount\":\"$150.00\"}', 13, 1, 150, 150, 0, 0, 0, 0, 0, 150, 6, 2, 2, '2025-06-25 03:06:50', '2025-06-26 05:49:11'),
(10, 14, 9, 2, '{\"id\":9,\"vendor_id\":2,\"is_active\":1,\"name\":\"Chicken Legs\",\"menu_id\":5,\"item_category_id\":9,\"media_manager_id\":18,\"preparation_time\":20,\"description\":null,\"product_addons\":[{\"title\":\"Soft Drinks\",\"price\":\"50\"}],\"total_sales_amount\":0,\"total_sales_count\":0,\"created_by_id\":2,\"updated_by_id\":null,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T07:06:16.000000Z\",\"updated_at\":\"2025-06-16T07:06:16.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":17,\"is_active\":1,\"product_id\":9,\"title\":\"f\",\"price\":250,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":250,\"created_at\":\"2025-06-16T07:06:16.000000Z\",\"updated_at\":\"2025-06-16T07:06:16.000000Z\",\"formatted_price\":\"$250.00\",\"calculated_amount\":\"$250.00\"}', 17, 1, 250, 250, 0, 0, 0, 0, 0, 250, 2, 2, 2, '2025-06-25 03:24:08', '2025-06-26 05:48:47'),
(11, 15, 5, 2, '{\"id\":5,\"vendor_id\":2,\"is_active\":1,\"name\":\"Chicken Burger\",\"menu_id\":4,\"item_category_id\":5,\"media_manager_id\":7,\"preparation_time\":20,\"description\":null,\"product_addons\":[{\"title\":\"Soft Drinks\",\"price\":\"50\"}],\"total_sales_amount\":450,\"total_sales_count\":3,\"created_by_id\":2,\"updated_by_id\":2,\"deleted_by_id\":null,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-25T09:06:50.000000Z\",\"deleted_at\":null}', '[]', '{\"id\":13,\"is_active\":1,\"product_id\":5,\"title\":\"Burger\",\"price\":150,\"discount_start_at\":null,\"discount_end_at\":null,\"discount_type\":null,\"discount_value\":0,\"discount_amount\":0,\"discounted_price\":150,\"created_at\":\"2025-06-16T06:39:00.000000Z\",\"updated_at\":\"2025-06-16T06:39:00.000000Z\",\"formatted_price\":\"$150.00\",\"calculated_amount\":\"$150.00\"}', 13, 2, 150, 300, 0, 0, 0, 0, 0, 300, 2, 2, 2, '2025-06-25 05:41:37', '2025-06-25 05:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_image` varchar(255) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_image`, `meta_description`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Terms & Conditions', 'terms-and-conditions', '<div class=\"section-space-xsm-y\">\n                <div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\"><span style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px; background-color: var(--bs-body-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Welcome to ThemeTags!</span><br></h2><p style=\"\">These terms and conditions outline the rules and regulations for the use of Themetagss Website, located at https://themetags.com/.</p><p style=\"\">By accessing this website we assume you accept these terms and conditions. Do not continue to use ThemeTags if you do not agree to take all of the terms and conditions stated on this page.</p><p class=\"mb-0\" style=\"\">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Companys terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Cookies</h2><p>We employ the use of cookies. By accessing ThemeTags, you agreed to use cookies in agreement with the Themetagss Privacy Policy.</p><p class=\"mb-0\">Most interactive websites use cookies to let us retrieve the users details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">License</h2><p>Unless otherwise stated, Themetags and/or its licensors own the intellectual property rights for all material on ThemeTags. All intellectual property rights are reserved. You may access this from ThemeTags for your own personal use subjected to restrictions set in these terms and conditions.</p><p>You must not:</p><ul class=\"mb-3\"><li>Republish material from ThemeTags</li><li>Sell, rent or sub-license material from ThemeTags</li><li>Reproduce, duplicate or copy material from ThemeTags</li><li>Redistribute content from ThemeTags</li></ul><p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Themetags does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Themetags,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Themetags shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p><p>Themetags reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p><p>You warrant and represent that:</p><ul class=\"mb-3\"><li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li><li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li><li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li><li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li></ul><p class=\"mb-0\">You hereby grant Themetags a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Hyperlinking to our Content</h2><p>The following organizations may link to our Website without prior written approval:</p><ul class=\"mb-3\"><li>Government agencies;</li><li>Search engines;</li><li>News organizations;</li><li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li><li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li></ul><p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking partys site.</p><p>We may consider and approve other link requests from the following types of organizations:</p><ul class=\"mb-3\"><li>commonly-known consumer and/or business information sources;</li><li>dot.com community sites;</li><li>associations or other groups representing charities;</li><li>online directory distributors;</li><li>internet portals;</li><li>accounting, law and consulting firms; and</li><li>educational institutions and trade associations.</li></ul><p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Themetags; and (d) the link is in the context of general resource information.</p><p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking partys site.</p><p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Themetags. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p><p>Approved organizations may hyperlink to our Website as follows:</p><ul class=\"mb-3\"><li>By use of our corporate name; or</li><li>By use of the uniform resource locator being linked to; or</li><li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li></ul><p>No use of Themetagss logo or other artwork will be allowed for linking absent a trademark license agreement.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">iFrames</h2><p class=\"mb-0\">Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Content Liability</h2><p class=\"mb-0\">We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Your Privacy</h2><p class=\"mb-0\">Please read Privacy Policy</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Reservation of Rights</h2><p class=\"mb-0\">We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and its linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Removal of links from our website</h2><p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p><p class=\"mb-0\">We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p></div><div class=\"content-group\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Disclaimer</h2><p style=\"\">To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p><ul style=\"\"><li>limit or exclude our or your liability for death or personal injury;</li><li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li><li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li><li>exclude any of our or your liabilities that may not be excluded under applicable law.</li></ul><p style=\"\">The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p><p class=\"mb-0\" style=\"\">As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p></div>\n        </div>', 'terms and conditions', NULL, 'We are ThemeTags and provide AI Solutions!', 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_recurring` tinyint(1) DEFAULT 0,
  `webhook_id` varchar(255) DEFAULT NULL,
  `webhook_secret` varchar(255) DEFAULT NULL,
  `sandbox` tinyint(1) DEFAULT 0,
  `type` varchar(255) DEFAULT NULL COMMENT 'sandbox, live',
  `service_charge` varchar(255) DEFAULT '0',
  `charge_type` varchar(255) DEFAULT NULL COMMENT '1= flat, 2=percentage',
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `gateway`, `image`, `is_recurring`, `webhook_id`, `webhook_secret`, `sandbox`, `type`, `service_charge`, `charge_type`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'paypal', 'assets/img/payments/paypal.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(2, 'stripe', 'assets/img/payments/stripe.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(3, 'paytm', 'assets/img/payments/paytm.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(4, 'razorpay', 'assets/img/payments/razorpay.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(5, 'iyzico', 'assets/img/payments/iyzico.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(6, 'paystack', 'assets/img/payments/paystack.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(7, 'flutterwave', 'assets/img/payments/fluterwave.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(8, 'duitku', 'assets/img/payments/duitku.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(9, 'yookassa', 'assets/img/payments/yoomoney.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(10, 'molile', 'assets/img/payments/mollie.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(11, 'mercadopago', 'assets/img/payments/mercado-pago.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(12, 'midtrans', 'assets/img/payments/midtrans.svg', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL),
(13, 'offline', 'assets/img/payments/manual_payment.png', 0, NULL, NULL, 1, 'sandbox', '0', NULL, 1, NULL, NULL, '2025-06-15 09:05:28', '2025-06-15 09:05:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_details`
--

CREATE TABLE `payment_gateway_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_gateway_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateway_details`
--

INSERT INTO `payment_gateway_details` (`id`, `payment_gateway_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'PAYPAL_CLIENT_ID', '', '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(2, 1, 'PAYPAL_CLIENT_SECRET', '', '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(3, 2, 'STRIPE_KEY', '', '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(4, 2, 'STRIPE_SECRET', '', '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(5, 3, 'PAYTM_ENVIRONMENT', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(6, 3, 'PAYTM_MERCHANT_ID', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(7, 3, 'PAYTM_MERCHANT_KEY', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(8, 3, 'PAYTM_MERCHANT_WEBSITE', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(9, 3, 'PAYTM_CHANNEL', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(10, 3, 'PAYTM_INDUSTRY_TYPE', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(11, 4, 'RAZORPAY_KEY', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(12, 4, 'RAZORPAY_SECRET', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(13, 5, 'IYZICO_API_KEY', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(14, 5, 'IYZICO_SECRET_KEY', NULL, '2025-06-15 03:05:28', '2025-06-15 03:05:28'),
(15, 6, 'PAYSTACK_PUBLIC_KEY', '', '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(16, 6, 'PAYSTACK_SECRET_KEY', '', '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(17, 6, 'MERCHANT_EMAIL', '', '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(18, 6, 'PAYSTACK_CURRENCY_CODE', '', '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(19, 7, 'FLW_PUBLIC_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(20, 7, 'FLW_SECRET_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(21, 7, 'FLW_SECRET_HASH', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(22, 8, 'DUITKU_API_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(23, 8, 'DUITKU_MERCHANT_CODE', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(24, 8, 'DUITKU_CALLBACK_URL', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(25, 8, 'DUITKU_RETURN_URL', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(26, 8, 'DUITKU_ENV', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(27, 9, 'YOOKASSA_SHOP_ID', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(28, 9, 'YOOKASSA_SECRET_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(29, 9, 'YOOKASSA_CURRENCY_CODE', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(30, 9, 'YOOKASSA_RECIEPT', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(31, 9, 'YOOKASSA_VAT', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(32, 10, 'MOLILE_API_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(33, 11, 'MERCADOPAGO_SECRET_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(34, 12, 'MIDTRANS_SERVER_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29'),
(35, 12, 'MIDTRANS_CLIENT_KEY', NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_products`
--

CREATE TABLE `payment_gateway_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscription_plan_id` int(11) NOT NULL DEFAULT 0,
  `package_name` varchar(255) DEFAULT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `billing_id` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_product_histories`
--

CREATE TABLE `payment_gateway_product_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subscription_plan_name` varchar(255) DEFAULT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `old_product_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `old_billing_id` varchar(255) DEFAULT NULL,
  `new_billing_id` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `display_title` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `method_type` varchar(255) NOT NULL COMMENT 'Ex: Get/POST/PUT/DELETE/PATCH ETC',
  `is_sidebar_menu` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1= For Sidebar show-able menu, 0 = Not show-able for sidebar',
  `icon_file` varchar(255) DEFAULT NULL COMMENT 'Ex. icon_file could be image or icon library ref.',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `is_allowed_in_demo` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `display_title`, `route`, `url`, `method_type`, `is_sidebar_menu`, `icon_file`, `user_id`, `is_active`, `is_allowed_in_demo`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Debugbar openhandler', 'debugbar.openhandler', '_debugbar/open', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:22', '2025-06-15 09:17:22', NULL),
(2, 'Debugbar clockwork', 'debugbar.clockwork', '_debugbar/clockwork/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(3, 'Debugbar assets css', 'debugbar.assets.css', '_debugbar/assets/stylesheets', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(4, 'Debugbar assets js', 'debugbar.assets.js', '_debugbar/assets/javascript', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(5, 'Debugbar cache delete', 'debugbar.cache.delete', '_debugbar/cache/{key}/{tags?}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(6, 'Debugbar queries explain', 'debugbar.queries.explain', '_debugbar/queries/explain', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(7, 'Cashier payment', 'cashier.payment', 'stripe/payment/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(8, 'Cashier webhook', 'cashier.webhook', 'stripe/webhook', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(9, 'Sanctum csrf-cookie', 'sanctum.csrf-cookie', 'sanctum/csrf-cookie', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(10, 'Ignition healthCheck', 'ignition.healthCheck', '_ignition/health-check', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(11, 'Ignition executeSolution', 'ignition.executeSolution', '_ignition/execute-solution', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(12, 'Ignition updateConfig', 'ignition.updateConfig', '_ignition/update-config', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(13, '', 'api/user', 'api/user', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(14, 'Admin index', 'admin.index', 'api/admin', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(15, 'Admin store', 'admin.store', 'api/admin/add-admin', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(16, 'Stripe checkout', 'stripe.checkout', 'stripe/checkout/plan/{stripe_plan}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(17, 'Stripe success', 'stripe.success', 'stripe/success', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(18, 'Stripe cancel', 'stripe.cancel', 'stripe/cancel', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(19, 'Admin permissions index', 'admin.permissions.index', 'admin/user-role-management/permissions', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(20, 'Admin permissions create', 'admin.permissions.create', 'admin/user-role-management/permissions/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(21, 'Admin permissions store', 'admin.permissions.store', 'admin/user-role-management/permissions', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(22, 'Admin permissions show', 'admin.permissions.show', 'admin/user-role-management/permissions/{permission}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(23, 'Admin permissions edit', 'admin.permissions.edit', 'admin/user-role-management/permissions/{permission}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(24, 'Admin permissions update', 'admin.permissions.update', 'admin/user-role-management/permissions/{permission}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(25, 'Admin permissions destroy', 'admin.permissions.destroy', 'admin/user-role-management/permissions/{permission}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(26, 'Admin roles index', 'admin.roles.index', 'admin/user-role-management/roles', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(27, 'Admin roles create', 'admin.roles.create', 'admin/user-role-management/roles/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(28, 'Admin roles store', 'admin.roles.store', 'admin/user-role-management/roles', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(29, 'Admin roles show', 'admin.roles.show', 'admin/user-role-management/roles/{role}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(30, 'Admin roles edit', 'admin.roles.edit', 'admin/user-role-management/roles/{role}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(31, 'Admin roles update', 'admin.roles.update', 'admin/user-role-management/roles/{role}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(32, 'Admin roles destroy', 'admin.roles.destroy', 'admin/user-role-management/roles/{role}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(33, 'Admin roles statusUpdate', 'admin.roles.statusUpdate', 'admin/user-role-management/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(34, 'Admin users index', 'admin.users.index', 'admin/user-role-management/users', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(35, 'Admin users create', 'admin.users.create', 'admin/user-role-management/users/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(36, 'Admin users store', 'admin.users.store', 'admin/user-role-management/users', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(37, 'Admin users show', 'admin.users.show', 'admin/user-role-management/users/{user}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(38, 'Admin users edit', 'admin.users.edit', 'admin/user-role-management/users/{user}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(39, 'Admin users update', 'admin.users.update', 'admin/user-role-management/users/{user}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(40, 'Admin users destroy', 'admin.users.destroy', 'admin/user-role-management/users/{user}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(41, 'Admin users statusUpdate', 'admin.users.statusUpdate', 'admin/user-role-management/users/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(42, 'Admin status update', 'admin.status.update', 'admin/update/active-status', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(43, 'Admin profile', 'admin.profile', 'admin/profile', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(44, 'Admin info-update', 'admin.info-update', 'admin/profile-info-update', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(45, 'Admin change-password', 'admin.change-password', 'admin/profile-change-password', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(46, 'Admin users updateBalance', 'admin.users.updateBalance', 'admin/users/balance-update', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(47, 'Admin media-managers index', 'admin.media-managers.index', 'admin/media-managers', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(48, 'Admin media-managers create', 'admin.media-managers.create', 'admin/media-managers/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(49, 'Admin media-managers store', 'admin.media-managers.store', 'admin/media-managers', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(50, 'Admin media-managers show', 'admin.media-managers.show', 'admin/media-managers/{media_manager}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(51, 'Admin media-managers edit', 'admin.media-managers.edit', 'admin/media-managers/{media_manager}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(52, 'Admin media-managers update', 'admin.media-managers.update', 'admin/media-managers/{media_manager}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(53, 'Admin media-managers destroy', 'admin.media-managers.destroy', 'admin/media-managers/{media_manager}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(54, 'Admin uppy index', 'admin.uppy.index', 'admin/media-manager/get-files', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(55, 'Admin uppy selectedFiles', 'admin.uppy.selectedFiles', 'admin/media-manager/get-selected-files', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(56, 'Admin uppy store', 'admin.uppy.store', 'admin/media-manager/add-files', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(57, 'Admin uppy delete', 'admin.uppy.delete', 'admin/media-manager/delete-files/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(58, 'Admin support-tickets index', 'admin.support-tickets.index', 'admin/support-tickets', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(59, 'Admin support-tickets create', 'admin.support-tickets.create', 'admin/support-tickets/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(60, 'Admin support-tickets store', 'admin.support-tickets.store', 'admin/support-tickets', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(61, 'Admin support-tickets show', 'admin.support-tickets.show', 'admin/support-tickets/{support_ticket}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(62, 'Admin support-tickets edit', 'admin.support-tickets.edit', 'admin/support-tickets/{support_ticket}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(63, 'Admin support-tickets update', 'admin.support-tickets.update', 'admin/support-tickets/{support_ticket}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(64, 'Admin support-tickets destroy', 'admin.support-tickets.destroy', 'admin/support-tickets/{support_ticket}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(65, 'Admin support-replies index', 'admin.support-replies.index', 'admin/support-replies', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(66, 'Admin support-replies create', 'admin.support-replies.create', 'admin/support-replies/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(67, 'Admin support-replies store', 'admin.support-replies.store', 'admin/support-replies', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(68, 'Admin support-replies show', 'admin.support-replies.show', 'admin/support-replies/{support_reply}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(69, 'Admin support-replies edit', 'admin.support-replies.edit', 'admin/support-replies/{support_reply}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(70, 'Admin support-replies update', 'admin.support-replies.update', 'admin/support-replies/{support_reply}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(71, 'Admin support-replies destroy', 'admin.support-replies.destroy', 'admin/support-replies/{support_reply}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(72, 'Admin support-tickets reply', 'admin.support-tickets.reply', 'admin/support-tickets/reply/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(73, 'Admin plan-histories index', 'admin.plan-histories.index', 'admin/plan-histories', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(74, 'Admin plan-histories show', 'admin.plan-histories.show', 'admin/plan-histories/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(75, 'Admin plan-invoice index', 'admin.plan-invoice.index', 'admin/plan-invoice/{id}', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(76, 'Admin plan-invoice download', 'admin.plan-invoice.download', 'admin/plan-download/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(77, 'Admin dashboard', 'admin.dashboard', 'admin/dashboard', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(78, 'Admin merchants index', 'admin.merchants.index', 'admin/merchants', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(79, 'Admin merchants create', 'admin.merchants.create', 'admin/merchants/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(80, 'Admin merchants store', 'admin.merchants.store', 'admin/merchants', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(81, 'Admin merchants show', 'admin.merchants.show', 'admin/merchants/{merchant}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(82, 'Admin merchants edit', 'admin.merchants.edit', 'admin/merchants/{merchant}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(83, 'Admin merchants update', 'admin.merchants.update', 'admin/merchants/{merchant}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(84, 'Admin merchants destroy', 'admin.merchants.destroy', 'admin/merchants/{merchant}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:23', '2025-06-15 09:17:23', NULL),
(85, 'Admin merchants export', 'admin.merchants.export', 'admin/merchants-export', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(86, 'Admin settings index', 'admin.settings.index', 'admin/settings', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(87, 'Admin settings create', 'admin.settings.create', 'admin/settings/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(88, 'Admin settings store', 'admin.settings.store', 'admin/settings', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(89, 'Admin settings show', 'admin.settings.show', 'admin/settings/{setting}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(90, 'Admin settings edit', 'admin.settings.edit', 'admin/settings/{setting}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(91, 'Admin settings update', 'admin.settings.update', 'admin/settings/{setting}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(92, 'Admin settings destroy', 'admin.settings.destroy', 'admin/settings/{setting}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(93, 'Admin settings credentials', 'admin.settings.credentials', 'admin/settings-credentials', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(94, 'Admin languages index', 'admin.languages.index', 'admin/languages', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(95, 'Admin languages create', 'admin.languages.create', 'admin/languages/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(96, 'Admin languages store', 'admin.languages.store', 'admin/languages', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(97, 'Admin languages show', 'admin.languages.show', 'admin/languages/{language}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(98, 'Admin languages edit', 'admin.languages.edit', 'admin/languages/{language}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(99, 'Admin languages update', 'admin.languages.update', 'admin/languages/{language}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(100, 'Admin languages destroy', 'admin.languages.destroy', 'admin/languages/{language}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(101, 'Admin localizations store', 'admin.localizations.store', 'admin/localizations', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(102, 'Admin localizations show', 'admin.localizations.show', 'admin/localizations/{localization}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(103, 'Admin currencies index', 'admin.currencies.index', 'admin/currencies', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(104, 'Admin currencies create', 'admin.currencies.create', 'admin/currencies/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(105, 'Admin currencies store', 'admin.currencies.store', 'admin/currencies', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(106, 'Admin currencies show', 'admin.currencies.show', 'admin/currencies/{currency}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(107, 'Admin currencies edit', 'admin.currencies.edit', 'admin/currencies/{currency}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(108, 'Admin currencies update', 'admin.currencies.update', 'admin/currencies/{currency}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(109, 'Admin currencies destroy', 'admin.currencies.destroy', 'admin/currencies/{currency}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(110, 'Admin currencies statusUpdate', 'admin.currencies.statusUpdate', 'admin/currencies/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(111, 'Admin pages statusUpdate', 'admin.pages.statusUpdate', 'admin/pages/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(112, 'Admin faqs index', 'admin.faqs.index', 'admin/faqs', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(113, 'Admin faqs create', 'admin.faqs.create', 'admin/faqs/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(114, 'Admin faqs store', 'admin.faqs.store', 'admin/faqs', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(115, 'Admin faqs show', 'admin.faqs.show', 'admin/faqs/{faq}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(116, 'Admin faqs edit', 'admin.faqs.edit', 'admin/faqs/{faq}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(117, 'Admin faqs update', 'admin.faqs.update', 'admin/faqs/{faq}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(118, 'Admin faqs destroy', 'admin.faqs.destroy', 'admin/faqs/{faq}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(119, 'Admin faqs statusUpdate', 'admin.faqs.statusUpdate', 'admin/faqs/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(120, 'Admin support-categories index', 'admin.support-categories.index', 'admin/support-categories', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(121, 'Admin support-categories create', 'admin.support-categories.create', 'admin/support-categories/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(122, 'Admin support-categories store', 'admin.support-categories.store', 'admin/support-categories', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(123, 'Admin support-categories show', 'admin.support-categories.show', 'admin/support-categories/{support_category}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(124, 'Admin support-categories edit', 'admin.support-categories.edit', 'admin/support-categories/{support_category}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(125, 'Admin support-categories update', 'admin.support-categories.update', 'admin/support-categories/{support_category}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(126, 'Admin support-categories destroy', 'admin.support-categories.destroy', 'admin/support-categories/{support_category}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(127, 'Admin support-categories statusUpdate', 'admin.support-categories.statusUpdate', 'admin/support-categories/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(128, 'Admin support-priorities index', 'admin.support-priorities.index', 'admin/support-priorities', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(129, 'Admin support-priorities create', 'admin.support-priorities.create', 'admin/support-priorities/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(130, 'Admin support-priorities store', 'admin.support-priorities.store', 'admin/support-priorities', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(131, 'Admin support-priorities show', 'admin.support-priorities.show', 'admin/support-priorities/{support_priority}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(132, 'Admin support-priorities edit', 'admin.support-priorities.edit', 'admin/support-priorities/{support_priority}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(133, 'Admin support-priorities update', 'admin.support-priorities.update', 'admin/support-priorities/{support_priority}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(134, 'Admin support-priorities destroy', 'admin.support-priorities.destroy', 'admin/support-priorities/{support_priority}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(135, 'Admin support-priorities statusUpdate', 'admin.support-priorities.statusUpdate', 'admin/support-priorities/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(136, 'Admin subscription-plans index', 'admin.subscription-plans.index', 'admin/subscription-plans', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(137, 'Admin subscription-plans create', 'admin.subscription-plans.create', 'admin/subscription-plans/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(138, 'Admin subscription-plans store', 'admin.subscription-plans.store', 'admin/subscription-plans', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(139, 'Admin subscription-plans show', 'admin.subscription-plans.show', 'admin/subscription-plans/{subscription_plan}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(140, 'Admin subscription-plans edit', 'admin.subscription-plans.edit', 'admin/subscription-plans/{subscription_plan}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(141, 'Admin subscription-plans update', 'admin.subscription-plans.update', 'admin/subscription-plans/{subscription_plan}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(142, 'Admin subscription-plans destroy', 'admin.subscription-plans.destroy', 'admin/subscription-plans/{subscription_plan}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(143, 'Admin subscription-plans statusUpdate', 'admin.subscription-plans.statusUpdate', 'admin/subscription-plans/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(144, 'Admin subscription-plans package-update', 'admin.subscription-plans.package-update', 'admin/subscription-plans/package-update', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(145, 'Admin subscription-plans get-price', 'admin.subscription-plans.get-price', 'admin/subscription-plans/get-price/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(146, 'Admin subscriptions updateTemplates', 'admin.subscriptions.updateTemplates', 'admin/update-package-templates', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(147, 'Admin customers index', 'admin.customers.index', 'admin/customers', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(148, 'Admin customers create', 'admin.customers.create', 'admin/customers/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(149, 'Admin customers store', 'admin.customers.store', 'admin/customers', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(150, 'Admin customers show', 'admin.customers.show', 'admin/customers/{customer}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(151, 'Admin customers edit', 'admin.customers.edit', 'admin/customers/{customer}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(152, 'Admin customers update', 'admin.customers.update', 'admin/customers/{customer}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(153, 'Admin customers destroy', 'admin.customers.destroy', 'admin/customers/{customer}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(154, 'Admin customers export', 'admin.customers.export', 'admin/customers-export', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(155, 'Admin payment-gateways index', 'admin.payment-gateways.index', 'admin/payment-gateways', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(156, 'Admin payment-gateways create', 'admin.payment-gateways.create', 'admin/payment-gateways/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(157, 'Admin payment-gateways store', 'admin.payment-gateways.store', 'admin/payment-gateways', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(158, 'Admin payment-gateways show', 'admin.payment-gateways.show', 'admin/payment-gateways/{payment_gateway}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(159, 'Admin payment-gateways edit', 'admin.payment-gateways.edit', 'admin/payment-gateways/{payment_gateway}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(160, 'Admin payment-gateways update', 'admin.payment-gateways.update', 'admin/payment-gateways/{payment_gateway}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(161, 'Admin payment-gateways destroy', 'admin.payment-gateways.destroy', 'admin/payment-gateways/{payment_gateway}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(162, 'Admin reports subscriptions', 'admin.reports.subscriptions', 'admin/reports/subscriptions', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(163, 'Admin appearance index', 'admin.appearance.index', 'admin/appearance', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(164, 'Admin appearance update', 'admin.appearance.update', 'admin/appearance/update', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(165, 'Admin client-feedbacks index', 'admin.client-feedbacks.index', 'admin/client-feedbacks', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(166, 'Admin client-feedbacks create', 'admin.client-feedbacks.create', 'admin/client-feedbacks/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(167, 'Admin client-feedbacks store', 'admin.client-feedbacks.store', 'admin/client-feedbacks', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(168, 'Admin client-feedbacks show', 'admin.client-feedbacks.show', 'admin/client-feedbacks/{client_feedback}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(169, 'Admin client-feedbacks edit', 'admin.client-feedbacks.edit', 'admin/client-feedbacks/{client_feedback}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(170, 'Admin client-feedbacks update', 'admin.client-feedbacks.update', 'admin/client-feedbacks/{client_feedback}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(171, 'Admin client-feedbacks destroy', 'admin.client-feedbacks.destroy', 'admin/client-feedbacks/{client_feedback}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(172, 'Admin subscription-settings index', 'admin.subscription-settings.index', 'admin/subscription-settings', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(173, 'Admin subscription-settings store gateway product', 'admin.subscription-settings.store.gateway.product', 'admin/subscription-settings/gateway-product/store', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(174, 'Admin offline-payment-methods index', 'admin.offline-payment-methods.index', 'admin/offline-payment-methods', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(175, 'Admin offline-payment-methods create', 'admin.offline-payment-methods.create', 'admin/offline-payment-methods/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(176, 'Admin offline-payment-methods store', 'admin.offline-payment-methods.store', 'admin/offline-payment-methods', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(177, 'Admin offline-payment-methods show', 'admin.offline-payment-methods.show', 'admin/offline-payment-methods/{offline_payment_method}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(178, 'Admin offline-payment-methods edit', 'admin.offline-payment-methods.edit', 'admin/offline-payment-methods/{offline_payment_method}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(179, 'Admin offline-payment-methods update', 'admin.offline-payment-methods.update', 'admin/offline-payment-methods/{offline_payment_method}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(180, 'Admin offline-payment-methods destroy', 'admin.offline-payment-methods.destroy', 'admin/offline-payment-methods/{offline_payment_method}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(181, 'Admin offline-payment-methods statusUpdate', 'admin.offline-payment-methods.statusUpdate', 'admin/offline-payment-methods/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(182, 'Admin email-templates index', 'admin.email-templates.index', 'admin/email-templates', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(183, 'Admin email-templates update', 'admin.email-templates.update', 'admin/email-templates/update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(184, 'Admin utilities', 'admin.utilities', 'admin/utilities', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(185, 'Admin clear-cache', 'admin.clear-cache', 'admin/clear-cache', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(186, 'Admin clearLog', 'admin.clearLog', 'admin/clear-log', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(187, 'Admin debug', 'admin.debug', 'admin/debug', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(188, 'Admin cron-list', 'admin.cron-list', 'admin/cron-list', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(189, 'Admin team-members index', 'admin.team-members.index', 'admin/team-members', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(190, 'Admin team-members create', 'admin.team-members.create', 'admin/team-members/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(191, 'Admin team-members store', 'admin.team-members.store', 'admin/team-members', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(192, 'Admin team-members show', 'admin.team-members.show', 'admin/team-members/{team_member}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(193, 'Admin team-members edit', 'admin.team-members.edit', 'admin/team-members/{team_member}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(194, 'Admin team-members update', 'admin.team-members.update', 'admin/team-members/{team_member}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(195, 'Admin team-members destroy', 'admin.team-members.destroy', 'admin/team-members/{team_member}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(196, 'Admin subscribers index', 'admin.subscribers.index', 'admin/subscribers', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(197, 'Admin subscribers destroy', 'admin.subscribers.destroy', 'admin/subscribers/{subscriber}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(198, 'Admin about-us index', 'admin.about-us.index', 'admin/about-us', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(199, 'Admin contact-us index', 'admin.contact-us.index', 'admin/contact-us', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(200, 'Admin contact-us store', 'admin.contact-us.store', 'admin/contact-us', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:24', '2025-06-15 09:17:24', NULL),
(201, 'Admin queries index', 'admin.queries.index', 'admin/contact-queries', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(202, 'Admin queries markRead', 'admin.queries.markRead', 'admin/mark-as-read/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(203, 'Admin queries delete', 'admin.queries.delete', 'admin/delete-queries/{id}/{force?}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(204, 'Admin queries deleteAll', 'admin.queries.deleteAll', 'admin/delete-all-queries', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(205, 'Admin privacy-policy index', 'admin.privacy-policy.index', 'admin/privacy-policy', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(206, 'Admin terms-conditions index', 'admin.terms-conditions.index', 'admin/terms-conditions', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(207, 'Admin pwa-settings index', 'admin.pwa-settings.index', 'admin/pwa-settings', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(208, 'Admin pwa-settings store', 'admin.pwa-settings.store', 'admin/pwa-settings', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(209, 'Admin balance-render', 'admin.balance-render', 'admin/balance-render', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(210, 'Admin payment-requests index', 'admin.payment-requests.index', 'admin/payment-requests', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(211, 'Admin payment-requests approve', 'admin.payment-requests.approve', 'admin/payment-requests/approve', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(212, 'Admin payment-requests feedback', 'admin.payment-requests.feedback', 'admin/payment-requests/feedback', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(213, 'Admin payment-requests reject', 'admin.payment-requests.reject', 'admin/payment-requests/reject', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(214, 'Admin payment-requests reSubmit', 'admin.payment-requests.reSubmit', 'admin/payment-requests/reSubmit', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(215, 'Admin systemUpdate health-check', 'admin.systemUpdate.health-check', 'admin/application/health-check', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(216, 'Admin systemUpdate update', 'admin.systemUpdate.update', 'admin/application/update', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(217, 'Admin systemUpdate file-permission', 'admin.systemUpdate.file-permission', 'admin/application/file-permission', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(218, 'Admin systemUpdate oneClickUpdate', 'admin.systemUpdate.oneClickUpdate', 'admin/application/one-click-update', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(219, 'Admin systemUpdate update-version', 'admin.systemUpdate.update-version', 'admin/application/manual-update-system', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(220, 'Admin availablePlans', 'admin.availablePlans', 'vendor/available-subscription-plans', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(221, 'Admin menus index', 'admin.menus.index', 'vendor/menus/menus', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(222, 'Admin menus create', 'admin.menus.create', 'vendor/menus/menus/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(223, 'Admin menus store', 'admin.menus.store', 'vendor/menus/menus', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(224, 'Admin menus show', 'admin.menus.show', 'vendor/menus/menus/{menu}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(225, 'Admin menus edit', 'admin.menus.edit', 'vendor/menus/menus/{menu}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(226, 'Admin menus update', 'admin.menus.update', 'vendor/menus/menus/{menu}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(227, 'Admin menus destroy', 'admin.menus.destroy', 'vendor/menus/menus/{menu}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(228, 'Admin menus statusUpdate', 'admin.menus.statusUpdate', 'vendor/menus/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(229, 'Admin item-categories index', 'admin.item-categories.index', 'vendor/menus/item-categories', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(230, 'Admin item-categories create', 'admin.item-categories.create', 'vendor/menus/item-categories/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(231, 'Admin item-categories store', 'admin.item-categories.store', 'vendor/menus/item-categories', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(232, 'Admin item-categories show', 'admin.item-categories.show', 'vendor/menus/item-categories/{item_category}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(233, 'Admin item-categories edit', 'admin.item-categories.edit', 'vendor/menus/item-categories/{item_category}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(234, 'Admin item-categories update', 'admin.item-categories.update', 'vendor/menus/item-categories/{item_category}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(235, 'Admin item-categories destroy', 'admin.item-categories.destroy', 'vendor/menus/item-categories/{item_category}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(236, 'Admin item-categories statusUpdate', 'admin.item-categories.statusUpdate', 'vendor/menus/item-categories/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(237, 'Admin menu-items index', 'admin.menu-items.index', 'vendor/menus/menu-items', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(238, 'Admin menu-items create', 'admin.menu-items.create', 'vendor/menus/menu-items/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(239, 'Admin menu-items store', 'admin.menu-items.store', 'vendor/menus/menu-items', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(240, 'Admin menu-items show', 'admin.menu-items.show', 'vendor/menus/menu-items/{menu_item}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(241, 'Admin menu-items edit', 'admin.menu-items.edit', 'vendor/menus/menu-items/{menu_item}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(242, 'Admin menu-items update', 'admin.menu-items.update', 'vendor/menus/menu-items/{menu_item}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(243, 'Admin menu-items destroy', 'admin.menu-items.destroy', 'vendor/menus/menu-items/{menu_item}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(244, 'Admin menu-items statusUpdate', 'admin.menu-items.statusUpdate', 'vendor/menus/menu-items/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(245, 'Admin delete menuItemVariation', 'admin.delete.menuItemVariation', 'vendor/menus/delete/menu-item-variation/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(246, 'Admin products show', 'admin.products.show', 'vendor/products/{id}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(247, 'Admin areas index', 'admin.areas.index', 'vendor/areas', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(248, 'Admin areas create', 'admin.areas.create', 'vendor/areas/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(249, 'Admin areas store', 'admin.areas.store', 'vendor/areas', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(250, 'Admin areas show', 'admin.areas.show', 'vendor/areas/{area}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(251, 'Admin areas edit', 'admin.areas.edit', 'vendor/areas/{area}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(252, 'Admin areas update', 'admin.areas.update', 'vendor/areas/{area}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(253, 'Admin areas destroy', 'admin.areas.destroy', 'vendor/areas/{area}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(254, 'Admin areas statusUpdate', 'admin.areas.statusUpdate', 'vendor/areas/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(255, 'Admin tables index', 'admin.tables.index', 'vendor/tables', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(256, 'Admin tables create', 'admin.tables.create', 'vendor/tables/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(257, 'Admin tables store', 'admin.tables.store', 'vendor/tables', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(258, 'Admin tables show', 'admin.tables.show', 'vendor/tables/{table}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(259, 'Admin tables edit', 'admin.tables.edit', 'vendor/tables/{table}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(260, 'Admin tables update', 'admin.tables.update', 'vendor/tables/{table}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(261, 'Admin tables destroy', 'admin.tables.destroy', 'vendor/tables/{table}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(262, 'Admin tables statusUpdate', 'admin.tables.statusUpdate', 'vendor/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(263, 'Admin qr-codes index', 'admin.qr-codes.index', 'vendor/qr-codes', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(264, 'Admin orders index', 'admin.orders.index', 'vendor/orders', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(265, 'Admin orders update-status', 'admin.orders.update-status', 'vendor/orders/update-status', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(266, 'Admin update_status order_product', 'admin.update_status.order_product', 'vendor/update-order-product-status', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(267, 'Admin reports reservations', 'admin.reports.reservations', 'vendor/reports/reservations', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(268, 'Admin reports subscriptions', 'admin.reports.subscriptions', 'vendor/reports/subscriptions', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(269, 'Admin reports items_category', 'admin.reports.items_category', 'vendor/reports/items-category', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(270, 'Admin reports teams', 'admin.reports.teams', 'vendor/reports/teams', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(271, 'Admin reports sales', 'admin.reports.sales', 'vendor/reports/sales', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(272, 'Admin reports items', 'admin.reports.items', 'vendor/reports/items', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(273, 'Backend changeCurrency', 'backend.changeCurrency', 'backend/change-currency', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(274, 'Backend changeLanguage', 'backend.changeLanguage', 'backend/change-language', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(275, 'Admin staffs index', 'admin.staffs.index', 'admin', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(276, 'Paypal success', 'paypal.success', 'paypal/success', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(277, 'Paypal cancel', 'paypal.cancel', 'paypal/cancel', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL);
INSERT INTO `permissions` (`id`, `display_title`, `route`, `url`, `method_type`, `is_sidebar_menu`, `icon_file`, `user_id`, `is_active`, `is_allowed_in_demo`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(278, 'Create payPal order', 'create.payPal.order', 'paypal/create-paypal-order', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(279, 'Capture payPal order', 'capture.payPal.order', 'paypal/capture-paypal-order', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(280, 'Stripe checkoutSession', 'stripe.checkoutSession', 'stripe/create-session', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(281, 'Paytm callback', 'paytm.callback', 'paytm/callback', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(282, 'Razorpay payment', 'razorpay.payment', 'razorpay/payment', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(283, 'Iyzico callback', 'iyzico.callback', 'iyzico/payment/callback', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(284, 'Paystack callback', 'paystack.callback', 'paystack/payment/callback', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(285, 'Flutterwave callback', 'flutterwave.callback', 'flutterwave/payment/callback', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(286, 'Duitku callback', 'duitku.callback', 'duitku/payment/callback', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(287, 'Duitku pay', 'duitku.pay', 'duitku/payment/submit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(288, 'Duitku return', 'duitku.return', 'duitku/payment/return', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(289, 'Youkassa finish', 'youkassa.finish', 'youkassa/finish', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(290, 'Molile redirect', 'molile.redirect', 'molile/redirect', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(291, 'Mercadopago redirect', 'mercadopago.redirect', 'mercadopago/redirect', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(292, 'Mercadopago failed', 'mercadopago.failed', 'mercadopago/failed', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(293, 'Midtrans callback', 'midtrans.callback', 'midtrans/payment/callback', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(294, 'Midtrans success', 'midtrans.success', 'midtrans/payment/finish', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(295, 'Midtrans failed', 'midtrans.failed', 'midtrans/payment/unfinish', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(296, 'Midtrans error', 'midtrans.error', 'midtrans/payment/error', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(297, 'Midtrans payment-notification', 'midtrans.payment-notification', 'midtrans/payment/payment-notification', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(298, 'Midtrans pay-account-notification', 'midtrans.pay-account-notification', 'midtrans/payment/pay-account-notification', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(299, 'Midtrans recurring-notification', 'midtrans.recurring-notification', 'midtrans/payment/recurring-notification', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(300, 'Api branchmodule', 'api.branchmodule', 'api/v1/branchmodule', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(301, 'Admin branches index', 'admin.branches.index', 'vendor/branches', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(302, 'Admin branches create', 'admin.branches.create', 'vendor/branches/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(303, 'Admin branches store', 'admin.branches.store', 'vendor/branches', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(304, 'Admin branches show', 'admin.branches.show', 'vendor/branches/{branch}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(305, 'Admin branches edit', 'admin.branches.edit', 'vendor/branches/{branch}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(306, 'Admin branches update', 'admin.branches.update', 'vendor/branches/{branch}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(307, 'Admin branches destroy', 'admin.branches.destroy', 'vendor/branches/{branch}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(308, 'Admin branches statusUpdate', 'admin.branches.statusUpdate', 'vendor/branches/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(309, 'Api cartmanager', 'api.cartmanager', 'api/v1/cartmanager', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(310, 'Carts index', 'carts.index', 'cart-manager/carts', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:25', '2025-06-15 09:17:25', NULL),
(311, 'Carts create', 'carts.create', 'cart-manager/carts/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(312, 'Carts store', 'carts.store', 'cart-manager/carts', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(313, 'Carts show', 'carts.show', 'cart-manager/carts/{cart}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(314, 'Carts edit', 'carts.edit', 'cart-manager/carts/{cart}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(315, 'Carts update', 'carts.update', 'cart-manager/carts/{cart}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(316, 'Carts destroy', 'carts.destroy', 'cart-manager/carts/{cart}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(317, 'Carts deleteCarts', 'carts.deleteCarts', 'cart-manager/carts/delete-carts/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(318, 'Api kitchenmanager', 'api.kitchenmanager', 'api/v1/kitchenmanager', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(319, 'Admin kitchens index', 'admin.kitchens.index', 'vendor/kitchens', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(320, 'Admin kitchens create', 'admin.kitchens.create', 'vendor/kitchens/create', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(321, 'Admin kitchens store', 'admin.kitchens.store', 'vendor/kitchens', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(322, 'Admin kitchens show', 'admin.kitchens.show', 'vendor/kitchens/{kitchen}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(323, 'Admin kitchens edit', 'admin.kitchens.edit', 'vendor/kitchens/{kitchen}/edit', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(324, 'Admin kitchens update', 'admin.kitchens.update', 'vendor/kitchens/{kitchen}', 'PUT', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(325, 'Admin kitchens destroy', 'admin.kitchens.destroy', 'vendor/kitchens/{kitchen}', 'DELETE', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(326, 'Admin kitchens statusUpdate', 'admin.kitchens.statusUpdate', 'vendor/kitchens/active-status-update/{id}', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(327, 'Admin kitchen_orders index', 'admin.kitchen_orders.index', 'vendor/kitchen-orders', 'GET', 1, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(328, 'Api posmanager', 'api.posmanager', 'api/v1/posmanager', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(329, 'Pos dashboard', 'pos.dashboard', 'admin/pos-manager/dashboard', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(330, 'Pos qrcode pos_order', 'pos.qrcode.pos_order', 'admin/pos-manager/pos-order-by-qrcode/{code}', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(331, 'Pos customer register', 'pos.customer.register', 'admin/pos-manager/customer/register', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(332, 'Pos order placeOrder', 'pos.order.placeOrder', 'admin/pos-manager/order/place-order', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(333, 'Pos order receiveBill', 'pos.order.receiveBill', 'admin/pos-manager/order/receive-bill', 'POST', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(334, 'Api reservationmanager', 'api.reservationmanager', 'api/v1/reservationmanager', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL),
(335, 'Api transactionmanager', 'api.transactionmanager', 'api/v1/transactionmanager', 'GET', 0, NULL, 2, 1, 1, 2, NULL, '2025-06-15 09:17:26', '2025-06-15 09:17:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Name of the menu items',
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `media_manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `preparation_time` int(11) NOT NULL DEFAULT 0 COMMENT 'preparation time in minutes',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_addons` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `total_sales_amount` double NOT NULL DEFAULT 0,
  `total_sales_count` bigint(20) NOT NULL DEFAULT 0,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `vendor_id`, `is_active`, `name`, `menu_id`, `item_category_id`, `media_manager_id`, `preparation_time`, `description`, `product_addons`, `total_sales_amount`, `total_sales_count`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Chicken Biriyani', 1, 2, NULL, 20, 'Chicken Biriyani is a delicious sub-continental origined food.', '[{\"title\":\"Borhani\",\"price\":\"70\"},{\"title\":\"Drinks\",\"price\":\"40\"}]', 0, 0, 1, NULL, NULL, '2025-05-28 06:59:03', '2025-05-28 06:59:03', NULL),
(2, 1, 1, 'Mutton Biriyani', 1, 2, NULL, 20, NULL, '[{\"title\":\"Borhani\",\"price\":\"70\"},{\"title\":\"Drinks\",\"price\":\"40\"}]', 0, 0, 1, NULL, NULL, '2025-05-28 07:11:24', '2025-05-28 07:11:24', NULL),
(3, 2, 1, 'Chicken Biriyani', 4, 4, 4, 20, 'Chicken Biriyani is a delicious sub-continental origined food.', '[{\"title\":\"Borhani\",\"price\":\"70\"},{\"title\":\"Drinks\",\"price\":\"40\"}]', 0, 0, 2, 2, NULL, '2025-05-28 06:59:03', '2025-06-16 06:30:39', NULL),
(4, 2, 1, 'Mutton Biriyani', 5, 4, 4, 20, NULL, '[{\"title\":\"Borhani\",\"price\":\"70\"},{\"title\":\"Drinks\",\"price\":\"40\"}]', 0, 0, 2, 2, NULL, '2025-05-28 07:11:24', '2025-06-16 06:34:30', NULL),
(5, 2, 1, 'Chicken Burger', 4, 5, 7, 20, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"50\"}]', 750, 5, 2, 2, NULL, '2025-06-16 06:39:00', '2025-06-25 11:41:37', NULL),
(6, 2, 1, 'KFC Chicken busket', 4, 7, 16, 20, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"50\"}]', 0, 0, 2, 2, NULL, '2025-06-16 07:00:36', '2025-06-16 07:00:56', NULL),
(7, 2, 1, 'Spring Rolls', 5, 10, 23, 20, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"50\"}]', 0, 0, 2, NULL, NULL, '2025-06-16 07:02:54', '2025-06-16 07:02:54', NULL),
(8, 2, 1, 'Pizza', 6, 10, 25, 20, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"50\"}]', 0, 0, 2, NULL, NULL, '2025-06-16 07:04:58', '2025-06-16 07:04:58', NULL),
(9, 2, 1, 'Chicken Legs', 5, 9, 18, 20, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"50\"}]', 250, 1, 2, 2, NULL, '2025-06-16 07:06:16', '2025-06-25 09:24:08', NULL),
(10, 2, 1, 'Dry Momos', 5, 9, 21, 20, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"50\"}]', 0, 0, 2, NULL, NULL, '2025-06-16 07:07:09', '2025-06-16 07:07:09', NULL),
(11, 2, 1, 'Sandwich', 6, 6, 19, 20, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"50\"}]', 80, 1, 2, 2, NULL, '2025-06-16 07:10:29', '2025-06-17 06:55:39', NULL),
(12, 2, 1, 'Cake', 6, 8, 27, 40, NULL, '[{\"title\":\"sauces\",\"price\":\"20\"}]', 0, 0, 2, 2, NULL, '2025-06-16 07:26:11', '2025-06-16 07:27:21', NULL),
(13, 2, 1, 'French Fries', 4, 6, 15, 20, NULL, NULL, 0, 0, 2, NULL, NULL, '2025-06-16 07:36:01', '2025-06-16 07:36:01', NULL),
(14, 2, 1, 'Beef Burger', 4, 5, 28, 20, NULL, NULL, 120, 1, 2, 2, NULL, '2025-06-16 07:37:09', '2025-06-17 06:55:38', NULL),
(15, 2, 1, 'Chicken nugget', 5, 9, 24, 40, NULL, '[{\"title\":\"French fires\",\"price\":\"20\"}]', 0, 0, 2, NULL, NULL, '2025-06-17 04:41:04', '2025-06-17 04:41:04', NULL),
(16, 2, 1, 'Mushroom Pizza', 6, 10, 17, 47, NULL, '[{\"title\":\"Extra soucecs\",\"price\":\"10\"}]', 0, 0, 2, NULL, NULL, '2025-06-17 04:45:06', '2025-06-17 04:45:06', NULL),
(17, 2, 1, 'Regular Burger', 4, 5, 29, 30, NULL, '[{\"title\":\"Soft Drinks\",\"price\":\"40\"}]', 0, 0, 2, NULL, NULL, '2025-06-17 04:46:55', '2025-06-17 04:46:55', NULL),
(18, 2, 1, 'Noodles', 4, 7, 30, 30, NULL, '[{\"title\":\"Tomato souces\",\"price\":\"10\"}]', 0, 0, 2, NULL, NULL, '2025-06-17 04:47:55', '2025-06-17 04:47:55', NULL),
(19, 2, 1, 'Chicken Curry', 5, 7, 31, 30, NULL, NULL, 180, 1, 2, 2, NULL, '2025-06-17 04:50:09', '2025-06-25 09:05:48', NULL),
(20, 2, 1, 'Chicken Momos', 5, 9, 32, 30, NULL, '[{\"title\":\"souces\",\"price\":\"25\"}]', 0, 0, 2, 2, NULL, '2025-06-17 04:52:40', '2025-06-17 04:52:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive',
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `discount_start_at` datetime DEFAULT NULL COMMENT 'Ex. Discount Start Date',
  `discount_end_at` datetime DEFAULT NULL COMMENT 'Ex. Discount End Date',
  `discount_type` tinyint(4) DEFAULT NULL COMMENT '1=Flat, 2=Percentage',
  `discount_value` double NOT NULL DEFAULT 0 COMMENT 'Ex. 10 Percent/Flat based on discount_type',
  `discount_amount` double NOT NULL DEFAULT 0 COMMENT 'Ex.20 as discount amount',
  `discounted_price` double NOT NULL DEFAULT 0 COMMENT 'Discounted Price of the product',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `is_active`, `product_id`, `title`, `price`, `discount_start_at`, `discount_end_at`, `discount_type`, `discount_value`, `discount_amount`, `discounted_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Regular - 1:1', 220, NULL, NULL, NULL, 0, 0, 220, '2025-05-28 00:59:03', '2025-05-28 01:00:22'),
(2, 1, 1, 'Extra - 1:3', 650, NULL, NULL, NULL, 0, 0, 650, '2025-05-28 00:59:03', '2025-05-28 01:00:22'),
(3, 1, 1, 'Family - 1:5', 1000, NULL, NULL, NULL, 0, 0, 1000, '2025-05-28 00:59:03', '2025-05-28 01:00:22'),
(4, 1, 2, 'Regular - 1:1', 220, NULL, NULL, NULL, 0, 0, 220, '2025-05-28 01:11:24', '2025-05-28 01:11:24'),
(5, 1, 2, 'Extra - 1:3', 650, NULL, NULL, NULL, 0, 0, 650, '2025-05-28 01:11:24', '2025-05-28 01:11:24'),
(6, 1, 2, 'Family 1:5', 1000, NULL, NULL, NULL, 0, 0, 1000, '2025-05-28 01:11:24', '2025-05-28 01:11:24'),
(7, 1, 3, 'Regular - 1:1', 220, NULL, NULL, NULL, 0, 0, 220, '2025-05-28 00:59:03', '2025-05-28 01:00:22'),
(8, 1, 3, 'Extra - 1:3', 650, NULL, NULL, NULL, 0, 0, 650, '2025-05-28 00:59:03', '2025-05-28 01:00:22'),
(9, 1, 3, 'Family - 1:5', 1000, NULL, NULL, NULL, 0, 0, 1000, '2025-05-28 00:59:03', '2025-05-28 01:00:22'),
(10, 1, 4, 'Regular - 1:1', 220, NULL, NULL, NULL, 0, 0, 220, '2025-05-28 01:11:24', '2025-05-28 01:11:24'),
(11, 1, 4, 'Extra - 1:3', 650, NULL, NULL, NULL, 0, 0, 650, '2025-05-28 01:11:24', '2025-05-28 01:11:24'),
(12, 1, 4, 'Family 1:5', 1000, NULL, NULL, NULL, 0, 0, 1000, '2025-05-28 01:11:24', '2025-05-28 01:11:24'),
(13, 1, 5, 'Burger', 150, NULL, NULL, NULL, 0, 0, 150, '2025-06-16 00:39:00', '2025-06-16 00:39:00'),
(14, 1, 6, 'Chicken', 125, NULL, NULL, NULL, 0, 0, 125, '2025-06-16 01:00:36', '2025-06-16 01:00:36'),
(15, 1, 7, 'Spring Rolls', 120, NULL, NULL, NULL, 0, 0, 120, '2025-06-16 01:02:54', '2025-06-16 01:02:54'),
(16, 1, 8, 'pizza', 350, NULL, NULL, NULL, 0, 0, 350, '2025-06-16 01:04:58', '2025-06-16 01:04:58'),
(17, 1, 9, 'f', 250, NULL, NULL, NULL, 0, 0, 250, '2025-06-16 01:06:16', '2025-06-16 01:06:16'),
(18, 1, 10, 'momos', 120, NULL, NULL, NULL, 0, 0, 120, '2025-06-16 01:07:09', '2025-06-16 01:07:09'),
(19, 1, 11, 'Sandwich', 80, NULL, NULL, NULL, 0, 0, 80, '2025-06-16 01:10:29', '2025-06-16 01:10:38'),
(20, 1, 12, 'cake', 450, NULL, NULL, NULL, 0, 0, 450, '2025-06-16 01:26:11', '2025-06-16 01:26:11'),
(21, 1, 13, 'french fry', 75, NULL, NULL, NULL, 0, 0, 75, '2025-06-16 01:36:01', '2025-06-16 01:36:01'),
(22, 1, 14, 'Buger', 120, NULL, NULL, NULL, 0, 0, 120, '2025-06-16 01:37:09', '2025-06-16 01:37:09'),
(23, 1, 15, 'Chicken Nugget', 140, NULL, NULL, NULL, 0, 0, 140, '2025-06-16 22:41:04', '2025-06-16 22:41:04'),
(24, 1, 16, 'Mushroom pizza', 400, NULL, NULL, NULL, 0, 0, 400, '2025-06-16 22:45:06', '2025-06-16 22:45:06'),
(25, 1, 17, 'Regular - 1:1', 50, NULL, NULL, NULL, 0, 0, 50, '2025-06-16 22:46:55', '2025-06-16 22:46:55'),
(26, 1, 18, 'Regular - 1:1', 50, NULL, NULL, NULL, 0, 0, 50, '2025-06-16 22:47:55', '2025-06-16 22:47:55'),
(27, 1, 19, 'Regular - 1:1', 180, NULL, NULL, NULL, 0, 0, 180, '2025-06-16 22:50:09', '2025-06-16 22:50:09'),
(28, 1, 20, 'Regular - 1:1', 150, NULL, NULL, NULL, 0, 0, 150, '2025-06-16 22:52:40', '2025-06-16 22:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`id`, `title`, `code`, `created_at`, `updated_at`) VALUES
(1, NULL, 'iMLYZq4edIV6', '2025-05-27 00:50:50', '2025-05-27 00:50:50'),
(2, NULL, 'htxDR5EeSw12', '2025-05-27 06:39:59', '2025-05-27 06:39:59'),
(3, NULL, 'htxDR6EeSw12', '2025-05-27 06:39:59', '2025-05-27 06:39:59'),
(4, NULL, 'htxDA5EeSw12', '2025-05-27 06:39:59', '2025-05-27 06:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `reply_tickets`
--

CREATE TABLE `reply_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `replied` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `replied_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `start_datetime` datetime DEFAULT NULL COMMENT 'Reservation start time',
  `end_datetime` datetime DEFAULT NULL COMMENT 'Reservation start time',
  `number_of_guests` int(11) NOT NULL DEFAULT 0 COMMENT 'Number of guests',
  `is_paid` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not paid, 1=paid',
  `advance_reservation_payment` double NOT NULL DEFAULT 0,
  `total_reservation_amount` double NOT NULL DEFAULT 0,
  `due_reservation_payment` double NOT NULL DEFAULT 0,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `status_id`, `branch_id`, `area_id`, `vendor_id`, `customer_id`, `start_datetime`, `end_datetime`, `number_of_guests`, `is_paid`, `advance_reservation_payment`, `total_reservation_amount`, `due_reservation_payment`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 1, 2, 6, '2025-06-15 15:36:00', '2025-06-15 17:36:00', 4, 0, 500, 1500, 1000, 2, NULL, NULL, '2025-06-15 03:36:53', '2025-06-15 03:41:29', NULL),
(2, 3, 3, 1, 2, 6, '2025-06-15 15:36:00', '2025-06-15 17:36:00', 4, 0, 500, 1500, 1000, 2, 2, NULL, '2025-06-15 03:41:08', '2025-06-15 06:53:15', NULL),
(3, 4, 4, 3, 2, 8, '2025-06-20 14:00:00', '2025-06-20 15:00:00', 4, 1, 2000, 2000, 0, 2, 2, NULL, '2025-06-15 23:39:07', '2025-06-15 23:39:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_tables`
--

CREATE TABLE `reservation_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_tables`
--

INSERT INTO `reservation_tables` (`id`, `reservation_id`, `table_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-06-15 03:36:53', '2025-06-15 03:41:29'),
(2, 2, 2, '2025-06-15 03:41:08', '2025-06-15 06:53:15'),
(3, 3, 3, '2025-06-15 23:39:07', '2025-06-15 23:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Parent id of staff or customer/admin',
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 2, 1, 2, 2, '2025-06-15 09:18:21', '2025-06-15 09:18:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `permission_id`, `role_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 77, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(2, 26, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(3, 27, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(4, 28, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(5, 29, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(6, 30, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(7, 31, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(8, 32, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(9, 34, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(10, 35, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(11, 36, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(12, 37, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(13, 38, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(14, 39, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(15, 40, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(16, 46, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(17, 47, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(18, 48, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(19, 49, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(20, 50, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(21, 51, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(22, 52, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(23, 53, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(24, 221, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(25, 222, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(26, 223, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(27, 224, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(28, 225, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(29, 226, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(30, 227, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(31, 228, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(32, 229, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(33, 230, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(34, 231, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(35, 232, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(36, 233, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(37, 234, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(38, 235, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(39, 236, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(40, 237, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(41, 238, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(42, 239, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(43, 240, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(44, 241, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(45, 242, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(46, 243, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(47, 244, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(48, 245, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(49, 246, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(50, 301, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(51, 302, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(52, 303, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(53, 304, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(54, 305, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(55, 306, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(56, 307, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(57, 308, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(58, 247, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(59, 248, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(60, 249, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(61, 250, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(62, 251, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(63, 252, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(64, 253, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(65, 254, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(66, 255, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(67, 256, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(68, 257, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(69, 258, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(70, 259, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(71, 260, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(72, 261, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(73, 262, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(74, 263, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(75, 42, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(76, 86, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(77, 87, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(78, 88, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(79, 89, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(80, 90, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(81, 91, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(82, 92, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(83, 93, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(84, 136, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(85, 137, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(86, 139, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(87, 145, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(88, 73, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(89, 74, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(90, 75, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(91, 76, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(92, 172, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(93, 173, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(94, 210, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(95, 212, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(96, 319, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(97, 320, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(98, 321, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(99, 322, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(100, 323, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(101, 324, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(102, 325, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(103, 326, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(104, 273, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(105, 274, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(106, 147, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(107, 148, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(108, 149, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(109, 150, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(110, 151, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(111, 152, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(112, 153, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(113, 154, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(114, 310, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(115, 311, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(116, 312, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(117, 313, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(118, 314, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(119, 315, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(120, 316, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(121, 317, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(122, 329, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(123, 330, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(124, 331, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(125, 331, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(126, 265, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(127, 266, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(128, 264, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(129, 327, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(130, 265, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(131, 266, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(132, 162, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(133, 271, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(134, 272, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(135, 269, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(136, 120, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(137, 121, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(138, 123, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(139, 128, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(140, 129, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(141, 131, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(142, 58, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(143, 59, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(144, 60, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(145, 61, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(146, 62, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(147, 63, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(148, 64, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(149, 72, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(150, 65, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(151, 66, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(152, 67, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(153, 68, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(154, 69, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(155, 70, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL),
(156, 71, 1, 1, NULL, NULL, '2025-06-15 09:18:21', '2025-06-15 09:18:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `context` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive',
  `icon` text DEFAULT NULL,
  `kitchen_access` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `branch_access` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `order_access` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `reservation_access` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `title`, `context`, `is_active`, `icon`, `kitchen_access`, `branch_access`, `order_access`, `reservation_access`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Completed', 'completed', 1, NULL, 1, 1, 1, 1, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(2, 'Pending', 'pending', 1, NULL, 1, 1, 1, 1, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(3, 'Cancelled', 'cancelled', 1, NULL, 1, 1, 1, 1, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(4, 'Hold', 'hold', 1, NULL, 1, 2, 1, 1, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(5, 'Cooking - Pending', 'cooking_pending', 1, NULL, 1, 2, 1, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(6, 'Cooking - Ongoing', 'cooking_ongoing', 1, NULL, 1, 2, 1, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(7, 'Cooking - Completed', 'cooking_completed', 1, NULL, 1, 2, 1, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(8, 'Food Served', 'food_served', 1, NULL, 2, 1, 1, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(9, 'Ready for Pickup', 'ready_for_pickup', 1, NULL, 2, 1, 2, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(10, 'Out for Delivery', 'out_for_delivery', 1, NULL, 2, 1, 2, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(11, 'Delivery Boy Assigned', 'delivery_boy_assigned', 1, NULL, 2, 1, 2, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL),
(12, 'Delivered', 'delivered', 1, NULL, 2, 1, 2, 2, NULL, NULL, NULL, '2025-06-15 03:05:29', '2025-06-15 03:05:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `storage_managers`
--

CREATE TABLE `storage_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `access_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `bucket` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `container` varchar(255) DEFAULT NULL,
  `storage_name` varchar(255) DEFAULT NULL,
  `storage_url` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storage_managers`
--

INSERT INTO `storage_managers` (`id`, `type`, `access_key`, `secret_key`, `bucket`, `region`, `container`, `storage_name`, `storage_url`, `file_name`, `path`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'local', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'aws', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_users`
--

CREATE TABLE `subscribed_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_status` varchar(255) NOT NULL,
  `stripe_price` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_product` varchar(255) NOT NULL,
  `stripe_price` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `has_monthly_limit` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `duration` int(11) DEFAULT 30,
  `description` varchar(255) DEFAULT NULL,
  `package_type` varchar(255) NOT NULL DEFAULT 'monthly' COMMENT 'starter/monthly/yearly/lifetime/prepaid',
  `price` double NOT NULL DEFAULT 0,
  `discount_price` double DEFAULT NULL,
  `discount_type` int(11) DEFAULT NULL COMMENT '1=fixed, 2=percentage',
  `discount` double DEFAULT NULL,
  `discount_status` int(11) DEFAULT NULL,
  `discount_start_date` date DEFAULT NULL,
  `discount_end_date` date DEFAULT NULL,
  `allow_unlimited_branches` tinyint(4) DEFAULT 0,
  `total_branches` bigint(20) NOT NULL DEFAULT 0,
  `allow_kitchen_panel` tinyint(4) DEFAULT 1,
  `show_kitchen_panel` tinyint(4) DEFAULT 1,
  `allow_reservations` tinyint(4) DEFAULT 1,
  `show_reservations` tinyint(4) DEFAULT 1,
  `allow_support` tinyint(4) NOT NULL DEFAULT 0,
  `show_support` tinyint(4) NOT NULL DEFAULT 1,
  `allow_team` tinyint(4) NOT NULL DEFAULT 0,
  `show_team` tinyint(4) NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `other_features` longtext DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `has_monthly_limit`, `title`, `slug`, `user_id`, `duration`, `description`, `package_type`, `price`, `discount_price`, `discount_type`, `discount`, `discount_status`, `discount_start_date`, `discount_end_date`, `allow_unlimited_branches`, `total_branches`, `allow_kitchen_panel`, `show_kitchen_panel`, `allow_reservations`, `show_reservations`, `allow_support`, `show_support`, `allow_team`, `show_team`, `is_featured`, `other_features`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Starter', 'new-plan-O7G0G7Y9n0X0P3k', 1, 30, 'Get started with our new package', 'starter', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5, 1, 1, 0, 1, 0, 1, 0, 1, 0, NULL, 1, 1, 1, '2025-05-31 04:53:55', '2025-06-15 23:20:43', NULL),
(2, 0, 'Basic', 'new-plan-O7G0G7Y9n0X0P3k', 1, 30, 'Get started with our basic package', 'monthly', 10, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5, 1, 1, 1, 1, 0, 1, 0, 1, 1, NULL, 1, 1, 1, '2025-05-31 05:31:56', '2025-06-15 23:20:28', NULL),
(3, 0, 'Basic', 'new-plan-O7G0G7Y9n0X0P3k', 1, 30, 'Get started with our unlimited package', 'yearly', 100, NULL, NULL, NULL, NULL, NULL, NULL, 0, 50, 1, 1, 1, 1, 0, 1, 0, 1, 1, NULL, 1, 1, 1, '2025-05-31 05:33:22', '2025-06-15 23:22:55', NULL),
(4, 0, 'Extended', 'new-plan-O7G0G7Y9n0X0P3k', 1, 30, 'Get started with our basic package', 'monthly', 20, NULL, NULL, NULL, NULL, NULL, NULL, 0, 50, 1, 1, 1, 1, 1, 1, 1, 1, 0, NULL, 1, 1, 1, '2025-06-15 23:19:25', '2025-06-15 23:20:10', NULL),
(5, 0, 'Extended', 'new-plan-O7G0G7Y9n0X0P3k', 1, 30, 'Get started with our basic package', 'yearly', 200, NULL, NULL, NULL, NULL, NULL, NULL, 1, 50, 1, 1, 1, 1, 1, 1, 1, 1, 0, NULL, 1, 1, 1, '2025-06-15 23:21:48', '2025-06-15 23:22:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_recurring_payments`
--

CREATE TABLE `subscription_recurring_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_user_usage_id` int(11) DEFAULT NULL,
  `billing_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `price_id` varchar(255) DEFAULT NULL,
  `gateway_subscription_id` varchar(255) DEFAULT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cancel_by` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_users`
--

CREATE TABLE `subscription_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_status` int(11) DEFAULT NULL COMMENT '1=active, 2=expired, 3=subscribed, 4=pending',
  `start_at` datetime DEFAULT NULL COMMENT 'Subscription Starting date',
  `expire_at` datetime DEFAULT NULL COMMENT 'Subscription expire date',
  `has_monthly_limit` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly',
  `price` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `discount_type` int(11) DEFAULT NULL,
  `forcefully_active` int(11) DEFAULT NULL,
  `is_recurring` tinyint(4) DEFAULT 0,
  `is_carried_over` tinyint(4) DEFAULT 0,
  `order_id` varchar(255) DEFAULT NULL,
  `offline_payment_id` int(11) DEFAULT NULL,
  `payment_gateway_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT '0',
  `payment_details` longtext DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT '0',
  `file` text DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `feedback_note` longtext DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL COMMENT '1=paid, 2=Pending, 3=Rejected 4=Re-Submit',
  `expire_by_admin_date` datetime DEFAULT NULL COMMENT 'Subscription expire by admin date',
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_users`
--

INSERT INTO `subscription_users` (`id`, `user_id`, `subscription_plan_id`, `subscription_status`, `start_at`, `expire_at`, `has_monthly_limit`, `price`, `discount`, `discount_type`, `forcefully_active`, `is_recurring`, `is_carried_over`, `order_id`, `offline_payment_id`, `payment_gateway_id`, `payment_method`, `payment_details`, `currency_code`, `file`, `note`, `feedback_note`, `payment_status`, `expire_by_admin_date`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 4, 2, '2025-06-16 00:00:00', '2025-07-16 00:00:00', 0, 20, 0, NULL, 0, 0, 0, NULL, 1, 13, '0', NULL, '0', NULL, NULL, NULL, 1, '2025-06-16 05:28:10', 1, 2, NULL, '2025-06-16 05:25:50', '2025-06-16 05:28:10', NULL),
(2, 2, 5, 1, '2025-06-16 00:00:00', '2026-06-16 00:00:00', 0, 200, 0, NULL, 0, 0, 0, NULL, 1, 13, '0', NULL, '0', NULL, NULL, NULL, 1, NULL, 1, 2, NULL, '2025-06-16 05:27:54', '2025-06-16 05:28:10', NULL),
(3, 2, 3, 4, '2025-06-16 00:00:00', NULL, 0, 100, 0, NULL, 0, 0, 0, NULL, 1, 13, '0', NULL, '0', NULL, NULL, NULL, 2, NULL, 1, 2, NULL, '2025-06-16 05:28:37', '2025-06-16 05:28:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_user_usages`
--

CREATE TABLE `subscription_user_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_status` int(11) DEFAULT NULL COMMENT '1=active, 2=expired, 3=subscribed, 4=pending',
  `platform` varchar(255) NOT NULL DEFAULT '1',
  `has_monthly_limit` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly',
  `start_at` datetime NOT NULL,
  `expire_at` datetime NOT NULL,
  `allow_unlimited_branches` tinyint(4) DEFAULT 0,
  `branch_balance` int(11) NOT NULL DEFAULT 0,
  `branch_balance_used` int(11) NOT NULL DEFAULT 0,
  `branch_balance_remaining` int(11) NOT NULL DEFAULT 0,
  `allow_kitchen_panel` tinyint(4) DEFAULT 0,
  `allow_reservations` tinyint(4) DEFAULT 0,
  `allow_support` tinyint(4) DEFAULT 0,
  `allow_team` tinyint(4) DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_user_usages`
--

INSERT INTO `subscription_user_usages` (`id`, `user_id`, `subscription_user_id`, `subscription_plan_id`, `subscription_status`, `platform`, `has_monthly_limit`, `start_at`, `expire_at`, `allow_unlimited_branches`, `branch_balance`, `branch_balance_used`, `branch_balance_remaining`, `allow_kitchen_panel`, `allow_reservations`, `allow_support`, `allow_team`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 4, 2, '1', 1, '2025-06-16 00:00:00', '2025-07-16 00:00:00', 0, 50, 0, 50, 1, 1, 1, 1, 1, 1, NULL, '2025-06-16 05:26:22', '2025-06-16 05:28:10', NULL),
(2, 2, 2, 5, 1, '1', 1, '2025-06-16 00:00:00', '2026-06-16 00:00:00', 1, 50, 0, 50, 1, 1, 1, 1, 1, 1, NULL, '2025-06-16 05:28:09', '2025-06-16 05:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support_categories`
--

CREATE TABLE `support_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `assign_staff` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_categories`
--

INSERT INTO `support_categories` (`id`, `name`, `slug`, `assign_staff`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Data Setup', 'data-setup-t0r4I8u9N1U0C3e', NULL, 1, 1, 1, NULL, '2025-06-15 09:43:43', '2025-06-15 09:43:43', NULL),
(2, 'FAQs', 'faqs-n5k0T3m2w3e7k0s', NULL, 1, 1, 1, NULL, '2025-06-15 09:43:57', '2025-06-15 09:43:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support_priorities`
--

CREATE TABLE `support_priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_priorities`
--

INSERT INTO `support_priorities` (`id`, `name`, `slug`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Low', 'low-k1Q5D5z0t9u5Y3U', 1, 1, 1, NULL, '2025-06-15 09:44:12', '2025-06-15 09:44:12', NULL),
(2, 'Medium', 'medium-o6O3a2H9q4y8L8h', 1, 1, 1, NULL, '2025-06-15 09:44:21', '2025-06-15 09:44:21', NULL),
(3, 'High', 'high-x1n2G3m5p0R0G3Y', 1, 1, 1, NULL, '2025-06-15 09:44:28', '2025-06-15 09:44:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `entity`, `value`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'hero_title', 'One Tools For Doing it All Together', 1, 1, 1, 1, '2024-08-18 05:46:59', '2025-01-27 05:22:23', NULL),
(2, 'hero_sub_title', 'With comprehensive competitor analysis, detailed web research, and strategic internal linking, your articles will be', 1, 1, 1, 1, '2024-08-18 05:46:59', '2025-01-26 11:48:55', NULL),
(3, 'hero_sub_title_btn_text', 'Book a Demo', 1, 1, 1, 1, '2024-08-18 05:46:59', '2025-01-27 05:01:40', NULL),
(4, 'hero_sub_title_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2024-08-18 05:46:59', '2025-01-28 07:05:52', NULL),
(5, 'useuse_customer', '150,000+ Client Use Restros AI every day', 1, 1, 1, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59', NULL),
(6, 'hero_background_image', '210', 1, 1, 1, 1, '2024-08-18 05:46:59', '2025-01-27 11:19:31', NULL),
(7, 'hero_is_active', '1', 1, 1, 1, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59', NULL),
(8, 'brand_background_images', '174,178,177,176,175,172,171,173', 1, 1, 1, 1, '2024-08-18 05:54:29', '2025-01-26 12:23:50', NULL),
(9, 'brand_is_active', '1', 1, 1, 1, 1, '2024-08-18 05:54:29', '2025-01-26 12:20:29', NULL),
(10, 'feature_document_1_title', 'All in One tool for Generating Viral Shorts Using AI', 1, 1, 1, 1, '2024-08-18 06:17:10', '2025-01-26 12:25:02', NULL),
(11, 'feature_document_1_short_description', 'Unlock your creativity and unleash your potential to create advanced images effortlessly don’t limit yourself. using generative AI and data from millions of emails.', 1, 1, 1, 1, '2024-08-18 06:17:10', '2025-01-01 12:39:50', NULL),
(12, 'feature_document_1_image', '41', 1, 1, 1, NULL, '2024-08-18 06:17:10', '2024-08-18 06:17:10', NULL),
(13, 'feature_document_1_is_active', '1', 1, 1, 1, 1, '2024-08-18 06:17:10', '2025-01-01 12:39:28', NULL),
(14, 'feature_document_2_title', 'AI Image Generator', 1, 1, 1, 1, '2024-08-18 06:18:01', '2025-01-26 12:28:41', NULL),
(15, 'feature_document_2_short_description', 'Enter Your Image Prompt', 1, 1, 1, 1, '2024-08-18 06:18:01', '2025-01-26 12:29:32', NULL),
(16, 'feature_document_2_image', '208', 1, 1, 1, 1, '2024-08-18 06:18:01', '2025-01-27 10:00:29', NULL),
(17, 'feature_document_2_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:18:01', '2024-08-18 06:18:01', NULL),
(18, 'feature_document_3_title', 'Chat With AI', 1, 1, 1, 1, '2024-08-18 06:18:47', '2025-01-26 12:32:44', NULL),
(19, 'feature_document_3_short_description', '\"Discover innovation, inspire growth, embrace creativity, transform dreams into reality.\"', 1, 1, 1, 1, '2024-08-18 06:18:47', '2025-01-26 12:32:44', NULL),
(20, 'feature_document_3_image', '187', 1, 1, 1, 1, '2024-08-18 06:18:47', '2025-01-26 12:32:44', NULL),
(21, 'feature_document_3_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:18:47', '2024-08-18 06:18:47', NULL),
(22, 'feature_document_4_title', 'AI Code Generator', 1, 1, 1, 1, '2024-08-18 06:20:06', '2025-01-27 11:23:42', NULL),
(23, 'feature_document_4_short_description', 'AI code generator automates development, saves time, ensures accuracy.', 1, 1, 1, 1, '2024-08-18 06:20:06', '2025-01-27 11:24:57', NULL),
(24, 'feature_document_4_image', '188', 1, 1, 1, 1, '2024-08-18 06:20:06', '2025-01-26 12:34:20', NULL),
(25, 'feature_document_4_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:20:06', '2024-08-18 06:20:06', NULL),
(26, 'feature_1_title', 'AI Generator', 1, 1, 1, 1, '2024-08-18 06:30:44', '2025-01-26 12:39:55', NULL),
(27, 'feature_1_short_description', 'AI-powered translation tools Save per day on ad management Create generate caption. Create generate caption.', 1, 1, 1, 1, '2024-08-18 06:30:44', '2025-01-26 12:39:55', NULL),
(28, 'feature_1_image', '46', 1, 1, 1, NULL, '2024-08-18 06:30:44', '2024-08-18 06:30:44', NULL),
(29, 'feature_1_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:30:44', '2024-08-18 06:30:44', NULL),
(30, 'feature_2_title', 'Advanced Dashboard', 1, 1, 1, 1, '2024-08-18 06:31:15', '2025-01-27 05:10:38', NULL),
(31, 'feature_2_short_description', 'Advanced AI dashboard optimizes decision-making, enhances productivity, simplifies tasks, and provides real-time data-driven insights.', 1, 1, 1, 1, '2024-08-18 06:31:15', '2025-01-27 05:11:12', NULL),
(32, 'feature_2_image', '47', 1, 1, 1, NULL, '2024-08-18 06:31:15', '2024-08-18 06:31:15', NULL),
(33, 'feature_2_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:31:15', '2024-08-18 06:31:15', NULL),
(34, 'feature_3_title', 'Payment Gateways', 1, 1, 1, 1, '2024-08-18 06:31:49', '2025-01-27 05:12:27', NULL),
(35, 'feature_3_short_description', 'Secure payment gateways simplify transactions, support multiple currencies, ensure fraud protection, and enable seamless e-commerce.', 1, 1, 1, 1, '2024-08-18 06:31:49', '2025-01-27 05:12:27', NULL),
(36, 'feature_3_image', '48', 1, 1, 1, NULL, '2024-08-18 06:31:49', '2024-08-18 06:31:49', NULL),
(37, 'feature_3_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:31:49', '2024-08-18 06:31:49', NULL),
(38, 'feature_4_title', 'Multi-Lingual', 1, 1, 1, 1, '2024-08-18 06:32:21', '2025-01-27 05:13:23', NULL),
(39, 'feature_4_short_description', 'Multi-lingual support enhances user experience, bridges language gaps, boosts global reach, and fosters inclusive communication.', 1, 1, 1, 1, '2024-08-18 06:32:21', '2025-01-27 05:13:23', NULL),
(40, 'feature_4_image', '49', 1, 1, 1, NULL, '2024-08-18 06:32:21', '2024-08-18 06:32:21', NULL),
(41, 'feature_4_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:32:21', '2024-08-18 06:32:21', NULL),
(42, 'feature_5_title', 'Unlimited Templates', 1, 1, 1, 1, '2024-08-18 06:32:57', '2025-01-27 05:14:16', NULL),
(43, 'feature_5_short_description', 'Unlimited templates offer endless design possibilities, streamline creativity, save time, and cater to diverse project needs.', 1, 1, 1, 1, '2024-08-18 06:32:57', '2025-01-27 05:14:16', NULL),
(44, 'feature_5_image', '50', 1, 1, 1, NULL, '2024-08-18 06:32:57', '2024-08-18 06:32:57', NULL),
(45, 'feature_5_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:32:57', '2024-08-18 06:32:57', NULL),
(46, 'feature_6_title', 'Support Platform', 1, 1, 1, 1, '2024-08-18 06:33:50', '2025-01-27 05:15:04', NULL),
(47, 'feature_6_short_description', 'Comprehensive support platform resolves queries, enhances user satisfaction, streamlines communication, and ensures seamless assistance.', 1, 1, 1, 1, '2024-08-18 06:33:50', '2025-01-27 05:15:04', NULL),
(48, 'feature_6_image', '105', 1, 1, 1, NULL, '2024-08-18 06:33:50', '2024-08-18 06:33:50', NULL),
(49, 'feature_6_is_active', '1', 1, 1, 1, 1, '2024-08-18 06:33:50', '2025-01-01 12:53:31', NULL),
(50, 'feature_7_title', 'Generate Multilingual Blog to rank article in minutes', 1, 1, 1, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35', NULL),
(51, 'feature_7_short_description', 'Learning multiple languages offers numerous benefits that can enhance both your personal and professional life. It opens up new cultural', 1, 1, 1, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35', NULL),
(52, 'feature_7_image', '52', 1, 1, 1, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35', NULL),
(53, 'feature_7_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35', NULL),
(54, 'feature_8_title', 'So, how does it work?', 1, 1, 1, NULL, '2024-08-18 06:35:53', '2024-08-18 06:35:53', NULL),
(55, 'feature_8_sub_title', 'How to use Restros AI   how does it work?  On your SaaS business', 1, 1, 1, NULL, '2024-08-18 06:35:53', '2024-08-18 06:35:53', NULL),
(56, 'feature_8_sub_title_btn_text', 'Learn More', 1, 1, 1, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54', NULL),
(57, 'feature_8_sub_title_btn_link', 'http://restros.test/login', 1, 1, 1, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54', NULL),
(58, 'youtube_embeded_link', 'https://www.youtube.com/embed/8U1lheQAqjg', 1, 1, 1, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54', NULL),
(59, 'feature_8_is_active', '1', 1, 1, 1, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54', NULL),
(60, 'auth_image', '34', 1, 1, 1, 1, '2024-08-18 06:36:37', '2025-06-17 06:00:18', NULL),
(61, 'copywrite_text', '<p>Copyright © 2025 <b>Themetags</b><br></p>', 1, 1, 1, 1, '2024-08-18 09:29:34', '2024-08-18 11:50:41', NULL),
(62, 'aboutUsContents', '<h3>About Us</h3><p>At Restros, we believe in the power of words to shape ideas, convey emotions, and transform the world. Our AI-driven application is designed to empower writers, creators, and businesses to craft compelling content with ease and precision.</p><p><strong>Our Mission</strong><br>Our mission is to democratize the art of writing by providing an intelligent, intuitive platform that helps users of all skill levels create high-quality content. Whether you\'re drafting a blog post, writing an academic paper, or crafting the perfect social media update, Restros is here to support you every step of the way.</p><p><b>Our Technology<br></b>Harnessing the latest advancements in AI and natural language processing, Restros delivers smart writing assistance that goes beyond mere grammar and spelling checks. Our AI understands context, suggests improvements, and even helps you refine your tone and style, ensuring your writing resonates with your audience.</p><p><strong>Why Choose WriterAP?</strong></p><ul><li><strong>Intelligent Suggestions</strong>: Our AI offers context-aware suggestions that enhance your writing without losing your unique voice.</li><li><strong>Time-Efficient</strong>: Save time on revisions and editing by getting real-time feedback and suggestions.</li><li><strong>User-Friendly Interface</strong>: With a sleek and intuitive design, Restros is easy to use for both beginners and seasoned writers.</li><li><strong>Versatile Applications</strong>: From content marketing to academic writing, Restros adapts to various writing needs.</li></ul><p><strong>Our Vision</strong><br>We envision a future where everyone, regardless of their background or experience, has the tools to express their ideas effectively. By blending human creativity with AI precision, Restros is redefining the writing process, making it more accessible, efficient, and enjoyable.</p><p>Join us on this journey to transform the way we write and communicate. With Restros, the power of words is at your fingertips.</p>', 1, 1, 1, 1, '2024-08-18 09:43:53', '2025-01-01 13:21:59', NULL),
(63, 'system_title', 'Restros laravel', 1, 1, 1, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04', NULL),
(64, 'tab_separator', ':', 1, 1, 1, 1, '2024-08-18 11:47:04', '2025-01-01 11:04:01', NULL),
(65, 'contact_email', 'hellothemetags@gmail.com', 1, 1, 1, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04', NULL),
(66, 'contact_phone', '540-907-0453', 1, 1, 1, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04', NULL),
(67, 'contact_address', 'Uttara, Dhaka-Bangladesh', 1, 1, 1, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04', NULL),
(68, 'logo_for_light', '33', 1, 1, 1, 1, '2024-08-18 11:47:04', '2025-06-17 06:00:06', NULL),
(69, 'logo_for_dark', '33', 1, 1, 1, 1, '2024-08-18 11:47:04', '2025-06-17 06:00:06', NULL),
(70, 'collapse_able_icon', '35', 1, 1, 1, 1, '2024-08-18 11:47:04', '2025-06-17 06:00:06', NULL),
(71, 'favicon', '35', 1, 1, 1, 1, '2024-08-18 11:47:04', '2025-06-17 06:00:06', NULL),
(72, 'preloader', '33', 1, 1, 1, 1, '2024-08-18 11:47:04', '2025-06-17 06:00:06', NULL),
(73, 'enable_ai_chat', '1', 1, 1, 1, 1, '2024-08-18 11:48:03', '2025-01-01 14:17:24', NULL),
(74, 'enable_ai_pdf_chat', '1', 1, 1, 1, NULL, '2024-08-18 11:48:04', '2024-08-18 11:48:04', NULL),
(75, 'enable_ai_vision', '1', 1, 1, 1, NULL, '2024-08-18 11:48:06', '2024-08-18 11:48:06', NULL),
(76, 'enable_ai_video', '1', 1, 1, 1, NULL, '2024-08-18 11:48:07', '2024-08-18 11:48:07', NULL),
(77, 'enable_ai_images', '1', 1, 1, 1, NULL, '2024-08-18 11:48:08', '2024-08-18 11:48:08', NULL),
(78, 'enable_ai_chat_image', '1', 1, 1, 1, NULL, '2024-08-18 11:48:10', '2024-08-18 11:48:10', NULL),
(79, 'enable_ai_detector', '1', 1, 1, 1, NULL, '2024-08-18 11:48:11', '2024-08-18 11:48:11', NULL),
(80, 'enable_ai_plagiarism', '1', 1, 1, 1, NULL, '2024-08-18 11:48:12', '2024-08-18 11:48:12', NULL),
(81, 'enable_ai_rewriter', '1', 1, 1, 1, NULL, '2024-08-18 11:48:13', '2024-08-18 11:48:13', NULL),
(82, 'enable_templates', '1', 1, 1, 1, NULL, '2024-08-18 11:48:14', '2024-08-18 11:48:14', NULL),
(83, 'enable_ai_blog_wizard', '1', 1, 1, 1, 1, '2024-08-18 11:48:16', '2025-01-26 08:36:42', NULL),
(84, 'enable_speech_to_text', '1', 1, 1, 1, NULL, '2024-08-18 11:48:18', '2024-08-18 11:48:18', NULL),
(85, 'enable_text_to_speech', '1', 1, 1, 1, NULL, '2024-08-18 11:48:19', '2024-08-18 11:48:19', NULL),
(86, 'enable_eleven_labs', '1', 1, 1, 1, NULL, '2024-08-18 11:48:20', '2024-08-18 11:48:20', NULL),
(87, 'enable_google_cloud', '1', 1, 1, 1, NULL, '2024-08-18 11:48:21', '2024-08-18 11:48:21', NULL),
(88, 'enable_azure', '1', 1, 1, 1, NULL, '2024-08-18 11:48:22', '2024-08-18 11:48:22', NULL),
(89, 'enable_generate_image', '1', 1, 1, 1, NULL, '2024-08-18 11:48:24', '2024-08-18 11:48:24', NULL),
(90, 'enable_generate_image_step', '1', 1, 1, 1, NULL, '2024-08-18 11:48:25', '2024-08-18 11:48:25', NULL),
(91, 'enable_generate_code', '1', 1, 1, 1, NULL, '2024-08-18 11:48:26', '2024-08-18 11:48:26', NULL),
(92, 'order_code_prefix', 'WRITERAP#:', 1, 1, 1, NULL, '2024-08-18 11:50:06', '2024-08-18 11:50:06', NULL),
(93, 'order_code_start', '001', 1, 1, 1, NULL, '2024-08-18 11:50:06', '2024-08-18 11:50:06', NULL),
(94, 'invoice_thanksgiving', 'Thank you for purchasing from our store and for your order. it is awesome to have you as one of our paid users. We hope that you will be happy with Qlearly, if you ever have any questions, suggestions, or concerns please do not hesitate to contact us.', 1, 1, 1, NULL, '2024-08-18 11:50:06', '2024-08-18 11:50:06', NULL),
(95, 'default_open_ai_model', 'gpt-4', 1, 1, 1, 1, '2024-12-31 10:58:43', '2025-01-01 14:06:38', NULL),
(96, 'ai_chat_model', 'gpt-3.5-turbo', 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(97, 'ai_blog_wizard_model', 'gpt-4', 1, 1, 1, 1, '2024-12-31 10:58:43', '2025-01-01 14:06:38', NULL),
(98, 'generate_image_option', 'dall_e_2', 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(99, 'default_creativity', '1', 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(100, 'default_number_of_results', '1', 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(101, 'default_tone', 'Professional', 1, 1, 1, 1, '2024-12-31 10:58:43', '2025-01-28 14:55:53', NULL),
(102, 'api_key_use', 'main', 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(103, 'default_max_result_length', NULL, 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(104, 'default_max_result_length_blog_wizard', NULL, 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(105, 'ai_filter_bad_words', NULL, 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(106, 'opne_ai_tts_maximum_character', NULL, 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(107, 'OPENAI_SECRET_KEY', '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', 1, 1, 1, NULL, '2024-12-31 10:58:43', '2024-12-31 10:58:43', NULL),
(108, 'enable_preloader', '1', 1, 1, 1, 1, '2024-12-31 13:30:00', '2025-01-01 11:04:51', NULL),
(109, 'default_date_format', 'jS M, Y', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(110, 'default_currency', 'USD', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(111, 'default_language', 'en', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(112, 'active_storage', 'local', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(113, 'enable_maintenance_mode', '0', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(114, 'enable_frontend', '1', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(115, 'registration_with', 'email', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(116, 'registration_verification_with', 'disable', 1, 1, 1, 1, '2024-12-31 13:30:00', '2025-01-01 11:04:54', NULL),
(117, 'welcome_email', '0', 1, 1, 1, NULL, '2024-12-31 13:30:00', '2024-12-31 13:30:00', NULL),
(118, 'sd_api_key_use', 'main', 1, 1, 1, NULL, '2024-12-31 13:46:19', '2024-12-31 13:46:19', NULL),
(119, 'image_upscaler_engine', 'stable-diffusion-x4-latent-upscaler', 1, 1, 1, 1, '2024-12-31 13:46:19', '2025-01-01 14:10:27', NULL),
(120, 'image_stable_diffusion_engine', 'stable-diffusion-xl-1024-v0-9', 1, 1, 1, 1, '2024-12-31 13:46:19', '2025-01-01 14:10:34', NULL),
(121, 'SD_API_KEY', 'sk-ouwfZv16FoFXfVzxK7qCBUPS4KScqSL5DXaMKJq30PX47ySY', 1, 1, 1, NULL, '2024-12-31 13:46:19', '2024-12-31 13:46:19', NULL),
(122, 'affiliate_commission', '20', 1, 1, 1, 1, '2025-01-01 09:51:28', '2025-01-27 06:19:38', NULL),
(123, 'minimum_withdrawal_amount', '15', 1, 1, 1, 1, '2025-01-01 09:51:28', '2025-01-27 06:19:38', NULL),
(124, 'enable_affiliate_continuous_commission', '0', 1, 1, 1, 1, '2025-01-01 09:51:28', '2025-01-27 09:04:48', NULL),
(125, 'enable_affiliate_system', '1', 1, 1, 1, NULL, '2025-01-01 09:51:28', '2025-01-01 09:51:28', NULL),
(126, 'balance_carry_forward', '1', 1, 1, 1, 1, '2025-01-01 11:05:21', '2025-01-01 14:21:30', NULL),
(127, 'global_meta_title', 'How to Install WHMCS Template: Step-by-Step Guide', 1, 1, 1, NULL, '2025-01-01 11:11:40', '2025-01-01 11:11:40', NULL),
(128, 'global_meta_description', 'With worldwide annual spend on digital advertising surpassing $325 billion, it’s no surprise that differentia ache\'s to online marketing are becoming available. One of these new approaches is performance or digital performance marketing. Keep reading to learn all about performance marketing.', 1, 1, 1, NULL, '2025-01-01 11:11:40', '2025-01-01 11:11:40', NULL),
(129, 'global_meta_keywords', 'rom how it works toit compares to digital marketing. Plus, get insight into the benefits and risks of performance marketing and how it can affect your company’s long-term success and profitability. Performance marketing is an approach to digital Marketing or advertising where businesses only pay when a specific result occurs. This result could be a new lead, sale, or other outcome agreed upon by the advertiser and business. Performance marketing involves channels such as affiliate marketing, online advertising.', 1, 1, 1, NULL, '2025-01-01 11:11:40', '2025-01-01 11:11:40', NULL),
(130, 'global_meta_image', '/tmp/phpeC4XEQ', 1, 1, 1, 1, '2025-01-01 11:11:40', '2025-01-01 11:12:42', NULL),
(131, 'cookie_consent_text', 'We may allow third-party service providers, such as analytics providers (e.g., Google Analytics) or advertisers, to place cookies on your device. These third parties may use the information collected through cookies in accordance with their own privacy policies.', 1, 1, 1, 1, '2025-01-01 11:12:53', '2025-01-01 11:22:03', NULL),
(132, 'enable_cookie_consent', '1', 1, 1, 1, NULL, '2025-01-01 11:12:53', '2025-01-01 11:12:53', NULL),
(133, 'enable_auto_blog_post', '1', 1, 1, 1, NULL, '2025-01-01 11:24:31', '2025-01-01 11:24:31', NULL),
(134, 'feature_document_1_btn_text', 'Try It Now', 1, 1, 1, 1, '2025-01-01 12:38:26', '2025-01-01 12:39:50', NULL),
(135, 'feature_document_1_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-01 12:38:26', '2025-01-28 07:06:08', NULL),
(136, 'feature_document_1_btn_text_2', 'Explore More', 1, 1, 1, 1, '2025-01-01 12:38:26', '2025-01-01 12:39:50', NULL),
(137, 'feature_document_1_btn_link_2', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-01 12:38:26', '2025-01-28 07:06:08', NULL),
(138, 'feature_document_2_sub_title', 'AI-powered translation tools Save per day on ad management', 1, 1, 1, 1, '2025-01-01 12:45:16', '2025-01-26 12:28:41', NULL),
(139, 'feature_document_2_short_title', 'Enter Your Image Prompt', 1, 1, 1, 1, '2025-01-01 12:45:16', '2025-01-26 12:29:17', NULL),
(140, 'feature_document_2_btn_text', 'Explore More', 1, 1, 1, 1, '2025-01-01 12:45:16', '2025-01-26 12:30:06', NULL),
(141, 'feature_document_2_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-01 12:45:16', '2025-01-28 07:06:14', NULL),
(142, 'feature_document_3_btn_text', 'Explore More', 1, 1, 1, 1, '2025-01-01 12:46:53', '2025-01-01 12:47:21', NULL),
(143, 'feature_document_3_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-01 12:46:53', '2025-01-28 07:06:20', NULL),
(144, 'feature_document_4_btn_text', 'Explore More', 1, 1, 1, 1, '2025-01-01 12:47:45', '2025-01-01 12:48:17', NULL),
(145, 'feature_document_4_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-01 12:47:45', '2025-01-28 07:06:25', NULL),
(146, 'brand_logo_is_active', '1', 1, 1, 1, 1, '2025-01-01 12:53:44', '2025-01-01 12:54:16', NULL),
(147, 'feature_tool_1_title', 'Multilingual Languages', 1, 1, 1, 1, '2025-01-01 13:04:55', '2025-01-27 11:28:50', NULL),
(148, 'feature_tool_1_short_description', 'AI-powered translation tools Save per day on ad management', 1, 1, 1, 1, '2025-01-01 13:04:55', '2025-01-26 12:50:03', NULL),
(149, 'feature_tool_1_image', '192', 1, 1, 1, 1, '2025-01-01 13:04:55', '2025-01-26 12:50:03', NULL),
(150, 'feature_tool_1_is_active', '1', 1, 1, 1, NULL, '2025-01-01 13:04:55', '2025-01-01 13:04:55', NULL),
(151, 'privacyPolicy', '<h2>Privacy Policy</h2>\n<p><strong>Effective Date:</strong> [Insert Date]</p>\n<p>[Your Website Name] (\"we,\" \"our,\" or \"us\") respects your privacy and is committed to protecting it through this Privacy Policy. This document explains how we collect, use, and safeguard your information when you visit our website [Website URL] (the \"Website\").</p>\n<h3>1. Information We Collect</h3>\n<p>We may collect the following types of information:</p>\n<h4>a. Personal Information</h4>\n<p>Information you provide directly to us, such as:</p>\n<ul>\n<li>Name</li>\n<li>Email address</li>\n<li>Phone number</li>\n<li>Payment information (if applicable)</li>\n</ul>\n<h4>b. Non-Personal Information</h4>\n<p>Automatically collected information, such as:</p>\n<ul>\n<li>IP address</li>\n<li>Browser type</li>\n<li>Operating system</li>\n<li>Pages visited on our website</li>\n<li>Time and date of visit</li>\n</ul>\n<h3>2. How We Use Your Information</h3>\n<p>We use the information collected for purposes including but not limited to:</p>\n<ul>\n<li>Providing and improving our services</li>\n<li>Responding to inquiries or support requests</li>\n<li>Personalizing your experience on the Website</li>\n<li>Processing transactions</li>\n<li>Sending promotional or informational communications (you can opt out at any time)</li>\n</ul>\n<h3>3. How We Share Your Information</h3>\n<p>We do not sell, trade, or rent your personal information to others. However, we may share your information with:</p>\n<ul>\n<li>Service providers who assist in our business operations</li>\n<li>Legal authorities if required by law</li>\n<li>Affiliates for business purposes</li>\n</ul>\n<h3>4. Cookies and Tracking Technologies</h3>\n<p>We use cookies and similar tracking technologies to enhance your experience on our Website. You can control cookie settings through your browser preferences.</p>\n<h3>5. Data Security</h3>\n<p>We implement industry-standard security measures to protect your data from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is completely secure.</p>\n<h3>6. Third-Party Links</h3>\n<p>Our Website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites.</p>\n<h3>7. Your Privacy Rights</h3>\n<p>Depending on your location, you may have rights regarding your personal information, including:</p>\n<ul>\n<li>Accessing the data we hold about you</li>\n<li>Requesting corrections to your data</li>\n<li>Requesting deletion of your data</li>\n</ul>\n<p>To exercise these rights, please contact us at [Contact Email].</p>\n<h3>8. Changes to This Privacy Policy</h3>\n<p>We reserve the right to update this Privacy Policy at any time. Any changes will be effective immediately upon posting the revised policy on this page.</p>\n<h3>9. Contact Us</h3>\n<p>If you have any questions about this Privacy Policy or our practices, please contact us:</p>\n<ul>\n<li>Email: [Your Email Address]</li>\n<li>Address: [Your Physical Address]</li>\n</ul>\n<p>Thank you for trusting [Your Website Name].</p>', 1, 1, 1, NULL, '2025-01-01 13:27:59', '2025-01-01 13:27:59', NULL),
(152, 'termsConditions', '<h2>Privacy Policy</h2>\n<p><strong>Effective Date:</strong> [Insert Date]</p>\n<p>[Your Website Name] (\"we,\" \"our,\" or \"us\") respects your privacy and is committed to protecting it through this Privacy Policy. This document explains how we collect, use, and safeguard your information when you visit our website [Website URL] (the \"Website\").</p>\n<h3>1. Information We Collect</h3>\n<p>We may collect the following types of information:</p>\n<h4>a. Personal Information</h4>\n<p>Information you provide directly to us, such as:</p>\n<ul>\n<li>Name</li>\n<li>Email address</li>\n<li>Phone number</li>\n<li>Payment information (if applicable)</li>\n</ul>\n<h4>b. Non-Personal Information</h4>\n<p>Automatically collected information, such as:</p>\n<ul>\n<li>IP address</li>\n<li>Browser type</li>\n<li>Operating system</li>\n<li>Pages visited on our website</li>\n<li>Time and date of visit</li>\n</ul>\n<h3>2. How We Use Your Information</h3>\n<p>We use the information collected for purposes including but not limited to:</p>\n<ul>\n<li>Providing and improving our services</li>\n<li>Responding to inquiries or support requests</li>\n<li>Personalizing your experience on the Website</li>\n<li>Processing transactions</li>\n<li>Sending promotional or informational communications (you can opt out at any time)</li>\n</ul>\n<h3>3. How We Share Your Information</h3>\n<p>We do not sell, trade, or rent your personal information to others. However, we may share your information with:</p>\n<ul>\n<li>Service providers who assist in our business operations</li>\n<li>Legal authorities if required by law</li>\n<li>Affiliates for business purposes</li>\n</ul>\n<h3>4. Cookies and Tracking Technologies</h3>\n<p>We use cookies and similar tracking technologies to enhance your experience on our Website. You can control cookie settings through your browser preferences.</p>\n<h3>5. Data Security</h3>\n<p>We implement industry-standard security measures to protect your data from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is completely secure.</p>\n<h3>6. Third-Party Links</h3>\n<p>Our Website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites.</p>\n<h3>7. Your Privacy Rights</h3>\n<p>Depending on your location, you may have rights regarding your personal information, including:</p>\n<ul>\n<li>Accessing the data we hold about you</li>\n<li>Requesting corrections to your data</li>\n<li>Requesting deletion of your data</li>\n</ul>\n<p>To exercise these rights, please contact us at [Contact Email].</p>\n<h3>8. Changes to This Privacy Policy</h3>\n<p>We reserve the right to update this Privacy Policy at any time. Any changes will be effective immediately upon posting the revised policy on this page.</p>\n<h3>9. Contact Us</h3>\n<p>If you have any questions about this Privacy Policy or our practices, please contact us:</p>\n<ul>\n<li>Email: [Your Email Address]</li>\n<li>Address: [Your Physical Address]</li>\n</ul>\n<p>Thank you for trusting [Your Website Name].</p>', 1, 1, 1, 1, '2025-01-01 13:29:21', '2025-01-01 13:53:26', NULL),
(153, 'MAIL_HOST', NULL, 1, 1, 1, 1, '2025-01-01 14:07:58', '2025-01-01 14:08:16', NULL),
(154, 'MAIL_PORT', NULL, 1, 1, 1, NULL, '2025-01-01 14:07:58', '2025-01-01 14:07:58', NULL),
(155, 'MAIL_USERNAME', NULL, 1, 1, 1, NULL, '2025-01-01 14:07:58', '2025-01-01 14:07:58', NULL),
(156, 'MAIL_PASSWORD', NULL, 1, 1, 1, NULL, '2025-01-01 14:07:58', '2025-01-01 14:07:58', NULL),
(157, 'MAIL_ENCRYPTION', NULL, 1, 1, 1, NULL, '2025-01-01 14:07:58', '2025-01-01 14:07:58', NULL),
(158, 'MAIL_FROM_ADDRESS', NULL, 1, 1, 1, NULL, '2025-01-01 14:07:58', '2025-01-01 14:07:58', NULL),
(159, 'MAIL_FROM_NAME', NULL, 1, 1, 1, NULL, '2025-01-01 14:07:58', '2025-01-01 14:07:58', NULL),
(160, 'MAIL_MAILER', 'smtp', 1, 1, 1, 1, '2025-01-01 14:07:58', '2025-01-06 09:22:21', NULL),
(161, 'is_active', '0', 1, 1, 1, 1, '2025-01-01 14:07:58', '2025-01-01 14:10:07', NULL),
(162, 'GEMINIAI_SECRET_KEY', 'AIzaSyBmRRDtr9i9v31gMqg5Trr4mTZiqYyPdXY', 1, 1, 1, 1, '2025-01-01 14:08:54', '2025-01-07 09:52:10', NULL),
(163, 'serper_api_key', 'de59ed6f88369b8e31930ac1d1ba966ff58b9b1a', 1, 1, 1, 1, '2025-01-01 14:10:43', '2025-01-07 08:00:13', NULL),
(164, 'enable_serper', '1', 1, 1, 1, 1, '2025-01-01 14:10:43', '2025-01-07 07:57:21', NULL),
(165, 'plagiarism_api_key', 'q5sebgBYLtAZg3GbiOnyQwU7PdtI1u6kDeKidfsMbe8608a5', 1, 1, 1, 1, '2025-01-01 14:10:54', '2025-01-07 09:50:16', NULL),
(166, 'enable_plagiarism', '1', 1, 1, 1, 1, '2025-01-01 14:10:54', '2025-01-07 09:50:22', NULL),
(167, 'new_package_purchase', '1', 1, 1, 1, 1, '2025-01-01 14:21:41', '2025-01-01 14:22:05', NULL),
(168, 'auto_subscription_active', '1', 1, 1, 1, NULL, '2025-01-01 14:22:06', '2025-01-01 14:22:06', NULL),
(169, 'auto_subscription_deactive', '1', 1, 1, 1, NULL, '2025-01-01 14:22:07', '2025-01-01 14:22:07', NULL),
(170, 'affiliate_payout_payment_methods', '[\"stripe\",\"offline\"]', 1, 1, 1, 1, '2025-01-06 06:40:07', '2025-01-27 09:04:55', NULL),
(171, 'ai_chat_engine', 'openai', 1, 1, 1, 1, '2025-01-07 09:55:40', '2025-01-07 13:57:06', NULL),
(172, 'ai_rewriter_engine', 'openai', 1, 1, 1, 1, '2025-01-07 09:55:44', '2025-01-28 06:52:19', NULL),
(173, 'templates_engine', 'openai', 1, 1, 1, 1, '2025-01-07 09:55:45', '2025-01-28 06:52:17', NULL),
(174, 'ai_blog_wizard_engine', 'openai', 1, 1, 1, 1, '2025-01-07 09:55:47', '2025-01-28 06:52:12', NULL),
(175, 'generate_code_engine', 'openai', 1, 1, 1, 1, '2025-01-07 09:55:48', '2025-01-28 06:52:15', NULL),
(176, 'api_avatar_pro_api_key', 'OTAwY2E2NTlhYjM3NGZmNTk3MTQ3MmM1ZWU1M2ZjMWMtMTczNjYwNDI0Nw==', 1, 1, 1, NULL, '2025-01-11 14:06:08', '2025-01-11 14:06:08', NULL),
(177, 'enable_ai_avatar_pro', '1', 1, 1, 1, NULL, '2025-01-11 14:06:08', '2025-01-11 14:06:08', NULL),
(178, 'enable_seo_content_optimization', '1', 1, 1, 1, NULL, '2025-01-25 15:17:03', '2025-01-25 15:17:03', NULL),
(179, 'enable_helpful_content_analysis', '1', 1, 1, 1, NULL, '2025-01-25 15:17:16', '2025-01-25 15:17:16', NULL),
(180, 'enable_seo_keywords', '1', 1, 1, 1, NULL, '2025-01-25 15:17:17', '2025-01-25 15:17:17', NULL),
(181, 'enable_ai_writer', '1', 1, 1, 1, NULL, '2025-01-26 08:36:26', '2025-01-26 08:36:26', NULL),
(182, 'ai_writer_engine', 'openai', 1, 1, 1, 1, '2025-01-26 08:36:29', '2025-01-28 06:52:21', NULL),
(183, 'hero_build_ai_btn_text', 'Build AI', 1, 1, 1, 1, '2025-01-26 11:30:34', '2025-01-27 05:01:40', NULL),
(184, 'hero_build_ai_btn_link', 'https://restros.themetags.net/register', 1, 1, 1, 1, '2025-01-26 11:30:34', '2025-01-28 07:05:52', NULL),
(185, 'brand_text_without_color', 'Making the cloud effortless for', 1, 1, 1, NULL, '2025-01-26 12:18:57', '2025-01-26 12:18:57', NULL),
(186, 'brand_text_with_color', 'thousands of Companies', 1, 1, 1, NULL, '2025-01-26 12:18:57', '2025-01-26 12:18:57', NULL),
(187, 'feature_document_5_title', 'AI Speech to Text', 1, 1, 1, NULL, '2025-01-26 12:35:42', '2025-01-26 12:35:42', NULL),
(188, 'feature_document_5_short_description', '\"Convert spoken words into text effortlessly with AI technology.', 1, 1, 1, NULL, '2025-01-26 12:35:42', '2025-01-26 12:35:42', NULL),
(189, 'feature_document_5_btn_text', 'Explore More', 1, 1, 1, NULL, '2025-01-26 12:35:42', '2025-01-26 12:35:42', NULL),
(190, 'feature_document_5_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-26 12:35:42', '2025-01-28 07:06:29', NULL),
(191, 'feature_document_5_image', '189', 1, 1, 1, NULL, '2025-01-26 12:35:42', '2025-01-26 12:35:42', NULL),
(192, 'feature_document_6_title', 'AI Writer Tempate', 1, 1, 1, NULL, '2025-01-26 12:36:49', '2025-01-26 12:36:49', NULL),
(193, 'feature_document_6_short_description', '\"Craft compelling content quickly using AI-powered writing templates.\"', 1, 1, 1, NULL, '2025-01-26 12:36:49', '2025-01-26 12:36:49', NULL),
(194, 'feature_document_6_btn_text', 'Explore More', 1, 1, 1, NULL, '2025-01-26 12:36:49', '2025-01-26 12:36:49', NULL),
(195, 'feature_document_6_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-26 12:36:49', '2025-01-28 07:06:32', NULL),
(196, 'feature_document_6_image', '190', 1, 1, 1, NULL, '2025-01-26 12:36:49', '2025-01-26 12:36:49', NULL),
(197, 'feature_document_7_title', 'Integration with Wordpress', 1, 1, 1, 1, '2025-01-26 12:37:49', '2025-01-28 05:28:05', NULL),
(198, 'feature_document_7_short_description', '\"Edit videos seamlessly with AI-driven smart editing technology.\"', 1, 1, 1, NULL, '2025-01-26 12:37:49', '2025-01-26 12:37:49', NULL),
(199, 'feature_document_7_btn_text', 'Explore More', 1, 1, 1, NULL, '2025-01-26 12:37:49', '2025-01-26 12:37:49', NULL),
(200, 'feature_document_7_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, 1, '2025-01-26 12:37:49', '2025-01-28 07:06:48', NULL),
(201, 'feature_document_7_image', '209', 1, 1, 1, 1, '2025-01-26 12:37:49', '2025-01-27 10:02:26', NULL),
(202, 'feature_tool_2_title', 'Affiliate System', 1, 1, 1, NULL, '2025-01-26 12:50:52', '2025-01-26 12:50:52', NULL),
(203, 'feature_tool_2_short_description', 'Ability to invite friends, and earn from their first purchase.', 1, 1, 1, NULL, '2025-01-26 12:50:52', '2025-01-26 12:50:52', NULL),
(204, 'feature_tool_2_image', '193', 1, 1, 1, NULL, '2025-01-26 12:50:52', '2025-01-26 12:50:52', NULL),
(205, 'feature_tool_2_is_active', '1', 1, 1, 1, NULL, '2025-01-26 12:50:52', '2025-01-26 12:50:52', NULL),
(206, 'feature_tool_3_title', 'Easy Export', 1, 1, 1, NULL, '2025-01-26 12:52:18', '2025-01-26 12:52:18', NULL),
(207, 'feature_tool_3_short_description', 'Export generated content as plain text, PDF, Word or HTML easily.', 1, 1, 1, NULL, '2025-01-26 12:52:18', '2025-01-26 12:52:18', NULL),
(208, 'feature_tool_3_image', '194', 1, 1, 1, NULL, '2025-01-26 12:52:18', '2025-01-26 12:52:18', NULL),
(209, 'feature_tool_3_is_active', '1', 1, 1, 1, NULL, '2025-01-26 12:52:18', '2025-01-26 12:52:18', NULL),
(210, 'feature_tool_4_title', 'Payment Gateway', 1, 1, 1, 1, '2025-01-26 12:53:05', '2025-01-27 11:30:06', NULL),
(211, 'feature_tool_4_short_description', 'AI-powered translation tools Save per day on ad Management', 1, 1, 1, NULL, '2025-01-26 12:53:05', '2025-01-26 12:53:05', NULL),
(212, 'feature_tool_4_image', '195', 1, 1, 1, NULL, '2025-01-26 12:53:05', '2025-01-26 12:53:05', NULL),
(213, 'feature_tool_4_is_active', '1', 1, 1, 1, NULL, '2025-01-26 12:53:05', '2025-01-26 12:53:05', NULL),
(214, 'feature_tool_5_title', 'Support Platform', 1, 1, 1, NULL, '2025-01-26 12:53:50', '2025-01-26 12:53:50', NULL),
(215, 'feature_tool_5_short_description', 'AI-powered translation tools Save per day on ad Management', 1, 1, 1, NULL, '2025-01-26 12:53:50', '2025-01-26 12:53:50', NULL),
(216, 'feature_tool_5_image', '196', 1, 1, 1, NULL, '2025-01-26 12:53:50', '2025-01-26 12:53:50', NULL),
(217, 'feature_tool_5_is_active', '1', 1, 1, 1, NULL, '2025-01-26 12:53:50', '2025-01-26 12:53:50', NULL),
(218, 'facebook_link', 'http://facebook.com/themetags', 1, 1, 1, NULL, '2025-01-26 15:50:14', '2025-01-26 15:50:14', NULL),
(219, 'twitter_link', 'http://twitter.com/themetags', 1, 1, 1, NULL, '2025-01-26 15:50:14', '2025-01-26 15:50:14', NULL),
(220, 'instagram_link', 'http://instagram.com/themetags', 1, 1, 1, NULL, '2025-01-26 15:50:14', '2025-01-26 15:50:14', NULL),
(221, 'linkedin_link', 'http://linkedin.com/themetags', 1, 1, 1, NULL, '2025-01-26 15:50:14', '2025-01-26 15:50:14', NULL),
(222, 'ai_journey_top_logo_image', '199', 1, 1, 1, NULL, '2025-01-26 15:51:04', '2025-01-26 15:51:04', NULL),
(223, 'ai_journey_book_a_demo_btn_text', 'Book a Demo', 1, 1, 1, NULL, '2025-01-26 15:51:04', '2025-01-26 15:51:04', NULL),
(224, 'ai_journey_book_a_demo_btn_link', 'https://restros.themetags.net/login', 1, 1, 1, NULL, '2025-01-26 15:51:04', '2025-01-26 15:51:04', NULL),
(225, 'ai_journey_is_active', '1', 1, 1, 1, NULL, '2025-01-26 15:51:04', '2025-01-26 15:51:04', NULL),
(226, 'integration_top_logo_image', '199', 1, 1, 1, NULL, '2025-01-26 15:51:56', '2025-01-26 15:51:56', NULL),
(227, 'integration_middle_logo_image', '200', 1, 1, 1, NULL, '2025-01-26 15:51:56', '2025-01-26 15:51:56', NULL),
(228, 'integration_middle_mask_image', '201', 1, 1, 1, NULL, '2025-01-26 15:51:56', '2025-01-26 15:51:56', NULL),
(229, 'integration_platform_image', '202', 1, 1, 1, NULL, '2025-01-26 15:51:56', '2025-01-26 15:51:56', NULL),
(230, 'integration_is_active', '1', 1, 1, 1, NULL, '2025-01-26 15:51:56', '2025-01-26 15:51:56', NULL),
(231, 'feature_1_svg_code', '<svg width=\"54\" height=\"55\" viewBox=\"0 0 54 55\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                     <rect y=\"0.271973\" width=\"54\" height=\"54\" rx=\"10\" fill=\"white\" fill-opacity=\"0.05\"></rect>                                     <path d=\"M17.0833 21.6053C23.0154 25.8426 30.9844 25.8426 36.9166 21.6053V35.772C30.7717 39.2834 23.2281 39.2834 17.0833 35.772V21.6053Z\" fill=\"white\"></path>                                     <path d=\"M26.9999 24.4386C32.4767 24.4386 36.9166 22.5358 36.9166 20.1886C36.9166 17.8414 32.4767 15.9386 26.9999 15.9386C21.5231 15.9386 17.0833 17.8414 17.0833 20.1886C17.0833 22.5358 21.5231 24.4386 26.9999 24.4386Z\" stroke=\"url(#paint0_linear_1860_2905)\" stroke-width=\"1.7\"></path>                                     <path d=\"M17.0833 28.6886C17.0833 28.6886 17.0833 32.008 17.0833 34.3553C17.0833 36.7025 21.5231 38.6053 26.9999 38.6053C32.4768 38.6053 36.9166 36.7025 36.9166 34.3553C36.9166 33.1837 36.9166 28.6886 36.9166 28.6886\" stroke=\"url(#paint1_linear_1860_2905)\" stroke-width=\"1.7\" stroke-linecap=\"square\"></path>                                     <path d=\"M17.0833 20.1886C17.0833 20.1886 17.0833 24.9247 17.0833 27.2719C17.0833 29.6192 21.5231 31.5219 26.9999 31.5219C32.4768 31.5219 36.9166 29.6192 36.9166 27.2719C36.9166 26.1003 36.9166 20.1886 36.9166 20.1886\" stroke=\"url(#paint2_linear_1860_2905)\" stroke-width=\"1.7\"></path>                                     <defs>                                     <linearGradient id=\"paint0_linear_1860_2905\" x1=\"17.0833\" y1=\"20.1886\" x2=\"36.9166\" y2=\"20.1886\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     <linearGradient id=\"paint1_linear_1860_2905\" x1=\"17.0833\" y1=\"33.6469\" x2=\"36.9166\" y2=\"33.6469\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     <linearGradient id=\"paint2_linear_1860_2905\" x1=\"17.0833\" y1=\"25.8553\" x2=\"36.9166\" y2=\"25.8553\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     </defs>                                 </svg>', 1, 1, 1, 1, '2025-01-27 05:06:07', '2025-01-27 05:06:35', NULL),
(232, 'feature_2_svg_code', '<svg width=\"49\" height=\"49\" viewBox=\"0 0 49 49\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                     <rect x=\"0.333252\" y=\"0.271973\" width=\"48\" height=\"48\" rx=\"8.88889\" fill=\"white\" fill-opacity=\"0.05\"></rect>                                     <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M16.7341 28.2634C16.0388 28.4497 15.6912 28.5428 15.5783 28.8486C15.4654 29.1542 15.6526 29.4271 16.0271 29.9727C16.426 30.554 16.8866 31.0945 17.4032 31.5841C18.8163 32.9234 20.5873 33.8247 22.5019 34.1785C24.4165 34.5325 26.3925 34.3241 28.1911 33.5785C29.9897 32.8329 31.5337 31.5821 32.6363 29.9773C33.7389 28.3726 34.3529 26.4827 34.4039 24.5364C34.4549 22.5901 33.9408 20.6706 32.9238 19.0103C31.9068 17.35 30.4305 16.02 28.6734 15.1812C27.5514 14.6455 26.3456 14.3248 25.1178 14.2289C24.4579 14.1774 24.128 14.1516 23.9197 14.4022C23.7114 14.6529 23.8046 15.0005 23.9909 15.6958L26.06 23.4179L26.0632 23.4298C26.0788 23.4865 26.1314 23.6776 26.1558 23.8673C26.1895 24.1285 26.2104 24.6417 25.9013 25.177C25.5923 25.7124 25.1373 25.9509 24.8944 26.0523C24.7178 26.126 24.5261 26.1761 24.4691 26.1909L24.4573 26.194L16.7341 28.2634Z\" fill=\"url(#paint0_linear_1860_2787)\"></path>                                     <path d=\"M21.3998 13.3248C21.2435 12.7414 21.1653 12.4497 20.9166 12.3223C20.6679 12.1948 20.4039 12.2948 19.8758 12.4946C18.7268 12.9295 17.6454 13.531 16.6672 14.2816C15.3552 15.2883 14.2544 16.5436 13.4276 17.9757C12.6007 19.4078 12.0641 20.9888 11.8482 22.6283C11.6873 23.8509 11.707 25.0881 11.905 26.3005C11.9959 26.8579 12.0414 27.1364 12.2761 27.2882C12.5108 27.4398 12.8025 27.3616 13.3859 27.2053L23.1168 24.5979C23.6901 24.4442 23.9768 24.3674 24.1072 24.1415C24.2376 23.9157 24.1608 23.629 24.0072 23.0557L21.3998 13.3248Z\" fill=\"white\"></path>                                     <defs>                                     <linearGradient id=\"paint0_linear_1860_2787\" x1=\"15.5457\" y1=\"24.2707\" x2=\"34.4074\" y2=\"24.2707\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     </defs>                                 </svg>', 1, 1, 1, NULL, '2025-01-27 05:10:38', '2025-01-27 05:10:38', NULL),
(233, 'feature_3_svg_code', '<svg width=\"49\" height=\"49\" viewBox=\"0 0 49 49\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                     <rect x=\"0.666504\" y=\"0.271973\" width=\"48\" height=\"48\" rx=\"8.88889\" fill=\"white\" fill-opacity=\"0.05\"></rect>                                     <path d=\"M13.333 21.7534C13.333 18.1917 13.333 16.4108 14.4395 15.3044C15.546 14.1979 17.3268 14.1979 20.8886 14.1979H28.4441C32.0058 14.1979 33.7867 14.1979 34.8932 15.3044C35.9997 16.4108 35.9997 18.1917 35.9997 21.7534V23.8942C35.9997 24.0722 35.9997 24.1613 35.9444 24.2167C35.889 24.272 35.8 24.2719 35.6219 24.2719H30.333C29.7478 24.2719 29.4553 24.2719 29.212 24.3203C28.2129 24.519 27.4319 25.3 27.2332 26.2991C27.1849 26.5424 27.1849 26.8349 27.1849 27.4201C27.1849 28.0053 27.1849 28.2978 27.2332 28.5411C27.4319 29.5402 28.2129 30.3212 29.212 30.5199C29.4553 30.5682 29.7478 30.5682 30.333 30.5682H35.8197C35.9191 30.5682 35.9997 30.6488 35.9997 30.7482C35.9997 32.7352 34.3888 34.346 32.4018 34.346H20.8886C17.3268 34.346 15.546 34.346 14.4395 33.2395C13.333 32.133 13.333 30.3522 13.333 26.7905V21.7534Z\" fill=\"url(#paint0_linear_1860_2795)\"></path>                                     <path d=\"M27.1848 26.7905C27.1848 25.3995 28.3124 24.272 29.7033 24.272H35.8107C35.915 24.272 35.9996 24.3566 35.9996 24.4609V30.3794C35.9996 30.4836 35.915 30.5683 35.8107 30.5683H29.7033C28.3124 30.5683 27.1848 29.4407 27.1848 28.0498V26.7905Z\" fill=\"white\" fill-opacity=\"0.9\"></path>                                     <path d=\"M24.0368 17.9756H17.7405C17.3927 17.9756 17.1108 18.2575 17.1108 18.6052C17.1108 18.953 17.3927 19.2348 17.7405 19.2348H24.0368C24.3845 19.2348 24.6664 18.953 24.6664 18.6052C24.6664 18.2575 24.3845 17.9756 24.0368 17.9756Z\" fill=\"white\" fill-opacity=\"0.9\"></path>                                     <defs>                                     <linearGradient id=\"paint0_linear_1860_2795\" x1=\"13.333\" y1=\"24.2719\" x2=\"35.9997\" y2=\"24.2719\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     </defs>                                 </svg>', 1, 1, 1, NULL, '2025-01-27 05:12:27', '2025-01-27 05:12:27', NULL),
(234, 'feature_4_svg_code', '<svg width=\"54\" height=\"55\" viewBox=\"0 0 54 55\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                     <rect y=\"0.271973\" width=\"54\" height=\"54\" rx=\"10\" fill=\"white\" fill-opacity=\"0.05\"></rect>                                     <path d=\"M31.25 18.772C31.25 16.4248 29.3472 14.522 27 14.522C24.6528 14.522 22.75 16.4248 22.75 18.772V25.8553C22.75 28.2025 24.6528 30.1053 27 30.1053C29.3472 30.1053 31.25 28.2025 31.25 25.8553V18.772Z\" fill=\"white\" stroke=\"url(#paint0_linear_1860_2800)\" stroke-width=\"1.7\" stroke-linejoin=\"round\"></path>                                     <path d=\"M17.6499 25.8553C17.6499 28.335 18.635 30.7133 20.3885 32.4667C22.1419 34.2201 24.5202 35.2053 26.9999 35.2053C29.4796 35.2053 31.8579 34.2201 33.6113 32.4667C35.3648 30.7133 36.3499 28.335 36.3499 25.8553\" stroke=\"url(#paint1_linear_1860_2800)\" stroke-width=\"1.7\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>                                     <path d=\"M27 40.022V37.1887\" stroke=\"url(#paint2_linear_1860_2800)\" stroke-width=\"1.7\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>                                     <defs>                                     <linearGradient id=\"paint0_linear_1860_2800\" x1=\"22.75\" y1=\"22.3136\" x2=\"31.25\" y2=\"22.3136\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     <linearGradient id=\"paint1_linear_1860_2800\" x1=\"17.6499\" y1=\"30.5303\" x2=\"36.3499\" y2=\"30.5303\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     <linearGradient id=\"paint2_linear_1860_2800\" x1=\"27\" y1=\"38.6053\" x2=\"28\" y2=\"38.6053\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     </defs>                                 </svg>', 1, 1, 1, NULL, '2025-01-27 05:13:23', '2025-01-27 05:13:23', NULL),
(235, 'feature_5_svg_code', '<svg width=\"54\" height=\"55\" viewBox=\"0 0 54 55\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                     <rect y=\"0.271973\" width=\"54\" height=\"54\" rx=\"10\" fill=\"white\" fill-opacity=\"0.05\"></rect>                                     <path d=\"M17.0833 17.3553C17.0833 15.7905 18.3518 14.522 19.9166 14.522H26.6458C26.8414 14.522 26.9999 14.6805 26.9999 14.8761V21.6053C26.9999 23.1701 28.2684 24.4386 29.8333 24.4386H36.5624C36.7581 24.4386 36.9166 24.5972 36.9166 24.7928V37.1886C36.9166 38.7535 35.6481 40.022 34.0833 40.022H19.9166C18.3518 40.022 17.0833 38.7535 17.0833 37.1886V17.3553Z\" fill=\"url(#paint0_linear_1860_2805)\"></path>                                     <path d=\"M28.4167 21.6053V15.377C28.4167 15.0614 28.7983 14.9034 29.0214 15.1265L36.3121 22.4173C36.5352 22.6404 36.3773 23.0219 36.0616 23.0219H29.8334C29.051 23.0219 28.4167 22.3877 28.4167 21.6053Z\" fill=\"white\" fill-opacity=\"0.9\"></path>                                     <path d=\"M27 26.5637V35.0637\" stroke=\"white\" stroke-width=\"1.41667\" stroke-linecap=\"round\"></path>                                     <path d=\"M22.75 30.8137H31.25\" stroke=\"white\" stroke-width=\"1.41667\" stroke-linecap=\"round\"></path>                                     <defs>                                     <linearGradient id=\"paint0_linear_1860_2805\" x1=\"17.0833\" y1=\"27.272\" x2=\"36.9166\" y2=\"27.272\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     </defs>                                 </svg>', 1, 1, 1, NULL, '2025-01-27 05:14:16', '2025-01-27 05:14:16', NULL);
INSERT INTO `system_settings` (`id`, `entity`, `value`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(236, 'feature_6_svg_code', '<svg width=\"54\" height=\"55\" viewBox=\"0 0 54 55\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                     <rect y=\"0.271973\" width=\"54\" height=\"54\" rx=\"10\" fill=\"white\" fill-opacity=\"0.05\"></rect>                                     <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M30.0261 15.0341C29.9647 14.4197 29.934 14.1125 29.8103 13.8726C29.6531 13.568 29.3908 13.3306 29.0721 13.2046C28.821 13.1053 28.5124 13.1053 27.895 13.1053H26.1047C25.4875 13.1053 25.1788 13.1053 24.9279 13.2045C24.609 13.3306 24.3466 13.568 24.1895 13.8728C24.0659 14.1126 24.0351 14.4197 23.9737 15.0339C23.8575 16.1964 23.7993 16.7777 23.5561 17.0967C23.2474 17.5015 22.7451 17.7096 22.2405 17.6416C21.843 17.5881 21.3908 17.2181 20.4864 16.4781C20.0084 16.087 19.7694 15.8915 19.5123 15.8094C19.1858 15.7051 18.8325 15.7227 18.518 15.859C18.2703 15.9663 18.052 16.1846 17.6154 16.6212L16.3499 17.8867C15.9131 18.3235 15.6947 18.5419 15.5874 18.7896C15.4513 19.1041 15.4336 19.4572 15.5379 19.7836C15.62 20.0408 15.8156 20.2798 16.2067 20.7579C16.947 21.6628 17.3172 22.1152 17.3707 22.5129C17.4384 23.0173 17.2305 23.5192 16.826 23.8278C16.5069 24.0713 15.9253 24.1295 14.7621 24.2458C14.1476 24.3072 13.8403 24.338 13.6004 24.4618C13.2959 24.6189 13.0586 24.8811 12.9325 25.1997C12.8333 25.4507 12.8333 25.7596 12.8333 26.3771V28.1671C12.8333 28.7844 12.8333 29.0931 12.9325 29.3442C13.0585 29.6629 13.2959 29.9251 13.6005 30.0824C13.8404 30.2061 14.1476 30.2368 14.7619 30.2982C15.9248 30.4145 16.5063 30.4727 16.8253 30.7161C17.23 31.0248 17.4379 31.5268 17.3701 32.0312C17.3166 32.429 16.9466 32.8812 16.2065 33.7857C15.8155 34.2635 15.62 34.5025 15.5379 34.7597C15.4335 35.0862 15.4512 35.4394 15.5875 35.754C15.6947 36.0017 15.9131 36.22 16.3497 36.6564L17.6154 37.9222C18.052 38.3588 18.2703 38.5772 18.5179 38.6844C18.8325 38.8207 19.1857 38.8384 19.5122 38.734C19.7694 38.652 20.0083 38.4565 20.4862 38.0655C21.3908 37.3252 21.843 36.9552 22.2407 36.9018C22.7451 36.8339 23.2472 37.0419 23.5559 37.4465C23.7993 37.7655 23.8574 38.3469 23.9737 39.5099C24.0351 40.1243 24.0659 40.4316 24.1895 40.6714C24.3468 40.976 24.609 41.2134 24.9278 41.3394C25.1788 41.4387 25.4875 41.4387 26.1049 41.4387H27.8947C28.5124 41.4387 28.8212 41.4387 29.0722 41.3394C29.3908 41.2133 29.6531 40.9761 29.8102 40.6716C29.934 40.4316 29.9647 40.1243 30.0262 39.5096C30.1425 38.3465 30.2006 37.765 30.444 37.4459C30.7527 37.0413 31.2547 36.8334 31.7592 36.9012C32.1569 36.9546 32.6091 37.3247 33.5136 38.0647C33.9915 38.4557 34.2304 38.6512 34.4876 38.7334C34.8141 38.8377 35.1673 38.8201 35.4819 38.6838C35.7296 38.5764 35.9479 38.3581 36.3843 37.9217L37.6503 36.6557C38.0868 36.2193 38.3049 36.0011 38.4123 35.7535C38.5486 35.4388 38.5663 35.0855 38.4619 34.7588C38.3797 34.5018 38.1844 34.263 37.7935 33.7853C37.0537 32.881 36.6838 32.429 36.6303 32.0314C36.5623 31.5268 36.7702 31.0246 37.1751 30.7158C37.4942 30.4725 38.0754 30.4145 39.2379 30.2982C39.8522 30.2368 40.1593 30.2061 40.3992 30.0824C40.7039 29.9253 40.9413 29.6629 41.0674 29.344C41.1666 29.0931 41.1666 28.7844 41.1666 28.1672V26.377C41.1666 25.7596 41.1666 25.4509 41.0673 25.1999C40.9413 24.8811 40.7039 24.6189 40.3993 24.4616C40.1595 24.338 39.8522 24.3072 39.2378 24.2458C38.0749 24.1295 37.4935 24.0714 37.1744 23.828C36.7698 23.5193 36.5619 23.0172 36.6297 22.5128C36.6831 22.1151 37.0532 21.6629 37.7932 20.7583C38.1842 20.2805 38.3797 20.0415 38.4619 19.7844C38.5662 19.4579 38.5486 19.1046 38.4123 18.7901C38.3049 18.5424 38.0866 18.3241 37.6501 17.8875L36.3843 16.6218C35.9477 16.1852 35.7294 15.9669 35.4818 15.8596C35.1673 15.7233 34.814 15.7057 34.4874 15.81C34.2303 15.8922 33.9915 16.0876 33.5136 16.4786C32.6091 17.2187 32.1569 17.5887 31.7592 17.6422C31.2547 17.7101 30.7527 17.5021 30.444 17.0974C30.2006 16.7784 30.1424 16.1969 30.0261 15.0341Z\" fill=\"url(#paint0_linear_1860_2811)\"></path>                                     <path d=\"M27 31.522C29.3472 31.522 31.25 29.6192 31.25 27.272C31.25 24.9248 29.3472 23.022 27 23.022C24.6528 23.022 22.75 24.9248 22.75 27.272C22.75 29.6192 24.6528 31.522 27 31.522Z\" fill=\"white\"></path>                                     <defs>                                     <linearGradient id=\"paint0_linear_1860_2811\" x1=\"12.8333\" y1=\"27.272\" x2=\"41.1666\" y2=\"27.272\" gradientUnits=\"userSpaceOnUse\">                                     <stop stop-color=\"#805AF9\"></stop>                                     <stop offset=\"1\" stop-color=\"#6632F8\"></stop>                                     </linearGradient>                                     </defs>                                 </svg>', 1, 1, 1, NULL, '2025-01-27 05:15:04', '2025-01-27 05:15:04', NULL),
(237, 'offline_image', NULL, 1, 0, 1, NULL, '2025-01-27 06:07:16', '2025-01-27 06:07:16', NULL),
(238, 'feature_document_7_is_active', '1', 1, 1, 1, NULL, '2025-01-27 09:35:42', '2025-01-27 09:35:42', NULL),
(239, 'enable_brand_voice', '1', 1, 1, 1, NULL, '2025-01-28 06:52:27', '2025-01-28 06:52:27', NULL),
(240, 'enable_voice_clone', '1', 1, 1, 1, NULL, '2025-01-28 06:52:28', '2025-01-28 06:52:28', NULL),
(241, 'enable_ai_photo_studio', '1', 1, 1, 1, NULL, '2025-01-28 06:52:30', '2025-01-28 06:52:30', NULL),
(242, 'enable_ai_product_shot', '1', 1, 1, 1, NULL, '2025-01-28 06:52:32', '2025-01-28 06:52:32', NULL),
(243, 'feature_document_5_is_active', '1', 1, 1, 1, NULL, '2025-01-28 07:06:29', '2025-01-28 07:06:29', NULL),
(244, 'feature_document_6_is_active', '1', 1, 1, 1, NULL, '2025-01-28 07:06:32', '2025-01-28 07:06:32', NULL),
(245, 'seo_review_tool_api_key', '348590346-340989erpgou9874sdlfk', 1, 1, 1, NULL, '2025-01-28 08:17:00', '2025-01-28 08:17:00', NULL),
(246, 'enable_seo_review_tool', '1', 1, 1, 1, NULL, '2025-01-28 08:17:00', '2025-01-28 08:17:00', NULL),
(247, 'content_optimization_per_request_credit_cost', '1', 1, 1, 1, NULL, '2025-01-28 08:17:00', '2025-01-28 08:17:00', NULL),
(248, 'helpful_content_optimization_per_request_credit_cost', '6', 1, 1, 1, NULL, '2025-01-28 08:17:00', '2025-01-28 08:17:00', NULL),
(249, 'bulk_keyword_research_per_request_credit_cost', '4', 1, 1, 1, NULL, '2025-01-28 08:17:00', '2025-01-28 08:17:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_setting_localizations`
--

CREATE TABLE `system_setting_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_setting_id` bigint(20) UNSIGNED NOT NULL,
  `entity` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `lang_key` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_setting_localizations`
--

INSERT INTO `system_setting_localizations` (`id`, `system_setting_id`, `entity`, `value`, `lang_key`, `created_at`, `updated_at`) VALUES
(1, 60, 'auth_image', NULL, 'en', '2025-06-17 00:00:18', '2025-06-17 00:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `table_code` varchar(255) DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `number_of_seats` int(11) DEFAULT 0 COMMENT 'seats of this table',
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `qr_code_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `table_code`, `area_id`, `number_of_seats`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`, `qr_code_id`) VALUES
(1, NULL, 'TB-101', 1, 6, 1, 2, NULL, '2025-05-27 12:39:59', '2025-05-27 12:39:59', NULL, 1),
(2, NULL, 'TB-102', 4, 4, 1, 2, NULL, '2025-05-27 12:42:08', '2025-05-27 12:42:08', NULL, 2),
(3, NULL, 'TB-103', 3, 4, 1, 2, NULL, '2025-05-27 12:42:08', '2025-05-27 12:42:08', NULL, 3),
(4, NULL, 'TB-104', 4, 4, 1, 2, NULL, '2025-05-27 12:42:08', '2025-05-27 12:42:08', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `theme_tag_modules`
--

CREATE TABLE `theme_tag_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `is_paid` tinyint(1) DEFAULT 0,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_tag_modules`
--

INSERT INTO `theme_tag_modules` (`id`, `name`, `description`, `purchase_code`, `domain`, `is_default`, `is_paid`, `is_verified`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'WordpressBlog', NULL, NULL, NULL, 1, 0, 0, 1, NULL, NULL, '2025-06-15 09:05:29', '2025-06-15 09:05:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `priority_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `slug`, `description`, `category_id`, `priority_id`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'How can I add my food menus?', 'how-can-i-add-my-food-menus-v2C8q8L9c5j8u6n', '<p>Kindly help me ASAP</p>', 1, 3, 2, 1, 2, NULL, '2025-06-15 10:14:49', '2025-06-15 10:14:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_files`
--

CREATE TABLE `ticket_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_path` text DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `replied_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reservation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_amount` double NOT NULL DEFAULT 0,
  `payment_method` varchar(255) NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Ex. Status id wise track success/pending/declined payment',
  `note` text DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_no`, `vendor_id`, `branch_id`, `order_id`, `reservation_id`, `paid_amount`, `payment_method`, `status_id`, `note`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`, `customer_id`) VALUES
(1, 's0p8T9', 2, 4, 14, NULL, 250, 'cash', 1, NULL, 2, NULL, NULL, '2025-06-25 06:30:34', '2025-06-25 06:30:34', NULL, 2),
(2, 'I4s3T7', 2, 4, 9, NULL, 150, 'cash', 1, NULL, 2, NULL, NULL, '2025-06-25 07:09:47', '2025-06-25 07:09:47', NULL, 2),
(3, 'x3F0K7', 2, 4, 8, NULL, 150, 'cash', 1, NULL, 2, NULL, NULL, '2025-06-25 07:11:04', '2025-06-25 07:11:04', NULL, 2),
(4, 'R6i8u4', 2, 4, 4, NULL, 330, 'cash', 1, NULL, 2, NULL, NULL, '2025-06-25 07:11:41', '2025-06-25 07:11:41', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '1=Admin, 2=Admin Agent, 3=Vendor, 31=Vendor team, 4=Customer',
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_permission_version` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `last_login_at` datetime DEFAULT NULL,
  `last_logout_at` datetime DEFAULT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `verification_code_expired_at` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `provider_type` varchar(255) DEFAULT NULL,
  `user_balance` double NOT NULL DEFAULT 0,
  `referral_code` varchar(255) DEFAULT NULL,
  `num_of_clicks` int(11) NOT NULL DEFAULT 0,
  `referred_user_id` varchar(255) DEFAULT NULL,
  `is_commission_calculated` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `account_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,2=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `pm_type` varchar(255) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_user_id`, `first_name`, `last_name`, `email`, `mobile_no`, `user_type`, `password`, `avatar`, `branch_id`, `menu_permission_version`, `last_login_at`, `last_logout_at`, `subscription_plan_id`, `verification_code`, `verification_code_expired_at`, `email_verified_at`, `provider_id`, `provider_type`, `user_balance`, `referral_code`, `num_of_clicks`, `referred_user_id`, `is_commission_calculated`, `remember_token`, `account_status`, `created_by_id`, `updated_by_id`, `deleted_by_id`, `created_at`, `updated_at`, `deleted_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, NULL, 'Admin', NULL, 'admin@themetags.com', NULL, 1, '$2y$12$3o3PWkBaPgUmgAh27UWKru8U7qgv2BPbLnqUb75ITO4Tg0o3/Z9ai', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2025-06-15 03:05:27', NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 1, NULL, 1, NULL, '2025-06-15 09:05:28', '2025-06-16 05:18:41', NULL, NULL, NULL, NULL, NULL),
(2, NULL, 'Max', 'Muller', 'vendor@themetags.com', NULL, 3, '$2y$12$y6DZVzHoUd/0vL9m4oPA2.kM1G8BPfCrLQKdDX8khuUe16ueX5mR6', '1', 4, 51, NULL, NULL, 5, NULL, NULL, '2025-06-15 03:05:28', NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 1, NULL, 2, NULL, '2025-06-15 09:05:28', '2025-06-26 11:49:56', NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Ashraf', 'Hakimi', 'staff@themetags.com', '0123456789', 31, '$2y$12$iBQPauj4sW3ftnrbd.S/tezvvtm64JepcLGj/41ME2ieioVXuwh7y', NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, '2025-06-15 03:19:47', NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 1, 2, 2, NULL, '2025-06-15 09:19:47', '2025-06-25 09:54:45', NULL, NULL, NULL, NULL, NULL),
(4, 2, 'Rafel', 'Nadal', 'staff02@gmail.com', '0012346678', 31, '$2y$12$YqJX/bNlItEJqCK673WoleQxoPpEHYiyaEPUqsrNF/cGYuR0x1vw2', NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, '2025-06-15 03:21:12', NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 1, 2, 2, NULL, '2025-06-15 09:21:12', '2025-06-25 09:54:45', NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'John', 'Carram', 'john@gmail.com', '0325364132', 4, '$2y$12$ZAtxUO6Tj7LB59NawSal2O2MJm13Jol1TL7LINoRY4AHBIf3CsM9S', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 1, 2, 2, NULL, '2025-06-15 09:36:53', '2025-06-15 12:53:15', NULL, NULL, NULL, NULL, NULL),
(7, NULL, 'Altaf', 'Mirza', 'altaf@gmail.com', '0893749845', 4, '$2y$12$.V7wJIFzEYj6wEwT.cIz6urFYJC46pnvFX1dxUYAtko0ty1T0sZCi', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 1, 2, NULL, NULL, '2025-06-15 09:41:08', '2025-06-15 09:41:08', NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'Shohanur Rahman', 'Akash', 'akash@gmail.com', '055448984', 4, '$2y$12$PLw2V.VyqbQ/KFKmtV1ARONQVHeEVDLFFkZ9cDdthO8hrtfSDxVze', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 1, 2, 2, NULL, '2025-06-16 05:39:07', '2025-06-16 05:41:31', NULL, NULL, NULL, NULL, NULL),
(9, 2, 'Desiree', 'Bush', 'cepu@mailinator.com', '671', 31, '$2y$12$jnQKb3o/5lmI0dvHmdO2u.TQTR3PAFFkwcCQiEf1lOcK/dbV9plYK', NULL, 4, 0, NULL, NULL, NULL, NULL, NULL, '2025-06-25 03:54:52', NULL, NULL, 0, NULL, 0, NULL, 1, NULL, 0, 2, NULL, NULL, '2025-06-25 09:54:52', '2025-06-25 09:54:52', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_id`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 1, NULL, NULL, '2025-06-15 09:19:47', '2025-06-15 09:19:47', NULL),
(2, 1, 4, 1, NULL, NULL, '2025-06-15 09:21:12', '2025-06-15 09:21:12', NULL),
(3, 1, 9, 1, NULL, NULL, '2025-06-25 09:54:52', '2025-06-25 09:54:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_customers`
--

CREATE TABLE `vendor_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `order_times` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webhook_histories`
--

CREATE TABLE `webhook_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ex. stripe/paypal etc',
  `webhook_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incoming_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hook_payloads` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_area_unique` (`name`,`vendor_id`),
  ADD KEY `areas_created_by_id_foreign` (`created_by_id`),
  ADD KEY `areas_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `areas_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `area_branch`
--
ALTER TABLE `area_branch`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_branch_area` (`area_id`,`branch_id`),
  ADD KEY `area_branch_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_tickets_ticket_id_foreign` (`ticket_id`),
  ADD KEY `assign_tickets_assign_user_id_foreign` (`assign_user_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_branch_code` (`vendor_id`,`branch_code`),
  ADD KEY `branches_created_by_id_foreign` (`created_by_id`),
  ADD KEY `branches_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `branches_deleted_by_id_foreign` (`deleted_by_id`);

--
-- Indexes for table `branch_menus`
--
ALTER TABLE `branch_menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_branch_menu` (`menu_id`,`branch_id`),
  ADD KEY `branch_menus_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_prod_user` (`user_id`,`product_id`,`product_attribute_id`),
  ADD KEY `carts_branch_id_foreign` (`branch_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_product_attribute_id_foreign` (`product_attribute_id`),
  ADD KEY `carts_created_by_id_foreign` (`created_by_id`),
  ADD KEY `carts_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `carts_deleted_by_id_foreign` (`deleted_by_id`);

--
-- Indexes for table `client_feedback`
--
ALTER TABLE `client_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_feedback_user_id_foreign` (`user_id`),
  ADD KEY `client_feedback_created_by_id_foreign` (`created_by_id`),
  ADD KEY `client_feedback_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_us_messages_created_by_id_foreign` (`created_by_id`),
  ADD KEY `contact_us_messages_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_user_id_foreign` (`user_id`),
  ADD KEY `currencies_created_by_id_foreign` (`created_by_id`),
  ADD KEY `currencies_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_templates_user_id_foreign` (`user_id`),
  ADD KEY `email_templates_created_by_id_foreign` (`created_by_id`),
  ADD KEY `email_templates_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_a_q_s_user_id_foreign` (`user_id`),
  ADD KEY `f_a_q_s_created_by_id_foreign` (`created_by_id`),
  ADD KEY `f_a_q_s_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grass_period_payments_user_id_foreign` (`user_id`),
  ADD KEY `grass_period_payments_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `grass_period_payments_created_by_id_foreign` (`created_by_id`),
  ADD KEY `grass_period_payments_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_item_category_unique` (`name`,`vendor_id`),
  ADD KEY `item_categories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `item_categories_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `item_categories_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `kitchens`
--
ALTER TABLE `kitchens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kitchens_branch_id_foreign` (`branch_id`),
  ADD KEY `kitchens_vendor_id_foreign` (`vendor_id`),
  ADD KEY `kitchens_created_by_id_foreign` (`created_by_id`),
  ADD KEY `kitchens_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `kitchens_deleted_by_id_foreign` (`deleted_by_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_folder_unique` (`code`,`user_id`),
  ADD KEY `languages_user_id_foreign` (`user_id`),
  ADD KEY `languages_created_by_id_foreign` (`created_by_id`),
  ADD KEY `languages_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `localizations`
--
ALTER TABLE `localizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_managers`
--
ALTER TABLE `media_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_managers_user_id_foreign` (`user_id`),
  ADD KEY `media_managers_created_by_id_foreign` (`created_by_id`),
  ADD KEY `media_managers_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_menu_unique` (`name`,`vendor_id`),
  ADD KEY `menus_created_by_id_foreign` (`created_by_id`),
  ADD KEY `menus_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `menus_deleted_by_id_foreign` (`deleted_by_id`),
  ADD KEY `menus_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_role_id_foreign` (`role_id`),
  ADD KEY `notifications_created_by_id_foreign` (`created_by_id`),
  ADD KEY `notifications_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offline_payment_methods_user_id_foreign` (`user_id`),
  ADD KEY `offline_payment_methods_created_by_id_foreign` (`created_by_id`),
  ADD KEY `offline_payment_methods_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_invoice_no_unique` (`invoice_no`),
  ADD KEY `orders_vendor_id_foreign` (`vendor_id`),
  ADD KEY `orders_branch_id_foreign` (`branch_id`),
  ADD KEY `orders_table_id_foreign` (`table_id`),
  ADD KEY `orders_status_id_foreign` (`status_id`),
  ADD KEY `orders_created_by_id_foreign` (`created_by_id`),
  ADD KEY `orders_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `orders_deleted_by_id_foreign` (`deleted_by_id`),
  ADD KEY `orders_employee_id_foreign` (`employee_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_payments_vendor_id_foreign` (`vendor_id`),
  ADD KEY `order_payments_branch_id_foreign` (`branch_id`),
  ADD KEY `order_payments_order_id_foreign` (`order_id`),
  ADD KEY `order_payments_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`),
  ADD KEY `order_products_product_attribute_id_foreign` (`product_attribute_id`),
  ADD KEY `order_products_product_owner_id_foreign` (`product_owner_id`),
  ADD KEY `order_products_status_id_foreign` (`status_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_user_id_foreign` (`user_id`),
  ADD KEY `pages_created_by_id_foreign` (`created_by_id`),
  ADD KEY `pages_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateways_created_by_id_foreign` (`created_by_id`),
  ADD KEY `payment_gateways_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `payment_gateway_details`
--
ALTER TABLE `payment_gateway_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateway_details_payment_gateway_id_foreign` (`payment_gateway_id`);

--
-- Indexes for table `payment_gateway_products`
--
ALTER TABLE `payment_gateway_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateway_products_created_by_id_foreign` (`created_by_id`),
  ADD KEY `payment_gateway_products_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `payment_gateway_product_histories`
--
ALTER TABLE `payment_gateway_product_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateway_product_histories_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `payment_gateway_product_histories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `payment_gateway_product_histories_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_user_id_foreign` (`user_id`),
  ADD KEY `permissions_created_by_id_foreign` (`created_by_id`),
  ADD KEY `permissions_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_created_by_id_foreign` (`created_by_id`),
  ADD KEY `personal_access_tokens_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`),
  ADD KEY `products_menu_id_foreign` (`menu_id`),
  ADD KEY `products_item_category_id_foreign` (`item_category_id`),
  ADD KEY `products_media_manager_id_foreign` (`media_manager_id`),
  ADD KEY `products_created_by_id_foreign` (`created_by_id`),
  ADD KEY `products_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `products_deleted_by_id_foreign` (`deleted_by_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reply_tickets_ticket_id_foreign` (`ticket_id`),
  ADD KEY `reply_tickets_replied_by_foreign` (`replied_by`),
  ADD KEY `reply_tickets_updated_by_foreign` (`updated_by`),
  ADD KEY `reply_tickets_created_by_id_foreign` (`created_by_id`),
  ADD KEY `reply_tickets_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_status_id_foreign` (`status_id`),
  ADD KEY `reservations_branch_id_foreign` (`branch_id`),
  ADD KEY `reservations_vendor_id_foreign` (`vendor_id`),
  ADD KEY `reservations_customer_id_foreign` (`customer_id`),
  ADD KEY `reservations_created_by_id_foreign` (`created_by_id`),
  ADD KEY `reservations_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `reservations_deleted_by_id_foreign` (`deleted_by_id`),
  ADD KEY `reservations_area_id_foreign` (`area_id`);

--
-- Indexes for table `reservation_tables`
--
ALTER TABLE `reservation_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_tables_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservation_tables_table_id_foreign` (`table_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_user_id_foreign` (`user_id`),
  ADD KEY `roles_created_by_id_foreign` (`created_by_id`),
  ADD KEY `roles_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_created_by_id_foreign` (`created_by_id`),
  ADD KEY `role_permissions_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statuses_created_by_id_foreign` (`created_by_id`),
  ADD KEY `statuses_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `statuses_deleted_by_id_foreign` (`deleted_by_id`);

--
-- Indexes for table `storage_managers`
--
ALTER TABLE `storage_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storage_managers_user_id_foreign` (`user_id`),
  ADD KEY `storage_managers_created_by_id_foreign` (`created_by_id`),
  ADD KEY `storage_managers_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `subscribed_users`
--
ALTER TABLE `subscribed_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_created_by_id_foreign` (`created_by_id`),
  ADD KEY `subscriptions_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscription_items_created_by_id_foreign` (`created_by_id`),
  ADD KEY `subscription_items_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `subscription_items_subscription_id_stripe_price_index` (`subscription_id`,`stripe_price`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_plans_user_id_foreign` (`user_id`),
  ADD KEY `subscription_plans_created_by_id_foreign` (`created_by_id`),
  ADD KEY `subscription_plans_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `subscription_recurring_payments`
--
ALTER TABLE `subscription_recurring_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_recurring_payments_created_by_id_foreign` (`created_by_id`),
  ADD KEY `subscription_recurring_payments_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `subscription_users`
--
ALTER TABLE `subscription_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_users_user_id_foreign` (`user_id`),
  ADD KEY `subscription_users_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `subscription_users_payment_gateway_id_foreign` (`payment_gateway_id`),
  ADD KEY `subscription_users_created_by_id_foreign` (`created_by_id`),
  ADD KEY `subscription_users_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `subscription_user_usages`
--
ALTER TABLE `subscription_user_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_user_usages_user_id_foreign` (`user_id`),
  ADD KEY `subscription_user_usages_subscription_user_id_foreign` (`subscription_user_id`),
  ADD KEY `subscription_user_usages_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `subscription_user_usages_created_by_id_foreign` (`created_by_id`),
  ADD KEY `subscription_user_usages_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `support_categories`
--
ALTER TABLE `support_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_categories_assign_staff_foreign` (`assign_staff`),
  ADD KEY `support_categories_user_id_foreign` (`user_id`),
  ADD KEY `support_categories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `support_categories_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `support_priorities`
--
ALTER TABLE `support_priorities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_priorities_user_id_foreign` (`user_id`),
  ADD KEY `support_priorities_created_by_id_foreign` (`created_by_id`),
  ADD KEY `support_priorities_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_settings_user_id_foreign` (`user_id`),
  ADD KEY `system_settings_created_by_id_foreign` (`created_by_id`),
  ADD KEY `system_settings_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `system_setting_localizations`
--
ALTER TABLE `system_setting_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_setting_localizations_system_setting_id_foreign` (`system_setting_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_area_id_foreign` (`area_id`),
  ADD KEY `tables_created_by_id_foreign` (`created_by_id`),
  ADD KEY `tables_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `tables_qr_code_id_foreign` (`qr_code_id`);

--
-- Indexes for table `theme_tag_modules`
--
ALTER TABLE `theme_tag_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_tag_modules_created_by_id_foreign` (`created_by_id`),
  ADD KEY `theme_tag_modules_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_category_id_foreign` (`category_id`),
  ADD KEY `tickets_priority_id_foreign` (`priority_id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_created_by_id_foreign` (`created_by_id`),
  ADD KEY `tickets_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `ticket_files`
--
ALTER TABLE `ticket_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_files_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_files_replied_id_foreign` (`replied_id`),
  ADD KEY `ticket_files_created_by_id_foreign` (`created_by_id`),
  ADD KEY `ticket_files_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_no_unique` (`transaction_no`),
  ADD KEY `transactions_vendor_id_foreign` (`vendor_id`),
  ADD KEY `transactions_branch_id_foreign` (`branch_id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `transactions_reservation_id_foreign` (`reservation_id`),
  ADD KEY `transactions_status_id_foreign` (`status_id`),
  ADD KEY `transactions_created_by_id_foreign` (`created_by_id`),
  ADD KEY `transactions_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `transactions_deleted_by_id_foreign` (`deleted_by_id`),
  ADD KEY `transactions_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_parent_user_id_foreign` (`parent_user_id`),
  ADD KEY `users_created_by_id_foreign` (`created_by_id`),
  ADD KEY `users_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `users_deleted_by_id_foreign` (`deleted_by_id`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`),
  ADD KEY `user_roles_created_by_id_foreign` (`created_by_id`),
  ADD KEY `user_roles_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `vendor_customers`
--
ALTER TABLE `vendor_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_customers_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_customers_customer_id_foreign` (`customer_id`),
  ADD KEY `vendor_customers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `webhook_histories`
--
ALTER TABLE `webhook_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `webhook_histories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `webhook_histories_updated_by_id_foreign` (`updated_by_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `area_branch`
--
ALTER TABLE `area_branch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branch_menus`
--
ALTER TABLE `branch_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `client_feedback`
--
ALTER TABLE `client_feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kitchens`
--
ALTER TABLE `kitchens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `localizations`
--
ALTER TABLE `localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=721;

--
-- AUTO_INCREMENT for table `media_managers`
--
ALTER TABLE `media_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_gateway_details`
--
ALTER TABLE `payment_gateway_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `payment_gateway_products`
--
ALTER TABLE `payment_gateway_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateway_product_histories`
--
ALTER TABLE `payment_gateway_product_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation_tables`
--
ALTER TABLE `reservation_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `storage_managers`
--
ALTER TABLE `storage_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribed_users`
--
ALTER TABLE `subscribed_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription_recurring_payments`
--
ALTER TABLE `subscription_recurring_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_users`
--
ALTER TABLE `subscription_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription_user_usages`
--
ALTER TABLE `subscription_user_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_categories`
--
ALTER TABLE `support_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_priorities`
--
ALTER TABLE `support_priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `system_setting_localizations`
--
ALTER TABLE `system_setting_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `theme_tag_modules`
--
ALTER TABLE `theme_tag_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_files`
--
ALTER TABLE `ticket_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_customers`
--
ALTER TABLE `vendor_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `webhook_histories`
--
ALTER TABLE `webhook_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `areas_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `areas_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `area_branch`
--
ALTER TABLE `area_branch`
  ADD CONSTRAINT `area_branch_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `area_branch_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  ADD CONSTRAINT `assign_tickets_assign_user_id_foreign` FOREIGN KEY (`assign_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `assign_tickets_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `branches_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `branches_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `branches_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `branch_menus`
--
ALTER TABLE `branch_menus`
  ADD CONSTRAINT `branch_menus_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `branch_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `carts_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`),
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `client_feedback`
--
ALTER TABLE `client_feedback`
  ADD CONSTRAINT `client_feedback_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_feedback_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  ADD CONSTRAINT `contact_us_messages_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contact_us_messages_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `currencies_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `currencies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD CONSTRAINT `email_templates_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `email_templates_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `email_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD CONSTRAINT `f_a_q_s_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `f_a_q_s_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `f_a_q_s_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  ADD CONSTRAINT `grass_period_payments_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `grass_period_payments_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `grass_period_payments_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `grass_period_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD CONSTRAINT `item_categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `item_categories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `item_categories_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kitchens`
--
ALTER TABLE `kitchens`
  ADD CONSTRAINT `kitchens_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `kitchens_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kitchens_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kitchens_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kitchens_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `languages_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `languages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `media_managers`
--
ALTER TABLE `media_managers`
  ADD CONSTRAINT `media_managers_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `media_managers_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `media_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `menus_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `menus_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `menus_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `notifications_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  ADD CONSTRAINT `offline_payment_methods_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `offline_payment_methods_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `offline_payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `orders_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD CONSTRAINT `order_payments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `order_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_payments_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `order_payments_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`),
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_products_product_owner_id_foreign` FOREIGN KEY (`product_owner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `order_products_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pages_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD CONSTRAINT `payment_gateways_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_gateways_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_gateway_details`
--
ALTER TABLE `payment_gateway_details`
  ADD CONSTRAINT `payment_gateway_details_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`);

--
-- Constraints for table `payment_gateway_products`
--
ALTER TABLE `payment_gateway_products`
  ADD CONSTRAINT `payment_gateway_products_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_gateway_products_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_gateway_product_histories`
--
ALTER TABLE `payment_gateway_product_histories`
  ADD CONSTRAINT `payment_gateway_product_histories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_gateway_product_histories_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `payment_gateway_product_histories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permissions_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD CONSTRAINT `personal_access_tokens_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `personal_access_tokens_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`),
  ADD CONSTRAINT `products_media_manager_id_foreign` FOREIGN KEY (`media_manager_id`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `products_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `products_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD CONSTRAINT `reply_tickets_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reply_tickets_replied_by_foreign` FOREIGN KEY (`replied_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reply_tickets_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `reply_tickets_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reply_tickets_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `reservations_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `reservations_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `reservations_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reservation_tables`
--
ALTER TABLE `reservation_tables`
  ADD CONSTRAINT `reservation_tables_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`),
  ADD CONSTRAINT `reservation_tables_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `roles_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_permissions_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `statuses`
--
ALTER TABLE `statuses`
  ADD CONSTRAINT `statuses_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `statuses_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `statuses_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `storage_managers`
--
ALTER TABLE `storage_managers`
  ADD CONSTRAINT `storage_managers_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `storage_managers_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `storage_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscriptions_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD CONSTRAINT `subscription_items_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_items_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD CONSTRAINT `subscription_plans_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_plans_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscription_recurring_payments`
--
ALTER TABLE `subscription_recurring_payments`
  ADD CONSTRAINT `subscription_recurring_payments_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_recurring_payments_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscription_users`
--
ALTER TABLE `subscription_users`
  ADD CONSTRAINT `subscription_users_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_users_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`),
  ADD CONSTRAINT `subscription_users_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `subscription_users_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscription_user_usages`
--
ALTER TABLE `subscription_user_usages`
  ADD CONSTRAINT `subscription_user_usages_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_user_usages_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `subscription_user_usages_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `subscription_user_usages_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_user_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `support_categories`
--
ALTER TABLE `support_categories`
  ADD CONSTRAINT `support_categories_assign_staff_foreign` FOREIGN KEY (`assign_staff`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `support_categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `support_categories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `support_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `support_priorities`
--
ALTER TABLE `support_priorities`
  ADD CONSTRAINT `support_priorities_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `support_priorities_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `support_priorities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD CONSTRAINT `system_settings_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `system_settings_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `system_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `system_setting_localizations`
--
ALTER TABLE `system_setting_localizations`
  ADD CONSTRAINT `system_setting_localizations_system_setting_id_foreign` FOREIGN KEY (`system_setting_id`) REFERENCES `system_settings` (`id`);

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `tables_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tables_qr_code_id_foreign` FOREIGN KEY (`qr_code_id`) REFERENCES `qr_codes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tables_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `theme_tag_modules`
--
ALTER TABLE `theme_tag_modules`
  ADD CONSTRAINT `theme_tag_modules_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `theme_tag_modules_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `support_categories` (`id`),
  ADD CONSTRAINT `tickets_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `support_priorities` (`id`),
  ADD CONSTRAINT `tickets_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ticket_files`
--
ALTER TABLE `ticket_files`
  ADD CONSTRAINT `ticket_files_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ticket_files_replied_id_foreign` FOREIGN KEY (`replied_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ticket_files_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_files_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `transactions_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `transactions_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `transactions_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_deleted_by_id_foreign` FOREIGN KEY (`deleted_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_parent_user_id_foreign` FOREIGN KEY (`parent_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor_customers`
--
ALTER TABLE `vendor_customers`
  ADD CONSTRAINT `vendor_customers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `vendor_customers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vendor_customers_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `webhook_histories`
--
ALTER TABLE `webhook_histories`
  ADD CONSTRAINT `webhook_histories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `webhook_histories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

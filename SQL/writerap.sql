-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2024 at 02:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `writerap`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_senses`
--

CREATE TABLE `ad_senses` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci,
  `is_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_senses`
--

INSERT INTO `ad_senses` (`id`, `slug`, `size`, `name`, `code`, `is_dashboard`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 'header-top', '728x90', 'Header Top', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10'),
(2, 'top-feature-section', '728x90', 'Top Feature Section', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10'),
(3, 'top-best-feature', '728x90', 'Top Best Feature', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10'),
(4, 'top-template-section', '728x90', 'Top Template Section', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10'),
(5, 'top-review-section', '728x90', 'Top Review Section', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10'),
(6, 'top-subscription-package', '728x90', 'Top Subscription Package', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10'),
(7, 'top-trail-banner-section', '728x90', 'Top Trail Banner Section', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10'),
(8, 'top-footer-section', '728x90', 'Top Footer Section', NULL, 0, 1, 0, NULL, NULL, '2024-07-02 06:48:10', '2024-07-02 06:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_earnings`
--

CREATE TABLE `affiliate_earnings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `referred_user_id` int DEFAULT NULL,
  `subscription_user_id` bigint UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `commission_rate` double NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_payments`
--

CREATE TABLE `affiliate_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_document` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'requested',
  `additional_info` longtext COLLATE utf8mb4_unicode_ci,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_payout_accounts`
--

CREATE TABLE `affiliate_payout_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_details` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ai_prompt_requests`
--

CREATE TABLE `ai_prompt_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `engine_id` bigint UNSIGNED NOT NULL,
  `prompt` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ai_response` longtext COLLATE utf8mb4_unicode_ci,
  `is_completed` tinyint NOT NULL DEFAULT '1' COMMENT '1=Completed,0=Not Completed',
  `total_words` int NOT NULL DEFAULT '0',
  `prompt_tokens` int NOT NULL DEFAULT '0',
  `completion_tokens` int NOT NULL DEFAULT '0',
  `token_used` int NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ai_writers`
--

CREATE TABLE `ai_writers` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Model name',
  `prompt` longtext COLLATE utf8mb4_unicode_ci,
  `response` longtext COLLATE utf8mb4_unicode_ci,
  `prompts_words` int NOT NULL DEFAULT '0',
  `completion_words` int NOT NULL DEFAULT '0',
  `total_words` int NOT NULL DEFAULT '0',
  `prompts_token` int NOT NULL DEFAULT '0',
  `completion_token` int NOT NULL DEFAULT '0',
  `total_token` int NOT NULL DEFAULT '0',
  `folder_id` bigint UNSIGNED DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'content',
  `platform` tinyint DEFAULT NULL COMMENT '1=OpenAi, 2=Stable Diffusion(SD), 3=ElevenLabs, 4=Azure TTS, 5=Google TTS, 6=whisper, 7= geminiAi',
  `article_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_user_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subscription_user_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `completed_step` int NOT NULL DEFAULT '0',
  `topic` text COLLATE utf8mb4_unicode_ci,
  `selected_keyword` text COLLATE utf8mb4_unicode_ci,
  `keyword_generated_content_id` bigint UNSIGNED DEFAULT NULL,
  `selected_title` text COLLATE utf8mb4_unicode_ci,
  `title_generated_content_id` bigint UNSIGNED DEFAULT NULL,
  `selected_outline` text COLLATE utf8mb4_unicode_ci,
  `outline_generated_content_id` bigint UNSIGNED DEFAULT NULL,
  `selected_image` text COLLATE utf8mb4_unicode_ci,
  `article` longtext COLLATE utf8mb4_unicode_ci,
  `article_generated_content_id` bigint UNSIGNED DEFAULT NULL,
  `total_words` int NOT NULL DEFAULT '0',
  `is_published` tinyint NOT NULL DEFAULT '0' COMMENT '1=Published,0=Not Published',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_tickets`
--

CREATE TABLE `assign_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED DEFAULT NULL,
  `assign_user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_category_id` bigint UNSIGNED DEFAULT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `blog_image` int DEFAULT NULL,
  `video_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'youtube' COMMENT 'youtube / vimeo / ...',
  `video_link` text COLLATE utf8mb4_unicode_ci,
  `is_popular` tinyint NOT NULL DEFAULT '0',
  `meta_title` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_image` int DEFAULT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_site_id` bigint UNSIGNED DEFAULT NULL,
  `wp_id` int DEFAULT NULL,
  `is_wp_sync` int DEFAULT '0' COMMENT '1=WP Sync, 0=Not WP Sync'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` bigint UNSIGNED NOT NULL,
  `blog_id` bigint UNSIGNED DEFAULT NULL,
  `tag_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_categories`
--

CREATE TABLE `chat_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_experts`
--

CREATE TABLE `chat_experts` (
  `id` bigint UNSIGNED NOT NULL,
  `expert_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assists_with` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chat_training_data` longtext COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'chat/pdf',
  `is_active` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `is_deletable` tinyint DEFAULT '1' COMMENT '1=yes,0=no',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_experts`
--

INSERT INTO `chat_experts` (`id`, `expert_name`, `short_name`, `slug`, `description`, `role`, `assists_with`, `chat_training_data`, `avatar`, `type`, `is_active`, `is_deletable`, `user_id`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ai Chat Bot', 'Bot', 'ai-chat-bot', 'Chat With AI', 'General', 'Generated content', NULL, NULL, 'chat', 1, 0, 1, 1, NULL, '2024-08-24 05:09:32', '2024-08-24 05:09:32', NULL),
(2, 'Ai Chat Image', 'Image', 'ai-chat-image', 'Chat With AI', 'General', 'Generated content', NULL, NULL, 'image', 1, 0, 1, 1, NULL, '2024-08-24 05:09:32', '2024-08-24 05:09:32', NULL),
(3, 'Ai Vision', 'Vision', 'ai-vision', 'Chat With AI', 'General', 'Generated content', NULL, NULL, 'vision', 1, 0, 1, 1, NULL, '2024-08-24 05:09:32', '2024-08-24 05:09:32', NULL),
(4, 'Ai PDF Chat', 'PDF', 'ai-pdf-chat', 'Chat With AI', 'General', 'Generated content', NULL, NULL, 'pdf', 1, 0, 1, 1, NULL, '2024-08-24 05:09:32', '2024-08-24 05:09:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_prompts`
--

CREATE TABLE `chat_prompts` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prompt` longtext COLLATE utf8mb4_unicode_ci,
  `chat_category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_threads`
--

CREATE TABLE `chat_threads` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chat' COMMENT 'chat/pdf/image/vision',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prompts_words` int NOT NULL DEFAULT '0',
  `completion_words` int NOT NULL DEFAULT '0',
  `total_words` int NOT NULL DEFAULT '0',
  `prompts_token` int NOT NULL DEFAULT '0',
  `completion_token` int NOT NULL DEFAULT '0',
  `total_token` int NOT NULL DEFAULT '0',
  `chat_expert_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_thread_messages`
--

CREATE TABLE `chat_thread_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `random_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'random number will help us to update user balance.',
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=OpenAi, 2=Stable Diffusion(SD), 3=ElevenLabs, 4=Azure TTS, 5=Google TTS, 6=whisper, 7= geminiAi',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chat' COMMENT 'chat/pdf/image/vision',
  `prompt` longtext COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_content` longtext COLLATE utf8mb4_unicode_ci,
  `file_embedding_content` longtext COLLATE utf8mb4_unicode_ci,
  `prompt_embedding_content` longtext COLLATE utf8mb4_unicode_ci,
  `response` longtext COLLATE utf8mb4_unicode_ci,
  `revers_prompt` longtext COLLATE utf8mb4_unicode_ci,
  `prompts_words` int NOT NULL DEFAULT '0',
  `completion_words` int NOT NULL DEFAULT '0',
  `total_words` int NOT NULL DEFAULT '0',
  `prompts_token` int NOT NULL DEFAULT '0',
  `completion_token` int NOT NULL DEFAULT '0',
  `total_token` int NOT NULL DEFAULT '0',
  `generated_image_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_user_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `chat_thread_id` bigint UNSIGNED DEFAULT NULL,
  `chat_expert_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_feedback`
--

CREATE TABLE `client_feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` int DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_messages`
--

CREATE TABLE `contact_us_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_seen` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alignment` tinyint NOT NULL DEFAULT '0' COMMENT '0 for left, 1 for right',
  `rate` double NOT NULL DEFAULT '1',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `symbol`, `alignment`, `rate`, `is_active`, `user_id`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'usd', 'US Dollar', '$', 0, 1, 1, 1, 1, NULL, '2022-11-27 12:21:37', '2022-11-27 12:21:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variables` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint DEFAULT '1',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `slug`, `code`, `type`, `variables`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 'Welcome Email', 'Welcome Email', 'welcome-email', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey\n                            [name],\n                            thanks for\n                            signing up!</p>\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'welcome-email', '[name], [email], [phone]', 1, 1, NULL, NULL, NULL, NULL),
(2, 'Registration Verification', 'Registration Verification', 'registration-verification', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey\n                            [name],\n                            thanks for\n                            signing up!</p>\n                          <h4 style=\"margin-bottom:2px; color:#7E8299\">Email Verification\n                          </h4>\n                          <p style=\"margin-bottom:2px; color:#7E8299\">paragraphs. Please click the button below to verify your email address\n                          </p>\n                         \n                        </div>\n                        <!--end:Text-->\n\n                        <!--begin:Action-->\n                        <a href=\"[active_url]\" target=\"_blank\"\n                          style=\"background-color:#29a762; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;\">\n                          Activate Account\n                        </a>\n                        <!--begin:Action-->\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'registration-verification', '[name], [email], [phone]', 1, 1, NULL, NULL, NULL, NULL),
(3, 'Add New Customer Welcome Email', 'Add New Customer Welcome Email', 'add-new-customer-welcome-email', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n          <div\n            style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n              style=\"border-collapse:collapse\">\n              <tbody>\n                <tr>\n                  <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                    <!--begin:Email content-->\n                    <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                      <!--begin:Logo-->\n                      <div style=\"margin-bottom: 10px\">\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                        </a>\n                      </div>\n                      <!--end:Logo-->\n\n                      <!--begin:Media-->\n                      <div style=\"margin-bottom: 15px\">\n                        <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                          style=\"width: 120px; margin:40px auto;\">\n                      </div>\n                      <!--end:Media-->\n\n                      <!--begin:Text-->\n                      <div\n                        style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                        <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name],\n                        We have created account for you . your login credentails here :\n                          Email : [email]\n                          Phone : [phone]\n                          password : [password]\n                          <strong> and your package info</strong>:\n                          Package name : [package]\n                          Price : [price]\n                          Payment Method : [method]\n                          Start Date : [startDate]\n                          End Date : [endDate]\n                          </p>\n                       \n                      </div>\n                      <!--end:Text-->\n                      <!--begin:Action-->\n                      <a href=\"[login_url]\" target=\"_blank\"\n                        style=\"background-color:#29a762; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;\">\n                        Login\n                      </a>\n                      <!--begin:Action-->\n                    </div>\n                    <!--end:Email content-->\n                  </td>\n                </tr> \n\n                <tr>\n                  <td align=\"center\" valign=\"center\"\n                    style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                    <p\n                      style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                      It’s all about customers!</p>\n                    <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                    <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                        rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                    </p>\n                    <p>We serve Mon-Fri, 9AM-18AM</p>\n                  </td>\n                </tr>  \n                <tr>\n                  <td align=\"center\" valign=\"center\"\n                    style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                    <p> © Copyright ThemeTags.\n                      <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                        style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                      from newsletter.\n                    </p>\n                  </td>\n                </tr>\n              </tbody>\n            </table>\n          </div>\n        </div>', 'add-new-customer-welcome-email', '[name], [email], [phone], [password], [package], [startDate], [endDate], [price], [method]', 1, 1, NULL, NULL, NULL, NULL),
(4, 'Purchase Package', 'Purchase Package', 'purchase-package', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi\n                            [name],\n                            thanks for\n                            purchase [package].</p>\n                            <p>Your [Package] price [price] and start from [startDate]</p>\n                            <p>Your [Package] Will be expire [endDate]</p>                                 \n                        </div>\n                        \n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'purchase-package', '[name], [email], [phone], [package],[startDate], [endDate],[price]', 1, 1, NULL, NULL, NULL, NULL),
(5, 'Admin Assign Package', 'Admin Assign Package', 'admin-assign-package', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi\n                            [name],\n                           Admin Assigned this <strong>[package]</strong> for you.\n                            purchase <strong>[package]</strong>.</p>\n                            <p>Your  <strong>[package]</strong> price  <strong>[price]</strong> and start from [startDate]</p>\n                            <p>Your [Package] Will be expire <strong>[endDate]</strong></p>\n                \n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'admin-assign-package', '[name], [email], [phone], [package],[startDate], [endDate],[price]', 1, 1, NULL, NULL, NULL, NULL),
(6, 'Offline Payment Request', 'Offline Payment Request', 'offline-payment-request', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi, <br>\n                           [name] request a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> .</p>\n                            <p>And  <strong>[package]</strong> price  <strong>[price]</strong></p>                         \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request', '[name], [email], [phone], [package],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL),
(7, 'Offline Payment Request Approve', 'Offline Payment Request Approve', 'offline-payment-request-approve', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name], <br>\n                           Your request a offline payment has been approved [package]</strong> using this payment method <strong>[method]</strong> .</p>\n                                                  \n                            <p>Your  <strong>[package]</strong> price  <strong>[price]</strong> and start from [startDate]</p>\n                            <p>Your [Package] Will be expire <strong>[endDate]</strong></p>\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request-approve', '[name], [email], [phone], [package],[startDate], [endDate],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL),
(8, 'Offline Payment Request Reject', 'Offline Payment Request Reject', 'offline-payment-request-rejected', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name], <br>\n                           Your requested a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> has been <strong>Rejected</strong> .</p>\n                                        \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request-rejected', '[name], [email], [phone], [package],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL),
(9, 'Offline Payment Request Add Note', 'Offline Payment Request Add Note', 'offline-payment-request-add-note', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hi [name], <br>\n                           Your request a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> .</p>\n                            <p>But Admin Want more information from you</p>\n                            <p>[note]</p>                         \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'offline-payment-request-add-note', '[name], [email], [phone], [package],[price], [method],[note]', 1, 1, NULL, NULL, NULL, NULL);
INSERT INTO `email_templates` (`id`, `name`, `subject`, `slug`, `code`, `type`, `variables`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(10, 'Assign Ticket', 'Assign Ticket', 'ticket-assign', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey, <br>\n                            New Ticket from <strong>[name]</strong> and [ticketId] .</p>\n                          \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'ticket-assign', '[name], [email], [phone], [title], [ticketId]', 1, 1, NULL, NULL, NULL, NULL),
(11, 'Ticket Reply', 'Ticket Reply', 'ticket-reply', '<div style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div\n              style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0 auto; max-width: 600px;\">\n              <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\"\n                style=\"border-collapse:collapse\">\n                <tbody>\n                  <tr>\n                    <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                      <!--begin:Email content-->\n                      <div style=\"text-align:center; margin:0 15px 34px 15px\">\n                        <!--begin:Logo-->\n                        <div style=\"margin-bottom: 10px\">\n                          <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\">\n                            <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png\" style=\"height: 35px\">\n                          </a>\n                        </div>\n                        <!--end:Logo-->\n\n                        <!--begin:Media-->\n                        <div style=\"margin-bottom: 15px\">\n                          <img alt=\"Logo\" src=\"https://writebot.themetags.com/public/images/like.svg\"\n                            style=\"width: 120px; margin:40px auto;\">\n                        </div>\n                        <!--end:Media-->\n\n                        <!--begin:Text-->\n                        <div\n                          style=\"font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;\">\n                          <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey, <br>\n                            Ticket reply from  <strong>[name]</strong> and [ticketId] .</p>\n                          \n\n                         \n                        </div>\n                        <!--end:Text-->\n\n                      </div>\n                      <!--end:Email content-->\n                    </td>\n                  </tr> \n\n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                      <p\n                        style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                        It’s all about customers!</p>\n                      <p style=\"margin-bottom:2px\">Call our customer care number: 540-907-0453</p>\n                      <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://writebot.themetags.com/\"\n                          rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">admin@themetags.com</a>.\n                      </p>\n                      <p>We serve Mon-Fri, 9AM-18AM</p>\n                    </td>\n                  </tr>  \n                  <tr>\n                    <td align=\"center\" valign=\"center\"\n                      style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                      <p> © Copyright ThemeTags.\n                        <a href=\"https://writebot.themetags.com/\" rel=\"noopener\" target=\"_blank\"\n                          style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a>&nbsp;\n                        from newsletter.\n                      </p>\n                    </td>\n                  </tr>\n                </tbody>\n              </table>\n            </div>\n          </div>', 'ticket-reply', '[name], [email], [phone], [title],[titleId]', 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `engines`
--

CREATE TABLE `engines` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `engine_features`
--

CREATE TABLE `engine_features` (
  `id` bigint UNSIGNED NOT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

CREATE TABLE `experts` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assist_with` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expert_at` enum('chat','pdf','vision','image','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chat' COMMENT 'Experts Type Ex. Chat',
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expert_category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expert_categories`
--

CREATE TABLE `expert_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint UNSIGNED NOT NULL,
  `folder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `question`, `answer`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Where can I learn more about copywriting or entrepreneurship?', 'WriteBot - is an innovative SaaS platform that harnesses the power of OpenAI Artificial Intelligence technology to provide your users with a range of exceptional features. WriteBot, users can effortlessly generate unique and plagiarism-free content and images, taking advantage of multiple languages for enhanced versatility. It\'s all in one SaaS platform to generate AI content, image and code.', 1, 1, 1, NULL, '2024-07-08 06:07:45', '2024-07-08 06:07:45', NULL),
(2, 'Can I get a demo of the product?', 'Of course! We are currently running 1 live demo a week. You can sign up and register for our next one here.', 1, 1, 1, NULL, '2024-07-08 06:08:04', '2024-07-08 06:08:04', NULL),
(3, 'What languages does it support?', 'With the Pro plan, you can create content in the following 250+ languages:', 1, 1, 1, NULL, '2024-07-08 06:08:21', '2024-07-08 06:08:21', NULL),
(4, 'How much does it cost?', 'Our copywriting tools have a free plan! That\'s right, you can create content with our free tools. However, if you want more content, you\'ll have to subscribe to our Pro plan!', 1, 1, 1, NULL, '2024-07-08 06:08:38', '2024-07-08 06:08:38', NULL),
(5, 'What can I create with WriteBot?', 'We have copywriting tools for everything you need to start and run your business! You can write blog posts, product descriptions, and even Instagram captions with WriteBot. We\'re always updating our tools, so let us know what else you\'d like to see!', 1, 1, 1, NULL, '2024-07-08 06:08:56', '2024-07-08 06:08:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `generated_contents`
--

CREATE TABLE `generated_contents` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Model name',
  `prompt` longtext COLLATE utf8mb4_unicode_ci,
  `response` longtext COLLATE utf8mb4_unicode_ci,
  `prompts_words` int NOT NULL DEFAULT '0',
  `completion_words` int NOT NULL DEFAULT '0',
  `total_words` int NOT NULL DEFAULT '0',
  `prompts_token` int NOT NULL DEFAULT '0',
  `completion_token` int NOT NULL DEFAULT '0',
  `total_token` int NOT NULL DEFAULT '0',
  `storage_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'local/aws/s3',
  `folder_id` bigint UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'keyword/title/outline/article',
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'content/code/speech_to_text/article_wizard',
  `platform` tinyint DEFAULT NULL COMMENT '1=OpenAi, 2=Stable Diffusion(SD), 3=ElevenLabs, 4=Azure TTS, 5=Google TTS, 6=whisper, 7= geminiAi',
  `article_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_user_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generated_images`
--

CREATE TABLE `generated_images` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Model name',
  `prompt` longtext COLLATE utf8mb4_unicode_ci,
  `generated_image_path` longtext COLLATE utf8mb4_unicode_ci,
  `generated_image_resolution` longtext COLLATE utf8mb4_unicode_ci,
  `prompts_words` int NOT NULL DEFAULT '0',
  `completion_words` int NOT NULL DEFAULT '0',
  `total_words` int NOT NULL DEFAULT '0',
  `prompts_token` int NOT NULL DEFAULT '0',
  `completion_token` int NOT NULL DEFAULT '0',
  `total_token` int NOT NULL DEFAULT '0',
  `storage_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'local/aws/s3',
  `folder_id` bigint UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'keyword/title/outline/article',
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'content/code/speech_to_text/article_wizard',
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=OpenAi, 2=Stable Diffusion(SD), 3=ElevenLabs, 4=Azure TTS, 5=Google TTS, 6=whisper, 7= geminiAi',
  `article_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_user_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grass_period_payments`
--

CREATE TABLE `grass_period_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `response` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_rtl` tinyint NOT NULL DEFAULT '0',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `is_active_for_templates` tinyint NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `flag`, `code`, `is_rtl`, `is_active`, `is_active_for_templates`, `user_id`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 'en', 'en', 0, 1, 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `localizations`
--

CREATE TABLE `localizations` (
  `id` bigint UNSIGNED NOT NULL,
  `lang_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localizations`
--

INSERT INTO `localizations` (`id`, `lang_key`, `t_key`, `t_value`, `created_at`, `updated_at`) VALUES
(1, 'en', 'welcome_back', 'Welcome Back', '2024-08-25 08:15:54', '2024-08-25 08:15:54'),
(2, 'en', 'sign_in_to_your_account_to_continue', 'Sign in to your account to continue', '2024-08-25 08:15:54', '2024-08-25 08:15:54'),
(3, 'en', 'email', 'Email', '2024-08-25 08:15:54', '2024-08-25 08:15:54'),
(4, 'en', 'password', 'Password', '2024-08-25 08:15:54', '2024-08-25 08:15:54'),
(5, 'en', 'forgot_password', 'Forgot Password?', '2024-08-25 08:15:54', '2024-08-25 08:15:54'),
(6, 'en', 'remember_me', 'Remember Me', '2024-08-25 08:15:54', '2024-08-25 08:15:54'),
(7, 'en', 'login', 'Login', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(8, 'en', 'dont_have_an_account', 'Don’t have an account?', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(9, 'en', 'sign_up_for_free', 'Sign up for free!', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(10, 'en', 'do_you_want_to_change_the_status', 'Do you want to change the status?', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(11, 'en', 'failed_to_change_the_status', 'Failed to change the status', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(12, 'en', 'are_you_sure_you_want_to_proceed', 'Are you sure you want to proceed?', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(13, 'en', 'this_action_will_permanently_delete_the_selected_record', 'This action will permanently delete the selected record.', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(14, 'en', 'yes_delete', 'Yes, Delete', '2024-08-25 08:15:55', '2024-08-25 08:15:55'),
(15, 'en', 'google_recaptcha_validation_error_seems_like_you_are_not_a_human', 'Google recaptcha validation error, seems like you are not a human.', '2024-08-25 08:15:58', '2024-08-25 08:15:58'),
(16, 'en', 'last_7_days', 'Last 7 days', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(17, 'en', 'overview', 'Overview', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(18, 'en', 'histories', 'Histories', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(19, 'en', 'profile', 'Profile', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(20, 'en', 'total_customer', 'Total Customer', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(21, 'en', 'total_words_generated', 'Total Words Generated', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(22, 'en', 'total_image_generated', 'Total Image Generated', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(23, 'en', 'total_chat_image_generated', 'Total Chat Image Generated', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(24, 'en', 'total_code_generated', 'Total Code Generated', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(25, 'en', 'total_speech_to_text', 'Total Speech To Text', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(26, 'en', 'total_text_to_speech', 'Total Text To Speech', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(27, 'en', 'words_generated_this_months', 'Words Generated This Months', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(28, 'en', 'last_30_days', 'Last 30 days', '2024-08-25 08:15:59', '2024-08-25 08:15:59'),
(29, 'en', 'last_3_months', 'Last 3 months', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(30, 'en', 'words', 'Words', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(31, 'en', 'total_created_words_top_5_templates', 'Total Created Words Top 5 Templates', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(32, 'en', 'recent_project_and_images_generated', 'Recent Project and Images Generated', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(33, 'en', 'search', 'Search...', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(34, 'en', 'content', 'Content', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(35, 'en', 'image', 'Image', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(36, 'en', 'sl', 'S/L', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(37, 'en', 'title', 'Title', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(38, 'en', 'model_name', 'Model Name', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(39, 'en', 'created_date', 'Created Date', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(40, 'en', 'type', 'Type', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(41, 'en', 'wordssize', 'Words/Size', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(42, 'en', 'action', 'Action', '2024-08-25 08:16:00', '2024-08-25 08:16:00'),
(43, 'en', 'dashboard', 'Dashboard', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(44, 'en', 'subscriptions', 'Subscriptions', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(45, 'en', 'subscription_plan', 'Subscription Plan', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(46, 'en', 'subscription_history', 'Subscription History', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(47, 'en', 'subscription_settings', 'Subscription Settings', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(48, 'en', 'manage_documents', 'Manage Documents', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(49, 'en', 'folders', 'Folders', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(50, 'en', 'documents', 'Documents', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(51, 'en', 'ai_tools', 'AI Tools', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(52, 'en', 'ai_writer', 'AI Writer', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(53, 'en', 'ai_writer_list', 'AI Writer List', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(54, 'en', 'ai_images_list', 'AI Images List', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(55, 'en', 'text_to_speech', 'Text To Speech', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(56, 'en', 'audio_to_text', 'Audio To Text', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(57, 'en', 'ai_plagiarism', 'AI Plagiarism', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(58, 'en', 'ai_detector', 'AI Detector', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(59, 'en', 'ai_video', 'AI Video', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(60, 'en', 'all_ai_video', 'All Ai Video', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(61, 'en', 'ai_articles', 'AI Articles', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(62, 'en', 'generate_new_ai_article', 'Generate New Ai Article', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(63, 'en', 'all_ai_articles', 'All Ai Articles', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(64, 'en', 'ai_chat', 'AI Chat', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(65, 'en', 'ai_code_generate', 'Ai Code Generate', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(66, 'en', 'ai_vision', 'Ai Vision', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(67, 'en', 'ai_pdf_chat', 'Ai PDF Chat', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(68, 'en', 'templates', 'Templates', '2024-08-25 08:16:01', '2024-08-25 08:16:01'),
(69, 'en', 'template_categories', 'Template Categories', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(70, 'en', 'chat__prompts', 'Chat & Prompts', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(71, 'en', 'chat_categories', 'Chat Categories', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(72, 'en', 'reports', 'Reports', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(73, 'en', 'words_report', 'Words Report', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(74, 'en', 'codes_report', 'Codes Report', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(75, 'en', 'images_report', 'Images Report', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(76, 'en', 'speech_to_texts', 'Speech to Texts', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(77, 'en', 'most_used_templates', 'Most Used Templates', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(78, 'en', 'subscriptions_reports', 'Subscriptions Reports', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(79, 'en', 'manage_contents', 'Manage Contents', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(80, 'en', 'tags', 'Tags', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(81, 'en', 'blogs', 'Blogs', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(82, 'en', 'all_blogs', 'All Blogs', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(83, 'en', 'categories', 'Categories', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(84, 'en', 'pages', 'Pages', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(85, 'en', 'all_faq', 'All FAQ', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(86, 'en', 'media_manager', 'Media Manager', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(87, 'en', 'manage_promotions', 'Manage Promotions', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(88, 'en', 'newsletters', 'Newsletters', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(89, 'en', 'bulk_emails', 'Bulk Emails', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(90, 'en', 'subscribers', 'Subscribers', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(91, 'en', 'support', 'Support', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(92, 'en', 'queries', 'Queries', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(93, 'en', 'support_ticket', 'Support Ticket', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(94, 'en', 'category', 'Category', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(95, 'en', 'priority', 'priority', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(96, 'en', 'tickets', 'Tickets', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(97, 'en', 'user_management', 'User Management', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(98, 'en', 'customers', 'Customers', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(99, 'en', 'all_users', 'All Users', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(100, 'en', 'user_role', 'User Role', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(101, 'en', 'manage_roles', 'Manage Roles', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(102, 'en', 'manage_users', 'Manage Users', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(103, 'en', 'manage_settings', 'MANAGE SETTINGS', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(104, 'en', 'settings', 'Settings', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(105, 'en', 'credential_setup', 'Credential Setup', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(106, 'en', 'email_template', 'Email Template', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(107, 'en', 'google_ads', 'Google Ads', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(108, 'en', 'multi_language', 'Multi Language', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(109, 'en', 'multi_currency', 'Multi Currency', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(110, 'en', 'payment_gateway', 'Payment Gateway', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(111, 'en', 'offline_payment', 'Offline Payment', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(112, 'en', 'cron_list', 'Cron List', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(113, 'en', 'utilities', 'Utilities', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(114, 'en', 'appearance', 'Appearance', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(115, 'en', 'wordpress', 'Wordpress', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(116, 'en', 'logout', 'Logout', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(117, 'en', 'media_files', 'Media Files', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(118, 'en', 'recently_uploaded_files', 'Recently uploaded files', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(119, 'en', 'add_files_here', 'Add files here', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(120, 'en', 'previously_uploaded_files', 'Previously uploaded files', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(121, 'en', 'search_by_name', 'Search by name', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(122, 'en', 'load_more', 'Load More', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(123, 'en', 'select', 'Select', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(124, 'en', 'visit_store', 'Visit Store', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(125, 'en', 'my_account', 'My Account', '2024-08-25 08:16:02', '2024-08-25 08:16:02'),
(126, 'en', 'home', 'Home', '2024-08-25 08:16:08', '2024-08-25 08:16:08'),
(127, 'en', 'beautiful_documentation_that_converts_users', 'Beautiful documentation That converts users', '2024-08-25 08:16:08', '2024-08-25 08:16:08'),
(128, 'en', 'one_platform_multiple_ai_applications', 'One Platform Multiple AI Applications', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(129, 'en', 'all_templates', 'All Templates', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(130, 'en', 'all', 'All', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(131, 'en', 'see_more', 'See More', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(132, 'en', 'writerap_ai_loved_by_thinkers', 'Writerap AI Loved by Thinkers', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(133, 'en', 'writerap_flexible_pricing', 'Writerap Flexible Pricing', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(134, 'en', 'free', 'Free', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(135, 'en', 'try_for_free', 'Try For Free', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(136, 'en', 'ai_templates', 'AI Templates', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(137, 'en', 'words_per_month', 'Words per month', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(138, 'en', 'images_per_month', 'Images per month', '2024-08-25 08:16:09', '2024-08-25 08:16:09'),
(139, 'en', 'speech_to_text_per_month', 'Speech to Text per month', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(140, 'en', 'audio_file_size_limit', 'Audio file size limit', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(141, 'en', 'ai__images', 'AI  Images', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(142, 'en', 'stable_diffusion_images', 'Stable Diffusion Images', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(143, 'en', 'ai_code', 'AI Code', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(144, 'en', 'speech_to_text', 'Speech to Text', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(145, 'en', 'free__support', 'Free  Support', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(146, 'en', 'frequently_asked_questions', 'Frequently asked questions', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(147, 'en', 'contact_us_at', 'Contact us at', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(148, 'en', 'via_email', 'via email!', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(149, 'en', 'customer_support', 'Customer support', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(150, 'en', 'we_work_around_the_clockso_you_can_focus_on_your_product', 'We work around the clock,so you can focus on your product', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(151, 'en', 'support_everyday_all_week', 'Support everyday, all week', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(152, 'en', 'customer_satisfaction', 'Customer satisfaction', '2024-08-25 08:16:10', '2024-08-25 08:16:10'),
(153, 'en', 'feature', 'Feature', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(154, 'en', 'pricing', 'Pricing', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(155, 'en', 'blog', 'Blog', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(156, 'en', 'about_us', 'About Us', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(157, 'en', 'contact_us', 'Contact Us', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(158, 'en', 'start_for_free', 'Start for free', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(159, 'en', 'privacy_policy', 'Privacy Policy', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(160, 'en', 'terms_of_service', 'Terms of Service', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(161, 'en', 'enter_email_address', 'Enter Email Address', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(162, 'en', 'subscribe', 'Subscribe', '2024-08-25 08:16:11', '2024-08-25 08:16:11'),
(163, 'en', 'words_generated', 'Words Generated', '2024-08-25 08:16:12', '2024-08-25 08:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `media_managers`
--

CREATE TABLE `media_managers` (
  `id` bigint UNSIGNED NOT NULL,
  `media_file` longtext COLLATE utf8mb4_unicode_ci,
  `media_size` int DEFAULT NULL,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'video / image / pdf / ...',
  `media_name` text COLLATE utf8mb4_unicode_ci,
  `media_extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_managers`
--

INSERT INTO `media_managers` (`id`, `media_file`, `media_size`, `media_type`, `media_name`, `media_extension`, `is_active`, `user_id`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/media/1.jpg', NULL, 'image', '1.jpg', 'jpg', 1, 1, 1, NULL, '2024-07-01 00:39:40', '2024-07-01 00:39:40', NULL),
(2, 'uploads/media/2.jpg', NULL, 'image', '2.jpg', 'jpg', 1, 1, 1, NULL, '2024-07-01 00:39:40', '2024-07-01 00:39:40', NULL),
(3, 'uploads/media/3.jpg', NULL, 'image', '3.jpg', 'jpg', 1, 1, 1, NULL, '2024-07-01 00:39:40', '2024-07-01 00:39:40', NULL),
(4, 'uploads/media/4.jpg', NULL, 'image', '5.jpg', 'jpg', 1, 1, 1, NULL, '2024-07-01 00:39:40', '2024-07-01 00:39:40', NULL),
(5, 'uploads/media/5.jpg', NULL, 'image', '4.jpg', 'jpg', 1, 1, 1, NULL, '2024-07-01 00:39:40', '2024-07-01 00:39:40', NULL),
(6, 'uploads/media/6.jpg', NULL, 'image', '6.jpg', 'jpg', 1, 1, 1, NULL, '2024-07-01 00:39:41', '2024-07-01 00:39:41', NULL),
(7, 'uploads/media/logo-color.png', NULL, 'image', 'logo-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 00:40:03', '2024-07-01 00:40:03', NULL),
(8, 'uploads/media/logo.png', NULL, 'image', 'logo.png', 'png', 1, 1, 1, NULL, '2024-07-01 00:40:03', '2024-07-01 00:40:03', NULL),
(9, 'uploads/media/logo-icon.png', NULL, 'image', 'logo-icon.png', 'png', 1, 1, 1, NULL, '2024-07-01 00:40:04', '2024-07-01 00:40:04', NULL),
(10, 'uploads/media/favicon.png', NULL, 'image', 'favicon.png', 'png', 1, 1, 1, NULL, '2024-07-01 00:40:25', '2024-07-01 00:40:25', NULL),
(11, 'uploads/media/login-img.jpg', NULL, 'image', 'login-img.jpg', 'jpg', 1, 1, 1, NULL, '2024-07-01 01:04:01', '2024-07-01 01:04:01', NULL),
(12, 'uploads/media/chat-expert.png', NULL, 'image', 'chat-expert.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:04:16', '2024-07-01 01:04:16', NULL),
(13, 'uploads/media/avater-group-1.png', NULL, 'image', 'avater-group-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:03', '2024-07-01 01:05:03', NULL),
(14, 'uploads/media/avater-group-4.png', NULL, 'image', 'avater-group-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:03', '2024-07-01 01:05:03', NULL),
(15, 'uploads/media/avater-group-3.png', NULL, 'image', 'avater-group-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:03', '2024-07-01 01:05:03', NULL),
(16, 'uploads/media/avater-group-2.png', NULL, 'image', 'avater-group-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:03', '2024-07-01 01:05:03', NULL),
(17, 'uploads/media/banner-about.png', NULL, 'image', 'banner-about.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:03', '2024-07-01 01:05:03', NULL),
(18, 'uploads/media/bg-dark.png', NULL, 'image', 'bg-dark.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:04', '2024-07-01 01:05:04', NULL),
(19, 'uploads/media/blog-1.png', NULL, 'image', 'blog-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:04', '2024-07-01 01:05:04', NULL),
(20, 'uploads/media/brand-1.png', NULL, 'image', 'brand-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:04', '2024-07-01 01:05:04', NULL),
(21, 'uploads/media/brand-2.png', NULL, 'image', 'brand-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:04', '2024-07-01 01:05:04', NULL),
(22, 'uploads/media/blog-2.png', NULL, 'image', 'blog-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:04', '2024-07-01 01:05:04', NULL),
(23, 'uploads/media/brand-4.png', NULL, 'image', 'brand-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:05', '2024-07-01 01:05:05', NULL),
(24, 'uploads/media/brand-5.png', NULL, 'image', 'brand-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:05', '2024-07-01 01:05:05', NULL),
(25, 'uploads/media/brand-3.png', NULL, 'image', 'brand-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:05', '2024-07-01 01:05:05', NULL),
(26, 'uploads/media/brand-7.png', NULL, 'image', 'brand-7.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:05', '2024-07-01 01:05:05', NULL),
(27, 'uploads/media/brand-6.png', NULL, 'image', 'brand-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:05', '2024-07-01 01:05:05', NULL),
(28, 'uploads/media/brand-8.png', NULL, 'image', 'brand-8.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:05', '2024-07-01 01:05:05', NULL),
(29, 'uploads/media/brand-9.png', NULL, 'image', 'brand-9.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:05', '2024-07-01 01:05:05', NULL),
(30, 'uploads/media/brand-dark-1.png', NULL, 'image', 'brand-dark-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:06', '2024-07-01 01:05:06', NULL),
(31, 'uploads/media/brand-10.png', NULL, 'image', 'brand-10.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:06', '2024-07-01 01:05:06', NULL),
(32, 'uploads/media/brand-dark-2.png', NULL, 'image', 'brand-dark-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:06', '2024-07-01 01:05:06', NULL),
(33, 'uploads/media/brand-dark-3.png', NULL, 'image', 'brand-dark-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:06', '2024-07-01 01:05:06', NULL),
(34, 'uploads/media/brand-dark-4.png', NULL, 'image', 'brand-dark-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:06', '2024-07-01 01:05:06', NULL),
(35, 'uploads/media/brand-dark-5.png', NULL, 'image', 'brand-dark-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:06', '2024-07-01 01:05:06', NULL),
(36, 'uploads/media/brand-dark-6.png', NULL, 'image', 'brand-dark-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:06', '2024-07-01 01:05:06', NULL),
(37, 'uploads/media/brand-dark-7.png', NULL, 'image', 'brand-dark-7.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:07', '2024-07-01 01:05:07', NULL),
(38, 'uploads/media/brand-dark-9.png', NULL, 'image', 'brand-dark-9.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:07', '2024-07-01 01:05:07', NULL),
(39, 'uploads/media/brand-dark-8.png', NULL, 'image', 'brand-dark-8.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:07', '2024-07-01 01:05:07', NULL),
(40, 'uploads/media/brand-dark-10.png', NULL, 'image', 'brand-dark-10.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:07', '2024-07-01 01:05:07', NULL),
(41, 'uploads/media/documentation-1.png', NULL, 'image', 'documentation-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:07', '2024-07-01 01:05:07', NULL),
(42, 'uploads/media/documentation-2.png', NULL, 'image', 'documentation-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:07', '2024-07-01 01:05:07', NULL),
(43, 'uploads/media/documentation-3.png', NULL, 'image', 'documentation-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:08', '2024-07-01 01:05:08', NULL),
(44, 'uploads/media/documentation-4.png', NULL, 'image', 'documentation-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:08', '2024-07-01 01:05:08', NULL),
(45, 'uploads/media/feature-1.png', NULL, 'image', 'feature-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:08', '2024-07-01 01:05:08', NULL),
(46, 'uploads/media/feature-2-1.png', NULL, 'image', 'feature-2-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:08', '2024-07-01 01:05:08', NULL),
(47, 'uploads/media/feature-2-2.png', NULL, 'image', 'feature-2-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:08', '2024-07-01 01:05:08', NULL),
(48, 'uploads/media/feature-2-3.png', NULL, 'image', 'feature-2-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:09', '2024-07-01 01:05:09', NULL),
(49, 'uploads/media/feature-2-4.png', NULL, 'image', 'feature-2-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:09', '2024-07-01 01:05:09', NULL),
(50, 'uploads/media/feature-2-5.png', NULL, 'image', 'feature-2-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:09', '2024-07-01 01:05:09', NULL),
(51, 'uploads/media/feature-2-6.png', NULL, 'image', 'feature-2-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:09', '2024-07-01 01:05:09', NULL),
(52, 'uploads/media/feature-2-8.png', NULL, 'image', 'feature-2-8.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:09', '2024-07-01 01:05:09', NULL),
(53, 'uploads/media/feature-list-icon-1.png', NULL, 'image', 'feature-list-icon-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:09', '2024-07-01 01:05:09', NULL),
(54, 'uploads/media/feature-list-icon-2.png', NULL, 'image', 'feature-list-icon-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:10', '2024-07-01 01:05:10', NULL),
(55, 'uploads/media/feature-list-icon-4.png', NULL, 'image', 'feature-list-icon-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:10', '2024-07-01 01:05:10', NULL),
(56, 'uploads/media/feature-list-icon-3.png', NULL, 'image', 'feature-list-icon-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:10', '2024-07-01 01:05:10', NULL),
(57, 'uploads/media/feature-list-icon-5.png', NULL, 'image', 'feature-list-icon-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:10', '2024-07-01 01:05:10', NULL),
(58, 'uploads/media/feature-list-icon-6.png', NULL, 'image', 'feature-list-icon-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:10', '2024-07-01 01:05:10', NULL),
(59, 'uploads/media/feedback-1.png', NULL, 'image', 'feedback-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:10', '2024-07-01 01:05:10', NULL),
(60, 'uploads/media/feedback-2.png', NULL, 'image', 'feedback-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:11', '2024-07-01 01:05:11', NULL),
(61, 'uploads/media/feedback-3.png', NULL, 'image', 'feedback-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:11', '2024-07-01 01:05:11', NULL),
(62, 'uploads/media/feedback-4.png', NULL, 'image', 'feedback-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:11', '2024-07-01 01:05:11', NULL),
(63, 'uploads/media/feedback-5.png', NULL, 'image', 'feedback-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:11', '2024-07-01 01:05:11', NULL),
(64, 'uploads/media/feedback-6.png', NULL, 'image', 'feedback-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:11', '2024-07-01 01:05:11', NULL),
(65, 'uploads/media/feedback-7.png', NULL, 'image', 'feedback-7.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:12', '2024-07-01 01:05:12', NULL),
(66, 'uploads/media/feedback-8.png', NULL, 'image', 'feedback-8.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:12', '2024-07-01 01:05:12', NULL),
(67, 'uploads/media/feedback-9.png', NULL, 'image', 'feedback-9.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:12', '2024-07-01 01:05:12', NULL),
(68, 'uploads/media/flag-1.png', NULL, 'image', 'flag-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:12', '2024-07-01 01:05:12', NULL),
(69, 'uploads/media/flag-2.png', NULL, 'image', 'flag-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:12', '2024-07-01 01:05:12', NULL),
(70, 'uploads/media/flag-3.png', NULL, 'image', 'flag-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:13', '2024-07-01 01:05:13', NULL),
(71, 'uploads/media/flag-4.png', NULL, 'image', 'flag-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:13', '2024-07-01 01:05:13', NULL),
(72, 'uploads/media/flag-6.png', NULL, 'image', 'flag-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:13', '2024-07-01 01:05:13', NULL),
(73, 'uploads/media/flag-5.png', NULL, 'image', 'flag-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:13', '2024-07-01 01:05:13', NULL),
(74, 'uploads/media/flag-7.png', NULL, 'image', 'flag-7.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:13', '2024-07-01 01:05:13', NULL),
(75, 'uploads/media/icon-menu-cloud-server.png', NULL, 'image', 'icon-menu-cloud-server.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:14', '2024-07-01 01:05:14', NULL),
(76, 'uploads/media/icon-menu-dedicated-server.png', NULL, 'image', 'icon-menu-dedicated-server.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:14', '2024-07-01 01:05:14', NULL),
(77, 'uploads/media/icon-menu-reseller-hosting.png', NULL, 'image', 'icon-menu-reseller-hosting.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:14', '2024-07-01 01:05:14', NULL),
(78, 'uploads/media/icon-menu-game-server.png', NULL, 'image', 'icon-menu-game-server.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:14', '2024-07-01 01:05:14', NULL),
(79, 'uploads/media/icon-menu-shared-hosting.png', NULL, 'image', 'icon-menu-shared-hosting.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:14', '2024-07-01 01:05:14', NULL),
(80, 'uploads/media/icon-menu-vps-hosting.png', NULL, 'image', 'icon-menu-vps-hosting.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:14', '2024-07-01 01:05:14', NULL),
(81, 'uploads/media/icon-menu-vps-server.png', NULL, 'image', 'icon-menu-vps-server.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:14', '2024-07-01 01:05:14', NULL),
(82, 'uploads/media/logo-dark.png', NULL, 'image', 'logo-dark.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:15', '2024-07-01 01:05:15', NULL),
(83, 'uploads/media/icon-menu-wp-hosting.png', NULL, 'image', 'icon-menu-wp-hosting.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:15', '2024-07-01 01:05:15', NULL),
(84, 'uploads/media/logo-light.png', NULL, 'image', 'logo-light.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:15', '2024-07-01 01:05:15', NULL),
(85, 'uploads/media/logo-light-2.png', NULL, 'image', 'logo-light-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:15', '2024-07-01 01:05:15', NULL),
(86, 'uploads/media/mission.png', NULL, 'image', 'mission.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:15', '2024-07-01 01:05:15', NULL),
(87, 'uploads/media/support-1.png', NULL, 'image', 'support-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:15', '2024-07-01 01:05:15', NULL),
(88, 'uploads/media/support-2.png', NULL, 'image', 'support-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:16', '2024-07-01 01:05:16', NULL),
(89, 'uploads/media/template-icon-1-color.png', NULL, 'image', 'template-icon-1-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:16', '2024-07-01 01:05:16', NULL),
(90, 'uploads/media/template-list-1.png', NULL, 'image', 'template-list-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:16', '2024-07-01 01:05:16', NULL),
(91, 'uploads/media/template-list-2.png', NULL, 'image', 'template-list-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:16', '2024-07-01 01:05:16', NULL),
(92, 'uploads/media/template-list-4.png', NULL, 'image', 'template-list-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:17', '2024-07-01 01:05:17', NULL),
(93, 'uploads/media/template-list-5.png', NULL, 'image', 'template-list-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:18', '2024-07-01 01:05:18', NULL),
(94, 'uploads/media/template-list-6.png', NULL, 'image', 'template-list-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:18', '2024-07-01 01:05:18', NULL),
(95, 'uploads/media/template-list-7.png', NULL, 'image', 'template-list-7.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:18', '2024-07-01 01:05:18', NULL),
(96, 'uploads/media/template-list-9.png', NULL, 'image', 'template-list-9.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:18', '2024-07-01 01:05:18', NULL),
(97, 'uploads/media/template-list-8.png', NULL, 'image', 'template-list-8.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:18', '2024-07-01 01:05:18', NULL),
(98, 'uploads/media/template-list-10.png', NULL, 'image', 'template-list-10.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:19', '2024-07-01 01:05:19', NULL),
(99, 'uploads/media/template-list-11.png', NULL, 'image', 'template-list-11.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:19', '2024-07-01 01:05:19', NULL),
(100, 'uploads/media/template-list-12.png', NULL, 'image', 'template-list-12.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:19', '2024-07-01 01:05:19', NULL),
(101, 'uploads/media/template-list-13.png', NULL, 'image', 'template-list-13.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:20', '2024-07-01 01:05:20', NULL),
(102, 'uploads/media/work.png', NULL, 'image', 'work.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:20', '2024-07-01 01:05:20', NULL),
(103, 'uploads/media/uk.png', NULL, 'image', 'uk.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:20', '2024-07-01 01:05:20', NULL),
(104, 'uploads/media/template-list-3.png', NULL, 'image', 'template-list-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:26', '2024-07-01 01:05:26', NULL),
(105, 'uploads/media/feature-2-7.png', NULL, 'image', 'feature-2-7.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:26', '2024-07-01 01:05:26', NULL),
(106, 'uploads/media/support-3.png', NULL, 'image', 'support-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:26', '2024-07-01 01:05:26', NULL),
(107, 'uploads/media/feature-2-shape.png', NULL, 'image', 'feature-2-shape.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:57', '2024-07-01 01:05:57', NULL),
(108, 'uploads/media/feature-1-bg-overlaly.png', NULL, 'image', 'feature-1-bg-overlaly.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:57', '2024-07-01 01:05:57', NULL),
(109, 'uploads/media/about-banner-bg.png', NULL, 'image', 'about-banner-bg.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:57', '2024-07-01 01:05:57', NULL),
(110, 'uploads/media/hero-1-bg-overlay.png', NULL, 'image', 'hero-1-bg-overlay.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:57', '2024-07-01 01:05:57', NULL),
(111, 'uploads/media/cta-bg.png', NULL, 'image', 'cta-bg.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:57', '2024-07-01 01:05:57', NULL),
(112, 'uploads/media/template-icon-1.png', NULL, 'image', 'template-icon-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:58', '2024-07-01 01:05:58', NULL),
(113, 'uploads/media/template-icon-1-color.png', NULL, 'image', 'template-icon-1-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:58', '2024-07-01 01:05:58', NULL),
(114, 'uploads/media/support-shape.png', NULL, 'image', 'support-shape.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:58', '2024-07-01 01:05:58', NULL),
(115, 'uploads/media/price-bg-overlay.png', NULL, 'image', 'price-bg-overlay.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:58', '2024-07-01 01:05:58', NULL),
(116, 'uploads/media/template-icon-2.png', NULL, 'image', 'template-icon-2.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:58', '2024-07-01 01:05:58', NULL),
(117, 'uploads/media/template-icon-2-color.png', NULL, 'image', 'template-icon-2-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:59', '2024-07-01 01:05:59', NULL),
(118, 'uploads/media/template-icon-3.png', NULL, 'image', 'template-icon-3.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:59', '2024-07-01 01:05:59', NULL),
(119, 'uploads/media/template-icon-3-color.png', NULL, 'image', 'template-icon-3-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:59', '2024-07-01 01:05:59', NULL),
(120, 'uploads/media/template-icon-4.png', NULL, 'image', 'template-icon-4.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:59', '2024-07-01 01:05:59', NULL),
(121, 'uploads/media/template-icon-4-color.png', NULL, 'image', 'template-icon-4-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:59', '2024-07-01 01:05:59', NULL),
(122, 'uploads/media/template-icon-5.png', NULL, 'image', 'template-icon-5.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:05:59', '2024-07-01 01:05:59', NULL),
(123, 'uploads/media/template-icon-5-color.png', NULL, 'image', 'template-icon-5-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:00', '2024-07-01 01:06:00', NULL),
(124, 'uploads/media/template-icon-6-color.png', NULL, 'image', 'template-icon-6-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:00', '2024-07-01 01:06:00', NULL),
(125, 'uploads/media/template-icon-6.png', NULL, 'image', 'template-icon-6.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:00', '2024-07-01 01:06:00', NULL),
(126, 'uploads/media/template-icon-7.png', NULL, 'image', 'template-icon-7.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:00', '2024-07-01 01:06:00', NULL),
(127, 'uploads/media/template-icon-7-color.png', NULL, 'image', 'template-icon-7-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:00', '2024-07-01 01:06:00', NULL),
(128, 'uploads/media/template-icon-8.png', NULL, 'image', 'template-icon-8.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:00', '2024-07-01 01:06:00', NULL),
(129, 'uploads/media/template-icon-8-color.png', NULL, 'image', 'template-icon-8-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:01', '2024-07-01 01:06:01', NULL),
(130, 'uploads/media/template-icon-9.png', NULL, 'image', 'template-icon-9.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:01', '2024-07-01 01:06:01', NULL),
(131, 'uploads/media/template-icon-9-color.png', NULL, 'image', 'template-icon-9-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:01', '2024-07-01 01:06:01', NULL),
(132, 'uploads/media/template-icon-10.png', NULL, 'image', 'template-icon-10.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:01', '2024-07-01 01:06:01', NULL),
(133, 'uploads/media/template-icon-10-color.png', NULL, 'image', 'template-icon-10-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:01', '2024-07-01 01:06:01', NULL),
(134, 'uploads/media/template-icon-12.png', NULL, 'image', 'template-icon-12.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:01', '2024-07-01 01:06:01', NULL),
(135, 'uploads/media/template-icon-11.png', NULL, 'image', 'template-icon-11.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:01', '2024-07-01 01:06:01', NULL),
(136, 'uploads/media/template-icon-11-color.png', NULL, 'image', 'template-icon-11-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:02', '2024-07-01 01:06:02', NULL),
(137, 'uploads/media/template-icon-12-color.png', NULL, 'image', 'template-icon-12-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:02', '2024-07-01 01:06:02', NULL),
(138, 'uploads/media/template-icon-13.png', NULL, 'image', 'template-icon-13.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:02', '2024-07-01 01:06:02', NULL),
(139, 'uploads/media/template-icon-13-color.png', NULL, 'image', 'template-icon-13-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:02', '2024-07-01 01:06:02', NULL),
(140, 'uploads/media/template-icon-14.png', NULL, 'image', 'template-icon-14.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:02', '2024-07-01 01:06:02', NULL),
(141, 'uploads/media/template-icon-14-color.png', NULL, 'image', 'template-icon-14-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:02', '2024-07-01 01:06:02', NULL),
(142, 'uploads/media/template-icon-15.png', NULL, 'image', 'template-icon-15.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:03', '2024-07-01 01:06:03', NULL),
(143, 'uploads/media/template-icon-15-color.png', NULL, 'image', 'template-icon-15-color.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:03', '2024-07-01 01:06:03', NULL),
(144, 'uploads/media/template-icon-16.png', NULL, 'image', 'template-icon-16.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:03', '2024-07-01 01:06:03', NULL),
(145, 'uploads/media/tem-star.png', NULL, 'image', 'tem-star.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:03', '2024-07-01 01:06:03', NULL),
(146, 'uploads/media/title-shape-1.png', NULL, 'image', 'title-shape-1.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:03', '2024-07-01 01:06:03', NULL),
(147, 'uploads/media/bg-dark.png', NULL, 'image', 'bg-dark.png', 'png', 1, 1, 1, NULL, '2024-07-01 01:06:03', '2024-07-01 01:06:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(9, '2024_02_16_071844_create_user_sites_table', 1),
(10, '2024_02_17_102643_create_tags_table', 1),
(11, '2024_02_17_102804_create_wp_authors_table', 1),
(12, '2024_02_18_094411_create_expert_categories_table', 1),
(13, '2024_02_18_094421_create_experts_table', 1),
(14, '2024_02_18_102051_create_engines_table', 1),
(15, '2024_02_18_102054_create_engine_features_table', 1),
(16, '2024_02_18_103912_create_ai_prompt_requests_table', 1),
(17, '2024_02_18_104004_create_posts_table', 1),
(18, '2024_03_26_090518_create_payment_gateways_table', 1),
(19, '2024_03_26_090639_create_payment_gateway_details_table', 1),
(20, '2024_03_27_043240_create_roles_table', 1),
(21, '2024_03_27_043530_create_user_roles_table', 1),
(22, '2024_03_27_043636_create_permissions_table', 1),
(23, '2024_03_27_043639_create_role_permissions_table', 1),
(24, '2024_03_27_043649_create_system_settings_table', 1),
(25, '2024_03_27_043658_create_template_categories_table', 1),
(26, '2024_03_27_043660_create_templates_table', 1),
(27, '2024_03_27_043721_create_folders_table', 1),
(28, '2024_03_27_043722_create_subscription_plans_table', 1),
(29, '2024_03_27_043723_create_subscription_users_table', 1),
(30, '2024_03_27_043724_create_subscription_user_usages_table', 1),
(31, '2024_03_27_043732_create_generated_contents_table', 1),
(32, '2024_03_27_043741_create_generated_images_table', 1),
(33, '2024_03_27_043751_create_chat_categories_table', 1),
(34, '2024_03_27_043800_create_chat_prompts_table', 1),
(35, '2024_03_27_043809_create_chat_experts_table', 1),
(36, '2024_03_27_043819_create_chat_threads_table', 1),
(37, '2024_03_27_043826_create_chat_thread_messages_table', 1),
(38, '2024_03_27_043838_create_text_to_speeches_table', 1),
(39, '2024_03_27_043913_create_user_balances_table', 1),
(40, '2024_03_27_043922_create_articles_table', 1),
(41, '2024_03_27_053918_create_jobs_table', 1),
(42, '2024_03_27_053932_create_notifications_table', 1),
(43, '2024_04_08_093953_add_menu_permission_version_column_at_table_users', 1),
(44, '2024_04_23_042116_create_media_managers_table', 1),
(45, '2024_05_05_084049_create_ai_writers_table', 1),
(46, '2024_05_12_133338_create_webhook_histories_table', 1),
(47, '2024_05_18_053225_create_storage_managers_table', 1),
(48, '2024_05_18_061744_create_languages_table', 1),
(49, '2024_05_18_114230_create_localizations_table', 1),
(50, '2024_05_18_124549_create_currencies_table', 1),
(51, '2024_05_19_090723_create_pages_table', 1),
(52, '2024_05_20_053011_create_blog_categories_table', 1),
(53, '2024_05_20_060812_create_blogs_table', 1),
(54, '2024_05_20_063921_create_blog_tags_table', 1),
(55, '2024_05_20_121614_create_f_a_q_s_table', 1),
(56, '2024_05_21_050911_create_support_categories_table', 1),
(57, '2024_05_21_050954_create_support_priorities_table', 1),
(58, '2024_05_21_051013_create_tickets_table', 1),
(59, '2024_05_21_051020_create_ticket_files_table', 1),
(60, '2024_05_21_051036_create_reply_tickets_table', 1),
(61, '2024_05_21_051047_create_assign_tickets_table', 1),
(62, '2024_05_29_113130_create_subscription_plan_templates_table', 1),
(63, '2024_06_06_084340_remove_user_id_from_role_permissions', 1),
(64, '2024_06_08_100215_add_column_is_allowed_in_demo_at_table_permissions', 1),
(65, '2024_06_09_070110_create_system_setting_localizations_table', 1),
(66, '2024_06_09_111131_create_client_feedback_table', 1),
(67, '2024_06_25_032445_create_email_templates_table', 1),
(68, '2024_06_30_113832_create_payment_gateway_products_table', 1),
(69, '2024_06_30_113959_create_payment_gateway_product_histories_table', 1),
(70, '2024_07_01_043955_create_grass_period_payments_table', 1),
(71, '2024_07_02_055918_create_ad_senses_table', 1),
(72, '2024_07_03_054313_create_offline_payment_methods_table', 1),
(73, '2024_07_03_102722_create_affiliate_earnings_table', 1),
(74, '2024_07_03_102736_create_affiliate_payout_accounts_table', 1),
(75, '2024_07_03_102810_create_affiliate_payments_table', 1),
(76, '2024_08_07_080943_create_theme_tag_modules_table', 1),
(77, '2024_08_08_122834_create_wp_settings_table', 1),
(78, '2024_08_10_091928_add_column_wp_id_to_tags_table', 1),
(79, '2024_08_10_110115_add_column_wp_id_to_blog_categories_table', 1),
(80, '2024_08_12_045631_create_wp_blog_posts_table', 1),
(81, '2024_08_13_133722_create_subscribed_users_table', 1),
(82, '2024_08_14_094503_create_contact_us_messages_table', 1),
(83, '2024_08_23_085847_create_subscription_recurring_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offline_payment_methods`
--

CREATE TABLE `offline_payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_recurring` tinyint(1) DEFAULT '0',
  `webhook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webhook_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sandbox` tinyint(1) DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'sandbox, live',
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `service_charge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `charge_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1= flat, 2=percentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `gateway`, `image`, `is_recurring`, `webhook_id`, `webhook_secret`, `sandbox`, `type`, `is_active`, `service_charge`, `charge_type`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'assets/img/payments/paypal.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(2, 'stripe', 'assets/img/payments/stripe.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(3, 'paytm', 'assets/img/payments/paytm.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(4, 'razorpay', 'assets/img/payments/razorpay.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(5, 'iyzico', 'assets/img/payments/iyzico.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(6, 'paystack', 'assets/img/payments/paystack.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(7, 'flutterwave', 'assets/img/payments/fluterwave.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(8, 'duitku', 'assets/img/payments/duitku.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(9, 'yookassa', 'assets/img/payments/yoomoney.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(10, 'molile', 'assets/img/payments/mollie.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(11, 'mercadopago', 'assets/img/payments/mercado-pago.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(12, 'midtrans', 'assets/img/payments/midtrans.svg', 0, NULL, NULL, 1, 'sandbox', '0', '0', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_details`
--

CREATE TABLE `payment_gateway_details` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_gateway_id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateway_details`
--

INSERT INTO `payment_gateway_details` (`id`, `payment_gateway_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'PAYPAL_CLIENT_ID', 'ATN-1BxgNKQTpyBobkpoM7PhOvrwo1AArShYin1Jllpxzof-OL6N4KzUIxJBitUc6J6l6WtjsMEfVj5n', '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(2, 1, 'PAYPAL_CLIENT_SECRET', 'EAba0xYxnz1RQfhVU8lgk_s6mntkcmtx7vlCSSvtN9TDPb8fiCG1Quepe92ZM150lMJDtXWhuUBipiGQ', '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(3, 2, 'STRIPE_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(4, 2, 'STRIPE_SECRET', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(5, 3, 'PAYTM_ENVIRONMENT', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(6, 3, 'PAYTM_MERCHANT_ID', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(7, 3, 'PAYTM_MERCHANT_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(8, 3, 'PAYTM_MERCHANT_WEBSITE', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(9, 3, 'PAYTM_CHANNEL', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(10, 3, 'PAYTM_INDUSTRY_TYPE', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(11, 4, 'RAZORPAY_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(12, 4, 'RAZORPAY_SECRET', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(13, 5, 'IYZICO_API_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(14, 5, 'IYZICO_SECRET_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(15, 6, 'PAYSTACK_PUBLIC_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(16, 6, 'PAYSTACK_SECRET_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(17, 6, 'MERCHANT_EMAIL', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(18, 6, 'PAYSTACK_CURRENCY_CODE', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(19, 7, 'FLW_PUBLIC_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(20, 7, 'FLW_SECRET_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(21, 7, 'FLW_SECRET_HASH', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(22, 8, 'DUITKU_API_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(23, 8, 'DUITKU_MERCHANT_CODE', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(24, 8, 'DUITKU_CALLBACK_URL', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(25, 8, 'DUITKU_RETURN_URL', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(26, 8, 'DUITKU_ENV', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(27, 9, 'YOOKASSA_SHOP_ID', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(28, 9, 'YOOKASSA_SECRET_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(29, 9, 'YOOKASSA_CURRENCY_CODE', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(30, 9, 'YOOKASSA_RECIEPT', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(31, 9, 'YOOKASSA_VAT', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(32, 10, 'MOLILE_API_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(33, 11, 'MERCADOPAGO_SECRET_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(34, 12, 'MIDTRANS_SERVER_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39'),
(35, 12, 'MIDTRANS_CLIENT_KEY', NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_products`
--

CREATE TABLE `payment_gateway_products` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `subscription_plan_id` int NOT NULL DEFAULT '0',
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_product_histories`
--

CREATE TABLE `payment_gateway_product_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_plan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_billing_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_billing_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `display_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ex: Get/POST/PUT/DELETE/PATCH ETC',
  `is_sidebar_menu` tinyint NOT NULL DEFAULT '0' COMMENT '1= For Sidebar show-able menu, 0 = Not show-able for sidebar',
  `icon_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ex. icon_file could be image or icon library ref.',
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `is_allowed_in_demo` tinyint NOT NULL DEFAULT '1',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_blog_wizard` int NOT NULL DEFAULT '0',
  `ai_prompt_request_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply_tickets`
--

CREATE TABLE `reply_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED DEFAULT NULL,
  `replied` text COLLATE utf8mb4_unicode_ci,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `replied_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL COMMENT 'Parent id of staff or customer/admin',
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storage_managers`
--

CREATE TABLE `storage_managers` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bucket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `container` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storage_managers`
--

INSERT INTO `storage_managers` (`id`, `type`, `access_key`, `secret_key`, `bucket`, `region`, `container`, `storage_name`, `storage_url`, `file_name`, `path`, `is_active`, `user_id`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'local', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'aws', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_users`
--

CREATE TABLE `subscribed_users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_id` bigint UNSIGNED NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `has_monthly_limit` tinyint NOT NULL DEFAULT '0' COMMENT 'Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `duration` int DEFAULT '30',
  `openai_model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly' COMMENT 'starter/monthly/yearly/lifetime/prepaid',
  `price` double NOT NULL DEFAULT '0',
  `discount_price` double DEFAULT NULL,
  `discount_type` int DEFAULT NULL COMMENT '1=fixed, 2=percentage',
  `discount` double DEFAULT NULL,
  `discount_status` int DEFAULT NULL,
  `discount_start_date` date DEFAULT NULL,
  `discount_end_date` date DEFAULT NULL,
  `total_words_per_month` bigint NOT NULL DEFAULT '0',
  `speech_to_text_filesize_limit` bigint NOT NULL DEFAULT '1',
  `allow_words` tinyint NOT NULL DEFAULT '1',
  `show_words` tinyint NOT NULL DEFAULT '1',
  `allow_unlimited_word` tinyint DEFAULT '0',
  `allow_text_to_speech` tinyint NOT NULL DEFAULT '0',
  `show_text_to_speech` tinyint NOT NULL DEFAULT '1',
  `allow_ai_code` tinyint NOT NULL DEFAULT '0',
  `show_ai_code` tinyint NOT NULL DEFAULT '1',
  `total_text_to_speech_per_month` bigint NOT NULL DEFAULT '0',
  `allow_unlimited_text_to_speech` tinyint DEFAULT '0',
  `allow_text_to_speech_open_ai` tinyint DEFAULT '0',
  `show_text_to_speech_open_ai` tinyint NOT NULL DEFAULT '1',
  `allow_google_cloud` tinyint NOT NULL DEFAULT '0',
  `show_google_cloud` tinyint NOT NULL DEFAULT '1',
  `allow_azure` tinyint NOT NULL DEFAULT '0',
  `show_azure` tinyint NOT NULL DEFAULT '1',
  `allow_unlimited_ai_video` tinyint DEFAULT '0',
  `total_ai_video_per_month` bigint NOT NULL DEFAULT '0',
  `allow_ai_video` tinyint NOT NULL DEFAULT '0',
  `show_ai_video` tinyint NOT NULL DEFAULT '0',
  `allow_ai_chat` tinyint NOT NULL DEFAULT '0',
  `show_ai_chat` tinyint NOT NULL DEFAULT '1',
  `allow_templates` tinyint NOT NULL DEFAULT '1',
  `show_templates` tinyint NOT NULL DEFAULT '1',
  `allow_ai_rewriter` tinyint NOT NULL DEFAULT '0',
  `show_ai_rewriter` tinyint NOT NULL DEFAULT '0',
  `allow_ai_detector` tinyint DEFAULT '1',
  `show_ai_detector` tinyint DEFAULT '0',
  `allow_ai_plagiarism` tinyint DEFAULT '1',
  `show_ai_plagiarism` tinyint DEFAULT '1',
  `allow_ai_image_chat` tinyint NOT NULL DEFAULT '0',
  `show_ai_image_chat` tinyint NOT NULL DEFAULT '0',
  `total_speech_to_text_per_month` bigint NOT NULL DEFAULT '0',
  `allow_speech_to_text` tinyint NOT NULL DEFAULT '0',
  `show_speech_to_text` tinyint NOT NULL DEFAULT '1',
  `allow_unlimited_speech_to_text` tinyint DEFAULT '0',
  `total_images_per_month` bigint NOT NULL DEFAULT '0',
  `allow_unlimited_image` tinyint DEFAULT '0',
  `allow_images` tinyint NOT NULL DEFAULT '1',
  `show_images` tinyint NOT NULL DEFAULT '1',
  `allow_sd_images` tinyint NOT NULL DEFAULT '1',
  `show_sd_images` tinyint NOT NULL DEFAULT '1',
  `allow_dall_e_2_image` tinyint DEFAULT '1',
  `show_dall_e_2_image` tinyint DEFAULT '1',
  `allow_dall_e_3_image` tinyint DEFAULT '1',
  `show_dall_e_3_image` tinyint DEFAULT '1',
  `allow_ai_pdf_chat` tinyint NOT NULL DEFAULT '0',
  `show_ai_pdf_chat` tinyint NOT NULL DEFAULT '0',
  `allow_eleven_labs` tinyint DEFAULT '0',
  `show_eleven_labs` tinyint DEFAULT '0',
  `allow_real_time_data` tinyint DEFAULT '0',
  `show_real_time_data` tinyint DEFAULT '0',
  `allow_blog_wizard` tinyint DEFAULT '1',
  `show_blog_wizard` tinyint DEFAULT '0',
  `allow_ai_vision` tinyint NOT NULL DEFAULT '0',
  `show_ai_vision` tinyint NOT NULL DEFAULT '0',
  `allow_team` tinyint NOT NULL DEFAULT '0',
  `show_team` tinyint NOT NULL DEFAULT '0',
  `show_open_ai_model` tinyint NOT NULL DEFAULT '1',
  `show_live_support` tinyint NOT NULL DEFAULT '1',
  `show_free_support` tinyint NOT NULL DEFAULT '1',
  `has_live_support` tinyint NOT NULL DEFAULT '0',
  `has_free_support` tinyint NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `other_features` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `has_monthly_limit`, `title`, `slug`, `user_id`, `duration`, `openai_model`, `description`, `package_type`, `price`, `discount_price`, `discount_type`, `discount`, `discount_status`, `discount_start_date`, `discount_end_date`, `total_words_per_month`, `speech_to_text_filesize_limit`, `allow_words`, `show_words`, `allow_unlimited_word`, `allow_text_to_speech`, `show_text_to_speech`, `allow_ai_code`, `show_ai_code`, `total_text_to_speech_per_month`, `allow_unlimited_text_to_speech`, `allow_text_to_speech_open_ai`, `show_text_to_speech_open_ai`, `allow_google_cloud`, `show_google_cloud`, `allow_azure`, `show_azure`, `allow_unlimited_ai_video`, `total_ai_video_per_month`, `allow_ai_video`, `show_ai_video`, `allow_ai_chat`, `show_ai_chat`, `allow_templates`, `show_templates`, `allow_ai_rewriter`, `show_ai_rewriter`, `allow_ai_detector`, `show_ai_detector`, `allow_ai_plagiarism`, `show_ai_plagiarism`, `allow_ai_image_chat`, `show_ai_image_chat`, `total_speech_to_text_per_month`, `allow_speech_to_text`, `show_speech_to_text`, `allow_unlimited_speech_to_text`, `total_images_per_month`, `allow_unlimited_image`, `allow_images`, `show_images`, `allow_sd_images`, `show_sd_images`, `allow_dall_e_2_image`, `show_dall_e_2_image`, `allow_dall_e_3_image`, `show_dall_e_3_image`, `allow_ai_pdf_chat`, `show_ai_pdf_chat`, `allow_eleven_labs`, `show_eleven_labs`, `allow_real_time_data`, `show_real_time_data`, `allow_blog_wizard`, `show_blog_wizard`, `allow_ai_vision`, `show_ai_vision`, `allow_team`, `show_team`, `show_open_ai_model`, `show_live_support`, `show_free_support`, `has_live_support`, `has_free_support`, `is_featured`, `other_features`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Startup', 'startup-package', 1, 30, 'gpt-3.5-turbo', 'Get started with our Startup package', 'starter', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1000, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, 0, 1, 1, 0, 10, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan_templates`
--

CREATE TABLE `subscription_plan_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_plan_id` bigint UNSIGNED NOT NULL,
  `template_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_recurring_payments`
--

CREATE TABLE `subscription_recurring_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_user_usage_id` int DEFAULT NULL,
  `billing_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_subscription_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `reason` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `cancel_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_users`
--

CREATE TABLE `subscription_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subscription_plan_id` bigint UNSIGNED NOT NULL,
  `start_at` datetime DEFAULT NULL COMMENT 'Subscription Starting date',
  `expire_at` datetime DEFAULT NULL COMMENT 'Subscription expire date',
  `has_monthly_limit` tinyint NOT NULL DEFAULT '0' COMMENT 'Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly',
  `price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_type` int DEFAULT NULL,
  `forcefully_active` int DEFAULT NULL,
  `is_recurring` tinyint DEFAULT '0',
  `is_carried_over` tinyint DEFAULT '0',
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offline_payment_id` int DEFAULT NULL,
  `payment_gateway_id` bigint UNSIGNED DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment_details` longtext COLLATE utf8mb4_unicode_ci,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `file` text COLLATE utf8mb4_unicode_ci,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `payment_status` int DEFAULT NULL COMMENT '1=paid, 2=Pending, 3=Rejected 4=Re-Submit',
  `subscription_status` int DEFAULT NULL COMMENT '1=active, 2=expired, 3=subscribed',
  `expire_by_admin_date` datetime DEFAULT NULL COMMENT 'Subscription expire by admin date',
  `is_active` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_user_usages`
--

CREATE TABLE `subscription_user_usages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subscription_user_id` bigint UNSIGNED NOT NULL,
  `subscription_plan_id` bigint UNSIGNED NOT NULL,
  `subscription_status` int DEFAULT NULL COMMENT '1=active, 2=expired, 3=subscribed',
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=OpenAi, 2=Stable Diffusion(SD), 3=ElevenLabs, 4=Azure TTS, 5=Google TTS, 6=whisper, 7= geminiAi',
  `has_monthly_limit` tinyint NOT NULL DEFAULT '0' COMMENT 'Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly',
  `start_at` datetime NOT NULL,
  `expire_at` datetime NOT NULL,
  `openai_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `word_balance` int NOT NULL DEFAULT '0',
  `word_balance_used` int NOT NULL DEFAULT '0',
  `word_balance_remaining` int NOT NULL DEFAULT '0',
  `word_balance_t2s` int NOT NULL DEFAULT '0',
  `word_balance_used_t2s` int NOT NULL DEFAULT '0',
  `word_balance_remaining_t2s` int NOT NULL DEFAULT '0',
  `image_balance` int NOT NULL DEFAULT '0',
  `image_balance_used` int NOT NULL DEFAULT '0',
  `image_balance_remaining` int NOT NULL DEFAULT '0',
  `video_balance` int NOT NULL DEFAULT '0',
  `video_balance_used` int NOT NULL DEFAULT '0',
  `video_balance_remaining` int NOT NULL DEFAULT '0',
  `speech_balance` int NOT NULL DEFAULT '0',
  `speech_balance_used` int NOT NULL DEFAULT '0',
  `speech_balance_remaining` int NOT NULL DEFAULT '0',
  `allow_unlimited_word` tinyint DEFAULT '0',
  `allow_unlimited_text_to_speech` tinyint DEFAULT '0',
  `allow_unlimited_image` tinyint DEFAULT '0',
  `allow_unlimited_speech_to_text` tinyint DEFAULT '0',
  `allow_unlimited_ai_video` tinyint DEFAULT '0',
  `speech_to_text_filesize_limit` bigint DEFAULT NULL,
  `allow_words` tinyint NOT NULL DEFAULT '1',
  `allow_ai_code` tinyint NOT NULL DEFAULT '0',
  `allow_ai_chat` tinyint NOT NULL DEFAULT '0',
  `allow_ai_pdf_chat` tinyint NOT NULL DEFAULT '0',
  `allow_templates` tinyint NOT NULL DEFAULT '0',
  `allow_ai_rewriter` tinyint NOT NULL DEFAULT '0',
  `allow_ai_detector` tinyint DEFAULT '0',
  `allow_ai_plagiarism` tinyint DEFAULT '0',
  `allow_real_time_data` tinyint DEFAULT '0',
  `allow_blog_wizard` tinyint DEFAULT '0',
  `allow_text_to_speech` tinyint NOT NULL DEFAULT '0',
  `allow_text_to_speech_open_ai` tinyint DEFAULT '0',
  `allow_google_cloud` tinyint NOT NULL DEFAULT '0',
  `allow_azure` tinyint NOT NULL DEFAULT '0',
  `allow_eleven_labs` tinyint DEFAULT '0',
  `allow_ai_video` tinyint NOT NULL DEFAULT '0',
  `allow_speech_to_text` tinyint NOT NULL DEFAULT '0',
  `allow_images` tinyint NOT NULL DEFAULT '0',
  `allow_ai_image_chat` tinyint NOT NULL DEFAULT '0',
  `allow_sd_images` tinyint NOT NULL DEFAULT '0',
  `allow_dall_e_2_image` tinyint DEFAULT '0',
  `allow_dall_e_3_image` tinyint DEFAULT '0',
  `allow_ai_vision` tinyint NOT NULL DEFAULT '0',
  `allow_team` tinyint NOT NULL DEFAULT '0',
  `has_free_support` tinyint NOT NULL DEFAULT '0',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_categories`
--

CREATE TABLE `support_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_staff` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_priorities`
--

CREATE TABLE `support_priorities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `entity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `entity`, `value`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'hero_title', 'Generate Unlimited AI', 1, 1, 1, NULL, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59'),
(2, 'hero_sub_title', 'Meet the modern standard for public facing documentation. Beautiful out of the box, easy to maintain, and optimized for user engagement.', 1, 1, 1, NULL, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59'),
(3, 'hero_sub_title_btn_text', 'Start Writing - It\\\'s Free', 1, 1, 1, NULL, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59'),
(4, 'hero_sub_title_btn_link', 'http://writerap.test/login', 1, 1, 1, NULL, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59'),
(5, 'useuse_customer', '150,000+ Client Use Writerap AI every day', 1, 1, 1, NULL, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59'),
(6, 'hero_background_image', '147', 1, 1, 1, NULL, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59'),
(7, 'hero_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 05:46:59', '2024-08-18 05:46:59'),
(8, 'brand_background_images', '40,39,38,37,33,32,36,35,34,30', 1, 1, 1, NULL, NULL, '2024-08-18 05:54:29', '2024-08-18 05:54:29'),
(9, 'brand_is_active', '0', 1, 1, 1, 1, NULL, '2024-08-18 05:54:29', '2024-08-18 06:12:02'),
(10, 'feature_document_1_title', 'Hight Quality Image Generation   Through AI Chat', 1, 1, 1, NULL, NULL, '2024-08-18 06:17:10', '2024-08-18 06:17:10'),
(11, 'feature_document_1_short_description', 'Unlock your creativity and unleash your potential to create advanced images effortlessly don’t limit yourself. using generative AI and data from millions of emails.', 1, 1, 1, NULL, NULL, '2024-08-18 06:17:10', '2024-08-18 06:17:10'),
(12, 'feature_document_1_image', '41', 1, 1, 1, NULL, NULL, '2024-08-18 06:17:10', '2024-08-18 06:17:10'),
(13, 'feature_document_1_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:17:10', '2024-08-18 06:17:10'),
(14, 'feature_document_2_title', 'Hight Quality Image Generation  Through AI Chat', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:01', '2024-08-18 06:18:01'),
(15, 'feature_document_2_short_description', 'Unlock your creativity and unleash your potential to create advanced images effortlessly don’t limit yourself. using generative AI and data from millions of emails.', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:01', '2024-08-18 06:18:01'),
(16, 'feature_document_2_image', '42', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:01', '2024-08-18 06:18:01'),
(17, 'feature_document_2_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:01', '2024-08-18 06:18:01'),
(18, 'feature_document_3_title', 'Turn Your Text Into Voice    Within ️Minutes', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:47', '2024-08-18 06:18:47'),
(19, 'feature_document_3_short_description', 'Unlock your creativity and unleash your potential to create advanced images effortlessly don’t limit yourself. using generative AI and data from millions of emails.', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:47', '2024-08-18 06:18:47'),
(20, 'feature_document_3_image', '43', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:47', '2024-08-18 06:18:47'),
(21, 'feature_document_3_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:18:47', '2024-08-18 06:18:47'),
(22, 'feature_document_4_title', 'Try Image Chat 🌄 for creating     compelling AI content', 1, 1, 1, NULL, NULL, '2024-08-18 06:20:06', '2024-08-18 06:20:06'),
(23, 'feature_document_4_short_description', 'Unlock your creativity and unleash your potential to create advanced images effortlessly don’t limit yourself. using generative AI and data from millions of emails.', 1, 1, 1, NULL, NULL, '2024-08-18 06:20:06', '2024-08-18 06:20:06'),
(24, 'feature_document_4_image', '44', 1, 1, 1, NULL, NULL, '2024-08-18 06:20:06', '2024-08-18 06:20:06'),
(25, 'feature_document_4_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:20:06', '2024-08-18 06:20:06'),
(26, 'feature_1_title', 'Built for performance', 1, 1, 1, NULL, NULL, '2024-08-18 06:30:44', '2024-08-18 06:30:44'),
(27, 'feature_1_short_description', 'Meticulously designed and optimized for a great user experience', 1, 1, 1, NULL, NULL, '2024-08-18 06:30:44', '2024-08-18 06:30:44'),
(28, 'feature_1_image', '46', 1, 1, 1, NULL, NULL, '2024-08-18 06:30:44', '2024-08-18 06:30:44'),
(29, 'feature_1_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:30:44', '2024-08-18 06:30:44'),
(30, 'feature_2_title', 'Write and optimize content in any language', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:15', '2024-08-18 06:31:15'),
(31, 'feature_2_short_description', 'Write and optimize simultaneously with real-time metrics for structure, word count, NLP-ready keywords and images, and rank high anywhere in the world, no matter the niche or industry.', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:15', '2024-08-18 06:31:15'),
(32, 'feature_2_image', '47', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:15', '2024-08-18 06:31:15'),
(33, 'feature_2_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:15', '2024-08-18 06:31:15'),
(34, 'feature_3_title', 'Two-Factor Authentication', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:49', '2024-08-18 06:31:49'),
(35, 'feature_3_short_description', 'Two-factor authentication protection for your Twilio account', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:49', '2024-08-18 06:31:49'),
(36, 'feature_3_image', '48', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:49', '2024-08-18 06:31:49'),
(37, 'feature_3_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:31:49', '2024-08-18 06:31:49'),
(38, 'feature_4_title', 'AWS Storage Management', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:21', '2024-08-18 06:32:21'),
(39, 'feature_4_short_description', 'Amazon AWS S3 storage management for Image & contents', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:21', '2024-08-18 06:32:21'),
(40, 'feature_4_image', '49', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:21', '2024-08-18 06:32:21'),
(41, 'feature_4_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:21', '2024-08-18 06:32:21'),
(42, 'feature_5_title', 'Payment Gateway System', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:57', '2024-08-18 06:32:57'),
(43, 'feature_5_short_description', 'Amazon AWS S3 storage management for Image contents', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:57', '2024-08-18 06:32:57'),
(44, 'feature_5_image', '50', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:57', '2024-08-18 06:32:57'),
(45, 'feature_5_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:32:57', '2024-08-18 06:32:57'),
(46, 'feature_6_title', 'AI Image Generation', 1, 1, 1, NULL, NULL, '2024-08-18 06:33:50', '2024-08-18 06:33:50'),
(47, 'feature_6_short_description', 'Writrap AI has a built-in a helping hand Surfy! Meet  your AI writing assistant that edits, rephrases, and refines your content in real time', 1, 1, 1, NULL, NULL, '2024-08-18 06:33:50', '2024-08-18 06:33:50'),
(48, 'feature_6_image', '105', 1, 1, 1, NULL, NULL, '2024-08-18 06:33:50', '2024-08-18 06:33:50'),
(49, 'feature_6_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:33:50', '2024-08-18 06:33:50'),
(50, 'feature_7_title', 'Generate Multilingual Blog to rank article in minutes', 1, 1, 1, NULL, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35'),
(51, 'feature_7_short_description', 'Learning multiple languages offers numerous benefits that can enhance both your personal and professional life. It opens up new cultural', 1, 1, 1, NULL, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35'),
(52, 'feature_7_image', '52', 1, 1, 1, NULL, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35'),
(53, 'feature_7_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:34:35', '2024-08-18 06:34:35'),
(54, 'feature_8_title', 'So, how does it work?', 1, 1, 1, NULL, NULL, '2024-08-18 06:35:53', '2024-08-18 06:35:53'),
(55, 'feature_8_sub_title', 'How to use Writerap AI   how does it work?  On your SaaS business', 1, 1, 1, NULL, NULL, '2024-08-18 06:35:53', '2024-08-18 06:35:53'),
(56, 'feature_8_sub_title_btn_text', 'Learn More', 1, 1, 1, NULL, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54'),
(57, 'feature_8_sub_title_btn_link', 'http://writerap.test/login', 1, 1, 1, NULL, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54'),
(58, 'youtube_embeded_link', 'https://www.youtube.com/embed/8U1lheQAqjg', 1, 1, 1, NULL, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54'),
(59, 'feature_8_is_active', '1', 1, 1, 1, NULL, NULL, '2024-08-18 06:35:54', '2024-08-18 06:35:54'),
(60, 'auth_image', '11', 1, 1, 1, NULL, NULL, '2024-08-18 06:36:37', '2024-08-18 06:36:37'),
(61, 'copywrite_text', '<p>Copyright © 2024 <b>Themetags</b><br></p>', 1, 1, 1, 1, NULL, '2024-08-18 09:29:34', '2024-08-18 11:50:41'),
(62, 'aboutUsContents', '<h3>About Us</h3><p>At WriterAP, we believe in the power of words to shape ideas, convey emotions, and transform the world. Our AI-driven application is designed to empower writers, creators, and businesses to craft compelling content with ease and precision.</p><p><strong>Our Mission</strong><br>Our mission is to democratize the art of writing by providing an intelligent, intuitive platform that helps users of all skill levels create high-quality content. Whether you\'re drafting a blog post, writing an academic paper, or crafting the perfect social media update, WriterAP is here to support you every step of the way.</p><p><strong>Our Technology</strong><br>Harnessing the latest advancements in AI and natural language processing, WriterAP delivers smart writing assistance that goes beyond mere grammar and spelling checks. Our AI understands context, suggests improvements, and even helps you refine your tone and style, ensuring your writing resonates with your audience.</p><p><strong>Why Choose WriterAP?</strong></p><ul><li><strong>Intelligent Suggestions</strong>: Our AI offers context-aware suggestions that enhance your writing without losing your unique voice.</li><li><strong>Time-Efficient</strong>: Save time on revisions and editing by getting real-time feedback and suggestions.</li><li><strong>User-Friendly Interface</strong>: With a sleek and intuitive design, WriterAP is easy to use for both beginners and seasoned writers.</li><li><strong>Versatile Applications</strong>: From content marketing to academic writing, WriterAP adapts to various writing needs.</li></ul><p><strong>Our Vision</strong><br>We envision a future where everyone, regardless of their background or experience, has the tools to express their ideas effectively. By blending human creativity with AI precision, WriterAP is redefining the writing process, making it more accessible, efficient, and enjoyable.</p><p>Join us on this journey to transform the way we write and communicate. With WriterAP, the power of words is at your fingertips.</p>', 1, 1, 1, NULL, NULL, '2024-08-18 09:43:53', '2024-08-18 09:43:53'),
(63, 'system_title', 'Writerap - AI', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(64, 'tab_separator', ':', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(65, 'contact_email', 'hellothemetags@gmail.com', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(66, 'contact_phone', '540-907-0453', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(67, 'contact_address', 'Uttara, Dhaka-Bangladesh', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(68, 'logo_for_light', '8', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(69, 'logo_for_dark', '7', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(70, 'collapse_able_icon', '9', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(71, 'favicon', '10', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(72, 'preloader', '10', 1, 1, 1, NULL, NULL, '2024-08-18 11:47:04', '2024-08-18 11:47:04'),
(73, 'enable_ai_chat', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:03', '2024-08-18 11:48:03'),
(74, 'enable_ai_pdf_chat', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:04', '2024-08-18 11:48:04'),
(75, 'enable_ai_vision', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:06', '2024-08-18 11:48:06'),
(76, 'enable_ai_video', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:07', '2024-08-18 11:48:07'),
(77, 'enable_ai_images', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:08', '2024-08-18 11:48:08'),
(78, 'enable_ai_chat_image', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:10', '2024-08-18 11:48:10'),
(79, 'enable_ai_detector', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:11', '2024-08-18 11:48:11'),
(80, 'enable_ai_plagiarism', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:12', '2024-08-18 11:48:12'),
(81, 'enable_ai_rewriter', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:13', '2024-08-18 11:48:13'),
(82, 'enable_templates', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:14', '2024-08-18 11:48:14'),
(83, 'enable_ai_blog_wizard', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:16', '2024-08-18 11:48:16'),
(84, 'enable_speech_to_text', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:18', '2024-08-18 11:48:18'),
(85, 'enable_text_to_speech', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:19', '2024-08-18 11:48:19'),
(86, 'enable_eleven_labs', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:20', '2024-08-18 11:48:20'),
(87, 'enable_google_cloud', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:21', '2024-08-18 11:48:21'),
(88, 'enable_azure', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:22', '2024-08-18 11:48:22'),
(89, 'enable_generate_image', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:24', '2024-08-18 11:48:24'),
(90, 'enable_generate_image_step', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:25', '2024-08-18 11:48:25'),
(91, 'enable_generate_code', '1', 1, 1, 1, NULL, NULL, '2024-08-18 11:48:26', '2024-08-18 11:48:26'),
(92, 'order_code_prefix', 'WRITERAP#:', 1, 1, 1, NULL, NULL, '2024-08-18 11:50:06', '2024-08-18 11:50:06'),
(93, 'order_code_start', '001', 1, 1, 1, NULL, NULL, '2024-08-18 11:50:06', '2024-08-18 11:50:06'),
(94, 'invoice_thanksgiving', 'Thank you for purchasing from our store and for your order. it is awesome to have you as one of our paid users. We hope that you will be happy with Qlearly, if you ever have any questions, suggestions, or concerns please do not hesitate to contact us.', 1, 1, 1, NULL, NULL, '2024-08-18 11:50:06', '2024-08-18 11:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `system_setting_localizations`
--

CREATE TABLE `system_setting_localizations` (
  `id` bigint UNSIGNED NOT NULL,
  `system_setting_id` bigint UNSIGNED NOT NULL,
  `entity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `lang_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_site_id` bigint UNSIGNED DEFAULT NULL,
  `wp_id` int DEFAULT NULL,
  `is_wp_sync` int DEFAULT '0' COMMENT '1=WP Sync, 0=Not WP Sync'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint UNSIGNED NOT NULL,
  `is_default` tinyint NOT NULL DEFAULT '1' COMMENT 'Inbuilt Templates. is_default = 1, Custom Templates = 0',
  `is_favourite` tinyint NOT NULL DEFAULT '0',
  `is_popular` tinyint NOT NULL DEFAULT '0',
  `template_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fields` longtext COLLATE utf8mb4_unicode_ci,
  `prompt` longtext COLLATE utf8mb4_unicode_ci,
  `total_words_generated` bigint NOT NULL DEFAULT '0',
  `total_view` bigint NOT NULL DEFAULT '0',
  `total_favourite` bigint NOT NULL DEFAULT '0',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'TODO:: WHAT IS THE USE OF THIS FIELD?',
  `template_category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `is_default`, `is_favourite`, `is_popular`, `template_name`, `description`, `slug`, `icon`, `fields`, `prompt`, `total_words_generated`, `total_view`, `total_favourite`, `code`, `template_category_id`, `user_id`, `is_active`, `created_by_id`, `updated_by_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 'Blog Section', 'Write a blog section with the key points of your article', 'blog-section', NULL, '[{\"label\":\"Title of the blog\",\"is_required\":true,\"field\":{\"name\":\"title\",\"type\":\"text\",\"slug\":\"title\"}},{\"label\":\"What are the main points you want to cover?\",\"is_required\":true,\"field\":{\"name\":\"key_points\",\"type\":\"textarea\",\"slug\":\"key_points\"}}]', 'Write a complete article in english language on this topic {_title_} .Use following keywords in the article {_key_points_}', 0, 0, 0, 'blog-section', 1, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(2, 1, 0, 0, 'Blog Ideas', 'Generate blog ideas for your next post', 'blog-ideas', NULL, '[{\"label\": \"About what is your blog post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}}]', 'Write interesting blog ideas in english language based on this text {_about_} .Generate 10 appropriate blog titles in english language based on this text {_about_} .Write an interesting blog post intro in english language based on this text {_about_}.Blog post title {_title_}', 0, 0, 0, 'blog-ideas', 1, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(3, 1, 0, 0, 'Blog Title', 'Generate blog title for your next post', 'blog-title', NULL, '[{\"label\": \"About what is your blog post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}}]', 'Generate 10 appropriate blog titles in english language based on this text {_about_} .Write an interesting blog post intro in english language based on this text {_about_}.Blog post title {_title_}', 0, 0, 0, 'blog-title', 1, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(4, 1, 0, 0, 'Blog Intro', 'Generate blog intro for your next post', 'blog-intro', NULL, '[{\"label\": \"Title of the blog\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}},{\"label\": \"About what is your blog post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"\"}}]', 'Write an interesting blog post intro in english language based on this text {_about_}.Blog post title {_title_}', 0, 0, 0, 'blog-intro', 1, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(5, 1, 0, 0, 'Blog Conclusion', 'Generate blog conclusion for your next post', 'blog-conclusion', NULL, '[{\"label\": \"Title of the blog\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}},{\"label\": \"About what is your blog post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"\"}}]', 'Write an interesting blog conclusion in english language based on this text {_about_}.Blog post title {_title_}', 0, 0, 0, 'blog-conclusion', 1, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(6, 1, 0, 0, 'Blog Tags', 'Generate blog tags for your next post', 'blog-tags', NULL, '[{\"label\": \"About what is your blog post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}}]', 'Write blog tags in english language based on this text {_about_}', 0, 0, 0, 'blog-tags', 1, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(7, 1, 0, 0, 'Blog Summary', 'Generate blog summary for your next post', 'blog-summary', NULL, '[{\"label\": \"About what is your blog post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}}]', 'Write blog summary in english language based on this text {_about_}', 0, 0, 0, 'blog-summary', 1, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(8, 1, 0, 0, 'Confirmation Email', NULL, 'confirmation-email', NULL, '[{\"label\": \"What is recipient name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. Ryan Toland\"}},{\"label\": \"About what is your email?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Signing up to a web app\"}}]', 'Write a confirmation email in english language based on this text {_about_}. Recipient name {_name_}', 0, 0, 0, 'confirmation-email', 2, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(9, 1, 0, 0, 'Discount Email', NULL, 'discount-email', NULL, '[{\"label\": \"About what is your email?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Get discount on first purchase (of product name/from company name)\"}}]', 'Write a discount email in english language based on this text {_about_}', 0, 0, 0, 'discount-email', 2, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(10, 1, 0, 0, 'Testimonial Email', NULL, 'testimonial-email', NULL, '[{\"label\": \"What is recipient name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. Ryan Toland\"}},{\"label\": \"About what is your email?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. For serving the company with sincerity\"}}]', 'Write a testimonial email in english language based on this text {_about_}. Recipient name {_name_}', 0, 0, 0, 'testimonial-email', 2, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(11, 1, 0, 0, 'Promotional Email', NULL, 'promotional-email', NULL, '[{\"label\": \"What is recipient name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. Ryan Toland\"}},{\"label\": \"About what is your email?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. For serving the company with sincerity\"}}]', 'Write a promotional email in english language based on this text  {_about_} . Recipient name {_name_}.Write a follow up email in english language based on this text {_about_}', 0, 0, 0, 'promotional-email', 2, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(12, 1, 0, 0, 'Follow Up Email', NULL, 'follow-up-email', NULL, '[{\"label\": \"About what is your email?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Following up after an interview\"}}]', 'Write a follow up email in english language based on this text {_about_}', 0, 0, 0, 'follow-up-email', 2, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(13, 1, 0, 0, 'Twitter Post', NULL, 'twitter-post', NULL, '[{\"label\": \"About what is your post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Going to watch the champions league final\"}}]', 'Write a tweet in english language to post in twitter based on this text {_about_}', 0, 0, 0, 'twitter-post', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(14, 1, 0, 0, 'Discount Promotion', NULL, 'discount-promotion', NULL, '[{\"label\": \"What is title for the promotion?\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. Get exclusive discounts on Eid occasion\"}},{\"label\": \"About what is the discount?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Get discount on first purchase (of product name/from company name)\"}}]', 'Write a catchy promotional article in english language to give discount based on this text {_about_}. Title of the promotion is {_title_}', 0, 0, 0, 'discount-promotion', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(15, 1, 0, 0, 'Social Media Bio', NULL, 'social-media-bio', NULL, '[{\"label\": \"What are the main points you want to cover?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. Entrepreneur, Writer, Photographer\"}}]', 'Write bio in english language for social media using following keywords {_key_points_}', 0, 0, 0, 'social-media-bio', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(16, 1, 0, 0, 'Facebook Ads', NULL, 'facebook-ads', NULL, '[{\"label\": \"Who is your targetted audiences?\",\"is_required\": true,\"field\":{\"name\": \"audience\", \"slug\":\"audience\",\"type\": \"text\",\"placeholder\": \"e.g. Children, Couple\"}},{\"label\": \"What is the name of the product?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. iPhone 14 Pro\"}},{\"label\": \"Product Description\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type product description\"}}]', 'Write a Facebook Ads description in english language that makes your ad stand out and generates leads. Target audience {_audience_}. Product name {_name_} . Product description {_description_} .Write 10 captions in english language for instagram post based on this text {_about_}', 0, 0, 0, 'facebook-ads', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(17, 1, 0, 0, 'Instagram Captions', NULL, 'instagram-captions', NULL, '[{\"label\": \"About what is your instagram post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Travelling the world\"}}]', 'Write 10 captions in english language for instagram post based on this text {_about_}', 0, 0, 0, 'instagram-captions', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(18, 1, 0, 0, 'Social Media Post', NULL, 'social-media-post', NULL, '[{\"label\": \"About what is your post?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Travelling the world\"}}]', 'Write a complete social media post in english language based on this text {_about_}', 0, 0, 0, 'social-media-post', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(19, 1, 0, 0, 'Event Promotion', NULL, 'event-promotion', NULL, '[{\"label\": \"Title of the event\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. Celebration of victory day\"}},{\"label\": \"About what is your event?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type short description about the event\"}}]', 'Write a catchy promotional article in english language for an event based on this text {_about_}. Event title {_title_}', 0, 0, 0, 'event-promotion', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(20, 1, 0, 0, 'Google Ads Headlines', NULL, 'google-ads-headlines', NULL, '[{\"label\": \"Who is your targetted audience?\",\"is_required\": true,\"field\":{\"name\": \"audience\", \"slug\":\"audience\",\"type\": \"text\",\"placeholder\": \"e.g. Children, Couple\"}},{\"label\": \"What is the name of the product?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. iPhone 14 Pro\"}},{\"label\": \"Product Description\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type product description\"}}]', 'Write 10 catchy headlines in english language to promote your product with Google Ads. Target audience {_audience_}. Product name {_name_} .Product description {_description_}', 0, 0, 0, 'google-ads-headlines', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(21, 1, 0, 0, 'Google Ads Description', NULL, 'google-ads-description', NULL, '[{\"label\": \"Who is your targetted audience?\",\"is_required\": true,\"field\":{\"name\": \"audience\", \"slug\":\"audience\",\"type\": \"text\",\"placeholder\": \"e.g. Children, Couple\"}},{\"label\": \"What is the name of the product?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. iPhone 14 Pro\"}},{\"label\": \"Product Description\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type product description\"}}]', 'Write a Google Ads description in english language that makes your ad stand out and generates leads. Target audience {_audience_}. Product name {_name_} .Product description {_description_}', 0, 0, 0, 'google-ads-description', 3, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(22, 1, 0, 0, 'Youtube Video Title', NULL, 'youtube-video-title', NULL, '[{\"label\": \"About what is the video?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the video\"}}]', 'Write compelling YouTube video title in english language for the provided video description to get people interested in watching {_about_}', 0, 0, 0, 'youtube-video-title', 4, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(23, 1, 0, 0, 'Youtube Video Description', NULL, 'youtube-video-description', NULL, '[{\"label\": \"About what is the video?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the video\"}}]', 'Write compelling YouTube description in english language for the provided video description to get people interested in watching {_about_}', 0, 0, 0, 'youtube-video-description', 4, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(24, 1, 0, 0, 'Youtube Video Tag Generator', NULL, 'youtube-video-tag-generator', NULL, '[{\"label\": \"About what is the video?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the video\"}}]', 'Generate SEO-optimized YouTube tags and keywords in english language based on this text {_about_}', 0, 0, 0, 'youtube-video-tag-generator', 4, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(25, 1, 0, 0, 'Website FAQ', NULL, 'website-faq', NULL, '[{\"label\": \"About what is the FAQ?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"\"}}]', 'Generate list of 10 frequently asked questions in english language based on this text {_about_}', 0, 0, 0, 'website-faq', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(26, 1, 0, 0, 'Website FAQ Answers', NULL, 'website-faq-answers', NULL, '[{\"label\": \"What is the question?\",\"is_required\": true,\"field\":{\"name\": \"question\",\"slug\": \"question\",\"type\": \"text\",\"placeholder\": \"e.g. Do we provide support for 24/7?\"}}]', 'Write answer in english language for this faq question {_question_}.Write review in english language to submit on a website based on this text {_description_}.Product  {_name_}', 0, 0, 0, 'website-faq-answers', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(27, 1, 0, 0, 'Website Review', NULL, 'website-review', NULL, '[{\"label\": \"What is the name of the product?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. iPhone 14 Pro\"}},{\"label\": \"Product Description\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type product description\"}}]', 'Write review in english language to submit on a website based on this text {_description_}.Product  {_name_}', 0, 0, 0, 'website-review', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(28, 1, 0, 0, 'Website Title', NULL, 'website-title', NULL, '[{\"label\": \"About what is the website?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the website\"}}]', 'Write title in english language for a website based on this text {_about_}', 0, 0, 0, 'website-title', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(29, 1, 0, 0, 'Website Meta Tags', NULL, 'website-meta-tags', NULL, '[{\"label\": \"About what is the website?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the website\"}}]', 'Write meta keywords, meta title, meta description, meta author in english language for a website based on this text {_about_}', 0, 0, 0, 'website-meta-tags', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(30, 1, 0, 0, 'Website Meta Description', NULL, 'website-meta-description', NULL, '[{\"label\": \"About what is the website?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the website\"}}]', 'Write seo friendly meta description in english language for a website based on this text {_about_}', 0, 0, 0, 'website-meta-description', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(31, 1, 0, 0, 'Website About Us', NULL, 'website-about-us', NULL, '[{\"label\": \"About what is the website?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the website\"}}]', 'Generate about us content in english language for a website based on this text {_about_}', 0, 0, 0, 'website-about-us', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(32, 1, 0, 0, 'Website Terms And Conditions', NULL, 'website-terms-and-conditions', NULL, '[{\"label\": \"What is your website title?\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"Type title of the website\"}}]', 'Generate terms and conditions in english language for this website {_title_}', 0, 0, 0, 'website-terms-and-conditions', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(33, 1, 0, 0, 'Website Privacy Policy', NULL, 'website-privacy-policy', NULL, '[{\"label\": \"What is your website title?\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"Type title of the website\"}}]', 'Generate privacy policy in english language for this website {_title_}', 0, 0, 0, 'website-privacy-policy', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(34, 1, 0, 0, 'Vision of the Company', NULL, 'vision-of-the-company', NULL, '[{\"label\": \"What is your company name?\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"Type name of the company\"}},{\"label\": \"What is your company about?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"text\",\"placeholder\": \"Type about of the company\"}}]', 'Generate vision in english language for this company named: {_title_} Company details: {_about_}', 0, 0, 0, 'vision-of-the-company', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(35, 1, 0, 0, 'Mission of the Company', NULL, 'mission-of-the-company', NULL, '[{\"label\": \"What is your company name?\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"Type name of the company\"}},{\"label\": \"What is your company about?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"text\",\"placeholder\": \"Type about of the company\"}}]', 'Generate mission in english language for this company named:{_title_} Company details: {_about_}', 0, 0, 0, 'mission-of-the-company', 5, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(36, 1, 0, 0, 'Academic Essay', NULL, 'academic-essay', NULL, '[{\"label\": \"Title of the essay\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. The Newspaper\"}}]', 'Write an academic essay in english language for the title or topic:{_title_}', 0, 0, 0, 'academic-essay', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(37, 1, 0, 0, 'Article Generator', NULL, 'article-generator', NULL, '[{\"label\": \"Title of the article\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}},{\"label\": \"What are the main points you want to cover?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. dosa, biriyani, tandoori chicken\"}}]', 'Write a complete article in english language on this topic {_title_} .Use following keywords in the article {_key_points_}', 0, 0, 0, 'article-generator', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(38, 1, 0, 0, 'Paragraph Generator', NULL, 'paragraph-generator', NULL, '[{\"label\": \"Title of the paragraph\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. best restaurants in LA to eat indian foods\"}},{\"label\": \"What are the main points you want to cover?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. dosa, biriyani, tandoori chicken\"}}]', 'Write paragraph in english language on this topic {_title_} .Use following keywords in the article {_key_points_}', 0, 0, 0, 'paragraph-generator', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(39, 1, 0, 0, 'Content Rewriter', NULL, 'content-rewriter', NULL, '[{\"label\": \"What would you like to rewrite?\",\"is_required\": true,\"field\":{\"name\": \"contents\",\"slug\":\"contents\",\"type\": \"textarea\",\"placeholder\": \"Type your content here to rewrite\"}},{\"label\": \"What are the main points you want to cover?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. key point 1, key point 2\"}}]', 'Rewrite this content in english language {_contents_}. Focus on the following keywords while generating the content {_key_points_}', 0, 0, 0, 'content-rewriter', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(40, 1, 0, 0, 'Product Description', NULL, 'product-description', NULL, '[{\"label\": \"What is the name of the product?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. iPhone 14 Pro\"}}]', 'Write a long creative product description in english language for {_name_}', 0, 0, 0, 'product-description', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(41, 1, 0, 0, 'Product Name Generator', NULL, 'product-name-generator', NULL, '[{\"label\": \"Product Description\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type product description\"}}]', 'Create creative product names in english language based on the description {_description_}.Summarize this text in english language in a short concise way {_description_}.Product name {_name_}', 0, 0, 0, 'product-name-generator', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(42, 1, 0, 0, 'Product Summarize Text', NULL, 'product-summarize-text', NULL, '[{\"label\": \"What is the name of the product?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. iPhone 14 Pro\"}},{\"label\": \"Product Description\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type product description\"}}]', 'Summarize this text in english language in a short concise way {_description_}.Product name {_name_}', 0, 0, 0, 'product-summarize-text', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(43, 1, 0, 0, 'Grammar Checker', NULL, 'grammar-checker', NULL, '[{\"label\": \"Type content you would like to check grammar\",\"is_required\": true,\"field\":{\"name\": \"contents\",\"slug\":\"contents\",\"type\": \"textarea\",\"placeholder\": \"Type your content here to check grammar\"}}]', 'Check and correct grammar of this text {_contents_}', 0, 0, 0, 'grammar-checker', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(44, 1, 0, 0, 'Creative Story', NULL, 'creative-story', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Generate an interesting creative story in english language based on this text {_about_}', 0, 0, 0, 'creative-story', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(45, 1, 0, 0, 'Startup Name Generator', NULL, 'startup-name-generator', NULL, '[{\"label\": \"Start Up Description\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type start up description\"}}]', 'Generate start up names in english language based on this text {_description_}', 0, 0, 0, 'startup-name-generator', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(46, 1, 0, 0, 'Pros & Cons', NULL, 'pros-cons', NULL, '[{\"label\": \"What is the topic?\",\"is_required\": true,\"field\":{\"name\": \"topic\",\"type\": \"text\",\"placeholder\": \"e.g. Using mobile phone\"}}]', 'Write pros and cons in english language of the topic {_topic_}.Write job description in english language based on the requirements {_requirements_}. Job position {_position_}', 0, 0, 0, 'pros-cons', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:05', '2024-06-12 12:49:25'),
(47, 1, 0, 0, 'Job Description', NULL, 'job-description', NULL, '[{\"label\": \"What is the job position?\",\"is_required\": true,\"field\":{\"name\": \"position\",\"type\": \"text\",\"placeholder\": \"e.g. What is the position of the job?\"}},{\"label\": \"What are the core requirements?\",\"is_required\": true,\"field\":{\"name\": \"requirements\",\"type\": \"textarea\",\"placeholder\": \"Type requirements for the position\"}}]', 'Write job description in english language based on the requirements {_requirements_}. Job position {_position_}', 0, 0, 0, 'job-description', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(48, 1, 0, 0, 'Rejection Letter', NULL, 'rejection-letter', NULL, '[{\"label\": \"What is recipient name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. Ryan Toland\"}},{\"label\": \"About what is the rejection letter?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Rejection letter of the job application for the position of software engineer\"}}]', 'Write a rejection letter in english language based on this text {_about_} Recipient name {_name_}', 0, 0, 0, 'rejection-letter', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(49, 1, 0, 0, 'Offer Letter', NULL, 'offer-letter', NULL, '[{\"label\": \"What is recipient name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. Ryan Toland\"}},{\"label\": \"About what is the offer letter?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Offer letter of the job for the position of software engineer\"}}]', 'Write an offer letter in english language based on this text  {_about_} Recipient name {_name_}', 0, 0, 0, 'offer-letter', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(50, 1, 0, 0, 'Promotion Letter', NULL, 'promotion-letter', NULL, '[{\"label\": \"What is recipient name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. Ryan Toland\"}},{\"label\": \"What was the previous position?\",\"is_required\": true,\"field\":{\"name\": \"previous_position\",\"slug\": \"previous-position\",\"type\": \"text\",\"placeholder\": \"e.g. Junior executive\"}},{\"label\": \"What is the new position?\",\"is_required\": true,\"field\":{\"name\": \"new_position\",\"slug\": \"new-position\",\"type\": \"text\",\"placeholder\": \"e.g. Executive\"}}]', 'Write a promotion letter in english language Recipient name {_name_} Previous position {_previous_position_} New position {_news_position_}', 0, 0, 0, 'promotion-letter', 6, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(51, 1, 0, 0, 'Motivational Quote', NULL, 'motivational-quote', NULL, '[{\"label\": \"About what you want to generate motivational quote?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"e.g. Emotional breakdown, economical breakdown, career issue\"}}]', 'Write inspiring motivational quotes in english language to overcome the given situations  {_about_}', 0, 0, 0, 'motivational-quote', 7, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(52, 1, 0, 0, 'Song Lyrics', NULL, 'song-lyrics', NULL, '[{\"label\": \"Title of the song and name of the singer/writer\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"e.g. 500 miles by Hedy West\"}}]', 'Write full song lyrics of {_title_}', 0, 0, 0, 'song-lyrics', 7, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(53, 1, 0, 0, 'Short Story', NULL, 'short-story', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write a creative short story in english language based on this text {_about_}', 0, 0, 0, 'short-story', 7, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(54, 1, 0, 0, 'Wedding Quote', NULL, 'wedding-quote', NULL, '[{\"label\": \"What are the key points?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. Love, Forever, Soulmate\"}}]', 'Write lovely wedding quotes in english language based on these keywords {_key_points_}', 0, 0, 0, 'wedding-quote', 7, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(55, 1, 0, 0, 'Birthday Wish Quote', NULL, 'birthday-wish-quote', NULL, '[{\"label\": \"What are the key points?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. Long live, happy\"}}]', 'Write birthday wish quotes in english language based on these keywords {_key_points_}', 0, 0, 0, 'birthday-wish-quote', 7, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(56, 1, 0, 0, 'Story Outline', NULL, 'story-outline', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write the outline of the story in english language for medium.com based on this description {_about_}', 0, 0, 0, 'story-outline', 8, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(57, 1, 0, 0, 'Story Title & Subtitle', NULL, 'story-title-subtitle', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write the title & subtitle of the story in english language for medium.com based on this description  {_about_}', 0, 0, 0, 'story-title-subtitle', 8, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(58, 1, 0, 0, 'Story Ideas', NULL, 'story-ideas', NULL, '[{\"label\": \"What are the key points?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. Benefit of new AI technologies\"}}]', 'Write interesting story ideas in english language for medium.com based on these keywords {_key_points_}', 0, 0, 0, 'story-ideas', 8, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(59, 1, 0, 0, 'TikTok Video Script', NULL, 'tiktok-video-script', NULL, '[{\"label\": \"What are the key points?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. Fun, prank, popular tune\"}}]', 'Write interesting tiktok video script in english language based on these keywords {_key_points_}', 0, 0, 0, 'tiktok-video-script', 9, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(60, 1, 0, 0, 'TikTok Video Caption', NULL, 'tiktok-video-caption', NULL, '[{\"label\": \"About what is the video?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the video\"}}]', '', 0, 0, 0, 'tiktok-video-caption', 9, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(61, 1, 0, 0, 'Video Ideas', NULL, 'video-ideas', NULL, '[{\"label\": \"What are the key points?\",\"is_required\": true,\"field\":{\"name\": \"key_points\",\"type\": \"textarea\",\"placeholder\": \"e.g. Fun, prank, popular tune\"}}]', 'Write interesting video ideas in english language based on these keywords {_key_points_}', 0, 0, 0, 'video-ideas', 9, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(62, 1, 0, 0, 'Instagram Story Ideas', NULL, 'instagram-story-ideas', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write interesting instagram story ideas in english language based on this description {_about_}', 0, 0, 0, 'instagram-story-ideas', 10, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(63, 1, 0, 0, 'Instagram Post Ideas', NULL, 'instagram-post-ideas', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write interesting instagram post ideas in english language based on this description {_about_}', 0, 0, 0, 'instagram-post-ideas', 10, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(64, 1, 0, 0, 'Instagram Reel Ideas', NULL, 'instagram-reel-ideas', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write interesting instagram reel ideas in english language based on this description {_about_}', 0, 0, 0, 'instagram-reel-ideas', 10, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(65, 1, 0, 0, 'Career', NULL, 'career', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write success story of career in english language based on this description {_about_}', 0, 0, 0, 'career', 11, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(66, 1, 0, 0, 'Business', NULL, 'business', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write success story of business in english language based on this description {_about_}', 0, 0, 0, 'business', 11, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(67, 1, 0, 0, 'Start up', NULL, 'start-up', NULL, '[{\"label\": \"About what is the story?\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write success story of start up in english language based on this description {_about_}', 0, 0, 0, 'start-up', 11, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(68, 1, 0, 0, 'Matrimonial Website', NULL, 'matrimonial-website', NULL, '[{\"label\": \"What are partners name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"e.g. Bride: Tanu, Bridegroom: Manu\"}},{\"label\": \"Description of their journey\",\"is_required\": true,\"field\":{\"name\": \"about\", \"slug\":\"about\",\"type\": \"textarea\",\"placeholder\": \"Type description of the story\"}}]', 'Write success story for matrimonial website in english language based on this description {_about_} Partners name {_name_}', 0, 0, 0, 'matrimonial-website', 11, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(69, 1, 0, 0, 'Blog Post SEO Meta Description', NULL, 'blog-post-seo-meta-description', NULL, '[{\"label\": \"What is your blog title?\",\"is_required\": true,\"field\":{\"name\": \"title\", \"slug\":\"title\",\"type\": \"text\",\"placeholder\": \"\"}},{\"label\": \"Description of your blog\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type description of the blog\"}}]', 'Write seo friendly meta description in english language for this blog {_title_} .Blog Description {_description_}', 0, 0, 0, 'blog-post-seo-meta-description', 12, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(70, 1, 0, 0, 'Home Page SEO Meta Description', NULL, 'home-page-seo-meta-description', NULL, '[{\"label\": \"What is your website branding name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"\"}},{\"label\": \"Description of your website\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type description of the website\"}}]', 'Write seo friendly meta description in english language for this website {_name_}. Website Description {_description_}', 0, 0, 0, 'home-page-seo-meta-description', 12, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25'),
(71, 1, 0, 0, 'Product Page SEO Meta Description', NULL, 'product-page-seo-meta-description', NULL, '[{\"label\": \"What is your product name?\",\"is_required\": true,\"field\":{\"name\": \"name\",\"slug\":\"name\",\"type\": \"text\",\"placeholder\": \"\"}},{\"label\": \"Description of your product\",\"is_required\": true,\"field\":{\"name\": \"description\", \"slug\":\"description\",\"type\": \"textarea\",\"placeholder\": \"Type description of the product\"}}]', 'Write seo friendly meta description in english language for this product {_name_} .Product Description {_description_}', 0, 0, 0, 'product-page-seo-meta-description', 12, 1, 1, 1, 1, NULL, '2024-04-16 11:48:06', '2024-06-12 12:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `template_categories`
--

CREATE TABLE `template_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_categories`
--

INSERT INTO `template_categories` (`id`, `category_name`, `slug`, `icon`, `is_active`, `user_id`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Blog Contents', 'blog-contents', '<i class = \"las la-book-reader\"></i>', 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Email Templates', 'email-templates', '<i class = \"las la-envelope-open-text\"></i>', 1, 1, 1, NULL, NULL, NULL, NULL),
(3, 'Social Media', 'social-media', 'share-8', 1, 1, 1, NULL, NULL, NULL, NULL),
(4, 'Videos', 'videos', 'video', 1, 1, 1, NULL, NULL, NULL, NULL),
(5, 'Website Contents', 'website-contents', 'monitor', 1, 1, 1, NULL, NULL, NULL, NULL),
(6, 'General Contents', 'general-contents', 'file-text', 1, 1, 1, NULL, NULL, NULL, NULL),
(7, 'Fun or Quote', 'fun-or-quote', 'tv', 1, 1, 1, NULL, NULL, NULL, NULL),
(8, 'Medium', 'medium', 'code', 1, 1, 1, NULL, NULL, NULL, NULL),
(9, 'TikTok', 'tikTok', 'film', 1, 1, 1, NULL, NULL, NULL, NULL),
(10, 'Instagram', 'Instagram', 'instagram', 1, 1, 1, NULL, NULL, NULL, NULL),
(11, 'Success Story', 'success-story', 'smile', 1, 1, 1, NULL, NULL, NULL, NULL),
(12, 'SEO Tools', 'seo-tools', 'file-text', 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `text_to_speeches`
--

CREATE TABLE `text_to_speeches` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `break` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `response` longtext COLLATE utf8mb4_unicode_ci,
  `speech` text COLLATE utf8mb4_unicode_ci,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `audioName` text COLLATE utf8mb4_unicode_ci,
  `hash` text COLLATE utf8mb4_unicode_ci,
  `credits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `words` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'local/aws',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=OpenAi, 2=Stable Diffusion(SD), 3=ElevenLabs, 4=Azure TTS, 5=Google TTS, 6=whisper, 7= geminiAi',
  `subscription_user_id` bigint UNSIGNED DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme_tag_modules`
--

CREATE TABLE `theme_tag_modules` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `is_paid` tinyint(1) DEFAULT '0',
  `is_verified` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `purchase_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_tag_modules`
--

INSERT INTO `theme_tag_modules` (`id`, `name`, `is_default`, `is_paid`, `is_verified`, `is_active`, `description`, `purchase_code`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'WordpressBlog', 1, 0, 0, 1, NULL, NULL, NULL, '2024-08-25 08:15:39', '2024-08-25 08:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `priority_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_files`
--

CREATE TABLE `ticket_files` (
  `id` bigint UNSIGNED NOT NULL,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `ticket_id` bigint UNSIGNED DEFAULT NULL,
  `replied_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` tinyint NOT NULL COMMENT '1 = Admin, 2 = Admin Staff, 3 = customer, 4 = customer team',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_plan_id` bigint UNSIGNED DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code_expired_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_permission_version` int NOT NULL DEFAULT '0',
  `user_balance` double NOT NULL DEFAULT '0',
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_clicks` int NOT NULL DEFAULT '0',
  `referred_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_commission_calculated` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_user_id`, `name`, `email`, `mobile_no`, `user_type`, `password`, `avatar`, `subscription_plan_id`, `verification_code`, `verification_code_expired_at`, `email_verified_at`, `provider_id`, `provider_type`, `menu_permission_version`, `user_balance`, `referral_code`, `num_of_clicks`, `referred_user_id`, `is_commission_calculated`, `remember_token`, `is_active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, NULL, 'Admin', 'admin@themetags.com', NULL, 1, '$2y$12$LLwZkFMj3Y5ygKVfIcwIx.uelsVXY2OrDo9oFboP7tIEsAH9631Gm', NULL, NULL, NULL, NULL, '2024-08-25 08:08:50', NULL, NULL, 0, 0, NULL, 0, NULL, 1, NULL, 1, NULL, NULL, '2024-08-25 14:15:39', '2024-08-25 14:15:50', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_balances`
--

CREATE TABLE `user_balances` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=OpenAi, 2=Stable Diffusion(SD), 3=ElevenLabs, 4=Azure TTS, 5=Google TTS, 6=whisper, 7= geminiAi',
  `word_balance` int NOT NULL DEFAULT '0',
  `image_balance` int NOT NULL DEFAULT '0',
  `speech_balance` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_sites`
--

CREATE TABLE `user_sites` (
  `id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Site Title/Name',
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Application Password',
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `is_connection` tinyint(1) DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webhook_histories`
--

CREATE TABLE `webhook_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ex. stripe/paypal etc',
  `webhook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incoming_json` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hook_payloads` json DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_authors`
--

CREATE TABLE `wp_authors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_site_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_blog_posts`
--

CREATE TABLE `wp_blog_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` json DEFAULT NULL,
  `categories` json DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `featured_media` int DEFAULT NULL,
  `wp_id` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_site_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_settings`
--

CREATE TABLE `wp_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Inactive',
  `entity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_senses`
--
ALTER TABLE `ad_senses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_senses_user_id_foreign` (`user_id`),
  ADD KEY `ad_senses_created_by_id_foreign` (`created_by_id`),
  ADD KEY `ad_senses_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `affiliate_earnings`
--
ALTER TABLE `affiliate_earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiliate_earnings_user_id_foreign` (`user_id`),
  ADD KEY `affiliate_earnings_subscription_user_id_foreign` (`subscription_user_id`);

--
-- Indexes for table `affiliate_payments`
--
ALTER TABLE `affiliate_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiliate_payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `affiliate_payout_accounts`
--
ALTER TABLE `affiliate_payout_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiliate_payout_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `ai_prompt_requests`
--
ALTER TABLE `ai_prompt_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ai_prompt_requests_engine_id_foreign` (`engine_id`),
  ADD KEY `ai_prompt_requests_user_id_foreign` (`user_id`),
  ADD KEY `ai_prompt_requests_created_by_id_foreign` (`created_by_id`),
  ADD KEY `ai_prompt_requests_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `ai_writers`
--
ALTER TABLE `ai_writers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ai_writers_user_id_foreign` (`user_id`),
  ADD KEY `ai_writers_folder_id_foreign` (`folder_id`),
  ADD KEY `ai_writers_subscription_user_id_foreign` (`subscription_user_id`),
  ADD KEY `ai_writers_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `ai_writers_template_id_foreign` (`template_id`),
  ADD KEY `ai_writers_created_by_id_foreign` (`created_by_id`),
  ADD KEY `ai_writers_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_user_id_foreign` (`user_id`),
  ADD KEY `articles_subscription_user_id_foreign` (`subscription_user_id`),
  ADD KEY `articles_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `articles_keyword_generated_content_id_foreign` (`keyword_generated_content_id`),
  ADD KEY `articles_title_generated_content_id_foreign` (`title_generated_content_id`),
  ADD KEY `articles_outline_generated_content_id_foreign` (`outline_generated_content_id`),
  ADD KEY `articles_article_generated_content_id_foreign` (`article_generated_content_id`),
  ADD KEY `articles_created_by_id_foreign` (`created_by_id`),
  ADD KEY `articles_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_tickets_ticket_id_foreign` (`ticket_id`),
  ADD KEY `assign_tickets_assign_user_id_foreign` (`assign_user_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_blog_category_id_foreign` (`blog_category_id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`),
  ADD KEY `blogs_created_by_id_foreign` (`created_by_id`),
  ADD KEY `blogs_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_blog_categories_unique` (`category_name`,`user_id`),
  ADD KEY `blog_categories_parent_category_id_foreign` (`parent_category_id`),
  ADD KEY `blog_categories_user_id_foreign` (`user_id`),
  ADD KEY `blog_categories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `blog_categories_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `blog_categories_user_site_id_foreign` (`user_site_id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_tags_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `chat_categories`
--
ALTER TABLE `chat_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_name_unique` (`category_name`,`user_id`),
  ADD KEY `chat_categories_user_id_foreign` (`user_id`),
  ADD KEY `chat_categories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `chat_categories_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `chat_experts`
--
ALTER TABLE `chat_experts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_experts_user_id_foreign` (`user_id`),
  ADD KEY `chat_experts_created_by_id_foreign` (`created_by_id`),
  ADD KEY `chat_experts_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `chat_prompts`
--
ALTER TABLE `chat_prompts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_prompts_chat_category_id_foreign` (`chat_category_id`),
  ADD KEY `chat_prompts_user_id_foreign` (`user_id`),
  ADD KEY `chat_prompts_created_by_id_foreign` (`created_by_id`),
  ADD KEY `chat_prompts_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `chat_threads`
--
ALTER TABLE `chat_threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_threads_chat_expert_id_foreign` (`chat_expert_id`),
  ADD KEY `chat_threads_user_id_foreign` (`user_id`),
  ADD KEY `chat_threads_created_by_id_foreign` (`created_by_id`),
  ADD KEY `chat_threads_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `chat_thread_messages`
--
ALTER TABLE `chat_thread_messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chat_thread_messages_random_number_unique` (`random_number`),
  ADD KEY `chat_thread_messages_generated_image_id_foreign` (`generated_image_id`),
  ADD KEY `chat_thread_messages_subscription_user_id_foreign` (`subscription_user_id`),
  ADD KEY `chat_thread_messages_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `chat_thread_messages_chat_thread_id_foreign` (`chat_thread_id`),
  ADD KEY `chat_thread_messages_chat_expert_id_foreign` (`chat_expert_id`),
  ADD KEY `chat_thread_messages_user_id_foreign` (`user_id`),
  ADD KEY `chat_thread_messages_created_by_id_foreign` (`created_by_id`),
  ADD KEY `chat_thread_messages_updated_by_id_foreign` (`updated_by_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `engines`
--
ALTER TABLE `engines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `engines_user_id_foreign` (`user_id`),
  ADD KEY `engines_created_by_id_foreign` (`created_by_id`),
  ADD KEY `engines_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `engine_features`
--
ALTER TABLE `engine_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `engine_features_user_id_foreign` (`user_id`),
  ADD KEY `engine_features_created_by_id_foreign` (`created_by_id`),
  ADD KEY `engine_features_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `experts`
--
ALTER TABLE `experts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_slug` (`slug`,`user_id`),
  ADD KEY `experts_expert_category_id_foreign` (`expert_category_id`),
  ADD KEY `experts_user_id_foreign` (`user_id`),
  ADD KEY `experts_created_by_id_foreign` (`created_by_id`),
  ADD KEY `experts_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `expert_categories`
--
ALTER TABLE `expert_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_slug` (`slug`,`user_id`),
  ADD KEY `expert_categories_user_id_foreign` (`user_id`),
  ADD KEY `expert_categories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `expert_categories_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_folder_unique` (`folder_name`,`user_id`),
  ADD KEY `folders_user_id_foreign` (`user_id`),
  ADD KEY `folders_created_by_id_foreign` (`created_by_id`),
  ADD KEY `folders_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_a_q_s_user_id_foreign` (`user_id`),
  ADD KEY `f_a_q_s_created_by_id_foreign` (`created_by_id`),
  ADD KEY `f_a_q_s_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `generated_contents`
--
ALTER TABLE `generated_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generated_contents_user_id_foreign` (`user_id`),
  ADD KEY `generated_contents_folder_id_foreign` (`folder_id`),
  ADD KEY `generated_contents_subscription_user_id_foreign` (`subscription_user_id`),
  ADD KEY `generated_contents_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `generated_contents_template_id_foreign` (`template_id`),
  ADD KEY `generated_contents_created_by_id_foreign` (`created_by_id`),
  ADD KEY `generated_contents_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `generated_images`
--
ALTER TABLE `generated_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generated_images_user_id_foreign` (`user_id`),
  ADD KEY `generated_images_folder_id_foreign` (`folder_id`),
  ADD KEY `generated_images_subscription_user_id_foreign` (`subscription_user_id`),
  ADD KEY `generated_images_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `generated_images_template_id_foreign` (`template_id`),
  ADD KEY `generated_images_created_by_id_foreign` (`created_by_id`),
  ADD KEY `generated_images_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grass_period_payments_user_id_foreign` (`user_id`),
  ADD KEY `grass_period_payments_subscription_plan_id_foreign` (`subscription_plan_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offline_payment_methods_user_id_foreign` (`user_id`),
  ADD KEY `offline_payment_methods_created_by_id_foreign` (`created_by_id`),
  ADD KEY `offline_payment_methods_updated_by_id_foreign` (`updated_by_id`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway_product_histories`
--
ALTER TABLE `payment_gateway_product_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateway_product_histories_subscription_plan_id_foreign` (`subscription_plan_id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_uuid_unique` (`uuid`),
  ADD KEY `posts_ai_prompt_request_id_foreign` (`ai_prompt_request_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_created_by_id_foreign` (`created_by_id`),
  ADD KEY `posts_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reply_tickets_ticket_id_foreign` (`ticket_id`),
  ADD KEY `reply_tickets_replied_by_foreign` (`replied_by`),
  ADD KEY `reply_tickets_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_role_unique` (`name`,`user_id`),
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
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
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
-- Indexes for table `subscription_plan_templates`
--
ALTER TABLE `subscription_plan_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_plan_templates_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `subscription_plan_templates_template_id_foreign` (`template_id`),
  ADD KEY `subscription_plan_templates_user_id_foreign` (`user_id`),
  ADD KEY `subscription_plan_templates_created_by_id_foreign` (`created_by_id`),
  ADD KEY `subscription_plan_templates_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `subscription_recurring_payments`
--
ALTER TABLE `subscription_recurring_payments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_slug` (`slug`,`user_id`),
  ADD KEY `tags_user_id_foreign` (`user_id`),
  ADD KEY `tags_created_by_id_foreign` (`created_by_id`),
  ADD KEY `tags_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `tags_user_site_id_foreign` (`user_site_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_slug` (`slug`,`user_id`),
  ADD KEY `templates_template_category_id_foreign` (`template_category_id`),
  ADD KEY `templates_user_id_foreign` (`user_id`),
  ADD KEY `templates_created_by_id_foreign` (`created_by_id`),
  ADD KEY `templates_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `template_categories`
--
ALTER TABLE `template_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_template_categories_unique` (`category_name`,`user_id`),
  ADD KEY `template_categories_user_id_foreign` (`user_id`),
  ADD KEY `template_categories_created_by_id_foreign` (`created_by_id`),
  ADD KEY `template_categories_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `text_to_speeches`
--
ALTER TABLE `text_to_speeches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `text_to_speeches_subscription_user_id_foreign` (`subscription_user_id`),
  ADD KEY `text_to_speeches_subscription_plan_id_foreign` (`subscription_plan_id`),
  ADD KEY `text_to_speeches_user_id_foreign` (`user_id`),
  ADD KEY `text_to_speeches_created_by_id_foreign` (`created_by_id`),
  ADD KEY `text_to_speeches_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `theme_tag_modules`
--
ALTER TABLE `theme_tag_modules`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `ticket_files_replied_id_foreign` (`replied_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_parent_user_id_foreign` (`parent_user_id`),
  ADD KEY `users_created_by_id_foreign` (`created_by_id`),
  ADD KEY `users_updated_by_id_foreign` (`updated_by_id`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `user_balances`
--
ALTER TABLE `user_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_balances_user_id_foreign` (`user_id`);

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
-- Indexes for table `user_sites`
--
ALTER TABLE `user_sites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_sites_user_id_foreign` (`user_id`),
  ADD KEY `user_sites_created_by_id_foreign` (`created_by_id`),
  ADD KEY `user_sites_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `webhook_histories`
--
ALTER TABLE `webhook_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_authors`
--
ALTER TABLE `wp_authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wp_authors_email_unique` (`email`),
  ADD UNIQUE KEY `wp_authors_username_unique` (`username`),
  ADD KEY `wp_authors_user_site_id_foreign` (`user_site_id`),
  ADD KEY `wp_authors_user_id_foreign` (`user_id`),
  ADD KEY `wp_authors_created_by_id_foreign` (`created_by_id`),
  ADD KEY `wp_authors_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `wp_blog_posts`
--
ALTER TABLE `wp_blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wp_blog_posts_article_id_foreign` (`article_id`),
  ADD KEY `wp_blog_posts_user_site_id_foreign` (`user_site_id`),
  ADD KEY `wp_blog_posts_user_id_foreign` (`user_id`),
  ADD KEY `wp_blog_posts_created_by_id_foreign` (`created_by_id`),
  ADD KEY `wp_blog_posts_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `wp_settings`
--
ALTER TABLE `wp_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wp_settings_user_id_foreign` (`user_id`),
  ADD KEY `wp_settings_created_by_id_foreign` (`created_by_id`),
  ADD KEY `wp_settings_updated_by_id_foreign` (`updated_by_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_senses`
--
ALTER TABLE `ad_senses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `affiliate_earnings`
--
ALTER TABLE `affiliate_earnings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `affiliate_payments`
--
ALTER TABLE `affiliate_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `affiliate_payout_accounts`
--
ALTER TABLE `affiliate_payout_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_prompt_requests`
--
ALTER TABLE `ai_prompt_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_writers`
--
ALTER TABLE `ai_writers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_categories`
--
ALTER TABLE `chat_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_experts`
--
ALTER TABLE `chat_experts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat_prompts`
--
ALTER TABLE `chat_prompts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_threads`
--
ALTER TABLE `chat_threads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_thread_messages`
--
ALTER TABLE `chat_thread_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_feedback`
--
ALTER TABLE `client_feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `engines`
--
ALTER TABLE `engines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `engine_features`
--
ALTER TABLE `engine_features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `experts`
--
ALTER TABLE `experts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert_categories`
--
ALTER TABLE `expert_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `generated_contents`
--
ALTER TABLE `generated_contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generated_images`
--
ALTER TABLE `generated_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `localizations`
--
ALTER TABLE `localizations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `media_managers`
--
ALTER TABLE `media_managers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_gateway_details`
--
ALTER TABLE `payment_gateway_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `payment_gateway_products`
--
ALTER TABLE `payment_gateway_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateway_product_histories`
--
ALTER TABLE `payment_gateway_product_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storage_managers`
--
ALTER TABLE `storage_managers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribed_users`
--
ALTER TABLE `subscribed_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_plan_templates`
--
ALTER TABLE `subscription_plan_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_recurring_payments`
--
ALTER TABLE `subscription_recurring_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_users`
--
ALTER TABLE `subscription_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_user_usages`
--
ALTER TABLE `subscription_user_usages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_categories`
--
ALTER TABLE `support_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_priorities`
--
ALTER TABLE `support_priorities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `system_setting_localizations`
--
ALTER TABLE `system_setting_localizations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `template_categories`
--
ALTER TABLE `template_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `text_to_speeches`
--
ALTER TABLE `text_to_speeches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_tag_modules`
--
ALTER TABLE `theme_tag_modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_files`
--
ALTER TABLE `ticket_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_balances`
--
ALTER TABLE `user_balances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sites`
--
ALTER TABLE `user_sites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `webhook_histories`
--
ALTER TABLE `webhook_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_authors`
--
ALTER TABLE `wp_authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_blog_posts`
--
ALTER TABLE `wp_blog_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_settings`
--
ALTER TABLE `wp_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_senses`
--
ALTER TABLE `ad_senses`
  ADD CONSTRAINT `ad_senses_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ad_senses_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ad_senses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `affiliate_earnings`
--
ALTER TABLE `affiliate_earnings`
  ADD CONSTRAINT `affiliate_earnings_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `affiliate_earnings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `affiliate_payments`
--
ALTER TABLE `affiliate_payments`
  ADD CONSTRAINT `affiliate_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `affiliate_payout_accounts`
--
ALTER TABLE `affiliate_payout_accounts`
  ADD CONSTRAINT `affiliate_payout_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ai_prompt_requests`
--
ALTER TABLE `ai_prompt_requests`
  ADD CONSTRAINT `ai_prompt_requests_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ai_prompt_requests_engine_id_foreign` FOREIGN KEY (`engine_id`) REFERENCES `engines` (`id`),
  ADD CONSTRAINT `ai_prompt_requests_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ai_prompt_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ai_writers`
--
ALTER TABLE `ai_writers`
  ADD CONSTRAINT `ai_writers_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ai_writers_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`),
  ADD CONSTRAINT `ai_writers_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `ai_writers_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `ai_writers_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`),
  ADD CONSTRAINT `ai_writers_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ai_writers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_article_generated_content_id_foreign` FOREIGN KEY (`article_generated_content_id`) REFERENCES `generated_contents` (`id`),
  ADD CONSTRAINT `articles_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `articles_keyword_generated_content_id_foreign` FOREIGN KEY (`keyword_generated_content_id`) REFERENCES `generated_contents` (`id`),
  ADD CONSTRAINT `articles_outline_generated_content_id_foreign` FOREIGN KEY (`outline_generated_content_id`) REFERENCES `generated_contents` (`id`),
  ADD CONSTRAINT `articles_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `articles_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `articles_title_generated_content_id_foreign` FOREIGN KEY (`title_generated_content_id`) REFERENCES `generated_contents` (`id`),
  ADD CONSTRAINT `articles_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  ADD CONSTRAINT `assign_tickets_assign_user_id_foreign` FOREIGN KEY (`assign_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `assign_tickets_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blogs_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blogs_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `blog_categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blog_categories_parent_category_id_foreign` FOREIGN KEY (`parent_category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blog_categories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blog_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blog_categories_user_site_id_foreign` FOREIGN KEY (`user_site_id`) REFERENCES `user_sites` (`id`);

--
-- Constraints for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD CONSTRAINT `blog_tags_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`),
  ADD CONSTRAINT `blog_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `chat_categories`
--
ALTER TABLE `chat_categories`
  ADD CONSTRAINT `chat_categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_categories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat_experts`
--
ALTER TABLE `chat_experts`
  ADD CONSTRAINT `chat_experts_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_experts_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_experts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat_prompts`
--
ALTER TABLE `chat_prompts`
  ADD CONSTRAINT `chat_prompts_chat_category_id_foreign` FOREIGN KEY (`chat_category_id`) REFERENCES `chat_categories` (`id`),
  ADD CONSTRAINT `chat_prompts_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_prompts_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_prompts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat_threads`
--
ALTER TABLE `chat_threads`
  ADD CONSTRAINT `chat_threads_chat_expert_id_foreign` FOREIGN KEY (`chat_expert_id`) REFERENCES `chat_experts` (`id`),
  ADD CONSTRAINT `chat_threads_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_threads_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_threads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat_thread_messages`
--
ALTER TABLE `chat_thread_messages`
  ADD CONSTRAINT `chat_thread_messages_chat_expert_id_foreign` FOREIGN KEY (`chat_expert_id`) REFERENCES `chat_experts` (`id`),
  ADD CONSTRAINT `chat_thread_messages_chat_thread_id_foreign` FOREIGN KEY (`chat_thread_id`) REFERENCES `chat_threads` (`id`),
  ADD CONSTRAINT `chat_thread_messages_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_thread_messages_generated_image_id_foreign` FOREIGN KEY (`generated_image_id`) REFERENCES `generated_images` (`id`),
  ADD CONSTRAINT `chat_thread_messages_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `chat_thread_messages_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `chat_thread_messages_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_thread_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `client_feedback`
--
ALTER TABLE `client_feedback`
  ADD CONSTRAINT `client_feedback_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_feedback_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Constraints for table `engines`
--
ALTER TABLE `engines`
  ADD CONSTRAINT `engines_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `engines_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `engines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `engine_features`
--
ALTER TABLE `engine_features`
  ADD CONSTRAINT `engine_features_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `engine_features_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `engine_features_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `experts`
--
ALTER TABLE `experts`
  ADD CONSTRAINT `experts_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `experts_expert_category_id_foreign` FOREIGN KEY (`expert_category_id`) REFERENCES `expert_categories` (`id`),
  ADD CONSTRAINT `experts_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `experts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expert_categories`
--
ALTER TABLE `expert_categories`
  ADD CONSTRAINT `expert_categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expert_categories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expert_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `folders_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD CONSTRAINT `f_a_q_s_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `f_a_q_s_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `f_a_q_s_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `generated_contents`
--
ALTER TABLE `generated_contents`
  ADD CONSTRAINT `generated_contents_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `generated_contents_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`),
  ADD CONSTRAINT `generated_contents_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `generated_contents_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `generated_contents_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`),
  ADD CONSTRAINT `generated_contents_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `generated_contents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `generated_images`
--
ALTER TABLE `generated_images`
  ADD CONSTRAINT `generated_images_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `generated_images_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`),
  ADD CONSTRAINT `generated_images_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `generated_images_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `generated_images_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`),
  ADD CONSTRAINT `generated_images_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `generated_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  ADD CONSTRAINT `grass_period_payments_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `grass_period_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Constraints for table `offline_payment_methods`
--
ALTER TABLE `offline_payment_methods`
  ADD CONSTRAINT `offline_payment_methods_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `offline_payment_methods_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `offline_payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pages_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_gateway_details`
--
ALTER TABLE `payment_gateway_details`
  ADD CONSTRAINT `payment_gateway_details_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`);

--
-- Constraints for table `payment_gateway_product_histories`
--
ALTER TABLE `payment_gateway_product_histories`
  ADD CONSTRAINT `payment_gateway_product_histories_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permissions_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ai_prompt_request_id_foreign` FOREIGN KEY (`ai_prompt_request_id`) REFERENCES `ai_prompt_requests` (`id`),
  ADD CONSTRAINT `posts_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD CONSTRAINT `reply_tickets_replied_by_foreign` FOREIGN KEY (`replied_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reply_tickets_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `reply_tickets_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

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
-- Constraints for table `storage_managers`
--
ALTER TABLE `storage_managers`
  ADD CONSTRAINT `storage_managers_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `storage_managers_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `storage_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD CONSTRAINT `subscription_plans_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_plans_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscription_plan_templates`
--
ALTER TABLE `subscription_plan_templates`
  ADD CONSTRAINT `subscription_plan_templates_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_plan_templates_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `subscription_plan_templates_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`),
  ADD CONSTRAINT `subscription_plan_templates_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_plan_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tags_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tags_user_site_id_foreign` FOREIGN KEY (`user_site_id`) REFERENCES `user_sites` (`id`);

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `templates_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`),
  ADD CONSTRAINT `templates_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `template_categories`
--
ALTER TABLE `template_categories`
  ADD CONSTRAINT `template_categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `template_categories_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `template_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `text_to_speeches`
--
ALTER TABLE `text_to_speeches`
  ADD CONSTRAINT `text_to_speeches_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `text_to_speeches_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  ADD CONSTRAINT `text_to_speeches_subscription_user_id_foreign` FOREIGN KEY (`subscription_user_id`) REFERENCES `subscription_users` (`id`),
  ADD CONSTRAINT `text_to_speeches_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `text_to_speeches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `ticket_files_replied_id_foreign` FOREIGN KEY (`replied_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ticket_files_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_parent_user_id_foreign` FOREIGN KEY (`parent_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_balances`
--
ALTER TABLE `user_balances`
  ADD CONSTRAINT `user_balances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_sites`
--
ALTER TABLE `user_sites`
  ADD CONSTRAINT `user_sites_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_sites_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_sites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wp_authors`
--
ALTER TABLE `wp_authors`
  ADD CONSTRAINT `wp_authors_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_authors_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_authors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_authors_user_site_id_foreign` FOREIGN KEY (`user_site_id`) REFERENCES `user_sites` (`id`);

--
-- Constraints for table `wp_blog_posts`
--
ALTER TABLE `wp_blog_posts`
  ADD CONSTRAINT `wp_blog_posts_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `wp_blog_posts_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_blog_posts_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_blog_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_blog_posts_user_site_id_foreign` FOREIGN KEY (`user_site_id`) REFERENCES `user_sites` (`id`);

--
-- Constraints for table `wp_settings`
--
ALTER TABLE `wp_settings`
  ADD CONSTRAINT `wp_settings_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_settings_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wp_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

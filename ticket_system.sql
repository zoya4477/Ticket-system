-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2026 at 09:57 AM
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
-- Database: `ticket_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `category_id`, `is_published`, `created_at`, `updated_at`) VALUES
(4, 'How to Reset Your Account Password', 'If you forget your account password, go to the login page and click on “Forgot Password.” Enter your registered email address, and you will receive a password reset link. Follow the instructions to create a new password.', 4, 1, '2026-03-16 04:39:23', '2026-03-16 04:39:23'),
(5, 'Laptop Unable to Connect to Office Wi-Fi', 'If your laptop is unable to connect to the office Wi-Fi, follow these steps to troubleshoot the issue:\r\n\r\n1. Check Wi-Fi Settings: Make sure Wi-Fi is turned on and airplane mode is off.\r\n2. Restart Devices: Restart both your laptop and the Wi-Fi router.\r\n3. Forget and Reconnect: Forget the office network on your laptop and reconnect by entering the password again.\r\n4. Update Drivers: Ensure your wireless network adapter drivers are up to date.\r\n5. Check Security Settings: Some office networks require special certificates or VPN connections.\r\n6. Contact IT Support: If the problem persists, contact your IT team for assistance.\r\n\r\nFollowing these steps usually resolves common connection issues and restores access to the office network.', 3, 1, '2026-03-16 05:16:17', '2026-03-16 05:16:17'),
(6, 'How to Get Started with Our Ticketing System', 'Our ticketing system is designed to help you quickly and efficiently submit and track your support requests. The General category covers broad topics that are relevant to all users, making it easier to find answers to common questions without creating a ticket.\r\nSome tips for using the system effectively include:\r\nExplore FAQs first: Many common questions are already answered in the General section.\r\nUse clear descriptions: When submitting a ticket, provide detailed information to help support resolve your issue faster.\r\nTrack your requests: You can view the status of your tickets anytime from your dashboard.\r\nProvide feedback: Your suggestions help us improve features and the overall user experience.\r\n\r\nThe General category ensures that users can self-serve for everyday questions, saving time and reducing the load on support staff. Regularly reviewing the General FAQs can help you make the most of the system and quickly resolve your queries.', 1, 1, '2026-03-30 07:09:59', '2026-03-30 07:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `ticket_id`, `file_path`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(2, 6, 'attachments/hWRpoYHJhRyljJ2UWZ06AWutXPlvfLJFdYEJnkua.jpg', 1, '2026-03-30 01:24:16', '2026-03-30 01:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `department_id`) VALUES
(1, 'Technical Issue', 'Issues related to technical problems or system errors', '2026-03-03 04:37:46', '2026-03-03 04:37:46', 1),
(2, 'Account & Login', 'Problems related to account access or login', '2026-03-03 04:37:46', '2026-03-03 04:37:46', 1),
(3, 'Billing & Payments', 'Questions or issues regarding billing and payments', '2026-03-03 04:37:46', '2026-03-03 04:37:46', 7),
(4, 'Feature Request', 'Suggestions for new features or improvements', '2026-03-03 04:37:46', '2026-03-03 04:37:46', 1),
(5, 'General Inquiry', 'General questions or information requests', '2026-03-03 04:37:46', '2026-03-03 04:37:46', 2),
(6, 'Complaint', 'Customer complaints regarding service or product', '2026-03-03 04:37:46', '2026-03-03 04:37:46', 2),
(7, 'Bug Report', 'Report of a software bug or malfunction', '2026-03-03 04:37:46', '2026-03-03 04:37:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IT / Technical Support', '2026-02-26 05:12:16', '2026-03-03 05:04:13'),
(2, 'Customer Support / Service Desk', '2026-03-03 05:02:01', '2026-03-03 05:02:01'),
(3, 'Human Resources (HR)', '2026-03-03 05:02:16', '2026-03-03 05:02:16'),
(4, 'Operations', '2026-03-03 05:02:40', '2026-03-03 05:02:40'),
(5, 'Legal / Compliance', '2026-03-03 05:03:20', '2026-03-03 05:03:20'),
(6, 'Facilities / Maintenance', '2026-03-03 05:03:47', '2026-03-03 05:03:47'),
(7, 'Finance / Accounting', '2026-03-03 05:04:26', '2026-03-03 05:04:26');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `category_id`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'How can I reset my password?', 'To reset your password, go to Settings > Account > Reset Password.', 1, 1, '2026-03-30 11:34:21', '2026-03-30 11:34:21'),
(2, 'How do I create a new support ticket?', 'Click on \"New Ticket\" in the dashboard, fill out the form, and submit.', 2, 1, '2026-03-30 11:34:21', '2026-03-30 11:34:21'),
(3, 'Can I close a ticket after submission?', 'Yes, you can close any open ticket from the ticket details page.', 2, 1, '2026-03-30 11:34:21', '2026-03-30 11:34:21'),
(4, 'What is the response time for support?', 'Our average response time is within 24 hours on business days.', 3, 1, '2026-03-30 11:34:21', '2026-03-30 11:34:21'),
(5, 'How do I change my account email?', 'Go to Settings > Account > Email and update your email address.', 1, 1, '2026-03-30 11:34:21', '2026-03-30 11:34:21'),
(6, 'What are your support hours?', 'Our support team is available Monday to Friday, 9 AM to 6 PM.', 1, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(7, 'Where can I find the user manual?', 'The user manual is available under Help > Documentation.', 1, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(8, 'How can I contact support directly?', 'Use the \"Contact Us\" form or email support@example.com for assistance.', 1, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(9, 'How can I view my invoice?', 'Go to Billing > Invoices to download or view your invoices.', 2, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(10, 'Why was my payment declined?', 'Ensure your card details are correct and sufficient balance is available. Contact your bank if needed.', 2, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(11, 'Can I update my billing information?', 'Yes, go to Billing > Payment Methods and update your details.', 2, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(12, 'Why is my dashboard loading slowly?', 'Slow performance may be due to network issues or high server load. Refresh or check your connection.', 3, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(13, 'The system crashes when I upload a file. What should I do?', 'Ensure your file meets the upload guidelines. Try a smaller file or different format.', 3, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(14, 'Notifications are not being sent.', 'Ensure notification settings are enabled. Contact support if the problem continues.', 3, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(15, 'I forgot my password. How can I reset it?', 'Click \"Forgot Password\" on the login page and follow the instructions.', 4, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(16, 'How do I change my account email?', 'Go to Settings > Account > Email and update your email address.', 4, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42'),
(17, 'I am unable to login despite correct credentials.', 'Ensure your account is verified. If the issue persists, contact support.', 4, 1, '2026-03-30 11:51:42', '2026-03-30 11:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `internal_notes`
--

CREATE TABLE `internal_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"7953ca65-90e5-483a-b89d-f11e20d6bb90\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"99ca493c-2363-4275-86cf-0fd78e5b1fdf\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:5;s:5:\\\"title\\\";s:51:\\\"“Submit” button on feedback form not responding\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772518722,\"delay\":null}', 0, NULL, 1772518722, 1772518722),
(2, 'default', '{\"uuid\":\"98291b97-3d9b-46f7-9bfc-4ddc924e23d1\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"48c031cc-b03c-4da1-b916-f478a01a616b\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:5;s:5:\\\"title\\\";s:37:\\\"Internet Service Not Working Properly\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772529021,\"delay\":null}', 0, NULL, 1772529021, 1772529021),
(3, 'default', '{\"uuid\":\"845bab20-1622-42f2-90d3-b34eaabb4cdd\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:13:\\\"comment_added\\\";s:2:\\\"id\\\";s:36:\\\"e5f2d256-a459-4f02-a713-f4859b1e1df7\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:5;s:5:\\\"title\\\";s:37:\\\"Internet Service Not Working Properly\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:13:\\\"comment_added\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772529814,\"delay\":null}', 0, NULL, 1772529814, 1772529814),
(4, 'default', '{\"uuid\":\"069f7a5e-0738-4dfe-a6d9-455b1d50d9f7\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:2:{i:0;s:4:\\\"user\\\";i:1;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:14:\\\"status_updated\\\";s:2:\\\"id\\\";s:36:\\\"e2f53276-bf0c-4106-94d6-8406d048fda6\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:5;s:5:\\\"title\\\";s:37:\\\"Internet Service Not Working Properly\\\";s:6:\\\"status\\\";s:6:\\\"closed\\\";s:4:\\\"type\\\";s:14:\\\"status_updated\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772529814,\"delay\":null}', 0, NULL, 1772529814, 1772529814),
(5, 'default', '{\"uuid\":\"efdc5aa3-b99b-42cc-8ee6-d944c768f17b\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"48df73fb-8fd2-4e43-bc0d-d51f28b35118\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:6;s:5:\\\"title\\\";s:4:\\\"adcg\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772599280,\"delay\":null}', 0, NULL, 1772599281, 1772599281),
(6, 'default', '{\"uuid\":\"9c0793e4-6883-4919-8d51-3a0ea688ca20\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"b448b9d1-0cba-4112-a5b4-0ea14ae4451e\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:6;s:5:\\\"title\\\";s:27:\\\"Duplicate Invoice Generated\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772599997,\"delay\":null}', 0, NULL, 1772599997, 1772599997),
(7, 'default', '{\"uuid\":\"3a8492c4-e1c6-41a7-9f4f-cbafc1019e1e\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"57ac86c4-a9fb-42d9-b1cc-feaa02bf5543\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:7;s:5:\\\"title\\\";s:33:\\\"Delayed Customer Support Response\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772600078,\"delay\":null}', 0, NULL, 1772600078, 1772600078),
(8, 'default', '{\"uuid\":\"08bb9fef-347f-4564-8ef2-ff147d2407ec\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"7175dd1b-b788-49a1-915a-6c683e82b17d\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:7;s:5:\\\"title\\\";s:33:\\\"Delayed Customer Support Response\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772600674,\"delay\":null}', 0, NULL, 1772600674, 1772600674),
(9, 'default', '{\"uuid\":\"53aca372-9634-463f-a98a-507fc3a65085\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:14:\\\"status_updated\\\";s:2:\\\"id\\\";s:36:\\\"60bd2663-f683-412c-bdd3-e5715a806fa1\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:7;s:5:\\\"title\\\";s:33:\\\"Delayed Customer Support Response\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:14:\\\"status_updated\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772600675,\"delay\":null}', 0, NULL, 1772600675, 1772600675),
(10, 'default', '{\"uuid\":\"c0f8fd39-43ba-4845-b525-64b3d142f2ed\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:8:\\\"assigned\\\";s:2:\\\"id\\\";s:36:\\\"b7342c08-a98d-4b80-9d53-d3e88a09812b\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:7;s:5:\\\"title\\\";s:33:\\\"Delayed Customer Support Response\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:8:\\\"assigned\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772609484,\"delay\":null}', 0, NULL, 1772609485, 1772609485),
(11, 'default', '{\"uuid\":\"eb41bed9-48b0-4fb2-8689-e21a152ed9be\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:8:\\\"assigned\\\";s:2:\\\"id\\\";s:36:\\\"44a38613-3daf-4718-b569-d7864ad16454\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:7;s:5:\\\"title\\\";s:33:\\\"Delayed Customer Support Response\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:8:\\\"assigned\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772609489,\"delay\":null}', 0, NULL, 1772609489, 1772609489),
(12, 'default', '{\"uuid\":\"c396758f-e2a3-44ca-9dcd-1901bc55268d\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:8:\\\"assigned\\\";s:2:\\\"id\\\";s:36:\\\"068c6ab5-73e3-4500-be3c-216ff114b589\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:6;s:5:\\\"title\\\";s:27:\\\"Duplicate Invoice Generated\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:8:\\\"assigned\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772609511,\"delay\":null}', 0, NULL, 1772609511, 1772609511),
(13, 'default', '{\"uuid\":\"f75524de-b598-42c1-849b-df858694ccca\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:8:\\\"assigned\\\";s:2:\\\"id\\\";s:36:\\\"1a965276-407b-437a-9418-ade61cc61e39\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:6;s:5:\\\"title\\\";s:27:\\\"Duplicate Invoice Generated\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:8:\\\"assigned\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772609511,\"delay\":null}', 0, NULL, 1772609511, 1772609511),
(14, 'default', '{\"uuid\":\"ca89c6c5-ab0f-4888-bba9-d56f6b6cad2f\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"df1dc606-bcfe-4db0-aa73-d88e8bf30f5a\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:8;s:5:\\\"title\\\";s:8:\\\"adsfdvfd\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1772615978,\"delay\":null}', 0, NULL, 1772615978, 1772615978),
(15, 'default', '{\"uuid\":\"4d60415e-63ff-40a2-975d-8a4c16d5b873\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:9:\\\"escalated\\\";s:2:\\\"id\\\";s:36:\\\"9ad9a2a8-63ae-4efe-ad15-ee0b00b437ad\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:7;s:5:\\\"title\\\";s:33:\\\"Delayed Customer Support Response\\\";s:6:\\\"status\\\";s:9:\\\"escalated\\\";s:4:\\\"type\\\";s:9:\\\"escalated\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773295967,\"delay\":null}', 0, NULL, 1773295967, 1773295967),
(16, 'default', '{\"uuid\":\"aa2b8381-95b2-4790-91dd-cec67dff84d7\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"0e3941ba-4371-49a9-8638-44d307025595\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:8;s:5:\\\"title\\\";s:18:\\\"Laptop not working\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773297485,\"delay\":null}', 0, NULL, 1773297485, 1773297485),
(17, 'default', '{\"uuid\":\"be5986d0-8a04-48d6-85f7-0fcd3c574f50\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:13:\\\"comment_added\\\";s:2:\\\"id\\\";s:36:\\\"80d225ea-c293-4b86-8f53-1550f2c5193d\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:6;s:5:\\\"title\\\";s:27:\\\"Duplicate Invoice Generated\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:13:\\\"comment_added\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773303453,\"delay\":null}', 0, NULL, 1773303453, 1773303453),
(18, 'default', '{\"uuid\":\"ea2ecc8b-2e73-44ee-8c0c-b0778b97da17\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"835aa4e7-f34a-4c55-a65e-df8e3732bd2d\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:9;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773635105,\"delay\":null}', 0, NULL, 1773635105, 1773635105),
(19, 'default', '{\"uuid\":\"bbe30295-87be-4181-b39d-7d25ff045ce5\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"e38fd876-198d-4c49-adb4-c11f66002517\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:10;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773635124,\"delay\":null}', 0, NULL, 1773635124, 1773635124),
(20, 'default', '{\"uuid\":\"b4d0df6d-70d4-4325-b46c-0c115756dabc\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"a39e9947-485a-4d49-83dd-4088448f7d9c\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:1;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773635573,\"delay\":null}', 0, NULL, 1773635573, 1773635573),
(21, 'default', '{\"uuid\":\"c71e33aa-f7ca-443b-8231-068137d9a4aa\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"24679539-f412-4575-b9fe-aad6bc8f1d4b\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773635834,\"delay\":null}', 0, NULL, 1773635834, 1773635834),
(22, 'default', '{\"uuid\":\"769a2e81-d527-4e0b-bb09-bab260d4e827\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"c125c8fc-fa48-4845-85bb-81aa268922f5\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:3;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773635835,\"delay\":null}', 0, NULL, 1773635835, 1773635835),
(23, 'default', '{\"uuid\":\"6e5ce38e-4267-4758-ab1a-59c1d6c48e2c\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"a60946f7-7606-4788-9399-0d483f773820\\\";}s:4:\\\"data\\\";a:4:{s:9:\\\"ticket_id\\\";i:3;s:5:\\\"title\\\";s:37:\\\"Request for Leave Balance Information\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773636785,\"delay\":null}', 0, NULL, 1773636785, 1773636785),
(24, 'default', '{\"uuid\":\"61ea6896-6dd0-4479-bfb3-32502064092d\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:13:\\\"comment_added\\\";s:2:\\\"id\\\";s:36:\\\"ad3f762c-4407-4287-ab2b-9c3dfc8487eb\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:1;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:13:\\\"comment_added\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773639558,\"delay\":null}', 0, NULL, 1773639558, 1773639558);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(25, 'default', '{\"uuid\":\"1035bb7b-3669-4eb5-871c-d3e4fb6abd0c\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:13:\\\"comment_added\\\";s:2:\\\"id\\\";s:36:\\\"fad01afe-71f4-4701-8084-3ce138137f41\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:1;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:13:\\\"comment_added\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773639559,\"delay\":null}', 0, NULL, 1773639559, 1773639559),
(26, 'default', '{\"uuid\":\"0d6dc091-163c-4b13-90be-89777a937cf3\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:8:\\\"resolved\\\";s:2:\\\"id\\\";s:36:\\\"1efac8be-c3b8-47c9-b919-1d4cfcd5c7e0\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:1;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:8:\\\"resolved\\\";s:4:\\\"type\\\";s:8:\\\"resolved\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773640331,\"delay\":null}', 0, NULL, 1773640331, 1773640331),
(27, 'default', '{\"uuid\":\"8ef5fe8b-2277-477d-be7c-62817b9a19ce\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"54c6034e-94f6-4cf5-84d2-b3fb58104d77\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:5;s:5:\\\"title\\\";s:43:\\\"Request for Compliance Policy Clarification\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/5\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773641269,\"delay\":null}', 0, NULL, 1773641269, 1773641269),
(28, 'default', '{\"uuid\":\"1600fd61-4cda-4cfa-babf-b94d5c9aeef8\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:8:\\\"resolved\\\";s:2:\\\"id\\\";s:36:\\\"613b8bed-e930-4d1a-8d6f-61deed497f45\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:4;s:5:\\\"title\\\";s:27:\\\"Cannot Access Email Account\\\";s:6:\\\"status\\\";s:8:\\\"resolved\\\";s:4:\\\"type\\\";s:8:\\\"resolved\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/4\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773723463,\"delay\":null}', 0, NULL, 1773723463, 1773723463),
(29, 'default', '{\"uuid\":\"2ae242bc-6c2c-45b6-bc43-589a7e4d4964\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:2:{i:0;s:4:\\\"user\\\";i:1;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:13:\\\"comment_added\\\";s:2:\\\"id\\\";s:36:\\\"9741a712-972c-4f32-b049-12264cfc3c1c\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:4;s:5:\\\"title\\\";s:27:\\\"Cannot Access Email Account\\\";s:6:\\\"status\\\";s:8:\\\"resolved\\\";s:4:\\\"type\\\";s:13:\\\"comment_added\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/4\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773723481,\"delay\":null}', 0, NULL, 1773723481, 1773723481),
(30, 'default', '{\"uuid\":\"36ff86ed-79ea-431f-97d5-ba03b7a88c68\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:13:\\\"comment_added\\\";s:2:\\\"id\\\";s:36:\\\"bbc74270-81ef-482e-8693-4e9947257c20\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:4;s:5:\\\"title\\\";s:27:\\\"Cannot Access Email Account\\\";s:6:\\\"status\\\";s:8:\\\"resolved\\\";s:4:\\\"type\\\";s:13:\\\"comment_added\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/4\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773723482,\"delay\":null}', 0, NULL, 1773723482, 1773723482),
(31, 'default', '{\"uuid\":\"11da2918-0531-44b4-8e8e-4400145a2bf5\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:6:\\\"closed\\\";s:2:\\\"id\\\";s:36:\\\"8892ece1-38e6-44d9-ac00-8ee75963e23f\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:1;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:6:\\\"closed\\\";s:4:\\\"type\\\";s:6:\\\"closed\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773724987,\"delay\":null}', 0, NULL, 1773724987, 1773724987),
(32, 'default', '{\"uuid\":\"ffdd3aa8-b605-4937-8380-8905ad5bc866\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:6:\\\"closed\\\";s:2:\\\"id\\\";s:36:\\\"ad8b54df-d744-40ff-ab53-0c50684d6455\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:1;s:5:\\\"title\\\";s:39:\\\"Laptop Unable to Connect to Office WiFi\\\";s:6:\\\"status\\\";s:6:\\\"closed\\\";s:4:\\\"type\\\";s:6:\\\"closed\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1773724988,\"delay\":null}', 0, NULL, 1773724988, 1773724988),
(33, 'default', '{\"uuid\":\"ff6f6753-7d6d-4ed4-baa4-18c06f827964\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"0ed4fe7a-9b80-4d1a-8f56-383844112d75\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:6;s:5:\\\"title\\\";s:20:\\\"Internet not working\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/6\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1774846383,\"delay\":null}', 0, NULL, 1774846383, 1774846383),
(34, 'default', '{\"uuid\":\"408544fa-8abd-439b-a4ce-f238648efc52\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:8:\\\"resolved\\\";s:2:\\\"id\\\";s:36:\\\"83a9bb34-9fe2-465f-b44e-014147681a36\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:6;s:5:\\\"title\\\";s:20:\\\"Internet not working\\\";s:6:\\\"status\\\";s:8:\\\"resolved\\\";s:4:\\\"type\\\";s:8:\\\"resolved\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/6\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1774866840,\"delay\":null}', 0, NULL, 1774866840, 1774866840),
(35, 'default', '{\"uuid\":\"0904f6e7-bb7f-4745-98a8-0a68dab6186c\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"86bef472-ba4a-4de0-84fa-a6d9077fccff\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1774933054,\"delay\":null}', 0, NULL, 1774933055, 1774933055),
(36, 'default', '{\"uuid\":\"e5bdbd17-71fd-4522-bb84-ae6daf0d65cf\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"104526bb-9d15-4d9e-8ae4-3265a88ff4da\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1774933076,\"delay\":null}', 0, NULL, 1774933076, 1774933076),
(37, 'default', '{\"uuid\":\"9c8b72d5-d218-4852-aae0-c886664a569f\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"9adb88c9-bba1-40cb-8033-1a2ece5eee3b\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1774933076,\"delay\":null}', 0, NULL, 1774933076, 1774933076),
(38, 'default', '{\"uuid\":\"2049fe3c-b408-43b7-9001-b5a9ddcefd2e\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"891e9194-fb3f-4024-aefc-75a9a049c7c1\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1774933076,\"delay\":null}', 0, NULL, 1774933076, 1774933076),
(39, 'default', '{\"uuid\":\"a550ceb3-c0a4-42d4-8897-afff3ddf99d4\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"971f76a3-7ec1-47cc-8842-20025711d34f\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:7;s:5:\\\"title\\\";s:25:\\\"Submit button not working\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/7\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1774933641,\"delay\":null}', 0, NULL, 1774933641, 1774933641),
(40, 'default', '{\"uuid\":\"69c32549-e185-4822-907d-df5388781c7f\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"90391023-329b-41b8-8dd1-e9845a998e7c\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:6:\\\"closed\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775018469,\"delay\":null}', 0, NULL, 1775018469, 1775018469),
(41, 'default', '{\"uuid\":\"b685140e-a367-414a-a52d-1c72da5194b2\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"52df9902-fdf4-4a6c-b351-b8cf98b287af\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:6:\\\"closed\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775018488,\"delay\":null}', 0, NULL, 1775018488, 1775018488),
(42, 'default', '{\"uuid\":\"31ef8c36-cb81-4d45-827f-c5e547ffeb0b\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"c2d744e2-0577-43b9-a124-959b35b0ae22\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775018559,\"delay\":null}', 0, NULL, 1775018559, 1775018559),
(43, 'default', '{\"uuid\":\"ce509dd4-61f2-42dc-aeab-5f10f0079dc5\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"8c4ed720-f1d5-4183-8b98-65944c426c00\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775018559,\"delay\":null}', 0, NULL, 1775018559, 1775018559),
(44, 'default', '{\"uuid\":\"3ec879c6-a62c-48fb-a733-7f4b773fea1a\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"5eb86160-14c5-429d-85eb-433b47fadf58\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775123638,\"delay\":null}', 0, NULL, 1775123638, 1775123638),
(45, 'default', '{\"uuid\":\"f21f0cc9-5f5a-4638-887b-1fb22ed79786\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"0d2bc367-36a5-432d-ab38-fb9e2316e845\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775123659,\"delay\":null}', 0, NULL, 1775123659, 1775123659),
(46, 'default', '{\"uuid\":\"9f308fa5-5e0f-41bc-bd40-f89b9a62e840\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"agent\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"75620d81-935f-4e69-9f2d-aa4765c4b4de\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775123751,\"delay\":null}', 0, NULL, 1775123751, 1775123751),
(47, 'default', '{\"uuid\":\"d1d6daa6-ddac-4629-9892-76e7e5d5aed1\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:2:{i:0;s:5:\\\"agent\\\";i:1;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"updated\\\";s:2:\\\"id\\\";s:36:\\\"a284965c-6d7f-4bb8-b7f2-f59a174bf17a\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:2;s:5:\\\"title\\\";s:34:\\\"Salary Not Credited for This Month\\\";s:6:\\\"status\\\";s:11:\\\"in_progress\\\";s:4:\\\"type\\\";s:7:\\\"updated\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775123751,\"delay\":null}', 0, NULL, 1775123751, 1775123751);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(48, 'default', '{\"uuid\":\"0408860a-d685-4c93-b3d3-b3d7484d067f\",\"displayName\":\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":17:{s:5:\\\"event\\\";O:60:\\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\\":3:{s:10:\\\"notifiable\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\TicketNotification\\\":3:{s:9:\\\"\\u0000*\\u0000ticket\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Ticket\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:7:\\\"\\u0000*\\u0000type\\\";s:7:\\\"created\\\";s:2:\\\"id\\\";s:36:\\\"16f3f575-ba26-41ab-ba33-480708cbf406\\\";}s:4:\\\"data\\\";a:5:{s:9:\\\"ticket_id\\\";i:8;s:5:\\\"title\\\";s:46:\\\"Dark Mode Feature Implementation for Dashboard\\\";s:6:\\\"status\\\";s:4:\\\"open\\\";s:4:\\\"type\\\";s:7:\\\"created\\\";s:4:\\\"link\\\";s:31:\\\"http:\\/\\/127.0.0.1:8000\\/tickets\\/8\\\";}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:23:\\\"deleteWhenMissingModels\\\";b:1;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\",\"batchId\":null},\"createdAt\":1775208176,\"delay\":null}', 0, NULL, 1775208176, 1775208176);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kb_categories`
--

CREATE TABLE `kb_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kb_categories`
--

INSERT INTO `kb_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'General', '2026-03-16 09:37:54', '2026-03-16 09:37:54'),
(2, 'Billing', '2026-03-16 09:37:54', '2026-03-16 09:37:54'),
(3, 'Technical', '2026-03-16 09:37:54', '2026-03-16 09:37:54'),
(4, 'Account', '2026-03-16 09:37:54', '2026-03-16 09:37:54');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_26_071613_create_roles_table', 2),
(5, '2026_02_26_071724_add_role_id_to_users_table', 3),
(6, '2026_02_26_072050_create_tickets_table', 4),
(7, '2026_02_26_072623_create_ticket_comments_table', 5),
(8, '2026_02_26_080648_create_attachments_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('068c6ab5-73e3-4500-be3c-216ff114b589', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":6,\"title\":\"Duplicate Invoice Generated\",\"status\":\"in_progress\",\"type\":\"assigned\"}', '2026-03-04 03:50:56', '2026-03-04 02:31:51', '2026-03-04 03:50:56'),
('0d2bc367-36a5-432d-ab38-fb9e2316e845', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"open\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-04-02 05:54:38', '2026-04-02 04:54:19', '2026-04-02 05:54:38'),
('0e3941ba-4371-49a9-8638-44d307025595', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":8,\"title\":\"Laptop not working\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-12 02:15:19', '2026-03-12 01:38:05', '2026-03-12 02:15:19'),
('0ed4fe7a-9b80-4d1a-8f56-383844112d75', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":6,\"title\":\"Internet not working\",\"status\":\"open\",\"type\":\"created\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/6\"}', '2026-03-30 01:16:59', '2026-03-29 23:53:01', '2026-03-30 01:16:59'),
('104526bb-9d15-4d9e-8ae4-3265a88ff4da', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-03-31 05:17:41', '2026-03-30 23:57:56', '2026-03-31 05:17:41'),
('16f3f575-ba26-41ab-ba33-480708cbf406', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":8,\"title\":\"Dark Mode Feature Implementation for Dashboard\",\"status\":\"open\",\"type\":\"created\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/8\"}', '2026-04-03 05:12:42', '2026-04-03 04:22:56', '2026-04-03 05:12:42'),
('1a965276-407b-437a-9418-ade61cc61e39', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 5, '{\"ticket_id\":6,\"title\":\"Duplicate Invoice Generated\",\"status\":\"in_progress\",\"type\":\"assigned\"}', '2026-03-30 00:47:27', '2026-03-04 02:31:51', '2026-03-30 00:47:27'),
('1efac8be-c3b8-47c9-b919-1d4cfcd5c7e0', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":1,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"resolved\",\"type\":\"resolved\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\"}', '2026-03-16 04:00:51', '2026-03-16 00:52:11', '2026-03-16 04:00:51'),
('24679539-f412-4575-b9fe-aad6bc8f1d4b', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-16 00:01:14', '2026-03-15 23:37:14', '2026-03-16 00:01:14'),
('44a38613-3daf-4718-b569-d7864ad16454', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 2, '{\"ticket_id\":7,\"title\":\"Delayed Customer Support Response\",\"status\":\"in_progress\",\"type\":\"assigned\"}', '2026-03-31 05:12:07', '2026-03-04 02:31:29', '2026-03-31 05:12:07'),
('48c031cc-b03c-4da1-b916-f478a01a616b', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":5,\"title\":\"Internet Service Not Working Properly\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-03 04:19:17', '2026-03-03 04:10:21', '2026-03-03 04:19:17'),
('48df73fb-8fd2-4e43-bc0d-d51f28b35118', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":6,\"title\":\"adcg\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-03 23:43:06', '2026-03-03 23:41:19', '2026-03-03 23:43:06'),
('52df9902-fdf4-4a6c-b351-b8cf98b287af', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"closed\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-04-02 01:57:26', '2026-03-31 23:41:28', '2026-04-02 01:57:26'),
('54c6034e-94f6-4cf5-84d2-b3fb58104d77', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":5,\"title\":\"Request for Compliance Policy Clarification\",\"status\":\"open\",\"type\":\"created\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/5\"}', '2026-03-16 01:25:50', '2026-03-16 01:07:49', '2026-03-16 01:25:50'),
('57ac86c4-a9fb-42d9-b1cc-feaa02bf5543', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":7,\"title\":\"Delayed Customer Support Response\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-03 23:55:55', '2026-03-03 23:54:38', '2026-03-03 23:55:55'),
('5eb86160-14c5-429d-85eb-433b47fadf58', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 5, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"open\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', NULL, '2026-04-02 04:53:56', '2026-04-02 04:53:56'),
('60bd2663-f683-412c-bdd3-e5715a806fa1', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 4, '{\"ticket_id\":7,\"title\":\"Delayed Customer Support Response\",\"status\":\"in_progress\",\"type\":\"status_updated\"}', '2026-03-31 05:32:40', '2026-03-04 00:04:35', '2026-03-31 05:32:40'),
('613b8bed-e930-4d1a-8d6f-61deed497f45', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":4,\"title\":\"Cannot Access Email Account\",\"status\":\"resolved\",\"type\":\"resolved\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/4\"}', '2026-03-17 00:24:32', '2026-03-16 23:57:43', '2026-03-17 00:24:32'),
('7175dd1b-b788-49a1-915a-6c683e82b17d', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":7,\"title\":\"Delayed Customer Support Response\",\"status\":\"in_progress\",\"type\":\"updated\"}', '2026-03-04 00:05:48', '2026-03-04 00:04:34', '2026-03-04 00:05:48'),
('75620d81-935f-4e69-9f2d-aa4765c4b4de', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 5, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', NULL, '2026-04-02 04:55:51', '2026-04-02 04:55:51'),
('80d225ea-c293-4b86-8f53-1550f2c5193d', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 4, '{\"ticket_id\":6,\"title\":\"Duplicate Invoice Generated\",\"status\":\"in_progress\",\"type\":\"comment_added\"}', '2026-03-31 05:32:21', '2026-03-12 03:17:33', '2026-03-31 05:32:21'),
('835aa4e7-f34a-4c55-a65e-df8e3732bd2d', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":9,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-16 00:01:14', '2026-03-15 23:25:04', '2026-03-16 00:01:14'),
('83a9bb34-9fe2-465f-b44e-014147681a36', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":6,\"title\":\"Internet not working\",\"status\":\"resolved\",\"type\":\"resolved\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/6\"}', '2026-03-31 05:17:47', '2026-03-30 05:33:59', '2026-03-31 05:17:47'),
('86bef472-ba4a-4de0-84fa-a6d9077fccff', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 5, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-03-31 05:58:05', '2026-03-30 23:57:33', '2026-03-31 05:58:05'),
('8892ece1-38e6-44d9-ac00-8ee75963e23f', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 2, '{\"ticket_id\":1,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"closed\",\"type\":\"closed\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\"}', '2026-03-17 05:25:49', '2026-03-17 00:23:07', '2026-03-17 05:25:49'),
('891e9194-fb3f-4024-aefc-75a9a049c7c1', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-03-31 05:17:41', '2026-03-30 23:57:56', '2026-03-31 05:17:41'),
('8c4ed720-f1d5-4183-8b98-65944c426c00', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-04-02 01:57:26', '2026-03-31 23:42:39', '2026-04-02 01:57:26'),
('90391023-329b-41b8-8dd1-e9845a998e7c', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 5, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"closed\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', NULL, '2026-03-31 23:41:08', '2026-03-31 23:41:08'),
('971f76a3-7ec1-47cc-8842-20025711d34f', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":7,\"title\":\"Submit button not working\",\"status\":\"open\",\"type\":\"created\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/7\"}', '2026-03-31 00:43:21', '2026-03-31 00:07:21', '2026-03-31 00:43:21'),
('9741a712-972c-4f32-b049-12264cfc3c1c', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":4,\"title\":\"Cannot Access Email Account\",\"status\":\"resolved\",\"type\":\"comment_added\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/4\"}', '2026-03-17 00:24:32', '2026-03-16 23:58:01', '2026-03-17 00:24:32'),
('99ca493c-2363-4275-86cf-0fd78e5b1fdf', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":5,\"title\":\"\\u201cSubmit\\u201d button on feedback form not responding\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-03 03:05:30', '2026-03-03 01:18:42', '2026-03-03 03:05:30'),
('9ad9a2a8-63ae-4efe-ad15-ee0b00b437ad', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":7,\"title\":\"Delayed Customer Support Response\",\"status\":\"escalated\",\"type\":\"escalated\"}', '2026-03-12 02:15:19', '2026-03-12 01:12:46', '2026-03-12 02:15:19'),
('9adb88c9-bba1-40cb-8033-1a2ece5eee3b', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 5, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-03-31 05:58:05', '2026-03-30 23:57:56', '2026-03-31 05:58:05'),
('a284965c-6d7f-4bb8-b7f2-f59a174bf17a', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', '2026-04-02 05:54:37', '2026-04-02 04:55:51', '2026-04-02 05:54:37'),
('a39e9947-485a-4d49-83dd-4088448f7d9c', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":1,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-16 00:01:14', '2026-03-15 23:32:53', '2026-03-16 00:01:14'),
('a60946f7-7606-4788-9399-0d483f773820', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":3,\"title\":\"Request for Leave Balance Information\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-16 00:00:36', '2026-03-15 23:53:05', '2026-03-16 00:00:36'),
('ad3f762c-4407-4287-ab2b-9c3dfc8487eb', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":1,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"in_progress\",\"type\":\"comment_added\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\"}', '2026-03-16 04:00:51', '2026-03-16 00:39:18', '2026-03-16 04:00:51'),
('ad8b54df-d744-40ff-ab53-0c50684d6455', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":1,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"closed\",\"type\":\"closed\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\"}', '2026-03-17 00:24:25', '2026-03-17 00:23:08', '2026-03-17 00:24:25'),
('b448b9d1-0cba-4112-a5b4-0ea14ae4451e', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":6,\"title\":\"Duplicate Invoice Generated\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-03 23:55:55', '2026-03-03 23:53:17', '2026-03-03 23:55:55'),
('b7342c08-a98d-4b80-9d53-d3e88a09812b', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":7,\"title\":\"Delayed Customer Support Response\",\"status\":\"in_progress\",\"type\":\"assigned\"}', '2026-03-04 03:50:56', '2026-03-04 02:31:24', '2026-03-04 03:50:56'),
('bbc74270-81ef-482e-8693-4e9947257c20', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":4,\"title\":\"Cannot Access Email Account\",\"status\":\"resolved\",\"type\":\"comment_added\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/4\"}', '2026-03-17 00:24:32', '2026-03-16 23:58:02', '2026-03-17 00:24:32'),
('c125c8fc-fa48-4845-85bb-81aa268922f5', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":3,\"title\":\"Salary Not Credited for This Month\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-16 00:00:36', '2026-03-15 23:37:15', '2026-03-16 00:00:36'),
('c2d744e2-0577-43b9-a124-959b35b0ae22', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 5, '{\"ticket_id\":2,\"title\":\"Salary Not Credited for This Month\",\"status\":\"in_progress\",\"type\":\"updated\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/2\"}', NULL, '2026-03-31 23:42:39', '2026-03-31 23:42:39'),
('df1dc606-bcfe-4db0-aa73-d88e8bf30f5a', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":8,\"title\":\"adsfdvfd\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-04 05:51:16', '2026-03-04 04:19:38', '2026-03-04 05:51:16'),
('e38fd876-198d-4c49-adb4-c11f66002517', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 1, '{\"ticket_id\":10,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"open\",\"type\":\"created\"}', '2026-03-16 00:01:14', '2026-03-15 23:25:24', '2026-03-16 00:01:14'),
('fad01afe-71f4-4701-8084-3ce138137f41', 'App\\Notifications\\TicketNotification', 'App\\Models\\User', 3, '{\"ticket_id\":1,\"title\":\"Laptop Unable to Connect to Office WiFi\",\"status\":\"in_progress\",\"type\":\"comment_added\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/tickets\\/1\"}', '2026-03-16 04:00:51', '2026-03-16 00:39:19', '2026-03-16 04:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('zoyacs08@gmail.com', '$2y$12$XZpml3012trf79R5XGxMkujn8TUIBjEyBWfeLuckxAMjMBinkylWe', '2026-04-03 04:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create ticket', 'web', '2026-04-01 04:57:12', '2026-04-01 04:57:12'),
(2, 'view ticket', 'web', '2026-04-01 04:57:12', '2026-04-01 04:57:12'),
(3, 'view all tickets', 'web', '2026-04-01 04:57:12', '2026-04-01 04:57:12'),
(4, 'update ticket', 'web', '2026-04-01 04:57:12', '2026-04-01 04:57:12'),
(5, 'delete ticket', 'web', '2026-04-01 04:57:12', '2026-04-01 04:57:12'),
(6, 'assign ticket', 'web', '2026-04-01 04:57:12', '2026-04-01 04:57:12'),
(7, 'close ticket', 'web', '2026-04-01 04:57:12', '2026-04-01 04:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guard_name` varchar(255) DEFAULT 'web'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `guard_name`) VALUES
(1, 'Admin', '2026-02-26 02:20:17', '2026-02-26 02:20:17', 'web'),
(2, 'Agent', '2026-02-26 02:20:17', '2026-02-26 02:20:17', 'web'),
(3, 'Customer', '2026-02-26 02:20:22', '2026-02-26 02:20:22', 'web');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7f9cgPFBwvEt86nSNjlWN4QLVe2c5fVPe4VEr43n', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTldJNzNaRTY3UG0xVWp3MUk1T053V2JLRlRzeThjbkRLZ3Jsek9VVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1775457229),
('NkyidMv8VXKikM0zaflI2lVI8IfaGbhnjYF0X5dG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRG45MXZUV2Z5U0Y3dG01Z0dNZkJOcWFITk5PenhkaWh6RWJDc0laUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1775458839);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('open','in_progress','resolved','closed') NOT NULL DEFAULT 'open',
  `resolved_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `closed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'low',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `agent_id`, `title`, `description`, `status`, `resolved_at`, `closed_at`, `closed_by`, `priority`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 3, 2, 'Laptop Unable to Connect to Office WiFi', 'I am unable to connect my laptop to the office WiFi network since this morning. The network appears in the available connections list, but it fails to connect and shows an authentication error. I have already tried restarting my laptop and reconnecting to the network, but the issue persists. Kindly assist in resolving this issue as it is affecting my work.', 'closed', '2026-03-16 00:52:11', '2026-03-17 00:23:07', 3, 'high', '2026-03-15 23:32:53', '2026-03-17 00:23:07', 1),
(2, 3, 5, 'Salary Not Credited for This Month', 'My salary for this month has not been credited to my bank account yet. Most of my colleagues have already received their payments. Could you please check if there is any issue with my payroll processing and update me on the status?', 'in_progress', '2026-03-30 00:33:58', '2026-03-30 00:50:11', 3, 'medium', '2026-03-15 23:37:14', '2026-04-02 04:55:51', 3),
(3, 1, 8, 'Request for Leave Balance Information', 'I would like to request information regarding my remaining leave balance for this year. Please provide the details of my available casual and annual leaves so that I can plan my upcoming leave accordingly.', 'in_progress', NULL, NULL, NULL, 'low', '2026-03-15 23:53:05', '2026-03-16 00:03:58', 5),
(4, 1, 2, 'Cannot Access Email Account', 'I am unable to log in to my company email account since this morning. I have tried resetting the password, but it still doesn’t work. Please assist urgently.', 'resolved', '2026-03-16 23:57:39', NULL, NULL, 'high', '2026-03-16 00:25:59', '2026-03-16 23:57:39', 1),
(5, 4, 8, 'Request for Compliance Policy Clarification', 'Request for clarification on compliance policy for handling sensitive client information across departments.', 'in_progress', NULL, NULL, NULL, 'medium', '2026-03-16 01:07:49', '2026-03-30 07:27:12', 5),
(6, 3, 5, 'Internet not working', 'The office Wi-Fi is down since morning. Devices cannot connect to the network.', 'resolved', '2026-03-30 05:33:57', NULL, NULL, 'medium', '2026-03-29 23:52:57', '2026-03-30 05:33:57', 1),
(7, 1, NULL, 'Submit button not working', 'Clicking the submit button does not send the form data. No success message is displayed and the page remains unchanged.', 'open', NULL, NULL, NULL, 'low', '2026-03-31 00:07:21', '2026-03-31 00:07:21', 7),
(8, 4, NULL, 'Dark Mode Feature Implementation for Dashboard', 'Currently, the dashboard uses a light theme by default. Users have requested a dark mode to reduce eye strain during night usage and improve accessibility.\r\nProposed Solution:\r\nAdd a toggle in user settings to switch between Light and Dark mode.\r\nEnsure all existing UI components (charts, tables, buttons) adapt correctly in Dark mode.\r\nPreserve user preference across sessions.\r\nBusiness Value / Benefit:\r\nEnhances user experience for night-time users.\r\nImproves accessibility compliance.\r\nCould reduce churn for power users who prefer personalized UI settings.', 'open', NULL, NULL, NULL, 'low', '2026-04-03 04:22:56', '2026-04-03 04:22:56', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_comments`
--

INSERT INTO `ticket_comments` (`id`, `ticket_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(5, 1, 2, 'Thanks for reporting. Please try forgetting the network and reconnecting with your credentials. If the issue persists, contact IT support to check your device access.', '2026-03-16 00:39:18', '2026-03-16 00:39:18'),
(7, 4, 2, 'Hi,\r\nThank you for reaching out. We understand how urgent this is.\r\nWe’re currently looking into the issue with your email account. In the meantime, please confirm if you’re receiving any error messages while trying to log in, and whether you’re accessing it via webmail or an email client (e.g., Outlook, mobile app).\r\nWe’ll prioritize this and get back to you shortly with an update.\r\nThank you for your patience.', '2026-03-16 23:57:39', '2026-03-16 23:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_histories`
--

CREATE TABLE `ticket_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_histories`
--

INSERT INTO `ticket_histories` (`id`, `ticket_id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(46, 1, 3, 'created', 'Ticket created', '2026-03-15 23:32:53', '2026-03-15 23:32:53'),
(47, 2, 3, 'created', 'Ticket created', '2026-03-15 23:37:14', '2026-03-15 23:37:14'),
(49, 3, 1, 'created', 'Ticket created', '2026-03-15 23:53:05', '2026-03-15 23:53:05'),
(50, 1, 2, 'comment_added', 'Comment added by zara', '2026-03-16 00:39:18', '2026-03-16 00:39:18'),
(51, 1, 2, 'comment_added', 'Comment added by zara', '2026-03-16 00:39:19', '2026-03-16 00:39:19'),
(52, 1, 2, 'resolved', 'Ticket resolved by zara', '2026-03-16 00:52:11', '2026-03-16 00:52:11'),
(53, 5, 4, 'created', 'Ticket created', '2026-03-16 01:07:49', '2026-03-16 01:07:49'),
(54, 4, 1, 'updated', 'Ticket updated by zoya', '2026-03-16 03:12:29', '2026-03-16 03:12:29'),
(55, 4, 1, 'updated', 'Ticket updated by zoya', '2026-03-16 03:57:33', '2026-03-16 03:57:33'),
(56, 4, 2, 'comment_added', 'Comment added by zara', '2026-03-16 23:57:39', '2026-03-16 23:57:39'),
(57, 4, 2, 'resolved', 'Ticket automatically resolved after agent comment by zara', '2026-03-16 23:57:39', '2026-03-16 23:57:39'),
(58, 4, 2, 'comment_added', 'Comment added by zara', '2026-03-16 23:58:02', '2026-03-16 23:58:02'),
(59, 1, 3, 'closed', 'Ticket confirmed and closed by employee hafsa', '2026-03-17 00:23:07', '2026-03-17 00:23:07'),
(60, 6, 3, 'created', 'Ticket created', '2026-03-29 23:52:57', '2026-03-29 23:52:57'),
(61, 2, 5, 'resolved', 'Ticket resolved by hira', '2026-03-30 00:33:58', '2026-03-30 00:33:58'),
(62, 2, 3, 'closed', 'Ticket closed by customer hafsa', '2026-03-30 00:50:11', '2026-03-30 00:50:11'),
(63, 6, 1, 'attachment_added', 'Attachment uploaded by zoya', '2026-03-30 01:24:16', '2026-03-30 01:24:16'),
(64, 6, 5, 'resolved', 'Ticket resolved by hira', '2026-03-30 05:33:57', '2026-03-30 05:33:57'),
(65, 2, 1, 'updated', 'Ticket updated by zoya', '2026-03-30 23:57:29', '2026-03-30 23:57:29'),
(66, 2, 1, 'updated', 'Ticket updated by zoya', '2026-03-30 23:57:56', '2026-03-30 23:57:56'),
(67, 7, 1, 'created', 'Ticket created', '2026-03-31 00:07:21', '2026-03-31 00:07:21'),
(68, 2, 1, 'updated', 'Ticket updated by zoya', '2026-03-31 23:41:04', '2026-03-31 23:41:04'),
(69, 2, 1, 'updated', 'Ticket updated by zoya', '2026-03-31 23:42:39', '2026-03-31 23:42:39'),
(70, 2, 1, 'updated', 'Ticket updated by zoya', '2026-04-02 04:53:53', '2026-04-02 04:53:53'),
(71, 2, 1, 'updated', 'Ticket updated by zoya', '2026-04-02 04:55:51', '2026-04-02 04:55:51'),
(72, 8, 4, 'created', 'Ticket created', '2026-04-03 04:22:56', '2026-04-03 04:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `department_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'zoya', 'zoyacs08@gmail.com', NULL, '$2y$12$hegpnBNoQ4o73AqGEStAkOAgQV7MZF2K1t9kSV6AmFO7n.ECus/vu', 'gF9CPKGYMwrLxMemU5leRTbXOTPnLTLl8Q1qQLPtHJya7LPOGIQDckWs5mLL', '2026-02-26 02:15:44', '2026-03-30 02:12:10'),
(2, 2, 7, 'zara', 'zara@gmail.com', NULL, '$2y$12$0XzTBNbRY7hhqUsxKjDvy.R7UkWAa.PWnx0dhOxJz7yu0Q303VjZS', NULL, '2026-02-26 02:59:12', '2026-03-03 05:06:10'),
(3, 3, 2, 'hafsa', 'hafsa123@gmail.com', NULL, '$2y$12$pix923GKPbsX2dZ/0ydgEe57OUygBuWog5JoWaxSKB6HfEXqFe3dW', NULL, '2026-02-26 04:15:47', '2026-03-03 05:06:18'),
(4, 3, 1, 'Riya', 'Riya@gmail.com', NULL, '$2y$12$tpmzI7mjjv9ghG1tr7g77u2AdeixctEdp2gpv.rWW7aVqJ7UwFLjO', NULL, '2026-03-02 03:44:28', '2026-03-02 03:44:42'),
(5, 2, 6, 'hira', 'hira@gmail.com', NULL, '$2y$12$zt23FVKesbT0BZoe4Ld7NeapJL8RN248oe3cBglebfS0MWJshLw96', NULL, '2026-03-02 03:59:22', '2026-03-03 05:06:29'),
(8, 2, 4, 'noor', 'noor@gmail.com', NULL, '$2y$12$kgsc7TuIZtBC7cWBe3DbeuTJFBRttHapnQ0e6IQCG76U6YOVlXtBu', NULL, '2026-03-12 02:11:27', '2026-03-12 02:11:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_activity_user` (`user_id`),
  ADD KEY `fk_activity_ticket` (`ticket_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articles_category` (`category_id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_ticket_id_foreign` (`ticket_id`),
  ADD KEY `attachments_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_faqs_category` (`category_id`);

--
-- Indexes for table `internal_notes`
--
ALTER TABLE `internal_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internal_notes_ticket_id_foreign` (`ticket_id`),
  ADD KEY `internal_notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kb_categories`
--
ALTER TABLE `kb_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_agent_id_foreign` (`agent_id`),
  ADD KEY `tickets_closed_by_foreign` (`closed_by`);

--
-- Indexes for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_comments_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `ticket_histories`
--
ALTER TABLE `ticket_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_histories_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_users_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `internal_notes`
--
ALTER TABLE `internal_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kb_categories`
--
ALTER TABLE `kb_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ticket_histories`
--
ALTER TABLE `ticket_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_activity_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_activity_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_category` FOREIGN KEY (`category_id`) REFERENCES `kb_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attachments_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `fk_faqs_category` FOREIGN KEY (`category_id`) REFERENCES `kb_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `internal_notes`
--
ALTER TABLE `internal_notes`
  ADD CONSTRAINT `internal_notes_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `internal_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_closed_by_foreign` FOREIGN KEY (`closed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD CONSTRAINT `ticket_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_histories`
--
ALTER TABLE `ticket_histories`
  ADD CONSTRAINT `ticket_histories_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

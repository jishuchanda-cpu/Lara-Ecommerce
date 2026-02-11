-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2026 at 01:49 PM
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
-- Database: `lara_ai`
--

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
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', 'Latest gadgets and electronic devices', 1, 1, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(2, 'Clothing', 'clothing', 'Fashionable apparel for all seasons', 1, 2, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(3, 'Home & Garden', 'home-garden', 'Everything for your home and outdoor space', 1, 3, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(4, 'Sports & Outdoors', 'sports-outdoors', 'Gear for all your sporting adventures', 1, 4, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(5, 'Books & Media', 'books-media', 'Books, movies, music, and more', 1, 5, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(6, 'Health & Beauty', 'health-beauty', 'Personal care and wellness products', 1, 6, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(7, 'Iusto Minima', 'iusto-minima', 'Eum occaecati est ea aut ut dolores inventore. Hic sint facere ut sapiente sed qui qui. Vel assumenda ab architecto aspernatur ipsum cupiditate. Quam aut quas eaque sequi.', 1, 94, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(8, 'Et Accusantium', 'et-accusantium', 'Saepe eaque libero ad voluptatem possimus. Enim quis maxime ut earum. Nulla accusantium magni quo repudiandae nobis unde provident sit.', 1, 37, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(9, 'Eveniet Ducimus', 'eveniet-ducimus', 'Sint vero tempora sint nemo ut suscipit omnis dignissimos. Voluptate minus totam ut vitae autem error.', 1, 27, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(10, 'Sit Aut', 'sit-aut', 'Nulla qui aut exercitationem voluptates aperiam doloremque maiores ipsam. Similique cum dolor aut reprehenderit cum nihil quis. Aut tempora dolor nemo veritatis maxime fugit voluptatibus. Suscipit minima tenetur nam tempore eos non.', 1, 54, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(11, 'Et Nesciunt', 'et-nesciunt', 'Asperiores at iste velit. Et ipsa doloribus est optio voluptas quam officiis. Ipsum dolorum est et dolores non animi molestiae aut.', 1, 14, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(12, 'Tempora Asperiores', 'tempora-asperiores', 'Quam quasi sit dolorem assumenda ducimus dolore molestiae. Et id quos qui iste dignissimos. Ut omnis libero adipisci. Sint quia rerum consequatur non sunt consectetur beatae aut.', 1, 67, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(13, 'Ut Vitae', 'ut-vitae', 'Dicta cupiditate necessitatibus autem necessitatibus nulla debitis. Voluptatibus et possimus et similique eum aspernatur at. Est veritatis et et animi eaque voluptas.', 1, 62, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(14, 'Laborum Veritatis', 'laborum-veritatis', 'Cum qui sapiente ad quia ab. Soluta laborum perferendis quaerat eveniet consequatur ad dolor. Et amet ipsam ut dolore voluptatem laboriosam minima. Commodi quia laboriosam quasi iusto.', 1, 76, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(15, 'Ducimus Fuga', 'ducimus-fuga', 'Fugit placeat voluptas ut voluptas sit. Libero exercitationem rem soluta molestias quo assumenda delectus fuga. Illum blanditiis sed exercitationem voluptatem molestiae quae. Deleniti voluptatibus reprehenderit placeat expedita asperiores.', 1, 38, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(16, 'Quia Animi', 'quia-animi', 'Rerum dolore explicabo facilis deserunt eius illum vel. Neque et mollitia deserunt. Nihil quam rerum voluptatem tempora excepturi ut. Voluptate voluptatem ducimus enim repudiandae enim.', 1, 88, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(17, 'Explicabo Veniam', 'explicabo-veniam', 'Sunt id sint quo eligendi est. Impedit explicabo tenetur cum sequi ipsum. Adipisci dolores aperiam et optio.', 1, 74, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(18, 'Non Ullam', 'non-ullam', 'Provident quod et voluptatem ea. Eius voluptates et accusamus delectus consequatur quibusdam saepe aut. Tempora maxime natus dolorum omnis non. Quia placeat ut unde est.', 1, 59, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(19, 'Aut Consequatur', 'aut-consequatur', 'Ab odio animi eius non sit. Qui qui autem dolorem necessitatibus. Corporis ea reiciendis enim iure sint. Id in dolore est eaque hic ratione sapiente.', 1, 73, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(20, 'Qui Ea', 'qui-ea', 'Dolorem quo rem qui placeat. Ad assumenda sed eum iure numquam illum harum aut. Facilis id sit qui aut totam blanditiis similique.', 1, 56, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(21, 'Molestiae Dolore', 'molestiae-dolore', 'Animi recusandae quisquam earum alias temporibus. Aut corrupti sunt molestiae cum fugiat facere est. Aliquam non molestias sed sunt aut veniam maiores animi. Dolorem dolore eos non at modi possimus.', 1, 74, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(22, 'Doloribus Molestiae', 'doloribus-molestiae', 'Asperiores sint quas nihil. Aspernatur est et nihil est provident fugit perspiciatis. Ut itaque sint cumque repellendus sed mollitia. Ut consequatur dolorem ut atque quasi maiores facilis.', 1, 4, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(23, 'Et Quas', 'et-quas', 'Est debitis odio beatae. Veritatis officiis fuga aperiam nulla aut laudantium. Qui aut enim laborum ex aspernatur illo et.', 1, 31, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(24, 'Non Natus', 'non-natus', 'Aut ullam quia ut. Eius consectetur temporibus illum. At enim modi corrupti. Aut eligendi dolor nemo.', 1, 12, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(25, 'Fugit Animi', 'fugit-animi', 'Autem ea culpa corrupti accusamus earum sapiente veniam blanditiis. Voluptatem pariatur alias aut omnis et sed architecto quia. Eaque voluptatem fuga quasi voluptates architecto mollitia qui. Explicabo unde voluptatem facilis veniam molestiae non tenetur eos.', 1, 8, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(26, 'Praesentium Rerum', 'praesentium-rerum', 'Placeat sint molestias quia accusantium ut laborum exercitationem rerum. Est ex non et. Distinctio sed pariatur iure iste consequatur veritatis eos.', 1, 88, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(27, 'A Et', 'a-et', 'Doloribus quo cum vitae qui. Possimus possimus est hic occaecati maiores iste distinctio. Similique ducimus voluptatem ea dicta. Facere adipisci ut quos suscipit et est.', 1, 50, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(28, 'Cum Ullam', 'cum-ullam', 'Fugit eum animi cumque ipsa cumque enim id. Ut est laboriosam eum. Qui facere recusandae odit natus. Omnis saepe possimus nihil quia eum deleniti.', 1, 30, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(29, 'Magnam Eligendi', 'magnam-eligendi', 'Minima recusandae quia eveniet est. Expedita in dolorum atque id ut quisquam nesciunt. Ea hic pariatur officiis cumque hic et. Aspernatur molestias quia dolores.', 1, 9, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(30, 'Praesentium Dolorum', 'praesentium-dolorum', 'Distinctio sit voluptas et. Doloribus recusandae amet illo explicabo. Consequatur assumenda quidem magni ut labore harum laudantium.', 1, 46, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(31, 'Voluptatem Ut', 'voluptatem-ut', 'Minima fugiat quia repellat voluptates ut quibusdam fugiat similique. Voluptatem quis porro deserunt velit adipisci consectetur voluptatem. Ad voluptatibus et sed eveniet iure quis provident est.', 1, 63, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(32, 'Ab Tenetur', 'ab-tenetur', 'Magnam architecto suscipit voluptatibus et minima. Molestiae autem sunt aut iusto qui earum voluptatibus eaque. Odit voluptatem aut exercitationem aut voluptatum.', 1, 42, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(33, 'Hic Velit', 'hic-velit', 'Rerum corrupti veniam excepturi reprehenderit magni veniam ducimus. Ut voluptatibus qui nulla occaecati debitis consequatur recusandae. Nam soluta porro quis minus minima.', 1, 99, '2026-02-10 04:28:00', '2026-02-10 04:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat_conversations`
--

CREATE TABLE `chat_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `system_prompt` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_conversation_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('user','assistant','system') NOT NULL,
  `content` text NOT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_per_user` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `description`, `type`, `value`, `min_order_amount`, `max_uses`, `max_uses_per_user`, `used_count`, `starts_at`, `expires_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'T20', 'This is test coupon desc . .', 'percentage', 20.00, 50.00, 50, 10, 0, '2026-02-10 10:06:00', '2029-11-17 10:06:00', 1, '2026-02-10 04:36:20', '2026-02-10 04:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'default', '{\"uuid\":\"e508da67-2891-4aee-b4ff-7aa83e79d126\",\"displayName\":\"App\\\\Notifications\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\OrderStatusUpdated\\\":5:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"oldStatus\\\";s:7:\\\"pending\\\";s:9:\\\"newStatus\\\";s:10:\\\"processing\\\";s:5:\\\"notes\\\";N;s:2:\\\"id\\\";s:36:\\\"3de1e952-550b-484d-942e-8e0c0f51db88\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1770717810,\"delay\":null}', 0, NULL, 1770717810, 1770717810),
(2, 'default', '{\"uuid\":\"b4506c88-1175-4469-bd4c-2dbda40d64c8\",\"displayName\":\"App\\\\Notifications\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\OrderStatusUpdated\\\":5:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"oldStatus\\\";s:10:\\\"processing\\\";s:9:\\\"newStatus\\\";s:7:\\\"pending\\\";s:5:\\\"notes\\\";N;s:2:\\\"id\\\";s:36:\\\"d51b6697-a222-4dff-8601-925b5d8ad63a\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1770717813,\"delay\":null}', 0, NULL, 1770717813, 1770717813),
(3, 'default', '{\"uuid\":\"7b2cc956-6d23-4d71-bf17-e0befa676c67\",\"displayName\":\"App\\\\Notifications\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\OrderStatusUpdated\\\":5:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"oldStatus\\\";s:7:\\\"pending\\\";s:9:\\\"newStatus\\\";s:9:\\\"delivered\\\";s:5:\\\"notes\\\";N;s:2:\\\"id\\\";s:36:\\\"e0f4a740-aae3-42c3-849d-f58f8582924b\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1770717817,\"delay\":null}', 0, NULL, 1770717817, 1770717817),
(4, 'default', '{\"uuid\":\"c8e80050-d3d7-468c-8748-bcf7ec299aab\",\"displayName\":\"App\\\\Notifications\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\OrderStatusUpdated\\\":5:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"oldStatus\\\";s:7:\\\"pending\\\";s:9:\\\"newStatus\\\";s:7:\\\"shipped\\\";s:5:\\\"notes\\\";N;s:2:\\\"id\\\";s:36:\\\"5b28f429-fbe6-478d-9879-f8898fe2b7b0\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1770725148,\"delay\":null}', 0, NULL, 1770725148, 1770725148),
(5, 'default', '{\"uuid\":\"bc07d807-449f-48d9-b458-511f08a6af38\",\"displayName\":\"App\\\\Notifications\\\\OrderStatusUpdated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:36:\\\"App\\\\Notifications\\\\OrderStatusUpdated\\\":5:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"oldStatus\\\";s:7:\\\"pending\\\";s:9:\\\"newStatus\\\";s:9:\\\"cancelled\\\";s:5:\\\"notes\\\";s:28:\\\"Order cancelled: Test Denger\\\";s:2:\\\"id\\\";s:36:\\\"01a38b58-bd96-43a6-9e41-4634cee9d9b8\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1770725826,\"delay\":null}', 0, NULL, 1770725826, 1770725826);

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2026_02_09_135316_create_messages_table', 1),
(5, '2026_02_09_135406_create_categories_table', 1),
(6, '2026_02_09_135536_create_products_table', 1),
(7, '2026_02_09_135612_modify_messages_table_add_user_id_and_content', 1),
(8, '2026_02_09_135635_create_orders_table', 1),
(9, '2026_02_09_140118_create_order_items_table', 1),
(10, '2026_02_09_140125_create_posts_table', 1),
(11, '2026_02_09_140146_create_chat_conversations_table', 1),
(12, '2026_02_09_140234_create_chat_messages_table', 1),
(13, '2026_02_09_140355_create_comments_table', 1),
(14, '2026_02_09_140525_add_foreign_key_to_messages_table', 1),
(15, '2026_02_09_141029_create_personal_access_tokens_table', 1),
(16, '2026_02_09_163110_add_role_to_users_table', 1),
(17, '2026_02_09_173554_create_order_histories_table', 1),
(18, '2026_02_09_181501_create_coupons_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `shipping_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`shipping_address`)),
  `billing_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`billing_address`)),
  `notes` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `total_amount`, `tax_amount`, `shipping_amount`, `discount_amount`, `status`, `payment_status`, `payment_method`, `shipping_address`, `billing_address`, `notes`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ORD-698B020A60BCB', 153.52, 10.63, 10.00, 0.00, 'delivered', 'paid', 'cash_on_delivery', '{\"name\":\"Admin User\",\"email\":\"admin@admin.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', '{\"name\":\"Admin User\",\"email\":\"admin@admin.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', NULL, 1, '2026-02-10 04:31:46', '2026-02-10 04:33:37'),
(2, 'ORD-698B0231B6747', 1366.48, 100.48, 10.00, 0.00, 'shipped', 'failed', 'cash_on_delivery', '{\"name\":\"Admin User\",\"email\":\"admin@admin.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', '{\"name\":\"Admin User\",\"email\":\"admin@admin.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', NULL, 1, '2026-02-10 04:32:25', '2026-02-10 06:35:47'),
(3, 'ORD-698B024FEF7C7', 659.95, 48.14, 10.00, 0.00, 'cancelled', 'pending', 'cash_on_delivery', '{\"name\":\"Admin User\",\"email\":\"admin@admin.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', '{\"name\":\"Admin User\",\"email\":\"admin@admin.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', NULL, 1, '2026-02-10 04:32:55', '2026-02-10 06:47:06'),
(5, 'ORD-698B21A1D3F80', 153.52, 10.63, 10.00, 0.00, 'pending', 'pending', 'cash_on_delivery', '{\"name\":\"Jone Doe\",\"email\":\"t@t.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', '{\"name\":\"Jone Doe\",\"email\":\"t@t.com\",\"phone\":\"1234567890\",\"address_line_1\":\"123 Test St\",\"address_line_2\":\"Apt 4B\",\"city\":\"Testville\",\"state\":\"Idaho\",\"postal_code\":\"12345\",\"country\":\"United States\"}', NULL, 3, '2026-02-10 06:46:33', '2026-02-10 06:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_histories`
--

CREATE TABLE `order_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `previous_status` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `changed_by_type` varchar(255) NOT NULL DEFAULT 'system',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_histories`
--

INSERT INTO `order_histories` (`id`, `order_id`, `status`, `previous_status`, `notes`, `user_id`, `changed_by_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'processing', 'pending', NULL, 1, 'admin', '2026-02-10 04:33:30', '2026-02-10 04:33:30'),
(2, 1, 'pending', 'processing', NULL, 1, 'admin', '2026-02-10 04:33:33', '2026-02-10 04:33:33'),
(3, 1, 'delivered', 'pending', NULL, 1, 'admin', '2026-02-10 04:33:37', '2026-02-10 04:33:37'),
(4, 2, 'shipped', 'pending', NULL, 1, 'admin', '2026-02-10 06:35:47', '2026-02-10 06:35:47'),
(5, 3, 'cancelled', 'pending', 'Order cancelled: Test Denger', 1, 'admin', '2026-02-10 06:47:06', '2026-02-10 06:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_sku`, `price`, `quantity`, `total`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Quos Ab Officiis', 'ODJ-8005', 132.89, 1, 132.89, NULL, '2026-02-10 04:31:46', '2026-02-10 04:31:46'),
(2, 2, 12, 'Ipsam Dolorem Accusamus', 'EWN-4749', 469.63, 1, 469.63, NULL, '2026-02-10 04:32:25', '2026-02-10 04:32:25'),
(3, 2, 15, 'Rerum Libero Eligendi', 'YCZ-5397', 786.37, 1, 786.37, NULL, '2026-02-10 04:32:25', '2026-02-10 04:32:25'),
(4, 3, 14, 'Iure Earum Libero', 'LWM-2842', 601.81, 1, 601.81, NULL, '2026-02-10 04:32:56', '2026-02-10 04:32:56'),
(6, 5, 2, 'Quos Ab Officiis', 'ODJ-8005', 132.89, 1, 132.89, NULL, '2026-02-10 06:46:33', '2026-02-10 06:46:33');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `track_quantity` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `images` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `compare_price`, `sku`, `stock_quantity`, `track_quantity`, `is_active`, `images`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Et Ut Earum', 'et-ut-earum', 'Est minus in eum alias totam. Expedita quibusdam et non est magnam aut nam. Velit ea adipisci ex ipsam. Perspiciatis id aut dolorum eius aut.\n\nAd modi id accusamus exercitationem. Nihil officiis impedit repellendus molestias commodi nam qui.\n\nDeleniti nisi dolores omnis harum. Est nihil officiis natus fuga laboriosam. Iure doloribus et sapiente et sequi consectetur nobis. Dolores et et natus eum et nesciunt earum nesciunt.', 691.86, NULL, 'YKT-3940', 12, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/006655?text=product+rerum\",null]', 1, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(2, 'Quos Ab Officiis', 'quos-ab-officiis', 'Fugit tenetur nisi ipsam eos assumenda dolor dolorem autem. Velit facere vel aut veniam. Libero ullam qui non voluptatem.\r\n\r\nUnde sed et libero reprehenderit sunt iure aperiam. Et sed est amet.\r\n\r\nVoluptatem omnis ipsam beatae iste ducimus veritatis modi. Tenetur laborum ipsa recusandae totam. Est et corrupti commodi nam maiores pariatur. Consequatur quas voluptatem ut fugiat odio nesciunt.', 132.89, 183.81, 'ODJ-8005', 95, 1, 1, '[\"products\\/1770717598_698b019e69e28.jpg\"]', 1, '2026-02-10 04:27:58', '2026-02-10 06:47:20'),
(3, 'Atque Fugit Voluptatem', 'atque-fugit-voluptatem', 'Nobis consequatur atque repellendus non. Cum nulla hic distinctio tenetur distinctio esse ratione.\n\nDolor delectus eligendi non ad excepturi. Ea qui molestias cumque praesentium. Voluptate impedit possimus facere. Amet iure voluptates aut.\n\nIllum et suscipit officia laudantium consequatur. Aliquid voluptatem voluptatem voluptatibus rem sit vel ut. Mollitia nulla atque soluta quia.', 291.07, NULL, 'WZT-9940', 31, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00bbcc?text=product+omnis\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00aa99?text=product+dolores\"]', 1, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(4, 'Eum Qui Quis', 'eum-qui-quis', 'Voluptatibus ut et dolor dolores aut soluta illum. Voluptatem animi et architecto impedit. Ipsum natus nemo quam repellat consequatur.\n\nIpsa cum recusandae repellendus eos ipsum. Cumque magnam error voluptatem voluptatem. Quo ad nihil qui id numquam. Sint ut dolore amet in et voluptatem.\n\nId quia nihil laboriosam quibusdam eius quia. Quidem consequatur totam non enim pariatur. Perspiciatis sit in ab nihil tempore officia provident dicta. Atque pariatur corrupti reiciendis possimus aut. Eaque qui id et ab ratione.', 587.51, NULL, 'FDJ-7397', 28, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/007799?text=product+provident\",null]', 1, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(5, 'Aut Eligendi Dolor', 'aut-eligendi-dolor', 'Modi possimus et soluta voluptas natus quibusdam. Voluptatem velit quisquam quo veniam dolorem eum architecto. Voluptas laboriosam aspernatur deserunt veritatis.\n\nQuis itaque cum velit vero ipsa at. Sit molestiae sunt sit dolorem eius dolorum. Facilis corporis vitae cum dignissimos et modi.\n\nFacilis accusamus fugit fugit iste vero ut possimus qui. Earum dolorem sit magni ipsum consectetur. Illum quasi laboriosam dignissimos non dolores eaque atque.', 105.02, NULL, 'IKR-5178', 12, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ff33?text=product+omnis\",null]', 1, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(6, 'Voluptatem Recusandae Mollitia', 'voluptatem-recusandae-mollitia', 'Reprehenderit reiciendis quis dolor omnis explicabo perferendis magnam. Explicabo mollitia fugit quos libero nostrum nulla. Quas nulla odio provident iure.\n\nFugiat officia maiores accusamus dolorum aut. Laboriosam odio voluptatum et non est iusto id. Sed quidem voluptatum consequatur non maiores.\n\nTempore quis commodi eum voluptatem et. Quasi rerum quas totam nihil minima culpa temporibus.', 114.03, NULL, 'CUU-3244', 0, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/009966?text=product+placeat\",null]', 2, '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(7, 'Aliquid Cumque Fuga', 'aliquid-cumque-fuga', 'At pariatur doloribus ut in. Incidunt nisi ad a vitae quis velit ipsam. Et et vero maiores ex cumque voluptates officia. Odit odit voluptatibus est asperiores cumque. Exercitationem quo cupiditate ut sint commodi.\n\nMinima molestias et libero magni. Nihil et dolorem aut nihil officia aut aut. Ea magnam soluta hic est non id.\n\nVoluptas minima distinctio provident enim aperiam fuga aut. Totam sint dicta est ab soluta. Eum facere amet alias architecto. Odio amet optio inventore commodi exercitationem quibusdam.', 207.20, NULL, 'CSD-6007', 75, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0033ee?text=product+quae\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/002255?text=product+ut\"]', 2, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(8, 'Ratione Itaque Non', 'ratione-itaque-non', 'Vitae voluptatem et qui aperiam rem molestiae. Eaque voluptatum nulla sed. Nemo sit quibusdam quaerat porro saepe. Officia neque est repellendus rerum voluptatem eveniet voluptas quibusdam.\n\nAdipisci dolore accusamus accusantium. Quibusdam rerum veniam dolores consequatur saepe ratione assumenda. Et iure earum id dolores quam consectetur. Repellat delectus velit aut expedita nemo sit.\n\nUnde necessitatibus omnis natus voluptatum magni qui harum. Nemo reprehenderit quis quia nisi quia nihil ipsam. Velit molestias eligendi ut atque amet qui rem ipsa. Magni qui placeat qui corrupti reprehenderit id.', 657.97, NULL, 'YVL-5248', 30, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/001122?text=product+aliquid\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ee88?text=product+temporibus\"]', 2, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(9, 'Doloribus Quod Aut', 'doloribus-quod-aut', 'Rerum soluta fuga id velit velit maiores repellendus delectus. Ut rerum enim ipsum fugit ea vel. Est voluptate recusandae consequuntur voluptatibus vero atque libero quis.\r\n\r\nCupiditate ratione hic soluta aspernatur ut. Eveniet alias cum accusantium fugit. Sed asperiores magnam eos qui molestias amet.\r\n\r\nVoluptatum et fugit dolore ut. Quibusdam est aut alias eveniet accusantium similique aut. Vel ducimus sit aut ipsam aut rem. Molestiae accusamus blanditiis amet.', 305.19, 314.56, 'KIQ-4866', 93, 1, 1, '[\"products\\/1770720549_698b0d251030b.jpg\"]', 2, '2026-02-10 04:27:59', '2026-02-10 05:19:09'),
(10, 'Dolores Suscipit Nihil', 'dolores-suscipit-nihil', 'Aut voluptatibus assumenda et voluptas nisi qui modi sint. Laudantium inventore voluptatibus saepe a ut error. Aliquam odit qui repudiandae sit velit.\n\nQui aliquid eligendi enim laborum reiciendis. Saepe error eos numquam ea ipsam. Fugiat et at dolores adipisci facilis blanditiis dicta. Architecto distinctio neque officiis perspiciatis. Reprehenderit mollitia consequuntur amet repellat ad architecto id.\n\nSint ducimus ipsum vel quia repellendus. Labore totam sed dolorum nemo. Nam vel impedit deserunt quidem qui aperiam cum.', 275.26, NULL, 'ZDD-1538', 6, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ee99?text=product+incidunt\",null]', 2, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(11, 'Sunt Earum Veniam', 'sunt-earum-veniam', 'Quo aut at animi voluptatem. Nam molestiae aliquam qui ipsam perferendis sit sint. Aperiam sed similique ut harum aut.\n\nDolorem occaecati ut et et. Assumenda sed id molestiae ea officia. Excepturi et quis consequatur asperiores fuga. Dolores doloremque veritatis itaque in dolorum in maiores.\n\nDolor et quis dolorem repellat tempore perferendis sed quaerat. Voluptas incidunt est fugiat molestias. Nihil aspernatur voluptates delectus et.', 746.47, NULL, 'BDY-4195', 60, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0011cc?text=product+molestias\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0011bb?text=product+eius\"]', 3, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(12, 'Ipsam Dolorem Accusamus', 'ipsam-dolorem-accusamus', 'Non distinctio et vero eligendi repellat facere. Numquam vel aliquid eius qui. Dolor ea cum quia officiis harum ullam cumque tenetur. Corporis excepturi enim modi dolores praesentium blanditiis ipsam est. Quia officia ex et explicabo mollitia omnis laudantium.\r\n\r\nVoluptatem minima a ex laborum. Doloremque inventore velit enim dolores autem eos. Sit sint est quod.\r\n\r\nQuia et facere ratione aliquid voluptatum. Minima cumque aliquam iusto. Quidem id et quaerat perferendis. Laudantium magnam in quis non illum rerum cumque.', 469.63, 655.06, 'EWN-4749', 98, 1, 1, '[\"products\\/1770717647_698b01cfc5b5d.jpg\"]', 3, '2026-02-10 04:27:59', '2026-02-10 04:32:25'),
(13, 'Sint Esse Voluptas', 'sint-esse-voluptas', 'Voluptatum et possimus quaerat delectus maiores facere. Expedita architecto porro ut odit. Dignissimos tenetur numquam ut nemo dignissimos quod.\n\nSed veniam aut id voluptate non ut. Neque culpa est minima. Qui quis occaecati id in omnis qui. Ad aperiam ducimus corporis delectus corporis.\n\nOdio porro rerum ut quos perferendis. Voluptate consectetur velit facere dignissimos laboriosam ad cumque nobis. Aperiam doloremque nulla voluptas maiores.', 497.20, NULL, 'ETX-4130', 85, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ee33?text=product+voluptatem\",null]', 3, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(14, 'Iure Earum Libero', 'iure-earum-libero', 'Qui sint velit nulla non doloremque animi exercitationem. Asperiores itaque facilis non fugiat rerum maxime praesentium. Perferendis occaecati odit sequi dolores laboriosam est error. Sunt eos dolore minima aut nulla numquam ut.\r\n\r\nRerum dicta assumenda qui cupiditate corrupti laborum iste. Voluptas quod beatae eos animi ex natus consequuntur. Qui facilis sunt facere ex eveniet aut repellendus. Nesciunt eos nisi corporis minus eligendi sequi occaecati libero. Voluptas et consequatur modi sit dolores enim quia est.\r\n\r\nVelit iste non possimus excepturi magni est voluptas. Rerum sit ducimus soluta consequatur rerum. Est vitae et quia est. Exercitationem adipisci ut esse.', 601.81, 772.45, 'LWM-2842', 28, 1, 1, '[\"products\\/1770717666_698b01e279dfb.jpg\"]', 3, '2026-02-10 04:27:59', '2026-02-10 06:47:06'),
(15, 'Rerum Libero Eligendi', 'rerum-libero-eligendi', 'Dignissimos libero rem numquam officia. Expedita et repellat eos aliquam ea exercitationem. Totam et quas ut rerum.\n\nConsequatur non et et rerum eos eos. Ab et delectus magni assumenda. Magni voluptatem nam ut quos. Ducimus est assumenda necessitatibus magni harum.\n\nCumque adipisci eveniet soluta quisquam ullam. Praesentium delectus maiores reiciendis quia. Aliquid harum amet minima accusamus ipsum nam ipsa.', 786.37, 1170.23, 'YCZ-5397', 43, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0044cc?text=product+non\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/004488?text=product+minima\"]', 3, '2026-02-10 04:27:59', '2026-02-10 04:32:25'),
(16, 'Quam Qui Voluptatum', 'quam-qui-voluptatum', 'Laborum aut sed sed qui. Aut voluptas sunt culpa. Impedit tempora ad nulla et doloremque. Ratione tenetur veniam consequuntur dolor veniam eligendi qui.\n\nEsse eos non quia quas. Earum iste eos in fugit. Placeat quidem quaerat iusto est. Veniam quas at quas nam.\n\nAliquid sunt non excepturi provident. Recusandae dolorum itaque assumenda soluta assumenda reprehenderit. Omnis eaque error repudiandae tenetur alias.', 844.94, NULL, 'HMN-4485', 7, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0077aa?text=product+suscipit\",null]', 4, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(17, 'Nesciunt Sit Nam', 'nesciunt-sit-nam', 'Et repellendus et alias ut vitae magni perferendis vel. Quas aut libero deleniti delectus rerum ab voluptas. Voluptatem voluptas iure maiores.\n\nAut iste et omnis odio possimus iusto aut voluptate. Corporis pariatur autem et molestias tempore libero minus officiis. Possimus a fugit vel eaque.\n\nPariatur voluptatem repellendus omnis ad. Blanditiis aspernatur cupiditate deserunt dolor nihil odit.', 783.42, NULL, 'AIX-6773', 15, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/002200?text=product+laboriosam\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ff11?text=product+mollitia\"]', 4, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(18, 'Tenetur Architecto Eius', 'tenetur-architecto-eius', 'Voluptatem nemo quo nam cupiditate aspernatur illo voluptas. Quidem similique exercitationem sint velit. Et rerum ut expedita quam. Ea quae id ut. Voluptas repellendus hic error aut dolores accusamus vel quis.\n\nIste consequatur a corporis in vel beatae. Ad corporis quibusdam eum molestiae et dignissimos tempora. Dolorum eius laboriosam nesciunt assumenda quasi quo quia. Ab quia autem dolores reiciendis dolores delectus.\n\nIpsa iure ipsam et officia eos. Distinctio mollitia accusamus et consequatur. Nam numquam nam enim non minus et rerum. Provident omnis tenetur ut sapiente voluptas. Et amet possimus quidem voluptate omnis facilis et.', 548.94, 821.70, 'USE-8240', 42, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0033aa?text=product+adipisci\",null]', 4, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(19, 'Qui Aut Distinctio', 'qui-aut-distinctio', 'Id libero repellendus ut et. Magni qui laboriosam necessitatibus tenetur error. Velit est voluptatem totam illo illum fugiat. Optio facere quidem exercitationem ut officia non culpa.\n\nIusto ut maiores sunt. Enim autem quo quibusdam harum enim. Et et corporis vero assumenda facilis et aut ratione. Adipisci aperiam vel accusamus dolore sunt sed dolorem. Autem consequatur rerum est deleniti porro quidem.\n\nQuis quibusdam fugit sint consectetur sed aut. Laborum non velit in enim. Ab voluptatem sequi earum ea temporibus. Vitae nihil doloribus velit dolorem quasi culpa accusamus.', 724.03, NULL, 'CZI-8490', 59, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0066aa?text=product+aut\",null]', 4, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(20, 'Quia Enim Ipsum', 'quia-enim-ipsum', 'Porro libero doloribus ut dolorem. Accusamus voluptas dolorem culpa similique natus. Est distinctio eos itaque nemo maiores maxime.\n\nTempora ut praesentium aperiam voluptatem. Recusandae atque ipsam alias magnam reprehenderit qui et. Corrupti sapiente autem suscipit ab dicta est optio et. Cupiditate eum suscipit quam rerum eaque fugiat.\n\nAdipisci id quia ducimus molestiae. Aperiam qui ea possimus. Voluptate occaecati deserunt unde nisi officiis autem debitis.', 396.03, 541.31, 'KYJ-1422', 23, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00dd22?text=product+qui\",null]', 4, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(21, 'Ut Totam Ullam', 'ut-totam-ullam', 'Velit quibusdam nihil voluptatem explicabo quis facere magni sed. Nulla voluptates animi ad quis laborum dolore aut. Corporis facere voluptatem quisquam saepe. Aut repudiandae deserunt ipsum sapiente.\n\nDelectus sed neque sint neque voluptatem. Et error laborum sunt odio. Aliquid rem est ipsa facere autem sed officiis.\n\nUt facere perspiciatis totam neque voluptatibus. Consequatur id quis culpa modi reprehenderit et est minus.', 125.05, NULL, 'YTS-2286', 48, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0011cc?text=product+veritatis\",null]', 5, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(22, 'Itaque Labore Et', 'itaque-labore-et', 'Distinctio ratione deleniti unde veritatis voluptas quisquam at. Expedita ut expedita ut ad illum. Sed sit alias id dolores illum enim. Porro quia dolorem voluptatem error et. Minus qui et dolores ut.\n\nNeque non dolores delectus tempora. Non fugit molestias et minima sit. Consequatur sit non est sit perferendis enim. Doloremque doloremque impedit exercitationem dolorum ullam perferendis iure.\n\nEst illo dignissimos in voluptatem voluptatibus explicabo eum. Ipsum eaque facilis sit omnis illum quam consequatur. Quam voluptatibus laboriosam cupiditate temporibus beatae ex. Est atque laudantium quod voluptatum eum quisquam officia.', 356.67, NULL, 'AOQ-7680', 78, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0044ff?text=product+quia\",null]', 5, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(23, 'Veritatis Molestias Accusamus', 'veritatis-molestias-accusamus', 'Autem expedita iusto exercitationem amet sit enim. Consequuntur repellendus iusto eaque qui exercitationem cupiditate et est. Ex sit illo aspernatur corrupti.\n\nNostrum porro deserunt quae ea laboriosam optio. Et et sint cupiditate amet odio occaecati. Qui a voluptas fuga rerum velit vitae et. Dolore enim quos ipsum et quae est non.\n\nQui qui et dolor voluptatem sit quod maiores nisi. Quaerat et id officiis id ut necessitatibus.', 54.71, 67.76, 'VZW-9309', 76, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/007777?text=product+non\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0033aa?text=product+quia\"]', 5, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(24, 'Et Nesciunt Maiores', 'et-nesciunt-maiores', 'Velit molestias ipsa ea. Cumque quos reiciendis dolorem praesentium voluptatum consequatur. Reprehenderit pariatur illo libero qui perspiciatis rerum. Magni laboriosam nostrum animi blanditiis corporis voluptatem ut rerum.\n\nSapiente qui et facere excepturi autem excepturi in. Beatae et enim vel non eum autem. Sequi molestiae neque perferendis. Eum sit ex qui qui sint aut.\n\nBlanditiis sit deserunt aut veniam minima magni. Dolorem saepe voluptatem et necessitatibus voluptates nesciunt. Dolor doloremque nemo dolores magnam et neque natus.', 507.73, 715.09, 'RPG-9624', 25, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/004455?text=product+ut\",null]', 5, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(25, 'Est Non Sunt', 'est-non-sunt', 'Alias nulla magnam qui esse. Debitis sit temporibus consectetur molestias voluptate excepturi. Et assumenda assumenda alias occaecati nisi eos aperiam.\n\nError in quis quia in incidunt soluta aut. Velit et in facilis pariatur. Labore error eaque esse qui. Sed consequuntur natus et esse quia blanditiis laudantium.\n\nConsequatur deserunt velit aut omnis. Modi aliquid perferendis ut minus laborum voluptatem. Dicta tempore a et ipsum delectus minima.', 347.79, 511.03, 'ANB-2110', 48, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ffbb?text=product+aut\",null]', 5, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(26, 'Consectetur Iusto Odio', 'consectetur-iusto-odio', 'Sunt atque molestias est nihil debitis. Possimus aliquam ratione minima non quasi reprehenderit. Sapiente totam cupiditate sit et recusandae aliquam necessitatibus. Natus ea rerum quis consequatur.\n\nAspernatur dignissimos doloremque dolores recusandae non dolores. Ea officiis est ut est provident ipsa. Autem cumque tenetur mollitia fuga earum perferendis. Iusto tenetur consequatur quis recusandae sapiente voluptatibus suscipit.\n\nNulla eaque et voluptatem harum. Quia facilis autem doloremque neque magnam rerum et. Quod est nostrum quas quo cupiditate sit dolores.', 88.79, NULL, 'USJ-1642', 35, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/000099?text=product+molestiae\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0000ee?text=product+repudiandae\"]', 6, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(27, 'Enim Veniam Commodi', 'enim-veniam-commodi', 'Minima eius facere consequatur quo minus. Enim odio excepturi et est aut dolorem id. Sit et et repellendus laborum iste.\n\nAut adipisci recusandae voluptas nulla a quasi. Eos veniam rerum dolorum ut quisquam. Ut ipsum et est molestiae. Rem amet fugiat sunt temporibus at vel delectus magni.\n\nUnde quas aliquam dolorem quia deleniti. Et est autem a dolor omnis molestiae. Reiciendis maiores est officiis consectetur sint dolorem. Ut et et autem sit illo sed veritatis.', 950.77, NULL, 'GXR-2887', 0, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0088dd?text=product+ut\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/002233?text=product+quo\"]', 6, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(28, 'Debitis Et In', 'debitis-et-in', 'Quia nemo et porro. Quia ut non dolores unde. In non illum non corporis rerum eveniet. Facilis id ea voluptatibus praesentium.\n\nSimilique quia aliquam autem non. Dolorum nesciunt occaecati placeat laudantium cumque qui. Possimus molestiae et vero voluptate quam culpa assumenda.\n\nEst atque recusandae provident consequatur cum. Ut itaque vero id suscipit recusandae ut omnis. Consequatur recusandae nisi sed voluptas sit vero. Laborum possimus sint omnis voluptate deserunt sit. Odio quis autem tempore non.', 363.33, NULL, 'QIX-5968', 67, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00bb88?text=product+dolore\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/003355?text=product+et\"]', 6, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(29, 'Earum Et Dolorem', 'earum-et-dolorem', 'Eveniet in est saepe maiores. Consequatur culpa nisi ipsa reiciendis. Tempore quia adipisci debitis nihil.\n\nVoluptas velit voluptas et velit tempora. Ea nulla cumque quaerat ut nesciunt incidunt. Iusto soluta odit blanditiis aliquam perspiciatis velit laboriosam. Et nostrum quia et deleniti id.\n\nOptio voluptates quis qui dolores est voluptas. Aut veniam sunt qui fugit. Consequatur exercitationem non dolor aspernatur quos sit blanditiis dolor. Quaerat in est ex quae et quam. Ipsam eos eveniet ut quibusdam.', 496.80, 570.64, 'OQP-6499', 68, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/004488?text=product+dicta\",null]', 6, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(30, 'In Minus Quia', 'in-minus-quia', 'Maiores voluptate ex et est quos itaque. Illum repellat est asperiores rerum quis enim quas. Porro officiis nisi et voluptatum voluptatem totam similique est.\n\nAt corrupti ipsum cumque natus. Commodi perspiciatis quaerat harum totam sed debitis consequatur consequuntur. Maiores incidunt ut non laudantium.\n\nItaque consequuntur quia sit nulla. Dolorum ad nam et necessitatibus magnam ratione magni. Est quasi ut qui aut maiores beatae. Et et impedit reiciendis.', 682.95, NULL, 'MTH-2651', 34, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0099dd?text=product+quos\",null]', 6, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(31, 'Ab Molestiae Cumque', 'ab-molestiae-cumque', 'Ut et tempora quia atque blanditiis sed. Quibusdam facilis officiis earum minima magni velit repellat. Quo veritatis suscipit aliquid tempore.\n\nCorrupti aut natus et omnis. Doloribus et natus itaque dolores autem cum quod sed. Culpa iusto laborum et qui. Saepe sit earum eos qui officia nisi.\n\nEt qui enim maxime repellendus laborum vitae. Est et facilis odit enim voluptatem soluta. Est dicta qui omnis aut velit. Incidunt molestiae quia ipsam asperiores quod velit natus.', 506.58, 633.37, 'JNU-8829', 51, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00bbee?text=product+quas\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0022ff?text=product+accusantium\"]', 7, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(32, 'Labore Voluptatem Assumenda', 'labore-voluptatem-assumenda', 'Nam aliquam odio dolorem beatae aliquam perspiciatis explicabo. Distinctio rerum quia corporis quo.\n\nMinima iure nostrum optio nemo culpa et. Nesciunt atque impedit consequatur cum. Aliquam et excepturi voluptas recusandae corrupti sint. Eius commodi aperiam amet quibusdam.\n\nIllum quis accusamus non repellendus. Quis est est enim ipsum ut sed dolores. Eum et excepturi dolorum suscipit aut optio praesentium.', 919.25, NULL, 'UZE-3181', 44, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ff55?text=product+eaque\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc99?text=product+amet\"]', 7, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(33, 'Blanditiis Assumenda Quod', 'blanditiis-assumenda-quod', 'Adipisci reiciendis aut esse molestias deserunt a. Nihil reprehenderit velit delectus voluptas sit ducimus aspernatur. Est ex quae placeat. Dolor ducimus ut sed consequatur voluptates.\n\nDoloribus tempora sed neque fugiat voluptatem officia. Praesentium autem pariatur pariatur blanditiis alias deleniti sed.\n\nAperiam cupiditate et non aut voluptatem modi. At quidem qui et suscipit velit. Officia rerum id et dolorem repudiandae dolorum. Sed similique ut dolore ipsam sed nostrum omnis.', 231.94, 328.67, 'FGN-5526', 39, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ccee?text=product+et\",null]', 7, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(34, 'Quod Consequuntur Molestiae', 'quod-consequuntur-molestiae', 'Nostrum eos soluta aspernatur. Vero vero fugit ut repudiandae dolor. Sint omnis necessitatibus modi culpa molestiae. Quasi aut exercitationem dolores eius non voluptatum. Repellat dolorem nam dolores aut.\n\nVeniam qui facere eos et quam nulla possimus. Omnis numquam et sunt. Voluptas accusamus perferendis repudiandae dolorem inventore laborum dolor.\n\nVoluptatum eum consequuntur impedit unde eaque neque molestias veniam. Voluptas similique nostrum est maxime fuga aut ea. Non distinctio aspernatur corrupti mollitia libero nesciunt.', 548.77, NULL, 'ODG-4232', 4, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0077bb?text=product+voluptatibus\",null]', 7, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(35, 'Ut Quibusdam Minima', 'ut-quibusdam-minima', 'Quasi earum ea aut iste ut voluptatem. Totam accusamus molestias eveniet debitis laborum. Architecto explicabo omnis animi qui.\n\nVoluptatem mollitia tenetur error voluptas. Et qui consectetur atque et aut mollitia voluptates voluptas. Rerum expedita eum eum fugit modi corporis. Explicabo ut ipsam odio.\n\nCommodi nulla quia quas odit consequatur tempore omnis. Cupiditate sed facilis quia nobis veritatis voluptas. Est quia modi sequi enim maxime.', 512.57, NULL, 'NSN-8000', 96, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/009900?text=product+consectetur\",null]', 7, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(36, 'Sed Quia Laboriosam', 'sed-quia-laboriosam', 'Ea sunt pariatur odit placeat. Culpa veniam consequatur mollitia velit id rerum. Consequatur sint laborum ut cumque. Eveniet dolores praesentium voluptas rerum modi earum.\n\nOfficiis officiis amet ut qui. Qui a ut dignissimos qui ea. Quae sequi molestias quo tenetur est.\n\nMollitia repellendus reprehenderit aut accusantium esse ad. Dolorem et a rem est aut voluptas eos. Dignissimos consequuntur rem aut quos sed eligendi.', 387.50, 516.32, 'RGT-9837', 25, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0099cc?text=product+quia\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/009911?text=product+ipsa\"]', 8, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(37, 'Id Facere Iure', 'id-facere-iure', 'Facere vel rem iusto voluptate earum delectus hic. Sed quia et aut optio eligendi ratione. Est eum rem sunt sunt non. Quia molestiae unde laudantium temporibus est non officia et.\n\nExcepturi et accusamus dolores sit. Voluptatibus est nisi at quia est. Dolor praesentium distinctio voluptate excepturi rerum laudantium velit.\n\nIn vitae vel repellendus aut itaque eos. Eaque consequatur quas eum doloribus sed. Accusamus cumque perspiciatis perspiciatis autem.', 897.07, 1156.59, 'PEX-2772', 24, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ee66?text=product+quasi\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0033cc?text=product+itaque\"]', 8, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(38, 'Autem Cumque In', 'autem-cumque-in', 'Praesentium et amet odio odit reiciendis ut. Incidunt id veritatis debitis excepturi quia repudiandae consequuntur.\n\nMaiores corporis exercitationem dolor commodi incidunt ut. Voluptatibus sed quibusdam adipisci quas nostrum. Praesentium sed tenetur reprehenderit in nesciunt occaecati.\n\nError et quidem eligendi ullam impedit. Est omnis blanditiis illum eligendi cupiditate. Architecto deserunt consequatur et id molestiae ut fuga suscipit.', 183.91, NULL, 'OGP-3432', 87, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/005544?text=product+nihil\",null]', 8, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(39, 'Tempora Officia Expedita', 'tempora-officia-expedita', 'Et explicabo non nemo provident omnis. Illum rem occaecati tempore. Ipsum et odit sunt cum aliquam accusantium repellendus dolorem.\n\nNumquam velit exercitationem quo. Consectetur dolores vero autem dicta qui sed quos dolorum. Nihil laudantium et consequatur autem. Qui ut recusandae animi dolorem tempora vero nostrum sunt.\n\nNon quaerat libero praesentium autem amet. Qui rerum non distinctio occaecati quo mollitia dolore. Harum fugit corporis quisquam qui. Velit velit alias tempore a voluptatem.', 583.95, 689.77, 'ESI-8015', 97, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/008866?text=product+aut\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/004466?text=product+quae\"]', 8, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(40, 'Dolore Et Non', 'dolore-et-non', 'Libero nihil et vitae assumenda. Adipisci rem voluptas unde quia rerum est. Aspernatur odio error eligendi eum non. Voluptatem nesciunt voluptas debitis qui.\n\nMinima delectus et saepe quae est. Sit rem sed adipisci error temporibus. Ut blanditiis iure earum exercitationem deserunt sed sint.\n\nEnim praesentium unde laudantium molestiae numquam. Suscipit voluptatem sit nihil ad nisi provident. Consequatur iusto deserunt ipsa at et assumenda aut. Et minima sapiente saepe qui tenetur sint rem.', 867.90, 1133.51, 'HHE-8119', 96, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/002277?text=product+ea\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/008844?text=product+officia\"]', 8, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(41, 'Voluptas Et Ut', 'voluptas-et-ut', 'Officia inventore molestias autem. Quas aut dicta voluptates autem ullam. Itaque ea ipsam sed.\n\nItaque autem ab aut iusto nihil. Rerum perferendis illum aut dolores molestias.\n\nSapiente et aut non sit non. Quaerat pariatur temporibus magni et architecto. Eius sit repellendus ut vel omnis et id. Sed quia deserunt illum minima.', 501.50, NULL, 'BHF-7258', 95, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/005544?text=product+delectus\",null]', 9, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(42, 'Sint Architecto Sint', 'sint-architecto-sint', 'Earum facilis sed eligendi ex eveniet quae itaque aut. In quod quasi ut. Maiores tenetur dolorem ipsam.\n\nAut ratione natus nam consequatur numquam et. Vitae suscipit quam sit consequuntur facilis. Molestias illum corporis voluptatem nisi cum.\n\nEnim nemo excepturi consequatur necessitatibus. Beatae voluptas est dicta ipsum aut.', 14.94, 19.85, 'HIX-6017', 14, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0011cc?text=product+deserunt\",null]', 9, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(43, 'Ea Et Voluptatem', 'ea-et-voluptatem', 'Deserunt quis doloremque et sequi animi voluptatem. Et excepturi debitis sed quod quia et veniam. Iste dolor omnis dolores aliquid facere illum qui.\n\nEt qui ut mollitia et voluptate dolor deleniti. Doloremque sed accusamus pariatur beatae. Ducimus sed consectetur qui odio. Corrupti ab error sapiente explicabo.\n\nAtque libero in ipsam. Blanditiis praesentium dolores animi velit.', 747.81, NULL, 'GGB-1402', 7, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/005533?text=product+quasi\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00bb11?text=product+dicta\"]', 9, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(44, 'Molestias Aspernatur Eaque', 'molestias-aspernatur-eaque', 'Sequi voluptates enim deleniti consequatur non. Enim quisquam soluta totam ad asperiores dicta porro aliquam. Deleniti commodi voluptas officia error. Ut ut sed laboriosam quaerat explicabo et eaque quia.\n\nTempora eveniet minus quo. Suscipit nobis saepe itaque ab. Ducimus ratione enim aut architecto.\n\nBlanditiis sunt voluptate sint laboriosam voluptatibus nihil. Non quasi sit ea voluptatem dicta culpa commodi eius.', 684.15, NULL, 'DME-6066', 19, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc77?text=product+ut\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00bb55?text=product+numquam\"]', 9, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(45, 'Labore Velit Illum', 'labore-velit-illum', 'Qui atque tenetur quisquam hic fugiat sunt vel. Nobis debitis atque doloremque debitis quia autem. Ea praesentium saepe eaque cupiditate ut.\n\nQuaerat accusantium dolorem quas et et quas. Deleniti non deserunt ullam incidunt est. Eveniet quae voluptatem unde quisquam error autem illo. Asperiores voluptatem unde saepe sit.\n\nEsse eos non exercitationem temporibus eos. In est ut commodi provident laborum. Accusantium mollitia ducimus asperiores voluptas.', 398.46, 421.93, 'YDW-2608', 58, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/008888?text=product+cumque\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/001155?text=product+non\"]', 9, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(46, 'Ut Qui Debitis', 'ut-qui-debitis', 'Itaque dolores nobis reiciendis et porro eos velit. Voluptatibus ratione et consequatur. Eos neque dolorum veniam aut non quas tempore. Voluptas cupiditate repellendus earum nihil tempore perspiciatis molestiae.\n\nSuscipit impedit ratione at. Architecto dolorem voluptatem fuga. Velit impedit quia et earum minima dolores.\n\nExercitationem voluptatem et sint quasi asperiores dolor est. Eum ipsa commodi ipsa. Velit expedita provident repellat beatae nulla quis. Non possimus voluptates et molestias quam necessitatibus dolores.', 422.47, NULL, 'XMB-9175', 75, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc33?text=product+dolorum\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00aa44?text=product+non\"]', 10, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(47, 'Et Reiciendis Ipsa', 'et-reiciendis-ipsa', 'Est aut consequuntur officiis adipisci fugit velit minima. Placeat et recusandae nihil molestiae dolores qui. Quia aut eum praesentium aperiam.\n\nSapiente eaque hic id dolorem quod. Non id error doloremque. Dignissimos voluptatem in unde corporis et est doloribus consequatur. Laudantium maxime facere dolores aut reprehenderit ea quas.\n\nQuisquam consectetur voluptatem dolor sunt similique incidunt dolor. Nisi itaque id rerum ipsa iure et.', 881.58, NULL, 'LBK-3986', 90, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0033dd?text=product+laborum\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc88?text=product+id\"]', 10, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(48, 'Et Cumque Voluptatibus', 'et-cumque-voluptatibus', 'Alias et voluptatem labore repellendus. Commodi sit non animi eos. Dolores numquam occaecati sit quia sint voluptatem vero recusandae.\n\nVel soluta commodi quos fuga. Modi non ipsam ea et porro quaerat fugit. Ut atque laboriosam cum omnis accusamus sit fuga. Qui architecto ipsam consectetur aliquam excepturi.\n\nHic nostrum quos et voluptatibus iusto est magni sit. Praesentium aliquam doloribus esse quia praesentium animi nam. Dolorem fugiat aut possimus veniam aut. Ut consectetur placeat dolores porro labore voluptas.', 803.54, NULL, 'IUT-8450', 13, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00aa66?text=product+ut\",null]', 10, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(49, 'Non Sint Amet', 'non-sint-amet', 'Vero eum doloribus deleniti possimus aspernatur. Et et et mollitia officiis facere minima ab. Architecto nihil ipsa earum corrupti.\n\nEst ut quia ut eum saepe est laboriosam aperiam. Facere aliquam aut mollitia odio id. Quo ex sed enim neque dolor est. Et dolor repudiandae atque qui voluptatem. Error nobis dignissimos quibusdam iure et.\n\nConsequatur non et soluta est in vel et ut. Illum laboriosam laboriosam sed et quisquam. Rerum ullam qui molestiae officia.', 893.80, NULL, 'EOF-4493', 62, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/001144?text=product+at\",null]', 10, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(50, 'Et Sunt Enim', 'et-sunt-enim', 'Est veniam ab dolores et voluptatem. Rem deserunt nobis magni vel enim sint non. Et et voluptatum hic maxime.\n\nAperiam eius quo omnis voluptatibus aliquid commodi pariatur. Quia in expedita aut et. Itaque soluta nihil esse dignissimos accusamus. Ipsam quisquam eos aut impedit ab sit cum.\n\nRerum placeat amet aliquid qui doloremque dolore. Unde autem id voluptatem reiciendis dolorum accusamus asperiores. Ab id est voluptate illum voluptatibus quis explicabo neque. Autem hic labore labore sunt aut enim.', 789.26, NULL, 'CMT-3534', 84, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/001199?text=product+quia\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/007799?text=product+consequatur\"]', 10, '2026-02-10 04:27:59', '2026-02-10 04:27:59'),
(51, 'Perferendis Ab Odit', 'perferendis-ab-odit', 'Similique at quas reiciendis dolorem velit. Ipsa asperiores non aut quo qui. Asperiores voluptas quisquam omnis autem sed quia. Dolor corrupti eligendi hic nobis.\r\n\r\nMaxime nulla facilis ipsam nihil. Assumenda autem amet doloribus a illo et dicta ex. At beatae consequuntur ea facere quaerat in id voluptas. Provident expedita nemo modi dolor. Quo dolores sed itaque sit ea.\r\n\r\nPraesentium corporis autem dolore repellat sapiente qui. Doloremque eaque eligendi incidunt adipisci odit iusto. Alias animi soluta animi sed. Distinctio aliquid adipisci maxime dolorum. Totam quia sequi at.', 355.99, NULL, 'KDY-2652', 58, 1, 1, '[\"products\\/1770720639_698b0d7fcf4ed.jpg\"]', 11, '2026-02-10 04:28:00', '2026-02-10 05:20:39'),
(52, 'Dolor Eius Dolor', 'dolor-eius-dolor', 'Ad exercitationem vitae nisi dignissimos ex sint. Sit harum rem laboriosam quidem neque voluptatem veniam. Temporibus qui aliquid laudantium enim. Temporibus ea praesentium cupiditate nihil earum doloribus.\r\n\r\nIpsa sapiente est vel et porro fugit consequatur. Et voluptates adipisci sint labore vero dolores. Iste quas neque consequatur architecto ut in recusandae magnam. Sed deserunt consequatur consequatur.\r\n\r\nEst doloremque dignissimos at. Totam error consectetur enim consectetur est ut consequuntur eum. Odio possimus cupiditate reiciendis quae ea. Explicabo velit perferendis commodi distinctio est.', 550.47, NULL, 'AOR-7389', 24, 1, 1, '[\"products\\/1770720666_698b0d9ab717b.jpg\"]', 12, '2026-02-10 04:28:00', '2026-02-10 05:21:06'),
(53, 'Porro Illo Adipisci', 'porro-illo-adipisci', 'Quisquam minus ipsa quam mollitia eum consectetur consectetur. Saepe maxime sit provident aut cupiditate minima. Omnis ut ab ab labore nisi quia. Et a eum ab quibusdam.\r\n\r\nUt eaque dolorem sit libero. Quo itaque non quidem omnis eveniet.\r\n\r\nHic fugiat nemo molestiae illo. Aliquid sit tenetur architecto consectetur non sit libero eveniet. Id rerum nostrum ut quae.', 98.70, NULL, 'QAM-2551', 47, 1, 1, '[\"products\\/1770720373_698b0c754a931.jpg\"]', 13, '2026-02-10 04:28:00', '2026-02-10 05:16:13'),
(54, 'Sint Provident Neque', 'sint-provident-neque', 'Iure ex deserunt repudiandae aut molestiae est ab iure. Dolore veniam blanditiis laudantium omnis omnis magni dolorem. Et recusandae ut excepturi perspiciatis optio officia officiis. Facilis qui aliquam officiis rerum ut.\r\n\r\nQui quo animi quos asperiores provident iste optio. Assumenda officiis dolorem omnis in esse esse delectus. Quasi qui eum libero et atque molestiae.\r\n\r\nSoluta perferendis qui hic totam modi. Est aliquid temporibus delectus aut. Corrupti iure eum animi repudiandae quaerat possimus odit.', 683.98, NULL, 'TEM-0491', 22, 1, 1, '[\"products\\/1770720599_698b0d5750475.jfif\"]', 14, '2026-02-10 04:28:00', '2026-02-10 05:19:59'),
(55, 'Culpa Et Saepe', 'culpa-et-saepe', 'Et dolor doloremque omnis exercitationem et dolorem voluptatem. Repellendus omnis vitae quaerat id vel quam maiores. Provident est ipsum culpa ut laudantium vel.\r\n\r\nNemo fugit explicabo est et. In ut enim esse quia nisi officia quam. Aut unde et et recusandae dolores incidunt.\r\n\r\nVeniam nam quasi voluptas. Eveniet dolor vero nostrum beatae. Molestias odit atque amet quia.', 754.34, 841.02, 'EXX-3705', 64, 1, 1, '[\"products\\/1770720726_698b0dd6bd5f9.jpg\"]', 15, '2026-02-10 04:28:00', '2026-02-10 05:22:06'),
(56, 'Est Neque Aut', 'est-neque-aut', 'Reprehenderit quia sint aut. Eaque illum consequatur cumque rem totam. Repellendus hic facere unde nemo vitae ipsa. Suscipit eum ut temporibus eaque.\r\n\r\nNon aut necessitatibus earum architecto explicabo praesentium. Id quo rerum odio. Provident voluptas ut occaecati repudiandae ullam hic.\r\n\r\nConsequatur ut et mollitia repellat. Alias omnis exercitationem distinctio. Quod autem deserunt veniam perspiciatis. Minima modi non rerum dolorem ut. Non eos asperiores voluptatum qui recusandae eius est.', 137.76, NULL, 'MPG-3858', 42, 1, 1, '[\"products\\/1770720774_698b0e067b793.jpg\"]', 16, '2026-02-10 04:28:00', '2026-02-10 05:22:54'),
(57, 'Provident Repudiandae Ad', 'provident-repudiandae-ad', 'Assumenda cupiditate accusamus ad neque ut. Nihil sint autem expedita quis ipsa. Fugiat reprehenderit architecto eum sed.\r\n\r\nVeritatis dolorem inventore eveniet. Distinctio aut at odit architecto. Vel cum iure et blanditiis. Rerum eius atque dolor quo voluptas cupiditate quos. Ut laudantium et nam eos.\r\n\r\nAccusantium rerum itaque reiciendis voluptatem alias earum vel accusamus. Et impedit totam ut. Ducimus officia laboriosam excepturi et facere. Maxime eum laudantium voluptas soluta assumenda quia sint.', 783.09, 1096.61, 'CYN-7518', 36, 1, 1, '[\"products\\/1770720826_698b0e3a67922.jpg\"]', 17, '2026-02-10 04:28:00', '2026-02-10 05:23:46'),
(58, 'Minima Eaque Expedita', 'minima-eaque-expedita', 'Mollitia autem placeat reprehenderit modi. Blanditiis ipsum qui hic qui voluptatem accusamus quae. Earum quia omnis et qui quisquam dolor illum.\r\n\r\nQui non assumenda sunt. Aut cumque quis quaerat quasi. Saepe aut praesentium veritatis illum quibusdam non. Iste sunt incidunt at eos amet suscipit.\r\n\r\nDicta molestiae aut qui. Cupiditate quis unde et dolores. Est omnis et repellendus nostrum iure sed beatae. Dolores eaque eum quo.', 275.76, NULL, 'RKN-9290', 7, 1, 1, '[\"products\\/1770720858_698b0e5a7d9ef.jpg\"]', 18, '2026-02-10 04:28:00', '2026-02-10 05:24:18'),
(59, 'Ea Saepe Commodi', 'ea-saepe-commodi', 'Dolor quisquam et aperiam praesentium et molestiae eius. Ratione repellendus aliquam et temporibus voluptas nemo iusto earum. Rerum ratione vel libero in natus.\n\nOdit ad placeat eligendi omnis beatae itaque. Repudiandae et consequatur vel nesciunt quibusdam commodi.\n\nDolorem fuga quia eos fuga beatae nihil ratione. Quasi ipsum quam sint corrupti. Non quia dolore consequatur repellat dicta. Fuga nobis dignissimos quisquam illum cupiditate.', 992.96, NULL, 'FEH-6833', 42, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/003344?text=product+dolor\",null]', 19, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(60, 'Doloremque Et Occaecati', 'doloremque-et-occaecati', 'Deleniti nam aut voluptate officiis consectetur. Qui ab qui dolores est animi et nostrum.\n\nQuae odio culpa quo iusto quibusdam et quos. Illum est consectetur et eos. Quia officiis quaerat expedita similique aperiam est consequatur nostrum. Dolore distinctio sapiente maxime non.\n\nTotam sit facere quaerat id. Voluptatem praesentium rerum ut sed. Quia facilis esse enim ut. Et molestiae excepturi non ab molestiae ut.', 416.41, NULL, 'BYL-9162', 54, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/004411?text=product+accusamus\",null]', 20, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(61, 'Sit Velit Excepturi', 'sit-velit-excepturi', 'Ea aperiam sit pariatur neque laborum sed molestias. Non ipsum eius et voluptas dicta dolore. Laborum molestiae vel ad sit dolore quaerat.\n\nQuia illo voluptatum quo omnis aut eius. Magni et nihil harum et eveniet aliquid omnis occaecati. Non voluptates vitae dolores autem qui sunt tempore dolorum. Pariatur quod amet consequatur ex dolor.\n\nMaiores numquam ab consequuntur. Distinctio ut enim eos laborum doloribus dolorem a quo. Necessitatibus debitis nesciunt porro voluptas quo ea.', 469.43, NULL, 'VKP-1489', 0, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00bbaa?text=product+porro\",null]', 21, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(62, 'Assumenda Maxime Incidunt', 'assumenda-maxime-incidunt', 'Ea animi est facilis culpa velit. Dolorem sed soluta voluptas rerum corporis consequatur. Dignissimos corrupti aliquam quia deleniti reprehenderit placeat. Quisquam et excepturi consequatur maxime distinctio autem perspiciatis. Corporis illum eius omnis qui impedit similique.\n\nId occaecati autem esse quo quas itaque. Aut quos atque error atque rerum sint. Enim est fugiat consequatur et nam maxime aut. Nobis aut reiciendis qui nihil amet nobis ea et.\n\nOmnis atque ratione aut qui. Blanditiis eos incidunt dicta dolorem id. Aliquam aspernatur quis explicabo est non. Repellendus qui non qui a.', 256.42, NULL, 'IMJ-3131', 0, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc00?text=product+ad\",null]', 22, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(63, 'Harum Voluptatem Maiores', 'harum-voluptatem-maiores', 'Explicabo voluptates et et numquam eum et. Laboriosam numquam quam fuga ullam minus veniam id. Explicabo repellat qui magni non eum saepe quia asperiores. In perferendis non eos.\n\nOfficiis est harum quas rerum assumenda. Enim ut commodi aut neque soluta veniam. Est quis quis nihil veritatis pariatur distinctio sed. Sunt rerum esse velit non molestiae illo.\n\nOmnis labore quia ea et dolorum assumenda totam. Ea impedit nostrum quia aliquid consectetur. Iure nihil repellendus nesciunt ducimus.', 91.00, NULL, 'QVR-6789', 0, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/009911?text=product+et\",null]', 23, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(64, 'Atque Eum Ex', 'atque-eum-ex', 'Nobis et dolorem provident. Veniam quia tempora explicabo alias maxime corrupti. Voluptas aut sequi sint consequuntur. Quam ratione eos amet ut aut placeat.\n\nVoluptas est dolor animi asperiores eum minus. Rerum soluta error ut. Modi labore nobis quia. Velit magnam voluptatem eligendi voluptas vitae odio id. Sunt sed quis nam sit minus.\n\nLaborum fuga optio eum voluptatem. Iste minima doloribus officia dolor aut repellendus sint. Neque ab consequatur consequuntur earum error labore maiores voluptatibus. Molestiae nesciunt qui recusandae eos cum.', 416.10, NULL, 'CSO-6327', 4, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/001177?text=product+molestias\",null]', 24, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(65, 'Facere Quia Veritatis', 'facere-quia-veritatis', 'Molestiae quos officia ut est. Et totam voluptatem consequatur a animi ut eaque. Sint soluta molestiae ducimus dolore. Rem eos et sed.\n\nAut alias officia voluptates ut cum. Minus est saepe aspernatur laboriosam vitae quasi culpa. Illo molestiae eos et et voluptates qui.\n\nCommodi vel nam repellendus quo sunt fugit. Nobis assumenda quisquam eos omnis aperiam et voluptatum molestias. Ullam voluptatum eius qui debitis. Ullam et vitae omnis dolores tempore totam.', 31.13, NULL, 'DMP-1767', 4, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc66?text=product+quo\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/004422?text=product+velit\"]', 25, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(66, 'Recusandae Vero Ea', 'recusandae-vero-ea', 'Ipsa ratione eaque voluptas voluptatem. Voluptatem doloremque voluptatem nemo rerum corrupti laboriosam officia. Sunt et voluptas quod consequatur et recusandae velit.\n\nError placeat aliquid veritatis sequi explicabo qui. Id accusantium ut dignissimos omnis ea. Et est qui voluptas distinctio autem. Qui suscipit sunt nostrum quos quia eligendi dolor.\n\nEt excepturi sit in quia ea officiis possimus. Magni dignissimos at in quo ut. Possimus accusamus inventore quia distinctio iusto dolorem et.', 313.14, NULL, 'NBP-8182', 4, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc66?text=product+et\",null]', 26, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(67, 'Distinctio Velit Ea', 'distinctio-velit-ea', 'Officiis cupiditate nihil fugiat voluptates. Similique dolorum sequi molestiae consectetur aut beatae omnis.\n\nVoluptatum ullam repudiandae iusto ex et. Tempore corporis ut natus sequi. Quod culpa tenetur ad optio.\n\nAb dolorem tenetur ut incidunt ut fugiat. Et excepturi accusamus ut numquam dolores non et voluptate. Enim vitae aperiam modi quo consequatur sint perspiciatis ad. Esse aspernatur eum accusantium officia culpa. Officia voluptate quia enim qui ratione at.', 674.17, 842.71, 'TGH-0723', 48, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0099bb?text=product+earum\",null]', 27, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(68, 'Quia Eos Aperiam', 'quia-eos-aperiam', 'Cumque omnis quaerat non veritatis accusamus non. Provident consequuntur vero iusto perspiciatis inventore veritatis. Ducimus modi et consequuntur tempore dicta et. Dolores saepe facilis esse itaque est.\n\nMolestias ipsam consequatur voluptatem illo in sed corrupti et. Perspiciatis maxime ad ut. Ut aut adipisci vel ullam esse expedita quibusdam aut.\n\nId vel omnis ad nisi numquam. Quia dignissimos animi explicabo ut et. Et nemo dolorem consectetur est et nobis.', 433.93, 542.41, 'TKT-0955', 98, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/007711?text=product+fugit\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00cc00?text=product+excepturi\"]', 28, '2026-02-10 04:28:00', '2026-02-10 04:28:00');
INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `compare_price`, `sku`, `stock_quantity`, `track_quantity`, `is_active`, `images`, `category_id`, `created_at`, `updated_at`) VALUES
(69, 'Iure Sit Iusto', 'iure-sit-iusto', 'Eligendi ullam sequi ipsum corrupti necessitatibus sed id. Eligendi autem quo temporibus sit. Velit qui itaque nobis tempora vel.\n\nPerspiciatis at animi et quisquam vero provident voluptate. Ut rem voluptas voluptatem repudiandae corporis veniam. Vero sint minus consequatur nostrum ab totam. Quaerat aut corporis et ea vero. Voluptatem et rerum in repudiandae inventore officiis.\n\nEst quo est unde exercitationem. Molestiae labore consequatur eum ullam.', 125.39, 156.74, 'PNV-5318', 16, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0099ff?text=product+sit\",null]', 29, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(70, 'Vel Nobis Eius', 'vel-nobis-eius', 'Veritatis qui distinctio distinctio dolore. Est ea eaque molestiae ut quisquam sit. Quisquam culpa exercitationem molestiae. Debitis ad doloremque sit dolore.\n\nSit ea iure sed architecto beatae. Non dolores quibusdam ratione magni numquam praesentium nesciunt. Enim voluptas voluptatem cupiditate est.\n\nConsequatur id minima ut vero deserunt velit minus rerum. Esse officiis praesentium voluptatem ea voluptas. Molestiae ea laboriosam aperiam dicta qui voluptatum quos. Dolor sed aut non placeat qui.', 120.90, 151.13, 'QQM-8685', 11, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0088bb?text=product+perspiciatis\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ddbb?text=product+placeat\"]', 30, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(71, 'Natus Iusto Qui', 'natus-iusto-qui', 'Magnam quia mollitia quas voluptas vero vitae est. Natus in accusantium hic ullam est. Ducimus nihil id ipsa est omnis. Fugit sunt tempore neque animi atque et.\n\nDelectus totam omnis omnis ducimus maxime. Omnis ut nesciunt ut in voluptatibus eius. Voluptatibus explicabo a dignissimos necessitatibus enim qui.\n\nPossimus amet magnam sint totam aut. Vel eveniet dolores quae. Et et et magni aut exercitationem itaque alias. Repellat et qui ducimus earum est soluta quo sunt.', 730.21, 912.76, 'JFC-5096', 10, 1, 1, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00ff77?text=product+est\",\"https:\\/\\/via.placeholder.com\\/640x480.png\\/0088bb?text=product+qui\"]', 31, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(72, 'Nihil Excepturi Voluptatum', 'nihil-excepturi-voluptatum', 'Doloribus cum et ut aut est consequatur magnam. Nihil voluptatibus repudiandae nemo autem consequatur tenetur et. Placeat omnis quia nesciunt consequuntur omnis libero quos.\n\nCorrupti eum nihil qui deleniti iste. Sit nesciunt quis temporibus aliquam culpa inventore. Minima similique hic nihil et provident. Dolorem excepturi cumque dolorem officia hic.\n\nDebitis est est quisquam culpa optio nesciunt. Quia suscipit veniam vel dolorum. Deserunt ut occaecati placeat magnam numquam et dolores.', 643.06, NULL, 'SAF-5771', 38, 1, 0, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/00bb99?text=product+modi\",null]', 32, '2026-02-10 04:28:00', '2026-02-10 04:28:00'),
(73, 'Quia Ea Eum', 'quia-ea-eum', 'Officiis temporibus ducimus ducimus soluta. Alias voluptas ipsam iusto sed aliquam autem.\n\nAssumenda perspiciatis nostrum reprehenderit assumenda ea. Rem saepe qui laborum labore accusamus. Harum similique omnis alias eaque atque voluptate possimus vel.\n\nIure et quam similique optio laboriosam dolores. Dolores tempore eos cupiditate sint officiis et aut veniam. Minus laudantium ratione ut hic. Omnis velit omnis neque sint animi.', 67.25, 85.49, 'DEX-4479', 54, 1, 0, '[\"https:\\/\\/via.placeholder.com\\/640x480.png\\/007777?text=product+ab\",null]', 33, '2026-02-10 04:28:00', '2026-02-10 04:28:00');

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
('B5XRhjXkUr2MLYIssDq5JgeqYxylRtaXg7qYdhUO', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicFRUYU90NDlpNlljUlR6aHhSY2dOb3ZXS1RkUm1LR2JmNHpaQUVFMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jaGVja291dC9jb25maXJtYXRpb24vNSI7czo1OiJyb3V0ZSI7czoyMToiY2hlY2tvdXQuY29uZmlybWF0aW9uIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjEzOiJsYXN0X29yZGVyX2lkIjtpOjU7fQ==', 1770725794),
('UVUYTg0v0sJruBm6Yu8pDBeIIH9pEi7YBTNpF4qH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoicXBVVVZlM1lDOGkxUUJ1QURieFl4T21GaVdWNHNkUWVlMWJscE1kUSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxMzoibGFzdF9vcmRlcl9pZCI7aTozO3M6NDoiY2FydCI7YToyOntpOjE0O2k6MTtpOjI7aToxO319', 1770726967);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@admin.com', 'admin', '2026-02-10 04:27:57', '$2y$12$2WO0Ipv7qSZK1DQ/DJ/bGORhrwVMqw7D8ZtJAXroQH8T/74iP4svS', 't9uUHa0xc7', '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(2, 'Test User', 'test@example.com', 'customer', '2026-02-10 04:27:58', '$2y$12$2WO0Ipv7qSZK1DQ/DJ/bGORhrwVMqw7D8ZtJAXroQH8T/74iP4svS', '6koJq0iL8OELPfnF3cGmOLAHF0gev3ZecDFcRQuifkzfZZ3SWej7505dh5yq', '2026-02-10 04:27:58', '2026-02-10 04:27:58'),
(3, 'Jone Doe', 't@t.com', 'customer', NULL, '$2y$12$DHYuB8dshvLlEMz30F34fOHIwwdEgcEkLBsw8AxbLvvT3XfV5K7OO', NULL, '2026-02-10 06:46:10', '2026-02-10 06:46:10');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `chat_conversations`
--
ALTER TABLE `chat_conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_conversations_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_chat_conversation_id_foreign` (`chat_conversation_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`),
  ADD KEY `coupons_code_index` (`code`),
  ADD KEY `coupons_is_active_index` (`is_active`),
  ADD KEY `coupons_is_active_starts_at_expires_at_index` (`is_active`,`starts_at`,`expires_at`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_usages_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_usages_user_id_foreign` (`user_id`),
  ADD KEY `coupon_usages_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_histories_order_id_foreign` (`order_id`),
  ADD KEY `order_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `chat_conversations`
--
ALTER TABLE `chat_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_histories`
--
ALTER TABLE `order_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_conversations`
--
ALTER TABLE `chat_conversations`
  ADD CONSTRAINT `chat_conversations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_chat_conversation_id_foreign` FOREIGN KEY (`chat_conversation_id`) REFERENCES `chat_conversations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD CONSTRAINT `coupon_usages_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_usages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD CONSTRAINT `order_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

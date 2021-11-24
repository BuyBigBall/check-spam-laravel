-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2021 at 03:37 AM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mail-analyzer_tester`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Main Post', 'main-post', '2021-11-11 11:23:21', '2021-11-11 11:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `configures`
--

CREATE TABLE `configures` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `private_key` varchar(200) CHARACTER SET ascii DEFAULT NULL,
  `server_ips` varchar(200) CHARACTER SET ascii DEFAULT NULL,
  `client_ips` varchar(200) CHARACTER SET ascii DEFAULT NULL,
  `x_mt_tocken` varchar(200) CHARACTER SET ascii DEFAULT NULL,
  `micro_payment` tinyint(4) DEFAULT 0 COMMENT '0-disable, 1-enable',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `icon`, `title`, `description`, `lang`, `created_at`, `updated_at`) VALUES
(1, '<i class=\"fas fa-user-shield\"></i>', '100% Safe', 'Protect your privacy by not allowing spam in your personal inbox', 'en', '2021-08-30 11:08:27', '2021-08-30 11:08:27'),
(2, '<i class=\"fas fa-envelope-open-text\"></i>', 'Simple & Free', 'Create temp emails fast simple steps & always free', 'en', '2021-08-30 11:10:43', '2021-08-30 11:10:43'),
(3, '<i class=\"fas fa-globe-europe\"></i>', 'Worldwide', 'Used by professionals all around the world , try it now', 'en', '2021-08-30 11:12:56', '2021-08-30 11:12:56'),
(4, '<i class=\"fas fa-envelope-open-text\"></i>', 'بسيط ومجاني', 'أنشئ رسائل بريد إلكتروني مؤقتة بخطوات بسيطة وسريعة ومجانية دائمًا', 'ar', '2021-09-17 01:38:39', '2021-09-17 02:44:04'),
(5, '<i class=\"fas fa-globe-europe\"></i>', 'عالمي', 'يستخدمه المحترفون في جميع أنحاء العالم ، جربه الآن', 'ar', '2021-09-17 02:42:46', '2021-09-18 19:50:27'),
(6, '<i class=\"fas fa-envelope-open-text\"></i>', '100% أمان', 'حماية خصوصيتك و عدم السماح للبريد العشوائي في صندوق الوارد الشخصي', 'ar', '2021-09-17 02:43:58', '2021-09-18 19:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 'EN', 'en', 0, NULL, NULL),
(2, 'AR', 'ar', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postion` int(11) NOT NULL DEFAULT 0,
  `target` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `icon`, `title`, `url`, `postion`, `target`, `created_at`, `updated_at`) VALUES
(1, '', 'Buy Now', '/prices', 0, 1, '2021-11-02 04:31:37', '2021-11-02 04:33:24'),
(2, '<i class=\"fab fa-facebook-f\"></i>', NULL, 'https://facebook.com/', 0, 1, '2021-11-02 04:32:06', '2021-11-11 11:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2021_07_02_152029_create_settings_table', 1),
(8, '2021_07_07_030945_create_trash_mails_table', 1),
(9, '2021_08_11_214002_create_features_table', 2),
(10, '2021_08_12_171504_create_translates_table', 3),
(11, '2021_08_26_203701_create_statistics_table', 4),
(12, '2021_06_29_203211_create_categories_table', 5),
(13, '2021_06_30_203023_create_posts_table', 5),
(14, '2021_06_29_203100_create_pages_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL,
  `option` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `value` longtext COLLATE utf8_persian_ci DEFAULT NULL,
  `mode` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `option`, `value`, `mode`) VALUES
(5, 'site_email', 'mail@prodevelopers.eu', ''),
(6, 'site_title', 'Proacademy', ''),
(7, 'blog_comment', '0', NULL),
(8, 'blog_post_count', '6', NULL),
(10, 'main_page_popular_container', '1', NULL),
(11, 'category_content_count', '12', NULL),
(12, 'main_page_newest_container', '1', NULL),
(13, 'category_most_sell_container', '1', NULL),
(15, 'main_page_blog_post_count', '2', NULL),
(16, 'video_watermark', '/bin/admin/mobile%20app%20icon/business%20(4).png', NULL),
(17, 'content_terms', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', NULL),
(18, 'chart_day_count', '15', NULL),
(20, 'site_income', '50', NULL),
(21, 'user_register_mode', 'deactive', NULL),
(22, 'user_register_active_email', '11', NULL),
(23, 'user_register_wellcome_email', '12', NULL),
(24, 'site_withdraw_price', '25000', NULL),
(25, 'factor_watermark', '/bin/admin/images/logo/logo-small.png', NULL),
(26, 'factor_seconder', 'John', NULL),
(27, 'factor_approver', 'Albert', NULL),
(28, 'site_disable', '0', NULL),
(29, 'site_popup', '0', NULL),
(30, 'popup_image', NULL, NULL),
(31, 'popup_url', '/jhghj', NULL),
(32, 'main_page_slider_content', '17,18,19,20', NULL),
(33, 'multiselect', '22', NULL),
(34, 'main_page_slider_timer', '9000', NULL),
(35, 'footer_col1_title', 'About Proacademy', NULL),
(36, 'footer_col1_content', '<p style=\"text-align:left\">Pro Academy is very professional learning & teaching platform. You can simply upload your courses & learn from professional educators online. Pro Academy has many built-in features that can resolve all your needs.<br></p>', NULL),
(37, 'footer_col2_title', 'Links', NULL),
(38, 'footer_col2_content', '<ul><li style=\"text-align: justify;\">About Us</li><li style=\"text-align: justify;\">Contact Us</li><li style=\"text-align: justify;\">Terms &amp; Rules</li><li style=\"text-align: justify;\">FAQ</li><li style=\"text-align: justify;\">Knowledgebase</li><li style=\"text-align: justify;\">Vendors Panel</li><li style=\"text-align: justify;\">Start Learning</li></ul>', NULL),
(39, 'footer_col3_title', 'Payment Gateways', NULL),
(40, 'footer_col3_content', '<p style=\"text-align: left;\"><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAADxgAAA8YBg9o/AQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAABMgSURBVHic7Z17fF1Vlce/65x7kya5acu7tBRboCW3rYia3vKqpqgMMz54jAk4OspD60hSdWYch1E/VmZ0dJDR+UDa8cPHj8IwYGkABVSUmU9bFSpJWwT6SGtBHjIVKKWP9OZ17zlr/khSknv3ucl9nnNv8v2r3WfvfX45Z9219l5nn31EVZli8mL5LWAKfwn5LSAborH2CBDxWYYDHOjuanN91lEQpBxCQDTWvgD4JvBBoMpnOQBJYB/wIvAocF93V9tufyXlRrkYwAZghd86xuEZ4IvdXW2/9FtINgTeAKKx9guBx/zWkQUPAp/t7mp7yW8hE6EcBoGNfgvIksuAzmis/W1+C5kI5WAA5/gtIAdmAb+KxtqX+y1kPMrBAMril2RgBvBQNNZ+mt9CMhFoA4jG2m1gsd868mAm8INorF38FuJFoA0AWAhM81tEnrwP+JTfIrwIugGUq/tP5R+C6gWmDKA0nAVc4rcIE0E3gHKcAXhxvd8CTATdACrFAwAs9VuAicBmAqOx9hOA1/3WUWBmdne1HfZbxGiC7AEqyf2P0OC3gFSCbACV5P5HCJy7DbIBVKIH6PVbQCpBNoBK9ABxvwWkEshBYDTWHgKOAtV+aykYIvrsqo9+Rauru514zSN6Df1+S4LgeoCFVNLNBxLTI6JV4W+g7gN2bfzV0L3xH8oD/W/xW1dQDaDi3H/iuOmj/zsd4Ro76TwV6jj6Yb80QXANoOIGgINjDWCEmah02Ovjf19qPSME1QAq3QOMQeBb4Y6ei0oo5xhTBlAiEjO9DQAIqVrrpOPoSaXSM0LgDGA4BTzbbx2FxiMEjGaOjfW9UmgZTeAMgAr89atlkZwxgfdZVC+Xjv7Ti6/oTaYMoAQkp0dQa0KX2gpp8rpi6xlzwlKebIJU3gzg+HHd/zEUuU5uKt19CaIBVJwH6D81q7Hd3PDZvSW7BoEygOEU8CK/dRSavrmzsqrvWpQsQxgoAwDOpsJSwGrb2XoAFLdkA8GgGUDluf/ZJ6G2nVUbS2XSeoCKGwAeWbIg+0ZSun0bgmYAFeUBnLoaehrOyLqdiz5XBDlGpgygiBx6exS1s7/EgvVsEeQYCYwBRGPtJwKn+q2jULjVVRx+29k5tXXUmXwGQIX9+vc3xXBqcnmtUY5ySv0fCi7IgyAZQMUMAHvnz+HIW3MY/AGgj2kTyYIKykCQDKAiPIBbXcWrl1yYc3uFTYVTMz5TBlBANBxi3xXvIVlfl3MftmttKpyi8QmEAVRCClhDNvuueC99p2WX9k2hJzGrZluhNE2EoGwU2UAw9v/LCQ2H2HfZxfSenuckRihp/IfgGEDZuv+BE4/jlQ82MXjCzLz7Ui1t/IfgGEBZzgAOn9vA/qYYGsou1++FLaWN/xAcAygrD9A3dxYHzj+Xvnxd/liOJCht/IfgGEBZeIDeeXN44/y30TfnlGJ0/7A24xSj40z4bgDRWPtJBDQF7E6rovctc4jPn0Pv/Dkk62qLdzKR9cXr3BvfDYASuP/e+XPoHW96JoJbFcaJ1JKsqyFZV0uyvhakJJt7HXIitb5sMh0EAyi6+z/4zsX0zptT7NPkjIrcon/OgB/nDkIiqKgeQC2L/uLE7EKxz62p/a5fJ694AxiYdSJuOAiOzgPhRv2AfzuH+GoA0Vh7GIgW8xy9Wa7ILTF3Jpvr7vJTgN8/jaKngLNdkl0qVHjGpe4zfuvw2wCKOgAMavxX2O7acqleSZ/fWvweAxQ3/p9yQgDjvzzuViXepVfW/slvJVDhBlDgVG2+OAK3OL2179XLZx7yW8wIfv88ihoCgjIAVOEZ27FWDl5d0+m3llR8M4BorP1khr6tUxSG4v/Jxep+omxA5Ra3pfYXTgB3CQV/PUAJ4n+4mKdI5bAor6nQhchGB2uDNk97vpQCcsFPAyiq+89n+ueoLsKSgxOrrQ4HI4d0JYmcT+gjFesBeufmNgAU2KVXRboLLCew+DkLKJoHUMui/7Tc4r8imwqrJtj4YgDFTgHnFf/V3VRQMQHHLw8QpYgp4LzifxW/KqCUwOOXAQRyAKjCTr0i8lqB5QQavwygeANAkZzX7IlOrvgPFWgA/bNOxK3KMf7L5Ir/4J8BFC1Fl0f8V4fJFf/BPwMo2vr3+Bm5faxbhV3aHNlfYDmBxy8D+BFwpNCd9jTMz/nlzMkY/8HHbwZFY+2nAf9CDu8EODXTZg6ccsKykf+71WHiZ8zl6MJ5eTz/1w8nWyL359i4bAnkR6PGw+6I3yjKNwvYpTqOe7J+pL7SvlQ6Ln4vCMkJUZoK2Z/Czsl486EMDUA2EQLJfQ8WU5+TNP5DGRpA+NW+RtAJfH0hCybh/H+EsjMAx3KbCtylOo5Ouvn/CGVnAEWI/zsma/yHMjOAosT/Sfb8P5WyMoDwK73nFjz+T7Ln/6mUlQEkxC3017fVqZq88R/KzAA4HHkWCriNmsiP9Yr6AwXrrwwpKwPQlSREeT9QiIc2zzs2bQXop6wpy1SwPNB7qp3Qi7HI6cG/qLs32VK/WQP6skYpKUsDmKJwlFUImKLwTBnAJGfKACY5UwYwyfFcPrNkyU1VyZrjPyYiLWR4jVvR1y2xnkR1W08o8dAfN/+t79ueFBO55/BxVih0nSCXK1rvUU1FeFlUt6lYW5zm2p8HYcYRXtezHMu6TNEzBb0l0VL/uOcsYNHS9q+r8OUsz7EXkU90d7b+Nn+5wSTUEX8Y5QNZNvu1Ewpdq1dWl+xjUKnI/UcW2I69FRj5lHkS5NNGA3hrbO3cJO4fyO3tYVfhk7u72n6Yh95AEu6IX6rKIzk2j4vrXpK4un5zQUVNkND6+AZgxZhC4VHjGCCJ8x5yf3XcEuHWhmXt83NsH1xcLs2jdZ1a9p3yU4q447QZ6dgfAZanHVA5w2MQKE15nVGJiMv38uojgLiS71oEPSvUG19dEDFZENLaCzH+oPV5swHk/YcCwsVzL/huTd79BATpOHK8FOClVld4fyH0ZIXHIhpFNqVZRfT8/5iHhgyfL5cXurta09z6ksZbT3cs6xHSv/oVmj5YdQ4QuJ2xcsHW0LtA0/eOF30w2Ry5PLW4qqMv5qr7CHD82Oo0yF3U6V9T6EfbnqhoE6RLt1xnU7oHcOwmj242mkp3bP3sS4j8xNjCdnP7eG4AEdUmU7mqGNcTDDbXdAFPGA7ZVaH4mQWUlpGh+C+NhkPx5JH6LekGoLLCUBkR3eR5EtXTTeUqvDJBnYHHtTBeF9v1XlKmYLwug9O0ZNfFO/6zWVeSSDcAj/hvq230AAAuvNt4cteuiM2WpOPI8aK81XDoUGJP7dPGNj/qOVFgseHQgZJuQpEh/kNKKnh46pZmtQLPbe+64Y+mjqLL1iwUmGs49LxXm3LDJvxuTEFUeExX4xrb2HKxsQ366wLLy8hQ/E/Hcp1NkOoaPK2F7iWxteemljvqzlThn81f1THHRoCGd7TPDoWsMXsEDFjO63ufWPWyqf78FXdMe37jNf1e/c294Ls1Z1UfSWzcuDqr5WINF91cv+fxvrjqauNNHEHUbTLmS1Wer+qIp10XV2W2qHzdMGRExXxdBISO/nlhnBlvdoQmLN1nem1dOrABW5sZ9NTdsT9iU2uK/73JI/VbIGVBSHRp+50IH/fqMCtEPtjd2frTkf82nHfrCnGsGxGWAsd5tNoPuk3Euj+RcB8MhfgZyGJgQITrdnW2jRlsLlq65n2Kewsii0CextVru7e2bR9PWsNFN9dbg3VfVPgcaD/wk1l1B27wMiC7I/60aEH2NXId1z5Tr572AgzddLsj/hHgsyhLAK+vTr8Eug2s71vKKyp6j8J8kJcs5arBq2qfNDUKr4//mcIvDIf+J9lSdwmkGkCs/UU8Bi5Zsnv3lrZFquiZjbfPqLIG1oFkm0XbD5w0usB1reV7tt7wGMA5y//zuMSAswOYParKgIW8c2dX606vThsbbw/HrcFHIdXbyae7u1pvT60vP+45wU5Y+zG682zRHydbIlfCUG7ecu37sjYs1SOITB9VMuiIc6o2T38jtWr43vg3VbgxrQvky05L7b/CqDFAwzvaZ1OYm++q8o+q6PwVd0yrsgYfzOHmQ8rNB7At99jFSvQ7FzP25gNUu+gd0tLh+S3XuDW4hrSbD6CfNtW3E/YyCnLz5ailchOArOudbTv2ozl5lbE3H6Aq5EiDqaqKGgfnI/EfRhmAhAvzypXAqt1b2h4CqIn3fAePGUIuuKMeSydVn/Ko1tjwwmtfNB1YtHTN54FPGVspj5uKveb/WTIg6BWDV9U9DWBb7n3AvAL0C4CKpD2ul7uoA1lqqH4s/sPoWUD+79ztFNEP7OpqWwsQXbbmBEWuybPPMYhI18i/925d9Rywy1xTVy8577YxmcmG2NpLVfQWj65dS+VuY0/5p8U3WCoXJFrq/hcgvK7nApDz8+xzDE7Y7kotC1XFM87/j9U7ViysMC9ZkLtBzaNrkX5x2S3C9l3zTt6k65uPfftW0OsVPJ4FyDbQHWOKlFMRLjHXB8AZdMK/GV3gql5riWwGUl1+tevKD6Wl4wJd3+wsPH9t1MZdZ6g3/GfIl3ZubU1LWcvdb0y3w9XvMDTpAR7wlipHFHbZIk8OZwSPoZbl9S6Ci7ARZexMSFiMYhrJj1R4Tq+sSZ89eRiuytjEVQjg7Au+N8dSzjJ08mJ3Z+vHvE/ujSp/YTwg3NTd2fo106GGZe3N4uo6RAwPqeSp57auPDy6ZM+WVV3RWPu3wTTQIRZ98bUvRJet+X5I9WGFGal1hiv+166u1n8zHbKrpi1HNd1oRDckmyPXGPvLgNyEZUe9HinLXyaba9NS6gJire/9qqBfMzZTc4ZW8cj/65vxH4ZDgCQTTebOMXY+HiIIEDMc6uuvjXzLq93uzrYORDxe1VLj1nLJg/o1PEKBqt6kqj9X8Mi9y+bkIV3ppccz/58h/ZuRRT0LMEyBFZ5KtqTf/OFj6krtzYjHkjIrfW/D4fhvnv8fqh/jkYZ+aR75f81x48TFS9eegtn9b8mU0BmjKZUhV5/G3r2rBlzVa8H46fVqMRsiwEuJsH3F3r2rPL/Zq6kraIaxPR4AjUcIy7hIxoKM2UFtpg81G4BjW2kp+uH4b3pranPqhy0sAMtroCO5eQA3qdUeh473KAeGMn4gxjq9fdZDXu32bFnVBXx74gqJu6Ifevbxv/HMyUvHwRnA2w2HPPP/46GuGK+LjnNdpCN+KeYfxmA+8R/AWnDebaeZXKTCH3d3tuX0zZtdT7a+CKQlJoCF0dhtntPCaUfj3zA+c0fjLz7zmYyfcMkUClI7E+FjezpXZbyJtlu9HPNF/41X/n88HMv6ncehJrm3Z6GnFtWvmsoFXjCVD8X/dFLjP0Ao7FgrVAzeJcPj3wnyJPDelLIqkA3R2JofCTpmWxZVoob6w1jj/uL27l01cPbS27xmBaOQL+/qbDXG2zG10BUmn6s5ekUAbZ72Umh9PC3DCZxmi70tdO/RewR5c1m9IArngRjDmKo+mqb7Lurs6onFf4AQFk3G6OLm/ocOKeEh1HhDLdCPpp0yQ65NdGLrCy3Lek5VewRmmiXx37u6Wie0waQrNJkkZXr+P0EeBq5LL9YIIiuzeXnA0eS/p5aFquIX6gTjP4CFmtOFjua3c/burgNrRPSxfPoYRgc07Bn/R2hsvD2M6n1eNx94InFQPzmRE8rdb0wXSHvKBxxO7K71ykBOCCeZ/ALwf/n0MczrevXMF9KL9V2myqb4D2ApmPbceXk405YzqqtdR0OfQDiaTz/A71Ln/ya8c/xD45mQ5VyeacQ/BntaBPPz/5zj/zEtfzXjoMD15P2mkHkZHohxDyVT/B8qR+9ILVTVW3MX9iZ7uj7zB5B3Arm/KSQyrpaMOX6Ih7A+tP2Jz7060VPq1bX7gPT4qrRPtI9MJFrqfimiK1DN9U0hxxJzWLTQ76cVCluTUm9an4hFUm5V5ScMzaMdgY4982d9J0dhaXR3tv5+95YDF4nydwidQKZfoTvkMUSBQRH5QXdn652Z+h8nx6+gH9/RdUPWbttS+RLISAjrE7g50VL3y2z78SLRHPmVMxg5R+Bmhe2Y8xhDCEmQEU/ao8I/DTbXGhNjA1dFdqjIV4DXAUTZaye5XpvN/R9bD7Ck8dbT+6ur+jPNjQtBY+Pt4Xio/xx1Q2NGwmIl99clp3Vv3bqyd0HjbWfW1ITeeOY3mad+C89fG7Ud97d4pHlV+MruzrZv5KNX7u9pwO1/WZtPyjeUZT7PXdSFqnvORaw3XzhV1HL05cGeyO91JYnqe48uGeyLPKvXMF4yDXmE6qojRxcMXBXZkbFeOW8RE421bweWeBy+p7ur7aOl1FOOlO3+AIsb1yzD4+YLdPXXRa4vsaSypGwNwLXcOR6HXsZNXj6BZw5TUMYGMKvujYdIn0/3iiuX7dr6+T/5oakcKVsD2LhxddJ1ratRfga4wE6x9D27trYaV8hOYaasB4EjLFhwW/WEkzxTjKEiDGCK3CnbEDBFYfh/s8d2smdx2SkAAAAASUVORK5CYII=\" data-filename=\"paypal.png\" style=\"width: 128px;\"><br></p>', NULL),
(41, 'footer_col4_title', 'Guaranty', NULL),
(42, 'footer_col4_content', '<p><img src=\"data:image/png;base64,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\" data-filename=\"shield (1).png\" style=\"width: 128px;\"><br></p>', NULL),
(43, 'site_logo', '/bin/admin/images/logo/main-logo.png', NULL),
(44, 'site_logo_type', '/bin/admin/images/logo/logotype.png', NULL),
(45, 'request_page_icon', '/bin/admin/request icon/programming.jpg', NULL),
(46, 'request_term', '<p>Before send your request, read term and rules.</p><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br></p>', NULL),
(47, 'site_videoads', '0', NULL),
(48, 'site_videoads_source', 'https://www.youtube.com/watch?v=F4dxophs_o0', NULL),
(49, 'site_videoads_poster', '/bin/admin/files/cmsdef/preroll-ads-cover.jpg', NULL),
(50, 'site_videoads_url', '', NULL),
(51, 'site_videoads_time', '7', NULL),
(52, 'seller_not_apply', 'Dear user, your financial & identity information not verified. It can cause a delay in the payout process.', NULL),
(53, 'notification_template_change_group', '7', NULL),
(54, 'notification_template_get_medal', '8', NULL),
(55, 'notification_template_delete_medal', '26', NULL),
(56, 'notification_template_content_pre_publish', '10', NULL),
(57, 'notification_template_content_publish', '11', NULL),
(58, 'notification_template_content_change', '11', NULL),
(59, 'notification_template_content_delete', '13', NULL),
(60, 'notification_template_content_comment_new', '14', NULL),
(61, 'notification_template_content_support_new', '24', NULL),
(62, 'notification_template_request_get', '16', NULL),
(63, 'notification_template_request_publish', '17', NULL),
(64, 'notification_template_request_draft', '18', NULL),
(65, 'notification_template_request_req', '19', NULL),
(66, 'notification_template_request_follow', '20', NULL),
(67, 'notification_template_ticket_new', '21', NULL),
(68, 'notification_template_ticket_reply', '22', NULL),
(69, 'notification_template_withdraw_new', '7', NULL),
(70, 'notification_template_withdraw_pay', '24', NULL),
(71, 'notification_template_buy_new', '25', NULL),
(72, 'notification_template_sell_new', '26', NULL),
(73, 'notification_template_feedback_new', '27', NULL),
(74, 'notification_template_buy_post_withdraw', '27', NULL),
(75, 'article_post_count', '6', NULL),
(76, 'main_page_article_post_count', '4', NULL),
(77, 'main_page_slide', '/bin/admin/files/cover(10).jpg', NULL),
(78, 'upload_page_background', '/bin/admin/files/cmsdef/upload.jpg', NULL),
(79, 'main_js', NULL, NULL),
(80, 'main_css', 'The CSS code goes here...', NULL),
(81, 'login_page_background', '/bin/admin/files/cmsdef/login.jpg', NULL),
(82, 'pages_content_delete', '<p><br></p>', NULL),
(83, 'pages_terms', '<p dir=\"RTL\">Terms &amp; rules goes here</p><p dir=\"RTL\"><br></p><ul>\r\n</ul>', NULL),
(84, 'pages_contact', '<p style=\"text-align:justify\"><br></p>\r\n\r\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://www.shareicon.net/data/32x32/2016/09/10/828132_gps_400x512.png\" style=\"height:16px; width:16px\">&nbsp;Address goes here</span></p>\r\n\r\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://www.shareicon.net/data/32x32/2016/02/05/714409_phone_512x512.png\" style=\"height:18px; width:18px\">&nbsp;+1-283 526236</span></p>\r\n\r\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://www.shareicon.net/data/32x32/2015/12/30/695303_email_512x512.png\" style=\"height:18px; width:18px\">&nbsp;sales@proacademy.eu</span></p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p dir=\"ltr\" style=\"text-align:justify\">&nbsp;</p>', NULL),
(85, 'pages_about', '<p><span style=\"text-align: center;\">Pro Academy is a very professional learning &amp; teaching platform. You can simply upload your courses &amp; learn from professional educators online. Pro Academy has many built-in features that can resolve all your needs.</span></p><div><span style=\"text-align: center;\"><br></span></div>', NULL),
(86, 'pages_help', '<p>Help and tips go here.<br></p>', NULL),
(87, 'pages_content_update', '<p><br></p>', NULL),
(88, 'site_income_private', '30', NULL),
(89, 'main_page_slide_title', 'Professional Learning & Teaching Platform', NULL),
(90, 'main_page_slide_text', 'Proacademy is very professional learning & teaching platform. You can simply upload your courses & learn from professional educators online. Proacademy has many built-in features that can resolve all your needs.', NULL),
(91, 'main_page_slide_btn_1_text', 'Start Learnings', NULL),
(92, 'main_page_slide_btn_2_text', 'Start Teachings', NULL),
(93, 'main_page_slide_btn_1_url', 'category?order=new', NULL),
(94, 'main_page_slide_btn_2_url', '/user/content/new', NULL),
(95, 'main_page_vip_container', '1', NULL),
(96, 'default_avatar', '/bin/admin/files/10179153.jpg', NULL),
(97, 'default_user_avatar', '/bin/admin/files/boy.svg', NULL),
(98, 'default_user_cover', '/bin/admin/files/ctest4.jpg', NULL),
(99, 'default_chanel_icon', '/bin/admin/files/cmsdef/default-channel.svg', NULL),
(100, 'default_chanel_cover', '/bin/admin/files/ctest4.jpg', NULL),
(101, 'user_register_rest_email', NULL, NULL),
(102, 'user_register_new_password_email', '14', NULL),
(103, 'user_register_reset_email', '13', NULL),
(104, 'triangle-banner-top-image', NULL, NULL),
(105, 'triangle-banner-top-url', NULL, NULL),
(106, 'triangle-banner-bottom-image', NULL, NULL),
(107, 'triangle-banner-bottom-url', '#test', NULL),
(108, 'banner-html-box', NULL, NULL),
(109, 'email_notification_template', '15', NULL),
(110, 'currency', 'IDR', NULL),
(111, 'site_rtl', '0', NULL),
(112, 'site_videoads_title', 'test', NULL),
(113, 'site_videoads_roll_type', 'preRoll', NULL),
(114, 'site_description', 'The description goes here...', NULL),
(115, 'gateway_paypal', '1', NULL),
(116, 'gateway_paytm', '1', NULL),
(117, 'gateway_payu', '1', NULL),
(118, 'site_preloader', '0', NULL),
(119, 'default_customer_dashboard_cover', '/bin/admin/panel%20banner.png', NULL),
(120, 'site_language', 'tr', NULL),
(121, 'become_vendor', '0', NULL),
(122, 'gateway_paystack', '1', NULL),
(123, 'duplicate_login', '0', NULL),
(124, '_token', 'yKndAex2OwbIkoN7qjNLyUNR9xNL8dirHldxgoaC', NULL),
(125, 'files', NULL, NULL),
(126, 'gateway_razorpay', '1', NULL),
(127, 'site_language_select', '[\"tr\"]', NULL),
(128, 'user_register_captcha', '0', NULL),
(129, 'site_fav', '/bin/admin/images/logo/favicon.png', NULL),
(130, 'main_live_class', '1', NULL),
(131, 'gateway_cinetpay', '0', NULL),
(132, 'gateway_stripe', '1', NULL),
(133, 'plasma_middle_feature_live_class_count', '12', NULL),
(134, 'plasma_middle_feature_video_courses_count', '25', NULL),
(135, 'plasma_middle_feature_instructor_count', '18', NULL),
(136, 'plasma_middle_feature_student_count', '290', NULL),
(137, 'plasma_middle_feature_enable', '1', NULL),
(138, 'testimonials_enable', '1', 'normal'),
(139, 'testimonials_items', '[{\"text\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\",\"avatar\":\"\\/bin\\/admin\\/vannary.jpg\",\"name\":\"Addy Morphy\"},{\"text\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\",\"avatar\":\"\\/bin\\/admin\\/vannary.jpg\",\"name\":\"Addy Morphy\"},{\"text\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\",\"avatar\":\"\\/bin\\/admin\\/vannary.jpg\",\"name\":\"Addy Morphy\"},{\"text\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\",\"avatar\":\"\\/bin\\/admin\\/vannary.jpg\",\"name\":\"Addy Morphy\"}]', 'normal'),
(140, 'option', 'testimonials_items', NULL),
(141, 'plasma_live_class_text', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora delectus, dolorum odit ipsam cum ratione eveniet blanditiis sed impedit nemo veniam, architecto fuga temporibus, suscipit officia similique repellat eligendi consectetur.', NULL),
(142, 'plasma_live_class_enable', '1', NULL),
(143, 'site_meta_description', NULL, NULL),
(144, 'meta_keyword', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', 'privacy-policy', '<h3>Privacy Policy for Trash Mails</h3>\r\n\r\n<p>At Trash Mails, accessible from trashmails.xyz, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Trash Mails and how we use it.</p>\r\n\r\n<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>\r\n\r\n<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Trash Mails. This policy is not applicable to any information collected offline or via channels other than this website.</p>\r\n\r\n<h6>Consent</h6>\r\n\r\n<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>\r\n\r\n<h6>Information we collect</h6>\r\n\r\n<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>\r\n\r\n<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>\r\n\r\n<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>\r\n\r\n<h6>How we use your information</h6>\r\n\r\n<p>We use the information we collect in various ways, including to:</p>\r\n\r\n<ul>\r\n	<li>Provide, operate, and maintain our website</li>\r\n	<li>Improve, personalize, and expand our website</li>\r\n	<li>Understand and analyze how you use our website</li>\r\n	<li>Develop new products, services, features, and functionality</li>\r\n	<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>\r\n	<li>Send you emails</li>\r\n	<li>Find and prevent fraud</li>\r\n</ul>\r\n\r\n<h6>Log Files</h6>\r\n\r\n<p>Trash Mails follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services&#39; analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users&#39; movement on the website, and gathering demographic information.</p>\r\n\r\n<h6>Cookies and Web Beacons</h6>\r\n\r\n<p>Like any other website, Trash Mails uses &#39;cookies&#39;. These cookies are used to store information including visitors&#39; preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users&#39; experience by customizing our web page content based on visitors&#39; browser type and/or other information.</p>\r\n\r\n<p>Google DoubleClick DART Cookie</p>\r\n\r\n<p>Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to www.website.com and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL &acirc;&euro;&ldquo;&nbsp;<a href=\"https://policies.google.com/technologies/ads\">https://policies.google.com/technologies/ads</a></p>\r\n\r\n<h6>Our Advertising Partners</h6>\r\n\r\n<p>Some of advertisers on our site may use cookies and web beacons. Our advertising partners are listed below. Each of our advertising partners has their own Privacy Policy for their policies on user data. For easier access, we hyperlinked to their Privacy Policies below.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Google</p>\r\n\r\n	<p><a href=\"https://policies.google.com/technologies/ads\">https://policies.google.com/technologies/ads</a></p>\r\n	</li>\r\n</ul>\r\n\r\n<h6>Advertising Partners Privacy Policies</h6>\r\n\r\n<p>You may consult this list to find the Privacy Policy for each of the advertising partners of Trash Mails.</p>\r\n\r\n<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Trash Mails, which are sent directly to users&#39; browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>\r\n\r\n<p>Note that Trash Mails has no access to or control over these cookies that are used by third-party advertisers.</p>\r\n\r\n<h6>Third Party Privacy Policies</h6>\r\n\r\n<p>Trash Mails&#39;s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</p>\r\n\r\n<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers&#39; respective websites.</p>\r\n\r\n<h6>CCPA Privacy Rights (Do Not Sell My Personal Information)</h6>\r\n\r\n<p>Under the CCPA, among other rights, California consumers have the right to:</p>\r\n\r\n<p>Request that a business that collects a consumer&#39;s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>\r\n\r\n<p>Request that a business delete any personal data about the consumer that a business has collected.</p>\r\n\r\n<p>Request that a business that sells a consumer&#39;s personal data, not sell the consumer&#39;s personal data.</p>\r\n\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n\r\n<h6>GDPR Data Protection Rights</h6>\r\n\r\n<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>\r\n\r\n<p>The right to access &acirc;&euro;&ldquo; You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>\r\n\r\n<p>The right to rectification &acirc;&euro;&ldquo; You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>\r\n\r\n<p>The right to erasure &acirc;&euro;&ldquo; You have the right to request that we erase your personal data, under certain conditions.</p>\r\n\r\n<p>The right to restrict processing &acirc;&euro;&ldquo; You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>\r\n\r\n<p>The right to object to processing &acirc;&euro;&ldquo; You have the right to object to our processing of your personal data, under certain conditions.</p>\r\n\r\n<p>The right to data portability &acirc;&euro;&ldquo; You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>\r\n\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n\r\n<h6>Children&#39;s Information</h6>\r\n\r\n<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>\r\n\r\n<p>Trash Mails does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>', 1, '2021-11-11 11:46:10', '2021-11-11 11:46:10');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `slug`, `content`, `image`, `status`, `views`, `keywords`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'The secret to moving this ancient sphinx screening', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'the-secret-to-moving-this-ancient-sphinx-screening', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book<br />\r\n&nbsp;</p>\r\n\r\n<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<ul>\r\n	<li>Lorem Ipsum has been the industry&#39;s</li>\r\n	<li>The generated Lorem Ipsum is therefore always</li>\r\n	<li>Making this the first true generator</li>\r\n</ul>\r\n\r\n<p><br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>\r\n\r\n<p><br />\r\nIt uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>', 'uploads/dhvU5G40N4ibVJX_1636633728.jpg', 1, 6, 'keyword', 1, '2021-11-11 11:28:48', '2021-11-21 16:32:12'),
(2, 'Tazzer Group is what you Need, Deserve & Desire', 'Tazzer Group provides the services you require, deserve, and desire. Your money goes the extra mile & quality for loss is quality for less.', 'tazzer-group-is-what-you-need-deserve-desire', '<p><strong>WHY CHOOSE OUR SERVICES?</strong></p>\r\n\r\n<p>We are the Best &amp; Top-Rated Industry</p>\r\n\r\n<p>Tazzer Group provides high quality, professional and on-demand services that are highly trusted and convenient with a highly professional team.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;The one-stop-shop platform for services &amp; products near you.</li>\r\n	<li>&nbsp;We Work Hard, so you Can Work Smart</li>\r\n	<li>&nbsp;Get your business on the map with our app &amp; extend your business.</li>\r\n	<li>&nbsp;No need for an appointment as you can book or register instantly through the web &amp; app.</li>\r\n	<li>&nbsp;We help you reach your target audience &amp; cover any demographics that you like. So, we know how to help your company succeed. Save time and money by allowing us to do all of the legwork for you.</li>\r\n	<li>&nbsp;Our approach is unique because we deliver end-to-end solutions within complex, fully integrated multi-vendor environments. We take the time to understand the individual business issues of each of our customers to ensure they position themselves and maintain leadership in their perspective market environment.</li>\r\n	<li>&nbsp;Tazzer Group provides the services you require, deserve, and desire. Your money goes the extra mile, &amp; you get quality for less.</li>\r\n</ul>\r\n\r\n<h4>&nbsp;</h4>\r\n\r\n<h4><strong>WE ARE YOUR&nbsp;PARTNER WHO CARES ABOUT YOUR HEALTHY</strong></h4>\r\n\r\n<p>TazzerGroup is a Web and mobile-b based solution, which provides end-user with the required service as fast as possible. Users will be able to order their desired service near them and to their doorsteps within minutes. They will be able to make bookings and payments on the platform. TazzerGroup will process secure transactions and a security engine will keep the user&rsquo;s private data in an encrypted format.</p>\r\n\r\n<p>TazzerGroup&#39;s goal is to support independent professionals and small and medium-sized organizations to reach their maximum potential and achieve their objectives. We want to see our customers grow while learning in the process, and we want to encourage high-quality services, best practices, and excellence within our industry.</p>\r\n\r\n<p>TazzerGroup platform has a very wide range of services just to name a few from Cleaning, Handyman, Construction, Clearance and rubbish removal, Consultancy, Engineering, Dog Walking Scaffolding, Domestic helpers, Gardening, Property management, and many others.</p>\r\n\r\n<p>TazzerGroup provides opportunities for workers to display their skills on the TazzerGroup Platform. They will be generalized into different categories including Employee, Sole Trader, Organization, Partners. Every category has its perks.</p>', 'uploads/omar.jpg', 1, 6, 'tazzer', 1, '2021-11-11 11:34:09', '2021-11-21 16:32:07'),
(3, 'PETPRO NEWSLETTER', 'Choose your pet and subscribe! Receive exclusive discounts\r\nto always buy at the best price in Petpro.', 'petpro-newsletter', '<h1>Hill&#39;s Science Plan - Feline Adult Hairball Control W/ Chicken</h1>\r\n\r\n<p>Hill&#39;s Science Plan Feline Adult Hairball Control Chicken helps avoid the formation of hairballs. A gentle formula for everyday feeding with clinically proven antioxidants and tailored phosphorus levels.</p>\r\n\r\n<ul>\r\n	<li>Natural Fiber Technology to reduce hairball formation</li>\r\n	<li>Essential nutrients for reduced shedding</li>\r\n	<li>Controlled mineral levels to support urinary health</li>\r\n	<li>Made with high-quality ingredients for great taste.</li>\r\n</ul>\r\n\r\n<h2>Supplier Information</h2>\r\n\r\n<h3>HILL&rsquo;S SCIENCE PLAN&nbsp;(TEST CITY, US)</h3>\r\n\r\n<p>This is the short description of the demo article.</p>\r\n\r\n<p>Add a detailed description of the demo article that may be a little bit longer.</p>', 'uploads/YZrMdMbRzrEElwR_1636634445.png', 1, 7, 'PETPRO', 1, '2021-11-11 11:40:45', '2021-11-21 16:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mail_addr` varchar(50) CHARACTER SET ascii DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `vatnum` varchar(50) CHARACTER SET ascii DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) CHARACTER SET ascii DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) CHARACTER SET ascii DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `default_address` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `mail_addr`, `firstname`, `lastname`, `company`, `vatnum`, `address`, `postcode`, `city`, `telephone`, `country`, `state`, `default_address`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'yakovich', 'zakharov', 'dev', NULL, 'Krasnodar, Russia', NULL, 'Gorod Krasnodar', NULL, 'Russia', 'Krasnodar Krai', 1, '2021-11-17 15:46:24', '2021-11-17 14:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'name', 'Mailer Tester', NULL, '2021-11-15 06:16:44'),
(2, 'site_url', 'https://mail-analyzer.com', NULL, '2021-11-15 03:03:01'),
(3, 'site_logo', '/uploads/logo.png', NULL, '2021-08-30 09:26:57'),
(4, 'favicon', '/uploads/favicon.png', NULL, '2021-08-30 10:08:43'),
(5, 'imap_host', 'mail-analyzer.com', NULL, '2021-11-15 03:16:44'),
(6, 'imap_user', 'tona@mail-analyzer.com', NULL, '2021-11-15 10:45:43'),
(7, 'imap_pass', 'P8r44ra^', NULL, '2021-11-15 10:50:02'),
(8, 'domains', 'mail-analyzer.com', NULL, '2021-11-15 03:02:26'),
(9, 'premium_domains', NULL, NULL, '2021-08-15 02:28:25'),
(10, 'forbidden_id', 'admin', NULL, '2021-08-30 09:49:48'),
(11, 'allowed_files', 'doc,docx,xls,xlsx,ppt,pptx,xps,pdf,dxf,ai,psd,eps,ps,svg,ttf,zip,rar,tar,gzip,mp3,mpeg,wav,ogg,jpeg,jpg,png,gif,bmp,tif,webm,mpeg4,3gpp,mov,avi,mpegs,wmv,flx', NULL, '2021-09-02 02:41:16'),
(12, 'fetch_time', '20', NULL, '2021-09-02 01:24:03'),
(13, 'email_lifetime', '5', NULL, '2021-08-30 09:49:48'),
(14, 'description', NULL, NULL, '2021-08-27 01:02:50'),
(15, 'keywords', NULL, NULL, '2021-08-27 01:02:50'),
(16, 'google_analytics_code', NULL, NULL, '2021-08-26 18:42:52'),
(17, 'enable_blog', '1', NULL, '2021-08-30 10:07:43'),
(18, 'popular_posts', '6', NULL, '2021-08-30 10:07:43'),
(19, 'max_posts', '6', NULL, '2021-08-30 10:07:43'),
(20, 'disqus', NULL, NULL, '2021-08-31 11:29:05'),
(21, 'top_ad', '<center><img src=\'https://via.placeholder.com/720x90\'></center>', NULL, '2021-08-31 11:00:37'),
(22, 'bottom_ad', '<center><img src=\'https://via.placeholder.com/720x90\'></center>', NULL, '2021-08-31 11:01:24'),
(23, 'right_ad', '<center><img src=\'https://via.placeholder.com/200x600\'></center>', NULL, '2021-08-31 11:01:24'),
(24, 'left_ad', '<center><img src=\'https://via.placeholder.com/200x600\'></center>', NULL, '2021-08-31 11:01:24'),
(25, 'head_ad', NULL, NULL, '2021-08-26 18:42:42'),
(26, 'sidebar_ad', '<center><img src=\'https://via.placeholder.com/350x350\'></center>', NULL, '2021-08-31 11:01:24'),
(27, 'main_color', '#161a1d', NULL, '2021-08-30 09:15:13'),
(28, 'secondary_color', '#00af91', NULL, '2021-08-30 09:15:13'),
(29, 'MAIL_MAILER', 'smtp', NULL, '2021-08-31 04:33:44'),
(30, 'MAIL_HOST', 'mail-analyzer.com', NULL, '2021-11-15 03:01:37'),
(31, 'MAIL_PORT', '465', NULL, '2021-08-31 05:09:47'),
(32, 'MAIL_USERNAME', 'tona@mail-analyzer.com', NULL, '2021-11-19 13:26:26'),
(33, 'MAIL_PASSWORD', 'tonatest', NULL, '2021-11-19 13:26:26'),
(34, 'MAIL_ENCRYPTION', 'tls', NULL, '2021-08-31 04:56:02'),
(35, 'MAIL_FROM_ADDRESS', 'tona@mail-analyzer.com', NULL, '2021-11-16 00:35:27'),
(36, 'emails_created', '0', NULL, '2021-08-30 10:31:30'),
(37, 'messages_received', '0', NULL, '2021-08-30 10:31:30'),
(38, 'total_emails_created', '71', NULL, '2021-11-23 01:00:07'),
(39, 'total_messages_received', '5', NULL, '2021-11-19 23:43:55'),
(40, 'facebook', '#trashmails', NULL, '2021-08-30 10:07:25'),
(41, 'instagram', '#trashmails', NULL, '2021-08-30 10:07:25'),
(42, 'youtube', '#trashmails', NULL, '2021-08-30 10:07:25'),
(43, 'twitter', '#trashmails', NULL, '2021-08-30 10:07:25'),
(44, 'chrome_extensions', '#', NULL, '2021-08-30 10:07:25'),
(45, 'mozilla_extensions', '#', NULL, '2021-08-30 10:07:25'),
(46, 'playstore', '#', NULL, '2021-08-30 10:07:25'),
(47, 'appstore', '#', NULL, '2021-08-30 10:07:25'),
(48, 'MAIL_TO_ADDRESS', 'admin@mail-analyzer.com', NULL, '2021-11-16 00:51:28'),
(49, 'imap_port', '993', NULL, '2021-11-15 09:58:59'),
(50, 'imap_encryption', 'ssl', NULL, '2021-09-02 04:00:22'),
(51, 'imap_certificate', '1', NULL, '2021-09-02 03:59:14'),
(52, 'lang', 'en', NULL, NULL),
(53, 'google_tag_manager', NULL, NULL, NULL),
(54, 'RECAPTCHA_SECRET_KEY', '6LfJb0QdAAAAAJwddREIM2IydyCr3iH8_tm0ns7f', NULL, '2021-11-15 04:32:00'),
(55, 'RECAPTCHA_SITE_KEY', '6LfJb0QdAAAAALGbbXCFxKIzLoaXJBZMsEZM88vL', NULL, '2021-11-15 04:32:00'),
(56, 'COOKIE_CONSENT_ENABLED', '1', NULL, NULL),
(57, 'https_force', '0', NULL, NULL),
(58, 'email_lifetime_type', '1440', NULL, NULL),
(59, 'custom_tags', NULL, NULL, NULL),
(60, 'separator', '|', NULL, NULL),
(61, 'og_image', 'uploads/cover.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'total_email_pay_day', '0', '2021-11-10 05:10:42', '2021-11-11 05:10:42'),
(2, 'total_messges_pay_day', '0', '2021-11-10 05:10:42', '2021-11-11 05:10:42'),
(3, 'total_email_pay_day', '0', '2021-11-09 05:10:42', '2021-11-11 05:10:42'),
(4, 'total_messges_pay_day', '0', '2021-11-09 05:10:42', '2021-11-11 05:10:42'),
(5, 'total_email_pay_day', '0', '2021-11-08 05:10:42', '2021-11-11 05:10:42'),
(6, 'total_messges_pay_day', '0', '2021-11-08 05:10:42', '2021-11-11 05:10:42'),
(7, 'total_email_pay_day', '0', '2021-11-07 05:10:42', '2021-11-11 05:10:42'),
(8, 'total_messges_pay_day', '0', '2021-11-07 05:10:43', '2021-11-11 05:10:43'),
(9, 'total_email_pay_day', '0', '2021-11-06 05:10:43', '2021-11-11 05:10:43'),
(10, 'total_messges_pay_day', '0', '2021-11-06 05:10:43', '2021-11-11 05:10:43'),
(11, 'total_email_pay_day', '0', '2021-11-05 05:10:43', '2021-11-11 05:10:43'),
(12, 'total_messges_pay_day', '0', '2021-11-05 05:10:43', '2021-11-11 05:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `mail_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) CHARACTER SET ascii NOT NULL,
  `name` varchar(100) NOT NULL,
  `received_at` datetime DEFAULT NULL,
  `tested_at` datetime DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `header` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `score` float NOT NULL DEFAULT 0,
  `sender` varchar(100) CHARACTER SET ascii DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`id`, `mail_id`, `user_id`, `email`, `name`, `received_at`, `tested_at`, `subject`, `header`, `content`, `score`, `sender`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 'tona@mail-analyzer.com', 'user', '2021-11-17 07:46:48', '2021-11-20 03:48:32', 'Action Required: Confirm your email', 'Return-Path: <pm_bounces@pmbounces.postmarkapp.com>\r\nX-Original-To: tona@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from mta202a-ord.mtasv.net (mta202a-ord.mtasv.net [104.245.209.202])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id DB72D20C44\r\n	for <tona@mail-analyzer.com>; Wed, 17 Nov 2021 08:46:52 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=REJECT sp=NONE) smtp.from=pmbounces.postmarkapp.com header.from=postmarkapp.com;\r\n	dkim=pass header.d=pm.mtasv.net;\r\n	dkim=pass header.d=postmarkapp.com;\r\n        spf=pass (sender IP is 104.245.209.202) smtp.mailfrom=pm_bounces@pmbounces.postmarkapp.com smtp.helo=mta202a-ord.mtasv.net\r\nReceived-SPF: pass (obistar.com: domain of pmbounces.postmarkapp.com designates 104.245.209.202 as permitted sender) client-ip=104.245.209.202; envelope-from=pm_bounces@pmbounces.postmarkapp.com; helo=mta202a-ord.mtasv.net;\r\nDKIM-Signature: v=1; a=rsa-sha1; c=relaxed/relaxed; s=pm; d=pm.mtasv.net;\r\n h=From:Date:Subject:Message-Id:To:MIME-Version:Content-Type;\r\n bh=aYN8XNXjk/hpAbI129MeKOYSwEw=;\r\n b=yJru+u64p71RUZPSy4o8ZTu8f3Y1b6cPA/D+Rm982FrjOXKTwUglfZ6FrQeYb5FkP7kyjKUJIa9h\r\n   9DxntMgHCfrquOXkZxkBYWKSnR1boQGgR/7FERQY0mAvMyagphXHAJdh3GScgCIFVnZ0VIkofgiJ\r\n   ZCq6SsWtjj7mJtNlmYg=\r\nReceived: by mta202a-ord.mtasv.net id hiipmq27tk4c for <tona@mail-analyzer.com>; Wed, 17 Nov 2021 02:46:51 -0500 (envelope-from <pm_bounces@pmbounces.postmarkapp.com>)\r\nX-PM-IP: 104.245.209.202\r\nX-IADB-IP: 104.245.209.202\r\nX-IADB-IP-REVERSE: 202.209.245.104\r\nDKIM-Signature: v=1; a=rsa-sha256; d=postmarkapp.com; s=20131124034823.pm;\r\n	c=relaxed/relaxed; i=support@postmarkapp.com; t=1637135211;\r\n	h=cc:content-transfer-encoding:content-type:date:from:in-reply-to:\r\n	list-archive:list-help:list-id:list-owner:list-post:list-subscribe:\r\n	list-unsubscribe:mime-version:message-id:references:reply-to:resent-cc:\r\n	resent-date:resent-from:resent-message-id:resent-sender:resent-to:sender:\r\n	subject:to:feedback-id;\r\n	bh=5tlNiu55cxT96ijI3ovQY8HR9zsjd1+CiMfDCuc9jjw=;\r\n	b=YeV78KH9qYbYaqGZ4ClqSgf0obTXohk3S8/D5RmTboas7C49XpQV3IoL9K5BCOjrwTC7sTyn5lH\r\n	RXNr4C1zYuyZguLKNI0nhA1Z2B4j8myKRF1IHjlyaoZNZs5Fbw3zqeXfW6BkgLMxhxhcWhQQrFsaX\r\n	2DcdhQ01zUKl5dRkcww=\r\nFrom: Postmark Support <support@postmarkapp.com>\r\nDate: Wed, 17 Nov 2021 07:46:48 +0000\r\nSubject: Action Required: Confirm your email\r\nMessage-Id: <53a0ab81-2b43-4608-9d7f-fe2b5e8764d7@mtasv.net>\r\nTo: tona@mail-analyzer.com\r\nFeedback-ID: s40483-c2lnbnVw:s40483:a50355:postmark\r\nX-Complaints-To: abuse@postmarkapp.com\r\nX-PM-Message-Id: 53a0ab81-2b43-4608-9d7f-fe2b5e8764d7\r\nX-PM-Tag: signup\r\nX-PM-RCPT: |bTB8NTAzNTV8NDA0ODN8dG9uYUBtYWlsLWFuYWx5emVyLmNvbQ==|\r\nX-PM-Message-Options: v1;9Hcc_PIAriBnYBOfaIwCcyIPcaJJ4QcTBG0Vjf0upsKfpR9qOJtFHrXwPywaBTAW0yivONdmCE8g_Gy1UcqUBBDOwW7mU_BYoMQKRhXnXR0\r\nMIME-Version: 1.0\r\nContent-Type: multipart/alternative;\r\n	boundary=mk3-49b3c71cfcf0487aada28f18d4565a2b; charset=UTF-8\r\n\r\n', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head>\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\r\n    <meta name=\"x-apple-disable-message-reformatting\" />\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n    <meta name=\"color-scheme\" content=\"light dark\" />\r\n    <meta name=\"supported-color-schemes\" content=\"light dark\" />\r\n    <title>Postmark</title>\r\n\r\n    <style type=\"text/css\" rel=\"stylesheet\" media=\"all\">@media screen and (max-width: 599px) {pre{width:230px;}}@media screen and (max-width: 599px) {.email-top_inner{width:100%;}}@media (prefers-color-scheme: dark) {.email-body_inner--other-things,.email-body_inner--other-things .content-block{background-color:#FFDE00 !important;}}@media screen and (max-width: 599px) {.email-body_inner,.email-footer{width:100%;}}@media only screen and (max-width: 500px) {.btn{width:100% !important;}}@media screen and (max-width: 599px) {.hero{padding:40px 30px 0  !important;}}@media screen and (max-width: 599px) {.welcome{padding:30px 30px 10px  !important;}}@media screen and (max-width: 599px) {.signature{padding:0 30px  !important;}.signature_author,.signature_action{width:100%;height:auto;}.signature_action{text-align:center;}.signature_action td{padding-top:10px;padding-bottom:25px;text-align:center;}.postmark .signature--logo .signature_action td{padding-top:10px;}}@media screen and (max-width: 599px) {.content-block{padding:30px !important;}.content-block--image{padding-top:0 !important;padding-bottom:0 !important;}.content-block_image-container{text-align:center;}.content-block_image-container,.content-block_body-container{width:100%;}.content-block--small .content-block_title{margin-top:15px !important;}}@media screen and (max-width: 599px) {.divider{padding:20px 30px  !important;}.divider_image--desktop{display:none;}.divider_image--mobile{display:block !important;height:auto !important;max-height:none !important;font-size:15px !important;}.divider--thick{padding:20px 0  !important;}.divider--no-padding{padding-top:0 !important;padding-bottom:0 !important;}.divider--no-pad-bottom{padding-bottom:0 !important;}}@media screen and (max-width: 599px) {.testimonial{padding:20px 30px  !important;}.testimonial_container{width:100%;}}@media screen and (max-width: 599px) {.cta-banner{padding:30px !important;}.cta-banner_title,.cta-banner_sub-title{text-align:center !important;}.cta-banner_body,.cta-banner_action{width:100%;}.cta-banner_action,.cta-banner_action td{text-align:center !important;}.cta-banner--centered .cta-banner_action td{text-align:center;}}@media screen and (max-width: 599px) {.footer{padding:0 30px  !important;}.footer_table{width:100%;}.footer--slim{padding:15px 30px  !important;}}@media screen and (max-width: 599px) {.product-ad{float:none !important;width:100%;margin-bottom:30px;}.product-ad_container{width:220px;}}@media screen and (max-width: 599px) {.email-prefs{padding:12px 30px  !important;}}@media screen and (max-width: 599px) {.follow-banner{padding:25px 30px  !important;}.follow-banner_logo,.follow-banner_links{width:100%;text-align:center !important;}.follow-banner_logo{margin-bottom:20px;}.follow-banner_logo td{text-align:center !important;}.follow-banner_links td{text-align:center !important;}.follow-banner_links span{display:block;}}@media screen and (max-width: 599px) {.post{padding:15px 30px  !important;}}@media screen and (max-width: 599px) {.share{padding:20px 30px  !important;}}@media (prefers-color-scheme: dark) {body{background-color:#111 !important;}.pm-snippet{background-color:#111 !important;border-color:#333 !important;color:#E6E6E6 !important;}.pm-key,.pm-domain{color:#E6E6E6 !important;}.spacer{background-color:#222 !important;color:transparent !important;}.email-wrapper{background-color:#111 !important;}.btn{color:#E6E6E6 !important;}.btn:visited{color:#E6E6E6 !important;}h1{color:#E6E6E6 !important;}h2{color:#E6E6E6 !important;}h3{color:#E6E6E6 !important;}p{color:#E6E6E6 !important;}ul{color:#E6E6E6 !important;}ol{color:#E6E6E6 !important;}li{color:#E6E6E6 !important;}.content-block{color:#E6E6E6 !important;}.welcome,.content-block{background-color:#222 !important;}.divider_line{border-color:#333 !important;}.divider{background-color:#222 !important;}.purchase{border-color:#333 !important;}.purchase td{border-color:#333 !important;}.cta-banner--dmarcdigests{border-top-color:#333 !important;}.cta-banner{background-color:#222 !important;}.footer{background-color:#222 !important;}.footer--outer{background-color:#111 !important;}.footer--slim p{color:#666 !important;}.footer--slim a{color:#666 !important;}.footer--slim a:visited{color:#666 !important;}.follow-banner{filter:brightness(0.9) !important;}.header--filled{filter:brightness(0.9) !important;}.header--digest{border-bottom-color:#333 !important;background-color:#222 !important;}.header--digest .header_logo img{filter:invert(1) !important;}.panel--warning{border-color:#847450 !important;background:#34311A !important;}.panel--error{border-color:#483737 !important;background-color:#2E2222 !important;}.panel--success{border-color:#3D5332 !important;background-color:#2D302C !important;}.panel--info{border-color:#2C3D46 !important;background-color:#131D23 !important;}.panel_title{color:#E6E6E6 !important;}.hero{filter:brightness(0.9) !important;}}a:visited{color:#007BC8 !important;text-decoration:underline !important;}a:visited img{border:none !important;}.email-body_inner--other-things .content-block_body a:visited{color:#005E99 !important;}.btn:visited{box-sizing:border-box !important;border-top:10px solid #007BC8 !important;border-right:18px solid #007BC8 !important;border-bottom:10px solid #007BC8 !important;border-left:18px solid #007BC8 !important;background-color:#007BC8 !important;font-size:14px !important;display:inline-block !important;height:auto !important;border-radius:3px !important;color:#FFF !important;text-align:center !important;text-decoration:none !important;-webkit-text-size-adjust:none !important;font-weight:bold !important;padding:5px 10px !important;}.btn--ghost:visited{border-top:10px solid #E6F2FA !important;border-right:18px solid #E6F2FA !important;border-bottom:10px solid #E6F2FA !important;border-left:18px solid #E6F2FA !important;background-color:#E6F2FA !important;font-size:14px !important;display:inline-block !important;height:auto !important;border-radius:3px !important;color:#007BC8 !important;text-align:center !important;text-decoration:none !important;-webkit-text-size-adjust:none !important;}.testimonial_name a:visited{color:#333 !important;}.testimonial_position a:visited{color:#777 !important;}.footer--slim a:visited{color:rgba(255,255,255,0.5) !important;}.footer--outer a:visited{color:#A9A696 !important;}.product-ad_link:visited{text-decoration:none !important;}.email-prefs a:visited{color:#777 !important;}.postmark .follow-banner a:visited{color:#333 !important;}.post_title a:visited{color:#333 !important;}:root{color-scheme:light dark !important;supported-color-schemes:light dark !important;}</style>\r\n    <!--[if mso]>\r\n    <style type=\"text/css\">\r\n      .email-wrapper {\r\n        font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif !important;\r\n      }\r\n      p,\r\n      ul,\r\n      ol,\r\n      li,\r\n      blockquote {\r\n        line-height: 1.5 !important;\r\n      }\r\n    </style>\r\n    <![endif]-->\r\n</head>\r\n\r\n<body class=\"postmark\" style=\"height: 100%; margin: 0; background-color: #EEECE4; color: #333; line-height: 1.6; -webkit-text-size-adjust: none; width: 100% !important;\">\r\n  <table class=\"email-wrapper\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; width: 100%; margin: 0; padding: 0; background-color: #F5F3EB;\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\" align=\"center\">\r\n        <table class=\"email-content\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; width: 100%; margin: 0; padding: 0;\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td class=\"email-top\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 10px 0;\" width=\"100%\" cellpadding=\"5\" cellspacing=\"0\">\r\n              <table class=\"email-top_inner\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;\" align=\"center\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td class=\"email-top_content\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; text-align: center; font-size: 12px; color: #A9A696;\"></td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n\r\n          <tr>\r\n            <td class=\"email-body\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n              <table class=\"email-body_inner\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFF;\" align=\"center\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 50px; background-color: #FFF;\">\r\n                    <h1 class=\"content-block_title\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 0; color: #333; font-weight: bold; font-size: 21px; text-align: left; margin: 0 0 15px;\">Hi yakov zakharov &#128075;</h1>\r\n                    <div class=\"content-block_body\">\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #333; font-size: 15px;\">Welcome to Postmark, new friend! Your username to log in is <strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">yasha3651</strong>.</p>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #333; font-size: 15px;\">To get your account ready for sending, we&#8217;ve created a Sender Signature for <strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">tona@mail-analyzer.com</strong>. We&#8217;ll use that email address as the &#8220;From&#8221; address on the emails you send. But before we can do that, we need you to confirm that this email belongs to you:</p>\r\n  \r\n                      <div style=\"margin-bottom: 25px;\">\r\n                        <a target=\"blank\" class=\"btn\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #FFF; text-decoration: none; box-sizing: border-box; border-top: 10px solid #007BC8; border-right: 18px solid #007BC8; border-bottom: 10px solid #007BC8; border-left: 18px solid #007BC8; background-color: #007BC8; font-size: 14px; display: inline-block; height: auto; border-radius: 3px; text-align: center; -webkit-text-size-adjust: none; font-weight: bold; padding: 5px 10px;\" href=\"https://api.postmarkapp.com/signatures/confirm?token=1ba95d07-a254-4585-bfa1-dea4b618c3df\">Confirm Sender Signature</a>\r\n                      </div>\r\n  \r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 0 !important; color: #333; font-size: 15px;\"><strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">Want to use another &#8220;From&#8221; name and address to send emails?</strong> No problem! <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #007BC8; text-decoration: underline;\" href=\"https://account.postmarkapp.com/signature_domains\" target=\"_blank\">Add and verify other Sender Signatures</a> (or remove ones you no longer need) at any time in the app.</p>\r\n                    </div>\r\n                  </td>\r\n                </tr>\r\n                </tbody></table>\r\n\r\n                <table class=\"email-body_inner email-body_inner--other-things\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFDE00; color: #272727 !important;\" align=\"center\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 50px; background-color: #FFDE00; padding-bottom: 0;\">\r\n                    <h1 class=\"content-block_title\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 0; color: #272727 !important; font-weight: bold; font-size: 21px; text-align: left; margin: 0 0 15px;\">Other things to know</h1>\r\n                    <div class=\"content-block_body\">\r\n                      <h2 style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 1.333em; color: #272727 !important; font-weight: bold; font-size: 18px; text-align: left; margin-bottom: 0.666em;\">\r\n                        <img class=\"content-block_subtitle-icon\" style=\"margin-right: 2px; margin-bottom: -2px;\" src=\"https://assets.wildbit.com/postmark/emails/images/icon-test-mode@2x.png\" alt width=\"18\" height=\"18\" />\r\n                        Test mode and requesting account approval\r\n                      </h2>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #272727 !important; font-size: 15px;\">Your account is currently in test mode. That allows you to get familiar with Postmark, and <strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">send up to 100 emails to domains that you&#8217;ve verified.</strong> Once you&#8217;re ready to send emails to others, we&#8217;ll need to approve your account. Why? Reviewing each account helps us tell the <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://postmarkapp.com/support/article/1082-what-types-of-messages-are-a-good-fit-for-postmark?utm_source=pm_onboarding&utm_medium=email&utm_campaign=2110_onboarding\" target=\"_blank\">responsible senders</a> (that&#8217;s you!) apart from the spammers (boo!), so we can maintain our stellar deliverability rates for all customers. So whenever you&#8217;re ready, <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://account.postmarkapp.com/account_approval/apply\" target=\"_blank\">submit an approval request</a>.</p>\r\n  \r\n                      <h2 style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 1.333em; color: #272727 !important; font-weight: bold; font-size: 18px; text-align: left; margin-bottom: 0.666em;\">\r\n                        <img class=\"content-block_subtitle-icon\" style=\"margin-right: 2px; margin-bottom: -2px;\" src=\"https://assets.wildbit.com/postmark/emails/images/icon-get-started@2x.png\" alt width=\"18\" height=\"18\" />\r\n                        Handy resources to help you get started\r\n                      </h2>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #272727 !important; font-size: 15px;\">Check out our easy-to-follow <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://postmarkapp.com/manual?utm_source=pm_onboarding&utm_medium=email&utm_campaign=2110_onboarding\">getting started guides</a> and detailed <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://postmarkapp.com/developer?utm_source=pm_onboarding&utm_medium=email&utm_campaign=2110_onboarding\">developer docs</a> to get set up in Postmark. Still need help? Our Customer Success team is <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://twitter.com/nckrtl/status/1377714048364597250\">pretty</a> <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://twitter.com/garrettdimon/status/1390489002801782786\">darn</a> <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://twitter.com/dixpac/status/1390587202191699970\">great</a>, so just reply to this message if you have any questions.</p>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 0 !important; color: #272727 !important; font-size: 15px;\">Happy sending,<br />The Postmark Team</p>\r\n                    </div>\r\n\r\n                    <div class=\"content-block_img-bleed-btm\" style=\"margin-top: 50px; text-align: center;\">\r\n                      <img style=\"vertical-align: middle\" src=\"https://assets.wildbit.com/postmark/emails/images/signup-machine@2x.png\" alt width=\"461.5\" height=\"243\" />\r\n                    </div>\r\n                  </td>\r\n                </tr>\r\n\r\n                <tr>\r\n                  <td class=\"footer footer--slim\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 10px 50px; background-color: #353942; color: #FFF; border-top: 0;\">\r\n                    <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: center; margin-top: 0; margin-bottom: 25px; color: #353942; font-size: 14px; margin: 0;\">&#128140; <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: rgba(255,255,255,0.5); text-decoration: underline;\" href=\"https://postmarkapp.com/newsletter\">Subscribe to the Postmark newsletter</a></p>\r\n                  </td>\r\n                </tr>\r\n\r\n                <tr class=\"footer footer--outer\" style=\"padding: 0 50px; background-color: #F5F3EB; color: #FFF;\">\r\n                  <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 25px 0;\">\r\n                    <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: center; margin-top: 0; margin-bottom: 25px; color: #A9A696; font-size: 14px; margin: 0;\">\r\n                      <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #A9A696; text-decoration: underline;\" href=\"https://wildbit.com\" target=\"_blank\">Wildbit LLC</a>, 12 Penns Trail, #521, Newtown, PA 18940\r\n                    </p>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n  </tbody></table>\r\n\r\n\r\n<img src=\"https://ea.pstmrk.it/open/v3_F97CG1hArHZE6hxITpujNSN8UnLCGAVzT-8I2NviCR2OGuy-G_ERz5QF80r9VmeCuCXnVPzxuBiRUmEkvjaJAZPTKEFA6q3cb5q0YbsBeWn9dWOYklThSbAP9p4KxeLd10BPIWXbxgKGYU5SXpVasuGLPtx6t2k1ghbC6cbNY7zXIiHflEZs0asGagTVkWYzyBbw5OJ3ShWNnAUnj1W5DnzMVxFh_qikgzjg64qLMg7ZMl7nZfn5XwYsQlcNZB3CMvtpu4jeSXWIUiN8HIcFeJhuBIWRep2b1SlHzcm-mqY76-arcpsMLjQIgSmS82pnMAeKypdO_U9IX9uzvyMVzcl1SBB0LKyz1V4p-3pHpIAQG64SotxaoXEUe025RRKelRDfO3GvCCsvMKi-DdK4c4Nrs8hh-HGPKRfsXebqlPsra7JXMvStjjKMuhAppFgu\" width=\"1\" height=\"1\" border=\"0\" alt=\"\" /></body></html>', 7.8, 'support@postmarkapp.com', '2021-11-20 03:48:32', '2021-11-20 03:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `translates`
--

CREATE TABLE `translates` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translates`
--

INSERT INTO `translates` (`id`, `lang`, `key`, `value`, `collection`, `created_at`, `updated_at`) VALUES
(1, 'en', 'Mailbox Small Title', 'Test the Spammyness of your Emails', 'general', NULL, '2021-09-14 03:25:59'),
(2, 'en', 'Mailbox Description', 'Forget about spam, advertising mailings, hacking and attacking robots. Keep your real mailbox clean and secure. Mails Tester provides temporary, secure, anonymous, free, disposable email address.', 'general', NULL, '2021-09-14 03:25:59'),
(3, 'en', 'Refresh', 'Refresh', 'general', NULL, '2021-09-14 03:25:59'),
(4, 'en', 'Change', 'Change', 'general', NULL, '2021-09-14 03:25:59'),
(5, 'en', 'Delete', 'Delete', 'general', NULL, '2021-09-14 03:25:59'),
(6, 'en', 'Sender', 'Sender', 'general', NULL, '2021-09-14 03:25:59'),
(7, 'en', 'Subject', 'Subject', 'general', NULL, '2021-09-14 03:25:59'),
(8, 'en', 'View', 'View', 'general', NULL, '2021-09-14 03:25:59'),
(9, 'en', 'Your inbox is empty', 'Your inbox is empty', 'general', NULL, '2021-09-14 03:25:59'),
(10, 'en', 'Waiting for incoming emails', 'Waiting for incoming emails', 'general', NULL, '2021-09-14 03:25:59'),
(11, 'en', 'Awesome Features', 'Awesome Features', 'general', NULL, '2021-09-14 03:25:59'),
(12, 'en', 'Features Description', 'Disposable temporary email protects your real email address from spam, advertising mailings, malwares.', 'general', NULL, '2021-09-14 03:25:59'),
(13, 'en', 'Popular Posts', 'Popular Posts', 'general', NULL, '2021-09-14 03:25:59'),
(14, 'en', 'Back To List', 'Back To List', 'general', NULL, '2021-09-14 03:25:59'),
(15, 'en', 'Attachments', 'Attachments', 'general', NULL, '2021-09-14 03:25:59'),
(16, 'en', 'Copyright', 'Copyright ©2021 - MailsTester', 'general', NULL, '2021-09-14 03:25:59'),
(17, 'en', 'Blog', 'Blog', 'general', NULL, '2021-09-14 03:25:59'),
(18, 'en', 'Categories', 'Categories', 'general', NULL, '2021-09-14 03:26:00'),
(19, 'en', 'Leave a Reply', 'Leave a Reply', 'general', NULL, '2021-09-14 03:26:00'),
(20, 'en', 'Change E-mail Address', 'Change E-mail Address', 'general', NULL, '2021-09-14 03:26:00'),
(21, 'en', 'Change Description', '<b>Mails Tester</b> provides the ability to change your temporary email address on this page. <br> <br> To change or recover the email address, please enter the desired E-mail address and choose domain.', 'general', NULL, '2021-09-14 03:26:00'),
(22, 'en', 'Contact Us', 'Contact Us', 'general', NULL, '2021-09-14 03:26:00'),
(23, 'en', 'Contact Description', 'We’re here to help and answer any question you might have. <br> We look forward to hearing from you ?', 'general', NULL, '2021-09-14 03:26:00'),
(24, 'en', 'Emails Created', 'Emails Created', 'general', NULL, '2021-09-14 03:26:00'),
(25, 'en', 'Messages Received', 'Messages Received', 'general', NULL, '2021-09-14 03:26:00'),
(26, 'en', 'Cookie Message', 'Your experience on this site will be improved by allowing cookies.', 'general', NULL, '2021-09-14 03:26:00'),
(27, 'en', 'Cookie Button', 'Allow cookies', 'general', NULL, '2021-09-14 03:26:00'),
(29, 'en', 'Change Email', 'Change Email', 'general', '2021-09-14 04:33:28', '2021-09-14 04:34:44'),
(30, 'en', 'INBOX', 'INBOX', 'general', '2021-09-16 23:41:58', '2021-09-16 23:41:58'),
(31, 'en', 'We will add a contact from as soon as possible', 'We will add a contact from as soon as possible', 'general', '2021-09-16 23:42:47', '2021-09-16 23:42:47'),
(32, 'en', 'Enter Your Mail!', 'Enter Your Mail!', 'general', '2021-09-16 23:43:09', '2021-09-16 23:43:09'),
(33, 'en', 'Published in', 'Published in', 'general', '2021-09-16 23:44:40', '2021-09-16 23:44:40'),
(34, 'en', 'Date', 'Date', 'general', '2021-09-16 23:45:57', '2021-09-16 23:45:57'),
(35, 'en', 'The address you have chosen is already in use. Please choose a different one.', 'The address you have chosen is already in use. Please choose a different one.', 'general', '2021-09-16 23:51:41', '2021-09-16 23:51:41'),
(36, 'en', 'Your Name', 'Your Name', 'general', '2021-09-16 23:57:24', '2021-09-16 23:57:24'),
(37, 'en', 'Your Email', 'Your Email', 'general', '2021-09-16 23:57:24', '2021-09-16 23:57:24'),
(38, 'en', 'Your Phone', 'Your Phone', 'general', '2021-09-16 23:57:24', '2021-09-16 23:57:24'),
(39, 'en', 'Your Message', 'Your Message', 'general', '2021-09-16 23:57:24', '2021-09-16 23:57:24'),
(40, 'en', 'Send Message', 'Send Message', 'general', '2021-09-16 23:57:24', '2021-09-16 23:57:24'),
(41, 'en', 'We have received your message and would like to thank you for writing to us.', 'We have received your message and would like to thank you for writing to us.', 'general', '2021-09-16 23:57:56', '2021-09-16 23:57:56'),
(42, 'en', 'Not Found', 'Not Found', 'general', '2021-09-17 00:24:13', '2021-09-17 00:24:13'),
(43, 'en', 'Page Not Found', 'Page Not Found', 'general', '2021-09-17 00:24:13', '2021-09-17 00:24:13'),
(44, 'en', 'We are sorry but the page you are looking for was not found', 'We are sorry but the page you are looking for was not found', 'general', '2021-09-17 00:24:13', '2021-09-17 00:24:13'),
(45, 'en', 'Back to Home', 'Back to Home', 'general', '2021-09-17 00:24:13', '2021-09-17 00:24:13'),
(46, 'en', 'Unauthorised', 'Unauthorised', 'general', '2021-09-17 00:24:38', '2021-09-17 00:24:38'),
(47, 'en', 'Forbidden', 'Forbidden', 'general', '2021-09-17 00:24:50', '2021-09-17 00:24:50'),
(48, 'en', 'Method Not Allowed', 'Method Not Allowed', 'general', '2021-09-17 00:25:00', '2021-09-17 00:25:00'),
(49, 'en', 'Something is broken. Please let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.', 'Something is broken. Please let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.', 'general', '2021-09-17 00:25:00', '2021-09-17 00:25:00'),
(50, 'en', 'Page Expired', 'Page Expired', 'general', '2021-09-17 00:25:11', '2021-09-17 00:25:11'),
(51, 'en', 'Too Many Requests', 'Too Many Requests', 'general', '2021-09-17 00:25:16', '2021-09-17 00:25:16'),
(52, 'en', 'Internal Server Error', 'Internal Server Error', 'general', '2021-09-17 00:25:25', '2021-09-17 00:25:25'),
(53, 'en', 'Oops… You just found an error page', 'Oops… You just found an error page', 'general', '2021-09-17 00:25:25', '2021-09-17 00:25:25'),
(54, 'en', 'We are sorry but our server encountered an internal error', 'We are sorry but our server encountered an internal error', 'general', '2021-09-17 00:25:25', '2021-09-17 00:25:25'),
(55, 'en', 'Service Unavailable', 'Service Unavailable', 'general', '2021-09-17 00:25:36', '2021-09-17 00:25:36'),
(56, 'ar', 'Mailbox Small Title', 'بريدك الإلكتروني المؤقت', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(57, 'ar', 'Mailbox Description', 'تخلص الآن من الرسائل المتطفلة ورسائل الاعلانات و الاختراقات والهجوم الآلي. أبقى صندوق البريد الخاص بك نظيفا وآمنا. Temp Mail يزودك بعنوان بريد الكتروني آمن ومؤقت ومجاني ومجهول ويمكنك التخلص منه في أي وقت', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(58, 'ar', 'Refresh', 'تحديث', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(59, 'ar', 'Change', 'تغيير', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(60, 'ar', 'Delete', 'إحذف', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(61, 'ar', 'Sender', 'المرسل', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(62, 'ar', 'Subject', 'الموضوع', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(63, 'ar', 'View', 'مشاهدة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(64, 'ar', 'Your inbox is empty', 'صندوق الوارد الخاص بك فارغ', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(65, 'ar', 'Waiting for incoming emails', 'في انتظار رسائل البريد الإلكتروني الواردة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(66, 'ar', 'Awesome Features', 'ميزات رائعة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(67, 'ar', 'Features Description', 'يحمي البريد الإلكتروني المؤقت الذي يمكن التخلص منه عنوان بريدك الإلكتروني الحقيقي من البريد العشوائي والمراسلات الإعلانية والبرامج الضارة.', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(68, 'ar', 'Popular Posts', 'مقالات شائعة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(69, 'ar', 'Back To List', 'الرجوع للقائمة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(70, 'ar', 'Attachments', 'مرفقات', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(71, 'ar', 'Copyright', 'جميع الحقوق محفوضة 2021 - TrashMails', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(72, 'ar', 'Blog', 'مدونة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(73, 'ar', 'Categories', 'الاقسام', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(74, 'ar', 'Leave a Reply', 'اترك تعليقا', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(75, 'ar', 'Change E-mail Address', 'قم بتغير البريد الالكتروني', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(76, 'ar', 'Change Description', 'لتغير عنوان البريد الإلكتروني، يرجى ادخال عنوان البريد الالكتروني الذي ترغب به ومن ثم أنقر على حفظ.', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(77, 'ar', 'Contact Us', 'اتصل بنا', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(78, 'ar', 'Contact Description', 'نحن هنا للمساعدة والإجابة على أي سؤال قد يكون لديك.', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(79, 'ar', 'Emails Created', 'عدد الإيميلات المؤقتة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(80, 'ar', 'Messages Received', 'عدد الرسائل المستقبلة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(81, 'ar', 'Cookie Message', 'سيتم تحسين تجربتك على هذا الموقع من خلال السماح بملفات تعريف الارتباط.', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(82, 'ar', 'Cookie Button', 'السماح', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(84, 'ar', 'Change Email', 'تغيير', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(85, 'ar', 'INBOX', 'صندوق الواردات', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(86, 'ar', 'We will add a contact from as soon as possible', 'سوف نضيف وسائل الاتصال في اقرب وقت ممكن', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(87, 'ar', 'Enter Your Mail!', 'اسم الذي تريده', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(88, 'ar', 'Published in', 'نشر في', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(89, 'ar', 'Date', 'تاريخ', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(90, 'ar', 'The address you have chosen is already in use. Please choose a different one.', 'الاسم الذي اذخلته مستعمل من قبل , الرجاء استخدم عنوان مختلف', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(91, 'ar', 'Your Name', 'الاسم الكامل', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(92, 'ar', 'Your Email', 'بريدك الالكتوني', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(93, 'ar', 'Your Phone', 'رقم الهاتف', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(94, 'ar', 'Your Message', 'الرسالة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(95, 'ar', 'Send Message', 'ارسل', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(96, 'ar', 'We have received your message and would like to thank you for writing to us.', 'لقد تلقينا رسالتك ونود أن نشكرك على مراسلتنا.', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(97, 'ar', 'Not Found', 'الصفحة غير موجودة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(98, 'ar', 'Page Not Found', 'الصفحة غير موجودة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(99, 'ar', 'We are sorry but the page you are looking for was not found', 'نحن آسفون ولكن الصفحة التي تبحث عنها لم يتم العثور عليها', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(100, 'ar', 'Back to Home', 'العودة إلى الرئسية', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(101, 'ar', 'Unauthorised', 'غير مصرح', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(102, 'ar', 'Forbidden', 'ممنوع الذخول الى هده الصفحة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(103, 'ar', 'Method Not Allowed', 'طريقة غير مسموحة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(104, 'ar', 'Something is broken. Please let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.', 'شيء ما مكسور. الرجاء إخبارنا بما كنت تفعله عندما حدث هذا الخطأ. ونحن سوف إصلاحه في أقرب وقت ممكن. اعتذر على أي ازعاج حدث.', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(105, 'ar', 'Page Expired', 'انتهت صلاحية الرابط', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(106, 'ar', 'Too Many Requests', 'طلبات كثيرة جدا', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(107, 'ar', 'Internal Server Error', 'خطأ في الخادم الداخلي', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(108, 'ar', 'Oops… You just found an error page', 'عفوًا ... لقد عثرت للتو على صفحة خطأ', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(109, 'ar', 'We are sorry but our server encountered an internal error', 'نحن آسفون ولكن خادمنا واجه خطأ داخلي', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(110, 'ar', 'Service Unavailable', 'الخدمة غير متوفرة', 'general', '2021-09-17 00:41:04', '2021-09-17 00:56:02'),
(111, 'en', 'Default Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(112, 'ar', 'Default Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(113, 'en', 'Default Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(114, 'ar', 'Default Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(115, 'en', 'Default keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(116, 'ar', 'Default keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(117, 'en', 'Home Page Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(118, 'ar', 'Home Page Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(119, 'en', 'Home Page Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(120, 'ar', 'Home Page Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(121, 'en', 'Home Page keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(122, 'ar', 'Home Page keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(123, 'en', 'Change Page Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(124, 'ar', 'Change Page Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(125, 'en', 'Change Page Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(126, 'ar', 'Change Page Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(127, 'en', 'Change Page keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(128, 'ar', 'Change Page keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(129, 'en', 'Blog Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(130, 'ar', 'Blog Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(131, 'en', 'Blog Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(132, 'ar', 'Blog Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(133, 'en', 'Blog keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(134, 'ar', 'Blog keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(135, 'en', 'Contact Page Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(136, 'ar', 'Contact Page Title', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(137, 'en', 'Contact Page Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(138, 'ar', 'Contact Page Description', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(139, 'en', 'Contact Page keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(140, 'ar', 'Contact Page keywords', NULL, 'seo', '2021-11-02 08:03:52', '2021-11-02 08:03:52'),
(141, 'en', 'Homepage Title', NULL, 'general', '2021-11-11 05:11:15', '2021-11-11 05:11:15'),
(142, 'ar', 'Homepage Title', NULL, 'general', '2021-11-11 05:11:15', '2021-11-11 05:11:15'),
(143, 'en', 'Click To Copy!', NULL, 'general', '2021-11-11 05:11:15', '2021-11-11 05:11:15'),
(144, 'ar', 'Click To Copy!', NULL, 'general', '2021-11-11 05:11:15', '2021-11-11 05:11:15'),
(145, 'en', 'Copied!', NULL, 'general', '2021-11-11 05:11:15', '2021-11-11 05:11:15'),
(146, 'ar', 'Copied!', NULL, 'general', '2021-11-11 05:11:15', '2021-11-11 05:11:15'),
(147, 'en', 'Human Verification', NULL, 'general', '2021-11-15 23:30:48', '2021-11-15 23:30:48'),
(148, 'ar', 'Human Verification', NULL, 'general', '2021-11-15 23:30:48', '2021-11-15 23:30:48'),
(149, 'en', 'Verify', NULL, 'general', '2021-11-15 23:30:48', '2021-11-15 23:30:48'),
(150, 'ar', 'Verify', NULL, 'general', '2021-11-15 23:30:48', '2021-11-15 23:30:48'),
(151, 'en', 'Your address created successfully.', NULL, 'general', '2021-11-17 14:46:24', '2021-11-17 14:46:24'),
(152, 'ar', 'Your address created successfully.', NULL, 'general', '2021-11-17 14:46:24', '2021-11-17 14:46:24'),
(153, 'en', 'Thanks for registration!', NULL, 'general', '2021-11-19 05:54:52', '2021-11-19 05:54:52'),
(154, 'ar', 'Thanks for registration!', NULL, 'general', '2021-11-19 05:54:52', '2021-11-19 05:54:52'),
(155, 'en', 'Some validation error occur.', NULL, 'general', '2021-11-19 05:58:44', '2021-11-19 05:58:44'),
(156, 'ar', 'Some validation error occur.', NULL, 'general', '2021-11-19 05:58:44', '2021-11-19 05:58:44'),
(157, 'en', 'Thanks for registration, Please check your mail and follow activation link to active your account.', NULL, 'general', '2021-11-19 11:41:11', '2021-11-19 11:41:11'),
(158, 'ar', 'Thanks for registration, Please check your mail and follow activation link to active your account.', NULL, 'general', '2021-11-19 11:41:11', '2021-11-19 11:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `trash_mails`
--

CREATE TABLE `trash_mails` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_in` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trash_mails`
--

INSERT INTO `trash_mails` (`id`, `email`, `user_id`, `delete_in`, `created_at`, `updated_at`) VALUES
(1, 'rsmnkwn859@localhost', NULL, '2021-11-11 09:26:35', '2021-11-11 08:09:50', '2021-11-11 09:26:35'),
(2, 'vaoxfrf769@localhost', NULL, '2021-11-11 09:26:39', '2021-11-11 09:26:36', '2021-11-11 09:26:39'),
(3, 'lxcebip600@localhost', NULL, '2021-11-11 09:54:52', '2021-11-11 09:26:40', '2021-11-11 09:54:52'),
(4, 'ryiktnw956@localhost', NULL, '2021-11-11 09:54:57', '2021-11-11 09:54:53', '2021-11-11 09:54:57'),
(5, 'mkjzmtq167@localhost', NULL, '2021-11-11 11:09:38', '2021-11-11 09:54:58', '2021-11-11 11:09:38'),
(6, 'yasha3651@localhost', NULL, '2021-11-16 11:09:38', '2021-11-11 11:09:39', '2021-11-11 11:09:39'),
(7, 'aucmsla904@localhost', NULL, '2021-11-17 11:32:00', '2021-11-12 11:32:00', '2021-11-12 11:32:00'),
(8, 'zjrvccq138@localhost', NULL, '2021-11-17 22:51:03', '2021-11-12 22:51:03', '2021-11-12 22:51:03'),
(9, 'gkucfld779@localhost', NULL, '2021-11-17 22:51:13', '2021-11-12 22:51:13', '2021-11-12 22:51:13'),
(10, 'hhkadfc809@localhost', NULL, '2021-11-18 05:15:55', '2021-11-13 05:15:55', '2021-11-13 05:15:55'),
(11, 'xppeghy107@localhost', NULL, '2021-11-19 23:24:38', '2021-11-14 23:24:38', '2021-11-14 23:24:38'),
(12, 'kbzgodp978@localhost', NULL, '2021-11-19 23:37:58', '2021-11-14 23:37:58', '2021-11-14 23:37:58'),
(13, 'ayssjec609@localhost', NULL, '2021-11-20 00:54:50', '2021-11-15 00:54:50', '2021-11-15 00:54:50'),
(14, 'jfojwtu957@localhost', NULL, '2021-11-20 01:21:14', '2021-11-15 01:21:14', '2021-11-15 01:21:14'),
(15, 'cpevemz348@localhost', NULL, '2021-11-20 02:09:07', '2021-11-15 02:09:07', '2021-11-15 02:09:07'),
(16, 'tzbegau198@localhost', NULL, '2021-11-20 02:18:59', '2021-11-15 02:18:59', '2021-11-15 02:18:59'),
(17, 'otoypnu581@localhost', NULL, '2021-11-20 02:24:55', '2021-11-15 02:24:55', '2021-11-15 02:24:55'),
(18, 'cghkquo170@mail-analyzer.com', NULL, '2021-11-20 04:36:03', '2021-11-15 04:36:03', '2021-11-15 04:36:03'),
(19, 'tctffmq984@mail-analyzer.com', NULL, '2021-11-20 05:56:48', '2021-11-15 05:56:48', '2021-11-15 05:56:48'),
(20, 'kywvrun897@mail-analyzer.com', NULL, '2021-11-15 06:31:41', '2021-11-15 06:03:52', '2021-11-15 06:31:41'),
(21, 'vgrxhob987@mail-analyzer.com', NULL, '2021-11-20 06:31:43', '2021-11-15 06:31:43', '2021-11-15 06:31:43'),
(22, 'rvnfhsx990@mail-analyzer.com', NULL, '2021-11-20 06:31:46', '2021-11-15 06:31:46', '2021-11-15 06:31:46'),
(23, 'xezcvur738@mail-analyzer.com', NULL, '2021-11-20 06:31:56', '2021-11-15 06:31:56', '2021-11-15 06:31:56'),
(24, 'irguuui919@mail-analyzer.com', NULL, '2021-11-20 06:32:01', '2021-11-15 06:32:01', '2021-11-15 06:32:01'),
(25, 'szxcfqg941@mail-analyzer.com', NULL, '2021-11-20 06:32:04', '2021-11-15 06:32:04', '2021-11-15 06:32:04'),
(26, 'mhqbuwq888@mail-analyzer.com', NULL, '2021-11-20 06:32:15', '2021-11-15 06:32:15', '2021-11-15 06:32:15'),
(27, 'btabgmk788@mail-analyzer.com', NULL, '2021-11-20 06:32:17', '2021-11-15 06:32:17', '2021-11-15 06:32:17'),
(28, 'sirawum749@mail-analyzer.com', NULL, '2021-11-20 06:40:05', '2021-11-15 06:40:05', '2021-11-15 06:40:05'),
(29, 'syxcugz498@mail-analyzer.com', NULL, '2021-11-15 11:31:50', '2021-11-15 06:49:08', '2021-11-15 11:31:50'),
(30, 'sburokh599@mail-analyzer.com', NULL, '2021-11-20 08:21:23', '2021-11-15 08:21:23', '2021-11-15 08:21:23'),
(31, 'ughndqf414@mail-analyzer.com', NULL, '2021-11-20 09:23:28', '2021-11-15 09:23:28', '2021-11-15 09:23:28'),
(32, 'tona@mail-analyzer.com', '2', '2021-11-15 13:57:24', '2021-11-15 11:31:50', '2021-11-15 13:57:24'),
(33, 'ohyxxmn907@mail-analyzer.com', NULL, '2021-11-20 13:57:26', '2021-11-15 13:57:27', '2021-11-15 13:57:27'),
(34, 'tvowahr955@mail-analyzer.com', NULL, '2021-11-21 00:25:26', '2021-11-16 00:25:26', '2021-11-16 00:25:26'),
(35, 'dlrzhib416@mail-analyzer.com', NULL, '2021-11-21 09:00:34', '2021-11-16 09:00:35', '2021-11-16 09:00:35'),
(36, 'gxvxjzt431@mail-analyzer.com', NULL, '2021-11-21 16:49:59', '2021-11-16 16:50:02', '2021-11-16 16:50:02'),
(37, 'eevtvjf506@mail-analyzer.com', NULL, '2021-11-21 22:35:36', '2021-11-16 22:35:36', '2021-11-16 22:35:36'),
(38, 'qyvlqoe405@mail-analyzer.com', NULL, '2021-11-22 04:30:51', '2021-11-17 04:30:51', '2021-11-17 04:30:51'),
(39, 'mvizmsu081@mail-analyzer.com', NULL, '2021-11-22 08:35:57', '2021-11-17 08:35:58', '2021-11-17 08:35:58'),
(40, 'adktwsp314@mail-analyzer.com', NULL, '2021-11-22 08:36:01', '2021-11-17 08:36:02', '2021-11-17 08:36:02'),
(41, 'lsfqpfa688@mail-analyzer.com', NULL, '2021-11-22 12:34:58', '2021-11-17 12:34:58', '2021-11-17 12:34:58'),
(42, 'myoayun986@mail-analyzer.com', NULL, '2021-11-22 15:25:25', '2021-11-17 15:25:25', '2021-11-17 15:25:25'),
(43, 'fvmwycz434@mail-analyzer.com', NULL, '2021-11-22 18:38:23', '2021-11-17 18:38:25', '2021-11-17 18:38:25'),
(44, 'vfrjscl403@mail-analyzer.com', NULL, '2021-11-23 07:19:48', '2021-11-18 07:19:48', '2021-11-18 07:19:48'),
(45, 'etuhnix840@mail-analyzer.com', NULL, '2021-11-23 08:30:41', '2021-11-18 08:30:41', '2021-11-18 08:30:41'),
(46, 'jyiulxf798@mail-analyzer.com', NULL, '2021-11-24 00:31:46', '2021-11-19 00:31:47', '2021-11-19 00:31:47'),
(47, 'yakov.757@mail-analyzer.com', '3', NULL, '2021-11-19 05:54:52', '2021-11-19 05:54:52'),
(49, 'abfyjqt916@mail-analyzer.com', NULL, '2021-11-24 07:23:07', '2021-11-19 07:23:08', '2021-11-19 07:23:08'),
(51, 'giusrqw665@mail-analyzer.com', NULL, '2021-11-20 01:56:51', '2021-11-19 12:27:07', '2021-11-20 01:56:51'),
(52, 'mvqmluq551@mail-analyzer.com', NULL, '2021-11-24 16:21:00', '2021-11-19 16:21:00', '2021-11-19 16:21:00'),
(53, 'ihmzylu300@mail-analyzer.com', NULL, '2021-11-24 16:35:08', '2021-11-19 16:35:08', '2021-11-19 16:35:08'),
(54, 'rifeflr011@mail-analyzer.com', NULL, '2021-11-24 18:55:54', '2021-11-19 18:55:55', '2021-11-19 18:55:55'),
(55, 'kytxrrk075@mail-analyzer.com', NULL, '2021-11-24 23:13:17', '2021-11-19 23:13:20', '2021-11-19 23:13:20'),
(56, 'suovqsg948@mail-analyzer.com', NULL, '2021-11-24 23:14:28', '2021-11-19 23:14:29', '2021-11-19 23:14:29'),
(57, 'szyjccc178@mail-analyzer.com', NULL, '2021-11-25 01:04:05', '2021-11-20 01:04:05', '2021-11-20 01:04:05'),
(58, 'gvhdcmq055@mail-analyzer.com', NULL, '2021-11-25 08:15:11', '2021-11-20 08:15:12', '2021-11-20 08:15:12'),
(59, 'rbdvnqm457@mail-analyzer.com', NULL, '2021-11-25 22:06:46', '2021-11-20 22:06:47', '2021-11-20 22:06:47'),
(60, 'prvvxfz954@mail-analyzer.com', NULL, '2021-11-26 03:18:09', '2021-11-21 03:18:10', '2021-11-21 03:18:10'),
(61, 'imulpso367@mail-analyzer.com', NULL, '2021-11-27 03:40:03', '2021-11-22 03:40:03', '2021-11-22 03:40:03'),
(62, 'esnhtza003@mail-analyzer.com', NULL, NULL, '2021-11-22 04:27:10', '2021-11-22 04:27:10'),
(63, 'fqireeh613@mail-analyzer.com', NULL, NULL, '2021-11-22 15:53:01', '2021-11-22 15:53:01'),
(64, 'svhtcxs643@mail-analyzer.com', NULL, NULL, '2021-11-22 15:53:03', '2021-11-22 15:53:03'),
(65, 'dqauvhq440@mail-analyzer.com', NULL, NULL, '2021-11-22 15:53:21', '2021-11-22 15:53:21'),
(66, 'dncetaf087@mail-analyzer.com', NULL, NULL, '2021-11-22 16:59:04', '2021-11-22 16:59:04'),
(67, 'aovolae511@mail-analyzer.com', NULL, NULL, '2021-11-22 17:11:19', '2021-11-22 17:11:19'),
(68, 'kcuuvth716@mail-analyzer.com', NULL, '2021-11-22 17:12:36', '2021-11-22 17:12:06', '2021-11-22 17:12:36'),
(69, 'jtfddcf557@mail-analyzer.com', NULL, NULL, '2021-11-22 17:12:37', '2021-11-22 17:12:37'),
(70, 'vxlxdnt868@mail-analyzer.com', NULL, NULL, '2021-11-22 23:04:12', '2021-11-22 23:04:12'),
(71, 'znpqcrz313@mail-analyzer.com', NULL, NULL, '2021-11-23 01:00:07', '2021-11-23 01:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avater` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avater`, `remember_token`, `mode`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'tona@test.com', NULL, '$2y$10$zDng43jKGGm/cDETTgSASOHVkVl40IyUw4RvsdUIVK0PeKcXp8OXe', 'admin', 'uploads/avatar-place.png', '8F0uqmBVfbi1CRlpyn5ocOttHoHsDfCGwtZPYnD1cFDw3a8CLEtJB190d3Kt', 'inactive', '2021-11-11 05:10:43', '2021-11-11 05:10:43'),
(2, 'user', 'tona@mail-analyzer.com', NULL, '$2y$10$zDng43jKGGm/cDETTgSASOHVkVl40IyUw4RvsdUIVK0PeKcXp8OXe', 'user', 'uploads/avatar-place.png', 'Vsp8nfDkUeGdwCh7vabLIAGJ0Yyr1Q2QWyUqqgEJVB0m79Ic6HsMuG9s8j2m', 'inactive', NULL, NULL),
(3, 'yakov', 'yasha3651@mail.ru', NULL, '$2y$10$qMuwA0LFLAopq5Egf7srgOwGx82v1TebvDoqggXuBfBEn.lOvj5zu', 'user', NULL, 'fGII6m3G0UGyI2N0C5fAvD7aoacwwrWCTQeiAwdWPToN33iEwZfUvOq7obnP', 'inactive', '2021-11-19 05:54:52', '2021-11-19 05:54:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configures`
--
ALTER TABLE `configures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_forugn_key` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_forign_key` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translates`
--
ALTER TABLE `translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash_mails`
--
ALTER TABLE `trash_mails`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `configures`
--
ALTER TABLE `configures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `translates`
--
ALTER TABLE `translates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `trash_mails`
--
ALTER TABLE `trash_mails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `configures`
--
ALTER TABLE `configures`
  ADD CONSTRAINT `userid_forugn_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `userid_forign_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

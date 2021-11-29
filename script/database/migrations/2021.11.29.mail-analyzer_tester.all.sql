-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2021 at 09:46 AM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.26

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
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` int(10) UNSIGNED NOT NULL,
  `charge_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL,
  `email_id` int(10) UNSIGNED NOT NULL,
  `price_type` int(10) UNSIGNED NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `qty` float UNSIGNED NOT NULL,
  `supply` int(10) UNSIGNED NOT NULL,
  `used` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ending_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `charge_date`, `user_id`, `email_id`, `price_type`, `price`, `qty`, `supply`, `used`, `ending_date`, `created_at`, `updated_at`) VALUES
(1, '2021-11-25 16:37:47', 3, 47, 500, 50, 1, 500, 0, NULL, '2021-11-25 15:37:47', '2021-11-25 14:37:47'),
(2, '2021-11-25 16:53:23', 3, 47, 500, 50, 1, 500, 0, NULL, '2021-11-25 15:53:23', '2021-11-25 14:53:23'),
(3, '2021-11-25 16:54:11', 3, 47, 500, 50, 1, 500, 0, NULL, '2021-11-25 15:54:11', '2021-11-25 14:54:11'),
(4, '2021-11-25 17:49:01', 3, 47, 1000, 80, 1, 1000, 0, NULL, '2021-11-25 16:49:01', '2021-11-25 15:49:01'),
(5, '2021-11-25 18:10:45', 7, 86, 500, 50, 1, 500, 0, NULL, '2021-11-25 17:10:45', '2021-11-25 16:10:45');

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
(1, 2, NULL, 'yakovich', 'zakharov', 'dev', NULL, 'Krasnodar, Russia', NULL, 'Gorod Krasnodar', NULL, 'Russia', 'Krasnodar Krai', 1, '2021-11-17 15:46:24', '2021-11-17 14:47:30'),
(2, 3, NULL, 'yakov', 'zakharov', 'dev', NULL, 'sss', NULL, 'Gorod Krasnodar', NULL, NULL, NULL, 1, '2021-11-23 09:31:30', '2021-11-23 08:31:37'),
(3, 7, NULL, 'Samir', 'Chakouri', NULL, NULL, 'Calle Mora Encantada, 39', '16400', 'Tarancón', NULL, 'Espagne', 'Cuenca', 1, '2021-11-25 17:09:51', '2021-11-25 16:09:54');

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
(38, 'total_emails_created', '95', NULL, '2021-11-29 04:42:13'),
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
(1, 6, 2, 'tona@mail-analyzer.com', 'user', '2021-11-17 07:46:48', '2021-11-20 03:48:32', 'Action Required: Confirm your email', 'Return-Path: <pm_bounces@pmbounces.postmarkapp.com>\r\nX-Original-To: tona@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from mta202a-ord.mtasv.net (mta202a-ord.mtasv.net [104.245.209.202])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id DB72D20C44\r\n	for <tona@mail-analyzer.com>; Wed, 17 Nov 2021 08:46:52 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=REJECT sp=NONE) smtp.from=pmbounces.postmarkapp.com header.from=postmarkapp.com;\r\n	dkim=pass header.d=pm.mtasv.net;\r\n	dkim=pass header.d=postmarkapp.com;\r\n        spf=pass (sender IP is 104.245.209.202) smtp.mailfrom=pm_bounces@pmbounces.postmarkapp.com smtp.helo=mta202a-ord.mtasv.net\r\nReceived-SPF: pass (obistar.com: domain of pmbounces.postmarkapp.com designates 104.245.209.202 as permitted sender) client-ip=104.245.209.202; envelope-from=pm_bounces@pmbounces.postmarkapp.com; helo=mta202a-ord.mtasv.net;\r\nDKIM-Signature: v=1; a=rsa-sha1; c=relaxed/relaxed; s=pm; d=pm.mtasv.net;\r\n h=From:Date:Subject:Message-Id:To:MIME-Version:Content-Type;\r\n bh=aYN8XNXjk/hpAbI129MeKOYSwEw=;\r\n b=yJru+u64p71RUZPSy4o8ZTu8f3Y1b6cPA/D+Rm982FrjOXKTwUglfZ6FrQeYb5FkP7kyjKUJIa9h\r\n   9DxntMgHCfrquOXkZxkBYWKSnR1boQGgR/7FERQY0mAvMyagphXHAJdh3GScgCIFVnZ0VIkofgiJ\r\n   ZCq6SsWtjj7mJtNlmYg=\r\nReceived: by mta202a-ord.mtasv.net id hiipmq27tk4c for <tona@mail-analyzer.com>; Wed, 17 Nov 2021 02:46:51 -0500 (envelope-from <pm_bounces@pmbounces.postmarkapp.com>)\r\nX-PM-IP: 104.245.209.202\r\nX-IADB-IP: 104.245.209.202\r\nX-IADB-IP-REVERSE: 202.209.245.104\r\nDKIM-Signature: v=1; a=rsa-sha256; d=postmarkapp.com; s=20131124034823.pm;\r\n	c=relaxed/relaxed; i=support@postmarkapp.com; t=1637135211;\r\n	h=cc:content-transfer-encoding:content-type:date:from:in-reply-to:\r\n	list-archive:list-help:list-id:list-owner:list-post:list-subscribe:\r\n	list-unsubscribe:mime-version:message-id:references:reply-to:resent-cc:\r\n	resent-date:resent-from:resent-message-id:resent-sender:resent-to:sender:\r\n	subject:to:feedback-id;\r\n	bh=5tlNiu55cxT96ijI3ovQY8HR9zsjd1+CiMfDCuc9jjw=;\r\n	b=YeV78KH9qYbYaqGZ4ClqSgf0obTXohk3S8/D5RmTboas7C49XpQV3IoL9K5BCOjrwTC7sTyn5lH\r\n	RXNr4C1zYuyZguLKNI0nhA1Z2B4j8myKRF1IHjlyaoZNZs5Fbw3zqeXfW6BkgLMxhxhcWhQQrFsaX\r\n	2DcdhQ01zUKl5dRkcww=\r\nFrom: Postmark Support <support@postmarkapp.com>\r\nDate: Wed, 17 Nov 2021 07:46:48 +0000\r\nSubject: Action Required: Confirm your email\r\nMessage-Id: <53a0ab81-2b43-4608-9d7f-fe2b5e8764d7@mtasv.net>\r\nTo: tona@mail-analyzer.com\r\nFeedback-ID: s40483-c2lnbnVw:s40483:a50355:postmark\r\nX-Complaints-To: abuse@postmarkapp.com\r\nX-PM-Message-Id: 53a0ab81-2b43-4608-9d7f-fe2b5e8764d7\r\nX-PM-Tag: signup\r\nX-PM-RCPT: |bTB8NTAzNTV8NDA0ODN8dG9uYUBtYWlsLWFuYWx5emVyLmNvbQ==|\r\nX-PM-Message-Options: v1;9Hcc_PIAriBnYBOfaIwCcyIPcaJJ4QcTBG0Vjf0upsKfpR9qOJtFHrXwPywaBTAW0yivONdmCE8g_Gy1UcqUBBDOwW7mU_BYoMQKRhXnXR0\r\nMIME-Version: 1.0\r\nContent-Type: multipart/alternative;\r\n	boundary=mk3-49b3c71cfcf0487aada28f18d4565a2b; charset=UTF-8\r\n\r\n', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head>\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\r\n    <meta name=\"x-apple-disable-message-reformatting\" />\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n    <meta name=\"color-scheme\" content=\"light dark\" />\r\n    <meta name=\"supported-color-schemes\" content=\"light dark\" />\r\n    <title>Postmark</title>\r\n\r\n    <style type=\"text/css\" rel=\"stylesheet\" media=\"all\">@media screen and (max-width: 599px) {pre{width:230px;}}@media screen and (max-width: 599px) {.email-top_inner{width:100%;}}@media (prefers-color-scheme: dark) {.email-body_inner--other-things,.email-body_inner--other-things .content-block{background-color:#FFDE00 !important;}}@media screen and (max-width: 599px) {.email-body_inner,.email-footer{width:100%;}}@media only screen and (max-width: 500px) {.btn{width:100% !important;}}@media screen and (max-width: 599px) {.hero{padding:40px 30px 0  !important;}}@media screen and (max-width: 599px) {.welcome{padding:30px 30px 10px  !important;}}@media screen and (max-width: 599px) {.signature{padding:0 30px  !important;}.signature_author,.signature_action{width:100%;height:auto;}.signature_action{text-align:center;}.signature_action td{padding-top:10px;padding-bottom:25px;text-align:center;}.postmark .signature--logo .signature_action td{padding-top:10px;}}@media screen and (max-width: 599px) {.content-block{padding:30px !important;}.content-block--image{padding-top:0 !important;padding-bottom:0 !important;}.content-block_image-container{text-align:center;}.content-block_image-container,.content-block_body-container{width:100%;}.content-block--small .content-block_title{margin-top:15px !important;}}@media screen and (max-width: 599px) {.divider{padding:20px 30px  !important;}.divider_image--desktop{display:none;}.divider_image--mobile{display:block !important;height:auto !important;max-height:none !important;font-size:15px !important;}.divider--thick{padding:20px 0  !important;}.divider--no-padding{padding-top:0 !important;padding-bottom:0 !important;}.divider--no-pad-bottom{padding-bottom:0 !important;}}@media screen and (max-width: 599px) {.testimonial{padding:20px 30px  !important;}.testimonial_container{width:100%;}}@media screen and (max-width: 599px) {.cta-banner{padding:30px !important;}.cta-banner_title,.cta-banner_sub-title{text-align:center !important;}.cta-banner_body,.cta-banner_action{width:100%;}.cta-banner_action,.cta-banner_action td{text-align:center !important;}.cta-banner--centered .cta-banner_action td{text-align:center;}}@media screen and (max-width: 599px) {.footer{padding:0 30px  !important;}.footer_table{width:100%;}.footer--slim{padding:15px 30px  !important;}}@media screen and (max-width: 599px) {.product-ad{float:none !important;width:100%;margin-bottom:30px;}.product-ad_container{width:220px;}}@media screen and (max-width: 599px) {.email-prefs{padding:12px 30px  !important;}}@media screen and (max-width: 599px) {.follow-banner{padding:25px 30px  !important;}.follow-banner_logo,.follow-banner_links{width:100%;text-align:center !important;}.follow-banner_logo{margin-bottom:20px;}.follow-banner_logo td{text-align:center !important;}.follow-banner_links td{text-align:center !important;}.follow-banner_links span{display:block;}}@media screen and (max-width: 599px) {.post{padding:15px 30px  !important;}}@media screen and (max-width: 599px) {.share{padding:20px 30px  !important;}}@media (prefers-color-scheme: dark) {body{background-color:#111 !important;}.pm-snippet{background-color:#111 !important;border-color:#333 !important;color:#E6E6E6 !important;}.pm-key,.pm-domain{color:#E6E6E6 !important;}.spacer{background-color:#222 !important;color:transparent !important;}.email-wrapper{background-color:#111 !important;}.btn{color:#E6E6E6 !important;}.btn:visited{color:#E6E6E6 !important;}h1{color:#E6E6E6 !important;}h2{color:#E6E6E6 !important;}h3{color:#E6E6E6 !important;}p{color:#E6E6E6 !important;}ul{color:#E6E6E6 !important;}ol{color:#E6E6E6 !important;}li{color:#E6E6E6 !important;}.content-block{color:#E6E6E6 !important;}.welcome,.content-block{background-color:#222 !important;}.divider_line{border-color:#333 !important;}.divider{background-color:#222 !important;}.purchase{border-color:#333 !important;}.purchase td{border-color:#333 !important;}.cta-banner--dmarcdigests{border-top-color:#333 !important;}.cta-banner{background-color:#222 !important;}.footer{background-color:#222 !important;}.footer--outer{background-color:#111 !important;}.footer--slim p{color:#666 !important;}.footer--slim a{color:#666 !important;}.footer--slim a:visited{color:#666 !important;}.follow-banner{filter:brightness(0.9) !important;}.header--filled{filter:brightness(0.9) !important;}.header--digest{border-bottom-color:#333 !important;background-color:#222 !important;}.header--digest .header_logo img{filter:invert(1) !important;}.panel--warning{border-color:#847450 !important;background:#34311A !important;}.panel--error{border-color:#483737 !important;background-color:#2E2222 !important;}.panel--success{border-color:#3D5332 !important;background-color:#2D302C !important;}.panel--info{border-color:#2C3D46 !important;background-color:#131D23 !important;}.panel_title{color:#E6E6E6 !important;}.hero{filter:brightness(0.9) !important;}}a:visited{color:#007BC8 !important;text-decoration:underline !important;}a:visited img{border:none !important;}.email-body_inner--other-things .content-block_body a:visited{color:#005E99 !important;}.btn:visited{box-sizing:border-box !important;border-top:10px solid #007BC8 !important;border-right:18px solid #007BC8 !important;border-bottom:10px solid #007BC8 !important;border-left:18px solid #007BC8 !important;background-color:#007BC8 !important;font-size:14px !important;display:inline-block !important;height:auto !important;border-radius:3px !important;color:#FFF !important;text-align:center !important;text-decoration:none !important;-webkit-text-size-adjust:none !important;font-weight:bold !important;padding:5px 10px !important;}.btn--ghost:visited{border-top:10px solid #E6F2FA !important;border-right:18px solid #E6F2FA !important;border-bottom:10px solid #E6F2FA !important;border-left:18px solid #E6F2FA !important;background-color:#E6F2FA !important;font-size:14px !important;display:inline-block !important;height:auto !important;border-radius:3px !important;color:#007BC8 !important;text-align:center !important;text-decoration:none !important;-webkit-text-size-adjust:none !important;}.testimonial_name a:visited{color:#333 !important;}.testimonial_position a:visited{color:#777 !important;}.footer--slim a:visited{color:rgba(255,255,255,0.5) !important;}.footer--outer a:visited{color:#A9A696 !important;}.product-ad_link:visited{text-decoration:none !important;}.email-prefs a:visited{color:#777 !important;}.postmark .follow-banner a:visited{color:#333 !important;}.post_title a:visited{color:#333 !important;}:root{color-scheme:light dark !important;supported-color-schemes:light dark !important;}</style>\r\n    <!--[if mso]>\r\n    <style type=\"text/css\">\r\n      .email-wrapper {\r\n        font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif !important;\r\n      }\r\n      p,\r\n      ul,\r\n      ol,\r\n      li,\r\n      blockquote {\r\n        line-height: 1.5 !important;\r\n      }\r\n    </style>\r\n    <![endif]-->\r\n</head>\r\n\r\n<body class=\"postmark\" style=\"height: 100%; margin: 0; background-color: #EEECE4; color: #333; line-height: 1.6; -webkit-text-size-adjust: none; width: 100% !important;\">\r\n  <table class=\"email-wrapper\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; width: 100%; margin: 0; padding: 0; background-color: #F5F3EB;\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\" align=\"center\">\r\n        <table class=\"email-content\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; width: 100%; margin: 0; padding: 0;\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td class=\"email-top\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 10px 0;\" width=\"100%\" cellpadding=\"5\" cellspacing=\"0\">\r\n              <table class=\"email-top_inner\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;\" align=\"center\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td class=\"email-top_content\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; text-align: center; font-size: 12px; color: #A9A696;\"></td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n\r\n          <tr>\r\n            <td class=\"email-body\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n              <table class=\"email-body_inner\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFF;\" align=\"center\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 50px; background-color: #FFF;\">\r\n                    <h1 class=\"content-block_title\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 0; color: #333; font-weight: bold; font-size: 21px; text-align: left; margin: 0 0 15px;\">Hi yakov zakharov &#128075;</h1>\r\n                    <div class=\"content-block_body\">\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #333; font-size: 15px;\">Welcome to Postmark, new friend! Your username to log in is <strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">yasha3651</strong>.</p>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #333; font-size: 15px;\">To get your account ready for sending, we&#8217;ve created a Sender Signature for <strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">tona@mail-analyzer.com</strong>. We&#8217;ll use that email address as the &#8220;From&#8221; address on the emails you send. But before we can do that, we need you to confirm that this email belongs to you:</p>\r\n  \r\n                      <div style=\"margin-bottom: 25px;\">\r\n                        <a target=\"blank\" class=\"btn\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #FFF; text-decoration: none; box-sizing: border-box; border-top: 10px solid #007BC8; border-right: 18px solid #007BC8; border-bottom: 10px solid #007BC8; border-left: 18px solid #007BC8; background-color: #007BC8; font-size: 14px; display: inline-block; height: auto; border-radius: 3px; text-align: center; -webkit-text-size-adjust: none; font-weight: bold; padding: 5px 10px;\" href=\"https://api.postmarkapp.com/signatures/confirm?token=1ba95d07-a254-4585-bfa1-dea4b618c3df\">Confirm Sender Signature</a>\r\n                      </div>\r\n  \r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 0 !important; color: #333; font-size: 15px;\"><strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">Want to use another &#8220;From&#8221; name and address to send emails?</strong> No problem! <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #007BC8; text-decoration: underline;\" href=\"https://account.postmarkapp.com/signature_domains\" target=\"_blank\">Add and verify other Sender Signatures</a> (or remove ones you no longer need) at any time in the app.</p>\r\n                    </div>\r\n                  </td>\r\n                </tr>\r\n                </tbody></table>\r\n\r\n                <table class=\"email-body_inner email-body_inner--other-things\" style=\"border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFDE00; color: #272727 !important;\" align=\"center\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 50px; background-color: #FFDE00; padding-bottom: 0;\">\r\n                    <h1 class=\"content-block_title\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 0; color: #272727 !important; font-weight: bold; font-size: 21px; text-align: left; margin: 0 0 15px;\">Other things to know</h1>\r\n                    <div class=\"content-block_body\">\r\n                      <h2 style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 1.333em; color: #272727 !important; font-weight: bold; font-size: 18px; text-align: left; margin-bottom: 0.666em;\">\r\n                        <img class=\"content-block_subtitle-icon\" style=\"margin-right: 2px; margin-bottom: -2px;\" src=\"https://assets.wildbit.com/postmark/emails/images/icon-test-mode@2x.png\" alt width=\"18\" height=\"18\" />\r\n                        Test mode and requesting account approval\r\n                      </h2>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #272727 !important; font-size: 15px;\">Your account is currently in test mode. That allows you to get familiar with Postmark, and <strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif\">send up to 100 emails to domains that you&#8217;ve verified.</strong> Once you&#8217;re ready to send emails to others, we&#8217;ll need to approve your account. Why? Reviewing each account helps us tell the <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://postmarkapp.com/support/article/1082-what-types-of-messages-are-a-good-fit-for-postmark?utm_source=pm_onboarding&utm_medium=email&utm_campaign=2110_onboarding\" target=\"_blank\">responsible senders</a> (that&#8217;s you!) apart from the spammers (boo!), so we can maintain our stellar deliverability rates for all customers. So whenever you&#8217;re ready, <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://account.postmarkapp.com/account_approval/apply\" target=\"_blank\">submit an approval request</a>.</p>\r\n  \r\n                      <h2 style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; margin-top: 1.333em; color: #272727 !important; font-weight: bold; font-size: 18px; text-align: left; margin-bottom: 0.666em;\">\r\n                        <img class=\"content-block_subtitle-icon\" style=\"margin-right: 2px; margin-bottom: -2px;\" src=\"https://assets.wildbit.com/postmark/emails/images/icon-get-started@2x.png\" alt width=\"18\" height=\"18\" />\r\n                        Handy resources to help you get started\r\n                      </h2>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 25px; color: #272727 !important; font-size: 15px;\">Check out our easy-to-follow <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://postmarkapp.com/manual?utm_source=pm_onboarding&utm_medium=email&utm_campaign=2110_onboarding\">getting started guides</a> and detailed <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://postmarkapp.com/developer?utm_source=pm_onboarding&utm_medium=email&utm_campaign=2110_onboarding\">developer docs</a> to get set up in Postmark. Still need help? Our Customer Success team is <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://twitter.com/nckrtl/status/1377714048364597250\">pretty</a> <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://twitter.com/garrettdimon/status/1390489002801782786\">darn</a> <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #005E99; text-decoration: underline;\" href=\"https://twitter.com/dixpac/status/1390587202191699970\">great</a>, so just reply to this message if you have any questions.</p>\r\n                      <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: left; margin-top: 0; margin-bottom: 0 !important; color: #272727 !important; font-size: 15px;\">Happy sending,<br />The Postmark Team</p>\r\n                    </div>\r\n\r\n                    <div class=\"content-block_img-bleed-btm\" style=\"margin-top: 50px; text-align: center;\">\r\n                      <img style=\"vertical-align: middle\" src=\"https://assets.wildbit.com/postmark/emails/images/signup-machine@2x.png\" alt width=\"461.5\" height=\"243\" />\r\n                    </div>\r\n                  </td>\r\n                </tr>\r\n\r\n                <tr>\r\n                  <td class=\"footer footer--slim\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 10px 50px; background-color: #353942; color: #FFF; border-top: 0;\">\r\n                    <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: center; margin-top: 0; margin-bottom: 25px; color: #353942; font-size: 14px; margin: 0;\">&#128140; <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: rgba(255,255,255,0.5); text-decoration: underline;\" href=\"https://postmarkapp.com/newsletter\">Subscribe to the Postmark newsletter</a></p>\r\n                  </td>\r\n                </tr>\r\n\r\n                <tr class=\"footer footer--outer\" style=\"padding: 0 50px; background-color: #F5F3EB; color: #FFF;\">\r\n                  <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; padding: 25px 0;\">\r\n                    <p style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; line-height: 24px; text-align: center; margin-top: 0; margin-bottom: 25px; color: #A9A696; font-size: 14px; margin: 0;\">\r\n                      <a target=\"blank\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; color: #A9A696; text-decoration: underline;\" href=\"https://wildbit.com\" target=\"_blank\">Wildbit LLC</a>, 12 Penns Trail, #521, Newtown, PA 18940\r\n                    </p>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n  </tbody></table>\r\n\r\n\r\n<img src=\"https://ea.pstmrk.it/open/v3_F97CG1hArHZE6hxITpujNSN8UnLCGAVzT-8I2NviCR2OGuy-G_ERz5QF80r9VmeCuCXnVPzxuBiRUmEkvjaJAZPTKEFA6q3cb5q0YbsBeWn9dWOYklThSbAP9p4KxeLd10BPIWXbxgKGYU5SXpVasuGLPtx6t2k1ghbC6cbNY7zXIiHflEZs0asGagTVkWYzyBbw5OJ3ShWNnAUnj1W5DnzMVxFh_qikgzjg64qLMg7ZMl7nZfn5XwYsQlcNZB3CMvtpu4jeSXWIUiN8HIcFeJhuBIWRep2b1SlHzcm-mqY76-arcpsMLjQIgSmS82pnMAeKypdO_U9IX9uzvyMVzcl1SBB0LKyz1V4p-3pHpIAQG64SotxaoXEUe025RRKelRDfO3GvCCsvMKi-DdK4c4Nrs8hh-HGPKRfsXebqlPsra7JXMvStjjKMuhAppFgu\" width=\"1\" height=\"1\" border=\"0\" alt=\"\" /></body></html>', 7.8, 'support@postmarkapp.com', '2021-11-20 03:48:32', '2021-11-20 03:49:37'),
(2, 8, 3, 'yasha3651@mail.ru', 'yakov', '2021-11-23 05:09:22', '2021-11-23 07:51:32', 'test', 'Return-Path: <yasha3651@mail.ru>\r\nX-Original-To: yakov.757@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from f394.i.mail.ru (f394.i.mail.ru [185.5.136.65])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id CAB772829D\r\n	for <yakov.757@mail-analyzer.com>; Tue, 23 Nov 2021 03:09:27 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=REJECT sp=NONE) smtp.from=mail.ru header.from=mail.ru;\r\n	dkim=pass header.d=mail.ru;\r\n	spf=pass (sender IP is 185.5.136.65) smtp.mailfrom=yasha3651@mail.ru smtp.helo=f394.i.mail.ru\r\nReceived-SPF: pass (obistar.com: domain of mail.ru designates 185.5.136.65 as permitted sender) client-ip=185.5.136.65; envelope-from=yasha3651@mail.ru; helo=f394.i.mail.ru;\r\nDKIM-Signature: v=1; a=rsa-sha256; q=dns/txt; c=relaxed/relaxed; d=mail.ru; s=mail3;\r\n	h=Content-Type:Message-ID:Reply-To:Date:MIME-Version:Subject:To:From:From:Subject:Content-Type:Content-Transfer-Encoding:To:Cc; bh=dJfjI3WoeLTmKSOxUjtG7C7P21Pazg7LHPQptaSTYoc=;\r\n	t=1637633367;x=1638238767; \r\n	b=Gta3z2f5ztiD4cN/WzB+kmTEbQ07fUvgA/iepwqxtCctD7is+fnMy+4e0ehXS6u2pZX886UUD+5PNKiqp6eGA6nIs8B7FeZCGW7onQy4Zgi4KWh1b3xcTxQJBlWbDnT5w9Kd1YT1eRHXoLM2GPsqFbRRa302UOPgdOE1+jKPsxU=;\r\nReceived: by f394.i.mail.ru with local (envelope-from <yasha3651@mail.ru>)\r\n	id 1mpLFK-0000sZ-J8\r\n	for yakov.757@mail-analyzer.com; Tue, 23 Nov 2021 05:09:22 +0300\r\nReceived: by e.mail.ru with HTTP;\r\n	Tue, 23 Nov 2021 05:09:22 +0300\r\nFrom: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nTo: yakov.757@mail-analyzer.com\r\nSubject: =?UTF-8?B?dGVzdA==?=\r\nMIME-Version: 1.0\r\nX-Mailer: Mail.Ru Mailer 1.0\r\nX-SenderField-Remind: 0\r\nDate: Tue, 23 Nov 2021 05:09:22 +0300\r\nReply-To: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nX-Priority: 3 (Normal)\r\nMessage-ID: <1637633362.850141349@f394.i.mail.ru>\r\nContent-Type: multipart/alternative;\r\n	boundary=\"--ALT--dC9936d4eE7859F5F44d687993aBc24A1637633362\"\r\nAuthentication-Results: f394.i.mail.ru; auth=pass smtp.auth=yasha3651@mail.ru smtp.mailfrom=yasha3651@mail.ru\r\nX-7564579A: 646B95376F6C166E\r\nX-77F55803: 119C1F4DF6A9251C05A3C7EA6B08405C0375A2FF5BBDBC24A1AB4C3C2FDAA1598FD872164937FA4C00E65715065EDDA598D9CC6B4B4AE69258FA3919E1DD33FC3E5FB1F14241D2AF\r\nX-7FA49CB5: 70AAF3C13DB7016878DA827A17800CE7C60D3416D3DEF95CC4224003CC8364768524C1701A65C63BBFD28B28ED4578739E625A9149C048EE33AC447995A7AD185644E22E05AA81AEB287FD4696A6DC2FA8DF7F3B2552694A4E2F5AFA99E116B42401471946AA11AF23F8577A6DFFEA7CFDE19FEC90BA7BD78F08D7030A58E5AD1A62830130A00468AEEEE3FBA3A834EE7353EFBB55337566C559E5F89E84DC55EB2F7110A1B780D480A9354A7AF2F2E21DF9E95F17B0083B26EA987F6312C9EC140C956E756FBB7AE5D25F19253116ADD2E47CDBA5A96583C09775C1D3CA48CFA7AC412AE061D850117882F4460429724CE54428C33FAD30A8DF7F3B2552694AC26CFBAC0749D213D2E47CDBA5A9658378DA827A17800CE7E4CD18687D5AE3809FA2833FD35BB23DF004C906525384302BEBFE083D3B9BA71A620F70A64A45A98AA50765F79006372E808ACE2090B5E1725E5C173C3A84C3C5EA940A35A165FF2DBA43225CD8A89FDD013041C98CC2ABCE5475246E174218B5C8C57E37DE458BEDA766A37F9254B7\r\nX-B7AD71C0: AC4F5C86D027EB782CDD5689AFBDA7A213B5FB47DCBC3458F0AFF96BAACF4158235E5A14AD4A4A4625E192CAD1D9E79DB5B3BAA7F7E03B129AF5765E803DAC40\r\nX-C1DE0DAB: 0D63561A33F958A59041218CC6148E0DA9745382F4CD4794EA8965492D67C37FBDC6A1CF3F042BAD6DF99611D93F60EF2E430E89EB05153F699F904B3F4130E343918A1A30D5E7FCCB5012B2E24CD356\r\nX-C8649E89: 4E36BF7865823D7055A7F0CF078B5EC49A30900B95165D340DAE5B306C240CF5227CBE0B1F84A449113B841BE9599DD1930581E29499B9F2836F3D3091B1EE991D7E09C32AA3244C849DBA35ADB739BA436DCF81323A1AEC3C6EB905E3A8056B3EB3F6AD6EA9203E\r\nX-D57D3AED: 3ZO7eAau8CL7WIMRKs4sN3D3tLDjz0dLbV79QFUyzQ2Ujvy7cMT6pYYqY16iZVKkSc3dCLJ7zSJH7+u4VD18S7Vl4ZUrpaVfd2+vE6kuoey4m4VkSEu530nj6fImhcD4MUrOEAnl0W826KZ9Q+tr5+wYjsrrSY/u8Y3PrTqANeitKFiSd6Yd7yPpbiiZ/d5BsxIjK0jGQgCHUM3Ry2Lt2G3MDkMauH3h0dBdQGj+BB/iPzQYh7XS329fgu+/vnDh6CMTU5LtRrRLL6uA73v3Xg==\r\nX-Mailru-MI: 1000000000800\r\nX-Mailru-Sender: 0D4E4D77B0FF454A23B8E0744517C34491D05CD3138B480AD3C0C531090EE1EDAFED83CB3AB7B9FC80683B1EBFD6753F3A9E8C5B347B8F7C14907A1F77082DCAFBCB772DDF65D6B00DCD7E18950BBC03BF0422C00CE68174851DE5097B8401C6C89D8AF824B716EB24DA7C73C6EBDA96E55ACCCBDAC3C8955FEEDEB644C299C0ED14614B50AE0675\r\nX-Mras: Ok\r\nX-Spam: undefined\r\n\r\n', '\n<HTML><BODY><div><a target=\"blank\" href=\"mailto:yakov.757@mail-analyzer.com\">yakov.757@mail-analyzer.com</a></div><div><a target=\"blank\" href=\"mailto:yakov.757@mail-analyzer.com\">yakov.757@mail-analyzer.com</a></div><div><a target=\"blank\" href=\"mailto:yakov.757@mail-analyzer.com\">yakov.757@mail-analyzer.com</a></div></BODY></HTML>\n', 2.8, 'yasha3651@mail.ru', '2021-11-23 07:51:32', '2021-11-23 06:51:32'),
(3, 20, 3, 'yasha3651@mail.ru', 'yakov', '2021-11-27 08:35:48', '2021-11-27 05:36:43', 'test email', 'Return-Path: <yasha3651@mail.ru>\r\nX-Original-To: yakov.757@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from f154.i.mail.ru (f154.i.mail.ru [128.140.171.57])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id 96B7328825\r\n	for <yakov.757@mail-analyzer.com>; Sat, 27 Nov 2021 06:35:52 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=REJECT sp=NONE) smtp.from=mail.ru header.from=mail.ru;\r\n	dkim=pass header.d=mail.ru;\r\n	spf=pass (sender IP is 128.140.171.57) smtp.mailfrom=yasha3651@mail.ru smtp.helo=f154.i.mail.ru\r\nReceived-SPF: pass (obistar.com: domain of mail.ru designates 128.140.171.57 as permitted sender) client-ip=128.140.171.57; envelope-from=yasha3651@mail.ru; helo=f154.i.mail.ru;\r\nDKIM-Signature: v=1; a=rsa-sha256; q=dns/txt; c=relaxed/relaxed; d=mail.ru; s=mail3;\r\n	h=Content-Type:Message-ID:Reply-To:Date:MIME-Version:Subject:To:From:From:Subject:Content-Type:Content-Transfer-Encoding:To:Cc; bh=kjox2g408zxVenq3aikJOt8kFvy6ZEdCWA6TqvO7vow=;\r\n	t=1637991352;x=1638596752; \r\n	b=TipS4cqbN8JX2e4UBAwN+oL2+j+8x2SRDtpmj0+aocgy9CR8265BK1Rv8tkor/7GBaq5bfh5y3mquc6NHm8lQqFvTYjfkpS98wVSUbGxUeqRnpZa3BJG2UZCGTOxJ2nyo7IQuOKQbzSsT0e8UYng6O1nurczIGKoVoTxZOqa9/Y=;\r\nReceived: by f154.i.mail.ru with local (envelope-from <yasha3651@mail.ru>)\r\n	id 1mqqNI-0004Tm-La\r\n	for yakov.757@mail-analyzer.com; Sat, 27 Nov 2021 08:35:48 +0300\r\nReceived: by e.mail.ru with HTTP;\r\n	Sat, 27 Nov 2021 08:35:48 +0300\r\nFrom: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nTo: yakov.757@mail-analyzer.com\r\nSubject: =?UTF-8?B?dGVzdCBlbWFpbA==?=\r\nMIME-Version: 1.0\r\nX-Mailer: Mail.Ru Mailer 1.0\r\nX-SenderField-Remind: 0\r\nDate: Sat, 27 Nov 2021 08:35:48 +0300\r\nReply-To: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nX-Priority: 3 (Normal)\r\nMessage-ID: <1637991348.573926808@f154.i.mail.ru>\r\nContent-Type: multipart/alternative;\r\n	boundary=\"--ALT--d19CdC9a27eDDb4A333F9358C6f6574E1637991348\"\r\nAuthentication-Results: f154.i.mail.ru; auth=pass smtp.auth=yasha3651@mail.ru smtp.mailfrom=yasha3651@mail.ru\r\nX-7564579A: 646B95376F6C166E\r\nX-77F55803: 119C1F4DF6A9251C05A3C7EA6B08405C538E2626E658EC13EFBCEABB4FCD923A8FD872164937FA4CBAEA11EFF5C7BF825F1CD1EFD79401B00AB81ED916E7928798CF071AD03FCBC2\r\nX-7FA49CB5: 70AAF3C13DB7016878DA827A17800CE79BA693B922156D19D82A6BABE6F325AC08BE7437D75B48FABCF491FFA38154B613377AFFFEAFD269176DF2183F8FC7C022EA870BBF4AACFCC2099A533E45F2D0395957E7521B51C2CFCAF695D4D8E9FCEA1F7E6F0F101C6778DA827A17800CE7D73594321916E0988F08D7030A58E5AD289298AFB010BEA3C6CDE5D1141D2B1C241102A1C768F6BB0091749CAEC58FAF9849EA4534AF5FC20C819B32DFABC24A725E5C173C3A84C3ED8438A78DFE0A9E117882F4460429724CE54428C33FAD305F5C1EE8F4F765FC974A882099E279BDA471835C12D1D9774AD6D5ED66289B52BA9C0B312567BB23117882F44604297287769387670735201E561CDFBCA1751F6FD1C55BDD38FC3FD2E47CDBA5A96583BA9C0B312567BB231DD303D21008E29813377AFFFEAFD269A417C69337E82CC2E827F84554CEF50127C277FBC8AE2E8BA83251EDC214901ED5E8D9A59859A8B67DCF99580C4A34B4089D37D7C0E48F6C5571747095F342E88FB05168BE4CE3AF\r\nX-C1DE0DAB: 0D63561A33F958A5F77B520633F7EA967860ACBD63433A50835AAE55C298FC18BDC6A1CF3F042BAD6DF99611D93F60EF505D71D783575ABE699F904B3F4130E343918A1A30D5E7FCCB5012B2E24CD356\r\nX-C8649E89: 4E36BF7865823D7055A7F0CF078B5EC49A30900B95165D342B94C1DAF75C4D22375720FD00EBBE39E1E6786EA80A5C797FCFE91CD6241B2947D6CA5E78917A8C1D7E09C32AA3244CAD12835445A9562BD9F8BF0E7102B34AE3D93501275E802F3EB3F6AD6EA9203E\r\nX-D57D3AED: 3ZO7eAau8CL7WIMRKs4sN3D3tLDjz0dLbV79QFUyzQ2Ujvy7cMT6pYYqY16iZVKkSc3dCLJ7zSJH7+u4VD18S7Vl4ZUrpaVfd2+vE6kuoey4m4VkSEu530nj6fImhcD4MUrOEAnl0W826KZ9Q+tr5+wYjsrrSY/u8Y3PrTqANeitKFiSd6Yd7yPpbiiZ/d5BsxIjK0jGQgCHUM3Ry2Lt2G3MDkMauH3h0dBdQGj+BB/iPzQYh7XS329fgu+/vnDh0fsl0Boe9pVpwx2KrjqGvg==\r\nX-Mailru-MI: 800\r\nX-Mailru-Sender: 0D4E4D77B0FF454A23B8E0744517C3442D0108693D79A69C4C37B630E5CBA6D076DEE9E9E96340E580683B1EBFD6753F3A9E8C5B347B8F7C14907A1F77082DCAFBCB772DDF65D6B00DCD7E18950BBC03BF0422C00CE68174851DE5097B8401C6C89D8AF824B716EB24DA7C73C6EBDA96E55ACCCBDAC3C8955FEEDEB644C299C0ED14614B50AE0675\r\nX-Mras: Ok\r\nX-Spam: undefined\r\n\r\n', '\n<HTML><BODY><div>&nbsp;</div><div>hey yakov</div><div>good days</div><div><a target=\"blank\" href=\"http://www.google.com/asfsafsfsa.php\">http://www.google.com/asfsafsfsa.php</a>&nbsp;</div><div>&nbsp;</div></BODY></HTML>\n', 3.7, 'yasha3651@mail.ru', '2021-11-27 05:36:43', '2021-11-27 04:36:43'),
(4, 22, 1, 'tona@test.com', 'Admin', '2021-11-29 06:39:43', '2021-11-29 05:49:06', 'oko', 'Return-Path: <chakouri.pro@gmail.com>\r\nX-Original-To: tester.f31@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from mail-pg1-f179.google.com (mail-pg1-f179.google.com [209.85.215.179])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id 7D0AD27AFD\r\n	for <tester.f31@mail-analyzer.com>; Mon, 29 Nov 2021 06:39:56 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=NONE sp=QUARANTINE) smtp.from=gmail.com header.from=gmail.com;\r\n	dkim=pass header.d=gmail.com;\r\n        spf=pass (sender IP is 209.85.215.179) smtp.mailfrom=chakouri.pro@gmail.com smtp.helo=mail-pg1-f179.google.com\r\nReceived-SPF: pass (obistar.com: domain of gmail.com designates 209.85.215.179 as permitted sender) client-ip=209.85.215.179; envelope-from=chakouri.pro@gmail.com; helo=mail-pg1-f179.google.com;\r\nReceived: by mail-pg1-f179.google.com with SMTP id c29so3945122pgl.12\r\n        for <tester.f31@mail-analyzer.com>; Sun, 28 Nov 2021 21:39:56 -0800 (PST)\r\nDKIM-Signature: v=1; a=rsa-sha256; c=relaxed/relaxed;\r\n        d=gmail.com; s=20210112;\r\n        h=mime-version:from:date:message-id:subject:to;\r\n        bh=VAmOxpLgK9J3fI2Oahsdm8dYvjiwafUgYRQmxxiRH6g=;\r\n        b=M+zl/hF35YSF4ow68rRin8Dpqa8NBLFd4Pl/e+OWgWPF6S1BBCgGEvZyH5oUZ5PwMi\r\n         uJgAzpbFQ5aLuTYc4wKG+ZEbFxP5d18TiOq5q/UTp1nj7/Vq26ePTuxliLGWL8o98Bn/\r\n         QJjO6Otv4kuevqaF5fkyOmHAJZyltujumU4eRiImoOvQxpqKG/thx1o2VSLc5Wkuf1a7\r\n         A2AzzOoJLFREM0aMy6u79nFCy6ApA7326WJ2L5S7ZK7aGSJ2zoHKTva9znAJbyPgiHYI\r\n         l1gInkIZ/AqachFfMXTs5WDlnCrLxZrzH2BgY6QnDQndJGyCgu6oHv2nykCuClSQ2Vpw\r\n         m77A==\r\nX-Google-DKIM-Signature: v=1; a=rsa-sha256; c=relaxed/relaxed;\r\n        d=1e100.net; s=20210112;\r\n        h=x-gm-message-state:mime-version:from:date:message-id:subject:to;\r\n        bh=VAmOxpLgK9J3fI2Oahsdm8dYvjiwafUgYRQmxxiRH6g=;\r\n        b=iUF9AT3ypznRu3UJfYU/aERO8Hkg9oD/d87h6sqo7NO93/+0fGU94oJY+zFIWRzEfc\r\n         vcFb11hIlw9NFsDI6TghXwDA8UQwo5304s3WiinaFaQzQ7fhLVr/UCvRADMlDS1lfz/s\r\n         m0PiBCSnTTba4JosknEb3A+tf0/Jbvvrpgia8zgoQ1SXnD+B7Sr+W+F9JIVwJti+jsD3\r\n         +Neut6SZxv8uElKJIXyHBXZp7NAA7riE1fxQybwoKLf/AwhU69immj+jAbu4DkJ2Wklq\r\n         QQVU5NpqkQwfWxsFnzYI46gofUGLCS7oK4OonK7VdgmzZGB9JR+MiPfYG+K2z3pU9oDn\r\n         DQmA==\r\nX-Gm-Message-State: AOAM531QSdnWtVlRYD12I3dJgLEgLFAl48qIRZxHHL76stLJib9D+y0G\r\n	vCMDdYPhSTrrxEzOCS1sgz1yUyVzeJtT/4rS6Bhal1udX4U=\r\nX-Google-Smtp-Source: ABdhPJz3NVaXTbBrs+qVF9Re7JRl+ohcPmmMDZZAbsBOORk3nlD9HpxyjKtezMnSWj6tNjGctbyRps2mMzdRSR1iCs8=\r\nX-Received: by 2002:aa7:8611:0:b0:49f:a5b3:14b4 with SMTP id\r\n p17-20020aa78611000000b0049fa5b314b4mr37640144pfn.30.1638164394033; Sun, 28\r\n Nov 2021 21:39:54 -0800 (PST)\r\nMIME-Version: 1.0\r\nFrom: Samir Chakouri <chakouri.pro@gmail.com>\r\nDate: Mon, 29 Nov 2021 06:39:43 +0100\r\nMessage-ID: <CAKzYfk8E+wGUAT1K_X6r7nFv2JPmBeTmqWpi6AV9xdOKBOXP4A@mail.gmail.com>\r\nSubject: oko\r\nTo: tester.f31@mail-analyzer.com\r\nContent-Type: multipart/alternative; boundary=\"000000000000ca45fa05d1e6de79\"\r\n\r\n', '<div dir=\"ltr\">opopoo</div>\r\n', 1.4, 'chakouri.pro@gmail.com', '2021-11-29 05:49:06', '2021-11-29 04:49:06'),
(5, 29, 3, 'yasha3651@mail.ru', 'yakov', '2021-11-29 09:47:40', '2021-11-29 08:05:26', 'spam test new send', 'Return-Path: <yasha3651@mail.ru>\r\nX-Spam-Checker-Version: SpamAssassin 3.4.4 (2020-01-24) on obistar.com\r\nX-Spam-Level: \r\nX-Spam-Status: No, score=-0.4 required=7.0 tests=DKIM_SIGNED,DKIM_VALID,\r\n	DKIM_VALID_AU,DKIM_VALID_EF,FREEMAIL_ENVFROM_END_DIGIT,FREEMAIL_FROM,\r\n	FREEMAIL_REPLYTO_END_DIGIT,FROM_EXCESS_BASE64,HTML_MESSAGE,\r\n	RCVD_IN_DNSWL_LOW,RCVD_IN_MSPIKE_H3,RCVD_IN_MSPIKE_WL,SPF_HELO_PASS,\r\n	SPF_PASS autolearn=unavailable autolearn_force=no version=3.4.4\r\nX-Original-To: yakov.757@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from f542.i.mail.ru (f542.i.mail.ru [217.69.128.71])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id 8B3A328137\r\n	for <yakov.757@mail-analyzer.com>; Mon, 29 Nov 2021 07:47:45 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=REJECT sp=NONE) smtp.from=mail.ru header.from=mail.ru;\r\n	dkim=pass header.d=mail.ru;\r\n	spf=pass (sender IP is 217.69.128.71) smtp.mailfrom=yasha3651@mail.ru smtp.helo=f542.i.mail.ru\r\nReceived-SPF: pass (obistar.com: domain of mail.ru designates 217.69.128.71 as permitted sender) client-ip=217.69.128.71; envelope-from=yasha3651@mail.ru; helo=f542.i.mail.ru;\r\nDKIM-Signature: v=1; a=rsa-sha256; q=dns/txt; c=relaxed/relaxed; d=mail.ru; s=mail3;\r\n	h=Content-Type:Message-ID:Reply-To:Date:MIME-Version:Subject:To:From:From:Subject:Content-Type:Content-Transfer-Encoding:To:Cc; bh=R11mXQB8irFiGGHhH1WZro5U8oJikozj8f5KPIQAH04=;\r\n	t=1638168465;x=1638773865; \r\n	b=qB8HxkChRLtF3ru8vQyf0MQf6USvxVo62vLOvb+OnSoxfsdf2gyYFzie1OSzuFHZGrbv11JjQPuir7+q0fhaHoHcVH7y2pZpsiqsVeSSguXnllqsbcws+/PrVGJh/PTl5XFQmendb3zYDLk1T+/Fo+cxPSBQb1o3/s/nCAHcCnw=;\r\nReceived: by f542.i.mail.ru with local (envelope-from <yasha3651@mail.ru>)\r\n	id 1mraRw-0004yF-6V\r\n	for yakov.757@mail-analyzer.com; Mon, 29 Nov 2021 09:47:40 +0300\r\nReceived: by e.mail.ru with HTTP;\r\n	Mon, 29 Nov 2021 09:47:40 +0300\r\nFrom: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nTo: yakov.757@mail-analyzer.com\r\nSubject: =?UTF-8?B?c3BhbSB0ZXN0IG5ldyBzZW5k?=\r\nMIME-Version: 1.0\r\nX-Mailer: Mail.Ru Mailer 1.0\r\nX-SenderField-Remind: 0\r\nDate: Mon, 29 Nov 2021 09:47:40 +0300\r\nReply-To: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nX-Priority: 3 (Normal)\r\nMessage-ID: <1638168460.48807445@f542.i.mail.ru>\r\nContent-Type: multipart/alternative;\r\n	boundary=\"--ALT--c945D230F0863Fc04f5AC85087cE7fF11638168460\"\r\nAuthentication-Results: f542.i.mail.ru; auth=pass smtp.auth=yasha3651@mail.ru smtp.mailfrom=yasha3651@mail.ru\r\nX-7564579A: EEAE043A70213CC8\r\nX-77F55803: 119C1F4DF6A9251CB7790C88AA09B433A210E59F5B72656BAA78760010DB95EB8FD872164937FA4C4534FECE1B87E1A73738C862194A26BA23F70789B87A95A905125E322ED0AA19\r\nX-7FA49CB5: 70AAF3C13DB7016878DA827A17800CE7054C17A0CC3C3F60D82A6BABE6F325AC08BE7437D75B48FABCF491FFA38154B613377AFFFEAFD269176DF2183F8FC7C07633BACAB33B9508C2099A533E45F2D0395957E7521B51C2CFCAF695D4D8E9FCEA1F7E6F0F101C6778DA827A17800CE757AEC41D7AA04458EA1F7E6F0F101C6723150C8DA25C47586E58E00D9D99D84E1BDDB23E98D2D38BBCA57AF85F7723F2C5F01B5825B5F27BF20F93FFFA251CCD20879F7C8C5043D14489FFFB0AA5F4BF176DF2183F8FC7C0B272A53F9BBAC8E28941B15DA834481FA18204E546F3947C1D471462564A2E19F6B57BC7E64490618DEB871D839B7333395957E7521B51C2DFABB839C843B9C08941B15DA834481F8AA50765F790063735D2385A5E2B3AC3389733CBF5DBD5E9B5C8C57E37DE458B9E9CE733340B9D5F3BBE47FD9DD3FB595F5C1EE8F4F765FC72CEEB2601E22B093A03B725D353964B0B7D0EA88DDEDAC722CA9DD8327EE493B89ED3C7A6281781CCFFBAE954C2DE44C4224003CC83647689D4C264860C145E\r\nX-C1DE0DAB: 0D63561A33F958A561E639EF371EC125006C46B59856FFB69A6B62A335AA37BABDC6A1CF3F042BAD6DF99611D93F60EF1638054B7D09EC08699F904B3F4130E343918A1A30D5E7FCCB5012B2E24CD356\r\nX-C8649E89: 4E36BF7865823D7055A7F0CF078B5EC49A30900B95165D3407FE5477D6A8AF08F6B05ECA68D11B4E98F2E5183D9D4787CF3CD530C6CC138E60800239E5974E641D7E09C32AA3244C4E9F7FBF3A266C9474DA3A12305BEF70F2F5F14F68F1805B3EB3F6AD6EA9203E\r\nX-D57D3AED: 3ZO7eAau8CL7WIMRKs4sN3D3tLDjz0dLbV79QFUyzQ2Ujvy7cMT6pYYqY16iZVKkSc3dCLJ7zSJH7+u4VD18S7Vl4ZUrpaVfd2+vE6kuoey4m4VkSEu530nj6fImhcD4MUrOEAnl0W826KZ9Q+tr5+wYjsrrSY/u8Y3PrTqANeitKFiSd6Yd7yPpbiiZ/d5BsxIjK0jGQgCHUM3Ry2Lt2G3MDkMauH3h0dBdQGj+BB/iPzQYh7XS329fgu+/vnDh2ytQ7Xx56jUxDN7Cf7chig==\r\nX-Mailru-MI: 800\r\nX-Mailru-Sender: 0D4E4D77B0FF454A23B8E0744517C344CEB3EC46CAD0F7A2E66391C1B7B49924B586CB25B604AFF580683B1EBFD6753F3A9E8C5B347B8F7C14907A1F77082DCAFBCB772DDF65D6B00DCD7E18950BBC03BF0422C00CE68174851DE5097B8401C6C89D8AF824B716EB24DA7C73C6EBDA96E55ACCCBDAC3C8955FEEDEB644C299C0ED14614B50AE0675\r\nX-Mras: Ok\r\nX-Spam: undefined\r\n\r\n', '\n<HTML><BODY><div>&nbsp;</div><div>&nbsp;</div><div><div style=\"-webkit-text-stroke-width:0px; color:#000000; font-family:&quot;Times New Roman&quot;; font-size:medium; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; letter-spacing:normal; orphans:2; text-align:start; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px\">hi</div><div style=\"-webkit-text-stroke-width:0px; color:#000000; font-family:&quot;Times New Roman&quot;; font-size:medium; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; letter-spacing:normal; orphans:2; text-align:start; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px\">Autur</div><div style=\"-webkit-text-stroke-width:0px; color:#000000; font-family:&quot;Times New Roman&quot;; font-size:medium; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; letter-spacing:normal; orphans:2; text-align:start; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px\">I am spam tester</div><div style=\"-webkit-text-stroke-width:0px; color:#000000; font-family:&quot;Times New Roman&quot;; font-size:medium; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; letter-spacing:normal; orphans:2; text-align:start; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px\">http://www.google.com/tester.fsdfsdfs.php</div></div></BODY></HTML>\n', 4.2, 'yasha3651@mail.ru', '2021-11-29 08:05:26', '2021-11-29 07:05:26'),
(6, 33, 3, 'yasha3651@mail.ru', 'yakov', '2021-11-29 11:13:46', '2021-11-29 08:14:58', 'yakov.757@mail-analyzer.com', 'Return-Path: <yasha3651@mail.ru>\r\nX-Spam-Checker-Version: SpamAssassin 3.4.4 (2020-01-24) on obistar.com\r\nX-Spam-Level: \r\nX-Spam-Status: No, score=0.3 required=5.0 tests=DKIM_SIGNED,DKIM_VALID,\r\n	DKIM_VALID_AU,DKIM_VALID_EF,FREEMAIL_ENVFROM_END_DIGIT,FREEMAIL_FROM,\r\n	FREEMAIL_REPLYTO_END_DIGIT,FROM_EXCESS_BASE64,HTML_MESSAGE,\r\n	RCVD_IN_DNSWL_NONE,SPF_HELO_PASS,SPF_PASS autolearn=no\r\n	autolearn_force=no version=3.4.4\r\nX-Original-To: yakov.757@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from f183.i.mail.ru (f183.i.mail.ru [128.140.171.92])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id 8EECE26D4B\r\n	for <yakov.757@mail-analyzer.com>; Mon, 29 Nov 2021 09:13:56 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=REJECT sp=NONE) smtp.from=mail.ru header.from=mail.ru;\r\n	dkim=pass header.d=mail.ru;\r\n	spf=pass (sender IP is 128.140.171.92) smtp.mailfrom=yasha3651@mail.ru smtp.helo=f183.i.mail.ru\r\nReceived-SPF: pass (obistar.com: domain of mail.ru designates 128.140.171.92 as permitted sender) client-ip=128.140.171.92; envelope-from=yasha3651@mail.ru; helo=f183.i.mail.ru;\r\nDKIM-Signature: v=1; a=rsa-sha256; q=dns/txt; c=relaxed/relaxed; d=mail.ru; s=mail3;\r\n	h=Content-Type:Message-ID:Reply-To:Date:MIME-Version:Subject:To:From:From:Subject:Content-Type:Content-Transfer-Encoding:To:Cc; bh=ekXGSZrgZXFgnt7ulznSmRfyb6yAZDL+/g8/YnpjciE=;\r\n	t=1638173636;x=1638779036; \r\n	b=C+1cyysfVLxRlz6gkCfVrquRkrJyLXBPHuVIiugZjO6VvOoKaJr7QfWHi8kn90xlbuDklYZ9edUnrMhzs925GK+ftBSA4Zqjmbp5oCrWu8Z5QsXTRawaGMn5CuLDdfmwrwtWBSP1gk5xceZEaBPnfySyvQ5t/nnONyWX0LkZDns=;\r\nReceived: by f183.i.mail.ru with local (envelope-from <yasha3651@mail.ru>)\r\n	id 1mrbnG-0000SN-AK\r\n	for yakov.757@mail-analyzer.com; Mon, 29 Nov 2021 11:13:46 +0300\r\nReceived: by e.mail.ru with HTTP;\r\n	Mon, 29 Nov 2021 11:13:46 +0300\r\nFrom: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nTo: yakov.757@mail-analyzer.com\r\nSubject: =?UTF-8?B?eWFrb3YuNzU3QG1haWwtYW5hbHl6ZXIuY29t?=\r\nMIME-Version: 1.0\r\nX-Mailer: Mail.Ru Mailer 1.0\r\nX-SenderField-Remind: 0\r\nDate: Mon, 29 Nov 2021 11:13:46 +0300\r\nReply-To: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nX-Priority: 3 (Normal)\r\nMessage-ID: <1638173626.155747743@f183.i.mail.ru>\r\nContent-Type: multipart/alternative;\r\n	boundary=\"--ALT--c7D9206de9E6FdB5B16ec4D299a1BcA41638173626\"\r\nAuthentication-Results: f183.i.mail.ru; auth=pass smtp.auth=yasha3651@mail.ru smtp.mailfrom=yasha3651@mail.ru\r\nX-7564579A: 646B95376F6C166E\r\nX-77F55803: 119C1F4DF6A9251CB7790C88AA09B4338D003BE5014EDF43BB675C48A427D40B8FD872164937FA4C506381A5C27324BDE242A627CF79A088FCFBC122C953BA537EC9BD65D2B0AD4B\r\nX-7FA49CB5: 70AAF3C13DB7016878DA827A17800CE7EA6770295504F6F8D82A6BABE6F325AC08BE7437D75B48FABCF491FFA38154B613377AFFFEAFD269176DF2183F8FC7C0F9D3BE5B596754B8C2099A533E45F2D0395957E7521B51C2CFCAF695D4D8E9FCEA1F7E6F0F101C6778DA827A17800CE782BFA309970D60C252120BFB3F63BC185F65E78799B30205C33C3ADAEA971F8E611E41BBFE2FEB2B4E7F954D8BFC30FBF184A9DD3DAED9B8124B297660E9BE2C8EEF46B7454FC60B9742502CCDD46D0D21E93C0F2A571C7BF6B57BC7E64490618DEB871D839B73339E8FC8737B5C22498CC5112E3E56BCDBCC7F00164DA146DAFE8445B8C89999729449624AB7ADAF37F6B57BC7E64490611E7FA7ABCAF51C92176DF2183F8FC7C0DBD70917792A7BA28941B15DA834481F9449624AB7ADAF372E808ACE2090B5E14AD6D5ED66289B5259CC434672EE63711DD303D21008E298D5E8D9A59859A8B6B372FE9A2E580EFC725E5C173C3A84C3CF0F87FC90EAB94E35872C767BF85DA2F004C90652538430E4A6367B16DE6309\r\nX-C1DE0DAB: 0D63561A33F958A53C96190819A1B2E547EFE5E6431A82EBEAFD72A20FB640F9BDC6A1CF3F042BAD6DF99611D93F60EF1638054B7D09EC08699F904B3F4130E343918A1A30D5E7FCCB5012B2E24CD356\r\nX-C8649E89: 4E36BF7865823D7055A7F0CF078B5EC49A30900B95165D34ADE558D2B396DA7CA9EBFFF33B4D21672E854854D9B44979967D00B5192B06E163CF911DE78FE6A31D7E09C32AA3244CCD4AC0CA52A36C9A46481E1391F67F4055E75C8D0ED9F6EE3EB3F6AD6EA9203E\r\nX-D57D3AED: 3ZO7eAau8CL7WIMRKs4sN3D3tLDjz0dLbV79QFUyzQ2Ujvy7cMT6pYYqY16iZVKkSc3dCLJ7zSJH7+u4VD18S7Vl4ZUrpaVfd2+vE6kuoey4m4VkSEu530nj6fImhcD4MUrOEAnl0W826KZ9Q+tr5+wYjsrrSY/u8Y3PrTqANeitKFiSd6Yd7yPpbiiZ/d5BsxIjK0jGQgCHUM3Ry2Lt2G3MDkMauH3h0dBdQGj+BB/iPzQYh7XS329fgu+/vnDhVIOakJO+S3Q67Nqy4+I8hg==\r\nX-Mailru-MI: 800\r\nX-Mailru-Sender: 0D4E4D77B0FF454A23B8E0744517C344DC32AA4F32D85A4F25686B42012CDBEC12E4CEC14B0EDACD80683B1EBFD6753F3A9E8C5B347B8F7C14907A1F77082DCAFBCB772DDF65D6B00DCD7E18950BBC03BF0422C00CE68174851DE5097B8401C6C89D8AF824B716EB24DA7C73C6EBDA96E55ACCCBDAC3C8955FEEDEB644C299C0ED14614B50AE0675\r\nX-Mras: Ok\r\nX-Spam: undefined\r\n\r\n', '\n<HTML><BODY><div>&nbsp;</div><div>&nbsp;</div><div><div>--<br>Zakharov Yakovich</div><div><a target=\"blank\" href=\"mailto:yakov.757@mail-analyzer.com\">yakov.757@mail-analyzer.com</a></div></div></BODY></HTML>\n', 4.2, 'yasha3651@mail.ru', '2021-11-29 08:14:58', '2021-11-29 07:14:58');
INSERT INTO `test_results` (`id`, `mail_id`, `user_id`, `email`, `name`, `received_at`, `tested_at`, `subject`, `header`, `content`, `score`, `sender`, `created_at`, `updated_at`) VALUES
(7, 35, 3, 'yasha3651@mail.ru', 'yakov', '2021-11-29 11:23:47', '2021-11-29 08:23:59', 'my test 3', 'Return-Path: <yasha3651@mail.ru>\r\nX-Spam-Checker-Version: SpamAssassin 3.4.4 (2020-01-24) on obistar.com\r\nX-Spam-Level: \r\nX-Spam-Status: No, score=-0.4 required=5.0 tests=DKIM_SIGNED,DKIM_VALID,\r\n	DKIM_VALID_AU,DKIM_VALID_EF,FREEMAIL_ENVFROM_END_DIGIT,FREEMAIL_FROM,\r\n	FREEMAIL_REPLYTO_END_DIGIT,FROM_EXCESS_BASE64,HTML_MESSAGE,\r\n	RCVD_IN_DNSWL_LOW,RCVD_IN_MSPIKE_H2,SPF_HELO_PASS,SPF_PASS\r\n	autolearn=unavailable autolearn_force=no version=3.4.4\r\nX-Original-To: yakov.757@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from f389.i.mail.ru (f389.i.mail.ru [185.5.136.60])\r\n	by compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id 5A56C28246\r\n	for <yakov.757@mail-analyzer.com>; Mon, 29 Nov 2021 09:23:53 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n	dmarc=pass (p=REJECT sp=NONE) smtp.from=mail.ru header.from=mail.ru;\r\n	dkim=pass header.d=mail.ru;\r\n	spf=pass (sender IP is 185.5.136.60) smtp.mailfrom=yasha3651@mail.ru smtp.helo=f389.i.mail.ru\r\nReceived-SPF: pass (obistar.com: domain of mail.ru designates 185.5.136.60 as permitted sender) client-ip=185.5.136.60; envelope-from=yasha3651@mail.ru; helo=f389.i.mail.ru;\r\nDKIM-Signature: v=1; a=rsa-sha256; q=dns/txt; c=relaxed/relaxed; d=mail.ru; s=mail3;\r\n	h=Content-Type:Message-ID:Reply-To:Date:MIME-Version:Subject:To:From:From:Subject:Content-Type:Content-Transfer-Encoding:To:Cc; bh=4obOt83yWPEnumggTG1BAIYqonD0GhyzlWpXZgmjKM8=;\r\n	t=1638174233;x=1638779633; \r\n	b=GyesYhnQdLRYpJxWp2Sb2UnGUvRtdx4okFVK30zrh2gRlyO46bLiW8Va+0UeooCSizauE3yUPPqnpvmXrr8/atdqTY0gf4ayyC+DFXtVgih6C2ZjiIcqBTU1avzv4X3MMEkR+a3s5dpuFvowo0ELrLdan5BvNEwAhlmpB0DBsm4=;\r\nReceived: by f389.i.mail.ru with local (envelope-from <yasha3651@mail.ru>)\r\n	id 1mrbwy-0005ke-0q\r\n	for yakov.757@mail-analyzer.com; Mon, 29 Nov 2021 11:23:48 +0300\r\nReceived: by e.mail.ru with HTTP;\r\n	Mon, 29 Nov 2021 11:23:47 +0300\r\nFrom: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nTo: yakov.757@mail-analyzer.com\r\nSubject: =?UTF-8?B?bXkgdGVzdCAz?=\r\nMIME-Version: 1.0\r\nX-Mailer: Mail.Ru Mailer 1.0\r\nX-SenderField-Remind: 0\r\nDate: Mon, 29 Nov 2021 11:23:47 +0300\r\nReply-To: =?UTF-8?B?WmFraGFyb3YgWWFrb3ZpY2g=?= <yasha3651@mail.ru>\r\nX-Priority: 3 (Normal)\r\nMessage-ID: <1638174227.511014641@f389.i.mail.ru>\r\nContent-Type: multipart/alternative;\r\n	boundary=\"--ALT--c97714C4CdA0Fd84c409a3317Ed5B2f41638174227\"\r\nAuthentication-Results: f389.i.mail.ru; auth=pass smtp.auth=yasha3651@mail.ru smtp.mailfrom=yasha3651@mail.ru\r\nX-7564579A: B8F34718100C35BD\r\nX-77F55803: 119C1F4DF6A9251CB7790C88AA09B433EA904EB87E2A9DA79787842DB479F4618FD872164937FA4C87E763F982FBECC7D0F2B70BF3FDA997C831270F750BC1443EDA4918E01E25D5\r\nX-7FA49CB5: 70AAF3C13DB7016878DA827A17800CE74B2D042F1D88928FD82A6BABE6F325AC08BE7437D75B48FABCF491FFA38154B613377AFFFEAFD269176DF2183F8FC7C00EEC24FFE855BCBBC2099A533E45F2D0395957E7521B51C2CFCAF695D4D8E9FCEA1F7E6F0F101C6778DA827A17800CE7F5F08398AF01CA1FEA1F7E6F0F101C6723150C8DA25C47586E58E00D9D99D84E1BDDB23E98D2D38BBCA57AF85F7723F27ECC02258216B7B7BE4559FA6162F2FF20879F7C8C5043D14489FFFB0AA5F4BFA417C69337E82CC2CC7F00164DA146DAFE8445B8C89999728AA50765F79006374F09588CB15B21E6389733CBF5DBD5E9C8A9BA7A39EFB766F5D81C698A659EA7CC7F00164DA146DA9985D098DBDEAEC87664788771C849C4F6B57BC7E6449061A352F6E88A58FB86F5D81C698A659EA7E827F84554CEF5019E625A9149C048EE9ECD01F8117BC8BEE2021AF6380DFAD18AA50765F790063735872C767BF85DA227C277FBC8AE2E8B63FC19C501E3674D75ECD9A6C639B01B4E70A05D1297E1BBCB5012B2E24CD356\r\nX-C1DE0DAB: 0D63561A33F958A5E5C77FD6D4A512FB8623C141B326D1D9070EF3E1837AB35ABDC6A1CF3F042BAD6DF99611D93F60EF1638054B7D09EC08699F904B3F4130E343918A1A30D5E7FCCB5012B2E24CD356\r\nX-C8649E89: 4E36BF7865823D7055A7F0CF078B5EC49A30900B95165D34F38194B2C99DC128EE8DA6EE1BF8A8C87EF4F56B00B032321B2AC1F1056639049AB2AA83C6C617E41D7E09C32AA3244C4FEB8FD7C12CE72E9DECC1A0DC9E78AA435BF7150578642F3EB3F6AD6EA9203E\r\nX-D57D3AED: 3ZO7eAau8CL7WIMRKs4sN3D3tLDjz0dLbV79QFUyzQ2Ujvy7cMT6pYYqY16iZVKkSc3dCLJ7zSJH7+u4VD18S7Vl4ZUrpaVfd2+vE6kuoey4m4VkSEu530nj6fImhcD4MUrOEAnl0W826KZ9Q+tr5+wYjsrrSY/u8Y3PrTqANeitKFiSd6Yd7yPpbiiZ/d5BsxIjK0jGQgCHUM3Ry2Lt2G3MDkMauH3h0dBdQGj+BB/iPzQYh7XS329fgu+/vnDhJL5bWuBa6VEEqFN7qSR+hw==\r\nX-Mailru-MI: 800\r\nX-Mailru-Sender: 0D4E4D77B0FF454A23B8E0744517C3442D3757C8D3275D86591276B0FEBDA89EE5D9F6FAA256E01780683B1EBFD6753F3A9E8C5B347B8F7C14907A1F77082DCAFBCB772DDF65D6B00DCD7E18950BBC03BF0422C00CE68174851DE5097B8401C6C89D8AF824B716EB24DA7C73C6EBDA96E55ACCCBDAC3C8955FEEDEB644C299C0ED14614B50AE0675\r\nX-Mras: Ok\r\nX-Spam: undefined\r\n\r\n', '\n<HTML><BODY><div><br>Zakharov Yakovich</div><div><div><a target=\"blank\" href=\"mailto:yakov.757@mail-analyzer.com\">yakov.757@mail-analyzer.com</a></div><div><a target=\"blank\" href=\"mailto:yakov.757@mail-analyzer.com\">yakov.757@mail-analyzer.com</a></div></div></BODY></HTML>\n', 3.2, 'yasha3651@mail.ru', '2021-11-29 08:23:59', '2021-11-29 07:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email_id` int(11) NOT NULL,
  `price_type` int(11) NOT NULL DEFAULT 1,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` float DEFAULT 0,
  `deal_id` varchar(100) CHARACTER SET ascii DEFAULT NULL,
  `pay_id` varchar(40) CHARACTER SET ascii DEFAULT NULL,
  `mode` varchar(20) DEFAULT NULL,
  `authority` varchar(200) DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `income` float NOT NULL DEFAULT 0,
  `gift` varchar(150) DEFAULT NULL,
  `balance_id` int(11) NOT NULL DEFAULT 0,
  `remain_time` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `email_id`, `price_type`, `price`, `qty`, `amount`, `deal_id`, `pay_id`, `mode`, `authority`, `bank`, `type`, `income`, `gift`, `balance_id`, `remain_time`, `created_at`, `updated_at`) VALUES
(1, 3, 47, 500, 50, 1, 60.5, 'cs_test_a1XGzZpsaNhbcvIjdcm86JBWrh3n127RdL2eqj0S7nzfYNWxGQAQoIrToJ', 'cus_Kf49Xgu24Olmf7', 'card', 'pi_3Jzk0Y2eZvKYlo2C16AYZrTU', 'stripe', 'paid', 50, NULL, 1, NULL, '2021-11-25 15:37:47', '2021-11-25 14:37:47'),
(2, 3, 47, 500, 50, 1, 60.5, '2E156685PY675062B', '8GT98226X27953019', 'PENDING', 'E2XYTPW83YAKW', 'paypal', 'peding', 50, NULL, 2, NULL, '2021-11-25 15:53:23', '2021-11-25 15:58:40'),
(3, 3, 47, 500, 50, 1, 60.5, 'cs_test_a1EKTGpsuOyP52OxqSk2jkF9owOE2bZcad0xuIMFJXknhB418pOcTzlyYC', 'cus_Kf4PvQaTUQec6k', 'card', 'pi_3JzkGW2eZvKYlo2C1OdbcU5M', 'stripe', 'paid', 50, NULL, 3, NULL, '2021-11-25 15:54:11', '2021-11-25 14:54:11'),
(4, 3, 47, 1000, 80, 1, 96.8, 'cs_test_a1GBXNRP2M0oMCVC1W7aO2y0E80fCe3OSg5ISUe81zEsgKh3xvwFWa5yDw', 'cus_Kf5IIM2Au10htp', 'card', 'pi_3Jzl7d2eZvKYlo2C1p4JMJxa', 'stripe', 'paid', 80, NULL, 4, NULL, '2021-11-25 16:49:01', '2021-11-25 15:49:01'),
(5, 7, 86, 500, 50, 1, 60.5, 'cs_test_a1c0nseHwUFAuoMJYhWOkaVO1VxgVZElyaxCEdq0aDjsR8SVeGg6ub38t0', 'cus_Kf5ew6n5wpp1AP', 'card', 'pi_3JzlSg2eZvKYlo2C0kqoo2W9', 'stripe', 'paid', 50, NULL, 5, NULL, '2021-11-25 17:10:45', '2021-11-25 16:10:45');

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
(158, 'ar', 'Thanks for registration, Please check your mail and follow activation link to active your account.', NULL, 'general', '2021-11-19 11:41:11', '2021-11-19 11:41:11'),
(159, 'en', 'Thanks for registration, Please check your email and follow activation link to active your account.', NULL, 'general', '2021-11-26 12:14:18', '2021-11-26 12:14:18'),
(160, 'ar', 'Thanks for registration, Please check your email and follow activation link to active your account.', NULL, 'general', '2021-11-26 12:14:18', '2021-11-26 12:14:18'),
(161, 'en', 'Completed your account registration!', NULL, 'general', '2021-11-26 14:57:51', '2021-11-26 14:57:51'),
(162, 'ar', 'Completed your account registration!', NULL, 'general', '2021-11-26 14:57:51', '2021-11-26 14:57:51');

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
(47, 'yakov.757@mail-analyzer.com', '3', '2021-11-23 02:16:25', '2021-11-19 05:54:52', '2021-11-23 02:16:25'),
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
(71, 'znpqcrz313@mail-analyzer.com', NULL, NULL, '2021-11-23 01:00:07', '2021-11-23 01:00:07'),
(72, 'tyvvrre093@mail-analyzer.com', NULL, NULL, '2021-11-23 01:59:35', '2021-11-23 01:59:35'),
(73, 'lbvlvmx544@mail-analyzer.com', NULL, NULL, '2021-11-23 02:01:59', '2021-11-23 02:01:59'),
(74, 'jhcdrsy383@mail-analyzer.com', NULL, NULL, '2021-11-23 02:16:43', '2021-11-23 02:16:43'),
(75, 'vvnavqq798@mail-analyzer.com', NULL, NULL, '2021-11-23 09:11:55', '2021-11-23 09:11:55'),
(76, 'hicknnc843@mail-analyzer.com', NULL, NULL, '2021-11-23 11:06:01', '2021-11-23 11:06:01'),
(77, 'knsxmqg105@mail-analyzer.com', NULL, NULL, '2021-11-23 12:11:55', '2021-11-23 12:11:55'),
(78, 'woznpgq504@mail-analyzer.com', NULL, NULL, '2021-11-23 12:48:22', '2021-11-23 12:48:22'),
(79, 'sxanxlh667@mail-analyzer.com', NULL, NULL, '2021-11-23 12:51:38', '2021-11-23 12:51:38'),
(80, 'hediwvf931@mail-analyzer.com', NULL, NULL, '2021-11-23 13:29:15', '2021-11-23 13:29:15'),
(81, 'zoxdesy085@mail-analyzer.com', NULL, NULL, '2021-11-23 15:56:49', '2021-11-23 15:56:49'),
(82, 'ffzaimu155@mail-analyzer.com', NULL, NULL, '2021-11-23 23:59:16', '2021-11-23 23:59:16'),
(83, 'xktupyc356@mail-analyzer.com', NULL, NULL, '2021-11-24 03:17:47', '2021-11-24 03:17:47'),
(84, 'huqzoty551@mail-analyzer.com', NULL, NULL, '2021-11-24 08:20:41', '2021-11-24 08:20:41'),
(85, 'name.4ed@mail-analyzer.com', '6', NULL, '2021-11-25 16:01:56', '2021-11-25 16:01:56'),
(86, 'tester.f31@mail-analyzer.com', '7', NULL, '2021-11-25 16:08:33', '2021-11-25 16:08:33'),
(87, 'jbcfwpp398@mail-analyzer.com', NULL, NULL, '2021-11-26 11:01:41', '2021-11-26 11:01:41'),
(88, 'yakov.4e6@mail-analyzer.com', '8', NULL, '2021-11-26 11:27:07', '2021-11-26 11:27:07'),
(89, 'yakov.5f3@mail-analyzer.com', '9', NULL, '2021-11-26 11:29:09', '2021-11-26 11:29:09'),
(90, 'yakov.7a0@mail-analyzer.com', '10', NULL, '2021-11-26 12:14:18', '2021-11-26 12:14:18'),
(91, 'fptpboc068@mail-analyzer.com', NULL, NULL, '2021-11-26 12:21:32', '2021-11-26 12:21:32'),
(92, 'yakov.f49@mail-analyzer.com', '11', NULL, '2021-11-26 12:37:49', '2021-11-26 12:37:49'),
(93, 'dkczast639@mail-analyzer.com', NULL, NULL, '2021-11-26 14:53:27', '2021-11-26 14:53:27'),
(94, 'yakov.39e@mail-analyzer.com', '12', NULL, '2021-11-26 14:56:33', '2021-11-26 14:56:33'),
(95, 'wavgkzd191@mail-analyzer.com', NULL, NULL, '2021-11-26 17:41:34', '2021-11-26 17:41:34'),
(96, 'ppdiaxk347@mail-analyzer.com', NULL, NULL, '2021-11-28 08:13:15', '2021-11-28 08:13:15'),
(97, 'iuraaop330@mail-analyzer.com', NULL, NULL, '2021-11-29 00:26:13', '2021-11-29 00:26:13'),
(98, 'agfxwxs004@mail-analyzer.com', NULL, NULL, '2021-11-29 00:43:04', '2021-11-29 00:43:04'),
(99, 'eeciqpp009@mail-analyzer.com', NULL, NULL, '2021-11-29 03:29:35', '2021-11-29 03:29:35'),
(100, 'gztkolz898@mail-analyzer.com', NULL, NULL, '2021-11-29 04:40:27', '2021-11-29 04:40:27'),
(101, 'eioaxdq480@mail-analyzer.com', NULL, NULL, '2021-11-29 04:40:28', '2021-11-29 04:40:28'),
(102, 'cjpuzmm131@mail-analyzer.com', NULL, NULL, '2021-11-29 04:42:13', '2021-11-29 04:42:13');

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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avater`, `remember_token`, `mode`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'tona@test.com', NULL, '$2y$10$zDng43jKGGm/cDETTgSASOHVkVl40IyUw4RvsdUIVK0PeKcXp8OXe', 'admin', 'uploads/avatar-place.png', '8F0uqmBVfbi1CRlpyn5ocOttHoHsDfCGwtZPYnD1cFDw3a8CLEtJB190d3Kt', 'active', '2021-11-11 06:10:43', '2021-11-11 05:10:43'),
(2, 'user', 'tona@mail-analyzer.com', NULL, '$2y$10$zDng43jKGGm/cDETTgSASOHVkVl40IyUw4RvsdUIVK0PeKcXp8OXe', 'user', 'uploads/avatar-place.png', 'Vsp8nfDkUeGdwCh7vabLIAGJ0Yyr1Q2QWyUqqgEJVB0m79Ic6HsMuG9s8j2m', 'active', NULL, NULL),
(3, 'yakov', 'yasha3651@mail.ru', NULL, '$2y$10$qMuwA0LFLAopq5Egf7srgOwGx82v1TebvDoqggXuBfBEn.lOvj5zu', 'user', NULL, 'IUTI9IaGG3sLIyprb0CjwM7dfVzMBtAfWf9C8qZYLlANuE8SGde3dl4LeF7x', 'active', '2021-11-19 06:54:52', '2021-11-19 05:54:52'),
(6, 'name', 'samir@test.com', NULL, '$2y$10$gsZF/GdgIvLugzZsBRyhuOI28OjCFudXP3eTJwoQEWvYXQYTKPZt.', 'user', NULL, NULL, 'active', '2021-11-25 17:01:56', '2021-11-25 16:01:56'),
(7, 'tester', 'tester@test.com', NULL, '$2y$10$73yyuZMdBDs496FOQ24zIO7kvXEobSpuNtyEzT/3tBCJ.BiApJ4I6', 'user', NULL, NULL, 'active', '2021-11-25 17:08:33', '2021-11-25 16:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_ip` varchar(20) CHARACTER SET ascii NOT NULL,
  `test_count` int(11) NOT NULL DEFAULT 0,
  `test_email` varchar(100) CHARACTER SET ascii DEFAULT NULL,
  `mail_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `user_ip`, `test_count`, `test_email`, `mail_id`, `created_at`, `updated_at`) VALUES
(2, '95.19.4.3', 6, 'ffzaimu155@mail-analyzer.com', 11, '2021-11-24 01:04:48', '2021-11-24 00:05:23'),
(4, '176.122.27.79', 2, 'yakov.757@mail-analyzer.com', 11, '2021-11-24 01:07:11', '2021-11-24 00:07:46'),
(5, '176.122.27.79', 2, 'yakov.757@mail-analyzer.com', 8, '2021-11-25 09:12:19', '2021-11-25 08:12:22'),
(6, '95.19.4.3', 13, 'ffzaimu155@mail-analyzer.com', 15, '2021-11-25 12:03:09', '2021-11-25 15:02:21'),
(7, '95.19.4.3', 10, 'tester.f31@mail-analyzer.com', 17, '2021-11-25 19:42:18', '2021-11-26 18:38:51'),
(8, '95.19.4.3', 14, 'tester.f31@mail-analyzer.com', 18, '2021-11-26 19:39:13', '2021-11-29 04:40:00'),
(9, '95.19.4.3', 3, 'tester.f31@mail-analyzer.com', 22, '2021-11-29 05:40:33', '2021-11-29 05:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `white_labels`
--

CREATE TABLE `white_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) CHARACTER SET ascii NOT NULL,
  `css` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `descripttion` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `white_labels`
--
ALTER TABLE `white_labels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `translates`
--
ALTER TABLE `translates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `trash_mails`
--
ALTER TABLE `trash_mails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `white_labels`
--
ALTER TABLE `white_labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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

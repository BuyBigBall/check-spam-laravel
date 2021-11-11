/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.20-MariaDB : Database - trash_mail
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`trash_mail` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `trash_mail`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `features` */

DROP TABLE IF EXISTS `features`;

CREATE TABLE `features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `features` */

insert  into `features`(`id`,`icon`,`title`,`description`,`lang`,`created_at`,`updated_at`) values 
(1,'<i class=\"fas fa-user-shield\"></i>','100% Safe','Protect your privacy by not allowing spam in your personal inbox','en','2021-08-30 13:08:27','2021-08-30 13:08:27'),
(2,'<i class=\"fas fa-envelope-open-text\"></i>','Simple & Free','Create temp emails fast simple steps & always free','en','2021-08-30 13:10:43','2021-08-30 13:10:43'),
(3,'<i class=\"fas fa-globe-europe\"></i>','Worldwide','Used by professionals all around the world , try it now','en','2021-08-30 13:12:56','2021-08-30 13:12:56'),
(4,'<i class=\"fas fa-envelope-open-text\"></i>','بسيط ومجاني','أنشئ رسائل بريد إلكتروني مؤقتة بخطوات بسيطة وسريعة ومجانية دائمًا','ar','2021-09-17 03:38:39','2021-09-17 04:44:04'),
(5,'<i class=\"fas fa-globe-europe\"></i>','عالمي','يستخدمه المحترفون في جميع أنحاء العالم ، جربه الآن','ar','2021-09-17 04:42:46','2021-09-18 21:50:27'),
(6,'<i class=\"fas fa-envelope-open-text\"></i>','100% أمان','حماية خصوصيتك و عدم السماح للبريد العشوائي في صندوق الوارد الشخصي','ar','2021-09-17 04:43:58','2021-09-18 21:52:39');

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `languages` */

insert  into `languages`(`id`,`name`,`code`,`rtl`,`created_at`,`updated_at`) values 
(1,'EN','en',0,NULL,NULL),
(2,'AR','ar',1,NULL,NULL);

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postion` int(11) NOT NULL DEFAULT 0,
  `target` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menus` */

insert  into `menus`(`id`,`icon`,`title`,`url`,`postion`,`target`,`created_at`,`updated_at`) values 
(1,'','Buy Now','https://1.envato.market/DV302n',0,1,'2021-11-02 05:31:37','2021-11-02 05:33:24'),
(2,'<i class=\"fab fa-facebook-f\"></i>',NULL,'https://lobage.com/',0,1,'2021-11-02 05:32:06','2021-11-02 05:32:06');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(7,'2021_07_02_152029_create_settings_table',1),
(8,'2021_07_07_030945_create_trash_mails_table',1),
(9,'2021_08_11_214002_create_features_table',2),
(10,'2021_08_12_171504_create_translates_table',3),
(11,'2021_08_26_203701_create_statistics_table',4),
(12,'2021_06_29_203211_create_categories_table',5),
(13,'2021_06_30_203023_create_posts_table',5),
(14,'2021_06_29_203100_create_pages_table',6);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pages` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`key`,`value`,`created_at`,`updated_at`) values 
(1,'name','Trash Mail',NULL,'2021-11-11 06:10:15'),
(2,'site_url','http://localhost',NULL,'2021-11-11 06:10:15'),
(3,'site_logo','/uploads/logo.png',NULL,'2021-08-30 11:26:57'),
(4,'favicon','/uploads/favicon.png',NULL,'2021-08-30 12:08:43'),
(5,'imap_host',NULL,NULL,'2021-09-02 05:56:39'),
(6,'imap_user',NULL,NULL,'2021-09-02 04:02:32'),
(7,'imap_pass',NULL,NULL,'2021-09-02 04:02:32'),
(8,'domains',NULL,NULL,'2021-09-02 04:02:32'),
(9,'premium_domains',NULL,NULL,'2021-08-15 04:28:25'),
(10,'forbidden_id','admin',NULL,'2021-08-30 11:49:48'),
(11,'allowed_files','doc,docx,xls,xlsx,ppt,pptx,xps,pdf,dxf,ai,psd,eps,ps,svg,ttf,zip,rar,tar,gzip,mp3,mpeg,wav,ogg,jpeg,jpg,png,gif,bmp,tif,webm,mpeg4,3gpp,mov,avi,mpegs,wmv,flx',NULL,'2021-09-02 04:41:16'),
(12,'fetch_time','20',NULL,'2021-09-02 03:24:03'),
(13,'email_lifetime','5',NULL,'2021-08-30 11:49:48'),
(14,'description',NULL,NULL,'2021-08-27 03:02:50'),
(15,'keywords',NULL,NULL,'2021-08-27 03:02:50'),
(16,'google_analytics_code',NULL,NULL,'2021-08-26 20:42:52'),
(17,'enable_blog','0',NULL,'2021-08-30 12:07:43'),
(18,'popular_posts','6',NULL,'2021-08-30 12:07:43'),
(19,'max_posts','6',NULL,'2021-08-30 12:07:43'),
(20,'disqus',NULL,NULL,'2021-08-31 13:29:05'),
(21,'top_ad','<center><img src=\'https://via.placeholder.com/720x90\'></center>',NULL,'2021-08-31 13:00:37'),
(22,'bottom_ad','<center><img src=\'https://via.placeholder.com/720x90\'></center>',NULL,'2021-08-31 13:01:24'),
(23,'right_ad','<center><img src=\'https://via.placeholder.com/200x600\'></center>',NULL,'2021-08-31 13:01:24'),
(24,'left_ad','<center><img src=\'https://via.placeholder.com/200x600\'></center>',NULL,'2021-08-31 13:01:24'),
(25,'head_ad',NULL,NULL,'2021-08-26 20:42:42'),
(26,'sidebar_ad','<center><img src=\'https://via.placeholder.com/350x350\'></center>',NULL,'2021-08-31 13:01:24'),
(27,'main_color','#161a1d',NULL,'2021-08-30 11:15:13'),
(28,'secondary_color','#00af91',NULL,'2021-08-30 11:15:13'),
(29,'MAIL_MAILER','smtp',NULL,'2021-08-31 06:33:44'),
(30,'MAIL_HOST',NULL,NULL,'2021-08-31 07:56:22'),
(31,'MAIL_PORT','465',NULL,'2021-08-31 07:09:47'),
(32,'MAIL_USERNAME',NULL,NULL,'2021-08-31 07:56:23'),
(33,'MAIL_PASSWORD',NULL,NULL,'2021-08-31 07:56:23'),
(34,'MAIL_ENCRYPTION','tls',NULL,'2021-08-31 06:56:02'),
(35,'MAIL_FROM_ADDRESS',NULL,NULL,'2021-08-31 07:56:23'),
(36,'emails_created','0',NULL,'2021-08-30 12:31:30'),
(37,'messages_received','0',NULL,'2021-08-30 12:31:30'),
(38,'total_emails_created','0',NULL,'2021-09-02 04:51:14'),
(39,'total_messages_received','0',NULL,'2021-08-31 12:26:27'),
(40,'facebook','#trashmails',NULL,'2021-08-30 12:07:25'),
(41,'instagram','#trashmails',NULL,'2021-08-30 12:07:25'),
(42,'youtube','#trashmails',NULL,'2021-08-30 12:07:25'),
(43,'twitter','#trashmails',NULL,'2021-08-30 12:07:25'),
(44,'chrome_extensions','#',NULL,'2021-08-30 12:07:25'),
(45,'mozilla_extensions','#',NULL,'2021-08-30 12:07:25'),
(46,'playstore','#',NULL,'2021-08-30 12:07:25'),
(47,'appstore','#',NULL,'2021-08-30 12:07:25'),
(48,'MAIL_TO_ADDRESS',NULL,NULL,'2021-08-31 07:56:23'),
(49,'imap_port','993',NULL,'2021-09-02 05:56:39'),
(50,'imap_encryption','ssl',NULL,'2021-09-02 06:00:22'),
(51,'imap_certificate','1',NULL,'2021-09-02 05:59:14'),
(52,'lang','en',NULL,NULL),
(53,'google_tag_manager',NULL,NULL,NULL),
(54,'RECAPTCHA_SECRET_KEY',NULL,NULL,NULL),
(55,'RECAPTCHA_SITE_KEY',NULL,NULL,NULL),
(56,'COOKIE_CONSENT_ENABLED','1',NULL,NULL),
(57,'https_force','0',NULL,NULL),
(58,'email_lifetime_type','1440',NULL,NULL),
(59,'custom_tags',NULL,NULL,NULL),
(60,'separator','|',NULL,NULL),
(61,'og_image','uploads/cover.png',NULL,NULL);

/*Table structure for table `statistics` */

DROP TABLE IF EXISTS `statistics`;

CREATE TABLE `statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `statistics` */

insert  into `statistics`(`id`,`key`,`value`,`created_at`,`updated_at`) values 
(1,'total_email_pay_day','0','2021-11-10 06:10:42','2021-11-11 06:10:42'),
(2,'total_messges_pay_day','0','2021-11-10 06:10:42','2021-11-11 06:10:42'),
(3,'total_email_pay_day','0','2021-11-09 06:10:42','2021-11-11 06:10:42'),
(4,'total_messges_pay_day','0','2021-11-09 06:10:42','2021-11-11 06:10:42'),
(5,'total_email_pay_day','0','2021-11-08 06:10:42','2021-11-11 06:10:42'),
(6,'total_messges_pay_day','0','2021-11-08 06:10:42','2021-11-11 06:10:42'),
(7,'total_email_pay_day','0','2021-11-07 06:10:42','2021-11-11 06:10:42'),
(8,'total_messges_pay_day','0','2021-11-07 06:10:43','2021-11-11 06:10:43'),
(9,'total_email_pay_day','0','2021-11-06 06:10:43','2021-11-11 06:10:43'),
(10,'total_messges_pay_day','0','2021-11-06 06:10:43','2021-11-11 06:10:43'),
(11,'total_email_pay_day','0','2021-11-05 06:10:43','2021-11-11 06:10:43'),
(12,'total_messges_pay_day','0','2021-11-05 06:10:43','2021-11-11 06:10:43');

/*Table structure for table `translates` */

DROP TABLE IF EXISTS `translates`;

CREATE TABLE `translates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `translates` */

insert  into `translates`(`id`,`lang`,`key`,`value`,`collection`,`created_at`,`updated_at`) values 
(1,'en','Mailbox Small Title','Your Temporary Email Address','general',NULL,'2021-09-14 05:25:59'),
(2,'en','Mailbox Description','Forget about spam, advertising mailings, hacking and attacking robots. Keep your real mailbox clean and secure. Temp Mail provides temporary, secure, anonymous, free, disposable email address.','general',NULL,'2021-09-14 05:25:59'),
(3,'en','Refresh','Refresh','general',NULL,'2021-09-14 05:25:59'),
(4,'en','Change','Change','general',NULL,'2021-09-14 05:25:59'),
(5,'en','Delete','Delete','general',NULL,'2021-09-14 05:25:59'),
(6,'en','Sender','Sender','general',NULL,'2021-09-14 05:25:59'),
(7,'en','Subject','Subject','general',NULL,'2021-09-14 05:25:59'),
(8,'en','View','View','general',NULL,'2021-09-14 05:25:59'),
(9,'en','Your inbox is empty','Your inbox is empty','general',NULL,'2021-09-14 05:25:59'),
(10,'en','Waiting for incoming emails','Waiting for incoming emails','general',NULL,'2021-09-14 05:25:59'),
(11,'en','Awesome Features','Awesome Features','general',NULL,'2021-09-14 05:25:59'),
(12,'en','Features Description','Disposable temporary email protects your real email address from spam, advertising mailings, malwares.','general',NULL,'2021-09-14 05:25:59'),
(13,'en','Popular Posts','Popular Posts','general',NULL,'2021-09-14 05:25:59'),
(14,'en','Back To List','Back To List','general',NULL,'2021-09-14 05:25:59'),
(15,'en','Attachments','Attachments','general',NULL,'2021-09-14 05:25:59'),
(16,'en','Copyright','Copyright ©2021 - TrashMails','general',NULL,'2021-09-14 05:25:59'),
(17,'en','Blog','Blog','general',NULL,'2021-09-14 05:25:59'),
(18,'en','Categories','Categories','general',NULL,'2021-09-14 05:26:00'),
(19,'en','Leave a Reply','Leave a Reply','general',NULL,'2021-09-14 05:26:00'),
(20,'en','Change E-mail Address','Change E-mail Address','general',NULL,'2021-09-14 05:26:00'),
(21,'en','Change Description','<b>Trash Mails</b> provides the ability to change your temporary email address on this page. <br> <br> To change or recover the email address, please enter the desired E-mail address and choose domain.','general',NULL,'2021-09-14 05:26:00'),
(22,'en','Contact Us','Contact Us','general',NULL,'2021-09-14 05:26:00'),
(23,'en','Contact Description','We’re here to help and answer any question you might have. <br> We look forward to hearing from you ?','general',NULL,'2021-09-14 05:26:00'),
(24,'en','Emails Created','Emails Created','general',NULL,'2021-09-14 05:26:00'),
(25,'en','Messages Received','Messages Received','general',NULL,'2021-09-14 05:26:00'),
(26,'en','Cookie Message','Your experience on this site will be improved by allowing cookies.','general',NULL,'2021-09-14 05:26:00'),
(27,'en','Cookie Button','Allow cookies','general',NULL,'2021-09-14 05:26:00'),
(29,'en','Change Email','Change Email','general','2021-09-14 06:33:28','2021-09-14 06:34:44'),
(30,'en','INBOX','INBOX','general','2021-09-17 01:41:58','2021-09-17 01:41:58'),
(31,'en','We will add a contact from as soon as possible','We will add a contact from as soon as possible','general','2021-09-17 01:42:47','2021-09-17 01:42:47'),
(32,'en','Enter Your Mail!','Enter Your Mail!','general','2021-09-17 01:43:09','2021-09-17 01:43:09'),
(33,'en','Published in','Published in','general','2021-09-17 01:44:40','2021-09-17 01:44:40'),
(34,'en','Date','Date','general','2021-09-17 01:45:57','2021-09-17 01:45:57'),
(35,'en','The address you have chosen is already in use. Please choose a different one.','The address you have chosen is already in use. Please choose a different one.','general','2021-09-17 01:51:41','2021-09-17 01:51:41'),
(36,'en','Your Name','Your Name','general','2021-09-17 01:57:24','2021-09-17 01:57:24'),
(37,'en','Your Email','Your Email','general','2021-09-17 01:57:24','2021-09-17 01:57:24'),
(38,'en','Your Phone','Your Phone','general','2021-09-17 01:57:24','2021-09-17 01:57:24'),
(39,'en','Your Message','Your Message','general','2021-09-17 01:57:24','2021-09-17 01:57:24'),
(40,'en','Send Message','Send Message','general','2021-09-17 01:57:24','2021-09-17 01:57:24'),
(41,'en','We have received your message and would like to thank you for writing to us.','We have received your message and would like to thank you for writing to us.','general','2021-09-17 01:57:56','2021-09-17 01:57:56'),
(42,'en','Not Found','Not Found','general','2021-09-17 02:24:13','2021-09-17 02:24:13'),
(43,'en','Page Not Found','Page Not Found','general','2021-09-17 02:24:13','2021-09-17 02:24:13'),
(44,'en','We are sorry but the page you are looking for was not found','We are sorry but the page you are looking for was not found','general','2021-09-17 02:24:13','2021-09-17 02:24:13'),
(45,'en','Back to Home','Back to Home','general','2021-09-17 02:24:13','2021-09-17 02:24:13'),
(46,'en','Unauthorised','Unauthorised','general','2021-09-17 02:24:38','2021-09-17 02:24:38'),
(47,'en','Forbidden','Forbidden','general','2021-09-17 02:24:50','2021-09-17 02:24:50'),
(48,'en','Method Not Allowed','Method Not Allowed','general','2021-09-17 02:25:00','2021-09-17 02:25:00'),
(49,'en','Something is broken. Please let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.','Something is broken. Please let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.','general','2021-09-17 02:25:00','2021-09-17 02:25:00'),
(50,'en','Page Expired','Page Expired','general','2021-09-17 02:25:11','2021-09-17 02:25:11'),
(51,'en','Too Many Requests','Too Many Requests','general','2021-09-17 02:25:16','2021-09-17 02:25:16'),
(52,'en','Internal Server Error','Internal Server Error','general','2021-09-17 02:25:25','2021-09-17 02:25:25'),
(53,'en','Oops… You just found an error page','Oops… You just found an error page','general','2021-09-17 02:25:25','2021-09-17 02:25:25'),
(54,'en','We are sorry but our server encountered an internal error','We are sorry but our server encountered an internal error','general','2021-09-17 02:25:25','2021-09-17 02:25:25'),
(55,'en','Service Unavailable','Service Unavailable','general','2021-09-17 02:25:36','2021-09-17 02:25:36'),
(56,'ar','Mailbox Small Title','بريدك الإلكتروني المؤقت','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(57,'ar','Mailbox Description','تخلص الآن من الرسائل المتطفلة ورسائل الاعلانات و الاختراقات والهجوم الآلي. أبقى صندوق البريد الخاص بك نظيفا وآمنا. Temp Mail يزودك بعنوان بريد الكتروني آمن ومؤقت ومجاني ومجهول ويمكنك التخلص منه في أي وقت','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(58,'ar','Refresh','تحديث','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(59,'ar','Change','تغيير','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(60,'ar','Delete','إحذف','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(61,'ar','Sender','المرسل','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(62,'ar','Subject','الموضوع','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(63,'ar','View','مشاهدة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(64,'ar','Your inbox is empty','صندوق الوارد الخاص بك فارغ','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(65,'ar','Waiting for incoming emails','في انتظار رسائل البريد الإلكتروني الواردة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(66,'ar','Awesome Features','ميزات رائعة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(67,'ar','Features Description','يحمي البريد الإلكتروني المؤقت الذي يمكن التخلص منه عنوان بريدك الإلكتروني الحقيقي من البريد العشوائي والمراسلات الإعلانية والبرامج الضارة.','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(68,'ar','Popular Posts','مقالات شائعة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(69,'ar','Back To List','الرجوع للقائمة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(70,'ar','Attachments','مرفقات','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(71,'ar','Copyright','جميع الحقوق محفوضة 2021 - TrashMails','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(72,'ar','Blog','مدونة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(73,'ar','Categories','الاقسام','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(74,'ar','Leave a Reply','اترك تعليقا','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(75,'ar','Change E-mail Address','قم بتغير البريد الالكتروني','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(76,'ar','Change Description','لتغير عنوان البريد الإلكتروني، يرجى ادخال عنوان البريد الالكتروني الذي ترغب به ومن ثم أنقر على حفظ.','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(77,'ar','Contact Us','اتصل بنا','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(78,'ar','Contact Description','نحن هنا للمساعدة والإجابة على أي سؤال قد يكون لديك.','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(79,'ar','Emails Created','عدد الإيميلات المؤقتة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(80,'ar','Messages Received','عدد الرسائل المستقبلة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(81,'ar','Cookie Message','سيتم تحسين تجربتك على هذا الموقع من خلال السماح بملفات تعريف الارتباط.','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(82,'ar','Cookie Button','السماح','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(84,'ar','Change Email','تغيير','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(85,'ar','INBOX','صندوق الواردات','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(86,'ar','We will add a contact from as soon as possible','سوف نضيف وسائل الاتصال في اقرب وقت ممكن','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(87,'ar','Enter Your Mail!','اسم الذي تريده','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(88,'ar','Published in','نشر في','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(89,'ar','Date','تاريخ','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(90,'ar','The address you have chosen is already in use. Please choose a different one.','الاسم الذي اذخلته مستعمل من قبل , الرجاء استخدم عنوان مختلف','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(91,'ar','Your Name','الاسم الكامل','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(92,'ar','Your Email','بريدك الالكتوني','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(93,'ar','Your Phone','رقم الهاتف','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(94,'ar','Your Message','الرسالة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(95,'ar','Send Message','ارسل','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(96,'ar','We have received your message and would like to thank you for writing to us.','لقد تلقينا رسالتك ونود أن نشكرك على مراسلتنا.','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(97,'ar','Not Found','الصفحة غير موجودة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(98,'ar','Page Not Found','الصفحة غير موجودة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(99,'ar','We are sorry but the page you are looking for was not found','نحن آسفون ولكن الصفحة التي تبحث عنها لم يتم العثور عليها','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(100,'ar','Back to Home','العودة إلى الرئسية','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(101,'ar','Unauthorised','غير مصرح','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(102,'ar','Forbidden','ممنوع الذخول الى هده الصفحة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(103,'ar','Method Not Allowed','طريقة غير مسموحة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(104,'ar','Something is broken. Please let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.','شيء ما مكسور. الرجاء إخبارنا بما كنت تفعله عندما حدث هذا الخطأ. ونحن سوف إصلاحه في أقرب وقت ممكن. اعتذر على أي ازعاج حدث.','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(105,'ar','Page Expired','انتهت صلاحية الرابط','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(106,'ar','Too Many Requests','طلبات كثيرة جدا','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(107,'ar','Internal Server Error','خطأ في الخادم الداخلي','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(108,'ar','Oops… You just found an error page','عفوًا ... لقد عثرت للتو على صفحة خطأ','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(109,'ar','We are sorry but our server encountered an internal error','نحن آسفون ولكن خادمنا واجه خطأ داخلي','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(110,'ar','Service Unavailable','الخدمة غير متوفرة','general','2021-09-17 02:41:04','2021-09-17 02:56:02'),
(111,'en','Default Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(112,'ar','Default Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(113,'en','Default Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(114,'ar','Default Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(115,'en','Default keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(116,'ar','Default keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(117,'en','Home Page Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(118,'ar','Home Page Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(119,'en','Home Page Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(120,'ar','Home Page Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(121,'en','Home Page keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(122,'ar','Home Page keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(123,'en','Change Page Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(124,'ar','Change Page Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(125,'en','Change Page Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(126,'ar','Change Page Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(127,'en','Change Page keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(128,'ar','Change Page keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(129,'en','Blog Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(130,'ar','Blog Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(131,'en','Blog Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(132,'ar','Blog Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(133,'en','Blog keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(134,'ar','Blog keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(135,'en','Contact Page Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(136,'ar','Contact Page Title',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(137,'en','Contact Page Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(138,'ar','Contact Page Description',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(139,'en','Contact Page keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(140,'ar','Contact Page keywords',NULL,'seo','2021-11-02 09:03:52','2021-11-02 09:03:52'),
(141,'en','Homepage Title',NULL,'general','2021-11-11 06:11:15','2021-11-11 06:11:15'),
(142,'ar','Homepage Title',NULL,'general','2021-11-11 06:11:15','2021-11-11 06:11:15'),
(143,'en','Click To Copy!',NULL,'general','2021-11-11 06:11:15','2021-11-11 06:11:15'),
(144,'ar','Click To Copy!',NULL,'general','2021-11-11 06:11:15','2021-11-11 06:11:15'),
(145,'en','Copied!',NULL,'general','2021-11-11 06:11:15','2021-11-11 06:11:15'),
(146,'ar','Copied!',NULL,'general','2021-11-11 06:11:15','2021-11-11 06:11:15');

/*Table structure for table `trash_mails` */

DROP TABLE IF EXISTS `trash_mails`;

CREATE TABLE `trash_mails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_in` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trash_mails` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avater` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`avater`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin Admin','tona@test.com',NULL,'$2y$10$zDng43jKGGm/cDETTgSASOHVkVl40IyUw4RvsdUIVK0PeKcXp8OXe','admin','uploads/avatar-place.png',NULL,'2021-11-11 06:10:43','2021-11-11 06:10:43');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

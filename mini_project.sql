-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2024 at 11:07 AM
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
-- Database: `mini_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
(2, 'Pinewood', 'pinewood', NULL, NULL),
(6, 'Tips and Tricks', 'tips-and-tricks', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blogcat_id` int(11) NOT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_slug` varchar(255) DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `long_descp` text DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `blogcat_id`, `post_title`, `post_slug`, `post_image`, `long_descp`, `post_tags`, `created_at`, `updated_at`) VALUES
(7, 2, 'Demo Blogs', 'demo-blogs', 'upload/post/1816119088863521.png', '<p>12312312312</p>', 'jQuery', '2024-11-18 20:15:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `board_config_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `board_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `name`, `board_config_id`, `title`, `desc`, `start_date`, `photo`, `status`, `board_slug`, `created_at`, `updated_at`) VALUES
(1, 'ConsumerX', 1, 'Development team', '123123', '2024-08-22', 'upload/board/1810328754817363.PNG', 1, 'development-board', '2024-08-22 15:33:23', '2024-09-16 05:20:37'),
(5, 'Sri Team', 4, 'Regression Team', '1231312', '2024-09-16', 'upload/board/1810328727401961.PNG', 1, 'regression-board', '2024-09-16 02:47:20', '2024-09-16 05:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `board_configs`
--

CREATE TABLE `board_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `team` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `jira_id` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `jira_summary` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `working_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `ticket_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `link_to_result` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `test_plan` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `sprint` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `note` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `priority` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `environment` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `isSubBug` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_1` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_2` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_3` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_4` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_5` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `pass` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `fail` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jira_url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_configs`
--

INSERT INTO `board_configs` (`id`, `board_id`, `team`, `type`, `jira_id`, `jira_summary`, `working_status`, `ticket_status`, `link_to_result`, `test_plan`, `sprint`, `note`, `priority`, `environment`, `isSubBug`, `tester_1`, `tester_2`, `tester_3`, `tester_4`, `tester_5`, `pass`, `fail`, `created_at`, `updated_at`, `jira_url`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, '2024-08-22 15:57:58', '2024-11-14 08:56:39', 'https://jira.sonos.com/browse/'),
(2, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, '2024-09-12 15:00:36', NULL, 'jira.com'),
(3, 4, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, '2024-09-12 15:03:37', '2024-09-12 15:03:47', 'jira.com'),
(4, 5, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2024-09-16 02:47:20', '2024-11-18 09:59:30', 'https://jira.sonos.com/browse/'),
(5, 6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, '2024-09-16 05:23:20', NULL, 'jira.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Training New Member', 'training-new-member', 'upload/category/1811948058486368.png', NULL, '2024-10-03 19:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `task_id`, `created_at`, `updated_at`) VALUES
(1, 'demo', 2, 29, '2024-10-01 03:36:47', NULL),
(2, 'demoadiaodadas', 2, 29, '2024-10-01 03:38:05', NULL),
(3, '13123123112', 2, 29, '2024-10-01 04:10:36', NULL),
(4, 'demo', 2, 29, '2024-10-01 04:10:42', NULL),
(5, 'This bug is not valid', 2, 29, '2024-10-01 04:14:16', NULL),
(6, 'this bug is not valid', 2, 29, '2024-10-01 04:14:26', NULL),
(7, 'alo', 7, 29, '2024-10-01 04:15:41', NULL),
(8, 'alo', 7, 29, '2024-10-01 04:15:55', NULL),
(9, 'cai chi', 2, 29, '2024-10-01 04:16:27', NULL),
(10, 'sss', 7, 29, '2024-10-01 04:16:35', NULL),
(11, '1312312312', 2, 29, '2024-10-01 04:16:59', NULL),
(12, 'This bug is not valid', 2, 29, '2024-10-01 04:21:42', NULL),
(13, 'This bug is not valid', 2, 29, '2024-10-01 04:35:40', NULL),
(14, 'asdasdas', 2, 29, '2024-10-01 04:35:43', NULL),
(15, 'This bug is not valid', 2, 30, '2024-10-01 08:58:58', NULL),
(16, 'demo', 2, 30, '2024-10-01 08:59:16', NULL),
(17, 'This one should include Tai Ngo', 2, 29, '2024-10-01 09:22:44', NULL),
(18, 'Missing Build, Env', 2, 29, '2024-10-01 09:23:30', NULL),
(19, 'This bug is not valid', 2, 27, '2024-10-02 06:56:10', NULL),
(20, 'This bug is not valid', 2, 14, '2024-10-02 08:13:33', NULL),
(21, 'demo', 2, 32, '2024-10-03 03:32:32', NULL),
(22, 'this bug is not valid', 7, 32, '2024-10-03 03:39:35', NULL),
(23, 'haizzz', 2, 32, '2024-10-03 04:09:56', NULL),
(24, 'Need to add more build info', 2, 33, '2024-10-03 08:54:02', NULL),
(25, 'I dont care', 5, 33, '2024-10-03 08:54:20', NULL),
(26, 'asdjkhaskjdhsakjdas', 5, 33, '2024-10-03 08:54:50', NULL),
(27, 'demo', 2, 43, '2024-10-04 03:52:26', NULL),
(28, 'demio', 2, 145, '2024-11-18 09:23:44', NULL),
(29, 'This bug is not valid', 1, 157, '2024-11-19 03:08:19', NULL),
(30, 'This bug is not valid', 1, 161, '2024-11-19 03:12:30', NULL),
(31, 'abc', 21, 335, '2024-11-26 06:28:17', NULL),
(32, 'hello a Cảnh', 1, 393, '2024-11-27 10:30:27', NULL),
(33, 'ttesttt', 7, 435, '2024-11-28 04:41:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_image` varchar(255) DEFAULT NULL,
  `course_title` text DEFAULT NULL,
  `course_name` text DEFAULT NULL,
  `course_name_slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `resources` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `prerequisites` text DEFAULT NULL,
  `bestseller` varchar(255) DEFAULT NULL,
  `featured` varchar(255) DEFAULT NULL,
  `highestrated` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `subcategory_id`, `instructor_id`, `course_image`, `course_title`, `course_name`, `course_name_slug`, `description`, `video`, `label`, `duration`, `resources`, `certificate`, `selling_price`, `discount_price`, `prerequisites`, `bestseller`, `featured`, `highestrated`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'upload/course/thambnail/1811948440875688.png', 'Training new employee', 'Training', 'training', '<h1 class=\"css-uuujgc e1tiznh50\" data-testid=\"article-title\">How to train new employees (with instructions and examples)</h1>\r\n<div class=\"css-k0ncke e37uo190\">\r\n<div class=\"css-1g1yaxl e37uo190\">\r\n<div class=\"css-bq7azf e37uo190\">\r\n<div class=\"css-1afmp4o e37uo190\"><span class=\"css-1daopvz e1wnkr790\">Written by</span>\r\n<div class=\"css-1lx6njj e37uo190\" data-testid=\"article-author-popover\">\r\n<div class=\"css-1afmp4o e37uo190\"><button class=\"css-1cn25hi e8ju0x50\" type=\"button\" aria-haspopup=\"dialog\" data-testid=\"article-author\" aria-expanded=\"false\">Indeed Editorial Team</button></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"css-bq7azf e37uo190\">&nbsp;</div>\r\n<p class=\"css-zl2cti e1wnkr790\" data-testid=\"article-date-line\">Updated 28 August 2023</p>\r\n</div>\r\n</div>\r\n<p><span id=\"main-content-start\"></span></p>\r\n<div class=\"css-1g9mw2i eu4oa1w0\">&nbsp;</div>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Managers play a vital role in the general well-being of their team members. Training is a vital skill for managers of all levels and positions, as it allows you to improve the skill level of your team and improve its output. If you want to be an effective manager and increase the likelihood of retaining team members, learning how to train employees can help. In this article, we explain how to train new employees and why it\'s important for you as a manager or team leader.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\"><span class=\"css-n3w4ap eu4oa1w0\">Related:&nbsp;</span><a class=\"css-1ivu7ag e19afand0\" href=\"https://uk.indeed.com/career-advice/career-development/training-methods\" target=\"_blank\" rel=\"noopener noreferrer\" data-link-type=\"articleContentLink\" data-link-page-type=\"ARTICLE\" data-dd-action-name=\"click: articleContentLink\" aria-label=\"What are common workplace training methods? (With tips) (Opens in a new window)\"><span class=\"css-n3w4ap eu4oa1w0\">What are common workplace training methods? (With tips)</span></a></span></p>\r\n<div class=\"css-e4eisq eu4oa1w0\" data-testid=\"mosaic-zone\">\r\n<div id=\"mosaic-inline\" class=\"mosaic-zone\">\r\n<div id=\"mosaic-provider-career-guide-joblist-promo\" class=\"mosaic mosaic-provider-career-guide-joblist-promo mosaic-rst mosaic-provider-hydrated\">\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-1sfkypf e37uo190\">\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-1xp2ryh e37uo190\">\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-12f7u05 e37uo190\"><span class=\"mosaic-provider-career-guide-joblist-promo-1kzc7o8 e1wnkr790\">Related jobs on Indeed</span></div>\r\n</div>\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-157d3ls e37uo190\">\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-1mhvptd e37uo190\"><a class=\"mosaic-provider-career-guide-joblist-promo-f1rsj9 e19afand0\" href=\"https://uk.indeed.com/jobs?cgtk=33d06571-31be-48e8-844c-46658eabc52d&amp;from=careerguidepromo-GB&amp;q=part%20time\" target=\"_blank\" rel=\"noopener\" aria-label=\"View Part-time jobs\">Part-time jobs</a></div>\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-1mhvptd e37uo190\"><a class=\"mosaic-provider-career-guide-joblist-promo-f1rsj9 e19afand0\" href=\"https://uk.indeed.com/jobs?cgtk=33d06571-31be-48e8-844c-46658eabc52d&amp;from=careerguidepromo-GB&amp;q=full%20time\" target=\"_blank\" rel=\"noopener\" aria-label=\"View Full-time jobs\">Full-time jobs</a></div>\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-1mhvptd e37uo190\"><a class=\"mosaic-provider-career-guide-joblist-promo-f1rsj9 e19afand0\" href=\"https://uk.indeed.com/jobs?cgtk=33d06571-31be-48e8-844c-46658eabc52d&amp;from=careerguidepromo-GB&amp;q=remote%20jobs\" target=\"_blank\" rel=\"noopener\" aria-label=\"View Remote jobs\">Remote jobs</a></div>\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-1mhvptd e37uo190\"><a class=\"mosaic-provider-career-guide-joblist-promo-f1rsj9 e19afand0\" href=\"https://uk.indeed.com/jobs?cgtk=33d06571-31be-48e8-844c-46658eabc52d&amp;from=careerguidepromo-GB&amp;q=Urgently%20needed\" target=\"_blank\" rel=\"noopener\" aria-label=\"View Urgently needed jobs\">Urgently needed jobs</a></div>\r\n</div>\r\n<div class=\"mosaic-provider-career-guide-joblist-promo-1bqbbbj eu4oa1w0\"><a id=\"view-more\" class=\"mosaic-provider-career-guide-joblist-promo-60tjpo e19afand0\" title=\"View more jobs on Indeed\" href=\"https://uk.indeed.com/?cgtk=33d06571-31be-48e8-844c-46658eabc52d&amp;from=careerguidepromo-GB\" target=\"_blank\" rel=\"noopener\">View more jobs on Indeed</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<h2 class=\"rich-text-component css-mep417 e1tiznh50\">How to train new employees and why it\'s important</h2>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Learning how to train new employees can increase the likelihood of them being effective in their roles. Good training can have a big impact on their productivity and attitude at work. It can also help to motivate employees and aid in retaining them at the company for a longer duration. As a supervisor or manager, you\'re likely to be responsible for the provision of training. Whether you work in a manual job or an office job, there are many important training considerations to make. If you want to know how to train a new employee, these simple steps can help:</span></p>\r\n<h3 class=\"rich-text-component css-wsn4op e1tiznh50\">1. Set goals</h3>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Some organisations already have a clear training plan for new employees. If the organisation you work for has a structured plan, sit down with your new employee and talk them through it. As you do so, encourage them to raise any concerns that they may have. Once they understand the training plan, you can set goals for them to accomplish throughout the training period. If the company doesn\'t have a set training plan, try to consider what skills and knowledge are most important to being successful in the role. Use this information to create your own goals for the employee.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">It\'s important to provide new employees with a clear list of these goals and the resources they can use to achieve them so they can refer back to them over the training period. This allows employees to gauge their own progress and find solutions to problems themselves. It can also prompt them to reach out when they know they can\'t reach a goal without additional assistance.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\"><span class=\"css-n3w4ap eu4oa1w0\">Related:</span>&nbsp;<a class=\"css-1ivu7ag e19afand0\" href=\"https://uk.indeed.com/career-advice/career-development/objective-vs-goal\" target=\"_blank\" rel=\"noopener noreferrer\" data-link-type=\"articleContentLink\" data-link-page-type=\"ARTICLE\" data-dd-action-name=\"click: articleContentLink\" aria-label=\"Objective vs. goal: what are the key differences? (Opens in a new window)\"><span class=\"css-n3w4ap eu4oa1w0\">Objective vs. goal: what are the key differences?</span></a></span></p>\r\n<h3 class=\"rich-text-component css-wsn4op e1tiznh50\">2. Involve other team members in new staff training</h3>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Training new employees can provide good development opportunities for other senior team members. It can also provide the new employee with perspectives and expertise aside from your own. This frees up more of your time and provides a wider range of people that the new employee can turn to for support. They may feel more comfortable discussing issues or admitting that they don\'t understand something when talking to one of these peers.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Other senior team members may enjoy the opportunity to help with training too. It gives them a chance to develop their leadership and management abilities, which can be helpful later in their careers. It can also prove that they\'re ready for more responsibilities and promotions. Involve them in inductions, deliver training and, where appropriate, ask them to review the new employee\'s work.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\"><span class=\"css-n3w4ap eu4oa1w0\">Related:&nbsp;</span><a class=\"css-1ivu7ag e19afand0\" href=\"https://uk.indeed.com/career-advice/career-development/induction-training\" target=\"_blank\" rel=\"noopener noreferrer\" data-link-type=\"articleContentLink\" data-link-page-type=\"ARTICLE\" data-dd-action-name=\"click: articleContentLink\" aria-label=\"How to create an Induction training programme (Opens in a new window)\"><span class=\"css-n3w4ap eu4oa1w0\">How to create an Induction training programme</span></a></span></p>\r\n<h3 class=\"rich-text-component css-wsn4op e1tiznh50\">3. Encourage feedback from those involved in training a new employee</h3>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Asking senior team members to provide feedback to the new employee is another useful development tool. This kind of feedback means that you develop a more complete picture of the new employee and their performance. New employees may be more likely to relax around peers who are performing similar roles and provide additional insights to those that they provide to you. Feedback from peers may also address smaller issues that might not be obvious to you, like trouble understanding company processes or admin mistakes.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Encouraging feedback can also be a beneficial way of training other members of the team, aside from the new employee. It gives them a chance to practice providing constructive feedback and demonstrates their knowledge and understanding of the role and its requirements.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\"><span class=\"css-n3w4ap eu4oa1w0\">Related:</span>&nbsp;<a class=\"css-1ivu7ag e19afand0\" href=\"https://uk.indeed.com/career-advice/career-development/positive-feedback\" target=\"_blank\" rel=\"noopener noreferrer\" data-link-type=\"articleContentLink\" data-link-page-type=\"ARTICLE\" data-dd-action-name=\"click: articleContentLink\" aria-label=\"Positive feedback: why it\'s important and how to give it (Opens in a new window)\"><span class=\"css-n3w4ap eu4oa1w0\">Positive feedback: why it\'s important and how to give it</span></a></span></p>\r\n<h3 class=\"rich-text-component css-wsn4op e1tiznh50\">4. Give freely of your time</h3>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">New employees are likely to have lots of questions. Depending on their personality, they may feel like a burden if they ask too many. Not asking can lead to them making mistakes and missing out on important learning opportunities. Try to always be available to respond to their questions, even if you\'re busy. It\'s important that your new team members understand that taking the time to solve issues early on can prevent a lot of issues later on. You can also encourage them to direct their questions to other senior or experienced members of the team.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">If this is your first time training new employees, it can be a good learning and personal development experience for you as well. It can improve your patience, tolerance and communication skills. It\'s important that you take the time to praise them where relevant. Publicly acknowledging the contributions they make to the team can also be helpful and can foster positivity from coworkers. Consider the role and decide how often you might want to check in on the new employee to prompt questions and provide feedback.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\"><span class=\"css-n3w4ap eu4oa1w0\">Related:</span>&nbsp;<a class=\"css-1ivu7ag e19afand0\" href=\"https://uk.indeed.com/career-advice/career-development/practicing-gratitude-while-working-remotely\" target=\"_blank\" rel=\"noopener noreferrer\" data-link-type=\"articleContentLink\" data-link-page-type=\"ARTICLE\" data-dd-action-name=\"click: articleContentLink\" aria-label=\"How to practice gratitude while working remotely (Opens in a new window)\"><span class=\"css-n3w4ap eu4oa1w0\">How to practice gratitude while working remotely</span></a></span></p>\r\n<h3 class=\"rich-text-component css-wsn4op e1tiznh50\">5. Make sure they know how to access resources and people</h3>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">It\'s a good idea to provide new employees with a tour of the building when they first arrive. This helps them to understand where all of the facilities are and gives them perspective about the other departments in the company. Try to introduce them to contacts, not just others in your team, but key contacts in HR, the IT team and other important departments that they may communicate with within the first few weeks. Providing an organisation chart can be even more helpful. Onboarding sometimes involves frequent communication with IT professionals, so having a brief face-to-face can help.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Spend time with them to make sure that they have all the right access and can log into the systems you need them to. If these don\'t work, make sure you fix them as quickly as possible and show them how to resolve the issue in future. This helps the new employee feel valued and important, even if it\'s a time-consuming process for you. If you have online or digital training resources, make sure that you highlight these and give an indication of which ones are mandatory and which are optional but useful.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\"><span class=\"css-n3w4ap eu4oa1w0\">Related:&nbsp;</span><a class=\"css-1ivu7ag e19afand0\" href=\"https://uk.indeed.com/career-advice/career-development/welcoming-new-employees\" target=\"_blank\" rel=\"noopener noreferrer\" data-link-type=\"articleContentLink\" data-link-page-type=\"ARTICLE\" data-dd-action-name=\"click: articleContentLink\" aria-label=\"How to welcome new employees (With steps and examples) (Opens in a new window)\"><span class=\"css-n3w4ap eu4oa1w0\">How to welcome new employees (With steps and examples)</span></a></span></p>\r\n<h3 class=\"rich-text-component css-wsn4op e1tiznh50\">6. Have regular update sessions with them</h3>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Regardless of how you decide to teach a new employee, it\'s important to take the time to check up on how they\'re faring. Set regular meetings so they know they can bring issues or questions to you, and you can do the same in return. Asking them how they think they\'re getting on can be a good way to quickly understand their perspective and their personality.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">Try to keep track of the training they have had in the time since your last catch-up session. Ask how these have gone, what they have learnt from these sessions and whether they would like any more opportunities to train in those particular areas. Ask open-ended questions that give them time and space to come to you with problems or uncertainties. Make sure to also keep a record of what you discuss in these sessions so you determine if they\'ve taken feedback seriously. This is particularly important if the company you work for has a probation period.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\"><span class=\"css-n3w4ap eu4oa1w0\">Related:&nbsp;</span><a class=\"css-1ivu7ag e19afand0\" href=\"https://uk.indeed.com/career-advice/career-development/one-on-one-meetings\" target=\"_blank\" rel=\"noopener noreferrer\" data-link-type=\"articleContentLink\" data-link-page-type=\"ARTICLE\" data-dd-action-name=\"click: articleContentLink\" aria-label=\"What are one-on-one meetings? (With benefits and tips) (Opens in a new window)\"><span class=\"css-n3w4ap eu4oa1w0\">What are one-on-one meetings? (With benefits and tips)</span></a></span></p>\r\n<h3 class=\"rich-text-component css-wsn4op e1tiznh50\">7. Make sure they know it\'s OK to go home</h3>\r\n<p><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">One of the biggest challenges a new employee can face is \'presenteeism\'. This occurs when new or existing employees don\'t fully understand their employer\'s expectations, leading them to stay later than required to complete work that could be left for the following day. Try to show them from the start that the organisation values work-life balance. This can be motivational and prevents undue stress on the new employee.</span><span class=\"rich-text-component css-1yjzpiw e1wnkr790\">In some companies, there may be some overtime. This is usually not true for new starters, though. Explain that others in the team might be busy on specific projects but that if they completed their own tasks for the day, there\'s no reason to work overtime. When the time comes when they have a larger workload, new employees are more likely to be ready for it.</span></p>', 'upload/course/video/1728008690.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-10-03 19:24:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_goals`
--

CREATE TABLE `course_goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `goal_name` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_goals`
--

INSERT INTO `course_goals` (`id`, `course_id`, `goal_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Need to learn about ...', '2024-10-03 19:24:50', '2024-10-03 19:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `course_lectures`
--

CREATE TABLE `course_lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `lecture_title` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_lectures`
--

INSERT INTO `course_lectures` (`id`, `course_id`, `section_id`, `lecture_title`, `video`, `url`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'This is the first lecture ', 'http://localhost/mini_project/public/uploads/1728008631.RPReplay_Final1728008619.mp4', 'http://localhost/mini_project/public/uploads/1728008631.RPReplay_Final1728008619.mp4', 'How to train new employees (with instructions and examples)\r\nWritten by\r\nUpdated 28 August 2023\r\n\r\nManagers play a vital role in the general well-being of their team members. Training is a vital skill for managers of all levels and positions, as it allows you to improve the skill level of your team and improve its output. If you want to be an effective manager and increase the likelihood of retaining team members, learning how to train employees can help. In this article, we explain how to train new employees and why it\'s important for you as a manager or team leader.\r\nRelated: What are common workplace training methods? (With tips)\r\nRelated jobs on Indeed\r\nPart-time jobs\r\nFull-time jobs\r\nRemote jobs\r\nUrgently needed jobs\r\nView more jobs on Indeed\r\nHow to train new employees and why it\'s important\r\nLearning how to train new employees can increase the likelihood of them being effective in their roles. Good training can have a big impact on their productivity and attitude at work. It can also help to motivate employees and aid in retaining them at the company for a longer duration. As a supervisor or manager, you\'re likely to be responsible for the provision of training. Whether you work in a manual job or an office job, there are many important training considerations to make. If you want to know how to train a new employee, these simple steps can help:\r\n1. Set goals\r\nSome organisations already have a clear training plan for new employees. If the organisation you work for has a structured plan, sit down with your new employee and talk them through it. As you do so, encourage them to raise any concerns that they may have. Once they understand the training plan, you can set goals for them to accomplish throughout the training period. If the company doesn\'t have a set training plan, try to consider what skills and knowledge are most important to being successful in the role. Use this information to create your own goals for the employee.\r\nIt\'s important to provide new employees with a clear list of these goals and the resources they can use to achieve them so they can refer back to them over the training period. This allows employees to gauge their own progress and find solutions to problems themselves. It can also prompt them to reach out when they know they can\'t reach a goal without additional assistance.\r\nRelated: Objective vs. goal: what are the key differences?\r\n2. Involve other team members in new staff training\r\nTraining new employees can provide good development opportunities for other senior team members. It can also provide the new employee with perspectives and expertise aside from your own. This frees up more of your time and provides a wider range of people that the new employee can turn to for support. They may feel more comfortable discussing issues or admitting that they don\'t understand something when talking to one of these peers.\r\nOther senior team members may enjoy the opportunity to help with training too. It gives them a chance to develop their leadership and management abilities, which can be helpful later in their careers. It can also prove that they\'re ready for more responsibilities and promotions. Involve them in inductions, deliver training and, where appropriate, ask them to review the new employee\'s work.\r\nRelated: How to create an Induction training programme\r\n3. Encourage feedback from those involved in training a new employee\r\nAsking senior team members to provide feedback to the new employee is another useful development tool. This kind of feedback means that you develop a more complete picture of the new employee and their performance. New employees may be more likely to relax around peers who are performing similar roles and provide additional insights to those that they provide to you. Feedback from peers may also address smaller issues that might not be obvious to you, like trouble understanding company processes or admin mistakes.\r\nEncouraging feedback can also be a beneficial way of training other members of the team, aside from the new employee. It gives them a chance to practice providing constructive feedback and demonstrates their knowledge and understanding of the role and its requirements.\r\nRelated: Positive feedback: why it\'s important and how to give it\r\n4. Give freely of your time\r\nNew employees are likely to have lots of questions. Depending on their personality, they may feel like a burden if they ask too many. Not asking can lead to them making mistakes and missing out on important learning opportunities. Try to always be available to respond to their questions, even if you\'re busy. It\'s important that your new team members understand that taking the time to solve issues early on can prevent a lot of issues later on. You can also encourage them to direct their questions to other senior or experienced members of the team.\r\nIf this is your first time training new employees, it can be a good learning and personal development experience for you as well. It can improve your patience, tolerance and communication skills. It\'s important that you take the time to praise them where relevant. Publicly acknowledging the contributions they make to the team can also be helpful and can foster positivity from coworkers. Consider the role and decide how often you might want to check in on the new employee to prompt questions and provide feedback.\r\nRelated: How to practice gratitude while working remotely\r\n5. Make sure they know how to access resources and people\r\nIt\'s a good idea to provide new employees with a tour of the building when they first arrive. This helps them to understand where all of the facilities are and gives them perspective about the other departments in the company. Try to introduce them to contacts, not just others in your team, but key contacts in HR, the IT team and other important departments that they may communicate with within the first few weeks. Providing an organisation chart can be even more helpful. Onboarding sometimes involves frequent communication with IT professionals, so having a brief face-to-face can help.\r\nSpend time with them to make sure that they have all the right access and can log into the systems you need them to. If these don\'t work, make sure you fix them as quickly as possible and show them how to resolve the issue in future. This helps the new employee feel valued and important, even if it\'s a time-consuming process for you. If you have online or digital training resources, make sure that you highlight these and give an indication of which ones are mandatory and which are optional but useful.\r\nRelated: How to welcome new employees (With steps and examples)\r\n6. Have regular update sessions with them\r\nRegardless of how you decide to teach a new employee, it\'s important to take the time to check up on how they\'re faring. Set regular meetings so they know they can bring issues or questions to you, and you can do the same in return. Asking them how they think they\'re getting on can be a good way to quickly understand their perspective and their personality.\r\nTry to keep track of the training they have had in the time since your last catch-up session. Ask how these have gone, what they have learnt from these sessions and whether they would like any more opportunities to train in those particular areas. Ask open-ended questions that give them time and space to come to you with problems or uncertainties. Make sure to also keep a record of what you discuss in these sessions so you determine if they\'ve taken feedback seriously. This is particularly important if the company you work for has a probation period.\r\nRelated: What are one-on-one meetings? (With benefits and tips)\r\n7. Make sure they know it\'s OK to go home\r\nOne of the biggest challenges a new employee can face is \'presenteeism\'. This occurs when new or existing employees don\'t fully understand their employer\'s expectations, leading them to stay later than required to complete work that could be left for the following day. Try to show them from the start that the organisation values work-life balance. This can be motivational and prevents undue stress on the new employee.\r\nIn some companies, there may be some overtime. This is usually not true for new starters, though. Explain that others in the team might be busy on specific projects but that if they completed their own tasks for the day, there\'s no reason to work overtime. When the time comes when they have a larger workload, new employees are more likely to be ready for it.', '2024-10-04 02:38:04', '2024-10-04 02:38:04'),
(2, 1, 3, 'Bai 2', 'http://localhost/mini_project/public/uploads/1728008631.RPReplay_Final1728008619.mp4', 'http://localhost/mini_project/public/uploads/1728008631.RPReplay_Final1728008619.mp4', 'One of the biggest challenges a new employee can face is \'presenteeism\'. This occurs when new or existing employees don\'t fully understand their employer\'s expectations, leading them to stay later than required to complete work that could be left for the following day. Try to show them from the start that the organisation values work-life balance. This can be motivational and prevents undue stress on the new employee.', '2024-10-04 02:39:48', '2024-10-04 02:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `course_sections`
--

CREATE TABLE `course_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_sections`
--

INSERT INTO `course_sections` (`id`, `course_id`, `section_title`, `created_at`, `updated_at`) VALUES
(1, 1, 'Day 1', NULL, NULL),
(3, 1, 'Day 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `environments`
--

CREATE TABLE `environments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `player` varchar(255) DEFAULT NULL,
  `drop_date` varchar(255) DEFAULT NULL,
  `build` varchar(255) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `environments`
--

INSERT INTO `environments` (`id`, `task_id`, `email`, `browser`, `player`, `drop_date`, `build`, `device`, `created_at`, `updated_at`) VALUES
(1, 65, NULL, NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, 'iOS: 80.14.11 - 2024 Passport R17 - beta (ios);Android: 80.14.10 - 2024 Passport R17 - beta (android)', 'Samsung Galaxy Tab S8 (Android 13)', '2024-11-15 06:36:22', NULL),
(2, 65, NULL, NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, 'iOS: 80.14.11 - 2024 Passport R17 - beta (ios);Android: 80.14.10 - 2024 Passport R17 - beta (android)', 'Samsung Galaxy Tab S8 (Android 13)', '2024-11-15 06:38:00', NULL),
(3, 64, '123123123123121', '12312312', '81.1-58210-v16.4', '14 - 20 - 2024', 'iOS: 80.12.03 - 2024 Passport R1', '81.1-58210-', '2024-11-15 06:39:31', '2024-11-15 09:01:16'),
(4, 75, 'qweqweqw;qweqweqweqw;12312312312', 'asjkdhjkasdhasjkdhasjk;asdhasjkdhasjkdajsdlkasjdkl;asgdhasghdjas', NULL, NULL, NULL, NULL, '2024-11-15 09:13:51', '2024-11-15 09:14:25'),
(5, 78, 'dhasgdhjasdasj;asjkhdajkdhajks', 'dhasgdhjasdasj;asjkhdajkdhajks', 'dhasgdhjasdasj;asjkhdajkdhajks', 'dhasgdhjasdasj;asjkhdajkdhajks', 'dhasgdhjasdasj;asjkhdajkdhajks', 'dhasgdhjasdasj;asjkhdajkdhajks', '2024-11-15 09:27:02', NULL),
(6, 133, 'Google Chrome: 130.0.6723.70\r\n;Mac Safari: 15.6 (17613.3.9.1.5)\r\n;Firefox 131.0.3 \r\n;Microsoft Edge 130.0.2849.56', 'Google Chrome: 130.0.6723.70\r\n;Mac Safari: 15.6 (17613.3.9.1.5)\r\n;Firefox 131.0.3 \r\n;Microsoft Edge 130.0.2849.56', 'Google Chrome: 130.0.6723.70\r\n;Mac Safari: 15.6 (17613.3.9.1.5)\r\n;Firefox 131.0.3 \r\nMicrosoft Edge 130.0.2849.56', 'Drop Date', 'dadasdasda;asdasdas', 'asdasdasd213213213;a21312312312qsdasd', '2024-11-18 06:58:59', NULL),
(7, 133, 'Google Chrome: 130.0.6723.70\r\n;Mac Safari: 15.6 (17613.3.9.1.5)\r\n;Firefox 131.0.3 \r\n;Microsoft Edge 130.0.2849.56', 'Google Chrome: 130.0.6723.70\r\n;Mac Safari: 15.6 (17613.3.9.1.5)\r\n;Firefox 131.0.3 \r\n;Microsoft Edge 130.0.2849.56', 'Google Chrome: 130.0.6723.70\r\n;Mac Safari: 15.6 (17613.3.9.1.5)\r\n;Firefox 131.0.3 \r\nMicrosoft Edge 130.0.2849.56', 'Drop Date', 'dadasdasda;asdasdas', 'asdasdasd213213213;a21312312312qsdasd', '2024-11-18 09:03:21', '2024-11-18 02:03:21'),
(8, 145, 'sonosrvc+kws-fullregression@gmail.com', 'Google Chrome: 130.0.6723.117;Edge: 130;Safari 17.4.1;Firefox 132.0.1', '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, 'iOS: 80.14.11 - 2024 Passport R17 - beta (ios);Android: 80.14.10 - 2024 Passport R17 - beta (android)', NULL, '2024-11-18 09:23:30', NULL),
(9, 145, 'sonosrvc+kws-fullregression@gmail.com', 'Google Chrome: 130.0.6723.117;Edge: 130;Safari 17.4.1;Firefox 132.0.1', '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, 'iOS: 80.14.11 - 2024 Passport R17 - beta (ios);Android: 80.14.10 - 2024 Passport R17 - beta (android)', NULL, '2024-11-18 09:26:17', '2024-11-18 02:26:17'),
(10, 162, 'sonosrvclgw+3@gmail.com;son2222osrvclgw+3@gmail.com', 'Google Chrome: 131.0.6778.69;Edge: 131.0.2903.51;Safari 17.4.1;Firefox 132.0.2', '81.1-58210', '14 Nov 2024 (Prod)', NULL, NULL, '2024-11-19 05:13:22', NULL),
(11, 165, 'sonosrvclgw+3@gmail.com;sonosrvclgw+4@gmail.com', 'Google Chrome: 131.0.6778.70;Edge: 131.0.2903.51;Safari 17.4.1;Firefox 132.0.2', '81.1-58212', '14 Nov 2024 (Prod)', NULL, NULL, '2024-11-19 09:48:52', '2024-11-19 10:17:20'),
(12, 171, 'sonosrvclgw+3@gmail.com; sonosrvclgw+4@gmail.com', 'Google Chrome: 131.0.6778.70;Edge: 131.0.2903.51;Safari 17.4.1;Firefox 132.0.2', '81.1-58212', '14 Nov 2024 (Prod)', NULL, NULL, '2024-11-19 09:57:00', '2024-11-19 10:16:55'),
(13, 178, 'sonosrvc+kws-fullregression@gmail.com', NULL, '83.0-59130-v16.6-2025_Player_1-Alpha-4-MainlineExternalHW', NULL, '80.14.12 - 2024 Passport R17 - beta (android);80.14.13 - 2024 Passport R17 - beta (iOS)', 'iPhone 11 (iOS 16.0); iPhone 13 (16.4.1); Samsung Galaxy S23 (Android 13)', '2024-11-20 02:30:32', '2024-11-20 10:16:21'),
(14, 165, 'sonosrvclgw+3@gmail.com;sonosrvclgw+4@gmail.com', 'Google Chrome: 131.0.6778.70;Edge: 131.0.2903.51;Safari 17.4.1;Firefox 132.0.2', '81.1-58212', '14 Nov 2024 (Prod)', NULL, NULL, '2024-11-20 03:33:52', '2024-11-19 20:33:52'),
(15, 178, 'sonosrvc+kws-fullregression@gmail.com', NULL, '83.0-59130-v16.6-2025_Player_1-Alpha-4-MainlineExternalHW', NULL, '80.14.12 - 2024 Passport R17 - beta (android);80.14.13 - 2024 Passport R17 - beta (iOS)', 'iPhone 11 (iOS 16.0); iPhone 13 (16.4.1); Samsung Galaxy S23 (Android 13)', '2024-11-21 01:39:40', '2024-11-20 18:39:40'),
(16, 178, 'sonosrvc+kws-2@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, '80.14.13 - 2024 Passport R17 - beta (ios);80.14.12 - 2024 Passport R17 - beta (android)', 'Google Pixel 7 (Android 13);iPhone XR (iOS 16.4.1)', '2024-11-21 01:41:11', '2024-11-21 10:03:10'),
(17, 178, 'sonosrvc+kws-2@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, '80.14.13 - 2024 Passport R17 - beta (ios);80.14.12 - 2024 Passport R17 - beta (android)', 'Google Pixel 7 (Android 13); iPad gen 10th (iOS 16.5.1)', '2024-11-22 01:43:38', '2024-11-22 04:56:54'),
(18, 178, 'sonosrvc+kws-2@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, '80.14.13 - 2024 Passport R17 - beta (ios);80.14.12 - 2024 Passport R17 - beta (android)', 'iPhone 11 (iOS 16.0);iPhone XR (iOS 16.4.1); iPhone 13 (iOS 16.4)', '2024-11-22 01:45:29', '2024-11-22 10:15:06'),
(19, 178, 'sonosrvc+kws-2@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, '80.14.13 - 2024 Passport R17 - beta (ios);80.14.12 - 2024 Passport R17 - beta (android)', 'Samsung A73 (Android 13)', '2024-11-22 01:46:40', '2024-11-22 10:16:20'),
(20, 178, 'sonosrvc+kws-2@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, '80.14.13 - 2024 Passport R17 - beta (ios);80.14.12 - 2024 Passport R17 - beta (android)', 'Samsung A73 (Android 13);iPhone 13 (iOS 16.4)', '2024-11-25 02:20:26', '2024-11-25 09:54:19'),
(21, 178, 'sonosrvc+kws-2@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2; Ace: 3.1.4 - 2024 Ace 6 RC 3', NULL, '80.14.13 - 2024 Passport R17 - beta (ios);80.14.12 - 2024 Passport R17 - beta (android)', 'Google Pixel 7 (Android 13); iPad gen 10th (iOS 16.5.1);iPhone 13 (iOS 16.4)', '2024-11-25 02:20:53', '2024-11-25 10:18:29'),
(22, 178, 'sonosrvc+kws-3@gmail.com', NULL, '82.2-59204-v16.5-2024_Player_R6-RC-2', NULL, '80.14.04 - 2024 Passport R17 - release (ios);80.14.02 - 2024 Passport R17 - release (android)', 'Samsung Galaxy S23 (Android 13)', '2024-11-25 02:22:12', '2024-11-25 10:10:36'),
(23, 178, 'sonosrvc+kws-3@gmail.com', NULL, '82.2-59204-v16.5-2024_Player_R6-RC-2', NULL, '80.14.04 - 2024 Passport R17 - release (ios);80.14.02 - 2024 Passport R17 - release (android)', 'Samsung Galaxy S23 (Android 13);iPhone 12 (iOS 16.6); iPhone 13 (iOS 16.4)', '2024-11-26 01:45:27', '2024-11-26 09:57:42'),
(24, 178, 'sonosrvc+kws-3@gmail.com', NULL, '82.2-59204-v16.5-2024_Player_R6-RC-2', NULL, '80.14.04 - 2024 Passport R17 - release (ios);80.14.02 - 2024 Passport R17 - release (android)', 'Samsung Galaxy A73 (Android 13);iPhone 11 (iOS 16.0)', '2024-11-26 01:46:27', '2024-11-26 10:09:06'),
(25, 178, 'sonosrvc+kws-fullregression@gmail.com', NULL, '83.1-59200-v16.6-2025_Player_1-Alpha-5-Mainline', NULL, '80.14.15 - 2024 Passport R17 - beta (ios);80.14.14 - 2024 Passport R17 - beta (android)', 'Samsung Galaxy A73 (Android 13);iPhone 13 (iOS 16.4);iPhone 11 (ios 16.0)', '2024-11-27 03:11:19', '2024-11-27 10:39:07'),
(26, 178, 'sonosrvc+kws-3@gmail.com', NULL, '83.1-59200-v16.6-2025_Player_1-Alpha-5-Mainline', NULL, '80.14.16 - 2024 Passport R17 - beta (ios);80.14.15 - 2024 Passport R17 - beta (android)', 'Google Pixel 7 (Android 13);Samsung Galaxy S23 (android 13);iPhone 12 (iOS 16.6);iPad Gen 10th (iOS 16.5.1)', '2024-11-27 09:54:10', '2024-11-27 10:38:34'),
(27, 178, 'sonosrvc+kws-3@gmail.com', NULL, '82.2-59204-v16.5-2024_Player_R6-RC-2', NULL, '80.14.04 - 2024 Passport R17 - release (ios);80.14.02 - 2024 Passport R17 - release (android)', 'Samsung Galaxy S23 (Android 13);iPhone 12 (iOS 16.6); iPhone 13 (iOS 16.4)', '2024-11-28 01:44:21', '2024-11-27 18:44:21'),
(28, 417, 'sonosrvc+kws-4@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, '80.11.60 - 2024 Passport R15.1 - beta (ios);80.11.60 - 2024 Passport R15 1 - beta (android)', NULL, '2024-11-28 01:48:17', '2024-11-28 01:48:31'),
(29, 442, 'sonosrvc+kws-4@gmail.com', NULL, '82.2-58290-v16.5-2024_Player_R6-Beta-2', NULL, '80.14.13 - 2024 Passport R17 - beta (ios);80.14.12 - 2024 Passport R17 - beta (android)', 'iPhone 12 (iOS 16.6)', '2024-11-28 07:43:16', '2024-11-28 07:44:46'),
(30, 178, 'sonosrvc+kws-3@gmail.com', NULL, '82.2-59204-v16.5-2024_Player_R6-RC-2', NULL, '80.14.04 - 2024 Passport R17 - release (ios);80.14.02 - 2024 Passport R17 - release (android)', 'Samsung Galaxy S23 (Android 13);iPhone 12 (iOS 16.6); iPhone 13 (iOS 16.4)', '2024-11-28 08:57:27', '2024-11-28 09:01:49');

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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `size` bigint(20) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `share` int(11) NOT NULL,
  `file_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `user_id`, `size`, `extension`, `share`, `file_slug`, `created_at`, `updated_at`) VALUES
(17, '1732074503.RPReplay_Final1732074287.mp4', 30, 73871775, 'mp4', 0, '1732074503.rpreplay_final1732074287.mp4', '2024-11-20 03:48:23', NULL),
(18, '1732095579.IMG_2004.png', 30, 559363, 'png', 0, '1732095579.img_2004.png', '2024-11-20 09:39:39', NULL),
(19, '1732095580.IMG_2008.png', 30, 1210615, 'png', 0, '1732095580.img_2008.png', '2024-11-20 09:39:40', NULL),
(20, '1732095580.IMG_2007.png', 30, 1209520, 'png', 0, '1732095580.img_2007.png', '2024-11-20 09:39:40', NULL),
(21, '1732095591.Screenshot_20241120_112947_Sonos.jpg', 30, 340740, 'jpg', 0, '1732095591.screenshot_20241120_112947_sonos.jpg', '2024-11-20 09:39:51', NULL),
(22, '1732095591.Screenshot_20241120_163625_Sonos.jpg', 30, 507085, 'jpg', 0, '1732095591.screenshot_20241120_163625_sonos.jpg', '2024-11-20 09:39:51', NULL),
(23, '1732098018.Screen_Recording_20241120_171840_Sonos.mp4', 30, 2431125, 'mp4', 0, '1732098018.screen_recording_20241120_171840_sonos.mp4', '2024-11-20 10:20:18', NULL),
(24, '1732098019.Screen_Recording_20241120_170650_Sonos.mp4', 30, 2334069, 'mp4', 0, '1732098019.screen_recording_20241120_170650_sonos.mp4', '2024-11-20 10:20:19', NULL),
(25, '1732099349.screen-20241120-172202.mp4', 30, 22694631, 'mp4', 0, '1732099349.screen-20241120-172202.mp4', '2024-11-20 10:42:29', NULL),
(26, '1732508687.RPReplay_Final1732508361.mp4', 30, 38778014, 'mp4', 0, '1732508687.rpreplay_final1732508361.mp4', '2024-11-25 04:24:47', NULL),
(27, '1732519740.RPReplay_Final1732517776.mp4', 30, 10614266, 'mp4', 0, '1732519740.rpreplay_final1732517776.mp4', '2024-11-25 07:29:00', NULL),
(28, '1732519819.RPReplay_Final1732517776.mp4', 30, 10614266, 'mp4', 0, '1732519819.rpreplay_final1732517776.mp4', '2024-11-25 07:30:19', NULL),
(29, '1732519821.RPReplay_Final1732517776.mp4', 30, 10614266, 'mp4', 0, '1732519821.rpreplay_final1732517776.mp4', '2024-11-25 07:30:21', NULL),
(30, '1732522547.RPReplay_Final1732520644.mp4', 30, 77676851, 'mp4', 0, '1732522547.rpreplay_final1732520644.mp4', '2024-11-25 08:15:47', NULL),
(31, '1732523140.IMG_0211.jpeg', 23, 2108268, 'jpeg', 0, '1732523140.img_0211.jpeg', '2024-11-25 08:25:40', NULL),
(32, '1732589717.build-19_80.14.04-release_2024_passport_r17.development+20241125.6c91de8-universal-release.apk', 16, 209289902, 'apk', 0, '1732589717.build-19_80.14.04-release_2024_passport_r17.development+20241125.6c91de8-universal-release.apk', '2024-11-26 02:55:17', NULL),
(33, '1732589724.build-31_80.14.05-release_2024_passport_r17.dev+20241126.cff5a42.ipa', 16, 84510270, 'ipa', 0, '1732589724.build-31_80.14.05-release_2024_passport_r17.dev+20241126.cff5a42.ipa', '2024-11-26 02:55:24', NULL),
(34, '1732592171.IMG_0873.png', 5, 617761, 'png', 0, '1732592171.img_0873.png', '2024-11-26 03:36:11', NULL),
(35, '1732592171.IMG_0874.png', 5, 133240, 'png', 0, '1732592171.img_0874.png', '2024-11-26 03:36:11', NULL),
(36, '1732592859.IMG_0875.png', 5, 341023, 'png', 0, '1732592859.img_0875.png', '2024-11-26 03:47:39', NULL),
(37, '1732605419.RPReplay_Final1732604303.mp4', 30, 12124434, 'mp4', 0, '1732605419.rpreplay_final1732604303.mp4', '2024-11-26 07:16:59', NULL),
(38, '1732614822.IMG_2025.png', 30, 300810, 'png', 0, '1732614822.img_2025.png', '2024-11-26 09:53:42', NULL),
(39, '1732676320.80.14.06-release_2024_passport_r17.dev+20241127.2a8f668.ipa', 15, 84504782, 'ipa', 0, '1732676320.80.14.06-release_2024_passport_r17.dev+20241127.2a8f668.ipa', '2024-11-27 02:58:40', NULL),
(40, '1732677298.RPReplay_Final1732676585.mp4', 30, 68196452, 'mp4', 0, '1732677298.rpreplay_final1732676585.mp4', '2024-11-27 03:14:58', NULL),
(41, '1732677729.IMG_0771.png', 27, 868788, 'png', 0, '1732677729.img_0771.png', '2024-11-27 03:22:09', NULL),
(42, '1732678738.IMG_1221.mov', 7, 40897338, 'mov', 0, '1732678738.img_1221.mov', '2024-11-27 03:38:58', NULL),
(43, '1732678962.RPReplay_Final1732674190.mp4', 23, 8175133, 'mp4', 0, '1732678962.rpreplay_final1732674190.mp4', '2024-11-27 03:42:42', NULL),
(44, '1732678962.IMG_0215.png', 23, 422830, 'png', 0, '1732678962.img_0215.png', '2024-11-27 03:42:42', NULL),
(45, '1732689718.RPReplay_Final1732689478.mov', 27, 2532178, 'mov', 0, '1732689718.rpreplay_final1732689478.mov', '2024-11-27 06:41:58', NULL),
(46, '1732690090.RPReplay_Final1732682085.mp4', 30, 26797719, 'mp4', 0, '1732690090.rpreplay_final1732682085.mp4', '2024-11-27 06:48:10', NULL),
(47, '1732690463.IMG_2032.png', 30, 533278, 'png', 0, '1732690463.img_2032.png', '2024-11-27 06:54:23', NULL),
(48, '1732758644.3211_80.15.00-main.development+20241128.aaee612-arm64-v8a-release.apk', 16, 143067300, 'apk', 0, '1732758644.3211_80.15.00-main.development+20241128.aaee612-arm64-v8a-release.apk', '2024-11-28 01:50:44', NULL),
(49, '1732758644.4075_80.15.00-main.dev+20241127.3918db4.ipa', 16, 84703651, 'ipa', 0, '1732758644.4075_80.15.00-main.dev+20241127.3918db4.ipa', '2024-11-28 01:50:44', NULL),
(50, '1732766142.IMG_0775.png', 27, 1327828, 'png', 0, '1732766142.img_0775.png', '2024-11-28 03:55:42', NULL),
(51, '1732766142.IMG_0776.png', 27, 144148, 'png', 0, '1732766142.img_0776.png', '2024-11-28 03:55:42', NULL),
(52, '1732777476.Screenshot_20241128-135657.png', 14, 83995, 'png', 0, '1732777476.screenshot_20241128-135657.png', '2024-11-28 07:04:36', NULL),
(53, '1732779085.Screenshot_20241128-142311.png', 14, 1056139, 'png', 0, '1732779085.screenshot_20241128-142311.png', '2024-11-28 07:31:25', NULL),
(54, '1732779085.Screenshot_20241128-142249.png', 14, 444461, 'png', 0, '1732779085.screenshot_20241128-142249.png', '2024-11-28 07:31:25', NULL),
(55, '1732780158.RPReplay_Final1732778640.mp4', 27, 14338910, 'mp4', 0, '1732780158.rpreplay_final1732778640.mp4', '2024-11-28 07:49:18', NULL),
(56, '1732780194.IMG_0779.png', 27, 1515374, 'png', 0, '1732780194.img_0779.png', '2024-11-28 07:49:54', NULL),
(57, '1732783583.IMG_0780.png', 27, 185633, 'png', 0, '1732783583.img_0780.png', '2024-11-28 08:46:23', NULL),
(58, '1732787544.RPReplay_Final1732785579.mp4', 25, 93095470, 'mp4', 0, '1732787544.rpreplay_final1732785579.mp4', '2024-11-28 09:52:24', NULL);

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_20_202509_create_categories_table', 1),
(6, '2023_08_22_195042_create_sub_categories_table', 1),
(7, '2023_08_23_210009_create_courses_table', 1),
(8, '2023_08_23_210952_create_course_goals_table', 1),
(9, '2023_08_26_201730_create_course_sections_table', 1),
(10, '2023_08_26_201748_create_course_lectures_table', 1),
(11, '2024_07_23_144445_create_boards_table', 1),
(12, '2024_08_11_061808_create_teams_table', 1),
(13, '2024_08_11_074337_create_types_table', 1),
(14, '2024_08_11_081839_create_working_statuses_table', 1),
(15, '2024_08_11_084338_create_ticket_statuses_table', 1),
(16, '2024_08_11_093115_create_board_configs_table', 1),
(17, '2024_08_11_141227_create_tasks_table', 1),
(18, '2024_08_20_091358_create_priorities_table', 1),
(19, '2024_09_10_143858_create_files_table', 2),
(20, '2023_10_03_190656_create_blog_categories_table', 3),
(21, '2023_10_03_203415_create_blog_posts_table', 3),
(22, '2024_09_30_150644_add_paid_to_users_table', 4),
(23, '2024_10_01_022912_create_comments_table', 4),
(24, '2024_11_14_065002_create_report_configs_table', 5),
(25, '2024_11_15_024024_create_environments_table', 6),
(26, '2024_11_27_051537_create_task_histories_table', 7);

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
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `priority_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `name`, `desc`, `priority_slug`, `created_at`, `updated_at`) VALUES
(1, 'Critical', 'demo', NULL, NULL, NULL),
(2, 'Minor', 'demo', NULL, NULL, NULL),
(3, 'Major', 'demo', NULL, NULL, NULL),
(4, 'High', 'demo', 'high', NULL, '2024-10-03 09:08:36'),
(5, 'Medium', 'demo', NULL, NULL, NULL),
(6, 'Low', 'demo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report_configs`
--

CREATE TABLE `report_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `board_id` int(11) NOT NULL,
  `cc` longtext NOT NULL,
  `date_format` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_configs`
--

INSERT INTO `report_configs` (`id`, `subject`, `board_id`, `cc`, `date_format`, `created_at`, `updated_at`) VALUES
(1, '[AGEST][SONOS] Daily Status Report -', 1, 'huy.quoc.tran@agest.vn; vien.do@agest.vn;suil@logigear.com; tonyl@logigear.com; doug.wilson@logigear.com; canh.tran@agest.vn; tuong.vo@agest.vn; diem.nguyen@agest.vn; do.ho@agest.vn;an.duong@agest.vn;nhan.van.nguyen@agest.vn;tai.ngo@agest.vn; tai.le@agest.vn; duy.khuong.phan@agest.vn; thanh.dang@agest.vn; sang.le@agest.vn; vuong.bui@agest.vn; nhan.thi.tran@agest.vn; hung.ngo@agest.vn; hieu.ngoc.dang@agest.vn;thao.phuong.do@agest.vn;chieu.mai@agest.vn;', 'MMMM DD, OY', '2024-11-26 06:42:36', '2024-11-25 23:42:36'),
(3, '[SONOS] - Daily Status Report –', 5, 'michael.troisi@sonos.com; jessica.balogh@sonos.com; chris.putman@sonos.com; linsung.chiang@sonos.com; tonyl@logigear.com; suil@logigear.com; doug.wilson@logigear.com; huy.quoc.tran@agest.vn; vien.do@agest.vn; canh.tran@agest.vn; hien.huynh@agest.vn; hieu.trung.tran@agest.vn; anh.thu.dang@agest.vn; my.chu.le@agest.vn; trang.thu.nguyen@agest.vn', 'MMMM DD, OY', '2024-11-21 04:12:45', '2024-11-20 21:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Regression Team Training', 'regression-team-training', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `team` bigint(20) UNSIGNED DEFAULT NULL,
  `type` bigint(20) UNSIGNED DEFAULT NULL,
  `jira_id` varchar(255) DEFAULT NULL,
  `jira_summary` varchar(255) DEFAULT NULL,
  `working_status` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_status` bigint(20) UNSIGNED DEFAULT NULL,
  `link_to_result` varchar(255) DEFAULT NULL,
  `test_plan` varchar(255) DEFAULT NULL,
  `sprint` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `priority` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `review` varchar(1000) DEFAULT NULL,
  `tester_1` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_2` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_3` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_4` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_5` bigint(20) UNSIGNED DEFAULT NULL,
  `pass` int(11) DEFAULT NULL,
  `fail` int(11) DEFAULT NULL,
  `task_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `environment` bigint(20) DEFAULT NULL,
  `parent_task_id` bigint(20) DEFAULT NULL,
  `isSubBug` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `board_id`, `team`, `type`, `jira_id`, `jira_summary`, `working_status`, `ticket_status`, `link_to_result`, `test_plan`, `sprint`, `note`, `priority`, `status`, `review`, `tester_1`, `tester_2`, `tester_3`, `tester_4`, `tester_5`, `pass`, `fail`, `task_slug`, `created_at`, `updated_at`, `environment`, `parent_task_id`, `isSubBug`) VALUES
(165, 5, NULL, 11, 'ENGX-33331', '2024 Sprint 22 Web Controller: Execute accessibility regression pass (Prod)', 1, 1, NULL, '127398', '22', NULL, NULL, '0', NULL, 17, 0, 0, 0, 0, 108, 66, 'engx-33331', '2024-11-19 09:46:18', '2024-11-19 09:48:52', 11, NULL, '0'),
(166, 1, 24, 3, 'PMA-16594', '[ACR] - Wireless HH Setup fails after entering 3 times a wrong wifi password', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'pma-16594', '2024-11-19 09:46:29', NULL, NULL, NULL, '0'),
(167, 1, 24, 2, 'SWPBL-238124', '[Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-19 09:47:09', NULL, NULL, NULL, '0'),
(170, 1, 24, 2, 'SWPBL-237781', '[Android] [iOS] Eero AP: Unable to create new system after fails enter SSID password 1 times', 1, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237781', '2024-11-19 09:47:47', NULL, NULL, NULL, '0'),
(171, 5, NULL, 11, 'ENGX-33332', '2024 Sprint 22 Web Controller: Execute regression pass (Prod)', 2, 3, NULL, '127406', '22', NULL, NULL, '0', NULL, 17, 0, 0, 0, 0, 411, 79, 'engx-33332', '2024-11-19 09:53:57', '2024-11-19 10:21:13', 12, NULL, '0'),
(172, 1, 5, 2, 'PMA-18599', 'Update TCs for Regression Pass', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-18599', '2024-11-19 09:54:16', '2024-11-19 09:54:45', NULL, NULL, '0'),
(173, 1, 1, 2, 'PMA-18771', 'AGEST - Ace Integration Spec Walk', 1, 1, 'https://docs.google.com/spreadsheets/d/1HSQDIp9cFzxdeHVZKHBL6dPWivhRMt2TqFh1U-tCeao/edit?usp=sharing', NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-18771', '2024-11-19 10:01:42', NULL, NULL, NULL, '0'),
(174, 1, 22, 2, 'PINE-4798', 'Review Test Cases', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 23, 27, 1, NULL, NULL, NULL, 'pine-4798', '2024-11-20 02:06:02', '2024-11-20 02:06:44', NULL, NULL, '0'),
(175, 1, 22, 3, 'PINE-4131', 'Launcher: Need to press OK twice to create new watchlist/ open Apps page/ open Quick Saves', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4131', '2024-11-20 02:06:37', '2024-11-20 07:59:47', NULL, NULL, '0'),
(176, 1, 2, 3, 'PMA-12962', '[Android] HomeFeed swimlanes animate to black when transitioning from glimmer -> loaded state', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 15, 0, 0, 0, NULL, NULL, NULL, 'pma-12962', '2024-11-20 02:23:02', '2024-11-20 07:06:02', NULL, NULL, '0'),
(177, 1, 4, 3, 'PMA-18134', '[Android][Sonos Playlists] Update Success Toasts', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18134', '2024-11-20 02:23:52', '2024-11-20 04:54:53', NULL, NULL, '0'),
(178, 5, NULL, 10, 'ENGX-33334', '2024 Sprint 21 - Mainline Alpha 6 : Execute regression pass', 1, 1, NULL, '127666', '22', NULL, NULL, '0', NULL, 6, 18, 11, 0, 0, 264, 39, 'engx-33334', '2024-11-20 02:25:03', '2024-11-20 10:31:36', 13, NULL, '0'),
(180, 1, 1, 2, 'PMA-18771', 'AGEST - Ace Integration Spec Walk', 2, 2, 'https://docs.google.com/spreadsheets/d/1HSQDIp9cFzxdeHVZKHBL6dPWivhRMt2TqFh1U-tCeao/edit?usp=sharing', NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-18771', '2024-11-20 02:25:55', '2024-11-20 09:39:17', NULL, NULL, '0'),
(181, 1, 4, 3, 'PMA-16948', '▲ Missing \'About\' Information for Sonos Radio Favorites When Phone Language is Set to German', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-16948', '2024-11-20 02:27:19', '2024-11-20 07:55:55', NULL, NULL, '0'),
(183, 1, 4, 3, 'PMA-17182', '● [iOS][Sonos Playlist] Flickering Album Art of Sonos Playlists multiple times in Playlist container', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-17182', '2024-11-20 02:29:05', '2024-11-20 03:52:47', NULL, NULL, '0'),
(184, 1, 5, 3, 'PMA-16507', '[iOS] There is a delay updated when changing the room name', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-16507', '2024-11-20 02:30:00', '2024-11-20 03:10:20', NULL, NULL, '0'),
(185, 1, 4, 3, 'PMA-16068', '[iOS] Debug menu tools to simulate errors or MSP outage', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-16068', '2024-11-20 02:30:57', '2024-11-20 10:21:48', NULL, NULL, '0'),
(186, 1, 5, 2, 'PMA-18599', 'Update TCs for Regression Pass', 1, 1, 'https://docs.google.com/spreadsheets/d/1yT8q0gGAUMZJptl1pFjQu7m-aU8maP50v4YvFk4FwYI/edit?gid=51829899#gid=51829899', NULL, NULL, NULL, NULL, '0', NULL, 24, 29, 22, 0, NULL, NULL, NULL, 'pma-18599', '2024-11-20 02:32:14', '2024-11-20 04:27:23', NULL, NULL, '0'),
(187, 1, 22, 2, 'PINE-4847', 'iOS App BVT - Passport main #4013', 2, 2, 'https://docs.google.com/spreadsheets/d/1NSBa6qAmmRg73NLMKIXXzrePYfz4tmzxgghzT4fIMrY/edit?gid=373454404#gid=373454404', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 7, 1, NULL, NULL, NULL, 'pine-4847', '2024-11-20 02:50:23', '2024-11-20 09:06:44', NULL, NULL, '0'),
(188, 1, 1, 2, 'PMA-17725', 'Trueplay Spec Walk', 2, 2, 'https://docs.google.com/spreadsheets/d/1l1PKjDBBTFcPhdT_UNibCbEDhzwWhTIxwSn-LIO0jyE/edit?gid=0#gid=0&range=A1', NULL, NULL, NULL, NULL, '0', NULL, 21, 0, 0, 0, NULL, NULL, NULL, 'pma-17725', '2024-11-20 02:57:09', '2024-11-20 09:31:15', NULL, NULL, '0'),
(189, 5, NULL, 11, 'ENGX-33331', '2024 Sprint 22 Web Controller: Execute accessibility regression pass (Prod)', 2, 3, NULL, '127398', '22', 'clone', NULL, '0', NULL, 17, 19, 0, 0, 0, 133, 81, 'engx-33331', '2024-11-20 03:33:52', '2024-11-20 09:22:00', 14, NULL, '0'),
(190, 1, 22, 2, 'PINE-4848', 'Pinewood BVT build NSUD 492', 2, 2, 'https://docs.google.com/spreadsheets/d/1zW_dh5AMMjnvWbMtjQmtZ6PKo2VJoUGbqgDVgDr5HYo/edit?gid=243022426#gid=243022426', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 7, 1, NULL, NULL, NULL, 'pine-4848', '2024-11-20 06:40:27', '2024-11-20 10:09:45', NULL, NULL, '0'),
(191, 1, 4, 3, 'PMA-15175', '[Android] Remove loading state when creating new playlist', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-15175', '2024-11-20 07:24:23', '2024-11-20 09:33:56', NULL, NULL, '0'),
(192, 1, 22, 1, 'PINE-4849', 'Video playing is dismissed after opening QAP> Settings and pressing Back button', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4849', '2024-11-20 07:53:47', NULL, NULL, NULL, '0'),
(193, 5, NULL, 1, 'PMA-18966', '[Android] Music item shows source \"Chime\" then immediately changes to \"selected content\" when opening existing alarm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-18966', '2024-11-20 07:56:07', NULL, NULL, 178, '1'),
(194, 1, 4, 3, 'PMA-10826', '[Android] Remainder of Sonos Playlists Support', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-10826', '2024-11-20 07:56:32', '2024-11-20 10:12:54', NULL, NULL, '0'),
(195, 1, 24, 2, 'SWPBL-238124', '[Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1Uc572Pw6ovo7maCHiIFm08fDZIY4OowvUmFpsuCe9x4/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-20 08:58:49', NULL, NULL, NULL, '0'),
(196, 1, 23, 2, 'SWPBL-237716', '[MultiZone] - Execute Airplay and Spotify DC test cases', 1, 1, 'https://docs.google.com/spreadsheets/d/1V4BxgwtSVlRypfUeS_JqzbHiZMvj5HuK6WCRhB94bT0/edit?gid=932922177#gid=932922177', NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237716', '2024-11-20 09:09:15', NULL, NULL, NULL, '0'),
(197, 1, 20, 3, 'PMA-15006', '[Android] show disabled track bar on fullNP', 2, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-15006', '2024-11-20 09:16:02', '2024-11-20 10:13:21', NULL, NULL, '0'),
(198, 1, 1, 1, 'PMA-18968', '[iOS] Trueplay - Missing trueplay section from Amp with Sonance', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 21, 0, 0, 0, NULL, NULL, NULL, 'pma-18968', '2024-11-20 09:20:37', '2024-11-20 09:21:18', NULL, NULL, '0'),
(199, 1, 24, 2, 'SWPBL-237781', '[Android] [iOS] Eero AP: Unable to create new system after fails enter SSID password 1 times', 2, 2, 'https://docs.google.com/spreadsheets/d/12ABAm_UUSsCdRs_6WkV9qxau0FjHqU0Vqg2GNEu8ooA/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237781', '2024-11-20 09:24:34', NULL, NULL, NULL, '0'),
(200, 1, 24, 2, 'SWPBL-237781', 'Verification Matrix', 1, 2, 'https://docs.google.com/spreadsheets/d/1vrb-0iQxa5yxlT-mL97DwnnJuLbBj9vkS0tC51VXkP0/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237781', '2024-11-20 09:26:19', NULL, NULL, NULL, '0'),
(201, 1, 22, 1, 'PINE-4851', 'Sometimes network icon shows \"No wifi\" icon when the PW is wired', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4851', '2024-11-20 09:50:53', NULL, NULL, NULL, '0'),
(202, 1, 22, 1, 'PINE-4850', 'Unable to move up to above section when the focus is placed on the recommendation section', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 1, 0, 0, 0, NULL, NULL, NULL, 'pine-4850', '2024-11-20 10:00:39', '2024-11-20 10:13:15', NULL, NULL, '0'),
(203, 1, 20, 2, 'PMA-17821', '▲ [iOS] Speech enhancement shows disabled on Now Playing screen', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-17821', '2024-11-20 10:03:24', NULL, NULL, NULL, '0'),
(204, 1, 20, 3, 'PMA-18914', '▲ [Android] Allow http://siriusxm.com domains for album art', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18914', '2024-11-20 10:04:09', NULL, NULL, NULL, '0'),
(205, 5, NULL, 10, 'ENGX-33334', '2024 Sprint 21 - Mainline Alpha 6 : Execute regression pass', 2, 3, NULL, '127666', '22', NULL, NULL, '0', NULL, 6, 18, 11, 12, 0, 229, 43, 'engx-33334', '2024-11-21 01:39:40', '2024-11-21 09:58:51', 15, NULL, '0'),
(206, 5, NULL, 10, 'ENGX-33330', 'Sprint 22 : Sprint 21 Beta 4 : Execute regression pass', 1, 1, NULL, '127681', '22', NULL, NULL, '0', NULL, 17, 19, 0, 0, 0, 171, 30, 'engx-33330', '2024-11-21 01:41:11', '2024-11-21 09:23:53', 16, NULL, '0'),
(207, 1, 22, 2, 'PINE-4798', 'Review Test Cases', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 23, 27, 1, NULL, NULL, NULL, 'pine-4798', '2024-11-21 02:12:59', NULL, NULL, NULL, '0'),
(208, 1, 2, 3, 'SWPBL-231766', '[Android] [Home Feed] \'Sign in\' option displays when user has just set up a new HH successfully', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'swpbl-231766', '2024-11-21 02:23:38', '2024-11-21 03:27:12', NULL, NULL, '0'),
(209, 1, 4, 2, 'PMA-18996', '[Test Task][iOS][Android][R17] Execute Sonos Playlist Editing', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-18996', '2024-11-21 02:31:17', '2024-11-21 10:22:10', NULL, NULL, '0'),
(210, 1, 5, 3, 'PMA-18629', '[iOS] Not Connected to WiFi UI not shown in Settings unless the user is logged in', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18629', '2024-11-21 02:38:01', '2024-11-21 03:28:29', NULL, NULL, '0'),
(211, 1, 5, 3, 'PMA-18685', '[iOS] Settings Menu Showing \"Nearby System\" instead of System Name', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18685', '2024-11-21 03:29:28', '2024-11-21 03:39:31', NULL, NULL, '0'),
(212, 1, 5, 3, 'PMA-17895', '[Lotus] - bonding failed when attempting to bond to Arc', 2, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-17895', '2024-11-21 03:50:54', '2024-11-21 08:26:31', NULL, NULL, '0'),
(213, 1, 20, 3, 'PMA-18769', '▲ [iOS] Crash in volume slider: EXC_BREAKPOINT: Fatal error > Float value cannot be converted to Int because it is outside the representable rang...', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18769', '2024-11-21 03:54:53', '2024-11-21 10:06:47', NULL, NULL, '0'),
(214, 1, 20, 2, 'PMA-18180', '▲ [iOS] - Sometimes the \"Session Controller\" shows a Glimmer/No Groups or Rooms, while the rest of the app works', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18180', '2024-11-21 03:55:55', '2024-11-21 10:06:31', NULL, NULL, '0'),
(215, 1, 20, 2, 'PMA-18179', '▲ [iOS] - Sometimes the UI gets stuck in a state where the Session Controller is half open and everything on the screen scrolls', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18179', '2024-11-21 04:22:29', '2024-11-21 10:06:01', NULL, NULL, '0'),
(216, 1, 2, 3, 'PMA-18770', 'EXC_BAD_ACCESS: Exception 1, Code 1, Subcode 4 >', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-18770', '2024-11-21 04:23:26', '2024-11-21 08:24:31', NULL, NULL, '0'),
(217, 1, 22, 2, 'PINE-4859', 'iOS App BVT - Passport main #4025', 2, 2, 'https://docs.google.com/spreadsheets/d/1NSBa6qAmmRg73NLMKIXXzrePYfz4tmzxgghzT4fIMrY/edit?gid=1490047368#gid=1490047368', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 7, 1, NULL, NULL, NULL, 'pine-4859', '2024-11-21 06:35:44', '2024-11-21 08:53:16', NULL, NULL, '0'),
(218, 1, 22, 2, 'PINE-4860', 'Pinewood BVT build NSUD 496', 2, 2, 'https://docs.google.com/spreadsheets/d/1zW_dh5AMMjnvWbMtjQmtZ6PKo2VJoUGbqgDVgDr5HYo/edit?gid=864665904#gid=864665904', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 7, 1, NULL, NULL, NULL, 'pine-4860', '2024-11-21 06:36:37', '2024-11-21 10:11:10', NULL, NULL, '0'),
(219, 1, 4, 3, 'PMA-17978', '▲ [Both] The message \"Service not found\" is displayed when removing the music service just as soon as it is added to HH', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-17978', '2024-11-21 07:06:05', '2024-11-21 09:26:03', NULL, NULL, '0'),
(220, 1, 20, 3, 'PMA-18940', '[Android] Volume slider scrubber cannot be dragged on Mini Now Playing and System View', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-18940', '2024-11-21 07:21:18', NULL, NULL, NULL, '0'),
(221, 1, 22, 1, 'PINE-4861', 'Sometimes, the position of TV Show results rail adjusts when moving between Movie results', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4861', '2024-11-21 07:24:27', NULL, NULL, NULL, '0'),
(222, 1, 22, 1, 'PINE-4862', 'com.sonos.cinemascope crashed when opening QAP then pressing mic button on the remote', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4862', '2024-11-21 07:31:39', NULL, NULL, NULL, '0'),
(223, 1, 24, 3, 'PMA-17893', '[iOS] [Android] [Lasso] Players vanish when added to an existing HH', 1, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'pma-17893', '2024-11-21 07:41:49', '2024-11-21 07:55:11', NULL, NULL, '0'),
(224, 5, NULL, 1, 'PMA-18999', '[Both] The chime is played while playing the Spotify free playlist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-18999', '2024-11-21 07:55:27', NULL, NULL, 205, '1'),
(225, 1, 24, 3, 'PMA-18097', '[iOS] App does not respond and may crash after completing the \'FIX IT\' process with an available update', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'pma-18097', '2024-11-21 07:55:38', NULL, NULL, NULL, '0'),
(226, 1, 24, 2, 'SWPBL-238124', 'SWPBL-238124 - [Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1Uc572Pw6ovo7maCHiIFm08fDZIY4OowvUmFpsuCe9x4/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-21 07:57:01', '2024-11-21 07:57:20', NULL, NULL, '0'),
(227, 1, 20, 3, 'PMA-15006', '[Android] show disabled track bar on fullNP', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-15006', '2024-11-21 08:29:24', NULL, NULL, NULL, '0'),
(228, 1, 4, 3, 'PMA-16905', '[iOS] \'Add to Sonos Playlist\' More Menu Option Should Not Be Presented for Spotify Free Content/Accounts', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 28, 0, 0, NULL, NULL, NULL, 'pma-16905', '2024-11-21 09:02:13', NULL, NULL, NULL, '0'),
(229, 1, 5, 1, 'PMA-19000', '[Android/iOS] [Voice Assistant] Missing Voice Assistant section for the first time launching app', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 29, 0, 0, 0, NULL, NULL, NULL, 'pma-19000', '2024-11-21 09:21:08', NULL, NULL, NULL, '0'),
(230, 5, NULL, 1, 'PMA-18998', '[iOS] [Alarm] The Shuffle Music toggle does not work after being enable', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-18998', '2024-11-21 09:22:49', NULL, NULL, 205, '1'),
(231, 1, 22, 1, 'PINE-4863', 'NullPointerException fatal on com.brdgwtr.keyboard.ime.pinewood', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4863', '2024-11-21 09:34:29', NULL, NULL, NULL, '0'),
(232, 1, 1, 2, 'PMA-19002', 'R17 Initial Configuration smoke test', 2, 2, 'https://docs.google.com/spreadsheets/d/1AsvnNLX7RRjupuk1IzL8IhhH3Si1Yw6iY1PwL_5pG1E/edit?gid=82489635#gid=82489635&range=A1', NULL, NULL, NULL, NULL, '0', NULL, 21, 5, 0, 0, NULL, NULL, NULL, 'pma-19002', '2024-11-21 09:43:35', '2024-11-21 10:13:49', NULL, NULL, '0'),
(233, 1, 23, 2, 'SWPBL-237716', '[MultiZone] - Execute Airplay and Spotify DC test cases', 1, 1, 'https://docs.google.com/spreadsheets/d/1V4BxgwtSVlRypfUeS_JqzbHiZMvj5HuK6WCRhB94bT0/edit?gid=932922177#gid=932922177', NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237716', '2024-11-21 09:49:32', NULL, NULL, NULL, '0'),
(234, 1, 23, 1, 'PMA-19001', '[Android][iOS] Insecurely registered player is still available for Spotify Direct Control', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'pma-19001', '2024-11-21 09:52:28', NULL, NULL, NULL, '0'),
(235, 1, 22, 1, 'PINE-4864', 'Number 1 on keyboard is always highlighted', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4864', '2024-11-21 09:53:53', NULL, NULL, NULL, '0'),
(236, 1, 22, 1, 'PINE-4865', 'java.net.SocketTimeoutException fatal on process com.brdgwtr.publisherservice', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4865', '2024-11-21 09:54:36', NULL, NULL, NULL, '0'),
(237, 1, 22, 1, 'PINE-4866', 'com.sonos.tv.sonosscreensaver crash when resuming from the screen saver', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4866', '2024-11-21 10:08:03', NULL, NULL, NULL, '0'),
(238, 1, 24, 2, 'SWPBL-237781', 'Verification Matrix', 2, 2, 'https://docs.google.com/spreadsheets/d/1vrb-0iQxa5yxlT-mL97DwnnJuLbBj9vkS0tC51VXkP0/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237781', '2024-11-21 10:11:03', '2024-11-22 09:41:55', NULL, NULL, '0'),
(239, 1, 24, 1, 'SWPBL-238520', 'Unable to remove surrounds from Lasso which is enabling 6Ghz on ath1', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238520', '2024-11-21 10:12:45', NULL, NULL, NULL, '0'),
(240, 1, 4, 3, 'PMA-18783', '▲ [iOS] Reordering sonos playlist items results in unpredictable behavior', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 10, 0, 0, NULL, NULL, NULL, 'pma-18783', '2024-11-21 10:22:51', NULL, NULL, NULL, '0'),
(241, 1, 4, 3, 'PMA-18554', '▼ [Android] Sonos Playlist: Extra RenamePlaylist operation is fired after reordering or deleting items', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 10, 0, 0, NULL, NULL, NULL, 'pma-18554', '2024-11-21 10:23:31', NULL, NULL, NULL, '0'),
(242, 1, 4, 1, 'PMA-18969', '[Android] Home Feed is reloaded after Save/ Unsave favorites on Home Feed', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-18969', '2024-11-21 10:25:31', NULL, NULL, NULL, '0'),
(243, 5, NULL, 10, 'ENGX-33338', 'Sprint 22 Beta 1 : Execute duke regression pass', 1, 1, NULL, '127684', '22', NULL, NULL, '0', NULL, 19, 12, 0, 0, 0, 57, 8, 'engx-33338', '2024-11-22 01:43:38', '2024-11-22 04:55:25', 17, NULL, '0'),
(244, 5, NULL, 10, 'ENGX-33631', 'Sprint 22 : Sprint 21 Beta 4 : Execute regression pass on iOS', 2, 3, NULL, '127849', '22', NULL, NULL, '0', NULL, 6, 18, 11, 0, 0, 254, 31, 'engx-33631', '2024-11-22 01:45:29', '2024-11-22 09:48:34', 18, NULL, '0'),
(245, 5, NULL, 10, 'ENGX-33330', 'Sprint 22 : Sprint 21 Beta 4 : Execute regression pass', 1, 1, NULL, '127681', '22', NULL, NULL, '0', NULL, 17, 0, 0, 0, 0, 123, 7, 'engx-33330', '2024-11-22 01:46:41', '2024-11-22 08:22:46', 19, NULL, '0'),
(246, 1, 4, 2, 'SWPBL-237995', '[Both] Adding Podcast Episode to Sonos Playlist Fails', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237995', '2024-11-22 02:12:18', '2024-11-22 04:50:53', NULL, NULL, '0'),
(247, 1, 20, 3, 'PMA-17396', 'Android: Group Volume Dialog doesn\'t appear on all screens it\'s expected to when using hw buttons', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-17396', '2024-11-22 02:39:14', '2024-11-22 03:32:33', NULL, NULL, '0'),
(248, 1, 4, 3, 'PMA-18852', '▲ [iOS] Unable to rename a sonos playlist and the \"Done\" button hit zone area is not correct.', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 28, 0, 0, NULL, NULL, NULL, 'pma-18852', '2024-11-22 02:57:26', '2024-11-22 08:41:37', NULL, NULL, '0'),
(249, 1, 5, 2, 'PMA-18599', 'Update TCs for Regression Pass', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-18599', '2024-11-22 03:00:28', NULL, NULL, NULL, '0'),
(250, 1, 5, 3, 'PMA-18572', '[Android] \"Scan for New Content\" status message appears after adding speaker', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18572', '2024-11-22 03:09:57', NULL, NULL, NULL, '0'),
(251, 1, 5, 3, 'PMA-18362', '[Android] The \'Scan for New Content\' status message appears after removing Surrounds', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18362', '2024-11-22 03:10:27', NULL, NULL, NULL, '0'),
(252, 1, 5, 3, 'PMA-18253', '[Android] \"Scan for New Content\" status message appears when changing time zone', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18253', '2024-11-22 03:10:54', NULL, NULL, NULL, '0'),
(253, 1, 20, 2, 'PMA-18893', '▲ [iOS] Group volume adjustments are not being applied to one member', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-18893', '2024-11-22 03:14:49', NULL, NULL, NULL, '0'),
(254, 1, 4, 3, 'PMA-18433', '● [iOS] Sonos Favorites heart icon should not be accessible with Voice Over', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 0, 0, 0, NULL, NULL, NULL, 'pma-18433', '2024-11-22 03:42:30', '2024-11-22 09:27:28', NULL, NULL, '0'),
(255, 1, 5, 3, 'PMA-18694', '[iOS] - VoiceOver doesn\'t announce default Speech Enhancement level', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18694', '2024-11-22 03:43:39', NULL, NULL, NULL, '0'),
(256, 1, 20, 3, 'PMA-18862', '[iOS] Disable unplayable tracks in the queue', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-18862', '2024-11-22 03:58:36', NULL, NULL, NULL, '0'),
(257, 1, 2, 3, 'PMA-17124', '[Android] Visible UI flickering/inconsistencies when Your Services and Recently Played swimlanes are loaded after Initializing state', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 15, 0, 0, 0, NULL, NULL, NULL, 'pma-17124', '2024-11-22 04:04:14', '2024-11-22 07:30:02', NULL, NULL, '0'),
(258, 1, 22, 2, 'PINE-4798', 'Review Test Cases', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 23, 27, 1, NULL, NULL, NULL, 'pine-4798', '2024-11-22 04:20:39', NULL, NULL, NULL, '0'),
(259, 1, 22, 2, 'PINE-4877', 'iOS App BVT - Passport main #4031', 2, 2, 'https://docs.google.com/spreadsheets/d/1NSBa6qAmmRg73NLMKIXXzrePYfz4tmzxgghzT4fIMrY/edit?gid=2099366802#gid=2099366802', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 1, 0, NULL, NULL, NULL, 'pine-4877', '2024-11-22 04:21:38', '2024-11-22 09:11:51', NULL, NULL, '0'),
(260, 1, 22, 2, 'PINE-4878', 'Pinewood BVT build NSUD 499', 2, 2, 'https://docs.google.com/spreadsheets/d/1zW_dh5AMMjnvWbMtjQmtZ6PKo2VJoUGbqgDVgDr5HYo/edit?gid=1614007928#gid=1614007928', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 1, 0, NULL, NULL, NULL, 'pine-4878', '2024-11-22 04:22:31', '2024-11-22 09:55:15', NULL, NULL, '0'),
(261, 1, 22, 1, 'PINE-4879', 'QAP displays behind the SVC results when pressing mic button on the remote, then opening QAP', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4879', '2024-11-22 04:23:20', '2024-11-22 10:08:09', NULL, NULL, '0'),
(262, 1, 5, 3, 'PMA-16089', '[iOS] [Era 100/Era 300] [Room Status] Back button navigate to Home Feed', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-16089', '2024-11-22 04:29:58', NULL, NULL, NULL, '0'),
(263, 1, 4, 3, 'PMA-18554', '▼ [Android] Sonos Playlist: Extra RenamePlaylist operation is fired after reordering or deleting items', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 10, 0, 0, NULL, NULL, NULL, 'pma-18554', '2024-11-22 07:26:40', '2024-11-22 07:27:04', NULL, NULL, '0'),
(264, 5, NULL, 1, 'PMA-19016', '[Both] App automatically returns back to the System Settings screen after adding/removing surrounds', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19016', '2024-11-22 07:28:18', NULL, NULL, 244, '1'),
(265, 1, 24, 1, 'SWPBL-238571', '[iOS] [Android] The scangetresults ath0 displays truncated SSID list after setup', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238571', '2024-11-22 07:45:46', NULL, NULL, NULL, '0'),
(266, 1, 22, 3, 'PINE-4866', 'com.sonos.tv.sonosscreensaver crash when resuming from the screen saver', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4866', '2024-11-22 07:57:40', NULL, NULL, NULL, '0'),
(267, 1, 5, 3, 'PMA-16894', '[iOS] In a newly created household after app reset some settings do not persist over a reboot', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 29, 0, 0, 0, NULL, NULL, NULL, 'pma-16894', '2024-11-22 08:12:08', '2024-11-22 09:14:03', NULL, NULL, '0'),
(268, 1, 1, 3, 'PMA-18693', '[ACR] Wizards Not Launching', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-18693', '2024-11-22 08:14:32', NULL, NULL, NULL, '0'),
(269, 1, 1, 2, 'No Ticket', 'Submit Diagnostics Update and Edit for Passport Regression Test Planner', 2, 2, 'https://docs.google.com/spreadsheets/d/17-UInGXMhx-PWnHMshuawSvvqb-mx7v9cWdJbiNPkvg/edit?gid=560884979#gid=560884979&range=A1', NULL, NULL, NULL, NULL, '0', NULL, 5, 21, 0, 0, NULL, NULL, NULL, 'no-ticket', '2024-11-22 08:16:00', NULL, NULL, NULL, '0'),
(270, 1, 20, 3, 'PMA-18843', '▲ [iOS] Repeated Playback error toast appear when opening More menu after triggering playback errors', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18843', '2024-11-22 08:20:05', NULL, NULL, NULL, '0'),
(271, 1, 22, 3, 'PINE-4837', 'Unable to show seasons and episodes in the TV show CDP', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4837', '2024-11-22 08:23:47', NULL, NULL, NULL, '0'),
(272, 1, 4, 3, 'PMA-18856', '▲ [iOS] Incorrect dark mode icon used for Content Hero Partner Attribution in both themes', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18856', '2024-11-22 08:26:56', NULL, NULL, NULL, '0'),
(273, 1, 20, 3, 'PMA-17879', 'Android: Performance - Refactor the playbackTarget volume abstraction and callbacks to cleanup errors and code', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-17879', '2024-11-22 08:29:12', NULL, NULL, NULL, '0'),
(274, 1, 22, 3, 'PINE-3822', '[iOS] Watchlist - Subtitle is not updated in Watchlists after removing item', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-3822', '2024-11-22 08:37:55', NULL, NULL, NULL, '0'),
(275, 1, 22, 1, 'PINE-4880', 'SVC results is still displayed when pressing mic button on the remote, then updating from 496 to 499', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4880', '2024-11-22 08:38:48', NULL, NULL, NULL, '0'),
(276, 1, 20, 3, 'PMA-10987', '[iOS] Focused session bg color for BT and Line-in', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-10987', '2024-11-22 08:39:59', NULL, NULL, NULL, '0'),
(277, 1, 22, 2, 'PINE-4875', 'When updating from 496 to 498, Pinewood gets stuck in \"Finishing update\" screen', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 1, 27, 23, 0, NULL, NULL, NULL, 'pine-4875', '2024-11-22 08:57:30', NULL, NULL, NULL, '0'),
(278, 1, 4, 1, 'PMA-19017', '[iOS] Sonos Favorites Home Empty State banner is not centered', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 10, 0, 0, NULL, NULL, NULL, 'pma-19017', '2024-11-22 09:09:30', NULL, NULL, NULL, '0'),
(279, 1, 4, 3, 'PMA-18270', '[Android] Simple HTTP client for loading local album art', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18270', '2024-11-22 09:30:27', NULL, NULL, NULL, '0'),
(280, 1, 24, 2, 'SWPBL-237781', 'Verification Matrix', 2, 2, 'https://docs.google.com/spreadsheets/d/1vrb-0iQxa5yxlT-mL97DwnnJuLbBj9vkS0tC51VXkP0/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237781', '2024-11-22 09:42:50', NULL, NULL, NULL, '0'),
(281, 5, NULL, 1, 'PMA-19018', '[iOS 18.0] Unable to join an existing system', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 18, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19018', '2024-11-22 09:50:43', '2024-11-22 09:51:07', NULL, 244, '1'),
(282, 1, 24, 3, 'PMA-18097', '[iOS] App does not respond and may crash after completing the \'FIX IT\' process with an available update', 2, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'pma-18097', '2024-11-22 09:58:23', NULL, NULL, NULL, '0'),
(283, 1, 23, 2, 'SWPBL-237716', '[MultiZone] - Execute Airplay and Spotify DC test cases', 1, 1, 'https://docs.google.com/spreadsheets/d/1V4BxgwtSVlRypfUeS_JqzbHiZMvj5HuK6WCRhB94bT0/edit?gid=932922177#gid=932922177', NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237716', '2024-11-22 09:58:30', NULL, NULL, NULL, '0'),
(284, 1, 23, 1, 'PMA-19015', '[iOS] \"Group rooms\" screen appears again when using deep link to Sonos application', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'pma-19015', '2024-11-22 09:59:30', NULL, NULL, NULL, '0'),
(285, 1, 24, 2, 'SWPBL-238124', 'SWPBL-238124 - [Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1Uc572Pw6ovo7maCHiIFm08fDZIY4OowvUmFpsuCe9x4/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-22 10:00:10', NULL, NULL, NULL, '0'),
(287, 1, 22, 1, 'PINE-4881', 'java.lang.IllegalArgumentException fatal on process com.sonos.tv.launcher', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4881', '2024-11-22 10:06:34', NULL, NULL, NULL, '0'),
(288, 1, 24, 3, 'SWPBL-238520', 'Unable to remove surrounds from Lasso which is enabling 6Ghz on ath1', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238520', '2024-11-22 10:07:37', NULL, NULL, NULL, '0'),
(289, 1, 22, 3, 'PINE-4248', 'No apps are displayed in \"Where to Watch\"', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4248', '2024-11-25 02:03:37', NULL, NULL, NULL, '0'),
(290, 5, NULL, 10, 'ENGX-33330', 'Sprint 22 : Sprint 21 Beta 4 : Execute regression pass', 2, 3, NULL, '127681', '22', NULL, NULL, '0', NULL, 17, 12, 11, 0, 0, 200, 18, 'engx-33330', '2024-11-25 02:20:26', '2024-11-25 10:17:38', 20, NULL, '0'),
(291, 5, NULL, 10, 'ENGX-33338', 'Sprint 22 Beta 1 : Execute duke regression pass', 2, 3, NULL, '127684', '22', NULL, NULL, '0', NULL, 19, 0, 0, 0, 0, 44, 0, 'engx-33338', '2024-11-25 02:20:53', '2024-11-25 10:09:43', 21, NULL, '0'),
(292, 5, NULL, 10, 'ENGX-33337', '2024 Sprint 22 RC 2 : Execute regression pass', 1, 1, NULL, '127934', '22', NULL, NULL, '0', NULL, 18, 0, 0, 0, 0, 119, 9, 'engx-33337', '2024-11-25 02:22:12', '2024-11-25 10:06:48', 22, NULL, '0'),
(293, 1, 24, 2, 'SWPBL-238571', '[iOS] [Android] The scangetresults ath0 displays truncated SSID list after setup', 1, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238571', '2024-11-25 02:29:39', NULL, NULL, NULL, '0'),
(294, 1, 5, 2, 'PMA-18599', 'Update TCs for Regression Pass', 1, 1, 'https://docs.google.com/spreadsheets/d/1yT8q0gGAUMZJptl1pFjQu7m-aU8maP50v4YvFk4FwYI/edit?gid=51829899#gid=51829899', NULL, NULL, NULL, NULL, '0', NULL, 24, 22, 0, 0, NULL, NULL, NULL, 'pma-18599', '2024-11-25 02:30:36', '2024-11-25 02:33:24', NULL, NULL, '0'),
(295, 1, 21, 3, 'SWPBL-238374', '[Android] Add mac address to the product settings page for all devices', 2, 3, 'https://docs.google.com/spreadsheets/d/1BfzBjDgcKF6OfaXkxvvwsy3DEXcPL9vVJHUDAfaCSQg/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 22, 10, 0, 0, NULL, NULL, NULL, 'swpbl-238374', '2024-11-25 02:35:33', '2024-11-25 08:19:27', NULL, NULL, '0'),
(296, 1, 21, 3, 'SWPBL-238276', '[iOS] Add mac address to the product settings page for all devices', 2, 3, 'https://docs.google.com/spreadsheets/d/1FwBmGTPdwPRCgZQxQpZ2dS4yDmFxpSJG4SluUeTPaGc/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 22, 10, 0, 0, NULL, NULL, NULL, 'swpbl-238276', '2024-11-25 02:37:10', '2024-11-25 08:18:43', NULL, NULL, '0'),
(297, 1, 20, 1, 'PMA-19036', '[iOS] Repeated Playback error toast appears when returning to room after changing focused room', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19036', '2024-11-25 03:04:30', NULL, NULL, NULL, '0'),
(298, 1, 20, 2, 'PMA-18417', '● [Both] \"No items available \" error shown upon loading pinned YouTube Music collections', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18417', '2024-11-25 03:28:21', NULL, NULL, NULL, '0'),
(299, 1, 4, 3, 'PMA-18958', '[Android] Use simple HTTP client on now playing', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18958', '2024-11-25 03:46:51', NULL, NULL, NULL, '0'),
(300, 1, 4, 3, 'PMA-18270', '[Android] Simple HTTP client for loading local album art', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18270', '2024-11-25 03:47:33', NULL, NULL, NULL, '0'),
(301, 1, 22, 2, 'PINE-4886', 'iOS App BVT - Passport main #4041', 2, 2, 'https://docs.google.com/spreadsheets/d/1NSBa6qAmmRg73NLMKIXXzrePYfz4tmzxgghzT4fIMrY/edit?gid=1051127451#gid=1051127451', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 1, 7, NULL, NULL, NULL, 'pine-4886', '2024-11-25 04:35:47', '2024-11-25 10:04:26', NULL, NULL, '0'),
(302, 1, 22, 2, 'PINE-4887', 'Pinewood BVT build NSUD 500', 2, 2, 'https://docs.google.com/spreadsheets/d/1zW_dh5AMMjnvWbMtjQmtZ6PKo2VJoUGbqgDVgDr5HYo/edit?gid=1321629044#gid=1321629044', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 1, 7, NULL, NULL, NULL, 'pine-4887', '2024-11-25 04:36:57', '2024-11-25 10:03:58', NULL, NULL, '0'),
(303, 1, 22, 2, 'PINE-4798', 'Review Test Cases', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 23, 27, 1, NULL, NULL, NULL, 'pine-4798', '2024-11-25 04:37:21', NULL, NULL, NULL, '0'),
(304, 1, 2, 3, 'PMA-17786', 'ApplicationNotResponding: Background ANR', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 15, 0, 0, 0, NULL, NULL, NULL, 'pma-17786', '2024-11-25 04:39:36', '2024-11-25 04:40:02', NULL, NULL, '0'),
(305, 1, 4, 3, 'PMA-18880', '[iOS] Sonos Playlist Hero View not updating playlist name after renaming', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-18880', '2024-11-25 04:43:54', NULL, NULL, NULL, '0'),
(306, 1, 4, 3, 'PMA-10805', '3 Sonos Radio pre-pinned swimlanes need to show up before Sonos Favorites', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-10805', '2024-11-25 04:44:55', '2024-11-25 07:29:48', NULL, NULL, '0'),
(307, 1, 22, 3, 'PINE-4675', '[iOS] [iPad] App crashes when opening CDP', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4675', '2024-11-25 07:16:28', NULL, NULL, NULL, '0'),
(308, 1, 20, 3, 'PMA-17879', 'Android: Performance - Refactor the playbackTarget volume abstraction and callbacks to cleanup errors and code', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-17879', '2024-11-25 07:17:24', '2024-11-25 10:12:35', NULL, NULL, '0'),
(309, 1, 22, 3, 'PINE-2807', 'Watchlist order auto back to the original order after renaming', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-2807', '2024-11-25 08:04:10', NULL, NULL, NULL, '0'),
(310, 1, 4, 1, 'PMA-19039', '[iOS] Sonos Radio swimlanes must be displayed at the bottom after removing all pinned collections', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-19039', '2024-11-25 08:20:46', NULL, NULL, NULL, '0'),
(311, 1, 1, 1, 'PMA-19040', '[iOS] Unable to add wireless Raven via Manual Pin', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 9, 0, 0, 0, NULL, NULL, NULL, 'pma-19040', '2024-11-25 08:28:22', NULL, NULL, NULL, '0'),
(312, 5, NULL, 1, 'PMA-19038', '[Both] Can not link to Sonos from GG Assistant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19038', '2024-11-25 08:28:24', NULL, NULL, 290, '1'),
(313, 1, 22, 2, 'PINE-3079', 'plex Live TV grid view does not have tall enough text boxes for some program listings', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-3079', '2024-11-25 08:33:47', NULL, NULL, NULL, '0'),
(314, 1, 5, 2, 'PMA-18685', '[iOS] Settings Menu Showing \"Nearby System\" instead of System Name', 2, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18685', '2024-11-25 08:53:31', NULL, NULL, NULL, '0'),
(315, 1, 20, 1, 'PMA-19042', '[Android] Mute volume icon for Fixed Volume always displays, even when it\'s not muted', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19042', '2024-11-25 09:42:36', NULL, NULL, NULL, '0'),
(316, 1, 22, 2, 'PINE-4863', 'NullPointerException fatal on com.brdgwtr.keyboard.ime.pinewood', 2, 10, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4863', '2024-11-25 09:57:28', NULL, NULL, NULL, '0'),
(317, 1, 1, 2, 'PMA-19037', 'AGEST - MFG Raven - R17', 2, 2, 'https://docs.google.com/spreadsheets/d/16T7ySRcB-n6BHGTF281lh7l9vI0cQvfC4RPwREhObEw/edit?usp=sharing', NULL, NULL, NULL, NULL, '0', NULL, 5, 9, 0, 0, NULL, NULL, NULL, 'pma-19037', '2024-11-25 10:04:26', NULL, NULL, NULL, '0'),
(318, 1, 23, 2, 'SWPBL-237716', '[MultiZone] - Execute Airplay and Spotify DC test cases', 1, 1, 'https://docs.google.com/spreadsheets/d/1V4BxgwtSVlRypfUeS_JqzbHiZMvj5HuK6WCRhB94bT0/edit?gid=932922177#gid=932922177', NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237716', '2024-11-25 10:05:06', NULL, NULL, NULL, '0'),
(319, 5, NULL, 1, 'DUKE-7149', '[DUKE][Android] The Passport app skipped the link Sonos Ace process after trying multiple times', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, 'duke-7149', '2024-11-25 10:15:15', NULL, NULL, 291, '1'),
(320, 5, NULL, 1, 'DUKE-7150', '[DUKE][Android] OTA update is shown despite Duke being on the latest build when setting it up', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, 'duke-7150', '2024-11-25 10:15:43', NULL, NULL, 291, '1'),
(321, 1, 1, 1, 'PMA-19044', '[iOS] Vanished player when creating new system with MFG Raven via AP Connect', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-19044', '2024-11-25 10:20:27', '2024-11-25 10:21:20', NULL, NULL, '0'),
(322, 1, 24, 2, 'SWPBL-238120', '[Apollo] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1VJE9R1m4xtov7c-5RBcpZ3peI-wWps9kTBED6M_mz9Y/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238120', '2024-11-25 10:24:51', NULL, NULL, NULL, '0'),
(323, 1, 24, 2, 'SWPBL-238124', 'SWPBL-238124 - [Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1Uc572Pw6ovo7maCHiIFm08fDZIY4OowvUmFpsuCe9x4/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-25 10:25:06', NULL, NULL, NULL, '0'),
(324, 1, 1, 1, 'PMA-19045', '[iOS] Unable to Fix Unconfigured Wireless Raven', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-19045', '2024-11-25 10:31:36', NULL, NULL, NULL, '0'),
(325, 5, NULL, 10, 'ENGX-33337', '2024 Sprint 22 RC 2 : Execute regression pass', 1, 1, NULL, '127934', '22', NULL, NULL, '0', NULL, 18, 19, 11, 0, 0, 280, 35, 'engx-33337', '2024-11-26 01:45:27', '2024-11-26 10:10:23', 23, NULL, '0'),
(326, 5, NULL, 10, 'ENGX-33650', 'Sprint 22 : Execute regression pass on R17 Beta and MA 2', 1, 1, NULL, '128097', '22', NULL, NULL, '0', NULL, 6, 17, 12, 0, 0, 182, 22, 'engx-33650', '2024-11-26 01:46:27', '2024-11-26 10:04:35', 24, NULL, '0'),
(327, 1, 20, 3, 'PMA-18843', '▲ [iOS] Repeated Playback error toast appear when opening More menu after triggering playback errors', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18843', '2024-11-26 02:07:51', '2024-11-26 04:33:03', NULL, NULL, '0'),
(328, 1, 22, 2, 'PINE-4895', 'iOS App BVT - Passport main #4056', 2, 2, 'https://docs.google.com/spreadsheets/d/1NSBa6qAmmRg73NLMKIXXzrePYfz4tmzxgghzT4fIMrY/edit?gid=350001378#gid=350001378', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 7, 1, NULL, NULL, NULL, 'pine-4895', '2024-11-26 02:14:07', '2024-11-26 09:29:43', NULL, NULL, '0'),
(329, 1, 22, 2, 'PINE-4798', 'Review Test Cases', 1, 1, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 23, 27, 1, NULL, NULL, NULL, 'pine-4798', '2024-11-26 02:15:54', NULL, NULL, NULL, '0'),
(330, 1, 5, 2, 'PMA-18599', 'Update TCs for Regression Pass', 1, 1, 'https://docs.google.com/spreadsheets/d/1yT8q0gGAUMZJptl1pFjQu7m-aU8maP50v4YvFk4FwYI/edit?gid=51829899#gid=51829899', NULL, NULL, NULL, NULL, '0', NULL, 22, 29, 0, 0, NULL, NULL, NULL, 'pma-18599', '2024-11-26 02:21:31', '2024-11-26 02:34:11', NULL, NULL, '0'),
(331, 1, 20, 3, 'PMA-18531', '[iOS] Update local library \"Access Denied\" playback error copy', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18531', '2024-11-26 02:29:04', '2024-11-26 10:04:47', NULL, NULL, '0'),
(332, 1, 4, 3, 'PMA-18270', '[Android] Simple HTTP client for loading local album art', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18270', '2024-11-26 02:31:36', '2024-11-26 10:05:20', NULL, NULL, '0'),
(333, 1, 4, 3, 'PMA-18958', '[Android] Use simple HTTP client on now playing', 2, 3, NULL, NULL, NULL, NULL, NULL, '1', 'Reviewed by Canh', 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18958', '2024-11-26 02:32:06', '2024-11-26 06:51:07', NULL, NULL, '0'),
(334, 1, 1, 3, 'PMA-15454', '[iOS] The asset for Ravens displays as wrong position when attempt to bonding Surround', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-15454', '2024-11-26 03:42:03', NULL, NULL, NULL, '0'),
(335, 1, 1, 3, 'PMA-15076', '[Passport] Ravens showing up with Sub imagery during bonding', 2, 9, NULL, NULL, NULL, NULL, NULL, '1', 'Reviewed', 5, 0, 0, 0, NULL, NULL, NULL, 'pma-15076', '2024-11-26 03:47:49', '2024-11-26 06:27:54', NULL, NULL, '0'),
(336, 1, 20, 3, 'PMA-13755', 'Android: Group volume dialog can disappear while user is holding down their touch on the slider.', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-13755', '2024-11-26 04:02:22', NULL, NULL, NULL, '0'),
(337, 1, 1, 3, 'PMA-12241', 'Raven is only supposed to be able to pair with other Ravens.', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 21, 0, 0, 0, NULL, NULL, NULL, 'pma-12241', '2024-11-26 06:54:30', NULL, NULL, NULL, '0'),
(338, 1, 20, 3, 'PMA-16964', '[Android] Allow items of different sizes to be reordered in LazyColumn', 2, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-16964', '2024-11-26 07:19:11', NULL, NULL, NULL, '0'),
(339, 1, 2, 2, 'PMA-18894', '[Android] Store feature flag overrides in SharedPreferences', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-18894', '2024-11-26 07:21:51', NULL, NULL, NULL, '0'),
(340, 1, 4, 3, 'PMA-18880', '[iOS] Sonos Playlist Hero View not updating playlist name after renaming', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-18880', '2024-11-26 07:22:07', NULL, NULL, NULL, '0'),
(341, 1, 4, 2, 'PMA-18515', '[iOS][Sonos Pro][Content Services] \"Why commercial services\" link displays an extra blank box below', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-18515', '2024-11-26 07:26:55', '2024-11-26 10:01:09', NULL, NULL, '0'),
(342, 1, 1, 3, 'PMA-18749', '[IOS] [Android] Offline primary and secondary causes missing zone and players from system', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 21, 0, 0, 0, NULL, NULL, NULL, 'pma-18749', '2024-11-26 07:29:51', NULL, NULL, NULL, '0'),
(343, 1, 22, 1, 'PINE-4896', '[iOS] No confirmation displayed when tapping Delete button in More Menu of watchlist', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4896', '2024-11-26 07:50:59', NULL, NULL, NULL, '0'),
(344, 1, 24, 2, 'PMA-18603', '[iOS] Sonos app asks for wifi password when setting up a new HH using WAC>Chirp mode', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'pma-18603', '2024-11-26 08:05:15', '2024-11-26 08:48:33', NULL, NULL, '0'),
(345, 1, 24, 2, 'SWPBL-238571', '[iOS] [Android] The scangetresults ath0 displays truncated SSID list after setup', 1, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238571', '2024-11-26 08:06:11', NULL, NULL, NULL, '0'),
(346, 5, NULL, 1, 'PMA-19076', '[LOC] The content of \"Create Sonos account\" page isn\'t fully translated to French and German', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19076', '2024-11-26 08:15:23', NULL, NULL, 326, '1'),
(347, 1, 20, 3, 'PMA-17642', '[Android] Update local library \"Access Denied\" playback error copy', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-17642', '2024-11-26 08:49:04', NULL, NULL, NULL, '0'),
(349, 1, 22, 1, 'PINE-4897', 'Pinewood Updating screen is dismissed when pressing Back/Home button on remote', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4897', '2024-11-26 09:13:05', NULL, NULL, NULL, '0'),
(350, 1, 2, 3, 'PMA-17401', '[Android] Add SSID to Nearby System SNF screen', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 15, 0, 0, 0, NULL, NULL, NULL, 'pma-17401', '2024-11-26 09:18:50', NULL, NULL, NULL, '0'),
(351, 1, 2, 3, 'PMA-18167', '[Android] Home screen displays in \"guest\" mode after forgetting system', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-18167', '2024-11-26 09:20:59', NULL, NULL, NULL, '0'),
(352, 5, NULL, 1, 'PMA-19077', '[iOS] \"Something went wrong\" popup appears when canceling \"Sign In\" prompt on the Parental Control screen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19077', '2024-11-26 09:23:37', NULL, NULL, 325, '1'),
(353, 1, 22, 1, 'PINE-4898', 'Missing episode title for some episodes in TV Show', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4898', '2024-11-26 09:26:06', NULL, NULL, NULL, '0'),
(354, 1, 20, 1, 'PMA-19078', '[Android] Queue order doesn’t update correctly after disabling shuffle', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19078', '2024-11-26 09:42:53', NULL, NULL, NULL, '0'),
(355, 1, 24, 2, 'SWPBL-238124', 'SWPBL-238124 - [Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1Uc572Pw6ovo7maCHiIFm08fDZIY4OowvUmFpsuCe9x4/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-26 09:50:06', NULL, NULL, NULL, '0'),
(356, 1, 24, 2, 'SWPBL-238120', '[Apollo] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1VJE9R1m4xtov7c-5RBcpZ3peI-wWps9kTBED6M_mz9Y/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238120', '2024-11-26 09:51:13', NULL, NULL, NULL, '0'),
(357, 1, 2, 1, 'PMA-19080', '[Android] \'Update Network\' and \'Set up a new system\' buttons don\'t show in Setting view after user forgets a system', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-19080', '2024-11-26 09:53:42', NULL, NULL, NULL, '0');
INSERT INTO `tasks` (`id`, `board_id`, `team`, `type`, `jira_id`, `jira_summary`, `working_status`, `ticket_status`, `link_to_result`, `test_plan`, `sprint`, `note`, `priority`, `status`, `review`, `tester_1`, `tester_2`, `tester_3`, `tester_4`, `tester_5`, `pass`, `fail`, `task_slug`, `created_at`, `updated_at`, `environment`, `parent_task_id`, `isSubBug`) VALUES
(358, 1, 20, 3, 'PMA-4842', '[Android] Display \"Source Name\" on Now Playing (and related areas) for Line-In playback', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-4842', '2024-11-26 09:53:51', NULL, NULL, NULL, '0'),
(359, 1, 1, 3, 'SWPBL-223944', '[Raven/Lasso/Era300] - Show battery status while connected via BT', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 21, 0, 0, 0, NULL, NULL, NULL, 'swpbl-223944', '2024-11-26 09:55:44', NULL, NULL, NULL, '0'),
(360, 1, 1, 3, 'PMA-18513', '[Android] [Raven] The app requires plugging in a network cable to a wired connection when adding to a system using AP>manual PIN', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 21, 0, 0, 0, NULL, NULL, NULL, 'pma-18513', '2024-11-26 09:56:14', NULL, NULL, NULL, '0'),
(361, 1, 4, 3, 'PMA-18960', '▲ [iOS] Something Went Wrong when reordering or deleting sonos playlist items', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18960', '2024-11-26 09:59:51', NULL, NULL, NULL, '0'),
(362, 1, 23, 2, 'SWPBL-237716', '[MultiZone] - Execute Airplay and Spotify DC test cases', 1, 1, 'https://docs.google.com/spreadsheets/d/1V4BxgwtSVlRypfUeS_JqzbHiZMvj5HuK6WCRhB94bT0/edit?gid=932922177#gid=932922177', NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237716', '2024-11-26 10:00:06', NULL, NULL, NULL, '0'),
(363, 1, 23, 1, 'PMA-19079', '[Android][iOS] Partner attribution logo is disappeared in Mini Now Playing after removing Spotify music service', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'pma-19079', '2024-11-26 10:00:52', NULL, NULL, NULL, '0'),
(364, 5, NULL, 1, 'PMA-19081', '[Android] [Airplay] Missing the Explicit badge on Miniplayer, System view and Output picker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19081', '2024-11-26 10:05:33', NULL, NULL, 326, '1'),
(365, 1, 1, 3, 'PMA-18481', '[iOS] [Android] [Raven] Unable to add the player using the manual PIN', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-18481', '2024-11-26 10:07:58', NULL, NULL, NULL, '0'),
(366, 1, 4, 1, 'PMA-19082', '[Android] The Music Library albums in Recently Played swimlane does not display album art', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-19082', '2024-11-26 10:27:56', NULL, NULL, NULL, '0'),
(367, 1, 5, 3, 'PMA-18169', '[iOS] Inconsistent player status at System Settings screen', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18169', '2024-11-27 02:07:20', '2024-11-27 03:31:47', NULL, NULL, '0'),
(368, 1, 2, 3, 'PMA-19065', '[iOS 18][R17] Passport remains glimmering after launch. \"On Foreground\" task not executed in PassportApp', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-19065', '2024-11-27 02:08:52', '2024-11-27 05:01:00', NULL, NULL, '0'),
(369, 1, 20, 3, 'PMA-18531', '[iOS] Update local library \"Access Denied\" playback error copy', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18531', '2024-11-27 02:16:02', '2024-11-27 02:57:26', NULL, NULL, '0'),
(370, 1, 2, 3, 'PMA-17401', '[Android] Add SSID to Nearby System SNF screen', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 15, 0, 0, 0, NULL, NULL, NULL, 'pma-17401', '2024-11-27 02:17:04', '2024-11-27 02:32:47', NULL, NULL, '0'),
(371, 1, 5, 2, 'PMA-18599', 'Update TCs for Regression Pass', 1, 1, 'https://docs.google.com/spreadsheets/d/1yT8q0gGAUMZJptl1pFjQu7m-aU8maP50v4YvFk4FwYI/edit?gid=51829899#gid=51829899', NULL, NULL, NULL, NULL, '0', NULL, 29, 0, 0, 0, NULL, NULL, NULL, 'pma-18599', '2024-11-27 02:18:12', NULL, NULL, NULL, '0'),
(372, 1, 22, 2, 'PINE-4904', 'iOS App BVT - Passport main #4068', 2, 2, 'https://docs.google.com/spreadsheets/d/1NSBa6qAmmRg73NLMKIXXzrePYfz4tmzxgghzT4fIMrY/edit?gid=1495117473#gid=1495117473', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 7, 1, NULL, NULL, NULL, 'pine-4904', '2024-11-27 02:38:29', '2024-11-27 07:49:47', NULL, NULL, '0'),
(373, 1, 22, 3, 'PINE-4675', '[iOS] [iPad] App crashes when opening CDP', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4675', '2024-11-27 03:06:24', NULL, NULL, NULL, '0'),
(374, 1, 4, 3, 'PMA-19007', '[iOS][Sonos Favorites] Sonos Playlists Album Art Flickering When Viewing Playlist Swimlane', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-19007', '2024-11-27 03:09:50', NULL, NULL, NULL, '0'),
(375, 5, NULL, 10, 'ENGX-33650', 'Sprint 22 : Execute regression pass on R17 Beta and MA 2', 2, 3, NULL, '128097', '22', NULL, NULL, '0', NULL, 6, 17, 12, 11, 0, 308, 38, 'engx-33650', '2024-11-27 03:11:19', '2024-11-27 10:40:36', 25, NULL, '0'),
(376, 1, 4, 3, 'PMA-18677', '● [iOS] Success Toasts Cannot Be Selected to Browse to Sonos Playlist', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 0, 0, 0, NULL, NULL, NULL, 'pma-18677', '2024-11-27 03:25:04', '2024-11-27 08:00:51', NULL, NULL, '0'),
(377, 1, 22, 1, 'PINE-4905', '[iOS] The existing watchlists do not appear in Watchlist wizard of CDP', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4905', '2024-11-27 03:25:15', '2024-11-27 03:40:41', NULL, NULL, '0'),
(378, 1, 5, 3, 'PMA-18612', '[Android] [EQ] Scrubber is distorted when dragging', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-18612', '2024-11-27 03:31:09', NULL, NULL, NULL, '0'),
(379, 1, 22, 1, 'PINE-4907', '[iOS] Virtual Remote does not work when the PW room is not focused in System View', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4907', '2024-11-27 03:41:31', NULL, NULL, NULL, '0'),
(380, 1, 22, 1, 'PINE-4906', '[iOS] Unable to load Watch tab', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4906', '2024-11-27 04:03:56', NULL, NULL, NULL, '0'),
(381, 1, 20, 1, 'PMA-19113', '[Android] App crashes after Playback errors display (Play, Pause, Stop, etc.)', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19113', '2024-11-27 04:17:49', NULL, NULL, NULL, '0'),
(382, 1, 22, 3, 'PINE-4485', '[iOS] App crashes when moving watchlist item to the end of the list', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 23, 0, 0, 0, NULL, NULL, NULL, 'pine-4485', '2024-11-27 04:18:59', NULL, NULL, NULL, '0'),
(383, 1, 5, 3, 'PMA-17955', '[LOC][Android] [iOS] \"Content in the Sonos S1 App\" does not translate in downgrade section of Passport', 2, 2, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-17955', '2024-11-27 04:23:06', NULL, NULL, NULL, '0'),
(384, 1, 20, 3, 'PMA-12381', 'Android: Upgrade PlaybackTarget API for PlaybackControls to return more than just a Boolean.', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-12381', '2024-11-27 04:23:13', '2024-11-27 05:55:40', NULL, NULL, '0'),
(385, 1, 4, 1, 'PMA-19114', '[iOS][R17 & Main][Edit Sonos Playlist] App crashes when dragging song to bottom and hitting spinner icon', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-19114', '2024-11-27 06:15:11', NULL, NULL, NULL, '0'),
(386, 1, 24, 2, 'SWPBL-238571', '[iOS] [Android] The scangetresults ath0 displays truncated SSID list after setup', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238571', '2024-11-27 06:39:07', NULL, NULL, NULL, '0'),
(387, 1, 24, 2, 'SWPBL-238124', 'SWPBL-238124 - [Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1Uc572Pw6ovo7maCHiIFm08fDZIY4OowvUmFpsuCe9x4/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-27 06:39:26', NULL, NULL, NULL, '0'),
(388, 1, 2, 2, 'PMA-16861', '[iOS] Create SystemProvider', 1, 4, 'https://docs.google.com/spreadsheets/d/1yh787r5S7zV50ojhYQ4yvQDrFAFwjenQqIoaOvQO654/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-16861', '2024-11-27 06:44:06', '2024-11-27 08:27:07', NULL, NULL, '0'),
(389, 1, 22, 1, 'PINE-4912', '[iOS] An Error State does not display when creating duplicate watchlist', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4912', '2024-11-27 06:55:56', NULL, NULL, NULL, '0'),
(390, 1, 4, 3, 'PMA-18960', '▲ [iOS] Something Went Wrong when reordering or deleting sonos playlist items', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-18960', '2024-11-27 06:56:42', '2024-11-27 09:54:40', NULL, NULL, '0'),
(391, 1, 5, 1, 'PMA-19115', '[Android] [Music Library] Toast message makes page overlap when tapped multiple times', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 29, 0, 0, 0, NULL, NULL, NULL, 'pma-19115', '2024-11-27 07:07:31', NULL, NULL, NULL, '0'),
(392, 1, 20, 1, 'PMA-19116', '[Android] Couldn\'t set shuffle toasts always display after tapping on large play button', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19116', '2024-11-27 07:35:05', NULL, NULL, NULL, '0'),
(393, 1, 1, 2, 'No ticket', 'Raven Configuration Review', 2, 2, 'https://docs.google.com/document/d/1IGGSfGy7PMS5L99_Q6ipvPsHYax12MpslKbn8lrhu4Y/edit?usp=sharing', NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'no-ticket', '2024-11-27 07:39:53', '2024-11-27 09:49:38', NULL, NULL, '0'),
(394, 1, 22, 2, 'PINE-4913', 'Pinewood BVT build NSUD 510', 2, 2, 'https://docs.google.com/spreadsheets/d/1zW_dh5AMMjnvWbMtjQmtZ6PKo2VJoUGbqgDVgDr5HYo/edit?gid=1748568318#gid=1748568318', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 1, 7, NULL, NULL, NULL, 'pine-4913', '2024-11-27 07:39:54', '2024-11-27 10:16:41', NULL, NULL, '0'),
(395, 1, 20, 3, 'PMA-18710', '[iOS] Can play explicit song/track in Search and Search History even with Parental Controls enabled', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-18710', '2024-11-27 07:45:02', NULL, NULL, NULL, '0'),
(397, 1, 24, 1, 'SWPBL-238735', 'User is able to bond the wired STA-only satellites to wireless HT-primary', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238735', '2024-11-27 08:41:44', NULL, NULL, NULL, '0'),
(398, 1, 4, 3, 'PMA-15341', '[iOS][Edit Sonos Playlist] Should adjust the space before the Delete button', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 0, 0, 0, NULL, NULL, NULL, 'pma-15341', '2024-11-27 08:44:02', NULL, NULL, NULL, '0'),
(399, 1, 4, 3, 'PMA-15868', '[iOS][Edit Sonos Playlist] Spacing between items should be reduced', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 0, 0, 0, NULL, NULL, NULL, 'pma-15868', '2024-11-27 08:45:19', NULL, NULL, NULL, '0'),
(400, 1, 22, 1, 'PINE-4914', 'java.io.IOException fatal on process com.sonos.tv.music', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4914', '2024-11-27 08:50:58', NULL, NULL, NULL, '0'),
(401, 1, 4, 2, 'PMA-18801', '● [Android] Adding an item from the currently viewed playlist to itself does not refresh the playlist', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-18801', '2024-11-27 08:52:45', NULL, NULL, NULL, '0'),
(402, 1, 4, 1, 'PMA-19118', '[iOS] Adding an item from the currently viewed playlist to itself does not refresh the playlist', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-19118', '2024-11-27 09:19:20', NULL, NULL, NULL, '0'),
(403, 1, 2, 3, 'PMA-17784', 'iOS app showing incorrect IP address in diagnostic', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 15, 0, 0, 0, NULL, NULL, NULL, 'pma-17784', '2024-11-27 09:32:33', NULL, NULL, NULL, '0'),
(404, 1, 1, 2, 'No ticket', 'Test Plan Creation', 1, 2, 'https://docs.google.com/spreadsheets/d/1bdcWvk0SQBFtUdf3kB9FUewkYRCusIUUOA4CFJH-sEE/edit?usp=sharing', NULL, NULL, NULL, NULL, '0', NULL, 21, 0, 0, 0, NULL, NULL, NULL, 'no-ticket', '2024-11-27 09:48:00', '2024-11-27 09:50:59', NULL, NULL, '0'),
(405, 5, NULL, 1, 'PMA-19111', '[Android] The playback shows Pause button when user plays Live Station', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19111', '2024-11-27 09:50:55', NULL, NULL, 375, '1'),
(406, 5, NULL, 1, 'PMA-19112', '[Android] The album art is zoomed in when playing Live Station', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19112', '2024-11-27 09:51:25', NULL, NULL, 375, '1'),
(407, 1, 4, 1, 'PMA-19120', '[iOS] The \'>\' icon does not work on all selectable toast messages', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 0, 0, 0, NULL, NULL, NULL, 'pma-19120', '2024-11-27 09:53:17', NULL, NULL, NULL, '0'),
(408, 5, NULL, 10, 'ENGX-33664', '2024 Sprint 22 MA 3 : Execute smoke test Pass', 2, 3, NULL, '128174', '22', NULL, NULL, '0', NULL, 19, 18, 0, 0, 0, 191, 12, 'engx-33664', '2024-11-27 09:54:10', '2024-11-27 10:37:47', 26, NULL, '0'),
(409, 1, 4, 3, 'PMA-18956', '[iOS] \'Add to Playlist\' Header Should Be Sticky', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 10, 30, 0, 0, NULL, NULL, NULL, 'pma-18956', '2024-11-27 09:54:38', NULL, NULL, NULL, '0'),
(410, 1, 20, 2, 'PMA-18323', '▲ [Both] Playback status on Playing room does not sync with Line-in source when playing/pausing music', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-18323', '2024-11-27 10:01:28', NULL, NULL, NULL, '0'),
(411, 1, 24, 2, 'SWPBL-238120', '[Apollo] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1VJE9R1m4xtov7c-5RBcpZ3peI-wWps9kTBED6M_mz9Y/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 20, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238120', '2024-11-27 10:02:48', NULL, NULL, NULL, '0'),
(412, 1, 23, 2, 'SWPBL-237716', '[MultiZone] - Execute Airplay and Spotify DC test cases', 1, 1, 'https://docs.google.com/spreadsheets/d/1V4BxgwtSVlRypfUeS_JqzbHiZMvj5HuK6WCRhB94bT0/edit?gid=932922177#gid=932922177', NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'swpbl-237716', '2024-11-27 10:10:20', NULL, NULL, NULL, '0'),
(413, 1, 23, 1, 'PMA-19121', '[Android][iOS] Cannot Spotify DC to a player which is newly-ungrouped and used to be Spotify DC to', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 13, 0, 0, 0, NULL, NULL, NULL, 'pma-19121', '2024-11-27 10:10:57', NULL, NULL, NULL, '0'),
(414, 1, 22, 2, 'PINE-3766', 'Publisher App is not launched when tapping on Up Next item from Mobile app', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-3766', '2024-11-28 01:24:59', '2024-11-28 01:39:48', NULL, NULL, '0'),
(415, 1, 22, 2, 'PINE-4447', 'Prime Video: Sometimes app does not display full screen when browsing the content', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4447', '2024-11-28 01:43:02', NULL, NULL, NULL, '0'),
(417, 5, NULL, 10, 'ENGX-33333', '2024 Sprint 22 - Alpha 1 : Execute regression pass', 1, 1, NULL, '126959', '22', NULL, NULL, '0', NULL, 17, 6, 11, 0, 0, NULL, NULL, 'engx-33333', '2024-11-28 01:46:58', '2024-11-28 01:48:17', 28, NULL, '0'),
(418, 1, 22, 2, 'PINE-3479', '[Pinewood] - ifood.tv app navigation pane overlaps the main screen', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-3479', '2024-11-28 01:57:14', NULL, NULL, NULL, '0'),
(419, 1, 22, 2, 'PINE-3076', 'Apple TV app uses 98+% CPU while backgrounded', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 1, 0, 0, 0, NULL, NULL, NULL, 'pine-3076', '2024-11-28 02:06:43', '2024-11-28 02:39:40', NULL, NULL, '0'),
(420, 1, 22, 2, 'PINE-3420', '[Pinewood] - Next Episode on home screen not in sync with AppleTV app', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 1, 0, 0, 0, NULL, NULL, NULL, 'pine-3420', '2024-11-28 02:07:24', '2024-11-28 06:43:08', NULL, NULL, '0'),
(421, 1, 22, 2, 'PINE-4392', 'Fawesome video is getting stuck at splash screen when launching from Up Next', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4392', '2024-11-28 02:07:32', NULL, NULL, NULL, '0'),
(423, 1, 22, 2, 'PINE-3466', 'Channel guide doesn\'t load on Pluto', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-3466', '2024-11-28 02:11:32', '2024-11-28 02:20:10', NULL, NULL, '0'),
(424, 1, 5, 2, 'PMA-18599', 'Update TCs for Regression Pass', 1, 1, 'https://docs.google.com/spreadsheets/d/1yT8q0gGAUMZJptl1pFjQu7m-aU8maP50v4YvFk4FwYI/edit?gid=51829899#gid=51829899', NULL, NULL, NULL, NULL, '0', NULL, 29, 22, 0, 0, NULL, NULL, NULL, 'pma-18599', '2024-11-28 02:13:02', NULL, NULL, NULL, '0'),
(425, 1, 22, 2, 'PINE-3080', 'plex Movies and Shows screen \"Continue watching\" textbox is sometimes not tall enough', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-3080', '2024-11-28 02:14:06', '2024-11-28 02:20:21', NULL, NULL, '0'),
(426, 1, 22, 2, 'PINE-3381', '[Pinewood] - AppleTV+ Artwork for resume Episode should be displayed', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-3381', '2024-11-28 02:14:45', '2024-11-28 02:54:25', NULL, NULL, '0'),
(427, 1, 4, 3, 'PMA-11886', '[iOS] Sonos Radio Swimlanes Are Not Pre-Populated', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 30, 0, 0, 0, NULL, NULL, NULL, 'pma-11886', '2024-11-28 02:15:00', NULL, NULL, NULL, '0'),
(428, 1, 22, 2, 'PINE-3443', 'Pinewood - Plex playback slow after visiting Pinewood settings', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-3443', '2024-11-28 02:55:01', NULL, NULL, NULL, '0'),
(429, 1, 20, 3, 'PMA-16964', '[Android] Allow items of different sizes to be reordered in LazyColumn', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-16964', '2024-11-28 02:57:10', NULL, NULL, NULL, '0'),
(430, 1, 22, 2, 'PINE-4922', 'iOS App BVT - Passport main #4075', 2, 2, 'https://docs.google.com/spreadsheets/d/1NSBa6qAmmRg73NLMKIXXzrePYfz4tmzxgghzT4fIMrY/edit?gid=121587883#gid=121587883', NULL, NULL, NULL, NULL, '0', NULL, 27, 23, 7, 1, NULL, NULL, NULL, 'pine-4922', '2024-11-28 03:02:27', '2024-11-28 08:51:52', NULL, NULL, '0'),
(431, 1, 2, 1, 'PMA-19128', '[iOS] The SNF view displays instead of Nearby System view when user changes to another network', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-19128', '2024-11-28 03:23:33', NULL, NULL, NULL, '0'),
(432, 1, 2, 2, 'PMA-16861', '[iOS] Create SystemProvider', 1, 4, 'https://docs.google.com/spreadsheets/d/1yh787r5S7zV50ojhYQ4yvQDrFAFwjenQqIoaOvQO654/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 24, 0, 0, 0, NULL, NULL, NULL, 'pma-16861', '2024-11-28 03:24:13', NULL, NULL, NULL, '0'),
(433, 1, 22, 2, 'PINE-4574', 'Searching and selecting the show \"The Tyrant\" on Hulu should not redirect back to the home screen', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4574', '2024-11-28 03:43:48', NULL, NULL, NULL, '0'),
(434, 1, 22, 1, 'PINE-4923', '[iOS] The subtitle of watchlist in Watchlist wizard display incorrectly', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4923', '2024-11-28 04:26:34', NULL, NULL, NULL, '0'),
(435, 1, 22, 2, 'PINE-3783', 'Brief but noticeable delay between audio and video start when initiating playback of content', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-3783', '2024-11-28 04:37:08', '2024-11-28 06:50:18', NULL, NULL, '0'),
(436, 1, 20, 1, 'PMA-19131', '[Android] \'Previous track\' button is enable when playing Live station', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19131', '2024-11-28 07:05:54', NULL, NULL, NULL, '0'),
(437, 1, 22, 2, 'PINE-4510', 'FilmRise app gets crashed after pressing Go to App button when starting a recently watch movie', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-4510', '2024-11-28 07:09:25', NULL, NULL, NULL, '0'),
(438, 1, 22, 2, 'PINE-3380', '[Pinewood] - infinite spinner when logging in via link.apple.com', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 1, 0, 0, 0, NULL, NULL, NULL, 'pine-3380', '2024-11-28 07:13:57', NULL, NULL, NULL, '0'),
(439, 1, 4, 1, 'PMA-19132', '[Android] Sonos Playlist in Recently Played shows subtitle as \"Playlist\"', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-19132', '2024-11-28 07:16:48', NULL, NULL, NULL, '0'),
(440, 1, 20, 3, 'PMA-19116', '[Android] Couldn\'t set shuffle toasts always display after tapping on large play button', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-19116', '2024-11-28 07:18:07', NULL, NULL, NULL, '0'),
(441, 1, 22, 2, 'PINE-3465', 'Very stuttery/choppy video during playback of Max content', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 7, 0, 0, 0, NULL, NULL, NULL, 'pine-3465', '2024-11-28 07:27:39', '2024-11-28 08:45:16', NULL, NULL, '0'),
(442, 5, NULL, 10, 'ENGX-33336', 'Sprint 22: Execute voice regression pass on Mainline Alpha build', 1, 1, NULL, '128264', '22', NULL, NULL, '0', NULL, 19, 0, 0, 0, 0, NULL, NULL, 'engx-33336', '2024-11-28 07:41:47', '2024-11-28 07:43:16', 29, NULL, '0'),
(443, 1, 20, 3, 'PMA-19113', '[Android] App crashes after Playback errors display (Play, Pause, Stop, etc.)', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19113', '2024-11-28 07:49:53', NULL, NULL, NULL, '0'),
(444, 1, 22, 1, 'PINE-4924', '[iOS] Quick saves section shows incorrect name after deleting last item', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-4924', '2024-11-28 07:55:11', NULL, NULL, NULL, '0'),
(445, 1, 24, 2, 'SWPBL-238124', 'SWPBL-238124 - [Fury] Legacy Primary HTAP regression test for 2025 player 1 release', 1, 1, 'https://docs.google.com/spreadsheets/d/1Uc572Pw6ovo7maCHiIFm08fDZIY4OowvUmFpsuCe9x4/edit?gid=0#gid=0', NULL, NULL, NULL, NULL, '0', NULL, 26, 0, 0, 0, NULL, NULL, NULL, 'swpbl-238124', '2024-11-28 08:41:09', NULL, NULL, NULL, '0'),
(446, 5, NULL, 10, 'ENGX-33337', '2024 Sprint 22 RC 2 : Execute regression pass', 2, 3, NULL, '127934', '22', NULL, NULL, '0', NULL, 18, 19, 0, 0, 0, 90, 12, 'engx-33337', '2024-11-28 08:57:28', '2024-11-28 08:59:21', 30, NULL, '0'),
(447, 5, NULL, 1, 'PMA-19129', '[Android] There no \"Software Update\" screen when joined to \"2023 R6\" system', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 18, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19129', '2024-11-28 09:00:21', NULL, NULL, 446, '1'),
(449, 1, 22, 2, 'PINE-3468', 'Garbled video during playback on Plex', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 27, 0, 0, 0, NULL, NULL, NULL, 'pine-3468', '2024-11-28 09:22:03', NULL, NULL, NULL, '0'),
(450, 1, 22, 2, 'PINE-3336', '[Pinewood] - Pinewood went unexpectedly to the home screen while watching Apple TV+', 2, 3, NULL, NULL, NULL, NULL, NULL, '0', NULL, 1, 0, 0, 0, NULL, NULL, NULL, 'pine-3336', '2024-11-28 09:35:34', NULL, NULL, NULL, '0'),
(451, 5, NULL, 1, 'PMA-19135', '[Android] Talkback doesn\'t read the service account on Search All page', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'pma-19135', '2024-11-28 09:36:59', NULL, NULL, 417, '1'),
(452, 1, 1, 1, 'PMA-19130', '[iOS] Not trigger the In-line update player with V1 Cert player running old firmware', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-19130', '2024-11-28 09:49:10', NULL, NULL, NULL, '0'),
(453, 1, 4, 3, 'PMA-19019', '▲ [iOS] Passport should unsubscribe to Sonos Playlists when they are not visible to the user', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 10, 0, 0, NULL, NULL, NULL, 'pma-19019', '2024-11-28 09:49:21', NULL, NULL, NULL, '0'),
(454, 1, 1, 1, 'PMA-19136', '[iOS][Android] Unable to Setup Ravens as Surround to Pinewood', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 5, 0, 0, 0, NULL, NULL, NULL, 'pma-19136', '2024-11-28 09:49:36', NULL, NULL, NULL, '0'),
(455, 1, 4, 3, 'PMA-19103', 'Sonos playlist browse and edit view should use the same page size', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 28, 0, 0, 0, NULL, NULL, NULL, 'pma-19103', '2024-11-28 09:49:53', NULL, NULL, NULL, '0'),
(456, 1, 5, 1, 'PMA-19134', '[Area Zone] [Alarm] Inconsistent alarm screen when setting up the zone', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 22, 0, 0, 0, NULL, NULL, NULL, 'pma-19134', '2024-11-28 09:54:47', NULL, NULL, NULL, '0'),
(457, 1, 2, 3, 'PMA-17784', 'iOS app showing incorrect IP address in diagnostic', 2, 7, NULL, NULL, NULL, NULL, NULL, '0', NULL, 15, 0, 0, 0, NULL, NULL, NULL, 'pma-17784', '2024-11-28 09:54:57', NULL, NULL, NULL, '0'),
(458, 1, 20, 2, 'PMA-19083', '[Passport] - Stuck in Update Loop During Grouping Due to Output Picker not Dismissing', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 25, 0, 0, 0, NULL, NULL, NULL, 'pma-19083', '2024-11-28 10:03:20', NULL, NULL, NULL, '0'),
(459, 1, 20, 1, 'PMA-19137', '[Android][Talkback] Playback error toasts are read twice', 2, 9, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-19137', '2024-11-28 10:04:29', NULL, NULL, NULL, '0'),
(460, 1, 20, 3, 'PMA-12381', 'Android: Upgrade PlaybackTarget API for PlaybackControls to return more than just a Boolean.', 1, 4, NULL, NULL, NULL, NULL, NULL, '0', NULL, 14, 0, 0, 0, NULL, NULL, NULL, 'pma-12381', '2024-11-28 10:05:12', NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `task_histories`
--

CREATE TABLE `task_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_histories`
--

INSERT INTO `task_histories` (`id`, `task_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 384, 'Sang Le updated working status from Done to In Progress', '2024-11-27 05:55:21', NULL),
(2, 384, 'Sang Le updated working status from In Progress to Done', '2024-11-27 05:55:39', NULL),
(3, 385, 'Tuong Vo created task', '2024-11-27 06:15:11', NULL),
(4, 345, 'Thanh Dang cloned task', '2024-11-27 06:39:07', NULL),
(5, 355, 'Thanh Dang cloned task', '2024-11-27 06:39:27', NULL),
(6, 388, 'Hieu Dang created task', '2024-11-27 06:44:07', NULL),
(7, 376, 'Vuong Bui updated ticket status from In Verification to Resolved', '2024-11-27 06:51:10', NULL),
(8, 376, 'Vuong Bui updated working status from In Progress to Done', '2024-11-27 06:51:17', NULL),
(9, 377, 'Nhan Tran cloned task', '2024-11-27 06:55:56', NULL),
(10, 361, 'Tuong Vo cloned task', '2024-11-27 06:56:42', NULL),
(11, 391, 'Tai Le created task', '2024-11-27 07:07:31', NULL),
(12, 392, 'Diem Nguyen created task', '2024-11-27 07:35:05', NULL),
(13, 393, 'Tai Ngo created task', '2024-11-27 07:39:54', NULL),
(14, 302, 'Nhan Tran cloned task', '2024-11-27 07:39:55', NULL),
(15, 395, 'Duy Phan created task', '2024-11-27 07:45:02', NULL),
(16, 372, 'Nhan Tran updated working status from In Progress to Done', '2024-11-27 07:49:39', NULL),
(17, 372, 'Nhan Tran updated ticket status from In Progress to Closed', '2024-11-27 07:49:47', NULL),
(18, 376, 'Vuong Bui updated task', '2024-11-27 08:00:51', NULL),
(19, 396, 'Vuong Bui created task', '2024-11-27 08:01:34', NULL),
(20, 388, 'Hieu Dang updated task', '2024-11-27 08:27:07', NULL),
(21, 397, 'An Duong created task', '2024-11-27 08:41:44', NULL),
(22, 398, 'Vuong Bui created task', '2024-11-27 08:44:02', NULL),
(23, 399, 'Vuong Bui created task', '2024-11-27 08:45:20', NULL),
(24, 375, 'Hieu Tran updated working status from In Progress to Done', '2024-11-27 08:48:35', NULL),
(25, 389, 'Nhan Tran cloned task', '2024-11-27 08:50:59', NULL),
(26, 401, 'Duy Phan created task', '2024-11-27 08:52:45', NULL),
(27, 402, 'Duy Phan created task', '2024-11-27 09:19:20', NULL),
(28, 403, 'Chieu Mai created task', '2024-11-27 09:32:33', NULL),
(29, 375, 'Hien Huynh updated task', '2024-11-27 09:41:33', NULL),
(30, 404, 'Canh Tran created task', '2024-11-27 09:48:00', NULL),
(31, 375, 'Hien Huynh updated task', '2024-11-27 09:49:30', NULL),
(32, 393, 'Canh Tran updated task', '2024-11-27 09:49:38', NULL),
(33, 375, 'Hien Huynh updated task', '2024-11-27 09:49:48', NULL),
(34, 375, 'Hien Huynh addded a sub bug', '2024-11-27 09:50:55', NULL),
(35, 404, 'Canh Tran updated ticket status from Open to Closed', '2024-11-27 09:50:59', NULL),
(36, 375, 'Hien Huynh addded a sub bug', '2024-11-27 09:51:26', NULL),
(37, 407, 'Dat Tran created task', '2024-11-27 09:53:18', NULL),
(38, 375, 'Hien Huynh cloned task', '2024-11-27 09:54:10', NULL),
(39, 396, 'Vuong Bui cloned task', '2024-11-27 09:54:40', NULL),
(40, 390, 'Tuong Vo updated task', '2024-11-27 09:54:40', NULL),
(41, 396, 'Tuong Vo deleted task', '2024-11-27 09:56:47', NULL),
(42, 410, 'Diem Nguyen created task', '2024-11-27 10:01:28', NULL),
(43, 356, 'An Duong cloned task', '2024-11-27 10:02:48', NULL),
(44, 412, 'Do Ho created task', '2024-11-27 10:10:22', NULL),
(45, 413, 'Do Ho created task', '2024-11-27 10:10:57', NULL),
(46, 394, 'Nhan Tran updated working status from In Progress to Done', '2024-11-27 10:16:31', NULL),
(47, 394, 'Nhan Tran updated ticket status from In Progress to Closed', '2024-11-27 10:16:41', NULL),
(48, 393, 'Sang Le added a comment', '2024-11-27 10:30:27', NULL),
(49, 408, 'Anh Dang updated task', '2024-11-27 10:37:48', NULL),
(50, 375, 'Anh Dang updated task', '2024-11-27 10:40:36', NULL),
(51, 414, 'Hung Ngo created task', '2024-11-28 01:25:00', NULL),
(52, 414, 'Hung Ngo updated working status from In Progress to Done', '2024-11-28 01:39:42', NULL),
(53, 414, 'Hung Ngo updated ticket status from In Progress to Open', '2024-11-28 01:39:48', NULL),
(54, 415, 'Hung Ngo created task', '2024-11-28 01:43:02', NULL),
(55, 325, 'Anh Dang cloned task', '2024-11-28 01:44:21', NULL),
(56, 417, 'Anh Dang created task', '2024-11-28 01:46:58', NULL),
(57, 418, 'Hung Ngo created task', '2024-11-28 01:57:15', NULL),
(58, 419, 'Sang Le created task', '2024-11-28 02:06:43', NULL),
(59, 420, 'Sang Le created task', '2024-11-28 02:07:24', NULL),
(60, 421, 'Hung Ngo created task', '2024-11-28 02:07:33', NULL),
(61, 422, 'Sang Le created task', '2024-11-28 02:08:01', NULL),
(62, 423, 'Hung Ngo created task', '2024-11-28 02:11:32', NULL),
(63, 371, 'Nhan Nguyen cloned task', '2024-11-28 02:13:02', NULL),
(64, 423, 'Nhan Tran cloned task', '2024-11-28 02:14:07', NULL),
(65, 425, 'Nhan Tran cloned task', '2024-11-28 02:14:45', NULL),
(66, 427, 'Vuong Bui created task', '2024-11-28 02:15:00', NULL),
(67, 423, 'Hung Ngo updated working status from In Progress to Done', '2024-11-28 02:16:49', NULL),
(68, 423, 'Hung Ngo updated ticket status from In Progress to Open', '2024-11-28 02:16:59', NULL),
(69, 423, 'Hung Ngo updated ticket status from Open to Resolved', '2024-11-28 02:20:10', NULL),
(70, 425, 'Nhan Tran updated ticket status from Open to Resolved', '2024-11-28 02:20:21', NULL),
(71, 426, 'Nhan Tran updated working status from In Progress to Done', '2024-11-28 02:36:49', NULL),
(72, 426, 'Nhan Tran updated ticket status from Open to Resolved', '2024-11-28 02:36:57', NULL),
(73, 419, 'Sang Le updated working status from In Progress to Done', '2024-11-28 02:39:29', NULL),
(74, 419, 'Sang Le updated ticket status from Open to Resolved', '2024-11-28 02:39:40', NULL),
(75, 426, 'Nhan Tran updated task', '2024-11-28 02:43:27', NULL),
(76, 426, 'Nhan Tran updated task', '2024-11-28 02:54:26', NULL),
(77, 426, 'Nhan Tran cloned task', '2024-11-28 02:55:01', NULL),
(78, 429, 'Duy Phan created task', '2024-11-28 02:57:10', NULL),
(79, 372, 'Nhan Tran cloned task', '2024-11-28 03:02:27', NULL),
(80, 431, 'Hieu Dang created task', '2024-11-28 03:23:33', NULL),
(81, 432, 'Hieu Dang created task', '2024-11-28 03:24:13', NULL),
(82, 420, 'Sang Le updated task', '2024-11-28 03:29:53', NULL),
(83, 433, 'Hung Ngo created task', '2024-11-28 03:43:49', NULL),
(84, 434, 'Nhan Tran created task', '2024-11-28 04:26:34', NULL),
(85, 435, 'Hung Ngo created task', '2024-11-28 04:37:08', NULL),
(86, 420, 'Sang Le(172.18.100.202) updated working status from Done to In Progress', '2024-11-28 04:37:56', NULL),
(87, 420, 'Sang Le(172.18.100.202) updated working status from In Progress to Done', '2024-11-28 04:38:01', NULL),
(88, 435, 'Hung Ngo(172.18.100.202) updated working status from In Progress to Done', '2024-11-28 04:39:13', NULL),
(89, 435, 'Hung Ngo added a comment', '2024-11-28 04:41:49', NULL),
(90, 420, 'Sang Le updated task', '2024-11-28 06:42:31', NULL),
(91, 420, 'Sang Le(172.18.230.39) updated working status from In Progress to Done', '2024-11-28 06:43:08', NULL),
(92, 435, 'Hung Ngo(172.18.100.202) updated ticket status from In Progress to Open', '2024-11-28 06:50:18', NULL),
(93, 436, 'Diem Nguyen created task', '2024-11-28 07:05:55', NULL),
(94, 437, 'Hung Ngo created task', '2024-11-28 07:09:26', NULL),
(95, 438, 'Sang Le created task', '2024-11-28 07:13:57', NULL),
(96, 422, 'Sang Le deleted task', '2024-11-28 07:14:27', NULL),
(97, 439, 'Tuong Vo created task', '2024-11-28 07:16:48', NULL),
(98, 440, 'Duy Phan created task', '2024-11-28 07:18:10', NULL),
(99, 441, 'Hung Ngo created task', '2024-11-28 07:27:41', NULL),
(100, 442, 'Anh Dang created task', '2024-11-28 07:41:47', NULL),
(101, 443, 'Diem Nguyen created task', '2024-11-28 07:49:54', NULL),
(102, 434, 'Nhan Tran cloned task', '2024-11-28 07:55:11', NULL),
(103, 387, 'Thanh Dang cloned task', '2024-11-28 08:41:09', NULL),
(104, 441, 'Hung Ngo updated working status from In Progress to Done', '2024-11-28 08:45:06', NULL),
(105, 441, 'Hung Ngo updated ticket status from In Progress to Resolved', '2024-11-28 08:45:16', NULL),
(106, 430, 'Nhan Tran updated task', '2024-11-28 08:51:53', NULL),
(107, 416, 'My Le cloned task', '2024-11-28 08:57:28', NULL),
(108, 446, 'My Le updated task', '2024-11-28 08:58:22', NULL),
(109, 446, 'My Le updated task', '2024-11-28 08:59:21', NULL),
(110, 416, 'My Le deleted task', '2024-11-28 08:59:35', NULL),
(111, 446, 'My Le addded a sub bug', '2024-11-28 09:00:21', NULL),
(112, 446, 'My Le addded a sub bug', '2024-11-28 09:00:21', NULL),
(113, 448, 'My Le deleted task', '2024-11-28 09:00:34', NULL),
(114, 428, 'Nhan Tran cloned task', '2024-11-28 09:22:03', NULL),
(115, 450, 'Sang Le created task', '2024-11-28 09:35:34', NULL),
(116, 417, 'Hien Huynh addded a sub bug', '2024-11-28 09:36:59', NULL),
(117, 452, 'Tai Ngo created task', '2024-11-28 09:49:10', NULL),
(118, 453, 'Tuong Vo created task', '2024-11-28 09:49:21', NULL),
(119, 454, 'Tai Ngo created task', '2024-11-28 09:49:36', NULL),
(120, 455, 'Tuong Vo created task', '2024-11-28 09:49:53', NULL),
(121, 456, 'Nhan Nguyen created task', '2024-11-28 09:54:47', NULL),
(122, 457, 'Chieu Mai created task', '2024-11-28 09:54:59', NULL),
(123, 458, 'Duy Phan created task', '2024-11-28 10:03:20', NULL),
(124, 459, 'Diem Nguyen created task', '2024-11-28 10:04:29', NULL),
(125, 460, 'Diem Nguyen created task', '2024-11-28 10:05:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `team_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `desc`, `team_slug`, `created_at`, `updated_at`) VALUES
(1, 'Initial Configuration', '#DCE6F1', NULL, NULL, '2024-10-02 07:17:01'),
(2, 'App Core', '#F2DCDB', NULL, NULL, '2024-09-16 03:56:28'),
(4, 'Content Experience', '#FDE9D9', NULL, NULL, '2024-09-16 03:56:40'),
(5, 'Continuous Configuration', '#DAEEF3', NULL, NULL, '2024-09-16 03:56:45'),
(20, 'Playback Control', '#FDE9D9', 'playback-control', '2024-11-14 03:30:08', NULL),
(21, 'Pro-Infrastructure', '#EBF1DE', 'pro-infrastructure', '2024-11-14 03:30:47', NULL),
(22, 'Pinewood', '#E4DFEC', 'pinewood', '2024-11-14 03:30:58', NULL),
(23, 'Home Audio Embedded', '#DAEEF3', 'home-audio-embedded', '2024-11-14 03:31:08', NULL),
(24, 'Networking', '#EBF1DE', 'networking', '2024-11-14 03:31:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_statuses`
--

CREATE TABLE `ticket_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `ticket_status_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_statuses`
--

INSERT INTO `ticket_statuses` (`id`, `name`, `desc`, `ticket_status_slug`, `created_at`, `updated_at`) VALUES
(1, 'In Progress', '#0052CC', 'in-progress', NULL, '2024-11-18 03:24:44'),
(2, 'Closed', '#00875A', 'closed', NULL, '2024-11-18 03:25:38'),
(3, 'Resolved', '#00875A', 'resolved', NULL, '2024-11-18 03:25:43'),
(4, 'In Verification', '#0052CC', 'in-verification', NULL, '2024-11-18 03:25:49'),
(5, 'Ready To Verify', '#0052CC', 'ready-to-verify', NULL, '2024-11-18 03:25:59'),
(6, 'Block', '#DFE1E5', 'block', NULL, '2024-11-18 03:26:42'),
(7, 'ReOpened', '#FF0000', 'reopened', NULL, '2024-11-18 03:49:21'),
(9, 'Open', '#454545', 'open', '2024-11-18 02:57:34', '2024-11-20 09:27:05'),
(10, 'In Review', '#0052CC', 'in-review', '2024-11-25 09:56:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `type_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `desc`, `type_slug`, `created_at`, `updated_at`) VALUES
(1, 'Bugs Reported', 'demo', 'bugs-reported', NULL, '2024-11-18 06:41:36'),
(2, 'Testing Requests', 'demo', 'testing-requests', NULL, '2024-11-18 06:41:41'),
(3, 'Tickets Verification', 'demo', 'tickets-verification', NULL, '2024-11-18 06:41:45'),
(10, 'Passport Mobile App', '#FF0000', 'passport-mobile-app', '2024-11-18 09:16:26', '2024-11-18 09:20:08'),
(11, 'Passport Web Controller', '#585858', 'passport-web-controller', '2024-11-18 09:16:40', '2024-11-19 06:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `role` enum('admin','manager','user') NOT NULL DEFAULT 'user',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `title`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sang Le', 'sang.le@agest.vn', 'sang.le@agest.vn', NULL, '$2y$10$2Zf7SMWWXD5IXqH1sba0pe5eLA6Unkph0hFgV3Dw9i5PQ/wl.DwUa', '202411250235IMG_4067.jpeg', '0333571576', 'Đại Minh, Đại Lộc, Quảng Nam', 'TE3', 'manager', '1', NULL, NULL, '2024-11-24 19:35:59'),
(2, 'Manager', 'users', 'manager@gmail.com', NULL, '$2y$10$.Tz2jASgeTrKPy/zolb/7.JSgqIzQ90jZvUhJ8iD4e6XHuCmLylMi', '202410030338202408201504tải xuống.png', NULL, NULL, NULL, 'manager', '1', NULL, NULL, '2024-10-02 20:38:18'),
(5, 'Tai Ngo', 'tai.ngo@agest.vn', 'tai.ngo@agest.vn', NULL, '$2y$10$6tx23apbuORxsBmG6QeI5eH3U8bFpDB2TMyibp2Ov3/bvh.FDtipy', '202411200222sc.jpeg', '0905397882', 'Đà Nẵng - VCB Nickname TAINGO882', 'TE1', 'user', '1', NULL, '2024-09-16 03:41:02', '2024-11-27 00:36:45'),
(6, 'Hieu Tran', 'hieu.tran@agest.vn', 'hieu.tran@agest.vn', NULL, '$2y$10$nXSJRrDZ5qBRKCV1vNfbQ.PdIZXoqZow4TBbIEHJhIAHxcRZkbibm', '202411200346loopy_nhai.jpg', '0983123789', 'Đà Nẵng', 'TE1', 'manager', '1', NULL, '2024-09-16 03:41:30', '2024-11-19 20:46:44'),
(7, 'Hung Ngo', 'hung.ngo@agest.vn', 'hung.ngo@agest.vn', NULL, '$2y$10$XYj3Hp0tBrqWxUAlrq2sA.Q.kidjzwnZXfXdSzrWxuuHBHHBLqVGm', '202411270428empty.ico', 'vcb nick name: hung3888', 'The earth - VCB nick name: hung3888', 'TE4', 'manager', '1', NULL, '2024-10-01 04:15:33', '2024-11-26 21:29:39'),
(8, 'Sample Build App', 'sample.build@gmail.com', 'sample.build@gmail.com', NULL, '$2y$10$d0ovfZ.AhmbnBvQGKQnsROz9upV5lY.qCVUFvKI3GO3C28yemBNCe', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:54:49', NULL),
(9, 'Anh Tran', 'anh.truong.tran@agest.vn', 'anh.truong.tran@agest.vn', NULL, '$2y$10$USYS6M4BMVMONIADmLcCr.0DWfxwStVIc22.JYPfkmYM7XVevQqfe', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:55:01', NULL),
(10, 'Dat Tran', 'dat.nhat.tran@agest.vn', 'dat.nhat.tran@agest.vn', NULL, '$2y$10$ZtQUGrmuis2mLeCTzoaV3u1Z0t66WzhnOi2VDR3T1F7egEwEGziE6', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:55:13', NULL),
(11, 'Trang Nguyen', 'trang.thu.nguyen@agest.vn', 'trang.thu.nguyen@agest.vn', NULL, '$2y$10$asTk28szHXAj1uE/iOyhv.8q2mTn3c82.kxQyoid2C8omNMr0ZSku', '202411270948doraemon-3-17173722166781704981911-30-9-657-1207-crop-1717372336444425413969.webp', NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:55:35', '2024-11-27 02:48:16'),
(12, 'Trung Dang', 'trung.dang@agest.vn', 'trung.dang@agest.vn', NULL, '$2y$10$sWehvBqxeqOqvw7bvo5r5eYiyJ84jXmyLQL6rihYt/dLeoWOe9uWK', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:55:45', NULL),
(13, 'Do Ho', 'do.ho@agest.vn', 'do.ho@agest.vn', NULL, '$2y$10$QNDh57KY06cibbkVM1S1DuSkrUM90aKp6KGj1t.Q5LIfCHQQlVdie', NULL, NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:56:00', NULL),
(14, 'Diem Nguyen', 'diem.nguyen@agest.vn', 'diem.nguyen@agest.vn', NULL, '$2y$10$IA/XSXIkAvlf7.hVqS2o5O59toN/NPCiG/pXNXNELCFWG3jaA2g.a', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:56:11', NULL),
(15, 'Chieu Mai', 'chieu.mai@agest.vn', 'chieu.mai@agest.vn', NULL, '$2y$10$z8cOid6GnoY9cw/Vq6yCnuoT2D4O44lPHp24qNLe7mA0hN.uHDFsG', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:56:23', NULL),
(16, 'BUILD', 'build@gmail.com', 'build@gmail.com', NULL, '$2y$10$zqWmaE8FZw2wgW6XKB5OwubbNr1WUPQrsvg.6/1ZRYG713mGZqCQq', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:56:33', NULL),
(17, 'Hien Huynh', 'hien.huynh@agest.vn', 'hien.huynh@agest.vn', NULL, '$2y$10$/70pClnGbvUBJ9LEJCiPWeufsC/ObvwiSWmx0ZqoSUO16DoW10rHm', NULL, NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:56:44', NULL),
(18, 'My Le', 'my.chu.le@agest.vn', 'my.chu.le@agest.vn', NULL, '$2y$10$V4HXowzZcKXNLre9XDdxc.M2We06IE9EjiRjh5v/aZu.HEs0/mILC', '202411251014masha.jfif', NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:56:57', '2024-11-25 03:14:50'),
(19, 'Anh Dang', 'anh.dang@agest.vn', 'anh.dang@agest.vn', NULL, '$2y$10$mt8uKx6eTlqyFoBft9ZveuVMm.Ghq6CfilpVJvKJ3vmcW5E2DAs8O', '202411261023rein-cat1.jpg', NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:57:08', '2024-11-26 03:23:18'),
(20, 'An Duong', 'an.duong@agest.vn', 'an.duong@agest.vn', NULL, '$2y$10$vb0aUK/ur6qY98WcoxiaM.3imZsJzTPMlgSVX20Fr.r4HhMd24A/q', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:57:18', NULL),
(21, 'Canh Tran', 'canh.tran@agest.vn', 'canh.tran@agest.vn', NULL, '$2y$10$KjFfae4Fs4.2UOlamBHQGep50vyQuMkVW731qVyPhxYnCVdcehL3q', '202411260737DSCF8884 - Copy.jpeg', NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:57:29', '2024-11-26 00:37:27'),
(22, 'Nhan Nguyen', 'nhan.nguyen@agest.vn', 'nhan.nguyen@agest.vn', NULL, '$2y$10$zC.T7YuqjY/kb9YHCunv/Ol/ow2nSZOUL7UItG4myewAIKTqbmS7O', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:57:38', NULL),
(23, 'Thao Do', 'thao.do@agest.vn', 'thao.do@agest.vn', NULL, '$2y$10$8TuWH7t9CDJU1HaAsUM5meiytx4Gei0mwXbPHZLTurJsxdtC7TRJa', NULL, NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:57:53', NULL),
(24, 'Hieu Dang', 'hieu.dang@agest.vn', 'hieu.dang@agest.vn', NULL, '$2y$10$Xjey10vbqEdHNznBKcpI0e4Qeymx9RfE2TCgTCXlfzKtF5OyXBz5m', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:58:12', NULL),
(25, 'Duy Phan', 'duy.phan@agest.vn', 'duy.phan@agest.vn', NULL, '$2y$10$ubqwKNHPk/hyC6gnFUcQj.iv.JeesWi0qep5ZfgPisgP59n4BIvc.', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:58:56', NULL),
(26, 'Thanh Dang', 'thanh.dang@agest.vn', 'thanh.dang@agest.vn', NULL, '$2y$10$ckUWVCNo.4NWyIBlSLG6aO00h694KS2qP08vpZWkZIDuf9LYCZzpC', '202411250235Kaito_Kid_signature.svg', NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 01:59:14', '2024-11-24 19:35:32'),
(27, 'Nhan Tran', 'nhan.tran@agest.vn', 'nhan.tran@agest.vn', NULL, '$2y$10$Xj1vyne44bkA7NGRjnuO.uy215L/kMAvaA5ScNztwm9dCEKZEmsOm', '202411200210DSC01663.jpg', NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:59:26', '2024-11-19 19:10:35'),
(28, 'Tuong Vo', 'tuong.vo@agest.vn', 'tuong.vo@agest.vn', NULL, '$2y$10$9uNFAYHPWDfJsBUj51QsLOIGyD38k5jkJFgO6S2JqxD2uo8kguiGy', NULL, NULL, NULL, NULL, 'manager', '1', NULL, '2024-11-15 01:59:54', NULL),
(29, 'Tai Le', 'tai.le@agest.vn', 'tai.le@agest.vn', NULL, '$2y$10$1RwcJtAUi2OYlGXreIEteufVFuk05uCybsPH29i0p9XeOpco8kIW.', '202411200222SmartSelect_20241120_092051_Gallery.jpg', NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 02:00:13', '2024-11-19 19:22:03'),
(30, 'Vuong Bui', 'vuong.bui@agest.vn', 'vuong.bui@agest.vn', NULL, '$2y$10$qScKemI4mYzkiDEMst6/DebaLB3vRDfMBBRZ4E4DY/H6xmQtAJtVO', NULL, NULL, NULL, NULL, 'user', '1', NULL, '2024-11-15 02:00:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `working_statuses`
--

CREATE TABLE `working_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `working_status_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_statuses`
--

INSERT INTO `working_statuses` (`id`, `name`, `desc`, `working_status_slug`, `created_at`, `updated_at`) VALUES
(1, 'In Progress', '#0052CC', 'in-progress', NULL, '2024-11-18 03:21:47'),
(2, 'Done', '#00875A', 'done', NULL, '2024-11-18 03:23:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_configs`
--
ALTER TABLE `board_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_goals`
--
ALTER TABLE `course_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `environments`
--
ALTER TABLE `environments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_configs`
--
ALTER TABLE `report_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_histories`
--
ALTER TABLE `task_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `working_statuses`
--
ALTER TABLE `working_statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `board_configs`
--
ALTER TABLE `board_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_goals`
--
ALTER TABLE `course_goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_sections`
--
ALTER TABLE `course_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `environments`
--
ALTER TABLE `environments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `report_configs`
--
ALTER TABLE `report_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT for table `task_histories`
--
ALTER TABLE `task_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `working_statuses`
--
ALTER TABLE `working_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

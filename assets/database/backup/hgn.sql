-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2016 at 09:36 AM
-- Server version: 5.7.10
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hgn`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `taskId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dateCreated` datetime(6) DEFAULT NULL,
  `comment` text,
  `reference` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ownerId` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `title`, `description`, `ownerId`) VALUES
(1, 'One Community', 'Use for all OC related work', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `creatorId` int(11) UNSIGNED DEFAULT NULL,
  `ownerId` int(11) UNSIGNED DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `external_links`
--

CREATE TABLE `external_links` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `taskId` int(11) UNSIGNED NOT NULL,
  `creatorId` int(11) UNSIGNED DEFAULT '0',
  `linkType` varchar(100) NOT NULL,
  `dependency` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `taskId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `image` tinyint(1) DEFAULT '0',
  `dateCreated` datetime(6) DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `projectId` int(11) UNSIGNED NOT NULL,
  `notificationType` varchar(50) NOT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `communityId` int(11) UNSIGNED NOT NULL,
  `ownerId` int(11) UNSIGNED DEFAULT '0',
  `type` tinyint(2) DEFAULT NULL,
  `priority` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  `startDateEstimate` date NOT NULL,
  `startDateActual` date NOT NULL,
  `endDateEstimate` date NOT NULL,
  `endDateActual` date NOT NULL,
  `timeRequiredEstimate` decimal(8,2) DEFAULT NULL,
  `timeRequiredActual` decimal(8,2) DEFAULT NULL,
  `percentComplete` decimal(6,2) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `communityId`, `ownerId`, `type`, `priority`, `status`, `startDateEstimate`, `startDateActual`, `endDateEstimate`, `endDateActual`, `timeRequiredEstimate`, `timeRequiredActual`, `percentComplete`, `active`) VALUES
(1, 'Project1', 'Project 1', 1, 1, 1, 1, 1, '2016-04-01', '2016-04-01', '2016-04-01', '2016-04-01', '10.00', '15.00', '50.00', 1),
(2, 'Project2', 'Project 2', 1, 1, 1, 1, 1, '2016-04-01', '2016-04-01', '2016-04-01', '2016-04-01', '10.00', '15.00', '50.00', 1),
(3, 'Project3', 'Project 3', 1, 1, 1, 1, 1, '2016-04-01', '2016-04-01', '2016-04-01', '2016-04-01', '10.00', '15.00', '50.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_acl`
--

CREATE TABLE `project_acl` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `projectId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `access` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_to_files`
--

CREATE TABLE `project_to_files` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `projectId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `image` tinyint(1) DEFAULT '0',
  `size` int(11) NOT NULL DEFAULT '0',
  `dateCreated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_to_teams`
--

CREATE TABLE `project_to_teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `projectId` int(11) UNSIGNED NOT NULL,
  `teamId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_to_users`
--

CREATE TABLE `project_to_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `projectId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `role` tinyint(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_to_users`
--

INSERT INTO `project_to_users` (`id`, `title`, `description`, `projectId`, `userId`, `role`) VALUES
(1, '', '', 1, 1, 1),
(2, '', '', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_languages`
--

CREATE TABLE `system_languages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `designator` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_languages`
--

INSERT INTO `system_languages` (`id`, `title`, `description`, `designator`) VALUES
(1, 'English', 'English', 'en'),
(2, 'Abkhazian', 'Abkhazian', 'ab'),
(3, 'Afrikaans', 'Afrikaans', 'af'),
(4, 'Akan', 'Akan', 'ak'),
(5, 'Albanian', 'Albanian', 'sq'),
(6, 'Amharic', 'Amharic', 'am'),
(7, 'Arabic', 'Arabic', 'ar'),
(8, 'Aragonese', 'Aragonese', 'an'),
(9, 'Armenian', 'Armenian', 'hy'),
(10, 'Assamese', 'Assamese', 'as'),
(11, 'Avaric', 'Avaric', 'av'),
(12, 'Avestan', 'Avestan', 'ae'),
(13, 'Aymara', 'Aymara', 'ay'),
(14, 'Azerbaijani', 'Azerbaijani', 'az'),
(15, 'Bambara', 'Bambara', 'bm'),
(16, 'Bashkir', 'Bashkir', 'ba'),
(17, 'Basque', 'Basque', 'eu'),
(18, 'Belarusian', 'Belarusian', 'be'),
(19, 'Bengali', 'Bengali', 'bn'),
(20, 'Bihari', 'Bihari', 'bh'),
(21, 'Bislama', 'Bislama', 'bi'),
(22, 'Bosnian', 'Bosnian', 'bs'),
(23, 'Breton', 'Breton', 'br'),
(24, 'Bulgarian', 'Bulgarian', 'bg'),
(25, 'Burmese', 'Burmese', 'my'),
(26, 'Catalan', 'Catalan', 'ca'),
(27, 'CentralKhmer', 'CentralKhmer', 'km'),
(28, 'Chamorro', 'Chamorro', 'ch'),
(29, 'Chechen', 'Chechen', 'ce'),
(30, 'Chichewa;Nyanja', 'Chichewa;Nyanja', 'ny'),
(31, 'Chinese', 'Chinese', 'zh'),
(32, 'ChurchSlavic', 'ChurchSlavic', 'cu'),
(33, 'Chuvash', 'Chuvash', 'cv'),
(34, 'Cornish', 'Cornish', 'kw'),
(35, 'Corsican', 'Corsican', 'co'),
(36, 'Cree', 'Cree', 'cr'),
(37, 'Croatian', 'Croatian', 'hr'),
(38, 'Czech', 'Czech', 'cs'),
(39, 'Danish', 'Danish', 'da'),
(40, 'Divehi', 'Divehi', 'dv'),
(41, 'Dutch', 'Dutch', 'nl'),
(42, 'Dzongkha', 'Dzongkha', 'dz'),
(43, 'Esperanto', 'Esperanto', 'eo'),
(44, 'Estonian', 'Estonian', 'et'),
(45, 'Faroese', 'Faroese', 'fo'),
(46, 'Fijian', 'Fijian', 'fj'),
(47, 'Finnish', 'Finnish', 'fi'),
(48, 'French', 'French', 'fr'),
(49, 'Fulah', 'Fulah', 'ff'),
(50, 'Galician', 'Galician', 'gl'),
(51, 'Ganda', 'Ganda', 'lg'),
(52, 'Georgian', 'Georgian', 'ka'),
(53, 'German', 'German', 'de'),
(54, 'Greek', 'Greek', 'el'),
(55, 'Guarani', 'Guarani', 'gn'),
(56, 'Gujarati', 'Gujarati', 'gu'),
(57, 'Haitian', 'Haitian', 'ht'),
(58, 'Hausa', 'Hausa', 'ha'),
(59, 'Hebrew', 'Hebrew', 'he'),
(60, 'Herero', 'Herero', 'hz'),
(61, 'Hindi', 'Hindi', 'hi'),
(62, 'HiriMotu', 'HiriMotu', 'ho'),
(63, 'Hungarian', 'Hungarian', 'hu'),
(64, 'Icelandic', 'Icelandic', 'is'),
(65, 'Ido', 'Ido', 'io'),
(66, 'Igbo', 'Igbo', 'ig'),
(67, 'Indonesian', 'Indonesian', 'id'),
(68, 'Interlingua', 'Interlingua', 'ia'),
(69, 'Interlingue', 'Interlingue', 'ie'),
(70, 'Inuktitut', 'Inuktitut', 'iu'),
(71, 'Inupiak', 'Inupiak', 'ik'),
(72, 'Irish', 'Irish', 'ga'),
(73, 'Italian', 'Italian', 'it'),
(74, 'Japanese', 'Japanese', 'ja'),
(75, 'Javanese', 'Javanese', 'jv'),
(76, 'Kalaallisut', 'Kalaallisut', 'kl'),
(77, 'Kannada', 'Kannada', 'kn'),
(78, 'Kanuri', 'Kanuri', 'kr'),
(79, 'Kashmiri', 'Kashmiri', 'ks'),
(80, 'Kazakh', 'Kazakh', 'kk'),
(81, 'Kikuyu', 'Kikuyu', 'ki'),
(82, 'Kinyarwanda', 'Kinyarwanda', 'rw'),
(83, 'Kirghiz', 'Kirghiz', 'ky'),
(84, 'Komi', 'Komi', 'kv'),
(85, 'Kongo', 'Kongo', 'kg'),
(86, 'Korean', 'Korean', 'ko'),
(87, 'Kuanyama', 'Kuanyama', 'kj'),
(88, 'Kurdish', 'Kurdish', 'ku'),
(89, 'Lao', 'Lao', 'lo'),
(90, 'Latin', 'Latin', 'la'),
(91, 'Latvian', 'Latvian', 'lv'),
(92, 'Letzeburgesch', 'Letzeburgesch', 'lb'),
(93, 'Limburgish', 'Limburgish', 'li'),
(94, 'Lingala', 'Lingala', 'ln'),
(95, 'Lithuanian', 'Lithuanian', 'lt'),
(96, 'Luba-Katanga', 'Luba-Katanga', 'lu'),
(97, 'Macedonian', 'Macedonian', 'mk'),
(98, 'Malagasy', 'Malagasy', 'mg'),
(99, 'Malay', 'Malay', 'ms'),
(100, 'Malayalam', 'Malayalam', 'ml'),
(101, 'Maltese', 'Maltese', 'mt'),
(102, 'Manx', 'Manx', 'gv'),
(103, 'Maori', 'Maori', 'mi'),
(104, 'Marathi', 'Marathi', 'mr'),
(105, 'Marshallese', 'Marshallese', 'mh'),
(106, 'Moldavian', 'Moldavian', 'mo'),
(107, 'Mongolian', 'Mongolian', 'mn'),
(108, 'Nauru', 'Nauru', 'na'),
(109, 'Navajo;Navaho', 'Navajo;Navaho', 'nv'),
(110, 'Ndebele,North', 'Ndebele,North', 'nd'),
(111, 'Ndebele,South', 'Ndebele,South', 'nr'),
(112, 'Ndonga', 'Ndonga', 'ng'),
(113, 'Nepali', 'Nepali', 'ne'),
(114, 'NorthernSami', 'NorthernSami', 'se'),
(115, 'Norwegian', 'Norwegian', 'no'),
(116, 'NorwegianBokmål', 'NorwegianBokmål', 'nb'),
(117, 'NorwegianNynorsk', 'NorwegianNynorsk', 'nn'),
(118, 'Occitan', 'Occitan', 'oc'),
(119, 'Ojibwa', 'Ojibwa', 'oj'),
(120, 'Oriya', 'Oriya', 'or'),
(121, 'Oromo', 'Oromo', 'om'),
(122, 'Ossetian', 'Ossetian', 'os'),
(123, 'Pali', 'Pali', 'pi'),
(124, 'Panjabi', 'Panjabi', 'pa'),
(125, 'Pashto', 'Pashto', 'ps'),
(126, 'Persian', 'Persian', 'fa'),
(127, 'Polish', 'Polish', 'pl'),
(128, 'Portuguese', 'Portuguese', 'pt'),
(129, 'Quechua', 'Quechua', 'qu'),
(130, 'Romanian', 'Romanian', 'ro'),
(131, 'Romansh', 'Romansh', 'rm'),
(132, 'Rundi', 'Rundi', 'rn'),
(133, 'Russian', 'Russian', 'ru'),
(134, 'Samoan', 'Samoan', 'sm'),
(135, 'Sango', 'Sango', 'sg'),
(136, 'Sanskrit', 'Sanskrit', 'sa'),
(137, 'Sardinian', 'Sardinian', 'sc'),
(138, 'ScottishGaelic', 'ScottishGaelic', 'gd'),
(139, 'Serbian', 'Serbian', 'sr'),
(140, 'Sesotho', 'Sesotho', 'st'),
(141, 'Shona', 'Shona', 'sn'),
(142, 'SichuanYi', 'SichuanYi', 'ii'),
(143, 'Sindhi', 'Sindhi', 'sd'),
(144, 'Sinhala', 'Sinhala', 'si'),
(145, 'Slovak', 'Slovak', 'sk'),
(146, 'Slovenian', 'Slovenian', 'sl'),
(147, 'Somali', 'Somali', 'so'),
(148, 'Spanish', 'Spanish', 'es'),
(149, 'Sundanese', 'Sundanese', 'su'),
(150, 'Swahili', 'Swahili', 'sw'),
(151, 'Swati', 'Swati', 'ss'),
(152, 'Swedish', 'Swedish', 'sv'),
(153, 'Tagalog', 'Tagalog', 'tl'),
(154, 'Tahitian', 'Tahitian', 'ty'),
(155, 'Tajik', 'Tajik', 'tg'),
(156, 'Tamil', 'Tamil', 'ta'),
(157, 'Tatar', 'Tatar', 'tt'),
(158, 'Telugu', 'Telugu', 'te'),
(159, 'Thai', 'Thai', 'th'),
(160, 'Tibetan', 'Tibetan', 'bo'),
(161, 'Tigrinya', 'Tigrinya', 'ti'),
(162, 'Tonga', 'Tonga', 'to'),
(163, 'Tsonga', 'Tsonga', 'ts'),
(164, 'Tswana', 'Tswana', 'tn'),
(165, 'Turkish', 'Turkish', 'tr'),
(166, 'Turkmen', 'Turkmen', 'tk'),
(167, 'Twi', 'Twi', 'tw'),
(168, 'Uighur', 'Uighur', 'ug'),
(169, 'Ukrainian', 'Ukrainian', 'uk'),
(170, 'Urdu', 'Urdu', 'ur'),
(171, 'Uzbek', 'Uzbek', 'uz'),
(172, 'Venda', 'Venda', 've'),
(173, 'Vietnamese', 'Vietnamese', 'vi'),
(174, 'Volapük', 'Volapük', 'vo'),
(175, 'Walloon', 'Walloon', 'wa'),
(176, 'Welsh', 'Welsh', 'cy'),
(177, 'WesternFrisian', 'WesternFrisian', 'fy'),
(178, 'Wolof', 'Wolof', 'wo'),
(179, 'Xhosa', 'Xhosa', 'xh'),
(180, 'Yiddish', 'Yiddish', 'yi'),
(181, 'Yoruba', 'Yoruba', 'yo'),
(182, 'Zhuang', 'Zhuang', 'za'),
(183, 'Zulu', 'Zulu', 'zu');

-- --------------------------------------------------------

--
-- Table structure for table `system_lookups`
--

CREATE TABLE `system_lookups` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lookupType` tinyint(2) UNSIGNED NOT NULL,
  `lookupTable` varchar(64) NOT NULL,
  `valueColumn` varchar(64) NOT NULL,
  `titleColumn` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_lookups`
--

INSERT INTO `system_lookups` (`id`, `title`, `description`, `lookupType`, `lookupTable`, `valueColumn`, `titleColumn`) VALUES
(1, 'Lookup Type', 'Lookup Types Lookups', 1, '', '', ''),
(2, 'Lookup Table', 'Lookup table', 2, 'system_tables', 'id', 'title'),
(3, 'Value Column', 'Lookup value column', 2, '', '', ''),
(4, 'Title Column', 'Lookup title column', 2, '', '', ''),
(5, 'User Role', 'User Role', 1, '', '', ''),
(6, 'Project', 'Project ID and Title', 2, 'projects', 'id', 'title'),
(7, 'Tasks', 'Tasks ID and Title', 2, 'tasks', 'id', 'title'),
(8, 'User', 'User ID and Title', 2, 'users', 'id', 'title'),
(9, 'Value Type', 'Data type of values', 1, '', '', ''),
(10, 'Language', 'Language Lookup', 2, 'system_languages', 'designator', 'title'),
(11, 'Timezone', 'Timezones', 2, 'system_timezones', 'id', 'title');

-- --------------------------------------------------------

--
-- Table structure for table `system_lookup_values`
--

CREATE TABLE `system_lookup_values` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `systemLookupId` int(11) UNSIGNED NOT NULL,
  `value` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_lookup_values`
--

INSERT INTO `system_lookup_values` (`id`, `title`, `description`, `systemLookupId`, `value`) VALUES
(1, 'Lookup Table', 'Lookup values in the lookup table', 1, 1),
(2, 'System Table', 'Lookup values in system table', 1, 2),
(3, 'User ', 'User Role ', 5, 1),
(4, 'Manager ', 'Manager Role ', 5, 2),
(5, 'Integer', 'Integer Data Type', 9, 1),
(6, 'Tinyint', 'Tiny Integer Data Type', 9, 2),
(7, 'Varchar', 'Varchar Data Type', 9, 3),
(8, 'Decimal', 'Decimal Data Type', 9, 4),
(9, 'Date', 'Date Data Type', 9, 5),
(10, 'Datetime', 'DateTime Data Type', 9, 6),
(11, 'Text', 'Text Data Type', 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `system_modules`
--

CREATE TABLE `system_modules` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `model` varchar(30) NOT NULL,
  `view` varchar(30) NOT NULL,
  `masterTable` varchar(30) NOT NULL,
  `masterTableCol` varchar(30) NOT NULL,
  `detailTable` varchar(30) NOT NULL,
  `detailTableCol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_modules`
--

INSERT INTO `system_modules` (`id`, `title`, `description`, `model`, `view`, `masterTable`, `masterTableCol`, `detailTable`, `detailTableCol`) VALUES
(1, 'project', 'Project Module', 'project_model', 'project', 'projects', 'id', 'tasks', 'projectId'),
(2, 'community', 'Community Module', 'community_model', 'community', 'communities', 'id', '', ''),
(3, 'user', 'User Module', 'user_model', 'user', 'users', 'id', '', ''),
(4, 'user_preference', 'User Preference Module', 'user_model', 'user_preference', 'user_preferences', 'id', '', ''),
(5, 'system_lookup', 'System Lookup Module', 'system_model', 'system_lookup', 'system_lookups', 'id', 'system_lookup_values', 'systemLookupId'),
(6, 'system_table', 'System Table Module ', 'database_model', 'system_table', 'system_tables', 'id', 'system_table_columns', 'systemTableId'),
(7, 'system_setting', 'System Settings Module', 'system_model', 'system_setting', 'system_settings', 'id', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `valueType` tinyint(2) UNSIGNED NOT NULL,
  `value` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `title`, `description`, `valueType`, `value`) VALUES
(1, 'test1', 'test setting', 1, 'testvalue');

-- --------------------------------------------------------

--
-- Table structure for table `system_tables`
--

CREATE TABLE `system_tables` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_tables`
--

INSERT INTO `system_tables` (`id`, `title`, `description`) VALUES
(1, 'activities', 'activities'),
(2, 'categories', 'categories'),
(3, 'comments', 'comments'),
(4, 'communities', 'communities'),
(5, 'events', 'events'),
(6, 'external_links', 'external_links'),
(7, 'files', 'files'),
(8, 'system_lookups', 'lookups'),
(9, 'system_lookup_values', 'lookup_values'),
(10, 'notifications', 'notifications'),
(11, 'projects', 'projects'),
(12, 'project_acl', 'project_acl'),
(13, 'project_to_files', 'project_to_files'),
(14, 'project_to_teams', 'project_to_teams'),
(15, 'project_to_users', 'project_to_users'),
(16, 'system_settings', 'system_settings'),
(17, 'system_tables', 'system_tables'),
(18, 'system_table_columns', 'system_table_columns'),
(19, 'tasks', 'tasks'),
(20, 'task_to_users', 'task_to_users'),
(21, 'teams', 'teams'),
(22, 'team_to_users', 'team_to_users'),
(23, 'texts', 'texts'),
(24, 'timesheets', 'timesheets'),
(25, 'users', 'users'),
(26, 'user_preferences', 'user_preferences'),
(27, 'system_modules', 'System Modules');

-- --------------------------------------------------------

--
-- Table structure for table `system_table_columns`
--

CREATE TABLE `system_table_columns` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `position` tinyint(2) UNSIGNED NOT NULL,
  `systemTableId` int(11) UNSIGNED NOT NULL,
  `label` varchar(30) NOT NULL,
  `colHeader` varchar(30) NOT NULL,
  `keyType` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `displayType` tinyint(1) UNSIGNED NOT NULL,
  `displayWidth` tinyint(3) UNSIGNED NOT NULL,
  `systemLookupId` int(11) UNSIGNED NOT NULL,
  `dataType` tinyint(2) NOT NULL,
  `defaultValue` varchar(255) DEFAULT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_table_columns`
--

INSERT INTO `system_table_columns` (`id`, `title`, `description`, `position`, `systemTableId`, `label`, `colHeader`, `keyType`, `visible`, `displayType`, `displayWidth`, `systemLookupId`, `dataType`, `defaultValue`, `type`) VALUES
(1, 'id', 'id', 1, 1, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(2, 'title', 'title', 2, 1, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(31)'),
(3, 'description', 'description', 3, 1, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(4, 'id', 'id', 1, 2, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(5, 'title', 'title', 2, 2, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(6, 'description', 'description', 3, 2, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(7, 'id', 'id', 1, 3, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(8, 'title', 'title', 2, 3, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(9, 'description', 'description', 3, 3, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(10, 'taskId', 'taskId', 4, 3, 'Task ID', 'Task ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(11, 'userId', 'userId', 5, 3, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(12, 'dateCreated', 'dateCreated', 6, 3, 'Date Created', 'Date Created', 0, 1, 1, 2, 0, 6, '', 'datetime'),
(13, 'comment', 'comment', 7, 3, 'Comment', 'Comment', 0, 1, 1, 2, 0, 7, '', 'text'),
(14, 'reference', 'reference', 8, 3, 'Reference', 'Reference', 0, 1, 1, 2, 0, 3, '', 'varchar(50)'),
(15, 'id', 'id', 1, 4, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(16, 'title', 'title', 2, 4, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(17, 'description', 'description', 3, 4, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(18, 'ownerId', 'ownerId', 4, 4, 'Owner ID', 'Owner ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(19, 'id', 'id', 1, 5, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(20, 'title', 'title', 2, 5, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(21, 'description', 'description', 3, 5, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(22, 'creatorId', 'creatorId', 4, 5, 'Creator ID', 'Creator ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(23, 'ownerId', 'ownerId', 5, 5, 'Owner ID', 'Owner ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(24, 'type', 'type', 6, 5, 'Type', 'Type', 0, 1, 1, 2, 0, 2, '0', 'tinyint(2)'),
(25, 'id', 'id', 1, 6, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(26, 'title', 'title', 2, 6, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(27, 'description', 'description', 3, 6, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(28, 'taskId', 'taskId', 4, 6, 'Task ID', 'Task ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(29, 'creatorId', 'creatorId', 5, 6, 'Creator ID', 'Creator ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(30, 'linkType', 'linkType', 6, 6, 'Link Type', 'Link Type', 0, 1, 1, 2, 0, 3, '', 'varchar(100)'),
(31, 'dependency', 'dependency', 7, 6, 'Dependency', 'Dependency', 0, 1, 1, 2, 0, 3, '', 'varchar(100)'),
(32, 'url', 'url', 8, 6, 'URL', 'URL', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(33, 'id', 'id', 1, 7, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(34, 'title', 'title', 2, 7, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(35, 'description', 'description', 3, 7, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(36, 'taskId', 'taskId', 4, 7, 'Task ID', 'Task ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(37, 'userId', 'userId', 5, 7, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(38, 'path', 'path', 6, 7, 'Path', 'Path', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(39, 'image', 'image', 7, 7, 'Image', 'Image', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(40, 'dateCreated', 'dateCreated', 8, 7, 'Date Created', 'Date Created', 0, 1, 1, 2, 0, 6, '', 'datetime'),
(41, 'size', 'size', 9, 7, 'Size', 'Size', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(42, 'id', 'id', 1, 8, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(43, 'title', 'title', 2, 8, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(44, 'description', 'description', 3, 8, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(45, 'lookupType', 'lookupType', 4, 8, 'Lookup Type', 'Lookup Type', 0, 1, 1, 2, 0, 2, '0', 'tinyint(2)'),
(46, 'lookupTable', 'lookupTable', 5, 8, 'Lookup Table', 'Lookup Table', 0, 1, 1, 2, 0, 3, '', 'varchar(64)'),
(47, 'valueColumn', 'valueColumn', 6, 8, 'Value Column', 'Value Column', 0, 1, 1, 2, 0, 3, '', 'varchar(64)'),
(48, 'titleColumn', 'titleColumn', 7, 8, 'Title Column', 'Title Column', 0, 1, 1, 2, 0, 3, '', 'varchar(64)'),
(49, 'id', 'id', 1, 9, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(50, 'title', 'title', 2, 9, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(51, 'description', 'description', 3, 9, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(52, 'systemLookupId', 'lookupId', 4, 9, 'Lookup ID', 'Lookup ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(53, 'value', 'value', 5, 9, 'Value', 'Value', 0, 1, 1, 2, 0, 1, '0', 'int(4)'),
(54, 'id', 'id', 1, 10, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(55, 'title', 'title', 2, 10, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(56, 'description', 'description', 3, 10, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(57, 'projectId', 'projectId', 4, 10, 'Project ID', 'Project ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(58, 'notificationType', 'notificationType', 5, 10, 'Notification Type', 'Notification Type', 0, 1, 1, 2, 0, 3, '', 'varchar(50)'),
(59, 'message', 'message', 6, 10, 'Message', 'Message', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(60, 'id', 'id', 1, 11, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(61, 'title', 'title', 2, 11, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(62, 'description', 'description', 3, 11, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(63, 'communityId', 'communityId', 4, 11, 'Community ID', 'Community ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(64, 'ownerId', 'ownerId', 5, 11, 'Owner ID', 'Owner ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(65, 'type', 'type', 6, 11, 'Type', 'Type', 0, 1, 1, 2, 0, 2, '0', 'tinyint(2)'),
(66, 'priority', 'priority', 7, 11, 'Priority', 'Priority', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(67, 'status', 'status', 8, 11, 'Status', 'Status', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(68, 'startDateEstimate', 'startDateEstimate', 9, 11, 'Start Date Est.', 'Start Date Est.', 0, 1, 1, 2, 0, 5, '', 'date'),
(69, 'startDateActual', 'startDateActual', 10, 11, 'Start Date Act.', 'Start Date Act.', 0, 1, 1, 2, 0, 5, '', 'date'),
(70, 'endDateEstimate', 'endDateEstimate', 11, 11, 'End Date Est.', 'End Date Est.', 0, 1, 1, 2, 0, 5, '', 'date'),
(71, 'endDateActual', 'endDateActual', 12, 11, 'End Date Act.', 'End Date Act.', 0, 1, 1, 2, 0, 5, '', 'date'),
(72, 'timeRequiredEstimate', 'timeRequiredEstimate', 13, 11, 'Time Req. Est.', 'Time Req. Est.', 0, 1, 1, 2, 0, 4, '0', 'decimal(8,2)'),
(73, 'timeRequiredActual', 'timeRequiredActual', 14, 11, 'Time Req. Act.', 'Time Req. Act.', 0, 1, 1, 2, 0, 4, '0', 'decimal(8,2)'),
(74, 'percentComplete', 'percentComplete', 15, 11, 'Pct Complete', 'Pct Complete', 0, 1, 1, 2, 0, 4, '0', 'decimal(6,2)'),
(75, 'active', 'active', 16, 11, 'Active', 'Active', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(76, 'id', 'id', 1, 12, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(77, 'title', 'title', 2, 12, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(78, 'description', 'description', 3, 12, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(79, 'projectId', 'projectId', 4, 12, 'Project ID', 'Project ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(80, 'userId', 'userId', 5, 12, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(81, 'access', 'access', 6, 12, 'Access', 'Access', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(82, 'id', 'id', 1, 13, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(83, 'title', 'title', 2, 13, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(84, 'description', 'description', 3, 13, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(85, 'projectId', 'projectId', 4, 13, 'Project ID', 'Project ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(86, 'userId', 'userId', 5, 13, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(87, 'name', 'name', 6, 13, 'Name', 'Name', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(88, 'path', 'path', 7, 13, 'Path', 'Path', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(89, 'image', 'image', 8, 13, 'Image', 'Image', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(90, 'size', 'size', 9, 13, 'Size', 'Size', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(91, 'dateCreated', 'dateCreated', 10, 13, 'Date Created', 'Date Created', 0, 1, 1, 2, 0, 6, '', 'datetime'),
(92, 'id', 'id', 1, 14, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(93, 'title', 'title', 2, 14, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(94, 'description', 'description', 3, 14, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(95, 'projectId', 'projectId', 4, 14, 'Project ID', 'Project ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(96, 'teamId', 'teamId', 5, 14, 'Team ID', 'Team ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(97, 'id', 'id', 1, 15, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(98, 'title', 'title', 2, 15, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(99, 'description', 'description', 3, 15, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(100, 'projectId', 'projectId', 4, 15, 'Project ID', 'Project ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(101, 'userId', 'userId', 5, 15, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(102, 'role', 'role', 6, 15, 'Role', 'Role', 0, 1, 1, 2, 0, 2, '0', 'tinyint(2)'),
(103, 'id', 'id', 1, 16, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(104, 'title', 'title', 2, 16, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(105, 'description', 'description', 3, 16, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(106, 'valueType', 'valueType', 4, 16, 'Value Type', 'Value Type', 0, 1, 1, 2, 9, 2, '0', 'tinyint(2)'),
(107, 'value', 'value', 5, 16, 'Value', 'Value', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(108, 'id', 'id', 1, 17, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(109, 'title', 'title', 2, 17, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(110, 'description', 'description', 3, 17, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(111, 'id', 'id', 1, 18, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(112, 'title', 'title', 2, 18, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(113, 'description', 'description', 3, 18, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(114, 'systemTableId', 'systemTableId', 4, 18, 'System Table ID', 'System Table ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(115, 'position', 'position', 5, 18, 'Position', 'Position', 0, 1, 1, 2, 0, 2, '0', 'tinyint(2)'),
(116, 'label', 'label', 6, 18, 'Label', 'Label', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(117, 'keyType', 'keyType', 7, 18, 'Key Type', 'Key Type', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(118, 'visible', 'visible', 8, 18, 'Visible', 'Visible', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(119, 'systemLookupId', 'lookupId', 9, 18, 'Lookup ID', 'Lookup ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(120, 'dataType', 'dataType', 10, 18, 'Data Type', 'Data Type', 0, 1, 1, 2, 0, 2, '0', 'tinyint(2)'),
(121, 'defaultValue', 'defaultValue', 11, 18, 'Default Value', 'Default Value', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(122, 'type', 'type', 12, 18, 'Type', 'Type', 0, 1, 1, 2, 0, 3, '', 'varchar(32)'),
(123, 'id', 'id', 1, 19, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(124, 'title', 'title', 2, 19, 'Title', 'Title', 0, 1, 1, 20, 0, 3, '', 'varchar(30)'),
(125, 'description', 'description', 3, 19, 'Description', 'Description', 0, 1, 1, 30, 0, 3, '', 'varchar(255)'),
(126, 'projectId', 'projectId', 4, 19, 'Project ID', 'Project ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(127, 'creatorId', 'creatorId', 5, 19, 'Creator ID', 'Creator ID', 0, 1, 5, 2, 8, 1, '0', 'int(11)'),
(128, 'ownerId', 'ownerId', 6, 19, 'Owner ID', 'Owner ID', 0, 1, 5, 2, 8, 1, '0', 'int(11)'),
(129, 'parentId', 'parentId', 7, 19, 'Parent ID', 'Parent ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(130, 'position', 'position', 8, 19, 'Position', 'Position', 0, 1, 1, 2, 0, 2, '0', 'tinyint(3)'),
(131, 'type', 'type', 9, 19, 'Type', 'Type', 0, 1, 5, 2, 0, 2, '0', 'tinyint(2)'),
(132, 'categoryId', 'categoryId', 10, 19, 'Category ID', 'Category ID', 0, 1, 5, 2, 0, 1, '0', 'int(11)'),
(133, 'priority', 'priority', 11, 19, 'Priority', 'Priority', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(134, 'startDateEstimate', 'startDateEstimate', 12, 19, 'Start Date Est.', 'Start Date Est.', 0, 1, 6, 2, 0, 5, '', 'date'),
(135, 'startDateActual', 'startDateActual', 13, 19, 'Start Date Act.', 'Start Date Act.', 0, 1, 6, 2, 0, 5, '', 'date'),
(136, 'endDateEstimate', 'endDateEstimate', 14, 19, 'End Date Est.', 'End Date Est.', 0, 1, 6, 2, 0, 5, '', 'date'),
(137, 'endDateActual', 'endDateActual', 15, 19, 'End Date Act.', 'End Date Act.', 0, 1, 6, 2, 0, 5, '', 'date'),
(138, 'dueDate', 'dueDate', 16, 19, 'Due Date', 'Due Date', 0, 1, 6, 2, 0, 5, '', 'date'),
(139, 'status', 'status', 17, 19, 'Status', 'Status', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(140, 'active', 'active', 18, 19, 'Active', 'Active', 0, 1, 8, 2, 0, 2, '0', 'tinyint(4)'),
(141, 'timeRequiredEstimate', 'timeRequiredEstimate', 19, 19, 'Time Req. Est.', 'Time Req. Est.', 0, 1, 1, 2, 0, 4, '0', 'decimal(7,2)'),
(142, 'timeRequiredActual', 'timeRequiredActual', 20, 19, 'Time Req. Act.', 'Time Req. Act.', 0, 1, 1, 2, 0, 4, '0', 'decimal(7,2)'),
(143, 'id', 'id', 1, 20, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(144, 'taskId', 'taskId', 2, 20, 'Task ID', 'Task ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(145, 'userId', 'userId', 3, 20, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(146, 'id', 'id', 1, 21, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(147, 'title', 'title', 2, 21, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(148, 'description', 'description', 3, 21, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(149, 'id', 'id', 1, 22, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(150, 'teamId', 'teamId', 2, 22, 'Team ID', 'Team ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(151, 'userId', 'userId', 3, 22, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(152, 'id', 'id', 1, 23, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(153, 'title', 'title', 2, 23, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(154, 'description', 'description', 3, 23, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(155, 'language', 'language', 4, 23, 'Language', 'Language', 0, 1, 1, 2, 0, 2, '0', 'tinyint(3)'),
(156, 'textShort', 'textShort', 5, 23, 'Text Short', 'Text Short', 0, 1, 1, 2, 0, 3, '', 'varchar(32)'),
(157, 'textMedium', 'textMedium', 6, 23, 'Text Medium', 'Text Medium', 0, 1, 1, 2, 0, 3, '', 'varchar(64)'),
(158, 'textLong', 'textLong', 7, 23, 'Text Long', 'Text Long', 0, 1, 1, 2, 0, 3, '', 'varchar(128)'),
(159, 'id', 'id', 1, 24, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(160, 'title', 'title', 2, 24, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(161, 'description', 'description', 3, 24, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(162, 'taskId', 'taskId', 4, 24, 'Task ID', 'Task ID', 0, 1, 1, 2, 0, 1, '0', 'int(11)'),
(163, 'userId', 'userId', 5, 24, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(164, 'startDate', 'startDate', 6, 24, 'Start Date', 'Start Date', 0, 1, 1, 2, 0, 5, '', 'date'),
(165, 'hoursSpent', 'hoursSpent', 7, 24, 'Hours Spent', 'Hours Spent', 0, 1, 1, 2, 0, 4, '0', 'decimal(6,2)'),
(166, 'startDateTime', 'startDateTime', 8, 24, 'Start Date/Time', 'Start Date/Time', 0, 1, 1, 2, 0, 6, '', 'datetime'),
(167, 'endDateTime', 'endDateTime', 9, 24, 'End Date/Time', 'End Date/Time', 0, 1, 1, 2, 0, 6, '', 'datetime'),
(168, 'id', 'id', 1, 25, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(169, 'title', 'title', 2, 25, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(170, 'description', 'description', 3, 25, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(171, 'userName', 'userName', 4, 25, 'User Name', 'User Name', 0, 1, 1, 2, 0, 3, '', 'varchar(16)'),
(172, 'password', 'password', 5, 25, 'Password', 'Password', 0, 1, 1, 2, 0, 3, '', 'varchar(16)'),
(173, 'type', 'type', 6, 25, 'Type', 'Type', 0, 1, 1, 2, 0, 2, '0', 'tinyint(2)'),
(174, 'firstName', 'firstName', 7, 25, 'First Name', 'First Name', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(175, 'lastName', 'lastName', 8, 25, 'Last Name', 'Last Name', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(176, 'email', 'email', 9, 25, 'Email', 'Email', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(177, 'phoneHome', 'phoneHome', 10, 25, 'Home Phone', 'Home Phone', 0, 1, 1, 2, 0, 3, '', 'varchar(15)'),
(178, 'phoneMobile', 'phoneMobile', 11, 25, 'Mobile Phone', 'Mobile Phone', 0, 1, 1, 2, 0, 3, '', 'varchar(15)'),
(179, 'language', 'language', 12, 25, 'Language', 'Language', 0, 1, 1, 2, 10, 3, '', 'varchar(20)'),
(180, 'timezone', 'Time Zone', 13, 25, 'Time Zone', 'Time Zone', 0, 1, 1, 2, 11, 3, '', 'varchar(20)'),
(181, 'role', 'role', 14, 25, 'Role', 'Role', 0, 1, 1, 2, 5, 2, '0', 'tinyint(2)'),
(182, 'disableNotifications', 'disableNotifications', 15, 25, 'Disable Notifications', 'Disable Notifications', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(183, 'disableLogin', 'disableLogin', 16, 25, 'Disable Logins', 'Disable Logins', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(184, 'admin', 'admin', 17, 25, 'Admin', 'Admin', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(185, 'active', 'active', 18, 25, 'Active', 'Active', 0, 1, 1, 2, 0, 2, '0', 'tinyint(1)'),
(186, 'photoProfile', 'photoProfile', 19, 25, 'Profile Photo', 'Profile Photo', 0, 1, 1, 2, 0, 3, '', 'varchar(64)'),
(187, 'photoThumb', 'photoThumb', 20, 25, 'Thumb Photo', 'Thumb Photo', 0, 1, 1, 2, 0, 3, '', 'varchar(64)'),
(188, 'avatar', 'avatar', 21, 25, 'Avatar', 'Avatar', 0, 1, 1, 2, 0, 3, '', 'varchar(64)'),
(189, 'id', 'id', 1, 26, 'ID', 'ID', 0, 0, 1, 2, 0, 1, '0', 'int(11)'),
(190, 'title', 'title', 2, 26, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30)'),
(191, 'description', 'description', 3, 26, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(192, 'userId', 'userId', 4, 26, 'User ID', 'User ID', 0, 1, 1, 2, 8, 1, '0', 'int(11)'),
(193, 'valueType', 'valueType', 5, 26, 'Value Type', 'Value Type', 0, 1, 1, 2, 9, 2, '0', 'tinyint(2)'),
(194, 'value', 'value', 6, 26, 'Value', 'Value', 0, 1, 1, 2, 0, 3, '', 'varchar(255)'),
(195, 'id', 'id', 1, 27, 'ID', 'ID', 0, 1, 1, 2, 0, 1, '', 'int(11) '),
(196, 'title ', 'title ', 2, 27, 'Title', 'Title', 0, 1, 1, 2, 0, 3, '', 'varchar(30) '),
(197, 'description ', 'description ', 3, 27, 'Description', 'Description', 0, 1, 1, 2, 0, 3, '', 'varchar(255) '),
(198, 'model ', 'model ', 4, 27, 'Model', 'Model', 0, 1, 1, 2, 0, 3, '', 'varchar(30) '),
(199, 'masterTable ', 'masterTable ', 5, 27, 'Master Table', 'Master Table', 0, 1, 1, 2, 0, 3, '', 'varchar(30) '),
(200, 'masterTableCol ', 'masterTableCol ', 6, 27, 'Master Table Column', 'Master Table Column', 0, 1, 1, 2, 0, 3, '', 'varchar(30) '),
(201, 'detailTable ', 'detailTable ', 7, 27, 'Detail Table', 'Detail Table', 0, 1, 1, 2, 0, 3, '', 'varchar(30) '),
(202, 'detailTableCol ', 'detailTableCol ', 8, 27, 'Detail Table Column', 'Detail Table Column', 0, 1, 1, 2, 0, 3, '', 'varchar(30) ');

-- --------------------------------------------------------

--
-- Table structure for table `system_timezones`
--

CREATE TABLE `system_timezones` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_timezones`
--

INSERT INTO `system_timezones` (`id`, `title`, `description`) VALUES
(1, 'America/New_York', 'Eastern Time'),
(2, 'America/Chicago', 'Central Time'),
(3, 'America/Los_Angeles', 'Pacific Time');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `projectId` int(11) UNSIGNED NOT NULL,
  `creatorId` int(11) UNSIGNED DEFAULT '0',
  `ownerId` int(11) UNSIGNED DEFAULT '0',
  `parentId` int(11) UNSIGNED NOT NULL,
  `position` tinyint(3) UNSIGNED DEFAULT NULL,
  `type` tinyint(2) UNSIGNED NOT NULL,
  `categoryId` int(11) UNSIGNED DEFAULT NULL,
  `priority` tinyint(1) UNSIGNED DEFAULT '0',
  `startDateEstimate` date DEFAULT NULL,
  `startDateActual` date DEFAULT NULL,
  `endDateEstimate` date DEFAULT NULL,
  `endDateActual` date DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT '1',
  `timeRequiredEstimate` decimal(7,2) DEFAULT '0.00',
  `timeRequiredActual` decimal(7,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `projectId`, `creatorId`, `ownerId`, `parentId`, `position`, `type`, `categoryId`, `priority`, `startDateEstimate`, `startDateActual`, `endDateEstimate`, `endDateActual`, `dueDate`, `status`, `active`, `timeRequiredEstimate`, `timeRequiredActual`) VALUES
(1, 'TaskHeader2', 'TH2', 1, 1, 1, 0, 2, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(2, 'SubTask3', 'ST3', 1, 1, 1, 1, 1, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(3, 'SubTask2', 'ST2', 1, 1, 1, 5, 2, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(4, 'SubTask4', 'ST4', 1, 1, 1, 1, 2, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(5, 'TaskHeader1', 'TH1', 1, 1, 1, 0, 1, 0, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(6, 'SubTask1', 'ST1', 1, 1, 1, 5, 1, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(7, 'SubSub3', 'SS3', 1, 1, 1, 4, 2, 0, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(8, 'SubSub1', 'SS1', 1, 1, 1, 6, 1, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(9, 'SubSub2', 'SS2', 1, 1, 1, 4, 1, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00'),
(10, 'SubSub4', 'SS4', 1, 1, 1, 6, 2, 1, 1, 1, '2016-01-01', '2016-01-01', '2016-01-10', '2016-01-10', '2016-01-10', 1, 0, '10.00', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `task_to_users`
--

CREATE TABLE `task_to_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `taskId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_to_users`
--

INSERT INTO `task_to_users` (`id`, `taskId`, `userId`) VALUES
(1, 2, 1),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `team_to_users`
--

CREATE TABLE `team_to_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `teamId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `taskId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `startDate` date DEFAULT NULL,
  `hoursSpent` decimal(6,2) DEFAULT '0.00',
  `startDateTime` datetime DEFAULT NULL,
  `endDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `title`, `description`, `taskId`, `userId`, `startDate`, `hoursSpent`, `startDateTime`, `endDateTime`) VALUES
(1, '', '', 1, 1, '2016-04-01', '0.00', '2016-04-14 10:15:00', '2016-04-14 15:15:00'),
(2, '', '', 1, 1, '2016-04-02', '7.00', NULL, NULL),
(3, '', '', 1, 1, '2016-04-03', '6.00', NULL, NULL),
(4, '', '', 1, 1, '2016-04-04', '8.00', NULL, NULL),
(5, '', '', 1, 1, '2016-04-05', '0.00', '2016-04-14 10:15:00', '2016-04-14 15:15:00'),
(6, '', '', 1, 1, '2016-04-06', '9.00', NULL, NULL),
(7, '', '', 1, 1, '2016-04-07', '4.00', NULL, NULL),
(8, '', '', 1, 1, '2016-04-08', '3.00', NULL, NULL),
(9, '', '', 1, 1, '2016-04-09', '9.00', NULL, NULL),
(10, '', '', 1, 1, '2016-04-10', '1.00', NULL, NULL),
(11, '', '', 2, 1, '2016-04-11', '2.00', NULL, NULL),
(12, '', '', 2, 1, '2016-04-12', '3.00', NULL, NULL),
(13, '', '', 3, 1, '2016-04-13', '4.00', NULL, NULL),
(14, '', '', 3, 1, '2016-04-14', '5.00', NULL, NULL),
(15, '', '', 4, 1, '2016-04-15', '6.00', NULL, NULL),
(16, '', '', 4, 1, '2016-04-16', '7.00', NULL, NULL),
(17, '', '', 5, 1, '2016-04-17', '8.00', NULL, NULL),
(18, '', '', 6, 1, '2016-04-18', '9.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `userName` varchar(16) NOT NULL,
  `password` varchar(16) DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `lastName` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phoneHome` varchar(15) DEFAULT NULL,
  `phoneMobile` varchar(15) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `timezone` varchar(20) DEFAULT NULL,
  `role` tinyint(2) NOT NULL DEFAULT '0',
  `disableNotifications` tinyint(1) DEFAULT '0',
  `disableLogin` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `photoProfile` varchar(64) DEFAULT NULL,
  `photoThumb` varchar(64) DEFAULT NULL,
  `avatar` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `description`, `userName`, `password`, `type`, `firstName`, `lastName`, `email`, `phoneHome`, `phoneMobile`, `language`, `timezone`, `role`, `disableNotifications`, `disableLogin`, `admin`, `active`, `photoProfile`, `photoThumb`, `avatar`) VALUES
(1, 'Joe Admin', 'Admin user', 'admin', 'admin', 1, 'Admin', 'User', 'admin@oc.org', '415555-1212', '415555-1213', '1', '1', 2, 1, 1, 1, 1, '1_profile.jpg', '1_thumb.jpg', 'halloween-1.jpg'),
(4, 'Fred User', 'Sample User', 'user', 'user', 3, 'Fred', 'User', 'fred@none.com', '415 555-1212', '415 555-1213', '0', '0', 0, 0, 0, 0, 1, '9_profile.jpg', '9_profile.jpg', 'halloween-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE `user_preferences` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `userId` int(11) UNSIGNED DEFAULT NULL,
  `valueType` tinyint(2) UNSIGNED DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_preferences`
--

INSERT INTO `user_preferences` (`id`, `title`, `description`, `userId`, `valueType`, `value`) VALUES
(1, 'test1', 'test pref', 1, 1, 'test_value');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `comments_reference_idx` (`reference`),
  ADD KEY `comments_task_idx` (`taskId`);

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`);

--
-- Indexes for table `external_links`
--
ALTER TABLE `external_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`),
  ADD KEY `task_id` (`taskId`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`),
  ADD KEY `files_task_idx` (`taskId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_id` (`projectId`,`notificationType`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`),
  ADD KEY `fk_projects_communities1_idx` (`communityId`);

--
-- Indexes for table `project_acl`
--
ALTER TABLE `project_acl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_to_files`
--
ALTER TABLE `project_to_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`projectId`);

--
-- Indexes for table `project_to_teams`
--
ALTER TABLE `project_to_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_to_users`
--
ALTER TABLE `project_to_users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_userId` (`userId`) USING BTREE,
  ADD KEY `idx_projectId` (`projectId`) USING BTREE;

--
-- Indexes for table `system_languages`
--
ALTER TABLE `system_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_lookups`
--
ALTER TABLE `system_lookups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_lookup_values`
--
ALTER TABLE `system_lookup_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_modules`
--
ALTER TABLE `system_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_tables`
--
ALTER TABLE `system_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_table_columns`
--
ALTER TABLE `system_table_columns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_timezones`
--
ALTER TABLE `system_timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_task_active` (`active`),
  ADD KEY `fk_tasks_projects1_idx` (`projectId`);

--
-- Indexes for table `task_to_users`
--
ALTER TABLE `task_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`);

--
-- Indexes for table `team_to_users`
--
ALTER TABLE `team_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_idx` (`title`);

--
-- Indexes for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_preferences_users1_idx` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `external_links`
--
ALTER TABLE `external_links`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project_acl`
--
ALTER TABLE `project_acl`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_to_files`
--
ALTER TABLE `project_to_files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_to_teams`
--
ALTER TABLE `project_to_teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_to_users`
--
ALTER TABLE `project_to_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `system_languages`
--
ALTER TABLE `system_languages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
--
-- AUTO_INCREMENT for table `system_lookups`
--
ALTER TABLE `system_lookups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `system_lookup_values`
--
ALTER TABLE `system_lookup_values`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `system_modules`
--
ALTER TABLE `system_modules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `system_tables`
--
ALTER TABLE `system_tables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `system_table_columns`
--
ALTER TABLE `system_table_columns`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `system_timezones`
--
ALTER TABLE `system_timezones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `task_to_users`
--
ALTER TABLE `task_to_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `team_to_users`
--
ALTER TABLE `team_to_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_communities1` FOREIGN KEY (`communityId`) REFERENCES `communities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_projects1` FOREIGN KEY (`projectId`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD CONSTRAINT `fk_user_preferences_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

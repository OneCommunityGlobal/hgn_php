-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2016 at 05:38 PM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `taskId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dateCreated` bigint(20) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `url` varchar(255) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `dateModified` int(11) NOT NULL
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
  `date` bigint(20) DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `project_acl`
--

CREATE TABLE `project_acl` (
  `projectId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `access` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_to_files`
--

CREATE TABLE `project_to_files` (
  `id` int(11) UNSIGNED NOT NULL,
  `projectId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `image` tinyint(1) DEFAULT '0',
  `size` int(11) NOT NULL DEFAULT '0',
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_to_team`
--

CREATE TABLE `project_to_team` (
  `projectId` int(11) UNSIGNED NOT NULL,
  `teamId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_to_user`
--

CREATE TABLE `project_to_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `role` tinyint(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subtasks`
--

CREATE TABLE `subtasks` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `taskId` int(11) UNSIGNED NOT NULL,
  `ownerId` int(11) UNSIGNED DEFAULT NULL,
  `position` tinyint(3) UNSIGNED DEFAULT NULL,
  `status` int(11) UNSIGNED DEFAULT '0',
  `categoryId` int(11) UNSIGNED DEFAULT NULL,
  `timeRequiredEstimate` decimal(6,2) DEFAULT NULL,
  `timeRequiredActual` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_tables`
--

CREATE TABLE `system_tables` (
  `id` int(11) UNSIGNED NOT NULL,
  `tableName` varchar(30) NOT NULL,
  `columnName` varchar(30) NOT NULL,
  `position` tinyint(2) UNSIGNED NOT NULL,
  `label` varchar(30) NOT NULL,
  `keyType` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `lookupId` tinyint(4) UNSIGNED NOT NULL,
  `dataType` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `position` tinyint(3) UNSIGNED DEFAULT NULL,
  `categoryId` int(11) UNSIGNED DEFAULT NULL,
  `priority` int(11) UNSIGNED DEFAULT '0',
  `startDateEstimate` date DEFAULT NULL,
  `startDateActual` date DEFAULT NULL,
  `completeDateEstimate` date DEFAULT NULL,
  `endDateActual` date DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `active` tinyint(4) UNSIGNED DEFAULT '1',
  `timeRequiredEstimate` decimal(7,2) DEFAULT '0.00',
  `timeRequiredActual` decimal(7,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `team_to_user`
--

CREATE TABLE `team_to_user` (
  `userId` int(11) UNSIGNED NOT NULL,
  `teamId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `texts`
--

CREATE TABLE `texts` (
  `id` int(11) UNSIGNED NOT NULL,
  `language` tinyint(3) UNSIGNED DEFAULT NULL,
  `textShort` varchar(32) DEFAULT NULL,
  `textMedium` varchar(64) DEFAULT NULL,
  `textLong` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` int(11) UNSIGNED NOT NULL,
  `subtaskId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `startDate` date DEFAULT NULL,
  `hoursSpent` decimal(6,2) DEFAULT '0.00',
  `startDateTime` datetime DEFAULT NULL,
  `endDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `timeZone` varchar(20) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `disableNotifications` tinyint(1) DEFAULT '0',
  `disableLogin` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `photoProfile` varchar(64) DEFAULT NULL,
  `photoThumb` varchar(64) DEFAULT NULL,
  `avatar` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`userId`,`projectId`),
  ADD KEY `fk_project_acl_projects1_idx` (`projectId`);

--
-- Indexes for table `project_to_files`
--
ALTER TABLE `project_to_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`projectId`);

--
-- Indexes for table `project_to_team`
--
ALTER TABLE `project_to_team`
  ADD PRIMARY KEY (`projectId`,`teamId`),
  ADD UNIQUE KEY `group_id` (`teamId`,`projectId`),
  ADD KEY `project_id` (`projectId`);

--
-- Indexes for table `project_to_user`
--
ALTER TABLE `project_to_user`
  ADD PRIMARY KEY (`id`,`userId`),
  ADD UNIQUE KEY `idx_project_user` (`id`,`userId`),
  ADD KEY `user_id` (`userId`);

--
-- Indexes for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtasks_task_idx` (`taskId`);

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_task_active` (`active`),
  ADD KEY `fk_tasks_projects1_idx` (`projectId`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`);

--
-- Indexes for table `team_to_user`
--
ALTER TABLE `team_to_user`
  ADD PRIMARY KEY (`userId`,`teamId`),
  ADD UNIQUE KEY `group_id` (`userId`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `fk_team_to_user_teams1_idx` (`teamId`);

--
-- Indexes for table `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `fk_timesheets_subtasks1_idx` (`subtaskId`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_to_files`
--
ALTER TABLE `project_to_files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_tables`
--
ALTER TABLE `system_tables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_communities1` FOREIGN KEY (`communityId`) REFERENCES `communities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_acl`
--
ALTER TABLE `project_acl`
  ADD CONSTRAINT `fk_project_acl_projects1` FOREIGN KEY (`projectId`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_acl_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_to_team`
--
ALTER TABLE `project_to_team`
  ADD CONSTRAINT `fk_project_to_team_teams1` FOREIGN KEY (`teamId`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_to_teams_projects1` FOREIGN KEY (`projectId`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_to_user`
--
ALTER TABLE `project_to_user`
  ADD CONSTRAINT `fk_project_to_users_projects` FOREIGN KEY (`id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_to_users_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD CONSTRAINT `fk_subtasks_tasks1` FOREIGN KEY (`taskId`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_projects1` FOREIGN KEY (`projectId`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team_to_user`
--
ALTER TABLE `team_to_user`
  ADD CONSTRAINT `fk_team_to_user_teams1` FOREIGN KEY (`teamId`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_team_to_user_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD CONSTRAINT `fk_timesheets_subtasks1` FOREIGN KEY (`subtaskId`) REFERENCES `subtasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_timesheets_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD CONSTRAINT `fk_user_preferences_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Lug 18, 2015 alle 01:57
-- Versione del server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hoseki`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
`post_id` int(11) unsigned NOT NULL,
  `section_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` tinytext CHARACTER SET latin1 COLLATE latin1_general_cs,
  `content` text CHARACTER SET latin1 COLLATE latin1_general_cs
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `section_id`, `user_id`, `deleted`, `date`, `title`, `content`) VALUES
(1, 1, NULL, 0, '2015-07-08 19:26:43', 'Articolo di prova via database :)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut nisi eu odio lobortis lobortis in quis sem. Cras id erat urna. Vivamus vel odio pretium, eleifend ante sit amet, venenatis nibh. Phasellus sit amet risus mauris. Fusce finibus enim enim, in commodo dolor hendrerit sed. Vivamus id enim rutrum, scelerisque sem vel, vestibulum tortor. Donec ut blandit velit. Quisque tortor turpis, consequat non massa vel, cursus tincidunt diam. Nulla facilisi. Morbi volutpat metus nec suscipit lacinia. Vivamus luctus sem vitae mi condimentum fringilla. Duis eu ante dapibus, suscipit urna vel, cursus sem. Pellentesque dui elit, molestie vitae risus et, accumsan dictum leo. Sed non consectetur lorem, quis tincidunt elit. Mauris sagittis sit amet elit quis bibendum. Cras euismod nibh nibh. Nullam elementum consectetur dolor, vel imperdiet leo. Mauris id sem ullamcorper, rutrum lorem quis, varius est. Donec dignissim pulvinar tristique. Maecenas lacinia commodo lectus id luctus. Phasellus lacinia vitae sapien vel commodo. In quis ante hendrerit, scelerisque est ac, aliquet ex. Nulla facilisi. Quisque sed quam ac felis feugiat porta. Phasellus sed ultrices ligula. Pellentesque ac venenatis neque. Maecenas efficitur dignissim maximus. Donec eleifend ipsum et diam porttitor, vitae auctor enim tristique. Suspendisse lorem quam, accumsan sit amet laoreet sed, mollis sit amet odio. Fusce in nunc pretium, sodales augue gravida, porttitor justo. Aenean sollicitudin eros at lorem rutrum, non eleifend nibh congue. Quisque quis pharetra risus. Duis laoreet venenatis enim rhoncus aliquam. Proin porta, justo et sollicitudin molestie, nunc eros pulvinar felis, ut pharetra nisl mauris non nisi. Maecenas faucibus convallis sem, eget facilisis tellus. Etiam luctus felis sed metus scelerisque, vel suscipit arcu auctor. Nulla pretium venenatis ex sit amet rhoncus. Vestibulum fermentum ex sed justo consequat pretium. Vivamus sed justo tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tempor mi in mi convallis eleifend. Quisque rutrum justo in nunc sagittis suscipit. Donec dolor tellus, elementum et gravida et, congue sit amet neque. Ut sit amet nisi nec turpis viverra egestas eget egestas libero. Donec sed tempus est. Donec sodales nibh at quam porttitor, eget tempor tortor sagittis. Nulla quam ligula, posuere vel nunc vitae, consequat placerat libero. Fusce id aliquet tellus, at scelerisque lacus. Praesent risus lectus, ultricies a neque in, mattis porta risus. Nunc at mi quis sem sagittis consequat quis a lorem. Sed sagittis accumsan risus, sit amet lobortis lorem iaculis non.');

-- --------------------------------------------------------

--
-- Struttura della tabella `blog_sections`
--

CREATE TABLE IF NOT EXISTS `blog_sections` (
`section_id` int(11) unsigned NOT NULL,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `blog_sections`
--

INSERT INTO `blog_sections` (`section_id`, `name`) VALUES
(1, 'Sito Web'),
(2, 'Hoseki Team');

-- --------------------------------------------------------

--
-- Struttura della tabella `buddy_list`
--

CREATE TABLE IF NOT EXISTS `buddy_list` (
  `user1_id` int(10) unsigned NOT NULL,
  `user2_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `game_tag` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `token` char(8) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `permission_group` int(11) unsigned NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `clients`
--

INSERT INTO `clients` (`game_tag`, `token`, `name`, `description`, `permission_group`, `disabled`) VALUES
('ADMN', 'UfvZZFHN', 'Administrator', 'Administrator Clients', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `client_permissions`
--

CREATE TABLE IF NOT EXISTS `client_permissions` (
  `permission_group` int(11) unsigned NOT NULL,
  `name` varchar(48) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrator` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `full_username` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `essential_username` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `full_query` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `buddy_list` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `clients` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `gts` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `guilds` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `inbox` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `ips` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `users` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `user_data` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `rewards` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `blog` tinyint(2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `client_permissions`
--

INSERT INTO `client_permissions` (`permission_group`, `name`, `administrator`, `full_username`, `essential_username`, `full_query`, `buddy_list`, `clients`, `gts`, `guilds`, `inbox`, `ips`, `users`, `user_data`, `rewards`, `blog`) VALUES
(0, 'Administrator', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(1, 'Standard full-access Hoseki game', 0, 0, 1, 0, 0, 0, 1, 1, 1, 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `gts`
--

CREATE TABLE IF NOT EXISTS `gts` (
  `game_tag` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` int(11) unsigned NOT NULL,
  `pokemon` varchar(3000) CHARACTER SET latin1 NOT NULL,
  `species` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `wanted_species` int(11) NOT NULL,
  `wanted_min_level` int(11) NOT NULL,
  `wanted_max_level` int(11) NOT NULL,
  `wanted_gender` int(11) NOT NULL,
  `taken` int(11) NOT NULL DEFAULT '0',
  `wonder_trade` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `guilds`
--

CREATE TABLE IF NOT EXISTS `guilds` (
  `game_tag` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
`guild_id` int(11) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `game_tag` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
`pm_id` int(11) unsigned NOT NULL,
  `recipient_id` int(11) unsigned DEFAULT NULL,
  `sendername` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `senddate` datetime NOT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `unread` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ips`
--

CREATE TABLE IF NOT EXISTS `ips` (
  `user_id` int(11) unsigned DEFAULT '0',
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `mystery_gift`
--

CREATE TABLE IF NOT EXISTS `mystery_gift` (
  `game_tag` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
`id` int(10) unsigned NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime DEFAULT NULL,
  `remain_gift` int(11) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `item_id` int(11) DEFAULT NULL,
  `pokemon_data` varchar(3000) CHARACTER SET latin1 DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` tinytext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `rewards`
--

CREATE TABLE IF NOT EXISTS `rewards` (
`reward_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `description` tinytext CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `position` int(11) NOT NULL DEFAULT '-1',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) unsigned NOT NULL,
  `username` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` char(60) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'Hashed in BCrypt',
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `avatar_link` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` int(11) unsigned DEFAULT NULL,
  `usergroup` int(11) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `uniquecode` char(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `game_tag` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `lastlogin` datetime NOT NULL,
  `game_id` int(10) unsigned DEFAULT NULL,
  `guild_id` int(11) unsigned DEFAULT NULL,
  `time_played` time NOT NULL DEFAULT '00:00:00',
  `game_progress` int(11) NOT NULL DEFAULT '0',
  `pvp_won` int(11) unsigned NOT NULL DEFAULT '0',
  `pvp_lost` int(11) unsigned NOT NULL DEFAULT '0',
  `pvp_rank` int(11) unsigned NOT NULL DEFAULT '0',
  `extra_data` tinytext CHARACTER SET latin1 COLLATE latin1_general_cs
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
 ADD PRIMARY KEY (`post_id`), ADD KEY `user_id` (`user_id`), ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `blog_sections`
--
ALTER TABLE `blog_sections`
 ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `buddy_list`
--
ALTER TABLE `buddy_list`
 ADD PRIMARY KEY (`user1_id`,`user2_id`), ADD KEY `buddy_list_user_id_2` (`user2_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`game_tag`), ADD UNIQUE KEY `token` (`token`), ADD KEY `permission_group` (`permission_group`);

--
-- Indexes for table `client_permissions`
--
ALTER TABLE `client_permissions`
 ADD PRIMARY KEY (`permission_group`);

--
-- Indexes for table `gts`
--
ALTER TABLE `gts`
 ADD PRIMARY KEY (`id`), ADD KEY `game_tag` (`game_tag`);

--
-- Indexes for table `guilds`
--
ALTER TABLE `guilds`
 ADD PRIMARY KEY (`guild_id`), ADD KEY `game_tag` (`game_tag`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
 ADD PRIMARY KEY (`pm_id`), ADD KEY `recipient_id` (`recipient_id`), ADD KEY `game_tag` (`game_tag`);

--
-- Indexes for table `ips`
--
ALTER TABLE `ips`
 ADD PRIMARY KEY (`ip`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mystery_gift`
--
ALTER TABLE `mystery_gift`
 ADD PRIMARY KEY (`id`), ADD KEY `game_tag` (`game_tag`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
 ADD PRIMARY KEY (`reward_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
 ADD PRIMARY KEY (`user_id`), ADD KEY `guild_id` (`guild_id`), ADD KEY `game_tag` (`game_tag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
MODIFY `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blog_sections`
--
ALTER TABLE `blog_sections`
MODIFY `section_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `guilds`
--
ALTER TABLE `guilds`
MODIFY `guild_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
MODIFY `pm_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mystery_gift`
--
ALTER TABLE `mystery_gift`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
MODIFY `reward_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `blog_posts`
--
ALTER TABLE `blog_posts`
ADD CONSTRAINT `blog_posts_section_id` FOREIGN KEY (`section_id`) REFERENCES `blog_sections` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `blog_posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `buddy_list`
--
ALTER TABLE `buddy_list`
ADD CONSTRAINT `buddy_list_user_id_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `buddy_list_user_id_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `clients`
--
ALTER TABLE `clients`
ADD CONSTRAINT `clients_permission_group` FOREIGN KEY (`permission_group`) REFERENCES `client_permissions` (`permission_group`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `gts`
--
ALTER TABLE `gts`
ADD CONSTRAINT `gts_game_tag` FOREIGN KEY (`game_tag`) REFERENCES `clients` (`game_tag`),
ADD CONSTRAINT `gts_user_id` FOREIGN KEY (`id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `guilds`
--
ALTER TABLE `guilds`
ADD CONSTRAINT `guilds_game_tag` FOREIGN KEY (`game_tag`) REFERENCES `clients` (`game_tag`);

--
-- Limiti per la tabella `inbox`
--
ALTER TABLE `inbox`
ADD CONSTRAINT `inbox_game_tag` FOREIGN KEY (`game_tag`) REFERENCES `clients` (`game_tag`),
ADD CONSTRAINT `inbox_user_id` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `ips`
--
ALTER TABLE `ips`
ADD CONSTRAINT `ips_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `mystery_gift`
--
ALTER TABLE `mystery_gift`
ADD CONSTRAINT `mystery_gift_game_tag` FOREIGN KEY (`game_tag`) REFERENCES `clients` (`game_tag`);

--
-- Limiti per la tabella `rewards`
--
ALTER TABLE `rewards`
ADD CONSTRAINT `rewards_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_data`
--
ALTER TABLE `user_data`
ADD CONSTRAINT `user_data_game_tag` FOREIGN KEY (`game_tag`) REFERENCES `clients` (`game_tag`),
ADD CONSTRAINT `user_data_guild_id` FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`guild_id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `user_data_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

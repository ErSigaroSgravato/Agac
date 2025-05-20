-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 14, 2025 alle 22:00
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agac-database`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `achievements`
--

CREATE TABLE `achievements` (
  `achievementID` bigint(20) UNSIGNED NOT NULL,
  `platformGameID` bigint(20) UNSIGNED NOT NULL,
  `externalAchievementID` varchar(255) NOT NULL COMMENT 'Achievement ID/ApiName on the platform',
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `iconURL` varchar(2048) DEFAULT NULL,
  `globalCompletionPercent` float DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `idAdmin` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `passwordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `badges`
--

CREATE TABLE `badges` (
  `badgeID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `iconURL` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `failed_jobs`
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
-- Struttura della tabella `games`
--

CREATE TABLE `games` (
  `gameID` bigint(20) UNSIGNED NOT NULL,
  `canonicalName` varchar(255) NOT NULL,
  `developer` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `releaseYear` year(4) DEFAULT NULL,
  `coverImageURL` varchar(2048) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `jobs`
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

-- --------------------------------------------------------

--
-- Struttura della tabella `job_batches`
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
-- Struttura della tabella `linked_accounts`
--

CREATE TABLE `linked_accounts` (
  `linkedAccountID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `platformID` bigint(20) UNSIGNED NOT NULL,
  `externalUserID` varchar(255) NOT NULL COMMENT 'User ID on the external platform',
  `accessToken` blob DEFAULT NULL COMMENT 'Sensitive: Store ENCRYPTED token from application',
  `refreshToken` blob DEFAULT NULL COMMENT 'Sensitive: Store ENCRYPTED token from application',
  `tokenExpiresAt` timestamp NULL DEFAULT NULL,
  `lastSyncAt` timestamp NULL DEFAULT NULL,
  `syncStatus` enum('idle','syncing','success','error','auth_error') NOT NULL DEFAULT 'idle',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `missions`
--

CREATE TABLE `missions` (
  `missionID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `criteriaType` varchar(100) NOT NULL COMMENT 'e.g., LINKED_PLATFORMS_COUNT',
  `criteriaThreshold` float NOT NULL,
  `criteriaReferenceID` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Optional FK to another table (e.g., gameID)',
  `rewardPoints` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rewardBadgeID` bigint(20) UNSIGNED DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `isRepeatable` tinyint(1) NOT NULL DEFAULT 0,
  `repeatFrequency` enum('daily','weekly','monthly') DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `platforms`
--

CREATE TABLE `platforms` (
  `platformID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'e.g., Steam, Xbox',
  `apiEndpoint` varchar(2048) DEFAULT NULL,
  `iconClass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `platform_games`
--

CREATE TABLE `platform_games` (
  `platformGameID` bigint(20) UNSIGNED NOT NULL,
  `gameID` bigint(20) UNSIGNED NOT NULL,
  `platformID` bigint(20) UNSIGNED NOT NULL,
  `externalGameID` varchar(255) NOT NULL COMMENT 'Game ID on the specific platform',
  `nameOnPlatform` varchar(255) NOT NULL,
  `storeURL` varchar(2048) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessions`
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
-- Dump dei dati per la tabella `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6yboMqFarz5SYhHkwYIRN1LZRW1rzDXwln5Mnnpy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1djUHBGdXRpdUMzVTBUbkg2UWhNR2F2UE5ES01NclVvSVhsekVDYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC93ZWxjb21lIjt9fQ==', 1746990633),
('hO28sC0m56C7WpOewOwFA4nnLUnhYmRtkv5pjGOZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXZ3UUpyd1MzZFAyM3lwT3FNR3dyM04xRTQzcU50ekRzc21lVVcyZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9nYW1lcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747076021);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `userID` bigint(20) UNSIGNED NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordHash` varchar(255) NOT NULL COMMENT 'Store securely HASHED password (e.g., bcrypt)',
  `googleID` varchar(255) DEFAULT NULL COMMENT 'Google OAuth User ID, if linked',
  `points` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `accountLevel` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`userID`, `nickname`, `email`, `passwordHash`, `googleID`, `points`, `accountLevel`, `createdAt`, `updatedAt`, `remember_token`) VALUES
(8, 'Franco2', 'franco2@gmail.com', '$2y$12$vE.kC2B3JRl3aDgleKvIXus152R7ODxPc5sJLXyHhuLousuJbweNG', NULL, 0, 1, '2025-05-08 19:08:44', '2025-05-08 19:08:44', NULL),
(10, 'Franco', 'franco@gmail.com', '$2y$12$6QWg2T8nl5hjs72U7bKU8OpabHc1yDDuMH743eoEu83UuntALLnLS', NULL, 0, 1, '2025-05-08 19:14:32', '2025-05-08 19:14:32', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `user_achievements`
--

CREATE TABLE `user_achievements` (
  `userAchievementID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `achievementID` bigint(20) UNSIGNED NOT NULL,
  `unlockedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'When the achievement was unlocked',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_badges`
--

CREATE TABLE `user_badges` (
  `userBadgeID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `badgeID` bigint(20) UNSIGNED NOT NULL,
  `acquiredAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_game_progress`
--

CREATE TABLE `user_game_progress` (
  `progressID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `platformGameID` bigint(20) UNSIGNED NOT NULL,
  `playtimeMinutes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lastPlayedAt` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_missions`
--

CREATE TABLE `user_missions` (
  `userMissionID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `missionID` bigint(20) UNSIGNED NOT NULL,
  `currentProgress` float NOT NULL DEFAULT 0,
  `status` enum('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
  `completedAt` timestamp NULL DEFAULT NULL,
  `lastProgressUpdate` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`achievementID`),
  ADD UNIQUE KEY `uq_platform_game_external_achievement` (`platformGameID`,`externalAchievementID`),
  ADD KEY `idx_achievement_platform_game` (`platformGameID`);

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indici per le tabelle `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badgeID`);

--
-- Indici per le tabelle `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indici per le tabelle `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indici per le tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indici per le tabelle `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameID`);

--
-- Indici per le tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indici per le tabelle `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `linked_accounts`
--
ALTER TABLE `linked_accounts`
  ADD PRIMARY KEY (`linkedAccountID`),
  ADD UNIQUE KEY `uq_user_platform` (`userID`,`platformID`),
  ADD KEY `idx_linked_account_user` (`userID`),
  ADD KEY `idx_linked_account_platform` (`platformID`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`missionID`),
  ADD KEY `idx_mission_reward_badge` (`rewardBadgeID`);

--
-- Indici per le tabelle `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`platformID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `platform_games`
--
ALTER TABLE `platform_games`
  ADD PRIMARY KEY (`platformGameID`),
  ADD UNIQUE KEY `uq_platform_external_game` (`platformID`,`externalGameID`),
  ADD KEY `idx_platform_game_game` (`gameID`),
  ADD KEY `idx_platform_game_platform` (`platformID`);

--
-- Indici per le tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `googleID` (`googleID`),
  ADD KEY `idx_user_email` (`email`);

--
-- Indici per le tabelle `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD PRIMARY KEY (`userAchievementID`),
  ADD UNIQUE KEY `uq_user_achievement` (`userID`,`achievementID`),
  ADD KEY `idx_user_achievement_user` (`userID`),
  ADD KEY `idx_user_achievement_achievement` (`achievementID`);

--
-- Indici per le tabelle `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`userBadgeID`),
  ADD UNIQUE KEY `uq_user_badge` (`userID`,`badgeID`),
  ADD KEY `idx_user_badge_user` (`userID`),
  ADD KEY `idx_user_badge_badge` (`badgeID`);

--
-- Indici per le tabelle `user_game_progress`
--
ALTER TABLE `user_game_progress`
  ADD PRIMARY KEY (`progressID`),
  ADD UNIQUE KEY `uq_user_platform_game` (`userID`,`platformGameID`),
  ADD KEY `idx_user_game_progress_user` (`userID`),
  ADD KEY `idx_user_game_progress_platform_game` (`platformGameID`);

--
-- Indici per le tabelle `user_missions`
--
ALTER TABLE `user_missions`
  ADD PRIMARY KEY (`userMissionID`),
  ADD UNIQUE KEY `uq_user_mission` (`userID`,`missionID`),
  ADD KEY `idx_user_mission_user` (`userID`),
  ADD KEY `idx_user_mission_mission` (`missionID`),
  ADD KEY `idx_user_mission_status` (`status`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `achievements`
--
ALTER TABLE `achievements`
  MODIFY `achievementID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `badges`
--
ALTER TABLE `badges`
  MODIFY `badgeID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `games`
--
ALTER TABLE `games`
  MODIFY `gameID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `linked_accounts`
--
ALTER TABLE `linked_accounts`
  MODIFY `linkedAccountID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `missions`
--
ALTER TABLE `missions`
  MODIFY `missionID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `platforms`
--
ALTER TABLE `platforms`
  MODIFY `platformID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `platform_games`
--
ALTER TABLE `platform_games`
  MODIFY `platformGameID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `userID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `user_achievements`
--
ALTER TABLE `user_achievements`
  MODIFY `userAchievementID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `userBadgeID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user_game_progress`
--
ALTER TABLE `user_game_progress`
  MODIFY `progressID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user_missions`
--
ALTER TABLE `user_missions`
  MODIFY `userMissionID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `fk_achievement_platform_game` FOREIGN KEY (`platformGameID`) REFERENCES `platform_games` (`platformGameID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `linked_accounts`
--
ALTER TABLE `linked_accounts`
  ADD CONSTRAINT `fk_linked_account_platform` FOREIGN KEY (`platformID`) REFERENCES `platforms` (`platformID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_linked_account_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `fk_mission_reward_badge` FOREIGN KEY (`rewardBadgeID`) REFERENCES `badges` (`badgeID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `platform_games`
--
ALTER TABLE `platform_games`
  ADD CONSTRAINT `fk_platform_game_game` FOREIGN KEY (`gameID`) REFERENCES `games` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_platform_game_platform` FOREIGN KEY (`platformID`) REFERENCES `platforms` (`platformID`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `fk_user_achievement_achievement` FOREIGN KEY (`achievementID`) REFERENCES `achievements` (`achievementID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_achievement_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `fk_user_badge_badge` FOREIGN KEY (`badgeID`) REFERENCES `badges` (`badgeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_badge_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_game_progress`
--
ALTER TABLE `user_game_progress`
  ADD CONSTRAINT `fk_user_game_progress_platform_game` FOREIGN KEY (`platformGameID`) REFERENCES `platform_games` (`platformGameID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_game_progress_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_missions`
--
ALTER TABLE `user_missions`
  ADD CONSTRAINT `fk_user_mission_mission` FOREIGN KEY (`missionID`) REFERENCES `missions` (`missionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_mission_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

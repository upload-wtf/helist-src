SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `domains` (
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `owner` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `zoneid` varchar(255) COLLATE utf8_bin NOT NULL,
  `id` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mailboxes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pastes` (
  `id` int(32) NOT NULL,
  `title` varchar(128) NOT NULL,
  `text` varchar(4096) NOT NULL,
  `language` varchar(32) NOT NULL,
  `views` int(32) NOT NULL DEFAULT 0,
  `author` varchar(64) NOT NULL,
  `random_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `toggles` (
  `maintenance` varchar(32) NOT NULL DEFAULT 'false',
  `allow_uploads` varchar(32) NOT NULL DEFAULT 'false',
  `invites` varchar(255) NOT NULL DEFAULT 'true',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `toggles` (`maintenance`, `allow_uploads`, `invites`, `id`) VALUES
('false', 'true', 'true', 1);

CREATE TABLE `uploads` (
  `id` int(32) NOT NULL,
  `userid` int(32) NOT NULL,
  `username` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Not Availible',
  `filename` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `hash_filename` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `original_filename` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Not Defined',
  `filesize` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0.00 B',
  `delete_secret` varchar(16) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0000000000000000',
  `self_destruct_upload` varchar(32) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false',
  `embed_color` varchar(7) CHARACTER SET utf8mb4 NOT NULL DEFAULT '#fff',
  `embed_author` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT '%username',
  `embed_title` varchar(1028) CHARACTER SET utf8mb4 DEFAULT '%filename (%filesize)',
  `embed_desc` varchar(1028) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'File Host',
  `embed_url` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'https://%domain%/',
  `uploaded_at` varchar(128) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0000/00/00 00:00:00',
  `ip` varchar(255) COLLATE utf8_bin NOT NULL,
  `views` int(32) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` varchar(128) NOT NULL DEFAULT '00000000-0000-0000-0000-000000000000',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `strikes` int(11) NOT NULL DEFAULT 0,
  `admin` int(1) NOT NULL DEFAULT 0,
  `premium` int(1) NOT NULL DEFAULT 0,
  `banned` varchar(32) NOT NULL DEFAULT 'false',
  `invite` varchar(100) NOT NULL,
  `secret` varchar(128) NOT NULL,
  `embedcolor` varchar(128) NOT NULL DEFAULT '#fff',
  `embedauthor` varchar(128) DEFAULT '%username',
  `embedtitle` varchar(1028) NOT NULL DEFAULT '%filename (%filesize)',
  `embeddesc` varchar(1028) NOT NULL DEFAULT 'Uploaded at %date by %username',
  `embedurl` varchar(255) NOT NULL DEFAULT 'https://%domain%/',
  `webhook` varchar(255) DEFAULT NULL,
  `reg_date` varchar(64) NOT NULL DEFAULT '00/00/0000 00:00:00',
  `use_embed` varchar(32) NOT NULL DEFAULT 'true',
  `use_customdomain` varchar(32) NOT NULL DEFAULT 'false',
  `use_invisible_url` varchar(32) NOT NULL DEFAULT 'false',
  `use_emoji_url` varchar(32) NOT NULL DEFAULT 'false',
  `use_sus_url` varchar(32) NOT NULL DEFAULT 'false',
  `use_2fa` varchar(32) NOT NULL DEFAULT 'false',
  `self_destruct_upload` varchar(32) NOT NULL DEFAULT 'false',
  `filename_type` varchar(32) NOT NULL DEFAULT 'short',
  `url_type` varchar(32) NOT NULL DEFAULT 'short',
  `anonym_page` varchar(255) NOT NULL DEFAULT 'false',
  `webhook_logs` varchar(255) NOT NULL DEFAULT 'false',
  `use_custom_path` varchar(255) NOT NULL DEFAULT 'false',
  `use_spoofed_domain` varchar(255) NOT NULL DEFAULT 'false',
  `spoofed_domain` varchar(255) NOT NULL,
  `domain_schuffle` varchar(255) NOT NULL DEFAULT 'false',
  `schuffle_domains` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `uploads` int(32) NOT NULL DEFAULT 0,
  `upload_domain` varchar(256) NOT NULL DEFAULT '%domain%',
  `subdomain` varchar(255) DEFAULT NULL,
  `domain` varchar(255) NOT NULL DEFAULT '%domain%',
  `discord_username` varchar(128) NOT NULL DEFAULT 'user#0000',
  `discord_id` varchar(64) NOT NULL DEFAULT '000000000000000000',
  `inviter` varchar(64) NOT NULL DEFAULT 'System',
  `last_uploaded` varchar(128) NOT NULL DEFAULT 'Couldn''t find Date',
  `upload_limit` varchar(32) NOT NULL DEFAULT '500 MB',
  `upload_size_limit` varchar(32) NOT NULL DEFAULT '32 MB',
  `avatar` varchar(255) NOT NULL DEFAULT 'https://%domain%/assets/images/avatar.png',
  `discord_bio` varchar(255) NOT NULL,
  `email_bio` varchar(255) NOT NULL,
  `github_bio` varchar(255) NOT NULL,
  `telegram_bio` varchar(255) NOT NULL,
  `steam_bio` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `invites` (
  `id` int(11) NOT NULL,
  `inviteCode` varchar(255) NOT NULL,
  `inviteAuthor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `invites` (`id`, `inviteCode`, `inviteAuthor`) VALUES
(0, 'Inv-rcM2aTr4Eenj', 'System');

INSERT INTO `domains` (`name`, `dateAdded`, `owner`, `mail`, `zoneid`, `id`) VALUES
('%domain%', '2023-05-13 21:58:12', 'System', 'false', '', 1);


ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mailboxes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pastes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `toggles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`,`userid`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `domains`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `mailboxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `pastes`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;

ALTER TABLE `toggles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `uploads`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
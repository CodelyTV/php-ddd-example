CREATE TABLE `video_like` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `video_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

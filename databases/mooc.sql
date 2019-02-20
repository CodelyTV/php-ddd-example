CREATE TABLE `video` (
  `id` CHAR(36) NOT NULL,
  `type` VARCHAR(32) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `course_id` CHAR(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user` (
  `id` CHAR(36) NOT NULL,
  `name` VARCHAR(155) NOT NULL,
  `total_videos_created` INTEGER(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

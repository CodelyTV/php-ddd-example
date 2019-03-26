CREATE TABLE `videos` (
  `id` CHAR(36) NOT NULL,
  `type` VARCHAR(32) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `course_id` CHAR(36) NOT NULL,
  `added` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `videos` VALUES ('61c9c5b2-4d06-11e9-8646-d663bd873d93', 'a', 'title', 'url', '61c9c5b2-4d06-11e9-8646-d663bd873d93', 3434535);
INSERT INTO `videos` VALUES ('71c9c5b2-4d06-11e9-8646-d663bd873d93', 'a', 'second title', 'url 2', '61c9c5b2-4d06-11e9-8646-d663bd873d93', 4434535);
INSERT INTO `videos` VALUES ('81c9c5b2-4d06-11e9-8646-d663bd873d93', 'a', 'second title', 'url 3', '61c9c5b2-4d06-11e9-8646-d663bd873d93', 5434535);

CREATE TABLE `students` (
  `id` CHAR(36) NOT NULL,
  `name` VARCHAR(155) NOT NULL,
  `total_videos_created` INTEGER(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

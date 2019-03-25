CREATE TABLE `videos` (
  `id` CHAR(36) NOT NULL,
  `type` VARCHAR(32) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `course_id` CHAR(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `students` (
  `id` CHAR(36) NOT NULL,
  `name` VARCHAR(155) NOT NULL,
  `total_videos_created` INTEGER(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `steps` (
  `id` CHAR(36) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `lesson_id` CHAR(36) NOT NULL,
  `title` VARCHAR(155) NOT NULL,
  `estimated_duration` INTEGER(5) NOT NULL,
  `step_order` INTEGER(5) NOT NULL,
  `creation_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `step_challenges` (
  `id` CHAR(36) NOT NULL,
  `statement` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_steps_challenges__step_id` FOREIGN KEY (`id`) REFERENCES `steps` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `step_quiz` (
  `id` CHAR(36) NOT NULL,
  `questions` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_steps_quiz__step_id` FOREIGN KEY (`id`) REFERENCES `steps` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `step_video` (
  `id` CHAR(36) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_steps_video__step_id` FOREIGN KEY (`id`) REFERENCES `steps` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `courses` (
  `id` CHAR(36) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `duration` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `videos` (
    `id` CHAR(36) NOT NULL,
    `course_id` CHAR(36) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `courses_counter` (
  `id` CHAR(36) NOT NULL,
  `total` INT NOT NULL,
  `existing_courses` JSON NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `courses_counter` VALUES ("cdf26d7d-3deb-4e8c-9f73-4ac085a8d6f3", 0, "[]");

CREATE TABLE `domain_events` (
  `id` CHAR(36) NOT NULL,
  `aggregate_id` CHAR(36) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `body` JSON NOT NULL,
  `occurred_on` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `backoffice_courses` (
    `id` CHAR(36) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `duration` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

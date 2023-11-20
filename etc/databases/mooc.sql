/* -------------------------
        MOOC CONTEXT
---------------------------- */

-- Generic tables

CREATE TABLE `mutations` (
	`id` BIGINT AUTO_INCREMENT PRIMARY KEY,
	`table_name` VARCHAR(255) NOT NULL,
	`operation` ENUM ('INSERT', 'UPDATE', 'DELETE') NOT NULL,
	`old_value` JSON NULL,
	`new_value` JSON NULL,
	`mutation_timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `domain_events` (
	`id` CHAR(36) NOT NULL,
	`aggregate_id` CHAR(36) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`body` JSON NOT NULL,
	`occurred_on` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- Aggregates tables

CREATE TABLE `courses` (
	`id` CHAR(36) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`duration` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TRIGGER after_courses_insert
	AFTER INSERT
	ON courses
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, new_value, mutation_timestamp)
	VALUES ('courses', 'INSERT', JSON_OBJECT('id', new.id, 'name', new.name, 'duration', new.duration), NOW());
END;


CREATE TRIGGER after_courses_update
	AFTER UPDATE
	ON courses
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, old_value, new_value, mutation_timestamp)
	VALUES ('courses',
			'UPDATE',
			JSON_OBJECT('id', old.id, 'name', old.name, 'duration', old.duration),
			JSON_OBJECT('id', new.id, 'name', new.name, 'duration', new.duration),
			NOW());
END;


CREATE TRIGGER after_courses_delete
	AFTER DELETE
	ON courses
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, old_value, mutation_timestamp)
	VALUES ('courses', 'DELETE', JSON_OBJECT('id', old.id, 'name', old.name, 'duration', old.duration), NOW());
END;

CREATE TABLE `courses_counter` (
	`id` CHAR(36) NOT NULL,
	`total` INT NOT NULL,
	`existing_courses` JSON NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `courses_counter`
VALUES ("cdf26d7d-3deb-4e8c-9f73-4ac085a8d6f3", 0, "[]");


/* -------------------------
      BACKOFFICE CONTEXT
---------------------------- */

CREATE TABLE `backoffice_courses` (
	`id` CHAR(36) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`duration` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

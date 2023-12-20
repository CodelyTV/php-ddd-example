/* -------------------------
        MOOC CONTEXT
---------------------------- */

-- Generic tables

CREATE TABLE mutations (
	id bigint AUTO_INCREMENT PRIMARY KEY,
	table_name VARCHAR(255) NOT NULL,
	operation enum ('INSERT', 'UPDATE', 'DELETE') NOT NULL,
	old_value json NULL,
	new_value json NULL,
	mutation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE domain_events (
	id CHAR(36) NOT NULL,
	aggregate_id CHAR(36) NOT NULL,
	name VARCHAR(255) NOT NULL,
	body json NOT NULL,
	occurred_on TIMESTAMP NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

-- Aggregates tables

CREATE TABLE courses (
	id CHAR(36) NOT NULL,
	name VARCHAR(255) NOT NULL,
	duration VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TRIGGER after_courses_insert
	AFTER INSERT
	ON courses
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, new_value, mutation_timestamp)
	VALUES ('courses', 'INSERT', json_object('id', new.id, 'name', new.name, 'duration', new.duration), now());
END;

CREATE TRIGGER after_courses_update
	AFTER UPDATE
	ON courses
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, old_value, new_value, mutation_timestamp)
	VALUES ('courses',
			'UPDATE',
			json_object('id', old.id, 'name', old.name, 'duration', old.duration),
			json_object('id', new.id, 'name', new.name, 'duration', new.duration),
			now());
END;

CREATE TRIGGER after_courses_delete
	AFTER DELETE
	ON courses
	FOR EACH ROW
BEGIN
	INSERT INTO mutations (table_name, operation, old_value, mutation_timestamp)
	VALUES ('courses', 'DELETE', json_object('id', old.id, 'name', old.name, 'duration', old.duration), now());
END;

CREATE TABLE courses_counter (
	id CHAR(36) NOT NULL,
	total INT NOT NULL,
	existing_courses json NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO courses_counter
VALUES ("cdf26d7d-3deb-4e8c-9f73-4ac085a8d6f3", 0, "[]");

CREATE TABLE steps (
	id CHAR(36) NOT NULL,
	title VARCHAR(255) NOT NULL,
	duration INT NOT NULL,
	type VARCHAR(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE steps_video (
	id CHAR(36) NOT NULL,
	url VARCHAR(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE steps_exercise (
	id CHAR(36) NOT NULL,
	content VARCHAR(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE steps_quiz (
	id CHAR(36) NOT NULL,
	questions TEXT NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;


/* -------------------------
      BACKOFFICE CONTEXT
---------------------------- */

CREATE TABLE backoffice_courses (
	id CHAR(36) NOT NULL,
	name VARCHAR(255) NOT NULL,
	duration VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

DROP
    DATABASE IF EXISTS `open_flight`;
CREATE
    DATABASE IF NOT EXISTS `open_flight`;
USE `open_flight`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`
(
    `id`       CHAR(36) NOT NULL,
    `name`     TEXT     NOT NULL,
    `lastname` TEXT     NOT NULL,
    `password` TEXT     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
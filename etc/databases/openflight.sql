DROP
    DATABASE IF EXISTS `open_flight`;
CREATE
    DATABASE IF NOT EXISTS `open_flight`;
USE `open_flight`;

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User`
(
    `Id`       CHAR(36) NOT NULL,
    `Name`     TEXT     NOT NULL,
    `LastName` TEXT     NOT NULL,
    `Password` TEXT     NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB;
CREATE TABLE `meetup_blacklist_image` (
  `hash` char(32) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `meetup_image` (
  `meetup_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `hash` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `meetup_status` tinyint(3) unsigned NOT NULL COMMENT '0: Pending to validate; 1: Selling; 2: Discarded; 3: Sold; 4: Dummy pending to validate; 5: Sold old; 6: Deleted; 7: Pending review; 8: Pending suspicious; 9: Stored; 10: Pending duplicated;',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`meetup_id`,`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `meetup` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(3) NOT NULL,
  `country_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `currency` char(3) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0: Pending to validate; 1: Selling; 2: Discarded; 3: Sold; 4: Dummy pending to validate; 5: Sold old; 6: Deleted; 7: Pending review; 8: Pending suspicious; 9: Stored; 10: Pending duplicated;',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

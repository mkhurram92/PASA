ALTER TABLE `members` ADD `gender` INT(11) NULL DEFAULT NULL AFTER `number_street`;
ALTER TABLE `member_juniors` ADD `member_junior_id` INT(11) NULL DEFAULT NULL AFTER `member_id`;

CREATE TABLE `subscriptions` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `payment_method` enum('CARD') DEFAULT NULL,
 `start_date` datetime DEFAULT NULL,
 `end_date` datetime DEFAULT NULL,
 `user_id` bigint(20) DEFAULT NULL,
 `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
 `reason` text,
 `member_type` enum('JUNIOR','FRIEND','PARTNER','PRIMARY') DEFAULT NULL,
 `payment_intent_id` varchar(255) NOT NULL,
 `stripe_payment_id` varchar(255) DEFAULT NULL,
 `amount` varchar(255) NOT NULL,
 `status` enum('PENDING','CANCELLED','SUCCESS','PROCESSING','FAILED') NOT NULL DEFAULT 'PENDING',
 `stripe_response` text,
 `meta_description` text,
 `created_by` bigint(20) NOT NULL,
 `updated_by` bigint(20) DEFAULT NULL,
 `deleted_by` bigint(20) DEFAULT NULL,
 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
 `deleted_at` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1

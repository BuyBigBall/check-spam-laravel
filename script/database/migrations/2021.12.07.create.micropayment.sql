CREATE TABLE `micropayment` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `payed_email` VARCHAR(50) CHARSET ASCII NOT NULL, `charge_date` DATETIME NOT NULL, `pay_type` TINYINT NOT NULL, `pay_amount` FLOAT NOT NULL, `expire_date` DATE, `supply_count` TINYINT, `fee` FLOAT, `income` FLOAT, `bank` VARCHAR(40), `mode` VARCHAR(20), `type` VARCHAR(20), `deal_id` VARCHAR(100), `pay_id` VARCHAR(100), `Authrity` VARCHAR(100), `use_count` INT DEFAULT 0, `created_at` DATETIME NOT NULL DEFAULT NOW(), `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`) ) CHARSET=utf8; 
ALTER TABLE  `micropayment` ADD COLUMN `user_id` INT NOT NULL AFTER `id`, ADD COLUMN `email_id` INT NOT NULL AFTER `user_id`; 
ALTER TABLE  `micropayment` ADD COLUMN `profit_ratio` FLOAT DEFAULT 0.4 NOT NULL AFTER `email_id`; 
ALTER TABLE  `micropayment` CHANGE `user_id` `user_id` INT(11) UNSIGNED NOT NULL, CHANGE `email_id` `email_id` INT(11) UNSIGNED NOT NULL, ADD INDEX (`user_id`), ADD INDEX (`email_id`), ADD INDEX (`payed_email`), ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE, ADD FOREIGN KEY (`email_id`) REFERENCES `trash_mails`(`id`) ON DELETE CASCADE; 
ALTER TABLE  `micropayment` CHANGE `supply_count` `supply_count` TINYINT(4) DEFAULT 0 NOT NULL; 
ALTER TABLE  `micropayment` CHANGE `charge_date` `charge_date` DATETIME DEFAULT NOW() NOT NULL; 

CREATE TABLE `user_options` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `user_id` INT UNSIGNED NOT NULL, `email_id` INT UNSIGNED NOT NULL, `email_key` VARCHAR(100) CHARSET ASCII, `from_ips` VARCHAR(255) CHARSET ASCII, `test_ips` VARCHAR(255) CHARSET ASCII, `xmt_token` VARCHAR(255) CHARSET ASCII, `use_micropay` TINYINT DEFAULT 0, `pay_types` VARCHAR(50), `created_at` DATETIME DEFAULT NOW(), `updated_at` TIMESTAMP DEFAULT NOW() ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`), INDEX (`user_id`), INDEX (`email_id`) ) CHARSET=utf8; 
ALTER  TABLE `user_options` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE, ADD FOREIGN KEY (`email_id`) REFERENCES `trash_mails`(`id`) ON DELETE CASCADE; 

-- RENAME TABLE `user_option` TO `user_options`; 

CREATE TABLE `coupons` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) UNSIGNED DEFAULT NULL,
  `coupon_code` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amt` FLOAT NOT NULL,
  `expiry_date` DATE NOT NULL,
  `state` INT(1) DEFAULT 0 COMMENT '0:unused, 1:used',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  KEY `coupon_userid_forign_key` (`user_id`),
  CONSTRAINT `coupon_userid_forign_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `transactions` ADD COLUMN `coupon_amount` FLOAT NULL AFTER `amount`, ADD COLUMN `coupon_code` VARCHAR(50) CHARSET ASCII NULL AFTER `coupon_amount`; 
ALTER TABLE `transactions` ADD COLUMN `fee` FLOAT NULL AFTER `amount`; 
ALTER TABLE `test_results` ADD COLUMN `receiver` VARCHAR(100) CHARSET ASCII NULL AFTER `score`; 
CREATE TABLE `urls` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `short_code` VARCHAR(6) NOT NULL UNIQUE,
    `long_url` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
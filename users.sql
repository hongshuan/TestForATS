CREATE DATABASE testats;

USE testats;

CREATE TABLE `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(40) NOT NULL,
    `password` varchar(80) NOT NULL,
    `email` varchar(80) NOT NULL,
    `telephone` varchar(20) DEFAULT NULL,
    `created_at` int(18) unsigned DEFAULT NULL,
    `updated_at` int(18) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO users VALUES (NULL, 'testuser', '$2y$12$V1Svb4Qhx.98PzDCnRmRQugY7xSnwWeQXcPAGM6.vxbwsew5EbeFm', 'test@mail.com', '800-900-1020', NOW(), NOW());

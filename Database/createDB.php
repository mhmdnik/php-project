<?php

use Database\Database;

require_once "./Database.php";
$sqls = array(
    "CREATE TABLE `categories` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci",

    "CREATE TABLE `users` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `permission` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
        `email` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `image` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `password` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `active_token` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `is_active` INT NOT NULL DEFAULT 0,
        `forget_token` INT DEFAULT NULL,
        `expire_forget_token` DATETIME DEFAULT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE (`email`)
        ) ENGINE = InnoDB DEFAULT CHARSET= utf8 COLLATE= utf8_general_ci",

    "CREATE TABLE `articles` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `summary` TEXT NOT NULL COLLATE utf8_general_ci,
        `body` TEXT NOT NULL COLLATE utf8_general_ci,
        `image` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `cat_id` INT(11) NOT NULL,
        `user_id` INT(11) NOT NULL,
        `view` INT(11) DEFAULT 0,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (cat_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB DEFAULT CHARSET= utf8 COLLATE= utf8_general_ci",

    "CREATE TABLE `menus` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `parent_id` INT(11) DEFAULT NULL,
        `url` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (parent_id) REFERENCES menus(id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB DEFAULT CHARSET= utf8 COLLATE= utf8_general_ci",

    "CREATE TABLE `comments` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `body` TEXT NOT NULL COLLATE utf8_general_ci,
        `parent_id` INT(11) DEFAULT NULL,
        `status` ENUM('unseen', 'seen', 'approved') NOT NULL DEFAULT 'unseen',
        `article_id` INT(11) NOT NULL,
        `user_id` INT(11) NOT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB DEFAULT CHARSET= utf8 COLLATE= utf8_general_ci",

    "CREATE TABLE favouriteArticles (
        `article_id` INT(11) NOT NULL,
        `user_id` INT(11) NOT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB DEFAULT CHARSET= utf8 COLLATE= utf8_general_ci",

    "CREATE TABLE favouriteComments (
        `comment_id` INT(11) NOT NULL,
        `user_id` INT(11) NOT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB DEFAULT CHARSET= utf8 COLLATE= utf8_general_ci",
    
    "CREATE TABLE websetting (
        `id` INT NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
        `icon` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `logo` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `facebook_link` VARCHAR(255) NOT NULL COLLATE utf8_general_ci, 
        `instagram_link` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `twitter_link` VARCHAR(255) NOT NULL COLLATE utf8_general_ci, 
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE = InnoDB DEFAULT CHARSET= utf8 COLLATE = utf8_general_ci",
        
    "CREATE TABLE contactUs (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `body` TEXT NOT NULL COLLATE utf8_general_ci,
        `status` ENUM('unseen','seen') NOT NULL DEFAULT 'unseen',
        `email` VARCHAR(255) NOT NULL COLLATE utf8_general_ci,
        `created_at` DATETIME NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci"
    
    );

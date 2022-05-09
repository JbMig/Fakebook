CREATE DATABASE IF NOT EXISTS `db_fakebook_ajltvv` 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use db_fakebook_ajltvv;

CREATE TABLE IF NOT EXISTS `users` (
        `user_id` INT NOT NULL AUTO_INCREMENT,
        `mail` VARCHAR(255) NOT NULL,
        `mdp` VARCHAR(256) NOT NULL,
        `first_name` VARCHAR(255),
        `last_name` VARCHAR(255),
        `profil_picture` VARCHAR(255) DEFAULT "default_profile_pic.png",
        `banner` VARCHAR(255) DEFAULT "default_banner.jpg",
		`status` ENUM('active', 'inactive') DEFAULT 'active',
        PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `pages` (
        `page_id` INT NOT NULL AUTO_INCREMENT,
        `picture` VARCHAR(255) DEFAULT "default_page_pic.jpeg",
        `banner` VARCHAR(255) DEFAULT "default_banner.jpg",
		`creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`page_id`),
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `groups` (
        `group_id` INT NOT NULL AUTO_INCREMENT,
        `picture` VARCHAR(255) DEFAULT "default_page_pic.jpeg",
        `banner` VARCHAR(255) DEFAULT "default_banner.jpg",
		`creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
		`status` ENUM('public', 'private') DEFAULT 'public',
        PRIMARY KEY (`group_id`),
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `articles` (
        `article_id` INT NOT NULL AUTO_INCREMENT,
        `data` TEXT,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `image` VARCHAR(255),
        `like` BIGINT(20),
        `user_id` INT NOT NULL,
        `group_id` INT,
        `page_id` INT,
        PRIMARY KEY (`article_id`),
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `comments` (
        `comment_id` INT NOT NULL AUTO_INCREMENT,
		`content` TEXT NOT NULL,
        `article_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`like_id`),
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `likes` (
        `like_id` INT NOT NULL AUTO_INCREMENT,
        `article_id` INT NOT NULL,
        `comment_id` INT,
        `user_id` INT NOT NULL,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP, -- nécesaire pour dater les notifications
        PRIMARY KEY (`like_id`),
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `admins` (
        `admin_id` INT NOT NULL AUTO_INCREMENT,
        `group_id` INT,
        `page_id` INT,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`admin_id`),
        ENGINE=InnoDB;
    )

CREATE TABLE IF NOT EXISTS `members` (
        `member_id` INT NOT NULL AUTO_INCREMENT,
        `group_id` INT,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`member_id`),
        ENGINE=InnoDB;
    )

CREATE TABLE IF NOT EXISTS `followers` (
        `follower_id` INT NOT NULL AUTO_INCREMENT,
        `page_id` INT,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`follower_id`),
        ENGINE=InnoDB;
    )



ALTER TABLE  `articles`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`page_id`) REFERENCES `pages`(`page_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`group_id`) REFERENCES `groups`(`group_id`) ON DELETE CASCADE;

ALTER TABLE  `comments`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`article_id`) REFERENCES `articles`(`article_id`) ON DELETE CASCADE;

ALTER TABLE  `likes`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`article_id`) REFERENCES `articles`(`article_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`comment_id`) REFERENCES `comments`(`comment_id`) ON DELETE CASCADE;

ALTER TABLE  `admins`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`page_id`) REFERENCES `pages`(`page_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`group_id`) REFERENCES `groups`(`group_id`) ON DELETE CASCADE;

ALTER TABLE  `members`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`group_id`) REFERENCES `groups`(`group_id`) ON DELETE CASCADE;

ALTER TABLE  `followers`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`page_id`) REFERENCES `pages`(`page_id`) ON DELETE CASCADE;

git switch database
git add database.sql
git commit -m 'refactor - début de la bdd - pas encore testé'
git push -u origin database
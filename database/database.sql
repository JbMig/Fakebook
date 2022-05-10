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
        PRIMARY KEY (`page_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `groups` (
        `group_id` INT NOT NULL AUTO_INCREMENT,
        `picture` VARCHAR(255) DEFAULT "default_page_pic.jpeg",
        `banner` VARCHAR(255) DEFAULT "default_banner.jpg",
		`creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
		`status` ENUM('public', 'private') DEFAULT 'public',
        PRIMARY KEY (`group_id`)
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
        PRIMARY KEY (`article_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `comments` (
        `comment_id` INT NOT NULL AUTO_INCREMENT,
		`content` TEXT NOT NULL,
        `image` VARCHAR(255),
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `article_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`comment_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `likes` (
        `like_id` INT NOT NULL AUTO_INCREMENT,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP, -- needed to date the notifications
        `article_id` INT NOT NULL,
        `comment_id` INT,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`like_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `admins` (
        `admin_id` INT NOT NULL AUTO_INCREMENT,
        `group_id` INT,
        `page_id` INT,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`admin_id`) 
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `members` (
        `member_id` INT NOT NULL AUTO_INCREMENT,
        `group_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`member_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `followers` (
        `follower_id` INT NOT NULL AUTO_INCREMENT,
        `page_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`follower_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `relationships` (
        `relation_id` INT NOT NULL AUTO_INCREMENT,
        `user_id_a` INT NOT NULL,
        `user_id_b` INT NOT NULL,
        PRIMARY KEY (`relation_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `chats` (
        `chat_id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(20) DEFAULT 'Nouvelle discussion',
        `chat_pic` VARCHAR(255) DEFAULT "default_page_pic.jpeg",
        PRIMARY KEY (`chat_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `messages` (
        `message_id` INT NOT NULL AUTO_INCREMENT,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `image` VARCHAR(255),
        `chat_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`message_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `chat_members` (
        `chat_member_id` INT NOT NULL AUTO_INCREMENT,
        `chat_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`chat_member_id`)
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `notifications` (
        `notif_id` INT NOT NULL AUTO_INCREMENT,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `type` ENUM('article','like','comment','relationship_agree','relationship_disagree','join_group_agree','join_group_disagree') NOT NULL,
        `seen` ENUM('yes','no') NOT NULL,
        `user_id` INT,
        `group_id` INT,
        `page_id` INT,
        `like_id` INT,
        `comment_id` INT,
        `article_id` INT,
        PRIMARY KEY (`notif_id`)
    ) ENGINE=InnoDB;


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

ALTER TABLE  `relationships`
	ADD CONSTRAINT FOREIGN KEY (`user_id_a`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`user_id_b`) REFERENCES `users`(`user_id`) ON DELETE CASCADE;

ALTER TABLE  `messages`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`chat_id`) REFERENCES `chats`(`chat_id`) ON DELETE CASCADE;

ALTER TABLE  `chat_members`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`chat_id`) REFERENCES `chats`(`chat_id`) ON DELETE CASCADE;

ALTER TABLE  `notifications`
	ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`article_id`) REFERENCES `articles`(`article_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`like_id`) REFERENCES `likes`(`like_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`comment_id`) REFERENCES `comments`(`comment_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`page_id`) REFERENCES `pages`(`page_id`) ON DELETE CASCADE,
	ADD CONSTRAINT FOREIGN KEY (`group_id`) REFERENCES `groups`(`group_id`) ON DELETE CASCADE;



-- pour push sur la branche database
-- si pas fait : .\Fakebook\
git switch database
git add database.sql -- ou juste "git add database" si on veut push tout le dossier
git commit -m 'texte'
git push -u origin database
-- pour mettre sur le main
git switch main
git merge database
git push -u origin main
-- et on n'oublie pas de faire "git pull" régulièrement
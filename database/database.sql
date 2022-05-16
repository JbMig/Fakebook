CREATE DATABASE IF NOT EXISTS `db_fakebook_ajltvv` 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use db_fakebook_ajltvv;

CREATE TABLE IF NOT EXISTS `users` (
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(256) NOT NULL,
	`first_name` VARCHAR(255),
	`last_name` VARCHAR(255),
	`profil_picture` VARCHAR(255) DEFAULT "default_profile_pic.png",
	`banner` VARCHAR(255) DEFAULT "default_banner.jpg",
	`status` ENUM('active', 'inactive') DEFAULT 'active',
	`theme` TINYINT DEFAULT 0,
	PRIMARY KEY (`user_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `pages` (
	`page_id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`picture` VARCHAR(255) DEFAULT "default_page_pic.jpeg",
	`banner` VARCHAR(255) DEFAULT "default_banner.jpg",
	`description` TEXT,
	`creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`page_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `groups` (
	`group_id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`picture` VARCHAR(255) DEFAULT "default_page_pic.jpeg",
	`banner` VARCHAR(255) DEFAULT "default_banner.jpg",
	`description` TEXT,
	`creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`status` ENUM('public', 'private') DEFAULT 'public',
	PRIMARY KEY (`group_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `articles` (
	`article_id` INT NOT NULL AUTO_INCREMENT,
	`content` TEXT,
	`date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`picture` VARCHAR(255),
	`like_count` INT DEFAULT 0,
	`user_id` INT NOT NULL,
	`group_id` INT,
	`page_id` INT,
	PRIMARY KEY (`article_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `comments` (
	`comment_id` INT NOT NULL AUTO_INCREMENT,
	`content` TEXT NOT NULL,
	`picture` VARCHAR(255),
	`date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`like_count` INT DEFAULT 0,
	`article_id` INT NOT NULL,
	`user_id` INT NOT NULL,
	PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `likes` (
	`like_id` INT NOT NULL AUTO_INCREMENT,
	`date` DATETIME DEFAULT CURRENT_TIMESTAMP, -- needed to date the notifications
	`article_id` INT,
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
	`status` ENUM('pending','approved') DEFAULT 'pending',
	`blocked` ENUM('yes', 'no') DEFAULT 'no',
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
	`picture` VARCHAR(255),
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
	`type` ENUM('article','like','comment','relationship_request','relationship_agree','relationship_disagree','join_group_request','join_group_agree','join_group_disagree') NOT NULL,
	`seen` ENUM('yes','no') NOT NULL,
	`user_id` INT,
	`group_id` INT,
	`page_id` INT,
	`like_id` INT,
	`comment_id` INT,
	`article_id` INT,
	PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `stats` (
	`stat_id` INT NOT NULL AUTO_INCREMENT,
	`nb_articles` INT DEFAULT 0,
	`nb_comments` INT DEFAULT 0,
	`nb_likes` INT DEFAULT 0,
	`likes_on_articles` INT DEFAULT 0,
	`likes_on_comments` INT DEFAULT 0,
	`comments_on_articles` INT DEFAULT 0,
	`nb_friends` INT DEFAULT 0,
	`user_id` INT NOT NULL,
	PRIMARY KEY (`stat_id`)
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

ALTER TABLE `stats`
ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE;
 









-- Fake users and articles, so that the social network isn't completely empty at first (may be useless. we'll see.)
INSERT INTO `users` (`email`, `password`, `first_name`, `last_name`)
VALUES
	("toto@gmail.com", "toto", "Thomas", "Tortue"),
	("lulu@gmail.com", "lulu", "Lucie", "Lumière"),
	("momo@gmail.com", "momo", "Maurice", "Moto"),
	("lala@gmail.com", "lala", "Laurence", "Labrador");

INSERT INTO `articles` (`content`, `user_id`, `date`)
VALUES
	("Dites... Il y a des devoirs en anglais ?", 1, '2022-04-08 16:50:52'),
	("Ok, question sérieuse. Qui aime le latin ?", 2, '2022-04-15 14:25:34'),
	("Qui veut faire un laser game samedi prochain ?!", 3, '2022-04-25 18:40:02'),
	("J'ai perdu mon livre de maths. Qqun l'a trouvé ?", 4, '2022-05-09 08:22:48');

INSERT INTO `comments` (`content`, `article_id`, `user_id`, `date`)
VALUES
	("Honnêtement, mec, j'en sais rien XD", 1, 3, '2022-04-08 16:53:28'),
	("Lire le texte et répondre aux questions page 132. Suivez, les gars...", 1, 4, '2022-04-08 17:10:03'),
	("Moi !!! Où et à quelle heure ?", 3, 2, '2022-04-25 19:16:18');


UPDATE `users`
SET `status` = 'inactive'
WHERE `first_name` = 'Laurence';


INSERT INTO `relationships` (`user_id_a`,`user_id_b`,`status`)
VALUES
(1,3,'approved'),
(1,4,'approved'),
(3,2,'approved');


INSERT INTO `stats` (`user_id`,`nb_articles`,`nb_friends`,`nb_comments`,`comments_on_articles`)
VALUES
(1,1,2,0,2),
(2,1,1,1,0),
(3,1,2,1,1),
(4,1,1,1,0);






-- for myself (Valentine). will be deleted before we send it
INSERT INTO `relationships` (`user_id_a`,`user_id_b`,`status`)
VALUES
(1,2,'approved');

ALTER TABLE pages
ADD `description` TEXT AFTER `banner`;
ALTER TABLE groups
ADD `description` TEXT AFTER `banner`;
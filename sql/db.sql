CREATE TABLE `users` (
  `user_id` int PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_password` varchar(255) NOT NULL,
  `recovery_email` varchar(255),
  `phone` int
);

CREATE TABLE `login_history` (
  `lh_id` int PRIMARY KEY AUTO_INCREMENT,
  `timestamp` datetime,
  `user_id` int
);

CREATE TABLE `url` (
  `url_id` int PRIMARY KEY AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255),
  `user_id` int,
  `password_hint` varchar(255)
);

CREATE TABLE `password_history` (
  `ph_id` int PRIMARY KEY AUTO_INCREMENT,
  `url_id` int,
  `user_id` int,
  `timestamp` datetime,
  `action` ENUM ('insert', 'update', 'delete'),
  `old_password` varchar(255),
  `new_password` varchar(255),
  `old_password_hint` varchar(255),
  `new_password_hint` varchar(255)
);

CREATE TABLE `shared_passwords` (
  `sp_id` int PRIMARY KEY AUTO_INCREMENT,
  `url_id` int,
  `owner_id` int,
  `recipient_id` int
);

CREATE TABLE `shared_password_history` (
  `sph_id` int PRIMARY KEY AUTO_INCREMENT,
  `sp_id` int,
  `action` ENUM ('insert', 'update', 'delete'),
  `old_recipient_id` int,
  `new_recipient_id` int
);

CREATE TABLE `security_questions` (
  `sq_id` int PRIMARY KEY AUTO_INCREMENT,
  `question` varchar(255) NOT NULL
);

CREATE TABLE `security_answers` (
  `sa_id` int PRIMARY KEY AUTO_INCREMENT,
  `sq_id` int,
  `answer` varchar(255) NOT NULL,
  `user_id` int
);

CREATE TABLE `faq` (
  `faq_id` int PRIMARY KEY AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
);

CREATE TABLE `subscribers` (
  `subscriber_id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `frequency` ENUM ('weekly', 'monthly', 'special')
);

CREATE TABLE `contact_messages` (
  `cm_id` int PRIMARY KEY AUTO_INCREMENT,
  `timestamp` datetime,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255),
  `email` varchar(255) NOT NULL,
  `message` varchar(3000) NOT NULL
);

ALTER TABLE `login_history` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `url` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `password_history` ADD FOREIGN KEY (`url_id`) REFERENCES `url` (`url_id`);

ALTER TABLE `password_history` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `shared_passwords` ADD FOREIGN KEY (`url_id`) REFERENCES `url` (`url_id`);

ALTER TABLE `shared_passwords` ADD FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `shared_passwords` ADD FOREIGN KEY (`recipient_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `shared_password_history` ADD FOREIGN KEY (`sp_id`) REFERENCES `shared_passwords` (`sp_id`);

ALTER TABLE `shared_password_history` ADD FOREIGN KEY (`old_recipient_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `shared_password_history` ADD FOREIGN KEY (`new_recipient_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `security_answers` ADD FOREIGN KEY (`sq_id`) REFERENCES `security_questions` (`sq_id`);

ALTER TABLE `security_answers` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `subscribers` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

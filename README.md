Simple-register-login-and-comment
=================================

I did this for a bit of practice, It's a simple registration, login and comment system.

mySQL:

Comments:

CREATE TABLE IF NOT EXISTS `comments` (
`comment_id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(255) NOT NULL,
`comment_text` varchar(255) NOT NULL,
PRIMARY KEY (`comment_id`)
)


Users:

CREATE TABLE IF NOT EXISTS `registration` (
`username` varchar(255) NOT NULL,
`password` varchar(255) NOT NULL,
`id` int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (`id`),
UNIQUE KEY `username` (`username`),
)

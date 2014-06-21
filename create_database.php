<?php
	//Connect to database
	$dbconnection = mysqli_connect("##HOST##", "##USERNAME##", "##PASSWORD##", "##DATABASE_NAME##");
	if(!$dbconnection)
	{
		die("Connection to database failed.");
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS `registration` (
	`username` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`id` int(11) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`),
	)
	CREATE TABLE IF NOT EXISTS `comments` (
	`comment_id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(255) NOT NULL,
	`comment_text` varchar(255) NOT NULL,
	PRIMARY KEY (`comment_id`)
	)"
	
	//Query the Database
	$dbresult = mysqli_query($dbconnection, $sql);
	if(!$dbresult)
	{
		die("Something went wrong! " . mysqli_error($dbresult));
	}
	else
		echo "Tables created! You can now delete this file and use the other files to register users (direct users to \"register.html\" to be registered), let users log in (using \"login.html\") and take comments (with \"comments.php\")";
?>
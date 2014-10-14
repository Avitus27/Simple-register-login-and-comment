<?php
	/*Simple-register-login-and-comment/login.php
     *Copyright (C) 2014  Mervyn Galvin - mervyn511@gmail.com - @Avitus27
     *
     *This program is free software; you can redistribute it and/or modify
     *it under the terms of the GNU General Public License as published by
     *the Free Software Foundation; either version 2 of the License, or
     *(at your option) any later version.
     *
     *This program is distributed in the hope that it will be useful,
     *but WITHOUT ANY WARRANTY; without even the implied warranty of
     *MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *GNU General Public License for more details.
     *
     *You should have received a copy of the GNU General Public License along
     *with this program; if not, write to the Free Software Foundation, Inc.,
     *51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
	**/
	
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
	UNIQUE KEY `username` (`username`)
	)";

	//Query the Database
	$dbresult = mysqli_query($dbconnection, $sql);
	if(!$dbresult)
	{
		die("Something went wrong! " . mysql_error($dbconnection));
	}

	$sql = "CREATE TABLE IF NOT EXISTS `comments` (
	`comment_id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(255) NOT NULL,
	`comment_text` varchar(255) NOT NULL,
	PRIMARY KEY (`comment_id`)
	)";

	//Query the Database
	$dbresult = mysqli_query($dbconnection, $sql);
	if(!$dbresult)
	{
		die("Something went wrong! " . mysqli_error($dbconnection));
	}
	else
		echo "Tables created! You can now delete this file and use the other files to register users (direct users to \"register.html\" to be registered), let users log in (using \"login.html\") and take comments (with \"comments.php\")";
?>

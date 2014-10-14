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

	require_once('validation_functions.php');

	$errors_array = [];

	$username = get_required_string( $_POST, 'uname', 'A username', 3, 255,  $errors_array);
	$pass = get_required_string( $_POST, 'pass', 'A password', 5, 255,  $errors_array);

	if($username == NULL || $pass == NULL)
	{
		foreach($errors_array as $k => $v)
		{
			echo "<p>Warning: {$v}.</p>";
		}
		echo "<a href=\"./login.html\">Go back.</a>";
		die();
	}

	//Connect to Database
	$dbconnection = mysqli_connect("##HOST##", "##USERNAME##", "##PASSWORD##", "##DATABASE_NAME##");
	if(!$dbconnection)
	{
		die("Connection to database failed.");
	}

	$username = mysqli_real_escape_string($dbconnection, $username);
	$sql = "SELECT `password` FROM `registration` WHERE `username` = \"{$username}\"";

	//Query the Database
	$dbresult = mysqli_query($dbconnection, $sql);
	if(!$dbresult)
	{
		$error = mysqli_error($dbconnection);
		die("Something went wrong, contact an administrator. " . $error);
	}
	if( mysqli_num_rows($dbresult) == 0)
	{
		echo "<p>User not found</p>";
	}
	else
	{
		$row = mysqli_fetch_assoc($dbresult);
		$storedPass = $row['password'];
	}

	if(password_verify($pass, $storedPass))
	{
		setcookie('username', $username, time()+365*24*60*60);
		echo "Logged in!<p><a href=\"./comments.php\">Make a comment.</a>";
	}
	else
	{
		echo "Password mismatch, <a href=\"./login.html\">Try again</a>";
	}

	mysqli_close( $dbconnection );
?>

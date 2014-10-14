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
	$options = ['cost' => 15,]; //edit the cost to increase/decrease the amount of time needed to get a hash

	//Connect to Database
	$dbconnection = mysqli_connect("##HOST##", "##USERNAME##", "##PASSWORD##", "##DATABASE_NAME##");
	if(!$dbconnection)
	{
		die("Connection to database failed.");
	}

	$username = htmlspecialchars(get_required_string($_POST, 'uname', 'A username', 3, 255,  $errors_array));
	$username = mysqli_real_escape_string($dbconnection, $username);
	$pass = get_required_string( $_POST, 'pass', 'A password', 5, 255,  $errors_array);
	$passRep = get_required_string( $_POST, 'passRep', 'Repeating your password', 5, 255,  $errors_array);

	if($username == NULL || $pass == NULL || $passRep == NULL)
	{
		foreach($errors_array as $k => $v)
		{
			echo "<p>Warning: {$v}.</p>";
		}
		echo "<a href=\"./register.html\">Go back.</a>";
		die();
	}

	if(!strcmp($pass, $passRep))
	{
		$hashedpass = password_hash($pass, PASSWORD_BCRYPT, $options);
	}
	else
	{
		echo "<a href=\"./register.html\">Go back.</a>";
		die('Passwords didn\'t match.');
	}

	$sql = "INSERT INTO `registration`(`username`, `password`) VALUES('{$username}', '{$hashedpass}');";
	//Query the Database
	$dbresult = mysqli_query($dbconnection, $sql);
	if(!$dbresult)
	{
		$error = mysqli_error($dbconnection);
		if (substr($error, 0, 17) == "Duplicate entry '")
		{
			echo "Username already in use. <a href=\"./\">Go back and try again</a>";
			die();
		}
		die("User not created, contact an administrator. " . $error);
	}
	else
	{
		echo "User created. <a href=\"./login.html\">Return</a>";
	}

	mysqli_close( $dbconnection );
?>

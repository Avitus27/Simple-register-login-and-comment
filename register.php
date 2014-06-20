<?php
	require_once('validation_functions.php');
	$errors_array = [];
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
		$hashedpass = hash('md5', $pass);
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
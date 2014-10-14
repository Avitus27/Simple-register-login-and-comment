<style>
	table {border-collapse: collapse; border-spacing: 0px;}
	th, td {border: 1px solid black;}
	form, table{width:50%;margin-left:auto;margin-right:auto;}
	label,input{float:left;width:49%;}
</style>
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
	
	//Connect to Database
	$dbconnection = mysqli_connect("##HOST##", "##USERNAME##", "##PASSWORD##", "##DATABASE_NAME##");
	if(!$dbconnection)
	{
		die("Connection to database failed.");
	}
	//Is there a comment?
	if(isset($_POST['comment']))
	{
		if(isset($_COOKIE['username']))
		{
			$user = $_COOKIE['username'];
			$comment = htmlspecialchars(get_required_string( $_POST, 'comment', 'A comment', 1, 255,  $errors_array));
			$comment = mysqli_real_escape_string($dbconnection, $comment);
			if($comment !== NULL)
			{
				$sql = "INSERT INTO `comments`(`username`, `comment_text`) VALUES (\"{$user}\",\"{$comment}\")";
				//Query the Database
				$dbresult = mysqli_query($dbconnection, $sql);
				if(!$dbresult)
				{
					$error = mysqli_error($dbconnection);
					die("Something went wrong, contact an administrator. " . $error);
				}
			}
		}
		else
		{
			echo "<p>You need to be logged in to comment. <a href=\"./login.php\">Please login to comment.</a>";
		}
	}
	$sql = "SELECT `username`, `comment_text` FROM `comments`";
	//Query the Database
	$dbresult = mysqli_query($dbconnection, $sql);
	if(!$dbresult)
	{
		$error = mysqli_error($dbconnection);
		die("Something went wrong, contact an administrator. " . $error);
	}
	if( mysqli_num_rows($dbresult) == 0)
	{
		echo "<p>No comments found</p>";
	}
	else
	{
		echo "<table><tr><th>User</th><th>Comment</th></tr>";
		while ( $row = mysqli_fetch_assoc( $dbresult ) )
		{
			echo "<tr><td>{$row['username']}</td><td>{$row['comment_text']}</td></tr>";
		}
		echo "</table>";
	}
	mysqli_close( $dbconnection );
?>
<form action="comments.php" method="post">
	<div>
		<label for="comment">Write a comment here</label>
		<input type="textarea" rows="4" cols="50" name="comment" />
	</div>
	<div>
		<input type="submit" />
		<input type="reset" />
	</div>
</form>
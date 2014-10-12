
# Simple-register-login-and-comment #

I did this for a bit of practice, It's a simple registration, login and comment system.

It's tested and working with mySQL and PHP5

----------

###Install Instructions:###

1.	Change the values in create_database.php, login.php, register.php and comments.php for mysqli_connect():
	\##HOST##			= hostname (i.e. localhost, 127.0.0.1, example.com)
	\##USERNAME##		= your mySQL username
	\##PASSWORD##		= your mySQL password
	\##DATABASE_NAME##	= the database you connect to

2.	Navigate to and open create_database.php in a browser. If it succeeds, delete the file.
3.	If you want passwords to be hashed quicker or slower, change the variable `cost` in the `$options` array in `register.php (Line 5)` to be lower or higher respectively. [See Password Constants on PHP.net for more information on this value](http://php.net/manual/en/password.constants.php).

----------

And that's it! You can add more HTML, CSS etc. as you need to suit it to your needs.

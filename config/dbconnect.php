<?php
require_once('config.php');
// sets database variables
$DBhost			= DBhost;
$DBusername		= DBusername;
$DBpassword		= DBpassword;
$DBname			= DBname;

// connects to database
	$MySQLi_Connection=mysqli_connect($DBhost,$DBusername,$DBpassword,$DBname);
		if (mysqli_connect_errno())
			echo "Database error!";
	$MySQLi_Connection->set_charset("utf8")
?>
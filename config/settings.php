<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
header("X-Content-Type-Options: nosniff");
// sets server date and time
	date_default_timezone_set("Europe/Ljubljana");
	$currentdatetime = date('Y-m-d H:i:s');
	$currentdate = date('Y-m-d');
// sets session
	session_start();
// functions
	// clean inserted data
	function cleanpost($posteddata,$MySQLi_Connection){
		$posteddata = mysqli_real_escape_string($MySQLi_Connection, $posteddata);
		$posteddata = htmlspecialchars($posteddata);
		return $posteddata;
	}
	// get user IP
	function getUserIP() {
		if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
				$addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
				return trim($addr[0]);
			} else {
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
		else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}
?>
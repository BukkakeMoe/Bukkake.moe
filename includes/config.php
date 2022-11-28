<?php

ob_start(); // Turn on output buffering
session_start();

date_default_timezone_set("America/New_York");

try{
	//("**Your Host Name**", "**Your DB name**", "**Your DB Password**");
	$con = new PDO("mysql:host=server.com;dbname=BukkakeVideos", 'BukkakeAdmin', 'Password');
	
	//Last end of folder, path to last folder, FTP Host, FTP Username,FTP Password | Change Deletion method later, buggy and kinda unsafe.
	$ftp_server = array('videos/','/var/www/html/','162.000.111.00','u','password');
	
	$con-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}

?>

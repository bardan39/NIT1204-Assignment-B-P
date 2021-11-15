<?php
session_start();
// $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'; // it for local
$base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
// Enter your Host, username, password, database below.
// $con = mysqli_connect("localhost","root","","shopping_list_manager");// it for local server
$con = mysqli_connect("localhost","root","","shopping_list_manager");
    if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
	}
?>

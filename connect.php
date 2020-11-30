<?php
	$host = "localhost";
	$user = "root";
	$pass = "12345";
	$dbname = "tbbdl";
	$conn = mysqli_connect($host, $user, $pass, $dbname);
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	// echo "Connected successfully";
?>
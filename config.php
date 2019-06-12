<?php 
	session_start();
	// connect to database
	$conn = mysqli_connect("localhost", "root", "", "realestate");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
    // define base url
	$ROOT_PATH = __DIR__;
	define('BASE_URL', 'http://localhost/SoftwareEngineering/');
?>



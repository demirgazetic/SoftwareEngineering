<?php 
	session_start();
	// connect to database
	$conn = mysqli_connect("ol5tz0yvwp930510.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "ybkfqgepc6hqneq4", "lsfhkpboog9go3ro", "sxl0a8ry4y96pg9z");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
    // define base url

	$ROOT_PATH = __DIR__;
	define('BASE_URL', 'https://luxestate.herokuapp.com/');
?>



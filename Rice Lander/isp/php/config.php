

<?php

	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "rice_lander";

	$connection = mysqli_connect($host, $username, $password, $database);

	if ($connection == false) {
	    die("Failed to connect Database!" . mysqli_connect_error());
	}

?>

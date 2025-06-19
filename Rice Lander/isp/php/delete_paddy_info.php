<?php

	require 'config.php';

	?>

	<?php

	if (isset($_GET["id"]))
	{
	    $id = $_GET["id"];

	    $servername = "localhost";
	    $username = "root";
	    $password = "";
	    $database = "rice_lander";

	    $connection = new mysqli($servername, $username, $password, $database);

	    $data = "DELETE FROM products_c WHERE id = $id";
	    $connection->query($data);
	}

	header("location: inventory management.php");
	exit;
?>

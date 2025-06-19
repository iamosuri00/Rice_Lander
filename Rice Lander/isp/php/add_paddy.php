<?php

	require 'config.php';

	if (isset($_POST['paddy_details'])) 
	  {
		$product_id = $_POST['product_id'];
	  	$Paddy_Type = $_POST['Paddy_Type'];
	  	$Quantity = $_POST['Quantity'];
	  	$Price = $_POST['Price'];


	  	$data = "INSERT INTO products_c (Paddy_Type, Quantity, Price, product_id) VALUES ('$Paddy_Type', '$Quantity', '$Price', '$product_id')";

	  	$all = mysqli_query($connection, $data);

	  	if ($all) 
	  	{
	  		header('location:inventory management.php');
	  	}
	  	else
	  	{
	  		die(mysqli_error($connection));
	  	}

	  }	

	  mysqli_close($connection);
?>
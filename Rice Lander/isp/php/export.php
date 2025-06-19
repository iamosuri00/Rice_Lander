<?php

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=PurchaseHistory.xls");

// Check if the file exists and include it
if (file_exists('data.php')) {
    require 'data.php';
} else {
    echo "Error: data.php file not found.";
}

?>

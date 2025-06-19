<?php
require 'config.php';

if ($connection == false) {
    die("Connection Failed!" . mysqli_connect_error());
}

$query = "SELECT p.purchase_id, p.order_id, u.username, p.product_id, p.quantity, p.total_price, p.purchase_date
          FROM purchases p
          JOIN users u ON p.user_id = u.id";
$result = $connection->query($query);

// Check if the query was successful
if (!$result) {
    // Display error message
    die("Query Failed: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="styles2.css">
    <link rel="stylesheet" href="nav.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            padding: 15px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #pic {
            width: 120px; /* Adjust the logo size */
        }

        .auth-cart-container a {
            color: white;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .auth-cart-container a:hover {
            background-color: #5aaafa;
            border-radius: 5px;
        }

        .auth-cart-container button {
            background-color: #5aaafa;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .auth-cart-container button:hover {
            background-color: #4a92e6;
        }

        /* Table Styles */
        #purchase_tbl {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden; /* Prevents border-radius from being cut off */
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        #purchase_tbl th, #purchase_tbl td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        #purchase_tbl th {
            background-color: #34495e;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        #purchase_tbl tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #purchase_tbl tr:hover {
            background-color: #e1f5fe;
        }

        /* Button Styles */
        .action-btn {
            background-color: #5aaafa;
            padding: 8px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
            display: inline-block;
            text-align: center;
        }

        .danger {
            background-color: #e74c3c;
        }

        .danger:hover {
            background-color: #d43f35;
        }

        /* Footer Styles */
        footer {
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <img src="../img/ricelandernew.png" id="pic" alt="no image available">
        <div class="auth-cart-container">
            <a href="chome.php">Home</a>
            <a href="../../order.php">Products</a>
            <a href="#">Service</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="profile.php">My Account</a>
            
            <a href="export.php"> <button id="generateReportBtn" >Generate Report</button>
            
        </div>
    </header>

    <div id="table">
        <table id="purchase_tbl">
            <thead>
                <tr>
                    <th>Purchase ID</th>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Purchase Date</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { 
                    while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['purchase_id']; ?></td>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>Rs. <?php echo number_format($row['total_price'], 2); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['purchase_date'])); ?></td>
                        
                    </tr>
                <?php } } else { ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">No records found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer>
        <div>@2024 All rights reserved</div>
    </footer>

</body>
</html>

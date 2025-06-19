<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

// Get the order_id from the URL
$order_id = $_GET['order_id'];

// Fetch order details for the specific order_id
$order_query = "SELECT * FROM orders WHERE order_id = '$order_id' AND user_id = '$user_id'";
$order_result = mysqli_query($conn, $order_query);

if (!$order_result || mysqli_num_rows($order_result) == 0) {
    die("Order not found or you do not have permission to view it.");
}

$order_details = mysqli_fetch_assoc($order_result);

// Fetch purchase details related to this order_id
$purchase_query = "SELECT p.*, pr.Paddy_Type, pr.Price FROM purchases p 
                   JOIN products_c pr ON p.product_id = pr.id 
                   WHERE p.order_id = '$order_id'";
$purchase_result = mysqli_query($conn, $purchase_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Order #<?php echo $order_details['order_id']; ?></title>
    <link rel="stylesheet" href="css/profile.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        header {
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        main {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
        }
        h3 {
            margin-top: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>My Orders</h1>
    </header>

    <main>
        <div class="container">
        <h3>Purchase Details</h3>
            <h2>Order #<?php echo $order_details['order_id']; ?></h2>
            <p><strong>Date:</strong> <?php echo date("d/m/Y", strtotime($order_details['order_date'])); ?></p>
            <p><strong>Total Amount:</strong> Rs. <?php echo $order_details['total_amount']; ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Paddy Type</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($purchase_result) > 0) {
                        while ($purchase = mysqli_fetch_assoc($purchase_result)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($purchase['Paddy_Type']) . "</td>
                                    <td>" . htmlspecialchars($purchase['quantity']) . "</td>
                                    <td>Rs. " . htmlspecialchars($purchase['Price']) . "</td>
                                    <td>Rs. " . htmlspecialchars($purchase['total_price']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No purchases found for this order.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button>
        <a href="profile.php">Back to My Account</a>
        </button>
    </main>
    <footer>
        <div class="footer-content">
            <div class="about-us">
                <h3>About Us</h3>
                <p>Rice Lander offers an unparalleled premium experience, providing top-quality paddy products directly from the heart of our fields. With a focus on excellence and customer satisfaction, our island-wide services are tailored to meet all your rice-related needs.</p>
            </div>
            <div class="contact-details">
                <h3>Contact Us</h3>
                <p>Email: info@ricelander.com</p>
                <p>Phone: 011-1122856</p>
                <p>Address: 123 Luxury St., Wellawatte, Colombo,Srilanka</p>
            </div>
            <div class="map">
                <h3>Our Location</h3>
                <iframe src="https://www.google.com/maps/embed?..." width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Rice Lander. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
    exit();
}

// Get the order_id from the URL
$order_id = $_GET['order_id'];

// Fetch order details for the specific order_id
$order_query = "SELECT * FROM orders WHERE order_id = '$order_id' AND user_id = '$user_id'";
$order_result = mysqli_query($connection, $order_query);

if(!$order_result || mysqli_num_rows($order_result) == 0) {
    die("Order not found or you do not have permission to download the invoice.");
}

$order_details = mysqli_fetch_assoc($order_result);

// Create the invoice content (You can customize this)
$invoice_content = "
<html>
<head>
    <title>Invoice - Order #{$order_details['order_id']}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        .invoice { margin: 20px; padding: 20px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class='invoice'>
        <h1>Invoice</h1>
        <p><strong>Order ID:</strong> {$order_details['order_id']}</p>
        <p><strong>Date:</strong> " . date("d/m/Y", strtotime($order_details['order_date'])) . "</p>
        <p><strong>Total Amount:</strong> Rs. {$order_details['total_amount']}</p>
        <p><strong>Status:</strong> {$order_details['status']}</p>
    </div>
</body>
</html>
";

// Generate PDF using a library like mPDF or just output HTML
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="invoice_' . $order_details['order_id'] . '.pdf"');

require_once __DIR__ . '/vendor/autoload.php'; // Include mPDF autoload file

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($invoice_content);
$mpdf->Output();
exit();

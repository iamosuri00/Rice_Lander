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
    die("Query Failed: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
</head>

<body>
    <table>
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
                    <td colspan="7" style="text-align: center;">No records found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

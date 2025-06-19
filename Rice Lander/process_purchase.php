<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'rice_lander');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);
$userId = $data['userId'];
$purchases = $data['purchases'];
$finalTotal = $data['finalTotal'];

try {
    // Start transaction
    $conn->begin_transaction();

    // Insert a new order
    $orderQuery = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("id", $userId, $finalTotal);
    $stmt->execute();
    $orderId = $stmt->insert_id; // Get the newly generated order_id

    // Insert each purchase into the purchases table and update the product quantity
    foreach ($purchases as $purchase) {
        $productId = $purchase['productId'];
        $quantity = $purchase['quantity'];
        $totalPrice = $purchase['totalPrice'];

        // Validate that productId is not empty or invalid (e.g., 0 or negative values)
        if (empty($productId) || $productId == 0) {
            throw new Exception("Invalid product ID detected.");
        }

        // Insert purchase details into the purchases table
        $purchaseQuery = "INSERT INTO purchases (order_id, user_id, product_id, quantity, total_price) 
                          VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($purchaseQuery);
        $stmt->bind_param("iiidd", $orderId, $userId, $productId, $quantity, $totalPrice);
        $stmt->execute();

        // Reduce the product quantity in the products_c table
        $updateProductQuery = "UPDATE products_c SET Quantity = Quantity - ? WHERE id = ?";
        $stmt = $conn->prepare($updateProductQuery);
        $stmt->bind_param("ii", $quantity, $productId);
        $stmt->execute();
    }

    // Commit the transaction
    $conn->commit();

    // Send success response
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

$conn->close();
?>

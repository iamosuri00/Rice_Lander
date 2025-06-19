<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'rice_lander');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch paddy data
$sql = "SELECT * FROM products_c";
$result = $conn->query($sql);
?>

<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Redirect to login if user is not logged in
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paddy Order Page</title>
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
</head>
<header>
    <div class="logo">
        <img src="images/companylogo.jpg" alt="Company Logo" id="companyLogo">
    </div>
    <div class="auth-cart-container">
            <a href="chome.php"><i class="CHome"></i> Home</a>
            <a href=""><i class="Products"></i> Products</a>
            <a href=""><i class="Service"></i> Service</a>
            <a href=""><i class="About US"></i> About Us</a>
            <a href=""><i class="Contact Us"></i> Contact Us</a>
            <a href="profile.php"><i class=""></i>My Account</a>
        
        <div class="auth-buttons">
            <button id="loginBtn" onclick="location.href='login.html'">Login</button>
            <button id="signupBtn" onclick="location.href='signup.html'">Sign Up</button>
        </div>
        <button id="cartBtn"><i class="fas fa-shopping-cart"></i> Cart (0)</button>
        </div>
    </div>
    </div>
</header>
    
    <main> 
        <h1>Order Your Paddy</h1>
        <div class="background-blur" style="background-image: url('images/orderback.jpg');"></div>
        <div class="paddy-container">
        <?php
            // Mapping of the real names to database values
            $paddy_names = [
                "White Raw" => "White_Raw",
                "Red Raw Samba" => "Red_Raw_Samba",
                "White Raw Samba" => "White_Raw_Samba",
                "Nadu" => "Nadu",
                "Basmati" => "Basmati",
                "Suwandel" => "Suwandel",
                "Madathawalu" => "Madathawalu",
                "Pachchaperumal" => "Pachchaperumal",
            ];

            // Assuming $result is the database result set
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Get the actual paddy type from the database
                    $db_paddy_type = $row['Paddy_Type'];
                    $db_product_id = $row['id'];
                    $db_Quantity = $row['Quantity'];

                    // Find the display name for the paddy type
                    $paddy_type_display = array_search($db_paddy_type, $paddy_names);
                    
                    if ($paddy_type_display === false) {
                        // If not found in the mapping, use the database value as a fallback
                        $paddy_type_display = $db_paddy_type;
                    }

                    $paddy_type = strtolower(str_replace(' ', '_', $paddy_type_display)); // Convert display name to format for image path
                    $price = $row['Price'];
                    $availability = $row['Quantity'] > 0 ? 'In Stock' : 'Out of Stock';

                    // Set image path
                    $image_path = "images/{$paddy_type}.jpg";
                    if (!file_exists($image_path)) {
                        $image_path = "images/default.jpg";
                    }

                    echo "
                        <div class='paddy-item'>
                            <img src='{$image_path}' alt='{$paddy_type_display}'>
                            <h2>{$paddy_type_display}</h2>
                            <p>Price: Rs. {$price} per kg</p>
                            <p>Quantity {$db_Quantity} </p>
                            <p>Availability: {$availability}</p>
                            <button class='addtocartBtn' data-paddy='{$db_paddy_type}' data-user='{$user_id}' data-product='{$db_product_id}' data-price='{$price}' data-available='{$row['Quantity']}'>Add to cart</button>
                        </div>";
                }
            } else {
                echo "No products available.";
            }
            ?>

    </div>
    </main>

    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="closeBtn">&times;</span>
            <h2>Order Form</h2>
            <form id="orderForm">
                <label for="paddyType">Paddy Type:</label>
                <input type="text" id="paddyType" name="paddyType" readonly>

                <label for="pricePerKg">Price per kg:</label>
                <input type="text" id="pricePerKg" name="pricePerKg" readonly>

                <label for="quantity">Quantity (kg):</label>
                <input type="number" id="quantity" name="quantity" min="1" required>

                <label for="totalPrice">Total Price:</label>
                <input type="text" id="totalPrice" name="totalPrice" readonly>

                <button type="submit">Add to cart</button>
            </form>
        </div>
    </div>

    <!-- Cart Modal -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="closeCartBtn">&times;</span>
            <h2>Your Cart</h2>
            <div id="cartItems"></div>
            <h3 id="cartTotal">Total: Rs. 0.00</h3>
            <br/>
            <button id="purchase" class='purchase'>Purchase</button>
        </div>
    </div>

    <script src="order.js"></script>
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

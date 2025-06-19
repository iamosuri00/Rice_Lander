<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home Page</title>
    <link rel="stylesheet" href="Customer Home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
</head>
<header>
    <div class="logo">
        <img src="images/companylogo.jpg" alt="Company Logo" id="companyLogo">
    </div>
    <div class="auth-cart-container">
        <a href=""><i class="Home"></i> Home</a>
        <a href="order.php"><i class="Products"></i> Products</a>
        <a href=""><i class="Service"></i> Service</a>
        <a href=""><i class="About US"></i> About Us</a>
        <a href=""><i class="Contact Us"></i> Contact Us</a>
        <a href="profile.php"><i class=""></i> My Account</a>
        
        <div class="auth-buttons">
            <button id="logoutBtn" onclick="location.href='logout.php'">Logout</button>
        </div>
        <button id="cartBtn"><i class="fas fa-shopping-cart"></i> Cart (0)</button>
    </div>
</header>
<main class="home-main">
    <div class="main">
        <h1>Welcome to The Rice Lander</h1>
        <hr>
        <p><i>Dear Rice Lander Community—Farmers, Families, and Friends!</i> Welcome to Rice Lander, your ultimate destination for premium paddy products. Shop on our site and unlock exclusive deals just for you.<i> Don't miss out—Harvest the savings now!</i></p>
        <button class="button1" onclick="location.href='order.php'"><b>GET STARTED</b></button>
        <button class="button1" onclick="location.href='home.html'"><b>RICE LANDER</b></button>
    </div>
</main>
<script src="Customer Home.js"></script>
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
            <p>Address: 123 Luxury St., Wellawatte, Colombo, Sri Lanka</p>
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

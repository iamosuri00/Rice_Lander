<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

$message = [];

if(isset($_POST['update_profile'])){
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);
   $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);

   mysqli_query($conn, "UPDATE `users` SET username = '$update_name', email = '$update_email', phone='$update_phone', address='$update_address' WHERE id = '$user_id'") or die('query failed');

   $update_success = true;

   // Password update section
   if(!empty($_POST['old_pass']) || !empty($_POST['new_pass']) || !empty($_POST['confirm_pass'])){
      $old_pass = $_POST['old_pass'];
      $new_pass = $_POST['new_pass'];
      $confirm_pass = $_POST['confirm_pass'];
   
      // Fetch the stored password from the database
      $result = mysqli_query($conn, "SELECT password FROM `users` WHERE id = '$user_id'");
      $user = mysqli_fetch_assoc($result);
      
      if (md5($old_pass) != $user['password']) {
         $message[] = 'Old password not matched!';
         $update_success = false;
      } elseif ($new_pass != $confirm_pass) {
         $message[] = 'Confirm password not matched!';
         $update_success = false;
      } elseif (empty($new_pass)) {
         $message[] = 'New password cannot be empty!';
         $update_success = false;
      } else {
         // Hash the new password
         $hashed_new_pass = md5($new_pass);
         
         // Update password only if the checks pass
         mysqli_query($conn, "UPDATE `users` SET password = '$hashed_new_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'Password updated successfully!';
      }
   }
   
   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Image is too large';
         $update_success = false;
      } else {
         $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            $message[] = 'Image updated successfully!';
         }
      }
   }

   if ($update_success && empty($message)) {
      $message[] = 'Profile updated successfully!';
   }
}

// Handle account deletion
if(isset($_POST['delete_account'])){
   // Delete the user from the database
   $delete_query = mysqli_query($conn, "DELETE FROM `users` WHERE id = '$user_id'") or die('query failed');
   
   if($delete_query){
      // Destroy the session and redirect to the login page after deletion
      session_destroy();
      header('location: login.php');
      exit();
   } else {
      $message[] = 'Account deletion failed!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/updateprofile.css">
</head>
<body>

<header>
    <div class="header-left">
        <img src="images/companylogo.jpg" alt="Company Logo" id="companyLogo">
    </div>
    <div class="header-right">
        <a href="#"><i class="Home"></i> Home</a>
        <a href="order.html"><i class="Products"></i> Products</a>
        <a href="#"><i class="Service"></i> Service</a>
        <a href="#"><i class="About US"></i> About Us</a>
        <a href="#"><i class="Contact Us"></i> Contact Us</a>
        <a href="#"><i class="fas fa-user"></i> My Account</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> (1)</a>
        <input type="text" placeholder="Search...">
    </div>
</header>

<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         } else {
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
               
      <div class="flex">
          <div class="inputBox">
              <span>Username:</span>
              <input type="text" name="update_name" value="<?php echo $fetch['username']; ?>" class="box">
              <span>Your Email:</span>
              <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
              <span>Your Phone:</span>
              <input type="tel" name="update_phone" value="<?php echo $fetch['phone']; ?>" class="box">
              <span>Your Address:</span>
              <input type="text" name="update_address" value="<?php echo $fetch['address']; ?>" class="box">
          </div>
          <div class="inputBox">
              <span>Update Your Pic:</span>
              <input type="file" name="update_image" accept="image/*" class="box">
              <span>Old Password:</span>
              <input type="password" name="old_pass" placeholder="Enter current password" class="box">
              <span>New Password:</span>
              <input type="password" name="new_pass" placeholder="Enter new password" class="box">
              <span>Confirm Password:</span>
              <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
          </div>
      </div>
      <input type="submit" value="Update Profile" name="update_profile" class="btn">
      <input type="submit" value="Delete Your Account" name="delete_account" class="delete-btn" onclick="return confirmDelete();">
      <a href="profile.php" class="delete-btn">Go Back</a>
   </form>

</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete your account? This action cannot be undone.");
}

<?php
if(!empty($message)){
   echo "alert('".implode("\\n", $message)."');";
   if ($update_success) {
      echo "window.location.href = 'profile.php';";
   }
}
?>
</script>

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
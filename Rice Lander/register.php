<?php

include 'config.php';

if(isset($_POST['submit'])){

   $fname = mysqli_real_escape_string($conn, trim($_POST['fullname']));
   $email = mysqli_real_escape_string($conn, trim($_POST['email']));
   $phon = mysqli_real_escape_string($conn, trim($_POST['phone']));
   $add = mysqli_real_escape_string($conn, trim($_POST['address']));
   $uname = mysqli_real_escape_string($conn, trim($_POST['username']));
   $pass = mysqli_real_escape_string($conn, md5(trim($_POST['password'])));
   $cpass = mysqli_real_escape_string($conn, md5(trim($_POST['cpassword'])));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $message = []; // To store validation errors

   // Validate Full Name
   if(empty($fname)) {
      $message[] = 'Full name is required';
   }

   // Validate Email
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $message[] = 'Invalid email format';
   }

   // Validate Phone
   if(!preg_match('/^[0-9]{10}$/', $phon)){
      $message[] = 'Phone number must be 10 digits';
   }

   // Validate Address
   if(empty($add)){
      $message[] = 'Address is required';
   }

   // Validate Username
   if(empty($uname)){
      $message[] = 'Username is required';
   }

   // Validate Password length
   if(strlen($_POST['password']) < 6){
      $message[] = 'Password must be at least 6 characters';
   }

   // Check if passwords match
   if($pass != $cpass){
      $message[] = 'Confirm password does not match';
   }

   // Check image size
   if($image_size > 2000000){
      $message[] = 'Image size is too large!';
   }

   // Check if user already exists
   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists'; 
   }

   // If no validation errors, proceed to insert the user
   if(empty($message)){
      $insert = mysqli_query($conn, "INSERT INTO `users`(fullname, email,phone,address,username, password, image) 
      VALUES('$fname', '$email','$phon','$add','$uname', '$pass', '$image')") or die('query failed');
      
      if($insert){
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'Registered successfully!';
         header('location:login.php');
         exit(); // Always use exit() after header redirection
      }else{
         $message[] = 'Registration failed!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Join Us</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="stylesheet" href="css/register.css">
</head>
<body>
   
<div class="container">
   <div class="image-container">
      <img src="images/join1.jpg" alt="Signup Image">
   </div>
   <div class="form-container">
      <h1>Join Us</h1>

      <form action="" method="post" enctype="multipart/form-data" id="signupForm">
         <?php
         if(!empty($message)){
            foreach($message as $msg){
               echo '<div class="message">'.$msg.'</div>';
            }
         }
         ?>
         <label for="fullName">Full Name</label>
         <input type="text" name="fullname" placeholder="Enter full name" required>
         <label for="email">Email</label>
         <input type="email" name="email" placeholder="Enter email" required>
         <label for="phone">Phone Number</label>
         <input type="tel" name="phone" placeholder="Enter phone" required>
         <label for="address">Address</label>
         <input type="text" name="address" placeholder="Enter address" required>
         <label for="username">Username</label>
         <input type="text" name="username" placeholder="Enter username" required>
         <label for="password">Password</label>
         <input type="password" name="password" placeholder="Enter password" required>
         <label for="confirmPassword">Confirm Password</label>
         <input type="password" name="cpassword" placeholder="Confirm password" required>
         <label for="image">Profile Image</label>
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png">
         <div class="button-container">
            <input type="submit" name="submit" value="Register Now" class="btn">
         </div>
      </form>

      <div class="login">
         <p>Already have an account? <a href="login.php"><strong>Login</strong></a></p>
      </div>

      <hr>

      <button class="social-btn facebook"><i class="fab fa-facebook-f"></i> Signup with Facebook</button> 
      <button class="social-btn google"><i class="fab fa-google"></i> Signup with Google</button>
   </div>
</div>

<script src="signup.js"></script>

</body>
</html>

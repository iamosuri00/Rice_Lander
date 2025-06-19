<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username']; // Assuming you have a 'username' column in your users table
        header('Location: chome.php'); // Redirect to chome.php
        exit();
    } else {
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Login</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                if (isset($message)) {
                    foreach ($message as $msg) {
                        echo '<div class="message">' . $msg . '</div>';
                    }
                }
                ?>
                <div class="input-group">
                    <label for="username"><strong>Email</strong></label>
                    <input type="email" name="email" class="input-field" placeholder="Enter email" required>
                </div>

                <div class="input-group">
                    <label for="password"><strong>Password</strong></label>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="button-container">
                    <input type="submit" name="submit" value="Login Now" class="btn">
                </div>
            </form>
            <hr>
            <button class="social-btn facebook"><i class="fab fa-facebook-f"></i> Signup with Facebook</button> 
            <button class="social-btn google"><i class="fab fa-google"></i> Signup with Google</button>
            <p class="signup-text">Don't have an account? <a href="register.php">Signup</a></p>
        </div>
    </div>
</body>
</html>

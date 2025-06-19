
<?php

	require 'config.php';
    
    $error_message = '';

	if (isset($_POST['login_btn'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		$query = "SELECT * FROM products_manager_details WHERE email = '$email'";
		$result = $connection->query($query);

		
		if ($result->num_rows > 0) {
			
			$user = $result->fetch_assoc();

			
			if ($password == $user['password']) {
				
				header('Location: inventory management.php');
				exit();
			} else {
				$error_message = 'invalid_pwd';
				//echo "Incorrect password!";
			}
		} else {
			
            $error_message = 'does_not_exist';
			//echo "User with this email doesn't exist!";
		}

		
		$result->free();
	}

	
	mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceylon Gem Gallery Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="header">
        <img src="../img/ricelandernew.png" alt="Rice Lander" class="logo">
        
    </header>
    <div class="login-container">
        <div class="login-box">
            <h2>Login new</h2>
            <form action="#" method="post">
                <input type="text" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <a href="#" class="forgot-password">Forget password</a>

                <div>
                    <p id="does_not_exist">User with this email doesn't exist!</p>
                    <p id="invalid_pwd">Incorrect password!</p>
                </div>

                <input type="hidden" id="error_message" value="<?php echo $error_message; ?>">

                <button type="submit" name="login_btn">Login</button>
                <div class="login-options">
                    <p>Or Login With</p>
                    <div class="social-icons">
                        <a href="#"><img src="../img/facebookicon.jpg" alt="Facebook"></a>
                        <a href="#"><img src="../img/googleicon.jpg" alt="Google"></a>
                    </div>
                </div>
            </form>
            <p class="register">Don’t Have An Account? <a href="#">Register</a></p>
        </div>
    </div>

    <script>
        
        var errorMessage = document.getElementById('error_message').value;

        
        if (errorMessage === 'does_not_exist') 
        {
            document.getElementById('does_not_exist').style.display = 'block';
        } 
        else if (errorMessage === 'invalid_pwd') 
        {
            document.getElementById('invalid_pwd').style.display = 'block';
        }
    </script>

</body>
</html>
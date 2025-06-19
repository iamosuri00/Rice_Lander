<?php

	require 'config.php';

	if ($connection == false) {
	    die("Connection Failed!" . mysqli_connect_error());
	}


    $query = "SELECT id, product_id, Paddy_Type, Price, GREATEST(Quantity, 0) AS Quantity FROM products_c";
    $result = $connection->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paddy Management Table</title>
    <link rel="stylesheet" href="../css/styles2.css?v=1.0">
    <link rel="stylesheet" href="nav.css">
    
</head>

<body>

    <header>

        <img src="../img/ricelandernew.png" id="pic" alt="no image available">
        <img src="../img/usernew.png" alt="no image available" id="pic2">
        <div class="auth-cart-container">
            <a href="chome.php"><i class="CHome"></i> Home</a>
            <a href="../../order.php"><i class="Products"></i> Products</a>
            <a href=""><i class="Service"></i> Service</a>
            <a href=""><i class="About US"></i> About Us</a>
            <a href=""><i class="Contact Us"></i> Contact Us</a>
            <a href="profile.php"><i class=""></i>My Account</a>
        
        <div class="auth-buttons">
        </div>
        <button id="pHistoryBtn" onclick="location.href='purchaseHistory.php'">
    <i class="fas fa-shopping-cart"></i> Purchase History
</button>


        </div>
    </header>

    <div id="table">
    
        <table id="inventory_tbl">

            <tr>
                <th>Item No</th>
                <th>Product Id</th>
                <th>Paddy Type</th>
                <th>Quantity</th>
                <th>Price per 1 KG</th>
                <th>Action</th>
            </tr>

            <tbody>
            <?php
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){

            ?>
                        <tr>
                            <td style="border:1px solid black;  border-collapse: collapse; padding:10px; padding-left: 20px !important;"><?php echo $row['id']; ?> </td>
                            <td style="border:1px solid black;  border-collapse: collapse; padding:10px; padding-left: 20px !important;"><?php echo $row['product_id']; ?> </td>
                            <td style="border:1px solid black;  border-collapse: collapse; padding:10px; padding-left: 20px !important;"><?php echo $row['Paddy_Type']; ?> </td>
                            <td style="border: 1px solid black; padding: 10px; padding-left: 20px !important;">
                                <?php 
                                if ($row['Quantity'] <= 100) { ?>
                                    <p style="color: red;"><?php echo htmlspecialchars($row['Quantity']); ?> kg</p>
                                <?php } else {
                                    echo htmlspecialchars($row['Quantity']." kg");
                                } ?>
                            </td>
                            <td style="border:1px solid black;  border-collapse: collapse; padding:10px; padding-left: 20px !important;">Rs. <?php echo $row['Price']; ?> </td>

                            <td style="border:1px solid black;  border-collapse: collapse; padding:10px; width: 260px; padding-left: 20px !important;">
                                <div style="margin: auto;">
                                    <button style="background-color: #5aaafa; width: 100px; height: 35px; border-radius: 6px;margin: 3px; padding: 0px;">
                                    <a class="update" style="color: white; text-decoration: none;  padding-top: 9px; padding-right: 25px; padding-bottom: 9px; padding-left: 25px;"  href="update_paddy_info.php?id=<?php echo $row['id']; ?> ">
                                         Add
                                    </a>
                                </button>
                                <button style="background-color: #f77463; width: 100px; height: 35px; border-radius: 6px;margin: 3px; padding: 0px;">
                                    <a class="danger" style="color: white; text-decoration: none;  padding-top: 9px; padding-right: 25px; padding-bottom: 9px; padding-left: 25px;" href="delete_paddy_info.php?id=<?php echo $row['id']; ?>">
                                        Delete
                                    </a>
                                </button>
                                </div>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>

        </tbody>

        </table>

        <div id="div2">
            <a href="add.php">
                <img src="../img/add button.jpg" alt="no image" id="img3">
            </a>
        </div>
    </div>

    
    <br>


    <footer>
        <div id="foot">@2024 All rights reserved</div>
    </footer>

</body>
</html>

<?php

    include "config.php";
    $data = "SELECT * FROM products_c";
    $all = $connection->query($data)
?>

<?php

	if (isset($_POST['paddy_details_update'])) 
	{
	    $id = $_POST['id'];
        $product_id = $_POST['product_id'];
	    $Paddy_Type = $_POST['Paddy_Type'];
        $newQuantity = $_POST['Quantity'];
	  	$Price = $_POST['Price'];

            // Retrieve the existing quantity from the database
        $existing_data = "SELECT Quantity FROM products_c WHERE id='$id'";
        $existing_result = mysqli_query($connection, $existing_data);
        $existing_row = mysqli_fetch_assoc($existing_result);
        $currentQuantity = $existing_row['Quantity'];

        // Update the quantity by adding the new quantity
        $updatedQuantity = $currentQuantity + $newQuantity;
            
            // Update the product with the new quantity and other details
        $data = "UPDATE products_c SET product_id='$product_id', Paddy_Type='$Paddy_Type', Quantity='$updatedQuantity', Price='$Price' WHERE id='$id'";
        $all = mysqli_query($connection, $data);

	    if ($all) 
	    {
	        header('location:inventory management.php');
	    } 
	    else 
	    {
	        die(mysqli_error($connection));
	    }
	}


	$id = $_GET['id']; 

	$selected_data = "SELECT *  FROM products_c WHERE id='$id'";
	$all_selected = mysqli_query($connection, $selected_data);

	if ($all_selected) 
	{
	    $row = mysqli_fetch_assoc($all_selected);
	} 
	else 
	{
	    die(mysqli_error($connection));
	}

	mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rice Lander</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <img src="../img/ricelandernew.png" alt="Background Image" class="background-img">
    <div class="container">
        <div class="content">

            <div id="form_container">
                <form method="post" action="#" id="add_padding_form">

                    <h2>Add Paddy</h2>

                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >

                    <div id="pid_div"  style=" display: flex; align-items: center; margin-bottom: 10px; flex-direction: column; align-items: flex-end;">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="p_id">Product ID:</label>
                            <input type="text" id="p_id" name="product_id" oninput="validateProductType()" value="<?php echo $row['product_id']; ?>">
                        </div>
                        <div style="display:none;" id="pidTypeErrorDiv">
                            <p style="font-size:12px;padding: 0;padding-right: 15px;margin: 0; color: red;" class="error" id="pidTypeError">only can contain letters and numbers</p>
                        </div>
                    </div>
                    <br>

                    <div id="type_div">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="p_type">Paddy type:</label>
                            <select type="text" id="p_type" name="Paddy_Type"  value="<?php echo $row['Paddy_Type']; ?>" style=" background-color: #f3f3f3; border: none !important; border-radius: 6px; padding: 10px; width: 220px;" required>
                                <!-- <option disable selected>Select Paddy Type</option> -->
                                <option value="White Raw" <?php if ($row['Paddy_Type'] == 'White Raw') echo 'selected'; ?>>White Raw</option>
                                <option value="Red Raw Samba" <?php if ($row['Paddy_Type'] == 'Red Raw Samba') echo 'selected'; ?>>Red Raw Samba</option>
                                <option value="White Raw Samba" <?php if ($row['Paddy_Type'] == 'White Raw Samba') echo 'selected'; ?>>White Raw Samba</option>
                                <option value="Nadu" <?php if ($row['Paddy_Type'] == 'Nadu') echo 'selected'; ?>>Nadu</option>
                                <option value="Basmati" <?php if ($row['Paddy_Type'] == 'Basmati') echo 'selected'; ?>>Basmati</option>
                                <option value="Suwandel" <?php if ($row['Paddy_Type'] == 'Suwandel') echo 'selected'; ?>>Suwandel</option>
                                <option value="Madathawalu" <?php if ($row['Paddy_Type'] == 'Madathawalu') echo 'selected'; ?>>Madathawalu</option>
                                <option value="Pachchaperumal" <?php if ($row['Paddy_Type'] == 'Pachchaperumal') echo 'selected'; ?>>Pachchaperumal</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <!-- Quantity Input -->
                    <div id="quantity_div" style=" display: flex; align-items: flex-end; margin-bottom: 10px; flex-direction: column;">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="Quan">Quantity:</label>
                            <input min="0" type="number" id="Quan" name="Quantity" oninput="validateQuantity()" value="<?php echo $row['Quantity']; ?>" required placeholder="kg">
                        </div>
                        <div style="display:none;" id="quantityErrorDiv">
                            <p style="font-size:12px;padding: 0;padding-right: 15px;margin: 0; color: red;" class="error" id="quantityError">Invalid quantity</p>
                        </div>
                    </div>
                    <br>

                    <!-- Price Input -->
                    <div id="price_div">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="pric">Price:</label>
                            <input min="0" type="number" id="pric" name="Price"  value="<?php echo $row['Price']; ?>" required placeholder="Rs.">
                        </div>
                        <div style="display:none;" id="priceErrorDiv">
                            <p style="font-size:12px;padding: 0;padding-right: 15px;margin: 0;" class="error" id="priceError">Invalid price</p>
                        </div>
                    </div>
                    <br>
    
                    <button type="submit" class="ok-button" name="paddy_details_update">OK</button>
    
                </form>
            </div>
        </div>
        <!-- <button class="ok-button">OK</button> -->
    </div>
    <script>

        const paddyPrices = {
            "White Raw": 55.00,
            "Red Raw Samba": 60.00,
            "White Raw Samba": 65.00,
            "Nadu": 50.00,
            "Basmati": 120.00,
            "Suwandel": 75.00,
            "Madathawalu": 80.00,
            "Pachchaperumal": 70.00
        };

        // function updatePrice() {
        //     const paddyTypeSelect = document.getElementById("p_type");
        //     const quantityInput = document.getElementById("Quan");
        //     const priceInput = document.getElementById("pric");

        //     const selectedPaddyType = paddyTypeSelect.value;
        //     const quantity = parseFloat(quantityInput.value);
        //     const pricePerKg = paddyPrices[selectedPaddyType];

        //     if (!isNaN(quantity) && quantity > 0 && pricePerKg) {
                
        //         const totalPrice = pricePerKg * quantity;
        //         priceInput.value = totalPrice.toFixed(2); 
        //     } else {
        //         priceInput.value = "";
        //     }
        // }

        function validateProductType() {
            const pidTypeInput = document.getElementById("p_id");
            const errorMessage = document.getElementById("pidTypeErrorDiv");
            const regex = /^[A-Za-z0-9]+$/; 

            if (!regex.test(pidTypeInput.value)) {
                errorMessage.style="display: block;";
                return false;
            } else {
                errorMessage.style="display: none;";
                return true;
            }
        }

        function validateQuantity() {
            const quantityInput = document.getElementById("Quan");
            const errorMessage = document.getElementById("quantityErrorDiv");
            const regex = /^\d+(\.\d{1,2})?$/; 

            if (!regex.test(quantityInput.value) || quantityInput.value <= 0) {
                errorMessage.style = "display: block;";
                return false;
            } else {
                errorMessage.style = "display: none;";
                updatePrice();
                return true;
            }
        }

        function validatePrice() {
            const priceInput = document.getElementById("pric");
            const errorMessage = document.getElementById("priceErrorDiv");
            const regex = /^\d+(\.\d{1,2})?$/; 

            if (!regex.test(priceInput.value) || priceInput.value <= 0) {
                errorMessage.style = "display: block;";
                return false;
            } else {
                errorMessage.style = "display: none;";
                return true;
            }
        }

        // Validate form on submit
        document.getElementById("add_padding_form").addEventListener("submit", function(event) {
            const isProductValid = validateProductType();
            const isQuantityValid = validateQuantity();
            const isPriceValid = validatePrice();

            // Prevent submission if input fiels are invalid
            if (!isProductValid || !isQuantityValid || !isPriceValid) {
                event.preventDefault(); // Stop the form submit
                alert("Please correct the errors in the form before submitting.");
            }
        });

    </script>
</body>
</html>
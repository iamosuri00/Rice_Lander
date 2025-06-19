<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rice Lander</title>
    <!-- <link rel="stylesheet" href="../css/styles.css"> -->
    <link rel="stylesheet" href="../css/styles.css?v=1.0">
    
</head>
<body>
    <img src="../img/ricelandernew.png" alt="Background Image" class="background-img">
    <div class="container">
        <div class="content">
            <div id="form_container">
                <form method="post" action="add_paddy.php" id="add_padding_form">

                    <h2>Add Paddy</h2>

                    <div id="pid_div">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="p_id">Product ID:</label>
                            <input type="text" id="p_id" name="product_id" oninput="validateProductType()" required>
                        </div>
                        <div style="display:none;" id="pidTypeErrorDiv">
                            <p style="font-size:12px;padding: 0;padding-right: 15px;margin: 0;" class="error" id="pidTypeError">only can contain letters and numbers</p>
                        </div>
                    </div>
                    <br>
                     
                    <div id="type_div">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="p_type">Paddy type:</label>
                            <select type="text" id="p_type" name="Paddy_Type"   style=" background-color: #f3f3f3; border: none !important; border-radius: 6px; padding: 10px; width: 220px;" required>
                                <!-- <option disable selected>Select Paddy Type</option> -->
                                <option value="White_Raw">White Raw</option>
                                <option value="Red_Raw_Samba">Red Raw Samba</option>
                                <option value="White_Raw_Samba">White Raw Samba</option>
                                <option value="Nadu">Nadu</option>
                                <option value="Basmati">Basmati</option>
                                <option value="Suwandel">Suwandel</option>
                                <option value="Madathawalu">Madathawalu</option>
                                <option value="Pachchaperumal">Pachchaperumal</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <!-- Quantity Input -->
                    <div id="quantity_div">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="Quan">Quantity:</label>
                            <input min="0" type="number" id="Quan" name="Quantity" required placeholder="kg">
                        </div>
                        <div style="display:none;" id="quantityErrorDiv">
                            <p style="font-size:12px;padding: 0;padding-right: 15px;margin: 0;" class="error" id="quantityError">Invalid quantity</p>
                        </div>
                    </div>

                    <br>
                    <!-- Price Input -->
                    <div id="price_div">
                        <div style="display:flex;flex-direction: row;align-items: center;">
                            <label for="pric">Price:</label>
                            <input min="0" type="number" id="pric" name="Price" oninput="validatePrice()" required placeholder="Rs.">
                        </div>
                        <div style="display:none;" id="priceErrorDiv">
                            <p style="font-size:12px;padding: 0;padding-right: 15px;margin: 0;" class="error" id="priceError">Invalid price</p>
                        </div>
                    </div>
                    <br>

                    <button type="submit" class="ok-button" name="paddy_details">OK</button>

                </form>
            </div>

        </div>
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
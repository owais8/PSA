<?php
require_once 'config.php'; // Include the config file
$conn = connectDB();
$id=$_SESSION["user_id"];
// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $cardQuantity = $_POST["cardQuantity"];
    $pickupDropOff = $_POST["pickupDropOff"];
    $cardSelection = $_POST["card_selection"];
    $price = $_POST["price"];
    $dv = $_POST["dv"];

    // Calculate total_price
    $totalPrice = $cardQuantity * $price;

    // Insert data into the database
    $sql = "INSERT INTO orders_psa (card_quantity, pickup_dropoff, card_selection, price, dv, total_price,user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("issddd", $cardQuantity, $pickupDropOff, $cardSelection, $price, $dv, $totalPrice, $id);
        
        if ($stmt->execute()) {
            header("Location: logging.php?id=" . $stmt->insert_id); // Redirect to insurance page
            // Data inserted successfully
        } else {
            // Error while executing the statement
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error while preparing the statement
        echo "Error: " . $mysqli->error;
    }
}

// Close the database connection
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Select with Cards</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <br>
    <div class="card bg-light mb-6" style="max-width: 100%;">
            <div class="card-body">
                <h3><b>Add Grading</b></h3>  
                <hr>    
                <div class="form-group">
                <form action="" method="post">
                    <label for="email">How many cards do you want?</label>
                    <br>
                    <div class="custom-select card-select">
                        <div class="selected-card">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Select a Card</h5>
                                </div>
                            </div>
                        </div>
                        <div class="options">
                            <!-- Example card options (you can add more) -->
                                        <div class="card option" data-value="PSA-Express | 170 | 2499">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA-Express</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>PSA-Express</td>
                                                            <td>$170</td>
                                                            <td>$2499</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card option" data-value="PSA- Super Express | 330 | 4999">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA- Super Express</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>PSA- Super Express</td>
                                                            <td>$330</td>
                                                            <td>$4999</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card option" data-value="PSA Dual - Express | 220 | 2499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA Dual - Express</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for PSA Dual - Express -->
                                                        <tr>
                                                            <td>PSA Dual - Express</td>
                                                            <td>$220</td>
                                                            <td>$2499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card option" data-value="PSA - Value Bulk (1979-older) | 19 | 499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA - Value Bulk (1979-older)</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for PSA - Value Bulk (1979-older) -->
                                                        <tr>
                                                            <td>PSA - Value Bulk (1979-older)</td>
                                                            <td>$19</td>
                                                            <td>$499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card option" data-value="PSA - Value Plus | 40 | 499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA - Value Plus</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for PSA - Value Plus -->
                                                        <tr>
                                                            <td>PSA - Value Plus</td>
                                                            <td>$40</td>
                                                            <td>$499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Card option 6 -->
                                        <div class="card option" data-value="PSA - Regular | 75 | 1499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA - Regular</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for PSA - Regular -->
                                                        <tr>
                                                            <td>PSA - Regular</td>
                                                            <td>$75</td>
                                                            <td>$1499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Card option 7 -->
                                        <div class="card option" data-value="PSA - Value Bulk (1980-Present) | 19 | 499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA - Value Bulk (1980-Present)</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for PSA - Value Bulk (1980-Present) -->
                                                        <tr>
                                                            <td>PSA - Value Bulk (1980-Present)</td>
                                                            <td>$19</td>
                                                            <td>$499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Card option 8 -->
                                        <div class="card option" data-value="PSA - Dual Regular | 100 | 1499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA - Dual Regular</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for PSA - Dual Regular -->
                                                        <tr>
                                                            <td>PSA - Dual Regular</td>
                                                            <td>$100</td>
                                                            <td>$1499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Card option 9 -->
                                        <div class="card option" data-value="PSA - Dual Super Express | 415 | 4999.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA - Dual Super Express</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for PSA - Dual Super Express -->
                                                        <tr>
                                                            <td>PSA - Dual Super Express</td>
                                                            <td>$415</td>
                                                            <td>$4999.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card option" data-value="Dual Value - Authentic only Modern | 35 | 499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">Dual Value - Authentic only Modern</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for Dual Value - Authentic only Modern -->
                                                        <tr>
                                                            <td>Dual Value - Authentic only Modern</td>
                                                            <td>$35</td>
                                                            <td>$499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Card option 11 -->
                                        <div class="card option" data-value="Dual Value - Dual Graded Modern | 35 | 499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">Dual Value - Dual Graded Modern</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for Dual Value - Dual Graded Modern -->
                                                        <tr>
                                                            <td>Dual Value - Dual Graded Modern</td>
                                                            <td>$35</td>
                                                            <td>$499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Card option 12 -->
                                        <div class="card option" data-value="Dual Value - Dual Graded Older | 35 | 499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">Dual Value - Dual Graded Older</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for Dual Value - Dual Graded Older -->
                                                        <tr>
                                                            <td>Dual Value - Dual Graded Older</td>
                                                            <td>$35</td>
                                                            <td>$499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Card option 13 -->
                                        <div class="card option" data-value="Dual Value - Authentic only Older | 35 | 499.00">
                                            <div class="card-body">
                                                <h5 class="card-title">Dual Value - Authentic only Older</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for Dual Value - Authentic only Older -->
                                                        <tr>
                                                            <td>Dual Value - Authentic only Older</td>
                                                            <td>$35</td>
                                                            <td>$499.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card option" data-value="PSA - TCG/Pokemon Bulk | 17 | 199.00">
                                            <div class="card-body">
                                                <h5 class="card-title">PSA - TCG/Pokemon Bulk</h5>
                                                <table class='table table-sm table-borderless'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service Level</th>
                                                            <th scope="col">Price Per Card</th>
                                                            <th scope="col">Accepted DV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data for Your New Card Option -->
                                                        <tr>
                                                            <td>PSA - TCG/Pokemon Bulk</td>
                                                            <td>$17</td>
                                                            <td>$199.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Add more card options here -->
                                    </div>
                                </div>
                        </div>
                        
                        <input type='hidden' name='card_selection' id='card_selection' value=''>
                        <input type='hidden' name='price' id='price' value=''>
                        <input type='hidden' name='dv' id='dv' value=''>


                        <div class="row">
                            <div class="form-group">
                                <label for="email">How many cards do you want?</label>
                                <input
                                    name="cardQuantity"
                                    type="number"
                                    class="form-control"
                                    id="email"
                                />
                            </div>
                        </div>
                        <br>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="pickupDropOff" id="localPickup" value="localPickup">
                            <label class="form-check-label" for="localPickup">Yes, I'll drop off and pick up my cards</label>
                        </div>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="pickupDropOff" id="mailCards" value="mailCards">
                            <label class="form-check-label" for="mailCards">No, I'll mail them</label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Continue">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and your custom script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src='custom.js'></script>
</body>
<?php include 'footer.php'; ?>

</html>

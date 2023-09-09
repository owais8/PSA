<?php
session_start();
require_once 'config.php'; // Include the config file
$conn = connectDB();

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to load order details by ID
function loadOrderDetails($conn, $orderId) {
    $sql = "SELECT * FROM order_details WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to insert card data into order_details
function insertCardData($conn, $orderId, $qty, $cardYear, $brand, $cardNumber, $playerName, $attributesSN, $declaredValue) {
    $sql = "INSERT INTO order_details (order_id, qty, cardYear, brand, cardNumber, playerName, attributesSN, declaredValue) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssss", $orderId, $qty, $cardYear, $brand, $cardNumber, $playerName, $attributesSN, $declaredValue);
    return $stmt->execute();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = intval($_GET["id"]); // Get the ID from the URL
    $qty = $_POST["qty"];
    $cardYear = $_POST["cardYear"];
    $brand = $_POST["brand"];
    $cardNumber = $_POST["cardNumber"];
    $playerName = $_POST["playerName"];
    $attributesSN = $_POST["attributesSN"];
    $declaredValue = $_POST["declaredValue"];

    // Insert card data into order_details
    if (insertCardData($conn, $orderId, $qty, $cardYear, $brand, $cardNumber, $playerName, $attributesSN, $declaredValue)) {
        // Data successfully inserted
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }
}

// Close the database connection
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Submission Form</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <?php include 'details.php'; ?>
    <br>
    <br>
    <div class="card bg-light mb-6" style="max-width: 100%; padding: 20px;">
    <h3><b>Card Submission Form</b></h3>
    <hr>
    <form action='' method='post'>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" class="form-control" id="qty" name="qty">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="cardYear">Card Year *</label>
                    <input type="text" class="form-control" id="cardYear" name="cardYear" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="playerName">Player Name</label>
                    <input type="text" class="form-control" id="playerName" name="playerName">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="attributesSN">Attributes/SN</label>
                    <input type="text" class="form-control" id="attributesSN" name="attributesSN">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="declaredValue">Declared Value *</label>
                    <input type="text" class="form-control" id="declaredValue" name="declaredValue" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <table class="table table-sm table-borderless">
        <thead>
          <tr>
            <th scope="col">Qty</th>
            <th scope="col">Card Year</th>
            <th scope="col">Brand</th>
            <th scope="col">Card Number</th>
            <th scope="col">Player Name</th>
            <th scope="col">Attributes/SN</th>
            <th scope="col">Declared Value</th>

          </tr>
        </thead>
        <tbody>
    <?php
    
    if (isset($_GET["id"])) {
        $orderId = intval($_GET["id"]); // Get the ID from the URL
    
        // Load order details based on the ID
        $orderDetails = loadOrderDetails($conn, $orderId);
    
            // Order details exist, display them in the table
            if (count($orderDetails) > 0) {
            foreach ($orderDetails as $row) {
                echo '<tr>';
                echo '<td>' . $row["qty"] . '</td>';
                echo '<td>' . $row["cardYear"] . '</td>';
                echo '<td>' . $row["brand"] . '</td>';
                echo '<td>' . $row["cardNumber"] . '</td>';
                echo '<td>' . $row["playerName"] . '</td>';
                echo '<td>' . $row["attributesSN"] . '</td>';
                echo '<td>' . $row["declaredValue"] . '</td>';
                echo '</tr>';
            }

        } else {
            echo '<tr>';
            echo '<td colspan="7" class="text-center align-middle">No cards logged.</td>';
            echo '</tr>';        }
        $conn->close();

    }
    $insurance="insurance.php?id=".$_GET["id"];
    ?>
        </tbody>
    </table>
    <p>If you are done logging cards, please continue the process by clicking below.</p>
    </div>
    <a href=<?php echo $insurance?> class="btn btn-primary">Continue</a> 
</div>
<?php include 'footer.php'; ?>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

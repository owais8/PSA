<?php
require_once 'config.php'; // Include the config file
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Extract the ID parameter from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID parameter is missing in the URL.";
    exit;
}

// Step 3: Construct a SQL query to fetch data based on the ID
$sql = "SELECT * FROM orders_psa WHERE order_id = $id";

// Step 4: Execute the query
$result = $conn->query($sql);

// Step 5: Retrieve and display the data
$row=null;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Add more fields as needed
} else {
    echo "No records found with ID: $id";
}

// Close the database connection
?>


    <div class="card bg-light">
        <div class="card-body">
        <h3><b>Order Information</b></h3>
        <hr>
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title"><b>Order Number</b></h5>
                    <p class="card-text"><?php echo $row["order_id"]?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Service Level</b></h5>
                    <p class="card-text"><?php echo $row["card_selection"]?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Order Creation Date/Time</b></h5>
                    <p class="card-text"><?php echo $row["created_at"]?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title"><b>Total Price of Cards</b></h5>
                    <p class="card-text">$<?php echo $row["total_price"]?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Total DV</b></h5>
                    <p class="card-text">$<?php echo $row["dv"]?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Total Card Qty</b></h5>
                    <p class="card-text"><?php echo $row["card_quantity"]?></p>
                </div>
            </div>
        </div>
    </div>
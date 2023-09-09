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
$sql1 = "SELECT * FROM submissions WHERE id = $id";

// Step 4: Execute the query
$result1 = $conn->query($sql1);

// Step 5: Retrieve and display the data
$row1=null;
if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    // Add more fields as needed
} else {
    echo "No records found with ID: $id";
}
$sql2 = "SELECT SUM(declaredValue) AS total_dv FROM order_details where order_id = $id";
$result2 = $conn->query($sql2);
$total_dv=null;
if ($result2) {
    $row2 = $result2->fetch_assoc();
    $total_dv = $row2['total_dv'];
    if ($total_dv==null) {
        $total_dv=0;
    }
} else {
    $total_dv=0;
}
$sql3 = "SELECT SUM(qty) AS total_q FROM order_details where order_id = $id";
$result3 = $conn->query($sql3);
$total_q=null;
if ($result3) {
    $row3 = $result3->fetch_assoc();
    $total_q = $row3['total_q'];
    if ($total_q==null) {
        $total_q=0;
    }

} else {
    echo 'No records found.';
    $total_q=0;
}
$price=($row1["total_grading_price"]/$row1["card_quantity"])*$total_q
// Close the database connection
?>


    <div class="card bg-light">
        <div class="card-body">
        <h3><b>Order Information</b></h3>
        <hr>
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title"><b>Order Number</b></h5>
                    <p class="card-text"><?php echo $row1["id"]?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Service Level</b></h5>
                    <p class="card-text"><?php echo $row1["service_provider"]?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Order Creation Date/Time</b></h5>
                    <p class="card-text"><?php echo $row1["created_at"]?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title"><b>Cards Price</b></h5>
                    <p class="card-text">$<?php echo $price ?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Total DV</b></h5>
                    <p class="card-text">$<?php echo $total_dv?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Quantity</b></h5>
                    <p class="card-text"><?php echo $total_q?></p>
                </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title"><b>Insurance Cost</b></h5>
                    <p class="card-text">$<?php echo $row1["insurance"]?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Shipping Cost</b></h5>
                    <p class="card-text">$30</p>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title"><b>Total Cost</b></h5>
                    <p class="card-text">$<?php echo $price+$row1["insurance"]+30+$row1["total_evaluation_price"];?></p>
                </div>
                
            </div>
        </div>
    </div>
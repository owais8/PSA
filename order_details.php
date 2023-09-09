<?php
session_start();
require_once 'config.php';
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function loadOrderDetails($conn, $orderId) {
    $sql = "SELECT * FROM order_details WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders List</title>
        <!-- Include Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class='container'>
<?php include 'details.php'; ?>
    <br>
    <br>
    <h3><b>Logged Cards</b></h3>
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
    ?>
    </table>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>

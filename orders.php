<?php
require_once 'config.php';
$conn = connectDB();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id=$_SESSION["user_id"]
// Step 2: Retrieve data from the "orders_psa" table
$sql = "SELECT order_id, card_selection, card_quantity, total_price FROM orders_psa where user_id=$id";
$result = $conn->query($sql);

// Step 3: Display the data in an HTML table
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

    <h1>Orders List</h1>
    <table class="table table-lg">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Service Level</th>
            <th scope="col">Status</th>

            <th scope="col">Quantity</th>
            <th scope="col">Total Value</th>
            <th scope="col">Order Details</th>
            <th scope="col">View Grades</th>
            <th scope="col">Payment Link</th>

          </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["order_id"] . "</td>";
                echo "<td>" . $row["card_selection"] . "</td>";
                echo "<td></td>";
                echo "<td>" . $row["card_quantity"] . "</td>";
                echo "<td>" . $row["total_price"] . "</td>";
                echo '<td><a href="order_details.php?id=' . $row["order_id"] . '">View Details</a></td>';
                echo "<td></td>";
                echo "<td></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No orders found</td></tr>";
        }
        ?>
    </table>
    </div>
</body>
<?php include 'footer.php'; ?>

</html>

<?php
// Close the database connection
$conn->close();
?>

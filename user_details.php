<?php
session_start();
require_once 'config.php';
$conn = connectDB();
if (!isset($_SESSION["user_id"])) {
    header("Location: admin-login.php");
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id=$_GET["id"];
// Step 2: Retrieve data from the "orders_psa" table
$sql = "SELECT id,card_value, service_provider, card_quantity,status FROM submissions where user_id=$id";
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
<br>
<br>
<div class='container'>

    <h1>Orders List</h1>
    <table class="table table-lg">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Status</th>

            <th scope="col">Total Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Edit Submission Number</th>

          </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id=$row["id"];
                $sql1 = "SELECT * FROM submissions WHERE id = $id";
                // Step 4: Execute the query
                $result1 = $conn->query($sql1);

                // Step 5: Retrieve and display the data
                $row1=null;
                if ($result1->num_rows > 0) {
                    $row1 = $result1->fetch_assoc();
                    // Add more fields as needed
                } else {
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
                    $total_q=0;
                }
                $price=($row1["total_grading_price"]/$row1["card_quantity"])*$total_q;
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>$" . ($price + $row1["insurance"] + 30 + $row1["total_evaluation_price"]) . "</td>"; // Corrected the calculation and added </td>
                echo "<td>" . $row["card_quantity"] . "</td>";
                echo '<td><a href="edit_order.php?id=' . $row["id"] . '">Edit</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No orders found</td></tr>";
        }
        ?>
    </table>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>

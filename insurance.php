<?php
require_once 'config.php'; // Include the config file
$conn = connectDB();

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET["id"])) {
        $orderId = intval($_GET["id"]); // Get the ID from the URL
        $insurance = $_POST["insurance"];

        // Update the insurance value in the psa_orders table
        $sql = "UPDATE orders_psa SET insurance = ? WHERE order_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $insurance, $orderId);

        if ($stmt->execute()) {
            header("Location: finalize.php?id=" . $_GET["id"]);
        } else {
            // Error occurred
            echo "Error: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
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
    <form method='post' action=''>
    <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="email">Add Insurance</label>
            <input
              name="insurance"
              type="text"
              class="form-control"
              id="email"
              required="true"
            />
          </div>
        </div>
        <p>Insurance is calculated at a rate of $6 per $500 of Amount of Insurance requested on return shipments. To decline insurance, please enter 0. Please enter the total amount of insurance you would like (i.e. 1,500 and NOT $6).</p>
        <br>
        <div class='col'>
        <input type="submit" class="btn btn-primary" value="Continue"  />
</div>
</form>

</div>
</div>
</body>
<?php include 'footer.php'; ?>

</html>
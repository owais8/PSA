<?php
session_start();
require 'config.php';
$conn = connectDB();
if (!isset($_SESSION["user_id"])) {
    header("Location: admin-login.php");
    exit();
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $submission = $_POST['submission'];

    // Update the submission for the order
    $sql = "UPDATE submissions SET submission = '$submission' WHERE id = $order_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: users.php"); // Redirect back to the main page after update
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch order details from the database based on the order ID
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $sql = "SELECT * FROM submissions WHERE id = $order_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        echo "Order not found.";
        exit();
    }
} else {
    echo "Order ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <link rel="stylesheet" href="style.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
    <?php include 'details.php'; ?>
    <br>
        <h1 class="mb-4">Edit Order</h1>

        <form method="post" action="">
            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
            <div class="form-group">
                <label for="submission">Submission Number:</label>
                <input type="text" class="form-control" name="submission" value="<?= $order['submission'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Submission</button>
        </form>
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Order Details</h1>

        <table class="table">
            <tr>
                <th>Order ID:</th>
                <td><?= $order['id'] ?></td>
            </tr>
            <tr>
                <th>Number of Cards:</th>
                <td><?= $order['card_quantity'] ?></td>
            </tr>
            <tr>
                <th>Submission:</th>
                <td><?= $order['submission'] ?></td>
            </tr>
            <tr>
                <th>Status:</th>
                <td><?= $order['status'] ?></td>
            </tr>
        </table>
        
        <a href="users.php" class="btn btn-primary">Back to Orders</a>
        <br>
        <br>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

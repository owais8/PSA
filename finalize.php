<?php
session_start();
require_once 'config.php'; // Include the config file
$conn = connectDB();
$successMessage="";
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET["id"])) {
        $orderId = intval($_GET["id"]); // Get the ID from the URL
        $insurance = $_POST["phone_number"];

        // Update the insurance value in the psa_orders table
        $sql = "UPDATE orders_psa SET phone_number = ? WHERE order_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $insurance, $orderId);

        if ($stmt->execute()) {
            $successMessage = "Order placed successfully. Please visit this <a href='orders.php'> link </a> to view your order details";
        } else {
            // Error occurred
            echo "Error: " . $stmt->error;
        }

        // Close the database connection
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
    <form method="post" action="">
    <div class="row">
    <?php if (!empty($successMessage)) { ?>
                    <div class="alert alert-success">
                        <?php echo $successMessage; ?>
                    </div>
                <?php } ?>
        <div class="col">
            <div class="form-group">
                <label for="email">Add Phone Number</label>
                <input
                    name="phone_number"
                    type="text"
                    class="form-control"
                    id="email"
                    required="true"
                />
            </div>
        </div>
    </div>
    <p>Insurance is calculated at a rate of $6 per $500 of Amount of Insurance requested on return shipments. To decline insurance, please enter 0. Please enter the total amount of insurance you would like (i.e., 1,500 and NOT $6).</p>

    <h3>Text Message Updates</h3>
    <p>Along with email updates, add your cell phone to be informed with text message updates. We'll update you for status updates, when your grades pop and when it's time for final payment. Not interested, just leave it blank, and we won't bother you!</p>

    <p>Once grades pop, we provide a link via email to view your grades. Payment is due at that time and expected at the time of invoice days. Failure to pay within 30 days will result in a collection attempt process as outlined on our privacy and terms policy pages. In addition, I agree to the Price Change policy also located on our terms policy page.</p>

    <p>
        By checking the <input type="checkbox" name="agree_terms" value="yes" required="true"> Yes, I Agree box and submitting this order, you agree to abide by the terms as linked.
    </p>

    <p>Please note our shipping address has changed as of 7/7/22:</p>
    <address>
        2491 N. Mt. Juliet Rd.<br>
        PO Box 439<br>
        Mt. Juliet, TN 37121
    </address>

    <button type="submit" class="btn btn-primary">Continue</button>
</form>


</div>
</div>
</body>
<?php include 'footer.php'; ?>

</html>
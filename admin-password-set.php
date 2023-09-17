<?php
// Assuming you have a database connection established
require 'config.php';
$conn = connectDB();
if (!isset($_SESSION["user_id"]) && ($_SESSION["role"] != 'admin' || $_SESSION["role"] != 'owner')) {
    header("Location: admin-login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "newPassword" field is submitted and not empty
    if (isset($_POST["newPassword"]) && !empty($_POST["newPassword"])) {
        // Sanitize and validate the new password (you may want to add more validation)
        $newPassword = $_POST["newPassword"];

        // Check if the "id" parameter exists in the URL
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = $_GET["id"];
            $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the admin table using the provided ID
            $sql = "UPDATE admin SET password = '$hashed_password', password_new = 'done' WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                // Password updated successfully
                header("Location: admin-login.php");
                exit();
            } else {
                // Handle database error, if any
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // ID not found in the URL, redirect to admin-login.php
            header("Location: admin-login.php");
            exit();
        }
    } else {
        // Handle empty or invalid password input
        echo "Invalid password input.";
    }
}

// Close the database connection if you opened it earlier
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="style.css">
    <title>Set New Password</title>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container col-6">
        <h2>Set New Password</h2>
        <form action="" method="post">
            <div class="input-group">
                <input type="password" class='form-control' name="newPassword" placeholder="Enter your new password" required>
            </div>
            <div class="input-group">
                <button class='btn btn-primary' type="submit">Set Password</button>
            </div>
        </form>
    </div>
</body>
</html>

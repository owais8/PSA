<?php
require_once("config.php"); // Include your database connection script here
$conn = connectDB();

if (isset($_GET['token'])) {
    $verification_token = $_GET['token'];

    // Check if a user with the provided verification token exists
    $sql = "SELECT * FROM users WHERE verification_token = '$verification_token' AND status = 'unverified'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Update the user's status to 'verified'
        $update_sql = "UPDATE users SET status = 'verified' WHERE verification_token = '$verification_token'";
        if (mysqli_query($conn, $update_sql)) {
            $message="<h3>Email verification successful. You can now <a href='index.php'>login</a>.<h3/>";
        } else {
            echo "Error updating user status: " . mysqli_error($conn);
        }
    } else {
        $message="<h3>Invalid verification token or the user is already verified.<h3/>";
    }
} else {
    echo "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" style='width:50%; margin-top: 10%;'>
    <?php echo $message; ?>
    </div>
</body>
</html>

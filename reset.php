<?php
require_once("config.php"); // Include your database connection script here
$conn = connectDB();
$reset_token = $_GET["token"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_password"])) {
    $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the admin's password and clear the reset token
    $update_sql = "UPDATE admin SET password = '$hashed_password', reset_token = NULL WHERE reset_token = '$reset_token'";
    if (mysqli_query($conn, $update_sql)) {
        $msg="Password reset successful. You can now <a href='admin-login.php'>login</a> with your new password.";
    } else {
        echo "Error resetting the password: " . mysqli_error($conn);
    }
}

elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {

    // Check if the reset token exists and is valid
    $sql = "SELECT * FROM admin WHERE reset_token = '$reset_token'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Token is valid, display the password reset form
        $admin_data = mysqli_fetch_assoc($result);
    } else {
        // Token is invalid or expired
        echo "Invalid or expired reset token. Please request a new password reset link.";
    }
} else {
    // Token is not provided or the page is accessed without a token
    echo "Invalid request.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" style="width: 50%; margin-top: 10%;">
        <div class="card bg-light">
            <div class="card-body">
                <h3>Reset Password</h3>
            </div>
                <?php if (!empty($msg)) { ?>
                    <div class="alert alert-success">
                        <?php echo $msg; ?>
                    </div>
                <?php } ?>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

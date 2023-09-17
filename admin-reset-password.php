<?php
require_once("config.php"); // Include your database connection script here
$conn = connectDB();
session_start();
$id=$_SESSION["user_id"];
if (!isset($_SESSION["user_id"]) && ($_SESSION["role"] != 'admin' || $_SESSION["role"] != 'owner')) {
    header("Location: admin-login.php");
    exit();
}
$msg="";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($id)) {

    // Check if the admin email exists in the database
    $sql = "SELECT * FROM admin WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row=mysqli_fetch_assoc($result);
        // Generate a unique reset token
        $reset_token = bin2hex(random_bytes(32));

        // Update the admin's record with the reset token and a timestamp
        $update_sql = "UPDATE admin SET reset_token = '$reset_token' WHERE id = '$id'";
        if (mysqli_query($conn, $update_sql)) {
            // Send an email with a link to reset the password
            $reset_link = "http://localhost/PSA/reset.php?token=$reset_token";
            $to = $row['email'];
            $subject = "Password Reset";
            $message = "Click the following link to reset your password: $reset_link";
            $headers = "From: owaisorakzai77@gmail.com";

            if (mail($to, $subject, $message, $headers)) {
                $msg="<h3 class='text-center'>An email with instructions to reset your password has been sent to your email address.</h3>";
                session_destroy();
            } else {
                $msg= "Error sending the email. Please try again later.";
            }
        } else {
            echo "Error updating reset token: " . mysqli_error($conn);
        }
    } else {
        echo "Admin email not found in the database.";
    }
}
?>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <br>
    <br>
    <div class='container text-center'>
        <!-- Display the success message using Bootstrap alert classes -->
        <div class="alert alert-success">
            <?php echo $msg; ?>
            <br>
            <a href="admin-login.php">Login</a>

        </div>
    </div>
    <br>
</body>


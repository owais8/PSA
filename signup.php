<?php
session_start();
require_once("config.php"); // Include your database connection script here
$conn = connectDB();
$alertMessage = ""; // Initialize an empty alert message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Attempt to insert user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php"); // Redirect to the login page after successful registration
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // MySQL error code 1062 corresponds to a duplicate entry error
            $alertMessage = "Username or email already exists. Please try another one";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
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
    <div class="card bg-light" >
        <div class="card-body">
                <h3>Sign Up</h3>
            </div>
            <div class="card-body">
                <!-- Display the alert message if it's not empty -->
                <?php if (!empty($alertMessage)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $alertMessage; ?>
                    </div>
                <?php } ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <br>
        <p>Already have an account? <a href="index.php">Login</a></p>
    </div>
</div>
</body>
</html>

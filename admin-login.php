<?php

session_start();
require_once("config.php"); // Include your database connection script here
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);

    // Query the database for user
    $sql = "SELECT id, username, password, password_new, role FROM admin WHERE username = '$username' and reset_token=''";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row["password_new"] == 'Change') {
            header("Location: admin-password-set.php?id=" . $row['id']);
        }
        else{
        $hashed_password = $row["password"];

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            header("Location: users.php"); // Redirect to a dashboard page
        } else {
            $alertMessage= "Invalid username or password";
        }
    }
    } else {
        $alertMessage= "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='style.css'>
    <style>

    </style>
</head>
<body>
    <div class="container" style='width:50%; margin-top: 10%;'>
    <div class="card bg-light" >
        <div class="card-body">
                <h3>Login</h3>
            </div>
            <div class="card-body">
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
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="card-footer">
                <p>Don't have an account? <a href="admin-signup.php">Sign up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
s
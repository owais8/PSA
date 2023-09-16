<?php
session_start();
require 'config.php';
$conn = connectDB();

if (!$conn->connect_error) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username or email already exists in the database
        $checkSql = "SELECT * FROM admin WHERE username = ? OR email = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Username or email already exists, show an error message
            echo "Username or email already exists. Please choose another one.";
        } else {
            // Insert user details into the database
            $sql = "INSERT INTO admin (name, username, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $fullName, $username, $email, $hashed_password);

            if ($stmt->execute()) {
                // Send an email with a link for the user to set their username and password
                $subject = "Welcome to Our Website";
                $message = "Click the following link to set your username and password:\n\n";
                $message .= "http://yourwebsite.com/set_username_password.php?email=" . urlencode($email);
                mail($email, $subject, $message);

                header("Location: user_list.php"); // Redirect to the user list page
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkStmt->close();
    }
} else {
    die("Connection failed: " . $conn->connect_error);
}
?>

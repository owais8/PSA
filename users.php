<?php
session_start();
require 'config.php'; // Include the config file
$conn = connectDB();
if (!isset($_SESSION["user_id"])) {
    header("Location: admin-login.php");
    exit();
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Retrieve user data from the database
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='style.css'>
    <title>User List</title>
</head>
<body>
    <div class="container mt-5">
        <h2>User List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 3: Display user data in the table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $submission_query = "SELECT notify FROM submissions WHERE user_id = " . $row['id'] . " AND notify = 'new'";
                        $submission_result = $conn->query($submission_query);
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        if ($submission_result->num_rows > 0) {
                            echo "<td class='custom-cell'><div class='red-circle'></div>" . $row["username"] . "</td>";
                        } else {
                            echo "<td>" . $row["username"] . "</td>";
                        }
                        echo "<td>" . $row["email"] . "</td>";
                        echo '<td><a href="user_details.php?id=' . $row["id"] . '">View Details</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

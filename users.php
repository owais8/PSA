<?php
session_start();
require 'config.php'; // Include the config file
$conn = connectDB();

if (!isset($_SESSION["user_id"]) && ($_SESSION["role"] != 'admin' || $_SESSION["role"] != 'owner')) {
    header("Location: admin-login.php");
    exit();
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Retrieve user data from the database
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);
$alertMessage='';


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
    $result1 = $checkStmt->get_result();

    if ($result1->num_rows > 0) {
        // Username or email already exists, show an error message
        $alertMessage = '<div class="alert alert-danger" role="alert">Username or email already exists. Please choose another one.</div>';
    } else {
        // Insert user details into the database
        $sql1 = "INSERT INTO admin (name, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("ssss", $fullName, $username, $email, $hashed_password);

        if ($stmt1->execute()) {

            $alertMessage = '<div class="alert alert-success" role="alert">User successfully added.</div>';
        } else {
            echo "Error: " . $stmt1->error;
        }

    }

    $checkStmt->close();
}
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
    <div class='row'>
        <div class='col-sm-4 d-flex justify-content-between'>
            <?php if ($_SESSION["role"] == "owner") { ?>
                <?php echo '<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addUserModal">Add User</button>';?>
            <?php } ?>

            <form action="admin-reset-password.php" method="post">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
            <?php if ($_SESSION["role"] == "owner") { ?>
                <?php echo '<a href="admins.php" class="btn btn-primary">Admin List</a>';?>
            <?php } ?>

            <a href="admin-logout.php" class="btn btn-primary">Logout</a>

            </div>
        </div>

        <br>
        <br>

        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="addUserForm" method="post" action="">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>
        <?php echo $alertMessage; ?>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>

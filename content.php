<?php
session_start();
require 'config.php'; // Include the config file
$conn = connectDB();

if (!isset($_SESSION["user_id"]) && ($_SESSION["role"] != 'admin' || $_SESSION["role"] != 'owner')) {
    header("Location: admin-login.php");
    exit();
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user's input from the textarea
    $user_text = $_POST["user_text"];

    // Insert or update the text in the database
    $update_sql = "UPDATE website SET home_text = ? WHERE id = 1";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("s", $user_text);

    if ($update_stmt->execute()) {
        $msg="Text saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $update_stmt->close();
}

// Retrieve the text from the database
$sql = "SELECT home_text FROM website LIMIT 1";
$result = $conn->query($sql);
$saved_text="";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $saved_text = $row["home_text"];
} else {
    $saved_text = "";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Content</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body class="container text-center">
    <br>
    <a href="javascript:history.back()" class="btn btn-primary">Back</a>
    <br>
    <br>
    <?php if(isset($msg)){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo $msg; ?>
        </div>
    <?php } ?>
    <br>
    <h1>Change Content</h1>
    <br>
    <form method="post" action="">
        <textarea class="form-control" cols="100" style="height:250px !important;" name="user_text"><?php echo $saved_text; ?></textarea>
        <br>
        <input type="submit" class='btn btn-primary' value="Save Text">
    </form>
</body>
</html>

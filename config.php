<?php
// Database connection details
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'psa';

define('STRIPE_API_KEY', 'pk_test_51HEE1xFzx5jG4jjg7re03HawPlyc6BTpE7ZZJYaUrrcgsSlPskIRjdCY0vAlaXbozfW9DqTHiofTlqnWO8Iy211X00L9q3IkPk'); 
define('STRIPE_PUBLISHABLE_KEY', 'sk_test_51HEE1xFzx5jG4jjgiNkiG5mCAmVJzGcSMdV6AM0M7Lk26fBUFCzYh80jThtwmdZKSdQACQ3lSWhpaDGPJiXXby7T00LPEpQli8'); 

// Function to establish database connection
function connectDB() {
    global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME;
    
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}
?>
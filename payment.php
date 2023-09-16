<?php
session_start();
require 'C:/Users/SofToO/vendor/autoload.php';
require_once 'config.php';

$order_id=$_GET['id'];
$id=$_SESSION['user_id'];
$conn = connectDB();
if (!isset($_SESSION["user_id"]) || $order_id==null) {
    header("Location: index.php");
    exit();
}
$sql1 = "SELECT * FROM submissions WHERE id = $order_id";
    // Step 4: Execute the query
$result1 = $conn->query($sql1);

    // Step 5: Retrieve and display the data
$row1=null;
if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
        // Add more fields as needed
    } else {
    }

    $sql3 = "SELECT SUM(qty) AS total_q FROM order_details where order_id = $order_id";
    $result3 = $conn->query($sql3);
    $total_q=null;
    if ($result3) {
        $row3 = $result3->fetch_assoc();
        $total_q = $row3['total_q'];
        if ($total_q==null) {
            $total_q=0;
        }

    } else {
        $total_q=0;
    }
    $price=($row1["total_grading_price"]/$row1["card_quantity"])*$total_q;
    $total_payment=($price + $row1["insurance"] + 30 + $row1["total_evaluation_price"]);
    $stripe = new \Stripe\StripeClient("sk_test_51HEE1xFzx5jG4jjgiNkiG5mCAmVJzGcSMdV6AM0M7Lk26fBUFCzYh80jThtwmdZKSdQACQ3lSWhpaDGPJiXXby7T00LPEpQli8");
    $metadata = [
        'order_id' => $order_id // Replace with your order ID
    ];
    $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => [[
          'price_data' => [
            'currency' => 'usd',
            'product_data' => [
              'name' => $row1['card_value'],
            ],
            'unit_amount' => $total_payment*100,
          ],
          'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/PSA/success.php',
        'cancel_url' => 'http://localhost/PSA/cancel',
        'client_reference_id' => $order_id, // Set order_id as client_reference_id
        'payment_intent_data'=>['metadata' => $metadata],


      ]);
      
      header("HTTP/1.1 303 See Other");
      header("Location: " . $checkout_session->url);
      ?>
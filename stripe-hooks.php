<?php
// webhook.php
//
// Use this sample code to handle webhook events in your integration.
//
// 1) Paste this code into a new file (webhook.php)
//
// 2) Install dependencies
//   composer require stripe/stripe-php
//
// 3) Run the server on http://localhost:4242
//   php -S localhost:4242

require 'C:/Users/SofToO/vendor/autoload.php';
require 'config.php';
$conn = connectDB();
// The library needs to be configured with your account's secret key.
// Ensure the key is kept out of any version control system you might be using.
$stripe = new \Stripe\StripeClient('sk_test_...');

// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = 'whsec_a12d0619b62dd68feb091dba92867584d4523332a687abcb9fa80c4f02203919';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}

// Handle the event
switch ($event->type) {
  case 'payment_intent.succeeded':
    $session = $event->data->object;
    $metadata=$event->data->object->metadata;
    $client_reference_id = $session->client_reference_id;
    
    // Convert the client_reference_id to an integer
    $order_id = $metadata['order_id'];
    
    // Update the database
    $sql = "UPDATE submissions SET payment_status='paid' WHERE id=$order_id";
    $result = $conn->query($sql);
    
    if ($result) {
        echo "Payment status updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    break;

  case 'payment_intent.created':
    // Handle other event types
    break;

  default:
    echo 'Received unknown event type ' . $event->type;
}
http_response_code(200);
?>

<?php
require 'vendor/autoload.php'; // Ensure this path is correct

use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'your_account_sid';
$token = 'your_auth_token';
$client = new Client($sid, $token);

// The phone number you want to send the message to
$to = '+1234567890';
// The Twilio phone number you purchased at twilio.com/console
$from = '+0987654321';

// The body of the text message
$body = 'Hello from Twilio!';

try {
    // Send the SMS
    $message = $client->messages->create(
        $to,
        [
            'from' => $from,
            'body' => $body
        ]
    );
    
    echo "Message sent: " . $message->sid;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

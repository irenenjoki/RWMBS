<?php
if (isset($_POST['mpesa-number']) && isset($_POST['paymentAmount'])) {
    // STKPUSH
    date_default_timezone_set('Africa/Nairobi');

    // Access token credentials
    $consumerKey = '4ozF7pH6knCfSYOABuRf8lHIbWVTp58TROAOZVEqnlghnl7q'; // Fill with your app Consumer Key
    $consumerSecret = 'tuHHkuPuhOFCXdVRgMzj52JVJUCvmp5hmyJwqgafFai4XcPbCSRWIvkN40B9bq6C'; // Fill with your app Secret

    // Define variables
    $Amount = $_POST['paymentAmount'];
    $BusinessShortCode = '174379'; // Update with your shortcode
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    $PartyA = $_POST['mpesa-number']; // Client's phone number
    $AccountReference = 'Kibabii';
    $TransactionDesc = 'Payment for Water Services';

    // Get timestamp
    $Timestamp = date('YmdHis');

    // Generate base64 encoded password
    $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

    // Headers for requests
    $headers = ['Content-Type:application/json; charset=utf8'];

    // M-PESA endpoint URLs
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/push';

    // Callback URL
    $CallBackURL = 'https://yourdomain.com/callback_url.php'; // Update with your actual callback URL

    // Get access token
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
        exit();
    }
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($status != 200) {
        echo 'Failed to get access token, HTTP status code: ' . $status;
        exit();
    }
    $result = json_decode($result);
    $access_token = $result->access_token;
    curl_close($curl);

    // Headers for STK push
    $stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

    // Initiate the transaction
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);

    $curl_post_data = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => $CallBackURL,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
        exit();
    }
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($status != 200) {
        echo 'Failed to initiate transaction, HTTP status code: ' . $status;
        exit();
    }
    curl_close($curl);

    // Redirect to index.php
    header("Location: ../index.php"); // Adjust path as needed
    exit();
}
?>

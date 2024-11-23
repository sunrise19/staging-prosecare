<?php
include('Config.php');

if (isset($_REQUEST["data"])) {
    $email = $_SESSION["email"];
    $userId = $_SESSION["id"];
    $hospitalId = $_SESSION["hospital_id"];
    
    $name = $_SESSION["name"]; 
    $secretKey = 'sk_test_831d324bbc66ab7ae579bb89bad24e55ebf7bb50';
    $baseUrl = 'https://api.paystack.co/transaction/initialize';

    // Collect form data
    $amount = (float)$_REQUEST["data"][0] * 100; // Convert to kobo

    // Generate a unique reference
    $reference = uniqid('ps_');
    // Callback URL where Paystack will redirect the user after payment
    $callbackUrl = 'http://pcare.loc/STATIC_API/api_verify_payment.php';

    $data = [
        'email' => $email,
        'amount' => $amount,
        'reference' => $reference,
        'first_name' => $name,
        'callback_url' => $callbackUrl,  // Specify the callback URL here
    ];

    // Initialize the payment
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $baseUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $secretKey",
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);

    // Check if Paystack API returned a valid response
    if ($result['status']) {
        $transactionId = $result['data']['id']; // Paystack transaction ID

        // Save to the database (status = pending)
        $sql = "INSERT INTO payments (user_id, hospital_id, amount, reference, transaction_id) 
                VALUES ($userId, $hospitalId, $amount, '$reference', '$transactionId')";

        $saved = $conn->query($sql);

        if ($saved === TRUE) {
            // Send back the authorization URL
            echo json_encode(['status' => 'success', 'url' => $result['data']['authorization_url']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save transaction data']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error initializing payment: ' . $result['message']]);
    }
} else {
    echo 'Please provide all data :/';
}

$conn->close();
?>

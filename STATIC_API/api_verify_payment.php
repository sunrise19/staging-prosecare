<?php

include('Config.php');

$secretKey = 'sk_test_831d324bbc66ab7ae579bb89bad24e55ebf7bb50';
$reference = $_GET['reference'];

// Verify the transaction
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $secretKey"
    ],
]);

$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response, true);

if ($result['status'] && $result['data']['status'] === 'success') {
    $transactionId = $result['data']['id'];
    $amount = $result['data']['amount'] / 100; // Amount is in kobo, convert to Naira
    $description = "Wallet funding"; // Adjust based on your needs
    $hospitalId = $_SESSION['hospital_id'];

    // Start a database transaction
    $conn->begin_transaction();
    try {
        // Update the payments table
        $updatePaymentSql = "UPDATE payments SET status = 'success', transaction_id = '$transactionId' WHERE reference = '$reference'";
        if (!$conn->query($updatePaymentSql)) {
            throw new Exception("Failed to update payments table: " . $conn->error);
        }
    
        // Retrieve the payment_id of the updated record
        $paymentIdResult = $conn->query("SELECT id FROM payments WHERE reference = '$reference'");
        if ($paymentIdResult->num_rows === 0) {
            throw new Exception("Failed to retrieve payment_id for reference: $reference");
        }
    
        $paymentRow = $paymentIdResult->fetch_assoc();
        $paymentId = $paymentRow['id'];
    
        
        // Increment the wallet column in the hospitals table
        $updateWalletSql = "UPDATE hospitals SET wallet = wallet + $amount WHERE hospital_id = '$hospitalId'";
        if (!$conn->query($updateWalletSql)) {
            throw new Exception("Failed to update hospital wallet: " . $conn->error);
        }
    
        // Get the updated wallet balance
        $walletResult = $conn->query("SELECT wallet FROM hospitals WHERE hospital_id = '$hospitalId'");
        if ($walletResult->num_rows === 0) {
            throw new Exception("Failed to fetch updated wallet balance.");
        }
    
        $walletRow = $walletResult->fetch_assoc();
        $newWalletBalance = $walletRow['wallet'];
    
        // Update session wallet value
        $_SESSION['wallet'] = $newWalletBalance;
        
        // Insert into transactions table
        $insertTransactionSql = "INSERT INTO transactions (payment_id, hospital_id, type, description, amount, current) 
                                 VALUES ('$paymentId', '$hospitalId', 'credit', '$description', '$amount', $newWalletBalance)";
        if (!$conn->query($insertTransactionSql)) {
            throw new Exception("Failed to insert into transactions table: " . $conn->error);
        }
    
    
        // Commit transaction
        $conn->commit();
    
        // Redirect with success message
        header("Location: ../Dashboard/Hospital-Home.php?payment_status=success");
        exit();
    } catch (Exception $e) {
        // Rollback transaction in case of any error
        $conn->rollback();
    
        // Log error or handle accordingly
        error_log($e->getMessage());
    
        // Redirect with failure message
        header("Location: ../Dashboard/Hospital-Home.php?payment_status=failed&message=" . urlencode($e->getMessage()));
        exit();
    }
    
} else {
    // Redirect with failure message
    $errorMessage = isset($result['message']) ? $result['message'] : 'Unknown error';
    header("Location: ../Dashboard/Hospital-Home.php?payment_status=failed&message=" . urlencode($errorMessage));
    exit();
}
?>

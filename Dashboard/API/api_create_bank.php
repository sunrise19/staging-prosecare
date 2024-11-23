<?php

include('../../STATIC_API/Config.php');

$data = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['id'];

    if (isset($_POST['bank'], $_POST['account'], $_POST['number'])) {

        $bank = $conn->real_escape_string($_POST['bank']);
        $account = $conn->real_escape_string($_POST['account']);
        $number = $conn->real_escape_string($_POST['number']);

        $sql = "INSERT INTO banks (
                        user_id, 
                        bank_name, 
                        account_number, 
                        account_name
                        ) VALUES (
                            '$user_id ', 
                            '$bank',  
                            '$account',
                            '$number' 
                        )";

        if ($conn->query($sql) === TRUE) {
            $data = '1';
        } else {
            $data = $conn->error;
        }
    } else {
        // Required fields are missing in the request
        http_response_code(400); // Bad request
        $data = "Missing required fields";
    }

} else {
    // Not a POST request
    http_response_code(405);
    $data = "Method Not Allowed";
}

echo $data;

$conn->close();

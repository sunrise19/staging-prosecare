<?php

include('../../STATIC_API/Config.php');

$data = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['type'], $_POST['send_to'], $_POST['users'], $_POST['title'], $_POST['message'])) {

        // Sanitize and validate the input data if needed
        $type = $conn -> real_escape_string($_POST['type']);
        $send_to = $conn -> real_escape_string($_POST['send_to']);
        $users = $conn -> real_escape_string($_POST['users']);
        $title = $conn -> real_escape_string($_POST['title']);
        $message = $conn -> real_escape_string($_POST['message']);
        
        $timestamp = $serverDate . ' ' . $serverTime;

        $sql = "INSERT INTO notifications (
            sent_to, 
            title, 
            type, 
            timestamp, 
            message, 
            status,
            users
        ) VALUES (
            '$send_to', 
            '$title', 
            '$type', 
            '$timestamp', 
            '$message',
            'Sent',
            '$users'
        )";

        /*
        $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($email, 'PROSE Care Regsitration', 'Hello 👋,<br><br>You have been registered on PROSE Care<br><br>PROSE Care Team.', $headers);

        */

        if ($conn->query($sql) === TRUE) {
            $data = 1;
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

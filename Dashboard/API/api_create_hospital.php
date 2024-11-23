<?php

include('../../STATIC_API/Config.php');

$data = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset(
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['password']
    )) {

        // Sanitize and validate the input data if needed
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        
        $sql = "SELECT email FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $data = 'Email address for is already registered';
        } else {
            $sql = "SELECT phone FROM hospitals WHERE phone = '$phone'";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                $data = 'Phone Number is already registered';
            } else {

                $email_hash = sha1($email) . sha1($email);
                $password = password_hash('P@ssw0rd@123', PASSWORD_DEFAULT);
                $verification_code = rand(11111, 99999);
                $consent = false;

                $sql = "INSERT INTO users (user_type, email, email_hash, password, signup_date, signup_time, verification_code, verified, consent) VALUES ('hospital', '$email', '$email_hash', '$password', '$serverDate', '$serverTime', '$verification_code', 'true', '$consent')";

                $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                    'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($email, 'PROSE Care Regsitration', 'Hello 👋,<br><br>You have been registered on PROSE Care<br><br>PROSE Care Team.', $headers);

                if ($conn->query($sql) === TRUE) {

                    $user_id = $conn->insert_id;

                    $hospital_id = $hospital;

                    $sql = "INSERT INTO hospitals (
                        user_id, 
                        name, 
                        country, 
                        state,  
                        address,
                        lga,
                        code, 
                        phone, 
                        cadre,
                        wallet
                        ) VALUES (
                            '$user_id ', 
                            '$name', 
                            'Nigeria', 
                            '', 
                            '$address',
                            '', 
                            '', 
                            '$phone', 
                            '', 
                            0
                        )";

                    if ($conn->query($sql) === TRUE) {

                        $data = '1'.$user_id;

                    } else {

                        $data = $conn->error;
                    }
                } else {
                    $data = $conn->error;
                }
            }
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

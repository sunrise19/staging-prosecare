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
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $verification_code = rand(11111, 99999);
                $consent = false;

                $sql = "INSERT INTO users (user_type, email, email_hash, password, signup_date, signup_time, verification_code, verified, consent, is_forgot_password) VALUES ('hospital', '$email', '$email_hash', '$hashed_password', '$serverDate', '$serverTime', '$verification_code', 'true', '$consent', 'true')";

                // Define email headers
                $headers = 'MIME-Version: 1.0' . "\r\n" .
                           'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                           'From: "PROSEcare" <no-reply@prosecare.com>' . "\r\n" .
                           'Reply-To: info@prosecare.com' . "\r\n" .
                           'X-Mailer: PHP/' . phpversion();
                
                // Define email subject
                $subject = 'PROSEcare Registration';
                
                // Define email body
                $message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>PROSEcare Registration</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            color: #333;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 20px;
                        }
                        .email-container {
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            max-width: 600px;
                            margin: 20px auto;
                        }
                        .email-header {
                            text-align: center;
                            color: #007BFF;
                        }
                        .email-footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 12px;
                            color: #555;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <h2 class="email-header">Welcome to PROSEcare!</h2>
                        <p>Hello 👋,</p>
                        <p>You have been successfully registered on <b>PROSEcare</b>. Kindly use the credential below to access your account:</p>
                        <br />
                        <p> Email: <b>' . $email . '</b></p>
                        <p> Password: <b>' . $password . '</b></p>
                        <br />
                        <p>If you have any questions or need further assistance, feel free to contact us at <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                        <p>Thank you,<br>The PROSEcare Team</p>
                    </div>
                    <div class="email-footer">
                        &copy; ' . date('Y') . ' PROSEcare. All rights reserved.
                    </div>
                </body>
                </html>
                ';
                
                // Send email
                mail($email, $subject, $message, $headers);
                                
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

<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){
        $email = $_REQUEST["data"][0];
        $email_hash = sha1($email).sha1($email);
        $password = password_hash($_REQUEST["data"][1],PASSWORD_DEFAULT);
        $verification_code = rand(11111, 99999);

        $TYPE = strtolower($_REQUEST["data"][2]);
        if($TYPE != 'patient' && $TYPE != 'caregiver' && $TYPE != 'hcp'){
            echo 3;
        }

        $sql = "SELECT email FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            echo 2;
        } else {

            $consent = $TYPE == 'hcp' ? 'true' : 'false';
 
            $sql = "INSERT INTO users (user_type, email, email_hash, password, signup_date, signup_time, verification_code, verified, consent) VALUES ('$TYPE', '$email', '$email_hash', '$password', '$serverDate', '$serverTime', '$verification_code', 'false', '$consent')";

            $headers = 'MIME-Version: 1.0' . "\r\n" .
           'Content-type: text/html; charset=UTF-8' . "\r\n" .
           'From: PROSEcare <no-reply@prosecare.com>' . "\r\n" .
           'Reply-To: info@prosecare.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();
            
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>PROSEcare Registration</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333;
                    }
                    .content {
                        margin: 20px auto;
                        padding: 20px;
                        max-width: 600px;
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background-color: #f9f9f9;
                    }
                    a {
                        color: #007BFF;
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
                <div class="content">
                    <p>Hello 👋,</p>
                    <p>Thank you for signing up to PROSEcare!</p>
                    <p>Kindly use code <b>' . htmlspecialchars($verification_code) . '</b> to verify your account.</p>
                    <p>If you have any questions or concerns, please contact us via <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                    <br>
                    <p>Thank you,</p>
                    <p><b>PROSEcare Team</b></p>
                </div>
            </body>
            </html>
            ';
            
            mail($email, 'PROSEcare Registration', $message, $headers);

            if($conn->query($sql) === TRUE) {
                echo 1;
            }else{
                echo 0;
            }

        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
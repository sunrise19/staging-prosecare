<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){
        $name = $_REQUEST["data"][0];
        $email = $_REQUEST["data"][1];
        $email_hash = sha1($email).sha1($email);
        $country = $_REQUEST["data"][2];
        $state = $_REQUEST["data"][3];
        $lga = $_REQUEST["data"][4];
        $code = $_REQUEST["data"][5];
        $phone = $_REQUEST["data"][6];
        $cadre = $_REQUEST["data"][7];
        $password = md5($_REQUEST["data"][8]);
        $verification_code = rand(11111, 99999);

        $sql = "SELECT email FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            echo 'email_used';
        } else {

            $sql = "SELECT phone FROM hospitals WHERE code = '$code' AND phone = '$phone'";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                echo 'phone_used';
            }else{
                
                $sql = "INSERT INTO users (user_type, email, email_hash, password, signup_date, signup_time, verification_code, verified) VALUES ('hospital', '$email', '$email_hash', '$password', '$serverDate', '$serverTime', '$verification_code', 'false')";

                if($conn->query($sql) === TRUE) {

                    $user_id = $conn->insert_id;
                    
                    $sql = "INSERT INTO hospitals (user_id, name, country, state, lga, code, phone, cadre) VALUES ('$user_id', '$name', '$country', '$state', '$lga', '$code', '$phone', '$cadre')";

                    if($conn->query($sql) === TRUE) {
                        // Define headers
                        $headers = 'MIME-Version: 1.0' . "\r\n" .
                                'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                                'From: "PROSEcare" <no-reply@prosecare.com>' . "\r\n" .
                                'Reply-To: info@prosecare.com' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();

                        // Define subject
                        $subject = 'PROSEcare Hospital Registration';

                        // Email message body
                        $message = '
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>PROSEcare Hospital Registration</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.6;
                                    color: #333;
                                    margin: 0;
                                    padding: 20px;
                                    background-color: #f9f9f9;
                                }
                                .email-container {
                                    background: #ffffff;
                                    border: 1px solid #dddddd;
                                    border-radius: 8px;
                                    max-width: 600px;
                                    margin: 20px auto;
                                    padding: 20px;
                                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                                }
                                .email-header {
                                    text-align: center;
                                    font-size: 24px;
                                    color: #007BFF;
                                }
                                .email-footer {
                                    text-align: center;
                                    margin-top: 20px;
                                    font-size: 12px;
                                    color: #555;
                                }
                                a {
                                    color: #007BFF;
                                    text-decoration: none;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="email-container">
                                <h2 class="email-header">Welcome to PROSEcare!</h2>
                                <p>Dear ' . htmlspecialchars($name) . ',</p>
                                <p>Thank you for joining PROSEcare.</p>
                                <p>Your verification code is:</p>
                                <h3 style="text-align: center; color: #007BFF;">' . htmlspecialchars($verification_code) . '</h3>
                                <p>If you didn’t request this registration, please ignore this email.</p>
                                <p>If you have any questions or concerns, feel free to contact us at <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                                <p>Thank you,<br><strong>PROSEcare Team</strong></p>
                            </div>
                            <div class="email-footer">
                                &copy; ' . date('Y') . ' PROSEcare. All rights reserved.
                            </div>
                        </body>
                        </html>
                        ';

                        // Send the email
                        mail($email, $subject, $message, $headers);

                        $_SESSION["id"] = $user_id;
                        $_SESSION["name"] = $name;
                        $_SESSION["email"] = $email;
                        $_SESSION["photo"] = "empty.png";
                        $_SESSION["type"] = "hospital";
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }

            }

        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
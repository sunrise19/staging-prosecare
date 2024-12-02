<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){
        $email = $_REQUEST["data"][0];

        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                
                $email_hash = $row['email_hash'];
                $verification_code = rand(11111, 99999);
                $sql = "UPDATE users SET verification_code='$verification_code', is_forgot_password='true' WHERE email='$email'";
    
                $conn->query($sql);
                    
                // Define headers
                $headers = 'MIME-Version: 1.0' . "\r\n" .
                        'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                        'From: "PROSEcare" <no-reply@prosecare.com>' . "\r\n" .
                        'Reply-To: info@prosecare.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                // Define subject
                $subject = 'PROSEcare Account Recovery';

                // Email message body
                $message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>PROSEcare Account Recovery</title>
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
                        <h2 class="email-header">Account Recovery</h2>
                        <p>Dear User,</p>
                        <p>Your recovery code is:</p>
                        <h3 style="text-align: center; color: #007BFF;">' . htmlspecialchars($verification_code) . '</h3>
                        <p>If you didn\'t request to reset your password, please ignore this email.</p>
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

                
                echo '1,VerifyAccount?WithAuth='.$email_hash;

                

                /* $user_id = $row["user_id"];
                $email_hash = $row["email_hash"];
                $name = "";

                if($row["user_type"] == "hospital"){
                    $sql = "SELECT name FROM hospitals WHERE user_id = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        while($irow = $result->fetch_assoc()) {
                            $name = $irow["name"];
                        }
                    }
                }

                $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($email, 'PROSE Care Account Recovery', 'Dear '.$name.',<br>Please click <a target="_blank" href="'.$SITE_URL.'/ChangePassword?WithAuth='.$email_hash.'"> here </a> to change your password.<br><br>If you didn\'t request to change your password please ignore this email.<br><br>Thanks,<br>PROSE Care.', $headers);
                
                echo '1'; */
                
            }
            

        } else {
            echo '0';
        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
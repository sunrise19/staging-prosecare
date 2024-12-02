<?php

    include('Config.php');

    // if(isset($_SESSION["email"])){
    if($_REQUEST["EMAIL"] != ""){
        $email = $_REQUEST["EMAIL"];
        $verification_code = rand(11111, 99999);


        $sql = "UPDATE users SET verification_code='$verification_code' WHERE email='$email'";

        if($conn->query($sql) === TRUE) {
            
            $headers = 'MIME-Version: 1.0' . "\r\n" .
           'Content-type: text/html; charset=UTF-8' . "\r\n" .
           'From: PROSE Care <no-reply@prosecare.com>' . "\r\n" .
           'Reply-To: info@prosecare.com' . "\r\n" . // Provide a valid support email
           'X-Mailer: PHP/' . phpversion();
            
            // Build the email content
            $subject = 'Verify Your PROSEcare Account';
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Verify Your PROSEcare Account</title>
            </head>
            <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                <h2>Account Verification</h2>
                <p>Hello,</p>
                <p>Your verification code is <strong>' . htmlspecialchars($verification_code) . '</strong>.</p>
                <p>If you didn\'t request to verify your account, you can safely ignore this email.</p>
                <br>
                <p>Thanks,</p>
                <p>The PROSEcare Team</p>
            </body>
            </html>';
            
            // Send the email
            mail($email, $subject, $message, $headers);
            
            echo '1';
        }else{
            echo '0';
        }

        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
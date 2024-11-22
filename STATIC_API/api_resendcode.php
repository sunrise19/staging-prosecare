<?php

    include('Config.php');

    // if(isset($_SESSION["email"])){
    if($_REQUEST["EMAIL"] != ""){
        $email = $_REQUEST["EMAIL"];
        $verification_code = rand(11111, 99999);


        $sql = "UPDATE users SET verification_code='$verification_code' WHERE email='$email'";

        if($conn->query($sql) === TRUE) {
            $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            // mail($email, 'PROSE Care Account Verification', 'Dear '.$_SESSION["name"].',<br>Your verification code is '.$verification_code.'<br>If you didn\'t request to verify your account please ignore this email<br><br>Thanks,<br>PROSE Care.', $headers);
            mail($email, 'PROSE Care Account Verification', 'Your verification code is '.$verification_code.'<br>If you didn\'t request to verify your account please ignore this email<br><br>Thanks,<br>PROSE Care.', $headers);
            echo '1';
        }else{
            echo '0';
        }

        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
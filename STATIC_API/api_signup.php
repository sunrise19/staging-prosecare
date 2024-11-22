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

            $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            // mail($email, 'PROSE Care Registration', 'Hello 👋,<br><br>Thank you for signing up to participate in the PROSE Care<br><br>Kindly verify your email <a href="https://prosecare.com/TEST_V2/Verify?WithAuth='.$email_hash.'">here</a> to enable you proceed with the reporting of your side effects.<br>We encourage you to promptly report your side effects.<br><br>Please contact us if you have any questions or concerns via <a href="mailto:research@prosecare.com">research@prosecare.com</a><br><br>Thank you.<br><br>PROSE Care Team.', $headers);
            mail($email, 'PROSE Care Registration', 'Hello 👋,<br><br>Thank you for signing up to PROSE Care<br><br>Kindly use code <b>'.$verification_code.'</b> to verify your account <br><br>Please contact us if you have any questions or concerns via <a href="mailto:research@prosecare.com">research@prosecare.com</a><br><br>Thank you.<br><br>PROSE Care Team.', $headers);

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
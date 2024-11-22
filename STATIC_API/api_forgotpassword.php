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
    
                $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                    'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                mail($email, 'PROSE Care Account Recovery', 'Your recovery code is '.$verification_code.'<br>If you didn\'t request to reset your password please ignore this email<br><br>Thanks,<br>PROSE Care.', $headers);
                
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
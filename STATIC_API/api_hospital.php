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
                        $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                            'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();
                        mail($email, 'PROSE Care Hospital Registration', 'Dear '.$name.',<br>Thank you for joining PROSE Care.<br>Your verification code is '.$verification_code, $headers);
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
<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){
        $email_hash = $_REQUEST["data"][0];
        $password = password_hash($_REQUEST["data"][1],PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email_hash = '$email_hash'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                if(password_verify($_REQUEST["data"][1], $row['password'])){
                    echo '2';
                }else{
                    

                    $sql = "UPDATE users SET password='$password', is_forgot_password='false' WHERE email_hash='$email_hash'";
        
                    if($conn->query($sql) === TRUE) {
                        echo '1';
                    }else{
                        echo 'Oops. The database ran away :/';
                    }

                }

            }


        } else {
            echo '0';
        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){

        $AUTH = $_REQUEST["data"][0];

        $sql = "SELECT * FROM users WHERE email_hash = '$AUTH'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            
            $sql = "UPDATE users SET consent='true', verified='true' WHERE email_hash='$AUTH'";

            if($conn->query($sql) === TRUE) {
                echo 1;
            }else{
                echo 0;
            }
        } else {
            echo 2;
        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
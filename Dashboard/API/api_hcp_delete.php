<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $hcp_id = $_REQUEST["data"][0];
        $user_id = $_REQUEST["data"][1];
        

        $sql = "DELETE FROM hcp WHERE hcp_id='$hcp_id'";
    
        if ($conn->query($sql) === TRUE) {

            $sql = "DELETE FROM users WHERE user_id='$user_id'";

            if ($conn->query($sql) === TRUE) {
                
                $data = 1;

            }

        }
    }

    echo $data;    
        
    $conn->close();

?>
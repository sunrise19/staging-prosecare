<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $section = $_REQUEST["data"][0];
        $text = $_REQUEST["data"][1];
        $timestamp = $_REQUEST["data"][2];
        
        $user_id = $_SESSION["id"];

        $sql = "INSERT INTO comments (
            course, 
            user, 
            text,
            timestamp, 
            date_added, 
            time_added
            ) VALUES (
            '$section', 
            '$user_id', 
            '$text',
            '$timestamp',
            '$serverDate', 
            '$serverTime'
            )";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
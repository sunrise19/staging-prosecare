<?php

    session_start();

    include('../../STATIC_API/Config.php');
    
    $action = $conn -> real_escape_string($_REQUEST["action"]);
    $type = $conn -> real_escape_string($_REQUEST["type"]);

    $id = $_SESSION["id"];

    $sql = "INSERT INTO logs (user_id, log_action, log_type, log_date, log_time) VALUES ('$id', '$action', '$type', '$serverDate', '$serverTime')";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else{
        echo 0;
    }
  
    $conn->close();


?>
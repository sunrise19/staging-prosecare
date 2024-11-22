<?php

    session_start();

    include('Config.php');
    
    $user = $conn -> real_escape_string($_REQUEST["user"]);
    $action = $conn -> real_escape_string($_REQUEST["action"]);
    $type = $conn -> real_escape_string($_REQUEST["type"]);

    $monthArray = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $log_date = date("l") . ', ' . $monthArray[date("m") + 0] . ' ' . date("d") . ', ' . date("Y");
    $log_time = date("h:i:s a");
    $sql = "INSERT INTO logs (user_id, log_action, log_type, log_date, log_time) VALUES ('$user', '$action', '$type', '$log_date', '$log_time')";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else{
        echo 0;
    }
  
    $conn->close();

?>
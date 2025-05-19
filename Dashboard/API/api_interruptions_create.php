<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $type = $_REQUEST["data"][0];
        $missed = $_REQUEST["data"][1];
        $reason = $_REQUEST["data"][2];
        $change = $_REQUEST["data"][3];
        $date = $_REQUEST["data"][4];
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO interruptions (user_id, patient_id, date, type, missed, reason, treat_change, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$type', '$missed', '$reason', '$change', '$serverDate', '$serverTime')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
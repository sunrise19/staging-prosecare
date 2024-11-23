<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $description = $_REQUEST["data"][0];
        $hour = $_REQUEST["data"][1];
        $minute = $_REQUEST["data"][2];
        $ampm = $_REQUEST["data"][3];
        $time = $hour . ":" .$minute . " " .$ampm;
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO reminders (user_id, patient_id, description, time, date_added, time_added) VALUES ('$user_id', '$patient_id', '$description', '$time', '$serverDate', '$serverTime')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
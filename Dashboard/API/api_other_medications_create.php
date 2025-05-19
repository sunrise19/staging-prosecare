<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $drugs = $conn->real_escape_string($_REQUEST["data"][0]);
        $date = $_REQUEST["data"][1];
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO medications (user_id, patient_id, date, drugs, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$drugs', '$serverDate', '$serverTime')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
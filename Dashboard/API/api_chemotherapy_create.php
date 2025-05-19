<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $chemo = $_REQUEST["data"][0];
        $chemo_ind = $_REQUEST["data"][1];
        $chemo_drug = $_REQUEST["data"][2];
        $chemo_dose = $_REQUEST["data"][3];
        $chemo_freq = $_REQUEST["data"][4];
        $date = $_REQUEST["data"][5];
        
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO chemotherapy (user_id, patient_id, date, chemo, chemo_ind, chemo_drug, chemo_dose, chemo_freq, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$chemo', '$chemo_ind', '$chemo_drug', '$chemo_dose', '$chemo_freq', '$serverDate', '$serverTime')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
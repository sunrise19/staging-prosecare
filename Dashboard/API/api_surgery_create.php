<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $surgery = $_REQUEST["data"][0];
        $surgery_type = $_REQUEST["data"][1];
        $day = $_REQUEST["data"][2];
        $month = $_REQUEST["data"][3];
        $year = $_REQUEST["data"][4];
        $examination = $_REQUEST["data"][5];
        $surgery_pre = $_REQUEST["data"][6];
        $date = $_REQUEST["data"][7];
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO surgery (user_id, patient_id, date, surgery, surgery_type, day, month, year, examination, surgery_pre, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$surgery', '$surgery_type', '$day', '$month', '$year', '$examination', '$surgery_pre', '$serverDate', '$serverTime')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
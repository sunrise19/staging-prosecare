<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $weakness = $_REQUEST["data"][0];
        $irritation = $_REQUEST["data"][1];
        $itching = $_REQUEST["data"][2];
        $fever = $_REQUEST["data"][3];
        $nausea = $_REQUEST["data"][4];
        $vomiting = $_REQUEST["data"][5];
        $mouth_sores = $_REQUEST["data"][6];
        $dry_mouth = $_REQUEST["data"][7];
        $appetite_loss = $_REQUEST["data"][8];
        $diarrhea = $_REQUEST["data"][9];
        $constipation = $_REQUEST["data"][10];
        $pain_on_swallowing = $_REQUEST["data"][11];
        $taste_change = $_REQUEST["data"][12];
        $date = $_REQUEST["data"][13];
        
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO sideeffects (user_id, patient_id, date, weakness, irritation, itching, fever, nausea, vomiting, mouth_sores, dry_mouth, appetite_loss, diarrhea, constipation, pain_on_swallowing, taste_change, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$weakness', '$irritation', '$itching', '$fever', '$nausea', '$vomiting', '$mouth_sores', '$dry_mouth', '$appetite_loss', '$diarrhea', '$constipation', '$pain_on_swallowing', '$taste_change', '$serverDate', '$serverTime')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
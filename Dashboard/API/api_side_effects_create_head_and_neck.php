<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $hn_mouth_sore = $_REQUEST["data"][0];
        $hn_diff_in_swallowing = $_REQUEST["data"][1];
        $hn_loss_of_smell = $_REQUEST["data"][2];
        $hn_taste_changes = $_REQUEST["data"][3];
        $hn_dry_mouth = $_REQUEST["data"][4];
        $hn_mouth_cracking = $_REQUEST["data"][5];
        $hn_voice_change = $_REQUEST["data"][6];
        $hn_appetite_changes = $_REQUEST["data"][7];
        $hn_nausea = $_REQUEST["data"][8];
        $hn_vomiting = $_REQUEST["data"][9];
        $hn_skin_color_changes = $_REQUEST["data"][10];
        $hn_tired_or_weak = $_REQUEST["data"][11];
        $hn_weight = $_REQUEST["data"][12];
        $hn_note = $_REQUEST["data"][13];
        $hn_on_chemo = $_REQUEST["data"][14];
        $date = $_REQUEST["data"][15];
        $treatment = $_REQUEST["data"][16];
        $feeling = $_REQUEST["data"][17];
        
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO sideeffects (user_id, patient_id, date, hn_mouth_sore, hn_diff_in_swallowing, hn_loss_of_smell, hn_taste_changes, hn_dry_mouth, hn_mouth_cracking, hn_voice_change, hn_appetite_changes, hn_nausea, hn_vomiting, hn_skin_color_changes, hn_tired_or_weak, hn_weight, hn_note, hn_on_chemo, date_added, time_added, treatment, feeling) VALUES ('$user_id', '$patient_id', '$date', '$hn_mouth_sore', '$hn_diff_in_swallowing', '$hn_loss_of_smell', '$hn_taste_changes', '$hn_dry_mouth', '$hn_mouth_cracking', '$hn_voice_change', '$hn_appetite_changes', '$hn_nausea', '$hn_vomiting', '$hn_skin_color_changes', '$hn_tired_or_weak', '$hn_weight', '$hn_note', '$hn_on_chemo', '$serverDate', '$serverTime', '$treatment', '$feeling')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
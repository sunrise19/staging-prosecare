<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $fp_loose_stool = $_REQUEST["data"][0];
        $fp_nausea = $_REQUEST["data"][1];
        $fp_vomiting = $_REQUEST["data"][2];
        $fp_skin_color = $_REQUEST["data"][3];
        $fp_anus_changes = $_REQUEST["data"][4];
        $fp_blood_in_urine = $_REQUEST["data"][5];
        $fp_diff_urinating = $_REQUEST["data"][6];
        $fp_painful_urine = $_REQUEST["data"][7];
        $fp_feel_like_urine = $_REQUEST["data"][8];
        $fp_urine_control = $_REQUEST["data"][9];
        $fp_urine_rate = $_REQUEST["data"][10];
        $fp_vag_dry = $_REQUEST["data"][11];
        $fp_stool_leak = $_REQUEST["data"][12];
        $fp_tired_or_weak = $_REQUEST["data"][13];
        $fp_weight = $_REQUEST["data"][14];
        $fp_note = $conn->real_escape_string($_REQUEST["data"][15]);
        $fp_on_chemo = $_REQUEST["data"][16];
        $date = $_REQUEST["data"][17];
        $treatment = $_REQUEST["data"][18];
        $feeling = $_REQUEST["data"][19];
        
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO sideeffects (user_id, patient_id, date, fp_loose_stool, fp_nausea, fp_vomiting, fp_skin_color, fp_anus_changes, fp_blood_in_urine, fp_diff_urinating, fp_painful_urine, fp_feel_like_urine, fp_urine_control, fp_urine_rate, fp_vag_dry, fp_stool_leak, fp_tired_or_weak, fp_weight, fp_note, fp_on_chemo, date_added, time_added, treatment, feeling) VALUES ('$user_id', '$patient_id', '$date', '$fp_loose_stool', '$fp_nausea', '$fp_vomiting', '$fp_skin_color', '$fp_anus_changes', '$fp_blood_in_urine', '$fp_diff_urinating', '$fp_painful_urine', '$fp_feel_like_urine', '$fp_urine_control', '$fp_urine_rate', '$fp_vag_dry', '$fp_stool_leak', '$fp_tired_or_weak', '$fp_weight', '$fp_note', '$fp_on_chemo', '$serverDate', '$serverTime', '$treatment', '$feeling')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
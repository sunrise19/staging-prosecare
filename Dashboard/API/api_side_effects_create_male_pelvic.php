<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $mp_blood_in_urine = $_REQUEST["data"][0];
        $mp_diff_urinating = $_REQUEST["data"][1];
        $mp_painful_urine = $_REQUEST["data"][2];
        $mp_urine_rate = $_REQUEST["data"][3];
        $mp_feel_like_urine = $_REQUEST["data"][4];
        $mp_urine_control = $_REQUEST["data"][5];
        $mp_nausea = $_REQUEST["data"][6];
        $mp_vomiting = $_REQUEST["data"][7];
        $mp_loose_stool = $_REQUEST["data"][8];
        $mp_anus_changes = $_REQUEST["data"][9];
        $mp_blood_from_anus = $_REQUEST["data"][10];
        $mp_diff_stooling = $_REQUEST["data"][11];
        $mp_belly_tight = $_REQUEST["data"][12];
        $mp_stool_leak = $_REQUEST["data"][13];
        $mp_erection = $_REQUEST["data"][14];
        $mp_diff_in_releases = $_REQUEST["data"][15];
        $mp_decreased_desire = $_REQUEST["data"][16];
        $mp_painful_sex = $_REQUEST["data"][17];
        $mp_tired_or_weak = $_REQUEST["data"][18];
        $mp_weight = $_REQUEST["data"][19];
        $mp_note = $_REQUEST["data"][20];
        $mp_on_chemo = $_REQUEST["data"][21];
        $date = $_REQUEST["data"][22];
        $treatment = $_REQUEST["data"][23];
        $feeling = $_REQUEST["data"][24];

        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO sideeffects (user_id, patient_id, date, 
        mp_blood_in_urine,
        mp_diff_urinating,
        mp_painful_urine,
        mp_urine_rate,
        mp_feel_like_urine,
        mp_urine_control,
        mp_nausea,
        mp_vomiting,
        mp_loose_stool,
        mp_anus_changes,
        mp_blood_from_anus,
        mp_diff_stooling,
        mp_belly_tight,
        mp_stool_leak,
        mp_erection,
        mp_diff_in_releases,
        mp_decreased_desire,
        mp_painful_sex,
        mp_tired_or_weak,
        mp_weight,
        mp_note,
        mp_on_chemo,
        date_added, 
        time_added, 
        treatment, 
        feeling) VALUES ('$user_id', '$patient_id', '$date', 
        '$mp_blood_in_urine',
        '$mp_diff_urinating',
        '$mp_painful_urine',
        '$mp_urine_rate',
        '$mp_feel_like_urine',
        '$mp_urine_control',
        '$mp_nausea',
        '$mp_vomiting',
        '$mp_loose_stool',
        '$mp_anus_changes',
        '$mp_blood_from_anus',
        '$mp_diff_stooling',
        '$mp_belly_tight',
        '$mp_stool_leak',
        '$mp_erection',
        '$mp_diff_in_releases',
        '$mp_decreased_desire',
        '$mp_painful_sex',
        '$mp_tired_or_weak',
        '$mp_weight',
        '$mp_note',
        '$mp_on_chemo',
        '$serverDate', 
        '$serverTime',
        '$treatment', 
        '$feeling')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
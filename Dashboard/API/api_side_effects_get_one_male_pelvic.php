<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    $sideeffects_id = $_REQUEST["id"];
    

    if($_SESSION['type'] != 'patient' && $_SESSION['type'] != 'caregiver'){
        $user_id = $_REQUEST['user'];
        $patient_id = $_REQUEST['patient_id'];
    }
    
    $sql = "SELECT * FROM sideeffects WHERE user_id = '$user_id' AND patient_id = '$patient_id' AND sideeffects_id = '$sideeffects_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = [
                        $row['sideeffects_id'], 
                        $row['date'], 
                        $row['date_added'],
                        $row['time_added'],
                        $row['mp_blood_in_urine'], 
                        $row['mp_diff_urinating'], 
                        $row['mp_painful_urine'],
                        $row['mp_urine_rate'],
                        $row['mp_feel_like_urine'],
                        $row['mp_urine_control'],
                        $row['mp_nausea'],
                        $row['mp_vomiting'],
                        $row['mp_loose_stool'],
                        $row['mp_anus_changes'],
                        $row['mp_blood_from_anus'],
                        $row['mp_diff_stooling'],
                        $row['mp_belly_tight'],
                        $row['mp_stool_leak'],
                        $row['mp_erection'],
                        $row['mp_diff_in_releases'],
                        $row['mp_decreased_desire'],
                        $row['mp_painful_sex'],
                        $row['mp_tired_or_weak'],
                        $row['mp_weight'],
                        $row['mp_note'],
                        $row['mp_on_chemo'],
                        $row['treatment']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
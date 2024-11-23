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
                        $row['fp_loose_stool'], 
                        $row['fp_nausea'], 
                        $row['fp_vomiting'],
                        $row['fp_skin_color'],
                        $row['fp_anus_changes'],
                        $row['fp_blood_in_urine'],
                        $row['fp_diff_urinating'],
                        $row['fp_painful_urine'],
                        $row['fp_feel_like_urine'],
                        $row['fp_urine_control'],
                        $row['fp_urine_rate'],
                        $row['fp_vag_dry'],
                        $row['fp_stool_leak'],
                        $row['fp_tired_or_weak'],
                        $row['fp_weight'],
                        $row['fp_note'],
                        $row['fp_on_chemo'],
                        $row['treatment']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
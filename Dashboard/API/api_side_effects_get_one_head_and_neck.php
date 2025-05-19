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
                        $row['hn_mouth_sore'], 
                        $row['hn_diff_in_swallowing'], 
                        $row['hn_loss_of_smell'],
                        $row['hn_taste_changes'],
                        $row['hn_dry_mouth'],
                        $row['hn_mouth_cracking'],
                        $row['hn_voice_change'],
                        $row['hn_appetite_changes'],
                        $row['hn_nausea'],
                        $row['hn_vomiting'],
                        $row['hn_skin_color_changes'],
                        $row['hn_tired_or_weak'],
                        $row['hn_weight'],
                        $row['hn_note'],
                        $row['hn_on_chemo'],
                        $row['treatment']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
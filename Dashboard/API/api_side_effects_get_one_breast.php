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
                        $row['b_hair_loss'], 
                        $row['b_arm_swelling'], 
                        $row['b_swallowing_difficulty'],
                        $row['b_chest_pain'],
                        $row['b_breast_swelling'],
                        $row['b_breast_pain'],
                        $row['b_sensation_loss'],
                        $row['b_skin_color'],
                        $row['b_tired_or_weak'],
                        $row['b_weight'],
                        $row['b_hb'],
                        $row['b_pcv'],
                        $row['b_anc'],
                        $row['b_platelet'],
                        $row['b_note'],
                        $row['b_wbc'],
                        $row['treatment']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
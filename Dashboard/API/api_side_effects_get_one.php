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
                        $row['weakness'], 
                        $row['irritation'], 
                        $row['itching'],
                        $row['fever'],
                        $row['nausea'],
                        $row['vomiting'],
                        $row['mouth_sores'],
                        $row['dry_mouth'],
                        $row['appetite_loss'],
                        $row['diarrhea'],
                        $row['constipation'],
                        $row['pain_on_swallowing'],
                        $row['taste_change'],
                        $row['date_added'],
                        $row['time_added']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
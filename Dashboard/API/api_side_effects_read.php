<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];

    if($_SESSION['type'] != 'patient' && $_SESSION['type'] != 'caregiver'){
        $user_id = $_REQUEST['id'];
        $patient_id = $_REQUEST['patient_id'];
    }
    
    $sql = "SELECT * FROM sideeffects WHERE user_id = '$user_id' AND patient_id = '$patient_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        $data = [];

        while($row = $result->fetch_assoc()) {
            array_push($data, [$row['sideeffects_id'], $row['date']]);
        }

        $data = json_encode($data);

    }

    echo $data;

    $conn->close();

?>
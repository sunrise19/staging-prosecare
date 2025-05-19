<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $id = $_REQUEST['id'];
    $type = $_REQUEST['type'];
    $hcp_id = $_SESSION["hcp_id"];
    $patient_id = $_SESSION["patient_id"];

    $suffix = " hcp_id='$hcp_id'";
    
    if($_SESSION['type'] == 'patient'){
        $suffix = " patient_id='$patient_id'";
    }

    $sql = "UPDATE appointments SET status='$type' WHERE appointment_id='$id' AND" . $suffix;
    
    if($conn->query($sql) === TRUE) {
        $data =  1;
    }

    echo $data;

    $conn->close();

?>
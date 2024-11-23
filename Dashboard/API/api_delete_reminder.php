<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $id = $_REQUEST["id"];
    
    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];

    $sql = "DELETE FROM reminders WHERE reminder_id='$id'  AND user_id='$user_id' AND patient_id='$patient_id'";

    if($conn->query($sql) === TRUE) {
        $data =  1;
    }else{
        $data = $conn->error;
    }
    
    echo $data;

    $conn->close();

?>
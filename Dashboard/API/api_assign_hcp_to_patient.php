
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $HCP_ID = $_REQUEST["HCP_ID"];
    $PatientUserID = $_REQUEST["PatientUserID"];

    $sql = "UPDATE patients SET 
            assigned_hcp='$HCP_ID' 
            WHERE user_id='$PatientUserID'";

    if($conn->query($sql) === TRUE) {
        $data = 1;
    } else {
        $data = $conn->error;
    }


    echo $data;

?>
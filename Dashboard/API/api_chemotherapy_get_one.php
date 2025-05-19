<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    $chemotherapy_id = $_REQUEST["id"];
    
    $sql = "SELECT * FROM chemotherapy WHERE user_id = '$user_id' AND patient_id = '$patient_id' AND chemotherapy_id = '$chemotherapy_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = [
                        $row['chemotherapy_id'], 
                        $row['date'], 
                        $row['date_added'],
                        $row['time_added'],
                        $row['chemo'], 
                        $row['chemo_ind'], 
                        $row['chemo_drug'],
                        $row['chemo_dose'],
                        $row['chemo_freq'] 
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
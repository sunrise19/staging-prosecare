<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    $medication_id = $_REQUEST["id"];
    
    $sql = "SELECT * FROM medications WHERE user_id = '$user_id' AND patient_id = '$patient_id' AND medication_id = '$medication_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = [
                        $row['medication_id'], 
                        $row['date'], 
                        $row['date_added'],
                        $row['time_added'],
                        $row['drugs']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    $supportive_care_id = $_REQUEST["id"];
    
    $sql = "SELECT * FROM supportive_care WHERE user_id = '$user_id' AND patient_id = '$patient_id' AND supportive_care_id = '$supportive_care_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = [
                        $row['supportive_care_id'], 
                        $row['date'], 
                        $row['date_added'],
                        $row['time_added'],
                        $row['hospital_admission'], 
                        $row['day'],
                        $row['month'],
                        $row['year'],
                        $row['due_to_side_effects'],
                        $row['dietary_support'],
                        $row['gastronomy'],
                        $row['PNT'],
                        $row['high_protein_diet'],
                        $row['dental_care'],
                        $row['tips'],
                        $row['tube']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
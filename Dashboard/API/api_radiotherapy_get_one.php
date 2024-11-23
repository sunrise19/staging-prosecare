<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    $radiotherapy_id = $_REQUEST["id"];
    
    $sql = "SELECT * FROM radiotherapy WHERE user_id = '$user_id' AND patient_id = '$patient_id' AND radiotherapy_id = '$radiotherapy_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = [
                        $row['radiotherapy_id'], 
                        $row['date'], 
                        $row['date_added'],
                        $row['time_added'],
                        $row['target_site'], 
                        $row['field_type'], 
                        $row['number_of_fields'],
                        $row['size_of_fields'],
                        $row['total_dose'],
                        $row['number_of_fractions'],
                        $row['size_of_fractions'],
                        $row['number_of_weeks'],
                        $row['fractional_regimen'],
                        $row['conventional'],
                        $row['hypofractionation'],
                        $row['hyperfractionation'],
                        $row['other'],
                        $row['intent'],
                        $row['dose']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    // echo $data . $radiotherapy_id . $conn->error;
    echo $data;

    $conn->close();

?>
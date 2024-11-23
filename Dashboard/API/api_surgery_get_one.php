<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    $surgery_id = $_REQUEST["id"];
    
    $sql = "SELECT * FROM surgery WHERE user_id = '$user_id' AND patient_id = '$patient_id' AND surgery_id = '$surgery_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = [
                        $row['surgery_id'], 
                        $row['date'], 
                        $row['date_added'],
                        $row['time_added'],
                        $row['surgery'], 
                        $row['surgery_type'], 
                        $row['day'],
                        $row['month'],
                        $row['year'],
                        $row['examination'],
                        $row['surgery_pre'] 
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
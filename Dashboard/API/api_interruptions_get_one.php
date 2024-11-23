<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    $interruption_id = $_REQUEST["id"];
    
    $sql = "SELECT * FROM interruptions WHERE user_id = '$user_id' AND patient_id = '$patient_id' AND interruption_id = '$interruption_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = [
                        $row['interruption_id'], 
                        $row['date'], 
                        $row['date_added'],
                        $row['time_added'],
                        $row['type'], 
                        $row['missed'], 
                        $row['reason'],
                        $row['treat_change']
                    ];
        }

        $data = json_encode($data);

    }

    // $conn->error;

    echo $data;

    $conn->close();

?>
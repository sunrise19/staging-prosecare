<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset(
            $_POST['hcp_id'], 
            $_POST['agenda'], 
            $_POST['date'], 
            $_POST['time']
            )
        ) {
            
            // Sanitize and validate the input data if needed
            $hcp_id = $_POST['hcp_id']; 
            $agenda = $_POST['agenda']; 
            $date = $_POST['date']; 
            $time = $_POST['time']; 
            $patient_id = $_SESSION["patient_id"];

            $sql = "INSERT INTO appointments (hcp_id, patient_id, agenda, status, date, time, duration) VALUES ('$hcp_id', '$patient_id', '$agenda', 'Pending', '$date', '$time', '')";

            if($conn->query($sql) === TRUE) {
                $data = 1;
            }else{
                $data = $conn->error;
            }
            
        } else {
            // Required fields are missing in the request
            http_response_code(400); // Bad request
            $data = "Missing required fields";
        }
    } else {
        // Not a POST request
        http_response_code(405); 
        $data = "Method Not Allowed";
    }

    echo $data;

    $conn->close();

?>
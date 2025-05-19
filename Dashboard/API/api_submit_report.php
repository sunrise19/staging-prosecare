<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if($_SESSION['type'] != 'hcp'){
        echo 0;
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset(
            $_POST['id'], 
            $_POST['hcp_id'], 
            $_POST['patient_id'], 
            $_POST['patient_complaint'], 
            $_POST['observations'], 
            $_POST['diagnosis'], 
            $_POST['recommended_tests'], 
            $_POST['prescription'])
        ) {
            
            // Sanitize and validate the input data if needed
            $id = $_POST['id'];
            $hcp_id = $_POST['hcp_id'];
            $patient_id = $_POST['patient_id'];
            $patient_complaint = $_POST['patient_complaint'];
            $observations = $_POST['observations'];
            $diagnosis = $_POST['diagnosis'];
            $recommended_tests = $_POST['recommended_tests'];
            // Decode prescriptions if it was JSON stringified before sending
            // $prescription = json_decode($_POST['prescription'], true);
            $prescription = $_POST['prescription'];

            $sql = "INSERT INTO reports (
                appointment_id,
                hcp_id,
                patient_id,
                date,
                time,
                patient_complaint, 
                observations, 
                diagnosis, 
                recommended_tests, 
                prescription
                ) 
                VALUES (
                    '$id',
                    '$hcp_id',
                    '$patient_id',
                    '$serverDate',
                    '$serverTime',
                    '$patient_complaint',
                    '$observations',
                    '$diagnosis',
                    '$recommended_tests',
                    '$prescription'
                )";

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
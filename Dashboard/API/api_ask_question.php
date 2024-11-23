<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if($_SESSION['type'] != 'patient'){
        echo 0;
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset(
            $_POST['side_effect'], 
            $_POST['questions'])
        ) {
            
            // Sanitize and validate the input data if needed
            $id = $_SESSION['id'];
            $side_effect = $_POST['side_effect'];
            $questions = $_POST['questions'];

            $sql = "INSERT INTO questions (
                user_id,
                side_effect,
                questions,
                date,
                time
                ) 
                VALUES (
                    '$id',
                    '$side_effect',
                    '$questions',
                    '$serverDate',
                    '$serverTime'
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
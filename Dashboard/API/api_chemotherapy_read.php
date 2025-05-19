<?php

    include('../../STATIC_API/Config.php');

    $user_id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];
    
    $sql = "SELECT * FROM chemotherapy WHERE user_id = '$user_id' AND patient_id = '$patient_id'";

    $result = $conn->query($sql);

    $data = 0;

    if ($result->num_rows > 0) {

        $data = [];

        while($row = $result->fetch_assoc()) {
            array_push($data, [$row['chemotherapy_id'], $row['date']]);
        }

        $data = json_encode($data);

    }

    echo $data;

    $conn->close();

?>
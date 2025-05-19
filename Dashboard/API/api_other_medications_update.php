<?php

    include('../../STATIC_API/Config.php');

    $data = '0';

    if(isset($_REQUEST["data"])){
        $drugs = $conn->real_escape_string($_REQUEST["data"][0]);
        $date = $_REQUEST["data"][1];
        $id = $_REQUEST["data"][2];

        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "SELECT * FROM medications WHERE medication_id='$id' AND user_id='$user_id' AND patient_id='$patient_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE medications SET drugs='$drugs' WHERE medication_id='$id'";
            
            if($drugs == "[]" || $drugs == ""){
                $sql = "DELETE FROM medications WHERE medication_id='$id'";
            }
            
            if($conn->query($sql) === TRUE) {
                $data =  1;
            }else{
                $data = $conn->error;
            }

        }else{
            
            $sql = "INSERT INTO medications (user_id, patient_id, date, drugs, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$drugs', '$serverDate', '$serverTime')";

            if($conn->query($sql) === TRUE) {
                $data =  1;
            }else{
                $data = $conn->error;
            }

        }

        
    }

    echo $data;

    $conn->close();

?>
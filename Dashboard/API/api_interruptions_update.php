<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $type = $_REQUEST["data"][0];
        $missed = $_REQUEST["data"][1];
        $reason = $_REQUEST["data"][2];
        $change = $_REQUEST["data"][3];
        $date = $_REQUEST["data"][4];
        $id = $_REQUEST["data"][5];

        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "SELECT * FROM interruptions WHERE interruption_id='$id' AND user_id='$user_id' AND patient_id='$patient_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE interruptions SET missed='$missed', reason='$reason', treat_change='$change'  WHERE interruption_id='$id'";
            
            if($conn->query($sql) === TRUE) {
                $data =  1;
            }else{
                $data = $conn->error;
            }

        }else{
            
            $sql = "INSERT INTO interruptions (user_id, patient_id, date, type, missed, reason, treat_change, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$type', '$missed', '$reason', '$change', '$serverDate', '$serverTime')";

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
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $description = $_REQUEST["data"][0];
        $hour = $_REQUEST["data"][1];
        $minute = $_REQUEST["data"][2];
        $ampm = $_REQUEST["data"][3];
        $time = $hour . ":" .$minute . " " .$ampm;
        $id = $_REQUEST["data"][4];

        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "SELECT * FROM reminders WHERE reminder_id='$id' AND user_id='$user_id' AND patient_id='$patient_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE reminders SET description='$description', time='$time' WHERE reminder_id='$id'";
            
            if($conn->query($sql) === TRUE) {
                $data =  1;
            }

        }else{
            
            $sql = "INSERT INTO reminders (user_id, patient_id, description, time, date_added, time_added) VALUES ('$user_id', '$patient_id', '$description', '$time', '$serverDate', '$serverTime')";

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
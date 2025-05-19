<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $surgery = $_REQUEST["data"][0];
        $surgery_type = $_REQUEST["data"][1];
        $day = $_REQUEST["data"][2];
        $month = $_REQUEST["data"][3];
        $year = $_REQUEST["data"][4];
        $examination = $_REQUEST["data"][5];
        $surgery_pre = $_REQUEST["data"][6];
        $date = $_REQUEST["data"][7];
        $id = $_REQUEST["data"][8];

        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "SELECT * FROM surgery WHERE surgery_id='$id' AND user_id='$user_id' AND patient_id='$patient_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE surgery SET surgery='$surgery', surgery_type='$surgery_type', day='$day', month='$month', year='$year', examination='$examination', surgery_pre='$surgery_pre'  WHERE surgery_id='$id'";
            
            if($conn->query($sql) === TRUE) {
                $data =  1;
            }

        }else{
            
            $sql = "INSERT INTO surgery (user_id, patient_id, date, surgery, surgery_type, day, month, year, examination, surgery_pre, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$surgery', '$surgery_type', '$day', '$month', '$year', '$examination', '$surgery_pre', '$serverDate', '$serverTime')";

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
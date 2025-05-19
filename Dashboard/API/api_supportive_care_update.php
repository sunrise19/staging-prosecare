<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $hospital_admission = $_REQUEST["data"][0];
        $day = $_REQUEST["data"][1];
        $month = $_REQUEST["data"][2];
        $year = $_REQUEST["data"][3];
        $due_to_side_effects = $_REQUEST["data"][4];
        $dietary_support = $_REQUEST["data"][5];
        $gastronomy = $_REQUEST["data"][6];
        $PNT = $_REQUEST["data"][7];
        $high_protein_diet = $_REQUEST["data"][8];
        $dental_care = $_REQUEST["data"][9];
        $tips = $_REQUEST["data"][10];
        $tube = $_REQUEST["data"][11];
        $date = $_REQUEST["data"][12];
        $id = $_REQUEST["data"][13];

        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "SELECT * FROM supportive_care WHERE supportive_care_id='$id' AND user_id='$user_id' AND patient_id='$patient_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE supportive_care SET hospital_admission='$hospital_admission', day='$day', month='$month', year='$year', due_to_side_effects='$due_to_side_effects', dietary_support='$dietary_support', gastronomy='$gastronomy', PNT='$PNT', high_protein_diet='$high_protein_diet', dental_care='$dental_care', tips='$tips', tube='$tube' WHERE supportive_care_id='$id'";
            
            if($conn->query($sql) === TRUE) {
                $data =  1;
            }

        }else{
            
            $sql = "INSERT INTO supportive_care (user_id, patient_id, date, hospital_admission, day, month, year, due_to_side_effects, dietary_support, gastronomy, PNT, high_protein_diet, dental_care, tips, tube, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$hospital_admission', '$day', '$month', '$year', '$due_to_side_effects', '$dietary_support', '$gastronomy', '$PNT', '$high_protein_diet', '$dental_care', '$tips', '$tube', '$serverDate', '$serverTime')";

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
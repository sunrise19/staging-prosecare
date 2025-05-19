<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $target_site = $_REQUEST["data"][0];
        $field_type = $_REQUEST["data"][1];
        $number_of_fields = $_REQUEST["data"][2];
        $size_of_fields = $_REQUEST["data"][3];
        $total_dose = $_REQUEST["data"][4];
        $number_of_fractions = $_REQUEST["data"][5];
        $size_of_fractions = $_REQUEST["data"][6];
        $number_of_weeks = $_REQUEST["data"][7];
        $fractional_regimen = $_REQUEST["data"][8];
        $conventional = $_REQUEST["data"][9];
        $hypofractionation = $_REQUEST["data"][10];
        $hyperfractionation = $_REQUEST["data"][11];
        $other = $_REQUEST["data"][12];
        $intent = $_REQUEST["data"][13];
        $dose = $_REQUEST["data"][14];
        $date = $_REQUEST["data"][15];
        
        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "INSERT INTO radiotherapy (user_id, patient_id, date, target_site, field_type, number_of_fields, size_of_fields, total_dose, number_of_fractions, size_of_fractions, number_of_weeks, fractional_regimen, conventional, hypofractionation, hyperfractionation, other, intent, dose, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$target_site', '$field_type', '$number_of_fields', '$size_of_fields', '$total_dose', '$number_of_fractions', '$size_of_fractions', '$number_of_weeks', '$fractional_regimen', '$conventional', '$hypofractionation', '$hyperfractionation', '$other', '$intent', '$dose', '$serverDate', '$serverTime')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
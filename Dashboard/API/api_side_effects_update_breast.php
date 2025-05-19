<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $b_hair_loss = $_REQUEST["data"][0];
        $b_arm_swelling = $_REQUEST["data"][1];
        $b_swallowing_difficulty = $_REQUEST["data"][2];
        $b_chest_pain = $_REQUEST["data"][3];
        $b_breast_swelling = $_REQUEST["data"][4];
        $b_breast_pain = $_REQUEST["data"][5];
        $b_sensation_loss = $_REQUEST["data"][6];
        $b_skin_color = $_REQUEST["data"][7];
        $b_tired_or_weak = $_REQUEST["data"][8];
        $b_weight = $_REQUEST["data"][9];
        $b_hb = $_REQUEST["data"][10];
        $b_pcv = $_REQUEST["data"][11];
        $b_anc = $_REQUEST["data"][12];
        $b_platelet = $_REQUEST["data"][13];
        $b_note = $conn->real_escape_string($_REQUEST["data"][14]);
        $b_wbc = $_REQUEST["data"][15];
        $date = $_REQUEST["data"][16];
        $id = $_REQUEST["data"][17];
        $treatment = $_REQUEST["data"][18];

        $user_id = $_SESSION["id"];
        $patient_id = $_SESSION["patient_id"];

        $sql = "SELECT * FROM sideeffects WHERE sideeffects_id='$id' AND user_id='$user_id' AND patient_id='$patient_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE sideeffects SET 
            b_hair_loss='$b_hair_loss', 
            b_arm_swelling='$b_arm_swelling', 
            b_swallowing_difficulty='$b_swallowing_difficulty', 
            b_chest_pain='$b_chest_pain', 
            b_breast_swelling='$b_breast_swelling', 
            b_breast_pain='$b_breast_pain', 
            b_sensation_loss='$b_sensation_loss', 
            b_skin_color='$b_skin_color', 
            b_tired_or_weak='$b_tired_or_weak', 
            b_weight='$b_weight', 
            b_hb='$b_hb', 
            b_pcv='$b_pcv', 
            b_anc='$b_anc',
            b_platelet='$b_platelet',
            b_note='$b_note',
            b_wbc = '$b_wbc',
            treatment = '$treatment'
            WHERE sideeffects_id='$id'";
            
            if($conn->query($sql) === TRUE) {
                $data =  1;
            }else{
                $data = $conn->error;
            }

        }else{
            
            $sql = "INSERT INTO sideeffects (user_id, patient_id, date, b_hair_loss, b_arm_swelling, b_swallowing_difficulty, b_chest_pain, b_breast_swelling, b_breast_pain, b_sensation_loss, b_skin_color, b_tired_or_weak, b_weight, b_hb, b_pcv, b_anc, b_platelet, b_note, b_wbc, date_added, time_added) VALUES ('$user_id', '$patient_id', '$date', '$b_hair_loss', '$b_arm_swelling', '$b_swallowing_difficulty', '$b_chest_pain', '$b_breast_swelling', '$b_breast_pain', '$b_sensation_loss', '$b_skin_color', '$b_tired_or_weak', '$b_weight', '$b_hb', '$b_pcv', '$b_anc', '$b_platelet', '$b_note', '$b_wbc', '$serverDate', '$serverTime')";

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
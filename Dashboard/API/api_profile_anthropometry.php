
<?php

include('../../STATIC_API/Config.php');

$data = 0;

if(isset($_REQUEST["data"])){

    $id = $_SESSION["id"];
    $patient_id = $_SESSION["patient_id"];

    $height = $_REQUEST["data"][0];
    $weight = $_REQUEST["data"][1];
    $bmi = $_REQUEST["data"][2];
    $waist = $_REQUEST["data"][3];
    $head = $_REQUEST["data"][4];


    $sql = "UPDATE patients SET 
            height='$height', 
            weight='$weight',  
            bmi='$bmi',  
            waist='$waist', 
            head='$head' 
            WHERE user_id='$id'";

    if($conn->query($sql) === TRUE) {
        $data = 1;
    } else {

    }
      


}


echo $data;

$conn->close();

?>
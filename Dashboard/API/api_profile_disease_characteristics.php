 
<?php

include('../../STATIC_API/Config.php');

$data = 0;

if(isset($_REQUEST["data"])){
    
    $isEditing = $_REQUEST['editing'] == 'true' ? true : false;

    $id = $isEditing ? $_REQUEST['user_id'] : $_SESSION["id"];

    $age_when_diagnosed = $_REQUEST["data"][0];
    $initial_cancer = $_REQUEST["data"][1];
    $histology = $_REQUEST["data"][2];
    $cancer_grade = $_REQUEST["data"][3];
    $cancer_stage = $_REQUEST["data"][4];
    $cancer = $_REQUEST["data"][5];
    $comorbidity = $_REQUEST["data"][6];

    $sql = "UPDATE patients SET 
            age_when_diagnosed='$age_when_diagnosed', 
            initial_cancer='$initial_cancer',  
            histology='$histology',  
            cancer_grade='$cancer_grade', 
            cancer_stage='$cancer_stage', 
            cancer = '$cancer',
            comorbidity='$comorbidity' 
            WHERE user_id='$id'";

    if($conn->query($sql) === TRUE) {
        $data = 1;
    } else {

    }
      


}


echo $data;

$conn->close();

?>
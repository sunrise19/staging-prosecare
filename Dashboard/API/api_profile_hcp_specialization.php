
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $isEditing = $_REQUEST['editing'] == 'true' ? true : false;

        $id = $isEditing ? $_REQUEST['user_id'] : $_SESSION["id"];

        $cadre = $_REQUEST["data"][0];
        $hospital = $_REQUEST["data"][1];
        $practicing_mdcn_expiry = $_REQUEST["data"][2];
        $mdcn_registration_expiry = $_REQUEST["data"][3];
        $fellowship_license_expiry = $_REQUEST["data"][4];

        $_SESSION["email"] = $email;

        $sql = "UPDATE hcp SET 
        specialty='$cadre', 
        hospital='$hospital', 
        practicing_mdcn_expiry='$practicing_mdcn_expiry', 
        mdcn_registration_expiry='$mdcn_registration_expiry', 
        fellowship_license_expiry='$fellowship_license_expiry'
        WHERE user_id='$id'";
        
        if($conn->query($sql) === TRUE) {
            $data = 1;   
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
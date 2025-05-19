
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $id = $_SESSION["id"];

        $hospital = $_REQUEST["data"][0];

        $_SESSION["email"] = $email;

        $sql = "UPDATE hcp SET hospital_id='$hospital' WHERE user_id='$id'";
        
        if($conn->query($sql) === TRUE) {
            
            $data = 1;
            
        }
        
    }

    echo $data;

    $conn->close();

?>
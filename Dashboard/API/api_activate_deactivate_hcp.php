
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $id = $_REQUEST["id"];
    $type = $_REQUEST["type"] == 'Deactivate' ? 'false' : 'true';

    $sql = "UPDATE users SET 
            active='$type' 
            WHERE user_id='$id'";

    if($conn->query($sql) === TRUE) {
        $data = 1;
    } else {
        $data = $conn->error;
    }


    echo $data;

?>
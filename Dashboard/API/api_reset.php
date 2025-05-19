
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $id = $_REQUEST["id"];
    $new = password_hash('Password@123', PASSWORD_DEFAULT);

    $sql = "UPDATE users SET 
            password='$new' 
            WHERE user_id='$id'";

    if($conn->query($sql) === TRUE) {
        $data = 1;
    } else {
        $data = $conn->error;
    }

    echo $data;

?>
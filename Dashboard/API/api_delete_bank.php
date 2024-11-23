<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $id = $_REQUEST["id"];
    
    $user_id = $_SESSION["id"];

    $sql = "DELETE FROM banks WHERE bank_id='$id'  AND user_id='$user_id'";

    if($conn->query($sql) === TRUE) {
        $data =  1;
    }else{
        $data = $conn->error;
    }
    
    echo $data;

    $conn->close();

?>
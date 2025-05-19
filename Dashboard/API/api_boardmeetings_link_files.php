<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $name = $_REQUEST["data"][0];
        $size = $_REQUEST["data"][1];
        $link = $_REQUEST["data"][2];
        $access_id = $_REQUEST["data"][3].$_REQUEST["data"][3];

        $sql = "INSERT INTO files (name, size, link, access_id) VALUES ('$name', '$size', '$link', '$access_id')";

        if($conn->query($sql) === TRUE) {
            $data =  1;
        }
        
    }

    echo $data;

    $conn->close();

?>
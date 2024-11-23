<?php

    include('../../STATIC_API/Config.php');

    if(isset($_REQUEST["data"])){
        
        $link = $_REQUEST["data"][0];
        $id = $_REQUEST["data"][1];

        $sql = "UPDATE board_meetings SET link='$link' WHERE board_meeting_id='$id'";

        if($conn->query($sql) === TRUE) {
            echo '1';
        }else{
            echo '0';
        }
        
    }else{
        echo '0';
    }

    $conn->close();

?>
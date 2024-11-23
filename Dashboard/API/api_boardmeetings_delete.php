<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $id = $_REQUEST["data"][0];

        $sql = "DELETE FROM board_meetings WHERE board_meeting_id='$id'";
    
        if ($conn->query($sql) === TRUE) {
            $data = 1;
        }else{
            $data = 'epic fail';
        }
    }

    echo $data;    
        
    $conn->close();

?>
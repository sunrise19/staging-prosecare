<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $comment_id = $_REQUEST["id"];

    $user_id = $_SESSION["id"];

    $sql = "SELECT * FROM comments WHERE comment_id='$comment_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            if($row['user'] == $user_id){

                $sql = "DELETE FROM comments WHERE comment_id='$comment_id'";

                if ($conn->query($sql) === TRUE) {
                    $data = 1;
                }

            }

        }

    }

    echo $data;    
        
    $conn->close();

?>
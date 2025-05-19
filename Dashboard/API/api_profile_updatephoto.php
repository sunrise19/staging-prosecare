<?php

    include('../../STATIC_API/Config.php');

    if(isset($_REQUEST["data"])){
        
        $photo = $_REQUEST["data"][0];
        $user_id = $_SESSION["id"];

        $sql = "SELECT photo FROM users WHERE user_id = '$user_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row["photo"] != '' && $row["photo"] != 'empty.png'){
                    unlink('../IMG/'.$row["photo"]);
                }
            }
        }

        $sql = "UPDATE users SET photo='$photo' WHERE user_id='$user_id'";

        if($conn->query($sql) === TRUE) {
            $_SESSION["photo"] = $photo;
            echo '1';
        }else{
            echo '0';
        }
        
    }else{
        echo '0';
    }

    $conn->close();

?>
<?php

    include('../../STATIC_API/Config.php');

    if(isset($_REQUEST["data"])){
        
        $signature = $_REQUEST["data"][0];
        $user_id = $_SESSION["id"];

        $sql = "SELECT signature FROM users WHERE user_id = '$user_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row["signature"] != '' && $row["signature"] != 'empty.png'){
                    unlink('../IMG/'.$row["signature"]);
                }
            }
        }

        $sql = "UPDATE users SET signature='$signature' WHERE user_id='$user_id'";

        if($conn->query($sql) === TRUE) {
            $_SESSION["signature"] = $signature;
            echo '1';
        }else{
            echo '0';
        }
        
    }else{
        echo '0';
    }

    $conn->close();

?>
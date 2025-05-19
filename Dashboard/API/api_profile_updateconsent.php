<?php

    include('../../STATIC_API/Config.php');

    if(isset($_REQUEST["data"])){
        
        $consent_form = $_REQUEST["data"][0];
        $user_id = $_SESSION["id"];

        $sql = "SELECT consent_form FROM users WHERE user_id = '$user_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row["consent_form"] != '' && $row["consent_form"] != 'empty.png'){
                    unlink('../IMG/'.$row["consent_form"]);
                }
            }
        }

        $sql = "UPDATE users SET consent_form='$consent_form' WHERE user_id='$user_id'";

        if($conn->query($sql) === TRUE) {
            $_SESSION["consent_form"] = $consent_form;
            echo '1';
        }else{
            echo '0';
        }
        
    }else{
        echo '0';
    }

    $conn->close();

?>
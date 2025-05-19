<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){
        $id = $_SESSION["id"];
        $email = $_SESSION["email"];
        $old = $_REQUEST["data"][0];
        $new = password_hash($_REQUEST["data"][1],PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE user_id='$id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                if(password_verify($old, $row['password'])){

                    $sql = "UPDATE users SET password='$new' WHERE user_id='$id'";
                    
                    if($conn->query($sql) === TRUE) {
                        $data =  1;
                    }

                }else{
                    
                    $data = 2;

                }
            }


        }else{
            $data = 3;
        }

        
    }

    echo $data;

    $conn->close();

?>
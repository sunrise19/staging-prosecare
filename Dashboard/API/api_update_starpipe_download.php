<?php

    session_start();

    include('../../STATIC_API/Config.php');

    $data = 0;

    $user_id = $_SESSION["id"];

    $name = $_REQUEST["name"];

    $canUpdate = false;

    $sql = "SELECT * FROM starpipe_progress WHERE user_id='$user_id'";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {

        while($row = $result->fetch_assoc()) {

            if($row['module'] == 8){

                if($row['download_date'] == '' && $name != ''){

                    $sql = "UPDATE starpipe_progress SET download_name='$name', download_date='$serverDate', download_name='$name' WHERE user_id='$user_id'";
                    
                    if($conn->query($sql) === TRUE) {
                        $data =  1;
                    }else{
                        $data = 0;
                    }

                }else{
                    $data = 1;
                }

            }else{
                $data = 0;
            }

        }

    }else{
        $data = 0;
    }

    $_SESSION['SHOULD_DOWNLOAD_CERTIFICATE'] = $data == 1 ? 'true' : 'false';
    
    echo $data;

    $conn->close();

?>
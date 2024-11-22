<?php

    include('Config.php');

    $data = 'Please provide all data :/';

    if(isset($_REQUEST["data"])){
        
        $email = $_REQUEST["data"][0];
        $access_id = $_REQUEST["data"][1];

        $sql = "SELECT * FROM board_meetings WHERE access_id = '$access_id' AND (chairpersons_email LIKE '%$email%' OR participants_email LIKE '%$email%' OR patients_email LIKE '%$email%')";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data = '1,'.$row["link"];
            }
        }else{
            $data = '0'.$email;
        }

    }

    echo $data;

    $conn->close();

?>
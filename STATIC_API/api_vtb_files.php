<?php

    include('Config.php');

    $data = '0';

    if(isset($_REQUEST["data"])){
        
        $email = $_REQUEST["data"][0];
        $access_id = $_REQUEST["data"][1];

        $sql = "SELECT * FROM board_meetings WHERE access_id = '$access_id' AND (chairpersons_email LIKE '%$email%' OR participants_email LIKE '%$email%' OR patients_email LIKE '%$email%')";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            $sql = "SELECT * FROM files WHERE access_id = '$access_id'";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {

                $data = '';

                while($row = $result->fetch_assoc()) {
                    $data .= '<a href="./Dashboard/PATIENT_INFORMATION/'.$row["link"].'" target="_blank" class="file_row"><span class="file_name">'.$row["name"].'</span><span class="file_size">'.$row["size"].'</span></a>';
                }

            }else{
                $data = '1';
            }
            
        }else{
            $data = '0';
        }

    }

    echo $data;

    $conn->close();

?>
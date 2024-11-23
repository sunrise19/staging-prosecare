<?php

    include('../../STATIC_API/Config.php');

    $data = 0;
    
    $email = $_SESSION["email"];

    if(isset($_REQUEST["data"])){
        $name = $_REQUEST["data"][0];
        $date = $_REQUEST["data"][1];
        $time = $_REQUEST["data"][2];
        $description = $_REQUEST["data"][3];
        $reminder = $_REQUEST["data"][4];
        $access_type = $_REQUEST["data"][5];
        $end_time = $_REQUEST["data"][6];
        $chairpersons_email = $_REQUEST["data"][7];
        $participants_email = $email.','.$_REQUEST["data"][8];
        $patients_email = $_REQUEST["data"][9];
        
        
        $meeting_id = 'VTB / 001';
        $creator_id = $_SESSION["id"];

        $sql = 'SELECT board_meeting_id FROM board_meetings ORDER BY board_meeting_id DESC LIMIT 1';

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $id = $row['board_meeting_id'];

                if($id > 0 && $id < 10){$meeting_id = 'VTB / 00' . ($id+1);}
                else if($id > 10 && $id < 999){$meeting_id = 'VTB / 0' . ($id+1);}
                else if($id > 999){$meeting_id = 'VTB / ' . ($id+1);}
                
            }
        }

        $sql = "INSERT INTO board_meetings (meeting_id, creator_id, name, date, time, end_time, description, reminder, access_type, chairpersons_email, participants_email, patients_email, creation_date, creation_time, access_id, link) VALUES ('$meeting_id', '$creator_id', '$name', '$date', '$time', '$end_time', '$description', '$reminder', '$access_type', '$chairpersons_email', '$participants_email', '$patients_email', '$serverDate', '$serverTime', '', '')";

        if($conn->query($sql) === TRUE) {

            $access_id = $conn->insert_id;
            $access_hash = md5('VTB_'.$access_id).md5('VTB_'.$access_id);

            $sql = "UPDATE board_meetings SET access_id='$access_hash' WHERE board_meeting_id='$access_id'";

            if($conn->query($sql) === TRUE) {
                $data =  '1,'.md5('VTB_'.$access_id).','.$access_id;
            }

            
        }
        
    }

    echo $data;

    $conn->close();

?>
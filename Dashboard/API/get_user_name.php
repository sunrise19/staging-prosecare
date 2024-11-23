<?php

    include('../../STATIC_API/Config.php');

    if(isset($_REQUEST["data"])){

        $user_id = $_REQUEST["data"][0];

        $name = '';

        $typeID = '';

        $sql = "SELECT * FROM users WHERE user_id = '$user_id'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $image = $row["photo"];

                if($row["user_type"] == "admin"){

                    $sql = "SELECT first_name, last_name FROM admins WHERE user_id = '$user_id'";

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($irow = $result->fetch_assoc()) {
                            $name = $irow["first_name"] . ' ' . $irow["last_name"] . ',Administrator';
                        }
                    }
                }else if($row["user_type"] == "hospital"){

                    $sql = "SELECT name FROM hospitals WHERE user_id = '$user_id'";

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($irow = $result->fetch_assoc()) {
                            $name = $irow["name"] . ',Hospital';
                        }
                    }
                }else if($row["user_type"] == "hcp"){

                    $sql = "SELECT first_name, last_name FROM hcp WHERE user_id = '$user_id'";

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($irow = $result->fetch_assoc()) {
                            $name = $irow["first_name"] . ' ' . $irow["last_name"] . ',HCP';
                        }
                    }
                }else if($row["user_type"] == "patient"){

                    $sql = "SELECT patient_id, first_name, last_name, pin FROM patients WHERE user_id = '$user_id'";

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($irow = $result->fetch_assoc()) {
                            $typeID = $irow['patient_id'];
                            $name = ($_SESSION["hcp_123"] ? $irow["pin"] : $irow["first_name"] . ' ' . $irow["last_name"]) . ',Patient';
                        }
                    }
                }else if($row["user_type"] == "study_coordinator"){

                    $sql = "SELECT * FROM studycoordinator WHERE user_id = '$user_id'";

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($irow = $result->fetch_assoc()) {
                            $name = $irow["first_name"] . ' ' . $irow["last_name"] . ',Study Coordinator';
                        }
                    }
                }
            
            }

            echo $name.','.$image.','.$typeID;

        }else{
            echo 0;
        }
        
    }else{
        echo 0;
    }

    $conn->close();

?>
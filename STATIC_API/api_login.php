<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){
        $email = $_REQUEST["data"][0];
        // $password = md5($_REQUEST["data"][1]);
        $password = $_REQUEST["data"][1];

        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                if(password_verify($password, $row['password'])){

                    if($row["active"] == 'true'){
                        
                        session_destroy();
                        session_start();
    
                        $user_id = $row["user_id"];
                        $_SESSION["email"] = $email;
                        $_SESSION["id"] = $user_id;
                        $_SESSION["type"] = $row["user_type"];
                        $_SESSION["photo"] = $row["photo"] != "" ? $row["photo"] : "empty.png";
                        $_SESSION["signature"] = $row["signature"] != "" ? $row["signature"] : "empty.png";
                        $_SESSION["consent_form"] = $row["consent_form"] != "" ? $row["consent_form"] : "empty.png";

                        $sql_up = "UPDATE users SET last_active_date='$serverDate', last_active_time='$serverTime' WHERE user_id='$user_id'";
                        $conn->query($sql_up);
        
                        if($row["user_type"] == "superadmin"){
        
                            $sql = "SELECT first_name, last_name FROM superadmins WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $_SESSION["first_name"] = $irow["first_name"]; 
                                    $_SESSION["last_name"] = $irow["last_name"]; 
                                    $_SESSION["name"] = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                                $_SESSION["admin"] = true;
                                $_SESSION["superadmin"] = true;
                            }else{
                                echo '404';
                                return;
                            }
                        }else if($row["user_type"] == "admin"){
        
                            $sql = "SELECT first_name, last_name FROM admins WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $_SESSION["first_name"] = $irow["first_name"]; 
                                    $_SESSION["last_name"] = $irow["last_name"];
                                    $_SESSION["name"] = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                                $_SESSION["admin"] = true;
                            }else{
                                echo '404';
                                return;
                            }
                        }else if($row["user_type"] == "hospital"){
        
                            $sql = "SELECT * FROM hospitals WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $_SESSION["hospital"] = true;
                                    $_SESSION["name"] = $irow["name"];
                                    $_SESSION["hospital_id"] = $irow["hospital_id"];
                                    $_SESSION["hospital_email"] = $row["email"];
                                    $_SESSION["wallet"] = $irow["wallet"];
                                    $_SESSION["address"] = $irow["address"];
                                    $_SESSION["lga"] = $irow["lga"];
                                    $_SESSION["state"] = $irow["state"];
                                    $_SESSION["phone"] = $irow["phone"];
                                }
                            }else{
                                echo '404';
                                return;
                            }
                        }else if($row["user_type"] == "hcp"){
        
                            $sql = "SELECT hcp_id, first_name, last_name FROM hcp WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $_SESSION["hcp"] = true;
                                    $_SESSION["hcp_id"] = $irow["hcp_id"];
                                    $_SESSION["hospital_id"] = $irow["hospital"];
                                    $_SESSION["first_name"] = $irow["first_name"]; 
                                    $_SESSION["last_name"] = $irow["last_name"];
                                    $_SESSION["name"] = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                            }else{
                                echo '404';
                                return;
                            }
                        }else if($row["user_type"] == "patient" || $row["user_type"] == "caregiver"){
        
                            $sql = "SELECT patient_id, first_name, last_name, hospital_id FROM patients WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    
                                    $_SESSION["first_name"] = $irow["first_name"]; 
                                    $_SESSION["last_name"] = $irow["last_name"];
                                    $_SESSION["name"] = $irow["first_name"] . ' ' . $irow["last_name"];
                                    $_SESSION["patient_id"] = $irow["patient_id"];
                                    $_SESSION["hospital_id"] = $irow["hospital_id"];
                                    $_SESSION["patient"] = true;
                                }
                            }else{
                                echo '404';
                                return;
                            }
                        }else if($row["user_type"] == "study_coordinator"){
        
                            $sql = "SELECT studycoordinator_id, first_name, last_name FROM studycoordinator WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $_SESSION["first_name"] = $irow["first_name"]; 
                                    $_SESSION["last_name"] = $irow["last_name"];
                                    $_SESSION["name"] = $irow["first_name"] . ' ' . $irow["last_name"];
                                    $_SESSION["studycoordinator"] = true;
                                    $_SESSION["patient_id"] = $irow["studycoordinator_id"];
                                    $_SESSION["studycoordinator_id"] = $irow["studycoordinator_id"];
                                }
                            }else{
                                echo '404';
                                return;
                            }
                        }
        
                        if($row["verified"] == 'false'){
                            echo '5';
                        }else{
                            echo '1';
                        }
    
                    }else{
                        echo '6';
                    }

                }else{
                    echo '0';
                }


            
            }
        }else{
            echo '0';
        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
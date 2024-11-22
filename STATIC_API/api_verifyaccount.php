<?php

    include('Config.php');

    $data = '0';

    if(isset($_REQUEST["data"])){
        $code = $_REQUEST["data"][0];
        // $email = $_SESSION["email"];
        $email = $_REQUEST["data"][1];
        $verification_code = rand(11111, 99999);

        $sql = "SELECT * FROM users WHERE email = '$email' AND verification_code = '$code'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $type = $row['user_type'];
                $is_forgot = $row['is_forgot_password'];
                $email_hash = $row['email_hash'];

                if($is_forgot == 'true'){

                    $sql = "UPDATE users SET is_forgot_password='false' WHERE email='$email'";

                    if($conn->query($sql) === TRUE) {
                        $data = './ChangePassword?WithAuth='.$email_hash;
                    }

                }else{

                    $sql = "UPDATE users SET verified='true' WHERE email='$email'";
        
                    if($conn->query($sql) === TRUE) {
                            
                        if($type == 'hcp'){
                            $data = './HCPSignUp?WithAuth='.$email_hash;
                        }else if($type == 'hospital'){
                            $data = './HospitalSignUp?WithAuth='.$email_hash;
                        }else if($type == 'patient' || $type == 'caregiver'){
                            $data = './AcquireConsent?WithAuth='.$email_hash;
                        }
                        
                    }
                }
            }


        }
        
    }

    echo $data;

    $conn->close();

?>
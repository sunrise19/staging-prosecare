
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $id = $_SESSION["id"];

        $first_name = $_REQUEST["data"][0];
        $last_name = $_REQUEST["data"][1];
        $code = $_REQUEST["data"][2];
        $phone = $_REQUEST["data"][3];
        $email = $_REQUEST["data"][4];
        $emailHash = md5($email).md5($email);

        $_SESSION["name"] = $first_name . ' ' . $last_name;
        $_SESSION["email"] = $email;

        $sql = "UPDATE admins SET first_name='$first_name', last_name='$last_name', code='$code', phone='$phone' WHERE user_id='$id'";
        
        if($conn->query($sql) === TRUE) {
            
            $sql = "UPDATE users SET email='$email', email_hash='$emailHash' WHERE user_id='$id'";

            if($conn->query($sql) === TRUE) {
                $data = 1;
            }
            
        }
        
    }

    echo $data;

    $conn->close();

?>
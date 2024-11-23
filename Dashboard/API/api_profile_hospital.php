
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $id = $_SESSION["id"];

        $name = $_REQUEST["data"][0];
        $code = $_REQUEST["data"][1];
        $phone = $_REQUEST["data"][2];
        $email = $_REQUEST["data"][3];
        $emailHash = md5($email).md5($email);
        $cadre = $_REQUEST["data"][4];
        $lga = $_REQUEST["data"][5];
        $state = $_REQUEST["data"][6];
        $country = $_REQUEST["data"][7];

        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;

        $sql = "UPDATE hospitals SET name='$name', country='$country', state='$state', lga='$lga', code='$code', phone='$phone', cadre='$cadre' WHERE user_id='$id'";
        
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
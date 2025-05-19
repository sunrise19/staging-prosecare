
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
        $team = $_REQUEST["data"][5];
        $lga = $_REQUEST["data"][6];
        $state = $_REQUEST["data"][7];
        $country = $_REQUEST["data"][8];
        $specialty = $_REQUEST["data"][9];
        $hospital = $_REQUEST["data"][10];
        $day = $_REQUEST["data"][11];
        $month = $_REQUEST["data"][12];
        $year = $_REQUEST["data"][13];
        $folio = $_REQUEST["data"][14];
        $gender = $_REQUEST["data"][15];

        $_SESSION["name"] = $first_name . ' ' . $last_name;
        $_SESSION["email"] = $email;

        $sql = "UPDATE hcp SET first_name='$first_name', last_name='$last_name', country='$country', state='$state', lga='$lga', code='$code', team='$team', phone='$phone', specialty='$specialty', hospital='$hospital', day='$day', month='$month', year='$year', folio='$folio', gender='$gender' WHERE user_id='$id'";
        
        if($conn->query($sql) === TRUE) {
            
            $sql = "UPDATE users SET email='$email', email_hash='$emailHash' WHERE user_id='$id'";

            if($conn->query($sql) === TRUE) {
                $data = 1;
            }
            
        }else{
            $data = $conn->error;
        }
        
    }

    echo $data;

    $conn->close();

?>
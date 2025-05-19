
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $id = $_SESSION["id"];

        $first_name = $_REQUEST["data"][0];
        $last_name = $_REQUEST["data"][1];
        $gender = $_REQUEST["data"][2];
        $age = $_REQUEST["data"][3];

        $code = $_REQUEST["data"][4];
        $phone = $_REQUEST["data"][5];
        $email = $_REQUEST["data"][6];
        $emailHash = md5($email).md5($email);

        $day = $_REQUEST["data"][7];
        $month = $_REQUEST["data"][8];
        $year = $_REQUEST["data"][9];

        $country = $_REQUEST["data"][10];
        $state = $_REQUEST["data"][11];
        $lga = $_REQUEST["data"][12];
        $ethnicity = $_REQUEST["data"][13];
        
        $income = $_REQUEST["data"][14];
        $education = $_REQUEST["data"][15];
        $device = $_REQUEST["data"][16];    
        $religion = $_REQUEST["data"][17];

        $reporter = $_REQUEST["data"][18];
        $relationship = $_REQUEST["data"][19];
        $managing_team = $_REQUEST["data"][20];
        $pin = $_REQUEST["data"][21];
        
        $hospital = $_REQUEST["data"][22];
        

        $_SESSION["name"] = $first_name . ' ' . $last_name;
        $_SESSION["email"] = $email;

        $sql = "UPDATE patients SET 

        first_name='$first_name', 
        last_name='$last_name', 
        gender='$gender', 
        age='$age', 

        code='$code', 
        phone='$phone', 

        day='$day', 
        month='$month', 
        year='$year', 

        country='$country', 
        state='$state', 
        lga='$lga', 
        ethnicity='$ethnicity', 

        income='$income', 
        education='$education', 
        device='$device', 
        religion='$religion', 

        reporter='$reporter', 
        relationship='$relationship', 
        managing_team='$managing_team', 
        pin='$pin',  
        hospital_id='$hospital'  

        WHERE user_id='$id'";
        
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
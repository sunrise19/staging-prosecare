
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if(isset($_REQUEST["data"])){

        $id = $_SESSION["id"];

        $name = $_REQUEST["data"][0];
        $last_name = $_REQUEST["data"][1];
        $email = $_REQUEST["data"][2];
        $code = $_REQUEST["data"][3];
        $phone = $_REQUEST["data"][4];
        $gender = $_REQUEST["data"][5];
        $relationship = $_REQUEST["data"][6];
        $address = $_REQUEST["data"][7];
        $country = $_REQUEST["data"][8];

        $sql = "SELECT * FROM next_of_kin WHERE user_id='$id'";
        
        $result = mysqli_query($conn, $sql);
        
        if($result->num_rows > 0) {

            $sql = "UPDATE next_of_kin SET 
            name='$name', 
            last_name='$last_name', 
            email='$email', 
            code='$code',  
            phone='$phone',  
            gender='$gender',  
            relationship='$relationship',  
            address='$address', 
            country='$country'
            WHERE user_id='$id' 
            ";

            if($conn->query($sql) === TRUE) {
                $data = 1;
            }else{
                $data = $conn->error;
            }
          
        }else{

            $sql = "INSERT INTO next_of_kin (
                user_id, 
                name, 
                last_name, 
                email, 
                code, 
                phone, 
                gender, 
                relationship, 
                address,
                country) 
                VALUES (
                    '$id', 
                    '$name', 
                    '$last_name', 
                    '$email', 
                    '$code', 
                    '$phone', 
                    '$gender', 
                    '$relationship', 
                    '$address',
                    '$country'
                )";

            if($conn->query($sql) === TRUE) {
                $data = 1;
            }else{
                $data = $conn->error;
            }

        }


    }


    echo $data;

    $conn->close();

?>
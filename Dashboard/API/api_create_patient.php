<?php

include('../../STATIC_API/Config.php');

$data = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset(
        $_POST['name'],
        $_POST['name_l'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['hospital'],
        $_POST['gender'],
        $_POST['age'],
        $_POST['state'],
        $_POST['country'],
        $_POST['tribe'],
        $_POST['lga'],
        $_POST['education'],
        $_POST['income'],
        $_POST['religion'],
        $_POST['device'],
        $_POST['relationship'],
        $_POST['reporter'],
        $_POST['address'],
        $_POST['name_n'],
        $_POST['name_n_l'],
        $_POST['email_n'],
        $_POST['phone_n'],
        $_POST['gender_n'],
        $_POST['relationship_n'],
        $_POST['address_n'],
        $_POST['country_n']
    )) {

        // Sanitize and validate the input data if needed
        $name = $_POST['name'];
        $name_l = $_POST['name_l'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $hospital = $_POST['hospital'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $tribe = $_POST['tribe'];
        $lga = $_POST['lga'];
        $education = $_POST['education'];
        $income = $_POST['income'];
        $religion = $_POST['religion'];
        $device = $_POST['device'];
        $relationship = $_POST['relationship'];
        $reporter = $_POST['reporter'];
        $address = $_POST['address'];
        $name_n = $_POST['name_n'];
        $name_n_l = $_POST['name_n_l'];
        $email_n = $_POST['email_n'];
        $phone_n = $_POST['phone_n'];
        $gender_n = $_POST['gender_n'];
        $relationship_n = $_POST['relationship_n'];
        $address_n = $_POST['address_n'];
        $country_n = $_POST['country_n'];

        $sql = "SELECT email FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $data = 'Email address for this Patient is already registered';
        } else {
            $sql = "SELECT phone FROM patients WHERE phone = '$phone'";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                $data = 'Phone Number for this Patient is already registered';
            } else {

                $email_hash = sha1($email) . sha1($email);
                $password = password_hash('P@ssw0rd@123', PASSWORD_DEFAULT);
                $verification_code = rand(11111, 99999);
                $consent = false;

                $sql = "INSERT INTO users (user_type, email, email_hash, password, signup_date, signup_time, verification_code, verified, consent) VALUES ('patient', '$email', '$email_hash', '$password', '$serverDate', '$serverTime', '$verification_code', 'true', '$consent')";

                $headers = 'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                    'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($email, 'PROSE Care Regsitration', 'Hello 👋,<br><br>You have been registered on PROSE Care<br><br>PROSE Care Team.', $headers);

                if ($conn->query($sql) === TRUE) {

                    $user_id = $conn->insert_id;

                    $hospital_id = $hospital;

                    $sql = "INSERT INTO patients (
                        user_id, 
                        first_name, 
                        last_name, 
                        country, 
                        state, 
                        lga, 
                        address,
                        code, 
                        phone, 
                        religion,
                        gender, 
                        day, 
                        month, 
                        year, 
                        age,
                        education,
                        pin,
                        ethnicity,
                        device, 
                        income, 
                        cancer, 
                        reporter,
                        relationship,
                        managing_team,
                        hospital_id
                        ) VALUES (
                            '$user_id ', 
                            '$name', 
                            '$name_l', 
                            '$country', 
                            '$state', 
                            '$lga', 
                            '$address', 
                            '', 
                            '$phone', 
                            '$religion', 
                            '$gender', 
                            '', 
                            '', 
                            '', 
                            '$age', 
                            '$education', 
                            '', 
                            '$tribe', 
                            '$device', 
                            '$income', 
                            '', 
                            '$reporter', 
                            '$relationship', 
                            '', 
                            '$hospital_id'
                        )";

                    if ($conn->query($sql) === TRUE) {

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
                                '$user_id', 
                                '$name_n', 
                                '$name_n_l', 
                                '$email_n', 
                                '', 
                                '$phone_n', 
                                '$gender_n', 
                                '$relationship_n', 
                                '$address_n',
                                '$country_n'
                            )";
            
                        if($conn->query($sql) === TRUE) {
                            $data = '1'.$user_id;
                        }else{
                            $data = $conn->error;
                        }

                    } else {

                        $data = $conn->error;
                    }
                } else {
                    $data = $conn->error;
                }
            }
        }

    } else {
        // Required fields are missing in the request
        http_response_code(400); // Bad request
        $data = "Missing required fields";
    }
} else {
    // Not a POST request
    http_response_code(405);
    $data = "Method Not Allowed";
}

echo $data;

$conn->close();

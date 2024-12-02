<?php

include('../../STATIC_API/Config.php');

$data = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset(
        $_POST['name'],
        $_POST['name_l'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['gender'],
        $_POST['age'],
        $_POST['state'],
        $_POST['country'],
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
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $name_n = $_POST['name_n'];
        $name_n_l = $_POST['name_n_l'];
        $email_n = $_POST['email_n'];
        $phone_n = $_POST['phone_n'];
        $gender_n = $_POST['gender_n'];
        $relationship_n = $_POST['relationship_n'];
        $address_n = $_POST['address_n'];
        $country_n = $_POST['country_n'];
        $password = $_POST['password'] ?? 'P@ssw0rd@123';

        $sql = "SELECT email FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $data = 'Email address for HCP is already registered';
        } else {
            $sql = "SELECT phone FROM hcp WHERE phone = '$phone'";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                $data = 'Phone Number for HCP is already registered';
            } else {

                $email_hash = sha1($email) . sha1($email);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $verification_code = rand(11111, 99999);
                $consent = false;
                $is_forgot = "true";

                $sql = "INSERT INTO users (user_type, email, email_hash, $password, signup_date, signup_time, verification_code, verified, consent, is_forgot_password) VALUES ('hcp', '$email', '$email_hash', '$password', '$serverDate', '$serverTime', '$verification_code', 'true', '$consent', '$is_forgot')";

                // Define email headers
                $headers = 'MIME-Version: 1.0' . "\r\n" .
                        'Content-type: text/html; charset=UTF-8' . "\r\n" .
                        'From: PROSEcare <no-reply@prosecare.com>' . "\r\n" .
                        'Reply-To: info@prosecare.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                // Define email subject
                $subject = 'PROSEcare Registration';

                // Define email message with proper formatting
                $message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>PROSEcare Registration</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                            background-color: #f9f9f9;
                            padding: 20px;
                        }
                        .email-container {
                            max-width: 600px;
                            margin: 20px auto;
                            padding: 20px;
                            background: #fff;
                            border: 1px solid #ddd;
                            border-radius: 10px;
                        }
                        h1 {
                            color: #007BFF;
                        }
                        a {
                            color: #007BFF;
                            text-decoration: none;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <h1>Welcome to PROSEcare!</h1>
                        <p>Hello 👋,</p>
                        <p>You have been successfully registered on <b>PROSEcare</b>. Kindly use the credential below to access your account:</p>
                        <br />
                        <p> Email: <b>' . $email . '</b></p>
                        <p> Password: <b>' . $password . '</b></p>
                        <br />
                        <p>If you have any questions or concerns, please contact us via <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                        <p>Thank you,<br><b>PROSEcare Team</b></p>
                    </div>
                </body>
                </html>
                ';

                // Send the email
                mail($email, $subject, $message, $headers);

                if ($conn->query($sql) === TRUE) {

                    $user_id = $conn->insert_id;

                    $hospital_id = $_SESSION["hospital_id"];

                    $sql = "INSERT INTO hcp (
                        user_id, 
                        first_name, 
                        last_name, 
                        age,
                        day, 
                        month, 
                        year, 
                        gender, 
                        code, 
                        phone, 
                        country, 
                        state, 
                        lga, 
                        folio, 
                        specialty, 
                        hospital, 
                        team
                        ) VALUES (
                            '$user_id ', 
                            '$name', 
                            '$name_l', 
                            '$age', 
                            '', 
                            '', 
                            '', 
                            '$gender', 
                            '', 
                            '$phone', 
                            '$country', 
                            '$state', 
                            '', 
                            '', 
                            '', 
                            '$hospital_id', 
                            ''
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

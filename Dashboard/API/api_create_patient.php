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
        $password = $_POST['password'] ?? 'P@ssw0rd@123';

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
                $hashed_password = password_hash('P@ssw0rd@123', PASSWORD_DEFAULT);
                $verification_code = rand(11111, 99999);
                $consent = false;

                $sql = "INSERT INTO users (user_type, email, email_hash, password, signup_date, signup_time, verification_code, verified, consent, is_forgot_password) VALUES ('patient', '$email', '$email_hash', '$hashed_password', '$serverDate', '$serverTime', '$verification_code', 'true', '$consent', 'true')";

                // Define headers
                $headers = 'MIME-Version: 1.0' . "\r\n" .
                           'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                           'From: "PROSEcare" <no-reply@prosecare.com>' . "\r\n" .
                           'Reply-To: info@prosecare.com' . "\r\n" .
                           'X-Mailer: PHP/' . phpversion();
                
                // Define subject
                $subject = 'PROSEcare Registration';
                
                // Define message body
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
                            margin: 0;
                            padding: 20px;
                            background-color: #f9f9f9;
                        }
                        .email-container {
                            background: #ffffff;
                            border: 1px solid #dddddd;
                            border-radius: 8px;
                            max-width: 600px;
                            margin: 20px auto;
                            padding: 20px;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                        }
                        .email-header {
                            text-align: center;
                            font-size: 24px;
                            color: #007BFF;
                        }
                        .email-footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 12px;
                            color: #555;
                        }
                        a {
                            color: #007BFF;
                            text-decoration: none;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <h2 class="email-header">Welcome to PROSEcare!</h2>
                        <p>Hello 👋,</p>
                        <p>You have been successfully registered on <b>PROSEcare</b>. Kindly use the credential below to access your account:</p>
                        <br />
                        <p> Email: <b>' . $email . '</b></p>
                        <p> Password: <b>' . $password . '</b></p>
                        <br />
                        <p>You have been successfully registered.</p>
                        <p>If you have any questions or need assistance, feel free to contact us at <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                        <p>Thank you,<br><br><strong>PROSEcare Team</strong></p>
                    </div>
                    <div class="email-footer">
                        &copy; ' . date('Y') . ' PROSEcare. All rights reserved.
                    </div>
                </body>
                </html>
                ';
                
                // Send the email
                mail($email, $subject, $message, $headers);
                                
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

<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){
        $fname = $_REQUEST["data"][0];
        $lname = $_REQUEST["data"][1];
        $day = $_REQUEST["data"][2];
        $month = $_REQUEST["data"][3];
        $year = $_REQUEST["data"][4];
        $gender = $_REQUEST["data"][5];
        $education = $_REQUEST["data"][6];
        $pin = $_REQUEST["data"][7];
        $country = $_REQUEST["data"][8];
        $state = $_REQUEST["data"][9];
        $lga = $_REQUEST["data"][10];
        $ethnicity = $_REQUEST["data"][11];
        $code = $_REQUEST["data"][12];
        $phone = $_REQUEST["data"][13];
        $religion = $_REQUEST["data"][14];
        $income = $_REQUEST["data"][15];
        $cancer = $_REQUEST["data"][16];
        $device = $_REQUEST["data"][17];
        $reporter = $_REQUEST["data"][18];
        $relationship = $_REQUEST["data"][19];
        $age = $_REQUEST["data"][20];
        $AUTH = $_REQUEST["data"][21];

        $sql = "SELECT email FROM users WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            echo 'email_used';
        } else {

            $sql = "SELECT phone FROM patients WHERE code = '$code' AND phone = '$phone'";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                echo 'phone_used';
            }else{

                $sql = "SELECT * FROM users WHERE email_hash = '$AUTH'";

                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {

                    $user_id = "";

                    while($row = $result->fetch_assoc()) {
                        $user_id = $row["user_id"];
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["id"] = $user_id;
                        $_SESSION["type"] = $row["user_type"];
                        $_SESSION["photo"] = $row["photo"] != "" ? $row["photo"] : "empty.png";
                        $_SESSION["signature"] = $row["signature"] != "" ? $row["signature"] : "empty.png";
                    }

                    $pin = $pin.$user_id.$user_id;

                    
                    $sql = "INSERT INTO patients (user_id, first_name, last_name, day, month, year, age, gender, education, pin, country, state, lga, ethnicity, code, phone, religion, income, cancer, device, reporter, relationship) VALUES ('$user_id', '$fname', '$lname', '$day', '$month', '$year', '$age', '$gender', '$education', '$pin', '$country', '$state', '$lga', '$ethnicity', '$code', '$phone', '$religion', '$income', '$cancer',  '$device', '$reporter', '$relationship')";
                    
                    if($conn->query($sql) === TRUE) {

                        $sql_up = "UPDATE users SET last_active_date='$serverDate', last_active_time='$serverTime' WHERE user_id='$user_id'";
                        $conn->query($sql_up);
                        
                        $patient_id = $conn->insert_id;                    
                        $_SESSION["name"] = $fname . ' ' . $lname;
                        $_SESSION["patient_id"] = $patient_id;
                        $_SESSION["patient"] = true;
                                                
                         // Define headers
                         $headers = 'MIME-Version: 1.0' . "\r\n" .
                         'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                         'From: "PROSEcare" <no-reply@prosecare.com>' . "\r\n" .
                         'Reply-To: info@prosecare.com' . "\r\n" .
                         'X-Mailer: PHP/' . phpversion();

                        // Define subject
                        $subject = 'PROSEcare Registration Completed';

                        // Email message body
                        $message = '
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>PROSEcare Registration Completed</title>
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
                                <p>Dear ' . htmlspecialchars($fname) . ',</p>
                                <p>Thank you for joining PROSEcare.</p>
                                <p>Your regiustration process has been completed successfully!</p>
                                <br />
                                <p>If you have any questions or concerns, feel free to contact us at <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                                <p>Regards,<br><strong>PROSEcare Team</strong></p>
                            </div>
                            <div class="email-footer">
                                &copy; ' . date('Y') . ' PROSEcare. All rights reserved.
                            </div>
                        </body>
                        </html>
                        ';

                        // Send the email
                        mail($_SESSION["email"], $subject, $message, $headers);

                        echo 1;
                    }else{
                        // $conn->error
                        session_destroy();
                        echo 0;
                    }

                }else{
                    echo 2;
                }

            }

        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
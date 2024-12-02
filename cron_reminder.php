<?php

    include('STATIC_API/Config.php');

    $sql = "SELECT * FROM reminders";
    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {

            
            $reminder_time = $row['time'];
            $current_time = date("h:i A");
            
            $to_time = strtotime("2022-8-16 " .$current_time);
            $from_time = strtotime("2022-8-16 " .$reminder_time);
            $difference = round(abs($to_time - $from_time) / 60,2);
            echo '<br><br>' . $difference . " minutes difference";

            if($difference  <= 5){

                $user_id = $row['user_id'];
                $email = '';
                $name = '';
    
                $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    
                $result = mysqli_query($conn, $sql);
        
                if ($result->num_rows > 0) {
        
                    while($row2 = $result->fetch_assoc()) {
                            
                        $email = $row2['email'];
        
                        if($row2["user_type"] == "superadmin"){
        
                            $sql = "SELECT first_name, last_name FROM superadmins WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $name = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                            }
    
                        }else if($row2["user_type"] == "admin"){
        
                            $sql = "SELECT first_name, last_name FROM admins WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $name = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                            }
                        }else if($row2["user_type"] == "hospital"){
        
                            $sql = "SELECT hospital_id, name FROM hospitals WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $name = $irow["name"];
                                }
                            }
                        }else if($row2["user_type"] == "hcp"){
        
                            $sql = "SELECT first_name, last_name FROM hcp WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $name = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                            }
                        }else if($row2["user_type"] == "patient" || $row2["user_type"] == "caregiver"){
        
                            $sql = "SELECT patient_id, first_name, last_name FROM patients WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $name = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                            }
                        }else if($row2["user_type"] == "study_coordinator"){
        
                            $sql = "SELECT studycoordinator_id, first_name, last_name FROM studycoordinator WHERE user_id = '$user_id'";
        
                            $result = mysqli_query($conn, $sql);
        
                            if ($result->num_rows > 0) {
                                while($irow = $result->fetch_assoc()) {
                                    $name = $irow["first_name"] . ' ' . $irow["last_name"];
                                }
                            }
                        }
                    
                    }
                }
    
                $title = $row['description'] . ' Reminder';
                $message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>' . htmlspecialchars($title) . '</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                        }
                        .content {
                            margin: 20px auto;
                            padding: 20px;
                            max-width: 600px;
                            border: 1px solid #ddd;
                            border-radius: 10px;
                            background-color: #f9f9f9;
                        }
                        a {
                            color: #007BFF;
                            text-decoration: none;
                        }
                    </style>
                </head>
                <body>
                    <div class="content">
                        <p>Hello ' . htmlspecialchars($name) . ',</p>
                        <p>This is a reminder to ' . htmlspecialchars($row['description']) . ' on <a href="https://prosecare.com/Login">PROSEcare</a>.</p>
                        <p>If you have any questions or concerns, please contact us via <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                        <br>
                        <p>Thank you,</p>
                        <p><b>PROSEcare Team</b></p>
                    </div>
                </body>
                </html>
                ';
                
                $headers = 'MIME-Version: 1.0' . "\r\n" .
                           'Content-type: text/html; charset=UTF-8' . "\r\n" .
                           'From: PROSEcare <no-reply@prosecare.com>' . "\r\n" .
                           'Reply-To: info@prosecare.com' . "\r\n" .
                           'X-Mailer: PHP/' . phpversion();
                
                mail($email, $title, $message, $headers);

                echo '<br><br>Mail is sent to ' . $name . ' ('.$email.')'. ' for ' . $reminder_time;

            }else{
                echo '<br><br>' . $reminder_time . ' is not ' . $current_time;
            }

        }

    }

    $conn->close();

?>

            

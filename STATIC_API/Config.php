<?php

    session_start();

    $servername = "localhost";
    
    // $username = "u721901196_prosecare";
    // $password = "u721901196_prosecarE1@";
    // $dbname = "u721901196_prosecare";
        
    // $username = "proscibg_prose";
    // $password = "proscibg_prose";
    // $dbname = "proscibg_prose";

    $username = "root";
    $password = "";
    $dbname = "prosecare";
    
    // $SITE_URL = "https://prosecare.com/TEST_V2";
    $SITE_URL = "https://renderer.endor.dev/app"

    $VIDEO_CONFERENCING_URL = 'https://6251-102-117-182-61.ngrok-free.app/';

    date_default_timezone_set('Africa/Lagos');

    error_reporting(E_ERROR | E_PARSE);

    $monthArray = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $serverDate = date("l") . ', ' . $monthArray[date("m") + 0] . ' ' . date("d") . ', ' . date("Y");
    $serverTime = date("h:i:s a");

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if (!$conn->set_charset("utf8") ){
        die("Error loading character set utf8:" .  $conn->error);
    }

    // function escape(string $string){
        // global $conn;
        // return $conn->real_escape_string($string);
        // return mysqli_real_escape_string($conn, $string);
    // }

    function profileStatus($user_id) {
        global $conn;
        $pending = '<span class="badge badge-pill badge-soft-warning font-size-12 px-3 py-2">Pending</span>';
        $completed = '<span class="badge badge-pill badge-soft-success font-size-11 px-3 py-2">Completed</span>';
        
        $sql = "SELECT * FROM patients WHERE user_id=$user_id";
        
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows == 1) {

            while ($row = $result->fetch_assoc()) {
                if(
                    $row['first_name'] != ''
                    &&
                    $row['last_name'] != ''
                    &&
                    $row['country'] != ''
                    &&
                    $row['state'] != ''
                    &&
                    $row['lga'] != ''
                    &&
                    $row['address'] != ''
                    &&
                    $row['phone'] != ''
                    &&
                    $row['gender'] != ''
                    &&
                    $row['age'] != ''
                    &&
                    $row['cancer'] != ''
                    &&
                    $row['age_when_diagnosed'] != ''
                    &&
                    $row['initial_cancer'] != ''
                    &&
                    $row['histology'] != ''
                    &&
                    $row['cancer_grade'] != ''
                    &&
                    $row['cancer_stage'] != ''
                    &&
                    $row['comorbidity'] != ''
                    &&
                    $row['height'] != ''
                    &&
                    $row['weight'] != ''
                    &&
                    $row['bmi'] != ''
                    &&
                    $row['waist'] != ''
                    &&
                    $row['head'] != ''
                    &&
                    $row['hospital_id'] != ''
                ){

                    $sql = "SELECT * FROM next_of_kin WHERE user_id=$user_id";
                    
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows == 1) {

                        while ($row = $result->fetch_assoc()) {

                            if(
                                $row['name'] != ''
                                &&
                                $row['last_name'] != ''
                                &&
                                $row['email'] != ''
                                &&
                                $row['phone'] != ''
                                &&
                                $row['gender'] != ''
                                &&
                                $row['relationship'] != ''
                                &&
                                $row['address'] != ''
                                &&
                                $row['country'] != ''
                            ){
                                return $completed;

                            }else{
                                return $pending;
                            }
                        }

                    }else{
                        return $pending;
                    }

                    
                }
                else{
                    return $pending;
                }
            }

        }else{
            return $pending;
        }
    }

    function profileStatusDoctors($user_id) {
        global $conn;
        $pending = '<span class="badge badge-pill badge-soft-warning font-size-12 px-3 py-2">Pending</span>';
        $completed = '<span class="badge badge-pill badge-soft-success font-size-11 px-3 py-2">Completed</span>';
        
        $sql = "SELECT * FROM hcp WHERE user_id=$user_id";
        
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows == 1) {

            while ($row = $result->fetch_assoc()) {
                if(
                    $row['first_name'] != ''
                    &&
                    $row['last_name'] != ''
                    &&
                    $row['country'] != ''
                    &&
                    $row['state'] != ''
                    &&
                    $row['lga'] != ''
                    &&
                    $row['phone'] != ''
                    &&
                    $row['specialty'] != ''
                    &&
                    $row['gender'] != ''
                    &&
                    $row['age'] != ''
                    &&
                    $row['hospital'] != ''
                    &&
                    $row['practicing_mdcn_file'] != ''
                    &&
                    $row['practicing_mdcn_expiry'] != ''
                    &&
                    $row['mdcn_registration_file'] != ''
                    &&
                    $row['mdcn_registration_expiry'] != ''
                    &&
                    $row['fellowship_license_file'] != ''
                    &&
                    $row['fellowship_license_expiry'] != ''
                ){

                    $sql = "SELECT * FROM next_of_kin WHERE user_id=$user_id";
                    
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows == 1) {

                        while ($row = $result->fetch_assoc()) {

                            if(
                                $row['name'] != ''
                                &&
                                $row['last_name'] != ''
                                &&
                                $row['email'] != ''
                                &&
                                $row['phone'] != ''
                                &&
                                $row['gender'] != ''
                                &&
                                $row['relationship'] != ''
                                &&
                                $row['address'] != ''
                                &&
                                $row['country'] != ''
                            ){
                                return $completed;

                            }else{
                                return $pending;
                            }
                        }

                    }else{
                        return $pending;
                    }

                }
                else{
                    return $pending;
                }
            }

        }else{
            return $pending;
        }
    }
    
    function timeDifference($date, $time){

        if($date == '' || $time == ''){
            return '-';
        }

        // Convert date and time string to DateTime object
        $lastActiveDateTime = new DateTime($date . ' ' . $time);

        // Get current DateTime object
        $currentDateTime = new DateTime();

        // Calculate the difference between current time and last active time
        $difference = $currentDateTime->diff($lastActiveDateTime);

        // Format the difference
        $format = '';
        if ($difference->y > 0) {
            $format = '%y year'.($difference->y > 1 ? 's' : '').' ago';
        } elseif ($difference->m > 0) {
            $format = '%m month'.($difference->m > 1 ? 's' : '').' ago';
        } elseif ($difference->d > 0) {
            $format = '%d day'.($difference->d > 1 ? 's' : '').' ago';
        } elseif ($difference->h > 0) {
            $format = '%h hour'.($difference->h > 1 ? 's' : '').' ago';
        } elseif ($difference->i > 0) {
            $format = '%i minute'.($difference->i > 1 ? 's' : '').' ago';
        } else {
            $format = 'Just now';
        }

        // Output the formatted difference
        return $difference->format($format);
    }

    function getInitials($name) {
        // Step 1: Split the string by spaces into an array of words
        $words = explode(' ', $name);
    
        // Step 2: Map over the array to get the first letter of each word
        $initials = array_map(function($word) {
            return $word[0];
        }, $words);
    
        // Step 3: Join the array of letters into a single string
        return implode('', $initials);
    }
    
?>
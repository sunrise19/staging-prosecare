<?php

    // session_start();

    include('../../STATIC_API/Config.php');

    $data = 0;

    $module = $_SESSION["LAST_SECTION"];
    $lesson = $_SESSION["LAST_LESSON"];

    $currentModule = $_SESSION["CURRENT_SECTION"];
    $currentLesson = $_SESSION["CURRENT_LESSON"];

    $user_id = $_SESSION["id"];

    $canUpdate = false;

    if($module == $currentModule && $lesson == $currentLesson){
        $canUpdate = true;
    }else{
        $module = $currentModule;
        $lesson = $currentLesson;
    }

    if($module == ''){ $module = 1; $lesson = 1; }

    else if($module == '1'){ 
        $module = 1;
             if($lesson == 1){$lesson = 2;}
        else if($lesson == 2){$lesson = 3;}
        else if($lesson == 3){$lesson = 4;}
        else if($lesson == 4){$lesson = 5;}
        else if($lesson == 5){$lesson = 6;}
        else if($lesson == 6){$lesson = 7;}
        else if($lesson == 7){$lesson = 8;}
        else if($lesson == 8){$module = 2; $lesson = 1;}
    }

    else if($module == '2'){ 
        $module = 2;
             if($lesson == 1){$lesson = 2;}
        else if($lesson == 2){$lesson = 3;}
        else if($lesson == 3){$lesson = 4;}
        else if($lesson == 4){$lesson = 5;}
        else if($lesson == 5){$lesson = 6;}
        else if($lesson == 6){$lesson = 7;}
        else if($lesson == 7){$lesson = 8;}
        else if($lesson == 8){$lesson = 9;}
        else if($lesson == 9){$module = 3; $lesson = 1;}
    }

    else if($module == '3'){ 
        $module = 3;
             if($lesson == 1){$lesson = 2;}
        else if($lesson == 2){$lesson = 3;}
        else if($lesson == 3){$lesson = 4;}
        else if($lesson == 4){$lesson = 5;}
        else if($lesson == 5){$lesson = 6;}
        else if($lesson == 6){$module = 4; $lesson = 1;}
    }

    else if($module == '4'){ 
        $module = 4;
             if($lesson == 1){$lesson = 2;}
        else if($lesson == 2){$lesson = 3;}
        else if($lesson == 3){$lesson = 4;}
        else if($lesson == 4){$lesson = 5;}
        else if($lesson == 5){$lesson = 6;}
        else if($lesson == 6){$lesson = 7;}
        else if($lesson == 7){$lesson = 8;}
        else if($lesson == 8){$module = 6; $lesson = 1;}
    }

    else if($module == '6'){ 
        $module = 6;
             if($lesson == 1){$lesson = 2;}
        else if($lesson == 2){$lesson = 3;}
        else if($lesson == 3){$lesson = 4;}
        else if($lesson == 4){$lesson = 5;}
        else if($lesson == 5){$module = 7; $lesson = 1;}
    }

    else if($module == '7'){
        $module = 8; $lesson = 1;
    }

    if($module == '8'){
        $responseLink = './?SECTION='.$module;
    }else{
        $responseLink = './?SECTION='.$module.'&LESSON='.$lesson;
    }


    if($canUpdate){

        $sql = "SELECT * FROM starpipe_progress WHERE user_id='$user_id'";
    
        $result = mysqli_query($conn, $sql);
    
        if ($result->num_rows > 0) {
    
            $sql = "UPDATE starpipe_progress SET module='$module', lesson='$lesson' WHERE user_id='$user_id'";
            
            if($conn->query($sql) === TRUE) {

                if($module == 8){
                    $sql = "UPDATE starpipe_progress SET end_date='$serverDate' WHERE user_id='$user_id'";
                    $conn->query($sql);
                }

                $data =  $responseLink;
            }
    
        }else{
            
            $sql = "INSERT INTO starpipe_progress (user_id, module, lesson, start_date) VALUES ('$user_id', '$module', '$lesson', '$serverDate')";
    
            if($conn->query($sql) === TRUE) {
                $data =  $responseLink;
            }else{
                // $data = $conn->error;
                $data = 0;
            }
    
        }

    }else{
        $data = $responseLink;
    }

    echo $data;

    $conn->close();

?>
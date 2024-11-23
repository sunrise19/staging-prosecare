<?php

    include('../../STATIC_API/Config.php');

    $path= "../HCP_FILES/";
    $column_name = $_REQUEST['column_name'];
    $file_name = $_REQUEST['file_name'];
    //$result = [];
    $result = '';

    foreach ($_FILES as $key) {

        if($key['error'] == UPLOAD_ERR_OK ){
            $dt = date('YmdHis').time().rand();
            $name = $dt.'_'.str_replace(' ', '_', $key['name']);
            $temp = $key['tmp_name'];
            move_uploaded_file($temp, $path . $name);
            // $result[] = $name;
            $result = $name;
        }
    }

    
    if($result != ''){
        
        $isEditing = $_REQUEST['editing'] == 'true' ? true : false;

        $user_id = $isEditing ? $_REQUEST['user_id'] : $_SESSION["id"];

        
        $sql = "SELECT " . $column_name . " FROM hcp WHERE user_id=$user_id";
        
        $sqlresult = mysqli_query($conn, $sql);

        if ($sqlresult->num_rows > 0) {
            while($row = $sqlresult->fetch_assoc()) {
                $thisColumnName = $row["".$column_name];
                if($thisColumnName != '' && $thisColumnName != 'empty.png'){
                    $array = explode(',', $thisColumnName);
                    unlink('../HCP_FILES/'.$array[1]);
                }
            }
        }

        $fileAndFileName = $file_name.','.$result;

        $sql = "UPDATE hcp SET " . $column_name . "='$fileAndFileName' WHERE user_id='$user_id'";

        if($conn->query($sql) !== TRUE) {
            $result = $conn->error;
        }

    }

    echo $result;

?>
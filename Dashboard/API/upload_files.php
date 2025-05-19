<?php

    $path= "../CHAT_STORAGE/";
    $result = [];

    foreach ($_FILES as $key) {

        if($key['error'] == UPLOAD_ERR_OK ){
            $dt = date('YmdHis').time().rand();
            $name = $dt.'_'.$key['name'];
            $temp = $key['tmp_name'];
            // $size= ($key['size'] / 1000)."Kb";
            move_uploaded_file($temp, $path . $name);
            $result[] = $name;
        }
        /*
        else{
            echo $key['error'];
        }
        */
        
    }

    echo implode(",", $result);

?>
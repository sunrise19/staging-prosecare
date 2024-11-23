<?php

    $path= "../PATIENT_INFORMATION/";
    $result = [];

    foreach ($_FILES as $key) {

        if($key['error'] == UPLOAD_ERR_OK ){
            $dt = date('YmdHis').time().rand();
            $name = $dt.'_'.$key['name'];
            $temp = $key['tmp_name'];
            move_uploaded_file($temp, $path . $name);
            $result[] = $name;
        }
    }

    echo implode(",", $result);

?>
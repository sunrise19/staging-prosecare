<?php

    include('./STATIC_API/Config.php');
    
    $id = $_REQUEST['id'];

    $extension = 'jpeg'; 
    $j = '1%';
    $globalName = '';

    if(isset($_REQUEST["images"])){
        if(is_array($_REQUEST["images"])){
            for($i = 0; $i < count($_REQUEST["images"]); $i++){
                work($_REQUEST["images"][$i], true);
            }
            echo $j;
        }else{
            work($_REQUEST["images"], false);
            

            $sql = "INSERT INTO consent_forms (user_id, file_name) VALUES ('$id', '$globalName')";
            if($conn->query($sql) === TRUE){
                echo $j;
            }else{
                echo 0;
            }

        }
    }else{
        echo 'You didn\'t select a file to upload :/';
    }

    function work($item, $isArray){
        global $extension, $j, $globalName;
        $dt = date('YmdHis').time().rand();
        $name = $dt.'.'.$extension;
        $globalName = $name;
        $location = 'CONSENT_FORMS/'.$dt.'.'.$extension;
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $item));
        if(file_put_contents($location, $data)){
            $j = $j . $name . ',';
        }
    }


?>
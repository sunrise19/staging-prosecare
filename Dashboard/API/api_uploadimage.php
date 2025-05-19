<?php

    $extension = 'jpeg'; 
    $j = '1%';

    if(isset($_REQUEST["images"])){
        if(is_array($_REQUEST["images"])){
            for($i = 0; $i < count($_REQUEST["images"]); $i++){
                work($_REQUEST["images"][$i], true);
            }
            echo $j;
        }else{
            work($_REQUEST["images"], false);
            echo $j;
        }
    }else{
        echo 'You didn\'t select a file to upload :/';
    }

    function work($item, $isArray){
        global $extension, $j;
        $dt = date('YmdHis').time().rand();
        $name = $dt.'.'.$extension;
        $location = '../IMG/'.$dt.'.'.$extension;
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $item));
        if(file_put_contents($location, $data)){
            $j = $j . $name . ',';
        }
    }


?>
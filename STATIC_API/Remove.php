<?php
    if(unlink($_REQUEST["file"])){
        echo 'File removed';
    }else{
        echo 'File not removed';
    }
?>
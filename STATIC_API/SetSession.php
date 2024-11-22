<?php
    session_start();
    $_SESSION[$_REQUEST["key"]] = $_REQUEST["value"];
?>
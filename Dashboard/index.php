<?php

error_reporting(0);
ini_set('display_errors', 0);

session_start();

if (isset($_SESSION["id"])) {
    if (!isset($_SESSION["name"]) || $_SESSION["name"] == "") {
        echo "<script>window.location.href='../Login';</script>";
        exit;
    }
    if (isset($_SESSION["superadmin"])) {
        header('location: SuperAdmin-Home');
    } else if (isset($_SESSION["studycoordinator"])) {
        header('location: Study-Coordinator-Home');
    } else if (isset($_SESSION["hcp"])) {
        header('location: HCP-Home');
    } else if (isset($_SESSION["hospital"])) {
        header('location: Hospital-Home');
    } else {
        header('location: Home');
    }
} else {
    header('location: ../Login');
}

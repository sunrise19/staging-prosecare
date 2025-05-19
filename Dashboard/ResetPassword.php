<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Reset Password";
include('Commons/header.php');
include('../STATIC_API/Config.php');
if (!isset($_SESSION["superadmin"])) {
    header('location: Home');
}

?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style>
    .profile-user-wid {
        margin-top: 0;
    }

    .ep {
        padding: 1px 11px;
        border-radius: 10px;
        margin-left: 15px;
        color: #fff !important;
        margin-top: -4px;
    }

    .img-thumbnail {
        padding: 0;
        border-radius: 10px !important;
        width: 107px;
        height: 107px;
        max-width: unset;
    }

    .ut {
        background: #ff650e52;
        color: #FF650E;
    }

    .avatar-md {
        width: unset;
        height: unset;
    }

    .table td,
    .table th {
        border: none;
    }

    tr:hover {
        background: none;
    }

    .sweetselect {
        width: 100%;
        padding: 11.05px 8px;
    }

    .edit_section {
        /* display: none; */
    }

    .centralize {
        width: 100%;
        display: block;
        height: 50px;
        text-align: center;
    }


    .table td,
    .table th {
        border: none;
        padding: 0;
    }

    tr {
        display: flex;
        flex-direction: column;
        margin: 30px 0;
        gap: 7px;
        color: #000;
    }

    .table th {
        color: #555;
    }

    .table td {
        font-size: 16px;
    }

    .page-title-box h4 {
        text-transform: unset;
        color: #000;
        font-size: 20px !important;
    }

    .card-body {
        padding: 0;
        background: #f9f9f9 !important;
    }

    .card {
        background-color: #f9f9f9 !important;
        box-shadow: none !important
    }

    .tiny_image {
        border-radius: 500px;
        width: 200px;
        height: 200px;
        pointer-events: all !important;
        object-fit: cover;
        -webkit-user-drag: none;
    }

    button {
        border-radius: 50px !important;
        font-weight: 500 !important;
        padding: 14px 27px !important;
        font-size: 15px !important;
    }

    .card span {
        font-size: 15px;
        color: #000;
        font-weight: 500;
    }

    .form-control,
    .sweetselect {
        border: 1px solid #8D2D9233 !important;
        border-radius: 30px;
        padding: 15px 29px;
        height: unset;
        font-size: 14px;
        margin-top: 4px;
    }

    .vertical_section {
        display: none;
    }
</style>

<style id="dynamic_style"></style>


<div class="main-content">

    <div class="page-content p-3">
        <div class="container-fluid">

        <i onclick="window.location.href='./AdminSettings'" class="bx bx-left-arrow-alt mb-4" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>

        <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Reset Password</h2>


            <div class="tab_container reset_password as_sheet pt-4 mt-4" style="display: block">

                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Reset Password</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-12 mb-3">
                                    <span>Current Password</span>
                                    <input class="form-control" type="password" id="password">
                                </div>
                                <div class="col-sm-12 col-lg-12 mb-3">
                                    <span>New Password</span>
                                    <input class="form-control" type="password" id="passworda">
                                </div>
                                <div class="col-sm-12 col-lg-12 mb-3">
                                    <span>Confirm New Password</span>
                                    <input class="form-control" type="password" id="passwordb">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light updatepassword blue">Change password</button>
                        </div>
                    </div>
                </div>

            </div>

    
            <!-- end row -->


        </div>
        <!-- container-fluid -->

    </div>
    <!-- End Page-content -->


    <?php include('Commons/footer.php'); ?>

    <script src="JS/Profile.js"></script>

    <script>
            $('.S-AdminSettings').addClass('mm-active').find('a').addClass('active')
    </script>


    <style>
        .swal2-styled.swal2-confirm,
        .swal2-styled.swal2-deny,
        .swal2-styled.swal2-cancel {
            background-color: #8D2D91;
        }

        .swal2-title {
            font-size: 25px !important;
        }
    </style>

    </body>

    </html>
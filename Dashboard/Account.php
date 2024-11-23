<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Patients"; 
    include('Commons/header.php');  
    include('../STATIC_API/Config.php');
    if(!isset($_SESSION["superadmin"])){
        header('location: Home');
    }

    $user_id = $_SESSION["id"];
    
    $hospital_id = $_SESSION["hospital_id"];

    $sql = "SELECT * FROM patients JOIN users ON patients.user_id=users.user_id WHERE patients.patient_id='$UID'";

    $result = $conn->query($sql);
    $result2;

    $data;
    $dataNOK;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = $row;
            echo "<script>const CANCER_TYPE = '".strtolower($row['cancer'])."'.replace(/ /g, '_'), USER_ID='".$row['user_id']."', PATIENT_ID='".$UID."'</script>";

            $user_id = $row['user_id'];
            $sql2 = "SELECT * FROM next_of_kin WHERE user_id='$user_id'";
            $result2 = $conn->query($sql2);
        }
        
        if ($result2->num_rows > 0) {
            
            while($row2 = $result2->fetch_assoc()) {
                $dataNOK = $row2;
            }

        }

    }else{
        // echo "<script>window.location.href= './Patients'</script>";
        // return;
    }

?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <style>
    .profile-user-wid {
        margin-top: 0;
    }
    .ep{
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
    .ut{
        background: #ff650e52;
        color: #FF650E;
    }

    .avatar-md {
        width: unset;
        height: unset;
    }

    .table td, .table th{
        border: none;
    }

    tr:hover {
        background: none;
    }

    .sweetselect {
        width: 100%;
        padding: 11.05px 8px;
    }

    .edit_section{
        /* display: none; */
    }

    .centralize {
        width: 100%;
        display: block;
        height: 50px;
        text-align: center;
    }


    .table td, .table th {
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

    .table th{
        color: #555;
    }

    .table td {
        font-size: 16px;
    }

    .page-title-box h4{
        text-transform: unset;
        color: #000;
        font-size: 20px !important;
    }

    .card-body{
        padding: 0;
        background: #f9f9f9 !important;
    }
    
    .card{
        background-color: #f9f9f9 !important;
        box-shadow: none !important
    }

    .tiny_image{
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

    .form-control,.sweetselect {
        border: 1px solid #8D2D9233 !important;
        border-radius: 30px;
        padding: 15px 29px;
        height: unset;
        font-size: 14px;
        margin-top: 4px;
    }

    .vertical_section{
        display: none;
    }
</style>

    <style id="dynamic_style"></style>


        <div class="main-content">

            <div class="page-content p-3">
                <div class="container-fluid">

                    <div class="l2r mb-5" style="gap: 30px">

                        <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Account</h2>

                        <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                            <img src="../assets/images/Calendar2.svg" alt="">
                            <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                                <?php echo date("M d, Y"); ?>
                            </span>
                        </div>
                        
                    </div>
                    
                    <div class="l2r mt-1" style="gap: 30px; justify-content: start;">
                        <a class="tab_item active" data-tab="profile">Profile Information</a>
                        <a class="tab_item" data-tab="reset_password">Reset Password</a>
                        <a class="tab_item" data-tab="bank_account">Bank Account</a>
                        <!-- <a class="tab_item" data-tab="role">Roles and Permissions </a> -->
                    </div>

                    <div class="tab_container profile" style="display: block">

                        <div class="mt-4 t2b as_sheet">

                            <div class="p-0 w-100 border-0" style="background: #F9F9F9; border-radius: 10px; border: 1px solid #0000000D; text-align: left">
                                <div class="l2r" style="gap: 10px; align-items: center;">
                                    <img src="IMG/<?php echo $_SESSION['photo']; ?>" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 100px; border: 1px solid #8D2D922B">
                                    <h3 class="font-weight-bold text-dark mb-0 flex-1"><?php echo $_SESSION['name']; ?></h3>
                                </div>
                                <hr>
                                <div class="l2r text-dark align-start" style="gap: 10px;">
                                    <div class="l2r flex-1" style="gap: 10px">
                                        <i class="bx bx-map font-size-18"></i> 
                                        <span class="font-size-14">Address</span>
                                    </div>
                                    
                                    <span class="flex-1 font-size-14">
                                        <?php echo $_SESSION['address'] . ', ' . $_SESSION['lga'] . ', ' . $_SESSION['state']?>
                                    </span>
                                </div>
                                <div class="l2r text-dark mt-3" style="gap: 10px;">
                                    <div class="l2r flex-1" style="gap: 10px">
                                        <i class="bx bx-envelope font-size-18"></i>
                                        <span class="font-size-14">Email</span>
                                    </div>
                                    <span class="flex-1 font-size-14">
                                        <?php echo $_SESSION['hospital_email']?>
                                    </span>
                                </div>
                                <div class="l2r text-dark mt-3" style="gap: 10px;">
                                    <div class="l2r flex-1" style="gap: 10px">
                                        <i class="bx bx-phone font-size-18"></i>
                                        <span class="font-size-14">Phone Number</span>
                                    </div>
                                    <span class="flex-1 font-size-14">
                                        <?php echo $_SESSION['phone']?>
                                    </span>
                                </div>
                            </div>

                            <div class="row w-100 mx-0 mt-3 pt-4" style="border-top: 1px solid #14142B29">

                                <style>
                                    .home_outlined_card{
                                        background: none;
                                        padding: 20px;
                                    }
                                </style>
                                <div class="col-md-4 col-sm-12" onclick="location.href = './Doctors'">
                                    <div class="card mini-stats-wid home_outlined_card mb-0">
                                        <div class="card-body py-0">
                                            <div class="media flex-row">
                                                <div class="media-body align-items-center">
                                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">HCPs Onboarded</p>
                                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                                        <?php
                                                        $sql = "SELECT count(1) FROM hcp WHERE hospital='$hospital_id'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_array($result);
                                                        echo number_format($row[0]);
                                                        ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12" onclick="location.href = './Patients'">
                                    <div class="card mini-stats-wid home_outlined_card mb-0">
                                        <div class="card-body py-0">
                                            <div class="media flex-row">
                                                <div class="media-body align-items-center">
                                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Patients Onboarded</p>
                                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                                        <?php
                                                        $sql = "SELECT count(1) FROM patients WHERE hospital_id='$hospital_id'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_array($result);
                                                        echo number_format($row[0]);
                                                        ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4  col-sm-12" onclick="location.href = './Patients'">
                                    <div class="card mini-stats-wid home_outlined_card mb-0">
                                        <div class="card-body py-0">
                                            <div class="media flex-row">
                                                <div class="media-body align-items-center">
                                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Active Patients</p>
                                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                                        <?php
                                                        $sql = "SELECT count(1) FROM sideeffects RIGHT JOIN patients ON sideeffects.patient_id=patients.patient_id WHERE patients.hospital_id='$hospital_id' GROUP BY sideeffects.patient_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_array($result);
                                                        echo number_format($row[0]);
                                                        ?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                </div>

                        
                        </div>
    
                      

                    </div>



                    <div class="tab_container reset_password as_sheet pt-4 mt-4">

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

                    <div class="tab_container bank_account as_sheet pt-4 mt-4">

                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Your Bank</h4>
                            </div>
                            <div class="row">

                                <?php

                                    $sql = "SELECT * FROM banks WHERE user_id=" . $user_id;

                                    $result = mysqli_query($conn, $sql);

                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            echo  '
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="card mini-stats-wid home_outlined_card mb-0 border-0" style="background: #e9d9e9 !important">
                                                            <div class="card-body py-0" style="background: #e9d9e9 !important">
                                                                <div class="media flex-row">
                                                                    <div class="media-body align-items-center pt-5">
                                                                        <img id="' . $row['bank_id'] . '" class="delete_bank" src="../assets/images/Trash_Full.svg" style="background: #fff;padding: 10px;border-radius: 30px; right: 0; top: 0; position: absolute; cursor: pointer">
                                                                        <p class="font-weight-bold font-size-15 mb-1 mt-5" style="color: #000; text-transform: none">' . $row['account_number'] . '</p>
                                                                        <p class="font-weight-medium font-size-15 mb-1" style="color: #000; text-transform: none">' . $row['account_name'] . '</p>
                                                                        <p class="font-weight-medium font-size-15 mb-1" style="color: #000; text-transform: none">' . $row['bank_name'] . '</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            ';
                                        }
                                    }

                                ?>

                                
                                <div class="col-md-4 col-sm-12 cursor-pointer" onclick="window.location.href='Create-Bank?From=Account'">
                                    <div class="card mini-stats-wid home_outlined_card mb-0 h-100" style="background: #fff !important; border-color: #8D2D9233">
                                        <div class="card-body py-0" style="background: #fff !important;">
                                            <div class="media flex-row h-100">
                                                <div class="media-body align-items-center d-flex flex-column justify-content-center h-100">
                                                    <i class="bx bx-plus-circle text-primary mb-2" style="font-size: 45px;"></i>
                                                    <p class="font-weight-bold font-size-18 text-primary">Add New Bank</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- end row -->


                </div>
                <!-- container-fluid -->

            </div>
            <!-- End Page-content -->

            <div class="treament_modal">
                <div class="treament_modal_content">
                    <div class="l2r">
                        <div class="treament_modal_title"></div>
                        <div class="close_treament_modal">+</div>
                    </div>
                    <iframe src="" class="treatment_frame"></iframe>
                </div>
            </div>
    
    <?php include('Commons/footer.php');?>

    <script src="JS/Profile.js"></script>


    <style>
        .swal2-styled.swal2-confirm,.swal2-styled.swal2-deny,.swal2-styled.swal2-cancel{
            background-color: #8D2D91;
        }
        .swal2-title {
            font-size: 25px !important;
        }
    </style>

</body>

</html>
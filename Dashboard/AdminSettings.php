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

                        <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Settings</h2>

                        <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                            <img src="../assets/images/Calendar2.svg" alt="">
                            <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                                <?php echo date("M d, Y"); ?>
                            </span>
                        </div>
                        
                    </div>

                    <div class="t2b setting_item_holder">
                        
                        <div class="l2r w-100">

                            <div class="setting_item" onclick="window.location.href='Create-Hospital?From=AdminSettings'">
                                <img src="../assets/images/User_Add.svg" alt="">
                                <span>
                                    Create New Admin
                                </span>
                                <img src="../assets/images/arrow-right.svg" alt="">
                            </div>

                            <div class="setting_item" onclick="window.location.href='ResetPassword'">
                                <img src="../assets/images/profile.svg" alt="">
                                <span>
                                    Reset Password
                                </span>
                                <img src="../assets/images/arrow-right.svg" alt="">
                            </div>

                        </div>
                        
                        <div class="l2r w-100 d-none">

                            <div class="setting_item">
                                <img src="../assets/images/File_Document.svg" alt="">
                                <span>
                                    Create Forms
                                </span>
                                <img src="../assets/images/arrow-right.svg" alt="">
                            </div>

                            <div class="setting_item" onclick="window.location.href='Resources'">
                                <img src="../assets/images/File_Document.svg" alt="">
                                <span>
                                    News and Resources
                                </span>
                                <img src="../assets/images/arrow-right.svg" alt="">
                            </div>

                        </div>
                        
                        <div class="l2r w-100">

                            <div class="setting_item" onclick="window.location.href='Notifications'">
                                <img src="../assets/images/Bell_Ring.svg" alt="">
                                <span>
                                    Notifications
                                </span>
                                <img src="../assets/images/arrow-right.svg" alt="">
                            </div>

                            <div class="setting_item" onclick="window.location.href='Resources'">
                                <img src="../assets/images/File_Document.svg" alt="">
                                <span>
                                    News and Resources
                                </span>
                                <img src="../assets/images/arrow-right.svg" alt="">
                            </div>

                            <!-- <div class="setting_item" onclick="window.location.href='RolesAndPermissions'">
                                <img src="../assets/images/profile.svg" alt="">
                                <span>
                                    Roles and Permissions
                                </span>
                                <img src="../assets/images/arrow-right.svg" alt="">
                            </div> -->

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
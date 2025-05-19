<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Appointments"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');
?>

<style>
    .table{
        margin-top: 0;
    }
    .avatar-title, .bg-primary {
        background-color: #f28e52 !important;
        border: none;
    }
    .card{
        background-size: cover;
        overflow: hidden;
    }
    .shaded_glass {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #00000061;
        left: 0;
        top: 0;
    }
    .media-body{
        position: relative;
    }
    .glass_text{
        color: #fff;
        background: #ffffff99;
        width: fit-content;
        font-size: 13px;
        padding: 3px 13px;
        border-radius: 30px;
        margin-top: 120px;
    }
</style>

        <div class="main-content">

            <div class="page-content" style=" padding-bottom: 0; ">
                <div class="container-fluid">


                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12 l2r mb-5">
                            <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Appointments</h2>
                            <?php
                                if($_SESSION['type'] == 'patient'){
                                    $errorText = 'When you book an appointment with a doctor, they\'ll appear here';
                                    echo '
                                    <div class="l2r right_actions" style="gap: 20px">
                                        <div class="start_new_chat book_an_appointment">
                                            <i class="bx bx-plus-circle"></i>
                                            Book An Appointment
                                        </div>
                                    </div>
                                    ';
                                }else{
                                    $errorText = 'When a patient books an appointment with you, they\'ll appear here';
                                    echo '
                                        <div class="css-1vakbk4">
                                            <img src="./STARPIPE/starpipe_files/user.svg" class="chakra-image css-7d3f7d cursor-pointer" onclick="window.location.href=\'./Profile-HCP\'">
                                            <img src="./STARPIPE/starpipe_files/bell.svg" class="chakra-image css-7d3f7d cursor-pointer">
                                        </div>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                    <!-- end page title -->        
                    
                    <?php

                        if($_SESSION['type'] != 'patient'){
                            echo '                 
                                <form class="app-search d-lg-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search Appointments">
                                        <span class="bx bx-search text-black" style="color: #74788d; font-size: 22px; top: 50%; transform: translateY(-50%); left: 40px;"></span>
                                    </div>
                                </form>
                            ';
                        }
                    ?>
                    

                    <div class="mt-1 t2b as_sheet">
                        
                        <div class="l2r" style="gap: 70px; justify-content: start;">
                            <a class="tab_item active" data-tab="upcoming">Upcoming</a>
                            <a class="tab_item" data-tab="completed">Completed</a>
                            <a class="tab_item" data-tab="pending">Pending</a>
                            <?php
                                if($_SESSION['type'] == 'patient'){
                                    echo '<a class="tab_item" data-tab="declined">Failed</a>';
                                }else{
                                    echo '
                                        <div class="my_schedule">
                                            <img src="IMG/Calendar_Days.svg" alt="">
                                            Schedule
                                        </div>
                                    ';
                                }
                            ?>
                        </div>

                        <div class="tab_container upcoming" style="display: block">
                            <?php
                                $hcp_id = $_SESSION['hcp_id'];
                                $sql = "SELECT COUNT(1) FROM appointments WHERE hcp_id='$hcp_id' AND status='upcoming'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                            ?>
                            <div class="t2b empty <?php echo $row[0] == 0 ? '' : 'd-none'; ?>">
                                <img src="IMG/appts.svg" alt="">
                                <div class="empty_title">You do not have any upcoming appointments</div>
                                <div class="empty_desc"><?php echo $errorText;?></div>
                            </div>
                            <div class="t2b appointment_entries">
                                
                            </div>
                        </div>

                        <div class="tab_container completed">
                            <?php
                                $hcp_id = $_SESSION['hcp_id'];
                                $sql = "SELECT COUNT(1) FROM appointments WHERE hcp_id='$hcp_id' AND status='completed'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                            ?>
                            <div class="t2b empty <?php echo $row[0] == 0 ? '' : 'd-none'; ?>">
                                <img src="IMG/appts.svg" alt="">
                                <div class="empty_title">You do not have any completed appointments</div>
                                <div class="empty_desc"><?php echo $errorText;?></div>
                            </div>
                            <div class="t2b appointment_entries">
                                
                            </div>
                        </div>

                        <div class="tab_container pending">
                            <?php
                                $hcp_id = $_SESSION['hcp_id'];
                                $sql = "SELECT COUNT(1) FROM appointments WHERE hcp_id='$hcp_id' AND status='pending'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                            ?>
                            <div class="t2b empty <?php echo $row[0] == 0 ? '' : 'd-none'; ?>">
                                <img src="IMG/appts.svg" alt="">
                                <div class="empty_title">You do not have any pending appointments</div>
                                <div class="empty_desc"><?php echo $errorText;?></div>
                            </div>
                            <div class="t2b appointment_entries">
                                
                            </div>
                        </div>

                        <div class="tab_container declined">
                            <?php
                                $hcp_id = $_SESSION['hcp_id'];
                                $sql = "SELECT COUNT(1) FROM appointments WHERE hcp_id='$hcp_id' AND status='declined'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                            ?>
                            <div class="t2b empty <?php echo $row[0] == 0 ? '' : 'd-none'; ?>">
                                <img src="IMG/appts.svg" alt="">
                                <div class="empty_title">You do not have any declined appointments</div>
                                <div class="empty_desc"><?php echo $errorText;?></div>
                            </div>
                            <div class="t2b appointment_entries">
                                
                            </div>
                        </div>

                    </div>
                    
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <div class="treament_modal">
                <div class="treament_modal_content" style=" background: #F9F9F9; ">
                    <div class="l2r">
                        <div class="treament_modal_title">Consultation Summary</div>
                        <div class="close_treament_modal">+</div>
                    </div>
                    <iframe src="" class="treatment_frame"></iframe>
                </div>
            </div>

        </div>
        <!-- end main content-->
    <?php 
        $conn->close();
        include('Commons/footer.php');
    ?>
    <script src="JS/Appointments.js"></script>

    <script>
        $(document).ready(function(){
            if(window.location.href?.includes('#Book')){
                $('.book_an_appointment').click()
            }
        })
    </script>


</body>

</html>
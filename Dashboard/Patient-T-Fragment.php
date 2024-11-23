<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    include('Commons/header.php');   
?>

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
        background: #f44336;
        border-color: #f44336
    }
    .img-thumbnail {
        padding: 0;
        border-radius: 10px !important;
        width: 107px;
        height: 107px;
        max-width: unset;
        object-fit: cover;
        object-position: center;
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
        display: none;
    }

    .centralize {
        width: 100%;
        display: block;
        height: 50px;
        text-align: center;
    }

    #page-topbar,.vertical-menu{
        display: none;
    }

    .main-content, .page-content,.container-fluid{
        margin: 0;
        padding: 0
    }

    .table-responsive{
        overflow-x: hidden;
    }

</style>

    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">
                
                <h3 style=" margin: 20px 0 50px; ">TREATMENT LOGS FOR <b><?php echo strtoupper($_REQUEST['name']);?></b></h3>
 
                <div class="row">

                    <!-- <div class="col-12"> -->

                        
                        <div class="col-md-4">
                            <div class="card mini-stats-wid" style="background: #2EBBB2" onclick="window.location.href='./Patient-Chemo-Fragment?id=<?php echo $_REQUEST['id'];?>'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #2EBBB2"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Chemotherapy</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid" style="background: #FE6ABC" onclick="window.location.href='./Patient-Other-Medication-Fragment?id=<?php echo $_REQUEST['id'];?>'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #FE6ABC;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Other Medications</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid" style="background: #607d8b" onclick="window.location.href='./Patient-Radio-Fragment?id=<?php echo $_REQUEST['id'];?>'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #607d8b;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Radiotherapy</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card mini-stats-wid" style="background: #4A3A4B" onclick="window.location.href='./Patient-Surgery-Fragment?id=<?php echo $_REQUEST['id'];?>'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #4A3A4B"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Surgical Procedure</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid" style="background: #F3897B !important" onclick="window.location.href='./Patient-Interruption-Fragment?id=<?php echo $_REQUEST['id'];?>'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #F3897B;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Treatment Interruptions</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card mini-stats-wid" style="background: #66BAFE" onclick="window.location.href='./Patient-Support-Fragment?id=<?php echo $_REQUEST['id'];?>'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #66BAFE;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Supportive Care</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- </div> -->
                </div>

                    <!-- end row -->
                    
    

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>


</body>

</html>
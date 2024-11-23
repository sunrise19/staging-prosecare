<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Treatments"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');
?>

<style>
    .table {
        margin-top: 0;
    }

    .avatar-title,
    .bg-primary {
        background-color: #f28e52 !important;
        border: none;
    }
</style>

<div class="main-content">

    <div class="page-content" style=" padding-bottom: 0; ">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18 snt">TREATMENTS</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>Dashboard</a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo $TITLE; ?>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">

                <div class="col-md-7">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="card mini-stats-wid" style="background: #2EBBB2" onclick="window.location.href='./Treatment-Chemotherapy'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #2EBBB2"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Log Chemotherapy</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 

                            // include('../STATIC_API/Config.php');

                            // $UID = $_SESSION["id"];

                            // $sql = "SELECT cancer FROM patients WHERE user_id='$UID'";

                            // $result = $conn->query($sql);

                            // if ($result->num_rows > 0) {

                            //     while($row = $result->fetch_assoc()) {
                                    
                            //         $cancer = strtolower($row['cancer']);


                            //         $size = 'col-12';

                            //         if($cancer != 'breast' && $cancer != 'male pelvic'){

                            //             $size = 'col-md-6';

                            //             echo '';
                            //         }
                            //     }

                            // }
                        ?>
                        
                        <div class="col-md-6">
                            <div class="card mini-stats-wid" style="background: #FE6ABC" onclick="window.location.href='./Treatment-Other-Medications'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #FE6ABC;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Log Other Medications</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mini-stats-wid" style="background: #607d8b" onclick="window.location.href='./Treatment-Radiotherapy'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #607d8b;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Log Radiotherapy</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card mini-stats-wid" style="background: #4A3A4B" onclick="window.location.href='./Treatment-Surgery'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #4A3A4B"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Log Surgical Procedure</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mini-stats-wid" style="background: #F3897B !important" onclick="window.location.href='./Treatment-Interruptions'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #F3897B;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Log Treatment Interruptions</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mini-stats-wid" style="background: #66BAFE" onclick="window.location.href='./Treatment-Supportive-Care'">
                                <div class="card-body">
                                    <div class="media flex-row justify-center" style="justify-content: center;  align-items: center;">
                                        <div class="avatar-sm rounded-circle mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #fff !important">
                                                <i class="mdi mdi-plus-circle font-size-24" style="color: #66BAFE;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="ml-3 mb-0 font-size-17 font-weight-bold" style="color: #fff">Log Supportive Care</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="col-md-5">
                    <div class="col-12 table-col" >
                            <div class="card" style="height: calc(100vh - 205px);">
                                <div class="card-body">

                                    <div class="empty_state">
                                        <div>
                                            <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="48" cy="48" r="47.75" fill="#F9D7EF"/>
                                                <path d="M48 31.5417C44.7448 31.5417 41.5628 32.5069 38.8562 34.3154C36.1496 36.1239 34.0401 38.6943 32.7944 41.7017C31.5488 44.709 31.2228 48.0183 31.8579 51.2109C32.4929 54.4035 34.0604 57.3361 36.3622 59.6378C38.6639 61.9395 41.5965 63.507 44.7891 64.1421C47.9817 64.7771 51.2909 64.4512 54.2983 63.2055C57.3057 61.9598 59.8761 59.8503 61.6846 57.1438C63.493 54.4372 64.4583 51.2552 64.4583 48C64.4583 45.8387 64.0326 43.6985 63.2055 41.7017C62.3784 39.7049 61.1661 37.8905 59.6378 36.3622C58.1095 34.8339 56.2951 33.6216 54.2983 32.7945C52.3015 31.9674 50.1613 31.5417 48 31.5417ZM49.6458 54.5833C49.6458 55.0198 49.4724 55.4385 49.1637 55.7471C48.8551 56.0558 48.4365 56.2292 48 56.2292C47.5635 56.2292 47.1448 56.0558 46.8362 55.7471C46.5275 55.4385 46.3541 55.0198 46.3541 54.5833V46.3542C46.3541 45.9177 46.5275 45.499 46.8362 45.1904C47.1448 44.8817 47.5635 44.7083 48 44.7083C48.4365 44.7083 48.8551 44.8817 49.1637 45.1904C49.4724 45.499 49.6458 45.9177 49.6458 46.3542V54.5833ZM48 43.0625C47.6745 43.0625 47.3562 42.966 47.0856 42.7851C46.8149 42.6043 46.604 42.3472 46.4794 42.0465C46.3548 41.7458 46.3223 41.4148 46.3858 41.0956C46.4493 40.7763 46.606 40.4831 46.8362 40.2529C47.0664 40.0227 47.3596 39.866 47.6789 39.8025C47.9981 39.739 48.3291 39.7716 48.6298 39.8961C48.9305 40.0207 49.1876 40.2316 49.3684 40.5023C49.5493 40.773 49.6458 41.0912 49.6458 41.4167C49.6458 41.8532 49.4724 42.2718 49.1637 42.5805C48.8551 42.8891 48.4365 43.0625 48 43.0625Z" fill="#71207D"/>
                                            </svg>
                                            <h5 class="mt-2 mb-0 snt font-size-15 font-weight-normal es_message" style="color: #666">Click on an option to log</h5>
                                            <button class="btn btn-primary start_log mt-3" style="display: none">Add New Log</button>
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

</div>
<!-- end main content-->
<?php 
        $conn->close();
        include('Commons/footer.php');
    ?>


</body>

</html>
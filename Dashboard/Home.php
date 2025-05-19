<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Home";
include('Commons/header.php');
include('../STATIC_API/Config.php');
$user_id = $_SESSION["id"];
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

    .mini-stats-wid .mini-stat-icon:after,
    .mini-stats-wid .mini-stat-icon:before {
        display: none;
    }

    .card-body.bordered {
        padding: 1.5rem;
        overflow-x: auto;
        border: 1px solid #dedee1;
        border-radius: 9px;
    }
</style>

<?php include('Commons/subscription.php'); ?>

<div class="main-content">

    <div class="page-content" style=" padding-bottom: 0; ">
        <div class="container-fluid">

            <div class="css-nwirxm">
                <div class="header_name_and_photo">
                    <img src="IMG/<?php echo $_SESSION["photo"]; ?>" class="chakra-image css-1gri224" onclick="window.location.href='./Profile-PATIENT'">
                    <div class="text-section">
                        <span class="header_hcp_name">Hello <?php echo $_SESSION["name"]; ?> 👋</span>
                        <span>Welcome Back</span>
                    </div>
                </div>
                <div class="css-1vakbk4">
                    <div class="l2r premium" data-toggle="modal" data-target="#premiumModal">
                        <img src="./IMG/premium.png">
                        Premium
                    </div>
                </div>
            </div>

            <div class="row px-0">

                <div class="col-md-4" onclick="location.href = './SideEffects'">
                    <div class="card mini-stats-wid">
                        <div class="card-body bordered" style="background: #8D2D9214; ">
                            <div class="media flex-column">
                                <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                    <span class="avatar-title rounded-circle bg-primary" style="background: #8D2D92 !important">
                                        <img src="IMG/health.svg" alt="">
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #000">Report a Side Effect</h4>
                                    <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Click here to report a side effect you<br>are experiencing.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" onclick="location.href = './SideEffects#Treatment'">
                    <div class="card mini-stats-wid">
                        <div class="card-body bordered" style="background: #37c85f12; ">
                            <div class="media flex-column">
                                <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                    <span class="avatar-title rounded-circle bg-primary" style="background: #91F3DA !important">
                                        <i class="bx bxs-archive font-size-24" style="color: #006D7A;"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #005267">Log a Treatment</h4>
                                    <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Click here to log your treatment record for the day</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4" onclick="location.href = './Appointments#Book'">
                    <div class="card mini-stats-wid">
                        <div class="card-body bordered" style="background: #feb63017; ">
                            <div class="media flex-column">
                                <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                    <span class="avatar-title rounded-circle bg-primary" style="background: #FEE5D9 !important">
                                        <i class="bx bxs-grid-alt font-size-24" style="color: #DA3046;"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #B62141">Book an Appointment</h4>
                                    <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Speak to an healthcare professional via video consultation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php

                    $sql = "SELECT * FROM patients JOIN next_of_kin ON patients.user_id=next_of_kin.user_id WHERE patients.user_id='$user_id'";

                    $result = mysqli_query($conn, $sql);

                    $progress = 20;

                    $data;

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {

                            $data = $row;

                            if ($_SESSION["photo"] != '' && $_SESSION["photo"] != 'empty.png') {
                                $progress = 25;

                                if ($row['name'] != '' && $row['last_name'] != '' && $row['email'] != '' && $row['phone'] != '' && $row['gender'] != '' && $row['relationship'] != '' && $row['address'] != '' && $row['country'] != '') {
                                    $progress = 50;

                                    if ($row['age_when_diagnosed'] != '' && $row['initial_cancer'] != '' && $row['histology'] != '' && $row['cancer_grade'] != '' && $row['cancer_stage'] != '' && $row['comorbidity'] != '') {
                                        $progress = 75;

                                        if ($row['height'] != '' && $row['weight'] != '' && $row['bmi'] != '' && $row['waist'] != '' && $row['head'] != ''){
                                            $progress = 100;
                                        }

                                    } 

                                } 

                            } 
                            
                        }
                    }

                    if ($progress < 100) {
                        echo '
                            <div class="col-12 mt-2 mb-5" style="cursor: pointer">
                                <div class="css-nwirxm mb-0" onclick="location.href = \'./Profile-PATIENT\'" style="background: #ED3F321A">
                                    <div class="header_name_and_photo">
                                        <div class="circular_progress progress_' . $progress . '">
                                            ' . $progress . '%
                                        </div>
                                        <div class="text-section" style="color: #000">
                                            <span style=" font-weight: 600; font-size: 14px; ">Complete your profile setup</span>
                                            <span>We need to verify your identity, click here to complete your profile setup</span>
                                        </div>
                                    </div>
                                    <div class="css-1vakbk4">
                                        <i class="bx bx-chevron-right" style="font-size: 35px;"></i>
                                    </div>
                                </div>
                            </div>
                        ';
                    }

                ?>

                     

                <div class="col-12" style=" display: flex; gap: 24px; ">

                    <div class="col-md-8 p-4" style="background: #F9F9F9; border-radius: 10px;">
                        <span class="section_title">Recent Activity</span>
                        <div class="recent_activities">
                            <?php

                            $sql = "SELECT * FROM logs JOIN patients on logs.user_id=patients.user_id WHERE NOT logs.log_type='View' AND logs.user_id=" . $user_id . " ORDER BY logs.log_id DESC LIMIT 100";

                            $result = mysqli_query($conn, $sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {

                                    echo  '
                                                        <div class="log_entry">
                                                            <img class="log_entry_icon" src="IMG/' . ($row['log_type'] == 'New Log' ? 'sfx.svg' : 'bell.svg') . '"/>
                                                            <span class="entry_logger">You</span>
                                                            <span class="log_text">' . $row['log_action'] . '</span>
                                                            <span class="log_date">' . $row['log_date'] . '</span>
                                                        </div>
                                                    ';
                                }
                            }else{
                                echo 'No recent activity :/';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-4 p-4" style="background: #F9F9F9; border-radius: 10px;">
                        <span class="section_title">Side Effects Overview</span>
                        <?php

                        $sql = "SELECT * FROM sideeffects WHERE user_id='$user_id'";

                        $tiredness = 0;
                        $vomiting = 0;
                        $nausea = 0;
                        $mouth_sore = 0;
                        $headache = 0;

                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                                $tiredness =  trim($row['b_tired_or_weak']) != '' ? $tiredness + 1 : $tiredness;
                                $tiredness =  trim($row['hn_tired_or_weak']) != '' ? $tiredness + 1 : $tiredness;
                                $tiredness =  trim($row['fp_tired_or_weak']) != '' ? $tiredness + 1 : $tiredness;
                                $tiredness =  trim($row['mp_tired_or_weak']) != '' ? $tiredness + 1 : $tiredness;

                                $vomiting =  trim($row['hn_vomiting']) != '' ? $vomiting + 1 : $vomiting;
                                $vomiting =  trim($row['fp_vomiting']) != '' ? $vomiting + 1 : $vomiting;
                                $vomiting =  trim($row['mp_vomiting']) != '' ? $vomiting + 1 : $vomiting;

                                $nausea =  trim($row['hn_nausea']) != '' ? $nausea + 1 : $nausea;
                                $nausea =  trim($row['fp_nausea']) != '' ? $nausea + 1 : $nausea;
                                $nausea =  trim($row['mp_nausea']) != '' ? $nausea + 1 : $nausea;

                                $mouth_sore =  trim($row['hn_mouth_sore']) != '' ? $mouth_sore + 1 : $nausea;
                            }
                        }

                        echo '<script>const 
                                        tiredness=' . intval($tiredness) . ', 
                                        vomiting=' . intval($vomiting) . ', 
                                        nausea=' . intval($nausea) . '
                                        mouth_sore=' . intval($mouth_sore) . ',
                                        headache=' . intval($headache) . '
                                    </script>';
                        ?>
                        <div class="recent_activities" id="sfx_chart"></div>
                    </div>

                </div>

                <div class="col-12 mt-4">
                    <span class="section_title">Quick Actions</span>
                </div>

                <div class="col-md-4" onclick="window.location.href = 'QualityOfLifeSurvey'">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #8D2D9212">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="IMG/survey.svg" style=" width: 35px; height: 100%; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">QOL Survey</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #C6F1F73D">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="IMG/desk.svg" style=" width: 45px; height: 100%; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Get a second opinion</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #FEB6301C" onclick="window.location.href = 'AskQuestion?From=Home'">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="IMG/head.svg" style=" width: 45px; height: 100%; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Ask a question</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end row -->

            <style>
                #chart {
                    max-width: 100%;
                    margin: 0 auto;
                    width: 100%;
                    height: 250px;
                    min-height: 250px;
                }
            </style>

            <?php
            if (isset($_SESSION["admin"]) || isset($_SESSION["superadmin"]) || $_SESSION["type"] == "hospital") {
                echo '
                            <div class="row col-12 card" style=" margin: 0; ">
                                <p class="text-muted font-weight-medium" style="margin-top: 20px;font-size: 18px;margin-left: 10px;font-weight: 600;">VTB Activity</p>
                                <div id="chart"></div>
                            </div>';
            }
            ?>





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

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        chart: {
            type: 'area',
            height: 320,
            zoom: {
                enabled: false
            },
            pan: {
                enabled: false
            },
            toolbar: {
                enabled: false
            },
        },
        colors: ['#8D2D92'],
        fill: {
            type: 'gradient',
            colors: ['#8D2D92'],

        },
        dataLabels: {
            enabled: false,
            style: {
                colors: ['#F44336', '#E91E63']
            }
        },
        markers: {
            colors: ['#8D2D92A1', ]
        },
        stroke: {
            curve: 'smooth',
        },
        series: [{
            name: 'Severity',
            data: [tiredness, vomiting, nausea, mouth_sore, headache]
        }],
        xaxis: {
            categories: ['Tiredness', 'Vomiting', 'Nausea', 'Mouth sores', 'Headache']
        },
        yaxis: {
            labels: {
                show: false,
            }
        }
    }

    var chart = new ApexCharts(document.querySelector("#sfx_chart"), options);

    chart.render();
</script>
<style>
    .apexcharts-toolbar {
        display: none !important;
    }
</style>

<script>
    log('Viewed Home', 'View')
</script>

</body>

</html>
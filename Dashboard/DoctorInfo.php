<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Doctor's Info";
include('Commons/header.php');
include('../STATIC_API/Config.php');
if (!isset($_SESSION["superadmin"])) {
    header('location: Home');
}

$UID = $_REQUEST["ID"];

if (!is_numeric($UID)) {
    echo "<script>window.location.href= './Doctors'</script>";
    return;
}

$sql = "SELECT * FROM hcp JOIN users ON hcp.user_id=users.user_id WHERE hcp.hcp_id='$UID'";


$result = $conn->query($sql);
$result2;

$data;
$dataNOK;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $data = $row;

        $practicing_mdcn_file = explode(',', $row["practicing_mdcn_file"]);
        $practicing_mdcn_expiry = $row["practicing_mdcn_expiry"];
        $mdcn_registration_file = explode(',', $row["mdcn_registration_file"]);
        $mdcn_registration_expiry = $row["mdcn_registration_expiry"];
        $fellowship_license_file = explode(',', $row["fellowship_license_file"]);
        $fellowship_license_expiry = $row["fellowship_license_expiry"];

        $user_id = $row['user_id'];
        $sql2 = "SELECT * FROM next_of_kin WHERE user_id='$user_id'";
        $result2 = $conn->query($sql2);
    }

    if ($result2->num_rows > 0) {

        while ($row2 = $result2->fetch_assoc()) {
            $dataNOK = $row2;
        }
    }
}

?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style id="dynamic_style">
    .small_title {
        border-bottom: 1px solid #D2D1D7;
        width: 100%;
    }

    .t2b.cell {
        flex: 1
    }

    .as_sheet .l2r {
        gap: 20px;
    }

    .tab_container .cell_title {
        color: #000;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .tab_container .cell_value {
        background: #8D2D920F;
        padding: 14px 24px;
        border-radius: 30px;
        width: 100%;
        display: flex;
    }

    .tab_container .cell_value span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        flex: 1;
        margin-right: 17px;
    }

    .as_sheet .t2b {
        height: unset;
    }
    .apexcharts-legend{
        display: none !important;
    }
</style>


<div class="main-content">

    <div class="page-content p-3">
        <div class="container-fluid">

            <i onclick="window.location.href='./Doctors'" class="bx bx-left-arrow-alt mb-4" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>

            <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Doctor's Info</h2>

            <div class="l2r align-items-start">

                <div class="col-md-<?php echo isset($_SESSION['superadmin']) ? '8' : '12'; ?> col-sm-12 mt-4 t2b as_sheet">

                    <!-- START PROFILE HEADING -->
                    <div class="l2r" style="gap: 25px; align-items: center;">
                        <div class="photo_box" style="background: transparent;">
                            <img src="IMG/<?php echo $data['photo'] ?>" alt="" class="w-100 h-100">
                        </div>
                        <div class="t2b" style="gap: 20px;">
                            <div class="l2r">
                                <div class="t2b" style="gap: 1px">
                                    <span class="font-size-18 font-weight-bold text-dark">Dr. <?php echo $data['first_name'] . ' ' . $data['last_name'] ?></span>
                                    <div class="cell_title"><?php echo $data['specialty'] ?></div>
                                    <div class="cell_value">Last Login: <span class="text-success"><?php echo (timeDifference($data['last_active_date'], $data['last_active_time'])) ?></span></div>
                                    <div class="cell_value <?php echo isset($_SESSION['superadmin']) ? '' : 'd-none'; ?>">
                                        <?php
                                            $sql = "SELECT name FROM hospitals WHERE hospital_id=".$data['hospital'];
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<b>'.$row['name'].'</b>';
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="action_button decline <?php echo $data['active'] == 'false' ? 'd-none' : '' ?>">Deactivate</div>
                        <div class="action_button accept <?php echo $data['active'] == 'true' ? 'd-none' : '' ?>">Activate</div>
                    </div>
                    <!-- END PROFILE HEADING -->

                    <div class="l2r mt-3" style="gap: 20px; justify-content: start;">
                        <a class="tab_item active" data-tab="profile">Profile Information</a>
                        <a class="tab_item" data-tab="patients">Patients</a>
                        <a class="tab_item" data-tab="activity">Activity</a>
                        <!-- <a class="tab_item" data-tab="health_report">Health Report</a> -->
                    </div>

                    <!-- START PROFILE TABS -->
                    <div class="tab_container profile" style="display: block">

                        <div class="mt-4 t2b as_sheet p-0 border-0">
                            <div class="small_title">Personal Details</div>
                            <div class="l2r" style="gap: 25px">
                                <div class="t2b" style="gap: 20px;">
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Email Address</div>
                                            <div class="cell_value"><?php echo $data['email'] ?></div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Phone Number</div>
                                            <div class="cell_value"><?php echo $data['code'] . ' ' . $data['phone'] ?></div>
                                        </div>
                                    </div>
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Gender</div>
                                            <div class="cell_value"><?php echo $data['gender'] ?></div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Age</div>
                                            <div class="cell_value"><?php echo $data['age'] ?></div>
                                        </div>
                                    </div>
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">State</div>
                                            <div class="cell_value"><?php echo $data['state'] ?></div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Country</div>
                                            <div class="cell_value"><?php echo $data['country'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="t2b as_sheet p-0 border-0 mt-5">
                            <div class="small_title">Next of Kin Details</div>
                            <div class="l2r" style="gap: 25px">
                                <div class="t2b" style="gap: 20px;">
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">First Name</div>
                                            <div class="cell_value"><?php echo $dataNOK['name'] ?></div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Last Name</div>
                                            <div class="cell_value"><?php echo $dataNOK['last_name'] ?></div>
                                        </div>
                                    </div>
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Email Address</div>
                                            <div class="cell_value"><?php echo $dataNOK['email'] ?></div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Phone Number</div>
                                            <div class="cell_value"><?php echo $dataNOK['code'] . ' ' . $dataNOK['phone'] ?></div>
                                        </div>
                                    </div>
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Gender</div>
                                            <div class="cell_value"><?php echo $dataNOK['gender'] ?></div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Relationship</div>
                                            <div class="cell_value"><?php echo $dataNOK['relationship'] ?></div>
                                        </div>
                                    </div>
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Address</div>
                                            <div class="cell_value"><?php echo $dataNOK['address'] ?></div>
                                        </div>
                                        <div class="t2b cell"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 t2b as_sheet p-0 border-0">
                            <div class="small_title">License</div>
                            <div class="l2r" style="gap: 25px">
                                <div class="t2b" style="gap: 20px;">
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Annual Practicing MDCN License</div>
                                            <div class="cell_value">
                                                <img src="IMG/pdf2.png" alt="" class="pdf_icon <?php echo $practicing_mdcn_file[0] == '' ? 'd-none' : '' ?>">
                                                <span class="ml-5"><?php echo $practicing_mdcn_file[0] ?></span>
                                                <a class="text-primary float-right" href="HCP_FILES/<?php echo $practicing_mdcn_file[1] ?>" target="_blank"><u>View</u></a>
                                            </div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Expiry Date</div>
                                            <div class="cell_value"><?php echo $data['practicing_mdcn_expiry'] ?></div>
                                        </div>
                                    </div>
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Certificate of registration with MDCN</div>
                                            <div class="cell_value">
                                                <img src="IMG/pdf2.png" alt="" class="pdf_icon <?php echo $mdcn_registration_file[0] == '' ? 'd-none' : '' ?>">
                                                <span class="ml-5"><?php echo $mdcn_registration_file[0] ?></span>
                                                <a class="text-primary float-right" href="HCP_FILES/<?php echo $mdcn_registration_file[1] ?>" target="_blank"><u>View</u></a>
                                            </div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Expiry Date</div>
                                            <div class="cell_value"><?php echo $data['mdcn_registration_expiry'] ?></div>
                                        </div>
                                    </div>
                                    <div class="l2r">
                                        <div class="t2b cell">
                                            <div class="cell_title">Fellowship License</div>
                                            <div class="cell_value">
                                                <img src="IMG/pdf2.png" alt="" class="pdf_icon <?php echo $fellowship_license_file[0] == '' ? 'd-none' : '' ?>">
                                                <span class="ml-5"><?php echo $fellowship_license_file[0] ?></span>
                                                <a class="text-primary float-right" href="HCP_FILES/<?php echo $fellowship_license_file[1] ?>" target="_blank"><u>View</u></a>
                                            </div>
                                        </div>
                                        <div class="t2b cell">
                                            <div class="cell_title">Expiry Date</div>
                                            <div class="cell_value"><?php echo $data['fellowship_license_expiry'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="tab_container patients">

                        <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0; white-space: nowrap; background: #F9F9F9">
                            <thead>
                                <tr>
                                    <th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true" class="">S/N</th>
                                    <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Patient Name</th>
                                    <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Email Address</th>
                                    <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Cancer Type</th>
                                    <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Gender</th>
                                </tr>
                            </thead>
                            <tbody class="main_output">
                                <?php

                                global $conn;

                                $sql = "SELECT * FROM patients JOIN hospitals ON patients.hospital_id=hospitals.hospital_id JOIN users ON patients.user_id=users.user_id WHERE patients.assigned_hcp='$UID' ORDER BY users.last_active_date DESC, patients.first_name";

                                $result = $conn->query($sql);

                                $data = '<tr>
                                                            <td></td>
                                                            <td>No Patients yet :/</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>';

                                $data_count = 0;

                                $htd = '<td style="display: none">';

                                if ($result->num_rows > 0) {

                                    $data = '';
                                    $index = 0;

                                    while ($row = $result->fetch_assoc()) {

                                        ++$index;

                                        $data .= '<tr class="entry_row" id="' . $row['patient_id'] . '" user-id="' . $row['user_id'] . '" onclick="window.open(\'./PatientInfo?ID=' . $row['patient_id'] . '\', \'_self\')">
                                                                <td class="">' . $index . '</td>
                                                                <td class="">' . ucwords($row['first_name'] . ' ' . $row['last_name']) . '</td>
                                                                <td class="">' . $row['email'] . '</td>
                                                                <td class="">' . $row['cancer'] . '</td>
                                                                <td class="">' . $row['gender'] . '</td>
                                                            </tr>';
                                    }
                                }

                                echo $data;

                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab_container activity">
                    </div>
                    <!-- END PROFILE TABS -->
                </div>


                <div class="col-md-4 col-sm-12 mt-4 <?php echo isset($_SESSION['superadmin']) ? '' : 'd-none'; ?>">

                    <div class="p-4" style="background: #F9F9F9; border-radius: 10px; border: 1px solid #0000000D; text-align: left">

                        <span class="section_title">STARPIPE Overview</span>

                        <div class="chart_holder position-relative">

                            <div id="chart" style="pointer-events: none;">
    
                            </div>
                            <div class="t2b" style="color: #7A51A5;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);width: 180px;height: 180px;justify-content: center;border-radius: 300px;">
                                <span class="thisProgress font-weight-bold" style="font-size: 35px;"></span>
                                <span class="font-size-16">COMPLETED</span>
                            </div>
                        </div>


                        <span class="text-center w-100 d-block mb-4">
                            Started Course:
                            <?php
                            $sql = "SELECT start_date FROM starpipe_progress WHERE user_id=$user_id";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo $row["start_date"];
                            } else {
                                echo 'Not started yet';
                            }
                            ?>
                        </span>

                        <div class="l2r mt-2">
                            <span class="section_title">Most Recent</span>
                            <span class="section_title text-primary font-size-17">See all</span>
                        </div>

                        <div class="t2b">

                            <?php

                            $sql = "SELECT * FROM starpipe_progress WHERE user_id='$user_id'";

                            $result = mysqli_query($conn, $sql);


                            $progress = 0;
                            $progress0 = 0;
                            $progress1 = 0;
                            $progress2 = 0;
                            $progress3 = 0;
                            $progress4 = 0;
                            $progress5 = 0;
                            $progress6 = 0;

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {


                                    $module = intval($row['module']);

                                    $progress = ($module / 8) * 100;

                                    echo '<script>const s1='.$progress.'</script>';


                                    if ($module == 8) {
                                        $progress0 = 100;
                                        $progress1 = 100;
                                        $progress2 = 100;
                                        $progress3 = 100;
                                        $progress4 = 100;
                                        $progress5 = 100;
                                        $progress6 = 100;
                                    } else if ($module == 7) {
                                        $progress0 = 100;
                                        $progress1 = 100;
                                        $progress2 = 100;
                                        $progress3 = 100;
                                        $progress4 = 100;
                                        $progress5 = 100;
                                        $progress6 = 0;
                                    } else if ($module == 6) {
                                        $progress0 = 100;
                                        $progress1 = 100;
                                        $progress2 = 100;
                                        $progress3 = 100;
                                        $progress4 = 100;
                                        $progress5 = 0;
                                        $progress6 = 0;
                                    } else if ($module == 5) {
                                        $progress0 = 100;
                                        $progress1 = 100;
                                        $progress2 = 100;
                                        $progress3 = 100;
                                        $progress4 = 0;
                                        $progress5 = 0;
                                        $progress6 = 0;
                                    } else if ($module == 4) {
                                        $progress0 = 100;
                                        $progress1 = 100;
                                        $progress2 = 100;
                                        $progress3 = 0;
                                        $progress4 = 0;
                                        $progress5 = 0;
                                        $progress6 = 0;
                                    } else if ($module == 3) {
                                        $progress0 = 100;
                                        $progress1 = 100;
                                        $progress2 = 0;
                                        $progress3 = 0;
                                        $progress4 = 0;
                                        $progress5 = 0;
                                        $progress6 = 0;
                                    } else if ($module == 2) {
                                        $progress0 = 100;
                                        $progress1 = 0;
                                        $progress2 = 0;
                                        $progress3 = 0;
                                        $progress4 = 0;
                                        $progress5 = 0;
                                        $progress6 = 0;
                                    } else if ($module == 1) {
                                        $progress0 = 25;
                                        $progress1 = 0;
                                        $progress2 = 0;
                                        $progress3 = 0;
                                        $progress4 = 0;
                                        $progress5 = 0;
                                        $progress6 = 0;
                                    }
                                }
                            }else{
                                echo '<script>const s1=0</script>';
                            }
                            ?>
                            <div class="l2r w-100" style=" border-bottom: 1px solid #0000001F; ">
                                <span class="entry_logger">Pre Module</span>
                                <div class="circular_progress progress_<?php echo $progress0; ?>" style=" transform: scale(0.7); ">
                                    <?php echo $progress0; ?>%
                                </div>
                            </div>
                            <div class="l2r w-100" style=" border-bottom: 1px solid #0000001F; ">
                                <span class="entry_logger">Module 1</span>
                                <div class="circular_progress progress_<?php echo $progress1; ?>" style=" transform: scale(0.7); ">
                                    <?php echo $progress1; ?>%
                                </div>
                            </div>
                            <div class="l2r w-100" style=" border-bottom: 1px solid #0000001F; ">
                                <span class="entry_logger">Module 2</span>
                                <div class="circular_progress progress_<?php echo $progress2; ?>" style=" transform: scale(0.7); ">
                                    <?php echo $progress2; ?>%
                                </div>
                            </div>
                            <div class="l2r w-100" style=" border-bottom: 1px solid #0000001F; ">
                                <span class="entry_logger">Module 3</span>
                                <div class="circular_progress progress_<?php echo $progress3; ?>" style=" transform: scale(0.7); ">
                                    <?php echo $progress3; ?>%
                                </div>
                            </div>
                            <div class="l2r w-100" style=" border-bottom: 1px solid #0000001F; ">
                                <span class="entry_logger">Module 4</span>
                                <div class="circular_progress progress_<?php echo $progress4; ?>" style=" transform: scale(0.7); ">
                                    <?php echo $progress4; ?>%
                                </div>
                            </div>
                            <div class="l2r w-100" style=" border-bottom: 1px solid #0000001F; ">
                                <span class="entry_logger">Module 5</span>
                                <div class="circular_progress progress_<?php echo $progress5; ?>" style=" transform: scale(0.7); ">
                                    <?php echo $progress5; ?>%
                                </div>
                            </div>
                            <div class="l2r w-100">
                                <span class="entry_logger">Post Module</span>
                                <div class="circular_progress progress_<?php echo $progress6; ?>" style=" transform: scale(0.7); ">
                                    <?php echo $progress6; ?>%
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

    <?php include('Commons/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="JS/Patients.js"></script>

    <script>

        $('.thisProgress').text((s1 || 0)+'%')
        var options = {
            series: [(s1 || 0), 100-(s1 || 0)],
            colors: ['#7A51A5', '#CFD8DC'],
            chart: {
                type: 'donut',
            },
            dataLabels: {
          enabled: false
        },

            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom',
                        show: false
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        $('.S-Doctors').addClass('mm-active').find('a').addClass('active')

        $('.action_button.decline').on('click', function() {
            Swal.fire({
                title: 'Deactivate Doctor',
                html: 'Dr. <?php echo $data['first_name'] . ' ' . $data['last_name'] ?> will be deactivated.',
                type: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Deactivate',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? actionHCP('Deactivate') : t.dismiss === Swal.DismissReason.cancel
            })
        })

        $('.action_button.accept').on('click', function() {
            Swal.fire({
                title: 'Activate Doctor',
                html: 'Dr. <?php echo $data['first_name'] . ' ' . $data['last_name'] ?> will be activated.',
                type: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Activate',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? actionHCP('Activate') : t.dismiss === Swal.DismissReason.cancel
            })
        })

        function actionHCP(type) {

            Swal.fire({
                title: 'Processing',
                onBeforeOpen: function() {
                    Swal.showLoading()
                }
            })

            $.ajax({
                async: false,
                url: './API/api_activate_deactivate_hcp.php?type=' + type + '&id=' + <?php echo $user_id ?>,
                type: 'POST',
                success: function(data) {
                    if (data == 1) {
                        $('.action_button.accept,.action_button.decline').toggleClass('d-none')
                        s(type + 'd successfully')
                    } else {
                        console.log('Failed here')
                        e(data)
                    }
                },
                fail: function(data) {
                    e(data.statusText)
                },
                error: function(data) {
                    e(data.statusText)
                }
            })


            function s(s) {
                Swal.fire({
                    title: s,
                    type: 'success'
                })
            }

            function e(e) {
                console.log(e)
                Swal.fire({
                    title: 'Oops',
                    html: e,
                    type: 'error'
                })
            }
        }
    </script>

    </body>

    </html>
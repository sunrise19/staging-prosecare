<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Patients";
include('Commons/header.php');
include('../STATIC_API/Config.php');
if (!isset($_SESSION["superadmin"])) {
    header('location: Home');
}
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style id="dynamic_style"></style>


<div class="main-content">

    <div class="page-content p-4">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="l2r">
                <div class="page-title-box d-flex align-items-center justify-content-between l2r w-100">
                    <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Patients</h2>
                    <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                        <img src="../assets/images/Calendar2.svg" alt="">
                        <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                            <?php echo date("M d, Y"); ?>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row <?php echo isset($_SESSION['superadmin']) ? '' : 'd-none'; ?>">

                <div class="col-md-6 col-sm-12" onclick="location.href = './Patients'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Patients Onboarded</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM patients";
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

                <div class="col-md-6 col-sm-12" onclick="location.href = './Patients'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Active Patients</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM sideeffects RIGHT JOIN patients ON sideeffects.patient_id=patients.patient_id GROUP BY sideeffects.patient_id";
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

            <div class="l2r mb-4" style="gap: 30px">
                <div class="prose_dropdown l2r">
                    <select class="prose_select">
                        <option value="ASC">Newest to oldest</option>
                        <option value="DESC">Oldest to newest</option>
                    </select>
                    <i class="bx bx-chevron-down"></i>
                </div>
                <!-- start search -->
                <div class="search-box chat-search-box py-4" style=" padding: 0 !important; flex: 1 ">
                    <div class="position-relative">
                        <input type="text" class="form-control find_contact" placeholder="Search Patients">
                        <i class="mdi mdi-magnify search-icon"></i>
                    </div>
                </div>
                <!-- end search -->
                <button class="btn btn-primary btn-lg l2r" style="border-radius: 30px !important; padding: 13px 24px !important" onclick="window.location.href = 'Create-Patient?From=Hospital-Patients'">
                    <i class="bx bx-plus-circle mr-2 font-size-18"></i>
                    Add New
                </button>
            </div>

            <div class="row main_table">
                <div class="col-12 table-col">
                    <div class="card">
                        <div class="actions_holder d-none">
                            <!-- <button class="btn-info exportToPDF noprint toggle_data" style="margin-right:10px">Hide Data</button> -->
                            <button class="btn-info noprint toggle_data" style="margin-right:10px">Toggle Data</button>
                            <button class="btn-success exportToExcel noprint" style="right: 16.5rem;top: 1.5rem;">Export To Spreadsheet</button>
                        </div>
                        <div class="card-body py-0" style="background: #F9F9F9; border: 1px solid #8D2D921F; border-radius: 10px;">

                            <table data-cols-width="15,30,35,20,5,10,20,22,25,25,25,35,25,25,35" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0; white-space: nowrap; background: #F9F9F9">
                                <thead>
                                    <tr>
                                        <th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true" class="">S/N</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Patient Name</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Email Address</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Hospital</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">HCP Assigned To</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Cancer Type</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Gender</th>
                                    </tr>
                                </thead>
                                <tbody class="main_output">
                                    <?php

                                    global $conn;
                                    
                                    $hospital_id = $_SESSION['hospital_id'];
                                    
                                    if(isset($_SESSION['superadmin'])){
                                        $sql = "SELECT * FROM patients LEFT JOIN hospitals ON patients.hospital_id=hospitals.hospital_id JOIN users ON patients.user_id=users.user_id ORDER BY users.last_active_date DESC, patients.first_name";
                                    }else{
                                        $sql = "SELECT * FROM patients JOIN hospitals ON patients.hospital_id=hospitals.hospital_id JOIN users ON patients.user_id=users.user_id WHERE hospitals.hospital_id='$hospital_id'  ORDER BY users.last_active_date DESC, patients.first_name";
                                    }
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

                                            $email = $row["email"];
                                            $category = ucfirst($row["user_type"]);
                                            $lastActive = $row['last_active_date'] != '' ? $row['last_active_date'] . ' at ' . strtoupper($row['last_active_time']) : '<span style="color: #f44336">Inactive</span>';

                                            $assigned_hcp = $row['assigned_hcp'];

                                            if ($assigned_hcp != 0) {
                                                $sqlDoc = "SELECT * FROM hcp WHERE hcp_id='$assigned_hcp'";
                                                $resultDoc = $conn->query($sqlDoc);
                                                if ($resultDoc->num_rows > 0) {
                                                    while ($rowDoc = $resultDoc->fetch_assoc()) {
                                                        $assigned_hcp = ucwords('Dr. ' . $rowDoc['first_name'] . ' ' . $rowDoc['last_name']);
                                                    }
                                                }
                                            } else {
                                                $assigned_hcp = '-';
                                            }

                                            $hospital = $row['hospital_id'];

                                            if($hospital != 0){
                                                $sqlHos = "SELECT * FROM hospitals WHERE hospital_id = '$hospital'";
                                                $resultHos = $conn->query($sqlHos);
                                                if ($resultHos->num_rows > 0){
                                                    while($rowHos = $resultHos->fetch_assoc()){
                                                        $hospital = ucwords($rowHos['name']);
                                                    }
                                                }

                                            } else{
                                                $hospital = '-';
                                            }

                                            $data .= '<tr class="entry_row" id="' . $row['patient_id'] . '" user-id="' . $row['user_id'] . '" onclick="window.open(\'./PatientInfo?ID=' . $row['patient_id'] . '&From=Hospital-Patients\', \'_self\')">
                                                                    <td class="as_fixed white serial_number">' . $index . '</td>
                                                                    <td class="">' . ucwords($row['first_name'] . ' ' . $row['last_name']) . '</td>
                                                                    <td class="">' . $row['email'] . '</td>
                                                                    <td class="">' . $hospital . '</td>
                                                                    <td class="">' . $assigned_hcp . '</td>
                                                                    <td class="">' . $row['cancer'] . '</td>
                                                                    <td class="">' . $row['gender'] . '</td>
                                                                </tr>';
                                        }
                                    }


                                    echo $data;

                                    $conn->close();

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="hcp_frame_back">
                <iframe src="" frameborder="0" allow="camera; microphone" id="hcp_frame"></iframe>
                <button class="btn-primary hcp_frame_close">&larr; Back</button>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php include('Commons/footer.php'); ?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="Commons/excel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="JS/Patients.js"></script>

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
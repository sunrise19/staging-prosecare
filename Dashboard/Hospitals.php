<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Hospitals";
include('Commons/header.php');
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
                    <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Hospitals</h2>
                    <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                        <img src="../assets/images/Calendar2.svg" alt="">
                        <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                            <?php echo date("M d, Y"); ?>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end page title -->

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
                        <input type="text" class="form-control find_contact" placeholder="Search Hospitals">
                        <i class="mdi mdi-magnify search-icon"></i>
                    </div>
                </div>
                <!-- end search -->
                <button class="btn btn-primary btn-lg l2r" style="border-radius: 30px !important; padding: 13px 24px !important" onclick="window.location.href = 'Create-Hospital?From=Hospitals'">
                    <i class="bx bx-plus-circle mr-2 font-size-18"></i>
                    Create New
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

                            <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0; white-space: nowrap; background: #F9F9F9">
                                <thead>
                                    <tr>
                                        <th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true" class="as_fixed white">S/N</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Name</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">No of HCPs</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">No of Patients</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Email Address</th>
                                        <th class="" data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Date Created</th>
                                    </tr>
                                </thead>
                                <tbody class="main_output">
                                    <?php

                                    include('../STATIC_API/Config.php');

                                    global $conn;

                                    // $sql = 'SELECT * FROM hospitals JOIN users ON hospitals.user_id=users.user_id ';

                                    $sql = '
                                    SELECT 
                                        h.*,
                                        IFNULL(patients.total_patients, 0) AS total_patients,
                                        IFNULL(hcp.total_hcp, 0) AS total_hcp,
                                        u.*
                                    FROM 
                                        hospitals h
                                    LEFT JOIN 
                                        (SELECT hospital_id, COUNT(*) AS total_patients 
                                        FROM patients 
                                        GROUP BY hospital_id) patients 
                                    ON h.hospital_id = patients.hospital_id
                                    LEFT JOIN 
                                        (SELECT hospital, COUNT(*) AS total_hcp 
                                        FROM hcp 
                                        GROUP BY hospital) hcp 
                                    ON h.hospital_id = hcp.hospital
                                    LEFT JOIN
                                        users u
                                    ON h.user_id=u.user_id
                                    ';

                                    $result = $conn->query($sql);

                                    $data = '<tr>
                                                        <td></td>
                                                        <td>No Hospitals yet :/</td>
                                                        <td></td>
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

                                            $data .= '<tr class="entry_row" id="' . $row['hcp_id'] . '" user-id="' . $row['user_id'] . '" onclick="window.open(\'./HospitalInfo?ID=' . $row['user_id'] . '\', \'_self\')">
                                                            <td class="">' . $index . '</td>
                                                            <td class="">' . ucwords($row['name']) . '</td>
                                                            <td class="">' . $row['total_hcp'] . '</td>
                                                            <td class="">' . $row['total_patients'] . '</td>
                                                            <td class="">' . $row['email'] . '</td>
                                                            <td class="">' . $row['signup_date'] . '</td>
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
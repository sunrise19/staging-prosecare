<?php 
    error_reporting(1); 
    ini_set('display_errors', 1);
    session_start(); 
    $TITLE = "Quality Of Life Survey Results"; 
    include('Commons/header.php');
    if(!isset($_SESSION["superadmin"])){
        header('location: Home');
    }
    $UID = $_REQUEST["ID"];
    
?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <style id="dynamic_style"></style>


        <div class="main-content">

            <div class="page-content p-4">
                <div class="container-fluid">

                    <div class="l2r">
                        <i onclick="window.location.href='./Patients'" class="bx bx-left-arrow-alt mb-4" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>

                        <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                            <img src="../assets/images/Calendar2.svg" alt="">
                            <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                                <?php echo date("M d, Y"); ?>
                            </span>
                        </div>
                    </div>

                    <div class="l2r my-3">

                        <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Quality Of Life Survey Results</h2>
    
                        <!-- <button class="btn btn-primary btn-lg l2r" style="border-radius: 30px !important; padding: 13px 24px !important" onclick="window.location.href = 'Create-Notification?From=Notifications'">
                            <i class="bx bx-plus-circle mr-2 font-size-18"></i>
                            Send New
                        </button> -->


                    </div>

                    
                    <div class="row main_table mt-4">
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
                                                <th>S/N</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody class="main_output">
                                            <?php

                                                include('../STATIC_API/Config.php');

                                                global $conn;
                                                
                                                $sql = "SELECT * FROM qol WHERE patient_id = $UID";

                                                $result = $conn->query($sql);

                                                $data = '<tr>
                                                        <td>No results yet :/</td>
                                                        <td></td>
                                                        <td></td>
                                                        </tr>';

                                                $index = 0;

                                                if ($result->num_rows > 0) {

                                                    $data = '';

                                                    while($row = $result->fetch_assoc()) {

                                                        ++$index;
                                                        
                                                        $data .= '<tr class="entry_row" id="'.$row['qol_id'].'" onclick="window.open(\'./QualityOfLifeResultInfo?ID='.$row['qol_id'].'\', \'_self\')">
                                                                    <td>'.$index.'</td>
                                                                    <td class="">'.$row['date_added'].'</td>
                                                                    <td class="">'.$row['time_added'].'</td>
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

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
    
    <?php include('Commons/footer.php');?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="Commons/excel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="JS/Patients.js"></script>

    <script>
        $('.S-Hospital-Patients').addClass('mm-active').find('a').addClass('active')
    </script>

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
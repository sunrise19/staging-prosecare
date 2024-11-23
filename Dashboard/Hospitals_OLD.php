<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Hospitals"; 
    include('Commons/header.php');  
    if(!isset($_SESSION["superadmin"])){
        header('location: Home');
    }
?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <style id="dynamic_style"></style>

    <style>
        .shower {
            width: 200px;
            position: absolute;
            right: 30em;
            top: 26px;
            font-weight: 500;
        }

        .form-control.error,.form-select.error {
            border-color: #f44336;
        }

        .blue{
            background: #556ee6;
        }
        .blue:hover,.blue:focus{
            background: #3452e1;
        }
        

        .input_item.picked,.input_item.picked:hover {
            color: #fff;
            background-color: #34c38f;
        }

        .input_item {
            background: #eee;
            display: none;
            padding: 9px 18px;
            margin: 0 5px 13px 0;
            border-radius: 9px;
            cursor: pointer;
            transition: 0.3s;
        }

        .input_item:hover {
            background: #ddd;
        }

        .output {
            background: #fff;
            border: 1px solid #ced4d9;
            border-radius: 5px;
            padding: 12px 10px;
            position: relative;
            overflow: hidden;
        }

        .output_dropdown {
            color: #000;
            font-size: 22px;
            position: absolute;
            right: 6px;
            background: #eee;
            padding: 4px;
            border-radius: 3px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .output_dropdown:hover{
            background: #ddd
        }

        div.input {
            border: 1px solid #ced4d8;
            padding: 12px 12px 0;
            margin-top: -3px;
            z-index: 1;
            position: relative;
            background: #fff;
            border-radius: 0 0 5px 5px;
            border-top-style: dashed;
        }

        .output_data {
            display: inline-block;
            background: #eee;
            font-size: 12px;
            padding: 3px 6px;
            margin-right: 10px;
            border-radius: 8px;
        }

        .output_contents {
            white-space: nowrap;
            overflow: auto;
            position: absolute;
            top: calc(50% - 12px);
            width: calc(100% - 58px);
            padding-bottom: 19px;
            color: #495057;
        }

        .remove_data {
            background: #ccc;
            margin-left: 6px;
            font-size: 14px;
            transform: translateY(2px);
            cursor: pointer;
            border-radius: 4px;
        }

        .remove_data:hover {
            background: #f44336;
            color: #fff
        }

        .email_input {
            width: 100%;
            border: none;
            outline: none !important;
            margin-bottom: 10 px;
            border: 1px dashed #ccc;
            padding: 7px 8px;
            border-radius: 5px;
            margin-bottom: 10px
        }

        table{
            font-size: 14px !important;
        }

        .modal-body .form-group {
            margin-bottom: 6px;
            margin-top: 25px;
        }

        .modal-body .form-group:first-of-type {
            margin-top: 0;
        }

        .modal-body .form-group.col-6:first-of-type {
            margin-top: 25px !important;
        }

        #hcp_frame {
            width: calc(100% - 297px);
            height: calc(100% - 210px);
            position: absolute;
            border-radius: 10px;
        }

        .hcp_frame_back{
            width: auto;
            height: auto;
            display: none;
        }

        .hcp_frame_close {
            font-weight: 500;
            letter-spacing: 1px;
            position: fixed;
            left: 60%;
            transform: translateX(-50%);
            bottom: 15px;
            padding: 11px 30px !important;
        }

    </style>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18 snt">Hospitals</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?php echo $TITLE; ?></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->                    
                    
                    <div class="row main_table">
                        <div class="col-12 table-col">
                            <div class="card">
                                <div class="card-body">

                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>CADRE</th>
                                                <th>LOCATION</th>
                                                <th style=" width: 140px; ">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="main_output">
                                            <?php

                                                include('../STATIC_API/Config.php');
                                                
                                                $sql = 'SELECT * FROM hospitals';

                                                $result = $conn->query($sql);

                                                $data = '<tr>
                                                        <td></td>
                                                        <td>No Hospitals yet :/</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        </tr>';

                                                $data_count = 0;

                                                $htd = '<td style="display: none">';

                                                if ($result->num_rows > 0) {

                                                    $data = '';

                                                    while($row = $result->fetch_assoc()) {

                                                        $zeros = '';
                                                        for($i = 0; $i < (3 - strlen($row['hospital_id'])); $i++){
                                                            $zeros .= '0';
                                                        }

                                                        $data .= '<tr class="entry_row" id="'.$row['hospital_id'].'" user-id="'.$row['user_id'].'">
                                                                    <td>HPT / '.$zeros.$row['hospital_id'].'</b></td>
                                                                    <td>'.$row['name'].'</td>
                                                                    <td>'.$row['cadre'].'</td>
                                                                    <td>'.$row['state'].'</td>
                                                                    <td style="padding: 0;"><button id="'.$row['user_id'].'" class="btn-warning view-data" style="margin-right: 12px"><i class="bx bx-show-alt font-size-16 align-middle"></i></button><button class="btn-danger delete-data"><i class="bx bx-trash font-size-16 align-middle"></i></button></td>
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
                        <button class="btn-primary blue hcp_frame_close">CLOSE</button>
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
    
    <?php include('Commons/footer.php');?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="JS/Hospitals.js"></script>


</body>

</html>
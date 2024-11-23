<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "HCP"; 
    include('Commons/header.php');  
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
            height: calc(100% - 160px);
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
            /* letter-spacing: 1px; */
            position: fixed;
            left: 55%;
            transform: translateX(-50%);
            top: 84px;
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
                                <h4 class="mb-0 font-size-18 snt">Health Care Professionals</h4>
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

                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0; white-space: nowrap;">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>NAME</th>
                                                <th>EMAIL</th>
                                                <th>PHONE</th>
                                                <th>AGE</th>
                                                <th>GENDER</th>
                                                <th>HOSPITAL</th>
                                                <th>SPECIALTY</th>
                                                <!-- <th>MANAGING TEAM</th> -->
                                                <th>LAST TIME ACTIVE</th>
                                                <th style=" width: 140px; ">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="main_output">
                                            <?php

                                                // ini_set('display_errors', '1');
                                                // ini_set('display_startup_errors', '1');
                                                // error_reporting(E_ALL);

                                                include('../STATIC_API/Config.php');

                                                global $conn;
                                                
                                                $sql = 'SELECT * FROM hcp';

                                                $result = $conn->query($sql);

                                                $data = '<tr>
                                                        <td></td>
                                                        <td>No HCP yet :/</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        </tr>';

                                                $data_count = 0;

                                                $htd = '<td style="display: none">';

                                                if ($result->num_rows > 0) {

                                                    $data = '';

                                                    $i = 0;

                                                    while($row = $result->fetch_assoc()) {
                                                        
                                                        // $zeros = '';
                                                        // for($i = 0; $i < (3 - strlen($row['hcp_id'])); $i++){
                                                        //     $zeros .= '0';
                                                        // }

                                                        $_uid = $row['user_id'];
                                                        $email = '';
                                                        $lastActive = '';

                                                        $_sql = "SELECT * FROM users WHERE user_id='$_uid'";
                                                        $_result = $conn->query($_sql);
                                                        if ($_result->num_rows > 0) {
                                                            while($_row = $_result->fetch_assoc()) {
                                                                $email = $_row["email"];
                                                                $lastActive = $_row['last_active_date']. ' at ' . strtoupper($_row['last_active_time']);
                                                            }
                                                        }

                                                        $data .= '<tr class="entry_row" id="'.$row['hcp_id'].'" user-id="'.$row['user_id'].'">
                                                                    <td>'.(++$i).'</td>
                                                                    <td>'.ucwords($row['first_name']. ' ' . $row['last_name']).'</td>
                                                                    <td>'.$email.'</td>
                                                                    <td>'.$row['code']. $row['phone'].'</td>
                                                                    <td>'.getAge(date('Y-m-d', strtotime($row['day'] . ' ' . $row['month'] . ' ' . $row['year']))).'</td>
                                                                    <td>'.$row['gender'].'</td>
                                                                    <td>'.$row['hospital'].'</td>
                                                                    <td>'.$row['specialty'].'</td>
                                                                    <td>'.$lastActive.'</td>
                                                                    <td data-exclude="true"><p id="'.$row['user_id'].'" class="text-primary view-data" data-name="'.ucwords($row['first_name']. ' ' . $row['last_name']).'" style="cursor: pointer"><u>View More</u></p></td>
                                                                </tr>';   
                                                        
                                                    }

                                                    
                                                    
                                                }
                                                
                                                function getAge($date){
                                                    
                                                    $dob = new DateTime($date);
                                                    
                                                    $now = new DateTime();
                                                    
                                                    $difference = $now->diff($dob);
                                                    
                                                    $age = $difference->y;
                                                    
                                                    return  $age;
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
                        <button class="btn-primary hcp_frame_close">&larr; BACK</button>
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
    
    <?php include('Commons/footer.php');?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="JS/HCP.js"></script>


</body>

</html>
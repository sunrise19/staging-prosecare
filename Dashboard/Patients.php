<?php 
    error_reporting(1); 
    ini_set('display_errors', 1);
    session_start(); 
    $TITLE = "Patients"; 
    include('Commons/header.php');
    if(isset($_SESSION["hospital"]) || isset($_SESSION['superadmin'])){
        echo '<script>window.location.href="Hospital-Patients"</script>';
    }  
    if(!isset($_SESSION["superadmin"])){
        header('location: Home');
    }

    $hcp_id = $_SESSION["hcp_id"];
    
?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <style id="dynamic_style"></style>


        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row col-12">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Patients</h2>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->         
                    
                    <div class="l2r mb-4" style="gap: 30px">
                        <!-- start search -->
                        <div class="search-box chat-search-box py-4" style=" padding: 0 !important; flex: 1 ">
                            <div class="position-relative">
                                <input type="text" class="form-control find_contact" placeholder="Search Patients">
                                <i class="mdi mdi-magnify search-icon"></i>
                            </div>
                        </div>
                        <!-- end search -->
                        <div class="prose_dropdown l2r">
                            Sort By: 
                            <select class="prose_select" data-default="<?php echo $_REQUEST['SORT']?>" onchange="updateURLWithSort(this.value)">
                                <option value="USERS.USER_ID ASC">Newest to oldest</option>
                                <option value="USERS.USER_ID DESC">Oldest to newest</option>
                            </select>
                            <i class="bx bx-chevron-down"></i>
                        </div>
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
                                                <th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true" class="as_fixed white">S/N</th>
                                                <th data-exclude="true" style="min-width: 70px;">&nbsp;&nbsp;&nbsp;</th>
                                                <!-- <th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">PIN</th> -->
                                                <th onclick="updateURLWithSort('PATIENTS.FIRST_NAME')">Full Name</th>
                                                <th onclick="updateURLWithSort('PATIENTS.AGE')">Age</th>
                                                <th onclick="updateURLWithSort('PATIENTS.GENDER')">Gender</th>
                                                <th >Cancer Type</th>
                                                <th >Hospital</th>
                                                <!-- <th >Managing Team</th> -->
                                                <th >Last Logged Side Effects</th>
                                                <!-- <th >Last Logged Chemotherapy</th>
                                                <th >Last Logged Radiotherapy</th>
                                                <th >Last Logged Treatment Interruption</th>
                                                <th >Last Logged Surgery</th>
                                                <th >Last Logged Medication</th>
                                                <th >Last Time Active</th>
                                                <th data-exclude="true" style=" width: 100px; ">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="main_output">
                                            <?php

                                                // ini_set('display_errors', '1');
                                                // ini_set('display_startup_errors', '1');
                                                // error_reporting(E_ALL);

                                                include('../STATIC_API/Config.php');

                                                global $conn;

                                                $sort = $conn->real_escape_string($_REQUEST['SORT']);

                                                if($sort != ''){
                                                    $sort = $sort . ', ';
                                                }
                                                
                                                // $sql = 'SELECT * FROM patients JOIN hospitals ON patients.hospital_id=hospitals.hospital_id JOIN users ON patients.user_id=users.user_id  ORDER BY users.last_active_date DESC, patients.first_name';
                                                $sql = 'SELECT * FROM patients JOIN hospitals ON patients.hospital_id=hospitals.hospital_id JOIN users ON patients.user_id=users.user_id WHERE patients.assigned_hcp="'.$hcp_id.'" ORDER BY '.$sort.' patients.first_name';

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
                                                    $inactiveData = '';
                                                    $index = 0;

                                                    while($row = $result->fetch_assoc()) {

                                                        ++$index;

                                                        // $zeros = '';
                                                        // for($i = 0; $i < (3 - strlen($row['patient_id'])); $i++){
                                                        //     $zeros .= '0';
                                                        // }

                                                        $email = $row["email"];
                                                        $category = ucfirst($row["user_type"]);
                                                        $lastActive = $row['last_active_date'] != '' ? $row['last_active_date']. ' at ' . strtoupper($row['last_active_time']) : '<span style="color: #f44336">Inactive</span>';
                                                        

                                                        // <td>PAT / '.$zeros.$row['patient_id'].'</b></td>
                                                        // <td style="padding: 0;"><button id="'.$row['user_id'].'" class="btn-warning view-data" style="margin-right: 12px"><i class="bx bx-show-alt font-size-16 align-middle"></i></button><button class="btn-danger delete-data"><i class="bx bx-trash font-size-16 align-middle"></i></button></td>
                                                        $NEW_DATA = '<tr class="entry_row" id="'.$row['patient_id'].'" user-id="'.$row['user_id'].'" onclick="window.open(\'./PatientInfo?ID='.$row['patient_id'].'\', \'_self\')">
                                                                    <td class="as_fixed white serial_number">'.$index.'</td>
                                                                    <td data-exclude="true">&nbsp;&nbsp;&nbsp;</td>';
                                                                    // <td><b>'.$row['pin'].'</b></td>';
                                                                    
                                                                    if($_SESSION["type"] != 'hcp_123'){
                                                                        $NEW_DATA .= '<td class="">'.ucwords($row['first_name']. ' ' . $row['last_name']).'</td>';
                                                                                    //   <td class="s_toggle">'.$email.'</td>
                                                                                    //   <td class="s_toggle">'.$row['code']. $row['phone'].'</td>';

                                                                    }
                                                        $NEW_DATA .= '<td class="">'.$row['age'].'</td>
                                                                    <td class="">'.$row['gender'].'</td>
                                                                    <td class="">'.$row['cancer'].'</td>
                                                                    <td class="">'.ucwords(strtolower($row['name'])).'</td>
                                                                    <td class="">'.isLogged($conn, 'sideeffects', $row['user_id'], 'sideeffects_id').'</td>
                                                                    <td class="s_toggle">'.isLogged($conn, 'chemotherapy', $row['user_id'], 'chemotherapy_id').'</td>
                                                                    <td class="s_toggle">'.isLogged($conn, 'radiotherapy', $row['user_id'], 'radiotherapy_id').'</td>
                                                                    <td class="s_toggle">'.isLogged($conn, 'interruptions', $row['user_id'], 'interruption_id').'</td>
                                                                    <td class="s_toggle">'.isLogged($conn, 'surgery', $row['user_id'], 'surgery_id').'</td>
                                                                    <td class="s_toggle">'.isLogged($conn, 'medications', $row['user_id'], 'medication_id').'</td>
                                                                    <td class="s_toggle">'.$lastActive.'</td>
                                                                    <!--<td data-exclude="true"><p id="'.$row['user_id'].'" class="text-primary view-data" data-name="'.ucwords($row['first_name']. ' ' . $row['last_name']).'" style="cursor: pointer"><u>View More</u></p></td>-->
                                                                </tr>';

                                                        if($lastActive){
                                                            $lastActive == '<span style="color: #f44336">Inactive</span>' ? $inactiveData .= $NEW_DATA : $data .= $NEW_DATA;
                                                        }
                                                        
                                                    }

                                                }

                                                function isLogged($conn, $which, $user_id, $which_id){
                                                    $sql = "SELECT * FROM ".$which." WHERE user_id = '$user_id' ORDER BY ".$which_id." DESC";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            return $row['date_added'];
                                                        }
                                                    }else{
                                                        return '<span style="color: #f44336">-</span>';
                                                    }
                                                    
                                                }

                                                echo $data . $inactiveData;

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
    
    <?php include('Commons/footer.php');?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="Commons/excel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="JS/Patients.js"></script>

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
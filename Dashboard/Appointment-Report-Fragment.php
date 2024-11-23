<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Consultation Summary"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');

    $hcp_id = $_SESSION['hcp_id'];
    $patient_id = $_SESSION['patient_id'];
    $appointment_id = $_REQUEST['id'];

    $where = "patients on appointments.patient_id=patients.patient_id WHERE hcp_id='$hcp_id'";
    
    if($_SESSION['type'] == 'patient'){
        $where = "hcp on appointments.hcp_id=hcp.hcp_id WHERE patient_id='$patient_id'";
    }

    $sql = "SELECT * FROM appointments JOIN ".$where." AND appointments.appointment_id='$appointment_id'";
                    
    $result = mysqli_query($conn, $sql);
    
    $data;

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data = $row;
        }
    }

    echo '<script>const APPOINTMENT_ID='.$appointment_id.', HCP_ID='.$data['hcp_id'].', PATIENT_ID='.$data['patient_id'].'</script>';
?>

<style>
    #page-topbar,.vertical-menu{
        display: none;
    }
    .main-content, .page-content,.container-fluid{
        margin: 0;
        padding: 0
    }
    .se_title {
        margin-bottom: 10px;
        display: block;
        font-weight: 500;
    }
    body{
        background: #F9F9F9;
    }
    textarea.se_status{
        min-height: 200px;
        max-height: 350px !important;
        border-radius: 10px;
        font-size: 16px;
        outline: none !important;
    }
</style>


        <div class="main-content">

            <div class="t2b mt-3 mb-5" style="gap: 20px">
                <div class="l2r arf_header">
                    <div class="cell_title">Date:</div>
                    <div class="cell_value"><?php echo $data['date']; ?></div>
                </div>
                <div class="l2r arf_header">
                    <div class="cell_title">Patient's Full Name:</div>
                    <div class="cell_value">
                        <?php echo $_SESSION['type'] == 'patient' ? $_SESSION["name"] : $data['first_name'] . ' ' . $data['last_name']; ?>
                    </div>
                </div>
                <div class="l2r arf_header">
                    <div class="cell_title">Doctor's Full Name:</div>
                    <div class="cell_value"> Dr. 
                        <?php  echo $_SESSION['type'] == 'patient' ? $data['first_name'] . ' ' . $data['last_name'] : $_SESSION["name"]; ?>
                    </div>
                </div>

            </div>

            <?php

                $sql = "SELECT * FROM reports WHERE appointment_id='$appointment_id'";
                                    
                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {
                    $i = 0;
                    while($row = $result->fetch_assoc()) {
                        ++$i;
                        echo '
                            <div>
                                <div class="start_new_chat open_report p-3 mb-3">
                                    <b>Report '.$i.'</b> <span style="flex: 1; text-align: right; padding-right: 20px">'.$row['date'].' &bull; '.strtoupper($row['time']).'</span>
                                    <i class="bx bx-plus-circle"></i>
                                </div>
                                <div class="t2b d-none report_details" style="justify-content: start; gap: 35px">
                                    <div class="w-100">
                                        <span class="se_title">Patient Complaint</span>
                                        <textarea class="se_status patient_complaint" readonly>'.$row['patient_complaint'].'</textarea>
                                    </div>
                                    <div class="w-100">
                                        <span class="se_title">Observations</span>
                                        <textarea class="se_status observations" readonly>'.$row['observations'].'</textarea>
                                    </div>
                                    <div class="w-100">
                                        <span class="se_title">Diagnosis</span>
                                        <textarea class="se_status diagnosis" readonly>'.$data['diagnosis'].'</textarea>
                                    </div>
                                    <div class="w-100">
                                        <span class="se_title">Prescription</span>
                                        <div class="side_effect_group prescriptions_list">';

                                                $prescriptionJSON = json_decode($row['prescription'], true);

                                                if ($prescriptionJSON === null && json_last_error() !== JSON_ERROR_NONE) {
                                                    //echo '<span class="se_status">No prescription given</span>';
                                                }else{
                                                    $i = 0;
                                                    $count = count($prescriptionJSON);
                                                    $style = '';
                                                    $contentEditable = 'contenteditable="true"';

                                                    foreach ($prescriptionJSON as $entry) {
                                                        if($i > 0 && $i < $count){
                                                            $style = 'bordered';
                                                        }
                                                        $i++;
                                                        echo '<div class="prescription_item '.$style.'">
                                                                <div class="l2r" style="gap: 20px;">
                                                                    <div class="t2b w-100">
                                                                        <span class="se_title">Dosage Form</span>
                                                                        <span class="se_status dosage_form">'.$entry['dosage_form'].'</span>
                                                                    </div>
                                                                    <div class="t2b w-100">
                                                                        <span class="se_title">Drug Name</span>
                                                                        <span class="se_status drug_name">'.$entry['drug_name'].'</span>
                                                                    </div>
                                                                    <div class="t2b w-100">
                                                                        <span class="se_title">Drug Strength</span>
                                                                        <span class="se_status drug_strength">'.$entry['drug_strength'].'</span>
                                                                    </div>
                                                                </div>
                                                                <div class="l2r" style="gap: 20px">
                                                                    <div class="t2b w-100">
                                                                        <span class="se_title">Frequency</span>
                                                                        <span class="se_status frequency">'.$entry['frequency'].'</span>
                                                                    </div>
                                                                    <div class="t2b w-100">
                                                                        <span class="se_title">Duration</span>
                                                                        <span class="se_status duration">'.$entry['duration'].'</span>
                                                                    </div>
                                                                    <div class="t2b w-100">
                                                                    </div>
                                                                </div>
                                                            </div>'
                                                            ;
                                                    }
                                                }

                                        echo  '</div>
                                    </div>
                                    <div class="w-100">
                                        <span class="se_title">Recommended Tests</span>
                                        <textarea class="se_status recommended_tests" readonly>'.$data['recommended_tests'].'</textarea>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }

            ?>
            
            <div class="t2b <?php echo $_SESSION['type'] == 'patient' ? 'd-none' : ''; ?>" style="justify-content: start; gap: 35px;">
                <span style="
                        text-transform: uppercase;
                        font-weight: 600;
                        color: #000;
                        font-size: 34px;
                        width: 100%;
                        text-align: center;
                        border-top: 3px dashed #777;
                        padding-top: 30px;
                        margin-top: 30px;
                    ">
                    New Report
                </span>
                <div class="w-100">
                    <span class="se_title">Patient Complaint</span>
                    <textarea class="se_status patient_complaint"></textarea>
                </div>
                <div class="w-100">
                    <span class="se_title">Observations</span>
                    <textarea class="se_status observations"></textarea>
                </div>
                <div class="w-100">
                    <span class="se_title">Diagnosis</span>
                    <textarea class="se_status diagnosis"></textarea>
                </div>
                <div class="w-100">
                    <span class="se_title">Prescription</span>
                    <div class="side_effect_group prescriptions_list">
                        <div class="prescription_item">
                            <div class="l2r" style="gap: 20px;">
                                <div class="t2b w-100">
                                    <span class="se_title">Dosage Form</span>
                                    <span class="se_status dosage_form" contenteditable="true"></span>
                                </div>
                                <div class="t2b w-100">
                                    <span class="se_title">Drug Name</span>
                                    <span class="se_status drug_name" contenteditable="true"></span>
                                </div>
                                <div class="t2b w-100">
                                    <span class="se_title">Drug Strength</span>
                                    <span class="se_status drug_strength" contenteditable="true"></span>
                                </div>
                            </div>
                            <div class="l2r" style="gap: 20px">
                                <div class="t2b w-100">
                                    <span class="se_title">Frequency</span>
                                    <span class="se_status frequency" contenteditable="true"></span>
                                </div>
                                <div class="t2b w-100">
                                    <span class="se_title">Duration</span>
                                    <span class="se_status duration" contenteditable="true"></span>
                                </div>
                                <div class="t2b w-100">
                                    <div class="l2r remove_prescription d-none">
                                        <i class="bx bx-trash"></i>
                                        Remove Prescription
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="l2r add_prescription">
                        <img src="IMG/Add_Plus_Circle.svg" alt="">
                        <span>Add prescription</span>
                    </div>
                </div>
                <div class="w-100">
                    <span class="se_title">Recommended Tests</span>
                    <textarea class="se_status recommended_tests"><?php echo $data['recommended_tests'] ?></textarea>
                </div>
            </div>
            <div class="action_button submit_report my-5 <?php echo $_SESSION['type'] == 'patient' ? 'd-none' : ''; ?>">
                Submit Report
            </div>

        </div>
        <!-- end main content-->
    <?php 
        $conn->close();
        include('Commons/footer.php');
    ?>
    <script src="JS/Appointments.js"></script>


</body>

</html>
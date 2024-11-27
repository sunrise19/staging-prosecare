<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Patients"; 
    include('Commons/header.php');  
    include('../STATIC_API/Config.php');
    if(!isset($_SESSION["superadmin"])){
        header('location: Home');
    }

    $user_id = $_SESSION["id"];
    $UID = $_SESSION["patient_id"];

    if(!is_numeric($UID)){
        echo "<script>window.location.href= './Patients'</script>";
        return;
    }

    $sql = "SELECT * FROM patients JOIN users ON patients.user_id=users.user_id WHERE patients.patient_id='$UID'";
    $sql2 = "SELECT * FROM next_of_kin WHERE user_id='$user_id'";

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    $data;
    $dataNOK;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = $row;
            echo "<script>const CANCER_TYPE = '".strtolower($row['cancer'])."'.replace(/ /g, '_'), USER_ID='".$row['user_id']."', PATIENT_ID='".$UID."'</script>";
        }
        
        if ($result2->num_rows > 0) {
            
            while($row2 = $result2->fetch_assoc()) {
                $dataNOK = $row2;
            }

        }

    }else{
        // echo "<script>window.location.href= './Patients'</script>";
        // return;
    }

?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <style id="dynamic_style"></style>


        <div class="main-content">

            <div class="page-content p-5">
                <div class="container-fluid">


                    <i class="bx bx-left-arrow-alt mb-4 d-none go_back" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>
                    
                    <div class="l2r">
                        <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Side Effects</h2>
                        <div class="l2r right_actions" style="gap: 20px">
                            <div class="start_new_chat report_side_effect">
                                <i class="bx bx-plus-circle"></i>
                                Report a Side Effect
                            </div>
                            <div class="start_new_chat log_a_treatment">
                                <i class="bx bx-plus-circle"></i>
                                Log a Treatment
                            </div>
                        </div>

                    </div>
                   
                    
                    <div class="l2r mt-5 tab_holder" style="gap: 70px; justify-content: start;">
                        <a class="tab_item active" data-tab="side_effects">Side Effects</a>
                        <a class="tab_item" data-tab="treatments">Treatments</a>
                    </div>

                    <div class="tab_container side_effects" style="display: block">
    
                        <div class="mt-4 as_sheet side_effects_graph">
                            <div class="l2r" style="align-items: center; justify-content: space-between">
                                <span class="small_title">Side Effect History</span>
                                <!-- <div class="prose_dropdown l2r" style="width: unset">
                                    <select class="prose_select" style=" border: 1px solid; ">
                                        <option value="Tiredness">Tiredness</option>
                                        <option value="Weakness">Weakness</option>
                                    </select>
                                    <i class="bx bx-chevron-down" id="prose-dropdown-caret"></i>
                                </div> -->
                                <div class="custom_prose_dropdown ">
        <span class="prose_selected">Tiredness</span>
        <i class="bx bx-chevron-down"></i>
        <ul class="prose_select_list">
            <li data-value="Tiredness">Tiredness</li>
            <li data-value="Weakness">Weakness</li>
        </ul>
    </div>
                            </div>
                            <div class="l2r mt-3" style=" gap: 35px; ">
                                <div class="l2r" style=" align-items: center; width: unset; gap: 15px">
                                    <div class="cell_title">From:</div>
                                    <input class="prose_date" type="date">
                                </div>
                                <div class="l2r" style=" align-items: center; width: unset; gap: 15px">
                                    <div class="cell_title">To:</div>
                                    <input class="prose_date" type="date">
                                </div>
                            </div>

                                <?php

                                    $sql = "SELECT * FROM sideeffects WHERE user_id=".$user_id;

                                    $tiredness = 0;
                                    $vomiting = 0;
                                    $nausea = 0;
                                    $mouth_sore = 0;
                                    $headache = 0;
                                                    
                                    $result = mysqli_query($conn, $sql);

                                    if ($result->num_rows > 0) {

                                        while($row = $result->fetch_assoc()) {

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
                                        tiredness='.intval($tiredness/4).', 
                                        vomiting='.intval($vomiting/4).', 
                                        nausea='.intval($nausea/4).', 
                                        mouth_sore='.intval($mouth_sore/4).',
                                        headache='.intval($headache/4).'
                                    </script>';
                                ?>
                            <div class="l2r mt-3">
                                <div class="t2b mt-4" style=" width: unset; flex: unset; gap: 89px; ">
                                    <div class="smaller_title">Severe</div>
                                    <div class="smaller_title">Moderate</div>
                                    <div class="smaller_title">Mild</div>
                                    <div class="smaller_title">None</div>
                                </div>
                                <div class="recent_activities" style="flex: 1; width: 100%; overflow: hidden" id="sfx_chart"></div>
                            </div>
                        </div>

                        <div class="l2r mt-4" style="gap: 20px; align-items: start">
                            <!-- START DATEPICKER -->
                                <!-- <div class="col-lg-5 col-sm-12"> -->
                                    <div id="datepicker"></div>
                                <!-- </div> -->
                            <!-- END DATEPICKER -->

                            <!-- START SIDE EFFECTS -->
                            <style>
                                .drop_d .sweetselect, .drop_d input, .extender {
                                    padding: 17px 42px;
                                    background: #fff !important;
                                    color: #000 !important;
                                    border: none !important;
                                    font-size: 14px;
                                    /* pointer-events: none; */
                                }
                                .drop_d input{
                                    border: 1px solid #8D2D9233 !important;
                                    margin: 30px;
                                }

                                .drop_d span {
                                    display: none;
                                }
                                .i-g-block-label {
                                    padding: 15px 25px;
                                    background: #f9f9f9
                                }
                                .drop_d, .simple_flex {
                                    background: #fff;
                                    margin: 0 !important;
                                }
                            </style>
                            <!-- <div class="col-lg-7 col-sm-12 table-col" > -->
                                <div class="card as_sheet p-0" style="flex: 1; min-height: 413px; justify-content: center; align-items: center; overflow: hidden">
                                    <div class="card-body d-flex p-0 align-items-center w-100">

                                        <div class="empty_state w-100">
                                            <div>
                                                <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="48" cy="48" r="47.75" fill="#F9D7EF"/>
                                                    <path d="M48 31.5417C44.7448 31.5417 41.5628 32.5069 38.8562 34.3154C36.1496 36.1239 34.0401 38.6943 32.7944 41.7017C31.5488 44.709 31.2228 48.0183 31.8579 51.2109C32.4929 54.4035 34.0604 57.3361 36.3622 59.6378C38.6639 61.9395 41.5965 63.507 44.7891 64.1421C47.9817 64.7771 51.2909 64.4512 54.2983 63.2055C57.3057 61.9598 59.8761 59.8503 61.6846 57.1438C63.493 54.4372 64.4583 51.2552 64.4583 48C64.4583 45.8387 64.0326 43.6985 63.2055 41.7017C62.3784 39.7049 61.1661 37.8905 59.6378 36.3622C58.1095 34.8339 56.2951 33.6216 54.2983 32.7945C52.3015 31.9674 50.1613 31.5417 48 31.5417ZM49.6458 54.5833C49.6458 55.0198 49.4724 55.4385 49.1637 55.7471C48.8551 56.0558 48.4365 56.2292 48 56.2292C47.5635 56.2292 47.1448 56.0558 46.8362 55.7471C46.5275 55.4385 46.3541 55.0198 46.3541 54.5833V46.3542C46.3541 45.9177 46.5275 45.499 46.8362 45.1904C47.1448 44.8817 47.5635 44.7083 48 44.7083C48.4365 44.7083 48.8551 44.8817 49.1637 45.1904C49.4724 45.499 49.6458 45.9177 49.6458 46.3542V54.5833ZM48 43.0625C47.6745 43.0625 47.3562 42.966 47.0856 42.7851C46.8149 42.6043 46.604 42.3472 46.4794 42.0465C46.3548 41.7458 46.3223 41.4148 46.3858 41.0956C46.4493 40.7763 46.606 40.4831 46.8362 40.2529C47.0664 40.0227 47.3596 39.866 47.6789 39.8025C47.9981 39.739 48.3291 39.7716 48.6298 39.8961C48.9305 40.0207 49.1876 40.2316 49.3684 40.5023C49.5493 40.773 49.6458 41.0912 49.6458 41.4167C49.6458 41.8532 49.4724 42.2718 49.1637 42.5805C48.8551 42.8891 48.4365 43.0625 48 43.0625Z" fill="#71207D"/>
                                                </svg>
                                                <h5 class="mt-2 mb-0 snt font-size-15 font-weight-normal es_message" style="color: #666">Click on a day to begin</h5>
                                                <button class="btn btn-primary start_log mt-3" style="display: none">Add New Log</button>
                                            </div>
                                        </div>

                                        <div class="side_effect_items" style="width: 100%; display: none">
                                            <!-- <p class="card-title font-size-20 mb-2 current-state align-center" style="text-transform: none">Log a Side Effect</p> -->
                                            <div class="l2r">
                                                <h5 class="snt font-size-15 font-weight-normal sub-state">No side effects have been logged today. Log them below</h5>
                                                <div class="edit_side_effects l2r">
                                                    <i class="bx bx-pencil"></i>
                                                    Edit
                                                </div>
                                            </div>


                                            <div class="feelings d-none l2r mt-3 mb-5">
                                                <div class="feeling_item t2b">
                                                    🙂
                                                    <span>Calm</span>
                                                    <em></em>
                                                </div>
                                                <div class="feeling_item t2b">
                                                    😪
                                                    <span>Mild</span>
                                                    <em>Low level of pain</em>
                                                </div>
                                                <div class="feeling_item t2b">
                                                    😰
                                                    <span>Moderate</span>
                                                    <em>Distressing pain</em>
                                                </div>
                                                <div class="feeling_item t2b">
                                                    🥵
                                                    <span>Severe</span>
                                                    <em>Very intense</em>
                                                </div>
                                                <div class="feeling_item t2b">
                                                    🤢
                                                    <span>Very Severe</span>
                                                    <em>Unbearable</em>
                                                </div>
                                            </div>

                                            <div class="t2b severity_text d-none" style="padding: 0 25px 10px">
                                                <span style=" font-size: 17px; font-weight: 500; color: #000; ">Side Effects Severity</span>
                                                <span style=" font-size: 14px; color: #000; ">Tell us which of these side effects you experience and how serious they are</span>
                                            </div>


                                            <div class="prose_dropdown l2r my-2" style="width: calc(100% - 50px);margin: 0 auto;">
                                                <select id="treatment_type" class="prose_select" style="padding: 15px 25px; width: 100%;">
                                                    <option value="Chemotherapy">Chemotherapy</option>
                                                    <option value="Radiotherapy">Radiotherapy</option>
                                                    <option value="Immunotherapy">Immunotherapy</option>
                                                    <option value="Surgery">Surgery</option>
                                                </select>
                                                <i class="bx bx-chevron-down" ></i>
                                            </div>
                                            
                                           <div id="chemotherapy-effects">
                                           <?php include('ChemotherapySideEffect.php'); ?>
                                           
                                           </div>

                                           <div id="radiotherapy-effects">
                                             <?php include('RadiotherapySideEffect.php'); ?>
                                           </div>

                                           <div id="immunotherapy-effects">
                                             <?php include('ImmunotherapySideEffect.php'); ?>
                                           </div>

                                           <div id="surgery-effects">
                                             <?php  include('SurgerySideEffect.php'); ?>
                                           </div>

                                            <button class="btn-primary btn-lg mt-4" id="add-data" style="padding: 13px 30px !important;font-size: 15px !important;border-radius: 50px !important;margin: 0 auto 25px;left: 50%;position: relative;transform: translateX(-50%);">Log Side Effects</button>
                                            <button class="btn-primary btn-lg mt-4" id="update-data" style="padding: 13px 30px !important;font-size: 15px !important;border-radius: 50px !important;margin: 0 auto 25px;left: 50%;position: relative;transform: translateX(-50%); display: none">Update Side Effects</button>

                                        </div>
                                    </div>
                                </div>
                            <!-- </div>  -->
                            <!-- END SIDE EFFECTS -->

                        </div>

                    </div>


                    <div class="tab_container treatments">

                        <div class="l2r mt-4" style="gap: 25px; flex-wrap: wrap;">
                            <div class="l2r treatment_item" data-frame="Treatment-Chemotherapy">
                                <img src="IMG/chemo.svg" alt="">
                                Chemotherapy
                            </div>
                            <div class="l2r treatment_item" data-frame="Treatment-Radiotherapy">
                                <img src="IMG/radio.svg" alt="">
                                Radiotherapy
                            </div>
                            <div class="l2r treatment_item" data-frame="Treatment-Interruptions">
                                <img src="IMG/treat.png" alt="">
                                Treatment Interruptions
                            </div>
                        </div>

                        <div class="l2r mt-4" style="gap: 25px; flex-wrap: wrap;">
                            <div class="l2r treatment_item" data-frame="Treatment-Other-Medications">
                                <img src="IMG/treat.png" alt="">
                                Other Medications
                            </div>
                            <div class="l2r treatment_item" data-frame="Treatment-Surgery">
                                <img src="IMG/surg.png" alt="">
                                Surgical Procedure
                            </div>
                            <div class="l2r treatment_item" data-frame="Treatment-Supportive-Care">
                                <img src="IMG/supp.png" alt="">
                                Log Supportive Care
                            </div>
                        </div>

                        <div class="treament_modal">
                            <div class="treament_modal_content">
                                <div class="l2r">
                                    <div class="treament_modal_title"></div>
                                    <div class="close_treament_modal">+</div>
                                </div>
                                <iframe src="" class="treatment_frame"></iframe>
                            </div>
                        </div>

                    </div>
                    
                    <!-- end row -->


                </div>
                <!-- container-fluid -->

            </div>
            <!-- End Page-content -->
    
    <?php include('Commons/footer.php');?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="Commons/excel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="JS/jquery-ui.js"></script>
    <!-- <script src="JS/Patients.js"></script> -->
    <script src="JS/SideEffects.js"></script>


    <style>
        .swal2-styled.swal2-confirm,.swal2-styled.swal2-deny,.swal2-styled.swal2-cancel{
            background-color: #8D2D91;
        }
        .swal2-title {
            font-size: 25px !important;
        }
    </style>

    <script>
        var options = {
                chart: {
                    type: 'area',
                    height: 400,
                    zoom: {enabled: false},
                    pan: {enabled: false},
                    toolbar: {enabled: false, show: false},
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
                    colors: ['#8D2D92',]
                },
                stroke: {
                    curve: 'smooth',
                },
                series: [{
                    name: 'Severity',
                    data: [tiredness , vomiting, nausea, mouth_sore, headache, 0, 0]
                }],
                xaxis: {
                    categories: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun']
                },
                yaxis: {
                    tooltip: {
                        enabled: false,
                        offsetX: 20,
                    },
                    labels: {
                        show: false,
                    }
                }
            }

        var chart = new ApexCharts(document.querySelector("#sfx_chart"), options);

        chart.render();

        $(document).ready(function(){
            if(window.location.href?.includes('#Treatment')){
                $('.log_a_treatment').click()
            }
        })
    </script>


</body>

</html>
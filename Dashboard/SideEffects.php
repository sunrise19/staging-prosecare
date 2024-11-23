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
                                <div class="prose_dropdown l2r" style="width: unset">
                                    <select class="prose_select" style=" border: 1px solid; ">
                                        <option value="Tiredness">Tiredness</option>
                                        <option value="Weakness">Weakness</option>
                                    </select>
                                    <i class="bx bx-chevron-down"></i>
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
                                                <i class="bx bx-chevron-down"></i>
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Hair Loss In Armpit</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_hair_loss">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (no hair loss)</option>
                                                    <option value="Mild">Mild (patchy hair loss)</option>
                                                    <option value="Severe">Severe (complete hair loss)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Arm Swelling and Changes</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_arm_swelling">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (no arm swelling)</option>
                                                    <option value="Mild">Mild (slight swelling or a slight change in skin color of the arm)</option>
                                                    <option value="Moderate">Moderate (obvious swelling or obvious change in skin color of the arm.)</option>
                                                    <option value="Severe">Severe (swollen arm changes are limiting cooking, self-care, feeding, and bathing.)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Difficulty in swallowing</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_swallowing_difficulty">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no difficulty in swallowing)</option>
                                                    <option value="Mild">Mild (Difficulty eating solid or soft foods)</option>
                                                    <option value="Moderate">Moderate (Difficulty swallowing liquid)</option>
                                                    <option value="Severe">Severe (Unable to swallow liquid, solid and soft food)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">In the area where you are receiving radiotherapy, do you experience pain in the chest wall? (To be answered if you have done a mastectomy)</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_chest_pain">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no pain on my chest)</option>
                                                    <option value="Mild">Mild (I have a little pain)</option>
                                                    <option value="Moderate">Moderate (I have pain and it sometimes limit my daily activities)</option>
                                                    <option value="Severe">Severe (The pain is severe and limits my self care)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Breast swelling (To be answered if you haven’t done a mastectomy)</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_breast_swelling">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="b_breast_swelling_other">
                                                </div>
                                                <!-- <input type="text" style="display: none" placeholder="Please tell us more"> -->
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Breast pain (To be answered if you haven’t done a mastectomy)</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_breast_pain">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no pain on my chest)</option>
                                                    <option value="Mild">Mild (I have a little pain)</option>
                                                    <option value="Moderate">Moderate (I have pain and it sometimes limit my daily activities)</option>
                                                    <option value="Severe">Severe (The pain is severe and limits my self care)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Loss of Sensation and Weakness of The Arm</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_sensation_loss">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no pain on my chest)</option>
                                                    <option value="Mild">Mild (Loss of sensation of the arm)</option>
                                                    <option value="Moderate">Moderate (Discomfort or muscle weakness of the arm)</option>
                                                    <option value="Severe">Severe (Discomfort or muscle weakness of the arm limiting self-care)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Skin Colour Changes</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_skin_color">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (No skin changes)</option>
                                                    <option value="Mild">Mild (I have skin colour changes or dry peeling on the skin)</option>
                                                    <option value="Moderate">Moderate (I have skin colour changes or a little area of my skin that is wet and peeling in skin folds eg armpit)</option>
                                                    <option value="Severe">Severe (I have a lot of skin colour changes and or peeling of my skin; bleeding from my breast or chest skin or an ulcer on my skin)</option>
                                                </select>
                                            </div>
                                            
                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Tired/Weak</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="b_tired_or_weak">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I feel better than usual)</option>
                                                    <option value="Mild">Mild (I do not feel better more than usual)</option>
                                                    <option value="Moderate">Moderate (I feel worse than usual)</option>
                                                    <option value="Severe">Severe (I feel much worse than usual)</option>
                                                </select>
                                            </div>
                                            
                                            <!-- <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">What is your weight this week? <b>KG</b></label>
                                                <div class="simple_flex">
                                                    <input type="text" placeholder="Enter Weight Here" id="b_weight">
                                                </div>
                                            </div> -->
                                        
                                            <!-- <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Enter your FBC Parameters</label>
                                                <div class="simple_flex">
                                                    <div class="flex flex_col v_flex">
                                                        Hb
                                                        <input type="text" placeholder="Enter Hb" id="b_hb">
                                                    </div>
                                                    <div class="flex flex_col v_flex">
                                                        PCV
                                                        <input type="text" placeholder="Enter PCV" id="b_pcv">
                                                    </div>
                                                    <div class="flex flex_col v_flex">
                                                        WBC
                                                        <input type="text" placeholder="Enter WBC" id="b_wbc">
                                                    </div>
                                                    <div class="flex flex_col v_flex">
                                                        ANC
                                                        <input type="text" placeholder="Enter ANC" id="b_anc">
                                                    </div>
                                                    <div class="flex flex_col v_flex">
                                                        Platelet
                                                        <input type="text" placeholder="Enter Platelet" id="b_platelet">
                                                    </div>
                                                </div>
                                            </div> -->
                                            
                                            <div class="drop_d to_remove type_breast">
                                                <label class="i-g-block-label">Is there any side effect or anything you would like to share?</label>
                                                <div class="flex flex_row simple_flex">
                                                    <input type="text" placeholder="Enter Note Here" id="b_note">
                                                </div>
                                            </div>
                                            
                                            

                                            <!-- HEAD AND NECK -->
                                            
                                            <div class="drop_d to_remove type_head_and_neck">
                                                <label class="i-g-block-label">Mouth sore</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_mouth_sore">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None</option>
                                                    <option value="Mild">Mild (Mouth feels sore or there is redness in the mouth.)</option>
                                                    <option value="Moderate">Moderate (Painful  mouth ulcers, redness in the mouth but you can swallow)</option>
                                                    <option value="Severe">Severe (Painful mouth ulcers that is very painful, redness in the mouth but you cannot swallow) </option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Difficulty in Swallowing</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_diff_in_swallowing">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I swallow normally)</option>
                                                    <option value="Mild">Mild (Difficulty eating solid or soft foods)</option>
                                                    <option value="Moderate">Moderate (Difficulty swallowing liquid)</option>
                                                    <option value="Severe">Severe (Unable to swallow liquid, solid and soft foods.)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Loss of Smell</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_loss_of_smell">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I smell things normally)</option>
                                                    <option value="other">I cannot smell things</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="hn_loss_of_smell_other">
                                                </div>
                                            </div>
                                                
                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Taste Changes</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_taste_changes">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (No change in taste)</option>
                                                    <option value="Mild">Mild (Food tastes slightly different)</option>
                                                    <option value="Moderate">Moderate</option>
                                                    <option value="Severe">Severe</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Dry mouth</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_dry_mouth">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None</option>
                                                    <option value="Mild">Mild (Occasional mouth dryness with slightly thick saliva)</option>
                                                    <option value="Moderate">Moderate (Persistent mouth dryness with thick, sticky saliva)</option>
                                                    <option value="Severe">Severe (Complete mouth dryness with thick, sticky saliva)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Cracking at the corner of the mouth</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_mouth_cracking">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="hn_mouth_cracking_other">
                                                </div>
                                            </div>
                                                
                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Voice Change</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_voice_change">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (My voice is normal)</option>
                                                    <option value="Mild">Mild (Occasional voice changes and self-resolves)</option>
                                                    <option value="Moderate">Moderate (Persistent voice changes and may require occasional repetition)</option>
                                                    <option value="Severe">Severe (Complete voice changes, incapable of normal communication)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Appetite Changes</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_appetite_changes">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I eat well)</option>
                                                    <option value="Mild">Mild (Occasional loss of appetite without alteration in eating habits.)</option>
                                                    <option value="Moderate">Moderate (Loss of appetite plus reduced oral intake, no significant weight loss,  occasional inclination to vomit.)</option>
                                                    <option value="Severe">Severe (Complete loss of appetite, persistent inclination to vomit with significant weight loss.t)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Nausea</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_nausea">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="hn_nausea_other" style="margin-top: 0">
                                                </div>
                                            </div>                                   
                                        
                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Vomiting</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_vomiting">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no episode of vomiting)</option>
                                                    <option value="Mild">Mild (1 episode of vomiting in 24 hours)</option>
                                                    <option value="Moderate">Moderate (2 - 5 episodes of vomiting in 24 hours)</option>
                                                    <option value="Severe">Severe (6 or more episodes of vomiting. Could require hospitalization)</option>
                                                </select>
                                            </div>
                                        
                                            <div class="drop_d to_remove mt-3 type_head_and_neck">
                                                <label class="i-g-block-label">Skin Color Changes</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_skin_color_changes">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (No skin changes)</option>
                                                    <option value="Mild">Mild (I have skin colour changes or dry peeling on the skin )</option>
                                                    <option value="Moderate">Moderate (I have skin colour changes or a little area of my skin that is wet and peeling in skin folds eg. armpit)</option>
                                                    <option value="Severe">Severe (I have a lot of skin colour changes and or peeling of my skin; bleeding from my breast or chest skin or an ulcer on my skin)</option>
                                                </select>
                                            </div>
                                            
                                            <div class="drop_d to_remove type_head_and_neck">
                                                <label class="i-g-block-label">Tired/Weak</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_tired_or_weak">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I feel better than usual)</option>
                                                    <option value="Mild">Mild (I do not feel better more than usual)</option>
                                                    <option value="Moderate">Moderate (I feel worse than usual)</option>
                                                    <option value="Severe">Severe (I feel much worse than usual)</option>
                                                </select>
                                            </div>

                                            <!-- <div class="drop_d to_remove type_head_and_neck">
                                                <label class="i-g-block-label">What is your weight this week? <b>KG</b></label>
                                                <div class="simple_flex">
                                                    <input type="text" placeholder="Enter Weight Here" id="hn_weight">
                                                </div>
                                            </div> -->
                                            
                                            <div class="drop_d to_remove type_head_and_neck">
                                                <label class="i-g-block-label">Is there any side effect or anything you would like to share?</label>
                                                <div class="flex flex_row simple_flex">
                                                    <input type="text" placeholder="Enter Note Here" id="hn_note">
                                                </div>
                                            </div>

                                            <div class="drop_d to_remove type_head_and_neck">
                                                <label class="i-g-block-label">Are you on chemotherapy?</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="hn_on_chemo">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No (I am not on chemotherapy)</option>
                                                    <option value="Mild">Yes, weekly</option>
                                                    <option value="Moderate">Yes, 3 weekly</option>
                                                    <option value="Severe">Yes, monthly</option>
                                                </select>
                                            </div>




                                            <!-- FEMALE PELVIC -->

                                            <div class="drop_d to_remove mt-3 type_female_pelvic">
                                                <label class="i-g-block-label">Loose or watery stools</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_loose_stool">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no episode of watery stool)</option>
                                                    <option value="Mild">Mild (I have less than 4 episodes of watery stool in 24 hours)</option>
                                                    <option value="Moderate">Moderate (I have between 4-6 episodes of watery stool in 24 hours)</option>
                                                    <option value="Severe">Severe (I have greater than 6 episodes of watery stool in 24 hours)</option>
                                                </select>
                                            </div>


                                            <div class="drop_d to_remove mt-3 type_female_pelvic">
                                                <label class="i-g-block-label">Nausea</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_nausea">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="fp_nausea_other" style="margin-top: 0">
                                                </div>
                                            </div>         
                                        
                                            <div class="drop_d to_remove mt-3 type_female_pelvic">
                                                <label class="i-g-block-label">Vomiting</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_vomiting">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no episode of vomiting)</option>
                                                    <option value="Mild">Mild (1 episode of vomiting in 24 hours)</option>
                                                    <option value="Moderate">Moderate (2 - 5 episodes of vomiting in 24 hours)</option>
                                                    <option value="Severe">Severe (6 or more episodes of vomiting. Could require hospitalization)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Skin Colour Changes</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_skin_color">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (No skin changes)</option>
                                                    <option value="Mild">Mild (I have skin colour changes or dry peeling on the skin)</option>
                                                    <option value="Moderate">Moderate (I have skin colour changes or a little area of my skin that is wet and peeling in skin folds eg armpit)</option>
                                                    <option value="Severe">Severe (I have a lot of skin colour changes and or peeling of my skin; bleeding from my breast or chest skin or an ulcer on my skin)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Changes In The Anus</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_anus_changes">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no pain in my anus)</option>
                                                    <option value="Mild">Mild (I have pain in my anus or occasional urgency to stool but little or no stool comes out)</option>
                                                    <option value="Moderate">Moderate (I have persistent pain in the anus with ulceration or  persistent bleeding, tightness of the anus)</option>
                                                    <option value="Severe">Severe (I have uncontrollable stooling and pain; heavy bleeding, complete obstruction of the anus)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Blood In The Urine</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_blood_in_urine">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no blood in my urine)</option>
                                                    <option value="Mild">Mild (I can see blood in my urine)</option>
                                                    <option value="Moderate">Moderate (I can see blood and small clot in my urine)</option>
                                                    <option value="Severe">Severe (I can see blood and big clot in my urine)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Difficulty in urinating</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_diff_urinating">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no difficulty in urinating)</option>
                                                    <option value="Mild">Mild (I have occasional difficulty in urinating)</option>
                                                    <option value="Moderate">Moderate (I have intermittent difficulty in urinating)</option>
                                                    <option value="Severe">Severe (I have complete difficulty in urinating)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Painful urination</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_painful_urine">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I experience no painful urination)</option>
                                                    <option value="Mild">Mild (I experience occasional & minimal painful urination)</option>
                                                    <option value="Moderate">Moderate (I experience intermittent & tolerable painful urination)</option>
                                                    <option value="Severe">Severe (I experience persistent, intense, refractory & excruciating painful urination)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Feel like urinating</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_feel_like_urine">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None</option>
                                                    <option value="Mild">Mild (I have occasional urge  to urinate)</option>
                                                    <option value="Moderate">Moderate (I have a persistent urge to urinate which sometimes affects daily activities)</option>
                                                    <option value="Severe">Severe (I have an uncontrollable urge to urinate that always affect daily activities and requires urinary catheter)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Control of urine flow</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_urine_control">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I can control the flow of urine)</option>
                                                    <option value="Mild">Mild (I experience uncontrollable flow of urine more than once in a week)</option>
                                                    <option value="Moderate">Moderate (I  experience uncontrollable flow of urine more than once a day)</option>
                                                    <option value="Severe">Severe (I experience uncontrollable flow of urine more than once a day and might necessitate the use of pads)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Rate of urination</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_urine_rate">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I urinate normally)</option>
                                                    <option value="Mild">Mild (I urinate every 3 - 4 hours)</option>
                                                    <option value="Moderate">Moderate (I urinate every 2 - 3 hours)</option>
                                                    <option value="Severe">Severe (I urinate every 1 hour or more frequently)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Vaginal dryness</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_vag_dry">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no vaginal dryness)</option>
                                                    <option value="Mild">Mild (I have vaginal dryness that has no interference with usual sexual, social, & functional activities)</option>
                                                    <option value="Moderate">Moderate (I have vaginal dryness that has minimal interference with usual sexual, social, & functional activities)</option>
                                                    <option value="Severe">Severe (I have vaginal dryness that has significant interference with usual sexual, social, & functional activities)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Leakage of stool</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_stool_leak">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I can control when to stool)</option>
                                                    <option value="Mild">Mild (I experience occasional leakage of stool)</option>
                                                    <option value="Moderate">Moderate (I experience persistent leakage of stool)</option>
                                                    <option value="Severe">Severe (I experience complete loss of control of over leakage of stool)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Tired/Weak</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_tired_or_weak">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I feel better than usual)</option>
                                                    <option value="Mild">Mild (I do not feel better more than usual)</option>
                                                    <option value="Moderate">Moderate (I feel worse than usual)</option>
                                                    <option value="Severe">Severe (I feel much worse than usual)</option>
                                                </select>
                                            </div>
                                                                                
                                            <!-- <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">What is your weight this week? <b>KG</b></label>
                                                <div class="simple_flex">
                                                    <input type="text" placeholder="Enter Weight Here" id="fp_weight">
                                                </div>
                                            </div> -->

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Is there any side effect or anything you would like to share?</label>
                                                <div class="flex flex_row simple_flex">
                                                    <input type="text" placeholder="Enter Note Here" id="fp_note">
                                                </div>
                                            </div>

                                            <div class="drop_d to_remove type_female_pelvic">
                                                <label class="i-g-block-label">Are you on chemotherapy?</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="fp_on_chemo">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No (I am not on chemotherapy)</option>
                                                    <option value="Mild">Yes, weekly</option>
                                                    <option value="Moderate">Yes, 3 weekly</option>
                                                    <option value="Severe">Yes, monthly</option>
                                                </select>
                                            </div>




                                            <!-- MALE PELVIC -->

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Blood In The Urine</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_blood_in_urine">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no blood in my urine)</option>
                                                    <option value="Mild">Mild (I can see blood in my urine)</option>
                                                    <option value="Moderate">Moderate (I can see blood and small clot in my urine)</option>
                                                    <option value="Severe">Severe (I can see blood and big clot in my urine)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Difficulty in urinating</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_diff_urinating">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no difficulty in urinating)</option>
                                                    <option value="Mild">Mild (I have occasional difficulty in urinating)</option>
                                                    <option value="Moderate">Moderate (I have intermittent difficulty in urinating)</option>
                                                    <option value="Severe">Severe (I have complete difficulty in urinating)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Painful urination</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_painful_urine">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I experience no painful urination)</option>
                                                    <option value="Mild">Mild (I experience occasional & minimal painful urination)</option>
                                                    <option value="Moderate">Moderate (I experience intermittent & tolerable painful urination)</option>
                                                    <option value="Severe">Severe (I experience persistent, intense, refractory & excruciating painful urination)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Rate of urination</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_urine_rate">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I urinate normally)</option>
                                                    <option value="Mild">Mild (I urinate every 3 - 4 hours)</option>
                                                    <option value="Moderate">Moderate (I urinate every 2 - 3 hours)</option>
                                                    <option value="Severe">Severe (I urinate every 1 hour or more frequently)</option>
                                                </select>
                                            </div>
                                        
                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Feel like urinating</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_feel_like_urine">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None</option>
                                                    <option value="Mild">Mild (I have occasional urge  to urinate)</option>
                                                    <option value="Moderate">Moderate (I have a persistent urge to urinate which sometimes affects daily activities)</option>
                                                    <option value="Severe">Severe (I have an uncontrollable urge to urinate that always affect daily activities and requires urinary catheter)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Control of urine flow</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_urine_control">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I can control the flow of urine)</option>
                                                    <option value="Mild">Mild (I experience uncontrollable flow of urine more than once in a week)</option>
                                                    <option value="Moderate">Moderate (I  experience uncontrollable flow of urine more than once a day)</option>
                                                    <option value="Severe">Severe (I experience uncontrollable flow of urine more than once a day and might necessitate the use of pads)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Nausea</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_nausea">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="mp_nausea_other" style="margin-top: 0">
                                                </div>
                                            </div>  

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Vomiting</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_vomiting">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no episode of vomiting)</option>
                                                    <option value="Mild">Mild (1 episode of vomiting in 24 hours)</option>
                                                    <option value="Moderate">Moderate (2 - 5 episodes of vomiting in 24 hours)</option>
                                                    <option value="Severe">Severe (6 or more episodes of vomiting. Could require hospitalization)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Loose or watery stools</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_loose_stool">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no episode of watery stool)</option>
                                                    <option value="Mild">Mild (I have less than 4 episodes of watery stool in 24 hours)</option>
                                                    <option value="Moderate">Moderate (I have between 4-6 episodes of watery stool in 24 hours)</option>
                                                    <option value="Severe">Severe (I have greater than 6 episodes of watery stool in 24 hours)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Changes In The Anus</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_anus_changes">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I have no pain in my anus)</option>
                                                    <option value="Mild">Mild (I have pain in my anus or occasional urgency to stool but little or no stool comes out)</option>
                                                    <option value="Moderate">Moderate (I have persistent pain in the anus with ulceration or  persistent bleeding, tightness of the anus)</option>
                                                    <option value="Severe">Severe (I have uncontrollable stooling and pain; heavy bleeding, complete obstruction of the anus)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Blood from the anus</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_blood_from_anus">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="Severe">Yes</option>
                                                </select>
                                            </div>  

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Difficulty in stooling</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_diff_stooling">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I stool normally)</option>
                                                    <option value="Mild">Mild (I stool between 3 - 4 times in a week)</option>
                                                    <option value="Moderate">Moderate (I stool between 1 - 2 times in a week)</option>
                                                    <option value="Severe">Severe (I have not stooled for up to 10 days)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Belly feels full and tight</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_belly_tight">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="mp_belly_tight_other">
                                                </div>
                                            </div> 

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Leakage of stool</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_stool_leak">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I can control when to stool)</option>
                                                    <option value="Mild">Mild (I experience occasional leakage of stool)</option>
                                                    <option value="Moderate">Moderate (I experience persistent leakage of stool)</option>
                                                    <option value="Severe">Severe (I experience complete loss of control of over leakage of stool)</option>
                                                </select>
                                            </div>

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Achieve and maintain erection</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_erection">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="mp_erection_other">
                                                </div>
                                            </div> 

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Difficulty in releasing sperm</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_diff_in_releases">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="mp_diff_in_releases_other">
                                                </div>
                                            </div> 

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Decreased sexual desire</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_decreased_desire">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="mp_decreased_desire_other">
                                                </div>
                                            </div> 

                                            <div class="drop_d to_remove mt-3 type_male_pelvic">
                                                <label class="i-g-block-label">Painful sex</label>
                                                <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_painful_sex">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No</option>
                                                    <option value="other">Yes</option>
                                                </select>
                                                <div class="simple_flex mt-2 mb-4" style="display: none">
                                                    <input type="text" placeholder="Please tell us more" id="mp_painful_sex_other">
                                                </div>
                                            </div> 

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Tired/Weak</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_tired_or_weak">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">None (I feel better than usual)</option>
                                                    <option value="Mild">Mild (I do not feel better more than usual)</option>
                                                    <option value="Moderate">Moderate (I feel worse than usual)</option>
                                                    <option value="Severe">Severe (I feel much worse than usual)</option>
                                                </select>
                                            </div>

                                            <!-- <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">What is your weight this week? <b>KG</b></label>
                                                <div class="simple_flex">
                                                    <input type="text" placeholder="Enter Weight Here" id="mp_weight">
                                                </div>
                                            </div> -->

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Is there any side effect or anything you would like to share?</label>
                                                <div class="flex flex_row simple_flex">
                                                    <input type="text" placeholder="Enter Note Here" id="mp_note">
                                                </div>
                                            </div>

                                            <div class="drop_d to_remove type_male_pelvic">
                                                <label class="i-g-block-label">Are you on chemotherapy?</label>
                                                <span style=" position: absolute; right: 10px; bottom: 14px; font-size: 20px">&#8964;</span>
                                                <select class="sweetselect sfx_select" id="mp_on_chemo">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="None">No (I am not on chemotherapy)</option>
                                                    <option value="Mild">Yes, weekly</option>
                                                    <option value="Moderate">Yes, 3 weekly</option>
                                                    <option value="Severe">Yes, monthly</option>
                                                </select>
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
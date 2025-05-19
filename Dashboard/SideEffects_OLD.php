<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Side Effects"; 
    include('Commons/header.php');  
?>
    <style id="dynamic_style"></style>

    <style>

        .shower {
            width: 200px;
            position: absolute;
            <?php if(isset($_SESSION["admin"]) || $_SESSION["type"] == "hospital"){echo 'right: 20.5rem;';}else{echo 'right: 6rem;';}?>
            top: 26px;
            font-weight: 500;
            background: transparent;
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

        .table thead th {
            font-size: 13px;
        }

        body{
            font-size: .8125rem !important;
            font-weight: 400 !important;
        }

        #video_conf_frame {
            position: fixed;
            top: 27px;
            left: 27px;
            z-index: 99999;
            width: calc(100% - 54px);
            height: calc(100% - 100px);
            border-radius: 12px;
        }

        .video_conf_frame_back{
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.5);
            top: 0;
            left: 0;
            z-index: 9999;
            -webkit-backdrop-filter: blur(12px);
            backdrop-filter: blur(12px);
            display: none;
        }

        .video_conf_frame_close {
            font-weight: 500;
            letter-spacing: 1px;
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            bottom: 15px;
            padding: 11px 30px !important;
        }


        .closerc {
            float: right;
            margin: 20px;
            font-weight: 600;
            color: #ffeb3b;
        }

        .remove_value,
        .remove_image,
        .remove_input {
            width: 25px;
            height: 25px;
            position: absolute;
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAABQ0lEQVRoge2Yy07DMBBFj/gaWPAL5bEorxVQyg5Y8mbJJ/MBUEDQEhZgEWDcOrKTONE9Unbx1b0a2R4PCCGEEEKIHFkFjhPqbQIbCfWCWAEegClwmkBvADwCExoM40IU39+MuDBrwFNJbwKsR3oMYsxXJQriwwyB5z9aH8B1EqcBjIF3w8B5BQ1fiLukTgM4wg5zEbB2C3gx1t7W4jSAEfBmGLqcs2abzEI4qoTJNoTjEDvMVemfHewQN406DWAPeMU+gToTwrGPXZlF1cqSXf5XprV7IhZfmNpCLNUh2hesTd+ZTe7oxWY/wG+4M8ev70Is3+7Z3+q9aFFGVO+AfZ1v4+27w9fGh7xJhmQSxnpYzYCzChrWw6oA7pM6nUNvnrrL/B4+xE5SBrQ0fICfMFPgJIFeK+MgRy8GdEIIIYQQYjGffTbpZF4f+UYAAAAASUVORK5CYII=);
            background-size: cover;
            right: 11px;
            top: 50%;
            transform: translateY(-50%);
        }

        .images_container {
            display: inline-block;
            width: 100%;
            overflow-x: auto;
            margin-top: 10px;
            white-space: nowrap;
        }

        .image_item {
            width: 160px;
            height: 115px;
            display: inline-block;
            border-radius: 0;
            margin-right: 13px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .image_item:last-of-type {
            margin-right: 0
        }

        .add_icon {
            width: 30px;
            height: 30px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAAWklEQVRoge3XsQ2AMAwAwcD+O0NPA02sF7obwMkrjbMWALCOzfOvqfPOXYOnCakRUiOkRkiNkBohNV+30ecWO+31nr95ESE1fog1QmqE1AipEVIjpEYIABB0A2/0Az6X8bpXAAAAAElFTkSuQmCC);
            background-size: cover;
        }

        span.section {
            font-size: 14px;
            color: #495057;
        }

        .tiny_image {
            width: 100%;
            height: 100%;
            display: inline-block;
            object-fit: contain;
            border-radius: 5px;
            pointer-events: all !important;
            user-select: all !important;
        }

        canvas,
        .raw_image {
            display: none;
        }

        .remove_image {
            top: 12px;
            transform: none;
            background-color: #fff;
            border: 1px solid #ced4da;
            z-index: 1;
            border-radius: 4px;
        }

        .review_image {
            width: 110px;
            object-fit: contain;
            background: #f3f3f3;
            margin: 15px 15px 0 0;
            padding: 10px;
            cursor: pointer;
            pointer-events: all !important;
        }

        .image_item.add_image{
            background: #dddddd7a;
            border-radius: 7px;
        }

        .file_name {
            background: #00000082;
            z-index: 1;
            position: absolute;
            left: 0px;
            width: 100%;
            padding: 5px 10px;
            bottom: 0;
            color: #fff;
            border-radius: 0 0 5px 5px;
            font-size: 10px;
            text-align: center;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        @media only screen and (max-width: 800px){
            .page-content{
                padding-left: 1em !important; 
                padding-right: 1em !important; 
            }
            .ui-datepicker-calendar{
                transform: scale(0.85) translateX(-59%);
                left: 50%;
                position: relative;
                top: -33px;
            }
            .ui-widget.ui-widget-content{
                max-width: unset
            }
            #datepicker{
                margin-bottom: 30px
            }

            .card{
                height: auto !important;
            }
        }

    </style>

        <div class="main-content">

            <div class="page-content px-5" style="padding-bottom: 0; padding-top: 6.8em;">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex justify-content-between flex-column">
                                <h2 class="mb-0 snt font-weight-bold">Side Effects</h2>
                                <br>
                                <h5 class="mb-0 snt font-size-15 font-weight-normal" style="color: #666">Report your side effects here. Click on a day to begin</h5>
                                

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->     
                    
                    <?php 

                        include('../STATIC_API/Config.php');

                        $UID = $_SESSION["id"];

                        $sql = "SELECT cancer FROM patients WHERE user_id='$UID'";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while($row = $result->fetch_assoc()) {
                                echo "<script>const CANCER_TYPE = '".strtolower($row['cancer'])."'.replace(/ /g, '_');</script>";
                            }

                        }
                    ?>
                    
                    <div class="row">
                        <div class="col-lg-5 col-sm-12">
                            <div id="datepicker"></div>
                        </div>
                        <div class="col-lg-7 col-sm-12 table-col" >
                            <div class="card" style="height: calc(100vh - 205px);">
                                <div class="card-body">

                                    <div class="empty_state">
                                        <div>
                                            <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="48" cy="48" r="47.75" fill="#F9D7EF"/>
                                                <path d="M48 31.5417C44.7448 31.5417 41.5628 32.5069 38.8562 34.3154C36.1496 36.1239 34.0401 38.6943 32.7944 41.7017C31.5488 44.709 31.2228 48.0183 31.8579 51.2109C32.4929 54.4035 34.0604 57.3361 36.3622 59.6378C38.6639 61.9395 41.5965 63.507 44.7891 64.1421C47.9817 64.7771 51.2909 64.4512 54.2983 63.2055C57.3057 61.9598 59.8761 59.8503 61.6846 57.1438C63.493 54.4372 64.4583 51.2552 64.4583 48C64.4583 45.8387 64.0326 43.6985 63.2055 41.7017C62.3784 39.7049 61.1661 37.8905 59.6378 36.3622C58.1095 34.8339 56.2951 33.6216 54.2983 32.7945C52.3015 31.9674 50.1613 31.5417 48 31.5417ZM49.6458 54.5833C49.6458 55.0198 49.4724 55.4385 49.1637 55.7471C48.8551 56.0558 48.4365 56.2292 48 56.2292C47.5635 56.2292 47.1448 56.0558 46.8362 55.7471C46.5275 55.4385 46.3541 55.0198 46.3541 54.5833V46.3542C46.3541 45.9177 46.5275 45.499 46.8362 45.1904C47.1448 44.8817 47.5635 44.7083 48 44.7083C48.4365 44.7083 48.8551 44.8817 49.1637 45.1904C49.4724 45.499 49.6458 45.9177 49.6458 46.3542V54.5833ZM48 43.0625C47.6745 43.0625 47.3562 42.966 47.0856 42.7851C46.8149 42.6043 46.604 42.3472 46.4794 42.0465C46.3548 41.7458 46.3223 41.4148 46.3858 41.0956C46.4493 40.7763 46.606 40.4831 46.8362 40.2529C47.0664 40.0227 47.3596 39.866 47.6789 39.8025C47.9981 39.739 48.3291 39.7716 48.6298 39.8961C48.9305 40.0207 49.1876 40.2316 49.3684 40.5023C49.5493 40.773 49.6458 41.0912 49.6458 41.4167C49.6458 41.8532 49.4724 42.2718 49.1637 42.5805C48.8551 42.8891 48.4365 43.0625 48 43.0625Z" fill="#71207D"/>
                                            </svg>
                                            <h5 class="mt-2 mb-0 snt font-size-15 font-weight-normal es_message" style="color: #666">Click on a day to begin</h5>
                                            <button class="btn btn-primary start_log mt-3" style="display: none">Add New Log</button>
                                        </div>
                                    </div>

                                    <div class="side_effect_items" style="display: none">
                                        <p class="card-title font-size-20 mb-2 current-state align-center" style="text-transform: none">Log a Side Effect</p>
                                        <h5 class="mb-4 snt font-size-15 font-weight-normal align-center sub-state" style="color: #666">No side effects have been logged today. Log them below</h5>


                                 

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
                                                <input type="text" placeholder="Please tell us more" id="hn_nausea_other">
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
                                                <input type="text" placeholder="Please tell us more" id="fp_nausea_other">
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
                                                <input type="text" placeholder="Please tell us more" id="mp_nausea_other">
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


                                        <button class="btn-primary btn-lg mt-4" id="add-data" style="width: 100%;padding: 13px 0 !important;font-size: 15px !important;">Log Side Effects</button>
                                        <button class="btn-primary btn-lg mt-4" id="update-data" style="width: 100%;padding: 13px 0 !important;font-size: 15px !important; display: none">Update Side Effects</button>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>
    
    <script>var AUTH_NAME = '<?php echo $_SESSION["name"]?>'</script>
    <script src="JS/jquery-ui.js"></script>
    <script src="JS/SideEffects.js"></script>
<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Treatments"; 
    include('Commons/header.php');  
?>
    <style id="dynamic_style"></style>

    <style>


        #page-topbar,.vertical-menu{
            display: none;
        }

        .main-content, .page-content,.container-fluid{
            margin: 0;
            padding: 0
        }

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

        .drop_separator {
            width: 100%;
            text-align: center;
            display: block;
            font-size: 13px;
            margin: 16px 0 0;
            font-weight: 600;
            color: #777;
            background: #eee;
            padding: 8px 0;
            border-radius: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .show_on_change{
            display: none;
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

            <div class="page-content p-0" style="padding-bottom: 0">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row d-none">
                        <div class="col-12">
                            <div class="page-title-box d-flex justify-content-between flex-column">
                                <h2 class="mb-0 snt font-weight-bold">Log Treatment Interruptions</h2>
                                <br>
                                <h5 class="mb-0 snt font-size-15 font-weight-normal" style="color: #666">Log your treatment interruptions here. Click on a day to begin</h5>
                                

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
                    
                    <div class="l2r" style="align-items: start; gap: 18px;">
                        <div class="card m-0" style="flex: 1; height: 100vh; box-shadow: none">
                            <div class="card-body">

                                <div class="empty_state">
                                    <div>
                                        <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="48" cy="48" r="47.75" fill="#F9D7EF"/>
                                            <path d="M48 31.5417C44.7448 31.5417 41.5628 32.5069 38.8562 34.3154C36.1496 36.1239 34.0401 38.6943 32.7944 41.7017C31.5488 44.709 31.2228 48.0183 31.8579 51.2109C32.4929 54.4035 34.0604 57.3361 36.3622 59.6378C38.6639 61.9395 41.5965 63.507 44.7891 64.1421C47.9817 64.7771 51.2909 64.4512 54.2983 63.2055C57.3057 61.9598 59.8761 59.8503 61.6846 57.1438C63.493 54.4372 64.4583 51.2552 64.4583 48C64.4583 45.8387 64.0326 43.6985 63.2055 41.7017C62.3784 39.7049 61.1661 37.8905 59.6378 36.3622C58.1095 34.8339 56.2951 33.6216 54.2983 32.7945C52.3015 31.9674 50.1613 31.5417 48 31.5417ZM49.6458 54.5833C49.6458 55.0198 49.4724 55.4385 49.1637 55.7471C48.8551 56.0558 48.4365 56.2292 48 56.2292C47.5635 56.2292 47.1448 56.0558 46.8362 55.7471C46.5275 55.4385 46.3541 55.0198 46.3541 54.5833V46.3542C46.3541 45.9177 46.5275 45.499 46.8362 45.1904C47.1448 44.8817 47.5635 44.7083 48 44.7083C48.4365 44.7083 48.8551 44.8817 49.1637 45.1904C49.4724 45.499 49.6458 45.9177 49.6458 46.3542V54.5833ZM48 43.0625C47.6745 43.0625 47.3562 42.966 47.0856 42.7851C46.8149 42.6043 46.604 42.3472 46.4794 42.0465C46.3548 41.7458 46.3223 41.4148 46.3858 41.0956C46.4493 40.7763 46.606 40.4831 46.8362 40.2529C47.0664 40.0227 47.3596 39.866 47.6789 39.8025C47.9981 39.739 48.3291 39.7716 48.6298 39.8961C48.9305 40.0207 49.1876 40.2316 49.3684 40.5023C49.5493 40.773 49.6458 41.0912 49.6458 41.4167C49.6458 41.8532 49.4724 42.2718 49.1637 42.5805C48.8551 42.8891 48.4365 43.0625 48 43.0625Z" fill="#71207D"/>
                                        </svg>
                                        <h5 class="mt-2 mb-0 snt font-size-15 font-weight-normal es_message" style="color: #666">Click on a day to begin</h5>
                                        <div class="d-flex flex-column mt-3">
                                            <button class="btn btn-outline-primary start_log mt-3 p-3 px-4" style="display: none; box-shadow: rgb(42 2 43 / 9%) 1px 6px 40px 1px;" data-type="chemo">Log Missed Chemotherapy</button>
                                            <button class="btn btn-outline-primary start_log mt-3 p-3 px-4" style="display: none; box-shadow: rgb(42 2 43 / 9%) 1px 6px 40px 1px;" data-type="radio">Log Missed Radiotherapy</button>
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    .drop_d .sweetselect, .drop_d input, .extender {
                                        padding: 17px 42px;
                                        background: #fff !important;
                                        color: #000 !important;
                                        border: none;
                                        font-size: 14px;
                                        /* pointer-events: none; */
                                    }
                                    .drop_d{
                                        width: 100%;
                                        position: relative;
                                    }

                                    div#datepicker {
                                        margin-top: 41px;
                                    }
                                    .drop_separator {
                                        text-align: left;
                                        background: none;
                                        letter-spacing: unset;
                                        text-transform: capitalize;
                                        color: #000;
                                        font-size: 17px;
                                        font-weight: 500;
                                        margin: 0 !important;
                                    }
                                    .card-body{
                                        padding: 0;
                                    }
                                    .sub-state{
                                        border: none;
                                        padding: 0;
                                    }
                                    .drop_d span {
                                        display: none;
                                    }
                                    .i-g-block-label {
                                        background: #f9f9f9
                                    }
                                    .drop_d, .simple_flex {
                                        margin: 0 !important;
                                    }
                                    .extender {
                                        border: 1px solid #8D2D9233 !important;
                                        border-radius: 100px;
                                    }
                                    .t2b.as_sheet{
                                        margin-bottom: 20px
                                    }
                                    .t2b .l2r{
                                        gap: 20px;
                                    }
                                    .l2r .drop_d{
                                        flex: 1;
                                    }
                                    .drop_d input, .drop_d textarea{
                                        border: 1px solid #8D2D9233 !important;
                                        border-radius: 30px;
                                    }
                                </style>

                                <div class="side_effect_items" data-type="chemo" style="display: none">
                                
                                    <!-- <p class="card-title font-size-20 mb-2 current-state align-center" style="text-transform: capitalize">Log Treatment Interruptions</p> -->
                                    <h5 class="mb-4 snt font-size-15 font-weight-normal sub-state" style="color: #000">No treatment interruptions has been logged today. Log them below</h5>
                                   
                                    <div class="t2b as_sheet">     
    
                                        <div class="drop_d to_remove type_breast type_head_and_neck type_male_pelvic type_female_pelvic">
                                            <label class="i-g-block-label">Select an option</label>
                                            <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                            <select class="sweetselect sfx_select visibility_controller" id="missed">
                                                <option value="" selected disabled>Select an option</option>
                                                <option value="No">No Treatment</option>
                                                <option value="Yes">Missed Treatment</option>
                                            </select>
                                        </div>
    
                                        <div class="mt-3 drop_d show_on_change to_remove type_breast type_head_and_neck type_male_pelvic type_female_pelvic">
                                            <label class="i-g-block-label">Reason for missed treatment</label>
                                            <div class="simple_flex mt-2 mb-4">
                                                <textarea id="reason" cols="30" rows="10" placeholder="Type your reason here" class="sweetselect" style="min-height: 125px;"></textarea>
                                                <!-- <input type="text" placeholder="Enter surgery type here" id="surgery_type_other"> -->
                                            </div>
                                        </div>
    
                                        
                                    </div>
                                    
                                    <button class="btn-primary btn-lg mt-4" id="add-chemo-data" style="padding: 13px 30px !important;font-size: 15px !important;border-radius: 50px !important;margin: 0 auto 25px;left: 50%;position: relative;transform: translateX(-50%);">Log Chemotherapy Interruption</button>
                                    <button class="btn-primary btn-lg mt-4" id="update-chemo-data" style="padding: 13px 30px !important;font-size: 15px !important;border-radius: 50px !important;margin: 0 auto 25px;left: 50%;position: relative;transform: translateX(-50%); display: none">Update Chemotherapy Interruption</button>

                                </div>


                                
                                <div class="side_effect_items" data-type="radio" style="display: none">
                                
                                    <!-- <p class="card-title font-size-20 mb-2 current-state align-center" style="text-transform: capitalize">Log Treatment Interruptions</p> -->
                                    <h5 class="mb-4 snt font-size-15 font-weight-normal sub-state" style="color: #000">No treatment interruptions has been logged today. Log them below</h5>


                                    <div class="t2b as_sheet">  
                                    
                                        <div class="drop_d to_remove type_breast type_head_and_neck type_male_pelvic type_female_pelvic">
                                            <label class="i-g-block-label">Select an option</label>
                                            <span style=" position: absolute; right: 10px; top: 34px; font-size: 20px">&#8964;</span>
                                            <select class="sweetselect sfx_select visibility_controller" id="r-missed">
                                                <option value="" selected disabled>Select an option</option>
                                                <option value="No">No Treatment</option>
                                                <option value="Yes">Missed Treatment</option>
                                            </select>
                                        </div>
    
                                        <div class="mt-3 drop_d show_on_change to_remove type_breast type_head_and_neck type_male_pelvic type_female_pelvic">
                                            <label class="i-g-block-label">Reason for missed treatment</label>
                                            <div class="simple_flex mt-2 mb-4">
                                                <textarea id="r-reason" cols="30" rows="10" placeholder="Type your reason here" class="sweetselect" style="min-height: 125px;"></textarea>
                                                <!-- <input type="text" placeholder="Enter surgery type here" id="surgery_type_other"> -->
                                            </div>
                                        </div>
    
                                        <div class="mt-3 drop_d for_radio show_on_change to_remove type_breast type_head_and_neck type_male_pelvic type_female_pelvic" style="display: none">
                                            <label class="i-g-block-label">Change in Treatment Schedule</label>
                                            <div class="simple_flex mt-2 mb-4">
                                                <textarea id="r-change" cols="30" rows="10" placeholder="Type your reason here" class="sweetselect" style="min-height: 125px;"></textarea>
                                            </div>
                                        </div>

                                    </div>


                                    <button class="btn-primary btn-lg mt-4" id="add-radio-data" style="padding: 13px 30px !important;font-size: 15px !important;border-radius: 50px !important;margin: 0 auto 25px;left: 50%;position: relative;transform: translateX(-50%);">Log Radiotherapy Interruption</button>
                                    <button class="btn-primary btn-lg mt-4" id="update-radio-data" style="padding: 13px 30px !important;font-size: 15px !important;border-radius: 50px !important;margin: 0 auto 25px;left: 50%;position: relative;transform: translateX(-50%); display: none">Update Radiotherapy Interruption</button>

                                </div>
                            </div>
                        </div>
                        <div id="datepicker"></div>
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>
    
    <script>var AUTH_NAME = '<?php echo $_SESSION["name"]?>'</script>
    <script src="JS/jquery-ui.js"></script>
    <script src="JS/LogTreatmentInterruptions.js"></script>
    <script>
        $(document).ready(function(){
            $('.S-Treatments').addClass('mm-active').find('span').css('color', '#fff')
        })
    </script>
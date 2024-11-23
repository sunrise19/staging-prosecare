<?php 

  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
  error_reporting(0);

  session_start();
  if(!isset($_SESSION["id"])){
      header('location: ../../Login');
  }

  $SECTION = $_REQUEST['SECTION'];
  $LESSON = $_REQUEST['LESSON'];
  if($SECTION == 5){
    header('Location: ./?SECTION=6');
    return;
  }
  if (!in_array($SECTION, ['', 1, 2, 3, 4, 6, 7, 8])){
    header('Location: ./');
    return;
  }

  include('../../STATIC_API/Config.php');

  $user_id = $_SESSION["id"];

  $LAST_SECTION = 1;
  $LAST_LESSON = 1;
  $DOWNLOAD_DATE = '';
  $DOWNLOAD_NAME = '';

  $sqlProgress = "SELECT * FROM starpipe_progress WHERE user_id='$user_id'";

  $resultProgress = mysqli_query($conn, $sqlProgress);

  if ($resultProgress->num_rows > 0) {

    while($rowProgress = $resultProgress->fetch_assoc()) {
      $LAST_SECTION = $rowProgress['module'];
      $LAST_LESSON = $rowProgress['lesson'];
      $DOWNLOAD_DATE = $rowProgress['download_date'];
      $DOWNLOAD_NAME = $rowProgress['download_name'];
    }
  }

  $_SESSION['CURRENT_SECTION'] = $SECTION;
  $_SESSION['CURRENT_LESSON'] = $LESSON;

  $_SESSION['LAST_SECTION'] = $LAST_SECTION;
  $_SESSION['LAST_LESSON'] = $LAST_LESSON;

  if(intval($SECTION) > intval($LAST_SECTION) || (intval($SECTION) == intval($LAST_SECTION) && intval($LESSON) > intval($LAST_LESSON))){
    header('Location: ./?SECTION='.$LAST_SECTION.'&LESSON='.$LAST_LESSON);
  }

?>
<!DOCTYPE html>
<html lang="en" data-theme="light" style="color-scheme: light;">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="shortcut icon" href="../../favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
  <link href="../../assets/css/sweetalert.css"  rel="stylesheet" type="text/css" />
  <!-- <link href="../../assets/css/oncopadi.css" rel="stylesheet" type="text/css" /> -->
  <link href="./starpipe_files/css2" rel="stylesheet">
  <title>STARPIPE &bull; PROSE Care</title>
  <link rel="stylesheet" href="./../Commons/bootstrap.css">
  <link rel="stylesheet" href="starpipe_files/style.css">
  <script>
    let SHOULD_AUTOPLAY = true
  </script>
</head>

<body class="chakra-ui-light">

  <div id="root">
    <div class="css-j7qwjs" style="width: 100%;">
      <div class="css-nwirxm"><img src="./starpipe_files/Logo.png" class="chakra-image css-1gri224" onclick="window.location.href='../News'">
        <div class="css-1vakbk4"><img src="./starpipe_files/user.svg" class="chakra-image css-7d3f7d"><img
            src="./starpipe_files/bell.svg" class="chakra-image css-7d3f7d"></div>
      </div>


    <?php

      echo '<script>const SECTION = "'.$SECTION.'", 
                          LESSON = "'.$LESSON.'", 
                          LAST_SECTION = "'.$LAST_SECTION.'", 
                          DOWNLOAD_DATE = "'.$DOWNLOAD_DATE.'",
                          DOWNLOAD_NAME = "'.$DOWNLOAD_NAME.'",
                          SHOULD_DOWNLOAD_CERTIFICATE = "'.$_SESSION['SHOULD_DOWNLOAD_CERTIFICATE'].'"
            </script>';

      $_SESSION['SHOULD_DOWNLOAD_CERTIFICATE'] = false;

      if($SECTION == '' || $SECTION == '8'){
        echo '<script>
                SHOULD_AUTOPLAY = false;
                const VIDEO_ID = "E6b70BWJCuI"
              </script>';
      }

      if($SECTION == '1'){
             if($LESSON == 1){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
        else if($LESSON == 2){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
        else if($LESSON == 3){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
        else if($LESSON == 4){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
        else if($LESSON == 5){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
        else if($LESSON == 6){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
        else if($LESSON == 7){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
        else if($LESSON == 8){echo '<script> const VIDEO_ID = "4SCjXcBeW1E" </script>';}
      }

      if($SECTION == '2'){
             if($LESSON == 1){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 2){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 3){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 4){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 5){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 6){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 7){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 8){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
        else if($LESSON == 9){echo '<script> const VIDEO_ID = "6DaJVZBXETE" </script>';}
      }

      if($SECTION == '3'){
             if($LESSON == 1){echo '<script> const VIDEO_ID = "mgFQXiAtbqg" </script>';}
        else if($LESSON == 2){echo '<script> const VIDEO_ID = "mgFQXiAtbqg" </script>';}
        else if($LESSON == 3){echo '<script> const VIDEO_ID = "mgFQXiAtbqg" </script>';}
        else if($LESSON == 4){echo '<script> const VIDEO_ID = "mgFQXiAtbqg" </script>';}
        else if($LESSON == 5){echo '<script> const VIDEO_ID = "mgFQXiAtbqg" </script>';}
        else if($LESSON == 6){echo '<script> const VIDEO_ID = "mgFQXiAtbqg" </script>';}
      }

      if($SECTION == '4'){
             if($LESSON == 1){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
        else if($LESSON == 2){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
        else if($LESSON == 3){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
        else if($LESSON == 4){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
        else if($LESSON == 5){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
        else if($LESSON == 6){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
        else if($LESSON == 7){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
        else if($LESSON == 8){echo '<script> const VIDEO_ID = "M3dhYXClBbA" </script>';}
      }

      if($SECTION == '6'){
             if($LESSON == 1){echo '<script> const VIDEO_ID = "sW7U8IAQqf8" </script>';}
        else if($LESSON == 2){echo '<script> const VIDEO_ID = "sW7U8IAQqf8" </script>';}
        else if($LESSON == 3){echo '<script> const VIDEO_ID = "sW7U8IAQqf8" </script>';}
        else if($LESSON == 4){echo '<script> const VIDEO_ID = "sW7U8IAQqf8" </script>';}
        else if($LESSON == 5){echo '<script> const VIDEO_ID = "sW7U8IAQqf8" </script>';}
      }
 
      if($SECTION == '7'){
        echo '<script> const VIDEO_ID = "XKocK1Ce13M" </script>';
      }


      if($SECTION == '' || $SECTION == '8'){
        echo '
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content"> 
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Course Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body" id="player"></div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="css-4et7f3" style="background: linear-gradient(275.23deg, rgb(141, 45, 146) -0.39%, rgba(0, 0, 0, 0.81) 94.9%); gap: 70px;">
              <div class="css-1rusfad">
                <div class="css-i987ij" onclick="window.location.href=\'./../News\'"><img src="./starpipe_files/arrow_left.svg"
                    class="chakra-image css-xo4uye">Back to
                  News</div>
                <div class="css-1811skr">
                  <p class="chakra-text css-r65h83">Comprehensive Cancer Care: From Diagnosis to Survivorship</p>
                  <p class="chakra-text css-zbz3vj">
                    This course aims to equip healthcare professionals with the knowledge and skills necessary to deliver
                    comprehensive and compassionate care to individuals affected by cancer, fostering a holistic approach that
                    addresses the physical, emotional, and social aspects of the disease.
                  </p>
                  <div class="css-52utlh">
                    <div class="css-1k9efnl"><img src="./starpipe_files/profile.svg" class="chakra-image css-1phd9a0">20,000+
                      Learners</div>
                    <div class="css-1k9efnl"><img src="./starpipe_files/calendar.svg"
                        class="chakra-image css-1phd9a0">Duration: 3 months</div>
                  </div>
                  <div class="css-52utlh">
                    <div class="css-1k9efnl">
                      <p class="chakra-text css-1cbgjwz">4.8</p><img src="./starpipe_files/star_rating.svg"
                        class="chakra-image css-1phd9a0">(1,249 ratings) &nbsp; &nbsp; 2,945 Doctors
                    </div>
                  </div>
                </div><button type="button" class="chakra-button css-ez23ye" id="start_course"
                  style="background: rgb(255, 255, 255); gap: 20px; align-items: center; margin: 10px 0px; padding: 33px; border-radius: 100px; cursor: pointer; max-width: 300px; width: 100%;">
                  <a class="chakra-text css-1ngwfrh" >'.($LAST_SECTION == '8' ? 'Retake' : 'Start').' Course</a>
                </button>
              </div>
              <div class="css-e2ilqs" data-toggle="modal" data-target="#addModal"><img src="./starpipe_files/virus.png" class="chakra-image css-1hmt6a4"><button
                  type="button" class="chakra-button css-ez23ye"
                  style="background: rgb(255, 255, 255); gap: 20px; align-items: center; margin: 10px 0px; padding: 33px; border-radius: 100px; cursor: pointer; max-width: 300px; width: 100%;"><img
                    src="./starpipe_files/play.svg" class="chakra-image css-0"
                    style="width: 50px; height: 50px; object-fit: cover; transform: scale(1.7) translateY(4px); margin-left: -50px;">
                  <p class="chakra-text css-1ngwfrh">Watch Preview</p>
                </button></div>
            </div>
        ';
      }else{
        echo '<div class="video_holder"><div id="player"></div></div>';
      }

    ?>

      
      <div class="css-1rtsff7" style="gap: 70px; background: rgb(255, 255, 255);">
        <div class="css-6krbs4">

          <?php 
          
            if($SECTION == '' || $SECTION == '8'){
              echo '
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Description</p>
                  <p class="chakra-text css-zbz3vj">This course provides a comprehensive overview of cancer care, covering
                    various aspects from initial diagnosis to survivorship. Through a combination of lectures, case studies,
                    and practical exercises, participants will gain a deep understanding of cancer biology, treatment
                    modalities, supportive care strategies, and survivorship issues. Emphasis will be placed on
                    interdisciplinary collaboration, patient-centered care, and evidence-based practices.</p>
                </div>

                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Course Curriculum</p>
                  <div class="css-xtuv2h">
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/note.svg" class="chakra-image css-1phd9a0">
                      6 Modules
                    </div>•<div class="css-1k9efnl"><img src="./starpipe_files/clock.svg"
                        class="chakra-image css-1phd9a0">10.4h Duration</div>
                  </div>
                  <div class="chakra-accordion css-0"
                    style="border: 1px solid rgba(141, 45, 146, 0.11); border-radius: 10px; background: rgba(141, 45, 146, 0.04);">
                    <div class="chakra-accordion__item css-1t7rcca"><button type="button" id="accordion-button-:r1:"
                        aria-expanded="false" aria-controls="accordion-panel-:r1:" class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 0px solid rgba(141, 45, 146, 0.11); border-radius: 0px;">
                        <p class="chakra-text css-zypneq">Pre-module</p><svg viewBox="0 0 24 24" focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div class="chakra-collapse" style="overflow: hidden; display: none; opacity: 0; height: 0px;">
                        <div role="region" id="accordion-panel-:r1:" aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3">
                          This module provides an overview of cancer, including its definition, types, and stages. It
                          discusses the principles guiding the multidisciplinary management of cancer, with a focus on
                          empathetic communication and sensitive prognosis delivery. The roles of various healthcare
                          professionals in the cancer care team, such as Psychologists, Oncologists, Oncology Nurses, Family
                          Physicians (FP), and Primary Care Providers (PCP), are also highlighted.
                          <br>
                          <br>
                          <span>&bull; What is Cancer?</span>
                          <br>
                          <span>&bull; Principle of Cancer Treatment</span>
                        </div>
                      </div>
                    </div>
                    <div class="chakra-accordion__item css-1t7rcca"><button type="button" id="accordion-button-:r5:"
                        aria-expanded="false" aria-controls="accordion-panel-:r5:" class="chakra-accordion__button css-uttm9k"
                        data-index="1"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;">
                        <p class="chakra-text css-zypneq">Module 1: Acute Oncology Overview (60 mins)</p><svg
                          viewBox="0 0 24 24" focusable="false" class="chakra-icon chakra-accordion__icon css-1pnpq3i"
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div class="chakra-collapse" style="overflow: hidden; display: none; opacity: 0; height: 0px;">
                        <div role="region" id="accordion-panel-:r5:" aria-labelledby="accordion-button-:r5:"
                          class="chakra-accordion__panel css-1llu7e3">This module focuses on the acute side effects of cancer
                          treatments such as Chemotherapy, Radiotherapy, Surgery, and Immunotherapy. It covers the
                          psychological, physical, and financial impacts of these side effects on patients. The module also
                          highlights the important role of caregivers and psychotherapy in supporting patients during their
                          treatment.</div>
                      </div>
                    </div>
                    <div class="chakra-accordion__item css-1t7rcca"><button type="button" id="accordion-button-:r9:"
                        aria-expanded="false" aria-controls="accordion-panel-:r9:" class="chakra-accordion__button css-uttm9k"
                        data-index="2"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;">
                        <p class="chakra-text css-zypneq">Module 2 : Standardising the Acute side effects Reporting</p><svg
                          viewBox="0 0 24 24" focusable="false" class="chakra-icon chakra-accordion__icon css-1pnpq3i"
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div class="chakra-collapse" style="overflow: hidden; display: none; opacity: 0; height: 0px;">
                        <div role="region" id="accordion-panel-:r9:" aria-labelledby="accordion-button-:r9:"
                          class="chakra-accordion__panel css-1llu7e3">This module addresses challenges and limitations of
                          current subjective reporting practices and compares them with modern digital approaches through case
                          studies. The module covers guidelines such as CTCAE, RTOG, and NCCN, with a detailed look at the
                          patient and healthcare professional versions of CTCAE. Participants will also learn about remote
                          symptom monitoring using PROSEcare, which improves communication and collaboration among healthcare
                          professionals.</div>
                      </div>
                    </div>
                    <div class="chakra-accordion__item css-1t7rcca"><button type="button" id="accordion-button-:rd:"
                        aria-expanded="false" aria-controls="accordion-panel-:rd:" class="chakra-accordion__button css-uttm9k"
                        data-index="3"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;">
                        <p class="chakra-text css-zypneq">Module 3 : Management of acute side effects</p><svg
                          viewBox="0 0 24 24" focusable="false" class="chakra-icon chakra-accordion__icon css-1pnpq3i"
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div class="chakra-collapse" style="overflow: hidden; display: none; opacity: 0; height: 0px;">
                        <div role="region" id="accordion-panel-:rd:" aria-labelledby="accordion-button-:rd:"
                          class="chakra-accordion__panel css-1llu7e3">This module covers clinical evaluation techniques,
                          severity grading, and management strategies for chemotherapy-related side effects like Neutropenia,
                          as well as those from radiotherapy, immunotherapy, and surgery. Participants will learn about both
                          pharmacological and non-pharmacological interventions to prevent and manage these side effects
                          effectively. Emphasis is placed on promoting treatment adherence to optimize patient outcomes during
                          cancer treatment.</div>
                      </div>
                    </div>
                    <div class="chakra-accordion__item css-1t7rcca"><button type="button" id="accordion-button-:rh:"
                        aria-expanded="false" aria-controls="accordion-panel-:rh:" class="chakra-accordion__button css-uttm9k"
                        data-index="4"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;">
                        <p class="chakra-text css-zypneq">Module 4 (Pending)</p><svg viewBox="0 0 24 24" focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div class="chakra-collapse" style="overflow: hidden; display: none; opacity: 0; height: 0px;">
                        <div role="region" id="accordion-panel-:rh:" aria-labelledby="accordion-button-:rh:"
                          class="chakra-accordion__panel css-1llu7e3">Pending...</div>
                      </div>
                    </div>
                    <div class="chakra-accordion__item css-1t7rcca"><button type="button" id="accordion-button-:rl:"
                        aria-expanded="false" aria-controls="accordion-panel-:rl:" class="chakra-accordion__button css-uttm9k"
                        data-index="5"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;">
                        <p class="chakra-text css-zypneq">Module 5: Implementing Standardized Reporting</p><svg
                          viewBox="0 0 24 24" focusable="false" class="chakra-icon chakra-accordion__icon css-1pnpq3i"
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div class="chakra-collapse" style="overflow: hidden; display: none; opacity: 0; height: 0px;">
                        <div role="region" id="accordion-panel-:rl:" aria-labelledby="accordion-button-:rl:"
                          class="chakra-accordion__panel css-1llu7e3">This module offers practical strategies for cancer
                          specialists and primary care physicians to enhance patient care through standardized protocols.
                          Participants will learn about the significance of quality improvement management and leadership,
                          empowering them to lead positive change in their centers. The module also covers advocating for
                          standardized acute side effects monitoring and management, developing essential soft skills and
                          leadership traits, and sharing acute side effects data in clinical meetings to improve research
                          visibility and patient outcomes.</div>
                      </div>
                    </div>
                    <div class="chakra-accordion__item css-1t7rcca"><button type="button" id="accordion-button-:rh:"
                        aria-expanded="false" aria-controls="accordion-panel-:rh:" class="chakra-accordion__button css-uttm9k"
                        data-index="4"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;">
                        <p class="chakra-text css-zypneq">Post Module</p><svg viewBox="0 0 24 24" focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div class="chakra-collapse" style="overflow: hidden; display: none; opacity: 0; height: 0px;">
                        <div role="region" id="accordion-panel-:rh:" aria-labelledby="accordion-button-:rh:"
                          class="chakra-accordion__panel css-1llu7e3">
                            • Recap
                            <br>
                            • Call to action; improving service delivery in acute side effect, research, adopting technology and leadership
                            <br>
                            • Recommend; Join consortium, share information to other HCPs
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              ';
            }
          
            if($SECTION == '1'){
              echo '
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Pre-module</p>
                  <p class="chakra-text css-zbz3vj">This module provides an overview of cancer, including its definition, types, and stages. It discusses the principles guiding the multidisciplinary management of cancer, with a focus on empathetic communication and sensitive prognosis delivery. The roles of various healthcare professionals in the cancer care team, such as Psychologists, Oncologists, Oncology Nurses, Family Physicians (FP), and Primary Care Providers (PCP), are also highlighted.</p>
                </div>
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Objectives</p>
                  <p class="chakra-text css-zbz3vj">At the end of this module, you will be able to:
                    <br>
                  1. Describe the principles of cancer treatment, including the role of different healthcare professionals and treatment modalities. 
                  <br>
                  2. Explain the cancer patient journey map, focusing on key stages, challenges, and support needed at each step.
                  <br>
                  3. Discuss the approach to cancer patients and care, emphasizing empathy, effective communication, and understanding prognosis.</p>
                </div>

                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Lessons</p>
                  <div class="css-xtuv2h">
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/note.svg" class="chakra-image css-1phd9a0">
                      8 Lessons
                    </div>•<div class="css-1k9efnl"><img src="./starpipe_files/clock.svg"
                        class="chakra-image css-1phd9a0">10.4h Duration</div>
                  </div>
                  <div 
                    class="chakra-accordion css-0"
                    style="border: 1px solid rgba(141, 45, 146, 0.11); border-radius: 10px; background: rgba(141, 45, 146, 0.04);"
                  >
                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 0px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          What is Cancer?
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Principle of Cancer Treatment
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Cancer Patient Journey map
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Approach to cancer patients and care - empathy, communication, and prognosis
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          The role of the cancer care team - Psychologist, Oncologists, Oncology nurses, FP, PCP, Palliative care team.
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Treatment Modalities
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Overview of STAR-PIPE curriculum - How many modules, what to expect, tasks
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Orientation and Support
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->
                    
                   
                  </div>
                </div>
              ';
            }
          
            if($SECTION == '2'){
              echo '
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Module 1: Acute Oncology Overview</p>
                  <p class="chakra-text css-zbz3vj">
                    This module focuses on the acute side effects of cancer treatments such as 
                    Chemotherapy, Radiotherapy, Surgery, and Immunotherapy. It covers the 
                    psychological, physical, and financial impacts of these side effects on patients. The 
                    module also highlights the important role of caregivers and psychotherapy in 
                    supporting patients during their treatment.
                  </p>
                </div>
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Objectives</p>
                  <p class="chakra-text css-zbz3vj">At the end of this module, you will be able to:
                    <br>
                    1. Define acute side effects and their impact on patients undergoing cancer treatment.
                    <br>
                    2. Differentiate and describe the prevalent acute side effects associated with various cancer treatment methods (e.g., chemotherapy, radiation therapy, immunotherapy)
                    <br>
                    3. Examine psychosocial impacts of acute side effects, evaluate their influence on patients and their support systems, and contribute to a holistic understanding of overall well-being
                  </p>
                </div>

                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Lessons</p>
                  <div class="css-xtuv2h">
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/note.svg" class="chakra-image css-1phd9a0">
                      9 Lessons
                    </div>
                    •
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/clock.svg" class="chakra-image css-1phd9a0">
                      60 mins Duration
                    </div>
                  </div>
                  <div 
                    class="chakra-accordion css-0"
                    style="border: 1px solid rgba(141, 45, 146, 0.11); border-radius: 10px; background: rgba(141, 45, 146, 0.04);"
                  >
                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 0px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq"> 
                          The acutely ill cancer patient: What  they look like, why is it acute, causes etc
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Case Study: PROSE FGD findings on side effects reporting
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Acute side effects of Chemotherapy
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Acute side effects of Radiotherapy
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Acute side effects of Surgery
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Acute side effects of Immunotherapy
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Impact of acute side effects - Psychology, physical/body image/functioning and finance Adjustment training for PCPs and Oncologists
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          The role of PCP, caregiver &amp; psychotherapy
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Cancer Survivor Story
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->
                    
                   
                  </div>
                </div>
              ';
            }
          
            if($SECTION == '3'){
              echo '
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Module 2: Standardising the Acute Side Effects Reporting</p>
                  <p class="chakra-text css-zbz3vj">
                    This module addresses the challenges and limitations of current subjective 
                    reporting practices and compares them with modern digital approaches through 
                    case studies. The module covers guidelines such as CTCAE, RTOG, and NCCN, with a
                    detailed look at the patient and healthcare professional versions of CTCAE. 
                    Participants will also learn about remote symptom monitoring using PROSEcare, 
                    which improves communication and collaboration among healthcare professionals.
                  </p>
                </div>
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Objectives</p>
                  <p class="chakra-text css-zbz3vj">At the end of this module, you will be able to:
                    <br>
                    1. Understand the importance of standardized reporting of acute side effects in cancer treatment
                    <br>
                    2. Assess and critically analyze the challenges and limitations of current practices in reporting and managing acute side effects.
                    <br>
                    3. Demonstrate proficiency in employing assessment tools to effectively measure and communicate the severity of acute side effects, with an emphasis on accuracy and relevance for clinical decision-making and patient care.
                  </p>
                </div>

                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Lessons</p>
                  <div class="css-xtuv2h">
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/note.svg" class="chakra-image css-1phd9a0">
                      6 Lessons
                    </div>
                    •
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/clock.svg" class="chakra-image css-1phd9a0">
                      60 mins Duration
                    </div>
                  </div>
                  <div 
                    class="chakra-accordion css-0"
                    style="border: 1px solid rgba(141, 45, 146, 0.11); border-radius: 10px; background: rgba(141, 45, 146, 0.04);"
                  >
                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 0px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq"> 
                          Conventional methods of  reporting acute side effects -  Largely Subjective  assessment. Case study: Pt  from one of the five cancer  centers
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          The importance of standardizing  side effect reporting: Px,  researchers, HCP, Hospital  administrators
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Digital methods of reporting acute  side effects - Largely Objective  assessment. Case Study: Pt on the PROSE app feedback
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Remote symptom monitoring: PROSEcare
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Deep dive into CTCAE - Patient &  HCP Version ( Task ) - PCP to  moderate
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Overview of Guidelines for side effects reporting - CTCAE, RTOG, NCCN
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->
                   
                  </div>
                </div>
              ';
            }
          
            if($SECTION == '4'){
              echo '
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Module 3: Management of acute side effects</p>
                  <p class="chakra-text css-zbz3vj">
                    chemotherapy-related side effects like Neutropenia, as well as those from 
                    radiotherapy, immunotherapy, and surgery. Participants will learn about both 
                    pharmacological and non-pharmacological interventions to prevent and manage 
                    these side effects effectively. Emphasis is placed on promoting treatment 
                    adherence to optimize patient outcomes during cancer treatment.
                  </p>
                </div>
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Objectives</p>
                  <p class="chakra-text css-zbz3vj">At the end of this module, you will be able to:
                    <br>
                    1. Critically evaluate and synthesize evidence-based interventions for the effective management of acute side effects experienced in cancer treatment
                    <br>
                    2. Explore both pharmacological and non-pharmacological interventions, critically assessing their applicability and effectiveness in preventing and managing acute side effects holistically.
                    <br>
                    3. Recognize and assess strategies that facilitate cancer treatment adherence,  including patient-centered approaches and support systems.
                  </p>
                </div>

                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Lessons</p>
                  <div class="css-xtuv2h">
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/note.svg" class="chakra-image css-1phd9a0">
                      8 Lessons
                    </div>
                    •
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/clock.svg" class="chakra-image css-1phd9a0">
                      60 mins Duration
                    </div>
                  </div>
                  <div 
                    class="chakra-accordion css-0"
                    style="border: 1px solid rgba(141, 45, 146, 0.11); border-radius: 10px; background: rgba(141, 45, 146, 0.04);"
                  >
                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 0px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq"> 
                          Assessment of the acutely ill cancer  patient in the tertiary care setting:  Clinical history, examination,  performance status ( Karnofsky),  grading and severity
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Management of chemotherapy- related acute side effects e.g  Neutropenia
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Management of Radiotherapy- related acute side effects
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Management of Immunotherapy- related side effects
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Management of surgery-related side effects
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Promoting treatment adherence
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Psychosocial challenges affecting  treatment adherence
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Empowering patients and  caregivers to improve treatment  adherence
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->
                   
                  </div>
                </div>
              ';
            }
          
            if($SECTION == '6'){
              echo '
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Module 5: Implementing Standardized Reporting</p>
                  <p class="chakra-text css-zbz3vj">
                    This module offers practical strategies for cancer specialists and primary care 
                    physicians to enhance patient care through standardized protocols. Participants will 
                    learn about the significance of quality improvement management and leadership, 
                    empowering them to lead positive change in their centers. The module also covers 
                    advocating for standardized acute side effects monitoring and management, 
                    developing essential soft skills and leadership traits, and sharing acute side effects 
                    data in clinical meetings to improve research visibility and patient outcomes.
                  </p>
                </div>
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Objectives</p>
                  <p class="chakra-text css-zbz3vj">At the end of this module, you will be able to:
                    <br>
                    1. Evaluate and analyze strategies for the effective implementation of standardized reporting and management practices within healthcare settings, considering their impact on patient care and quality improvement.
                    <br>
                    2. Critically assess the role of leadership and stakeholder engagement in promoting standardized practices, exploring how these factors influence successful adoption and adherence to protocols.
                    <br>
                    3. Cultivate practical leadership skills and deepen your understanding of strategies to enhance research visibility, preparing you to lead and facilitate positive transformations in healthcare settings.
                  </p>
                </div>

                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Lessons</p>
                  <div class="css-xtuv2h">
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/note.svg" class="chakra-image css-1phd9a0">
                      5 Lessons
                    </div>
                    •
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/clock.svg" class="chakra-image css-1phd9a0">
                      60 mins Duration
                    </div>
                  </div>
                  <div 
                    class="chakra-accordion css-0"
                    style="border: 1px solid rgba(141, 45, 146, 0.11); border-radius: 10px; background: rgba(141, 45, 146, 0.04);"
                  >
                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 0px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq"> 
                          Advocacy for standardized acute  side effects monitoring and  management
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Getting Stakeholder buy-in
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          How to Lead an Optimized Side Effects Clinic (10 steps to Adopt to improve TSEC)
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Interpreting data and responding to  challenges in service delivery
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Soft skills and leadership traits
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->
                   
                  </div>
                </div>
              ';
            }
          
            if($SECTION == '7'){
              echo '
                <div class="css-1153lrp">
                  <p class="chakra-text css-fs82u4">Post Module</p>
                  <p class="chakra-text css-zbz3vj">
                    &bull; Recap
                    <br>
                    &bull; Call to action; improving service  delivery in acute side effect,  research, adopting technology and  leadership
                    <br> 
                    &bull; Recommend; Join consortium,  share information to other HCPs
                  </p>
                </div>

                <div class="css-1153lrp" style="display: none">
                  <p class="chakra-text css-fs82u4">Objectives</p>
                  <p class="chakra-text css-zbz3vj">At the end of this module, you will be able to:
                    <br>
                    1. &nbsp;
                    <br>
                    2. &nbsp;
                  </p>
                </div>

                <div class="css-1153lrp" style="display: none">
                  <p class="chakra-text css-fs82u4">Lessons</p>
                  <div class="css-xtuv2h">
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/note.svg" class="chakra-image css-1phd9a0">
                      3 Lessons
                    </div>
                    •
                    <div class="css-1k9efnl">
                      <img src="./starpipe_files/clock.svg" class="chakra-image css-1phd9a0">
                      60 mins Duration
                    </div>
                  </div>
                  <div 
                    class="chakra-accordion css-0"
                    style="border: 1px solid rgba(141, 45, 146, 0.11); border-radius: 10px; background: rgba(141, 45, 146, 0.04);"
                  >
                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 0px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq"> 
                          Recap
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Call to action; improving service  delivery in acute side effect,  research, adopting technology and  leadership
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->
                   

                    <!-- START OF ACCORDION ITEM -->
                    <div class="chakra-accordion__item css-1t7rcca no_dropdown">
                      <button 
                        type="button" 
                        id="accordion-button-:r1:"
                        aria-expanded="false" 
                        aria-controls="accordion-panel-:r1:" 
                        class="chakra-accordion__button css-uttm9k"
                        data-index="0"
                        style="outline: none; padding: 15px 20px; box-shadow: none; border-top: 1px solid rgba(141, 45, 146, 0.11); border-radius: 0px;"
                      >
                        <p class="chakra-text css-zypneq">
                          Recommend; Join consortium,  share information to other HCPs
                        </p>
                        <svg 
                          viewBox="0 0 24 24" 
                          focusable="false"
                          class="chakra-icon chakra-accordion__icon css-1pnpq3i" 
                          aria-hidden="true">
                          <path fill="currentColor" d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
                        </svg>
                      </button>
                      <div 
                        class="chakra-collapse" 
                        style="overflow: hidden; display: none; opacity: 0; height: 0px;"
                      >
                        <div 
                          role="region" 
                          id="accordion-panel-:r1:" 
                          aria-labelledby="accordion-button-:r1:"
                          class="chakra-accordion__panel css-1llu7e3"
                        >
                          ---
                        </div>
                      </div>
                    </div>
                    <!-- END OF ACCORDION ITEM -->
                   
                  </div>
                </div>
              ';
            }

          ?>


        </div>
        
        
        <?php 
          if($SECTION == '' || $SECTION == '8'){
            echo '
              <div class="css-1hcvwu2">
                <p class="chakra-text css-1hoas8a">This Course Includes :</p>
                <p class="chakra-text css-0">• &nbsp;10.4 hours on-demand videos</p>
                <p class="chakra-text css-0">• &nbsp;3 study materials</p>
                <p class="chakra-text css-0">• &nbsp;Full lifetime access</p>
                <p class="chakra-text css-0">• &nbsp;Certificate of completion</p>
                <hr style="margin: 30px 0px 25px; border-color: rgba(255, 255, 255, 0.5);">
                <p class="chakra-text css-1hoas8a">Sharable Certificate</p><img src="./starpipe_files/certificate.png"
                  class="chakra-image css-8atqhb">'.(
                  $SECTION == '8' || $LAST_SECTION == '8' ? '
                <div class="download_and_share">
                  <button class="btn btn-primary white modal_trigger" data-target="download_certificate" id="download_certificate">Download Certificate</button>
                  <!--<img src="starpipe_files/share.svg" class="share_certificate"/>-->
                </div>' : ''
                  ).'
              </div>
            ';
          }
        ?>
      </div>


      <!-- START OF SKILLS INSTRUCTORS COMMENTS -->
      <div class="skills_instructors_comments">


        <!-- START OF SKILLS -->
        <div class="css-1153lrp" <?php echo 'style="display: none"'; ?> >
          <p class="chakra-text css-fs82u4">Skills covered in this <?php echo $SECTION == '' ? 'course' : 'module' ?></p>
          <div class="css-ny0y5t">
            <?php 
  
              if($SECTION == ''){
                echo '
                  <p class="chakra-text css-17ewzl0">Empathy</p>
                  <p class="chakra-text css-17ewzl0">Patient Centered Care</p>
                  <p class="chakra-text css-17ewzl0">Team Collaboration</p>
                ';
              }
  
              if($SECTION == '1'){
                echo '
                  <p class="chakra-text css-17ewzl0">Empathy</p>
                  <p class="chakra-text css-17ewzl0">Patient Centered Care</p>
                  <p class="chakra-text css-17ewzl0">Team Collaboration</p>
                ';
              }
  
              if($SECTION == '2'){
                echo '
                  <p class="chakra-text css-17ewzl0">Psychosocial Support</p>
                  <p class="chakra-text css-17ewzl0">Communication Skills</p>
                  <p class="chakra-text css-17ewzl0">Holistic patient Care</p>
                  <p class="chakra-text css-17ewzl0">Interdisciplinary Collaboration</p>
                ';
              }
  
              if($SECTION == '3'){
                echo '
                  <p class="chakra-text css-17ewzl0">Standardized Reporting </p>
                  <p class="chakra-text css-17ewzl0">Critical Analysis</p>
                  <p class="chakra-text css-17ewzl0">Communication Skills</p>
                  <p class="chakra-text css-17ewzl0">Clinical Decision-Making</p>
                ';
              }
  
              if($SECTION == '4'){
                echo '
                  <p class="chakra-text css-17ewzl0">Critical analysis</p>
                  <p class="chakra-text css-17ewzl0">Management of Acute Side Effects</p>
                  <p class="chakra-text css-17ewzl0">Communication Skills</p>
                  <p class="chakra-text css-17ewzl0">Patient-centred Skills</p>
                ';
              }
  
              if($SECTION == '6'){
                echo '
                  <p class="chakra-text css-17ewzl0">Leadership skills</p>
                  <p class="chakra-text css-17ewzl0">Stakeholder Collaboration</p>
                  <p class="chakra-text css-17ewzl0">Management Skills</p>
                  <p class="chakra-text css-17ewzl0">Research Skills</p>
                ';
              }
            ?>
          </div>
        </div>
        <!-- END OF SKILLS -->
  

  
        <!-- START OF INSTRUCTORS -->
        <div class="css-1153lrp">
          <p class="chakra-text css-fs82u4">Instructors</p>
          <div class="css-itsjku">
            <?php 
            
            if($SECTION == '' || $SECTION == '8'){
              echo '
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Omolola Salako</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Hanafi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Thomas</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Orekoya</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Alabi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Okunade</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Adeleke</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Mrs. AtinukeLawal Sanusi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Adaorah Enyi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Roberts</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Ass. Prof Mathew Allsop</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"><img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Mulder Lotte</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              ';
            }
            
            if($SECTION == '1'){
              echo '
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Omolola Salako</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Deborah Fakunle</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              ';
            }
      
            if($SECTION == '2'){
              echo '
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Hanafi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Adaorah</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Orekoya</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Alabi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Okunade</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Omolola Salako</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Adeleke</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Mrs Atinuke Lawal Sanusi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              ';
            }
              
            if($SECTION == '3'){
              echo '
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Hanafi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Alabi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Adaorah</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              ';
            }
              
            if($SECTION == '4'){
              echo '
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Hanafi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Roberts</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Orekoya</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Omolola Salako</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Okunade</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Alabi</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Adeleke</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              ';
            }
              
            if($SECTION == '6'){
              echo '
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Asst. Professor Matthew Allsop</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Omolola Salako</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Roberts</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Mulder Lotte</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              ';
            }
              
            if($SECTION == '7'){
              echo '
                <!--START INSTRUCTOR-->
                <div 
                  class="css-k008qs"
                  style="gap: 20px; align-items: center; margin: 10px 0px; border-radius: 7px; cursor: pointer;"
                >
                  <img
                    src="./starpipe_files/instructor.png" class="chakra-image css-0"
                    style="width: 70px; height: 70px; object-fit: cover;">
                  <div class="css-1jkxyqi">
                    <p class="chakra-text css-1eqwtzi">Dr. Omolola Salako</p>
                    <p class="chakra-text css-1dkxh63">Lorem ipsum dolor sit</p>
                  </div>
                </div>
                <!--END INSTRUCTOR-->
              ';
            }
  
            ?>
            
          </div>
        </div>
        <!-- END OF INSTRUCTORS -->
        


        <!-- START OF COMMENTS -->
        <?php 
  
          $photo = $_SESSION["photo"];
          $full_name = $_SESSION['name'];
          preg_match_all('/(?<=\b)\w/iu',$full_name,$matches);
  
          if($photo == '' || $photo == 'empty.png'){
              $USER_PHOTO ='<div class="complaint_user_photo"><span class="complaint_user_initials">'.strtoupper(implode('', $matches[0])).'</span></div>';
          }else{
              $USER_PHOTO ='<div class="complaint_user_photo" style="background-image: url(\'../PROFILE_PHOTOS/'.$photo.'\');"></div>';
          }
  
          if($SECTION == '3'){
  
            $sql = "SELECT count(1) FROM comments WHERE course='$SECTION'";
            $result = mysqli_query($conn, $sql);
            $comments_count = mysqli_fetch_array($result);
  
            echo '
            <div class="whole_comments">
              <span class="css-fs82u4 d-block mb-5" style="font-size: 34px;" id="comment_count">Comments ('.$comments_count[0].')</span>
              <div class="col-lg-12 col-sm-12 px-0">
                <div class="d-flex justify-content-between align-items-start" style="gap: 10px;background: #fff;padding: 23px;border-radius: 10px;">
                  '.$USER_PHOTO.'
                  <div class="input-group outlined" style="flex: 1;border-radius: unset;background: unset;padding: 0;">
                    <textarea name="" placeholder="Add a comment..." id="new_comment_area" cols="30" rows="5"
                      class="form-control form-control-lg parent-outline font-size-14"
                      style="width: 100%;resize: none"></textarea>
                  </div>
                  <button type="button" class="btn btn-secondary img_btn" id="send_comment">Send</button>
                </div>
  
                <div class="complaints_holder pt-4" style=" min-height: unset; max-height: unset;" id="main_comments_list">
  
                </div>
  
              </div>
            </div>
            ';
          } 
        ?>
        <!-- END OF COMMENTS -->


      </div>
      <!-- END OF SKILLS INSTRUCTORS COMMENTS -->


    </div>
    <div class="Toastify"></div><span id="__chakra_env" hidden=""></span>
  </div>
  <!-- <script type="module" src="./starpipe_files/main.jsx"></script> -->

  <?php 
    if($LAST_SECTION == '8' && $DOWNLOAD_DATE == ''){
      echo '
        <div class="star_modal" style="display: flex" data-id="download_certificate">
          <div class="star_modal_bg"></div>
          <div class="star_modal_section">
            <div class="modal_close">
              <span>+</span>
            </div>
            <img src="starpipe_files/success.jpg" alt="Success" class="star_success_icon">
            <h3 class="star_modal_title">Welldone Dr. '. $full_name . '!</h3>
            <h6 class="star_modal_content">You have successfully completed the STARPIPE Course, please enter your full name as you’d like it to appear on your Certificate</h6>
            <div class="star_modal_input_group">
              <label>Full Name</label>
              <input value="" placeholder="Full Name" id="certificate_full_name"/>
            </div>
            <button class="btn btn-primary" id="get_certificate">Get Certificate</button>
          </div>
        </div>      
      ';
    }
  
  ?>


  <div class="chakra-portal">
    <div role="region" aria-live="polite" aria-label="Notifications-top" id="chakra-toast-manager-top"
      style="position: fixed; z-index: var(--toast-z-index, 5500); pointer-events: none; display: flex; flex-direction: column; margin: 0px auto; top: env(safe-area-inset-top, 0px); right: env(safe-area-inset-right, 0px); left: env(safe-area-inset-left, 0px);">
    </div>
    <div role="region" aria-live="polite" aria-label="Notifications-top-left" id="chakra-toast-manager-top-left"
      style="position: fixed; z-index: var(--toast-z-index, 5500); pointer-events: none; display: flex; flex-direction: column; top: env(safe-area-inset-top, 0px); left: env(safe-area-inset-left, 0px);">
    </div>
    <div role="region" aria-live="polite" aria-label="Notifications-top-right" id="chakra-toast-manager-top-right"
      style="position: fixed; z-index: var(--toast-z-index, 5500); pointer-events: none; display: flex; flex-direction: column; top: env(safe-area-inset-top, 0px); right: env(safe-area-inset-right, 0px);">
    </div>
    <div role="region" aria-live="polite" aria-label="Notifications-bottom-left" id="chakra-toast-manager-bottom-left"
      style="position: fixed; z-index: var(--toast-z-index, 5500); pointer-events: none; display: flex; flex-direction: column; bottom: env(safe-area-inset-bottom, 0px); left: env(safe-area-inset-left, 0px);">
    </div>
    <div role="region" aria-live="polite" aria-label="Notifications-bottom" id="chakra-toast-manager-bottom"
      style="position: fixed; z-index: var(--toast-z-index, 5500); pointer-events: none; display: flex; flex-direction: column; margin: 0px auto; bottom: env(safe-area-inset-bottom, 0px); right: env(safe-area-inset-right, 0px); left: env(safe-area-inset-left, 0px);">
    </div>
    <div role="region" aria-live="polite" aria-label="Notifications-bottom-right" id="chakra-toast-manager-bottom-right"
      style="position: fixed; z-index: var(--toast-z-index, 5500); pointer-events: none; display: flex; flex-direction: column; bottom: env(safe-area-inset-bottom, 0px); right: env(safe-area-inset-right, 0px);">
    </div>
  </div>

  <?php 

    if($LAST_SECTION == 8 && $DOWNLOAD_DATE != '' && $DOWNLOAD_NAME != ''){
      echo '
        <div 
          id="certificate-content" 
          style="
            width: 2526px;
            height: 1785px;
            background-size: contain;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -100;
          "
        >
        </div>
      
        <script id="auto_delete">
          function generateCertificate() {

            if (LAST_SECTION != "8" || DOWNLOAD_DATE == "" || DOWNLOAD_NAME == "") {
                Swal.fire({ title: "Oops", html: "You are not eligible for downloading your certificate", type: "error" })
                return
            }

            Swal.fire({
                title: "Downloading Certificate",
                onBeforeOpen: function () { Swal.showLoading() }
            })

            setTimeout(() => {
                
                // Get the image link from input
                let imageLink = "starpipe_files/cert_template.png";
        
                // Create a new image element
                let img = new Image();
        
                // Set the source of the image to the provided link
                img.src = imageLink;
        
                // When the image is loaded
                img.onload = function () {
                    // Get the div element
                    let div = document.getElementById("certificate-content");
        
                    // Create a canvas element
                    let canvas = document.createElement("canvas");
                    canvas.width = div.offsetWidth;
                    canvas.height = div.offsetHeight;
        
                    // Get the canvas context
                    let context = canvas.getContext("2d");
        
                    // Draw the image onto the canvas as the background
                    context.drawImage(img, 0, 0, canvas.width, canvas.height);
        
                    // Draw the div content onto the canvas
                    // context.font = "italic 190px \'Dancing Script\', cursive"; // Optional, set font style
                    context.font = "italic 190px cursive"; // Optional, set font style
                    context.fillStyle = "black"; // Optional, set text color
        
                    let textWidth = context.measureText(DOWNLOAD_NAME).width; // Measure the width of the text
                    let x = (canvas.width - textWidth) / 2; // Calculate the starting position for center alignment
                    let y = 900; // Y coordinate
                    context.fillText(DOWNLOAD_NAME, x, y); // Draw text
        
                    context.font = "italic 33px cursive"
                    context.fillStyle = "black"
                    context.fillText(DOWNLOAD_DATE, 150, 1430);
        
                    context.font = "italic 33px cursive"
                    context.fillStyle = "black"
                    context.fillText("Dr. Omolola Salako", 1405, 1410);
        
                    context.font = "italic 33px cursive"
                    context.fillStyle = "black"
                    context.fillText("Dr. Adaorah Enyi", 2030, 1410);
        
                    // Convert the canvas to a blob
                    canvas.toBlob(function (blob) {
                        // Create a temporary link to download the image
                        let link = document.createElement("a");
                        link.download = `STARPIPE_CERTIFICATE_${DOWNLOAD_NAME?.toUpperCase()?.replaceAll(" ", "_")}.png`;
                        link.href = URL.createObjectURL(blob);
        
                        // Click the link to trigger the download
                        link.click();
                        Swal.close()
                        // Clean up by revoking the object URL
                        URL.revokeObjectURL(link.href);
                    }, "image/png");
                };

            }, 0);

          }
          document.querySelector("body").removeChild(document.getElementById("auto_delete"))
        </script>
      
      ';
    }

  ?>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="starpipe_files/starpipe.js"></script>
<style>
  .swal2-icon {
    margin: 0 0 9px 0 !important;
    transform: scale(0.6) !important;
  }
  .swal2-title {
    font-size: 20px !important;
  }
  .swal2-actions button{
    margin: 0.3125em;
    box-shadow: none;
    font-weight: 500;
    border: none !important;
    padding: 9px 21px !important;
    border-radius: 7px !important;
    font-size: .8125rem !important;
  }
</style>

</html>
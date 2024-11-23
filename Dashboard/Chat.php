<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Chat"; 
    include('Commons/header.php');  
?>

    <link rel="stylesheet" href="CSS/_audio_recorder.css">
    <link rel="stylesheet" href="CSS/chat.css">

    <script>const IS_HCP = '<?php $_SESSION["hcp"]; ?>'</script>
    <style id="dynamic_style"></style>


    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid" style="padding: 0">

                <div class="d-lg-flex" style=" height: 100%; ">

                    <!-- CHAT LIST -->
                    <div class="chat-leftsidebar col-12" style="padding: 45px; background: #F9F9F9">

                        <!-- start page title -->
                        <div class="row col-12">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; "><?php echo isset($_SESSION["superadmin"]) ? 'Support' : 'Chat' ?></h2>
                                    <div class="start_new_chat">
                                        <i class="bx bx-plus-circle"></i>
                                        Start New Chat
                                    </div>
                                    <div class="back_to_recents d-none">
                                        <i class="bx bx-left-arrow-circle"></i>
                                        Back To Recent Chats
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->        

                        <div>
                            
                            <div class="search-box chat-search-box py-4" style=" padding-top: 0 !important; ">
                                <div class="position-relative">
                                    <input type="text" class="form-control find_contact" placeholder="Search Contacts">
                                    <i class="mdi mdi-magnify search-icon"></i>
                                </div>
                            </div>

                            <div class="chat-leftsidebar-nav">

                                <ul class="nav nav-pills nav-justified d-none">
                                    <li class="nav-item">
                                        <a data-open="chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                            <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                            <span class="d-none d-sm-block">Chats</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-open="contacts" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="bx bx-book-content font-size-20 d-sm-none"></i>
                                            <span class="d-none d-sm-block">Contacts</span>
                                        </a>
                                    </li>
                                </ul>
                                
                                <div class="tab-content">

                                    <div class="tab-pane active" id="chat">
                                        <div>
                                            <ul class="list-unstyled chat-list" data-simplebar="init" >
                                                <div class="simplebar-wrapper" style="margin: 0px;">
                                                    <div class="simplebar-height-auto-observer-wrapper">
                                                        <div class="simplebar-height-auto-observer"></div>
                                                    </div>
                                                    <div class="simplebar-mask">
                                                        <div class="simplebar-offset" style="right: -20px; bottom: 0px;">
                                                            <div class="simplebar-content-wrapper" style="height: auto; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;">
                                                                <div class="simplebar-content" style="padding: 0px;overflow: auto;height: calc(100vh - 230px);">
                                                                    <span class="py-3 d-block">Loading recent chat...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="simplebar-placeholder" style="width: auto; height: 485px;"></div>
                                                </div>
                                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                    <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                                </div>
                                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                    <div class="simplebar-scrollbar" style="height: 361px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane show" id="contacts">
                                        <div>
                                            <ul class="list-unstyled chat-list" data-simplebar="init" >
                                                <div class="simplebar-wrapper" style="margin: 0px;">
                                                    <div class="simplebar-height-auto-observer-wrapper">
                                                        <div class="simplebar-height-auto-observer"></div>
                                                    </div>
                                                    <div class="simplebar-mask">
                                                        <div class="simplebar-offset" style="right: -20px; bottom: 0px;">
                                                            <div class="simplebar-content-wrapper" style="height: auto; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;">
                                                                <div class="simplebar-content" style="padding: 0px;overflow: auto;height: calc(100vh - 244px);">

                                                                    <?php 

                                                                        include('../STATIC_API/Config.php');

                                                                        $user_id = $_SESSION["id"];

                                                                        if(isset($_SESSION["hcp"]) || isset($_SESSION["studycoordinator"])){

                                                                            // GET ALL PATIENTS
                                                                            $sql = "SELECT * FROM patients JOIN users ON patients.user_id = users.user_id";
    
                                                                            $result = $conn->query($sql);
    
                                                                            if ($result->num_rows > 0) {
    
                                                                                echo '<div class="grouper">Patients</div>';
    
                                                                                while($row = $result->fetch_assoc()) {
    
                                                                                    if($row["user_id"] != $user_id){
    
                                                                                        echo '
                                                                                            <li class="open_chat from_contacts_list" data-user="PROSE-'.$row["user_id"].'" data-type="Patient">
                                                                                                <a href="javascript: void(0);">
                                                                                                    <h5 class="font-size-14 mb-0">'.($_SESSION["hcp_123"] ? $row["pin"] : $row["first_name"] . ' ' . $row["last_name"] ).'</h5>
                                                                                                </a>
                                                                                            </li>';
                                                                                    }
    
    
                                                                                }
    
                                                                            }
                                                                        }
                                                                            // END OF GET ALL PATIENTS
    
    
    
                                                                        // if(isset($_SESSION["patients"]) || isset($_SESSION["studycoordinator"]) || isset($_SESSION["hcp"])){
                                                                            // GET ALL HCP
                                                                            $sql = "SELECT * FROM hcp JOIN users ON hcp.user_id = users.user_id";
    
                                                                            $result = $conn->query($sql);
    
                                                                            if ($result->num_rows > 0) {

                                                                                $res = '';
    
                                                                                while($row = $result->fetch_assoc()) {
    
                                                                                    if($row["user_id"] != $user_id){

                                                                                        $res .= '
                                                                                            <li class="open_chat from_contacts_list" data-user="PROSE-'.$row["user_id"].'" data-type="Health Care Professional">
                                                                                                <a href="javascript: void(0);">
                                                                                                    <h5 class="font-size-14 mb-0">'.$row["first_name"] . ' ' . $row["last_name"] .'</h5>
                                                                                                </a>
                                                                                            </li>';
                                                                                    }
    
    
                                                                                }

                                                                                if($res != ''){
                                                                                    echo '<div class="grouper" style="margin-top: 30px">Health Care Professionals</div>';
                                                                                    echo $res;
                                                                                }

                                                                                
    
                                                                            }
                                                                            // END OF GET ALL HCP

                                                                        // }
                                                                        
                                                                        // if(isset($_SESSION["superadmin"]) || isset($_SESSION["patient"])){
    
                                                                            $sql = "SELECT * FROM studycoordinator JOIN users ON studycoordinator.user_id = users.user_id";
    
                                                                            $result = $conn->query($sql);

                                                                            $limit = 0;

                                                                            if(isset($_SESSION["studycoordinator"])){
                                                                                $limit = 1;
                                                                            }
    
                                                                            if ($result->num_rows > $limit) {

                                                                                $res = '';
    
                                                                                while($row = $result->fetch_assoc()) {
    
                                                                                    if($row["user_id"] != $user_id){
    
                                                                                        $res .= '
                                                                                            <li class="open_chat from_contacts_list" data-user="PROSE-'.$row["user_id"].'" data-type="Study Coordinator">
                                                                                                <a href="javascript: void(0);">
                                                                                                    <h5 class="font-size-14 mb-0">'.$row["first_name"] . ' ' . $row["last_name"] .'</h5>
                                                                                                </a>
                                                                                            </li>';
                                                                                    }
    
    
                                                                                }

                                                                                if($res != ''){
                                                                                    echo '<div class="grouper" style="margin-top: 30px">Study Coordinator</div>';
                                                                                    echo $res;
                                                                                }
    
                                                                            }
                                                                        // }

                                                                    ?>
                                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="simplebar-placeholder" style="width: auto; height: 485px;"></div>
                                                </div>
                                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                    <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                                </div>
                                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                    <div class="simplebar-scrollbar" style="height: 361px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>

                                
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- END OF CHAT LIST -->
                    
                    <!-- USER CHAT -->
                    <div class="w-100 user-chat d-none">
                        <div class="card" style=" height: 100%; ">
                            <div class="px-4 py-2 border-bottom">
                                <div class="row">
                                    <div class="col-md-1 col-3 pr-2">
                                        <i class="bx bx-left-arrow-alt back_to_chatlist" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>
                                    </div>
                                    <div class="col-md-10 col-9" style=" display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px ">
                                        <img src="IMG/empty.png" class="rounded-circle avatar-xs active_chat_photo mb-2" style=" width: 50px; height: 50px; ">
                                        <h5 class="font-size-16 mb-0 active_chat_name"></h5>
                                        <p class="text-muted mb-0 user_type" style="color: #02B033 !important;display: flex;align-items: center;gap: 8px;font-size: 15px;">
                                            <i style="width: 11px;height: 11px;display: inline-flex;font-style: normal;background: #02B033;border-radius: 30px;"></i>
                                            Online
                                        </p>
                                    </div>
                                    <div class="col-md-1 col-3 pr-2" style=" text-align: right; ">
                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                            <li class="list-inline-item  d-none d-sm-inline-block">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn dropdown-toggle open_profile" style=" background: none; " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded" style="font-size: 30px; padding: 10px;"></i>
                                                    </button>
                                                    <!--
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                    -->
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="chat_parent">
                                <div class="contacts_btn"></div>
                                <div class="chat-conversation px-3">
                                    <ul class="list-unstyled mb-0" data-simplebar="init" style="max-height: calc(100vh - 206px);">
                                        <div class="simplebar-wrapper" style="margin: 0px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: -20px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" style="height: auto; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;">
                                                        <div class="simplebar-content chat-output" style="padding: 0px;">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: auto; height: 645px;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                            <div class="simplebar-scrollbar" style="height: 377px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                        </div>
                                    </ul>
                                </div>
                                <div class="voice_note_section">
                                    <div class="audio-recording-container">
                                        <!-- <i class="start-recording-button bx bx-microphone" aria-hidden="true"></i> -->
                                        <div class="recording-contorl-buttons-container hide">
                                            <i class="cancel-recording-button bx bx-x-circle" aria-hidden="true"></i>
                                            <div class="recording-elapsed-time">
                                                <i class="red-recording-dot bx bxs-circle" aria-hidden="true"></i>
                                                <p class="elapsed-time"></p>
                                            </div>
                                            <i class="stop-recording-button bx bx-stop-circle" aria-hidden="true"></i>
                                        </div>
                                        <div class="text-indication-of-audio-playing-container">
                                            <span class="send_note hide">Send</span>
                                            <!--<p class="text-indication-of-audio-playing hide">Audio is playing<span>.</span><span>.</span><span>.</span></p>-->
                                        </div>
                                    </div>
                                    <div class="overlay hide">
                                        <div class="browser-not-supporting-audio-recording-box">
                                            <p>To record audio, use browsers like Chrome and Firefox that support audio recording.</p>
                                            <button type="button" class="close-browser-not-supported-box">Ok.</button>
                                        </div>
                                    </div>

                                    <audio controls class="audio-element hide">
                                    </audio>
                                </div>
                                <div class="p-3 chat-input-section">
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="text" class="form-control chat-input" placeholder="Start a new message">
                                            </div>
                                        </div>
                                        <div class="col-auto" style=" align-items: center; display: flex; gap: 14px; ">
                                            <input id="upload_files" type="file" name="upload_files[]" multiple="multiple" style="display: none" />
                                            <a href="javascript: void(0);" title="Add Files" style=" color: #000; " class="add_files">
                                                <i class="bx bx-paperclip" style="font-size: 27px"></i>
                                            </a>
                                            <a href="javascript: void(0);" title="Record Voice" style=" color: #000; ">
                                                <i class="start-recording-button bx bx-microphone" style="font-size: 27px"></i>
                                            </a>
                                            <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"
                                            style="
                                                background: #8D2D92;
                                                border-radius: 50px !important;
                                                width: 41px;
                                                padding: 0 !important;
                                                height: 41px;
                                                min-width: unset;
                                            ">
                                                <i class="mdi mdi-send" style="font-size: 19px"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END OF USER CHAT -->

                </div>

            </div>


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

    <?php include('Commons/footer.php');?>

    <script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-analytics.js"></script>
    <script>
        log('Viewed Chat', 'View')
        const firebaseConfig = {
            apiKey: "AIzaSyBnp-GgL2USkqctQajLi2BTEmIXDFjpvEI",
            authDomain: "prosechat.firebaseapp.com",
            projectId: "prosechat",
            storageBucket: "prosechat.appspot.com",
            messagingSenderId: "683826061338",
            appId: "1:683826061338:web:ecf4ab47d6b866161431a3",
            measurementId: "G-SSSX3GB86Q"
        };
        firebase.initializeApp(firebaseConfig);

        const DB = firebase.firestore(),
            ROOMS_DB = DB.collection('rooms'),
            MESSAGES_DB = DB.collection('messages'),
            FIRE_ID = 'PROSE-<?php echo $_SESSION["id"]; ?>'

        let CHAT_IDENTIFIER = '',
            RECEIVER = '',
            fulldays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]

        
    </script>

    <script src="JS/Chat.js"></script>
    <script src="JS/_audio_recorder.js"></script>
    <script src="JS/_audio_elements.js"></script>

    <style>
        .treament_modal{
            z-index: 9999;
        }
    </style>


</body>

</html>
<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Home"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');
    $user_id = $_SESSION["id"];
?>

<link rel="stylesheet" href="./Commons/data-table.css">


<style>
    .table{
        margin-top: 0;
    }
</style>

        <div class="main-content">

            <div class="page-content p-4" style=" padding-bottom: 0; ">
                <div class="container-fluid">

                    <div class="css-nwirxm">
                        <div class="header_name_and_photo">
                            <img src="IMG/<?php echo $_SESSION["photo"]; ?>" class="chakra-image css-1gri224" onclick="window.location.href='./Profile-HCP'">
                            <div class="text-section">
                                <span>Welcome,</span>
                                <span class="header_hcp_name">Dr. <?php echo $_SESSION["name"];?></span>
                            </div>
                        </div>
                        <div class="css-1vakbk4">
                            <img src="./STARPIPE/starpipe_files/user.svg" class="chakra-image css-7d3f7d cursor-pointer" onclick="window.location.href='./Profile-HCP'">
                            <img src="./STARPIPE/starpipe_files/bell.svg" class="chakra-image css-7d3f7d cursor-pointer">
                        </div>
                    </div>


                    <?php 
                     if(isset($_SESSION["admin"]) || $_SESSION["type"] == "hospital"){
                        echo '
                            <div class="row" style=" justify-content: end; padding: 0 12px 20px; ">
                                <button class="btn-primary btn-label" onclick="location.href = \'./BoardMeetings#Create\'"><i class="bx bx-plus label-icon"></i>Create Board Meeting</button>
                            </div>';
                     }
                    ?>
                    
                    
                    <div class="row">
                        
                        <div class="col-md-4" onclick="location.href = './Patients'">
                            <div class="card mini-stats-wid home_outlined_card">
                                <div class="card-body">
                                    <div class="media flex-row">
                                        <div class="media-body align-items-center">
                                            <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM users WHERE user_type='patient'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo number_format($row[0]);
                                                ?>
                                            </h4>
                                            <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Patients</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4" onclick="location.href = './HCP'">
                            <div class="card mini-stats-wid home_outlined_card">
                                <div class="card-body">
                                    <div class="media flex-row">
                                        <div class="media-body align-items-center">
                                            <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM sideeffects";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo number_format($row[0]);
                                                ?>
                                            </h4>
                                            <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Patients logged side effects</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-4" onclick="location.href = './HCP'">
                            <div class="card mini-stats-wid home_outlined_card">
                                <div class="card-body">
                                    <div class="media flex-row">
                                        <div class="media-body align-items-center">
                                            <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM appointments WHERE hcp_id=$user_id";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo number_format($row[0]);
                                                ?>
                                            </h4>
                                            <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">New Appointments</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4" onclick="location.href = './Chat'" style="display: none">
                            <div class="card mini-stats-wid home_outlined_card">
                                <div class="card-body">
                                    <div class="media flex-row">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mr-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #F9D7EF !important">
                                                <i class="bx bxs-chat font-size-24" style="color: #71207D"></i>
                                            </span>
                                        </div>
                                        <div class="media-body align-items-center">
                                            <h4 class="mb-1 unread_messages font-weight-bold" style="color: #57166A; font-size: 35px">
                                                0
                                            </h4>
                                            <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Unread Message(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                            $sql = "SELECT * FROM hcp JOIN next_of_kin ON hcp.user_id=next_of_kin.user_id WHERE hcp.user_id='$user_id'";

                            $result = mysqli_query($conn, $sql);

                            $progress = 0;

                            $data;

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {

                                    $data = $row;

                                    if ($_SESSION["photo"] != '' && $_SESSION["photo"] != 'empty.png') {
                                        $progress = 25;

                                        if ($row['name'] != '' && $row['last_name'] != '' && $row['email'] != '' && $row['phone'] != '' && $row['gender'] != '' && $row['relationship'] != '' && $row['address'] != '' && $row['country'] != '') {
                                            $progress = 50;

                                            if ($row['specialty'] != '' && $row['hospital'] != '' && $row['practicing_mdcn_license'] != '' && $row['mdcn_registration'] != '' && $row['fellowship_license'] != '') {
                                                $progress = 75;
                                            }
                                            else{
                                                $progress = 100;
                                            }

                                        } 

                                    } 
                                    
                                }
                            }

                            if ($progress < 100) {
                                echo '
                                    <div class="col-12 mt-2 mb-5" style="cursor: pointer">
                                        <div class="css-nwirxm mb-0" onclick="location.href = \'./Profile-HCP#Edit\'" style="background: #ED3F321A">
                                            <div class="header_name_and_photo">
                                                <div class="circular_progress progress_' . $progress . '">
                                                    ' . $progress . '%
                                                </div>
                                                <div class="text-section" style="color: #000">
                                                    <span style=" font-weight: 600; font-size: 14px; ">Complete your profile setup</span>
                                                    <span>We need to verify your identity, click here to complete your profile setup</span>
                                                </div>
                                            </div>
                                            <div class="css-1vakbk4">
                                                <i class="bx bx-chevron-right" style="font-size: 35px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }

                        ?>


                        <div class="col-12" style=" display: flex; gap: 24px; ">

                            <div class="col-md-8 p-4" style="background: #F9F9F9; border-radius: 10px;">
                                <span class="section_title">Recent Activity</span>
                                <div class="recent_activities">
                                    <?php
    
                                        $sql = "SELECT * FROM logs JOIN patients on logs.user_id=patients.user_id WHERE NOT log_type='View' ORDER BY logs.log_id DESC LIMIT 100";
                                                        
                                        $result = mysqli_query($conn, $sql);
    
                                        if ($result->num_rows > 0) {
    
                                            while($row = $result->fetch_assoc()) {
    
                                                echo  '
                                                        <div class="log_entry">
                                                            <img class="log_entry_icon" src="IMG/'.($row['log_type'] == 'New Log' ? 'sfx.svg' : 'bell.svg' ).'"/>
                                                            <span class="entry_logger">'.$row['first_name'] . ' ' . $row['last_name'].'</span>
                                                            <span class="log_text">'.$row['log_action'].'</span>
                                                            <span class="log_date">'.$row['log_date'].'</span>
                                                        </div>
                                                    ';
    
                                            }
    
                                        }
                                    ?>
                                </div>
                            </div>
    
                            <div class="col-md-4 p-4" style="background: #F9F9F9; border-radius: 10px;">
                                <span class="section_title">Side Effects Overview</span>
                                <?php

                                    $sql = "SELECT * FROM sideeffects";

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
                                        tiredness='.intval($tiredness).', 
                                        vomiting='.intval($vomiting).', 
                                        nausea='.intval($nausea).', 
                                        mouth_sore='.intval($mouth_sore).',
                                        headache='.intval($headache).'
                                    </script>';
                                ?>
                                <div class="recent_activities" id="sfx_chart"></div>
                            </div>

                        </div>  
                        
                        <div class="col-12 mt-4">
                            <span class="section_title">Quick Actions</span>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid home_outlined_card sm" style="background: #8D2D9212">
                                <div class="card-body">
                                    <div class="media flex-row align-items-center">
                                        <div class="avatar-sm rounded-circle mr-4">
                                            <img src="IMG/survey.svg" style=" width: 35px; height: 100%; object-fit: contain; ">
                                        </div>
                                        <div class="media-body align-items-center">
                                            <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Create Survey</p>
                                        </div>
                                        <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mini-stats-wid home_outlined_card sm" style="background: #C6F1F73D">
                                <div class="card-body">
                                    <div class="media flex-row align-items-center">
                                        <div class="avatar-sm rounded-circle mr-4">
                                            <img src="IMG/head.svg" style=" width: 45px; height: 100%; object-fit: contain; ">
                                        </div>
                                        <div class="media-body align-items-center">
                                            <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Questions</p>
                                        </div>
                                        <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="card mini-stats-wid home_outlined_card sm" style="background: #FEB6301C">
                                <div class="card-body">
                                    <div class="media flex-row align-items-center">
                                        <div class="avatar-sm rounded-circle mr-4">
                                            <img src="IMG/desk.svg" style=" width: 45px; height: 100%; object-fit: contain; ">
                                        </div>
                                        <div class="media-body align-items-center">
                                            <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Help &amp; Support</p>
                                        </div>
                                        <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                                    </div>
                                </div>
                            </div>
                        </div>
                

                    </div> 
                    <!-- end row -->

                    
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content here!!!-->
        

        <?php 
            // $conn->close();
            include('./Commons/footer.php');
        ?>

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            var options = {
                    chart: {
                        type: 'area',
                        height: 320,
                        zoom: {enabled: false},
                        pan: {enabled: false},
                        toolbar: {enabled: false},
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
                      colors: ['#8D2D92A1',]
                    },
                    stroke: {
                        curve: 'smooth',
                    },
                    series: [{
                        name: 'Severity',
                        data: [tiredness , vomiting, nausea, mouth_sore, headache]
                    }],
                    xaxis: {
                        categories: ['Tiredness', 'Vomiting', 'Nausea', 'Mouth sores', 'Headache']
                    },
                    yaxis: {
                        labels: {
                            show: false,
                        }
                    }
                }

            var chart = new ApexCharts(document.querySelector("#sfx_chart"), options);

            chart.render();
        </script>
        <style>
            .apexcharts-toolbar{
                display: none !important;
            }
        </style>

        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

        <script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-firestore.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-analytics.js"></script>
        <script>
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

            firebase.analytics()

            const DB = firebase.firestore(),
                ROOMS_DB = DB.collection('rooms'),
                MESSAGES_DB = DB.collection('messages'),
                FIRE_ID = 'PROSE-<?php echo $_SESSION["id"]; ?>'

            var CHAT_IDENTIFIER = '',
                RECEIVER = '',
                fulldays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]

                
            $(document).ready(function(){

                ROOMS_DB
                .where('users', 'array-contains-any', [FIRE_ID])
                .where('lastSender', '!=', FIRE_ID)
                .where('read', '==', false)
                .onSnapshot((querySnapshot) => {
                    let count = querySnapshot.docs.length
                    $('.unread_messages').text(count)
                    console.log(count)
                })

                if($('tr').length > 10){
                    $('#sch-table').DataTable();
                }
            });
        </script>

        


</body>

</html>
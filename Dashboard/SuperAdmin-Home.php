<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Home";
include('Commons/header.php');
include('../STATIC_API/Config.php');
$user_id = $_SESSION["id"];
$hospital_id = $_SESSION["hospital_id"];
?>

<link rel="stylesheet" href="./Commons/data-table.css">


<style>
    .table {
        margin-top: 0;
    }
</style>

<div class="main-content">

    <div class="page-content p-4" style=" padding-bottom: 0; ">
        <div class="container-fluid">


            <div class="l2r mb-5" style="gap: 30px">

                <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Dashboard</h2>

                <!-- start search -->
                <div class="search-box chat-search-box py-4" style=" padding: 0 !important; flex: 1 ">
                    <div class="position-relative">
                        <input type="text" class="form-control find_contact" placeholder="Search Patient or Doctor">
                        <i class="mdi mdi-magnify search-icon"></i>
                    </div>
                </div>
                <!-- end search -->
                <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                    <img src="../assets/images/Calendar2.svg" alt="">
                    <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                        <?php echo date("M d, Y"); ?>
                    </span>
                </div>

            </div>




            <div class="row mt-5">

                <div class="col-md-3" onclick="location.href = './Hospitals'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Hospitals Onboarded</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM hospitals";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_array($result);
                                        echo number_format($row[0]);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" onclick="location.href = './Doctors'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">HCPs Onboarded</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM hcp";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_array($result);
                                        echo number_format($row[0]);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" onclick="location.href = './Patients'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Patients Onboarded</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM patients";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_array($result);
                                        echo number_format($row[0]);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" onclick="location.href = './Patients'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Active Patients</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM sideeffects RIGHT JOIN patients ON sideeffects.patient_id=patients.patient_id GROUP BY sideeffects.patient_id";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_array($result);
                                        echo number_format($row[0]);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end row -->

            <div class="row">


                <div class="col-md-4" onclick="window.location.href = 'Create-Hospital?From=SuperAdmin-Home'">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #ED3F321A">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="../assets/images/anhospital.svg" style=" width: 52px; height: 52px; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Add New Hospital</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" onclick="window.location.href = 'Create-HCP?From=SuperAdmin-Home'">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #8D2D9212">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="../assets/images/cnhcp.svg" style=" width: 52px; height: 52px; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Create New HCP</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" onclick="window.location.href = 'Create-Patient?From=SuperAdmin-Home'">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #C6F1F73D">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="../assets/images/cnpatient.svg" style=" width: 52px; height: 52px; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Add New Patient</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row">

                <div class="col-md-8 col-sm-12">


                    <div class="p-4" style="background: #F9F9F9; border-radius: 10px;">
                        <span class="section_title">Recent Activity</span>
                        <div class="recent_activities">
                            <?php

                            $sql = "SELECT * FROM logs JOIN patients on logs.user_id=patients.user_id WHERE NOT logs.log_type='View' ORDER BY logs.log_id DESC LIMIT 100";

                            $result = mysqli_query($conn, $sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {

                                    echo  '
                                                        <div class="log_entry">
                                                            <img class="log_entry_icon" src="IMG/' . ($row['log_type'] == 'New Log' ? 'sfx.svg' : 'bell.svg') . '"/>
                                                            <span class="entry_logger">' . $row['first_name'] . ' ' . $row['last_name'] . '</span>
                                                            <span class="log_text">' . $row['log_action'] . '</span>
                                                            <span class="log_date">' . $row['log_date'] . '</span>
                                                        </div>
                                                    ';
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 col-sm-12">

                    <div class="p-4" style="background: #F9F9F9; border-radius: 10px; border: 1px solid #0000000D; text-align: left">

                        <span class="section_title">STARPIPE Overview</span>

                        <div class="col-12 p-0">
                            <div class="card mini-stats-wid home_outlined_card">
                                <div class="card-body py-0">
                                    <div class="media flex-row">
                                        <div class="media-body align-items-center">
                                            <img src="../assets/images/File_Document.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                            <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">HCPs that have started the course</p>
                                            <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                                <?php
                                                $sql = "SELECT count(1) FROM starpipe_progress GROUP BY user_id";
                                                $result = mysqli_query($conn, $sql);
                                                $row = mysqli_fetch_array($result);
                                                echo number_format($row[0]);
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="l2r mt-2">
                            <span class="section_title">Most Recent</span>
                            <span class="section_title text-primary font-size-17">See all</span>
                        </div>

                        <div class="t2b">

                                <?php

                                    $sql = "SELECT * FROM starpipe_progress JOIN hcp on starpipe_progress.user_id=hcp.user_id GROUP BY starpipe_progress.user_id ASC LIMIT 100";

                                    $result = mysqli_query($conn, $sql);

                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {

                                            $progress = (intval($row['module']) / 8) * 100;

                                            echo  '
                                                <div class="l2r w-100" style=" border-bottom: 1px solid #0000001F; ">
                                                    <span class="entry_logger">' . $row['first_name'] . ' ' . $row['last_name'] . '</span>
                                                    <div class="circular_progress progress_' . $progress . '" style=" transform: scale(0.7); ">
                                                        ' . $progress . '%
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    }
                                ?>
                        </div>
                    </div>

                </div>
            </div>

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


    $(document).ready(function() {

        ROOMS_DB
            .where('users', 'array-contains-any', [FIRE_ID])
            .where('lastSender', '!=', FIRE_ID)
            .where('read', '==', false)
            .onSnapshot((querySnapshot) => {
                let count = querySnapshot.docs.length
                $('.unread_messages').text(count)
                console.log(count)
            })

        if ($('tr').length > 10) {
            $('#sch-table').DataTable();
        }
    });
</script>




</body>

</html>
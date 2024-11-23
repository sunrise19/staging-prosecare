<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Home"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');
?>

<link rel="stylesheet" href="./Commons/data-table.css">

<style>
    .table{
        margin-top: 0;
    }
    .avatar-title, .bg-primary {
        background-color: #f28e52 !important;
        border: none;
    }
</style>

        <div class="main-content">

            <div class="page-content" style=" padding-bottom: 0; ">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12" style=" background: #8d2d90; color: #fff; border-radius: 10px; margin: 0 12px 45px; width: calc(100% - 24px); flex: none; padding: 30px 35px 85px">
                            <p class="font-weight-medium mb-2" style="font-size: 34px;font-weight: 600;">Hi  <?php echo $_SESSION["name"];?>,</p> 
                            <span>What would you like to do today?</span> 
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
                    
                    
                    <div class="row px-4" style="margin-top: -100px;">
                        
                        <div class="col-md-4" onclick="location.href = './Patients'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-row">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mr-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #F9D7EF !important">
                                                <i class="bx bxs-user font-size-24" style="color: #71207D"></i>
                                            </span>
                                        </div>
                                        <div class="media-body align-items-center">
                                            <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 28px">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM users WHERE user_type='patient'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                            <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Patients</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4" onclick="location.href = './HCP'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-row">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mr-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #F9D7EF !important">
                                                <i class="mdi mdi-stethoscope font-size-24" style="color: #71207D"></i>
                                            </span>
                                        </div>
                                        <div class="media-body align-items-center">
                                            <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 28px">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM users WHERE user_type='hcp'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                            <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Health Care Professionals</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4" onclick="location.href = './Chat'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-row">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mr-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #F9D7EF !important">
                                                <i class="bx bxs-chat font-size-24" style="color: #71207D"></i>
                                            </span>
                                        </div>
                                        <div class="media-body align-items-center">
                                            <h4 class="mb-1 font-weight-bold unread_messages" style="color: #57166A; font-size: 28px">
                                                0
                                            </h4>
                                            <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Unread Messages</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                
                  
                        
                        <div class="col-xl-12" style="display: none">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <table id="sch-table" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>NAME</th>
                                                <th>DATE OF BIRTH</th>
                                                <th>GENDER</th>
                                                <th>CATEGORY</th>
                                                <th style="width: 100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="main_output">
                                            <?php

                                                include('../STATIC_API/Config.php');

                                                $index = 0;
                                                $data = '';
                                                

                                                //GET PATIENTS
                                                $sql = 'SELECT * FROM patients';
                                                $result = $conn->query($sql);


                                                $htd = '<td style="display: none">';

                                                function getUserType($conn, $user_id){
                                                    $type = '';
                                                    $sql = "SELECT user_type FROM users WHERE user_id = '$user_id'";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $type = $row['user_type'];
                                                        }
                                                    }
                                                    return ucwords($type);
                                                }

                                                if ($result->num_rows > 0) {
                                                    

                                                    while($row = $result->fetch_assoc()) {
                                                        
                                                        ++$index;

                                                        $data .= '<tr class="entry_row" id="'.$row['patient_id'].'" user-id="'.$row['user_id'].'">
                                                                    <td>'.$index.'</b></td>
                                                                    <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                                                                    <td>'.$row['day']. ' ' .$row['month']. ', ' .$row['year'].'</td>
                                                                    <td>'.$row['gender'].'</td>
                                                                    <td>'.getUserType($conn, $row['user_id']).'</td>';
                                                        
                                                        $data .= '<td><p id="'.$row['user_id'].'" class="text-primary view-data" style="cursor: pointer"><u>View More</u></p></td>
                                                                </tr>';
                                                    }

                                                }


                                                //GET HCP
                                                $sql = 'SELECT * FROM hcp';
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    

                                                    while($row = $result->fetch_assoc()) {
                                                        
                                                        ++$index;

                                                        $data .= '<tr class="entry_row" id="'.$row['hcp_id'].'" user-id="'.$row['user_id'].'">
                                                                    <td>'.$index.'</b></td>
                                                                    <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                                                                    <td>'.$row['day']. ' ' .$row['month']. ', ' .$row['year'].'</td>
                                                                    <td>'.$row['gender'].'</td>
                                                                    <td>Health Care Professional</td>';
                                                        
                                                        $data .= '<td><p id="'.$row['user_id'].'" class="text-primary view-data" style="cursor: pointer"><u>View More</u></p></td>
                                                                </tr>';
                                                    }

                                                }

                                                if($data == ''){
                                                    $data = '<tr>
                                                        <td></td>
                                                        <td>No Users yet :/</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        </tr>';
                                                }

                                                echo $data;

                                                $conn->close();

                                            ?>
                                        </tbody>
                                    </table>
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
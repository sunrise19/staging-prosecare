<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Home"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');
?>

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
                        <div class="col-12" style=" background: #FF7702; color: #fff; border-radius: 10px; margin: 0 12px 45px; width: calc(100% - 24px); flex: none; padding: 45px 44px; ">
                            <p class="font-weight-medium" style="font-size: 18px;font-weight: 600;">Hi  <?php echo $_SESSION["name"];?>,</p> 
                            <span>Welcome to your PROSE Care account.</span> 
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
                        <div class="col-md-3" onclick="location.href = './BoardMeetings?WithFilter=Pending'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Pending Board Meetings</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $email = $_SESSION["email"];
                                                    $sql_suffix = '';
                                                    
                                                    
                                                    if($_SESSION["type"] == "patient"){
                                                        $sql_suffix = " AND patients_email LIKE '$email'";
                                                    }
                                                    
                                                    // $sql = "SELECT count(1) FROM board_meetings WHERE  . $sql_suffix;
                                                    $sql = "SELECT count(1) FROM board_meetings WHERE status='pending'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" onclick="location.href = './BoardMeetings?WithFilter=Upcoming'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Upcoming Board Meetings</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM board_meetings WHERE status='upcoming'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" onclick="location.href = './BoardMeetings?WithFilter=Ongoing'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Ongoing Board Meetings</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM board_meetings WHERE status='ongoing'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-3" onclick="location.href = './BoardMeetings?WithFilter=Completed'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Completed Board Meetings</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM board_meetings WHERE status='completed'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3" onclick="location.href = './Hospitals'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Hospitals</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM hospitals";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3" onclick="location.href = './Patients'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Patients</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM patients";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3" onclick="location.href = './HCP'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Health Care Professionals</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM hcp";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--
                        <div class="col-md-3" onclick="location.href = './Requests?WithFilter=Pending'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Pending Requests</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM requests WHERE status='pending'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3" onclick="location.href = './Requests?WithFilter=Declined'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium align-center">Declined Requests</p>
                                            <h4 class="mb-0 align-center">
                                                <?php 
                                                    $sql = "SELECT count(1) FROM requests WHERE status='declined'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row[0];
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        -->

                    </div> 
                    <!-- end row -->

                    <style>
                        #chart {
                            max-width: 100%;
                            margin: 0 auto;
                            width: 100%;
                            height: 250px;
                            min-height: 250px;
                        }
                    </style>

                    <?php 
                     if(isset($_SESSION["admin"]) ||  $_SESSION["type"] == "hospital"){
                        echo '
                            <div class="row col-12 card" style=" margin: 0; ">
                                <p class="text-muted font-weight-medium" style="margin-top: 20px;font-size: 18px;margin-left: 10px;font-weight: 600;">VTB Activity</p>
                                <div id="chart"></div>
                            </div>';
                     }
                    ?>

                    


                    
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content-->
    <?php 
        $conn->close();
        include('Commons/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script>

        var chart = '',
            data = [0, 0, 0, 0,0,0,0,0,0,0,0,0,0]

        renderChart(data)

        $(window).resize(function(){
            chart.destroy()
            renderChart(data)
        })

        function renderChart(data){

            var h = $(window).height() - 400,
                options = {
                    chart: {
                        height: h,
                        type: 'area',
                        toolbar: {
                            show: false
                        }
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        },
                    series: [{
                        name: 'Patients',
                        data: data
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    }
                }
            
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render()

        }

    </script>

</body>

</html>
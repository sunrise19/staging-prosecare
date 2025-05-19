<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "News"; 
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
    .card{
        background-size: cover;
        overflow: hidden;
    }
    .shaded_glass {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #00000061;
        left: 0;
        top: 0;
    }
    .media-body{
        position: relative;
    }
    .glass_text{
        color: #fff;
        background: #ffffff99;
        width: fit-content;
        font-size: 13px;
        padding: 3px 13px;
        border-radius: 30px;
        margin-top: 120px;
    }
    .media-body i {
        position: absolute;
        background: #fff;
        padding: 2px 1px 2px 3px;
        font-size: 19px;
        border-radius: 30px;
        left: 50%;
        transform: translateX(-50%);
        top: 26%;
    }
</style>

        <div class="main-content">

            <div class="page-content" style=" padding-bottom: 0; ">
                <div class="container-fluid">


                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">News</h2>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->        
                    
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search News">
                            <span class="bx bx-search text-black" style="color: #74788d; font-size: 22px; top: 50%; transform: translateY(-50%); left: 40px;"></span>
                        </div>
                    </form>

                    
                    <div class="row">
                               
                        <div class="col-md-4 col-sm-12" style="cursor: pointer" onclick="window.location.href = './STARPIPE'">
                            <div class="card mini-stats-wid" style="background-image: url(../assets/images/virus2.png)">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="shaded_glass"></div>
                                        <div class="media-body">
                                            <h4 class="glass_text">STARPIPE</h4>
                                            <h4 class="mb-3 font-size-20 text-white">STARPIPE Programme for HCPs</h4>
                                            <h4 class="mb-2 font-size-17 text-white"><u>TAKE COURSE</u></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-12" style="cursor: pointer">
                            <div class="card mini-stats-wid" style="background-image: url(../assets/images/advancements.png)">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="shaded_glass"></div>
                                        <div class="media-body">
                                            <h4 class="glass_text">Patient</h4>
                                            <h4 class="mb-3 font-size-20 text-white">Advancements in Immunotherapy</h4>
                                            <h4 class="mb-2 font-size-17 text-white"><u>READ FULL ARTICLE</u></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-12" style="cursor: pointer">
                            <div class="card mini-stats-wid" style="background-image: url(../assets/images/emotional.png)">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="shaded_glass"></div>
                                        <div class="media-body">
                                            <h4 class="glass_text">Patient</h4>
                                            <h4 class="mb-3 font-size-20 text-white">Emotional Journey of a Cancer Diagnosis</h4>
                                            <h4 class="mb-2 font-size-17 text-white"><u>READ FULL ARTICLE</u></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4 col-sm-12" style="cursor: pointer">
                            <div class="card mini-stats-wid" style="background-image: url(../assets/images/virus2.png)">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="shaded_glass"></div>
                                        <div class="media-body">
                                            <h4 class="glass_text">Patient</h4>
                                            <h4 class="mb-3 font-size-20 text-white">Role of Genetics in Cancer Development</h4>
                                            <h4 class="mb-2 font-size-17 text-white"><u>READ FULL ARTICLE</u></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4 col-sm-12" style="cursor: pointer">
                            <div class="card mini-stats-wid" style="background-image: url(../assets/images/coping.png)">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="shaded_glass"></div>
                                        <div class="media-body">
                                            <h4 class="glass_text">Patient</h4>
                                            <h4 class="mb-3 font-size-20 text-white">Coping Strategies and Support</h4>
                                            <h4 class="mb-2 font-size-17 text-white"><u>READ FULL ARTICLE</u></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4 col-sm-12" style="cursor: pointer">
                            <div class="card mini-stats-wid" style="background-image: url(../assets/images/precision.png)">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="shaded_glass"></div>
                                        <div class="media-body">
                                            <h4 class="glass_text">Patient</h4>
                                            <h4 class="mb-3 font-size-20 text-white">Precision Medicine<br> &nbsp;</h4>
                                            <h4 class="mb-2 font-size-17 text-white"><u>READ FULL ARTICLE</u></h4>
                                        </div>
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
        <!-- end main content-->
    <?php 
        $conn->close();
        include('Commons/footer.php');
    ?>

    <script>
        $(document).ready(function(){

            $('.form-control').keyup(function(){
    
                let v = $(this).val().trim().toLowerCase()
    
                if(v == ''){
                    $('.col-md-4.col-sm-12').show()
                }else{
                    $('.col-md-4.col-sm-12').each(function(){
                        const t = $(this),
                            thisText = t.find('h4.mb-3').text().trim().toLowerCase()
                        if(thisText.includes(v) || v.includes(thisText)){
                            t.show()
                        }else{
                            t.hide()
                        }
                    })
                }
            })
            
        })
    </script>


</body>

</html>
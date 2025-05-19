<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Resources"; 
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
        box-shadow: none;
        border: 1px solid #711f7d36;
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
                                <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Support</h2>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->     
                    
                    <div class="row">
                                 
                        <div class="col-md-6" onclick="window.location.href = 'tel:+2347073443749'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #8D2D920F !important">
                                                <i class="bx bxs-phone font-size-24" style="color: #8D2D92;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #8D2D92">+234 707 344 3749</h4>
                                            <!-- <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Click here to get information on<br>COVID-19</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                                 
                        <div class="col-md-6" onclick="window.location.href = 'mailto:info@oncopadi.com'">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #8D2D920F !important">
                                                <i class="bx bxs-envelope font-size-24" style="color: #8D2D92;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #8D2D92">info@oncopadi.com</h4>
                                            <!-- <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Click here to get information on<br>COVID-19</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
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

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        Tawk_API.visitor = {
            hash : '<?php echo md5($_SESSION["id"]); ?>',    
            name : '<?php echo $_SESSION["name"]; ?>',
            email : '<?php echo $_SESSION["email"]; ?>',
        };
        /*
        Tawk_API.login({
            hash : '<?php echo md5($_SESSION["id"]); ?>',
            userId : '<?php echo $_SESSION["id"]; ?>',         
            name : '<?php echo $_SESSION["name"]; ?>',
            email : '<?php echo $_SESSION["email"]; ?>',
        }, function(error) {
            // do something if error
        })
        */
        Tawk_API.onBeforeLoad = function(){
            Tawk_API.maximize();
        };
        Tawk_API.onLoad = function(){
            $('iframe').eq(1).css({
                'max-width': 'unset !important',
                'width': '100% !important'
            })
        };
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/664ea3039a809f19fb33eb3a/1huhiphsq';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

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
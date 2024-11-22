<?php 
    $TITLE = "Consent"; 
    include('Commons/header.php');
    include('STATIC_API/Config.php');
    if(!isset($_REQUEST["WithAuth"])){
        header('Location: ./AccountType');
    }
?>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php 
                //include('Commons/sidebar.php');
            ?>

            <div class="col-xl-12">

                <!-- <img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right"> -->

                <div class="auth-full-page-content p-md-5 p-4" style="padding-bottom: 0 !important">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                            <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">
                                
                                <div class="align-center m-a-c" style="margin-bottom: 30px">
                                    <div class="prose_logo"></div>
                                    <!-- <h3 class="text-primary text-center mb-2">INFORMED CONSENT DOCUMENT</h3> -->
                                    <!-- <p class="text-center font-size-17 hide-on-success">Your consent is required before we continue</p> -->
                                </div>
    
                                <div class="mt-5 col-xl-12 col-md-12 justify-content-center mx-auto full-form p-4" style="border: 1px solid #8D2D9259; background: #F5ECF5; border-radius: 10px">
                                    <form class="hide-on-success">
                                        <h3 class="text-dark text-center mb-2 font-weight-bold mb-5" style="font-weight: 700;">INFORMED CONSENT CERTIFICATE</h3>
                                        <div class="mb-3">
                                            <p class="font-size-14 hide-on-success" style="text-align: justify;line-height: 29px; color: #333;">
                                                Statement of person giving consent: 
                                                <br><br> 
                                                I have read the description of the research or have had it translated into language I understand. I have also talked it over with the doctor to my satisfaction. I understand that my participation is voluntary. I know enough about the purpose, methods, risks and benefits of the research study to judge that I want to take part in it. I understand that I may freely stop being part of this study at any time. I have received a copy of this consent form and additional information sheet to keep for myself.
                                            </p>

                                            <div class="col-xl-6 col-sm-12">

                                            <?php

                                                $hash = $_REQUEST['WithAuth'];
    
                                                $sql = "SELECT * FROM users JOIN patients on users.user_id=patients.user_id WHERE users.email_hash=$hash";
                                                                
                                                $result = mysqli_query($conn, $sql);

                                                $data = '';
            
                                                if ($result->num_rows > 0) {
            
                                                    while($row = $result->fetch_assoc()) {
                                                        $data = $row;
                                                    }
            
                                                }
                                            ?>


                                                <div class="mb-3">
                                                    <label class="i-g-block-label">Date</label>
                                                    <div class="input-group outlined">
                                                        <input value="<?php echo date("d M Y"); ?>" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="date" placeholder="Date" readonly>
                                                    </div>
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="i-g-block-label">Name</label>
                                                    <div class="input-group outlined">
                                                        <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="name" placeholder="Name">
                                                    </div>
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="i-g-block-label">Witness Name</label>
                                                    <div class="input-group outlined">
                                                        <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="witness_name" placeholder="Witness Name">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12" style="margin: 0 auto;">

                                            <div class="form-check mb-3 mt-5">
                                                <input class="form-check-input" type="checkbox" id="consent" style="transform: scale(1.7) translate(3px,0px)">
                                                <label class="form-check-label font-size-14 ms-3" for="formCheck1" style="font-weight: 400;color: #000;">
                                                    Send a copy to my email
                                                </label>
                                            </div>
                                            
                                            <div class="d-grid mt-5">
                                                <button class="btn btn-primary btn-lg waves-effect waves-light mx-auto w-100 mt-4" type="submit" id="cert_proceed" style=" max-width: 600px; ">Continue</button>
                                            </div>

                                        </div>

        
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <div class="my-5 text-center">
                <p class="font-size-15  text-primary">Lost? <a href="./AccountType" class="fw-medium text-primary"> Go Back</a> </p>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>

<?php include('Commons/footer.php');?>
<script>var AUTH = '<?php if(isset($_REQUEST["WithAuth"])){echo $_REQUEST["WithAuth"];}?>'</script>
<script src="assets/js/consent.js"></script>
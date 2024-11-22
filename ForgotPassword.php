
<?php  $TITLE = "Forgot Password"; include('Commons/header.php');?>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6">

                <!-- <img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right"> -->

                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                            <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">
                                
                                <div class="align-center m-a-c">
                                    <div class="prose_logo"></div>
                                    <h1 class="text-primary text-center mb-2">Forgot Password</h1>
                                    <p class="text-center font-size-17">To reset your password, we need to verify your email address.</p>
                                </div>
    
                                <div class="mt-5 col-xl-11 col-md-12 justify-content-center mx-auto full-form">
                                    <form>
        
                                        <div class="mb-4">
                                            <label class="i-g-block-label">E-mail</label>
                                            <div class="input-group outlined">
                                                <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-envelope font-size-17 button-icon"></i></button> -->
                                                <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="email" placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                        
                                     
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="proceed">Proceed</button>
                                        </div>
        
                                    </form>
                                    <div class="mt-5 text-center">
                                        <p class="font-size-15">Need help? <a href="tel:+2348143174953" class="fw-medium text-primary">Contact support</a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>

<?php include('Commons/footer.php');?>
<script src="assets/js/forgotpassword.js"></script>
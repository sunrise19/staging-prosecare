
<?php session_start(); $TITLE = "Change Password"; include('Commons/header.php');?>

<script>var AUTH = '<?php if(isset($_REQUEST["WithAuth"])){echo $_REQUEST["WithAuth"];}elseif($_SESSION["AUTH"]){echo $_SESSION["AUTH"];}?>'</script>

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
                                    <h1 class="text-primary text-center mb-2">Change Your Password</h1>
                                    <p class="text-center font-size-17">Provide and confirm your new password below</p>
                                </div>
    
                                <div class="mt-5 col-xl-11 col-md-12 justify-content-center mx-auto full-form">
                                    <form>
        
                                        <div class="mb-3">
                                            <label class="i-g-block-label">New Password</label>
                                            <div class="input-group auth-pass-inputgroup outlined">
                                                <!--<button class="btn btn-transparent" type="button" disabled><i class="bx bx-lock-alt font-size-18 button-icon"></i></button>-->
                                                <input type="password" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="passworda" placeholder="Enter New Password">
                                                <!--<button class="btn btn-transparent password-addon" type="button"><i class="mdi mdi-eye-outline"></i></button>-->
                                            </div>
                                        </div>

                                        <div class="mb-5">
                                            <label class="i-g-block-label">Confirm New Password</label>
                                            <div class="input-group auth-pass-inputgroup outlined">
                                                <!--<button class="btn btn-transparent" type="button" disabled><i class="bx bx-lock-alt font-size-18 button-icon"></i></button>-->
                                                <input type="password" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="passwordb" placeholder="Enter New Password Again">
                                                <!--<button class="btn btn-transparent password-addon" type="button"><i class="mdi mdi-eye-outline"></i></button>-->
                                            </div>
                                        </div>
                                     
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="proceed">Continue</button>
                                        </div>
        
                                    </form>
                                    <div class="mt-5 text-center">
                                        <p class="font-size-15">Lost? <a href="./AccountType" class="fw-medium text-primary">Go Home</a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include('Commons/footer.php');?>
<script src="assets/js/changepassword.js"></script>
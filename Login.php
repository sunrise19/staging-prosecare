
<?php  $TITLE = "Login"; include('Commons/header.php');?>

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
                                    <h1 class="text-primary text-center mb-2">Log in to Your Account</h1>
                                    <p class="text-center font-size-17">Welcome, enter your login details to continue</p>
                                </div>
    
                                <div class="mt-3 col-xl-11 col-md-12 justify-content-center mx-auto full-form">
                                    <form>
        
                                        <div class="mb-3">
                                            <label class="i-g-block-label">E-mail</label>
                                            <div class="input-group outlined">
                                                <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-envelope font-size-17 button-icon"></i></button> -->
                                                <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="email" placeholder="Enter Email Address">
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="i-g-block-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup outlined">
                                                <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-lock-alt font-size-18 button-icon"></i></button> -->
                                                <input type="password" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="password" placeholder="Enter Password">
                                                <button class="btn btn-transparent" type="button" id="password-addon"><i class="mdi mdi-eye font-size-20"></i></button>
                                            </div>
                                        </div>
                                        
                                        <div style="text-align: center" class="mt-4">
                                            <a href="./ForgotPassword" class="text-primary font-size-15 ">Forgot password?</a>
                                        </div>
                                        <br>
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="login">Log In</button>
                                        </div>
        
                                    </form>
                                    <div class="mt-4 text-center">
                                        <p class="font-size-15  text-primary">Don't have an account? <a href="./AccountType" class="fw-medium text-primary"> Sign Up Here</a> </p>
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
<script src="assets/js/login.js"></script>
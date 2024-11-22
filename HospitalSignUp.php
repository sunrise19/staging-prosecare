
<?php  $TITLE = "Hospital Sign Up"; include('Commons/header.php');?>

<style>
    
    .f-card {
    padding: 10px;
    border-radius: 21px 21px 39px 39px;
    /*box-shadow: 0 4px 19px rgb(0 0 0 / 12%); */
    box-shadow: 0 4px 19px rgb(218 213 219 / 62%);
}

.little_text {
    background: #8d2d923b;
    color: #8d2d92;
    padding: 5px 22px;
    margin-bottom: 10px;
    display: inline-block;
    border-radius: 30px;
}
</style>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6" style=" max-height: 100vh; overflow: auto; ">

                <!-- <img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right"> -->

                <div class="auth-full-page-content p-md-5 p-4" style="padding: 0 48px !important">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                            <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">

                                <div class="align-center m-a-c">
                                    <div class="prose_logo"></div>
                                    <h1 class="text-primary text-center mb-2">Hospital Sign Up</h1>
                                    <p class="text-center font-size-15">Provide your hospital details to begin.</p>
                                </div>
    
                                <div class="mt-1 col-xl-11 col-md-12 justify-content-center mx-auto full-form">
                                    <form>
        
                                        <div class="stage_container">
                                            <div class="stage_back" onclick="window.location.href='./AccountType'">&larr; Back</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="input-group outlined">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-clinic font-size-17 button-icon"></i></button>
                                                <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="name" placeholder="Enter Hospital Name">
                                            </div>
                                        </div>
        
                                        <div class="mb-3">
                                            <div class="input-group outlined">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-envelope font-size-17 button-icon"></i></button>
                                                <input type="email" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="email" placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                        
                                        <div class="f-card mb-3">
                                            
                                            <div style="text-align: left">
                                                <span class="little_text">Hospital Location</span>
                                            </div>
                                            
                                        
                                        
                                        <div class="mb-3">
                                            <div class="input-group outlined" style="height: 62.59px;">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-map-alt font-size-17 button-icon"></i></button>
                                                <select class="form-select parent-outline" id="country">
                                                    <option disabled selected>Country</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="input-group outlined" style="height: 62.59px;">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-map-pin font-size-17 button-icon"></i></button>
                                                <select class="form-select parent-outline" id="state">
                                                    <option disabled selected>State</option>
                                                    <option disabled>Select Country First</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="">
                                            <div class="input-group outlined" style="height: 62.59px;">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-map font-size-17 button-icon"></i></button>
                                                <select class="form-select parent-outline" id="lga">
                                                    <option disabled selected>Local Government Area</option>
                                                    <option disabled>Select State First</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        </div>

                                        <div class="mb-3">
                                            <div class="input-group outlined" style="height: 62.59px;">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-phone font-size-17 button-icon"></i></button>
                                                <select class="form-select parent-outline col-3" style=" flex: 0.25; " id="code">
                                                    <!--<option disabled selected>ðŸš© &bull;&bull;&bull;</option>-->
                                                    <option value="+234">🇳🇬 +234</option>
                                                </select>
                                                <input type="number" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="phone" placeholder="080 1234 5678">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="input-group outlined" style="height: 62.59px;">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-tag font-size-17 button-icon"></i></button>
                                                <select class="form-select parent-outline" id="cadre">
                                                    <option disabled selected>Hospital Cadre</option>
                                                    <option value="Private: GP/Specialist">Private: GP/Specialist</option>
                                                    <option value="Public: (Primary Healthcare Center)">Public: (Primary Healthcare Center)</option>
                                                    <option value="Public: (Secondary)">Public: (Secondary)</option>
                                                    <option value="Public: (Tertiary Hospital)">Public: (Tertiary Hospital)</option>
                                                </select>
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <div class="input-group auth-pass-inputgroup outlined">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-lock-alt font-size-18 button-icon"></i></button>
                                                <input type="password" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="password" placeholder="Enter Your Password">
                                                <button class="btn btn-transparent" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                                      
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="hospital_sign_up">Sign Up</button>
                                        </div>
        
                                    </form>

                                    <div class="mt-5 text-center">
                                        <p class="font-size-15">Already have an account? <a href="./Login" class="fw-medium text-primary">Login</a> </p>
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
<script src="assets/js/places.js"></script>
<script src="assets/js/hospitalsignup.js"></script>
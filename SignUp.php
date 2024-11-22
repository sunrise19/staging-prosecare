<?php 
    $TYPE = strtolower($_REQUEST['Type']);
    if($TYPE != 'patient' && $TYPE != 'caregiver' && $TYPE != 'hcp'){
        header('Location: ./AccountType');
    }
    $TITLE = "Sign Up"; include('Commons/header.php');
?>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6">

                <!-- <img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right"> -->

                <div class="auth-full-page-content p-md-5 p-4" style="padding-bottom: 0 !important">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                            <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">
                                
                                <div class="align-center m-a-c" style="margin-bottom: 30px">
                                    <div class="prose_logo"></div>
                                    <h1 class="text-primary text-center mb-2">Let's Get You Started</h1>
                                    <p class="text-center font-size-15 hide-on-success">Welcome, enter your email and create a password to continue</p>
                                </div>
    
                                <div class="mt-5 col-xl-11 col-md-12 justify-content-center mx-auto full-form">
                                    <form class="hide-on-success">
        
                                        <div class="mb-3">
                                            <label class="i-g-block-label">E-mail</label>
                                            <div class="input-group outlined">
                                                <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-envelope font-size-17 button-icon"></i></button> -->
                                                <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="email" placeholder="Enter Email Address">
                                            </div>
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="i-g-block-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup outlined">
                                                <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-lock-alt font-size-18 button-icon"></i></button> -->
                                                <input type="password" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="passworda" placeholder="Enter Password">
                                                <button class="btn btn-transparent password-addon" type="button"><i class="mdi mdi-eye"></i></button>
                                            </div>
                                        </div>
                
                                        <div class="mb-5">
                                            <label class="i-g-block-label">Confirm Password</label>
                                            <div class="input-group auth-pass-inputgroup outlined">
                                                <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-lock-alt font-size-18 button-icon"></i></button> -->
                                                <input type="password" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="passwordb" placeholder="Enter Password">
                                                <button class="btn btn-transparent password-addon" type="button"><i class="mdi mdi-eye"></i></button>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="proceed">Continue</button>
                                        </div>
        
                                    </form>
                                    <div class="form-success" style="display: none">
                                        <h3>Please check your email to complete your Sign&nbsp;Up process</h3>
                                        <h6 class="mt-4 mb-5">Open Inbox:</h6>
                                        <div class="mail_items_holder">
                                            <a href="https://mail.google.com" target="_blank" class="mail_item">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="480" height="480" viewBox="0 0 48 48" style=" fill:transparent;"><path fill="#4caf50" d="M45,16.2l-5,2.75l-5,4.75L35,40h7c1.657,0,3-1.343,3-3V16.2z"></path><path fill="#1e88e5" d="M3,16.2l3.614,1.71L13,23.7V40H6c-1.657,0-3-1.343-3-3V16.2z"></path><polygon fill="#e53935" points="35,11.2 24,19.45 13,11.2 12,17 13,23.7 24,31.95 35,23.7 36,17"></polygon><path fill="#c62828" d="M3,12.298V16.2l10,7.5V11.2L9.876,8.859C9.132,8.301,8.228,8,7.298,8h0C4.924,8,3,9.924,3,12.298z"></path><path fill="#fbc02d" d="M45,12.298V16.2l-10,7.5V11.2l3.124-2.341C38.868,8.301,39.772,8,40.702,8h0 C43.076,8,45,9.924,45,12.298z"></path></svg>
                                                Gmail
                                            </a>
                                            <a href="https://outlook.live.com" target="_blank" class="mail_item">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="480" height="480" viewBox="0 0 48 48" style=" fill:transparent;"><path fill="#1a237e" d="M43.607,23.752l-7.162-4.172v11.594H44v-6.738C44,24.155,43.85,23.894,43.607,23.752z"></path><path fill="#0c4999" d="M33.919,8.84h9.046V7.732C42.965,6.775,42.19,6,41.234,6H17.667c-0.956,0-1.732,0.775-1.732,1.732 V8.84h9.005H33.919z"></path><path fill="#0f73d9" d="M33.919,33.522h7.314c0.956,0,1.732-0.775,1.732-1.732v-6.827h-9.046V33.522z"></path><path fill="#0f439d" d="M15.936,24.964v6.827c0,0.956,0.775,1.732,1.732,1.732h7.273v-8.558H15.936z"></path><path fill="#2ecdfd" d="M33.919 8.84H42.964999999999996V16.866999999999997H33.919z"></path><path fill="#1c5fb0" d="M15.936 8.84H24.941000000000003V16.866999999999997H15.936z"></path><path fill="#1467c7" d="M24.94 24.964H33.919V33.522H24.94z"></path><path fill="#1690d5" d="M24.94 8.84H33.919V16.866999999999997H24.94z"></path><path fill="#1bb4ff" d="M33.919 16.867H42.964999999999996V24.963H33.919z"></path><path fill="#074daf" d="M15.936 16.867H24.941000000000003V24.963H15.936z"></path><path fill="#2076d4" d="M24.94 16.867H33.919V24.963H24.94z"></path><path fill="#2ed0ff" d="M15.441,42c0.463,0,26.87,0,26.87,0C43.244,42,44,41.244,44,40.311V24.438 c0,0-0.03,0.658-1.751,1.617c-1.3,0.724-27.505,15.511-27.505,15.511S14.978,42,15.441,42z"></path><path fill="#139fe2" d="M42.279,41.997c-0.161,0-26.59,0.003-26.59,0.003C14.756,42,14,41.244,14,40.311V25.067 l29.363,16.562C43.118,41.825,42.807,41.997,42.279,41.997z"></path><path fill="#00488d" d="M22.319,34H5.681C4.753,34,4,33.247,4,32.319V15.681C4,14.753,4.753,14,5.681,14h16.638 C23.247,14,24,14.753,24,15.681v16.638C24,33.247,23.247,34,22.319,34z"></path><path fill="#fff" d="M13.914,18.734c-3.131,0-5.017,2.392-5.017,5.343c0,2.951,1.879,5.342,5.017,5.342 c3.139,0,5.017-2.392,5.017-5.342C18.931,21.126,17.045,18.734,13.914,18.734z M13.914,27.616c-1.776,0-2.838-1.584-2.838-3.539 s1.067-3.539,2.838-3.539c1.771,0,2.839,1.585,2.839,3.539S15.689,27.616,13.914,27.616z"></path></svg>
                                                Outlook
                                            </a>
                                            <a href="https://www.icloud.com/mail" target="_blank" class="mail_item">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="240" height="240" viewBox="0 0 48 48" style=" fill:transparent;"><linearGradient id="iSZtP6eSr5wqIgT3aj5c_a_06SDYXN73bSC_gr1" x1="6.896" x2="27.372" y1="21.436" y2="21.46" gradientUnits="userSpaceOnUse"><stop offset=".309" stop-color="#33bef0"></stop><stop offset="1" stop-color="#0a85d9"></stop></linearGradient><ellipse cx="14.279" cy="21.444" fill="url(#iSZtP6eSr5wqIgT3aj5c_a_06SDYXN73bSC_gr1)" rx="7.163" ry="7.259"></ellipse><linearGradient id="iSZtP6eSr5wqIgT3aj5c_b_06SDYXN73bSC_gr2" x1="1.694" x2="39.022" y1="27.617" y2="27.813" gradientUnits="userSpaceOnUse"><stop offset=".309" stop-color="#33bef0"></stop><stop offset="1" stop-color="#0a85d9"></stop></linearGradient><path fill="url(#iSZtP6eSr5wqIgT3aj5c_b_06SDYXN73bSC_gr2)" d="M46,28.185c0-4.868-3.894-8.815-8.698-8.815c-4.804,0-8.698,3.947-8.698,8.815	c0,0.175,0.016,0.346,0.026,0.519h-8.272c0.037-0.341,0.06-0.686,0.06-1.037c0-5.155-4.123-9.333-9.209-9.333	C6.123,18.333,2,22.512,2,27.667S6.123,37,11.209,37H38C42.564,36.73,46,32.878,46,28.185z"></path><linearGradient id="iSZtP6eSr5wqIgT3aj5c_c_06SDYXN73bSC_gr3" x1="14.368" x2="12.779" y1="37.187" y2="7.309" gradientUnits="userSpaceOnUse"><stop offset=".404" stop-color="#33bef0"></stop><stop offset="1" stop-color="#0a85d9"></stop></linearGradient><path fill="url(#iSZtP6eSr5wqIgT3aj5c_c_06SDYXN73bSC_gr3)" d="M20.175,25.562c-0.943-4.14-4.594-7.229-8.966-7.229c-1.323,0-2.578,0.288-3.715,0.797	c-0.242,0.728-0.378,1.504-0.378,2.314c0,4.009,3.207,7.259,7.163,7.259C16.725,28.704,18.883,27.459,20.175,25.562z"></path><linearGradient id="iSZtP6eSr5wqIgT3aj5c_d_06SDYXN73bSC_gr4" x1="-1.81" x2="39.425" y1="42.205" y2="11.822" gradientUnits="userSpaceOnUse"><stop offset=".309" stop-color="#33bef0"></stop><stop offset="1" stop-color="#0a85d9"></stop></linearGradient><ellipse cx="27.07" cy="20.926" fill="url(#iSZtP6eSr5wqIgT3aj5c_d_06SDYXN73bSC_gr4)" rx="11.767" ry="11.926"></ellipse><linearGradient id="iSZtP6eSr5wqIgT3aj5c_e_06SDYXN73bSC_gr5" x1="31.961" x2="10.537" y1="20.784" y2="21.568" gradientUnits="userSpaceOnUse"><stop offset=".246" stop-color="#33bef0"></stop><stop offset="1" stop-color="#0a85d9"></stop></linearGradient><path fill="url(#iSZtP6eSr5wqIgT3aj5c_e_06SDYXN73bSC_gr5)" d="M17.023,14.739c-1.085,1.805-1.721,3.918-1.721,6.186c0,2.608,0.836,5.014,2.237,6.977	c2.315-1.203,3.902-3.64,3.902-6.458C21.442,18.421,19.617,15.831,17.023,14.739z"></path><linearGradient id="iSZtP6eSr5wqIgT3aj5c_f_06SDYXN73bSC_gr6" x1="26.665" x2="11.328" y1="44.761" y2="9.592" gradientUnits="userSpaceOnUse"><stop offset=".415" stop-color="#33bef0"></stop><stop offset=".652" stop-color="#1797e0"></stop><stop offset=".795" stop-color="#0a85d9"></stop></linearGradient><path fill="url(#iSZtP6eSr5wqIgT3aj5c_f_06SDYXN73bSC_gr6)" d="M15.407,19.368c-0.067,0.51-0.105,1.029-0.105,1.558c0,2.608,0.835,5.012,2.236,6.975	c0.005-0.003,0.011-0.005,0.016-0.007c0.565-0.295,1.086-0.665,1.552-1.095c0.04-0.037,0.076-0.079,0.115-0.118	c0.178-0.172,0.349-0.352,0.509-0.542c0.07-0.083,0.133-0.172,0.199-0.258c0.084-0.11,0.163-0.223,0.241-0.337	C19.55,22.847,17.776,20.604,15.407,19.368z"></path><linearGradient id="iSZtP6eSr5wqIgT3aj5c_g_06SDYXN73bSC_gr7" x1="11.891" x2="37.98" y1="52.879" y2="19.674" gradientUnits="userSpaceOnUse"><stop offset=".309" stop-color="#33bef0"></stop><stop offset="1" stop-color="#0a85d9"></stop></linearGradient><path fill="url(#iSZtP6eSr5wqIgT3aj5c_g_06SDYXN73bSC_gr7)" d="M28.605,28.185c0,1.582,0.417,3.063,1.136,4.346c5.21-1.228,9.096-5.952,9.096-11.606	c0-0.483-0.037-0.956-0.092-1.424c-0.47-0.08-0.95-0.131-1.443-0.131C32.499,19.37,28.605,23.317,28.605,28.185z"></path></svg>
                                                iCloud Mail
                                            </a>
                                            <a href="https://mail.yahoo.com" target="_blank" class="mail_item">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="480" height="480" viewBox="0 0 48 48" style=" fill:transparent;"><path fill="#5c6bc0" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5	V37z"></path><path fill="#fff" d="M34,13H14c-0.552,0-1,0.448-1,1v12c0,0.552,0.448,1,1,1h20c0.552,0,1-0.448,1-1V14	C35,13.448,34.552,13,34,13z M33,17l-9,4l-9-4v-2h18V17z"></path><g transform="matrix(.63072 0 0 .63072 -72.063 127.866)"><path fill="#fff" d="M132.266-150.491h2.385l1.389,3.552l1.407-3.552h2.322l-3.496,8.41h-2.337 l0.957-2.228L132.266-150.491z"></path><path fill="#fff" d="M142.186-150.633c-1.792,0-2.924,1.607-2.924,3.207c0,1.801,1.242,3.228,2.89,3.228 c1.23,0,1.693-0.749,1.693-0.749v0.584h2.08v-6.128h-2.08v0.557C143.846-149.934,143.328-150.633,142.186-150.633z M142.629-148.663c0.827,0,1.253,0.654,1.253,1.244c0,0.636-0.457,1.259-1.253,1.259c-0.66,0-1.256-0.539-1.256-1.232 C141.372-148.095,141.852-148.663,142.629-148.663z"></path><path fill="#fff" d="M146.642-144.363v-8.834h2.175v3.284c0,0,0.517-0.719,1.599-0.719 c1.324,0,2.099,0.986,2.099,2.396v3.873h-2.159v-3.343c0-0.477-0.227-0.938-0.742-0.938c-0.524,0-0.797,0.468-0.797,0.938v3.343 H146.642z"></path><path fill="#fff" d="M156.224-150.632c-2.052,0-3.274,1.56-3.274,3.232c0,1.902,1.479,3.203,3.281,3.203 c1.747,0,3.275-1.241,3.275-3.171C159.507-149.479,157.907-150.632,156.224-150.632z M156.244-148.645 c0.725,0,1.226,0.604,1.226,1.247c0,0.549-0.467,1.226-1.226,1.226c-0.695,0-1.217-0.558-1.217-1.232 C155.027-148.053,155.46-148.645,156.244-148.645z"></path><path fill="#fff" d="M163.131-150.632c-2.052,0-3.274,1.56-3.274,3.232c0,1.902,1.479,3.203,3.281,3.203 c1.747,0,3.275-1.241,3.275-3.171C166.414-149.479,164.814-150.632,163.131-150.632z M163.151-148.645 c0.725,0,1.226,0.604,1.226,1.247c0,0.549-0.467,1.226-1.226,1.226c-0.695,0-1.217-0.558-1.217-1.232 C161.933-148.053,162.367-148.645,163.151-148.645z"></path><circle cx="168.131" cy="-145.677" r="1.445" fill="#fff"></circle><path fill="#fff" d="M170.05-147.653h-2.601l2.308-5.545h2.591L170.05-147.653z"></path></g></svg>
                                                Yahoo
                                            </a>
                                        </div>
                                    </div>

                                    <!-- <div class="mt-5 text-center">
                                        <p class="font-size-15  text-primary">Not your account type? <a href="./AccountType" class="fw-medium text-primary"> Go Back</a> </p>
                                    </div> -->
                                            
                                    <div class="mt-5 text-center">
                                        <p class="font-size-15">Already have an account? <a href="./Login" class="fw-medium text-primary"> Login</a> </p>
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
<script>var TYPE = '<?php echo $TYPE; ?>'</script>
<script src="assets/js/signup.js"></script>


<style>
    .bg-overlay{
        background-image: url(assets/images/StaticImage2.svg) !important;
    }
</style>
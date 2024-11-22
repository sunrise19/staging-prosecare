<?php 
    include('STATIC_API/Config.php');
    // session_start(); 
    $TITLE = "Verify Account"; 
    include('Commons/header.php');
?>

<script>const e = '<?php 
    if($_REQUEST['WithAuth'] != '') {

        $authHash = $_REQUEST['WithAuth'];

        $sql = "SELECT email FROM users WHERE email_hash = '$authHash'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                echo $row['email'];
            }
            
        }

    }else{
        if(isset($_SESSION["email"])){
            echo $_SESSION["email"];
        }else{
            echo $_REQUEST['EMAIL'];
        }
    }
    ?>',
    EMAIL = e.replaceAll(' ', '+')
</script>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6">

                <!--<img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right"> -->

                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                            <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">
                                
                                <div class="align-center m-a-c">
                                    <h1 class="text-primary text-center mb-2">Verify Email</h1>
                                    <p class="text-center font-size-15 email_output">Provide the verification code sent to your email address below</p>
                                </div>
    
                                <div class="mt-5 col-xl-11 col-md-12 justify-content-center mx-auto full-form">
                                    <form>
        
                                        <div class="mb-4">
                                            <div class="input-group outlined">
                                                <button class="btn btn-transparent" type="button" disabled><i class="bx bx-dialpad-alt font-size-17 button-icon"></i></button>
                                                <input type="number" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="code" placeholder="Enter Verification Code">
                                            </div>
                                        </div>

                                        
                                        <div class="mt-3 d-grid">
                                        <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="verify_account">Proceed</button>
                                        </div>
                                        <br>
                                        <div style="text-align: center">
                                            <a class="text-primary pointer font-size-16" id="resend_code">Resend Verification Code</a>
                                        </div>
        
                                    </form>
                                    
                                    <div class="mt-5 text-center">
                                        <p class="font-size-15">Don't have an account? <a href="./AccountType" class="fw-medium text-primary">Sign Up</a> </p>
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
<script src="assets/js/verifyaccount.js"></script>
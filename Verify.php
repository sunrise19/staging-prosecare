<?php

    // session_start();
    
    $TITLE = "Verify Account"; include('Commons/header.php');

    $AUTH = $_REQUEST['WithAuth'];

    function err(){
        echo
        '<div class="align-center">
            <img src="assets/images/error.png" style="height: 150px;margin: 0 auto;display: block;">
            <h3 class="text-danger text-center text-danger">Cannot verify account :/<br><br>Invalid request.</h3>
        </div>
        <div class="mt-5 text-center">
            <p class="font-size-15 text-primary">Lost? <a href="./AccountType" class="fw-medium text-primary">Go Home</a> </p>
        </div>';
    }
    
    function success($LINK){
        echo
        '<div class="align-center">
            <img src="assets/images/verified.png" style="height: 150px;margin: 0 auto;display: block;">
            <h3 class="text-success text-center">Awesome!<br><br>Account Successfully Verified</h3>
        </div>
        <div class="mt-5 col-xl-10 col-md-12 justify-content-center mx-auto full-form">
            <form>
                <div class="mt-3 d-grid">
                    <a class="btn btn-primary btn-lg waves-effect waves-light" type="submit" href="./'.$LINK.'">Proceed</a>
                </div>
            </form>
        </div>';
    }
?>

<script>var EMAIL = '<?php if(isset($_SESSION["email"])){echo $_SESSION["email"];}?>'</script>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6">

                <!--<img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right">-->

                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                            <div class="my-auto col-xl-12 col-md-12 justify-content-center mx-auto full-form">

                                <div class="align-center m-a-c">
                                    <div class="prose_logo"></div>
                                    <h1 class="text-primary text-center mb-2">Verify Your Email</h1>
                                    <!--<p class="text-center font-size-17">Enter the 5 digit code that was sent to you</p> -->
                                </div>

                                <?php 

                                    if($AUTH == ''){
                                        err();
                                    }else{
                                        
                                        include('STATIC_API/Config.php');

                                        $sql = "SELECT * FROM users WHERE email_hash = '$AUTH'";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result->num_rows > 0) {

                                            while($row = $result->fetch_assoc()) {

                                                $type = $row['user_type'];

                                                if($type == 'hcp'){

                                                    if($row["verified"] == 'false'){
    
                                                        session_unset();
    
                                                        $sql = "UPDATE users SET verified='true' WHERE email_hash='$AUTH'";
            
                                                        if($conn->query($sql) === TRUE) {
                                                            success('HCPSignUp?WithAuth='.$AUTH);
                                                        }else{
                                                            err();
                                                        }
    
                                                    }else{
                                                        success('Login');
                                                    }

                                                }else{

                                                    if($row["verified"] == 'false' || $row["consent"] == 'false'){
    
                                                        session_unset();
    
                                                        $sql = "UPDATE users SET verified='true' WHERE email_hash='$AUTH'";
            
                                                        if($conn->query($sql) === TRUE) {
                                                            success('AcquireConsent?WithAuth='.$AUTH);
                                                        }else{
                                                            err();
                                                        }
    
                                                    }else{
                                                        success('Login');
                                                    }

                                                }

                                                    
                                            }
                                        }else{
                                            err();
                                        }
                                            
                                        $conn->close();
                                        
                                    }
                                ?>
                                
    
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

<?php  $TITLE = "Account Type"; include('Commons/header.php');?>
<style>
    .card-title{
        color: #333333;
    }
    .card-text{
        color: #666666;
    }
    .card-title,.card-text{
        transition: 0.3s;
    }
    .card-body{
        transition: 0.5s;
        border-radius: 16px;
        cursor: pointer;
    }
    .card-body:hover{
        background: rgb(141 45 145);
        color: #fff
    }
    .card-body:hover .col-2 img{
        transition: 0.8s;
        filter: invert(1) brightness(2);
    }
    .card-body:hover .card-title, .card-body:hover .card-text{
        color: #fff
    }
</style>
<div>

    <div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 550px;" role="document">
            <div class="modal-content"> 
                <div class="modal-header py-0 px-2" style="border: none">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <div class="close_treament_modal" data-dismiss="modal" aria-label="Close">+</div>
                </div>
                
                <div class="modal-body">

                    <div class="l2r" style="gap: 16px">

                        <div class="card card-body mb-4 flex-1" onclick="window.location.href='./SignUp?Type=Patient'">
                            <div class="row align-items-center justify-center">
                                <div class="col-12 text-center">
                                    <!-- <img src="assets/images/preg_icon.svg" alt=""> -->
                                    <img src="assets/images/hcp_icon.svg" alt="">
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <h4 class="card-title pt-2">Patient</h4>
                                    <p class="card-text">Are you a patient? Sign Up as a patient receiving treatment</p>
                                </div>
                            </div>
                        </div>

                        <div class="card card-body mb-4 flex-1" onclick="window.location.href='./SignUp?Type=CareGiver'">
                            <div class="row align-items-center">
                                <div class="col-12 text-center">
                                    <!-- <img src="assets/images/preg_icon.svg" alt=""> -->
                                    <img src="assets/images/hcp_icon.svg" alt="">
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <h4 class="card-title pt-2">Caregiver</h4>
                                    <p class="card-text">Sign Up as a caregiver taking care of the patient</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="mt-3 text-center">
                        <p class="font-size-15">Already have an account? <a href="./Login" class="fw-medium text-primary"> Login</a> </p>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6">

                <!-- <img src="assets/images/oncopadi_logo.svg" alt="" class="top_right oncopadi_logo"> -->

                <div class="auth-full-page-content p-md-5 p-4" style="padding-bottom: 0 !important">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">

                            <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">

                                       
                                <div class="align-center m-a-c">
                                    <div class="prose_logo"></div>
                                    <h1 class="text-primary text-center mb-2">Select Account Type</h1>
                                    <p class="text-center font-size-17">To proceed, select an account type</p>
                                </div>
          
    
                                <div class="mt-5 col-xl-12 col-md-12 justify-content-center mx-auto full-form">

                                        <div class="card card-body mb-4" data-toggle="modal" data-target="#typeModal">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <img src="assets/images/preg_icon.svg" alt="">
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="card-title pt-2">Patient</h4>
                                                    <p class="card-text">Sign Up as a patient receiving treatment</p>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- <div class="card card-body mb-4" onclick="window.location.href='./SignUp?Type=CareGiver'">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="assets/images/ic_caregiver.svg" alt="">
                                                </div>
                                                <div class="col-9 mx-n4">
                                                    <h4 class="card-title pt-2">CAREGIVER</h4>
                                                    <p class="card-text">I am caring for someone with cancer</p>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="card card-body mb-4"  onclick="window.location.href='./SignUp?Type=HCP'">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <img src="assets/images/hcp_icon.svg" alt="">
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="card-title pt-2">Healthcare Professional</h4>
                                                    <p class="card-text">An healthcare professional administering treatment</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-body mb-5"  onclick="window.location.href='./SignUp?Type=Researcher'">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <img src="assets/images/hcp_icon.svg" alt="">
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="card-title pt-2">Researcher</h4>
                                                    <p class="card-text">A medical researcher looking to gain insights</p>
                                                </div>
                                            </div>
                                        </div>
                                        
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

<style>
    .bg-overlay{
        background-image: url(assets/images/StaticImage3.png) !important;
    }
    .card{
        background: #F4EAF578;
        border: 1px solid #8D2D924F
    }
</style>
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
</style>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content"> 
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">PROSE Care FAQs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                    <h5>1. What is Radiotherapy?</h5>
                    Radiotherapy is a cancer treatment that uses high&nbsp;doses&nbsp;of&nbsp;radiation&nbsp;to kill
                    cancer&nbsp;cells&nbsp;and shrink tumours.&nbsp;It may be used in the early stages of cancer or after it
                    has started to spread. Radiotherapy is generally considered the most effective cancer
                    treatment after surgery, but its effectiveness varies from person to person.
                    <br>
                    <br>
                    <h5>2. How is Radiotherapy different from Chemotherapy?</h5>
                    Radiotherapy and Chemotherapy are both treatment modalities for cancer.
                    Radiotherapy uses high-energy rays to destroy cancer cells while Chemotherapy uses
                    special drugs to shrink or kill these cancer cells. Combining both treatments is often
                    more effective than having either treatment on its own.
                    <br>
                    <br>
                    <h5> 3. What are the common side effects of Radiotherapy and Chemotherapy?</h5>
                    Radiotherapy and Chemotherapy present with almost similar side effects.
                    Radiotherapy side-effects tend to affect the area being treated while Chemotherapy
                    side-effects are more likely to affect the whole body. These side-effects depend on the
                    dosage of radiation or drugs given, the location on the body, and the overall health
                    situation of cancer patients.
                    Here are some of the side-effects associated with these cancer treatments: tiredness
                    (fatigue), pain,&nbsp;loss of appetite, weight loss, hair loss, sore on the mouth, throat or
                    gum, etc.
                    <br>
                    <br>
                    <h5>4.How long do these side effects last?</h5>
                    Side-effects can happen any time during, immediately after or a few days or weeks
                    after treatment.
                    Most side-effects start to go away after cancer treatment ends and the healthy cells
                    have a chance to grow again. How long this takes depend on a patient’s overall health
                    and the types and amounts of drugs and/or radiation he or she had. Remember that the
                    type of radiation side-effects you might have depends&nbsp;on the prescribed dose and
                    schedule.
                    <br>
                    <br>
                    <h5>5. Is it possible to have no side-effects from Radiotherapy?</h5>
                    Some patients have no side-effects at all, while others have quite a few.
                    There is no accurate way to predict who will have side-effects. It is very important to
                    note that individuals react differently to treatment. Side-effects vary from person to
                    person depending on various factors such as the radiation dose, and the part of the
                    body being treated.&nbsp;
                    <br>
                    <br>
                    <h5>6.When can I report my side-effects?</h5>
                    It is important to talk with your health care team about&nbsp;any side-effects
                    you&nbsp;experience&nbsp;as soon as possible so they&nbsp;can&nbsp;find ways to help you.
                    <br>
                    <br>
                    <h5>7.How do I report my side-effects using PROSEcare?</h5>
                    Log in to your PROSEcare account with a valid email address and password. Read
                    through the questions and tick relevant options related to the side-effects you are
                    experiencing.
                    <br>
                    <br>
                    <h5>8. Is Radiotherapy safe?</h5>
                    Some patients worry about the safety of radiotherapy. While radiotherapy involves
                    exposure to hazardous radioactive particles, it has been used to safely treat cancer for
                    more than 100 years. Many advancements have been made that have led to safety
                    regulations and checkpoints during treatment. It is important to remember that every
                    patient is different, and your safety instructions may be different from other patients
                    or people you know who have received radiation therapy to treat cancer. Any
                    precautions you might need to take depend on what treatment is used and type and
                    dose of radiation that is given. If needed, your heathcare team will give you exact
                    instructions so you know what steps to take, and how long any precautions need to be
                    followed. You should follow their instructions exactly.
                    <br>
                    <br>
                    <h5>9. How should I care for myself during treatment?</h5>
                    There is no one right way to go through the experience of cancer. It is all about figuring out
                    what is right for you.&nbsp;Be kind to yourself and follow the steps below:
                    * Slow down and find quiet time for your body and mind.
                    * Make time for things that make you feel fulfilled such as crafting, reading, taking a
                    bath, going for a walk or baking.
                    * Eat nourishing foods.
                    * Do some light exercise.
                    * Spend time with loved ones.
                    * Prioritize sleep.
                    <br>
                    <br>
                    <h5>10. How much do I pay to access PROSE Care?</h5>
                    PROSEcare is free and accessible and will not require you to pay any fee or request
                    for your bank details.
                    <br>
                    <br>
                    <h5>11. Will I get immediate response when I report my side-effects on PROSEcare?</h5>
                    Yes. When you log in your side-effects on PROSEcare, your enquiries will be
                    attended to as soon as possible.

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

        <div class="main-content">

            <div class="page-content" style=" padding-bottom: 0; ">
                <div class="container-fluid">


                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18 snt">Resources</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?php echo $TITLE; ?></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->                    

                    
                    <div class="row">


                               
                        <div class="col-md-6" onclick="window.open('https://covid19.ncdc.gov.ng')">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #FEE5D9 !important">
                                                <i class="bx bxs-bug-alt font-size-24" style="color: #DA3046;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #B62141">Stay Informed About COVID</h4>
                                            <!-- <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Click here to get information on<br>COVID-19</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6" onclick="window.open('https://www.cancer.gov/about-cancer/treatment/types/chemotherapy')">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #91F3DA !important">
                                                <i class="bx bxs-info-circle font-size-24" style="color: #006D7A"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #005267">About Chemotherapy</h4>
                                            <!-- <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Click here to report a side effect you<br>are experiencing.</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6" onclick="window.open('https://www.cancer.gov/about-cancer/treatment/types/radiation-therapy')">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #91F3DA !important">
                                                <i class="bx bxs-info-circle font-size-24" style="color: #006D7A;"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #005267">About Radiotherapy</h4>
                                            <!-- <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Click here to log your treatment<br>record.</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
    
                        <div class="col-md-6" data-toggle="modal" data-target="#addModal">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media flex-column">
                                        <div class="avatar-sm rounded-circle mini-stat-icon mb-4">
                                            <span class="avatar-title rounded-circle bg-primary" style="background: #F9D7EF !important">
                                                <i class="bx bxs-help-circle font-size-24" style="color: #71207D"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mb-2 font-size-17 font-weight-bold" style="color: #57166A">FAQs : Relate to the study, using the app</h4>
                                            <!-- <p class="font-weight-medium font-size-13 mb-0" style="color: #7A667B; text-transform: none">Fill in your QOL at the start, midpoint<br>and end of your treatment</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                

                    </div> 
                    <!-- end row -->
                    
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


</body>

</html>
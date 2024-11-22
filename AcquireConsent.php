<?php 
    $TITLE = "Consent"; include('Commons/header.php');
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
                                        <h3 class="text-dark text-center mb-2 font-weight-bold mb-5" style="font-weight: 700;">INFORMED CONSENT DOCUMENT</h3>
                                        <div class="mb-3">
                                            <p class="font-size-14 hide-on-success" style="text-align: justify;line-height: 29px; color: #333;">
                                                Participants information (to be retained by participants)
                                                <br>
                                                <br>
                                                 Title of the research: Standardizing the Acute side effects Reporting and management during radiotherapy chemotherapy and immunotherapy for Breast Cancer patients through a Practice Improvement ProjEct (STAR-PIPE). 
                                                 <br><br> 
                                                 Name(s) and affiliation(s) of researcher(s) of applicant(s): Dr. Omolola Salako of the University of Lagos, Akoka, Lagos 
                                                 <br>
                                                 <br>
                                                 Sponsor(s) of research: Mayo Clinic Global Bridges Oncology and Pfizer Global Medical Grants
                                                 <br><br>
                                                  Purpose(s) of research: To standardize the reporting and management of cancer treatment-related acute side effects for breast malignancy through a quality improvement project.<br><br> Procedure of the research, what shall be required of each participant and approximate total number of participants that would be involved in the research: Participants undergoing radiotherapy, chemotherapy and/or immunotherapy will be required to report their side effects and outcome measures for quality of life either using an electronic tool or the usual means. A blood sample will be drawn from all participants at least once during the course of their involvement.
                                                  <br>
                                                  <br>
                                                  Expected duration of research and of participant(s)’ involvement:
                                                  <br>
                                                   Duration of research – 12 months.
                                                   <br> 
                                                   Duration of participant’s involvement – 12 weeks. <br><br> Risk(s): Although there are no identifiable significant risks, patients might feel a slight pain or bleed for a brief period after the blood sample is drawn.
                                                    The research team will take measures to ensure that the patients are comfortable during the procedure, they will ensure maximal pain control is achieved. 
                                                    <br>
                                                    <br> 
                                                    Costs to the participants, if any, of joining the research: None 
                                                    <br>
                                                    <br> 
                                                    Benefit(s): The goal of this study is to provide a digital platform for reporting acute side effects, improve patient experience and standardize reporting and documentation of acute treatment side effects amongst patients with malignant tumours of the breast. Results obtained from this study will contribute to the body of knowledge and further development and iteration of the study app 
                                                    <br>
                                                    <br> 
                                                    Confidentiality: All information collected in this study including history, physical findings and results obtained from the participants and no name will be recorded. This cannot be linked to you in anyway and your name or any identifier will not be used in any publication or reports from this study. Also, all study records will be kept in locked file cabinets and encrypted, restricted access tablets or computers. <br><br> Voluntariness: Participation is entirely voluntary. Alternatives to participation: Individuals can decline to participate and the standard of their care will not be affected by this decision. <br><br> Due inducement(s): Participants will not be paid for participating in this research. Consequences of participants’ decision to withdraw from research and procedure for orderly termination of participation: You can decide to withdraw from the study at any point by informing the study coordinator or any other research personnel. There will be no consequences for withdrawing from the study. However, data previously collected from the participant may be included in the study report and analysis. Modality of providing treatments and action(s) to be taken in case of injury or adverse event(s): 
                                                    <br>
                                                    <br> What happens to research participants and communities when the research is over: Findings from the research will be communicated to the participants in writing. Details and result of the study will be communicated to the wider research community via a published peer-review article in a reputable journal.
                                                    <br>
                                                    <br>
                                                    Statement about sharing of benefits among researchers and whether this includes or exclude research participants: 
                                                    <br>
                                                    <br> 
                                                    Any apparent or potential conflict of interest: None 
                                                    <br>
                                                    <br> 
                                                    In case of any enquiry, please contact us at: 
                                                    <br> 
                                                    <div class="l2r justify-content-start align-start" style="gap: 10px">
                                                        <i class="bx bx-map font-size-18"></i>
                                                        <div>
                                                            Oncopadi Technologies Limited. <br> 24 Furo Ezimora Street, Marwa Lekki, Lagos
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="l2r justify-content-start align-start" style="gap: 10px">
                                                        <i class="bx bx-envelope font-size-18"></i>
                                                        <a href="www.oncopadi.com" target="_blank">
                                                            www.oncopadi.com
                                                        </a>
                                                    </div>
                                                    <br>
                                                    <div class="l2r justify-content-start align-start" style="gap: 10px">
                                                        <i class="bx bx-globe font-size-18"></i>
                                                        <a href="mailto:info@oncopadi.com">
                                                            info@oncopadi.com
                                                        </a>
                                                    </div>
                                                    <br>
                                                    <div class="l2r justify-content-start align-start" style="gap: 10px">
                                                        <i class="bx bx-phone font-size-18"></i>
                                                        <a href="tel:09134445529">
                                                            09134445529
                                                        </a>
                                                    </div>
                                            </p>
                                        </div>

                                        <div class="col-xl-12 col-md-12" style="margin: 0 auto;">

                                            <div class="form-check mb-3 mt-5">
                                                <input class="form-check-input" type="checkbox" id="consent" style="transform: scale(1.7) translate(3px,0px)">
                                                <label class="form-check-label font-size-14 ms-3" for="formCheck1" style="font-weight: 400;color: #000;">
                                                    I consent to participate in this research study.
                                                </label>
                                            </div>
                                            
                                            <div class="d-grid mt-5">
                                                <button class="btn btn-primary btn-lg waves-effect waves-light mx-auto w-100 mt-4" type="submit" id="proceed" style=" max-width: 600px; ">Continue</button>
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
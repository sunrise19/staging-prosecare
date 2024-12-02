<?php

    include('Config.php');

    if(isset($_REQUEST["data"])){

        $AUTH = $_REQUEST["data"][0];
        $date = $_REQUEST["data"][1];
        $name = $_REQUEST["data"][2];
        $witnessName = $_REQUEST["data"][3];
        $sendToEmail = $_REQUEST["data"][4];

        $sql = "SELECT * FROM users WHERE email_hash = '$AUTH'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            
            $sql = "UPDATE users SET consent='true', consent_date='$date', consent_name='$name', consent_witness='$witnessName' WHERE email_hash='$AUTH'";

            if($conn->query($sql) === TRUE) {

                $mailDocument = '<!DOCTYPE html>
<html>
<body>
<style>
body{
font-family: "Arial";}
.full-form{padding: 20px;}
input{
    border: 1px solid transparent;
    border-radius: 50px;
    overflow: hidden;
    background-color: #f5f5f5;
    padding: 10px 20px;
    margin: 5px 0 20px;
    font-size: 17px;
}
</style>
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
                                                    </p><div class="l2r justify-content-start align-start" style="gap: 10px">
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
                                            <p></p>
                                        </div>

                                    </form>
                                    <br><br><br><br>
                                    <form class="hide-on-success">
                                        <h3 class="text-dark text-center mb-2 font-weight-bold mb-5" style="font-weight: 700;">INFORMED CONSENT CERTIFICATE</h3>
                                        <div class="mb-3">
                                            <p class="font-size-14 hide-on-success" style="text-align: justify;line-height: 29px; color: #333;">
                                                Statement of person giving consent: 
                                                <br><br> 
                                                I have read the description of the research or have had it translated into language I understand. I have also talked it over with the doctor to my satisfaction. I understand that my participation is voluntary. I know enough about the purpose, methods, risks and benefits of the research study to judge that I want to take part in it. I understand that I may freely stop being part of this study at any time. I have received a copy of this consent form and additional information sheet to keep for myself.
                                            </p>

                                            <div class="col-xl-6 col-sm-12">

                                                <div class="mb-3">
                                                    <label class="i-g-block-label">Date</label>
                                                    <div class="input-group outlined">
                                                        <input value="'.$date.'" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="date" placeholder="Date" readonly="">
                                                    </div>
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="i-g-block-label">Name</label>
                                                    <div class="input-group outlined">
                                                        <input value="'.$name.'" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="name" placeholder="Name" readonly>
                                                    </div>
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="i-g-block-label">Witness Name</label>
                                                    <div class="input-group outlined">
                                                        <input value="'.$witnessName.'" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-15" id="witness_name" readonly="" placeholder="Witness Name">
                                                    </div>
                                                </div>

                                </div>
                                </div>

                                </form>


                        </body>
                        </html>
                        ';

                if($sendToEmail === TRUE || $sendToEmail == 'true'){
                    // Define headers
                    $headers = 'MIME-Version: 1.0' . "\r\n" .
                            'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                            'From: "PROSE Care" <no-reply@prosecare.com>' . "\r\n" .
                            'Reply-To: info@prosecare.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                    // Define subject
                    $subject = 'PROSEcare Informed Consent Document';

                    // Example email body ($mailDocument should be properly formatted HTML content)
                    $message = '
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>PROSE Care Informed Consent</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                                color: #333;
                                margin: 0;
                                padding: 20px;
                                background-color: #f9f9f9;
                            }
                            .email-container {
                                background: #ffffff;
                                border: 1px solid #dddddd;
                                border-radius: 8px;
                                max-width: 600px;
                                margin: 20px auto;
                                padding: 20px;
                                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                            }
                            .email-header {
                                text-align: center;
                                font-size: 24px;
                                color: #007BFF;
                            }
                            .email-footer {
                                text-align: center;
                                margin-top: 20px;
                                font-size: 12px;
                                color: #555;
                            }
                            a {
                                color: #007BFF;
                                text-decoration: none;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="email-container">
                            <h2 class="email-header">PROSEcare Informed Consent Document</h2>
                            <p>Dear Participant,</p>
                            <p>Attached is the **Informed Consent Document** for your review and reference. Please take a moment to read it carefully.</p>
                            <p>If you have any questions or require further assistance, feel free to reach out to us at <a href="mailto:info@prosecare.com">info@prosecare.com</a>.</p>
                            <p>Thank you for choosing <strong>PROSEcare</strong>.</p>
                            <p>Kind regards,<br><br><strong>PROSEcare Team</strong></p>
                        </div>
                        <div class="email-footer">
                            &copy; ' . date('Y') . ' PROSEcare. All rights reserved.
                        </div>
                    </body>
                    </html>
                    ';

                    // Send the email
                    mail($email, $subject, $message, $headers);

                }

                echo 1;
            }else{
                echo 0;
            }
        } else {
            echo 2;
        }
        
    }else{
        echo 'Please provide all data :/';
    }

    $conn->close();

?>
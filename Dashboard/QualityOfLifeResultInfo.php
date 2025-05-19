<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Quality Of Life Survey"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');

    $UID = $_REQUEST["ID"];

    if(!is_numeric($UID)){
        echo "<script>window.location.href= './Notifications'</script>";
        return;
    }

    $sql = "SELECT * FROM qol WHERE qol_id='$UID'";
    
    $result = $conn->query($sql);

    $data;
    $patientData;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = $row;

            $sql = "SELECT first_name, last_name FROM patients WHERE patient_id=".$row['patient_id'];
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $patientData = $row;
            }

        }

    }
?>

<style>
    #page-topbar,.vertical-menu{
        display: none;
    }
    .main-content, .page-content,.container-fluid{
        margin: 0;
        padding: 0
    }
    .se_title {
        margin-bottom: 20px;
        display: block;
    }
    textarea.se_status{
        min-height: 200px;
        max-height: 350px !important;
        border-radius: 10px;
        font-size: 16px;
    }
    .action_button {
        margin-left: auto; 
        margin-right: auto;
    }
    .t2b.as_sheet{
        flex: 1;
        width: 100%;
    }
</style>

        <?php
            $checkBoxes = '
                <div class="l2r check_box_holder">
                    <div class="se_status"><div class="se_check"></div>Not at all</div>
                    <div class="se_status"><div class="se_check"></div>A little</div>
                    <div class="se_status"><div class="se_check"></div>Quite a bit</div>
                    <div class="se_status"><div class="se_check"></div>Very much</div>
                </div>
            ';
            $checkBoxesClear = '
                <div class="l2r check_box_holder clear">
                    <span class="se_title">Poor</span>
                    <div class="se_status">1<div class="se_check"></div></div>
                    <div class="se_status">2<div class="se_check"></div></div>
                    <div class="se_status">3<div class="se_check"></div></div>
                    <div class="se_status">4<div class="se_check"></div></div>
                    <div class="se_status">5<div class="se_check"></div></div>
                    <div class="se_status">6<div class="se_check"></div></div>
                    <div class="se_status">7<div class="se_check"></div></div>
                    <span class="se_title">Excellent</span>
                </div>
            ';
        ?>


        <div class="main-content p-5">
            
            <i class="bx bx-left-arrow-alt back_to_chatlist mb-3" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>
            <span class="section_title mb-0">Quality of Life Survey Results &bull; <b><?php echo $patientData['first_name'] . ' ' . $patientData['last_name']?></b></span>
            <span class="font-size-15">We are interested in you and your health , Please answer all of the questions yourself by choosing the option that best applies to you</span>

            <!-- <div class="l2r my-5" style="gap: 5px">
                <div class="progress_tab active"></div>
                <div class="progress_tab"></div>
            </div> -->

            <div class="section_1 mt-5">
                
                <div class="t2b as_sheet" style="justify-content: start; gap: 35px; align-items: start">

                    <div class="t2b" data-name="strenuous_activities">
                        <div class="w-100">
                            <span class="se_title">1. Do you have any trouble doing strenuous activities, like carrying a heavy shopping bag or suitcase?</span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>
                    <div class="t2b" data-name="long_walk">
                        <div class="w-100">
                            <span class="se_title">2. Do you have any trouble taking a long walk?</span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>
                    <div class="t2b" data-name="short_walk_outside">
                        <div class="w-100">
                            <span class="se_title">3. Do you have any trouble taking a short walk outside of the house?</span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>
                    <div class="t2b" data-name="stay_in_bed">
                        <div class="w-100">
                            <span class="se_title">4. Do you need to stay in bed or a chair during the day?</span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>
                    <div class="t2b" data-name="help_with_eating">
                        <div class="w-100">
                            <span class="se_title">5. Do you need help with eating, dressing, washing yourself or using the toilet?</span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>
                </div>

                <div class="t2b as_sheet mt-5" style="justify-content: start; gap: 35px; align-items: start">
    
                    <span class="section_title mb-0">During The Past Week</span>

                    <div class="t2b" data-name="limited_in_doing_work">
                        <div class="w-100">
                            <span class="se_title">6. Were you limited in doing either your work or other daily activities?</span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="limited_in_pursuing_hobbies">
                        <div class="w-100">
                            <span class="se_title">
                                7. Were you limited in pursuing your hobbies or other leisure time activities?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="short_of_breath">
                        <div class="w-100">
                            <span class="se_title">
                                8. Were you short of breath?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="had_pain">
                        <div class="w-100">
                            <span class="se_title">
                                9. Have you had pain?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="need_to_rest">
                        <div class="w-100">
                            <span class="se_title">
                                10. Did you need to rest?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>
                    
                </div>

                <div class="action_button next_section my-5 d-none">
                    Next
                </div>
            </div>

            <div class="section_2">
                
                <div class="t2b as_sheet mt-5" style="justify-content: start; gap: 35px; align-items: start">

                    <div class="t2b" data-name="constipated">
                        <div class="w-100">
                            <span class="se_title">
                                11. Have you been constipated?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="diarrhoea">
                        <div class="w-100">
                            <span class="se_title">
                                12. Have you had diarrhoea?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="tired">
                        <div class="w-100">
                            <span class="se_title">
                                13. Were you tired?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="pain_interfere">
                        <div class="w-100">
                            <span class="se_title">
                                14. Did pain interfere with your daily activities?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="difficulty_in_concentrating">
                        <div class="w-100">
                            <span class="se_title">
                                15. Have you had difficulty in concentrating on things like reading a newspaper or watching television?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="feel_tense">
                        <div class="w-100">
                            <span class="se_title">
                                16. Did you feel tense?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>
                    
                    <div class="t2b" data-name="did_worry">
                        <div class="w-100">
                            <span class="se_title">
                                17. Did you worry?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="feel_irritable">
                        <div class="w-100">
                            <span class="se_title">
                                18. Did you feel irritable?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="feel_depressed">
                        <div class="w-100">
                            <span class="se_title">
                                19. Did you feel depressed?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="difficulty_remembering_things">
                        <div class="w-100">
                            <span class="se_title">
                                20. Have you had difficulty remembering things?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="treatment_interfered_with_family_life">
                        <div class="w-100">
                            <span class="se_title">
                                21. Has your physical condition or medical treatment interfered with your family life?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="treatment_interfered_with_social_activities">
                        <div class="w-100">
                            <span class="se_title">
                                22. Has your physical condition or medical treatment interfered with your social activities?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="financial_difficulties">
                        <div class="w-100">
                            <span class="se_title">
                                23. Has your physical condition or medical treatment caused you financial difficulties?
                            </span>
                            <?php echo $checkBoxes; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="overall_health">
                        <div class="w-100">
                            <span class="se_title">
                                24. How would you rate your overall health during the past week?
                            </span>
                            <?php echo $checkBoxesClear; ?>
                        </div>
                    </div>

                    <div class="t2b" data-name="overall_quality_of_life">
                        <div class="w-100">
                            <span class="se_title">
                                25. How would you rate your overall quality of life during the past week?
                            </span>
                            <?php echo $checkBoxesClear; ?>
                        </div>
                    </div>
                    
                </div>

                <div class="action_button submit_report my-5 d-none">
                    Submit
                </div>
            </div>

        </div>
        <!-- end main content-->
    <?php 
        $conn->close();
        include('Commons/footer.php');
    ?>
    <script>
        $(document).ready(function(){

            $('.back_to_chatlist').on('click', function(){
                window.location.href = 'QualityOfLifeResults?ID=<?php echo $data['patient_id']?>'
            })

            findAndSelect('strenuous_activities', '<?php echo $data['strenuous_activities'] ?>')
            findAndSelect('long_walk', '<?php echo $data['long_walk'] ?>')
            findAndSelect('short_walk_outside', '<?php echo $data['short_walk_outside'] ?>')
            findAndSelect('stay_in_bed', '<?php echo $data['stay_in_bed'] ?>')
            findAndSelect('help_with_eating', '<?php echo $data['help_with_eating'] ?>')
            findAndSelect('limited_in_doing_work', '<?php echo $data['limited_in_doing_work'] ?>')
            findAndSelect('limited_in_pursuing_hobbies', '<?php echo $data['limited_in_pursuing_hobbies'] ?>')
            findAndSelect('short_of_breath', '<?php echo $data['short_of_breath'] ?>')
            findAndSelect('had_pain', '<?php echo $data['had_pain'] ?>')
            findAndSelect('need_to_rest', '<?php echo $data['need_to_rest'] ?>')
            findAndSelect('constipated', '<?php echo $data['constipated'] ?>')
            findAndSelect('diarrhoea', '<?php echo $data['diarrhoea'] ?>')
            findAndSelect('tired', '<?php echo $data['tired'] ?>')
            findAndSelect('pain_interfere', '<?php echo $data['pain_interfere'] ?>')
            findAndSelect('difficulty_in_concentrating', '<?php echo $data['difficulty_in_concentrating'] ?>')
            findAndSelect('feel_tense', '<?php echo $data['feel_tense'] ?>')
            findAndSelect('did_worry', '<?php echo $data['did_worry'] ?>')
            findAndSelect('feel_irritable', '<?php echo $data['feel_irritable'] ?>')
            findAndSelect('feel_depressed', '<?php echo $data['feel_depressed'] ?>')
            findAndSelect('difficulty_remembering_things', '<?php echo $data['difficulty_remembering_things'] ?>')
            findAndSelect('treatment_interfered_with_family_life', '<?php echo $data['treatment_interfered_with_family_life'] ?>')
            findAndSelect('treatment_interfered_with_social_activities', '<?php echo $data['treatment_interfered_with_social_activities'] ?>')
            findAndSelect('financial_difficulties', '<?php echo $data['financial_difficulties'] ?>')
            findAndSelect('overall_health', '<?php echo $data['overall_health'] ?>')
            findAndSelect('overall_quality_of_life', '<?php echo $data['overall_quality_of_life'] ?>')

            function findAndSelect(name, value){
                $('div[data-name="'+name+'"]').find('.se_status').each(function(){
                    let t = $(this)
                    if(t.text().toLowerCase().includes(value.toLowerCase())){
                        t.addClass('active')
                    }
                })
            }

            $('.check_box_holder .se_status').on('click', function(){
                $(this).siblings().removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>


</body>

</html>
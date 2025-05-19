<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Quality Of Life Survey"; 
    include('Commons/header.php');   
    include('../STATIC_API/Config.php');
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
            <span class="section_title mb-0">Quality of Life Survey</span>
            <span class="font-size-15">We are interested in you and your health , Please answer all of the questions yourself by choosing the option that best applies to you</span>

            <div class="l2r my-5" style="gap: 5px">
                <div class="progress_tab active"></div>
                <div class="progress_tab"></div>
            </div>

            <div class="section_1">
                
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

                <div class="action_button next_section my-5">
                    Next
                </div>
            </div>

            <div class="section_2 d-none">
                
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

                <div class="action_button submit_report my-5">
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

            let isInSection2 = false

            $('.next_section').on('click', function(){
      
                let strenuous_activities = $('div[data-name="strenuous_activities"] .se_status.active').text().trim(),
                    long_walk = $('div[data-name="long_walk"] .se_status.active').text().trim(),
                    short_walk_outside = $('div[data-name="short_walk_outside"] .se_status.active').text().trim(),
                    stay_in_bed = $('div[data-name="stay_in_bed"] .se_status.active').text().trim(),
                    help_with_eating = $('div[data-name="help_with_eating"] .se_status.active').text().trim(),
                    limited_in_doing_work = $('div[data-name="limited_in_doing_work"] .se_status.active').text().trim(),
                    limited_in_pursuing_hobbies = $('div[data-name="limited_in_pursuing_hobbies"] .se_status.active').text().trim(),
                    short_of_breath = $('div[data-name="short_of_breath"] .se_status.active').text().trim(),
                    had_pain = $('div[data-name="had_pain"] .se_status.active').text().trim(),
                    need_to_rest = $('div[data-name="need_to_rest"] .se_status.active').text().trim()

                if([strenuous_activities, long_walk, short_walk_outside, stay_in_bed, help_with_eating, limited_in_doing_work, limited_in_pursuing_hobbies, short_of_breath, had_pain, need_to_rest].includes('')){
                    Swal.fire({
                        title: 'Oops',
                        html: 'You need to fill out all questions before proceeding',
                        type: 'error'
                    })
                    return 
                }
                isInSection2 = true
                $('.section_1,.section_2').toggleClass('d-none')
                $('.progress_tab').toggleClass('active')
                
                $('.submit_report').off('click').on('click', function(){

                    let constipated = $('div[data-name="constipated"] .se_status.active').text().trim(),
                        diarrhoea = $('div[data-name="diarrhoea"] .se_status.active').text().trim(),
                        tired = $('div[data-name="tired"] .se_status.active').text().trim(),
                        pain_interfere = $('div[data-name="pain_interfere"] .se_status.active').text().trim(),
                        difficulty_in_concentrating = $('div[data-name="difficulty_in_concentrating"] .se_status.active').text().trim(),
                        feel_tense = $('div[data-name="feel_tense"] .se_status.active').text().trim(),
                        did_worry = $('div[data-name="did_worry"] .se_status.active').text().trim(),
                        feel_irritable = $('div[data-name="feel_irritable"] .se_status.active').text().trim(),
                        feel_depressed = $('div[data-name="feel_depressed"] .se_status.active').text().trim(),
                        difficulty_remembering_things = $('div[data-name="difficulty_remembering_things"] .se_status.active').text().trim(),
                        treatment_interfered_with_family_life = $('div[data-name="treatment_interfered_with_family_life"] .se_status.active').text().trim(),
                        treatment_interfered_with_social_activities = $('div[data-name="treatment_interfered_with_social_activities"] .se_status.active').text().trim(),
                        financial_difficulties = $('div[data-name="financial_difficulties"] .se_status.active').text().trim(),
                        overall_health = $('div[data-name="overall_health"] .se_status.active').text().trim(),
                        overall_quality_of_life = $('div[data-name="overall_quality_of_life"] .se_status.active').text().trim()

                    console.log([constipated, diarrhoea, tired, pain_interfere, difficulty_in_concentrating, feel_tense, did_worry, feel_irritable, feel_depressed, difficulty_remembering_things, treatment_interfered_with_family_life, treatment_interfered_with_social_activities, financial_difficulties, overall_health, overall_quality_of_life])
                    if([constipated, diarrhoea, tired, pain_interfere, difficulty_in_concentrating, feel_tense, did_worry, feel_irritable, feel_depressed, difficulty_remembering_things, treatment_interfered_with_family_life, treatment_interfered_with_social_activities, financial_difficulties, overall_health, overall_quality_of_life].includes('')){
                        Swal.fire({
                            title: 'Oops',
                            html: 'You need to fill out all questions before proceeding',
                            type: 'error'
                        })
                        return 
                    }

                    const formData = {
                        strenuous_activities: strenuous_activities,
                        long_walk: long_walk,
                        short_walk_outside: short_walk_outside,
                        stay_in_bed: stay_in_bed,
                        help_with_eating: help_with_eating,
                        limited_in_doing_work: limited_in_doing_work,
                        limited_in_pursuing_hobbies: limited_in_pursuing_hobbies,
                        short_of_breath: short_of_breath,
                        had_pain: had_pain,
                        need_to_rest: need_to_rest,
                        constipated: constipated,
                        diarrhoea: diarrhoea,
                        tired: tired,
                        pain_interfere: pain_interfere,
                        difficulty_in_concentrating: difficulty_in_concentrating,
                        feel_tense: feel_tense,
                        did_worry: did_worry,
                        feel_irritable: feel_irritable,
                        feel_depressed: feel_depressed,
                        difficulty_remembering_things: difficulty_remembering_things,
                        treatment_interfered_with_family_life: treatment_interfered_with_family_life,
                        treatment_interfered_with_social_activities: treatment_interfered_with_social_activities,
                        financial_difficulties: financial_difficulties,
                        overall_health: overall_health,
                        overall_quality_of_life: overall_quality_of_life
                    }

                    $.ajax({
                        url: './API/api_submit_qol.php',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            if(data == 1){
                                Swal.fire({
                                    title: 'Survey Submitted Successfully',
                                    type: 'success'
                                })
                                .then(() => {
                                    window.location.href = 'Home'
                                })
                            }else{
                                console.log(data)
                                Swal.fire({
                                    title: 'Failed to submit survey',
                                    type: 'error'
                                })
                            }
                        },
                        fail: function (data) {
                            console.log(data)
                            Swal.fire({
                                title: 'Failed to submit survey',
                                type: 'error'
                            })
                        },
                        error: function (data) {
                            console.log(data)
                            Swal.fire({
                                title: 'Failed to submit survey',
                                type: 'error'
                            })
                        }
                    })

                })

            })

            $('.back_to_chatlist').on('click', function(){
                if(!isInSection2){
                    window.location.href = 'Home'
                }
                $('.section_1,.section_2').toggleClass('d-none')
                $('.progress_tab').toggleClass('active')
                isInSection2 = false
            })

            $('.check_box_holder .se_status').on('click', function(){
                $(this).siblings().removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>


</body>

</html>
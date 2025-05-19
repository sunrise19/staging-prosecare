<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Ask A Question";
include('Commons/header.php');
include('../STATIC_API/Config.php');
?>

<style>
    #page-topbar,
    .vertical-menu {
        /* display: none; */
    }

    .main-content,
    .page-content,
    .container-fluid {
        /* margin: 0; */
        /* padding: 0 */
    }

    .se_title {
        margin-bottom: 20px;
        display: block;
    }

    textarea.se_status {
        min-height: 200px;
        max-height: 350px !important;
        border-radius: 10px;
        font-size: 16px;
    }

    .action_button {
        margin-left: auto;
        margin-right: auto;
    }

    .t2b.as_sheet {
        flex: 1;
        width: 100%;
    }

    .section_title {
        font-weight: 600 !important;
        font-size: 24px !important
    }

    .card.mini-stats-wid {
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;
        height: 300px;
    }

    .card-body {
        display: flex;
        align-items: end;
    }

    .profile-user-wid {
        margin-top: 0;
    }

    .ep {
        padding: 1px 11px;
        border-radius: 10px;
        margin-left: 15px;
        color: #fff !important;
        margin-top: -4px;
    }

    .img-thumbnail {
        padding: 0;
        border-radius: 10px !important;
        width: 107px;
        height: 107px;
        max-width: unset;
    }

    .ut {
        background: #ff650e52;
        color: #FF650E;
    }

    .avatar-md {
        width: unset;
        height: unset;
    }

    .table td,
    .table th {
        border: none;
    }

    tr:hover {
        background: none;
    }

    .sweetselect {
        width: 100%;
        padding: 11.05px 8px;
    }

    .edit_section {
        /* display: none; */
    }

    .centralize {
        width: 100%;
        display: block;
        height: 50px;
        text-align: center;
    }


    .table td,
    .table th {
        border: none;
        padding: 0;
    }

    tr {
        display: flex;
        flex-direction: column;
        margin: 30px 0;
        gap: 7px;
        color: #000;
    }

    .table th {
        color: #555;
    }

    .table td {
        font-size: 16px;
    }

    .page-title-box h4 {
        text-transform: unset;
        color: #000;
        font-size: 20px !important;
    }

    .card-body {
        padding: 0;
        background: #f9f9f9 !important;
    }

    .card {
        background-color: #f9f9f9 !important;
        box-shadow: none !important
    }

    .tiny_image {
        border-radius: 500px;
        width: 200px;
        height: 200px;
        pointer-events: all !important;
        object-fit: cover;
        -webkit-user-drag: none;
    }

    button {
        border-radius: 50px !important;
        font-weight: 500 !important;
        padding: 14px 27px !important;
        font-size: 15px !important;
    }

    .card span {
        font-size: 15px;
        color: #000;
        font-weight: 500;
    }

    .form-control,
    .sweetselect {
        border: 1px solid #8D2D9233 !important;
        border-radius: 30px;
        padding: 15px 29px;
        height: unset;
        font-size: 14px;
        margin-top: 4px;
    }

    .vertical_section {
        display: none;
    }

    .btn.btn-primary {
        width: fit-content;
        margin: 30px auto 0;
    }

    .btn-primary.alt {
        background: #8D2D9226;
        color: #8D2D92;
    }
</style>



    <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 650px;" role="document">
            <div class="modal-content"> 
                <div class="modal-header py-0 px-2" style="border: none">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <div class="close_treament_modal" data-dismiss="modal" aria-label="Close">+</div>
                </div>
                
                <div class="modal-body">

                    <div class="l2r mb-2">
                        <span class="bold_span">Question</span>
                        <span class="question_date"></span>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-3 as_sheet p-3 bg-white">
                        <span class="bold_span question_title"></span>
                        <textarea class="form-control question_value p-0" style="border: 0 !important; border-radius: 0" readonly></textarea>
                    </div>

                    <div class="is_answered mt-4">

                        <div class="l2r">
                            <span class="bold_span answered_by mb-2 d-block"></span>
                            <span class="answer_date"></span>
                        </div>
                        <div class="col-sm-12 col-lg-12 mb-3 as_sheet p-3 bg-white">
                            <textarea class="form-control answer_value p-0" style="border: 0 !important; border-radius: 0" readonly></textarea>
                        </div>
    
                        <div class="l2r p-3 mt-5" style="background: #8D2D9217; border-radius: 10px">
                            <div class="l2r">
                                <i class="dripicons-thumbs-up bg-white text-primary"
                                style="
                                    width: 50px;
                                    height: 50px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    border-radius: 50px;
                                    font-size: 19px;
                                    margin-right: 15px;
                                "></i>
                                <span class="font-weight-bold text-dark font-size-16">Are you satisfied with this response?</span>
                            </div>
                            <div class="l2r" style="gap: 10px">
                                <button class="btn btn-primary m-0 py-2 satisfied">Yes</button>
                                <button class="btn decline text-primary py-2 bg-white dissatisfied">No</button>
                            </div>
                        </div>

                    </div>
                    

                </div>

            </div>
        </div>
    </div>

<div class="main-content p-5">

    <i class="bx bx-left-arrow-alt back_to_chatlist mb-3" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>
    <span class="section_title mb-3">Ask a Question</span>

    <div class="l2r align-start" style="gap: 20px;">
        <div class="tab_container PersonalInformation" style="display: block;">
            <div class="edit_section mt-4">

                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2 w-100">
                                <div class="col-sm-12 col-lg-12 mb-3">
                                    <span>Side Effect</span>
                                    <select name="" id="side_effect" class="sweetselect">
                                        <option selected disabled>Select a side effect</option>
                                        <option value="Tiredness">Tiredness</option>
                                        <option value="Vomiting">Vomiting</option>
                                        <option value="Nausea">Nausea</option>
                                        <option value="Mouth sores">Mouth sores</option>
                                        <option value="Headache">Headache</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-12 mb-3 question_box">
                                    <span>Question</span>
                                    <textarea rows="10" class="form-control" placeholder="Ask your question"></textarea>
                                </div>
                            </div>


                        </div>
                        <div class="l2r add_prescription p-3" style="background: #F4EAF5; width: fit-content; border-radius: 30px">
                            <img src="IMG/Add_Plus_Circle.svg" alt="">
                            <span class="text-primary">Add another question</span>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light submit_report blue">Send Question</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="tab_container" style="display: block; max-width: 300px; height: 630px">
            <div class="edit_section mt-4" style="height: 630px">

                <div class="col-12 p-0">

                    <div class="card">
                        <div class="card-body w-100">
                            <div class="row m-0 w-100">
                                <div class="col-sm-12 col-lg-12 mb-3 p-0">
                                    <span>Previously Asked Questions</span>

                                    <?php

                                    $user_id = $_SESSION['id'];

                                    $sql = "SELECT * FROM questions WHERE user_id=" . $user_id . " ORDER BY question_id DESC";

                                    $result = mysqli_query($conn, $sql);

                                    $questionsArray = array();

                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {

                                            $questionsJSON = json_decode($row['questions'], true);

                                            if ($questionsJSON === null && json_last_error() !== JSON_ERROR_NONE) {
                                                
                                            }else{

                                                $questionsArray[$row['question_id']] = $row['questions'];


                                                $index = -1;

                                                foreach ($questionsJSON as $entry) {

                                                    $index += 1;

                                                    $answered_by = '';

                                                    if($entry['answered_by'] != ''){
                                                        $sql = "SELECT * FROM hcp WHERE user_id=" . $entry['answered_by'];
                                                        $resultHcp = mysqli_query($conn, $sql);
                                                        if ($resultHcp->num_rows > 0) {
                                                            while ($rowHcp = $resultHcp->fetch_assoc()) {
                                                                $answered_by = 'Dr. ' . ucwords($rowHcp['first_name'] . ' ' . $rowHcp['last_name']);
                                                            }
                                                        }
                                                    }

                                                    echo  '
                                                            <div 
                                                                class="l2r as_sheet my-2 p-2 set_qa" 
                                                                style="background: #fff; gap: 3px" 
                                                                id="'.$row['question_id'].'"
                                                                data-index="'.$index.'"
                                                                data-toggle="modal" 
                                                                data-target="#questionModal" 
                                                                data-answer="'.$entry['answer'].'" 
                                                                data-answered-by="'.$answered_by.'" 
                                                                data-answer-date="'.timeDifference($entry['answer_date'], $entry['answer_time']).'" 
                                                                data-side-effect="'.$row['side_effect'].'"
                                                            >
                                                                <div class="t2b" style="gap: 3px">
                                                                    <span class="question_text">' . ucfirst($entry['question']) . '</span>
                                                                    <span class="small_date">' . timeDifference($row['date'], $row['time']) . '</span>
                                                                </div>

                                                                <i class="bx bx-chevron-right mt-2 font-size-18"></i>

                                                            </div>
                                                        ';
                                                }

                                            }

                                        }
                                    } else {
                                        echo '<br><br>No questions asked :/';
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


</div>
<!-- end main content-->
<?php
$conn->close();
include('Commons/footer.php');
?>
<script src="JS/Profile.js"></script>
<script src="../assets/js/places.js"></script>
<script>
    const FROM = '<?php echo $_REQUEST["From"] ?>';

    $(document).ready(function() {

        let section = 1

        let allQuestions = <?php echo json_encode($questionsArray); ?>;

        let currentQuestion = null

        let name = '',
            email = '',
            phone = '',
            address = '',
            password = ''

        $('.back_to_chatlist').on('click', function() {
            if (section == 1 || section == 3) {
                window.location.href = FROM
            } else if (section == 2) {
                section = 1
                $('.tab_container').hide()
                $('.tab_container.PersonalInformation').show()
            }
        })

        $('.set_qa').on('click', function(){
            let t = $(this)
            currentQuestion = 
            t.attr('data-answer') == '' ? $('.is_answered').addClass('d-none') :  $('.is_answered').removeClass('d-none')
            $('.question_title').text(t.attr('data-side-effect'))
            $('.question_date').text(t.find('.small_date').text())
            $('.answered_by').html(`Answered By <span class="text-primary">${t.attr('data-answered-by') || ''}</span>`)
            $('.question_value').val(t.find('.question_text').text())
            $('.answer_value').val(t.attr('data-answer'))
            $('.answer_date').text(t.attr('data-answer-date'))
            $('.satisfied')
            .parent()
            .attr('data-id', t.attr('id'))
            .attr('data-index', t.attr('data-index'))

        })
        
        $('.satisfied,.dissatisfied').off('click').on('click', function(){

            let t = $(this),
                p = t.parent(),
                id = p.attr('data-id'),
                index = Number(p.attr('data-index')),
                thisJSON = JSON.parse(allQuestions[id]),
                newJSON = [...thisJSON]

                newJSON[index] = {
                    ...thisJSON[index], 
                    satisfied: t.hasClass('satisfied') ? 'yes' : 'no'
                }

            const err = (data) => {
                console.log(data)
                e('Failed to save feedback:/<br><sub>Try again later.</sub>')
            }

            $('#questionModal').modal('hide')

            Swal.fire({
                title: 'Saving Response',
                allowOutsideClick: false,
                onBeforeOpen: function() {
                    Swal.showLoading()
                }
            })

            $.ajax({
                url: `./API/api_update_question.php?id=${id}`,
                type: 'POST',
                data: {
                    questions: JSON.stringify(newJSON)
                },
                success: function(data) {
                    
                    if (data == 1) {
                        Swal.fire({
                            title: 'Response Saved Successfully',
                            type: 'success'
                        })
                        .then(()=>{
                            window.location.reload()
                        })
                        return
                    } 

                    err(data)
                    
                },
                fail: (data) => err(data),
                error: (data) => err(data),
            })

            console.log(id, index, newJSON)
            
        })

        $('.add_prescription').on('click', function() {

            const newQuestion = `<div class="col-sm-12 col-lg-12 mb-3 question_box">
                                <span>Question</span>
                                <textarea rows="10" class="form-control" placeholder="Ask your question"></textarea>
                                <div class="t2b w-100">
                                    <div class="l2r remove_prescription">
                                        <i class="bx bx-trash"></i>
                                        Remove Question
                                    </div>
                                </div>
                            </div>`

            $('.question_box').last().after(newQuestion)

            $('.remove_prescription').off('click').on('click', function() {
                $(this).parent().parent().remove()
            })

        })

        $('#state').on('change', function() {
            const thisVal = $(this).val()
            let result = '<option disabled selected value=""></option>'
            CountryStates.Nigeria.LGAs[thisVal]?.forEach(element => {
                result += `<option value="${element}">${element}</option>`
            })
            $('#lga').html(result)
        })

        $('#religion,#relationship,#device').on('change', function() {
            const thisVal = $(this).val(),
                target = $(this).siblings('input')
            if (thisVal == 'other') {
                target.css('display', 'flex')
            } else {
                target.css('display', 'none')
            }
        })

        $('.S-' + FROM).addClass('mm-active').find('a').addClass('active')


        $('.submit_report').on('click', function() {

            const side_effect = $('#side_effect').val()

            let questions = []

            $('.question_box').each(function() {
                let t = $(this)
                questions.push({
                    question: t.find('textarea').val(),
                    answer: '',
                    answered_by: '',
                    answer_date: '',
                    answer_time: '',
                    satisfied: ''
                })
            })

            if (questions.length < 1 || $('.question_box').eq(0).find('textarea').val() == '') {
                Swal.fire({
                    title: 'No question asked',
                    type: 'error'
                })
                return
            }

            Swal.fire({
                title: 'Processing',
                allowOutsideClick: false,
                onBeforeOpen: function() {
                    Swal.showLoading()
                }
            })

            const formData = {
                side_effect: side_effect,
                questions: JSON.stringify(questions),
            }

            $.ajax({
                url: './API/api_ask_question.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            title: 'Question Sent Successfully',
                            type: 'success'
                        })
                        .then(()=>{
                            window.location.reload()
                        })
                    } else {
                        console.log(data)
                        e('Failed to send question:/<br><sub>Try again later.</sub>')
                    }
                },
                fail: function(data) {
                    console.log(data)
                    e('Failed to send question:/<br><sub>Try again later.</sub>')
                },
                error: function(data) {
                    console.log(data)
                    e('Failed to send question:/<br><sub>Try again later.</sub>')
                }
            })

            function e(e) {
                Swal.fire({
                    title: 'Oops',
                    html: e,
                    type: 'error'
                })
            }

        })

    })
</script>


</body>

</html>
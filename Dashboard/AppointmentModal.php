<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Appointment"; 
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
    .tab_container {
        max-height: 300px;
        overflow: auto;
    }
</style>

<link rel="stylesheet" href="CSS/chat.css">



<?php 
    include('Commons/subscription.php');
?>

        <div class="main-content p-0">
            
            <!-- <i class="bx bx-left-arrow-alt back_to_chatlist mb-3" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i> -->
            <span class="section_title mb-0">Select an Healthcare Professional</span>
            <!-- <span class="font-size-15">We are interested in you and your health , Please answer all of the questions yourself by choosing the option that best applies to you</span> -->

            <div class="l2r my-4" style="gap: 70px; justify-content: start;">
                <a class="tab_item active" data-tab="in">Doctors in your network</a>
                <a class="tab_item" data-tab="out">Doctors outside your network</a>
            </div>
         
            <div class="tab_container in" style="display: block">
                <?php 

                    $hospital_id = $_SESSION['hospital_id'];

                    $sql = "SELECT * FROM hcp JOIN users on users.user_id=hcp.user_id WHERE hcp.hospital='$hospital_id'";
                                    
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($row['active'] == 'true'){
                                echo '
                                <li class="open_chat p-3" id="'.$row['hcp_id'].'" style=" list-style-type: none; border-bottom: 1px solid #ccc">
                                    <a href="javascript: void(0);">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center me-3">
                                                <img src="IMG/'.$row['photo'].'" class="rounded-circle avatar-xs" alt="">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Dr. '.ucwords($row['first_name'] . ' ' . $row['last_name']).'</h5>
                                                <p class="text-truncate mb-0">'.$row['specialty'].'</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                ';
                            }
                        }
                    }
                ?>
            </div>

            <div class="tab_container out">
                <?php

                    $sql = "SELECT * FROM hcp JOIN users on users.user_id=hcp.user_id WHERE NOT hcp.hospital='$hospital_id'";
                    
                    // if($hospital_id == ''){
                    //     $sql = "SELECT * FROM hcp JOIN users on users.user_id=hcp.user_id";
                    // }

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($row['active'] == 'true'){
                                echo '
                                <li class="open_chat out p-3" style=" list-style-type: none; border-bottom: 1px solid #ccc;" data-toggle="modal" data-target="#premiumModal">
                                    <a href="javascript: void(0);">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center me-3">
                                                <img src="IMG/'.$row['photo'].'" class="rounded-circle avatar-xs" alt="">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Dr. '.$row['first_name']. ' ' . $row['last_name'] . '</h5>
                                                <p class="text-truncate mb-0">'.$row['specialty'].'</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                ';
                            }
                        }
                    }
                ?>
            </div>
            
            <div class="l2r as_sheet mt-5">
                <div class="t2b w-100">
                    <span class="se_title">Doctor</span>
                    <input class="se_status doctor" readonly type="text" value="" placeholder="Select a doctor above"/>
                </div>
                <div class="t2b w-100">
                    <span class="se_title">Agenda</span>
                    <input class="se_status agenda" type="text" value="Consultation" placeholder="e.g Consultation"/>
                </div>
                <div class="t2b w-100">
                    <span class="se_title">Date</span>
                    <input class="se_status date" type="date" id="dateInput"/>
                </div>
                <div class="t2b w-100">
                    <span class="se_title">Time</span>
                    <input class="se_status time" type="time"/>
                </div>
            </div>

            <div class="action_button next_section my-5">
                Book Appointment
            </div>

        </div>
        <!-- end main content-->
    <?php 
        $conn->close();
        include('Commons/footer.php');
    ?>
    <script>

        // Get today's date
        const today = new Date();

        // Format the date as YYYY-MM-DD
        const formattedToday = today.toISOString().split('T')[0];

        // Set the minimum date attribute of the input element
        document.getElementById('dateInput').setAttribute('min', formattedToday);

        $(document).ready(function(){

            let hcp_id = null;
            
            $('.tab_item').on('click', function () {
                let t = $(this),
                    tab = t.attr('data-tab')

                if (!tab) return

                $('.tab_item').removeClass('active')
                t.addClass('active')

                $('.tab_container').hide()
                $('.tab_container.' + tab).show()
            })

            $('.open_chat').on('click', function(){
                let t = $(this),
                    name = t.find('h5').text()

                if(t.hasClass('out')) return
                
                hcp_id = t.attr('id')
                $('.open_chat').css('background', 'none')
                t.css('background', '#fee7ff')
                $('.doctor').val(name)
            })

            $('.next_section').on('click', function(){
      
                let doctor = $('.doctor').val().trim(),
                    agenda = $('.agenda').val().trim(),
                    date = $('.date').val().trim(),
                    time = $('.time').val().trim()

                if([doctor, agenda, date, time].includes('') || !hcp_id){
                    Swal.fire({
                        title: 'Oops',
                        html: 'You need to fill out all fields before proceeding',
                        type: 'error'
                    })
                    return 
                }
                
                const formData = {
                        hcp_id: hcp_id,
                        agenda: agenda,
                        date: formatDate(date),
                        time: formatTime(time),
                    }

                    $.ajax({
                        url: './API/api_create_appointment.php',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            if(data == 1){
                                Swal.fire({
                                    title: 'Appointment Booked Successfully',
                                    type: 'success'
                                })
                                .then(() => {
                                    window.location.reload()
                                })
                            }else{
                                console.log(data)
                                Swal.fire({
                                    title: 'Failed to book appointment',
                                    type: 'error'
                                })
                            }
                        },
                        fail: function (data) {
                            console.log(data)
                            Swal.fire({
                                title: 'Failed to book appointment',
                                type: 'error'
                            })
                        },
                        error: function (data) {
                            console.log(data)
                            Swal.fire({
                                title: 'Failed to book appointment',
                                type: 'error'
                            })
                        }
                    })

            })

            function formatDate(inputDate) {
                // Create a Date object
                const date = new Date(inputDate);

                // Define options for formatting the date
                const options = { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' };

                // Format the date
                const formattedDate = date.toLocaleDateString('en-US', options);

                return formattedDate
            }

            function formatTime(inputTime) {
                // Parse the input time string
                const timeParts = inputTime.split(':');
                const hours = parseInt(timeParts[0], 10);
                let minutes = parseInt(timeParts[1], 10);

                // Determine AM or PM
                const amOrPm = hours >= 12 ? 'pm' : 'am';

                // Adjust hours for 12-hour format
                let formattedHours = hours % 12;
                formattedHours = formattedHours ? formattedHours : 12; // 12-hour clock, so 0 should be 12

                formattedHours = formattedHours < 10 ? '0' + formattedHours : formattedHours
                // Pad minutes with leading zero if necessary
                minutes = minutes < 10 ? '0' + minutes : minutes;

                // Format the time
                const formattedTime = `${formattedHours}:${minutes}:00 ${amOrPm}`;

                return formattedTime;
            }



        })
    </script>


</body>

</html>
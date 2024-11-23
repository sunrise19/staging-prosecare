<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Appointment";
include('Commons/header.php');
include('../STATIC_API/Config.php');
?>

<style>
    #page-topbar,
    .vertical-menu {
        display: none;
    }

    .main-content,
    .page-content,
    .container-fluid {
        margin: 0;
        padding: 0
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

    .tab_container {
        height: 300px;
        overflow: auto;
    }
</style>

<link rel="stylesheet" href="CSS/chat.css">


<?php include('Commons/subscription.php'); ?>

<div class="main-content p-0">

    <span class="section_title mb-0">Select an Healthcare Professional</span>

    <!-- start search -->
    <div class="search-box chat-search-box my-2" style=" padding: 0 !important; flex: 1 ">
        <div class="position-relative">
            <input type="text" class="form-control find_contact" placeholder="Search HCPs" style="background: #F9F9F9;">
            <i class="mdi mdi-magnify search-icon"></i>
        </div>
    </div>
    <!-- end search -->

    <div class="tab_container in" style="display: block">
        <?php

        $hospital_id = $_SESSION['hospital_id'];

        $sql = "SELECT * FROM hcp JOIN users on users.user_id=hcp.user_id WHERE hcp.hospital=$hospital_id";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['active'] == 'true') {
                    echo '
                                <li class="open_chat p-3" id="' . $row['hcp_id'] . '" style=" list-style-type: none; border-bottom: 1px solid #ccc">
                                    <a href="javascript: void(0);">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center me-3">
                                                <img src="IMG/' . $row['photo'] . '" class="rounded-circle avatar-xs" alt="">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Dr. ' . ucwords($row['first_name'] . ' ' . $row['last_name']) . '</h5>
                                                <p class="text-truncate mb-0">' . $row['specialty'] . '</p>
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

    <div class="action_button next_section my-5">
        Assign
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
    document.getElementById('dateInput')?.setAttribute('min', formattedToday);

    $(document).ready(function() {

        let hcp_id = null;

        $('.tab_item').on('click', function() {
            let t = $(this),
                tab = t.attr('data-tab')

            if (!tab) return

            $('.tab_item').removeClass('active')
            t.addClass('active')

            $('.tab_container').hide()
            $('.tab_container.' + tab).show()
        })

        $('.open_chat').on('click', function() {
            let t = $(this),
                name = t.find('h5').text()

            if (t.hasClass('out')) return

            hcp_id = t.attr('id')
            $('.open_chat').css('background', 'none')
            t.css('background', '#fee7ff')
            $('.doctor').val(name)
        })

        $('.find_contact').keyup(function() {

            let v = $(this).val().trim().toLowerCase()

            if (v == '') {
                $('.open_chat').show()
            } else {
                $('.open_chat').each(function() {
                    const t = $(this),
                        thisText = t.find('h5').text().trim().toLowerCase()
                    if (thisText.includes(v) || v.includes(thisText)) {
                        t.show()
                    } else {
                        t.hide()
                    }
                })
            }
        })

        $('.next_section').on('click', function() {

            if (!hcp_id) {
                Swal.fire({
                    title: 'Oops',
                    html: 'Please select a HCP',
                    type: 'error'
                })
                return
            }

            $.ajax({
                url: './API/api_assign_hcp_to_patient.php?HCP_ID='+hcp_id+'&PatientUserID='+<?php echo $_REQUEST['PatientUserID']?>,
                type: 'POST',
                success: function(data) {
                    if (data == 1) {
                        parent.closeModal()
                        parent.alertSuccess('Assigned Successfully', true)
                    } else {
                        console.log(data)
                        parent.alertError('Failed to Assign Patient')
                    }
                },
                fail: function(data) {
                    console.log(data)
                    parent.alertError('Failed to Assign Patient')
                },
                error: function(data) {
                    console.log(data)
                    parent.alertError('Failed to Assign Patient')
                }
            })

        })

        function formatDate(inputDate) {
            // Create a Date object
            const date = new Date(inputDate);

            // Define options for formatting the date
            const options = {
                weekday: 'long',
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            };

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
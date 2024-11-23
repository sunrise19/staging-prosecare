<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Send Notification";
include('Commons/header.php');
include('../STATIC_API/Config.php');
if (!isset($_SESSION["superadmin"])) {
    header('Location: Home');
}
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


<div class="main-content p-5">

    <i class="bx bx-left-arrow-alt back_to_chatlist mb-3" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>
    <span class="section_title mb-3">Send Notification</span>

    <div class="tab_container PersonalInformation" style="display: block;">
        <div class="edit_section mt-4">

            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="w-100 mb-2">
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <span>Notification Type</span>
                                <select id="type" class="sweetselect" data-default="">
                                    <option disabled="" value="" selected="selected">Select a notification type</option>
                                    <option value="SMS">SMS</option>
                                    <option value="Push Notification">Push Notification</option>
                                    <option value="Email">Email</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <span>Send To</span>
                                <div class="l2r check_box_holder w-50 w-sm-100">
                                    <div class="se_status active border-0 bg-transparent">
                                        <div class="se_check"></div>All Users
                                    </div>
                                    <div class="se_status border-0 bg-transparent">
                                        <div class="se_check"></div>Custom
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 mb-4 select_users_col d-none">
                                <span>Select Users</span>
                                <input class="form-control user_search" type="text" placeholder="Search for users">
                                <span class="close_search d-none">+</span>
                                <div class="t2b dropdown_list d-none">
                                    <?php

                                    global $conn;

                                    $data = '';

                                    $sql = 'SELECT * FROM patients';

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $data .= '<span class="dropdown_item" id="'.$row['user_id'].'" data-name="' . ucwords($row['first_name'] . ' '  . $row['last_name']) . '">' . ucwords($row['first_name'] . ' '  . $row['last_name']) . '</span>';
                                        }
                                    }

                                    $sql = 'SELECT * FROM hcp';

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $data .= '<span class="dropdown_item" id="'.$row['user_id'].'" data-name="Dr. ' . ucwords($row['first_name'] . ' '  . $row['last_name']) . '">Dr. ' . ucwords($row['first_name'] . ' '  . $row['last_name']) . '</span>';
                                        }
                                    }


                                    echo $data;

                                    $conn->close();

                                    ?>

                                </div>
                                <div class="py-3 l2r justify-content-start" style="gap: 20px">
                                    <div class="l2r selected_users" style="gap: 10px">


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 mb-4">
                                <span>Notification Title</span>
                                <input class="form-control" type="text" value="<?php echo $email; ?>" id="title">
                                <div class="py-3 l2r justify-content-start" style="gap: 20px">
                                    <span class="font-size-13">Suggested:</span>
                                    <div class="l2r" style="gap: 10px">
                                        <span class="suggestion_item">Happy Monday</span>
                                        <span class="suggestion_item">Feel-good Friday</span>
                                        <span class="suggestion_item">TGIF</span>
                                        <span class="suggestion_item">Testing Tuesday</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 mb-3">
                                <span>Message</span>
                                <textarea class="form-control" id="message" cols="30" rows="10" placeholder="What do you want your notification to say?"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light toSectionTwo blue">Add</button>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- end main content-->
<?php
include('Commons/footer.php');
?>
<script src="JS/Profile.js"></script>
<script src="../assets/js/places.js"></script>
<script>
    const FROM = '<?php echo $_REQUEST["From"] ?>';

    $(document).ready(function() {

        let SELECTED_USERS = []

        $('.suggestion_item').on('click', function() {
            $('#title').val($(this).text())
        })

        $('.check_box_holder .se_status').on('click', function() {

            $(this).siblings().removeClass('active')
            $(this).addClass('active')

            if ($(this).text()?.includes('Custom')) {
                $('.select_users_col').removeClass('d-none')
            } else {
                $('.select_users_col').addClass('d-none')
            }
        })

        $('.dropdown_item').on('click', function() {
            $(this).toggleClass('active')
            appendSelectedUsers()
        })

        $('.close_search')
        .on('click', function() {
            $('.dropdown_list').addClass('d-none')
            $('.close_search').addClass('d-none')
            $('.user_search').val('')
            $('.dropdown_item').removeClass('d-none')
        })

        $('.user_search')
            .on('click', function() {
                $('.dropdown_list').removeClass('d-none')
                $('.close_search').removeClass('d-none')
            })
            .on('keyup', function() {

                const searchValue = $(this).val()?.toLowerCase()

                if (searchValue === '') {
                    $('.dropdown_item').removeClass('d-none')
                    return
                }

                $('.dropdown_item').each(function() {

                    let thisUser = $(this),
                        thisUserName = thisUser.text()?.toLowerCase()

                    if (thisUserName?.includes(searchValue) || searchValue?.includes(thisUserName)) {
                        thisUser.removeClass('d-none')
                    } else {
                        thisUser.addClass('d-none')
                    }

                })
            })

        function appendSelectedUsers() {

            let result = ''

            SELECTED_USERS = []

            $('.dropdown_item.active').each(function() {

                let thisUser = $(this),
                    thisUserName = thisUser.text()
                SELECTED_USERS.push(thisUser.attr('id'))
                result += `<span class="selected_user_item l2r"><i class="bx bx-x mr-2"></i>${thisUserName}</span>`
            })
            
            $('.selected_users').html(result)

            $('.selected_user_item i').off('click').on('click', function(){
                $('.dropdown_item[data-name="'+$(this).parent().text()+'"]').removeClass('active')
                appendSelectedUsers()
            })

        }

        let section = 1

        let type = '',
            send_to = '',
            users = '',
            title = '',
            message = ''

        $('.back_to_chatlist').on('click', function() {
            window.location.href = FROM
        })

        $('.S-' + FROM).addClass('mm-active').find('a').addClass('active')

        $('.toSectionTwo').on('click', function() {
            type = $('#type').val()
            send_to = $('.se_status.active').text().includes('Custom') ? 'Custom' : 'All Users'
            users = send_to === 'All Users' ? 'All' : JSON.stringify(SELECTED_USERS)
            title = $('#title').val()
            message = $('#message').val()

            if (
                type == '' || !type ||
                send_to == '' || !send_to ||
                users == '' || !users ||
                title == '' || !title ||
                message == '' || !message
            ) {
                Swal.fire({
                    title: 'Please provide all details',
                    type: 'error'
                })
                return
            }

            doSendNotification()

        })


        function doSendNotification() {

            const formData = {
                type: type,
                send_to: send_to,
                users: users,
                title: title,
                message: message
            }

            $.ajax({
                url: './API/api_send_notification.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.startsWith('1')) {
                        Swal.fire({
                                title: 'Notification Successfully',
                                type: 'success'
                            })
                            .then(() => {
                                window.location.reload()
                            })
                    } else {
                        console.log(data)
                        Swal.fire({
                            title: 'Failed to send notification',
                            html: '<sub>' + data + '</sub>',
                            type: 'error'
                        })
                    }
                },
                fail: function(data) {
                    console.log(data)
                    Swal.fire({
                        title: 'Failed to send notification',
                        type: 'error'
                    })
                },
                error: function(data) {
                    console.log(data)
                    Swal.fire({
                        title: 'Failed to send notification',
                        type: 'error'
                    })
                }
            })
        }

    })
</script>


</body>

</html>
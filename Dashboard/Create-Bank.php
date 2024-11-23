<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Create Hospital";
include('Commons/header.php');
include('../STATIC_API/Config.php');
if(!isset($_SESSION["superadmin"])){
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
    <span class="section_title mb-3">Add Bank Account</span>

    <div class="tab_container PersonalInformation" style="display: block;">
        <div class="edit_section mt-4">

            <div class="col-12">

                <div class="card">
                    <div class="card-body w-100">
                        <div class="row mb-2 w-100">
                            <div class="col-sm-12 col-lg-12 mb-3">
                                <span>Bank Name</span>
                                <input class="form-control" type="text" id="bank">
                            </div>
                            <div class="col-sm-12 col-lg-12 mb-3">
                                <span>Account Name</span>
                                <input class="form-control" type="text" id="account">
                            </div>
                            <div class="col-sm-12 col-lg-12 mb-3">
                                <span>Account Number</span>
                                <input class="form-control" type="number" id="number" maxlength="10">
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
$conn->close();
include('Commons/footer.php');
?>
<script src="JS/Profile.js"></script>
<script src="../assets/js/places.js"></script>
<script>

    const FROM = '<?php echo $_REQUEST["From"]?>';

    $(document).ready(function() {

        let section = 1

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

        $('.S-'+FROM).addClass('mm-active').find('a').addClass('active')

        $('.toSectionTwo').on('click', function() {
            bank = $('#bank').val()
            account = $('#account').val()
            number = $('#number').val()

            if (
                bank == '' || !bank ||
                account == '' || !account ||
                number == '' || !number
            ) {
                Swal.fire({
                    title: 'Please provide all details',
                    type: 'error'
                })
                return
            }
            
            doCreate()

        })

    
        function doCreate() {

            const formData = {
                bank: bank,
                account: account,
                number: number,
            }

            $.ajax({
                url: './API/api_create_bank.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.startsWith('1')) {
                        Swal.fire({
                                title: 'Bank Account Added Successfully',
                                type: 'success'
                            })
                            .then(() => {
                                window.location.href = FROM
                            })
                    } else {
                        console.log(data)
                        Swal.fire({
                            title: 'Failed to add Bank Account',
                            html: '<sub>' + data + '</sub>',
                            type: 'error'
                        })
                    }
                },
                fail: function(data) {
                    console.log(data)
                    Swal.fire({
                        title: 'Failed to add Bank Account',
                        type: 'error'
                    })
                },
                error: function(data) {
                    console.log(data)
                    Swal.fire({
                        title: 'Failed to add Bank Account',
                        type: 'error'
                    })
                }
            })
        }

    })
</script>


</body>

</html>
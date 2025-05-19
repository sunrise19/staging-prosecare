<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Create Patient";
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


<div class="main-content p-5">

    <i class="bx bx-left-arrow-alt back_to_chatlist mb-3" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>
    <span class="section_title mb-3">Add New Patient</span>

    <div class="tab_container PersonalInformation" style="display: block;">
        <div class="edit_section mt-4">

            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Step 1 of 3: Personal Information</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>First Name</span>
                                <input class="form-control" type="text" value="<?php echo $name; ?>" id="name">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Last Name</span>
                                <input class="form-control" type="text" value="<?php echo $name_l; ?>" id="name_l">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Email Address</span>
                                <input class="form-control" type="text" value="<?php echo $email; ?>" id="email">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Phone Number</span>
                                <input class="form-control" type="tel" value="<?php echo $phone; ?>" id="phone">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Hospital</span>
                                <select id="hospital" class="sweetselect" data-default="<?php echo $hospital; ?>">
                                    <option disabled selected value="">Select an option</option>
                                    <?php
                                    $sql = "SELECT * FROM hospitals";
                                    if (isset($_SESSION["hospital"])) {
                                        $sql .= " WHERE hospital_id=" . $_SESSION["hospital_id"];
                                    }
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['hospital_id'] . '">' . $row['name'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Age</span>
                                <input class="form-control" type="number" value="<?php echo $relationship; ?>" id="age">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-4">
                                <span>Gender</span>
                                <select id="gender" class="sweetselect" data-default="<?php echo $gender; ?>">
                                    <option disabled selected value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Country</span>
                                <select id="country" class="sweetselect" data-default="<?php echo $country; ?>">
                                    <option disabled selected value=""></option>
                                    <option value="Nigeria">Nigeria</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-4">
                                <span>State of origin</span>
                                <select id="state" class="sweetselect" data-default="<?php echo $gender; ?>">
                                    <option disabled selected value=""></option>
                                    <option value="Abia">Abia</option>
                                    <option value="Adamawa">Adamawa</option>
                                    <option value="Akwa Ibom">Akwa Ibom</option>
                                    <option value="Anambra">Anambra</option>
                                    <option value="Bauchi">Bauchi</option>
                                    <option value="Bayelsa">Bayelsa</option>
                                    <option value="Benue">Benue</option>
                                    <option value="Borno">Borno</option>
                                    <option value="Cross River">Cross River</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Ebonyi">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="FCT">FCT</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="Kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nasarawa">Nasarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamfara</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Tribe</span>
                                <input class="form-control" type="text" id="tribe">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>LGA of origin</span>
                                <select id="lga" class="sweetselect" data-default="">
                                    <option disabled selected value=""></option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Level of Eduation</span>
                                <select id="education" class="sweetselect" data-default="<?php echo $country; ?>">
                                    <option disabled selected value=""></option>
                                    <option value="Primary">Primary</option>
                                    <option value="Secondary">Secondary</option>
                                    <option value="Tertiary">Tertiary</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Income Level</span>
                                <select id="income" class="sweetselect" data-default="<?php echo $country; ?>">
                                    <option disabled selected value=""></option>
                                    <option value="<200000">Less than ₦200,000</option>
                                    <option value="<200000-500000">₦200,000 - ₦500,000</option>
                                    <option value="<500000-1000000">₦500,000 - ₦1,000,000</option>
                                    <option value=">1000000">Above ₦1,000,000</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Religion</span>
                                <select id="religion" class="sweetselect" data-default="<?php echo $country; ?>">
                                    <option disabled selected value=""></option>
                                    <option value="Christianity">Christianity</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Traditional">Traditional</option>
                                    <option value="other">Others</option>
                                </select>
                                <input style="flex: 3.3; display:none" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="ereligion" placeholder="Enter Religion">
                                <style>
                                    #ereligion,
                                    #erelationship,
                                    #edevice {
                                        border-radius: 30px !important;
                                        position: absolute;
                                        right: 20px;
                                        top: 29px;
                                        width: 62%;
                                        padding: 8px 18px;
                                    }
                                </style>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Device Type</span>
                                <select id="device" class="sweetselect">
                                    <option disabled selected value=""></option>
                                    <option value="Smartphone">Smartphone</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Computer">Computer</option>
                                    <option value="other">Others</option>
                                </select>
                                <input style="flex: 3.3; display:none" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="edevice" placeholder="Enter Type of Device">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Relationship with caregiver</span>
                                <select id="relationship" class="sweetselect">
                                    <option disabled selected value=""></option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Child">Child</option>
                                    <option value="Sibling">Sibling</option>
                                    <option value="Parents">Parents</option>
                                    <option value="other">Others</option>
                                </select>
                                <input style="flex: 3.3; display:none" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="erelationship" placeholder="Enter Relationship With Caregiver">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Side Effects Reporter</span>
                                <select id="reporter" class="sweetselect">
                                    <option disabled selected value=""></option>
                                    <option value="Self">Self</option>
                                    <option value="Caregiver">Caregiver</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Address</span>
                                <input class="form-control" type="text" id="address">
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light toSectionTwo blue">Next</button>
                </div>
            </div>

        </div>
    </div>


    <div class="tab_container NextofKinInformation">
        <div class="edit_section mt-4">

            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Step 2 of 3: Next of Kin Information</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>First Name</span>
                                <input class="form-control" type="text" value="<?php echo $name_n; ?>" id="name_n">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Last Name</span>
                                <input class="form-control" type="text" value="<?php echo $name_n_l; ?>" id="name_n_l">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Email Address</span>
                                <input class="form-control" type="text" value="<?php echo $email_n; ?>" id="email_n">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Phone Number</span>
                                <input class="form-control" type="tel" value="<?php echo $phone_n; ?>" id="phone_n">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-4">
                                <span>Gender</span>
                                <select id="gender_n" class="sweetselect" data-default="<?php echo $gender_n; ?>">
                                    <option disabled selected value="">Select a Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Relationship</span>
                                <input class="form-control" type="tel" value="<?php echo $relationship_n; ?>" id="relationship_n">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Address</span>
                                <input class="form-control" type="text" value="<?php echo $address_n; ?>" id="address_n">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Country</span>
                                <select id="country_n" class="sweetselect" data-default="<?php echo $country; ?>">
                                    <option disabled selected value=""></option>
                                    <option value="Nigeria">Nigeria</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="l2r" style="gap: 50px;     justify-content: center;">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mx-0 toSectionThree alt">Skip</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light mx-0 toSectionThree blue">Next</button>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="tab_container Specialization">
        <div class="edit_section mt-4">


            <div class="col-12 mb-4">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Step 3 of 3: Diseases and Characteristics</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Age Diagnosed</span>
                                <input class="form-control" type="text" value="<?php echo $age_when_diagnosed; ?>" id="age_when_diagnosed">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Initial Cancer</span>
                                <input class="form-control" type="tel" value="<?php echo $initial_cancer; ?>" id="initial_cancer">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Histology Type</span>
                                <input class="form-control" type="tel" value="<?php echo $histology; ?>" id="histology">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Cancer Grade</span>
                                <input class="form-control" type="text" value="<?php echo $cancer_grade; ?>" id="cancer_grade">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Cancer Stage</span>
                                <input class="form-control" type="text" value="<?php echo $cancer_stage; ?>" id="cancer_stage">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <span>Comorbidity</span>
                                <input class="form-control" type="text" value="<?php echo $comorbidity; ?>" id="comorbidity">
                            </div>
                        </div>
                    </div>
                    <div class="l2r" style="gap: 50px; justify-content: center;">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mx-0 alt" onclick="window.location.href='Hospital-Home'">Skip</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light mx-0 updatediseasecharactistics blue" data-editing="true">Save Changes</button>
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

    const FROM = '<?php echo $_REQUEST["From"]?>';

    $(document).ready(function() {

        let section = 1

        let name = '',
            name_l = '',
            email = '',
            phone = '',
            hospital = '',
            gender = '',
            age = '',
            state = '',
            country = '',
            tribe = '',
            lga = '',
            education = '',
            income = '',
            religion = '',
            device = '',
            relationship = '',
            reporter = '',
            address = '',

            name_n = '',
            name_n_l = '',
            email_n = '',
            phone_n = '',
            gender_n = '',
            relationship_n = '',
            address_n = '',
            country_n = ''

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
            name = $('#name').val()
            name_l = $('#name_l').val()
            email = $('#email').val()
            phone = $('#phone').val()
            hospital = $('#hospital').val()
            gender = $('#gender').val()
            age = $('#age').val()
            state = $('#state').val()
            country = $('#country').val()
            tribe = $('#tribe').val()
            lga = $('#lga').val()
            education = $('#education').val()
            income = $('#income').val()
            religion = $('#religion').val() == 'other' ? $('#ereligion').val() : $('#religion').val()
            device = $('#device').val() == 'other' ? $('#edevice').val() : $('#device').val()
            relationship = $('#relationship').val() == 'other' ? $('#erelationship').val() : $('#relationship').val()
            reporter = $('#reporter').val()
            address = $('#address').val()

            if (
                name == '' || !name ||
                name_l == '' || !name_l ||
                email == '' || !email ||
                phone == '' || !phone ||
                hospital == '' || !hospital ||
                gender == '' || !gender ||
                age == '' || !age ||
                state == '' || !state ||
                country == '' || !country ||
                tribe == '' || !tribe ||
                lga == '' || !lga ||
                education == '' || !education ||
                income == '' || !income ||
                religion == '' || !religion ||
                device == '' || !device ||
                relationship == '' || !relationship ||
                reporter == '' || !reporter ||
                address == '' || !address
            ) {
                Swal.fire({
                    title: 'Please provide all details',
                    type: 'error'
                })
                return
            }

            section = 2
            $('.tab_container').hide()
            $('.tab_container.NextofKinInformation').show()
        })

        $('.toSectionThree').on('click', function() {

            if ($(this).hasClass('alt')) {
                doCreatePatient()
                return
            }

            name_n = $('#name_n').val()
            name_n_l = $('#name_n_l').val()
            email_n = $('#email_n').val()
            phone_n = $('#phone_n').val()
            gender_n = $('#gender_n').val()
            relationship_n = $('#relationship_n').val()
            address_n = $('#address_n').val()
            country_n = $('#country_n').val()

            if (
                name_n == '' || !name_n ||
                name_n_l == '' || !name_n_l ||
                email_n == '' || !email_n ||
                phone_n == '' || !phone_n ||
                gender_n == '' || !gender_n ||
                relationship_n == '' || !relationship_n ||
                address_n == '' || !address_n ||
                country_n == '' || !country_n
            ) {
                Swal.fire({
                    title: 'Please provide all details',
                    type: 'error'
                })
                return
            }

            doCreatePatient()

        })

        function doCreatePatient() {

            const formData = {
                name: name,
                name_l: name_l,
                email: email,
                phone: phone,
                hospital: hospital,
                gender: gender,
                age: age,
                state: state,
                country: country,
                tribe: tribe,
                lga: lga,
                education: education,
                income: income,
                religion: religion,
                device: device,
                relationship: relationship,
                reporter: reporter,
                address: address,
                name_n: name_n,
                name_n_l: name_n_l,
                email_n: email_n,
                phone_n: phone_n,
                gender_n: gender_n,
                relationship_n: relationship_n,
                address_n: address_n,
                country_n: country_n
            }

            $.ajax({
                url: './API/api_create_patient.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.startsWith('1')) {
                        $('.updatediseasecharactistics').attr('data-patient', data.substring(1))
                        Swal.fire({
                                title: 'Patient Added Successfully',
                                type: 'success'
                            })
                            .then(() => {
                                section = 3
                                $('.tab_container').hide()
                                $('.tab_container.Specialization').show()
                            })
                    } else {
                        console.log(data)
                        Swal.fire({
                            title: 'Failed to create Patient',
                            html: '<sub>' + data + '</sub>',
                            type: 'error'
                        })
                    }
                },
                fail: function(data) {
                    console.log(data)
                    Swal.fire({
                        title: 'Failed to create Patient',
                        type: 'error'
                    })
                },
                error: function(data) {
                    console.log(data)
                    Swal.fire({
                        title: 'Failed to create Patient',
                        type: 'error'
                    })
                }
            })
        }

    })
</script>


</body>

</html>
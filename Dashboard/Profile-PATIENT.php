<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Profile";
include('Commons/header.php');
?>

<style>
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

    .multi_select_dropdown ul li {
        list-style-type: none;
    }

    .multi_select_dropdown ul {
        padding-top: 12px
    }
</style>

<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Profile</h2>
                        <div class="css-1vakbk4 l2r" style=" background: #f3eaf3; border-radius: 50px; padding-right: 20px; font-weight: 500; color: #8D2D92; ">
                            <img src="./STARPIPE/starpipe_files/user.svg" class="chakra-image css-7d3f7d cursor-pointer">
                            <span class="font-size-16"><?php echo ucfirst($_SESSION['type']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- <button style="position: absolute;right: 2em;padding: 12px 45px !important;z-index: 1;margin-top: -9px;" class="btn-danger btn-lg do-logout">LOG OUT</button> -->

            <div class="row d-none">
                <div class="col-12">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Profile / Settings</h4>
                    </div>

                    <div class="card overflow-hidden profile_card">


                        <?php

                        include('../STATIC_API/Config.php');

                        $user_id = $_SESSION["id"];

                        $sqlUser = "SELECT * FROM patients WHERE user_id='$user_id'";
                        $resultUser = $conn->query($sqlUser);

                        if ($resultUser->num_rows > 0) {
                            while ($rowUser = $resultUser->fetch_assoc()) {
                                $fname = $rowUser["first_name"];
                                $lname = $rowUser["last_name"];
                                $cancer = $rowUser["cancer"];
                                $code = $rowUser["code"];
                                $phone = $rowUser["phone"];
                                $street = $rowUser["street"];
                                $lga = $rowUser["lga"];
                                $state = $rowUser["state"];
                                $country = $rowUser["country"];
                                $income = $rowUser["income"];
                                $device = $rowUser["device"];
                                $religion = $rowUser["religion"];
                                $gender = $rowUser["gender"];
                                $marital_status = $rowUser["marital_status"];
                                $day = $rowUser["day"];
                                $month = $rowUser["month"];
                                $year = $rowUser["year"];
                                $pin = $rowUser["pin"];
                                $patient_id = $rowUser["patient_id"];
                                $reporter = $rowUser["reporter"];
                                $relationship = $rowUser["relationship"];
                                $managing_team = $rowUser["managing_team"];
                                $age_when_diagnosed = $rowUser["age_when_diagnosed"];
                                $initial_cancer = $rowUser["initial_cancer"];
                                $histology = $rowUser["histology"];
                                $cancer_grade = $rowUser["cancer_grade"];
                                $cancer_stage = $rowUser["cancer_stage"];
                                $comorbidity = $rowUser["comorbidity"];
                                $height = $rowUser["height"];
                                $weight = $rowUser["weight"];
                                $bmi = $rowUser["bmi"];
                                $waist = $rowUser["waist"];
                                $head = $rowUser["head"];
                                $age = $rowUser["age"];
                                $education = $rowUser["education"];
                                $ethnicity = $rowUser["ethnicity"];
                                $hospital_id = $rowUser["hospital_id"];
                            }
                        }

                        $sqlNextOfKin = "SELECT * FROM next_of_kin WHERE user_id='$user_id'";
                        $resultNextOfKin = $conn->query($sqlNextOfKin);

                        if ($resultNextOfKin->num_rows > 0) {
                            while ($rowNextOfKin = $resultNextOfKin->fetch_assoc()) {
                                $name_n = $rowNextOfKin["name"];
                                $name_n_l = $rowNextOfKin["last_name"];
                                $email_n = $rowNextOfKin["email"];
                                $code_n = $rowNextOfKin["code"];
                                $phone_n = $rowNextOfKin["phone"];
                                $gender_n = $rowNextOfKin["gender"];
                                $relationship_n = $rowNextOfKin["relationship"];
                                $address_n = $rowNextOfKin["address"];
                                $country_n = $rowNextOfKin["country"];
                            }
                        }

                        ?>

                        <div class="card-body p-4 pt-1">
                            <div class="row">
                                <div class="col-lg-2 col-sm-3">
                                    <div class="avatar-md profile-user-wid pt-4">
                                        <img src="IMG/<?php echo $_SESSION["photo"]; ?>" alt="" class="img-thumbnail rounded-circle">
                                    </div>
                                </div>

                                <div class="col-sm-9">
                                    <div class="pt-4">
                                        <div class="row">
                                            <div class="col-12 mt-4">
                                                <h5 class="font-size-18 text-truncate" style="display: inline"><?php echo $_SESSION["name"]; ?></h5>
                                                <a class="btn btn-primary waves-effect waves-light btn-sm ep">Edit Profile</a>
                                                <br>
                                                <span class="badge badge-pill badge-soft-warning font-size-13 ut mt-3"><?php echo strtoupper($cancer); ?> CANCER</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" style="overflow-x: hidden;">

                                <div class="row" style="justify-content: space-between">
                                    <div class="col-md-5 col-sm-12">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="grp" style="margin-top: 0;">Bio</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="subgroup">Personal Information</th>
                                                    <!-- <td>&nbsp;</td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">First Name</th>
                                                    <td><?php echo $fname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Gender</th>
                                                    <td><?php echo $gender; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Age</th>
                                                    <td><?php echo $age; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tribe</th>
                                                    <td><?php echo $ethnicity; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Income Level</th>
                                                    <td>
                                                        <?php
                                                        if ($income == '<200000') {
                                                            echo 'Less than ₦200,000';
                                                        } else if ($income == '<200000-500000') {
                                                            echo '₦200,000 - ₦500,000';
                                                        } else if ($income == '<500000-1000000') {
                                                            echo '₦500,000 - ₦1,000,000';
                                                        } else if ($income == '>1000000') {
                                                            echo 'Above ₦1,000,000';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="subgroup">Contact</th>
                                                    <!-- <td>&nbsp;</td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email Address</th>
                                                    <td><?php echo $_SESSION["email"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Country</th>
                                                    <td><?php echo $country; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Town/City</th>
                                                    <td><?php echo $lga; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="subgroup">Next of Kin</th>
                                                    <!-- <td>&nbsp;</td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Name</th>
                                                    <td><?php echo  $name_n; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address</th>
                                                    <td><?php echo  $address_n; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="subgroup">Caregiver</th>
                                                    <!-- <td>&nbsp;</td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cancer Type</th>
                                                    <td><?php echo $cancer; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Side-Effects Reporter</th>
                                                    <td><?php echo $reporter; ?></td>
                                                </tr>


                                                <!-- <tr>
                                                        <th scope="row">Managing Team</th>
                                                        <td>Team <?php echo $managing_team; ?></td>
                                                    </tr> -->

                                                <tr>
                                                    <th scope="row" class="grp">Disease Characteristics</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Age When Diagnosed</th>
                                                    <td><?php echo $age_when_diagnosed; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Initial Cancer</th>
                                                    <td><?php echo $initial_cancer; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Histology Type</th>
                                                    <td><?php echo $histology; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="grp">Anthropometry</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Height</th>
                                                    <td><?php echo $height; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Weight</th>
                                                    <td><?php echo $weight; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">BMI</th>
                                                    <td><?php echo $bmi; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="grp">Laboratory Test</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <img class="tiny_image" src="IMG/<?php echo $_SESSION["signature"] ?>" style="pointer-events: all !important;width: auto;height: auto;max-height: 1000px;max-width: 100%;object-fit: contain;-webkit-user-drag: none;">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="grp">Consent Form</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <img class="tiny_image" src="IMG/<?php echo $_SESSION["consent_form"] ?>" style="pointer-events: all !important;width: auto;height: auto;max-height: 1000px;max-width: 100%;object-fit: contain;-webkit-user-drag: none;">
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-5 col-sm-12">
                                        <table class="table table-wrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="grp" style="margin-top: 0;">&nbsp;</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="subgroup">&nbsp;</th>
                                                    <!-- <td>&nbsp;</td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Last Name</th>
                                                    <td><?php echo $lname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Birthday</th>
                                                    <td><?php echo $day . ' ' . $month . ', ' . $year; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Level of Education</th>
                                                    <td><?php echo $education; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Religion</th>
                                                    <td><?php echo $religion; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">PIN</th>
                                                    <td><?php echo $pin; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="subgroup">&nbsp;</th>
                                                    <!-- <td>&nbsp;</td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Phone Number</th>
                                                    <td><?php echo $code . ' ' . $phone; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">State</th>
                                                    <td><?php echo $state; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Phone Number</th>
                                                    <td><?php echo $code_n . ' ' . $phone_n; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="subgroup">&nbsp;</th>
                                                    <!-- <td>&nbsp;</td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Type of device used</th>
                                                    <td><?php echo $device; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Relationship With Caregiver</th>
                                                    <td><?php echo $relationship; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="grp e">&nbsp;</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cancer Grade</th>
                                                    <td><?php echo $cancer_grade; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cancer Stage</th>
                                                    <td><?php echo $cancer_stage; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Comorbidity</th>
                                                    <td><?php echo $comorbidity; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="grp e">&nbsp;</th>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <th scope="row">Waist</th>
                                                    <td><?php echo $waist; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Head</th>
                                                    <td><?php echo $head; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="l2r mt-3" style="align-items: start; gap: 30px; ">

                <div class="t2b  as_sheet vertical_tabs">
                    <div class="l2r vt_item active" data-tab="ProfileInformation">
                        <i class="bx bx-user"></i>
                        Profile Information
                    </div>
                    <div class="l2r vt_item" data-tab="ResetPassword">
                        <i class="bx bx-lock"></i>
                        Reset Password
                    </div>
                    <div class="l2r vt_item" data-tab="MyHealthReport">
                        <i class="bx bx-file"></i>
                        My Health Report
                    </div>
                </div>

                <div class="t2b vertical_section ProfileInformation w-100" style="align-items: start; display: block">
                    <div class="l2r" style="gap: 70px; justify-content: start;">
                        <a class="tab_item active" data-tab="ProfileDetails">Profile Details</a>
                        <a class="tab_item" data-tab="NextofKinInformation">Next of Kin</a>
                        <a class="tab_item" data-tab="DiseaseCharacteristics">Disease Characteristics</a>
                        <a class="tab_item" data-tab="Anthropometry">Anthropometry</a>
                    </div>

                    <div class="tab_container ProfileDetails" style="display: block">
                        <div class="row edit_section mt-4">

                            <div class="col-sm-12 col-lg-12 mb-4" style="max-width: unset; flex: unset;">

                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Personal Information</h4>
                                </div>

                                <div class="card">
                                    <div class="card-body" style="text-align: center;">
                                        <!-- <span class="np">Current Photo</span> -->
                                        <!-- <br> -->
                                        <!-- <br> -->
                                        <form style="max-width: 200px; margin: 0 auto">
                                            <img class="tiny_image" src="IMG/<?php echo $_SESSION["photo"] ?>">
                                            <input name="file" type="file" multiple="multiple" accept="image/*" style="display: none" class="photo_input">
                                            <button class="btn btn-primary waves-effect waves-light upload-file mt-4" id="update_photo" data-type="photo">Update Photo</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <!-- <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 font-size-18">Profile</h4>
                                    </div> -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">

                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>First Name</span>
                                                <input class="form-control" type="text" value="<?php echo $fname; ?>" id="fname">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Last Name</span>
                                                <input class="form-control" type="text" value="<?php echo $lname; ?>" id="lname">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-4">
                                                <span>Gender</span>
                                                <select id="gender" class="sweetselect" data-default="<?php echo $gender; ?>">
                                                    <option disabled selected value="">Select a Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Age</span>
                                                <input class="form-control" type="text" value="<?php echo $age; ?>" id="age">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Country Code</span>
                                                <input class="form-control" type="tel" value="<?php echo $code; ?>" id="code">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Phone Number</span>
                                                <input class="form-control" type="tel" value="<?php echo $phone; ?>" id="phone">
                                            </div>
                                            <div class="col-sm-12 col-lg-12 mb-3">
                                                <span>Email</span>
                                                <input class="form-control" type="email" value="<?php echo $_SESSION["email"]; ?>" id="email">
                                            </div>
                                            <div class="col-sm-12 col-lg-4 mb-3">
                                                <span>Day of Birth</span>
                                                <input class="form-control" type="number" value="<?php echo $day; ?>" id="day">
                                            </div>
                                            <div class="col-sm-12 col-lg-4 mb-4">
                                                <span>Month of Birth</span>
                                                <select id="month" class="sweetselect" data-default="<?php echo $month; ?>">
                                                    <option month selected value="">Select Month of Birth</option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-4 mb-3">
                                                <span>Year of Birth</span>
                                                <input class="form-control" type="number" value="<?php echo $year; ?>" id="year">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Country</span>
                                                <input class="form-control" type="text" value="<?php echo $country; ?>" id="country">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>State</span>
                                                <input class="form-control" type="text" value="<?php echo $state; ?>" id="state">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>L.G.A</span>
                                                <input class="form-control" type="text" value="<?php echo $lga; ?>" id="lga">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Tribe</span>
                                                <input class="form-control" type="text" value="<?php echo $ethnicity; ?>" id="ethnicity">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-4">
                                                <span>Income Level</span>
                                                <select id="income" class="sweetselect" data-default="<?php echo $income; ?>">
                                                    <option disabled selected value="">Select an option</option>
                                                    <option value="<200000">Less than ₦200,000</option>
                                                    <option value="<200000-500000">₦200,000 - ₦500,000</option>
                                                    <option value="<500000-1000000">₦500,000 - ₦1,000,000</option>
                                                    <option value=">1000000">Above ₦1,000,000</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-4">
                                                <span>Level of Education</span>
                                                <select id="education" class="sweetselect" data-default="<?php echo $education; ?>">
                                                    <option disabled selected value="">Select an option</option>
                                                    <option value="Uneducated">Uneducated</option>
                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Tertiary">Tertiary</option>
                                                    <option value="other">Others</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-4">
                                                <span>Type of Device Used</span>
                                                <select id="device" class="sweetselect" data-default="<?php echo $device; ?>">
                                                    <option disabled selected value="">Select an option</option>
                                                    <option value="Smartphone">Smartphone</option>
                                                    <option value="Tablet">Tablet</option>
                                                    <option value="Computer">Computer</option>
                                                    <option value="other">Others</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Religion</span>
                                                <input class="form-control" type="text" value="<?php echo $religion; ?>" id="religion">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-4">
                                                <span>Side Effects Reporter</span>
                                                <select id="reporter" class="sweetselect" data-default="<?php echo $reporter; ?>">
                                                    <option disabled selected value="">Select an option</option>
                                                    <option value="Self">Self</option>
                                                    <option value="Caregiver">Caregiver</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-4">
                                                <span>Relationship With Caregiver</span>
                                                <select id="relationship" class="sweetselect" data-default="<?php echo $relationship; ?>">
                                                    <option disabled selected value="">Select an option</option>
                                                    <option value="Self">Self</option>
                                                    <option value="Spouse">Spouse</option>
                                                    <option value="Child">Child</option>
                                                    <option value="Sibling">Sibling</option>
                                                    <option value="Parents">Parents</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-4">
                                                <span>Hospital</span>
                                                <select id="hospital" class="sweetselect" data-default="<?php echo $hospital_id; ?>">
                                                    <option disabled selected value="">Select an option</option>

                                                    <?php
                                                    $sql = "SELECT * FROM hospitals";
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
                                                <span>PIN</span>
                                                <input class="form-control" type="text" value="<?php echo getInitials(str_replace("and", "", $cancer)) . $user_id; ?>" id="pin" readonly>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light updateprofile_patient blue">Update Profile</button>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="tab_container NextofKinInformation">
                        <div class="row edit_section mt-4">

                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Next Of Kin Information</h4>
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
                                            <!-- <div class="col-sm-12 col-lg-3 mb-3">
                                                    <span>Country Code</span>
                                                    <input class="form-control" type="tel" value="<?php echo $code_n; ?>" id="code_n">
                                                </div> -->
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
                                                <input class="form-control" type="text" value="<?php echo $country_n; ?>" id="country_n">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light updatenextofkin blue">Update Next Of Kin</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab_container DiseaseCharacteristics">
                        <div class="row edit_section mt-4">

                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Disease Characteristics</h4>
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
                                                <span>Cancer</span>
                                                <input class="form-control" type="text" value="<?php echo $cancer; ?>" id="cancer">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Comorbidity</span>
                                                <select class="sweetselect sfx_select" id="comorbidity-dropdown">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="No">No</option>
                                                    <option value="Yes">Yes</option>
                                                </select>

                                                <div class="multi_select_dropdown">
                                                    <input class="form-control" id='multi-select-input' type="text" value="<?php /*echo $name_n;*/ echo $comorbidity ?>">
                                                    <ul class="multi_select_list">
                                                        <li><label><input type="checkbox" value="Hypertension"> Hypertension</label></li>
                                                        <li><label><input type="checkbox" value="Diabetes">Diabetes</label></li>
                                                        <li><label><input type="checkbox" value="Depression">Depression</label></li>
                                                        <li><label><input type="checkbox" value="RVD+"> RVD+ </label></li>
                                                        <li><label><input type="checkbox" value="Asthma">Asthma</label></li>
                                                        <li><label><input type="checkbox" value="Heart Disease">Heart Disease</label></li>
                                                        <li><label><input type="checkbox" value="HBSS">HBSS</label></li>
                                                        <li><label><input type="checkbox" value="Dyspepsia"> Dyspepsia</label></li>
                                                        <li><label><input type="checkbox" value="Cataract">Cataract</label></li>
                                                        <li><label><input type="checkbox" value="Ulcer">Ulcer</label></li>
                                                        <li><label><input type="checkbox" value="Hyperthyroidism"> Hyperthyroidism </label></li>
                                                        <li><label><input type="checkbox" value="Hepatitis C">Hepatitis C</label></li>
                                                        <li><label><input type="checkbox" value="Osteoarthritis">Osteoarthritis</label></li>
                                                        <li><label><input type="checkbox" value="Chronic Kidney Disease">Chronic Kidney Disease</label></li>
                                                        <li><label><input type="checkbox" value="Others">Others</label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light updatediseasecharactistics blue">Update Disease Characteristics</button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="tab_container Anthropometry">
                        <div class="row edit_section mt-4">


                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Anthropometry</h4>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Height (m)</span>
                                                <input class="form-control" type="text" value="<?php echo $height; ?>" id="height">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Weight (kg)</span>
                                                <input class="form-control" type="tel" value="<?php echo $weight; ?>" id="weight">
                                            </div>
                                            <div class="col-sm-12 col-lg- mb-3">
                                                <span>BMI (Body Mass Index)</span>
                                                <input class="form-control" type="tel" value="<?php echo $bmi; ?>" id="bmi">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Waist Circumference (cm)</span>
                                                <input class="form-control" type="text" value="<?php echo $waist; ?>" id="waist">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 mb-3">
                                                <span>Head Circumference (cm)</span>
                                                <input class="form-control" type="text" value="<?php echo $head; ?>" id="head">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light updatanthropometry blue">Update Anthropometry</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


                <div class="vertical_section MyHealthReport">

                    <div class="row edit_section">

                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Laboratory Test</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <span class="np">Current Laboratory Test Upload</span>
                                    <br>
                                    <br>
                                    <form>
                                        <img class="tiny_image" src="IMG/<?php echo $_SESSION["signature"] ?>" style="pointer-events: all !important;width: auto;height: auto;max-height: 1000px;max-width: 100%;object-fit: contain;-webkit-user-drag: none; border-radius: 12px">
                                        <input name="file" type="file" multiple="multiple" accept="image/*" style="display: none" class="photo_input">
                                        <button class="btn btn-primary waves-effect waves-light upload-file mt-4" id="update_signature" data-type="signature">Update Laboratory Test</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Consent Form</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <span class="np">Current Consent Form Upload</span>
                                    <br>
                                    <br>
                                    <form>
                                        <img class="tiny_image" src="IMG/<?php echo $_SESSION["consent_form"] ?>" style="pointer-events: all !important;width: auto;height: auto;max-height: 1000px;max-width: 100%;object-fit: contain;-webkit-user-drag: none; border-radius: 12px">
                                        <!-- <input name="file" type="file" multiple="multiple" accept="image/*" style="display: none" class="photo_input"> -->
                                        <?php
                                        if ($_SESSION["consent_form"] == 'empty.png') {
                                            //echo '<button class="btn btn-primary waves-effect waves-light upload-file mt-4" id="update_consent" data-type="consent">Update Consent Form</button>';
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="vertical_section ResetPassword w-100">

                    <div class="row edit_section">

                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Reset Password</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-lg-12 mb-3">
                                            <span>Current Password</span>
                                            <input class="form-control" type="password" id="password">
                                        </div>
                                        <div class="col-sm-12 col-lg-12 mb-3">
                                            <span>New Password</span>
                                            <input class="form-control" type="password" id="passworda">
                                        </div>
                                        <div class="col-sm-12 col-lg-12 mb-3">
                                            <span>Confirm New Password</span>
                                            <input class="form-control" type="password" id="passwordb">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light updatepassword blue">Change password</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>



            </div>

            <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <?php include('Commons/footer.php'); ?>

    <script src="JS/Profile.js"></script>


    </body>

    </html>
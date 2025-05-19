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
    .ep{
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
    .ut{
        background: #ff650e52;
        color: #FF650E;
    }

    .avatar-md {
        width: unset;
        height: unset;
    }

    .table td, .table th{
        border: none;
    }

    tr:hover {
        background: none;
    }

    .sweetselect {
        width: 100%;
        padding: 11.05px 8px;
    }

    .edit_section{
        /* display: none; */
    }

    .centralize {
        width: 100%;
        display: block;
        height: 50px;
        text-align: center;
    }


    .table td, .table th {
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

    .table th{
        color: #555;
    }

    .table td {
        font-size: 16px;
    }

    .page-title-box h4{
        text-transform: unset;
        color: #000;
        font-size: 20px !important;
    }

    .card-body{
        padding: 0;
        background: #f9f9f9 !important;
    }
    
    .card{
        background-color: #f9f9f9 !important;
        box-shadow: none !important
    }

    .tiny_image{
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

    .form-control,.sweetselect {
        border: 1px solid #8D2D9233 !important;
        border-radius: 30px;
        padding: 15px 29px;
        height: unset;
        font-size: 14px;
        margin-top: 4px;
    }

    .vertical_section{
        display: none;
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
                        </div>
                    </div>
                </div>
                <!-- end page title -->        

                <div class="row d-none">
                    <div class="col-10">

                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Profile / Settings</h4>
                        </div>

                        <div class="card overflow-hidden profile_card">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="avatar-md profile-user-wid pt-4">
                                            <img src="IMG/<?php echo $_SESSION["photo"]; ?>" alt="" class="img-thumbnail rounded-circle">
                                        </div>
                                    </div>

                                    <?php
                                        
                                        include('../STATIC_API/Config.php');

                                        $user_id = $_SESSION["id"];
                                        $sqlUser = "SELECT * FROM hcp WHERE user_id='$user_id'";
                                        $resultUser = $conn->query($sqlUser);

                                        $code = "";
                                        $phone = "";
                                        $fname = "";
                                        $lname = "";
                                        $hospital_id = "";

                                        if ($resultUser->num_rows > 0) {
                                            while($rowUser = $resultUser->fetch_assoc()) {
                                                $fname = $rowUser["first_name"];
                                                $lname = $rowUser["last_name"];
                                                $code = $rowUser["code"];
                                                $gender = $rowUser["gender"];
                                                $day = $rowUser["day"];
                                                $month = $rowUser["month"];
                                                $year = $rowUser["year"];
                                                $phone = $rowUser["phone"];
                                                $street = $rowUser["street"];
                                                $lga = $rowUser["lga"];
                                                $state = $rowUser["state"];
                                                $country = $rowUser["country"];
                                                $cadre = $rowUser["specialty"];
                                                $hospital = $rowUser["hospital"];
                                                $managing_team = $rowUser["team"];
                                                $folio = $rowUser["folio"];
                                                $practicing_mdcn_file = explode(',', $rowUser["practicing_mdcn_file"]);
                                                $practicing_mdcn_expiry = $rowUser["practicing_mdcn_expiry"];
                                                $mdcn_registration_file = explode(',', $rowUser["mdcn_registration_file"]);
                                                $mdcn_registration_expiry = $rowUser["mdcn_registration_expiry"];
                                                $fellowship_license_file = explode(',', $rowUser["fellowship_license_file"]);
                                                $fellowship_license_expiry = $rowUser["fellowship_license_expiry"];
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

                                    ?>

                                    <div class="col-sm-9">
                                        <div class="pt-4">
                                            <div class="row">
                                                <div class="col-12 mt-4">
                                                    <h5 class="font-size-18 text-truncate" style="display: inline"><?php echo $_SESSION["name"] ; ?></h5>
                                                    <a class="btn btn-primary waves-effect waves-light btn-sm ep">Edit Profile</a>    
                                                    <br>
                                                    <span class="badge badge-pill badge-soft-warning font-size-13 ut mt-3"><?php echo $cadre; ?></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                
                                    
                                    <div class="row">
                                        <div class="col-md-7 col-sm-12">
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
                                                        <td><?php echo $fname ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Gender</th>
                                                        <td><?php echo $gender ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Specialty</th>
                                                        <td><?php echo $cadre ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Folio Number</th>
                                                        <td><?php echo $folio ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="subgroup">Contact</th>
                                                        <!-- <td>&nbsp;</td> -->
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email Address</th>
                                                        <td><?php echo $_SESSION["email"] ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Country</th>
                                                        <td><?php echo $country ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Town/City</th>
                                                        <td><?php echo $lga ; ?></td>
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
                                                        <td><?php echo $lname ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Birthday</th>
                                                        <td><?php echo $day . ' ' . $month . ', ' . $year  ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Hospital</th>
                                                        <td><?php echo $hospital;?></td>
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
                                                        <th scope="row">Phone Number</th>
                                                        <td><?php echo $code . ' ' . $phone ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">State</th>
                                                        <td><?php echo $state ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Country:</th>
                                                        <td><?php echo $country ; ?></td>
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
                    </div>

                    <div class="t2b vertical_section ProfileInformation w-100" style="align-items: start; display: block">
                        <div class="l2r" style="gap: 70px; justify-content: start;">
                            <a class="tab_item active" data-tab="ProfileDetails">Profile Details</a>
                            <a class="tab_item" data-tab="NextofKinInformation">Next of Kin Information</a>
                            <a class="tab_item" data-tab="Specialization">Specialization and License</a>
                        </div>
                        
                        <div class="tab_container ProfileDetails w-100" style="display: block">
                            <div class="edit_section mt-4">
                                
                                <div class="col-sm-12 col-lg-12 mb-4 w-100" style="max-width: unset;width: 240px;flex: unset;">
                                    
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 font-size-18">Photo</h4>
                                    </div>
                                    <div class="card">
                                        <div class="card-body" style="text-align: center;">
                                            <!-- <span class="np">Current Photo</span>
                                            <br>
                                            <br> -->
                                            <form style="max-width: 200px; margin: 0 auto">
                                                <img class="tiny_image" src="IMG/<?php echo $_SESSION["photo"] ?>">
                                                <input name="file" type="file" multiple="multiple" accept="image/*" style="display: none" class="photo_input">
                                                <button class="btn btn-primary waves-effect waves-light upload-file mt-4" id="update_photo" data-type="photo">Update Photo</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-12 mb-4">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 font-size-18">Profile</h4>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
            
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>First Name</span>
                                                    <input class="form-control" type="text" value="<?php echo $fname ; ?>" id="fname">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Last Name</span>
                                                    <input class="form-control" type="text" value="<?php echo $lname ; ?>" id="lname">
                                                </div>
                                                <!-- <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Code</span>
                                                    <input class="form-control" type="tel" value="<?php echo $code ; ?>" id="code">
                                                </div> -->
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Phone Number</span>
                                                    <input class="form-control" type="tel" value="<?php echo $phone ; ?>" id="phone">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Email</span>
                                                    <input class="form-control" type="email" value="<?php echo $_SESSION["email"] ; ?>" id="email">
                                                </div>
                                                <div class="col-sm-12 col-lg-4 mb-3">
                                                    <span>Day of Birth</span>
                                                    <input class="form-control" type="number" value="<?php echo $day ; ?>" id="day">
                                                </div>
                                                <div class="col-sm-12 col-lg-4 mb-4">
                                                    <span>Month of Birth</span>
                                                    <select id="month" class="sweetselect" data-default="<?php echo $month;?>">
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
                                                    <input class="form-control" type="number" value="<?php echo $year ; ?>" id="year">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Gender</span>
                                                    <select id="gender" class="sweetselect" data-default="<?php echo $gender;?>">
                                                        <option disabled selected value="">Select an option</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Town/City</span>
                                                    <input class="form-control" type="text" value="<?php echo $lga ; ?>" id="lga">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>State</span>
                                                    <input class="form-control" type="text" value="<?php echo $state ; ?>" id="state">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Country</span>
                                                    <input class="form-control" type="text" value="<?php echo $country ; ?>" id="country">
                                                </div>
                                                
                                            </div>
            
                                            <button type="submit" class="btn btn-primary waves-effect waves-light updateprofile_hcp blue">Update Profile</button>
            
                                            <!--
                                            <div class="row mt-5">
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Hospital</span>
                                                    <input class="form-control" type="text" value="<?php echo $hospital ; ?>" id="hospital">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light updateprofile_hcp_hospital blue">Update Hospital</button>
                                            -->
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
                                                    <input class="form-control" type="text" value="<?php echo $name_n ; ?>" id="name_n">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Last Name</span>
                                                    <input class="form-control" type="text" value="<?php echo $name_n_l ; ?>" id="name_n_l">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Email Address</span>
                                                    <input class="form-control" type="text" value="<?php echo $email_n ; ?>" id="email_n">
                                                </div>
                                                <!-- <div class="col-sm-12 col-lg-3 mb-3">
                                                    <span>Country Code</span>
                                                    <input class="form-control" type="tel" value="<?php echo $code_n ; ?>" id="code_n">
                                                </div> -->
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Phone Number</span>
                                                    <input class="form-control" type="tel" value="<?php echo $phone_n ; ?>" id="phone_n">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Gender</span>
                                                    <select id="gender_n" class="sweetselect" data-default="<?php echo $gender_n;?>">
                                                        <option disabled selected value="">Select a Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Relationship</span>
                                                    <input class="form-control" type="tel" value="<?php echo $relationship_n ; ?>" id="relationship_n">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Address</span>
                                                    <input class="form-control" type="text" value="<?php echo $address_n ; ?>" id="address_n">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Country</span>
                                                    <input class="form-control" type="text" value="<?php echo $country_n ; ?>" id="country_n">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light updatenextofkin blue">Update Next Of Kin</button>
                                        </div>
                                    </div>
                                </div>
            
                            </div> 
                        </div>

                                
                        <div class="tab_container Specialization w-100">
                            <div class="edit_section mt-4">
                                
                                    
                                <div class="col-12 mb-4">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 font-size-18">Specialization and Licence</h4>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
            
                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Specialization</span>
                                                    <!-- <input class="form-control" type="text" value="<?php echo $cadre ; ?>" id="cadre"> -->
                                                    <select id="cadre" class="sweetselect" data-default="<?php echo $cadre;?>">
                                                        <option disabled selected value="">Select an option</option>
                                                        <option value="Doctor">Doctor</option>
                                                        <option value="Oncologist">Oncologist</option>
                                                        <option value="Physician">Physician</option>
                                                        <option value="Medical Student">Medical Student</option>
                                                        <option value="Medical Officer">Medical Officer</option>
                                                        <option value="House Officer">House Officer</option>
                                                        <option value="Resident">Resident</option>
                                                        <option value="Fellow">Fellow</option>
                                                        <option value="Nurse">Nurse</option>
                                                        <option value="Consultant">Consultant</option>
                                                        <option value="Prof">Prof</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-12 col-lg-6 mb-3">
                                                    <span>Hospital</span>
                                                    <!-- <input class="form-control" type="text" value="<?php echo $hospital ; ?>" id="hospital"> -->
                                                    <select id="hospital" class="sweetselect" data-default="<?php echo $hospital;?>">
                                                        <option disabled selected value="">Select an option</option>
                                                        <?php 
                                                            $sql = "SELECT * FROM hospitals";
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {

                                                                while($row = $result->fetch_assoc()) {
                                                                    echo '<option value="'.$row['hospital_id'].'">'.$row['name'].'</option>';
                                                                }
                                                            }
                                                        
                                                        ?>
                                                    </select>
                                                </div>

                                                <!--
                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Folio Number</span>
                                                    <input class="form-control" type="text" value="<?php echo $folio ; ?>" id="folio">
                                                </div>
                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Managing Team</span>
                                                    <select id="managing_team" class="sweetselect" data-default="<?php echo $managing_team;?>">
                                                        <option disabled selected value="">Select an option</option>
                                                        <option value="A">Team A</option>
                                                        <option value="B">Team B</option>
                                                    </select>
                                                </div>
                                                -->

                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Annual Practicing MDCN License</span>
                                                    <a href="HCP_FILES/<?php echo $practicing_mdcn_file[1]?>" target="_blank">
                                                        <img src="IMG/pdf2.png" alt="" class="pdf_icon <?php echo $practicing_mdcn_file[0] == '' ? 'd-none' : '' ?>">
                                                    </a>
                                                    <input class="form-control file_selector" readonly type="text" value="<?php echo $practicing_mdcn_file[0] ; ?>">
                                                    <input type="file" accept="application/pdf" class="d-none file_selector_input" id="practicing_mdcn_file">
                                                </div>

                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Expiry Date</span>
                                                    <input class="form-control" type="date" value="<?php echo $practicing_mdcn_expiry ; ?>" id="practicing_mdcn_expiry">
                                                </div>

                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>MDCN Certificate of Registration</span>
                                                    <a href="HCP_FILES/<?php echo $mdcn_registration_file[1]?>" target="_blank">
                                                        <img src="IMG/pdf2.png" alt="" class="pdf_icon <?php echo $mdcn_registration_file[0] == '' ? 'd-none' : '' ?>">
                                                    </a>
                                                    <input class="form-control file_selector" readonly type="text" value="<?php echo $mdcn_registration_file[0] ; ?>">
                                                    <input type="file" accept="application/pdf" class="d-none file_selector_input" id="mdcn_registration_file">
                                                </div>

                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Expiry Date</span>
                                                    <input class="form-control" type="date" value="<?php echo $mdcn_registration_expiry ; ?>" id="mdcn_registration_expiry">
                                                </div>

                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Fellowship License</span>
                                                    <a href="HCP_FILES/<?php echo $fellowship_license_file[1]?>" target="_blank">
                                                        <img src="IMG/pdf2.png" alt="" class="pdf_icon <?php echo $fellowship_license_file[0] == '' ? 'd-none' : '' ?>">
                                                    </a>
                                                    <input class="form-control file_selector" readonly type="text" value="<?php echo $fellowship_license_file[0] ; ?>">
                                                    <input type="file" accept="application/pdf" class="d-none file_selector_input" id="fellowship_license_file">
                                                </div>

                                                <div class="col-sm-12 col-lg-6 mb-4">
                                                    <span>Expiry Date</span>
                                                    <input class="form-control" type="date" value="<?php echo $fellowship_license_expiry ; ?>" id="fellowship_license_expiry">
                                                </div>

        
                                            </div>
            
                                            <button type="submit" class="btn btn-primary waves-effect waves-light updatespecialization_hcp blue">Update Profile</button>
            
                                        </div>
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

    
    <?php include('Commons/footer.php');?>

    <script src="JS/Profile.js"></script>


</body>

</html>
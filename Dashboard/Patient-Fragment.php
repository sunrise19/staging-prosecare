<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
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
        background: #f44336;
        border-color: #f44336
    }
    .img-thumbnail {
        padding: 0;
        border-radius: 10px !important;
        width: 107px;
        height: 107px;
        max-width: unset;
        object-fit: cover;
        object-position: center;
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
        display: none;
    }

    .centralize {
        width: 100%;
        display: block;
        height: 50px;
        text-align: center;
    }

    #page-topbar,.vertical-menu{
        display: none;
    }

    .main-content, .page-content,.container-fluid{
        margin: 0;
        padding: 0
    }

    .table-responsive{
        overflow-x: hidden;
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

    tr:hover{
        border-radius: 0
    }

</style>

    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">
 
                <div class="row">
                    <div class="col-12">
                        
                                    <?php
                                        
                                        include('../STATIC_API/Config.php');
                                        
                                        $user_id = $_REQUEST["id"];
                            
                                        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $photo = $row["photo"];
                                                $email = $row["email"];
                                                $lab = $row["signature"];
                                            }
                                        }

                                        $sqlUser = "SELECT * FROM patients WHERE user_id='$user_id'";
                                        $resultUser = $conn->query($sqlUser);

                                        if ($resultUser->num_rows > 0) {
                                            while($rowUser = $resultUser->fetch_assoc()) {
                                                $fname = $rowUser["first_name"];
                                                $lname = $rowUser["last_name"];
                                                $name = $fname . ' ' . $lname;
                                                $code = $rowUser["code"];
                                                $phone = $rowUser["phone"];
                                                $lga = $rowUser["lga"];
                                                $state = $rowUser["state"];
                                                $country = $rowUser["country"];
                                                $religion = $rowUser["religion"];
                                                $gender = $rowUser["gender"];
                                                $day = $rowUser["day"];
                                                $month = $rowUser["month"];
                                                $year = $rowUser["year"];
                                                $patient_id = $rowUser["patient_id"];
                                                $education = $rowUser["education"];
                                                $age = $rowUser["age"];
                                                $ethnicity = $rowUser["ethnicity"];
                                                $device = $rowUser["device"];
                                                $income = $rowUser["income"];
                                                $cancer = $rowUser["cancer"];
                                                $reporter = $rowUser["reporter"];
                                                $relationship = $rowUser["relationship"];
                                                $managing_team = $rowUser["managing_team"];
                                                $pin = $rowUser["pin"];
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
                                            }
                                        }
                                        
                                        $sqlNextOfKin = "SELECT * FROM next_of_kin WHERE user_id='$user_id'";
                                        $resultNextOfKin = $conn->query($sqlNextOfKin);

                                        if ($resultNextOfKin->num_rows > 0) {
                                            while($rowNextOfKin = $resultNextOfKin->fetch_assoc()) {
                                                $name_n = $rowNextOfKin["name"];
                                                $code_n = $rowNextOfKin["code"];
                                                $phone_n = $rowNextOfKin["phone"];
                                                $address_n = $rowNextOfKin["address"];
                                            }
                                        }

                                    ?>


                        <div class="card overflow-hidden profile_card">
                            <div class="card-body py-4 px-5">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="avatar-md profile-user-wid pt-4">
                                            <img src="IMG/<?php echo $photo; ?>" alt="" class="img-thumbnail rounded-circle">
                                        </div>
                                    </div>

                                    <div class="col-sm-9">
                                        <div class="pt-4">
                                            <div class="row">
                                                <div class="col-12 mt-4">
                                                    <h5 class="font-size-18 text-truncate hcp_name" style="display: inline"><?php echo $name ; ?></h5>
                                                    <a class="btn btn-danger waves-effect waves-light btn-sm ep delete_profile" id="<?php echo $patient_id; ?>" user_id="<?php echo $user_id; ?>">Delete Profile</a>    
                                                    <br>
                                                    <span class="badge badge-pill badge-soft-warning font-size-13 ut mt-3"><?php echo strtoupper($cancer) ?> CANCER</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" style="overflow-x: hidden;">
                                

                                    <div class="row">
                                        
                                        <div class="col-md-6 col-sm-12">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">Personal Information</span></th>
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
                                                        <th scope="row">Age</th>
                                                        <td><?php echo $age.' years'  ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Tribe</th>
                                                        <td><?php echo $ethnicity; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Income Level</th>
                                                        <td>
                                                            <?php
                                                                if($income == '<200000'){echo 'Less than ₦200,000';}
                                                                else if($income == '<200000-500000'){echo '₦200,000 - ₦500,000';}
                                                                else if($income == '<500000-1000000'){echo '₦500,000 - ₦1,000,000';}
                                                                else if($income == '>1000000'){echo 'Above ₦1,000,000';}
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">Contact</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email Address</th>
                                                        <td><?php echo $email ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Country</th>
                                                        <td><?php echo $country ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Town/City</th>
                                                        <td><?php echo $lga ; ?></td>
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
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">Caregiver</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Cancer Type</th>
                                                        <td><?php echo  $cancer; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Who will report side effects?</th>
                                                        <td><?php echo $reporter ; ?></td>
                                                    </tr>
                                                    
                                                    <!-- <tr>
                                                        <th scope="row">Managing Team</th>
                                                        <td>Team <?php echo $managing_team; ?></td>
                                                    </tr> -->

                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">Disease Characteristics</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Age when diagnosed with cancer</th>
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
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">Anthropometry</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Height (m)</th>
                                                        <td><?php echo $height; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Weight (kg)</th>
                                                        <td><?php echo $weight; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Body Mass Index (BMI)</th>
                                                        <td><?php echo $bmi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">Laboratory Test</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <img class="tiny_image" src="IMG/<?php echo $lab; ?>" style="pointer-events: all !important;width: auto;height: auto;max-height: 1000px;max-width: 100%;object-fit: contain;-webkit-user-drag: none;">
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="col-md-6 col-sm-12">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">&nbsp;</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Last Name</th>
                                                        <td><?php echo $lname ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Birthday</th>
                                                        <td><?php echo $day . ' ' . $month . ', ' . $year; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Level of Education</th>
                                                        <td><?php echo $education  ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Religion</th>
                                                        <td><?php echo $religion ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">PIN</th>
                                                        <td><?php echo $pin ; ?></td>
                                                    </tr>
                             
                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">&nbsp;</span></th>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Phone Number</th>
                                                        <td><?php echo $code . ' ' . $phone ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">State</th>
                                                        <td><?php echo $state?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-10">&nbsp;</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-10">&nbsp;</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">&nbsp;</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone Number</th>
                                                        <td><?php echo $code_n . ' ' . $phone_n ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">&nbsp;</th>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">&nbsp;</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Type of Device</th>
                                                        <td><?php echo $device; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Relationship with Caregiver</th>
                                                        <td><?php echo $relationship ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span>&nbsp;</span></th>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">&nbsp;</span></th>
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
                                                        <th scope="row"><span class="font-size-20" style="color: #222; ">&nbsp;</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Waist (cm)</th>
                                                        <td><?php echo $waist;?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Head (cm)</th>
                                                        <td><?php echo $head;?></td>
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

                    <!-- end row -->
                    
    

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>


</body>

</html>
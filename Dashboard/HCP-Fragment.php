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
                                }
                            }

                            $sqlUser = "SELECT * FROM hcp WHERE user_id='$user_id'";
                            $resultUser = $conn->query($sqlUser);

                            $code = "";
                            $phone = "";
                            $fname = "";
                            $lname = "";

                            if ($resultUser->num_rows > 0) {
                                while($rowUser = $resultUser->fetch_assoc()) {
                                    $hcp_id = $rowUser["hcp_id"];
                                    $fname = $rowUser["first_name"];
                                    $lname = $rowUser["last_name"];
                                    $code = $rowUser["code"];
                                    $phone = $rowUser["phone"];
                                    $street_u = $rowUser["street"];
                                    $lga_u = $rowUser["lga"];
                                    $state_u = $rowUser["state"];
                                    $country_u = $rowUser["country"];
                                    $cadre_u = $rowUser["cadre"];
                                    $gender = $rowUser["gender"];
                                    $hospital_id = $rowUser["hospital_id"];
                                    $day = $rowUser["day"];
                                    $month = $rowUser["month"];
                                    $year = $rowUser["year"];
                                    $folio = $rowUser["folio"];
                                    $team = $rowUser["team"];
                                    $hospital = $rowUser["hospital"];
                                    $specialty = $rowUser["specialty"];
                                }
                            }

                            if($hospital_id != ""){

                                $hospital_details = '';

                                if(strncmp($hospital_id, "id-", 3) === 0){

                                    $hospital_id = explode('-', $hospital_id)[1];

                                    $sql = "SELECT * FROM hospitals WHERE hospital_id='$hospital_id'";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {

                                            $hospital_details = '
                                            <tr>
                                                <th scope="row">Hospital Name:</th>
                                                <td>'.$row["name"].'</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Hospital Address:</th>
                                                <td>'.$row["lga"] . ', ' . $row["state"] . ', ' . $row["country"].'</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Hospital Cadre</th>
                                                <td>'.$row["cadre"].'</td>
                                            </tr>';
                                        }
    
                                    }

                                }else{
                                    $hospital_details = '
                                            <tr>
                                                <th scope="row">Hospital Name:</th>
                                                <td>'.$hospital_id.'</td>
                                            </tr>';
                                }


                            }


                        ?>

                        <div class="card overflow-hidden profile_card">
                            <div class="card-body pt-0">
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
                                                    <h5 class="font-size-18 text-truncate hcp_name" style="display: inline"><?php echo $fname . ' ' . $lname ; ?></h5>
                                                    <a class="btn btn-primary waves-effect waves-light btn-sm ep delete_profile" id="<?php echo $hcp_id; ?>" user_id="<?php echo $user_id; ?>">Delete Profile</a>    
                                                    <br>
                                                    <span class="badge badge-pill badge-soft-warning font-size-13 ut mt-3"><?php echo strtoupper($cadre_u) ?></span>
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
                                                        <th scope="row">First Name:</th>
                                                        <td><?php echo $fname ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Gender</th>
                                                        <td><?php echo $gender ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="subgroup">Contact</th>
                                                        <!-- <td></td> -->
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email Address:</th>
                                                        <td><?php echo $email ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Address:</th>
                                                        <td><?php echo $lga_u . ', ' . $state_u  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Hospital:</th>
                                                        <td><?php echo $hospital?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Specialty:</th>
                                                        <td><?php echo $specialty ?></td>
                                                    </tr>
                                                    <?php 
                                                    
                                                        if($_SESSION["type"] != "hospital"){

                                                            echo $hospital_details;
                                                        }
                                                    
                                                    ?>
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
                                                        <th scope="row">Last Name:</th>
                                                        <td><?php echo $lname ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Birthday</th>
                                                        <td><?php echo $day . ' ' . $month . ', ' . $year  ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="subgroup">&nbsp;</th>
                                                        <!-- <td>&nbsp;</td> -->
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone Number:</th>
                                                        <td><?php echo $code . ' ' . $phone ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Country:</th>
                                                        <td><?php echo $country_u ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Folio Number:</th>
                                                        <td><?php echo $folio ; ?></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <th scope="row">Managing Team:</th>
                                                        <td>Team <?php echo $team ; ?></td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>


</body>

</html>
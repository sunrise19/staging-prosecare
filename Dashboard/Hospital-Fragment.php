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

                                        $sqlUser = "SELECT * FROM hospitals WHERE user_id='$user_id'";
                                        $resultUser = $conn->query($sqlUser);

                                        if ($resultUser->num_rows > 0) {
                                            while($rowUser = $resultUser->fetch_assoc()) {
                                                $name = $rowUser["name"];
                                                $code = $rowUser["code"];
                                                $phone = $rowUser["phone"];
                                                $street = $rowUser["street"];
                                                $lga = $rowUser["lga"];
                                                $state = $rowUser["state"];
                                                $country = $rowUser["country"];
                                                $occupation = $rowUser["occupation"];
                                                $cadre = $rowUser["cadre"];


                                                $day = $rowUser["day"];
                                                $month = $rowUser["month"];
                                                $year = $rowUser["year"];
                                                $diagnosis = $rowUser["diagnosis"];
                                                $stage = $rowUser["stage"];
                                                $hospital_id = $rowUser["hospital_id"];
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
                                                    <h5 class="font-size-18 text-truncate hcp_name" style="display: inline"><?php echo $name ; ?></h5>
                                                    <a class="btn btn-primary waves-effect waves-light btn-sm ep delete_profile" id="<?php echo $hospital_id; ?>" user_id="<?php echo $user_id; ?>">Delete Profile</a>    
                                                    <br>
                                                    <span class="badge badge-pill badge-soft-warning font-size-13 ut mt-3"><?php echo strtoupper($cadre) ?></span>
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
                                                        <th scope="row">Email Address:</th>
                                                        <td><?php echo $email ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone Number:</th>
                                                        <td><?php echo $code . ' ' . $phone ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Cadre</th>
                                                        <td><?php echo $cadre ; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-5 col-sm-12">
                                            <table class="table table-wrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">L.G.A:</th>
                                                        <td><?php echo $lga ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">State</th>
                                                        <td><?php echo $state ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Country:</th>
                                                        <td><?php echo $country ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Password:</th>
                                                        <td>&bull;&bull;&bull;&bull;&bull;&bull;&bull;</td>
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
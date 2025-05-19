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
</style>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                

                <button style="position: absolute;right: 2em;padding: 12px 45px !important;" class="btn-primary btn-lg do-logout">Log Out</button>

                <div class="row">
                    <div class="col-10">

                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Profile / Settings</h4>
                        </div>

                        <div class="card overflow-hidden">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="avatar-md profile-user-wid pt-4">
                                            <img src="IMG/<?php echo $_SESSION["photo"]; ?>" alt="" class="img-thumbnail rounded-circle">
                                        </div>
                                    </div>

                                    <div class="col-sm-9">
                                        <div class="pt-4">
                                            <div class="row">
                                                <div class="col-12 mt-4">
                                                    <h5 class="font-size-18 text-truncate" style="display: inline"><?php echo $_SESSION["name"] ; ?></h5>
                                                    <a class="btn btn-primary waves-effect waves-light btn-sm ep">Edit Profile</a>    
                                                    <br>
                                                    <span class="badge badge-pill badge-soft-warning font-size-13 ut mt-3"><?php echo strtoupper($_SESSION["type"]) ?></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                
                                    <?php
                                        
                                        include('../STATIC_API/Config.php');

                                        $user_id = $_SESSION["id"];
                                        $sqlUser = "SELECT * FROM hcp WHERE user_id='$user_id'";
                                        $resultUser = $conn->query($sqlUser);

                                        $code = "";
                                        $phone = "";

                                        if ($resultUser->num_rows > 0) {
                                            while($rowUser = $resultUser->fetch_assoc()) {
                                                $code = $rowUser["code"];
                                                $phone = $rowUser["phone"];
                                                $street = $rowUser["street"];
                                                $lga = $rowUser["lga"];
                                                $state = $rowUser["state"];
                                                $country = $rowUser["country"];
                                                $cadre = $rowUser["cadre"];
                                            }
                                        }else{
                                            echo 'no data';
                                        }

                                    ?>
                                    <div class="row">
                                        <div class="col-md-7 col-sm-12">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Email Address:</th>
                                                        <td><?php echo $_SESSION["email"] ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone Number:</th>
                                                        <td><?php echo $code . ' ' . $phone ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Hospital Address:</th>
                                                        <td><?php echo $street . ', ' . $lga . ', ' . $state. ', ' . $country  ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">L.G.A:</th>
                                                        <td><?php echo $lga ; ?></td>
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
                
                <div class="row">
                    
                    <div class="col-sm-12 col-lg-3 mb-4" style="max-width: unset;width: 240px;flex: unset;">
                        
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Photo</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <span class="np">Current Photo</span>
                                    <br>
                                    <br>
                                    <form>
                                        <img class="tiny_image" src="IMG/<?php echo $_SESSION["photo"] ?>" style="pointer-events: all !important;width: 150px;height: 150px;object-fit: cover; -webkit-user-drag: none;">
                                        <input name="file" type="file" multiple="multiple" accept="image/*" style="display: none" class="photo_input">
                                        <button class="btn btn-primary waves-effect waves-light upload-file mt-4" id="update_photo" data-type="photo">Update Photo</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                                    <?php 

                                        include('../STATIC_API/Config.php');
                                        
                                        $types = array("admin", "patient", "hcp");

                                        $UID = $_SESSION["id"];

                                        if(in_array($_SESSION["type"], $types) === true){

                                            $typeToUse = $_SESSION["type"];

                                            $_SESSION["type"] != "hcp" ? $typeToUse = $_SESSION["type"].'s' : $typeToUse;
                                            
                                            
                                            $sql = "SELECT first_name, last_name, code, phone FROM ".$typeToUse ." WHERE user_id='$UID'";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                

                                                while($row = $result->fetch_assoc()) {
                                                    echo'
                                                    <div class="col-12 mb-4">
                                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                                            <h4 class="mb-0 font-size-18">Profile</h4>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-12 col-lg-3 mb-3">
                                                                        <span>First Name</span>
                                                                        <input class="form-control" type="text" value="'.$row["first_name"].'" id="fname">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-3 mb-3">
                                                                        <span>Last Name</span>
                                                                        <input class="form-control" type="text" value="'.$row["last_name"].'" id="lname">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-3 mb-3">
                                                                        <span>Phone Number</span>
                                                                        <input class="form-control" type="tel" value="'.$row["phone"].'" id="phone">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-3 mb-3">
                                                                        <span>Email</span>
                                                                        <input class="form-control" type="email" value="'.$row["email"].'" id="email">
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light updatedetails blue">Update Profile</button>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }

                                            }
                                        
                                        }else if($_SESSION["type"] == "hospital"){

                                            $sql = "SELECT name, code, phone FROM hospitals WHERE user_id='$UID'";

                                            $result = $conn->query($sql);
                                            
                                            if ($result->num_rows > 0) {

                                                while($row = $result->fetch_assoc()) {
                                                    echo'
                                                    <div class="col-12">
                                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                                            <h4 class="mb-0 font-size-18">Profile</h4>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-12 col-lg-6 mb-3">
                                                                        <span>Name</span>
                                                                        <input class="form-control" type="text" value="'.$row["name"].'" id="fname">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-2 mb-3">
                                                                        <span>Last Name</span>
                                                                        <input class="form-control" type="text" value="'.$row["code"].'" id="lname">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-4 mb-3">
                                                                        <span>Phone Number</span>
                                                                        <input class="form-control" type="tel" value="'.$row["phone"].'" id="phone">
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-3 mb-3">
                                                                        <span>Email</span>
                                                                        <input class="form-control" type="email" value="<?php echo $_SESSION["email"]?>" id="email">
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light updatedetails blue">Update Profile</button>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }

                                            }
                                        }
                                    ?>
                                    
                                    
                                    
                        

                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Authentication</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-lg-4 mb-3">
                                            <span>Current Password</span>
                                            <input class="form-control" type="password" id="password">
                                        </div>
                                        <div class="col-sm-12 col-lg-4 mb-3">
                                            <span>New Password</span>
                                            <input class="form-control" type="password" id="passworda">
                                        </div>
                                        <div class="col-sm-12 col-lg-4 mb-3">
                                            <span>Confirm New Password</span>
                                            <input class="form-control" type="password" id="passwordb">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light updatepassword blue">Change password</button>
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
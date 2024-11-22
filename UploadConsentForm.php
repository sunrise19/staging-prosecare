<?php 
    $TITLE = "Consent"; include('Commons/header.php');
    if(!isset($_REQUEST["WithAuth"])){
        header('Location: ./AccountType');
    }
?>

<style>
    .needsclick {
    border: 2px dashed #ced4da;
    background: #fff;
    border-radius: 6px;
    margin-bottom: 50px;
    padding: 20px 0;
}

.file_name {
    color: #8d2d90;
    background: #8d2d9047;
    padding: 4px 19px;
    display: inline-block;
    margin: -10px 0 14px;
    border-radius: 17px;
}
</style>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6">

                <!-- <img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right"> -->

                <div class="auth-full-page-content p-md-5 p-4" style="padding-bottom: 0 !important">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                        <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">

                            <div class="align-center m-a-c" style="margin-bottom: 30px">
                                <div class="prose_logo"></div>
                                <h1 class="text-primary text-center mb-4">Upload Signed Consent Form</h1>
                                <!-- <p class="text-center font-size-15 hide-on-success">Your consent is required before we continue</p> -->
                            </div>
                            <div class="card">
                                <div class="card-body_">
                                    <div>
                                        <?php

                                            include('./STATIC_API/Config.php');

                                            $AUTH = $_REQUEST["WithAuth"];

                                            $sql = "SELECT * FROM users WHERE email_hash = '$AUTH'";

                                            $result = mysqli_query($conn, $sql);

                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    $user_id = $row["user_id"];
                                                    echo '<script>const USER_ID="'.$user_id.'"</script>';
                                                }
                                            }
                                    
                                           if(isset($_FILES['file'])){
                                               
                                                   
                                                    $errors= "";
                                                    $file_name = $_FILES['file']['name'];
                                                    $file_size = $_FILES['file']['size'];
                                                    $file_tmp = $_FILES['file']['tmp_name'];
                                                    $file_type = $_FILES['file']['type'];
                                                    $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
                                                    
                                                    $extensions= array("jpeg","jpg","png","pdf","xlsx","docx");
                                                    
                                                    if(in_array($file_ext,$extensions)=== false){
                                                        $errors ="File not allowed, please choose a PICTURE or DOCUMENT file.";
                                                    }
                                                    
                                                    if($file_size > 2097152) {
                                                        $errors ='File size must be 2 MB or less';
                                                    }

                                                    $AUTH = $_REQUEST["WithAuth"];

                                                    $sql = "SELECT * FROM users WHERE email_hash = '$AUTH'";

                                                    $result = mysqli_query($conn, $sql);

                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $user_id = $row["user_id"];
                                                            echo '<script>const USER_ID="'.$user_id.'"</script>';
                                                        }
                                                    }else{
                                                        echo '<script>window.location.href = "./AccountType"</script>';
                                                    }
                                                    
                                                    if($errors=='') {
                                                        move_uploaded_file($file_tmp,"CONSENT_FORMS/".$file_name);
                                                        $sql = "INSERT INTO consent_forms (user_id, file_name) VALUES ('$user_id', '$file_name')";
                                                        if($conn->query($sql) === TRUE){
                                                            //echo '<script>window.location.href = "./NewPatient?WithAuth='.$AUTH.'"</script>';
                                                        }else{
                                                            echo "<script>alert('Failed to upload consent form ".$conn->error."');</script>";
                                                        }
                                                    }else{
                                                     echo "<script>alert('".$errors."');</script>";
                                                    }

                                           }

                                        ?>
                                        <form id="upload_form" action="" class="dropzone_" method="POST" enctype="multipart/form-data">
                                            <div class="fallback" style="display: none">
                                                <input id="fallback_input" name="file" type="file" multiple="multiple">
                                            </div>
                                            <div class="dz-message needsclick" style=" text-align: center; ">
                                                <div class="mb-3">
                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                </div>

                                                <span class="file_name"></span>
                                                <h4>Drop files here or click to upload.</h4>
                                            </div>
                                            <!-- <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light upload-file">Upload</button>
                                            </div> -->
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="proceed">Proceed</button>
                                            </div>
                                        </form>

                                        <img class="raw_image" style="display: none">
                                        <canvas style="display: none"></canvas>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                            
                            <div class="mt-3 text-center">
                                <p class="font-size-15  text-primary">Lost? <a href="./AccountType" class="fw-medium text-primary"> Go Back</a> </p>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>

<?php include('Commons/footer.php');?>
<script>var AUTH = '<?php if(isset($_REQUEST["WithAuth"])){echo $_REQUEST["WithAuth"];}?>'</script>
<script src="assets/js/uploadconsentform.js"></script>
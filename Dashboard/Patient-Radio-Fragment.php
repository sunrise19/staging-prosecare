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

    .status-Severe {
        background: #ff6055;
    }

    [class*="status-"] {
        border-radius: 10px;
        padding: 11px 19px;
        margin-bottom: 17px;
        color: #7A667B;
        background: #ffeacd;
    }

    .se_title {
        display: block;
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 6px;
    }

    .status-Moderate {
        background: #ffa42f;
    }

    .status-Mild {
        background: #4ab677;
    }

    .status-Purple {
        background: #71207d;
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


                            $sqlUser = "SELECT * FROM patients WHERE user_id='$user_id'";
                            $resultUser = $conn->query($sqlUser);

                            if ($resultUser->num_rows > 0) {
                                while($rowUser = $resultUser->fetch_assoc()) {
                                    $patient_id =  $rowUser["patient_id"];
                                    $fname = $rowUser["first_name"];
                                    $lname = $rowUser["last_name"];
                                    $name = $fname . ' ' . $lname;
                                    $cancer = $rowUser["cancer"];
                                    echo '<script>const CANCER="'.$cancer.'".toLowerCase()</script>';
                                }
                            }
                    
                            $sql = "SELECT * FROM radiotherapy WHERE user_id = '$user_id'";
                            $result = $conn->query($sql);

                            $data = '<div class="no_side_effects">No logs yet :/</div>';

                            $weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                            if ($result->num_rows > 0) {

                                $data = '';

                                while($row = $result->fetch_assoc()) {

                                    $date = explode('-', $row['date']);


                                    $data .= '<div class="col-12 mb-5 side_effect_group" data-sort="'.strtotime($row['date']).'" data-day="'.$date[0].'" data-month="'.$date[1].'" data-year="'.$date[2].'">';
                                
                                        $data .= '<div class="col-lg-12 col-sm-12">';
                                        $data .= '<h2 class="effect_date">Showing treatments logged on '.date('l',  strtotime($date[0].'-'.($date[1]+1).'-'. $date[2])) . ' ' . $date[0] . ' ' . $months[$date[1]]. ', ' .$date[2].'</h2>';
                                        $data .= '</div>';

                                        $data .= '<div class="col-lg-12 col-sm-12">';

                                        if(strtolower($cancer) ==  'breast'){

                                            $current_effect = $row['target_site'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="target_site">';
                                                $data .= '<span class="se_title">Target Site</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['field_type'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="field_type">';
                                                $data .= '<span class="se_title">Field Type</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_fields'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_fields">';
                                                $data .= '<span class="se_title">Number of Fields</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['size_of_fields'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="size_of_fields">';
                                                $data .= '<span class="se_title">Size of Fields</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['total_dose'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="total_dose">';
                                                $data .= '<span class="se_title">Total Dose</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_fractions'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_fractions">';
                                                $data .= '<span class="se_title">Number of Fractions</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['size_of_fractions'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="size_of_fractions">';
                                                $data .= '<span class="se_title">Size of Fractions</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_weeks'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_weeks">';
                                                $data .= '<span class="se_title">Number of Weeks</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['fractional_regimen'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fractional_regimen">';
                                                $data .= '<span class="se_title">Fractional Regimen</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['conventional'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="conventional">';
                                                $data .= '<span class="se_title">Conventional</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['hypofractionation'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hypofractionation">';
                                                $data .= '<span class="se_title">Hypofractionation</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['hyperfractionation'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hyperfractionation">';
                                                $data .= '<span class="se_title">Hyperfractionation</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['other'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="other">';
                                                $data .= '<span class="se_title">Other</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                          

                                        }else if(strtolower($cancer) ==  'head and neck' || strtolower($cancer) ==  'male pelvic'){

                                            $current_effect = $row['target_site'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="target_site">';
                                                $data .= '<span class="se_title">Target Site</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['field_type'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="field_type">';
                                                $data .= '<span class="se_title">Field Type</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_fields'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_fields">';
                                                $data .= '<span class="se_title">Number of Fields</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['size_of_fields'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="size_of_fields">';
                                                $data .= '<span class="se_title">Size of Fields</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['total_dose'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="total_dose">';
                                                $data .= '<span class="se_title">Total Dose</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_fractions'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_fractions">';
                                                $data .= '<span class="se_title">Number of Fractions</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['size_of_fractions'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="size_of_fractions">';
                                                $data .= '<span class="se_title">Size of Fractions</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_weeks'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_weeks">';
                                                $data .= '<span class="se_title">Number of Weeks</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['fractional_regimen'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fractional_regimen">';
                                                $data .= '<span class="se_title">Fractional Regimen</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['conventional'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="conventional">';
                                                $data .= '<span class="se_title">Conventional</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['hypofractionation'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hypofractionation">';
                                                $data .= '<span class="se_title">Hypofractionation</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['hyperfractionation'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hyperfractionation">';
                                                $data .= '<span class="se_title">Hyperfractionation</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['other'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="other">';
                                                $data .= '<span class="se_title">Other</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                        } else if(strtolower($cancer) ==  'female pelvic'){


                                            $current_effect = $row['target_site'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="target_site">';
                                                $data .= '<span class="se_title">Target Site</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['field_type'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="field_type">';
                                                $data .= '<span class="se_title">Field Type</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_fields'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_fields">';
                                                $data .= '<span class="se_title">Number of Fields</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['size_of_fields'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="size_of_fields">';
                                                $data .= '<span class="se_title">Size of Fields</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['total_dose'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="total_dose">';
                                                $data .= '<span class="se_title">Total Dose</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_fractions'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_fractions">';
                                                $data .= '<span class="se_title">Number of Fractions</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['size_of_fractions'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="size_of_fractions">';
                                                $data .= '<span class="se_title">Size of Fractions</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['number_of_weeks'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="number_of_weeks">';
                                                $data .= '<span class="se_title">Number of Weeks</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['fractional_regimen'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fractional_regimen">';
                                                $data .= '<span class="se_title">Fractional Regimen</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['conventional'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="conventional">';
                                                $data .= '<span class="se_title">Conventional</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['hypofractionation'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hypofractionation">';
                                                $data .= '<span class="se_title">Hypofractionation</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['other'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="other">';
                                                $data .= '<span class="se_title">Other</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['intent'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="intent">';
                                                $data .= '<span class="se_title">Radiotherapy Intent</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            $current_effect = $row['dose'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="dose">';
                                                $data .= '<span class="se_title">Total Dose</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                        }

                                        $data .= '</div>';

                                    $data .= '</div>';
                                }

                            }


                        ?>


                        <div class="overflow-hidden profile_card mb-0">
                            <div class="card-body p-0">
                                <div class="row d-none">
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

                                <button class="btn-success exportToExcel noprint mt-4 d-none" style="right: 16.5rem;top: 1.5rem;">Export To Spreadsheet</button>

                                <div class="l2r" style="align-items: start; gap: 18px;">
                                    <div class="row mt-0 side_effect_group_parent">    
                                        <?php echo $data; ?>
                                    </div>
                                    <div id="datepicker" style="margin-top: 23px"></div>
                                </div>

                                <table id="main_table" style="display: none">

                                    <thead>
                                        <tr id="table_headers">
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="main_output">
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
                    
    

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>
    <script src="Commons/excel.js"></script>
    <script src="JS/jquery-ui.js"></script>

    <script>
        $(document).ready(function(){
            let calendarDates = []

            $('.side_effect_group').each(function(){
                let t = $(this),
                    day = t.attr('data-day'),
                    month = t.attr('data-month'),
                    year = t.attr('data-year')

                day && month && year && calendarDates.push([day, month, year])
            })

            loadDates()

            $('#datepicker').datepicker({
                dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
                maxDate: new Date(),
                changeMonth: true,
                changeYear: true,
                showAnim: '',
                dateFormat: 'd M, yy',
                monthNamesShort: $.datepicker.regional["en"].monthNames,
                onChangeMonthYear: function (item) { loadDates() },
                onSelect: function() { loadDates() }
            })

            function loadDates(){
                setTimeout(() => {
                    calendarDates.forEach(item => {

                        let day = item[0],
                            month = item[1],
                            year = item[2]

                        $('.ui-datepicker-calendar a').each(function () {
                            
                            let t = $(this),
                                p = t.parent(),
                                this_day = t.text(),
                                this_month = p.attr('data-month'),
                                this_year = p.attr('data-year')
                            
                            t.removeAttr('href')

                            if (
                                this_day === day
                                &&
                                this_month === month
                                &&
                                this_year === year
                            ) {
                                t.addClass('ui-state-default ui-state-highlight has_side_effect')
                            }
                        })

                        $('td').off('click').on('click', function () {
                            let t = $(this),
                                target = t.find('a'),
                                day = target.text(),
                                month = t.attr('data-month'),
                                year = t.attr('data-year')

                            console.log(target.hasClass('has_side_effect'), year)

                            $('.side_effect_group').hide()

                            if (target.hasClass('has_side_effect')) {
                                $('.empty_state').hide()
                                $('.side_effect_group[data-day="'+day+'"][data-month="'+month+'"][data-year="'+year+'"]').show()
                            } else {
                                $('.empty_state').show()
                                ACTIVE_SIDE_EFFECT_ID = ''
                                $('a').removeClass('ui-state-active')
                                target.addClass('ui-state-active')
                            }
                        })

                    })
                }, 500);
            }

            const arrange = (element, parent) => {
                $(element).sort(function (a, b) {
                    var contentA = $(a).data('sort');
                    var contentB = $(b).data('sort');
                    return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
                }).appendTo(parent);
            }
            arrange('.side_effect_group', $('.side_effect_group_parent'))

            $('.side_effect_group:not(:first)').hide();

            let header_html = {
                    breast: {
                        sizes: '30,50,50,50,130,70,50,50,50,50,50',
                        header: '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Date</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Hair loss in armpit</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Arm swelling and changes</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Difficulty in swallowing</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">In the area where you are receiving radiotherapy, do you experience pain in the chest wall? (To be answered if you have done a mastectomy)</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Breast swelling (To be answered if you haven\'t done a mastectomy)</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Breast pain (To be answered if you haven\'t done a mastectomy)</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Loss of sensation and weakness of the arm</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Skin colour changes</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Tired / Weak</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Is there any side effect or anything you would like to share?</th>'
                    },
                    head_and_neck: {
                        sizes: '30,50,50,50,50,50,50,50,50,50,50,50,70,50',
                        header: '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Date</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Mouth sore</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Difficulty in swallowing</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Loss of smell</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Taste changes</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Dry mouth</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Cracking at the corner of the mouth</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Voice change</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Appetite changes</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Nausea</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Vomiting</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Skin colour changes</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Tired / Weak</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Is there any side effect or anything you would like to share?</th>'
                    },
                    female_pelvic: {
                        sizes: '30,50,50,50,50,50,50,50,50,50,50,50,50,50,70,70,50',
                        header: '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Date</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Loose or watery stools</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Nausea</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Vomiting</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Skin colour changes</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Changes in the anus</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Blood in the urine</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Difficulty in urinating</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Painful urination</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Feel like urinating</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Control of urine flow</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Rate of urination</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Vaginal dryness</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Leakage of stool</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Tired / Weak</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Is there any side effect or anything you would like to share?</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Are you on chemotherapy?</th>'
                                
                    },
                    male_pelvic: {
                        sizes: '30,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50,50',
                        header: '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Date</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Blood in the urine</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Difficulty in urinating</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Painful urination</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Rate of urination</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Feel like urinating</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Control of urine flow</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Nausea</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Vomiting</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Loose or watery stools</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Changes in the anus</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Blood from the anus</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Difficulty in stooling</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Belly feels full and tight</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Leakage of stool</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Achieve and maintain erection</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Difficulty in releasing sperm</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Decreased sexual desire</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Painful sex</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Tired / Weak</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Is there any side effect or anything you would like to share?</th>'+
                                '<th data-a-wrap="false" data-fill-color="FFF3F6F9" data-b-a-s="medium" data-f-bold="true">Are you on chemotherapy?</th>'
                                
                    }
                },
                table_content = [],
                table = $('#main_table'),
                header = $('#table_headers'),
                output = $('#main_output')

            if(CANCER == 'breast'){
                
                table.attr('data-cols-width', header_html.breast.sizes)
                header.html(header_html.breast.header)
            
                $('.side_effect_group').each(function(){

                    let t = $(this),
                        data = '<tr>'
                            data += '<td>'+t.find('.effect_date').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_hair_loss"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_arm_swelling"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_swallowing_difficulty"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_chest_pain"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_breast_swelling"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_breast_pain"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_sensation_loss"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_skin_color"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_tired_or_weak"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="b_note"]').find('.se_status').text()+'</td>'
                        data += '</tr>'

                    output.append(data)
                })

            }else if(CANCER == 'head and neck'){
                
                table.attr('data-cols-width', header_html.head_and_neck.sizes)
                header.html(header_html.head_and_neck.header)
            
                $('.side_effect_group').each(function(){

                    let t = $(this),
                        data = '<tr>'
                            data += '<td>'+t.find('.effect_date').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_mouth_sore"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_diff_in_swallowing"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_loss_of_smell"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_taste_changes"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_dry_mouth"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_mouth_cracking"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_voice_change"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_appetite_changes"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_nausea"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_vomiting"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_skin_color_changes"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_tired_or_weak"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="hn_note"]').find('.se_status').text()+'</td>'
                        data += '</tr>'

                    output.append(data)
                })

            }else if(CANCER == 'female pelvic'){
                
                table.attr('data-cols-width', header_html.female_pelvic.sizes)
                header.html(header_html.female_pelvic.header)
            
                $('.side_effect_group').each(function(){

                    let t = $(this),
                        data = '<tr>'
                            data += '<td>'+t.find('.effect_date').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_loose_stool"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_nausea"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_vomiting"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_skin_color"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_anus_changes"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_blood_in_urine"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_diff_urinating"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_painful_urine"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_feel_like_urine"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_urine_control"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_urine_rate"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_vag_dry"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_stool_leak"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_tired_or_weak"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_note"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="fp_on_chemo"]').find('.se_status').text()+'</td>'
                        data += '</tr>'

                    output.append(data)
                })

            }else if(CANCER == 'male pelvic'){

                table.attr('data-cols-width', header_html.male_pelvic.sizes)
                header.html(header_html.male_pelvic.header)
            
                $('.side_effect_group').each(function(){

                    let t = $(this),
                        data = '<tr>'
                            data += '<td>'+t.find('.effect_date').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_blood_in_urine"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_diff_urinating"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_painful_urine"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_urine_rate"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_feel_like_urine"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_urine_control"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_nausea"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_vomiting"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_loose_stool"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_anus_changes"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_blood_from_anus"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_diff_stooling"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_belly_tight"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_stool_leak"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_erection"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_diff_in_releases"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_decreased_desire"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_painful_sex"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_tired_or_weak"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_note"]').find('.se_status').text()+'</td>'
                            data += '<td>'+t.find('div[data-type="mp_on_chemo"]').find('.se_status').text()+'</td>'
                        data += '</tr>'

                    output.append(data)
                })

            }

            $('td').each(function(){
                let t = $(this)
                if(t.text() == ''){
                    t.text('-')
                }
            })

            $(".exportToExcel").click(function() {

                let table = document.getElementsByTagName("table"),
                    name = 'PROSE CARE ' + CANCER.toUpperCase() + ' CANCER SIDE EFFECTS FOR ' + $('.hcp_name').text().toUpperCase()
                TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: name+'.xlsx', // fileName you could use any name
                sheet: {
                    name: 'Sheet 1' // sheetName
                }
                });
            });


        })
    </script>


</body>

</html>
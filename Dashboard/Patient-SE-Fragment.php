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
        color: #fff;
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
                    
                            $sql = "SELECT * FROM sideeffects WHERE user_id = '$user_id'";
                            $result = $conn->query($sql);

                            $data = '<div class="no_side_effects">No side effects reported yet :/</div>';

                            $weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                            if ($result->num_rows > 0) {

                                $data = '';

                                while($row = $result->fetch_assoc()) {

                                    $date = explode('-', $row['date']);


                                    $data .= '<div class="row col-12 mb-5 side_effect_group" data-sort="'.strtotime($row['date']).'">';
                                
                                        $data .= '<div class="col-lg-4 col-sm-12">';
                                        $data .= '<h2 class="effect_date">'.date('l',  strtotime($date[0].'-'.($date[1]+1).'-'. $date[2])) . ' ' . $date[0] . ' ' . $months[$date[1]]. ', ' .$date[2].'</h2>';
                                        $data .= '</div>';

                                        $data .= '<div class="col-lg-8 col-sm-12">';

                                        if(strtolower($cancer) ==  'breast'){

                                            //HAIR LOSS
                                            $current_effect = $row['b_hair_loss'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_hair_loss">';
                                                $data .= '<span class="se_title">Hair loss in armpit</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (No hair loss)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Yes, patchy hair loss)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Yes, complete hair loss)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //ARM SWELLING
                                            $current_effect = $row['b_arm_swelling'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_arm_swelling">';
                                                $data .= '<span class="se_title">Arm swelling and changes</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Slight swelling or a slight change in skin color of the arm)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Obvious swelling or obvious change in skin color of the arm)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Swollen arm changes are limiting cooking, self-care, feeding, and bathing)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //SWALLOWING DIFFICULTY
                                            $current_effect = $row['b_swallowing_difficulty'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_swallowing_difficulty">';
                                                $data .= '<span class="se_title">Difficulty in swallowing</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Difficulty eating solid or soft foods)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Difficulty swallowing liquid)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Unable to swallow liquid, solid and soft food)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //CHEST PAIN
                                            $current_effect = $row['b_chest_pain'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_chest_pain">';
                                                $data .= '<span class="se_title">In the area where you are receiving radiotherapy, do you experience pain in the chest wall? (To be answered if you have done a mastectomy)</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have a little pain)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have pain and it sometimes limit my daily activities)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (The pain is severe and limits my self care)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //BREAST SWELLING
                                            $current_effect = $row['b_breast_swelling'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="b_breast_swelling">';
                                                $data .= '<span class="se_title">Breast swelling (To be answered if you haven\'t done a mastectomy)</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //BREAST PAIN
                                            $current_effect = $row['b_breast_pain'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_breast_pain">';
                                                $data .= '<span class="se_title">Breast pain (To be answered if you haven\'t done a mastectomy)</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have a little pain)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have pain and it sometimes limit my daily activities)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (The pain is severe and limits my self care)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //SENSATION LOSS
                                            $current_effect = $row['b_sensation_loss'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_sensation_loss">';
                                                $data .= '<span class="se_title">Loss of sensation and weakness of the arm</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Loss of sensation of the arm)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Discomfort or muscle weakness of the arm)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Discomfort or muscle weakness of the arm limiting self-care)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //SKIN COLOR CHANGES
                                            $current_effect = $row['b_skin_color'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_skin_color">';
                                                $data .= '<span class="se_title">Skin colour changes</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have skin colour changes or dry peeling on the skin)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have skin colour changes or a little area of my skin that is wet and peeling in skin folds e.g. armpit)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have a lot of skin colour changes and or peeling of my skin; bleeding from my breast or chest skin or an ulcer on my skin)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //TIRED OR WEAK
                                            $current_effect = $row['b_tired_or_weak'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="b_tired_or_weak">';
                                                $data .= '<span class="se_title">Tired / Weak</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I do not feel better more than usual)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I feel worse than usual)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I feel much worse than usual)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //NOTE
                                            $current_effect = $row['b_note'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="b_note">';
                                                $data .= '<span class="se_title">Is there any side effect or anything you would like to share?</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                        }else if(strtolower($cancer) ==  'head and neck'){

                                            //MOUTH SORE
                                            $current_effect = $row['hn_mouth_sore'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_mouth_sore">';
                                                $data .= '<span class="se_title">Mouth sore</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Mouth feels sore or there is redness in the mouth)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Painful  mouth ulcers, redness in the mouth but you can swallow)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Painful mouth ulcers that is very painful, redness in the mouth but you cannot swallow)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //SWALLOWING DIFFICULTY
                                            $current_effect = $row['hn_diff_in_swallowing'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_diff_in_swallowing">';
                                                $data .= '<span class="se_title">Difficulty in swallowing</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Difficulty eating solid or soft foods)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Difficulty swallowing liquid)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Unable to swallow liquid, solid and soft foods)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //SMELL LOSS
                                            $current_effect = $row['hn_loss_of_smell'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="hn_loss_of_smell">';
                                                $data .= '<span class="se_title">Loss of smell</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //TASTE CHANGES
                                            $current_effect = $row['hn_taste_changes'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_taste_changes">';
                                                $data .= '<span class="se_title">Taste changes</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Food tastes slightly different)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Food tastes markedly different with change in diet)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Complete loss of taste even with change in diet)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //DRY MOUTH
                                            $current_effect = $row['hn_dry_mouth'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_dry_mouth">';
                                                $data .= '<span class="se_title">Dry mouth</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Occasional mouth dryness with slightly thick saliva)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Persistent mouth dryness with  thick, sticky saliva)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Complete mouth dryness with thick, sticky saliva)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //MOUTH CRACKING
                                            $current_effect = $row['hn_mouth_cracking'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="hn_mouth_cracking">';
                                                $data .= '<span class="se_title">Cracking at the corner of the mouth</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //VOICE CHANGE
                                            $current_effect = $row['hn_voice_change'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_voice_change">';
                                                $data .= '<span class="se_title">Voice change</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Occasional voice changes and self-resolves)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Persistent voice changes and may require occasional repetition)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Complete voice changes, incapable of normal communication)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //APPETITE CHANGES
                                            $current_effect = $row['hn_appetite_changes'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_appetite_changes">';
                                                $data .= '<span class="se_title">Appetite changes</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (Occasional loss of appetite without alteration in eating habits)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (Loss of appetite plus reduced oral intake, no significant weight loss, occasional inclination to vomit)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (Complete loss of appetite, persistent inclination to vomit with significant weight loss)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //NAUSEA
                                            $current_effect = $row['hn_nausea'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="hn_nausea">';
                                                $data .= '<span class="se_title">Nausea</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //VOMITING
                                            $current_effect = $row['hn_vomiting'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_vomiting">';
                                                $data .= '<span class="se_title">Vomiting</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (1 episode of vomiting in 24 hours)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (2 - 5 episodes of vomiting in 24 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (6 or more episodes of vomiting. Could require hospitalization)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //SKIN COLOR CHANGES
                                            $current_effect = $row['hn_skin_color_changes'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_skin_color_changes">';
                                                $data .= '<span class="se_title">Skin colour changes</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have skin colour changes or dry peeling on the skin)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (2 - 5 episodes of vomiting in 24 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (6 or more episodes of vomiting. Could require hospitalization)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //TIRED OR WEAK
                                            $current_effect = $row['hn_tired_or_weak'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="hn_tired_or_weak">';
                                                $data .= '<span class="se_title">Tired / Weak</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I do not feel better more than usual)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I feel worse than usual)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I feel much worse than usual)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //NOTE
                                            $current_effect = $row['hn_note'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="hn_note">';
                                                $data .= '<span class="se_title">Is there any side effect or anything you would like to share?</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                        } else if(strtolower($cancer) ==  'female pelvic'){

                                            //LOOSE STOOLS
                                            $current_effect = $row['fp_loose_stool'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_loose_stool">';
                                                $data .= '<span class="se_title">Loose or watery stools</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have less than 4 episodes of watery stool in 24 hours)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have between 4-6 episodes of watery stool in 24 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have greater than 6 episodes of watery stool in 24 hours)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //NAUSEA
                                            $current_effect = $row['fp_nausea'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="fp_nausea">';
                                                $data .= '<span class="se_title">Nausea</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //VOMITING
                                            $current_effect = $row['fp_vomiting'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_vomiting">';
                                                $data .= '<span class="se_title">Vomiting</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (1 episode of vomiting in 24 hours)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (2 - 5 episodes of vomiting in 24 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (6 or more episodes of vomiting. Could require hospitalization)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //SKIN COLOR CHANGES
                                            $current_effect = $row['fp_skin_color'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_skin_color">';
                                                $data .= '<span class="se_title">Skin colour changes</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have skin colour changes or dry peeling on the skin)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have skin colour changes or a little area of my skin that is wet and peeling in skin folds eg armpit)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have a lot of skin colour changes and or peeling of my skin; bleeding from my breast or chest skin or an ulcer on my skin)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //ANUS CHANGES
                                            $current_effect = $row['fp_anus_changes'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_anus_changes">';
                                                $data .= '<span class="se_title">Changes in the anus</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have pain in my anus or occasional urgency to stool but little or no stool comes out)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have persistent pain in the anus with ulceration or  persistent bleeding, tightness of the anus)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have uncontrollable stooling and pain; heavy bleeding, complete obstruction of the anus)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //BLOOD URINE
                                            $current_effect = $row['fp_blood_in_urine'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_blood_in_urine">';
                                                $data .= '<span class="se_title">Blood in the urine</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I can see blood in my urine)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I can see blood and small clot in my urine)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I can see blood and big clot in my urine)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //DIFFICULTY IN URINATING
                                            $current_effect = $row['fp_diff_urinating'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_diff_urinating">';
                                                $data .= '<span class="se_title">Difficulty in urinating</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have occasional difficulty in urinating)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have intermittent difficulty in urinating)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have complete difficulty in urinating)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //PAINFUL URINE
                                            $current_effect = $row['fp_painful_urine'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_painful_urine">';
                                                $data .= '<span class="se_title">Painful urination</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I experience occasional &amp; minimal painful urination)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I experience intermittent &amp; tolerable painful urination)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I experience persistent, intense, refractory &amp; excruciating painful urination)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //FEEL LIKE URINATING
                                            $current_effect = $row['fp_feel_like_urine'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_feel_like_urine">';
                                                $data .= '<span class="se_title">Feel like urinating</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have occasional urge  to urinate)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have a persistent urge to urinate which sometimes affects daily activities)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have an uncontrollable urge to urinate that always affect daily activities and requires urinary catheter)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //URINE CONTROL
                                            $current_effect = $row['fp_urine_control'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_urine_control">';
                                                $data .= '<span class="se_title">Control of urine flow</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I experience uncontrollable flow of urine more than once in a week)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I experience uncontrollable flow of urine more than once a day)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I experience uncontrollable flow of urine more than once a day and might necessitate the use of pads)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //URINE RATE
                                            $current_effect = $row['fp_urine_rate'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_urine_rate">';
                                                $data .= '<span class="se_title">Rate of urination</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I urinate every 3 - 4 hours)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I urinate every 2 - 3 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I urinate every 1 hour or more frequently)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //VAG DRYNESS
                                            $current_effect = $row['fp_vag_dry'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_vag_dry">';
                                                $data .= '<span class="se_title">Vaginal dryness</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have vaginal dryness that has no interference with usual sexual, social, &amp; functional activities)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have vaginal dryness that has minimal interference with usual sexual, social, &amp; functional activities)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have vaginal dryness that has significant interference with usual sexual, social, &amp; functional activities)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //STOOL LEAK
                                            $current_effect = $row['fp_stool_leak'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_stool_leak">';
                                                $data .= '<span class="se_title">Leakage of stool</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I experience occasional leakage of stool)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I experience persistent leakage of stool)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I experience complete loss of control of over leakage of stool)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //TIRED OR WEAK
                                            $current_effect = $row['fp_tired_or_weak'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="fp_tired_or_weak">';
                                                $data .= '<span class="se_title">Tired / Weak</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I do not feel better more than usual)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I feel worse than usual)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I feel much worse than usual)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //NOTE
                                            $current_effect = $row['fp_note'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="fp_note">';
                                                $data .= '<span class="se_title">Is there any side effect or anything you would like to share?</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //ON CHEMO
                                            $current_effect = $row['fp_on_chemo'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="fp_on_chemo">';
                                                $data .= '<span class="se_title">Are you on chemotherapy?</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Yes, weekly';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Yes, 3 weekly';}
                                                        else if($current_effect == 'Severe'){$data .= 'Yes, monthly';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                        } else if(strtolower($cancer) ==  'male pelvic'){

                                            //BLOOD URINE
                                            $current_effect = $row['mp_blood_in_urine'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_blood_in_urine">';
                                                $data .= '<span class="se_title">Blood in the urine</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I can see blood in my urine)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I can see blood and small clot in my urine)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I can see blood and big clot in my urine)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //DIFFICULTY IN URINATING
                                            $current_effect = $row['mp_diff_urinating'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_diff_urinating">';
                                                $data .= '<span class="se_title">Difficulty in urinating</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have occasional difficulty in urinating)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have intermittent difficulty in urinating)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have complete difficulty in urinating)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //PAINFUL URINE
                                            $current_effect = $row['mp_painful_urine'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_painful_urine">';
                                                $data .= '<span class="se_title">Painful urination</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I experience occasional &amp; minimal painful urination)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I experience intermittent &amp; tolerable painful urination)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I experience persistent, intense, refractory &amp; excruciating painful urination)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //URINE RATE
                                            $current_effect = $row['mp_urine_rate'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_urine_rate">';
                                                $data .= '<span class="se_title">Rate of urination</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I urinate every 3 - 4 hours)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I urinate every 2 - 3 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I urinate every 1 hour or more frequently)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //FEEL LIKE URINATING
                                            $current_effect = $row['mp_feel_like_urine'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_feel_like_urine">';
                                                $data .= '<span class="se_title">Feel like urinating</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have occasional urge  to urinate)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have a persistent urge to urinate which sometimes affects daily activities)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have an uncontrollable urge to urinate that always affect daily activities and requires urinary catheter)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //URINE CONTROL
                                            $current_effect = $row['mp_urine_control'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_urine_control">';
                                                $data .= '<span class="se_title">Control of urine flow</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I experience uncontrollable flow of urine more than once in a week)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I experience uncontrollable flow of urine more than once a day)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I experience uncontrollable flow of urine more than once a day and might necessitate the use of pads)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //NAUSEA
                                            $current_effect = $row['mp_nausea'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_nausea">';
                                                $data .= '<span class="se_title">Nausea</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //VOMITING
                                            $current_effect = $row['mp_vomiting'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_vomiting">';
                                                $data .= '<span class="se_title">Vomiting</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (1 episode of vomiting in 24 hours)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (2 - 5 episodes of vomiting in 24 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (6 or more episodes of vomiting. Could require hospitalization)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //LOOSE STOOLS
                                            $current_effect = $row['mp_loose_stool'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_loose_stool">';
                                                $data .= '<span class="se_title">Loose or watery stools</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have less than 4 episodes of watery stool in 24 hours)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have between 4-6 episodes of watery stool in 24 hours)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have greater than 6 episodes of watery stool in 24 hours)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //ANUS CHANGES
                                            $current_effect = $row['mp_anus_changes'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_anus_changes">';
                                                $data .= '<span class="se_title">Changes in the anus</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I have pain in my anus or occasional urgency to stool but little or no stool comes out)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I have persistent pain in the anus with ulceration or persistent bleeding, tightness of the anus)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have uncontrollable stooling and pain; heavy bleeding, complete obstruction of the anus)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //ANUS BLOOD
                                            $current_effect = $row['mp_blood_from_anus'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_blood_from_anus">';
                                                $data .= '<span class="se_title">Blood from the anus</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Severe'){$data .= 'Yes';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //DIFF IN STOOLING
                                            $current_effect = $row['mp_diff_stooling'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_diff_stooling">';
                                                $data .= '<span class="se_title">Difficulty in stooling</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I stool between 3 - 4 times in a week)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I stool  between 1 - 2 times in a week)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I have not stooled for up to 10 days)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //BELLY TIGHT
                                            $current_effect = $row['mp_belly_tight'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_belly_tight">';
                                                $data .= '<span class="se_title">Belly feels full and tight</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }


                                            //STOOL LEAK
                                            $current_effect = $row['mp_stool_leak'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_stool_leak">';
                                                $data .= '<span class="se_title">Leakage of stool</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I experience occasional leakage of stool)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I experience persistent leakage of stool)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I experience complete loss of control of over leakage of stool)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //ERECTION
                                            $current_effect = $row['mp_erection'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_erection">';
                                                $data .= '<span class="se_title">Achieve and maintain erection</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //ERECTION
                                            $current_effect = $row['mp_diff_in_releases'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_diff_in_releases">';
                                                $data .= '<span class="se_title">Difficulty in releasing sperm</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //DESCREASED DESIRE
                                            $current_effect = $row['mp_decreased_desire'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_decreased_desire">';
                                                $data .= '<span class="se_title">Decreased sexual desire</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //PAINFUL SEX
                                            $current_effect = $row['mp_painful_sex'];
                                            if($current_effect != 'None' && $current_effect != 'No' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_painful_sex">';
                                                $data .= '<span class="se_title">Painful sex</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //TIRED OR WEAK
                                            $current_effect = $row['mp_tired_or_weak'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-'.$current_effect.'" data-type="mp_tired_or_weak">';
                                                $data .= '<span class="se_title">Tired / Weak</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Mild (I do not feel better more than usual)';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Moderate (I feel worse than usual)';}
                                                        else if($current_effect == 'Severe'){$data .= 'Severe (I feel much worse than usual)';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                            //NOTE
                                            $current_effect = $row['mp_note'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_note">';
                                                $data .= '<span class="se_title">Is there any side effect or anything you would like to share?</span>';
                                                    $data .= '<span class="se_status">';
                                                    $data .= $current_effect;
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }
                                            
                                            //ON CHEMO
                                            $current_effect = $row['mp_on_chemo'];
                                            if($current_effect != 'None' && $current_effect != ''){
                                                $data .= '<div class="col-12 status-Purple" data-type="mp_on_chemo">';
                                                $data .= '<span class="se_title">Are you on chemotherapy?</span>';
                                                    $data .= '<span class="se_status">';
                                                        if($current_effect == 'Mild'){$data .= 'Yes, weekly';}
                                                        else if($current_effect == 'Moderate'){$data .= 'Yes, 3 weekly';}
                                                        else if($current_effect == 'Severe'){$data .= 'Yes, monthly';}
                                                    $data .= '</span>';
                                                $data .= '</div>';
                                            }

                                        }

                                        $data .= '</div>';

                                    $data .= '</div>';
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

                                <button class="btn-success exportToExcel noprint mt-4" style="right: 16.5rem;top: 1.5rem;">Export To Spreadsheet</button>

                                <div class="row mt-5 side_effect_group_parent">


                                    <?php echo $data; ?>

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
    <script>
        $(document).ready(function(){
            const arrange = (element, parent) => {
                $(element).sort(function (a, b) {
                    var contentA = $(a).data('sort');
                    var contentB = $(b).data('sort');
                    return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
                }).appendTo(parent);
            }
            arrange('.side_effect_group', $('.side_effect_group_parent'))


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
<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset(
            $_POST['strenuous_activities'], 
            $_POST['long_walk'], 
            $_POST['short_walk_outside'], 
            $_POST['stay_in_bed'], 
            $_POST['help_with_eating'], 
            $_POST['limited_in_doing_work'],
            $_POST['limited_in_pursuing_hobbies'],
            $_POST['short_of_breath'],
            $_POST['had_pain'],
            $_POST['need_to_rest'],
            $_POST['constipated'],
            $_POST['diarrhoea'],
            $_POST['tired'],
            $_POST['pain_interfere'],
            $_POST['difficulty_in_concentrating'],
            $_POST['feel_tense'],
            $_POST['did_worry'],
            $_POST['feel_irritable'],
            $_POST['feel_depressed'],
            $_POST['difficulty_remembering_things'],
            $_POST['treatment_interfered_with_family_life'],
            $_POST['treatment_interfered_with_social_activities'],
            $_POST['financial_difficulties'],
            $_POST['overall_health'],
            $_POST['overall_quality_of_life'])
        ) {
            
            // Sanitize and validate the input data if needed
            $strenuous_activities = $_POST['strenuous_activities']; 
            $long_walk = $_POST['long_walk']; 
            $short_walk_outside = $_POST['short_walk_outside']; 
            $stay_in_bed = $_POST['stay_in_bed']; 
            $help_with_eating = $_POST['help_with_eating']; 
            $limited_in_doing_work = $_POST['limited_in_doing_work']; 
            $limited_in_pursuing_hobbies = $_POST['limited_in_pursuing_hobbies']; 
            $short_of_breath = $_POST['short_of_breath']; 
            $had_pain = $_POST['had_pain']; 
            $need_to_rest = $_POST['need_to_rest']; 
            $constipated = $_POST['constipated']; 
            $diarrhoea = $_POST['diarrhoea']; 
            $tired = $_POST['tired']; 
            $pain_interfere = $_POST['pain_interfere']; 
            $difficulty_in_concentrating = $_POST['difficulty_in_concentrating']; 
            $feel_tense = $_POST['feel_tense']; 
            $did_worry = $_POST['did_worry']; 
            $feel_irritable = $_POST['feel_irritable']; 
            $feel_depressed = $_POST['feel_depressed']; 
            $difficulty_remembering_things = $_POST['difficulty_remembering_things']; 
            $treatment_interfered_with_family_life = $_POST['treatment_interfered_with_family_life']; 
            $treatment_interfered_with_social_activities = $_POST['treatment_interfered_with_social_activities']; 
            $financial_difficulties = $_POST['financial_difficulties']; 
            $overall_health = $_POST['overall_health']; 
            $overall_quality_of_life = $_POST['overall_quality_of_life'];
            $patient_id = $_SESSION["patient_id"];

            $sql = "INSERT INTO qol (patient_id, strenuous_activities, long_walk, short_walk_outside, stay_in_bed, help_with_eating, limited_in_doing_work, limited_in_pursuing_hobbies, short_of_breath, had_pain, need_to_rest, constipated, diarrhoea, tired, pain_interfere, difficulty_in_concentrating, feel_tense, did_worry, feel_irritable, feel_depressed, difficulty_remembering_things, treatment_interfered_with_family_life, treatment_interfered_with_social_activities, financial_difficulties, overall_health, overall_quality_of_life, date_added, time_added) VALUES ('$patient_id', '$strenuous_activities', '$long_walk', '$short_walk_outside', '$stay_in_bed', '$help_with_eating', '$limited_in_doing_work', '$limited_in_pursuing_hobbies', '$short_of_breath', '$had_pain', '$need_to_rest', '$constipated', '$diarrhoea', '$tired', '$pain_interfere', '$difficulty_in_concentrating', '$feel_tense', '$did_worry', '$feel_irritable', '$feel_depressed', '$difficulty_remembering_things', '$treatment_interfered_with_family_life', '$treatment_interfered_with_social_activities', '$financial_difficulties', '$overall_health', '$overall_quality_of_life', '$serverDate', '$serverTime')";

            if($conn->query($sql) === TRUE) {
                $data = 1;
            }else{
                $data = $conn->error;
            }
            
        } else {
            // Required fields are missing in the request
            http_response_code(400); // Bad request
            $data = "Missing required fields";
        }
    } else {
        // Not a POST request
        http_response_code(405); 
        $data = "Method Not Allowed";
    }

    echo $data;

    $conn->close();

?>
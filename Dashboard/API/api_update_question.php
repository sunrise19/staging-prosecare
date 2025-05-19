<?php

    include('../../STATIC_API/Config.php');

    $data = 0;

    $id = $_REQUEST["id"];
    $user_id = $_SESSION["id"];
    $questions = $_POST['questions'];

    $sql = "SELECT * FROM questions WHERE question_id='$id' AND user_id='$user_id'";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

        $sql = "UPDATE questions SET questions='$questions' WHERE question_id='$id'";
        
        if($conn->query($sql) === TRUE) {
            $data =  1;
        }

    }

    echo $data;

    $conn->close();

?>
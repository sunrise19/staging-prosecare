<?php 

    // error_reporting(0);
    // ini_set('display_errors', 0);

    // session_start();
    // if(isset($_SESSION["user_id"])){
    //     header('location: Dashboard');
    // }else{
    //     header('location: ./Login');
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PROSE Care</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;1,500;1,700&display=swap" rel="stylesheet">
    <style>
        *,*:focus{
            font-family: 'DM Sans', sans-serif;
        }
        body{
            text-align: center;
            color: #333;
            position: absolute;
            width: 100%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        h4{
            font-size: 50px;
            margin: 0;
        }

        h1 {
            font-size: 100px;
            margin: 0;
        }

        p {
            font-size: 110px;
            font-weight: 600;
            background-image: -webkit-gradient(linear, left top, right top, from(#3f5ff6), color-stop(62%, #8dc4fa), to(#e9bbc4));
            background-image: linear-gradient(
        90deg, #3f5ff6, #8dc4fa 62%, #e9bbc4);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        a {
            text-decoration: none;
            padding: 18px 40px;
            font-size: 22px;
            background-color: #f0f3fe;
            color: #4869fe;
            display: inline-block;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h4>👋</h4>
    <h1>Welcome to </h1>
    <p>PROSE Care</p> 
    <a href="./Login">Take Me There</a>
</body>
</html>

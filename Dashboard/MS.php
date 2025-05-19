<?php 

    error_reporting(0);
    ini_set('display_errors', 0);

    session_start();
    if(!isset($_SESSION["id"])){
        header('location: ../../Login');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta charset="utf-8" />
    <title>PROSE Care Microsoft Meeting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PROSE Care " name="description" />
    <meta content="Emmanuel Prince &bull; Techvantage Innovations" name="author" />
    <link rel="shortcut icon" href="../favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="MJS/style.css" rel="stylesheet" type="text/css" />
</head>
 <style>
        *,*:focus{
            font-family: 'DM Sans', sans-serif;
        }
        body{
            text-align: center;
            color: #333;
            
            overflow-x: hidden;
        }

        .middle{
            position: absolute;
            width: 100%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        h4{
            font-size: 50px;
            margin: 40px;
        }

        h1 {
            font-size: 60px;
            margin: 0;
            background-image: -webkit-gradient(linear, left top, right top, from(#3f5ff6), color-stop(62%, #8dc4fa), to(#e9bbc4));
            background-image: linear-gradient(
        90deg, #3f5ff6, #8dc4fa 62%, #e9bbc4);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
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
            cursor: pointer;
            transition: 0.3s;
        }

        a:hover{
            transform: scale(1.1);
            background-color: #4869fe47;
        }

        input[type="email"] {
            display: block;
            margin: 40px auto 0;
            width: 90%;
            max-width: 400px;
            padding: 15px 11px;
            font-size: 20px;
            text-align: center;
            border: 1px solid #000;
        }

        #video_conf_frame {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: calc(100vh - 70px);
        }

        .dismiss {
            background: #000;
            position: fixed;
            color: #fff;
            font-size: 33px;
            width: 50px;
            height: 50px;
            line-height: 50px;
            border-radius: 50px;
            transform: rotate(45deg) translateX(-50%);
            bottom: -8px;
            left: 50%;
            padding-right: 1px;
            display: none;
            cursor: pointer;
        }

        .files_list{
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            display: none;
        }

        .file_size {
            font-size: 16px;
            float: right;
            margin-top: 4px;
        }

        a.file_row {
            display: block;
            text-align: left;
            font-size: 19px;
            margin-top: 20px;
        }

        .file_name {
            width: calc(100% - 70px);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
            margin: 0;
            transform: translateY(3px);
        }

        img.mlogo {
            position: fixed;
            width: 100%;
            height: 36px;
            object-fit: contain;
            object-position: center;
            left: 0;
            bottom: 30px;
            background: #fff;
        }
        #primary{
            display: none;
        }
   
        .logout{
            font-size: 20px;
            margin: 50px 0 0;
            text-decoration: underline;
            color: #f44336;
            display: none;
            cursor: pointer;
        }

        .modal_back {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000000bf;
            display: none;
        }

        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 90%;
            max-width: 435px;
            height: 232px;
            background: #fff;
            display: block;
            border-radius: 10px;
            transform: translate(-50%, -50%);
            text-align: center;
        }


        .loading {
            display: inline-block;
            width: 70px;
            height: 70px;
            border: 6px solid #000;
            border-radius: 200px;
            border-bottom-color: transparent;
            border-top-color: transparent;
            margin-top: 50px;
            animation: spin 0.5s linear infinite
        }

        span.load_text {
            display: block;
            font-size: 26px;
            margin-top: 20px;
        }

        @keyframes spin{
            from{
                transform: rotate(0deg)
            }
            to{
                transform: rotate(360deg)
            }
        }

    </style>

<body>

    <div class="middle">
        <h4>Hey 👋</h4>
        <h1>Welcome to PROSE Care Meeting</h1>
        <!-- <input type="email" placeholder="Enter your email address"> -->
        <!-- <p>PROSE Care</p>  -->
        <a id="primary"></a>
        <span class="logout" onclick="signOut();">Sign Out</span>
        <div class="files_list"></div>
    </div>
    <img src="MJS/ms.jpg" alt="" class="mlogo">

    <div class="modal_back">
        <div class="modal">
            <div class="loading"></div>
            <span class="load_text"></span>
        </div>
    </div>
  

  <!-- <main id="main-container" role="main" class="container">

  </main> -->

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Moment.js -->
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
  <script src="https://momentjs.com/downloads/moment-timezone-with-data-10-year-range.js"></script>

  <!-- MSAL -->
  <script src="https://alcdn.msauth.net/browser/2.16.1/js/msal-browser.min.js" integrity="sha384-bPBovDNeUf0pJstTMwF5tqVhjDS5DZPtI1qFzQI9ooDIAnK8ZCYox9HowDsKvz4i" crossorigin="anonymous"></script>

  <!-- Graph SDK -->
  <script src="https://cdn.jsdelivr.net/npm/@microsoft/microsoft-graph-client@3.0.0/lib/graph-js-sdk.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@microsoft/microsoft-graph-client@3.0.0/lib/graph-client-msalBrowserAuthProvider.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="MJS/config.js"></script>
  <script src="MJS/timezones.js"></script>
  <script src="MJS/ui.js"></script>
  <script src="MJS/graph.js"></script>
  <script src="MJS/auth.js"></script>
</body>
</html>
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
    <meta charset="utf-8" />
    <title><?php echo $TITLE;?> &bull; PROSE Care</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PROSE Care" name="description" />
    <meta content="Emmanuel Prince &bull; Techvantage Innovations" name="author" />
    <link rel="shortcut icon" href="../favicon.png">
    <link rel="stylesheet" href="../assets/libs/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/libs/owl.carousel/assets/owl.theme.default.min.css">
    <link href="Commons/bootstrap.css" rel="stylesheet" type="text/css" />    
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/sweetalert.css"  rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="../assets/css/oncopadi.css" rel="stylesheet" type="text/css" />
    <link href="Commons/jquery-ui.css" rel="stylesheet" type="text/css" />    
</head>

<style>
    *,*:focus{
        font-family: Poppins, Helvetica, "sans-serif" !important;
    }
    button {
        border: none !important;
        padding: 9px 21px !important;
        border-radius: 7px !important;
        font-size: .8125rem !important;
    }

    .swal2-actions.swal2-loading button {
        border: .25em solid transparent !important;
        border-left-color: #4CAF50 !important;
        border-right-color: #2196F3 !important;
        border-radius: 100px !important;
        width: 50px !important;
        height: 50px !important;
        animation: swal2-rotate-loading 0.7s linear 0s infinite normal !important;
    }

    .product-results {
        margin-bottom: 20px;
        background: #fafafa;
        border: 2px dashed #ddd;
        border-radius: 10px;
    }

    .search_result {
        cursor: pointer;
        padding: 12px 20px;
    }

    .search_result:hover{
        background: #eee;
    }

    .v-align-middle img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        transition: 0.5s;
    }
    
    .v-align-middle img:hover{
        transform: scale(3)
    }

    .separator {
        width: 100%;
        border-top: 1px dashed #eee;
        margin: 30px 0 23px 0;
    }
    
    p{text-transform: capitalize;}

    .card{
        border-radius: 15px;
    }
        .v-align-middle.focused {
        border: 2px solid #2196f3 !important;
        background: #fff
    }

    .ef{
        cursor: text;
        outline: none !important;
        text-transform: unset !important;
    }

    .ed {
        padding: 0 11px;
        width: auto;
    }

    td p{
        margin: 0;
    }

    body {
        background-color: #fff;
    }

    body[data-sidebar=dark] .vertical-menu {
        background: #1f1f2d;
    }

    body[data-sidebar=dark] .navbar-brand-box {
        background: #1b1b27;
    }

    .footer {
        background: #fff;
        box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);
    }

    .card-body {
        padding: 1.5rem;
        overflow-x: auto;
    }

    .modal {
        background: #000000ba;
    }

    .sweetselect {
        width: 100%;
        padding: 12px 15px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        outline: none;
        font-size: 14px;
        -webkit-appearance: none !important;
    }

    .noselect {
        cursor: default !important;
        pointer-events: none !important;
        -webkit-touch-callout: none !important; /* iOS Safari */
            -webkit-user-select: none !important; /* Safari */
            -khtml-user-select: none !important; /* Konqueror HTML */
            -moz-user-select: none !important; /* Old versions of Firefox */
                -ms-user-select: none !important; /* Internet Explorer/Edge */
                    user-select: none !important; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
    }

    .swal2-icon {
        margin: 0 0 9px 0 !important;
        transform: scale(0.6) !important;
    }
    .swal2-title {
        font-size: 20px !important;
    }

    #swal2-content {
        font-size: 16px !important;
        margin-top: 8px !important;
        color: #777 !important;
    }

    .swal2-container.swal2-shown {
        background-color: #00000095;
    }

    .tiny_image {
        display: block;
        width: 100px;
        height: 100px;
        object-fit: contain;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        user-select: none !important;
        pointer-events: none !important;
    }

    .tiny_td::before {
        display: none !important;
    }

    .verified,.status {
        display: inline-block;
        padding: 1px 13px;
        border-radius: 12px;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px;
        cursor: pointer;
        transition: 0.3s;
    }
    .verified:hover{
        transform: scale(1.3)
    }

    .verified.true,.status.approved{
        background: #E8F5E9;
        color: #4CAF50;   
    }

    .status.pending{
        background: #fffde7;
        color: #ff9800;   
    }

    .verified.false,.status.declined{
        background: #FFF8E1;
        color: #FF9800;   
    }

    .dbl{
        cursor: pointer
    }

    .location_item {
        display: inline-block;
        background: #eee;
        padding: 8px 14px;
        margin: 7px 15px 10px 0;
        border-radius: 9px;
        border: 1px solid #ced4da;
        cursor: pointer;
    }
    .location_item.active {
        background: #4CAF50;
        color: #fff;
        border-color: #388E3C;
    }

    .log-authentication{color: #4caf50}
    .log-deauthentication{color: #f44336}
    .log-order{color: #2196f3}
    .log-view{color: #ff9800}

    @media print {
        .noprint{
            display:none;
        }
    }

    button[type="button"][class="close"][data-dismiss="modal"][aria-label="Close"]{
        transform: scale(2) translate(-2px, 7px);
    }

    .align-center{
        text-align: center
    }

    #sidebar-menu ul li a {
        display: block;
        padding: 20px 0 20px 58px;
        margin: 5px 0;
        color: #000;
        position: relative;
        font-size: 15px;
        /* -webkit-transition: all .4s; */
        /* transition: all .4s; */
    }

    #sidebar-menu ul li a img{
        margin-right: 16px
    }
    

    #sidebar-menu {
        padding: 8px 0 30px;
    }

    .btn-label {
        position: relative;
        padding-left: 44px !important;
    }

    .btn-label .label-icon {
        position: absolute;
        width: 32px;
        height: 100%;
        left: 0;
        top: 0;
        background-color: rgba(255,255,255,.1);
        border-right: 1px solid rgba(255,255,255,.1);
        font-size: 16px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .dropdown-menu.shown {
        display: block !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        animation: none !important;
    }

    .do-logout{
        cursor: pointer;
    }

    #vertical-menu-btn{
        display: none;
    }

    @media (max-width: 600px) {
        #vertical-menu-btn{
            display: block;
        }
        .navbar-header .dropdown .dropdown-menu{
            right: 0% !important;
            left: unset !important;
            transform: none !important;
        }
    }

    th.grp {
        font-size: 27px;
        color: #8d2d90 !important;
        margin-top: 40px;
    }

    

    th.subgroup {
        font-size: 20px;
        margin-top: 20px;
        display: inline-block;
        color: #333 !important;
    }

    th.grp.e,th.subgroup.e {
        background: transparent;
    }

    .main-content{
        position: relative;
        z-index: 9999;
    }

    .page-content{
        padding: 45px
    }

    .app-search .form-control{
        background: transparent;
        border: 1px solid #8D2D921F;
        height: 57px;
        font-size: 15px;
        margin: -20px 0 15px 0;
        padding-left: 90px;
    }

</style>

<body data-sidebar="light" <?php if(isset($_SESSION["sidebar"])){if($_SESSION["sidebar"] == "collapsed"){echo 'class="sidebar-enable vertical-collpsed"';}}?>>

    <!-- Begin page -->
    <div id="layout-wrapper">    


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex" style="
                        width: 300px;
                        align-items: center;
                        justify-content: center;
                        background: #f9f9f9;
                        border-right: 2px solid #e3e3e4;
                    ">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a class="logo logo-dark" style="display: block;width: 100%;height: 69px;">
                            <img src="../assets/images/ProseCareLogo.png" style="width: 100%;height: 55px;object-fit: contain;">
                            <!-- <img src="../assets/images/oncopadi_logo.svg" style="width: 83%;height: 69%;object-fit: contain; "> -->
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <!-- <i class="bx bx-menu-alt-left collapsible" style="font-size: 20px"></i> -->
                        <span><b>MENU</b></span>
                    </button>

                    <?php 

                        $pages = array("Home");

                        if(in_array($TITLE, $pages) === true && false){

                            echo '<form class="app-search d-none d-lg-block" style=" min-width: 320px; "> 
                                    <div class="position-relative"> 
                                        <input type="text" class="form-control header-search" placeholder="Search '.$TITLE.'"> 
                                        <span class="bx bx-search-alt"></span> 
                                    </div> 
                                </form>
                                
                                <script src="../assets/libs/jquery/jquery.min.js"></script>
                                
                                <script>
                                    $(".header-search").keyup(function(){

                                        var query = $(this).val().toLowerCase();
                    
                                        if(query != ""){
                                            
                                            $("tbody tr").hide()
                    
                                            $(".v-align-middle").find("p").each(function(){
                                                if($(this).text().toLowerCase().indexOf(query) > -1 || $(this).find("span").text().toLowerCase().indexOf(query) > -1){
                                                    $(this).parent().parent().show();
                                                }
                                            })
                    
                                        }else{
                                            $("tbody tr").show()
                                        }
                                    })
                                </script>';
                        }

                    
                    ?>
                    

                </div>

                <div class="d-flex">

                    <!-- <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->

                    <!-- <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div> -->


                    <div class="dropdown d-inline-block">
                        <!-- <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-bell"></i>
                            <i class="bx bx-bell bx-tada"></i>
                            <span class="badge bg-danger rounded-pill">3</span>
                        </button> -->
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown" style="">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                       <a href="#!" class="small" key="t-view-all"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar="init" style="max-height: 230px;">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" style="height: auto; padding-right: 0px; padding-bottom: 0px; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                    
                                                    <!-- <a href="javascript: void(0);" class="text-reset notification-item">
                                                        <div class="d-flex">
                                                            <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1">James Lemire</h6>
                                                                <div class="font-size-12 text-muted">
                                                                    <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a> -->
                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none; height: 143px;"></div>
                                </div>
                            </div>
                            <!-- <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>
                                </a>
                            </div> -->
                        </div>
                    </div>
                        
                    <div class="dropdown d-inline-block" style="display: none !important">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="IMG/<?php echo $_SESSION["photo"]; ?>" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 auth_name"><?php echo $_SESSION["name"] ; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="./Profile-<?php echo strtoupper($_SESSION["type"])?>"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item text-danger do-logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                    </div>

                </div>
            </div>
            
        </header>
        
        <script>
            function updateURLWithSort(sortValue) {
                // Get the current URL
                const currentURL = window.location.href;

                // Create a URL object from the current URL
                const url = new URL(currentURL);

                // Get the base URL without query params
                const baseURL = url.origin + url.pathname;

                // Create a new URL object using the base URL
                const newURL = new URL(baseURL);

                // Get all existing search parameters and add them to the new URL
                url.searchParams.forEach((value, key) => {
                    newURL.searchParams.set(key, value);
                });

                // Parse the sort value and determine the new order
                const sortArray = sortValue.split(' ');
                const currentSortValue = url.searchParams.get('SORT') || '';
                const newOrder = currentSortValue.includes('DESC') ? 'ASC' : 'DESC';

                // Create the new sort value
                const newSortValue = `${sortArray[0]} ${newOrder}`;

                // Update the 'SORT' query parameter with the new sort value
                newURL.searchParams.set('SORT', newSortValue);

                // Replace the current URL with the new URL without adding it to the browser history
                window.location.replace(newURL.toString());
            }

        </script>
        
        <?php include('sidebar.php');?>    
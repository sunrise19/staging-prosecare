<?php 
    echo '<style>
            li.mm-active, li.mm-active .active {
                background: #8D2D920F !important;
                color: #8D2D92 !important;
                font-weight: 500;
                border-right: 2px solid;
            }
            #sidebar-menu ul li a i{
                padding: 3px 4px !important;
                background: #F9D7EF;
                border-radius: 14px !important;
                border: 5px solid #f9d7f0;
                margin-right: 9px;
                color: #8d2d90;
            }
            #sidebar-menu ul li a span{
                transform: translateY(2px);
                display: inline-block;
            }
            li.mm-active a i, li.mm-active.active i, .mm-active .active i{ 
                color: #8D2D91 !important;
                background: #fff !important;
                border-color: #fff !important
            }
            .mm-active .active, .mm-active .active i, .S-'.str_replace(' ', '', $TITLE).' a, .S-'.str_replace(' ', '', $TITLE).' a i, .S-'.str_replace(' ', '', $TITLE).' a span {
                /*color: #fff !important*/
            }
          </style>';
?>

    <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu pt-5">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    

                    <ul class="metismenu list-unstyled" id="side-menu">

                        <!-- <li class="menu-title">Menu</li> -->
                        
                        <?php 
                            if(isset($_SESSION["hcp"])){

                                echo '<li class="S-Home">
                                        <a href="./HCP-Home" class=" waves-effect">
                                            <img src="../assets/images/house.svg"/>
                                            <!--<i class="bx bxs-home-circle"></i>-->
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="S-Patients">
                                        <a href="./Patients" class=" waves-effect">
                                            <img src="../assets/images/group.svg"/>
                                            <!--<i class="bx bx-group"></i>-->
                                            <span>Patients</span>
                                        </a>
                                    </li>
                                    <li class="S-Appointments">
                                        <a href="./Appointments" class=" waves-effect">
                                            <img src="../assets/images/alarm.svg"/>
                                            <span>Appointments</span>
                                        </a>
                                    </li>
                                    <li class="S-Chat">
                                        <a href="./Chat"  class="waves-effect">
                                            <img src="../assets/images/chat.svg"/>
                                            <span>Chat</span>
                                        </a>
                                    </li>
                                    <li class="S-Resources">
                                        <a href="./Resources"  class="waves-effect">
                                            <img src="../assets/images/file.svg"/>
                                            <span>Resources</span>
                                        </a>
                                    </li>
                                    <li class="S-Support">
                                        <a href="./Support"  class="waves-effect">
                                            <img src="../assets/images/headphones.svg"/>
                                            <span>Support</span>
                                        </a>
                                    </li>
                                    <li class="S-Profile">
                                        <a href="./Profile-HCP"  class="waves-effect">
                                            <img src="../assets/images/user_03.svg"/>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    ';
                            }
                            else if(isset($_SESSION["hospital"])){

                                echo '<li class="S-Hospital-Home">
                                        <a href="./Hospital-Home" class=" waves-effect">
                                            <img src="../assets/images/house.svg"/>
                                            <!--<i class="bx bxs-home-circle"></i>-->
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="S-Doctors">
                                        <a href="./Doctors" class=" waves-effect">
                                            <img src="../assets/images/group.svg"/>
                                            <span>Doctors</span>
                                        </a>
                                    </li>
                                    <li class="S-Hospital-Patients">
                                        <a href="./Hospital-Patients" class=" waves-effect">
                                            <img src="../assets/images/group.svg"/>
                                            <span>Patients</span>
                                        </a>
                                    </li>
                                    <li class="S-Wallet">
                                        <a href="./Wallet" class=" waves-effect">
                                            <img src="../assets/images/wallet.svg"/>
                                            <span>Wallet</span>
                                        </a>
                                    </li>
                                    <li class="S-Support">
                                        <a href="./Support"  class="waves-effect">
                                            <img src="../assets/images/headphones.svg"/>
                                            <span>Support</span>
                                        </a>
                                    </li>
                                    <li class="S-Account">
                                        <a href="./Account"  class="waves-effect">
                                            <img src="../assets/images/user_03.svg"/>
                                            <span>Account</span>
                                        </a>
                                    </li>
                                    ';
                            }
                            else if(isset($_SESSION["studycoordinator"])){
                                echo '  <li class="S-Home">
                                            <a href="./Study-Coordinator-Home" class=" waves-effect">
                                                <img src="../assets/images/house.svg"/>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="S-Patients">
                                            <a href="./Patients" class=" waves-effect">
                                                <img src="../assets/images/group.svg"/>
                                                <span>Patients</span>
                                            </a>
                                        </li>
                                        <li class="S-HCP">
                                            <a href="./HCP" class=" waves-effect">
                                                <img src="../assets/images/group.svg"/>
                                                <span>HC Professionals</span>
                                            </a>
                                        </li>
                                        <li class="S-Chat">
                                            <a href="./Chat"  class="waves-effect">
                                                <img src="../assets/images/chat.svg"/>
                                                <span>Chat</span>
                                            </a>
                                        </li>
                                        <li class="S-News">
                                            <a href="./News"  class="waves-effect">
                                                <img src="../assets/images/file.svg"/>
                                                <span>News</span>
                                            </a>
                                        </li>';
                            }
                            else if(isset($_SESSION["patient"])){
                                echo '<li class="S-Home">
                                            <a href="./Home" class=" waves-effect">
                                                <img src="../assets/images/house.svg"/>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>

                                        <li class="S-SideEffects">
                                            <a href="./SideEffects" class=" waves-effect">
                                                <img src="../assets/images/health.svg"/>
                                                <span>Side Effects</span>
                                            </a>
                                        </li>

                                        <li class="S-Chat">
                                            <a href="./Chat"  class="waves-effect">
                                                <img src="../assets/images/chat.svg"/>
                                                <span>Chat</span>
                                            </a>
                                        </li>

                                        <li class="S-Appointments">
                                            <a href="./Appointments" class=" waves-effect">
                                                <img src="../assets/images/alarm.svg"/>
                                                <span>Appointments</span>
                                            </a>
                                        </li>
                                        
                                        <li class="S-Resources">
                                            <a href="./Resources" class=" waves-effect">
                                                <img src="../assets/images/file.svg"/>
                                                <span>Resources</span>
                                            </a>
                                        </li>
                                        <li class="S-Support">
                                            <a href="./Support"  class="waves-effect">
                                                <img src="../assets/images/headphones.svg"/>
                                                <span>Support</span>
                                            </a>
                                        </li>
                                        <li class="S-Profile">
                                            <a href="./Profile-PATIENT"  class="waves-effect">
                                                <img src="../assets/images/user_03.svg"/>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        ';
                            }
                            else if(isset($_SESSION["superadmin"])){
                                echo '<li class="S-SuperAdmin-Home">
                                        <a href="./SuperAdmin-Home" class=" waves-effect">
                                            <img src="../assets/images/house.svg"/>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="S-Hospitals">
                                        <a href="./Hospitals" class=" waves-effect">
                                            <img src="../assets/images/hospital.svg"/>
                                            <span>Hospitals</span>
                                        </a>
                                    </li>
                                    <li class="S-Doctors">
                                        <a href="./Doctors" class=" waves-effect">
                                            <img src="../assets/images/group.svg"/>
                                            <span>HCPs</span>
                                        </a>
                                    </li>
                                    <li class="S-Hospital-Patients">
                                        <a href="./Hospital-Patients" class=" waves-effect">
                                            <img src="../assets/images/group.svg"/>
                                            <span>Patients</span>
                                        </a>
                                    </li>
                                    <li class="S-Resources">
                                        <a href="./Resources" class=" waves-effect">
                                            <img src="../assets/images/file.svg"/>
                                            <span>Resources</span>
                                        </a>
                                    </li>
                                    <li class="S-Chat">
                                        <a href="./Chat"  class="waves-effect">
                                            <img src="../assets/images/chat.svg"/>
                                            <span>Support</span>
                                        </a>
                                    </li>
                                    <li class="S-AdminSettings">
                                        <a href="./AdminSettings"  class="waves-effect">
                                            <img src="../assets/images/user_03.svg"/>
                                            <span>Admin Settings</span>
                                        </a>
                                    </li>
                                    ';
                            }
                        ?>
                        
                        <!-- <li class="menu-title">Account</li> -->

                        <?php 
                            if(!isset($_SESSION["studycoordinator"])){
                                echo '<!-- <li class="S-Settings">
                                    <a href="./Settings"  class="waves-effect">
                                        <img src="../assets/images/user_03.svg"/>
                                        <span>Settings</span>
                                    </a>
                                </li> -->';
                            }
                        ?>
                        
                        
                        
                        <li class="do-logout">
                            <a class="waves-effect">
                                <img src="../assets/images/Log_Out.svg"/>
                                <span style="color: #f44336">Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
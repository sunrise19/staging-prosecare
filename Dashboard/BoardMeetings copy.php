<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Board Meetings"; 
    include('Commons/header.php');  
?>
    <style id="dynamic_style"></style>

    <!-- <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.0.1/css/bootstrap.css" /> -->
	<!-- <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.0.1/css/react-select.css" /> -->

    <style>

        #zmmtg-root {
            display: none;
        }

        .shower {
            width: 200px;
            position: absolute;
            right: 30em;
            top: 26px;
            font-weight: 500;
        }

        .form-control.error,.form-select.error {
            border-color: #f44336;
        }

        .blue{
            background: #556ee6;
        }
        .blue:hover,.blue:focus{
            background: #3452e1;
        }
        

        .input_item.picked,.input_item.picked:hover {
            color: #fff;
            background-color: #34c38f;
        }

        .input_item {
            background: #eee;
            display: none;
            padding: 9px 18px;
            margin: 0 5px 13px 0;
            border-radius: 9px;
            cursor: pointer;
            transition: 0.3s;
        }

        .input_item:hover {
            background: #ddd;
        }

        .output {
            background: #fff;
            border: 1px solid #ced4d9;
            border-radius: 5px;
            padding: 12px 10px;
            position: relative;
            overflow: hidden;
        }

        .output_dropdown {
            color: #000;
            font-size: 22px;
            position: absolute;
            right: 6px;
            background: #eee;
            padding: 4px;
            border-radius: 3px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .output_dropdown:hover{
            background: #ddd
        }

        div.input {
            border: 1px solid #ced4d8;
            padding: 12px 12px 0;
            margin-top: -3px;
            z-index: 1;
            position: relative;
            background: #fff;
            border-radius: 0 0 5px 5px;
            border-top-style: dashed;
        }

        .output_data {
            display: inline-block;
            background: #eee;
            font-size: 12px;
            padding: 3px 6px;
            margin-right: 10px;
            border-radius: 8px;
        }

        .output_contents {
            white-space: nowrap;
            overflow: auto;
            position: absolute;
            top: calc(50% - 12px);
            width: calc(100% - 58px);
            padding-bottom: 19px;
            color: #495057;
        }

        .remove_data {
            background: #ccc;
            margin-left: 6px;
            font-size: 14px;
            transform: translateY(2px);
            cursor: pointer;
            border-radius: 4px;
        }

        .remove_data:hover {
            background: #f44336;
            color: #fff
        }

        .email_input {
            width: 100%;
            border: none;
            outline: none !important;
            margin-bottom: 10 px;
            border: 1px dashed #ccc;
            padding: 7px 8px;
            border-radius: 5px;
            margin-bottom: 10px
        }

        table{
            font-size: 14px !important;
        }

        .modal-body .form-group {
            margin-bottom: 6px;
            margin-top: 25px;
        }

        .modal-body .form-group:first-of-type {
            margin-top: 0;
        }

        .modal-body .form-group.col-6:first-of-type {
            margin-top: 25px !important;
        }

        .sweetselect {
            font-size: 13px;
        }

        .table thead th {
            font-size: 13px;
        }

        body{
            font-size: .8125rem !important;
            font-weight: 400 !important;
        }
    </style>

    <!-- ADD MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Board Meeting</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <div class="form-group form-group-default">
                    <label>Title</label>
                    <input type="text" placeholder="" class="form-control" id="name">
                </div>
                <div class="form-group form-group-default">
                    <label>Date</label>
                    <div class="input-group" id="datepicker1">
                        <input id="date" type="text" class="form-control" placeholder="" data-date-format="dd MM, yyyy" data-date-container="#datepicker1" data-provide="datepicker" data-date-autoclose="true">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-group-default col-6">
                        <label>Start Time</label>
                        <div class="input-group" id="timepicker" >
                            <input id="time" type="text" class="form-control" data-provide="timepicker">
                        </div>
                    </div>
                    <div class="form-group form-group-default col-6">
                        <label>End Time</label>
                        <div class="input-group" id="endtimepicker">
                            <input id="endtime" type="text" class="form-control" data-provide="timepicker">
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-default">
                    <label>Meeting Description</label>
                    <textarea class="form-control" id="description" rows="5" style="resize:none"></textarea>
                </div>
                <div class="form-group form-group-default">
                    <label>Reminder</label>
                    <select id="reminder" class="form-select sweetselect" style=" padding: 11.3px 10px; ">
                        <option disabled selected>Select an option</option>
                        <option value="none">None</option>
                        <option value="15 Minutes">15 Minutes before time</option>
                        <option value="20 Minutes">20 Minutes before time</option>
                        <option value="25 Minutes">25 Minutes before time</option>
                        <option value="30 Minutes">30 Minutes before time</option>
                        <option value="1 Hour">1 Hour before time</option>
                    </select>
                </div>
                <div class="form-group form-group-default">
                    <label>Access Type</label>
                    <select id="access_type" class="form-select sweetselect" style=" padding: 11.3px 10px; ">
                        <option disabled selected>Select an option</option>
                        <option value="Private Only">Private Only</option>
                        <option value="Private Only">Private Only</option>
                    </select>
                </div>
                <div class="form-group form-group-default">
                    <label>Add Chairpersons Email</label>
                    <div class="output">None added
                        <div class="output_contents" id="chairpersons_email"></div>
                        <div class="output_dropdown bx bx-chevron-down"></div>
                    </div>
                    <div class="input" style="display: none">
                        <?php 

                            include('../STATIC_API/Config.php');

                            $UID = $_SESSION["id"];
                            
                            $sql = "SELECT * FROM users WHERE user_id !='$UID' ORDER BY email";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while($row = $result->fetch_assoc()) {
                                    echo '<div class="input_item" data-id="'.$row['user_id'].'">'.$row['email'].'</div>';
                                }

                            }
                        ?>
                        <br>
                        <input type="email" class="email_input" placeholder="Enter email address or Type to search">
                    </div>
                </div>
                <div class="form-group form-group-default">
                    <label>Add Participants Email</label>
                    <div class="output">None added
                        <div class="output_contents" id="participants_email"></div>
                        <div class="output_dropdown bx bx-chevron-down"></div>
                    </div>
                    <div class="input" style="display: none">
                        <?php 

                            include('../STATIC_API/Config.php');

                            $UID = $_SESSION["id"];
                            
                            $sql = "SELECT * FROM users WHERE user_id !='$UID' ORDER BY email";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while($row = $result->fetch_assoc()) {
                                    echo '<div class="input_item" data-id="'.$row['user_id'].'">'.$row['email'].'</div>';
                                }

                            }
                        ?>
                        <br>
                        <input type="email" class="email_input" placeholder="Enter email address or Type to search">
                    </div>
                </div>
                <div class="form-group form-group-default">
                    <label>Add Patients Email</label>
                    <div class="output">None added
                        <div class="output_contents" id="patients_email"></div>
                        <div class="output_dropdown bx bx-chevron-down"></div>
                    </div>
                    <div class="input" style="display: none">
                        <?php 

                            include('../STATIC_API/Config.php');

                            $UID = $_SESSION["id"];
                            
                            $sql = "SELECT * FROM users WHERE user_id !='$UID' ORDER BY email";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while($row = $result->fetch_assoc()) {
                                    echo '<div class="input_item" data-id="'.$row['user_id'].'">'.$row['email'].'</div>';
                                }

                            }
                        ?>
                        <br>
                        <input type="email" class="email_input" placeholder="Enter email address or Type to search">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="add-data">Add Board Meeting</button>
            </div>
        </div>
        </div>
    </div>
    <!-- END OF ADD MODAL -->

    <!-- EDIT MODAL -->
    <!-- Removed for security reasons -->
    <!-- END OF EDIT RECEIPT MODAL -->



        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18 snt">Board Meetings</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a>Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?php echo $TITLE; ?></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->                    
                    
                    <div class="row">
                        <div class="col-12 table-col">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-4 current-state">All Entries</p>
                                    <select class="sweetselect shower">
                                        <option value="all">Show All</option>
                                        <option value="pending">Show Pending</option>
                                        <option value="upcoming">Show Upcoming</option>
                                        <option value="ongoing">Show Ongoing</option>
                                        <option value="completed">Show Completed</option>
                                    </select>
                                    <button id="refresh" class="btn-primary blue btn-label" style="position: absolute;right: 16rem;top: 1.5rem;"><i class="bx bx-rotate-right label-icon"></i>Refresh</button>
                                    <button class="btn-success btn-label" data-toggle="modal" data-target="#addModal" style="position: absolute;right: 2rem;top: 1.5rem;"><i class="bx bx-plus label-icon"></i>Create Board Meeting</button>
                                    <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 80px">NO.</th>
                                                <th>MEETING ID</th>
                                                <th>MEETING TITLE</th>
                                                <th>DATE</th>
                                                <th>START TIME</th>
                                                <th>END TIME</th>
                                                <th style=" width: 140px; ">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="main_output">
                                            <tr>
                                                <td></td>
                                                <td>Loading...</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

    <div id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>
    
    <?php include('Commons/footer.php');?>
    
    <!-- For either view: import Web Meeting SDK JS dependencies -->
	<script src="https://source.zoom.us/2.0.1/lib/vendor/react.min.js"></script>
	<script src="https://source.zoom.us/2.0.1/lib/vendor/react-dom.min.js"></script>
	<script src="https://source.zoom.us/2.0.1/lib/vendor/redux.min.js"></script>
	<script src="https://source.zoom.us/2.0.1/lib/vendor/redux-thunk.min.js"></script>
	<script src="https://source.zoom.us/2.0.1/lib/vendor/lodash.min.js"></script>
    
	<!-- For Component View -->
    <script src="https://source.zoom.us/2.0.1/zoom-meeting-embedded-2.0.1.min.js"></script>
	
	<!-- For Client View -->
	<script src="https://source.zoom.us/zoom-meeting-2.0.1.min.js"></script>
    
    <script src="JS/BoardMeetings.js"></script>


</body>

</html>
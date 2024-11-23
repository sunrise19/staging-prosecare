<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Home";
include('Commons/header.php');
include('../STATIC_API/Config.php');
$user_id = $_SESSION["id"];
$hospital_id = $_SESSION["hospital_id"];
?>

<link rel="stylesheet" href="./Commons/data-table.css">


<style>
    .table {
        margin-top: 0;
    }
    /* Customizing modal backdrop */
    .modal-backdrop {
        background-color: transparent !important;  /* Makes the background transparent */
        z-index: 1040 !important;
    }

    /* Optional: Style modal to look different if needed */
    .modal-content {
        border-radius: 10px;
        padding: 20px;
        z-index: 1050 !important; /* Ensure modal content is above backdrop */
        pointer-events: auto !important;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    #proceed {
        text-align: center;
        margin: 0 auto;
        padding: auto;
    }
</style>

<div class="main-content">

    <div class="page-content p-4" style=" padding-bottom: 0; ">
        <div class="container-fluid">

        <?php
            if (isset($_GET['payment_status'])) {
                $payment_status = $_GET['payment_status'];
                $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
                echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let message = "' . $message . '";
                        if ("' . $payment_status . '" === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Payment Successful!",
                                text: "Your payment has been successfully processed.",
                                showConfirmButton: true,
                            }).then(() => {
                                // Remove the query parameters after alert
                                const url = new URL(window.location.href);
                                url.searchParams.delete("payment_status");
                                history.replaceState(null, "", url);
                            });
                        } else if ("' . $payment_status . '" === "failed") {
                            Swal.fire({
                                icon: "error",
                                title: "Payment Failed!",
                                text: message,
                                showConfirmButton: true,
                            }).then(() => {
                                // Remove the query parameters after alert
                                const url = new URL(window.location.href);
                                url.searchParams.delete("payment_status");
                                url.searchParams.delete("message");
                                history.replaceState(null, "", url);
                            });
                        }
                    });
                </script>';
            }
        ?>





            <div class="l2r mb-5" style="gap: 30px">

                <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Hospital Dashboard</h2>

                <!-- start search -->
                <div class="search-box chat-search-box py-4" style=" padding: 0 !important; flex: 1 ">
                    <div class="position-relative">
                        <input type="text" class="form-control find_contact" placeholder="Search Patient or Doctor">
                        <i class="mdi mdi-magnify search-icon"></i>
                    </div>
                </div>
                <!-- end search -->
                <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                    <img src="../assets/images/Calendar2.svg" alt="">
                    <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                        <?php echo date("M d, Y"); ?>
                    </span>
                </div>

            </div>

            <!-- Fund Wallet Modal -->
            <div class="mt-5 modal fade" id="paystackModal" tabindex="-1" role="dialog" aria-labelledby="paystackModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paystackModalLabel">Fund Wallet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="initialize_payment.php" method="POST" id="fundWalletForm">
                                <div class="form-group">
                                    <label for="amount">Amount (in Naira):</label>
                                    <input 
                                        id="amount" 
                                        type="number" 
                                        name="amount" 
                                        class="form-control" 
                                        placeholder="Enter an amount" 
                                        required 
                                        min="10000">
                                </div>
                                <button 
                                    id="proceed" 
                                    type="submit" 
                                    class="btn btn-primary btn-lg l2r" 
                                    disabled>Pay Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">

                <div class="col-md-3 cursor-pointer" onclick="location.href = './Doctors'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">HCPs Onboarded</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM hcp WHERE hospital='$hospital_id'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_array($result);
                                        echo number_format($row[0]);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 cursor-pointer" onclick="location.href = './Patients'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Patients Onboarded</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM patients WHERE hospital_id='$hospital_id'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_array($result);
                                        echo number_format($row[0]);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 cursor-pointer" onclick="location.href = './Patients'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/group.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Active Patients</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        <?php
                                        $sql = "SELECT count(1) FROM sideeffects RIGHT JOIN patients ON sideeffects.patient_id=patients.patient_id WHERE patients.hospital_id='$hospital_id' GROUP BY sideeffects.patient_id";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_array($result);
                                        echo number_format($row[0]);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 cursor-pointer" onclick="location.href = './Wallet'">
                    <div class="card mini-stats-wid home_outlined_card">
                        <div class="card-body py-0">
                            <div class="media flex-row">
                                <div class="media-body align-items-center">
                                    <img src="../assets/images/wallet.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;">
                                    <p class="font-weight-medium font-size-14 my-3" style="color: #000; text-transform: none">Wallet Balance</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        ₦<?php echo number_format($_SESSION["wallet"]); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->

            <div class="row">

                <div class="col-md-4 cursor-pointer" onclick="window.location.href = 'Create-HCP?From=Hospital-Home'">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #8D2D9212">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="../assets/images/cnhcp.svg" style=" width: 52px; height: 52px; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Create New HCP</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 cursor-pointer" onclick="window.location.href = 'Create-Patient?From=Hospital-Home'">
                    <div class="card mini-stats-wid home_outlined_card sm" style="background: #C6F1F73D">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="../assets/images/cnpatient.svg" style=" width: 52px; height: 52px; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Add New Patient</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mini-stats-wid home_outlined_card sm cursor-pointer" style="background: #ED3F321A"  data-toggle="modal" data-target="#paystackModal">
                        <div class="card-body">
                            <div class="media flex-row align-items-center">
                                <div class="avatar-sm rounded-circle mr-4">
                                    <img src="../assets/images/fwallet.svg" style=" width: 52px; height: 52px; object-fit: contain; ">
                                </div>
                                <div class="media-body align-items-center">
                                    <p class="font-size-16 mb-0" style="color: #000; text-transform: none; font-weight: 500">Fund Wallet</p>
                                </div>
                                <img src="IMG/arrow_circle.svg" style=" width: 25px; height: 100%; object-fit: contain; ">
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-md-8 col-sm-12">

                    <div class="p-4" style="background: #F9F9F9; border-radius: 10px; border: 1px solid #0000000D">
                        <span class="section_title">Recently Added</span>
                        <table class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Full Name</th>
                                    <th>Email Address</th>
                                    <th>Profile Status</th>
                                    <th>Last Login</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $sql = "SELECT * FROM patients JOIN users ON patients.user_id=users.user_id WHERE patients.hospital_id='$hospital_id' ORDER BY patient_id DESC LIMIT 6";

                                $result = mysqli_query($conn, $sql);

                                if ($result->num_rows > 0) {

                                    $i = 0;

                                    while ($row = $result->fetch_assoc()) {

                                        echo  '
                                            <tr>
                                                <td>' . (++$i) . '</td>    
                                                <td>' . ucwords($row['first_name'] . ' ' . $row['last_name']) . '</td>    
                                                <td>' . $row['email'] . '</td>
                                                <td>' . (profileStatus($row['user_id'])) . '</td>
                                                <td>' . (timeDifference($row['last_active_date'], $row['last_active_time'])) . '</td>
                                            </tr>
                                            ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <style>
                            td {
                                font-size: 13px;
                            }
                        </style>

                    </div>

                </div>

                <div class="col-md-4 col-sm-12">

                    <div class="p-4" style="background: #F9F9F9; border-radius: 10px; border: 1px solid #0000000D; text-align: center">
                        <img src="IMG/premium2.png" alt="" style="width: 70px;">
                        <span class="section_title">Pay your Licensing Fee to <br> enjoy all features</span>
                        <div class="text-center t2b py-2" style="background: #8D2D9214; border-radius: 7px; gap: 10px">
                            <span>One time payment</span>
                            <h3 class="mb-0 text-dark">₦35,000</h3>
                        </div>
                        <button class="btn btn-lg btn-primary mt-3" style="border-radius: 30px !important; padding: 12px 30px !important">Pay Now</button>

                    </div>

                    <div class="p-4 mt-4" style="background: #F9F9F9; border-radius: 10px; border: 1px solid #0000000D; text-align: left">
                        <div class="l2r" style="gap: 10px;">
                            <img src="IMG/<?php echo $_SESSION['photo']; ?>" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 100px; border: 1px solid #8D2D922B">
                            <h3 class="font-weight-bold text-dark mb-0 flex-1"><?php echo $_SESSION['name']; ?></h3>
                        </div>
                        <hr>
                        <div class="l2r text-dark align-start" style="gap: 10px;">
                            <i class="bx bx-map font-size-18 mt-1"></i>
                            <span class="flex-1 font-size-14">
                                <?php echo $_SESSION['address'] . ', ' . $_SESSION['lga'] . ', ' . $_SESSION['state']?>
                            </span>
                        </div>
                        <div class="l2r text-dark mt-3" style="gap: 10px;">
                            <i class="bx bx-envelope font-size-18"></i>
                            <span class="flex-1 font-size-14">
                                <?php echo $_SESSION['hospital_email']?>
                            </span>
                        </div>
                        <div class="l2r text-dark mt-3" style="gap: 10px;">
                            <i class="bx bx-phone font-size-18"></i>
                            <span class="flex-1 font-size-14">
                                <?php echo $_SESSION['phone']?>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>
<!-- end main content here!!!-->


<?php
// $conn->close();
include('./Commons/footer.php');
?>
<script src="../assets/js/payout.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const amountInput = document.getElementById("amount");
        const proceedButton = document.getElementById("proceed");

        amountInput.addEventListener("input", function () {
            const amountValue = parseInt(amountInput.value, 10);

            // Enable the button if the amount is valid (>= 10,000), else disable it
            if (!isNaN(amountValue) && amountValue >= 10000) {
                proceedButton.disabled = false;
                proceedButton.classList.add("btn", "btn-primary", "btn-lg", "l2r");
            } else {
                proceedButton.disabled = true;
                proceedButton.classList.remove("btn", "btn-primary", "btn-lg", "l2r");
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.fund-wallet').click(function() {
            $('#paystackModal').modal('show');
            // Ensure the input field gets focus
            $('#paystackModal').on('shown.bs.modal', function() {
                $('input[name="amount"]').focus();
            });
        });

        // Optional: Close modal when clicking outside
        $('#paystackModal').on('click', function(event) {
            if ($(event.target).closest('.modal-dialog').length === 0) {
                $('#paystackModal').modal('hide');
            }
        });
    });

</script>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-analytics.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "AIzaSyBnp-GgL2USkqctQajLi2BTEmIXDFjpvEI",
        authDomain: "prosechat.firebaseapp.com",
        projectId: "prosechat",
        storageBucket: "prosechat.appspot.com",
        messagingSenderId: "683826061338",
        appId: "1:683826061338:web:ecf4ab47d6b866161431a3",
        measurementId: "G-SSSX3GB86Q"
    };
    firebase.initializeApp(firebaseConfig);

    firebase.analytics()

    const DB = firebase.firestore(),
        ROOMS_DB = DB.collection('rooms'),
        MESSAGES_DB = DB.collection('messages'),
        FIRE_ID = 'PROSE-<?php echo $_SESSION["id"]; ?>'

    var CHAT_IDENTIFIER = '',
        RECEIVER = '',
        fulldays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]


    $(document).ready(function() {

        ROOMS_DB
            .where('users', 'array-contains-any', [FIRE_ID])
            .where('lastSender', '!=', FIRE_ID)
            .where('read', '==', false)
            .onSnapshot((querySnapshot) => {
                let count = querySnapshot.docs.length
                $('.unread_messages').text(count)
                console.log(count)
            })

        if ($('tr').length > 10) {
            $('#sch-table').DataTable();
        }
    });
</script>




</body>

</html>
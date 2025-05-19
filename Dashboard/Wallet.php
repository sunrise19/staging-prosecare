<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$TITLE = "Wallet";
include('Commons/header.php');
if (!isset($_SESSION["superadmin"])) {
    header('location: Home');
}
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style id="dynamic_style"></style>
<style>
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

    <div class="page-content p-4">
        
        <div class="container-fluid">

            <!-- start page title -->
            <div class="l2r">
                <div class="page-title-box d-flex align-items-center justify-content-between l2r w-100">
                    <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Wallet</h2>
                    <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                        <img src="../assets/images/Calendar2.svg" alt="">
                        <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                            <?php echo date("M d, Y"); ?>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end page title -->
             
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

            <div class="col-12 px-0">
                    <div class="card mini-stats-wid home_outlined_card border-0" style="background: #8D2D9212;">
                        <div class="card-body py-0">
                            <div class="media flex-row l2r">
                                <div class="media-body align-items-center py-4">
                                    <!-- <img src="../assets/images/wallet.svg" style="background: #8D2D9217;padding: 10px;border-radius: 30px;"> -->
                                    <p class="font-weight-medium font-size-14 mb-2" style="color: #000; text-transform: none">Wallet Balance</p>
                                    <h4 class="mb-1 font-weight-bold" style="color: #57166A; font-size: 35px">
                                        ₦<?php echo number_format($_SESSION["wallet"]); ?>
                                    </h4>
                                </div>
                                <div class="l2r" style="gap: 10px">
                                    <button class="btn btn-white btn-lg l2r" style="border-radius: 30px !important; padding: 13px 24px !important; background: #fff; color: #8D2D92">
                                        <i class="bx bx-minus-circle mr-2 font-size-18"></i>
                                        Withdraw
                                    </button>
                                    <button class="btn btn-primary btn-lg l2r" style="border-radius: 30px !important; padding: 13px 24px !important"   data-toggle="modal" data-target="#paystackModal">
                                        <i class="bx bx-plus-circle mr-2 font-size-18"></i>
                                        Fund Wallet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <div class="l2r mb-4 mt-5" style="gap: 30px">
                <h2 class="mb-0 snt" style=" font-weight: 600; font-size: 22px; color: #000; ">Wallet History</h2>
                <div class="prose_dropdown l2r">
                    <select class="prose_select">
                        <option value="ASC">Newest to oldest</option>
                        <option value="DESC">Oldest to newest</option>
                    </select>
                    <i class="bx bx-chevron-down"></i>
                </div>
                

            </div>

            <div class="row main_table">
                <div class="col-12 table-col">
                    <div class="card">
                        <div class="actions_holder d-none">
                            <!-- <button class="btn-info exportToPDF noprint toggle_data" style="margin-right:10px">Hide Data</button> -->
                            <button class="btn-info noprint toggle_data" style="margin-right:10px">Toggle Data</button>
                            <button class="btn-success exportToExcel noprint" style="right: 16.5rem;top: 1.5rem;">Export To Spreadsheet</button>
                        </div>
                        <div class="card-body py-0" style="background: #F9F9F9; border: 1px solid #8D2D921F; border-radius: 10px;">

                            <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0; white-space: nowrap; background: #F9F9F9">
                                <thead>
                                    <tr>
                                        <th class="">S/N</th>
                                        <th class="">Description</th>
                                        <th class="">Type</th>
                                        <th class="">Date and Time</th>
                                        <th class="">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="main_output">
                                    <?php

                                    include('../STATIC_API/Config.php');

                                    $hospital_id = $_SESSION["hospital_id"];

                                    global $conn;

                                    $sql = "SELECT * FROM transactions WHERE hospital_id='$hospital_id'";

                                    $result = $conn->query($sql);

                                    $data = '<tr>
                                                <td>No transactions yet :/</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>';

                                    $data_count = 0;

                                    $htd = '<td style="display: none">';

                                    if ($result->num_rows > 0) {

                                        $data = '';
                                        $index = 0;

                                        while ($row = $result->fetch_assoc()) {

                                            ++$index;

                                            $data .= '<tr class="entry_row" id="' . $row['transaction_id'] . '" onclick="window.open(\'./TransactionInfo?ID=' . $row['transaction_id'] . '\', \'_self\')">
                                                            <td class="">#' . $index . '</td>
                                                            <td class="">' . $row['description'] . '</td>
                                                            <td class=""><span class="badge badge-pill badge-soft-'.($row['type'] == 'Credit' ? 'success' : 'error').' font-size-12 px-3 py-2">' . $row['type'] . '</span></td>
                                                            <td class="">' . date('F j, Y, g:i a', strtotime($row['created_at'])) . '</td>
                                                            <td class="">₦' . number_format($row['amount']) . '</td>
                                                        </tr>';
                                        }
                                    }

                              

                                    echo $data;

                                    $conn->close();

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="hcp_frame_back">
                <iframe src="" frameborder="0" allow="camera; microphone" id="hcp_frame"></iframe>
                <button class="btn-primary hcp_frame_close">&larr; Back</button>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php
        // $conn->close();
        include('./Commons/footer.php');
    ?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="Commons/excel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="JS/Patients.js"></script>

    <style>
        .swal2-styled.swal2-confirm,
        .swal2-styled.swal2-deny,
        .swal2-styled.swal2-cancel {
            background-color: #8D2D91;
        }

        .swal2-title {
            font-size: 25px !important;
        }
    </style>


    </body>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </html>
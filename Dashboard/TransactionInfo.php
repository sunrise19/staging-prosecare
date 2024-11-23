<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    $TITLE = "Transaction Details"; 
    include('Commons/header.php');  
    include('../STATIC_API/Config.php');
    if(!isset($_SESSION["superadmin"])){
        header('location: Home');
    }

    $UID = $_REQUEST["ID"];

    if(!is_numeric($UID)){
        echo "<script>window.location.href= './Patients'</script>";
        return;
    }

    $sql = "SELECT * FROM transactions WHERE transaction_id='$UID'";
    
    $result = $conn->query($sql);

    $data;

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $data = $row;
        }

    }

?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <style id="dynamic_style">
        .l2r.cell{
            justify-content: space-between;
        }
    </style>


        <div class="main-content">

            <div class="page-content p-3">
                <div class="container-fluid">

                    <i onclick="window.location.href='Wallet'" class="bx bx-left-arrow-alt mb-4" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>

                    <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Transaction Details</h2>
           
                    <div class="tab_container profile" style="display: block; max-width: 600px">

                        <div class="mt-4 t2b as_sheet">
                            <div class="l2r" style="gap: 25px">
                      
                                <div class="t2b" style="gap: 36px;">
                                    <div class="l2r" style="gap: 30px;">
                                        <div class="l2r cell">
                                            <div class="cell_title">ID</div>
                                            <div class="cell_value">#<?php echo $data['transaction_id'] ?></div>
                                        </div>
                                        <div class="l2r cell">
                                            <div class="cell_title">Description</div>
                                            <div class="cell_value"><?php echo $data['description'] ?></div>
                                        </div>
                                        <div class="l2r cell">
                                            <div class="cell_title">Type</div>
                                            <div class="cell_value"><?php echo '<span class="badge badge-pill badge-soft-'.($data['type'] == 'Credit' ? 'success' : 'error').' font-size-12 px-3 py-2">' . $data['type'] . '</span>' ?></div>
                                        </div>
                                        <div class="l2r cell">
                                            <div class="cell_title">Date and Time</div>
                                            <div class="cell_value"><?php echo date('F j, Y, g:i a', strtotime($data['created_at'])) ?></div>
                                        </div>
                                        <div class="l2r cell">
                                            <div class="cell_title">Amount</div>
                                            <div class="cell_value">₦<?php echo number_format($data['amount']) ?></div>
                                        </div>
                                        <div class="l2r cell">
                                            <div class="cell_title">Balance after transaction</div>
                                            <div class="cell_value">₦<?php echo number_format($data['current']) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      

                    </div>


                    
                    <!-- end row -->


                </div>
                <!-- container-fluid -->

            </div>
            <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>


    <style>
        .swal2-styled.swal2-confirm,.swal2-styled.swal2-deny,.swal2-styled.swal2-cancel{
            background-color: #8D2D91;
        }
        .swal2-title {
            font-size: 25px !important;
        }
    </style>

    <script>
        $('.S-Wallet').addClass('mm-active').find('a').addClass('active')
    </script>



</body>

</html>
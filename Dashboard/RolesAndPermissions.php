<?php
error_reporting(1);
ini_set('display_errors', 1);
session_start();
$TITLE = "Roles And Permissions";
include('Commons/header.php');
if (isset($_SESSION["hospital"])) {
    echo '<script>window.location.href="Hospital-Patients"</script>';
}
if (!isset($_SESSION["superadmin"])) {
    header('location: Home');
}

?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style id="dynamic_style"></style>


<div class="main-content">

    <div class="page-content p-4">
        <div class="container-fluid">

            <div class="l2r">
                <i onclick="window.location.href='./AdminSettings'" class="bx bx-left-arrow-alt mb-4" style=" cursor: pointer; background: #8D2D9217; color: #8D2D92; font-size: 23px; padding: 10px; border-radius: 50px; "></i>

                <div class="px-4 py-2" style="background: #8D2D921A; border-radius: 30px">
                    <img src="../assets/images/Calendar2.svg" alt="">
                    <span class="ml-2 text-dark font-size-14" style="font-weight: 600">
                        <?php echo date("M d, Y"); ?>
                    </span>
                </div>
            </div>

            <div class="l2r my-3">

                <h2 class="mb-0 snt" style=" font-weight: 600; color: #000; ">Roles and Permissions</h2>

                <div class="l2r" style="gap: 10px">

                    <button class="btn btn-primary btn-lg l2r" style="border-radius: 30px !important; padding: 13px 24px !important; background: #8D2D921A; color: #71207d">
                        <i class="bx bx-plus-circle mr-2 font-size-18"></i>
                        Add Permission
                    </button>

                    <button class="btn btn-primary btn-lg l2r" style="border-radius: 30px !important; padding: 13px 24px !important;">
                        <i class="bx bx-plus-circle mr-2 font-size-18"></i>
                        Add New Role
                    </button>
                </div>

            </div>

            <div class="t2b as_sheet">
                <div class="t2b" style="gap: 15px">
                    <div class="l2r role_header as_sheet p-3 align-items-center justify-content-between">
                        <span class="font-size-15">Nursing Unit</span>
                        <i class="bx bx-chevron-down font-size-18"></i>
                    </div>
                    <div class="role_content t2b  d-none">
                        <div class="role_item l2r">
                            <span>Add Admin Accounts</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Feedbacks</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Customers</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Make Withdrawals</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Roles</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add New Patient</span>
                            <div class="switch"></div>
                        </div>
                    </div>
                </div>

                <div class="t2b" style="gap: 15px">
                    <div class="l2r role_header as_sheet p-3 align-items-center justify-content-between">
                        <span class="font-size-15">Admin Unit</span>
                        <i class="bx bx-chevron-down font-size-18"></i>
                    </div>
                    <div class="role_content t2b  d-none">
                        <div class="role_item l2r">
                            <span>Add Admin Accounts</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Feedbacks</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Customers</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Make Withdrawals</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Roles</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add New Patient</span>
                            <div class="switch"></div>
                        </div>
                    </div>
                </div>

                <div class="t2b" style="gap: 15px">
                    <div class="l2r role_header as_sheet p-3 align-items-center justify-content-between">
                        <span class="font-size-15">Finance Unit</span>
                        <i class="bx bx-chevron-down font-size-18"></i>
                    </div>
                    <div class="role_content t2b d-none">
                        <div class="role_item l2r">
                            <span>Add Admin Accounts</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Feedbacks</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Customers</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Make Withdrawals</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add Roles</span>
                            <div class="switch active"></div>
                        </div>
                        <div class="role_item l2r">
                            <span>Add New Patient</span>
                            <div class="switch"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php include('Commons/footer.php'); ?>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="Commons/excel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="JS/Patients.js"></script>

    <script>
        $('.S-AdminSettings').addClass('mm-active').find('a').addClass('active')

        $('.switch').on('click', function(){
            $(this).toggleClass('active')
        })

        $('.role_header').on('click', function(){
            let t = $(this)

            t.siblings('.role_content').toggleClass('d-none')
        })
    </script>

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

    </html>
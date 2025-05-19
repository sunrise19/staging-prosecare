            <!-- <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            PROSE Care V0.0.2
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block" style="text-align: right">
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> 
                                &bull;
                                VTB from <a href="https://oncopadi.com/" target="_blank">Oncopadi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer> -->
        </div>
        <!-- end main content-->

    </div>
</div>
    <!-- END layout-wrapper -->
    
    <link href="../assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/js/pages/sweet-alerts.init.js"></script>

    <!-- Plugins js -->
    <script src="../assets/libs/dropzone/min/dropzone.min.js"></script>
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="https://prestelandpartner.com/js/components/tinymce/tinymce.min.js"></script>
    <script src="../assets/js/jquery.repeater.min.js"></script>
    <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="../assets/libs/@chenfengyuan/datepicker.min.js"></script>
    <script src="../assets/js/app.js"></script>
    
<style>
    .modal {
        z-index: 99999999999999;
    }
    .modal-backdrop{
        z-index: 99999;
    }
    .swal2-icon{
        margin: 2px auto 0 !important;
    }
</style>
    <script>

        function closeModal(){
            $('.treatment_frame').attr('src', '')
            $('.treament_modal').fadeOut()
        }

        function alertSuccess(msg, refresh){
            Swal.fire({
                title: msg,
                type: 'success',
                icon: 'success',
            }).then(()=>{
                if(refresh){
                    window.location.reload()
                }
            })
        }

        function alertError(error){
            Swal.fire({
                title: error,
                type: 'error'
            })
        }

        function log(action, type){
            $.ajax({
                type: 'POST',
                url:'./API/addLog.php?action='+encodeURIComponent(action)+'&type='+encodeURIComponent(type),
                success:function(data) {}
            })
        }

        $('.collapsible').click(function(){
            if($('body').hasClass('vertical-collpsed')){
                SetSession('sidebar', 'notcollapsed')
            }else{
                SetSession('sidebar', 'collapsed')
            }
        })

        $('.dropdown').click(function(){
            var t = $(this),
                thisMenu = t.find('.dropdown-menu'),
                allMenu = $('.dropdown-menu')

            if(thisMenu.hasClass('shown')){
                allMenu.hide().removeClass('shown')
            }else{
                allMenu.hide().removeClass('shown')
                thisMenu.addClass('shown')
            }
        })


        $('.do-logout').click(function(){
            Swal.fire({
                title:"<?php echo $_SESSION["name"];?>",
                html:"Confirm your logout from PROSE Care",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Logout",
                cancelButtonText:"Cancel",
                confirmButtonClass:"btn btn-success mt-2",
                cancelButtonClass:"btn btn-danger ml-2 mt-2",
                buttonsStyling:!1
            }).then(function(t){
                t.value? window.location.href = '../Logout'
                :t.dismiss===Swal.DismissReason.cancel
            })

        })


        $('select').each(function () {

            var d = $(this).attr('data-default'),
                found = false

            if (d != undefined) {
                $(this).find('option').attr('selected', false).each(function () {
                    if ($(this).attr('value').toLowerCase() == d.toLowerCase()) {
                        $(this).attr('selected', true)
                        found = true
                        return
                    }
                })
                if (!found) {
                    $(this).parent().parent().siblings('.other_div').show()
                    $(this).find('option[value="other"]').attr('selected', true)
                }
                $(this).html($(this).html())
            }

        })

    </script>
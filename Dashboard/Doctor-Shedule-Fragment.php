<?php 
    error_reporting(0); 
    ini_set('display_errors', 0);
    session_start(); 
    include('Commons/header.php');   
?>

<style>
    .sweetselect {
        width: 100%;
        padding: 11.05px 8px;
    }

    .centralize {
        width: 100%;
        display: block;
        height: 50px;
        text-align: center;
    }

    #page-topbar,.vertical-menu{
        display: none;
    }

    .main-content, .page-content,.container-fluid{
        margin: 0;
        padding: 0
    }

    #calendar {
        width: 100%;
    }

    .fc-timegrid-event-harness-inset .fc-timegrid-event, .fc-timegrid-event.fc-event-mirror, .fc-timegrid-more-link{
        background: #8D2D92;
        border-color: #8D2D92;
    }

    .fc .fc-toolbar-title {
        color: #000;
        font-size: 18px;
    }

    td.fc-timegrid-slot.fc-timegrid-slot-label {
    color: #14142B66;
}

.fc .fc-col-header-cell-cushion {
    color: #B1B1B1;
    font-weight: 500;
    text-transform: capitalize;
}

.fc-theme-standard td, .fc-theme-standard th{
    border: none
}

.fc .fc-timegrid-slot-minor{
    border: 0px solid
}

.fc-timegrid-slots tr:nth-child(even) {
    border: none
}
.fc-timegrid-slots tbody tr:hover,
tbody tr.fc-scrollgrid-section:hover{
    background: none !important
}

.fc .fc-scrollgrid-section, 
.fc-col-header  thead tr,
.fc-theme-standard .fc-scrollgrid{
    border: none
}
</style>

    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">
 
                <div class="row">
                    <div class="col-12">
                        
                        <?php
                            
                            include('../STATIC_API/Config.php');

                            $hcp_id = $_SESSION['hcp_id'];

                            $sql = "SELECT * FROM appointments JOIN patients on appointments.patient_id=patients.patient_id WHERE hcp_id='$hcp_id' AND status='Upcoming'";

                            $result = mysqli_query($conn, $sql);

                            $data = '';

                            $i = 0;

                            if ($result->num_rows > 0) {

                                $count = $result->num_rows;

                                while($row = $result->fetch_assoc()) {
                                    
                                    $i++;

                                    $data .= '["' . $row['date'] . ' ' . $row['time'] . '", "'.$row['first_name'] . ' ' . $row['last_name'].'"]';

                                    if($i < $count){
                                        $data .= ',';
                                    }
                                }

                            }

                            echo '<script> const appointment_dates=['.$data.']</script>';
                            
                        ?>

                        <div class="overflow-hidden profile_card">
                            <div class="card-body p-0">

                                <div class="l2r" style="align-items: start; gap: 18px;">
                                    <div class="" id="calendar">    
                                    </div>
                                    <div id="datepicker" style="margin-top: 40px"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
                    
    

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    
    <?php include('Commons/footer.php');?>
    <script src="Commons/excel.js"></script>
    <script src="JS/jquery-ui.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <script>
        $(document).ready(function(){

            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: { center: false, end: false },
                initialView: 'timeGridWeek',
                views: {
                    dayGridMonth: { // name of view
                        titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' }
                    // other view-specific options here
                    },
                    timeGridWeek: { // name of view
                        // titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' }
                        titleFormat: { year: 'numeric', month: 'long', day: 'numeric' }
                    // other view-specific options here
                    }
                }
            })

            calendar.render()

            let d = new Date()
             
            $(`th[data-date="${d.getFullYear()}-${d.getMonth()+1 < 10 ? '0'+(d.getMonth()+1) : (d.getMonth()+1)}-${d.getDate() < 10 ? '0'+d.getDate() : d.getDate()}"] a`).css('color', '#8D2D92')

            $('#datepicker').datepicker({
                dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
                minDate: new Date(),
                changeMonth: true,
                changeYear: true,
                showAnim: '',
                dateFormat: 'd M, yy',
                monthNamesShort: $.datepicker.regional["en"].monthNames,
                onChangeMonthYear: function (item) { },
                onSelect: function(thisDate) { injectDate(thisDate) }
            })


            appointment_dates.forEach(element => {
                    const   thisDate = new Date(element[0]),
                            appointmentTitle = element[1],
                            thisMonth = thisDate.getMonth(),
                            thisYear = thisDate.getFullYear(),
                            thisDay = thisDate.getDate()

                    calendar.addEvent({
                        title: appointmentTitle,
                        start: thisDate,
                        allDay: false
                    })

                })

            function injectDate(dateToInject){

                let d = new Date(dateToInject)

                /*

                calendar.removeAllEvents()

                console.log(dateToInject)

                const   selectedDate = new Date(dateToInject),
                        selectedMonth = selectedDate.getMonth(),
                        selectedYear = selectedDate.getFullYear(),
                        selectedDay = selectedDate.getDate()
                */
               
                calendar.gotoDate(d)

                $(`th[data-date] a`).css('color', '#B1B1B1')
                $(`th[data-date="${d.getFullYear()}-${d.getMonth()+1 < 10 ? '0'+(d.getMonth()+1) : (d.getMonth()+1)}-${d.getDate() < 10 ? '0'+d.getDate() : d.getDate()}"] a`).css('color', '#8D2D92')


               
            }


        })
    </script>


</body>

</html>
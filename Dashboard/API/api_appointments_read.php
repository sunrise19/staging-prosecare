<?php
    
    include('../../STATIC_API/Config.php');

    $data = 0;

    $hcp_id = $_SESSION['hcp_id'];
    $patient_id = $_SESSION['patient_id'];


    if($_SESSION['type'] == 'patient'){
        $sql = "SELECT * FROM appointments JOIN hcp on appointments.hcp_id=hcp.hcp_id WHERE patient_id='$patient_id' ORDER BY appointments.appointment_id DESC";
    }else{
        $sql = "SELECT * FROM appointments JOIN patients on appointments.patient_id=patients.patient_id WHERE hcp_id='$hcp_id' ORDER BY appointments.appointment_id DESC";
    }
                    
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

        $data = [];

        while($row = $result->fetch_assoc()) {

            $status = strtolower($row['status']);
            $dataID = 'data-id="'.$row['appointment_id'].'"';

            if($_SESSION['type'] == 'patient'){
                $senderName = 'Dr. ' . $row['first_name'] . ' ' . $row['last_name'];
                $receiverName = $_SESSION["name"];
            }else{
                $senderName = 'Dr. ' . $_SESSION["name"];
                $receiverName = $row['first_name'] . ' ' . $row['last_name'];
            }

            array_push(
                $data, 
                [
                    $status, 
                    '<div class="log_entry">
                            <div class="t2b">
                                <div class="l2r">
                                    <img class="log_entry_icon" src="IMG/bell.svg"/>
                                    '.(
                                        $_SESSION['type'] == 'patient'
                                        ?
                                        '
                                            <span class="log_text" style="text-transform: unset">Video consultation with</span>
                                            <span class="entry_logger">&nbsp; Dr. '.$row['first_name'] . ' ' . $row['last_name'].'</span>
                                        '
                                        :
                                        '
                                            <span class="entry_logger">'.$row['first_name'] . ' ' . $row['last_name'].'</span>
                                            <span class="log_text">booked an appointment</span>
                                        '
                                    ).'
                                    
                                    <span class="log_date">
                                        <div class="l2r">
                                        '.(
                                            $status == 'pending'
                                            ?
                                            (
                                                $_SESSION['type'] == 'patient'
                                                ?
                                                '
                                                    <div class="action_button cancel" '.$dataID.'>
                                                        <i class="bx bx-x"></i>
                                                        Cancel
                                                    </div>
                                                '
                                                :
                                                '
                                                    <div class="action_button accept" '.$dataID.'>
                                                        <i class="bx bx-check"></i>
                                                        Accept
                                                    </div>
                                                    <div class="action_button decline" '.$dataID.'>
                                                        <i class="bx bx-x"></i>
                                                        Decline
                                                    </div>
                                                '
                                            )
                                            :
                                            (
                                                $status == 'upcoming'
                                                ?
                                                '<a target="_blank" href="'.$VIDEO_CONFERENCING_URL.($_SESSION['type'] == 'hcp' ? '#init' : '').'?s=h'.md5($row['hcp_id']).'&r=p'.md5($row['patient_id']).'&rn='.$receiverName.'&sn='.$senderName.'">
                                                    <div class="action_button start_appointment" '.$dataID.'>
                                                        <i class="bx bx-video"></i> &nbsp;Start Consultation
                                                    </div>
                                                </a>
                                                '
                                                :
                                                (
                                                    $status == 'declined'
                                                    ?
                                                    '<div class="action_button reschedule" '.$dataID.'>
                                                        Reschedule
                                                    </div>'
                                                    :
                                                    '<div class="action_button view_report" '.$dataID.'>
                                                        View Report
                                                    </div>'
                                                )
                                                
                                            )
                                            
                                        ).'
                                            
                                        </div>
                                    </span>
                                </div>
                                <div class="entry_bottom l2r">
                                    <div class="t2b cell" style="flex: 1.5">
                                        <div class="cell_title">When</div>
                                        <div class="cell_value">' . $row['date'] . ' &bull; ' . $row['time'] . '</div>
                                    </div>
                                    <div class="t2b cell">
                                        <div class="cell_title">'.($status != 'completed' ? 'Who' : 'Duration').'</div>
                                        <div class="cell_value">'.($status != 'completed' ? $row['first_name'] . ' ' . $row['last_name'] : $row['duration']).'</div>
                                    </div>
                                    <div class="t2b cell" style=" align-items: end; ">
                                        <div class="cell_title">Agenda</div>
                                        <div class="cell_value">' . $row['agenda'] . '</div>
                                    </div>
                                </div>
                            </div>
                        </div>'
                ]
            );

        }

        $data = json_encode($data);

    }

    echo $data;
?>
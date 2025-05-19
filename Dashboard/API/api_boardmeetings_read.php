<?php

    include('../../STATIC_API/Config.php');
    
    $email = $_SESSION["email"];
    $sql_suffix = '';
    
    
    // if($_SESSION["type"] == "patient"){
    //     $sql_suffix = " WHERE patients_email LIKE '$email'";
    // }

    // $sql = 'SELECT * FROM board_meetings' . $sql_suffix;
    
    if(isset($_SESSION["superadmin"])){
        $sql = "SELECT * FROM board_meetings";
    }else{
        $sql = "SELECT * FROM board_meetings WHERE (chairpersons_email LIKE '%$email%' OR participants_email LIKE '%$email%' OR patients_email LIKE '%$email%')";
    }

    $result = $conn->query($sql);

    $data = '<tr>
             <td></td>
             <td>No meetings yet :/</td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             </tr>';

    $data_count = 0;

    $htd = '<td style="display: none">';

    if ($result->num_rows > 0) {

        $data = '';

        while($row = $result->fetch_assoc()) {
            $data .= '<tr id="'.$row['board_meeting_id'].'" data-creator="'.$row['creator_id'].'" class="data-entry '.$row['status'].'">
                      <td>'.(++$data_count).'</td>
                      <td>'.$row['meeting_id'].'</td>
                      <td>'.$row['name'].'</td>
                      <td>'.$row['date'].'</td>
                      <td>'.$row['time'].'</td>
                      <td>'.$row['end_time'].'</td>
                      <td>'.strtoupper($row['status']).'</td>
                      '.$htd.$row['description'].'</td>
                      '.$htd.$row['reminder'].'</td>
                      '.$htd.$row['patient_info'].'</td>
                      '.$htd.$row['access_type'].'</td>
                      '.$htd.$row['chairpersons_email'].'</td>
                      '.$htd.$row['participants_email'].'</td>
                      '.$htd.$row['patients_email'].'</td>
                      '.$htd.$row['creation_date'].'</td>
                      '.$htd.$row['creation_time'].'</td>';
                      if($row['link'] == ''){
                          $data .= '<td style="padding: 0;"><a target="_blank"><button data-name="'.$row['name'].'" data-id="'.$row['board_meeting_id'].'" class="btn-success create-meeting" style="margin-right: 12px">CREATE</button></a><button class="btn-danger delete-data"><i class="bx bx-trash font-size-16 align-middle"></i></button></td>';
                      }else{
                          $data .= '<td style="padding: 0;"><a target="_blank"><button data-link="'.$row['link'].'" class="btn-primary blue join-meeting" style="margin-right: 12px">&nbsp;&nbsp;JOIN&nbsp;&nbsp;</button></a><button class="btn-danger delete-data"><i class="bx bx-trash font-size-16 align-middle"></i></button></td>';
                      }
                $data .= '</tr>';
        }

        // <td style="padding-right: 0;"><button class="btn-primary blue edit-data" data-toggle="modal" data-target="#editModal" style="margin-right: 12px"><i class="bx bx-edit font-size-16 align-middle"></i></button><button class="btn-danger delete-data"><i class="bx bx-trash font-size-16 align-middle"></i></button></td>

    }

    echo $data;

    $conn->close();

?>
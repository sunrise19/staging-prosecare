<?php

    include('../../STATIC_API/Config.php');

    $section = $_REQUEST['id'];

    $user_id = $_SESSION["id"];

    $sql = "SELECT * FROM comments JOIN users ON comments.user = users.user_id JOIN hcp ON comments.user = hcp.user_id  WHERE course='$section' ORDER BY comments.comment_id DESC";

    $result = $conn->query($sql);

    $data = '<span>No comments yet :/<br>Start the conversation :)</span>';

    $data_count = 0;

    if ($result->num_rows > 0) {

        $data = '';

        while($row = $result->fetch_assoc()) {

            $raw_date = explode(' ', $row['date_added']);
            $formattedDate = $raw_date[1] . ' '. $raw_date[2] . ' ' . $raw_date[3];

            $full_name = $row['first_name'] . ' ' . $row['last_name'];
            preg_match_all('/(?<=\b)\w/iu',$full_name,$matches);

            $photo = $row["photo"];

            $data .= '  <div class="complaint_item_parent align-items-start">
                            <div class="complaint_item">
                                <div class="complaint_top">
                                    <div class="d-flex justify-content-between align-items-center" style="gap: 10px">';

                                        if($photo == '' || $photo == 'empty.png'){
                                            $data .='<div class="complaint_user_photo"><span class="complaint_user_initials">'.strtoupper(implode('', $matches[0])).'</span></div>';
                                        }else{
                                            $data .='<div class="complaint_user_photo" style="background-image: url(\'../PROFILE_PHOTOS/'.$photo.'\');"></div>';
                                        }

                                $data .= '<span class="complaint_title">
                                            '.$full_name.'
                                        </span>
                                    </div>
                                    <span class="complaint_date">
                                        '.$formattedDate.' at '.$row['time_added'].'
                                    </span>
                                </div>
                                <div class="complaint_body" style="padding-left: 45px">
                                    <span class="complaint_text">
                                        '.$row['text'].'
                                    </span>
                                </div>
                                <span class="tgc_action text-right '.($user_id ==  $row['user_id'] ? 'delete_comment' : '').'" data-comment="'.($user_id ==  $row['user_id'] ? $row['comment_id'] : '').'" style="color: #f44336; font-weight: 500; text-decoration: none; cursor: pointer">
                                    '.($user_id ==  $row['user_id'] ? 'Delete' : '&nbsp;').'
                                </span>
                            </div>                                           
                        </div>';
        }

    }

    echo $data;

    $conn->close();

?>
<?php
	
	if (!empty($_FILES['file']['name'])) {

		$fileName = $_FILES['file']['name'];
		
		$fileExt = explode('.', $fileName);
		$fileActExt = strtolower(end($fileExt));
		$allowImg = array('png','jpeg','jpg');
		$fileNew = $_REQUEST['filename'] . "." . $fileActExt;  // rand function create the rand number 
		$filePath = '../Dashboard/Images/'.$fileNew; 

		if (in_array($fileActExt, $allowImg)) {
		    if ($_FILES['file']['size'] > 0  && $_FILES['file']['error']==0) {  
                if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                        echo '1,'.$fileNew;
                }else{
                    echo 'Could not move file to folder';
                }	
		    }else{
                echo 'File size error';
		    }
		}else{	
		    echo 'Unsupported File Extension';
		}
	}else{
        echo 'Did not find a file name';
    }

?>
<?php
    include "./config.php";

    $status = 'error'; 
    if(!empty($_FILES["file_content"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["file_content"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'csv', 'xls', 'xlsx'); 
        if(in_array($fileType, $allowTypes)){ 
            $file_content = $_FILES['file_content']['tmp_name']; 
            $blob_content = addslashes(file_get_contents($file_content)); 
         
            // Insert file_content content into database 
            $insert = $conn->query("INSERT into file_upload (fname, blob_content) VALUES ('$fileName', '$blob_content')"); 
             
            if($insert){ 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = $conn->error; 
            }  
        }else{ 
            $statusMsg = 'Sorry, the file is not allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an file_content file to upload.'; 
    } 


    echo $statusMsg;
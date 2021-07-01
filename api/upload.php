<?php
    include "./config.php";

    $status = 'error'; 
    if(!empty($_FILES["file_content"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["file_content"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif', 'pdf', 'csv'); 
        if(in_array($fileType, $allowTypes)){ 
            $file_content = $_FILES['file_content']['tmp_name']; 
            $blob_content = addslashes(file_get_contents($file_content)); 
            // $imageProperties = getimageSize($file_content);
            $file_type = pathinfo($fileName, PATHINFO_EXTENSION);;
            // Insert file_content content into database 
            $insert = $conn->query("INSERT INTO file_upload (fname, blob_content, ftype) VALUES ('$fileName', '$blob_content', '$file_type')"); 
             
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
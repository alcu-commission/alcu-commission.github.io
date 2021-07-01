<?php
    include "./config.php";

    $id = $_GET['id'];
    $sql = "SELECT fname, ftype, blob_content FROM file_upload WHERE id=$id";
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    $data = mysqli_fetch_array($result);
    $ftype = $data['ftype'];

    $imageTypes = array('jpg','png','jpeg','gif'); 

    if (in_array($ftype, $imageTypes)){
    header("Content-type: image/$ftype");
    echo $data['blob_content'];
    
    } elseif ($ftype == 'docx') {
        /*Name of the document file*/
        $document = $data['fname'];

        /**Function to extract text*/
        function extracttext($filename) {
            //Check for extension
            $ext = end(explode('.', $filename));

            //if its docx file
            if($ext == 'docx')
            $dataFile = "word/document.xml";
            //else it must be odt file
            else
            $dataFile = "content.xml";     

            //Create a new ZIP archive object
            $zip = new ZipArchive;

            // Open the archive file
            if (true === $zip->open($filename)) {
                // If successful, search for the data file in the archive
                if (($index = $zip->locateName($dataFile)) !== false) {
                    // Index found! Now read it to a string
                    $text = $zip->getFromIndex($index);
                    // Load XML from a string
                    // Ignore errors and warnings
                    $xml = DOMDocument::loadXML($text, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                    // Remove XML formatting tags and return the text
                    return strip_tags($xml->saveXML());
                }
                //Close the archive file
                $zip->close();
            }

            // In case of failure return a message
            return "File not found";
        }

        echo extracttext($data['blob_content']);
    } else {
        if ($ftype) {
            $mime = "application/$ftype";
        }
        header("Content-type: $mime");
        echo $data['blob_content'];
    }
    mysqli_close($conn);
<?php
    include "./config.php";

    $sql = "SELECT id, fname FROM file_upload";
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    mysqli_close($conn);
    
    echo json_encode($emparray);
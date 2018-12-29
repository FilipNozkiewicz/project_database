<?php
    include_once 'dbh_inc.php';

    $sid = $_POST['sid'];
    $sql = "delete from songs where sid = $sid";
    if(pg_query($conn, $sql)){
        header('Location: done.php');
    }
    else{
        echo "Error description: " . pg_last_error($conn);
    }
?>
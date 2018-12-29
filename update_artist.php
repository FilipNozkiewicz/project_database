<?php
    include_once 'dbh_inc.php';


    $arid = $_POST['arid'];
    $nick = $_POST['nick'];

    $sql = "update artists set nick='$nick' where arid = $arid";
    if(pg_query($conn, $sql)){
        header('Location: done.php');
    }
    else{
        echo "Error description: " . pg_last_error($conn);
    }
?>
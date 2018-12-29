<?php
    include_once 'dbh_inc.php';

    $arid = $_POST['arid'];
    $sql = "delete from artists where arid = $arid";
    if(pg_query($conn, $sql)){
         header('Location: done.php');
    }
    else{

    }

?>
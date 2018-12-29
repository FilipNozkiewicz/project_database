<?php
    include_once 'dbh_inc.php';

    $alid = $_POST['alid'];
    pg_query($conn , "delete from albums where alid =$alid");

?>
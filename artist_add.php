<?php
    include_once 'dbh_inc.php';

    $arid = $_POST['arid'];
    $name = $_POST['name'];
    $last = $_POST['lastname'];
    $nick = $_POST['nick'];
    $country = $_POST['country'];

    if(pg_query($conn , "insert into artists values($arid , '$name' , '$last' , '$nick' , '$country');")){

        header('Location: done.php');
    }else{
        echo "Error description: " . pg_last_error($conn);
    }
?>
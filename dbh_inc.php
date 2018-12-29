<?php

session_start();
$conn = pg_connect("host=localhost dbname=db2 user=postgres password=postgres")
    or die('Cannot connect to database');


$res = pg_query($conn , "select arid , name , lastname , nick from artists");
$data = array();
if(pg_num_rows($res) > 0){
    while($row = pg_fetch_row($res)){
        $data[] = $row;
    }

}
$res2 = pg_query($conn , "select alid , title  from albums");
$data_album = array();
if(pg_num_rows($res2) > 0){
    while($row = pg_fetch_row($res2)){
        $data_album[] = $row;
    }

}

$res_all_artists = pg_query($conn , "select *  from artists order by arid");
$all_artists = array();
if(pg_num_rows($res_all_artists) > 0){
    while($row = pg_fetch_row($res_all_artists)){
        $all_artists[] = $row;
    }

}
$res_all_albums = pg_query($conn , "select *  from albums order by alid");
$all_albums = array();
if(pg_num_rows($res_all_albums) > 0){
    while($row = pg_fetch_row($res_all_albums)){
        $all_albums[] = $row;
    }

}
$res_all_songs = pg_query($conn , "select *  from songs order by sid");
$all_songs = array();
if(pg_num_rows($res_all_songs) > 0){
    while($row = pg_fetch_row($res_all_songs)){
        $all_songs[] = $row;
    }

}

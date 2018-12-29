<?php
include_once 'dbh_inc.php';

$sid = $_POST['sid'];
$title = $_POST['title'];
$length = $_POST['length'];
$alid = $_POST['album_select'];
$alid = explode("," , $alid);


$file = $_FILES['song_content'];
$file_name = $_FILES['song_content']['name'];
$file_tmp_name = $_FILES['song_content']['tmp_name'];
$file_size = $_FILES['song_content']['size'];
$file_type = $_FILES['song_content']['type'];
$file_error = $_FILES['song_content']['error'];

$file_ext = explode(".",$file_name);
$file_act_ext = strtolower(end($file_ext));

$allowed = array('mp3');

if(in_array($file_act_ext , $allowed)){
    if($file_error === 0){
        $file_new_name = (string)$sid."_logo.".$file_act_ext;

        $path = 'uploads_songs';
        $all_files = scandir($path);
        foreach ( $all_files as $a) {
            //echo $a;
            $pp = explode('_' , (string)$a);
            if($pp[0] == (string)$sid){
                if(unlink('uploads_songs/'.(string)$a)){
                    //      echo 'success';
                }
            }
        }
        $file_dest = 'uploads_songs/'.$file_new_name;
        move_uploaded_file($file_tmp_name , $file_dest);
        $query = "insert into songs values($sid , $alid[0] , $length , '$title' , '$file_dest')";
        if(pg_query($conn, $query)){
            header('Location: done.php');
        }
        else{
            echo "Error description: " . pg_last_error($conn);
        }
    }else{
        echo "error uploading the file";
    }
}else{
    echo "bad file extension";
}



?>

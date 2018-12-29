<?php
    include_once 'dbh_inc.php';

    if(isset($_POST['submit'])) {
        $arid = $_POST['artist_select'];
        // echo $arid;
        $arid_nr = explode(",", $arid);
        //   echo $arid_nr[0];
        $alid = $_POST['alid'];
        $title = $_POST['title'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];

        $file = $_FILES['logo'];
        $file_name = $_FILES['logo']['name'];
        $file_tmp_name = $_FILES['logo']['tmp_name'];
        $file_size = $_FILES['logo']['size'];
        $file_type = $_FILES['logo']['type'];
        $file_error = $_FILES['logo']['error'];

        $file_ext = explode(".",$file_name);
        $file_act_ext = strtolower(end($file_ext));

        $allowed = array('png' , 'jpg' , 'jpeg' , 'gif' , 'bmp');

        if(in_array($file_act_ext , $allowed )){
            if($file_error === 0){
                $imagesize = getimagesize($_FILES['logo']['tmp_name']);
                $imagewidth = $imagesize[0];
                $imageheight = $imagesize[1];
                if($imageheight == 600 and $imagewidth == 600){
                    $file_new_name = (string)$alid."_logo.".$file_act_ext;

                    $path = 'uploads';
                    $all_files = scandir($path);
                    foreach ( $all_files as $a) {
                        //echo $a;
                        $pp = explode('_' , (string)$a);
                        if($pp[0] == (string)$alid){
                            if(unlink('uploads/'.(string)$a)){
                          //      echo 'success';
                            }
                        }
                    }
                    $file_dest = 'uploads/'.$file_new_name;
                    move_uploaded_file($file_tmp_name , $file_dest);

                    $sql = "insert into albums values ('$alid' , $arid_nr[0] , '$title' , '$year' , '$genre' , '$file_dest');";
                    if(pg_query($conn, $sql)){
                        header('Location: done.php');
                    }
                    else{

                    }
                }else{
                    echo "you can upload file of resolution 600x600 only";
                }
            }else{
                echo "file uploading error";
            }

        }else{

            echo "Bad file extension only png , jpg jpeg";
        }


    }


?>
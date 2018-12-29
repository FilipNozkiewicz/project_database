<?php
    include_once 'dbh_inc.php';

if(isset($_POST['submit'])) {

    // echo $arid;

    //   echo $arid_nr[0];
    $alid = $_POST['alid'];
  //  $title = $_POST['title'];
   // $year = $_POST['year'];
  //  $genre = $_POST['genre'];
    if(!empty($_FILES['up_logo']['name'])) {
        $file = $_FILES['up_logo'];
        $file_name = $_FILES['up_logo']['name'];
         $file_tmp_name = $_FILES['up_logo']['tmp_name'];
         $file_size = $_FILES['up_logo']['size'];
        $file_type = $_FILES['up_logo']['type'];
          $file_error = $_FILES['up_logo']['error'];

      $file_ext = explode(".",$file_name);
      $file_actual_name = $file_ext[0];
      $file_act_ext = strtolower(end($file_ext));

    $allowed = array('png' , 'jpg' , 'jpeg' , 'gif' , 'bmp');

        if (in_array($file_act_ext, $allowed)) {
            if ($file_error === 0) {
                $imagesize = getimagesize($_FILES['up_logo']['tmp_name']);
                $imagewidth = $imagesize[0];
                $imageheight = $imagesize[1];
                if ($imageheight == 600 and $imagewidth == 600) {
                    $file_new_name = (string)$alid . "_logo." . $file_act_ext;
                    $path = 'uploads';
                    $all_files = scandir($path);
                    foreach ( $all_files as $a) {
                        echo $a;
                        $pp = explode('_' , (string)$a);
                        if($pp[0] == (string)$alid){
                            if(unlink('uploads/'.(string)$a)){
                                echo 'success';
                            }
                        }
                    }


                    $file_dest = 'uploads/' . $file_new_name;

                    move_uploaded_file($file_tmp_name, $file_dest);

                    $sql = "update albums set logo='$file_dest' where alid=$alid";
                    if(pg_query($conn, $sql)){
                        header('Location: done.php');
                    }
                    else{
                        echo "Error description: " . pg_last_error($conn);
                    }
                } else {
                    echo "you can upload file of resolution 600x600 only";
                }
            } else {
                echo "file uploading error";
            }

        } else {

            echo "Bad file extension only png , jpg jpeg";
        }

    }
    if(isset($_POST['title']) && trim($_POST['title']) != ''){ // trim delete whitespaces and check if there is any string
        $title = $_POST['title'];
        $sql = "update albums set title='$title' where alid=$alid";
        if(pg_query($conn, $sql)){
            header('Location: done.php');
        }
        else{
            echo "Error description: " . pg_last_error($conn);
        }
    }
    if(isset($_POST['year']) && trim($_POST['year']) != ''){
        $year = $_POST['year'];
        $sql = "update albums set release_year=$year where alid=$alid";
        if(pg_query($conn, $sql)){
            header('Location: done.php');
        }
        else{
            echo "Error description: " . pg_last_error($conn);
        }
    }
    if(isset($_POST['genre']) && trim($_POST['genre']) != ''){
        $genre = $_POST['genre'];
        $sql = "update albums set genre='$genre' where alid=$alid";
        if(pg_query($conn, $sql)){
            header('Location: done.php');
        }
        else{
            echo "Error description: " . pg_last_error($conn);
        }
    }

}
?>
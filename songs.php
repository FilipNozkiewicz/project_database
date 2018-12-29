<?php
    include_once 'dbh_inc.php';

    $alid = $_POST['album_id'];



    $quer = "select * from songs where alid=$alid";
    $res = pg_query($conn , $quer);
    $data_song = array();
    if(pg_num_rows($res) > 0){
         while($row = pg_fetch_row($res)){
          $data_song[] = $row;
        }
    }
    $q = "select title from albums where alid=$alid";
    $alid_title = pg_query($conn , $quer);

    $sql = "select al.logo , al.title , al.release_year , 
    ar.nick from albums al inner join artists ar on(ar.arid = al.arid) where alid=$alid; ";
    $res_logo = pg_query($conn , $sql);
    $data_logo = array();
    $row = pg_fetch_row($res_logo);
   // echo $row[0];
    ?>
<html>
<head>
    <?php echo "<title>Songs from album  $alid_title </title>"?>
    <meta http-equiv="X_UA_Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" content = "text/css" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <style>
        .navbar-inverse{
            color: #1b6d85;
            text-align: center;
        }
        .title_wrapper{
            text-align: center;
        }
        .t_header{
            text-align: center;
            letter-spacing: 2px;
            font-weight: bold;
            color: #0f0f0f;
        }
        .title{
            background: #1b6d85;
            color: #0f0f0f;
        }
        .title:hover{
            color: #0f0f0f;
            text-decoration: none;
        }
        .handler > img{
            width: 100%;
        }
        .song{
            font-size: 2vw;
            font-family: "Comic Sans MS", cursive, sans-serif;
        }
        .container-fluid{
            background-image: url('Images/texture.jpg');
        }
        footer{
            background-color: #8c8c8c;
            padding-bottom: 30px;
        }
        .sp{
            font-size: 300%;
            text-decoration: none;
        }
        #id{
            display: none;
        }
    </style>
    <script type="text/javascript">
        var audio = new Audio('uploads_songs/song.mp3');

        var playing = false;
        var current = "aaaaa";
        var befid ="id";
        function fun(x,y) {
           // alert(x);

            if (current != x) {
                audio.pause();
                document.getElementById(befid).innerHTML = "PLAY";

                befid = y;
                audio = null;
                audio = new Audio(x);
                audio.play();
                playing = true;

                document.getElementById(y).innerHTML = "PAUSE";
                splitted = audio.src.split("/");
                current = splitted[splitted.length - 1];
                current = "uploads_songs/" + current;

            } else {
                if (playing) {
                    audio.pause();
                    document.getElementById(y).innerHTML = "PLAY";
                    playing = false;
                } else {
                    audio.play();
                    document.getElementById(y).innerHTML = "PAUSE";
                    playing = true;
                }

            }
        }



    </script>

</head>
<body>
<div id="id"></div>
    <div class="container-fluid">
        <div class="navbar navbar-inverse">
            <h1><span class="glyphicon glyphicon-music"></span>SONGS</h1>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="thumbnail">
                <div class="handler">
                    <?php echo "<img src=$row[0]>"?>
                </div>
                <div class="title_wrapper">
                    <?php echo"<h2>$row[1]</h2>" ?>
                    <?php echo"<h3>$row[3]</h3>" ?>
                    <?php echo"<h3>$row[2]</h3>" ?>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th class="t_header"><h1><a class="title">Title</a></h1></th>
                </tr>
                </thead>
                <?php
                    foreach ($data_song as $d){
                        echo "<tr>
                                <td class='song'>$d[3]</td>
                                <td class='song'>
                                    <button class='btn-primary' id=\"$d[0]\" onclick='fun(\"$d[4]\",\"$d[0]\")'>PLAY
                                    </button>
                                   
                                    
                                </td>
                              </tr>";
                    }

                ?>
            </table>
        </div>

    </div>
    <footer class="footer">
        <div class="container">

            <a class="sp">The world worst websites   ,  Check us on: </a>



            <ul class="social-icon animate pull-right">


                    <span style="font-size: 68px; color: Dodgerblue;">
                    <i class="fab fa-facebook-square"></i>
                   </span>
                <span style="font-size: 68px; color: darkorange;">
                    <i class="fab fa-twitter-square"></i>
                   </span>
                <span style="font-size: 68px; color: mediumpurple;">
                    <i class="fab fa-github-square"></i>
                    </span>
                <span style="font-size: 68px; color: #c12e2a;">
                    <i class="fab fa-youtube"></i>
                    </span>
            </ul>
        </div>
    </footer>
</body>
</html>




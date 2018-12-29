<?php
    include_once 'dbh_inc.php';

$res_images = pg_query($conn , "select *  from albums order by alid");
$data_images = array();
if(pg_num_rows($res_images) > 0){
    while($row = pg_fetch_row($res_images)){
        $data_images[] = $row;
    }

}

?>

<html>
    <head>
        <title>Music</title>
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

            .navbar{
                color: #ffffff;
                font-family: 'Satisfy', cursive;
                font-size: 1vw;

            }
            form{
                display: inline-block;
            }
            form a , form input{
                font-size: 1vm;
                color: #8c8c8c;
            }
            form input{
                width: 40%;
                height: 3%;
            }
            .navbar a{
                margin-left: 2%;
            }
            .srch{
                font-size: 0.8vm;
            }

            .f_header a{
                cursor: pointer;
            }
            .container-fluid{
                background-image: url('Images/texture.jpg');
            }
            .handler > img{

            }
            .caption{
                text-align: center;
            }
            footer{
                background-color: #8c8c8c;
            }
            .fa-igloo{

            }
            .sp{
                font-size: 300%;
                text-decoration: none;

            }
            .password_input{

            }
        </style>

    </head>
    <body>

    <div class="container-fluid">
        <div class="navbar navbar-inverse">
            <div class="col-lg-6 col-md-6">
            <a id="gg">MUSIC SITE</a>
            <span class="glyphicon glyphicon-cd"></span>
                <form id="search-albums">
                <a>search </a><input class="srch" type="text" name="search">
                <!--<button class="btn-info" type="submit" name="search_submit">Search <span class="glyphicon glyphicon-search"></span></button> -->
                </form>
            </div>

            <div class="col-md-6 col-lg-6">

                <form action="login_check.php" method="post">
                    <input type="text" name="login" placeholder="login">
                    <input class="password_input" type="password" name="pass" placeholder="password" autocomplete="off"
                           readonly onfocus="this.removeAttribute('readonly');">
                    <button class="btn btn-primary" type="submit" name="submit">
                        <?php
                        if (isset($_SESSION['username'])){
                            echo "Log Out";
                        }
                        else{
                            echo "Log In";
                        }

                        ?></button>
                </form>
                <form action="register_check.php" method="post">

                    <button class="btn btn-primary" type="submit" name="submit">Register</button>
                </form>
                <a href="admin_page.php">Admin</a>
               <!-- <h2 class="f_header"><a href="admin_page.php">Admin Login  </a><span class="glyphicon glyphicon-music"></span>

                </h2> -->

            </div>


        </div>

        <?php

        foreach($data_images as $d) {
            echo "<div class='col-lg-3 col-md-3 album_div'>
                <div class='thumbnail' id='th'>
                <div class='handler'>
                 <img class='img-responsive al_im' src='$d[5]'>
                </div>
                <div class='caption'>
                    <h2 class='title'>$d[2]</h2>
                    <h3 id='genre'>$d[4]</h3>
                    <form method='post' action='songs.php'>
                        <input type='hidden' name='album_id' value=$d[0]>
                        <button type='submit' class='btn-primary' name='submit'>View</button>
                    </form>
                    
                </div>   
                </div>
                
            </div>";
        }

        ?>
        <script>
            const searchBar = document.forms['search-albums'].querySelector('input'); // returns first input
            searchBar.addEventListener('keyup' , function (e) {

                var term = e.target.value.toLowerCase();
              //  alert(term);
                x =   document.getElementsByClassName('album_div');
                for(var i = 0 ; i < x.length ; i++){
                    title = x[i].children[0].children[1].children[0].innerHTML;
                    genre = x[i].children[0].children[1].children[1].innerHTML;
                    if(title.toLowerCase().indexOf(term) == -1  && genre.toLowerCase().indexOf(term) == -1 ){
                        x[i].style.display = 'none';
                    }
                    else{
                        x[i].style.display = "inline";
                    }
                }
            })

        </script>
    </div>
        <footer class="footer">
            <div class="container">

                   <a class="sp">The world worst websites   ,  Check us on: </a>



                <ul class="social-icon animate pull-right">


                    <span style="font-size: 48px; color: Dodgerblue;">
                    <i class="fab fa-facebook-square"></i>
                   </span>
                    <span style="font-size: 48px; color: darkorange;">
                    <i class="fab fa-twitter-square"></i>
                   </span>
                    <span style="font-size: 48px; color: mediumpurple;">
                    <i class="fab fa-github-square"></i>
                    </span>
                    <span style="font-size: 48px; color: #c12e2a;">
                    <i class="fab fa-youtube"></i>
                    </span>
                </ul>
            </div>
        </footer>
    </div>
    </body>
</html>
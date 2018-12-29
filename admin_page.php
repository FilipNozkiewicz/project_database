<?php
    include_once 'dbh_inc.php'
?>

<?php
    if(!isset($_SESSION['username'])){
        if($_SESSION['is_admin'] != 1) {
            header('Location: error_page.php');
        }
    }
?>

<html>
<head>
    <title>MUSIC</title>
    <title>BIKE SITE</title>
    <meta http-equiv="X_UA_Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" content = "text/css" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" , type="text/css" href="">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <style>
        .container-fluid{
            background-image: url("Images/bg.jpg");
        }
        .jumbotron{
            text-align: center;

        }
        #cd{
            position: relative;
            width: 10%;
            height: 10%;
            margin-right: 5%;
        }
        .form{
            text-align: center;
            border: 1px dotted;

        }


        form label{
            width:180px;
            color: #ffffff;
        }
        .file{
            margin-left: 30%;
            color: #0f0f0f;
        }

        button{
            color: #0f0f0f;
        }
        h1 ,h2 , h3{
            color: #ffffff;
        }
        select{
            color: #0f0f0f;
        }
        .b1{
            color: #ffffff;
            margin-left: 30%;
        }
        for input{
            color: #0f0f0f;
        }
        .f1{
            color: #ffffff;
        }
        .form-control{
            width: 50%;
            margin-left: 25%;
        }
        .main_link{
            font-size: 50%;
            display: block;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <section class="jumbotron row">
        <h1>Music<a style="color: orange">|</a>Site <img id="cd" src="Images/cd_music.png"><h1>
                <a class = "main_link" href="index.php">Go to main page</a>
    </section>
    <section class="formsy">
        <div class="form col-lg-4 col-md-4 col-sm-12">
                <h2>ARTISTS</h2>
                <h3>Add Artist</h3>
            <form class="basic_form" action="artist_add.php" method="post">
                <label>Artist Id</label> <input class="form-control" type="number" name="arid" required><br>
                <label>Name</label> <input class="form-control" type="text" name="name" required><br>
                <label>Last Name</label> <input class="form-control" type="text" name="lastname" required><br>
                <label>Nick</label> <input  class="form-control" type="text" name="nick"><br>
                <label>Country</label> <input class="form-control" type="text" name="country" required><br>
                <button class="btn btn-primary" type="submit" name="submit"">Add</button>
            </form>
                <h3>Delete Artist</h3>
            <form class="basic_form" method="post" action="remove_artist.php">
                <label>Artist Id</label><input class="form-control" type="number" name="arid" required><br>
                <button class="btn btn-primary" type="submit" name="submit"">Delete</button>
            </form>
                <h3>Update Artist</h3>
            <form class="basic_form" method="post" action="update_artist.php">
                <label>Artist Id</label><input class="form-control" type="number" name="arid" required><br>
                <label>Nick</label><input class="form-control"  type="text" name="nick" required><br>
                <button class="btn btn-primary" type="submit" name="submit"">Update</button>
            </form>
            <h2>LIST OF ARTISTS</h2>
            <form>
                <select>
                <?php
                    foreach ($all_artists as $a){
                        echo "<option>Id: $a[0], Name: $a[1], LastName: $a[2],Nick: $a[3],Country: $a[4]</option>";
                    }
                ?>
                </select>
            </form>
        </div>

        <div class="form col-lg-4 col-md-4 col-sm-12">
            <h2>ALBUMS</h2>
            <h3>Add Album</h3>
            <form action="add_album.php" method="post" enctype="multipart/form-data">
                <label>Artist Id</label>
                <select name="artist_select">
                    <?php foreach ($data as $d)
                        echo "<option>$d[0],$d[1],$d[2]</option>"
                    ?>
                </select><br>
                <label>Album Id</label><input class="form-control" type="number" name="alid" required><br>
                <label>Title</label><input class="form-control" type="text" name="title" required><br>
                <label>Release Year</label><input class="form-control" type="number" name="year" ><br>
                <label>GENRE</label><input class="form-control" type="text" name="genre" ><br>
                <label>PHOTO</label><input class="file" type="file" name="logo" required><br>
                <button class="btn btn-primary" type="submit" name="submit"">Add Album</button>
            </form>
            <h3>Delete Album</h3>
            <form action="delete_album.php" method="post">
                <label>Album Id</label><input class="form-control" type="number" name="alid" required><br>
                <button class="btn btn-primary" type="submit" name="submit"">Remove Album</button>
            </form>
            <h3>Update Album</h3>
            <form action="update_album.php" method="post" enctype="multipart/form-data">
                <label>Album Id</label><input class="form-control" type="number" name="alid" required><br>
                <label>Title</label><input class="form-control" type="text" name="title"><br>
                <label>Release Year</label><input class="form-control" type="number" name="year"><br>
                <label>GENRE</label><input class="form-control" type="text" name="genre"><br>
                <label>PHOTO</label><input class="b1" type="file" name="up_logo"><br>
                <button class="btn btn-primary" type="submit" name="submit"">Update Album</button>
            </form>
            <h2>LIST OF ALBUMS</h2>
            <form>
                <select>
                    <?php
                    foreach ($all_albums as $a){
                        echo "<option>Id: $a[0], Artist Id: $a[1], Title: $a[2],Release Year: $a[3],Genre: $a[4]</option>";
                    }
                    ?>
                </select>
            </form>
        </div>
        <div class="form col-lg-4 col-md-4 col-sm-12">
            <h2>SONGS</h2>
            <form action="add_song.php" method="post" class="basic_form" enctype="multipart/form-data">
                <label>Album Id</label>
                <select name="album_select">
                    <?php foreach ($data_album as $d)
                        echo "<option>$d[0],$d[1]</option>"
                    ?>
                </select><br>
                <label>Song Id</label><input class="form-control" type="number" name="sid" required><br>
                <label>Title</label><input class="form-control" type="text" name="title" required><br>
                <label>Length</label><input class="form-control" type="text" name="length"><br>
                <label>Add Song</label><input class="file f1" type="file" name="song_content"><br>
                <button class="btn btn-primary" type="submit" name="submit"">Add Song</button>
            </form>
            <h3>Delete Song</h3>
            <form action="delete_song.php" method="post">
                <label>Song Id</label><input class="form-control" type="number" name="alid" required><br>
                <button class="btn btn-primary" type="submit" name="submit"">Delete Song</button>
            </form>
            <h3>Update Song</h3>
            <form action="delete_song" method="post">
                <label>Song Id</label><input class="form-control" type="number" name="alid" required><br>
                <label>Title</label><input class="form-control" type="text" name="title"><br>
                <label>Length</label><input class="form-control" type="text" name="length"><br>
                <button class="btn btn-primary" type="submit" name="submit"">Update Song</button>
            </form>
            <h2>LIST OF SONGS</h2>
            <form>
                <select>
                    <?php
                    foreach ($all_songs as $a){
                        echo "<option>Id: $a[0], Album Id: $a[1], Length: $a[2],Title: $a[3]</option>";
                    }
                    ?>
                </select>
            </form>
        </div>
    </section>
</div>
</body>
</html>
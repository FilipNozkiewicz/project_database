<?php

include_once 'dbh_inc.php';


    if(isset($_POST['submit'])){

        if(isset($_SESSION['username'])){

            session_start();
            session_unset();
            session_destroy();

            header('Location: index.php?login=unset');
            exit();

        }else {

            include 'dbh_inc.php';

            $user = pg_escape_string($conn, $_POST['login']);
            $pass = pg_escape_string($conn, $_POST['pass']);

            $sql = "select * from users where username='$user'";
            $result_login = pg_query($conn, $sql);
            $result_login_check = pg_num_rows($result_login);
            if ($result_login_check < 1) {
                header('Location: index.php?login=error_row');
                exit();
            } else {

                if ($row = pg_fetch_assoc($result_login)) {

                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['is_admin'] = $row['is_admin'];

                    header('Location: index.php?login=logged');
                    exit();
                }
            }

        }

    }else{
        header('Location: index.php?login=error');
        exit();
    }

?>
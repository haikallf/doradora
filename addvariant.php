<?php
    session_start();
    if (isset($_SESSION['username'])) {

    }
    else {
        echo "<script>alert('Anda harus menjadi admin untuk mengakses halaman ini');</script>";
        echo "<script>location.href='index.php'</script>";
    }

    if (isset($_SESSION['username'])) {
        $isAdmin = $_SESSION['isAdmin'];
    }
    else {
        $isAdmin = -1;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/header-user.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <title>Home</title>
  </head>
  <body onload="renderHeader(<?= $isAdmin?>)">
    <div class="header">
        <div class="header-brand" onclick="goToHome()">
            Doradora
        </div>

        <div class="header-search">
            <input type="search" placeholder="Cari dorayaki disini">
            <div class="search-icon"><i class="fas fa-search"></i></div>
        </div>

        <div id="header-user-admin"></div>

        <div class="header-user">
            <i class="fas fa-user"></i>
            <?php if (isset($_SESSION['username'])) {?>
                <p><?= $_SESSION['username'] ?></p>
            <?php } else { ?>
                <p>Guest</p>
            <?php } ?>
            
        </div>
        
        <div class="vr"></div>

        <?php 
            require_once( 'functions.php' );
            if(array_key_exists('logout-btn', $_POST)) {
                if (isset($_SESSION['username'])) {
                    session_destroy();
                    echo "<script>location.href='login.php'</script>";
                }
            }
            else if(array_key_exists('login-btn', $_POST)){
                echo "<script>location.href='login.php'</script>";
            }
        ?>

        <div class="login-logout">
            <form method="POST">
                <?php if (isset($_SESSION['username'])) {?>
                    <input type='submit' name='logout-btn' id='logout-btn' value="Log Out"/>
                <?php } else { ?>
                    <input type='submit' name='login-btn' id='login-btn' value="Log In" />
                <?php } ?>
            </form>
        </div>
        
    </div>
    </body>
    <script src="./js/index.js"></script>
</html>
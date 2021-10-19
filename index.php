<?php
    require_once( 'functions.php' );
    session_start();    
    if (isset($_POST['username'])) {
        $username_curr = $_POST['username'];
        $password_curr = $_POST['password'];
        $logs = login($username_curr, $password_curr);
        $_SESSION['username'] = $logs["username"];
        $_SESSION['isAdmin'] = $logs["status"];
        $isAdmin = $_SESSION['isAdmin'];
        
        if($_SESSION['isAdmin'] == 0) {
            echo "<script>alert('selamat datang pengunjung!');</script>";
        } else {
            echo "<script>alert('selamat datang admin!');</script>";
        }   
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
    
    <div class="product-container">
        <div class="product">
            <?php 
                require_once('./db/database.php');
                $itemArray = loadAllItem(); // ini harus beda antara admin dan user, kalau user load yg available aja
            ?>
            <?php for($i = 0; $i < count($itemArray); $i++) {?>
                <form action="product-details.php" method="GET" name="itemForm" id="itemForm-<?=$i?>" class="itemForm">
                    <div class="product-card" onclick="submitData(<?=$i?>)">
                        <img src=<?= $itemArray[$i]["gambar"]?> alt="Dorayaki">
                        <p><?= $itemArray[$i]["namaItem"]?></p>
                        <p>★★★★★</p>
                        <p>Rp<?= $itemArray[$i]["harga"]?></p>
                        <input type="hidden" name="idItem" value=<?= $itemArray[$i]["idItem"]?>>
                        <!-- <input type="submit" name="" id="submit" value="gas"> -->
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>

    <div class="container" id="container"></div>
    <script src="./js/index.js"></script>
  </body>
</html>

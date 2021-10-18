<?php
    require_once( 'functions.php' );
    session_start();    
    if (isset($_POST['username'])) {
        $username_curr = $_POST['username'];
        $password_curr = $_POST['password'];
        $_SESSION['username'] = login($username_curr, $password_curr);
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
  <body>
    <div class="header">
        <div class="header-brand" onclick="goToHome()">
            Doradora
        </div>

        <div class="header-search">
            <input type="search" placeholder="Cari dorayaki disini">
            <div class="search-icon"><i class="fas fa-search"></i></div>
        </div>

        <div class="header-option">
            <div class="header-cart" title="Keranjang" onclick="goToCart()">
                <i class="fas fa-shopping-cart"></i>
            </div>

            <div class="header-wishlist" title="Wishlist">
                <i class="fas fa-heart"></i>
            </div>

            <div class="header-chat" title="Obrolan">
                <i class="fas fa-comment-dots"></i>
            </div>
        </div>

        <div class="vr"></div>

        <div class="header-history" onclick="goToOrderHistory()">
            <i class="fas fa-history"></i>
            <p>Order History</p>
        </div>

        <div class="vr"></div>

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

        <form method="POST">
            <?php if (isset($_SESSION['username'])) {?>
                    <input type='submit' name='logout-btn' style="outline: none; height: 25px; width: 75px; border-radius: 10px; border: 1px solid black;font-family: 'Poppins', sans-serif; background-color: black; color: white; cursor: pointer;transition: 0.5"
                     value="Log Out"/>
            <?php } else { ?>
                    <input type='submit' name='login-btn' style="outline: none; height: 25px; width: 75px; border-radius: 10px; border: 1px solid black;font-family: 'Poppins', sans-serif; background-color: black; color: white; cursor: pointer;transition: 0.5" value="Log In" />
                </div>
            <?php } ?>
            </form>
    </div>
    
    <div class="product-container">
        <div class="product">
            <?php 
                require_once('database.php');
                $itemArray = loadAllItem();
            ?>
            <?php for($i = 0; $i < count($itemArray); $i++) {?>
                <div class="product-card">
                    <img src=<?= $itemArray[$i]["gambar"]?> alt="Dorayaki">
                    <p><?= $itemArray[$i]["namaItem"]?></p>
                    <p>★★★★★</p>
                    <p>Rp<?= $itemArray[$i]["harga"]?></p>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <div class="container" id="container"></div>
    <script src="./js/index.js"></script>
  </body>
</html>

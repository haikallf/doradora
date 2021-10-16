<?php
    require_once( './db/functions.php' );
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
        <div class="header-brand">
            Dorameki
        </div>

        <div class="header-search">
            <input type="search" placeholder="Search books">
            <div class="search-icon"><i class="fas fa-search"></i></div>
        </div>

        <div class="header-option">
            <div class="header-cart" title="Keranjang">
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

        <div class="header-history">
            <i class="fas fa-history"></i>
            <p>Order History</p>
        </div>

        <div class="vr"></div>

        <div class="header-user">
            <i class="fas fa-user"></i>
            <?php if (isset($_SESSION['usename'])) {?>
                <p><?= $_SESSION['username'] ?></p>
            <?php } else { ?>
                <p>Guest</p>
            <?php } ?>
            
        </div>
        
        <div class="vr"></div>

        <form method="POST">
            <?php if (isset($_SESSION['userid'])) {?>
                    <input type='submit' name='logout-btn' style="outline: none; height: 25px; width: 75px; border-radius: 10px; border: 1px solid black;font-family: 'Poppins', sans-serif; background-color: black; color: white; cursor: pointer;transition: 0.5"
                     value="Log Out"/>
            <?php } else { ?>
                    <input type='submit' name='login-btn' style="outline: none; height: 25px; width: 75px; border-radius: 10px; border: 1px solid black;font-family: 'Poppins', sans-serif; background-color: black; color: white; cursor: pointer;transition: 0.5" value="Log In" />
                </div>
            <?php } ?>
            </form>
    </div>
    <div class="featured">
      This is home page. Go to <a href="./pages/login.php">login page</a>
    </div>
    
  </body>
</html>

<?php
    session_start();
    if (isset($_SESSION['username'])) {

    }
    else {
        echo "<script>alert('Anda harus login untuk mengakses halaman ini');</script>";
        echo "<script>location.href='index.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/header-user.css" />
    <link rel="stylesheet" href="./css/order-history.css" />
    <title>Riwayat Pembelanjaan</title>
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
    <div class="order-history-title">
        <p>Riwayat Pembelanjaan</p>
    </div>
    <div class="order-history-container">
        <div class="order-history-left">
            <div class="order-history-product">
                <div class="order-history-img-container">
                    <img src="./images/dorayaki.jpg" alt="foto buku" />
                </div>
                <div class="order-history-details-container">
                    <div class="order-history-details">
                        <p>Dorayaki Original</p>
                        <strong>Rp5000</strong>
                        <p>1 buah</p>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>

</html>
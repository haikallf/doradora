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
    <link rel="stylesheet" href="./css/cart.css" />
    <title>Keranjang</title>
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
    <div class="cart-title">
        <p>Keranjang</p>
    </div>
    <div class="cart-container">
        <div class="cart-left">
            <div class="cart-product">
                <div class="cart-img-container">
                    <img src="./images/dorayaki.jpg" alt="foto buku" />
                </div>
                <div class="cart-details-container">
                    <div class="cart-details">
                        <p>Dorayaki Original</p>
                        <strong>Rp5000</strong>
                        <form method="POST">
                            <input type="hidden" name="title" value="Judul">
                            <input id="cart-qty" type="number" name="jumlah" value="JJJ" min="1">
                            <button id="cart-check-btn" type="submit" name="changeqty"><i class="fas fa-check"></i></button>
                        </form>
                    </div>
                    <!-- <form action="" method="POST">
                        <input type="hidden" name="title" value="asdsa">
                        <button class="cart-del-btn" type="submit" name="delfromcart">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </button>
                    </form> -->
                    
                </div>
            </div>
        </div>

        <div class="cart-right">
            <div class="cart-right-promo">
                <input type="text" placeholder="Masukkan kode promo">
            </div>
            <div class="cart-right-total">
                <h2>Ringkasan Belanja</h2>
                <div class="subtotal">
                    <p>Subtotal (1 barang):</p>
                    <p>Rp5000</p>
                </div>
                <div class="shipping">
                    <p>Ongkos Kirim:</p>
                    <p>Rp0</p>
                </div>
                <div class="hr">
                    <hr>
                </div>
                <div class="total">
                    <p>Total:</p>
                    <p>Rp5000</p>
                </div>
                <div class="checkout-btn">
                    <button>Beli</button>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>

</html>